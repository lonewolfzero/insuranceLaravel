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

function dateFormat(val) {
    return new Date(val).toLocaleDateString("en-GB");
}
