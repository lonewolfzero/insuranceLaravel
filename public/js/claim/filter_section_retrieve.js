function interesttable(ins, address) {
    return `
    <tr>
        <input type='hidden' id='share${ins.translocationtemp.slip.number}${
        ins.id
    }' value='${ins.percentage}'>

        <input type='hidden' id='amount${ins.translocationtemp.slip.number}${
        ins.id
    }' value='${ins.amountlocation}'>

        <input type='hidden' id='interestdata${
            ins.translocationtemp.slip.number
        }${ins.id}' value='${ins.interest_id}'>

        <input type='hidden' id='cedingdata${
            ins.translocationtemp.slip.number
        }${ins.id}' value='${ins.cedingbroker.id}'>

        <input type='hidden' id='cndn${ins.translocationtemp.slip.number}${
        ins.id
    }' value='${ins.cndn ?? ""}'>

        <input type='hidden' id='cert${ins.translocationtemp.slip.number}${
        ins.id
    }' value='${ins.certno ?? ""}'>

        <input type='hidden' id='slip${ins.translocationtemp.slip.number}${
        ins.id
    }' value='${ins.slipno ?? ""}'>

        <input type='hidden' id='policy${ins.translocationtemp.slip.number}${
        ins.id
    }' value='${ins.policyno ?? ""}'>

        <input type='hidden' id='address${ins.translocationtemp.slip.number}${
        ins.id
    }' value='${address}'>

        <td>${ins.cedingbroker.company_name}</td>
        <td>${ins.interestdata.code} - ${ins.interestdata.description}</td>
        <td>${ins.cndn ?? "-"}</td>
        <td>${ins.certno ?? "-"}</td>
        <td>${ins.slipno ?? "-"}</td>
        <td>${ins.policyno ?? "-"}</td>
        <td>${Number(ins.percentage).toFixed(2)}%</td>
    
        <td>${ins.amountlocation
            .toString()
            .replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</td>
        <td>
            <input type='checkbox' id="check${ins.id}" name="interestinsured${
        ins.translocationtemp.slip.number
    }">
        </td>
    </tr>
    `;
}

function locationtable(address, index) {
    // console.log(address);
    slip_data.address = index;
    return `
        <tr>
            <td colspan="2">${address.address}</td>
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
                    <tbody id='slipinsured${index}'></tbody>
                </table>
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
            <input type='hidden' id='uy${slip.id}' value='${
        slip.insureddata.uy ? slip.insureddata.uy : slip.uy
    }'>

        <input type='hidden' id='kocid${slip.id}' value='${slip.koc}'>
        <input type='hidden' id='kocname${slip.id}' 
        value='${slip.kindcontract.description}'>
        <input type='hidden' id='koc${slip.id}' 
        value='${slip.kindcontract.code}'>

        <input type='hidden' id='cobid${slip.id}' value='${slip.cob}'>
        <input type='hidden' id='cobname${slip.id}' 
        value='${slip.corebusiness.description}'>
        <input type='hidden' id='cob${slip.id}' 
        value='${slip.corebusiness.code}'>
        
            <input type='hidden' id='kocabb${slip.id}' value='${
        slip.kindcontract.abbreviation
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
        slip.insureddata.currency
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
                data-target="#detailmodaldata2" disabled>Detail Slip</button>
            </a>
            </td>
        </tr>
    `;
}

function marineshiptable(ship, key, martype) {
    console.log(ship, key);
    slip_data.ship = key;
    return `
      <tr>
          ${
              martype == "mh"
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
                    <td>${ship.insured.slip.ceding.name}</td>
                    <td>${ship.insured.insured_name}</td>
                    <td>${ship.name}</td>
                  `
          }
      </tr>
      ${
          martype == "mh"
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

function marineinteresttable(ins) {
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
    }' value='${ins?.interestinsureddata?.id}'>

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

function marinesliptable(slip) {
    return `
        <tr>
            <input type='hidden' id='number_slip${slip.id}' value='${
        slip.number
    }'>
    <input type='hidden' id='kocabb${slip.id}' value='${
        slip.kindcontract.abbreviation
    }'>
            <input type='hidden' id='uy${slip.id}' value='${slip.uy}'>

            <input type='hidden' id='kocid${slip.id}' value='${slip.koc}'>
            <input type='hidden' id='kocname${slip.id}' 
            value='${slip.kindcontract.description}'>
            <input type='hidden' id='koc${slip.id}' 
            value='${slip.kindcontract.code}'>

            <input type='hidden' id='cobid${slip.id}' value='${slip.cob}'>
            <input type='hidden' id='cobname${slip.id}' 
            value='${slip.corebusiness.description}'>
            <input type='hidden' id='cob${slip.id}' 
            value='${slip.corebusiness.code}'>

            <input type='hidden' id='broker_slip${slip.id}' 
            value='${slip.cedingbroker.name}'>

            <input type='hidden' id='ceding_slip${slip.id}' 
            value='${slip.ceding.name}'>

            <input type='hidden' id='status_slip${slip.id}' 
            value='${slip.status}'>

            <input type='hidden' id='date_transfer${slip.id}' 
            value='${slip.date_transfer}'>

            <input type='hidden' id='reinsurance_from${slip.number}' 
            value='${slip.reinsurance_period_from}'>

            <input type='hidden' id='reinsurance_to${slip.number}' 
            value='${slip.reinsurance_period_to}'>

            <input type='hidden' id='currency${slip.number}' 
            value='${slip.currency}'>
    
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
    }" class="btn btn-sm btn-primary mx-auto" data-toggle="modal"  onclick="getid(${
        slip.id
    })"
                data-target="#detailmodaldata2" disabled>Detail Slip</button>
            </a>
            </td>
        </tr>
    `;
}

// RETRIEVE DATA
$("#retrievedata").click(function () {
    $("#claiminsured").hide();
    // resetColumnClaim();
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
        if (doctype == "mc" || doctype == "mh") {
            var url = "";
            if (doctype == "mc") {
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
                    if (doctype == "mc") {
                        ships = _.groupBy(ships, "name");
                        _.each(ships, function (ship, key) {
                            // console.log(ship);

                            $("#tableships #mainbodyships").append(
                                marineshiptable(ship[0], counter, doctype)
                            );
                            _.each(ship, function (shp) {
                                _.each(shp.interest, function (interest) {
                                    $("#slipinsured" + counter).append(
                                        marineinteresttable(interest)
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
                                                ).each(function (
                                                    index,
                                                    element
                                                ) {
                                                    if (element.checked) {
                                                        $(
                                                            `button[name=btn${shp.slip.number}]`
                                                        ).prop(
                                                            "disabled",
                                                            false
                                                        );
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
                                marineshiptable(ship, counter, doctype)
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
                        $("#mainbodyslips").append(marinesliptable(slip));
                        $("#btn" + slip.id).click(function (e) {
                            e.preventDefault();
                            slip_data.id = slip.id;
                            slip_data.uy = $("#uy" + slip.id).val();
                            slipkoc = $("#kocabb" + slip.id).val();
                            slip_data.kocid = $("#kocid" + slip.id).val();
                            slip_data.cobid = $("#cobid" + slip.id).val();
                            slip_data.kocname = $("#kocname" + slip.id).val();
                            slip_data.cobname = $("#cobname" + slip.id).val();
                            slip_data.koc = $("#koc" + slip.id).val();
                            slip_data.cob = $("#cob" + slip.id).val();
                            slip_data.year = new Date().getFullYear();
                            slip_data.month = new Date().getMonth();

                            var date_transfer = $(
                                "#date_transfer" + slip.id
                            ).val();
                            console.log(
                                "🚀 ~ file: filter_section_retrieve.js ~ line 522 ~ slip",
                                slip
                            );
                            currency = {
                                code: slip.currency.code,
                                kurs: slip.exchange.kurs,
                            };
                            slip_data.broker = slip.cedingbroker.id;
                            slip_data.ceding = slip.ceding.id;
                            slip_data.slip_number = slip.number;
                            slip_data.status = slip.status;
                            slip_data.reinsurance_from =
                                slip.reinsurance_period_from;
                            slip_data.reinsurance_to =
                                slip.reinsurance_period_to;
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
                    $("#claiminsured").show();
                    // swal("OK!", " ", "success");
                }
            });
        } else {
            axios
                .post(
                    "/claimtransaction-data/" + doctype + "/retrievedata",
                    _adata
                )
                .then((res) => {
                    var locs = res.data.locations;
                    var adds = res.data.addresses;
                    var slips = res.data.slips;
                    console.log(locs);
                    if (locs.length == 0) {
                        swal("Info!", "No Data Founded", "info");
                    } else {
                        $("#tablelocations").find("tbody tr").remove();
                        $("#tableslips").find("tbody tr").remove();

                        _.each(adds, function (address, key) {
                            $("#tablelocations #mainbodylocations").append(
                                locationtable(address, address.id)
                            );

                            _.each(locs, function (loc, locid) {
                                if (locid == address.id) {
                                    _.each(loc, function (ins, index) {
                                        $("#slipinsured" + address.id).append(
                                            interesttable(ins, address.id)
                                        );
                                        $("#check" + ins.id).on(
                                            "change",
                                            function () {
                                                if (this.checked) {
                                                    $(
                                                        `button[name=btn${ins.translocationtemp.slip.number}]`
                                                    ).prop("disabled", false);
                                                } else {
                                                    $(
                                                        `button[name=btn${ins.translocationtemp.slip.number}]`
                                                    ).prop("disabled", true);
                                                    $(
                                                        `input[name=interestinsured${ins.translocationtemp.slip.number}]`
                                                    ).each(function (
                                                        index,
                                                        element
                                                    ) {
                                                        if (element.checked) {
                                                            $(
                                                                `button[name=btn${ins.translocationtemp.slip.number}]`
                                                            ).prop(
                                                                "disabled",
                                                                false
                                                            );
                                                        }
                                                    });
                                                }
                                            }
                                        );
                                    });
                                }
                            });
                        });

                        _.each(slips, function (slip, index) {
                            $("#mainbodyslips").append(sliptable(slip));
                            $("#btn" + slip.id).click(function (e) {
                                e.preventDefault();
                                slip_data.id = slip.id;
                                slip_data.uy = $("#uy" + slip.id).val();
                                slip_data.kocid = $("#kocid" + slip.id).val();
                                slipkoc = $("#kocabb" + slip.id).val();
                                slip_data.cobid = $("#cobid" + slip.id).val();
                                slip_data.kocname = $(
                                    "#kocname" + slip.id
                                ).val();
                                slip_data.cobname = $(
                                    "#cobname" + slip.id
                                ).val();
                                slip_data.koc = $("#koc" + slip.id).val();
                                slip_data.cob = $("#cob" + slip.id).val();
                                slip_data.year = new Date().getFullYear();
                                slip_data.month = new Date().getMonth();

                                var date_transfer = $(
                                    "#date_transfer" + slip.id
                                ).val();
                                currency = {
                                    code: slip.insureddata.currency.code,
                                    kurs: slip.insureddata.exchange.kurs,
                                };
                                console.log("curr", currency);
                                console.log("ins", slip.insureddata);
                                slip_data.broker = slip.cedingbroker.id;
                                slip_data.ceding = slip.ceding.id;
                                slip_data.slip_number = slip.number;
                                slip_data.status = slip.status;
                                slip_data.reinsurance_from =
                                    slip.reinsurance_period_from;
                                slip_data.reinsurance_to =
                                    slip.reinsurance_period_to;
                                var _val = $("#number_slip" + slip.id).val();
                                var checkcount = $(
                                    `input[name="interestinsured${slip.number}"]:checked`
                                ).length;
                                console.log(
                                    date_transfer == "null",
                                    checkcount == 0,
                                    _val
                                );
                                console.log(
                                    date_transfer == "null" ||
                                        (checkcount == 0 && _val)
                                );
                                if (
                                    date_transfer == "null" ||
                                    (checkcount == 0 && _val)
                                ) {
                                    $("#claimbutton").prop("disabled", true);
                                } else {
                                    $("#claimbutton").prop("disabled", false);
                                    $("#slip_index").val(index);
                                }

                                $("#selectedslip").val(_val).change();
                            });
                        });

                        $("#claiminsured").show();
                        swal("Success!", "Retrieve Data Success", "success");
                    }
                });
        }
    }
});
