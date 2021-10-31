<form method="get" action="{{ $url }}">
  @csrf
  <div class="row">
    <div class="col-md-12 com-sm-12 mt-3">

      <div class="row">
        
        <div class="col-md-12">
            <div class="card-header bg-gray">
              Master Contract
            </div>
            <div class="card card-primary">
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-7 form-group d-flex">
                        </div>
                        <div class="col-md-5 form-group d-flex">
                            <button type="button" class="btn btn-md btn-primary">{{ 'Print' }}</button>&nbsp;&nbsp;&nbsp;
                            <button type="button" class="btn btn-md btn-primary">{{ 'Attach Document' }}</button>
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
                        <label for="" class="col-1">{{ __('UW Year') }}</label>
                        <div class="col-md-3 form-group d-flex">
                            <input type="text" name="periodfrom" id="periodfrom" class="form-control form-control-sm ml-2" autocomplete="off">
                        </div>

                        <label for="" class="col-1">{{ __('Ceding type') }}</label>
                        <div class="col-md-3 form-group d-flex">
                            <select id="cedingsource" name="cedingsource" class="e1 form-control form-control-sm ml-2">
                            <option selected disabled>{{ __('Ceding type') }}</option>
                            @foreach ($ceding as $c)
                            @if ($c->id == @$cedingsource)
                            <option value="{{ $c->id }}" selected>{{ $c->name }}
                                @else
                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                            @endif
                            @endforeach
                            </select>
                        </div>

                        <label for="" class="col-1">{{ __('Date Entry') }}</label>
                        <div class="col-md-3 form-group d-flex">
                            <input type="text" name="periodfrom" id="periodfrom" class="form-control form-control-sm ml-2" autocomplete="off">
                        </div>

                    </div>

                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card-header bg-gray">
              Sub Master Contract
            </div>
            <div class="card card-primary">
                <div class="card-body">

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
                        <label for="" class="col-1">{{ __('Period') }}</label>
                        <div class="col-md-3 form-group d-flex">
                            <input type="text" name="periodfrom" id="periodfrom" class="form-control form-control-sm ml-2" autocomplete="off">
                        </div>


                        <label for="" class="col-1">{{ __('To') }}</label>
                        <div class="col-md-3 form-group d-flex">
                            <input type="text" name="periodfrom" id="periodfrom" class="form-control form-control-sm ml-2" autocomplete="off">
                        </div>

                    </div>

                    <div class="row">
                        <label for="" class="col-1"></label>
                        <div class="col-md-6 form-group d-flex">
                            
                        <div class="card-body row">
                            <div class="form-check col-6 text-center">
                                <input class="form-check-input" type="radio" name="local1" id="local1"
                                value="option1" checked>
                                <label class="form-check-label" for="local1">
                                Local
                                </label>
                            </div>
                            <div class="form-check col-6 text-center">
                                <input class="form-check-input" type="radio" name="overseas" id="overseas"
                                value="option2">
                                <label class="form-check-label" for="overseas">
                                Overseas
                                </label>
                            </div>
                        </div>

                        </div>
                    </div>


                </div>
            </div>
        </div>


        <div class="col-md-12">
            <div class="card-header bg-gray">
             Group COB
            </div>
            <div class="card card-primary">
                <div class="card-body">

                    <div class="row">
                        <label for="" class="col-1">{{ __(' Group COB') }}</label>
                        <div class="col-md-5 form-group d-flex">
                            <select id="cedingsource" name="cedingsource" class="e1 form-control form-control-sm ml-2">
                            <option selected disabled>{{ __('COB') }}</option>
                            @foreach ($cob as $c)
                            @if ($c->id == @$cedingsource)
                            <option value="{{ $c->id }}" selected>{{ $c->description }}
                                @else
                            <option value="{{ $c->id }}">{{ $c->description }}</option>
                            @endif
                            @endforeach
                            </select>
                        </div>
                        
                        <label for="" class="col-1">{{ __(' EGRPI ') }}</label>
                        <div class="col-md-5 form-group d-flex">
                            <input type="text" name="egrpi" id="egrpi" class="form-control form-control-sm ml-2" autocomplete="off">
                        </div>
                    </div>

                   
                    <div class="row">
                        <label for="" class="col-1">{{ __(' Type Of Treaty ') }}</label>
                        <div class="col-md-5 form-group d-flex">
                            <input type="text" name="typetreaty" id="typetreaty" class="form-control form-control-sm ml-2" autocomplete="off">
                        </div>

                        <div class="col-md-3 form-group d-flex">
                        </div>

                        <div class="col-md-3 form-group d-flex">
                            <button type="submit" class="btn btn-primary btn-block ">
                                {{__('Add  ')}}
                            </button>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <label for="" class="col-1">{{ __(' Detail COB List') }}</label>
                        <div class="col-md-5 form-group d-flex">
                            <select id="cedingsource" name="cedingsource" class="e1 form-control form-control-sm ml-2">
                            <option selected disabled>{{ __('Detail COB List') }}</option>
                            @foreach ($cob as $c)
                            @if ($c->id == @$cedingsource)
                            <option value="{{ $c->id }}" selected>{{ $c->description }}
                                @else
                            <option value="{{ $c->id }}">{{ $c->description }}</option>
                            @endif
                            @endforeach
                            </select>
                        </div>
                        
                        <div class="col-md-5 form-group d-flex">
                            <input type="text" name="egrp1" id="egrp1" class="form-control form-control-sm ml-2" autocomplete="off">
                        </div>
                        <label for="" class="col-1">{{ __(' % ') }}</label>
                        
                    </div>

                    <div class="row">
                        <div class="col-md-4 form-group d-flex">
                             {{ __(' COB  ') }}
                        </div>
                        <div class="col-md-4 form-group d-flex">
                             {{ __(' OGRP1 % ') }}
                        </div>
                        <div class="col-md-4 form-group d-flex">
                            {{ __(' AMOUNT  ') }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 form-group d-flex">
                             {{ __(' 11  ') }}
                        </div>
                        <div class="col-md-4 form-group d-flex">
                             {{ __(' 0.0 % ') }}
                        </div>
                        <div class="col-md-4 form-group d-flex">
                            {{ __(' AMOUNT *x   ') }}
                        </div>
                    </div>

                    <div class="col-md-12">
                      <div class="row justify-content-center">
                            <div class="row">   
                              <div class="col-md-12">
                                <div class="form-group">
                                     
                                </div>
                              </div>
                             </div>
                      </div>
                    </div>
                    
                    <div class="table-responsive">
                      <table id="felookupTable2" class="table table-bordered table-striped w-100" style="overflow-x:auto;">
                        <thead>
                        <tr>
                            
                            <th>Detail COB</th>
                            <th>Share %</th>
                            <th>COB</th>
                            <th>OGRP1 %</th>
                            <th>Amount</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>

                      </table>
                    </div>

                    <div class="row">
                       
                        <div class="col-md-5 form-group d-flex">
                        </div>
                        <label for="" class="col-1">{{ __(' Total Share') }}</label>
                        <div class="col-md-5 form-group d-flex">
                            <input type="text" name="egrp1" id="egrp1" class="form-control form-control-sm ml-2" autocomplete="off">
                        </div>
                        <label for="" class="col-1">{{ __(' % ') }}</label>
                        
                    </div>


                </div>
            </div>
        </div>

  </div>
  </div>

  
</form>