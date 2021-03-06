<?php

namespace Solunes\Accounting\App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model {
	
	protected $table = 'regions';
	public $timestamps = true;

	/* Creating rules */
	public static $rules_create = array(
		'name'=>'required',
		'active'=>'required',
	);

	/* Updating rules */
	public static $rules_edit = array(
		'id'=>'required',
		'name'=>'required',
		'active'=>'required',
	);
    
    public function cities() {
        return $this->hasMany('Solunes\Accounting\App\City');
    }

}