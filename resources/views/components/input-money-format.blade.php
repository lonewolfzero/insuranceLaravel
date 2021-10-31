@if (@$all)

<input type="text" name="{{ $all }}" id="{{ $all }}" class="form-control money text-left {{ $all }}"
  value="{{ old($all) ? old($all) : (@$var ? @$var->{$all} : @$defval) }}" @if(@$isrequired) required @endif
  @if(@$isdisabled) disabled @elseif(@$isreadonly) readonly @endif autocomplete="off" style="{{ $style }}">
@error($all)
<div class="text-danger">{{ $message }}</div>
@enderror
@else

<input type="text" name="{{ $name }}" id="{{ $id }}" class="form-control money text-left {{ @$class }}"
  value="{{ old($all) ? old($all) : (@$var ? @$var->{$all} : @$defval) }}" @if(@$isrequired) required @endif
  @if(@$isdisabled) disabled @elseif(@$isreadonly) readonly @endif autocomplete="off" style="{{ $style }}">
@if (@$name)
@error($name)
<div class="text-danger">{{ $message }}</div>
@enderror
@endif
@endif