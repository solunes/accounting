<?php

namespace Solunes\Accounting\Database\Seeds;

use Illuminate\Database\Seeder;
use DB;

class TruncateSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Módulo de Capital
        if(config('accounting.partners')){
            \Solunes\Accounting\App\PartnerMovement::truncate();
            //\Solunes\Accounting\App\PartnerDetail::truncate();
            \Solunes\Accounting\App\Partner::truncate();
        }
        // Módulo de Contabilidad
        \Solunes\Accounting\App\AccountsPayable::truncate();
        \Solunes\Accounting\App\AccountsReceivable::truncate();
        \Solunes\Accounting\App\Expense::truncate();
        \Solunes\Accounting\App\Income::truncate();
        \Solunes\Accounting\App\PlaceMovement::truncate();
        \Solunes\Accounting\App\PlaceAccountability::truncate();
        // Módulo de Contabilidad
        \Solunes\Accounting\App\BankAccount::truncate();
        \Solunes\Accounting\App\Account::truncate();
        \Solunes\Accounting\App\Concept::truncate();
        \Solunes\Accounting\App\TransactionCode::truncate();
        \Solunes\Accounting\App\Tax::truncate();
    }
}