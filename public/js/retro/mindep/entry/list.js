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
					<form action="/retro/mindep/entry" method="get" style="display: none"
						id="form_adjusment${l.id}">
						<input type="hidden" name="adjusment" value="${btoa(l.id)}">
					</form>
          <button class="btn btn-sm btn-primary m-1" type="submit"
            form="form_adjusment${l.id}">
            Add Adjusment
          </button>
        </td>
      </tr>
      `
    );
}

async function open_layer_modal(id) {
    var layers = await axios
        .get("/retro/mindep/layer/" + id)
        .then((res) => res.data);
    $("#tbody_layer tr").remove();
    if (layers.length > 0) {
        _.each(layers, (l) => appendLayer(l));
        $("#layer_modal").modal("toggle");
    } else {
        swal({
            toast: true,
            type: "info",
            title: "No layers founded!",
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
        });
    }
}
