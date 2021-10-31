<div class="row justify-content-end mb-4">
  <div class="col-md-4">
    <div class="row mb-2">
      <div class="col-md-6">ID</div>
      <div class="col-md-6"><input type="text" class="form-control form-control-sm" id="loss_id" @if(@$loss->loss_id)
        value="{{ $loss->loss_id }}" @else value="" @endif readonly></div>
    </div>
    <div class="row mb-2">
      <div class="col-md-6">Version</div>
      <div class="col-md-6"><input type="text" class="form-control form-control-sm" name="version" id="version"
          @if(@$loss->version) value="{{ $loss->version }}" @else value="1" @endif readonly></div>
    </div>
    <div class="row mb-2">
      <div class="col-md-6">Date Prod</div>
      <div class="col-md-6"><input type="text" class="form-control form-control-sm" name="date_prod" id="date_prod"
          @if(@$loss->date_prod) value="{{ date('d/m/Y', strtotime($loss->date_prod)) }}" @else
        value="{{ date('d/m/Y', strtotime(now())) }}" @endif readonly></div>
    </div>
    <div class="row mb-2">
      <div class="col-md-6">User Entry</div>
      <div class="col-md-6"><input type="text" class="form-control form-control-sm" name="user_entry" id="user_entry"
          @if(@$loss->user_entry) value="{{ $loss->getuser->name }}" @else value="{{ auth()->user()->name }}" @endif
        readonly></div>
    </div>
  </div>
</div>

<div class="row justify-content-center">
  <div class="col-md-6">

    <div class="row mb-3">
      <div class="col-md-4"><b>NR Share</b></div>
      <div class="col-md-2"><b
          id="nasionalre_share_first">{{ @$loss->getprop->getsubdetail->nasionalre_share_first }}</b><b>%</b></div>
      <div class="col-md-1"><b>Of</b></div>
      <div class="col-md-2"><b
          id="nasionalre_share_second">{{ @$loss->getprop->getsubdetail->nasionalre_share_second }}</b><b>%</b></div>
      <div class="col-md-1"><b>Of</b></div>
      <div class="col-md-2"><b>100%</b></div>
    </div>

    <div class="card mb-5">
      <div class="card-header bg-gray">
        Loss Participation
      </div>
      <div class="card-body">
        <table class="table table-borderless">
          <thead>
            <tr>
              <th>Share (%)</th>
              <th>L/P From (%)</th>
              <th>To (%)</th>
            </tr>
          </thead>
          <tbody id="tbody_loss_participation">
            @if (@$loss->getprop->getsubdetail->getloss)
            @foreach (@$loss->getprop->getsubdetail->getloss as $ls)
            <tr>
              <td>{{ $ls->share }}%</td>
              <td>{{ $ls->loss_ratio_first }}%</td>
              <td>{{ $ls->loss_ratio_second }}%</td>
            </tr>
            @endforeach
            @endif
          </tbody>
        </table>
      </div>
    </div>

  </div>
</div>

<div class="card">
  <div class="card-body">
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Version</th>
          <th>Ceding</th>
          <th>Member</th>
          <th>U/W Year</th>
          <th>Treaty Contract</th>
          <th>Doc Date</th>
          <th>Share Nasre</th>
          <th>Currency</th>
          <th>Lost Participation</th>
          <th>Lost Part Paid</th>
          <th>Date Entry</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody id="tbody_loss">
        @if (@$losses)
        @foreach ($losses as $ls)
        <tr>
          <td>{{ $ls->loss_id }}</td>
          <td>{{ $ls->version }}</td>
          <td>{{ $ls->getprop->getbroker->name }}</td>
          <td>{{ $ls->getprop->getcompany->name }}</td>
          <td>{{ $ls->getprop->treaty_year }}</td>
          <td>{{ $ls->getprop->id_detail_contract }}</td>
          <td>{{ date('d/m/Y',strtotime($ls->date_prod)) }}</td>
          <td>
            {{ number_format($ls->getprop->getsubdetail->nasionalre_share_first * $ls->getprop->getsubdetail->nasionalre_share_second / 100, 2) }}%
          </td>
          <td>{{ $ls->getprop->getsubdetail->getcurrency->code }}</td>
          <td>{{ number_format($ls->loss_participation_idr, 2) }}</td>
          <td>{{ number_format($ls->loss_participation_idr, 2) }}</td>
          <td>{{ date('d/m/Y',strtotime($ls->created_at)) }}</td>
          <td><button class="btn btn-sm btn-primary" type="button" onclick="cancelReplace({{ $ls->id }})">Cancel
              Replace</button></td>
        </tr>
        @endforeach
        @endif
      </tbody>
    </table>
  </div>
</div>