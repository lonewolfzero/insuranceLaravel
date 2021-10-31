@if (@$ver)
<div class="row mb-2">
  <div class="col-md-2 align-self-center">ID Layer</div>
  <div class="col-md-6">
    <input type="text" name="id_layer" class="disabled_id_layer form-control" disabled>
  </div>
  <div class="col"></div>
  <div class="col-md-2"><button type="button" class="btn btn-primary" onclick="backToLayer()">Prev</button>
  </div>
</div>

<div class="row mb-2">
  <div class="col-md-2 align-self-center">Our Contract</div>
  <div class="col-md-6">
    <input type="text" name="our_contract" class="disabled_our_contract form-control" disabled>
  </div>
</div>

<div class="row mb-2">
  <div class="col-md-2 align-self-center">Kind Of Treaty</div>
  <div class="col-md-6">
    <input type="text" name="kind_of_treaty" class="disabled_kind_of_treaty form-control" disabled>
  </div>
</div>

<div class="row mb-2">
  <div class="col-md-2 align-self-center">Type Coverage</div>
  <div class="col-md-6">
    <select name="type_coverage" class="disabled_type_coverage form-control" disabled>
      <option value="" disabled selected>Select Type Of Coverage</option>
      @foreach ($typeOfCoverage as $toc)
      <option value="{{ $toc->id }}">{{ $toc->code }} - {{ $toc->description }}</option>
      @endforeach
    </select>
  </div>
</div>

<div class="row mb-2">
  <div class="col-md-2 align-self-center">Mindep 100%</div>
  <div class="col-md-6">
    <input type="text" name="mindep_100" class="disabled_mindep_100 form-control money text-left" disabled>
  </div>
</div>

<div class="row mb-2">
  <div class="col-md-2 align-self-center">Share</div>
  <div class="col-md-6">
    <input type="text" name="share" class="disabled_share form-control money text-left" disabled>
  </div>
</div>

<div class="row mb-2">
  <div class="col-md-2 align-self-center">Mindep Retro</div>
  <div class="col-md-6">
    <input type="text" name="mindep_retro" class="disabled_mindep_retro form-control money text-left" disabled>
  </div>
</div>

<div class="row mb-2">
  <div class="col-md-2 align-self-center">With Holding Tax</div>
  <div class="col-md-6">
    <input type="text" name="withholding_tax" class="disabled_withholding_tax form-control money text-left" disabled>
  </div>
</div>

<div class="row mb-2">
  <div class="col-md-2 align-self-center">Limit Loss</div>
  <div class="col-md-6">
    <input type="text" name="limit_loss" class="disabled_limit_loss form-control money text-left" disabled>
  </div>
</div>

<div class="row mb-2">
  <div class="col-md-2 align-self-center">Deductible</div>
  <div class="col-md-6">
    <input type="text" name="deductible" class="disabled_deductible form-control money text-left" disabled>
  </div>
</div>

<div class="row mb-2">
  <div class="col-md-2 align-self-center">Aggregate</div>
  <div class="col-md-6">
    <input type="text" name="aggregate" class="disabled_aggregate form-control money text-left" disabled>
  </div>
</div>

<div class="row mb-2">
  <div class="col-md-2 align-self-center">Adj Rate</div>
  <div class="col-md-6">
    <input type="text" name="adj_rate" class="disabled_adj_rate form-control money text-left" disabled>
  </div>
</div>

@else

<div class="row mb-2">
  <div class="col-md-2 align-self-center">ID Layer</div>
  <div class="col-md-4">
    <input type="text" name="id_layer" class="disabled_id_layer form-control" disabled>
  </div>
  <div class="col-md-2 align-self-center">Mindep Retro</div>
  <div class="col-md-4">
    <input type="text" name="mindep_retro" class="disabled_mindep_retro form-control" disabled>
  </div>
</div>

<div class="row mb-2">
  <div class="col-md-2 align-self-center">Our Contract</div>
  <div class="col-md-4">
    <input type="text" name="our_contract" class="disabled_our_contract form-control" disabled>
  </div>
  <div class="col-md-2 align-self-center">With Holding Tax</div>
  <div class="col-md-4">
    <input type="text" name="withholding_tax" class="disabled_withholding_tax form-control money text-left" disabled>
  </div>
</div>

<div class="row mb-2">
  <div class="col-md-2 align-self-center">Kind Of Treaty</div>
  <div class="col-md-4">
    <input type="text" name="kind_of_treaty" class="disabled_kind_of_treaty form-control" disabled>
  </div>
  <div class="col-md-2 align-self-center">Limit Loss</div>
  <div class="col-md-4">
    <input type="text" name="limit_loss" class="disabled_limit_loss form-control money text-left" disabled>
  </div>
</div>

<div class="row mb-2">
  <div class="col-md-2 align-self-center">Type Coverage</div>
  <div class="col-md-4">
    <select name="type_coverage" class="disabled_type_coverage form-control" disabled>
      <option value="" disabled selected>Select Type Of Coverage</option>
      @foreach ($typeOfCoverage as $toc)
      <option value="{{ $toc->id }}">{{ $toc->code }} - {{ $toc->description }}</option>
      @endforeach
    </select>
  </div>
  <div class="col-md-2 align-self-center">Deductible</div>
  <div class="col-md-4">
    <input type="text" name="deductible" class="disabled_deductible form-control money text-left" disabled>
  </div>
</div>

<div class="row mb-2">
  <div class="col-md-2 align-self-center">Mindep 100%</div>
  <div class="col-md-4">
    <input type="text" name="mindep_100" class="disabled_mindep_100 form-control money text-left" disabled>
  </div>
  <div class="col-md-2 align-self-center">Aggregate</div>
  <div class="col-md-4">
    <input type="text" name="aggregate" class="disabled_aggregate form-control money text-left" disabled>
  </div>
</div>

<div class="row mb-2">
  <div class="col-md-2 align-self-center">Share</div>
  <div class="col-md-4">
    <input type="text" name="share" class="disabled_share form-control money text-left" disabled>
  </div>
  <div class="col-md-2 align-self-center">Adj Rate</div>
  <div class="col-md-4">
    <input type="text" name="adj_rate" class="disabled_adj_rate form-control money text-left" disabled>
  </div>
</div>

@endif