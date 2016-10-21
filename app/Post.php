<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use App\Tag;
use App\Comment;
class Post extends Model
{
	public function category(){
		return $this->belongsTo('App\category');
	}
	public function tags(){
		return $this->belongsToMany('App\Tag');
	}
	public function comments(){
		return $this->hasMany('App\Comment');
	}
}
