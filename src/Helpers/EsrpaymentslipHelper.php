<?php
//packages/chceckitsedo/esrpaymentslip/src/Helpers/EsrpaymentslipHelper.php
namespace Checkitsedo\Esrpaymentslip\Helpers;

use Illuminate\Support\Facades\DB;

class EsrpaymentslipHelper
{
	public static function calculateReference($text)
	{
		$invoiceNumber = $text;
		$referenceNumber = $invoiceNumber;
		$referenceNumber = preg_replace('/[^A-Za-z0-9]/', '', $referenceNumber);
		$referenceNumber = substr($referenceNumber, 1);
		
		$newReferenceNumber = "";
		$array = str_split($referenceNumber);
		foreach($array as $char)
		{
			if (is_numeric($char))
			{
				//
			}
			else
			{
				if ($char)
				{
					$char = strtolower($char);
					$char = ord($char) - 96;
				}
				else
				{
					return 0;
				}
			}
			$newReferenceNumber .= $char;
		}
		return $newReferenceNumber;
	}
}