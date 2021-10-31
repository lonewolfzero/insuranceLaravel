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
