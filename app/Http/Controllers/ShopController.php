<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Review;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;



class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Shop::query();

        $shop_name = $request->input('shop_name');
        $genreName = $request->input('title');
        $search_address = $request->input('search_address'); // 住所検索用のフォーム入力
        $prefecture = $request->input('selected_prefecture'); // クエリパラメーターから都道府県を取得


        //店舗名の検索
        if (!empty($shop_name)) {
            $query->where('shop_name', 'like', "%$shop_name%");
        }

        //ジャンルの検索
        if (!empty($genreName)) {
            $query->whereHas('genres', function ($query) use ($genreName) {
                $query->where('title', 'like', "%$genreName%"); // 'name'はジャンル名のカラムを想定
            });
        }

        //住所の検索
        if (!empty($search_address)) {
            // 'prefecture' または 'address' のどちらかが一致する場合に検索結果に含める　クエリー内でサブクエリーを設定し、同時検索できるようにしている
            $query->where(function ($query) use ($search_address) {
                $query->orWhere('prefecture', 'like', "%$search_address%")
                    ->orWhere('address', 'like', "%$search_address%");
            });
        }
        //都道府県から検索
        if(!empty($prefecture)){
            $query->where('prefecture',$prefecture);
        }

        //並び替え機能の実装
        $orderBy = $request->input('order_by','created_at');
        $orderDirection = $request->input('order_direction','desc');
        //新着順
        if($orderBy === 'created_at') {
            $query->orderBy('created_at',$orderDirection);

        }elseif($orderBy === 'review_count'){
            $query->withCount('reviews')
                ->orderBy('reviews_count',$orderDirection);

        }elseif($orderBy === 'rating_high'){
            $query->leftJoin('reviews', 'shops.id', '=', 'reviews.shop_id')
                ->selectRaw('shops.*, AVG(reviews.rating) as avg_rating')
                ->groupBy(
                    'shops.id',
                    'shops.shop_name',
                    'shops.shop_desc',
                    'shops.post_code',
                    'shops.prefecture',
                    'shops.address',
                    'shops.tel',
                    'shops.shop_email',
                    'shops.business_hours',
                    'shops.holidays',
                    'shops.shop_img',
                    'shops.created_at',
                    'shops.updated_at'
                    )
                ->orderBy('avg_rating', $orderDirection);
        }

        //ページネーション
        $shops = $query->paginate(10);

        // 各ショップの評価の平均を計算
        $averageRatings = [];
        foreach ($shops as $shop) {
        $averageRatings[$shop->id] = DB::table('reviews')
            ->where('shop_id', $shop->id)
            ->where('status',true)
            ->avg('rating');
        }
        // 各ショップの口コミ数を計算
        $reviewCounts = [];
        foreach ($shops as $shop) {
            $reviewCounts[$shop->id] = Review::where('shop_id', $shop->id)->count();
        }

        return view('shops.index', compact(
            'shops',
            'averageRatings',
            'reviewCounts',
        ));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function show(Shop $shop)
    {
        $genres = $shop->genres;
        $reviews = $shop->reviews()->where('status', true)->latest()->take(3)->get();
        $menus = $shop->menus()->take(3)->get();
        //平均点の取得
        $averageRating = number_format($shop->reviews()->where('status', true)->avg('rating'), 1);

        return view('shops.show', compact('shop', 'genres', 'reviews', 'menus', 'averageRating'));
    }
}
