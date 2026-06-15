<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Recyclick') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    <!-- Custom Confirm Modal Modern -->
    <div class="modal fade" id="recyConfirmModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content recy-confirm-modal">
                <div class="modal-body text-center p-4">
                    <div class="recy-confirm-icon mx-auto mb-3">
                        !
                    </div>

                    <h4 class="fw-bold mb-2" id="recyConfirmTitle">
                        Konfirmasi Aksi
                    </h4>

                    <p class="text-muted mb-4" id="recyConfirmMessage">
                        Apakah kamu yakin ingin melanjutkan?
                    </p>

                    <div class="d-flex justify-content-center gap-2">
                        <button type="button" class="recy-btn-outline" data-bs-dismiss="modal">
                            Batal
                        </button>

                        <button type="button" class="recy-btn-danger" id="recyConfirmYes">
                            Ya, Lanjutkan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let selectedForm = null;

            const modalElement = document.getElementById('recyConfirmModal');
            const messageElement = document.getElementById('recyConfirmMessage');
            const titleElement = document.getElementById('recyConfirmTitle');
            const confirmButton = document.getElementById('recyConfirmYes');

            if (!modalElement || !confirmButton) return;

            const confirmModal = new bootstrap.Modal(modalElement);

            document.querySelectorAll('form[data-confirm-message]').forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (form.dataset.confirmed === 'true') {
                        return;
                    }

                    event.preventDefault();

                    selectedForm = form;

                    const message = form.dataset.confirmMessage || 'Apakah kamu yakin ingin melanjutkan?';
                    const title = form.dataset.confirmTitle || 'Konfirmasi Aksi';

                    titleElement.textContent = title;
                    messageElement.textContent = message;

                    confirmModal.show();
                });
            });

            confirmButton.addEventListener('click', function () {
                if (!selectedForm) return;

                selectedForm.dataset.confirmed = 'true';
                confirmModal.hide();
                selectedForm.submit();
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const forms = document.querySelectorAll('form');

            forms.forEach(function (form) {
                if (form.dataset.nativeValidation === 'true') {
                    return;
                }

                form.setAttribute('novalidate', true);

                form.addEventListener('submit', function (event) {
                    clearValidationErrors(form);

                    const invalidField = getFirstInvalidField(form);

                    if (invalidField) {
                        event.preventDefault();
                        showValidationError(invalidField, getValidationMessage(invalidField));
                        invalidField.focus({ preventScroll: true });

                        invalidField.scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                    }
                });

                form.querySelectorAll('input, textarea, select').forEach(function (field) {
                    field.addEventListener('input', function () {
                        clearFieldError(field);
                    });

                    field.addEventListener('change', function () {
                        clearFieldError(field);
                    });
                });
            });

            function getFirstInvalidField(form) {
                const fields = form.querySelectorAll('input, textarea, select');

                for (const field of fields) {
                    if (
                        field.disabled ||
                        field.type === 'hidden' ||
                        field.type === 'submit' ||
                        field.type === 'button' ||
                        field.type === 'reset'
                    ) {
                        continue;
                    }

                    if (field.hasAttribute('required') && !String(field.value || '').trim()) {
                        return field;
                    }

                    if (field.type === 'email' && field.value.trim() !== '' && !isValidEmail(field.value)) {
                        return field;
                    }

                    if (field.minLength > 0 && field.value.trim().length > 0 && field.value.trim().length < field.minLength) {
                        return field;
                    }

                    if (field.maxLength > 0 && field.value.trim().length > field.maxLength) {
                        return field;
                    }
                }

                return null;
            }

            function getValidationMessage(field) {
                const label = getFieldLabel(field);

                if (field.hasAttribute('required') && !String(field.value || '').trim()) {
                    return `${label} wajib diisi.`;
                }

                if (field.type === 'email' && field.value.trim() !== '' && !isValidEmail(field.value)) {
                    return `Format ${label.toLowerCase()} belum valid.`;
                }

                if (field.minLength > 0 && field.value.trim().length < field.minLength) {
                    return `${label} minimal ${field.minLength} karakter.`;
                }

                if (field.maxLength > 0 && field.value.trim().length > field.maxLength) {
                    return `${label} maksimal ${field.maxLength} karakter.`;
                }

                return `${label} belum valid.`;
            }

            function getFieldLabel(field) {
                const id = field.getAttribute('id');

                if (id) {
                    const label = document.querySelector(`label[for="${id}"]`);

                    if (label) {
                        return label.textContent.trim();
                    }
                }

                const closestLabel = field.closest('div')?.querySelector('label');

                if (closestLabel) {
                    return closestLabel.textContent.trim();
                }

                return field.getAttribute('placeholder') || field.getAttribute('name') || 'Field ini';
            }

            function showValidationError(field, message) {
                clearFieldError(field);

                field.classList.add('recy-input-invalid');

                const error = document.createElement('div');
                error.className = 'recy-field-error';
                error.innerHTML = `
                <svg viewBox="0 0 24 24" fill="none">
                    <path d="M12 9v4"
                          stroke="currentColor"
                          stroke-width="2"
                          stroke-linecap="round"/>
                    <path d="M12 17h.01"
                          stroke="currentColor"
                          stroke-width="3"
                          stroke-linecap="round"/>
                    <path d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0Z"
                          stroke="currentColor"
                          stroke-width="2"
                          stroke-linejoin="round"/>
                </svg>
                <span>${message}</span>
            `;

                field.insertAdjacentElement('afterend', error);
            }

            function clearFieldError(field) {
                field.classList.remove('recy-input-invalid');

                const next = field.nextElementSibling;

                if (next && next.classList.contains('recy-field-error')) {
                    next.remove();
                }
            }

            function clearValidationErrors(form) {
                form.querySelectorAll('.recy-input-invalid').forEach(function (field) {
                    field.classList.remove('recy-input-invalid');
                });

                form.querySelectorAll('.recy-field-error').forEach(function (error) {
                    error.remove();
                });
            }

            function isValidEmail(email) {
                return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
            }
        });
    </script>
</body>

</html>