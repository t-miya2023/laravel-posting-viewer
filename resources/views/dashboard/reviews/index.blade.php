@extends('layouts.admin')

@section('content')



<div class="container">
    <div class="d-flex justify-content-between mb-3">
        <h2 class="mb-3">【管理画面】レビュー一覧</h2>
        <a class="btn btn-warning" href="{{route('dashboard')}}">
            <i class="bi bi-backspace fs-4"></i><span class="mx-2">管理画面メニューへ戻る</span>
        </a>
    </div>
    <div class="row">
        <table>
            <div class="col-12">
                <tr class="border-bottom">
                    <th>投稿ID</th>
                    <th>投稿者名</th>
                    <th>店舗名</th>
                    <th>タイトル</th>
                    <th>レビュー内容</th>
                    <th>点数</th>
                    <th>投稿日時</th>
                    <th>投稿ステータス</th>
                    <th class="text-center">削除</th>
                </tr>


                @foreach ($reviews as $review)
                <tr class="mb-5 border-bottom">
                    <td>{{$review->id}}</td>
                    <td>{{$review->user->name}}</td>
                    <td>{{$review->shop->shop_name}}</td>
                    <td>{{$review->title}}</td>
                    <td class="review-container">
                        @if(strlen($review->content) > 100)
                        <span class="reviewTextShort">{{ Str::limit($review->content,100) }}</span>
                        <span class="reviewTextFull" style="display:none">{{ $review->content }}</span>
                        <button class="btn btn-sm btn-outline-primary showMore">続きを読む</button>
                        @else
                        <span>{{ $review->content }}</span>
                        @endif
                    </td>
                    <td>{{$review->rating}}</td>
                    <td>{{$review->created_at}}</td>
                    <td><span class="status-toggle" data-review-id="{{ $review->id }}" data-status="{{ $review->status }}">{{ $review->status ? '承認' : '未承認' }}</span></td>
                    @include('dashboard.reviews.delete')
                    <td class="text-center"><button class="btn btn-danger" type="submit" data-bs-toggle="modal" data-bs-target="#deleteReviewModal{{ $review->id }}"><i class="bi bi-trash fs-5 text-white"></i></button></td>
                </tr>
                @endforeach
            </div>
        </table>
    </div>
    
    @endsection

    @section('script')
    <script src="{{ asset('js/show-more.js') }}"></script>
    <script src="{{ asset('js/review-status.js') }}"></script>
    @endsection