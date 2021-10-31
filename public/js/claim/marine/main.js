console.log("main");

var changedocument = {};
var money_regex = /\B(?=(\d{3})+(?!\d))/g;
var currency;
var desc_loss_datas = [];
var desc_loss_datas_corr = [];
var new_regcomp = null;
// FUNCTIONS
function toMoneyFormat(val) {
    return val.toString().replace(money_regex, ",");
}

function calculateSubrogasi() {
    var _subper = parseInt($("#estimate_percent_subro").val()) / 100;
    var _ttla = parseInt($("#total_loss_amount").val().replace(/,/g, ""));
    var _res = isNaN(_ttla * _subper) ? 0 : parseInt(_ttla * _subper);
    $("#subrogasi").val(_res).trigger("input");
}

function calculateShareLoss() {
    var shareslip = parseInt($("#nationalresliab").val()) / 100;
    var tsi = $("#total_loss_amount").val();
    var conv_tsi = parseInt(tsi.replace(/,/g, ""));
    var sumshare = isNaN(shareslip * conv_tsi) ? 0 : shareslip * conv_tsi; //.toFixed(0);
    var real_sumshare = parseInt(sumshare)
        .toString()
        .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    $("#nasre_share_loss").val(real_sumshare).trigger("input");
}

async function createRegComp() {
    var _year = slip_data.year.toString().slice(-2);
    var _koc = slip_data.koc.slice(-3);
    var _cob = slip_data.cob.slice(-2);
    var _month = slip_data.month + 1;
    if (_month <= 9) {
        _month = "0" + _month;
    }
    var _reg_comp = "C" + _koc + _cob + _year + _month;
    var _counter = await axios
        .get("/claimtransaction-data/getlatestregcount/" + _reg_comp)
        .then((res) =>
            res.data != 0 ? (parseInt(res.data) + 1).toString() : "1"
        );
    reg_comp_counter = _counter;
    while (_counter.length < 4) _counter = "0" + _counter;
    var _reg_comp = "C" + _koc + _cob + _year + _month + _counter;
    return _reg_comp;
}

function dateFormater(val) {
    var res_Date = new Date(val).toLocaleDateString("en-GB", {
        day: "2-digit",
        month: "2-digit",
        year: "numeric",
    });
    return res_Date;
}

function inputSetter(slipdetail) {
    // $("#slipnumberdata").val(slipdetail.number);
    // $("#mainclaimid").val(slipdetail.id);
    // $("#regcomp").val(slipdetail.reg_comp);
    // $("#doccounter").val(slipdetail.doc_counter);
    // $("#docnumber").val(slipdetail.doc_number);
    // $("#docpladla").val(slipdetail.docpladla);
    // $("#dateofreceipt").val(dateFormater(slipdetail.date_receipt));
    // $("#dateofdocument").val(dateFormater(slipdetail.date_document));
    // $("#causeofloss").val(slipdetail.causeofloss_id).change();
    // $("#desccauseofloss").val(slipdetail.desc_causeofloss);
    // $("#natureofloss").val(slipdetail.natureofloss_id).change();
    // $("#descnatureofloss").val(slipdetail.descnatureofloss);
    // $("#dateofloss").val(dateFormater(slipdetail.date_of_loss));
    // $("#currofloss").val(slipdetail.curr_id_loss).change();
    // $("#desccurrofloss").val(slipdetail.curr_lossdesc);
    // $("#surveyoradjuster").val(slipdetail.adjuster_id).change();
    // $("#descsurveyoradjuster").val(slipdetail.desc_adjuster);
    // $("#nationalresliab").val(slipdetail.nasre_liab);
    // $("#descnationalresliab").val(slipdetail.nasre_liabdesc).trigger("input");

    // $("#cedantshare").val(slipdetail.ced_share).trigger("input");
    // $("#shareonloss").val(slipdetail.nasre_share_loss).trigger("input");
    // $("#totallossamount").val(slipdetail.total_loss_amount).trigger("input");

    // $("#reinsurance_from").val(
    //     dateFormater(slipdetail.slip.reinsurance_period_from)
    // );
    // $("#reinsurance_to").val(
    //     dateFormater(slipdetail.slip.reinsurance_period_to)
    // );
    // console.log(slipdetail.slip.reinsurance_period_from);
    $("#date_of_loss").datepicker({
        startDate: new Date(slipdetail.slip.reinsurance_period_from),
        endDate: new Date(slipdetail.slip.reinsurance_period_to),
    });

    $("#potentialrecoverydecision").val(slipdetail.potential_recovery).change();
    $("#potentialrecovery").val(slipdetail.desc_poten_rec);
    $("#subrogasi").val(slipdetail.estimate_amount_subro).trigger("input");
    $("#estimate_percent_subro").val(slipdetail.estimate_percent_subro);
    $("#kronologi").val(slipdetail.kronologi);
    $("#staffrecomend").val(slipdetail.staff_recomendation);
    $("#assistantmanagerrecomend").val(slipdetail.ass_man_recomen);

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
    $("#ceuser").val(slipdetail.ceuser);
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
        // $('input[name="locationcheck"]').prop("disabled", true);
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
}

$(document).ready(function () {
    if ($("#slipnumberdata").val() == "") {
        $("#postcard").hide();
        $("#addmanualclaim-btn").prop("disabled", true);
        $("#attachmentbtn").prop("disabled", true);
    } else {
        $("#postcard").show();
        $("#cancelall").prop("disabled", true);
        $("#retrievedata").prop("disabled", true);
        $("#cedinginput").prop("disabled", true);
        $("#uyinput").prop("disabled", true);
        $("#insuredinput").prop("disabled", true);
        $("#noinput").prop("disabled", true);
        $("#kocselect").prop("disabled", true);
        $("#cobselect").prop("disabled", true);
        $("#claimbutton").hide();
        $("#slipcomponent").show();
        $("#documentstatus").show();
        var slipdetail = JSON.parse($("#claimdata").val());
        currency = slipdetail.slip.insureddata.currency;
        inputSetter(slipdetail);
        $(`button[name=btn${slipdetail.slip.number}]`).prop("disabled", false);
        // console.log(currency);
        // getslip(true, $("#slipnumberdata").val());
    }
});

$("#slipnumberdata").change(function () {
    if ($(this).val() != "") {
        $("#addmanualclaim-btn").prop("disabled", false);
        $("#attachmentbtn").prop("disabled", false);
        // getslip(false, $(this).val());
    }
});

$(".datepicker").datepicker({
    format: "dd/mm/yyyy",
});
$(".e1").select2({
    width: "100%",
});
$("input.datemask").mask("00/00/0000", {
    placeholder: "dd/mm/yyyy",
    separator: "/",
});

$(".money").mask("#,##0", {
    reverse: true,
    translation: {
        "#": {
            pattern: /\-|\d/,
            recursive: true,
        },
    },
    onChange: function (value, e) {
        e.target.value = value
            .replace(/(?!^)-/g, "")
            .replace(/^,/, "")
            .replace(/^-,/, "-");
    },
});

$("#causeofloss_id").change(function () {
    var desc = $("#desccol" + $(this).val()).val();
    $("#desccauseofloss").val(desc);
});

$("#natureofloss_id").change(function () {
    var desc = $("#descnol" + $(this).val()).val();
    $("#descnatureofloss").val(desc);
});

$("#curr_id_loss").change(function () {
    var desc = $("#desccurr" + $(this).val()).val();
    $("#desccurrofloss").val(desc);
});

$("#surveyor_id").change(function () {
    var desc = $("#descsrv" + $(this).val()).val();
    $("#descsurveyor").val(desc);
});

$("#adjuster_id").change(function () {
    var desc = $("#descadj" + $(this).val()).val();
    $("#descadjuster").val(desc);
});

$("#total_loss_amount").on("input", function () {
    calculateSubrogasi();
    calculateShareLoss();
});
$("#nationalresliab").on("input", function () {
    calculateShareLoss();
});
$("#estimate_percent_subro").on("input", function () {
    calculateSubrogasi();
});

// axios.get("/claimtransaction-data/testing", { data: "ok" }).then((res) => {
//     console.log(res.data);
// });
