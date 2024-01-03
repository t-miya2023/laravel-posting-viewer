@extends('layouts.admin')

@section('content')



<div class="container">
<div class="d-flex justify-content-between mb-3">
        <h2 class="mb-3">【管理画面】ジャンル一覧</h2>
        <a class="btn btn-warning" href="{{route('dashboard')}}">
            <i class="bi bi-backspace fs-4"></i><span class="mx-2">管理画面メニューへ戻る</span>
        </a>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <a class="btn btn-primary d-block btn-lg mb-5" href="{{route('dashboard.genres.create') }}">ジャンル登録</a>
        </div>
    </div>
    <div class="row justify-content-center">
            <table class="col-6">
                <tr class="border-bottom mb-5">
                    <th>ジャンルID</th>
                    <th>ジャンル名</th>
                    <th class="text-center">削除</th>
                </tr>
                @foreach ($genres as $genre)
                <tr class="mb-5">
                    <th>{{$genre->id}}</th>
                    <th>{{$genre->title}}</th>
                    @include('dashboard.genres.delete')
                    <th class="text-center"><button class="btn btn-danger" type="submit" data-bs-toggle="modal" data-bs-target="#deleteGenreModal{{$genre->id}}"><i class="bi bi-trash fs-5 text-white"></i></button></th>
                </tr>
                @endforeach
            </table>
    </div>
    @endsection