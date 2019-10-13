@if($visitor->is_active)
    <span class="label label-primary status" id="{{$visitor->id}}">Active</span>
@else
    <span class="label label-default status" id="{{$visitor->id}}">In Active</span>
@endif
