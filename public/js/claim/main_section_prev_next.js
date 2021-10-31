async function getbycounter(prev = false) {
    $("body").addClass("loading");

    var _doccounter = parseInt($("#doccounter").val());
    var _regcomp = $("#regcomp").val();
    var _msg = "";
    if (prev) {
        _doccounter -= 1;
        _msg = "This is the first document";
    } else {
        _doccounter += 1;
        _msg = "This is the last document";
    }

    var _data = await axios
        .post("/claimtransaction-data/" + doctype + "/getclaimbycounter", {
            regcomp: _regcomp,
            doccounter: _doccounter,
        })
        .then((res) => res.data)
        .catch((err) => err);

    if (_data?.claim) {
        var slipdetail = _data?.claim;
        // lossAmount(_data.lossamountlimit, slipdetail.status_flag);
        inputSetter(slipdetail);
        await descriptionLoss(
            slipdetail.reg_comp,
            slipdetail.doc_counter,
            true
        );
    } else if (_data?.error) {
        swal(_data.error, _msg, "warning");
    } else {
        swal("Error", _data.message, "error");
    }
    $("body").removeClass("loading");
}

$("#prevbutton").click(function () {
    getbycounter(true);
});
$("#nextbutton").click(function () {
    getbycounter();
});
