<div class="modal fade" id="panel_member_modal" tabindex="-1" user="dialog" aria-labelledby="addlocationLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" user="document">
    <div class="modal-content bg-light-gray">
      <div class="modal-header bg-gray">
        <h5 class="modal-title" id="addlocationLabel">{{ __('Panel Member') }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">

        <form onsubmit="create_panel_member(this); return false" id="form_panel_member">

          <input type="hidden" name="panel_retro_id" class="panel_retro_id">

          <div class="row mb-2">
            <div class="col-md-3 align-self-center">Member Retrocessionaire</div>
            <div class="col-md-4">
              <select name="member_retrocessionaire" id="member_retrocessionaire" class="e1 form-control">
                <option value="" disabled selected>Select Member Retrocessionaire</option>
                @foreach ($ceding as $c)
                <option value="{{ $c->id }}">{{ $c->code }} - {{ $c->name }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="row mb-2">
            <div class="col-md-3 align-self-center">Rating</div>
            <div class="col-md-4">
              <select name="rating" id="rating" class="form-control">
                <option value="" selected disabled>Select Rating</option>
                <option value="A+">A+</option>
                <option value="A">A</option>
                <option value="A-">A-</option>
              </select>
            </div>
          </div>

          <div class="row mb-2">
            <div class="col-md-3 align-self-center">Share</div>
            <div class="col-md-4">
              <input type="text" name="share" id="share_member" class="form-control money text-left">
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
                    <th>Member Retrocessionaire</th>
                    <th>Rating</th>
                    <th>Share</th>
                  </tr>
                </thead>
                <tbody id="tbody_panel_member">
                </tbody>
              </table>
            </div>
          </div>
        </div>

      </div>

    </div>
  </div>
</div>