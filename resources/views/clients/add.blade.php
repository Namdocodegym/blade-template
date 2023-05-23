@extends('layouts.client')
@section('title')
    {{ $title }}
@endsection                

@section('content')
    <h1>商品追加</h1>
    <form action="" method="POST">
        {{-- @if ($errors ->any())
        <div class="alert alert-danger text-center">
           {{ $errorMessage }}
        </div>
            
        @endif --}}

        @error('msg')
            <div class="alert alert-danger text-center">
                {{ $message }}
            </div>
        @enderror
        <div class="mb-3">
            <label for="">品名</label>
            {{-- value="{{ old('product_price') }} mang ý nghĩa giữ lại nội dung đã nhập  --}}
            <input type="text" class="form-control" name="product_name" placeholder="品名..." value="{{ old('product_name') }}">
            @error('product_name')
                <p style="color: red">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="">値段</label>
            {{-- value="{{ old('product_price') }} mang ý nghĩa giữ lại nội dung đã nhập  --}}
            <input type="text" class="form-control" name="product_price" placeholder="値段..." value="{{ old('product_price') }}">
            @error('product_price')
                <p style="color: red">{{ $message }}</p>
            @enderror
        </div>



        @csrf
        <button type="submit" class="btn btn-primary">登録</button>
    </form>
@endsection