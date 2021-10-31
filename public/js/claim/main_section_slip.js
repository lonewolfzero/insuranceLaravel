function dateFormater(val) {
    var res_Date = new Date(val).toLocaleDateString("en-GB", {
        day: "2-digit",
        month: "2-digit",
        year: "numeric",
    });
    return res_Date;
}

function inputSetter(slipdetail) {
    console.log(
        "🚀 ~ file: main_section_slip.js ~ line 11 ~ inputSetter ~ slipdetail",
        slipdetail
    );
    $("#cob").val(
        slipdetail.slip.corebusiness.code +
            " - " +
            slipdetail.slip.corebusiness.description
    );
    $("#koc").val(
        slipdetail.slip.kindcontract.code +
            " - " +
            slipdetail.slip.kindcontract.description
    );
    $("#slipnumberdata").val(slipdetail.number);
    $("#mainclaimid").val(slipdetail.id);
    $("#regcomp").val(slipdetail.reg_comp);
    $("#doccounter").val(slipdetail.doc_counter);
    $("#docnumber").val(slipdetail.doc_number);
    $("#docpladla").val(slipdetail.docpladla);
    $("#dateofreceipt").val(dateFormater(slipdetail.date_receipt));
    $("#dateofdocument").val(dateFormater(slipdetail.date_document));
    $("#causeofloss").val(slipdetail.causeofloss_id).change();
    $("#desccauseofloss").val(slipdetail.desc_causeofloss);
    $("#natureofloss").val(slipdetail.natureofloss_id).change();
    $("#descnatureofloss").val(slipdetail.descnatureofloss);
    $("#dateofloss").val(dateFormater(slipdetail.date_of_loss));
    $("#dateofloss").datepicker({
        startDate: slipdetail.slip.reinsurance_period_from
            .split("-")
            .reverse()
            .join("-"),
        endDate: slipdetail.slip.reinsurance_period_to
            .split("-")
            .reverse()
            .join("-"),
        format: "dd/mm/yyyy",
    });
    $("#currofloss").val(slipdetail.curr_id_loss).change();
    $("#desccurrofloss").val(slipdetail.curr_lossdesc);
    $("#adjuster").val(slipdetail.adjuster_id).change();
    $("#descadjuster").val(slipdetail.desc_adjuster);
    $("#surveyor").val(slipdetail.surveyor_id).change();
    $("#descsurveyor").val(slipdetail.desc_surveyor);
    $("#nationalresliab").val(slipdetail.nasre_liab);
    $("#descnationalresliab").val(slipdetail.nasre_liabdesc).trigger("input");

    $("#cedantshare").val(slipdetail.ced_share).trigger("input");
    $("#shareonloss").val(slipdetail.nasre_share_loss).trigger("input");
    $("#totallossamount").val(slipdetail.total_loss_amount).trigger("input");

    $("#reinsurance_from").val(
        slipdetail.slip.reinsurance_period_from.split("-").reverse().join("/")
    );
    $("#reinsurance_to").val(
        slipdetail.slip.reinsurance_period_to.split("-").reverse().join("/")
    );
    // console.log(slipdetail.slip.reinsurance_period_from);

    $("#subrogasi").val(slipdetail.estimate_amount_subro).trigger("input");
    $("#subrogasipersen").val(slipdetail.estimate_percent_subro);

    $("#potentialrecoverydecision").val(slipdetail.potential_recovery).change();
    $("#potentialrecovery").val(slipdetail.desc_poten_rec);
    $("#kronologi").val(slipdetail.kronologi);
    $("#staffrecomend").val(slipdetail.staff_recomendation);
    $("#assistantmanagerrecomend").val(slipdetail.ass_man_recomen);
    $("#generalmanagerrecomend").val(slipdetail.gen_man_recomen);
    $("#managerrecomend").val(slipdetail.man_recomen);

    $("#pureorliability").val(slipdetail.pureor_liability);
    $("#pureorloss").val(slipdetail.pureor_loss);
    $("#pureorcontract").val(slipdetail.pureor_retro).change();
    $("#pureorrecovery").val(slipdetail.pureor_recovery);

    $("#qsliability").val(slipdetail.qs_liability);
    $("#qsloss").val(slipdetail.qs_loss);
    $("#qscontract").val(slipdetail.qs_retro).change();
    $("#qsrecovery").val(slipdetail.qs_recovery);

    $("#arr1liability").val(slipdetail.arr1_liability);
    $("#arr1loss").val(slipdetail.arr1_loss);
    $("#arr1contract").val(slipdetail.arr1_retro).change();
    $("#arr1recovery").val(slipdetail.arr1_recovery);

    $("#extraliability").val(slipdetail.extra_liability);
    $("#extraloss").val(slipdetail.extra_loss);
    $("#extracontract").val(slipdetail.extra_retro).change();
    $("#extrarecovery").val(slipdetail.extra_recovery);

    $("#facultativeliability").val(slipdetail.facultative_liability);
    $("#facultativeloss").val(slipdetail.facultative_loss);
    $("#facultativecontract").val(slipdetail.facultative_retro).change();
    $("#facultativerecovery").val(slipdetail.facultative_recovery);

    $("#arr2liability").val(slipdetail.arr2_liability);
    $("#arr2loss").val(slipdetail.arr2_loss);
    $("#arr2contract").val(slipdetail.arr2_retro).change();
    $("#arr2recovery").val(slipdetail.arr2_recovery);

    $("#arr3liability").val(slipdetail.arr3_liability);
    $("#arr3loss").val(slipdetail.arr3_loss);
    $("#arr3contract").val(slipdetail.arr3_retro).change();
    $("#arr3recovery").val(slipdetail.arr3_recovery);

    $("#totalrecovery").val(slipdetail.totalrecovery);
    // $("#nrsgrossret").val(slipdetail.nrsgrossret);
    $("#xol").val(slipdetail.xol);
    $("#cereffno").val(slipdetail.cereffno);
    $("#dateofprod").val(
        slipdetail.dateofprod ? dateFormater(slipdetail.dateofprod) : ""
    );
    $("#ceuser").val(slipdetail?.userce?.name);
    $("#ceno").val(slipdetail.ceno);
    $("#status_ce").val(slipdetail.status_ce).change();
    $("#statusflag").val(slipdetail.status_flag);

    $("#description").val(slipdetail.description);
    $("#dateentry").val(
        slipdetail.dateofentry ? dateFormater(slipdetail.dateofentry) : ""
    );
    $("#datetrans").val(
        slipdetail.dateoftrans ? dateFormater(slipdetail.dateoftrans) : ""
    );
    $("#datesupporting").val(
        slipdetail.dateofsupporting
            ? dateFormater(slipdetail.dateofsupporting)
            : ""
    );
    var statusflag = slipdetail.status_flag;
    // console.log("statusflag", statusflag);
    if (statusflag != 1) {
        $('input[name="locationcheck"]').prop("disabled", true);
        $("#regcomp").prop("disabled", true);
        $("#slipnumberdata").prop("disabled", true);
    }
    if (!statusflag) {
        $("#copyplabutton").hide();
    } else {
        var _doc_status = "";
        if (statusflag == 1) {
            _doc_status = "PLA";
        } else if (statusflag == 2) {
            _doc_status = "Interim";
        } else if (statusflag == 3) {
            _doc_status = "DLA";
        }
        $("#statusdocument").val(_doc_status);
    }

    if (slipdetail.cereffno) {
        $("#examinerce").val(slipdetail.examiner).change();
        $("#ast_managerce").val(slipdetail.ast_manager).change();
        $("#dec_managerce").val(slipdetail.dec_manager).change();
        $("#gen_managerce").val(slipdetail.gen_manager).change();
        $("#dec_boardce").val(slipdetail.dec_board).change();
        $("#noreffce").val(slipdetail.cereffno);
        $("#printdatece").val(dateFormater(slipdetail.dateprintce));
        $("#accretro").val(slipdetail.acc_retro).change();
        $("#examinerce").prop("disabled", true);
        $("#ast_managerce").prop("disabled", true);
        $("#dec_managerce").prop("disabled", true);
        $("#gen_managerce").prop("disabled", true);
        $("#dec_boardce").prop("disabled", true);
        $("#noreffce").prop("disabled", true);
        $("#printdatece").prop("disabled", true);
        $("#noreffcebutton").prop("disabled", true);
        $("#accretro").prop("disabled", true);
        savece = false;
    }
}

function inputDisabler(active) {
    $("#slipnumberdata").prop("disabled", active);
    $("#mainclaimid").prop("disabled", active);
    $("#regcomp").prop("disabled", active);
    $("#doccounter").prop("disabled", active);
    $("#docnumber").prop("disabled", active);
    $("#docpladla").prop("disabled", active);
    $("#dateofreceipt").prop("disabled", active);
    $("#dateofdocument").prop("disabled", active);
    $("#causeofloss").prop("disabled", active);
    $("#desccauseofloss").prop("disabled", active);
    $("#natureofloss").prop("disabled", active);
    $("#descnatureofloss").prop("disabled", active);
    $("#dateofloss").prop("disabled", active);
    $("#currofloss").prop("disabled", active);
    $("#desccurrofloss").prop("disabled", active);
    $("#adjuster").prop("disabled", active);
    $("#descadjuster").prop("disabled", active);
    $("#surveyor").prop("disabled", active);
    $("#descsurveyor").prop("disabled", active);
    $("#nationalresliab").prop("disabled", active);
    $("#descnationalresliab").prop("disabled", active);
    $("#totallossamount").prop("disabled", active);
    $("#shareonloss").prop("disabled", active);
    $("#cedantshare").prop("disabled", active);
    $("#subrogasi").prop("disabled", active);
    $("#subrogasipersen").prop("disabled", active);

    // $("#potentialrecoverydecision").prop("disabled", active);
    // $("#potentialrecovery").prop("disabled", active);
    // $("#kronologi").prop("disabled", active);
    // $("#staffrecomend").prop("disabled", active);
    // $("#assistantmanagerrecomend").prop("disabled", active);

    // $("#descripitontableselect").prop("disabled", active);
    // $("#amounttablemanual").prop("disabled", active);
    // $("#addmanualclaim-btn").prop("disabled", active);
    // $("#addclaiminsured-btn").prop("disabled", active);

    // $("#pureorliability").prop("disabled", true);
    // $("#pureorloss").prop("disabled", true);
    // $("#pureorcontract").prop("disabled", true);
    // $("#pureorrecovery").prop("disabled", true);
    // $("#qsliability").prop("disabled", true);
    // $("#qsloss").prop("disabled", true);
    // $("#qscontract").prop("disabled", true);
    // $("#qsrecovery").prop("disabled", true);
    // $("#arr1liability").prop("disabled", true);
    // $("#arr1loss").prop("disabled", true);
    // $("#arr1contract").prop("disabled", true);
    // $("#arr1recovery").prop("disabled", true);
    // $("#extraliability").prop("disabled", true);
    // $("#extraloss").prop("disabled", true);
    // $("#extracontract").prop("disabled", true);
    // $("#extrarecovery").prop("disabled", true);
    // $("#facultativeliability").prop("disabled", true);
    // $("#facultativeloss").prop("disabled", true);
    // $("#facultativecontract").prop("disabled", true);
    // $("#facultativerecovery").prop("disabled", true);
    // $("#arr2liability").prop("disabled", true);
    // $("#arr2loss").prop("disabled", true);
    // $("#arr2contract").prop("disabled", true);
    // $("#arr2recovery").prop("disabled", true);
    // $("#arr3liability").prop("disabled", true);
    // $("#arr3loss").prop("disabled", true);
    // $("#arr3contract").prop("disabled", true);
    // $("#arr3recovery").prop("disabled", true);
    // $("#totalrecovery").prop("disabled", true);
    // $("#nrsgrossret").prop("disabled", true);
    // $("#xol").prop("disabled", true);
    // $("#cereffno").prop("disabled", true);
    // $("#dateofprod").prop("disabled", true);
    // $("#ceuser").prop("disabled", true);
    // $("#ceno").prop("disabled", true);
    // $("#status_ce").prop("disabled", true);
    // $("#statusflag").prop("disabled", true);
    // $("#description").prop("disabled", true);
    // $("#dateentry").prop("disabled", true);
    // $("#datetrans").prop("disabled", true);
    // $("#datesupporting").prop("disabled", true);
    // $("#attachmentdesc").prop("disabled", true);
    // $("#attachmenturl").prop("disabled", true);
    // $("#attachmentbtn").prop("disabled", true);
}

async function descriptionLoss(regcomp, doc_counter, isUpdate = false) {
    var claim_amount = await axios
        .get(
            "/claimtransaction-data/" +
                doctype +
                "/detailslipclaimAmount/" +
                regcomp +
                "/" +
                doc_counter
        )
        .then((res) => res.data);

    if (claim_amount.status == 200) {
        $("#propertyTypePanelAmount #lossdesctbody").empty();
        no_data = 0;
        desc_loss_datas = [];

        claim_amount.data.forEach((el, ind) => {
            no_data = ind + 1;
            var amount = parseInt(el.amount);

            // if (amount < 0) {
            //     amount *= -1;
            // }

            var curr_amount = toMoneyFormat(amount);
            // amount *= parseInt(el.desc_loss.factor);

            $("#propertyTypePanelAmount #lossdesctbody").append(
                '<tr id="iidamountclaim' +
                    el.id +
                    '" data-name="amounttypevalue[]"><td>' +
                    no_data +
                    '</td><td data-name="' +
                    el.description_id +
                    '">' +
                    el.desc_loss.desc_name +
                    '</td><td data-name="' +
                    el.amount +
                    '">' +
                    curr_amount +
                    '</td><td><a href="javascript:void(0)" onclick="deleteamountclaimdetail(' +
                    el.id +
                    ')">delete</a></td></tr>'
            );
            desc_loss_datas.push({
                id: el.id,
                desc_id: el.description_id,
                val: amount,
                curr_val: curr_amount,
                name: el.desc_loss.desc_name,
            });
            console.log(
                "🚀 ~ file: main_section_slip.js ~ line 306 ~ claim_amount.data.forEach ~ desc_loss_datas",
                desc_loss_datas
            );
        });
        if (!isUpdate) {
            $("#totallossamount")
                .val(_.sumBy(desc_loss_datas, "val"))
                .trigger("input");
            $("#cedantshare")
                .val(_.sumBy(desc_loss_datas, "val"))
                .trigger("input");
        }
    }
}

function lossAmount(limitamount, status_flag = 1) {
    if (status_flag !== 1 && (limitamount < 0 || limitamount > 0)) {
        limitamount = Math.abs(limitamount);
        $("#amounttablemanual").val(limitamount).trigger("input");
        var desc = "";
        $("#descripitontableselect").change(function () {
            desc = $("#descripitontableselect").val();
            if (desc != "" && desc != "10" && desc != "15") {
                $("#amounttablemanual").val(limitamount).trigger("input");
                $("#amounttablemanual").on("input", function () {
                    if (
                        parseInt(
                            $("#amounttablemanual").val().replace(/\D/g, "")
                        ) > parseInt(limitamount)
                    ) {
                        $("#amounttablemanual")
                            .val(limitamount)
                            .trigger("input");
                    }
                });
            }
        });
    }
}

function updateinteresttable(ins) {
    return `
    <tr>
        <input type='hidden' id='share${ins.slip_number}${ins.id}' value='${
        ins.percentage
    }'>

        <input type='hidden' id='amount${ins.slip_number}${ins.id}' value='${
        ins.amountlocation
    }'>

        <input type='hidden' id='interestdata${ins.slip_number}${
        ins.id
    }' value='${ins.interest.id}'>

        <input type='hidden' id='cedingdata${ins.slip_number}${
        ins.id
    }' value='${ins.interestceding.id}'>

        <input type='hidden' id='cndn${ins.slip_number}${ins.id}' value='${
        ins.interest_cndn_no ?? ""
    }'>

        <input type='hidden' id='cert${ins.slip_number}${ins.id}' value='${
        ins.interest_cert_no ?? ""
    }'>

        <input type='hidden' id='slip${ins.slip_number}${ins.id}' value='${
        ins.interest_slip_no ?? ""
    }'>

        <input type='hidden' id='policy${ins.slip_number}${ins.id}' value='${
        ins.interest_policy_no ?? ""
    }'>

        <td>${ins.interestceding.name}</td>
        <td>${ins.interest.code} - ${ins.interest.description}</td>
        <td>${ins.interest_cndn_no ?? "-"}</td>
        <td>${ins.interest_cert_no ?? "-"}</td>
        <td>${ins.interest_slip_no ?? "-"}</td>
        <td>${ins.interest_policy_no ?? "-"}</td>
        <td>${Number(ins.percentage).toFixed(2)}%</td>
    
        <td>${ins.amountlocation
            .toString()
            .replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</td>
        <td>
            <input type='checkbox' id="${ins.id}" name="interestinsured${
        ins.slip_number
    }" checked disabled>
        </td>
    </tr>
    `;
}

function updatelocationtable(data, index) {
    slip_data.address = index;
    return `
        <tr>
            <td colspan="2">${data.address.address}</td>
        </tr>
        <tr style="border-bottom: 2px black solid;">
            <td width='5%'></td>
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

function updatesliptable(slip) {
    return `
        <tr>
            <input type='hidden' id='number_slip${slip.id}' value='${
        slip.slip_number
    }'>
            <input type='hidden' id='koc${slip.id}' value='${slip.koc}'>
            <input type='hidden' id='cob${slip.id}' value='${slip.cob}'>
            <td>${slip.slip_number}</td>
            <td>${slip.slipbroker.name}</td>
            <td>${slip.slipceding.name}</td>
            <td>${slip.slip.reinsurance_period_from
                .split("-")
                .reverse()
                .join("/")} - ${slip.slip.reinsurance_period_to
        .split("-")
        .reverse()
        .join("/")}</td>
            <td>${slip.slip_status}</td>
            <td>${
                slip.slip.date_transfer
                    ? new Date(slip.slip.date_transfer).toLocaleDateString(
                          "en-GB",
                          {
                              day: "2-digit",
                              month: "2-digit",
                              year: "numeric",
                          }
                      )
                    : "-"
            }</td>
            <td>${slip.slip.username ?? "-"}</td>
            <td>
            <a class="text-primary mx-auto" data-toggle="modal" data-target="#detailmodaldata" href="#detailmodaldata">
                <button type="button" id='btn${
                    slip.id
                }' class="btn btn-sm btn-primary mx-auto" data-toggle="modal"
                data-target="#detailmodaldata2">Detail Slip</button>
            </a>
            </td>
        </tr>
    `;
}

async function getslip(isUpdate, slipnumber) {
    $("body").addClass("loading");
    if (isUpdate) {
        $("#documentstatus").show();
        $("#printdocument").show();
        $("#claimbutton").hide();
        $("#agendacebtn").show();
        var slipdetail = JSON.parse($("#claimdata").val());
        var lossamountlimit = $("#lossamountlimit").val();
        currency = {
            code: slipdetail.slip.insureddata.currency.code,
            kurs: slipdetail.slip.insureddata.exchange?.kurs,
        };
        slipkoc = slipdetail.slip.kindcontract;
        slipcob = slipdetail.slip.corebusiness;
        console.log(slipkoc, slipcob);
        // lossAmount(lossamountlimit, slipdetail.status_flag);
        inputSetter(slipdetail);
        descriptionLoss(slipdetail.reg_comp, slipdetail.doc_counter, isUpdate);

        // if (slipdetail.doc_counter > 2) {
        //     $("#causeofloss").prop("disabled", true);
        //     $("#natureofloss").prop("disabled", true);
        //     $("#dateofloss").prop("disabled", true);
        //     $("#surveyoradjuster").prop("disabled", true);
        // }

        if (
            new Date(slipdetail.dateofentry).getMonth() <
                new Date().getMonth() ||
            slipdetail.cereffno
        ) {
            disableinput = true;
            inputDisabler(disableinput);
            console.log("yes");
        }

        if (doctype == "mc" || doctype == "mh") {
            $("#claiminsured").show();
        } else {
            var filtered = await axios
                .get(
                    "/claimtransaction-data/" +
                        doctype +
                        "/getfilterdata/" +
                        slipdetail.reg_comp
                )
                .then((res) => res.data.claiminsured);
            console.log(
                "🚀 ~ file: main_section_slip.js ~ line 527 ~ getslip ~ slipdetail.reg_comp",
                slipdetail.reg_comp
            );
            console.log(
                "🚀 ~ file: main_section_slip.js ~ line 529 ~ getslip ~ filtered",
                filtered
            );
            if (filtered.length > 0) {
                var addresses = _.groupBy(filtered, "address_id");
                _.each(addresses, function (adrs) {
                    console.log(adrs);
                    $("#tablelocations #mainbodylocations").append(
                        updatelocationtable(adrs[0], adrs[0].address.id)
                    );
                });

                $("#mainbodyslips").append(updatesliptable(filtered[0]));

                _.each(filtered, function (loc, locid) {
                    $("#slipinsured" + loc.address.id).append(
                        updateinteresttable(loc, loc.address.id)
                    );

                    // console.log(loc);
                    slip_data.id = loc.id;
                    slip_data.uy = loc.slip.insureddata.uy;
                    slip_data.koc = loc.kocdata.code;
                    slip_data.cob = loc.cobdata.code;
                    slip_data.year = new Date().getFullYear();
                    slip_data.month = new Date().getMonth();

                    slip_data.broker = loc.slip_broker_id;
                    slip_data.ceding = loc.slip_ceding_id;
                    slip_data.slip_number = loc.slip_number;
                    slip_data.status = loc.slip_status;

                    $("#btn" + loc.id).click(function (e) {
                        e.preventDefault();

                        var _val = $("#number_slip" + loc.id).val();
                        var checkcount = $(
                            `input[name="interestinsured${loc.slip_number}"]:checked`
                        ).length;

                        if (checkcount == 0 && _val) {
                            $("#claimbutton").prop("disabled", true);
                        } else {
                            $("#claimbutton").prop("disabled", false);
                        }

                        $("#selectedslip").val(_val).change();
                        $("#selectedslipid").val(loc.slip.id).change();
                    });
                });
                $("#claiminsured").show();
            }
        }
    }
    $("body").removeClass("loading");
}
