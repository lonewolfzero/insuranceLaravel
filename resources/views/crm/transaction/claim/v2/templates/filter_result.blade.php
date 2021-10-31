<div class="card" id="claiminsured" style="display:none">
  <div class="card-header bg-gray btn text-left" data-toggle="collapse" data-target="#collapseInsuredSection"
    aria-expanded="false" aria-controls="collapseInsuredSection">
    <div class="row">
      <div class="col-md-1">
        Location
      </div>
    </div>
  </div>

  <div class="card-body collapse show" id="collapseInsuredSection">
    <div class="row">
      <div class="col">
        <input type="hidden" id="loc_code_hidden" val="">
        <input type="hidden" id="slip_index" val="">
        <table id="tablelocations" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th colspan="2">Address</th>
            </tr>
          </thead>
          <tbody id="mainbodylocations">
          </tbody>
        </table>
      </div>
    </div>

    <div class="row">
      <div class="col">
        <table id="tableslips" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Doc Number</th>
              <th>Ceding/Broker</th>
              <th>Ceding Source</th>
              <th>Reinsured Period</th>
              <th>Status</th>
              <th>Transfer Date</th>
              <th>Username</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody id="mainbodyslips">
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>