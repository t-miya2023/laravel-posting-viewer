@extends('layouts.admin')

@section('content')



<div class="container">

    <h2 class="mb-3">【管理画面】</h2>
        <div class="row justify-content-center">
            <div class="col-6">
                <ul style="list-style:none">
                    <li class="border-bottom p-3 text-center"><a class="text-decoration-none fs-3 text-black" href="{{route('dashboard.shops.index')}}">店舗管理</a></li>
                    <li class="border-bottom p-3 text-center"><a class="text-decoration-none fs-3 text-black"href="{{route('dashboard.users.index')}}">ユーザー管理</a></li>
                    <li class="border-bottom p-3 text-center"><a class="text-decoration-none fs-3 text-black"href="{{route('dashboard.genres.index')}}">ジャンル管理</a></li>
                    <li class="border-bottom p-3 text-center"><a class="text-decoration-none fs-3 text-black"href="{{route('dashboard.reviews.index')}}">レビュー管理</a></li>
                </ul>
            </div>

        </div>
</div>

    @endsection