<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    // If your table name is not the plural 'likes', specify it:
    // protected $table = 'likes';

    // If you want to allow mass assignment on certain columns, define fillable:
    protected $fillable = [
        'user_id',
        'post_id',
        // add other columns if you have, e.g. 'created_at' is auto-managed by Laravel
    ];

    // If you don't use timestamps in your table, set this to false:
    // public $timestamps = false;

    /**
     * The user who liked the post.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The post that was liked.
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
