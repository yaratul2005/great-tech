<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tool;
use App\Models\Category;
use Illuminate\Support\Str;

class ToolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();
        
        // Create 3 tools for each category
        foreach ($categories as $category) {
            for ($i = 1; $i <= 3; $i++) {
                Tool::create([
                    'name' => $category->name . ' Sample Tool ' . $i,
                    'category_id' => $category->id,
                    'description' => 'This is a sample ' . strtolower($category->name) . ' tool description. It provides excellent functionality for various purposes.',
                    'price' => rand(29, 199),
                    'file_path' => 'tools/sample-' . Str::slug($category->name) . '-' . $i . '.zip',
                    'status' => 'published',
                    'slug' => Str::slug($category->name . '-sample-tool-' . $i),
                    'version' => '1.' . rand(0, 9) . '.' . rand(0, 9),
                ]);
            }
        }
    }
}