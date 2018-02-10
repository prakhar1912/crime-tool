<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = ['title','description','crime_id','station_id','status'];

    public function crime(){
    	return $this->belongsTo(Crime::class);
    }

    public function station(){
    	return $this->belongsTo(Station::class);
    }

    public function comments(){
    	return $this->hasMany(Comment::class);
    }
}
