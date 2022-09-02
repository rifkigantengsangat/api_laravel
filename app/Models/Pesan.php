<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesan extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class)->select('id','name','email');
    }
    public function post()
    {
        return $this->belongsTo(Post::class,'id','categories_id');
    }
}
