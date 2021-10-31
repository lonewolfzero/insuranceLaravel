function breadRemove(bread, ishide = false) {
    $(bread).toggleClass(" active", "");
    $(bread + " a").removeAttr("aria-current");
    if (ishide) $(bread).hide();
}

function breadActive(bread, isshow = true) {
    $(bread).addClass(" active");
    $(bread + " a").attr("aria-current", "page");
    if (isshow) $(bread).show();
}

function backToMainContract() {
    window.scrollTo({ top: 0, left: 0, behavior: "smooth" });
    $("#main_contract").show();
    $("#layer").hide();
    $("#panel_retro").hide();
    $("#adjusment").hide();
    breadRemove("#bread-D", true);
    breadRemove("#bread-C", true);
    breadRemove("#bread-B", true);
    breadActive("#bread-A");
}

function backToLayer() {
    window.scrollTo({ top: 0, left: 0, behavior: "smooth" });
    $("#layer").show();
    $("#panel_retro").hide();
    $("#adjusment").hide();
    breadRemove("#bread-D", true);
    breadRemove("#bread-C", true);
    breadActive("#bread-B");
}

async function update_disabled_main_contract(id) {
    await axios.get("/retro/mindep/maincontract/" + id).then((res) => {
        var mc = res.data;
        $(".disabled_user_entry").val(mc.getuser.name);
        $(".disabled_date_entry").val(dateFormat(mc.date_entry));
        $(".disabled_main_contract").val(mc.main_contract);
        $(".disabled_u_w_year").val(mc.u_w_year);
        $(".disabled_cob").val(mc.cob).change();
        $(".disabled_contract_description").val(mc.contract_description);
        $(".disabled_egnpi").val(mc.egnpi);
        $(".disabled_currency").val(mc.currency).change();
        $(".disabled_period_from").val(dateFormat(mc.period_from));
        $(".disabled_period_to").val(dateFormat(mc.period_to));
        $(".disabled_roe").val(mc.roe);
    });
}

function update_disabled_layer(layer) {
    $(".disabled_id_layer").val(layer.id_layer);
    $(".disabled_our_contract").val(layer.our_contract);
    $(".disabled_kind_of_treaty").val(layer.kind_of_treaty);
    $(".disabled_type_coverage").val(layer.type_coverage);
    $(".disabled_mindep_100").val(layer.mindep_100);
    $(".disabled_share").val(layer.share);
    $(".disabled_mindep_retro").val(layer.mindep_retro);
    $(".disabled_withholding_tax").val(layer.withholding_tax);
    $(".disabled_limit_loss").val(layer.limit_loss);
    $(".disabled_deductible").val(layer.deductible);
    $(".disabled_aggregate").val(layer.aggregate);
    $(".disabled_adj_rate").val(layer.adj_rate);
}

//region spreading COB
function appendSpreading(spread) {
    $("#tbody_spreading_cob").append(
        `
        <tr>
            <td>
                ${spread.getcob.code} 
                - ${spread.getcob.description}
            </td>
            <td>${parseFloat(spread.percentage)}%</td>
            <td>${spread.type}</td>
            <td>${spread.koc}</td>
        </tr>
        `
    );
}

async function update_spreading_id(id) {
    await axios.get("/retro/mindep/spreadingcob/" + id).then((res) => {
        var counter = res.data.length;
        $("#tbody_spreading_cob tr").remove();
        if (counter > 0) {
            _.each(res.data, function (sp) {
                appendSpreading(sp);
            });
        }
        counter += 1;
        while (counter.toString().length < 3) counter = "0" + counter;
        var spread_id = "SPR/MC" + id + "/" + counter;
        $("#id_spreading_cob").val(spread_id);
    });
}

async function addSpreading(id) {
    $("body").addClass("loading");
    await update_spreading_id(id);
    $("#spreading_modal").modal("toggle");
    $(".main_contract_id").val(id);
    $("body").removeClass("loading");
}

async function create_spreading_cob(data) {
    var _data = {
        main_contract_id: data.main_contract_id.value,
        id_spreading_cob: data.id_spreading_cob.value,
        detail_cob: data.detail_cob.value,
        percentage: data.percentage.value,
        type: data.type.value,
        koc: data.koc.value,
    };
    $("body").addClass("loading");
    await axios
        .post("/retro/mindep/spreadingcob/store", _data)
        .then(async (res) => {
            var sp = res.data;
            appendSpreading(sp);

            $("#form_spreading")[0].reset();
            $("#detail_cob").val("").change();
            await update_spreading_id($(".main_contract_id").val());
            $("body").removeClass("loading");
            toastr.success("Spreading COB Created!");
        });
}
//end of region spreading COB

//region Layer
function appendLayer(l) {
    $("#tbody_layer").append(
        `
        <tr>
            <td>${l.id_layer}</td>
            <td>${l.our_contract}</td>
            <td>${l.kind_of_treaty}</td>
            <td>${l.getcoverage.description}</td>
            <td>${moneyFormat(l.mindep_100)}</td>
            <td>${moneyFormat(l.share)}%</td>
            <td>${moneyFormat(l.mindep_retro)}</td>
            <td>${moneyFormat(l.withholding_tax)}</td>
            <td>${moneyFormat(l.limit_loss)}</td>
            <td>${moneyFormat(l.deductible)}</td>
            <td>${moneyFormat(l.aggregate)}</td>
            <td>${moneyFormat(l.adj_rate)}</td>
            <td>
                <div class="dropdown">
                    <a class="btn btn-primary dropdown-toggle" href="#" role="button" 
                        id="dropdownMenuLink${l.id}" 
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Add
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" 
                        aria-labelledby="dropdownMenuLink${l.id}">
                        <button class="dropdown-item dropdown-menu-right" type="button" 
                            onclick="addInstallment(${l.id})">
                            Installment
                        </button>
                        <button class="dropdown-item" type="button" 
                            onclick="addPanelRetro(${l.id})">
                            Panel Retro
                        </button>
                        <button class="dropdown-item" type="button" 
                            onclick="addDetailLayer(${l.id})">
                            Detail Layer
                        </button>
                        <button class="dropdown-item" type="button"
                            onclick="addAdjusment(${l.id})">
                            Adjusment
                        </button>
                    </div>
                </div>
            </td>
        </tr>
        `
    );
}

$("#mindep_100, #share").on("input", function () {
    var min = $("#mindep_100").val();
    var share = $("#share").val();
    if (min != "" && share != "") {
        var res = parseFloat((parseFloat(share) * parseFloat(min)) / 100);
        console.log("🚀 ~ file: entry.js ~ line 201 ~ res", res);
        $("#mindep_retro").val(res).trigger("input");
    }
});

async function update_layer(id) {
    await axios.get("/retro/mindep/layer/" + id).then((res) => {
        var counter = res.data.length;
        $("#tbody_layer tr").remove();
        if (counter > 0)
            _.each(res.data, function (l) {
                appendLayer(l);
            });
    });
}

async function addLayer(id) {
    window.scrollTo({ top: 0, left: 0, behavior: "smooth" });
    $("#main_contract").hide();
    $("#layer").show();
    breadRemove("#bread-A");
    breadActive("#bread-B");
    $(".main_contract_id").val(id);
    $("body").addClass("loading");
    await update_disabled_main_contract(id);
    await update_layer(id);
    $("body").removeClass("loading");
}

async function create_layer(data) {
    var _data = {
        main_contract_id: data.main_contract_id.value,
        id_layer: data.id_layer.value,
        our_contract: data.our_contract.value,
        kind_of_treaty: data.kind_of_treaty.value,
        type_coverage: data.type_coverage.value,
        mindep_100: data.mindep_100.value,
        share: data.share.value,
        mindep_retro: data.mindep_retro.value,
        withholding_tax: data.withholding_tax.value,
        limit_loss: data.limit_loss.value,
        deductible: data.deductible.value,
        aggregate: data.aggregate.value,
        adj_rate: data.adj_rate.value,
    };
    $("body").addClass("loading");
    await axios.post("/retro/mindep/layer/store", _data).then(async (res) => {
        var l = res.data;
        appendLayer(l);
        $("#form_layer")[0].reset();
        $("#type_coverage").val("").change();
        $("body").removeClass("loading");
        toastr.success("Layer Created!");
    });
}
//end of region Layer

//region installment
function appendInstallment(pr) {
    $("#tbody_installment").append(
        `
        <tr>
            <td>${dateFormat(pr.date)}</td>
            <td>${moneyFormat(pr.percentage)}%</td>
        </tr>
        `
    );
}

async function update_installment_id(id) {
    await axios.get("/retro/mindep/installment/" + id).then((res) => {
        $("#tbody_installment tr").remove();
        if (res.data.length > 0)
            _.each(res.data, function (data) {
                appendInstallment(data);
            });
    });
}

async function addInstallment(id) {
    $("#installment_modal").modal("toggle");
    $(".layer_id").val(id);

    $("body").addClass("loading");

    var layer = await axios
        .get("/retro/mindep/layer/show/" + id)
        .then((res) => res.data);
    update_disabled_layer(layer);
    await update_installment_id(id);

    $("body").removeClass("loading");
}

async function create_installment(data) {
    var _data = {
        layer_id: data.layer_id.value,
        date: data.date.value,
        percentage: data.percentage.value,
    };
    $("body").addClass("loading");
    await axios
        .post("/retro/mindep/installment/store", _data)
        .then(async (res) => {
            appendInstallment(res.data);
            $("#form_installment")[0].reset();
            $("body").removeClass("loading");
            toastr.success("Installment Created!");
        });
}
//end of region installment

//region detail layer
function appendDetailLayer(data) {
    $("#tbody_detail_layer").append(
        `
        <tr>
            <td>
                ${data.getcob.code} -
                ${data.getcob.description}
            </td>
            <td>
                ${data.getmindep.code} -
                ${data.getmindep.description}
            </td>
            <td>${moneyFormat(data.limit_loss)}</td>
            <td>${moneyFormat(data.deductible)}</td>
        </tr>
        `
    );
}

async function update_detail_layer_id(id) {
    await axios.get("/retro/mindep/detaillayer/" + id).then((res) => {
        $("#tbody_detail_layer tr").remove();
        if (res.data.length > 0)
            _.each(res.data, function (data) {
                appendDetailLayer(data);
            });
    });
}

async function addDetailLayer(id) {
    $("#detail_layer_modal").modal("toggle");
    $(".layer_id").val(id);

    $("body").addClass("loading");

    var layer = await axios
        .get("/retro/mindep/layer/show/" + id)
        .then((res) => res.data);
    update_disabled_layer(layer);
    await update_detail_layer_id(id);

    $("body").removeClass("loading");
}

async function create_detail_layer(data) {
    var _data = {
        layer_id: data.layer_id.value,
        cob: data.cob.value,
        mindep: data.mindep.value,
        limit_loss: data.limit_loss.value,
        deductible: data.deductible.value,
    };
    $("body").addClass("loading");
    var res = await axios
        .post("/retro/mindep/detaillayer/store", _data)
        .then((res) => res.data);
    console.log(
        "🚀 ~ file: entry.js ~ line 425 ~ create_detail_layer ~ res",
        res
    );

    appendDetailLayer(res);
    $("#form_detail_layer")[0].reset();
    $("body").removeClass("loading");
    toastr.success("Detail Layer Created!");
}
//end of region detail layer

//region adjusment
$("#agnpi, #adj_premium_rate_percentage").on("input", function () {
    var agnpi = $("#agnpi").val();
    var aprp = $("#adj_premium_rate_percentage").val();
    if (agnpi != "" && aprp != "") {
        var res = parseFloat((parseFloat(agnpi) * parseFloat(aprp)) / 100);
        $("#adj_premium_rate_amount").val(res).trigger("input");
    }
});

$("#agnpi, #adj_premium_rate_amount").on("input", function () {
    var agnpi = $("#agnpi").val();
    var apra = $("#adj_premium_rate_amount").val();
    if (agnpi != "" && apra != "") {
        var res = parseFloat(parseFloat(agnpi) - parseFloat(apra));
        $("#additional_premium").val(res).trigger("input");
    }
});

$("#overrider_percentage, #additional_premium").on("input", function () {
    var op = $("#overrider_percentage").val();
    var ap = $("#additional_premium").val();
    if (op != "" && ap != "") {
        var res = parseFloat((parseFloat(op) * parseFloat(ap)) / 100);
        $("#overrider_amount").val(res).trigger("input");
    }
});

$("#no_claim_bonus_percentage, #additional_premium").on("input", function () {
    var ncbp = $("#no_claim_bonus_percentage").val();
    var ap = $("#additional_premium").val();
    if (ncbp != "" && ap != "") {
        var res = parseFloat((parseFloat(ncbp) * parseFloat(ap)) / 100);
        $("#no_claim_bonus_amount").val(res).trigger("input");
    }
});

$("#additional_premium, #overrider_amount, #no_claim_bonus_amount").on(
    "input",
    function () {
        var ap = $("#additional_premium").val();
        var op = $("#overrider_amount").val();
        var ncba = $("#no_claim_bonus_amount").val();
        if (ap != "" && op != "" && ncba != "") {
            var res = parseFloat(
                parseFloat(ap) - parseFloat(op) - parseFloat(ncba)
            );
            $("#balance_due").val(res);
        }
    }
);

function appendAdjusment(data) {
    $("#tbody_adjusment").append(
        `
        <tr>
            <td>${data.version}</td>
            <td>${dateFormat(data.due_date)}</td>
            <td>${moneyFormat(data.agnpi)}</td>
            <td>${moneyFormat(data.adj_premium_rate_amount)}</td>
            <td>${moneyFormat(data.additional_premium)}</td>
            <td>${moneyFormat(data.overrider_amount)}</td>
            <td>${moneyFormat(data.no_claim_bonus_amount)}</td>
            <td>${moneyFormat(data.balance_due)}</td>
            <td>
                <button class="btn btn-sm btn-primary"
                    form="cancelreplace${data.id}">
                    Cancel Replace
                </button>
                <form onsubmit="cancel_replace_adjusment(this); return false" 
                    id="cancelreplace${data.id}" style="display: none">
                    <input type="hidden" name="id" value="${data.id}">
                </form>
            </td>
        </tr>
        `
    );
}

async function cancel_replace_adjusment(data) {
    $("body").addClass("loading");
    var id = data.id.value;
    var adjusment = await axios
        .get("/retro/mindep/adjusment/cancelreplace/" + id)
        .then((res) => res.data);
    appendAdjusment(adjusment);
    $("body").removeClass("loading");
    toastr.success("Adjusment Cancel Replace Success!");
}

async function update_adjusment_id(id) {
    await axios.get("/retro/mindep/adjusment/" + id).then((res) => {
        var counter = res.data.length;
        $("#tbody_adjusment tr").remove();
        if (counter > 0) {
            _.each(res.data, function (data) {
                appendAdjusment(data);
            });
        }
        counter += 1;
        while (counter.toString().length < 3) counter = "0" + counter;
        var adjusment_id = "ADJ/LYR" + id + "/" + counter;
        $("#id_adjusment").val(adjusment_id);
    });
}

async function addAdjusment(id) {
    window.scrollTo({ top: 0, left: 0, behavior: "smooth" });
    $("#layer").hide();
    $("#adjusment").show();
    breadRemove("#bread-B");
    breadActive("#bread-D");

    $(".layer_id").val(id);

    $("body").addClass("loading");

    var layer = await axios
        .get("/retro/mindep/layer/show/" + id)
        .then((res) => res.data);
    update_disabled_layer(layer);
    update_disabled_main_contract(layer.getmaincontract.id);
    await update_adjusment_id(id);

    $("body").removeClass("loading");
}

async function create_adjusment(data) {
    var _data = {
        layer_id: data.layer_id.value,
        id_adjusment: data.id_adjusment.value,
        version: data.version.value,
        due_date: data.due_date.value,
        agnpi: data.agnpi.value,
        adj_premium_rate_percentage: data.adj_premium_rate_percentage.value,
        adj_premium_rate_amount: data.adj_premium_rate_amount.value,
        additional_premium: data.additional_premium.value,
        overrider_percentage: data.overrider_percentage.value,
        overrider_amount: data.overrider_amount.value,
        no_claim_bonus_percentage: data.no_claim_bonus_percentage.value,
        no_claim_bonus_amount: data.no_claim_bonus_amount.value,
        balance_due: data.balance_due.value,
    };
    $("body").addClass("loading");
    await axios
        .post("/retro/mindep/adjusment/store", _data)
        .then(async (res) => {
            var data = res.data;
            appendAdjusment(data);
            $("#form_adjusment")[0].reset();
            await update_adjusment_id($(".layer_id").val());
            $("body").removeClass("loading");
            toastr.success("Adjusment Created!");
        });
}
//end of region adjusment

//region panel retro
function appendPanelRetro(pr) {
    $("#tbody_panel_retro").append(
        `
        <tr>
            <td>
                ${pr.getretrocessionaire.code} - 
                ${pr.getretrocessionaire.name}
            </td>
            <td>${moneyFormat(pr.share)}%</td>
            <td>
                <button class="btn btn-sm btn-primary m-1" type="button" 
                    onclick="addPanelMember(${pr.id})">
                    Add Panel Member
                </button>
            </td>
        </tr>
        `
    );
}

async function update_panel_retro_id(id) {
    await axios.get("/retro/mindep/panelretro/" + id).then((res) => {
        var counter = res.data.length;
        $("#tbody_panel_retro tr").remove();
        if (counter > 0) {
            _.each(res.data, function (pr) {
                appendPanelRetro(pr);
            });
        }
        counter += 1;
        while (counter.toString().length < 3) counter = "0" + counter;
        var panel_retro_id = "PR/LYR" + id + "/" + counter;
        $("#id_panel_retro").val(panel_retro_id);
    });
}

async function addPanelRetro(id) {
    window.scrollTo({ top: 0, left: 0, behavior: "smooth" });
    $("#layer").hide();
    $("#panel_retro").show();
    breadRemove("#bread-B");
    breadActive("#bread-C");

    $(".layer_id").val(id);

    $("body").addClass("loading");

    var layer = await axios
        .get("/retro/mindep/layer/show/" + id)
        .then((res) => res.data);
    update_disabled_layer(layer);
    update_disabled_main_contract(layer.getmaincontract.id);
    await update_panel_retro_id(id);

    $("body").removeClass("loading");
}

async function create_panel_retro(data) {
    var _data = {
        layer_id: data.layer_id.value,
        id_panel_retro: data.id_panel_retro.value,
        retrocessionaire: data.retrocessionaire.value,
        share: data.share.value,
    };
    $("body").addClass("loading");
    await axios
        .post("/retro/mindep/panelretro/store", _data)
        .then(async (res) => {
            var pr = res.data;
            appendPanelRetro(pr);
            $("#form_panel_retro")[0].reset();
            $("#retrocessionaire").val("").change();
            await update_panel_retro_id($(".layer_id").val());
            $("body").removeClass("loading");
            toastr.success("Panel Retro Created!");
        });
}
//end of region panel retro

//region panel member
function appendPanelMember(pm) {
    $("#tbody_panel_member").append(
        `
        <tr>
            <td>
                ${pm.getretrocessionaire.code} - 
                ${pm.getretrocessionaire.name}
            </td>
            <td>${pm.rating}</td>
            <td>${moneyFormat(pm.share)}%</td>
        </tr>
        `
    );
}

async function update_panel_member(id) {
    await axios.get("/retro/mindep/panelmember/" + id).then((res) => {
        $("#tbody_panel_member tr").remove();
        if (res.data.length > 0)
            _.each(res.data, function (pm) {
                appendPanelMember(pm);
            });
    });
}

async function addPanelMember(id) {
    $("#panel_member_modal").modal("toggle");
    $(".panel_retro_id").val(id);

    $("body").addClass("loading");

    await update_panel_member(id);

    $("body").removeClass("loading");
}

async function create_panel_member(data) {
    var _data = {
        panel_retro_id: data.panel_retro_id.value,
        member_retrocessionaire: data.member_retrocessionaire.value,
        rating: data.rating.value,
        share: data.share.value,
    };
    $("body").addClass("loading");
    await axios
        .post("/retro/mindep/panelmember/store", _data)
        .then(async (res) => {
            var pm = res.data;
            console.log("🚀 ~ file: entry.js ~ line 370 ~ .then ~ pm", pm);
            appendPanelMember(pm);
            $("#form_panel_member")[0].reset();
            $("#member_retrocessionaire").val("").change();
            toastr.success("Panel Member Created!");
        });
    $("body").removeClass("loading");
}
//end of region panel member

//region if request for adjusment
if ($("#form_view").val() == "adjusment") {
    addLayer($(".main_contract_id").val());
    addAdjusment($(".layer_id").val());
}
//end of region if request for adjusment
