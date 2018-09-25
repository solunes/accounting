<?php

namespace Solunes\Accounting\App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Solunes\Master\App\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{

    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        //
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        
        // Módulo de Proyectos
        $events->listen('eloquent.creating: Solunes\Accounting\App\BankAccount', '\Solunes\Accounting\App\Listeners\RegisteringBankAccount');

        /*$events->listen('eloquent.creating: Solunes\Accounting\App\PlaceAccountability', '\Solunes\Accounting\App\Listeners\RegisterPlaceAccountability');
        $events->listen('eloquent.created: Solunes\Accounting\App\PlaceMovement', '\Solunes\Accounting\App\Listeners\RegisterPlaceMovement');
        $events->listen('eloquent.created: Solunes\Accounting\App\Income', '\Solunes\Accounting\App\Listeners\RegisterIncome');
        $events->listen('eloquent.created: Solunes\Accounting\App\Expense', '\Solunes\Accounting\App\Listeners\RegisterExpense');*/

        parent::boot($events);
    }
}
