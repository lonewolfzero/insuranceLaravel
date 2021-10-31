$(".e1").select2({
    width: "100%",
});

//#region mask
$(".datepicker").datepicker({
    autoclose: true,
    todayHighlight: true,
    zIndexOffset: 9999999,
    format: "dd/mm/yyyy",
});

$(".yearpicker").datepicker({
    autoclose: true,
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

toastr.options = {
    closeButton: false,
    debug: false,
    newestOnTop: true,
    progressBar: true,
    positionClass: "toast-top-right",
    preventDuplicates: false,
    onclick: null,
    showDuration: "300",
    hideDuration: "300",
    timeOut: "2000",
};

function moneyFormat(val) {
    return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

var sliding_ratio = [];
var usd = 0;

//region filtering from summary prop
function submitFilter(data) {
    var _data = {
        u_w_year: data.u_w_year.value,
        as_at: data.as_at.value,
        ceding_broker: data.ceding_broker.value,
        ceding_company: data.ceding_company.value,
        cob: data.cob.value,
        koc: data.koc.value,
    };
    axios.post("/treaty/sliding/filter", _data).then((res) => {
        console.log(
            "🚀 ~ file: index.js ~ line 79 ~ axios.post ~ res.data",
            res.data
        );
        if (res.data.prop == null) {
            swal(
                "No Data",
                "No data founded, please check the fields!",
                "info"
            );
        } else {
            $("#prop_id").val(res.data.prop.id);
            //region sliding scale ratio table
            $("#tbody_sliding_scale tr").remove();
            _.each(
                res.data.prop.getsubdetail.getsliding,
                function (sli, index) {
                    sliding_ratio.push({
                        val: sli.r_i_comm,
                        first: sli.loss_ratio_first,
                        second: sli.loss_ratio_second,
                    });
                    $("#tbody_sliding_scale").append(
                        `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${sli.r_i_comm}%</td>
                        <td>${sli.loss_ratio_first}% - ${
                            sli.loss_ratio_second
                        }%</td>
                    </tr>
                    `
                    );
                }
            );
            //end of region sliding scale ratio table

            $("#tbody_sliding_main tr").remove();
            _.each(res.data.slidings, function (sl) {
                $("#tbody_sliding_main").append(
                    `
                    <tr>
                        <td>${sl.sliding_scale_id}</td>
                        <td>${sl.version}</td>
                        <td>${moneyFormat(sl.total_premium)}</td>
                        <td>${moneyFormat(sl.total_paid_losses)}</td>
                        <td>${moneyFormat(sl.total_outstanding_losses)}</td>
                        <td>${moneyFormat(sl.total_incured_losses)}</td>
                        <td>${moneyFormat(sl.loss_ratio)}</td>
                        <td>${moneyFormat(sl.sliding_scale)}</td>
                        <td>${moneyFormat(sl.finalized_sliding_scale)}</td>
                        <td>${sl.getuser.name}</td>
                        <td>${new Date(Date(sl.date_prod)).toLocaleDateString(
                            "en-GB"
                        )}</td>
                        <td>
                            <button class="btn btn-sm btn-primary" type="button" onclick="cancelReplace(${
                                sl.id
                            })">
                                Cancel Replace
                            </button>                            
                        </td>
                    </tr>
                    `
                );
            });

            var soa_result_idr = 0;
            var premium_idr = 0;
            var r_i_comm_idr = 0;
            var soa_result_usd = 0;
            var premium_usd = 0;
            var r_i_comm_usd = 0;
            _.each(res.data.soa, function (soa) {
                if (soa.currency == 2) {
                    premium_idr += soa.nasionalre_gross_premium;
                    soa_result_idr += soa.nasionalre_result;
                    r_i_comm_idr += soa.nasionalre_r_i_comm_amount;

                    premium_usd += soa.nasionalre_gross_premium / soa.usd.kurs;
                    soa_result_usd += soa.nasionalre_result / soa.usd.kurs;
                    r_i_comm_usd +=
                        soa.nasionalre_r_i_comm_amount / soa.usd.kurs;
                } else {
                    premium_idr += soa.nasionalre_gross_premium * soa.usd.kurs;
                    soa_result_idr += soa.nasionalre_result * soa.usd.kurs;
                    r_i_comm_idr +=
                        soa.nasionalre_r_i_comm_amount * soa.usd.kurs;

                    premium_usd += soa.nasionalre_gross_premium;
                    soa_result_usd += soa.nasionalre_result;
                    r_i_comm_usd += soa.nasionalre_r_i_comm_amount;
                }
                usd = soa.usd.kurs;
            });

            $("#total_premium_idr").val(premium_idr).change().trigger("input");
            $("#total_claim_paid_idr")
                .val(soa_result_idr)
                .change()
                .trigger("input");
            $("#total_commission_idr")
                .val(r_i_comm_idr)
                .change()
                .trigger("input");

            $("#total_premium_usd").val(premium_usd).change().trigger("input");
            $("#total_claim_paid_usd")
                .val(soa_result_usd)
                .change()
                .trigger("input");
            $("#total_commission_usd")
                .val(r_i_comm_usd)
                .change()
                .trigger("input");

            //region loss ratio calculation
            var loss_ratio =
                (parseFloat($("#total_incured_losses_idr").val()) /
                    premium_idr) *
                100;
            $("#loss_ratio").val(loss_ratio).change().trigger("input");
            //end of region loss ratio calculation

            //region sliding scale calculation
            _.each(sliding_ratio, function (ratio, index) {
                if (_.inRange(loss_ratio, ratio.first - 1, ratio.second + 1)) {
                    var res_idr = (ratio.val * premium_idr) / 100;
                    console.log(
                        "🚀 ~ file: index.js ~ line 211 ~ res_idr",
                        res_idr
                    );
                    var res_usd = (ratio.val * premium_usd) / 100;
                    console.log(
                        "🚀 ~ file: index.js ~ line 213 ~ res_usd",
                        res_usd
                    );
                    $("#sliding_scale_idr").val(res_idr);
                    $("#sliding_scale_usd").val(res_usd);
                    return false;
                }
            });
            //end of region sliding scale calculation

            $("#btn_finalized").prop("disabled", false);
        }
    });
}
//end of region filtering from summary prop

function finalizedSlidingScale() {
    $("#btn_submit").prop("disabled", false);
    $("#finalized_sliding_scale").val(
        parseFloat($("#total_commission_idr").val()) -
            parseFloat($("#sliding_scale_idr").val())
    );
    // swal("Finalized", "Finalized success!", "success");
}

$("#total_paid_losses_idr, #total_outstanding_losses_idr").on(
    "input",
    function () {
        var tpl = $("#total_paid_losses_idr").val();
        var tol = $("#total_outstanding_losses_idr").val();
        if (tpl != "" && tol != "") {
            var result = parseFloat(tpl) + parseFloat(tol);
            $("#total_incured_losses_idr").val(result);
        }
    }
);

function cancelReplace(id) {
    axios.get("/treaty/sliding/cancelreplace/" + id).then((res) => {
        console.log(res.data);
        location.reload();
    });
}
