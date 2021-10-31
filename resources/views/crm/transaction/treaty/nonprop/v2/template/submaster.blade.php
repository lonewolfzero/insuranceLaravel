<div class="card" id="sub_master_card" style="display: none;">
  <div class="card-header bg-gray">Sub Master Contract</div>

   <div class="card-body bg-light-gray">
     
    <div class="col-md-2">
      <h3>Master Contract</h3>
    </div>
    <hr>

    <section class="my-4">
      <div class="row mb-2">
        <div class="col-md-2">ID</div>
        <div class="col-md-2"><input type="text" id="masterid2" name="masterid2" class="form-control form-control-sm  text-left" readonly></div>
        <div class="col"></div>
        <div class="col-md-2">Date Entry</div>
        <div class="col-md-2"><input type="text" id="masterdateentry2" name="masterdateentry2" class="form-control form-control-sm" readonly></div>
      </div>

      <div class="row mb-2">
        <div class="col-md-2">Ceding/Broker</div>
        <div class="col-md-3"><input type="text" id="masterceding2" name="masterceding2"
            class="form-control form-control-sm" readonly></div>
        <div class="col"></div>
        <div class="col-md-2">User</div>
        <div class="col-md-2"><input type="text" id="masteruser2" name="masteruser2" class="form-control form-control-sm" readonly></div>
      </div>

      <div class="row mb-2">
        <div class="col-md-2">U/W Year</div>
        <div class="col-md-2"><input type="text" id="masteruwyear2" name="masteruwyear2" class="form-control form-control-sm" readonly></div>
        <div class="col-md-1">Ceding Type</div>
        <div class="col-md-2"><input type="text" id="mastercedingtype2" name="mastercedingtype2"
            class="form-control form-control-sm" readonly></div>
      </div>
    </section>

    <hr>

    <section class="my-4">
      <div class="row mb-2">
        <div class="col-md-2">ID</div>
        <div class="col-md-2">
          <input type="text" id="submasterid" name="submasterid" class="form-control form-control-sm  text-left" readonly></div>
      </div>

      <div class="row mb-2">
        <div class="col-md-2">Ceding Company</div>
        <div class="col-md-3">
          <select id="submasterceding" name="submasterceding" class="e1 form-control form-control-sm">
            @foreach ($ceding as $c)
            <option value="{{ $c->id }}">{{ $c->name }}</option>
            @endforeach
          </select>
        </div>
      </div>

      <div class="row mb-2">
        <div class="col-md-2">Period</div>
        <div class="col-md-2"><input type="text" id="submasterperiod" name="submasterperiod"  value="{{ date('d/m/Y') }}"
            class="form-control form-control-sm datepicker datemask"></div>
        <div class="col-md-1">To</div>
        <div class="col-md-2"><input type="text" id="submasterto" name="submasterto"  value="{{ date('d/m/Y') }}"
            class="form-control form-control-sm datepicker datemask"></div>
      </div>

      <div class="row mb-2">
        <div class="col-md-2"></div>
        <div class="col-md-2">
          <div class="card">
            <div class="card-header bg-gray">Type</div>
            <div class="card-body">
              <input type="radio" name="submastertype" id="radio1" value="local">
              <label for="radio1">Local</label>
              <input type="radio" name="submastertype" id="radio2" value="overseas" class="ml-3">
              <label for="radio2">Overseas</label>
            </div>
          </div>
        </div>
      </div>

      <div class="row mb-2">
        <div class="col"></div>
          <div class="col-md-2">
            <button class="btn btn-primary" onclick="storesubmastersubmit()">Add Sub Master Contract</button>
            
          </div>

          <div class="col-md-2">
            <button class="btn btn-primary" onclick="prevmastercontract()">Prev (Master Contract)</button>
            
          </div>
         
      </div>

      <div class="row mb-2">
        <div class="col-md-10">
          <div class="card">
            <div class="card-body">
              <table id="submasterPanel" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <td>ID</td>
                    <td>Ceding Company</td>
                    <td>Period</td>
                    <td>Type</td>
                    <td>Action</td>
                  </tr>
                </thead>
                <tbody>
                  <!--tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><button class="btn btn-sm btn-primary" onclick="showgroupcob()">Add Group COB</button></td>
                  </tr-->
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>


    <div class="modal fade" id="editsubmastermodal" tabindex="-1" user="dialog" aria-labelledby="editsubmastermodalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl" user="document">
          <div class="modal-content bg-light-gray">
                      <div class="modal-header bg-gray">
                          <h5 class="modal-title" id="editsubmastermodalLabel">{{__('Edit Sub Master Contract')}}</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-body">

                          <section class="my-4">

                            <div class="row mb-2">
                              <div class="col-md-2">ID</div>
                              <div class="col-md-2">
                                <input type="text" id="submasteridupdate" name="submasteridupdate" class="form-control form-control-sm" readonly>
                              </div>
                            </div>


                            <div class="row mb-2">
                              <div class="col-md-2">Ceding Company</div>
                              <div class="col-md-3">
                                <select id="submastercedingupdate" name="submastercedingupdate" class="e1 form-control form-control-sm">
                                  @foreach ($ceding as $c)
                                  <option value="{{ $c->id }}">{{ $c->name }}</option>
                                  @endforeach
                                </select>
                              </div>
                            </div>


                            <div class="row mb-2">
                              <div class="col-md-2">Period</div>
                              <div class="col-md-2"><input type="text" id="submasterperiodupdate" name="submasterperiodupdate"
                                  class="form-control form-control-sm datepicker datemask"></div>
                              <div class="col-md-1">To</div>
                              <div class="col-md-2"><input type="text" id="submastertoupdate" name="submastertoupdate"
                                  class="form-control form-control-sm datepicker datemask"></div>
                            </div>

                            <div class="row mb-2">
                              <div class="col-md-2"></div>
                              <div class="col-md-2">
                                <div class="card">
                                  <div class="card-header bg-gray">Type</div>
                                  <div class="card-body">
                                    <input type="radio" name="submastertypeupdate" id="radio1" value="local">
                                    <label for="radio1">Local</label>
                                    <input type="radio" name="submastertypeupdate" id="radio2" value="overseas" class="ml-3">
                                    <label for="radio2">Overseas</label>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="row mb-2">
                              <div class="col"></div>
                                <div class="col-md-2">
                                  <button class="btn btn-primary" onclick="editsubmastersubmit()">Edit Sub Master Contract</button>
                                </div>

                                <div class="col-md-2">
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
   

  </div> 
</div>

@include('crm.transaction.treaty.nonprop.v2.template.groupcob')


