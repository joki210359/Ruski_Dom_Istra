<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Overtrue\LaravelLike\Traits\Likeable;


class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Likeable;
    protected $guarded=[];

public function likes()
{
    return $this->hasMany(CommentLike::class); // ili odgovarajući model
}

    function commentable() : MorphTo {
        
        return $this->morphTo();
    }

    public function comment()
{
    return $this->belongsTo(Comment::class);
}

    #parent 

    function parent() : BelongsTo {

        return $this->belongsTo(Self::class,'parent_id');
        
    }


    function replies()  {

        return $this->hasMany(Comment::class,'parent_id','id')->with('replies');
        
    }

    function user() : BelongsTo {
        
        return $this->belongsTo(User::class);
    }
}
