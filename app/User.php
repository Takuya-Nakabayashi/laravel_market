<?php
 
namespace App;
 
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
 
class User extends Authenticatable
{
    use Notifiable;
 
   
    protected $fillable = [
        'name', 'email', 'password','profile','image',
    ];
  
    protected $hidden = [
        'password', 'remember_token',
    ];
 
   
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    //リレーションを設定
    public function item(){
    return $this->belongsTo('App\Item');
    }

    public function likes(){
        return $this->hasMany('App\Like');
    }
    
    public function likeItems(){
        return $this->belongsToMany('App\Item','likes');
    }
    
    public function orders(){
        return $this->belongsTo('App\Order');
    }
    
    public function orderItems(){
        return $this->belongsToMany('App\Item', 'orders');
    }
    
    // public function orderes(){
    //     return $this->belongsToMany('App\User', 'orders', 'item_id', 'user_id');
    // }
    public function like(){
        return $this->belongsTo('App\Like');
    }
}