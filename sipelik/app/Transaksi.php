<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
	public $table = "transaksi";
    protected $fillable = array(
	'id_transaksi',
	'tanggal_terjual',
	'idpembeli',
	'idpenjual',
	'idiklan'
	
    	);
}