@extends('layouts.app')

@section('content')



<div class="container">

    <h2 class="mb-3">【マイページ】アカウント情報</h2>
        <div class="row justify-content-center">
            <div class="col-12">
                @if(session('update'))
                <div class="alert alert-success">
                    {{ session('update') }}
                </div>
                @endif
                <table class="mt-5">
                    <tr class="fs-4 border-bottom">
                        <th class="p-2">ユーザーID：</th>
                        <td class="p-2">{{$user->id}}</td>
                    </tr>
                    <tr class="fs-4 border-bottom">
                        <th class="p-2">氏名：</th>
                        <td class="p-2">{{$user->name}}</td>
                        <td><a class="btn btn-primary" href="{{route('mypage.useredit',['page'=>'name'])}}">編集する</a></td>
                    </tr>
                    <tr class="fs-4 border-bottom">
                        <th class="p-2">メールアドレス：</th>
                        <td class="p-2">{{$user->email}}</td>
                        <td><a class="btn btn-primary" href="{{route('mypage.useredit',['page'=>'email'])}}">編集する</a></td>
                    </tr>
                    <tr class="fs-4 border-bottom">
                        <th class="p-2">パスワード：</th>
                        <td class="p-2">********</td>
                        <td><a class="btn btn-primary" href="{{route('mypage.useredit',['page'=>'password'])}}">編集する</a></td>
                    </tr>
                    <tr class="fs-4 border-bottom">
                        <th class="p-2">更新日時：</th>
                        <td class="p-2">{{$user->updated_at}}</td>
                    </tr>
                    <tr class="fs-4 border-bottom">
                        <th class="p-2">登録日時：</th>
                        <td class="p-2">{{$user->created_at}}</td>
                    </tr>
                </table>
            </div>

        </div>
</div>

    @endsection