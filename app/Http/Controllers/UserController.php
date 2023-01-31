<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use App\Item;
use App\Order;
use App\Http\Requests\UserImageRequest;
use App\Like;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    // トップページ
    public function index()
    {
        $user = \Auth::user();
        $orders = Order::where('user_id', $user->id)->get();
        // $items = Item::where('user_id','!=','user')->get();
        return view('users.index',[
            'title' => '息をするように、買おう。',
            'orders' => $orders,
            'other_exhibitions' => Item::other($user->id)->get(),
        ]);
    }
    
    // 出品商品一覧
    public function exhibitions($id){
        $user = \Auth::user();
        $orders = Order::where('user_id', $user->id)->get();
        return view('users.exhibitions', [
            'title' => 'の出品商品一覧',
            'orders' => $orders,
            'items' => Item::myitem($user->id)->get(),
        ]);
    }
 
    public function create()
    {
        //
    }

   
    public function store(Request $request)
    {
        //
    }

  
    public function show($id)
    {
        $user =  \Auth::user();
        $count = Item::where('user_id',$user->id)->get()->count();
        // dd(Item::recommend($user->id)->toSql());
        $orders = Order::where('user_id', $user->id)->get();
       
        return view('users.show',[
            'title' => 'プロフィール',
            'user' => $user,
            'count' => $count, 
            'orders' => $orders,
        ]);
    }

   
    public function edit()
    {
        return view('profile.edit',[
          'title' =>'プロフィール編集'
        ]);
    }

  
    public function update(UserRequest $request)
    {
     
        $user = \Auth::user();
        $user->update($request->only(['name','profile']));
        
        session()->flash('success','プロフィールを編集しました');
        return redirect()->route('users.show',$user);
    }

 
    public function destroy($id)
    {
        $post = Post::find($id);
 
        // 画像の削除
        if($post->image !== ''){
          \Storage::disk('public')->delete($post->image);
        }
 
        $post->delete();
        session()->flash('success', '投稿を削除しました');
        return redirect()->route('users.show',$post);
    }
    
    // プロフィール画像編集
    public function editImage()
    {
        $post = \Auth::user();
        return view('profile.edit_image',[
            'title' =>'プロフィール画像編集',
            'post' => $post,
        ]);
    }
    
    // 画像変更処理
      public function updateImage(UserImageRequest $request){
 
        //画像投稿処理
        $path = '';
        $image = $request->file('image');
 
        if( isset($image) === true ){
            // publicディスク(storage/app/public/)のphotosディレクトリに保存
            $path = $image->store('photos', 'public');
        }
 
        $post = \Auth::user();
 
        // 変更前の画像の削除
        if($post->image !== ''){
          \Storage::disk('public')->delete(\Storage::url($post->image));
        }
 
        $post->update([
          'image' => $path, // ファイル名を保存
        ]);
 
        session()->flash('success', '画像を変更しました');
        return redirect()->route('users.show',$post);
    }
    
    
    public function toggleLike($id){
        $user = \Auth::user();
        $item = Item::find($id);
        if($item->isLikedBy($user)){
            // いいねの取り消し
            $item->likes->where('user_id', $user->id)->first()->delete();
            \Session::flash('success', 'いいねを取り消しました');
        } else {
            // いいねを設定
            Like::create([
                'user_id' => $user->id,
                'item_id' => $item->id,
            ]);
            \Session::flash('success', 'お気に入りに追加しました。');
        }
        return redirect('/');
    }
}
