<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Like;
use App\Model\Reply;
use App\User;
use Faker\Generator as Faker;

$factory->define(Like::class, function (Faker $faker) {
    return [
        'user_id' => User::all()->random()->id,
        'reply_id' => Reply::all()->random()->id,
    ];
});
