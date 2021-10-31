async function interim_dla_hanlder(selectedstatus) {
    var _regcomp = $("#regcomp").val();
    var _doccounter = $("#doccounter").val();
    var _buttontext = selectedstatus == 1 ? "Interim" : "DLA";
    swal({
        type: "warning",
        title: "Are you sure?",
        text: _statusdesc,
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes",
    }).then(async (result) => {
        if (result.value === true) {
            setCounterandStatus(
                _regcomp,
                _doccounter,
                0,
                selectedstatus,
                _buttontext,
                true
            );
            changedocument.isinterimdla = true;

            $("#buttoncancel").show();
            $("#buttoncancel").text("Cancel Create " + _buttontext);
        }
    });
}

$(`select[name="documentstatus"]`).change(function () {
    selectedstatus = $(this).val();
    if (selectedstatus != "") {
        $("#buttondocumentstatus").show();
    } else {
        $("#buttondocumentstatus").hide();
    }
});

var _statusdesc = "";
$("#buttondocumentstatus").click(function () {
    if (disableinput) {
        inputDisabler(false);
    }
    var _status_flag = $("#statusflag").val();
    $("#buttonprintdocument").hide();
    $("#printdocument").hide();
    $("#printdocument").val("");
    console.log(desc_loss_datas);
    switch (parseInt(selectedstatus)) {
        case 1:
            _statusdesc =
                "Your current document status will be change to Interim";
            break;
        case 2:
            _statusdesc = "Your current document status will be change to DLA";
            break;
        case 3:
            _statusdesc = "Correction this document";
            break;
        case 4:
            _statusdesc = "Multi this document";
    }
    if (selectedstatus == 4) {
        // MULTI
        multi_handler(_status_flag);
    } else if (selectedstatus == 3) {
        // CORRECTION
        correction_handler();
    } else {
        // INTERIM OR DLA
        interim_dla_hanlder(selectedstatus);
    }
});

$("#buttoncancel").click(function () {
    changedocument?.regcomp ? $("#regcomp").val(changedocument?.regcomp) : "";
    changedocument?.old_doccounter
        ? $("#doccounter").val(changedocument?.old_doccounter)
        : "";
    changedocument?.old_docstatus
        ? $("#statusdocument").val(changedocument?.old_docstatus)
        : "";
    if (false && changedocument?.iscorrection) {
        desc_loss_datas_corr = {};
        $("#propertyTypePanelAmount #lossdesctbody").empty();
        var cntr = 1;
        _.each(desc_loss_datas, function (desc) {
            $("#propertyTypePanelAmount #lossdesctbody").append(
                '<tr id="iidamountclaim' +
                    desc.id +
                    '" data-name="amounttypevalue[]"><td>' +
                    cntr +
                    '</td><td data-name="' +
                    desc.desc_id +
                    '">' +
                    desc.name +
                    '</td><td data-name="' +
                    desc.val +
                    '">' +
                    desc.curr_val +
                    '</td><td><a href="javascript:void(0)" onclick="deleteamountclaimdetail(' +
                    desc.id +
                    ')">delete</a></td></tr>'
            );
            cntr += 1;
        });
    }
    changedocument = {};
    if (disableinput) {
        inputDisabler(disableinput);
    }
    $("#printdocument").show();
    $("#buttoncancel").hide();
});
