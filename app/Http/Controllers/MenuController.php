<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Shop;
use Illuminate\Http\Request;

class MenuController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Shop $shop)
    {
        $menus = Menu::where('shop_id',$shop->id)->orderBy('created_at','desc')->get();
        return view('menus.index',compact('menus','shop'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Shop $shop)
    {
        return view('menus.create',compact('shop'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$shopId)
    {

        $shopMenus = $request->input('menu');
        $prices = $request->input('price');

        if(empty($shopMenus[0]) || empty($prices[0])){
            return redirect()->back()->withInput()->with('error','フォームを入力してください。');
        }


        //空白のフォームを無視して登録できるようにバリデーション
        $validMenus = array_filter($shopMenus, function ($shopMenu, $key) use ($prices) {
            return !empty($shopMenu) && isset($prices[$key]) && !empty($prices[$key]);
        }, ARRAY_FILTER_USE_BOTH);

        foreach($validMenus as $key => $shopMenu){
        $menu = new Menu();
        $menu->shop_id = $shopId;
        $menu->menu = $shopMenu;
        $menu->price = $prices[$key];

        $menu->save();
        }
            return redirect()->route('shops.menus.index',$shopId);
        }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Shop $shop,Menu $menu)
    {
        return view('menus.edit',compact('menu','shop'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Shop $shop,Menu $menu)
    {
        $request->validate([
            'menu' => 'required',
            'price' => 'required',
        ]);

        $menu->shop_id = $shop->id;
        $menu->menu = $request->input('menu');
        $menu->price = $request->input('price');

        $menu->save();

            return redirect()->route('shops.menus.index',$shop->id)->with('message',"$menu->menu を更新しました。");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shop $shop,Menu $menu)
    {
        $menu->delete();

        return redirect()->route('shops.menus.index',$shop->id)->with('message',"$menu->menu を削除しました。");
    }
}
