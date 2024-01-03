<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\User;
use App\Models\Shop;
use Illuminate\Http\Request;

class AdminReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $reviews = Review::with('shop','user')->orderby('updated_at','desc')->get();
        
        return view('dashboard.reviews.index',compact('reviews'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        $review->delete();

        return redirect()->route('dashboard.reviews.index');
    }

    
    //お店のレビュー一覧
    public function shopReviews(Shop $shop)
    {
        $reviews = Review::where('shop_id', $shop->id)->get();
        return view('dashboard.shops.shop_reviews',compact('reviews','shop'));
    }

    public function toggleStatus($id)
    {
    $review = Review::find($id);

    if (!$review) {
        return response()->json(['error' => 'Review not found'], 404);
    }

    // Statusを切り替える
    $review->status = !$review->status;
    $review->save();

    return response()->json(['newStatus' => $review->status]);
    }   
}
