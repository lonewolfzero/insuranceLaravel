<div class="table-responsive">
  <table id="felookupTable2" class="table table-bordered table-striped w-100" style="overflow-x:auto;">
    <thead>
      <tr>
        @if (!empty($headers))
        @foreach ($headers as $head)
        <th>{{ $head }}</th>
        @endforeach
        @endif
      </tr>
    </thead>
    <tbody>
      @if (!empty($data))
      @foreach ($data as $dt)
      <tr>
        @foreach ($column as $col)
        @if ($col['one'] == 'action')

        <td>

          <div class="d-flex">
            <form action="{{ url($url ?? $dt->url) }}" method="get">

              @if (@$custom_id)

              @if (@$dt->{$custom_id}->id)
              <input type="hidden" name="id" value="{{ base64_encode($dt->{$custom_id}->id)}}">
              @else
              <input type="hidden" name="registration" value="{{ base64_encode($dt->id)}}">
              @endif

              @else
              <input type="hidden" name="id" value="{{ base64_encode($dt->id) }}">
              @endif

              <button class="btn" type="submit">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="blue" class="bi bi-display"
                  viewBox="0 0 16 16">
                  <path
                    d="M0 4s0-2 2-2h12s2 0 2 2v6s0 2-2 2h-4c0 .667.083 1.167.25 1.5H11a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1h.75c.167-.333.25-.833.25-1.5H2s-2 0-2-2V4zm1.398-.855a.758.758 0 0 0-.254.302A1.46 1.46 0 0 0 1 4.01V10c0 .325.078.502.145.602.07.105.17.188.302.254a1.464 1.464 0 0 0 .538.143L2.01 11H14c.325 0 .502-.078.602-.145a.758.758 0 0 0 .254-.302 1.464 1.464 0 0 0 .143-.538L15 9.99V4c0-.325-.078-.502-.145-.602a.757.757 0 0 0-.302-.254A1.46 1.46 0 0 0 13.99 3H2c-.325 0-.502.078-.602.145z" />
                </svg>
              </button>
            </form>

            @if(!empty($delete_url))
            <form action="{{ url($delete_url, $dt->id)}}" method="post">
              @method('DELETE')
              @csrf
              <button class="btn" type="submit" onclick="return confirm('Are you sure you want to delete this item?');">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-trash"
                  viewBox="0 0 16 16">
                  <path
                    d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                  <path fill-rule="evenodd"
                    d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                </svg>
              </button>
            </form>
            @endif

          </div>
        </td>

        @elseif(@$col['four'] != "")

        @if (gettype($col['four']) == "array")
        <td>
          @foreach ($col['four'] as $item)
          {{ @$dt->{$col['one']}->{$col['two']}->{$col['three']}->{$item} }} @if (count($col['four']) >
          $loop->iteration) - @endif
          @endforeach
        </td>
        @else
        <td>
          @if (@$col['type'] == 'date')
          {{ date('d/m/Y',strtotime(@$dt->{$col['one']}->{$col['two']}->{$col['three']}->{$col['four']})) }}
          @elseif (@$col['type'] == 'money')
          @php
          $string = str_replace(' ', '-', $dt->{$col['one']}->{$col['two']}->{$col['three']}->{$col['four']});

          $stringtest=preg_replace('/[^A-Za-z0-9\-]/', '', $string);
          @endphp
          {{
          number_format((float)@$stringtest, 2, '.', ',')
          }}
          @else
          {{ @$dt->{$col['one']}->{$col['two']}->{$col['three']}->{$col['four']} }}
          @endif
        </td>
        @endif

        @elseif(@$col['three'] != "")

        @if (gettype($col['three']) == "array")
        <td>
          @foreach ($col['three'] as $item)
          {{ @$dt->{$col['one']}->{$col['two']}->{$item} }} @if (count($col['three']) > $loop->iteration) - @endif
          @endforeach
        </td>
        @else
        <td>
          @if (@$col['type'] == 'date')
          {{ date('d/m/Y',strtotime(@$dt->{$col['one']}->{$col['two']}->{$col['three']})) }}
          @elseif (@$col['type'] == 'money')
          {{ number_format(@$dt->{$col['one']}->{$col['two']}->{$col['three']}, 2, '.', ',') }}
          @else
          {{ @$dt->{$col['one']}->{$col['two']}->{$col['three']} }}
          @endif
        </td>
        @endif

        @elseif(@$col['two'] != "")

        @if (gettype($col['two']) == "array")
        <td>
          @foreach ($col['two'] as $item)
          {{ @$dt->{$col['one']}->{$item} }} @if (count($col['two']) > $loop->iteration) - @endif
          @endforeach
        </td>
        @else
        <td>
          @if (@$col['type'] == 'date')
          {{ date('d/m/Y',strtotime(@$dt->{$col['one']}->{$col['two']})) }}
          @elseif (@$col['type'] == 'money')
          {{ number_format(@$dt->{$col['one']}->{$col['two']}, 2, '.', ',') }}
          @else
          {{ @$dt->{$col['one']}->{$col['two']} }}
          @endif
        </td>
        @endif

        @else

        @if (gettype($col['one']) == "array")
        <td>
          @foreach ($col['one'] as $item)
          {{ @$dt->{$item} }} @if (count($col['one']) > $loop->iteration) - @endif
          @endforeach
        </td>
        @else
        <td>
          @if (@$col['type'] == 'date')
          {{ date('d/m/Y',strtotime(@$dt->{$col['one']})) }}
          @elseif (@$col['type'] == 'money')
          @php
          $string = str_replace(' ', '-', @$dt->{$col['one']});

          $stringtest=preg_replace('/[^A-Za-z0-9\-]/', '', $string);
          @endphp
          {{ number_format((float)@$stringtest, 2, '.', ',') }}
          @elseif (@$col['type'] == 'percent')
          {{ number_format((float)@$dt->{$col['one']}, 2, '.', ',') }}
          @else
          {{ @$dt->{$col['one']} }}
          @endif
        </td>
        @endif

        @endif
        @endforeach
      </tr>
      @endforeach
      @endif
    </tbody>

  </table>
</div>