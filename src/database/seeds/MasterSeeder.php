<?php

namespace Solunes\Accounting\Database\Seeds;

use Illuminate\Database\Seeder;
use DB;

class MasterSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Módulo de Parámetros Contables
        $node_tax = \Solunes\Master\App\Node::create(['name'=>'tax', 'table_name'=>'taxes', 'location'=>'accounting', 'folder'=>'company']);
        $node_transaction_code = \Solunes\Master\App\Node::create(['name'=>'transaction-code', 'location'=>'accounting', 'folder'=>'company']);
        $node_concept = \Solunes\Master\App\Node::create(['name'=>'concept', 'location'=>'accounting', 'folder'=>'company']);
        $node_account = \Solunes\Master\App\Node::create(['name'=>'account', 'location'=>'accounting', 'folder'=>'company']);
        $node_bank_account = \Solunes\Master\App\Node::create(['name'=>'bank-account', 'location'=>'accounting', 'folder'=>'company']);
        // Módulo de Contabilidad
        $node_place_accountability = \Solunes\Master\App\Node::create(['name'=>'place-accountability', 'table_name'=>'place_accountability', 'type'=>'child', 'location'=>'accounting', 'parent_id'=>$node_account->id]);
        $node_place_movement = \Solunes\Master\App\Node::create(['name'=>'place-movement', 'location'=>'accounting', 'folder'=>'accounting']);
        $node_income = \Solunes\Master\App\Node::create(['name'=>'income', 'location'=>'accounting', 'folder'=>'accounting']);
        $node_expense = \Solunes\Master\App\Node::create(['name'=>'expense', 'location'=>'accounting', 'folder'=>'accounting']);
        $node_accounts_payable = \Solunes\Master\App\Node::create(['name'=>'accounts-payable', 'table_name'=>'accounts_payable', 'location'=>'accounting', 'folder'=>'accounting']);
        $node_accounts_receivable = \Solunes\Master\App\Node::create(['name'=>'accounts-receivable', 'table_name'=>'accounts_receivable', 'location'=>'accounting', 'folder'=>'accounting']);
        // Módulo de Capital
        if(config('accounting.partners')){
            $node_partner = \Solunes\Master\App\Node::create(['name'=>'partner', 'location'=>'store', 'folder'=>'capital']);
            //$node_partner_detail = \Solunes\Master\App\Node::create(['name'=>'partner-detail', 'folder'=>'capital', 'type'=>'child', 'parent_id'=>$node_partner->id]);
            $node_partner_movement = \Solunes\Master\App\Node::create(['name'=>'partner-movement', 'folder'=>'capital', 'type'=>'child', 'location'=>'store', 'parent_id'=>$node_partner->id]);
        }
        
        // Usuarios
        $admin = \Solunes\Master\App\Role::where('name', 'admin')->first();
        $member = \Solunes\Master\App\Role::where('name', 'member')->first();
        $accounting_perm = \Solunes\Master\App\Permission::create(['name'=>'accounting', 'display_name'=>'Negocio']);
        $admin->permission_role()->attach([$accounting_perm->id]);

    }
}