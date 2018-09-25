<?php

namespace Solunes\Accounting;

use Illuminate\Support\ServiceProvider;

class AccountingServiceProvider extends ServiceProvider {

    protected $defer = false;

    public function boot() {
        /* Publicar Elementos */
        $this->publishes([
            __DIR__ . '/config' => config_path()
        ], 'config');
        $this->publishes([
            __DIR__.'/assets' => public_path('assets/accounting'),
        ], 'assets');

        /* Cargar Traducciones */
        $this->loadTranslationsFrom(__DIR__.'/lang', 'accounting');

        /* Cargar Vistas */
        $this->loadViewsFrom(__DIR__ . '/views', 'accounting');
    }


    public function register() {
        /* Registrar ServiceProvider Internos */

        /* Registrar Alias */
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();

        $loader->alias('Accounting', '\Solunes\Accounting\App\Helpers\Accounting');
        $loader->alias('CustomAccounting', '\Solunes\Accounting\App\Helpers\CustomAccounting');

        /* Comandos de Consola */
        $this->commands([
            //\Solunes\Accounting\App\Console\AccountCheck::class,
        ]);

        $this->mergeConfigFrom(
            __DIR__ . '/config/accounting.php', 'accounting'
        );
    }
    
}
