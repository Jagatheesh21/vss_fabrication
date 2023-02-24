<table class="table table-responsive table-bordered" id="tab_logic">
    <thead class="text-center bg-secondary text-white">
    <tr>
        <th>Type</th>
        <th>Child Part Number</th>
        <th>Quantity (Nos)</th>
        <th>BOM(KG)</th>
        <th>Total Quantity(KG)</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <tr class="nesting_row">
        <td>
            <div class="col-md-12">
                <div class="form-group">
                    <select name="nesting_type_id[]" class="type_id form-control select2">
                        <option value="">Select Type</option>
                        @foreach ($types as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </td>
        <td>
            <div class="col-md-12">
                <div class="form-group">
                    <select name="child_part_number_id[]" class="child_part_number_id form-control select2">
                        <option value="">Select Child Part Number</option>
                    </select>
                </div>
            </div>
        </td>
        <td>
            <div class="col-md-12">
                <div class="form-group">
                    <input type="number" class="form-control issue_quantity" name="quantity[]" value="1">
                </div>
            </div>
        </td>
        <td>
            <div class="col-md-12">
                <div class="form-group">
                    <input type="number" class="form-control bom" name="unit_weight[]" value="0">
                </div>
            </div>
        </td>
        <td>
            <div class="col-md-12">
                <div class="form-group">
                    <input type="number" class="form-control total_issue_quantity" name="useage_weight[]" value="0">
                </div>
            </div>
        </td>
        <td>
            <div class="btn-toolbar">
            <div class="btn-group mr-1">
                <button type="button" class="btn btn-success btn-sm text-white add mr-2">+</button>
            </div>
            </div>
        </td>
    </tr>
    </tbody>
    <tfoot>
    <tr>
        <td colspan="4" align="right">
            <div class="col-md-3">
                <label for="">Total Useage Weight</label>
            </div>
        </td>
        <td colspan="2">
            <div class="col-md-9">
                <input type="number" name="total_useage_weight" id="total_useage_weight" class="form-control" min="1" readonly value="0">
            </div>
        </td>
    </tr>
    <tr>
        <td colspan="4" align="right">
            <div class="col-md-3">
                <label for="">Balance Weight</label>
            </div>
        </td>
        <td colspan="2">
            <div class="col-md-9">
                <input type="number" name="balance_weight" id="balance_weight" class="form-control" min="1" readonly value="0">
            </div>
        </td>
    </tr>
    <tr>
        <td colspan="4" align="right">
            <div class="col-md-3">
                <label for="">% Utilization</label>
            </div>
        </td>
        <td colspan="2">
            <div class="col-md-9">
                <input type="number" name="utilization" id="utilization" class="form-control" min="1" readonly value="0">
            </div>
        </td>
    </tr>
<tfoot>

<script>
    $(".type_id").select2({
        placeholder:"Select Type",
        allowedClear:true,
    });        
    $(".child_part_number_id").select2({
        placeholder:"Select Child Part Number",
        allowedClear:true,
    });
    $('body').on('click','.add',function(e){
        e.preventDefault();
        $.ajax({
            url:"{{ route('sheet_nesting.nesting_master') }}",
            type:"GET",
            success:function(response){
                $("#tab_logic tbody").append(response.html);
            }
        });
    });

    $('body').on('click','.remove',function(e){
        e.preventDefault();
        $(this).closest(".nesting_row").remove();
        calculate_bom($(this));
    });

    $('body').on('change','.type_id',function(e){
        e.preventDefault();
        var main = $(this);
        if($(this).val()=="" || $(this).val()==null || $(this).val()==undefined){
            alert("Type Value is Required!");
            return false;
        }
        $.ajax({
            url:"{{ route('store_issue.nesting_child_parts')}}",
            type:"POST",
            data:{type_id:$(this).val()},
            success:function(response)
            {
                $(main).closest(".nesting_row").find(".child_part_number_id").html(response);
            }
        });
    });

    $('body').on('change','.child_part_number_id',function(e){
        e.preventDefault();
        var main = $(this);
        if($(this).val()=="" || $(this).val()==null || $(this).val()==undefined){
            alert("Child Part Number is Required!");
            return false;
        }
        $.ajax({
            url:"{{ route('store_issue.child_part_bom')}}",
            type:"POST",
            data:{child_part_number_id:$(this).val()},
            success:function(response)
            {
                $(main).closest(".nesting_row").find(".bom").val(response);
                $(main).closest(".nesting_row").find(".total_issue_quantity").val(response);
                calculate_bom();
            }
        });
    });
    
    $('body').on('change','.issue_quantity',function(e){
        e.preventDefault();
        var main = $(this);
        if($(this).val()=="" || $(this).val()==null || $(this).val()==undefined){
            alert("Quanity is Required!");
            return false;
        }
        if($(this).val()<1){
            alert("Quanity value is Invalid");
        }
        calculate_bom(main);
    });        
    function calculate_bom(main)
    {
        var bom = $(main).closest(".nesting_row").find(".bom").val();
        var quantity = $(main).closest(".nesting_row").find(".issue_quantity").val();
        var total_quantity = parseFloat(bom)*parseFloat(quantity);
        var available_stock_quantity = $("#issue_unit_quantity").val();
        var total_useage_quantity = 0;
        $(main).closest(".nesting_row").find(".total_issue_quantity").val(total_quantity.toFixed(3));
        $(".nesting_row").each(function( index,value ) {
            var useage_quantity = $(this).find('.total_issue_quantity').val();
            total_useage_quantity = parseFloat(total_useage_quantity)+parseFloat(useage_quantity);
        });
        $("#total_useage_weight").val(total_useage_quantity.toFixed(3));
        var balance_quantity = parseFloat(available_stock_quantity)-parseFloat(total_useage_quantity);
        $("#balance_weight").val(balance_quantity.toFixed(3));
        var utilization = ((total_useage_quantity/available_stock_quantity)*100).toFixed(2);
        $("#utilization").val(utilization);

    }
</script>