// VARIABLES
var insuredfiltered = [];
var slip_data = {};
var doctype = $("#doc_type").val();

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
    $("#dateofreceipt").val("");
    $("#dateofdocument").val("");
    $("#causeofloss").val("").change();
    $("#desccauseofloss").val("");
    $("#natureofloss").val("").change();
    $("#descnatureofloss").val("");
    $("#dateofloss").val("");
    $("#currofloss").val("").change();
    $("#desccurrofloss").val("");
    $("#adjuster").val("").change();
    $("#descadjuster").val("");
    $("#surveyor").val("").change();
    $("#descsurveyor").val("");
    $("#nationalresliab").val("");
    $("#descnationalresliab").val("");
    $("#cedantshare").val("");
    $("#shareonloss").val("");
    $("#totallossamount").val("");
    $("#potentialrecoverydecision").val("").change();
    $("#potentialrecovery").val("");
    $("#subrogasipersen").val("");
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

function selectAll(cb) {
    $(`input[name="interestinsured${cb.value}${cb.id.slice(-1)}"]`).attr(
        "checked",
        cb.checked
    );
}

// CAN'T SEARCH IF SLIP NUMBER ALREADY EXIST
$(document).ready(function () {
    if ($("#slipnumberdata").val() !== "") {
        $("#claim_filter_div").hide();
        $("#cancelall").prop("disabled", true);
        $("#retrievedata").prop("disabled", true);
        $("#cedinginput").prop("disabled", true);
        $("#uyinput").prop("disabled", true);
        $("#insuredinput").prop("disabled", true);
        $("#noinput").prop("disabled", true);
        $("#kocselect").prop("disabled", true);
        $("#cobselect").prop("disabled", true);
    }
});

// KOC SELECT
$("#kocselect").change(function () {
    var id_koc = $(this).val();
    var desc_koc = $("#inpkoc" + id_koc).val();
    $("#kocdesc").val(desc_koc);
    // console.log("work koc", desc_koc);
});

// COB SELECT
$("#cobselect").change(function () {
    var id_cob = $(this).val();
    var desc_cob = $("#inpcob" + id_cob).val();
    $("#cobdesc").val(desc_cob);
    // console.log("work cob", desc_cob);
});

// CANCEL ALL
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
        }
    });
});
