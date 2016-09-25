<?php

namespace Looksy\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{

	    protected $table = 'statuses';

    	protected $fillable = [
        	'body', 'item_id', 'type', 'title', 'description', 'url', 'image', 'source'
    	];

    	public function user() 
    	{
    		return $this->belongsTo('Looksy\Models\User', 'user_id');
    	}

    	public function scopeNotReply($query) 
    	{
    		return $query->whereNull('parent_id');
    	}

    	public function replies() 
    	{
    		return $this->hasMany('Looksy\Models\Status', 'parent_id');
    	}
}