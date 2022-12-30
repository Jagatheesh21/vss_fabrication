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
            <strong>Store - Raw Material Receive Entry</strong>
        </div>
        <div class="card-body">
            <div class="col-md-12">
                <form id="operation_save" method="POST" action="{{route('store_receive.store')}}">
                  @csrf
                  @method('POST')
                  <div class="row mb-3">
                    <div class="col-sm-4">
                      <label for="grn_number" class="col-sm-4 col-form-label control-label-required">GRN Number*</label>
                      <div class="form-group">
                        <input type="text" name="grn_number" id="grn_number" class="form-control" readonly value="{{$grn_number}}" >
                      </div>
                    </div>
                    <input type="hidden" name="category_id" id="category_id" value="1">

                    <div class="col-sm-4">
                      <label for="name" class="col-sm-6 col-form-label required">Raw Material Type*</label>
                      <div class="form-group">
                        <select name="type_id" id="type_id" class="form-control select2">
                            <option value="">Select Raw Material Type</option>
                            @foreach ($types as $type)
                                <option value="{{$type->id}}">{{$type->name}}</option>
                            @endforeach
                        </select>
                        @error('type_id')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <label for="name" class="col-sm-4 col-form-label required">Raw Material*</label>
                      <div class="form-group">
                        <select name="raw_material_id" id="raw_material_id" class="form-control select2">
                        </select>
                        @error('raw_material_id')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <label for="name" class="col-sm-4 col-form-label required">Purchase Order*</label>
                      <div class="form-group">
                        <select name="purchase_order_id" id="purchase_order_id" class="form-control select2">
                        </select>
                        @error('purchase_order_id')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-sm-4 supplier_div">
                      <label for="name" class="col-sm-4 col-form-label required">Supplier*</label>
                      <div class="form-group">
                        <select name="supplier_id" id="supplier_id" class="form-control select2">
                          <option value="">Select Supplier</option>
                        </select>
                        @error('supplier_id')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <label for="name" class="col-sm-4 col-form-label required">Invoice Number*</label>
                      <div class="form-group">
                       <input type="text" name="invoice_number" id="invoice_number" class="form-control">
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
                        </select>
                        @error('uom_id')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <label for="name" class="col-sm-6 col-form-label required">Available Quantity*</label>
                      <div class="form-group">
                      <input type="text" name="available_quantity" id="available_quantity" readonly class="form-control">
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <label for="name" class="col-sm-4 col-form-label required">Quantity*</label>
                      <div class="form-group">
                      <input type="text" name="inward_quantity" id="inward_quantity" value="{{old('quantity')}}" class="form-control">
                      @error('inward_quantity')
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
<script>
  $("#type_id").select2();

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

  // $("#operation_save").submit(function(e){
  //   e.preventDefault();
  //   $.ajax({
  //     url:"{{route('store_receive.store')}}",
  //     type:"POST",
  //     data:$(this).serialize(),
  //     success:function(response)
  //     {
  //       //var result = JSON.parse(response);
  //      if(response.status==200)
  //      {
  //       //alert(response.success);
  //       $("#operation_save")[0].reset();
  //       return false;
  //      }
        
  //     },
  //     error:function(err)
  //     {
  //       if(err.status == 422)
  //       {
  //         $.each(err.responseJSON.errors, function (i, error) {
  //           //toastr.success(error[0],"Error");
  //           $.toaster({ priority : 'error', title : 'Validation Error', message : error[0]});
  //           //alert(error[0]);
  //               // var el = $(document).find('[name="'+i+'"]');
  //               // el.after($('<span style="color: red;">'+error[0]+'</span>'));
  //           });

  //       }
  //     }
  //   });
  // });
  // var type_id  = $("#type_id option:selected").val();
  // function getmaterial()
  // {
  //   $.ajax({
  //   url:"{{route('general.materials')}}",
  //   type:"POST",
  //   headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
  //   data:{type_id:type_id},
  //   success:function(response)
  //   {
  //     $("#raw_material_id").html(response.html);
  //     $("#raw_material_id").select2({
  //       allowedClear:true,
  //       placeholder:'Select Material'
  //     });
  //     $(".uom_div").show();
  //     $("#uom_id").select2({
  //       allowedClear:true,
  //       placeholder:'Select UOM'
  //     });
  //   }
  //  });
  // }
  // if(type_id!='')
  // {
  //   getmaterial();
  // }
  // $("#type_id").select2({
  //     placeholder:'Select Type',
  //     allowdClear:true
  // });
  $("#purchase_order_id").select2({
      placeholder:'Select Purchase Order',
      allowdClear:true
  });

// Ajax 
// $("#type_id").change(function(e){
//    e.preventDefault();
//    getmaterial();
// });
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
</script>
@endpush