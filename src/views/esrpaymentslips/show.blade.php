@extends('esrpaymentslips::layouts.app')

@section('title', 'Home ESR Tools - Dominik Senti')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show ESR Payment Slip</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('esrpaymentslips.index') }}"> Back</a>
            </div>
        </div>
    </div>
   
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Bank Name:</strong>
                {{ $esrpaymentslip->bankName }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Bank City:</strong>
                {{ $esrpaymentslip->bankCity }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Banking Account:</strong>
                {{ $esrpaymentslip->bankingAccount }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Banking CID:</strong>
                {{ $esrpaymentslip->bankingCustomerIdentification }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Recipient Name:</strong>
                {{ $esrpaymentslip->recipientName }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Recipient Address:</strong>
                {{ $esrpaymentslip->recipientAddress }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Recipient City:</strong>
                {{ $esrpaymentslip->recipientCity }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Payer Line 1:</strong>
                {{ $esrpaymentslip->payerLine1 }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Payer Line 2:</strong>
                {{ $esrpaymentslip->payerLine2 }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Payer Line 3:</strong>
                {{ $esrpaymentslip->payerLine3 }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Payer Line 4:</strong>
                {{ $esrpaymentslip->payerLine4 }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Amount:</strong>
                {{ $esrpaymentslip->amount }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Invoice Number:</strong>
                {{ $esrpaymentslip->invoiceNumber }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Reference Number:</strong>
                {{ $esrpaymentslip->referenceNumber }}
            </div>
        </div>
    </div>

@endsection