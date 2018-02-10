<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['comment','user_id','report_id'];

    public function report(){
    	return $this->belongsTo(Report::class);
    }

    public function user(){
    	return $this->belongsTo(User::class);
    }
}
