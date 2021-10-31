//region commission calculation
$("#premium, #commission_percentage").on("input", function () {
    var ip = $("#premium").val();
    var icp = $("#commission_percentage").val();
    if (ip && icp) {
        $("#commission_amount")
            .val((parseFloat(ip) * parseFloat(icp)) / 100)
            .trigger("input");
    }
});
//end of region commission calculation

//region management expanses calculation
$("#premium, #management_expenses_percentage").on("input", function () {
    var ip = $("#premium").val();
    var imep = $("#management_expenses_percentage").val();
    if (ip && imep) {
        $("#management_expenses_amount")
            .val((parseFloat(ip) * parseFloat(imep)) / 100)
            .trigger("input");
    }
});
//end of region management expanses calculation

//region profit loss calculation
$(
    "#premium, #commission_amount, #losses_paid, #outstanding_losses, #management_expenses_amount, #dcf"
).on("input", function () {
    var ip = $("#premium").val();
    var icp = $("#commission_amount").val();
    var ilp = $("#losses_paid").val();
    var iol = $("#outstanding_losses").val();
    var imea = $("#management_expenses_amount").val();
    var id = $("#dcf").val();
    if (ip && icp && ilp && iol && imea && id) {
        $("#profit_loss_first")
            .val(
                parseFloat(ip) -
                    parseFloat(icp) -
                    parseFloat(ilp) -
                    parseFloat(iol) -
                    parseFloat(imea) -
                    parseFloat(id)
            )
            .trigger("input");
    }
});
//end of region profit loss calculation

//region profit loss 2
$("#profit_loss_first").on("input", function () {
    $("#profit_loss_second").val(this.value);
});
//end of region profit loss 2

//region profit commission calculation
$("#profit_loss_second, #profit_commission_percentage").on(
    "input",
    function () {
        var ipl2 = $("#profit_loss_second").val();
        var ipcp = $("#profit_commission_percentage").val();
        if (ipl2 && ipcp) {
            $("#profit_commission_amount")
                .val((parseFloat(ipl2) * parseFloat(ipcp)) / 100)
                .trigger("input");
        }
    }
);
//end of region profit commission calculation

//region our share calculation
$("#profit_loss_second, #our_share_percentage").on("input", function () {
    var ipl2 = $("#profit_loss_second").val();
    var iosp = $("#our_share_percentage").val();
    if (ipl2 && iosp) {
        $("#our_share_amount")
            .val((parseFloat(ipl2) * parseFloat(iosp)) / 100)
            .trigger("input");
    }
});
//end of region our share calculation

//region balance due calculation
$("#our_share_amount, #total_previous_settlement").on("input", function () {
    var iosa = $("#our_share_amount").val();
    var itps = $("#total_previous_settlement").val();
    if (iosa && itps)
        $("#balance_due")
            .val(parseFloat(iosa) - parseFloat(itps))
            .trigger("input");
});
//end of region balance due calculation

//region assign value
$("#select_ceding_broker").on("input", function () {
    var text = $("#select_ceding_broker option:selected").text();
    $(".ceding_broker").html(text);
    $("#find_ceding_broker").val(text);
});

$("#select_ceding_company").on("input", function () {
    var text = $("#select_ceding_company option:selected").text();
    $(".ceding_company").html(text);
    $("#find_ceding_company").val(text);
});

$("#koc").on("input", function () {
    $("#find_koc").val($("#koc option:selected").text());
});

$("#cob").on("input", function () {
    $("#find_cob").val($("#cob option:selected").text());
});

$("#treaty_year, #period_year").change(function () {
    $("#find_u_w_year").val(this.value);
    $(".u_w_year").html(this.value);
});
//end of region assign value

//region check profit commission
async function check_profit_commission() {
    var cty = $("#treaty_year").val();
    var ccb = $("#ceding_broker").val();
    var ccc = $("#ceding_company").val();
    var cc = $("#cob").val();
    var ck = $("#koc").val();
    if (cty == "" || ccb == null || ccc == null || cc == null || ck == null) {
        $("#btn_find").prop("disabled", true);
        $("#btn_calculate").prop("disabled", true);
        swal("Field Empty!", "Please fill all fields!", "error");
    } else {
        await axios
            .post("/treaty/commission/check/form", {
                cty: cty,
                ccb: ccb,
                ccc: ccc,
                cc: cc,
                ck: ck,
            })
            .then((res) => {
                if (res.data) {
                    console.log(
                        "🚀 ~ file: entry.js ~ line 143 ~ .then ~ res.data",
                        res.data
                    );
                    var summary = res.data;
                    var soas = summary.getsoa;
                    $("#prop_id").val(summary.id);
                    $("#check_summary").html(summary.treaty_year + " (Tahun)");
                    $("#check_e_p_i").html(summary.getsubdetail.e_p_i);
                    $("#check_d_c_f").html(
                        summary.getsubdetail.year_dcf + " Years"
                    );
                    // $("#check_premi_soa").html(soa.treaty_balance);
                    $("#check_e_p_i").inputmask({
                        digits: 2,
                        alias: "decimal",
                        groupSeparator: ".",
                        autoGroup: true,
                        autoUnmask: true,
                    });
                    $("#check_premi_soa").inputmask({
                        digits: 2,
                        alias: "decimal",
                        groupSeparator: ".",
                        autoGroup: true,
                        autoUnmask: true,
                    });

                    var filter_by_soa_id = [];
                    _.each(_.groupBy(soas, "soa_id"), function (soa) {
                        filter_by_soa_id.push(soa[soa.length - 1]);
                    });
                    console.log(
                        "🚀 ~ file: entry.js ~ line 174 ~ filter_by_soa_id",
                        filter_by_soa_id
                    );

                    var filter_by_year = [];
                    var balances = [];
                    _.each(
                        _.groupBy(filter_by_soa_id, "u_w_year"),
                        function (year) {
                            _.each(year, function (soa, index) {
                                if (index > 0) {
                                    soa.net_balance =
                                        balances[index - 1] -
                                        soa.nasionalre_gross_premium -
                                        soa.nasionalre_r_i_comm_amount;
                                    balances.push(soa.net_balance);
                                } else {
                                    soa.net_balance =
                                        soa.nasionalre_gross_premium -
                                        soa.nasionalre_r_i_comm_amount;
                                    balances.push(soa.net_balance);
                                }
                            });
                            filter_by_year.push(year[year.length - 1]);
                        }
                    );

                    $("#tbody_profit_commission tr").remove();
                    _.each(filter_by_year, function (soa) {
                        $("#tbody_profit_commission").append(
                            `
                    <tr>
                    <input type="hidden" name="check_u_w_year[]" value="${
                        soa.u_w_year
                    }">
                    <input type="hidden" name="check_premi[]" value="${
                        soa.nasionalre_gross_premium
                    }">
                    <input type="hidden" name="check_komisi[]" value="${
                        soa.nasionalre_r_i_comm_amount
                    }">
                    <input type="hidden" name="check_klaim[]" value="0">
                    <input type="hidden" name="check_cash_call[]" value="0">
                    <input type="hidden" name="check_os_klaim[]" value="0">
                    <input type="hidden" name="check_net_balance[]" value="${
                        soa.net_balance
                    }">
                        <td>${soa.u_w_year}</td>
                        <td>${parseFloat(soa.nasionalre_gross_premium)
                            .toFixed(2)
                            .toString()
                            .replace(/\B(?=(\d{3})+(?!\d)+\.)/g, ",")}</td>
                        <td>${parseFloat(soa.nasionalre_r_i_comm_amount)
                            .toFixed(2)
                            .toString()
                            .replace(/\B(?=(\d{3})+(?!\d)+\.)/g, ",")}</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>${parseFloat(soa.net_balance)
                            .toFixed(2)
                            .toString()
                            .replace(/\B(?=(\d{3})+(?!\d)+\.)/g, ",")}</td>
                    </tr>
                    `
                        );
                    });
                    $("#btn_find").prop("disabled", false);
                } else {
                    $("#btn_find").prop("disabled", true);
                    $("#btn_calculate").prop("disabled", true);
                    swal("No Data Founded", "Please check the fields", "info");
                }
            })
            .catch((err) => {
                console.log(err);
            });
    }
}
//end of region check profit commission

//region find profit commission
async function find_profit_commission() {
    var cty = $("#treaty_year").val();
    var ccb = $("#ceding_broker").val();
    var ccc = $("#ceding_company").val();
    var cc = $("#cob").val();
    var ck = $("#koc").val();
    if (cty == "" && ccb == "" && ccc == "" && cc == "" && ck == "") {
        $("#btn_calculate").prop("disabled", true);
        swal("Field Empty!", "Please fill all fields!", "error");
    } else {
        await axios
            .post("/treaty/commission/find", {
                cty: cty,
                ccb: ccb,
                ccc: ccc,
                cc: cc,
                ck: ck,
            })
            .then((res) => {
                if (res.data) {
                    console.log(
                        "🚀 ~ file: entry.js ~ line 212 ~ .then ~ res.data",
                        res.data
                    );
                    $("#tbody_soa_profit_commission tr").remove();
                    _.each(res.data, function (soa, index) {
                        var _soa = soa[soa.length - 1];
                        $("#tbody_soa_profit_commission").append(
                            `
                        <tr>
                        <input type="hidden" name="find_soa_id[${index}]" value="${
                                _soa.id
                            }">
                            <td>
                                <input type="hidden" name="find_soa_checkbox[${index}]" value="off">
                                <input type="checkbox" class="find_soa_checkbox" name="find_soa_checkbox[${index}]" value="on">
                            </td>
                            <td>${_soa.soa_id}</td>
                            <td>${new Date(
                                Date(_soa.date_prod)
                            ).toLocaleDateString("en-GB")}</td>
                            <td>${_soa.doc_number}</td>
                            <td>${_soa.date_prod_year ?? "-"}</td>
                            <td>${_soa.date_prod_period ?? "-"}</td>
                            <td>${_soa.getcurrency.code}</td>
                            <td>${parseFloat(_soa.nasionalre_gross_premium)
                                .toFixed(2)
                                .toString()
                                .replace(/\B(?=(\d{3})+(?!\d)+\.)/g, ",")}</td>
                        </tr>
                        `
                        );
                    });
                    $("#btn_calculate").prop("disabled", false);
                } else {
                    $("#btn_calculate").prop("disabled", true);
                }
            })
            .catch((err) => {
                console.log(err);
            });
    }
}
//end of region find profit commission

//region soa checkbox all
$("#soa_checkbox_all").change(function (e) {
    e.preventDefault();
    $(".find_soa_checkbox").prop("checked", this.checked);
});
//end of region soa checkbox all

//region calculate profit commission
function calculate_profit_commission() {}
//end of region calculate profit commission

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
    axios.post("/treaty/commission/registration", _data).then((res) => {
        $("#registration_id").val(res.data.id);
        $("#reg_num_reg_number").val(res.data.reg_number);
        toastr.success("Document Registration Created!");
    });
}
//end of region create document registration

//region set ceding
$(document).ready(function () {
    var rncc = $("#reg_num_ceding_company").val();
    var rncb = $("#reg_num_ceding_broker").val();
    if (rncc != null && rncb != null) {
        $("#ceding_company").val(rncc).change();
        $("#select_ceding_company").val(rncc).change().trigger("input");
        $("#ceding_broker").val(rncb).change();
        $("#select_ceding_broker").val(rncb).change().trigger("input");
    }
});

$("#reg_num_ceding_company").change(function () {
    $("#ceding_company").val(this.value);
    $("#select_ceding_company").val(this.value).change().trigger("input");
});

$("#reg_num_ceding_broker").change(function () {
    $("#ceding_broker").val(this.value);
    $("#select_ceding_broker").val(this.value).change().trigger("input");
});
//end of region set ceding

//region set form to update
if ($("#commission_id").val()) {
    var id = $("#commission_id").val();
    $("#commission_form").prop("action", "/treaty/commission/update/" + id);
}
//end of region set form to update
