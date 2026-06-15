<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Recyclick') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet" />

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- App CSS & JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    {{ $slot }}

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

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