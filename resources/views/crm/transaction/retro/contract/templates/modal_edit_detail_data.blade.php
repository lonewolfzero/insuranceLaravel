<div class="modal fade" id="edit_detail_data_modal" tabindex="-1" user="dialog" aria-labelledby="addlocationLabel"
  aria-hidden="true">
  <div class="modal-dialog" user="document">
    <div class="modal-content bg-light-gray">
      <div class="modal-header bg-gray">
        <h5 class="modal-title" id="addlocationLabel">{{ __('Edit Detail Data') }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form onsubmit="create_installment(this); return false" id="form_installment">

          <div class="row mb-3">
            <div class="col-md-4 align-self-center">Doc Number</div>
            <div class="col-md-8 align-self-center">
              <input type="text" class="form-control-plaintext" name="document_date" id="document_date"
                autocomplete="off" readonly>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-4 align-self-center">Endorsement Number</div>
            <div class="col-md-8 align-self-center">
              <input type="text" class="form-control-plaintext" name="document_date" id="document_date"
                autocomplete="off" readonly>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-4 align-self-center">COB</div>
            <div class="col-md-8 align-self-center">
              <input type="text" class="form-control-plaintext" name="document_date" id="document_date"
                autocomplete="off" readonly>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-4 align-self-center">Gross Premium</div>
            <div class="col-md-8 align-self-center">
              <input type="text" class="form-control money text-left" name="document_date" id="document_date"
                autocomplete="off">
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-4 align-self-center">Claim Paid</div>
            <div class="col-md-8 align-self-center">
              <input type="text" class="form-control money text-left" name="document_date" id="document_date"
                autocomplete="off">
            </div>
          </div>

          <div class="row justify-content-center">
            <div class="col-md-2 align-self-center text-center"><button class="btn btn-primary">Submit</button></div>
          </div>

        </form>

      </div>

    </div>

  </div>
</div>