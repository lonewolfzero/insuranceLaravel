function correction_handler() {
    var _regcomp = $("#regcomp").val();
    var _doccounter = $("#doccounter").val();
    swal({
        type: "warning",
        title: "Are you sure to do correction?",
        text: "Your current document will be corrected",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, do correction!",
    }).then(async (result) => {
        if (result.value === true) {
            setCounterandStatus(_regcomp, _doccounter, 0, 0, null, true);
            changedocument.iscorrection = true;
            // changedocument.old_doccounter = _doccounter
            var _counter = await axios
                .get(
                    "/claimtransaction-data/" +
                        doctype +
                        "/getlatestdoccount/" +
                        _regcomp
                )
                .then((res) =>
                    res.data != 0 ? (parseInt(res.data) + 2).toString() : "1"
                );

            $("#doccounter").val(_counter);

            $("#buttoncancel").text("Cancel Correction");
            $("#buttoncancel").show();
            console.log(desc_loss_datas);
            console.log(desc_loss_datas_corr);
            // $("#propertyTypePanelAmount #lossdesctbody").empty();
        }
    });
}
