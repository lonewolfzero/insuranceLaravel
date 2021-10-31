$(".e1").select2({
    width: "100%",
});

//#region mask
$(".datepicker").datepicker({
    autoclose: true,
    todayHighlight: true,
    zIndexOffset: 9999999,
    format: "dd/mm/yyyy",
});

$(".yearpicker").datepicker({
    autoclose: true,
    format: "yyyy",
    viewMode: "years",
    minViewMode: "years",
});

$(".datemask").mask("00/00/0000", {
    placeholder: "dd/mm/yyyy",
    separator: "/",
});

$(".yearmask").mask("0000", {
    placeholder: "yyyy",
});

$(".money").inputmask({
    // rightAlign: false,
    // digits: 4,
    alias: "decimal",
    groupSeparator: ".",
    autoGroup: true,
    autoUnmask: true,
});

$(".percentage").mask("#P99", {
    reverse: true,
    translation: {
        P: { pattern: /\./, optional: true },
    },
    onChange: function (value, e) {
        e.target.value = value
            .replace(/(?!^)-/g, "")
            .replace(/^,/, "")
            .replace(/^-,/, "-");
    },
});
//#region mask

toastr.options = {
    closeButton: false,
    debug: false,
    newestOnTop: true,
    progressBar: true,
    positionClass: "toast-top-right",
    preventDuplicates: false,
    onclick: null,
    showDuration: "300",
    hideDuration: "300",
    timeOut: "2000",
};

function moneyFormat(val) {
    return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

$("#bordero_input_file").on("change", function (e) {
    var files = [];
    for (var i = 0; i < e.target.files.length; i++) {
        files.push(e.target.files[i].name);
    }
    $(".custom-file-label").html(files.join(", "));
    if (files.length < 1) $(".custom-file-label").html("Choose File ...");
});
