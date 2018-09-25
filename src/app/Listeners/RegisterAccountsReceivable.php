<?php

namespace Solunes\Accounting\App\Listeners;

class RegisterAccountsReceivable {

    public function handle($event) {
    	// Revisar que tenga una sesión y sea un modelo del sitio web.
    	if($event){

            /* Crear cuentas de ventas */
            $asset_ctc = \Solunes\Accounting\App\Concept::getCode('asset_ctc')->account->id;
            $name = $event->name;
            $arr[] = \Accounting::register_account($event->place_id, 'debit', $asset_ctc, $event->currency_id, $event->amount, $name);
            $arr[] = \Accounting::register_account($event->place_id, 'credit', $event->account_id, $event->currency_id, $event->amount, $name);
            \Accounting::register_account_array($arr);
            return $event;
    	}

    }

}
