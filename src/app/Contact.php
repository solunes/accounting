<?php

namespace Solunes\Accounting\App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model {
	
	protected $table = 'contacts';
	public $timestamps = true;

	/* Creating rules */
	public static $rules_create = array(
		'firstname'=>'required',
		'lastname'=>'required',
		'type'=>'required',
		'email'=>'required',
	);

	/* Updating rules */
	public static $rules_edit = array(
		'id'=>'required',
		'firstname'=>'required',
		'lastname'=>'required',
		'type'=>'required',
		'email'=>'required',
	);
        
    public function region() {
        return $this->belongsTo('Solunes\Accounting\App\Region');
    }

    public function city() {
        return $this->belongsTo('Solunes\Accounting\App\City');
    }

    public function company() {
        return $this->belongsTo('Solunes\Accounting\App\Company');
    }
   
    public function user() {
        return $this->hasOne('App\User');
    }

}