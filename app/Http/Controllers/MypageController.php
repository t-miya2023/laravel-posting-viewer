<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Review;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class MypageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        return view('mypage.index',compact('user'));
    }
    public function create()
    {
        
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user = Auth::user();
        return view('mypage.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */


    public function useredit($page)
    {
        $user = Auth::user();
        return view('mypage.edit', ['user' => $user, 'page' => $page]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user= Auth::user();
        $page = $request->page;

        if($page == 'name'){
            $request->validate([
                'name' => 'required|max:255'
            ]);
            $user->name = $request->input('name');
            $user->save();
            return redirect()->route('mypage.show',$user->id)->with('update','氏名が変更されました。');
        }elseif($page == 'email'){
            $request->validate([
                'email' => 'required|email|unique:users,email,' . auth()->user()->id,
            ]);
            $user->email = $request->input('email');
            $user->save();
            return redirect()->route('mypage.show',$user->id)->with('update','メールアドレスは正しく変更されました。');
        }elseif($page == 'password'){
            $request->validate([
                'password' => 'required|min:8'
            ]);
            $new_password = $request->password;
            $old_password = $request->currentpassword;
            $confirm_password = $request->confirmpassword;
            Log::debug($new_password);
            Log::debug($old_password);
            Log::debug($confirm_password);
            if(!(Hash::check($old_password,$user->password))){
                return redirect()->back()->with('say','現在のパスワードが間違っています。');
            }else{
                if(Hash::check($new_password,$user->password)){
                    return redirect()->back()->with('say','新しいパスワードが現在のパスワードと同じです。違うパスワードを設定してください。');
            }else{
                if($new_password != $confirm_password){
                    return redirect()->back()->with('say','新しいパスワードと確認用パスワードが一致しません。');
                }else{
                    $user->password = Hash::make($request['password']);
                    $user->save();
                    return redirect()->route('mypage.show',$user->id)->with('update','パスワードは正しく変更されました。');
                    }
                }
            }
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {   
        $user = Auth::user();
        Auth::logout();
        $user->delete();

        return redirect('/')->with('message','ご利用ありがとうございました。');
    }


}
