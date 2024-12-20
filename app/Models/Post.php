<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function user(){
        return $this->belongsTo(User::class,"user");
    }

    public function category(){
        return $this->belongsTo(Category::class,"category_id");
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }
}
