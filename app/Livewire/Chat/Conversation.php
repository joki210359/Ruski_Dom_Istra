<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Message;
use App\Models\Conversation;


class Conversation extends Model
{
    protected $fillable = [
        'sender_id',
        'receiver_id',
    ];

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function lastMessage()
    {
        return $this->hasOne(Message::class)->latestOfMany();
    }

    public function unreadMessagesCount()
    {
        return $this->hasMany(Message::class)
            ->whereNull('read_at')
            ->where('receiver_id', auth()->id())
            ->count();
    }
}
