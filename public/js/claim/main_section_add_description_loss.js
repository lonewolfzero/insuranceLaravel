function deleteamountclaimdetail(id, isnew, iscorr = false) {
    if (isnew || changedocument?.active) {
        if (iscorr) {
            desc_loss_datas_corr.splice(
                _.findIndex(desc_loss_datas_corr, ["id", id]),
                1
            );
        }
        desc_loss_datas.splice(_.findIndex(desc_loss_datas, ["id", id]), 1);
        $("#totallossamount")
            .val(_.sumBy(desc_loss_datas, "val"))
            .trigger("input");
        $("#cedantshare").val(_.sumBy(desc_loss_datas, "val")).trigger("input");
        $("#iidamountclaim" + id).remove();
    } else {
        var token2 = $("input[name=_token2]").val();

        $.ajax({
            url:
                "/claimtransaction-data/" +
                doctype +
                "/delete-claimmanual-list/" +
                id,
            type: "DELETE",
            data: {
                _token: token2,
            },
            beforeSend: function () {
                $("body").addClass("loading");
            },
            complete: function () {
                $("body").removeClass("loading");
            },
            success: function (response) {
                var child = $("#iidamountclaim" + id)
                    .closest("tr")
                    .nextAll();
                child.each(function () {
                    var idx = $(this).children("td")[0];
                    idx.innerHTML = parseInt(idx.innerHTML) - 1;
                });
                desc_loss_datas.splice(
                    _.findIndex(desc_loss_datas, ["id", id]),
                    1
                );
                $("#totallossamount")
                    .val(_.sumBy(desc_loss_datas, "val"))
                    .trigger("input");
                $("#cedantshare")
                    .val(_.sumBy(desc_loss_datas, "val"))
                    .trigger("input");
                $("#iidamountclaim" + id).remove();
            },
        });
    }
}

function append_description_loss(
    amount,
    id,
    desc_id,
    desc_name,
    isnew = false,
    iscorr = false
) {
    var curr_amount = toMoneyFormat(amount);
    no_data = $("#propertyTypePanelAmount #lossdesctbody tr").length + 1;
    $("#propertyTypePanelAmount #lossdesctbody").append(
        `<tr id="iidamountclaim${id}" data-name="amounttypevalue[]">
            <td>
                ${no_data}
            </td>
            <td data-name="${desc_id}">
                ${desc_name}
            </td>
            <td data-name="${amount}">
                ${curr_amount}
            </td>
            <td>
                <a href="javascript:void(0)" onclick="deleteamountclaimdetail(${id}, ${isnew}, ${iscorr})">delete</a>
            </td>
        </tr>`
    );

    if (iscorr) {
        desc_loss_datas_corr.push({
            id: id,
            desc_id: desc_id,
            val: amount,
        });
    }

    desc_loss_datas.push({
        id: id,
        desc_id: desc_id,
        val: amount,
    });
    console.log(desc_loss_datas);
    console.log(desc_loss_datas_corr);
    $("#totallossamount").val(_.sumBy(desc_loss_datas, "val")).trigger("input");
    $("#cedantshare").val(_.sumBy(desc_loss_datas, "val")).trigger("input");

    $("#descripitontableselect").val("").change();
    $("#amounttablemanual").val("");
}

$("#addmanualclaim-btn").click(async function (e) {
    e.preventDefault();

    var reg_comp = $("#regcomp").val();
    var doc_counter = $("#doccounter").val();
    var selected = $("#descripitontableselect").val();
    var amountmanual = $("#amounttablemanual").val();
    amountmanual = parseInt(amountmanual.replace(/,/g, ""));

    if (selected != null && amountmanual != "" && amountmanual != 0) {
        var description_id = selected;

        var factor = parseInt($("#desclossfactor" + description_id).val());
        if (changedocument?.active || reg_comp == "") {
            var amount = amountmanual;

            amount *= factor;

            append_description_loss(
                amount,
                $("#propertyTypePanelAmount #lossdesctbody tr").length,
                description_id,
                $("#desclossname" + description_id).val(),
                true,
                changedocument?.active ? true : false
            );
        } else {
            var amount = amountmanual;

            amount *= factor;
            $("body").addClass("loading");
            var response = await axios
                .post(
                    "/claimtransaction-data/" +
                        doctype +
                        "/store-claimmanual-list",
                    {
                        reg_comp: reg_comp,
                        description_id: description_id,
                        amountmanual: amount,
                        doc_counter: doc_counter,
                    }
                )
                .then((res) => res.data)
                .catch((err) => err);

            await axios
                .get(
                    "/claimtransaction-data/" +
                        doctype +
                        "/updatetotalloss/" +
                        reg_comp +
                        "/" +
                        doc_counter
                )
                .then((res) => res.data)
                .catch((err) => console.error(err.message));

            if (response.data) {
                var _data = response.data;
                var amount = parseFloat(_data.amount);
                append_description_loss(
                    amount,
                    _data.id,
                    _data.description_id,
                    _data.desc_loss.desc_name
                );
            } else {
                console.log(response);
            }
            $("body").removeClass("loading");
        }
    }
});
