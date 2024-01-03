@extends('layouts.admin')

@section('content')



<div class="container">

    <h2 class="mb-3">【管理画面】アカウント情報編集</h2>
        <div class="row justify-content-center">
            <div class="col-6">
                <form method="POST" action="{{ route('dashboard.users.update',$user->id) }}" >
                    @csrf
                    @method('PATCH')
                    <label for="name" class="mb-2">氏名</label>
                    <input type="text" id="name" name="name" value="{{$user->name}}" class="form-control mb-3">
                    <label for="email" class="mb-2">メールアドレス</label>
                    <input type="text" id="email" name="email" value="{{$user->email}}" class="form-control mb-3">
                    <button type="submit" class="btn btn-primary">更新</button>
                    <a href="{{route('dashboard.users.index')}}" class="btn btn-warning mx-5">戻る</a>
                </form>
            </div>
        </div>
</div>

    @endsection