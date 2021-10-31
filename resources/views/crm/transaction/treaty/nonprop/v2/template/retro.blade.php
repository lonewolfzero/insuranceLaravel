<div class="card" id="group_retro_card" style="display: none;">
  <div class="card-header bg-gray">Retro</div>
  <div class="card-body bg-light-gray">

        <section class="my-4">
            <div class="row mb-2">
                <div class="col-md-10"></div>
                <div class="col-md-2">
                  <button class="btn btn-primary btn-block" onclick="prevgroupcobretro()">Prev (Group Cob)</button>
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
          <div class="col-md-2"><input type="text" id="masterid512" name="masterid512" class="form-control form-control-sm"
              readonly></div>
          <div class="col"></div>
          <div class="col-md-2">Date Entry</div>
          <div class="col-md-2"><input type="text" id="masterdateentry512" name="masterdateentr512"
              class="form-control form-control-sm" readonly></div>
          </div>

        <div class="row mb-2">
          <div class="col-md-2">Ceding/Broker</div>
          <div class="col-md-3"><input type="text" id="masterceding512" name="masterceding512"
              class="form-control form-control-sm" readonly></div>
          <div class="col"></div>
          <div class="col-md-2">User</div>
          <div class="col-md-2"><input type="text" id="masteruser512" name="masteruser512"
              class="form-control form-control-sm" readonly></div>
        </div>

        <div class="row mb-2">
          <div class="col-md-2">U/W Year</div>
          <div class="col-md-2"><input type="text" id="masteruwyear512" name="masteruwyear512"
              class="form-control form-control-sm" readonly></div>
          <div class="col-md-1">Ceding Type</div>
          <div class="col-md-2"><input type="text" id="mastercedingtype512" name="mastercedingtype512"
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
      <div class="col-md-2"><input type="text" id="submasterid512" name="submasterid512"
          class="form-control form-control-sm" readonly></div>
      </div>

      <div class="row mb-2">
      <div class="col-md-2">Ceding Company</div>
      <div class="col-md-3"><input type="text" id="submasterceding512" name="submasterceding512"
          class="form-control form-control-sm" readonly></div>
      </div>

      <div class="row mb-2">
        <div class="col-md-2">Period</div>
        <div class="col-md-2">
          <input type="text" id="submasterperiod512" name="submasterperiod512" class="form-control form-control-sm" readonly>
        </div>
        <div class="col-md-2">
          <input type="text" id="submasterperiod5122" name="submasterperiod5122" class="form-control form-control-sm" readonly>
        </div>
      </div>

      <div class="row mb-2">
      <div class="col-md-2">Type</div>
      <div class="col-md-2"><input type="text" id="submastertype512" name="submastertype512"
          class="form-control form-control-sm" readonly></div>
      </div>
      
      <div class="col-md-2">
            <h3>Group COB</h3>
      </div>
      <hr>

        <div class="row mb-2">
        <div class="col-md-2">{{ __('ID') }}</div>
        <div class="col-md-4 form-group d-flex">
        <input type="text" name="idgroupcob512" id="idgroupcob512" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
        </div>
        </div>

        <div class="row mb-2">
        <div class="col-md-2">{{ __('Grop COB') }}</div>
        <div class="col-md-4 form-group d-flex">
        <input type="text" name="groucob512" id="groucob512" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
        </div>
        </div>

        <div class="row mb-2">
        <div class="col-md-2">{{ __('OGRPI') }}</div>
        <div class="col-md-4 form-group d-flex">
        <input type="text" name="groupcoborgpi512" id="groupcoborgpi512" class="form-control form-control-sm ml-2 money text-left" autocomplete="off" readonly>
        </div>
        </div>

        <div class="row mb-2">
        <div class="col-md-2">{{ __('Type Of Treaty') }}</div>
        <div class="col-md-4 form-group d-flex">
            <input type="text" name="groupcobtype512" id="groupcobtype512" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
        </div>
        </div>

          <div class="row mb-2">
          <div class="col-md-2">{{ __('Brokerage %') }}</div>
          <div class="col-md-4 form-group d-flex">
              <input type="text" name="groupcobbrokerage512" id="groupcobbrokerage512" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
          </div>
          </div>

          <div class="row mb-2">
          <div class="col-md-2">{{ __('VAT %') }}</div>
          <div class="col-md-4 form-group d-flex">
              <input type="text" name="groupcobbrokeragepersen512" id="groupcobbrokeragepersen512" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
        </div>
        </div>


        <hr>

        <div class="row">
            <div class="col-md-2">
                <label for="">{{ __('Retro  Contract ') }}</label>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <select  id="retrocontract" name="retrocontract" class="form-control form-control-sm">
                    <option> Retro Contract LIST</option>
                    <option> Retro Contract LIST</option>
                    </select>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-2">
                          <button class="btn btn-primary btn-block" onclick="storeretrosubmit()">Add Retro</button>
                        </div>
                        <div class="col-md-4">
                          <button class="btn btn-primary btn-block" onclick="prevgroupcobretro()">Prev (Group Cob)</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">   
            <div class="col-md-2">
            <label for="">{{ __('Retro %') }}</label>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                <input type="text" id="retropercent" name="retropercent" class="form-control form-control-sm"> &nbsp;&nbsp; 
                </div>
            </div>
            <div class="col-md-2">
            <label for="">{{ __('GROUP COB') }}</label>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                <input type="text" id="groupcobid4" name="groupcobid4" class="form-control form-control-sm" readonly> &nbsp;&nbsp; 
                </div>
            </div>
        </div>
        

        <div class="row mb-2">
            <div class="col-md-10">
              <div class="card">
                <div class="card-body">
                  <table id="retrocobPanel" class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>Retro Contract</th>
                        <th>Retro %</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <!--tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                          <button class="btn btn-sm btn-primary mr-4" onclick="showgrouplayer()">Add Layer</button>
                          <button class="btn btn-sm btn-primary"  onclick="showgroupretro()">Add Retro</button>
                        </td>
                      </tr-->
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-6 form-group d-flex">
            </div>
            <label for="" class="col-1">{{ __('Total OGRPI %') }}</label>
            <div class="col-md-5 form-group d-flex">
                <input type="text" name="periodfrom" id="periodfrom" class="form-control form-control-sm ml-2 money text-left" autocomplete="off">
            </div>
        </div>
            
            
        </div>
        <hr>

  </div>
</div>


  <div class="modal fade" id="editretromodal" tabindex="-1" user="dialog" aria-labelledby="editretromodalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl" user="document">
          <div class="modal-content bg-light-gray">
                      <div class="modal-header bg-gray">
                          <h5 class="modal-title" id="editretromodalLabel">{{__('Edit Retro Contract')}}</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      
                      <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-body">

                            <div class="row">
                              <div class="col-md-2">
                                  <label for="">{{ __('Retro  Contract ') }}</label>
                              </div>

                              <div class="col-md-4">
                                  <div class="form-group">
                                      <input type="hidden"  id="retroidupdate43" name="retroidupdate43"  class="form-control form-control-sm">
                                      <select  id="retrocontractupdate" name="retrocontractupdate" class="form-control form-control-sm">
                                      <option> Retro Contract LIST</option>
                                      <option> Retro Contract LIST</option>
                                      </select>
                                  </div>
                              </div>

                              <div class="col-md-6">
                                  <div class="form-group">
                                      <div class="row">
                                          <div class="col-md-2">
                                            <button class="btn btn-primary btn-block" onclick="updateretrosubmit()">Edit Retro</button>
                                          </div>
                                          <div class="col-md-4">
                                           
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>

                          <div class="row">   
                              <div class="col-md-2">
                              <label for="">{{ __('Retro %') }}</label>
                              </div>
                              <div class="col-md-4">
                                  <div class="form-group">
                                  <input type="text" id="retropercentupdate" name="retropercentupdate" class="form-control form-control-sm"> &nbsp;&nbsp; 
                                  </div>
                              </div>
                              <div class="col-md-2">
                              <label for="">{{ __('GROUP COB') }}</label>
                              </div>
                              <div class="col-md-4">
                                  <div class="form-group">
                                  <input type="text" id="groupcobidupdate4" name="groupcobidupdate4" class="form-control form-control-sm" readonly> &nbsp;&nbsp; 
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
