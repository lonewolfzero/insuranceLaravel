<div class="col-md-6">

  <div class="row mb-4">
    <div class="col-md-4"></div>
    <div class="col-md-2"><b>IDR</b></div>
    <div class="col-md-2"><b>USD</b></div>
    <div class="col-md-2"><input class="form-control form-control-sm roe money" value="{{ @$loss->roe }}" readonly>
    </div>
    <div class="col-md-2"><b>Total In IDR</b></div>
  </div>

  <div class="row mb-4">
    <div class="col-md-4">Earned Premium</div>
    <div class="col-md-2">
      <input type="text" class="form-control form-control-sm money earned-premium-idr"
        value="{{ @$loss->earned_premium_idr }}" readonly>
    </div>
    <div class="col-md-2">
      <input type="text" class="form-control form-control-sm money earned-premium-usd"
        value="{{ @$loss->earned_premium_usd }}" readonly>
    </div>
    <div class="col-md-2">
      <input type="text" class="form-control form-control-sm money earned-premium-roe"
        value="{{ @$loss->earned_premium_roe }}" readonly>
    </div>
    <div class="col-md-2">
      <input type="text" class="form-control form-control-sm money earned-premium-total"
        value="{{ @$loss->earned_premium_total }}" readonly>
    </div>
  </div>

  <div class="row mb-4">
    <div class="col-md-4">Commission</div>
    <div class="col-md-2">
      <input type="text" class="form-control form-control-sm money commission-idr" value="{{ @$loss->commission_idr }}"
        readonly>
    </div>
    <div class="col-md-2">
      <input type="text" class="form-control form-control-sm money commission-usd" value="{{ @$loss->commission_usd }}"
        readonly>
    </div>
    <div class="col-md-2">
      <input type="text" class="form-control form-control-sm money commission-roe" value="{{ @$loss->commission_roe }}"
        readonly>
    </div>
    <div class="col-md-2">
      <input type="text" class="form-control form-control-sm money commission-total"
        value="{{ @$loss->commission_total }}" readonly>
    </div>
  </div>

  <div class="row mb-4">
    <div class="col-md-4">Claims</div>
    <div class="col-md-2">
      <input type="text" class="form-control form-control-sm money claim-idr" value="{{ @$loss->claim_idr }}" readonly>
    </div>
    <div class="col-md-2">
      <input type="text" class="form-control form-control-sm money claim-usd" value="{{ @$loss->claim_usd }}" readonly>
    </div>
    <div class="col-md-2">
      <input type="text" class="form-control form-control-sm money claim-roe" value="{{ @$loss->claim_roe }}" readonly>
    </div>
    <div class="col-md-2">
      <input type="text" class="form-control form-control-sm money claim-total" value="{{ @$loss->claim_total }}"
        readonly>
    </div>
  </div>

  <div class="row mb-4">
    <div class="col-md-4">Reserves</div>
    <div class="col-md-2">
      <input type="text" class="form-control form-control-sm money reserves-idr" value="{{ @$loss->reserves_idr }}"
        readonly>
    </div>
    <div class="col-md-2">
      <input type="text" class="form-control form-control-sm money reserves-usd" value="{{ @$loss->reserves_usd }}"
        readonly>
    </div>
    <div class="col-md-2">
      <input type="text" class="form-control form-control-sm money reserves-roe" value="{{ @$loss->reserves_roe }}"
        readonly>
    </div>
    <div class="col-md-2">
      <input type="text" class="form-control form-control-sm money reserves-total" value="{{ @$loss->reserves_total }}"
        readonly>
    </div>
  </div>

  <div class="row mb-4">
    <div class="col-md-4">Total Loss Figures</div>
    <div class="col-md-6"></div>
    <div class="col-md-2"><input type="text" class="form-control form-control-sm money total-loss-figures"
        value="{{ @$loss->total_loss_figures }}" readonly>
    </div>
  </div>
  <hr>

  <div class="row mb-4">
    <div class="col-md-4">Loss figure</div>
    <div class="col-md-2"></div>
    <div class="col-md-2"><input type="text" class="form-control form-control-sm money loss-figure"
        value="{{ @$loss->loss_figure }}" readonly>
    </div>
  </div>

  <div class="row mb-4">
    <div class="col-md-4">Commission</div>
    <div class="col-md-2"></div>
    <div class="col-md-2"><input type="text" class="form-control form-control-sm money final-commission"
        value="{{ @$loss->final_commission }}" readonly></div>
  </div>

  <div class="row mb-4">
    <div class="col-md-4">Combined Ratio</div>
    <div class="col-md-2"></div>
    <div class="col-md-2">
      <div class="input-group input-group-sm">
        <input type="text" class="form-control form-control-sm money combined-ratio"
          value="{{ @$loss->combined_ratio }}" readonly>
        <div class="input-group-append"><span class="input-group-text">%</span></div>
      </div>
    </div>
  </div>

  <div class="row mb-4">
    <div class="col-md-4">Combined Ratio less 100% Loss Ratio</div>
    <div class="col-md-2"></div>
    <div class="col-md-2">
      <div class="input-group input-group-sm">
        <input type="text" class="form-control form-control-sm money combined-ratio-less-percentage"
          value="{{ @$loss->combined_ratio_less_percentage }}" readonly>
        <div class="input-group-append"><span class="input-group-text">%</span></div>
      </div>
    </div>
    <div class="col-md-2">
      <input type="text" class="form-control form-control-sm money combined-ratio-less-amount"
        value="{{ @$loss->combined_ratio_less_amount }}" readonly>
    </div>
  </div>

  <div class="row mb-4">
    <div class="col-md-4">30% of Loss Figure</div>
    <div class="col-md-2"><input type="text" class="form-control form-control-sm money of-loss-figure"
        value="{{ @$loss->of_loss_figure }}" readonly></div>
  </div>

  <div class="row mb-4">
    <div class="col-md-4">Earned premium in IDR & USD as at <span class="as-at"></span></div>
    <div class="col-md-2"><input type="text" class="form-control form-control-sm money earned-premium-as-at-idr"
        value="{{ @$loss->earned_premium_as_at_idr }}" readonly></div>
    <div class="col-md-2"><input type="text" class="form-control form-control-sm money earned-premium-as-at-usd"
        value="{{ @$loss->earned_premium_as_at_usd }}" readonly></div>
  </div>

  <div class="row mb-4">
    <div class="col-md-4">Nasional Re share</div>
    <div class="col-md-2">
      <div class="input-group input-group-sm">
        <input type="text" class="form-control form-control-sm money nasionalre-share"
          value="{{ @$loss->nasionalre_share }}" readonly>
        <div class="input-group-append"><span class="input-group-text">%</span></div>
      </div>
    </div>
  </div>

  <div class="row mb-4">
    <div class="col-md-4">Loss participation amount as at <span class="as-at"></span></div>
    <div class="col-md-2"><input type="text" class="form-control form-control-sm money loss-participation-idr"
        value="{{ @$loss->loss_participation_idr }}" readonly>
    </div>
    <div class="col-md-2"><input type="text" class="form-control form-control-sm money loss-participation-usd"
        value="{{ @$loss->loss_participation_usd }}" readonly>
    </div>
  </div>

  <div class="row mb-4">
    <div class="col-md-4">Due to Nasional Re</div>
    <div class="col-md-2"><input type="text" class="form-control form-control-sm money due-to-nasionalre-idr"
        value="{{ @$loss->due_to_nasionalre_idr }}" readonly>
    </div>
    <div class="col-md-2"><input type="text" class="form-control form-control-sm money due-to-nasionalre-usd"
        value="{{ @$loss->due_to_nasionalre_usd }}" readonly>
    </div>
  </div>

</div>