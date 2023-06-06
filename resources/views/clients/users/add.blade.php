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
        <div class="alert alert-danger">再度入力してください</div>
    @endif

    <form action="" method="POST">
        <div class="mb-3">
            <label for="">ユーザ名</label>
            <input type="text" class="form-control" name="name" placeholder="名前" value="{{ old('name') }}">
            @error('name')
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

        <div class="mb-3">
            <label for="">グループ</label>
            <select name="group_id" class="form-control" id="">
                <option value="0">グループ選ぶ</option>
                @if (!empty($allGroups))
                    @foreach ($allGroups as $item)
                        <option value="{{ $item->id }}" {{ old('group_id')==$item->id?'selected':'' }}>
                            {{ $item->name }}</option>
                    @endforeach
                @endif
            </select>
            @error('group_id')
                <span style="color: red">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="">状態</label>
            <select name="status" class="form-control" id="">
                <option value="0" {{ old('status')==0?'selected':'' }}>inactive</option>
                <option value="1" {{ old('status')==1?'selected':'' }}>active</option>
                
                
            </select>
           
        </div>

        <button type="submit" class="btn btn-primary">登録</button>
        <a href="/users" class="btn btn-warning">戻る</a>
        @csrf
    </form>

@endsection
