<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Iklan extends Model
{
	public $table = "iklan";
    protected $fillable = array(
	'id_iklan',
	'judul_iklan',
	'harga',
	'deskripisi_iklan',
	'gambar',
	'stok',
	'idpenjual',
	'status',
	'sisa_jam',
	'sisa_menit',
	'id_buyer',
	'created_at',
	'updated_at'
    	);
}