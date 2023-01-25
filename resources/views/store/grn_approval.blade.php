@extends('layouts.app')
@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css" />
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
  <strong>Error!</strong> {{session('error')}}.
  <button type="button" class="btn-close" data-coreui-dismiss="alert" aria-label="Close"></button>
</div>
@endif
  
    <div class="card">
        <div class="card-header">
            <strong>GRN Approval </strong>
        </div>
        <div class="card-body">
            <div class="col-md-12">
                <form id="operation_save" method="POST" action="{{route('store_receive.update',$store->id)}}" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                  <div class="row mb-3">
                    <div class="col-sm-4">
                      <label for="grn_number" class="col-sm-6 col-form-label control-label-required">GRN Number*</label>
                      <div class="form-group">
                        <input type="text" name="grn_number" id="grn_number" class="form-control" readonly value="{{$store->grn_number}}" >
                      </div>
                    </div>
                    <input type="hidden" name="category_id" id="category_id" value="{{$store->category_id}}">

                    <div class="col-sm-4">
                      <label for="name" class="col-sm-6 col-form-label required">Raw Material Type*</label>
                      <div class="form-group">
                        <select name="type_id" id="type_id" class="form-control select2">
                            <option value="">Select Raw Material Type</option>
                            @foreach ($types as $type)
                            @if ($store->type_id==$type->id)    
                            <option value="{{$type->id}}" 
                                    selected
                               >{{$type->name}}</option>
                               @endif
                            @endforeach
                        </select>
                        @error('type_id')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <label for="name" class="col-sm-6 col-form-label required">Raw Material*</label>
                      <div class="form-group">
                        <select name="raw_material_id" id="raw_material_id" class="form-control select2">
                        @foreach ($raw_materials as $raw_material)
                        @if ($store->raw_material_id==$raw_material->id)
                            <option value="{{$raw_material->id}}" 
                                selected
                           >{{$raw_material->name}}</option>
                           @endif
                        @endforeach
                        </select>
                        @error('raw_material_id')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                    </div>
                   
                    <div class="col-sm-4 supplier_div">
                      <label for="name" class="col-sm-4 col-form-label required">Supplier*</label>
                      <div class="form-group">
                        <select name="supplier_id" id="supplier_id" class="form-control select2">
                          <option value="">Select Supplier</option>
                          @foreach($suppliers as $supplier)
                          @if($supplier->id==$store->supplier_id)
                          <option value="{{$supplier->id}}" selected>{{$supplier->code}}</option>
                          @endif
                          @endforeach
                        </select>
                        @error('supplier_id')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <label for="name" class="col-sm-6 col-form-label required">Invoice Number*</label>
                      <div class="form-group">
                       <input type="text" name="invoice_number" id="invoice_number" class="form-control" readonly value="{{$store->invoice_number}}">
                        @error('invoice_number')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <label for="name" class="col-sm-2 col-form-label required">UOM*</label>
                      <div class="form-group">
                        <select name="uom_id" id="uom_id" class="form-control select2">
                          <option value="">Select UOM</option>
                          @foreach($uoms as $uom)
                          @if($store->uom_id==$uom->id)
                          <option value="{{$uom->id}}" selected>{{$uom->name}}</option>
                          @endif
                          @endforeach
                        </select>
                        @error('uom_id')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <label for="name" class="col-sm-6 col-form-label required">Total Quantity*</label>
                      <div class="form-group">
                      <input type="text" name="available_quantity" id="available_quantity" readonly class="form-control" value="{{$store->inward_quantity}}" >
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <label for="name" class="col-sm-12 col-form-label required">Total Material Quantity*</label>
                      <div class="form-group">
                      <input type="text" name="inward_material_quantity" id="inward_material_quantity"  class="form-control" value="{{$store->inward_material_quantity}}">
                      @error('inward_quantity')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <label for="name" class="col-sm-4 col-form-label required">Material UOM*</label>
                      <div class="form-group">
                        <select name="material_uom_id" id="material_uom_id" class="form-control select2">
                          <option value="">Select Material UOM</option>
                          @foreach($uoms as $m_uom)
                          @if($store->material_uom_id==$m_uom->id)
                          <option value="{{$m_uom->id}}" selected>{{$m_uom->name}}</option>
                          @endif
                          @endforeach
                        </select>
                        @error('material_uom_id')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="" class="col-sm-12 col-form-label required">Ok Material Quantity *</label>
                        <input type="text" name="ok_material_quantity" id="ok_material_quantity" class="form-control" onchange="material_calculation();return false;" value="{{ $store->inward_material_quantity }}"  max="{{ $store->inward_material_quantity }}" required>
                        @error('ok_material_quantity')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="" class="col-sm-12 col-form-label required">Reject Material Quantity*</label>
                        <input type="text" name="reject_material_quantity" id="reject_material_quantity" class="form-control" onchange="material_calculation();return false;" value="0"  required>
                        @error('reject_material_quantity')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="" class="col-sm-12 col-form-label required">Inspection Report*</label>
                        <input type="file" name="inspection_report" id="inspection_report" class="form-control" value="{{ old('inspection_report') }}" required>
                        @error('inspection_report')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="" class="col-sm-12 col-form-label required">Status*</label>
                        <select name="approved_status" id="approved_status" class="form-control select2" required>
                          <option value="">Select Status</option>
                          <option value="1" @if (old('approved_status')==1)
                              selected
                          @endif>Approve</option>
                          <option value="2" @if (old('approved_status')==2)
                          selected
                      @endif>Reject</option>
                        </select>
                        @error('approved_status')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="" class="col-sm-12 col-form-label required">Remarks*</label>
                        <textarea name="remarks" id="remarks" cols="30" rows="3" class="form-control"></textarea>
                        @error('remarks')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                    </div>
                  </div> 
                  <div class="row mb-0">
                        <div class="col-md-8 offset-md-4">
                           <button type="submit" id="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                  </form>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
<script src="{{asset('js/select2.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"></script>
<script>
  $("#type_id").select2();
  $("#approved_status").select2();

  $("#type_id").change(function(e){
    e.preventDefault();
    if($(this).val()=='' || $(this).val()==undefined || $(this).val()==null)
    {
      return false;
    }
    $.ajax({
      url:"{{route('store.materials')}}",
      type:"POST",
      data:{type_id:$(this).val()},
      success:function(response)
      {
        $("#raw_material_id").append(" ");
        var data = JSON.parse(response);
        $("#raw_material_id").append("<option value=''>Select Raw Material</option>");
        $.each(data, function (i, item) {
          $("#raw_material_id").append("<option value='"+item.id+"'>" + item.name + "-"+item.part_description+"</option>");
        });
        $("#raw_material_id").select2({
        allowedClear:true,
        placeholder:'Select Raw Material'
      });
      }
    });
  });

  $("#raw_material_id").change(function(){
    var raw_material_id = $(this).val();
    if(raw_material_id=="" || raw_material_id==undefined || raw_material_id==null)
    {
      return false;
    }
    $.ajax({
      url:"{{route('store.getMaterialPurchaseOrder')}}",
      type:"POST",
      data:{raw_material_id:raw_material_id},
      success:function(response)
      {
        if(response!='')
        {
          var data = JSON.parse(response);
        $("#purchase_order_id").append("<option value=''>Select Purchase Order</option>");
        $.each(data, function (i, item) {
          $("#purchase_order_id").append("<option value='"+item.id+"'>" + item.purchase_order_number + "</option>");
        });
        $("#purchase_order_id").select2({
        allowedClear:true,
        placeholder:'Select Purchase Order'
      });
        }
      }
    });
  });

 
  $("#purchase_order_id").select2({
      placeholder:'Select Purchase Order',
      allowdClear:true
  });


$("#purchase_order_id").change(function(e){
  e.preventDefault();
  if($(this).val()=="" || $(this).val()==null || $(this).val()==undefined)
  {
    alert("Please Select Purchase Order..");
    return false;
  }else{
    var purchase_order_id = $(this).val();
    $.ajax({
      url:"{{route('store.getPurchaseOrder')}}",
      data:{purchase_order_id:purchase_order_id},
      type:"POST",
      success:function(response)
      {
        $("#supplier_id").html('<option value='+response.test.supplier.id+'>'+response.test.supplier.name+'</option>');
        $("#raw_material_id").html('<option value='+response.test.raw_material.id+'>'+response.test.raw_material.name+'-'+response.test.raw_material.part_description+'</option>');
        $("#type_id").html('<option value='+response.type.id+'>'+response.type.name+'</option>');
        $("#uom_id").html('<option value='+response.test.uom.id+'>'+response.test.uom.name+'</option>');
        $("#available_quantity").val(response.test.quantity);
      }
    });
  }
});

$("#inward_quantity").change(function(e){
e.preventDefault();
var avaialable = $("#available_quantity").val();
avaialable = parseFloat(avaialable);
var inward = $(this).val();
inward = parseFloat(inward);
if(avaialable=="" || avaialable==null)
{
  alert("Please Select the Purchase Order!");
}
if(inward>avaialable)
{
  alert("Inward Quantity Exceed available Quantity!");
  //$("#inward_quantity").val("");
  return false;
}
});
function material_calculation()
{
  var total_material_quantity = "{{ $store->inward_material_quantity }}";
  var ok_quantity = $("#ok_material_quantity").val();
  var reject_quantity = total_material_quantity-ok_quantity;
  $("#reject_material_quantity").val(reject_quantity);

  if(parseFloat(ok_quantity)>parseFloat(total_material_quantity)){
   
    $.toast({
                  heading: 'Error',
                  text: 'Material Quantity Exceeds Total Value',
                  showHideTransition: 'plain',
                  position: 'top-right',
                  icon: 'error'
              });
    
              $("#ok_material_quantity").val(total_material_quantity);
              $("#reject_material_quantity").val(0);
  }
}

</script>
@endpush