<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function seasons()
    {
        return $this->belongsToMany(Season::class, 'product_season', 'product_id', 'season_id')->withPivot('id'); // 中間テーブルのデータも取得
    }
    protected $fillable = ['name', 'price', 'description', 'image']; // 必要なカラムを指定

}
