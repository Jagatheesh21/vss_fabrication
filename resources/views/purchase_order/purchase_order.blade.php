@extends('layouts.app')
@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
@endpush

@section('content')

  @if(session('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> {{session('success')}}.
    <button type="button" class="btn-close" data-coreui-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif
  @if(session('error'))
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{session('error')}}.
    <button type="button" class="btn-close" data-coreui-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif
  <form id="category_save" method="POST" action="{{route('part_matrix.store')}}">
    @csrf
    @method('POST')
  <div class="card ">
    <div class="card-header">
        Create New Purchase Order 
        <a href="{{route('purchase_order.index')}}" class="btn btn-primary float-end">Purchase Order List</a>
    </div>

    <div class="card-body">
      <div class="row mb-3">
        <div class="col-md-6">
          <label for="purchase_order_number" class="col-sm-4 col-form-label required">Purchase Order Number*</label>
          <input type="text" class="form-control" name="purchase_order_number" readonly value="{{$po_number}}">
        </div>
        <div class="col-md-6">
          <label for="name" class="col-sm-2 col-form-label required">Supplier*</label>
          <select name="supplier_id" id="supplier_id" class="form-control select2">
            <option value=""></option>
            @foreach($suppliers as $supplier)
            <option value="{{$supplier->id}}">{{$supplier->name}}</option>
            @endforeach
          </select>
          @error('supplier_id')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="col-md-6">
          <label for="name" class="col-sm-6 col-form-label required">GST Number*</label>
          <input type="text" name="gst_number" id="gst_number" class="form-control" readonly>
          @error('gst_number')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <input type="hidden" name="invoice_number" id="invoice_number"class="form-control">
        <div class="col-md-6">
          <label for="name" class="col-sm-6 col-form-label required">Reference Number*</label>
          <input type="text" name="reference_number" id="reference_number"class="form-control">
        </div>
        <div class="col-md-6">
          <label for="name" class="col-sm-6 col-form-label required">Date Of Purchase*</label>
          <input type="date" name="purchase_order_date" id="purchase_order_date" class="form-control">
          @error('purchase_order_date')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="col-md-6">
          <label for="name" class="col-sm-6 col-form-label required">State*</label>
          <input type="text" name="state" id="state" class="form-control">
          @error('state')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        
        <div class="col-md-6">
          <label for="name" class="col-sm-6 col-form-label required">State Code*</label>
          <input type="text" name="state_code" id="state_code" class="form-control">
          @error('state_code')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="col-md-6">
          <label for="name" class="col-sm-6 col-form-label required">Pin Code*</label>
          <input type="text" name="pin_code" id="pin_code" class="form-control">
          @error('pin_code')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="col-md-4">
          <label for="name" class="col-sm-6 col-form-label required">Delivery Terms*</label>
          <input type="text" name="delivery_terms" id="delivery_terms" class="form-control">
          <select name="" id=""></select>
          @error('delivery_terms')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="col-md-4">
          <label for="name" class="col-sm-6 col-form-label required">Mode Of Despatch*</label>
          <input type="text" name="mode_of_dispatch" id="mode_of_dispatch" class="form-control">
          @error('mode_of_dispatch')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="col-md-4">
          <label for="name" class="col-sm-6 col-form-label required">Payment Terms*</label>
          <input type="text" name="payment_terms" id="payment_terms" class="form-control">
          @error('payment_terms')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="col-md-12">
          <label for="" class="control-label">Supplier Address*</label>
          <textarea name="address" id="address" cols="30" rows="5" class="form-control"></textarea>
        </div>
      </div>
    <div class="row clearfix">
      <div class="col-md-12">
        <table class="table table-bordered table-hover" id="tab_logic">
          <thead>
            <tr>
              <th class="text-center"> # </th>
              <th class="text-center"> Type </th>
              <th class="text-center"> Product </th>
              <th class="text-center"> Qty </th>
              <th class="text-center"> Price </th>
              <th class="text-center"> Total </th>
            </tr>
          </thead>
          <tbody>
            <tr id='addr0'>
              <td>1</td>
              <td><select class="form-control" name="purchase_type[]" id="purchase_type0" onChange="getPurchaseOrderItems(this.value);return false;">
                <option value="">Select Type</option>
                <option value="1">Raw Material</option>  
                <option value="2">Others</option>  
              </select></td>
              <td><select class="form-control" name="raw_material_id[]" id="raw_material_id0">
                <option value="">Select Type First</option>
              </select></td>
              <td><input type="number" name='qty[]' placeholder='Enter Qty' class="form-control qty" step="0" min="0"/></td>
              <td><input type="number" name='price[]' placeholder='Enter Unit Price' class="form-control price" step="0.00" min="0"/></td>
              <td><input type="number" name='total[]' placeholder='0.00' class="form-control total" readonly/></td>
            </tr>
            <tr id='addr1'></tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="row clearfix">
      <div class="col-md-12">
        <button id="add_row" class="btn btn-primary pull-left">Add Row</button>
        <button id='delete_row' class="float-end btn btn-danger">Delete Row</button>
      </div>
    </div>
    <div class="row clearfix" style="margin-top:20px">
      <div class="col-md-8">
      </div>
      <div class="col-md-4 float-right">
        <table class="table table-bordered table-hover" id="tab_logic_total">
          <tbody>
            <tr>
              <th class="text-center text-bold">Sub Total</th>
              <td class="text-center text-bold"><input type="number" name='sub_total' placeholder='0.00' class="form-control" id="sub_total" readonly/></td>
            </tr>
            <tr>
              <th class="text-center text-bold">CGST</th>
              <td class="text-center text-bold"><div class="input-group mb-2 mb-sm-0">
                <input type="number" class="form-control" id="cgst" placeholder="0" value="0">
                <div class="input-group-addon">%</div>
              </div></td>
            </tr>
            <tr>
              <th class="text-center text-bold">SGST</th>
              <td class="text-center text-bold"><div class="input-group mb-2 mb-sm-0">
                <input type="number" class="form-control" id="sgst" placeholder="0" value="0">
                <div class="input-group-addon">%</div>
              </div></td>
            </tr>
            <tr>
              <th class="text-center text-bold">IGST</th>
              <td class="text-center text-bold"><div class="input-group mb-2 mb-sm-0">
                <input type="number" class="form-control" id="igst" placeholder="0" value="0">
                <div class="input-group-addon">%</div>
              </div></td>
            </tr>
            <tr>
              <th class="text-center">Tax</th>
              <td class="text-center"><div class="input-group mb-2 mb-sm-0">
                  <input type="number" class="form-control" id="tax" required  min="1" placeholder="0">
                  <div class="input-group-addon">%</div>
                </div></td>
            </tr>
            <tr>
              <th class="text-center">Tax Amount</th>
              <td class="text-center"><input type="number" name='tax_amount' id="tax_amount" placeholder='0.00' class="form-control" required  readonly/></td>
            </tr>
            <tr>
              <th class="text-center bg-success text-white">Grand Total</th>
              <td class="text-center"><input type="number" name='total_amount' id="total_amount" placeholder='0.00' class="form-control" required readonly/></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <button type="submit" id="submit" class="btn btn-primary">Save</button>
  </div>
</form>
  
@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
<script src="{{asset('js/select2.min.js')}}"></script>

    <script>
      $(document).ready(function(){
        $("#purchase_type0").select2({
            placeholder:"Select Type Of Purchase",
            allowedClear:true,
        });
        
        $("#raw_material_id0").select2({
          placeholder:"Select Raw Material",
            allowedClear:true,
        });
        $("#supplier_id").select2({
            placeholder:"Select Supplier",
            allowedClear:true,
        });
        
    var i=1;

    $("#add_row").click(function(){b=i-1;
        $.ajax({
          url:"{{route('getPurchaseItems')}}",
          type:"POST",
          data:{count:i},
          success:function(response)
          {
            $('#addr'+i).html($('#addr'+b).html()).find('td:first-child').html(i+1);
            $('#tab_logic').append('<tr id="addr'+(i+1)+'"></tr>');
            i++;
          }
        });
      	// $('#addr'+i).html($('#addr'+b).html()).find('td:first-child').html(i+1);
      	// $('#tab_logic').append('<tr id="addr'+(i+1)+'"></tr>');
        // $('#purchasetype').select2();
      	// i++; 
  	});
    $("#delete_row").click(function(){
    	if(i>1){
		$("#addr"+(i-1)).html('');
		i--;
		}
		calc();
	});
	
	$('#tab_logic tbody').on('keyup change',function(){
		calc();
	});
	$('#tax').on('keyup change',function(){
		calc_total();
	});
	

});
function getPurchaseOrderItems(purchase_type)
  {
    alert('test');
  }
function calc()
{
	$('#tab_logic tbody tr').each(function(i, element) {
		var html = $(this).html();
		if(html!='')
		{
			var qty = $(this).find('.qty').val();
			var price = $(this).find('.price').val();
			$(this).find('.total').val(qty*price);
			
			calc_total();
		}
    });
}

function calc_total()
{
	total=0;
	$('.total').each(function() {
        total += parseInt($(this).val());
    });
	$('#sub_total').val(total.toFixed(2));
	tax_sum=total/100*$('#tax').val();
	$('#tax_amount').val(tax_sum.toFixed(2));
	$('#total_amount').val((tax_sum+total).toFixed(2));
}
</script>
@endpush

