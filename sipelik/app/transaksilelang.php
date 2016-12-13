<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksilelang extends Model
{
	public $table = "transaksilelang";
    protected $fillable = array(
		'id_iklan',
		'id_user',
		'harga'
    );
}