<div class="card" id="group_detailreins_card" style="display: none;">
  <div class="card-header bg-gray"> Calculation Reinstatement</div>
  <div class="card-body bg-light-gray">

            <section class="my-4">
                <div class="row mb-2">
                    <div class="col-md-10"></div>
                    <div class="col-md-2">
                      <button class="btn btn-primary btn-block" onclick="prevdatalookreinstatement()">{{__('Prev (Detail COB) ')}}</button>
                    </div>
                </div>
            </section>
            
            <div class="col-md-2">
                  <h3>Master Contract</h3>
            </div>
            <hr>

            <section class="my-4">
              <div class="row mb-2">
                <div class="col-md-2">ID</div>
                <div class="col-md-2"><input type="text" id="masteridreins33" name="masteridreins33" class="form-control form-control-sm"
                    readonly></div>
                <div class="col"></div>
                <div class="col-md-2">Date Entry</div>
                <div class="col-md-2"><input type="text" id="masterdateentryreins33" name="masterdateentryreins33"
                    class="form-control form-control-sm" readonly></div>
              </div>

              <div class="row mb-2">
                <div class="col-md-2">Ceding/Broker</div>
                <div class="col-md-3"><input type="text" id="mastercedingreins33" name="mastercedingreins33"
                    class="form-control form-control-sm" readonly></div>
                <div class="col"></div>
                <div class="col-md-2">User</div>
                <div class="col-md-2"><input type="text" id="masteruserreins33" name="masteruserreins33"
                    class="form-control form-control-sm" readonly></div>
              </div>

              <div class="row mb-2">
                <div class="col-md-2">U/W Year</div>
                <div class="col-md-2"><input type="text" id="masteruwyearreins33" name="masteruwyearreins3"
                    class="form-control form-control-sm" readonly></div>
                <div class="col-md-1">Ceding Type</div>
                <div class="col-md-2"><input type="text" id="mastercedingtypereins33" name="mastercedingtypereins33"
                    class="form-control form-control-sm" readonly></div>
              </div>
            </section>

            <div class="col-md-2">
                  <h3>Sub Master Contract</h3>
            </div>
            <hr>

            <section class="my-4">
              <div class="row mb-2">
                <div class="col-md-2">ID</div>
                <div class="col-md-2"><input type="text" id="submasteridreins33" name="submasteridreins33"
                    class="form-control form-control-sm" readonly></div>
              </div>

              <div class="row mb-2">
                <div class="col-md-2">Ceding Company</div>
                <div class="col-md-3"><input type="text" id="submastercedingreins33" name="submastercedingreins33"
                    class="form-control form-control-sm" readonly></div>
              </div>

              <div class="row mb-2">
                <div class="col-md-2">Period</div>
                    <div class="col-md-2"><input type="text" id="submasterperiodreins33" name="submasterperiodreins33" class="form-control form-control-sm" readonly></div>
                    <div class="col-md-2"><input type="text" id="submasterperiodreins332" name="submasterperiodreins332" class="form-control form-control-sm" readonly></div>
              </div>

              <div class="row mb-2">
                <div class="col-md-2">Type</div>
                <div class="col-md-2"><input type="text" id="submastertypereins33" name="submastertypereins33"
                    class="form-control form-control-sm" readonly></div>
              </div>
              
              <div class="col-md-2">
                  <h3>Group COB</h3>
            </div>
            <hr>

              <div class="row mb-2">
                <div class="col-md-2">{{ __('ID') }}</div>
                <div class="col-md-4 form-group d-flex">
                <input type="text" name="idgroupcobreins33" id="idgroupcobreins33" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                </div>
              </div>

              <div class="row mb-2">
                <div class="col-md-2">{{ __('Grop COB') }}</div>
                <div class="col-md-4 form-group d-flex">
                <input type="text" name="groucobreins33" id="groucobreins33" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                </div>
              </div>

              <div class="row mb-2">
                <div class="col-md-2">{{ __('OGRPI') }}</div>
                <div class="col-md-4 form-group d-flex">
                <input type="text" name="groupcoborgpireins33" id="groupcoborgpireins33" class="form-control form-control-sm ml-2 money text-left" autocomplete="off" readonly>
                </div>
              </div>

              <div class="row mb-2">
                <div class="col-md-2">{{ __('Type Of Treaty') }}</div>
                <div class="col-md-4 form-group d-flex">
                 <input type="text" name="groupcobtypereins33" id="groupcobtypereins33" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                </div>
              </div>


              <div class="row mb-2">
                <div class="col-md-2">{{ __('Brokerage %') }}</div>
                <div class="col-md-4 form-group d-flex">
                    <input type="text" name="groupcobbrokeragereins33" id="groupcobbrokeragereins33" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                </div>
              </div>


              <div class="row mb-2">
                <div class="col-md-2">{{ __('VAT %') }}</div>
                <div class="col-md-4 form-group d-flex">
                    <input type="text" name="groupcobbrokeragepersenreins33" id="groupcobbrokeragepersenreins33" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                </div>
              </div>


              <div class="row mb-2">
                  <div class="table-responsive">
                      <table id="tablegroupcob33" class="table table-bordered table-striped w-100" style="overflow-x:auto;">
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
            <div class="col-md-2">
                <h3>Layer Data</h3>
            </div>
            <hr>

            <div class="row mb-2">
                    <div class="col-md-2">{{ __('Layer Level') }}</div>
                    <div class="col-md-4 form-group d-flex">
                    <input type="text" name="levellayerreins33" id="levellayerreins33" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                    </div>

                    <label for="" class="col-2">{{ __('Adj Prem Rate') }}</label>
                    <div class="col-md-4 form-group d-flex">
                    <input type="text" name="premratelayerreins33" id="premratelayerreins33" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                    </div>
            </div>

            <div class="row">
                  <label for="" class="col-2">{{ __('U/W Retention') }}</label>
                  <div class="col-md-4 form-group d-flex">
                  <input type="text" name="uwretlayerreins33" id="uwretlayerreins33" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                  </div>

                  <label for="" class="col-2">{{ __('Mindep (100%)') }}</label>
                  <div class="col-md-4 form-group d-flex">
                  <input type="text" name="mindeplayerreins33" id="mindeplayerreins33" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                  </div>
            </div>

            <div class="row">

                <label for="" class="col-2">{{ __('Limit (100%)') }}</label>
                <div class="col-md-4 form-group d-flex">
                <input type="text" name="limitlayerreins33" id="limitlayerreins33" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                </div>


                <label for="" class="col-2">{{ __('Premium Type') }}</label>
                <div class="col-md-4 form-group d-flex">
                  <input type="text" name="premiumtypelayerreins33" id="premiumtypelayerreins33" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                </div>
                
            </div>



            <div class="row">
                <label for="" class="col-2"></label>
                <div class="col-md-4 form-group d-flex">
                        <a class="text-primary mr-3 float-right " data-toggle="modal"  data-looklayer-id="0" data-target="#addreinstmodalreins3">
                            <button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#addreinstmodalreins3">{{__('Reinstatement')}}</button>
                        </a>
                </div>

  
                <label for="" class="col-2">{{ __('Nasionalre Share') }}</label>
                <div class="col-md-4 form-group d-flex">
                <input type="text" name="nasresharereins33" id="nasresharereins33" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                </div>
            </div>


            
            <div class="modal fade" id="addreinstmodalreins3" tabindex="-1" user="dialog" aria-labelledby="addreinstmodalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl" user="document">
                            <div class="modal-content bg-light-gray">
                                <div class="modal-header bg-gray">
                                    <h5 class="modal-title" id="addreinstmodalLabel">{{__('Reinstatement Rate')}}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                        
                                <div class="col-md-12">
                                    <div class="card card-primary">
                                    <div class="card-body">
                                                
                                                    <div class="form-group">
                                                   
                                                    <hr>

                                                    <div class="row">
                                                        <div class="col-md-2">
                                                            <label for="">{{ __('Number Reinstatement ') }}</label>
                                                        </div>
                                                        <div class="col-md-4">
                                                                <div class="form-group">
                                                                <input type="hidden"  id="layerid43" name="layerid43"  class="form-control form-control-sm">
                                                                <input type="hidden"  id="groupcobid43" name="groupcobid43"  class="form-control form-control-sm">
                                                                </div>
                                                        </div>

                                                        <div class="col-md-2">
                                                        </div>

                                                        <div class="col-md-4">
                                                            
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="table-responsive">
                                                            <table id="reinstatementable333" class="table table-bordered table-striped w-100" style="overflow-x:auto;">
                                                                <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Number</th>
                                                                    <th>Percentage</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                <tr>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr>
                                                                </tbody>
                                                            </table>

                                                            </div>
                                                    </div>
                            
                                                </div>
                                            <hr>
                                        
                                    </div>
                                    </div>
                                </div>
                            
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                            </div>
                    </div>
                </div>
            </div>
            {{-- Location Modal Ends --}}


            <div class="row">
               
                <label for="" class="col-2">{{ __('Liability') }}</label>
                <div class="col-md-4 form-group d-flex">
                <input type="text" name="liabilityreins33" id="liabilityreins33" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                </div>

                <label for="" class="col-2">{{ __('MD Premium') }}</label>
                <div class="col-md-4 form-group d-flex">
                <input type="text" name="mdpremiumreins33" id="mdpremiumreins33" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                </div>
               
            </div>

            <div class="row">

                <label for="" class="col-2">{{ __('AA Limit') }}</label>
                <div class="col-md-4 form-group d-flex">
                <input type="text" name="aadlimitreins33" id="aadlimitreins33" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                </div>

                <label for="" class="col-2">{{ __('AA Deductible') }}</label>
                <div class="col-md-4 form-group d-flex">
                <input type="text" name="aadedcutiblereins33" id="aadedcutiblereins33" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                </div>
            </div>


            <div class="row">
                <div class="table-responsive">
                    <table id="tablelayer33" class="table table-bordered table-striped w-100" style="overflow-x:auto;">
                    <thead>
                    <tr>
                        <th>No </th>
                        <th>Due Date</th>
                        <th>Prod Date</th>
                        <th>PCt (%)</th>
                        <th>Gross</th>
                        <th>Broker</th>
                        <th>Amount</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        </tr>
                    </tbody>
                    </table>
                </div>                                                
            </div>

            <hr>
            <div class="col-md-2">
                <h3>Detail COB</h3>
            </div>
            <hr>

            <div class="row">
                <label for="" class="col-2">{{ __('Detail COB') }}</label>
                <div class="col-md-4 form-group d-flex">
                <input type="text" name="detailcobreins33" id="detailcobreins33" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                </div>

                <label for="" class="col-2">{{ __('Business Source') }}</label>
                <div class="col-md-4 form-group d-flex">
                <input type="text" name="businesssourcereins33" id="businesssourcereins33" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                </div>
            </div>

            <div class="row">
                <label for="" class="col-2">{{ __('OGRPI %') }}</label>
                <div class="col-md-4 form-group d-flex">
                <input type="text" name="ogrpireins33" id="ogrpireins33" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                </div>

                <label for="" class="col-2">{{ __('Business Type') }}</label>
                <div class="col-md-4 form-group d-flex">
                <input type="text" name="businesstypereins33" id="businesstypereins33" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                </div>
            </div>

            <div class="row">
                <label for="" class="col-2">{{ __('Maximum Acceptence') }}</label>
                <div class="col-md-4 form-group d-flex">
                <input type="text" name="maximum_acceptencereins33" id="maximum_acceptencereins33" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                </div>
            </div>

            
            <hr>
            <div class="col-md-2">
                <h3>Calculation Reinstatement</h3>
            </div>
            <hr>

            <div class="form-group">

                      <div class="row">
                          <div class="col-md-2">
                            <label for="">{{ __('Counter Number') }}</label>
                          </div>
                          <div class="col-md-5">
                              <div class="form-group">
                              <input type="hidden" class="form-control form-control-sm" name="layerid333" id="layerid333">
                              <input type="hidden" class="form-control form-control-sm" name="detailcobidreins33" id="detailcobidreins33">
                              <input type="hidden" class="form-control form-control-sm" name="claimid33" id="claimid33">
                              <input type="text" class="form-control form-control-sm" name="counternumberreins333" id="counternumberreins333">
                              </div>
                          </div>

                        
                          <div class="col-md-2">
                            <label for="">{{ __('Transfer Date') }}</label>
                          </div>
                          <div class="col-md-3">
                              <div class="form-group">
                              <input type="text" class="form-control form-control-sm" name="transferdatereins333" id="transferdatereins333"  value="{{ date('d/m/Y') }}" readonly> &nbsp;&nbsp; 
                             </div>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col-md-2">
                            <label for="">{{ __('Reins ID') }}</label>
                          </div>
                          <div class="col-md-5">
                              <div class="form-group">
                              <input type="text" class="form-control form-control-sm" name="reinsid333" id="reinsid333">
                              </div>
                          </div>

                          <div class="col-md-2">
                            <label for="">{{ __('Username') }}</label>
                          </div>
                          <div class="col-md-3">
                              <div class="form-group">
                              <input type="text" class="form-control form-control-sm" name="usernamereins333" id="usernamereins333" value="{{ Auth::user()->name }}" readonly> &nbsp;&nbsp; 
                              </div>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col-md-2">
                            <label for="">{{ __('Status Doc') }}</label>
                          </div>
                          <div class="col-md-5">
                              <div class="form-group">
                             <select class="form-control" name="statusdoc333" id="statusdoc333" required>
                                <option value selected disabled>Pilih</option>
                                <option value="Presummary">Presummary</option>
                                <option value="Production">Production</option>
                                <option value="Cancel">Cancel</option>
                                <option value="Correction">Correction</option>
                                <option value="Dummy">Dummy</option>
                              </select>
                              </div>
                          </div>

                          <div class="col-md-5">
                          </div>
                      </div>


                      <div class="row">
                          <div class="col-md-2">
                            <label for="">{{ __('Production Date') }}</label>
                          </div>
                          <div class="col-md-4">
                              <div class="form-group">
                              <input type="text" class="form-control form-control-sm datepicker" name="dateprodreins333" id="dateprodreins333">
                              </div>
                          </div>

                          <div class="col-md-2">
                            <label for="">{{ __('Date Loss') }}</label>
                          </div>
                          <div class="col-md-4">
                              <div class="form-group">
                              <input type="text" class="form-control form-control-sm datepicker" name="datelossreins333" id="datelossreins333">
                              </div>
                          </div>
                      </div>


                      <div class="row">
                          <div class="col-md-2">
                           
                          </div>
                          <div class="col-md-8">
                            <div class="row my-4">
                              <div class="col-md-4 text-left">
                                  <a class="text-primary mr-3 float-right " data-toggle="modal"  data-looklayer-id="0" data-target="#prodclaimreins3">
                                      <button type="button" style="height:70px;width:300px" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#prodclaimreins3">{{__('Production Claim')}}</button>
                                  </a>
                              </div>
                              <div class="col-md-4 text-left">
                                      
                              </div>
                            </div>
                          </div>
                      </div>

                      
                      <div class="modal fade" id="prodclaimreins3" tabindex="-1" user="dialog" aria-labelledby="prodclaimreins3Label" aria-hidden="true">
                        <div class="modal-dialog modal-xl" user="document">
                            <div class="modal-content bg-light-gray">
                                      <div class="modal-header bg-gray">
                                          <h5 class="modal-title" id="prodclaimreins3Label">{{__('Production Claim')}}</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                          </button>
                                      </div>
                                        
                                      <div class="col-md-12">
                                          <div class="card card-primary">
                                              <div class="card-body">

                                                  <div class="row">
                                                      <div class="col-md-2">
                                                        <label for="">{{ __('Regcomp') }}</label>
                                                      </div>
                                                      <div class="col-md-5">
                                                          <div class="form-group">
                                                          <input type="text" class="form-control form-control-sm" name="regcomp33" id="regcomp33">
                                                          </div>
                                                      </div>

                                                      <div class="col-md-5">
                                                      </div>
                                                  </div>

                                                  <div class="col-md-12">
                                                    <div class="row justify-content-center">
                                                        <div class="col-md-8">
                                                          <div class="row justify-content-center my-4">
                                                            <div class="col-md-4 text-center">
                                                                <button class="btn btn-primary btn-block" onclick="clicksearchregcompsubmit()">{{__('Search')}}</button>
                                                            </div>
                                                            <div class="col-md-4 text-center">
                                                                <button class="btn btn-primary btn-block" onclick="clickchoiceregcompsubmit()">{{__('Choice')}}</button>
                                                            </div>
                                                          </div>
                                                        </div>
                                                    </div>
                                                  </div>

                                                  <div class="row mb-2">
                                                    <div class="col-md-12">
                                                      <div class="card">
                                                        <div class="card-body">
                                                          <table id="tableclaimreins33" class="table table-bordered table-striped w-100" style="overflow-x:auto;">
                                                          <thead>
                                                          <tr>
                                                              <th>Reg Comp</th>
                                                              <th>DLA REFF</th>
                                                              <th>Date Loss</th>
                                                              <th>Insured</th>
                                                              <th>Currency</th>
                                                              <th>Nasionalre Loss</th>
                                                              <th>Option</th>
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

                      

                      <div class="row">
                          <div class="col-md-2">
                            <label for="">{{ __('DLA Reff') }}</label>
                          </div>
                          <div class="col-md-5">
                              <div class="form-group">
                              <input type="text" class="form-control form-control-sm" name="dlareff333" id="dlareff333">
                              </div>
                          </div>

                          <div class="col-md-5">
                          </div>
                      </div>

                      <div class="row">
                          <div class="col-md-2">
                            <label for="">{{ __('Insured') }}</label>
                          </div>
                          <div class="col-md-5">
                              <div class="form-group">
                              <input type="text" class="form-control form-control-sm" name="insured333" id="insured333">
                              </div>
                          </div>

                          <div class="col-md-5">
                          </div>
                      </div>

                      <div class="row">
                          <div class="col-md-2">
                            <label for="">{{ __('Currency') }}</label>
                          </div>
                          <div class="col-md-5">
                              <div class="form-group">
                                  <select id="currency333" name="currency333" class="e1 form-control form-control-sm ml-2">
                                  <option selected disabled>{{ __('Currency') }}</option>
                                  @foreach ($currencies as $c)
                                        @if(@$accu->currency_id  == $c->id)
                                          <option value="{{ $c->id }}" selected >{{ $c->code }}</option>
                                        @else
                                          <option value="{{ $c->id }}">{{ $c->code }}</option>
                                        @endif
                                  @endforeach
                                </select>
                              </div>
                          </div>

                          <div class="col-md-2">
                            <label for="">{{ __('Settlement') }}</label>
                          </div>
                          <div class="col-md-2">
                              <div class="form-group">
                              <input type="text" class="form-control form-control-sm money text-left" name="settlement333" id="settlement333">
                              </div>
                          </div>
                      </div>


                      <div class="row">
                          <div class="col-md-2">
                            <label for="">{{ __('Nasionalre Loss') }}</label>
                          </div>
                          <div class="col-md-5">
                              <div class="form-group">
                              <input type="text" class="form-control form-control-sm money text-left" name="lossnasre333" id="lossnasre333">
                              </div>
                          </div>
                          <div class="col-md-5">
                          </div>
                      </div>


                      <div class="row">
                          <div class="col-md-2">
                            <label for="">{{ __('Reinstatement Rate') }}</label>
                          </div>
                          <div class="col-md-2">
                              <div class="form-group">
                              <input type="text" class="form-control form-control-sm" name="reinstatementrate333" id="reinstatementrate333">
                              </div>
                          </div>
                          <div class="col-md-2">
                            <label for="">{{ __('Day') }}</label>
                          </div>
                          <div class="col-md-2">
                              <div class="form-group">
                              <input type="text" class="form-control form-control-sm" name="reinstatementday333" id="reinstatementday333">
                              </div>
                          </div>
                          <div class="col-md-2">
                              <label for="">{{ __('Of') }}</label>
                          </div>
                          <div class="col-md-2">
                          <div class="form-group">
                              <input type="text" class="form-control form-control-sm" name="reinstatementof333" id="reinstatementof333">
                              </div>
                          </div>
                      </div>

                      
                      <div class="row">
                          <div class="col-md-2">
                            <label for="">{{ __('Reinstatement Premium') }}</label>
                          </div>
                          <div class="col-md-5">
                              <div class="form-group">
                              <input type="text" class="form-control form-control-sm money text-left" name="reinstatementpremium333" id="reinstatementpremium333">
                              </div>
                          </div>
                          <div class="col-md-5">
                          </div>
                      </div>


                      <div class="row">
                          <div class="col-md-2">
                            <label for="">{{ __('Nasionalre Share') }}</label>
                          </div>
                          <div class="col-md-5">
                              <div class="form-group">
                              <input type="text" class="form-control form-control-sm money text-left" name="nasreshare333" id="nasreshare333">
                              </div>
                          </div>
                          <div class="col-md-5">
                          </div>
                      </div>


                    <div class="col-md-12">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                              <div class="row justify-content-center my-4">
                                <div class="col-md-4 text-center">
                                     <button class="btn btn-primary btn-block" onclick="storereinssubmit()">{{__('Add Calulation Reinstatement')}}</button>
                                </div>
                                <div class="col-md-4 text-center">
                                     <button class="btn btn-primary btn-block" onclick="prevdatalookreinstatement()">{{__('Prev (Detail COB)')}}</button>               
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>


                    <div class="row mb-2">
                      <div class="col-md-12">
                        <div class="card">
                          <div class="card-body">
                             <table id="tablereins33" class="table table-bordered table-striped w-100" style="overflow-x:auto;">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Reins ID</th>
                                <th>Status Doc</th>
                                <th>Production Date</th>
                                <th>DLA Reff</th>
                                <th>Insured</th>
                                <th>Currency</th>
                                <th>Settlement</th>
                                <th>Nasionalre Loss</th>
                                <th>Reinstatement Rate</th>
                                <th>Reinstatement Premium</th>
                                <th>Nasionalre Share</th>
                                <th>Action</th>
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
              <hr>
      </div>
    </div>



    <div class="modal fade" id="editreinsmodal" tabindex="-1" user="dialog" aria-labelledby="editreinsLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl" user="document">
          <div class="modal-content bg-light-gray">
                    <div class="modal-header bg-gray">
                        <h5 class="modal-title" id="editreinsLabel">{{__('Edit Calulation Reinstatement')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                      
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-body">

                                 <div class="row">
                                    <div class="col-md-2">
                                      <label for="">{{ __('No') }}</label>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                        <input type="hidden" class="form-control form-control-sm" name="layeridupdate33" id="layeridupdate33">
                                        <input type="hidden" class="form-control form-control-sm" name="detailcobidupdate33" id="detailcobidupdate33">
                                        <input type="hidden" class="form-control form-control-sm" name="reinsidupdate33" id="reinsidupdate33">
                                        <input type="hidden" class="form-control form-control-sm" name="claimidupdate33" id="claimidupdate33">
                                        <input type="text" class="form-control form-control-sm" name="counternumberupdate333" id="counternumberupdate333" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                      <label for="">{{ __('Transfer Date') }}</label>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                        <input type="text" class="form-control form-control-sm" name="transferdatereinsupdate333" id="transferdatereinsupdate333" value="{{ date('d/m/Y') }}" readonly> &nbsp;&nbsp; 
                                      </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-2">
                                      <label for="">{{ __('Reins ID') }}</label>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                        <input type="text" class="form-control form-control-sm" name="reinsidupdate333" id="reinsidupdate333" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                      <label for="">{{ __('Username') }}</label>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                        <input type="text" class="form-control form-control-sm" name="usernamereinsupdate333" id="usernamereinsupdate333"  value="{{ Auth::user()->name }}"  readonly> &nbsp;&nbsp; 
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-2">
                                      <label for="">{{ __('Status Doc') }}</label>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                      <select class="form-control" name="statusdocupdate333" id="statusdocupdate333" required>
                                          <option value selected disabled>Pilih</option>
                                          <option value="Concept">Concept</option>
                                          <option value="Production">Production</option>
                                        </select>
                                        </div>
                                    </div>

                                    <div class="col-md-5">
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-2">
                                      <label for="">{{ __('Production Date') }}</label>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                        <input type="text" class="form-control form-control-sm datepicker" name="dateprodupdate333" id="dateprodupdate333">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                      <label for="">{{ __('Date Loss') }}</label>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                        <input type="text" class="form-control form-control-sm datepicker" name="datelossupdate333" id="datelossupdate333">
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-2">
                                      <label for="">{{ __('Production Claim') }}</label>
                                    </div>
                                    <div class="col-md-5 text-center">
                                        <a class="text-primary mr-3 float-right " data-toggle="modal"  data-looklayer-id="0" data-target="#prodclaimreinsupdate3">
                                            <button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#prodclaimreinsupdate3">{{__('Production Claim')}}</button>
                                        </a>
                                    </div>

                                    <div class="col-md-5">
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-2">
                                      <label for="">{{ __('DLA Reff') }}</label>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                        <input type="text" class="form-control form-control-sm" name="dlareffupdate333" id="dlareffupdate333">
                                        </div>
                                    </div>

                                    <div class="col-md-5">
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-2">
                                      <label for="">{{ __('Insured') }}</label>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                        <input type="text" class="form-control form-control-sm" name="insuredupdate333" id="insuredupdate333">
                                        </div>
                                    </div>

                                    <div class="col-md-5">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-2">
                                      <label for="">{{ __('Currency') }}</label>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <select id="currencyupdate333" name="currencyupdate333" class="e1 form-control form-control-sm ml-2">
                                            <option selected disabled>{{ __('Currency') }}</option>
                                            @foreach ($currencies as $c)
                                                  @if(@$accu->currency_id  == $c->id)
                                                    <option value="{{ $c->id }}" selected >{{ $c->code }}</option>
                                                  @else
                                                    <option value="{{ $c->id }}">{{ $c->code }}</option>
                                                  @endif
                                            @endforeach
                                          </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                      <label for="">{{ __('Settlement') }}</label>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                        <input type="text" class="form-control form-control-sm money text-left" name="settlementupdate333" id="settlementupdate333">
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-2">
                                      <label for="">{{ __('Nasionalre Loss') }}</label>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                        <input type="text" class="form-control form-control-sm money text-left" name="lossnasreupdate333" id="lossnasreupdate333">
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-2">
                                      <label for="">{{ __('Reinstatement Rate') }}</label>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                        <input type="text" class="form-control form-control-sm" name="reinstatementrateupdate333" id="reinstatementrateupdate333">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                      <label for="">{{ __('Day') }}</label>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                        <input type="text" class="form-control form-control-sm" name="reinstatementdayupdate333" id="reinstatementdayupdate333">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="">{{ __('Of') }}</label>
                                    </div>
                                    <div class="col-md-2">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-sm" name="reinstatementofupdate333" id="reinstatementofupdate333">
                                        </div>
                                    </div>
                                </div>

                                
                                <div class="row">
                                    <div class="col-md-2">
                                      <label for="">{{ __('Reinstatement Premium') }}</label>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                        <input type="text" class="form-control form-control-sm money text-left" name="reinstatementpremiumupdate333" id="reinstatementpremiumupdate333">
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-2">
                                      <label for="">{{ __('Nasionalre Share') }}</label>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                        <input type="text" class="form-control form-control-sm money text-left" name="nasreshareupdate333" id="nasreshareupdate333">
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                    </div>
                                </div>


                                  <div class="col-md-12">
                                    <div class="row justify-content-center">
                                        <div class="col-md-8">
                                          <div class="row justify-content-center my-4">
                                            <div class="col-md-4 text-center">
                                                <button class="btn btn-primary btn-block" onclick="updatereinssubmit()">{{__('Edit Detail COB')}}</button>
                                            </div>
                                            <div class="col-md-4 text-center">
                                                    
                                            </div>
                                          </div>
                                        </div>
                                    </div>
                                  </div>
                                      
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