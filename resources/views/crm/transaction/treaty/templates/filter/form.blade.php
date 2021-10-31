<form method="get" action="{{ $url }}">
  @csrf
  <div class="row">
    <div class="col-md-12 com-sm-12 mt-3">
      {{ @$test }}
      <div class="row">

        <label for="" class="col-1">{{ __('Treaty Year') }}</label>
        <div class="col-md-1 form-group">
          <input type="text" name="treatyyear" id="treatyyear" class="form-control form-control-sm yearmask"
            autocomplete="off">
        </div>

        @if (request()->path() == "treaty/prop/list")
        <div class="col-md-4 form-group">
          <div class="row">
            <div class="col-md-2 text-right">
              <label>{{ __('Period') }}</l>
            </div>
            <div class="col-md-3">
              <input type="text" name="periodfrom" id="periodfrom"
                class="form-control form-control-sm mx-2 datemask datepicker" autocomplete="off">
            </div>
            <div class="col-md-2 text-right">
              <label>{{ __('To') }}</label>
            </div>
            <div class="col-md-3">
              <input type="text" name="periodto" id="periodto"
                class="form-control form-control-sm ml-2 datemask datepicker" autocomplete="off">
            </div>
          </div>
        </div>

      </div>
      @else
      <label for="" class="col-1 text-right">{{ __('Prod Year') }}</label>
      <div class="col-md-1 form-group">
        <input type="text" name="prodyear" id="prodyear" class="form-control form-control-sm yearmask"
          autocomplete="off">
      </div>
    </div>
    @endif

    @if (request()->path() == "treaty/soa/nil/list")
    <div class="row">
      <label for="" class="col-1">{{ __('Reg Number') }}</label>
      <div class="col-md-5 form-group">
        <input type="text" class="form-control form-control-sm" name="reg_number">
      </div>
    </div>
    <div class="row">
      <label for="" class="col-1">{{ __('Ref Number') }}</label>
      <div class="col-md-5 form-group">
        <input type="text" class="form-control form-control-sm" name="ref_number">
      </div>
    </div>
    @endif

    <div class="row">
      <label for="" class="col-1">{{ __('Ceding/Broker') }}</label>
      <div class="col-md-5 form-group">
        <select id="ceding_broker" name="ceding_broker" class="e1 form-control form-control-sm">
          <option selected disabled>{{ __('Ceding/Broker') }}</option>
          @foreach ($ceding as $c)
          @if ($c->id == @$ceding_broker)
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
      <div class="col-md-5 form-group">
        <select id="ceding_company" name="ceding_company" class="e1 form-control form-control-sm">
          <option selected disabled>{{ __('Ceding Company') }}</option>
          @foreach ($ceding as $c)
          @if ($c->id == @$ceding_company)
          <option value="{{ $c->id }}" selected>{{ $c->name }}
            @else
          <option value="{{ $c->id }}">{{ $c->name }}</option>
          @endif
          @endforeach
        </select>
      </div>
    </div>

    <div class="row">
      <label for="" class="col-1">{{ __('COB') }}</label>
      <div class="col-md-5 form-group">
        <select id="cob_input" name="cob_input" class="e1 form-control form-control-sm">
          <option selected disabled>{{ __('COB') }}</option>
          @foreach ($cob as $c)
          @if ($c->id == @$cob_input)
          <option value="{{ $c->id }}" selected>{{ $c->description }}
            @else
          <option value="{{ $c->id }}">{{ $c->description }}</option>
          @endif
          @endforeach
        </select>
      </div>
    </div>

    <div class="row">
      <label for="" class="col-1">{{ __('KOC') }}</label>
      <div class="col-md-5 form-group">
        <select id="koc_input" name="koc_input" class="e1 form-control form-control-sm">
          <option selected disabled>{{ __('KOC') }}</option>
          @foreach ($koc as $c)
          @if ($c->id == @$koc_input)
          <option value="{{ $c->id }}" selected>{{ $c->description }}
            @else
          <option value="{{ $c->id }}">{{ $c->description }}</option>
          @endif
          @endforeach
        </select>
      </div>
    </div>

    @if (request()->path() == "treaty/prop/list")
    <div class="row">
      <label for="" class="col-1">{{ __('Status') }}</label>
      <div class="col-md-5 form-group">
        <select id="status" name="status" class="e1 form-control form-control-sm">
          <option value="" selected disabled>{{ __('Select Status') }}</option>
          <option value="Pre Summary">Pre Summary</option>
          <option value="Draft">Draft</option>
          <option value="Original">Original</option>
          <option value="Endorsment">Endorsment</option>
        </select>
      </div>
    </div>
    @endif

  </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <button type="submit" class="btn btn-md btn-primary">{{ @$button_text ? $button_text : 'Search' }}</button>
      </div>
    </div>
  </div>
  
</form>