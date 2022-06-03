<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon;

class Category extends Model
{
    use HasFactory;
    protected $dates = ['created_at'];
    protected $dateFormat = 'Y-m-d h:i:s';

    protected $fillable = [
        'user_id',
        'name'  
    ];

    //relationship
    public function user() {
        return $this->belongsTo(User::class);
    }
    protected $casts = [
        'created_at' => "datetime:Y-m-d h:i:s",
        'updated_at' => "datetime:Y-m-d h:i:s",
    ];

   
}