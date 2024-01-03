<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function shop(){
        return $this->belongsTo(Shop::class);
    }

    protected $fillable = [
        'user_id',
        'shop_id',
        'title',
        'content',
        'rating',
        'status'   
    ];
}
