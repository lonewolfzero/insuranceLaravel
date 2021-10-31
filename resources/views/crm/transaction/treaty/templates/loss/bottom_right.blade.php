<div class="col-md-6 border-left">

  <div class="row mb-4">
    <div class="col-md-4"></div>
    <div class="col-md-2"><b>IDR</b></div>
    <div class="col-md-2"><b>USD</b></div>
    <div class="col-md-2"><input class="form-control form-control-sm roe money" name="roe" id="roe"
        value="{{ @$loss->roe }}" readonly>
    </div>
    <div class="col-md-2"><b>Total In IDR</b></div>
  </div>

  <div class="row mb-4">
    <div class="col-md-4">Earned Premium</div>
    <div class="col-md-2">
      <input type="text" required class="form-control form-control-sm money earned-premium-idr"
        name="earned_premium_idr" id="earned_premium_idr" value="{{ @$loss->earned_premium_idr }}">
    </div>
    <div class="col-md-2">
      <input type="text" required class="form-control form-control-sm money earned-premium-usd"
        name="earned_premium_usd" id="earned_premium_usd" value="{{ @$loss->earned_premium_usd }}">
    </div>
    <div class="col-md-2">
      <input type="text" required class="form-control form-control-sm money earned-premium-roe"
        name="earned_premium_roe" id="earned_premium_roe" value="{{ @$loss->earned_premium_roe }}" readonly>
    </div>
    <div class="col-md-2">
      <input type="text" required class="form-control form-control-sm money earned-premium-total"
        name="earned_premium_total" id="earned_premium_total" value="{{ @$loss->earned_premium_total }}">
    </div>
  </div>

  <div class="row mb-4">
    <div class="col-md-4">Commission</div>
    <div class="col-md-2">
      <input type="text" required class="form-control form-control-sm money commission-idr" name="commission_idr"
        id="commission_idr" value="{{ @$loss->commission_idr }}">
    </div>
    <div class="col-md-2">
      <input type="text" required class="form-control form-control-sm money commission-usd" name="commission_usd"
        id="commission_usd" value="{{ @$loss->commission_usd }}">
    </div>
    <div class="col-md-2">
      <input type="text" required class="form-control form-control-sm money commission-roe" name="commission_roe"
        id="commission_roe" value="{{ @$loss->commission_roe }}" readonly>
    </div>
    <div class="col-md-2">
      <input type="text" required class="form-control form-control-sm money commission-total" name="commission_total"
        id="commission_total" value="{{ @$loss->commission_total }}">
    </div>
  </div>

  <div class="row mb-4">
    <div class="col-md-4">Claims</div>
    <div class="col-md-2">
      <input type="text" required class="form-control form-control-sm money claim-idr" name="claim_idr" id="claim_idr"
        value="{{ @$loss->claim_idr }}">
    </div>
    <div class="col-md-2">
      <input type="text" required class="form-control form-control-sm money claim-usd" name="claim_usd" id="claim_usd"
        value="{{ @$loss->claim_usd }}">
    </div>
    <div class="col-md-2">
      <input type="text" required class="form-control form-control-sm money claim-roe" name="claim_roe" id="claim_roe"
        value="{{ @$loss->claim_roe }}" readonly>
    </div>
    <div class="col-md-2">
      <input type="text" required class="form-control form-control-sm money claim-total" name="claim_total"
        id="claim_total" value="{{ @$loss->claim_total }}">
    </div>
  </div>

  <div class="row mb-4">
    <div class="col-md-4">Reserves</div>
    <div class="col-md-2">
      <input type="text" required class="form-control form-control-sm money reserves-idr" name="reserves_idr"
        id="reserves_idr" value="{{ @$loss->reserves_idr }}">
    </div>
    <div class="col-md-2">
      <input type="text" required class="form-control form-control-sm money reserves-usd" name="reserves_usd"
        id="reserves_usd" value="{{ @$loss->reserves_usd }}">
    </div>
    <div class="col-md-2">
      <input type="text" required class="form-control form-control-sm money reserves-roe" name="reserves_roe"
        id="reserves_roe" value="{{ @$loss->reserves_roe }}" readonly>
    </div>
    <div class="col-md-2">
      <input type="text" required class="form-control form-control-sm money reserves-total" name="reserves_total"
        id="reserves_total" value="{{ @$loss->reserves_total }}">
    </div>
  </div>

  <div class="row mb-4">
    <div class="col-md-4">Total Loss Figures</div>
    <div class="col-md-6"></div>
    <div class="col-md-2"><input type="text" required class="form-control form-control-sm money total-loss-figures"
        name="total_loss_figures" id="total_loss_figures" value="{{ @$loss->total_loss_figures }}" readonly>
    </div>
  </div>
  <hr>

  <div class="row mb-4">
    <div class="col-md-4">Loss figure</div>
    <div class="col-md-2"></div>
    <div class="col-md-2"><input type="text" required class="form-control form-control-sm money loss-figure"
        name="loss_figure" id="loss_figure" value="{{ @$loss->loss_figure }}">
    </div>
  </div>

  <div class="row mb-4">
    <div class="col-md-4">Commission</div>
    <div class="col-md-2"></div>
    <div class="col-md-2"><input type="text" required class="form-control form-control-sm money final-commission"
        name="final_commission" id="final_commission" value="{{ @$loss->final_commission }}">
    </div>
  </div>

  <div class="row mb-4">
    <div class="col-md-4">Combined Ratio</div>
    <div class="col-md-2"></div>
    <div class="col-md-2">
      <div class="input-group input-group-sm">
        <input type="text" required class="form-control form-control-sm money combined-ratio" name="combined_ratio"
          id="combined_ratio" value="{{ @$loss->combined_ratio }}">
        <div class="input-group-append"><span class="input-group-text">%</span></div>
      </div>
    </div>
  </div>

  <div class="row mb-4">
    <div class="col-md-4">Combined Ratio less</div>
    <div class="col-md-2">
      <div class="input-group input-group-sm">
        <input type="text" required class="form-control form-control-sm money"
          name="combined_ratio_less_loss_percentage" id="combined_ratio_less_loss_percentage"
          value="{{ @$loss->combined_ratio_less_loss_percentage }}">
        <div class="input-group-append"><span class="input-group-text">%</span></div>
      </div>
    </div>
    <div class="col-md-2">
      <div class="input-group input-group-sm">
        <input type="text" required class="form-control form-control-sm money combined-ratio-less-percentage"
          name="combined_ratio_less_percentage" id="combined_ratio_less_percentage"
          value="{{ @$loss->combined_ratio_less_percentage }}">
        <div class="input-group-append"><span class="input-group-text">%</span></div>
      </div>
    </div>
    <div class="col-md-2">
      <input type="text" required class="form-control form-control-sm money combined-ratio-less-amount"
        name="combined_ratio_less_amount" id="combined_ratio_less_amount"
        value="{{ @$loss->combined_ratio_less_amount }}">
    </div>
  </div>

  <div class="row mb-4">
    <div class="col-md-4">30% of Loss Figure</div>
    <div class="col-md-2"><input type="text" required class="form-control form-control-sm money of-loss-figure"
        name="of_loss_figure" id="of_loss_figure" value="{{ @$loss->of_loss_figure }}">
    </div>
  </div>

  <div class="row mb-4">
    <div class="col-md-4">Earned premium in IDR & USD as at <span class="as-at"></span></div>
    <div class="col-md-2"><input type="text" required
        class="form-control form-control-sm money earned-premium-as-at-idr" name="earned_premium_as_at_idr"
        id="earned_premium_as_at_idr" value="{{ @$loss->earned_premium_as_at_idr }}"></div>
    <div class="col-md-2"><input type="text" required
        class="form-control form-control-sm money earned-premium-as-at-usd" name="earned_premium_as_at_usd"
        id="earned_premium_as_at_usd" value="{{ @$loss->earned_premium_as_at_usd }}"></div>
  </div>

  <div class="row mb-4">
    <div class="col-md-4">Nasional Re share</div>
    <div class="col-md-2">
      <div class="input-group input-group-sm">
        <input type="text" required class="form-control form-control-sm money nasionalre-share" name="nasionalre_share"
          id="nasionalre_share" value="{{ @$loss->nasionalre_share }}">
        <div class="input-group-append"><span class="input-group-text">%</span></div>
      </div>
    </div>
  </div>

  <div class="row mb-4">
    <div class="col-md-4">Loss participation amount as at <span class="as-at"></span></div>
    <div class="col-md-2"><input type="text" required class="form-control form-control-sm money loss-participation-idr"
        name="loss_participation_idr" id="loss_participation_idr" value="{{ @$loss->loss_participation_idr }}"></div>
    <div class="col-md-2"><input type="text" required class="form-control form-control-sm money loss-participation-usd"
        name="loss_participation_usd" id="loss_participation_usd" value="{{ @$loss->loss_participation_usd }}"></div>
  </div>

  <div class="row mb-4">
    <div class="col-md-4">Due to Nasional Re</div>
    <div class="col-md-2"><input type="text" required class="form-control form-control-sm money due-to-nasionalre-idr"
        name="due_to_nasionalre_idr" id="due_to_nasionalre_idr" value="{{ @$loss->due_to_nasionalre_idr }}">
    </div>
    <div class="col-md-2"><input type="text" required class="form-control form-control-sm money due-to-nasionalre-usd"
        name="due_to_nasionalre_usd" id="due_to_nasionalre_usd" value="{{ @$loss->due_to_nasionalre_usd }}">
    </div>
  </div>

  <div class="row mb-4">
    <div class="col-md-4">Remark</div>
    <div class="col-md-6"><textarea required class="form-control form-control-sm" name="remark"
        id="remark">{{ @$loss->remark }}</textarea>
    </div>
  </div>

</div>