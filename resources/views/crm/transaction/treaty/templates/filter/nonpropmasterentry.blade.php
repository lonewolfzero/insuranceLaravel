<div class="row">
<label for="" class="col-2">{{ __('ID') }}</label>
<div class="col-md-6 form-group d-flex">
    <input type="text" name="idmaster" id="idmaster" class="form-control form-control-sm ml-2" autocomplete="off">
</div>

<label for="" class="col-1">{{ __('Date Entry') }}</label>
<div class="col-md-3 form-group d-flex">
    <input type="text" name="periodfrom" id="periodfrom" class="form-control form-control-sm ml-2" autocomplete="off">
</div>
</div>

<div class="row">
<label for="" class="col-2">{{ __('Ceding/Broker') }}</label>
<div class="col-md-6 form-group d-flex">
<select id="cedingsource" name="cedingsource" class="e1 form-control form-control-sm ml-2">
<option selected disabled>{{ __('Ceding/Broker') }}</option>
@foreach ($ceding as $c)
@if ($c->id == @$cedingsource)
<option value="{{ $c->id }}" selected>{{ $c->name }}
    @else
<option value="{{ $c->id }}">{{ $c->name }}</option>
@endif
@endforeach
</select>
</div>

<label for="" class="col-1">{{ __('user') }}</label>
<div class="col-md-3 form-group d-flex">
<input type="text" name="userdata" id="userdata" class="form-control form-control-sm ml-2" autocomplete="off">
</div>
</div>

<div class="row">
<label for="" class="col-2">{{ __('UW Year') }}</label>
<div class="col-md-3 form-group d-flex">
<input type="text" name="periodfrom" id="periodfrom" class="form-control form-control-sm ml-2" autocomplete="off">
</div>

<label for="" class="col-1">{{ __('Ceding type') }}</label>
<div class="col-md-3 form-group d-flex">
<input type="text" name="cedingtype" id="cedingtype" class="form-control form-control-sm ml-2" autocomplete="off">
</div>
</div>
                                    