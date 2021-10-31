<form method="get" action="{{ url($url) }}">
  @csrf
  <div class="row">
    <div class="col-md-12 com-sm-12 mt-3">

      <div class="row">
        
        <div class="col-md-12">
            <div class="card-header bg-gray">
              Filter
            </div>
            <div class="card card-primary">
                <div class="card-body">

                    <div class="row">

                        <label for="" class="col-1">{{ __('Treaty Year') }}</label>
                        <div class="col-md-3 form-group d-flex">
                            <input type="text" name="periodfrom" id="periodfrom" class="form-control form-control-sm ml-2" autocomplete="off">
                        </div>


                        <label for="" class="col-1">{{ __('Prod Year') }}</label>
                        <div class="col-md-3 form-group d-flex">
                            <input type="text" name="periodfrom" id="periodfrom" class="form-control form-control-sm ml-2" autocomplete="off">
                        </div>

                    </div>

                    <div class="row">
                        <label for="" class="col-1">{{ __('Ceding/Broker') }}</label>
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
                    </div>

                    <div class="row">
                        <label for="" class="col-1">{{ __('Ceding Company') }}</label>
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
                    </div>


                    <div class="row">
                        <div class="col-md-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-md btn-primary">{{ @$button_text ? $button_text : 'Search' }}</button>
                        </div>
                        </div>
                    </div>
  

                </div>
            </div>
        </div>

  </div>
  </div>

  
</form>