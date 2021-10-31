<div class="card" id="group_layer_card" style="display: none;">
  <div class="card-header bg-gray">Layer</div>
  <div class="card-body bg-light-gray">

        <section class="my-4">
            <div class="row mb-2">
                <div class="col-md-10"></div>
                <div class="col-md-2">
                     <button class="btn btn-primary btn-block" onclick="prevgroucoblayer()">{{__('Prev (Group Cob)')}}</button>
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
                <div class="col-md-2"><input type="text" id="masterid412" name="masterid412" class="form-control form-control-sm"
                    readonly></div>
                <div class="col"></div>
                <div class="col-md-2">Date Entry</div>
                <div class="col-md-2"><input type="text" id="masterdateentry412" name="masterdateentry412"
                    class="form-control form-control-sm" readonly></div>
                </div>

              <div class="row mb-2">
                <div class="col-md-2">Ceding/Broker</div>
                <div class="col-md-3"><input type="text" id="masterceding412" name="masterceding412"
                    class="form-control form-control-sm" readonly></div>
                <div class="col"></div>
                <div class="col-md-2">User</div>
                <div class="col-md-2"><input type="text" id="masteruser412" name="masteruser412"
                    class="form-control form-control-sm" readonly></div>
              </div>

              <div class="row mb-2">
                <div class="col-md-2">U/W Year</div>
                <div class="col-md-2"><input type="text" id="masteruwyear412" name="masteruwyear412"
                    class="form-control form-control-sm" readonly></div>
                <div class="col-md-1">Ceding Type</div>
                <div class="col-md-2"><input type="text" id="mastercedingtype412" name="mastercedingtype41"
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
            <div class="col-md-2"><input type="text" id="submasterid412" name="submasterid412"
                class="form-control form-control-sm" readonly></div>
            </div>

            <div class="row mb-2">
            <div class="col-md-2">Ceding Company</div>
            <div class="col-md-3"><input type="text" id="submasterceding412" name="submasterceding412"
                class="form-control form-control-sm" readonly></div>
            </div>

            <div class="row mb-2">
            <div class="col-md-2">Period</div>
                <div class="col-md-2">
                    <input type="text" id="submasterperiod412" name="submasterperiod412" class="form-control form-control-sm" readonly>
                </div>
                <div class="col-md-2">
                    <input type="text" id="submasterperiod4122" name="submasterperiod4122" class="form-control form-control-sm" readonly>
                </div>

            </div>

            <div class="row mb-2">
            <div class="col-md-2">Type</div>
            <div class="col-md-2"><input type="text" id="submastertype412" name="submastertype412"
                class="form-control form-control-sm" readonly></div>
            </div>
            
            <div class="col-md-2">
            <h3>Group COB</h3>
            </div>
            <hr>

            <div class="row mb-2">
            <div class="col-md-2">{{ __('ID') }}</div>
            <div class="col-md-4 form-group d-flex">
            <input type="text" name="idgroupcob412" id="idgroupcob412" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
            </div>
            </div>

            <div class="row mb-2">
            <div class="col-md-2">{{ __('Grop COB') }}</div>
            <div class="col-md-4 form-group d-flex">
            <input type="text" name="groucob412" id="groucob412" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
            </div>
            </div>

            <div class="row mb-2">
            <div class="col-md-2">{{ __('OGRPI') }}</div>
            <div class="col-md-4 form-group d-flex">
            <input type="text" name="groupcoborgpi412" id="groupcoborgpi412" class="form-control form-control-sm ml-2 money text-left" autocomplete="off" readonly>
            </div>
            </div>

            <div class="row mb-2">
            <div class="col-md-2">{{ __('Type Of Treaty') }}</div>
            <div class="col-md-4 form-group d-flex">
                <input type="text" name="groupcobtype412" id="groupcobtype412" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
            </div>
            </div>

            <div class="row mb-2">
            <div class="col-md-2">{{ __('Brokerage %') }}</div>
            <div class="col-md-4 form-group d-flex">
                <input type="text" name="groupcobbrokerage412" id="groupcobbrokerage412" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
            </div>
            </div>

            <div class="row mb-2">
            <div class="col-md-2">{{ __('VAT %') }}</div>
            <div class="col-md-4 form-group d-flex">
                <input type="text" name="groupcobbrokeragepersen412" id="groupcobbrokeragepersen412" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
            </div>
            </div>


        <div class="row mb-2">
            <div class="table-responsive">
                <table id="tablegroupcob412" class="table table-bordered table-striped w-100" style="overflow-x:auto;">
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
        <section class="my-4">
            <div class="row">
                <div class="col-md-1">
                    <label for="">{{ __('Layer Level') }}</label>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <select id="layerlevel" name="layerlevel" class="e1 form-control form-control-sm ml-2" required>
                        @foreach ($koc as $c)
                        @if ($c->id == @$cedingsource)
                        <option value="{{ $c->id }}" selected>{{ $c->description }}
                            @else
                        <option value="{{ $c->id }}">{{ $c->description }}</option>
                        @endif
                        @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-2">
                <label for="">{{ __('GROUP COB') }}</label>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                    <input type="text" id="groupcobidlayer" name="groupcobidlayer" class="form-control form-control-sm" readonly required> &nbsp;&nbsp; 
                    </div>
                </div>
                <div class="col-md-2">
                </div>
            </div>



        <div class="row">
            <div class="col-md-4">
            </div>
            
            <div class="col-md-1">
                <label for="">{{ __('Adj Prem Rate') }}</label>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                <input type="text"  id="premratelayer" name="premratelayer"  class="form-control form-control-sm" required>
                </div>
            </div>

            <div class="col-md-1">
                <label for="">{{ __('Installment') }}</label>
            </div>
        
            <div class="col-md-1">
                <div class="form-group">
                <input type="text" id="instlayer" name="instlayer"  class="form-control form-control-sm money text-left" required>
                </div>
            </div>

            <div class="col-md-1">
                <label for="">{{ __('Status') }}</label>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                <select id="statuslayer" name="statuslayer" class="e1 form-control form-control-sm ml-2" required>
                    <option value="Pre Summary">{{ __('Pre Summary') }}</option>
                    <option value="Production">{{ __('Production') }}</option>
                    <option value="Cancel">{{ __('Cancel') }}</option>
                    <option value="Correction">{{ __('Correction') }}</option>
                    <option value="Dummy">{{ __('Dummy') }}</option>
                </select>
                </div>
            </div>
        </div>


        <div class="row">
             <div class="col-md-1">
                <label for="">{{ __('Limit (100%)') }}</label>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                <input type="text" id="limitlayer" name="limitlayer"  class="form-control form-control-sm money text-left" required>
                </div>
            </div>

            <div class="col-md-1">
                <label for="">{{ __('U/W Retention') }}</label>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                <input type="text"  id="uwlayer" name="uwlayer" class="form-control form-control-sm" required>
                </div>
            </div>

            <div class="col-md-1">
                <label for="">{{ __('Transfer Date') }}</label>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                <input type="text" id="transferdatelayer" name="transferdatelayer" value="{{ date('d/m/Y') }}" class="form-control form-control-sm datepicker" readonly>
                </div>
            </div>          
        </div>


        <div class="row">
            <div class="col-md-1">
                <label for="">{{ __('Mindep (100%)') }}</label>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                <input type="text" id="mindeplayer" name="mindeplayer" class="form-control form-control-sm money text-left" required>
                </div>
            </div>

            <div class="col-md-1">
                <label for="">{{ __('Premium Type') }}</label>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                <select id="premiumtypelayer" name="premiumtypelayer"  class="e1 form-control form-control-sm ml-2" required>
                    <option selected disabled>{{ __('Layer Premium Type') }}</option>
                    <option value="Minimum Deposit">{{ __('Minimum Deposit') }}</option>
                    <option value="Minimum Premium">{{ __('Minimum Premium') }}</option>
                    <option value="Deposit Premium">{{ __('Deposit Premium') }}</option>
                </select>
                
                </div>
            </div>

            <div class="col-md-1">
                <label for="">{{ __('Brokerage') }}</label>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                <input type="text" id="brokeragelayer" name="brokeragelayer" class="form-control form-control-sm" readonly>
                </div>
            </div>      

        </div>

        <div class="row">

            <div class="col-md-1">
                <label for="">{{ __('Nasre Share') }}</label>
            </div>
            <div class="input-group col-md-3">
                <input type="text" id="nasresharelayer" name="nasresharelayer" class="form-control form-control-sm amount" required>
                <div class="input-group-append">
                     <span class="input-group-text">%</span>
                </div>
            </div>

            
            <div class="modal fade" id="addreinstmodal" tabindex="-1" user="dialog" aria-labelledby="addreinstmodalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl" user="document">
                            <div class="modal-content bg-light-gray">
                                <div class="modal-header bg-gray">
                                    <h5 class="modal-title" id="addreinstmodalLabel">{{__('Reinstatement Rate')}}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                            </div>
                    </div>
                </div>
            </div>
            {{-- Location Modal Ends --}}
        
            <div class="col-md-1">
                <label for="">{{ __('AA Limit') }}</label>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                <input type="text" id="aadlimitlayer" name="aadlimitlayer"  class="form-control form-control-sm money text-left" required>
                </div>
            </div>

            <div class="col-md-4">
                   
            </div>
        </div>


        <div class="row">
            <div class="col-md-1">
                <label for="">{{ __('MD Premium') }}</label>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                <input type="text" id="mdpremiumlayer" name="mdpremiumlayer"  class="form-control form-control-sm money text-left" required>
                </div>
            </div>

            <div class="col-md-1">
                <label for="">{{ __('Liability') }}</label>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                <input type="text" id="liabilitylayer" name="liabilitylayer"  class="form-control form-control-sm money text-left" required>
                </div>
            </div>

            <div class="col-md-4">
            </div>
        </div>


        <div class="row">
           
            <div class="col-md-4">
                 
            </div>

            <div class="col-md-1">
                <label for="">{{ __('AA Deductible') }}</label>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                <input type="text" id="aadeductiblelayer" name="aadeductiblelayer" class="form-control form-control-sm money text-left" required>
                </div>
            </div>

            <div class="col-md-4">
            </div>
        </div>

      
        <div class="row mb-2">
            <div class="col-md-8">
              <div class="card">
                <div class="card-body">

                        <div class="form-group">
                         Reinstatement
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
                                    <button class="btn btn-primary btn-block" onclick="storereinstatementsubmit()">{{__('Add Reinstatement')}}</button>
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

                </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                        <div class="row">
                        <div class="col-md-4">
                            <button class="btn btn-primary btn-block" onclick="storelayersubmit()">Add Layer</button>
                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-primary btn-block" onclick="prevgroucoblayer()">{{__('Prev (Group Cob)')}}</button>
                        </div>
                        </div>
                </div>
            </div>
        </div>



               
        <div class="row mb-2">
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                   Layer Data
                   <hr>
                  <table id="layerPanel" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Layer Level</th>
                        <th>Limit (100%)</th>
                        <th>Reinstatement</th>
                        <th>Nasre Share</th>
                        <th>OGRPI</th>
                        <th>Mindep (100%)</th>
                        <th>Status</th>
                        <th>Action</th>
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
                        <td></td>
                        <td>
                        
                            <!--a class="text-primary mr-3 float-right" target="_blank"  href="{{url('/treaty/nonprop/detailmindep')}}">
                                <button type="button" class="btn btn-sm btn-primary float-right">{{__('Add Installment')}}</button>
                            </a>

                            <a class="text-primary mr-3 float-right" target="_blank"  href="{{url('/treaty/nonprop/detailcobmindep')}}">
                                <button type="button" class="btn btn-sm btn-primary float-right">{{__('Add Detail COB')}}</button>
                            </a

                            <button class="btn btn-sm btn-primary mr-4" onclick="showdetailinstallment()">Add Installment</button>
                            <button class="btn btn-sm btn-primary"  onclick="showdetailcob()">Add Detail COB</button>
                            -->

                        </td>
                    </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        <hr>
        </section>
      
    
  </div>
</div>


<div class="modal fade" id="editlayermodal" tabindex="-1" user="dialog" aria-labelledby="editlayermodalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl" user="document">
          <div class="modal-content bg-light-gray">
                      <div class="modal-header bg-gray">
                          <h5 class="modal-title" id="editlayermodalLabel">{{__('Layer')}}</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-body">

                            <div class="row">
                                <div class="col-md-1">
                                    <label for="">{{ __('Layer Level') }}</label>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="hidden"  id="layeridupdate43" name="layeridupdate43"  class="form-control form-control-sm">
                                        <select id="layerlevelupdate" name="layerlevelupdate" class="e1 form-control form-control-sm ml-2" required>
                                        @foreach ($koc as $c)
                                        @if ($c->id == @$cedingsource)
                                        <option value="{{ $c->id }}" selected>{{ $c->description }}
                                            @else
                                        <option value="{{ $c->id }}">{{ $c->description }}</option>
                                        @endif
                                        @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                <label for="">{{ __('GROUP COB') }}</label>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                    <input type="text" id="groupcobidlayerupdate" name="groupcobidlayerupdate" class="form-control form-control-sm" readonly required> &nbsp;&nbsp; 
                                    </div>
                                </div>
                                <div class="col-md-2">
                                </div>
                            </div>



                        <div class="row">
                            <div class="col-md-4">
                            </div>
                            
                            <div class="col-md-1">
                                <label for="">{{ __('Adj Prem Rate') }}</label>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                <input type="text"  id="premratelayerupdate" name="premratelayerupdate"  class="form-control form-control-sm" required>
                                </div>
                            </div>

                            <div class="col-md-1">
                                <label for="">{{ __('Installment') }}</label>
                            </div>
                        
                            <div class="col-md-1">
                                <div class="form-group">
                                <input type="text" id="instlayerupdate" name="instlayerupdate"  class="form-control form-control-sm money text-left" required>
                                </div>
                            </div>

                            <div class="col-md-1">
                                <label for="">{{ __('Status') }}</label>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                <select id="statuslayerupdate" name="statuslayerupdate" class="e1 form-control form-control-sm ml-2" required>
                                    <option value="Pre Summary">{{ __('Pre Summary') }}</option>
                                    <option value="Production">{{ __('Production') }}</option>
                                    <option value="Cancel">{{ __('Cancel') }}</option>
                                    <option value="Correction">{{ __('Correction') }}</option>
                                    <option value="Dummy">{{ __('Dummy') }}</option>
                                </select>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-1">
                                <label for="">{{ __('U/W Retention') }}</label>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                <input type="text"  id="uwlayerupdate" name="uwlayerupdate" class="form-control form-control-sm" required>
                                </div>
                            </div>

                            <div class="col-md-1">
                                <label for="">{{ __('Mindep (100%)') }}</label>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                <input type="text" id="mindeplayerupdate" name="mindeplayerupdate" class="form-control form-control-sm  money text-left" required>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <label for="">{{ __('Transfer Date') }}</label>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                <input type="text" id="transferdatelayerupdate" name="transferdatelayerupdate"  value="{{ date('d/m/Y') }}"  class="form-control form-control-sm" readonly>
                                </div>
                            </div>            
                        </div>


                        <div class="row">
                            <div class="col-md-1">
                                <label for="">{{ __('Limit (100%)') }}</label>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                <input type="text" id="limitlayerupdate" name="limitlayerupdate"  class="form-control form-control-sm money text-left" required>
                                </div>
                            </div>

                            <div class="col-md-1">
                                <label for="">{{ __('Premium Type') }}</label>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                <select id="premiumtypelayerupdate" name="premiumtypelayerupdate"  class="e1 form-control form-control-sm ml-2" required>
                                    <option selected disabled>{{ __('Layer Premium Type') }}</option>
                                    <option value="Minimum Deposit">{{ __('Minimum Deposit') }}</option>
                                    <option value="Minimum Premium">{{ __('Minimum Premium') }}</option>
                                    <option value="Deposit Premium">{{ __('Deposit Premium') }}</option>
                                </select>
                                
                                </div>
                            </div>

                            
                            <div class="col-md-1">
                                <label for="">{{ __('Brokerage') }}</label>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                <input type="text" id="brokeragelayerupdate" name="brokeragelayerupdate" class="form-control form-control-sm" readonly>
                                </div>
                            </div>
                            
                        </div>

                        <div class="row">
                            <div class="col-md-1">
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                        
                                </div>
                            </div>
                        
                            <div class="col-md-1">
                                <label for="">{{ __('AA Limit') }}</label>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                <input type="text" id="aadlimitlayerupdate" name="aadlimitlayerupdate"  class="form-control form-control-sm money text-left" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <button class="btn btn-primary btn-block" onclick="updatelayersubmit()">Edit Layer</button>
                                            </div>
                                            <div class="col-md-4">
                                               
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-1">
                                <label for="">{{ __('Nasre Share') }}</label>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                <input type="text" id="nasresharelayerupdate" name="nasresharelayerupdate" class="form-control form-control-sm money text-left" required>
                                </div>
                            </div>

                            <div class="col-md-1">
                                <label for="">{{ __('Liability') }}</label>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                <input type="text" id="liabilitylayerupdate" name="liabilitylayerupdate"  class="form-control form-control-sm money text-left" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-1">
                                <label for="">{{ __('MD Premium') }}</label>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                <input type="text" id="mdpremiumlayerupdate" name="mdpremiumlayerupdate"  class="form-control form-control-sm money text-left" required>
                                </div>
                            </div>

                            <div class="col-md-1">
                                <label for="">{{ __('AA Deductible') }}</label>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                <input type="text" id="aadeductiblelayerupdate" name="aadeductiblelayerupdate" class="form-control form-control-sm money text-left" required>
                                </div>
                            </div>

                            <div class="col-md-4">
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
@include('crm.transaction.treaty.nonprop.v2.template.detailcob')
</section>

<section>
@include('crm.transaction.treaty.nonprop.v2.template.detailinstallment')
</section>


<section>
@include('crm.transaction.treaty.nonprop.v2.template.detailadjustment')
</section>

