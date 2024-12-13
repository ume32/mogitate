<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;
use App\Models\Season;

class ProductSeasonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_id' => Product::inRandomOrder()->first()->id,
            'season_id' => Season::inRandomOrder()->first()->id,
        ];
    }

    public function show($id)
    {
        $product = Product::with('seasons')->findOrFail($id);
        return view('products.show', ['product' => $product]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0|max:10000',
            'seasons' => 'required|array',
            'seasons.*' => 'string',
            'description' => 'required|string|max:120',
        ]);
        $product = Product::findOrFail($id);
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->description = $request->input('description');
        $product->save();
        $product->seasons()->sync($request->input('seasons')); // 中間テーブルを更新
        return redirect()->route('products.index')->with('success', '商品を更新しました！');
}


    public function updateImage(Request $request, $id)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png|max:2048',
        ]);
        $product = Product::findOrFail($id);
        $path = $request->file('image')->store('images', 'public');
        $product->image = $path;
        $product->save();
        return back()->with('success', '商品画像を更新しました！');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('products.index')->with('success', '商品を削除しました！');
    }
}
