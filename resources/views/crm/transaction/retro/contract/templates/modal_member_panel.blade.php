<div class="modal fade" id="member_panel_modal" tabindex="-1" user="dialog" aria-labelledby="addlocationLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" user="document">
    <div class="modal-content bg-light-gray">
      <div class="modal-header bg-gray">
        <h5 class="modal-title" id="addlocationLabel">{{ __('Member Panel') }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form onsubmit="create_member(this); return false" id="form_member_panel">

          <input type="hidden" name="retrocession_id" class="retrocession_id">

          <div class="row mb-3">
            <div class="col-md-2 align-self-center">Member</div>
            <div class="col-md-6 align-self-center">
              <x-select-option all="member" :master="$ceding" text="Select Member" col1="code" col2="name"
                :isrequired="true" />
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-2 align-self-center">Share</div>
            <div class="col-md-3 align-self-center">
              <div class="input-group">
                <x-input-money-format name="share" :isrequired="true" />
                <div class="input-group-append">
                  <span class="input-group-text">%</span>
                </div>
              </div>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-2 align-self-center">Rating</div>
            <div class="col-md-6 align-self-center">
              <select class="e1 form-control" name="rating" id="rating" required>
                <option value="" disabled selected>Select Rating</option>
                <option value="A+">A+</option>
                <option value="A">A</option>
                <option value="A-">A-</option>
              </select>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-2 align-self-center">Rater</div>
            <div class="col-md-3 align-self-center">
              <input type="text" class="form-control" name="rater" id="rater" autocomplete="off" required>
            </div>
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
                  <th>Member</th>
                  <th>Share</th>
                  <th>Rating</th>
                  <th>Rater</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id="tbody_member_panel">
              </tbody>
            </table>
          </div>
        </div>
      </div>

    </div>

  </div>
</div>