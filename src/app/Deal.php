<?php

namespace Solunes\Accounting\App;

use Illuminate\Database\Eloquent\Model;

class Deal extends Model {
	
	protected $table = 'deals';
	public $timestamps = true;

	/* Creating rules */
	public static $rules_create = array(
		'dealname'=>'required',
		'service'=>'required',
		'amount'=>'required',
		'dealstage'=>'required',
		'dealtype'=>'required',
	);

	/* Updating rules */
	public static $rules_edit = array(
		'id'=>'required',
		'dealname'=>'required',
		'service'=>'required',
		'amount'=>'required',
		'dealstage'=>'required',
		'dealtype'=>'required',
	);

    public function deal_company() {
        return $this->belongsToMany('Solunes\Accounting\App\Company', 'deal_company');
    }

    public function deal_contact() {
        return $this->belongsToMany('Solunes\Accounting\App\Contact', 'deal_contact');
    }

}