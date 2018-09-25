<?php

namespace Solunes\Accounting\App\Listeners;

class DealCreated {

    public function handle($event) {
    	// Revisar que no esté de manera externa
    	if($event&&!$event->external_code){
            $event = \Solunes\Accounting\App\Controllers\Integrations\HubspotController::exportDealCreated($event);
            return $event;
    	}
    }

}
