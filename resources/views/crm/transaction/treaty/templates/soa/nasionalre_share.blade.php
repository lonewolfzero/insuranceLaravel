<div class="col-md-6">
  <div class="card">
    <div class="card-header bg-gray">
      Nasionalre Share
    </div>
    <div class="card-body bg-light-gray">

      <input type="hidden" id="nasionalre_share_first"
        value="{{ @$soa->getprop->getsubdetail->nasionalre_share_first }}">
      <input type="hidden" id="nasionalre_share_second"
        value="{{ @$soa->getprop->getsubdetail->nasionalre_share_second }}">
      <input type="hidden" id="r_i_comm_gross" value="{{ @$soa->getprop->getsubdetail->r_i_comm_gross }}">
      <input type="hidden" id="r_i_comm_nett" value="{{ @$soa->getprop->getsubdetail->r_i_comm_nett }}">

      <div class="row mb-2">
        <div class="col-md-2">
          Share
        </div>
        <div class="col-md-2">
          <input type="checkbox" name="nasionalre_share_checkbox" id="nasionalre_share_checkbox" @if(@$soa &&
            @$soa->nasionalre_share_checked) checked @endif>
        </div>
        <div class="col-md-2">
          Part Of
        </div>
        <div class="col-md-6">
          <div class="input-group input-group-sm">
            <input type="text" class="form-control form-control-sm" name="nasionalre_share" id="nasionalre_share"
              required value="{{ @$soa->nasionalre_share ? number_format(@$soa->nasionalre_share, 2) : '' }}">
            <div class="input-group-append"><span class="input-group-text">%</span></div>
          </div>
        </div>
      </div>

      <div class="row mb-2">
        <div class="col-md-6">
          Gross Premium
        </div>
        <div class="col-md-6">
          <input type="text" class="form-control form-control-sm money text-left" name="nasionalre_gross_premium"
            id="nasionalre_gross_premium" required
            value="{{ @$soa->nasionalre_gross_premium ? number_format(@$soa->nasionalre_gross_premium, 2) : '' }}">
        </div>
      </div>

      <div class="row mb-2">
        <div class="col-md-2">
          R/I Comm
        </div>
        <div class="col-md-2">
          <select name="nasionalre_r_i_comm_type" id="nasionalre_r_i_comm_type" class="form-control form-control-sm"
            required>
            <option value="gross" @if(@$soa && @$soa->nasionalre_r_i_comm_type == "gross") selected
              @endif>
              Gross
            </option>
            <option value="nett" @if(@$soa && @$soa->nasionalre_r_i_comm_type == "nett") selected
              @endif>
              Nett
            </option>
          </select>
        </div>
        <div class="col-md-2">
          <div class="input-group input-group-sm">
            <input class="form-control form-control-sm" name="nasionalre_r_i_comm_percentage"
              id="nasionalre_r_i_comm_percentage" required
              value="{{ @$soa->nasionalre_r_i_comm_percentage ? number_format(@$soa->nasionalre_r_i_comm_percentage, 2) : '' }}">
            <div class="input-group-append"><span class="input-group-text">%</span></div>
          </div>
        </div>
        <div class="col-md-6">
          <input type="text" class="form-control form-control-sm money text-left" name="nasionalre_r_i_comm_amount"
            id="nasionalre_r_i_comm_amount" required
            value="{{ @$soa->nasionalre_r_i_comm_amount ? number_format(@$soa->nasionalre_r_i_comm_amount, 2) : '' }}"
            readonly>
        </div>
      </div>

      <div class="row mb-2">
        <div class="col-md-4">
          Brokerage
        </div>
        <div class="col-md-2">
          <div class="input-group input-group-sm">
            <input type="text" class="form-control form-control-sm" name="nasionalre_overrider_percentage"
              id="nasionalre_overrider_percentage" required
              value="{{ @$soa->nasionalre_overrider_percentage ? number_format(@$soa->nasionalre_overrider_percentage, 2) : '' }}">
            <div class="input-group-append"><span class="input-group-text">%</span></div>
          </div>
        </div>
        <div class="col-md-6">
          <input type="text" class="form-control form-control-sm money text-left" name="nasionalre_overrider_amount"
            id="nasionalre_overrider_amount" required
            value="{{ @$soa->nasionalre_overrider_amount ? number_format(@$soa->nasionalre_overrider_amount, 2) : '' }}"
            readonly>
        </div>
      </div>

      <div class="row mb-2">
        <div class="col-md-4">
          Interest
        </div>
        <div class="col-md-2">
          <div class="input-group input-group-sm">
            <input type="text" class="form-control form-control-sm" name="nasionalre_interest_percentage"
              id="nasionalre_interest_percentage" required
              value="{{ @$soa->nasionalre_interest_percentage ? number_format(@$soa->nasionalre_interest_percentage, 2) : '' }}">
            <div class="input-group-append"><span class="input-group-text">%</span></div>
          </div>
        </div>
        <div class="col-md-6">
          <input type="text" class="form-control form-control-sm money text-left" name="nasionalre_interest_amount"
            id="nasionalre_interest_amount" required
            value="{{ @$soa->nasionalre_interest_amount ? number_format(@$soa->nasionalre_interest_amount, 2) : '' }}"
            readonly>
        </div>
      </div>

      <div class="row mb-2">
        <div class="col-md-6">
          Net Premium
        </div>
        <div class="col-md-6">
          <input type="text" class="form-control form-control-sm money text-left" name="nasionalre_net_premium"
            id="nasionalre_net_premium" required
            value="{{ @$soa->nasionalre_net_premium ? number_format(@$soa->nasionalre_net_premium, 2) : '' }}" readonly>
        </div>
      </div>

      <div class="row mb-2">
        <div class="col-md-6">
          Paid Losses (A)
        </div>
        <div class="col-md-6">
          <input type="text" class="form-control form-control-sm money text-left" name="nasionalre_paid_losses"
            id="nasionalre_paid_losses" required
            value="{{ @$soa->nasionalre_paid_losses ? number_format(@$soa->nasionalre_paid_losses, 2) : '' }}">
        </div>
      </div>

      <div class="row mb-2">
        <div class="col-md-6">
          Claim Recovery (B)
        </div>
        <div class="col-md-6">
          <input type="text" class="form-control form-control-sm money text-left" name="nasionalre_claim_recovery"
            id="nasionalre_claim_recovery" required
            value="{{ @$soa->nasionalre_claim_recovery ? number_format(@$soa->nasionalre_claim_recovery, 2) : '' }}">
        </div>
      </div>

      <div class="row mb-2">
        <div class="col-md-6">
          (A) - (B)
        </div>
        <div class="col-md-6">
          <input type="text" class="form-control form-control-sm money text-left" name="nasionalre_result"
            id="nasionalre_result" readonly
            value="{{ @$soa->nasionalre_result ? number_format(@$soa->nasionalre_result, 2) : '' }}">
        </div>
      </div>

      <div class="row mb-2">
        <div class="col-md-6">
          Cash Loss
        </div>
        <div class="col-md-6">
          <input type="text" class="form-control form-control-sm money text-left" name="nasionalre_cash_loss"
            id="nasionalre_cash_loss" required
            value="{{ @$soa->nasionalre_cash_loss ? number_format(@$soa->nasionalre_cash_loss, 2) : '' }}">
        </div>
      </div>

      <div class="row mb-2">
        <div class="col-md-6">Common A/C XOL</div>
        <div class="col-md-6"><input class="form-control form-control-sm money text-left"
            name="nasionalre_common_a_c_xol" id="nasionalre_common_a_c_xol" required
            value="{{ @$soa->nasionalre_common_a_c_xol ? number_format(@$soa->nasionalre_common_a_c_xol, 2) : '' }}">
        </div>
      </div>

      <div class="row mb-2">
        <div class="col-md-6">
          Net Balance
        </div>
        <div class="col-md-6">
          <input type="text" class="form-control form-control-sm money text-left" name="nasionalre_balance"
            id="nasionalre_balance" required
            value="{{ @$soa->nasionalre_balance ? number_format(@$soa->nasionalre_balance, 2) : '' }}" readonly>
        </div>
      </div>

      <section class="vat">
        <div class="row mb-2">
          <div class="col-md-4">
            VAT
            {{-- <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="nasionalre_vat_checkbox" @if(@$soa &&
                @$soa->nasionalre_vat) checked @endif>
              <label class="form-check-label" for="nasionalre_vat_checkbox">
                VAT
              </label>
            </div> --}}
          </div>
          <div class="col-md-2">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-sm" name="nasionalre_vat_percentage"
                id="nasionalre_vat_percentage" @if(@$soa && @$soa->nasionalre_vat_percentage)
              value="{{ number_format(@$soa->nasionalre_vat_percentage, 2) }}" @else
              value="0" @endif>
              <div class="input-group-append"><span class="input-group-text">%</span></div>
            </div>
          </div>
          <div class="col-md-6"><input class="form-control form-control-sm money text-left" name="nasionalre_vat"
              id="nasionalre_vat" @if(@$soa && @$soa->nasionalre_vat)
            value="{{ number_format(@$soa->nasionalre_vat, 2) }}" @else value="0" @endif readonly>
          </div>
        </div>

        <div class="row mb-2">
          <div class="col-md-6">Net Balance After VAT</div>
          <div class="col-md-6">
            <input class="form-control form-control-sm money text-left" name="nasionalre_vat_balance"
              id="nasionalre_vat_balance" @if(@$soa && @$soa->nasionalre_vat_balance)
            value="{{ number_format(@$soa->nasionalre_vat_balance, 2) }}" @else value="0" @endif readonly>
          </div>
        </div>
      </section>

    </div>
  </div>
</div>