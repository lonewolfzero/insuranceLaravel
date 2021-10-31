<div class="row mb-3">
  <div class="col-md-3 align-self-center text-center">Date Of Receipt</div>
  <div class="col-md-3">
    <x-input-date-format all="date_of_receipt" :isrequired="true" />
  </div>
  <div class="col-md-3 align-self-center text-center">Date Of Document</div>
  <div class="col-md-3">
    <x-input-date-format all="date_of_document" :isrequired="true" />
  </div>
</div>

<div class="row mb-3">
  <div class="col">
    <div class="card">
      <div class="card-header bg-gray">Description Loss</div>
      <div class="card-body">
        <table class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>No</th>
              <th>Description Loss</th>
              <th>Amount</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody id="tbody_description_loss">
            {{-- <tr>
              <td></td>
              <td></td>
              <td></td>
              <td class="align-middle">
                <button class="btn">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red"
                    class="bi bi-trash align-self-center" viewBox="0 0 16 16">
                    <path
                      d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                    <path fill-rule="evenodd"
                      d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                  </svg>
                </button>
              </td>
            </tr> --}}
          </tbody>
          <tbody>
            <tr>
              <td class="align-middle" colspan="2">
                <x-select-option id="description_loss_select" :master="$lossdesc" text="Select Description Loss"
                  col1="desc_name" :isrequired="false" />
              </td>
              <td><input type="text" class="form-control money text-left" id="description_loss_amount"></td>
              <td class="align-middle text-center">
                <button type="button" class="btn btn-sm btn-primary">Add</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>