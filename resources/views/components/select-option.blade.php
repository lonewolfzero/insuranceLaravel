@if(@$all)
<select name="{{ $all }}" id="{{ $all }}" class="e1 form-control {{ $all }}" @if(@$isrequired) required @endif
    @if(@$isdisabled) disabled @endif>
    <option value="" disabled selected>{{ $text }}</option>
    @foreach ($master as $m)
    <option value="{{ $m->id }}" @if(old($all)==$m->id) selected @elseif(@$var->{$all} == $m->id) selected @endif>
        {{ $m->{$col1} }}@if(@$col2) - {{ $m->{$col2} }}@endif
    </option>
    @endforeach
</select>
@error($all)
<div class="text-danger">{{ $message }}</div>
@enderror
@else
<select name="{{ @$name }}" id="{{ @$id }}" class="e1 form-control {{ @$class }}" @if(@$isrequired) required @endif
    @if(@$isdisabled) disabled @endif>
    <option value="" disabled selected>{{ @$text }}</option>
    @foreach (@$master as $m)
    <option value="{{ $m->id }}" @if(old($all)==$m->id) selected @elseif(@$var->{@$name} == $m->id) selected @endif>
        {{ $m->{@$col1} }}@if(@$col2) - {{ $m->{$col2} }}@endif
    </option>
    @endforeach
</select>
@if (@$name)
@error($name)
<div class="text-danger">{{ $message }}</div>
@enderror
@endif
@endif