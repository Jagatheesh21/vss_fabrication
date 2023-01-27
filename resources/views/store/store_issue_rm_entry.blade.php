@extends('layouts.app')
@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css" />
@endpush
{{-- @livewireStyles --}}
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
            <strong>Store - Raw Material - Sheet Issue Entry</strong>
        </div>
        <div class="card-body">
            <div class="col-md-12">
                <form id="operation_save" method="POST" action="{{route('store_issue.store')}}">
                  @csrf
                  @method('POST')
                  <input type="hidden" name="route_card_type_id" value="1">
                  <input type="hidden" name="from_operation_id" value="1">
                  <input type="hidden" name="to_operation_id" value="2">
                  <div class="row mb-3">
                      <div class="col-md-4 ">
                        <div class="form-group">
                          <label for="" class="col-sm-6 col-form-label">Route Card #</label>
                          <input type="text" name="route_card_number" class="form-control bg-success text-white" value="{{$route_card_number}}">
                        </div>
                      </div>
                      <input type="hidden" name="category_id" value="1">
                      
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="col-sm-4 col-form-label" for="">Type * </label>
                          <select name="type_id" id="type_id" class="form-control">
                            <option value="">Select Type</option>
                            @foreach ($types as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="col-sm-6 col-form-label" for="">Part Description * </label>
                          <select name="raw_material_id" id="raw_material_id" class="form-control">
                            <option value="">Select Part Description</option>
                            @foreach ($raw_materials as $raw_material)
                                <option value="{{ $raw_material->id }}">{{ $raw_material->name }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="col-sm-8 col-form-label" for="">GRN Number * </label>
                          <select name="store_stock_id" id="store_stock_id" class="form-control">
                            <option value="">Select GRN</option>
                            
                          </select>
                        </div>
                      </div>

                      
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="" class="col-sm-8 col-form-label">Available Material Quantity *</label>
                          <input type="text" name="available_quantity" class="form-control" id="avaialble_quantity">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="" class="col-sm-8 col-form-label">Availabe Unit Quantity *</label>
                          <input type="text" name="issue_unit_quantity" class="form-control" id="issue_unit_quantity" readonly>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="" class="col-sm-8 col-form-label">Availabe Stock Quantity *</label>
                          <input type="text" name="available_stock_quantity" class="form-control" id="available_stock_quantity" readonly>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="" class="col-sm-8 col-form-label">Issue Quantity *</label>
                          <input type="text" name="issue_quantity" class="form-control" id="issue_quantity" onpaste="return false;" onkeypress=" return isNumber(event)">
                        </div>
                      </div>
                      
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="" class="col-sm-8 col-form-label">Type Of Issue *</label>
                          <select name="type_of_issue" id="type_of_issue" class="form-control select2">
                            <option value="">Select Type</option>
                            <option value="1">Nesting</option>
                            <option value="2">Dynamic Nesting</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-4 sheet">
                        <div class="form-group">
                          <label for="" class="col-sm-6 col-form-label">Nesting *</label>
                          <select name="nesting_id" id="nesting_id" class="form-control select2">
                            <option value="">Select Nesting</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12 border mb-3" id="list_view">

                      </div>
                    </div>
                    <div class="row mb-0">
                        <div class="col-md-8 offset-md-4">
                           <button type="button" id="submit" class="btn btn-primary">Save</button>
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
  $("#raw_material_id").select2();
  $("#type_of_issue").select2();
  $("body").on("click","#submit",function(e){
      e.preventDefault();
      var utilization = $("#utilization").val();
      if(utilization==" " || utilization==undefined || utilization==null){
        $.toast({
                  heading: 'Error',
                  text: 'Utilization is Required!',
                  showHideTransition: 'plain',
                  position: 'top-right',
                  icon: 'error'
              });
        return false;
      }
      if(utilization!='' && utilization<70){
        $.toast({
                  heading: 'Error',
                  text: 'Utilization Should Be Greater than 70%!',
                  showHideTransition: 'plain',
                  position: 'top-right',
                  icon: 'error'
              });
              return false;
      }

      $.ajax({
        url:"{{route('store_issue.store')}}",
        type:"POST",
        data:$("#operation_save").serialize(),
        success:function(response)
        {
          $.toast({
                  heading: 'Success',
                  text: response,
                  showHideTransition: 'plain',
                  position: 'top-right',
                  icon: 'success'
              });
          
              location.reload(true);
        },
        error:function(result)
        {
          var response = $.parseJSON(result.responseText);
            $.each(response.errors, function(key, val) {
              $.toast({
                  heading: 'Error',
                  text: val,
                  showHideTransition: 'plain',
                  position: 'top-right',
                  icon: 'error'
              })
            })

        }
      });
      

    }); 
  $('body').on('change','#category_id',function(){
    var category_id = $(this).val();
    $.ajax({
      url:"{{route('general.types')}}",
      type:"POST",
      data:{category_id:category_id},
      success:function(response)
      {
        $("#type_id").html(response.html);
        $("#type_id").select2();
      }
    });
  });
  $('body').on('change','#type_id',function(e){
    e.preventDefault();
    var type_id = $(this).val();
    
    if(type_id>1)
    {
      $("#nesting_view").html(" ");
      $(".sheet").hide();
      $("#issue_quantity").removeAttr('readonly');
      $("#issue_quantity").val(' ');
      }else{
      $(".sheet").show();
      $("#type_of_issue").select2();
      $("#issue_quantity").prop('readonly','true');
      $("#issue_quantity").val(1);
    }
    $.ajax({
      url:"{{route('general.materials')}}",
      type:"POST",
      data:{type_id:type_id},
      success:function(response)
      {
        $("#raw_material_id").html(response.html);
        $("#raw_material_id").select2();
      }
    });

  
  });

  $('body').on('change','#purchase_order_id',function(e){
    e.preventDefault();
    var purchase_order_id = $(this).val();
    $.ajax({
      url:"{{route('general.suppliers')}}",
      type:"POST",
      data:{purchase_order_id:purchase_order_id},
      success:function(response)
      {
        $("#supplier_id").html(response.html);
        $("#supplier_id").select2();
      }
    });
  });
  $('body').on('change','#supplier_id',function(e){
    e.preventDefault();
    //alert($(this).val());
    var purchase_order_id = $("#purchase_order_id").val();
    var supplier_id = $(this).val();
    $.ajax({
      url:"{{route('general.avaialable_quantity')}}",
      type:"POST",
      data:{purchase_order_id:purchase_order_id},
      success:function(response){
        $("#avaialble_quantity").val(response.quantity);
      }
    });
  });
  $('body').on('change','#raw_material_id',function(e){
    e.preventDefault();
    var type_id = $("#type_id").val();
    var raw_material_id = $(this).val();
    if(type_id==1)
    {
      $.ajax({
        url:"{{route('general.grns')}}",
        type:"POST",
        data:{type_id:type_id,raw_material_id:raw_material_id},
        success:function(response)
        {
            var data = JSON.parse(response);
            if(data!='')
            {
            $("#store_stock_id").append("<option value=''>Select GRN</option>");
            $.each(data, function (i, item) {
              $("#store_stock_id").append("<option value='"+item.id+"'>" + item.grn_number + "</option>");
            });
            $("#store_stock_id").select2({
            allowedClear:true,
            placeholder:'Select GRN'
            });
          }else{
            $("#store_stock_id").html(" ");
            $("#store_stock_id").val(false).trigger( "change" );
            $("#avaialable_quantity").val(" ");
          }
          
        }

      });
    }else{
      $("#store_stock_id").val("");
      $("#avaialable_quantity").val("");
      $.ajax({
        url:"{{route('store.getChildPartNumber')}}",
        type:"POST",
        data:{type_id:type_id,raw_material_id:raw_material_id},
        success:function(response)
        { 
          
        }
      });
    }
  });
  $('body').on('change','#store_stock_id',function(e){
    e.preventDefault();
    var type_id = $("#type_id").val();
    $.ajax({
      url:"{{route('general.avaialable_quantity')}}",
      type:"POST",
      data:{store_stock_id:$(this).val(),type_id:type_id},
      success:function(response){
        console.log(response);
        $("#avaialble_quantity").val(response.available_quantity);
        $("#issue_unit_quantity").val(response.unit_weight);
        $("#available_stock_quantity").val(response.balance_quantity);
      }
    });
    });  
  $('body').on('change','#type_of_issue',function(e){
  e.preventDefault();
  var raw_material_id = $("#raw_material_id").val();
  $("#list_view").html(" ");
  $("#nesting_id").html("<option value=''>Select Nesting</option>");
  if($(this).val()==1)
  {
    $(".sheet").show();
    $.ajax({
      url:"{{route('store.sheet_nestings')}}",
      type:"POST",
      data:{raw_material_id,raw_material_id},
      success:function(response)
      {
        var result = JSON.parse(response);  
        $.each(result, function (i, item) {
                $("#nesting_id").append("<option value='"+item.nesting_number+"'>"+item.nesting_number+"</option>");
              });
        $("#nesting_id").select2();
      }
    });
  }
    if($(this).val()==2)
  {
    $("#nesting_view").html(" ");
    $(".sheet").hide();
    $("#list_view").html(" ");
    $.ajax({
      url:"{{ route('store.dynamic_nesting') }}",
    type:"GET",
      success:function(response)
      {
        $("#list_view").html(response);
      }
    });
  }
  });
  $('body').on('change','#nesting_id',function(e){
    e.preventDefault();
    var nesting_id = $(this).val();
      $.ajax({
        url:"{{route('store.sheet_nesting_lists')}}",
        type:"POST",
        data:{nesting_id:nesting_id},
        success:function(response)
        {
          $("#list_view").html(response);
        }
      });
      $("body").on("click",".add",function(e){
            e.preventDefault();
            $.ajax({
                url:"{{ route('sheet_nesting.nesting_master') }}",
                type:"GET",
                success:function(response){
                    $("#tab_logic").append(response.html);
                }
            });
        });
  // $('body').on('change','#nesting_type_id',function(e){
  //   e.preventDefault();
  //   var nesting_type_id = $(this).val();
  //   var nesting_id = $("#nesting_id").val();
  //   var raw_material_id = $("#raw_material_id").val();
  //     $.ajax({
  //       url:"{{route('general.nesting_part_numbers')}}",
  //       type:"POST",
  //       data:{nesting_id:nesting_id,raw_material_id:raw_material_id,nesting_type_id:nesting_type_id},
  //       success:function(response)
  //       {
  //         console.log(response.html);
  //         $("#child_part_number_id").html(response.html);
  //         $("#child_part_number_id").select2();
  //       }
  //     }); 
  // });
  });
  </script>
@endpush