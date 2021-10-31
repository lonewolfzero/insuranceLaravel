<div class="row">
  <div class="col-md-4">
    <div class="card">

      <div class="card-header bg-gray">
        Leader/Member
      </div>

      <div class="card-body">

        <select class="e1 form-control form-control-sm" name="leader_member_id" id="leader_member_id" required>
          <option value="" selected disabled>Select Leader/Member</option>
          <option value="0" @if(@$subdetail->leader_member_id == "0") selected @endif>Nasional Re</option>
          @foreach ($ceding as $c)
          <option value="{{ $c->id }}" @if(@$subdetail->leader_member_id == $c->id) selected @endif>
            {{ $c->code }} - {{ $c->name }}
          </option>
          @endforeach
        </select>

        <div class="row mt-3">
          <div class="col-md-6 text-center">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="leader_member_status" id="leader_member_status1"
                value="leader" @if(@$subdetail->leader_member_status =="leader") checked @endif required>
              <label class="form-check-label" for="leader_member_status1">
                Leader
              </label>
            </div>
          </div>
          <div class="col-md-6 text-center">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="leader_member_status" id="leader_member_status2"
                value="member" @if(@$subdetail->leader_member_status =="member") checked @endif>
              <label class="form-check-label" for="leader_member_status2">
                Member
              </label>
            </div>
          </div>
        </div>

      </div>
    </div>

    <div class="card">

      <div class="card-header bg-gray">
        Basis of Contract
      </div>

      <div class="card-body">
        <div class="form-check mb-3">
          <input class="form-check-input" type="radio" name="basis_of_contract" id="basis_of_contract1"
            value="risk attaching" checked required>
          <label class="form-check-label" for="basis_of_contract1">
            Risk Attaching
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="basis_of_contract" id="basis_of_contract2"
            value="loss occuring" disabled>
          <label class="form-check-label" for="basis_of_contract2">
            Loss Occuring
          </label>
        </div>
      </div>
    </div>

    @if (request()->path() == "treaty/prop/credit/entry")
    <div class="card">

      <div class="card-body">
        <div class="mb-2">
          Tenor (N)
          <input type="number" name="tenor" id="tenor" class="form-control forn-control-sm"
            value="{{ @$subdetail->tenor }}" required>
        </div>
        <div class="mb-2">
          Usia Masuk Maksimum (X)
          <input type="number" name="usia" id="usia" class="form-control forn-control-sm"
            value="{{ @$subdetail->usia }}" required>
        </div>
        <div>
          X + N
          <input type="number" name="tenor_usia" id="tenor_usia" class="form-control forn-control-sm"
            value="{{ @$subdetail->tenor_usia ?? '0' }}" readonly>
        </div>
      </div>
    </div>
    @endif

  </div>

  <div class="col-md-8">

    @if (request()->path() == "treaty/prop/entry")

    @include('crm.transaction.treaty.templates.prop.sliding_card')
    @include('crm.transaction.treaty.templates.prop.loss_card')

    @elseif (request()->path() == "treaty/prop/credit/entry")

    @include('crm.transaction.treaty.templates.prop.structure_limit')

    @endif

  </div>

  @if (request()->path() == "treaty/prop/credit/entry")
  <div class="col">
    <div class="row">
      <div class="col-md-6">
        @include('crm.transaction.treaty.templates.prop.sliding_card')
      </div>

      <div class="col-md-6">
        @include('crm.transaction.treaty.templates.prop.loss_card')
      </div>
    </div>
  </div>
  @endif
</div>