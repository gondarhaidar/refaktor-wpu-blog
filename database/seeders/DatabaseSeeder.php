<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(5)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // Post::create([
        //     'title' => "Judul pertama",
        //     'slug' => "judul-pertama",
        //     'user_id' => mt_rand(1, 20),
        //     'category_id' => mt_rand(1, 4),
        //     'body' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Harum veritatis illum qui ex cum eos at cupiditate necessitatibus sit ea perferendis sed eum repellendus sequi aspernatur similique labore odit ratione, doloremque possimus. Porro nostrum ad vel eaque perferendis doloribus voluptates eos quas iusto modi maiores, inventore doloremque minima quisquam dolores architecto magni. Quibusdam earum voluptas blanditiis eveniet animi asperiores repellendus expedita pariatur non est sapiente, tenetur voluptatem rerum sunt totam molestiae recusandae deleniti necessitatibus error quaerat. Ad illum odit veniam nemo numquam ipsa aliquid dolor, blanditiis at vel repudiandae in omnis sed totam quisquam voluptatibus hic harum eos quas eius.'
        // ]);
        Post::factory(10)->create();
    }
}
