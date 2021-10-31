$(".e1").select2({
    width: "100%",
});

//#region mask
$(".datepicker").datepicker({
    autoclose: true,
    todayHighlight: true,
    zIndexOffset: 9999,
    format: "dd/mm/yyyy",
});

$(".yearpicker").datepicker({
    autoclose: true,
    zIndexOffset: 9999,
    format: "yyyy",
    viewMode: "years",
    minViewMode: "years",
});

$(".datemask").mask("00/00/0000", {
    placeholder: "dd/mm/yyyy",
    separator: "/",
});

$(".yearmask").mask("0000", {
    placeholder: "yyyy",
});

$(".money").inputmask({
    // rightAlign: false,
    // digits: 4,
    alias: "decimal",
    groupSeparator: ".",
    autoGroup: true,
    autoUnmask: true,
});

$(".percentage").mask("#P99", {
    reverse: true,
    translation: {
        P: { pattern: /\./, optional: true },
    },
    onChange: function (value, e) {
        e.target.value = value
            .replace(/(?!^)-/g, "")
            .replace(/^,/, "")
            .replace(/^-,/, "-");
    },
});
//#region mask

function moneyFormat(val) {
    return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

//#region master contract
function treaty_code() {
    var ty = $("#treaty_year").val();
    var cb = $("#ceding_broker").val();
    $("#treaty_code").val(ty + "/" + cb);
}
$("#ceding_broker, #treaty_year").on("input", function () {
    if ($("#treaty_year").val() != "" && $("#ceding_broker").val() != null) {
        treaty_code();
    }
});
//#region master contract

//#region detail contract
$("#treaty_year, #ceding_broker, #ceding_company, #cob, #koc").on(
    "input",
    async function (e) {
        e.preventDefault();
        if (
            $("#treaty_year").val() != "" &&
            $("#ceding_broker").val() != null &&
            $("#ceding_company").val() != null &&
            $("#cob").val() != null &&
            $("#koc").val() != null
        ) {
            var ty = $("#treaty_year").val();
            var cb = $("#ceding_broker").val();
            var cp = $("#ceding_company").val();
            var cob = $("#cob").val();
            var koc = $("#koc").val();
            $("#id_detail_contract").val(
                ty + "/" + cb + "/" + cp + "/" + cob + "/" + koc
            );
        }
    }
);
//#region detail contract

//#region lead
$("#leader_member_id").change(function (e) {
    var lead = $("#leader_member_id").val();
    if (lead == 0) {
        $("#leader_member_status1").prop("disabled", false);
        $("#leader_member_status1").prop("checked", true);
        $("#leader_member_status2").prop("disabled", true);
    } else {
        $("#leader_member_status2").prop("checked", true);
        $("#leader_member_status2").prop("disabled", false);
        $("#leader_member_status1").prop("disabled", true);
    }
});
//#region lead

//#region net or line
$("#net_or").mask("#,##0P00", {
    reverse: true,
    translation: {
        P: { pattern: /\./, optional: true },
    },
    onChange: function (value, e) {
        e.target.value = value
            .replace(/(?!^)-/g, "")
            .replace(/^,/, "")
            .replace(/^-,/, "-");
    },
});
$("#koc, #treaty_limit, #gross_or").on("input", function (e) {
    // QS
    if ($("#koc").val() == 12) {
        $("#gross_or").inputmask("remove");

        if ($("#treaty_limit").val() != "" && $("#gross_or").val() != "") {
            var tl = parseInt($("#treaty_limit").val());
            var go = parseFloat($("#gross_or").val());
            $("#net_or")
                .val(parseFloat((tl * go) / 100).toFixed(2))
                .trigger("input");
            $("#line").val(0);
        }
    }

    // SURPLUS
    else if ($("#koc").val() == 13) {
        $("#gross_or").inputmask({
            // rightAlign: false,
            // digits: 4,
            alias: "decimal",
            groupSeparator: ".",
            autoGroup: true,
            autoUnmask: true,
        });

        if ($("#treaty_limit").val() != "" && $("#gross_or").val() != "") {
            var tl = parseInt($("#treaty_limit").val());
            var go = parseInt($("#gross_or").val());
            $("#net_or").val(0);
            $("#line").val(parseInt(tl / go));
        }
    }
});
//#region net or line

//#region backup retro
var backup_retro_list = [];
function delete_backup_retro(id) {
    $("#backup_retro_row" + id).remove();
}

$("#retro_contract_no, #retro_percentage").on("input", function () {
    var rcn = $("#retro_contract_no").val();
    var rp = $("#retro_percentage").val();

    if (rcn != null && rp != "") {
        $("#add_retro").prop("disabled", false);
    } else {
        $("#add_retro").prop("disabled", true);
    }
});

$("#add_retro").click(function (e) {
    e.preventDefault();
    var rcn = $("#retro_contract_no").val();
    var rct = $("#retro_contract_no option:selected").text();
    var rp = $("#retro_percentage").val();
    var no_data = $("#tbody_backup_retro tr").length + 1;

    backup_retro_list.push({
        retro_contract_no: rcn,
        retro_percentage: rp,
    });

    $("#tbody_backup_retro").append(
        `
        <tr id="backup_retro_row${no_data}">
            <input type="hidden" value="0" name="retro_ids[]">
            <input type="hidden" value="${rcn}" name="retro_contract_no[]" />
            <input type="hidden" value="${rp}" name="retro_percentage[]" />
            <td>${rct}</td>
            <td>${rp}</td>
            <td>
                <button class="btn" onclick="delete_backup_retro(${no_data})">
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

    $("#retro_contract_no").val("").change();
    $("#retro_percentage").val("");
    $("#add_retro").prop("disabled", true);
});
//#region backup retro

//#region sliding scale
var sliding_scale_list = [];
function delete_sliding_scale(id) {
    $("#sliding_scale_row" + id).remove();
}

$("#r_i_comm, #loss_ratio_first, #loss_ratio_second").on("input", function () {
    var ric = $("#r_i_comm").val();
    var lrf = $("#loss_ratio_first").val();
    var lrs = $("#loss_ratio_second").val();

    if (ric != "" && lrf != "" && lrs != "") {
        $("#add_sliding").prop("disabled", false);
    } else {
        $("#add_sliding").prop("disabled", true);
    }
});

$("#add_sliding").click(function (e) {
    e.preventDefault();
    var ric = $("#r_i_comm").val();
    var lrf = $("#loss_ratio_first").val();
    var lrs = $("#loss_ratio_second").val();
    var isdc = $("#id_sub_detail_contract").val();
    var no_data = $("#tbody_sliding_scale tr").length + 1;

    sliding_scale_list.push({
        id_sub_detail_contract: isdc,
        r_i_comm: ric,
        loss_ratio_first: lrf,
        loss_ratio_second: lrs,
    });

    $("#tbody_sliding_scale").append(
        `
        <tr id="sliding_scale_row${no_data}">
            <input type="hidden" value="0" name="sliding_ids[]">
            <input type="hidden" value="${ric}" name="sliding_r_i_comm[]" />
            <input type="hidden" value="${lrf}" name="sliding_loss_ratio_first[]" />
            <input type="hidden" value="${lrs}" name="sliding_loss_ratio_second[]" />
            <td>${ric}</td>
            <td>${lrf} - ${lrs}</td>
            <td>
                <button class="btn" onclick="delete_sliding_scale(${no_data})">
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

    $("#r_i_comm").val("");
    $("#loss_ratio_first").val("");
    $("#loss_ratio_second").val("");
    $("#add_sliding").prop("disabled", true);
});
//#region sliding scale

//#region loss participation
var loss_participation_list = [];
function delete_loss_participation(id) {
    $("#loss_participation_row" + id).remove();
}

$("#par_share, #par_loss_ratio_first, #par_loss_ratio_second").on(
    "input",
    function () {
        var ps = $("#par_share").val();
        var lrf = $("#par_loss_ratio_first").val();
        var lrs = $("#par_loss_ratio_second").val();

        if (ps != "" && lrf != "" && lrs != "") {
            $("#add_loss_participation").prop("disabled", false);
        } else {
            $("#add_loss_participation").prop("disabled", true);
        }
    }
);

$("#add_loss_participation").click(function (e) {
    e.preventDefault();
    var ps = $("#par_share").val();
    var lrf = $("#par_loss_ratio_first").val();
    var lrs = $("#par_loss_ratio_second").val();
    var isdc = $("#id_sub_detail_contract").val();
    var no_data = $("#tbody_loss_participation tr").length + 1;

    loss_participation_list.push({
        id_sub_detail_contract: isdc,
        share: ps,
        loss_ratio_first: lrf,
        loss_ratio_second: lrs,
    });

    $("#tbody_loss_participation").append(
        `
        <tr id="loss_participation_row${no_data}">
            <input type="hidden" value="0" name="par_ids[]">
            <input type="hidden" value="${ps}" name="par_share[]" />
            <input type="hidden" value="${lrf}" name="par_loss_ratio_first[]" />
            <input type="hidden" value="${lrs}" name="par_loss_ratio_second[]" />
            <td>${ps}</td>
            <td>${lrf} - ${lrs}</td>
            <td>
                <button class="btn" onclick="delete_loss_participation(${no_data})">
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

    $("#par_share").val("");
    $("#par_loss_ratio_first").val("");
    $("#par_loss_ratio_second").val("");
    $("#add_loss_participation").prop("disabled", true);
});
//#region loss participation

//#region total account period
$("#submission, #confirmation, #settlement").on("input", function () {
    var sub = $("#submission").val();
    var con = $("#confirmation").val();
    var set = $("#settlement").val();
    if (sub != "" && con != "" && set != "") {
        $("#total_account_period").val(
            parseInt(sub) + parseInt(con) + parseInt(set)
        );
    }
});
//#region total account period

//#region cancel sub detail contract
$("#cancel_sub_detail_contract").click(function (e) {
    e.preventDefault();
});
//#region cancel sub detail contract

//region period to start date
$("#period_from").change(function () {
    var to_date = $("#period_from").val().split("/");
    to_date[0] = parseInt(to_date[0]) + 1;
    to_date = to_date.join("/");
    $("#period_to").datepicker("setStartDate", to_date);
});
//end of region period to start date

//region treaty year warning
$("#treaty_year").change(function () {
    console.log(new Date().getFullYear() + 9);
    if (
        this.value <= new Date().getFullYear() - 2 ||
        this.value >= new Date().getFullYear() + 2
    ) {
        $("#treaty_year").addClass("is-invalid");
    } else {
        $("#treaty_year").removeClass("is-invalid");
    }
});
//end of region treaty year warning

//region vat checkbox
$("#vat_check").change(function () {
    $("#vat_percentage").prop("readonly", !this.checked);
});
//end of region vat checkbox

//region set form url
if ($("#sub_detail_id").val()) {
    var id = $("#sub_detail_id").val();
    $("#prop_form").prop("action", "/treaty/prop/update/" + id);
    $("#btn_new_doc").show();
}
//end of region set form url

if ($("#has_soa").val() != null && $("#has_soa").val() > 0) {
    $("#prop_form input").prop("disabled", true);
    $("#prop_form textarea").prop("disabled", true);
    $("#prop_form select").prop("disabled", true);
    $("#prop_form button").prop("disabled", true);
}

function newDocument() {}
