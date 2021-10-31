function cancel_filter() {
    $("#claiminsured").hide();
    $("#form_filter")[0].reset();
    $("#form_filter .e1").val("").change();
}

async function submit_filter(data) {
    var _data = {
        koc: data.koc.value,
        cob: data.cob.value,
        ceding: data.ceding.value,
        insured: data.insured.value,
        uy: data.uy.value,
        ref_no: data.ref_no.value,
    };

    var empty_input = [];
    _.each(_data, (e) => {
        e == "" ? empty_input.push(false) : empty_input.push(true);
    });

    if (!_.some(empty_input)) {
        toastr.warning("Empty filter field!");
    } else {
        $("body").addClass("loading");
        $("#claiminsured").hide();
        $("#mainbodylocations tr").remove();
        $("#mainbodyslips tr").remove();

        var res = await axios
            .post("/claim/filter", _data)
            .then((res) => res.data);

        $("#claiminsured").show();

        var loc_id = 0;
        _.each(res.locations, (data, address) => {
            locationtable(address, loc_id);
            _.each(data, (d, i) => {
                if (
                    typeof window[`var_${d.translocationtemp.slip.number}`] ===
                    "undefined"
                )
                    window[`var_${d.translocationtemp.slip.number}`] = [];
                d.active = false;
                window[`var_${d.translocationtemp.slip.number}`].push(d);
                interesttable(loc_id, d, i);
            });
            loc_id += 1;
        });
        _.each(res.slips, (s) => (s.status != "cancel" ? sliptable(s) : ""));

        $("body").removeClass("loading");

        res.slips?.length > 0
            ? toastr.success(res.slips?.length + " Slip(s) founded!")
            : toastr.info("No Slip Founded!");
    }
}

function interesttable(id, data, i) {
    $("#slipinsured" + id).append(`
    <tr>
        <td>${data.cedingbroker.company_name}</td>
        <td>${data.interestdata.code} - ${data.interestdata.description}</td>
        <td>${data.cndn ?? "-"}</td>
        <td>${data.certno ?? "-"}</td>
        <td>${data.slipno ?? "-"}</td>
        <td>${data.policyno ?? "-"}</td>
        <td>${Number(data.percentage).toFixed(2)}%</td>
        <td>
            ${moneyFormat(data.amountlocation)}
        </td>
        <td>
            <input type='checkbox' id="check${data.id}" 
            name="interestinsured${data.translocationtemp.slip.number}">
        </td>
    </tr>
    `);
    $("#check" + data.id).change(function () {
        if (this.checked) {
            window[`var_${data.translocationtemp.slip.number}`][
                i
            ].active = true;
            $(
                "button[name=btn" + data.translocationtemp.slip.number + "]"
            ).prop("disabled", false);
        } else {
            window[`var_${data.translocationtemp.slip.number}`][
                i
            ].active = false;
            var isdisabled = [];
            $(
                "input[name=interestinsured" +
                    data.translocationtemp.slip.number +
                    "]"
            ).each((i, e) => isdisabled.push(e.checked));
            $(
                "button[name=btn" + data.translocationtemp.slip.number + "]"
            ).prop("disabled", !_.some(isdisabled));
        }
    });
}

function locationtable(address, id) {
    $("#mainbodylocations").append(`
    <tr>
        <td colspan="2">${address}</td>
    </tr>
    <tr style="border-bottom: 2px black solid;">
        <td width='15%'></td>
        <td colspan="2">
            <table class="table table-bordered table-striped" style="table-layout: fixed;">
                <thead>
                    <tr>
                        <th width='20%'>Ceding Source</th>
                        <th width='15%'>Interest Insured</th>
                        <th>CN/DN</th>
                        <th>Cert No</th>
                        <th>Slip No</th>
                        <th>Policy No</th>
                        <th>Share%</th>
                        <th width='15%'>Amount</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id='slipinsured${id}'></tbody>
            </table>
        </td>
    </tr>
    `);
}

function sliptable(slip) {
    var date_transfer = slip.date_transfer
        ? dateFormat(slip.date_transfer)
        : "-";
    $("#mainbodyslips").append(`
    <tr>
        <td>${slip.number}</td>
        <td>${slip.cedingbroker.name}</td>
        <td>${slip.ceding.name}</td>
        <td>
        ${dateFormat(slip.reinsurance_period_from)} 
            - 
        ${dateFormat(slip.reinsurance_period_to)}
        </td>
        <td>${slip.status}</td>
        <td>
        ${date_transfer}
        </td>
        <td>${slip.username ?? "-"}</td>
        <td>
            <button type="button" id='btn${slip.id}' 
            name="btn${slip.number}" 
            onclick="open_slip_modal('${slip.id}')"
            class="btn btn-sm btn-primary mx-auto" disabled>
                Detail Slip
            </button>
        </td>
    </tr>
    `);
}

function treatAsUTC(date) {
    var result = new Date(date);
    result.setMinutes(result.getMinutes() - result.getTimezoneOffset());
    return result;
}

function daysBetween(startDate, endDate) {
    var millisecondsPerDay = 24 * 60 * 60 * 1000;
    return (treatAsUTC(endDate) - treatAsUTC(startDate)) / millisecondsPerDay;
}

var slipdetail;

async function open_slip_modal(number) {
    $("body").addClass("loading");
    var doctype = "fe";
    var insuredslip = await axios
        .get(
            "/claimtransaction-data/" +
                doctype +
                "/getInsuredandRiskLocation/" +
                number
        )
        .then((res) => {
            var insured = res.data.insureddata;
            console.log(insured);
            $("#feuy").val(insured.uy);
            $("#insurednumber").val(res.data.insured_id);

            if (insured?.prefixinsured?.code && insured?.prefixinsured?.name) {
                var _prefix =
                    insured.prefixinsured.code +
                    " - " +
                    insured.prefixinsured.name;
            } else {
                var _prefix = "-";
            }

            $("#insuredprefix").val(_prefix);

            $("#insuredname").val(insured.insured_name);
            $("#insuredsuffix").val(insured.insured_suffix);

            $("#insuredsharefrom").val(moneyFormat(insured.share_from));
            $("#insuredshareto").val(moneyFormat(insured.share_to));
            $("#insuredshare").val(moneyFormat(insured.share));

            if (insured?.currency?.code && insured?.currency?.symbol_name) {
                var _curr =
                    insured.currency.code +
                    " - " +
                    insured.currency.symbol_name;
            } else {
                var _curr = "-";
            }

            $("#insuredcurrency").val(_curr);
            return res.data;
        });
    slipdetail = insuredslip;
    if (doctype == "mc") {
        $("#shipbody").empty();
        // console.log('here', insuredslip.ships);
        var ships = _.groupBy(insuredslip.ships, "name");
        _.each(ships, function (ship, key) {
            console.log("here", ship, key);
            $("#shipbody").append(`
          <tr>
            <td>${ship[0].slip.ceding.name}</td>
            <td>${ship[0].insured.insured_name}</td>
            <td>${ship[0].name}</td>
          </tr>
          <tr style="border-bottom: 2px black solid;">
          <td width='15%'></td>
          <td colspan="2">
              <table class="table table-bordered table-striped" style="table-layout: fixed;">
                  <thead>
                      <tr>
                          <th width='15%'>Interest Insured</th>
                          <th width='20%'>Ceding Source</th>
                          <th>CN/DN</th>
                          <th>Cert No</th>
                          <th>Slip No</th>
                          <th>Policy No</th>
                          <th>Share%</th>
                          <th width='15%'>Amount</th>
                      </tr>
                  </thead>
                  <tbody id='slipinsured${ship[0].id}'></tbody>
              </table>
          </td>
      </tr>
          `);
            _.each(ship, function (shp, asd) {
                _.each(shp.interest, function (ins, _key) {
                    console.log("ins", ins);
                    $("#slipinsured" + ins.ship_id).append(`
                <tr>
                    <td>${
                        ins?.interestinsureddata?.code || ""
                    } - ${ins?.interestinsureddata?.description || ""}</td>
                    <td>${ins?.cedingdata?.company_name}</td>
                    <td>${ins.cndn ?? "-"}</td>
                    <td>${ins.certno ?? "-"}</td>
                    <td>${ins.slipno ?? "-"}</td>
                    <td>${ins.policyno ?? "-"}</td>
                    <td>${Number(ins.percent).toFixed(2)}%</td>
                
                    <td>${ins.amount
                        .toString()
                        .replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</td>
                    </td>
                </tr>
                `);
                });
            });
        });
    } else if (doctype == "mh") {
        $("#shipbody").empty();
        insuredslip.ships.forEach((ship) => {
            $("#shipbody").append(
                `
          <tr>
          <input type='hidden' id='share${ship.insured.slip.number}${
                    ship.id
                }' value='${ship.percent}'>
            <input type='hidden' id='ship${ship.insured.slip.number}${
                    ship.id
                }' value='${ship.id}'>
            <input type='hidden' id='amount${ship.insured.slip.number}${
                    ship.id
                }' value='${ship.amount}'>
            <input type='hidden' id='koc${ship.insured.slip.number}${
                    ship.id
                }' value='${ship.insured.slip.koc}'>
            <input type='hidden' id='cob${ship.insured.slip.number}${
                    ship.id
                }' value='${ship.insured.slip.cob}'>
            <input type='hidden' id='cedingdata${ship.insured.slip.number}${
                    ship.id
                }' value='${ship.ceding_id}'>
            <td>${ship.cedingdata.name}</td>
            <td>${ship.insured.insured_name}</td>
            <td>${ship.ship_name}</td>
            <td>${ship.cndn || "-"}</td>
            <td>${ship.certno || "-"}</td>
            <td>${ship.slipno || "-"}</td>
            <td>${ship.policyno || "-"}</td>
            <td>${Number(ship.percent).toFixed(2)}%</td>
            <td>${ship.amount
                .toString()
                .replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</td>
          </tr>
            `
            );
        });
    } else {
        $("#locationslist").empty();
        insuredslip.insureddata.locations.forEach((loc, index) => {
            $("#locationslist").append(`
            <tr>
              <td>${loc.felookuplocation.loc_code}</td>
              <td>${loc.felookuplocation.address}</td>
              <td>${loc.felookuplocation.latitude} - ${loc.felookuplocation.longtitude}</td>
            </tr>
            <tr>
              <td></td>
              <td colspan=2>
                <table class="table table-bordered table-striped" style="table-layout: fixed;">
                  <tr>
                    <th>Ceding Source</th>
                    <th>Interest Insured</th>
                    <th>CN/DN</th>
                    <th>Cert No</th>
                    <th>Slip No</th>
                    <th>Policy No</th>
                    <th>Share %</th>
                    <th>Amount</th>
                  </tr>
                  <tbody id="risklocation${index}"></tbody>  
                </table>  
              </td>
            </tr>
           `);
            $("#risklocation" + index).empty();
            loc.risklocationdetail.forEach((rld) => {
                $("#risklocation" + index).append(`
                  <tr>
                    <td>${rld.cedingbroker.name}</td>
                    <td>${rld.interestdata.code} - ${
                    rld.interestdata.description
                }</td>
                    <td>${rld.cndn ?? "-"}</td>
                    <td>${rld.certno ?? "-"}</td>
                    <td>${rld.slipno ?? "-"}</td>
                    <td>${rld.policyno ?? "-"}</td>
                    <td>${Number(rld.percentage).toFixed(2)}%</td>
                    <td>${rld.amountlocation
                        .toString()
                        .replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</td>
                  </tr>
              `);
            });
        });
    }

    var codesl = number;
    var sliptype = $("#sliptypeform").val() ?? "fe";
    $.ajax({
        url: "/transaction-data/" + sliptype + "/detail-slip/" + codesl,
        type: "GET",
        beforeSend: function () {
            $("body").addClass("loading");
        },
        complete: function () {
            $("body").removeClass("loading");
        },
        success: function (response) {
            $("#slipnumberdetail").val(response.number);
            $("#slipusernamedetail").val(response.username);
            $("#slipprodyeardetail").val(response.prod_year);
            $("#slipuydetail").val(response.uy);
            $("#slipeddetail").val(response.endorsment);
            $("#slipslsdetail").val(response.selisih);
            $("#wpcdetail").val(response.wpc);

            $("#slipvbrokerdetail").val(floatToString(response.v_broker));

            if (
                response.deductible_panel &&
                response.deductible_panel.length > 10
            ) {
                var deductibledata = JSON.parse(response.deductible_panel);
                $("#deductiblePaneldetail tbody").empty();
                for (var i = 0; i < deductibledata.length; i++) {
                    var obj = deductibledata[i];
                    if (obj) {
                        $("#deductiblePaneldetail tbody").append(
                            '<tr id="iiddeductible' +
                                obj.id +
                                '" data-name="deductibledetailvalue[]"><td data-name="' +
                                obj.deductibletype +
                                '">' +
                                obj.deductibletype +
                                '</td><td data-name="' +
                                floatToString(
                                    parseFloat(obj.percentage).toFixed(2)
                                ) +
                                '">' +
                                floatToString(
                                    parseFloat(obj.percentage).toFixed(2)
                                ) +
                                '%</td><td data-name="' +
                                amountToString(obj.amount) +
                                '">' +
                                amountToString(obj.amount) +
                                '</td><td data-name="' +
                                amountToString(obj.min_claimamount) +
                                '">' +
                                amountToString(obj.min_claimamount) +
                                "</td><td></td></tr>"
                        );
                    }
                }
            }

            if (
                response.extend_coverage &&
                response.extend_coverage.length > 10
            ) {
                var extend_coverage = JSON.parse(response.extend_coverage);
                $("#ExtendCoveragePaneldetail tbody").empty();
                for (var i = 0; i < extend_coverage.length; i++) {
                    var obj = extend_coverage[i];
                    if (obj) {
                        $("#ExtendCoveragePaneldetail tbody").append(
                            '<tr id="iidextendcoveragedetail' +
                                obj.id +
                                '" data-name="extendcoveragedetailvalue[]"><td data-name="' +
                                obj.coveragetype +
                                '">' +
                                obj.coveragecode +
                                " - " +
                                obj.coveragename +
                                '</td><td data-name="' +
                                obj.percentage +
                                '">' +
                                floatToString(
                                    parseFloat(obj.percentage).toFixed(5)
                                ) +
                                '</td><td data-name="' +
                                amountToString(obj.amount) +
                                '" class="uangdata">' +
                                amountToString(obj.amount) +
                                "</td><td></td></tr>"
                        );
                    }
                }
            }

            if (
                response.installment_panel &&
                response.installment_panel.length > 10
            ) {
                var installment_panel = JSON.parse(response.installment_panel);
                $("#installmentPaneldetail tbody").empty();
                for (var i = 0; i < installment_panel.length; i++) {
                    var obj = installment_panel[i];
                    currdate = obj.installment_date;
                    var convdate = currdate.split("-").reverse().join("/");
                    var strdate = convdate.toString();
                    $("#installmentPaneldetail tbody").append(
                        '<tr id="iidinstallmentdetail' +
                            obj.id +
                            '" data-name="installmentdetailvalue[]"><td data-name="' +
                            obj.installment_date +
                            '">' +
                            strdate +
                            '</td><td data-name="' +
                            obj.percentage +
                            '">' +
                            floatToString(obj.percentage) +
                            '%</td><td data-name="' +
                            amountToString(obj.amount) +
                            '" class="uangdata">' +
                            amountToString(obj.amount) +
                            "</td><td></td></tr>"
                    );
                }
            }

            if (
                response.retrocession_panel &&
                response.retrocession_panel.length > 10
            ) {
                var retrocession_panel = JSON.parse(
                    response.retrocession_panel
                );
                $("#retrocessionPaneldetail tbody").empty();
                var totalPercent = 0;
                for (var i = 0; i < retrocession_panel.length; i++) {
                    var obj = retrocession_panel[i];

                    if (obj.amount) {
                        totalPercent += obj.percentage;
                        $("#retrocessionPaneldetail tbody").append(
                            '<tr id="iidretrocessiondetail' +
                                obj.id +
                                '" data-name="retrocessiondetailvalue[]"><td data-name="' +
                                obj.contract +
                                '">' +
                                obj.contract +
                                '</td><td data-name="' +
                                obj.percentage +
                                '">' +
                                floatToString(obj.percentage) +
                                '%</td><td data-name="' +
                                amountToString(obj.amount) +
                                '">' +
                                amountToString(obj.amount) +
                                "</td><td></td></tr>"
                        );
                    }
                }
            }

            if (response.status) $("#slipstatusdetail").val(response.status);

            if (response.source)
                $("#slipcedingbrokerdetail")
                    .val(response.source)
                    .trigger("change");

            if (response.source_2)
                $("#slipcedingdetail").val(response.source_2).trigger("change");

            if (response.currency)
                $("#slipcurrencydetail").val(response.currency).change();

            if (response.cob) $("#slipcobdetail").val(response.cob).change();

            if (response.koc) $("#slipkocdetail").val(response.koc).change();

            if (response.occupacy)
                $("#slipoccupacydetail").val(response.occupacy).change();

            if (response.build_const)
                $("#slipbld_constdetail").val(response.build_const).change();

            $("#slipbcuadetail").val(response.build_rate_up);
            $("#slipbcladetail").val(response.build_rate_down);

            if (response.insured_type)
                $("#sliptypedetail").val(response.insured_type).change();

            if (response.layer_non_proportional)
                $("#sliplayerproportionaldetail")
                    .val(response.layer_non_proportional)
                    .change();

            if (response.retro_backup) {
                // $("#sliprbdetail option[value=" + response.retro_backup + "]:first")[0].selected = true;
                if (response.retro_backup == "NO") {
                    $("#tabretrodetail").attr("hidden", "true");
                } else if (response.retro_backup == "YES") {
                    $("#tabretrodetail").removeAttr("hidden");
                }
            }

            if (response.type_tsi)
                $("#sliptypetsidetail").val(response.type_tsi).change();

            if (response.type_share_tsi)
                $("#sharetypetsidetail").val(response.type_share_tsi).change();

            if (response.status_log) {
                $("#statuslogdetailform tbody").empty();
                var status_log = response.status_log;

                for (var i = 0; i < status_log.length; i++) {
                    var status = status_log[i].status;
                    var datetime = status_log[i].datetime;
                    var user = status_log[i].user;

                    $("#statuslogdetailform tbody").append(
                        '<tr id="stlid' +
                            status_log[i].id +
                            '"> <td>' +
                            status +
                            "</td> <td >" +
                            datetime +
                            "</td> <td>" +
                            user +
                            "</td> </tr>"
                    );
                    // $('#statlistdetail').append('<li><div class="control-group input-group" id="control-group2" style="margin-top:10px">'+datetime+' - '+ status + ' - ' + user +'</div></li>')
                }
            }

            if (response.attacment_file) {
                $("#aidlistdetail li").remove();
                var attacment_file = response.attacment_file;
                for (var i = 0; i < attacment_file.length; i++) {
                    var filename = attacment_file[i].filename;
                    $("#aidlistdetail").append(
                        '<li><div class="control-group input-group" id="control-group2" style="margin-top:10px"><a href="{{ asset("files")}}/' +
                            filename +
                            '">' +
                            filename +
                            "</a></div></li>"
                    );
                }
            }

            $("#slipnodetail").val(response.slip_no);
            $("#slipcndndetail").val(response.cn_dn);
            $("#slippolicy_nodetail").val(response.policy_no);
            if (response.total_sum_insured) {
                var conv_tsi = floatToString(response.total_sum_insured);
                $("#sliptotalsumdetail").val(conv_tsi);
            } else {
                $("#sliptotalsumdetail").val("0");
            }

            if (response.share_tsi) {
                var conv_stsi = amountToString(response.share_tsi);
                $("#sharetotalsumdetail").val(conv_stsi);
            } else {
                $("#sharetotalsumdetail").val("0");
            }

            if (response.insured_pct) {
                $("#slippctdetail").val(floatToString(response.insured_pct));
            } else {
                $("#slippctdetail").val("0");
            }

            if (response.total_sum_pct) {
                var conv_spct = floatToString(response.total_sum_pct);
                $("#sliptotalsumpctdetail").val(conv_spct);
            } else {
                $("#sliptotalsumpctdetail").val("0");
            }

            if (
                response.date_transfer == null ||
                response.date_transfer == ""
            ) {
                $("#sliptddetail").val("");
            } else {
                $("#sliptddetail").val(response.date_transfer);
            }

            $("#slipipfromdetail").val(response.insurance_period_from);
            $("#slipiptodetail").val(response.insurance_period_to);

            var insurance_period_from2 = response.insurance_period_from
                .split("/")
                .reverse()
                .join("-");
            var insurance_period_to2 = response.insurance_period_to
                .split("/")
                .reverse()
                .join("-");
            var days = daysBetween(
                insurance_period_from2,
                insurance_period_to2
            );

            var sum = isNaN(days / 365) ? 0 : (days / 365).toFixed(9);
            var constday = days.toString() + "/365";

            $("#slipdaytotaldetail").val(days);
            $("#slipdaytotaldetail2").val(days);
            $("#slipdaytotaldetail3").val("365");
            $("#slipdaytotaldetail4").val("365");

            $("#sliptotalsumdatedetail").val(floatToString(sum));

            $("#sliprpfromdetail").val(response.reinsurance_period_from);
            $("#sliprptodetail").val(response.reinsurance_period_to);

            $("#switch-proportionaldetail").val(response.proportional);
            // if(response.proportional == ''){
            $("#btnaddlayerdetail").attr("hidden", "true");
            $("#sliplayerproportionaldetail").attr("hidden", "true");
            $("#labelnonpropdetail").attr("hidden", "true");
            $("#labelnpdetail").attr("hidden", "true");
            // }
            if (response.rate) {
                $("#slipratedetail").val(floatToString(response.rate));
            } else {
                $("#slipratedetail").val("0");
            }

            if (response.share) {
                $("#slipsharedetail").val(floatToString(response.share));
            } else {
                $("#slipsharedetail").val("0");
            }

            if (response.sum_share) {
                var conv_sshare = floatToString(response.sum_share);
                $("#slipsumsharedetail").val(conv_sshare);
                $("#slipsumsharedetail2").val(conv_sshare);
            } else {
                $("#slipsumsharedetail").val("0");
                $("#slipsumsharedetail2").val("0");
            }

            if (response.sum_rate) {
                var conv_srate = floatToString(response.sum_rate);
                $("#sliptotalratedetail").val(conv_srate);
                $("#sliptotalratedetail2").val(conv_srate);
            } else {
                $("#sliptotalratedetail").val("0");
                $("#sliptotalratedetail2").val("0");
            }

            if (response.sum_feebroker) {
                var conv_sf = amountToString(response.sum_feebroker);
                $("#slipsumfeedetail").val(conv_sf);
                $("#slipsumfeedetail2").val(conv_sf);
            } else {
                $("#slipsumfeedetail").val("0");
                $("#slipsumfeedetail2").val("0");
            }

            if (response.basic_premium) {
                var conv_bp = amountToString(response.basic_premium);
                $("#slipbasicpremiumdetail").val(conv_bp);
            } else {
                $("#slipbasicpremiumdetail").val("0");
            }

            if (response.grossprm_to_nr) {
                var conv_gprtnr = amountToString(response.grossprm_to_nr);
                $("#slipgrossprmtonrdetail").val(conv_gprtnr);
                $("#slipgrossprmtonrdetail2").val(conv_gprtnr);
            } else {
                $("#slipgrossprmtonrdetail").val("0");
                $("#slipgrossprmtonrdetail2").val("0");
            }

            if (response.commission) {
                $("#slipcommissiondetail").val(
                    floatToString(response.commission)
                );
            } else {
                $("#slipcommissiondetail").val(0);
            }

            if (response.sum_commission) {
                var conv_sc = floatToString(response.sum_commission);
                $("#slipsumcommissiondetail").val(conv_sc);
                $("#slipsumcommissiondetail2").val(conv_sc);
            } else {
                $("#slipsumcommissiondetail").val("0");
                $("#slipsumcommissiondetail2").val("0");
            }

            if (response.netprm_to_nr) {
                var conv_nprmtnr = amountToString(response.netprm_to_nr);
                $("#slipnetprmtonrdetail").val(conv_nprmtnr);
                $("#slipnetprmtonrdetail2").val(conv_nprmtnr);
            } else {
                $("#slipnetprmtonrdetail").val("0");
                $("#slipnetprmtonrdetail2").val("0");
            }

            if (response.own_retention) {
                $("#slipordetail").val(floatToString(response.own_retention));
            } else {
                $("#slipordetail").val(0);
            }

            if (response.sum_own_retention) {
                var conv_sor = floatToString(response.sum_own_retention);
                $("#slipsumordetail").val(conv_sor);
            } else {
                $("#slipsumordetail").val("0");
            }

            $("#countendorsmentdetail").val(response.endorsment);
            $("#countendorsmentdetail2").val(response.endorsment);
            $("#remarksdetail").val(response.remarks);

            toastr.success("Data Show!");
        },
        error: function (request, status, error) {
            toastr.error("Get Data Error!");
        },
    });
    $("#detailmodaldata").modal("toggle");
}

$("#claimbutton").click(function () {
    console.log(window[`var_${slipdetail.number}`]);
    var amount = _.sumBy(window[`var_${slipdetail.number}`], (o) =>
        o.active ? parseFloat(o.amountlocation) : 0
    );
    $(".cob").val(slipdetail.cob).change();
    $(".koc").val(slipdetail.koc).change();
    $("#uy").val(slipdetail.insureddata.uy);
    $("#doc_ref_number").val(slipdetail.number);
    $("#reinsurance_periode_from").val(
        dateFormat(slipdetail.reinsurance_period_from)
    );
    $("#reinsurance_periode_to").val(
        dateFormat(slipdetail.reinsurance_period_to)
    );
    $("#date_of_loss").datepicker(
        "setStartDate",
        dateFormat(slipdetail.reinsurance_period_from)
    );
    $("#date_of_loss").datepicker(
        "setEndDate",
        dateFormat(slipdetail.reinsurance_period_to)
    );

    $("#nasionalre_liab_percentage").val(parseFloat(slipdetail.share));
    $("#nasionalre_liab_amount").val(
        (amount * parseFloat(slipdetail.share)) / 100
    );
});
