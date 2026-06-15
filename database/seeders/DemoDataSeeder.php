<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Chat;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DemoDataSeeder extends Seeder
{
    public function run(): void
    {
        // Demo user
        $user = User::updateOrCreate(
            ['email' => 'user@recyclick.test'],
            [
                'name' => 'User Demo',
                'password' => Hash::make('password'),
                'role' => 'user',
                'eco_points' => 120,
            ]
        );

        // Ensure admin exists
        User::updateOrCreate(
            ['email' => 'admin@recyclick.test'],
            [
                'name' => 'Admin Recyclick',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'eco_points' => 0,
            ]
        );

        $categories = [
            [
                'name' => 'Reusable Product',
                'description' => 'Produk yang dapat digunakan berulang kali untuk mengurangi limbah sekali pakai.',
            ],
            [
                'name' => 'Recycled Craft',
                'description' => 'Produk kreatif dari material daur ulang.',
            ],
            [
                'name' => 'Eco Lifestyle',
                'description' => 'Produk pendukung gaya hidup ramah lingkungan.',
            ],
            [
                'name' => 'Zero Waste',
                'description' => 'Produk untuk membantu mengurangi sampah harian.',
            ],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['name' => $category['name']],
                [
                    'slug' => Str::slug($category['name']),
                    'description' => $category['description'],
                ]
            );
        }

        $products = [
            [
                'category' => 'Reusable Product',
                'name' => 'Reusable Canvas Tote Bag',
                'description' => 'Tas belanja kain kanvas yang kuat, stylish, dan dapat digunakan berkali-kali untuk mengurangi penggunaan kantong plastik.',
                'price' => 42000,
                'stock' => 25,
                'eco_badge' => 'Reusable',
                'eco_points_reward' => 12,
                'eco_impact' => 5,
            ],
            [
                'category' => 'Zero Waste',
                'name' => 'Stainless Straw Travel Set',
                'description' => 'Set sedotan stainless dengan pouch kecil yang mudah dibawa untuk mengurangi sedotan plastik sekali pakai.',
                'price' => 28000,
                'stock' => 40,
                'eco_badge' => 'Plastic Free',
                'eco_points_reward' => 8,
                'eco_impact' => 4,
            ],
            [
                'category' => 'Eco Lifestyle',
                'name' => 'Bamboo Toothbrush Pack',
                'description' => 'Sikat gigi bambu dengan desain minimalis sebagai alternatif sikat gigi plastik.',
                'price' => 25000,
                'stock' => 35,
                'eco_badge' => 'Eco Choice',
                'eco_points_reward' => 7,
                'eco_impact' => 3,
            ],
            [
                'category' => 'Recycled Craft',
                'name' => 'Recycled Paper Notebook',
                'description' => 'Buku catatan dari kertas daur ulang dengan cover minimalis untuk kegiatan belajar dan kerja.',
                'price' => 30000,
                'stock' => 22,
                'eco_badge' => 'Recycled',
                'eco_points_reward' => 9,
                'eco_impact' => 4,
            ],
            [
                'category' => 'Reusable Product',
                'name' => 'Eco Lunch Box',
                'description' => 'Kotak makan reusable yang cocok untuk membawa bekal dan mengurangi kemasan makanan sekali pakai.',
                'price' => 55000,
                'stock' => 18,
                'eco_badge' => 'Reusable',
                'eco_points_reward' => 14,
                'eco_impact' => 6,
            ],
            [
                'category' => 'Eco Lifestyle',
                'name' => 'Reusable Water Bottle',
                'description' => 'Botol minum reusable untuk membantu mengurangi konsumsi botol plastik harian.',
                'price' => 65000,
                'stock' => 15,
                'eco_badge' => 'Eco Choice',
                'eco_points_reward' => 15,
                'eco_impact' => 7,
            ],
            [
                'category' => 'Zero Waste',
                'name' => 'Organic Cotton Produce Bag',
                'description' => 'Kantong belanja sayur dan buah berbahan katun organik yang bisa dipakai berulang kali.',
                'price' => 35000,
                'stock' => 30,
                'eco_badge' => 'Zero Waste',
                'eco_points_reward' => 10,
                'eco_impact' => 5,
            ],
            [
                'category' => 'Recycled Craft',
                'name' => 'Recycled Desk Organizer',
                'description' => 'Organizer meja dari material daur ulang untuk menyimpan alat tulis dan aksesori kecil.',
                'price' => 48000,
                'stock' => 12,
                'eco_badge' => 'Recycled',
                'eco_points_reward' => 11,
                'eco_impact' => 5,
            ],
        ];

        foreach ($products as $item) {
            $category = Category::where('name', $item['category'])->first();

            Product::updateOrCreate(
                ['name' => $item['name']],
                [
                    'category_id' => $category->id,
                    'slug' => Str::slug($item['name']),
                    'description' => $item['description'],
                    'price' => $item['price'],
                    'stock' => $item['stock'],
                    'image' => null,
                    'eco_badge' => $item['eco_badge'],
                    'eco_points_reward' => $item['eco_points_reward'],
                    'eco_impact' => $item['eco_impact'],
                ]
            );
        }

        Chat::firstOrCreate(
            [
                'user_id' => $user->id,
                'message' => 'Halo admin, apakah produk reusable bottle masih tersedia?',
                'sender' => 'user',
            ],
            [
                'is_read' => false,
            ]
        );

        Chat::firstOrCreate(
            [
                'user_id' => $user->id,
                'message' => 'Halo, masih tersedia. Kamu bisa langsung menambahkannya ke keranjang.',
                'sender' => 'admin',
            ],
            [
                'is_read' => true,
            ]
        );
    }
}