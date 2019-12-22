@extends('esrpaymentslips::layouts.app')

@section('title', 'Home ESR Tools - Dominik Senti')
  
@section('content')
	<div class="row">
		<div class="col-lg-12 margin-tb">
			<div class="pull-left">
				<h2>Add New ESR Payment Slip</h2>
			</div>
			<div class="pull-right">
				<a class="btn btn-primary" href="{{ route('esrpaymentslips.index') }}"> Back</a>
			</div>
		</div>
	</div>
	   
	<form class="dm_form" id="besr" name="besr" action="{{ route('esrpaymentslips.store') }}" method="POST" accept-charset="character_set">
		@csrf
		
		<div class="form_wrapper">
			<fieldset>
				<h4>Einzahlung von/Versé par:</h4>
				
				<label class="w100 inputselect" for="payerLine1">
					<span class="wrapper">
						<span class="title">Payer Line 1</span>
						<input name="payerLine1" class="field" id="payerLine1" type="text" value="" />
					</span>
				</label>
				
				<div class="clear"></div>
				
				<label class="w100 inputselect" for="payerLine2">
					<span class="wrapper">
						<span class="title">Payer Line 2</span>
						<input name="payerLine2" class="field" id="payerLine2" type="text" value="" />
					</span>
				</label>
					
				<div class="clear"></div>
					
				<label class="w100 inputselect" for="payerLine3">
					<span class="wrapper">
						<span class="title">Payer Line 3</span>
						<input name="payerLine3" class="field" id="payerLine3" type="text" value="" />
					</span>
				</label>
					
				<div class="clear"></div>

				<label class="w100 inputselect" for="payerLine4">
					<span class="wrapper">
						<span class="title">Payer Line 4</span>
						<input name="payerLine4" class="field" id="payerLine4" type="text" value="" />
					</span>
				</label>					
			</fieldset>

			<fieldset>
				<h4>Einzahlung für/Versement pour:</h4>
					
				<label class="w100 inputselect" for="bankName">
					<span class="wrapper">
						<span class="title">Bank Name</span>
						<input name="bankName" class="field" id="bankName" type="text" value="" />
					</span>
				</label>
					
				<div class="clear"></div>
					
				<label class="w100 inputselect" for="bankCity">
					<span class="wrapper">
						<span class="title">Bank City</span>
						<input name="bankCity" class="field" id="bankCity" type="text" value="" />
					</span>
				</label>
					
				<div class="clear"></div>
					
				<label class="w100 inputselect" for="bankingAccount">
					<span class="wrapper">
						<span class="title">Banking Account</span>
						<input name="bankingAccount" class="field" id="bankingAccount" type="text" value="" />
					</span>
				</label>
					
				<div class="clear"></div>

				<label class="w100 inputselect" for="bankingCustomerIdentification">
					<span class="wrapper">
						<span class="title">Banking CID</span>
						<input name="bankingCustomerIdentification" class="field" id="bankingCustomerIdentification" type="text" value="" />
					</span>
				</label>					
			</fieldset>

			<div class="clear"></div>
			<div class="clear"></div>
				
			<fieldset>
				<h4>Zungunsten von/En faveur de:</h4>
					
				<label class="w100 inputselect" for="recipientName">
					<span class="wrapper">
						<span class="title">Recipient Name</span>
						<input name="recipientName" class="field" id="recipientName" type="text" value="" />
					</span>
				</label>
					
				<div class="clear"></div>
					
				<label class="w100 inputselect" for="recipientAddress">
					<span class="wrapper">
						<span class="title">Recipient Address</span>
						<input name="recipientAddress" class="field" id="recipientAddress" type="text" value="" />
					</span>
				</label>
					
				<div class="clear"></div>
					
				<label class="w100 inputselect" for="recipientCity">
					<span class="wrapper">
						<span class="title">Recipient City</span>
						<input name="recipientCity" class="field" id="recipientCity" type="text" value="" />
					</span>
				</label>
			</fieldset>

			<fieldset>
				<h4>Zahlungsinformationen/données de paiement:</h4>
				
				<label class="w100 inputselect" for="amount">
					<span class="wrapper">
						<span class="title">Amount</span>
						<input name="amount" class="field" id="amount" type="text" value="" />
					</span>
				</label>
					
				<div class="clear"></div>
					
				<label class="w100 inputselect" for="invoiceNumber">
					<span class="wrapper">
						<span class="title">Invoice Number</span>
						<input name="invoiceNumber" class="field" id="invoiceNumber" type="text" value="" />
					</span>
				</label>
					
				<div class="clear"></div>
					
				<label class="w100 inputselect" for="referenceNumber">
					<span class="wrapper">
						<span class="title">Reference Number</span>
						<input name="referenceNumber" class="field" id="referenceNumber" type="text" value="" readonly/>
					</span>
				</label>
			</fieldset>
			
			<div class="clear"></div>
			<div class="clear"></div>
			
			<div class="col-xs-12 col-sm-12 col-md-12 text-center">
				<button type="submit" class="btn btn-primary" style="letter-spacing: 5px; font-size: 16px; font-weight: bold; float: left">Submit</button>
			</div>
		</div>
	   
	</form>

@endsection