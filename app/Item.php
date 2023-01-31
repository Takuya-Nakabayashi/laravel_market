<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['user_id','name','description','category_id','price','image'];

    public function user(){
      return $this->belongsTo('App\User');
    }
    
    //  public function scopeRecommend($query,$id){
    //     return $query->where('id',$id);
    // }
    
    public function category(){
      return $this->belongsTo('App\Category');
    }
    
    // public function categories(){
    //     $categories = category::pluck('name');
    // }
    
    public function order(){
      return $this->belongsTo('App\Order');
    }
    
    public function scopeOther($query,$user_id){
      return $query->where('user_id','!=',$user_id)->latest();
    }
    
    public function likes(){
      return $this->hasMany('App\Like');
    }
    
    public function likedUsers(){
      return $this->belongsToMany('App\User','likes');
    }
    
    public function isLikedBy($user){
      $liked_users_ids = $this->likedUsers->pluck('id');
      $result = $liked_users_ids->contains($user->id);
      return $result;
    }
    
     public function scopeMyitem($query,$user_id){
        return $query->where('user_id','=',$user_id)->latest();
    }
    
    public function orders(){
      return $this->hasMany('App\Order');
    }
    
    public function orderedUsers(){
      return $this->belongsToMany('App\User', 'Orders');
    }
    
    public function isOrderedBy($item){
      $ordered_item_ids = $this->orders->pluck('item_id');
      $result = $ordered_item_ids->contains($item->id);
      return $result;
    }

}







