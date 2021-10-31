<div class="card" id="group_detailinstallment_card" style="display: none;">
  <div class="card-header bg-gray"> Installment Mindep</div>
  <div class="card-body bg-light-gray">

            <section class="my-4">
                <div class="row mb-2">
                    <div class="col-md-10"></div>
                    <div class="col-md-2">
                    <button class="btn btn-primary btn-block" onclick="prevlayerdetailinstallment()">{{__('Prev (Layer) ')}}</button>                 
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
                <div class="col-md-2"><input type="text" id="masterid32" name="masterid3" class="form-control form-control-sm"
                    readonly></div>
                <div class="col"></div>
                <div class="col-md-2">Date Entry</div>
                <div class="col-md-2"><input type="text" id="masterdateentry32" name="masterdateentry3"
                    class="form-control form-control-sm" readonly></div>
              </div>

              <div class="row mb-2">
                <div class="col-md-2">Ceding/Broker</div>
                <div class="col-md-3"><input type="text" id="masterceding32" name="masterceding3"
                    class="form-control form-control-sm" readonly></div>
                <div class="col"></div>
                <div class="col-md-2">User</div>
                <div class="col-md-2"><input type="text" id="masteruser32" name="masteruser3"
                    class="form-control form-control-sm" readonly></div>
              </div>

              <div class="row mb-2">
                <div class="col-md-2">U/W Year</div>
                <div class="col-md-2"><input type="text" id="masteruwyear32" name="masteruwyear3"
                    class="form-control form-control-sm" readonly></div>
                <div class="col-md-1">Ceding Type</div>
                <div class="col-md-2"><input type="text" id="mastercedingtype32" name="mastercedingtype3"
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
                <div class="col-md-2"><input type="text" id="submasterid32" name="submasterid32"
                    class="form-control form-control-sm" readonly></div>
              </div>

              <div class="row mb-2">
                <div class="col-md-2">Ceding Company</div>
                <div class="col-md-3"><input type="text" id="submasterceding32" name="submasterceding32"
                    class="form-control form-control-sm" readonly></div>
              </div>

              <div class="row mb-2">
                <div class="col-md-2">Period</div>
                <div class="col-md-2"><input type="text" id="submasterperiod322" name="submasterperiod322" class="form-control form-control-sm" readonly></div>
                <div class="col-md-2"><input type="text" id="submasterperiod3222" name="submasterperiod3222" class="form-control form-control-sm" readonly></div>
              </div>

              <div class="row mb-2">
                <div class="col-md-2">Type</div>
                <div class="col-md-2"><input type="text" id="submastertype32" name="submastertype32"
                    class="form-control form-control-sm" readonly></div>
              </div>
              
            <div class="col-md-2">
                  <h3>Group COB</h3>
            </div>
            <hr>

              <div class="row mb-2">
                <div class="col-md-2">{{ __('ID') }}</div>
                <div class="col-md-4 form-group d-flex">
                <input type="text" name="idgroupcob32" id="idgroupcob32" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                </div>
              </div>

              <div class="row mb-2">
                <div class="col-md-2">{{ __('Grop COB') }}</div>
                <div class="col-md-4 form-group d-flex">
                <input type="text" name="groucob32" id="groucob32" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                </div>
              </div>

              <div class="row mb-2">
                <div class="col-md-2">{{ __('OGRPI') }}</div>
                <div class="col-md-4 form-group d-flex">
                <input type="text" name="groupcoborgpi32" id="groupcoborgpi32" class="form-control form-control-sm ml-2 money text-left" autocomplete="off" readonly>
                </div>
              </div>

              <div class="row mb-2">
                <div class="col-md-2">{{ __('Type Of Treaty') }}</div>
                <div class="col-md-4 form-group d-flex">
                 <input type="text" name="groupcobtype32" id="groupcobtype32" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                </div>
              </div>

              <div class="row mb-2">
                <div class="col-md-2">{{ __('Brokerage %') }}</div>
                <div class="col-md-4 form-group d-flex">
                    <input type="text" name="groupcobbrokerage32" id="groupcobbrokerage32" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                </div>
              </div>

              <div class="row mb-2">
                <div class="col-md-2">{{ __('VAT %') }}</div>
                <div class="col-md-4 form-group d-flex">
                    <input type="text" name="groupcobbrokeragepersen32" id="groupcobbrokeragepersen32" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
              </div>
              </div>

              <div class="row mb-2">
                  <div class="table-responsive">
                      <table id="tablegroupcob32" class="table table-bordered table-striped w-100" style="overflow-x:auto;">
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
                    <input type="text" name="levellayer32" id="levellayer32" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                    </div>

                    <label for="" class="col-2">{{ __('Adj Prem Rate') }}</label>
                    <div class="col-md-4 form-group d-flex">
                    <input type="text" name="premratelayer32" id="premratelayer32" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                    </div>
            </div>

            <div class="row">
                    <label for="" class="col-2">{{ __('U/W Retention') }}</label>
                    <div class="col-md-4 form-group d-flex">
                    <input type="text" name="uwretlayer32" id="uwretlayer32" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                    </div>

                    <label for="" class="col-2">{{ __('Mindep (100%)') }}</label>
                    <div class="col-md-4 form-group d-flex">
                    <input type="text" name="mindeplayer32" id="mindeplayer32" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                    </div>
                
            </div>

            <div class="row">
                <label for="" class="col-2">{{ __('Limit (100%)') }}</label>
                <div class="col-md-4 form-group d-flex">
                <input type="text" name="limitlayer32" id="limitlayer32" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                </div>

                <label for="" class="col-2">{{ __('Premium Type') }}</label>
                <div class="col-md-4 form-group d-flex">
                  <input type="text" name="premiumtypelayer32" id="premiumtypelayer32" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
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
                <input type="text" name="nasreshare32" id="nasreshare32" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
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
                                                            <table id="reinstatementable332" class="table table-bordered table-striped w-100" style="overflow-x:auto;">
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
                <input type="text" name="liability32" id="liability32" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                </div>

                <label for="" class="col-2">{{ __('MD Premium') }}</label>
                <div class="col-md-4 form-group d-flex">
                <input type="text" name="mdpremium32" id="mdpremium32" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                </div>
               
            </div>

            <div class="row">

                <label for="" class="col-2">{{ __('AA Limit') }}</label>
                <div class="col-md-4 form-group d-flex">
                <input type="text" name="aadlimit32" id="aadlimit32" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                </div>

                <label for="" class="col-2">{{ __('AA Deductible') }}</label>
                <div class="col-md-4 form-group d-flex">
                <input type="text" name="aadedcutible32" id="aadedcutible32" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                </div>
            </div>



            <div class="row mb-2">
                <div class="table-responsive">
                    <table id="tablelayer32" class="table table-bordered table-striped w-100" style="overflow-x:auto;">
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
            
            <div class="form-group">


                      <div class="row">

                        <div class="col-md-6">
                        </div>

                        <div class="col-md-2">
                          <label for="">{{ __('Counter Number') }}</label>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                            <input type="hidden" class="form-control form-control-sm" name="layerid32" id="layerid32">
                            <input type="text" name="counternumberinst" id="counternumberinst" class="form-control form-control-sm">
                            </div>
                        </div>

                      </div>


                      <div class="row">
                      <div class="col-md-2">
                          <label for="">{{ __('Due Date') }}</label>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                            <input type="text" name="duedateinst" id="duedateinst"   value="{{ date('d/m/Y') }}" class="form-control form-control-sm datepicker">
                            </div>
                        </div>

                        <div class="col-md-2">
                          <label for="">{{ __('Gross') }}</label>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                            <input type="text" name="grossinst" id="grossinst"   value="{{ date('d/m/Y') }}" class="form-control form-control-sm money text-left">
                            </div>
                        </div>

                      </div>


                      <div class="row">
                      <div class="col-md-2">
                          <label for="">{{ __('Production Date') }}</label>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                            <input type="text" name="repdateinst" id="repdateinst"  class="form-control form-control-sm datepicker">
                            </div>
                        </div>

                        <div class="col-md-2">
                          <label for="">{{ __('Brokerage') }}</label>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                 <input type="text" name="brokerinst" id="brokerinst"  class="form-control form-control-sm money text-left">
                            </div>
                        </div>

                      </div>


                      <div class="row">
                      <div class="col-md-2">
                          <label for="">{{ __('PCT %') }}</label>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                            <input type="text" name="pctinst" id="pctinst" class="form-control form-control-sm numberdata">
                            </div>
                        </div>

                        <div class="col-md-2">
                          <label for="">{{ __('VAT Amount') }}</label>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                            <input type="text" name="amountinst" id="amountinst" class="form-control form-control-sm money text-left" readonly>
                            </div>
                        </div>

                      </div>


                      <div class="row">
                      <div class="col-md-2">
                          <label for="">{{ __('PPW Days') }}</label>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                            <input type="text"  name="ppwdaysinst" id="ppwdaysinst" class="form-control form-control-sm numberdata">
                            </div>
                        </div>

                        <div class="col-md-6">
                        
                        </div>
                        
                      </div>

                    <div class="col-md-12">
                      <div class="row justify-content-center">

                        <div class="col-md-8">
                          <div class="row justify-content-center my-4">
                            <div class="col-md-4 text-center">
                                <button class="btn btn-primary btn-block" onclick="storeinstallmentdetailsubmit()">{{__('Add Detail Installment')}}</button>
                                        
                            </div>
                            <div class="col-md-4 text-center">
                                <button class="btn btn-primary btn-block" onclick="prevlayerdetailinstallment()">{{__('Prev (Layer) ')}}</button>
                                        
                            </div>
                          </div>
                        </div>
                        
                      </div>
                    </div>


                    <div class="row mb-2">
                      <div class="col-md-12">
                        <div class="card">
                          <div class="card-body">
                          <table id="tabledetailinst32" class="table table-bordered table-striped w-100" style="overflow-x:auto;">
                            <thead>
                            <tr>
                                <th>No </th>
                                <th>Due Date</th>
                                <th>Production Date</th>
                                <th>PCt (%)</th>
                                <th>Gross</th>
                                <th>Broker</th>
                                <th>Amount</th>
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

                     
              <hr>
            </div>
      
  </div>
</div>


<div class="modal fade" id="editdetailinstallmentmodal" tabindex="-1" user="dialog" aria-labelledby="editdetailinstallmentmodalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl" user="document">
          <div class="modal-content bg-light-gray">
                      <div class="modal-header bg-gray">
                          <h5 class="modal-title" id="editdetailinstallmentmodalLabel">{{__('Edit Group COB')}}</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-body">

                            <div class="row">

                                  <div class="col-md-6">
                                  </div>

                                  <div class="col-md-2">
                                    <label for="">{{ __('Counter Number') }}</label>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="form-group">
                                      <input type="hidden" class="form-control form-control-sm" name="layeridupdate32" id="layeridupdate32">
                                      <input type="hidden" class="form-control form-control-sm" name="installmentidupdate32" id="installmentidupdate32">
                                      <input type="text" name="counternumberinstupdate" id="counternumberinstupdate" class="form-control form-control-sm">
                                      </div>
                                  </div>

                                  </div>


                                  <div class="row">
                                  <div class="col-md-2">
                                    <label for="">{{ __('Due Date') }}</label>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="form-group">
                                      <input type="text" name="duedateinstupdate" id="duedateinstupdate"  class="form-control form-control-sm datepicker">
                                      </div>
                                  </div>

                                  <div class="col-md-2">
                                    <label for="">{{ __('Gross') }}</label>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="form-group">
                                      <input type="text" name="grossinstupdate" id="grossinstupdate"  class="form-control form-control-sm money text-left">
                                      </div>
                                  </div>

                                  </div>


                                  <div class="row">
                                  <div class="col-md-2">
                                    <label for="">{{ __('Production Date') }}</label>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="form-group">
                                      <input type="text" name="repdateinstupdate" id="repdateinstupdate"  class="form-control form-control-sm datepicker">
                                      </div>
                                  </div>

                                  <div class="col-md-2">
                                    <label for="">{{ __('Brokerage') }}</label>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <input type="text" name="brokerinstupdate" id="brokerinstupdate"  class="form-control form-control-sm money text-left">
                                      </div>
                                  </div>

                                  </div>


                                  <div class="row">
                                  <div class="col-md-2">
                                    <label for="">{{ __('PCT %') }}</label>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="form-group">
                                      <input type="text" name="pctinstupdate" id="pctinstupdate" class="form-control form-control-sm numberdata">
                                      </div>
                                  </div>

                                  <div class="col-md-2">
                                    <label for="">{{ __('VAT Amount') }}</label>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="form-group">
                                      <input type="text" name="amountinstupdate" id="amountinstupdate" class="form-control form-control-sm money text-left">
                                      </div>
                                  </div>

                                  </div>


                                  <div class="row">
                                  <div class="col-md-2">
                                    <label for="">{{ __('PPW Days') }}</label>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="form-group">
                                      <input type="text"  name="ppwdaysinstupdate" id="ppwdaysinstupdate" class="form-control form-control-sm numberdata">
                                      </div>
                                  </div>

                                  <div class="col-md-6">

                                  </div>

                                  </div>

                                  <div class="col-md-12">
                                  <div class="row justify-content-center">

                                  <div class="col-md-8">
                                    <div class="row justify-content-center my-4">
                                      <div class="col-md-4 text-center">
                                          <button class="btn btn-primary btn-block" onclick="updateinstallmentdetailsubmit()">{{__('Edit Detail Installment')}}</button>
                                                  
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