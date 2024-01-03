@extends('layouts.admin')

@section('content')

<div class="container">
    <h2 class="mb-3">【管理画面】メニュー編集</h2>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <form method="POST" action="{{ route('shops.menus.update',[$shop->id,$menu->id]) }}" id="menu-form">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="mb-2 col-md-8">
                        <label class="form-label" for="menu">メニュー名</label>
                        <input class="form-control" type="text" name="menu" value="{{ $menu->menu }}">
                    </div>
                    <div class="mb-2 col-md-4">
                        <label class="form-label" for="price[]">価格</label>
                        <input class="form-control" type="text" name="price" value="{{ $menu->price }}">
                    </div>
                </div>
                <button class="btn btn-primary mt-3" id="submit-btn" type="submit">更新</button>
                <a class="btn btn-warning mt-3 mx-3" href="{{ route('shops.menus.index',$shop->id) }}">戻る</a>
            </form>
        </div>
    </div>
</div>

@endsection
