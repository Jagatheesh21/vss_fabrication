  <td>{{ $count }}</td>
  <td>
    <div class="col-md-12">
      <select class="form-control" name="raw_material_id[]" id="raw_material_id_{{ $count }}">
        <option value="">Select Raw Material</option>
        @foreach ($raw_materials as $raw_material)
            <option value="{{ $raw_material->id }}">{{ $raw_material->type->name }}-{{ $raw_material->name }}</option>
        @endforeach
      </select>
    </div>
    </td>
  <td>
    <div class="col-md-12">
      <input type="number" name='quantity[]' id="qty_{{ $count }}" placeholder='Enter Qty' class="form-control qty" step="0" min="0"/></td>

    </div>
  <td>
    <div class="col-md-12">
      <input type="number" name='price[]' id="price_{{ $count }}" placeholder='Enter Unit Price' class="form-control price" step="0.00" min="0"/></td>
    </div>
  <td>
    <div class="col-md-12"> 
      <input type="number" name='total[]' id="total_{{ $count }}" placeholder='0.00' class="form-control total" readonly/></td>
    </div>
  </td>
<script>
  $("#raw_material_id_{{ $count }}").select2({
    allowedClear:true,
    placeholder:"Select Material",
  });
</script>