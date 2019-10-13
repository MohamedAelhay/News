@if($staff->is_active)
    <span class="label label-primary status" id="{{$staff->id}}">Active</span>
@else
    <span class="label label-default status" id="{{$staff->id}}">In Active</span>
@endif
