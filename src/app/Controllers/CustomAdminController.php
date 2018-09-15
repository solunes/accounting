<?php

namespace Solunes\Accounting\App\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\UrlGenerator;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Asset;

class CustomAdminController extends Controller {

	protected $request;
	protected $url;

	public function __construct(UrlGenerator $url) {
	  $this->middleware('auth');
	  $this->middleware('permission:dashboard');
	  $this->prev = $url->previous();
	  $this->module = 'admin';
	}

	public function getIndex() {
		$user = auth()->user();
		//$array['tasks'] = $user->active_accounting_tasks;
		$array['tasks'] = \Solunes\Accounting\App\AccountingTask::limit(2)->get();
		$array['active_issues_accountings'] = \Solunes\Accounting\App\Accounting::has('active_accounting_issues')->with('active_accounting_issues')->get();
      	return view('accounting::list.dashboard', $array);
	}

	/* Módulo de Proyectos */

	public function allAccountings() {
		$array['items'] = \Solunes\Accounting\App\Accounting::get();
      	return view('accounting::list.accountings', $array);
	}

	public function findAccounting($id, $tab = 'description') {
		if($item = \Solunes\Accounting\App\Accounting::find($id)){
			$array = ['item'=>$item, 'tab'=>$tab];
      		return view('accounting::item.accounting', $array);
		} else {
			return redirect($this->prev)->with('message_error', 'Item no encontrado');
		}
	}

	public function findAccountingTask($id) {
		if($item = \Solunes\Accounting\App\AccountingTask::find($id)){
			$array = ['item'=>$item];
      		return view('accounting::item.accounting-task', $array);
		} else {
			return redirect($this->prev)->with('message_error', 'Item no encontrado');
		}
	}

	public function findProjecIssue($id) {
		if($item = \Solunes\Accounting\App\AccountingIssue::find($id)){
			$array = ['item'=>$item];
      		return view('accounting::item.accounting-issue', $array);
		} else {
			return redirect($this->prev)->with('message_error', 'Item no encontrado');
		}
	}

	public function allWikis($accounting_type_id = NULL, $wiki_type_id = NULL) {
		$array['accounting_type_id'] = $accounting_type_id;
		$array['wiki_type_id'] = $wiki_type_id;
		if($accounting_type_id&&$wiki_type_id){
			$array['items'] = \Solunes\Accounting\App\Wiki::where('accounting_type_id',$accounting_type_id)->where('wiki_type_id',$wiki_type_id)->get();
		} else if($accounting_type_id){
			$array['items'] = \Solunes\Accounting\App\WikiType::get();
		} else {
			$array['items'] = \Solunes\Accounting\App\AccountingType::get();
		}
      	return view('accounting::list.wikis', $array);
	}

	public function findWiki($id) {
		if($item = \Solunes\Accounting\App\Wiki::find($id)){
			$array = ['item'=>$item];
      		return view('accounting::item.wiki', $array);
		} else {
			return redirect($this->prev)->with('message_error', 'Item no encontrado');
		}
	}

}