@extends('layouts.client')
@section('title')
    {{$title}}
@endsection

@section('sidebar')
    @parent
    <h1>Product sidebar</h1>
@endsection

@section('content')
    <h1>Product</h1>
    <x-alert type='info' content='ご注文ありがとうございました。' data-icon="check"></x-alert>
    {{-- @prepend đẩy nội dung mới lên trên  --}}
    @prepend('scripts')
        <script>
            console.log('put 2')
        </script>
    @endprepend
@endsection

@section('css')
   
@endsection

@section('js')
  
@endsection

{{-- @push đẩy nội dung mới xuống dưới --}}
@push('scripts') 
<script>
    console.log('put 1')
</script>  
@endpush


