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
  <div class="alert alert-danger" role="alert">
    <strong>Error!</strong>{{session('error')}}
    <button type="button" class="btn-close" data-coreui-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif
  
    <div class="card ">
        <div class="card-header">
            Create New Supplier 
            <a href="{{route('supplier.index')}}" class="btn btn-primary float-end">Supplier List</a>
        </div>
        <div class="card-body">
            <div class="col-md-12">
                <form id="category_save" method="POST" action="{{route('supplier.store')}}">
                  @csrf
                  @method('POST')
                    <div class="row mb-3">
                      <div class="col-md-6">
                        <label for="name" class="col-sm-2 col-form-label required">Code*</label>
                        <input type="text" class="form-control @error('code') is-invalid @enderror" id="code" name="code"  autocomplete="off" value="{{ old('name') }}">
                        @error('code')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                      <div class="col-md-6">
                        <label for="name" class="col-sm-6 col-form-label required">Company Name*</label>
                        <input type="text" class="form-control @error('company_name') is-invalid @enderror" id="company_name" name="company_name"  autocomplete="off" value="{{ old('company_name') }}">
                        @error('company_name')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                      <div class="col-md-6">
                        <label for="name" class="col-sm-2 col-form-label required">GST Number*</label>
                        <input type="text" class="form-control @error('gst_number') is-invalid @enderror" minlength="15" maxlength="15" id="gst_number" name="gst_number"  autocomplete="off" value="{{ old('gst_number') }}">
                        @error('gst_number')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                      <div class="col-md-6">
                        <label for="name" class="col-sm-12 col-form-label required">Contact Person*</label>
                        <input type="text" class="form-control @error('contact_person') is-invalid @enderror" minlength="5" maxlength="15" id="contact_person" name="contact_person"  autocomplete="off" value="{{ old('contact_person') }}">
                        @error('contact_person')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                      
                      <div class="col-md-6">
                        <label for="name" class="col-sm-4 col-form-label required">PIN Code*</label>
                        <input type="text" class="form-control @error('pin_code') is-invalid @enderror" minlength="6"  id="pin_code" name="pin_code"  autocomplete="off" value="{{ old('pin_code') }}">
                        @error('pin_code')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                      <div class="col-md-6">
                        <label for="name" class="col-sm-4 col-form-label required">State*</label>
                        <input type="text" class="form-control @error('state') is-invalid @enderror" id="state" name="state"  autocomplete="off" value="{{ old('state') }}">
                        @error('state')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                      <div class="col-md-6">
                        <label for="name" class="col-sm-4 col-form-label required">State Code*</label>
                        <input type="text" class="form-control @error('state_code') is-invalid @enderror"  minlength="2" id="state_code" name="state_code"  autocomplete="off" value="{{ old('state_code') }}">
                        @error('state_code')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                      
                      <div class="col-md-12">
                        <label for="name" class="col-sm-2 col-form-label required">Address*</label>
                        <textarea name="address" id="address" cols="20" rows="5" class="form-control @error('address') is-invalid @enderror"></textarea>
                        @error('address')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                    </div>
                   
                    <button type="submit" id="submit" class="btn btn-primary">Save</button>
                  </form>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
<script>
  // $("#category_save").submit(function(event){
  //   event.preventDefault();
  //   var data = $(this).serialize();
    
  //   $.ajax({
  //     url:'{{route('supplier.store')}}',
  //     type:'POST',
  //     data:data,
  //     success:function(response){
  //       console.log(response);
  //     }
  //   });
  // })
</script>
@endpush