<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Testimoni extends Model
{
	public $table = "testimoni";
    protected $fillable = array(
	'id_testi',
	'isi',
	'score',
	'id_user',
	'id_iklan'
	
    	);
}