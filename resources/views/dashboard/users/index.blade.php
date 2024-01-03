@extends('layouts.admin')

@section('content')



<div class="container">

    <div class="d-flex justify-content-between mb-3">
        <h2 class="mb-3">【管理画面】ユーザー一覧</h2>
        <a class="btn btn-warning" href="{{route('dashboard')}}">
            <i class="bi bi-backspace fs-4"></i><span class="mx-2">管理画面メニューへ戻る</span>
        </a>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-6 ">
            <h3>検索</h3>
            <form class="mb-5" action="{{ route('dashboard.users.index') }}" method="GET">
                <div class="form-group">
                    <label for="name">ユーザー名：</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ request('name') }}">
                </div>
                <div class="form-group mb-3">
                    <label for="id">ユーザーID：</label>
                    <input type="text" name="id" id="id" class="form-control" value="{{ request('id') }}">
                </div>
                <button type="submit" class="btn btn-primary">絞り込む</button>
            </form>
        </div>
    </div>




    <div class="row">

        <table>
            <div class="col-12">
                <tr class="border-bottom">
                    <th>ユーザーID</th>
                    <th>ユーザー名</th>
                    <th>メールアドレス</th>
                    <th class="text-center">編集</th>
                    <th class="text-center">削除</th>
                </tr>


                @foreach ($users as $user)

                <tr class="mb-5">
                    <th>{{$user->id}}</th>
                    <th>{{$user->name}}</th>
                    <th>{{$user->email}}</th>
                    <th class="text-center"><a class="btn btn-primary" href="{{ route('dashboard.users.edit', $user->id) }}"><i class="bi bi-pencil fs-5 text-white"></i></a></th>
                    @include('dashboard.users.delete')
                    <th class="text-center"><button class="btn btn-danger" type="submit" data-bs-toggle="modal" data-bs-target="#deleteUserModal{{ $user->id }}"><i class="bi bi-trash fs-5 text-white"></i></button></th>
                </tr>
                @endforeach
            </div>
        </table>

    </div>

    @endsection