<div class="card">
  <div class="card-body">
    <table class="table table-stripped table-bordered">
      <thead>
        <tr>
          <td>ID</td>
          <td>Remark</td>
          <td>Status</td>
          <td>Currency</td>
          <td>Treaty Summary</td>
          <td>Doc Number</td>
          <td>Gross Premium</td>
          <td>R/I Comm</td>
          <td>Paid Losses</td>
          <td>Cash Loss</td>
          <td>Common A/C XOL</td>
          <td>Balance</td>
          <td>Action</td>
        </tr>
      </thead>
      <tbody>
        @if($soa_list)
        @foreach ($soa_list as $s)
        <tr>
          <td>{{ $s->soa_id }}</td>
          <td>{{ $s->remark }}</td>
          <td>{{ $s->status }}</td>
          <td>{{ $s->currency }}</td>
          <td>{{ $s->tty_summary }}</td>
          <td>{{ $s->doc_number }}</td>
          <td class="money">{{ number_format($s->nasionalre_gross_premium, 2) }}</td>
          <td class="money">{{ number_format($s->nasionalre_r_i_comm_percentage, 2) }}</td>
          <td class="money">{{ number_format($s->nasionalre_paid_losses, 2) }}</td>
          <td class="money">{{ number_format($s->nasionalre_cash_loss, 2) }}</td>
          <td class="money">{{ number_format($s->nasionalre_common_a_c_xol, 2) }}</td>
          <td class="money">{{ number_format($s->nasionalre_balance, 2) }}</td>
          <td>
            <form action="/treaty/soa/entry" method="get">
              <div class="d-flex">
                <input type="hidden" name="id" value="{{ base64_encode($s->id) }}">
                <button class="btn" type="submit">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="blue" class="bi bi-display"
                    viewBox="0 0 16 16">
                    <path
                      d="M0 4s0-2 2-2h12s2 0 2 2v6s0 2-2 2h-4c0 .667.083 1.167.25 1.5H11a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1h.75c.167-.333.25-.833.25-1.5H2s-2 0-2-2V4zm1.398-.855a.758.758 0 0 0-.254.302A1.46 1.46 0 0 0 1 4.01V10c0 .325.078.502.145.602.07.105.17.188.302.254a1.464 1.464 0 0 0 .538.143L2.01 11H14c.325 0 .502-.078.602-.145a.758.758 0 0 0 .254-.302 1.464 1.464 0 0 0 .143-.538L15 9.99V4c0-.325-.078-.502-.145-.602a.757.757 0 0 0-.302-.254A1.46 1.46 0 0 0 13.99 3H2c-.325 0-.502.078-.602.145z" />
                  </svg>
                </button>
                <button class="btn" onclick="delete_soa({{ base64_encode($s->id) }})">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-trash"
                    viewBox="0 0 16 16">
                    <path
                      d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                    <path fill-rule="evenodd"
                      d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
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