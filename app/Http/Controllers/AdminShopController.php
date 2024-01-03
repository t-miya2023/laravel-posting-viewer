<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Genre;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Requests\ShopRequest;
use Illuminate\Support\Facades\Config;


class AdminShopController extends Controller
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
        $shop_id = $request->input('id');
        $search_address = $request->input('search_address'); // 住所検索用のフォーム入力

        //店舗名の検索
        if (!empty($shop_name)) {
            $query->where('shop_name', 'like', "%$shop_name%");
        }

        //店舗IDの検索
        if (!empty($shop_id)) {
            $query->where('id', 'like', "%$shop_id%");
        }

        //住所の検索
        if (!empty($search_address)) {
            // 'prefecture' または 'address' のどちらかが一致する場合に検索結果に含める　クエリー内でサブクエリーを設定し、同時検索できるようにしている
            $query->where(function ($query) use ($search_address) {
                $query->orWhere('prefecture', 'like', "%$search_address%")
                    ->orWhere('address', 'like', "%$search_address%");
            });
        }


        $shops = $query->get();

        return view('dashboard.shops.index', compact('shops'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $genres = Genre::all(); // すべてのジャンルを取得
        $prefectures = Config::get('prefectures.prefectures');

        return view('dashboard.shops.create', compact('genres', 'prefectures'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShopRequest $request)
    {
        $shop = new Shop();
        $shop->shop_name = $request->input('shop_name');
        $shop->shop_desc = $request->input('shop_desc');
        $shop->post_code = $request->input('post_code');
        $shop->prefecture = $request->input('prefecture');
        $shop->address = $request->input('address');
        $shop->tel = $request->input('tel');
        $shop->shop_email = $request->input('shop_email');
        $shop->business_hours = $request->input('business_hours');
        $shop->holidays = $request->input('holidays');


        if ($request->hasFile('shop_img')) {
            $image_path = $request->file('shop_img')->store('public/shop_img/');
            $shop->shop_img = basename($image_path);
        }

        $shop->save();

        $shop->genres()->sync($request->input('genre_ids'));

        return redirect()->route('dashboard.shops.index');
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
        $reviews = $shop->reviews()->latest()->take(3)->get();
        $menus = $shop->menus()->take(5)->get();

        return view('dashboard.shops.show', compact('shop', 'genres', 'reviews','menus'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function edit(Shop $shop)
    {
        $genres = Genre::all();
        $prefectures = Config::get('prefectures.prefectures');

        return view('dashboard.shops.edit', compact('shop', 'genres', 'prefectures'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function update(ShopRequest $request, Shop $shop)
    {

        $shop->shop_name = $request->input('shop_name');
        $shop->shop_desc = $request->input('shop_desc');
        $shop->post_code = $request->input('post_code');
        $shop->prefecture = $request->input('prefecture');
        $shop->address = $request->input('address');
        $shop->tel = $request->input('tel');
        $shop->shop_email = $request->input('shop_email');
        $shop->business_hours = $request->input('business_hours');
        $shop->holidays = $request->input('holidays');


        if ($request->hasFile('shop_img')) {
            $image_path = $request->file('shop_img')->store('public/shop_img/');
            $shop->shop_img = basename($image_path);
        }

        $shop->save();

        $shop->genres()->sync($request->input('genre_ids'));

        return redirect()->route('dashboard.shops.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shop $shop)
    {
        $shop->delete();

        return redirect()->route('dashboard.shops.index');
    }
}
