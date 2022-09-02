<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    public $appends = ['images'];
    public function getImagesAttribute()
  {
    return [
      'image' => $this->image,
      'url' => asset('images') . '/' . $this->image,
    ];
  }
    protected $fillable = [
    ];
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function messsages()
    {
        return $this->hasMany(Pesan::class);
    }
    public function categories()
    {
      return $this->belongsTo(Categori::class)->select('id','name','slug');
    }
   
}
