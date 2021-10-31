@if (@$all)

<input type="text" name="{{ $all }}" id="{{ $all }}" class="form-control {{ $all }}" style="{{ $style }}"
  value="{{ old($all) ? old($all) : (@$var ? @$var->{$all} : @$defval) }}" @if(@$isrequired) required @endif
  @if(@$isdisabled) disabled @elseif(@$isreadonly) readonly @endif autocomplete="off">
@error($all)
<div class="text-danger">{{ $message }}</div>
@enderror
@else

<input type="text" name="{{ $name }}" id="{{ $id }}" class="form-control {{ @$class }}"
  value="{{ old($all) ? old($all) : (@$var ? @$var->{$all} : @$defval) }}" style="{{ $style }}" autocomplete="off"
  @if(@$isrequired) required @endif @if(@$isdisabled) disabled @elseif(@$isreadonly) readonly @endif>
@if (@$name)
@error($name)
<div class="text-danger">{{ $message }}</div>
@enderror
@endif
@endif