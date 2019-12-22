<?php

namespace Checkitsedo\Esrpaymentslip\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Checkitsedo\Esrpaymentslip\Esrpaymentslip;
use EsrpaymentslipHelper;
use Checkitsedo\Esrpaymentslip\Pdf\Download;

class EsrpaymentslipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $esrpaymentslips = Esrpaymentslip::orderBy('id', 'asc')->paginate(5);
  
        return view('esrpaymentslips::esrpaymentslips.index',compact('esrpaymentslips'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
	
	/**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('esrpaymentslips::esrpaymentslips.create');
    }
	
	/**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $esrpaymentslip = new Esrpaymentslip();
    	$esrpaymentslip->bankName = $request->bankName;
		$esrpaymentslip->bankCity = $request->bankCity;
		$esrpaymentslip->bankingAccount = $request->bankingAccount;
		$esrpaymentslip->bankingCustomerIdentification = $request->bankingCustomerIdentification;
		$esrpaymentslip->recipientName = $request->recipientName;
		$esrpaymentslip->recipientAddress = $request->recipientAddress;
		$esrpaymentslip->recipientCity = $request->recipientCity;
		$esrpaymentslip->payerLine1 = $request->payerLine1;
		$esrpaymentslip->payerLine2 = $request->payerLine2;
		$esrpaymentslip->payerLine3 = $request->payerLine3;
		$esrpaymentslip->payerLine4 = $request->payerLine4;
		$esrpaymentslip->amount = $request->amount;
		$esrpaymentslip->invoiceNumber = $request->invoiceNumber;
		$tempInvoiceNumber = $request->invoiceNumber;
		$esrpaymentslip->referenceNumber = EsrpaymentslipHelper::calculateReference($tempInvoiceNumber);
		$esrpaymentslip->save();
  
        return redirect()->route('esrpaymentslips.index')
                        ->with('success','ESR Payment Slip created successfully.');
    }
	
	/**
     * Display the specified resource.
     *
     * @param  \Checkitsedo\Esrpaymentslip  $esrpaymentslip
     * @return \Illuminate\Http\Response
     */
    public function show(Esrpaymentslip $esrpaymentslip, $id)
    {
		$esrpaymentslip = Esrpaymentslip::find($id);
        return view('esrpaymentslips::esrpaymentslips.show',compact('esrpaymentslip'));
    }
	
	/**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Esrpaymentslip  $esrpaymentslip
     * @return \Illuminate\Http\Response
     */
    public function edit(Esrpaymentslip $esrpaymentslip, $id)
    {
		$esrpaymentslip = Esrpaymentslip::find($id);
        return view('esrpaymentslips::esrpaymentslips.edit',compact('esrpaymentslip'));
    }
	
	/**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Esrpaymentslip  $esrpaymentslip
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'bankName' => 'required',
			'bankCity' => 'required',
			'bankingAccount' => 'required',
			'bankingCustomerIdentification' => 'required',
			'recipientName' => 'required',
			'recipientAddress' => 'required',
			'recipientCity' => 'required',
			'payerLine1' => 'nullable',
			'payerLine2' => 'nullable',
			'payerLine3' => 'nullable',
			'payerLine4' => 'nullable',
			'amount' => 'required',
			'invoiceNumber' => 'required',
			'referenceNumber' => 'nullable',
        ]);
		
		$tempInvoiceNumber = $request->invoiceNumber;
		
		$update = [
			'bankName' => $request->bankName,
			'bankCity' => $request->bankCity,
			'bankingAccount' => $request->bankingAccount,
			'bankingCustomerIdentification' => $request->bankingCustomerIdentification,
			'recipientName' => $request->recipientName,
			'recipientAddress' => $request->recipientAddress,
			'recipientCity' => $request->recipientCity,
			'payerLine1' => $request->payerLine1,
			'payerLine2' => $request->payerLine2,
			'payerLine3' => $request->payerLine3,
			'payerLine4' => $request->payerLine4,
			'amount' => $request->amount,
			'invoiceNumber' => $request->invoiceNumber,
			'referenceNumber' => EsrpaymentslipHelper::calculateReference($tempInvoiceNumber),
		];
		
		Esrpaymentslip::where('id', $id)->update($update);
		
        return redirect()->route('esrpaymentslips.index')
                        ->with('success','ESR Payment Slip updated successfully');
    }
	
	/**
     * Remove the specified resource from storage.
     *
     * @param  \App\Esrpaymentslip  $esrpaymentslip
     * @return \Illuminate\Http\Response
     */
    public function destroy(Esrpaymentslip $esrpaymentslip, $id)
    {
		$esrpaymentslip = Esrpaymentslip::find($id);
        $esrpaymentslip->delete();
  
        return redirect()->route('esrpaymentslips.index')
                        ->with('success','ESR Payment Slip deleted successfully');
    }
	
	public function download($id)
	{
		$esrpaymentslip = Esrpaymentslip::find($id);
		
		$download = new Download($esrpaymentslip);
		$esr = $download->esr($esrpaymentslip);
		
		exit;
	}
}
