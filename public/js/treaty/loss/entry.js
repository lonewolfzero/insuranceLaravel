var usd = 0;

//region submit filter
function submitFilter(data) {
    var _data = {
        treaty_year: data.treaty_year.value,
        ceding_broker: data.ceding_broker.value,
        ceding_company: data.ceding_company.value,
        cob: data.cob.value,
        koc: data.koc.value,
    };
    axios.post("/treaty/loss/filter", _data).then((res) => {
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
            var summary = res.data.prop;
            var soa = res.data.soa;
            var loss = res.data.loss;

            $("#tbody_loss tr").remove();
            _.each(loss, function (ls) {
                $("#tbody_loss").append(
                    `
                    <tr>
                        <td>${ls.loss_id}</td>
                        <td>${summary.getbroker.name}</td>
                        <td>${summary.getcompany.name}</td>
                        <td>${summary.treaty_year}</td>
                        <td>${summary.id_detail_contract}</td>
                        <td>${new Date(Date(ls.date_prod)).toLocaleDateString(
                            "en-GB"
                        )}</td>
                            <td>${
                                (parseFloat(
                                    summary.getsubdetail.nasionalre_share_first
                                ) *
                                    parseFloat(
                                        summary.getsubdetail
                                            .nasionalre_share_second
                                    )) /
                                100
                            }%</td>
                        <td>${summary.getsubdetail.getcurrency.code}</td>
                        <td>${moneyFormat(ls.loss_participation_idr)}</td>
                        <td>${moneyFormat(ls.due_to_nasionalre_idr)}</td>
                        <td>${new Date(Date(ls.created_at)).toLocaleDateString(
                            "en-GB"
                        )}</td>
                        <td><button class="btn btn-sm btn-primary" type="button" onclick="cancelReplace(${
                            ls.id
                        })">Cancel Replace</button></td>
                        </tr>
                    `
                );
            });

            $("#prop_id").val(summary.id);
            $("#nasionalre_share_first").html(
                summary.getsubdetail.nasionalre_share_first
            );
            $("#nasionalre_share_second").html(
                summary.getsubdetail.nasionalre_share_second
            );
            $("#tbody_loss_participation tr").remove();
            _.each(summary.getsubdetail.getloss, function (loss) {
                $("#tbody_loss_participation").append(
                    `
                    <tr>  
                        <td>${loss.share}%</td>
                        <td>${loss.loss_ratio_first}%</td>
                        <td>${loss.loss_ratio_second}%</td>
                    </tr>
                    `
                );
            });

            var premium_idr = 0;
            var premium_usd = 0;
            var premium_roe = 0;
            var premium_total = 0;

            var commission_idr = 0;
            var commission_usd = 0;
            var commission_roe = 0;
            var commission_total = 0;

            var claim_idr = 0;
            var claim_usd = 0;
            var claim_roe = 0;
            var claim_total = 0;

            var reserves_idr = 0;
            var reserves_usd = 0;
            var reserves_roe = 0;
            var reserves_total = 0;

            _.each(soa, function (s) {
                if (s.currency == 2) {
                    premium_idr += parseFloat(s.nasionalre_gross_premium);
                    commission_idr += parseFloat(s.nasionalre_r_i_comm_amount);
                    claim_idr += parseFloat(s.nasionalre_claim_recovery);
                    reserves_idr += parseFloat(s.treaty_premium_reserved);

                    premium_usd += parseFloat(
                        s.nasionalre_gross_premium / s.to_usd.kurs
                    );
                    commission_usd += parseFloat(
                        s.nasionalre_r_i_comm_amount / s.to_usd.kurs
                    );
                    claim_usd += parseFloat(
                        s.nasionalre_claim_recovery / s.to_usd.kurs
                    );
                    reserves_usd += parseFloat(
                        s.treaty_premium_reserved / s.to_usd.kurs
                    );
                    usd = s.to_usd.kurs;
                } else if (s.currency == 1) {
                    premium_usd += parseFloat(s.nasionalre_gross_premium);
                    commission_usd += parseFloat(s.nasionalre_r_i_comm_amount);
                    claim_usd += parseFloat(s.nasionalre_claim_recovery);
                    reserves_usd += parseFloat(s.treaty_premium_reserved);

                    premium_idr += parseFloat(
                        s.to_idr.kurs * s.nasionalre_gross_premium
                    );
                    commission_idr += parseFloat(
                        s.to_idr.kurs * s.nasionalre_r_i_comm_amount
                    );
                    claim_idr += parseFloat(
                        s.to_idr.kurs * s.nasionalre_claim_recovery
                    );
                    reserves_idr += parseFloat(
                        s.to_idr.kurs * s.treaty_premium_reserved
                    );
                }
            });
            $(".roe").val(summary.getsubdetail.roe);

            $(".earned-premium-idr").val(premium_idr);
            $(".commission-idr").val(commission_idr);
            $(".claim-idr").val(claim_idr);
            $(".reserves-idr").val(reserves_idr);

            $(".earned-premium-usd").val(premium_usd);
            $(".commission-usd").val(commission_usd);
            $(".claim-usd").val(claim_usd);
            $(".reserves-usd").val(reserves_usd);

            premium_roe = premium_usd * summary.getsubdetail.roe;
            commission_roe = commission_usd * summary.getsubdetail.roe;
            claim_roe = claim_usd * summary.getsubdetail.roe;
            reserves_roe = reserves_usd * summary.getsubdetail.roe;

            $(".earned-premium-roe").val(premium_roe);
            $(".commission-roe").val(commission_roe);
            $(".claim-roe").val(claim_roe);
            $(".reserves-roe").val(reserves_roe);

            premium_total = premium_idr + premium_roe;
            commission_total = commission_idr + commission_roe;
            claim_total = claim_idr + claim_roe;
            reserves_total = reserves_idr + reserves_roe;

            $(".earned-premium-total").val(premium_total);
            $(".commission-total").val(commission_total);
            $(".claim-total").val(claim_total);
            $(".reserves-total").val(reserves_total);

            var total_loss_figure =
                premium_total + commission_total + claim_total + reserves_total;
            $(".total-loss-figures").val(total_loss_figure);

            var loss_figure = claim_total + reserves_total;
            $(".loss-figure").val(loss_figure);

            $(".final-commission").val(commission_total);

            var combined_ratio =
                (loss_figure + commission_total) / premium_total;
            $(".combined-ratio").val(combined_ratio);

            var combined_ratio_less_percentage = combined_ratio - 100;
            $(".combined-ratio-less-percentage").val(
                combined_ratio_less_percentage
            );

            var combined_ratio_less_amount =
                (combined_ratio_less_percentage / combined_ratio) *
                total_loss_figure;
            $(".combined-ratio-less-amount").val(combined_ratio_less_amount);

            $(".of-loss-figure").val(combined_ratio_less_amount * 0.3);

            $(".earned-premium-as-at-idr").val(premium_total);

            $(".earned-premium-as-at-usd").val(premium_total / usd);

            $(".nasionalre-share").val(
                (summary.getsubdetail.nasionalre_share_first *
                    summary.getsubdetail.nasionalre_share_second) /
                    100
            );

            $(".loss-participation-idr").val(
                (premium_total * $(".nasionalre-share").val()) / 100
            );

            $(".loss-participation-usd").val(
                (premium_total * $(".nasionalre-share").val()) / 100 / usd
            );

            $(".due-to-nasionalre-idr").val(
                (premium_total * $(".nasionalre-share").val()) / 100
            );

            $(".due-to-nasionalre-usd").val(
                (premium_total * $(".nasionalre-share").val()) / 100 / usd
            );
        }
    });
}
//end of region submit filter

//region if id not null
if ($("#loss_id").val()) {
    $("#loss_form").prop(
        "action",
        "/treaty/loss/update/" + $("#loss_id").val()
    );
}
//end of region if id not null

$("#as_at").change(function () {
    $(".as-at").html(this.value);
});

$("#earned_premium_idr, #earned_premium_usd").on("input", function () {
    var epi = $("#earned_premium_idr").val();
    var epu = $("#earned_premium_usd").val();
    var epr = $("#earned_premium_roe").val();
    var roe = $("#roe").val();
    epr = roe * epu;
    var res = parseFloat(epi) + parseFloat(epr);
    $("#earned_premium_roe").val(epr);
    $("#earned_premium_total").val(res).change();
    $("#earned_premium_as_at_idr").val(res).change();
});

$("#commission_idr, #commission_usd").on("input", function () {
    var ci = $("#commission_idr").val();
    var cu = $("#commission_usd").val();
    var cr = $("#commission_roe").val();
    var roe = $("#roe").val();
    cr = roe * cu;
    var res = parseFloat(ci) + parseFloat(cr);
    $("#commission_roe").val(cr);
    $("#commission_total").val(res).change();
});

$("#claim_idr, #claim_usd").on("input", function () {
    var ci = $("#claim_idr").val();
    var cu = $("#claim_usd").val();
    var cr = $("#claim_roe").val();
    var roe = $("#roe").val();
    cr = roe * cu;
    var res = parseFloat(ci) + parseFloat(cr);
    $("#claim_roe").val(cr);
    $("#claim_total").val(res).change();
});

$("#reserves_idr, #reserves_usd").on("input", function () {
    var ri = $("#reserves_idr").val();
    var ru = $("#reserves_usd").val();
    var rr = $("#reserves_roe").val();
    var roe = $("#roe").val();
    rr = roe * ru;
    var res = parseFloat(ri) + parseFloat(rr);
    $("#reserves_roe").val(rr);
    $("#reserves_total").val(res).change();
});

$(
    "#earned_premium_total, #commission_total, #claim_total, #reserves_total"
).change(function () {
    var ept = $("#earned_premium_total").val();
    var ct = $("#commission_total").val();
    var clt = $("#claim_total").val();
    var rt = $("#reserves_total").val();
    if (clt != "" && rt != "") {
        if (ept != "" && ct != "") {
            var res =
                parseFloat(ept) +
                parseFloat(ct) +
                parseFloat(clt) +
                parseFloat(rt);
            $("#total_loss_figures").val(res);
            $("#final_commission").val(ct);
            $("#combined_ratio")
                .val(
                    (parseFloat(ct) + parseFloat(clt) + parseFloat(rt)) /
                        parseFloat(ept)
                )
                .change();
        }
        $("#loss_figure").val(parseFloat(clt) + parseFloat(rt));
    }
});

$("#combined_ratio, #combined_ratio_less_loss_percentage").change(function () {
    var cr = $("#combined_ratio").val();
    var crllp = $("#combined_ratio_less_loss_percentage").val();
    var tlf = $("#total_loss_figures").val();
    var res = parseFloat(cr) - parseFloat(crllp);
    $("#combined_ratio_less_percentage").val(res);
    $("#combined_ratio_less_amount")
        .val(res * tlf)
        .change();
});

$("#combined_ratio_less_amount").change(function () {
    $("#of_loss_figure").val(parseFloat(this.value) * 0.3);
});

function cancelReplace(id) {
    axios.get("/treaty/loss/cancelreplace/" + id).then((res) => {
        console.log(res.data);
        location.reload();
    });
}
