function valueGetter(
    old_doc_counter = null,
    isinterim = false,
    iscancel = false,
    old_regcomp = null
) {
    var regcomp = new_regcomp ?? $("#regcomp").val();
    var regcomp_counter = regcomp.toString().slice(-4);
    var doc_counter = $("#doccounter").val() ?? 1;
    var number = $("#slipnumberdata").val();

    var docnumber = $("#docnumber").val();
    var docpladla = $("#docpladla").val();

    var dateofreceipt = $("#date_receipt").val().split("/").reverse().join("-");
    var dateofdocument = $("#date_document")
        .val()
        .split("/")
        .reverse()
        .join("-");

    var causeofloss = $("#causeofloss_id").val();
    var desccauseofloss = $("#desccauseofloss").val();

    var natureofloss = $("#natureofloss_id").val();
    var descnatureofloss = $("#descnatureofloss").val();
    var dateofloss = $("#date_of_loss").val().split("/").reverse().join("-");

    var currofloss = $("#curr_id_loss").val();
    var desccurrofloss = $("#desccurrofloss").val();

    var surveyor = $("#surveyor_id").val();
    var descsurveyor = $("#descsurveyor").val();

    var adjuster = $("#adjuster_id").val();
    var descadjuster = $("#descadjuster").val();

    var nationalresliab = $("#nationalresliab").val();
    var descnationalresliab = $("#descnationalresliab").val();
    descnationalresliab = parseFloat(descnationalresliab.replace(/,/g, ""));

    var shareonloss = $("#nasre_share_loss").val();
    shareonloss = parseFloat(shareonloss.replace(/,/g, ""));

    var cedantshare = $("#ced_share").val();
    cedantshare = parseFloat(cedantshare.replace(/,/g, ""));

    var totallossamount = $("#total_loss_amount").val();
    totallossamount = parseFloat(totallossamount.replace(/,/g, ""));

    var potentialrecoverydecision = $("#potentialrecoverydecision").val();
    var potentialrecovery = $("#potentialrecovery").val();
    var subrogasipersen = $("#estimate_percent_subro").val();
    var subrogasi = $("#subrogasi").val();
    subrogasi = parseFloat(subrogasi.replace(/,/g, ""));

    var kronologi = $("#kronologi").val();
    var staffrecomend = $("#staffrecomend").val();
    var assistantmanagerrecomend = $("#assistantmanagerrecomend").val();

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
        $("#dateofprod").val() == ""
            ? null
            : $("#dateofprod").val().split("/").reverse().join("-");
    var ceno = $("#ceno").val();
    var ceuser = $("#ceuser").val();
    var status_ce = $("#status_ce").val();
    var description = $("#description").val();
    var dateentry = new Date().toLocaleDateString("en-ZA");
    var datetrans =
        $("#datetrans").val() == ""
            ? null
            : $("#datetrans").val().split("/").reverse().join("-");
    var datesupporting =
        $("#datesupporting").val() == ""
            ? null
            : $("#datesupporting").val().split("/").reverse().join("-");
    var statusflag = $("#statusflag").val() || 1;
    var interim = null;
    if (isinterim) interim = true;

    var cancel = false;
    if (iscancel) cancel = true;
    var data = {
        number: number,
        reg_comp: regcomp,
        doc_number: docnumber,
        docpladla: docpladla,
        doc_counter: doc_counter,
        date_receipt: dateofreceipt,
        date_document: dateofdocument,
        causeofloss_id: causeofloss,
        desc_causeofloss: desccauseofloss,
        natureofloss_id: natureofloss,
        descnatureofloss: descnatureofloss,
        date_of_loss: dateofloss,
        curr_id_loss: currofloss,
        curr_lossdesc: desccurrofloss,
        surveyor_id: surveyor,
        desc_surveyor: descsurveyor,
        adjuster_id: adjuster,
        desc_adjuster: descadjuster,
        nasre_liab: nationalresliab,
        nasre_liabdesc: descnationalresliab,
        nasre_share_loss: shareonloss,
        ced_share: cedantshare,
        total_loss_amount: totallossamount,
        estimate_percent_subro: subrogasipersen,
        estimate_amount_subro: subrogasi,
        potential_recovery: potentialrecoverydecision,
        desc_poten_rec: potentialrecovery,
        kronologi: kronologi,
        staff_recomendation: staffrecomend,
        ass_man_recomen: assistantmanagerrecomend,
        route_from: "",
        route_to: "",
        pureor_liability: pureorliability,
        pureor_loss: pureorloss,
        pureor_retro: pureorcontract,
        pureor_recovery: pureorrecovery,
        qs_liability: qsliability,
        qs_loss: qsloss,
        qs_retro: qscontract,
        qs_recovery: qsrecovery,
        arr1_liability: arr1liability,
        arr1_loss: arr1loss,
        arr1_retro: arr1contract,
        arr1_recovery: arr1recovery,
        extra_liability: extraliability,
        extra_loss: extraloss,
        extra_retro: extracontract,
        extra_recovery: extrarecovery,
        facultative_liability: facultativeliability,
        facultative_loss: facultativeloss,
        facultative_retro: facultativecontract,
        facultative_recovery: facultativerecovery,
        arr2_liability: arr2liability,
        arr2_loss: arr2loss,
        arr2_retro: arr2contract,
        arr2_recovery: arr2recovery,
        arr3_liability: arr3liability,
        arr3_loss: arr3loss,
        arr3_retro: arr3contract,
        arr3_recovery: arr3recovery,
        totalrecovery: totalrecovery,
        nrsgrossret: nrsgrossret,
        xol: xol,
        cereffno: cereffno,
        dateofprod: dateofprod,
        ceno: ceno,
        ceuser: ceuser,
        description: description,
        dateofentry: dateentry,
        dateoftrans: datetrans,
        dateofsupporting: datesupporting,
        status_flag: statusflag,
        interim_count: interim,
        status_ce: status_ce,
        reg_comp_counter: regcomp_counter,
    };
    if (changedocument?.active) {
        data.old_doc_counter = old_doc_counter;
        data.old_regcomp = old_regcomp;
        data.cancel = cancel;
    }

    return data;
}

async function storeDescriptionLoss(regcomp, doccounter, duplicate = false) {
    if (duplicate) {
        console.log(desc_loss_datas);
        desc_loss_datas.forEach(async (data) => {
            await axios
                .post("/store-claimmanual-list", {
                    reg_comp: regcomp,
                    description_id: data.desc_id,
                    amountmanual: Math.abs(data.val),
                    doc_counter: doccounter,
                })
                .then((res) => res.data)
                .catch((err) => console.error(err.message));
        });
    } else {
        desc_loss_datas_corr.forEach(async (data) => {
            await axios
                .post("/store-claimmanual-list", {
                    reg_comp: regcomp,
                    description_id: data.desc_id,
                    amountmanual: Math.abs(data.val),
                    doc_counter: doccounter,
                })
                .then((res) => res.data)
                .catch((err) => console.error(err.message));
        });
        if (changedocument?.iscorrection) {
            await axios
                .get(
                    "/claimtransaction-data/updatetotalloss/" +
                        regcomp +
                        "/" +
                        doccounter
                )
                .then((res) => res.data)
                .catch((err) => console.error(err.message));
        }
    }
}

async function claimInsured(id, regcomp) {
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
    if (changedocument?.active) {
        if (changedocument?.isinterimdla) {
            $("body").addClass("loading");
            var createdoc = true;

            var lastdoccounter = await axios
                .get(
                    "/claimtransaction-data/getlatestdoccount/" +
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
                            "/claimtransaction-data/getLastRegcompStatus/" +
                                changedocument.regcomp
                        )
                        .then((res) => res.data);
                    if (laststatusflag < 3) {
                        await axios
                            .post(
                                "/claimtransaction-data/changeDocumentStatus",
                                valueGetter(changedocument.old_doccounter, true)
                            )
                            .then(async (res) => {
                                await storeDescriptionLoss(
                                    changedocument.regcomp,
                                    res.data.doc_counter
                                );
                                location =
                                    "/claimtransaction-data/update/" +
                                    res.data.id;
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
                            "/claimtransaction-data/changeDocumentStatus",
                            valueGetter(changedocument.old_doccounter)
                        )
                        .then(async (res) => {
                            await storeDescriptionLoss(
                                changedocument.regcomp,
                                res.data.doc_counter
                            );

                            location =
                                "/claimtransaction-data/update/" + res.data.id;
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
                    "/claimtransaction-data/correctionclaim",
                    valueGetter(changedocument.old_doccounter)
                )
                .then(async (res) => {
                    await storeDescriptionLoss(
                        changedocument.regcomp,
                        res.data.doc_counter
                    );
                    location = "/claimtransaction-data/update/" + res.data.id;
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
        }

        // $("#dateentry").val(
        //     new Date(Date.now()).toLocaleDateString("en-US", {
        //         year: "numeric",
        //         month: "2-digit",
        //         day: "2-digit",
        //     })
        // );
        var claim_id = await axios
            .post("/claimtransaction-data/marine/claim/store", valueGetter())
            .then((response) => {
                desc_loss_datas.forEach(async (data) => {
                    await axios
                        .post("/store-claimmanual-list", {
                            reg_comp: response.data.regcomp,
                            description_id: data.desc_id,
                            amountmanual: data.val,
                            doc_counter: 1,
                        })
                        .then((res) => res.data)
                        .catch((err) => console.error(err.message));
                });

                return response.data;
            })
            .catch((error) => {
                return error;
            });
        console.log(claim_id?.request);
        if (claim_id?.response?.data?.errors) {
            console.log(claim_id.response.data.errors);
            var _lierror = "<ul>";
            _.each(claim_id.response.data.errors, function (value, key) {
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
                title: claim_id.response.data.message,
                html: _lierror,
            });
        } else if (claim_id?.id) {
            if (_new_doc)
                await claimInsured(claim_id?.id || 1, claim_id.regcomp);
            $("body").removeClass("loading");
            swal("Success!", " ", "success").then(() => {
                if (_new_doc) {
                    var m_type =
                        $("#type_claim").val() == "cargo" ? "cargo" : "hull";
                    location =
                        "/claimtransaction-data/marine/" +
                        m_type +
                        "/" +
                        claim_id.id;
                    _new_doc = false;
                }
            });
        }
    }
}

$("#addclaiminsured-btn").click(function (e) {
    var desc = $("#descnationalresliab").val();
    var sol = $("#nasre_share_loss").val();
    var cs = $("#ced_share").val();
    var tla = $("#total_loss_amount").val();
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
            `<li>${currency.curr.code} - ${
                currency.kurs
            } - National Re's Liab - ${desc || 0} = ${(
                (desc_float || 0) * currency.kurs
            )
                .toString()
                .replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</li>` +
            `<li>${currency.curr.code} - ${currency.kurs} - Cedant's Share - ${
                cs || 0
            } = ${((cs_float || 0) * currency.kurs)
                .toString()
                .replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</li>` +
            `<li>${currency.curr.code} - ${
                currency.kurs
            } - National Re's Share on Loss - ${sol || 0} = ${(
                (sol_float || 0) * currency.kurs
            )
                .toString()
                .replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</li>` +
            `<li>${currency.curr.code} - ${
                currency.kurs
            } - Estimate Amount Subrogasi - ${sub || 0} = ${(
                (sub_float || 0) * currency.kurs
            )
                .toString()
                .replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</li>` +
            `<li>${currency.curr.code} - ${currency.kurs} - Total Loss Amt - ${
                tla || 0
            } = ${((tla_float || 0) * currency.kurs)
                .toString()
                .replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</li>` +
            "</ul>",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Save Data!",
        width: "40rem",
    }).then((result) => {
        if (result.value === true) {
            submitClaimData(e);
        }
    });
});
