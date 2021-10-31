<div class="modal fade" id="detail_layer_modal" tabindex="-1" user="dialog" aria-labelledby="addlocationLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" user="document">
    <div class="modal-content bg-light-gray">
      <div class="modal-header bg-gray">
        <h5 class="modal-title" id="addlocationLabel">{{ __('Detail Layer') }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">

        @include('crm.transaction.retro.mindep.templates.disabled_layer')

        <hr>

        <form onsubmit="create_detail_layer(this); return false" id="form_detail_layer">

          <input type="hidden" name="layer_id" class="layer_id">

          <div class="row mb-2">
            <div class="col-md-2 align-self-center">COB</div>
            <div class="col-md-4">
              <select name="cob" id="detail_layer_cob" class="e1 form-control">
                <option value="" disabled selected>Select COB</option>
                @foreach ($cob as $c)
                <option value="{{ $c->id }}">{{ $c->code }} - {{ $c->description }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="row mb-2">
            <div class="col-md-2 align-self-center">Mindep</div>
            <div class="col-md-4">
              <input type="text" name="mindep" id="mindep" class="form-control money text-left">
            </div>
          </div>

          <div class="row mb-2">
            <div class="col-md-2 align-self-center">Limit Loss</div>
            <div class="col-md-4">
              <input type="text" name="limit_loss" id="limit_loss" class="form-control money text-left">
            </div>
          </div>

          <div class="row mb-2">
            <div class="col-md-2 align-self-center">Deductible</div>
            <div class="col-md-4">
              <input type="text" name="deductible" id="deductible" class="form-control money text-left">
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
                    <th>COB</th>
                    <th>Mindep</th>
                    <th>Limit Loss</th>
                    <th>Deductible</th>
                  </tr>
                </thead>
                <tbody id="tbody_detail_layer">
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>

      </div>

    </div>
  </div>
</div>