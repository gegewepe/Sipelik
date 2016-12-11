<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
	public $table = "progress";
    protected $fillable = array(
	'id',
	'telephone_number',
	'id_activity',
	'case_parameter',
	'evidence',
	'status',
    	);
}
