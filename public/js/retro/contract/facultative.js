function open_incoming_panel() {
    $("#incoming_panel_modal").modal("toggle");
}

function open_edit_detail_data() {
    $("#edit_detail_data_modal").modal("toggle");
}

function open_detail_data(id) {
    $("#detail_data").show();
}

//region premium and claim
var doc_type = $("#doc_type").val();
$(".nav-tabs li a").click(function (e) {
    var href = $(this).attr("href");
    var id = href.substring(1);
    doc_type = id;
});

function append_document(data) {
    var no_data = $("#tbody_" + doc_type + " tr").length + 1;
    $("#tbody_" + doc_type).append(
        `
        <tr id="tr_${doc_type}${data.id}">
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

function delete_row(id) {
    var child = $("#tr_" + doc_type + id)
        .closest("tr")
        .nextAll();
    child.each(function () {
        var idx = $(this).children("td")[0];
        idx.innerHTML = parseFloat(idx.innerHTML) - 1;
    });
    $("#tr_" + doc_type + id).remove();
}

async function create_document(data) {
    var _data = {
        contract_id: data.contract_id.value,
        document_date: data.document_date.value,
        production_date: data.production_date.value,
    };

    var res = await axios
        .post("/retro/contract/facultative/" + doc_type, _data)
        .then((res) => res.data);
    if (res) {
        $("#form_" + doc_type)[0].reset();
        append_document(res);
        toastr.success("Document Created!");
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
                .delete("/retro/contract/facultative/" + doc_type + "/" + id)
                .then((res) => res.data);
            if (res) {
                delete_row(id);
                toastr.success("Deleted!");
            }
        }
    });
}
//end of region premium and claim

//region retrocession
function delete_retrocession(id) {
    swal({
        title: "Do you want to delete this retrocession?",
        showCancelButton: true,
        confirmButtonText: "Delete",
        confirmButtonColor: "#d33",
    }).then(async (result) => {
        if (result.value) {
            var res = await axios
                .delete("/retro/contract/facultative/retrocession/" + id)
                .then((res) => res.data);
            if (res) {
                $("#tr_retrocession" + id).remove();
                toastr.success("Deleted!");
            }
        }
    });
}

function append_retrocession(data) {
    $("#tbody_retrocession").append(
        `
    <tr id="tr_retrocession${data.id}">
        <td>${data.getceding.code} - ${data.getceding.name}</td>
        <td>${moneyFormat(data.share)}%</td>
        <td>${moneyFormat(data.commission)}%</td>
        <td>${moneyFormat(data.overriding_by_gross_premium)}%</td>
        <td>${moneyFormat(data.overriding_by_nett_premium)}%</td>
        <td>
            <button type="button" class="btn btn-sm btn-primary" 
            onclick="add_member(${data.id})">
                Add Member
            </button>
            <button type="button" class="btn btn-sm btn-danger" 
            onclick="delete_retrocession(${data.id})">
                Delete
            </button>
        </td>
    </tr>
    `
    );
}

async function create_retrocession(data) {
    var _data = {
        contract_id: data.contract_id.value,
        retrocession: data.retrocession.value,
        share: data.share.value,
        commission: data.commission.value,
        overriding_by_gross_premium: data.overriding_by_gross_premium.value,
        overriding_by_nett_premium: data.overriding_by_nett_premium.value,
    };

    var res = await axios
        .post("/retro/contract/facultative/retrocession", _data)
        .then((res) => res.data);
    if (res) {
        $("#form_retrocession")[0].reset();
        $("#form_retrocession .e1").val("").change();
        append_retrocession(res);
        toastr.success("Retrocession Created!");
    }
}
//end of region retrocession

function append_member(m) {
    $("#tbody_member_panel").append(
        `
    <tr id="tr_member${m.id}">
        <td>${m.getceding.code} - ${m.getceding.name}</td>
        <td>${moneyFormat(m.share)}%</td>
        <td>${m.rating}</td>
        <td>${m.rater}</td>
        <td>
            <button type="button" class="btn btn-sm" 
                onclick="delete_member(${m.id})">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-trash"
                viewBox="0 0 16 16">
                <path
                    d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                <path fill-rule="evenodd"
                    d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                </svg>
            </button>
        </td>
    </tr>
    `
    );
}

function delete_member(id) {
    swal({
        title: "Do you want to delete this retrocession?",
        showCancelButton: true,
        confirmButtonText: "Delete",
        confirmButtonColor: "#d33",
    }).then(async (result) => {
        if (result.value) {
            $("body").addClass("loading");
            var res = await axios
                .delete("/retro/contract/facultative/retrocession/member/" + id)
                .then((res) => res.data);
            if (res) {
                $("#tr_member" + id).remove();
                toastr.success("Deleted!");
            }
            $("body").removeClass("loading");
        }
    });
}

async function add_member(id) {
    $("body").addClass("loading");
    var members = await axios
        .get("/retro/contract/facultative/retrocession/member/" + id)
        .then((res) => res.data);

    $("#tbody_member_panel tr").remove();
    _.each(members, (m) => append_member(m));

    $(".retrocession_id").val(id);
    $("body").removeClass("loading");
    $("#member_panel_modal").modal("toggle");
}

async function create_member(data) {
    $("body").addClass("loading");
    var _data = {
        retrocession_id: data.retrocession_id.value,
        member: data.member.value,
        share: data.share.value,
        rating: data.rating.value,
        rater: data.rater.value,
    };
    console.log(
        "🚀 ~ file: facultative.js ~ line 226 ~ create_member ~ _data",
        _data
    );

    var member = await axios
        .post("/retro/contract/facultative/retrocession/member", _data)
        .then((res) => res.data);

    append_member(member);
    $("#form_member_panel")[0].reset();
    $("#form_member_panel .e1").val("").change();
    $("body").removeClass("loading");
    toastr.success("Member Created!");
}
