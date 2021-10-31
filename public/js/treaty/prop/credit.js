$("#tenor, #usia").on("input", function () {
    var tenor = $("#tenor").val();
    var usia = $("#usia").val();
    if (tenor != "" && usia != "") {
        $("#tenor_usia").val(parseInt(tenor) + parseInt(usia));
    } else {
        $("#tenor_usia").val(0);
    }
});

//#region structure limit
// var structure_limit_list = [];
function delete_structure_limit(id) {
    $("#structure_limit_row" + id).remove();
}

$(
    "#structure_limit_ban_limit, #structure_limit_net_or, #structure_limit_nasionalre_share_first, #structure_limit_nasionalre_share_second"
).on("input", function () {
    var slbl = $("#structure_limit_ban_limit").val();
    var slno = $("#structure_limit_net_or").val();
    var slnsf = $("#structure_limit_nasionalre_share_first").val();
    var slnss = $("#structure_limit_nasionalre_share_second").val();

    if (slbl != "" && slno != "" && slnsf != "" && slnss != "") {
        $("#add_structure_limit").prop("disabled", false);
    } else {
        $("#add_structure_limit").prop("disabled", true);
    }
});

$("#add_structure_limit").click(function (e) {
    e.preventDefault();
    var slbl = $("#structure_limit_ban_limit").val();
    var slno = $("#structure_limit_net_or").val();
    var slnsf = $("#structure_limit_nasionalre_share_first").val();
    var slnss = $("#structure_limit_nasionalre_share_second").val();
    var no_data = $("#tbody_structure_limit tr").length + 1;

    // structure_limit_list.push({
    //     id_sub_detail_contract: isdc,
    //     r_i_comm: ric,
    //     loss_ratio_first: lrf,
    //     loss_ratio_second: lrs,
    // });

    $("#tbody_structure_limit").append(
        `
        <tr id="structure_limit_row${no_data}">
            <input type="hidden" value="0" name="sl_ids[]">
            <input type="hidden" value="${slbl}" name="sl_ban_limit[]" />
            <input type="hidden" value="${slno}" name="sl_net_or[]" />
            <input type="hidden" value="${slnsf}" name="sl_nasionalre_first[]" />
            <input type="hidden" value="${slnss}" name="sl_nasionalre_second[]" />
            <td>${slbl}</td>
            <td>${slno}</td>
            <td>${slnsf} - ${slnss}</td>
            <td>
                <button class="btn" onclick="delete_structure_limit(${no_data})">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-trash"
                    viewBox="0 0 16 16">
                    <path
                        d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                    <path fill-rule="evenodd"
                        d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                    </svg>
                </button>
            </td>
        </tr>
        `
    );

    $("#structure_limit_ban_limit").val("");
    $("#structure_limit_net_or").val("");
    $("#structure_limit_nasionalre_share_first").val("");
    $("#structure_limit_nasionalre_share_second").val("");
    $("#add_structure_limit").prop("disabled", true);
});
//#region structure limit

//#region bank
function delete_bank(id) {
    var child = $("#bank_row" + id)
        .closest("tr")
        .nextAll();
    child.each(function () {
        var idx = $(this).children("td")[0];
        idx.innerHTML = parseFloat(idx.innerHTML) - 1;
    });
    $("#bank_row" + id).remove();
}

$("#bank").on("input", function () {
    var bank = $("#bank").val();

    if (bank != "") {
        $("#add_bank").prop("disabled", false);
    } else {
        $("#add_bank").prop("disabled", true);
    }
});

$("#add_bank").click(function (e) {
    e.preventDefault();
    var bank = $("#bank").val();
    var no_data = $("#tbody_bank tr").length + 1;

    $("#tbody_bank").append(
        `
        <tr id="bank_row${no_data}">
            <input type="hidden" value="0" name="bank_ids[]">
            <input type="hidden" value="${bank}" name="banks[]" />
            <td>${no_data}</td>
            <td>${$("#bank option:selected").text()}</td>
            <td>
                <button class="btn" onclick="delete_bank(${no_data})">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-trash"
                    viewBox="0 0 16 16">
                    <path
                        d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                    <path fill-rule="evenodd"
                        d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                    </svg>
                </button>
            </td>
        </tr>
        `
    );

    $("#bank").val("").change();
    $("#add_bank").prop("disabled", true);
});
//#region bank
