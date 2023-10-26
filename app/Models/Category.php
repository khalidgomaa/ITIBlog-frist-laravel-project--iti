<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
use App\Models\User;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'user_id', 'logo'];



    public function Posts()
    {
        return $this->hasMany(Post::class);
    }
    public function user()
    {
        return $this->belongsTo(user::class);
    }
}
