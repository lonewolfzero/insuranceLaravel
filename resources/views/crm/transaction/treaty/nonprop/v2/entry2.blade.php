@extends('crm.layouts.app')

@section('content')

<style type="text/css">
  /* Firefox */
  input[type=number] {
    -moz-appearance: textfield;
  }

  .styled-border {
    border-width: 3px !important;
    border-color: black !important
  }
</style>

<link rel="stylesheet" type="text/css"
  href="https://cdn.jsdelivr.net/npm/pretty-checkbox@3.0/dist/pretty-checkbox.min.css">

<div class="content-wrapper">
  <div class="container-fluid">
    <div class="card card-primary">
      <div class="card-header bg-gray">
        {{ __('Non Prop Entry') }}
      </div>

      <div class="card-body bg-light-gray">

        <div class="card">
          <div class="card-header bg-gray">Master Contract</div>
          <div class="card-body bg-light-gray">

            <div class="row">
              <div class="col"></div>
              <div class="col-md-2 d-flex">
                <button class="btn btn-sm btn-primary mr-2">Print</button>
                <button class="btn btn-sm btn-primary">Attach Document</button>
              </div>
            </div>

            <section class="my-4">
              <div class="row mb-2">
                <div class="col-md-2">ID</div>
                <div class="col-md-2"><input type="text" class="form-control form-control-sm"></div>
                <div class="col"></div>
                <div class="col-md-2">Date Entry</div>
                <div class="col-md-2"><input type="text" class="form-control form-control-sm datepicker datemask"></div>
              </div>

              <div class="row mb-2">
                <div class="col-md-2">Ceding/Broker</div>
                <div class="col-md-3">
                  <select class="e1 form-control form-control-sm">
                    @foreach ($ceding as $c)
                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col"></div>
                <div class="col-md-2">User</div>
                <div class="col-md-2"><input type="text" class="form-control form-control-sm datepicker datemask"></div>
              </div>

              <div class="row mb-2">
                <div class="col-md-2">U/W Year</div>
                <div class="col-md-2"><input type="text" class="form-control form-control-sm"></div>
                <div class="col-md-1">Ceding Type</div>
                <div class="col-md-2">
                  <select class="form-control form-control-sm">
                    <option value="broker">Broker</option>
                    <option value="ceding">Ceding</option>
                    <option value="deduction">Deduction</option>
                  </select>
                </div>
              </div>

              <div class="row mb-2">
                <div class="col"></div>
                <div class="col-md-2">
                  <button class="btn btn-primary" onclick="showsubmaster()">Submit</button>
                </div>
              </div>
            </section>



            <div class="card" id="group_adjustment_card2" style="">
                <div class="card-header bg-gray"> Adjustment Mindep</div>
                <div class="card-body bg-light-gray">

                            <section class="my-4">
                            <div class="row mb-2">
                              <div class="col-md-2">ID</div>
                              <div class="col-md-2"><input type="text" id="masterid62" name="masterid62" class="form-control form-control-sm"
                                  readonly></div>
                              <div class="col"></div>
                              <div class="col-md-2">Date Entry</div>
                              <div class="col-md-2"><input type="text" id="masterdateentry62" name="masterdateentry62"
                                  class="form-control form-control-sm" readonly></div>
                            </div>

                            <div class="row mb-2">
                              <div class="col-md-2">Ceding/Broker</div>
                              <div class="col-md-3"><input type="text" id="masterceding62" name="masterceding62"
                                  class="form-control form-control-sm" readonly></div>
                              <div class="col"></div>
                              <div class="col-md-2">User</div>
                              <div class="col-md-2"><input type="text" id="masteruser62" name="masteruse63"
                                  class="form-control form-control-sm" readonly></div>
                            </div>

                            <div class="row mb-2">
                              <div class="col-md-2">U/W Year</div>
                              <div class="col-md-2"><input type="text" id="masteruwyear62" name="masteruwyear62"
                                  class="form-control form-control-sm" readonly></div>
                              <div class="col-md-1">Ceding Type</div>
                              <div class="col-md-2"><input type="text" id="mastercedingtype62" name="mastercedingtype62"
                                  class="form-control form-control-sm" readonly></div>
                            </div>
                          </section>

                          <hr>

                          <section class="my-4">
                            
                            <div class="row mb-2">
                              <div class="col-md-2">ID</div>
                              <div class="col-md-2"><input type="text" id="submasterid62" name="submasterid62"
                                  class="form-control form-control-sm" readonly></div>
                            </div>

                            <div class="row mb-2">
                              <div class="col-md-2">Ceding Company</div>
                              <div class="col-md-3"><input type="text" id="submasterceding62" name="submasterceding62"
                                  class="form-control form-control-sm" readonly></div>
                            </div>

                            <div class="row mb-2">
                              <div class="col-md-2">Period</div>
                              <div class="col-md-2"><input type="text" id="submasterperiod62" name="submasterperiod62" class="form-control form-control-sm" readonly></div>
                              <div class="col-md-2"><input type="text" id="submasterperiod622" name="submasterperiod622" class="form-control form-control-sm" readonly></div>
                            </div>

                            <div class="row mb-2">
                              <div class="col-md-2">Type</div>
                              <div class="col-md-2"><input type="text" id="submastertype62" name="submastertype62"
                                  class="form-control form-control-sm" readonly></div>
                            </div>
                            
                          <hr>

                            <div class="row mb-2">
                              <div class="col-md-2">{{ __('ID') }}</div>
                              <div class="col-md-4 form-group d-flex">
                              <input type="text" name="idgroupcob62" id="idgroupcob62" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                              </div>
                            </div>

                            <div class="row mb-2">
                              <div class="col-md-2">{{ __('Grop COB') }}</div>
                              <div class="col-md-4 form-group d-flex">
                              <input type="text" name="groucob62" id="groucob62" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                              </div>
                            </div>

                            <div class="row mb-2">
                              <div class="col-md-2">{{ __('OGRP1') }}</div>
                              <div class="col-md-4 form-group d-flex">
                              <input type="text" name="groupcoborgpi62" id="groupcoborgpi62" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                              </div>
                            </div>

                            <div class="row mb-2">
                              <div class="col-md-2">{{ __('Type Of Treaty') }}</div>
                              <div class="col-md-4 form-group d-flex">
                              <input type="text" name="groupcobtype62" id="groupcobtype62" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                              </div>
                            </div>


                            <div class="row mb-2">
                                <div class="table-responsive">
                                    <table id="tablegroupcob62" class="table table-bordered table-striped w-100" style="overflow-x:auto;">
                                    <thead>
                                    <tr>
                                        <th>Retro Contract</th>
                                        <th>Retro (%)</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                        <td></td>
                                        <td></td>
                                        
                                        </tr>
                                    </tbody>
                                    </table>
                                </div>                                                
                            </div>

                          <hr>

                          <div class="col-md-12">            
                              <div class="card card-primary">
                                  <div class="card-body">

                                <div class="row">    
                                    <div class="col-md-2">
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                      <label for="">{{ __('Counter Number') }}</label>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                        <input type="hidden" class="form-control form-control-sm" name="layerid62" id="layerid62">
                                        <input type="text" id="counternumber52" name="counternumber52" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                  </div>

                                  
                                  <div class="row">
                                    <div class="col-md-2">
                                      <label for="">{{ __('Position') }}</label>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <input type="text" id="position52" name="position52" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                    </div>
                                  </div>

                                  <div class="row">
                                    <div class="col-md-2">
                                      <label for="">{{ __('Due Date') }}</label>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <input type="text" id="duedate52" name="duedate52" class="form-control form-control-sm datepicker">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                    </div>
                                  </div>

                                  <div class="row">
                                    <div class="col-md-2">
                                      <label for="">{{ __('OGRP1') }}</label>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <input type="text" id="ogrpi52" name="ogrpi52" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                    </div>
                                  </div>

                                  <div class="row">
                                    <div class="col-md-2">
                                      <label for="">{{ __('Adjusment') }}</label>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <input type="text" id="adjustment52" name="adjustment52"  class="form-control form-control-sm money">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                    </div>
                                  </div>


                                  <div class="row">
                                    <div class="col-md-2">
                                      <label for="">{{ __('Additional Premium') }}</label>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <input type="text" id="additional_premium52" name="additional_premium52"  class="form-control form-control-sm money">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                    </div>
                                  </div>


                                  
                                  <div class="row">
                                    <div class="col-md-2">
                                      <label for="">{{ __('Brokerage') }}</label>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <select id="brokerage52" name="brokerage52" class="e1 form-control form-control-sm ml-2">
                                              <option selected disabled>{{ __('Ceding/Broker') }}</option>
                                              @foreach ($ceding as $c)
                                              <option value="{{ $c->id }}">{{ $c->name }}</option>
                                              @endforeach
                                            </select>  
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                    </div>
                                  </div>

                                  <div class="row">
                                    <div class="col-md-2">
                                      <label for="">{{ __('Disc%') }}</label>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <input type="text" id="disc52" name="disc52" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                      <label for="">{{ __('Re Sharer') }}</label>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                        <input type="text" id="re_sharer52" name="re_sharer52"  class="form-control form-control-sm">
                                        </div>
                                    </div>
                                  </div>



                                  <div class="row">
                                    <div class="col-md-2">
                                      <label for="">{{ __('Net Add Premium') }}</label>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <input type="text" id="net_add_premium52" name="net_add_premium52"  class="form-control form-control-sm money">
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                      <label for="">{{ __('Retro Share') }}</label>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                        <input type="text" id="retro_share52" name="retro_share52" class="form-control form-control-sm money">
                                        </div>
                                    </div>
                                  </div>


                                  <div class="col-md-12">
                                      <div class="row justify-content-center">
                                        
                                          <div class="col-md-8">
                                            <div class="row justify-content-center my-4">
                                              <div class="col-md-4 text-center">
                                                    <button class="btn btn-primary btn-block" onclick="storeadjustmentsubmit()">{{__('Add  Adjusment')}}</button>
                                              </div>
                                              <div class="col-md-4 text-center">
                                                    <button class="btn btn-primary btn-block" onclick="prevlayeradjustment()">{{__('Prev (Layer) ')}}</button>
                                              </div>
                                            </div>
                                          </div>
                                              
                                      </div>
                                  </div>
                                    

                                  
                                  <div class="row">
                                      <div class="table-responsive">
                                          <table id="tableadjusment33" class="table table-bordered table-striped w-100" style="overflow-x:auto;">
                                          <thead>
                                          <tr>
                                              <th>No </th>
                                              <th>Layer ID</th>
                                              <th>Due Date</th>
                                              <th>OGRP1</th>
                                              <th>Adjustment</th>
                                              <th>Additional Premium</th>
                                              <th>Brokerage</th>
                                              <th>Disc (%)</th>
                                              <th>Net Add Premium</th>
                                              <th>Re Share</th>
                                              <th>Retro Share</th>
                                          </tr>
                                          </thead>
                                          <tbody>
                                          </tbody>
                                          </table>
                                      </div>                                                
                                  </div>
                                    
                                  </div>
                              </div>
                          
                          </div>


            </div>
          </div>


             <div class="modal fade" id="editdetailadjmodal" tabindex="-1" user="dialog" aria-labelledby="editdetailadjmodalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" user="document">
                    <div class="modal-content bg-light-gray">
                                <div class="modal-header bg-gray">
                                    <h5 class="modal-title" id="editdetailadjmodalLabel">{{__('Layer')}}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                
                              <div class="col-md-12">
                                  <div class="card card-primary">
                                      <div class="card-body">
                                        
                                      </div>
                                      <hr>
                                  </div>
                              </div>
                                  
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                              </div>
                      </div>
                  </div>
              </div>
              {{-- Location Modal Ends --}}

           
          </div>
        </div>

      </div>

    </div>

  </div>

</div>

@endsection


@section('scripts')

<link rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"
  integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw=="
  crossorigin="anonymous" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"
  integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ=="
  crossorigin="anonymous"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.2.6/jquery.inputmask.bundle.min.js"></script>

<link href="{{ asset('css/select2.css') }}" rel="stylesheet" />
<script src="{{ asset('/js/select2.js') }}"></script>

<link href="{{ asset('css/sweetalert2.min.css') }}" rel="stylesheet" />
<script src="{{ asset('/js/sweetalert2.all.min.js') }}"></script>

<script src="{{ asset('/js/treaty/nonprop/v2/index.js') }}"></script>
<script src="{{ asset('/js/treaty/nonprop/v2/entry.js') }}"></script>

@endsection