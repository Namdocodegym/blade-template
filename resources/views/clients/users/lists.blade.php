@extends('layouts.client')
@section('title')
    {{ $title }}
    
@endsection

@section('content')
    @if (session('msg'))
        <div class="alert alert-success">{{ session('msg') }}</div>
    @endif
    <h1>{{ $title }}</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th width="10%">番号</th>
                <th>名前</th>
                <th>メール</th>
                <th width="15%">時間</th>
            </tr>
        </thead>
        <tbody>
            @if (!empty($users))
            @foreach ($users as $key=>$item)
            <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->created_at }}</td>
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="4">ユーザがない</td>
            </tr>
            @endif
        </tbody>
    </table>

@endsection