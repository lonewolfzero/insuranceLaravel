<div class="row mb-3">
  <div class="col-md-2 align-self-center">Total Recovery</div>
  <div class="col-md-2">
    <x-input-money-format all="total_recovery" :defval="0" :isreadonly="true" />
  </div>
  <div class="col-md-3"></div>
  <div class="col-md-2 align-self-center">NR's Gross Rate</div>
  <div class="col-md-2">
    <x-input-money-format all="nasonalre_gross_rate" />
  </div>
</div>

<div class="row mb-3">
  <div class="col-md-2 align-self-center">CE Reff No</div>
  <div class="col-md-2">
    <input type="text" name="ce_reff_no" id="ce_reff_no" class="form-control" readonly>
  </div>
  <div class="col-md-2">
    @php
    $var = [
    (object)["id"=>"Cash Loss"],
    (object)["id"=>"Non Cash Loss"],
    (object)["id"=>"Decline"],
    (object)["id"=>"Cancel"],
    ]
    @endphp
    <x-select-option all="ce_status" text="Select CE Status" :master="$var" :var="@$claim" col1="id" />
  </div>
  <div class="col-md-1"></div>
  <div class="col-md-2 align-self-center">Date Of Prod</div>
  <div class="col-md-2">
    <x-input-date-format all="date_of_prod" />
  </div>
</div>

<div class="row mb-3">
  <div class="col-md-2 align-self-center">CE No</div>
  <div class="col-md-2">
    <x-input-text-format all="ce_no" :isreadonly="true" />
  </div>
  <div class="col-md-3"></div>
  <div class="col-md-2 align-self-center">CE User</div>
  <div class="col-md-2">
    <x-input-text-format all="ce_user" :isreadonly="true" />
  </div>
</div>

<div class="row mb-3">
  <div class="col-md-2 align-self-center">Date Of Entry</div>
  <div class="col-md-2">
    <x-input-text-format all="date_of_entry" :isreadonly="true" />
  </div>
</div>

<div class="row mb-3">
  <div class="col-md-2 align-self-center">Date Of Trans</div>
  <div class="col-md-2">
    <x-input-text-format all="date_of_trans" :isreadonly="true" />
  </div>
</div>

<div class="row mb-3">
  <div class="col-md-2 align-self-center">Date Of Supporting</div>
  <div class="col-md-2">
    <x-input-text-format all="date_of_supporting" :isreadonly="true" />
  </div>
</div>

<div class="row mb-3">
  <div class="col-md-2 align-self-center">Remark</div>
  <div class="col-md-9">
    <textarea name="remark" id="remark" rows="2" class="form-control"></textarea>
  </div>
</div>

<div class="row">
  <div class="col-md-8">
    <div class="card">
      <div class="card-header bg-gray">View Attachment</div>
      <div class="card-body">
        <table id="tableattachment" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>{{ __('No') }}</th>
              <th>{{ __('Description') }}</th>
              <th>{{ __('Url') }}</th>
              <th>{{ __('Action') }}</th>
            </tr>
          </thead>
          <tbody id="attachmenttbody">
            @if (@$viewattachs)
            @foreach ($viewattachs as $va)
            <tr id="trviewattach{{ $va->id }}">
              <td>{{ $loop->iteration }}</td>
              <td>{{ $va->description }}</td>
              <td>{{ $va->url }}</td>
              <td>
                <a href="javascript:void(0)" role="button" onclick="deleteviewattach({{ $va->id }})">delete</a>
                {{-- <button type="button" role="button" onclick="deleteviewattach({{ $va->id }})">delete</button> --}}
              </td>
            </tr>
            @endforeach
            @endif
          </tbody>
          <tbody>
            <tr>
              <td colspan="2">
                <input type="text" id="attachmentdesc" class="form-control" placeholder="Attachment Description"
                  autocomplete="off">
              </td>
              <td>
                <input type="text" id="attachmenturl" placeholder="Attachment Url" class="form-control"
                  autocomplete="off">
              </td>
              <td class="align-middle text-center">
                <button class="btn btn-primary" type="button" id="attachmentbtn">Add</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>