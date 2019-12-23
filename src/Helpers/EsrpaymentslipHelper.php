<?php

namespace Checkitsedo\Esrpaymentslip\Helpers;

use Illuminate\Support\Facades\DB;

class EsrpaymentslipHelper
{
	/**
	 * Convert invoice number from alpha-numeric to numeric (A=1, B=2, C=3, ...)
	 * @param string $text
	 * @return bool
	 */
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