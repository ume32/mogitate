<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Season;
use App\Models\Product;

class SeasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 季節データの作成
        $seasons = ['春', '夏', '秋', '冬'];

        foreach ($seasons as $season) {
            Season::create(['name' => $season]);
        }

        // 例としてProductとSeasonsを関連付け
        $product = Product::first(); // 既存の商品を取得、もしくは最初の1つ
        if ($product) {
            $seasonIds = Season::pluck('id'); // 全季節のIDを取得
            $product->seasons()->sync($seasonIds); // 多対多で関連付け
        }
    }
}
