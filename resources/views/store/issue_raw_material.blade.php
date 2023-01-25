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
        <strong>Store - Raw Material Issue Entry </strong>
    </div>
    <div class="card-body">
        <div class="col-md-12">
            <form id="operation_save" method="POST" >
                @csrf
                @method('POST')
                <div class="row">
                    <input type="hidden" name="route_card_type_id" value="1">
                    <div class="col-md-4 ">
                        <div class="form-group">
                          <label for="" class="col-sm-6 col-form-label">Route Card #</label>
                          <input type="text" name="route_card_number" class="form-control bg-success text-white" value="{{$route_card_number}}">
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
</div>
@endsection
@push('scripts')
<script src="{{asset('js/select2.min.js')}}"></script>
<script>
    $("#previous_route_card_id").select2();

</script>
@endpush