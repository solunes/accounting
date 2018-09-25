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
<<<<<<< HEAD
=======
        // Módulo de Capital
        if(config('accounting.partners')){
            \Solunes\Accounting\App\PartnerMovement::truncate();
            //\Solunes\Accounting\App\PartnerDetail::truncate();
            \Solunes\Accounting\App\Partner::truncate();
        }
        // Módulo de Contabilidad
>>>>>>> 3ef92cf6bc097025bab91fdb91c88f7a2e63fe28
        \Solunes\Accounting\App\AccountsPayable::truncate();
        \Solunes\Accounting\App\AccountsReceivable::truncate();
        \Solunes\Accounting\App\Expense::truncate();
        \Solunes\Accounting\App\Income::truncate();
        \Solunes\Accounting\App\PlaceMovement::truncate();
        \Solunes\Accounting\App\PlaceAccountability::truncate();
<<<<<<< HEAD
        \Solunes\Accounting\App\BankAccount::truncate();
        \Solunes\Accounting\App\Account::truncate();
        \Solunes\Accounting\App\Concept::truncate();
=======
        // Módulo de Contabilidad
        \Solunes\Accounting\App\BankAccount::truncate();
        \Solunes\Accounting\App\Account::truncate();
        \Solunes\Accounting\App\Concept::truncate();
        \Solunes\Accounting\App\TransactionCode::truncate();
>>>>>>> 3ef92cf6bc097025bab91fdb91c88f7a2e63fe28
        \Solunes\Accounting\App\Tax::truncate();
    }
}