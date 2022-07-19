<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
        // \App\Models\User::factory(10)->create();
        User::create([
            'name' => 'Nibir',
            'email' => 'nibirahmed@gmail.com',
            'password' => Hash::make('NibirAhmed'),
        ]);
        Category::factory(20)->create();
        Tag::factory(20)->create();
        Post::factory(50)->create();
    }
}
