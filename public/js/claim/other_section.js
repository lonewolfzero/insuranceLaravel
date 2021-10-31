var doc_type = $("#doc_type").val();

async function deleteviewattach(id) {
    $("body").addClass("loading");
    await axios
        .delete("/claimtransaction-data/" + doctype + "/viewattch/" + id)
        .then((res) => {
            var child = $("#trviewattach" + id)
                .closest("tr")
                .nextAll();
            child.each(function () {
                var idx = $(this).children("td")[0];
                idx.innerHTML = parseInt(idx.innerHTML) - 1;
            });
            $("#trviewattach" + id).remove();
            $("body").removeClass("loading");
        });
}

$("#status_ce").on("input", function () {
    swal({
        type: "warning",
        title: "Are you sure to change CE status?",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes",
    }).then(async (result) => {
        if (result.value === true) {
            var _sce = $(this).val();
            if (_sce) {
                var _textremarks = "Remarks";
                var ceno = [];
                if (_sce == "DC" || _sce == "CC") {
                    _textremarks = "Mandatory";
                }
                ceno.push(_sce);
                console.log(slipcob, slipkoc);
                var cob = slipcob.code;
                var koc = slipkoc.code;
                var lastcestatus = await axios
                    .get(
                        "/claimtransaction-data/" +
                            doctype +
                            "/lastcestatus/" +
                            ceno[0]
                    )
                    .then((res) => res.data);

                var _counter = "" + (lastcestatus + 1).toString();
                while (_counter.length < 4) _counter = "0" + _counter;
                var _mnth = new Date().getMonth() + 1;
                _mnth = _mnth.toString().length < 2 ? "0" + _mnth : _mnth;
                ceno.push(koc.substring(0, 2));
                ceno.push(cob.substring(0, 2));
                ceno.push(new Date().getFullYear().toString().slice(-2));
                ceno.push(_mnth);
                ceno.push(_counter);

                var resceno = ceno.join("");
                $("#remarks").text(_textremarks);

                var claimid = $("#mainclaimid").val();

                var _data = {
                    ceno: resceno,
                    status_ce: ceno[0],
                    ce_status_counter: lastcestatus + 1,
                };
                var res_data = await axios
                    .post(
                        "/claimtransaction-data/" +
                            doc_type +
                            "/storenoce/" +
                            claimid,
                        _data
                    )
                    .then((res) => res.data);
                console.log(res_data);
                $("#ceno").val(resceno);
                $("#ceuser").val(res_data.user.name);
                $("#dateofprod").val(
                    new Date(Date.now()).toLocaleDateString("en-GB", {
                        year: "numeric",
                        month: "2-digit",
                        day: "2-digit",
                    })
                );
            }
        } else {
            $("#status_ce").val("").change();
        }
    });
});

$("#shareonloss").change(function () {
    _val = $(this).val();
    $("#nrsgrossret").val(toMoneyFormat(_val));
});

$("#attachmentbtn").click(async function (e) {
    e.preventDefault();
    if ($("#attachmenturl").val() != "" && $("#attachmentdesc").val() != "") {
        var _data = {
            reg_comp: $("#regcomp").val(),
            main_claim_id: $("#mainclaimid").val(),
            description: $("#attachmentdesc").val(),
            url: $("#attachmenturl").val(),
        };
        $("body").addClass("loading");
        var resviewattach = await axios
            .post("/claimtransaction-data/" + doctype + "/viewattch", _data)
            .then((res) => res.data);

        var no_view_attach =
            $("#tableattachment #attachmenttbody tr").length + 1;

        $("#attachmenttbody").append(
            `<tr id="trviewattach${resviewattach.id}">
            <td>${no_view_attach}</td>
            <td>${resviewattach.description}</td>
            <td>${resviewattach.url}</td>
            <td>
                <a href="javascript:void(0)" type="button" role="button" onclick="deleteviewattach(${resviewattach.id})">delete</a>
            </td>
        </tr>`
        );

        $("#attachmenturl").val("");
        $("#attachmentdesc").val("");

        $("body").removeClass("loading");
        // swal({
        //     toast: true,
        //     position: "top-end",
        //     icon: "success",
        //     title: "Success added view attach",
        //     showConfirmButton: false,
        //     timer: 1500,
        //     timerProgressBar: true,
        // });
    }
});
