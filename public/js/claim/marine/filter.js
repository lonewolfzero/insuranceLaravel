console.log("filter");
var slip_data = {};

function shiptable(ship, key, martype) {
    console.log(ship);
    slip_data.ship = key;
    return `
      <tr>
          ${
              martype == "hull"
                  ? `
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
                    <input type='hidden' id='cedingdata${
                        ship.insured.slip.number
                    }${ship.id}' value='${ship.ceding_id}'>
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
                    <td>
                        <input type='checkbox' id="check${
                            ship.id
                        }" name="interestinsured${ship.insured.slip.number}">
                    </td>
                    `
                  : `
                    <td>${ship.slip.ceding.name}</td>
                    <td>${ship.insured.insured_name}</td>
                    <td>${ship.name}</td>
                  `
          }
      </tr>
      ${
          martype == "hull"
              ? ""
              : `
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
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tbody id='slipinsured${key}'></tbody>
              </table>
          </td>
      </tr>
      `
      }
      
  `;
}

function interesttable(ins) {
    console.log(ins);
    return `
    <tr>
        <input type='hidden' id='share${ins.slip_number}${ins.id}' value='${
        ins.percent
    }'>

        <input type='hidden' id='amount${ins.slip_number}${ins.id}' value='${
        ins.amount
    }'>

        <input type='hidden' id='interestdata${ins.slip_number}${
        ins.id
    }' value='${ins?.interestinsureddata.id}'>

        <input type='hidden' id='cedingdata${ins.slip_number}${
        ins.id
    }' value='${ins?.cedingdata?.id}'>

        <input type='hidden' id='cndn${ins.slip_number}${ins.id}' value='${
        ins.cndn ?? ""
    }'>

        <input type='hidden' id='cert${ins.slip_number}${ins.id}' value='${
        ins.certno ?? ""
    }'>

        <input type='hidden' id='slip${ins.slip_number}${ins.id}' value='${
        ins.slipno ?? ""
    }'>

        <input type='hidden' id='policy${ins.slip_number}${ins.id}' value='${
        ins.policyno ?? ""
    }'>

        <input type='hidden' id='ship${ins.slip_number}${ins.id}' value='${
        ins.ship_id
    }'>

        <td>${ins?.interestinsureddata?.code || ""} - ${
        ins?.interestinsureddata?.description || ""
    }</td>
        <td>${ins?.cedingdata?.company_name}</td>
        <td>${ins.cndn ?? "-"}</td>
        <td>${ins.certno ?? "-"}</td>
        <td>${ins.slipno ?? "-"}</td>
        <td>${ins.policyno ?? "-"}</td>
        <td>${Number(ins.percent).toFixed(2)}%</td>
    
        <td>${ins.amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</td>
        <td>
            <input type='checkbox' id="check${ins.id}" name="interestinsured${
        ins.slip_number
    }">
        </td>
    </tr>
    `;
}

function sliptable(slip) {
    return `
        <tr>
            <input type='hidden' id='number_slip${slip.id}' value='${
        slip.number
    }'>
            <input type='hidden' id='uy${slip.id}' value='${slip.uy}'>
            <input type='hidden' id='kocid${slip.id}' value='${slip.koc}'>
            <input type='hidden' id='koc${slip.id}' value='${
        slip.kindcontract.code
    }'>
            <input type='hidden' id='cobid${slip.id}' value='${slip.cob}'>
            <input type='hidden' id='cob${slip.id}' value='${
        slip.corebusiness.code
    }'>
            <input type='hidden' id='broker_slip${slip.id}' value='${
        slip.cedingbroker.name
    }'>
            <input type='hidden' id='ceding_slip${slip.id}' value='${
        slip.ceding.name
    }'>
            <input type='hidden' id='status_slip${slip.id}' value='${
        slip.status
    }'>
            <input type='hidden' id='date_transfer${slip.id}' value='${
        slip.date_transfer
    }'>
            <input type='hidden' id='reinsurance_from${slip.number}' value='${
        slip.reinsurance_period_from
    }'>
            <input type='hidden' id='reinsurance_to${slip.number}' value='${
        slip.reinsurance_period_to
    }'>
            <input type='hidden' id='currency${slip.number}' value='${
        slip.currency
    }'>

            <td>${slip.number}</td>
            <td>${slip.cedingbroker.name}</td>
            <td>${slip.ceding.name}</td>
            <td>${slip.reinsurance_period_from
                .split("-")
                .reverse()
                .join("/")} - ${slip.reinsurance_period_to
        .split("-")
        .reverse()
        .join("/")}</td>
            <td>${slip.status}</td>
            <td>${
                slip.date_transfer
                    ? new Date(slip.date_transfer).toLocaleDateString("en-GB", {
                          day: "2-digit",
                          month: "2-digit",
                          year: "numeric",
                      })
                    : "-"
            }</td>
            <td>${slip.username ?? "-"}</td>
            <td>
            <a class="text-primary mx-auto" data-toggle="modal" data-target="#detailmodaldata" href="#detailmodaldata">
                <button type="button" id='btn${slip.id}' name="btn${
        slip.number
    }" class="btn btn-sm btn-primary mx-auto" data-toggle="modal"
                data-target="#detailmodaldata2" disabled>Detail Slip marine</button>
            </a>
            </td>
        </tr>
    `;
}

function resetFilter() {
    $("#kocselect").val("").change();
    $("#kocdesc").val("");
    $("#cobselect").val("").change();
    $("#cobdesc").val("");

    $("#noinput").val("");
    $("#uyinput").val("");
    $("#cedinginput").val("").change();
    $("#insuredinput").val("").change();

    $("#claiminsured").hide();
}

function resetColumnClaim() {
    $("#slipnumberdata").val("");
    $("#regcomp").val("");
    $("#docnumber").val("");
    $("#docpladla").val("");
    $("#statusdocument").val("");
    $("#doccounter").val("");
    $("#date_receipt").val("");
    $("#date_document").val("");
    $("#causeofloss_id").val("").change();
    $("#desccauseofloss").val("");
    $("#natureofloss_id").val("").change();
    $("#descnatureofloss").val("");
    $("#date_of_loss").val("");
    $("#curr_id_loss").val("").change();
    $("#desccurrofloss").val("");
    $("#surveyor_id").val("").change();
    $("#descsurveyor").val("");
    $("#adjuster_id").val("").change();
    $("#descadjuster").val("");
    $("#nationalresliab").val("");
    $("#descnationalresliab").val("");
    $("#ced_share").val("");
    $("#nasre_share_loss").val("");
    $("#total_loss_amount").val("");
    $("#potentialrecoverydecision").val("").change();
    $("#potentialrecovery").val("");
    $("#estimate_percent_subro").val("");
    $("#subrogasi").val("");
    $("#kronologi").val("");
    $("#staffrecomend").val("");
    $("#assistantmanagerrecomend").val("");

    $("#propertyTypePanelAmount #lossdesctbody tr").remove();

    $("#pureorliability").val("");
    $("#pureorloss").val("");
    $("#pureorcontract").val("").change();
    $("#pureorrecovery").val("");

    $("#qsliability").val("");
    $("#qsloss").val("");
    $("#qscontract").val("").change();
    $("#qsrecovery").val("");

    $("#arr1liability").val("");
    $("#arr1loss").val("");
    $("#arr1contract").val("").change();
    $("#arr1recovery").val("");

    $("#extraliability").val("");
    $("#extraloss").val("");
    $("#extracontract").val("").change();
    $("#extrarecovery").val("");

    $("#facultativeliability").val("");
    $("#facultativeloss").val("");
    $("#facultativecontract").val("").change();
    $("#facultativerecovery").val("");

    $("#arr2liability").val("");
    $("#arr2loss").val("");
    $("#arr2contract").val("").change();
    $("#arr2recovery").val("");

    $("#arr3liability").val("");
    $("#arr3loss").val("");
    $("#arr3contract").val("").change();
    $("#arr3recovery").val("");

    $("#totalrecovery").val("");
    $("#nrsgrossret").val("");
    $("#xol").val("");
    $("#cereffno").val("");
    $("#dateofprod").val("");
    $("#ceuser").val("");
    $("#ceno").val("");
    $("#status_ce").val("").change();

    $("#description").val("");
    $("#dateentry").val("");
    $("#datetrans").val("");
    $("#datesupporting").val("");
}

$("#retrievedata").click(function () {
    $("#slipcomponent").hide();
    var insuredinput = $("#insuredinput").val();
    var cedingselect = $("#cedinginput").val();
    var selectedkoc = $("#kocselect").val();
    var selectedcob = $("#cobselect").val();
    var uyinput = $("#uyinput").val();
    var noinput = $("#noinput").val();

    if (
        selectedkoc == "" &&
        selectedcob == "" &&
        uyinput == "" &&
        insuredinput == "" &&
        cedingselect == "" &&
        noinput == ""
    ) {
        swal("Error!", "Empty filter input!", "error");
    } else {
        noinput = noinput.replace(/[-_\\\/.,]/g, "");
        var _adata = {
            koc: selectedkoc,
            cob: selectedcob,
            uy: uyinput,
            insured: insuredinput,
            ceding: cedingselect,
            no: noinput,
        };
        var m_type = $("#type_claim").val();
        var url = "";
        if (m_type == "cargo") {
            url = "/claimtransaction-data/marine/retrieve/cargo";
        } else {
            url = "/claimtransaction-data/marine/retrieve/hull";
        }
        axios.post(url, _adata).then((res) => {
            var ships = res.data.ships;
            var slips = res.data.slips;
            if (ships.length == 0) {
                swal("Info!", "No Data Founded", "info");
            } else {
                $("#tableships").find("tbody tr").remove();
                $("#tableslips").find("tbody tr").remove();
                var counter = 0;
                if (m_type == "cargo") {
                    ships = _.groupBy(ships, "name");
                    _.each(ships, function (ship, key) {
                        // console.log(ship);

                        $("#tableships #mainbodyships").append(
                            shiptable(ship[0], counter, m_type)
                        );
                        _.each(ship, function (shp) {
                            _.each(shp.interest, function (interest) {
                                $("#slipinsured" + counter).append(
                                    interesttable(interest)
                                );
                                $("#check" + interest.id).on(
                                    "change",
                                    function () {
                                        if (this.checked) {
                                            $(
                                                `button[name=btn${shp.slip.number}]`
                                            ).prop("disabled", false);
                                        } else {
                                            $(
                                                `button[name=btn${shp.slip.number}]`
                                            ).prop("disabled", true);
                                            $(
                                                `input[name=interestinsured${shp.slip.number}]`
                                            ).each(function (index, element) {
                                                if (element.checked) {
                                                    $(
                                                        `button[name=btn${shp.slip.number}]`
                                                    ).prop("disabled", false);
                                                }
                                            });
                                        }
                                    }
                                );
                            });
                        });
                        counter += 1;
                    });
                } else {
                    _.each(ships, function (ship, key) {
                        $("#tableships #mainbodyships").append(
                            shiptable(ship, counter, m_type)
                        );
                        $("#check" + ship.id).on("change", function () {
                            if (this.checked) {
                                $(
                                    `button[name=btn${ship.insured.slip.number}]`
                                ).prop("disabled", false);
                            } else {
                                $(
                                    `button[name=btn${ship.insured.slip.number}]`
                                ).prop("disabled", true);
                                $(
                                    `input[name=interestinsured${ship.insured.slip.number}]`
                                ).each(function (index, element) {
                                    if (element.checked) {
                                        $(
                                            `button[name=btn${ship.insured.slip.number}]`
                                        ).prop("disabled", false);
                                    }
                                });
                            }
                        });
                        console.log(ship, key, counter);
                        counter += 1;
                    });
                }
                _.each(slips, function (slip) {
                    $("#mainbodyslips").append(sliptable(slip));
                    $("#btn" + slip.id).click(function (e) {
                        e.preventDefault();
                        slip_data.id = slip.id;
                        slip_data.uy = $("#uy" + slip.id).val();
                        slip_data.kocid = $("#kocid" + slip.id).val();
                        slip_data.cobid = $("#cobid" + slip.id).val();
                        slip_data.koc = $("#koc" + slip.id).val();
                        slip_data.cob = $("#cob" + slip.id).val();
                        slip_data.year = new Date().getFullYear();
                        slip_data.month = new Date().getMonth();

                        var date_transfer = $("#date_transfer" + slip.id).val();

                        currency = slip.currency;
                        slip_data.broker = slip.cedingbroker.id;
                        slip_data.ceding = slip.ceding.id;
                        slip_data.slip_number = slip.number;
                        slip_data.status = slip.status;
                        slip_data.reinsurance_from =
                            slip.reinsurance_period_from;
                        slip_data.reinsurance_to = slip.reinsurance_period_to;
                        console.log(slip_data);
                        var _val = $("#number_slip" + slip.id).val();
                        var checkcount = $(
                            `input[name="interestinsured${slip.number}"]:checked`
                        ).length;
                        if (
                            date_transfer == "null" ||
                            (checkcount == 0 && _val)
                        ) {
                            $("#claimbutton").prop("disabled", true);
                        } else {
                            $("#claimbutton").prop("disabled", false);
                            // $("#slip_index").val(index);
                        }
                        $("#selectedslip").val(_val).change();
                    });
                });
                $("#slipcomponent").show();
                // swal("OK!", " ", "success");
            }
        });
    }
});

$("#detailmodaldata").on("show.bs.modal", function (e) {
    var slipnumberdata = $("#selectedslip").val();
    // var slipnumberdata = $('#slipnumberdata').val();

    if (slipnumberdata) {
        // console.log(slipnumberdata);
        // console.log(slip_data);
        $("body").addClass("loading");
        axios
            .get("/claimtransaction-data/marine/slipdetails/" + slipnumberdata)
            .then((res) => console.log(res.data));
        if (false) {
            then((res) => {
                console.log(res.data);
                $("#feuy").val(res.data.insureddata.uy);
                $("#insurednumber").val(res.data.insured_id);

                if (
                    res.data.insureddata?.prefixinsured?.code &&
                    res.data.insureddata?.prefixinsured?.name
                ) {
                    var _prefix =
                        res.data.insureddata.prefixinsured.code +
                        " - " +
                        res.data.insureddata.prefixinsured.name;
                } else {
                    var _prefix = "-";
                }

                $("#insuredprefix").val(_prefix);

                $("#insuredname").val(res.data.insureddata.insured_name);
                $("#insuredsuffix").val(res.data.insureddata.insured_suffix);

                $("#insuredsharefrom").val(res.data.insureddata.share_from);
                $("#insuredshareto").val(res.data.insureddata.share_to);
                $("#insuredshare").val(res.data.insureddata.share);

                if (
                    res.data.insureddata?.currency?.code &&
                    res.data.insureddata?.currency?.symbol_name
                ) {
                    var _curr =
                        res.data.insureddata.currency.code +
                        " - " +
                        res.data.insureddata.currency.symbol_name;
                } else {
                    var _curr = "-";
                }

                $("#insuredcurrency").val(_curr);

                $("#locationslist").empty();
                res.data.insureddata.locations.forEach((loc, index) => {
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
            });
        }
        if (false)
            $.ajax({
                url: "/transaction-data/detailslipnumber/" + slipnumberdata,
                type: "GET",
                beforeSend: function () {
                    $("body").addClass("loading");
                },
                complete: function () {
                    $("body").removeClass("loading");
                },
                success: function (response) {
                    console.log("bisa tampil");
                    console.log(response);
                    $("#slipnumberdetail").val(response.number);
                    $("#slipusernamedetail").val(response.username);
                    $("#slipprodyeardetail").val(response.prod_year);
                    $("#slipuydetail").val(response.uy);
                    $("#slipeddetail").val(response.endorsment);
                    $("#slipslsdetail").val(response.selisih);
                    $("#wpcdetail").val(response.wpc);

                    $("#slipvbrokerdetail").val(response.v_broker);

                    if (
                        response.deductible_panel &&
                        response.deductible_panel.length > 10
                    ) {
                        var deductibledata = JSON.parse(
                            response.deductible_panel
                        );
                        $("#deductiblePaneldetail tbody").empty();
                        for (var i = 0; i < deductibledata.length; i++) {
                            var obj = deductibledata[i];

                            //console.log(obj.id);
                            //$('#interestInsuredTabledetail tbody').prepend('');
                            // var curr_amount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(obj.amount);
                            var conv_amount = obj.amount.toFixed(2);
                            var str_amount = conv_amount.toString();
                            var curr_amount = str_amount.replace(
                                /\B(?=(\d{3})+(?!\d))/g,
                                ","
                            );
                            // var curr_minamount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(obj.min_claimamount);
                            var conv_minamount = obj.min_claimamount.toFixed(2);
                            var str_minamount = conv_minamount.toString();
                            var curr_minamount = str_minamount
                                .toString()
                                .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            // var curr_minamount = obj.min_claimamount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                            $("#deductiblePaneldetail tbody").prepend(
                                '<tr id="iiddeductible' +
                                    obj.id +
                                    '" data-name="deductibledetailvalue[]"><td data-name="' +
                                    obj.deductibletype +
                                    '">' +
                                    obj.deductibletype +
                                    '</td><td data-name="' +
                                    obj.percentage +
                                    '">' +
                                    obj.percentage +
                                    '</td><td data-name="' +
                                    curr_amount +
                                    '">' +
                                    curr_amount +
                                    '</td><td data-name="' +
                                    curr_minamount +
                                    '">' +
                                    curr_minamount +
                                    "</td><td></td></tr>"
                            );
                        }
                    }

                    if (
                        response.extend_coverage &&
                        response.extend_coverage.length > 10
                    ) {
                        var extend_coverage = JSON.parse(
                            response.extend_coverage
                        );
                        $("#ExtendCoveragePaneldetail tbody").empty();
                        for (var i = 0; i < extend_coverage.length; i++) {
                            var obj = extend_coverage[i];

                            //console.log(obj.id);
                            //$('#interestInsuredTabledetail tbody').prepend('');
                            // var curr_amount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(obj.amount);
                            var conv_amount = obj.amount.toFixed(2);
                            var str_amount = conv_amount.toString();
                            var curr_amount = str_amount.replace(
                                /\B(?=(\d{3})+(?!\d))/g,
                                ","
                            );
                            // var curr_amount = obj.amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                            $("#ExtendCoveragePaneldetail tbody").prepend(
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
                                    obj.percentage +
                                    '</td><td data-name="' +
                                    curr_amount +
                                    '">' +
                                    curr_amount +
                                    "</td><td></td></tr>"
                            );
                        }
                    }

                    if (
                        response.installment_panel &&
                        response.installment_panel.length > 10
                    ) {
                        var installment_panel = JSON.parse(
                            response.installment_panel
                        );
                        $("#installmentPaneldetail tbody").empty();
                        for (var i = 0; i < installment_panel.length; i++) {
                            var obj = installment_panel[i];
                            // var curr_amount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(obj.amount);
                            // var conv_amount = obj.amount.toFixed(2);
                            // var str_amount = conv_amount.toString();
                            // var curr_amount = str_amount.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            var curr_amount = obj.amount
                                .toString()
                                .replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                            var currdate = obj.installment_date;
                            var convdate = currdate
                                .split("-")
                                .reverse()
                                .join("/");
                            // console.log('conv date ' + convdate)
                            var strdate = convdate.toString();

                            //console.log(obj.id);
                            //$('#interestInsuredTabledetail tbody').prepend('');

                            $("#installmentPaneldetail tbody").prepend(
                                '<tr id="iidinstallmentdetail' +
                                    obj.id +
                                    '" data-name="installmentdetailvalue[]"><td data-name="' +
                                    obj.installment_date +
                                    '">' +
                                    strdate +
                                    '</td><td data-name="' +
                                    obj.percentage +
                                    '">' +
                                    obj.percentage +
                                    '</td><td data-name="' +
                                    curr_amount +
                                    '">' +
                                    curr_amount +
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
                        for (var i = 0; i < retrocession_panel.length; i++) {
                            var obj = retrocession_panel[i];
                            // var curr_amount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(obj.amount);
                            var conv_amount = obj.amount.toFixed(2);
                            var str_amount = conv_amount.toString();
                            var curr_amount = str_amount.replace(
                                /\B(?=(\d{3})+(?!\d))/g,
                                ","
                            );
                            // var curr_amount = obj.amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                            //console.log(obj.id);
                            //$('#interestInsuredTabledetail tbody').prepend('');

                            $("#retrocessionPaneldetail tbody").prepend(
                                '<tr id="iidretrocessiondetail' +
                                    obj.id +
                                    '" data-name="retrocessiondetailvalue[]"><td data-name="' +
                                    obj.type +
                                    '">' +
                                    obj.type +
                                    '</td><td data-name="' +
                                    obj.contract +
                                    '">' +
                                    obj.contract +
                                    '</td><td data-name="' +
                                    obj.percentage +
                                    '">' +
                                    obj.percentage +
                                    '</td><td data-name="' +
                                    curr_amount +
                                    '">' +
                                    curr_amount +
                                    "</td><td></td></tr>"
                            );
                        }
                    }

                    if (response.status) {
                        $("#slipstatusdetail").val(response.status);

                        // $("#slipstatusdetail option").attr('hidden',true);
                        // $("#slipstatusdetail option[value=" + response.status + "]:first")[0].hidden = false;
                        // $("#slipstatusdetail option[value=" + response.status + "]:first")[0].selected = true;
                    }

                    if (response.source) {
                        $("#slipcedingbrokerdetail option").attr(
                            "hidden",
                            true
                        );
                        $(
                            "#slipcedingbrokerdetail option[value=" +
                                response.source +
                                "]:first"
                        )[0].hidden = false;
                        $(
                            "#slipcedingbrokerdetail option[value=" +
                                response.source +
                                "]:first"
                        )[0].selected = true;
                    }

                    if (response.source_2) {
                        $("#slipcedingdetail option").attr("hidden", true);
                        $(
                            "#slipcedingdetail option[value=" +
                                response.source_2 +
                                "]:first"
                        )[0].hidden = false;
                        $(
                            "#slipcedingdetail option[value=" +
                                response.source_2 +
                                "]:first"
                        )[0].selected = true;
                    }

                    if (response.currency) {
                        $(
                            "#slipcurrencydetail option[value=" +
                                response.currency +
                                "]:first"
                        )[0].selected = true;
                    }

                    if (response.cob) {
                        $(
                            "#slipcobdetail option[value=" +
                                response.cob +
                                "]:first"
                        )[0].selected = true;
                    }

                    if (response.koc) {
                        $(
                            "#slipkocdetail option[value=" +
                                response.koc +
                                "]:first"
                        )[0].selected = true;
                    }

                    if (response.occupacy) {
                        $(
                            "#slipoccupacydetail option[value=" +
                                response.occupacy +
                                "]:first"
                        )[0].selected = true;
                    }

                    if (response.build_const) {
                        $("#slipbld_constdetail option").attr("hidden", true);
                        $(
                            "#slipbld_constdetail option[value='" +
                                response.build_const +
                                "']:first"
                        )[0].hidden = false;
                        $(
                            "#slipbld_constdetail option[value='" +
                                response.build_const +
                                "']:first"
                        )[0].selected = true;
                    }

                    $("#slipbcuadetail").val(response.build_rate_up);
                    $("#slipbcladetail").val(response.build_rate_down);

                    if (response.insured_type) {
                        $(
                            "#sliptypedetail option[value=" +
                                response.insured_type +
                                "]:first"
                        )[0].selected = true;
                    }

                    if (response.layer_non_proportional) {
                        $(
                            "#sliplayerproportionaldetail option[value=" +
                                response.layer_non_proportional +
                                "]:first"
                        )[0].selected = true;
                    }

                    if (response.retro_backup) {
                        $(
                            "#sliprbdetail option[value=" +
                                response.retro_backup +
                                "]:first"
                        )[0].selected = true;
                        if (response.retro_backup == "NO") {
                            $("#tabretrodetail").attr("hidden", "true");
                        } else if (response.retro_backup == "YES") {
                            $("#tabretrodetail").removeAttr("hidden");
                        }
                    }

                    if (response.type_tsi) {
                        $(
                            "#sliptypetsidetail option[value=" +
                                response.type_tsi +
                                "]:first"
                        )[0].selected = true;
                    }

                    if (response.type_share_tsi) {
                        $(
                            "#sharetypetsidetail option[value=" +
                                response.type_share_tsi +
                                "]:first"
                        )[0].selected = true;
                    }

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

                    // console.log('status log')
                    // console.log(response.status_log)

                    if (response.attacment_file) {
                        $("#aidlistdetail li").remove();
                        var attacment_file = response.attacment_file;
                        for (var i = 0; i < attacment_file.length; i++) {
                            var filename = attacment_file[i].filename;
                            if (false)
                                $("#aidlistdetail").append(
                                    '<li><div class="control-group input-group" id="control-group2" style="margin-top:10px"><a href="/' +
                                        filename +
                                        '">' +
                                        filename +
                                        "</a></div></li>"
                                ); //hakuba error
                        }
                    }

                    $("#slipnodetail").val(response.slip_no);
                    $("#slipcndndetail").val(response.cn_dn);
                    $("#slippolicy_nodetail").val(response.policy_no);
                    if (response.total_sum_insured) {
                        $("#sliptotalsumdetail").val(
                            response.total_sum_insured.replace(
                                /\B(?=(\d{3})+(?!\d))/g,
                                ","
                            )
                        );
                    } else {
                        $("#sliptotalsumdetail").val("0");
                    }

                    if (response.share_tsi) {
                        $("#sharetotalsumdetail").val(
                            response.share_tsi.replace(
                                /\B(?=(\d{3})+(?!\d))/g,
                                ","
                            )
                        );
                    } else {
                        $("#sharetotalsumdetail").val("0");
                    }

                    $("#slippctdetail").val(response.insured_pct);
                    if (response.total_sum_pct) {
                        $("#sliptotalsumpctdetail").val(
                            response.total_sum_pct.replace(
                                /\B(?=(\d{3})+(?!\d))/g,
                                ","
                            )
                        );
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

                    var sum = isNaN(days / 365) ? 0 : (days / 365).toFixed(3);
                    var constday = days.toString() + "/365";

                    // console.log(insurance_period_from2)
                    // console.log(insurance_period_to2)
                    // console.log(days)
                    // console.log(constday)
                    // console.log(parseFloat(sum))

                    $("#slipdaytotaldetail").val(days);
                    $("#slipdaytotaldetail2").val(days);
                    $("#slipdaytotaldetail3").val("365");
                    $("#slipdaytotaldetail4").val("365");

                    $("#sliptotalsumdatedetail").val(parseFloat(sum));

                    $("#sliprpfromdetail").val(
                        response.reinsurance_period_from
                    );
                    $("#sliprptodetail").val(response.reinsurance_period_to);

                    $("#switch-proportionaldetail").val(response.proportional);
                    // if(response.proportional == ''){
                    $("#btnaddlayerdetail").attr("hidden", "true");
                    $("#sliplayerproportionaldetail").attr("hidden", "true");
                    $("#labelnonpropdetail").attr("hidden", "true");
                    $("#labelnpdetail").attr("hidden", "true");
                    // }

                    $("#slipratedetail").val(response.rate);
                    $("#slipsharedetail").val(response.share);

                    if (response.sum_share) {
                        $("#slipsumsharedetail").val(
                            response.sum_share.replace(
                                /\B(?=(\d{3})+(?!\d))/g,
                                ","
                            )
                        );
                        $("#slipsumsharedetail2").val(
                            response.sum_share.replace(
                                /\B(?=(\d{3})+(?!\d))/g,
                                ","
                            )
                        );
                    } else {
                        $("#slipsumsharedetail").val("0");
                        $("#slipsumsharedetail2").val("0");
                    }

                    if (response.sum_rate) {
                        $("#sliptotalratedetail").val(
                            response.sum_share.replace(
                                /\B(?=(\d{3})+(?!\d))/g,
                                ","
                            )
                        );
                        $("#sliptotalratedetail").val(
                            response.sum_share.replace(
                                /\B(?=(\d{3})+(?!\d))/g,
                                ","
                            )
                        );
                    } else {
                        $("#slipsumsharedetail").val("0");
                        $("#slipsumsharedetail2").val("0");
                    }

                    if (response.sum_feebroker) {
                        $("#slipsumfeedetail").val(
                            response.sum_feebroker.replace(
                                /\B(?=(\d{3})+(?!\d))/g,
                                ","
                            )
                        );
                        $("#slipsumfeedetail2").val(
                            response.sum_feebroker.replace(
                                /\B(?=(\d{3})+(?!\d))/g,
                                ","
                            )
                        );
                    } else {
                        $("#slipsumfeedetail").val("0");
                        $("#slipsumfeedetail2").val("0");
                    }

                    if (response.basic_premium) {
                        $("#slipbasicpremiumdetail").val(
                            response.basic_premium.replace(
                                /\B(?=(\d{3})+(?!\d))/g,
                                ","
                            )
                        );
                    } else {
                        $("#slipbasicpremiumdetail").val("0");
                    }

                    if (response.grossprm_to_nr) {
                        $("#slipgrossprmtonrdetail").val(
                            response.grossprm_to_nr.replace(
                                /\B(?=(\d{3})+(?!\d))/g,
                                ","
                            )
                        );
                        $("#slipgrossprmtonrdetail2").val(
                            response.grossprm_to_nr.replace(
                                /\B(?=(\d{3})+(?!\d))/g,
                                ","
                            )
                        );
                    } else {
                        $("#slipgrossprmtonrdetail").val("0");
                        $("#slipgrossprmtonrdetail2").val("0");
                    }

                    if (response.commission) {
                        $("#slipcommissiondetail").val(response.commission);
                    } else {
                        $("#slipcommissiondetail").val(0);
                    }

                    if (response.sum_commission) {
                        $("#slipsumcommissiondetail").val(
                            response.sum_commission.replace(
                                /\B(?=(\d{3})+(?!\d))/g,
                                ","
                            )
                        );
                        $("#slipsumcommissiondetail2").val(
                            response.sum_commission.replace(
                                /\B(?=(\d{3})+(?!\d))/g,
                                ","
                            )
                        );
                    } else {
                        $("#slipsumcommissiondetail").val("0");
                        $("#slipsumcommissiondetail2").val("0");
                    }

                    if (response.netprm_to_nr) {
                        $("#slipnetprmtonrdetail").val(
                            response.netprm_to_nr.replace(
                                /\B(?=(\d{3})+(?!\d))/g,
                                ","
                            )
                        );
                        $("#slipnetprmtonrdetail2").val(
                            response.netprm_to_nr.replace(
                                /\B(?=(\d{3})+(?!\d))/g,
                                ","
                            )
                        );
                    } else {
                        $("#slipnetprmtonrdetail").val("0");
                        $("#slipnetprmtonrdetail2").val("0");
                    }

                    if (response.own_retention) {
                        $("#slipordetail").val(response.own_retention);
                    } else {
                        $("#slipordetail").val(0);
                    }

                    if (response.sum_own_retention) {
                        $("#slipsumordetail").val(
                            response.sum_own_retention.replace(
                                /\B(?=(\d{3})+(?!\d))/g,
                                ","
                            )
                        );
                    } else {
                        $("#slipsumordetail").val("0");
                    }

                    $("#countendorsmentdetail").val(response.endorsment);
                    $("#countendorsmentdetail2").val(response.endorsment);
                    $("#remarksdetail").val(response.remarks);

                    // swal("Success!", "Data Show", 'success')
                    // console.log(response)
                },
                error: function (request, status, error) {
                    //alert(request.responseText);
                    swal("Error!", "Get Slip Data Error", "error");
                },
            });
    }
});

$("#claimbutton").click(function () {
    resetColumnClaim();
    desc_loss_datas = [];
    var _val = $("#selectedslip").val();
    $("#postcard").show();
    $("#slipnumberdata").val(_val).change();
    $("#docnumber").val(_val).change();
    console.log(_val);
    console.log(slip_data);
    var share = 0;
    var amount = 0;
    $(`input[name="interestinsured${_val}"]`).each(function () {
        if (this.checked) {
            share += parseInt(
                $("#share" + _val + this.id.replace("check", "")).val()
            );
            amount += parseInt(
                $("#amount" + _val + this.id.replace("check", "")).val()
            );
            console.log(share, amount);
        }
    });

    $("#reinsurance_from").val(
        new Date(slip_data.reinsurance_from).toLocaleDateString("en-GB", {
            day: "2-digit",
            month: "2-digit",
            year: "numeric",
        })
    );
    $("#reinsurance_to").val(
        new Date(slip_data.reinsurance_to).toLocaleDateString("en-GB", {
            day: "2-digit",
            month: "2-digit",
            year: "numeric",
        })
    );

    $("#date_of_loss").datepicker(
        "setStartDate",
        new Date(slip_data.reinsurance_from).toLocaleDateString()
    );
    $("#date_of_loss").datepicker(
        "setEndDate",
        new Date(slip_data.reinsurance_to).toLocaleDateString()
    );

    $("#nationalresliab").val(share);
    $("#descnationalresliab").val(amount).trigger("input");
});

$("#cancelall").click(function () {
    swal({
        type: "warning",
        title: "Are you sure?",
        // text: "Your current document status will be . You won't be able to revert this!",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, cancel all!",
    }).then((result) => {
        if (result.value === true) {
            resetColumnClaim();
            resetFilter();
            $("#slipcomponent").hide();
        }
    });
});
