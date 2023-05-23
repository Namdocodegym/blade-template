@extends('layouts.client')
@section('title')
    {{$title}}
@endsection

@section('sidebar')
    @parent
    <h1>Show sidebar</h1>
@endsection

@section('content')
{{-- câu lệnh if dùng để hiển thị thông báo và thiết lập màu nền --}}
  {{-- @if (section('msg'))
      <div class="alert alert-{{ session('type') }}">
          {{ session('msg') }}
      </div>
  @endif --}}
  <h1>HOME</h1>
  @datetime('')
  
@include('clients.contents.slide')
@include('clients.contents.about') 
{{-- các câu lệnh dưới được gọi và tái sử dụng nhiều lần trong các trang.được tạo từ component --}}
<x-alert type='info' content='ご注文ありがとうございました。' data-icon="check"></x-alert> 
<x-inputs.button></x-inputs.button>
<x-forms.button></x-forms.button>

<p><img src="https://nextmake.site/wp-content/themes/nextmake2020/img/fd5fde95b59fa1a16bfa30e2c8e38844_m.jpg" alt=""></p>
<p><a href="{{ route('download-image').'?image=https://nextmake.site/wp-content/themes/nextmake2020/img/fd5fde95b59fa1a16bfa30e2c8e38844_m.jpg' }}" class="btn btn-primary">Download </a></p>
{{-- <p><a href="{{ route('download-image').'?image='.asset('storage/hinh-nen-la-cay-full-hd-840x473.jpg') }}" class="btn btn-primary">Download </a></p> --}}
@endsection






@section('css')
  <style>
    img{
      max-width: 100%;
      height: auto;
    }
  </style>
@endsection

@section('js')
 
@endsection


