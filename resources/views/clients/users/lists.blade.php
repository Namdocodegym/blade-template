@extends('layouts.client')
@section('title')
    {{ $title }}
    
@endsection

@section('content')
    @if (session('msg'))
        <div class="alert alert-success">{{ session('msg') }}</div>
    @endif
    <h1>{{ $title }}</h1>

    <a href="{{ route('users.add') }}" class="btn btn-primary">新規登録</a>
    <hr>
    <form action="" method="get" class="mb-3">
        <div class="row">
            <div class="col-3">
                <select class="form-control">
                    <option value="0">all status</option>
                    <option value="active" {{ request()->status=='active'?'selected':false }}>active</option>
                    <option value="inactive"{{ request()->status=='inactive'?'selected':false }}>inactive</option>
                </select>
            </div>
            <div class="col-3">
                <select class="form-control" name="group_id">
                    <option value="0">Group All</option>
                    @if (!empty(getAllGroups()))
                        @foreach (getAllGroups as $item)
                            <option value="{{ $item->id }}"{{ request()->group_id==$item->id?'selected':false }}>{{ $item->name }}</option>
                        @endforeach
                    @endif
                        
                    @endif
                </select>
            </div>

            <div class="col-4">
                <input type="search" name="keywords" class="form-control" placeholder="検索" value="{{ request()->keywords }}">
            </div>
            
            <div class="col-2">
                <button type="submit" class="btn btn-primary btn-block">Search</button>
            </div>
        </div>
    </form>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th width="10%">番号</th>
                <th>名前</th>
                <th>メール</th>
                <th>グループ</th>
                <th>Status</th>
                <th width="15%">時間</th>
                <th with="5%">編集</th>
                <th with="5%">削除</th>
                
            </tr>
        </thead>
        <tbody>
            
            @if (!empty($usersList))
            @foreach ($usersList as $key=>$item)
            <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->group_name }}</td>
                <td>{{ !!$item->status==0?'<button class="btn btn-danger btn-sm">inactive</button>':
                '<button class="btn btn-success btn-sm">active</button>' !!}}</td>
                <td>{{ $item->created_at }}</td>
                <td>
                    <a href="{{ route('users.edit',['id'=>$item->id]) }}" class="btn btn-warning btn-sm">編集</a>
                </td>
                <td>
                    <a onclick="return confirm('削除しますか？')" href="{{ route('users.delete',['id'=>$item->id]) }}" class="btn btn-danger btn-sm">削除</a>
                </td>

            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="6">ユーザがない</td>
            </tr>
            @endif
        </tbody>
    </table>

@endsection