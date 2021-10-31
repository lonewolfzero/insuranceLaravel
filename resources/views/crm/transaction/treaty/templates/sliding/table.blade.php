<div class="row justify-content-center">
  <div class="col-md-12 table-responsive">
    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>ID</th>
          <th>Version</th>
          <th>Premium</th>
          <th>Paid Losses</th>
          <th>Outstanding Losses</th>
          <th>Insured Losses</th>
          <th>Loss Ratio</th>
          <th>Sliding Scale</th>
          <th>Finalized Sliding Scale</th>
          <th>User Entry</th>
          <th>Prod Date</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody id="tbody_sliding_main">
        @if (@$slidings)
        @foreach ($slidings as $sl)
        <tr>
          <td>{{ $sl->sliding_scale_id }}</td>
          <td>{{ $sl->version }}</td>
          <td>{{ number_format($sl->total_premium_idr, 2) }}</td>
          <td>{{ number_format($sl->total_paid_losses_idr, 2) }}</td>
          <td>{{ number_format($sl->total_outstanding_losses_idr, 2) }}</td>
          <td>{{ number_format($sl->total_incured_losses_idr, 2) }}</td>
          <td>{{ number_format($sl->loss_ratio, 2) }}</td>
          <td>{{ number_format($sl->sliding_scale_idr, 2) }}</td>
          <td>{{ number_format($sl->finalized_sliding_scale, 2) }}</td>
          <td>{{ $sl->getuser->name }}</td>
          <td>{{ date('d/m/Y',strtotime($sl->date_prod)) }}</td>
          <td><button class="btn btn-sm btn-primary" type="button" onclick="cancelReplace({{ $sl->id }})">Cancel
              Replace</button></td>
        </tr>
        @endforeach
        @endif
      </tbody>
    </table>
  </div>
</div>