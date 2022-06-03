<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'user_id',
        'title',
        'content',
        'image'
    ];

    protected $appends = ['image_path'];

    public function user() {
        return $this->belongsTo(User::class);
    }
    public function category() {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }



    public function getImagePathAttribute()
    {
        if ($this->image) {
            return asset('public/Image/' . $this->image);
        } else {
            return asset('public/Image/no-image.png');
        }
    }


    protected $casts = [
        'created_at' => "datetime:Y-m-d h:i:s",
        'updated_at' => "datetime:Y-m-d h:i:s",
    ];
}