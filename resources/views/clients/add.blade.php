@extends('layouts.client')
@section('title')
    {{ $title }}
@endsection                

@section('content')
    <h1>商品追加</h1>
    <form action="" method="POST">
        <div class="mb-3">
            <label for="">品名</label>
            <input type="text" class="form-control" name="product_name" placeholder="品名...">
        </div>

        <div class="mb-3">
            <label for="">値段</label>
            <input type="text" class="form-control" name="product_price" placeholder="値段...">
        </div>



        @csrf
        <button type="submit" class="btn btn-primary">登録</button>
    </form>
@endsection