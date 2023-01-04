@extends('layouts.app')
@push('styles')

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
            <strong>Store - Child Part Receive Entry</strong>
        </div>
        <div class="card-body">
            <div class="col-md-12">
                <form id="operation_save" method="POST" action="{{route('store_receive.store')}}">
                  @csrf
                  @method('POST')
                  <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="" class="control-label required">Stocking Point*</label>
                            <select name="operation_id" id="operation_id" class="form-control select2">
                                <option value="">Select Stocking Point</option>
                                @foreach ($operations as $operation)
                                @if($operation->id==1)
                                    <option value="{{$operation->id}}" selected>{{$operation->name}}</option>
                                @endif
                                    @endforeach
                            </select>
                        </div>                    
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="" class="control-label required">Child Part Number*</label>
                            <select name="child_part_number_id" id="child_part_number_id" class="form-control select2">
                                <option value="">Select Child Part Number</option>
                                @foreach ($child_part_numbers as $child_part_number)
                                    <option value="{{$child_part_number->id}}">{{$child_part_number->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div> 
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="" class="control-label required">Prev.Route Card*</label>
                            <select name="prev_route_card_id" id="prev_route_card_id" class="form-control select2">
                                <option value="">Select Route Card </option>

                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <table class="table table-bordered table-responsive text-bold m-3">
                            
                            <tr>
                                <th></th>
                                <th class="text-center">Item Description</th>
                                <th class="text-center">Issued Quantity</th>
                            </tr>
                            <tr>
                              <td class="text-bold text-center">Previous Route Card Details</td>
                                <td>
                                    <div class="form-group">
                                        <select name="raw_material_id" id="raw_material_id" class="form-control select2">
                                            <option value="">Select Item Description</option>

                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" name="issued_quantity" id="issued_quantity" required readonly class="form-control">
                                    </div>
                                </td>
                            </tr>
                            
                        </table>
                        <table>
                          <tr>
                            <th></th>
                          </tr>
                        </table>
                        <tr>
                          <td></td>
                          <td>CLOSE RC</td>
                            <td><div class="form-group">
                              <div class="form-check form-check-inline close_rc">
                                <input class="form-check-input" type="radio" name="close_rc" id="yes" value="YES">
                                <label class="form-check-label" for="inlineRadio1">YES</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="close_rc" id="no" value="NO" checked>
                                <label class="form-check-label" for="inlineRadio2">NO</label>
                              </div>
                            </div></td>
                          <td></td>
                        </tr>
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
<script>
  $(".close_rc").hide();
  $("#child_part_number_id").select2();
  $("#operation_id").select2();

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
        $("#available_quantity").val(response.test.total_quantity);
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
</script>
@endpush