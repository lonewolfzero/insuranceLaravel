<div class="row justify-content-center" style="display: none" id="panel_retro">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header bg-gray">Panel Retro</div>
      <div class="card-body bg-light-gray">

        @include('crm.transaction.retro.mindep.templates.disabled_maincontract')

        <hr>

        @include('crm.transaction.retro.mindep.templates.disabled_layer', ['ver'=>true])

        <hr>

        <form onsubmit="create_panel_retro(this); return false" id="form_panel_retro">

          <input type="hidden" name="layer_id" class="layer_id">

          <div class="row mb-2">
            <div class="col-md-2 align-self-center">ID Panel Retro</div>
            <div class="col-md-6">
              <input type="text" name="id_panel_retro" id="id_panel_retro" class="form-control" disabled>
            </div>
          </div>

          <div class="row mb-2">
            <div class="col-md-2 align-self-center">Retrocessionaire</div>
            <div class="col-md-6">
              <select name="retrocessionaire" id="retrocessionaire" class="e1 form-control">
                <option value="" disabled selected>Select Retrocessionaire</option>
                @foreach ($ceding as $c)
                <option value="{{ $c->id }}">{{ $c->code }} - {{ $c->name }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="row mb-2">
            <div class="col-md-2 align-self-center">Share</div>
            <div class="col-md-6">
              <input type="text" name="share" id="retro_share" class="form-control money text-left">
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
                    <th>Retrocessionaire</th>
                    <th>Share</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody id="tbody_panel_retro">
                </tbody>
              </table>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>