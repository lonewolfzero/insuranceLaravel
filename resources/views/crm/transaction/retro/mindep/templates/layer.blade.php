<div class="row justify-content-center" style="display: none" id="layer">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header bg-gray">Layer</div>
      <div class="card-body bg-light-gray">

        @include('crm.transaction.retro.mindep.templates.disabled_maincontract')

        <hr>

        <form onsubmit="create_layer(this); return false" id="form_layer">

          <input type="hidden" name="main_contract_id" class="main_contract_id">

          <div class="row mb-2">
            <div class="col-md-2 align-self-center">ID Layer</div>
            <div class="col-md-6">
              <input type="text" name="id_layer" id="id_layer" class="form-control" autocomplete="off">
            </div>
            <div class="col"></div>
            <div class="col-md-2"><button class="btn btn-primary" type="button"
                onclick="backToMainContract()">Prev</button></div>
          </div>

          <div class="row mb-2">
            <div class="col-md-2 align-self-center">Our Contract</div>
            <div class="col-md-6">
              <input type="text" name="our_contract" id="our_contract" class="form-control" autocomplete="off">
            </div>
          </div>

          <div class="row mb-2">
            <div class="col-md-2 align-self-center">Kind Of Treaty</div>
            <div class="col-md-6">
              <select name="kind_of_treaty" id="kind_of_treaty" class="e1 `form-control">
                <option value="" disabled selected>Select Kind Of Treaty</option>
                @foreach ($koc as $k)
                <option value="{{ $k->id }}">{{ $k->code }} - {{ $k->description }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="row mb-2">
            <div class="col-md-2 align-self-center">Type Of Coverage</div>
            <div class="col-md-6">
              <select name="type_coverage" id="type_coverage" class="e1 `form-control">
                <option value="" disabled selected>Select Type Of Coverage</option>
                @foreach ($typeOfCoverage as $toc)
                <option value="{{ $toc->id }}">{{ $toc->code }} - {{ $toc->description }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="row mb-2">
            <div class="col-md-2 align-self-center">Mindep 100%</div>
            <div class="col-md-6">
              <input type="text" name="mindep_100" id="mindep_100" class="form-control money text-left"
                autocomplete="off">
            </div>
          </div>

          <div class="row mb-2">
            <div class="col-md-2 align-self-center">Share</div>
            <div class="col-md-6">
              <input type="text" name="share" id="share" class="form-control money text-left" autocomplete="off">
            </div>
          </div>

          <div class="row mb-2">
            <div class="col-md-2 align-self-center">Mindep Retro</div>
            <div class="col-md-6">
              <input type="text" name="mindep_retro" id="mindep_retro" class="form-control money text-left" disabled>
            </div>
          </div>

          <div class="row mb-2">
            <div class="col-md-2 align-self-center">Withholding Tax</div>
            <div class="col-md-6">
              <input type="text" name="withholding_tax" id="withholding_tax" class="form-control money text-left"
                autocomplete="off">
            </div>
          </div>

          <div class="row mb-2">
            <div class="col-md-2 align-self-center">Limit Loss</div>
            <div class="col-md-6">
              <input type="text" name="limit_loss" id="limit_loss" class="form-control money text-left"
                autocomplete="off">
            </div>
          </div>

          <div class="row mb-2">
            <div class="col-md-2 align-self-center">Deductible</div>
            <div class="col-md-6">
              <input type="text" name="deductible" id="deductible" class="form-control money text-left"
                autocomplete="off">
            </div>
          </div>

          <div class="row mb-2">
            <div class="col-md-2 align-self-center">Aggregate</div>
            <div class="col-md-6">
              <input type="text" name="aggregate" id="aggregate" class="form-control money text-left"
                autocomplete="off">
            </div>
          </div>

          <div class="row mb-2">
            <div class="col-md-2 align-self-center">Adj Rate</div>
            <div class="col-md-6">
              <input type="text" name="adj_rate" id="adj_rate" class="form-control money text-left" autocomplete="off">
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
                    <th>ID Layer</th>
                    <th>Our Contract</th>
                    <th>Kind of Treaty</th>
                    <th>Type Coverage</th>
                    <th>Mindep 100%</th>
                    <th>Share</th>
                    <th>Mindep Retro</th>
                    <th>Witholding Tax</th>
                    <th>Limit Loss</th>
                    <th>Deductible</th>
                    <th>Aggregate</th>
                    <th>Adj Rate</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody id="tbody_layer">
                </tbody>
              </table>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>