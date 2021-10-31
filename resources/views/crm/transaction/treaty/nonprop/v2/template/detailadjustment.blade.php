<div class="card" id="group_adjustment_card" style="display: none;">
  <div class="card-header bg-gray"> Adjustment Mindep</div>
  <div class="card-body bg-light-gray">

                
            <div class="col-md-2">
                  <h3>Master Contract</h3>
            </div>
            <hr>

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

            <div class="col-md-2">
                  <h3>Sub Master Contract</h3>
            </div>
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
              
            <div class="col-md-2">
                  <h3>Group COB</h3>
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
                <div class="col-md-2">{{ __('OGRPI') }}</div>
                <div class="col-md-4 form-group d-flex">
                <input type="text" name="groupcoborgpi62" id="groupcoborgpi62" class="form-control form-control-sm ml-2 money text-left" autocomplete="off" readonly>
                </div>
              </div>

              <div class="row mb-2">
                <div class="col-md-2">{{ __('Type Of Treaty') }}</div>
                <div class="col-md-4 form-group d-flex">
                 <input type="text" name="groupcobtype62" id="groupcobtype62" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                </div>
              </div>

              <div class="row mb-2">
                <div class="col-md-2">{{ __('Brokerage %') }}</div>
                <div class="col-md-4 form-group d-flex">
                    <input type="text" name="groupcobbrokerage62" id="groupcobbrokerage62" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                </div>
              </div>

              <div class="row mb-2">
                <div class="col-md-2">{{ __('VAT %') }}</div>
                <div class="col-md-4 form-group d-flex">
                    <input type="text" name="groupcobbrokeragepersen62" id="groupcobbrokeragepersen62" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
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

            <div class="col-md-2">
                <h3>Layer Data</h3>
            </div>
            <hr>
                        
              <div class="row mb-2">
                      <div class="col-md-2">{{ __('Layer Level') }}</div>
                      <div class="col-md-4 form-group d-flex">
                      <input type="text" name="levellayer62" id="levellayer62" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                      </div>

                      <label for="" class="col-2">{{ __('Adj Prem Rate') }}</label>
                      <div class="col-md-4 form-group d-flex">
                      <input type="text" name="premratelayer62" id="premratelayer62" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                      </div>
              </div>

                    <div class="row">
                            <label for="" class="col-2">{{ __('U/W Retention') }}</label>
                            <div class="col-md-4 form-group d-flex">
                            <input type="text" name="uwretlayer62" id="uwretlayer62" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                            </div>

                            <label for="" class="col-2">{{ __('Mindep (100%)') }}</label>
                            <div class="col-md-4 form-group d-flex">
                            <input type="text" name="mindeplayer62" id="mindeplayer62" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                            </div>
                        
                    </div>

                        <div class="row">
                            <label for="" class="col-2">{{ __('Limit (100%)') }}</label>
                            <div class="col-md-4 form-group d-flex">
                            <input type="text" name="limitlayer62" id="limitlayer62" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                            </div>

                            <label for="" class="col-2">{{ __('Premium Type') }}</label>
                            <div class="col-md-4 form-group d-flex">
                            <input type="text" name="premiumtypelayer62" id="premiumtypelayer62" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                            </div>
                        </div>
                    
                        <div class="row">
                            <label for="" class="col-2"></label>
                            <div class="col-md-4 form-group d-flex">
                                    <a class="text-primary mr-3 float-right " data-toggle="modal"  data-looklayer-id="0" data-target="#addreinstmodal2">
                                        <button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#addreinstmodal2">{{__('Reinstatement')}}</button>
                                    </a>
                            </div>
                            <label for="" class="col-2">{{ __('Nasre Share') }}</label>
                            <div class="col-md-4 form-group d-flex">
                            <input type="text" name="nasreshare62" id="nasreshare62" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                            </div>
                        </div>


                        
                        <div class="modal fade" id="addreinstmodal2" tabindex="-1" user="dialog" aria-labelledby="addreinstmodalLabel" aria-hidden="true">
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
                                                                        <table id="reinstatementable33" class="table table-bordered table-striped w-100" style="overflow-x:auto;">
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
                            <input type="text" name="liability62" id="liability62" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                            </div>

                            <label for="" class="col-2">{{ __('MD Premium') }}</label>
                            <div class="col-md-4 form-group d-flex">
                            <input type="text" name="mdpremium62" id="mdpremium62" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                            </div>
                        
                        </div>

                        <div class="row">

                            <label for="" class="col-2">{{ __('AA Limit') }}</label>
                            <div class="col-md-4 form-group d-flex">
                            <input type="text" name="aadlimit62" id="aadlimit62" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                            </div>

                            <label for="" class="col-2">{{ __('AA Deductible') }}</label>
                            <div class="col-md-4 form-group d-flex">
                            <input type="text" name="aadedcutible62" id="aadedcutible62" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                            </div>
                        </div>


                        <div class="row">
                          <label for="" class="col-2">{{ __('Brokerage') }}</label>
                          <div class="col-md-4 form-group d-flex">
                          <input type="text" name="brokerage62" id="brokerage62" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                          </div>

                          <label for="" class="col-2"></label>
                          <div class="col-md-4 form-group d-flex">
                          </div>
                        </div>

                        <div class="row mb-2">
                            <div class="table-responsive">
                                <table id="tablelayer62" class="table table-bordered table-striped w-100" style="overflow-x:auto;">
                                <thead>
                                <tr>
                                    <th>Detail COB</th>
                                    <th>Share (%)</th>
                                    <th>Group COB</th>
                                    <th>OGRPI (%)</th>
                                    <th>OGRPI Amount</th>
                                    <th>Mindep Amount</th>
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
                          <input type="text" id="position52" name="position52" class="form-control form-control-sm datepicker">
                          </div>
                      </div>
                      <div class="col-md-1">
                          <label for="">{{ __('Transfer Date') }}</label>
                      </div>
                      <div class="col-md-3">
                          <div class="form-group">
                          <input type="text" id="adjtransferdate" name="adjtransferdate" value="{{ date('d/m/Y') }}"  class="form-control form-control-sm" readonly>
                          </div>
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
                        <label for="">{{ __('Actual GRPI') }}</label>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                          <input type="text" id="ogrpi52" name="ogrpi52" class="form-control form-control-sm money text-left">
                          </div>
                      </div>
                      <div class="col-md-4">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-2">
                        <label for="">{{ __('Adjustment') }}</label>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                          <input type="text" id="adjustment52" name="adjustment52"  class="form-control form-control-sm money text-left">
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
                          <input type="text" id="additional_premium52" name="additional_premium52"  class="form-control form-control-sm money text-left">
                          </div>
                      </div>
                      <div class="col-md-4">
                      </div>
                    </div>


                    
                    <div class="row">
                      <div class="col-md-2">
                        <label for="">{{ __('Brokerage Percentage') }}</label>
                      </div>
                      <div class="input-group  col-md-3">
                            <input type="text" id="brokeragepercentage52" name="brokeragepercentage52" class="form-control form-control-sm">
                            <div class="input-group-append">
                              <span class="input-group-text">%</span>
                            </div>
                      </div>
                      <div class="col-md-1">
                          <label for="">{{ __('Brokerage Amount') }}</label>
                      </div>
                      <div class="col-md-2">
                          <div class="form-group">
                              <input type="text" id="brokerage52" name="brokerage52" class="form-control form-control-sm">
                           </div>
                      </div>
                    </div>

                    <div class="row">
                        
                        <div class="col-md-2">
                          <label for="">{{ __('Disc Percentage%') }}</label>
                        </div>
                        <div class="input-group col-md-3">
                            <input type="text" id="discpecentage52" name="discpecentage52" class="form-control form-control-sm">
                            <div class="input-group-append">
                                <span class="input-group-text">%</span>
                            </div>
                        </div>

                        <div class="col-md-1">
                            <label for="">{{ __('Disc Amount') }}</label>
                        </div>
                        <div class="col-md-2">
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
                      <div class="col-md-4">
                          <div class="form-group">
                          <input type="text" id="net_add_premium52" name="net_add_premium52"  class="form-control form-control-sm money text-left">
                          </div>
                      </div>
                      <div class="col-md-1">
                      </div>
                      <div class="col-md-3">
                          <div class="form-group">
                          <!--input type="text" id="retro_share52" name="retro_share52" class="form-control form-control-sm money text-left"-->
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
                                <th>Actual GRPI</th>
                                <th>Adjustment</th>
                                <th>Additional Premium</th>
                                <th>Brokerage</th>
                                <th>Disc (%)</th>
                                <th>Net Add Premium</th>
                                <th>Re Share</th>
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
                                  <input type="hidden" class="form-control form-control-sm" name="adjusmentid62" id="adjusmentid62">
                                  <input type="text" id="counternumberupdate52" name="counternumberupdate52" class="form-control form-control-sm">
                                  </div>
                              </div>
                            </div>

                            
                            <div class="row">
                              <div class="col-md-2">
                                <label for="">{{ __('Position') }}</label>
                              </div>
                              <div class="col-md-6">
                                  <div class="form-group">
                                  <input type="text" id="positionupdate52" name="positionupdate52" class="form-control form-control-sm datepicker">
                                  </div>
                              </div>
                              <div class="col-md-1">
                                  <label for="">{{ __('Transfer Date') }}</label>
                              </div>
                              <div class="col-md-3">
                                  <div class="form-group">
                                  <input type="text" id="adjtransferdateupdate" name="adjtransferdateupdate"  value="{{ date('d/m/Y') }}"  class="form-control form-control-sm datepicker" readonly>
                                  </div>
                              </div>    
                            </div>

                            <div class="row">
                              <div class="col-md-2">
                                <label for="">{{ __('Due Date') }}</label>
                              </div>
                              <div class="col-md-6">
                                  <div class="form-group">
                                  <input type="text" id="duedateupdate52" name="duedateupdate52"  value="{{ date('d/m/Y') }}" class="form-control form-control-sm datepicker">
                                  </div>
                              </div>
                              <div class="col-md-4">
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-md-2">
                                <label for="">{{ __('Actual GRPI') }}</label>
                              </div>
                              <div class="col-md-6">
                                  <div class="form-group">
                                  <input type="text" id="ogrpiupdate52" name="ogrpiupdate52" class="form-control form-control-sm money text-left">
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
                                  <input type="text" id="adjustmentupdate52" name="adjustmentupdate52"  class="form-control form-control-sm money text-left">
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
                                  <input type="text" id="additional_premiumupdate52" name="additional_premiumupdate52"  class="form-control form-control-sm money text-left">
                                  </div>
                              </div>
                              <div class="col-md-4">
                              </div>
                            </div>


                            <div class="row">
                                    <div class="col-md-2">
                                        <label for="">{{ __('Brokerage Percentage') }}</label>
                                    </div>
                                    <div class="input-group col-md-3">
                                          <input type="text" id="brokeragepercentageupdate52" name="brokeragepercentageupdate52" class="form-control form-control-sm">
                                          <div class="input-group-append">
                                              <span class="input-group-text">%</span>
                                          </div>
                                    </div>
                                    <div class="col-md-1">
                                        <label for="">{{ __('Brokerage Amount') }}</label>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="text" id="brokerageupdate52" name="brokerageupdate52" class="form-control form-control-sm">
                                        </div>
                                    </div>
                              </div>


                              <div class="row">
                                  <div class="col-md-2">
                                    <label for="">{{ __('Disc Percentage%') }}</label>
                                  </div>
                                  <div class="input-group col-md-3">
                                      <input type="text" id="discpecentageupdate52" name="discpecentageupdate52" class="form-control form-control-sm">
                                      <div class="input-group-append">
                                          <span class="input-group-text">%</span>
                                      </div>
                                  </div>

                                  <div class="col-md-1">
                                      <label for="">{{ __('Disc Amount') }}</label>
                                  </div>
                                  <div class="col-md-2">
                                      <div class="form-group">
                                      <input type="text" id="discupdate52" name="discupdate52" class="form-control form-control-sm">
                                      </div>
                                  </div>

                                  <div class="col-md-1">
                                    <label for="">{{ __('Re Sharer') }}</label>
                                  </div>
                                  <div class="col-md-3">
                                      <div class="form-group">
                                      <input type="text" id="re_sharerupdate52" name="re_sharerupdate52"  class="form-control form-control-sm">
                                      </div>
                                  </div>
                              </div>


                                <div class="row">
                                <div class="col-md-2">
                                    <label for="">{{ __('Net Add Premium') }}</label>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                    <input type="text" id="net_add_premiumupdate52" name="net_add_premiumupdate52"  class="form-control form-control-sm money text-left">
                                    </div>
                                </div>
                                <div class="col-md-1">
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                    <!--input type="text" id="retro_share52" name="retro_share52" class="form-control form-control-sm money text-left"-->
                                    </div>
                                </div>
                                </div>


                            <div class="col-md-12">
                                <div class="row justify-content-center">
                                  
                                    <div class="col-md-8">
                                      <div class="row justify-content-center my-4">
                                        <div class="col-md-4 text-center">
                                              <button class="btn btn-primary btn-block" onclick="updateadjustmentsubmit()">{{__('Edit  Adjusment')}}</button>
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