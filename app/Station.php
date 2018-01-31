<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
	protected $fillable = ['station'];
    public function users(){
		return $this->hasMany(User::class);
	}
}
