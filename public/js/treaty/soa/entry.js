//region global variable
var nasionalre_r_i_comm_gross = "";
var nasionalre_r_i_comm_nett = "";
var nasionalre_share_first = "";
var nasionalre_share_second = "";
var treaty_or_nasionalre = true;
var cancel_replace = false;
var old_data = {};
var old_premium_reserved_list = [];
var columns = [
    "status",
    "version",
    "treaty_gross_premium",
    "treaty_premium_released",
    "treaty_premium_reserved",
    "treaty_interest_on_premium_percentage",
    "treaty_interest_on_premium_amount",
    "treaty_r_i_comm_percentage",
    "treaty_r_i_comm_amount",
    "treaty_overrider_percentage",
    "treaty_overrider_amount",
    "treaty_net_premium",
    "treaty_paid_losses",
    "treaty_claim_recovery",
    "treaty_result",
    "treaty_cash_loss",
    "treaty_common_a_c_xol",
    "treaty_balance",
    "treaty_vat_percentage",
    "treaty_vat",
    "treaty_vat_balance",
    "nasionalre_share",
    "nasionalre_gross_premium",
    "nasionalre_r_i_comm_percentage",
    "nasionalre_r_i_comm_amount",
    "nasionalre_overrider_percentage",
    "nasionalre_overrider_amount",
    "nasionalre_interest_percentage",
    "nasionalre_interest_amount",
    "nasionalre_net_premium",
    "nasionalre_paid_losses",
    "nasionalre_claim_recovery",
    "nasionalre_result",
    "nasionalre_cash_loss",
    "nasionalre_common_a_c_xol",
    "nasionalre_balance",
    "nasionalre_vat_percentage",
    "nasionalre_vat",
    "nasionalre_vat_balance",
];
var list_sub_detail = [];
//end of region global variable

$(document).ready(function () {
    var rncc = $("#reg_num_ceding_company").val();
    var rncb = $("#reg_num_ceding_broker").val();
    if (rncc != null && rncb != null) {
        $("#ceding_company").val(rncc).change();
        $("#select_ceding_company").val(rncc).change();
        $("#ceding_broker").val(rncb).change();
        $("#select_ceding_broker").val(rncb).change().trigger("input");
    }

    _.each($('input[name="premium_reserved_amount[]"]'), function (amn, index) {
        premium_reserved_list.push({
            no_data: $('input[name="premium_reserved_id[]"]')[index].value,
            amount: parseFloat(amn.value),
        });
    });
});

//region treaty summary list
$("#select_ceding_broker, #select_ceding_company, #u_w_year").on(
    "input",
    async function () {
        var cb = $("#select_ceding_broker").val();
        var cc = $("#select_ceding_company").val();
        var uwy = $("#u_w_year").val();
        if ($("#tty_summary").val() == null) {
            $("#tty_summary option[class='options']").remove();
            $("#tty_summary").val("").change();
            await axios
                .post("/treaty/soa/getTreatySummary", {
                    cb: cb,
                    cc: cc,
                    uwy: uwy,
                })
                .then((res) => {
                    _.each(res.data.props, function (value, key) {
                        $("#tty_summary").append(
                            `
                                <option value="${value.id}" class="options">
                                    ${value.id_detail_contract} - ${value.getcob.description}
                                </option>
                            `
                        );
                    });
                });
        }
    }
);
//end of region treaty summary list

//region treaty summary set
$("#tty_summary").change(async function () {
    if (this.value != "") {
        await axios.get("/treaty/prop/show/" + this.value).then((res) => {
            var prop = res.data;
            console.log(
                "🚀 ~ file: entry.js ~ line 108 ~ awaitaxios.get ~ prop",
                prop
            );
            if (
                $("#select_ceding_broker").val() == null ||
                $("#select_ceding_broker").val() != prop.ceding_broker
            ) {
                $("#ceding_broker").val(prop.ceding_broker).change();
                $("#select_ceding_broker").val(prop.ceding_broker).change();
                $("#reg_num_ceding_broker").val(prop.ceding_broker).change();
            }
            if (
                $("#select_ceding_company").val() == null ||
                $("#select_ceding_company").val() != prop.ceding_company
            ) {
                $("#ceding_company").val(prop.ceding_company).change();
                $("#select_ceding_company").val(prop.ceding_company).change();
                $("#reg_num_ceding_company").val(prop.ceding_company).change();
            }
            if (
                $("#u_w_year").val() == "" ||
                $("#u_w_year").val() != prop.treaty_year
            )
                $("#u_w_year").val(prop.treaty_year);

            if (prop.getsubdetail.vat_check == 1) {
                $(".vat").show();
                $("#treaty_vat_percentage")
                    .val(prop.getsubdetail.vat_percentage)
                    .change()
                    .trigger("input");
                $("#nasionalre_vat_percentage")
                    .val(prop.getsubdetail.vat_percentage)
                    .change()
                    .trigger("input");
            } else {
                $(".vat").hide();
            }
            $("#bordero_report").val(
                prop.getsubdetail.bordereaux_reporting_account
            );
            if (prop.getsubdetail.bordereaux_reporting_account == "Quarterly") {
                $(".dis_half").prop("disabled", false);
                $("#date_prod_period").prop("disabled", false);
                $("#date_prod_month").prop("disabled", true);
                $("#date_prod_month").val("");
                $("#date_prod_year").prop("disabled", true);
                $("#date_prod_year").val("");
            } else if (
                prop.getsubdetail.bordereaux_reporting_account == "Monthly"
            ) {
                $(".dis_half").prop("disabled", false);
                $("#date_prod_period").prop("disabled", true);
                $("#date_prod_period").val("");
                $("#date_prod_month").prop("disabled", false);
                $("#date_prod_year").prop("disabled", false);
            } else if (
                prop.getsubdetail.bordereaux_reporting_account == "Half Yearly"
            ) {
                $(".dis_half").prop("disabled", true);
                $(".dis_half").val("");
                $("#date_prod_period").prop("disabled", false);
                $("#date_prod_month").prop("disabled", true);
                $("#date_prod_month").val("");
                $("#date_prod_year").prop("disabled", true);
                $("#date_prod_year").val("");
            } else {
                $(".dis_half").prop("disabled", false);
                $("#date_prod_period").prop("disabled", false);
                $("#date_prod_month").prop("disabled", false);
                $("#date_prod_year").prop("disabled", false);
            }

            if (prop.type == "credit") {
                $("#btn_ban_limit").show();
                $("#btn_ban_limit").prop("disabled", false);
            } else {
                $("#btn_ban_limit").hide();
                $("#btn_ban_limit").prop("disabled", true);
            }

            nasionalre_r_i_comm_gross = prop.getsubdetail.r_i_comm_gross;
            nasionalre_r_i_comm_nett = prop.getsubdetail.r_i_comm_nett;
            nasionalre_share_first = parseFloat(
                prop.getsubdetail.nasionalre_share_first
            );
            nasionalre_share_second = parseFloat(
                prop.getsubdetail.nasionalre_share_second
            );
            $("#nasionalre_share").val(nasionalre_share_first).change();
            $("#nasionalre_r_i_comm_percentage")
                .val(nasionalre_r_i_comm_gross)
                .change();

            $("#sub_detail_contract_id").val(prop.getsubdetail.id);

            $("#r_i_comm_percentage").val(
                parseFloat(prop.getsubdetail.prof_comm_percentage)
            );

            $("#cash_call_limit").val(
                parseFloat(prop.getsubdetail.cash_call_limit)
            );

            $("#treaty_overrider_percentage")
                .val(parseFloat(prop.getsubdetail.brokerage))
                .change();

            $("#nasionalre_overrider_percentage")
                .val(parseFloat(prop.getsubdetail.brokerage))
                .change();

            $("#btn_sub_detail").prop("disabled", false);
        });
    }
});
//end of region treaty summary set

//region interest on premium amount calculation
$("#treaty_interest_on_premium_percentage, #treaty_gross_premium").on(
    "input",
    function () {
        var tiopp = $("#treaty_interest_on_premium_percentage").val();
        var tgp = $("#treaty_gross_premium").val();

        if (tiopp && tgp) {
            $("#treaty_interest_on_premium_amount")
                .val((parseFloat(tiopp) * tgp) / 100)
                .change()
                .trigger("input");
        } else {
            $("#treaty_interest_on_premium_amount")
                .val(0)
                .change()
                .trigger("input");
        }
    }
);
//end of region interest on premium amount calculation

//region r i comm amount calculation
$("#treaty_r_i_comm_percentage, #treaty_gross_premium").on(
    "input",
    function () {
        var tricp = $("#treaty_r_i_comm_percentage").val();
        var tgp = $("#treaty_gross_premium").val();

        if (tricp && tgp) {
            $("#treaty_r_i_comm_amount")
                .val((parseFloat(tricp) * tgp) / 100)
                .change()
                .trigger("input");
        } else {
            $("#treaty_r_i_comm_amount").val(0).change().trigger("input");
        }
    }
);
//end of region r i comm amount calculation

//region override amount calculation
$("#treaty_overrider_percentage, #treaty_gross_premium").on(
    "input",
    function () {
        var top = $("#treaty_overrider_percentage").val();
        var tgp = $("#treaty_gross_premium").val();

        if (top && tgp) {
            $("#treaty_overrider_amount")
                .val((parseFloat(top) * tgp) / 100)
                .change()
                .trigger("input");
        } else {
            $("#treaty_overrider_amount").val(0).change().trigger("input");
        }
    }
);
//end of region override amount calculation

//region nasionalre balance calculation
$(
    "#nasionalre_net_premium, #nasionalre_result, #nasionalre_cash_loss, #nasionalre_common_a_c_xol"
).on("input", function () {
    var nnp = $("#nasionalre_net_premium").val();
    var nr = $("#nasionalre_result").val();
    var ncl = $("#nasionalre_cash_loss").val();
    var ncacx = $("#nasionalre_common_a_c_xol").val();
    if (nnp && nr && ncacx && ncl) {
        var result =
            parseFloat(nnp) -
            parseFloat(nr) -
            parseFloat(ncl) -
            parseFloat(ncacx);
        $("#nasionalre_balance").val(result).change().trigger("input");
    } else {
        $("#nasionalre_balance").val(0).change();
    }
});
//end of region nasionalre balance calculation

//region treaty balance calculation
$(
    "#treaty_net_premium, #treaty_result, #treaty_cash_loss, #treaty_common_a_c_xol"
).change(function () {
    var tnp = $("#treaty_net_premium").val();
    var tr = $("#treaty_result").val();
    var tcl = $("#treaty_cash_loss").val();
    var tcacx = $("#treaty_common_a_c_xol").val();
    if (tnp && tr && tcl && tcacx) {
        var result =
            parseFloat(tnp) -
            parseFloat(tr) -
            parseFloat(tcl) -
            parseFloat(tcacx);
        $("#treaty_balance").val(result).change().trigger("input");
    } else {
        $("#treaty_balance").val(0).change();
    }
});
//end of region treaty balance calculation

//region nasionalre r/i comm value getter
$("#nasionalre_r_i_comm_type").change(function () {
    if (this.value == "gross") {
        $("#nasionalre_r_i_comm_percentage")
            .val(nasionalre_r_i_comm_gross)
            .trigger("input");
    } else {
        $("#nasionalre_r_i_comm_percentage")
            .val(nasionalre_r_i_comm_nett)
            .trigger("input");
    }
});
//end of region nasionalre r/i comm value getter

//region vat calculation
$("#treaty_vat_percentage, #treaty_r_i_comm_amount, #treaty_balance").change(
    function () {
        var trica = $("#treaty_r_i_comm_amount").val();
        var tvp = $("#treaty_vat_percentage").val();
        var tb = $("#treaty_balance").val();
        if (trica && tvp && tb) {
            $("#treaty_vat")
                .val((parseFloat(tvp) * parseFloat(trica)) / 100)
                .trigger("input");
            $("#treaty_vat_balance")
                .val(parseFloat(tb) - parseFloat($("#treaty_vat").val()))
                .trigger("input");
        } else if (tvp == 0 || (tvp && tb)) {
            $("#treaty_vat").val(0);
            $("#treaty_vat_balance").val(parseFloat(tb)).trigger("input");
        } else {
            $("#treaty_vat").val(0);
            $("#treaty_vat_balance").val(0);
        }
    }
);

$(
    "#nasionalre_vat_percentage, #nasionalre_r_i_comm_amount, #nasionalre_balance"
).change(function () {
    var nrica = $("#nasionalre_r_i_comm_amount").val();
    var nvp = $("#nasionalre_vat_percentage").val();
    var nb = $("#nasionalre_balance").val();
    if (nrica && nvp && nb) {
        $("#nasionalre_vat")
            .val((parseFloat(nvp) * parseFloat(nrica)) / 100)
            .trigger("input");
        $("#nasionalre_vat_balance")
            .val(parseFloat(nb) - parseFloat($("#nasionalre_vat").val()))
            .trigger("input");
    } else if (nvp == 0 || (nvp && nb)) {
        $("#nasionalre_vat").val(0);
        $("#nasionalre_vat_balance").val(parseFloat(nb)).trigger("input");
    } else {
        $("#nasionalre_vat").val(0);
        $("#nasionalre_vat_balance").val(0);
    }
});
//end of region vat calculation

//region overseas and premium reserved calculation
$("#overseas_checkbox").change(function () {
    $("#treaty_premium_released").prop("readonly", !this.checked);
    $("#amount_premium_reserved").prop("readonly", !this.checked);
    if (this.checked) {
        $("#amount_premium_reserved").change(function () {
            this.value == ""
                ? $("#add_premium_reserved").prop("disabled", true)
                : $("#add_premium_reserved").prop("disabled", false);
        });
    } else {
        $("#add_premium_reserved").prop("disabled", true);
    }
});

function delete_premium_reserved(id) {
    var child = $("#premium_reserved_row" + id)
        .closest("tr")
        .nextAll();
    child.each(function () {
        var idx = $(this).children("td")[0];
        idx.innerHTML = parseFloat(idx.innerHTML) - 1;
    });
    premium_reserved_list.splice(
        _.findIndex(premium_reserved_list, ["no_data", id]),
        1
    );
    $("#treaty_premium_reserved")
        .val(_.sumBy(premium_reserved_list, "amount"))
        .trigger("input");
    $("#premium_reserved_row" + id).remove();
}
var premium_reserved_list = [];
$("#add_premium_reserved").click(function (e) {
    e.preventDefault();
    var amount = parseFloat($("#amount_premium_reserved").val());
    var no_data = $("#tbody_premium_reserved tr").length + 1;

    premium_reserved_list.push({
        no_data: no_data,
        amount: amount,
    });

    $("#treaty_premium_reserved")
        .val(_.sumBy(premium_reserved_list, "amount"))
        .trigger("input");

    $("#tbody_premium_reserved").append(`
        <tr id="premium_reserved_row${no_data}">
            <input type="hidden" name="premium_reserved_id[]" id="" value="0">
            <input type="hidden" name="premium_reserved_amount[]" id="" value="${amount}">
            <td>${no_data}</td>
            <td>${amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</td>
            <td>
            <button class="btn" onclick="delete_premium_reserved(${no_data})">
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
    `);
});
//end of region overseas and premium reserved calculation

//region share checkbox
$("#nasionalre_share_checkbox").change(function () {
    if (this.checked) {
        $("#nasionalre_share")
            .val((nasionalre_share_first * nasionalre_share_second) / 100)
            .change()
            .trigger("input");
    } else {
        $("#nasionalre_share")
            .val(nasionalre_share_first)
            .change()
            .trigger("input");
    }
});
//end of region share checkbox

//region treaty_result
$("#treaty_paid_losses, #treaty_claim_recovery").on("input", function () {
    var tpl = $("#treaty_paid_losses").val();
    var tcr = $("#treaty_claim_recovery").val();
    if (tpl && tcr) {
        $("#treaty_result")
            .val(parseFloat(tpl) - parseFloat(tcr))
            .change()
            .trigger("input");
    } else {
        $("#treaty_result").val(0).change();
    }
});
//end of region treaty_result

//region nasionalre_result
$("#nasionalre_paid_losses, #nasionalre_claim_recovery").on(
    "input",
    function () {
        var npl = $("#nasionalre_paid_losses").val();
        var ncr = $("#nasionalre_claim_recovery").val();
        if (npl && ncr) {
            $("#nasionalre_result")
                .val(parseFloat(npl) - parseFloat(ncr))
                .trigger("input");
        } else {
            $("#nasionalre_result").val(0);
        }
    }
);
//end of region nasionalre_result

//region nasionalre interest
$("#nasionalre_interest_percentage, #nasionalre_gross_premium").on(
    "input",
    function () {
        var nip = $("#nasionalre_interest_percentage").val();
        var ngp = $("#nasionalre_gross_premium").val();

        if (nip != "" && ngp != "") {
            $("#nasionalre_interest_amount")
                .val((parseFloat(ngp) * parseFloat(nip)) / 100)
                .trigger("input");
        }
    }
);
//end of region nasionalre interest

//region nasionalre interest calculation
// $(
//     "#nasionalre_interest_percentage, #treaty_gross_premium, #treaty_interest_on_premium_amount, #treaty_r_i_comm_amount"
// ).change(function () {
//     var nip = $("#nasionalre_interest_percentage").val();
//     var tgp = $("#treaty_gross_premium").val();
//     var tiop = $("#treaty_interest_on_premium_amount").val();
//     var tric = $("#treaty_r_i_comm_amount").val();

//     if (nip != "" && tgp != "" && tiop != "" && tric != "") {
//         $("#nasionalre_interest_amount")
//             .val(
//                 ((parseFloat(tgp) - parseFloat(tiop) - parseFloat(tric)) *
//                     parseFloat(nip)) /
//                     100
//             )
//             .trigger("input");
//     } else {
//         $("#nasionalre_interest_amount").val(0);
//     }
// });
//end of region nasionalre interest calculation

//region nasionalre net premium calculation
$(
    "#nasionalre_gross_premium, #nasionalre_interest_amount, #nasionalre_r_i_comm_amount, #nasionalre_overrider_amount"
).on("input", function () {
    var ngp = $("#nasionalre_gross_premium").val();
    var nrica = $("#nasionalre_r_i_comm_amount").val();
    var noa = $("#nasionalre_overrider_amount").val();
    var nia = $("#nasionalre_interest_amount").val();
    if (ngp != "" && nia != "" && nrica != "" && noa != "") {
        $("#nasionalre_net_premium")
            .val(
                parseFloat(ngp) -
                    parseFloat(nia) -
                    parseFloat(nrica) -
                    parseFloat(noa)
            )
            .trigger("input");
    } else {
        $("#nasionalre_net_premium").val(0);
    }
});
//end of region nasionalre net premium calculation

//region treaty net premium calculation
$(
    "#treaty_gross_premium, #treaty_premium_released, #treaty_premium_reserved, #treaty_interest_on_premium_amount, #treaty_r_i_comm_amount, #treaty_overrider_amount"
).on("input", function () {
    var tgp = $("#treaty_gross_premium").val();
    var tpl = $("#treaty_premium_released").val();
    var tps = $("#treaty_premium_reserved").val();
    var trica = $("#treaty_r_i_comm_amount").val();
    var toa = $("#treaty_overrider_amount").val();
    var tiopa = $("#treaty_interest_on_premium_amount").val();
    if (tgp != "" && tiopa != "" && trica != "" && toa != "") {
        var result =
            parseFloat(tgp) -
            parseFloat(tiopa) -
            parseFloat(trica) -
            parseFloat(toa);
        if (tpl != "") result += parseFloat(tpl);
        if (tps != "") result -= parseFloat(tps);

        $("#treaty_net_premium").val(result).change().trigger("input");
    } else {
        $("#treaty_net_premium").val(0).change();
    }
});
//end of region treaty net premium calculation

//region create document registration
function create_document_registration(data) {
    var _data = {
        date_of_doc: data.date_of_doc.value,
        ceding_broker: data.ceding_broker.value,
        ceding_company: data.ceding_company.value,
        ref_number: data.ref_number.value,
        incoming_date: data.incoming_date.value,
        delivered_by: data.delivered_by.value,
        period: data.period.value,
        type: data.type.value,
        accounting_year: data.accounting_year.value,
    };
    axios.post("/treaty/soa/registration", _data).then((res) => {
        $("#registration_id").val(res.data.id);
        $("#reg_num_reg_number").val(res.data.reg_number);
        toastr.success("Document Registration Created!");
    });
}
//end of region create document registration

//region nasionalre gross premium
$("#nasionalre_share, #treaty_gross_premium").change(function () {
    var ns = $("#nasionalre_share").val();
    var tgp = $("#treaty_gross_premium").val();
    if (ns && tgp && treaty_or_nasionalre) {
        $("#nasionalre_gross_premium")
            .val((parseFloat(ns) * parseFloat(tgp)) / 100)
            .trigger("input");
    } else if (treaty_or_nasionalre) {
        $("#nasionalre_gross_premium").val(0);
    }
});
//end of region nasionalre gross premium

//region nasionalre r i comm
$("#nasionalre_gross_premium, #nasionalre_r_i_comm_percentage").on(
    "input",
    function () {
        var ngp = $("#nasionalre_gross_premium").val();
        var nricp = $("#nasionalre_r_i_comm_percentage").val();
        if (ngp && nricp) {
            $("#nasionalre_r_i_comm_amount")
                .val((parseFloat(ngp) * parseFloat(nricp)) / 100)
                .change()
                .trigger("input");
        } else {
            $("#nasionalre_r_i_comm_amount").val(0).change();
        }
    }
);
//end of region nasionalre r i comm

//region nasionalre overrider
$("#nasionalre_gross_premium, #nasionalre_overrider_percentage").on(
    "input",
    function () {
        var ngp = $("#nasionalre_gross_premium").val();
        var nop = $("#nasionalre_overrider_percentage").val();
        if (ngp && nop) {
            $("#nasionalre_overrider_amount")
                .val((parseFloat(ngp) * parseFloat(nop)) / 100)
                .trigger("input");
        } else {
            $("#nasionalre_overrider_amount").val(0);
        }
    }
);
//end of region nasionalre overrider

//region nasionalre paid losses
$("#nasionalre_share, #treaty_paid_losses").change(function () {
    var ns = $("#nasionalre_share").val();
    var tpl = $("#treaty_paid_losses").val();
    if (ns && tpl && treaty_or_nasionalre) {
        $("#nasionalre_paid_losses")
            .val((parseFloat(ns) * parseFloat(tpl)) / 100)
            .trigger("input");
    } else if (treaty_or_nasionalre) {
        $("#nasionalre_paid_losses").val(0);
    }
});
//end of region nasionalre paid losses

//region nasionalre claim recovery
$("#nasionalre_share, #treaty_claim_recovery").change(function () {
    var ns = $("#nasionalre_share").val();
    var tcr = $("#treaty_claim_recovery").val();
    if (ns && tcr && treaty_or_nasionalre) {
        $("#nasionalre_claim_recovery")
            .val((parseFloat(ns) * parseFloat(tcr)) / 100)
            .trigger("input");
    } else if (treaty_or_nasionalre) {
        $("#nasionalre_claim_recovery").val(0);
    }
});
//end of region nasionalre claim recovery

//region nasionalre cash loss
$("#nasionalre_share, #treaty_cash_loss").change(function () {
    var ns = $("#nasionalre_share").val();
    var tcl = $("#treaty_cash_loss").val();
    if (ns && tcl && treaty_or_nasionalre) {
        $("#nasionalre_cash_loss")
            .val((parseFloat(ns) * parseFloat(tcl)) / 100)
            .trigger("input");
    } else if (treaty_or_nasionalre) {
        $("#nasionalre_cash_loss").val(0);
    }
});
//end of region nasionalre cash loss

//region nasionalre common a c xol
$("#nasionalre_share, #treaty_common_a_c_xol").change(function () {
    var ns = $("#nasionalre_share").val();
    var tcacx = $("#treaty_common_a_c_xol").val();
    if (ns && tcacx && treaty_or_nasionalre) {
        $("#nasionalre_common_a_c_xol")
            .val((parseFloat(ns) * parseFloat(tcacx)) / 100)
            .trigger("input");
    } else if (treaty_or_nasionalre) {
        $("#nasionalre_common_a_c_xol").val(0);
    }
});
//end of region nasionalre common a c xol

//region treaty gross premium setter
$("#nasionalre_gross_premium").change(function () {
    var ngp = $("#nasionalre_gross_premium").val();
    var ns = $("#nasionalre_share").val();
    if (ns && ngp && !treaty_or_nasionalre) {
        var result = (parseFloat(ngp) / parseFloat(ns)) * 100;
        $("#treaty_gross_premium").val(result).trigger("input");
    }
});
//end of region treaty gross premium setter

//region treaty paid losses
$("#nasionalre_share, #nasionalre_paid_losses").change(function () {
    var ns = $("#nasionalre_share").val();
    var npl = $("#nasionalre_paid_losses").val();
    if (!treaty_or_nasionalre && ns && npl) {
        var result = (parseFloat(npl) / parseFloat(ns)) * 100;
        $("#treaty_paid_losses").val(result).trigger("input");
    }
});
//end of region treaty paid losses

//region treaty claim recovery
$("#nasionalre_share, #nasionalre_claim_recovery").change(function () {
    var ns = $("#nasionalre_share").val();
    var ncr = $("#nasionalre_claim_recovery").val();
    if (!treaty_or_nasionalre && ns && ncr) {
        var result = (parseFloat(ncr) / parseFloat(ns)) * 100;
        $("#treaty_claim_recovery").val(result).trigger("input");
    }
});
//end of region treaty claim recovery

//region treaty cash loss
$("#nasionalre_share, #nasionalre_cash_loss").change(function () {
    var ns = $("#nasionalre_share").val();
    var ncl = $("#nasionalre_cash_loss").val();
    if (!treaty_or_nasionalre && ns && ncl) {
        var result = (parseFloat(ncl) / parseFloat(ns)) * 100;
        $("#treaty_cash_loss").val(result).trigger("input");
    }
});
//end of region treaty cash loss

//region treaty common a c xol
$("#nasionalre_share, #nasionalre_common_a_c_xol").change(function () {
    var ns = $("#nasionalre_share").val();
    var ncacx = $("#nasionalre_common_a_c_xol").val();
    if (!treaty_or_nasionalre && ns && ncacx) {
        var result = (parseFloat(ncacx) / parseFloat(ns)) * 100;
        $("#treaty_common_a_c_xol").val(result).trigger("input");
    }
});
//end of region treaty common a c xol

//region toggle flow
$("#nasionalre_gross_premium").on("focus", function () {
    treaty_or_nasionalre = false;
});

$("#treaty_gross_premium").on("focus", function () {
    treaty_or_nasionalre = true;
});
//end of region toggle flow

//region upload bordero
function uploadBordero() {
    var bj = $("#bordero_jenis").val();
    var bf = $("#bordero_format").val();
    var bid = $("#bordero_incoming_date").val();
    var bif = $("#bordero_input_file").prop("files");
    var soa_id = $("#soa_id").val();

    if (bj && bf && bid && bif[0] && soa_id) {
        let formData = new FormData();
        formData.append("file", bif[0]);
        formData.append("bordero_jenis", bj);
        formData.append("bordero_format", bf);
        formData.append("bordero_incoming_date", bid);
        formData.append("soa_id", soa_id);
        axios
            .post("/treaty/soa/bordero/upload", formData, {
                headers: {
                    "Content-Type": "multipart/form-data",
                },
            })
            .then((res) => {
                swal("Success", "File uploaded!", "success");
                location.reload();
            })
            .catch((err) => {
                swal("Error", "File and format not match!", "error");
                console.error(
                    "🚀 ~ file: entry.js ~ line 641 ~ uploadBordero ~ err.response",
                    err.response
                );
                console.error(
                    "🚀 ~ file: entry.js ~ line 644 ~ uploadBordero ~ err.response.data",
                    err.response.data
                );
                console.error(
                    "🚀 ~ file: entry.js ~ line 648 ~ uploadBordero ~ err.response.data.message",
                    err.response.data.message
                );
            });
    }
}
//end of region upload bordero

//region cancel upload bordero
function cancelBordero() {
    $("#bordero_jenis").val("");
    $("#bordero_format").val("");
    $("#bordero_incoming_date").val("");
    $("#bordero_input_file").val("").change();
}
//end of region cancel upload bordero

//region enable upload bordero
if ($("#soa_id").val()) {
    $("#bordero_jenis").prop("disabled", false);
    $("#bordero_format").prop("disabled", false);
    $("#bordero_incoming_date").prop("disabled", false);
    $("#bordero_input_file").prop("disabled", false);
    $("#btn_submit_bordero").prop("disabled", false);
    $("#btn_cancel_bordero").prop("disabled", false);
    $("#btn_show_bordero").prop("disabled", false);
    $("#btn_replace").prop("disabled", false);
    $("#btn_copy").prop("disabled", true);

    var id = $("#id_soa").val();
    $("#soa_form").prop("action", "/treaty/soa/update/" + id);

    nasionalre_share_first = parseFloat($("#nasionalre_share_first").val());
    nasionalre_share_second = parseFloat($("#nasionalre_share_second").val());
    nasionalre_r_i_comm_gross = parseFloat($("#r_i_comm_gross").val());
    nasionalre_r_i_comm_nett = parseFloat($("#r_i_comm_nett").val());

    if ($("#vat_check").val() == 1) {
        $(".vat").show();
    } else {
        $(".vat").hide();
    }
}
//end of region enable upload bordero

//region bordero modal
function openBorderoModal() {
    $("#bordero_modal").modal("toggle");
}
//end of region bordero modal

//region ceding value setter
$("#reg_num_ceding_company").change(function () {
    $("#ceding_company").val(this.value);
    $("#select_ceding_company").val(this.value).change().trigger("input");
});

$("#reg_num_ceding_broker").change(function () {
    $("#ceding_broker").val(this.value);
    $("#select_ceding_broker").val(this.value).change().trigger("input");
});
//end of region ceding value setter

//region copy soa value
async function copy_soa(id) {
    await axios.get("/treaty/soa/show/" + id).then((res) => {
        var soa = res.data;

        columns.forEach((col, index) => {
            if (index != 0 || index != 1) {
                $("#" + col).val(soa[col]);
            }
        });
    });
    $("#copy_modal").modal("toggle");
}

async function openCopyModal() {
    $("#tbody_copy_soa tr").remove();
    var date_prod = $("#date_prod").val();
    var period = $("#date_prod_period").val();
    var month = $("#date_prod_month").val();
    var year = $("#date_prod_year").val();
    var data = {
        date_prod: date_prod,
        period: period,
        month: month,
        year: year,
    };
    await axios.post("/treaty/soa/copy", data).then((res) => {
        if (res.data.length > 0)
            _.each(res.data, function (soa, id) {
                var no_data = $("#tbody_copy_soa tr").length + 1;
                $("#tbody_copy_soa").append(
                    `
                    <tr>
                        <td>${no_data}</td>
                        <td>${soa.soa_id}</td>
                        <td>${soa.getbroker.name}</td>
                        <td>${soa.getprop.getkoc.description}</td>
                        <td>${soa.getprop.getcob.description}</td>
                        <td>
                            <button class="btn btn-sm btn-primary" onclick="copy_soa(${soa.id})">
                                Copy
                            </button>
                        </td>
                    </tr>
                `
                );
            });
    });
    $("#copy_modal").modal("toggle");
}
//end of region copy soa value

//region attachment
async function deleteAttachment(id) {
    var child = $("#attach_document_soa_row" + id)
        .closest("tr")
        .nextAll();
    child.each(function () {
        var idx = $(this).children("td")[0];
        idx.innerHTML = parseFloat(idx.innerHTML) - 1;
    });
    $("#attach_document_soa_row" + id).remove();
}

$("#attachmentbtn").click(async function (e) {
    e.preventDefault();
    var url = $("#attachmenturl").val();
    var description = $("#attachmentdesc").val();
    if (url != "" && description != "") {
        var no_data = $("#tbody_attach_document_soa tr").length + 1;
        $("#tbody_attach_document_soa").append(
            `<tr id="attach_document_soa_row${no_data}">
                <input type="hidden" name="attach_id[]" value="0">
                <input type="hidden" name="attach_description[]" value="${description}">
                <input type="hidden" name="attach_url[]" value="${url}">
                <td>${no_data}</td>
                <td>${description}</td>
                <td>${url}</td>
                <td>
                    <button class="btn" onclick="deleteAttachment(${no_data})">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-trash"
                        viewBox="0 0 16 16">
                        <path
                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                        <path fill-rule="evenodd"
                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                        </svg>
                    </button>
                </td>
            </tr>`
        );

        $("#attachmenturl").val("");
        $("#attachmentdesc").val("");
    }
});
//end of region attachment

//region cancel replace
function storeOldData() {
    columns.forEach((col) => {
        old_data[col] = $("#" + col).val();
    });
    columns.forEach((col) => {
        $("#" + col)
            .val("")
            .change();
    });
    old_premium_reserved_list = premium_reserved_list;
    premium_reserved_list = [];
    $("#tbody_premium_reserved tr").remove();
}

function retrieveOldData() {
    columns.forEach((col) => {
        $("#" + col).val(old_data[col]);
    });
    $("#tbody_premium_reserved tr").remove();
    premium_reserved_list = old_premium_reserved_list;
    premium_reserved_list.forEach((pre) => {
        var no_data = $("#tbody_premium_reserved tr").length + 1;
        $("#tbody_premium_reserved").append(`
        <tr id="premium_reserved_row${pre.no_data}">
            <input type="hidden" name="premium_reserved_id[]" id="" value="0">
            <input type="hidden" name="premium_reserved_amount[]" id="" value="${
                pre.amount
            }">
            <td>${no_data}</td>
            <td>${pre.amount
                .toString()
                .replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</td>
            <td>
            <button class="btn" onclick="delete_premium_reserved(${
                pre.no_data
            })">
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
    `);
    });
}

function openCancelReplace() {
    cancel_replace = !cancel_replace;
    var id = $("#id_soa").val();
    if (cancel_replace) {
        $("#soa_form").prop("action", "/treaty/soa/replace/" + id);
        $("#btn_replace").addClass("btn-danger").removeClass("btn-primary");
        storeOldData();
        $("#status").val("Revised");
        $("#version").val(parseInt(old_data.version) + 1);
        $("#treaty_premium_released").val(0);
        $("#treaty_premium_reserved").val(0);
    } else {
        $("#soa_form").prop("action", "/treaty/soa/update/" + id);
        $("#btn_replace").addClass("btn-primary").removeClass("btn-danger");
        retrieveOldData();
    }
}
//end of region cancel replace

//region extend date prod
$("#date_prod_extend_check").change(function () {
    var bordero_report = $("#bordero_report").val();
    if (this.checked) {
        if (bordero_report == "Quarterly") {
            $("#date_prod_year").prop("disabled", false);
            $("#date_prod_period .extend").remove();
            $("#date_prod_period").append(
                `
                <option value="5" class="extend">5th</option>
                <option value="6" class="extend">6th</option>
                <option value="7" class="extend">7th</option>
                <option value="8" class="extend">8th</option>
                <option value="9" class="extend">9th</option>
                <option value="10" class="extend">10th</option>
                <option value="11" class="extend">11th</option>
                <option value="12" class="extend">12th</option>
                `
            );
        } else if (bordero_report == "Half Yearly") {
            $(".dis_half").prop("disabled", false);
            $("#date_prod_year").prop("disabled", false);
            $("#date_prod_period .extend").remove();
            $("#date_prod_period").append(
                `
                <option value="5" class="extend">5th</option>
                <option value="6" class="extend">6th</option>
                `
            );
        }
    } else {
        if (bordero_report == "Quarterly") {
            $("#date_prod_year").prop("disabled", true);
            $("#date_prod_period .extend").remove();
        } else if (bordero_report == "Half Yearly") {
            $(".dis_half").prop("disabled", true);
            $("#date_prod_year").prop("disabled", true);
            $("#date_prod_period .extend").remove();
        }
    }
});
//end of region extend date prod

async function openSubDetail() {
    await axios
        .get("/treaty/prop/getsubdetail/" + $("#tty_summary").val())
        .then((res) => {
            console.log("🚀 ~ file: entry.js ~ line 1084 ~ .then ~ res", res);
            $("#tbody_sub_detail_modal tr").remove();
            var sdci = $("#sub_detail_contract_id").val();
            var checked = false;
            var prop = res.data;
            if (sdci != "") checked = true;
            _.each(prop.getallsubdetail, function (id_sub, index) {
                list_sub_detail.push(id_sub);
                console.log(id_sub);
                $("#tbody_sub_detail_modal").append(
                    `
                <tr>
                    <td>${id_sub.id_sub_detail_contract}</td>
                    <td>${prop.getcob.description}</td>
                    <td>${id_sub.nasionalre_share_first}%</td>
                    <td>${id_sub.nasionalre_share_second}%</td>
                    <td>${id_sub.r_i_comm_gross}%</td>
                    <td>${id_sub.r_i_comm_nett}%</td>
                    <td>${id_sub.vat_percentage}%</td>
                    <td>${id_sub.remark}</td>
                    <td><input type="radio" name="sub_detail_rad" value="${
                        id_sub.id_sub_detail_contract
                    }" ${
                        checked && id_sub.id == sdci
                            ? "checked"
                            : index == res.data.length - 1 && sdci == ""
                            ? "checked"
                            : ""
                    }></td>
                </tr>
                `
                );
            });
        });
    $("#sub_detail_modal").modal("toggle");
}

function selectSubDetail() {
    var sub_contract = _.find(list_sub_detail, function (o) {
        return (
            o.id_sub_detail_contract ==
            $("input[name='sub_detail_rad']:checked").val()
        );
    });

    $("#sub_detail_contract_id").val(sub_contract.id);

    nasionalre_r_i_comm_gross = parseFloat(sub_contract.r_i_comm_gross);
    nasionalre_r_i_comm_nett = parseFloat(sub_contract.r_i_comm_nett);
    nasionalre_share_first = parseFloat(sub_contract.nasionalre_share_first);
    nasionalre_share_second = parseFloat(sub_contract.nasionalre_share_second);
    $("#nasionalre_share").val(nasionalre_share_first).change();
    $("#nasionalre_r_i_comm_percentage")
        .val(nasionalre_r_i_comm_gross)
        .change();

    $("#treaty_vat_percentage")
        .val(sub_contract.vat_percentage)
        .change()
        .trigger("input");
    $("#nasionalre_vat_percentage")
        .val(sub_contract.vat_percentage)
        .change()
        .trigger("input");
}

async function openBanLimit() {
    await axios
        .get("/treaty/prop/getbanlimit/" + $("#sub_detail_contract_id").val())
        .then((res) => {
            $("#tbody_ban_limit_modal tr").remove();
            _.each(res.data, function (ban, index) {
                console.log(ban);
                $("#tbody_ban_limit_modal").append(
                    `
                <tr>
                    <td>${ban.id_structure_limit}</td>
                    <td>${moneyFormat(ban.ban_limit)}</td>
                    <td>${ban.net_or}%</td>
                    <td>${ban.nasionalre_first}% - ${
                        ban.nasionalre_second
                    }%</td>
                </tr>
                `
                );
            });
        });
    $("#ban_limit_modal").modal("toggle");
}
