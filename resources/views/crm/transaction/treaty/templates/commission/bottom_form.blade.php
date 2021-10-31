<div class="row mb-5">
  <div class="col-md-6 border-right">

    <div class="row justify-content-center mb-2">
      <div class="col-md-5">Ceding / Broker :</div>
      <div class="col-md-4"><b class="ceding_broker">{{ @$commission->getbroker->name }}</b></div>
    </div>
    <div class="row justify-content-center mb-2">
      <div class="col-md-5">Ceding Company :</div>
      <div class="col-md-4"><b class="ceding_company">{{ @$commission->getcompany->name }}</b></div>
    </div>
    <div class="row justify-content-center mb-2">
      <div class="col-md-5">U/W Year :</div>
      <div class="col-md-4"><b class="u_w_year">{{ @$commission->treaty_year }}</b></div>
    </div>
    <div class="row justify-content-center mb-4">
      <div class="col-md-5">Profit Comm Calculation as At :</div>
      <div class="col-md-4"><b class="profit_comm_at">@if(@$commission->date_prod)
          {{ date('F d, Y',strtotime(@$commission->date_prod)) }} @else
          {{ date('F d, Y', strtotime(now())) }} @endif</b></div>
    </div>

    <div class="row mb-2">
      <div class="col-md-4"></div>
      <div class="col-md-4">Rupiah</div>
      <div class="col-md-4">Dollar</div>
    </div>

    <div class="row mb-2">
      <div class="col-md-4">Premium :</div>
      <div class="col-md-4"><b>Rp. 0</b></div>
      <div class="col-md-4"><b>USD. 0</b></div>
    </div>

    <div class="row mb-2">
      <div class="col-md-4">Commission :</div>
      <div class="col-md-4"><b>Rp. 0</b></div>
      <div class="col-md-4"><b>USD. 0</b></div>
    </div>

    <div class="row mb-2">
      <div class="col-md-4">Losses Paid :</div>
      <div class="col-md-4"><b>Rp. 0</b></div>
      <div class="col-md-4"><b>USD. 0</b></div>
    </div>

    <div class="row mb-2">
      <div class="col-md-4">Outstanding Losses :</div>
      <div class="col-md-4"><b>Rp. 0</b></div>
      <div class="col-md-4"><b>USD. 0</b></div>
    </div>

    <div class="row mb-3">
      <div class="col-md-4">Management Expenses : <span class="float-right">%</span></div>
      <div class="col-md-4"><b>0</b></div>
      <div class="col-md-4"><b>0</b></div>
    </div>

    <div class="row mb-3">
      <div class="col-md-4"><b>Profit / (Loss) :</b></div>
      <div class="col-md-4"><b>Rp. 0</b></div>
      <div class="col-md-4"><b>USD. 0</b></div>
    </div>

    <div class="row mb-2">
      <div class="col-md-4">Rupiah Exchange Rate :</div>
      <div class="col-md-4"><b>Rp. 0</b></div>
    </div>

    <div class="row mb-2">
      <div class="col-md-4">Profit / (Loss) :</div>
      <div class="col-md-4"><b>Rp. 0</b></div>
    </div>

    <div class="row mb-2">
      <div class="col-md-4">Deficit Carrier Forward (DCF) :</div>
      <div class="col-md-4"><b>Rp. 0</b></div>
    </div>

    <div class="row mb-2">
      <div class="col-md-4">Profit / Loss after DCF :</div>
      <div class="col-md-4"><b>Rp. 0</b></div>
    </div>

    <div class="row mb-3">
      <div class="col-md-4">Profit Commission in : <span class="float-right">%</span></div>
      <div class="col-md-4"><b>0</b></div>
    </div>

    <div class="row mb-2">
      <div class="col-md-4">Your share : <span class="float-right">%</span></div>
      <div class="col-md-4"><b>0</b></div>
    </div>

    <div class="row mb-2">
      <div class="col-md-4">Total Previous Settlement :</div>
      <div class="col-md-4"><b>Rp. 0</b></div>
    </div>

  </div>

  <div class="col-md-6">
    <div class="row justify-content-center mb-2">
      <div class="col-md-5">Ceding / Broker :</div>
      <div class="col-md-4"><b class="ceding_broker">{{ @$commission->getbroker->name }}</b></div>
    </div>
    <div class="row justify-content-center mb-2">
      <div class="col-md-5">Ceding Company :</div>
      <div class="col-md-4"><b class="ceding_company">{{ @$commission->getcompany->name }}</b></div>
    </div>
    <div class="row justify-content-center mb-2">
      <div class="col-md-5">U/W Year :</div>
      <div class="col-md-4"><b class="u_w_year">{{ @$commission->treaty_year }}</b></div>
    </div>
    <div class="row justify-content-center mb-4">
      <div class="col-md-5">Profit Comm Calculation as At :</div>
      <div class="col-md-4"><b class="profit_comm_at">@if(@$commission->date_prod)
          {{ date('F d, Y',strtotime(@$commission->date_prod)) }} @else
          {{ date('F d, Y', strtotime(now())) }} @endif</b></div>
    </div>

    <div class="row mb-2">
      <div class="col-md-4"></div>
      <div class="col-md-4"></div>
      <div class="col-md-4">IDR</div>
    </div>

    <div class="row mb-2">
      <div class="col-md-4">Premium :</div>
      <div class="col-md-4">
        {{-- <input required type="text" class="form-control form-control-sm" i=""> --}}
      </div>
      <div class="col-md-4"><input required type="text" class="form-control form-control-sm money" name="premium"
          @if(@$commission->premium)
        value="{{ number_format(@$commission->premium, 2) }}"@endif
        id="premium">
      </div>
    </div>

    <div class="row mb-2">
      <div class="col-md-4">Commission :</div>
      <div class="col-md-4"><input required type="text" class="form-control form-control-sm"
          name="commission_percentage" @if(@$commission->commission_percentage)
        value="{{ number_format(@$commission->commission_percentage, 2) }}"@endif
        id="commission_percentage">
      </div>
      <div class="col-md-4"><input required type="text" class="form-control form-control-sm money"
          name="commission_amount" @if(@$commission->commission_amount)
        value="{{ number_format(@$commission->commission_amount, 2) }}"@endif id="commission_amount"
        readonly>
      </div>
    </div>

    <div class="row mb-2">
      <div class="col-md-4">Losses Paid :</div>
      <div class="col-md-4">
        {{-- <input required type="text" class="form-control form-control-sm" i=""> --}}
      </div>
      <div class="col-md-4"><input required type="text" class="form-control form-control-sm money" name="losses_paid"
          @if(@$commission->losses_paid)
        value="{{ number_format(@$commission->losses_paid, 2) }}"@endif
        id="losses_paid">
      </div>
    </div>

    <div class="row mb-2">
      <div class="col-md-4">Outstanding Losses :</div>
      <div class="col-md-4">
        {{-- <input required type="text" class="form-control form-control-sm" i=""> --}}
      </div>
      <div class="col-md-4"><input required type="text" class="form-control form-control-sm money"
          name="outstanding_losses" @if(@$commission->outstanding_losses)
        value="{{ number_format(@$commission->outstanding_losses, 2) }}"@endif id="outstanding_losses">
      </div>
    </div>

    <div class="row mb-3">
      <div class="col-md-4">Management Expenses : <span class="float-right">%</span></div>
      <div class="col-md-4"><input required type="text" class="form-control form-control-sm"
          name="management_expenses_percentage" @if(@$commission->management_expenses_percentage)
        value="{{ number_format(@$commission->management_expenses_percentage, 2) }}"@endif
        id="management_expenses_percentage">
      </div>
      <div class="col-md-4"><input required type="text" class="form-control form-control-sm money"
          name="management_expenses_amount" @if(@$commission->management_expenses_amount)
        value="{{ number_format(@$commission->management_expenses_amount, 2) }}"@endif
        id="management_expenses_amount" readonly></div>
    </div>

    <div class="row mb-2">
      <div class="col-md-4">Deficit Carrier Forward (DCF) :</div>
      <div class="col-md-4"></div>
      <div class="col-md-4"><input required type="text" class="form-control form-control-sm money" name="dcf"
          @if(@$commission->dcf)
        value="{{ number_format(@$commission->dcf, 2) }}"@endif id="dcf">
      </div>
    </div>

    <div class="row mb-3">
      <div class="col-md-4"><b>Profit / (Loss) :</b></div>
      <div class="col-md-4">
        {{-- <input required type="text" class="form-control form-control-sm" i=""> --}}
      </div>
      <div class="col-md-4"><input required type="text" class="form-control form-control-sm money"
          name="profit_loss_first" @if(@$commission->profit_loss_first)
        value="{{ number_format(@$commission->profit_loss_first, 2) }}"@endif id="profit_loss_first"
        readonly>
      </div>
    </div>

    <div class="row mb-2">
      <div class="col-md-4">Rupiah Exchange Rate :</div>
      <div class="col-md-4">
        <input required type="text" class="form-control form-control-sm" name="rupiah_exchange_rate"
          @if(@$commission->rupiah_exchange_rate)
        value="{{ number_format(@$commission->rupiah_exchange_rate, 2) }}"@endif
        id="rupiah_exchange_rate">
      </div>
    </div>

    <div class="row mb-2">
      <div class="col-md-4">Profit / (Loss) :</div>
      <div class="col-md-4"></div>
      <div class="col-md-4"><input required type="text" class="form-control form-control-sm money"
          name="profit_loss_second" @if(@$commission->profit_loss_second)
        value="{{ number_format(@$commission->profit_loss_second, 2) }}"@endif id="profit_loss_second"
        readonly>
      </div>
    </div>

    <div class="row mb-2">
      <div class="col-md-4">Profit / Loss after DCF :</div>
      <div class="col-md-4"></div>
      <div class="col-md-4"><input required type="text" class="form-control form-control-sm money"
          name="profit_loss_dcf" @if(@$commission->profit_loss_dcf)
        value="{{ number_format(@$commission->profit_loss_dcf, 2) }}"@endif id="profit_loss_dcf">
      </div>
    </div>

    <div class="row mb-2">
      <div class="col-md-4">Profit Commission in : <span class="float-right">%</span></div>
      <div class="col-md-4"><input required type="text" class="form-control form-control-sm"
          name="profit_commission_percentage" @if(@$commission->profit_commission_percentage)
        value="{{ number_format(@$commission->profit_commission_percentage, 2) }}"@endif
        id="profit_commission_percentage"></div>
      <div class="col-md-4"><input required type="text" class="form-control form-control-sm money"
          name="profit_commission_amount" @if(@$commission->profit_commission_amount)
        value="{{ number_format(@$commission->profit_commission_amount, 2) }}"@endif
        id="profit_commission_amount" readonly></div>
    </div>

    <div class="row mb-2">
      <div class="col-md-4">Our share : <span class="float-right">%</span></div>
      <div class="col-md-4"><input required type="text" class="form-control form-control-sm" name="our_share_percentage"
          @if(@$commission->our_share_percentage)
        value="{{ number_format(@$commission->our_share_percentage, 2) }}"@endif
        id="our_share_percentage">
      </div>
      <div class="col-md-4"><input required type="text" class="form-control form-control-sm money"
          name="our_share_amount" @if(@$commission->our_share_amount)
        value="{{ number_format(@$commission->our_share_amount, 2) }}"@endif id="our_share_amount"
        readonly>
      </div>
    </div>

    <div class="row mb-2">
      <div class="col-md-4">Total Previous Settlement :</div>
      <div class="col-md-4"></div>
      <div class="col-md-4"><input required type="text" class="form-control form-control-sm money"
          name="total_previous_settlement" @if(@$commission->total_previous_settlement)
        value="{{ number_format(@$commission->total_previous_settlement, 2) }}"@endif
        id="total_previous_settlement"></div>
    </div>

    <div class="row mb-2">
      <div class="col-md-4">Balance Due to You/(Us) :</div>
      <div class="col-md-4"></div>
      <div class="col-md-4"><input required type="text" class="form-control form-control-sm money" name="balance_due"
          @if(@$commission->balance_due)
        value="{{ number_format(@$commission->balance_due, 2) }}"@endif
        id="balance_due" readonly>
      </div>
    </div>

    <div class="row mb-2">
      <div class="col-md-4">Remark :</div>
      <div class="col-md-6"><textarea required name="remark" id="remark" rows="3"
          class="form-control">{{ @$commission->remark }}</textarea>
      </div>
    </div>

  </div>

</div>

<div class="row justify-content-center">
  <div class="col-md-8">

    <div class="row justify-content-center my-4">
      <div class="col-md-4 text-center"><button class="btn btn-primary" id="btn_calculate_submit">Submit</button></div>
      <div class="col-md-4 text-center"><button class="btn btn-primary" id="btn_calculate_cancel">Cancel</button></div>
    </div>

  </div>

</div>