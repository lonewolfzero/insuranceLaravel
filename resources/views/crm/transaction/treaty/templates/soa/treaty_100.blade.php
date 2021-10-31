<div class="col-md-6">
  <div class="card">
    <div class="card-header bg-gray">
      Treaty 100%
    </div>
    <div class="card-body bg-light-gray">

      <div class="row mb-3">
        <div class="col-md-4">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" id="overseas_checkbox">
            <label class="form-check-label" for="overseas_checkbox">
              Overseas
            </label>
          </div>
        </div>

        <div class="col-md-4"><button class="btn btn-sm btn-primary" type="button" id="btn_copy"
            onclick="openCopyModal()">Copy Data</button>
        </div>
        <div class="col-md-4"><button class="btn btn-sm btn-primary" type="button" id="btn_replace"
            onclick="openCancelReplace()" disabled>Cancel
            Replace</button></div>
      </div>

      <div class="row mb-2">
        <div class="col-md-6">Gross Premium</div>
        <div class="col-md-6"><input class="form-control form-control-sm money text-left" name="treaty_gross_premium"
            id="treaty_gross_premium" required
            value="{{ @$soa->treaty_gross_premium ? number_format(@$soa->treaty_gross_premium, 2) : '' }}">
        </div>
      </div>

      <div class="row mb-2">
        <div class="col-md-6">Premium Released</div>
        <div class="col-md-6"><input class="form-control form-control-sm money text-left" name="treaty_premium_released"
            id="treaty_premium_released" required @if(@$soa->treaty_premium_released)
          value="{{ number_format(@$soa->treaty_premium_released, 2) }}" @else value="0" @endif readonly>
        </div>
      </div>

      <div class="row mb-2">
        <div class="col-md-6">Premium Reserved</div>
        <div class="col-md-6"><input class="form-control form-control-sm money text-left" name="treaty_premium_reserved"
            id="treaty_premium_reserved" required @if(@$soa->treaty_premium_reserved)
          value="{{ number_format(@$soa->treaty_premium_reserved, 2) }}" @else value="0" @endif readonly>
        </div>
      </div>

      <div class="row mb-2">
        <div class="col">
          <div class="card">
            <div class="card-header bg-gray">
              Premium Reserved
            </div>
            <div class="card-body">

              <div class="row mb-2">
                <div class="col-md-6">Amount</div>
                <div class="col-md-6"><input class="form-control form-control-sm money text-left"
                    id="amount_premium_reserved" readonly></div>
              </div>

              <div class="row mb-2">
                <div class="col-md-6"></div>
                <div class="col-md-6"><button type="button" onclick="event.preventDefault()"
                    class="btn btn-sm btn-primary" id="add_premium_reserved" disabled>Add</button>
                </div>
              </div>

              <table class="table table-bordered table-stripped">
                <thead>
                  <tr>
                    <td>No</td>
                    <td>Amount</td>
                    <td>Action</td>
                  </tr>
                </thead>
                <tbody id="tbody_premium_reserved">
                  @if (@$premium_reserved)
                  @foreach (@$premium_reserved as $pr)
                  <tr id="premium_reserved_row{{ $pr->id }}">
                    <input type="hidden" name="premium_reserved_id[]" id="" value="{{ $pr->id }}">
                    <input type="hidden" name="premium_reserved_amount[]" id="" value="{{ $pr->amount }}">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ number_format($pr->amount, 2) }}</td>
                    <td>
                      <button class="btn" onclick="delete_premium_reserved({{ $pr->id }})">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-trash"
                          viewBox="0 0 16 16">
                          <path
                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                          <path fill-rule="evenodd"
                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                        </svg>
                      </button>
                    </td>
                  </tr>
                  @endforeach
                  @endif
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="row mb-2">
        <div class="col-md-4">Interest on Premium</div>
        <div class="col-md-2">
          <div class="input-group input-group-sm">
            <input class="form-control form-control-sm" name="treaty_interest_on_premium_percentage"
              id="treaty_interest_on_premium_percentage" required
              value="{{ @$soa->treaty_interest_on_premium_percentage ? number_format(@$soa->treaty_interest_on_premium_percentage, 2) : '' }}">
            <div class="input-group-append"><span class="input-group-text">%</span></div>
          </div>
        </div>
        <div class="col-md-6">
          <input class="form-control form-control-sm money text-left" name="treaty_interest_on_premium_amount"
            id="treaty_interest_on_premium_amount" required
            value="{{ @$soa->treaty_interest_on_premium_amount ? number_format(@$soa->treaty_interest_on_premium_amount, 2) : '' }}"
            readonly>
        </div>
      </div>

      <div class="row mb-2">
        <div class="col-md-4">R/I Comm</div>
        <div class="col-md-2">
          <div class="input-group input-group-sm">
            <input class="form-control form-control-sm" name="treaty_r_i_comm_percentage"
              id="treaty_r_i_comm_percentage" required
              value="{{ @$soa->treaty_r_i_comm_percentage ? number_format(@$soa->treaty_r_i_comm_percentage, 2) : '' }}">
            <div class="input-group-append"><span class="input-group-text">%</span></div>
          </div>
        </div>
        <div class="col-md-6">
          <input class="form-control form-control-sm money text-left" name="treaty_r_i_comm_amount"
            id="treaty_r_i_comm_amount" required
            value="{{ @$soa->treaty_r_i_comm_amount ? number_format(@$soa->treaty_r_i_comm_amount, 2) : '' }}" readonly>
        </div>
      </div>

      <div class="row mb-2">
        <div class="col-md-4">Brokerage</div>
        <div class="col-md-2">
          <div class="input-group input-group-sm">
            <input class="form-control form-control-sm" name="treaty_overrider_percentage"
              id="treaty_overrider_percentage" required
              value="{{ @$soa->treaty_overrider_percentage ? number_format(@$soa->treaty_overrider_percentage, 2) : '' }}">
            <div class="input-group-append"><span class="input-group-text">%</span></div>
          </div>
        </div>
        <div class="col-md-6">
          <input class="form-control form-control-sm money text-left" name="treaty_overrider_amount"
            id="treaty_overrider_amount" required
            value="{{ @$soa->treaty_overrider_amount ? number_format(@$soa->treaty_overrider_amount, 2) : '' }}"
            readonly>
        </div>
      </div>

      <div class="row mb-2">
        <div class="col-md-6">
          Net Premium
        </div>
        <div class="col-md-6">
          <input type="text" class="form-control form-control-sm money text-left" name="treaty_net_premium"
            id="treaty_net_premium" required
            value="{{ @$soa->treaty_net_premium ? number_format(@$soa->treaty_net_premium, 2) : '' }}" readonly>
        </div>
      </div>

      <div class="row mb-2">
        <div class="col-md-6">Paid Losses (A)</div>
        <div class="col-md-6"><input class="form-control form-control-sm money text-left" name="treaty_paid_losses"
            id="treaty_paid_losses" required
            value="{{ @$soa->treaty_paid_losses ? number_format(@$soa->treaty_paid_losses, 2) : '' }}">
        </div>
      </div>

      <div class="row mb-2">
        <div class="col-md-6">Claim Recovery (B)</div>
        <div class="col-md-6"><input class="form-control form-control-sm money text-left" name="treaty_claim_recovery"
            id="treaty_claim_recovery" required
            value="{{ @$soa->treaty_claim_recovery ? number_format(@$soa->treaty_claim_recovery, 2) : '' }}">
        </div>
      </div>

      <div class="row mb-2">
        <div class="col-md-6">
          (A) - (B)
        </div>
        <div class="col-md-6">
          <input type="text" class="form-control form-control-sm money text-left" name="treaty_result"
            id="treaty_result" readonly
            value="{{ @$soa->treaty_result ? number_format(@$soa->treaty_result, 2) : '' }}">
        </div>
      </div>

      <div class="row mb-2">
        <div class="col-md-6">Cash Loss</div>
        <div class="col-md-6"><input type="text" class="form-control form-control-sm money text-left"
            name="treaty_cash_loss" id="treaty_cash_loss" required
            value="{{ @$soa->treaty_cash_loss ? number_format(@$soa->treaty_cash_loss, 2) : '' }}">
        </div>
      </div>

      <div class="row mb-2">
        <div class="col-md-6">Common A/C XOL</div>
        <div class="col-md-6"><input class="form-control form-control-sm money text-left" name="treaty_common_a_c_xol"
            id="treaty_common_a_c_xol" required
            value="{{ @$soa->treaty_common_a_c_xol ? number_format(@$soa->treaty_common_a_c_xol, 2) : '' }}">
        </div>
      </div>

      <div class="row mb-2">
        <div class="col-md-6">Net Balance</div>
        <div class="col-md-6">
          <input class="form-control form-control-sm money text-left" name="treaty_balance" id="treaty_balance" required
            value="{{ @$soa->treaty_balance ? number_format(@$soa->treaty_balance, 2) : '' }}" readonly>
        </div>
      </div>

      <section class="vat">
        <div class="row mb-2">
          <div class="col-md-4">
            VAT
            {{-- <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="treaty_vat_checkbox" @if(@$soa &&
                @$soa->treaty_vat) checked @endif>
              <label class="form-check-label" for="treaty_vat_checkbox">
                VAT
              </label>
            </div> --}}
          </div>
          <div class="col-md-2">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-sm" name="treaty_vat_percentage" id="treaty_vat_percentage"
                @if(@$soa && @$soa->treaty_vat_percentage)
              value="{{ number_format(@$soa->treaty_vat_percentage, 2) }}" @else value="0" @endif>
              <div class="input-group-append"><span class="input-group-text">%</span></div>
            </div>
          </div>
          <div class="col-md-6"><input class="form-control form-control-sm money text-left" name="treaty_vat"
              id="treaty_vat" @if(@$soa && @$soa->treaty_vat)
            value="{{ number_format(@$soa->treaty_vat, 2) }}"
            @else
            value="0"
            @endif readonly>
          </div>
        </div>

        <div class="row mb-2">
          <div class="col-md-6">Net Balance After VAT</div>
          <div class="col-md-6">
            <input class="form-control form-control-sm money text-left" name="treaty_vat_balance"
              id="treaty_vat_balance" @if(@$soa && @$soa->treaty_vat_balance)
            value="{{ number_format(@$soa->treaty_vat_balance, 2) }}" @else value="0" @endif readonly>
          </div>
        </div>
      </section>

    </div>

  </div>
</div>