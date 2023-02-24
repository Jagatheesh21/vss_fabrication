@extends('layouts.print')
@push('styles')
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<style>

    .supplier_detail{
			border: 0.5px solid !important;
			margin: 0;
			padding: 10px;
		}
        ol li{
			font-size: 12px;
		}
</style>
@endpush
@section('content')
<button class="btn btn-primary">Print</button>
<div class="row py-3">
    <div class="col-md-12 justify-content-center border border-secondary rounded">
        <center>
        <h3>Venkateswara Steels And Springs India Private Limited</h3>
        <p>1/89-6,Ravuthur Privu,Kannam Palayam,Sulur,Coimbatore-6410602.<br>Cell : 96598 77955, Ph: 26808040<br>Email : venkateswarasteels@eth.net , info@venkateswarasteels.com<br>TIN : 33891824172   CST No.292956 Dt.4.4.406 Code : 096<br><b>GSTIN : 33AACCV3065F1ZL</b></p>
        </center>
    </div>
</div>
<div class="row border border-secondary rounded" >
    <div class="col-md-6">
        <h5>Supplier Name & Address : </h5>
        <p>{!! $purchase_order->address !!}</p>
        
        <p></p>
    </div>
    <div class="col-md-3" style="padding:0 !important">
        <p class="supplier_detail" style="border-top:0 !important">Purchase Order No: {{$purchase_order->purchase_order_number}}</p>
        <p class="supplier_detail">Purchase Indent No: </p>
        <p class="supplier_detail">Supplier Quotation No: </p>
        <p class="supplier_detail">Purchase Type: </p>
        <p class="supplier_detail" style="border-bottom:0 !important">Contact Person:</p>
    </div>
    <div class="col-md-3" style="padding:0 !important">
        <p class="supplier_detail" style="border-top:0 !important">Dated:</p>
        <p class="supplier_detail">Dated:</p>
        <p class="supplier_detail">Dated: </p>
        <p class="supplier_detail">Terms Of Payment: </p>
        <p class="supplier_detail" style="border-bottom:0 !important">Mobile/Email: </p>		
    </div>
</div>
<br>
<div class="row  border border-secondary rounded">
    <table class="col-md-12" style="min-height:400px !important" >
        <tr style="border-bottom: 1px solid; height:10%">
            <th width="10%">S.No</th>
            <th width="30%"><center>Description Of Goods</center></th>
            <th width="10%">Tarif/HSN Classification</th>
            <th width="10%">Due On</th>
            <th width="10%">Quantity</th>
            <th width="10%">UOM</th>
            <th width="10%">Unit Rate</th>
            <th width="10%">Total</th>
        </tr>
        @foreach($purchase_order->purchase_order_items as $item)
        <tr style="height:10%">
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->raw_material->name }}</td>
            <td>--</td>
            <td></td>
            <td>{{ $item->quantity }}</td>
            <td>{{ $item->uom->name }}</td>
            <td>{{ $item->unit_price }}</td>
            <td>{{ number_format($item->total_price,2) }}</td>
        </tr>
        @endforeach
        <tr>
            <td colspan="8" style="padding:10px;height:10%">  </td>
        </tr>
        
        
        <tr class="border border-secondary" style="height:10%">
            <td colspan="4"><b>Rupess : </b></td>
            <td colspan="3" align="center"><b>Grand Total :</b></td>
            <td  >{{ number_format($purchase_order->total_price,2) }}</td>
        </tr>
        
    </table>
</div>
<br>
<div class="row py-3 border border-secondary rounded">
    <div class="col-md-8"> 
         <p>Terms : {{ $purchase_order->delivery_terms }}<br>
            Packing  : <br>
            Payment Terms : {{ $purchase_order->payment_terms }} <br>
            Despatch Mode :  {{ $purchase_order->mode_of_dispatch }}<br>
             SGST : {{ $purchase_order->sgst }}%<br>
             CGST : {{ $purchase_order->cgst }}%</p>
    </div>
    <div class="col-md-4">
        <p>SCHEDULE DETAILS :</p>
    </div>
</div>
<br>
<div class="row py-3 border border-secondary">
    <div class="col-md-12">
        <h5><b>Terms & Conditions :</b></h5>
        <ol>
            <li>Only the order/Schedule Quantity should be supplied.</li>
            <li>The GRN will be approved only on acceptance of 100% materials supplied by you .</li>
            <li>The PO No. should be mentioned in the DC and invoices.</li>
            <li>Any Clarifications in the PO should be addressed to us with in 7 days from the date of receipt of PO.</li>
            <li>Original and Duplicate for Transaporter Invoices and test certificate should be sent along with the materials .</li>
            <li>The Supplier QMS development programme to ensure as a minimum that supplier's certification to ISO 9001:2008 Requirements for Automotive supplier's.</li>
        </ol>
    </div>
</div>

<div class="row border border-secondary">
    <div class="col-md-12">
        <div class="col-md-6">
            
        </div>
        <div class="col-md-6 float-right">
            <h6 class="float-right"><span>For </span><i>Venkateswara Steels & Springs (India) Pvt Ltd</i></h6>
        </div>
        <br>
        <br>
        <br>
        <p class="float-right">Authorised Sign</p>
    </div>
</div>

@endsection
