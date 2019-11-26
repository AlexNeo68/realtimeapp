<?php

use App\Model\Category;
use App\Model\Like;
use App\Model\Question;
use App\Model\Reply;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 10)->create();
        factory(Category::class, 5)->create();
        factory(Question::class, 10)->create();
        factory(Reply::class, 20)->create()->each(function ($reply) {
            return $reply->likes()->save(factory(Like::class)->make());
        });

        User::create([
            'name' => 'AlexNeo68',
            'email' => 'admin@admin.test',
            'email_verified_at' => now(),
            'password' => Hash::make('111111'),
            'remember_token' => Str::random(10),
        ]);
    }
}
