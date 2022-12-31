@foreach($nesting_sequences as $key=>$child_part)
<div class="row mb-5" id="{{$loop->iteration}}" >
    <div class="col-md-3">
        <div class="form-group">
            <label class="col-sm-6 col-form-label" for="">Nesting Type* </label>
            <select name="nesting_type_id[]" id="nesting_type_id_{{$loop->iteration}}" class="nesting_type_id form-control select2">
                <option value="">Select Nesting Type</option>
                @foreach ($nesting_types as $nesting_type)
                    @if ($nesting_type->id==$child_part->nesting_type_id)
                    <option value="{{$nesting_type->id}}" selected>{{$nesting_type->name}}</option>   
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="col-sm-8 col-form-label" for="">Child Part Number* </label>
            <select name="child_part_number_id" id="child_part_number_id_{{$loop->iteration}}" class="form-control select2">
              <option value="">Select Child Part Number</option>  
              
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="" class="col-sm-6 col-form-label">Estimate Quantity</label>
            <input type="text" name="estimate_quantity[]" id="estimate_quantity_{{$loop->iteration}}" class="form-control" >
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="" class="col-sm-6 col-form-label">Unit Weight</label>
            <input type="text" name="unit_weight[]" id="unit_weight_{{$loop->iteration}}" class="form-control" >
        </div>
    </div>

</div>
<script src="{{asset('js/select2.min.js')}}"></script>

<script>
var nesting_id = $("#nesting_id").val();
var raw_material_id = $("#raw_material_id").val();
$(".nesting_type_id").select2();
$("body").on("change","#nesting_type_id_{{$loop->iteration}}",function(e){
    $.ajax({
        url:"{{route('store.nesting_child_parts')}}",
        type:"POST",
        data:{nesting_id:nesting_id,nesting_type_id:nesting_type_id},
        success:function(response)
        {

        }
    });
});    
</script>
@endforeach
