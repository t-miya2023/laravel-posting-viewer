<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    public function reviews(){
        return $this->hasMany(Review::class);
    }

    public function genres(){
        return $this->belongsToMany(Genre::class)->withTimestamps();
    }

    public function menus(){
        return $this->hasMany(Menu::class);
    }

    protected $fillable = [
        'shop_name',
        'post_code',
        'prefecture',
        'address',
        'tel',
        'shop_email',
        'business_hours',
        'holidays',
        'genre_id',
    ];

}
