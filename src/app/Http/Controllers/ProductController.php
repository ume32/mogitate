<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\Season;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // 検索機能
        $query = Product::query();
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // 並び替え機能
        if ($request->filled('sort')) {
            if ($request->sort === 'asc') {
                $query->orderBy('price', 'asc'); // 低い順
            } elseif ($request->sort === 'desc') {
                $query->orderBy('price', 'desc'); // 高い順
            }
        }

        $products = $query->paginate(6);

        return view('products.index', [
            'products' => $products,
            'search' => $request->search,
            'sort' => $request->sort,
        ]);
    }

    public function show($id)
    {
        $product = Product::with('seasons')->findOrFail($id);
        return view('products.show', ['product' => $product]);
    }

    public function create()
    {
        $seasons = Season::all();
        return view('products.create', ['seasons' => $seasons]);
    }

    public function store(ProductRequest $request)
    {
        // 入力値のバリデーション
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0|max:10000',
            'image' => 'required|image|mimes:jpeg,png|max:2048',
            'description' => 'required|string|max:120',
            'seasons' => 'required|array',
            'seasons.*' => 'exists:seasons,name', // 季節名がseasonsテーブルに存在するか確認
        ]);

        // 画像保存
        $imagePath = $request->file('image')->store('images', 'public');

        // 商品登録
        $product = Product::create([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'description' => $validated['description'],
            'image' => $imagePath,
        ]);

        // 季節の紐付け（名前からIDを取得して紐付け）
        $seasonIds = Season::whereIn('name', $validated['seasons'])->pluck('id')->toArray();
        $product->seasons()->sync($seasonIds);

        return redirect()->route('products.index')->with('success', '商品を登録しました');
    }

    public function update(ProductRequest $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0|max:10000',
            'seasons' => 'required|array',
            'seasons.*' => 'exists:seasons,name', // 季節名が正しいか確認
            'description' => 'required|string|max:120',
        ]);

        // 商品情報の更新
        $product->update([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'description' => $validated['description'],
        ]);

        // 季節の紐付け（名前からIDを取得して更新）
        $seasonIds = Season::whereIn('name', $validated['seasons'])->pluck('id')->toArray();
        $product->seasons()->sync($seasonIds);

        return redirect()->route('products.index')->with('success', '商品情報を更新しました！');
    }

    public function updateImage(Request $request, Product $product)
    {
        $validated = $request->validate([
            'image' => 'required|image|mimes:jpeg,png|max:2048',
        ]);

        // 画像保存
        $path = $request->file('image')->store('images', 'public');
        $product->update(['image' => $path]);

        return back()->with('success', '商品画像を更新しました！');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', '商品を削除しました！');
    }
}
