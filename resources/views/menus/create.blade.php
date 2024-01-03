@extends('layouts.admin')

@section('content')

<div class="container">
    <h2 class="mb-3">【管理画面】メニュー登録</h2>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <button class="btn btn-secondary mb-3" type="bottun" id="addition-btn">+追加</button>
            <form method="POST" action="{{ route('shops.menus.store',$shop->id) }}" id="menu-form">
                @csrf
                <div class="row">
                    <div class="mb-2 col-md-8">
                        <label class="form-label" for="menu[]">メニュー名</label>
                        <input class="form-control" type="text" name="menu[]">
                    </div>
                    <div class="mb-2 col-md-4">
                        <label class="form-label" for="price[]">価格</label>
                        <input class="form-control" type="text" name="price[]">
                    </div>
                    @if(session('error'))
                        <p class="text-danger">{{ session('error') }}</p>
                    @endif
                </div>
                <button class="btn btn-primary mt-3" id="submit-btn" type="submit">作成</button>
                <a class="btn btn-warning mt-3 mx-3" href="{{ route('shops.menus.index',$shop->id) }}">戻る</a>
            </form>
        </div>
    </div>
</div>

@endsection

@section('script')
    <script src="{{asset('js/add-form.js')}}"></script>
@endsection