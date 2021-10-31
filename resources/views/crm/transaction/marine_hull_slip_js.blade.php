<link href="{{asset('css/select2.css')}}" rel="stylesheet"/>
<script src="{{asset('js/select2.js')}}"></script>
<style type="text/css">
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
  }

  /* Firefox */
  input[type=number] {
      -moz-appearance: textfield;
  }

.modal { overflow: auto !important; }
</style>

<script>
$('#modalcountupdatebuttonclose').click(function(){
    $('#ModalCountHullUpdate').modal('hide');
    $('#updatemodaldata').focus();
    
});

$('#modalcountupdatebuttonclose2').click(function(){
    $('#ModalCountHullUpdate').modal('hide');
    $('#updatemodaldata').focus();
});

$("#modalcountendorsementbuttonclose").click(function(){
    $('#ModalCountHullEndorsement').modal('hide');
    $('#endorsementmodaldata').focus();
});

$("#modalcountendorsementbuttonclose2").click(function(){
    $('#ModalCountHullEndorsement').modal('hide');
    $('#endorsementmodaldata').focus();
});


</script>

<script type="text/javascript">

        var CSRF_TOKEN = $('meta[name="_token2"]').attr('content');

        $(document).ready(function() { 
            var code = $('#mhnumber').val();
            refreshTableSlip(code);
            $(".e1").select2(); 
            $('#mhnumber').click(function(){
                $(this).select();
            })
            $("#btnaddlayer").attr('hidden','true');
            $("#sliplayerproportional").attr('hidden','true');
            $("#labelnonprop").attr('hidden','true');
            // $("#retrocessionPanel").attr('hidden','true');
            // $("#tabretro").attr('hidden','true');
            $("#labelnp").attr('hidden','true');

            $("#autocomplete2").keyup(function() {
                var val = $(this).val()
                $(this).val(val.toUpperCase())
            });

            $("#autocomplete2").keyup(function() {
                var val = $(this).val()
                $(this).val(val.toUpperCase())
            });

            var dtdef = new Date($.now());
            var datetimedef =  dtdef.getFullYear() + "-" + dtdef.getMonth() + "-" + dtdef.getDate() + " " + dtdef.getHours() + ":" + dtdef.getMinutes() + ":" + dtdef.getSeconds();
            $('#slipStatusTable tbody').append('<tr id="stlid"><td >'+ $("#slipstatus").val() +'</td><td >'+datetimedef+'</td><td >'+ $("#slipusername").val() +'</td></tr>')
        
            $("#btn-success2").click(function(){ 
           var html = $(".clone2").html();
           $(".increment2").after(html);
           });
   
           $("body").on("click","#btn-danger2",function(){ 
           $(this).parents("#control-group2").remove();
           });

        });

        function treatAsUTC(date) {
            var result = new Date(date);
            result.setMinutes(result.getMinutes() - result.getTimezoneOffset());
            return result;
        }

        function daysBetween(startDate, endDate) {
            var millisecondsPerDay = 24 * 60 * 60 * 1000;
            return (treatAsUTC(endDate) - treatAsUTC(startDate)) / millisecondsPerDay;
        }
</script>

<link rel="stylesheet" href="{{asset('css/sweetalert2.min.css')}}">
<script src="{{asset('js/sweetalert2.all.min.js')}}"></script>

<style>
    .hide {
        display: none;
    }
</style>

<script type="text/javascript">
    $('input.tanggal').mask("##/##/####",{
        mask: "1/2/y", 
        placeholder: "dd/mm/yyyy", 
        leapday: "-02-29", 
        separator: "/", 
        alias: "dd/mm/yyyy"
      });  
</script>

<script type="text/javascript">
    function clear_all(){
        $('#autocomplete').val("");
        $('#autocomplete2').val("");
        $('#mhrouteto').val("");
        $('#mhroutefrom').val("");
        $('#mhshare').val("");
        $('#mhsharefrom').val("");
        $('#mhshareto').val("");
        $('#mhcndn').val("");
        $('#mhcertno').val("");
        $('#mhslipno').val("");
        $('#mhpolicyno').val("");
        $('#mhpercent').val("");
        $('#mhamount').val("");
        // $('select option[value="placeholder"]').attr("selected",true);
        $('select').prop('selectedIndex',0);
        $('#slipwpc').val("");
        $('#slipremarks').val("");
        $('#sliptotalsum').val("");
        $('#sliptotalsum2').val("");
        $('#slippct').val("");
        $('#slipsumtotalpct').val("");
        $('#slipsumtotalpct2').val("");
        $('#slipipfrom').val("");
        $('#slipipto').val("");
        $('#sliprpfrom').val("");
        $('#sliprpto').val("");
        $('#slipdaytotal1').val("");
        $('#slipdaytotal2').val("");
        $('#slipdaytotal3').val("");
        $('#slipdaytotal4').val("");
        $('#sliptotalsumdate2').val("");
        $('#sliptotalsumdate').val("");
        $('#sharetotalsum').val("");
        $('#sharetotalsum2').val("");
        $('#sliprate').val("");
        $('#sliptotalrate').val("");
        $('#sliptotalrate2').val("");
        $('#slipbasicpremium').val("");
        $('#slipbasicpremium2').val("");
        $('#slipshare').val("");
        $('#slipsumshare').val("");
        $('#slipsumshare2').val("");
        $('#slipvbroker').val("");
        $('#slipsumsfee').val("");
        $('#slipsumfee2').val("");
        $('#slipcommission').val("");
        $('#slipsumcommission').val("");
        $('#slipsumcommission2').val("");
        $('#slipgrossprmtonr').val("");
        $('#slipgrossprmtonr2').val("");
        $('#slipnetprmtonr').val("");
        $('#slipnetprmtonr2').val("");
        $('#slipsumor').val("");
        $('#slipsumor2').val("");
        $('#sliptotalpercentinspan').val("");


    }
</script>

<script type="text/javascript">
     $("#btnRefreshCeding").click(function(){
            $.ajax({
                url:'{{ url("/") }}/transaction-data/get-ceding/',
                type:"GET",
                beforeSend: function() { $("body").addClass("loading");  },
                complete: function() {  $("body").removeClass("loading"); },
                success:function(response)
                {
                    
                     $('#mhcedinglist').empty();
                     $('#mhcedinglist').append('<option value=""  selected disabled >Ceding</option>');
                     $.each(response,function(i,item){
                        $('#mhcedinglist').append('<option value="'+item.id+'">'+item.code+' - '+item.name+'</option>');
                     });
                     
                    
                },
                error: function (request, status, error) {
                    //alert(request.responseText);
                    swal("Error!", error, "Get Data Error");
                }
            });
        });
     $("#btnRefreshShip").click(function(){
            $.ajax({
                url:'{{ url("/") }}/transaction-data/get-ship/',
                type:"GET",
                beforeSend: function() { $("body").addClass("loading");  },
                complete: function() {  $("body").removeClass("loading"); },
                success:function(response)
                {
                    
                     $('#shipcodetxt').empty();
                     $('#shipcodetxt').append('<option value=""  selected disabled >Ship</option>');
                     $.each(response,function(i,item){
                        $('#shipcodetxt').append('<option value="'+item.code+'">'+item.code+' - '+item.shipname+'</option>');
                     });
                     
                    
                },
                error: function (request, status, error) {
                    //alert(request.responseText);
                    swal("Error!", error, "Get Data Error");
                }
            });
        });
</script>


<script type="text/javascript">
    $('.nav-tabs li a').click(function (e) {     
    //get selected href
    var href = $(this).attr('href');    
    var id = href.substring(1);
    console.log(id)
       
    
    
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
    if(id == "installment-details-id-tabpanel"){

        window.scrollTo({ top: $("#installment-details-id-tabpanel").offset().top, behavior: 'smooth' }); 
    }
});
</script>

<script type="text/javascript">
    // $('#slipamount').keyup(function(){
    //     var currenc = $(this).val();
    //     console.log(currenc)
    //     currenc.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    // });
    const formatter = new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD',
        minimumFractionDigits: 2
    })
    $('input.amount').keyup(function(event) {
            // skip for arrow keys
            if(event.which >= 37 && event.which <= 40) return;
           
                console.log(event.which)
                console.log($(this).val())
                // format number
                $(this).val(function(index, value) 
                {
                    //var realval=value.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
                    //return formatter.format(realval);
                    if(event.which >= 37 && event.which <= 40) 
                    {
                        return false;
                    }
                    else
                    {
                        var parts = value.toString().split(".");
                        parts[0] = parts[0].replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        return parts.join(".");
                    }

                    //return value.toString().replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                
                });
               
    });
</script>

<script type="text/javascript">
    $('#switch-proportional').change(function(){
        var attr = $("#btnaddlayer").attr('hidden');
        if(typeof attr !== typeof undefined && attr !== false){
            $("#btnaddlayer").removeAttr('hidden');
            $("#sliplayerproportional").removeAttr('hidden');
            $("#labelnonprop").removeAttr('hidden');
            $("#labelnp").removeAttr('hidden');
            
        }
        else{
            $("#btnaddlayer").attr('hidden','true');
            $("#sliplayerproportional").attr('hidden','true');
            $("#labelnonprop").attr('hidden','true');
            $("#labelnp").attr('hidden','true');

        }
        
    });

    // $('#sliprb').change(function(){
    //     var attr = $("#retrocessionPanel").attr('hidden');
    //     if(typeof attr !== typeof undefined && attr !== false){
    //         $("#retrocessionPanel").removeAttr('hidden');
    //         $("#tabretro").removeAttr('hidden');
    //     }
    //     else{
    //         $("#retrocessionPanel").attr('hidden','true');
    //         $("#tabretro").attr('hidden','true');
    //     }
    // });

    $('#slipipfrom').on('dp.change', function(e){ console.log(e.date); })
</script>

<script type="text/javascript">
    $('#switch-proportionalupdate').change(function(){
        var attr = $("#btnaddlayerupdate").attr('hidden');
        if(typeof attr !== typeof undefined && attr !== false){
            $("#btnaddlayer").removeAttr('hidden');
            $("#sliplayerproportionalupdate").removeAttr('hidden');
            $("#labelnonpropupdate").removeAttr('hidden');
            $("#labelnpupdate").removeAttr('hidden');
            
        }
        else{
            $("#btnaddlayerupdate").attr('hidden','true');
            $("#sliplayerproportionalupdate").attr('hidden','true');
            $("#labelnonpropupdate").attr('hidden','true');
            $("#labelnpupdate").attr('hidden','true');

        }
        
    });

    // $('#sliprbupdate').change(function(){
    //     var attr = $("#retrocessionPanelupdate").attr('hidden');
    //     if(typeof attr !== typeof undefined && attr !== false){
    //         $("#retrocessionPanelupdate").removeAttr('hidden');
    //         $("#tabretroupdate").removeAttr('hidden');
    //     }
    //     else{
    //         $("#retrocessionPanelupdate").attr('hidden','true');
    //         $("#tabretroupdate").attr('hidden','true');
    //     }
    // });

    $('#slipipfromupdate').on('dp.change', function(e){ console.log(e.date); })
</script>

<script type="text/javascript">
    $('#switch-proportionalendorsement').change(function(){
        var attr = $("#btnaddlayerendorsement").attr('hidden');
        if(typeof attr !== typeof undefined && attr !== false){
            $("#btnaddlayerendorsement").removeAttr('hidden');
            $("#sliplayerproportionalendorsement").removeAttr('hidden');
            $("#labelnonpropendorsement").removeAttr('hidden');
            $("#labelnpendorsement").removeAttr('hidden');
            
        }
        else{
            $("#btnaddlayerendorsement").attr('hidden','true');
            $("#sliplayerproportionalendorsement").attr('hidden','true');
            $("#labelnonpropendorsement").attr('hidden','true');
            $("#labelnpendorsement").attr('hidden','true');

        }
        
    });

    // $('#sliprbendorsement').change(function(){
    //     var attr = $("#retrocessionPanelendorsement").attr('hidden');
    //     if(typeof attr !== typeof undefined && attr !== false){
    //         $("#retrocessionPanelendorsement").removeAttr('hidden');
    //         $("#tabretroendorsement").removeAttr('hidden');
    //     }
    //     else{
    //         $("#retrocessionPanelendorsement").attr('hidden','true');
    //         $("#tabretroendorsement").attr('hidden','true');
    //     }
    // });

    $('#slipipfromendorsement').on('dp.change', function(e){ console.log(e.date); })
</script>

<script type="text/javascript">
    $(function() {              
       // Bootstrap DateTimePicker v4
       

       $('#slipipdate').datepicker({
           dateFormat: 'dd/mm/yy',
           changeYear: true,
           yearRange: '-50:+100',
       });

       $('#slipipdateupdate').datepicker({
           dateFormat: 'dd/mm/yy',
           changeYear: true,
           yearRange: '-50:+100',
       });

       $('#slipipdateendorsement').datepicker({
           dateFormat: 'dd/mm/yy',
           changeYear: true,
           yearRange: '-50:+100',
       });

     
       $('#dateinfrom').datepicker({
           dateFormat: 'dd/mm/yy',
           changeYear: true,
           yearRange: '-50:+100',
       });

       $('#dateinto').datepicker({
           dateFormat: 'dd/mm/yy',
           changeYear: true,
           yearRange: '-50:+100',
       });

       $('#daterefrom').datepicker({
           dateFormat: 'dd/mm/yy',
           changeYear: true,
           yearRange: '-50:+100',
       });

       $('#datereto').datepicker({
           dateFormat: 'dd/mm/yy',
           changeYear: true,
           yearRange: '-50:+100',
       });

       $('#slipipfrom').datepicker({
           dateFormat: 'dd/mm/yy',
           changeYear: true,
           yearRange: '-50:+100',
       });

       $('#slipipto').datepicker({
           dateFormat: 'dd/mm/yy',
           changeYear: true,
           yearRange: '-50:+100',
       });

       $('#sliprpfrom').datepicker({
           dateFormat: 'dd/mm/yy',
           changeYear: true,
           yearRange: '-50:+100',
       });

       $('#sliprpto').datepicker({
           dateFormat: 'dd/mm/yy',
           changeYear: true,
           yearRange: '-50:+100',
       });

       $('#slipipfromupdate').datepicker({
           dateFormat: 'dd/mm/yy',
           changeYear: true,
           yearRange: '-50:+100',
       });

       $('#slipiptoupdate').datepicker({
           dateFormat: 'dd/mm/yy',
           changeYear: true,
           yearRange: '-50:+100',
       });

       $('#sliprpfromupdate').datepicker({
           dateFormat: 'dd/mm/yy',
           changeYear: true,
           yearRange: '-50:+100',
       });

       $('#sliprptoupdate').datepicker({
           dateFormat: 'dd/mm/yy',
           changeYear: true,
           yearRange: '-50:+100',
       });

       $('#slipipfromendorsement').datepicker({
           dateFormat: 'dd/mm/yy',
           changeYear: true,
           yearRange: '-50:+100',
       });

       $('#slipiptoendorsement').datepicker({
           dateFormat: 'dd/mm/yy',
           changeYear: true,
           yearRange: '-50:+100',
       });

       $('#sliprpfromendorsement').datepicker({
           dateFormat: 'dd/mm/yy',
           changeYear: true,
           yearRange: '-50:+100',
       });

       $('#sliprptoendorsement').datepicker({
           dateFormat: 'dd/mm/yy',
           changeYear: true,
           yearRange: '-50:+100',
       });

       
       // $('#slipprodyear').datepicker("disabled");

       $('#sliptd').datepicker({
           dateFormat: 'dd/mm/yy',
           changeYear: true,
           yearRange: '-50:+100',
       });

       // $('#sliptddetail').datepicker({
       //     dateFormat: 'dd/mm/yy',
       //     changeYear: true,
       //     yearRange: '-50:+100',
       // });  


       $('#slipprodyearendorsement').datepicker({
           dateFormat: 'dd/mm/yy',
           changeYear: true,
           yearRange: '-50:+100',
       });

       $('#sliptdendorsement').datepicker({
           dateFormat: 'dd/mm/yy',
           changeYear: true,
           yearRange: '-50:+100',
       });

       $('#slipipfromendorsement').datepicker({
           dateFormat: 'dd/mm/yy',
           changeYear: true,
           yearRange: '-50:+100',
       });

       $('#slipiptoendorsement').datepicker({
           dateFormat: 'dd/mm/yy',
           changeYear: true,
           yearRange: '-50:+100',
       });

       $('#sliprpfromendorsement').datepicker({
           dateFormat: 'dd/mm/yy',
           changeYear: true,
           yearRange: '-50:+100',
       });

       $('#sliprptoendorsement').datepicker({
           dateFormat: 'dd/mm/yy',
           changeYear: true,
           yearRange: '-50:+100',
       });

       $('#dateinstallmentdataendorsement').datepicker({
           dateFormat: 'dd/mm/yy',
           changeYear: true,
           yearRange: '-50:+100',
       });
           

       $('#slipprodyearupdate').datepicker({
           dateFormat: 'dd/mm/yy',
           changeYear: true,
           yearRange: '-50:+100',
       });

       $('#sliptdupdate').datepicker({
           dateFormat: 'dd/mm/yy',
           changeYear: true,
           yearRange: '-50:+100',
       });

       $('#slipipfromupdate').datepicker({
           dateFormat: 'dd/mm/yy',
           changeYear: true,
           yearRange: '-50:+100',
       });

       $('#slipiptoupdate').datepicker({
           dateFormat: 'dd/mm/yy',
           changeYear: true,
           yearRange: '-50:+100',
       });

       $('#sliprpfromupdate').datepicker({
           dateFormat: 'dd/mm/yy',
           changeYear: true,
           yearRange: '-50:+100',
       });

       $('#sliprptoupdate').datepicker({
           dateFormat: 'dd/mm/yy',
           changeYear: true,
           yearRange: '-50:+100',
       });

       $('#dateinstallmentdataupdate').datepicker({
           dateFormat: 'dd/mm/yy',
           changeYear: true,
           yearRange: '-50:+100',
       });
           

    });      

    $('#slipipfrom').change(function(){
        $('#sliprpfrom').val($(this).val());

        var date_to = $('#slipipto').val();
        if(date_to){
            var insurance_period_from2 = $('#sliprpfrom').val();
            var insurance_period_to2 = $('#sliprpto').val();
            var newinsurance_period_from2 = insurance_period_from2.split("/").reverse().join("-");
            var newinsurance_period_to2 = insurance_period_to2.split("/").reverse().join("-");
            var days=daysBetween(newinsurance_period_from2, newinsurance_period_to2);
            var sum = isNaN(days / 365) ? 0 :(days / 365).toFixed(6);
            // var constday = days.toString() + "/365";
            var constday1 = days.toString();
            var constday2 = "365";
            console.log(insurance_period_from2)
            console.log(insurance_period_to2)
            console.log(days)
            console.log(constday1)
            console.log(constday2)
            console.log(parseFloat(sum))

            var fulltgl = $(this).val();

            var tgl = parseInt(fulltgl.substring(0,2));
            console.log(tgl)
            var month = parseInt(fulltgl.substring(3,5));
            console.log(month)
            // var year = full.substring(6,12);

            if (tgl < 1 || tgl > 31 || month < 1 || month > 12) {
                swal("Warning","Date Format not valid, Please check again","format error")
              }else if(month == 2 && tgl > 28){
                swal("Warning","Date Format not valid, Please check again","format error")

              } 
            
            $('#slipdaytotal').val(constday1);
            $('#slipdaytotal2').val(constday1);
            $('#slipdaytotal3').val(constday2);
            $('#slipdaytotal4').val(constday2);
            $('#sliptotalsumdate').val(parseFloat(sum));
            $('#sliptotalsumdate2').val(parseFloat(sum));
        }

        var fulltgl = $(this).val();

        var tgl = parseInt(fulltgl.substring(0,2));
        console.log('ini tgl' + tgl)
        var month = parseInt(fulltgl.substring(3,5));
        console.log('ini bln' + month)
        // var year = full.substring(6,12);

        if (tgl < 1 || tgl > 31 || month < 1 || month > 12) {
            swal("Warning","Date Format not valid, Please check again","format error")
          }else if(month == 2 && tgl > 28){
            swal("Warning","Date Format not valid, Please check again","format error")
            
          }
    });

    $('#slipipto').change(function(){
        $('#sliprpto').val($(this).val());
        
        var insurance_period_from2 = $('#sliprpfrom').val();
        var insurance_period_to2 = $('#sliprpto').val();
        var newinsurance_period_from2 = insurance_period_from2.split("/").reverse().join("-");
        var newinsurance_period_to2 = insurance_period_to2.split("/").reverse().join("-");
        
        var days=daysBetween(newinsurance_period_from2, newinsurance_period_to2);
        var sum = isNaN(days / 365) ? 0 :(days / 365).toFixed(7);
        // var constday = days.toString() + "/365";
        var constday1 = days.toString();
        var constday2 = "365";
        
        console.log(insurance_period_from2)
        console.log(insurance_period_to2)
        console.log(days)
        console.log(constday1)
        console.log(constday2)
        console.log(parseFloat(sum))

        var fulltgl = $(this).val();

        var tgl = parseInt(fulltgl.substring(0,2));
        console.log('ini tgl' + tgl)
        
        var month = parseInt(fulltgl.substring(3,5));
        console.log('ini bln' + month)
        
        // var year = full.substring(6,12);

        if (tgl < 1 || tgl > 31 || month < 1 || month > 12) {
            swal("Warning","Date Format not valid, Please check again","format error")
          }else if(month == 2 && tgl > 28){
            swal("Warning","Date Format not valid, Please check again","format error")
            
          } 
        
        if(sum < 0)
        {
            swal("Warning","Insurance/Reinsurance period cannot backdate, Please check again","Date format error")
            $('#slipdaytotal').val('');
            $('#slipipto').val('');
            $('#sliprpto').val('');
            $('#slipdaytotal2').val('');
            $('#slipdaytotal3').val('');
            $('#slipdaytotal4').val('');
            $('#sliptotalsumdate').val('');
            $('#sliptotalsumdate2').val('');
        }
        else
        {
            $('#slipdaytotal').val(constday1);
            $('#slipdaytotal2').val(constday1);
            $('#slipdaytotal3').val(constday2);
            $('#slipdaytotal4').val(constday2);
            $('#sliptotalsumdate').val(parseFloat(sum));
            $('#sliptotalsumdate2').val(parseFloat(sum));
        }
        
        // document.getElementById("daytotal").innerHTML = "Total Days :"+days;
    });

    $('#sliprpto').change(function(){
        var insurance_period_from2 = $('#sliprpfrom').val();
        var insurance_period_to2 = $('#sliprpto').val();
        var newinsurance_period_from2 = insurance_period_from2.split("/").reverse().join("-");
        var newinsurance_period_to2 = insurance_period_to2.split("/").reverse().join("-");
        var days=daysBetween(newinsurance_period_from2, newinsurance_period_to2);
        var sum = isNaN(days / 365) ? 0 :(days / 365).toFixed(7);
        // var constday = days.toString() + "/365";
        var constday1 = days.toString();
        var constday2 = "365";
        console.log(insurance_period_from2)
        console.log(insurance_period_to2)
        console.log(days)
        console.log(constday1)
        console.log(constday2)  
        console.log(parseFloat(sum))

        var fulltgl = $(this).val();

        var tgl = parseInt(fulltgl.substring(0,2));
        console.log('ini tgl' + tgl)
        var month = parseInt(fulltgl.substring(3,5));
        console.log('ini bln' + month)
        // var year = full.substring(6,12);

        if (tgl < 1 || tgl > 31 || month < 1 || month > 12) {
            swal("Warning","Date Format not valid, Please check again","format error")
          }else if(month == 2 && tgl > 28){
            swal("Warning","Date Format not valid, Please check again","format error")
            
          } 
        
        // $('#slipipto').val($(this).val());
        
        if(sum < 0){
            swal("Warning","Insurance/Reinsurance period cannot backdate, Please check again","Date format error")
            $('#slipdaytotal').val('');
            $('#slipdaytotal2').val('');
            $('#slipdaytotal3').val('');
            $('#slipdaytotal4').val('');
            $('#sliptotalsumdate').val('');
            $('#sliptotalsumdate2').val('');
        }else{
            $('#slipdaytotal').val(constday1);
            $('#slipdaytotal2').val(constday1);
            $('#slipdaytotal3').val(constday2);
            $('#slipdaytotal4').val(constday2);
            $('#sliptotalsumdate').val(parseFloat(sum));
            $('#sliptotalsumdate2').val(parseFloat(sum));
        }
        
    });

    $('#sliprpfrom').change(function(){
        var date_to = $('#sliprpto').val();
        if(date_to){
            var insurance_period_from2 = $('#sliprpfrom').val();
            var insurance_period_to2 = $('#sliprpto').val();
            var newinsurance_period_from2 = insurance_period_from2.split("/").reverse().join("-");
            var newinsurance_period_to2 = insurance_period_to2.split("/").reverse().join("-");
            var days=daysBetween(newinsurance_period_from2, newinsurance_period_to2);
            var sum = isNaN(days / 365) ? 0 :(days / 365).toFixed(7);
            // var constday = days.toString() + "/365";
            var constday1 = days.toString();
            var constday2 = "365";
            console.log(insurance_period_from2)
            console.log(insurance_period_to2)
            console.log(days)
            console.log(constday1)
            console.log(constday2)
            console.log(parseFloat(sum))

            var fulltgl = $(this).val();

            var tgl = parseInt(fulltgl.substring(0,2));
            console.log('ini tgl' + tgl)
            var month = parseInt(fulltgl.substring(3,5));
            console.log('ini bln' + month)
            // var year = full.substring(6,12);

            if (tgl < 1 || tgl > 31 || month < 1 || month > 12) {
                swal("Warning","Date Format not valid, Please check again","format error")
              }else if(month == 2 && tgl > 28){
                swal("Warning","Date Format not valid, Please check again","format error")
                
              } 
            
            // $('#slipipfrom').val($(this).val());
            $('#slipdaytotal').val(constday1);
            $('#slipdaytotal2').val(constday1);
            $('#slipdaytotal3').val(constday2);
            $('#slipdaytotal4').val(constday2);
            $('#sliptotalsumdate').val(parseFloat(sum));
            $('#sliptotalsumdate2').val(parseFloat(sum));
        }
    });

    $('#slipdaytotal2').keyup(function(){
        var day = $(this).val();
        $('#slipdaytotal').val(day);

    });

    $('#slipdaytotal2').change(function(){
        var day = $(this).val();
        var days = $('#slipdaytotal4').val();
        var sum = isNaN(day / days) ? 0 :(day / days).toFixed(7);

        $('#sliptotalsumdate').val(parseFloat(sum));
        $('#sliptotalsumdate2').val(parseFloat(sum));
    });

    $('#slipdaytotal4').keyup(function(){
        var day = $(this).val();
        $('#slipdaytotal3').val(day);
        
    });

    $('#slipdaytotal4').change(function(){
        var day = $('#slipdaytotal2').val();
        var year = $(this).val();

        var sum = isNaN(day / year) ? 0 :(day / year).toFixed(7);

        $('#sliptotalsumdate').val(parseFloat(sum));
        $('#sliptotalsumdate2').val(parseFloat(sum));
        
    });

    $('#slipipfromupdate').change(function(){
        $('#sliprpfromupdate').val($(this).val());

        var date_to = $('#slipiptoupdate').val();
        if(date_to){
            var insurance_period_from2 = $('#sliprpfromupdate').val();
            var insurance_period_to2 = $('#sliprptoupdate').val();
            var newinsurance_period_from2 = insurance_period_from2.split("/").reverse().join("-");
            var newinsurance_period_to2 = insurance_period_to2.split("/").reverse().join("-");
            var days=daysBetween(newinsurance_period_from2, newinsurance_period_to2);
            var sum = isNaN(days / 365) ? 0 :(days / 365).toFixed(7);
            // var constday = days.toString() + "/365";
            var constday1 = days.toString();
            var constday2 = "365";
            console.log(insurance_period_from2)
            console.log(insurance_period_to2)
            console.log(days)
            console.log(constday1)
            console.log(constday2)
            console.log(parseFloat(sum))

            var fulltgl = $(this).val();

            var tgl = parseInt(fulltgl.substring(0,2));
            console.log(tgl)
            var month = parseInt(fulltgl.substring(3,5));
            console.log(month)
            // var year = full.substring(6,12);

            if (tgl < 1 || tgl > 31 || month < 1 || month > 12) {
                swal("Warning","Date Format not valid, Please check again","format error")
              }else if(month == 2 && tgl > 28){
                swal("Warning","Date Format not valid, Please check again","format error")

              } 
            
            $('#slipdaytotalupdate').val(constday1);
            $('#slipdaytotalupdate2').val(constday1);
            $('#slipdaytotalupdate3').val(constday2);
            $('#slipdaytotalupdate4').val(constday2);
            $('#sliptotalsumdateupdate').val(parseFloat(sum));
            $('#sliptotalsumdateupdate2').val(parseFloat(sum));
        }

        var fulltgl = $(this).val();

        var tgl = parseInt(fulltgl.substring(0,2));
        console.log('ini tgl' + tgl)
        var month = parseInt(fulltgl.substring(3,5));
        console.log('ini bln' + month)
        // var year = full.substring(6,12);

        if (tgl < 1 || tgl > 31 || month < 1 || month > 12) {
            swal("Warning","Date Format not valid, Please check again","format error")
          }else if(month == 2 && tgl > 28){
            swal("Warning","Date Format not valid, Please check again","format error")
            
          }
    });

    $('#slipiptoupdate').change(function(){
        $('#sliprptoupdate').val($(this).val());
        
        var insurance_period_from2 = $('#sliprpfromupdate').val();
        var insurance_period_to2 = $('#sliprptoupdate').val();
        var newinsurance_period_from2 = insurance_period_from2.split("/").reverse().join("-");
        var newinsurance_period_to2 = insurance_period_to2.split("/").reverse().join("-");
        var days=daysBetween(newinsurance_period_from2, newinsurance_period_to2);
        var sum = isNaN(days / 365) ? 0 :(days / 365).toFixed(7);
        // var constday = days.toString() + "/365";
        var constday1 = days.toString();
        var constday2 = "365";
        console.log(insurance_period_from2)
        console.log(insurance_period_to2)
        console.log(days)
        console.log(constday1)
        console.log(constday2)
        console.log(parseFloat(sum))

        var fulltgl = $(this).val();

        var tgl = parseInt(fulltgl.substring(0,2));
        console.log('ini tgl' + tgl)
        
        var month = parseInt(fulltgl.substring(3,5));
        console.log('ini bln' + month)
        
        // var year = full.substring(6,12);

        if (tgl < 1 || tgl > 31 || month < 1 || month > 12) {
            swal("Warning","Date Format not valid, Please check again","format error")
          }else if(month == 2 && tgl > 28){
            swal("Warning","Date Format not valid, Please check again","format error")
            
          } 
        
        if(sum < 0){
            swal("Warning","Insurance/Reinsurance period cannot backdate, Please check again","Date format error")
            $('#slipdaytotalupdate').val("");
            $('#slipdaytotalupdate2').val("");
            $('#slipdaytotalupdate3').val("");
            $('#slipiptoupdate').val('');
            $('#sliprptoupdate').val('');
            $('#slipdaytotalupdate4').val("");
            $('#sliptotalsumdateupdate').val("");
            $('#sliptotalsumdateupdate2').val("");
        }else{
            $('#slipdaytotalupdate').val(constday1);
            $('#slipdaytotalupdate2').val(constday1);
            $('#slipdaytotalupdate3').val(constday2);
            $('#slipdaytotalupdate4').val(constday2);
            $('#sliptotalsumdateupdate').val(parseFloat(sum));
            $('#sliptotalsumdateupdate2').val(parseFloat(sum));
        }

        // document.getElementById("daytotal").innerHTML = "Total Days :"+days;
    });

    $('#sliprptoupdate').change(function(){
        var insurance_period_from2 = $('#sliprpfromupdate').val();
        var insurance_period_to2 = $('#sliprptoupdate').val();
        var newinsurance_period_from2 = insurance_period_from2.split("/").reverse().join("-");
        var newinsurance_period_to2 = insurance_period_to2.split("/").reverse().join("-");
        var days=daysBetween(newinsurance_period_from2, newinsurance_period_to2);
        var sum = isNaN(days / 365) ? 0 :(days / 365).toFixed(7);
        // var constday = days.toString() + "/365";
        var constday1 = days.toString();
        var constday2 = "365";
        console.log(insurance_period_from2)
        console.log(insurance_period_to2)
        console.log(days)
        console.log(constday1)
        console.log(constday2)  
        console.log(parseFloat(sum))

        var fulltgl = $(this).val();

        var tgl = parseInt(fulltgl.substring(0,2));
        console.log('ini tgl' + tgl)
        var month = parseInt(fulltgl.substring(3,5));
        console.log('ini bln' + month)
        // var year = full.substring(6,12);

        if (tgl < 1 || tgl > 31 || month < 1 || month > 12) {
            swal("Warning","Date Format not valid, Please check again","format error")
          }else if(month == 2 && tgl > 28){
            swal("Warning","Date Format not valid, Please check again","format error")
            
          } 
        
        // $('#slipipto').val($(this).val());
        
        if(sum < 0){
            swal("Warning","Insurance/Reinsurance period cannot backdate, Please check again","Date format error")
            $('#slipdaytotalupdate').val("");
            $('#slipdaytotalupdate2').val("");
            $('#slipdaytotalupdate3').val("");
            $('#slipdaytotalupdate4').val("");
            $('#sliptotalsumdateupdate').val("");
            $('#sliptotalsumdateupdate2').val("");
        }else{
            $('#slipdaytotalupdate').val(constday1);
            $('#slipdaytotalupdate2').val(constday1);
            $('#slipdaytotalupdate3').val(constday2);
            $('#slipdaytotalupdate4').val(constday2);
            $('#sliptotalsumdateupdate').val(parseFloat(sum));
            $('#sliptotalsumdateupdate2').val(parseFloat(sum));
        }
        
    });

    $('#sliprpfromupdate').change(function(){
        var date_to = $('#sliprptoupdate').val();
        if(date_to){
            var insurance_period_from2 = $('#sliprpfrom').val();
            var insurance_period_to2 = $('#sliprpto').val();
            var newinsurance_period_from2 = insurance_period_from2.split("/").reverse().join("-");
            var newinsurance_period_to2 = insurance_period_to2.split("/").reverse().join("-");
            var days=daysBetween(newinsurance_period_from2, newinsurance_period_to2);
            var sum = isNaN(days / 365) ? 0 :(days / 365).toFixed(7);
            // var constday = days.toString() + "/365";
            var constday1 = days.toString();
            var constday2 = "365";
            console.log(insurance_period_from2)
            console.log(insurance_period_to2)
            console.log(days)
            console.log(constday1)
            console.log(constday2)
            console.log(parseFloat(sum))

            var fulltgl = $(this).val();

            var tgl = parseInt(fulltgl.substring(0,2));
            console.log('ini tgl' + tgl)
            var month = parseInt(fulltgl.substring(3,5));
            console.log('ini bln' + month)
            // var year = full.substring(6,12);

            if (tgl < 1 || tgl > 31 || month < 1 || month > 12) {
                swal("Warning","Date Format not valid, Please check again","format error")
              }else if(month == 2 && tgl > 28){
                swal("Warning","Date Format not valid, Please check again","format error")
                
              } 
            
            // $('#slipipfrom').val($(this).val());
            $('#slipdaytotalupdate').val(constday1);
            $('#slipdaytotalupdate2').val(constday1);
            $('#slipdaytotalupdate3').val(constday2);
            $('#slipdaytotalupdate4').val(constday2);
            $('#sliptotalsumdateupdate').val(parseFloat(sum));
            $('#sliptotalsumdateupdate2').val(parseFloat(sum));
        }
    });

    $('#slipipfromendorsement').change(function(){
        $('#sliprpfromendorsement').val($(this).val());

        var date_to = $('#slipiptoendorsement').val();
        if(date_to){
            var insurance_period_from2 = $('#sliprpfromendorsement').val();
            var insurance_period_to2 = $('#sliprptoendorsement').val();
            var newinsurance_period_from2 = insurance_period_from2.split("/").reverse().join("-");
            var newinsurance_period_to2 = insurance_period_to2.split("/").reverse().join("-");
            var days=daysBetween(newinsurance_period_from2, newinsurance_period_to2);
            var sum = isNaN(days / 365) ? 0 :(days / 365).toFixed(7);
            // var constday = days.toString() + "/365";
            var constday1 = days.toString();
            var constday2 = "365";
            console.log(insurance_period_from2)
            console.log(insurance_period_to2)
            console.log(days)
            console.log(constday1)
            console.log(constday2)
            console.log(parseFloat(sum))

            var fulltgl = $(this).val();

            var tgl = parseInt(fulltgl.substring(0,2));
            console.log(tgl)
            var month = parseInt(fulltgl.substring(3,5));
            console.log(month)
            // var year = full.substring(6,12);

            if (tgl < 1 || tgl > 31 || month < 1 || month > 12) {
                swal("Warning","Date Format not valid, Please check again","format error")
              }else if(month == 2 && tgl > 28){
                swal("Warning","Date Format not valid, Please check again","format error")

              } 
            
            $('#slipdaytotalendorsement').val(constday1);
            $('#slipdaytotalendorsement2').val(constday1);
            $('#slipdaytotalendorsement3').val(constday2);
            $('#slipdaytotalendorsement4').val(constday2);
            $('#sliptotalsumdateendorsement').val(parseFloat(sum));
            $('#sliptotalsumdateendorsement2').val(parseFloat(sum));
        }

        var fulltgl = $(this).val();

        var tgl = parseInt(fulltgl.substring(0,2));
        console.log('ini tgl' + tgl)
        var month = parseInt(fulltgl.substring(3,5));
        console.log('ini bln' + month)
        // var year = full.substring(6,12);

        if (tgl < 1 || tgl > 31 || month < 1 || month > 12) {
            swal("Warning","Date Format not valid, Please check again","format error")
          }else if(month == 2 && tgl > 28){
            swal("Warning","Date Format not valid, Please check again","format error")
            
          }
    });

    $('#slipiptoendorsement').change(function(){
        $('#sliprptoendorsement').val($(this).val());
        
        var insurance_period_from2 = $('#sliprpfromendorsement').val();
        var insurance_period_to2 = $('#sliprptoendorsement').val();
        var newinsurance_period_from2 = insurance_period_from2.split("/").reverse().join("-");
        var newinsurance_period_to2 = insurance_period_to2.split("/").reverse().join("-");
        var days=daysBetween(newinsurance_period_from2, newinsurance_period_to2);
        var sum = isNaN(days / 365) ? 0 :(days / 365).toFixed(7);
        // var constday = days.toString() + "/365";
        var constday1 = days.toString();
        var constday2 = "365";
        console.log(insurance_period_from2)
        console.log(insurance_period_to2)
        console.log(days)
        console.log(constday1)
        console.log(constday2)
        console.log(parseFloat(sum))

        var fulltgl = $(this).val();

        var tgl = parseInt(fulltgl.substring(0,2));
        console.log('ini tgl' + tgl)
        
        var month = parseInt(fulltgl.substring(3,5));
        console.log('ini bln' + month)
        
        // var year = full.substring(6,12);

        if (tgl < 1 || tgl > 31 || month < 1 || month > 12) {
            swal("Warning","Date Format not valid, Please check again","format error")
          }else if(month == 2 && tgl > 28){
            swal("Warning","Date Format not valid, Please check again","format error")
            
          } 
        
        if(sum < 0){
            swal("Warning","Insurance/Reinsurance period cannot backdate, Please check again","Date format error")
            $('#slipdaytotalendorsement').val('');
            $('#slipdaytotalendorsement2').val('');
            $('#slipdaytotalendorsement3').val('');
            $('#slipdaytotalendorsement4').val('');
            $('#slipiptoendorsement').val('');
            $('#sliprptoendorsement').val('');
            $('#sliptotalsumdateendorsement').val("");
            $('#sliptotalsumdateendorsement2').val("");
        }else{
            $('#slipdaytotalendorsement').val(constday1);
            $('#slipdaytotalendorsement2').val(constday1);
            $('#slipdaytotalendorsement3').val(constday2);
            $('#slipdaytotalendorsement4').val(constday2);
            $('#sliptotalsumdateendorsement').val(parseFloat(sum));
            $('#sliptotalsumdateendorsement2').val(parseFloat(sum));
        }
        

        // document.getElementById("daytotal").innerHTML = "Total Days :"+days;
    });

    $('#sliprptoendorsement').change(function(){
        var insurance_period_from2 = $('#sliprpfromendorsement').val();
        var insurance_period_to2 = $('#sliprptoendorsement').val();
        var newinsurance_period_from2 = insurance_period_from2.split("/").reverse().join("-");
        var newinsurance_period_to2 = insurance_period_to2.split("/").reverse().join("-");
        var days=daysBetween(newinsurance_period_from2, newinsurance_period_to2);
        var sum = isNaN(days / 365) ? 0 :(days / 365).toFixed(7);
        // var constday = days.toString() + "/365";
        var constday1 = days.toString();
        var constday2 = "365";
        console.log(insurance_period_from2)
        console.log(insurance_period_to2)
        console.log(days)
        console.log(constday1)
        console.log(constday2)  
        console.log(parseFloat(sum))

        var fulltgl = $(this).val();

        var tgl = parseInt(fulltgl.substring(0,2));
        console.log('ini tgl' + tgl)
        var month = parseInt(fulltgl.substring(3,5));
        console.log('ini bln' + month)
        // var year = full.substring(6,12);

        if (tgl < 1 || tgl > 31 || month < 1 || month > 12) {
            swal("Warning","Date Format not valid, Please check again","format error")
          }else if(month == 2 && tgl > 28){
            swal("Warning","Date Format not valid, Please check again","format error")
            
          } 
        
        // $('#slipipto').val($(this).val());
        
        if(sum < 0){
            swal("Warning","Insurance/Reinsurance period cannot backdate, Please check again","Date format error")
            $('#slipdaytotalendorsement').val('');
            $('#slipdaytotalendorsement2').val('');
            $('#slipdaytotalendorsement3').val('');
            $('#slipdaytotalendorsement4').val('');
            $('#sliptotalsumdateendorsement').val("");
            $('#sliptotalsumdateendorsement2').val("");
        }else{
            $('#slipdaytotalendorsement').val(constday1);
            $('#slipdaytotalendorsement2').val(constday1);
            $('#slipdaytotalendorsement3').val(constday2);
            $('#slipdaytotalendorsement4').val(constday2);
            $('#sliptotalsumdateendorsement').val(parseFloat(sum));
            $('#sliptotalsumdateendorsement2').val(parseFloat(sum));
        }
    });

    $('#sliprpfromendorsement').change(function(){
        var date_to = $('#sliprptoendorsement').val();
        if(date_to){
            var insurance_period_from2 = $('#sliprpfrom').val();
            var insurance_period_to2 = $('#sliprpto').val();
            var newinsurance_period_from2 = insurance_period_from2.split("/").reverse().join("-");
            var newinsurance_period_to2 = insurance_period_to2.split("/").reverse().join("-");
            var days=daysBetween(newinsurance_period_from2, newinsurance_period_to2);
            var sum = isNaN(days / 365) ? 0 :(days / 365).toFixed(7);
            // var constday = days.toString() + "/365";
            var constday1 = days.toString();
            var constday2 = "365";
            console.log(insurance_period_from2)
            console.log(insurance_period_to2)
            console.log(days)
            console.log(constday1)
            console.log(constday2)
            console.log(parseFloat(sum))

            var fulltgl = $(this).val();

            var tgl = parseInt(fulltgl.substring(0,2));
            console.log('ini tgl' + tgl)
            var month = parseInt(fulltgl.substring(3,5));
            console.log('ini bln' + month)
            // var year = full.substring(6,12);

            if (tgl < 1 || tgl > 31 || month < 1 || month > 12) {
                swal("Warning","Date Format not valid, Please check again","format error")
              }else if(month == 2 && tgl > 28){
                swal("Warning","Date Format not valid, Please check again","format error")
                
              } 
            
            // $('#slipipfrom').val($(this).val());
            $('#slipdaytotalendorsement').val(constday1);
            $('#slipdaytotalendorsement2').val(constday1);
            $('#slipdaytotalendorsement3').val(constday2);
            $('#slipdaytotalendorsement4').val(constday2);
            $('#sliptotalsumdateendorsement').val(parseFloat(sum));
            $('#sliptotalsumdateendorsement2').val(parseFloat(sum));
        }
    });

</script>


<script>
    $( "#autocomplete" ).autocomplete({
      source: [
      @foreach (@$customer as $costumerdata)
       "{{@$costumerdata->company_name }}",
      @endforeach
      ]
    });

</script>
    
<script>
    $( "#autocomplete2" ).autocomplete({
        source: [
        @foreach (@$customer as $costumerdata)
        "{{@$costumerdata->company_name }}",
        @endforeach
        ]
    });

</script>


<script type="text/javascript">

    function setInputFilter(textbox, inputFilter) {
      ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
        if(textbox){
            var i;
            for (i=0; i<textbox.length; i++) {
                textbox[i].addEventListener(event, function() {
                  if (inputFilter(this.value)) {
                    this.oldValue = this.value;
                    this.oldSelectionStart = this.selectionStart;
                    this.oldSelectionEnd = this.selectionEnd;
                  } else if (this.hasOwnProperty("oldValue")) {
                    this.value = this.oldValue;
                    this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
                  } else {
                    this.value = "";
                  }
                });
            }
        }
      });
    }

    setInputFilter(document.getElementsByClassName("floatTextBox"), function(value) {
        return /^-?\d*[.,]?\d{0,3}$/.test(value) });
    setInputFilter(document.getElementsByClassName("floatTextBox2"), function(value) {
        return /^-?\d*[.,]?\d{0,10}$/.test(value) });
    setInputFilter(document.getElementsByClassName("intTextBox"), function(value) {
        return /^-?\d*$/.test(value); });

</script>

<script type="text/javascript">
    $('#mhcurrency').change(function(){
        var currency_exc = $(this).val();
        $.ajax({
                    type:"GET",
                    url:"{{url('get-kurs-detail')}}?currency_id="+currency_exc,
                    beforeSend: function() { $("body").addClass("loading");  },
                    complete: function() {  $("body").removeClass("loading"); },
                    success:function(res){  
                        console.log(res)
                        console.log('kurs ' + res.kurs)      
                        $('#mhkurs').val(res.kurs);
                    }
                });
    });
</script>

<script type="text/javascript">
    $('#mhpercent').keyup(function(e){
         var keyCode = e.keyCode || e.which;
        if(keyCode != 9){
            var percentceding = parseFloat($(this).val()) / 100 ;
            var valtsi = $('#mhshareto').val();

            if(valtsi != null){
                var tsi = $('#mhshareto').val();
                var conv_tsi = parseFloat(tsi.replace(/,/g, ""));

                var sum_amount = isNaN(percentceding * conv_tsi) ? 0 :(percentceding * conv_tsi);
                console.log(sum_amount)
                $('#mhamount').val(sum_amount);
            }
            else
            {
                swal('warning!','please fill TSI insured first','error')
            }
        }
        else{
            var percentceding = parseFloat($(this).val()) / 100 ;
            var valtsi = $('#mhshareto').val();

            if(valtsi != null){
                var tsi = $('#mhshareto').val();
                var conv_tsi = parseFloat(tsi.replace(/,/g, ""));

                var sum_amount = isNaN(percentceding * conv_tsi) ? 0 :(percentceding * conv_tsi);
                console.log(sum_amount)
                $('#mhamount').val(sum_amount);
            }
            else
            {
                swal('warning!','please fill TSI insured first','error')
            }
        }

    });

    $('#mhpercent').change(function(e){
         var keyCode = e.keyCode || e.which;
         // console.log(keycode)
        if(keyCode != 9){
            var percentceding = parseFloat($(this).val()) / 100 ;
            var valtsi = $('#mhshareto').val();

            if(valtsi != null){
                var tsi = $('#mhshareto').val();
                var conv_tsi = parseFloat(tsi.replace(/,/g, ""));

                var sum_amount = isNaN(percentceding * conv_tsi) ? 0 :(percentceding * conv_tsi);
                console.log(sum_amount)
                var real_sum = sum_amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('#mhamount').val(sum_amount);
            }
            else
            {
                swal('warning!','please fill TSI insured first','error')
            }
        }
        else{
            var percentceding = parseFloat($(this).val()) / 100 ;
            var valtsi = $('#mhshareto').val();

            if(valtsi != null){
                var tsi = $('#mhshareto').val();
                var conv_tsi = parseFloat(tsi.replace(/,/g, ""));

                var sum_amount = isNaN(percentceding * conv_tsi) ? 0 :(percentceding * conv_tsi);
                console.log(sum_amount)
                var real_sum = sum_amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('#mhamount').val(sum_amount);
            }
            else
            {
                swal('warning!','please fill TSI insured first','error')
            }
        }

    });

    $('#mhpercent').keydown(function(e){
         var keyCode = e.keyCode || e.which;
        if(keyCode != 9){
            var percentceding = parseFloat($(this).val()) / 100 ;
            var valtsi = $('#mhshareto').val();

            if(valtsi != null){
                var tsi = $('#mhshareto').val();
                var conv_tsi = parseFloat(tsi.replace(/,/g, ""));

                var sum_amount = isNaN(percentceding * conv_tsi) ? 0 :(percentceding * conv_tsi);
                console.log(sum_amount)
                var real_sum = sum_amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('#mhamount').val(sum_amount);
            }
            else
            {
                swal('warning!','please fill TSI insured first','error')
            }
        }
        else{
            var percentceding = parseFloat($(this).val()) / 100 ;
            var valtsi = $('#mhshareto').val();

            if(valtsi != null){
                var tsi = $('#mhshareto').val();
                var conv_tsi = parseFloat(tsi.replace(/,/g, ""));

                var sum_amount = isNaN(percentceding * conv_tsi) ? 0 :(percentceding * conv_tsi);
                console.log(sum_amount)
                var real_sum = sum_amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('#mhamount').val(sum_amount);
            }
            else
            {
                swal('warning!','please fill TSI insured first','error')
            }
        }

    });

    $('#mhpercent').keypress(function(e){
         var keyCode = e.keyCode || e.which;
        if(keyCode != 9){
            var percentceding = parseFloat($(this).val()) / 100 ;
            var valtsi = $('#mhshareto').val();

            if(valtsi != null){
                var tsi = $('#mhshareto').val();
                var conv_tsi = parseFloat(tsi.replace(/,/g, ""));

                var sum_amount = isNaN(percentceding * conv_tsi) ? 0 :(percentceding * conv_tsi);
                console.log(sum_amount)
                var real_sum = sum_amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('#mhamount').val(sum_amount);
            }
            else
            {
                swal('warning!','please fill TSI insured first','error')
            }
        }
        else{
            var percentceding = parseFloat($(this).val()) / 100 ;
            var valtsi = $('#mhshareto').val();

            if(valtsi != null){
                var tsi = $('#mhshareto').val();
                var conv_tsi = parseFloat(tsi.replace(/,/g, ""));

                var sum_amount = isNaN(percentceding * conv_tsi) ? 0 :(percentceding * conv_tsi);
                console.log(sum_amount)
                var real_sum = sum_amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('#mhamount').val(sum_amount);
            }
            else
            {
                swal('warning!','please fill TSI insured first','error')
            }
        }

    });
</script>

<script type="text/javascript">
    $('#mhamount').change(function(e){
         var keyCode = e.keyCode || e.which;
        if(keyCode != 9){
            var amountlocation = $(this).val();
            var conv_amountlocation = parseInt(amountlocation.replace(/,/g, ""));
            console.log(amountlocation)
            console.log(conv_amountlocation)
            var valtsi = $('#mhshareto').val();

            if(valtsi != null){
                var tsi = $('#mhshareto').val();
                var conv_tsi = parseFloat(tsi.replace(/,/g, ""));

                var sum_amount = isNaN((conv_amountlocation / conv_tsi)*100) ? 0 :((conv_amountlocation / conv_tsi)*100);
                var real_sum = sum_amount.toString();
                console.log(sum_amount)
                console.log(real_sum)
                $('#mhpercent').val(amountToString(sum_amount));
            }else{
                swal('warning!','please fill TSI insured first','error')
            }
        }
        else{
            var amountlocation = $(this).val() ;
            var conv_amountlocation = parseInt(amountlocation.replace(/,/g, ""));

            console.log(amountlocation)
            console.log(conv_amountlocation)
            var valtsi = $('#mhshareto').val();

            if(valtsi != null){
                var tsi = $('#mhshareto').val();
                var conv_tsi = parseFloat(tsi.replace(/,/g, ""));

                var sum_amount = isNaN((conv_amountlocation / conv_tsi)*100) ? 0 :((conv_amountlocation / conv_tsi)*100);
                var real_sum = sum_amount.toString();
                console.log(sum_amount)
                console.log(real_sum)
                $('#mhpercent').val(amountToString(sum_amount));
            }else{
                swal('warning!','please fill TSI insured first','error')
            }
        }

    });

    $('#mhamount').keyup(function(e){
          var keyCode = e.keyCode || e.which;
        if(keyCode != 9){
            var amountlocation = $(this).val();
            var conv_amountlocation = parseInt(amountlocation.replace(/,/g, ""));
            console.log(amountlocation)
            console.log(conv_amountlocation)
            var valtsi = $('#mhshareto').val();

            if(valtsi != null){
                var tsi = $('#mhshareto').val();
                var conv_tsi = parseFloat(tsi.replace(/,/g, ""));

                var sum_amount = isNaN((conv_amountlocation / conv_tsi)*100) ? 0 :((conv_amountlocation / conv_tsi)*100);
                var real_sum = sum_amount.toString();
                console.log(sum_amount)
                console.log(real_sum)
                $('#mhpercent').val(amountToString(sum_amount));
            }else{
                swal('warning!','please fill TSI insured first','error')
            }
        }
        else{
             var percentceding = parseFloat($('#mhpercent').val()) / 100 ;
            var valtsi = $('#mhshareto').val();

            if(valtsi != null){
                var tsi = $('#mhshareto').val();
                var conv_tsi = parseFloat(tsi.replace(/,/g, ""));

                var sum_amount = isNaN(percentceding * conv_tsi) ? 0 :(percentceding * conv_tsi);
                console.log(sum_amount)
                var real_sum = sum_amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('#mhamount').val(sum_amount);
            }
            else
            {
                swal('warning!','please fill TSI insured first','error')
            }
        }

    });

    $('#mhamount').keypress(function(e){
         var keyCode = e.keyCode || e.which;
        if(keyCode != 9){
            // var percentceding = parseFloat($('#percentceding').val()) / 100 ;
            // var valtsi = $('#feshareto').val();

            // if(valtsi != null){
            //     var tsi = $('#feshareto').val();
            //     var conv_tsi = parseFloat(tsi.replace(/,/g, ""));

            //     var sum_amount = isNaN(percentceding * conv_tsi) ? 0 :(percentceding * conv_tsi);
            console.log(sum_amount)
            //     var real_sum = sum_amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            //     $('#amountlocation').val(amountToString(sum_amount));
            // }
            // else
            // {
            //     swal('warning!','please fill TSI insured first','error')
            // }
        }
        else{
            var percentceding = parseFloat($('#mhpercent').val()) / 100 ;
            var valtsi = $('#mhshareto').val();

            if(valtsi != null){
                var tsi = $('#mhshareto').val();
                var conv_tsi = parseFloat(tsi.replace(/,/g, ""));

                var sum_amount = isNaN(percentceding * conv_tsi) ? 0 :(percentceding * conv_tsi);
                console.log(sum_amount)
                var real_sum = sum_amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('#mhamount').val(sum_amount);
            }
            else
            {
                swal('warning!','please fill TSI insured first','error')
            }
        }

    });

    $('#mhamount').keydown(function(e){
         var keyCode = e.keyCode || e.which;
        if(keyCode != 9){
            // var percentceding = parseFloat($('#percentceding').val()) / 100 ;
            // var valtsi = $('#feshareto').val();

            // if(valtsi != null){
            //     var tsi = $('#feshareto').val();
            //     var conv_tsi = parseFloat(tsi.replace(/,/g, ""));

            //     var sum_amount = isNaN(percentceding * conv_tsi) ? 0 :(percentceding * conv_tsi);
            console.log(sum_amount)
            //     var real_sum = sum_amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            //     $('#amountlocation').val(amountToString(sum_amount));
            // }
            // else
            // {
            //     swal('warning!','please fill TSI insured first','error')
            // }
        }
        else{
            var percentceding = parseFloat($('#mhpercent').val()) / 100 ;
            var valtsi = $('#mhshareto').val();

            if(valtsi != null){
                var tsi = $('#mhshareto').val();
                var conv_tsi = parseFloat(tsi.replace(/,/g, ""));

                var sum_amount = isNaN(percentceding * conv_tsi) ? 0 :(percentceding * conv_tsi);
                console.log(sum_amount)
                var real_sum = sum_amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('#mhamount').val(sum_amount);
            }
            else
            {
                swal('warning!','please fill TSI insured first','error')
            }
        }

    });
</script>

<script type="text/javascript">
    $('#mhroute').change(function(){
       var routeship = $(this).val();

        console.log(routeship);
       if(routeship){
           $.ajax({
               type:"GET",
               dataType: 'json',
               url:"{{url('get-route-list')}}?route_code="+routeship,
               success:function(response){        
                   if(response){
                       $("#mhroutefrom").val(response.route_from);
                       $("#mhrouteto").val(response.route_to);
                   }else{
                       $("#mhroutefrom").empty();
                       $("#mhrouteto").empty();
                   }
               }
           });
       }else{
           $("#mhroutefrom").empty();
           $("#mhrouteto").empty();
       }
   });
</script>

<script type="text/javascript">
     $('#shipcodetxt').change(function(){
        var shipcode = $(this).val();

        if(shipcode){
            $.ajax({
                type:"GET",
                dataType: 'json',
                url:"{{url('get-ship-list')}}?ship_code="+shipcode,
                success:function(response){        
                    if(response){
                        $("#shipnametxt").val(response.shipname);
                    }else{
                        $("#shipnametxt").empty();
                    }
                }
            });
        }else{
            $("#shipnametxt").empty();
        }
    });
</script>

<script type='text/javascript'>
     $('#form-addship').submit(function(e)
     {
        e.preventDefault();
        
        $(this).submit(function() {
			return false;
		});

        var shipcode = $('#shipcodetxt').val();
        var shipname = $('#shipnametxt').val();
        var insured_id = $('#mhnumber').val();
        var ceding = $('#mhcedinglist').val();
        var cndn = $('#mhcndn').val();
        var certno = $('#mhcertno').val();
        var slipno = $('#mhslipno').val();
        var policyno = $('#mhpolicyno').val();
        var percent = $('#mhpercent').val();
        var amount = $('#mhamount').val();
        var token = $('input[name=_token]').val();
        var slip_type = 'mh';

        var conv_amount = amount.replace(/,/g, "");
       console.log('conv_amount ' + conv_amount)
       var real_amount = parseFloat(conv_amount);
       console.log('real_amount ' + real_amount)

       console.log('shipcode ' + shipcode )
       console.log('shipname ' + shipname)
       console.log('insured_id ' + insured_id)
       console.log('ceding ' + ceding )
       console.log('percent ' + percent )
       console.log('cndn ' + cndn )
       console.log('certno ' + certno )
       console.log('slipno ' + slipno )
       console.log('policyno ' + policyno )
       console.log('slip_type ' + slip_type )
        
        $.ajax({
            url:"{{ route('shiplist.store') }}",
            type:"POST",
            data:{
                ship_code:shipcode,
                insuredID:insured_id,
                slipamount:real_amount,
                ceding:ceding,
                cndn:cndn,
                certno:certno,
                slipno:slipno,
                policyno:policyno,
                percent:percent,
                sliptype:slip_type,
                _token:token
            },
            beforeSend: function() { $("body").addClass("loading");  },
            complete: function() {  $("body").removeClass("loading"); },
            success:function(response)
            {

                console.log(response)

                if(response.success==true)
                {
                    $('#mhnumber').val(response.insured_id)
                    $('#shipcodetxt').val('').trigger('change');
                    $('#mhcedinglist').val('').trigger('change');
                    if(response.totalpercent<=100)
                    {

                            var amount = response.amount;
                            var ceding_share = $('#mhshare').val();
                            if(ceding_share == ''){
                                var sum_ceding = isNaN(parseFloat(0) + parseFloat(amount)) ? 0 :(parseFloat(0) + parseFloat(amount));
                                var conv_sum_ceding = sum_ceding.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                $('#mhshare').val(amountToString(sum_ceding));
                                // $('#feshare2').val(conv_sum_ceding);
                                console.log('ceding awal' + conv_sum_ceding)
                            }else{
                                var conv_ceding_share = ceding_share.replace(/,/g, "");
                                var real_ceding_share = parseFloat(conv_ceding_share);
                                var sum_ceding = isNaN(parseFloat(real_ceding_share) + parseFloat(amount)) ? 0 :(parseFloat(real_ceding_share) + parseFloat(amount));
                                var conv_sum_ceding = sum_ceding.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                $('#mhshare').val(amountToString(sum_ceding));
                                // $('#feshare2').val(conv_sum_ceding);
                                console.log('ceding bertambah' + conv_sum_ceding)
                            }


                            console.log('amount' + amount)
                            var fl_amount = parseFloat(amount);
                            console.log('amount float' + fl_amount)
                            var new_amount = fl_amount;
                            console.log('amount to fixed' + new_amount)
                            var curr_amount = new_amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            console.log('current amount' + curr_amount) 

                            var cndn = '';
                            var certno = '';
                            var slipno = '';
                            var policyno = '';

                            var percent = response.percentage;
                            var percentfl = parseFloat(percent);
                            var new_percent = percentfl;

                            if(response.cndn == null){
                                cndn = '-';
                            }else{
                                cndn = response.cndn;
                            }

                            if(response.certno == null){
                                certno = '-';
                            }else{
                                certno = response.certno;
                            }

                            if(response.slipno == null){
                                slipno = '-';
                            }else{
                                slipno = response.slipno;
                            }

                            if(response.policyno == null){
                                policyno = '-';
                            }else{
                                policyno = response.policyno;
                            }

                            $('#shipdetailTable > tbody:last-child').prepend('<tr id="sid'+response.id+'"  data-name="shiplistvalue[]">'+
                                '<td data-name="'+response.ship_code+'">'+response.ship_code+'</td>'+
                                '<td data-name="'+response.ship_name+'">'+response.ship_name+'</td>'+
                                '<td>'+response.code_ceding+ '-' + response.name_ceding +'</td>'+
                                '<td>'+cndn+'</td>'+
                                '<td>'+certno+'</td>'+
                                '<td>'+slipno+'</td>'+
                                '<td>'+policyno+'</td>'+
                                '<td>'+new_percent+' %</td>'+
                                '<td>'+amountToString(parseFloat(amount).toFixed(2))+'</td>'+
                                '<td><a href="javascript:void(0)" onclick="deleteshipdetail('+response.id+')">'+
                                '<i class="fas fa-trash text-danger"></i></a></td>'+
                                '</tr>')

                            $("#slipcedingbroker option[value='placeholder']").remove();
                            $("#slipcedingbroker").append('<option value="'+response.id_ceding+'">'+response.code_ceding+' - '+response.name_ceding+'</option>');
                            $("#slipcedingbroker").append('<option value="placeholder" selected >Ceding or Broker</option>');
                            
                            
                            console.log("ceding id tambahan " + response.id_ceding)
                            console.log("ceding code tambahan " + response.code_ceding)
                            console.log("ceding name tambahan " + response.name_ceding)
                            

                            if(response.sumceding)
                            {
                                    $('table#shipdetailTable tr#totalamount').empty();
                                    $('tbody#totalamount').empty();
                                    var total_amount_ceding = response.sumceding;
                                    
                                    for(var i = 0; i < total_amount_ceding.length; i++)
                                    {

                                        var name = total_amount_ceding[i].name;
                                        var amount_ceding = total_amount_ceding[i].amount;
                                        console.log('amount' + amount_ceding)
                                        var fl_amount = parseFloat(amount_ceding);
                                        console.log('amount float' + fl_amount)
                                        var new_amount = fl_amount;
                                        console.log('amount to fixed' + new_amount)
                                        var curr_amount = fl_amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                        console.log('current amount' + curr_amount)

                                        var percent = total_amount_ceding[i].percentage;
                                        var percentfl = parseFloat(percent);
                                        // var new_percent = percentfl;

                                        $('table#shipdetailTable tr#placetotal').after('<tr id="totalamount">'+
                                        '<td colspan="2"></td>'+
                                        '<td colspan="5" >'+name+'</td>'+
                                        '<td>'+floatToString(percentfl)+'%</td>'+
                                        '<td>'+amountToString(fl_amount)+'</td>'+
                                        '</tr>');

                                    };
                            }



                        $('#ModalAddShip').modal('toggle');
                        $('#form-addship')[0].reset();
                        $('#ModalAddShip #shipcodetxt').val("").trigger('change');

                        swal("Success!", "Ship Added Successfully")
                    }
                    else
                    {       
                        toastr.warning("Percent More Than 100%");
                    }
                }
                else
                {
                    toastr.warning("Data duplicated");
                }

            },
            error: function (request, status, error) {
                //alert(request.responseText);
                //swal("Error!", "Ship Added Error", "Ship Added Data Error");
                swal("Error!", request.responseText, "Get Ceding / Ship Error");
            }
        });

        return true;
    });
</script>



<script type='text/javascript'>
     $('#form-hulltypecount').submit(function(e){
        e.preventDefault();

        //var shipcode = $('#shipcodetxt').val();
        //var shipname = $('#shipnametxt').val();
        var slip_id = $('#slipnumber').val();
        var insured_id = $('#mhnumber').val();
        var type_id = $('#mhtype').val();
        var share = $('#mhtypeshare').val();
        var mhtypeamount = $('#mhtypeamount').val();
        var rate = $('#mhtyperate').val();
        var mhtypepremi = $('#mhtypepremi').val();
        var token = $('input[name=_token]').val();
        var slip_type = 'mh';
       

       var conv_amount = mhtypeamount.replace(/,/g, "");
       console.log('conv_amount ' + conv_amount)
       var amount = parseFloat(conv_amount);
       console.log('real_amount ' + amount)

       var conv_premi = mhtypepremi.replace(/,/g, "");
       console.log('conv_premi ' + conv_premi)
       var basic_premium = parseFloat(conv_premi);
       console.log('real_premi ' + basic_premium)

       
        $.ajax({
            url:"{{ route('hullcount.store') }}",
            type:"POST",
            data:{
                insured_id:insured_id,
                slip_id:slip_id,
                type_id:type_id,
                share:share,
                amount:amount,
                rate:rate,
                basic_premium:basic_premium,
                sliptype:slip_type,
                _token:token
            },
            beforeSend: function() { $("body").addClass("loading");  },
            complete: function() {  $("body").removeClass("loading"); },
            success:function(response){
                console.log(response)
                if(response.success == true){
                    $('#ModalCountHull').modal('toggle');
                    var amount = response.amount;

                    console.log('amount' + amount)
                    var fl_amount = parseFloat(amount);
                    console.log('amount float' + fl_amount)
                    var new_amount = fl_amount;
                    console.log('amount to fixed' + new_amount)
                    var curr_amount = new_amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    console.log('current amount' + curr_amount) 

                    var premi = response.premi;

                    console.log('amount' + premi)
                    var fl_premi = parseFloat(premi);
                    console.log('amount float' + fl_premi)
                    var new_premi = fl_premi;
                    console.log('amount to fixed' + new_premi)
                    var curr_premi = new_premi.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    console.log('current amount' + curr_premi) 

                    $('#marineHullCountTable > tbody:last-child').prepend('<tr id="sidhull'+response.id+'"  data-name="hulllistvalue[]">'+
                        '<td data-name="'+response.type_code+'">'+response.type_name+'</td>'+
                        '<td data-name="'+response.share+'">'+response.share+'</td>'+
                        '<td>'+amountToString(response.amount)+'</td>'+
                        '<td>'+floatToString(response.rate)+'</td>'+
                        '<td>'+amountToString(response.premi)+'</td>'+
                        '<td><a href="javascript:void(0)" onclick="deletehullcountdetail('+response.id+')">'+
                        '<i class="fas fa-trash text-danger"></i></a></td>'+
                        '</tr>')
                    
                                      
                    if(response.sum_share){
                        var sumshare = response.sum_share;       
                        $('#totalhullshare').val(sumshare);
                    }
                    else
                    {
                        $('#totalhullshare').val(0);
                    }

                    if(response.sum_amount){
                        var sumamount = response.sum_amount;
                        var fl_amount = parseFloat(sumamount);
                        var new_amount = fl_amount;
                        var curr_amount = new_amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        $('#totalhullamount').val(amountToString(response.sum_amount));

                    }
                    else
                    {
                        $('#totalhullamount').val(0);
                    }

                    if(response.sum_premi){
                        var sumpremi = response.sum_premi;
                        var fl_premi = parseFloat(sumpremi);
                        var new_premi = fl_premi;
                        var curr_premi = new_premi.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        $('#totalhullpremi').val(amountToString(response.sum_premi));
                    
                    }
                    else
                    {
                        $('#totalhullpremi').val(0);
                    }
                }else{
                    toastr.warning(response.message);
                }
                

            }
        });  

    });
</script>

<script type='text/javascript'>
    function deleteshipdetail(id){
        var token = $('input[name=_token]').val();

        $.ajax({
            url:'{{ url("/") }}/delete-ship-list/'+id,
            type:"DELETE",
            data:{
                _token:token
            },
            beforeSend: function() { $("body").addClass("loading");  },
            complete: function() {  $("body").removeClass("loading"); },
            success:function(response){
                
                $('#sid'+id).remove();
                console.log(response);
                if(response.sumceding)
                                    {
                    $('table#shipdetailTable tr#totalamount').empty();
                    $('tbody#totalamount').empty();
                    var total_amount_ceding = response.sumceding;
                    
                    for(var i = 0; i < total_amount_ceding.length; i++)
                    {

                        var name = total_amount_ceding[i].name;
                        var amount_ceding = total_amount_ceding[i].amount;
                        console.log('amount' + amount_ceding)
                        var fl_amount = parseFloat(amount_ceding);
                        console.log('amount float' + fl_amount)
                        var new_amount = fl_amount;
                        console.log('amount to fixed' + new_amount)
                        var curr_amount = fl_amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        console.log('current amount' + curr_amount)

                        var percent = total_amount_ceding[i].percentage;
                        var percentfl = parseFloat(percent);
                        // var new_percent = percentfl;

                        $('table#shipdetailTable tr#placetotal').after('<tr id="totalamount">'+
                        '<td colspan="2"></td>'+
                        '<td colspan="5" >'+name+'</td>'+
                        '<td>'+floatToString(percentfl)+'%</td>'+
                        '<td>'+amountToString(fl_amount)+'</td>'+
                        '</tr>');

                    };
            }
            }
        });
    }
</script>


<script type='text/javascript'>
    function deletehullcountdetail(id)
    {
        var token = $('input[name=_token]').val();

        $.ajax({
            url:'{{ url("/") }}/delete-hull-count/'+id,
            type:"DELETE",
            data:{
                _token:token
            },
            beforeSend: function() { $("body").addClass("loading");  },
            complete: function() {  $("body").removeClass("loading"); },
            success:function(response){
                
                
                if(response.sum_share){
                    var sumshare = response.sum_share;       
                    $('#totalhullshare').val(sumshare);
                }
                else
                {
                    $('#totalhullshare').val(0);
                }

                if(response.sum_amount){
                    var sumamount = response.sum_amount;
                    var fl_amount = parseFloat(sumamount);
                    var new_amount = fl_amount;
                    var curr_amount = new_amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    $('#totalhullamount').val(amountToString(response.sum_amount));

                }
                else
                {
                    $('#totalhullamount').val(0);
                }

                if(response.sum_premi){
                    var sumpremi = response.sum_premi;
                    var fl_premi = parseFloat(sumpremi);
                    var new_premi = fl_premi;
                    var curr_premi = new_premi.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    $('#totalhullpremi').val(amountToString(response.sum_premi));
                
                }
                else
                {
                    $('#totalhullpremi').val(0);
                }

                $('#sidhull'+id).remove();

                console.log(response);
            }
        });
    }
</script>

<script type="text/javascript">
  
    //triggered when modal is about to be shown
    $('#detailmodaldata').on('show.bs.modal', function(e) {

        //get data-id attribute of the clicked element
        var codesl = $(e.relatedTarget).data('book-id');

        //alert(codesl);
        if(codesl)
        {
            $.ajax({
            url:'{{ url("/") }}/transaction-data/detailmarinehullslip/'+codesl,
            type:"GET",
            beforeSend: function() { $("body").addClass("loading");  },
            complete: function() {  $("body").removeClass("loading"); },
            success:function(response)
            {
                console.log('bisa tampil')
                console.log(response);
                console.log('number : ' + response.number);
                $('#numberslipdetail').val(response.number);
                $('#slipusernamedetail').val(response.username);
                $('#slipprodyeardetail').val(response.prod_year);
                $('#slipuydetail').val(response.uy);
                $('#slipeddetail').val(response.endorsment);
                $('#slipslsdetail').val(response.selisih);
                $('#wpcdetail').val(response.wpc);
                $('#slipvbrokerdetail').val(floatToString(response.v_broker));


                    if(response.deductible_panel && response.deductible_panel.length > 10)
                    {

                        var deductibledata = JSON.parse(response.deductible_panel); 
                        $('#deductiblePaneldetail tbody').empty();
                        for(var i = 0; i < deductibledata.length; i++) 
                        {
                            var obj = deductibledata[i];

                            //console.log(obj.id);
                            //$('#interestInsuredTabledetail tbody').append('');
                            // var curr_amount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(obj.amount);
                            if(obj.amount)
                            {
                            

                            $('#deductiblePaneldetail tbody').append('<tr id="iiddeductible'+obj.id+'" data-name="deductibledetailvalue[]"><td data-name="'+obj.deductibletype+'">'+obj.deductibletype+'</td><td data-name="'+floatToString(parseFloat(obj.percentage).toFixed(5).toString())+'">'+floatToString(parseFloat(obj.percentage).toFixed(5).toString())+'%</td><td data-name="'+amountToString(obj.amount)+'">'+amountToString(obj.amount)+'</td><td data-name="'+amountToString(obj.min_claimamount)+'">'+amountToString(obj.min_claimamount)+'</td><td></td></tr>');
                            }
                        }
                    }


                    if(response.condition_needed && response.condition_needed.length > 10)
                    {

                        var condition_needed = JSON.parse(response.condition_needed); 
                        $('#ConditionNeededDetail tbody').empty();
                        for(var i = 0; i < condition_needed.length; i++) 
                        {
                            var obj = condition_needed[i];
                            //console.log(obj.id);
                            //$('#interestInsuredTabledetail tbody').append('');
                            // var curr_amount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(obj.amount);
                            //var conv_amount = parseFloat(obj.amount).toFixed(2);
                            //var str_amount = conv_amount.toString();
                            //var curr_amount = str_amount.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            // var curr_amount = obj.amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            //var conv_percent = parseFloat(obj.percentage).toFixed(3);
                            
                            $('#ConditionNeededDetail tbody').append('<tr id="cniddetail'+obj.id+'" data-name="extendcoveragedetailvalue[]"><td data-name="'+obj.cncode+'">'+obj.cncode + ' - ' + obj.cnname+'</td><td data-name="'+obj.cndesc+'">'+obj.cndesc+'</td></tr>');
                            
                        }
                    }


                    if(response.installment_panel && response.installment_panel.length > 10)
                    {

                        var installment_panel = JSON.parse(response.installment_panel); 
                        $('#installmentPaneldetail tbody').empty();
                        for(var i = 0; i < installment_panel.length; i++) 
                        {
                            var obj = installment_panel[i];
                            var currdate = obj.installment_date;
                            var convdate = currdate.split("-").reverse().join("/");
                            console.log('conv date ' + convdate)
                            var strdate = convdate.toString();

                            //console.log(obj.id);
                            //$('#interestInsuredTabledetail tbody').append('');
                        
                            
                            $('#installmentPaneldetail tbody').append('<tr id="iidinstallmentdetail'+obj.id+'" data-name="installmentdetailvalue[]"><td data-name="'+obj.installment_date+'">'+strdate+'</td><td data-name="'+floatToString(parseFloat(obj.percentage).toFixed(5).toString())+'">'+floatToString(parseFloat(obj.percentage).toFixed(5).toString())+'%</td><td data-name="'+amountToString(obj.amount)+'">'+amountToString(obj.amount)+'</td><td></td></tr>')

                        }
                    }
                    $('#sliptdendorsement2').val(response.date_transfer);

                    $('#marineHullCountTableDetail tbody').empty();
                    if(response.hull_data && response.hull_data.length > 10)
                    {
                        var hull_panel = JSON.parse(response.hull_data); 
                      
                        for(var i = 0; i < hull_panel.length; i++) 
                        {
                            var obj = hull_panel[i];

                            


                            $('#marineHullCountTableDetail > tbody:last-child').append('<tr id="hcdetailid'+obj.id+'"  data-name="">'+
                                        '<td>'+obj.hullcode+ '-' + obj.hulltype+'</td>'+
                                        '<td>'+floatToString(parseFloat(obj.share).toFixed(5))+'</td>'+
                                        '<td>'+amountToString(obj.amount)+'</td>'+
                                        '<td>'+floatToString(parseFloat(obj.rate).toFixed(5))+'</td>'+
                                        '<td>'+amountToString(obj.basic_premium)+'</td>'+
                                        '</tr>')

                        }
                    }

                
                    if(response.retrocession_panel && response.retrocession_panel.length > 10)
                    {

                        var retrocession_panel = JSON.parse(response.retrocession_panel); 
                        $('#retrocessionPaneldetail tbody').empty();
                        for(var i = 0; i < retrocession_panel.length; i++) 
                        {
                            var obj = retrocession_panel[i];
                            // var curr_amount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(obj.amount);
                            
                            
                            
                            $('#retrocessionPaneldetail tbody').append('<tr id="iidretrocessiondetail'+obj.id+'" data-name="retrocessiondetailvalue[]"><td data-name="'+obj.contract+'">'+obj.contract+'</td><td data-name="'+floatToString(obj.percentage)+'">'+floatToString(parseFloat(obj.percentage).toFixed(5).toString())+'%</td><td data-name="'+amountToString(obj.amount)+'">'+amountToString(obj.amount)+'</td><td></td></tr>');

                        }
                    }
                    
                    
                    if(response.status)
                    {
                        $("#slipstatusdetail").val(response.status);
                        
                    // $("#slipstatusdetail option").attr('hidden',true);
                    // $("#slipstatusdetail option[value=" + response.status + "]:first")[0].hidden = false;
                    // $("#slipstatusdetail option[value=" + response.status + "]:first")[0].selected = true;
                    }

                    if(response.source)
                    {
                        if( $("#slipcedingbrokerdetail option[value=" + response.source + "]:first")[0])
                        {
                        $("#slipcedingbrokerdetail option").attr('hidden',true);
                        $("#slipcedingbrokerdetail option[value=" + response.source + "]:first")[0].hidden = false;
                        $("#slipcedingbrokerdetail option[value=" + response.source + "]:first")[0].selected = true;
                        }
                    }

                    if(response.source_2)
                    {
                        if($("#slipcedingdetail option[value=" + response.source_2 + "]:first")[0])
                        {
                        $("#slipcedingdetail option").attr('hidden',true);
                        $("#slipcedingdetail option[value=" + response.source_2 + "]:first")[0].hidden = false;
                        $("#slipcedingdetail option[value=" + response.source_2 + "]:first")[0].selected = true;
                        }
                    }

                    if(response.currency)
                    {
                        $("#slipcurrencydetail option[value=" + response.currency + "]:first")[0].selected = true;
                    }
                    
                    if(response.cob)
                    {
                        $("#slipcobdetail option[value=" + response.cob + "]:first")[0].selected = true;
                    }

                

                    if(response.occupacy)
                    {
                        //$("#slipoccupacydetail option[value=" + response.occupacy + "]:first")[0].selected = true;
                    }

                    if(response.build_const)
                    {
                        $("#slipbld_constdetail option").attr('hidden',true);
                        $("#slipbld_constdetail option[value='" + response.build_const + "']:first")[0].hidden = false;
                        $("#slipbld_constdetail option[value='" + response.build_const + "']:first")[0].selected = true;
                    }

                    $("#slipbcuadetail").val(response.build_rate_up);
                    $("#slipbcladetail").val(response.build_rate_down);

                    if(response.insured_type)
                    {
                        $("#sliptypedetail option[value=" + response.insured_type + "]:first")[0].selected = true;
                    }

                    if(response.layer_non_proportional)
                    {
                        $("#sliplayerproportionaldetail option[value=" + response.layer_non_proportional + "]:first")[0].selected = true;
                    }

                    

                    if(response.retro_backup)
                    {
                        // $("#sliprbdetail option[value=" + response.retro_backup + "]:first")[0].selected = true;
                        if(response.retro_backup == "NO")
                        {
                            $("#tabretrodetail").attr('hidden','true');
                        }
                        else if(response.retro_backup == "YES"){
                            $("#tabretrodetail").removeAttr('hidden');
                        }
                    }

                    if(response.type_tsi)
                    {
                        if($("#sliptypetsidetail option[value=" + response.type_tsi + "]:first")[0])
                        {
                        $("#sliptypetsidetail option[value=" + response.type_tsi + "]:first")[0].selected = true;
                        }
                    }

                    if(response.type_share_tsi)
                    {
                        if($("#sharetypetsidetail option[value=" + response.type_share_tsi + "]:first")[0])
                        {
                        $("#sharetypetsidetail option[value=" + response.type_share_tsi + "]:first")[0].selected = true;
                        }
                    }


                    if(response.status_log)
                    {
                            $('#statuslogdetailform tbody').empty();
                            var status_log = response.status_log;
                            
                            for(var i = 0; i < status_log.length; i++){

                                var status = status_log[i].status;
                                var datetime = status_log[i].datetime;
                                var user = status_log[i].user;

                                $('#statuslogdetailform tbody').append('<tr id="stlid'+status_log[i].id+'"> <td>'+status+'</td> <td >'+ datetime +'</td> <td>'+user+'</td> </tr>')
                                // $('#statlistdetail').append('<li><div class="control-group input-group" id="control-group2" style="margin-top:10px">'+datetime+' - '+ status + ' - ' + user +'</div></li>')
                        
                        };
                    }

                    console.log('status log')
                    console.log(response.status_log)


                if(response.attacment_file)
                {
                    $('#aidlistdetail li').remove();
                    var attacment_file = response.attacment_file;
                    for(var i = 0; i < attacment_file.length; i++){
                        var filename = attacment_file[i].filename;
                        $('#aidlistdetail').append('<li><div class="control-group input-group" id="control-group2" style="margin-top:10px"><a href="{{ asset("files")}}/'+filename+'">'+filename+'</a></div></li>')
                    };
                }


                $('#slipnodetail').val(response.slip_no);
                $('#slipcndndetail').val(response.cn_dn);
                $('#slippolicy_nodetail').val(response.policy_no);

                if(response.total_sum_insured){
                    var conv_tsi = parseFloat(response.total_sum_insured).toFixed(2);
                    $('#sliptotalsumdetail').val(amountToString(response.total_sum_insured));
                }
                else
                {
                    $('#sliptotalsumdetail').val("0");
                }

                if(response.share_tsi){
                    var conv_stsi = amountToString(response.share_tsi);
                    $('#sharetotalsumdetail').val(conv_stsi);
                    $('#sharetotalsumdetail2').val(conv_stsi);
                }
                else
                {
                    $('#sharetotalsumdetail').val("0");
                    $('#sharetotalsumdetail2').val("0");
                }

                if(response.insured_pct){
                    $('#slippctdetail').val(amountToString(response.insured_pct));
                }else{
                    $('#slippctdetail').val("0");
                }
                


                if(response.total_sum_pct){
                    var conv_spct = amountToString(response.total_sum_pct);
                    $('#sliptotalsumpctdetail').val(amountToString(response.total_sum_pct));
                }
                else{
                    $('#sliptotalsumpctdetail').val("0");
                }

                if(response.date_transfer == null || response.date_transfer == "" )
                {
                    $('#sliptddetail').val(''); 

                }else{
                        $('#sliptddetail').val(response.date_transfer); 
                }
                
                $('#slipipfromdetail').val(response.insurance_period_from);
                $('#slipiptodetail').val(response.insurance_period_to);

                var insurance_period_from2 = response.insurance_period_from.split("/").reverse().join("-");
                var insurance_period_to2 = response.insurance_period_to.split("/").reverse().join("-");
                var days=daysBetween(insurance_period_from2, insurance_period_to2);
                
                var sum = isNaN(days / 365) ? 0 :(days / 365).toFixed(7);
                var constday = days.toString() + "/365";

                console.log(insurance_period_from2)
                console.log(insurance_period_to2)
                console.log(days)
                console.log(constday)
                console.log(parseFloat(sum))

                
                

                $('#slipdaytotaldetail').val(days);
                $('#slipdaytotaldetail2').val(days);
                $('#slipdaytotaldetail3').val("365");
                $('#slipdaytotaldetail4').val("365");
            
                $('#sliptotalsumdatedetail').val(parseFloat(sum));


                $('#sliprpfromdetail').val(response.reinsurance_period_from);
                $('#sliprptodetail').val(response.reinsurance_period_to);

                $('#switch-proportionaldetail').val(response.proportional);
                    // if(response.proportional == ''){
                        $("#btnaddlayerdetail").attr('hidden','true');
                        $("#sliplayerproportionaldetail").attr('hidden','true');
                        $("#labelnonpropdetail").attr('hidden','true');
                        $("#labelnpdetail").attr('hidden','true');
                    // }
                    if(response.rate){
                        $('#slipratedetail').val(floatToString(parseFloat(response.rate).toFixed(5).toString()));
                    }else{
                        $('#slipratedetail').val("0");
                    }
                    
                    if(response.share){
                        $('#slipsharedetail').val(floatToString(response.share));
                    }else{
                        $('#slipsharedetail').val("0");
                    }
                    

                    if(response.sum_share){
                        var conv_sshare = parseFloat(response.sum_share).toFixed(2);
                        $('#slipsumsharedetail').val(amountToString(response.sum_share));
                        $('#slipsumsharedetail2').val(amountToString(response.sum_share));
                    }
                    else{
                        $('#slipsumsharedetail').val("0");
                        $('#slipsumsharedetail2').val("0");
                    }

                    if(response.sum_rate){
                        var conv_srate = parseFloat(response.sum_rate).toFixed(5).toString();
                        $('#sliptotalratedetail').val(conv_srate);
                        $('#sliptotalratedetail').val(conv_srate);
                    }

                    if(response.sum_feebroker){
                        var conv_sf = amountToString(response.sum_feebroker);
                        $('#slipsumfeedetail').val(conv_sf);
                        $('#slipsumfeedetail2').val(conv_sf);
                    }
                    else{
                        $('#slipsumfeedetail').val("0");
                        $('#slipsumfeedetail2').val("0");
                    }


                    if(response.basic_premium){
                        var conv_bp =  parseFloat(response.basic_premium).toFixed(2);
                        $('#slipbasicpremiumdetail').val(amountToString(response.basic_premium));
                    }else
                    {
                        $('#slipbasicpremiumdetail').val("0");
                    }
                    
                    if(response.grossprm_to_nr){
                        var conv_gprtnr = parseFloat(response.grossprm_to_nr).toFixed(2);
                        $('#slipgrossprmtonrdetail').val(amountToString(response.grossprm_to_nr));
                        $('#slipgrossprmtonrdetail2').val(amountToString(response.grossprm_to_nr));
                    
                    }
                    else{
                        $('#slipgrossprmtonrdetail').val("0");
                        $('#slipgrossprmtonrdetail2').val("0");
                    }

                    if(response.commission){

                        $('#slipcommissiondetail').val(amountToString(response.commission));
                    }
                    else{
                        $('#slipcommissiondetail').val(0);
                    }
                    

                    if(response.sum_commission){
                        var conv_sc = parseFloat(response.sum_commission).toFixed(2);
                        $('#slipsumcommissiondetail').val(amountToString(response.sum_commission));
                        $('#slipsumcommissiondetail2').val(amountToString(response.sum_commission));
                    
                    }
                    else{
                        $('#slipsumcommissiondetail').val("0");
                        $('#slipsumcommissiondetail2').val("0");

                    }

                    if(response.netprm_to_nr){
                        var conv_nprmtnr = parseFloat(response.netprm_to_nr).toFixed(2);
                        $('#slipnetprmtonrdetail').val(amountToString(response.netprm_to_nr));
                        $('#slipnetprmtonrdetail2').val(amountToString(response.netprm_to_nr)); 
                    }
                    else{
                        $('#slipnetprmtonrdetail').val("0"); 
                        $('#slipnetprmtonrdetail2').val("0"); 
                    }

                    if(response.own_retention){
                        $('#slipordetail').val(parseFloat(response.own_retention).toFixed(2));
                    }
                    else{
                        $('#slipordetail').val(0);
                    }

                    if(response.sum_own_retention){
                        var conv_sor = parseFloat(response.sum_own_retention).toFixed(2);
                        $('#slipsumordetail').val(conv_sor.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                    }
                    else{
                        $('#slipsumordetail').val("0");
                    }

                    $('#countendorsmentdetail').val(response.endorsment);
                    $('#countendorsmentdetail2').val(response.endorsment);
                    $('#remarksdetail').val(response.remarks);
                    
                    if(response.koc)
                    {
                        if($("#slipkocdetail option[value=" + response.koc + "]:first")[0])
                        {
                           $("#slipkocdetail option[value=" + response.koc + "]:first")[0].selected = true;
                        }
                    }
                    
                    swal("Success!", "Data Show")
                    console.log(response)


                },
                error: function (request, status, error) {
                    //alert(request.responseText);
                    swal("Error!", "Get Slip Data Error", "Get Data Error");
                }
            });

        }
    });

</script>

<script type="text/javascript">
    // Handler for change btn update
    $("#updatemodaldata input").on({
        change: function() {
            checkingUpdate()
        },
        keyup: function() {
            checkingUpdate()
        }
    });
    $("#updatemodaldata textarea").on({
        change: function() {
            checkingUpdate()
        },
        keyup: function() {
            checkingUpdate()
        }
    });

    $('#updatemodaldata').on('hidden.bs.modal', function(e) {
        $('#btnUpdate').removeClass("btn-success");
    });
    function checkingUpdate(){
        if (!$('#btnUpdate').hasClass("btn-success")) {
            $('#btnUpdate').addClass("btn-success");     
        }
    }
    //triggered when modal is about to be shown
    $('#updatemodaldata').on('show.bs.modal', function(e) {

        // $("#tabretroupdate").attr('hidden','true');

         //get data-id attribute of the clicked element
         var codesl = $(e.relatedTarget).data('book-id');
        
        if(codesl)
        {
            $.ajax({
                url:'{{ url("/") }}/transaction-data/detailmarinehullslip/'+codesl,
                type:"GET",
                beforeSend: function() { $("body").addClass("loading");  },
                complete: function() {  $("body").removeClass("loading"); },
                success:function(response)
                {
                    $("body").removeClass("loading");
                    $('#insuredIDtxtupdate').val(response.insured_id);
                    $('#slipnumberupdate').val(response.number);
                    $('#slipusernameupdate').val(response.username);
                    $('#slipprodyearupdate').val(response.prod_year);
                    $('#slipprodyearupdate2').val(response.prod_year);
                    $('#slipuyupdate').val(response.uy);
                    $('#slipedupdate').val(response.endorsment);
                    $('#slipslsupdate').val(response.selisih);
                    $('#wpcupdate').val(response.wpc);
                    $('#remarksupdate').val(response.remarks);
                    
                    // $('#sliptotalnilaiecupdate').val(response.sum_ec);

                    $('#sliptotalpercentinspanupdate').val(response.sum_ippercent);

                        if(response.deductible_panel && response.deductible_panel.length > 10)
                        {
                            var deductibledata = JSON.parse(response.deductible_panel); 

                            $('#deductiblePanelupdate tbody').empty();
                            for(var i = 0; i < deductibledata.length; i++) 
                            {
                                var obj = deductibledata[i];

                                if(obj.amount)
                                {
                                    var conv_amount = parseFloat(obj.amount).toFixed(2);
                                    var str_amount = conv_amount.toString();
                                    var curr_amount = str_amount.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    // var curr_minamount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(obj.min_claimamount);
                                    var conv_minamount = parseFloat(obj.min_claimamount).toFixed(2);
                                    var str_minamount = conv_minamount.toString();
                                    var curr_minamount = str_minamount.replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                                    var conv_percent = parseFloat(obj.percentage).toFixed(5);

                                    
                                    $('#deductiblePanelupdate tbody').append('<tr id="iiddeductibleupdate'+obj.id+'" data-name="deductibleupdatevalue[]"><td data-name="'+obj.deductibletype+'">'+obj.deductibletype+'</td><td data-name="'+floatToString(conv_percent)+'">'+floatToString(conv_percent)+'%</td><td data-name="'+amountToString(obj.amount)+'">'+amountToString(obj.amount)+'</td><td data-name="'+amountToString(obj.min_claimamount)+'">'+amountToString(obj.min_claimamount)+'</td><td><a href="javascript:void(0)" onclick="deletedeductibleupdate('+obj.id+')">delete</a></td></tr>');
                                }
                            }
                        }


                        if(response.condition_needed && response.condition_needed.length > 10)
                        {

                            var condition_needed = JSON.parse(response.condition_needed); 
                            $('#conditionNeededUpdate tbody').empty();
                            for(var i = 0; i < condition_needed.length; i++) 
                            {
                                var obj = condition_needed[i];

                                //console.log(obj.id);
                                //$('#interestInsuredTabledetail tbody').append('');
                                // var curr_amount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(obj.amount);
                                //var conv_amount = parseFloat(obj.amount).toFixed(2);
                                //var str_amount = conv_amount.toString();
                                //var curr_amount = str_amount.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                // var curr_amount = obj.amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                //var conv_percent = parseFloat(obj.percentage).toFixed(3);
                                
                                $('#conditionNeededUpdate tbody').append('<tr id="cnidupdate'+obj.id+'" data-name="extendcoveragedetailvalue[]"><td data-name="'+obj.cncode+'">'+obj.cncode + ' - ' + obj.cnname+'</td><td data-name="'+obj.cndesc+'">'+obj.cndesc+'</td><td><a href="javascript:void(0)" onclick="deleteconditionneededupdate('+obj.id+')">delete</a></td></tr>');
                                
                            }
                        }

                        $('#marineHullCountTableUpdate tbody').empty();

                        if(response.hull_data && response.hull_data.length > 10)
                        {
                            var hull_panel = JSON.parse(response.hull_data); 
                           
                            $('#marineHullCountTableUpdate2 tbody').empty();
                            for(var i = 0; i < hull_panel.length; i++) 
                            {
                                var obj = hull_panel[i];
                    
                                
                                var rate = parseFloat(obj.rate).toFixed(5).toString();
                                var share = parseFloat(obj.share).toFixed(5).toString();
                                                                                                
                                $('#marineHullCountTableUpdate > tbody:last-child').append('<tr id="hcupdateid'+obj.id+'"  data-name="">'+
                                            '<td>'+obj.hullcode+ '-' + obj.hulltype+'</td>'+
                                            '<td>'+floatToString(share)+'</td>'+
                                            '<td>'+amountToString(obj.amount)+'</td>'+
                                            '<td>'+floatToString(rate)+'</td>'+
                                            '<td>'+amountToString(obj.basic_premium)+'</td>'+
                                            '<td><a href="javascript:void(0)" onclick="deletehullcountupdate('+obj.id+')">'+
                                            '<i class="fas fa-trash text-danger"></i></a></td>'+
                                            '</tr>')

                            }

                            $('#marineHullCountTableUpdate2 > tbody:last-child').append('<tr id="totalhullupdate">'+
                                '<th>Total</th>'+
                                '<th>'+
                                    '<input type="hidden" id="totalhullwarupdate" class="form-control form-control-sm money text-left" name="" readonly="true">'+
                                    '<input type="text" id="totalhullshareupdate" class="form-control form-control-sm money text-left" name="" readonly="true">'+
                                '</th>'+
                                '<th>'+
                                    '<input type="hidden" id="totalhullhmivupdate" name="" readonly="true">'+
                                    '<input type="text" id="totalhullamountupdate" class="form-control form-control-sm money text-left" name="" readonly="true">'+
                                '</th>'+
                            '<th>'+
                                '</th>'+
                                '<th><input type="text" id="totalhullpremiupdate" class="form-control form-control-sm money text-left" name="" readonly="true"></th>'+
                                '</tr>')
                            
                                if(response.sum_share){
                                    var sumshare = response.sum_share;       
                                    $('#totalhullshareupdate').val(amountToString(sumshare));
                                }
                                else
                                {
                                    $('#totalhullshareupdate').val(0);
                                }

                                if(response.sum_amount){
                                    var sumamount = response.sum_amount;
                                    var fl_amount = parseFloat(sumamount);
                                    var new_amount = fl_amount.toFixed(2);
                                    var curr_amount = new_amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    $('#totalhullamountupdate').val(amountToString(response.sum_amount));

                                }
                                else
                                {
                                    $('#totalhullamountupdate').val(0);
                                }

                                if(response.sum_premi){
                                    var sumpremi = response.sum_premi;
                                    var fl_premi = parseFloat(sumpremi);
                                    var new_premi = fl_premi.toFixed(2);
                                    var curr_premi = new_premi.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    $('#totalhullpremiupdate').val(amountToString(response.sum_premi));
                                
                                }
                                else
                                {
                                    $('#totalhullpremiupdate').val(0);
                                }

                        }

                        
                        if(response.installment_panel && response.installment_panel.length > 10)
                        {

                            var installment_panel = JSON.parse(response.installment_panel); 

                            //var installment_panel = JSON.parse(response.installment_panel); 

                            $('#installmentPanelupdate tbody').empty();
                            for(var i = 0; i < installment_panel.length; i++) 
                            {
                                var obj = installment_panel[i];
                                // var curr_amount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(obj.amount);
                                // var conv_amount = parseFloat(obj.amount).toFixed(2);
                                // var str_amount = conv_amount.toString();
                                // var curr_amount = str_amount.replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                            
                                var conv_amount = parseFloat(obj.amount).toFixed(2);

                                var curr_amount = conv_amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


                                var currdate = obj.installment_date;
                                var convdate = currdate.split("-").reverse().join("/");
                                console.log('conv date ' + convdate)
                                var strdate = convdate.toString();
                                var conv_percent = parseFloat(obj.percentage).toFixed(2);

                                //console.log(obj.id);
                                //$('#interestInsuredTabledetail tbody').append('');
                                
                                $('#installmentPanelupdate tbody').append('<tr id="iidinstallmentupdate'+obj.id+'" data-name="installmentupdatevalue[]"><td data-name="'+obj.installment_date+'">'+obj.installment_date+'</td><td data-name="'+floatToString(parseFloat(obj.percentage).toFixed(5).toString())+'">'+floatToString(parseFloat(obj.percentage).toFixed(5).toString())+'%</td><td data-name="'+amountToString(obj.amount)+'">'+amountToString(obj.amount)+'</td><td><a href="javascript:void(0)" onclick="deleteinstallmentupdate('+obj.id+')">delete</a></td></tr>')

                            }
                        }



                        if(response.retrocession_panel && response.retrocession_panel.length > 10)
                        {

                            var retrocession_panel = JSON.parse(response.retrocession_panel); 

                            $('#retrocessionPanelupdate tbody').empty();
                            for(var i = 0; i < retrocession_panel.length; i++) 
                            {
                                var obj = retrocession_panel[i];
                                // var curr_amount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(obj.amount);
                                if(obj.amount)
                                {
                                    var conv_amount = parseFloat(obj.amount).toFixed(2);
                                    var str_amount = conv_amount.toString();
                                    var curr_amount = str_amount.replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                                    var conv_percent = parseFloat(obj.percentage).toFixed(2);

                                    //console.log(obj.id);
                                    //$('#interestInsuredTabledetail tbody').append('');
                            
                                
                                $('#retrocessionPanelupdate tbody').append('<tr id="iidretrocessionupdate'+obj.id+'" data-name="retrocessionupdatevalue[]"><td data-name="'+obj.contract+'">'+obj.contract+'</td><td data-name="'+floatToString(parseFloat(obj.percentage).toFixed(5).toString())+'">'+floatToString(parseFloat(obj.percentage).toFixed(5).toString())+'%</td><td data-name="'+amountToString(obj.amount)+'">'+amountToString(obj.amount)+'</td><td><a href="javascript:void(0)" onclick="deleteretrocessiondetailupdate('+obj.id+')">delete</a></td></tr>');
                                }
                            }
                        }

                        if(response.status_log)
                        {
                            $('#slipStatusTableupdate tbody').empty();
                            var obj_status =response.status_log;
                            
                            for (var i = 0; i < obj_status.length; i++){

                                
                                    var status = obj_status[i].status;
                                    var datetime = obj_status[i].datetime;
                                    var user = obj_status[i].user;
                                    
                                    $('#slipStatusTableupdate tbody').append('<tr id="stlid'+obj_status[i].id+'" data-name="slipvalue[]"><td >'+status+'</td><td >'+datetime+'</td><td >'+user+'</td></tr>')
                                
                            };
                        }

                        if(response.attacment_file)
                        {
                            $('#aidlistupdate li').remove();
                            var attacment_file = response.attacment_file;
                            for (var i = 0; i < attacment_file.length; i++){
                                var filename = attacment_file[i].filename;
                                $('#aidlistupdate').append('<li><div class="control-group input-group" id="control-group2" style="margin-top:10px"><a href="{{ asset("files")}}/'+filename+'">'+filename+'</a></div></li>')
                            };
                        }
                        


                    if(response.status)
                    {
                        $("#slipstatusupdate").val(response.status);
                        //$("#slipstatusupdate option[value=" + response.status + "]:first")[0].selected = true;
                    }

                    if(response.source)
                    {
                        $('#slipcedingbrokerupdate').val(response.source).trigger('change');
                        // if($("#slipcedingbrokerupdate option[value=" + response.source + "]:first")[0])
                        // {
                        //   $("#slipcedingbrokerupdate option[value=" + response.source + "]:first")[0].selected = true;
                        // }
                    }

                    if(response.source_2)
                    {
                        $('#slipcedingupdate').val(response.source_2).trigger('change');
                        // if($("#slipcedingupdate option[value=" + response.source_2 + "]:first")[0])
                        // {
                        //  $("#slipcedingupdate option[value=" + response.source_2 + "]:first")[0].selected = true;
                        // }
                    }

                    if(response.currency)
                    {
                        $("#slipcurrencyupdate option[value=" + response.currency + "]:first")[0].selected = true;
                    }

                    if(response.cob)
                    {
                        $("#slipcobupdate option[value=" + response.cob + "]:first")[0].selected = true;
                    }

                    if(response.koc)
                    {
                        if($("#slipkocupdate option[value=" + response.koc + "]:first")[0])
                        {
                          $("#slipkocupdate option[value=" + response.koc + "]:first")[0].selected = true;
                        }
                    }

                    if(response.occupacy)
                    {
                        //$("#slipoccupacyupdate option[value=" + response.occupacy + "]:first")[0].selected = true;
                    }

                    if(response.build_const)
                    {
                        $("#slipbld_constupdate option[value='" + response.build_const + "']:first")[0].selected = true;
                        
                    }


                    if(response.build_rate_up == null){
                        $("#slipbcuaupdate").val(0);
                    }else{
                        $("#slipbcuaupdate").val(response.build_rate_up);
                    }
                    
                    if(response.build_rate_down == null){
                        $("#slipbclaupdate").val(0);
                    }else{
                        $("#slipbclaupdate").val(response.build_rate_down);
                    }

                    if(response.type_tsi)
                    {
                        if($("#sliptypetsiupdate option[value=" + response.type_tsi + "]:first")[0])
                        {
                         $("#sliptypetsiupdate option[value=" + response.type_tsi + "]:first")[0].selected = true;
                        }
                    }

                    if(response.type_share_tsi)
                    {
                        if($("#sharetypetsiupdate option[value=" + response.type_share_tsi + "]:first")[0])
                        {
                        $("#sharetypetsiupdate option[value=" + response.type_share_tsi + "]:first")[0].selected = true;
                        }
                    }

                    if(response.insured_type)
                    {
                        if($("#sliptypeupdate option[value=" + response.insured_type + "]:first")[0])
                        {
                        $("#sliptypeupdate option[value=" + response.insured_type + "]:first")[0].selected = true;
                        }
                    }

                    if(response.layer_non_proportional)
                    {
                        //$("#sliplayerproportionalupdate option[value=" + response.layer_non_proportional + "]:first")[0].selected = true;
                    }

                    if(response.retro_backup)
                    {
                        // $("#sliprbupdate option[value=" + response.retro_backup + "]:first")[0].selected = true;
                        if(response.retro_backup == "NO")
                        {
                            $("#tabretroupdate").attr('hidden','true');
                        }
                        else if(response.retro_backup == "YES"){
                            $("#tabretroupdate").removeAttr('hidden');
                        }
                    }

                    if(response.total_sum_insured)
                    {
                        var conv_tsi = parseFloat(response.total_sum_insured).toFixed(2);
                        $('#sliptotalsumupdate').val(amountToString(response.total_sum_insured));
                        $('#sliptotalsumupdate2').val(amountToString(response.total_sum_insured));
                    }else{
                        $('#sliptotalsumupdate').val(0);
                        $('#sliptotalsumupdate2').val(0);
                    }

                    if(response.share_tsi)
                    {
                        var conv_stsi = parseFloat(response.share_tsi).toFixed(2);
                        $('#sharetotalsumupdate').val(amountToString(response.share_tsi));
                        $('#sharetotalsumupdate2').val(amountToString(response.share_tsi));
                    }
                    else
                    {
                        $('#sharetotalsumupdate').val("0");
                        $('#sharetotalsumupdate2').val("0");
                    }
                    
                    $('#sliptdupdate').val(response.date_transfer);
                    $('#sliptdupdate2').val(response.date_transfer);

                    if(response.insured_pct)
                    {
                        $('#slippctupdate').val(floatToString(response.insured_pct));
                    }else{
                        $('#slippctupdate').val("0");
                    }   
                    

                    if(response.total_sum_pct)
                    {
                        var conv_tsp = parseFloat(response.total_sum_pct).toFixed(2);
                        $('#sliptotalsumpctupdate').val(amountToString(response.total_sum_pct));
                        $('#sliptotalsumpctupdate2').val(amountToString(response.total_sum_pct));
                    }
                    else
                    {
                        $('#sliptotalsumpctupdate').val(0);
                        $('#sliptotalsumpctupdate2').val(0);
                    }
                    


                    $('#slipipfromupdate').val(response.insurance_period_from);
                    $('#slipiptoupdate').val(response.insurance_period_to);

                    var insurance_period_from2 = response.insurance_period_from.split("/").reverse().join("-");
                    var insurance_period_to2 = response.insurance_period_to.split("/").reverse().join("-");
                    var days=daysBetween(insurance_period_from2, insurance_period_to2);
                    var sum = isNaN(days / 365) ? 0 :(days / 365).toFixed(7);
                    var constday = days.toString() + "/365";
                    console.log(insurance_period_from2)
                    console.log(insurance_period_to2)
                    console.log(days)
                    console.log(constday)
                    console.log(parseFloat(sum))

                    //$('#slipdaytotalupdate').val(constday);
                    //$('#slipdaytotalupdate2').val(constday);


                    $('#slipdaytotalupdate').val(days);
                    $('#slipdaytotalupdate2').val(days);
                    $('#slipdaytotalupdate3').val("365");
                    $('#slipdaytotalupdate4').val("365");


                    $('#sliptotalsumdateupdate').val(amountToString(sum));
                    $('#sliptotalsumdateupdate2').val(amountToString(sum));

                    $('#sliprpfromupdate').val(response.reinsurance_period_from);
                    $('#sliprptoupdate').val(response.reinsurance_period_to);

                    $('#remarksupdate').val(response.remarks);
                    $('#countendorsmentupdate').val(response.endorsment);
                    $('#countendorsmentupdate2').val(response.endorsment);



                    $('#switch-proportionalupdate').val(response.proportional);
                        // if(response.proportional == ''){
                            $("#btnaddlayerupdate").attr('hidden','true');
                            $("#sliplayerproportionalupdate").attr('hidden','true');
                            $("#labelnonpropupdate").attr('hidden','true');
                            $("#labelnpupdate").attr('hidden','true');
                        // }

                        if(response.rate){
                            $('#sliprateupdate').val(floatToString(response.rate));
                        }else{
                            $('#sliprateupdate').val("0");
                        }
                        

                        if(response.share){
                            $('#slipshareupdate').val(floatToString(response.share));
                        }else{
                            $('#slipshareupdate').val("0");
                        }


                        if(response.v_broker){
                            $('#slipvbrokerupdate').val(floatToString(response.v_broker));
                        }else{
                            $('#slipvbrokerupdate').val("0");
                        }
                        
                        
                        
                        if(response.sum_share){
                            var conv_sshare = parseFloat(response.total_sum_pct).toFixed(2);
                            $('#slipsumshareupdate').val(amountToString(response.sum_share));
                            $('#slipsumshareupdate2').val(amountToString(response.sum_share));
                            $('#slipoldsumshareupdate2').val(amountToString(response.sum_share));
                            $('#slipoldsumshareupdate').val(amountToString(response.sum_share));
                        }else{
                            $('#slipsumshareupdate').val(0);
                            $('#slipsumshareupdate2').val(0);
                            $('#slipoldsumshareupdate2').val(0);
                            $('#slipoldsumshareupdate').val(0);
                        }
                        
                        if(response.basic_premium){
                            var conv_bp = parseFloat(response.total_sum_pct).toFixed(2);
                            $('#slipbasicpremiumupdate').val(amountToString(response.basic_premium));
                        }else{
                            $('#slipbasicpremiumupdate').val("0");
                        }
                        
                        
                        if(response.grossprm_to_nr){
                            var gprmtnr = parseFloat(response.grossprm_to_nr).toFixed(2);
                            $('#slipgrossprmtonrupdate').val(amountToString(response.grossprm_to_nr));
                            $('#slipgrossprmtonrupdate2').val(amountToString(response.grossprm_to_nr));
                        }else{
                            $('#slipgrossprmtonrupdate').val(0);
                            $('#slipgrossprmtonrupdate2').val(0);
                        }

                        if(response.commission){
                            $('#slipcommissionupdate').val(floatToString(response.commission));
                            $('#slipcommissionupdate2').val(floatToString(response.commission));
                        }else{
                            $('#slipcommissionupdate').val("0");
                            $('#slipcommissionupdate2').val("0");
                        }
                        
                        
                        if(response.sum_commission){
                            var conv_sc = parseFloat(response.sum_commission).toFixed(2);
                            $('#slipsumcommissionupdate').val(amountToString(response.sum_commission));
                            $('#slipsumcommissionupdate2').val(amountToString(response.sum_commission));
                        }else{
                            $('#slipsumcommissionupdate').val(0);
                            $('#slipsumcommissionupdate2').val(0);                        
                        }

                        if(response.netprm_to_nr){
                            var conv_nprtnr = parseFloat(response.netprm_to_nr).toFixed(2);
                            $('#slipnetprmtonrupdate').val(amountToString(response.netprm_to_nr));
                            $('#slipnetprmtonrupdate2').val(amountToString(response.netprm_to_nr));
                        }else{
                            $('#slipnetprmtonrupdate').val(0);
                            $('#slipnetprmtonrupdate2').val(0);
                        }
                        
                        if(response.sum_rate){
                            var conv_srate = parseFloat(response.sum_rate).toFixed(3);
                            $('#sliptotalrateupdate').val(amountToString(response.sum_rate));
                            $('#sliptotalrateupdate2').val(amountToString(response.sum_rate));
                        }
                        else{
                            $('#sliptotalrateupdate').val("0");
                            $('#sliptotalrateupdate2').val("0");

                        }

                        if(response.sum_v_broker){
                            var conv_sfee = parseFloat(response.sum_v_broker).toFixed(2);
                            $('#slipsumfeeupdate').val(floatToString(response.sum_v_broker));
                            $('#slipsumfeeupdate2').val(floatToString(response.sum_v_broker));
                        }
                        else{
                            $('#slipsumfeeupdate').val("0");
                            $('#slipsumfeeupdate2').val("0");

                        }

                        if(response.own_retention){
                            $('#sliporupdate').val(parseFloat(response.own_retention).toFixed(2));
                        }else{
                            $('#sliporupdate').val("0");
                        }
                        

                        if(response.sum_own_retention){
                            var conv_sor = parseFloat(response.sum_own_retention).toFixed(2);
                            $('#slipsumorupdate').val(conv_sor.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                            $('#slipsumorupdate2').val(conv_sor.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                        }else{
                            $('#slipsumorupdate').val(0);
                            $('#slipsumorupdate2').val(0);
                        }
                        
                        
                        swal("Success!", "Data Show")
                        console.log(response)

                    },
                    error: function (request, status, error) {
                        //alert(request.responseText);
                        swal("Error!", "Get Slip Data Error", "Get Data Error");
                    }
                });
        }
    });
    // Change status slip
    $(document).on('click','#btnSlip', function(e) {
        var codesl = $(this).data('id');
        var code = $('#mhnumber').val();
          swal({
            title: "Are you sure to submit this slip form?",
            type: "warning",
            customClass: 'swal-wide',
            showConfirmButton:true,
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: 'Ok',
            cancelButtonText: 'Cancel',
            focusConfirm:true
        }).then(result => {
        if (result.value){
            $.ajax({
                url:'{{ url("/") }}/transaction-data/changestatus/'+codesl,
                type:"GET",
                beforeSend: function() { $("body").addClass("loading");  },
                complete: function() {  $("body").removeClass("loading"); },
                success:function(response)
                {
                    if (response.success) {
                        toastr.success(response.message)
                        console.log(code)
                        refreshTableSlip(code)
                    }else{
                        toastr.warning(response.message)
                    }
                },
                error: function (request, status, error) {
                    //alert(request.responseText);
                    swal("Error!", request.responseText, "Get Data Error");
                }
            });
            } else {
              swal("Cancelled", "cancel", "error");
                 e.preventDefault();
            }
        })
            
            
            
           
        
    });
</script>

<script type="text/javascript">

    //triggered when modal is about to be shown
    $('#endorsementmodaldata').on('show.bs.modal', function(e) {

         //get data-id attribute of the clicked element
         // $("#tabretroendorsement").attr('hidden','true');
         var codesl = $(e.relatedTarget).data('book-id');
        //alert(codesl);
        $('input .amount').val(function(event) {
            // skip for arrow keys
            if(event.which >= 37 && event.which <= 40) return;
            console.log(event.which)
            console.log($(this).val())
                // format number
                $(this).val(function(index, value) {
                    return value.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                });
            });
        
        if(codesl)
        {

            $.ajax({
                url:'{{ url("/") }}/transaction-data/detailmarinehullslip/'+codesl,
                type:"GET",
                beforeSend: function() { $("body").addClass("loading");  },
                complete: function() {  $("body").removeClass("loading"); },
                success:function(response)
                {
                        //$('#slipnumberendorsement').val(response.number);
                        $('#insuredIDtxtendorsement').val(response.insured_id);
                        $('#slipidendorsement').val(response.id);
                        $('#slipnumberendorsement').val(response.number);
                        
                        $('#codeslreal').val(response.code_slreal);

                        $('#slipusernameendorsement').val(response.username);
                        $('#slipprodyearendorsement').val(response.prod_year);
                        $('#slipprodyearendorsement2').val(response.prod_year);
                        // $('#slipuyendorsement').val(response.uy);
                        $('#slipedendorsement').val(response.endorsment);
                        $('#slipslsendorsement').val(response.selisih);
                        $('#wpcendorsement').val(response.wpc);
                        
                        // $('#sliptotalnilaiecendorsement').val(response.sum_ec);
                        // $('#sliptotalpercentinspanendorsement').val(response.sum_ippercent);


                        // if(response.deductible_panel && response.deductible_panel.length > 10)
                        // {

                        //     var deductibledata = JSON.parse(response.deductible_panel); 

                        //     $('#deductiblePanelendorsement tbody').empty();
                        //     for(var i = 0; i < deductibledata.length; i++) 
                        //     {
                        //         var obj = deductibledata[i];
                                
                        //         if(obj)
                        //         {
                        //             // var curr_amount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(obj.amount);
                        //             if(obj.amount)
                        //             {
                        //                 var conv_amount = parseFloat(obj.amount);
                        //             }
                        //             else
                        //             {
                        //                 var conv_amount = 0;
                        //             }

                        //             var str_amount = conv_amount.toString();
                        //             var curr_amount = str_amount.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        //             // var curr_minamount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(obj.min_claimamount);
                        //             if(obj.min_claimamount)
                        //             {
                        //                 var conv_minamount = parseFloat(obj.min_claimamount);
                        //             }
                        //             else
                        //             {
                        //                 var conv_minamount = 0;
                        //             }

                        //             var str_minamount = conv_minamount.toString();
                        //             var curr_minamount = str_minamount.replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                        //             var conv_percent = parseFloat(obj.percentage);

                        //             //console.log(obj.id);
                        //             //$('#interestInsuredTabledetail tbody').append('');
                                    
                        //             $('#deductiblePanelendorsement tbody').append('<tr id="iiddeductibleendorsement'+obj.id+'" data-name="deductibleendorsementvalue[]"><td data-name="'+obj.deductibletype+'">'+obj.deductibletype+'</td><td data-name="'+floatToString(obj.percentage)+'">'+floatToString(obj.percentage)+'%</td><td data-name="'+amountToString(obj.amount)+'">'+amountToString(obj.amount)+'</td><td data-name="'+amountToString(obj.min_claimamount)+'">'+amountToString(obj.min_claimamount)+'</td><td><a href="javascript:void(0)" onclick="deletedeductibleendorsement('+obj.id+')">delete</a></td></tr>');
                        //         }
                        //     }
                        // }


                        // if(response.condition_needed && response.condition_needed.length > 10)
                        // {

                        //     var condition_needed = JSON.parse(response.condition_needed); 
                        //     $('#ConditionNeededEndorsement tbody').empty();
                        //     for(var i = 0; i < condition_needed.length; i++) 
                        //     {
                        //         var objg = condition_needed[i];
                        //         console.log(objg);
                        //         $('#ConditionNeededEndorsement tbody').append('<tr id="cnidendorsement'+objg.id+'" data-name="extendcoverageendorvalue[]"><td data-name="'+objg.cncode+'">'+objg.cncode + ' - ' + objg.cnname+'</td><td data-name="'+objg.cndesc+'">'+objg.cndesc+'</td><td><a href="javascript:void(0)" onclick="deleteconditionneededendorsement('+objg.id+')">delete</a></td></tr>');
                        
                        //     }
                        // }
                        $('#sliptdendorsement2').val(response.date_transfer);
                        $('#marineHullCountTableEndorsement tbody').empty();

                        // if(response.hull_data && response.hull_data.length > 10)
                        // {
                        //     var hull_panel = JSON.parse(response.hull_data); 
                          
                        //     $('#marineHullCountTableEndorsement2 tbody').empty();

                        //     for(var i = 0; i < hull_panel.length; i++) 
                        //     {
                        //         var obj = hull_panel[i];                    

                        //         if(obj.amount)
                        //         {
                        //             obj.amount = obj.amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        //         }

                        //         if(obj.basic_premium)
                        //         {
                        //             obj.basic_premium = obj.basic_premium.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        //         }

                        //         $('#marineHullCountTableEndorsement').append('<tr id="hcidendorsementid'+obj.id+'"  data-name="">'+
                        //                     '<td>'+obj.hullcode+ '-' + obj.hulltype+'</td>'+
                        //                     '<td>'+floatToString(obj.share)+'</td>'+
                        //                     '<td>'+amountToString(obj.amount)+'</td>'+
                        //                     '<td>'+floatToString(obj.rate)+'</td>'+
                        //                     '<td>'+amountToString(obj.basic_premium)+'</td>'+
                        //                     '<td><a href="javascript:void(0)" onclick="deletehullcountendorsement('+obj.id+')">'+
                        //                     '<i class="fas fa-trash text-danger"></i></a></td>'+
                        //                     '</tr>')

                            

                        //     }

                        //     $('#marineHullCountTableEndorsement2 > tbody:last-child').append('<tr id="totalhullendorsement">'+
                        //             '<th>Total</th>'+
                        //             '<th>'+
                        //                 '<input type="hidden" id="totalhullwarendorsement" class="form-control form-control-sm money text-left" name="" readonly="true">'+
                        //                 '<input type="text" id="totalhullshareendorsement" class="form-control form-control-sm money text-left" name="" readonly="true">'+
                        //             '</th>'+
                        //             '<th>'+
                        //                 '<input type="hidden" id="totalhullhmivendorsement" name="" readonly="true">'+
                        //                 '<input type="text" id="totalhullamountendorsement" class="form-control form-control-sm money text-left" name="" readonly="true">'+
                        //             '</th>'+
                        //         '<th>'+
                        //             '</th>'+
                        //             '<th><input type="text" id="totalhullpremiendorsement" class="form-control form-control-sm money text-left" name="" readonly="true"></th>'+
                        //             '</tr>')
                            
                        //             if(response.sum_share){
                        //                 var sumshare = response.sum_share;       
                        //                 $('#totalhullshareendorsement').val(amountToString(response.sum_share));
                        //             }
                        //             else
                        //             {
                        //                 $('#totalhullshareendorsement').val(0);
                        //             }

                        //             if(response.sum_amount){
                        //                 var sumamount = response.sum_amount;
                        //                 var fl_amount = parseFloat(sumamount);
                        //                 var new_amount = fl_amount;
                        //                 var curr_amount = new_amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        //                 $('#totalhullamountendorsement').val(amountToString(response.sum_amount));

                        //             }
                        //             else
                        //             {
                        //                 $('#totalhullamountendorsement').val(0);
                        //             }

                        //             if(response.sum_premi){
                        //                 var sumpremi = response.sum_premi;
                        //                 var fl_premi = parseFloat(sumpremi);
                        //                 var new_premi = fl_premi;
                        //                 var curr_premi = new_premi.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        //                 $('#totalhullpremiendorsement').val(amountToString(response.sum_premi));
                                    
                        //             }
                        //             else
                        //             {
                        //                 $('#totalhullpremiendorsement').val(0);
                        //             }

                            
                        // }




                        // if(response.installment_panel && response.installment_panel.length > 10)
                        // {
                            
                        //     var installment_panel = JSON.parse(response.installment_panel); 

                        //     $('#installmentPanelendorsement tbody').empty();
                        //     for(var i = 0; i < installment_panel.length; i++) 
                        //     {
                        //         var obj = installment_panel[i];
                        //         // var curr_amount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(obj.amount);
                        //         // var conv_amount = obj.amount;
                        //         // var str_amount = conv_amount.toString();
                        //         // var curr_amount = str_amount.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        //         if(obj)
                        //         {
                        //             var conv_amount = parseFloat(obj.amount);
                        //             var curr_amount =  conv_amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                        //             var currdate = obj.installment_date;
                        //             var convdate = currdate.split("-").reverse().join("/");
                        //             console.log('conv date ' + convdate)
                        //             var strdate = convdate.toString();

                        //             var conv_percent = parseFloat(obj.percentage);

                        //             //console.log(obj.id);
                        //             //$('#interestInsuredTabledetail tbody').append('');
                                    
                        //             $('#installmentPanelendorsement tbody').append('<tr id="iidinstallmentendorsement'+obj.id+'" data-name="installmentendorsementvalue[]"><td data-name="'+obj.installment_date+'">'+strdate+'</td><td data-name="'+floatToString(obj.percentage)+'">'+floatToString(obj.percentage)+'%</td><td data-name="'+amountToString(obj.amount)+'">'+amountToString(obj.amount)+'</td><td><a href="javascript:void(0)" onclick="deleteinstallmentendorsement('+obj.id+')">delete</a></td></tr>')
                        //         }
                        //     }
                        // }



                        // if(response.retrocession_panel && response.retrocession_panel.length > 10)
                        // {

                        //     var retrocession_panel = JSON.parse(response.retrocession_panel); 

                        //     $('#retrocessionPanelendorsement tbody').empty();
                        //     for(var i = 0; i < retrocession_panel.length; i++) 
                        //     {
                        //         var obj = retrocession_panel[i];
                        //         if(obj)
                        //         {
                        //             // var curr_amount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(obj.amount);
                        //             if(obj.amount)
                        //             {
                        //                 var conv_amount = parseFloat(obj.amount);
                        //             }
                        //             else
                        //             {
                        //                 var conv_amount = 0;
                        //             }
                                    
                        //             var str_amount = conv_amount.toString();
                        //             var curr_amount = str_amount.replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                        //             var conv_percent = parseFloat(obj.percentage);

                        //             //console.log(obj.id);
                        //             //$('#interestInsuredTabledetail tbody').append('');
                                    
                                    
                        //             $('#retrocessionPanelendorsement tbody').append('<tr id="iidretrocessionendorsement'+obj.id+'" data-name="retrocessionendorsementvalue[]"><td data-name="'+obj.contract+'">'+obj.contract+'</td><td data-name="'+floatToString(obj.percentage)+'">'+floatToString(obj.percentage)+'%</td><td data-name="'+amountToString(obj.amount)+'">'+amountToString(obj.amount)+'</td><td><a href="javascript:void(0)" onclick="deleteretrocessionendorsement('+obj.id+')">delete</a></td></tr>');
                        //         }
                        //     }
                        // }
                        
                        
                    if(response.status)
                    {
                        //$("#slipstatusendorsement option[value=" + response.status + "]:first")[0].selected = true;
                        $("#slipstatusendorsement").val(response.status);
                    }

                    if(response.source)
                    {

                        if($("#slipcedingbrokerendorsement option[value=" + response.source + "]:first")[0])
                        {
                          $("#slipcedingbrokerendorsement option[value=" + response.source + "]:first")[0].selected = true;
                        }
                    }

                    if(response.source_2)
                    {
                        if($("#slipcedingendorsement option[value=" + response.source_2 + "]:first")[0])
                        {
                        $("#slipcedingendorsement option[value=" + response.source_2 + "]:first")[0].selected = true;
                        }
                    }

                    if(response.currency)
                    {
                        $("#slipcurrencyendorsement option[value=" + response.currency + "]:first")[0].selected = true;
                    }

                    if(response.cob)
                    {
                        if($("#slipcobendorsement option[value=" + response.cob + "]:first")[0])
                        {
                            $("#slipcobendorsement option[value=" + response.cob + "]:first")[0].selected = true;
                        }
                    }

                    if(response.koc)
                    {
                        if($("#slipkocendorsement option[value=" + response.koc + "]:first")[0])
                        {
                        $("#slipkocendorsement option[value=" + response.koc + "]:first")[0].selected = true;
                        }
                    }

                    if(response.occupacy)
                    {
                        //$("#slipoccupacyendorsement option[value=" + response.occupacy + "]:first")[0].selected = true;
                    }

                    if(response.build_const)
                    {
                    $("#slipbld_constendorsement option[value='" + response.build_const + "']:first")[0].selected = true;
                    $("#slipbcuaendorsement").val(response.build_rate_up);
                    $("#slipbclaendorsement").val(response.build_rate_down);
                    }

                

                        if(response.insured_type)
                        {
                            if($("#sliptypeendorsement option[value=" + response.insured_type + "]:first")[0])
                            {
                             $("#sliptypeendorsement option[value=" + response.insured_type + "]:first")[0].selected = true;
                            }
                        }

                        if(response.type_tsi)
                        {
                            if($("#sliptypetsiendorsement option[value=" + response.type_tsi + "]:first")[0])
                            {
                            $("#sliptypetsiendorsement option[value=" + response.type_tsi + "]:first")[0].selected = true;
                            }
                        }

                        if(response.type_share_tsi)
                        {
                            if($("#sharetypetsiendorsement option[value=" + response.type_share_tsi + "]:first")[0])
                            {
                            $("#sharetypetsiendorsement option[value=" + response.type_share_tsi + "]:first")[0].selected = true;
                            }
                        }

                        if(response.layer_non_proportional)
                        {
                            // $("#sliplayerproportionalendorsement option[value=" + response.layer_non_proportional + "]:first")[0].selected = true;
                        }

                        if(response.retro_backup)
                        {
                            // $("#sliprbendorsement option[value=" + response.retro_backup + "]:first")[0].selected = true;
                            $("#tabretroendorsement").removeAttr('hidden');
                            // if(response.retro_backup == "NO")
                            // {
                            //     $("#tabretroendorsement").attr('hidden');
                            // }
                            // else if(response.retro_backup == "YES"){
                                
                            // }
                        }

                        if(response.status_log){
                            var status_log = response.status_log;
                            $('#slipStatusTableendorsement tbody').empty();
                            for (var i = 0; i < 5; i++){
                                if(status_log[i])
                                {
                                    var status = status_log[i].status;
                                    var datetime = status_log[i].datetime;
                                    var user = status_log[i].user;
                                    
                                    $('#slipStatusTableendorsement tbody').append('<tr id="stlid'+status_log[i].id+'" data-name="slipvalue[]"><td >'+status+'</td><td >'+datetime+'</td><td >'+user+'</td></tr>')
                                }
                            };
                        }

                        if(response.attacment_file){
                            $('#aidlistendorsement li').remove();
                            var attacment_file = response.attacment_file;
                            for (var i = 0; i < attacment_file.length; i++){
                                var filename = attacment_file[i].filename;

                                $('#aidlistendorsement').append('<li><div class="control-group input-group" id="control-group2" style="margin-top:10px"><a href="{{ asset("files")}}/'+filename+'">'+filename+'</a></div></li>')
                            };
                        }

                        // $('#slipnoendorsement').val(response.slip_no);
                        // $('#slipcndnendorsement').val(response.cn_dn);
                        // $('#slippolicy_noendorsement').val(response.policy_no);

                        if(response.total_sum_insured){
                            var conv_tsi = parseFloat(response.total_sum_insured);
                            $('#sliptotalsumendorsement').val(amountToString(response.total_sum_insured));
                            $('#sliptotalsumendorsement2').val(amountToString(response.total_sum_insured));
                        }else{
                            $('#sliptotalsumendorsement').val("0");
                            $('#sliptotalsumendorsement2').val("0");
                        }

                        if(response.share_tsi){
                            var conv_stsi = parseFloat(response.share_tsi);
                            $('#sharetotalsumendorsement').val(amountToString(response.share_tsi));
                            $('#sharetotalsumendorsement2').val(amountToString(response.share_tsi));
                        }
                        else
                        {
                            $('#sharetotalsumendorsement').val("0");
                            $('#sharetotalsumendorsement2').val("0");
                        }

                        if(response.insured_pct){
                            $('#slippctendorsement').val(floatToString(response.insured_pct));
                        }else{
                            $('#slippctendorsement').val("0");
                        }
                        

                        if(response.total_sum_pct){
                            var conv_spct = parseFloat(response.total_sum_pct);
                            $('#sliptotalsumpctendorsement').val(amountToString(conv_spct));
                        }else{
                            $('#sliptotalsumpctendorsement').val("0");
                        }

                        $('#sliptdendorsement').val(response.date_transfer);
                        $('#slipipfromendorsement').val(response.insurance_period_from);
                        $('#slipiptoendorsement').val(response.insurance_period_to);

                        var insurance_period_from2 = response.insurance_period_from.split("/").reverse().join("-");
                        var insurance_period_to2 = response.insurance_period_to.split("/").reverse().join("-");
                        var days=daysBetween(insurance_period_from2, insurance_period_to2);
                        var sum = isNaN(days / 365) ? 0 :(days / 365).toFixed(7);
                        var constday = days.toString() + "/365";
                        console.log(insurance_period_from2)
                        console.log(insurance_period_to2)
                        console.log(days)
                        console.log(constday)
                        console.log(parseFloat(sum))

                        //$('#slipdaytotalendorsement').val(constday);

                        $('#slipdaytotalendorsement').val(days);
                        $('#slipdaytotalendorsement2').val(days);
                        $('#slipdaytotalendorsement3').val("365");
                        $('#slipdaytotalendorsement4').val("365");

                        $('#countendorsmentdata').val(response.endorsment);
                        $('#countendorsmentdata2').val(response.endorsment);
                        $('#remarksendorsement').val(response.remarks);
                            
                        
                        $('#sliptotalsumdateendorsement').val(parseFloat(sum));

                        $('#sliprpfromendorsement').val(response.reinsurance_period_from);
                        $('#sliprptoendorsement').val(response.reinsurance_period_to);

                        $('#switch-proportionalendorsement').val(response.proportional);
                        // if(response.proportional == ''){
                        $("#btnaddlayerendorsement").attr('hidden','true');
                        $("#sliplayerproportionalendorsement").attr('hidden','true');
                        $("#labelnonpropendorsement").attr('hidden','true');
                        $("#labelnpendorsement").attr('hidden','true');
                        // }

                        if(response.rate){
                            $('#sliprateendorsement').val(floatToString(response.rate));
                        }else{
                            $('#sliprateendorsement').val("0");
                        }

                        if(response.share){
                            $('#slipshareendorsement').val(floatToString(response.share));
                        }else{
                        $('#slipshareendorsement').val("0");
                        }
                        if(response.retro_backup){
                            $("#sliprbendorsement option[value=" + response.retro_backup + "]:first").selected = true;
                            $("#tabretroendorsement").removeAttr('hidden');
                            // if(response.retro_backup == "NO")
                            // {
                            //     $("#tabretroendorsement").attr('hidden');
                            // }
                            // else if(response.retro_backup == "YES"){
                            //     $("#tabretroendorsement").removeAttr('hidden');
                            // }
                        }
                        if(response.own_retention){
                        $('#sliporendorsement').val(parseFloat(response.own_retention));
                        }else{
                        $('#sliporendorsement').val("0");
                        }

                        if(response.commission){
                            $('#slipcommissionendorsement').val(floatToString(response.commission));
                        }else{
                        $('#slipcommissionendorsement').val("0");
                        }

                        if(response.v_broker){
                            $('#slipvbrokerendorsement').val(floatToString(response.v_broker));
                        }else{
                            $('#slipvbrokerendorsement').val("0");
                        }
                        

                        if(response.basic_premium){
                            var conv_bp = amountToString(response.basic_premium);
                            $('#slipbasicpremiumendorsement').val(conv_bp);
                        }else{
                            $('#slipbasicpremiumendorsement').val("0");
                        }

                        if(response.sum_share){
                            var conv_sshare = amountToString(response.sum_share);
                            $('#slipsumshareendorsement').val(conv_sshare);
                            $('#slipsumshareendorsement2').val(conv_sshare);
                        }else{
                            $('#slipsumshareendorsement').val("0");
                            $('#slipsumshareendorsement2').val("0");
                        }

                        if(response.sum_rate){
                            var conv_srate = floatToString(response.sum_rate);
                            $('#sliptotalrateendorsement').val(conv_srate);
                            $('#sliptotalrateendorsement2').val(conv_srate);
                        }else{
                            $('#sliptotalrateendorsement').val("0");
                            $('#sliptotalrateendorsement2').val("0");
                        }
                        
                        if(response.sum_commission){
                            var conv_scomm = amountToString(response.sum_commission);
                            $('#slipsumcommissionendorsement').val(conv_scomm);
                            $('#slipsumcommissionendorsement2').val(conv_scomm);
                        }else{
                            $('#slipsumcommissionendorsement').val("0");
                            $('#slipsumcommissionendorsement2').val("0");
                        }

                        if(response.sum_own_retention){
                            var conv_sor = amountToString(response.sum_own_retention);
                            $('#slipsumorendorsement').val(conv_sor);
                            $('#slipsumorendorsement2').val(conv_sor);
                        }else{
                            $('#slipsumorendorsement').val("0");
                            $('#slipsumorendorsement2').val("0");

                        }
                        
                        if(response.sum_feebroker){
                            var conv_sumfee = amountToString(response.sum_feebroker);
                            console.log('sum fee broker' + conv_sumfee)
                            $('#slipsumfeeendorsement').val(conv_sumfee);
                            $('#slipsumfeeendorsement2').val(conv_sumfee);
                        }
                        else{
                            $('#slipsumfeeendorsement').val("0");
                            $('#slipsumfeeendorsement2').val("0");
                        }


                        if(response.grossprm_to_nr){
                            var conv_gprmtnr = amountToString(response.grossprm_to_nr);
                            $('#slipgrossprmtonrendorsement').val(conv_gprmtnr);
                            $('#slipgrossprmtonrendorsement2').val(conv_gprmtnr);
                        
                        }
                        else{
                            $('#slipgrossprmtonrendorsement').val("0");
                            $('#slipgrossprmtonrendorsement2').val("0");
                        }

                        if(response.netprm_to_nr){
                            var conv_nprtnr = amountToString(response.netprm_to_nr);
                            $('#slipnetprmtonrendorsement').val(conv_nprtnr);
                            $('#slipnetprmtonrendorsement2').val(conv_nprtnr); 
                        }
                        else{
                            $('#slipnetprmtonrendorsement').val("0"); 
                            $('#slipnetprmtonrendorsement2').val("0"); 
                        }
                        
                        swal("Success!", "Data Show")
                        console.log(response)
                        // addendorsement();

                    },
                    error: function (request, status, error) {
                        //alert(request.responseText);
                        swal("Error!", "Get Slip Data Error", "Get Data Error");
                    }
                });
        
        }
    });
</script>

<script type="text/javascript">
  
    //triggered when modal is about to be shown
    $('#cancelmodaldata').on('show.bs.modal', function(e) {

        //get data-id attribute of the clicked element
        var codesl = $(e.relatedTarget).data('book-id');

        $('#cancelmodaldataslipid').val(codesl);

        //alert(codesl);

        $.ajax({
            url:'{{ url("/") }}/transaction-data/detailslip/'+codesl,
            type:"GET",
            beforeSend: function() { $("body").addClass("loading");  },
            complete: function() {  $("body").removeClass("loading"); },
            success:function(response)
            {
                console.log('bisa tampil')
                console.log(response);
                $('#slipnumberdetail').val(response.number);
                $('#slipiddetail').val(response.id);
                //$('#remarkscancel').val(response.remarks);
     
                swal("Success!", "Data Show")
                console.log(response)

            },
            error: function (request, status, error) {
                //alert(request.responseText);
                swal("Error!", "Get Slip Data Error", "Get Data Error");
            }
        });
    });
</script>


<script type="text/javascript">
    $('#cancelmodal-btn').click(function(e)
    {
        e.preventDefault();
        $(this).submit(function() {
			return false;
		});

         var remarkscancel = $('#remarkscancel').val();
         var slipnumber = $('#slipnumberdetail').val();
         var slipiddetail = $('#slipiddetail').val();
         var code_ms = $('#mhnumber').val();
         var token2 = $('input[name=_token]').val();

               $.ajaxSetup({
                    headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

               $.ajax({
                 url:"{{url('transaction-data/marine-hull-slip/cancel')}}",
                 type:"POST",
                 data:{
                     code_ms:code_ms,
                     slipnumber:slipnumber,
                     slipiddetail:slipiddetail,
                     remarkscancel:remarkscancel
                 },
                 beforeSend: function() { $("body").addClass("loading");  },
                 complete: function() {  $("body").removeClass("loading"); },
                 success:function(response)
                 {
                    swal("Success!", "Slip Marine Hull Slip Update Status Cancelled", "success")
                    console.log(response)
                    

                       $('#cancelmodaldata').modal('toggle');
                       refreshTableSlip(code_ms)
                       

                       //location.reload(true);

                    },
                    error: function (request, status, error) {
                        //alert(request.responseText);
                        swal("Error!", "Slip Marine Hull Slip Update Error", "Update Error");
                    }
                });
        
        return true;

    });
</script>


<!-- awal perhitungan -->
<script type="text/javascript">
    $('#slipcedingbroker').change(function()
    {
        var cedbrok = $(this).val();
        var insuredid = $('#mhnumber').val(); 
        // console.log(cedbrok) 
        var btnins = $("#addinsuredsave-btn").text();
        // alert(cedbrok);
        console.log("ceding id "+ cedbrok)
        console.log("insured id "+ insuredid)
        console.log("btn ins "+ btnins)
        if(btnins == "Update")
        {
            if(cedbrok){
                $.ajax({
                    type:"GET",
                    url:"{{url('get-ceding-detail')}}?slip_type=mh&ceding_id="+cedbrok+"&insured_id="+insuredid,
                    beforeSend: function() { $("body").addClass("loading");  },
                    complete: function() {  $("body").removeClass("loading"); },
                    success:function(res){  
                        console.log(res)
                        console.log("type " + res.type)      
                        if(res.type == 4){
                            $("#slipceding option").remove();


                            $("#slipceding").append('<option value="'+res.id+'">'+res.code+' - '+res.name+'</option>');

                            console.log(res)
                            console.log("id ceding " +res.id)
                            console.log("ceding code " +res.code)
                            console.log("ceding name " +res.name)
                             

                            var typetsi = $('#sharetypetsi').val();

                            if(typetsi == 2){
                                var ceding_curr = $('#slipceding').val();
                                var totalsum = $("#sliptotalsum").val();
                                if(res.amountlist > 0)
                                {
                                    console.log('sum amount ' + res.sumamount)
                                    var sum = res.sumamount;
                                    // var conv_sum = sum;
                                    var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    $("#sharetotalsum").val(amountToString(sum));
                                    $("#sharetotalsum2").val(amountToString(sum));
                                }
                                else
                                {
                                    console.log('hasilnya ' + res)
                                }
                            }



                        }
                        else
                        {
                            $("#slipceding option").remove();
                            $("#slipceding").append('<option value="#" selected disabled> select ceding </option>');
                            

                            if(res.ceding_list)
                            {
                                var list_ceding = res.ceding_list;
                                
                                for(var i = 0; i < list_ceding.length; i++){

                                    var id_ceding = list_ceding[i].ceding_id;
                                    var name_ceding = list_ceding[i].name;
                                    var code_ceding = list_ceding[i].code;
                                    console.log('ceding id '+id_ceding)
                                    console.log('ceding code '+code_ceding)
                                    console.log('ceding name '+name_ceding)

                                     $("#slipceding").append('<option value="'+id_ceding+'">'+code_ceding+' - '+name_ceding+'</option>');

                                };
                            }
                            else
                            {
                                 swal("Error!", "Please insert insured first", "Get Ceding Error");

                            }   
                        }
                    }
                });
            }
            else{
                swal("Error!", "Please choose Ceding/Broker first", "Get Ceding Error");
            }
        
        }
        else if(btnins == "Save")
        {
            swal('please insert insured first!!!')
        } 
          
    });

    $('#slipceding').change(function(){
        console.log("ceding choice " + $(this).val() + $( "#slipceding option:selected" ).text())
       
    });   
</script>

<script type="text/javascript">
    $('#sliptypetsi').change(function(){
        var choice = $(this).val();
        var valtsi = $('#mhshareto').val();
        var valcedshare = $('#mhshare').val();
        var insuredid = $('#mhnumber').val(); 
        var cedbrok = $('#slipcedingbroker').val();
        var ceding = $('#slipceding').val();

        if(choice == '1')
        {
            if(valtsi == null || valtsi == "")
            {
                swal('warning','please fill tsi insured value first','error')
            }
            else
            {
                
                var tsi = $('#mhshareto').val();
                var int_tsi = parseFloat(tsi.replace(/,/g, ""));
                var conv_str_tsi = int_tsi;
                var real_tsi = conv_str_tsi.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('#sliptotalsum').val(conv_str_tsi);
                $('#sliptotalsum2').val(conv_str_tsi);

                var tsislip = $('#sliptotalsum').val();
                var pctval = $('#slippct').val();

                if(pctval != null){
                    var pct =  parseFloat($('#slippct').val())/100;
                    var conv_tsi = parseFloat(tsi.replace(/,/g, ""));

                    var sum = isNaN(pct * conv_tsi) ? 0 :(pct * conv_tsi) ;
                    console.log('sum ' + sum)
                    var conv_sum = parseFloat(sum);
                    console.log('conv_sum' + conv_sum)
                    var real_sum = conv_sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    
                    console.log('real_sum' + real_sum)

                    $('#sliptotalsumpct').val(sum);
                    $('#sliptotalsumpct2').val(sum);
                    // swal('success','changed to tsi','success')


                    var dpamount = $('#slipdpamount').val();
                    var ecamount = $('#slipamountec').val();

                    if(dpamount != null){

                        var percent =  parseFloat($('#slipdppercentage').val()) / 100;
                        
                        var sum = isNaN(percent * conv_tsi) ? 0 :(percent * conv_tsi) ;
                        var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        console.log($('#slipdppercentage').val())
                        console.log(percent)
                        console.log(sum)
                        console.log(real_sum)

                        $('#slipdpamount').val(sum);
                        $('#slipdpamount2').val(sum);

                    }


                }
            }
        }else if(choice == '2')
        {
            if(cedbrok != null && ceding != null)
            {
                
                $.ajax({
                    type:"GET",
                    url:"{{url('get-ceding-detail')}}?slip_type=mh&ceding_id="+ceding+"&insured_id="+insuredid,
                    beforeSend: function() { $("body").addClass("loading");  },
                    complete: function() {  $("body").removeClass("loading"); },
                    success:function(res)
                    {  
                        console.log(res)      
                        if(res.type == 4)
                        {

                            var ceding_curr = $('#slipceding').val();
                            var totalsum = $("#sliptotalsum").val();
                            if(res.amountlist > 0)
                            {
                                console.log('sum amount ' + res.sumamount)
                                var sum = res.sumamount;
                                // var conv_sum = sum;
                                var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                $("#sliptotalsum").val(sum);
                                $("#sliptotalsum2").val(sum);

                                var tsicedshare = $("#sliptotalsum").val();
                                var pctval = $('#sliptotalsumpct').val();

                                if(pctval != null)
                                {

                                    var pct =  parseFloat($('#slippct').val())/100;
                                    // var tsi = $("#sliptotalsum").val();
                                    var conv_tsi = parseInt(tsicedshare.replace(/,/g, ""));

                                    var sum = isNaN(pct * conv_tsi) ? 0 :(pct * conv_tsi) ;
                                    console.log(sum)
                                    var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    $('#sliptotalsumpct').val(sum);
                                    $('#sliptotalsumpct2').val(sum);
                                    // swal('success','changed to ceding share','success')

                                    var dpamount = $('#slipdpamount').val();
                                    var ecamount = $('#slipamountec').val();

                                    if(dpamount != null)
                                    {
                                        var percent =  parseFloat($('#slipdppercentage').val()) / 100;
                                        
                                        var sum = isNaN(percent * conv_tsi) ? 0 :(percent * conv_tsi) ;
                                        var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                        console.log($('#slipdppercentage').val())
                                        console.log(percent)
                                        console.log(sum)
                                        console.log(real_sum)

                                        $('#slipdpamount').val(sum);
                                        $('#slipdpamount2').val(sum);
                                    }


                                }
                            }
                            else
                            {
                                console.log('hasilnya ' + res)
                            }
                        }
                        else
                        {
                            swal('this is broker');
                        }
                    }
                });

                
            }
            else
            {
                swal("Error!", "Please choose Ceding/Broker first", "Get Ceding Error")
                $('#sliptotalsum').val('');
                $('#sliptotalsum2').val('');
            }
        }

    });
</script>

<script type="text/javascript">
    $('#sharetypetsi').change(function(){
        var choice = $(this).val();
        if(choice == '1')
        {

            var tsi = $('#mhshareto').val();
            var int_tsi = parseFloat(tsi.replace(/,/g, ""));
            var conv_str_tsi = int_tsi;
            var real_tsi = conv_str_tsi.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            var valtsi = $('#mhshareto').val();

            if(valtsi == null || valtsi == ""){
                 swal('warning','please fill tsi insured value first','error')
            }else{
                $('#sharetotalsum').val(real_tsi);
                $('#sharetotalsum2').val(real_tsi);
                // $('#totalhullamount').val(real_tsi);
                var grossprm_to_nr = $('#slipgrossprmtonr').val();

                if(grossprm_to_nr != null){
                    var nasionalreinsurance =  $('#mhsharefrom').val();
                    var totalnre =  $('#mhshareto').val();
                    var conv_totalnre =  parseInt(totalnre.replace(/,/g, ""));

                    console.log('nre' + nasionalreinsurance)
                        // console.log(conv_nasionalreinsurance)
                        console.log('totalnre' + totalnre)
                        console.log('convtotnre' + conv_totalnre)
                        
                        var sumshare2 = $('#slipsumshare').val() ;
                        var conv_sumshare = parseInt(sumshare2.replace(/,/g, ""));
                        var basic_premium = $('#totalhullpremi').val();
                        var conv_basre = parseInt(basic_premium.replace(/,/g, ""));

                        var orpercent = $('#slipor').val() / 100;

                        var sumor = isNaN(orpercent * conv_sumshare) ? 0 :(orpercent * conv_sumshare);
                        var real_sumor = sumor.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        
                        var sumgrtoprm = isNaN(conv_basre * shareslip) ? 0 :(conv_basre * shareslip );
                        var real_sumgrtoprm = sumgrtoprm.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        
                        if(nasionalreinsurance){
                            var conv_nasionalreinsurance =  parseInt(nasionalreinsurance.replace(/,/g, ""));
                            var sumnre = isNaN(conv_nasionalreinsurance + conv_sumshare ) ? 0 :(conv_nasionalreinsurance + conv_sumshare) ;
                            var real_sumnre = sumnre.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        }else{
                            var conv_nasionalreinsurance =  parseInt(nasionalreinsurance.replace(/,/g, ""));
                            var sumnre = isNaN(0 + conv_sumshare ) ? 0 :(0 + conv_sumshare) ;
                            var real_sumnre = sumnre.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        }
                        
                        
                        var sumourshare = isNaN((sumnre / conv_totalnre) * 100 ) ? 0 :((sumnre / conv_totalnre) * 100 ) ;

                        console.log('sumnre' + sumnre)
                        console.log('realnre' + real_sumnre)
                        console.log('sumourshare' + sumourshare)

                        $('#slipgrossprmtonr').val(amountToString(sumgrtoprm));
                        $('#slipgrossprmtonr2').val(amountToString(sumgrtoprm));
                        $('#slipsumor').val(amountToString(sumor));
                        $('#slipsumor2').val(amountToString(sumor));
                        // $('#mhshare').val(sumourshare.replace(/,/g, "."));
                        $('#mhsharefrom').val(amountToString(sumnre));


                        var commision =  parseFloat($(this).val()) / 100;
                        var feebroker = parseFloat($('#slipvbroker').val()) / 100;
                        var sumgrossprmtonr2 = $("#slipgrossprmtonr").val();
                        var conv_sumgrossprmtonr = parseInt(sumgrossprmtonr2.replace(/,/g, ""));

                        var sumcomm = isNaN(commision * conv_sumgrossprmtonr) ? 0 :(commision * conv_sumgrossprmtonr);
                        var real_sumcomm = sumcomm.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                        $('#slipsumcommission').val(amountToString(parseFloat(sumcomm)));
                        $('#slipsumcommission2').val(amountToString(parseFloat(sumcomm)));

                        var sumgrossprmtonr3 = $("#slipgrossprmtonr").val();
                        var conv_sumgrossprmtonr2 = parseInt(sumgrossprmtonr3.replace(/,/g, ""));

                        var sumnetprmtonr = isNaN( conv_sumgrossprmtonr2 * (100/100 - commision - feebroker)) ? 0 :(conv_sumgrossprmtonr2 * (100/100 - commision - feebroker));
                        var real_sumnetprmtonr = sumnetprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                        var sumfeebroker = isNaN( conv_sumgrossprmtonr2 * feebroker) ? 0 :(conv_sumgrossprmtonr2 * feebroker);
                        var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


                        $('#slipnetprmtonr').val(amountToString(sumnetprmtonr));
                        $('#slipnetprmtonr2').val(amountToString(sumnetprmtonr));
                        // $('#slipsumfee').val("100" + "-" + commision.toString() + "-" + feebroker.toString() + "*" + conv_sumgrossprmtonr.toString());
                        $('#slipsumfee').val(amountToString(sumfeebroker));
                        $('#slipsumfee2').val(amountToString(sumfeebroker));

                        var sumipamountval = $('#slipipamount').val();

                        if(sumipamountval != null){
                            var percent =  parseFloat($(this).val()) / 100;

                            var sumnetprtonr2 = $("#slipnetprmtonr").val();
                            var conv_sumnetprtonr = parseInt(sumnetprtonr2.replace(/,/g, ""));

                            var sumipamount = isNaN(percent *  conv_sumnetprtonr) ? 0 :(percent *  conv_sumnetprtonr);
                            var real_sumipamount = sumipamount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                            $('#slipipamount').val(amountToString(sumipamount));
                            $('#slipipamount2').val(amountToString(sumipamount));
                        }

                }
            }

            // swal('warning!','change to tsi please change installment and retrocession amount manually','success')
        }
        else if(choice == '2')
        {

            var insuredid = $('#mhnumber').val(); 
            var cedbrok = $('#slipcedingbroker').val();
            var ceding = $('#slipceding').val();
            if(cedbrok != null && ceding != null){
                $.ajax({
                    type:"GET",
                    url:"{{url('get-ceding-detail')}}?slip_type=mh&ceding_id="+ceding+"&insured_id="+insuredid,
                    beforeSend: function() { $("body").addClass("loading");  },
                    complete: function() {  $("body").removeClass("loading"); },
                    success:function(res){  
                        console.log(res)      
                        if(res.type == 4){
                            // $("#slipceding option").remove();


                            // $("#slipceding").append('<option value="'+res.id+'">'+res.type+' - '+res.code+' - '+res.name+'</option>');

                            var ceding_curr = $('#slipceding').val();
                            var totalsum = $("#sliptotalsum").val();
                            if(res.amountlist > 0)
                            {
                                console.log('sum amount ' + res.sumamount)
                                var sum = res.sumamount;
                                // var conv_sum = sum;
                                var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                $("#sharetotalsum").val(amountToString(sum));
                                $("#sharetotalsum2").val(amountToString(sum));
                                // $('#totalhullamount').val(real_tsi);

                            }
                            else
                            {
                                console.log('hasilnya ' + res)
                            }
                        }else{
                            // $("#slipceding option").remove();
                            // $("#slipceding").append('<option value="#" selected disabled> select ceding </option>');
                            // $("#sliptotalsum").val('');
                            // $("#sliptotalsum2").val('');
                            // $.each(res,function(key,value){
                            //     $("#slipceding").append('<option value="'+value.id+'">'+value.type+' - '+value.code+' - '+value.name+'</option>');

                            // });
                        }
                    }
                });
            }else{
                swal("Error!", "Please choose Ceding/Broker first", "Get Ceding Error");
            }  
            var tsi = $('#mhshare').val();
            $('#sharetotalsum').val(tsi);
            $('#sharetotalsum2').val(tsi);

            var shareslipval = $('#slipshare').val();
            if(shareslipval != null){
                var shareslip =  parseFloat($('#slipshare').val()) / 100 ;
                var conv_tsi = parseFloat(tsi.replace(/,/g, ""));
                var sumshare =isNaN( shareslip * conv_tsi) ? 0 :( shareslip * conv_tsi) ;
                var real_sumshare = sumshare.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


                $('#slipsumshare').val(amountToString(sumshare));
                $('#slipsumshare2').val(amountToString(sumshare));

                var grossprm_to_nr = $('#slipgrossprmtonr').val();

                    if(grossprm_to_nr != null){
                        var nasionalreinsurance =  $('#mhsharefrom').val();
                        var totalnre =  $('#mhshareto').val();
                        var conv_totalnre =  parseInt(totalnre.replace(/,/g, ""));

                        console.log('nre' + nasionalreinsurance)
                            // console.log(conv_nasionalreinsurance)
                            console.log('totalnre' + totalnre)
                            console.log('convtotnre' + conv_totalnre)
                            
                            var sumshare2 = $('#slipsumshare').val() ;
                            var conv_sumshare = parseInt(sumshare2.replace(/,/g, ""));
                            var basic_premium = $('#totalhullpremi').val();
                            var conv_basre = parseInt(basic_premium.replace(/,/g, ""));

                            var orpercent = $('#slipor').val() / 100;

                            var sumor = isNaN(orpercent * conv_sumshare) ? 0 :(orpercent * conv_sumshare);
                            var real_sumor = sumor.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            
                            var sumgrtoprm = isNaN(conv_basre * shareslip) ? 0 :(conv_basre * shareslip );
                            var real_sumgrtoprm = sumgrtoprm.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            
                            if(nasionalreinsurance){
                                var conv_nasionalreinsurance =  parseInt(nasionalreinsurance.replace(/,/g, ""));
                                var sumnre = isNaN(conv_nasionalreinsurance + conv_sumshare ) ? 0 :(conv_nasionalreinsurance + conv_sumshare) ;
                                var real_sumnre = sumnre.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            }else{
                                var conv_nasionalreinsurance =  parseInt(nasionalreinsurance.replace(/,/g, ""));
                                var sumnre = isNaN(0 + conv_sumshare ) ? 0 :(0 + conv_sumshare) ;
                                var real_sumnre = sumnre.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            }
                            
                            
                            var sumourshare = isNaN((sumnre / conv_totalnre) * 100 ) ? 0 :((sumnre / conv_totalnre) * 100 ) ;

                            console.log('sumnre' + sumnre)
                            console.log('realnre' + real_sumnre)
                            console.log('sumourshare' + sumourshare)

                            $('#slipgrossprmtonr').val(amountToString(sumgrtoprm));
                            $('#slipgrossprmtonr2').val(amountToString(sumgrtoprm));
                            $('#slipsumor').val(amountToString(sumor));
                            $('#slipsumor2').val(amountToString(sumor));
                            // $('#mhshare').val(sumourshare.replace(/,/g, "."));
                            $('#mhsharefrom').val(amountToString(sumnre));


                            var commision =  parseFloat($(this).val()) / 100;
                            var feebroker = parseFloat($('#slipvbroker').val()) / 100;
                            var sumgrossprmtonr2 = $("#slipgrossprmtonr").val();
                            var conv_sumgrossprmtonr = parseInt(sumgrossprmtonr2.replace(/,/g, ""));

                            var sumcomm = isNaN(commision * conv_sumgrossprmtonr) ? 0 :(commision * conv_sumgrossprmtonr);
                            var real_sumcomm = sumcomm.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                            $('#slipsumcommission').val(amountToString(sumcomm));
                            $('#slipsumcommission2').val(amountToString(sumcomm));

                            var sumgrossprmtonr3 = $("#slipgrossprmtonr").val();
                            var conv_sumgrossprmtonr2 = parseInt(sumgrossprmtonr3.replace(/,/g, ""));

                            var sumnetprmtonr = isNaN( conv_sumgrossprmtonr2 * (100/100 - commision - feebroker)) ? 0 :(conv_sumgrossprmtonr2 * (100/100 - commision - feebroker));
                            var real_sumnetprmtonr = sumnetprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                            var sumfeebroker = isNaN( conv_sumgrossprmtonr2 * feebroker) ? 0 :(conv_sumgrossprmtonr2 * feebroker);
                            var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


                            $('#slipnetprmtonr').val(amountToString(sumnetprmtonr));
                            $('#slipnetprmtonr2').val(amountToString(sumnetprmtonr));
                            // $('#slipsumfee').val("100" + "-" + commision.toString() + "-" + feebroker.toString() + "*" + conv_sumgrossprmtonr.toString());
                            $('#slipsumfee').val(amountToString(sumfeebroker));
                            $('#slipsumfee2').val(amountToString(sumfeebroker));

                            var sumipamountval = $('#slipipamount').val();

                            if(sumipamountval != null){
                                var percent =  parseFloat($(this).val()) / 100;

                                var sumnetprtonr2 = $("#slipnetprmtonr").val();
                                var conv_sumnetprtonr = parseInt(sumnetprtonr2.replace(/,/g, ""));

                                var sumipamount = isNaN(percent *  conv_sumnetprtonr) ? 0 :(percent *  conv_sumnetprtonr);
                                var real_sumipamount = sumipamount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                                $('#slipipamount').val(amountToString(sumipamount));
                                $('#slipipamount2').val(amountToString(sumipamount));
                            }

                    }

            }

            // swal('warning!','change to ceding share please change installment and retrocession amount manually','success')

        }
    });
</script>

<script  type='text/javascript'>
   $('#slippct').keyup(function (e) {
        if(e.keyCode != 9){
            var pct =  parseFloat($(this).val())/100;

            var tsi = $("#sliptotalsum").val();
            var conv_tsi = parseFloat(tsi.replace(/,/g, ""));

            var sum = isNaN(pct * conv_tsi) ? 0 :(pct * conv_tsi) ;
            console.log(sum)
            var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            $('#sliptotalsumpct').val(amountToString(sum));
            $('#sliptotalsumpct2').val(amountToString(sum));
        }
    });

   $('#slipdppercentage').keyup(function (e) {
        if(e.keyCode != 9){
            var percent =  parseFloat($(this).val()) / 100;
            var tsi = $("#sliptotalsum").val();
            var conv_tsi = parseFloat(tsi.replace(/,/g, ""));
            var sum = isNaN(percent * conv_tsi) ? 0 :(percent * conv_tsi);
            var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            console.log($(this).val())
            console.log(percent)
            console.log(sum)
            console.log(real_sum)

            $('#slipdpamount').val(amountToString(sum));
            $('#slipdpamount2').val(amountToString(sum));
        }
    });

   $('#slipshare').keyup(function (e) 
       {
        if(e.keyCode != 9)
        {
            calculateGrossPrm('slip')
        }
    });


   $('#mhtyperate').keyup(function (e) {
        if(e.keyCode != 9){
            calculateBasicPremium('slip')
        }else{
            calculateBasicPremium('slip')
        }
    });

   $('#slipshare').change(function (e) {
        if(e.keyCode != 9){
            if($(this).val() < -100 || $(this).val() > 100){
                swal('warning','share cannot lower than -100% or greater than 100%','error')
                $('#slipshare').val('');
                $('#slipsumshare').val('');
                $('#slipsumshare2').val('');
            }
            else{
                var rateslip =  parseFloat($('#sliprate').val());
                var shareslip =  parseFloat($('#slipshare').val()) / 100 ;
                var nasionalreinsurance =  $('#mhsharefrom').val();
                var totalnre =  $('#mhshareto').val();
                var conv_totalnre =  parseFloat(totalnre.replace(/,/g, ""));
                var hullpremi = $("#totalhullpremi").val();
                var conv_hullpremi = parseFloat(hullpremi.replace(/,/g, ""));

                console.log('nre' + nasionalreinsurance)
                    // console.log(conv_nasionalreinsurance)
                console.log('totalnre' + totalnre)
                console.log('convtotnre' + conv_totalnre)
                
                var tsi = $("#sharetotalsum").val();
                var conv_tsi = parseFloat(tsi.replace(/,/g, ""));

                var sumshare = $('#slipsumshare').val() ;
                var conv_sumshare = parseFloat(sumshare.replace(/,/g, ""));

                

                var orpercent = $('#slipor').val() / 100;

                var sumor = isNaN(orpercent * conv_sumshare) ? 0 :(orpercent * conv_sumshare);
                var real_sumor = sumor.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                
                var sum = isNaN(conv_hullpremi * shareslip ) ? 0 :(conv_hullpremi * shareslip );
                var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                
                if(nasionalreinsurance){
                    var conv_nasionalreinsurance =  parseFloat(nasionalreinsurance.replace(/,/g, ""));
                    var sumnre = isNaN(conv_nasionalreinsurance + conv_sumshare ) ? 0 :(conv_nasionalreinsurance + conv_sumshare) ;
                    var real_sumnre = sumnre.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                }else{
                    var conv_nasionalreinsurance =  parseFloat(nasionalreinsurance.replace(/,/g, ""));
                    var sumnre = isNaN(0 + conv_sumshare ) ? 0 :(0 + conv_sumshare) ;
                    var real_sumnre = sumnre.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                }
                
                
                var sumourshare = isNaN((sumnre / conv_totalnre) * 100 ) ? 0 :((sumnre / conv_totalnre) * 100 ) ;

                console.log('sumnre' + sumnre)
                console.log('realnre' + real_sumnre)
                console.log('sumourshare' + sumourshare)

                $('#slipgrossprmtonr').val(amountToString(sum));
                $('#slipgrossprmtonr2').val(amountToString(sum));
                $('#slipsumor').val(amountToString(sumor));
                $('#slipsumor2').val(amountToString(sumor));
                // $('#mhshare').val(sumourshare.replace(/,/g, "."));
                $('#mhsharefrom').val(amountToString(sumnre));

                var slipsumcommissionval = $('#slipsumcommission').val();
                if(slipsumcommissionval != null){
                    var commision =  parseFloat($('#slipcommission').val()) / 100;
                    var feebroker = parseFloat($('#slipvbroker').val()) / 100;
                    var sumgrossprmtonr = $("#slipgrossprmtonr").val();
                    var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr.replace(/,/g, ""));

                    var sumcomm = isNaN(commision * conv_sumgrossprmtonr) ? 0 :(commision * conv_sumgrossprmtonr);
                    var real_sumcomm = sumcomm.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                    $('#slipsumcommission').val(amountToString(sumcomm));
                    $('#slipsumcommission2').val(amountToString(sumcomm));

                    var netprm_to_nr = $('#slipnetprmtonr').val();
                    if(netprm_to_nr != null){


                        var sumnetprmtonr = isNaN( conv_sumgrossprmtonr * (100/100 - commision - feebroker)) ? 0 :(conv_sumgrossprmtonr * (100/100 - commision - feebroker));
                        var real_sumnetprmtonr = sumnetprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                        var sumfeebroker = isNaN( conv_sumgrossprmtonr * feebroker) ? 0 :(conv_sumgrossprmtonr * feebroker);
                        var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


                        $('#slipnetprmtonr').val(amountToString(sumnetprmtonr));
                        $('#slipnetprmtonr2').val(amountToString(sumnetprmtonr));
                        // $('#slipsumfee').val("100" + "-" + commision.toString() + "-" + feebroker.toString() + "*" + conv_sumgrossprmtonr.toString());
                        $('#slipsumfee').val(amountToString(sumfeebroker));
                        $('#slipsumfee2').val(amountToString(sumfeebroker));

                        // var retro_backup = $('#sliprb').val();
                        // if(retro_backup == 'YES'){
                        //     swal('warning!','please change retrocession amount manually','success')
                        // }

                    }

                }

            }
        }
    });

   $('#slipcommission').keyup(function (e) {
        var keyCode = e.keyCode || e.which;

        if (keyCode != 9){
            calculateComm('slip');
            calculateFeeBroker('slip');
        }else{
            calculateComm('slip');            
            calculateFeeBroker('slip');
        }
    });

   $('#slipcommission').keydown(function (e) {
        var keyCode = e.keyCode || e.which;

        if (keyCode != 9){
            calculateComm('slip');
            calculateFeeBroker('slip');
        }else{
            calculateComm('slip');            
            calculateFeeBroker('slip');
        }
    });

   $('#slipcommission').keypress(function (e) {
        var keyCode = e.keyCode || e.which;

        if (keyCode != 9){
            calculateComm('slip');
            calculateFeeBroker('slip');
        }else{
            calculateComm('slip');            
            calculateFeeBroker('slip');
        }
    });

   $('#slipsumcommission2').keyup(function(e){
        var keyCode = e.keyCode || e.which; 

        calculatePercentComm('slip');
   });

   $('#slipsumcommission2').keydown(function(e){
        var keyCode = e.keyCode || e.which; 

        if (keyCode != 9){
            calculatePercentComm('slip');
        }else{
            calculatePercentComm('slip');
        }
   });

   $('#slipsumcommission2').keypress(function(e){
        var keyCode = e.keyCode || e.which; 

        if (keyCode != 9){
            calculatePercentComm('slip');
        }else{
            calculatePercentComm('slip');
        }
   });

   $('#slipvbroker').keyup(function(e){
        var keyCode = e.keyCode || e.which; 

        if (keyCode != 9) {

            calculateFeeBroker('slip');
            calculateNetPrm('slip');
        }else{
            calculateFeeBroker('slip');
            calculateNetPrm('slip');
        }
    });

   $('#slipvbroker').keydown(function(e){
            var keyCode = e.keyCode || e.which; 

        if (keyCode != 9) {

            calculateFeeBroker('slip');
            calculateNetPrm('slip');

        }else{
            calculateFeeBroker('slip');
            calculateNetPrm('slip');
        }
    });

   $('#slipvbroker').keypress(function(e){
            var keyCode = e.keyCode || e.which; 

        if (keyCode != 9) {

            calculateFeeBroker('slip');
            calculateNetPrm('slip');

        }else{
            calculateFeeBroker('slip');
            calculateNetPrm('slip');
        }
    });
 
   $('#slipsumfee2').keyup(function(e){
        var keyCode = e.keyCode || e.which; 

        if (keyCode != 9) {
            calculatePercentFee('slip');
            calculateNetPrm('slip');
            
        }else{
            calculatePercentFee('slip');
            calculateNetPrm('slip');
        }
   });

   $('#slipsumfee2').keydown(function(e){
        var keyCode = e.keyCode || e.which; 

        if (keyCode != 9) {
            calculatePercentFee('slip');
            calculateNetPrm('slip');
        }else{
            calculatePercentFee('slip');
            calculateNetPrm('slip');
        }
   });

   $('#slipsumfee2').keypress(function(e){
        var keyCode = e.keyCode || e.which; 

        if (keyCode != 9) {
            calculatePercentFee('slip');
            calculateNetPrm('slip');
        }else{
           calculatePercentFee('slip');
            calculateNetPrm('slip');
        }
   });

    $('#slipvbroker').change(function(){

        if( $('#installmentPanel tbody').find('tr').val().length > 0){
            swal('warning!','netprm to nr changed, please change installment amount manually','success')
        }

   });
    $('#slipipdate').change(function(){
        checkInstallmentDate('slip');
    });
    $('#slipipdateupdate').change(function(){
        checkInstallmentDate('update');
    });
    $('#slipipdateendorsement').change(function(){
        checkInstallmentDate('endorsement');
    });
   $('#slipippercentage').keyup(function (e) {
        calculateInstallment('slip')
    });
    

   $('#slipippercentage').keydown(function (e) 
   {
        calculateInstallment('slip')
    });

   $('#slipippercentage').keypress(function (e) {
        calculateInstallment('slip')
    });


   $('#slipippercentage').change(function (e) {
        calculateInstallment('slip')
    });

   $('#slipipamount').change(function(e){
        calculatePercentInstallment('slip')
   });


   $('#slipipamount').keyup(function(e){
        calculatePercentInstallment('slip')
   });

   $('#slipipamount').keypress(function(e){
        calculatePercentInstallment('slip')
   });

   $('#slipipamount').keydown(function(e){
        calculatePercentInstallment('slip')
   });

   $('#slipor').keyup(function(e) {
        if(e.keyCode != 9){
            var percent =  parseFloat($(this).val()) / 100;
            var sumshare = $("#slipsumshare").val();
            var conv_sumshare = parseFloat(sumshare.replace(/,/g, ""));

            var sum = isNaN(percent * conv_sumshare) ? 0 :(percent * conv_sumshare);
            var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            if($(this).val() > 100){
                swal('warning!','percentage cannot more than 100%','sum value error');
                $('#slipsumor').empty();
                $('#slipsumor2').empty();
            }else{
                $('#slipsumor').val(amountToString(sum));
                $('#slipsumor2').val(amountToString(sum));
            }

            


        }
    });

   $('#sliprppercentage').keyup(function (e) {
        calculateRetro('slip')
    });

   $('#sliprppercentage').change(function (e) {
        calculateRetro('slip') 
    });
</script>

<script type="text/javascript">

    $('#mhtypeshare').keyup(function(e)
    {
        var valtsi = $('#sharetotalsum').val();
        var keyCode = e.keyCode || e.which;
        if(keyCode != 9){
            if(valtsi != null){
                calculateAmount('slip')
            }
            else
            {
                calculateAmount('slip')
            }
        }
        else{
            

            if(valtsi != null){
                calculateAmount('slip')
            }
            else
            {
                calculateAmount('slip')
            }
        }

    });

</script>

<script type="text/javascript">
    $('#mhtypeamount').change(function(e){
         var keyCode = e.keyCode || e.which;
         var valtsi = $('#sharetotalsum').val();
        if(keyCode != 9){
            if(valtsi != null){
                calculateShareBasic('slip');
            }else{
                swal('warning!','please fill TSI insured first','error')
            }
        }
        else{
            if(valtsi != null){
                calculateShareBasic('slip');
            }else{
                swal('warning!','please fill TSI insured first','error')
            }
        }

    });

    $('#mhtypeamount').keyup(function(e){
        var keyCode = e.keyCode || e.which;
        calculateShareBasic('slip')

    });

    $('#mhtypepremi').keyup(function(e){
        calculateRate('slip')
    });
    $('#mhtypepremiendorsement').keyup(function(e){
        calculateRate('endorsement')
    });
    
    $('#mhtypeamount').keypress(function(e){
         var keyCode = e.keyCode || e.which;
        if(keyCode != 9){
            calculateShareBasic('slip')
        }
        else{
            calculateShareBasic('slip')   
        }

    });

    $('#mhtypeamount').keydown(function(e){
        var keyCode = e.keyCode || e.which;
        if(keyCode != 9){
            calculateShareBasic('slip')
        }
        else{
            calculateShareBasic('slip')   
        }

    });
</script>

<script type="text/javascript">
    $('#mhtype').change(function(){
        var mhtype = $(this).val();
        var shipcode = $('#shipcodetxt').val();
        if(mhtype){
            $.ajax({
                type:"GET",
                dataType: 'json',
                url:"{{url('get-hull-type')}}?hull_type="+shipcode,
                success:function(response){        
                    if(response){
                        console.log("pilih type : "+ response.group_type)
                        $("#hulltypehidden").val(response.group_type);
                    }else{
                        $("#hulltypehidden").empty();
                    }
                }
            });
        }else{
            $("#hulltypehidden").empty();
        }
    });
</script>


<script type="text/javascript">
    $('#mhtypeupdate').change(function()
    {
        var mhtype = $(this).val();
        var shipcode = $('#shipcodetxt').val();
        if(mhtype)
        {
            $.ajax({
                type:"GET",
                dataType: 'json',
                url:"{{url('get-hull-type')}}?hull_type="+shipcode,
                success:function(response){        
                    if(response){
                        console.log("pilih type : "+ response.group_type)
                        $("#hulltypehiddenupdate").val(response.group_type);
                    }else{
                        $("#hulltypehiddenupdate").empty();
                    }
                }
            });
        }
        else
        {
            $("#hulltypehiddenupdate").empty();
        }
    });
</script>
<!-- akhir perhitungan -->


<!-- awal perhitungan update -->
<script type="text/javascript">
    $('#slipcedingbrokerupdate').change(function(){
        var cedbrok = $(this).val();
        var insuredid = $('#mhnumber').val(); 
        // console.log(cedbrok) 
        var btnins = $("#addinsuredsaveupdate-btn").text();
        // alert(cedbrok);
        console.log("ceding id "+ cedbrok)
        console.log("insured id "+ insuredid)
        console.log("btn ins "+ btnins)
        if(btnins == "Update"){
            if(cedbrok){
                $.ajax({
                    type:"GET",
                    url:"{{url('get-ceding-detail')}}?slip_type=mh&ceding_id="+cedbrok+"&insured_id="+insuredid,
                    beforeSend: function() { $("body").addClass("loading");  },
                    complete: function() {  $("body").removeClass("loading"); },
                    success:function(res){  
                        console.log(res)
                        console.log("type " + res.type)      
                        if(res.type == 4){
                            $("#slipcedingupdate option").remove();


                            $("#slipcedingupdate").append('<option value="'+res.id+'">'+res.code+' - '+res.name+'</option>');

                            console.log(res)
                            console.log("id ceding " +res.id)
                            console.log("ceding code " +res.code)
                            console.log("ceding name " +res.name)
                             

                            var typetsi = $('#sharetypetsiupdate').val();

                            if(typetsi == 2){
                                var ceding_curr = $('#slipcedingupdate').val();
                                var totalsum = $("#sliptotalsumupdate").val();
                                if(res.amountlist > 0)
                                {
                                    console.log('sum amount ' + res.sumamount)
                                    var sum = res.sumamount;
                                    // var conv_sum = sum;
                                    var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    $("#sharetotalsumupdate").val(amountToString(sum));
                                    $("#sharetotalsumupdate2").val(amountToString(sum));
                                }
                                else
                                {
                                    console.log('hasilnya ' + res)
                                }
                            }



                        }else{
                            $("#slipcedingupdate option").remove();
                            $("#slipcedingupdate").append('<option value="#" selected disabled> select ceding </option>');
                            

                            if(res.ceding_list){
                                var list_ceding = res.ceding_list;
                                
                                for(var i = 0; i < list_ceding.length; i++){

                                    var id_ceding = list_ceding[i].ceding_id;
                                    var name_ceding = list_ceding[i].name;
                                    var code_ceding = list_ceding[i].code;
                                    console.log('ceding id '+id_ceding)
                                    console.log('ceding code '+code_ceding)
                                    console.log('ceding name '+name_ceding)

                                     $("#slipcedingupdate").append('<option value="'+id_ceding+'">'+code_ceding+' - '+name_ceding+'</option>');

                                };
                            }else{
                                 swal("Error!", "Please insert insured first", "Get Ceding Error");

                            }   
                        }
                    }
                });
            }
            else{
                swal("Error!", "Please choose Ceding/Broker first", "Get Ceding Error");
            }
        }else if(btnins == "Save"){
            swal('please insert insured first!!!')
        } 
          
    });

    $('#slipcedingupdate').change(function(){
        console.log("ceding choice " + $(this).val() + $( "#slipceding option:selected" ).text())
       
    });   
</script>

<script type="text/javascript">
    $('#sliptypetsiupdate').change(function(){
        var choice = $(this).val();
        var valtsi = $('#mhshareto').val();
        var valcedshare = $('#mhshare').val();
        var insuredid = $('#mhnumber').val(); 
        var cedbrok = $('#slipcedingbrokerupdate').val();
        var ceding = $('#slipcedingupdate').val();

        if(choice == '1'){
            if(valtsi == null || valtsi == ""){
                swal('warning','please fill tsi insured value first','error')
            }else{
                
                var tsi = $('#mhshareto').val();
                var int_tsi = parseFloat(tsi.replace(/,/g, ""));
                var conv_str_tsi = int_tsi;
                var real_tsi = conv_str_tsi.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('#sliptotalsumupdate').val(floatToString(parseFloat(int_tsi)));
                $('#sliptotalsumupdate2').val(floatToString(parseFloat(int_tsi)));

                var tsislip = $('#sliptotalsumupdate').val();
                var pctval = $('#slippctupdate').val();

                if(pctval != null){
                    var pct =  parseFloat($('#slippct').val())/100;
                    var conv_tsi = parseFloat(tsi.replace(/,/g, ""));

                    var sum = isNaN(pct * conv_tsi) ? 0 :(pct * conv_tsi) ;
                    console.log('sum ' + sum)
                    var conv_sum = parseFloat(sum);
                    console.log('conv_sum' + conv_sum)
                    var real_sum = conv_sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    
                    console.log('real_sum' + real_sum)

                    $('#sliptotalsumpctupdate').val(amountToString(conv_sum));
                    $('#sliptotalsumpctupdate2').val(amountToString(conv_sum));
                    // swal('success','changed to tsi','success')


                    var dpamount = $('#slipdpamountupdate').val();
                    var ecamount = $('#slipamountecupdate').val();

                    if(dpamount != null){

                        var percent =  parseFloat($('#slipdppercentageupdate').val()) / 100;
                        
                        var sum = isNaN(percent * conv_tsi) ? 0 :(percent * conv_tsi) ;
                        var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        console.log($('#slipdppercentageupdate').val())
                        console.log(percent)
                        console.log(sum)
                        console.log(real_sum)

                        $('#slipdpamountupdate').val(amountToString(sum));
                        $('#slipdpamountupdate2').val(amountToString(sum));

                    }


                }
            }
        }else if(choice == '2')
        {
            if(cedbrok != null && ceding != null){
                
                $.ajax({
                    type:"GET",
                    url:"{{url('get-ceding-detail')}}?slip_type=mh&ceding_id="+ceding+"&insured_id="+insuredid,
                    beforeSend: function() { $("body").addClass("loading");  },
                    complete: function() {  $("body").removeClass("loading"); },
                    success:function(res){  
                        console.log(res)      
                        if(res.type == 4){

                            var ceding_curr = $('#slipcedingupdate').val();
                            var totalsum = $("#sliptotalsumupdate").val();
                            if(res.amountlist > 0)
                            {
                                console.log('sum amount ' + res.sumamount)
                                var sum = res.sumamount;
                                // var conv_sum = sum;
                                var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                $("#sliptotalsumupdate").val(amountToString(sum));
                                $("#sliptotalsumupdate2").val(amountToString(sum));

                                var tsicedshare = $("#sliptotalsumupdate").val();
                                var pctval = $('#sliptotalsumpctupdate').val();

                                if(pctval != null){

                                    var pct =  parseFloat($('#slippctupdate').val())/100;

                                    // var tsi = $("#sliptotalsum").val();
                                    var conv_tsi = parseInt(tsicedshare.replace(/,/g, ""));

                                    var sum = isNaN(pct * conv_tsi) ? 0 :(pct * conv_tsi) ;
                                    console.log(sum)
                                    var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    $('#sliptotalsumpctupdate').val(amountToString(sum));
                                    $('#sliptotalsumpctupdate2').val(amountToString(sum));
                                    // swal('success','changed to ceding share','success')

                                    var dpamount = $('#slipdpamountupdate').val();
                                    var ecamount = $('#slipamountecupdate').val();

                                    if(dpamount != null){
                                        var percent =  parseFloat($('#slipdppercentageupdate').val()) / 100;
                                        
                                        var sum = isNaN(percent * conv_tsi) ? 0 :(percent * conv_tsi) ;
                                        var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                        console.log($('#slipdppercentageupdate').val())
                                        console.log(percent)
                                        console.log(sum)
                                        console.log(real_sum)

                                        $('#slipdpamountupdate').val(amountToString(sum));
                                        $('#slipdpamountupdate2').val(amountToString(sum));
                                    }


                                }
                            }
                            else
                            {
                                console.log('hasilnya ' + res)
                            }
                        }else{
                            swal('this is broker');
                        }
                    }
                });

                
            }else{
                swal("Error!", "Please choose Ceding/Broker first", "Get Ceding Error")
                $('#sliptotalsumupdate').val('');
                $('#sliptotalsumupdate2').val('');
            }
        }

    });
</script>

<script type="text/javascript">
    $('#sharetypetsiupdate').change(function(){
        var choice = $(this).val();
        if(choice == '1'){

            var tsi = $('#mhshareto').val();
            var int_tsi = parseFloat(tsi.replace(/,/g, ""));
            var conv_str_tsi = int_tsi;
            var real_tsi = conv_str_tsi.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            var valtsi = $('#mhshareto').val();

            if(valtsi == null || valtsi == ""){
                 swal('warning','please fill tsi insured value first','error')
            }else{
                $('#sharetotalsumupdate').val(amountToString(int_tsi));
                $('#sharetotalsumupdate2').val(amountToString(int_tsi));
                // $('#totalhullamount').val(amountToString(int_tsi));
                var grossprm_to_nr = $('#slipgrossprmtonrupdate').val();

                if(grossprm_to_nr != null){
                    var nasionalreinsurance =  $('#mhsharefrom').val();
                    var totalnre =  $('#mhshareto').val();
                    var conv_totalnre =  parseInt(totalnre.replace(/,/g, ""));

                    console.log('nre' + nasionalreinsurance)
                        // console.log(conv_nasionalreinsurance)
                        console.log('totalnre' + totalnre)
                        console.log('convtotnre' + conv_totalnre)
                        
                        var sumshare2 = $('#slipsumshareupdate').val() ;
                        var conv_sumshare = parseInt(sumshare2.replace(/,/g, ""));
                        var basic_premium = $('#totalhullpremiupdate').val();
                        var conv_basre = parseInt(basic_premium.replace(/,/g, ""));

                        var orpercent = $('#sliporupdate').val() / 100;

                        var sumor = isNaN(orpercent * conv_sumshare) ? 0 :(orpercent * conv_sumshare);
                        var real_sumor = sumor.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        
                        var sumgrtoprm = isNaN(conv_basre * shareslip) ? 0 :(conv_basre * shareslip );
                        var real_sumgrtoprm = sumgrtoprm.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        
                        if(nasionalreinsurance){
                            var conv_nasionalreinsurance =  parseInt(nasionalreinsurance.replace(/,/g, ""));
                            var sumnre = isNaN(conv_nasionalreinsurance + conv_sumshare ) ? 0 :(conv_nasionalreinsurance + conv_sumshare) ;
                            var real_sumnre = sumnre.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        }else{
                            var conv_nasionalreinsurance =  parseInt(nasionalreinsurance.replace(/,/g, ""));
                            var sumnre = isNaN(0 + conv_sumshare ) ? 0 :(0 + conv_sumshare) ;
                            var real_sumnre = sumnre.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        }
                        
                        
                        var sumourshare = isNaN((sumnre / conv_totalnre) * 100 ) ? 0 :((sumnre / conv_totalnre) * 100 ) ;

                        console.log('sumnre' + sumnre)
                        console.log('realnre' + real_sumnre)
                        console.log('sumourshare' + sumourshare)

                        $('#slipgrossprmtonrupdate').val(amountToString(sumgrtoprm));
                        $('#slipgrossprmtonrupdate2').val(amountToString(sumgrtoprm));
                        $('#slipsumorupdate').val(amountToString(sumor));
                        $('#slipsumorupdate2').val(amountToString(sumor));
                        // $('#mhshare').val(sumourshare.replace(/,/g, "."));
                        $('#mhsharefrom').val(amountToString(sumnre));


                        var commision =  parseFloat($(this).val()) / 100;
                        var feebroker = parseFloat($('#slipvbrokerupdate').val()) / 100;
                        var sumgrossprmtonr2 = $("#slipgrossprmtonrupdate").val();
                        var conv_sumgrossprmtonr = parseInt(sumgrossprmtonr2.replace(/,/g, ""));

                        var sumcomm = isNaN(commision * conv_sumgrossprmtonr) ? 0 :(commision * conv_sumgrossprmtonr);
                        var real_sumcomm = sumcomm.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                        $('#slipsumcommissionupdate').val(amountToString(sumcomm));
                        $('#slipsumcommissionupdate2').val(amountToString(sumcomm));

                        var sumgrossprmtonr3 = $("#slipgrossprmtonrupdate").val();
                        var conv_sumgrossprmtonr2 = parseInt(sumgrossprmtonr3.replace(/,/g, ""));

                        var sumnetprmtonr = isNaN( conv_sumgrossprmtonr2 * (100/100 - commision - feebroker)) ? 0 :(conv_sumgrossprmtonr2 * (100/100 - commision - feebroker));
                        var real_sumnetprmtonr = sumnetprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                        var sumfeebroker = isNaN( conv_sumgrossprmtonr2 * feebroker) ? 0 :(conv_sumgrossprmtonr2 * feebroker);
                        var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


                        $('#slipnetprmtonrupdate').val(amountToString(sumnetprmtonr));
                        $('#slipnetprmtonrupdate2').val(amountToString(sumnetprmtonr));
                        // $('#slipsumfee').val("100" + "-" + commision.toString() + "-" + feebroker.toString() + "*" + conv_sumgrossprmtonr.toString());
                        $('#slipsumfeeupdate').val(amountToString(sumfeebroker));
                        $('#slipsumfeeupdate2').val(amountToString(sumfeebroker));

                        var sumipamountval = $('#slipipamountupdate').val();

                        if(sumipamountval != null){
                            var percent =  parseFloat($(this).val()) / 100;

                            var sumnetprtonr2 = $("#slipnetprmtonrupdate").val();
                            var conv_sumnetprtonr = parseInt(sumnetprtonr2.replace(/,/g, ""));

                            var sumipamount = isNaN(percent *  conv_sumnetprtonr) ? 0 :(percent *  conv_sumnetprtonr);
                            var real_sumipamount = sumipamount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                            $('#slipipamountupdate').val(amountToString(sumipamount));
                            $('#slipipamountupdate2').val(amountToString(sumipamount));
                        }

                }
            }

            // swal('warning!','change to tsi please change installment and retrocession amount manually','success')
        }else if(choice == '2')
        {

            var insuredid = $('#mhnumber').val(); 
            var cedbrok = $('#slipcedingbrokerupdate').val();
            var ceding = $('#slipcedingupdate').val();
            if(cedbrok != null && ceding != null){
                $.ajax({
                    type:"GET",
                    url:"{{url('get-ceding-detail')}}?slip_type=mh&ceding_id="+ceding+"&insured_id="+insuredid,
                    beforeSend: function() { $("body").addClass("loading");  },
                    complete: function() {  $("body").removeClass("loading"); },
                    success:function(res){  
                        console.log(res)      
                        if(res.type == 4){
                            // $("#slipceding option").remove();


                            // $("#slipceding").append('<option value="'+res.id+'">'+res.type+' - '+res.code+' - '+res.name+'</option>');

                            var ceding_curr = $('#slipcedingupdate').val();
                            var totalsum = $("#sliptotalsumupdate").val();
                            if(res.amountlist > 0)
                            {
                                console.log('sum amount ' + res.sumamount)
                                var sum = res.sumamount;
                                // var conv_sum = sum;
                                var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                $("#sharetotalsumupdate").val(amountToString(sum));
                                $("#sharetotalsumupdate2").val(amountToString(sum));
                                // $('#totalhullamount').val(real_tsi);

                            }
                            else
                            {
                                console.log('hasilnya ' + res)
                            }
                        }else{
                            // $("#slipceding option").remove();
                            // $("#slipceding").append('<option value="#" selected disabled> select ceding </option>');
                            // $("#sliptotalsum").val('');
                            // $("#sliptotalsum2").val('');
                            // $.each(res,function(key,value){
                            //     $("#slipceding").append('<option value="'+value.id+'">'+value.type+' - '+value.code+' - '+value.name+'</option>');

                            // });
                        }
                    }
                });
            }else{
                swal("Error!", "Please choose Ceding/Broker first", "Get Ceding Error");
            }  

            var tsi = $('#mhshare').val();
            $('#sharetotalsumupdate').val(tsi);
            $('#sharetotalsumupdate2').val(tsi);

            var shareslipval = $('#slipshareupdate').val();
            if(shareslipval != null){
                var shareslip =  parseFloat($('#slipshareupdate').val()) / 100 ;
                var conv_tsi = parseFloat(tsi.replace(/,/g, ""));
                var sumshare =isNaN( shareslip * conv_tsi) ? 0 :( shareslip * conv_tsi) ;
                var real_sumshare = sumshare.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


                $('#slipsumshareupdate').val(amountToString(sumshare));
                $('#slipsumshareupdate2').val(amountToString(sumshare));

                var grossprm_to_nr = $('#slipgrossprmtonrupdate').val();

                    if(grossprm_to_nr != null){
                        var nasionalreinsurance =  $('#mhsharefrom').val();
                        var totalnre =  $('#mhshareto').val();
                        var conv_totalnre =  parseInt(totalnre.replace(/,/g, ""));

                        console.log('nre' + nasionalreinsurance)
                            // console.log(conv_nasionalreinsurance)
                            console.log('totalnre' + totalnre)
                            console.log('convtotnre' + conv_totalnre)
                            
                            var sumshare2 = $('#slipsumshareupdate').val() ;
                            var conv_sumshare = parseInt(sumshare2.replace(/,/g, ""));
                            var basic_premium = $('#totalhullpremiupdate').val();
                            var conv_basre = parseInt(basic_premium.replace(/,/g, ""));

                            var orpercent = $('#sliporupdate').val() / 100;

                            var sumor = isNaN(orpercent * conv_sumshare) ? 0 :(orpercent * conv_sumshare);
                            var real_sumor = sumor.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            
                            var sumgrtoprm = isNaN(conv_basre * shareslip) ? 0 :(conv_basre * shareslip );
                            var real_sumgrtoprm = sumgrtoprm.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            
                            if(nasionalreinsurance)
                            {
                                var conv_nasionalreinsurance =  parseInt(nasionalreinsurance.replace(/,/g, ""));
                                var sumnre = isNaN(conv_nasionalreinsurance + conv_sumshare ) ? 0 :(conv_nasionalreinsurance + conv_sumshare) ;
                                var real_sumnre = sumnre.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            }
                            else
                            {
                                var conv_nasionalreinsurance =  parseInt(nasionalreinsurance.replace(/,/g, ""));
                                var sumnre = isNaN(0 + conv_sumshare ) ? 0 :(0 + conv_sumshare) ;
                                var real_sumnre = sumnre.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            }
                            
                            
                            var sumourshare = isNaN((sumnre / conv_totalnre) * 100 ) ? 0 :((sumnre / conv_totalnre) * 100 ) ;

                            console.log('sumnre' + sumnre)
                            console.log('realnre' + real_sumnre)
                            console.log('sumourshare' + sumourshare)

                            $('#slipgrossprmtonrupdate').val(amountToString(sumgrtoprm));
                            $('#slipgrossprmtonrupdate2').val(amountToString(sumgrtoprm));
                            $('#slipsumorupdate').val(amountToString(sumor));
                            $('#slipsumorupdate2').val(amountToString(sumor));
                            // $('#mhshare').val(sumourshare.replace(/,/g, "."));
                            $('#mhsharefrom').val(amountToString(sumnre));


                            var commision =  parseFloat($(this).val()) / 100;
                            var feebroker = parseFloat($('#slipvbrokerupdate').val()) / 100;
                            var sumgrossprmtonr2 = $("#slipgrossprmtonrupdate").val();
                            var conv_sumgrossprmtonr = parseInt(sumgrossprmtonr2.replace(/,/g, ""));

                            var sumcomm = isNaN(commision * conv_sumgrossprmtonr) ? 0 :(commision * conv_sumgrossprmtonr);
                            var real_sumcomm = sumcomm.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                            $('#slipsumcommissionupdate').val(amountToString(sumcomm));
                            $('#slipsumcommissionupdate2').val(amountToString(sumcomm));

                            var sumgrossprmtonr3 = $("#slipgrossprmtonrupdate").val();
                            var conv_sumgrossprmtonr2 = parseInt(sumgrossprmtonr3.replace(/,/g, ""));

                            var sumnetprmtonr = isNaN( conv_sumgrossprmtonr2 * (100/100 - commision - feebroker)) ? 0 :(conv_sumgrossprmtonr2 * (100/100 - commision - feebroker));
                            var real_sumnetprmtonr = sumnetprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                            var sumfeebroker = isNaN( conv_sumgrossprmtonr2 * feebroker) ? 0 :(conv_sumgrossprmtonr2 * feebroker);
                            var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


                            $('#slipnetprmtonrupdate').val(amountToString(sumnetprmtonr));
                            $('#slipnetprmtonrupdate2').val(amountToString(sumnetprmtonr));
                            // $('#slipsumfee').val("100" + "-" + commision.toString() + "-" + feebroker.toString() + "*" + conv_sumgrossprmtonr.toString());
                            $('#slipsumfeeupdate').val(amountToString(sumfeebroker));
                            $('#slipsumfeeupdate2').val(amountToString(sumfeebroker));

                            var sumipamountval = $('#slipipamountupdate').val();

                            if(sumipamountval != null)
                            {
                                var percent =  parseFloat($(this).val()) / 100;

                                var sumnetprtonr2 = $("#slipnetprmtonrupdate").val();
                                var conv_sumnetprtonr = parseInt(sumnetprtonr2.replace(/,/g, ""));

                                var sumipamount = isNaN(percent *  conv_sumnetprtonr) ? 0 :(percent *  conv_sumnetprtonr);
                                var real_sumipamount = sumipamount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                                $('#slipipamountupdate').val(amountToString(sumipamount));
                                $('#slipipamountupdate2').val(amountToString(sumipamount));
                            }

                    }

            }

            // swal('warning!','change to ceding share please change installment and retrocession amount manually','success')

        }
    });
</script>

<script  type='text/javascript'>
   $('#slippctupdate').keyup(function (e) {
        if(e.keyCode != 9){
            var pct =  parseFloat($(this).val())/100;

            var tsi = $("#sliptotalsumupdate").val();
            var conv_tsi = parseFloat(tsi.replace(/,/g, ""));

            var sum = isNaN(pct * conv_tsi) ? 0 :(pct * conv_tsi) ;
            console.log(sum)
            var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            $('#sliptotalsumpctupdate').val(amountToString(sum));
            $('#sliptotalsumpctupdate2').val(amountToString(sum));
        }
    });

   $('#slipdppercentageupdate').keyup(function (e) {
        if(e.keyCode != 9){
            var percent =  parseFloat($(this).val()) / 100;
            var tsi = $("#sliptotalsumupdate").val();
            var conv_tsi = parseFloat(tsi.replace(/,/g, ""));
            var sum = isNaN(percent * conv_tsi) ? 0 :(percent * conv_tsi);
            var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            console.log($(this).val())
            console.log(percent)
            console.log(sum)
            console.log(real_sum)

            $('#slipdpamountupdate').val(floatToString(sum));
            $('#slipdpamountupdate2').val(floatToString(sum));
        }
    });

   $('#slipshareupdate').keyup(function (e) 
       {
        calculateShareBasic('update')
    });

   $('#mhtyperateupdate').keyup(function (e) {
        if(e.keyCode != 9){
        calculateBasicPremium('update')
        }else{
            calculateBasicPremium('update')
        }
    });

   $('#slipshareupdate').change(function (e) {
        if(e.keyCode != 9){
            if($(this).val() < -100 || $(this).val() > 100){
                swal('warning','share cannot lower than -100% or greater than 100%','error')
                $('#slipshareupdate').val('');
                $('#slipsumshareupdate').val('');
                $('#slipsumshareupdate2').val('');
            }
            else{
                calculateGrossPrm('update')                
            }
        }
    });

   $('#slipcommissionupdate').keyup(function (e) {
        var keyCode = e.keyCode || e.which;

        if (keyCode != 9){
            calculateComm('update')
            calculateFeeBroker('update')
        }else{
            calculateComm('update')
            calculateFeeBroker('update')
        }
    });

   $('#slipcommissionupdate').keydown(function (e) {
        var keyCode = e.keyCode || e.which;

        if (keyCode != 9){
            calculateComm('update')
            calculateFeeBroker('update')
        }else{
            calculateComm('update')
            calculateFeeBroker('update')
        }
    });

   $('#slipcommissionupdate').keypress(function (e) {
        var keyCode = e.keyCode || e.which;

        if (keyCode != 9){
            calculateComm('update')
            calculateFeeBroker('update')
        }else{
            calculateComm('update')
            calculateFeeBroker('update')
        }
    });

   $('#slipsumcommissionupdate2').keyup(function(e){
        var keyCode = e.keyCode || e.which; 

        if (keyCode != 9) {
            calculatePercentComm('update')
        }else{
            calculatePercentComm('update')
        }
   });

   $('#slipsumcommissionupdate2').keydown(function(e){
        var keyCode = e.keyCode || e.which; 

        if (keyCode != 9) {
            calculatePercentComm('update')
        }else{
            calculatePercentComm('update')
        }
   });

   $('#slipsumcommissionupdate2').keypress(function(e){
        var keyCode = e.keyCode || e.which; 

        if (keyCode != 9) {
            calculatePercentComm('update')
            calculateNetPrm('update')
        }else{
            calculatePercentComm('update')
            calculateNetPrm('update')
        }
   });

   $('#slipvbrokerupdate').keyup(function(e){
        var keyCode = e.keyCode || e.which; 

        if (keyCode != 9) {

            calculateFeeBroker('update')
            calculateNetPrm('update')
        }else{
            calculateFeeBroker('update')
            calculateNetPrm('update')
        }
    });

   $('#slipvbrokerupdate').keydown(function(e){
            var keyCode = e.keyCode || e.which; 

        if (keyCode != 9) {

            calculateFeeBroker('update')
            calculateNetPrm('update')
        }else{
            calculateFeeBroker('update')
            calculateNetPrm('update')
        }
    });

   $('#slipvbrokerupdate').keypress(function(e){
            var keyCode = e.keyCode || e.which; 

        if (keyCode != 9) {

            calculateFeeBroker('update')
            calculateNetPrm('update')
        }else{
            calculateFeeBroker('update')
            calculateNetPrm('update')
        }
    });
 
   $('#slipsumfeeupdate2').keyup(function(e){
        var keyCode = e.keyCode || e.which; 

        if (keyCode != 9) {
            
            calculatePercentFee('update');
            calculateNetPrm('update');
            
        }else{
            calculatePercentFee('update');
            calculateNetPrm('update');
        }
   });

   $('#slipsumfeeupdate2').keydown(function(e){
        var keyCode = e.keyCode || e.which; 

        if (keyCode != 9) {
            
            calculatePercentFee('update');
            calculateNetPrm('update');
            
        }else{
            calculatePercentFee('update');
            calculateNetPrm('update');
        }
   });

   $('#slipsumfeeupdate2').keypress(function(e){
        var keyCode = e.keyCode || e.which; 

        if (keyCode != 9) {
            
            calculatePercentFee('update');
            calculateNetPrm('update');
            
        }else{
            calculatePercentFee('update');
            calculateNetPrm('update');
        }
   });

    $('#slipvbrokerupdate').change(function(){

        if( $('#installmentPanelUpdate tbody').find('tr').val().length > 0){
            swal('warning!','netprm to nr changed, please change installment amount manually','success')
        }

   });

   $('#slipippercentageupdate').keyup(function (e) 
   {
        calculateInstallment('update')
    });

   $('#slipippercentageupdate').keydown(function (e) {
        calculateInstallment('update')
    });

   $('#slipippercentageupdate').keypress(function (e) {
        calculateInstallment('update')
    });

   $('#slipippercentageupdate').change(function (e) {
        calculateInstallment('update')
    });

   $('#slipipamountupdate').change(function(e){
        calculatePercentInstallment('update')
   });

   $('#slipipamountupdate').keyup(function(e){
        calculatePercentInstallment('update')
   });

   $('#slipipamountupdate').keypress(function(e){
        calculatePercentInstallment('update')
   });

   $('#slipipamountupdate').keydown(function(e){
        calculatePercentInstallment('update')
   });

   $('#sliporupdate').keyup(function(e) {
        if(e.keyCode != 9){
            var percent =  parseFloat($(this).val()) / 100;
            var sumshare = $("#slipsumshareupdate").val();
            var conv_sumshare = parseFloat(sumshare.replace(/,/g, ""));

            var sum = isNaN(percent * conv_sumshare) ? 0 :(percent * conv_sumshare);
            var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            if($(this).val() > 100){
                swal('warning!','percentage cannot more than 100%','sum value error');
                $('#slipsumorupdate').empty();
                $('#slipsumorupdate2').empty();
            }else{
                $('#slipsumorupdate').val(amountToString(sum));
                $('#slipsumorupdate2').val(amountToString(sum));
            }

            


        }
    });

   $('#sliprppercentageupdate').keyup(function (e) {
        calculateRetro('update');
    });

   $('#sliprppercentageupdate').change(function (e) {
        calculateRetro('update');
    });
</script>

<script type="text/javascript">
    $('#mhtypeshareupdate').keyup(function(e){

         var keyCode = e.keyCode || e.which;
         var valtsi = $('#sharetotalsumupdate').val();
        if(keyCode != 9){
            var percentceding = parseFloat($(this).val()) / 100 ;
            

            if(valtsi != null){
                calculateAmount('update');
            }
            else
            {
                swal('warning!','please fill TSI insured first','error')
            }
        }
        else{
            
            if(valtsi != null){
                calculateAmount('update');
            }
            else
            {
                swal('warning!','please fill TSI insured first','error')
            }
        }

    });

  
</script>

<script type="text/javascript">
    $('#mhtypeamountupdate').change(function(e){
         var keyCode = e.keyCode || e.which;
         var valtsi = $('#sharetotalsumupdate').val();
        if(keyCode != 9){
            

            if(valtsi != null){
                calculateShareBasic('update')
            }else{
                swal('warning!','please fill TSI insured first','error')
            }
        }
        else{
            if(valtsi != null){
                calculateShareBasic('update')
            }else{
                swal('warning!','please fill TSI insured first','error')
            }
        }

    });

    $('#mhtypeamountupdate').keyup(function(e){
          var keyCode = e.keyCode || e.which;
        var valtsi = $('#sharetotalsumupdate').val();
        if(keyCode != 9){
            

            if(valtsi != null){
                calculateShareBasic('update')
            }else{
                swal('warning!','please fill TSI insured first','error')
            }
        }
        else{
            if(valtsi != null){
                calculateShareBasic('update')
            }else{
                swal('warning!','please fill TSI insured first','error')
            }
        }

    });

    $('#mhtypeamountupdate').keypress(function(e){
        var keyCode = e.keyCode || e.which;
        var valtsi = $('#sharetotalsumupdate').val();
        if(keyCode != 9){
            

            if(valtsi != null){
                calculateShareBasic('update')
            }else{
                swal('warning!','please fill TSI insured first','error')
            }
        }
        else{
            if(valtsi != null){
                calculateShareBasic('update')
            }else{
                swal('warning!','please fill TSI insured first','error')
            }
        }

    });

    $('#mhtypeamountupdate').keydown(function(e){
         var keyCode = e.keyCode || e.which;
        var valtsi = $('#sharetotalsumupdate').val();
        if(keyCode != 9){
            

            if(valtsi != null){
                calculateShareBasic('update')
            }else{
                swal('warning!','please fill TSI insured first','error')
            }
        }
        else{
            if(valtsi != null){
                calculateShareBasic('update')
            }else{
                swal('warning!','please fill TSI insured first','error')
            }
        }

    });
</script>

<!-- awal perhitungan endorsement -->
<script type="text/javascript">
    $('#slipcedingbrokerendorsement').change(function(){
        var cedbrok = $(this).val();
        var insuredid = $('#mhnumber').val(); 
        // console.log(cedbrok) 
        var btnins = $("#addinsuredsaveendorsement-btn").text();
        // alert(cedbrok);
        console.log("ceding id "+ cedbrok)
        console.log("insured id "+ insuredid)
        console.log("btn ins "+ btnins)
        if(btnins == "endorsement"){
            if(cedbrok){
                $.ajax({
                    type:"GET",
                    url:"{{url('get-ceding-detail')}}?slip_type=mh&ceding_id="+cedbrok+"&insured_id="+insuredid,
                    beforeSend: function() { $("body").addClass("loading");  },
                    complete: function() {  $("body").removeClass("loading"); },
                    success:function(res){  
                        console.log(res)
                        console.log("type " + res.type)      
                        if(res.type == 4){
                            $("#slipcedingendorsement option").remove();


                            $("#slipcedingendorsement").append('<option value="'+res.id+'">'+res.code+' - '+res.name+'</option>');

                            console.log(res)
                            console.log("id ceding " +res.id)
                            console.log("ceding code " +res.code)
                            console.log("ceding name " +res.name)
                             

                            var typetsi = $('#sharetypetsiendorsement').val();

                            if(typetsi == 2){
                                var ceding_curr = $('#slipcedingendorsement').val();
                                var totalsum = $("#sliptotalsumendorsement").val();
                                if(res.amountlist > 0)
                                {
                                    console.log('sum amount ' + res.sumamount)
                                    var sum = res.sumamount;
                                    // var conv_sum = sumd;
                                    var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    $("#sharetotalsumendorsement").val(amountToString(sum));
                                    $("#sharetotalsumendorsement2").val(amountToString(sum));
                                }
                                else
                                {
                                    console.log('hasilnya ' + res)
                                }
                            }



                        }else{
                            $("#slipcedingendorsement option").remove();
                            $("#slipcedingendorsement").append('<option value="#" selected disabled> select ceding </option>');
                            

                            if(res.ceding_list){
                                var list_ceding = res.ceding_list;
                                
                                for(var i = 0; i < list_ceding.length; i++){

                                    var id_ceding = list_ceding[i].ceding_id;
                                    var name_ceding = list_ceding[i].name;
                                    var code_ceding = list_ceding[i].code;
                                    console.log('ceding id '+id_ceding)
                                    console.log('ceding code '+code_ceding)
                                    console.log('ceding name '+name_ceding)

                                     $("#slipcedingendorsement").append('<option value="'+id_ceding+'">'+code_ceding+' - '+name_ceding+'</option>');

                                };
                            }else{
                                 swal("Error!", "Please insert insured first", "Get Ceding Error");

                            }   
                        }
                    }
                });
            }
            else{
                swal("Error!", "Please choose Ceding/Broker first", "Get Ceding Error");
            }
        }else if(btnins == "Save"){
            swal('please insert insured first!!!')
        } 
          
    });

    $('#slipcedingendorsement').change(function(){
        console.log("ceding choice " + $(this).val() + $( "#slipceding option:selected" ).text())
       
    });   
</script>

<script type="text/javascript">
    $('#sliptypetsiendorsement').change(function(){
        var choice = $(this).val();
        var valtsi = $('#mhshareto').val();
        var valcedshare = $('#mhshare').val();
        var insuredid = $('#mhnumber').val(); 
        var cedbrok = $('#slipcedingbrokerendorsement').val();
        var ceding = $('#slipcedingendorsement').val();

        if(choice == '1'){
            if(valtsi == null || valtsi == ""){
                swal('warning','please fill tsi insured value first','error')
            }else{
                
                var tsi = $('#mhshareto').val();
                var int_tsi = parseFloat(tsi.replace(/,/g, ""));
                var conv_str_tsi = int_tsid;
                var real_tsi = conv_str_tsi.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('#sliptotalsumendorsement').val(amountToString(int_tsi));
                $('#sliptotalsumendorsement2').val(amountToString(int_tsi));

                var tsislip = $('#sliptotalsumendorsement').val();
                var pctval = $('#slippctendorsement').val();

                if(pctval != null){
                    var pct =  parseFloat($('#slippct').val())/100;
                    var conv_tsi = parseFloat(tsi.replace(/,/g, ""));

                    var sum = isNaN(pct * conv_tsi) ? 0 :(pct * conv_tsi) ;
                    console.log('sum ' + sum)
                    var conv_sum = parseFloat(sum);
                    console.log('conv_sum' + conv_sum)
                    var real_sum = conv_sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    
                    console.log('real_sum' + real_sum)

                    $('#sliptotalsumpctendorsement').val(amountToString(sum));
                    $('#sliptotalsumpctendorsement2').val(amountToString(sum));
                    // swal('success','changed to tsi','success')


                    var dpamount = $('#slipdpamountendorsement').val();
                    var ecamount = $('#slipamountecendorsement').val();

                    if(dpamount != null){

                        var percent =  parseFloat($('#slipdppercentageendorsement').val()) / 100;
                        
                        var sum = isNaN(percent * conv_tsi) ? 0 :(percent * conv_tsi);
                        var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        console.log($('#slipdppercentageendorsement').val())
                        console.log(percent)
                        console.log(sum)
                        console.log(real_sum)

                        $('#slipdpamountendorsement').val(amountToString(sum));
                        $('#slipdpamountendorsement2').val(amountToString(sum));

                    }


                }
            }
        }else if(choice == '2')
        {
            if(cedbrok != null && ceding != null){
                
                $.ajax({
                    type:"GET",
                    url:"{{url('get-ceding-detail')}}?slip_type=mh&ceding_id="+ceding+"&insured_id="+insuredid,
                    beforeSend: function() { $("body").addClass("loading");  },
                    complete: function() {  $("body").removeClass("loading"); },
                    success:function(res){  
                        console.log(res)      
                        if(res.type == 4){

                            var ceding_curr = $('#slipcedingendorsement').val();
                            var totalsum = $("#sliptotalsumendorsement").val();
                            if(res.amountlist > 0)
                            {
                                console.log('sum amount ' + res.sumamount)
                                var sum = res.sumamount;
                                // var conv_sum = sumd;
                                var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                $("#sliptotalsumendorsement").val(amountToString(sum));
                                $("#sliptotalsumendorsement2").val(amountToString(sum));

                                var tsicedshare = $("#sliptotalsumendorsement").val();
                                var pctval = $('#sliptotalsumpctendorsement').val();

                                if(pctval != null)
                                {

                                    var pct =  parseFloat($('#slippctendorsement').val())/100;

                                    // var tsi = $("#sliptotalsum").val();
                                    var conv_tsi = parseInt(tsicedshare.replace(/,/g, ""));

                                    var sum = isNaN(pct * conv_tsi) ? 0 :(pct * conv_tsi);
                                    console.log(sum)
                                    var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    $('#sliptotalsumpctendorsement').val(amountToString(sum));
                                    $('#sliptotalsumpctendorsement2').val(amountToString(sum));
                                    // swal('success','changed to ceding share','success')

                                    var dpamount = $('#slipdpamountendorsement').val();
                                    var ecamount = $('#slipamountecendorsement').val();

                                    if(dpamount != null){
                                        var percent =  parseFloat($('#slipdppercentageendorsement').val()) / 100;
                                        
                                        var sum = isNaN(percent * conv_tsi) ? 0 :(percent * conv_tsi);
                                        var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                        console.log($('#slipdppercentageendorsement').val())
                                        console.log(percent)
                                        console.log(sum)
                                        console.log(real_sum)

                                        $('#slipdpamountendorsement').val(amountToString(sum));
                                        $('#slipdpamountendorsement2').val(amountToString(sum));
                                    }


                                }
                            }
                            else
                            {
                                console.log('hasilnya ' + res)
                            }
                        }else{
                            swal('this is broker');
                        }
                    }
                });

                
            }else{
                swal("Error!", "Please choose Ceding/Broker first", "Get Ceding Error")
                $('#sliptotalsumendorsement').val('');
                $('#sliptotalsumendorsement2').val('');
            }
        }

    });
</script>

<script type="text/javascript">
    $('#sharetypetsiendorsement').change(function(){
        var choice = $(this).val();
        if(choice == '1'){

            var tsi = $('#mhshareto').val();
            var int_tsi = parseFloat(tsi.replace(/,/g, ""));
            var conv_str_tsi = int_tsid;
            var real_tsi = conv_str_tsi.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            var valtsi = $('#mhshareto').val();

            if(valtsi == null || valtsi == ""){
                 swal('warning','please fill tsi insured value first','error')
            }else{
                $('#sharetotalsumendorsement').val(amountToString(int_tsi));
                $('#sharetotalsumendorsement2').val(amountToString(int_tsi));
                // $('#totalhullamount').val(real_tsi);
                var grossprm_to_nr = $('#slipgrossprmtonrendorsement').val();

                if(grossprm_to_nr != null){
                    var nasionalreinsurance =  $('#mhsharefrom').val();
                    var totalnre =  $('#mhshareto').val();
                    var conv_totalnre =  parseInt(totalnre.replace(/,/g, ""));

                    console.log('nre' + nasionalreinsurance)
                        // console.log(conv_nasionalreinsurance)
                        console.log('totalnre' + totalnre)
                        console.log('convtotnre' + conv_totalnre)
                        
                        var sumshare2 = $('#slipsumshareendorsement').val() ;
                        var conv_sumshare = parseInt(sumshare2.replace(/,/g, ""));
                        var basic_premium = $('#totalhullpremiendorsement').val();
                        var conv_basre = parseInt(basic_premium.replace(/,/g, ""));

                        var orpercent = $('#sliporendorsement').val() / 100;

                        var sumor = isNaN(orpercent * conv_sumshare) ? 0 :(orpercent * conv_sumshare);
                        var real_sumor = sumor.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        
                        var sumgrtoprm = isNaN(conv_basre * shareslip) ? 0 :(conv_basre * shareslip );
                        var real_sumgrtoprm = sumgrtoprm.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        
                        if(nasionalreinsurance){
                            var conv_nasionalreinsurance =  parseInt(nasionalreinsurance.replace(/,/g, ""));
                            var sumnre = isNaN(conv_nasionalreinsurance + conv_sumshare ) ? 0 :(conv_nasionalreinsurance + conv_sumshare);
                            var real_sumnre = sumnre.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        }else{
                            var conv_nasionalreinsurance =  parseInt(nasionalreinsurance.replace(/,/g, ""));
                            var sumnre = isNaN(0 + conv_sumshare ) ? 0 :(0 + conv_sumshare);
                            var real_sumnre = sumnre.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        }
                        
                        
                        var sumourshare = isNaN((sumnre / conv_totalnre) * 100 ) ? 0 :((sumnre / conv_totalnre) * 100 );

                        console.log('sumnre' + sumnre)
                        console.log('realnre' + real_sumnre)
                        console.log('sumourshare' + sumourshare)

                        $('#slipgrossprmtonrendorsement').val(amountToString(sumgrtoprm));
                        $('#slipgrossprmtonrendorsement2').val(amountToString(sumgrtoprm));
                        $('#slipsumorendorsement').val(amountToString(sumor));
                        $('#slipsumorendorsement2').val(amountToString(sumor));
                        // $('#mhshare').val(sumourshare.replace(/,/g, "."));
                        $('#mhsharefrom').val(amountToString(sumnre));


                        var commision =  parseFloat($(this).val()) / 100;
                        var feebroker = parseFloat($('#slipvbrokerendorsement').val()) / 100;
                        var sumgrossprmtonr2 = $("#slipgrossprmtonrendorsement").val();
                        var conv_sumgrossprmtonr = parseInt(sumgrossprmtonr2.replace(/,/g, ""));

                        var sumcomm = isNaN(commision * conv_sumgrossprmtonr) ? 0 :(commision * conv_sumgrossprmtonr);
                        var real_sumcomm = sumcomm.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                        $('#slipsumcommissionendorsement').val(amountToString(sumcomm));
                        $('#slipsumcommissionendorsement2').val(amountToString(sumcomm));

                        var sumgrossprmtonr3 = $("#slipgrossprmtonrendorsement").val();
                        var conv_sumgrossprmtonr2 = parseInt(sumgrossprmtonr3.replace(/,/g, ""));

                        var sumnetprmtonr = isNaN( conv_sumgrossprmtonr2 * (100/100 - commision - feebroker)) ? 0 :(conv_sumgrossprmtonr2 * (100/100 - commision - feebroker));
                        var real_sumnetprmtonr = sumnetprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                        var sumfeebroker = isNaN( conv_sumgrossprmtonr2 * feebroker) ? 0 :(conv_sumgrossprmtonr2 * feebroker);
                        var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


                        $('#slipnetprmtonrendorsement').val(amountToString(sumnetprmtonr));
                        $('#slipnetprmtonrendorsement2').val(amountToString(sumnetprmtonr));
                        // $('#slipsumfee').val("100" + "-" + commision.toString() + "-" + feebroker.toString() + "*" + conv_sumgrossprmtonr.toString());
                        $('#slipsumfeeendorsement').val(amountToString(sumfeebroker));
                        $('#slipsumfeeendorsement2').val(amountToString(sumfeebroker));

                        var sumipamountval = $('#slipipamountendorsement').val();

                        if(sumipamountval != null){
                            var percent =  parseFloat($(this).val()) / 100;

                            var sumnetprtonr2 = $("#slipnetprmtonrendorsement").val();
                            var conv_sumnetprtonr = parseInt(sumnetprtonr2.replace(/,/g, ""));

                            var sumipamount = isNaN(percent *  conv_sumnetprtonr) ? 0 :(percent *  conv_sumnetprtonr);
                            var real_sumipamount = sumipamount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                            $('#slipipamountendorsement').val(amountToString(sumipamount));
                            $('#slipipamountendorsement2').val(amountToString(sumipamount));
                        }

                }
            }

            // swal('warning!','change to tsi please change installment and retrocession amount manually','success')
        }else if(choice == '2')
        {

            var insuredid = $('#mhnumber').val(); 
            var cedbrok = $('#slipcedingbrokerendorsement').val();
            var ceding = $('#slipcedingendorsement').val();
            if(cedbrok != null && ceding != null){
                $.ajax({
                    type:"GET",
                    url:"{{url('get-ceding-detail')}}?slip_type=mh&ceding_id="+ceding+"&insured_id="+insuredid,
                    beforeSend: function() { $("body").addClass("loading");  },
                    complete: function() {  $("body").removeClass("loading"); },
                    success:function(res){  
                        console.log(res)      
                        if(res.type == 4){
                            // $("#slipceding option").remove();


                            // $("#slipceding").append('<option value="'+res.id+'">'+res.type+' - '+res.code+' - '+res.name+'</option>');

                            var ceding_curr = $('#slipcedingendorsement').val();
                            var totalsum = $("#sliptotalsumendorsement").val();
                            if(res.amountlist > 0)
                            {
                                console.log('sum amount ' + res.sumamount)
                                var sum = res.sumamount;
                                // var conv_sum = sumd;
                                var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                $("#sharetotalsumendorsement").val(amountToString(sum));
                                $("#sharetotalsumendorsement2").val(amountToString(sum));
                                // $('#totalhullamount').val(real_tsi);

                            }
                            else
                            {
                                console.log('hasilnya ' + res)
                            }
                        }else{
                            // $("#slipceding option").remove();
                            // $("#slipceding").append('<option value="#" selected disabled> select ceding </option>');
                            // $("#sliptotalsum").val('');
                            // $("#sliptotalsum2").val('');
                            // $.each(res,function(key,value){
                            //     $("#slipceding").append('<option value="'+value.id+'">'+value.type+' - '+value.code+' - '+value.name+'</option>');

                            // });
                        }
                    }
                });
            }else{
                swal("Error!", "Please choose Ceding/Broker first", "Get Ceding Error");
            }  
            var tsi = $('#mhshare').val();
            $('#sharetotalsumendorsement').val(tsi);
            $('#sharetotalsumendorsement2').val(tsi);

            var shareslipval = $('#slipshareendorsement').val();
            if(shareslipval != null){
                var shareslip =  parseFloat($('#slipshareendorsement').val()) / 100 ;
                var conv_tsi = parseFloat(tsi.replace(/,/g, ""));
                var sumshare =isNaN( shareslip * conv_tsi) ? 0 :( shareslip * conv_tsi);
                var real_sumshare = sumshare.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


                $('#slipsumshareendorsement').val(amountToString(sumshare));
                $('#slipsumshareendorsement2').val(amountToString(sumshare));

                var grossprm_to_nr = $('#slipgrossprmtonrendorsement').val();

                    if(grossprm_to_nr != null){
                        var nasionalreinsurance =  $('#mhsharefrom').val();
                        var totalnre =  $('#mhshareto').val();
                        var conv_totalnre =  parseInt(totalnre.replace(/,/g, ""));

                        console.log('nre' + nasionalreinsurance)
                            // console.log(conv_nasionalreinsurance)
                            console.log('totalnre' + totalnre)
                            console.log('convtotnre' + conv_totalnre)
                            
                            var sumshare2 = $('#slipsumshareendorsement').val() ;
                            var conv_sumshare = parseInt(sumshare2.replace(/,/g, ""));
                            var basic_premium = $('#totalhullpremiendorsement').val();
                            var conv_basre = parseInt(basic_premium.replace(/,/g, ""));

                            var orpercent = $('#sliporendorsement').val() / 100;

                            var sumor = isNaN(orpercent * conv_sumshare) ? 0 :(orpercent * conv_sumshare);
                            var real_sumor = sumor.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            
                            var sumgrtoprm = isNaN(conv_basre * shareslip) ? 0 :(conv_basre * shareslip );
                            var real_sumgrtoprm = sumgrtoprm.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            
                            if(nasionalreinsurance){
                                var conv_nasionalreinsurance =  parseInt(nasionalreinsurance.replace(/,/g, ""));
                                var sumnre = isNaN(conv_nasionalreinsurance + conv_sumshare ) ? 0 :(conv_nasionalreinsurance + conv_sumshare);
                                var real_sumnre = sumnre.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            }else{
                                var conv_nasionalreinsurance =  parseInt(nasionalreinsurance.replace(/,/g, ""));
                                var sumnre = isNaN(0 + conv_sumshare ) ? 0 :(0 + conv_sumshare);
                                var real_sumnre = sumnre.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            }
                            
                            
                            var sumourshare = isNaN((sumnre / conv_totalnre) * 100 ) ? 0 :((sumnre / conv_totalnre) * 100 );

                            console.log('sumnre' + sumnre)
                            console.log('realnre' + real_sumnre)
                            console.log('sumourshare' + sumourshare)

                            $('#slipgrossprmtonrendorsement').val(amountToString(sumgrtoprm));
                            $('#slipgrossprmtonrendorsement2').val(amountToString(sumgrtoprm));
                            $('#slipsumorendorsement').val(amountToString(sumor));
                            $('#slipsumorendorsement2').val(amountToString(sumor));
                            // $('#mhshare').val(sumourshare.replace(/,/g, "."));
                            $('#mhsharefrom').val(amountToString(sumnre));


                            var commision =  parseFloat($(this).val()) / 100;
                            var feebroker = parseFloat($('#slipvbrokerendorsement').val()) / 100;
                            var sumgrossprmtonr2 = $("#slipgrossprmtonrendorsement").val();
                            var conv_sumgrossprmtonr = parseInt(sumgrossprmtonr2.replace(/,/g, ""));

                            var sumcomm = isNaN(commision * conv_sumgrossprmtonr) ? 0 :(commision * conv_sumgrossprmtonr);
                            var real_sumcomm = sumcomm.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                            $('#slipsumcommissionendorsement').val(amountToString(sumcomm));
                            $('#slipsumcommissionendorsement2').val(amountToString(sumcomm));

                            var sumgrossprmtonr3 = $("#slipgrossprmtonrendorsement").val();
                            var conv_sumgrossprmtonr2 = parseInt(sumgrossprmtonr3.replace(/,/g, ""));

                            var sumnetprmtonr = isNaN( conv_sumgrossprmtonr2 * (100/100 - commision - feebroker)) ? 0 :(conv_sumgrossprmtonr2 * (100/100 - commision - feebroker));
                            var real_sumnetprmtonr = sumnetprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                            var sumfeebroker = isNaN( conv_sumgrossprmtonr2 * feebroker) ? 0 :(conv_sumgrossprmtonr2 * feebroker);
                            var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


                            $('#slipnetprmtonrendorsement').val(amountToString(sumnetprmtonr));
                            $('#slipnetprmtonrendorsement2').val(amountToString(sumnetprmtonr));
                            // $('#slipsumfee').val("100" + "-" + commision.toString() + "-" + feebroker.toString() + "*" + conv_sumgrossprmtonr.toString());
                            $('#slipsumfeeendorsement').val(amountToString(sumfeebroker));
                            $('#slipsumfeeendorsement2').val(amountToString(sumfeebroker));

                            var sumipamountval = $('#slipipamountendorsement').val();

                            if(sumipamountval != null){
                                var percent =  parseFloat($(this).val()) / 100;

                                var sumnetprtonr2 = $("#slipnetprmtonrendorsement").val();
                                var conv_sumnetprtonr = parseInt(sumnetprtonr2.replace(/,/g, ""));

                                var sumipamount = isNaN(percent *  conv_sumnetprtonr) ? 0 :(percent *  conv_sumnetprtonr);
                                var real_sumipamount = sumipamount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                                $('#slipipamountendorsement').val(amountToString(sumipamount));
                                $('#slipipamountendorsement2').val(amountToString(sumipamount));
                            }

                    }

            }

            // swal('warning!','change to ceding share please change installment and retrocession amount manually','success')

        }
    });
</script>

<script  type='text/javascript'>
   $('#slippctendorsement').keyup(function (e) {
        if(e.keyCode != 9){
            var pct =  parseFloat($(this).val())/100;

            var tsi = $("#sliptotalsumendorsement").val();
            var conv_tsi = parseFloat(tsi.replace(/,/g, ""));

            var sum = isNaN(pct * conv_tsi) ? 0 :(pct * conv_tsi);
            console.log(sum)
            var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            $('#sliptotalsumpctendorsement').val(amountToString(sum));
            $('#sliptotalsumpctendorsement2').val(amountToString(sum));
        }
    });

   $('#slipdppercentageendorsement').keyup(function (e) {
        if(e.keyCode != 9){
            var percent =  parseFloat($(this).val()) / 100;
            var tsi = $("#sliptotalsumendorsement").val();
            var conv_tsi = parseFloat(tsi.replace(/,/g, ""));
            var sum = isNaN(percent * conv_tsi) ? 0 :(percent * conv_tsi);
            var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            console.log($(this).val())
            console.log(percent)
            console.log(sum)
            console.log(real_sum)

            $('#slipdpamountendorsement').val(amountToString(sum));
            $('#slipdpamountendorsement2').val(amountToString(sum));
        }
    });

   $('#slipshareendorsement').keyup(function (e){
        calculateGrossPrm('endorsement')
    });

   $('#mhtyperateendorsement').keyup(function (e) {
        if(e.keyCode != 9){
            calculateBasicPremium('endorsement')
        }else{
            calculateBasicPremium('endorsement')
        }
    });

   $('#slipshareendorsement').change(function (e) {
        
        if(e.keyCode != 9){
            calculateGrossPrm('endorsement')
        }else{
            calculateGrossPrm('endorsement')
        }
    });

   $('#slipcommissionendorsement').keyup(function (e) {
        var keyCode = e.keyCode || e.which;
        if(keyCode != 9){
            calculateComm('endorsement')
            calculateNetPrm('endorsement')
        }else{
            calculateComm('endorsement')
            calculateNetPrm('endorsement')
        }
        
    });

   $('#slipcommissionendorsement').keydown(function (e) {
        var keyCode = e.keyCode || e.which;

        if(keyCode != 9){
            calculateComm('endorsement')
            calculateNetPrm('endorsement')
        }else{
            calculateComm('endorsement')
            calculateNetPrm('endorsement')
        }
    });

   $('#slipcommissionendorsement').keypress(function (e) {
        var keyCode = e.keyCode || e.which;

        if(keyCode != 9){
            calculateComm('endorsement')
            calculateNetPrm('endorsement')
        }else{
            calculateComm('endorsement')
            calculateNetPrm('endorsement')
        }
    });

   $('#slipsumcommissionendorsement2').keyup(function(e){
        var keyCode = e.keyCode || e.which; 

        if(keyCode != 9){
            calculatePercentComm('endorsement')
            calculateNetPrm('endorsement')
        }else{
            calculatePercentComm('endorsement')
            calculateNetPrm('endorsement')
        }
   });

   $('#slipsumcommissionendorsement2').keydown(function(e){
        var keyCode = e.keyCode || e.which; 

        if(keyCode != 9){
            calculatePercentComm('endorsement')
            calculateNetPrm('endorsement')
        }else{
            calculatePercentComm('endorsement')
            calculateNetPrm('endorsement')
        }
   });

   $('#slipsumcommissionendorsement2').keypress(function(e){
        var keyCode = e.keyCode || e.which; 

        if(keyCode != 9){
            calculatePercentComm('endorsement')
            calculateNetPrm('endorsement')
        }else{
            calculatePercentComm('endorsement')
            calculateNetPrm('endorsement')
        }
   });

   $('#slipvbrokerendorsement').keyup(function(e){
        var keyCode = e.keyCode || e.which; 

        if(keyCode != 9){
            calculateFeeBroker('endorsement')
            calculateNetPrm('endorsement')
        }else{
            calculateFeeBroker('endorsement')
            calculateNetPrm('endorsement')
        }
    });

   $('#slipvbrokerendorsement').keydown(function(e){
        var keyCode = e.keyCode || e.which; 

        if (keyCode != 9) {

            calculateFeeBroker('endorsement')
            calculateNetPrm('endorsement')
        }else{
            calculateFeeBroker('endorsement')
            calculateNetPrm('endorsement')
        }
    });

   $('#slipvbrokerendorsement').keypress(function(e){
            var keyCode = e.keyCode || e.which; 

        if (keyCode != 9) {

            calculateFeeBroker('endorsement')
            calculateNetPrm('endorsement')
        }else{
            calculateFeeBroker('endorsement')
            calculateNetPrm('endorsement')
        }
    });
 
   $('#slipsumfeeendorsement2').keyup(function(e){
        var keyCode = e.keyCode || e.which; 

        if (keyCode != 9) {

            calculatePercentFee('endorsement')
            calculateNetPrm('endorsement')
        }else{
            calculatePercentFee('endorsement')
            calculateNetPrm('endorsement')
        }
   });

   $('#slipsumfeeendorsement2').keydown(function(e){
        var keyCode = e.keyCode || e.which; 

        if (keyCode != 9) {

            calculatePercentFee('endorsement')
            calculateNetPrm('endorsement')
        }else{
            calculatePercentFee('endorsement')
            calculateNetPrm('endorsement')
        }
   });

   $('#slipsumfeeendorsement2').keypress(function(e){
        var keyCode = e.keyCode || e.which; 

        if (keyCode != 9) {

            calculatePercentFee('endorsement')
            calculateNetPrm('endorsement')
        }else{
            calculatePercentFee('endorsement')
            calculateNetPrm('endorsement')
        }
   });

    $('#slipvbrokerendorsement').change(function(){

        if( $('#installmentPanelendorsement tbody').find('tr').val().length > 0){
            swal('warning!','netprm to nr changed, please change installment amount manually','success')
        }

   });

   $('#slipippercentageendorsement').keyup(function (e) {
        calculateInstallment('endorsement')
    });

   $('#slipippercentageendorsement').keydown(function (e) {
        calculateInstallment('endorsement')
    });

   $('#slipippercentageendorsement').keypress(function (e) {
        calculateInstallment('endorsement')
    });

   $('#slipippercentageendorsement').change(function (e) {
        calculateInstallment('endorsement')
    });

   $('#slipipamountendorsement').change(function(e){
        calculatePercentInstallment('endorsement')
   });

   $('#slipipamountendorsement').keyup(function(e){
        calculatePercentInstallment('endorsement')
   });

   $('#slipipamountendorsement').keypress(function(e){
        calculatePercentInstallment('endorsement')
   });

   $('#slipipamountendorsement').keydown(function(e){
        calculatePercentInstallment('endorsement')
   });

   $('#sliporendorsement').keyup(function(e) {
        if(e.keyCode != 9){
            var percent =  parseFloat($(this).val()) / 100;
            var sumshare = $("#slipsumshareendorsement").val();
            var conv_sumshare = parseFloat(sumshare.replace(/,/g, ""));

            var sum = isNaN(percent * conv_sumshare) ? 0 :(percent * conv_sumshare);
            var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            if($(this).val() > 100){
                swal('warning!','percentage cannot more than 100%','sum value error');
                $('#slipsumorendorsement').empty();
                $('#slipsumorendorsement2').empty();
            }else{
                $('#slipsumorendorsement').val(amountToString(sum));
                $('#slipsumorendorsement2').val(amountToString(sum));
            }

            


        }
    });

   $('#sliprppercentageendorsement').keyup(function (e) {
        calculateRetro('endorsement');
    });

   $('#sliprppercentageendorsement').change(function (e) {
       calculateRetro('endorsement');
    });
</script>

<script type="text/javascript">
    $('#mhtypeshareendorsement').keyup(function(e){
         var keyCode = e.keyCode || e.which;
         var valtsi = $('#sharetotalsumendorsement').val();
        if(keyCode != 9){
            

            if(valtsi != null){
                calculateAmount('endorsement')
            }
            else
            {
                swal('warning!','please fill TSI insured first','error')
            }
        }
        else{
            if(valtsi != null){
                calculateAmount('endorsement')
            }
            else
            {
                swal('warning!','please fill TSI insured first','error')
            }
        }

    });

    $('#mhtypeshareendorsement').change(function(e){
         var keyCode = e.keyCode || e.which;
         var valtsi = $('#sharetotalsumendorsement').val();
        if(keyCode != 9){
            

            if(valtsi != null){
                calculateAmount('endorsement')
            }
            else
            {
                swal('warning!','please fill TSI insured first','error')
            }
        }
        else{
            if(valtsi != null){
                calculateAmount('endorsement')
            }
            else
            {
                swal('warning!','please fill TSI insured first','error')
            }
        }

    });

    $('#mhtypeshareendorsement').keydown(function(e){
         var keyCode = e.keyCode || e.which;
        var valtsi = $('#sharetotalsumendorsement').val();
        if(keyCode != 9){
            

            if(valtsi != null){
                calculateAmount('endorsement')
            }
            else
            {
                swal('warning!','please fill TSI insured first','error')
            }
        }
        else{
            if(valtsi != null){
                calculateAmount('endorsement')
            }
            else
            {
                swal('warning!','please fill TSI insured first','error')
            }
        }
    });

    $('#mhtypeshareendorsement').keypress(function(e){
         var keyCode = e.keyCode || e.which;
        var valtsi = $('#sharetotalsumendorsement').val();
        if(keyCode != 9){
            

            if(valtsi != null){
                calculateAmount('endorsement')
            }
            else
            {
                swal('warning!','please fill TSI insured first','error')
            }
        }
        else{
            if(valtsi != null){
                calculateAmount('endorsement')
            }
            else
            {
                swal('warning!','please fill TSI insured first','error')
            }
        }

    });
</script>

<script type="text/javascript">
    $('#mhtypeamountendorsement').change(function(e){
         var keyCode = e.keyCode || e.which;
        var valtsi = $('#sharetotalsumendorsement').val();
        if(keyCode != 9){
            

            if(valtsi != null){
                calculateShareBasic('endorsement')
            }
            else
            {
                swal('warning!','please fill TSI insured first','error')
            }
        }
        else{
            if(valtsi != null){
                calculateShareBasic('endorsement')
            }
            else
            {
                swal('warning!','please fill TSI insured first','error')
            }
        }

    });

    $('#mhtypeamountendorsement').keyup(function(e){
          var keyCode = e.keyCode || e.which;
        var valtsi = $('#sharetotalsumendorsement').val();
        if(keyCode != 9){
            

            if(valtsi != null){
                calculateShareBasic('endorsement')
            }
            else
            {
                swal('warning!','please fill TSI insured first','error')
            }
        }
        else{
            if(valtsi != null){
                calculateShareBasic('endorsement')
            }
            else
            {
                swal('warning!','please fill TSI insured first','error')
            }
        }

    });

    $('#mhtypeamountendorsement').keypress(function(e){
        var keyCode = e.keyCode || e.which;
        var valtsi = $('#sharetotalsumendorsement').val();
        if(keyCode != 9){
            

            if(valtsi != null){
                calculateShareBasic('endorsement')
            }
            else
            {
                swal('warning!','please fill TSI insured first','error')
            }
        }
        else{
            if(valtsi != null){
                calculateShareBasic('endorsement')
            }
            else
            {
                swal('warning!','please fill TSI insured first','error')
            }
        }

    });

    $('#mhtypeamountendorsement').keydown(function(e){
        var keyCode = e.keyCode || e.which;
        
        var valtsi = $('#sharetotalsumendorsement').val();
        if(keyCode != 9){
            

            if(valtsi != null){
                calculateShareBasic('endorsement')
            }
            else
            {
                swal('warning!','please fill TSI insured first','error')
            }
        }
        else{
            if(valtsi != null){
                calculateShareBasic('endorsement')
            }
            else
            {
                swal('warning!','please fill TSI insured first','error')
            }
        }
    });
</script>

<script type="text/javascript">
    $('#mhtypeendorsement').change(function(){
        var mhtype = $(this).val();
        var shipcode = $('#shipcodetxt').val();
        
        if(mhtype){
            $.ajax({
                type:"GET",
                dataType: 'json',
                url:"{{url('get-hull-type')}}?hull_type="+shipcode,
                success:function(response){        
                    if(response){
                        console.log("pilih type : "+ response.group_type)
                        $("#hulltypehiddenendorsement").val(response.group_type);
                    }else{
                        $("#hulltypehiddenendorsement").empty();
                    }
                }
            });
        }else{
            $("#hulltypehiddenendorsement").empty();
        }
    });
</script>
<!-- akhir perhitungan endorsement -->


<!-- awal table form -->
<script type='text/javascript'>
     $('#addhullcount-btn').click(function(e)
     {
        e.preventDefault();
        alert("bisa " + $('#mhtypeamount').val())

        var type = $('#mhtype').val();
        var share = $('#mhtypeshare').val();
        var insured_id = $('#mhnumber').val();
        var amount = $('#mhtypeamount').val();
        var rate = $('#mhtyperate').val();
        var premi = $('#mhtypepremi').val();
        var slip_id = $('#slipnumber').val();
        var token = $('input[name=_token]').val();
        var slip_type = 'mh';
        var sumtotal_percent = $('#totalhullshare').val();
        var type_hull = $('#hulltypehidden').val();
        var sum_precent_war = $('#totalhullwar').val();
        var sum_precent_hmiv = $('#totalhullhmiv').val();

        var sumtotal_percent = $('#totalhullshare').val();
 
        if(sumtotal_percent == null || sumtotal_percent == "" ){
            var conv_sumtotal_percent = parseFloat("0");
        }else{
            var conv_sumtotal_percent = parseFloat(sumtotal_percent);
        }

       if(sum_precent_war == null || sum_precent_war == "" ){
            var conv_sum_precent_war = parseFloat("0");
       }else{
            var conv_sum_precent_war = parseFloat(sum_precent_war);
       }

       if(sum_precent_hmiv == null || sum_precent_hmiv == "" ){
            var conv_sum_precent_hmiv = parseFloat("0");
       }else{
            var conv_sum_precent_hmiv = parseFloat(sum_precent_hmiv);
       }
       
       var conv_percentage = parseFloat(share);

       var real_count_percent = conv_sumtotal_percent + conv_sum_precent_war + conv_sum_precent_hmiv;
       console.log("total percent " + conv_sumtotal_percent)
       console.log("percent baru " + conv_percentage)
       console.log("hasilnya " + real_count_percent)

       var conv_amount = amount.replace(/,/g, "");
       console.log(conv_amount)
       var real_amount = parseFloat(conv_amount);
       console.log(real_amount)

        var conv_amount = amount.replace(/,/g, "");
       console.log('conv_amount ' + conv_amount)
       var real_amount = parseFloat(conv_amount);
       console.log('real_amount ' + real_amount)

       var conv_premi = premi.replace(/,/g, "");
       console.log('conv_amount ' + conv_premi)
       var real_premi = parseFloat(conv_premi);
       console.log('real_amount ' + real_premi)

       console.log('shipcode ' + type )
       console.log('shipname ' + share)
       console.log('insured_id ' + insured_id)
       console.log('ceding ' + amount )
       console.log('percent ' + rate )
       console.log('cndn ' + premi )
       console.log('slip_type ' + slip_type )
        
        if(real_count_percent <= 200 ){
            if(type == 3 && parseFloat(share) < 100)
            {
                swal('warning!','WAR type must 100%','validation error');
            }
            else
            {

                    if(type_hull == 1)
                    {

                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });


                        $.ajax({
                            url:"{{ route('hullcount.store') }}",
                            type:"POST",
                            data:{
                                type_id:type,
                                share:share,
                                amount:real_amount,
                                rate:rate,
                                basic_premium:real_premi,
                                insured_id:insured_id,
                                slip_id:slip_id,
                                sliptype:slip_type,
                                grouptype:type_hull
                                // _token:token
                            },
                            beforeSend: function() { $("body").addClass("loading");  },
                            complete: function() {  $("body").removeClass("loading"); },
                            success:function(response){
                                console.log(response)

                                var amount = response.amount;
                                
                                console.log('amount' + amount)
                                var fl_amount = parseFloat(amount);
                                console.log('amount float' + fl_amount)
                                var new_amount = fl_amount;
                                console.log('amount to fixed' + new_amount)
                                var curr_amount = new_amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                console.log('current amount' + curr_amount) 

                                var premi = response.premi;
                                
                                console.log('premi' + premi)
                                var fl_premi = parseFloat(premi);
                                console.log('premi float' + fl_premi)
                                var new_premi = fl_premi;
                                console.log('premi to fixed' + new_premi)
                                var curr_premi = new_premi.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                console.log('current premi' + curr_premi) 


                                var cndn = '';
                                var certno = '';
                                var slipno = '';
                                var policyno = '';

                                var percent = response.share;
                                var percentfl = parseFloat(percent);
                                var new_percent = percentfl;

                                var percentrate = response.rate;
                                var percentflrate = parseFloat(percentrate);
                                var new_rate = percentflrate;

                                

                                $('#marineHullCountTable > tbody:last-child').append('<tr id="hcid'+response.id+'"  data-name="">'+
                                    '<td>'+response.type_code+'</td>'+
                                    '<td>'+new_percent+'</td>'+
                                    '<td>'+curr_amount+'</td>'+
                                    '<td>'+new_rate+'</td>'+
                                    '<td>'+curr_premi+'</td>'+
                                    '<td><a href="javascript:void(0)" onclick="deletehullcount('+response.id+')">'+
                                    '<i class="fas fa-trash text-danger"></i></a></td>'+
                                    '</tr>')


                                    console.log("sum premi" + response.sum_premi)

                                $('#totalhullpremi').val("");
                                $('#totalhullamount').val("");
                                $('#totalhullshare').val("");

                                

                                if(response.sum_share){
                                    var total_share = response.sum_share;
                                    var countwar = $('#totalhullwar').val();                                    
                                    var conv_totalshare = total_share.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    
                                    if(countwar == null || countwar = ""){
                                      var sumsharewar =  isNaN(parseFloat(total_share) + parseFloat("0")) ? 0 :(parseFloat(total_share) + parseFloat("0"));


                                      $('#totalhullwar').val(sumsharewar);
                                    }else{
                                      var sumsharewar =  isNaN(parseFloat(total_share) + parseFloat(countwar)) ? 0 :(parseFloat(total_share) + parseFloat(countwar));

                                        $('#totalhullwar').val(sumsharewar);
                                    } 
                                }

                                var warhull = parseFloat($('#totalhullwar').val());
                                var hmivhull = parseFloat($('#totalhullhmiv').val());

                                if((warhull + hmivhull) == 200.000 ){
                                    $('#addhullcount-btn').attr('hidden','true');
                                }
                                

                                $('#ModalCountHull').modal('toggle');
                                $('#form-hulltypecount')[0].reset();
                            }
                        });
                    }
                    else
                    {
                            var sumhmivshare = $('#totalhullhmiv').val();

                            if(sumhmivshare)
                            {
                           
                            }
                            else
                            {
                             sumhmivshare=0;
                            } 

                            var totalshare = parseFloat(share) + parseFloat(sumhmivshare);

                            if(totalshare <= 100)
                            {
                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                });

                                $.ajax({
                                    url:"{{ route('hullcount.store') }}",
                                    type:"POST",
                                    data:{
                                        type_id:type,
                                        share:share,
                                        amount:real_amount,
                                        rate:rate,
                                        basic_premium:real_premi,
                                        insured_id:insured_id,
                                        slip_id:slip_id,
                                        sliptype:slip_type,
                                        grouptype:type_hull
                                        // _token:token
                                    },
                                    beforeSend: function() { $("body").addClass("loading");  },
                                    complete: function() {  $("body").removeClass("loading"); },
                                    success:function(response){
                                        console.log(response)

                                        var amount = response.amount;
                                        
                                        console.log('amount' + amount)
                                        var fl_amount = parseFloat(amount);
                                        console.log('amount float' + fl_amount)
                                        var new_amount = fl_amount;
                                        console.log('amount to fixed' + new_amount)
                                        var curr_amount = new_amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                        console.log('current amount' + curr_amount) 

                                        var premi = response.premi;
                                        
                                        console.log('premi' + premi)
                                        var fl_premi = parseFloat(premi);
                                        console.log('premi float' + fl_premi)
                                        var new_premi = fl_premi;
                                        console.log('premi to fixed' + new_premi)
                                        var curr_premi = new_premi.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                        console.log('current premi' + curr_premi) 


                                        var cndn = '';
                                        var certno = '';
                                        var slipno = '';
                                        var policyno = '';

                                        var percent = response.share;
                                        var percentfl = parseFloat(percent);
                                        var new_percent = percentfl;

                                        var percentrate = response.rate;
                                        var percentflrate = parseFloat(percentrate);
                                        var new_rate = percentflrate;

                                        // $('#sumhmivshare').val(response.share);

                                        $('#marineHullCountTable > tbody:last-child').append('<tr id="hcid'+response.id+'"  data-name="">'+
                                            '<td>'+response.type_code+'</td>'+
                                            '<td>'+new_percent+'</td>'+
                                            '<td>'+curr_amount+'</td>'+
                                            '<td>'+new_rate+'</td>'+
                                            '<td>'+curr_premi+'</td>'+
                                            '<td><a href="javascript:void(0)" onclick="deletehullcount('+response.id+')">'+
                                            '<i class="fas fa-trash text-danger"></i></a></td>'+
                                            '</tr>')


                                            console.log("sum premi" + response.sum_premi)

                                        $('#totalhullpremi').val("");
                                        $('#totalhullamount').val("");
                                        $('#totalhullshare').val("");

                                        if(response.sum_share){
                                            var total_share = response.sum_share;
                                            var countwar = $('#totalhullwar').val();                                    
                                            var conv_totalshare = total_share.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                        
                                                if(countwar == null || countwar = ""){
                                                  var sumsharewar =  isNaN(parseFloat(total_share) + parseFloat("0")) ? 0 :(parseFloat(total_share) + parseFloat("0"));


                                                  $('#totalhullwar').val(sumsharewar);
                                                }else{
                                                  var sumsharewar =  isNaN(parseFloat(total_share) + parseFloat(countwar)) ? 0 :(parseFloat(total_share) + parseFloat(countwar));

                                                    $('#totalhullwar').val(sumsharewar);
                                                } 
                                        }

                                        var warhull = parseFloat($('#totalhullwar').val());
                                        var hmivhull = parseFloat($('#totalhullhmiv').val());

                                        // if((warhull + hmivhull) == 200.000 ){
                                        //     $('#addhullcount-btn').attr('hidden','true');
                                        // }else{
                                        //     swal('warning!','share HM+IV must 100 %. insert again','validation error');
                                        // }
                                        
                                            

                                        $('#ModalCountHull').modal('toggle');
                                        $('#form-hulltypecount')[0].reset();
                                }
                                
                            });
                            
                            }else{
                                swal('warning!','share HM+IV cannot more than 100 %','validation error');
                            }
                        
                    }


            }

        }else{
                swal('warning!','share cannot more than 200 %','validation error');

        }

    });
</script>


<!-- awal table form -->
<script type='text/javascript'>
   $("#addhulltypeupdate-btn").click(function(e){  
       
       e.preventDefault();
       var type = $('#mhtypeupdate').val();
       var share = $('#mhtypeshareupdate').val();
       var insured_id = $('#mhnumber').val();
       var amount = $('#mhtypeamountupdate').val();
       var rate = $('#mhtyperateupdate').val();
       var premi = $('#mhtypepremiupdate').val();
       var slip_id = $('#slipnumberupdate').val();
       var token = $('input[name=_token]').val();
       var slip_type = 'mh';
       var type_hull = $('#hulltypehiddenupdate').val();  
       var sum_precent_war = $('#totalhullwarupdate').val();
       var sum_precent_hmiv = $('#totalhullhmivupdate').val();

      var sumtotal_percent = $('#totalhullshareupdate').val();
 
      if(sumtotal_percent == null || sumtotal_percent == "" ){
           var conv_sumtotal_percent = parseFloat("0");
      }else{
           var conv_sumtotal_percent = parseFloat(sumtotal_percent);
      }

      if(sum_precent_war == null || sum_precent_war == "" ){
           var conv_sum_precent_war = parseFloat("0");
      }else{
           var conv_sum_precent_war = parseFloat(sum_precent_war);
      }

      if(sum_precent_hmiv == null || sum_precent_hmiv == "" ){
           var conv_sum_precent_hmiv = parseFloat("0");
      }else{
           var conv_sum_precent_hmiv = parseFloat(sum_precent_hmiv);
      }
      
      var conv_percentage = parseFloat(share);

      var real_count_percent = conv_sumtotal_percent + conv_sum_precent_war + conv_sum_precent_hmiv;
      console.log("total percent " + conv_sumtotal_percent)
      console.log("percent baru " + conv_percentage)
      console.log("hasilnya " + real_count_percent)

      var conv_amount = amount.replace(/,/g, "");
      console.log(conv_amount)
      var real_amount = parseFloat(conv_amount);
      console.log(real_amount)

       var conv_amount = amount.replace(/,/g, "");
      console.log('conv_amount ' + conv_amount)
      var real_amount = parseFloat(conv_amount);
      console.log('real_amount ' + real_amount)

      var conv_premi = premi.replace(/,/g, "");
      console.log('conv_amount ' + conv_premi)
      var real_premi = parseFloat(conv_premi);
      console.log('real_amount ' + real_premi)

      console.log('shipcode ' + type )
      console.log('shipname ' + share)
      console.log('insured_id ' + insured_id)
      console.log('ceding ' + amount )
      console.log('percent ' + rate )
      console.log('cndn ' + premi )
      console.log('slip_type ' + slip_type )
      var token = $('input[name=_token]').val();

      if(real_count_percent <= 200 )
      {
           if(type == 3 && parseFloat(share) < 100)
           {
               swal('warning!','WAR type must 100%','validation error');
           }
           else
           {
                 
               if(type_hull == 1)
                   {

                       $.ajaxSetup({
                           headers: {
                               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                           }
                       });

                       $.ajax({
                           url:"{{ route('hullcount.store') }}",
                           type:"POST",
                           data:{
                               type_id:type,
                               share:share,
                               amount:real_amount,
                               rate:rate,
                               basic_premium:real_premi,
                               insured_id:insured_id,
                               slip_id:slip_id,
                               sliptype:slip_type,
                               grouptype:type_hull,
                               _token:token
                           },
                           beforeSend: function() { $("body").addClass("loading");  },
                           complete: function() {  $("body").removeClass("loading"); },
                           success:function(response)
                           {
                               console.log(response)

                               var amount = response.amount;
                               
                               console.log('amount' + amount)
                               var fl_amount = parseFloat(amount);
                               console.log('amount float' + fl_amount)
                               var new_amount = fl_amount;
                               console.log('amount to fixed' + new_amount)
                               var curr_amount = new_amount.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                               console.log('current amount' + curr_amount) 

                               var premi = response.premi;
                               
                               console.log('premi' + premi)
                               var fl_premi = parseFloat(premi);
                               console.log('premi float' + fl_premi)
                               var new_premi = fl_premi;
                               console.log('premi to fixed' + new_premi)
                               var curr_premi = new_premi.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                               console.log('current premi' + curr_premi) 

                               var cndn = '';
                               var certno = '';
                               var slipno = '';
                               var policyno = '';

                               var percent = response.share;
                               var percentfl = parseFloat(percent);
                               var new_percent = percentfl;

                               var percentrate = response.rate;
                               var percentflrate = parseFloat(percentrate);
                               var new_rate = percentflrate;

                               

                               $('#marineHullCountTableUpdate > tbody:last-child').append('<tr id="hcupdateid'+response.id+'"  data-name="">'+
                                   '<td>'+response.type_name+'</td>'+
                                   '<td>'+floatToString(response.share)+'</td>'+
                                   '<td>'+amountToString(response.amount)+'</td>'+
                                   '<td>'+floatToString(response.rate)+'</td>'+
                                   '<td>'+amountToString(response.premi)+'</td>'+
                                   '<td><a href="javascript:void(0)" onclick="deletehullcountupdate('+response.id+')">'+
                                   '<i class="fas fa-trash text-danger"></i></a></td>'+
                                   '</tr>')


                               console.log("sum premi" + response.sum_premi)

                               $('#totalhullpremiupdate').val("");
                               $('#totalhullamountupdate').val("");
                               $('#totalhullshareupdate').val("");

                                var sumshare = 0;
                                if(response.sum_share)
                                {
                                    sumshare = response.sum_share;  
                                   
                                    $('#totalhullshareupdate').val(amountToString(sumshare));
                                }
                                else
                                {
                                   
                                    $('#totalhullshareupdate').val(0);
                                }

                                if(response.sum_amount){
                                    var sumamount = response.sum_amount;
                                    var fl_amount = parseFloat(sumamount);
                                    var new_amount = fl_amount;
                                    var curr_amount = new_amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    $('#totalhullamountupdate').val(curr_amount);

                                }
                                else
                                {
                                    $('#totalhullamountupdate').val(0);
                                }

                                if(response.sum_premi){
                                    var sumpremi = response.sum_premi;
                                    var fl_premi = parseFloat(sumpremi);
                                    var new_premi = fl_premi;
                                    var curr_premi = new_premi.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    $('#totalhullpremiupdate').val(curr_premi);
                                
                                }
                                else
                                {
                                    $('#totalhullpremiupdate').val(0);
                                }

                               var warhull = parseFloat($('#totalhullwarupdate').val());
                               var hmivhull = parseFloat($('#totalhullhmivupdate').val());


                                if(response.sum_share >= 200.000 )
                                {
                                    $('#addhullcountupdate-btn').attr('hidden','true');
                                }
                               

                               $('#ModalCountHullUpdate').modal('toggle');
                               $('#form-hulltypecountupdate')[0].reset();

                           }
                       });
                   
                   }
                   else
                   {
                           var sumhmivshare = $('#totalhullhmivupdate').val();
                           
                           if(sumhmivshare)
                           {
                           
                           }
                           else
                           {
                            sumhmivshare=0;
                           }
                           //alert(share);
                           var totalshare = parseFloat(share) + parseFloat(sumhmivshare);

                           if(totalshare <= 100)
                           {
                               $.ajaxSetup({
                                   headers: {
                                       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                   }
                               });

                               $.ajax({
                                   url:"{{ route('hullcount.store') }}",
                                   type:"POST",
                                   data:{
                                       type_id:type,
                                       share:share,
                                       amount:real_amount,
                                       rate:rate,
                                       basic_premium:real_premi,
                                       insured_id:insured_id,
                                       slip_id:slip_id,
                                       sliptype:slip_type,
                                       grouptype:type_hull
                                       // _token:token
                                   },
                                   beforeSend: function() { $("body").addClass("loading");  },
                                   complete: function() {  $("body").removeClass("loading"); },
                                   success:function(response){
                                       console.log(response)

                                       var amount = response.amount;
                                       
                                       console.log('amount' + amount)
                                       var fl_amount = parseFloat(amount);
                                       console.log('amount float' + fl_amount)
                                       var new_amount = fl_amount;
                                       console.log('amount to fixed' + new_amount)
                                       var curr_amount = new_amount.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                       console.log('current amount' + curr_amount) 

                                       var premi = response.premi;
                                       
                                       console.log('premi' + premi)
                                       var fl_premi = parseFloat(premi);
                                       console.log('premi float' + fl_premi)
                                       var new_premi = fl_premi;
                                       console.log('premi to fixed' + new_premi)
                                       var curr_premi = new_premi.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                       console.log('current premi' + curr_premi) 


                                       var cndn = '';
                                       var certno = '';
                                       var slipno = '';
                                       var policyno = '';

                                       var percent = response.share;
                                       var percentfl = parseFloat(percent);
                                       var new_percent = percentfl;

                                       var percentrate = response.rate;
                                       var percentflrate = parseFloat(percentrate);
                                       var new_rate = percentflrate;

                                       // $('#sumhmivshare').val(response.share);

                                       $('#marineHullCountTableUpdate > tbody:last-child').append('<tr id="hcupdateid'+response.id+'"  data-name="">'+
                                   '<td>'+response.type_name+'</td>'+
                                   '<td>'+floatToString(response.share)+'</td>'+
                                   '<td>'+amountToString(response.amount)+'</td>'+
                                   '<td>'+floatToString(response.rate)+'</td>'+
                                   '<td>'+amountToString(response.premi)+'</td>'+
                                   '<td><a href="javascript:void(0)" onclick="deletehullcountupdate('+response.id+')">'+
                                   '<i class="fas fa-trash text-danger"></i></a></td>'+
                                   '</tr>')


                                           console.log("sum premi" + response.sum_premi)

                                       $('#totalhullpremiupdate').val("");
                                       $('#totalhullamountupdate').val("");
                                       $('#totalhullshareupdate').val("");
                                       
                                        var sumshare = 0;
                                        if(response.sum_share)
                                        {
                                            sumshare = response.sum_share;  
                                           
                                            $('#totalhullshareupdate').val(amountToString(sumshare));
                                        }
                                        else
                                        {
                                           
                                            $('#totalhullshareupdate').val(0);
                                        }

                                        if(response.sum_amount){
                                            var sumamount = response.sum_amount;
                                            var fl_amount = parseFloat(sumamount);
                                            var new_amount = fl_amount;
                                            var curr_amount = new_amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                            $('#totalhullamountupdate').val(curr_amount);

                                        }
                                        else
                                        {
                                            $('#totalhullamountupdate').val(0);
                                        }

                                        if(response.sum_premi){
                                            var sumpremi = response.sum_premi;
                                            var fl_premi = parseFloat(sumpremi);
                                            var new_premi = fl_premi;
                                            var curr_premi = new_premi.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                            $('#totalhullpremiupdate').val(curr_premi);
                                        
                                        }
                                        else
                                        {
                                            $('#totalhullpremiupdate').val(0);
                                        }

                                    var warhull = parseFloat($('#totalhullwarupdate').val());
                                    var hmivhull = parseFloat($('#totalhullhmivupdate').val());

                                    // if(response.sum_share >= 200.000 )
                                    // {
                                    //     $('#addhullcountupdate-btn').attr('hidden','true');
                                    // }
                                    // else{
                                    //     swal('warning!','share HM+IV must 100 %. insert again','validation error');
                                    // }
                                    

                                    $('#ModalCountHullUpdate').modal('toggle');
                                    $('#form-hulltypecountupdate')[0].reset();

                               }
                               
                              });
                           
                           }
                           else
                           {
                               swal('warning!','share HM+IV cannot more than 100 %','validation error');
                           }   
                   }


           }

      }
      else
      {
           swal('warning!','share cannot more than 200 %','validation error');

      }
});
</script>


<!-- awal table form -->
<script type='text/javascript'>
     $('#addhulltypeendorsement-btn').click(function(e){
        
        e.preventDefault();
        //alert("bisa " + $('#mhtypeamountendorsement').val())

        var type = $('#mhtypeendorsement').val();
        var share = $('#mhtypeshareendorsement').val();
        var insured_id = $('#mhnumber').val();
        var amount = $('#mhtypeamountendorsement').val();
        var rate = $('#mhtyperateendorsement').val();
        var premi = $('#mhtypepremiendorsement').val();
        var slip_id = $('#slipnumberendorsement').val();
        var token = $('input[name=_token]').val();
        var slip_type = 'mh';
        var sumtotal_percent = $('#totalhullshareendorsement').val();
        var type_hull = $('#hulltypehiddenendorsement').val();
        var sum_precent_war = $('#totalhullwarendorsement').val();
        var sum_precent_hmiv = $('#totalhullhmivendorsement').val();

        var sumtotal_percent = $('#totalhullshareendorsement').val();
        
        if(sumtotal_percent == null || sumtotal_percent == "" ){
            var conv_sumtotal_percent = parseFloat("0");
        }else{
            var conv_sumtotal_percent = parseFloat(sumtotal_percent);
        }

       if(sum_precent_war == null || sum_precent_war == "" ){
            var conv_sum_precent_war = parseFloat("0");
       }else{
            var conv_sum_precent_war = parseFloat(sum_precent_war);
       }

       if(sum_precent_hmiv == null || sum_precent_hmiv == "" ){
            var conv_sum_precent_hmiv = parseFloat("0");
       }else{
            var conv_sum_precent_hmiv = parseFloat(sum_precent_hmiv);
       }
       
       var conv_percentage = parseFloat(share);
        var countendorsement = parseInt($('#countendorsmentdata').val())+1;

       var real_count_percent = conv_sumtotal_percent + conv_sum_precent_war + conv_sum_precent_hmiv;
       console.log("total percent " + conv_sumtotal_percent)
       console.log("percent baru " + conv_percentage)
       console.log("hasilnya " + real_count_percent)

       var conv_amount = amount.replace(/,/g, "");
       console.log(conv_amount)
       var real_amount = parseFloat(conv_amount);
       console.log(real_amount)

        var conv_amount = amount.replace(/,/g, "");
       console.log('conv_amount ' + conv_amount)
       var real_amount = parseFloat(conv_amount);
       console.log('real_amount ' + real_amount)

       var conv_premi = premi.replace(/,/g, "");
       console.log('conv_amount ' + conv_premi)
       var real_premi = parseFloat(conv_premi);
       console.log('real_amount ' + real_premi)

       console.log('shipcode ' + type )
       console.log('shipname ' + share)
       console.log('insured_id ' + insured_id)
       console.log('ceding ' + amount )
       console.log('percent ' + rate )
       console.log('cndn ' + premi )
       console.log('slip_type ' + slip_type )
        
        if(real_count_percent <= 200 ){
            if(type == 3 && parseFloat(share) < 100){
                swal('warning!','WAR type must 100%','validation error');
            }else{

                    if(type_hull == 1){

                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        console.log('countendorsement endorsement' + countendorsement)

                        $.ajax({
                            url:"{{ route('hullcount.store') }}",
                            type:"POST",
                            data:{
                                type_id:type,
                                share:share,
                                amount:real_amount,
                                rate:rate,
                                countendorsement:countendorsement,
                                basic_premium:real_premi,
                                insured_id:insured_id,
                                slip_id:slip_id,
                                sliptype:slip_type,
                                grouptype:type_hull
                                // _token:token
                            },
                            beforeSend: function() { $("body").addClass("loading");  },
                            complete: function() {  $("body").removeClass("loading"); },
                            success:function(response){
                                console.log(response)

                                if (response.success) {

                                    var amount = response.amount;
                                
                                    console.log('amount' + amount)
                                    var fl_amount = parseFloat(amount);
                                    console.log('amount float' + fl_amount)
                                    var new_amount = fl_amount;
                                    console.log('amount to fixed' + new_amount)
                                    var curr_amount = new_amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    console.log('current amount' + curr_amount) 

                                    var premi = response.premi;
                                    
                                    console.log('premi' + premi)
                                    var fl_premi = parseFloat(premi);
                                    console.log('premi float' + fl_premi)
                                    var new_premi = fl_premi;
                                    console.log('premi to fixed' + new_premi)
                                    var curr_premi = new_premi.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    console.log('current premi' + curr_premi) 


                                    var cndn = '';
                                    var certno = '';                    
                                    var slipno = '';
                                    var policyno = '';

                                    var percent = response.share;
                                    var percentfl = parseFloat(percent);
                                    var new_percent = percentfl;

                                    var percentrate = response.rate;
                                    var percentflrate = parseFloat(percentrate);
                                    var new_rate = percentflrate;

                                    

                                    $('#marineHullCountTableEndorsement').append('<tr id="hcidendorsementid'+response.id+'"  data-name="">'+
                                                '<td>'+response.hullcode+ '-' + response.hulltype+'</td>'+
                                                '<td>'+floatToString(response.share)+'</td>'+
                                                '<td>'+amountToString(response.amount)+'</td>'+
                                                '<td>'+floatToString(response.rate)+'</td>'+
                                                '<td>'+amountToString(response.premi)+'</td>'+
                                                '<td><a href="javascript:void(0)" onclick="deletehullcountendorsement('+response.id+')">'+
                                                '<i class="fas fa-trash text-danger"></i></a></td>'+
                                                '</tr>')


                                        console.log("sum premi" + response.sum_premi)

                                    $('#totalhullpremiendorsement').val("");
                                    $('#totalhullamountendorsement').val("");
                                    $('#totalhullshareendorsement').val("");


                                    var sumshare = 0;
                                    if(response.sum_share)
                                    {
                                        sumshare = response.sum_share;  
                                        
                                        $('#totalhullshareendorsement').val(sumshare);
                                    }
                                    else
                                    {
                                           
                                        $('#totalhullshareendorsement').val(0);
                                    }

                                    if(response.sum_amount){
                                        var sumamount = response.sum_amount;
                                        var fl_amount = parseFloat(sumamount);
                                        var new_amount = fl_amount;
                                        var curr_amount = new_amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                        $('#totalhullamountendorsement').val(curr_amount);

                                    }
                                    else
                                    {
                                        $('#totalhullamountendorsement').val(0);
                                    }

                                    if(response.sum_premi){
                                        var sumpremi = response.sum_premi;
                                        var fl_premi = parseFloat(sumpremi);
                                        var new_premi = fl_premi;
                                        var curr_premi = new_premi.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                        $('#totalhullpremiendorsement').val(curr_premi);
                                    
                                    }
                                    else
                                    {
                                        $('#totalhullpremiendorsement').val(0);
                                    }

                                    
                                    

                                    var warhull = parseFloat($('#totalhullwarendorsement').val());
                                    var hmivhull = parseFloat($('#totalhullhmivendorsement').val());

                                    if(response.sum_share >= 200.000 ){
                                        $('#addhullcountendorsement-btn').attr('hidden','true');
                                    }
                                    

                                    $('#ModalCountHullEndorsement').modal('toggle');
                                    $('#form-hulltypecountendorsement')[0].reset();
                                    calculateGrossPrm('endorsement')
                                }
                            }
                        });
                    }
                    else
                    {
                            var sumhmivshare = $('#totalhullhmivendorsement').val();

                            if(sumhmivshare)
                            {
                           
                            }
                            else
                            {
                             sumhmivshare=0;
                            }

                            var totalshare = parseFloat(share) + parseFloat(sumhmivshare);

                            if(totalshare <= 100)
                            {
                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                });

                                $.ajax({
                                    url:"{{ route('hullcount.store') }}",
                                    type:"POST",
                                    data:{
                                        type_id:type,
                                        share:share,
                                        amount:real_amount,
                                        rate:rate,
                                        countendorsement:countendorsement,
                                        basic_premium:real_premi,
                                        insured_id:insured_id,
                                        slip_id:slip_id,
                                        sliptype:slip_type,
                                        grouptype:type_hull
                                        // _token:token
                                    },
                                    beforeSend: function() { $("body").addClass("loading");  },
                                    complete: function() {  $("body").removeClass("loading"); },
                                    success:function(response){
                                        console.log(response)

                                        if (response.success) {
                                            
                                            var amount = response.amount;
                                        
                                        console.log('amount' + amount)
                                        var fl_amount = parseFloat(amount);
                                        console.log('amount float' + fl_amount)
                                        var new_amount = fl_amount;
                                        console.log('amount to fixed' + new_amount)
                                        var curr_amount = new_amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                        console.log('current amount' + curr_amount) 

                                        var premi = response.premi;
                                        
                                        console.log('premi' + premi)
                                        var fl_premi = parseFloat(premi);
                                        console.log('premi float' + fl_premi)
                                        var new_premi = fl_premi;
                                        console.log('premi to fixed' + new_premi)
                                        var curr_premi = new_premi.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                        console.log('current premi' + curr_premi) 


                                        var cndn = '';
                                        var certno = '';
                                        var slipno = '';
                                        var policyno = '';

                                        var percent = response.share;
                                        var percentfl = parseFloat(percent);
                                        var new_percent = percentfl;

                                        var percentrate = response.rate;
                                        var percentflrate = parseFloat(percentrate);
                                        var new_rate = percentflrate;

                                        // $('#sumhmivshare').val(response.share);

                                        $('#marineHullCountTableEndorsement > tbody:last-child').append('<tr id="hcidendorsementid'+response.id+'"  data-name="">'+

                                            '<td>'+response.type_code +' - '+response.type_name+'</td>'+
                                            '<td>'+floatToString(response.share)+'</td>'+
                                            '<td>'+amountToString(response.amount)+'</td>'+
                                            '<td>'+floatToString(response.rate)+'</td>'+
                                            '<td>'+amountToString(response.premi)+'</td>'+
                                            '<td><a href="javascript:void(0)" onclick="deletehullcountendorsement('+response.id+')">'+
                                            '<i class="fas fa-trash text-danger"></i></a></td>'+
                                            '</tr>')


                                            console.log("sum premi" + response.sum_premi)

                                        $('#totalhullpremiendorsement').val("");
                                        $('#totalhullamountendorsement').val("");
                                        $('#totalhullshareendorsement').val("");

                                        var sumshare = 0;
                                        if(response.sum_share)
                                        {
                                            sumshare = response.sum_share;  
                                            
                                            $('#totalhullshareendorsement').val(sumshare);
                                        }
                                        else
                                        {
                                            
                                            $('#totalhullshareendorsement').val(0);
                                        }

                                        if(response.sum_amount){
                                            var sumamount = response.sum_amount;
                                            var fl_amount = parseFloat(sumamount);
                                            var new_amount = fl_amount;
                                            var curr_amount = new_amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                            $('#totalhullamountendorsement').val(curr_amount);

                                        }
                                        else
                                        {
                                            $('#totalhullamountendorsement').val(0);
                                        }

                                        if(response.sum_premi){
                                            var sumpremi = response.sum_premi;
                                            var fl_premi = parseFloat(sumpremi);
                                            var new_premi = fl_premi;
                                            var curr_premi = new_premi.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                            $('#totalhullpremiendorsement').val(curr_premi);
                                        
                                        }
                                        else
                                        {
                                            $('#totalhullpremiendorsement').val(0);
                                        }

                                        var warhull = parseFloat($('#totalhullwarendorsement').val());
                                        var hmivhull = parseFloat($('#totalhullhmivendorsement').val());

                                        // if(response.sum_share >= 200.000 ){
                                        //     $('#addhullcountendorsement-btn').attr('hidden','true');
                                        // }
                                        // else{
                                        //     swal('warning!','share HM+IV must 100 %. insert again','validation error');
                                        // }
                                            

                                        $('#ModalCountHullEndorsement').modal('toggle');
                                        $('#form-hulltypecountendorsement')[0].reset();
                                        calculateGrossPrm('endorsement')
                                        }
                                }
                                
                            });
                            
                            }
                            else{
                                swal('warning!','share HM+IV cannot more than 100 %','validation error');
                            }
                        
                    }


            }

        }else{
                swal('warning!','share cannot more than 200 %','validation error');

        }

    });
</script>


<script type='text/javascript'>
    function deletehullcount(id){
        var token = $('input[name=_token]').val();

        $.ajax({
            url:'{{ url("/") }}/delete-hull-count/'+id,
            type:"DELETE",
            data:{
                _token:token
            },
            beforeSend: function() { $("body").addClass("loading");  },
            complete: function() {  $("body").removeClass("loading"); },
            success:function(response){
                
                $('#hcid'+id).remove();
                console.log(response);

                console.log("sum hull" + response.sumperhull)

                

                if(response.sum_share){
                    $('#totalhullshare').val("");
                    var total_share = response.sum_share;
                    var conv_totalshare = total_share.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                    $('#totalhullshare').val(conv_totalshare);  
                }

                var warhull = parseFloat($('#totalhullwar').val());
                var hmivhull = parseFloat($('#totalhullhmiv').val());

                if(response.grouphull == 1){
                    var totalwar = $('#totalhullwar');
                    var total_share = response.sum_share;
                    var totalsum = parseFloat(totalwar) - parseFloat(total_share);
                    $('#totalhullwar').val();
                }
                else{
                    var totalhmiv = $('#totalhullhmiv');
                    var total_share = response.sum_share;
                    var totalsum = parseFloat(totalhmiv) - parseFloat(total_share);
                    $('#totalhullhmiv').val();
                }

                if((parseFloat(warhull) + parseFloat(hmivhull)) < 200 ){
                    $('#addhullcount-btn').attr('hidden','false');
                    $('#addhullcount-btn').removeAttr('hidden')
                }

            }
        });
    }
</script>

<script type='text/javascript'>
    $('#adddeductibleinsured-btn').click(function(e){
       //alert('masuk');
           e.preventDefault();

           var slipdptype = $('#slipdptype').val();
           // var slipdpcurrency = $('#slipdpcurrency').val();
           
           var percentage = $('#slipdppercentage').val();
           var amount = $('#slipdpamount').val();
           var minamount = $('#slipdpminamount').val();
           var code_ms = $('#mhnumber').val();
           var sliptype = 'mh';
           var real_minamount = 0;
           if(minamount == ''){
               real_minamount = 0;
           }
           else{
            var conv_minamount = minamount.replace(/,/g, "");
            console.log(conv_minamount)
            real_minamount = conv_minamount;
        }

        var slip_id = $('#slipnumber').val();
        var token2 = $('input[name=_token2]').val();


        

        var conv_amount = amount.replace(/,/g, "");
        console.log(conv_amount)
        var real_amount = conv_amount;
        console.log(real_amount)

        
        console.log(real_minamount)

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
         url:"{{ route('deductible.store') }}",
         type:"POST",
         data:{
             slipdptype:slipdptype,
             // slipdpcurrency:slipdpcurrency,
             percentage:percentage,
             amount:real_amount,
             minamount:real_minamount,
             id_slip:slip_id,
             insured_id:code_ms,
             sliptype:sliptype
         },
         beforeSend: function() { $("body").addClass("loading");  },
         complete: function() {  $("body").removeClass("loading"); },
         success:function(response)
         {
                if(response.success == false){
                swal("Warning",response.message,"warning");
             }else{
                console.log(response)
                //    var curr_amount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(response.amount);
                   //    var curr_amount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(response.amount);
                var curr_amount2 = parseFloat(response.amount);
                var curr_amount = curr_amount2.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                   
                    //    var curr_minamount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(response.min_claimamount);
                    var curr_minamount2 = parseFloat(response.min_claimamount.toString());
                    var curr_minamount = curr_minamount2.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                   

                $('#deductiblePanel tbody').append('<tr id="iiddeductible'+response.id+'" data-name="deductiblevalue[]"><td data-name="'+response.deductibletype+'">'+response.deductibletype+'</td><td data-name="'+floatToString(parseFloat(response.percentage).toFixed(5))+'">'+floatToString(parseFloat(response.percentage).toFixed(5))+'</td><td data-name="'+amountToString(response.amount)+'">'+amountToString(response.amount)+'</td><td data-name="'+amountToString(response.min_claimamount)+'">'+amountToString(response.min_claimamount)+'</td><td><a href="javascript:void(0)" onclick="deletedeductibledetail('+response.id+')">delete</a></td></tr>');
                $('#slipdppercentage').val('');
                $('#slipdpamount').val('');
                $('#slipdpamount2').val('');
                $('#slipdpminamount').val('');
             }
                

            }
        });

    });

    $('#addconditionneeded-btn').click(function(e){
       e.preventDefault();

       var cncode = $('#slipcncode').val();
       var slip_id = $('#slipnumber').val();
       var insured_id = $('#mhnumber').val();
       var slip_type = "mh";
       
       $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

       $.ajax({
           url:"{{ route('conditionneeded.store') }}",
           type:"POST",
           data:{
                slipcncode:cncode,
                id_slip:slip_id,
                insured_id:insured_id,
                slip_type:slip_type
           },
           beforeSend: function() { $("body").addClass("loading");  },
           complete: function() {  $("body").removeClass("loading"); },
           success:function(response){

               console.log(response)

               if(response.success==true)
               {
               
                    if(response.information == null){
                        $('#conditionNeeded tbody').prepend('<tr id="cnid'+response.id+'" data-name="conditionneededvalue[]"><td data-name="'+response.conditionneeded_id+'">'+response.condition+'</td><td data-name="'+response.information+'">-</td><td><a href="javascript:void(0)" onclick="deleteconditionneeded('+response.id+')">delete</a></td></tr>')
                    
                    }else{
                        $('#conditionNeeded tbody').prepend('<tr id="cnid'+response.id+'" data-name="conditionneededvalue[]"><td data-name="'+response.conditionneeded_id+'">'+response.condition+'</td><td data-name="'+response.information+'">'+response.information+'</td><td><a href="javascript:void(0)" onclick="deleteconditionneeded('+response.id+')">delete</a></td></tr>')
                    
                    }
                    $(':input','#addconditionneeded').not(':button, :submit, :reset, :hidden').val(' ').removeAttr('checked').removeAttr('selected');
               }
               else
               {
                 swal("Error!", "Insert Error/ Duplicate Data" , "Insert Error");
               }
            
           }
       });

    });

</script>

<script type='text/javascript'>
    function deletedeductibledetail(id)
    {
        var token2 = $('input[name=_token2]').val();

        $.ajax({
            url:'{{ url("/") }}/delete-deductible-list/'+id,
            type:"DELETE",
            data:{
                _token:token2
            },
            beforeSend: function() { $("body").addClass("loading");  },
            complete: function() {  $("body").removeClass("loading"); },
            success:function(response){

                $('#iiddeductible'+id).remove();
                console.log(response);
            }
        });
    }

    function deletedeductibleupdate(id)
    {
        var token2 = $('input[name=_token2]').val();

        $.ajax({
            url:'{{ url("/") }}/delete-deductible-list/'+id,
            type:"DELETE",
            data:{
                _token:token2
            },
            beforeSend: function() { $("body").addClass("loading");  },
            complete: function() {  $("body").removeClass("loading"); },
            success:function(response){

                $('#iiddeductibleupdate'+id).remove();
                console.log(response);
            }
        });
    }

    function deletedeductibleendorsement(id)
    {
        var token2 = $('input[name=_token2]').val();

        $.ajax({
            url:'{{ url("/") }}/delete-deductible-list/'+id,
            type:"DELETE",
            data:{
                _token:token2
            },
            beforeSend: function() { $("body").addClass("loading");  },
            complete: function() {  $("body").removeClass("loading"); },
            success:function(response){

                $('#iiddeductibleendorsement'+id).remove();
                console.log(response);
            }
        });
    }

    function deleteconditionneeded(id){
        var token2 = $('input[name=_token2]').val();

        $.ajax({
            url:'{{ url("/") }}/delete-conditionneeded-list/'+id,
            type:"DELETE",
            data:{
                _token:token2
            },
            beforeSend: function() { $("body").addClass("loading");  },
           complete: function() {  $("body").removeClass("loading"); },
            success:function(response){
                
                $('#cnid'+id).remove();
                console.log(response);
                
            }
        });
    }

    
    function deleteconditionneededupdate(id)
    {
        var token2 = $('input[name=_token2]').val();

        $.ajax({
            url:'{{ url("/") }}/delete-conditionneeded-list/'+id,
            type:"DELETE",
            data:{
                _token:token2
            },
            beforeSend: function() { $("body").addClass("loading");  },
           complete: function() {  $("body").removeClass("loading"); },
            success:function(response){
                
                $('#cnidupdate'+id).remove();
                console.log(response);
                
            }
        });
    }
</script>

<script type='text/javascript'>
    $('#addinstallmentinsured-btn').click(function(e){
       //alert('masuk');
       e.preventDefault();

       var installmentdate = $('#slipipdate').val();
       var percentage = $('#slipippercentage').val();
       var amount = $('#slipipamount').val();
       var slip_id = $('#slipnumber').val();
       var token2 = $('input[name=_token2]').val();
       var code_ms = $('#mhnumber').val();
       var sliptype = 'mh';
       var sumtotal_percent = $('#sliptotalpercentinspan').val();
       if(sumtotal_percent == null || sumtotal_percent == "" ){
            var conv_sumtotal_percent = parseFloat("0");
       }else{
            var conv_sumtotal_percent = parseFloat(sumtotal_percent);
       }
       
       var conv_percentage = parseFloat(percentage);

       var real_count_percent = conv_sumtotal_percent + conv_percentage;
       console.log("total percent " + conv_sumtotal_percent)
       console.log("percent baru " + conv_percentage)
       console.log("hasilnya " + real_count_percent)

       var conv_amount = amount.replace(/,/g, "");
       console.log(conv_amount)
       var real_amount = parseFloat(conv_amount);
       console.log(real_amount)


       console.log("installment date " + installmentdate)
       var d2=new Date(installmentdate.split("/").reverse().join("-"));
       console.log('conv date' + d2)
       var dd2=d2.getDate();
       console.log('conv date' + dd2)
       var mm2=d2.getMonth()+1;
       console.log('conv date' + mm2)
       var yy2=d2.getFullYear();
       console.log('conv date' + yy2)
       var newinstallmentdate=yy2+"-"+mm2+"-"+dd2;
       console.log('conv date' + newinstallmentdate)


       var prod_date = $('#slipprodyear').val();
       console.log('prod_date' + prod_date)
       var d=new Date(prod_date.split("/").reverse().join("-"));
       console.log('conv date' + d)

       var dd=d.getDate();
       console.log('conv date' + dd)

       var mm=d.getMonth()+1;
       console.log('conv date' + mm)

       var yy=d.getFullYear();
       console.log('conv date' + yy)

       var newproddate=yy+"-"+mm+"-"+dd;
       console.log('conv date' + newinstallmentdate)

       
       if(new Date(newinstallmentdate) >= new Date(newproddate)){
            if(real_count_percent <= 100){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

               $.ajax({
                 url:"{{ route('installment.store') }}",
                 type:"POST",
                 data:{
                     installmentdate:newinstallmentdate,
                     percentage:percentage,
                     slipamount:real_amount,
                     id_slip:slip_id,
                     insured_id:code_ms,
                     sliptype:sliptype
                 },
                 beforeSend: function() { $("body").addClass("loading");  },
                 complete: function() {  $("body").removeClass("loading"); },
                 success:function(response)
                 {

                     console.log(response)
                     if(response.code_error){
                        swal("Error!", response.message , "Insert Error");
                        // $('#addinstallmentinsured-btn').attr('hidden','true')
                    }
                    else
                    {
                            // var curr_amount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(response.amount);
                            
                            var str_amount = response.amount.toString();
                            var curr_amount = str_amount.replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                            var currdate = response.installment_date;
                            var convdate = currdate.split("-").reverse().join("/");
                            console.log('conv date ' + convdate)
                            var strdate = convdate.toString();

                            var conv_percent = parseFloat(response.percentage);
                            var conv_amount = parseFloat(response.totalamount);

                            $('#installmentPanel tbody').append('<tr id="iidinstallment'+response.id+'" data-name="installmentvalue[]"><td data-name="'+response.installment_date+'">'+strdate+'</td><td data-name="'+floatToString(parseFloat(response.percentage).toFixed(5))+'">'+floatToString(parseFloat(response.percentage).toFixed(5))+'</td><td data-name="'+amountToString(response.amount)+'">'+amountToString(response.amount)+'</td><td><a href="javascript:void(0)" onclick="deleteinstallmentdetail('+response.id+')">delete</a></td></tr>')
                            $('#dateinstallment').val('');
                            $('#slipippercentage').val('');
                            $('#slipipamount').val('');
                            $('#slipipamount2').val('');

                            if(response.message){
                                // swal("Success!", response.message, "success")
                            }       
                            
                            $('#sliptotalamountinspan').val(conv_amount.toString());

                            var total_percent =  $('#sliptotalpercentinspan').val();

                            if(total_percent == '')
                            {
                                var sum_percent = isNaN(parseFloat(0) + parseFloat(response.percentage)) ? 0 :(parseFloat(0) + parseFloat(response.percentage)) ;
                                $('#sliptotalpercentinspan').val(sum_percent.toString());
                                console.log($('#sliptotalpercentinspan').val())

                                var total_percent2 =  $('#sliptotalpercentinspan').val();

                                if(total_percent2 == "100")
                                {
                                    $('#addinstallmentinsured-btn').attr('hidden','true');
                                }

                            }else{
                                var sum_percent = isNaN(parseFloat(total_percent) + parseFloat(response.percentage)) ? 0 :(parseFloat(total_percent) + parseFloat(response.percentage))
                                $('#sliptotalpercentinspan').val(sum_percent.toString());
                                console.log($('#sliptotalpercentinspan').val())
                                
                                var total_percent2 =  $('#sliptotalpercentinspan').val();

                                if(total_percent2 == "100")
                                {
                                    $('#addinstallmentinsured-btn').attr('hidden','true');
                                }
                                
                            }

                            $('#slipipdate').val('');
                            $('#slipipdate').focus();
                        }

                       //var total =  parseFloat($("#sliptotalsum").val());
                       //var sum = isNaN(total + parseFloat(response.amount)) ? 0 :(total + parseFloat(response.amount)) ;
                       //$("#sliptotalsum").val(sum);

                   }
               });
           }
           else{
                swal('warning!','installment cannot more than 100 %','validation error');
           }

       }else{
        swal('warning!','installment date cannot be lower than prod date / document date','validation error');
       }
   });
</script>

<script type='text/javascript'>
    function deleteinstallmentdetail(id)
    {
        var token2 = $('input[name=_token2]').val();

        $.ajax({
            url:'{{ url("/") }}/delete-installment-list/'+id,
            type:"DELETE",
            data:{
                _token:token2
            },
            beforeSend: function() { $("body").addClass("loading");  },
            complete: function() {  $("body").removeClass("loading"); },
            success:function(response){

                $('#iidinstallment'+id).remove();
                console.log(response);
                var total_percent =  parseFloat($('#sliptotalpercentinspan').val());
                var percent = parseFloat(response.percentage).toFixed(5);
                var proses = parseFloat(total_percent-percent);
                var sum_percent = isNaN(proses) ? 0 :(proses) ;
                console.log('total_percent' + total_percent);
                console.log('percent' + percent);
                console.log('proses' + proses);
                $('#sliptotalpercentinspan').val(sum_percent);
                console.log('total percent' + $('#sliptotalpercentinspan').val())
                        

                var total_percent2 =  parseFloat($('#sliptotalpercentinspan').val());

                if(total_percent2 < 100)
                {
                    $('#addinstallmentinsured-btn').attr('hidden','false');
                    $('#addinstallmentinsured-btn').removeAttr('hidden')
                }
            }
        });
    }

    function deleteinstallmentupdate(id)
    {
        var token2 = $('input[name=_token2]').val();

        $.ajax({
            url:'{{ url("/") }}/delete-installment-list/'+id,
            type:"DELETE",
            data:{
                _token:token2
            },
            beforeSend: function() { $("body").addClass("loading");  },
            complete: function() {  $("body").removeClass("loading"); },
            success:function(response){

                $('#iidinstallmentupdate'+id).remove();
                console.log(response);
                var total_percent =  $('#sliptotalpercentinspanupdate').val();
                        
                var sum_percent = isNaN(parseFloat(total_percent) - parseFloat(response.percentage)) ? 0 :(parseFloat(total_percent) - parseFloat(response.percentage)) ;
                $('#sliptotalpercentinspanupdate').val(sum_percent.toString());
                console.log('total percent' + $('#sliptotalpercentinspanupdate').val())
                        

                var total_percent2 =  parseFloat($('#sliptotalpercentinspanupdate').val());

                if(total_percent2 < 100)
                {
                    $('#addinstallmentinsuredupdate-btn').attr('hidden','false');
                    $('#addinstallmentinsuredupdate-btn').removeAttr('hidden')
                }
            }
        });
    }

    function deleteinstallmentendorsement(id)
    {
        var token2 = $('input[name=_token2]').val();

        $.ajax({
            url:'{{ url("/") }}/delete-installment-list/'+id,
            type:"DELETE",
            data:{
                _token:token2
            },
            beforeSend: function() { $("body").addClass("loading");  },
            complete: function() {  $("body").removeClass("loading"); },
            success:function(response){

                $('#iidinstallmentendorsement'+id).remove();
                console.log(response);
                var total_percent =  $('#sliptotalpercentinspanendorsement').val();
                        
                var sum_percent = isNaN(parseFloat(total_percent) - parseFloat(response.percentage)) ? 0 :(parseFloat(total_percent) - parseFloat(response.percentage)) ;
                $('#sliptotalpercentinspanendorsement').val(sum_percent.toString());
                console.log('total percent' + $('#sliptotalpercentinspanendorsement').val())
                        

                var total_percent2 =  parseFloat($('#sliptotalpercentinspanendorsement').val());

                if(total_percent2 < 100)
                {
                    $('#addinstallmentinsuredendorsement-btn').attr('hidden','false');
                    $('#addinstallmentinsuredendorsement-btn').removeAttr('hidden')
                }
            }
        });
    }
</script>

<script type='text/javascript'>
    $('#addretrocessioninsured-btn').click(function(e){
       //alert('masuk');
       e.preventDefault();
       var btnins = $("#addinsuredsave-btn").text();
       var type = $('#sliprptype').val();
       var contract = $('#sliprpcontract').val();
       var percentage = $('#sliprppercentage').val();
       var amount = $('#sliprpamount').val();
       var or_percent = $('#slipor').val();
       var code_ms = $('#mhnumber').val();
       var sliptype = 'mh'; 
       
       var slip_id = $('#slipnumber').val();
       var token2 = $('input[name=_token2]').val();
       var countendorsement = 0;
       var conv_amount = amount.replace(/,/g, "");
       var real_amount = parseInt(conv_amount);
        
        if(btnins == "Save"){
            swal("Error!", "Please input Insured data First!!!", "Insert Error");
        }else{
            $.ajaxSetup({
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                 url:"{{ route('retrocession.store') }}",
                 type:"POST",
                 data:{
                     type:type,
                     contract:contract,
                     percentage:percentage,
                     amount:real_amount,
                     or_percent:or_percent,
                     id_slip:slip_id,
                     insured_id:code_ms,
                     countendorsement:countendorsement,
                     sliptype:sliptype
                 },
                 beforeSend: function() { $("body").addClass("loading");  },
                 complete: function() {  $("body").removeClass("loading"); },
                 success:function(response)
                 {
                    if(response.code_error){
                        swal("Error!", response.message , "warning");
                            
                    }else{
                        var curr_amount = response.amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        $('#retrocessionPanel tbody').append('<tr id="iidretrocession'+response.id+'" data-name="retrocessionvalue[]"><td data-name="'+response.contract+'">'+response.contract+'</td><td data-name="'+floatToString(parseFloat(response.percentage).toFixed(5))+'">'+floatToString(parseFloat(response.percentage).toFixed(5))+'</td><td data-name="'+amountToString(response.amount)+'">'+amountToString(response.amount)+'</td><td><a href="javascript:void(0)" onclick="deleteretrocessiondetail('+response.id+')">delete</a></td></tr>');
                        $('#sliprppercentage').val('');
                        $('#sliprpamount').val('');
                        $('#sliprpamount2').val('');
                        if(response.message){
                            swal("Success!", response.message, "success")
                        }
                        var or = $('#slipor').val();
                        var total_percent = $('#sliptotalpercentrpor').val();
                        var proses = parseInt(total_percent) + parseInt(response.percentage);
                        var sum_percent = isNaN(proses) ? 0 : (proses);
                        $('#sliptotalpercentrpor').val(sum_percent);
                        var total_percent2 =  $('#sliptotalpercentrpor').val();
                        if(parseInt(total_percent2)>=100)
                        {
                            $('#addretrocessioninsured-btn').attr('hidden','true');
                        }
                    }
                }
        })
        }
        ;

   });
</script>

<script type='text/javascript'>
    function deleteretrocessiondetail(id)
    {
        var token2 = $('input[name=_token2]').val();

        $.ajax({
            url:'{{ url("/") }}/delete-retrocession-list/'+id,
            type:"DELETE",
            data:{
                _token:token2
            },
            beforeSend: function() { $("body").addClass("loading");  },
            complete: function() {  $("body").removeClass("loading"); },
            success:function(response){

                $('#iidretrocession'+id).remove();
                console.log(response);
                var total_percent =  $('#sliptotalpercentrpor').val();
                        
                var sum_percent = isNaN(parseFloat(total_percent) - parseFloat(response.percentage)) ? 0 :(parseFloat(total_percent) - parseFloat(response.percentage)) ;
                $('#sliptotalpercentrpor').val(sum_percent.toString());
                console.log('total percent' + $('#sliptotalpercentrpor').val())
                        

                var total_percent2 =  parseFloat($('#sliptotalpercentrpor').val());

                if(parseInt(total_percent2) < 100)
                {
                    $('#addretrocessioninsured-btn').attr('hidden','false');
                    $('#addretrocessioninsured-btn').removeAttr('hidden')
                }
            }
        });
    }
</script>
<!-- akhir table form -->


<!-- awal table form update -->
<script type='text/javascript'>
     $('#form-hulltypecountupdate').submit(function(e){
        e.preventDefault();

        var type = $('#mhtypeupdate').val();
        var share = $('#mhtypeshareupdate').val();
        var insured_id = $('#mhnumberupdate').val();
        var amount = $('#mhtypeamountupdate').val();
        var rate = $('#mhtyperateupdate').val();
        var premi = $('#mhtypepremiupdate').val();
        var slip_id = $('#slipnumberupdate').val();
        var token = $('input[name=_token]').val();
        var slip_type = 'mh';
        var sumtotal_percent = $('#totalhullshareupdate').val();
        var type_hull = $('#hulltypehiddenupdate').val();
        var sum_precent_war = $('#totalhullwarupdate').val();
        var sum_precent_hmiv = $('#totalhullhmivupdate').val();

       if(sum_precent_war == null || sum_precent_war == "" ){
            var conv_sum_precent_war = parseFloat("0");
       }else{
            var conv_sum_precent_war = parseFloat(sum_precent_war);
       }

       if(sum_precent_hmiv == null || sum_precent_hmiv == "" ){
            var conv_sum_precent_hmiv = parseFloat("0");
       }else{
            var conv_sum_precent_hmiv = parseFloat(sum_precent_hmiv);
       }
       
       var conv_percentage = parseFloat(share);

       var real_count_percent = conv_sumtotal_percent + conv_sum_precent_war + conv_sum_precent_hmiv;
       console.log("total percent " + conv_sumtotal_percent)
       console.log("percent baru " + conv_percentage)
       console.log("hasilnya " + real_count_percent)

       var conv_amount = amount.replace(/,/g, "");
       console.log(conv_amount)
       var real_amount = parseFloat(conv_amount);
       console.log(real_amount)

        var conv_amount = amount.replace(/,/g, "");
       console.log('conv_amount ' + conv_amount)
       var real_amount = parseFloat(conv_amount);
       console.log('real_amount ' + real_amount)

       var conv_premi = premi.replace(/,/g, "");
       console.log('conv_amount ' + conv_premi)
       var real_premi = parseFloat(conv_premi);
       console.log('real_amount ' + real_premi)

       console.log('shipcode ' + type )
       console.log('shipname ' + share)
       console.log('insured_id ' + insured_id)
       console.log('ceding ' + amount )
       console.log('percent ' + rate )
       console.log('cndn ' + premi )
       console.log('slip_type ' + slip_type )
        
        if(real_count_percent <= 200 )
        {
            if(type == 3 && parseFloat(share) < 100){
                swal('warning!','WAR type must 100%','validation error');
            }else{

                    if(type_hull == 1)
                    {
                        $.ajax({
                            url:"{{ route('hullcount.store') }}",
                            type:"POST",
                            data:{
                                type_id:type,
                                share:share,
                                amount:real_amount,
                                rate:rate,
                                basic_premium:real_premi,
                                insured_id:insured_id,
                                slip_id:slip_id,
                                sliptype:slip_type,
                                grouptype:type_hull,
                                _token:token
                            },
                            beforeSend: function() { $("body").addClass("loading");  },
                            complete: function() {  $("body").removeClass("loading"); },
                            success:function(response){
                                if(response.success){
                                    console.log(response)

                                var amount = response.amount;
                                
                                console.log('amount' + amount)
                                var fl_amount = parseFloat(amount);
                                console.log('amount float' + fl_amount)
                                var new_amount = fl_amount;
                                console.log('amount to fixed' + new_amount)
                                var curr_amount = new_amount.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                console.log('current amount' + curr_amount) 

                                var premi = response.premi;
                                
                                console.log('premi' + premi)
                                var fl_premi = parseFloat(premi);
                                console.log('premi float' + fl_premi)
                                var new_premi = fl_premi;
                                console.log('premi to fixed' + new_premi)
                                var curr_premi = new_premi.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                console.log('current premi' + curr_premi) 


                                var cndn = '';
                                var certno = '';
                                var slipno = '';
                                var policyno = '';

                                var percent = response.share;
                                var percentfl = parseFloat(percent);
                                var new_percent = percentfl;

                                var percentrate = response.rate;
                                var percentflrate = parseFloat(percentrate);
                                var new_rate = percentflrate;

                                

                                $('#marineHullCountTableUpdate > tbody:last-child').append('<tr id="hcupdateid'+response.id+'"  data-name="">'+
                                   '<td>'+response.type_code+'</td>'+
                                   '<td>'+floatToString(response.share)+'</td>'+
                                   '<td>'+amountToString(response.amount)+'</td>'+
                                   '<td>'+floatToString(response.rate)+'</td>'+
                                   '<td>'+amountToString(response.premi)+'</td>'+
                                   '<td><a href="javascript:void(0)" onclick="deletehullcountupdate('+response.id+')">'+
                                   '<i class="fas fa-trash text-danger"></i></a></td>'+
                                   '</tr>')


                                    console.log("sum premi" + response.sum_premi)

                                $('#totalhullpremiupdate').val("");
                                $('#totalhullamountupdate').val("");
                                $('#totalhullshareupdate').val("");

                                

                                if(response.sum_share){
                                    var total_share = response.sum_share;
                                    var countwar = $('#totalhullwarupdate').val();                                    
                                    var conv_totalshare = total_share.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    
                                    if(countwar == null || countwar = ""){
                                      var sumsharewar =  isNaN(parseFloat(total_share) + parseFloat("0")) ? 0 :(parseFloat(total_share) + parseFloat("0"));


                                      $('#totalhullwarupdate').val(sumsharewar);
                                    }else{
                                      var sumsharewar =  isNaN(parseFloat(total_share) + parseFloat(countwar)) ? 0 :(parseFloat(total_share) + parseFloat(countwar));

                                        $('#totalhullwarupdate').val(sumsharewar);
                                    } 
                                }

                                var warhull = parseFloat($('#totalhullwarupdate').val());
                                var hmivhull = parseFloat($('#totalhullhmivupdate').val());

                                if((warhull + hmivhull) == 200.000 ){
                                    $('#addhullcountupdate-btn').attr('hidden','true');
                                }
                                

                                $('#ModalCountHullUpdate').modal('toggle');
                                $('#form-hulltypecountupdate')[0].reset();
                            }else{
                                toastr.warning(response.message)
                            }
                            }
                        });
                    
                    }
                    else
                    {
                            var sumhmivshare = $('#totalhullhmivupdate').val();

                            if(sumhmivshare){}
                            else
                            {
                             sumhmivshare=0;
                            }

                            var totalshare = parseFloat(share) + parseFloat(sumhmivshare);

                            if(totalshare <= 100)
                            {
                                $.ajax({
                                    url:"{{ route('hullcount.store') }}",
                                    type:"POST",
                                    data:{
                                        type_id:type,
                                        share:share,
                                        amount:real_amount,
                                        rate:rate,
                                        basic_premium:real_premi,
                                        insured_id:insured_id,
                                        slip_id:slip_id,
                                        sliptype:slip_type,
                                        grouptype:type_hull,
                                        _token:token
                                    },
                                    beforeSend: function() { $("body").addClass("loading");  },
                                    complete: function() {  $("body").removeClass("loading"); },
                                    success:function(response){
                                        console.log(response)

                                        var amount = response.amount;
                                        
                                        console.log('amount' + amount)
                                        var fl_amount = parseFloat(amount).toFixed(2);
                                        console.log('amount float' + fl_amount)
                                        var new_amount = fl_amount;
                                        console.log('amount to fixed' + new_amount)
                                        var curr_amount = new_amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                        console.log('current amount' + curr_amount) 

                                        var premi = response.premi;
                                        
                                        console.log('premi' + premi)
                                        var fl_premi = parseFloat(premi).toFixed(2);
                                        console.log('premi float' + fl_premi)
                                        var new_premi = fl_premi;
                                        console.log('premi to fixed' + new_premi)
                                        var curr_premi = new_premi.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                        console.log('current premi' + curr_premi) 


                                        var cndn = '';
                                        var certno = '';
                                        var slipno = '';
                                        var policyno = '';

                                        var percent = response.share;
                                        var percentfl = parseFloat(percent).toFixed(2);
                                        var new_percent = percentfl;

                                        var percentrate = response.rate;
                                        var percentflrate = parseFloat(percentrate).toFixed(2);
                                        var new_rate = percentflrate;

                                        // $('#sumhmivshare').val(response.share);

                                        $('#marineHullCountTableUpdate > tbody:last-child').append('<tr id="hcupdateid'+response.id+'"  data-name="">'+
                                           '<td>'+response.type_code+'</td>'+
                                           '<td>'+floatToString(response.percentage)+'</td>'+
                                           '<td>'+floatToString(parseFloat(response.amount).toFixed(2))+'</td>'+
                                           '<td>'+floatToString(response.rate)+'</td>'+
                                           '<td>'+floatToString(parseFloat(response.premi).toFixed(2))+'</td>'+
                                           '<td><a href="javascript:void(0)" onclick="deletehullcountupdate('+response.id+')">'+
                                           '<i class="fas fa-trash text-danger"></i></a></td>'+
                                           '</tr>')


                                            console.log("sum premi" + response.sum_premi)

                                        $('#totalhullpremiupdate').val("");
                                        $('#totalhullamountupdate').val("");
                                        $('#totalhullshareupdate').val("");

                                        if(response.sum_share){
                                            var total_share = response.sum_share;
                                            var countwar = $('#totalhullwarupdate').val();                                    
                                            var conv_totalshare = total_share.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                        
                                                if(countwar == null || countwar = ""){
                                                  var sumsharewar =  isNaN(parseFloat(total_share) + parseFloat("0")) ? 0 :(parseFloat(total_share) + parseFloat("0"));


                                                  $('#totalhullwarupdate').val(sumsharewar);
                                                }else{
                                                  var sumsharewar =  isNaN(parseFloat(total_share) + parseFloat(countwar)) ? 0 :(parseFloat(total_share) + parseFloat(countwar));

                                                    $('#totalhullwarupdate').val(sumsharewar);
                                                } 
                                        }

                                        var warhull = parseFloat($('#totalhullwarupdate').val());
                                        var hmivhull = parseFloat($('#totalhullhmivupdate').val());

                                        // if((warhull + hmivhull) == 200.000 ){
                                        //     $('#addhullcountupdate-btn').attr('hidden','true');
                                        // }else{
                                        //     swal('warning!','share HM+IV must 100 %. insert again','validation error');
                                        // }
                                        
                                            

                                        $('#ModalCountHullUpdate').modal('toggle');
                                        $('#form-hulltypecountupdate')[0].reset();
                                }
                                
                            });
                            
                            }else{
                                swal('warning!','share HM+IV cannot more than 100 %','validation error');
                            }
                        
                    }


            }

        }else{
                swal('warning!','share cannot more than 200 %','validation error');

        }

    });
</script>

<script type='text/javascript'>
    function deletehullcountupdate(id)
    {
        var token = $('input[name=_token]').val();
        
        $.ajax({
            url:'{{ url("/") }}/delete-hull-count/'+id,
            type:"DELETE",
            data:{
                _token:token
            },
            beforeSend: function() { $("body").addClass("loading");  },
            complete: function() {  $("body").removeClass("loading"); },
            success:function(response)
            {
                    
                $('#hcupdateid'+id).remove();
                console.log(response);

                console.log("sum hull" + response.sumperhull)

                if(response.sum_share)
                {
                    var sumshare = response.sum_share;       
                    $('#totalhullshareupdate').val(amountToString(sumshare));
                }
                else
                {
                    $('#totalhullshareupdate').val(0);
                }

                if(response.sum_amount)
                {
                    var sumamount = response.sum_amount;
                    var fl_amount = parseFloat(sumamount);
                    var new_amount = fl_amount;
                    var curr_amount = new_amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    $('#totalhullamountupdate').val(curr_amount);

                }
                else
                {
                    $('#totalhullamountupdate').val(0);
                }

                if(response.sum_premi){
                    var sumpremi = response.sum_premi;
                    var fl_premi = parseFloat(sumpremi);
                    var new_premi = fl_premi;
                    var curr_premi = new_premi.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    $('#totalhullpremiupdate').val(curr_premi);
                
                }
                else
                {
                    $('#totalhullpremiupdate').val(0);
                }


            }
        });

    }
</script>

<script type='text/javascript'>
    $('#adddeductibleinsuredupdate-btn').click(function(e){
       //alert('masuk');
           e.preventDefault();

           var slipdptype = $('#slipdptypeupdate').val();
           // var slipdpcurrency = $('#slipdpcurrency').val();
           
           var percentage = $('#slipdppercentageupdate').val();
           var amount = $('#slipdpamountupdate').val();
           var minamount = $('#slipdpminamountupdate').val();
           var code_ms = $('#mhnumber').val();
           var sliptype = 'mh';
           var real_minamount = 0;
           if(minamount == ''){
               real_minamount = 0;
           }
           else{
            var conv_minamount = minamount.replace(/,/g, "");
            console.log(conv_minamount)
            real_minamount = conv_minamount;
        }

        var slip_id = $('#slipnumberupdate').val();
        var token2 = $('input[name=_token2]').val();


        

        var conv_amount = amount.replace(/,/g, "");
        console.log(conv_amount)
        var real_amount = conv_amount;
        console.log(real_amount)

        
        console.log(real_minamount)

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
         url:"{{ route('deductible.store') }}",
         type:"POST",
         data:{
             slipdptype:slipdptype,
             // slipdpcurrency:slipdpcurrency,
             percentage:percentage,
             amount:real_amount,
             minamount:real_minamount,
             id_slip:slip_id,
             insured_id:code_ms,
             sliptype:sliptype
         },
         beforeSend: function() { $("body").addClass("loading");  },
         complete: function() {  $("body").removeClass("loading"); },
         success:function(response)
         {

                console.log(response)
                if(response.success==true)
                {

                    //    var curr_amount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(response.amount);
                    var curr_amount2 = parseFloat(response.amount.toString());
                    var curr_amount = curr_amount2.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                   
                    //    var curr_minamount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(response.min_claimamount);
                    var curr_minamount2 = parseFloat(response.min_claimamount.toString());
                    var curr_minamount = curr_minamount2.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                   

                    $('#deductiblePanelUpdate tbody').append('<tr id="iiddeductibleupdate'+response.id+'" data-name="deductiblevalue[]"><td data-name="'+response.deductibletype+'">'+response.deductibletype+'</td><td data-name="'+floatToString(parseFloat(response.percentage).toFixed(5))+'">'+floatToString(parseFloat(response.percentage).toFixed(5))+'</td><td data-name="'+amountToString(response.amount)+'">'+amountToString(response.amount)+'</td><td data-name="'+amountToString(response.min_claimamount)+'">'+amountToString(response.min_claimamount)+'</td><td><a href="javascript:void(0)" onclick="deletedeductibledetail('+response.id+')">delete</a></td></tr>');
                    $('#slipdppercentageupdate').val('');
                    $('#slipdpamountupdate').val('');
                    $('#slipdpamountupdate2').val('');
                    $('#slipdpminamountupdate').val('');

                }
                else
                {
                    swal("Error!", "Insert Error/ Duplicate Data" , "Insert Error");
                }
                

            }
        });

    });

    $('#addconditionneededupdate-btn').click(function(e){
       e.preventDefault();

       var cncode = $('#slipcncodeupdate').val();
       var slip_id = $('#slipnumberupdate').val();
       var insured_id = $('#mhnumber').val();
       var slip_type = "mh";
       
       $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

       $.ajax({
           url:"{{ route('conditionneeded.store') }}",
           type:"POST",
           data:{
                slipcncode:cncode,
                id_slip:slip_id,
                insured_id:insured_id,
                slip_type:slip_type
           },
           beforeSend: function() { $("body").addClass("loading");  },
           complete: function() {  $("body").removeClass("loading"); },
           success:function(response){

               console.log(response)
               
               if(response.information == null){
                $('#conditionNeededUpdate tbody').prepend('<tr id="cnidupdate'+response.id+'" data-name="conditionneededvalue[]"><td data-name="'+response.conditionneeded_id+'">'+response.condition+'</td><td data-name="'+response.information+'">-</td><td><a href="javascript:void(0)" onclick="deleteconditionneededupdate('+response.id+')">delete</a></td></tr>')
               
               }else{
                $('#conditionNeededUpdate tbody').prepend('<tr id="cnidupdate'+response.id+'" data-name="conditionneededvalue[]"><td data-name="'+response.conditionneeded_id+'">'+response.condition+'</td><td data-name="'+response.information+'">'+response.information+'</td><td><a href="javascript:void(0)" onclick="deleteconditionneededupdate('+response.id+')">delete</a></td></tr>')
               
               }
               $(':input','#addconditionneededupdate').not(':button, :submit, :reset, :hidden').val(' ').removeAttr('checked').removeAttr('selected');
               
            
           }
       });

    });
</script>

<script type='text/javascript'>
    function deletedeductibledetailupdate(id)
    {
        var token2 = $('input[name=_token2]').val();

        $.ajax({
            url:'{{ url("/") }}/delete-deductible-list/'+id,
            type:"DELETE",
            data:{
                _token:token2
            },
            beforeSend: function() { $("body").addClass("loading");  },
            complete: function() {  $("body").removeClass("loading"); },
            success:function(response){

                $('#iiddeductibleupdate'+id).remove();
                console.log(response);
            }
        });
    }

    function deleteconditionneededupdate(id){
        var token2 = $('input[name=_token2]').val();

        $.ajax({
            url:'{{ url("/") }}/delete-conditionneeded-list/'+id,
            type:"DELETE",
            data:{
                _token:token2
            },
            beforeSend: function() { $("body").addClass("loading");  },
           complete: function() {  $("body").removeClass("loading"); },
            success:function(response){
                
                $('#cnidupdate'+id).remove();
                console.log(response);
                
            }
        });
    }
</script>

<script type='text/javascript'>
    $('#addinstallmentinsuredupdate-btn').click(function(e){
       //alert('masuk');
       e.preventDefault();

       var installmentdate = $('#slipipdateupdate').val();
       var percentage = $('#slipippercentageupdate').val();
       var amount = $('#slipipamountupdate').val();
       var slip_id = $('#slipnumberupdate').val();
       var token2 = $('input[name=_token2]').val();
       var code_ms = $('#mhnumber').val();
       var sliptype = 'mh';
       var sumtotal_percent = $('#sliptotalpercentinspanupdate').val();
       if(sumtotal_percent == null || sumtotal_percent == "" ){
            var conv_sumtotal_percent = parseFloat("0");
       }else{
            var conv_sumtotal_percent = parseFloat(sumtotal_percent);
       }
       
       var conv_percentage = parseFloat(percentage);

       var real_count_percent = conv_sumtotal_percent + conv_percentage;
       console.log("total percent " + conv_sumtotal_percent)
       console.log("percent baru " + conv_percentage)
       console.log("hasilnya " + real_count_percent)

       var conv_amount = amount.replace(/,/g, "");
       console.log(conv_amount)
       var real_amount = parseFloat(conv_amount);
       console.log(real_amount)


       console.log("installment date " + installmentdate)
       var d2=new Date(installmentdate.split("/").reverse().join("-"));
       console.log('conv date' + d2)
       var dd2=d2.getDate();
       console.log('conv date' + dd2)
       var mm2=d2.getMonth()+1;
       console.log('conv date' + mm2)
       var yy2=d2.getFullYear();
       console.log('conv date' + yy2)
       var newinstallmentdate=yy2+"-"+mm2+"-"+dd2;
       console.log('conv date' + newinstallmentdate)


       var prod_date = $('#slipprodyearupdate').val();
       console.log('prod_date' + prod_date)
       var d=new Date(prod_date.split("/").reverse().join("-"));
       console.log('conv date' + d)

       var dd=d.getDate();
       console.log('conv date' + dd)

       var mm=d.getMonth()+1;
       console.log('conv date' + mm)

       var yy=d.getFullYear();
       console.log('conv date' + yy)

       var newproddate=yy+"-"+mm+"-"+dd;
       console.log('conv date' + newinstallmentdate)

       
       if(new Date(newinstallmentdate) >= new Date(newproddate)){
            if(real_count_percent <= 100){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

               $.ajax({
                 url:"{{ route('installment.store') }}",
                 type:"POST",
                 data:{
                     installmentdate:newinstallmentdate,
                     percentage:percentage,
                     slipamount:real_amount,
                     id_slip:slip_id,
                     insured_id:code_ms,
                     sliptype:sliptype
                 },
                 beforeSend: function() { $("body").addClass("loading");  },
                 complete: function() {  $("body").removeClass("loading"); },
                 success:function(response)
                 {

                     console.log(response)
                     if(response.code_error){
                        swal("Error!", response.message , "Insert Error");
                        // $('#addinstallmentinsured-btn').attr('hidden','true')
                    }
                    else
                    {
                            // var curr_amount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(response.amount);
                            
                            
                            $('#installmentPanelUpdate tbody').append('<tr id="iidinstallmentupdate'+response.id+'" data-name="installmentvalue[]"><td data-name="'+response.installment_date+'">'+response.installment_date+'</td><td data-name="'+response.percentage+'">'+floatToString(parseFloat(response.percentage).toFixed(5))+'</td><td data-name="'+response.amount+'">'+amountToString(response.amount)+'</td><td><a href="javascript:void(0)" onclick="deleteinstallmentdetail('+response.id+')">delete</a></td></tr>')
                            $('#dateinstallmentupdate').val('');
                            $('#slipippercentageupdate').val('');
                            $('#slipipamountupdate').val('');
                            $('#slipipamountupdate2').val('');

                            if(response.message){
                                // swal("Success!", response.message, "success")
                            }       
                            

                            $('#sliptotalamountinspanupdate').val(conv_amount.toString());

                            var total_percent =  $('#sliptotalpercentinspanupdate').val();

                            if(total_percent == ''){
                                var sum_percent = isNaN(parseFloat(0) + parseFloat(response.percentage)) ? 0 :(parseFloat(0) + parseFloat(response.percentage)) ;
                                $('#sliptotalpercentinspanupdate').val(sum_percent.toString());
                                console.log($('#sliptotalpercentinspanupdate').val())

                                var total_percent2 =  $('#sliptotalpercentinspanupdate').val();

                                if(total_percent2 == "100")
                                {
                                    $('#addinstallmentinsuredupdate-btn').attr('hidden','true');
                                }

                            }else{
                                var sum_percent = isNaN(parseFloat(total_percent) + parseFloat(response.percentage)) ? 0 :(parseFloat(total_percent) + parseFloat(response.percentage))
                                $('#sliptotalpercentinspanupdate').val(sum_percent.toString());
                                console.log($('#sliptotalpercentinspanupdate').val())
                                
                                var total_percent2 =  $('#sliptotalpercentinspanupdate').val();

                                if(total_percent2 == "100")
                                {
                                    $('#addinstallmentinsuredupdate-btn').attr('hidden','true');
                                }
                                
                            }

                            $('#slipipdateupdate').val('');
                            $('#slipipdateupdate').focus();
                        }

                       //var total =  parseFloat($("#sliptotalsum").val());
                       //var sum = isNaN(total + parseFloat(response.amount)) ? 0 :(total + parseFloat(response.amount)) ;
                       //$("#sliptotalsum").val(sum);

                   }
               });
           }
           else{
                swal('warning!','installment cannot more than 100 %','validation error');
           }

       }else{
        swal('warning!','installment date cannot be lower than prod date / document date','validation error');
       }
   });
</script>



<script type='text/javascript'>
    $('#addretrocessioninsuredupdate-btn').click(function(e){
       //alert('masuk');
       e.preventDefault();

       var type = $('#sliprptypeupdate').val();
       var contract = $('#sliprpcontractupdate').val();
       var percentage = $('#sliprppercentageupdate').val();
       var amount = $('#sliprpamountupdate').val();
       var or_percent = $('#sliporupdate').val();
       var code_ms = $('#mhnumber').val();
       var sliptype = 'mh'
       
       var slip_id = $('#slipnumberupdate').val();
       var token2 = $('input[name=_token2]').val();

       var conv_amount = amount.replace(/,/g, "");
       console.log(conv_amount)
       var real_amount = parseInt(conv_amount);
       console.log(real_amount)
       
       $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

       $.ajax({
         url:"{{ route('retrocession.store') }}",
         type:"POST",
         data:{
             // type:type,
             contract:contract,
             percentage:percentage,
             amount:real_amount,
             or_percent:or_percent,
             id_slip:slip_id,
             insured_id:code_ms,
             sliptype:sliptype
         },
         beforeSend: function() { $("body").addClass("loading");  },
         complete: function() {  $("body").removeClass("loading"); },
         success:function(response)
         {

             console.log(response)
            //    var curr_amount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(response.amount);
            if(response.code_error){
                swal("Error!", response.message , "Insert Error");
                    
            }else{
                var curr_amount = response.amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('#retrocessionPanelUpdate tbody').append('<tr id="iidretrocessionupdate'+response.id+'" data-name="retrocessionvalue[]"><td data-name="'+response.contract+'">'+response.contract+'</td><td data-name="'+floatToString(parseFloat(response.percentage).toFixed(5))+'">'+floatToString(parseFloat(response.percentage).toFixed(5))+'</td><td data-name="'+amountToString(response.amount)+'">'+amountToString(response.amount)+'</td><td><a href="javascript:void(0)" onclick="deleteretrocessiondetailupdate('+response.id+')">delete</a></td></tr>');
                $('#sliprppercentageupdate').val('');
                $('#sliprpamountupdate').val('');
                $('#sliprpamountupdate2').val('');
                if(response.message){
                        swal("Success!", response.message, "success")
                    }
                var or = $('#sliporupdate').val();
                var total_percent = $('#sliptotalpercentretroupdate').val();
                console.log(total_percent)
                var proses = parseInt(total_percent) + parseInt(response.percentage);
                var sum_percent = isNaN(proses) ? 0 :(proses) ;
                $('#sliptotalpercentretroupdate').val(sum_percent);
                var total_percent2 =  $('#sliptotalpercentretroupdate').val();
                console.log("Total Percent Retro : " + total_percent2);
                        if(parseInt(total_percent2)>=100)
                        {
                            $('#addretrocessioninsuredupdate-btn').attr('hidden','true');
                        }                        

            }

        }
    });

   });
</script>

<script type='text/javascript'>
    function deleteretrocessiondetailupdate(id)
    {
        var token2 = $('input[name=_token2]').val();

        $.ajax({
            url:'{{ url("/") }}/delete-retrocession-list/'+id,
            type:"DELETE",
            data:{
                _token:token2
            },
            beforeSend: function() { $("body").addClass("loading");  },
            complete: function() {  $("body").removeClass("loading"); },
            success:function(response){

                $('#iidretrocessionupdate'+id).remove();
                console.log(response);
                var total_percent =  $('#sliptotalpercentretroupdate').val();
                var proses = parseFloat(total_percent) - parseFloat(response.percentage)        
                var sum_percent = isNaN(proses) ? 0 :(proses) ;
                $('#sliptotalpercentretroupdate').val(sum_percent);
                console.log('total percent' + $('#sliptotalpercentretroupdate').val())
                        

                var total_percent2 =  parseFloat($('#sliptotalpercentretroupdate').val());

                if(parseInt(total_percent2) < 100)
                {
                    $('#addretrocessioninsuredupdate-btn').attr('hidden','false');
                    $('#addretrocessioninsuredupdate-btn').removeAttr('hidden')
                }
            }
        });
    }
</script>
<!-- akhir table form update -->


<!-- awal table form endorsement -->
<script type='text/javascript'>
     $('#form-hulltypecountendorsement').submit(function(e){
        e.preventDefault();

        var type = $('#mhtypeendorsement').val();
        var share = $('#mhtypeshareendorsement').val();
        var insured_id = $('#mhnumberendorsement').val();
        var amount = $('#mhtypeamountendorsement').val();
        var rate = $('#mhtyperateendorsement').val();
        var premi = $('#mhtypepremiendorsement').val();
        var slip_id = $('#slipnumberendorsement').val();
        var token = $('input[name=_token]').val();
        var slip_type = 'mh';
        var sumtotal_percent = $('#totalhullshareendorsement').val();
        var type_hull = $('#hulltypehiddenendorsement').val();
        var sum_precent_war = $('#totalhullwarendorsement').val();
        var sum_precent_hmiv = $('#totalhullhmivendorsement').val();
        var countendorsement = parseInt($('#countendorsmentdata').val())+1;
       if(sum_precent_war == null || sum_precent_war == "" ){
            var conv_sum_precent_war = parseFloat("0");
       }else{
            var conv_sum_precent_war = parseFloat(sum_precent_war);
       }

       if(sum_precent_hmiv == null || sum_precent_hmiv == "" ){
            var conv_sum_precent_hmiv = parseFloat("0");
       }else{
            var conv_sum_precent_hmiv = parseFloat(sum_precent_hmiv);
       }
       
       var conv_percentage = parseFloat(share);

       var real_count_percent = conv_sumtotal_percent + conv_sum_precent_war + conv_sum_precent_hmiv;
       console.log("total percent " + conv_sumtotal_percent)
       console.log("percent baru " + conv_percentage)
       console.log("hasilnya " + real_count_percent)

       var conv_amount = amount.replace(/,/g, "");
       console.log(conv_amount)
       var real_amount = parseFloat(conv_amount);
       console.log(real_amount)

        var conv_amount = amount.replace(/,/g, "");
       console.log('conv_amount ' + conv_amount)
       var real_amount = parseFloat(conv_amount);
       console.log('real_amount ' + real_amount)

       var conv_premi = premi.replace(/,/g, "");
       console.log('conv_amount ' + conv_premi)
       var real_premi = parseFloat(conv_premi);
       console.log('real_amount ' + real_premi)

       console.log('shipcode ' + type )
       console.log('shipname ' + share)
       console.log('insured_id ' + insured_id)
       console.log('ceding ' + amount )
       console.log('percent ' + rate )
       console.log('cndn ' + premi )
       console.log('slip_type ' + slip_type )
        
        if(real_count_percent <= 200 ){
            if(type == 3 && parseFloat(share) < 100){
                swal('warning!','WAR type must 100%','validation error');
            }else{
                    console.log('countendorsement' + countendorsement)
                    if(type_hull == 1){

                        $.ajax({
                            url:"{{ route('hullcount.store') }}",
                            type:"POST",
                            data:{
                                type_id:type,
                                share:share,
                                amount:real_amount,
                                rate:rate,
                                countendorsement:countendorsement,
                                basic_premium:real_premi,
                                insured_id:insured_id,
                                slip_id:slip_id,
                                sliptype:slip_type,
                                grouptype:type_hull,
                                _token:token
                            },
                            beforeSend: function() { $("body").addClass("loading");  },
                            complete: function() {  $("body").removeClass("loading"); },
                            success:function(response){
                                console.log(response)

                                if (response.success) {
                                    var amount = response.amount;
                                
                                console.log('amount' + amount)
                                var fl_amount = parseFloat(amount);
                                console.log('amount float' + fl_amount)
                                var new_amount = fl_amount;
                                console.log('amount to fixed' + new_amount)
                                var curr_amount = new_amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                console.log('current amount' + curr_amount) 

                                var premi = response.premi;
                                
                                console.log('premi' + premi)
                                var fl_premi = parseFloat(premi);
                                console.log('premi float' + fl_premi)
                                var new_premi = fl_premi;
                                console.log('premi to fixed' + new_premi)
                                var curr_premi = new_premi.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                console.log('current premi' + curr_premi) 


                                var cndn = '';
                                var certno = '';                    
                                var slipno = '';
                                var policyno = '';

                                var percent = response.share;
                                var percentfl = parseFloat(percent);
                                var new_percent = percentfl;

                                var percentrate = response.rate;
                                var percentflrate = parseFloat(percentrate);
                                var new_rate = percentflrate;

                                

                                $('#marineHullCountTableEndorsement').append('<tr id="hcidendorsementid'+obj.id+'"  data-name="">'+
                                            '<td>'+obj.hullcode+ '-' + obj.hulltype+'</td>'+
                                            '<td>'+floatToString(obj.share)+'</td>'+
                                            '<td>'+amountToString(obj.amount)+'</td>'+
                                            '<td>'+floatToString(obj.rate)+'</td>'+
                                            '<td>'+amountToString(obj.basic_premium)+'</td>'+
                                            '<td><a href="javascript:void(0)" onclick="deletehullcountendorsement('+obj.id+')">'+
                                            '<i class="fas fa-trash text-danger"></i></a></td>'+
                                            '</tr>')


                                    console.log("sum premi" + response.sum_premi)

                                $('#totalhullpremiendorsement').val("");
                                $('#totalhullamountendorsement').val("");
                                $('#totalhullshareendorsement').val("");

                                

                                if(response.sum_share){
                                    var total_share = response.sum_share;
                                    var countwar = $('#totalhullwarendorsement').val();                                    
                                    var conv_totalshare = total_share.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    
                                    if(countwar == null || countwar = ""){
                                      var sumsharewar =  isNaN(parseFloat(total_share) + parseFloat("0")) ? 0 :(parseFloat(total_share) + parseFloat("0"));


                                      $('#totalhullwarendorsement').val(sumsharewar);
                                    }else{
                                      var sumsharewar =  isNaN(parseFloat(total_share) + parseFloat(countwar)) ? 0 :(parseFloat(total_share) + parseFloat(countwar));

                                        $('#totalhullwarendorsement').val(sumsharewar);
                                    } 
                                }

                                var warhull = parseFloat($('#totalhullwarendorsement').val());
                                var hmivhull = parseFloat($('#totalhullhmivendorsement').val());

                                if((warhull + hmivhull) == 200.000 ){
                                    $('#addhullcountendorsement-btn').attr('hidden','true');
                                }
                                

                                $('#ModalCountHullendorsement').modal('toggle');
                                $('#form-hulltypecountendorsement')[0].reset();
                            }else{
                                toastr.warning(response.message)
                            }
                            }
                        });
                    }
                    else
                    {
                            var sumhmivshare = $('#totalhullhmivendorsement').val();
                             
                             if(sumhmivshare)
                             {
                             }
                             else
                             {
                              sumhmivshare=0;
                             }

                            var totalshare = parseFloat(share) + parseFloat(sumhmivshare);

                            if(totalshare <= 100)
                            {
                                $.ajax({
                                    url:"{{ route('hullcount.store') }}",
                                    type:"POST",
                                    data:{
                                        type_id:type,
                                        share:share,
                                        amount:real_amount,
                                        rate:rate,
                                        basic_premium:real_premi,
                                        insured_id:insured_id,
                                        slip_id:slip_id,
                                        sliptype:slip_type,
                                        grouptype:type_hull,
                                        _token:token
                                    },
                                    beforeSend: function() { $("body").addClass("loading");  },
                                    complete: function() {  $("body").removeClass("loading"); },
                                    success:function(response){
                                        console.log(response)

                                        var amount = response.amount;
                                        
                                        console.log('amount' + amount)
                                        var fl_amount = parseFloat(amount);
                                        console.log('amount float' + fl_amount)
                                        var new_amount = fl_amount;
                                        console.log('amount to fixed' + new_amount)
                                        var curr_amount = new_amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                        console.log('current amount' + curr_amount) 

                                        var premi = response.premi;
                                        
                                        console.log('premi' + premi)
                                        var fl_premi = parseFloat(premi);
                                        console.log('premi float' + fl_premi)
                                        var new_premi = fl_premi;
                                        console.log('premi to fixed' + new_premi)
                                        var curr_premi = new_premi.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                        console.log('current premi' + curr_premi) 


                                        var cndn = '';
                                        var certno = '';
                                        var slipno = '';
                                        var policyno = '';

                                        var percent = response.share;
                                        var percentfl = parseFloat(percent);
                                        var new_percent = percentfl;

                                        var percentrate = response.rate;
                                        var percentflrate = parseFloat(percentrate);
                                        var new_rate = percentflrate;

                                        // $('#sumhmivshare').val(response.share);
                                        $('#marineHullCountTableendorsement > tbody:last-child').append('<tr id="hcidendorsementid'+response.id+'"  data-name="">'+
                                            '<td>'+response.type_code+'</td>'+
                                            '<td>'+floatToString(response.share)+'</td>'+
                                            '<td>'+floatToString(parseFloat(response.amount).toFixed(2))+'</td>'+
                                            '<td>'+floatToString(response.rate)+'</td>'+
                                            '<td>'+floatToString(parseFloat(response.premi).toFixed(2))+'</td>'+
                                            '<td><a href="javascript:void(0)" onclick="deletehullcountendorsement('+response.id+')">'+
                                            '<i class="fas fa-trash text-danger"></i></a></td>'+
                                            '</tr>')


                                            console.log("sum premi" + response.sum_premi)

                                        $('#totalhullpremiendorsement').val("");
                                        $('#totalhullamountendorsement').val("");
                                        $('#totalhullshareendorsement').val("");

                                        if(response.sum_share){
                                            var total_share = response.sum_share;
                                            var countwar = $('#totalhullwarendorsement').val();                                    
                                            var conv_totalshare = total_share.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                        
                                                if(countwar == null || countwar = ""){
                                                  var sumsharewar =  isNaN(parseFloat(total_share) + parseFloat("0")) ? 0 :(parseFloat(total_share) + parseFloat("0"));


                                                  $('#totalhullwarendorsement').val(sumsharewar);
                                                }else{
                                                  var sumsharewar =  isNaN(parseFloat(total_share) + parseFloat(countwar)) ? 0 :(parseFloat(total_share) + parseFloat(countwar));

                                                    $('#totalhullwarendorsement').val(sumsharewar);
                                                } 
                                        }

                                        var warhull = parseFloat($('#totalhullwarendorsement').val());
                                        var hmivhull = parseFloat($('#totalhullhmivendorsement').val());

                                        // if((warhull + hmivhull) == 200.000 )
                                        // {
                                        //     $('#addhullcountendorsement-btn').attr('hidden','true');
                                        // }
                                        // else
                                        // {
                                        //     swal('warning!','share HM+IV must 100 %. insert again','validation error');
                                        // }
                                        
                                            

                                        $('#ModalCountHullendorsement').modal('toggle');
                                        $('#form-hulltypecountendorsement')[0].reset();
                                }
                                
                            });
                            
                            }else{
                                swal('warning!','share HM+IV cannot more than 100 %','validation error');
                            }
                        
                    }


            }

        }else{
                swal('warning!','share cannot more than 200 %','validation error');

        }

    });
</script>

<script type='text/javascript'>
    function deletehullcountendorsement(id){
        var token = $('input[name=_token]').val();

        $.ajax({
            url:'{{ url("/") }}/delete-hull-count/'+id,
            type:"DELETE",
            data:{
                _token:token
            },
            beforeSend: function() { $("body").addClass("loading");  },
            complete: function() {  $("body").removeClass("loading"); },
            success:function(response){
                
                $('#hcidendorsementid'+id).remove();
                console.log(response);

                console.log("sum hull" + response.sumperhull)

                if(response.sum_share){
                    var sumshare = response.sum_share;       
                    $('#totalhullshareendorsement').val(sumshare);
                }
                else
                {
                    $('#totalhullshareendorsement').val(0);
                }

                if(response.sum_amount){
                    var sumamount = response.sum_amount;
                    var fl_amount = parseFloat(sumamount);
                    var new_amount = fl_amount;
                    var curr_amount = new_amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    $('#totalhullamountendorsement').val(curr_amount);

                }
                else
                {
                    $('#totalhullamountendorsement').val(0);
                }

                if(response.sum_premi){
                    var sumpremi = response.sum_premi;
                    var fl_premi = parseFloat(sumpremi);
                    var new_premi = fl_premi;
                    var curr_premi = new_premi.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    $('#totalhullpremiendorsement').val(curr_premi);
                
                }
                else
                {
                    $('#totalhullpremiendorsement').val(0);
                }


            }
        });
    }
</script>

<script type='text/javascript'>
    $('#adddeductibleinsuredendorsement-btn').click(function(e){
       //alert('masuk');
           e.preventDefault();

           var slipdptype = $('#slipdptypeendorsement').val();
           // var slipdpcurrency = $('#slipdpcurrency').val();
           
           var percentage = $('#slipdppercentageendorsement').val();
           var amount = $('#slipdpamountendorsement').val();
           var minamount = $('#slipdpminamountendorsement').val();
           var countendorsement = parseInt($('#countendorsmentdata').val())+1;
           var code_ms = $('#mhnumber').val();
           var sliptype = 'mh';
           var real_minamount = 0;
           if(minamount == ''){
               real_minamount = 0;
           }
           else{
            var conv_minamount = minamount.replace(/,/g, "");
            console.log(conv_minamount)
            real_minamount = parseInt(conv_minamount);
        }

        var slip_id = $('#slipnumberendorsement').val();
        var token2 = $('input[name=_token2]').val();


        

        var conv_amount = amount.replace(/,/g, "");
        console.log(conv_amount)
        var real_amount = parseInt(conv_amount);
        console.log(real_amount)

        
        console.log(real_minamount)

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
         url:"{{ route('deductible.store') }}",
         type:"POST",
         data:{
             slipdptype:slipdptype,
             // slipdpcurrency:slipdpcurrency,
             percentage:percentage,
             countendorsement:countendorsement,
             amount:real_amount,
             minamount:real_minamount,
             id_slip:slip_id,
             insured_id:code_ms,
             sliptype:sliptype
         },
         beforeSend: function() { $("body").addClass("loading");  },
         complete: function() {  $("body").removeClass("loading"); },
         success:function(response)
         {

             console.log(response)
                //    var curr_amount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(response.amount);
                
                   //    var curr_amount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(response.amount);
                   var curr_amount2 = parseFloat(response.amount.toString());
                   var curr_amount = curr_amount2.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                   
                    //    var curr_minamount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(response.min_claimamount);
                    var curr_minamount2 = parseFloat(response.min_claimamount.toString());
                    var curr_minamount = curr_minamount2.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                   
                
                $('#deductiblePanelendorsement tbody').append('<tr id="iiddeductibleendorsement'+response.id+'" data-name="deductiblevalue[]"><td data-name="'+response.deductibletype+'">'+response.deductibletype+'</td><td data-name="'+response.percentage+'">'+response.percentage+'</td><td data-name="'+response.amount+'">'+amountToString(response.amount)+'</td><td data-name="'+amountToString(response.min_claimamount)+'">'+amountToString(response.min_claimamount)+'</td><td><a href="javascript:void(0)" onclick="deletedeductibledetail('+response.id+')">delete</a></td></tr>');
                $('#slipdppercentageendorsement').val('');
                $('#slipdpamountendorsement').val('');
                $('#slipdpamountendorsement2').val('');
                $('#slipdpminamountendorsement').val('');

            }
        });

    });

    $('#addconditionneededendorsement-btn').click(function(e){
       e.preventDefault();

       var cncode = $('#slipcncodeendorsement').val();
       var slip_id = $('#slipnumberendorsement').val();
       var insured_id = $('#mhnumber').val();
       var countendorsement = parseInt($('#countendorsmentdata').val())+1;
       var slip_type = "mh";
       
       $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

       $.ajax({
           url:"{{ route('conditionneeded.store') }}",
           type:"POST",
           data:{
                slipcncode:cncode,
                id_slip:slip_id,
                countendorsement:countendorsement,
                insured_id:insured_id,
                slip_type:slip_type
           },
           beforeSend: function() { $("body").addClass("loading");  },
           complete: function() {  $("body").removeClass("loading"); },
           success:function(response){

               console.log(response)
                if (response.success) {
                    if(response.information == null){
                        $('#conditionNeededendorsement tbody').append('<tr id="cnidendorsement'+response.id+'" data-name="conditionneededvalue[]"><td data-name="'+response.conditionneeded_id+'">'+response.condition+'</td><td data-name="'+response.information+'">-</td><td><a href="javascript:void(0)" onclick="deleteconditionneeded('+response.id+')">delete</a></td></tr>')
                   
                   }else{
                            $('#conditionNeededendorsement tbody').append('<tr id="cnidendorsement'+response.id+'" data-name="conditionneededvalue[]"><td data-name="'+response.conditionneeded_id+'">'+response.condition+'</td><td data-name="'+response.information+'">'+response.information+'</td><td><a href="javascript:void(0)" onclick="deleteconditionneeded('+response.id+')">delete</a></td></tr>')
                   
                   }
                    $(':input','#addconditionneededendorsement').not(':button, :submit, :reset, :hidden').val(' ').removeAttr('checked').removeAttr('selected');
                }
               
               
               
               
            
           }
       });

    });
</script>

<script type='text/javascript'>
    function deletedeductibledetailendorsement(id)
    {
        var token2 = $('input[name=_token2]').val();

        $.ajax({
            url:'{{ url("/") }}/delete-deductible-list/'+id,
            type:"DELETE",
            data:{
                _token:token2
            },
            beforeSend: function() { $("body").addClass("loading");  },
            complete: function() {  $("body").removeClass("loading"); },
            success:function(response){

                $('#iiddeductibleendorsement'+id).remove();
                console.log(response);
            }
        });
    }

    function deleteconditionneededendorsement(id){
        var token2 = $('input[name=_token2]').val();

        $.ajax({
            url:'{{ url("/") }}/delete-conditionneeded-list/'+id,
            type:"DELETE",
            data:{
                _token:token2
            },
            beforeSend: function() { $("body").addClass("loading");  },
           complete: function() {  $("body").removeClass("loading"); },
            success:function(response){
                
                $('#cnidendorsement'+id).remove();
                console.log(response);
                
            }
        });
    }
</script>

<script type='text/javascript'>
    $('#addinstallmentinsuredendorsement-btn').click(function(e){
       //alert('masuk');
       e.preventDefault();

       var installmentdate = $('#slipipdateendorsement').val();
       var percentage = $('#slipippercentageendorsement').val();
       var amount = $('#slipipamountendorsement').val();
       var slip_id = $('#slipnumberendorsement').val();
       var token2 = $('input[name=_token2]').val();
       var code_ms = $('#mhnumber').val();
       var countendorsement = parseInt($('#countendorsmentdata').val())+1;
       var sliptype = 'mh';
       
       var sumtotal_percent = $('#sliptotalpercentinspanendorsement').val();

       if(sumtotal_percent == null || sumtotal_percent == "" )
       {
            var conv_sumtotal_percent = parseFloat("0");
       }
       else
       {
            var conv_sumtotal_percent = parseFloat(sumtotal_percent);
       }
       
       var conv_percentage = parseFloat(percentage);

       var real_count_percent = conv_sumtotal_percent + conv_percentage;
       console.log("total percent " + conv_sumtotal_percent)
       console.log("percent baru " + conv_percentage)
       console.log("hasilnya " + real_count_percent)

       var conv_amount = amount.replace(/,/g, "");
       console.log(conv_amount)
       var real_amount = parseFloat(conv_amount);
       console.log(real_amount)


       console.log("installment date " + installmentdate)
       var d2=new Date(installmentdate.split("/").reverse().join("-"));
       console.log('conv date' + d2)
       var dd2=d2.getDate();
       console.log('conv date' + dd2)
       var mm2=d2.getMonth()+1;
       console.log('conv date' + mm2)
       var yy2=d2.getFullYear();
       console.log('conv date' + yy2)
       var newinstallmentdate=yy2+"-"+mm2+"-"+dd2;
       console.log('conv date' + newinstallmentdate)


       var prod_date = $('#slipprodyearendorsement').val();
       console.log('prod_date' + prod_date)
       var d=new Date(prod_date.split("/").reverse().join("-"));
       console.log('conv date' + d)

       var dd=d.getDate();
       console.log('conv date' + dd)

       var mm=d.getMonth()+1;
       console.log('conv date' + mm)

       var yy=d.getFullYear();
       console.log('conv date' + yy)

       var newproddate=yy+"-"+mm+"-"+dd;
       console.log('conv date' + newinstallmentdate)

       
       if(new Date(newinstallmentdate) >= new Date(newproddate))
       {
            if(real_count_percent <= 100)
            {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

               $.ajax({
                 url:"{{ route('installment.store') }}",
                 type:"POST",
                 data:{
                     installmentdate:newinstallmentdate,
                     percentage:percentage,
                     slipamount:real_amount,
                     countendorsement:countendorsement,
                     id_slip:slip_id,
                     insured_id:code_ms,
                     sliptype:sliptype
                 },
                 beforeSend: function() { $("body").addClass("loading");  },
                 complete: function() {  $("body").removeClass("loading"); },
                 success:function(response)
                 {

                     console.log(response)
                     if(response.code_error){
                        swal("Error!", response.message , "Insert Error");
                        // $('#addinstallmentinsured-btn').attr('hidden','true')
                    }
                    else
                    {
                            // var curr_amount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(response.amount);
                            
                            
                            $('#installmentPanelendorsement tbody').append('<tr id="iidinstallmentendorsement'+response.id+'" data-name="installmentvalue[]"><td data-name="'+response.installment_date+'">'+response.installment_date+'</td><td data-name="'+response.percentage+'">'+floatToString(parseFloat(response.percentage).toFixed(5))+'</td><td data-name="'+response.amount+'">'+amountToString(response.amount)+'</td><td><a href="javascript:void(0)" onclick="deleteinstallmentendorsement('+response.id+')">delete</a></td></tr>')
                            $('#dateinstallmentendorsement').val('');
                            $('#slipippercentageendorsement').val('');
                            $('#slipipamountendorsement').val('');
                            $('#slipipamountendorsement2').val('');

                            if(response.message){
                                // swal("Success!", response.message, "success")
                            }       
                            

                            $('#sliptotalamountinspanendorsement').val(conv_amount.toString());

                            var total_percent =  $('#sliptotalpercentinspanendorsement').val();
                           
                            if(total_percent == ''){
                                var sum_percent = isNaN(parseFloat(0) + parseFloat(response.percentage)) ? 0 :(parseFloat(0) + parseFloat(response.percentage)) ;
                                $('#sliptotalpercentinspanendorsement').val(sum_percent.toString());
                                console.log($('#sliptotalpercentinspanendorsement').val())

                                var total_percent2 =  $('#sliptotalpercentinspanendorsement').val();

                                if(total_percent2 == "100")
                                {
                                    $('#addinstallmentinsuredendorsement-btn').attr('hidden','true');
                                }

                            }else{
                                var sum_percent = isNaN(parseFloat(total_percent) + parseFloat(response.percentage)) ? 0 :(parseFloat(total_percent) + parseFloat(response.percentage))
                                $('#sliptotalpercentinspanendorsement').val(sum_percent.toString());
                                console.log($('#sliptotalpercentinspanendorsement').val())
                                
                                var total_percent2 =  $('#sliptotalpercentinspanendorsement').val();

                                if(total_percent2 == "100")
                                {
                                    $('#addinstallmentinsuredendorsement-btn').attr('hidden','true');
                                }
                                
                            }

                            $('#slipipdateendorsement').val('');
                            $('#slipipdateendorsement').focus();
                        }

                       //var total =  parseFloat($("#sliptotalsum").val());
                       //var sum = isNaN(total + parseFloat(response.amount)) ? 0 :(total + parseFloat(response.amount)) ;
                       //$("#sliptotalsum").val(sum);

                   }
               });
           }
           else{
                swal('warning!','installment cannot more than 100 %','validation error');
           }

       }else{
        swal('warning!','installment date cannot be lower than prod date / document date','validation error');
       }
   });
</script>


<script type='text/javascript'>
    $('#addretrocessioninsuredendorsement-btn').click(function(e){
       //alert('masuk');
       e.preventDefault();

       var type = $('#sliprptypeendorsement').val();
       var contract = $('#sliprpcontractendorsement').val();
       var percentage = $('#sliprppercentageendorsement').val();
       var amount = $('#sliprpamountendorsement').val();
       var or_percent = $('#sliporendorsement').val();
       var code_ms = $('#mhnumber').val();
       var sliptype = 'mh'
       var countendorsement = parseInt($('#countendorsmentdata').val())+1;
       var slip_id = $('#slipnumberendorsement').val();
       var token2 = $('input[name=_token2]').val();

       var conv_amount = amount.replace(/,/g, "");
       console.log(conv_amount)
       var real_amount = parseInt(conv_amount);
       console.log(real_amount)
       
       $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

       $.ajax({
         url:"{{ route('retrocession.store') }}",
         type:"POST",
         data:{
             type:type,
             contract:contract,
             percentage:percentage,
             amount:real_amount,
             or_percent:or_percent,
             id_slip:slip_id,
             countendorsement:countendorsement,
             insured_id:code_ms,
             sliptype:sliptype
         },
         beforeSend: function() { $("body").addClass("loading");  },
         complete: function() {  $("body").removeClass("loading"); },
         success:function(response)
         {

             console.log(response)
            //    var curr_amount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(response.amount);
            if(response.code_error){
                swal("Error!", response.message , "Insert Error");
                    
            }else{
                var curr_amount = response.amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('#retrocessionPanelendorsement tbody').append('<tr id="iidretrocessionendorsement'+response.id+'" data-name="retrocessionvalue[]"><td data-name="'+response.contract+'">'+response.contract+'</td><td data-name="'+floatToString(parseFloat(response.percentage).toFixed(5))+'">'+floatToString(parseFloat(response.percentage).toFixed(5))+'</td><td data-name="'+amountToString(response.amount)+'">'+amountToString(response.amount)+'</td><td><a href="javascript:void(0)" onclick="deleteretrocessiondetailendorsement('+response.id+')">delete</a></td></tr>');
                $('#sliprppercentageendorsement').val('');
                $('#sliprpamountendorsement').val('');
                $('#sliprpamountendorsement2').val('');
                if(response.message){
                        swal("Success!", response.message, "success")
                    }
                var or = $('#sliporendorsement').val();
                var total_percent = $('#sliptotalpercentrporendorsement').val();
                var proses = parseInt(total_percent) + parseInt(response.percentage);
                var sum_percent = isNaN(proses) ? 0 :(proses) ;
                $('#sliptotalpercentrporendorsement').val(sum_percent);
                var total_percent2 =  $('#sliptotalpercentrporendorsement').val();
                console.log("Total Percent Retro : " + total_percent2);
                        if(parseInt(total_percent2)>=100)
                        {
                            $('#addretrocessioninsuredendorsement-btn').attr('hidden','true');
                        }                        

            }

        }
    });

   });
</script>

<script type='text/javascript'>
    function deleteretrocessiondetailendorsement(id)
    {
        var token2 = $('input[name=_token2]').val();

        $.ajax({
            url:'{{ url("/") }}/delete-retrocession-list/'+id,
            type:"DELETE",
            data:{
                _token:token2
            },
            beforeSend: function() { $("body").addClass("loading");  },
            complete: function() {  $("body").removeClass("loading"); },
            success:function(response){

                $('#iidretrocessionendorsement'+id).remove();
                console.log(response);
                var total_percent =  $('#sliptotalpercentrporendorsement').val();
                        
                var sum_percent = isNaN(parseFloat(total_percent) - parseFloat(response.percentage)) ? 0 :(parseFloat(total_percent) - parseFloat(response.percentage)) ;
                $('#sliptotalpercentrporendorsement').val(sum_percent);
                console.log('total percent' + $('#sliptotalpercentrporendorsement').val())
                        

                var total_percent2 =  parseFloat($('#sliptotalpercentrporendorsement').val());

                if(parseInt(total_percent2) < 100)
                {
                    $('#addretrocessioninsuredendorsement-btn').attr('hidden','false');
                    $('#addretrocessioninsuredendorsement-btn').removeAttr('hidden')
                }
            }
        });
    }
</script>
<!-- akhir table form endorsement -->


<script type="text/javascript">
    $('#addinsuredsave-btn').click(function(e){
       //alert('masuk');
       e.preventDefault();

       var msinumber = $('#mhnumber').val();
       var msiprefix = $('#mhprefix').val();
       var msisuggestinsured = $('#autocomplete').val();
       var msisuffix = $('#autocomplete2').val();
       var msishare = $('#mhshare').val();
       var msisharefrom  = $('#mhsharefrom').val();
       var msishareto = $('#mhshareto').val();
       var msiroute = $('#mhroute').val();
       var msiroutefrom  = $('#mhroutefrom').val();
       var msirouteto = $('#mhrouteto').val();
       var msicurrency = $('#mhcurrency').val();
       var msiuy = $('#mhuy').val();
       var msiflag_overseas = $('input[name="flag_overseas"]:checked').val();
        var msibusiness_id = $('#business_id').val();

    //    var msicoinsurance = $('#msicoinsurance').val();

        var conv_msishare = msishare.replace(/,/g, "");
       console.log(conv_msishare)
       var real_msishare = parseInt(conv_msishare);
       console.log(real_msishare)
       var conv_msisharefrom = msisharefrom.replace(/,/g, "");
       console.log(conv_msisharefrom)
       var real_msisharefrom = parseInt(conv_msisharefrom);
       console.log(real_msisharefrom)
       var conv_msishareto = msishareto.replace(/,/g, "");
       console.log(conv_msishareto)
       var real_msishareto = parseInt(conv_msishareto);
       console.log(real_msishareto)

       if(isNaN(real_msishare))
       {
           real_msishare=0;
       }

       if(isNaN(real_msishareto))
       {
           real_msishareto=0;
       }

       if(isNaN(real_msisharefrom))
       {
        real_msisharefrom=0;
        }
       
       
       var token2 = $('input[name=_token]').val();

       console.log(msiprefix)
       console.log(msisuggestinsured)
       console.log(msinumber)
       console.log(msisuffix)

       
       $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

       $.ajax({
           url:"{{ url('transaction-data/marine-hull-insured/store') }}",
           type:"POST",
           data:{
               msinumber:msinumber,
               msiprefix:msiprefix,
               msisuggestinsured:msisuggestinsured,
               msisuffix:msisuffix,
               msishare:real_msishare,
               msisharefrom:real_msisharefrom,
               msishareto:real_msishareto,
               msiroute:msiroute,
               msiroutefrom:msiroutefrom,
               msirouteto:msirouteto,
               msicurrency:msicurrency,
               msiuy:msiuy,
               msiflag_overseas:msiflag_overseas,
                msibusiness_id:msibusiness_id
            //    msicoinsurance:msicoinsurance
           },
           beforeSend: function() { $("body").addClass("loading");  },
           complete: function() {  $("body").removeClass("loading"); },
           success:function(response)
           {
                swal("Good job!", response.message, "success")
                console.log(response)
                // $(':input','#formmarineinsured')
                //     .not(':button, :submit, :reset, :hidden')
                //     .val('')
                //     .removeAttr('checked')
                //     .removeAttr('selected');

                // $("#marineslipform").attr("hidden", false);
                // $("#marineslipform :input").prop("disabled", false);
                // $('#slipmsinumber').val(msinumber);
                $("#addinsuredsave-btn").html('Update');
                window.location.href = "{{ url('transaction-data/updatemarinehullslip/')}}/"+btoa(response.id);
                // refreshTableSlip(msinumber)
           },
           error: function (request, status, error) {
                //alert(request.responseText);
                swal("Error!", error, "Insert Error");
           }
       });

   });
</script>

<script type='text/javascript'>

    $('#multi-file-upload-ajax').submit(function(e)
    {
        $(this).submit(function() {
            return false;
        });
       //alert('masuk');
       e.preventDefault();

       var code_ms = $('#mhnumber').val();
       var slipnumber = $('#slipnumber').val();
       var slipdatetransfer = $('#sliptd').val();
       var slipstatus = $('#slipstatus').val();
       
       var slipcedingbroker = $('#slipcedingbroker').val();
       var slipceding = $('#slipceding').val();
       // var slipcurrency = $('#slipcurrency').val();
       var slipcob = $('#slipcob').val();
       var slipkoc = $('#slipkoc').val();
       var slipno = $('#slipno').val();
       var slipcndn = $('#slipcndn').val();
       var slippolicy_no =  $('#slippolicy_no').val();
       var sliptotalsum = $('#sliptotalsum').val();
       var slipsharetotalsum = $('#sharetotalsum').val();
       var sliptypetotalsum = $('#sliptypetsi').val();
       var sliptypetsishare = $('#sharetypetsi').val();
       var sliptotalday = $('#slipdaytotal').val();
       var sliptotalyear = $('#slipdaytotal3').val();
       var slipdatesum = $('#sliptotalsumdate').val();

       var sliptype =  $('#sliptype').val();
       var slippct =  $('#slippct').val();
       var sliptotalsumpct =  $('#sliptotalsumpct').val();
       var slipipfrom =  $('#slipipfrom').val();
       var slipipto =  $('#slipipto').val();
       var sliprpfrom =  $('#sliprpfrom').val();
       var sliprpto =  $('#sliprpto').val();
       var proportional =  $('#switch-proportional').val();
       var sliplayerproportional =  $('#sliplayerproportional').val();
       // var sliprate =  $('#sliprate').val();
       // var sliptotalrate =  $('#tota').val();
       var slipvbroker =  $('#slipvbroker').val();
       var slipsumvbroker =  $('#slipsumfee').val();
       var slipshare =  $('#slipshare').val();
       var slipsumshare =  $('#slipsumshare').val();
       var slipbasicpremium =  $('#totalhullpremi').val();
       var slipgrossprmtonr =  $('#slipgrossprmtonr').val();
       var slipsumcommission =  $('#slipsumcommission').val();
       var slipcommission =  $('#slipcommission').val();
       var slipnetprmtonr =  $('#slipnetprmtonr').val();
       var sliprb =  $('#sliprb').val();
       var slipor =  $('#slipor').val();
       var slipsumor =  $('#slipsumor').val();
       var wpc =  $('#slipwpc').val();
       var remarks =  $('#slipremarks').val();
       var insuredshare = $('#mhsharefrom').val();
       var kurs = $('#mhkurs').val();
       var msicurrency = $('#mhcurrency').val();
       var sliptotalpercentrpor = $('#sliptotalpercentrpor').val();
       var retropercent = $('#retropercent').val();

       if(kurs) 
       {
       }
       else
       {
                $.ajax({
                    type:"GET",
                    url:"{{url('get-kurs-detail')}}?currency_id="+msicurrency,
                    success:function(res)
                    {  
                        //console.log(res)
                        //console.log('kurs ' + res.kurs)      
                        $('#mhkurs').val(res.kurs);
                        kurs=res.kurs;
                    }
                });
       }

       var currency = $( "#mhcurrency option:selected" ).text();
       var conv_curr = currency.substring(0,3);
       var token2 = $('input[name=_token]').val();

       var real_kurs = kurs.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

       console.log("slipipfrom date " + slipipfrom)
       var d=new Date(slipipfrom.split("/").reverse().join("-"));
       console.log('conv date' + d)
       var dd=d.getDate();
       console.log('conv date' + dd)
       var mm=d.getMonth()+1;
       console.log('conv date' + mm)
       var yy=d.getFullYear();
       console.log('conv date' + yy)
       var newslipipfrom=yy+"-"+mm+"-"+dd;
       console.log('slipipfrom ' + newslipipfrom)

       console.log("slipipto date " + slipipto)
       var d2=new Date(slipipto.split("/").reverse().join("-"));
       console.log('conv date' + d2)
       var dd2=d2.getDate();
       console.log('conv date' + dd2)
       var mm2=d2.getMonth()+1;
       console.log('conv date' + mm2)
       var yy2=d2.getFullYear();
       console.log('conv date' + yy2)
       var newslipipto=yy2+"-"+mm2+"-"+dd2;
       console.log('slipipto ' + newslipipto)

       console.log("sliprpfrom date " + sliprpfrom)
       var d3=new Date(sliprpfrom.split("/").reverse().join("-"));
       console.log('conv date' + d3)
       var dd3=d3.getDate();
       console.log('conv date' + dd3)
       var mm3=d3.getMonth()+1;
       console.log('conv date' + mm3)
       var yy3=d3.getFullYear();
       console.log('conv date' + yy3)
       var newsliprpfrom=yy3+"-"+mm3+"-"+dd3;
       console.log('sliprpfrom ' + newsliprpfrom)

       console.log("sliprpto date " + sliprpto)
       var d4=new Date(sliprpto.split("/").reverse().join("-"));
       console.log('conv date' + d4)
       var dd4=d4.getDate();
       console.log('conv date' + dd2)
       var mm4=d4.getMonth()+1;
       console.log('conv date' + mm4)
       var yy4=d4.getFullYear();
       console.log('conv date' + yy4)
       var newsliprpto=yy4+"-"+mm4+"-"+dd4;
       console.log('sliprpto ' + newsliprpto)


       var conv_sliptotalsum = sliptotalsum.replace(/,/g, "");
       console.log(code_ms)
       console.log(slipnumber)
       console.log(conv_sliptotalsum)
       var real_sliptotalsum = parseFloat(conv_sliptotalsum);
       console.log(real_sliptotalsum)

       var conv_sliptotalsumpct = sliptotalsumpct.replace(/,/g, "");
       console.log(conv_sliptotalsumpct)
       var real_sliptotalsumpct = parseFloat(conv_sliptotalsumpct);
       console.log(real_sliptotalsumpct)

       // var conv_slipsumrate = sliptotalrate.replace(/,/g, "");
       // console.log(conv_slipsumrate)
       // var real_slipsumrate = parseFloat(conv_slipsumrate);
       // console.log(real_slipsumrate)

       var conv_slipsumshare = slipsumshare.replace(/,/g, "");
       console.log(conv_slipsumshare)
       var real_slipsumshare = parseFloat(conv_slipsumshare);
       console.log(real_slipsumshare)

       var conv_slipbasicpremium = slipbasicpremium.replace(/,/g, "");
       console.log(conv_slipbasicpremium)
       var real_slipbasicpremium = parseFloat(conv_slipbasicpremium);
       console.log(real_slipbasicpremium)

       var conv_slipgrossprmtonr = slipgrossprmtonr.replace(/,/g, "");
       console.log(conv_slipgrossprmtonr)
       var real_slipgrossprmtonr = parseFloat(conv_slipgrossprmtonr);
       console.log(real_slipgrossprmtonr)

       var conv_slipsumcommission = slipsumcommission.replace(/,/g, "");
       console.log(conv_slipsumcommission)
       var real_slipsumcommission = parseFloat(conv_slipsumcommission);
       console.log(real_slipsumcommission)

       var conv_slipsumvbroker = slipsumvbroker.replace(/,/g, "");
       console.log(conv_slipsumvbroker)
       var real_slipsumvbroker = parseFloat(conv_slipsumvbroker);
       console.log(real_slipsumvbroker)

       var conv_slipnetprmtonr = slipnetprmtonr.replace(/,/g, "");
       console.log(conv_slipnetprmtonr)
       var real_slipnetprmtonr = parseFloat(conv_slipnetprmtonr);
       console.log(real_slipnetprmtonr)

       var conv_slipsumor = slipsumor.replace(/,/g, "");
       console.log(conv_slipsumor)
       var real_slipsumor = parseFloat(conv_slipsumor);
       console.log(real_slipsumor)

       var conv_slipsharetotalsum = slipsharetotalsum.replace(/,/g, "");
       console.log(conv_slipsharetotalsum)
       var real_slipsharetotalsum = parseFloat(conv_slipsharetotalsum);
       console.log(real_slipsharetotalsum)

       var conv_slipdatesum = slipdatesum.replace(/,/g, "");
       console.log(conv_slipdatesum)
       var real_slipdatesum = parseFloat(conv_slipdatesum);
       console.log(real_slipdatesum)

       var conv_insuredshare = insuredshare.replace(/,/g, "");
       console.log(conv_insuredshare)
       var real_insuredshare = parseFloat(conv_insuredshare);
       console.log(real_insuredshare)



       if(sliptotalsum == null || sliptotalsum == ""){
            sliptotalsum = "please check tsi";
       }else if(slipbasicpremium == null || slipbasicpremium == ""){
            slipbasicpremium = "please check basic premium";
       }else if(slipsumshare == null || slipsumshare == ""){
            slipsumshare = "please check nasionalre share ";
       }else if(slipgrossprmtonr == null || slipgrossprmtonr == ""){
            slipgrossprmtonr = "please check gross prm to nr";
       }else if(slipnetprmtonr == null || slipnetprmtonr == ""){
            slipnetprmtonr = "please check net prm to nr";
       }

       var hasil_kurs_tsi = (real_sliptotalsum * parseFloat(kurs));
       var hasil_kurs_basic_premium = (real_slipbasicpremium * parseFloat(kurs));
       var hasil_kurs_grossprmtonr = (real_slipgrossprmtonr * parseFloat(kurs));
       var hasil_kurs_netprmtonr = (real_slipnetprmtonr * parseFloat(kurs));

       var conv_hasil_kurs_tsi = hasil_kurs_tsi.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
       var conv_hasil_kurs_basic_premium = hasil_kurs_basic_premium.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
       var conv_hasil_kurs_grossprmtonr = hasil_kurs_grossprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
       var conv_hasil_kurs_netprmtonr = hasil_kurs_netprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

       var message = "please check this value again. <br>";
           message = message + conv_curr + " - " + real_kurs + " x tsi - " + sliptotalsum + " = "+ conv_hasil_kurs_tsi + "<br>";
           message = message + conv_curr + " - " + real_kurs + " x basic premium - " + slipbasicpremium + " = " + conv_hasil_kurs_basic_premium + "<br>";
           // message = message + conv_curr + " = " + real_kurs + " x nasionalre share = " + slipsumshare + "<br>";
           message = message + conv_curr + " - " + real_kurs + " x gross prm to nr - " + slipgrossprmtonr + " = " + conv_hasil_kurs_grossprmtonr + "<br>";
           message = message + conv_curr + " - " + real_kurs + " x net prm to nr - " + slipnetprmtonr + " = " + conv_hasil_kurs_netprmtonr + "<br>";


       var current_percent = $('#sliptotalpercentinspan').val();
       var current_amount = $('#sliptotalamountinspan').val();

       console.log('jumlah installment panel ' + current_percent)
       var current_percent_rp = $('#sliptotalpercentrpor').val();
       console.log('jumlah total or ' + current_percent_rp)

       var count_endorsement_ins = $('#fecountendorsement').val();
       console.log('count endorsement ' + count_endorsement_ins)
       
       swal({
            title: "Are you sure to submit this slip form?",
            html: message,
            type: "warning",
            customClass: 'swal-wide',  
            showCancelButton: true,
            showConfirmButton:true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Ok",
            closeOnConfirm: true,
            focusConfirm:true
        }).then(result =>{
            console.log(result)
            if (result.value)
            {
                if(count_endorsement_ins != '' || count_endorsement_ins != null)
                {
                    if(parseFloat(sliptotalpercentrpor) <100 )
                    {
                        swal("Warning!","Please fill retrocession panel until 100%","warning");
                        return;
                    }
                    
                    if(parseFloat(current_percent) == 100.00){
                        var jumlah_tgl = $('#slipdaytotal').val();
                            console.log('jumlah_tgl '+jumlah_tgl)
                            if(parseInt(jumlah_tgl) > 0){
                                var type_tsi = $('#sliptypetsi').val();
                                var tsislipval = $('#sliptotalsum').val();
                                var conv_tsislipval = tsislipval.replace(/,/g, "");
                                var int_tsislipval = parseInt(conv_tsiinsval);
                                var int_fullslip = parseInt(int_tsislipval);

                                var tsiinsval = $('#mhshareto').val();
                                var conv_tsiinsval = tsiinsval.replace(/,/g, "");
                                var int_tsiinsval = parseFloat(conv_tsiinsval);
                                var int_fullins = int_tsiinsval;
                                var new_instsi = int_fullins.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                                var cedshareins = $('#mhshare').val();
                                var conv_cedshareins = cedshareins.replace(/,/g, "");
                                var int_cedshareins = parseFloat(conv_cedshareins);
                                var int_fullcedshare = int_cedshareins;
                                var new_cedshareins = int_fullcedshare.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                                console.log('type_tsi'+ type_tsi)
                                console.log('tsislipval'+ tsislipval)
                                console.log('tsiinsval'+ tsiinsval)
                                console.log('cedshareins'+ cedshareins)

                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                });

                                            $.ajax({
                                                url:"{{url('transaction-data/marine-hull-slip/store')}}",
                                                type:"POST",
                                                data:{

                                                    //sliped:sliped,
                                                    //slipsls:slipsls,
                                                    code_ms:code_ms,
                                                    slipnumber:slipnumber,
                                                    slipdatetransfer:slipdatetransfer,
                                                    slipstatus:slipstatus,
                                                    slipcedingbroker:slipcedingbroker,
                                                    slipceding:slipceding,
                                                    // slipcurrency:slipcurrency,
                                                    slipcob:slipcob,
                                                    slipkoc:slipkoc,
                                                    slipno:slipno,
                                                    slipcndn:slipcndn,
                                                    slippolicy_no:slippolicy_no,
                                                    sliptotalsum:real_sliptotalsum,
                                                    sliptype:sliptype,
                                                    slippct:slippct,
                                                    sliptotalsumpct:real_sliptotalsumpct,
                                                    slipipfrom:newslipipfrom,
                                                    slipipto:newslipipto,
                                                    sliprpfrom:newsliprpfrom,
                                                    sliprpto:newsliprpto,
                                                    proportional:proportional,
                                                    sliplayerproportional:sliplayerproportional,
                                                    // sliprate:sliprate,
                                                    // sliptotalrate:real_slipsumrate,
                                                    slipvbroker:slipvbroker,
                                                    slipsumvbroker:real_slipsumvbroker,
                                                    slipshare:slipshare,
                                                    slipsumshare:real_slipsumshare,
                                                    slipbasicpremium:real_slipbasicpremium,
                                                    slipgrossprmtonr:real_slipgrossprmtonr,
                                                    slipcommission:slipcommission,
                                                    slipsumcommission:real_slipsumcommission,
                                                    slipnetprmtonr:real_slipnetprmtonr,
                                                    sliprb:sliprb,
                                                    slipor:slipor,
                                                    slipsumor:real_slipsumor,
                                                    slipsharetotalsum:real_slipsharetotalsum,
                                                    sliptypetotalsum:sliptypetotalsum,
                                                    sliptypetsishare:sliptypetsishare,
                                                    sliptotalday:sliptotalday,
                                                    sliptotalyear:sliptotalyear,
                                                    slipdatesum:real_slipdatesum,
                                                    insured_share:real_insuredshare,
                                                    wpc:wpc,
                                                    remarks:remarks
                                                },
                                                beforeSend: function() { $("body").addClass("loading");  },
                                                complete: function() {  $("body").removeClass("loading"); },
                                                success:function(response){
                                                    swal("Success!", "Marine Hull Slip Insert Success", "success")


                                                    refreshTableSlip(code_ms)

                                                        

                                                    $('#slipnumber').val(response.slipnumber);
                                                    // $('#feshare').val(response.ourshare);
                                                    // $('#fesharefrom').val(response.sumshare);
                                                    $('#installmentPanel tbody').empty();
                                                    $('#ExtendCoveragePanel tbody').empty();
                                                    $('#deductiblePanel tbody').empty();
                                                    $('#retrocessionPanel tbody').empty();
                                                    $('#addinstallmentinsured-btn').attr('hidden','false');
                                                    $('#addinstallmentinsured-btn').removeAttr('hidden');

                                                    $('#sliptotalnilaiec').val('');
                                                    $('#sliptotalpercentinspan').val('');

                                                },
                                                error: function (request, status, error) {
                                                        //alert(request.responseText);
                                                        swal("Error!", "Marine Hull Slip Insert Error : " + request.responseText, "Insert Error");
                                                    }
                                            });



                                            // var formData = new FormData(this);
                                            // let TotalFiles = $('#attachment')[0].files.length; //Total files
                                            // let files = $('#attachment')[0];
                                            // var slip_id = $('#slipnumber').val();
                                            // var insured_id = $('#mhnumber').val();

                                            // if(TotalFiles > 0){
                                            //     for (let i = 0; i < TotalFiles; i++){
                                            //         formData.append('files' + i, files.files[i]);
                                            //     }

                                            //     formData.append('TotalFiles', TotalFiles);
                                            //     formData.append('slip_id', slip_id);
                                            //     formData.append('insured_id', insured_id);
                                            //     formData.append('slip_type', 'mh');

                                            //     $.ajax({
                                            //         type:'POST',
                                            //         url: "{{ url('store-multi-file-ajax')}}",
                                            //         data: formData,
                                            //         cache:false,
                                            //         contentType: false,
                                            //         processData: false,
                                            //         dataType: 'json',
                                            //         success: (data) => {
                                            //                     //this.reset();
                                            //                     //alert('Files has been uploaded using jQuery ajax');
                                            //                     swal("Success!", "Files has been uploaded", "success")
                                            //                 },
                                            //                 error: function(data){
                                            //                     //alert(data.responseJSON.errors.files[0]);
                                            //                     //swal("Error!", data.responseJSON.errors.files[0], "Insert Error");
                                            //                     //console.log(data.responseJSON.errors);
                                            //                 }
                                            //             });

                                            // }

                                            
                                                
                                    
                                
                            }else{
                                swal('Warning!','please check date insurance/reinsurance periode cannot minus','insert error');
                            }
                    }
                    else
                    {
                        swal("Error!", "Please input installment panel until 100%", "Insert Error");
                    }


                    
                }else{
                    swal("Error!", "Please Save Insured First", "Insert Error");
                }

            
          }  
        });

        return true;
    });



</script>

<script type="text/javascript">

    function detailslip(id)
    {
            if(id){
                alert(id);
                swal("Please wait!", "Loading Data")
                    $.ajax({
                        type:"GET",
                        dataType: 'json',
                        url:'{{ url("/") }}/transaction-data/getmodal-marine-slip/'+id,
                        beforeSend: function() { $("body").addClass("loading");  },
                        complete: function() {  $("body").removeClass("loading"); },
                        success:function(response){  
                            console.log(response)      
                            if(response){
                                
                                var status_log = response.status_log;
                                for (var i = 0; i < status_log.length; i++){
                                    var status = status_log[i].status;
                                    var datetime = status_log[i].datetime;
                                    var user = status_log[i].user;
                                    $('#slipStatusTabledetail tbody').append('<tr id="stlid'+status_log[i].id+'" data-name="slipvalue[]"><td >'+status+'</td><td >'+datetime+'</td><td >'+user+'</td></tr>')
                                };
                                var interest_insured = response.interestinsured;
                                for (var i = 0; i < interest_insured.length; i++){
                                    var interest = interest_insured[i].description;
                                    var code = interest_insured[i].code;
                                    var amount = interest_insured[i].amount;
                                    $('#interestInsuredTabledetail tbody').append('<tr id="itsid'+interest_insured[i].id+'"><td >'+code+' - '+interest+'</td><td >currency('+amount+')</td></tr>')
                                };
                                var attachment = response.attachment;
                                for (var i = 0; i < attachment.length; i++){
                                    var filename = attachment[i].filename;
                                    $('#aidlistdetail').append('<li><div class="control-group input-group" id="control-group2" style="margin-top:10px"><a href="{{ asset("files")}}/'+filename+'">'+filename+'</a></div></li>')
                                };
                                var deductible = response.deductible;
                                for (var i = 0; i < deductible.length; i++){
                                    var currency_code = deductible[i].code;
                                    var currency = deductible[i].symbol_name;
                                    var abbreviation = deductible[i].abbreviation;
                                    var description = deductible[i].description;
                                    var percentage = deductible[i].percentage;
                                    var amount = deductible[i].amount;
                                    var min_claimamount = deductible[i].min_claimamount;
                                    $('#deductiblePaneldetail tbody').append('<tr id="dbtid'+deductible[i].id+'"><td >'+abbreviation+' - '+description+'</td><td >'+currency_code+'-'+currency+'</td><td>'+percentage+'</td><td>currency('+amount+')</td><td>currency('+min_claimamount+')</td></tr>')
                                };
                                var condition_needed = response.condition_needed;
                                for (var i = 0; i < condition_needed.length; i++){
                                    var description = condition_needed[i].description;
                                    var code = condition_needed[i].code;
                                    var name = condition_needed[i].name;
                                    var information = condition_needed[i].information;
                                    $('#conditionNeededdetail tbody').append('<tr id="cntid'+condition_needed[i].id+'" ><td >'+code+' - '+name+' - '+description+'</td><td >'+information+'</td></tr>')
                                };
                                var installment_panel = response.installment_panel;
                                for (var i = 0; i < installment_panel.length; i++){
                                    var date = installment_panel[i].installment_date;
                                    var percentage = installment_panel[i].percentage;
                                    var amount = installment_panel[i].amount;
                                    $('#installmentPaneldetail tbody').append('<tr id="isptid'+installment_panel[i].id+'" ><td >'+date+'</td><td >'+percentage+'</td><td >currency('+amount+')</td></tr>')
                                };
                                var retrocession = response.retrocession;
                                for (var i = 0; i < retrocession.length; i++){
                                    var type = retrocession[i].type;
                                    var contract = retrocession[i].contract;
                                    var percentage = retrocession[i].percentage;
                                    var amount = retrocession[i].amount;
                                    $('#retrocessionPaneldetail tbody').append('<tr id="rcstid'+retrocession[i].id+'" ><td >'+type+'</td><td >'+contract+'</td><td >'+floatToString(parseFloat(percentage).toFixed(2))+'</td><td >currency('+floatToString(parseFloat(amount).toFixed(2))+')</td></tr>')
                                };

                                $("#slipnumberdetail").val(response.slip_number);
                                $("#slipusernamedetail").val(response.username);
                                $("#slipprodyeardetail").val(response.prod_year);
                                $("#slipuydetail").val(response.uy);
                                $("#slipstatusdetail").append('<option value="'+response.status+'" selected>'+response.status+'</option>');
                                $('#slipcedingbrokerdetail').append(' <option value="'+response.cedbrok_id+'" selected>'+response.cedbrok_cn+' - '+response.cedbrok_code+' - '+response.cedbrok+'</option>');
                                $('#slipcedingdetail').append(' <option value="'+response.ceding_id+'" selected>'+response.ceding_cn+' - '+response.ceding_code+' - '+response.ceding+'</option>');
                                $('#slipcurrencydetail').append('<option value="'+response.currency_id+'"selected>'+response.currency_code+' - '+response.currency+'</option>');
                                $('#slipcobdetail').append('<option value="'+response.cob_id+'"selected>'+response.cob+'</option>');
                                $('#slipkocdetail').append('<option value="'+response.koc_id+'"selected>'+response.koc+'</option>');
                                //$('#slipoccupacydetail').append('<option value="'+response.occupacy_id+'"selected>'+response.occupacy+'</option>');
                                $('#slipbld_constdetail').append('<option value="'+response.build_const+'"selected>'+response.build_const+'</option>');
                                $('#sliptypedetail').append('<option value="'+response.insured_type+'"selected>'+response.insured_type+'</option>');
                                $('#sliplayerproportionaldetail').append('<option value="'+response.layer_non_proportional+'"selected>'+response.layer_non_proportional+'</option>');
                                $('#sliprbdetail').append('<option value="'+response.retro_backup+'"selected>'+response.retro_backup+'</option>');
                                if(response.retro_backup == 'NO'){
                                    $("#tabretrodetail").attr('hidden','true');
                                }

                                $('#slipnodetail').val(response.slip_no);
                                $('#slipcndndetail').val(response.cn_dn);
                                $('#slippolicy_nodetail').val(response.policy_no);
                                $('#slipcoinsurancedetail').val(response.coinsurance_slip);
                                $('#sliptotalsumdetail').val(response.total_sum_insured);
                                $('#slippctdetail').val(response.insured_Pct);
                                $('#sliptotalsumpctdetail').val(response.total_sum_pct);
                                $('#slipipfromdetail').val(response.insurance_period_from);
                                $('#slipiptodetail').val(response.insurance_period_to);
                                $('#sliprpfromdetail').val(response.reinsurance_period_from);
                                $('#sliprptodetail').val(response.reinsurance_period_to);
                                $('#switch-proportionaldetail').val(response.proportional);
                                if(response.proportional == null){
                                    $("#btnaddlayerdetail").attr('hidden','true');
                                    $("#sliplayerproportionaldetail").attr('hidden','true');
                                    $("#labelnonpropdetail").attr('hidden','true');
                                    $("#labelnpdetail").attr('hidden','true');
                                }
                                $('#slipratedetail').val(response.rate);
                                $('#slipsharedetail').val(response.share);
                                $('#slipsumsharedetail').val(response.sum_share);
                                $('#slipbasicpremiumdetail').val(response.basic_premium);
                                $('#slipgrossprmtonrdetail').val(response.grossprm_to_nr);
                                $('#slipcommissiondetail').val(response.commission);
                                $('#slipsumcommissiondetail').val(response.sum_commission);
                                $('#slipnetprmtonrdetail').val(response.netprm_to_nr);
                                $('#slipordetail').val(response.own_retention);
                                $('#slipsumordetail').val(response.sum_own_retention);
                                swal("Good job!", "Data Show", "success")
                            }else{
                                swal("Ohh no!", "Data failed to get", "failed")
                            }
                        }
                    });
                }else{
                    swal("Ohh no!", "Current object failed to get", "failed")
                }
        }

        function editslip(id)
        {
            if(id){
                alert(id);
                swal("Please wait!", "Loading Data")
                    $.ajax({
                        type:"GET",
                        dataType: 'json',
                        url:'{{ url("/") }}/transaction-data/getmodal-marine-slip/'+id,
                        beforeSend: function() { $("body").addClass("loading");  },
                        complete: function() {  $("body").removeClass("loading"); },
                        success:function(response){  
                            console.log(response)      
                            if(response){
                                
                                var status_log = response.status_log;
                                for (var i = 0; i < status_log.length; i++){
                                    var status = status_log[i].status;
                                    var datetime = status_log[i].datetime;
                                    var user = status_log[i].user;
                                    $('#slipStatusTableupdate tbody').append('<tr id="stlid'+status_log[i].id+'" data-name="slipvalue[]"><td >'+status+'</td><td >'+datetime+'</td><td >'+user+'</td></tr>')
                                };
                                var interest_insured = response.interestinsured;
                                for (var i = 0; i < interest_insured.length; i++){
                                    var interest = interest_insured[i].description;
                                    var code = interest_insured[i].code;
                                    var amount = interest_insured[i].amount;
                                    $('#interestInsuredTableupdate tbody').append('<tr id="itsid'+interest_insured[i].id+'"><td >'+code+' - '+interest+'</td><td >currency('+amount+')</td></tr>')
                                };
                                var attachment = response.attachment;
                                for (var i = 0; i < attachment.length; i++){
                                    var filename = attachment[i].filename;
                                    $('#aidlistupdate').append('<li><div class="control-group input-group" id="control-group2" style="margin-top:10px"><a href="{{ asset("files")}}/'+filename+'">'+filename+'</a></div></li>')
                                };
                                var deductible = response.deductible;
                                for (var i = 0; i < deductible.length; i++){
                                    var currency_code = deductible[i].code;
                                    var currency = deductible[i].symbol_name;
                                    var abbreviation = deductible[i].abbreviation;
                                    var description = deductible[i].description;
                                    var percentage = deductible[i].percentage;
                                    var amount = deductible[i].amount;
                                    var min_claimamount = deductible[i].min_claimamount;
                                    $('#deductiblePanelupdate tbody').append('<tr id="dbtid'+deductible[i].id+'"><td >'+abbreviation+' - '+description+'</td><td >'+currency_code+'-'+currency+'</td><td>'+percentage+'</td><td>currency('+amount+')</td><td>currency('+min_claimamount+')</td></tr>')
                                };
                                var condition_needed = response.condition_needed;
                                for (var i = 0; i < condition_needed.length; i++){
                                    var description = condition_needed[i].description;
                                    var code = condition_needed[i].code;
                                    var name = condition_needed[i].name;
                                    var information = condition_needed[i].information;
                                    $('#conditionNeededupdate tbody').append('<tr id="cntid'+condition_needed[i].id+'" ><td >'+code+' - '+name+' - '+description+'</td><td >'+information+'</td></tr>')
                                };
                                
                                var installment_panel = response.installment_panel;
                                for (var i = 0; i < installment_panel.length; i++){
                                    var date = installment_panel[i].installment_date;
                                    var percentage = installment_panel[i].percentage;
                                    var amount = installment_panel[i].amount;
                                    $('#installmentPanelupdate tbody').append('<tr id="isptid'+installment_panel[i].id+'" ><td >'+date+'</td><td >'+percentage+'</td><td >currency('+amount+')</td></tr>')
                                };
                                
                                var retrocession = response.retrocession;
                                for (var i = 0; i < retrocession.length; i++){
                                    var type = retrocession[i].type;
                                    var contract = retrocession[i].contract;
                                    var percentage = retrocession[i].percentage;
                                    var amount = retrocession[i].amount;
                                    $('#retrocessionPanelupdate tbody').append('<tr id="rcstid'+retrocession[i].id+'" ><td >'+type+'</td><td >'+contract+'</td><td >'+percentage+'</td><td >currency('+amount+')</td></tr>')
                                };

                                $("#slipnumberupdate").val(response.slip_number);
                                $("#slipusernameupdate").val(response.username);
                                $("#slipprodyearupdate").val(response.prod_year);
                                $("#slipuyupdate").val(response.uy);
                                $("#slipstatusupdate").append('<option value="'+response.status+'" selected>'+response.status+' - current choice</option>');
                                $('#slipcedingbrokerupdate').append(' <option value="'+response.cedbrok_id+'" selected>'+response.cedbrok_cn+' - '+response.cedbrok_code+' - '+response.cedbrok+' - current choice</option>');
                                $('#slipcedingupdate').append(' <option value="'+response.ceding_id+'" selected>'+response.ceding_cn+' - '+response.ceding_code+' - '+response.ceding+' - current choice</option>');
                                $('#slipcurrencyupdate').append('<option value="'+response.currency_id+'"selected>'+response.currency_code+' - '+response.currency+' - current choice</option>');
                                $('#slipcobupdate').append('<option value="'+response.cob_id+'"selected>'+response.cob_code+' - '+response.cob+' - current choice</option>');
                                $('#slipkocupdate').append('<option value="'+response.koc_id+'"selected>'+response.koc_code+' - '+response.koc+' - current choice</option>');
                                //$('#slipoccupacyupdate').append('<option value="'+response.occupacy_id+'"selected>'+response.occupacy_code+' - '+response.occupacy+' - current choice</option>');
                                $('#slipbld_constupdate').append('<option value="'+response.build_const+'"selected>'+response.build_const+' - current choice</option>');
                                $('#sliptypeupdate').append('<option value="'+response.insured_type+'"selected>'+response.insured_type+' - current choice</option>');
                                $('#sliplayerproportionalupdate').append('<option value="'+response.layer_non_proportional+'"selected>'+response.layer_non_proportional+' - current choice</option>');
                                $('#sliprbupdate').append('<option value="'+response.retro_backup+'"selected>'+response.retro_backup+' - current choice</option>');
                                if(response.retro_backup == 'NO'){
                                    $("#tabretroupdate").attr('hidden','true');
                                }

                                $('#slipnoupdate').val(response.slip_no);
                                $('#slipcndnupdate').val(response.cn_dn);
                                $('#slippolicy_noupdate').val(response.policy_no);
                                $('#slipcoinsuranceupdate').val(response.coinsurance_slip);
                                $('#sliptotalsumupdate').val(response.total_sum_insured);
                                $('#slippctupdate').val(response.insured_Pct);
                                $('#sliptotalsumpctupdate').val(response.total_sum_pct);
                                $('#slipipfromupdate').val(response.insurance_period_from);
                                $('#slipiptoupdate').val(response.insurance_period_to);
                                $('#sliprpfromupdate').val(response.reinsurance_period_from);
                                $('#sliprptoupdate').val(response.reinsurance_period_to);
                                $('#switch-proportionalupdate').val(response.proportional);
                                if(response.proportional == null){
                                    $("#btnaddlayerupdate").attr('hidden','true');
                                    $("#sliplayerproportionalupdate").attr('hidden','true');
                                    $("#labelnonpropupdate").attr('hidden','true');
                                    $("#labelnpupdate").attr('hidden','true');
                                }
                                $('#sliprateupdate').val(response.rate);
                                $('#slipshareupdate').val(response.share);
                                $('#slipsumshareupdate').val(response.sum_share);
                                $('#slipbasicpremiumupdate').val(response.basic_premium);
                                $('#slipgrossprmtonrupdate').val(response.grossprm_to_nr);
                                $('#slipcommissionupdate').val(response.commission);
                                $('#slipsumcommissionupdate').val(response.sum_commission);
                                $('#slipnetprmtonrupdate').val(response.netprm_to_nr);
                                $('#sliporupdate').val(response.own_retention);
                                $('#slipsumorupdate').val(response.sum_own_retention);
                                swal("Good job!", "Data Show", "success")
                            }else{
                                swal("Ohh no!", "Data failed to get", "failed")
                            }
                        }
                    });
                }else{
                    swal("Ohh no!", "Current object failed to get", "failed")
                }
        }

        function endorsementslip(id)
        {
            if(id){
                alert(id);
                swal("Please wait!", "Loading Data")
                    $.ajax({
                        type:"GET",
                        dataType: 'json',
                        url:'{{ url("/") }}/transaction-data/getmodal-marine-slip/'+id,
                        beforeSend: function() { $("body").addClass("loading");  },
                        complete: function() {  $("body").removeClass("loading"); },
                        success:function(response){  
                            console.log(response)      
                            if(response){
                                
                                var status_log = response.status_log;
                                for (var i = 0; i < status_log.length; i++){
                                    var status = status_log[i].status;
                                    var datetime = status_log[i].datetime;
                                    var user = status_log[i].user;
                                    $('#slipStatusTableendorsement tbody').append('<tr id="stlid'+status_log[i].id+'" data-name="slipvalue[]"><td >'+status+'</td><td >'+datetime+'</td><td >'+user+'</td></tr>')
                                };
                                var interest_insured = response.interestinsured;
                                for (var i = 0; i < interest_insured.length; i++){
                                    var interest = interest_insured[i].description;
                                    var code = interest_insured[i].code;
                                    var amount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(interest_insured[i].amount);
                                    $('#interestInsuredTableendorsement tbody').append('<tr id="itsid'+interest_insured[i].id+'"><td >'+code+' - '+interest+'</td><td >'+amount+'</td></tr>')
                                };
                                var attachment = response.attachment;
                                for (var i = 0; i < attachment.length; i++){
                                    var filename = attachment[i].filename;
                                    $('#aidlistendorsement').append('<li><div class="control-group input-group" id="control-group2" style="margin-top:10px"><a href="{{ asset("files")}}/'+filename+'">'+filename+'</a></div></li>')
                                };
                                var deductible = response.deductible;
                                for (var i = 0; i < deductible.length; i++){
                                    var currency_code = deductible[i].code;
                                    var currency = deductible[i].symbol_name;
                                    var abbreviation = deductible[i].abbreviation;
                                    var description = deductible[i].description;
                                    var percentage = deductible[i].percentage;
                                    var amount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(deductible[i].amount);
                                    var min_claimamount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(deductible[i].min_claimamount);
                                    $('#deductiblePanelendorsement tbody').append('<tr id="dbtid'+deductible[i].id+'"><td >'+abbreviation+' - '+description+'</td><td >'+currency_code+'-'+currency+'</td><td>'+percentage+'</td><td>'+amount+'</td><td>'+min_claimamount+'</td></tr>')
                                };
                                var condition_needed = response.condition_needed;
                                for (var i = 0; i < condition_needed.length; i++){
                                    var description = condition_needed[i].description;
                                    var code = condition_needed[i].code;
                                    var name = condition_needed[i].name;
                                    var information = condition_needed[i].information;
                                    $('#conditionNeededendorsement tbody').append('<tr id="cntid'+condition_needed[i].id+'" ><td >'+code+' - '+name+' - '+description+'</td><td >'+information+'</td></tr>')
                                };
                                var installment_panel = response.installment_panel;
                                for (var i = 0; i < installment_panel.length; i++){
                                    var date = installment_panel[i].installment_date;
                                    var percentage = installment_panel[i].percentage;
                                    var amount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(installment_panel[i].amount);
                                    $('#installmentPanelendorsement tbody').append('<tr id="isptid'+installment_panel[i].id+'" ><td >'+date+'</td><td >'+percentage+'</td><td >'+amount+'</td></tr>')
                                };
                                var retrocession = response.retrocession;
                                for (var i = 0; i < retrocession.length; i++){
                                    var type = retrocession[i].type;
                                    var contract = retrocession[i].contract;
                                    var percentage = retrocession[i].percentage;
                                    var amount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(retrocession[i].amount);
                                    $('#retrocessionPanelendorsement tbody').append('<tr id="rcstid'+retrocession[i].id+'" ><td >'+type+'</td><td >'+contract+'</td><td >'+percentage+'</td><td >'+amount+'</td></tr>')
                                };

                                $("#slipnumberendorsement").val(response.slip_number);
                                $("#msinumberendorsement").val(response.insured_id);
                                $("#slipusernameendorsement").val(response.username);
                                $("#slipprodyearendorsement").val(response.prod_year);
                                $("#slipuyendorsement").val(response.uy);
                                $("#slipstatusendorsement").append('<option value="'+response.status+'" selected>'+response.status+'- current choice</option>');
                                $('#slipcedingbrokerendorsement').append(' <option value="'+response.cedbrok_id+'" selected>'+response.cedbrok_cn+' - '+response.cedbrok_code+' - '+response.cedbrok+'- current choice</option>');
                                $('#slipcedingendorsement').append(' <option value="'+response.ceding_id+'" selected>'+response.ceding_cn+' - '+response.ceding_code+' - '+response.ceding+'- current choice</option>');
                                $('#slipcurrencyendorsement').append('<option value="'+response.currency_id+'"selected>'+response.currency_code+' - '+response.currency+'- current choice</option>');
                                $('#slipcobendorsement').append('<option value="'+response.cob_id+'"selected>'+response.cob_code+' - '+response.cob+'- current choice</option>');
                                $('#slipkocendorsement').append('<option value="'+response.koc_id+'"selected>'+response.koc_code+' - '+response.koc+'- current choice</option>');
                                //$('#slipoccupacyendorsement').append('<option value="'+response.occupacy_id+'"selected>'+response.occupacy_code+' - '+response.occupacy+'- current choice</option>');
                                $('#slipbld_constendorsement').append('<option value="'+response.build_const+'"selected>'+response.build_const+'- current choice</option>');
                                $('#sliptypeendorsement').append('<option value="'+response.insured_type+'"selected>'+response.insured_type+'- current choice</option>');
                                $('#sliplayerproportionalendorsement').append('<option value="'+response.layer_non_proportional+'"selected>'+response.layer_non_proportional+'- current choice</option>');
                                $('#sliprbendorsement').append('<option value="'+response.retro_backup+'"selected>'+response.retro_backup+'- current choice</option>');
                                // if(response.retro_backup == 'NO'){
                                //     $("#tabretroendorsement").attr('hidden','true');
                                // }

                                $('#slipnoendorsement').val(response.slip_no);
                                $('#slipcndnendorsement').val(response.cn_dn);
                                $('#slippolicy_noendorsement').val(response.policy_no);
                                $('#slipcoinsuranceendorsement').val(response.coinsurance_slip);
                                $('#sliptotalsumendorsement').val(response.total_sum_insured);
                                $('#slippctendorsement').val(response.insured_pct);
                                $('#sliptotalsumpctendorsement').val(response.total_sum_pct);
                                $('#slipipfromendorsement').val(response.insurance_period_from);
                                $('#slipiptoendorsement').val(response.insurance_period_to);
                                $('#sliprpfromendorsement').val(response.reinsurance_period_from);
                                $('#sliprptoendorsement').val(response.reinsurance_period_to);
                                $('#switch-proportionalendorsement').val(response.proportional);
                                if(response.proportional == null){
                                    $("#btnaddlayerendorsement").attr('hidden','true');
                                    $("#sliplayerproportionalendorsement").attr('hidden','true');
                                    $("#labelnonpropendorsement").attr('hidden','true');
                                    $("#labelnpendorsement").attr('hidden','true');
                                }
                                $('#sliprateendorsement').val(response.rate);
                                $('#slipshareendorsement').val(response.share);
                                $('#slipsumshareendorsement').val(response.sum_share);
                                $('#slipbasicpremiumendorsement').val(response.basic_premium);
                                $('#slipgrossprmtonrendorsement').val(response.grossprm_to_nr);
                                $('#slipcommissionendorsement').val(response.commission);
                                $('#slipsumcommissionendorsement').val(response.sum_commission);
                                $('#slipnetprmtonrendorsement').val(response.netprm_to_nr);
                                $('#sliporendorsement').val(response.own_retention);
                                $('#slipsumorendorsement').val(response.sum_own_retention);
                                swal("Good job!", "Data Show", "success")
                            }else{
                                swal("Ohh no!", "Data failed to get", "failed")
                            }
                        }
                    });
                }else{
                    swal("Ohh no!", "Current object failed to get", "failed")
                }
        }
</script>

<script type='text/javascript'>
    $('#multi-file-upload-ajaxupdate').submit(function(e){
       // alert('masuk ' + $('#insuredIDtxt').val() + ' ' + $('#slipnumberupdate').val()) ;
       e.preventDefault();


       var code_ms = $('#mhnumber').val();
       var slipnumber = $('#slipnumberupdate').val();
       var slipdatetransfer = $('#sliptdupdate').val();
       var slipstatus = $('#slipstatusupdate').val();
       var sliped = $('#slipedupdate').val();
       var slipsls = $('#slipslsupdate').val();
       var slipcedingbroker = $('#slipcedingbrokerupdate').val();
       var slipceding = $('#slipcedingupdate').val();
       // var slipcurrency = $('#slipcurrencyupdate').val();
       var slipcob = $('#slipcobupdate').val();
       var slipkoc = $('#slipkocupdate').val();
       //var slipoccupacy = $('#slipoccupacyupdate').val();
       var slipbld_const = $('#slipbld_constupdate').val();
       var slipno = $('#slipnoupdate').val();
       var slipcndn = $('#slipcndnupdate').val();
       var slippolicy_no = $('#slippolicy_noupdate').val();
       var sliptypetsi = $('#sliptypetsiupdate').val();
       var sliptotalsum = $('#sliptotalsumupdate').val();
       var sharetypetsi = $('#sharetypetsiupdate').val();
       var sharetotalsum = $('#sharetotalsumupdate').val();
       var sliptype =  $('#sliptypeupdate').val();
       var slippct =  $('#slippctupdate').val();
       var sliptotalsumpct =  $('#sliptotalsumpctupdate').val();
       var slipipfrom =  $('#slipipfromupdate').val();
       var slipipto =  $('#slipiptoupdate').val();
       var sliprpfrom =  $('#sliprpfromupdate').val();
       var sliprpto =  $('#sliprptoupdate').val();
       var proportional =  $('#switch-proportionalupdate').val();
       var sliplayerproportional =  $('#sliplayerproportionalupdate').val();
       //var sliprate =  $('#sliprateupdate').val();
       //var slipsumrate =  $('#sliptotalrateupdate').val();
       var slipvbroker =  $('#slipvbrokerupdate').val();
       var slipsumvbroker =  $('#slipsumfeeupdate').val();
       var slipshare =  $('#slipshareupdate').val();
       var slipsumshare =  $('#slipsumshareupdate').val();
       var slipoldsumshare =  $('#slipoldsumshareupdate').val();
       
       var slipbasicpremium =  $('#totalhullpremiupdate').val();

       var slipgrossprmtonr =  $('#slipgrossprmtonrupdate').val();
       var slipsumcommission =  $('#slipsumcommissionupdate').val();
       var slipcommission =  $('#slipcommissionupdate').val();
       var slipnetprmtonr =  $('#slipnetprmtonrupdate').val();
       var sliprb =  $('#sliprbupdate').val();
       var slipor =  $('#sliporupdate').val();
       var slipsumor =  $('#slipsumorupdate').val();
       
       var wpc =  $('#wpcupdate').val();
       var remarks =  $('#remarksupdate').val();
       var insuredshare = $('#mhsharefrom').val();
       var kurs = $('#mhkurs').val();
       var currency = $( "#mhcurrency option:selected" ).text();
       var conv_curr = currency.substring(0,3);
       var sliptotalday = $('#slipdaytotalupdate').val();
       var sliptotalyear = $('#slipdaytotalupdate3').val();
       var sliptotaldatesum = $('#sliptotalsumdateupdate').val();
       var countendorsement = $('#countendorsmentupdate').val();

       var token2 = $('input[name=_token]').val();

       var conv_sliptotalsum = sliptotalsum.replace(/,/g, "");
       console.log(conv_sliptotalsum)
       var real_sliptotalsum = parseFloat(conv_sliptotalsum);
       console.log(real_sliptotalsum)

       var conv_sharetotalsum = sharetotalsum.replace(/,/g, "");
       console.log(conv_sharetotalsum)
       var real_sharetotalsum = parseFloat(conv_sharetotalsum);
       console.log(real_sharetotalsum)
       
       var conv_sliptotalsumpct = sliptotalsumpct.replace(/,/g, "");
       console.log(conv_sliptotalsumpct)
       var real_sliptotalsumpct = parseFloat(conv_sliptotalsumpct);
       console.log(real_sliptotalsumpct)

       var conv_slipsumshare = slipsumshare.replace(/,/g, "");
       console.log(conv_slipsumshare)
       var real_slipsumshare = parseFloat(conv_slipsumshare);
       console.log(real_slipsumshare)

       //var conv_slipsumrate = slipsumrate.replace(/,/g, "");
       //console.log(conv_slipsumrate)
       //var real_slipsumrate = parseFloat(conv_slipsumrate);
       //console.log(real_slipsumrate)

       var conv_slipbasicpremium = slipbasicpremium.replace(/,/g, "");
       console.log(conv_slipbasicpremium)
       var real_slipbasicpremium = parseFloat(conv_slipbasicpremium);
       console.log(real_slipbasicpremium)

       var conv_slipsumvbroker = slipsumvbroker.replace(/,/g, "");
       console.log(conv_slipsumvbroker)
       var real_slipsumvbroker = parseFloat(conv_slipsumvbroker);
       console.log(real_slipsumvbroker)

       var conv_slipgrossprmtonr = slipgrossprmtonr.replace(/,/g, "");
       console.log(conv_slipgrossprmtonr)
       var real_slipgrossprmtonr = parseFloat(conv_slipgrossprmtonr);
       console.log(real_slipgrossprmtonr)

       var conv_slipsumcommission = slipsumcommission.replace(/,/g, "");
       console.log(conv_slipsumcommission)
       var real_slipsumcommission = parseFloat(conv_slipsumcommission);
       console.log(real_slipsumcommission)

       var conv_slipnetprmtonr = slipnetprmtonr.replace(/,/g, "");
       console.log(conv_slipnetprmtonr)
       var real_slipnetprmtonr = parseFloat(conv_slipnetprmtonr);
       console.log(real_slipnetprmtonr)

       var conv_slipsumor = slipsumor.replace(/,/g, "");
       console.log(conv_slipsumor)
       var real_slipsumor = parseFloat(conv_slipsumor);
       console.log(real_slipsumor)
       
       console.log('sudah tertekan button update')
       //ajaxfilefunction(e);

       var current_percent = $('#sliptotalpercentinspanupdate').val();
       var current_amount = $('#sliptotalamountinspanupdate').val();
       console.log('jumlah installment panel ' + current_percent)
       var current_percent_rp = $('#sliptotalpercentinspanupdate').val();
       console.log('jumlah total or ' + current_percent_rp)

       var count_endorsement_ins = $('#fecountendorsement').val();
       console.log('count endorsement ' + count_endorsement_ins)

         if(parseFloat(current_percent) == 100.00 || parseFloat(current_amount) >= real_slipnetprmtonr)
         {

            if(slipbasicpremium)
            {

                $.ajaxSetup({
                    headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                $.ajax({
                    url:"{{url('transaction-data/marine-hull-slip/updateform')}}",
                    type:"POST",
                    data:{
                        code_ms:code_ms,
                        slipnumber:slipnumber,
                        slipdatetransfer:slipdatetransfer,
                        slipstatus:slipstatus,
                        sliped:sliped,
                        slipsls:slipsls,
                        slipcedingbroker:slipcedingbroker,
                        slipceding:slipceding,
                        // slipcurrency:slipcurrency,
                        slipcob:slipcob,
                        slipkoc:slipkoc,
                        //slipoccupacy:slipoccupacy,
                        sliptypetsi:sliptypetsi,
                        sliptotalsum:real_sliptotalsum,
                        sharetypetsi:sharetypetsi,
                        sharetotalsum:real_sharetotalsum,
                        sliptype:sliptype,
                        slippct:slippct,
                        sliptotalsumpct:real_sliptotalsumpct,
                        slipipfrom:slipipfrom,
                        slipipto:slipipto,
                        sliprpfrom:sliprpfrom,
                        sliprpto:sliprpto,
                        sliptotalday:sliptotalday,
                        sliptotalyear:sliptotalyear,
                        slipdatesum:sliptotaldatesum,
                        proportional:proportional,
                        sliplayerproportional:sliplayerproportional,
                        //sliprate:sliprate,
                        //slipsumrate:real_slipsumrate,
                        slipvbroker:slipvbroker,
                        slipsumvbroker:real_slipsumvbroker,
                        slipshare:slipshare,
                        slipsumshare:real_slipsumshare,
                        slipoldsumshare:slipoldsumshare,
                        slipbasicpremium:real_slipbasicpremium,
                        slipgrossprmtonr:real_slipgrossprmtonr,
                        slipcommission:slipcommission,
                        slipsumcommission:real_slipsumcommission,
                        slipnetprmtonr:real_slipnetprmtonr,
                        sliprb:sliprb,
                        slipor:slipor,
                        slipsumor:real_slipsumor,
                        wpc:wpc,
                        remarks:remarks,
                        countendorsement:countendorsement
                    },
                    beforeSend: function() { $("body").addClass("loading");  },
                    complete: function() {  $("body").removeClass("loading"); },
                    success:function(response)
                    {
                        swal("Success!", "Marine Cargo Slip Update Success", "success")
                        console.log(response)
                        if(response.new_share_nasre){
                            var new_nasre = response.new_share_nasre;
                            var conv_nasre = new_nasre;
                            var real_nasre = conv_nasre.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            $('#mhsharefrom').val(amountToString(conv_nasre));
                        }

                        $('#updatemodaldata').modal('toggle');
                        $('#updatemodaldata2').modal('toggle');

                        },
                        error: function (request, status, error) {
                            //alert(request.responseText);
                            swal("Error!", "Marine Cargo Slip Update Error", "Update Error");
                        }
                    });

                console.log('sudah update');

                var formData = new FormData(this);
                let TotalFiles = $('#attachmentupdate')[0].files.length; //Total files
                let files = $('#attachmentupdate')[0];
                var slip_id = $('#slipnumberupdate').val();
                var insured_id = $('#insuredIDtxt').val();

                for (let i = 0; i < TotalFiles; i++) 
                {
                    formData.append('files' + i, files.files[i]);
                    }

                formData.append('TotalFiles', TotalFiles);
                formData.append('slip_id', slip_id);
                formData.append('insured_id', insured_id);
                formData.append('slip_type', 'mc');


                $.ajax({
                    type:'POST',
                    url: "{{ url('store-multi-file-ajax')}}",
                    data: formData,
                    cache:false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: (data) => {
                                //this.reset();
                                //alert('Files has been uploaded using jQuery ajax');
                                swal("Success!", "Files has been uploaded", "success")
                            },
                            error: function(data){
                                //alert(data.responseJSON.errors.files[0]);
                                // swal("Error!", data.responseJSON.errors.files[0], "Insert Error");
                                //console.log(data.responseJSON.errors);
                            }
                        });
            }
            else
            {
                swal("Error!", "Please input Marine Hull Premium Detail Detail", "Insert Error");
            }

        }
        else if(parseFloat(current_percent) > 100.00){
            swal("Error!", "installment panel cannto more than 100%", "Insert Error");
        }else if(parseFloat(current_percent) < 100.00){
            swal("Error!", "Please input installment panel until 100%", "Insert Error");
        }else{
            swal("Error!", "Please input installment panel until 100%", "Insert Error");
        }
    });
</script>

<script type='text/javascript'>
    $('#multi-file-upload-ajaxendorsement').submit(function(e)
    {
       //alert('masuk');
       e.preventDefault();
       
       var slipsharetotalsum = $('#sharetotalsumendorsement').val().replace(/,/g, "");
       var sliptypetotalsum = $('#sliptypetsiendorsement').val();
       var sliptypetsishare = $('#sharetypetsiendorsement').val();
       var sliptotalday = $('#slipdaytotalendorsement').val();
       var sliptotalyear = $('#slipdaytotalendorsement3').val();
       var slipdatesum = $('#sliptotalsumdateendorsement').val();
       var slipsumvbroker =  $('#slipsumfeeendorsement').val();


       var msicurrency = $('#mhcurrency').val();
        var sliptotalpercentrpor = $('#sliptotalpercentrporendorsement').val();
        var retropercent = $('#retropercent').val();


       var code_ms = $('#mhnumber').val();
       var slipid = $('#slipidendorsement').val();
       var slipnumber = $('#slipnumberendorsement').val();
       var prevslipnumber = $('#prevslipnumberendorsement').val();
       var slipdatetransfer = $('#sliptdendorsement').val();
       var slipstatus = $('#slipstatusendorsement').val();
       var sliped = $('#slipedendorsement').val();
       var slipsls = $('#slipslsendorsement').val();
       var slipcedingbroker = $('#slipcedingbrokerendorsement').val();
       var slipceding = $('#slipcedingendorsement').val();
       // var slipcurrency = $('#slipcurrencyendorsement').val();
       var slipcob = $('#slipcobendorsement').val();
       var slipkoc = $('#slipkocendorsement').val();
       //var slipoccupacy = $('#slipoccupacyendorsement').val();
       var slipbld_const = $('#slipbld_constendorsement').val();
       var slipno = $('#slipnoendorsement').val();
       var slipcndn = $('#slipcndnendorsement').val();
       var slippolicy_no = $('#slippolicy_noendorsement').val();
       var sliptotalsum = $('#sliptotalsumendorsement').val();
       var sliptype =  $('#sliptypeendorsement').val();
       var slippct =  $('#slippctendorsement').val();
       var sliptotalsumpct =  $('#sliptotalsumpctendorsement').val();
       var slipipfrom =  $('#slipipfromendorsement').val();
       var slipipto =  $('#slipiptoendorsement').val();
       var sliprpfrom =  $('#sliprpfromendorsement').val();
       var sliprpto =  $('#sliprptoendorsement').val();
       var proportional =  $('#switch-proportionalendorsement').val();
       var sliplayerproportional =  $('#sliplayerproportionalendorsement').val();
       var sliprate =  $('#sliprateendorsement').val();
       var slipshare =  $('#slipshareendorsement').val();
       var slipvbroker =  $('#slipvbrokerendorsement').val();
       var slipsumshare =  $('#slipsumshareendorsement').val();
       var slipbasicpremium =  $('#totalhullpremiendorsement').val();
       var slipgrossprmtonr =  $('#slipgrossprmtonrendorsement').val();
       var slipsumcommission =  $('#slipsumcommissionendorsement').val();
       var slipcommission =  $('#slipcommissionendorsement').val();
       var slipnetprmtonr =  $('#slipnetprmtonrendorsement').val();
       var sliprb =  $('#sliprbendorsement').val();
       var slipor =  $('#sliporendorsement').val();
       var slipsumor =  $('#slipsumorendorsement').val();
       var wpc =  $('#wpcendorsement').val();
       var remarks =  $('#remarksendorsement').val();
       var insuredshare = $('#mhsharefrom').val();
       var kurs = $('#mhkurs').val();
       var currency = $( "#mhcurrency option:selected" ).text();
       var conv_curr = currency.substring(0,3);
       var countendorsement = $('#countendorsmentdata').val();

       var token2 = $('input[name=_token]').val();
       

       var conv_sliptotalsum = sliptotalsum.replace(/,/g, "");
       console.log(conv_sliptotalsum)
       var real_sliptotalsum = parseFloat(conv_sliptotalsum);
       console.log(real_sliptotalsum)
       
       var conv_sliptotalsumpct = sliptotalsumpct.replace(/,/g, "");
       console.log(conv_sliptotalsumpct)
       var real_sliptotalsumpct = parseFloat(conv_sliptotalsumpct);
       console.log(real_sliptotalsumpct)

       var conv_slipsumshare = slipsumshare.replace(/,/g, "");
       console.log(conv_slipsumshare)
       var real_slipsumshare = parseFloat(conv_slipsumshare);
       console.log(real_slipsumshare)

       var conv_slipbasicpremium = slipbasicpremium.replace(/,/g, "");
       console.log(conv_slipbasicpremium)
       var real_slipbasicpremium = parseFloat(conv_slipbasicpremium);
       console.log(real_slipbasicpremium)

       var conv_slipgrossprmtonr = slipgrossprmtonr.replace(/,/g, "");
       console.log(conv_slipgrossprmtonr)
       var real_slipgrossprmtonr = parseFloat(conv_slipgrossprmtonr);
       console.log(real_slipgrossprmtonr)

       var conv_slipsumcommission = slipsumcommission.replace(/,/g, "");
       console.log(conv_slipsumcommission)
       var real_slipsumcommission = parseFloat(conv_slipsumcommission);
       console.log(real_slipsumcommission)

       var conv_slipnetprmtonr = slipnetprmtonr.replace(/,/g, "");
       console.log(conv_slipnetprmtonr)
       var real_slipnetprmtonr = parseFloat(conv_slipnetprmtonr);
       console.log(real_slipnetprmtonr)

       var conv_slipsumor = slipsumor.replace(/,/g, "");
       console.log(conv_slipsumor)
       var real_slipsumor = parseFloat(conv_slipsumor);
       console.log(real_slipsumor)
       
       //ajaxfilefunction(e);

       $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
       });

       if(slipbasicpremium)
       {   
            $.ajax({
                url:"{{url('transaction-data/marine-hull-slip/endorsementstore')}}",
                type:"POST",
                data:{
                    slipid:slipid,
                    code_ms:code_ms,
                    slipnumber:slipnumber,
                    slipdatetransfer:slipdatetransfer,
                    slipstatus:slipstatus,
                    sliped:sliped,
                    slipsls:slipsls,
                    slipcedingbroker:slipcedingbroker,
                    slipceding:slipceding,
                    // slipcurrency:slipcurrency,
                    slipcob:slipcob,
                    slipkoc:slipkoc,
                    //slipoccupacy:slipoccupacy,
                    slipbld_const:slipbld_const,
                    slipno:slipno,
                    slipcndn:slipcndn,
                    slippolicy_no:slippolicy_no,
                    sliptotalsum:real_sliptotalsum,
                    sliptype:sliptype,
                    slippct:slippct,
                    sliptotalsumpct:real_sliptotalsumpct,
                    slipipfrom:slipipfrom,
                    slipipto:slipipto,
                    sliprpfrom:sliprpfrom,
                    sliprpto:sliprpto,
                    proportional:proportional,
                    sliplayerproportional:sliplayerproportional,
                    sliprate:sliprate,
                    slipvbroker:slipvbroker,
                    slipshare:slipshare,
                    slipsumshare:real_slipsumshare,
                    slipbasicpremium:real_slipbasicpremium,
                    slipgrossprmtonr:real_slipgrossprmtonr,
                    slipcommission:slipcommission,
                    slipsumcommission:real_slipsumcommission,
                    slipnetprmtonr:real_slipnetprmtonr,
                    sliprb:sliprb,
                    slipor:slipor,
                    slipsumor:real_slipsumor,
                    wpc:wpc,
                    slipremarks:remarks,
                    slipsharetotalsum:slipsharetotalsum,
                    sliptypetotalsum:sliptypetotalsum,
                    sliptypetsishare:sliptypetsishare,
                    sliptotalday:sliptotalday,
                    sliptotalyear:sliptotalyear,
                    slipdatesum:slipdatesum,
                    slipsumvbroker:slipsumvbroker,
                    msicurrency:msicurrency,
                    sliptotalpercentrpor:sliptotalpercentrpor,
                    retropercent:retropercent,
                    countendorsement:countendorsement
                },
                beforeSend: function() { $("body").addClass("loading");  },
                complete: function() {  $("body").removeClass("loading"); },
                success:function(response)
                {
                    swal("Success!", "Marine Cargo Slip Endorsement Success", "success")
                    console.log(response)

                    // var insured_data2=JSON.parse(response.insured_data);
                    // $('#fecountendorsement').val(insured_data2.count_endorsement);
                    //alert(insured_data2.count_endorsement);

                    refreshTableSlip(code_ms) 
                    $('#endorsementmodaldata').modal('toggle');
                    $('#endorsementmodaldata2').modal('toggle');

                },
                error: function (request, status, error) {
                    //alert(request.responseText);
                    swal("Error!", "Marine Cargo Slip Endorsement Error", "Insert Error");
                }
            
            });



            var formData = new FormData(this);
            let TotalFiles = $('#attachmentendorsement')[0].files.length; //Total files
            let files = $('#attachmentendorsement')[0];
            var slip_id = $('#slipnumberendorsement').val();

            for (let i = 0; i < TotalFiles; i++) 
            {
                formData.append('files' + i, files.files[i]);
            }

            formData.append('TotalFiles', TotalFiles);
            formData.append('slip_id', slip_id);
            formData.append('insured_id', code_ms);
            formData.append('slip_type', 'fe');


            $.ajax({
                type:'POST',
                url: "{{ url('store-multi-file-ajax')}}",
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: (data) => {
                            //this.reset();
                            //alert('Files has been uploaded using jQuery ajax');
                            swal("Success!", "Files has been uploaded", "success")
                        },
                        error: function(data){
                            //alert(data.responseJSON.errors.files[0]);
                            //swal("Error!", data.responseJSON.errors.files[0], "Insert Error");
                            //console.log(data.responseJSON.errors);
                        }
                    });

            $('#installmentPanelendorsement tbody').empty();
            $('#ExtendCoveragePanelendorsement tbody').empty();
            $('#deductiblePanelendorsement tbody').empty();
            $('#retrocessionPanelendorsement tbody').empty();

       }
       else{
        swal("Error!", "Please Input Marine Hull Premium Detail", "Endorsement Error Data Error");
       }



  });
</script>

<style>
    .overlay{
        display: none;
        position: fixed;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        z-index: 999;
        background: rgba(255,255,255,0.8) url("{{asset('loader.gif')}}") center no-repeat;
    }
    /* Turn off scrollbar when body element has the loading class */
    body.loading{
        overflow: hidden;   
    }
    /* Make spinner image visible when body element has the loading class */
    body.loading .overlay{
        display: block;
    }
</style>


<script>
    // $(function () {
    //   "use strict";
  
    //   var marineslip = <?php echo(($ms_ids->content())) ?>;
    //   for(const id of marineslip) {
    //       var btn = `
    //           <a href="#" onclick="confirmDelete('${id}')">
    //               <i class="fas fa-trash text-danger"></i>
    //           </a>
    //       `;
    //       $(`#delbtn${id}`).append(btn);
    //   }
  
  
    //   $("#marineSlip").DataTable({
    //     "order": [[ 0, "desc" ]],
    //     dom: '<"top"Bf>rt<"bottom"lip><"clear">',
    //     lengthMenu: [
    //         [ 10, 25, 50,100, -1 ],
    //         [ '10 rows', '25 rows', '50 rows','100 rows', 'Show all' ]
    //     ]
    //   });
  
    // });
  
    // function confirmDelete(id){
    //     let choice = confirm("{{__('Are you sure, you want to delete this product and related data?')}}")
    //     if(choice){
    //         document.getElementById('delete-country-'+id).submit();
    //     }
    // }
    function refreshTableSlip(number){
                var slip_type = 'mh';
                //url:"{{url('transaction-data/fe-slip/cancelformnumber/')}}"+slipnumber,
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
                $.ajax({
                 url:"{{url('transaction-data/"+slip_type+"/refreshslip')}}",
                 type:"POST",
                 data:{
                    number:number,
                    type:slip_type
                 },
                 // beforeSend: function() { $("body").addClass("loading");  },
                 // complete: function() {  $("body").removeClass("loading"); },
                 success:function(response)
                 {
                    console.log(response)
                    var html = "";
                    var button = "";
                    var slipdata= JSON.parse(response.slip_data_distinct);
                    var slipdatadetail= JSON.parse(response.slip_data2);
                    var max_endorsement = response.max_endorsement;
                    console.log('slipdata ' + slipdata.length)
                    console.log('slipdatadetail.length ' + slipdatadetail.length)
                    
                    $('#SlipInsuredTableData tbody').empty();
                            
                        for(var i = 0; i < slipdatadetail.length; i++){
                            var id = slipdatadetail[i].id;
                            var number = slipdatadetail[i].number;
                            var warning_flag = slipdatadetail[i].warning_flag;
                            var cedingbroker = slipdatadetail[i].name;
                            var cedingbrokercn = slipdatadetail[i].company_name;
                            var ceding = slipdatadetail[i].source_name;
                            var cedingcn = slipdatadetail[i].source_companyname;
                            var id_detail = slipdatadetail[i].id;
                            var statusdetail = slipdatadetail[i].status;
                            var warning_flag = slipdatadetail[i].warning_flag;
                            var endorsmentdetail = slipdatadetail[i].endorsment;
                            var date_transfer = slipdatadetail[i].date_transfer;
                            
                 
                            if(endorsmentdetail == max_endorsement)
                            {                           
                                if(date_transfer == null)
                                {
                                    
                                    if(statusdetail == 'cancel' || statusdetail == 'decline')
                                    {
                                        button += "";
                                        
                                    }
                                    if(statusdetail == 'proposal'){
                                        button += '<button type="button" id="btnSlip" data-id="'+id_detail+'" class="btn btn-sm btn-primary float-right">Slip</button>';
                                    }
                                    else if(statusdetail != 'endorsement' )
                                    {
                                        button += '<a class="text-primary mr-3 float-right" data-toggle="modal" data-book-id="'+id_detail+'" data-target="#cancelmodaldata"> <button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#cancelmodaldata2">Cancel</button></a>';
                                    }
                                    

                                    if(warning_flag == 1){
                                        button += '<label class="text text-danger"><i class="fa fa-exclamation-triangle"></i> Must Change</label>';
                                    }

                                    if(statusdetail == 'cancel' || statusdetail == 'decline')
                                    {
                                        button += '<a class="text-primary mr-3 float-right" data-toggle="modal"  data-book-id="'+id_detail+'" data-target="#detailmodaldata" href="#detailmodaldata">'
                                        +'<button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#detailmodaldata2">Detail</button>'
                                        +'</a>'  
                                    } 
                                    else
                                    {
                                        button += '<a class="text-primary mr-3 float-right" data-toggle="modal"  data-book-id="'+id_detail+'" data-target="#detailmodaldata" href="#detailmodaldata">'

                                        +'<button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#detailmodaldata2">Detail</button>'
                                        +'</a>'
                                        +'<button type="button" class="btn btn-sm btn-primary float-right" id="btnTransferDate" data-id="'+id_detail+'">Transfer Date</button>'
                                        +'<a class="text-primary mr-3 float-right " data-toggle="modal" data-book-id="'+id_detail+'" data-target="#updatemodaldata">'
                                        +'<button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#updatemodaldata2">Edit</button>'
                                        +'</a>'
                                    }
                                        
                                    
                                }
                                else if(date_transfer != null)
                                {
                                    if(statusdetail == 'cancel' || statusdetail == 'decline')
                                    {
                                        button += '<a class="text-primary mr-3 float-right" data-toggle="modal"  data-book-id="'+id_detail+'" data-target="#detailmodaldata" href="#detailmodaldata">'
                                        +'<button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#detailmodaldata2">Detail</button>'
                                        +'</a>'
                                        +'<a class="text-primary mr-3 float-right " data-toggle="modal" data-book-id="'+id_detail+'" data-target="#endorsementmodaldata">'
                                        +'<button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#endorsementmodaldata2">Endorsement</button>'
                                        +'</a>';
                                    }else
                                    {
                                        if(warning_flag == 1)
                                        {
                                            button += '<button type="button" id="change-must" class="btn btn-sm btn-danger float-right">Must Change</button>';
                                        }
                                        button += '<a class="text-primary mr-3 float-right" data-toggle="modal"  data-book-id="'+id_detail+'" data-target="#detailmodaldata" href="#detailmodaldata">'
                                        +'<button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#detailmodaldata2">Detail</button>'
                                        +'</a>'
                                        +'<a class="text-primary mr-3 float-right " data-toggle="modal" data-book-id="'+id_detail+'" data-target="#endorsementmodaldata">'
                                        +'<button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#endorsementmodaldata2">Endorsement</button>'
                                        +'</a>'
                                    }
                                }
                            }
                            else
                            {
                                button += '<a class="text-primary mr-3 float-right" data-toggle="modal"  data-book-id="'+id_detail+'" data-target="#detailmodaldata" href="#detailmodaldata">'
                                +'<button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#detailmodaldata2">Detail</button>'
                                +'</a>';
                            }    
                            
                                
                            
                            
                            html += '<tr><td>'+number+'</td>'
                                +'<td data-name="'+cedingbroker+'">'+cedingbroker+'-'+cedingbrokercn+'</td>'
                                +'<td data-name="'+ceding+'">'+ceding+'-'+cedingcn+'</td>' 
                                +'<td data-name="'+statusdetail+'">'+statusdetail+'</td>'
                                +'<td data-name="'+endorsmentdetail+'">'+endorsmentdetail+'</td>'
                                +'<td>'
                                + button
                                +'</td></tr>';
                            button = "";
                        };
                        
                        $('#SlipInsuredTableData tbody').append(html)

                    

                    },
                    error: function (request, status, error) {
                        //alert(request.responseText);
                        swal("Error!", error, "warning");
                    }
                });
    }
</script>
<!-- Function -->
<script type="text/javascript">
    
    function calculateBasicPremium(status){
        if(status == 'update'){
            var sliptotalsumdate = $('#sliptotalsumdateupdate').val();
            var mhtypepremi = parseFloat($('#mhtypepremiupdate').val());
            var mhtypeamount = parseFloat($('#mhtypeamountupdate').val());
            var mhtyperate = parseFloat($('#mhtyperateupdate').val());
        }else if (status == 'endorsement') {
            var sliptotalsumdate = $('#sliptotalsumdateendorsement').val();
            var mhtyperate = parseFloat($('#mhtyperateendorsement').val());
            var mhtypepremi = parseFloat($('#mhtypepremiendorsement').val());
            var mhtypeamount = parseFloat($('#mhtypeamountendorsement').val());
        }else{
            var sliptotalsumdate = $('#sliptotalsumdate').val();
            var mhtypepremi = parseFloat($('#mhtypepremi').val());
            var mhtypeamount = parseFloat($('#mhtypeamount').val());
            var mhtyperate = parseFloat($('#mhtyperate').val());
        }
        var proses_basic_premium = parseFloat((mhtypeamount/100) * mhtyperate*sliptotalsumdate).toFixed(2);
        console.log('sliptotalsumdate' + sliptotalsumdate)
        console.log('mhtypeamount/100' + mhtypeamount/100)
        console.log('(mhtypeamount/100) * mhtyperate' + (mhtypeamount/100) * mhtyperate)
        var basic_premium = isNaN(proses_basic_premium) ? 0 : (proses_basic_premium);
        if(status == 'update'){
            $('#mhtypepremiupdate').val(basic_premium);    
        }else if (status == 'endorsement') {
            $('#mhtypepremiendorsement').val(basic_premium);    
        }else{
            $('#mhtypepremi').val(basic_premium);    
        }
        calculateGrossPrm(status);
    }
    function calculateTotalRate(status){
        if(status == 'update'){
            var basic_premium = parseFloat($('#slipbasicpremiumupdate').val());
            var sliprate = parseFloat($('#sliprateupdate').val());
            var tsi = parseFloat($('#sharetotalsumupdate').val());
            var sliptotalsumdate = $('#sliptotalsumdateupdate').val(); // days
            var sliptotalrate   = parseFloat($('#sliptotalrateupdate').val());
            var totalrateexc = parseFloat($('#sliptotalnilaiecupdate').val());
        }else if (status == 'endorsement') {
            var basic_premium = parseFloat($('#slipbasicpremiumendorsement').val());
            var sliprate = parseFloat($('#sliprateendorsement').val());
            var tsi = parseFloat($('#sharetotalsumendorsement').val());
            var sliptotalsumdate = $('#sliptotalsumdateendorsement').val(); // days
            var sliptotalrate   = parseFloat($('#sliptotalrateendorsement').val());
            var totalrateexc = parseFloat($('#sliptotalnilaiecendorsement').val());
        }else{
            var basic_premium = parseFloat($('#slipbasicpremium').val());
            var sliprate = parseFloat($('#sliprate').val());
            var tsi = parseFloat($('#sharetotalsum').val());
            var sliptotalsumdate = $('#sliptotalsumdate').val(); // days
            var sliptotalrate   = parseFloat($('#sliptotalrate').val());
            var totalrateexc = parseFloat($('#sliptotalnilaiec').val());
        }

        var sumtotalrate = 0;
        var totalrateexc = isNaN(totalrateexc) ? 0 : (totalrateexc);
        console.log('totalrateexc' + totalrateexc)
        console.log('sumtotalrate' + sumtotalrate)
        var proses = parseFloat(sliprate + totalrateexc).toFixed(2);
        sumtotalrate = isNaN(proses) ? 0 :(proses);
        console.log('totalrateexc' + totalrateexc)
        console.log('sumtotalrate' + sumtotalrate)
        if(status == 'update'){
            $('#sliptotalrateupdate').val(floatToString(sumtotalrate));
            $('#sliptotalrateupdate2').val(floatToString(sumtotalrate));    
        }else if (status == 'endorsement') {
            $('#sliptotalrateendorsement').val(floatToString(sumtotalrate));
            $('#sliptotalrateendorsement2').val(floatToString(sumtotalrate));
        }else{
            $('#sliptotalrate').val(floatToString(sumtotalrate));
            $('#sliptotalrate2').val(floatToString(sumtotalrate));    
        }
        calculateGrossPrm(status);   

    }
    function calculateTotalRateByPremium(status){
        if(status == 'update'){
            var basic_premium = parseFloat($('#slipbasicpremiumupdate').val());
            var sliprate = parseFloat($('#sliprateupdate').val());
            var tsi = parseFloat($('#sharetotalsumupdate').val());
            var sliptotalsumdate = $('#sliptotalsumdateupdate').val(); // days
            var sliptotalrate   = parseFloat($('#sliptotalrateupdate').val());
            var totalrateexc = parseFloat($('#sliptotalnilaiecupdate').val());
        }else if (status == 'endorsement') {
            var basic_premium = parseFloat($('#slipbasicpremiumendorsement').val());
            var sliprate = parseFloat($('#sliprateendorsement').val());
            var tsi = parseFloat($('#sharetotalsumendorsement').val());
            var sliptotalsumdate = $('#sliptotalsumdateendorsement').val(); // days
            var sliptotalrate   = parseFloat($('#sliptotalrateendorsement').val());
            var totalrateexc = parseFloat($('#sliptotalnilaiecendorsement').val());
        }else{
            var basic_premium = parseFloat($('#slipbasicpremium').val());
            var sliprate = parseFloat($('#sliprate').val());
            var tsi = parseFloat($('#sharetotalsum').val());
            var sliptotalsumdate = $('#sliptotalsumdate').val(); // days
            var sliptotalrate   = parseFloat($('#sliptotalrate').val());
            var totalrateexc = parseFloat($('#sliptotalnilaiec').val());
        }
        var sumtotalrate = 0;
        var proses_totalrate = parseFloat(((basic_premium * 1000) / tsi) / sliptotalsumdate).toFixed(2);
            sumtotalrate = isNaN(proses_totalrate) ? 0 : (proses_totalrate);
        if (status == 'update') {
            $('#sliptotalrateupdate').val(floatToString(sumtotalrate));
            $('#sliptotalrateupdate2').val(floatToString(sumtotalrate));    
        }else if (status == 'endorsement') {
            $('#sliptotalrateendorsement').val(floatToString(sumtotalrate));
            $('#sliptotalrateendorsement2').val(floatToString(sumtotalrate));    
        }else{
            $('#sliptotalrate').val(floatToString(sumtotalrate));
            $('#sliptotalrate2').val(floatToString(sumtotalrate)); 
        }
        
        calculateGrossPrm(status);
    }
    function calculateShareBasic(status){
        
        if (status == 'update') {
            var mhtypeamount =  parseFloat($('#mhtypeamountupdate').val());
            var sharetotalsum =  parseFloat($('#sharetotalsumupdate').val().replace(/,/g, ""));
            
        }else if (status == 'endorsement') {
            var sharetotalsum =  parseFloat($('#sharetotalsumendorsement').val().replace(/,/g, ""));
            var mhtypeamount =  parseFloat($('#mhtypeamountendorsement').val());
        }else{
            var sharetotalsum =  parseFloat($('#sharetotalsum').val().replace(/,/g, ""));
            var mhtypeamount =  parseFloat($('#mhtypeamount').val());
        }
        var proses = parseFloat((mhtypeamount/sharetotalsum)*100).toFixed(2);
        console.log('calculateShare mhtypeamount ' + mhtypeamount)
        console.log('calculateShare sharetotalsum ' + sharetotalsum)
        var rate = isNaN(proses) ? 0 : (proses);
        if (status == 'update') {
            $('#mhtypeshareupdate').val(floatToString(rate));
        }else if (status == 'endorsement') {
            $('#mhtypeshareendorsement').val(floatToString(rate));
        }else{
            $('#mhtypeshare').val(floatToString(rate));    
        }
        calculateGrossPrm(status);
    }
    function calculateGrossPrm(status){
        if (status == 'update') {
            var totalhullpremi = parseFloat($('#totalhullpremiupdate').val().replace(/,/g, ""));
            var slipshare = parseFloat($('#slipshareupdate').val());
            var sharetotalsum = parseFloat($('#sharetotalsumupdate').val().replace(/,/g, ""));
        }else if (status == 'endorsement') {
            var totalhullpremi = parseFloat($('#totalhullpremiendorsement').val().replace(/,/g, ""));
            var slipshare = parseFloat($('#slipshareendorsement').val());
            var sharetotalsum = parseFloat($('#sharetotalsumendorsement').val().replace(/,/g, ""));
        }else{
            var totalhullpremi = parseFloat($('#totalhullpremi').val().replace(/,/g, ""));
            var slipshare = parseFloat($('#slipshare').val());
            var sharetotalsum = parseFloat($('#sharetotalsum').val().replace(/,/g, ""));
        }
        var proses = parseFloat(totalhullpremi*(slipshare/100)).toFixed(2);
        var gross = isNaN(proses) ? 0 : (proses);
        var proses_net = parseFloat(sharetotalsum*(slipshare/100)).toFixed(2);
        var net = isNaN(proses_net) ? 0 : (proses_net);

        if (status == 'update') {
            $('#slipgrossprmtonrupdate').val(gross);
            $('#slipgrossprmtonrupdate2').val(gross);

            $('#slipsumshareupdate').val(net);
            $('#slipsumshareupdate2').val(net);
        }else if (status == 'endorsement') {
            $('#slipgrossprmtonrendorsement').val(gross);
            $('#slipgrossprmtonrendorsement2').val(gross);

            $('#slipsumshareupdate').val(net);
            $('#slipsumshareupdate2').val(net);
        }else{
            $('#slipgrossprmtonr').val(gross);
            $('#slipgrossprmtonr2').val(gross);

            $('#slipsumshare').val(net);
            $('#slipsumshare2').val(net);            
        }
        calculateComm(status)
        calculateFeeBroker(status)
        calculateShare(status)
        calculateNetPrm(status)
    }
    function calculateComm(status){
        if (status == 'update') {
            var slipcommission = parseFloat($('#slipcommissionupdate').val().replace(/,/g, ""));
            var slipgrossprmtonr = parseFloat($('#slipgrossprmtonrupdate').val().replace(/,/g, ""));
        }else if(status == 'endorsement'){
            var slipcommission = parseFloat($('#slipcommissionendorsement').val().replace(/,/g, ""));
            var slipgrossprmtonr = parseFloat($('#slipgrossprmtonrendorsement').val().replace(/,/g, ""));
        }else{
            var slipcommission = parseFloat($('#slipcommission').val().replace(/,/g, ""));
            var slipgrossprmtonr = parseFloat($('#slipgrossprmtonr').val().replace(/,/g, ""));
        }

        var proses_comm = parseFloat((slipcommission/100) * slipgrossprmtonr).toFixed(2);
        var comm = isNaN(proses_comm) ? 0 : (proses_comm);
        console.log('slipcommission' + slipcommission)
        console.log('slipgrossprmtonr' + slipgrossprmtonr)
        console.log('proses_comm' + proses_comm)
        if (status == 'update') {
            $('#slipsumcommissionupdate').val(comm);
            $('#slipsumcommissionupdate2').val(comm);
        }else if(status == 'endorsement'){
            $('#slipsumcommissionendorsement').val(comm);
            $('#slipsumcommissionendorsement2').val(comm);
        }else{
            $('#slipsumcommission').val(comm);
            $('#slipsumcommission2').val(comm);
        }
        calculateNetPrm(status)
    }
    function calculateFeeBroker(status){
        
        if (status == 'update') {
            var slipgrossprmtonr = parseFloat($('#slipgrossprmtonrupdate').val().replace(/,/g, ""));
            var slipvbroker = parseFloat($('#slipvbrokerupdate').val());
        }else if(status == 'endorsement'){
            var slipgrossprmtonr = parseFloat($('#slipgrossprmtonrendorsement').val().replace(/,/g, ""));
            var slipvbroker = parseFloat($('#slipvbrokerendorsement').val());
        }else{
            var slipgrossprmtonr = parseFloat($('#slipgrossprmtonr').val().replace(/,/g, ""));
            var slipvbroker = parseFloat($('#slipvbroker').val());
        }
        var proses_fee = parseFloat((slipvbroker/100) * slipgrossprmtonr).toFixed(2);
        var fee = isNaN(proses_fee) ? 0 : (proses_fee);
        if (status == 'update') {
            $('#slipsumfeeupdate').val(fee);
            $('#slipsumfeeupdate2').val(fee);
        }else if(status == 'endorsement'){
            $('#slipsumfeeendorsement').val(fee);
            $('#slipsumfeeendorsement2').val(fee);
        }else{
            $('#slipsumfee').val(fee);
            $('#slipsumfee2').val(fee);
        }
        calculateNetPrm(status)
    }
    function calculatePercentFee(status){
        if (status == 'update') {
            var slipsumfee = parseFloat($('#slipsumfeeupdate2').val().replace(/,/g, ""));
            var slipgrossprmtonr = parseFloat($('#slipgrossprmtonrupdate').val().replace(/,/g, ""));
        }else if(status =='endorsement'){
            var slipsumfee = parseFloat($('#slipsumfeeendorsement2').val().replace(/,/g, ""));
            var slipgrossprmtonr = parseFloat($('#slipgrossprmtonrendorsement').val().replace(/,/g, ""));    
        }else{
            var slipsumfee = parseFloat($('#slipsumfee2').val().replace(/,/g, ""));
            var slipgrossprmtonr = parseFloat($('#slipgrossprmtonr').val().replace(/,/g, ""));    
        }
        


        var proses_percent = parseFloat((slipsumfee * 100) / slipgrossprmtonr).toFixed(2);
        var percent = isNaN(proses_percent) ? 0 : (proses_percent);
        if (status == 'update') {
            $('#slipvbrokerupdate').val(floatToString(percent));
        }else if(status =='endorsement'){
            $('#slipvbrokerendorsement').val(floatToString(percent));
        }else{
            $('#slipvbroker').val(floatToString(percent));
        }
        calculateNetPrm(status)
    }
    function calculateNetPrm(status){
        if (status == 'update') {
            var slipgrossprmtonr = parseFloat($('#slipgrossprmtonrupdate').val().replace(/,/g, ""));
            var slipsumfee = parseFloat($('#slipsumfeeupdate').val().replace(/,/g, ""));
            var slipsumcommission = parseFloat($('#slipsumcommissionupdate').val().replace(/,/g, ""));
        }else if(status == 'endorsement'){
            var slipgrossprmtonr = parseFloat($('#slipgrossprmtonrendorsement').val().replace(/,/g, ""));
            var slipsumfee = parseFloat($('#slipsumfeeendorsement').val().replace(/,/g, ""));
            var slipsumcommission = parseFloat($('#slipsumcommissionendorsement').val().replace(/,/g, ""));
        }else{
            var slipgrossprmtonr = parseFloat($('#slipgrossprmtonr').val().replace(/,/g, ""));
            var slipsumfee = parseFloat($('#slipsumfee').val().replace(/,/g, ""));
            var slipsumcommission = parseFloat($('#slipsumcommission').val().replace(/,/g, ""));
        }
                

        var proses_net_prm = parseFloat(slipgrossprmtonr - slipsumcommission - slipsumfee).toFixed(2);
        var net_prm =  isNaN(proses_net_prm) ? 0 : (proses_net_prm);
        if (status == 'update') {
            $('#slipnetprmtonrupdate').val(net_prm);
            $('#slipnetprmtonrupdate2').val(net_prm);
        }else if(status == 'endorsement'){
            $('#slipnetprmtonrendorsement').val(net_prm);
            $('#slipnetprmtonrendorsement2').val(net_prm);
        }else{
            $('#slipnetprmtonr').val(net_prm);
            $('#slipnetprmtonr2').val(net_prm);
        }
    }
    function calculatePercentComm(status){
        if (status == 'update') {
            var slipsumcommission = parseFloat($('#slipsumcommissionupdate2').val().replace(/,/g, ""));
            var slipgrossprmtonr = parseFloat($('#slipgrossprmtonrupdate').val().replace(/,/g, ""));
        }else if(status =='endorsement'){
            var slipsumcommission = parseFloat($('#slipsumcommissionendorsement2').val().replace(/,/g, ""));
            var slipgrossprmtonr = parseFloat($('#slipgrossprmtonrendorsement').val().replace(/,/g, ""));  
        }else{
            var slipsumcommission = parseFloat($('#slipsumcommission2').val().replace(/,/g, ""));
            var slipgrossprmtonr = parseFloat($('#slipgrossprmtonr').val().replace(/,/g, ""));    
        }
        

        var proses_percent = parseFloat((slipsumcommission * 100) / slipgrossprmtonr).toFixed(2);
        var percent = isNaN(proses_percent) ? 0 : (proses_percent);
        if (status == 'update') {
            $('#slipcommissionupdate').val(floatToString(percent));
            $('#slipcommissionupdate2').val(floatToString(percent));
        }else if(status =='endorsement'){
            $('#slipcommissionendorsement').val(floatToString(percent));
            $('#slipcommissionendorsement2').val(floatToString(percent));
        }else{
            $('#slipcommission').val(floatToString(percent));
            $('#slipcommission2').val(floatToString(percent));
        }
        calculateNetPrm(status)
    }
    
    function calculateShare(status){
        if (status == 'update') {
            var slipshare = parseFloat($('#slipshareupdate').val());
            var tsi = parseFloat($('#sharetotalsumupdate').val().replace(/,/g, ""));
        }else if(status == 'endorsement'){
            var slipshare = parseFloat($('#slipshareendorsement').val());
            var tsi = parseFloat($('#sharetotalsumendorsement').val().replace(/,/g, ""));
        }else{
            var slipshare = parseFloat($('#slipshare').val());
            var tsi = parseFloat($('#sharetotalsum').val().replace(/,/g, ""));
        }
                
        
        var proses_share = parseFloat((slipshare/100) * tsi).toFixed(2);
        var share = isNaN(proses_share) ? 0 : (proses_share);
        console.log('slipshare' + slipshare)
        console.log('tsi' + tsi)
        console.log('tsi' + share)
        if (status == 'update') {
            $('#slipsumshareupdate').val(share);
            $('#slipsumshareupdate2').val(share);
        }else if(status == 'endorsement'){
            $('#slipsumshareendorsement').val(share);
            $('#slipsumshareendorsement2').val(share);
        }else{
            $('#slipsumshare').val(share);
            $('#slipsumshare2').val(share);
        }
    }
    function calculateAmount(status){
        if (status == 'update') {
            var mhtypeshare = parseFloat($('#mhtypeshareupdate').val());
            var sharetotalsum = parseFloat($('#sharetotalsumupdate').val().replace(/,/g, ""));
        }else if (status == 'endorsement') {
            var mhtypeshare = parseFloat($('#mhtypeshareendorsement').val());
            var sharetotalsum = parseFloat($('#sharetotalsumendorsement').val().replace(/,/g, ""));
        }else{
            var mhtypeshare = parseFloat($('#mhtypeshare').val());
            var sharetotalsum = parseFloat($('#sharetotalsum').val().replace(/,/g, ""));
        }

        var proses = parseFloat((sharetotalsum/100) * mhtypeshare).toFixed(2);
        var amount = isNaN(proses) ? 0 : (proses);
        console.log('amount' + amount)
        console.log('mhtypeshare' + mhtypeshare)
        console.log('sharetotalsum' + sharetotalsum)
        if (status == 'update') {
            $('#mhtypeamountupdate').val(amount);
        }else if (status == 'endorsement') {
            $('#mhtypeamountendorsement').val(amount);
        }else{
            $('#mhtypeamount').val(amount);
        }
    }
    function calculateRate(status){
        if (status == 'update') {
            var mhtypepremi = parseFloat($('#mhtypepremiupdate').val());
            var mhtypeamount = parseFloat($('#mhtypeamountupdate').val().replace(/,/g, ""));
        }else if (status == 'endorsement') {
            var mhtypepremi = parseFloat($('#mhtypepremiendorsement').val());
            var mhtypeamount = parseFloat($('#mhtypeamountendorsement').val().replace(/,/g, ""));
        }else{
            var mhtypepremi = parseFloat($('#mhtypepremi').val());
            var mhtypeamount = parseFloat($('#mhtypeamount').val().replace(/,/g, ""));
        }

        var proses = parseFloat((mhtypepremi/mhtypeamount)*100).toFixed(6);
        var amount = isNaN(proses) ? 0 : (proses);
        if (status == 'update') {
            $('#mhtyperateupdate').val(floatToString(amount));
        }else if (status == 'endorsement') {
            $('#mhtyperateendorsement').val(floatToString(amount));
        }else{
            $('#mhtyperate').val(floatToString(amount));
        }   
    }    
    function checkInstallmentDate(status){
        if (status == 'update') {
            var insurance_period_from2 = $('#slipipfromupdate').val();
            var insurance_period_to2 = $('#slipipdateupdate').val();
        }else if(status == 'endorsement'){
            var insurance_period_from2 = $('#slipipfromendorsement').val();
            var insurance_period_to2 = $('#slipipdateendorsement').val();
        }else{
            var insurance_period_from2 = $('#slipipfrom').val();
            var insurance_period_to2 = $('#slipipdate').val();
        }   
        
        var newinsurance_period_from2 = insurance_period_from2.split("/").reverse().join("-");
        var newinsurance_period_to2 = insurance_period_to2.split("/").reverse().join("-");
        var days=daysBetween(newinsurance_period_from2, newinsurance_period_to2);
        var sum = isNaN(days / 365) ? 0 :(days / 365).toFixed(9);
        // var constday = days.toString() + "/365";
        var constday1 = days.toString();
        var constday2;
        if(sum < 0){
            if(status == 'update'){
                $('#slipipdateupdate').val("");
            }else if (status == 'endorsement') {
                $('#slipipdateendorsement').val("");
            }else{
                $('#slipipdate').val("");    
            }
            swal('warning!','Installment date cannot below insurance periode');
            
        }
    }
    function calculateInstallment(status){
        if (status == 'update') {
            var percent =  parseFloat($('#slipippercentageupdate').val()) / 100;
            var slipnetprmtonr =  parseFloat($('#slipnetprmtonrupdate').val().replace(/,/g, "")) / 100;
        }else if(status == 'endorsement'){
            var percent =  parseFloat($('#slipippercentageendorsement').val()) / 100;
            var slipnetprmtonr =  parseFloat($('#slipnetprmtonrendorsement').val().replace(/,/g, "")) / 100;
        }else{
            var percent =  parseFloat($('#slipippercentage').val()) / 100;    
            var slipnetprmtonr =  parseFloat($('#slipnetprmtonr').val().replace(/,/g, "")) / 100;
        }


        
        var proses = parseFloat(percent *  slipnetprmtonr).toFixed(2)
        var total = isNaN(proses) ? 0 :(proses);
        if (status == 'update') {
            $('#slipipamountupdate').val(floatToString(total));
            $('#slipipamountupdate2').val(floatToString(total));
        }else if(status == 'endorsement'){
            $('#slipipamountendorsement').val(floatToString(total));
            $('#slipipamountendorsement2').val(floatToString(total));
        }else{
            $('#slipipamount').val(floatToString(total));
            $('#slipipamount2').val(floatToString(total));
        }
        

            

    }
    function calculateInstallment(status){
        if (status == 'update') {
            var percent =  parseFloat($('#slipippercentageupdate').val()) / 100;
            var slipnetprmtonr =  parseFloat($('#slipnetprmtonrupdate').val().replace(/,/g, ""));
        }else if(status == 'endorsement'){
            var percent =  parseFloat($('#slipippercentageendorsement').val()) / 100;
            var slipnetprmtonr =  parseFloat($('#slipnetprmtonrendorsement').val().replace(/,/g, ""));
        }else{
            var percent =  parseFloat($('#slipippercentage').val()) / 100;    
            var slipnetprmtonr =  parseFloat($('#slipnetprmtonr').val().replace(/,/g, ""));
        }

        console.log('percent' + percent)
        console.log('slipnetprmtonr' + slipnetprmtonr)

        
        var proses = parseFloat(percent *  slipnetprmtonr).toFixed(2)
        console.log('proses' + proses)
        var total = isNaN(proses) ? 0 :(proses);
        if (status == 'update') {
            $('#slipipamountupdate').val(floatToString(total));
            $('#slipipamountupdate2').val(floatToString(total));
        }else if(status == 'endorsement'){
            $('#slipipamountendorsement').val(floatToString(total));
            $('#slipipamountendorsement2').val(floatToString(total));
        }else{
            $('#slipipamount').val(floatToString(total));
            $('#slipipamount2').val(floatToString(total));
        }
    }
    function calculatePercentInstallment(status){
        if (status == 'update') {
            var amount = parseFloat($('#slipipamountupdate').val().replace(/,/g, ""));
            var slipnetprmtonr =  parseFloat($('#slipnetprmtonrupdate').val().replace(/,/g, ""));
        }else if(status == 'endorsement'){
            var slipnetprmtonr =  parseFloat($('#slipnetprmtonrendorsement').val().replace(/,/g, ""))
            var amount = parseFloat($('#slipipamountendorsement').val().replace(/,/g, ""));
        }else{
            var slipnetprmtonr =  parseFloat($('#slipnetprmtonr').val().replace(/,/g, ""));
            var amount = parseFloat($('#slipipamount').val().replace(/,/g, ""));    
        }
        console.log('amount' + amount)
        console.log('slipnetprmtonr' + slipnetprmtonr)

        var proses = parseFloat((amount / slipnetprmtonr) * 100).toFixed(5);
        var total = isNaN(proses) ? 0 :(proses);
        console.log('proses' + proses)
        if (status == 'update') {
            $('#slipippercentageupdate').val(floatToString(total));
            $('#slipippercentageupdate2').val(floatToString(total));
        }else if(status == 'endorsement'){
            $('#slipippercentageendorsement').val(floatToString(total));
            $('#slipippercentageendorsement2').val(floatToString(total));
        }else{
            $('#slipippercentage').val(floatToString(total));
            $('#slipippercentage2').val(floatToString(total));
        }
    }
    function calculateRetro(status){
        if (status == 'update') {
            var percent =  parseFloat($('#sliprppercentageupdate').val()) / 100;
            var slipsumshare = parseFloat($("#slipsumshareupdate").val().replace(/,/g, ""));
    
        }else if(status == 'endorsement'){
            var percent =  parseFloat($('#sliprppercentageendorsement').val()) / 100;
            var slipsumshare = parseFloat($("#slipsumshareendorsement").val().replace(/,/g, ""));

        }else{
            
            var percent =  parseFloat($('#sliprppercentage').val()) / 100;    
            var slipsumshare = parseFloat($("#slipsumshare").val().replace(/,/g, ""));
        }
        var proses = parseFloat(percent *  slipsumshare).toFixed(2)
        var total = isNaN(proses) ? 0 :(proses);
        if (status == 'update') {
            $('#sliprpamountupdate').val(floatToString(total));
            $('#sliprpamountupdate2').val(floatToString(total));
        }else if(status == 'endorsement'){
            $('#sliprpamountendorsement').val(floatToString(total));
            $('#sliprpamountendorsement2').val(floatToString(total));
        }else{
            $('#sliprpamount').val(floatToString(total));
            $('#sliprpamount2').val(floatToString(total));
        }

    }  
</script>

