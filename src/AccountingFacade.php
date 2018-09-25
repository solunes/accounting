<?php
namespace Solunes\Accounting;

use Illuminate\Support\Facades\Facade;

class AccountingFacade extends Facade
{
	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor()
	{
		return 'accounting';
	}
}