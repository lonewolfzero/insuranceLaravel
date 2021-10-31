<div class="row">

  <div class="col-md-1">
    <table class="table">
      <tbody>
        <tr>
          <td>Total Recovery</td>
        </tr>
      </tbody>
    </table>
  </div>

  <div class="col-md-3">
    <div class="table-responsive">
      <table class="table">
        <tbody>
          <tr>
            <td>
              <input type="text" name="totalrecovery" id="totalrecovery" class="form-control" autocomplete="off"
                value="0">
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>


  <div class="col-md-1">
    <table class="table">
      <tbody>
        <tr>
          <td>NR's Gross Ret</td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="col-md-3">
    <div class="table-responsive">
      <table class="table">
        <tbody>
          <tr>
            <td>
              <input type="text" name="nrsgrossret" id="nrsgrossret" class="form-control" autocomplete="off">
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  {{-- <div class="col-md-3">
    <div class="table-responsive">
      <table class="table">
        <tbody>
          <tr>
            <td>
              <!--input type="text" name="xol" id="xol" class="form-control" autocomplete="off"-->
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div> --}}
</div>

<div class="row">

  <div class="col-md-1">
    <table class="table">
      <tbody>
        <tr>
          <td>CE Reff No</td>
        </tr>
      </tbody>
    </table>
  </div>

  <div class="col-md-3">
    <div class="table-responsive">
      <table class="table">
        <tbody>
          <tr>
            <td>
              <input type="text" name="cereffno" id="cereffno" class="form-control" autocomplete="off" disabled>
            </td>
            <td>
              <select name="status_ce" id="status_ce" class="form-control">
                <option selected value="">{{ __('Select CE Status') }}</option>
                <option value="CL">{{ __('Cash Loss') }}</option>
                <option value="NL">{{ __('Non Cash Loss') }}</option>
                <option value="DC">{{ __('Decline') }}</option>
                <option value="CC">{{ __('Cancel') }}</option>
              </select>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <div class="col-md-1">
    <table class="table">
      <tbody>
        <tr>
          <td>Date Of Prod</td>
        </tr>
      </tbody>
    </table>
  </div>

  <div class="col-md-3">
    <div class="table-responsive">
      <table class="table">
        <tbody>
          <tr>
            <td>
              <input type="text" name="dateofprod" id="dateofprod" class="form-control datepicker" autocomplete="off"
                disabled>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

</div>


<div class="row">
  <div class="col-md-1">
    <table class="table">
      <tbody>
        <tr>
          <td>CE No</td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="col-md-3">
    <div class="table-responsive">
      <table class="table">
        <tbody>
          <tr>
            <td>
              <input type="text" name="ceno" id="ceno" class="form-control" autocomplete="off" disabled>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <div class="col-md-1">
    <table class="table">
      <tbody>
        <tr>
          <td>CE User</td>
        </tr>
      </tbody>
    </table>
  </div>

  <div class="col-md-3">
    <div class="table-responsive">
      <table class="table">
        <tbody>
          <tr>
            <td>
              <input type="text" name="ceuser" id="ceuser" class="form-control" autocomplete="off" disabled>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

</div>

<div class="row">
  <div class="col-md-1">
    <table class="table">
      <tbody>
        <tr>
          <td>Date Of Entry</td>
        </tr>
      </tbody>
    </table>
  </div>

  <div class="col-md-3">
    <table class="table">
      <tbody>
        <tr>
          <td>
            <input type="text" name="dateentry" id="dateentry" class="form-control datepicker" autocomplete="off"
              disabled>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

  <div class="col-md-6">
  </div>
</div>

<div class="row">
  <div class="col-md-1">
    <table class="table">
      <tbody>
        <tr>
          <td>Date Of Trans</td>
        </tr>
      </tbody>
    </table>
  </div>

  <div class="col-md-3">
    <table class="table">
      <tbody>
        <tr>
          <td>
            <input type="text" name="datetrans" id="datetrans" class="form-control datepicker datemask"
              autocomplete="off">
          </td>
        </tr>
      </tbody>
    </table>
  </div>

  <div class="col-md-6">
  </div>
</div>

<div class="row">
  <div class="col-md-1">
    <table class="table">
      <tbody>
        <tr>
          <td>Date Of Supporting</td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="col-md-3">
    <table class="table">
      <tbody>
        <tr>
          <td>
            <input type="text" name="datesupporting" id="datesupporting" class="form-control datepicker datemask"
              autocomplete="off">
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="col-md-6">
  </div>
</div>

<div class="row">
  <div class="col-md-1">

    <table class="table">
      <tbody>
        <tr>
          <td id='remarks'>Remarks</td>
        </tr>
      </tbody>
    </table>

  </div>
  <div class="col-md-9">
    <table class="table">
      <tbody>
        <tr>
          <td>
            <textarea name="description" id="description" class="form-control" autocomplete="off"></textarea>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<div class="col-md-10">
  <div class="card">
    <div class="card-header bg-gray">
      View Attachment
    </div>
    <div class="card-body">
      <div class="table-responsive">
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
              <td></td>
              <td>
                <div class="form-group">
                  <input type="text" id="attachmentdesc" name="attachmentdesc" class="form-control form-control-sm"
                    placeholder="Attachment Description">
                </div>
              </td>
              <td>
                <input type="text" id="attachmenturl" name="attachmenturl" placeholder="Attachment Url"
                  class="form-control form-control-sm" />
              </td>
              <td>
                <div class="form-group">
                  <button type="button" id="attachmentbtn" name="attachmentbtn"
                    class="btn btn-md btn-primary">{{ __('Add') }}</button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>