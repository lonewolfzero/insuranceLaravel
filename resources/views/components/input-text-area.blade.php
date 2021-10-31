@if (@$all)
<textarea name="{{ $all }}" id="{{ $all }}" class="form-control {{ @$all }}" rows="2" style="{{ $style }}"
    @if(@$isrequired) required @endif @if(@$isdisabled) disabled @elseif(@$isreadonly) readonly @endif
    autocomplete="off">
    {{ old($all) ? old($all) : (@$var ? @$var->{$all} : @$defval) }}
</textarea>
@error($all)
<div class="text-danger">{{ $message }}</div>
@enderror

@else

<textarea name="{{ $name }}" id="{{ $id }}" class="form-control {{ @$class }}" rows="2" style="{{ $style }}"
    @if(@$isrequired) required @endif @if(@$isdisabled) disabled @elseif(@$isreadonly) readonly @endif
    autocomplete="off">
    {{ old($name) ? old($name) : (@$var ? @$var->{$name} : @$defval) }}
</textarea>
@if (@$name)
@error($name)
<div class="text-danger">{{ $message }}</div>
@enderror
@endif
@endif