<div class="modal fade" id="spreading_modal" tabindex="-1" user="dialog" aria-labelledby="addlocationLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" user="document">
    <div class="modal-content bg-light-gray">
      <div class="modal-header bg-gray">
        <h5 class="modal-title" id="addlocationLabel">{{ __('Spreading COB') }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">

        <form onsubmit="create_spreading_cob(this); return false" id="form_spreading">

          <input type="hidden" name="main_contract_id" class="main_contract_id">

          <div class="row">
            <div class="col-md-10">

              <div class="row mb-2">
                <div class="col-md-4 align-self-center">ID Spreading COB</div>
                <div class="col-md-8">
                  <input type="text" name="id_spreading_cob" id="id_spreading_cob" class="form-control" disabled>
                </div>
              </div>

              <div class="row mb-2">
                <div class="col-md-4 align-self-center">Detail COB</div>
                <div class="col-md-8">
                  <select name="detail_cob" id="detail_cob" class="e1 form-control" required>
                    <option value="" disabled selected>Select COB</option>
                    @foreach ($cob as $c)
                    <option value="{{ $c->id }}">{{ $c->code }} - {{ $c->description }}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="row mb-2">
                <div class="col-md-4 align-self-center">Percentage</div>
                <div class="col-md-8">
                  <input type="text" name="percentage" id="percentage" class="form-control money text-left" required>
                </div>
              </div>

              <div class="row mb-2">
                <div class="col-md-4 align-self-center">Type</div>
                <div class="col-md-8">
                  <select name="type" id="type" class="form-control" required>
                    <option value="" selected disabled>Select Type</option>
                    <option value="syariah">Syariah</option>
                    <option value="konvensional">Konvensional</option>
                  </select>
                </div>
              </div>

              <div class="row">
                <div class="col-md-4 align-self-center">Type KOC</div>
                <div class="col-md-8">
                  <select name="koc" id="koc" class="form-control" required>
                    <option value="" selected disabled>Select Type KOC</option>
                    <option value="facultative">Facultative</option>
                    <option value="treaty prop">Treaty Prop</option>
                    <option value="treaty non prop">Treaty Non Prop</option>
                  </select>
                </div>
              </div>

            </div>
          </div>

          <div class="row my-3 justify-content-center">
            <div class="col-md-2 align-self-center text-center"><button class="btn btn-primary">Add</button></div>
          </div>

        </form>

        <div class="card">
          <div class="card-body">
            <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>Detail COB</th>
                  <th>Percentage</th>
                  <th>Type</th>
                  <th>Type KOC</th>
                </tr>
              </thead>
              <tbody id="tbody_spreading_cob">
                @if (@$spreadings)
                @foreach ($spreadings as $s)
                <tr>
                  <td>
                    {{ $s->getcob->code }}
                    - {{ $s->getcob->description }}
                  </td>
                  <td>{{ number_format($s->percentage, 2) }}</td>
                  <td>{{ $s->type }}</td>
                  <td>{{ $s->koc }}</td>
                </tr>
                @endforeach
                @endif

              </tbody>
            </table>
          </div>
        </div>

      </div>

    </div>
  </div>
</div>