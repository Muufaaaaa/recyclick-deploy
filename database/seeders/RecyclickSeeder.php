<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RecyclickSeeder extends Seeder
{
    public function run(): void
    {
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
            'Reusable Product',
            'Recycled Craft',
            'Eco Lifestyle',
            'Zero Waste',
        ];

        foreach ($categories as $categoryName) {
            Category::updateOrCreate(
                ['slug' => Str::slug($categoryName)],
                [
                    'name' => $categoryName,
                    'description' => 'Kategori produk ' . $categoryName,
                ]
            );
        }

        $products = [
            [
                'category' => 'Reusable Product',
                'name' => 'Reusable Tote Bag',
                'description' => 'Tas belanja ramah lingkungan yang bisa digunakan berkali-kali.',
                'price' => 35000,
                'stock' => 25,
                'eco_badge' => 'Reusable',
                'eco_points_reward' => 10,
                'eco_impact' => 5,
            ],
            [
                'category' => 'Zero Waste',
                'name' => 'Stainless Straw Set',
                'description' => 'Set sedotan stainless untuk mengurangi penggunaan sedotan plastik sekali pakai.',
                'price' => 25000,
                'stock' => 40,
                'eco_badge' => 'Plastic Free',
                'eco_points_reward' => 8,
                'eco_impact' => 3,
            ],
            [
                'category' => 'Eco Lifestyle',
                'name' => 'Bamboo Toothbrush',
                'description' => 'Sikat gigi bambu sebagai alternatif sikat gigi plastik.',
                'price' => 18000,
                'stock' => 30,
                'eco_badge' => 'Eco Choice',
                'eco_points_reward' => 7,
                'eco_impact' => 2,
            ],
            [
                'category' => 'Recycled Craft',
                'name' => 'Recycled Paper Notebook',
                'description' => 'Buku catatan dari kertas daur ulang dengan desain minimalis.',
                'price' => 22000,
                'stock' => 20,
                'eco_badge' => 'Recycled',
                'eco_points_reward' => 9,
                'eco_impact' => 4,
            ],
        ];

        foreach ($products as $item) {
            $category = Category::where('name', $item['category'])->first();

            Product::updateOrCreate(
                ['slug' => Str::slug($item['name'])],
                [
                    'category_id' => $category->id,
                    'name' => $item['name'],
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
    }
}