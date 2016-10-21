<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use App\Post;
class Tag extends Model
{
	public function posts(){
		return $this->belongsToMany('App\Post','post_tag','tag_id','post_id');
	}
}
