<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class PostReport extends Model
{
    use HasFactory;
    protected $fillable = ['post_id', 'name', 'email', 'reason'];

    protected $table = 'post_reports'; // ili 'reports' ako koristiš to
}
