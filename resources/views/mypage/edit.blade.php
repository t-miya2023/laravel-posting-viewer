@extends('layouts.app')

@section('content')



<div class="container">

    <h2 class="mb-3">【マイページ】アカウント情報編集</h2>
    <div class="row justify-content-center">
        <div class="col-6">
            <form method="POST" action="{{ route('mypage.update',$user->id) }}">
                @csrf
                @method('PATCH')
                @if($page == 'name')
                <label for="name" class="mb-2">氏名</label>
                <input type="text" id="name" name="name" value="{{$user->name}}" class="form-control mb-3">

                @error('name')
                <p class="text-danger">{{ $message }}</p>
                @enderror
                @elseif($page == 'email')
                <label for="email" class="mb-2">メールアドレス</label>
                <input type="text" id="email" name="email" value="{{$user->email}}" class="form-control mb-3">
                @error('email')
                <p class="text-danger">{{ $message }}</p>
                @enderror
                @elseif($page == 'password')
                @if(session('say'))
                <div class="alert alert-danger">
                    {{ session('say') }}
                </div>
                @endif
                <label for="currentpassword" class="mb-2">現在のパスワード</label>
                <input type="password" name="currentpassword" class="form-control mb-3">
                <label for="password" class="mb-2">新しいパスワード</label>
                <input type="password" name="password" class="form-control mb-3">
                <label for="confirmpassword" class="mb-2">新しいパスワード(確認用)</label>
                <input type="password" name="confirmpassword" class="form-control mb-3">
                @error('password')
                <p class="text-danger">{{ $message }}</p>
                @enderror
                @endif
                <input type="hidden" name="page" value="{{$page}}">
                <button type="submit" class="btn btn-primary" disabled>更新</button>
                <a href="{{route('mypage.show',$user->id)}}" class="btn btn-warning mx-5">戻る</a>
            </form>
        </div>

    </div>
</div>

@endsection