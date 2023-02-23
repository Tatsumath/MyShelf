<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    public function categoryPost(){
        return $this->hasMany(CategoryPost::class);
    }
    public function user(){

        return $this->belongsTo(User::class);
    }

    //↓Add later
    // public function comments(){
    //     return $this->hasMany(Comment::class);
    // }


    // public function likes(){
    //     return $this->hasMany(Like::class);
    // }

    // public function isLiked(){
    //     return $this->likes()->where('user_id',Auth::user()->id)->exists();
    // }
}
