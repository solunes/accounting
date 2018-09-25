<?php

namespace Solunes\Accounting\App;

use Illuminate\Database\Eloquent\Model;

class AccountsReceivable extends Model {
	
	protected $table = 'accounts_receivable';
	public $timestamps = true;


	/* Register Payment rules */
	public static $rules_register_payment = array(
		'amount'=>'required|numeric|min:1',
	);

	/* Creating rules */
	public static $rules_create = array(
		'name'=>'required',
		'due_date'=>'required',
		'place_id'=>'required',
        'account_id'=>'required',
		'currency_id'=>'required',
		'amount'=>'required|numeric|min:1',
	);

	/* Updating rules */
	public static $rules_edit = array(
		'id'=>'required',
		'name'=>'required',
		'due_date'=>'required',
		'place_id'=>'required',
        'account_id'=>'required',
		'currency_id'=>'required',
		'amount'=>'required|numeric|min:1',
	);
    
    public function place() {
        return $this->belongsTo('Solunes\Accounting\App\Place');
    }
           
    public function account() {
        return $this->belongsTo('Solunes\Accounting\App\Account');
    }
        
    public function account_details() {
        return $this->hasMany('Solunes\Accounting\App\PlaceAccountability', 'pending_payment_id', 'id')->where('type','debit');
    }

    public function currency() {
        return $this->belongsTo('Solunes\Accounting\App\Currency');
    }
        
    public function sale() {
        return $this->belongsTo('Solunes\Accounting\App\Sale');
    }

    public function getPaidAmountAttribute() {
    	if(count($this->account_details)>0){
        	return $this->account_details->sum('amount');
    	} else {
    		return 0;
    	}
    }

    public function getPendingAmountAttribute() {
    	if($this->paid_amount>0){
        	return $this->amount - $this->paid_amount;
    	} else {
    		return $this->amount;
    	}
    }

}