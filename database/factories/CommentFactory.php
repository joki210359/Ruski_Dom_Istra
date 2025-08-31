<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

            'parent_id'=>null,
            'commentable_id'=>Post::factory(),
            'commentable_type'=>Post::class,
            'body'=>$this->faker->paragraph(),
            'user_id'=>User::factory(),
        ];
    }


    //

    function isReply(Post $post)  {

        return $this->state(function(array $attributes)use ($post){


            return [
                'commentable_id'=>$post->id,
                'commentable_type'=>Post::class,

            ];

        });

    }
}
