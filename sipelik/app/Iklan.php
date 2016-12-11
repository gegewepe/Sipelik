<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Iklan extends Model
{
	public $table = "iklan";
    protected $fillable = array(
	'id_iklan',
	'judul_iklan',
	'harga_iklan',
	'deskripisi_iklan',
	'gambar',
	'stok',
	'idpenjual',
	'status'
	
    	);
}