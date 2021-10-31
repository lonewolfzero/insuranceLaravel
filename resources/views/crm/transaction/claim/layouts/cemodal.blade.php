<div class="modal fade" id="createce" tabindex="-1" user="dialog" aria-labelledby="addlocationLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" user="document">
    <div class="modal-content bg-light-gray">
      <div class="modal-header bg-gray">
        <h5 class="modal-title" id="addlocationLabel">{{ __('Report CE') }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">

        <div class="row">
          <p class="col-md-3">{{ __('No Reg Comp') }}</p>
          <div class="col-md-6">
            <input name="regcompce" id="regcompce" class="form-control form-control-sm" required readonly>
          </div>
        </div>

        <div class="row">
          <p class="col-md-3">{{ __('Doc Counter') }}</p>
          <div class="col-md-6">
            <input name="doccounterce" id="doccounterce" class="form-control form-control-sm" required readonly>
          </div>
        </div>

        <div class="row">
          <p class="col-md-3">{{ __('Examiner') }}</p>
          <div class="col-md-6">
            <select name="examinerce" id="examinerce" class="e1 form-control form-control-sm">
              <option value="" selected readonly>{{__('Select Examiner')}}</option>
              @foreach ($users as $user)
              <option value="{{ $user->id }}">{{ $user->name }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="row">
          <p class="col-md-3">{{ __('Assist. Manager') }}</p>
          <div class="col-md-6">
            <select name="ast_managerce" id="ast_managerce" class="e1 form-control form-control-sm">
              <option value="" selected readonly>{{__('Select Assist. Manager')}}</option>
              @foreach ($users as $user)
              <option value="{{ $user->id }}">{{ $user->name }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="row">
          <p class="col-md-3">{{ __('Decision Manager') }}</p>
          <div class="col-md-6">
            <select name="dec_managerce" id="dec_managerce" class="e1 form-control form-control-sm">
              <option value="" selected readonly>{{__('Select Decision Manager')}}</option>
              @foreach ($users as $user)
              <option value="{{ $user->id }}">{{ $user->name }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="row">
          <p class="col-md-3">{{ __('General Manager') }}</p>
          <div class="col-md-6">
            <select name="gen_managerce" id="gen_managerce" class="e1 form-control form-control-sm">
              <option value="" selected readonly>{{__('Select General Manager')}}</option>
              @foreach ($users as $user)
              <option value="{{ $user->id }}">{{ $user->name }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="row">
          <p class="col-md-3">{{ __('Board Decision') }}</p>
          <div class="col-md-6">
            <select name="dec_boardce" id="dec_boardce" class="e1 form-control form-control-sm">
              <option value="" selected readonly>{{__('Select Board Decision')}}</option>
              @foreach ($users as $user)
              <option value="{{ $user->id }}">{{ $user->name }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="row">
          <p class="col-md-3">{{ __('No Reff CE') }}</p>
          <div class="col-md-6">
            <input name="noreffce" id="noreffce" class="form-control form-control-sm" required readonly>
          </div>
          <div class="col px-1"><label>Auto Generated</label></div>
        </div>

        <div class="row">
          <p class="col-md-3">{{ __('Print Date') }}</p>
          <div class="col-md-6">
            <input name="printdatece" id="printdatece" class="form-control form-control-sm datemask datepicker"
              required>
          </div>
        </div>

        <div class="row">
          <p class="col-md-3">{{ __('Accumulation Retro') }}</p>
          <div class="col-md-6">
            <select name="accretro" id="accretro" class="form-control form-control-sm" required>
              <option value="" selected readonly>Select Accumulation Retro</option>
              <option value="1">Yes</option>
              <option value="0">No</option>
            </select>
          </div>
        </div>


      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
        <button type="submit" class="btn btn-info" id="printcebtn">Print</button>
      </div>

    </div>
  </div>
</div>