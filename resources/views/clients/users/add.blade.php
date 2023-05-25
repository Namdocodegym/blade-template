@extends('layouts.client')
@section('title')
    {{ $title }}
    
@endsection

@section('content')
    @if (session('msg'))
        <div class="alert alert-success">{{ session('msg') }}</div>
    @endif
    <h1>{{ $title }}</h1>

    @if ($errors->any())
        <div class="alert alert-success">再度入力してください</div>
    @endif

    <form action="" method="POST">
        <div class="mb-3">
            <label for="">ユーザ名</label>
            <input type="text" class="form-control" name="fullname" placeholder="名前" value="{{ old('fullname') }}">
            @error('fullname')
                <span style="color: red">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="">メール</label>
            <input type="text" class="form-control" name="email" placeholder="メール" value="{{ old('email') }}">
            @error('email')
                <span style="color: red">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">登録</button>
        <a href="/users" class="btn btn-warning">戻る</a>
        @csrf
    </form>

@endsection