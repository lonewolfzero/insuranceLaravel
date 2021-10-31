<div class="card mb-2">
  <div class="card-body">
    <div class="row">
      <div class="col-12 mb-2 text-center">
        <h4 class="font-weight-bolder">{{ $title }}</h4>
      </div>
      <div class="col-12" style="position: relative; height: 300px; overflow: auto; display: block;">
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              @foreach ($headers as $head)
              <th>{{ $head }}</th>
              @endforeach
            </tr>
          </thead>
          <tbody>
            @foreach ($data as $dt)
            <tr>
              <td>{{ $loop->iteration }}</td>
              @foreach ($cells as $cell)
              @if ($loop->iteration !== 1)
              <td>
                @if ($cell['type']=="date")
                {{ date('d/m/Y',strtotime($dt->{$cell['name']})) }}
                @elseif($cell['type']=="money")
                <span class="{{ $cell['type'] }}">{{ $dt->{$cell['name']} }}</span>
                @else
                {{ $dt->{$cell['name']} }}
                @endif
              </td>
              @endif
              @endforeach
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>