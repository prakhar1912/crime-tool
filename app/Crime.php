<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Crime extends Model
{
    protected $fillable=['name'];

    public function cases(){
    	return $this->hasMany(Report::class);
    }
}
