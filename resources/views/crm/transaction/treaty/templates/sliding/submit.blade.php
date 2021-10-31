<div class="row justify-content-center">
  <div class="col-md-8">

    <div class="row mb-4">
      <div class="col-md-3">ID :</div>
      <div class="col-md-2">
        <input type="text" class="form-control form-control-sm" name="sliding_scale_id" id="sliding_scale_id"
          @if(@$sliding) value="{{ $sliding->sliding_scale_id }}" @endif readonly>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-3">Version :</div>
      <div class="col-md-2">
        <input type="text" class="form-control form-control-sm" name="version" id="version" @if(@$sliding)
          value="{{ $sliding->version }}" @else value="1" @endif readonly>
      </div>
    </div>

    <div class="row mb-4">
      <div class="col-md-3">Finalized Sliding Scale :</div>
      <div class="col-md-2"><input type="text" class="form-control form-control-sm money" name="finalized_sliding_scale"
          id="finalized_sliding_scale" @if(@$sliding) value="{{ $sliding->finalized_sliding_scale }}" @else value="0"
          @endif readonly></div>
      <div class="col-md-1"></div>
      <div class="col-md-3">Date Prod :</div>
      <div class="col-md-2">
        <input type="text" class="form-control form-control-sm" name="date_prod" id="date_prod" @if(@$sliding)
          value="{{ date('d/m/Y',strtotime($sliding->date_prod)) }}" @else value="{{ date('d/m/Y', strtotime(now())) }}"
          @endif readonly>
      </div>
    </div>

    <div class="row mb-4">
      <div class="col-md-6"></div>
      <div class="col-md-3">User Entry :</div>
      <div class="col-md-2">
        <input type="text" class="form-control form-control-sm" name="user_entry" id="user_entry" @if(@$sliding)
          value="{{ $sliding->getuser->name }}" @else value="{{ auth()->user()->name }}" @endif readonly>
      </div>
    </div>

    <div class="row mb-4">
      <div class="col-md-3">Remark :</div>
      <div class="col-md-6"><textarea name="remark" id="remark" class="form-control w-100"
          required>{{ @$sliding->remark }}</textarea></div>
    </div>

    <div class="row justify-content-center my-4">
      <div class="col-md-4 text-center"><button class="btn btn-primary" type="submit" id="btn_submit"
          disabled>Submit</button></div>
      {{-- <div class="col-md-4 text-center"><button class="btn btn-primary">Cancel</button></div> --}}
    </div>

  </div>

</div>