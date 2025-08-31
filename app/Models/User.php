<?php

namespace App\Models;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Overtrue\LaravelLike\Traits\Liker;
use Overtrue\LaravelFavorite\Traits\Favoriter;
use Overtrue\LaravelFollow\Traits\Followable;
use Overtrue\LaravelFollow\Traits\Follower;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;
    use Liker;
    use Favoriter;
    use Follower;
    use Followable;

    protected $fillable = [
        'name',
        'username',
        'familyname',
        'email',
        'password',
        'interested',
        'location',
        'phone',
        'gender',
        'bio',
        'website',
        'avatar',
        'remember_token',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'familyname',
        'username',
        'name',
        'email',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function hasFavorited(Post $post)
    {
        return $this->favorites()->where('post_id', $post->id)->exists();
    }

    public function toggleFavorite(Post $post)
    {
        $favorite = $this->favorites()->where('post_id', $post->id)->first();

        if ($favorite) {
            $favorite->delete();
        } else {
            $this->favorites()->create(['post_id' => $post->id]);
        }
    }



    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail);
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function conversations(): HasMany
    {
        return $this->hasMany(Conversation::class, 'sender_id')->orWhere('receiver_id', $this->id);
    }

    public function receivesBroadcastNotificationsOn(): string
    {
        return 'users.' . $this->id;
    }

    // Metode za praćenje korisnika

    public function following()
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'followed_id')->withTimestamps();
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'followed_id', 'follower_id')->withTimestamps();
    }

    public function isFollowing(User $user)
    {
        return $this->following()->where('followed_id', $user->id)->exists();
    }

    public function follow(User $user)
    {
        $this->following()->attach($user->id);
    }

    public function unfollow(User $user)
    {
        $this->following()->detach($user->id);
    }

    public function toggleFollow(User $user)
    {
        if ($this->isFollowing($user)) {
            $this->unfollow($user);
        } else {
            $this->follow($user);
        }
    }

    public function getInterestedIdsAttribute($value)
    {
        // Ako je null, vrati prazan niz
        return $value ? json_decode($value, true) : [];
    }



}
