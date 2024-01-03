@extends('layouts.app')

@section('content')

<div class="container">
    <h2 class="mb-3">【マイページ】</h2>
    <div class="row justify-content-center">
        <div class="col-6">
            <ul class="list-unstyled">
                <li class="p-3 border-bottom text-center">
                    <a class="text-decoration-none fs-3 text-black"href="{{ route('mypage.show', $user->id) }}">アカウント設定</a>
                </li>
                <li class="p-3 border-bottom text-center">
                    <a class="text-decoration-none fs-3 text-black" href="{{ route('user.reviews', $user->id) }}">レビュー管理</a>
                </li>
                @include('mypage.delete')
                <li class="text-decoration-none fs-3 text-black p-3 border-bottom text-center" type="button" data-bs-toggle="modal" data-bs-target="#deleteUserModal{{ $user->id }}">退会</class=>
            </ul>
        </div>
    </div>
</div>
@endsection
