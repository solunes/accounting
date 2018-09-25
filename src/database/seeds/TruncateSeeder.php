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
        \Solunes\Accounting\App\AccountsPayable::truncate();
        \Solunes\Accounting\App\AccountsReceivable::truncate();
        \Solunes\Accounting\App\Expense::truncate();
        \Solunes\Accounting\App\Income::truncate();
        \Solunes\Accounting\App\PlaceMovement::truncate();
        \Solunes\Accounting\App\PlaceAccountability::truncate();
        \Solunes\Accounting\App\BankAccount::truncate();
        \Solunes\Accounting\App\Account::truncate();
        \Solunes\Accounting\App\Concept::truncate();
        \Solunes\Accounting\App\Tax::truncate();
    }
}