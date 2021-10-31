@if (@$all)

<input value="{{ old($all) ? old($all) : (@$var ? @$var->{$all} : @$defval) }}" style="{{ $style }}" autocomplete="off"
    type="text" name="{{ $all }}" id="{{ $all }}" class="form-control datemask datepicker {{ $all }}" @if(@$isrequired)
    required @endif @if(@$isdisabled) disabled @elseif(@$isreadonly) readonly @endif>
@error($all)
<div class="text-danger">{{ $message }}</div>
@enderror
@else

<input type="text" name="{{ $name }}" id="{{ $id }}" class="form-control datemask datepicker {{ @$class }}"
    value="{{ old($all) ? old($all) : (@$var ? @$var->{$all} : @$defval) }}" style="{{ $style }}" autocomplete="off"
    @if(@$isrequired) required @endif @if(@$isdisabled) disabled @elseif(@$isreadonly) readonly @endif>
@if (@$name)
@error($name)
<div class="text-danger">{{ $message }}</div>
@enderror
@endif
@endif