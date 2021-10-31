<div class="modal fade" id="copy_modal" tabindex="-1" user="dialog" aria-labelledby="addlocationLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-xl" user="document">
    <div class="modal-content bg-light-gray">
      <div class="modal-header bg-gray">
        <h5 class="modal-title" id="addlocationLabel">{{ __('Copy') }}</h5>
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
                  <td>No</td>
                  <td>ID SOA</td>
                  <td>Ceding Broker</td>
                  <td>KOC</td>
                  <td>COB</td>
                  <td>Action</td>
                </tr>
              </thead>
              <tbody id="tbody_copy_soa"></tbody>
            </table>

          </div>
        </div>

      </div>

    </div>
  </div>
</div>