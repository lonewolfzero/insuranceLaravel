<div class="card">
  <div class="card-body table-responsive">
    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>ID Sub Detail</th>
          <th>Remark</th>
          <th>Status</th>
          <th>Ceding Broker</th>
          <th>COB</th>
          <th>Period</th>
          <th>Type Perusahaan</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody id="tbody_sub_detail_contract">
        @if (@$contracts)
        @foreach (@$contracts as $sc)
        <tr>
          <td>{{ $sc->id_sub_detail_contract }}</td>
          <td>{{ $sc->remark }}</td>
          <td>{{ $sc->status }}</td>
          <td>{{ $sc->getprop->getbroker->name }}</td>
          <td>{{ $sc->getprop->getcob->description }}</td>
          <td>{{ date('d/m/Y',strtotime($sc->period_from)) }} - {{ date('d/m/Y',strtotime($sc->period_to)) }}</td>
          <td>{{ $sc->getprop->type_perusahaan }}</td>
          <td>
            <form action="/treaty/prop/entry" method="get">
              <div class="d-flex">
                <input type="hidden" name="id" value="{{ base64_encode($sc->id) }}">
                <button class="btn" type="submit">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="blue" class="bi bi-display"
                    viewBox="0 0 16 16">
                    <path
                      d="M0 4s0-2 2-2h12s2 0 2 2v6s0 2-2 2h-4c0 .667.083 1.167.25 1.5H11a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1h.75c.167-.333.25-.833.25-1.5H2s-2 0-2-2V4zm1.398-.855a.758.758 0 0 0-.254.302A1.46 1.46 0 0 0 1 4.01V10c0 .325.078.502.145.602.07.105.17.188.302.254a1.464 1.464 0 0 0 .538.143L2.01 11H14c.325 0 .502-.078.602-.145a.758.758 0 0 0 .254-.302 1.464 1.464 0 0 0 .143-.538L15 9.99V4c0-.325-.078-.502-.145-.602a.757.757 0 0 0-.302-.254A1.46 1.46 0 0 0 13.99 3H2c-.325 0-.502.078-.602.145z" />
                  </svg>
                </button>
              </div>
            </form>
          </td>
        </tr>
        @endforeach
        @endif
      </tbody>
    </table>
  </div>
</div>