$(`select[name="documentstatus"]`).change(function () {
    var _val = $(this).val();
    var _counter = $(this)[0].id.slice(-1);
    console.log(_counter, _val);
    if (_val != "") {
        $("#buttondocumentstatus" + _counter).show();
    } else {
        $("#buttondocumentstatus" + _counter).hide();
    }
});

$(function () {
    "use strict";

    $("#felookupTable2").DataTable({
        paging: false,
        order: [
            [8, "desc"],
            [0, "desc"],
            [2, "desc"],
        ],
        dom: '<"top"fB>rt<"bottom"lip><"clear">',
        lengthMenu: [
            [10, 25, 50, 100, -1],
            ["10 rows", "25 rows", "50 rows", "100 rows", "Show all"],
        ],
    });
});

function confirmDelete(id) {
    let choice = confirm(
        "{{ __('Are you sure, you want to delete this Claim related data?') }}"
    );
    if (choice) {
        document.getElementById("delete-claim-" + id).submit();
    }
}

function changeStatus(cntr) {
    var _regcomp = $("#regcomp" + cntr).val();
    var _doccounter = $("#counter" + cntr).val();
    var _val = parseInt($("#documentstatus" + cntr).val());
    var _statusdesc = "";
    switch (_val) {
        case 1:
            _statusdesc =
                "Your current document status will be change to Interim";
            break;
        case 2:
            _statusdesc = "Your current document status will be change to DLA";
    }
    swal({
        type: "warning",
        title: "Are you sure?",
        text: _statusdesc,
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, change the status!",
    }).then(async (result) => {
        if (result.value === true) {
            $("body").addClass("loading");
            if (_val == 1) {
                axios
                    .get(
                        "/claimtransaction-data/changeinterimclaim/" +
                            _regcomp +
                            "/" +
                            _doccounter
                    )
                    .then((res) => {
                        $("body").removeClass("loading");
                        location =
                            "/claimtransaction-data/update/" + res.data.id;
                    });
            } else {
                axios
                    .get(
                        "/claimtransaction-data/changeplaclaim/" +
                            _regcomp +
                            "/" +
                            _doccounter
                    )
                    .then((res) => {
                        $("body").removeClass("loading");
                        location =
                            "/claimtransaction-data/update/" + res.data.id;
                    });
            }
        }
    });
}
