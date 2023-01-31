<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ItemRequest;
use App\Item;
use App\Category;
use App\Order;
use App\Http\Requests\ItemImageRequest;
use App\Http\Requests\ItemEditRequest;
use App\Services\FileUploadService;
// use App\User;

class ItemController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
        
    }
  
    public function index($id)
    {
        
        $user = \Auth::user();
        return view('users.exhibitions',[
            'title' => 'の出品商品一覧',
            'items' => Item::myitem($user->id)->get(),
           
        ]);
    }

  
    public function create(Request $request)
    {
         
          
        $categories = Category::all();
        return view('items.create',[
            'title' => '商品を出品',
           'categories' => $categories,
         
        ]);
    }

 
    public function store(ItemRequest $request,FileUploadService $service){
    //   $path = '';
       
    //     $image = $request->file('image');
    //     if( isset($image) === true ){
    //         // publicディスク(storage/app/public/)のphotosディレクトリに保存
    //         $path = $image->store('photos', 'public');
    //     }
        $user = \Auth::user();
        $path = $service->saveImage($request->file('image'));
        // $items = Item::myitem($user->id)->get();
        $item = Item::create([
          'user_id' => \Auth::user()->id,
          'image' => $path, // ファイルパスを保存
          'name' => $request->name,
          'description'=>$request->description,
          'price'=>$request->price,
          'category_id'=>$request->category_id,
        ]);
        session()->flash('success', '商品を追加しました');
        return redirect()->route('items.show', $item);
        
    }
    public function show($id)
    {
        $user =  \Auth::user();
        $items = Item::find($id);
        $categories = Category::all();
        $orders = Order::where('user_id', $user->id)->get();
        return view('items.show',[
            'title' => '商品詳細',
            'categories' => $categories,
            'items' => $items,
            'orders' => $orders,
        ]);
    }

  
    public function edit($id)
    {
        $item = Item::find($id);
        $categories = Category::all();
        return view('items.edit',[
            'title' =>'出品情報の編集',
            'categories' => $categories,
            'item' => $item,
           
        ]);
    }

   
    public function update($id, ItemEditRequest $request)
    {
        // dd($request);
        $item = Item::find($id);
        $categories = Category::all();
        $item->update($request->only(['name','description','price','category_id']));
       
        session()->flash('success','出品商品を編集しました');
        return redirect()->route('items.show', $item);
    }
  
    public function destroy($id)
    {
        $item = Item::find($id);
        $item->delete();
        \Session::flash('success', '出品商品を削除しました');
        return redirect()->route('users.exhibitions', \Auth::user());
    }

   // 画像変更処理
      public function editImage($id)
      {
        $item = Item::find($id);
        return view('items.edit_image', [
          'title' => '商品画像の変更',
          'item' => $item,
        ]);
      }


     public function updateImage($id,ItemImageRequest $request,FileUploadService $service)
    {
         // 画像投稿処理
        // $path = '';
        // $image = $request->file('image');
        
        // if( isset($image) ===true){
        //     // publicディスク(storage/app/piblic/)のphotosディレクトリに保存
        //     $path =  $image->store('photos','public');
        $path = $service->saveImage($request->file('image'));
        
        $item = Item::find($id);
        // 変更前の画像の削除
        if( $item->image !==''){
            \Storage::disk('public')->delete(\Storage::url( $item->image));
        }
        
        $item->update([
            'image' =>$path,//ファイル名を保存
        ]);
            
            session()->flash('success','画像を変更しました');
            return redirect()->route('items.show', $item);
    }    

    
    // 購入確認
    public function confirm($id)
    {
        $user = \Auth::user();
        $item = Item::find($id);
        $categories = Category::all();
   
        return view('items.confirm',[
            'categories' => $categories,
            'item' => $item,
        ]);
    }
    
    public function finish($id)
    {
        $user = \Auth::user();
        $item = Item::find($id);
        $categories = Category::all();
        
        if ($item->isOrderedBy($item)) {
            $title = 'この商品は購入できませんでした。';
            $error = '既に購入されています。';
            
        } else {
            $title = 'ご購入ありがとうございました。';
            $error = '';
            
        Order::create([
        'user_id' => $user->id,
        'item_id' => $item->id,
        ]);
        }
        return view('items.finish',[
            'title' => $title,
            'categories' => $categories,
            'item' => $item,
        ]);
    }
    
   
}
