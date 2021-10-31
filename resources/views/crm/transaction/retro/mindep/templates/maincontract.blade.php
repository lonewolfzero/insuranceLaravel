<div class="row justify-content-center" id="main_contract">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header bg-gray">Main Contract</div>
      <div class="card-body bg-light-gray">

        <div class="row mb-2">
          <div class="col"></div>
          <div class="col-md-2 align-self-center">User</div>
          <div class="col-md-2">
            <input type="text" name="user" id="user" class="form-control" @if(@$maincontract->user_entry) value="{{
            $maincontract->getuser->name }}" @else value="{{ auth()->user()->name }}" @endif disabled>
          </div>
        </div>

        <div class="row mb-5">
          <div class="col"></div>
          <div class="col-md-2 align-self-center">Date Entry</div>
          <div class="col-md-2">
            <input type="text" name="date_entry" id="date_entry" class="form-control" @if(@$maincontract->date_entry)
            value="{{ date('d/m/Y', strtotime($maincontract->date_entry)) }}" @else value="{{ date('d/m/Y',
            strtotime(now())) }}" @endif disabled>
          </div>
        </div>

        <form action="/retro/mindep/maincontract/store" method="post">
          @csrf

          <div class="row mb-2">
            <div class="col-md-2 align-self-center">Main Contract</div>
            <div class="col-md-6">
              <input type="text" name="main_contract" id="main_contract" class="form-control text-uppercase"
                autocomplete="off" @if(@$maincontract->main_contract) value="{{ $maincontract->main_contract }}"
              @elseif(old('main_contract')) value="{{ old('main_contract') }}" @endif
              required>
              @error('main_contract')
              <div class="text-danger">{{ $message }}</div>
              @enderror

            </div>
          </div>

          <div class="row mb-2">
            <div class="col-md-2 align-self-center">U/W Year</div>
            <div class="col-md-6">
              <input type="text" name="u_w_year" id="u_w_year" class="form-control yearmask yearpicker"
                autocomplete="off" @if(@$maincontract->u_w_year) value="{{ $maincontract->u_w_year }}"
              @elseif(old('u_w_year')) value="{{ old('u_w_year') }}" @endif
              required>
            </div>
          </div>

          <div class="row mb-2">
            <div class="col-md-2 align-self-center">COB</div>
            <div class="col-md-6">
              <x-select-option all="cob" :master="$cob" text="Select COB" col1="code" col2="description"
                :isrequired="true" />
            </div>
          </div>

          <div class="row mb-2">
            <div class="col-md-2 align-self-center">Contract Description</div>
            <div class="col-md-6">
              <textarea name="contract_description" id="contract_description" class="form-control" rows="3"
                required>@if(old('contract_description')) {{ old('contract_description') }} @else {{ @$maincontract->contract_description }} @endif</textarea>
            </div>
          </div>

          <div class="row mb-2">
            <div class="col-md-2 align-self-center">EGNPI</div>
            <div class="col-md-6">
              <input type="text" name="egnpi" id="egnpi" class="form-control money text-left" autocomplete="off"
                @if(@$maincontract->egnpi) value="{{ number_format($maincontract->egnpi, 2) }}" @elseif(old('egnpi'))
              value="{{ old('egnpi') }}" @endif required>
            </div>
          </div>

          <div class="row mb-2">
            <div class="col-md-2 align-self-center">Currency</div>
            <div class="col-md-6">
              <x-select-option all="currency" :master="$currency" text="Select Currency" col1="code" col2="symbol_name"
                :isrequired="true" />
            </div>
          </div>

          <div class="row mb-2">
            <div class="col-md-2 align-self-center">Period</div>
            <div class="col-md-2">
              <input type="text" name="period_from" id="period_from" class="form-control datemask datepicker"
                autocomplete="off" @if(@$maincontract->period_from) value="{{ date('d/m/Y',
              strtotime($maincontract->period_from)) }}" @elseif(old('period_from')) value="{{ old('period_from') }}"
              @endif required>
            </div>
            <div class="col-md-2 align-self-center text-center">To</div>
            <div class="col-md-2">
              <input type="text" name="period_to" id="period_to" class="form-control datemask datepicker"
                autocomplete="off" @if(@$maincontract->period_to) value="{{ date('d/m/Y',
              strtotime($maincontract->period_to)) }}" @elseif(old('period_to')) value="{{ old('period_to') }}" @endif
              required>
            </div>
          </div>

          <div class="row mb-2">
            <div class="col-md-2 align-self-center">ROE</div>
            <div class="col-md-6">
              <input type="text" name="roe" id="roe" class="form-control money text-left" autocomplete="off"
                @if(@$maincontract->roe) value="{{ number_format($maincontract->roe, 2) }}" @elseif(old('roe'))
              value="{{ old('roe') }}" @endif required>
            </div>
          </div>

          <div class="row my-5 justify-content-center">
            <div class="col-md-2 align-self-center text-center"><button class="btn btn-primary">Add</button></div>
          </div>

        </form>

        <div class="card">
          <div class="card-body">
            <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>Main Contract</th>
                  <th>U/W Year</th>
                  <th>COB</th>
                  <th>Contract Description</th>
                  <th>EGNPI</th>
                  <th>Currency</th>
                  <th>Period</th>
                  <th>ROE</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id="tbody_master_contract">
                @if (@$maincontracts)
                @foreach ($maincontracts as $mc)
                <tr>
                  <td>{{ $mc->main_contract }}</td>
                  <td>{{ $mc->u_w_year }}</td>
                  <td>{{ $mc->getcob->code }} - {{ $mc->getcob->description }}</td>
                  <td>{{ $mc->contract_description }}</td>
                  <td>{{ number_format($mc->egnpi, 2) }}</td>
                  <td>{{ $mc->getcurrency->code }} - {{ $mc->getcurrency->symbol_name }}</td>
                  <td>
                    {{ date('d/m/Y', strtotime($mc->period_from)) }}
                    -
                    {{ date('d/m/Y', strtotime($mc->period_to)) }}</td>
                  <td>{{ number_format($mc->roe, 2) }}</td>
                  <td>
                    <div class="dropdown">
                      <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Add
                      </a>

                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                        <button class="dropdown-item" type="button" onclick="addLayer({{ $mc->id }})">
                          Add Layer
                        </button>
                        <button class="dropdown-item" type="button" onclick="addSpreading({{ $mc->id }})">
                          Add Spreading COB
                        </button>
                      </div>
                    </div>
                  </td>
                </tr>
                @endforeach
                @endif

              </tbody>
            </table>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>