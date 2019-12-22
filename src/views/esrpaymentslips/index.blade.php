@extends('esrpaymentslips::layouts.app')

@section('title', 'Home ESR Tools - Dominik Senti')

@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>ESR Payment Slips Tool</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('esrpaymentslips.create') }}">Create New ESR Payment Slip</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
	
	@if (count($esrpaymentslips) > 0)
		
		<table class="table table-striped">
			<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col">Payer Line 1</th>
					<th scope="col">Invoice Number</th>
					<th scope="col">Reference Number</th>
					<th scope="col">Amount</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				@foreach ($esrpaymentslips as $esrpaymentslip)
				<tr class="header">
					<td data-toggle="collapse" href="#collapse-id-{{ $esrpaymentslip->id }}">
						<a data-toggle="collapse" href="#collapse-id-{{ $esrpaymentslip->id }}">{{ $esrpaymentslip->id }}</a>
					</td>
					<td data-toggle="collapse" href="#collapse-id-{{ $esrpaymentslip->id }}">
						<a data-toggle="collapse" href="#collapse-id-{{ $esrpaymentslip->id }}">{{ $esrpaymentslip->payerLine1 }}</a>
					</td>
					<td data-toggle="collapse" href="#collapse-id-{{ $esrpaymentslip->id }}">{{ $esrpaymentslip->invoiceNumber }}</td>
					<td data-toggle="collapse" href="#collapse-id-{{ $esrpaymentslip->id }}">{{ $esrpaymentslip->referenceNumber }}</td>
					<td data-toggle="collapse" href="#collapse-id-{{ $esrpaymentslip->id }}">{{ $esrpaymentslip->amount }}</td>
					<td>
						<form action="{{ route('esrpaymentslips.destroy',$esrpaymentslip->id) }}" method="POST">
							<div class="btn-group btn-group-sm float-right" role="group" aria-label="Basic example">
								<a class="btn btn-secondary" href="{{ route('esrpaymentslips.show',$esrpaymentslip->id) }}"><i class="fa fa-search"></i></a>
								<a class="btn btn-primary" href="{{ route('esrpaymentslips.edit',$esrpaymentslip->id) }}"><i class="fa fa-pencil"></i></a>
								<a class="btn btn-warning" href="{{ route('esrpaymentslips.download',$esrpaymentslip->id) }}"><i class="fa fa-download"></i></a>
								@csrf
								@method('DELETE')
								<button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
							</div>
						</form>
					</td>
				</tr>
				<tr>
					<!--<td></td>-->
					<td colspan="100%">
						<div class="collapse" id="collapse-id-{{ $esrpaymentslip->id }}">
							<div class="card-deck">
								<div class="card text-white bg-info mb-3" style="max-width: 18rem;">
									<div class="card-header">Einzahlung von:</div>
									<div class="card-body">
										<div class="esrpaymentslip-payerLine1">
											{{ $esrpaymentslip->payerLine1 }}
										</div>
										<div class="esrpaymentslip-payerLine2">
											{{ $esrpaymentslip->payerLine2 }} <br />
										</div>
										<div class="esrpaymentslip-payerLine3">
											{{ $esrpaymentslip->payerLine3 }}
										</div>
										<div class="esrpaymentslip-payerLine4">
											{{ $esrpaymentslip->payerLine4 }}
										</div>
									</div>
								</div>
								<div class="card text-white bg-success mb-3" style="max-width: 18rem;">
									<div class="card-header">Einzahlung für:</div>
									<div class="card-body">
										<div class="esrpaymentslip-bankName">
											{{ $esrpaymentslip->bankName }}
										</div>
										<div class="esrpaymentslip-bankCity">
											{{ $esrpaymentslip->bankCity }} <br />
										</div>
										<div class="esrpaymentslip-bankingAccount">
											{{ $esrpaymentslip->bankingAccount }}
										</div>
										<div class="esrpaymentslip-bankingCustomerIdentification">
											{{ $esrpaymentslip->bankingCustomerIdentification }}
										</div>
									</div>
								</div>
								<div class="card text-white bg-warning mb-3" style="max-width: 18rem;">
									<div class="card-header">Zugunsten von:</div>
									<div class="card-body">
										<div class="esrpaymentslip-recipientName">
											{{ $esrpaymentslip->recipientName }}
										</div>
										<div class="esrpaymentslip-recipientAddress">
											{{ $esrpaymentslip->recipientAddress }} <br />
										</div>
										<div class="esrpaymentslip-recipientCity">
											{{ $esrpaymentslip->recipientCity }}
										</div>
									</div>
								</div>
								<div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
									<div class="card-header">Zahlungsinformationen:</div>
									<div class="card-body">
										<div class="esrpaymentslip-amount">
											{{ $esrpaymentslip->amount }}
										</div>
										<div class="esrpaymentslip-invoiceNumber">
											{{ $esrpaymentslip->invoiceNumber }} <br />
										</div>
										<div class="esrpaymentslip-referenceNumber">
											{{ $esrpaymentslip->referenceNumber }}
										</div>
									</div>
								</div>
							</div>
							<hr>						
							<p title="{{ $esrpaymentslip->created_at }}">Created: {{ $esrpaymentslip->created_at->diffForHumans() }}</p>
						</div>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	@else
		<p class="lead">No ESR Payment Slips found</p>
	@endif
	
	{!! $esrpaymentslips->links() !!}

@endsection
