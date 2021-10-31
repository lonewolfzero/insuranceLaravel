<div class="modal fade" id="installment_modal" tabindex="-1" user="dialog" aria-labelledby="addlocationLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" user="document">
    <div class="modal-content bg-light-gray">
      <div class="modal-header bg-gray">
        <h5 class="modal-title" id="addlocationLabel">{{ __('Installment') }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">

        @include('crm.transaction.retro.mindep.templates.disabled_layer')

        <hr>

        <form onsubmit="create_installment(this); return false" id="form_installment">

          <input type="hidden" name="layer_id" class="layer_id">

          <div class="row mb-2">
            <div class="col-md-2 align-self-center">Date</div>
            <div class="col-md-4">
              <input type="text" name="date" id="date" class="form-control datemask datepicker">
            </div>
          </div>

          <div class="row mb-2">
            <div class="col-md-2 align-self-center">Percentage</div>
            <div class="col-md-4">
              <input type="text" name="percentage" id="percentage" class="form-control money text-left">
            </div>
          </div>

          <div class="row my-5 justify-content-center">
            <div class="col-md-2 align-self-center text-center"><button class="btn btn-primary">Add</button></div>
          </div>

        </form>

        <div class="card">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>Date</th>
                    <th>Percentage</th>
                  </tr>
                </thead>
                <tbody id="tbody_installment">
                </tbody>
              </table>
            </div>
          </div>
        </div>

      </div>

    </div>
  </div>
</div>