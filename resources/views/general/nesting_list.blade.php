@foreach($nesting_sequences as $key=>$child_part)
<div class="row mb-5" id="{{$loop->iteration}}" >
    <div class="col-md-3">
        <div class="form-group">
            <label class="col-sm-6 col-form-label" for="">Nesting Type* </label>
            <select name="nesting_type_id[]" id="nesting_type_id_{{$loop->iteration}}" class="nesting_type_id form-control select2">
                <option value="">Select Nesting Type</option>
                @foreach ($nesting_types as $nesting_type)
                    @if ($nesting_type->id==$child_part->nesting_type_id)
                    <option value="{{$nesting_type->id}}">{{$nesting_type->name}}</option>   
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="col-sm-8 col-form-label" for="">Child Part Number* </label>
            <select name="child_part_number_id[]" id="child_part_number_id_{{$loop->iteration}}" class="form-control select2">
              <option value="">Select Child Part Number</option>  

            </select>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label for="" class="col-sm-12 col-form-label">Estimate Quantity</label>
            <input type="text" name="estimate_quantity[]" id="estimate_quantity_{{$loop->iteration}}" class="form-control" >
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label for="" class="col-sm-12 col-form-label">Unit Weight (Grms)</label>
            <input type="number" name="unit_weight[]" id="unit_weight_{{$loop->iteration}}" min="1" max="999.99" class="form-control" >
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label for="" class="col-sm-12 col-form-label">Useage Weight(KG)</label>
            <input type="text" name="useage_weight[]" id="useage_weight_{{$loop->iteration}}" class="form-control" readonly >
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
        data:{raw_material_id:raw_material_id,nesting_id:nesting_id,nesting_type_id:$(this).val()},
        success:function(response)
        {
            var data = JSON.parse(response);
            $.each(data, function (i, item) {
              $("#child_part_number_id_{{$loop->iteration}}").append("<option value='"+item.id+"'>" + item.name + "</option>");
            });
            $("#child_part_number_id_{{$loop->iteration}}").select2({
            allowedClear:true,
            placeholder:'Select Child PartNumber'
            });
            
        }
    });
});    
$("body").on("change","#child_part_number_id_{{$loop->iteration}}",function(e){
var nesting_type_id = $("#nesting_type_id_{{$loop->iteration}}").val();
$.ajax({
    url:"{{route('store.nesting_quantity')}}",
    type:"POST",
    data:{raw_material_id:raw_material_id,nesting_id:nesting_id,nesting_type_id:nesting_type_id,child_part_number_id:$(this).val()},
    success:function(response)
    {
        $("#estimate_quantity_{{$loop->iteration}}").val(response);        
    }
});
});
$("body").on("change","#unit_weight_{{$loop->iteration}}",function(e){
    e.preventDefault();
    var estimate_quantity = $("#estimate_quantity_{{$loop->iteration}}").val(); 
    var unit_quantity = $(this).val(); 
    var useage = estimate_quantity*unit_quantity;
    useage = useage/1000;
    $("#useage_weight_{{$loop->iteration}}").val(useage);
    calculate();
});
function calculate()
{
    var count = {{$loop->count}};
    var total_useage = 0;
    for(var i=1; i<=count; i++) {
        var useage = $("#useage_weight_"+i).val();
        total_useage = parseFloat(total_useage+useage).toFixed(2);
    }
    var avaialable = $("#avaialble_quantity").val();
    $("#total_useage_weight").val(total_useage);
    avaialable = parseFloat(avaialable).toFixed(2);
    // if(total_useage>avaialable)
    // {
    //     alert("Exceeding the Available Quantity!");
    //     $("#total_useage_weight").val(0);
    //     return false;
    // }
    var balance = parseFloat(avaialable-total_useage).toFixed(2);
    $("#balance_weight").val(balance);

}
</script>
@endforeach
<div class="row justify-content-end">
<div class="col-md-3">
    <label for="">Total Useage Weight</label>
    <input type="number" name="total_useage_weight" id="total_useage_weight" class="form-control" min="1" readonly value="0">
</div>
</div>
<div class="row justify-content-end">
    <div class="col-md-3">
        <label for="">Balance Weight</label>
        <input type="number" name="balance_weight" id="balance_weight" class="form-control" min="1" readonly value="0">
    </div>
    </div>