@extends('layouts.admin')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="POST" action="{{ route('dashboard.genres.store') }}">
                @csrf
                <div class="mb-5">
                    <label class="form-label" for="title">ジャンル</label>
                    <input class="form-control" type="text" name="title">
                    @error('title')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <button class="btn btn-primary" type="submit">作成</button>
            </form>
        </div>
    </div>
</div>
@endsection