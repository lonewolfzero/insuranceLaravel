<div class="modal fade" id="incoming_panel_modal" tabindex="-1" user="dialog" aria-labelledby="addlocationLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-xl" user="document">
    <div class="modal-content bg-light-gray">
      <div class="modal-header bg-gray">
        <h5 class="modal-title" id="addlocationLabel">{{ __('Incoming Panel') }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form onsubmit="create_installment(this); return false" id="form_installment">

          <input type="hidden" name="layer_id" class="layer_id">

          <div class="row mb-2">
            <div class="col-md-1 align-self-center">Period</div>
            <div class="col-md-2">
              <input type="text" class="disabled_period_from form-control datemask datepicker">
            </div>
            <div class="col-md-1 align-self-center text-center">To</div>
            <div class="col-md-2">
              <input type="text" class="disabled_period_to form-control datemask datepicker">
            </div>
            <div class="col-md-2 align-self-center"><input type="checkbox" name="" id="" class="mr-2">With Claim</div>
            <div class="col-md-2 align-self-center text-center"><button class="btn btn-primary">Search</button></div>
          </div>

        </form>

        <div class="card">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>Doc Number</th>
                    <th>Counter</th>
                    <th>COB</th>
                    <th>Retro Share</th>
                    <th>Gross Premium</th>
                    <th>Claim Paid</th>
                    <th><input type="checkbox" name="" id="" class="mr-2">Select All</th>
                  </tr>
                </thead>
                <tbody id="tbody_member_panel">
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                      <div class="text-center">
                        <input type="checkbox" name="" id="">

                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <div class="row justify-content-center">
          <div class="col-md-2 align-self-center text-center"><button class="btn btn-primary">Submit</button></div>
        </div>

      </div>

    </div>

  </div>
</div>