function valueGetter(
    old_doc_counter = null,
    isinterim = false,
    iscancel = false,
    old_regcomp = null
) {
    var regcomp = new_regcomp ?? $("#regcomp").val();
    var doc_counter = $("#doccounter").val() ?? 1;
    var number = $("#slipnumberdata").val();

    var docnumber = $("#docnumber").val();
    var docpladla = $("#docpladla").val();

    var dateofreceipt = $("#dateofreceipt").val();
    var dateofdocument = $("#dateofdocument").val();

    var causeofloss = $("#causeofloss").val();
    var desccauseofloss = $("#desccauseofloss").val();

    var natureofloss = $("#natureofloss").val();
    var descnatureofloss = $("#descnatureofloss").val();
    var dateofloss = $("#dateofloss").val();

    var currofloss = $("#currofloss").val();
    var desccurrofloss = $("#desccurrofloss").val();

    var adjuster = $("#adjuster").val();
    var descadjuster = $("#descadjuster").val();
    var surveyor = $("#surveyor").val();
    var descsurveyor = $("#descsurveyor").val();

    var nationalresliab = $("#nationalresliab").val();
    var descnationalresliab = $("#descnationalresliab").val();
    descnationalresliab = parseFloat(descnationalresliab.replace(/,/g, ""));

    var shareonloss = $("#shareonloss").val();
    shareonloss = parseFloat(shareonloss.replace(/,/g, ""));

    var cedantshare = $("#cedantshare").val();
    cedantshare = parseFloat(cedantshare.replace(/,/g, ""));

    var totallossamount = $("#totallossamount").val();
    totallossamount = parseFloat(totallossamount.replace(/,/g, ""));

    var subrogasipersen = $("#subrogasipersen").val();
    var subrogasi = $("#subrogasi").val();
    subrogasi = parseFloat(subrogasi.replace(/,/g, ""));

    var potentialrecoverydecision = $("#potentialrecoverydecision").val();
    var potentialrecovery = $("#potentialrecovery").val();
    var kronologi = $("#kronologi").val();
    var staffrecomend = $("#staffrecomend").val();
    var assistantmanagerrecomend = $("#assistantmanagerrecomend").val();
    var generalmanagerrecomend = $("#generalmanagerrecomend").val();
    var managerrecomend = $("#managerrecomend").val();

    var pureorliability = $("#pureorliability").val();
    var pureorloss = $("#pureorloss").val();
    var pureorcontract = $("#pureorcontract").val();
    var pureorrecovery = $("#pureorrecovery").val();

    var qsliability = $("#qsliability").val();
    var qsloss = $("#qsloss").val();
    var qscontract = $("#qscontract").val();
    var qsrecovery = $("#qsrecovery").val();

    var arr1liability = $("#arr1liability").val();
    var arr1loss = $("#arr1loss").val();
    var arr1contract = $("#arr1contract").val();
    var arr1recovery = $("#arr1recovery").val();

    var extraliability = $("#extraliability").val();
    var extraloss = $("#extraloss").val();
    var extracontract = $("#extracontract").val();
    var extrarecovery = $("#extrarecovery").val();

    var facultativeliability = $("#facultativeliability").val();
    var facultativeloss = $("#facultativeloss").val();
    var facultativecontract = $("#facultativecontract").val();
    var facultativerecovery = $("#facultativerecovery").val();

    var arr2liability = $("#arr2liability").val();
    var arr2loss = $("#arr2loss").val();
    var arr2contract = $("#arr2contract").val();
    var arr2recovery = $("#arr2recovery").val();

    var arr3liability = $("#arr3liability").val();
    var arr3loss = $("#arr3loss").val();
    var arr3contract = $("#arr3contract").val();
    var arr3recovery = $("#arr3recovery").val();

    var totalrecovery = "0"; //$("#totalrecovery").val();
    totalrecovery = parseFloat(totalrecovery.replace(/,/g, ""));

    var nrsgrossret = $("#nrsgrossret").val();
    nrsgrossret = parseFloat(nrsgrossret.replace(/,/g, ""));

    var xol = $("#xol").val();
    var cereffno = $("#cereffno").val();
    var dateofprod =
        $("#dateofprod").val() == "" ? null : $("#dateofprod").val();
    var ceno = $("#ceno").val();
    var ceuser = $("#ceuser").val();
    var status_ce = $("#status_ce").val();
    var description = $("#description").val();
    var dateentry = $("#dateentry").val();
    var datetrans = $("#datetrans").val() == "" ? null : $("#datetrans").val();
    var datesupporting =
        $("#datesupporting").val() == "" ? null : $("#datesupporting").val();
    var statusflag = $("#statusflag").val();
    // var slip_type = $("#doc_type").val();

    // console.log(dateofreceipt, dateofdocument, dateofloss);
    var interim = null;
    if (isinterim) interim = true;

    var cancel = false;
    if (iscancel) cancel = true;

    var data = {
        regcomp: regcomp,
        number: number,
        docnumber: docnumber,
        docpladla: docpladla,
        doc_counter: doc_counter,
        old_doc_counter: old_doc_counter,
        old_regcomp: old_regcomp,
        dateofreceipt: dateofreceipt,
        dateofdocument: dateofdocument,
        causeofloss: causeofloss,
        desccauseofloss: desccauseofloss,
        natureofloss: natureofloss,
        descnatureofloss: descnatureofloss,
        dateofloss: dateofloss,
        currofloss: currofloss,
        desccurrofloss: desccurrofloss,
        adjuster: adjuster,
        descadjuster: descadjuster,
        surveyor: surveyor,
        descsurveyor: descsurveyor,
        nationalresliab: nationalresliab,
        descnationalresliab: descnationalresliab,
        shareonloss: shareonloss,
        cedantshare: cedantshare,
        totallossamount: totallossamount,
        subrogasipersen: subrogasipersen,
        subrogasi: subrogasi,
        kronologi: kronologi,
        potentialrecoverydecision: potentialrecoverydecision,
        potentialrecovery: potentialrecovery,
        staffrecomend: staffrecomend,
        assistantmanagerrecomend: assistantmanagerrecomend,
        generalmanagerrecomend: generalmanagerrecomend,
        managerrecomend: managerrecomend,
        status_flag: statusflag,
        description: description,
        dateentry: dateentry,
        datetrans: datetrans,
        datesupporting: datesupporting,
        interim: interim,
        cancel: cancel,
        koc_abb: slipkoc,
    };
    return data;
}

async function storeDescriptionLoss(regcomp, doccounter, duplicate = false) {
    if (duplicate) {
        console.log(desc_loss_datas);
        desc_loss_datas.forEach(async (data) => {
            await axios
                .post(
                    "/claimtransaction-data/" +
                        doctype +
                        "/store-claimmanual-list",
                    {
                        reg_comp: regcomp,
                        description_id: data.desc_id,
                        amountmanual: data.val,
                        doc_counter: doccounter,
                    }
                )
                .then((res) => res.data)
                .catch((err) => console.error(err.message));
        });
    } else {
        desc_loss_datas_corr.forEach(async (data) => {
            await axios
                .post(
                    "/claimtransaction-data/" +
                        doctype +
                        "/store-claimmanual-list",
                    {
                        reg_comp: regcomp,
                        description_id: data.desc_id,
                        amountmanual: data.val,
                        doc_counter: doccounter,
                    }
                )
                .then((res) => res.data)
                .catch((err) => console.error(err.message));
        });
        if (changedocument?.iscorrection) {
            await axios
                .get(
                    "/claimtransaction-data/" +
                        doctype +
                        "/updatetotalloss/" +
                        regcomp +
                        "/" +
                        doccounter
                )
                .then((res) => res.data)
                .catch((err) => console.error(err.message));
        }
    }
}

async function claimInsuredMarine(id, regcomp) {
    var number = $("#slipnumberdata").val();
    $(`input[name="interestinsured${number}"]`).each(async function () {
        if (this.checked) {
            var _id = this.id.replace("check", "");
            var _regcomp = regcomp;
            var _doc_counter = $("#doccounter").val();

            var _interest = $("#interestdata" + number + _id).val();
            var _interest_ceding = $("#cedingdata" + number + _id).val();

            var _cndn = $("#cndn" + number + _id).val() ?? "";
            var _cert = $("#cert" + number + _id).val() ?? "";
            var _slip_no = $("#slip" + number + _id).val() ?? "";
            var _policy_no = $("#policy" + number + _id).val() ?? "";

            var _intrest_share = $("#share" + number + _id).val();
            var _intrest_amount = $("#amount" + number + _id).val();

            var _ship = $("#ship" + number + _id).val();
            var _cob = slip_data.cobid;
            var _koc = slip_data.kocid;

            var _slip_broker = slip_data.broker;
            var _slip_ceding = slip_data.ceding;
            var _slip_number = slip_data.slip_number;
            var _slip_status = slip_data.status;

            var _data = {
                reg_comp: _regcomp,
                doc_counter: _doc_counter,

                main_claim_id: id,
                checked: this.checked,

                interest: _interest,
                interest_ceding: _interest_ceding,

                cndn: _cndn,
                cert: _cert,
                slip_no: _slip_no,
                policy_no: _policy_no,

                share: _intrest_share,
                amount: _intrest_amount,

                ship: _ship,
                cob: _cob,
                koc: _koc,

                slip_broker: _slip_broker,
                slip_ceding: _slip_ceding,
                slip_number: _slip_number,
                slip_status: _slip_status,
            };
            console.log(_data);
            await axios
                .post("/claimtransaction-data/claiminsured/store", _data)
                .then((res) => console.log(res.data))
                .catch((error) => {
                    if (error?.response?.data?.errors) {
                        // console.log(error.response.data.errors);
                        var _lierror = "<ul>";
                        _.each(
                            error.response.data.errors,
                            function (value, key) {
                                _lierror +=
                                    "<li class='text-left mb-2'>" +
                                    value +
                                    "</li>";
                            }
                        );
                        _lierror += "</ul>";
                        swal({
                            type: "error",
                            title: error.response.data.message,
                            html: _lierror,
                        });
                    }
                });
        }
    });
}

async function submitClaimData(e) {
    e.preventDefault();

    // console.log(changedocument);
    if (changedocument?.active) {
        if (changedocument?.isinterimdla) {
            $("body").addClass("loading");
            var createdoc = true;

            var lastdoccounter = await axios
                .get(
                    "/claimtransaction-data/" +
                        doctype +
                        "/getlatestdoccount/" +
                        changedocument.regcomp
                )
                .then((res) => res.data);
            if (lastdoccounter == $("#doccounter").val()) {
                createdoc = false;
                swal({
                    type: "warning",
                    title: "Doc Counter Used!",
                    text: "Change to new doc counter?",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes",
                }).then(async (result) => {
                    if (result.value === true) {
                        createdoc = true;
                        $("#doccounter").val(parseInt(lastdoccounter) + 1);
                    }
                });
            }
            if (createdoc) {
                if (changedocument?.selectedstatus == 1) {
                    var laststatusflag = await axios
                        .get(
                            "/claimtransaction-data/" +
                                doctype +
                                "/getLastRegcompStatus/" +
                                changedocument.regcomp
                        )
                        .then((res) => res.data);
                    if (laststatusflag < 3) {
                        await axios
                            .post(
                                "/claimtransaction-data/" +
                                    doctype +
                                    "/changeDocumentStatus",
                                valueGetter(changedocument.old_doccounter, true)
                            )
                            .then(async (res) => {
                                console.log(res.data);
                                console.log(atob(res.data.id_base));
                                await storeDescriptionLoss(
                                    changedocument.regcomp,
                                    res.data.doc_counter
                                );
                                location =
                                    "/claimtransaction-data/" +
                                    doctype +
                                    "/update/" +
                                    res.data.id_base;
                            })
                            .catch((error) => {
                                var _lierror = "<ul>";
                                _.each(
                                    error.response.data.errors,
                                    function (value, key) {
                                        console.log(key);
                                        _lierror +=
                                            "<li class='text-left mb-2'>" +
                                            ($("#" + key + "text").text() ||
                                                $("#" + key + "text").val()) +
                                            " field is required.</li>";
                                    }
                                );
                                _lierror += "</ul>";
                                swal({
                                    type: "error",
                                    title: error.response.data.message,
                                    html: _lierror,
                                });
                            });
                    } else {
                        swal(
                            "Error",
                            "This document already have DLA!",
                            "error"
                        );
                    }
                } else if (changedocument?.selectedstatus == 2) {
                    await axios
                        .post(
                            "/claimtransaction-data/" +
                                doctype +
                                "/changeDocumentStatus",
                            valueGetter(changedocument.old_doccounter)
                        )
                        .then(async (res) => {
                            await storeDescriptionLoss(
                                changedocument.regcomp,
                                res.data.doc_counter
                            );

                            location =
                                "/claimtransaction-data/" +
                                doctype +
                                "/update/" +
                                res.data.id_base;
                        })
                        .catch((error) => {
                            var _lierror = "<ul>";
                            _.each(
                                error.response.data.errors,
                                function (value, key) {
                                    _lierror +=
                                        "<li class='text-left mb-2'>" +
                                        ($("#" + key + "text").text() ||
                                            $("#" + key + "text").val()) +
                                        " field is required.</li>";
                                }
                            );
                            _lierror += "</ul>";
                            swal({
                                type: "error",
                                title: error.response.data.message,
                                html: _lierror,
                            });
                        });
                }
            }

            $("body").removeClass("loading");
        } else if (changedocument?.iscorrection) {
            await axios
                .post(
                    "/claimtransaction-data/" + doctype + "/correctionclaim",
                    valueGetter(changedocument.old_doccounter)
                )
                .then(async (res) => {
                    await storeDescriptionLoss(
                        changedocument.regcomp,
                        res.data.doc_counter,
                        true
                    );
                    location =
                        "/claimtransaction-data/" +
                        doctype +
                        "/update/" +
                        res.data.id_base;
                });
        } else if (changedocument?.ismulti) {
            // var _newregcomp = await createRegComp();
            // $("#regcomp").val(_newregcomp);

            if (changedocument.iscancel) {
                await requestmulti(
                    valueGetter(null, false, true, changedocument.old_regcomp)
                );
            } else {
                await requestmulti(
                    valueGetter(null, false, false, changedocument.old_regcomp)
                );
            }
        }
    } else {
        $("body").addClass("loading");
        var _new_doc = false;

        if ($("#regcomp").val() == "") {
            _new_doc = true;
            new_regcomp = await createRegComp();
            $("#doccounter").val(1);
            // console.log(new_regcomp);
        }

        $("#dateentry").val(
            new Date(Date.now()).toLocaleDateString("en-GB", {
                year: "numeric",
                month: "2-digit",
                day: "2-digit",
            })
        );

        var claim_data = await axios
            .post("/claimtransaction-data/" + doctype + "/store", valueGetter())
            .then((response) => {
                if (_new_doc) {
                    desc_loss_datas.forEach(async (data) => {
                        await axios
                            .post(
                                "/claimtransaction-data/" +
                                    doctype +
                                    "/store-claimmanual-list",
                                {
                                    reg_comp: new_regcomp,
                                    description_id: data.desc_id,
                                    amountmanual: data.val,
                                    doc_counter: 1,
                                }
                            )
                            .then((res) => res.data)
                            .catch((err) => console.error(err.message));
                    });
                }
                return response.data;
            })
            .catch((error) => {
                return error;
            });

        if (isNaN(claim_data?.id)) {
            var _lierror = "<ul>";
            _.each(claim_data.response.data.errors, function (value, key) {
                console.log(key);
                _lierror +=
                    "<li class='text-left mb-2'>" +
                    ($("#" + key + "text").text() ||
                        $("#" + key + "text").val()) +
                    " field is required.</li>";
            });
            _lierror += "</ul>";
            $("body").removeClass("loading");
            swal({
                type: "error",
                title: claim_data.response.data.message,
                html: _lierror,
            });
        } else {
            var number = $("#slipnumberdata").val();

            if (_new_doc && (doctype == "mc" || doctype == "mh")) {
                console.log(claim_data.id, claim_data.regcomp);
                await claimInsuredMarine(claim_data.id, claim_data.regcomp);
            } else if (_new_doc) {
                $(`input[name="interestinsured${number}"]`).each(
                    async function () {
                        if (this.checked) {
                            var _id = this.id.replace("check", "");
                            var _regcomp = new_regcomp;
                            var _doc_counter = $("#doccounter").val();

                            var _interest = $(
                                "#interestdata" + number + _id
                            ).val();
                            var _interest_ceding = $(
                                "#cedingdata" + number + _id
                            ).val();

                            var _cndn = $("#cndn" + number + _id).val();
                            var _cert = $("#cert" + number + _id).val();
                            var _slip_no = $("#slip" + number + _id).val();
                            var _policy_no = $("#policy" + number + _id).val();

                            var _intrest_share = $(
                                "#share" + number + _id
                            ).val();
                            var _intrest_amount = $(
                                "#amount" + number + _id
                            ).val();

                            var _address = $("#address" + number + _id).val();
                            var _cob = slip_data.cobid;
                            var _koc = slip_data.kocid;

                            var _slip_broker = slip_data.broker;
                            var _slip_ceding = slip_data.ceding;
                            var _slip_number = slip_data.slip_number;
                            var _slip_status = slip_data.status;

                            var _data = {
                                reg_comp: _regcomp,
                                doc_counter: _doc_counter,

                                main_claim_id: claim_data.id,
                                checked: this.checked,

                                interest: _interest,
                                interest_ceding: _interest_ceding,

                                cndn: _cndn,
                                cert: _cert,
                                slip_no: _slip_no,
                                policy_no: _policy_no,

                                share: _intrest_share,
                                amount: _intrest_amount,

                                address: _address,
                                cob: _cob,
                                koc: _koc,

                                slip_broker: _slip_broker,
                                slip_ceding: _slip_ceding,
                                slip_number: _slip_number,
                                slip_status: _slip_status,
                            };
                            // console.log(_data);
                            await axios
                                .post(
                                    "/claimtransaction-data/claiminsured/store",
                                    _data
                                )
                                .then((res) => console.log(res.data))
                                .catch((error) => {
                                    if (error?.response?.data?.errors) {
                                        var _lierror = "<ul>";
                                        _.each(
                                            error.response.data.errors,
                                            function (value, key) {
                                                _lierror +=
                                                    "<li class='text-left mb-2'>" +
                                                    value +
                                                    "</li>";
                                            }
                                        );
                                        _lierror += "</ul>";
                                        swal({
                                            type: "error",
                                            title: error.response.data.message,
                                            html: _lierror,
                                        });
                                    }
                                });
                        }
                    }
                );
            }

            $("body").removeClass("loading");
            swal("Success!", " ", "success").then(() => {
                if (_new_doc)
                    location =
                        "/claimtransaction-data/" +
                        doctype +
                        "/update/" +
                        claim_data.id_base;
                _new_doc = false;
            });
        }
    }
}

$("#addclaiminsured-btn").click(function (e) {
    var desc = $("#descnationalresliab").val();
    var sol = $("#shareonloss").val();
    var cs = $("#cedantshare").val();
    var tla = $("#totallossamount").val();
    var sub = $("#subrogasi").val();

    var desc_float = parseFloat(desc.replace(/,/g, ""));
    var sol_float = parseFloat(sol.replace(/,/g, ""));
    var cs_float = parseFloat(cs.replace(/,/g, ""));
    var tla_float = parseFloat(tla.replace(/,/g, ""));
    var sub_float = parseFloat(sub.replace(/,/g, ""));

    swal({
        type: "warning",
        title: "Are you sure to save this document?",
        html:
            "<ul class='text-left' style='list-style-type: none;'>" +
            `<li>${currency.code} - 
            ${toMoneyFormat(currency.kurs)} - National Re's Liab - 
            ${toMoneyFormat(desc) || 0} = 
            ${toMoneyFormat((desc_float || 0) * currency.kurs)}</li>` +
            `<li>${currency.code} - 
            ${toMoneyFormat(currency.kurs)} - Cedant's Share - 
            ${toMoneyFormat(cs) || 0} = 
            ${toMoneyFormat((cs_float || 0) * currency.kurs)}</li>` +
            `<li>${currency.code} -
            ${toMoneyFormat(currency.kurs)} - National Re's Share on Loss - 
            ${toMoneyFormat(sol) || 0} = 
            ${toMoneyFormat((sol_float || 0) * currency.kurs)}</li>` +
            `<li>${currency.code} - 
            ${toMoneyFormat(currency.kurs)} - Estimate Amount Subrogasi - 
            ${toMoneyFormat(sub) || 0} = 
            ${toMoneyFormat((sub_float || 0) * currency.kurs)}</li>` +
            `<li>${currency.code} - 
            ${toMoneyFormat(currency.kurs)} - Total Loss Amt - 
            ${toMoneyFormat(tla) || 0} = 
            ${toMoneyFormat((tla_float || 0) * currency.kurs)}</li>` +
            "</ul>",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Save Data!",
        width: "50rem",
    }).then((result) => {
        if (result.value === true) {
            submitClaimData(e);
        }
    });
});

$("#addallclaiminsured-btn").click(function (e) {
    submitClaimData(e);
});
