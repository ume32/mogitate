@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/show.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="breadcrumb">
        <a href="{{ route('products.index') }}">商品一覧</a> > {{ $product->name }}
    </div>

    <div class="product-detail">
        <div class="product-image">
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
            <form action="{{ route('products.updateImage', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <input type="file" name="image">
                <button type="submit">変更を保存</button>
                @error('image')
                <p class="error">{{ $message }}</p>
                @enderror
            </form>
        </div>

        <form action="{{ route('products.update', $product->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="product-info">
                <div class="form-group">
                    <label for="name">商品名</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" placeholder="商品名を入力">
                    @error('name')
                    <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="price">値段</label>
                    <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}" placeholder="値段を入力">
                    @error('price')
                    <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label>季節</label>
                    <x-season-checkbox name="seasons" :selectedSeasons="$product->seasons->pluck('name')->toArray()" />
                    @error('seasons')
                    <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                <label for="description">商品説明</label>
                    <x-textarea 
                        name="description" 
                        label="商品説明" 
                        placeholder="商品の説明を入力" 
                        :value="old('description', $product->description)" 
                        helperText="" 
                    />
                </div>

                <div class="form-actions">
                    <a href="{{ route('products.index') }}" class="btn btn-secondary">戻る</a>
                    <button type="submit" class="btn btn-primary">変更を保存</button>
                </div>
            </div>
        </form>

        <form action="{{ route('products.destroy', $product->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">
                <img src="{{ asset('images/trash-icon.png') }}" alt="削除">
            </button>
        </form>
    </div>
</div>
@endsection
