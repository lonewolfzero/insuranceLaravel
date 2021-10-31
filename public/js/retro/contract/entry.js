var r_share_list = [];

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

async function delete_member(id) {
    var res = await axios
        .delete("/retro/contract/member/" + id)
        .then((res) => res.data);
    $("#tr_member" + id).remove();
    if (res == "deleted") toastr.success("Member Deleted!");
}

async function add_member(id) {
    var members = await axios
        .get("/retro/contract/member/" + id)
        .then((res) => res.data);

    $("#tbody_member_panel tr").remove();
    _.each(members, (m) => append_member(m));

    $(".retrocession_id").val(id);
    $("#member_panel_modal").modal("toggle");
}

async function create_member(data) {
    var _data = {
        retrocession_id: data.retrocession_id.value,
        member: data.member.value,
        share: data.share.value,
        rating: data.rating.value,
        rater: data.rater.value,
    };

    var member = await axios
        .post("/retro/contract/member", _data)
        .then((res) => res.data);

    append_member(member);
    $("#form_member_panel")[0].reset();
    $("#member").val("").change();
    $("#rating").val("").change();
    toastr.success("Member Created!");
}

//region type dropdown box
$("#type").change(function () {
    $("#bottom").show();
    if (this.value.includes("Facultative")) {
        $("#treaty").hide();
        $("#facultative").show();
    } else {
        $("#facultative").hide();
        $("#treaty").show();
    }
});
//end of region type dropdown box

//region document ready
$(document).ready(function () {
    var type = $("#type").val();
    if (type) {
        $("#bottom").show();
        if (type.includes("Facultative")) {
            $("#treaty").hide();
            $("#facultative").show();
        } else {
            $("#facultative").hide();
            $("#treaty").show();
        }
    }

    var id = $("#contract_id").val();
    if (id != "") {
        $("#contract_name").attr("readonly", "readonly");
        $("#form_contract").attr("action", "/retro/contract/update/" + id);
    }

    var r_share = $("input[name='r_share[]']");
    console.log("🚀 ~ file: entry.js ~ line 39 ~ r_share", r_share);
    if (r_share.length > 0) {
        _.each(r_share, function (s, i) {
            console.log(s.value);
            r_share_list.push({
                c_id: parseInt($("input[name='r_id[]']")[i].value),
                amount: parseFloat(s.value),
            });
        });
        console.log(
            "🚀 ~ file: entry.js ~ line 45 ~ r_share_list",
            r_share_list
        );
    }
});
//end of region document ready

//region commission panel
function delete_commission(id) {
    $("#tr_commission" + id).remove();
}
$(
    "#commission_panel_cob, #commission, #overriding_by_gross_premium, #overriding_by_nett_premium"
).on("input", function () {
    var cob = $("#commission_panel_cob").val();
    var c = $("#commission").val();
    var gp = $("#overriding_by_gross_premium").val();
    var np = $("#overriding_by_nett_premium").val();
    if (cob && c != "" && gp != "" && np != "") {
        $("#btn_add_commission").prop("disabled", false);
    } else {
        $("#btn_add_commission").prop("disabled", true);
    }
});

$("#btn_add_commission").click(function () {
    var cob_t = $("#commission_panel_cob option:selected").text();
    var cob = $("#commission_panel_cob").val();
    var c = $("#commission").val();
    var gp = $("#overriding_by_gross_premium").val();
    var np = $("#overriding_by_nett_premium").val();
    var no_data = $("#tbody_commission tr").length + 1;
    $("#commission_panel_cob").val("").change();
    $("#commission").val("");
    $("#overriding_by_gross_premium").val("");
    $("#overriding_by_nett_premium").val("").trigger("input");
    $("#tbody_commission").append(
        `
        <tr id="tr_commission{${no_data}}">
            <input type="hidden" name="c_id[]" value="0">
            <input type="hidden" name="c_cob[]" value="${cob}">
            <input type="hidden" name="c_commission[]" value="${c}">
            <input type="hidden" name="c_gross[]" value="${gp}">
            <input type="hidden" name="c_nett[]" value="${np}">
            <td>${cob_t}</td>
            <td>${moneyFormat(c)}%</td>
            <td>${moneyFormat(gp)}%</td>
            <td>${moneyFormat(np)}%</td>
            <td class="text-center">
                <button type="button" class="btn btn-sm" onclick="delete_commission(${no_data})">
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
});
//end of region commission panel

//region retrocession panel
function delete_retrocession(id) {
    r_share_list.splice(_.findIndex(r_share_list, { c_id: id }), 1);

    $("#total_share").val(moneyFormat(_.sumBy(r_share_list, "amount")));
    $("#tr_retrocession" + id).remove();
}

$("#retrocession, #share").on("input", function () {
    var r = $("#retrocession").val();
    var s = $("#share").val();
    if (r && s != "") {
        $("#btn_add_retrocession").prop("disabled", false);
    } else {
        $("#btn_add_retrocession").prop("disabled", true);
    }
});

$("#btn_add_retrocession").click(function () {
    var r_t = $("#retrocession option:selected").text();
    var r = $("#retrocession").val();
    var s = $("#share").val();
    var no_data = $("#tbody_retrocession tr").length + 1;

    r_share_list.push({ c_id: parseInt(no_data), amount: parseFloat(s) });
    $("#total_share").val(moneyFormat(_.sumBy(r_share_list, "amount")));

    $("#retrocession").val("").change();
    $("#share").val("").trigger("input");

    $("#tbody_retrocession").append(
        `
        <tr id="tr_retrocession${no_data}">
            <input type="hidden" name="r_id[]" value="0">
            <input type="hidden" name="r_retrocession[]" value="${r}">
            <input type="hidden" name="r_share[]" value="${s}">
            <td>${r_t}</td>
            <td>${moneyFormat(s)}%</td>
            <td class="text-center">
                <button type="button" class="btn btn-sm btn-primary" onclick="add_member()" disabled>Add Member</button>
                <button type="button" class="btn btn-sm" onclick="delete_retrocession(${no_data})">
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
});
//end of region retrocession panel
