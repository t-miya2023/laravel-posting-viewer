@extends('layouts.admin')

@section('content')



<div class="container">
<div class="d-flex justify-content-between mb-3">
        <h2 class="mb-3">【管理画面】{{$shop->shop_name}}のメニュー一覧</h2>
        <a class="btn btn-warning" href="{{route('dashboard.shops.index')}}">
            <i class="bi bi-backspace fs-4"></i><span class="mx-2">店舗管理画面へ戻る</span>
        </a>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <a class="btn btn-primary d-block btn-lg mb-5" href="{{route('shops.menus.create',$shop->id) }}">メニュー登録</a>
        </div>
    </div>
    <div class="row justify-content-center">
        @if(session('message'))
            <p class="text-success text-center">{{ session('message') }}</p>
        @endif
            <table class="col-6">
                <tr class="border-bottom mb-5">
                    <th>メニュー名</th>
                    <th>価格</th>
                    <th class="text-center">編集</th>
                    <th class="text-center">削除</th>
                </tr>
                @foreach ($menus as $menu)
                <tr class="mb-5">
                    <th>{{$menu->menu}}</th>
                    <th>{{ number_format($menu->price) }}</th>
                    <th class="text-center"><a class="btn btn-primary" href="{{route('shops.menus.edit',[$shop->id,$menu->id])}}"><i class="bi bi-pencil fs-5 text-white"></i></a></th>
                    @include('menus.delete')
                    <th class="text-center"><button class="btn btn-danger" type="submit" data-bs-toggle="modal" data-bs-target="#deleteMenuModal{{$menu->id}}"><i class="bi bi-trash fs-5 text-white"></i></button></th>
                </tr>
                @endforeach
            </table>
    </div>
    @endsection