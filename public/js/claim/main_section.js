// VARIABLES
var money_regex = /\B(?=(\d{3})+(?!\d))/g;
var testing = 10000000000000;
var desc_loss_datas = [];
var desc_loss_datas_corr = [];
var selectedstatus;
var changedocument = {};
var slip_data = {};
var reg_comp_counter;
var currency;
var new_regcomp;
var doctype = $("#doc_type").val();
var slipkoc;
var slipcob;
var savece = true;
var disableinput = false;
console.log(doctype);

// FUNCTIONS
function toMoneyFormat(val) {
    return val.toString().replace(money_regex, ",");
}

function calculateShareLoss() {
    var shareslip = parseInt($("#nationalresliab").val()) / 100;
    var tsi = $("#totallossamount").val();
    var conv_tsi = parseInt(tsi.replace(/,/g, ""));
    var sumshare = isNaN(shareslip * conv_tsi) ? 0 : shareslip * conv_tsi; //.toFixed(0);
    var real_sumshare = parseInt(sumshare)
        .toString()
        .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    $("#shareonloss").val(real_sumshare).trigger("input");
}

async function createRegComp() {
    var _year = slip_data.year.toString().slice(-2);
    var _koc = slip_data.koc.substring(0, 2);
    var _cob = slip_data.cob;
    while (_cob.length < 4) _cob = _cob + "B";
    var _month = slip_data.month + 1;
    if (_month <= 9) {
        _month = "0" + _month;
    }
    var _reg_comp = "C" + _koc + _cob + _year + _month;
    var _counter = await axios
        .get(
            "/claimtransaction-data/" +
                doctype +
                "/getlatestregcount/" +
                _reg_comp
        )
        .then((res) =>
            res.data != 0 ? (parseInt(res.data) + 1).toString() : "1"
        );
    reg_comp_counter = _counter;
    while (_counter.length < 4) _counter = "0" + _counter;
    var _reg_comp = "C" + _koc + _cob + _year + _month + _counter;
    return _reg_comp;
}

function calculateSubrogasi() {
    var _subper = parseInt($("#subrogasipersen").val()) / 100;
    var _ttla = parseInt($("#totallossamount").val().replace(/,/g, ""));
    var _res = isNaN(_ttla * _subper) ? 0 : parseInt(_ttla * _subper);
    $("#subrogasi").val(_res).trigger("input");
}

async function setCounterandStatus(
    regcomp,
    old_doccounter,
    new_doccounter,
    selectedstatus = 0,
    statusdoc = null,
    getlastdoc = false
) {
    if (new_doccounter != 1)
        changedocument?.regcomp
            ? $("#regcomp").val(changedocument?.regcomp)
            : "";
    changedocument?.old_doccounter
        ? $("#doccounter").val(changedocument?.old_doccounter)
        : "";
    changedocument?.old_docstatus
        ? $("#statusdocument").val(changedocument?.old_docstatus)
        : "";

    changedocument.regcomp = regcomp ? regcomp : changedocument.regcomp;
    changedocument.active = true;
    changedocument.old_doccounter = old_doccounter;
    changedocument.old_docstatus = $("#statusdocument").val();

    if (selectedstatus != 0) changedocument.selectedstatus = selectedstatus;

    if (getlastdoc)
        new_doccounter = await axios
            .get(
                "/claimtransaction-data/" +
                    doctype +
                    "/getlatestdoccount/" +
                    changedocument.regcomp
            )
            .then((res) =>
                res.data != 0 ? (parseInt(res.data) + 1).toString() : "1"
            );

    $("#doccounter").val(new_doccounter);
    if (statusdoc) $("#statusdocument").val(statusdoc);
}

$(document).ready(function () {
    if ($("#slipnumberdata").val() == "") {
        $("#postcard").hide();
        $("#addmanualclaim-btn").prop("disabled", true);
        $("#attachmentbtn").prop("disabled", true);
    } else {
        $("#postcard").show();
        getslip(true, $("#slipnumberdata").val());
    }
});

$("#slipnumberdata").change(function () {
    if ($(this).val() != "") {
        $("#addmanualclaim-btn").prop("disabled", false);
        $("#attachmentbtn").prop("disabled", false);
        getslip(false, $(this).val());
    }
});

$("#claimbutton").click(function () {
    resetColumnClaim();
    desc_loss_datas = [];
    var _val = $("#selectedslip").val();
    $("#postcard").show();
    $("#slipnumberdata").val(_val).change();
    $("#docnumber").val(_val).change();
    var _loc = $("#loc_code_hidden").val();
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

    $("#dateofloss").datepicker(
        "setStartDate",
        slip_data.reinsurance_from.split("-").reverse().join("-")
    );
    $("#dateofloss").datepicker(
        "setEndDate",
        slip_data.reinsurance_to.split("-").reverse().join("-")
    );

    $("#cob").val(slip_data.cob + " - " + slip_data.cobname);
    $("#koc").val(slip_data.koc + " - " + slip_data.kocname);

    $("#nationalresliab").val(share);
    $("#descnationalresliab")
        .val((parseFloat(share) * parseFloat(amount)) / 100)
        .trigger("input");
});

$("#totallossamount").on("input", function () {
    calculateSubrogasi();
    calculateShareLoss();
});

$("#nationalresliab").on("input", function () {
    calculateShareLoss();
});
$("#subrogasipersen").on("input", function () {
    if (parseFloat(this.value) <= 100) {
        calculateSubrogasi();
    } else {
        this.value = 100;
    }
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

$("#adjuster").change(function () {
    var dataselect = $("#adjuster").val();
    console.log($("#inpadjuster" + dataselect).val());
    $("#descadjuster").val($("#inpadjuster" + dataselect).val());
});

$("#surveyor").change(function () {
    var dataselect = $("#surveyor").val();
    console.log($("#inpsurveyor" + dataselect).val());
    $("#descsurveyor").val($("#inpsurveyor" + dataselect).val());
});

$("#currofloss").change(function () {
    var selectedCurr = $(this).val();
    if (selectedCurr) {
        var desccurrofloss = $("#inpcurrofloss" + selectedCurr).val();
        $("#desccurrofloss").val(desccurrofloss);
    }
});
// axios
//     .get("/claimtransaction-data/getlatestregcount")
//     .then((res) => console.log(res.data));
