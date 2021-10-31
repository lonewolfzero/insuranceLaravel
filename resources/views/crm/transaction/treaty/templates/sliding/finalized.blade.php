<div class="row justify-content-center">
  <div class="col-md-12">

    <hr>

    <div class="row justify-content-center my-4">
      <div class="col-md-6">
        <table class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>No</th>
              <th>R/I Commission</th>
              <th>Loss Ratio</th>
            </tr>
          </thead>
          <tbody id="tbody_sliding_scale">
            @if (@$sliding->getprop->getsubdetail->getsliding)
            @foreach (@$sliding->getprop->getsubdetail->getsliding as $sl)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ number_format($sl->r_i_comm, 2) }}%</td>
              <td>{{ number_format($sl->loss_ratio_first, 2) }}% - {{ number_format($sl->loss_ratio_second, 2) }}%</td>
            </tr>
            @endforeach
            @endif
          </tbody>
        </table>
      </div>
    </div>

    <div class="row mb-2">
      <div class="col-md-6">
        <div class="row">
          <div class="col-md-4"></div>
          <div class="col-md-4 text-center"><b>IDR</b></div>
          <div class="col-md-4 text-center"><b>USD</b></div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="row">
          <div class="col-md-4"></div>
          <div class="col-md-4 text-center"><b>IDR</b></div>
          <div class="col-md-4 text-center"><b>USD</b></div>
        </div>
      </div>
    </div>

    <div class="row mb-2">
      <div class="col-md-6">
        <div class="row">
          <div class="col-md-4">Total Premium :</div>
          <div class="col-md-4">
            <input type="text" class="form-control form-control-sm money" name="total_premium_idr"
              id="total_premium_idr" @if(@$sliding) value="{{ $sliding->total_premium_idr }}" @else value="0" @endif
              readonly>
            {{-- X --}}
          </div>
          <div class="col-md-4">
            <input type="text" class="form-control form-control-sm money" name="total_premium_usd"
              id="total_premium_usd" @if(@$sliding) value="{{ $sliding->total_premium_usd }}" @else value="0" @endif
              readonly>
            {{-- X --}}
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="row">
          <div class="col-md-4">Total Paid Losses :</div>
          <div class="col-md-4">
            <input type="text" class="form-control form-control-sm money" name="total_paid_losses_idr"
              id="total_paid_losses_idr" @if(@$sliding) value="{{ $sliding->total_paid_losses_idr }}" @else value="0"
              @endif required>
            {{-- Y --}}
          </div>
          <div class="col-md-4">
            <input type="text" class="form-control form-control-sm money" name="total_paid_losses_usd"
              id="total_paid_losses_usd" @if(@$sliding) value="{{ $sliding->total_paid_losses_usd }}" @else value="0"
              @endif required>
            {{-- Y --}}
          </div>
        </div>
      </div>
    </div>

    <div class="row mb-2">
      <div class="col-md-6">
        <div class="row">
          <div class="col-md-4">Total Incured Losses :</div>
          <div class="col-md-4">
            <input type="text" class="form-control form-control-sm money" name="total_incured_losses_idr"
              id="total_incured_losses_idr" @if(@$sliding) value="{{ $sliding->total_incured_losses_idr }}" @else
              value="0" @endif readonly>
          </div>
          <div class="col-md-4">
            <input type="text" class="form-control form-control-sm money" name="total_incured_losses_usd"
              id="total_incured_losses_usd" @if(@$sliding) value="{{ $sliding->total_incured_losses_usd }}" @else
              value="0" @endif readonly>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="row">
          <div class="col-md-4">Total Outstanding Losses :</div>
          <div class="col-md-4">
            <input type="text" class="form-control form-control-sm money" name="total_outstanding_losses_idr"
              id="total_outstanding_losses_idr" @if(@$sliding) value="{{ $sliding->total_outstanding_losses_idr }}"
              @else value="0" @endif>
          </div>
          <div class="col-md-4">
            <input type="text" class="form-control form-control-sm money" name="total_outstanding_losses_usd"
              id="total_outstanding_losses_usd" @if(@$sliding) value="{{ $sliding->total_outstanding_losses_usd }}"
              @else value="0" @endif>
          </div>
        </div>
      </div>
    </div>

    <div class="row mb-2">
      <div class="col-md-6">
        <div class="row">
          <div class="col-md-4">Loss Ratio (Converted to IDR) :</div>
          <div class="col-md-4">
            <div class="input-group input-group-sm">
              <input type="text" class="form-control form-control-sm money" name="loss_ratio" id="loss_ratio"
                @if(@$sliding) value="{{ $sliding->loss_ratio }}" @else value="0" @endif readonly>
              <div class="input-group-append"><span class="input-group-text">%</span></div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row mb-2">
      <div class="col-md-6">
        <div class="row">
          <div class="col-md-4">Sliding Scale :</div>
          <div class="col-md-4">
            <input type="text" class="form-control form-control-sm money" name="sliding_scale_idr"
              id="sliding_scale_idr" @if(@$sliding) value="{{ $sliding->sliding_scale_idr }}" @else value="0" @endif
              readonly>
          </div>
          <div class="col-md-4">
            <input type="text" class="form-control form-control-sm money" name="sliding_scale_usd"
              id="sliding_scale_usd" @if(@$sliding) value="{{ $sliding->sliding_scale_usd }}" @else value="0" @endif
              readonly>
          </div>
        </div>
      </div>
    </div>

    <div class="row mb-2">
      <div class="col-md-6">
        <div class="row">
          <div class="col-md-4">Total claim paid under soa :</div>
          <div class="col-md-4">
            <input type="text" class="form-control form-control-sm money" name="total_claim_paid_idr"
              id="total_claim_paid_idr" @if(@$sliding) value="{{ $sliding->total_claim_paid_idr }}" @else value="0"
              @endif readonly>
          </div>
          <div class="col-md-4">
            <input type="text" class="form-control form-control-sm money" name="total_claim_paid_usd"
              id="total_claim_paid_usd" @if(@$sliding) value="{{ $sliding->total_claim_paid_usd }}" @else value="0"
              @endif readonly>
          </div>
        </div>
      </div>
    </div>

    <div class="row mb-2">
      <div class="col-md-6">
        <div class="row">
          <div class="col-md-4">Total commission under soa :</div>
          <div class="col-md-4">
            <input type="text" class="form-control form-control-sm money" name="total_commission_idr"
              id="total_commission_idr" @if(@$sliding) value="{{ $sliding->total_commission_idr }}" @else value="0"
              @endif readonly>
          </div>
          <div class="col-md-4">
            <input type="text" class="form-control form-control-sm money" name="total_commission_usd"
              id="total_commission_usd" @if(@$sliding) value="{{ $sliding->total_commission_usd }}" @else value="0"
              @endif readonly>
          </div>
        </div>
      </div>
    </div>

    <div class="row justify-content-center my-4">
      <div class="col-md-4 text-center"><button class="btn btn-primary" type="button" id="btn_finalized"
          onclick="finalizedSlidingScale()" disabled>Finalized</button></div>
    </div>

    <hr>

  </div>
</div>