<?php

namespace App\Http\Controllers;
use App\Models\Shop;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reviews = Review::where('user_id',auth()->id())->get();
        return view('reviews.index',['reviews' => $reviews]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Shop $shop)
    {
    // ユーザーが特定の店舗に対してすでにレビューを投稿しているか確認
        $existingReview = Review::where('user_id', Auth::id())
        ->where('shop_id', $shop->id)
        ->first();

        if ($existingReview) {
        // レビューが存在する場合、編集ページにリダイレクト
            return redirect()->route('shops.reviews.edit', ['shop' => $shop->id,'review' => $existingReview]);

        }else{
            return view('reviews.create',compact('shop'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Shop $shop)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'rating' => 'required',
        ]);

        $review = new Review();
        $review->user_id = Auth::id();
        $review->shop_id = $shop->id;
        $review->title = $request->input('title');
        $review->content = $request->input('content');
        $review->rating = $request->input('rating');
        $review->status = false;

        $review->save();

        return redirect()->route('shops.show',$shop->id)->with('message','口コミの投稿ありがとうございます。承認されるまで少しお時間がかかります。');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user = Auth::id();
        $reviews = Review::where('user_id',$user)->get();
        return view('reviews.show',compact('review'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Shop $shop,Review $review)
    {
        return view('reviews.edit',compact('shop','review'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Shop $shop,Review $review)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'rating' => 'required',
        ]);

        $review->user_id = Auth::id();
        $review->shop_id = $shop->id;
        $review->title = $request->input('title');
        $review->content = $request->input('content');
        $review->rating = $request->input('rating');
        $review->status = false;

        $review->save();

        return redirect()->route('shops.show',$shop->id)->with('message','口コミの投稿ありがとうございます。承認されるまで少しお時間がかかります。');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shop $shop,Review $review,)
    {
        $review->delete();

        return redirect()->route('shops.show',$shop->id);
    }

    //ユーザーのレビュー一覧
    public function UserReviews(User $user)
    {   
        $currentUser = Auth::user();//現在ログイン中のユーザ情報取得
        $reviews = Review::where('user_id',$currentUser->id)
            ->with('shop')
            ->get();
        return view('reviews.user_reviews',compact('reviews','user'));
    }
    //お店のレビュー一覧
    public function shopReviews(Shop $shop)
    {
        $reviews = Review::where('shop_id', $shop->id)->where('status',true)->get();
        $averageRating = number_format($shop->reviews()->where('status', true)->avg('rating'), 1);
        return view('shops.shop_reviews',compact('reviews','shop','averageRating'));
    }
}
