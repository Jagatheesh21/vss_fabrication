@extends('layouts.app')
@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css" integrity="sha512-wJgJNTBBkLit7ymC6vvzM1EcSWeM9mmOu+1USHaRBbHkm6W9EgM0HY27+UtUaprntaYQJF75rc8gjxllKs5OIQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
            <strong>Store - Raw Material Issue Entry - Nesting</strong>
        </div>
        <div class="card-body">
            <div class="col-md-12">
                <form id="operation_save" method="POST" action="{{route('store_issue.store')}}">
                  @csrf
                  @method('POST')
                    {{-- @livewire('store-route-card-issue') --}}

                    <input type="hidden" name="route_card_type_id" value="1">
                    <div class="row mb-3">
                      <div class="col-md-4 ">
                        <div class="form-group">
                          <label for="" class="col-sm-6 col-form-label">Route Card #</label>
                          <input type="text" name="route_card_number" class="form-control bg-success" value="{{$route_card_number}}">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="col-sm-4 col-form-label" for="">Category * </label>
                          <select name="category_id" id="category_id" class="form-control">
                            <option value="">Select Category</option>
                            <option value="{{$category->id}}">{{$category->name}}</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="col-sm-4 col-form-label" for="">Type * </label>
                          <select name="type_id" id="type_id" class="form-control">
                            <option value="">Select Type First</option>
                          </select>
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="col-sm-6 col-form-label" for="">Part Description * </label>
                          <select name="raw_material_id" id="raw_material_id" class="form-control">
                            <option value="">Select Type First</option>
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
                          <label for="" class="col-sm-8 col-form-label">Available Quantity *</label>
                          <input type="text" name="available_quantity" class="form-control" id="avaialble_quantity">
                        </div>
                      </div>

                      <div class="col-md-4 sheet" style="display: none;">
                        <div class="form-group">
                          <label for="" class="col-sm-8 col-form-label">Type Of Issue *</label>
                          <select name="type_of_issue" id="type_of_issue" class="form-control select2">
                            <option value="">Select Type</option>
                            <option value="1">Nesting</option>
                            <option value="2">Unit Weight</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-4 sheet" style="display: none;">
                        <div class="form-group">
                          <label for="" class="col-sm-6 col-form-label">Nesting *</label>
                          <select name="nesting_id" id="nesting_id" class="form-control select2">
                            <option value="">Select Nesting</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12" id="list_view">

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
{{-- @livewireScripts --}}
@push('scripts')
<script src="{{asset('js/select2.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js" integrity="sha512-zlWWyZq71UMApAjih4WkaRpikgY9Bz1oXIW5G0fED4vk14JjGlQ1UmkGM392jEULP8jbNMiwLWdM8Z87Hu88Fw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script>
  $("#category_id").select2();
  $("#purchase_order_id").select2();
  $("body").on("click","#submit",function(e){
      e.preventDefault();
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
    
      }else{
      $(".sheet").show();
      $("#type_of_issue").select2();

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
      $("#avaialble_quantity").val(response);
      }
    });
    });  
  $('body').on('change','#type_of_issue',function(e){
  e.preventDefault();
  var raw_material_id = $("#raw_material_id").val();
  if($(this).val()==1)
  {
    $.ajax({
      url:"{{route('general.nestings')}}",
      type:"POST",
      data:{raw_material_id,raw_material_id},
      success:function(response)
      {
        var result = JSON.parse(response);
        $.each(result, function (i, item) {
                $("#nesting_id").append("<option value='"+item.nesting.id+"'>"+item.nesting.name+"</option>");
              });
        $("#nesting_id").select2();
      }
    });
  }
    if($(this).val()==2)
  {

  }
  });
  $('body').on('change','#nesting_id',function(e){
    e.preventDefault();
    var nesting_id = $(this).val();
    var raw_material_id = $("#raw_material_id").val();
      $.ajax({
        url:"{{route('general.nesting_list')}}",
        type:"POST",
        data:{nesting_id:nesting_id,raw_material_id:raw_material_id},
        success:function(response)
        {
          $("#list_view").html(response.html);
        }
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