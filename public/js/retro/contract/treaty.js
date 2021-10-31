function open_incoming_panel() {
    $("#incoming_panel_modal").modal("toggle");
}
function open_edit_detail_data() {
    $("#edit_detail_data_modal").modal("toggle");
}

function append_soa_borderaux(data) {
    var no_data = $("#tbody_soa_borderaux tr").length + 1;
    $("#tbody_soa_borderaux").append(
        `
        <tr id="tr_soa_borderaux${data.id}">
            <td>${no_data}</td>
            <td>${dateFormat(data.document_date)}</td>
            <td></td>
            <td>${dateFormat(data.production_date)}</td>
            <td>
                <button class="btn btn-sm btn-warning">Cancel Replace</button>
                <button class="btn btn-sm btn-success"
                    onclick="open_detail_data(${data.id})">
                    Show Detail
                </button>
                <button class="btn btn-sm btn-primary"
                    onclick="open_incoming_panel()">
                    Process Data
                </button>
                <button type="button" class="btn btn-sm btn-danger"
                    onclick="delete_document(${data.id})">Delete</button>
            </td>
        </tr>
        `
    );
}

function delete_soa_borderaux(id) {
    var child = $("#tr_soa_borderaux" + id)
        .closest("tr")
        .nextAll();
    child.each(function () {
        var idx = $(this).children("td")[0];
        idx.innerHTML = parseFloat(idx.innerHTML) - 1;
    });
    $("#tr_soa_borderaux" + id).remove();
}

async function create_document(data) {
    var _data = {
        contract_id: data.contract_id.value,
        document_date: data.document_date.value,
        quarter: data.quarter.value,
        year: data.year.value,
        production_date: data.production_date.value,
    };

    var res = await axios
        .post("/retro/contract/treaty", _data)
        .then((res) => res.data);
    if (res) {
        $("#form_soa_borderaux")[0].reset();
        append_soa_borderaux(res);
        toastr.success("SOA & Borderaux Created!");
    }
}

function delete_document(id) {
    swal({
        title: "Do you want to delete this document?",
        showCancelButton: true,
        confirmButtonText: "Delete",
        confirmButtonColor: "#d33",
    }).then(async (result) => {
        if (result.value) {
            var res = await axios
                .delete("/retro/contract/treaty/" + id)
                .then((res) => res.data);
            if (res) {
                delete_soa_borderaux(id);
                toastr.success("Deleted!");
            }
        }
    });
}

function open_detail_data(id) {
    $("#detail_data").show();
}
