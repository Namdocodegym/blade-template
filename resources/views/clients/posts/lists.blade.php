@extends('layouts.client')
@section('title')
    {{ $title }}
@endsection

@section('content')
    @if (session('msg'))
        <div class="alert alert-success">{{ session('msg') }}</div>
    @endif
    <h1>{{ $title }}</h1>
    <form action="{{ route('posts.delete-any') }}" method="POST" onsubmit="return confirm('削除しますか？')">
   <button type="submit" class="btn btn-danger">削除(0)</button></button>
   <hr>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th width="5%">
                    <input type="checkbox" id="checkAll">
                </th>
                <th width="5.5%">番号</th>
                <th>タイトル</th>
                <th width="15%">状態</th>
                <th width="15%">回復・強制削除</th>

            </tr>
        </thead>
        <tbody>
            @if ($allPosts->count()>0)
            @foreach ($allPosts as $key =>$item)
                 <tr>
                <td><input type="checkbox" name="delete[]" value="{{ $item->id }}"></td>
                <td>{{ $key +1 }}</td>
                <td>{{ $item->title }}</td>
                <td>
                    @if ($item->trashed())
                    <button class="btn btn-danger">削除済み</button>
                    @else
                    <button class="btn btn-success">削除</button>   
                    @endif
                </td>
                <td>
                    @if ($item->trashed())
                    <a onclick="return confirm('回復しますか？')" href="{{ route('posts.restore',$item) }}" class="btn btn-primary">回復</a>
                    <a onclick="return confirm('強制削除しますか？')" href="{{ route('posts.force-delete',$item) }}" class="btn btn-danger">強制削除</a>
                        
                    @endif
                </td>
            </tr>
            @endforeach
                
            @endif
           

        </tbody>
    </table>
    @csrf
</form>
@endsection
