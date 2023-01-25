<option value="">Select Child Part</option>
@foreach ($child_part_numbers as $child_part)
<option value="{{ $child_part->child_part->id }}">{{ $child_part->child_part->name }}</option>
@endforeach