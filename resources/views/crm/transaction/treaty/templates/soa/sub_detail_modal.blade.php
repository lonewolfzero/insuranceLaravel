<div class="modal fade" id="sub_detail_modal" tabindex="-1" user="dialog" aria-labelledby="addlocationLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-xl" user="document">
    <div class="modal-content bg-light-gray">
      <div class="modal-header bg-gray">
        <h5 class="modal-title" id="addlocationLabel">{{ __('Sub Detail Contract') }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <div class="card">
          <div class="card-body">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>ID Sub Detail Contract</th>
                  <th>COB</th>
                  <th>Nasionalre Share</th>
                  <th>Nasionalre Share Of</th>
                  <th>R/I Comm Gross</th>
                  <th>R/I Comm Nett</th>
                  <th>VAT</th>
                  <th>Remark</th>
                  <th>Option</th>
                </tr>
              </thead>
              <tbody id="tbody_sub_detail_modal"></tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="selectSubDetail()">Submit</button>
      </div>
    </div>
  </div>
</div>