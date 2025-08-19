<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        //*Elimina el directorio con las imagenes.
        Storage::deleteDirectory('posts');
        Storage::makeDirectory('posts');


        User::factory()->create([
            'name' => 'daniel',
            'email' => 'daniel@gmail.com',
            'password' => bcrypt('12345678'),
        ]);

        Category::factory(10)->create();
        Post::factory(100)->create();
        Tag::create(['name' => 'Programación']);

        $this->call([
            PermissionSeeder::class,
        ]);
    }
}
