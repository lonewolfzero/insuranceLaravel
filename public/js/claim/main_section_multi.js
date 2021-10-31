async function requestmulti(data) {
    $("body").addClass("loading");
    // var _newregcomp = await createRegComp();
    // var _doccounter = $("#doccounter").val();
    await axios
        .post("/claimtransaction-data/" + doctype + "/multidocument", data)
        .then(async (res) => {
            if (res.data.status == 404) {
                swal("Warning", "No Document Found!", "warning");
            } else if (res.data.status == 200) {
                await storeDescriptionLoss(
                    res.data.reg_comp,
                    res.data.doc_counter,
                    true
                );
                swal(
                    "Success!",
                    "Your document has been multi.",
                    "success"
                ).then(
                    () =>
                        (location =
                            "/claimtransaction-data/" +
                            doctype +
                            "/update/" +
                            res.data.id_base)
                );
            } else {
                swal("Error", "error!", "error");
            }
        });
    $("body").removeClass("loading");
}

async function multicancel(statusflag = 0) {
    var _regcomp = $("#regcomp").val();
    var _doccounter = $("#doccounter").val();
    swal({
        type: "warning",
        title: "Are you sure to multi this document?",
        // text: "This PLA document status will change to Decline!",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes",
    }).then(async (result) => {
        if (result.value === true) {
            setCounterandStatus(_regcomp, _doccounter, 1, 0, "PLA", false);

            changedocument.ismulti = true;
            if (statusflag == 1) changedocument.iscancel = true;
            changedocument.old_regcomp = _regcomp;

            $("#regcomp").val("");
            $("#buttoncancel").show();
            $("#buttoncancel").text("Cancel Create Multi");
        }
    });
}

async function multi_handler(statusflag) {
    var lastdoccounter = await axios
        .get(
            "/claimtransaction-data/" +
                doctype +
                "/getlatestdoccount/" +
                $("#regcomp").val()
        )
        .then((res) => res.data);
    if (statusflag == 1 && lastdoccounter == 1) {
        swal({
            type: "warning",
            title: "Are you sure?",
            html:
                "<p>" +
                _statusdesc +
                "</p>" +
                '<label for="swal-input1" style="font-size: 100%; margin-right:10px;">also cancel this pla document</label>' +
                '<input type="checkbox" id="swal-input1" name="swal-input1" value="1" style="transform: scale(2);">',
            showCancelButton: true,
            cancelButtonColor: "#d33",
            confirmButtonText: "yes",
        }).then(async (res) => {
            if (res.value === true) {
                $("#buttoncancel").show();
                $("#buttoncancel").text("Cancel Create Multi");
                if ($("#swal-input1:checked").val()) {
                    changedocument.statusflag = statusflag;
                    multicancel(statusflag);
                } else {
                    var _regcomp = $("#regcomp").val();
                    var _doccounter = $("#doccounter").val();
                    setCounterandStatus(
                        _regcomp,
                        _doccounter,
                        1,
                        0,
                        "PLA",
                        false
                    );

                    changedocument.ismulti = true;
                    changedocument.iscancel = false;
                    changedocument.old_regcomp = _regcomp;

                    $("#regcomp").val("");
                    $("#buttoncancel").show();
                    $("#buttoncancel").text("Cancel Create Multi");
                }
            }
        });
    } else {
        multicancel();
    }
}
