@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="container">
    <h1>商品一覧</h1>
    <a href="/products/create" class="btn btn-add">+ 商品を追加</a>
</div>
    <div class="search-bar">
        <form class="search-form" action="{{ route('products.index') }}" method="GET"> <!-- 検索フォームのアクション -->
            <div class="search-form__item">
                <input class="search-form__item-input" type="text" name="search" placeholder="商品名で検索" value="{{ request('search') }}">
            </div>
            <div class="search-form__button">
                <button class="search-form__button-submit" type="submit">検索
                </button>
            </div>
        </form>
    </div>
    <div class="sort-bar">
        <form class="sort-form" action="{{ route('products.index') }}" method="GET"> <!-- 並び替えフォームのアクション -->
            <div class="sort-form__item">
                <!-- 検索キーワードを保持 -->
                <input type="hidden" name="search" value="{{ request('search') }}">
                <select class="sort-form__item-select" name="sort" onchange="this.form.submit()">
                    <option value="" disabled {{ request('sort') ? '' : 'selected' }}>価格順で並び替え</option>
                    <option value="asc" {{ request('sort') === 'asc' ? 'selected' : '' }}>低い順に表示</option>
                    <option value="desc" {{ request('sort') === 'desc' ? 'selected' : '' }}>高い順に表示</option>
                </select>
            </div>
        </form>
        @if(request('sort'))
        <div class="sort-tag">
            {{ request('sort') === 'asc' ? '低い順に表示' : '高い順に表示' }}
            <a href="{{ route('products.index', ['search' => request('search')]) }}" class="sort-tag__reset">×</a>
        </div>
        @endif
    </div>
    <div class="product-list">
        @foreach($products as $product)
        <a href="{{ route('products.show', $product->id) }}"> <!-- 詳細ページへのリンク -->
        <x-product-card
            :name="$product->name"
            :price="$product->price"
            :image="$product->image"
        />
        @endforeach
    </div>
    <div class="pagination">
    {{ $products->links() }}
    </div>
</div>
@endsection
