<label for="">Child Part Number</label>
    <select name="child_part_number[]"  class="form-control select2 child_part_number_id">
        <option>Select Part Number</option>
        @foreach($part_masters as $part_master)
        <option value="{{$part_master->child_part->id}}">{{$part_master->child_part->name}}</option>
        @endforeach
    </select>