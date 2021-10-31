var printselected;
var examiner;
var ast_manager;
var dec_manager;
var gen_manager;
var dec_board;
var examiner;
var doc_type = $("#doc_type").val();
var last_ce;

function romanMonth() {
    var month = new Date().getMonth() + 1;
    var romanres = "";
    var cntr = 0;
    if (month < 4) {
        while (cntr < month) {
            romanres += "I";
            cntr += 1;
        }
    } else if (month == 4) {
        romanres = "IV";
    } else if (month == 5) {
        romanres = "V";
    } else if (month < 9) {
        romanres = "V";
        cntr += 5;
        while (cntr < month) {
            romanres += "I";
            cntr += 1;
        }
    } else if (month == 9) {
        romanres = "IX";
    } else if (month == 10) {
        romanres = "X";
    } else if (month > 10 && month < 13) {
        romanres = "X";
        cntr += 10;
        while (cntr < month) {
            romanres += "I";
            cntr += 1;
        }
    }
    return romanres;
}

async function createNoReffCe() {
    var noreff = [];
    last_ce = await axios
        .get(
            "/claimtransaction-data/" +
                doctype +
                "/lastce/" +
                slipkoc.abbreviation
        )
        .then((res) => res.data);

    noreff.push("CE");
    noreff.push(slipkoc.abbreviation);
    noreff.push(last_ce == 0 ? 1 : last_ce + 1);
    noreff.push(await romanMonth());
    noreff.push(new Date().getFullYear());

    $("#noreffce").val(noreff.join("/"));
}

async function downloadreportce() {
    var _rc = $("#regcomp").val();
    var _dc = $("#doccounter").val();
    var _stt =
        $("#statusflag").val() == 1
            ? "PLA"
            : $("#statusflag").val() == 2
            ? "INTERIM"
            : "DLA";
    var _fname = `${_rc}-${_dc}-${_stt}.pdf`;
    var win = window.open(
        "/claimtransaction-data/reportcepdf/" + _rc + "/" + _dc,
        "_blank"
    );
    if (win) {
        win.focus();
    } else {
        swal("Error", "Please allow popups for this website", "error");
    }

    if (false)
        await axios
            .get("/claimtransaction-data/reportcepdf/" + _rc + "/" + _dc, {
                responseType: "blob",
            })
            .then((res) => {
                const url = window.URL.createObjectURL(new Blob([res.data]));
                const link = document.createElement("a");
                console.log(url);
                link.href = url;
                link.setAttribute("download", _fname);
                document.body.appendChild(link);
                link.click();
            });
}

$(`select[name="printdocument"]`).change(function () {
    printselected = $(this).val();
    if (printselected != "") {
        $("#buttonprintdocument").show();
    } else {
        $("#buttonprintdocument").hide();
    }
});

$("#buttonprintdocument").click(async function () {
    $("#buttonprintdocument").removeAttr("data-toggle");
    if (printselected == 1) {
        // Hardcopy
        var _rc = $("#regcomp").val();
        var _dc = $("#doccounter").val();
        var _stt =
            $("#statusflag").val() == 1
                ? "PLA"
                : $("#statusflag").val() == 2
                ? "INTERIM"
                : "DLA";
        var _fname = `${_rc}-${_dc}-${_stt}.pdf`;
        $("body").addClass("loading");
        var win = window.open(
            "/claimtransaction-data/hardcopypdf/" + _rc + "/" + _dc,
            "_blank"
        );
        if (win) {
            win.focus();
        } else {
            swal("Error", "Please allow popups for this website", "error");
        }
        if (false)
            await axios
                .get("/claimtransaction-data/hardcopypdf/" + _rc + "/" + _dc, {
                    responseType: "blob",
                })
                .then((res) => {
                    const url = window.URL.createObjectURL(
                        new Blob([res.data])
                    );
                    const link = document.createElement("a");
                    console.log(url);
                    link.href = url;
                    link.setAttribute("download", "HARDCOPY.PDF");
                    document.body.appendChild(link);
                    link.click();
                });
        $("body").removeClass("loading");
    } else if (printselected == 2) {
        // CE REPORT
        $("#buttonprintdocument").attr("data-toggle", "modal");
        $($("#buttonprintdocument").data("target")).show();
        $("#regcompce").val($("#regcomp").val());
        $("#doccounterce").val($("#doccounter").val());
        $("#printdatece").datepicker("update", new Date());
        if ($("#noreffce").val() == "") await createNoReffCe();
    } else if (printselected == 3) {
        // Recommendation Letter
    } else if (printselected == 4) {
        // Confirmation Letter
    }
});

$("#noreffcebutton").click(async function () {
    await createNoReffCe();
});

$("#printcebtn").click(async function () {
    if ($("#accretro").val() != "" && $("#noreffce").val() != "") {
        var ce_counter = (parseInt(last_ce) ?? 1) + 1;
        var _data = {
            ce_counter: ce_counter,
            examiner: $("#examinerce").val(),
            ast_manager: $("#ast_managerce").val(),
            dec_manager: $("#dec_managerce").val(),
            gen_manager: $("#gen_managerce").val(),
            dec_board: $("#dec_boardce").val(),
            cereffno: $("#noreffce").val(),
            dateprintce: $("#printdatece").val(),
            acc_retro: $("#accretro").val(),
        };
        var claimid = $("#mainclaimid").val();
        $("body").addClass("loading");
        if (savece) {
            await axios
                .post(
                    "/claimtransaction-data/" + doctype + "/storece/" + claimid,
                    _data
                )
                .then((res) => console.log(res.data));
            $("#examinerce").prop("disabled", true);
            $("#ast_managerce").prop("disabled", true);
            $("#dec_managerce").prop("disabled", true);
            $("#gen_managerce").prop("disabled", true);
            $("#dec_boardce").prop("disabled", true);
            $("#noreffce").prop("disabled", true);
            $("#printdatece").prop("disabled", true);
            $("#noreffcebutton").prop("disabled", true);
            $("#accretro").prop("disabled", true);
        }
        await downloadreportce();
        $("#createce").modal("toggle");
        $("#cereffno").val($("#noreffce").val());
        $("body").removeClass("loading");
        if (savece) swal("CE Created!", "Success!", "success");
    }
});
