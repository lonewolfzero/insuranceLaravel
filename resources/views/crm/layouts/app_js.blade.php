<script>
    $('.select2').select2();
$(".money").inputmask({
    alias: "decimal",
    groupSeparator: ".",
    autoGroup: true,
    autoUnmask: true,
});

$("input.tanggal").on('keyup',function(){
    var date = $(this);
    var mydate = date.val();
    mydate = mydate.replace(/\D|\s/, '');  
    mydate = mydate.replace(/^(00)(.*)?/, '01$2');
    mydate = mydate.replace(/^([0-9]{2})(00)(.*)?/, '$101');
    mydate = mydate.replace(/^([3-9])([2-9])(.*)?/, '2$2');
    mydate = mydate.replace(/^(3[01])(02)(.*)?/, '29$2');
    mydate = mydate.replace(/^([0-9]{2})([2-9]|1[3-9])(.*)?/, '$112');
    mydate = mydate.replace(/^([0-9]{2})([0-9]{2})([0-9].*?)/, '$1/$2/$3');
    mydate = mydate.replace(/^([0-9]{2})([0-9])/, '$1/$2');    
    //ano bissexto
    var day = mydate.substr(0,2) || '01';
    var month = mydate.substr(3,2) || '01';
    var year = mydate.substr(6,4);
    if(year.length == 4 && day == '29' && month == '02' && (year % 4 != 0 || (year.substr(2,2) == '00' && year % 400 != 0))) {
      mydate = mydate.replace(/^29/,'28');
    }
    mydate = mydate.substr(0,10);
    date.val(mydate);
})
function floatToString(amount){
    if(Number.isInteger(amount)){
        return parseFloat(amount).toString().replace(/\B(?=(\d{3})+(?!\d))/g,",");
    }else{
        return parseFloat(amount).toString().replace(/\B(?=(\d{3})+(?!\d)+\.)/g,",");
    }
    
}
function amountToString(amount){
    return parseFloat(amount).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g,",").toString();
}
$('#autocomplete2').keyup(function(){
    var char = $(this).val().length;

    $('.label-max').text(char + " / 300");
}); 
$('.nav-tabs li a').click(function (e) {     
    //get selected href
    var href = $(this).attr('href');    
    var id = href.substring(1);
    // console.log(id)
       
    
    
    //set all nav tabs to inactive
    $('.nav-tabs li').removeClass('active');
    $('.nav-tabs li a').removeClass('active');
    
    //get all nav tabs matching the href and set to active
    $('.nav-tabs li[href="'+href+'"]').addClass('active');
    $('.nav-tabs li a[href="'+href+'"]').addClass('active');

    //active tab
    $('.tab-pane').removeClass('show');
    $('.tab-pane').removeClass('active');
    $('.tab-pane[id="'+id+'"]').addClass('show');
    $('.tab-pane[id="'+id+'"]').addClass('active');
    if(id == "installment-details-id"){

        window.scrollTo({ top: $("#installment-details-id").offset().top, behavior: 'smooth' }); 
    }else if(id == "insured-details-id"){

        window.scrollTo({ top: $("#insured-details-id").offset().top, behavior: 'smooth' }); 
    }else if(id == "general-details-id"){

        window.scrollTo({ top: $("#general-details-id").offset().top, behavior: 'smooth' }); 
    }

});
</script>

@if(Session::has('message'))
<script>
    $(function(){
        "use strict";
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "300",
            "timeOut": "2000",
        }
        
        var type = "{{ Session::get('alert-type', 'info') }}";
        switch(type){
            case 'info':
                toastr.info("{{ Session::get('message') }}");
                break;

            case 'warning':
                toastr.warning("{{ Session::get('message') }}");
                break;

            case 'success':
                toastr.success("{{ Session::get('message') }}");
                break;

            case 'error':
                toastr.error("{{ Session::get('message') }}");
                break;
        }
    })
</script>
@endif