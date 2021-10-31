<div class="card" id="group_detailadjreins_card" style="display: none;">
  <div class="card-header bg-gray"> Adjustment Reinstatement Entry</div>
  <div class="card-body bg-light-gray">

            <section class="my-4">
                <div class="row mb-2">
                    <div class="col-md-10"></div>
                    <div class="col-md-2">
                      <button class="btn btn-primary btn-block" onclick="prevdatalookadjreinstatement()">{{__('Prev (Cal Reinstatement) ')}}</button>
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
                <div class="col-md-2"><input type="text" id="masteridadjreins33" name="masteridadjreins33" class="form-control form-control-sm"
                    readonly></div>
                <div class="col"></div>
                <div class="col-md-2">Date Entry</div>
                <div class="col-md-2"><input type="text" id="masterdateentryadjreins33" name="masterdateentryadjreins33"
                    class="form-control form-control-sm" readonly></div>
              </div>

              <div class="row mb-2">
                <div class="col-md-2">Ceding/Broker</div>
                <div class="col-md-3"><input type="text" id="mastercedingadjreins33" name="masterceding33"
                    class="form-control form-control-sm" readonly></div>
                <div class="col"></div>
                <div class="col-md-2">User</div>
                <div class="col-md-2"><input type="text" id="masteruseradjreins33" name="masteruseradjreins33"
                    class="form-control form-control-sm" readonly></div>
              </div>

              <div class="row mb-2">
                <div class="col-md-2">U/W Year</div>
                <div class="col-md-2"><input type="text" id="masteruwyearadjreins33" name="masteruwyearadjreins3"
                    class="form-control form-control-sm" readonly></div>
                <div class="col-md-1">Ceding Type</div>
                <div class="col-md-2"><input type="text" id="mastercedingtypeadjreins33" name="mastercedingtypeadjreins33"
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
                <div class="col-md-2"><input type="text" id="submasteridadjreins33" name="submasteridadjreins33"
                    class="form-control form-control-sm" readonly></div>
              </div>

              <div class="row mb-2">
                <div class="col-md-2">Ceding Company</div>
                <div class="col-md-3"><input type="text" id="submastercedingadjreins33" name="submastercedingadjreins33"
                    class="form-control form-control-sm" readonly></div>
              </div>

              <div class="row mb-2">
                <div class="col-md-2">Period</div>
                    <div class="col-md-2"><input type="text" id="submasterperiodadjreins33" name="submasterperiodadjreins33" class="form-control form-control-sm" readonly></div>
                    <div class="col-md-2"><input type="text" id="submasterperiodadjreins332" name="submasterperiodadjreins332" class="form-control form-control-sm" readonly></div>
              </div>

              <div class="row mb-2">
                <div class="col-md-2">Type</div>
                <div class="col-md-2"><input type="text" id="submastertypeadjreins33" name="submastertypeadjreins33"
                    class="form-control form-control-sm" readonly></div>
              </div>
              
              <div class="col-md-2">
                  <h3>Group COB</h3>
            </div>
            <hr>

              <div class="row mb-2">
                <div class="col-md-2">{{ __('ID') }}</div>
                <div class="col-md-4 form-group d-flex">
                <input type="text" name="idgroupcobadjreins33" id="idgroupcobadjreins33" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                </div>
              </div>

              <div class="row mb-2">
                <div class="col-md-2">{{ __('Grop COB') }}</div>
                <div class="col-md-4 form-group d-flex">
                <input type="text" name="groucobadjreins33" id="groucobadjreins33" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                </div>
              </div>

              <div class="row mb-2">
                <div class="col-md-2">{{ __('OGRPI') }}</div>
                <div class="col-md-4 form-group d-flex">
                <input type="text" name="groupcoborgpiadjreins33" id="groupcoborgpiadjreins33" class="form-control form-control-sm ml-2 money text-left" autocomplete="off" readonly>
                </div>
              </div>

              <div class="row mb-2">
                <div class="col-md-2">{{ __('Type Of Treaty') }}</div>
                <div class="col-md-4 form-group d-flex">
                 <input type="text" name="groupcobtypeadjreins33" id="groupcobtypeadjreins33" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                </div>
              </div>


              <div class="row mb-2">
                <div class="col-md-2">{{ __('Brokerage %') }}</div>
                <div class="col-md-4 form-group d-flex">
                    <input type="text" name="groupcobbrokerageadjreins33" id="groupcobbrokerageadjreins33" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                </div>
              </div>


              <div class="row mb-2">
                <div class="col-md-2">{{ __('VAT %') }}</div>
                <div class="col-md-4 form-group d-flex">
                    <input type="text" name="groupcobbrokeragepersenadjreins33" id="groupcobbrokeragepersenadjreins33" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
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
                    <input type="text" name="levellayeradjreins33" id="levellayeradjreins33" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                    </div>

                    <label for="" class="col-2">{{ __('Adj Prem Rate') }}</label>
                    <div class="col-md-4 form-group d-flex">
                    <input type="text" name="premratelayeradjreins33" id="premratelayeradjreins33" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                    </div>
            </div>

            <div class="row">
                  <label for="" class="col-2">{{ __('U/W Retention') }}</label>
                  <div class="col-md-4 form-group d-flex">
                  <input type="text" name="uwretlayeradjreins33" id="uwretlayeradjreins33" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                  </div>

                  <label for="" class="col-2">{{ __('Mindep (100%)') }}</label>
                  <div class="col-md-4 form-group d-flex">
                  <input type="text" name="mindeplayeradjreins33" id="mindeplayeradjreins33" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                  </div>
            </div>

            <div class="row">

                <label for="" class="col-2">{{ __('Limit (100%)') }}</label>
                <div class="col-md-4 form-group d-flex">
                <input type="text" name="limitlayeradjreins33" id="limitlayeradjreins33" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                </div>


                <label for="" class="col-2">{{ __('Premium Type') }}</label>
                <div class="col-md-4 form-group d-flex">
                  <input type="text" name="premiumtypelayeradjreins33" id="premiumtypelayeradjreins33" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                </div>
                
            </div>



            <div class="row">
                <label for="" class="col-2"></label>
                <div class="col-md-4 form-group d-flex">
                        <a class="text-primary mr-3 float-right " data-toggle="modal"  data-looklayer-id="0" data-target="#addreinstmodaladjreins3">
                            <button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#addreinstmodaladjreins3">{{__('Reinstatement')}}</button>
                        </a>
                </div>

  
                <label for="" class="col-2">{{ __('Nasre Share') }}</label>
                <div class="col-md-4 form-group d-flex">
                <input type="text" name="nasreshareadjreins33" id="nasreshareadjreins33" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                </div>
            </div>


            
            <div class="modal fade" id="addreinstmodaladjreins3" tabindex="-1" user="dialog" aria-labelledby="addreinstmodalLabel" aria-hidden="true">
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
                                                            <div class="form-group">
                                                            </div>
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
                <input type="text" name="liabilityadjreins33" id="liabilityadjreins33" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                </div>

                <label for="" class="col-2">{{ __('MD Premium') }}</label>
                <div class="col-md-4 form-group d-flex">
                <input type="text" name="mdpremiumadjreins33" id="mdpremiumadjreins33" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                </div>
               
            </div>

            <div class="row">

                <label for="" class="col-2">{{ __('AA Limit') }}</label>
                <div class="col-md-4 form-group d-flex">
                <input type="text" name="aadlimitadjreins33" id="aadlimitadjreins33" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                </div>

                <label for="" class="col-2">{{ __('AA Deductible') }}</label>
                <div class="col-md-4 form-group d-flex">
                <input type="text" name="aadedcutibleadjreins33" id="aadedcutibleadjreins33" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
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
                <h3>Adjusment Data</h3>
            </div>
            <hr>

            <div class="row">
                <label for="" class="col-2">{{ __('Adjustment') }}</label>
                <div class="col-md-4 form-group d-flex">
                <input type="text" name="adjustementreins33" id="adjustementreins33" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
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
                <input type="text" name="detailcobadjreins33" id="detailcobadjreins33" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                </div>

                <label for="" class="col-2">{{ __('Business Source') }}</label>
                <div class="col-md-4 form-group d-flex">
                <input type="text" name="businesssourceadjreins33" id="businesssourceadjreins33" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                </div>
            </div>

            <div class="row">
                <label for="" class="col-2">{{ __('OGRPI %') }}</label>
                <div class="col-md-4 form-group d-flex">
                <input type="text" name="ogrpiadjreins33" id="ogrpiadjreins33" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                </div>

                <label for="" class="col-2">{{ __('Business Type') }}</label>
                <div class="col-md-4 form-group d-flex">
                <input type="text" name="businesstypeadjreins33" id="businesstypeadjreins33" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                </div>
            </div>

            <div class="row">
                <label for="" class="col-2">{{ __('Maximum Acceptence') }}</label>
                <div class="col-md-4 form-group d-flex">
                <input type="text" name="maximum_acceptenceadjreins33" id="maximum_acceptenceadjreins33" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                </div>
            </div>

            <hr>
            <div class="col-md-2">
                <h3>Calculation Reinstatement</h3>
            </div>
            <hr>

            <div class="row">
                <label for="" class="col-2">{{ __('Reins ID') }}</label>
                <div class="col-md-4 form-group d-flex">
                  <input type="text" name="reinsid33" id="reinsid33" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                </div>

                <label for="" class="col-2"></label>
                <div class="col-md-4 form-group d-flex">
                </div>
            </div>

            <div class="row">
                <label for="" class="col-2">{{ __('Status Doc') }}</label>
                <div class="col-md-4 form-group d-flex">
                  <input type="text" name="statusdoc33" id="statusdoc33" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                </div>

                <label for="" class="col-2"></label>
                <div class="col-md-4 form-group d-flex">
                </div>
            </div>


            <div class="row">
                <label for="" class="col-2">{{ __('Date Prod') }}</label>
                <div class="col-md-4 form-group d-flex">
                  <input type="text" name="dateprod33" id="dateprod33" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                </div>

                <label for="" class="col-2"></label>
                <div class="col-md-4 form-group d-flex">
                </div>
            </div>


            <div class="row">
                <label for="" class="col-2">{{ __('DLA Reff') }}</label>
                <div class="col-md-4 form-group d-flex">
                  <input type="text" name="dlareff33" id="dlareff33" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                </div>

                <label for="" class="col-2"></label>
                <div class="col-md-4 form-group d-flex">
                </div>
            </div>

            <div class="row">
                <label for="" class="col-2">{{ __('Insured') }}</label>
                <div class="col-md-4 form-group d-flex">
                  <input type="text" name="insured33" id="insured33" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                </div>

                <label for="" class="col-2"></label>
                <div class="col-md-4 form-group d-flex">
                </div>
            </div>

            <div class="row">
                <label for="" class="col-2">{{ __('Currency') }}</label>
                <div class="col-md-4 form-group d-flex">
                  <input type="text" name="currency33" id="currency33" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                </div>

                <label for="" class="col-2">{{ __('Settelement') }}</label>
                <div class="col-md-4 form-group d-flex">
                  <input type="text" name="settlement33" id="settlement33" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                </div>
            </div>

            

            <div class="row">
                <label for="" class="col-2">{{ __('Loss Nasre') }}</label>
                <div class="col-md-4 form-group d-flex">
                  <input type="text" name="lossnasre33" id="lossnasre33" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                </div>

                <label for="" class="col-2"></label>
                <div class="col-md-4 form-group d-flex">
                </div>
            </div>


            <div class="row">
                <label for="" class="col-2">{{ __('Reinstatement Rate') }}</label>
                <div class="col-md-4 form-group d-flex">
                  <input type="text" name="reinstatementrate33" id="reinstatementrate33" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                </div>

                <label for="" class="col-1">{{ __('Day') }}</label>
                <div class="col-md-2 form-group d-flex">
                  <input type="text" name="day33" id="day33" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                </div>

                <label for="" class="col-1">{{ __('Of') }}</label>
                <div class="col-md-2 form-group d-flex">
                  <input type="text" name="dayof33" id="dayof33" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                </div>
            </div>

            <div class="row">
                <label for="" class="col-2">{{ __('Reinstatement Premium') }}</label>
                <div class="col-md-4 form-group d-flex">
                  <input type="text" name="reinstatementpremium33" id="reinstatementpremium33" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                </div>

                <label for="" class="col-2"></label>
                <div class="col-md-4 form-group d-flex">
                </div>
            </div>

            <div class="row">
                <label for="" class="col-2">{{ __('Nasionalre Share') }}</label>
                <div class="col-md-4 form-group d-flex">
                  <input type="text" name="reinsnasreshare33" id="reinsnasreshare33" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                </div>

                <label for="" class="col-2"></label>
                <div class="col-md-4 form-group d-flex">
                </div>
            </div>

                  
            <hr>
            <div class="col-md-2">
                <h3>Adjustment Calculations Reinstatement</h3>
            </div>
            <hr>

            <div class="form-group">
                      
                      <div class="row">
                          <div class="col-md-6">
                           </div>
                          
                          
                          <div class="col-md-2">
                            <label for="">{{ __('Type') }}</label>
                          </div>
                          <div class="col-md-4">
                              <div class="form-group">
                              <select class="form-control" name="typeadjreins333" id="typeadjreins333" required>
                                <option value selected disabled>Pilih</option>
                                <option value="Normal">Normal</option>
                                <option value="Correction">Correction</option>
                              </select>
                             </div>
                          </div>
                      </div>

            
                      <div class="row">
                          <div class="col-md-2">
                            <label for="">{{ __('Counter Number') }}</label>
                          </div>
                          <div class="col-md-4">
                              <div class="form-group">
                              <input type="text" class="form-control form-control-sm" name="counternumberadjreins333" id="counternumberadjreins333"> &nbsp;&nbsp; 
                              </div>
                          </div>
                          
                          <div class="col-md-2">
                            <label for="">{{ __('Transfer Date') }}</label>
                          </div>
                          <div class="col-md-4">
                              <div class="form-group">
                              <input type="text" class="form-control form-control-sm" name="transferdateadjreins333" id="transferdateadjreins333" value="{{ date('d/m/Y') }}" readonly> &nbsp;&nbsp; 
                             </div>
                          </div>
                      </div>


                      <div class="row">
                          <div class="col-md-2">
                            <label for="">{{ __('Adjustment  Reinstatement ID') }}</label>
                          </div>
                          <div class="col-md-4">
                              <div class="form-group">
                              <input type="hidden" class="form-control form-control-sm" name="layeradjreinsid33" id="layeradjreinsid33">
                              <input type="hidden" class="form-control form-control-sm" name="detailcobadjreins333" id="detailcobadjreins333">
                              <input type="hidden" class="form-control form-control-sm" name="detailadjreinsid33" id="detailadjreinsid33">
                              <input type="hidden" class="form-control form-control-sm" name="claimadjreinsid33" id="claimadjreinsid33">
                              <input type="text" class="form-control form-control-sm" name="adjreins333" id="adjreins333"> &nbsp;&nbsp; 
                              </div>
                          </div>

                          <div class="col-md-2">
                            <label for="">{{ __('Username') }}</label>
                          </div>
                          <div class="col-md-4">
                              <div class="form-group">
                              <input type="text" class="form-control form-control-sm" name="usernameadjreins333" id="usernameadjreins333"  value="{{ Auth::user()->name }}" readonly> &nbsp;&nbsp; 
                              </div>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col-md-2">
                            <label for="">{{ __('Status Doc') }}</label>
                          </div>
                          <div class="col-md-4">
                              <div class="form-group">
                             <select class="form-control" name="statusdocadjreins333" id="statusdocadjreins333" required>
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
                            <label for="">{{ __('Due Date') }}</label>
                          </div>
                          <div class="col-md-4">
                              <div class="form-group">
                              <input type="text" class="form-control form-control-sm datepicker" name="adjreinsduedate333" id="adjreinsduedate333"> &nbsp;&nbsp; 
                              </div>
                          </div>

                          <div class="col-md-2">
                            <label for="">{{ __('Production Date') }}</label>
                          </div>
                          <div class="col-md-4">
                              <div class="form-group">
                              <input type="text" class="form-control form-control-sm datepicker" name="adjreinsproddate333" id="adjreinsproddate333"> &nbsp;&nbsp; 
                              </div>   
                          </div>
                      </div>

                      <div class="row">
                          <div class="col-md-2">
                            <label for="">{{ __('Position') }}</label>
                          </div>
                          <div class="col-md-4">
                              <div class="form-group">
                              <input type="text" class="form-control form-control-sm datepicker" name="adjreinsposition333" id="adjreinsposition333"> &nbsp;&nbsp; 
                              </div>
                          </div>

                          <div class="col-md-6">
                          </div>
                      </div>

                      <div class="row">
                          <div class="col-md-2">
                            <label for="">{{ __('Reinstatement') }}</label>
                          </div>
                          <div class="col-md-4">
                              <div class="form-group">
                              <input type="text" class="form-control form-control-sm money text-left" name="adjreinstatement333" id="adjreinstatement333"> &nbsp;&nbsp; 
                              </div>
                          </div>

                          <div class="col-md-6">
                          </div>
                      </div>

                      <div class="row">
                          <div class="col-md-2">
                            <label for="">{{ __('Nasionalre Share') }}</label>
                          </div>
                          <div class="col-md-4">
                              <div class="form-group">
                              <input type="text" class="form-control form-control-sm money text-left" name="adjreinsnasreshare333" id="adjreinsnasreshare333"> &nbsp;&nbsp; 
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
                                     <button class="btn btn-primary btn-block" onclick="storeadjreinssubmit()">{{__('Add Adjusment Reinstatement')}}</button>
                                </div>
                                <div class="col-md-4 text-center">
                                     <button class="btn btn-primary btn-block" onclick="prevdatalookadjreinstatement()">{{__('Prev (Layer) ')}}</button>               
                                </div>
                              </div>
                            </div>
                        </div>
                     </div>


                    <div class="row mb-2">
                      <div class="col-md-12">
                        <div class="card">
                          <div class="card-body">
                             <table id="tableadjreins33" class="table table-bordered table-striped w-100" style="overflow-x:auto;">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Reins ID</th>
                                <th>Due Date</th>
                                <th>Position</th>
                                <th>Reinstatement</th>
                                <th>Nasre Share</th>
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


<div class="modal fade" id="editadjreinsmodal" tabindex="-1" user="dialog" aria-labelledby="editadjreinsmodalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl" user="document">
          <div class="modal-content bg-light-gray">
                      <div class="modal-header bg-gray">
                          <h5 class="modal-title" id="editadjreinsmodalLabel">{{__('Edit Adjusment Reinstatement')}}</h5>
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
                                  <label for="">{{ __('Type') }}</label>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                    <select class="form-control" name="typeadjreinsupdate333" id="typeadjreinsupdate333" required>
                                      <option value selected disabled>Pilih</option>
                                      <option value="Normal">Normal</option>
                                      <option value="Correction">Correction</option>
                                    </select>
                                  </div>
                                </div>
                            </div>

                  
                            <div class="row">
                                <div class="col-md-2">
                                  <label for="">{{ __('No') }}</label>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" name="counternumberadjreinsupdate333" id="counternumberadjreinsupdate333"> &nbsp;&nbsp; 
                                    </div>
                                </div>
                                
                                <div class="col-md-2">
                                  <label for="">{{ __('Transfer Date') }}</label>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" name="transferdateadjreinsupdate333" id="transferdateadjreinsupdate333" readonly> &nbsp;&nbsp; 
                                  </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-2">
                                  <label for="">{{ __('Adjustment  Reinstatement ID') }}</label>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                    <input type="hidden" class="form-control form-control-sm" name="layeradjreinsidupdate33" id="layeradjreinsidupdate33">
                                    <input type="hidden" class="form-control form-control-sm" name="detailcobadjreinsupdate333" id="detailcobadjreinsupdate333">
                                    <input type="hidden" class="form-control form-control-sm" name="detailadjreinsidupdate33" id="detailadjreinsidupdate33">
                                    <input type="hidden" class="form-control form-control-sm" name="claimadjreinsidupdate33" id="claimadjreinsidupdate33">
                                    <input type="text" class="form-control form-control-sm" name="adjreinsupdate333" id="adjreinsupdate333"> &nbsp;&nbsp; 
                                    </div>
                                </div>

                                <div class="col-md-2">
                                  <label for="">{{ __('Username') }}</label>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" name="usernameadjreinsupdate333" id="usernameadjreinsupdate333" readonly> &nbsp;&nbsp; 
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-2">
                                  <label for="">{{ __('Status Doc') }}</label>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                  <select class="form-control" name="statusdocadjreinsupdate333" id="statusdocadjreinsupdate333" required>
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
                                  <label for="">{{ __('Due Date') }}</label>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                    <input type="text" class="form-control form-control-sm datepicker" name="adjreinsduedateupdate333" id="adjreinsduedateupdate333"> &nbsp;&nbsp; 
                                    </div>
                                </div>

                                <div class="col-md-2">
                                  <label for="">{{ __('Production Date') }}</label>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                    <input type="text" class="form-control form-control-sm datepicker" name="adjreinsproddateupdate333" id="adjreinsproddateupdate333"> &nbsp;&nbsp; 
                                    </div>   
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-2">
                                  <label for="">{{ __('Position') }}</label>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                    <input type="text" class="form-control form-control-sm datepicker" name="adjreinspositionupdate333" id="adjreinspositionupdate333"> &nbsp;&nbsp; 
                                    </div>
                                </div>

                                <div class="col-md-6">
                                </div>
                            </div>

                              <div class="row">
                                  <div class="col-md-2">
                                    <label for="">{{ __('Reinstatement') }}</label>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="form-group">
                                      <input type="text" class="form-control form-control-sm money text-left" name="adjreinstatementupdate333" id="adjreinstatementupdate333"> &nbsp;&nbsp; 
                                      </div>
                                  </div>

                                  <div class="col-md-6">
                                  </div>
                              </div>

                              <div class="row">
                                  <div class="col-md-2">
                                    <label for="">{{ __('Nasre Share') }}</label>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="form-group">
                                      <input type="text" class="form-control form-control-sm money text-left" name="adjreinsnasreshareupdate333" id="adjreinsnasreshareupdate333"> &nbsp;&nbsp; 
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
                                            <button class="btn btn-primary btn-block" onclick="updateadjreinssubmit()">{{__('Edit Detail COB')}}</button>
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