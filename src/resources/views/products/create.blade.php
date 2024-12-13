@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/create.css') }}">
@endsection

@section('content')
<div class="container">
    <h1>商品登録</h1>
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">商品名 <span class="required">必須</span></label>
            <input type="text" id="name" name="name" placeholder="商品名を入力" value="{{ old('name') }}">
            @error('name')
            <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="price">値段 <span class="required">必須</span></label>
            <input type="number" id="price" name="price" placeholder="値段を入力" value="{{ old('price') }}">
            @error('price')
            <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="image">商品画像 <span class="required">必須</span></label>
            <input type="file" id="image" name="image" accept="image/*" onchange="previewImage(event)">
            <img id="preview" src="#" alt="プレビュー画像" style="display:none;">
            @error('image')
            <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label>季節 <span class="required">必須</span> <span class="optional" style="color: red;">複数選択可</span></label>
            <div class="checkbox-group">
                <x-season-checkbox name="seasons" />
            </div>
        </div>
        <div class="form-group">
            <div class="label-group">
                <label for="description">商品説明</label>
                <span class="required">必須</span>
            </div>
            <x-textarea
            name="description" 
            placeholder="商品の説明を入力" 
            :value="old('description')" 
            helperText="120文字以内で入力してください"/>
        </div>


        <div class="form-buttons">
            <a href="{{ route('products.index') }}" class="btn btn-back">戻る</a>
            <button type="submit" class="btn btn-submit">登録</button>
        </div>
    </form>
</div>

<script>
    function previewImage(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('preview');

        if (file) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }

            reader.readAsDataURL(file);
        }
    }
</script>
@endsection
