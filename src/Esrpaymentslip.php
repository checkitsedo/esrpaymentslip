<?php

namespace Checkitsedo\Esrpaymentslip;

use Illuminate\Database\Eloquent\Model;

class Esrpaymentslip extends Model
{
    protected $fillable = [
        'bankName',
		'bankCity',
		'bankingAccount',
		'bankingCustomerIdentification',
		'recipientName',
		'recipientAddress',
		'recipientCity',
		'payerLine1',
		'payerLine2',
		'payerLine3',
		'payerLine4',
		'amount',
		'invoiceNumber',
		'referenceNumber'
    ];
}
