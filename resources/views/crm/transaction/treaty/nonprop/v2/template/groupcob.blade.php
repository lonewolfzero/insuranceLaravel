<div class="card" style="display: none" id="group_cob_card">
  <div class="card-body bg-light-gray">

    <div class="card-header bg-gray">Group Cob </div>

    <section class="my-4">
      <div class="row mb-2">
        <div class="col-md-10"></div>
        <div class="col-md-2">
          <button class="btn btn-primary" onclick="prevsubmastercontract()">Prev (Sub Master Contract)</button>
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
        <div class="col-md-2"><input type="text" id="masterid3" name="masterid3" class="form-control form-control-sm"
            readonly></div>
        <div class="col"></div>
        <div class="col-md-2">Date Entry</div>
        <div class="col-md-2"><input type="text" id="masterdateentry3" name="masterdateentry3"
            class="form-control form-control-sm" readonly></div>
      </div>

      <div class="row mb-2">
        <div class="col-md-2">Ceding/Broker</div>
        <div class="col-md-3"><input type="text" id="masterceding3" name="masterceding3"
            class="form-control form-control-sm" readonly></div>
        <div class="col"></div>
        <div class="col-md-2">User</div>
        <div class="col-md-2"><input type="text" id="masteruser3" name="masteruser3"
            class="form-control form-control-sm" readonly></div>
      </div>

      <div class="row mb-2">
        <div class="col-md-2">U/W Year</div>
        <div class="col-md-2"><input type="text" id="masteruwyear3" name="masteruwyear3"
            class="form-control form-control-sm" readonly></div>
        <div class="col-md-1">Ceding Type</div>
        <div class="col-md-2"><input type="text" id="mastercedingtype3" name="mastercedingtype3"
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
        <div class="col-md-2"><input type="text" id="submasterid3" name="submasterid3"
            class="form-control form-control-sm" readonly></div>
      </div>

      <div class="row mb-2">
        <div class="col-md-2">Ceding Company</div>
        <div class="col-md-3"><input type="text" id="submasterceding3" name="submasterceding3"
            class="form-control form-control-sm" readonly></div>
      </div>

      <div class="row mb-2">
        <div class="col-md-2">Period</div>
        <div class="col-md-2"><input type="text" id="submasterperiod3" name="submasterperiod3"class="form-control form-control-sm" readonly></div>
        <div class="col-md-2"><input type="text" id="submasterperiod32" name="submasterperiod32"class="form-control form-control-sm" readonly></div>
      </div>

      <div class="row mb-2">
        <div class="col-md-2">Type</div>
        <div class="col-md-2"><input type="text" id="submastertype3" name="submastertype3"
            class="form-control form-control-sm" readonly></div>
      </div>

      <hr>

      <div class="card">
        <div class="card-header bg-gray">Group COB</div>
        <div class="card-body bg-light-gray">

          <div class="row mb-2">
            <div class="col-md-2">ID</div>
            <div class="col-md-2">
              <input type="text" id="groupcobid" name="groupcobid" class="form-control form-control-sm" readonly>
            </div>
          </div>

          <div class="row mb-2">
            <div class="col-md-2">Group COB</div>
            <div class="col-md-3">
              <select id="groupcobselect" name="groupcobselect" class="e1 form-control form-control-sm" >
                @foreach ($cob as $c)
                <option value="{{ $c->id }}">{{ $c->description }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-3"></div>
            <div class="col-md-1">OGRPI</div>
            <div class="col-md-2"><input type="text" id="groupcobogrpi" name="groupcobogrpi" class="form-control form-control-sm money text-left"></div>
          </div>

          <div class="row mb-2">
            <div class="col-md-2">Type Of Treaty</div>
            <div class="col-md-3"><input type="text" id="groupcobtype" name="groupcobtype"
                class="form-control form-control-sm"></div>
          </div>

          <div class="row mb-2">
            <div class="col-md-2">Brokerage %</div>
            <div class="col-md-3">
              <input type="text" id="groupcobbrokerage" name="groupcobbrokerage" class="form-control form-control-sm text-left">
            </div>
          </div>

          <div class="row mb-2">
            <div class="col-md-2">VAT %</div>
            <div class="col-md-3">
              <input type="text" id="groupcobbrokeragepersen" name="groupcobbrokeragepersen" class="form-control form-control-sm text-left">
            </div>
          </div>

          <div class="row mb-2">
            <div class="col"></div>
            <div class="col-md-2">
               <button class="btn btn-primary" onclick="storegroupcobsubmit()">Add Group COB</button>
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary" onclick="prevsubmastercontract()">Prev (Sub Master Contract)</button>
            </div>
          </div>

          <div class="row mb-2">
            <div class="col-md-10">
              <div class="card">
                <div class="card-body">
                  <table id="groupcobPanel" class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <td>ID</td>
                        <td>Group COB</td>
                        <td>Type Of Treaty</td>
                        <td>OGRPI</td>
                        <td>Brokerage %</td>
                        <td>VAT %</td>
                        <td>Action</td>
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
        </div>
      </div>

    </section>

  </div>
</div>

    <div class="modal fade" id="editgroupcobmodal" tabindex="-1" user="dialog" aria-labelledby="editgroupcobmodalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl" user="document">
          <div class="modal-content bg-light-gray">
                      <div class="modal-header bg-gray">
                          <h5 class="modal-title" id="editgroupcobmodalLabel">{{__('Edit Group COB')}}</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-body">

                            <div class="row mb-2">
                                <div class="col-md-2">ID</div>
                                <div class="col-md-2">
                                  <input type="text" id="groupcobidupdate" name="groupcobidupdate" class="form-control form-control-sm" readonly>
                                </div>
                              </div>

                              <div class="row mb-2">
                                <div class="col-md-2">Group COB</div>
                                <div class="col-md-3">
                                  <select id="groupcobselectupdate" name="groupcobselectupdate" class="e1 form-control form-control-sm" >
                                    @foreach ($cob as $c)
                                    <option value="{{ $c->id }}">{{ $c->description }}</option>
                                    @endforeach
                                  </select>
                                </div>
                                <div class="col-md-3"></div>
                                <div class="col-md-1">OGRPI</div>
                                <div class="col-md-2"><input type="text" id="groupcobogrpiupdate" name="groupcobogrpiupdate" class="form-control form-control-sm money text-left"></div>
                              </div>

                              <div class="row mb-2">
                                <div class="col-md-2">Type Of Treaty</div>
                                <div class="col-md-3"><input type="text" id="groupcobtypeupdate" name="groupcobtypeupdate"
                                    class="form-control form-control-sm"></div>
                              </div>

                              <div class="row mb-2">
                                <div class="col-md-2">Brokerage %</div>
                                <div class="col-md-3"><input type="text" id="groupcobbrokerageupdate" name="groupcobbrokerageupdate" class="form-control form-control-sm text-left"></div>
                              </div>

                              <div class="row mb-2">
                                <div class="col-md-2">VAT %</div>
                                <div class="col-md-3"><input type="text" id="groupcobbrokeragepersenupdate" name="groupcobbrokeragepersenupdate" class="form-control form-control-sm text-left"></div>
                              </div>

                              <div class="row mb-2">
                                <div class="col"></div>
                                <div class="col-md-2">
                                  <button class="btn btn-primary" onclick="updategroupcobsubmit()">Edit Group COB</button>
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

<section>
  @include('crm.transaction.treaty.nonprop.v2.template.layer')
</section>

<section>
  @include('crm.transaction.treaty.nonprop.v2.template.retro')
</section>
