<div class="card" id="group_detailcob_card" style="display: none;">
  <div class="card-header bg-gray"> Detail COB</div>
  <div class="card-body bg-light-gray">

            <section class="my-4">
                <div class="row mb-2">
                    <div class="col-md-10"></div>
                    <div class="col-md-2">
                      <button class="btn btn-primary btn-block" onclick="prevlayerdetailcob()">{{__('Prev (Layer) ')}}</button>
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
                <div class="col-md-2"><input type="text" id="masterid33" name="masterid33" class="form-control form-control-sm"
                    readonly></div>
                <div class="col"></div>
                <div class="col-md-2">Date Entry</div>
                <div class="col-md-2"><input type="text" id="masterdateentry33" name="masterdateentry33"
                    class="form-control form-control-sm" readonly></div>
              </div>

              <div class="row mb-2">
                <div class="col-md-2">Ceding/Broker</div>
                <div class="col-md-3"><input type="text" id="masterceding33" name="masterceding33"
                    class="form-control form-control-sm" readonly></div>
                <div class="col"></div>
                <div class="col-md-2">User</div>
                <div class="col-md-2"><input type="text" id="masteruser33" name="masteruser33"
                    class="form-control form-control-sm" readonly></div>
              </div>

              <div class="row mb-2">
                <div class="col-md-2">U/W Year</div>
                <div class="col-md-2"><input type="text" id="masteruwyear33" name="masteruwyear3"
                    class="form-control form-control-sm" readonly></div>
                <div class="col-md-1">Ceding Type</div>
                <div class="col-md-2"><input type="text" id="mastercedingtype33" name="mastercedingtype33"
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
                <div class="col-md-2"><input type="text" id="submasterid33" name="submasterid33"
                    class="form-control form-control-sm" readonly></div>
              </div>

              <div class="row mb-2">
                <div class="col-md-2">Ceding Company</div>
                <div class="col-md-3"><input type="text" id="submasterceding33" name="submasterceding33"
                    class="form-control form-control-sm" readonly></div>
              </div>

              <div class="row mb-2">
                <div class="col-md-2">Period</div>
                    <div class="col-md-2"><input type="text" id="submasterperiod33" name="submasterperiod33" class="form-control form-control-sm" readonly></div>
                    <div class="col-md-2"><input type="text" id="submasterperiod332" name="submasterperiod332" class="form-control form-control-sm" readonly></div>
              </div>

              <div class="row mb-2">
                <div class="col-md-2">Type</div>
                <div class="col-md-2"><input type="text" id="submastertype33" name="submastertype33"
                    class="form-control form-control-sm" readonly></div>
              </div>
              
              <div class="col-md-2">
                  <h3>Group COB</h3>
            </div>
            <hr>

              <div class="row mb-2">
                <div class="col-md-2">{{ __('ID') }}</div>
                <div class="col-md-4 form-group d-flex">
                <input type="text" name="idgroupcob33" id="idgroupcob33" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                </div>
              </div>

              <div class="row mb-2">
                <div class="col-md-2">{{ __('Grop COB') }}</div>
                <div class="col-md-4 form-group d-flex">
                <input type="text" name="groucob33" id="groucob33" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                </div>
              </div>

              <div class="row mb-2">
                <div class="col-md-2">{{ __('OGRPI') }}</div>
                <div class="col-md-4 form-group d-flex">
                <input type="text" name="groupcoborgpi33" id="groupcoborgpi33" class="form-control form-control-sm ml-2 money text-left" autocomplete="off" readonly>
                </div>
              </div>

              <div class="row mb-2">
                <div class="col-md-2">{{ __('Type Of Treaty') }}</div>
                <div class="col-md-4 form-group d-flex">
                 <input type="text" name="groupcobtype33" id="groupcobtype33" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                </div>
              </div>


              <div class="row mb-2">
                <div class="col-md-2">{{ __('Brokerage %') }}</div>
                <div class="col-md-4 form-group d-flex">
                    <input type="text" name="groupcobbrokerage33" id="groupcobbrokerage33" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                </div>
              </div>


              <div class="row mb-2">
                <div class="col-md-2">{{ __('VAT %') }}</div>
                <div class="col-md-4 form-group d-flex">
                    <input type="text" name="groupcobbrokeragepersen33" id="groupcobbrokeragepersen33" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
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
                    <input type="text" name="levellayer33" id="levellayer33" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                    </div>

                    <label for="" class="col-2">{{ __('Adj Prem Rate') }}</label>
                    <div class="col-md-4 form-group d-flex">
                    <input type="text" name="premratelayer33" id="premratelayer33" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                    </div>
            </div>

            <div class="row">
                  <label for="" class="col-2">{{ __('U/W Retention') }}</label>
                  <div class="col-md-4 form-group d-flex">
                  <input type="text" name="uwretlayer33" id="uwretlayer33" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                  </div>

                  <label for="" class="col-2">{{ __('Mindep (100%)') }}</label>
                  <div class="col-md-4 form-group d-flex">
                  <input type="text" name="mindeplayer33" id="mindeplayer33" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                  </div>
            </div>

            
            <div class="row">

                <label for="" class="col-2">{{ __('Limit (100%)') }}</label>
                <div class="col-md-4 form-group d-flex">
                <input type="text" name="limitlayer33" id="limitlayer33" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                </div>
              
                <label for="" class="col-2">{{ __('Premium Type') }}</label>
                <div class="col-md-4 form-group d-flex">
                  <input type="text" name="premiumtypelayer33" id="premiumtypelayer33" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                </div>
                
            </div>



            <div class="row">
                <label for="" class="col-2"></label>
                <div class="col-md-4 form-group d-flex">
                        <a class="text-primary mr-3 float-right " data-toggle="modal"  data-looklayer-id="0" data-target="#addreinstmodal3">
                            <button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#addreinstmodal3">{{__('Reinstatement')}}</button>
                        </a>
                </div>

  
                <label for="" class="col-2">{{ __('Nasre Share') }}</label>
                <div class="col-md-4 form-group d-flex">
                <input type="text" name="nasreshare33" id="nasreshare33" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                </div>
            </div>


            
            <div class="modal fade" id="addreinstmodal3" tabindex="-1" user="dialog" aria-labelledby="addreinstmodalLabel" aria-hidden="true">
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
                                                                <input type="text" id="numberinstatement" name="numberinstatement" class="form-control form-control-sm"> &nbsp;&nbsp; 
                                                                </div>
                                                        </div>

                                                        <div class="col-md-2">
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <button class="btn btn-primary btn-block" onclick="storereinstatementsubmit()">{{__('Add Instatement')}}</button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-2">
                                                            <label for="">{{ __('Percentage %') }}</label>
                                                        </div>
                                                        <div class="col-md-4">
                                                                <div class="form-group">
                                                                <input type="text" id="percentagereinstatement" name="percentagereinstatement" class="form-control form-control-sm"> &nbsp;&nbsp; 
                                                                </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            
                                                        </div>
                                                    </div>

                                                    <div class="row">   
                                                        <!--div class="col-md-2">
                                                        <label for="">{{ __('Note') }}</label>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                            <input type="text" id="notereinstatement" name="notereinstatement" class="form-control form-control-sm"> &nbsp;&nbsp; 
                                                            </div>
                                                        </div-->
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
                <input type="text" name="liability33" id="liability33" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                </div>

                <label for="" class="col-2">{{ __('MD Premium') }}</label>
                <div class="col-md-4 form-group d-flex">
                <input type="text" name="mdpremium33" id="mdpremium33" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                </div>
               
            </div>

            <div class="row">

                <label for="" class="col-2">{{ __('AA Limit') }}</label>
                <div class="col-md-4 form-group d-flex">
                <input type="text" name="aadlimit33" id="aadlimit33" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                </div>

                <label for="" class="col-2">{{ __('AA Deductible') }}</label>
                <div class="col-md-4 form-group d-flex">
                <input type="text" name="aadedcutible33" id="aadedcutible33" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
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

            <div class="form-group">

                      <div class="row">
                        <div class="col-md-1">
                          <label for="">{{ __('Detail COB ') }}</label>
                          </div>
                          <div class="col-md-5">
                              <div class="form-group">
                                <select class="form-control form-control-sm" name="detailcob333" id="detailcob333">
                                    @foreach ($cob as $c)
                                    <option value="{{ $c->id }}">{{ $c->description }}</option>
                                    @endforeach
                                </select>
                              </div>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col-md-1">
                            <label for="">{{ __('OGRPI %') }}</label>
                          </div>
                          <div class="col-md-2">
                              <div class="form-group">
                              <input type="hidden" class="form-control form-control-sm" name="layerid33" id="layerid33">
                              <input type="text" class="form-control form-control-sm" name="ogrpi333" id="ogrpi333">
                              </div>
                          </div>

                          <div class="col-md-1">
                            <label for="">{{ __('OGRPI Amount') }}</label>
                          </div>
                          <div class="col-md-2">
                              <div class="form-group">
                              <input type="text" class="form-control form-control-sm money text-left" name="ogrpiamount333" id="ogrpiamount333"> 
                              </div>
                          </div>

                          <div class="col-md-2">
                            <label for="">{{__('Business Type')}}</label>
                          </div>
                          
                          <div class="col-md-4">
                            <div class="form-group">
                              <select class="form-control" name="business_id" id="business_id" required>
                                <option value selected disabled>Pilih</option>
                                  @foreach ($business_type as $bt)
                                    <option value="{{ $bt->id }}">{{ $bt->name }}</option>
                                  @endforeach
                              </select>
                            </div>
                          </div>
                      </div>


                      <div class="row">
                          <div class="col-md-2">
                            <label for="">{{__('Business Source')}}</label>
                          </div>

                          <div class="col-md-4 col-offsets-4">
                            <div class="form-group">
                              <label>&nbsp;</label>
                              <br>
                              <div class="form-check form-check-inline">
                                <div class="form-check">
                                  <input type="radio" class="form-check-input position-static" name="flag_overseas33" id="local" value="local" 
                                  {{ @$insureddata->flag_overseas === 0 ? "checked" : "" }}
                                  > <label for="local">{{__('Local')}}</label>
                                </div>
                                <div class="form-check">
                                  <input type="radio" class="form-check-input position-static" name="flag_overseas33" id="overseas_checkbox" value="overseas" {{ @$insureddata->flag_overseas === 1 ? "checked" : "" }}> <label for="overseas_checkbox" >Overseas</label>
                                </div>  
                              </div>  
                            </div>
                          </div>

                          <div class="col-md-2">
                            <label for="">{{__('Maximum Acceptence')}}</label>
                          </div>
                          
                          <div class="col-md-4">
                            <div class="form-group">
                              <input type="text" class="form-control form-control-sm money text-left" name="maximum_acceptence" id="maximum_acceptence">
                            </div>
                          </div>
                      </div>


                      <div class="col-md-12">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                              <div class="row justify-content-center my-4">
                                <div class="col-md-4 text-center">
                                     <button class="btn btn-primary btn-block" onclick="storecobdetailsubmit()">{{__('Add Detail COB')}}</button>
                                </div>
                                <div class="col-md-4 text-center">
                                     <button class="btn btn-primary btn-block" onclick="prevlayerdetailcob()">{{__('Prev (Layer) ')}}</button>               
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>


                    <div class="row mb-2">
                      <div class="col-md-12">
                        <div class="card">
                          <div class="card-body">
                             <table id="tabledetailcob33" class="table table-bordered table-striped w-100" style="overflow-x:auto;">
                            <thead>
                            <tr>
                                <th>Detail COB </th>
                                <th>Share(%)</th>
                                <th>Detail COB</th>
                                <th>OGRPI (%)</th>
                                <th>OGRP Amount</th>
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

                      <div class="row">
                        <div class="col-md-6 form-group d-flex">
                        </div>
                        <label for="" class="col-1">{{ __('Total OGRPI ') }}</label>
                        <div class="col-md-5 form-group d-flex">
                            <input type="text" name="totalsharecob33" id="totalsharecob33" class="form-control form-control-sm ml-2 money text-left" autocomplete="off">
                        </div>
                      </div>
                          
                            
                      </div>
              <hr>



  </div>
</div>


<div class="modal fade" id="editdetailcobmodal" tabindex="-1" user="dialog" aria-labelledby="editdetailcobmodalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl" user="document">
          <div class="modal-content bg-light-gray">
                      <div class="modal-header bg-gray">
                          <h5 class="modal-title" id="editdetailcobmodalLabel">{{__('Edit Group COB')}}</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-body">

                            <div class="row">
                              <div class="col-md-2">
                                  <label for="">{{ __('Detail COB ') }}</label>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="form-group">
                                        <select class="form-control form-control-sm" name="detailcobupdate333" id="detailcobupdate333">
                                            @foreach ($cob as $c)
                                            <option value="{{ $c->id }}">{{ $c->description }}</option>
                                            @endforeach
                                        </select>
                                      </div>
                                  </div>

                                 
                              </div>


                            <div class="row">
                                  <div class="col-md-2">
                                    <label for="">{{ __('OGRPI %') }}</label>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="form-group">
                                      <input type="hidden" class="form-control form-control-sm" name="layeridupdate33" id="layeridupdate33">
                                      <input type="hidden" class="form-control form-control-sm" name="detailcobidupdate33" id="detailcobidupdate33">
                                      <input type="text" class="form-control form-control-sm amount" name="ogrpiupdate333" id="ogrpiupdate333"> &nbsp;&nbsp; %
                                      </div>
                                  </div>

                                  <div class="col-md-2">
                                    <label for="">{{ __('OGRPI Amount') }}</label>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="form-group">
                                      <input type="text" class="form-control form-control-sm amount" name="ogrpiamountupdate333" id="ogrpiamountupdate333"> &nbsp;&nbsp; %
                                      </div>
                                  </div>
                              </div>

                              <div class="row">
                                  <div class="col-md-2">
                                    <label for="">{{__('Business Source')}}</label>
                                  </div>

                                  <div class="col-md-4 col-offsets-4">
                                    <div class="form-group">
                                      <label>&nbsp;</label>
                                      <br>
                                      <div class="form-check form-check-inline">
                                        <div class="form-check">
                                          <input type="radio" class="form-check-input position-static" name="flag_overseasupdate33" id="local" value="local" 
                                          {{ @$insureddata->flag_overseas === 0 ? "checked" : "" }}
                                          > <label for="local">{{__('Local')}}</label>
                                        </div>
                                        <div class="form-check">
                                          <input type="radio" class="form-check-input position-static" name="flag_overseasupdate33" id="overseas_checkbox" value="overseas" {{ @$insureddata->flag_overseas === 1 ? "checked" : "" }}> <label for="overseas_checkbox" >Overseas</label>
                                        </div>  
                                      </div>  
                                    </div>
                                  </div>

                                  <div class="col-md-2">
                                    <label for="">{{__('Business Type')}}</label>
                                  </div>
                                  
                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <select class="form-control" name="business_idupdate" id="business_idupdate" required>
                                        <option value selected disabled>Pilih</option>
                                          @foreach ($business_type as $bt)
                                            <option value="{{ $bt->id }}">{{ $bt->name }}</option>
                                          @endforeach
                                      </select>
                                    </div>
                                  </div>
                                </div>


                                <div class="row">
                                  <div class="col-md-2">
                                  </div>

                                  <div class="col-md-4 col-offsets-4">
                                    <div class="form-group">
                                      
                                    </div>
                                  </div>

                                  <div class="col-md-2">
                                    <label for="">{{__('Maximum Acceptence')}}</label>
                                  </div>
                                  
                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <input type="text" class="form-control form-control-sm money text-left" name="maximum_acceptenceupdate" id="maximum_acceptenceupdate">
                                    </div>
                                  </div>
                                </div>


                              <div class="col-md-12">
                                <div class="row justify-content-center">
                                    <div class="col-md-8">
                                      <div class="row justify-content-center my-4">
                                        <div class="col-md-4 text-center">
                                            <button class="btn btn-primary btn-block" onclick="updatecobdetailsubmit()">{{__('Edit Detail COB')}}</button>
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



<section>
@include('crm.transaction.treaty.nonprop.v2.template.detailreins')
</section>

<section>
@include('crm.transaction.treaty.nonprop.v2.template.detailadjreins')
</section>