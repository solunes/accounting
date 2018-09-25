<?php

namespace Solunes\Accounting\App;

use Illuminate\Database\Eloquent\Model;

class City extends Model {
	
	protected $table = 'cities';
	public $timestamps = true;

	/* Creating rules */
	public static $rules_create = array(
		'region_id'=>'required',
		'name'=>'required',
		'active'=>'required',
	);

	/* Updating rules */
	public static $rules_edit = array(
		'id'=>'required',
		'region_id'=>'required',
		'name'=>'required',
		'active'=>'required',
	);
    
    public function region() {
        return $this->belongsTo('Solunes\Accounting\App\Region');
    }
        
    public function agencies() {
        return $this->hasMany('Solunes\Accounting\App\Agency');
    }

    public function contacts() {
        return $this->hasMany('Solunes\Accounting\App\Contact');
    }

}