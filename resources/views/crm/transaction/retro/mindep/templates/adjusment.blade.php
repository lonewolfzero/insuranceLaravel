<div class="row justify-content-center" style="display: none" id="adjusment">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header bg-gray">Adjusment</div>
      <div class="card-body bg-light-gray">

        @include('crm.transaction.retro.mindep.templates.disabled_maincontract')

        <hr>

        @include('crm.transaction.retro.mindep.templates.disabled_layer', ['ver'=>true])

        <hr>

        <div class="row justify-content-center">
          <div class="col-md-8">
            <div class="card">

              <div class="card-header bg-gray">
                Adjusment
              </div>

              <div class="card-body bg-light-gray">

                <form onsubmit="create_adjusment(this); return false" id="form_adjusment">

                  <input type="hidden" name="layer_id" class="layer_id">

                  <div class="row mb-2">
                    <div class="col-md-4">ID Adjusment</div>
                    <div class="col-md-8">
                      <input type="text" name="id_adjusment" id="id_adjusment" class="form-control" disabled>
                    </div>
                  </div>

                  <div class="row mb-2">
                    <div class="col-md-4">Version</div>
                    <div class="col-md-3">
                      <input type="text" name="version" id="version" class="form-control" value="0" disabled>
                    </div>
                  </div>

                  <div class="row mb-2">
                    <div class="col-md-4">Due Date</div>
                    <div class="col-md-3">
                      <input type="text" name="due_date" id="due_date" class="form-control datemask datepicker"
                        autocomplete="off">
                    </div>
                  </div>

                  <div class="row mb-2">
                    <div class="col-md-4">AGNPI</div>
                    <div class="col-md-3"></div>
                    <div class="col-md-5">
                      <input type="text" name="agnpi" id="agnpi" class="form-control money text-left"
                        autocomplete="off">
                    </div>
                  </div>

                  <div class="row mb-2">
                    <div class="col-md-4">Adj Premium Rate</div>
                    <div class="col-md-3">
                      <input type="text" name="adj_premium_rate_percentage" id="adj_premium_rate_percentage"
                        autocomplete="off" class="form-control money text-left">
                    </div>
                    <div class="col-md-5">
                      <input type="text" name="adj_premium_rate_amount" id="adj_premium_rate_amount"
                        class="form-control money text-left" disabled>
                    </div>
                  </div>

                  <div class="row mb-2">
                    <div class="col-md-4">Additional Premium</div>
                    <div class="col-md-3"></div>
                    <div class="col-md-5">
                      <input type="text" name="additional_premium" id="additional_premium"
                        class="form-control money text-left" disabled>
                    </div>
                  </div>

                  <div class="row mb-2">
                    <div class="col-md-4">Overrider (%)</div>
                    <div class="col-md-3">
                      <input type="text" name="overrider_percentage" id="overrider_percentage" autocomplete="off"
                        class="form-control money text-left">
                    </div>
                    <div class="col-md-5">
                      <input type="text" name="overrider_amount" id="overrider_amount"
                        class="form-control money text-left" disabled>
                    </div>
                  </div>

                  <div class="row mb-2">
                    <div class="col-md-4">No Claim Bonus</div>
                    <div class="col-md-3">
                      <input type="text" name="no_claim_bonus_percentage" id="no_claim_bonus_percentage"
                        autocomplete="off" class="form-control money text-left">
                    </div>
                    <div class="col-md-5">
                      <input type="text" name="no_claim_bonus_amount" id="no_claim_bonus_amount"
                        class="form-control money text-left" disabled>
                    </div>
                  </div>

                  <div class="row mb-2">
                    <div class="col-md-4">Balance Due</div>
                    <div class="col-md-3"></div>
                    <div class="col-md-5">
                      <input type="text" name="balance_due" id="balance_due" class="form-control money text-left"
                        disabled>
                    </div>
                  </div>

                  <div class="row justify-content-center my-4">
                    <div class="col-md-2"><button type="submit" class="btn btn-primary">Submit</button></div>
                  </div>

                </form>

              </div>
            </div>
          </div>
        </div>

        <div class="card">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Version</th>
                    <th>Due Date</th>
                    <th>AGNPI</th>
                    <th>Adj Pr Rate</th>
                    <th>Add Premium</th>
                    <th>Overrider</th>
                    <th>No Claim Bonus</th>
                    <th>Balance Due Date</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody id="tbody_adjusment">

                </tbody>
              </table>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>