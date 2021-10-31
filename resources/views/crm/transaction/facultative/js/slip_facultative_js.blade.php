{{-- general config --}}
<link href="{{asset('css/select2.css')}}" rel="stylesheet"/>
<script src="{{asset('/js/select2.js')}}"></script>
<link rel="stylesheet" href="{{asset('css/sweetalert2.min.css')}}">
<script src="{{asset('js/sweetalert2.all.min.js')}}"></script>
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
</style>

<style>
    .hide {
        display: none;
    }
</style>

<style>
    .overlay{
        display: none;
        position: fixed;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        z-index: 1100 !important;
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
    
    function convert(a){
        var nilai = a.toString().replace(/\B(?=(\d{3})+(?!\d)+\.)/g,",");
        return nilai;

    }

    
    $(document).ready(function() 
    { 
        var sliptype = $('#sliptypeform').val();
        if(sliptype == 'fe'){
            element = '#feshareto2';
        }else if(sliptype == 'fl'){
            element = '#flshareto2';
        }else if(sliptype == 'hem'){
            element = '#hemshareto2';
        }else if(sliptype == 'mp'){
            element = '#mpshareto2';
        }else if(sliptype == 'hio'){
            element = '#hioshareto2';
        }else if(sliptype == 'pa'){
            element = '#pashareto2';
        }else{
            element = null;
        }  
        $(document).on('click',element,function(){
            $(element).select();
        });


        $(".e1").select2(); 
        var code = $('#insuredIDtxt').val();
        refreshTableSlip(code);

        // document.getElementByTagName("html").setAttribute("lang","id-ID");

        // $("#tabretro").attr('hidden','false');
            // $("#tabretrodetail").attr('hidden','true');
            // $("#tabretroupdate").attr('hidden','true');
            // $("#tabretroendorsement").attr('hidden','true');
            $("#sliptotalsum").val().toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            var dtdef = new Date($.now());
            var datetimedef =  dtdef.getFullYear() + "-" + dtdef.getMonth() + "-" + dtdef.getDate() + " " + dtdef.getHours() + ":" + dtdef.getMinutes() + ":" + dtdef.getSeconds();
            $('#slipStatusTable tbody').append('<tr id="stlid"><td >'+ $("#slipstatus").val() +'</td><td >'+datetimedef+'</td><td >'+ $("#slipusername").val() +'</td></tr>')
            // $('#feshareto2 .insertins').prop("disabled", false);
            // var tbl_long = document.getElementById("locRiskTable").rows.length;
            // console.log(tbl_long)
            // if(tbl_long < 2){
            //     var attr = $('#feshareto2 .insertins').prop("disabled", true);
            //     if(typeof attr !== typeof undefined && attr !== false){
            //         $('#feshareto2 .insertins').prop("disabled", false);
            //     }
            // }else if(tbl_long > 1){
            //     $('#feshareto2 .insertins').prop("disabled", true);
            // }

              

            $('#sliptotalnilaiec').empty();
            $('#sliptotalpercentinspan').empty();

            

            $('#multi-file-upload-ajax').validate({ // initialize the plugin
                rules: {
                    slipkoc: {
                        required: true
                    },
                    slipcob: {
                        required: true
                    },
                    slipoccupacy: {
                        required: true
                    }
                }
            });


            $("#btnaddlayer").attr('hidden','true');
        $("#sliplayerproportional").attr('hidden','true');
        $("#labelnonprop").attr('hidden','true');
        $("#labelnp").attr('hidden','true');
        
        
        $("#btn-success2").click(function(){ 
            var html = $(".clone2").html();
            $(".increment2").after(html);
        });

        $("body").on("click","#btn-danger2",function(){ 
            $(this).parents("#control-group2").remove();
        });
        $("#btnRefreshState").click(function(){
            $('#country_location').trigger('change');
        });
        $("#btnRefreshCeding").click(function(){
            $.ajax({
                url:'{{ url("/") }}/transaction-data/get-ceding/',
                type:"GET",
                beforeSend: function() { $("body").addClass("loading");  },
                complete: function() {  $("body").removeClass("loading"); },
                success:function(response)
                {
                    
                     $('#ceding_id').empty();
                     $('#ceding_id').append('<option value=""  selected disabled >Ceding</option>');
                     $.each(response,function(i,item){
                        $('#ceding_id').append('<option value="'+item.id+'">'+item.code+' - '+item.name+'</option>');
                     });
                     
                    
                },
                error: function (request, status, error) {
                    //alert(request.responseText);
                    swal("Error!", error, "Get Data Error");
                }
            });
        });
        $("#btnInsurableList").click(function(){
            $.ajax({
                url:'{{ url("/") }}/transaction-data/get-insurable-list/',
                type:"GET",
                beforeSend: function() { $("body").addClass("loading");  },
                complete: function() {  $("body").removeClass("loading"); },
                success:function(response)
                {
                    
                     $('#slipinterestlistlocation').empty();
                     $('#slipinterestlistlocation').append('<option value=""  selected disabled >Insurable Interest</option>');
                     $.each(response,function(i,item){
                        $('#slipinterestlistlocation').append('<option value="'+item.id+'">'+item.code+' - '+item.description+'</option>');
                     });
                     
                    
                },
                error: function (request, status, error) {
                    //alert(request.responseText);
                    swal("Error!", error, "Get Data Error");
                }
            });
        });

        $("#btnRefreshCedingSlip").click(function(){
            var code_ms = $('#insuredIDtxt').val();
            $.ajax({
                url:'{{ url("/") }}/transaction-data/get-ceding-slip/'+code_ms,
                type:"GET",
                
                success:function(response)
                {
                    
                     $('#slipcedingbroker').empty();
                     $('#slipcedingbroker').append('<option value=""  selected disabled >Ceding or Broker</option>');
                     $.each(response,function(i,item){
                        $('#slipcedingbroker').append('<option value="'+item.id+'">'+item.code+' - '+item.name+'</option>');
                     });
                     
                    
                },
                error: function (request, status, error) {
                    //alert(request.responseText);
                    swal("Error!", error, "Get Data Error");
                }
            });
            $.ajax({
                url:'{{ url("/") }}/transaction-data/get-ceding/',
                type:"GET",
                beforeSend: function() { $("body").addClass("loading");  },
                complete: function() {  $("body").removeClass("loading"); },
                success:function(response)
                {
                     $.each(response,function(i,item){
                        $('#slipcedingbroker').append('<option value="'+item.id+'">'+item.code+' - '+item.name+'</option>');
                     });
                     
                    
                },
                error: function (request, status, error) {
                    //alert(request.responseText);
                    swal("Error!", error, "Get Data Error");
                }
            });
        });

        

        $( "#employee_search" ).autocomplete({
            source: function( request, response ) {
          // Fetch data
                    $.ajax({
                        url:"{{route('customer.getCostumers')}}",
                        type: 'post',
                        dataType: "json",
                        data: {
                        _token: CSRF_TOKEN,
                        search: request.term
                    },
                    success: function( data ) {
                        response( data );
                        // alert(data[0].label);
                    },
                    fail : function ( jqXHR, textStatus, errorThrown ) {
                        console.log(jqXHR);
                        console.log(textStatus);
                        console.log(errorThrown);
                    }
                });
            },
            select: function (event, ui) {
                // Set selection
                //alert(ui.item.label);

                $('#employee_search').val(ui.item.label); // display the selected text
                //$('#employeeid').val(ui.item.value); // save selected id to input
                return false;
            }
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

<script type="text/javascript">
     // window.onbeforeunload = function () {
    
     //  return 'Are you really want to perform the action?';
     // }

     window.onload = function(){
        $('#slipnumber').val(response.slipnumber);
        // $('#feshare').val(response.ourshare);
        // $('#fesharefrom').val(response.sumshare);
        $('#installmentPanel tbody').empty();
        $('#ExtendCoveragePanel tbody').empty();
        $('#deductiblePanel tbody').empty();
        $('#retrocessionPanel tbody').empty();
        $('#addinstallmentinsured-btn').attr('hidden','false');
        $('#addinstallmentinsured-btn').removeAttr('hidden');

        $('select').prop('selectedIndex',0);
        $('#sliptotalnilaiec').val('');
        $('#sliptotalpercentinspan').val('');
        $('#slipbcla').val('');
        $('#slipbcua').val('');
        $('#wpc').val("");
        $('#remarks').val("");
        $('#sliptotalsum').val("");
        $('#sliptotalsum2').val("");
        $('#slippct').val("");
        $('#sliptotalsumpct').val("");
        $('#sliptotalsumpct2').val("");
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
        $("#slipcncode option:contains(Peril List)").attr('selected', 'selected');
        $("#slipbld_const option:contains(Building Const list)").attr('selected', 'selected');
        $("#slipoccupacy option:contains(Occupation list)").attr('selected', 'selected');
        $("#slipkoc option:contains(KOC list)").attr('selected', 'selected');
        $("#slipcob option:contains(COB list)").attr('selected', 'selected');
        $("#slipceding option:contains(select ceding)").attr('selected', 'selected');
        $("#slipcedingbroker option:contains(Ceding or Broker)").attr('selected', 'selected');
     }
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
    setInputFilter(document.getElementsByClassName("floatamount"), function(value) {
    return /^-?\d*[.,]?\d{0,15}$/.test(value) });
    setInputFilter(document.getElementsByClassName("floatTextBox2"), function(value) {
        return /^-?\d*[.,]?\d{0,15}$/.test(value) });
    setInputFilter(document.getElementsByClassName("floatTextBox3"), function(value) {
        return /^-?\d*[.,]?\d{0,4}$/.test(value) });
    setInputFilter(document.getElementsByClassName("intTextBox"), function(value) {
        return /^-?\d*$/.test(value); });

</script>

<script type="text/javascript">
  
    $('.uangdata').mask("#,##0.00", {reverse: true});

    $('input.tanggal').mask("##/##/####",{
        mask: "1/2/y", 
        placeholder: "dd/mm/yyyy", 
        leapday: "-02-29", 
        separator: "/", 
        alias: "dd/mm/yyyy"
      });  


    $(".money").click(function() {
        var inputLength = $(".money").val().length;
        setCaretToPos($(".money")[0], inputLength)
    });

    $(".uang").keyup(function() {
        $('.uang').mask("#,##0.00", {reverse: true});
        console.log($('#slipvbroker').val())
    });

</script>

<script type="text/javascript">
    function fun_AllowOnlyAmountAndDot(txt)
           {
               if(event.keyCode > 47 && event.keyCode < 58 || event.keyCode == 46)
               {
                  var txtbx=document.getElementById(txt);
                  var amount = document.getElementById(txt).value;
                  var present=0;
                  var count=0;
   
                  if(amount.indexOf(".",present)||amount.indexOf(".",present+1));
                  {
                 // alert('0');
                  }
   
                 /*if(amount.length==2)
                 {
                   if(event.keyCode != 46)
                   return false;
                 }*/
                  do
                  {
                  present=amount.indexOf(".",present);
                  if(present!=-1)
                   {
                    count++;
                    present++;
                    }
                  }
                  while(present!=-1);
                  if(present==-1 && amount.length==0 && event.keyCode == 46)
                  {
                       event.keyCode=0;
                       //alert("Wrong position of decimal point not  allowed !!");
                       return false;
                  }
   
                  if(count>=1 && event.keyCode == 46)
                  {
   
                       event.keyCode=0;
                       //alert("Only one decimal point is allowed !!");
                       return false;
                  }
                  if(count==1)
                  {
                   var lastdigits=amount.substring(amount.indexOf(".")+1,amount.length);
                   if(lastdigits.length>=2)
                               {
                                 //alert("Two decimal places only allowed");
                                 event.keyCode=0;
                                 return false;
                                 }
                  }
                       return true;
               }
               else
               {
                       event.keyCode=0;
                       //alert("Only Numbers with dot allowed !!");
                       return false;
               }
   
           }
   
</script>

<script>
    $( "#autocomplete" ).autocomplete({
      source: [
      @foreach (@$costumer as $costumerdata)
      "{{@$costumerdata->company_name }}",
      @endforeach
      ]
  });
</script>
{{-- general config end --}}

{{-- Config in slip form --}}

{{-- first tab form --}}
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

       
       $('#slipprodyear').datepicker({
           dateFormat: 'dd/mm/yy',
           changeYear: true,
           yearRange: '-50:+100',
       });

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
            var sum = isNaN(days / 365) ? 0 :(days / 365).toFixed(9);
            // var constday = days.toString() + "/365";
            var constday1 = days.toString();
            var constday2;

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
            var year = parseInt(fulltgl.substring(6,12));
            console.log('ini thn' + year)
            if(year%4 == 0){
                constday2 = "366";
            }else{
                constday2 = "365";
            }

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
        var year = parseInt(fulltgl.substring(6,12));
        console.log('ini thn' + year)
            if(year%4 == 0){
                constday2 = "366";
            }else{
                constday2 = "365";
            }

        if (tgl < 1 || tgl > 31 || month < 1 || month > 12) {
            swal("Warning","Date Format not valid, Please check again","format error")
          }else if(month == 2 && tgl > 28){
            swal("Warning","Date Format not valid, Please check again","format error")
            
          }
          $('#slipdaytotal3').val(constday2);
            $('#slipdaytotal4').val(constday2);
        $('#sliptotalsumdate2').trigger('change');
    });


    $('#sliprpto').change(function(){
        var insurance_period_from2 = $('#sliprpfrom').val();
        var insurance_period_to2 = $('#sliprpto').val();
        var newinsurance_period_from2 = insurance_period_from2.split("/").reverse().join("-");
        var newinsurance_period_to2 = insurance_period_to2.split("/").reverse().join("-");
        var days=daysBetween(newinsurance_period_from2, newinsurance_period_to2);
        var sum = isNaN(days / 365) ? 0 :(days / 365).toFixed(9);
        // var constday = days.toString() + "/365";
        var constday1 = days.toString();
        var constday2;
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
        var year = parseInt(fulltgl.substring(6,12));
        console.log('ini thn' + year)
            if(year%4 == 0){
                constday2 = "366";
            }else{
                constday2 = "365";
            }

        if (tgl < 1 || tgl > 31 || month < 1 || month > 12) {
            swal("Warning","Date Format not valid, Please check again","format error")
          }else if(month == 2 && tgl > 28){
            swal("Warning","Date Format not valid, Please check again","format error")
            
          } 
        
        // $('#slipipto').val($(this).val());
        
        if(sum < 0){
            swal("Warning","Insurance/Reinsurance period cannot backdate, Please check again","Date format error")
            return;
            $('#slipdaytotal').val('');
            $('#slipdaytotal2').val('');
            $('#slipdaytotal3').val('');
            $('#slipdaytotal4').val('');
            $('#sliptotalsumdate').val('');
            $('#sliptotalsumdate2').val('');
            $('#slipipto').val("");
            $('#sliprpto').val("");
        }else{
            $('#slipdaytotal').val(constday1);
            $('#slipdaytotal2').val(constday1);
            $('#slipdaytotal3').val(constday2);
            $('#slipdaytotal4').val(constday2);
            $('#sliptotalsumdate').val(parseFloat(sum));
            $('#sliptotalsumdate2').val(parseFloat(sum));
        }
        
    });
    $('#sliptotalsumdateupdate2').change(function(){
        calculateBasicPremium('update');
        calculateComm('update');
        calculateFeeBroker('update');
    });
    $('#sliptotalsumdate2').change(function(){
        calculateBasicPremium('slip');
        calculateComm('slip');
        calculateFeeBroker('slip');
    });
    $('#sliptotalsumendorsement2').change(function(){
        calculateBasicPremium('endorsement');
        calculateComm('endorsement');
        calculateFeeBroker('endorsement');
    });
    $('#sliprpfrom').change(function(){
        var date_to = $('#sliprpto').val();
        if(date_to){
            var insurance_period_from2 = $('#sliprpfrom').val();
            var insurance_period_to2 = $('#sliprpto').val();
            var newinsurance_period_from2 = insurance_period_from2.split("/").reverse().join("-");
            var newinsurance_period_to2 = insurance_period_to2.split("/").reverse().join("-");
            var days=daysBetween(newinsurance_period_from2, newinsurance_period_to2);
            var sum = isNaN(days / 365) ? 0 :(days / 365).toFixed(9);
            // var constday = days.toString() + "/365";
            var constday1 = days.toString();
            var constday2;
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
            var year = parseInt(fulltgl.substring(6,12));
            console.log('ini thn' + year)
            if(year%4 == 0){
                constday2 = "366";
            }else{
                constday2 = "365";
            }

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
        var day = $(this).val();

        var sum = isNaN(day / 365) ? 0 :(day / 365).toFixed(9);

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

        var sum = isNaN(day / year) ? 0 :(day / year).toFixed(9);

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
            var sum = isNaN(days / 365) ? 0 :(days / 365).toFixed(9);
            // var constday = days.toString() + "/365";
            var constday1 = days.toString();
            var constday2;
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
            var year = parseInt(fulltgl.substring(6,12));
            console.log('ini thn' + year)
            if(year%4 == 0){
                constday2 = "366";
            }else{
                constday2 = "365";
            }

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
        var year = parseInt(fulltgl.substring(6,12));
        console.log('ini thn' + year)
            if(year%4 == 0){
                constday2 = "366";
            }else{
                constday2 = "365";
            }

        if (tgl < 1 || tgl > 31 || month < 1 || month > 12) {
            swal("Warning","Date Format not valid, Please check again","format error")
          }else if(month == 2 && tgl > 28){
            swal("Warning","Date Format not valid, Please check again","format error")
            
          }
          $('#sliptotalsumdateupdate2').trigger('change')
    });

    $('#slipiptoupdate').change(function(){
        $('#sliprptoupdate').val($(this).val());
        
        var insurance_period_from2 = $('#sliprpfromupdate').val();
        var insurance_period_to2 = $('#sliprptoupdate').val();
        var newinsurance_period_from2 = insurance_period_from2.split("/").reverse().join("-");
        var newinsurance_period_to2 = insurance_period_to2.split("/").reverse().join("-");
        var days=daysBetween(newinsurance_period_from2, newinsurance_period_to2);
        var sum = isNaN(days / 365) ? 0 :(days / 365).toFixed(9);
        // var constday = days.toString() + "/365";
        var constday1 = days.toString();
        var constday2;
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
        
        var year = parseInt(fulltgl.substring(6,12));
        console.log('ini thn' + year)
            if(year%4 == 0){
                constday2 = "366";
            }else{
                constday2 = "365";
            }

        if (tgl < 1 || tgl > 31 || month < 1 || month > 12) {
            swal("Warning","Date Format not valid, Please check again","format error")
          }else if(month == 2 && tgl > 28){
            swal("Warning","Date Format not valid, Please check again","format error")
            
          } 
        
        if(sum < 0){
            swal("Warning","Insurance/Reinsurance period cannot backdate, Please check again","Date format error")
            return;
            $('#slipdaytotalupdate').val("");
            $('#slipdaytotalupdate2').val("");
            $('#slipdaytotalupdate3').val("");
            $('#slipdaytotalupdate4').val("");
            $('#sliptotalsumdateupdate').val("");
            $('#sliptotalsumdateupdate2').val("");
            $('#slipiptoupdate').val("");
            $('#sliprptoupdate').val("");


        }else{
            $('#slipdaytotalupdate').val(constday1);
            $('#slipdaytotalupdate2').val(constday1);
            $('#slipdaytotalupdate3').val(constday2);
            $('#slipdaytotalupdate4').val(constday2);
            $('#sliptotalsumdateupdate').val(parseFloat(sum));
            $('#sliptotalsumdateupdate2').val(parseFloat(sum));
        }
        $('#sliptotalsumdateupdate2').trigger('change');
        // document.getElementById("daytotal").innerHTML = "Total Days :"+days;
    });

    $('#sliprptoupdate').change(function(){
        var insurance_period_from2 = $('#sliprpfromupdate').val();
        var insurance_period_to2 = $('#sliprptoupdate').val();
        var newinsurance_period_from2 = insurance_period_from2.split("/").reverse().join("-");
        var newinsurance_period_to2 = insurance_period_to2.split("/").reverse().join("-");
        var days=daysBetween(newinsurance_period_from2, newinsurance_period_to2);
        var sum = isNaN(days / 365) ? 0 :(days / 365).toFixed(9);
        // var constday = days.toString() + "/365";
        var constday1 = days.toString();
        var constday2;
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
        var year = parseInt(fulltgl.substring(6,12));
        console.log('ini thn' + year)
            if(year%4 == 0){
                constday2 = "366";
            }else{
                constday2 = "365";
            }

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
            $('#slipiptoupdate').val("");
            $('#sliprptoupdate').val("");
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
            var sum = isNaN(days / 365) ? 0 :(days / 365).toFixed(9);
            // var constday = days.toString() + "/365";
            var constday1 = days.toString();
            var constday2;
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
            var year = parseInt(fulltgl.substring(6,12));
            console.log('ini thn' + year)
            if(year%4 == 0){
                constday2 = "366";
            }else{
                constday2 = "365";
            }

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
            var sum = isNaN(days / 365) ? 0 :(days / 365).toFixed(9);
            // var constday = days.toString() + "/365";
            var constday1 = days.toString();
            var constday2;
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
            var year = parseInt(fulltgl.substring(6,12));
            console.log('ini thn' + year)
            if(year%4 == 0){
                constday2 = "366";
            }else{
                constday2 = "365";
            }

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
        var year = parseInt(fulltgl.substring(6,12));
        console.log('ini thn' + year)
            if(year%4 == 0){
                constday2 = "366";
            }else{
                constday2 = "365";
            }

        if (tgl < 1 || tgl > 31 || month < 1 || month > 12) {
            swal("Warning","Date Format not valid, Please check again","format error")
          }else if(month == 2 && tgl > 28){
            swal("Warning","Date Format not valid, Please check again","format error")
            
          }
        $('#sliptotalsumdateupdate2').trigger('change');
    });

    $('#slipiptoendorsement').change(function(){
        $('#sliprptoendorsement').val($(this).val());
        
        var insurance_period_from2 = $('#sliprpfromendorsement').val();
        var insurance_period_to2 = $('#sliprptoendorsement').val();
        var newinsurance_period_from2 = insurance_period_from2.split("/").reverse().join("-");
        var newinsurance_period_to2 = insurance_period_to2.split("/").reverse().join("-");
        var days=daysBetween(newinsurance_period_from2, newinsurance_period_to2);
        var sum = isNaN(days / 365) ? 0 :(days / 365).toFixed(9);
        // var constday = days.toString() + "/365";
        var constday1 = days.toString();
        var constday2;
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
        
        var year = parseInt(fulltgl.substring(6,12));
        console.log('ini thn' + year)
            if(year%4 == 0){
                constday2 = "366";
            }else{
                constday2 = "365";
            }

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
            $('#sliptotalsumdateendorsement').val("");
            $('#sliptotalsumdateendorsement2').val("");
            $('#slipiptoendorsement').val("");
            $('#sliprptoendorsement').val("");
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
        var sum = isNaN(days / 365) ? 0 :(days / 365).toFixed(9);
        // var constday = days.toString() + "/365";
        var constday1 = days.toString();
        var constday2;
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
        var year = parseInt(fulltgl.substring(6,12));
        console.log('ini thn' + year)
            if(year%4 == 0){
                constday2 = "366";
            }else{
                constday2 = "365";
            }

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
            $('#slipiptoendorsement').val("");
            $('#sliprptoendorsement').val("");
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
            var sum = isNaN(days / 365) ? 0 :(days / 365).toFixed(9);
            // var constday = days.toString() + "/365";
            var constday1 = days.toString();
            var constday2;
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
            var year = parseInt(fulltgl.substring(6,12));
            console.log('ini thn' + year)
            if(year%4 == 0){
                constday2 = "366";
            }else{
                constday2 = "365";
            }

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

<script type="text/javascript">
    $('#slipcedingbroker').change(function(){
        var cedbrok = $(this).val();
        var insuredid = $('#insuredIDtxt').val();
        var sliptype = $('#sliptypeform').val();  
        //alert(countryID);
        if(cedbrok){
            $.ajax({
                type:"GET",
                url:"{{url('get-ceding-detail')}}?ceding_id="+cedbrok+"&insured_id="+insuredid+"&slip_type="+sliptype,
                beforeSend: function() { $("body").addClass("loading");  },
                complete: function() {  $("body").removeClass("loading"); },
                success:function(res){  
                    console.log(res)      
                    if(res.type == 4){
                        $("#slipceding option").remove();


                        $("#slipceding").append('<option value="'+res.id+'">'+res.code+' - '+res.name+'</option>');

                        // var ceding_curr = $('#slipceding').val();
                        // var totalsum = $("#sliptotalsum").val();
                        // if(res.amountlist > 0)
                        // {
                        //     console.log('sum amount ' + res.sumamount)
                        //     var sum = res.sumamount;
                        //     var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        //     $("#sliptotalsum").val(sum);
                        //     $("#sliptotalsum2").val(sum);
                        // }
                        // else
                        // {
                        //     console.log('hasilnya ' + res)
                        // }

                        var typetsi = $('#sharetypetsi').val();

                        if(typetsi == 2){
                            var ceding_curr = $('#slipceding').val();
                            var totalsum = $("#sliptotalsum").val();
                            if(res.amountlist > 0)
                            {
                                console.log('sum amount ' + res.sumamount)
                                var sum = res.sumamount;
                                var conv_sum = parseFloat(sum).toFixed(2);
                                var real_sum = conv_sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                $("#sharetotalsum").val(conv_sum);
                                $("#sharetotalsum2").val(conv_sum);
                            }
                            else
                            {
                                console.log('hasilnya ' + res)
                            }
                        }



                    }else{
                        $("#slipceding option").remove();
                        $("#slipceding").append('<option value="#" selected disabled> select ceding </option>');
                        // $("#sliptotalsum").val('');
                        // $("#sliptotalsum2").val('');
                        if(res.ceding_list){
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
                            }else{
                                 swal("Error!", "Please insert insured first", "Get Ceding Error");

                            }
                    }
                }
            });
        }else{
            swal("Error!", "Please choose Ceding/Broker first", "Get Ceding Error");
        }   
    });

    // $('#slipceding').change(function(){
    //     var ceding = $(this).val();
    //     var insuredid = $('#insuredIDtxt').val();  
    //     if(ceding){
    //         $.ajax({
    //             type:"GET",
    //             url:"{{url('get-ceding-detail')}}?ceding_id="+ceding+"&insured_id="+insuredid,
    //             beforeSend: function() { $("body").addClass("loading");  },
    //             complete: function() {  $("body").removeClass("loading"); },
    //             success:function(res){  
    //                 console.log(res)      
    //                 if(res.type == 4){
    //                 // $("#slipceding option").remove();


    //                 // $("#slipceding").append('<option value="'+res.id+'">'+res.code+' - '+res.name+'</option>');
    //                 var ceding_curr = $('#slipceding').val();
    //                 var totalsum = $("#sliptotalsum").val();
    //                 // if(res.amountlist > 0)
    //                 // {
    //                 //     console.log('sum amount ' + res.sumamount)
    //                 //     var sum = res.sumamount;
    //                 //     var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    //                 //     $("#sliptotalsum").val(sum);
    //                 //     $("#sliptotalsum2").val(sum);
    //                 // }
    //                 // else
    //                 // {
    //                 //     console.log('hasilnya ' + res)
    //                 // }
    //                 var typetsi = $('#sharetypetsi').val();

    //                     if(typetsi == 2){
    //                         var ceding_curr = $('#slipceding').val();
    //                         var totalsum = $("#sliptotalsum").val();
    //                         if(res.amountlist > 0)
    //                         {
    //                             console.log('sum amount ' + res.sumamount)
    //                             var sum = res.sumamount;
    //                             var conv_sum = parseFloat(sum).toFixed(2);
    //                             var real_sum = conv_sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    //                             $("#sharetotalsum").val(real_sum);
    //                             $("#sharetotalsum2").val(real_sum);
    //                         }
    //                         else
    //                         {
    //                             console.log('hasilnya ' + res)
    //                         }
    //                     }
                    

    //             }else{
    //                 $("#slipceding option").remove();

    //                 $.each(res,function(key,value){
    //                    $("#slipceding").append('<option value="'+value.ceding_id+'">'+value.code+' - '+value.name+'</option>');

    //                });
    //             }
    //         }
    //     });
    //     }else{
    //         swal("Error!", "Please choose Ceding/Broker first", "Get Ceding Error");
    //     }   
    // });
</script>

<script type="text/javascript">
    $('#slipcedingbrokerupdate').change(function(){
        var cedbrok = $(this).val();
        var insuredid = $('#insuredIDtxt').val();  
        //alert(countryID);
        if(cedbrok){
            $.ajax({
                type:"GET",
                url:"{{url('get-ceding-detail')}}?ceding_id="+cedbrok+"&insured_id="+insuredid,
                beforeSend: function() { $("body").addClass("loading");  },
                complete: function() {  $("body").removeClass("loading"); },
                success:function(res){  
                    console.log(res)      
                    if(res.type == 4){
                        $("#slipcedingupdate option").remove();


                        $("#slipcedingupdate").append('<option value="'+res.id+'">'+res.code+' - '+res.name+'</option>');

                        // var ceding_curr = $('#slipceding').val();
                        // var totalsum = $("#sliptotalsum").val();
                        // if(res.amountlist > 0)
                        // {
                        //     console.log('sum amount ' + res.sumamount)
                        //     var sum = res.sumamount;
                        //     var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        //     $("#sliptotalsum").val(real_sum);
                        //     $("#sliptotalsum2").val(real_sum);
                        // }
                        // else
                        // {
                        //     console.log('hasilnya ' + res)
                        // }

                        var typetsi = $('#sharetypetsiupdate').val();

                        if(typetsi == 2){
                            var ceding_curr = $('#slipcedingupdate').val();
                            var totalsum = $("#sliptotalsumupdate").val();
                            if(res.amountlist > 0)
                            {
                                console.log('sum amount ' + res.sumamount)
                                var sum = res.sumamount;
                                var conv_sum = parseFloat(sum);
                                var real_sum = conv_sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                $("#sharetotalsumupdate").val(conv_sum);
                                $("#sharetotalsumupdate2").val(conv_sum);
                            }
                            else
                            {
                                console.log('hasilnya ' + res)
                            }
                        }



                    }else{
                        $("#slipcedingupdate option").remove();
                        $("#slipcedingupdate").append('<option value="#" selected disabled> select ceding </option>');
                        // $("#sliptotalsum").val('');
                        // $("#sliptotalsum2").val('');
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
                                 swal("Error!", "Please insert insured first", "warning");

                            }
                    }
                }
            });
        }else{
            swal("Error!", "Please choose Ceding/Broker first", "warning");
        }   
    });

    $('#slipcedingupdate').change(function(){
        var ceding = $(this).val();
        var insuredid = $('#insuredIDtxt').val();  
        if(ceding){
            $.ajax({
                type:"GET",
                url:"{{url('get-ceding-detail')}}?ceding_id="+ceding+"&insured_id="+insuredid,
                beforeSend: function() { $("body").addClass("loading");  },
                complete: function() {  $("body").removeClass("loading"); },
                success:function(res){  
                    console.log(res)      
                    if(res.type == 4){
                    // $("#slipceding option").remove();


                    $("#slipcedingupdate").append('<option value="'+res.id+'">'+res.code+' - '+res.name+'</option>');
                    var ceding_curr = $('#slipcedingupdate').val();
                    var totalsum = $("#sliptotalsumupdate").val();
                    // if(res.amountlist > 0)
                    // {
                    //     console.log('sum amount ' + res.sumamount)
                    //     var sum = res.sumamount;
                    //     var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    //     $("#sliptotalsum").val(real_sum);
                    //     $("#sliptotalsum2").val(real_sum);
                    // }
                    // else
                    // {
                    //     console.log('hasilnya ' + res)
                    // }
                    var typetsi = $('#sharetypetsiupdate').val();

                        if(typetsi == 2){
                            var ceding_curr = $('#slipcedingupdate').val();
                            var totalsum = $("#sliptotalsumupdate").val();
                            if(res.amountlist > 0)
                            {
                                console.log('sum amount ' + res.sumamount)
                                var sum = res.sumamount;
                                var conv_sum = parseFloat(sum);
                                var real_sum = conv_sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                $("#sharetotalsumupdate").val(conv_sum);
                                $("#sharetotalsumupdate2").val(conv_sum);
                            }
                            else
                            {
                                console.log('hasilnya ' + res)
                            }
                        }
                    

                }else{
                    $("#slipcedingupdate option").remove();

                    $.each(res,function(key,value){
                       $("#slipcedingupdate").append('<option value="'+value.ceding_id+'">'+value.code+' - '+value.name+'</option>');

                   });
                }
            }
        });
        }else{
            swal("Error!", "Please choose Ceding/Broker first", "Get Ceding Error");
        }   
    });
</script>

<script type="text/javascript">
    $('#slipcedingbrokerendorsement').change(function(){
        var cedbrok = $(this).val();
        var insuredid = $('#insuredIDtxt').val();  
        //alert(countryID);
        if(cedbrok){
            $.ajax({
                type:"GET",
                url:"{{url('get-ceding-detail')}}?ceding_id="+cedbrok+"&insured_id="+insuredid,
                beforeSend: function() { $("body").addClass("loading");  },
                complete: function() {  $("body").removeClass("loading"); },
                success:function(res){  
                    console.log(res)      
                    if(res.type == 4){
                        $("#slipcedingendorsement option").remove();


                        $("#slipcedingendorsement").append('<option value="'+res.id+'">'+res.code+' - '+res.name+'</option>');

                        // var ceding_curr = $('#slipceding').val();
                        // var totalsum = $("#sliptotalsum").val();
                        // if(res.amountlist > 0)
                        // {
                        //     console.log('sum amount ' + res.sumamount)
                        //     var sum = res.sumamount;
                        //     var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        //     $("#sliptotalsum").val(real_sum);
                        //     $("#sliptotalsum2").val(real_sum);
                        // }
                        // else
                        // {
                        //     console.log('hasilnya ' + res)
                        // }

                        var typetsi = $('#sharetypetsiendorsement').val();

                        if(typetsi == 2){
                            var ceding_curr = $('#slipcedingendorsement').val();
                            var totalsum = $("#sliptotalsumendorsement").val();
                            if(res.amountlist > 0)
                            {
                                console.log('sum amount ' + res.sumamount)
                                var sum = res.sumamount;
                                var conv_sum = parseFloat(sum).toFixed(2);
                                var real_sum = conv_sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                $("#sharetotalsumendorsement").val(conv_sum);
                                $("#sharetotalsumendorsement2").val(conv_sum);
                            }
                            else
                            {
                                console.log('hasilnya ' + res)
                            }
                        }



                    }else{
                        $("#slipcedingendorsement option").remove();
                        $("#slipcedingendorsement").append('<option value="#" selected disabled> select ceding </option>');
                        // $("#sliptotalsum").val('');
                        // $("#sliptotalsum2").val('');
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
        }else{
            swal("Error!", "Please choose Ceding/Broker first", "Get Ceding Error");
        }   
    });

    $('#slipcedingendorsement').change(function(){
        var ceding = $(this).val();
        var insuredid = $('#insuredIDtxt').val();  
        if(ceding){
            $.ajax({
                type:"GET",
                url:"{{url('get-ceding-detail')}}?ceding_id="+ceding+"&insured_id="+insuredid,
                beforeSend: function() { $("body").addClass("loading");  },
                complete: function() {  $("body").removeClass("loading"); },
                success:function(res){  
                    console.log(res)      
                    if(res.type == 4){
                    // $("#slipceding option").remove();


                    $("#slipcedingendorsement").append('<option value="'+res.id+'">'+res.code+' - '+res.name+'</option>');
                    var ceding_curr = $('#slipcedingendorsement').val();
                    var totalsum = $("#sliptotalsumendorsement").val();
                    // if(res.amountlist > 0)
                    // {
                    //     console.log('sum amount ' + res.sumamount)
                    //     var sum = res.sumamount;
                    //     var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    //     $("#sliptotalsum").val(real_sum);
                    //     $("#sliptotalsum2").val(real_sum);
                    // }
                    // else
                    // {
                    //     console.log('hasilnya ' + res)
                    // }
                    var typetsi = $('#sharetypetsiendorsement').val();

                        if(typetsi == 2){
                            var ceding_curr = $('#slipcedingendorsement').val();
                            var totalsum = $("#sliptotalsumendorsement").val();
                            if(res.amountlist > 0)
                            {
                                console.log('sum amount ' + res.sumamount)
                                var sum = res.sumamount;
                                var conv_sum = parseFloat(sum).toFixed(2);
                                var real_sum = conv_sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                $("#sharetotalsumendorsement").val(conv_sum);
                                $("#sharetotalsumendorsement2").val(conv_sum);
                            }
                            else
                            {
                                console.log('hasilnya ' + res)
                            }
                        }
                    

                }else{
                    $("#slipcedingendorsement option").remove();

                    $.each(res,function(key,value){
                       $("#slipcedingendorsement").append('<option value="'+value.ceding_id+'">'+value.code+' - '+value.name+'</option>');

                   });
                }
            }
        });
        }else{
            swal("Error!", "Please choose Ceding/Broker first", "Get Ceding Error");
        }   
    });
</script>

<script type="text/javascript">
    $('#slipoccupacy').change(function(){
        var bld = $('#slipbld_const').val();
        var ocp_id = $('#slipoccupacy').val();
        console.log("build const " + bld)
        console.log("occupation id " + ocp_id)
        if(bld != ''){
            if(ocp_id){
                $.ajax({
                    type:"GET",
                    url:"{{url('get-building-rate')}}",
                    data: {
                        building: bld,
                        occupacy_id:ocp_id
                    },
                    beforeSend: function() { $("body").addClass("loading");  },
                    complete: function() {  $("body").removeClass("loading"); },
                    success:function(res){  
                        console.log(res)      
                        console.log(bld)      
                        if(res.rate_batas_atas_building_class_1 && res.rate_batas_bawah_building_class_1){
                            if(res.rate_batas_atas_building_class_1 != null){
                                $("#slipbcua").val(res.rate_batas_atas_building_class_1);
                            }else{
                                $("#slipbcua").val("0");
                            }
                            
                            if(res.rate_batas_bawah_building_class_1 != null){
                                $("#slipbcla").val(res.rate_batas_bawah_building_class_1);
                            }else{
                                $("#slipbcla").val("0");
                            }
                            

                        }
                        else if(res.rate_batas_atas_building_class_2 && res.rate_batas_bawah_building_class_2){
                            if(res.rate_batas_atas_building_class_2 != null){
                                $("#slipbcua").val(res.rate_batas_atas_building_class_2);
                            }else{
                                $("#slipbcua").val("0");
                            }
                            
                            if(res.rate_batas_bawah_building_class_2 != null){
                                $("#slipbcla").val(res.rate_batas_bawah_building_class_2);
                            }else{
                                $("#slipbcla").val("0");
                            }
                            
                        }
                        else if(res.rate_batas_atas_building_class_3 && res.rate_batas_bawah_building_class_3){
                            if(res.rate_batas_atas_building_class_3 != null){
                                $("#slipbcua").val(res.rate_batas_atas_building_class_3); 
                            }else{
                                $("#slipbcua").val( "0");
                            }
                            
                            if(res.rate_batas_bawah_building_class_3 != null){
                                $("#slipbcla").val(res.rate_batas_bawah_building_class_3);
                            }else{
                                $("#slipbcla").val( "0");
                            }
                            
                            
                        }else{
                            if(res.rate_batas_atas_building_class_1){
                                $("#slipbcua").val(res.rate_batas_atas_building_class_1); 
                                $("#slipbcla").val( "0");
                            }else if(res.rate_batas_bawah_building_class_1){
                                $("#slipbcla").val(res.rate_batas_bawah_building_class_1); 
                                $("#slipbcua").val( "0");
                            }else if(res.rate_batas_atas_building_class_2){
                                $("#slipbcua").val(res.rate_batas_atas_building_class_2); 
                                $("#slipbcla").val( "0");
                            }else if(res.rate_batas_bawah_building_class_2){
                                $("#slipbcla").val(res.rate_batas_bawah_building_class_2); 
                                $("#slipbcua").val( "0");
                            }else if(res.rate_batas_atas_building_class_3){
                                $("#slipbcua").val(res.rate_batas_atas_building_class_3); 
                                $("#slipbcla").val( "0");
                            }else if(res.rate_batas_bawah_building_class_3){
                                $("#slipbcla").val(res.rate_batas_bawah_building_class_3); 
                                $("#slipbcua").val( "0");
                            }else{
                                // $("#slipbcla").val(""); 
                                // $("#slipbcua").val("");

                                $("#slipbcla").val("0"); 
                                $("#slipbcua").val("0");
                            }
                        }
                    }
                });
            }else{
                swal("Error!", "Please choose occupacy first", "Get Building Rate Error");
            }   
        }else{

        }
    });
</script>

<script type="text/javascript">
    $('#slipoccupacyupdate').change(function(){
         var bld = $('#slipbld_constupdate').val();
        var ocp_id = $('#slipoccupacyupdate').val();
        console.log("build const " + bld)
        console.log("occupation id " + ocp_id)
        if(bld != ''){


            if(ocp_id){
                $.ajax({
                    type:"GET",
                    url:"{{url('get-building-rate')}}",
                    data: {
                        building: bld,
                        occupacy_id:ocp_id
                    },
                    beforeSend: function() { $("body").addClass("loading");  },
                    complete: function() {  $("body").removeClass("loading"); },
                    success:function(res){  
                        console.log(res)      
                        console.log(bld)      
                        if(res.rate_batas_atas_building_class_1 && res.rate_batas_bawah_building_class_1){
                            if(res.rate_batas_atas_building_class_1 != null){
                                $("#slipbcuaupdate").val(res.rate_batas_atas_building_class_1);
                            }else{
                                $("#slipbcuaupdate").val("0");
                            }
                            
                            if(res.rate_batas_bawah_building_class_1 != null){
                                $("#slipbclaupdate").val(res.rate_batas_bawah_building_class_1);
                            }else{
                                $("#slipbclaupdate").val("0");
                            }
                            

                        }
                        else if(res.rate_batas_atas_building_class_2 && res.rate_batas_bawah_building_class_2){
                            if(res.rate_batas_atas_building_class_2 != null){
                                $("#slipbcuaupdate").val(res.rate_batas_atas_building_class_2);
                            }else{
                                $("#slipbcuaupdate").val("0");
                            }
                            
                            if(res.rate_batas_bawah_building_class_2 != null){
                                $("#slipbclaupdate").val(res.rate_batas_bawah_building_class_2);
                            }else{
                                $("#slipbclaupdate").val("0");
                            }
                            
                        }
                        else if(res.rate_batas_atas_building_class_3 && res.rate_batas_bawah_building_class_3){
                            if(res.rate_batas_atas_building_class_3 != null){
                                $("#slipbcuaupdate").val(res.rate_batas_atas_building_class_3); 
                            }else{
                                $("#slipbcuaupdate").val( "0");
                            }
                            
                            if(res.rate_batas_bawah_building_class_3 != null){
                                $("#slipbclaupdate").val(res.rate_batas_bawah_building_class_3);
                            }else{
                                $("#slipbclaupdate").val( "0");
                            }
                            
                            
                        }else{
                            if(res.rate_batas_atas_building_class_1){
                                $("#slipbcuaupdate").val(res.rate_batas_atas_building_class_1); 
                                $("#slipbclaupdate").val( "0");
                            }else if(res.rate_batas_bawah_building_class_1){
                                $("#slipbclaupdate").val(res.rate_batas_bawah_building_class_1); 
                                $("#slipbcuaupdate").val( "0");
                            }else if(res.rate_batas_atas_building_class_2){
                                $("#slipbcuaupdate").val(res.rate_batas_atas_building_class_2); 
                                $("#slipbclaupdate").val( "0");
                            }else if(res.rate_batas_bawah_building_class_2){
                                $("#slipbclaupdate").val(res.rate_batas_bawah_building_class_2); 
                                $("#slipbcuaupdate").val( "0");
                            }else if(res.rate_batas_atas_building_class_3){
                                $("#slipbcuaupdate").val(res.rate_batas_atas_building_class_3); 
                                $("#slipbclaupdate").val( "0");
                            }else if(res.rate_batas_bawah_building_class_3){
                                $("#slipbclaupdate").val(res.rate_batas_bawah_building_class_3); 
                                $("#slipbcuaupdate").val( "0");
                            }else{
                                $("#slipbclaupdate").val(""); 
                                $("#slipbcuaupdate").val("");

                                $("#slipbclaupdate").val("0"); 
                                $("#slipbcuaupdate").val("0");
                            }
                        }
                    }
                });
            }else{
                swal("Error!", "Please choose occupacy first", "Get Building Rate Error");
            }   
        }else{

        }
    });
</script>

<script type="text/javascript">
    $('#slipoccupacyendorsement').change(function(){
        var bld = $('#slipbld_constendorsement').val();
        var ocp_id = $('#slipoccupacyendorsement').val();
        console.log("build const " + bld)
        console.log("occupation id " + ocp_id)
        if(bld != ''){


            if(ocp_id){
                $.ajax({
                    type:"GET",
                    url:"{{url('get-building-rate')}}",
                    data: {
                        building: bld,
                        occupacy_id:ocp_id
                    },
                    beforeSend: function() { $("body").addClass("loading");  },
                    complete: function() {  $("body").removeClass("loading"); },
                    success:function(res){  
                        console.log(res)      
                        console.log(bld)      
                        if(res.rate_batas_atas_building_class_1 && res.rate_batas_bawah_building_class_1){
                            if(res.rate_batas_atas_building_class_1 != null){
                                $("#slipbcuaendorsement").val(res.rate_batas_atas_building_class_1);
                            }else{
                                $("#slipbcuaendorsement").val("0");
                            }
                            
                            if(res.rate_batas_bawah_building_class_1 != null){
                                $("#slipbclaendorsement").val(res.rate_batas_bawah_building_class_1);
                            }else{
                                $("#slipbclaendorsement").val("0");
                            }
                            

                        }
                        else if(res.rate_batas_atas_building_class_2 && res.rate_batas_bawah_building_class_2){
                            if(res.rate_batas_atas_building_class_2 != null){
                                $("#slipbcuaendorsement").val(res.rate_batas_atas_building_class_2);
                            }else{
                                $("#slipbcuaendorsement").val("0");
                            }
                            
                            if(res.rate_batas_bawah_building_class_2 != null){
                                $("#slipbclaendorsement").val(res.rate_batas_bawah_building_class_2);
                            }else{
                                $("#slipbclaendorsement").val("0");
                            }
                            
                        }
                        else if(res.rate_batas_atas_building_class_3 && res.rate_batas_bawah_building_class_3){
                            if(res.rate_batas_atas_building_class_3 != null){
                                $("#slipbcuaendorsement").val(res.rate_batas_atas_building_class_3); 
                            }else{
                                $("#slipbcuaendorsement").val( "0");
                            }
                            
                            if(res.rate_batas_bawah_building_class_3 != null){
                                $("#slipbclaendorsement").val(res.rate_batas_bawah_building_class_3);
                            }else{
                                $("#slipbclaendorsement").val( "0");
                            }
                            
                            
                        }else{
                            if(res.rate_batas_atas_building_class_1){
                                $("#slipbcuaendorsement").val(res.rate_batas_atas_building_class_1); 
                                $("#slipbclaendorsement").val( "0");
                            }else if(res.rate_batas_bawah_building_class_1){
                                $("#slipbclaendorsement").val(res.rate_batas_bawah_building_class_1); 
                                $("#slipbcuaendorsement").val( "0");
                            }else if(res.rate_batas_atas_building_class_2){
                                $("#slipbcuaendorsement").val(res.rate_batas_atas_building_class_2); 
                                $("#slipbclaendorsement").val( "0");
                            }else if(res.rate_batas_bawah_building_class_2){
                                $("#slipbclaendorsement").val(res.rate_batas_bawah_building_class_2); 
                                $("#slipbcuaendorsement").val( "0");
                            }else if(res.rate_batas_atas_building_class_3){
                                $("#slipbcuaendorsement").val(res.rate_batas_atas_building_class_3); 
                                $("#slipbclaendorsement").val( "0");
                            }else if(res.rate_batas_bawah_building_class_3){
                                $("#slipbclaendorsement").val(res.rate_batas_bawah_building_class_3); 
                                $("#slipbcuaendorsement").val( "0");
                            }else{
                                $("#slipbclaendorsement").val(""); 
                                $("#slipbcuaendorsement").val("");

                                $("#slipbclaendorsement").val("0"); 
                                $("#slipbcuaendorsement").val("0");
                            }   
                        }
                    }
                });
            }else{
                swal("Error!", "Please choose occupacy first", "Get Building Rate Error");
            }   
        }else{

        }
    });
</script>

<script type="text/javascript">
    $('#slipbld_const').change(function(){
        var bld = $(this).val();
        var ocp_id = $('#slipoccupacy').val();
        // alert(bld);
        console.log( "build const " + bld)
        console.log("occupation " + ocp_id)

        var bcla = $('#slipbcla');
        var bcua = $('#slipbcua');

        if(ocp_id){
            $.ajax({
                type:"GET",
                url:"{{url('get-building-rate')}}",
                data: {
                    building: bld,
                    occupacy_id:ocp_id
                },
                beforeSend: function() { $("body").addClass("loading");  },
                complete: function() {  $("body").removeClass("loading"); },
                success:function(res){  
                    console.log(res)      
                    console.log(bld)

                    if(res.rate_batas_atas_building_class_1 && res.rate_batas_bawah_building_class_1){
                        if(res.rate_batas_atas_building_class_1 == null || res.rate_batas_atas_building_class_1 == ""){
                            $("#slipbcua").val("0");
                        }else{
                            $("#slipbcua").val(res.rate_batas_atas_building_class_1);

                        }
                        
                        if(res.rate_batas_bawah_building_class_1 == null || res.rate_batas_bawah_building_class_1 == ""){
                            $("#slipbcla").val("0");
                        }else{
                            $("#slipbcla").val(res.rate_batas_bawah_building_class_1);

                        }
                        

                    }
                    else if(res.rate_batas_atas_building_class_2 && res.rate_batas_bawah_building_class_2){
                        if(res.rate_batas_atas_building_class_2 == null || res.rate_batas_atas_building_class_2 == ""){
                            $("#slipbcua").val('0');
                        }else{
                            $("#slipbcua").val(res.rate_batas_atas_building_class_2);

                        }
                        
                        if(res.rate_batas_bawah_building_class_2 == null || res.rate_batas_bawah_building_class_2 == ""){
                            $("#slipbcla").val('0');
                        }else{
                            $("#slipbcla").val(res.rate_batas_bawah_building_class_2);

                        }
                        
                    }
                    else if(res.rate_batas_atas_building_class_3 && res.rate_batas_bawah_building_class_3){
                        if(res.rate_batas_atas_building_class_3 == null || res.rate_batas_atas_building_class_3 == ""){
                            $("#slipbcua").val( '0'); 
                        }else{
                            $("#slipbcua").val(res.rate_batas_atas_building_class_3);

                        }
                        
                        if(res.rate_batas_bawah_building_class_3 == null || res.rate_batas_bawah_building_class_3 == ""){
                            $("#slipbcla").val('0');
                        }else{
                            $("#slipbcla").val(res.rate_batas_bawah_building_class_3);

                        }
                        
                        
                    }else{
                        if(res.rate_batas_atas_building_class_1){
                            $("#slipbcua").val(res.rate_batas_atas_building_class_1); 
                            $("#slipbcla").val("0");
                        }else if(res.rate_batas_bawah_building_class_1){
                            $("#slipbcla").val(res.rate_batas_bawah_building_class_1); 
                            $("#slipbcua").val("0");
                        }else if(res.rate_batas_atas_building_class_2){
                            $("#slipbcua").val(res.rate_batas_atas_building_class_2); 
                            $("#slipbcla").val("0");
                        }else if(res.rate_batas_bawah_building_class_2){
                            $("#slipbcla").val(res.rate_batas_bawah_building_class_2); 
                            $("#slipbcua").val("0");
                        }else if(res.rate_batas_atas_building_class_3){
                            $("#slipbcua").val(res.rate_batas_atas_building_class_3); 
                            $("#slipbcla").val("0");
                        }else if(res.rate_batas_bawah_building_class_3){
                            $("#slipbcla").val(res.rate_batas_bawah_building_class_3); 
                            $("#slipbcua").val("0");
                        }else{
                            $("#slipbcla").val(""); 
                            $("#slipbcua").val("");

                            $("#slipbcla").val("0"); 
                            $("#slipbcua").val("0");
                        }
                    }
                }
            });
        }else{
            swal("Error!", "Please choose occupacy first", "Get Building Rate Error");
        }   
    });

    $('#slipbld_constupdate').change(function(){
        var bld = $(this).val();
        var ocp_id = $('#slipoccupacyupdate').val();
        // alert(bld);
        console.log(bld)
        console.log(ocp_id)

        var bcla = $('#slipbclaupdate');
        var bcua = $('#slipbcuaupdate');

        if(ocp_id){
            $.ajax({
                type:"GET",
                url:"{{url('get-building-rate')}}",
                data: {
                    building: bld,
                    occupacy_id:ocp_id
                },
                beforeSend: function() { $("body").addClass("loading");  },
                complete: function() {  $("body").removeClass("loading"); },
                success:function(res){  
                    console.log(res)      
                    console.log(bld)

                    if(bcla != "" || bcua != ""){
                        $('#slipbclaupdate').val("");
                        $('#slipbcuaupdate').val("");
                    }

                    if(res.rate_batas_atas_building_class_1){
                        if(res.rate_batas_atas_building_class_1 == ' ' || res.rate_batas_atas_building_class_1 == 0.000 || res.rate_batas_atas_building_class_1 == null){
                            $("#slipbcuaupdate").val( "0");
                        }else{
                            $("#slipbcuaupdate").val(res.rate_batas_atas_building_class_1);
                        }
                        
                        if(res.rate_batas_bawah_building_class_1 == ' ' || res.rate_batas_bawah_building_class_1 == 0.000 || res.rate_batas_bawah_building_class_1 == null){
                            $("#slipbclaupdate").val( "0");
                        }else{
                            $("#slipbclaupdate").val(res.rate_batas_bawah_building_class_1);
                        }
                        

                    }
                    else if(res.rate_batas_atas_building_class_2){
                        if(res.rate_batas_atas_building_class_2 == ' ' || res.rate_batas_atas_building_class_2 == 0.000 || res.rate_batas_atas_building_class_2 == null){
                            $("#slipbcuaupdate").val( "0");
                        }else{
                            $("#slipbcuaupdate").val(res.rate_batas_atas_building_class_2);
                        }
                        
                        if(res.rate_batas_bawah_building_class_2 == ' ' || res.rate_batas_bawah_building_class_2 == 0.000 || res.rate_batas_bawah_building_class_2 == null){
                            $("#slipbclaupdate").val( "0");
                        }else{
                            $("#slipbclaupdate").val(res.rate_batas_bawah_building_class_2);
                        }
                        
                    }
                    else if(res.rate_batas_atas_building_class_3){
                        if(res.rate_batas_atas_building_class_3 == ' ' || res.rate_batas_atas_building_class_3 == 0.000 || res.rate_batas_atas_building_class_3 == null){
                            $("#slipbcuaupdate").val( "0");
                        }else{
                            $("#slipbcuaupdate").val(res.rate_batas_atas_building_class_3);
                        }
                        
                        if(res.rate_batas_bawah_building_class_3 == ' ' || res.rate_batas_bawah_building_class_3 == 0.000 || res.rate_batas_bawah_building_class_3 == null){
                            $("#slipbclaupdate").val( "0");
                        }else{
                            $("#slipbclaupdate").val(res.rate_batas_bawah_building_class_3);
                        }
                        
                        
                    }else{
                        if(res.rate_batas_atas_building_class_1){
                            $("#slipbcuaupdate").val(res.rate_batas_atas_building_class_1); 
                            $("#slipbclaupdate").val( "0");
                        }else if(res.rate_batas_bawah_building_class_1){
                            $("#slipbclaupdate").val(res.rate_batas_bawah_building_class_1); 
                            $("#slipbcuaupdate").val( "0");
                        }else if(res.rate_batas_atas_building_class_2){
                            $("#slipbcuaupdate").val(res.rate_batas_atas_building_class_2); 
                            $("#slipbclaupdate").val( "0");
                        }else if(res.rate_batas_bawah_building_class_2){
                            $("#slipbclaupdate").val(res.rate_batas_bawah_building_class_2); 
                            $("#slipbcuaupdate").val( "0");
                        }else if(res.rate_batas_atas_building_class_3){
                            $("#slipbcuaupdate").val(res.rate_batas_atas_building_class_3); 
                            $("#slipbclaupdate").val( "0");
                        }else if(res.rate_batas_bawah_building_class_3){
                            $("#slipbclaupdate").val(res.rate_batas_bawah_building_class_3); 
                            $("#slipbcuaupdate").val( "0");
                        }else{
                            $("#slipbclaupdate").val(""); 
                            $("#slipbcuaupdate").val("");

                            $("#slipbclaupdate").val("0"); 
                            $("#slipbcuaupdate").val("0");
                        }
                    }
                }
            });
        }else{
            swal("Error!", "Please choose occupacy first", "Get Building Rate Error");
        }   
    });

    $('#slipbld_constendorsement').change(function(){
        var bld = $(this).val();
        var ocp_id = $('#slipoccupacyendorsement').val();
        // alert(bld);
        console.log(bld)
        console.log(ocp_id)

        if(ocp_id){
            $.ajax({
                type:"GET",
                url:"{{url('get-building-rate')}}",
                data: {
                    building: bld,
                    occupacy_id:ocp_id
                },
                beforeSend: function() { $("body").addClass("loading");  },
                complete: function() {  $("body").removeClass("loading"); },
                success:function(res){  
                    console.log(res)      
                    console.log(bld)      
                    if(res.rate_batas_atas_building_class_1){
                        if(res.rate_batas_atas_building_class_1 == ' ' || res.rate_batas_atas_building_class_1 == 0.000){
                            $("#slipbcuaendorsement").val( "0");
                        }else{
                            $("#slipbcuaendorsement").val(res.rate_batas_atas_building_class_1);
                        }
                        
                        if(res.rate_batas_bawah_building_class_1 == ' ' || res.rate_batas_bawah_building_class_1 == 0.000){
                            $("#slipbclaendorsement").val( "0");
                        }else{
                            $("#slipbclaendorsement").val(res.rate_batas_bawah_building_class_1);
                        }
                        

                    }
                    else if(res.rate_batas_atas_building_class_2){
                        if(res.rate_batas_atas_building_class_2 == ' ' || res.rate_batas_atas_building_class_2 == 0.000){
                            $("#slipbcuaendorsement").val( "0");
                        }else{
                            $("#slipbcuaendorsement").val(res.rate_batas_atas_building_class_2);
                        }
                        
                        if(res.rate_batas_bawah_building_class_2 == ' ' || res.rate_batas_bawah_building_class_2 == 0.000){
                            $("#slipbclaendorsement").val( "0");
                        }else{
                            $("#slipbclaendorsement").val(res.rate_batas_bawah_building_class_2);
                        }
                        
                    }
                    else if(res.rate_batas_atas_building_class_3){
                        if(res.rate_batas_atas_building_class_3 == ' ' || res.rate_batas_atas_building_class_3 == 0.000){
                            $("#slipbcuaendorsement").val( "0");
                        }else{
                            $("#slipbcuaendorsement").val(res.rate_batas_atas_building_class_3);
                        }
                        
                        if(res.rate_batas_bawah_building_class_3 == ' ' || res.rate_batas_bawah_building_class_3 == 0.000){
                            $("#slipbclaendorsement").val( "0");
                        }else{
                            $("#slipbclaendorsement").val(res.rate_batas_bawah_building_class_3);
                        }
                        
                        
                    }else{
                        if(res.rate_batas_atas_building_class_1){
                            $("#slipbcuaendorsement").val(res.rate_batas_atas_building_class_1); 
                            $("#slipbclaendorsement").val( "0");
                        }else if(res.rate_batas_bawah_building_class_1){
                            $("#slipbclaendorsement").val(res.rate_batas_bawah_building_class_1); 
                            $("#slipbcuaendorsement").val( "0");
                        }else if(res.rate_batas_atas_building_class_2){
                            $("#slipbcuaendorsement").val(res.rate_batas_atas_building_class_2); 
                            $("#slipbclaendorsement").val( "0");
                        }else if(res.rate_batas_bawah_building_class_2){
                            $("#slipbclaendorsement").val(res.rate_batas_bawah_building_class_2); 
                            $("#slipbcuaendorsement").val( "0");
                        }else if(res.rate_batas_atas_building_class_3){
                            $("#slipbcuaendorsement").val(res.rate_batas_atas_building_class_3); 
                            $("#slipbclaendorsement").val( "0");
                        }else if(res.rate_batas_bawah_building_class_3){
                            $("#slipbclaendorsement").val(res.rate_batas_bawah_building_class_3); 
                            $("#slipbcuaendorsement").val( "0");
                        }else{
                            $("#slipbclaendorsement").val(""); 
                            $("#slipbcuaendorsement").val("");

                            $("#slipbclaendorsement").val("0"); 
                            $("#slipbcuaendorsement").val("0");
                        }
                    }
                }
            });
        }else{
            swal("Error!", "Please choose occupacy first", "Get Building Rate Error");
        }   
    });

</script>


{{-- first tab end --}}

{{-- second tab form--}}
<script type="text/javascript">
    $('#sliptd2').keyup(function(){
        $('#sliptd').val($(this).val());
    });

    $('#sliptd2').change(function(){
        $('#sliptd').val($(this).val());
    });

    $('#slipprodyear2').keyup(function(){
        $('#slipprodyear').val($(this).val());
    });

    $('#slipprodyear2').change(function(){
        $('#slipprodyear').val($(this).val());
    });
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

       
       $('#slipprodyear').datepicker({
           dateFormat: 'dd/mm/yy',
           changeYear: true,
           yearRange: '-50:+100',
       });

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
            var sum = isNaN(days / 365) ? 0 :(days / 365).toFixed(9);
            // var constday = days.toString() + "/365";
            var constday1 = days.toString();
            var constday2;
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
            var year = parseInt(fulltgl.substring(6,12));
            console.log('ini thn' + year)
            if(year%4 == 0){
                constday2 = "366";
            }else{
                constday2 = "365";
            }

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
        var year = parseInt(fulltgl.substring(6,12));
        console.log('ini thn' + year)
            if(year%4 == 0){
                constday2 = "366";
            }else{
                constday2 = "365";
            }

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
        var sum = isNaN(days / 365) ? 0 :(days / 365).toFixed(9);
        // var constday = days.toString() + "/365";
        var constday1 = days.toString();
        var constday2;
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
        
        var year = parseInt(fulltgl.substring(6,12));
        console.log('ini thn' + year)
            if(year%4 == 0){
                constday2 = "366";
            }else{
                constday2 = "365";
            }

        if (tgl < 1 || tgl > 31 || month < 1 || month > 12) {
            swal("Warning","Date Format not valid, Please check again","format error")
          }else if(month == 2 && tgl > 28){
            swal("Warning","Date Format not valid, Please check again","format error")
            
          } 
        
        if(sum < 0){
            swal("Warning","Insurance/Reinsurance period cannot backdate, Please check again","Date format error")
            $('#slipdaytotal').val('');
            $('#slipdaytotal2').val('');
            $('#slipdaytotal3').val('');
            $('#slipdaytotal4').val('');
            $('#sliptotalsumdate').val('');
            $('#sliptotalsumdate2').val('');
            $('#slipipto').val("");
            $('#sliprpto').val("");
        }else{
            $('#slipdaytotal').val(constday1);
            $('#slipdaytotal2').val(constday1);
            $('#slipdaytotal3').val(constday2);
            $('#slipdaytotal4').val(constday2);
            $('#sliptotalsumdate').val(parseFloat(sum));
            $('#sliptotalsumdate2').val(parseFloat(sum));
        }
        $('#sliptotalsumdate2').trigger('change');
        // document.getElementById("daytotal").innerHTML = "Total Days :"+days;
    });

    $('#sliprpto').change(function(){
        var insurance_period_from2 = $('#sliprpfrom').val();
        var insurance_period_to2 = $('#sliprpto').val();
        var newinsurance_period_from2 = insurance_period_from2.split("/").reverse().join("-");
        var newinsurance_period_to2 = insurance_period_to2.split("/").reverse().join("-");
        var days=daysBetween(newinsurance_period_from2, newinsurance_period_to2);
        var sum = isNaN(days / 365) ? 0 :(days / 365).toFixed(9);
        // var constday = days.toString() + "/365";
        var constday1 = days.toString();
        var constday2;
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
        var year = parseInt(fulltgl.substring(6,12));
        console.log('ini thn' + year)
            if(year%4 == 0){
                constday2 = "366";
            }else{
                constday2 = "365";
            }

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
            $('#slipipto').val("");
            $('#sliprpto').val("");
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
            var sum = isNaN(days / 365) ? 0 :(days / 365).toFixed(9);
            // var constday = days.toString() + "/365";
            var constday1 = days.toString();
            var constday2;
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
            var year = parseInt(fulltgl.substring(6,12));
            console.log('ini thn' + year)
            if(year%4 == 0){
                constday2 = "366";
            }else{
                constday2 = "365";
            }

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

        var sum = isNaN(day / 365) ? 0 :(day / 365).toFixed(9);

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

        var sum = isNaN(day / year) ? 0 :(day / year).toFixed(9);

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
            var sum = isNaN(days / 365) ? 0 :(days / 365).toFixed(9);
            // var constday = days.toString() + "/365";
            var constday1 = days.toString();
            var constday2;
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
            var year = parseInt(fulltgl.substring(6,12));
            console.log('ini thn' + year)
            if(year%4 == 0){
                constday2 = "366";
            }else{
                constday2 = "365";
            }

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
        var year = parseInt(fulltgl.substring(6,12));
        console.log('ini thn' + year)
            if(year%4 == 0){
                constday2 = "366";
            }else{
                constday2 = "365";
            }

        if (tgl < 1 || tgl > 31 || month < 1 || month > 12) {
            swal("Warning","Date Format not valid, Please check again","format error")
          }else if(month == 2 && tgl > 28){
            swal("Warning","Date Format not valid, Please check again","format error")
            
          }
          $('#sliptotalsumdateupdate2').trigger('change');
    });

    $('#slipiptoupdate').change(function(){
        $('#sliprptoupdate').val($(this).val());
        
        var insurance_period_from2 = $('#sliprpfromupdate').val();
        var insurance_period_to2 = $('#sliprptoupdate').val();
        var newinsurance_period_from2 = insurance_period_from2.split("/").reverse().join("-");
        var newinsurance_period_to2 = insurance_period_to2.split("/").reverse().join("-");
        var days=daysBetween(newinsurance_period_from2, newinsurance_period_to2);
        var sum = isNaN(days / 365) ? 0 :(days / 365).toFixed(9);
        // var constday = days.toString() + "/365";
        var constday1 = days.toString();
        var constday2;
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
        
        var year = parseInt(fulltgl.substring(6,12));
        console.log('ini thn' + year)
            if(year%4 == 0){
                constday2 = "366";
            }else{
                constday2 = "365";
            }

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
            $('#slipdaytotalupdate4').val("");
            $('#sliptotalsumdateupdate').val("");
            $('#sliptotalsumdateupdate2').val("");
            $('#slipiptoupdate').val("");
            $('#sliprptoupdate').val("");
        }else{
            $('#slipdaytotalupdate').val(constday1);
            $('#slipdaytotalupdate2').val(constday1);
            $('#slipdaytotalupdate3').val(constday2);
            $('#slipdaytotalupdate4').val(constday2);
            $('#sliptotalsumdateupdate').val(parseFloat(sum));
            $('#sliptotalsumdateupdate2').val(parseFloat(sum));
        }

        // document.getElementById("daytotal").innerHTML = "Total Days :"+days;
        $('#sliptotalsumdateupdate2').trigger('change');
    });

    $('#sliprptoupdate').change(function(){
        var insurance_period_from2 = $('#sliprpfromupdate').val();
        var insurance_period_to2 = $('#sliprptoupdate').val();
        var newinsurance_period_from2 = insurance_period_from2.split("/").reverse().join("-");
        var newinsurance_period_to2 = insurance_period_to2.split("/").reverse().join("-");
        var days=daysBetween(newinsurance_period_from2, newinsurance_period_to2);
        var sum = isNaN(days / 365) ? 0 :(days / 365).toFixed(9);
        // var constday = days.toString() + "/365";
        var constday1 = days.toString();
        var constday2;
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
        var year = parseInt(fulltgl.substring(6,12));
        console.log('ini thn' + year)
            if(year%4 == 0){
                constday2 = "366";
            }else{
                constday2 = "365";
            }

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
            $('#slipiptoupdate').val("");
            $('#sliprptoupdate').val("");
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
            var sum = isNaN(days / 365) ? 0 :(days / 365).toFixed(9);
            // var constday = days.toString() + "/365";
            var constday1 = days.toString();
            var constday2;
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
            var year = parseInt(fulltgl.substring(6,12));
            console.log('ini thn' + year)
            if(year%4 == 0){
                constday2 = "366";
            }else{
                constday2 = "365";
            }

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
            var sum = isNaN(days / 365) ? 0 :(days / 365).toFixed(9);
            // var constday = days.toString() + "/365";
            var constday1 = days.toString();
            var constday2;
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
            var year = parseInt(fulltgl.substring(6,12));
            console.log('ini thn' + year)
            if(year%4 == 0){
                constday2 = "366";
            }else{
                constday2 = "365";
            }

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
        var year = parseInt(fulltgl.substring(6,12));
        console.log('ini thn' + year)
            if(year%4 == 0){
                constday2 = "366";
            }else{
                constday2 = "365";
            }

        if (tgl < 1 || tgl > 31 || month < 1 || month > 12) {
            swal("Warning","Date Format not valid, Please check again","format error")
          }else if(month == 2 && tgl > 28){
            swal("Warning","Date Format not valid, Please check again","format error")
            
          }
          $('#sliptotalsumdateendorsement2').trigger('change');
    });

    $('#slipiptoendorsement').change(function(){
        $('#sliprptoendorsement').val($(this).val());
        
        var insurance_period_from2 = $('#sliprpfromendorsement').val();
        var insurance_period_to2 = $('#sliprptoendorsement').val();
        var newinsurance_period_from2 = insurance_period_from2.split("/").reverse().join("-");
        var newinsurance_period_to2 = insurance_period_to2.split("/").reverse().join("-");
        var days=daysBetween(newinsurance_period_from2, newinsurance_period_to2);
        var sum = isNaN(days / 365) ? 0 :(days / 365).toFixed(9);
        // var constday = days.toString() + "/365";
        var constday1 = days.toString();
        var constday2;
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
        
        var year = parseInt(fulltgl.substring(6,12));
        console.log('ini thn' + year)
            if(year%4 == 0){
                constday2 = "366";
            }else{
                constday2 = "365";
            }

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
            $('#sliptotalsumdateendorsement').val("");
            $('#sliptotalsumdateendorsement2').val("");
            $('#slipiptoendorsement').val("");
            $('#sliprptoendorsement').val("");
        }else{
            $('#slipdaytotalendorsement').val(constday1);
            $('#slipdaytotalendorsement2').val(constday1);
            $('#slipdaytotalendorsement3').val(constday2);
            $('#slipdaytotalendorsement4').val(constday2);
            $('#sliptotalsumdateendorsement').val(parseFloat(sum));
            $('#sliptotalsumdateendorsement2').val(parseFloat(sum));
        }
        
        $('#sliptotalsumdateendorsement2').trigger('change');
        // document.getElementById("daytotal").innerHTML = "Total Days :"+days;
    });

    $('#sliprptoendorsement').change(function(){
        var insurance_period_from2 = $('#sliprpfromendorsement').val();
        var insurance_period_to2 = $('#sliprptoendorsement').val();
        var newinsurance_period_from2 = insurance_period_from2.split("/").reverse().join("-");
        var newinsurance_period_to2 = insurance_period_to2.split("/").reverse().join("-");
        var days=daysBetween(newinsurance_period_from2, newinsurance_period_to2);
        var sum = isNaN(days / 365) ? 0 :(days / 365).toFixed(9);
        // var constday = days.toString() + "/365";
        var constday1 = days.toString();
        var constday2;
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
        var year = parseInt(fulltgl.substring(6,12));
        console.log('ini thn' + year)
            if(year%4 == 0){
                constday2 = "366";
            }else{
                constday2 = "365";
            }

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
            $('#slipiptoendorsement').val("");
            $('#sliprptoendorsement').val("");
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
            var sum = isNaN(days / 365) ? 0 :(days / 365).toFixed(9);
            // var constday = days.toString() + "/365";
            var constday1 = days.toString();
            var constday2;
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
            var year = parseInt(fulltgl.substring(6,12));
            console.log('ini thn' + year)
            if(year%4 == 0){
                constday2 = "366";
            }else{
                constday2 = "365";
            }

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

<script type='text/javascript'>
    $('#switch-proportional').change(function(){
        var attr = $("#btnaddlayer").attr('hidden');
        if(typeof attr !== typeof undefined && attr !== false){
            $("#btnaddlayer").removeAttr('hidden');
            $("#sliplayerproportional").removeAttr('hidden');
            $("#labelnonprop").removeAttr('hidden');
        }
        else{
            $("#btnaddlayer").attr('hidden','true');
            $("#sliplayerproportional").attr('hidden','true');
            $("#labelnonprop").attr('hidden','true');
        }
        
    });

    $('#switch-proportionaldetail').change(function(){
        var attr = $("#btnaddlayerdetail").attr('hidden');
        if(typeof attr !== typeof undefined && attr !== false){
            $("#btnaddlayerdetail").removeAttr('hidden');
            $("#sliplayerproportionaldetail").removeAttr('hidden');
            $("#labelnonpropdetail").removeAttr('hidden');
        }
        else{
            $("#btnaddlayerdetail").attr('hidden','true');
            $("#sliplayerproportionaldetail").attr('hidden','true');
            $("#labelnonpropdetail").attr('hidden','true');
        }
        
    });

    $('#switch-proportionalupdate').change(function(){
        var attr = $("#btnaddlayerupdate").attr('hidden');
        if(typeof attr !== typeof undefined && attr !== false){
            $("#btnaddlayerupdate").removeAttr('hidden');
            $("#sliplayerproportionalupdate").removeAttr('hidden');
            $("#labelnonpropupdate").removeAttr('hidden');
        }
        else{
            $("#btnaddlayerupdate").attr('hidden','true');
            $("#sliplayerproportionalupdate").attr('hidden','true');
            $("#labelnonpropupdate").attr('hidden','true');
        }
        
    });

    $('#switch-proportionalendorsement').change(function(){
        var attr = $("#btnaddlayerendorsement").attr('hidden');
        if(typeof attr !== typeof undefined && attr !== false){
            $("#btnaddlayerendorsement").removeAttr('hidden');
            $("#sliplayerproportionalendorsement").removeAttr('hidden');
            $("#labelnonpropendorsement").removeAttr('hidden');
        }
        else{
            $("#btnaddlayerendorsement").attr('hidden','true');
            $("#sliplayerproportionalendorsement").attr('hidden','true');
            $("#labelnonpropendorsement").attr('hidden','true');
        }
        
    });

    $('#sliprb').change(function(){
        var attr = $("#tabretro").attr('hidden');
        var valdata =  $('#sliprb').val();
        //alert(valdata);
        if((typeof attr !== typeof undefined && attr !== false) || valdata=="AF"){
            // $("#retrocessionPanel").removeAttr('hidden');
            $("#tabretro").removeAttr('hidden');
        }
        else{
            // $("#retrocessionPanel").attr('hidden','true');
            $("#tabretro").attr('hidden','true');
        }
    });

    $('#sliprbdetail').change(function(){
        var attr = $("#tabretrodetail").attr('hidden');
        var valdata =  $('#sliprbdetail').val();

        if((typeof attr !== typeof undefined && attr !== false ) || valdata=="AF"){
            // $("#retrocessionPanel").removeAttr('hidden');
            $("#tabretrodetail").removeAttr('hidden');
        }
        else{
            // $("#retrocessionPanel").attr('hidden','true');
            $("#tabretrodetail").attr('hidden','true');
        }
    });

    $('#sliprbupdate').change(function(){
        var attr = $("#tabretroupdate").attr('hidden');
        var valdata =  $('#sliprbupdate').val();

        if((typeof attr !== typeof undefined && attr !== false ) || valdata=="AF"){
            // $("#retrocessionPanel").removeAttr('hidden');
            $("#tabretroupdate").removeAttr('hidden');
        }
        else{
            // $("#retrocessionPanel").attr('hidden','true');
            $("#tabretroupdate").attr('hidden','true');
        }
    });

    $('#sliprbendorsement').change(function(){
        var attr = $("#tabretroendorsement").attr('hidden');
        var valdata =  $('#sliprbendorsement').val();

        if((typeof attr !== typeof undefined && attr !== false) || valdata=="AF"){
            // $("#retrocessionPanel").removeAttr('hidden');
            $("#tabretroendorsement").removeAttr('hidden');
        }
        else{
            // $("#retrocessionPanel").attr('hidden','true');
            $("#tabretroendorsement").attr('hidden','true');
        }
    });
</script>

<script type="text/javascript">
    $('#sliptypetsi').change(function(){
        var choice = $(this).val();
        var sliptype = $('#sliptypeform').val();
        var valtsi = null;
        var valcedshare = null;
        if(sliptype == 'fe'){
            valtsi = $('#feshareto').val();
            valcedshare = $('#feshare').val();
        }else if(sliptype == 'fl'){
            valtsi = $('#flshareto').val();
            valcedshare = $('#flshare').val();
        }else if(sliptype == 'hem'){
            valtsi = $('#hemshareto').val();
            valcedshare = $('#hemshare').val();
        }else if(sliptype == 'mp'){
            valtsi = $('#mpshareto').val();
            valcedshare = $('#mpshare').val();
        }else if(sliptype == 'hio'){
            valtsi = $('#hioshareto').val();
            valcedshare = $('#hioshare').val();
        }else if(sliptype == 'pa'){
            valtsi = $('#pashareto').val();
            valcedshare = $('#pashare').val();
        }else{
            valtsi = 0;
            valcedshare = 0;
        }   
        
        var insuredid = $('#insuredIDtxt').val(); 
        var cedbrok = $('#slipcedingbroker').val();
        var ceding = $('#slipceding').val();

        if(choice == '1'){
            if(valtsi == null){
                swal('warning','please fill tsi insured value first','error')
            }else{
                // var sliptype = $('#sliptypeform').val();
                var tsi = "";
                if(sliptype == 'fe'){
                    tsi = $('#feshareto').val();
                }else if(sliptype == 'fl'){
                    tsi = $('#flshareto').val();
                }else if(sliptype == 'hem'){
                    tsi = $('#hemshareto').val();
                }else if(sliptype == 'mp'){
                    tsi = $('#mpshareto').val();
                }else if(sliptype == 'hio'){
                    tsi = $('#hioshareto').val();
                }else if(sliptype == 'pa'){
                    tsi = $('#pashareto').val();
                }else{
                    tsi = "0";
                }   
                
                console.log('tsi '+ tsi)
                var int_tsi = parseFloat(tsi.replace(/,/g, ""));
                console.log('replace tsi '+ int_tsi)
                // var conv_str_tsi = int_tsi.toFixed(2);
                var real_tsi = int_tsi.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                console.log('real tsi '+real_tsi)
                $('#sliptotalsum').val(tsi);
                $('#sliptotalsum2').val(tsi);

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

                    $('#sliptotalsumpct').val(conv_sum);
                    $('#sliptotalsumpct2').val(conv_sum);
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

                    if(ecamount != null){

                        var persentage =  parseFloat($('#slipnilaiec').val()) / 1000;
                        var sum = isNaN(conv_tsi * persentage) ? 0 :(conv_tsi * persentage) ;
                        var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        console.log($('#slipnilaiec').val())
                        console.log(persentage)
                        console.log(sum)
                        console.log(real_sum)

                        $('#slipamountec').val(sum);
                        $('#slipamountec2').val(sum);

                    }

                }
            }
        }else if(choice == '2')
        {
            if(cedbrok != null && ceding != null){
                // var ceding_share = $('#feshare').val();
                // var int_ceding_share = parseInt(ceding_share.replace(/,/g, ""));
                // var conv_ceding_share = int_ceding_share.toFixed(2);
                // var real_ceding_share = conv_ceding_share.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                
                $.ajax({
                    type:"GET",
                    url:"{{url('get-ceding-detail')}}?ceding_id="+ceding+"&insured_id="+insuredid+"&slip_type="+sliptype,
                    beforeSend: function() { $("body").addClass("loading");  },
                    complete: function() {  $("body").removeClass("loading"); },
                    success:function(res){  
                        console.log(res)      
                        if(res.type == 4){
                            var ceding_curr = $('#slipceding').val();
                            var totalsum = $("#sliptotalsum").val();
                            if(res.amountlist > 0)
                            {
                                console.log('sum amount ' + res.sumamount)
                                var sum = res.sumamount;
                                var conv_sum = parseFloat(sum);
                                var real_sum = conv_sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                $("#sliptotalsum").val(conv_sum);
                                $("#sliptotalsum2").val(conv_sum);

                                var tsicedshare = $("#sliptotalsum").val();
                                var pctval = $('#sliptotalsumpct').val();

                                if(pctval != null){

                                    var pct =  parseFloat($('#slippct').val())/100;

                                    // var tsi = $("#sliptotalsum").val();
                                    var conv_tsi = parseFloat(tsicedshare.replace(/,/g, ""));

                                    var sum = isNaN(pct * conv_tsi) ? 0 :(pct * conv_tsi) ;
                                    console.log(sum)
                                    var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    $('#sliptotalsumpct').val(sum);
                                    $('#sliptotalsumpct2').val(sum);
                                    // swal('success','changed to ceding share','success')

                                    var dpamount = $('#slipdpamount').val();
                                    var ecamount = $('#slipamountec').val();

                                    if(dpamount != null){
                                        var percent =  parseFloat($('#slipdppercentage').val()) / 100;
                                        
                                        var sum = isNaN(percent * conv_tsi) ? 0 :(percent * conv_tsi);
                                        var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                        console.log($('#slipdppercentage').val())
                                        console.log(percent)
                                        console.log(sum)
                                        console.log(real_sum)

                                        $('#slipdpamount').val(sum);
                                        $('#slipdpamount2').val(sum);
                                    }

                                    if(ecamount != null){

                                        var persentage =  parseFloat($('#slipnilaiec').val()) / 1000;
                                        var sum = isNaN(conv_tsi * persentage) ? 0 :(conv_tsi * persentage);
                                        var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                        console.log($('#slipnilaiec').val())
                                        console.log(persentage)
                                        console.log(sum)
                                        console.log(real_sum)

                                        $('#slipamountec').val(sum);
                                        $('#slipamountec2').val(sum);
                                        
                                    }

                                }
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
        var sliptype = $('#sliptypeform').val();
        if(choice == '1'){
            if(sliptype == 'fe'){
                    var tsi = $('#feshareto').val();
            }else if(sliptype == 'fl'){
                var tsi = $('#flshareto').val();
            }else if(sliptype == 'hem'){
                var tsi = $('#hemshareto').val();
            }else if(sliptype == 'mp'){
                var tsi = $('#mpshareto').val();
            }else if(sliptype == 'hio'){
                var tsi = $('#hioshareto').val();
            }else if(sliptype == 'pa'){
                var tsi = $('#pashareto').val();
            }else{
                tsi = 0;
            }
            var int_tsi = parseFloat(tsi.replace(/,/g, ""));
            var conv_str_tsi = int_tsi;
            var real_tsi = int_tsi.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            $('#sharetotalsum').val(tsi);
            $('#sharetotalsum2').val(tsi);

            var shareslipval = $('#slipshare').val();
            if(shareslipval != null){
                var shareslip =  parseFloat($('#slipshare').val()) / 100 ;
                var conv_tsi = parseFloat(tsi.replace(/,/g, ""));
                var sumshare =isNaN( shareslip * conv_tsi) ? 0 :( shareslip * conv_tsi);
                var real_sumshare = sumshare.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


                $('#slipsumshare').val(sumshare);
                $('#slipsumshare2').val(sumshare);

                var rateslipval = $('#sliprate').val();

                if(sliprate != null){

                    var insurance_period_from2 = $('#sliprpfrom').val();
                    var insurance_period_to2 = $('#sliprpto').val();
                    var newinsurance_period_from2 = insurance_period_from2.split("/").reverse().join("-");
                    var newinsurance_period_to2 = insurance_period_to2.split("/").reverse().join("-");
                    var days=daysBetween(newinsurance_period_from2, newinsurance_period_to2);
                    var insurance = (days/365);
                    
                    console.log(insurance_period_from2)
                    console.log(insurance_period_to2)
                    console.log(newinsurance_period_from2)
                    console.log(newinsurance_period_to2)
                    console.log(days)
                    console.log(insurance)

                    var rateslip =  parseFloat($(this).val()) ;
                    var totalrate = $("#sliptotalrate").val();
                    var conv_totalrate = parseFloat(sumrate.replace(/,/g, ""));
                    var sumrate = isNaN(((conv_totalrate / 1000) * conv_tsi) * insurance) ? 0 :(((conv_totalrate / 1000) * conv_tsi) * insurance);
                    var real_sumrate = sumrate.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                    $('#slipbasicpremium').val(sumrate);

                    var grossprm_to_nr = $('#slipgrossprmtonr').val();

                    if(grossprm_to_nr != null){
                        // var sliptype = $('#sliptypeform');
                        if(sliptype == 'fe'){
                            var nasionalreinsurance =  $('#fesharefrom').val();
                            var totalnre =  $('#feshareto').val();
                        }else if(sliptype == 'fl'){
                            var nasionalreinsurance =  $('#flsharefrom').val();
                            var totalnre =  $('#flshareto').val();
                        }else if(sliptype == 'hem'){
                            var nasionalreinsurance =  $('#hemsharefrom').val();
                            var totalnre =  $('#hemshareto').val();
                        }else if(sliptype == 'mp'){
                            var nasionalreinsurance =  $('#mpsharefrom').val();
                            var totalnre =  $('#mpshareto').val();
                        }else if(sliptype == 'hio'){
                            var nasionalreinsurance =  $('#hiosharefrom').val();
                            var totalnre =  $('#hioshareto').val();
                        }else if(sliptype == 'pa'){
                            var nasionalreinsurance =  $('#pasharefrom').val();
                            var totalnre =  $('#pashareto').val();
                        }else{
                            var nasionalreinsurance =  "0";
                            var totalnre =  "0";
                        }
                        
                        var conv_totalnre =  parseFloat(totalnre.replace(/,/g, ""));

                        console.log('nre' + nasionalreinsurance)
                            // console.log(conv_nasionalreinsurance)
                            console.log('totalnre' + totalnre)
                            console.log('convtotnre' + conv_totalnre)
                            
                            var sumshare2 = $('#slipsumshare').val() ;
                            var conv_sumshare = parseFloat(sumshare2.replace(/,/g, ""));
                            var basic_premium = $('#slipbasicpremium').val();
                            var conv_basre = parseFloat(basic_premium.replace(/,/g, ""));

                            var orpercent = $('#slipor').val() / 100;

                            var sumor = isNaN(orpercent * conv_sumshare) ? 0 :(orpercent * conv_sumshare);
                            var real_sumor = sumor.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            
                            var sumgrtoprm = isNaN(conv_basre * shareslip) ? 0 :(conv_basre * shareslip );
                            var real_sumgrtoprm = sumgrtoprm.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            
                            if(nasionalreinsurance){
                                var conv_nasionalreinsurance =  parseFloat(nasionalreinsurance.replace(/,/g, ""));
                                var sumnre = isNaN(conv_nasionalreinsurance + conv_sumshare ) ? 0 :(conv_nasionalreinsurance + conv_sumshare);
                                var real_sumnre = sumnre.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            }else{
                                var conv_nasionalreinsurance =  parseFloat(nasionalreinsurance.replace(/,/g, ""));
                                var sumnre = isNaN(0 + conv_sumshare ) ? 0 :(0 + conv_sumshare);
                                var real_sumnre = sumnre.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            }
                            
                            
                            var sumourshare = isNaN((sumnre / conv_totalnre) * 100 ) ? 0 :((sumnre / conv_totalnre) * 100 );

                            console.log('sumnre' + sumnre)
                            console.log('realnre' + real_sumnre)
                            console.log('sumourshare' + sumourshare)

                            $('#slipgrossprmtonr').val(sumgrtoprm);
                            $('#slipgrossprmtonr2').val(sumgrtoprm);
                            $('#slipsumor').val(sumor);
                            $('#slipsumor2').val(sumor);
                            // $('#feshare').val(sumourshare.replace(/,/g, "."));
                            
                            var sliptype = $('#sliptypeform').val();
                            if(sliptype == 'fe'){
                                $('#fesharefrom').val(sumnre);
                            }else if(sliptype == 'fl'){
                                $('#flsharefrom').val(sumnre);
                            }else if(sliptype == 'hem'){
                                $('#hemsharefrom').val(sumnre);
                            }else if(sliptype == 'mp'){
                                $('#mpsharefrom').val(sumnre);
                            }else if(sliptype == 'hio'){
                                $('#hiosharefrom').val(sumnre);
                            }else if(sliptype == 'pa'){
                                $('#pasharefrom').val(sumnre);
                            }


                            var commision =  parseFloat($(this).val()) / 100;
                            var feebroker = parseFloat($('#slipvbroker').val()) / 100;
                            var sumgrossprmtonr2 = $("#slipgrossprmtonr").val();
                            var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr2.replace(/,/g, ""));

                            var sumcomm = isNaN(commision * conv_sumgrossprmtonr) ? 0 :(commision * conv_sumgrossprmtonr);
                            var real_sumcomm = sumcomm.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                            $('#slipsumcommission').val(sumcomm);
                            $('#slipsumcommission2').val(sumcomm);

                            var sumgrossprmtonr3 = $("#slipgrossprmtonr").val();
                            var conv_sumgrossprmtonr2 = parseFloat(sumgrossprmtonr3.replace(/,/g, ""));

                            var sumnetprmtonr = isNaN( conv_sumgrossprmtonr2 * (100/100 - commision - feebroker)) ? 0 :(conv_sumgrossprmtonr2 * (100/100 - commision - feebroker));
                            var real_sumnetprmtonr = sumnetprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                            var sumfeebroker = isNaN( conv_sumgrossprmtonr2 * feebroker) ? 0 :(conv_sumgrossprmtonr2 * feebroker);
                            var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


                            $('#slipnetprmtonr').val(amountToString(sumnetprmtonr));
                            $('#slipnetprmtonr2').val(amountToString(sumnetprmtonr));
                            // $('#slipsumfee').val("100" + "-" + commision.toString() + "-" + feebroker.toString() + "*" + conv_sumgrossprmtonr.toString());
                            $('#slipsumfee').val(floatToString(sumfeebroker));
                            $('#slipsumfee2').val(floatToString(sumfeebroker));

                            var sumipamountval = $('#slipipamount').val();

                            if(sumipamountval != null){
                                var percent =  parseFloat($(this).val()) / 100;

                                var sumnetprtonr2 = $("#slipnetprmtonr").val();
                                var conv_sumnetprtonr = parseFloat(sumnetprtonr2.replace(/,/g, ""));

                                var sumipamount = isNaN(percent *  conv_sumnetprtonr) ? 0 :(percent *  conv_sumnetprtonr);
                                var real_sumipamount = sumipamount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                                $('#slipipamount').val(sumipamount);
                                $('#slipipamount2').val(sumipamount);
                            }

                    }



                }

            }

            // swal('warning!','change to tsi please change installment and retrocession amount manually','success')
        }else if(choice == '2')
        {

            var insuredid = $('#insuredIDtxt').val(); 
            var cedbrok = $('#slipcedingbroker').val();
            var ceding = $('#slipceding').val();
            if(cedbrok != null && ceding != null){
                $.ajax({
                    type:"GET",
                    url:"{{url('get-ceding-detail')}}?ceding_id="+ceding+"&insured_id="+insuredid+"&slip_type="+sliptype,
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
                                var conv_sum = parseFloat(sum);
                                var real_sum = conv_sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                $("#sharetotalsum").val(conv_sum);
                                $("#sharetotalsum2").val(conv_sum);
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
           
            var sliptype = $('#sliptypeform').val();
            if(sliptype == 'fe'){
                var tsi = $('#feshare').val();
            }else if(sliptype == 'fl'){
                var tsi = $('#flshare').val();
            }else if(sliptype == 'hem'){
                var tsi = $('#hemshare').val();
            }else if(sliptype == 'mp'){
                var tsi = $('#mpshare').val();
            }else if(sliptype == 'hio'){
                var tsi = $('#hioshare').val();
            }else if(sliptype == 'pa'){
                var tsi = $('#pashare').val();
            }else{
                var tsi = "0";
            }

            $('#sharetotalsum').val(tsi);
            $('#sharetotalsum2').val(tsi);

            var shareslipval = $('#slipshare').val();
            if(shareslipval != null){
                var shareslip =  parseFloat($('#slipshare').val()) / 100 ;
                var conv_tsi = parseFloat(tsi.replace(/,/g, ""));
                var sumshare =isNaN( shareslip * conv_tsi) ? 0 :( shareslip * conv_tsi) ;
                var real_sumshare = sumshare.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


                $('#slipsumshare').val(sumshare);
                $('#slipsumshare2').val(sumshare);

                var rateslipval = $('#sliprate').val();

                if(sliprate != null){

                    var insurance_period_from2 = $('#sliprpfrom').val();
                    var insurance_period_to2 = $('#sliprpto').val();
                    var newinsurance_period_from2 = insurance_period_from2.split("/").reverse().join("-");
                    var newinsurance_period_to2 = insurance_period_to2.split("/").reverse().join("-");
                    var days=daysBetween(newinsurance_period_from2, newinsurance_period_to2);
                    var insurance = (days/365);
                    
                    console.log(insurance_period_from2)
                    console.log(insurance_period_to2)
                    console.log(newinsurance_period_from2)
                    console.log(newinsurance_period_to2)
                    console.log(days)
                    console.log(insurance)

                    var rateslip =  parseFloat($(this).val());
                     var totalrate = $("#sliptotalrate").val();
                    // var conv_totalrate = parseFloat(sumrate.replace(/,/g, ""));
                    var sumrate = isNaN(((conv_totalrate / 1000) * conv_tsi) * insurance) ? 0 :(((conv_totalrate / 1000) * conv_tsi) * insurance);
                    var real_sumrate = sumrate.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                    $('#slipbasicpremium').val(sumrate);

                    var grossprm_to_nr = $('#slipgrossprmtonr').val();

                    if(grossprm_to_nr != null){
                        

                        // var sliptype = $('#sliptypeform');
                        if(sliptype == 'fe'){
                            var nasionalreinsurance =  $('#fesharefrom').val();
                            var totalnre =  $('#feshareto').val();
                        }else if(sliptype == 'fl'){
                            var nasionalreinsurance =  $('#flsharefrom').val();
                            var totalnre =  $('#flshareto').val();
                        }else if(sliptype == 'hem'){
                            var nasionalreinsurance =  $('#hemsharefrom').val();
                            var totalnre =  $('#hemshareto').val();
                        }else if(sliptype == 'mp'){
                            var nasionalreinsurance =  $('#mpsharefrom').val();
                            var totalnre =  $('#mpshareto').val();
                        }else if(sliptype == 'hio'){
                            var nasionalreinsurance =  $('#hiosharefrom').val();
                            var totalnre =  $('#hioshareto').val();
                        }else if(sliptype == 'pa'){
                            var nasionalreinsurance =  $('#pasharefrom').val();
                            var totalnre =  $('#pashareto').val();
                        }else{
                            var nasionalreinsurance =  "0";
                            var totalnre =  "0";
                        }
                        
                        var conv_totalnre =  parseFloat(totalnre.replace(/,/g, ""));

                        console.log('nre' + nasionalreinsurance)
                            // console.log(conv_nasionalreinsurance)
                            console.log('totalnre' + totalnre)
                            console.log('convtotnre' + conv_totalnre)
                            
                            var sumshare2 = $('#slipsumshare').val() ;
                            var conv_sumshare = parseFloat(sumshare2.replace(/,/g, ""));
                            var basic_premium = $('#slipbasicpremium').val();
                            var conv_basre = parseFloat(basic_premium.replace(/,/g, ""));

                            var orpercent = $('#slipor').val() / 100;

                            var sumor = isNaN(orpercent * conv_sumshare) ? 0 :(orpercent * conv_sumshare);
                            var real_sumor = sumor.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            
                            var sumgrtoprm = isNaN(conv_basre * shareslip) ? 0 :(conv_basre * shareslip );
                            var real_sumgrtoprm = sumgrtoprm.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            
                            if(nasionalreinsurance){
                                var conv_nasionalreinsurance =  parseInt(nasionalreinsurance.replace(/,/g, "")).toFixed(2);
                                var sumnre = isNaN(conv_nasionalreinsurance + conv_sumshare ) ? 0 :(conv_nasionalreinsurance + conv_sumshare) ;
                                var real_sumnre = sumnre.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            }else{
                                var conv_nasionalreinsurance =  parseInt(nasionalreinsurance.replace(/,/g, "")).toFixed(2);
                                var sumnre = isNaN(0 + conv_sumshare ) ? 0 :(0 + conv_sumshare);
                                var real_sumnre = sumnre.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            }
                            
                            
                            var sumourshare = isNaN((sumnre / conv_totalnre) * 100 ) ? 0 :((sumnre / conv_totalnre) * 100 );

                            console.log('sumnre' + sumnre)
                            console.log('realnre' + real_sumnre)
                            console.log('sumourshare' + sumourshare)

                            $('#slipgrossprmtonr').val(sumgrtoprm);
                            $('#slipgrossprmtonr2').val(sumgrtoprm);
                            $('#slipsumor').val(sumor);
                            $('#slipsumor2').val(sumor);
                            // $('#feshare').val(sumourshare.replace(/,/g, "."));

                            

                            // var sliptype = $('#sliptypeform');
                            if(sliptype == 'fe'){
                                $('#fesharefrom').val(sumnre);
                            }else if(sliptype == 'fl'){
                                $('#flsharefrom').val(sumnre);
                            }else if(sliptype == 'hem'){
                                $('#hemsharefrom').val(sumnre);
                            }else if(sliptype == 'mp'){
                                $('#mpsharefrom').val(sumnre);
                            }else if(sliptype == 'hio'){
                                $('#hiosharefrom').val(sumnre);
                            }else if(sliptype == 'pa'){
                                $('#pasharefrom').val(sumnre);
                            }else{
                                $('#pasharefrom').val("0");
                            }


                            var commision =  parseFloat($(this).val()) / 100;
                            var feebroker = parseFloat($('#slipvbroker').val()) / 100;
                            var sumgrossprmtonr2 = $("#slipgrossprmtonr").val();
                            var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr2.replace(/,/g, ""));

                            var sumcomm = isNaN(commision * conv_sumgrossprmtonr) ? 0 :(commision * conv_sumgrossprmtonr);
                            var real_sumcomm = sumcomm.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                            $('#slipsumcommission').val(sumcomm);
                            $('#slipsumcommission2').val(sumcomm);

                            var sumgrossprmtonr3 = $("#slipgrossprmtonr").val();
                            var conv_sumgrossprmtonr2 = parseFloat(sumgrossprmtonr3.replace(/,/g, ""));

                            var sumnetprmtonr = isNaN( conv_sumgrossprmtonr2 * (100/100 - commision - feebroker)) ? 0 :(conv_sumgrossprmtonr2 * (100/100 - commision - feebroker));
                            var real_sumnetprmtonr = sumnetprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                            var sumfeebroker = isNaN( conv_sumgrossprmtonr2 * feebroker) ? 0 :(conv_sumgrossprmtonr2 * feebroker);
                            var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


                            $('#slipnetprmtonr').val(amountToString(sumnetprmtonr));
                            $('#slipnetprmtonr2').val(amountToString(sumnetprmtonr));
                            // $('#slipsumfee').val("100" + "-" + commision.toString() + "-" + feebroker.toString() + "*" + conv_sumgrossprmtonr.toString());
                            $('#slipsumfee').val(floatToString(sumfeebroker));
                            $('#slipsumfee2').val(floatToString(sumfeebroker));

                            var sumipamountval = $('#slipipamount').val();

                            if(sumipamountval != null){
                                var percent =  parseFloat($(this).val()) / 100;

                                var sumnetprtonr2 = $("#slipnetprmtonr").val();
                                var conv_sumnetprtonr = parseFloat(sumnetprtonr2.replace(/,/g, ""));

                                var sumipamount = isNaN(percent *  conv_sumnetprtonr) ? 0 :(percent *  conv_sumnetprtonr);
                                var real_sumipamount = sumipamount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                                $('#slipipamount').val(sumipamount);
                                $('#slipipamount2').val(sumipamount);
                            }

                    }



                }

            }

            // swal('warning!','change to ceding share please change installment and retrocession amount manually','success')

        }
    });
</script>

<script type="text/javascript">
    $('#sliptypetsiendorsement').change(function(){
        var choice = $(this).val();
        
        var sliptype = $('#sliptypeform').val();
        if(sliptype == 'fe'){
            var valtsi = $('#feshareto').val();
            var valcedshare = $('#feshare').val();
        }else if(sliptype == 'fl'){
            var valtsi = $('#flshareto').val();
            var valcedshare = $('#flshare').val();
        }else if(sliptype == 'hem'){
            var valtsi = $('#hemshareto').val();
            var valcedshare = $('#hemshare').val();
        }else if(sliptype == 'mp'){
            var valtsi = $('#mpshareto').val();
            var valcedshare = $('#mpshare').val();
        }else if(sliptype == 'hio'){
            var valtsi = $('#hioshareto').val();
            var valcedshare = $('#hioshare').val();
        }else if(sliptype == 'pa'){
            var valtsi = $('#pashareto').val();
            var valcedshare = $('#pashare').val();
        }else{
            var valtsi = "0";
            var valcedshare = "0";
        }
        var insuredid = $('#insuredIDtxt').val(); 
        var cedbrok = $('#slipcedingbrokerendorsement').val();
        var ceding = $('#slipcedingendorsement').val();

        if(choice == '1'){
            if(valtsi == null){
                swal('warning','please fill tsi insured value first','error')
            }else{
                
                
                if(sliptype == 'fe'){
                    var tsi = $('#feshareto').val();
                }else if(sliptype == 'fl'){
                    var tsi = $('#flshareto').val();
                }else if(sliptype == 'hem'){
                    var tsi = $('#hemshareto').val();
                }else if(sliptype == 'mp'){
                    var tsi = $('#mpshareto').val();
                }else if(sliptype == 'hio'){
                    var tsi = $('#hioshareto').val();
                }else if(sliptype == 'pa'){
                    var tsi = $('#pashareto').val();
                }else{
                    var tsi = "0";
                }

                var int_tsi = parseInt(tsi.replace(/,/g, ""));
                var conv_str_tsi = int_tsi.toFixed(2);
                var real_tsi = int_tsi.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('#sliptotalsumendorsement').val(tsi);
                $('#sliptotalsumendorsement2').val(tsi);

                var tsislip = $('#sliptotalsumendorsement').val();
                var pctval = $('#slippctendorsement').val();

                if(pctval != null){
                    var pct =  parseFloat($('#slippctendorsement').val())/100;
                    var conv_tsi = parseFloat(tsi.replace(/,/g, ""));

                    var sum = isNaN(pct * conv_tsi) ? 0 :(pct * conv_tsi) ;
                    console.log('sum ' + sum)
                    var conv_sum = parseFloat(sum).toFixed(2);
                    console.log('conv_sum' + conv_sum)
                    var real_sum = conv_sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    
                    console.log('real_sum' + real_sum)

                    $('#sliptotalsumpctendorsement').val(conv_sum);
                    $('#sliptotalsumpctendorsement2').val(conv_sum);
                    // swal('success','changed to tsi','success')


                    var dpamount = $('#slipdpamountendorsement').val();
                    var ecamount = $('#slipamountecendorsement').val();

                    if(dpamount != null){

                        var percent =  parseFloat($('#slipdppercentageendorsement').val()) / 100;
                        
                        var sum = isNaN(percent * conv_tsi) ? 0 :(percent * conv_tsi).toFixed(2) ;
                        var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        console.log($('#slipdppercentageendorsement').val())
                        console.log(percent)
                        console.log(sum)
                        console.log(real_sum)

                        $('#slipdpamountendorsement').val(sum);
                        $('#slipdpamountendorsement2').val(sum);

                    }

                    if(ecamount != null){

                        var persentage =  parseFloat($('#slipnilaiecendorsement').val()) / 1000;
                        var sum = isNaN(conv_tsi * persentage) ? 0 :(conv_tsi * persentage) ;
                        var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        console.log($('#slipnilaiecendorsement').val())
                        console.log(persentage)
                        console.log(sum)
                        console.log(real_sum)

                        $('#slipamountecendorsement').val(sum);
                        $('#slipamountecendorsement2').val(sum);

                    }

                }
            }
        }else if(choice == '2')
        {
            if(cedbrok != null && ceding != null){
                // var ceding_share = $('#feshare').val();
                // var int_ceding_share = parseInt(ceding_share.replace(/,/g, ""));
                // var conv_ceding_share = int_ceding_share.toFixed(2);
                // var real_ceding_share = conv_ceding_share.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                
                $.ajax({
                    type:"GET",
                    url:"{{url('get-ceding-detail')}}?ceding_id="+ceding+"&insured_id="+insuredid,
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
                                var conv_sum = parseFloat(sum).toFixed(2);
                                var real_sum = conv_sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                $("#sliptotalsumendorsement").val(conv_sum);
                                $("#sliptotalsumendorsement2").val(conv_sum);

                                var tsicedshare = $("#sliptotalsumendorsement").val();
                                var pctval = $('#sliptotalsumpctendorsement').val();

                                if(pctval != null){

                                    var pct =  parseFloat($('#slippctendorsement').val())/100;

                                    // var tsi = $("#sliptotalsum").val();
                                    var conv_tsi = parseInt(tsicedshare.replace(/,/g, "")).toFixed(2);

                                    var sum = isNaN(pct * conv_tsi) ? 0 :(pct * conv_tsi).toFixed(2) ;
                                    console.log(sum)
                                    var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    $('#sliptotalsumpctendorsement').val(sum);
                                    $('#sliptotalsumpctendorsement2').val(sum);
                                    // swal('success','changed to ceding share','success')

                                    var dpamount = $('#slipdpamountendorsement').val();
                                    var ecamount = $('#slipamountecendorsement').val();

                                    if(dpamount != null){
                                        var percent =  parseFloat($('#slipdppercentageendorsement').val()) / 100;
                                        
                                        var sum = isNaN(percent * conv_tsi) ? 0 :(percent * conv_tsi).toFixed(2) ;
                                        var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                        console.log($('#slipdppercentageendorsement').val())
                                        console.log(percent)
                                        console.log(sum)
                                        console.log(real_sum)

                                        $('#slipdpamountendorsement').val(sum);
                                        $('#slipdpamountendorsement2').val(sum);
                                    }

                                    if(ecamount != null){

                                        var persentage =  parseFloat($('#slipnilaiecendorsement').val()) / 1000;
                                        var sum = isNaN(conv_tsi * persentage) ? 0 :(conv_tsi * persentage) ;
                                        var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                        console.log($('#slipnilaiecendorsement').val())
                                        console.log(persentage)
                                        console.log(sum)
                                        console.log(real_sum)

                                        $('#slipamountecendorsement').val(sum);
                                        $('#slipamountecendorsement2').val(sum);
                                        
                                    }

                                }
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
                swal("Error!", "Please choose Ceding/Broker first", "Get Ceding Error")
            }
        }

    });
</script>

<script type="text/javascript">
    $('#sharetypetsiendorsement').change(function(){
        var choice = $(this).val();
        if(choice == '1'){

            var sliptype = $('#sliptypeform').val();
            if(sliptype == 'fe'){
                var tsi = $('#feshare').val();
            }else if(sliptype == 'fl'){
                var tsi = $('#flshare').val();
            }else if(sliptype == 'hem'){
                var tsi = $('#hemshare').val();
            }else if(sliptype == 'mp'){
                var tsi = $('#mpshare').val();
            }else if(sliptype == 'hio'){
                var tsi = $('#hioshare').val();
            }else if(sliptype == 'pa'){
                var tsi = $('#pashare').val();
            }else{
                var tsi = "0";
            }
            var int_tsi = parseFloat(tsi.replace(/,/g, ""));
            var conv_str_tsi = int_tsi.toFixed(2);
            var real_tsi = int_tsi.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            $('#sharetotalsumendorsement').val(tsi);
            $('#sharetotalsumendorsement2').val(tsi);

            var shareslipval = $('#slipshareendorsement').val();
            if(shareslipval != null){
                var shareslip =  parseFloat($('#slipshareendorsement').val()) / 100 ;
                var conv_tsi = parseInt(tsi.replace(/,/g, ""));
                var sumshare =isNaN( shareslip * conv_tsi) ? 0 :( shareslip * conv_tsi).toFixed(2) ;
                var real_sumshare = sumshare.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


                $('#slipsumshareendorsement').val(sumshare);
                $('#slipsumshareendorsement2').val(sumshare);

                var rateslipval = $('#sliprateendorsement').val();

                if(sliprate != null){

                    var insurance_period_from2 = $('#sliprpfromendorsement').val();
                    var insurance_period_to2 = $('#sliprptoendorsement').val();
                    var newinsurance_period_from2 = insurance_period_from2.split("/").reverse().join("-");
                    var newinsurance_period_to2 = insurance_period_to2.split("/").reverse().join("-");
                    var days=daysBetween(newinsurance_period_from2, newinsurance_period_to2);
                    var insurance = (days/365);
                    
                    console.log(insurance_period_from2)
                    console.log(insurance_period_to2)
                    console.log(newinsurance_period_from2)
                    console.log(newinsurance_period_to2)
                    console.log(days)
                    console.log(insurance)

                    var rateslip =  parseFloat($(this).val());
                    var totalrate = $("#sliptotalrateendorsement").val();
                    var conv_totalrate = parseInt(sumrate.replace(/,/g, "")).toFixed(2);
                    var sumrate = isNaN(((conv_totalrate / 1000) * conv_tsi) * insurance) ? 0 :(((conv_totalrate / 1000) * conv_tsi) * insurance).toFixed(2) ;
                    var real_sumrate = sumrate.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                    $('#slipbasicpremiumendorsement').val(sumrate);

                    var grossprm_to_nr = $('#slipgrossprmtonrendorsement').val();

                    if(grossprm_to_nr != null){
                        
                        if(sliptype == 'fe'){
                            var nasionalreinsurance =  $('#fesharefrom').val();
                            var totalnre =  $('#feshareto').val();
                        }else if(sliptype == 'fl'){
                            var nasionalreinsurance =  $('#flsharefrom').val();
                            var totalnre =  $('#flshareto').val();
                        }else if(sliptype == 'hem'){
                            var nasionalreinsurance =  $('#hemsharefrom').val();
                            var totalnre =  $('#hemshareto').val();
                        }else if(sliptype == 'mp'){
                            var nasionalreinsurance =  $('#mpsharefrom').val();
                            var totalnre =  $('#mpshareto').val();
                        }else if(sliptype == 'hio'){
                            var nasionalreinsurance =  $('#hiosharefrom').val();
                            var totalnre =  $('#hioshareto').val();
                        }else if(sliptype == 'pa'){
                            var nasionalreinsurance =  $('#pasharefrom').val();
                            var totalnre =  $('#pashareto').val();
                        }else{
                            var nasionalreinsurance =  "0";
                            var totalnre =  "0";
                        }
                        var conv_totalnre =  parseInt(totalnre.replace(/,/g, ""));

                        console.log('nre' + nasionalreinsurance)
                            // console.log(conv_nasionalreinsurance)
                            console.log('totalnre' + totalnre)
                            console.log('convtotnre' + conv_totalnre)
                            
                            var sumshare2 = $('#slipsumshareendorsement').val() ;
                            var conv_sumshare = parseInt(sumshare2.replace(/,/g, "")).toFixed(2);
                            var basic_premium = $('#slipbasicpremiumendorsement').val();
                            var conv_basre = parseInt(basic_premium.replace(/,/g, "")).toFixed(2);

                            var orpercent = $('#sliporendorsement').val() / 100;

                            var sumor = isNaN(orpercent * conv_sumshare) ? 0 :(orpercent * conv_sumshare).toFixed(2);
                            var real_sumor = sumor.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            
                            var sumgrtoprm = isNaN(conv_basre * shareslip) ? 0 :(conv_basre * shareslip ).toFixed(2);
                            var real_sumgrtoprm = sumgrtoprm.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            
                            if(nasionalreinsurance){
                                var conv_nasionalreinsurance =  parseInt(nasionalreinsurance.replace(/,/g, "")).toFixed(2);
                                var sumnre = isNaN(conv_nasionalreinsurance + conv_sumshare ) ? 0 :(conv_nasionalreinsurance + conv_sumshare).toFixed(2) ;
                                var real_sumnre = sumnre.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            }else{
                                var conv_nasionalreinsurance =  parseInt(nasionalreinsurance.replace(/,/g, "")).toFixed(2);
                                var sumnre = isNaN(0 + conv_sumshare ) ? 0 :(0 + conv_sumshare).toFixed(2) ;
                                var real_sumnre = sumnre.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            }
                            
                            
                            var sumourshare = isNaN((sumnre / conv_totalnre) * 100 ) ? 0 :((sumnre / conv_totalnre) * 100 ).toFixed(2) ;

                            console.log('sumnre' + sumnre)
                            console.log('realnre' + real_sumnre)
                            console.log('sumourshare' + sumourshare)

                            $('#slipgrossprmtonrendorsement').val(sumgrtoprm);
                            $('#slipgrossprmtonrendorsement2').val(sumgrtoprm);
                            $('#slipsumorendorsement').val(sumor);
                            $('#slipsumorendorsement2').val(sumor);
                            // $('#feshare').val(sumourshare.replace(/,/g, "."));
                            
                            if(sliptype == 'fe'){
                                $('#fesharefrom').val(sumnre);
                            }else if(sliptype == 'fl'){
                                $('#flsharefrom').val(sumnre);
                            }else if(sliptype == 'hem'){
                                $('#hemsharefrom').val(sumnre);
                            }else if(sliptype == 'mp'){
                                $('#mpsharefrom').val(sumnre);
                            }else if(sliptype == 'hio'){
                                $('#hiosharefrom').val(sumnre);
                            }else if(sliptype == 'pa'){
                                $('#pasharefrom').val(sumnre);
                            }else{
                                $('#pasharefrom').val("0");
                            }
                            


                            var commision =  parseFloat($(this).val()) / 100;
                            var feebroker = parseFloat($('#slipvbrokerendorsement').val()) / 100;
                            var sumgrossprmtonr2 = $("#slipgrossprmtonrendorsement").val();
                            var conv_sumgrossprmtonr = parseInt(sumgrossprmtonr2.replace(/,/g, "")).toFixed(2);

                            var sumcomm = isNaN(commision * conv_sumgrossprmtonr) ? 0 :(commision * conv_sumgrossprmtonr).toFixed(2);
                            var real_sumcomm = sumcomm.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                            $('#slipsumcommissionendorsement').val(sumcomm);
                            $('#slipsumcommissionendorsement2').val(sumcomm);

                            var sumgrossprmtonr3 = $("#slipgrossprmtonrendorsement").val();
                            var conv_sumgrossprmtonr2 = parseInt(sumgrossprmtonr3.replace(/,/g, "")).toFixed(2);

                            var sumnetprmtonr = isNaN( conv_sumgrossprmtonr2 * (100/100 - commision - feebroker)) ? 0 :(conv_sumgrossprmtonr2 * (100/100 - commision - feebroker)).toFixed(2);
                            var real_sumnetprmtonr = sumnetprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                            var sumfeebroker = isNaN( conv_sumgrossprmtonr2 * feebroker) ? 0 :(conv_sumgrossprmtonr2 * feebroker).toFixed(2);
                            var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


                            $('#slipnetprmtonrendorsement').val(amountToString(sumnetprmtonr));
                            $('#slipnetprmtonrendorsement2').val(amountToString(sumnetprmtonr));
                            // $('#slipsumfee').val("100" + "-" + commision.toString() + "-" + feebroker.toString() + "*" + conv_sumgrossprmtonr.toString());
                            $('#slipsumfeeendorsement').val(sumfeebroker);
                            $('#slipsumfeeendorsement2').val(sumfeebroker);

                            var sumipamountval = $('#slipipamountendorsement').val();

                            if(sumipamountval != null){
                                var percent =  parseFloat($(this).val()) / 100;

                                var sumnetprtonr2 = $("#slipnetprmtonrendorsement").val();
                                var conv_sumnetprtonr = parseInt(sumnetprtonr2.replace(/,/g, "")).toFixed(2);

                                var sumipamount = isNaN(percent *  conv_sumnetprtonr) ? 0 :(percent *  conv_sumnetprtonr).toFixed(2);
                                var real_sumipamount = sumipamount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                                $('#slipipamountendorsement').val(sumipamount);
                                $('#slipipamountendorsement2').val(sumipamount);
                            }

                    }



                }

            }

            // swal('warning!','change to tsi please change installment and retrocession amount manually','success')
        }else if(choice == '2')
        {

            var insuredid = $('#insuredIDtxt').val(); 
            var cedbrok = $('#slipcedingbrokerendorsement').val();
            var ceding = $('#slipcedingendorsement').val();
            if(cedbrok != null && ceding != null){
                $.ajax({
                    type:"GET",
                    url:"{{url('get-ceding-detail')}}?ceding_id="+ceding+"&insured_id="+insuredid,
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
                            var conv_sum = parseFloat(sum).toFixed(2);
                            var real_sum = conv_sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            $("#sharetotalsumendorsement").val(conv_sum);
                            $("#sharetotalsumendorsement2").val(conv_sum);
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
            // var tsi = $('#feshare').val();
            // var sliptype = $('#sliptypeform');
            if(sliptype == 'fe'){
                var tsi = $('#feshare').val();
            }else if(sliptype == 'fl'){
                var tsi = $('#flshare').val();
            }else if(sliptype == 'hem'){
                var tsi = $('#hemshare').val();
            }else if(sliptype == 'mp'){
                var tsi = $('#mpshare').val();
            }else if(sliptype == 'hio'){
                var tsi = $('#hioshare').val();
            }else if(sliptype == 'pa'){
                var tsi = $('#pashare').val();
            }else{
                var tsi = "0";
            }
            $('#sharetotalsumendorsement').val(tsi);
            $('#sharetotalsumendorsement2').val(tsi);

            var shareslipval = $('#slipshareendorsement').val();
            if(shareslipval != null){
                var shareslip =  parseFloat($('#slipshareendorsement').val()) / 100 ;
                var conv_tsi = parseInt(tsi.replace(/,/g, ""));
                var sumshare =isNaN( shareslip * conv_tsi) ? 0 :( shareslip * conv_tsi).toFixed(2) ;
                var real_sumshare = sumshare.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


                $('#slipsumshareendorsement').val(sumshare);
                $('#slipsumshareendorsement2').val(sumshare);

                var rateslipval = $('#sliprateendorsement').val();

                if(sliprate != null){

                    var insurance_period_from2 = $('#sliprpfromendorsement').val();
                    var insurance_period_to2 = $('#sliprptoendorsement').val();
                    var newinsurance_period_from2 = insurance_period_from2.split("/").reverse().join("-");
                    var newinsurance_period_to2 = insurance_period_to2.split("/").reverse().join("-");
                    var days=daysBetween(newinsurance_period_from2, newinsurance_period_to2);
                    var insurance = (days/365);
                    
                    console.log(insurance_period_from2)
                    console.log(insurance_period_to2)
                    console.log(newinsurance_period_from2)
                    console.log(newinsurance_period_to2)
                    console.log(days)
                    console.log(insurance)

                    var rateslip =  parseFloat($(this).val());
                    var totalrate = $("#sliptotalrateendorsement").val();
                    var conv_totalrate = parseInt(sumrate.replace(/,/g, "")).toFixed(2);
                    var sumrate = isNaN(((conv_totalrate / 1000) * conv_tsi) * insurance) ? 0 :(((conv_totalrate / 1000) * conv_tsi) * insurance).toFixed(2) ;
                    var real_sumrate = sumrate.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                    $('#slipbasicpremiumendorsement').val(sumrate);

                    var grossprm_to_nr = $('#slipgrossprmtonrendorsement').val();

                    if(grossprm_to_nr != null){
                        
                        // var sliptype = $('#sliptypeform');
                        if(sliptype == 'fe'){
                            var nasionalreinsurance =  $('#fesharefrom').val();
                            var totalnre =  $('#feshareto').val();
                        }else if(sliptype == 'fl'){
                            var nasionalreinsurance =  $('#flsharefrom').val();
                            var totalnre =  $('#flshareto').val();
                        }else if(sliptype == 'hem'){
                            var nasionalreinsurance =  $('#hemsharefrom').val();
                            var totalnre =  $('#hemshareto').val();
                        }else if(sliptype == 'mp'){
                            var nasionalreinsurance =  $('#mpsharefrom').val();
                            var totalnre =  $('#mpshareto').val();
                        }else if(sliptype == 'hio'){
                            var nasionalreinsurance =  $('#hiosharefrom').val();
                            var totalnre =  $('#hioshareto').val();
                        }else if(sliptype == 'pa'){
                            var nasionalreinsurance =  $('#pasharefrom').val();
                            var totalnre =  $('#pashareto').val();
                        }else{
                            var nasionalreinsurance =  "0";
                            var totalnre =  "0";
                        }

                        var conv_totalnre =  parseInt(totalnre.replace(/,/g, ""));

                        console.log('nre' + nasionalreinsurance)
                            // console.log(conv_nasionalreinsurance)
                            console.log('totalnre' + totalnre)
                            console.log('convtotnre' + conv_totalnre)
                            
                            var sumshare2 = $('#slipsumshareendorsement').val() ;
                            var conv_sumshare = parseInt(sumshare2.replace(/,/g, "")).toFixed(2);
                            var basic_premium = $('#slipbasicpremiumendorsement').val();
                            var conv_basre = parseInt(basic_premium.replace(/,/g, "")).toFixed(2);

                            var orpercent = $('#sliporendorsement').val() / 100;

                            var sumor = isNaN(orpercent * conv_sumshare) ? 0 :(orpercent * conv_sumshare).toFixed(2);
                            var real_sumor = sumor.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            
                            var sumgrtoprm = isNaN(conv_basre * shareslip) ? 0 :(conv_basre * shareslip ).toFixed(2);
                            var real_sumgrtoprm = sumgrtoprm.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            
                            if(nasionalreinsurance){
                                var conv_nasionalreinsurance =  parseInt(nasionalreinsurance.replace(/,/g, "")).toFixed(2);
                                var sumnre = isNaN(conv_nasionalreinsurance + conv_sumshare ) ? 0 :(conv_nasionalreinsurance + conv_sumshare).toFixed(2) ;
                                var real_sumnre = sumnre.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            }else{
                                var conv_nasionalreinsurance =  parseInt(nasionalreinsurance.replace(/,/g, "")).toFixed(2);
                                var sumnre = isNaN(0 + conv_sumshare ) ? 0 :(0 + conv_sumshare).toFixed(2) ;
                                var real_sumnre = sumnre.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            }
                            
                            
                            var sumourshare = isNaN((sumnre / conv_totalnre) * 100 ) ? 0 :((sumnre / conv_totalnre) * 100 ).toFixed(2) ;

                            console.log('sumnre' + sumnre)
                            console.log('realnre' + real_sumnre)
                            console.log('sumourshare' + sumourshare)

                            $('#slipgrossprmtonrendorsement').val(sumgrtoprm);
                            $('#slipgrossprmtonrendorsement2').val(sumgrtoprm);
                            $('#slipsumorendorsement').val(sumor);
                            $('#slipsumorendorsement2').val(sumor);
                            // $('#feshare').val(sumourshare.replace(/,/g, "."));
                           

                            // var sliptype = $('#sliptypeform');
                            if(sliptype == 'fe'){
                                $('#fesharefrom').val(sumnre);
                            }else if(sliptype == 'fl'){
                                $('#flsharefrom').val(sumnre);
                            }else if(sliptype == 'hem'){
                                $('#flsharefrom').val(sumnre);
                            }else if(sliptype == 'mp'){
                                $('#flsharefrom').val(sumnre);
                            }else if(sliptype == 'hio'){
                                $('#flsharefrom').val(sumnre);
                            }else if(sliptype == 'pa'){
                                $('#flsharefrom').val(sumnre);
                            }else{
                                $('#flsharefrom').val("0");
                            }


                            var commision =  parseFloat($(this).val()) / 100;
                            var feebroker = parseFloat($('#slipvbrokerendorsement').val()) / 100;
                            var sumgrossprmtonr2 = $("#slipgrossprmtonrendorsement").val();
                            var conv_sumgrossprmtonr = parseInt(sumgrossprmtonr2.replace(/,/g, "")).toFixed(2);

                            var sumcomm = isNaN(commision * conv_sumgrossprmtonr) ? 0 :(commision * conv_sumgrossprmtonr).toFixed(2);
                            var real_sumcomm = sumcomm.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                            $('#slipsumcommissionendorsement').val(sumcomm);
                            $('#slipsumcommissionendorsement2').val(sumcomm);

                            var sumgrossprmtonr3 = $("#slipgrossprmtonrendorsement").val();
                            var conv_sumgrossprmtonr2 = parseInt(sumgrossprmtonr3.replace(/,/g, "")).toFixed(2);

                            var sumnetprmtonr = isNaN( conv_sumgrossprmtonr2 * (100/100 - commision - feebroker)) ? 0 :(conv_sumgrossprmtonr2 * (100/100 - commision - feebroker)).toFixed(2);
                            var real_sumnetprmtonr = sumnetprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                            var sumfeebroker = isNaN( conv_sumgrossprmtonr2 * feebroker) ? 0 :(conv_sumgrossprmtonr2 * feebroker).toFixed(2);
                            var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


                            $('#slipnetprmtonrendorsement').val(amountToString(sumnetprmtonr));
                            $('#slipnetprmtonrendorsement2').val(amountToString(sumnetprmtonr));
                            // $('#slipsumfee').val("100" + "-" + commision.toString() + "-" + feebroker.toString() + "*" + conv_sumgrossprmtonr.toString());
                            $('#slipsumfeeendorsement').val(sumfeebroker);
                            $('#slipsumfeeendorsement2').val(sumfeebroker);

                            var sumipamountval = $('#slipipamountendorsement').val();

                            if(sumipamountval != null){
                                var percent =  parseFloat($(this).val()) / 100;

                                var sumnetprtonr2 = $("#slipnetprmtonrendorsement").val();
                                var conv_sumnetprtonr = parseInt(sumnetprtonr2.replace(/,/g, "")).toFixed(2);

                                var sumipamount = isNaN(percent *  conv_sumnetprtonr) ? 0 :(percent *  conv_sumnetprtonr).toFixed(2);
                                var real_sumipamount = sumipamount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                                $('#slipipamountendorsement').val(sumipamount);
                                $('#slipipamountendorsement2').val(sumipamount);
                            }

                    }



                }

            }

            // swal('warning!','change to ceding share please change installment and retrocession amount manually','success')

        }
    });
</script>

<script type="text/javascript">
    $('#sliptypetsiupdate').change(function(){
        var choice = $(this).val();
        

        var sliptype = $('#sliptypeform').val();
        if(sliptype == 'fe'){
            var valtsi = $('#feshareto').val();
            var valcedshare = $('#feshare').val();
        }else if(sliptype == 'fl'){
            var valtsi = $('#flshareto').val();
            var valcedshare = $('#flshare').val();
        }else if(sliptype == 'hem'){
            var valtsi = $('#hemshareto').val();
            var valcedshare = $('#hemshare').val();
        }else if(sliptype == 'mp'){
            var valtsi = $('#mpshareto').val();
            var valcedshare = $('#mpshare').val();
        }else if(sliptype == 'hio'){
            var valtsi = $('#hioshareto').val();
            var valcedshare = $('#hioshare').val();
        }else if(sliptype == 'pa'){
            var valtsi = $('#pashareto').val();
            var valcedshare = $('#pashare').val();
        }else{
            var valtsi = "0";
            var valcedshare = "0";
        }
        var insuredid = $('#insuredIDtxt').val(); 
        var cedbrok = $('#slipcedingbrokerupdate').val();
        var ceding = $('#slipcedingupdate').val();

        if(choice == '1'){
            if(valtsi == null){
                swal('warning','please fill tsi insured value first','error')
            }else{
                
                
                // var sliptype = $('#sliptypeform');
                if(sliptype == 'fe'){
                    var tsi = $('#feshareto').val();
                }else if(sliptype == 'fl'){
                    var tsi = $('#flshareto').val();
                }else if(sliptype == 'hem'){
                    var tsi = $('#hemshareto').val();
                }else if(sliptype == 'mp'){
                    var tsi = $('#mpshareto').val();
                }else if(sliptype == 'hio'){
                    var tsi = $('#hioshareto').val();
                }else if(sliptype == 'pa'){
                    var tsi = $('#pashareto').val();
                }else{
                    var tsi = "0";
                }

                var int_tsi = parseInt(tsi.replace(/,/g, ""));
                var conv_str_tsi = int_tsi.toFixed(2);
                var real_tsi = int_tsi.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('#sliptotalsumupdate').val(tsi);
                $('#sliptotalsumupdate2').val(tsi);

                var tsislip = $('#sliptotalsumupdate').val();
                var pctval = $('#slippctupdate').val();

                if(pctval != null){
                    var pct =  parseFloat($('#slippctupdate').val())/100;
                    var conv_tsi = parseFloat(tsi.replace(/,/g, ""));

                    var sum = isNaN(pct * conv_tsi) ? 0 :(pct * conv_tsi) ;
                    console.log('sum ' + sum)
                    var conv_sum = parseFloat(sum).toFixed(2);
                    console.log('conv_sum' + conv_sum)
                    var real_sum = conv_sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    
                    console.log('real_sum' + real_sum)

                    $('#sliptotalsumpctupdate').val(conv_sum);
                    $('#sliptotalsumpctupdate2').val(conv_sum);
                    // swal('success','changed to tsi','success')


                    var dpamount = $('#slipdpamountupdate').val();
                    var ecamount = $('#slipamountecupdate').val();

                    if(dpamount != null){

                        var percent =  parseFloat($('#slipdppercentageupdate').val()) / 100;
                        
                        var sum = isNaN(percent * conv_tsi) ? 0 :(percent * conv_tsi).toFixed(2) ;
                        var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        console.log($('#slipdppercentageupdate').val())
                        console.log(percent)
                        console.log(sum)
                        console.log(real_sum)

                        $('#slipdpamountupdate').val(sum);
                        $('#slipdpamountupdate2').val(sum);

                    }

                    if(ecamount != null){

                        var persentage =  parseFloat($('#slipnilaiecupdate').val()) / 1000;
                        var sum = isNaN(conv_tsi * persentage) ? 0 :(conv_tsi * persentage) ;
                        var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        console.log($('#slipnilaiecupdate').val())
                        console.log(persentage)
                        console.log(sum)
                        console.log(real_sum)

                        $('#slipamountecupdate').val(sum);
                        $('#slipamountecupdate2').val(sum);

                    }

                }
            }
        }else if(choice == '2')
        {
            if(cedbrok != null && ceding != null){
                // var ceding_share = $('#feshare').val();
                // var int_ceding_share = parseInt(ceding_share.replace(/,/g, ""));
                // var conv_ceding_share = int_ceding_share.toFixed(2);
                // var real_ceding_share = conv_ceding_share.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                
                $.ajax({
                    type:"GET",
                    url:"{{url('get-ceding-detail')}}?ceding_id="+ceding+"&insured_id="+insuredid,
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
                                var conv_sum = parseFloat(sum).toFixed(2);
                                var real_sum = conv_sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                $("#sliptotalsumupdate").val(conv_sum);
                                $("#sliptotalsumupdate2").val(conv_sum);

                                var tsicedshare = $("#sliptotalsumupdate").val();
                                var pctval = $('#sliptotalsumpctupdate').val();

                                if(pctval != null){

                                    var pct =  parseFloat($('#slippctupdate').val())/100;

                                    // var tsi = $("#sliptotalsum").val();
                                    var conv_tsi = parseInt(tsicedshare.replace(/,/g, ""));

                                    var sum = isNaN(pct * conv_tsi) ? 0 :(pct * conv_tsi).toFixed(2) ;
                                    console.log(sum)
                                    var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    $('#sliptotalsumpctupdate').val(sum);
                                    $('#sliptotalsumpctupdate2').val(sum);
                                    // swal('success','changed to ceding share','success')

                                    var dpamount = $('#slipdpamountupdate').val();
                                    var ecamount = $('#slipamountecupdate').val();

                                    if(dpamount != null){
                                        var percent =  parseFloat($('#slipdppercentageupdate').val()) / 100;
                                        
                                        var sum = isNaN(percent * conv_tsi) ? 0 :(percent * conv_tsi).toFixed(2) ;
                                        var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                        console.log($('#slipdppercentageupdate').val())
                                        console.log(percent)
                                        console.log(sum)
                                        console.log(real_sum)

                                        $('#slipdpamountupdate').val(sum);
                                        $('#slipdpamountupdate2').val(sum);
                                    }

                                    if(ecamount != null){

                                        var persentage =  parseFloat($('#slipnilaiecupdate').val()) / 1000;
                                        var sum = isNaN(conv_tsi * persentage) ? 0 :(conv_tsi * persentage) ;
                                        var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                        console.log($('#slipnilaiecupdate').val())
                                        console.log(persentage)
                                        console.log(sum)
                                        console.log(real_sum)

                                        $('#slipamountecupdate').val(sum);
                                        $('#slipamountecupdate2').val(sum);
                                        
                                    }

                                }
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
                swal("Error!", "Please choose Ceding/Broker first", "Get Ceding Error")
            }
        }

    });
</script>

<script type="text/javascript">
    $('#sharetypetsiupdate').change(function(){
        var choice = $(this).val();
        if(choice == '1'){

            // var tsi = $('#feshareto').val();
            var sliptype = $('#sliptypeform').val();
            if(sliptype == 'fe'){
                    var tsi = $('#feshareto').val();
                }else if(sliptype == 'fl'){
                    var tsi = $('#flshareto').val();
                }else if(sliptype == 'hem'){
                    var tsi = $('#hemshareto').val();
                }else if(sliptype == 'mp'){
                    var tsi = $('#mpshareto').val();
                }else if(sliptype == 'hio'){
                    var tsi = $('#hioshareto').val();
                }else if(sliptype == 'pa'){
                    var tsi = $('#pashareto').val();
                }else{
                    var tsi = "0";
                }
            var int_tsi = parseFloat(tsi.replace(/,/g, ""));
            var conv_str_tsi = int_tsi.toFixed(2);
            var real_tsi = int_tsi.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            $('#sharetotalsumupdate').val(tsi);
            $('#sharetotalsumupdate2').val(tsi);

            var shareslipval = $('#slipshareupdate').val();
            if(shareslipval != null){
                var shareslip =  parseFloat($('#slipshareupdate').val()) / 100 ;
                var conv_tsi = parseInt(tsi.replace(/,/g, ""));
                var sumshare =isNaN( shareslip * conv_tsi) ? 0 :( shareslip * conv_tsi).toFixed(2) ;
                var real_sumshare = sumshare.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


                $('#slipsumshareupdate').val(sumshare);
                $('#slipsumshareupdate2').val(sumshare);

                var rateslipval = $('#sliprateupdate').val();

                if(sliprate != null){

                    var insurance_period_from2 = $('#sliprpfromupdate').val();
                    var insurance_period_to2 = $('#sliprptoupdate').val();
                    var newinsurance_period_from2 = insurance_period_from2.split("/").reverse().join("-");
                    var newinsurance_period_to2 = insurance_period_to2.split("/").reverse().join("-");
                    var days=daysBetween(newinsurance_period_from2, newinsurance_period_to2);
                    var insurance = (days/365);
                    
                    console.log(insurance_period_from2)
                    console.log(insurance_period_to2)
                    console.log(newinsurance_period_from2)
                    console.log(newinsurance_period_to2)
                    console.log(days)
                    console.log(insurance)

                    var rateslip =  parseFloat($(this).val()) ;
                    var totalrate = $("#sliptotalrateupdate").val();
                    var conv_totalrate = parseInt(sumrate.replace(/,/g, "")).toFixed(2);
                    var sumrate = isNaN(((conv_totalrate / 1000) * conv_tsi) * insurance) ? 0 :(((conv_totalrate / 1000) * conv_tsi) * insurance).toFixed(2) ;
                    var real_sumrate = sumrate.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                    $('#slipbasicpremiumupdate').val(sumrate);

                    var grossprm_to_nr = $('#slipgrossprmtonrupdate').val();

                    if(grossprm_to_nr != null){
                       

                        // var sliptype = $('#sliptypeform');
                        if(sliptype == 'fe'){
                            var nasionalreinsurance =  $('#fesharefrom').val();
                            var totalnre =  $('#feshareto').val();
                        }else if(sliptype == 'fl'){
                            var nasionalreinsurance =  $('#flsharefrom').val();
                            var totalnre =  $('#flshareto').val();
                        }else if(sliptype == 'hem'){
                            var nasionalreinsurance =  $('#hemsharefrom').val();
                            var totalnre =  $('#hemshareto').val();
                        }else if(sliptype == 'mp'){
                            var nasionalreinsurance =  $('#mpsharefrom').val();
                            var totalnre =  $('#mpshareto').val();
                        }else if(sliptype == 'hio'){
                            var nasionalreinsurance =  $('#hiosharefrom').val();
                            var totalnre =  $('#hioshareto').val();
                        }else if(sliptype == 'pa'){
                            var nasionalreinsurance =  $('#pasharefrom').val();
                            var totalnre =  $('#pashareto').val();
                        }else{
                            var nasionalreinsurance =  "0";
                            var totalnre =  "0";
                        }

                        var conv_totalnre =  parseInt(totalnre.replace(/,/g, ""));

                        console.log('nre' + nasionalreinsurance)
                            // console.log(conv_nasionalreinsurance)
                            console.log('totalnre' + totalnre)
                            console.log('convtotnre' + conv_totalnre)
                            
                            var sumshare2 = $('#slipsumshareupdate').val() ;
                            var conv_sumshare = parseInt(sumshare2.replace(/,/g, "")).toFixed(2);
                            var basic_premium = $('#slipbasicpremiumupdate').val();
                            var conv_basre = parseInt(basic_premium.replace(/,/g, "")).toFixed(2);

                            var orpercent = $('#sliporupdate').val() / 100;

                            var sumor = isNaN(orpercent * conv_sumshare) ? 0 :(orpercent * conv_sumshare).toFixed(2);
                            var real_sumor = sumor.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            
                            var sumgrtoprm = isNaN(conv_basre * shareslip) ? 0 :(conv_basre * shareslip ).toFixed(2);
                            var real_sumgrtoprm = sumgrtoprm.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            
                            if(nasionalreinsurance){
                                var conv_nasionalreinsurance =  parseInt(nasionalreinsurance.replace(/,/g, "")).toFixed(2);
                                var sumnre = isNaN(conv_nasionalreinsurance + conv_sumshare ) ? 0 :(conv_nasionalreinsurance + conv_sumshare).toFixed(2) ;
                                var real_sumnre = sumnre.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            }else{
                                var conv_nasionalreinsurance =  parseInt(nasionalreinsurance.replace(/,/g, "")).toFixed(2);
                                var sumnre = isNaN(0 + conv_sumshare ) ? 0 :(0 + conv_sumshare).toFixed(2) ;
                                var real_sumnre = sumnre.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            }
                            
                            
                            var sumourshare = isNaN((sumnre / conv_totalnre) * 100 ) ? 0 :((sumnre / conv_totalnre) * 100 ).toFixed(2) ;

                            console.log('sumnre' + sumnre)
                            console.log('realnre' + real_sumnre)
                            console.log('sumourshare' + sumourshare)

                            $('#slipgrossprmtonrupdate').val(sumgrtoprm);
                            $('#slipgrossprmtonrupdate2').val(sumgrtoprm);
                            $('#slipsumorupdate').val(sumor);
                            $('#slipsumorupdate2').val(sumor);
                            // $('#feshare').val(sumourshare.replace(/,/g, "."));
                            
                            // var sliptype = $('#sliptypeform');
                            if(sliptype == 'fe'){
                                $('#fesharefrom').val(sumnre);
                            }else if(sliptype == 'fl'){
                                $('#flsharefrom').val(sumnre);
                            }else if(sliptype == 'hem'){
                                $('#hemsharefrom').val(sumnre);
                            }else if(sliptype == 'mp'){
                                $('#mpsharefrom').val(sumnre);
                            }else if(sliptype == 'hio'){
                                $('#hiosharefrom').val(sumnre);
                            }else if(sliptype == 'pa'){
                                $('#pasharefrom').val(sumnre);
                            }else{
                                $('#pasharefrom').val("0");
                            }


                            var commision =  parseFloat($(this).val()) / 100;
                            var feebroker = parseFloat($('#slipvbrokerupdate').val()) / 100;
                            var sumgrossprmtonr2 = $("#slipgrossprmtonrupdate").val();
                            var conv_sumgrossprmtonr = parseInt(sumgrossprmtonr2.replace(/,/g, "")).toFixed(2);

                            var sumcomm = isNaN(commision * conv_sumgrossprmtonr) ? 0 :(commision * conv_sumgrossprmtonr).toFixed(2);
                            var real_sumcomm = sumcomm.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                            $('#slipsumcommissionupdate').val(sumcomm);
                            $('#slipsumcommissionupdate2').val(sumcomm);

                            var sumgrossprmtonr3 = $("#slipgrossprmtonrupdate").val();
                            var conv_sumgrossprmtonr2 = parseInt(sumgrossprmtonr3.replace(/,/g, "")).toFixed(2);

                            var sumnetprmtonr = isNaN( conv_sumgrossprmtonr2 * (100/100 - commision - feebroker)) ? 0 :(conv_sumgrossprmtonr2 * (100/100 - commision - feebroker)).toFixed(2);
                            var real_sumnetprmtonr = sumnetprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                            var sumfeebroker = isNaN( conv_sumgrossprmtonr2 * feebroker) ? 0 :(conv_sumgrossprmtonr2 * feebroker).toFixed(2);
                            var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


                            $('#slipnetprmtonrupdate').val(amountToString(sumnetprmtonr));
                            $('#slipnetprmtonrupdate2').val(amountToString(sumnetprmtonr));
                            // $('#slipsumfee').val("100" + "-" + commision.toString() + "-" + feebroker.toString() + "*" + conv_sumgrossprmtonr.toString());
                            $('#slipsumfeeupdate').val(sumfeebroker);
                            $('#slipsumfeeupdate2').val(sumfeebroker);

                            var sumipamountval = $('#slipipamountupdate').val();

                            if(sumipamountval != null){
                                var percent =  parseFloat($(this).val()) / 100;

                                var sumnetprtonr2 = $("#slipnetprmtonrupdate").val();
                                var conv_sumnetprtonr = parseInt(sumnetprtonr2.replace(/,/g, "")).toFixed(2);

                                var sumipamount = isNaN(percent *  conv_sumnetprtonr) ? 0 :(percent *  conv_sumnetprtonr).toFixed(2);
                                var real_sumipamount = sumipamount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                                $('#slipipamountupdate').val(sumipamount);
                                $('#slipipamountupdate2').val(sumipamount);
                            }

                    }



                }

            }

            // swal('warning!','change to tsi please change installment and retrocession amount manually','success')
        }else if(choice == '2')
        {

            var insuredid = $('#insuredIDtxt').val(); 
            var cedbrok = $('#slipcedingbrokerupdate').val();
            var ceding = $('#slipcedingupdate').val();
            if(cedbrok != null && ceding != null){
                $.ajax({
                    type:"GET",
                    url:"{{url('get-ceding-detail')}}?ceding_id="+ceding+"&insured_id="+insuredid,
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
                            var conv_sum = parseFloat(sum).toFixed(2);
                            var real_sum = conv_sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            $("#sharetotalsumupdate").val(conv_sum);
                            $("#sharetotalsumupdate2").val(conv_sum);
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
            
            // var sliptype = $('#sliptypeform');
            if(sliptype == 'fe'){
                var tsi = $('#feshare').val();
            }else if(sliptype == 'fl'){
                var tsi = $('#flshare').val();
            }else if(sliptype == 'hem'){
                var tsi = $('#hemshare').val();
            }else if(sliptype == 'mp'){
                var tsi = $('#mpshare').val();
            }else if(sliptype == 'hio'){
                var tsi = $('#hioshare').val();
            }else if(sliptype == 'pa'){
                var tsi = $('#pashare').val();
            }else{
                var tsi = "0";
            }
            
            $('#sharetotalsumupdate').val(tsi);
            $('#sharetotalsumupdate2').val(tsi);

            var shareslipval = $('#slipshareupdate').val();
            if(shareslipval != null){
                var shareslip =  parseFloat($('#slipshareupdate').val()) / 100 ;
                var conv_tsi = parseInt(tsi.replace(/,/g, ""));
                var sumshare =isNaN( shareslip * conv_tsi) ? 0 :( shareslip * conv_tsi).toFixed(2) ;
                var real_sumshare = sumshare.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


                $('#slipsumshareupdate').val(sumshare);
                $('#slipsumshareupdate2').val(sumshare);

                var rateslipval = $('#sliprateupdate').val();

                if(sliprate != null){

                    var insurance_period_from2 = $('#sliprpfromupdate').val();
                    var insurance_period_to2 = $('#sliprptoupdate').val();
                    var newinsurance_period_from2 = insurance_period_from2.split("/").reverse().join("-");
                    var newinsurance_period_to2 = insurance_period_to2.split("/").reverse().join("-");
                    var days=daysBetween(newinsurance_period_from2, newinsurance_period_to2);
                    var insurance = (days/365);
                    
                    console.log(insurance_period_from2)
                    console.log(insurance_period_to2)
                    console.log(newinsurance_period_from2)
                    console.log(newinsurance_period_to2)
                    console.log(days)
                    console.log(insurance)

                    var rateslip =  parseFloat($(this).val()) ;
                    var totalrate = $("#sliptotalrateupdate").val();
                    var conv_totalrate = parseInt(sumrate.replace(/,/g, "")).toFixed(2);
                    var sumrate = isNaN(((conv_totalrate / 1000) * conv_tsi) * insurance) ? 0 :(((conv_totalrate / 1000) * conv_tsi) * insurance).toFixed(2);
                    var real_sumrate = sumrate.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                    $('#slipbasicpremiumupdate').val(sumrate);

                    var grossprm_to_nr = $('#slipgrossprmtonrupdate').val();

                    if(grossprm_to_nr != null){
                        

                        // var sliptype = $('#sliptypeform');
                        if(sliptype == 'fe'){
                            var nasionalreinsurance =  $('#fesharefromupdate').val();
                            var totalnre =  $('#fesharetoupdate').val();
                        }else if(sliptype == 'fl'){
                            var nasionalreinsurance =  $('#flsharefromupdate').val();
                            var totalnre =  $('#flsharetoupdate').val();
                        }else if(sliptype == 'hem'){
                            var nasionalreinsurance =  $('#hemsharefromupdate').val();
                            var totalnre =  $('#hemsharetoupdate').val();
                        }else if(sliptype == 'mp'){
                            var nasionalreinsurance =  $('#mpsharefromupdate').val();
                            var totalnre =  $('#mpsharetoupdate').val();
                        }else if(sliptype == 'hio'){
                            var nasionalreinsurance =  $('#hiosharefromupdate').val();
                            var totalnre =  $('#hiosharetoupdate').val();
                        }else if(sliptype == 'pa'){
                            var nasionalreinsurance =  $('#pasharefromupdate').val();
                            var totalnre =  $('#pasharetoupdate').val();
                        }else{
                            var nasionalreinsurance =  "0";
                            var totalnre =  "0";
                        }

                        var conv_totalnre =  parseInt(totalnre.replace(/,/g, ""));

                        console.log('nre' + nasionalreinsurance)
                            // console.log(conv_nasionalreinsurance)
                            console.log('totalnre' + totalnre)
                            console.log('convtotnre' + conv_totalnre)
                            
                            var sumshare2 = $('#slipsumshareupdate').val() ;
                            var conv_sumshare = parseInt(sumshare2.replace(/,/g, "")).toFixed(2);
                            var basic_premium = $('#slipbasicpremiumupdate').val();
                            var conv_basre = parseInt(basic_premium.replace(/,/g, "")).toFixed(2);

                            var orpercent = $('#sliporupdate').val() / 100;

                            var sumor = isNaN(orpercent * conv_sumshare) ? 0 :(orpercent * conv_sumshare).toFixed(2);
                            var real_sumor = sumor.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            
                            var sumgrtoprm = isNaN(conv_basre * shareslip) ? 0 :(conv_basre * shareslip ).toFixed(2);
                            var real_sumgrtoprm = sumgrtoprm.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            
                            if(nasionalreinsurance){
                                var conv_nasionalreinsurance =  parseInt(nasionalreinsurance.replace(/,/g, "")).toFixed(2);
                                var sumnre = isNaN(conv_nasionalreinsurance + conv_sumshare ) ? 0 :(conv_nasionalreinsurance + conv_sumshare).toFixed(2) ;
                                var real_sumnre = sumnre.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            }else{
                                var conv_nasionalreinsurance =  parseInt(nasionalreinsurance.replace(/,/g, "")).toFixed(2);
                                var sumnre = isNaN(0 + conv_sumshare ) ? 0 :(0 + conv_sumshare).toFixed(2) ;
                                var real_sumnre = sumnre.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            }
                            
                            
                            var sumourshare = isNaN((sumnre / conv_totalnre) * 100 ) ? 0 :((sumnre / conv_totalnre) * 100 ).toFixed(2) ;

                            console.log('sumnre' + sumnre)
                            console.log('realnre' + real_sumnre)
                            console.log('sumourshare' + sumourshare)

                            $('#slipgrossprmtonrupdate').val(sumgrtoprm);
                            $('#slipgrossprmtonrupdate2').val(sumgrtoprm);
                            $('#slipsumorupdate').val(sumor);
                            $('#slipsumorupdate2').val(sumor);
                            // $('#feshare').val(sumourshare.replace(/,/g, "."));
                            // $('#fesharefromupdate').val(sumnre);
                            // var sliptype = $('#sliptypeform');
                            if(sliptype == 'fe'){
                                $('#fesharefrom').val(sumnre);
                            }else if(sliptype == 'fl'){
                                $('#flsharefrom').val(sumnre);
                            }else if(sliptype == 'hem'){
                                $('#hemsharefrom').val(sumnre);
                            }else if(sliptype == 'mp'){
                                $('#mpsharefrom').val(sumnre);
                            }else if(sliptype == 'hio'){
                                $('#hiosharefrom').val(sumnre);
                            }else if(sliptype == 'pa'){
                                $('#pasharefrom').val(sumnre);
                            }else{
                                $('#pasharefrom').val("0");
                            }


                            var commision =  parseFloat($(this).val()) / 100;
                            var feebroker = parseFloat($('#slipvbrokerupdate').val()) / 100;
                            var sumgrossprmtonr2 = $("#slipgrossprmtonrupdate").val();
                            var conv_sumgrossprmtonr = parseInt(sumgrossprmtonr2.replace(/,/g, "")).toFixed(2);

                            var sumcomm = isNaN(commision * conv_sumgrossprmtonr) ? 0 :(commision * conv_sumgrossprmtonr).toFixed(2);
                            var real_sumcomm = sumcomm.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                            $('#slipsumcommissionupdate').val(sumcomm);
                            $('#slipsumcommissionupdate2').val(sumcomm);

                            var sumgrossprmtonr3 = $("#slipgrossprmtonrupdate").val();
                            var conv_sumgrossprmtonr2 = parseInt(sumgrossprmtonr3.replace(/,/g, "")).toFixed(2);

                            var sumnetprmtonr = isNaN( conv_sumgrossprmtonr2 * (100/100 - commision - feebroker)) ? 0 :(conv_sumgrossprmtonr2 * (100/100 - commision - feebroker)).toFixed(2);
                            var real_sumnetprmtonr = sumnetprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                            var sumfeebroker = isNaN( conv_sumgrossprmtonr2 * feebroker) ? 0 :(conv_sumgrossprmtonr2 * feebroker).toFixed(2);
                            var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


                            $('#slipnetprmtonrupdate').val(amountToString(sumnetprmtonr));
                            $('#slipnetprmtonrupdate2').val(amountToString(sumnetprmtonr));
                            // $('#slipsumfee').val("100" + "-" + commision.toString() + "-" + feebroker.toString() + "*" + conv_sumgrossprmtonr.toString());
                            $('#slipsumfeeupdate').val(sumfeebroker);
                            $('#slipsumfeeupdate2').val(sumfeebroker);

                            var sumipamountval = $('#slipipamountupdate').val();

                            if(sumipamountval != null){
                                var percent =  parseFloat($(this).val()) / 100;

                                var sumnetprtonr2 = $("#slipnetprmtonrupdate").val();
                                var conv_sumnetprtonr = parseInt(sumnetprtonr2.replace(/,/g, "")).toFixed(2);

                                var sumipamount = isNaN(percent *  conv_sumnetprtonr) ? 0 :(percent *  conv_sumnetprtonr).toFixed(2);
                                var real_sumipamount = sumipamount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                                $('#slipipamountupdate').val(sumipamount);
                                $('#slipipamountupdate2').val(sumipamount);
                            }

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
 
             var sum = isNaN(pct * conv_tsi) ? 0 :(pct * conv_tsi).toFixed(2) ;
             $('#sliptotalsumpct').val(sum);
             $('#sliptotalsumpct2').val(sum);
         }
     });
    // For convert
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
 
    $('#slipshare').keyup(function (e){
        var keyCode = e.keyCode || e.which; 
        if(e.keyCode != 9){
             calculateShare('slip');
        }
     });
 
 
 
    $('#sliprate').keyup(function (e) {
        var keyCode = e.keyCode || e.which; 
         if(e.keyCode != 9){
            // calculateBasicPremium('slip');
            calculateTotalRate('slip');
            

         }else{   
            calculateTotalRate('slip');
            // calculateBasicPremium('slip');
         }
     });

 // Warning if rate between area  
    $('#sliprate').change(function(){
        console.log('check lower and upper')
         var rate_lower = $('#slipbcla').val();
         var rate_upper = $('#slipbcua').val();
         var rate = $(this).val();
         if(rate_upper != "" || rate_lower != "")
         {
             var rate_lower_val = parseFloat(rate_lower);
             var rate_upper_val = parseFloat(rate_upper);
             var rate_val = parseFloat(rate);
             console.log(rate_lower_val)
             console.log(rate_upper_val)
             console.log(rate_val)

             if(rate_val != '' && (rate_val < rate_lower_val || rate_val > rate_upper_val )){
                 swal('warning','please input rate between rate lower and rate upper building','warning')
             }
 
         }else if(rate_upper == "0" && rate_lower == "0"){
             var rate_lower_val = parseFloat(rate_lower);
             var rate_upper_val = parseFloat(rate_upper);
             var rate_val = parseFloat(rate);
             console.log(rate_lower_val)
             console.log(rate_upper_val)
             console.log(rate_val)
 
             if(rate_val != '' && (rate_val < rate_lower_val || rate_val > rate_upper_val ))
             {
                 swal('warning','please input rate between rate lower and rate upper building','input error')
             }
         }
         else{
             swal('warning','please choose building const first','error')
         }
    });

    $("#slipbasicpremium").keyup(function(e) 
   { 
        var keyCode = e.keyCode || e.which; 

        if (keyCode == 9){ 
            calculateTotalRateByPremium('slip')
            
        }
        else{
            calculateTotalRateByPremium('slip')
            
        }

   });

    

 
    $('#slipshare').change(function (e) {
         if(e.keyCode != 9){
            calculateShare('slip')
         }
     });
    // For Convert
    $('#slipcommission').keyup(function (e) {
         var keyCode = e.keyCode || e.which;
 
         if (keyCode != 9){
             calculateComm('slip')
         }else{
             calculateComm('slip')
         }
 
     });
 
    $('#slipcommission').keydown(function (e) {
         var keyCode = e.keyCode || e.which;
 
         if (keyCode != 9){
             calculateComm('slip')
         }else{
             calculateComm('slip')
         }
 
     });
 
    $('#slipcommission').keypress(function (e) {
         var keyCode = e.keyCode || e.which;
 
         if (keyCode != 9){
             calculateComm('slip')
         }else{
             calculateComm('slip')
         }
 
     });
 
    $('#slipsumcommission2').keyup(function(e){
         var keyCode = e.keyCode || e.which; 
 
         if (keyCode != 9){
             calculatePercentComm('slip')
         }else{
             calculatePercentComm('slip')
         }
    });
 
    $('#slipsumcommission2').keydown(function(e){
         var keyCode = e.keyCode || e.which; 
 
         if (keyCode != 9){
             calculatePercentComm('slip')
         }else{
             calculatePercentComm('slip')
         }
    });
 
    $('#slipsumcommission2').keypress(function(e){
         var keyCode = e.keyCode || e.which; 
 
         if (keyCode != 9){
             calculatePercentComm('slip')
         }else{
             calculatePercentComm('slip')
         }
    });
 
 
 
    // For Convert
    $('#slipvbroker').keyup(function(e){
        var keyCode = e.keyCode || e.which; 
 
        if (keyCode != 9) {
            console.log("slip fee broker typing")
            calculateFeeBroker('slip')
         }
     });
    $('#slipvbroker').keydown(function(e){
        var keyCode = e.keyCode || e.which; 
 
        if (keyCode != 9) {
            calculateFeeBroker('slip')

        }else{
            calculateFeeBroker('slip')

        }
     });
    $('#slipvbroker').keypress(function(e){
        var keyCode = e.keyCode || e.which; 
 
        if (keyCode != 9) {
            calculateFeeBroker('slip')

        }else{
            calculateFeeBroker('slip')

        }
     });
 
    $('#slipsumfee2').keyup(function(e){
         var keyCode = e.keyCode || e.which; 
 
         if (keyCode != 9) {
             
            calculatePercentFee('slip')
             
         }
    });
 
    $('#slipsumfee2').keydown(function(e){
         var keyCode = e.keyCode || e.which; 
 
         if (keyCode != 9) {
             calculatePercentFee('slip')
         }
    });
 
    $('#slipsumfee2').keypress(function(e){
         var keyCode = e.keyCode || e.which; 
 
         if (keyCode != 9) {
             calculatePercentFee('slip')
             
         }else{
            calculatePercentFee('slip')
         }
    });
 
     $('#slipvbroker').change(function(){
 
         if( $('#installmentPanel tbody').find('tr').val().length > 0){
             swal('warning!','netprm to nr changed, please change installment amount manually','success')
         }
 
    });
 
    $('#slipippercentage').keyup(function (e) {
         calculateInstallment('slip')
     });
 
    $('#slipippercentage').keydown(function (e) {
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
                 $('#slipsumor').val(sum);
                 $('#slipsumor2').val(sum);
             }
 
             
 
 
         }
     });
    // For Convert
    $('#sliprppercentage').keyup(function (e) {
        calculateRetro('slip')
    });
 // For Convert
    $('#sliprppercentage').change(function (e) {
        calculateRetro('slip')
    });
    // For Convert
    $('#slipnilaiec').keyup(function () {
         var persentage =  parseFloat($('#slipnilaiec').val()) / 1000;
         var sliptotalsum =  $('#sliptotalsum').val();
         var conv_sliptotalsum = parseFloat(sliptotalsum.replace(/,/g, ""));
        //alert(premiumnr);
        //alert(persentage);
         var sum = isNaN(conv_sliptotalsum * persentage) ? 0 :(conv_sliptotalsum * persentage);
         var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        //alert(sum);
         console.log($(this).val())
         console.log(persentage)
         console.log(sum)
         console.log(real_sum)
         console.log("TEST")
 
         $('#slipamountec').val(amountToString(sum));
         $('#slipamountec2').val(amountToString(sum));
    });
 </script>
 
 <script  type='text/javascript'>
    $('#slippctupdate').keyup(function (e) {
         if(e.keyCode != 9){
             var pct =  parseFloat($(this).val())/100;
 
             var tsi = $("#sliptotalsumupdate").val();
             var conv_tsi = parseFloat(tsi.replace(/,/g, ""));
 
             var sum = isNaN(pct * conv_tsi) ? 0 :(pct * conv_tsi);
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
 
             $('#slipdpamountupdate').val(amountToString(sum));
             $('#slipdpamountupdate2').val(amountToString(sum));
         }
     });
 
    $('#slipshareupdate').keyup(function (e) 
        {
         if(e.keyCode != 9){
             var shareslip =  parseFloat($(this).val()) / 100 ;
             var tsi = $("#sharetotalsumupdate").val();
             var conv_tsi = parseFloat(tsi.replace(/,/g, ""));
             var sumshare =isNaN( shareslip * conv_tsi) ? 0 :( shareslip * conv_tsi);
             var real_sumshare = sumshare.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
 
 
             $('#slipsumshareupdate').val(amountToString(sumshare));
             $('#slipsumshareupdate2').val(amountToString(sumshare));
         }
     });
    
    // For Convert
 
    $('#sliprateupdate').keyup(function (e) {
         if(e.keyCode != 9){
            calculateTotalRate('update');
            // calculateBasicPremium('update');

         }else{   
            calculateTotalRate('update');
            // calculateBasicPremium('update');
         }
     });
 
 
 
    $('#sliprateupdate').change(function(){
         var rate_lower = $('#slipbclaupdate').val();
         var rate_upper = $('#slipbcuaupdate').val();
         var rate = $('#sliprateupdate').val();
         
 
         if(rate_upper != "" || rate_lower != ""){
             var rate_lower_val = parseFloat(rate_lower);
             var rate_upper_val = parseFloat(rate_upper);
             var rate_val = parseFloat(rate);
             console.log(rate_lower_val)
             console.log(rate_upper_val)
             console.log(rate_val)
             if(rate_val < rate_lower_val || rate_val > rate_upper_val ){
                 swal('warning','please input rate between rate lower and rate upper building','input error')
             }
             
 
         }else if(rate_upper == "0" && rate_lower == "0"){
             var rate_lower_val = parseFloat(rate_lower);
             var rate_upper_val = parseFloat(rate_upper);
             var rate_val = parseFloat(rate);
             console.log(rate_lower_val)
             console.log(rate_upper_val)
             console.log(rate_val)
 
             if(rate_val != '' &&  rate_val != NULL && (rate_val < rate_lower_val || rate_val > rate_upper_val ))
             {
                 swal('warning','please input rate between rate lower and rate upper building','input error')
             }
         }
         else{
             swal('warning','please choose building const first','error')
         }
    });
 
    $("#slipbasicpremiumupdate").keyup(function(e) 
   { 
        var keyCode = e.keyCode || e.which; 

        if (keyCode == 9){ 
            calculateTotalRateByPremium('update')
        }
        else{
            calculateTotalRateByPremium('update')
            
        }

   });
 
    $('#slipshareupdate').change(function (e) {
         if(e.keyCode != 9){
            calculateShare('update')
         }
     });
 
    
 
     $('#slipcommissionupdate').keyup(function (e) {
         var keyCode = e.keyCode || e.which;
 
         if (keyCode != 9){
             calculateComm('update')
         }else{
             calculateComm('update')
         }
 
     });
 
    $('#slipcommissionupdate').keydown(function (e) {
         var keyCode = e.keyCode || e.which;
 
         if (keyCode != 9){
             calculateComm('update')
         }else{
             calculateComm('update')
         }
 
     });
 
    $('#slipcommissionupdate').keypress(function (e) {
         var keyCode = e.keyCode || e.which;
 
         if (keyCode != 9){
             calculateComm('update')
         }else{
             calculateComm('update')
         }
 
     });
 
    $('#slipsumcommissionupdate2').keyup(function(e){
         var keyCode = e.keyCode || e.which; 
 
         if (keyCode != 9){
             calculatePercentComm('update')
         }else{
             calculatePercentComm('update')
         }
    });
 
    $('#slipsumcommissionupdate2').keydown(function(e){
         var keyCode = e.keyCode || e.which; 
 
         if (keyCode != 9){
             calculatePercentComm('update')
         }else{
             calculatePercentComm('update')
         }
    });
 
    $('#slipsumcommissionupdate2').keypress(function(e){
         var keyCode = e.keyCode || e.which; 
 
         if (keyCode != 9){
             calculatePercentComm('update')
         }else{
             calculatePercentComm('update')
         }
    });
 
 
 
 
    $('#slipvbrokerupdate').keyup(function(e){ 
        var keyCode = e.keyCode || e.which; 
 
        if (keyCode != 9) {
            calculateFeeBroker('update')
         }
     });
 
    $('#slipvbrokerupdate').keydown(function(e){
             var keyCode = e.keyCode || e.which; 
 
         if (keyCode != 9) {
            calculateFeeBroker('update')
         }else{
            calculateFeeBroker('update')
         }
     });
 
    $('#slipvbrokerupdate').keypress(function(e){
        var keyCode = e.keyCode || e.which; 
        if (keyCode != 9) {
            calculateFeeBroker('update')
        }else{
            calculateFeeBroker('update')
        }
     });
  
 
    $('#slipsumfeeupdate2').keyup(function(e){
         var keyCode = e.keyCode || e.which; 
 
         if (keyCode != 9) {
            calculatePercentFee('update')
         }else{
            calculatePercentFee('update')
         }
    });
 
    $('#slipsumfeeupdate2').keydown(function(e){
         var keyCode = e.keyCode || e.which; 
 
         if (keyCode != 9) {
            calculatePercentFee('update')
         }else{
            calculatePercentFee('update')
         }
    });
 
    $('#slipsumfeeupdate2').keypress(function(e){
         var keyCode = e.keyCode || e.which; 
 
         if (keyCode != 9) {
            calculatePercentFee('update')
         }else{
            calculatePercentFee('update')
         }
    });
 
 
    $('#slipvbrokerupdate').change(function(){
 
         if( $('#installmentPanel tbody').find('tr').val().length > 0){
             swal('warning!','netprm to nr changed, please change installment amount manually','success')
         }
 
    });
    // For Convert
    $('#slipippercentageupdate').keyup(function (e) {
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
                 $('#slipsumorupdate').val(sum);
                 $('#slipsumorupdate2').val(sum);
             }
 
             
 
 
         }
     });
 
    $('#sliprppercentageupdate').keyup(function (e) {
        calculateRetro('update')
     });
 
    $('#sliprppercentageupdate').change(function (e) {
         calculateRetro('update')
     });
 
    $('#slipnilaiecupdate').keyup(function () {
         var persentage =  parseFloat($('#slipnilaiecupdate').val()) / 1000;
         var sliptotalsum =  $('#sliptotalsumupdate').val();
         var conv_sliptotalsum = parseFloat(sliptotalsum.replace(/,/g, ""));
        //alert(premiumnr);
        //alert(persentage);
         var sum = isNaN(conv_sliptotalsum * persentage) ? 0 :(conv_sliptotalsum * persentage) ;
         var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        //alert(sum);
         console.log($(this).val())
         console.log(persentage)
         console.log(sum)
         console.log(real_sum)
 
         $('#slipamountecupdate').val(sum);
         $('#slipamountecupdate2').val(sum);
    });
 </script>
 
 <script  type='text/javascript'>
    $('#slippctendorsement').keyup(function (e) {
         if(e.keyCode != 9){
             var pct =  parseFloat($(this).val())/100;
 
             var tsi = $("#sliptotalsumendorsement").val();
             var conv_tsi = parseFloat(tsi.replace(/,/g, ""));
 
             var sum = isNaN(pct * conv_tsi) ? 0 :(pct * conv_tsi) ;
             console.log(sum)
             var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
             $('#sliptotalsumpctendorsement').val(sum);
             $('#sliptotalsumpctendorsement2').val(sum);
         }
     });
 
    $('#slipdppercentageendorsement').keyup(function (e) {
         if(e.keyCode != 9){
             var percent =  parseFloat($(this).val()) / 100;
             var tsi = $("#sliptotalsumendorsement").val();
             var conv_tsi = parseFloat(tsi.replace(/,/g, ""));
             var sum = isNaN(percent * conv_tsi) ? 0 :(percent * conv_tsi) ;
             var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
             console.log($(this).val())
             console.log(percent)
             console.log(sum)
             console.log(real_sum)
 
             $('#slipdpamountendorsement').val(sum);
             $('#slipdpamountendorsement2').val(sum);
         }
     });
 
    $('#slipshareendorsement').keyup(function (e) 
        {
         if(e.keyCode != 9){
            calculateShare('endorsement')
         }
     });
 
 
    $('#sliprateendorsement').keyup(function (e) {
        
        if(e.keyCode != 9){
            calculateTotalRate('endorsement');
            // calculateBasicPremium('endorsement');

         }else{   
            calculateTotalRate('endorsement');
            // calculateBasicPremium('endorsement');
         }     
    });
 
 
 
    $('#sliprateendorsement').change(function(){
         var rate_lower = $('#slipbclaendorsement').val();
         var rate_upper = $('#slipbcuaendorsement').val();
         var rate = $('#sliprateendorsement').val();
         
 
         if(rate_upper != "" || rate_lower != ""){
             var rate_lower_val = parseFloat(rate_lower);
             var rate_upper_val = parseFloat(rate_upper);
             var rate_val = parseFloat(rate);
             console.log(rate_lower_val)
             console.log(rate_upper_val)
             console.log(rate_val)
             if(rate_val < rate_lower_val || rate_val > rate_upper_val ){
                 swal('warning','please input rate between rate lower and rate upper building','input error')
             }
             
 
         }else if(rate_upper == "0" && rate_lower == "0"){
             var rate_lower_val = parseFloat(rate_lower);
             var rate_upper_val = parseFloat(rate_upper);
             var rate_val = parseFloat(rate);
             console.log(rate_lower_val)
             console.log(rate_upper_val)
             console.log(rate_val)
 
             if(rate_val != '' &&  rate_val != NULL && (rate_val < rate_lower_val || rate_val > rate_upper_val ))
             {
                 swal('warning','please input rate between rate lower and rate upper building','input error')
             }
         }
         else{
             swal('warning','please choose building const first','error')
         }
    });
 
    $("#slipbasicpremiumendorsement").keyup(function(e) 
   { 
        var keyCode = e.keyCode || e.which; 

       if (keyCode == 9){ 
            calculateTotalRateByPremium('endorsement')
            
        }
        else{
            calculateTotalRateByPremium('endorsement')
            
        }

   });
 
    $('#slipshareendorsement').change(function (e) {
         var keyCode = e.keyCode || e.which; 
         if(e.keyCode != 9){
            calculateShare('endorsement')
         }
     });
     
     $('#slipcommissionendorsement').keyup(function (e) {
         var keyCode = e.keyCode || e.which;
 
         if (keyCode != 9){
             calculateComm('endorsement')
         }else{
             calculateComm('endorsement')
         }
     });
 
    $('#slipcommissionendorsement').keydown(function (e) {
         var keyCode = e.keyCode || e.which;
 
         if (keyCode != 9){
             calculateComm('endorsement')
         }else{
             calculateComm('endorsement')
         }
 
     });
 
    $('#slipcommissionendorsement').keypress(function (e) {
         var keyCode = e.keyCode || e.which;
 
        if (keyCode != 9){
             calculateComm('endorsement')
         }else{
             calculateComm('endorsement')
         }
 
     });
 
    $('#slipsumcommissionendorsement2').keyup(function(e){
         var keyCode = e.keyCode || e.which; 
 
         if (keyCode != 9){
             calculatePercentComm('endorsement')
         }else{
             calculatePercentComm('endorsement')
         }
    });
 
    $('#slipsumcommissionendorsement2').keydown(function(e){
         var keyCode = e.keyCode || e.which; 
 
         if (keyCode != 9){
             calculatePercentComm('endorsement')
         }else{
             calculatePercentComm('endorsement')
         }
    });
 
    $('#slipsumcommissionendorsement2').keypress(function(e){
         var keyCode = e.keyCode || e.which; 
 
         if (keyCode != 9){
             calculatePercentComm('endorsement')
         }else{
             calculatePercentComm('endorsement')
         }
    });
 
 
 
 
    $('#slipvbrokerendorsement').keyup(function(e){
        var keyCode = e.keyCode || e.which; 
 
        if (keyCode != 9) {
            calculateFeeBroker('endorsement')  
        }
     });
 
    $('#slipvbrokerendorsement').keydown(function(e){
        var keyCode = e.keyCode || e.which; 
 
         if (keyCode != 9) {
            calculateFeeBroker('endorsement')  
        }
     });
 
    $('#slipvbrokerendorsement').keypress(function(e){
        var keyCode = e.keyCode || e.which; 
 
        if (keyCode != 9) {
            calculateFeeBroker('endorsement')  
        }
     });
  
 
    $('#slipsumfeeendorsement2').keyup(function(e){
         var keyCode = e.keyCode || e.which; 
 
         if (keyCode != 9) {
             
            calculatePercentFee('endorsement')
             
         }
    });
 
    $('#slipsumfeeendorsement2').keydown(function(e){
         var keyCode = e.keyCode || e.which; 
 
         if (keyCode != 9) {
             
            calculatePercentFee('endorsement')
             
         }
    });
 
    $('#slipsumfeeendorsement2').keypress(function(e){
         var keyCode = e.keyCode || e.which; 
 
         if (keyCode != 9) {
             
            calculatePercentFee('endorsement')
             
         }
    });
 
    $('#slipvbrokerendorsement').change(function(){
 
         if( $('#installmentPanel tbody').find('tr').val().length > 0){
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
 
             var sum = isNaN(percent * conv_sumshare) ? 0 :(percent * conv_sumshare).toFixed(2);
             var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
 
             if($(this).val() > 100){
                 swal('warning!','percentage cannot more than 100%','sum value error');
                 $('#slipsumorendorsement').empty();
                 $('#slipsumorendorsement2').empty();
             }else{
                 $('#slipsumorendorsement').val(sum);
                 $('#slipsumorendorsement2').val(sum);
             }
 
             
 
 
         }
     });
 
    $('#sliprppercentageendorsement').keyup(function (e) {
        calculateRetro('endorsement')
     });
 
    $('#sliprppercentageendorsement').change(function (e) {
        calculateRetro('endorsement')
     });
 
    $('#slipnilaiecendorsement').keyup(function () {
         var persentage =  parseFloat($('#slipnilaiecendorsement').val()) / 1000;
         var sliptotalsum =  $('#sliptotalsumendorsement').val();
         var conv_sliptotalsum = parseFloat(sliptotalsum.replace(/,/g, ""));
        //alert(premiumnr);
        //alert(persentage);
         var sum = isNaN(conv_sliptotalsum * persentage) ? 0 :(conv_sliptotalsum * persentage) ;
         var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        //alert(sum);
         console.log($(this).val())
         console.log(persentage)
         console.log(sum)
         console.log(real_sum)
 
         $('#slipamountecendorsement').val(sum);
         $('#slipamountecendorsement2').val(sum);
    });
 </script>

{{-- form table input data --}}
<script type="text/javascript">
    $('#form-cancelstatus').submit(function(e){
        e.preventDefault();
        // alert('sukses');
         var remarks = $('#remarkscancel').val();
         var slipnumber = $('#slipnumbercancel').val();
         var insured_id = $('#insuredIDtxt').val();
         var code_ms = $('#insuredIDtxt').val();
         var token2 = $('input[name=_token]').val();
         var slip_type = $('#sliptypeform').val();
         var endorsement = $('#countendorsementcancel').val();
         var username = $('#usernamecancel').val();
         console.log(slipnumber);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

                //url:"{{url('transaction-data/fe-slip/cancelformnumber/')}}"+slipnumber,

                $.ajax({
                 url:"{{url('transaction-data/"+slip_type+"/cancelslip')}}",
                 type:"POST",
                 data:{
                     code_ms:code_ms,
                     slipnumber:slipnumber,
                     slip_type:slip_type,
                     endorsement:endorsement,
                     username:username,
                     remarks:remarks
                 },
                 beforeSend: function() { $("body").addClass("loading");  },
                 complete: function() {  $("body").removeClass("loading"); },
                 success:function(response)
                 {
                    swal("Success!", "Slip Update Status Cancelled", "success")
                    console.log(response)
                    

                    $('#cancelmodaldata').modal('toggle');
                    refreshTableSlip(insured_id);
                    // var slipdata= JSON.parse(response.slip_data_distinct);
                    // var slipdatadetail= JSON.parse(response.slip_data2);
                    // var max_endorsement = response.max_endorsement;
                    // console.log('max endorse ' + response.max_endorsement)
                    // $('#SlipInsuredTableData tbody').empty();
                    // for(var i = 0; i < slipdata.length; i++){

                    //         var id = slipdata[i].id;
                    //         var number = slipdata[i].number;

                    //         for(var i = 0; i < slipdatadetail.length; i++){

                    //         var cedingbroker = slipdatadetail[i].name;
                    //         var cedingbrokercn = slipdatadetail[i].company_name;
                    //         var ceding = slipdatadetail[i].source_name;
                    //         var cedingcn = slipdatadetail[i].source_companyname;
                    //         var id_detail = slipdatadetail[i].id;
                    //         var statusdetail = slipdatadetail[i].status;
                    //         var endorsmentdetail = slipdatadetail[i].endorsment;
                    //         var date_transfer = slipdatadetail[i].date_transfer;

                    //         if(endorsmentdetail == max_endorsement){
                    //             if(date_transfer == null){
                    //                 if(statusdetail == 'cancel' || statusdetail == 'decline'){
                    //                     $('#SlipInsuredTableData').append('<tr id="slipiid'+id+'" data-name="slipvalue[]">'
                    //                     +'<td data-name="'+number+'">'+number+'</td>'
                    //                     +'<td data-name="'+cedingbroker+'">'+cedingbroker+'-'+cedingbrokercn+'</td>'
                    //                     +'<td data-name="'+ceding+'">'+ceding+'-'+cedingcn+'</td>'
                    //                     +'<td data-name="'+statusdetail+'">'+statusdetail+'</td>'
                    //                     +'<td data-name="'+endorsmentdetail+'">'+endorsmentdetail+'</td>'
                    //                     +'<td>'
                    //                     // +'<a class="text-primary mr-3 float-right" data-toggle="modal"  data-book-id="'+id_detail+'" data-target="#detailmodaldata" href="#detailmodaldata">'
                    //                     // +'<button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#detailmodaldata2">Detail</button>'
                    //                     // +'</a>'
                    //                     // +'<a class="text-primary mr-3 float-right " data-toggle="modal" data-book-id="'+id_detail+'" data-target="#endorsementmodaldata">'
                    //                     // +'<button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#endorsementmodaldata2">Endorsement</button>'
                    //                     // +'</a>'
                    //                     +'</td></tr>');
                    //                 }else{
                    //                     $('#SlipInsuredTableData').append('<tr id="slipiid'+id+'" data-name="slipvalue[]">'
                    //                     +'<td data-name="'+number+'">'+number+'</td>'
                    //                     +'<td data-name="'+cedingbroker+'">'+cedingbroker+'-'+cedingbrokercn+'</td>'
                    //                     +'<td data-name="'+ceding+'">'+ceding+'-'+cedingcn+'</td>'
                    //                     +'<td data-name="'+statusdetail+'">'+statusdetail+'</td>'
                    //                     +'<td data-name="'+endorsmentdetail+'">'+endorsmentdetail+'</td>'
                    //                     +'<td><a class="text-primary mr-3 float-right" data-toggle="modal"  data-book-id="'+id_detail+'" data-target="#detailmodaldata" href="#detailmodaldata">'
                    //                     +'<button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#detailmodaldata2">Detail</button>'
                    //                     +'</a>'
                    //                     +'<a class="text-primary mr-3 float-right " data-toggle="modal" data-book-id="'+id_detail+'" data-target="#updatemodaldata">'
                    //                     +'<button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#updatemodaldata2">Edit</button>'
                    //                     +'</a>'
                    //                     +'<a class="text-primary mr-3 float-right " data-toggle="modal" data-book-id="'+id_detail+'" data-target="#cancelmodaldata">'
                    //                     +'<button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#cancelmodaldata2">Cancel</button>'
                    //                     +'</a>'
                    //                     +'</td></tr>');
                    //                 }
                    //             }else if(date_transfer != null){
                    //                 if(statusdetail == 'cancel' || statusdetail == 'decline'){
                    //                     $('#SlipInsuredTableData').append('<tr id="slipiid'+id+'" data-name="slipvalue[]">'
                    //                     +'<td data-name="'+number+'">'+number+'</td>'
                    //                     +'<td data-name="'+cedingbroker+'">'+cedingbroker+'-'+cedingbrokercn+'</td>'
                    //                     +'<td data-name="'+ceding+'">'+ceding+'-'+cedingcn+'</td>'
                    //                     +'<td data-name="'+statusdetail+'">'+statusdetail+'</td>'
                    //                     +'<td data-name="'+endorsmentdetail+'">'+endorsmentdetail+'</td>'
                    //                     +'<td><a class="text-primary mr-3 float-right" data-toggle="modal"  data-book-id="'+id_detail+'" data-target="#detailmodaldata" href="#detailmodaldata">'
                    //                     +'<button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#detailmodaldata2">Detail</button>'
                    //                     +'</a>'
                    //                     +'<a class="text-primary mr-3 float-right " data-toggle="modal" data-book-id="'+id_detail+'" data-target="#endorsementmodaldata">'
                    //                     +'<button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#endorsementmodaldata2">Endorsement</button>'
                    //                     +'</a>'
                    //                     +'</td></tr>');
                    //                 }else{
                    //                     $('#SlipInsuredTableData').append('<tr id="slipiid'+id+'" data-name="slipvalue[]">'
                    //                     +'<td data-name="'+number+'">'+number+'</td>'
                    //                     +'<td data-name="'+cedingbroker+'">'+cedingbroker+'-'+cedingbrokercn+'</td>'
                    //                     +'<td data-name="'+ceding+'">'+ceding+'-'+cedingcn+'</td>'
                    //                     +'<td data-name="'+statusdetail+'">'+statusdetail+'</td>'
                    //                     +'<td data-name="'+endorsmentdetail+'">'+endorsmentdetail+'</td>'
                    //                     +'<td><a class="text-primary mr-3 float-right" data-toggle="modal"  data-book-id="'+id_detail+'" data-target="#detailmodaldata" href="#detailmodaldata">'
                    //                     +'<button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#detailmodaldata2">Detail</button>'
                    //                     +'</a>'
                    //                     +'<a class="text-primary mr-3 float-right " data-toggle="modal" data-book-id="'+id_detail+'" data-target="#endorsementmodaldata">'
                    //                     +'<button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#endorsementmodaldata2">Endorsement</button>'
                    //                     +'</a>'
                    //                     +'<a class="text-primary mr-3 float-right " data-toggle="modal" data-book-id="'+id_detail+'" data-target="#cancelmodaldata">'
                    //                     +'<button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#cancelmodaldata2">Cancel</button>'
                    //                     +'</a>'
                    //                     +'</td></tr>');
                    //                 }
                    //             }
                                
                            
                    //         }else{
                    //             $('#slipiid'+id).after('<tr><td></td>'
                    //             +'<td data-name="'+cedingbroker+'">'+cedingbroker+'-'+cedingbrokercn+'</td>'
                    //             +'<td data-name="'+ceding+'">'+ceding+'-'+cedingcn+'</td>' 
                    //             +'<td data-name="'+statusdetail+'">'+statusdetail+'</td>'
                    //             +'<td data-name="'+endorsmentdetail+'">'+endorsmentdetail+'</td>'
                    //             +'<td><a class="text-primary mr-3 float-right" data-toggle="modal"  data-book-id="'+id_detail+'" data-target="#detailmodaldata" href="#detailmodaldata">'
                    //             +'<button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#detailmodaldata2">Detail</button>'
                    //             +'</a>'
                    //             +'</td></tr>');
                    //         }
                            
                            

                    //     };

                    // };

                    // },
                    // error: function (request, status, error) {
                    //     //alert(request.responseText);
                    //     swal("Error!", "Slip Update Error", "Update Error");
                    // }
                }
                });


    });
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
           var code_ms = $('#insuredIDtxt').val();
           var countendorsement = 0;
           var sliptype = $('#sliptypeform').val();
           var real_minamount = 0;
           if(minamount == ''){
               real_minamount = 0;
           }
           else{
            var conv_minamount = minamount.replace(/,/g, "");
            console.log(conv_minamount)
            real_minamount = parseInt(conv_minamount);
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
             countendorsement:countendorsement,
             sliptype:sliptype
         },
         beforeSend: function() { $("body").addClass("loading");  },
         complete: function() {  $("body").removeClass("loading"); },
         success:function(response)
         {

             console.log(response)
             console.log(amountToString(response.amount));
             if (response.message) {
              swal('warning!',response.message,'failed')
             }else{
                var percent = convert(parseFloat(response.amount).toString());
                console.log("Test P "+percent)
                //    var curr_amount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(response.amount);
                // // var curr_amount = response.amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                //    var curr_minamount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(response.min_claimamount);
                // var curr_minamount = response.min_claimamount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('#deductiblePanel tbody').append('<tr id="iiddeductible'+response.id+'" data-name="deductiblevalue[]"><td data-name="'+response.deductibletype+'">'+response.deductibletype+'</td><td data-name="'+floatToString(response.percentage)+'">'+floatToString(response.percentage)+' %</td><td data-name="'+amountToString(response.amount)+'" class="uangdata">'+amountToString(response.amount)+'</td><td data-name="'+amountToString(response.min_claimamount)+'">'+amountToString(response.min_claimamount)+'</td><td><a href="javascript:void(0)" onclick="deletedeductibledetail('+response.id+')">delete</a></td></tr>');
                $('#slipdppercentage').val('');
                $('#slipdpamount').val('');
                $('#slipdpamount2').val('');
                $('#slipdpminamount').val('');
             }
                

            }
        });

    });
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
           var code_ms = $('#insuredIDtxt').val();
           var sliptype = $('#sliptypeform').val();;
           var countendorsement = $('#countendorsmentupdate').val();
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
             countendorsement:countendorsement,
             sliptype:sliptype
         },
         beforeSend: function() { $("body").addClass("loading");  },
         complete: function() {  $("body").removeClass("loading"); },
         success:function(response)
         {

             console.log(response)
                //    var curr_amount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(response.amount);
                // var curr_amount = response.amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                //    var curr_minamount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(response.min_claimamount);
                // var curr_minamount = response.min_claimamount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('#deductiblePanelupdate tbody').append('<tr id="iiddeductibleupdate'+response.id+'" data-name="deductiblevalue[]"><td data-name="'+response.deductibletype+'">'+response.deductibletype+'</td><td data-name="'+floatToString(response.percentage)+'">'+floatToString(response.percentage)+'</td><td data-name="'+amountToString(response.amount)+'">'+amountToString(response.amount)+'</td><td data-name="'+amountToString(response.min_claimamount)+'">'+amountToString(response.min_claimamount)+'</td><td><a href="javascript:void(0)" onclick="deletedeductibleupdate('+response.id+')">delete</a></td></tr>');
                $('#slipdppercentageupdate').val('');
                $('#slipdpamountupdate').val('');
                $('#slipdpamountupdate2').val('');
                $('#slipdpminamountupdate').val('');

            }
        });

    });
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
           var code_ms = $('#insuredIDtxt').val();
           var sliptype = $('#sliptypeform').val();
           var countendorsement = $('#countendorsmentdata').val();
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
             amount:real_amount,
             minamount:real_minamount,
             id_slip:slip_id,
             insured_id:code_ms,
             countendorsement:countendorsement,
             sliptype:sliptype
         },
         beforeSend: function() { $("body").addClass("loading");  },
         complete: function() {  $("body").removeClass("loading"); },
         success:function(response)
         {

             console.log(response)
                //    var curr_amount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(response.amount);
                // var curr_amount = response.amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                //    var curr_minamount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(response.min_claimamount);
                // var curr_minamount = response.min_claimamount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('#deductiblePanelendorsement tbody').append('<tr id="iiddeductibleendorsement'+response.id+'" data-name="deductiblevalue[]"><td data-name="'+response.deductibletype+'">'+response.deductibletype+'</td><td data-name="'+floatToString(response.percentage)+'">'+floatToString(response.percentage)+'</td><td data-name="'+amountToString(response.amount)+'">'+amountToString(curr_amount)+'</td><td data-name="'+amountToString(response.min_claimamount)+'">'+amountToString(response.min_claimamount)+'</td><td><a href="javascript:void(0)" onclick="deletedeductibleendorsement('+response.id+')">delete</a></td></tr>');
                $('#slipdppercentageendorsement').val('');
                $('#slipdpamountendorsement').val('');
                $('#slipdpamountendorsement2').val('');
                $('#slipdpminamountendorsement').val('');

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
</script>
<script type='text/javascript'>
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
</script>
<script type='text/javascript'>
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
</script>


<script type='text/javascript'>
    $('#addextendcoverageinsured-btn').click(function(e){
       //alert('masuk');
       e.preventDefault();
       var countendorsement = $('#countendorsmentdata').val();
       var slipcncode = $('#slipcncode').val();
       var percentage = $('#slipnilaiec').val();
       var amount = $('#slipamountec').val();
       var code_ms = $('#insuredIDtxt').val();
       var sliptype = $('#sliptypeform').val();      
       
       var slip_id = $('#slipnumber').val();
       var token2 = $('input[name=_token2]').val();

       var conv_amount = amount.replace(/,/g, "");
       console.log(conv_amount)
       var real_amount = conv_amount;
       console.log(real_amount)

       
       $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

       $.ajax({
             url:"{{ route('extendcoverage.store') }}",
             type:"POST",
             data:{
                 slipcncode:slipcncode,
                 percentage:percentage,
                 countendorsement:countendorsement,
                 amount:real_amount,
                 id_slip:slip_id,
                 insured_id:code_ms,
                 sliptype:sliptype
             },
             beforeSend: function() { $("body").addClass("loading");  },
             complete: function() {  $("body").removeClass("loading"); },
             success:function(response)
             {
                 console.log(response)
                if(response.success == false){
                    swal('warning!',response.message,'failed')
                }else{
                    // var curr_amount = response.amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    $('#ExtendCoveragePanel tbody').append('<tr id="iidextendcoverage'+response.id+'" data-name="extendcoveragevalue[]"><td data-name="'+response.coveragetype+'">' +response.coveragecode+ ' - ' +response.coveragename+'</td><td data-name="'+floatToString(response.percentage)+'">'+floatToString(response.percentage)+'</td><td data-name="'+amountToString(response.amount)+'" class="uangdata">'+amountToString(response.amount)+'</td><td><a href="javascript:void(0)" onclick="deleteextendcoveragedetail('+response.id+')">delete</a></td></tr>');
                    

                    var total_percent =  $('#sliptotalnilaiec').val();
                    

                    if(total_percent == ''){
                        var sum_percent = isNaN(parseFloat(0) + parseFloat(response.percentage)) ? 0 :(parseFloat(0) + parseFloat(response.percentage)) ;
                        $('#sliptotalnilaiec').val(sum_percent.toString());
                        console.log('total rate extend_coverage ' + $('#sliptotalnilaiec').val())
                        var total_rate = $('#sliptotalrate').val();
                        if(total_rate){
                            var sum_totalrate = isNaN(parseFloat(total_rate) + parseFloat(response.percentage)) ? 0 :(parseFloat(total_rate) + parseFloat(response.percentage)) ;
                            $('#sliptotalrate').val(sum_totalrate.toString());
                            $('#sliptotalrate2').val(sum_totalrate.toString());

                            


                        }
                    }else{
                        var sum_percent = isNaN(parseFloat(total_percent) + parseFloat(response.percentage)) ? 0 :(parseFloat(total_percent) + parseFloat(response.percentage))
                        $('#sliptotalnilaiec').val(sum_percent.toString());
                        console.log('total rate extend_coverage ' + $('#sliptotalnilaiec').val())
                        var total_rate = $('#sliptotalrate').val();
                        if(total_rate){
                            var sum_totalrate = isNaN(parseFloat(total_rate) + parseFloat(response.percentage)) ? 0 :(parseFloat(total_rate) + parseFloat(response.percentage)) ;
                            $('#sliptotalrate').val(sum_totalrate);
                            $('#sliptotalrate2').val(sum_totalrate);



                        }
                        
                    }


                    $('#slipnilaiec').val('');
                    $('#slipamountec').val('');
                    $('#slipamountec2').val('');
                    calculateBasicPremium('slip');
                    calculateComm('slip');
                    calculateFeeBroker('slip');
                }
                //    var curr_amount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(response.amount);
               



            }
        });

   });
</script>
<script type='text/javascript'>
    $('#addextendcoverageinsuredupdate-btn').click(function(e){
       //alert('masuk');
       e.preventDefault();

       var slipcncode = $('#slipcncodeupdate').val();
       var percentage = $('#slipnilaiecupdate').val();
       var amount = $('#slipamountecupdate').val();
       var code_ms = $('#insuredIDtxt').val();
       var sliptype = $('#sliptypeform').val();      
       
       var countendorsement = $('#countendorsmentupdate').val();
       var slip_id = $('#slipnumberupdate').val();
       var token2 = $('input[name=_token2]').val();

       var conv_amount = amount.replace(/,/g, "");
       console.log(conv_amount)
       var real_amount = conv_amount;
       console.log(real_amount)

       
       $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

       $.ajax({
             url:"{{ route('extendcoverage.store') }}",
             type:"POST",
             data:{
                 slipcncode:slipcncode,
                 percentage:percentage,
                 amount:real_amount,
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
                // var curr_amount = response.amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('#ExtendCoveragePanelupdate tbody').append('<tr id="iidextendcoverageupdate'+response.id+'" data-name="extendcoveragevalue[]"><td data-name="'+response.coveragetype+'">' +response.coveragecode+ ' - ' +response.coveragename+'</td><td data-name="'+floatToString(response.percentage)+'">'+floatToString(response.percentage)+'</td><td data-name="'+amountToString(response.amount)+'" class="uangdata">'+amountToString(response.amount)+'</td><td><a href="javascript:void(0)" onclick="deleteextendcoverageupdate('+response.id+')">delete</a></td></tr>');
                

                var total_percent =  $('#sliptotalnilaiecupdate').val();
                

                if(total_percent == ''){
                    var sum_percent = isNaN(parseFloat(0) + parseFloat(response.percentage)) ? 0 :(parseFloat(0) + parseFloat(response.percentage)) ;
                    $('#sliptotalnilaiecupdate').val(sum_percent.toString());
                    console.log('total rate extend_coverage ' + $('#sliptotalnilaiecupdate').val())
                    var total_rate = $('#sliptotalrate').val();
                    if(total_rate){
                        var sum_totalrate = isNaN(parseFloat(total_rate) + parseFloat(response.percentage)) ? 0 :(parseFloat(total_rate) + parseFloat(response.percentage)) ;
                        $('#sliptotalrateupdate').val(sum_totalrate.toString());
                        $('#sliptotalrateupdate2').val(sum_totalrate.toString());

                        
                    }
                }else{
                    var sum_percent = isNaN(parseFloat(total_percent) + parseFloat(response.percentage)) ? 0 :(parseFloat(total_percent) + parseFloat(response.percentage))
                    $('#sliptotalnilaiecupdate').val(sum_percent.toString());
                    console.log('total rate extend_coverage ' + $('#sliptotalnilaiecupdate').val())
                    var total_rate = $('#sliptotalrateupdate').val();
                    if(total_rate){
                        var sum_totalrate = isNaN(parseFloat(total_rate) + parseFloat(response.percentage)) ? 0 :(parseFloat(total_rate) + parseFloat(response.percentage)) ;
                        $('#sliptotalrateupdate').val(sum_totalrate.toString());
                        $('#sliptotalrateupdate2').val(sum_totalrate.toString());

                        
                    }
                    
                }


                $('#slipnilaiecupdate').val('');
                $('#slipamountecupdate').val('');
                $('#slipamountecupdate2').val('');

                calculateBasicPremium('update');
                    calculateComm('update');
                    calculateFeeBroker('update');



            }
        });

   });
</script>
<script type='text/javascript'>
    $('#addextendcoverageinsuredendorsement-btn').click(function(e){
       //alert('masuk');
       e.preventDefault();

       var slipcncode = $('#slipcncodeendorsement').val();
       var percentage = $('#slipnilaiecendorsement').val();
       var amount = $('#slipamountecendorsement').val();
       var code_ms = $('#insuredIDtxt').val();
       var sliptype = $('#sliptypeform').val();      
       var countendorsement = $('#countendorsmentdata').val();
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
             url:"{{ route('extendcoverage.store') }}",
             type:"POST",
             data:{
                 slipcncode:slipcncode,
                 percentage:percentage,
                 amount:real_amount,
                 id_slip:slip_id,
                 insured_id:code_ms,
                 countendorsement:countendorsement,
                 sliptype:sliptype
             },
             beforeSend: function() { $("body").addClass("loading");  },
             complete: function() {  $("body").removeClass("loading"); },
             success:function(response)
             {


                 console.log(response)
                //    var curr_amount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(response.amount);
                // var curr_amount = response.amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('#ExtendCoveragePanelendorsement tbody').append('<tr id="iidextendcoverageendorsement'+response.id+'" data-name="extendcoveragevalue[]"><td data-name="'+response.coveragetype+'">' +response.coveragecode+ ' - ' +response.coveragename+'</td><td data-name="'+floatToString(response.percentage)+'">'+floatToString(response.percentage)+'</td><td data-name="'+amountToString(response.amount)+'" class="uangdata">'+amountToString(response.amount)+'</td><td><a href="javascript:void(0)" onclick="deleteextendcoverageendorsement('+response.id+')">delete</a></td></tr>');
                

                var total_percent =  $('#sliptotalnilaiecendorsement').val();
                

                if(total_percent == ''){
                    var sum_percent = isNaN(parseFloat(0) + parseFloat(response.percentage)) ? 0 :(parseFloat(0) + parseFloat(response.percentage)) ;
                    $('#sliptotalnilaiecendorsement').val(sum_percent.toString());
                    console.log('total rate extend_coverage ' + $('#sliptotalnilaiecendorsement').val())
                    var total_rate = $('#sliptotalrate').val();
                    if(total_rate){
                        var sum_totalrate = isNaN(parseFloat(total_rate) + parseFloat(response.percentage)) ? 0 :(parseFloat(total_rate) + parseFloat(response.percentage)) ;
                        $('#sliptotalrateendorsement').val(sum_totalrate.toString());
                        $('#sliptotalrateendorsement2').val(sum_totalrate.toString());

                        
                    }
                }else{
                    var sum_percent = isNaN(parseFloat(total_percent) + parseFloat(response.percentage)) ? 0 :(parseFloat(total_percent) + parseFloat(response.percentage))
                    $('#sliptotalnilaiecendorsement').val(sum_percent.toString());
                    console.log('total rate extend_coverage ' + $('#sliptotalnilaiecendorsement').val())
                    var total_rate = $('#sliptotalrateendorsement').val();
                    if(total_rate){
                        var sum_totalrate = isNaN(parseFloat(total_rate) + parseFloat(response.percentage)) ? 0 :(parseFloat(total_rate) + parseFloat(response.percentage)) ;
                        $('#sliptotalrateendorsement').val(sum_totalrate.toString());
                        $('#sliptotalrateendorsement2').val(sum_totalrate.toString());

                        
                    }
                    
                }
                calculateBasicPremium('endorsement');
                    calculateComm('endorsement');
                    calculateFeeBroker('endorsement');

                $('#slipnilaiecendorsement').val('');
                $('#slipamountecendorsement').val('');
                $('#slipamountecendorsement2').val('');



            }
        });

   });
</script>

<script type='text/javascript'>
    function deleteextendcoveragedetail(id)
    {
        var token2 = $('input[name=_token2]').val();

        $.ajax({
            url:'{{ url("/") }}/delete-extendcoverage-list/'+id,
            type:"DELETE",
            data:{
                _token:token2
            },
            beforeSend: function() { $("body").addClass("loading");  },
            complete: function() {  $("body").removeClass("loading"); },
            success:function(response){

                var total_percent =  $('#sliptotalnilaiec').val();

                
                var sum_percent = isNaN(parseFloat(total_percent) - parseFloat(response.percentage)) ? 0 :(parseFloat(total_percent) - parseFloat(response.percentage))
                console.log('total = ' + parseFloat(total_percent))
                console.log('percentexc = ' + parseFloat(response.percentage))
                $('#sliptotalnilaiec').val(sum_percent.toString());
                console.log($('#sliptotalnilaiec').val())

                var total_rate = $('#sliptotalrate').val();
                if(total_rate){
                    var sum_totalrate = isNaN(parseFloat(total_rate) - parseFloat(response.percentage)) ? 0 :(parseFloat(total_rate) - parseFloat(response.percentage)) ;
                    $('#sliptotalrate').val(sum_totalrate.toString());
                    $('#sliptotalrate2').val(sum_totalrate.toString());
                    calculateBasicPremium('slip');
                    calculateComm('slip');
                    calculateFeeBroker('slip');
                    // try{
                    //     var insurance_period_from2 = $('#sliprpfrom').val();
                    //     var insurance_period_to2 = $('#sliprpto').val();
                    //     var newinsurance_period_from2 = insurance_period_from2.split("/").reverse().join("-");
                    //     var newinsurance_period_to2 = insurance_period_to2.split("/").reverse().join("-");
                    //     var days=daysBetween(newinsurance_period_from2, newinsurance_period_to2);
                    //     var insurance = (days/365);

                    //     var tsi = $("#sharetotalsum").val();
                    //     var conv_tsi = parseFloat(tsi.replace(/,/g, ""));       
                    //     var sumrate = $("#sliptotalrate").val();
                    //     var conv_sumrate = parseFloat(sumrate.replace(/,/g, ""));
                    //     var sum = isNaN(((conv_sumrate / 1000) * conv_tsi) * insurance) ? 0 :(((conv_sumrate / 1000) * conv_tsi) * insurance).toFixed(2) ;
                    //     var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                    //     $('#slipbasicpremium').val(sum);

                    //     var basic_premi = $('#slipbasicpremium').val();

                    //     if(basic_premi){
                    //         var bpinsurance_period_from2 = $('#sliprpfrom').val();
                    //         var bpinsurance_period_to2 = $('#sliprpto').val();
                    //         var bpnewinsurance_period_from2 = bpinsurance_period_from2.split("/").reverse().join("-");
                    //         var bpnewinsurance_period_to2 = bpinsurance_period_to2.split("/").reverse().join("-");
                    //         var bpdays=daysBetween(bpnewinsurance_period_from2, bpnewinsurance_period_to2);
                    //         var bpinsurance = (bpdays/365);
                            
                    //         console.log(bpinsurance_period_from2)
                    //         console.log(bpinsurance_period_to2)
                    //         console.log(bpnewinsurance_period_from2)
                    //         console.log(bpnewinsurance_period_to2)
                    //         console.log(bpdays)
                    //         console.log(bpinsurance)

                    //         var bprateslip =  parseFloat($('#sliprate').val());
                    //         var bpsumrate = $("#sliptotalrate").val();
                    //         var bpconv_sumrate = parseFloat(bpsumrate.replace(/,/g, ""));
                    //         var bptsi = $("#sharetotalsum").val();
                    //         var bpconv_tsi = parseFloat(bptsi.replace(/,/g, ""));
                    //         var bpsum = isNaN(((bpconv_sumrate / 1000) * bpconv_tsi) * bpinsurance) ? 0 :(((bpconv_sumrate / 1000) * bpconv_tsi) * bpinsurance).toFixed(2) ;
                    //         var bpreal_sum = bpsum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                    //         $('#slipbasicpremium').val(bpsum);

                    //         var share = $('#slipshare').val();
                    //         if(share){
                    //             var shareslip =  parseFloat(share) / 100 ;
                    //             // var nasionalreinsurance =  $('#fesharefrom').val();
                    //             // var totalnre =  $('#feshareto').val();

                    //              var sliptype = $('#sliptypeform').val();
                    //             if(sliptype == 'fe'){
                    //                     var nasionalreinsurance =  $('#fesharefrom').val();
                    //                     var totalnre =  $('#feshareto').val();
                    //                 }else if(sliptype == 'fl'){
                    //                     var nasionalreinsurance =  $('#flsharefrom').val();
                    //                     var totalnre =  $('#flshareto').val();
                    //                 }else if(sliptype == 'hem'){
                    //                     var nasionalreinsurance =  $('#hemsharefrom').val();
                    //                     var totalnre =  $('#hemshareto').val();
                    //                 }else if(sliptype == 'mp'){
                    //                     var nasionalreinsurance =  $('#mpsharefrom').val();
                    //                     var totalnre =  $('#mpshareto').val();
                    //                 }else if(sliptype == 'hio'){
                    //                     var nasionalreinsurance =  $('#hiosharefrom').val();
                    //                      var totalnre =  $('#hioshareto').val();
                    //                 }else if(sliptype == 'pa'){
                    //                     var nasionalreinsurance =  $('#pasharefrom').val();
                    //                     var totalnre =  $('#pashareto').val();
                    //                 }
                    //             var conv_totalnre =  parseFloat(totalnre.replace(/,/g, ""));

                    //             console.log('nre' + nasionalreinsurance)
                    //                 // console.log(conv_nasionalreinsurance)
                    //             console.log('totalnre' + totalnre)
                    //             console.log('convtotnre' + conv_totalnre)
                                

                    //             var sumshare = $('#slipsumshare').val() ;
                    //             var conv_sumshare = parseFloat(sumshare.replace(/,/g, ""));

                                
                    //             var conv_basre = parseFloat(basic_premi.replace(/,/g, ""));

                    //             var orpercent = $('#slipor').val() / 100;

                    //             var sumor = isNaN(orpercent * conv_sumshare) ? 0 :(orpercent * conv_sumshare).toFixed(2);
                    //             var real_sumor = sumor.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                
                    //             var sumgprmtonr = isNaN(conv_basre * shareslip ) ? 0 :(conv_basre * shareslip ).toFixed(2);
                    //             var real_sumgprmtonr= sumgprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                
                    //             if(nasionalreinsurance){
                    //                 var conv_nasionalreinsurance =  parseFloat(nasionalreinsurance.replace(/,/g, ""));
                    //                 var sumnre = isNaN(conv_nasionalreinsurance + conv_sumshare ) ? 0 :(conv_nasionalreinsurance + conv_sumshare).toFixed(2) ;
                    //                 var real_sumnre = sumnre.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    //             }else{
                    //                 var conv_nasionalreinsurance =  parseFloat(nasionalreinsurance.replace(/,/g, ""));
                    //                 var sumnre = isNaN(0 + conv_sumshare ) ? 0 :(0 + conv_sumshare).toFixed(2) ;
                    //                 var real_sumnre = sumnre.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    //             }
                                
                                
                    //             var sumourshare = isNaN((sumnre / conv_totalnre) * 100 ) ? 0 :((sumnre / conv_totalnre) * 100 ).toFixed(2) ;

                    //             console.log('sumnre' + sumnre)
                    //             console.log('realnre' + real_sumnre)
                    //             console.log('sumourshare' + sumourshare)

                    //             $('#slipgrossprmtonr').val(sumgprmtonr);
                    //             $('#slipgrossprmtonr2').val(sumgprmtonr);
                    //             $('#slipsumor').val(sumor);
                    //             $('#slipsumor2').val(sumor);
                    //             // $('#feshare').val(sumourshare.replace(/,/g, "."));
                    //             // $('#fesharefrom').val(sumnre);
                    //             if(sliptype == 'fe'){
                    //                     $('#fesharefrom').val(sumnre);
                    //                 }else if(sliptype == 'fl'){
                    //                     $('#flsharefrom').val(sumnre);
                    //                 }else if(sliptype == 'hem'){
                    //                     $('#hemsharefrom').val(sumnre);
                    //                 }else if(sliptype == 'mp'){
                    //                     $('#mpsharefrom').val(sumnre);
                    //                 }else if(sliptype == 'hio'){
                    //                     $('#hiosharefrom').val(sumnre);
                    //                 }else if(sliptype == 'pa'){
                    //                     $('#pasharefrom').val(sumnre);
                    //                 }

                    //             var slipsumcommissionval = $('#slipsumcommission').val();
                    //             if(slipsumcommissionval != null){
                    //                 var commision =  parseFloat($('#slipcommission').val()) / 100;
                    //                 var feebroker = parseFloat($('#slipvbroker').val()) / 100;
                    //                 var sumgrossprmtonr = $("#slipgrossprmtonr").val();
                    //                 var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr.replace(/,/g, ""));

                    //                 var sumcomm = isNaN(commision * conv_sumgrossprmtonr) ? 0 :(commision * conv_sumgrossprmtonr).toFixed(2);
                    //                 var real_sumcomm = sumcomm.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                    //                 $('#slipsumcommission').val(sumcomm);
                    //                 $('#slipsumcommission2').val(sumcomm);

                    //                 var netprm_to_nr = $('#slipnetprmtonr').val();
                    //                 if(netprm_to_nr != null){


                    //                     var sumnetprmtonr = isNaN( conv_sumgrossprmtonr * (100/100 - commision - feebroker)) ? 0 :(conv_sumgrossprmtonr * (100/100 - commision - feebroker)).toFixed(2);
                    //                     var real_sumnetprmtonr = sumnetprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                    //                     var sumfeebroker = isNaN( conv_sumgrossprmtonr * feebroker) ? 0 :(conv_sumgrossprmtonr * feebroker).toFixed(2);
                    //                     var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


                    //                     $('#slipnetprmtonr').val(amountToString(sumnetprmtonr));
                    //                     $('#slipnetprmtonr2').val(amountToString(sumnetprmtonr));
                    //                     // $('#slipsumfee').val("100" + "-" + commision.toString() + "-" + feebroker.toString() + "*" + conv_sumgrossprmtonr.toString());
                    //                     $('#slipsumfee').val(floatToString(sumfeebroker));
                    //                     $('#slipsumfee2').val(floatToString(sumfeebroker));

                    //                     // var retro_backup = $('#sliprb').val();
                    //                     // if(retro_backup == 'YES'){
                    //                     //     swal('warning!','please change retrocession amount manually','success')
                    //                     // }

                    //                 }

                    //             }
                    //         }
                    //     }
                    // }catch(err){
                    //     console.log(err)
                    // }

                }
                    
                

                $('#iidextendcoverage'+id).remove();
                console.log(response);
            }
        });
    }
</script>
<script type='text/javascript'>
    function deleteextendcoverageupdate(id)
    {
        var token2 = $('input[name=_token2]').val();

        $.ajax({
            url:'{{ url("/") }}/delete-extendcoverage-list/'+id,
            type:"DELETE",
            data:{
                _token:token2
            },
            beforeSend: function() { $("body").addClass("loading");  },
            complete: function() {  $("body").removeClass("loading"); },
            success:function(response){

                var total_percent =  $('#sliptotalnilaiecupdate').val();

                
                var sum_percent = isNaN(parseFloat(total_percent) - parseFloat(response.percentage)) ? 0 :(parseFloat(total_percent) - parseFloat(response.percentage))
                console.log('total = ' + parseFloat(total_percent))
                console.log('percentexc = ' + parseFloat(response.percentage))
                $('#sliptotalnilaiecupdate').val(sum_percent.toString());
                console.log($('#sliptotalnilaiecupdate').val())

                var total_rate = $('#sliptotalrateupdate').val();
                if(total_rate){
                    var sum_totalrate = isNaN(parseFloat(total_rate) - parseFloat(response.percentage)) ? 0 :(parseFloat(total_rate) - parseFloat(response.percentage)) ;
                    $('#sliptotalrateupdate').val(sum_totalrate.toString());
                    $('#sliptotalrateupdate2').val(sum_totalrate.toString());
                    calculateBasicPremium('update');
                    calculateComm('update');
                    calculateFeeBroker('update');
                    // try {

                    //         var insurance_period_from2 = $('#sliprpfromupdate').val();
                    //         var insurance_period_to2 = $('#sliprptoupdate').val();
                    //         var newinsurance_period_from2 = insurance_period_from2.split("/").reverse().join("-");
                    //         var newinsurance_period_to2 = insurance_period_to2.split("/").reverse().join("-");
                    //         var days=daysBetween(newinsurance_period_from2, newinsurance_period_to2);
                    //         var insurance = (days/365);

                    //         var tsi = $("#sharetotalsumupdate").val();
                    //         var conv_tsi = parseFloat(tsi.replace(/,/g, ""));
                    //         var sumrate = $("#sliptotalrateupdate").val();
                    //         var conv_sumrate = parseFloat(sumrate.replace(/,/g, ""));
                    //         var sum = isNaN(((conv_sumrate / 1000) * conv_tsi) * insurance) ? 0 :(((conv_sumrate / 1000) * conv_tsi) * insurance).toFixed(2) ;
                    //         var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                    //         $('#slipbasicpremiumupdate').val(amountToString(sum));
                        
                        
                    //         var basic_premi = $('#slipbasicpremiumupdate').val();

                    //         if(basic_premi){
                    //             var bpinsurance_period_from2 = $('#sliprpfromupdate').val();
                    //             var bpinsurance_period_to2 = $('#sliprptoupdate').val();
                    //             var bpnewinsurance_period_from2 = bpinsurance_period_from2.split("/").reverse().join("-");
                    //             var bpnewinsurance_period_to2 = bpinsurance_period_to2.split("/").reverse().join("-");
                    //             var bpdays=daysBetween(bpnewinsurance_period_from2, bpnewinsurance_period_to2);
                    //             var bpinsurance = (bpdays/365);
                                
                    //             console.log(bpinsurance_period_from2)
                    //             console.log(bpinsurance_period_to2)
                    //             console.log(bpnewinsurance_period_from2)
                    //             console.log(bpnewinsurance_period_to2)
                    //             console.log(bpdays)
                    //             console.log(bpinsurance)

                    //             var bprateslip =  parseFloat($('#sliprateupdate').val());
                    //             var bpsumrate = $("#sliptotalrateupdate").val();
                    //             var bpconv_sumrate = parseFloat(bpsumrate.replace(/,/g, ""));
                    //             var bptsi = $("#sharetotalsumupdate").val();
                    //             var bpconv_tsi = parseFloat(bptsi.replace(/,/g, ""));
                    //             var bpsum = isNaN(((bpconv_sumrate / 1000) * bpconv_tsi) * bpinsurance) ? 0 :(((bpconv_sumrate / 1000) * bpconv_tsi) * bpinsurance).toFixed(2) ;
                    //             var bpreal_sum = bpsum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                    //             $('#slipbasicpremiumupdate').val(bpsum);

                    //             var share = $('#slipshareupdate').val();
                    //             if(share){
                    //                 var shareslip =  parseFloat(share) / 100 ;
                    //                 // var nasionalreinsurance =  $('#fesharefrom').val();
                    //                 // var totalnre =  $('#feshareto').val();
                    //                  var sliptype = $('#sliptypeform').val();
                    //                  if(sliptype == 'fe'){
                    //                     var nasionalreinsurance =  $('#fesharefrom').val();
                    //                     var totalnre =  $('#feshareto').val();
                    //                 }else if(sliptype == 'fl'){
                    //                     var nasionalreinsurance =  $('#flsharefrom').val();
                    //                     var totalnre =  $('#flshareto').val();
                    //                 }else if(sliptype == 'hem'){
                    //                     var nasionalreinsurance =  $('#hemsharefrom').val();
                    //                     var totalnre =  $('#hemshareto').val();
                    //                 }else if(sliptype == 'mp'){
                    //                     var nasionalreinsurance =  $('#mpsharefrom').val();
                    //                     var totalnre =  $('#mpshareto').val();
                    //                 }else if(sliptype == 'hio'){
                    //                     var nasionalreinsurance =  $('#hiosharefrom').val();
                    //                      var totalnre =  $('#hioshareto').val();
                    //                 }else if(sliptype == 'pa'){
                    //                     var nasionalreinsurance =  $('#pasharefrom').val();
                    //                     var totalnre =  $('#pashareto').val();
                    //                 }
                    //                 var conv_totalnre =  parseFloat(totalnre.replace(/,/g, ""));

                    //                 console.log('nre' + nasionalreinsurance)
                    //                     // console.log(conv_nasionalreinsurance)
                    //                 console.log('totalnre' + totalnre)
                    //                 console.log('convtotnre' + conv_totalnre)
                                    

                    //                 var sumshare = $('#slipsumshareupdate').val() ;
                    //                 var conv_sumshare = parseFloat(sumshare.replace(/,/g, ""));

                                    
                    //                 var conv_basre = parseFloat(basic_premi.replace(/,/g, ""));

                    //                 var orpercent = $('#sliporupdate').val() / 100;

                    //                 var sumor = isNaN(orpercent * conv_sumshare) ? 0 :(orpercent * conv_sumshare).toFixed(2);
                    //                 var real_sumor = sumor.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    
                    //                 var sumgprmtonr = isNaN(conv_basre * shareslip ) ? 0 :(conv_basre * shareslip ).toFixed(2);
                    //                 var real_sumgprmtonr= sumgprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    
                    //                 if(nasionalreinsurance){
                    //                     var conv_nasionalreinsurance =  parseFloat(nasionalreinsurance.replace(/,/g, ""));
                    //                     var sumnre = isNaN(conv_nasionalreinsurance + conv_sumshare ) ? 0 :(conv_nasionalreinsurance + conv_sumshare).toFixed(2) ;
                    //                     var real_sumnre = sumnre.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    //                 }else{
                    //                     var conv_nasionalreinsurance =  parseFloat(nasionalreinsurance.replace(/,/g, ""));
                    //                     var sumnre = isNaN(0 + conv_sumshare ) ? 0 :(0 + conv_sumshare).toFixed(2) ;
                    //                     var real_sumnre = sumnre.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    //                 }
                                    
                                    
                    //                 var sumourshare = isNaN((sumnre / conv_totalnre) * 100 ) ? 0 :((sumnre / conv_totalnre) * 100 ).toFixed(2) ;

                    //                 console.log('sumnre' + sumnre)
                    //                 console.log('realnre' + real_sumnre)
                    //                 console.log('sumourshare' + sumourshare)

                    //                 $('#slipgrossprmtonrupdate').val(sumgprmtonr);
                    //                 $('#slipgrossprmtonrupdate2').val(sumgprmtonr);
                    //                 $('#slipsumorupdate').val(sumor);
                    //                 $('#slipsumorupdate2').val(sumor);
                    //                 // $('#feshare').val(sumourshare.replace(/,/g, "."));
                    //                 // $('#fesharefrom').val(sumnre);
                    //                 if(sliptype == 'fe'){
                    //                     $('#fesharefrom').val(sumnre);
                    //                 }else if(sliptype == 'fl'){
                    //                     $('#flsharefrom').val(sumnre);
                    //                 }else if(sliptype == 'hem'){
                    //                     $('#hemsharefrom').val(sumnre);
                    //                 }else if(sliptype == 'mp'){
                    //                     $('#mpsharefrom').val(sumnre);
                    //                 }else if(sliptype == 'hio'){
                    //                     $('#hiosharefrom').val(sumnre);
                    //                 }else if(sliptype == 'pa'){
                    //                     $('#pasharefrom').val(sumnre);
                    //                 }

                    //                 var slipsumcommissionval = $('#slipsumcommissionupdate').val();
                    //                 if(slipsumcommissionval != null){
                    //                     var commision =  parseFloat($('#slipcommissionupdate').val()) / 100;
                    //                     var feebroker = parseFloat($('#slipvbrokerupdate').val()) / 100;
                    //                     var sumgrossprmtonr = $("#slipgrossprmtonrupdate").val();
                    //                     var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr.replace(/,/g, ""));

                    //                     var sumcomm = isNaN(commision * conv_sumgrossprmtonr) ? 0 :(commision * conv_sumgrossprmtonr).toFixed(2);
                    //                     var real_sumcomm = sumcomm.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                    //                     $('#slipsumcommissionupdate').val(sumcomm);
                    //                     $('#slipsumcommissionupdate2').val(sumcomm);

                    //                     var netprm_to_nr = $('#slipnetprmtonrupdate').val();
                    //                     if(netprm_to_nr != null){


                    //                         var sumnetprmtonr = isNaN( conv_sumgrossprmtonr * (100/100 - commision - feebroker)) ? 0 :(conv_sumgrossprmtonr * (100/100 - commision - feebroker)).toFixed(2);
                    //                         var real_sumnetprmtonr = sumnetprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                    //                         var sumfeebroker = isNaN( conv_sumgrossprmtonr * feebroker) ? 0 :(conv_sumgrossprmtonr * feebroker).toFixed(2);
                    //                         var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


                    //                         $('#slipnetprmtonrupdate').val(amountToString(sumnetprmtonr));
                    //                         $('#slipnetprmtonrupdate2').val(amountToString(sumnetprmtonr));
                    //                         // $('#slipsumfee').val("100" + "-" + commision.toString() + "-" + feebroker.toString() + "*" + conv_sumgrossprmtonr.toString());
                    //                         $('#slipsumfeeupdate').val(sumfeebroker);
                    //                         $('#slipsumfeeupdate2').val(sumfeebroker);

                    //                         // var retro_backup = $('#sliprbupdate').val();
                    //                         // if(retro_backup == 'YES'){
                    //                         //     swal('warning!','please change retrocession amount manually','success')
                    //                         // }

                    //                     }

                    //                 }
                    //             }
                    //         }
                    //     }catch(err){
                    //         console.log(err)
                    //     // }
                }
                    
                

                $('#iidextendcoverageupdate'+id).remove();
                console.log(response);
            }
        });
    }
</script>
<script type='text/javascript'>
    function deleteextendcoverageendorsement(id)
    {
        var token2 = $('input[name=_token2]').val();

        $.ajax({
            url:'{{ url("/") }}/delete-extendcoverage-list/'+id,
            type:"DELETE",
            data:{
                _token:token2
            },
            beforeSend: function() { $("body").addClass("loading");  },
            complete: function() {  $("body").removeClass("loading"); },
            success:function(response){

                var total_percent =  $('#sliptotalnilaiecendorsement').val();

                
                var sum_percent = isNaN(parseFloat(total_percent) - parseFloat(response.percentage)) ? 0 :(parseFloat(total_percent) - parseFloat(response.percentage))
                console.log('total = ' + parseFloat(total_percent))
                console.log('percentexc = ' + parseFloat(response.percentage))
                $('#sliptotalnilaiecendorsement').val(sum_percent.toString());
                console.log($('#sliptotalnilaiecendorsement').val())

                var total_rate = $('#sliptotalrateendorsement').val();
                if(total_rate){
                    var sum_totalrate = isNaN(parseFloat(total_rate) - parseFloat(response.percentage)) ? 0 :(parseFloat(total_rate) - parseFloat(response.percentage)) ;
                    $('#sliptotalrateendorsement').val(sum_totalrate.toString());
                    $('#sliptotalrateendorsement2').val(sum_totalrate.toString());
                    calculateBasicPremium('endorsement');
                    calculateComm('endorsement');
                    calculateFeeBroker('endorsement');
                    // try {

                    //         var insurance_period_from2 = $('#sliprpfromendorsement').val();
                    //         var insurance_period_to2 = $('#sliprptoendorsement').val();
                    //         var newinsurance_period_from2 = insurance_period_from2.split("/").reverse().join("-");
                    //         var newinsurance_period_to2 = insurance_period_to2.split("/").reverse().join("-");
                    //         var days=daysBetween(newinsurance_period_from2, newinsurance_period_to2);
                    //         var insurance = (days/365);

                    //         var tsi = $("#sharetotalsumendorsement").val();
                    //         var conv_tsi = parseFloat(tsi.replace(/,/g, ""));
                    //         var sumrate = $("#sliptotalrateendorsement").val();
                    //         var conv_sumrate = parseFloat(sumrate.replace(/,/g, ""));
                    //         var sum = isNaN(((conv_sumrate / 1000) * conv_tsi) * insurance) ? 0 :(((conv_sumrate / 1000) * conv_tsi) * insurance).toFixed(2) ;
                    //         var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                    //         $('#slipbasicpremiumendorsement').val(sum);
                        
                        
                    //         var basic_premi = $('#slipbasicpremiumendorsement').val();

                    //         if(basic_premi){
                    //             var bpinsurance_period_from2 = $('#sliprpfromendorsement').val();
                    //             var bpinsurance_period_to2 = $('#sliprptoendorsement').val();
                    //             var bpnewinsurance_period_from2 = bpinsurance_period_from2.split("/").reverse().join("-");
                    //             var bpnewinsurance_period_to2 = bpinsurance_period_to2.split("/").reverse().join("-");
                    //             var bpdays=daysBetween(bpnewinsurance_period_from2, bpnewinsurance_period_to2);
                    //             var bpinsurance = (bpdays/365);
                                
                    //             console.log(bpinsurance_period_from2)
                    //             console.log(bpinsurance_period_to2)
                    //             console.log(bpnewinsurance_period_from2)
                    //             console.log(bpnewinsurance_period_to2)
                    //             console.log(bpdays)
                    //             console.log(bpinsurance)

                    //             var bprateslip =  parseFloat($('#sliprateendorsement').val());
                    //             var bpsumrate = $("#sliptotalrateendorsement").val();
                    //             var bpconv_sumrate = parseFloat(bpsumrate.replace(/,/g, ""));
                    //             var bptsi = $("#sharetotalsumendorsement").val();
                    //             var bpconv_tsi = parseFloat(bptsi.replace(/,/g, ""));
                    //             var bpsum = isNaN(((bpconv_sumrate / 1000) * bpconv_tsi) * bpinsurance) ? 0 :(((bpconv_sumrate / 1000) * bpconv_tsi) * bpinsurance).toFixed(2) ;
                    //             var bpreal_sum = bpsum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                    //             $('#slipbasicpremiumendorsement').val(bpsum);

                    //             var share = $('#slipshareendorsement').val();
                    //             if(share){
                    //                 var shareslip =  parseFloat(share) / 100 ;
                    //                 // var nasionalreinsurance =  $('#fesharefrom').val();
                    //                 // var totalnre =  $('#feshareto').val();

                    //                  var sliptype = $('#sliptypeform').val();
                    //             if(sliptype == 'fe'){
                    //                     var nasionalreinsurance =  $('#fesharefrom').val();
                    //                     var totalnre =  $('#feshareto').val();
                    //                 }else if(sliptype == 'fl'){
                    //                     var nasionalreinsurance =  $('#flsharefrom').val();
                    //                     var totalnre =  $('#flshareto').val();
                    //                 }else if(sliptype == 'hem'){
                    //                     var nasionalreinsurance =  $('#hemsharefrom').val();
                    //                     var totalnre =  $('#hemshareto').val();
                    //                 }else if(sliptype == 'mp'){
                    //                     var nasionalreinsurance =  $('#mpsharefrom').val();
                    //                     var totalnre =  $('#mpshareto').val();
                    //                 }else if(sliptype == 'hio'){
                    //                     var nasionalreinsurance =  $('#hiosharefrom').val();
                    //                      var totalnre =  $('#hioshareto').val();
                    //                 }else if(sliptype == 'pa'){
                    //                     var nasionalreinsurance =  $('#pasharefrom').val();
                    //                     var totalnre =  $('#pashareto').val();
                    //                 }
                    //                 var conv_totalnre =  parseFloat(totalnre.replace(/,/g, ""));

                    //                 console.log('nre' + nasionalreinsurance)
                    //                     // console.log(conv_nasionalreinsurance)
                    //                 console.log('totalnre' + totalnre)
                    //                 console.log('convtotnre' + conv_totalnre)
                                    

                    //                 var sumshare = $('#slipsumshareendorsement').val() ;
                    //                 var conv_sumshare = parseFloat(sumshare.replace(/,/g, ""));

                                    
                    //                 var conv_basre = parseFloat(basic_premi.replace(/,/g, ""));

                    //                 var orpercent = $('#sliporendorsement').val() / 100;

                    //                 var sumor = isNaN(orpercent * conv_sumshare) ? 0 :(orpercent * conv_sumshare).toFixed(2);
                    //                 var real_sumor = sumor.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    
                    //                 var sumgprmtonr = isNaN(conv_basre * shareslip ) ? 0 :(conv_basre * shareslip ).toFixed(2);
                    //                 var real_sumgprmtonr= sumgprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    
                    //                 if(nasionalreinsurance){
                    //                     var conv_nasionalreinsurance =  parseFloat(nasionalreinsurance.replace(/,/g, ""));
                    //                     var sumnre = isNaN(conv_nasionalreinsurance + conv_sumshare ) ? 0 :(conv_nasionalreinsurance + conv_sumshare).toFixed(2) ;
                    //                     var real_sumnre = sumnre.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    //                 }else{
                    //                     var conv_nasionalreinsurance =  parseFloat(nasionalreinsurance.replace(/,/g, ""));
                    //                     var sumnre = isNaN(0 + conv_sumshare ) ? 0 :(0 + conv_sumshare).toFixed(2) ;
                    //                     var real_sumnre = sumnre.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    //                 }
                                    
                                    
                    //                 var sumourshare = isNaN((sumnre / conv_totalnre) * 100 ) ? 0 :((sumnre / conv_totalnre) * 100 ).toFixed(2) ;

                    //                 console.log('sumnre' + sumnre)
                    //                 console.log('realnre' + real_sumnre)
                    //                 console.log('sumourshare' + sumourshare)

                    //                 $('#slipgrossprmtonrendorsement').val(sumgprmtonr);
                    //                 $('#slipgrossprmtonrendorsement2').val(sumgprmtonr);
                    //                 $('#slipsumorendorsement').val(sumor);
                    //                 $('#slipsumorendorsement2').val(sumor);
                    //                 // $('#feshare').val(sumourshare.replace(/,/g, "."));
                    //                 // $('#fesharefrom').val(sumnre);
                    //                 if(sliptype == 'fe'){
                    //                     $('#fesharefrom').val(sumnre);
                    //                 }else if(sliptype == 'fl'){
                    //                     $('#flsharefrom').val(sumnre);
                    //                 }else if(sliptype == 'hem'){
                    //                     $('#hemsharefrom').val(sumnre);
                    //                 }else if(sliptype == 'mp'){
                    //                     $('#mpsharefrom').val(sumnre);
                    //                 }else if(sliptype == 'hio'){
                    //                     $('#hiosharefrom').val(sumnre);
                    //                 }else if(sliptype == 'pa'){
                    //                     $('#pasharefrom').val(sumnre);
                    //                 }

                    //                 var slipsumcommissionval = $('#slipsumcommissionendorsement').val();
                    //                 if(slipsumcommissionval != null){
                    //                     var commision =  parseFloat($('#slipcommissionendorsement').val()) / 100;
                    //                     var feebroker = parseFloat($('#slipvbrokerendorsement').val()) / 100;
                    //                     var sumgrossprmtonr = $("#slipgrossprmtonrendorsement").val();
                    //                     var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr.replace(/,/g, ""));

                    //                     var sumcomm = isNaN(commision * conv_sumgrossprmtonr) ? 0 :(commision * conv_sumgrossprmtonr).toFixed(2);
                    //                     var real_sumcomm = sumcomm.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                    //                     $('#slipsumcommissionendorsement').val(sumcomm);
                    //                     $('#slipsumcommissionendorsement2').val(sumcomm);

                    //                     var netprm_to_nr = $('#slipnetprmtonrendorsement').val();
                    //                     if(netprm_to_nr != null){


                    //                         var sumnetprmtonr = isNaN( conv_sumgrossprmtonr * (100/100 - commision - feebroker)) ? 0 :(conv_sumgrossprmtonr * (100/100 - commision - feebroker)).toFixed(2);
                    //                         var real_sumnetprmtonr = sumnetprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                    //                         var sumfeebroker = isNaN( conv_sumgrossprmtonr * feebroker) ? 0 :(conv_sumgrossprmtonr * feebroker).toFixed(2);
                    //                         var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


                    //                         $('#slipnetprmtonrendorsement').val(amountToString(sumnetprmtonr));
                    //                         $('#slipnetprmtonrendorsement2').val(amountToString(sumnetprmtonr));
                    //                         // $('#slipsumfee').val("100" + "-" + commision.toString() + "-" + feebroker.toString() + "*" + conv_sumgrossprmtonr.toString());
                    //                         $('#slipsumfeeendorsement').val(sumfeebroker);
                    //                         $('#slipsumfeeendorsement2').val(sumfeebroker);

                    //                         // var retro_backup = $('#sliprbendorsement').val();
                    //                         // if(retro_backup == 'YES'){
                    //                         //     swal('warning!','please change retrocession amount manually','success')
                    //                         // }

                    //                     }

                    //                 }
                    //             }
                    //         }
                    //     }catch(err){
                    //         console.log(err)
                    //     }
                }
                    
                

                $('#iidextendcoverageendorsement'+id).remove();
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
       var code_ms = $('#insuredIDtxt').val();
       var sliptype = $('#sliptypeform').val();
       var countendorsement = 0;
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

       
       // if(new Date(newinstallmentdate) >= new Date(newproddate)){
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
                     countendorsement:countendorsement,
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
                            
                            var str_amount = response.amount;
                            var curr_amount = str_amount.replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                            var currdate = response.installment_date;
                            var convdate = currdate.split("-").reverse().join("/");
                            console.log('conv date ' + convdate)
                            var strdate = convdate.toString();

                            var conv_percent = parseFloat(response.percentage);
                            
                            $('#installmentPanel tbody').append('<tr id="iidinstallment'+response.id+'" data-name="installmentvalue[]"><td data-name="'+response.installment_date+'">'+strdate+'</td><td data-name="'+floatToString(response.percentage)+'">'+floatToString(response.percentage)+'</td><td data-name="'+amountToString(response.amount)+'" class="uangdata">'+amountToString(response.amount)+'</td><td><a href="javascript:void(0)" onclick="deleteinstallmentdetail('+response.id+')">delete</a></td></tr>')
                            $('#dateinstallment').val('');
                            $('#slipippercentage').val('');
                            $('#slipipamount').val('');
                            $('#slipipamount2').val('');

                            if(response.message){
                                // swal("Success!", response.message, "success")
                            }       
                            


                            var total_percent =  $('#sliptotalpercentinspan').val();

                            if(total_percent == ''){



                                var sum_percent = isNaN(parseFloat(0) + parseFloat(response.percentage)) ? 0 :(parseFloat(0) + parseFloat(response.percentage)) ;
                                $('#sliptotalpercentinspan').val(sum_percent.toString());
                                console.log($('#sliptotalpercentinspan').val());

                                var total_percent2 =  $('#sliptotalpercentinspan').val();

                                if(parseInt(total_percent2)>=100)
                                {
                                    $('#addinstallmentinsured-btn').attr('hidden','true');
                                }

                            }
                            else
                            {
                                var sum_percent = isNaN(parseFloat(total_percent) + parseFloat(response.percentage)) ? 0 :(parseFloat(total_percent) + parseFloat(response.percentage))
                                $('#sliptotalpercentinspan').val(sum_percent.toString());
                                console.log($('#sliptotalpercentinspan').val());

                                var total_percent2 =  $('#sliptotalpercentinspan').val();

                                if(parseInt(total_percent2)>=100)
                                {
                                    $('#addinstallmentinsured-btn').attr('hidden','true');
                                }
                            }

                            $('#slipipdate').val('');
                            $('#slipipdate').focus();

                            // var total_percent2 =  $('#sliptotalpercentinspan').val();

                            // if(total_percent>=100)
                            // {
                            //     $('#addinstallmentinsured-btn').attr('hidden','true');
                            // }
                            // else
                            // {
                            //     $('#addinstallmentinsured-btn').attr('hidden','false');
                            // }
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

       // }else{
       //  swal('warning!','installment date cannot be lower than prod date / document date','validation error');
       // }

   });
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
       var code_ms = $('#insuredIDtxt').val();
       
       var sliptype = $('#sliptypeform').val();
       var sumtotal_percent = $('#sliptotalpercentinspanupdate').val();
       if(sumtotal_percent == null || sumtotal_percent == "" ){
            var conv_sumtotal_percent = parseFloat("0");
       }else{
            var conv_sumtotal_percent = parseFloat(sumtotal_percent);
       }
       
       var conv_percentage = parseFloat(percentage);
       var countendorsement = $('#countendorsmentupdate').val();

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
                     sliptype:sliptype,
                     countendorsement:countendorsement
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
                            // var curr_amount = str_amount;

                            var currdate = response.installment_date;
                            var convdate = currdate.split("-").reverse().join("/");
                            console.log('conv date ' + convdate)
                            var strdate = convdate.toString();

                            var conv_percent = parseFloat(response.percentage).toFixed(2);
                            
                            $('#installmentPanelupdate tbody').append('<tr id="iidinstallmentupdate'+response.id+'" data-name="installmentvalue[]"><td data-name="'+response.installment_date+'">'+strdate+'</td><td data-name="'+floatToString(response.percentage)+'">'+floatToString(response.percentage)+'</td><td data-name="'+amountToString(response.amount)+'" class="uangdata">'+amountToString(response.amount)+'</td><td><a href="javascript:void(0)" onclick="deleteinstallmentupdate('+response.id+')">delete</a></td></tr>')
                            $('#dateinstallmentupdate').val('');
                            $('#slipippercentageupdate').val('');
                            $('#slipipamountupdate').val('');
                            $('#slipipamountupdate2').val('');

                            if(response.message){
                                // swal("Success!", response.message, "success")
                            }       
                            


                            var total_percent =  $('#sliptotalpercentinspanupdate').val();

                            if(total_percent == ''){
                                var sum_percent = isNaN(parseFloat(0) + parseFloat(response.percentage)) ? 0 :(parseFloat(0) + parseFloat(response.percentage)) ;
                                $('#sliptotalpercentinspanupdate').val(sum_percent.toString());
                                
                            }else{
                                var sum_percent = isNaN(parseFloat(total_percent) + parseFloat(response.percentage)) ? 0 :(parseFloat(total_percent) + parseFloat(response.percentage))
                                $('#sliptotalpercentinspanupdate').val(sum_percent.toString());
                                
                                
                            }
                            var total_percent2 =  $('#sliptotalpercentinspanupdate').val();
                            console.log("Total Percent Installent : " + $('#sliptotalpercentinspanupdate').val())
                                    if(parseInt(total_percent2)>=100.00)
                                    {
                                        console.log("do hide button");
                                        $('#addinstallmentinsuredupdate-btn').attr('hidden','true');
                                    }
                        }
                        $('#slipipdateupdate').val('');
                        $('#slipipdateupdate').focus();

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
    $('#addinstallmentinsuredendorsement-btn').click(function(e){
       //alert('masuk');
       e.preventDefault();

       var installmentdate = $('#slipipdateendorsement').val();
       var percentage = $('#slipippercentageendorsement').val();
       var amount = $('#slipipamountendorsement').val();
       var slip_id = $('#slipnumberendorsement').val();
       var token2 = $('input[name=_token2]').val();
       var code_ms = $('#insuredIDtxt').val();
       var sliptype = $('#sliptypeform').val();
       var sumtotal_percent = $('#sliptotalpercentinspanendorsement').val();
       if(sumtotal_percent == null || sumtotal_percent == "" ){
            var conv_sumtotal_percent = parseFloat("0");
       }else{
            var conv_sumtotal_percent = parseFloat(sumtotal_percent);
       }
       
       var conv_percentage = parseFloat(percentage);
       var countendorsement = $('#countendorsmentdata').val();

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
                     sliptype:sliptype,
                     countendorsement:countendorsement
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

                            var conv_percent = parseFloat(response.percentage).toFixed(2);
                            
                            $('#installmentPanelendorsement tbody').append('<tr id="iidinstallmentendorsement'+response.id+'" data-name="installmentvalue[]"><td data-name="'+response.installment_date+'">'+strdate+'</td><td data-name="'+floatToString(response.percentage)+'">'+floatToString(response.percentage)+'</td><td data-name="'+amountToString(response.amount)+'" class="uangdata">'+amountToString(curr_amount)+'</td><td><a href="javascript:void(0)" onclick="deleteinstallmentendorsement('+response.id+')">delete</a></td></tr>')
                            $('#dateinstallmentendorsement').val('');
                            $('#slipippercentageendorsement').val('');
                            $('#slipipamountendorsement').val('');
                            $('#slipipamountendorsement2').val('');

                            if(response.message){
                                // swal("Success!", response.message, "success")
                            }       
                            


                            var total_percent =  $('#sliptotalpercentinspanendorsement').val();

                            if(total_percent == ''){
                                var sum_percent = isNaN(parseFloat(0) + parseFloat(response.percentage)) ? 0 :(parseFloat(0) + parseFloat(response.percentage)) ;
                                $('#sliptotalpercentinspanendorsement').val(sum_percent.toString());
                                console.log($('#sliptotalpercentinspanendorsement').val())

                                var total_percent2 =  $('#sliptotalpercentinspanendorsement').val();

                                    if(parseInt(total_percent2)>=100)
                                    {
                                        $('#addinstallmentinsuredendorsement-btn').attr('hidden','true');
                                    }
                            }else{
                                var sum_percent = isNaN(parseFloat(total_percent) + parseFloat(response.percentage)) ? 0 :(parseFloat(total_percent) + parseFloat(response.percentage))
                                $('#sliptotalpercentinspanendorsement').val(sum_percent.toString());
                                console.log($('#sliptotalpercentinspanendorsement').val())
                                
                                var total_percent2 =  $('#sliptotalpercentinspanendorsement').val();

                                    if(parseInt(total_percent2)>=100)
                                    {
                                        $('#addinstallmentinsuredendorsement-btn').attr('hidden','true');
                                    }
                            }
                        }

                        $('#slipipdateendorsement').val('');
                        $('#slipipdateendorsement').focus();

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
                var total_percent =  $('#sliptotalpercentinspan').val();
                        
                var sum_percent = isNaN(parseFloat(total_percent) - parseFloat(response.percentage)) ? 0 :(parseFloat(total_percent) - parseFloat(response.percentage)) ;
                $('#sliptotalpercentinspan').val(sum_percent.toString());
                console.log('total percent' + $('#sliptotalpercentinspan').val())
                        
                var total_percent2 =  parseFloat($('#sliptotalpercentinspan').val());

                if(parseInt(total_percent2)<100)
                {
                    $('#addinstallmentinsured-btn').attr('hidden','false');
                    $('#addinstallmentinsured-btn').removeAttr('hidden')
                }
            }
        });
    }
</script>
<script type='text/javascript'>
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

                if(parseInt(total_percent2) < 100)
                {
                    $('#addinstallmentinsuredupdate-btn').attr('hidden','false');
                    $('#addinstallmentinsuredupdate-btn').removeAttr('hidden')
                }
            }
        });
    }
</script>
<script type='text/javascript'>
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

                if(parseInt(total_percent2) < 100)
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
        var code_ms = $('#insuredIDtxt').val();
        var sliptype = $('#sliptypeform').val(); 
       
        var slip_id = $('#slipnumber').val();
        var token2 = $('input[name=_token2]').val();
        var countendorsement = 0;
        var conv_amount = amount.replace(/,/g, "");
        var real_amount = conv_amount;
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
                        // var curr_amount = response.amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        // var curr_amount = response.amount;
                        $('#retrocessionPanel tbody').append('<tr id="iidretrocession'+response.id+'" data-name="retrocessionvalue[]"><td data-name="'+response.contract+'">'+response.contract+'</td><td data-name="'+floatToString(response.percentage)+'">'+floatToString(response.percentage)+'</td><td data-name="'+amountToString(response.amount)+'">'+amountToString(response.amount)+'</td><td><a href="javascript:void(0)" onclick="deleteretrocessiondetail('+response.id+')">delete</a></td></tr>');
                        $('#sliprppercentage').val('');
                        $('#sliprpamount').val('');
                        $('#sliprpamount2').val('');
                        if(response.message){
                            swal("Success!", response.message, "success")
                        }
                        var or = $('#slipor').val();
                        var total_percent = $('#sliptotalpercentrpor').val();
                        console.log("Response Persen "+response.percentage);
                        console.log("Val Slip Persen "+total_percent);
                        console.log("Val Slip Or "+or);
                        var sum_percent = isNaN(parseInt(total_percent)) ? 0 : parseInt(total_percent) + parseInt(response.percentage);
                        $('#sliptotalpercentrpor').val(sum_percent);

                        var total_percent2 =  $('#sliptotalpercentrpor').val();
                        console.log("Total Percent Installent : " + total_percent2);
                        if(parseInt(total_percent2)>=100)
                        {
                            console.log("do hide button");
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
    $('#addretrocessioninsuredupdate-btn').click(function(e){
       //alert('masuk');
       e.preventDefault();

       var type = $('#sliprptypeupdate').val();
       var contract = $('#sliprpcontractupdate').val();
       var percentage = $('#sliprppercentageupdate').val();
       var amount = $('#sliprpamountupdate').val();
       var code_ms = $('#insuredIDtxt').val();
       var sliptype = $('#sliptypeform').val();  
       var countendorsement = $('#countendorsmentupdate').val();
       var slip_id = $('#slipnumberupdate').val();
       var token2 = $('input[name=_token2]').val();

       var conv_amount = amount.replace(/,/g, "");
       console.log(conv_amount)
       var real_amount = conv_amount;
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
             id_slip:slip_id,
             insured_id:code_ms,
             countendorsement:countendorsement,
             sliptype:sliptype
         },
         beforeSend: function() { $("body").addClass("loading");  },
         complete: function() {  $("body").removeClass("loading"); },
         success:function(response)
         {

             console.log(response)
            //    var curr_amount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(response.amount);
            // var curr_amount = response.amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            $('#retrocessionPanelupdate tbody').append('<tr id="iidretrocessionupdate'+response.id+'" data-name="retrocessionupdatevalue[]"><td data-name="'+response.contract+'">'+response.contract+'</td><td data-name="'+floatToString(response.percentage)+'">'+floatToString(response.percentage)+'</td><td data-name="'+amountToString(response.amount)+'">'+amountToString(response.amount)+'</td><td><a href="javascript:void(0)" onclick="deleteretrocessionupdate('+response.id+')">delete</a></td></tr>');
            $('#sliprppercentageupdate').val('');
            $('#sliprpamountupdate').val('');
            $('#sliprpamountupdate2').val('');


            var total_percent =  $('#sliptotalpercentrporupdate').val();

            if(total_percent == ''){
                var sum_percent = isNaN(parseFloat(0) + parseFloat(response.percentage)) ? 0 :(parseFloat(0) + parseFloat(response.percentage)) ;
                $('#sliptotalpercentrporupdate').val(sum_percent.toString());
                
            }else{
                var sum_percent = isNaN(parseFloat(total_percent) + parseFloat(response.percentage)) ? 0 :(parseFloat(total_percent) + parseFloat(response.percentage))
                $('#sliptotalpercentrporupdate').val(sum_percent.toString());
            }

            var total_percent2 =  $('#sliptotalpercentrporupdate').val();
            console.log("Total Percent Installent : " + $('#sliptotalpercentrporupdate').val())
            if(parseInt(total_percent2)>=100)
            {
                console.log("do hide button");
                $('#addretrocessioninsuredupdate-btn').attr('hidden','true');
            }
            

        }
    });

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
       var code_ms = $('#insuredIDtxt').val();
       var sliptype = $('#sliptypeform').val();  
       var countendorsement = $('#countendorsmentdata').val();
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
            // var curr_amount = response.amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            $('#retrocessionPanelendorsement tbody').append('<tr id="iidretrocessionendorsement'+response.id+'" data-name="retrocessionendorsementvalue[]"><td data-name="'+response.contract+'">'+response.contract+'</td><td data-name="'+floatToString(response.percentage)+'">'+floatToString(response.percentage)+'</td><td data-name="'+amountToString(response.amount)+'">'+amountToString(response.amount)+'</td><td><a href="javascript:void(0)" onclick="deleteretrocessionendorsement('+response.id+')">delete</a></td></tr>');
            $('#sliprppercentageendorsement').val('');
            $('#sliprpamountendorsement').val('');
            var total_percent =  $('#sliptotalpercentrporendorsement').val();

            if(total_percent == ''){
                var sum_percent = isNaN(parseFloat(0) + parseFloat(response.percentage)) ? 0 :(parseFloat(0) + parseFloat(response.percentage)) ;
                $('#sliptotalpercentrporendorsement').val(sum_percent.toString());
                
            }else{
                var sum_percent = isNaN(parseFloat(total_percent) + parseFloat(response.percentage)) ? 0 :(parseFloat(total_percent) + parseFloat(response.percentage))
                $('#sliptotalpercentrporendorsement').val(sum_percent.toString());
            }

            var total_percent2 =  $('#sliptotalpercentrporendorsement').val();
            console.log("Total Percent Installent : " + $('#sliptotalpercentrporendorsement').val())
            if(parseInt(total_percent2)>=100)
            {
                console.log("do hide button");
                $('#addretrocessioninsuredupdate-btn').attr('hidden','true');
            }
        }
    });

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
<script type='text/javascript'>
    function deleteretrocessionupdate(id)
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
                var total_percent =  $('#sliptotalpercentrporupdate').val();
                        
                var sum_percent = isNaN(parseFloat(total_percent) - parseFloat(response.percentage)) ? 0 :(parseFloat(total_percent) - parseFloat(response.percentage)) ;
                $('#sliptotalpercentrporupdate').val(sum_percent.toString());
                console.log('total percent' + $('#sliptotalpercentrporupdate').val())
                        

                var total_percent2 =  parseFloat($('#sliptotalpercentrporupdate').val());

                if(parseInt(total_percent2) < 100)
                {
                    $('#addretrocessioninsuredupdate-btn').attr('hidden','false');
                    $('#addretrocessioninsuredupdate-btn').removeAttr('hidden')
                }
            }

        });
    }
</script>
<script type='text/javascript'>
    function deleteretrocessionendorsement(id)
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
                $('#sliptotalpercentrporendorsement').val(sum_percent.toString());
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
{{-- form table input data end --}}

{{-- save form --}}
<script type='text/javascript'>
    $('#multi-file-upload-ajax').submit(function(e){
       //alert('masuk');
       e.preventDefault();

       var code_ms = $('#insuredIDtxt').val();
       var slipnumber = $('#slipnumber').val();
       var slipdatetransfer = $('#sliptd').val();
       var slipstatus = $('#slipstatus').val();
       
       var slipcedingbroker = $('#slipcedingbroker').val();
       var slipceding = $('#slipceding').val();
       // var slipcurrency = $('#slipcurrency').val();
       var slipcob = $('#slipcob').val();
       var slipkoc = $('#slipkoc').val();
       var slipoccupacy = $('#slipoccupacy').val();
       var slipbld_const = $('#slipbld_const').val();
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
       var sliptypeform = $('#sliptypeform').val();
       var sliptype =  $('#sliptype').val();
       var slippct =  $('#slippct').val();
       var sliptotalsumpct =  $('#sliptotalsumpct').val();
       var slipipfrom =  $('#slipipfrom').val();
       var slipipto =  $('#slipipto').val();
       var sliprpfrom =  $('#sliprpfrom').val();
       var sliprpto =  $('#sliprpto').val();
       var proportional =  $('#switch-proportional').val();
       var sliplayerproportional =  $('#sliplayerproportional').val();
       var sliprate =  $('#sliprate').val();
       var sliptotalrate =  $('#sliptotalrate').val();
       var slipvbroker =  $('#slipvbroker').val();
       var slipsumvbroker =  $('#slipsumfee').val();
       var slipshare =  $('#slipshare').val();
       var slipsumshare =  $('#slipsumshare').val();
       var slipbasicpremium =  $('#slipbasicpremium').val();
       var slipgrossprmtonr =  $('#slipgrossprmtonr').val();
       var slipsumcommission =  $('#slipsumcommission').val();
       var slipcommission =  $('#slipcommission').val();
       var slipnetprmtonr =  $('#slipnetprmtonr').val();
       var sliprb =  $('#sliprb').val();
       var slipor =  $('#slipor').val();
       var slipsumor =  $('#slipsumor').val();
       var wpc =  $('#wpc').val();
       var remarks =  $('#remarks').val();
       var sliptypeform = $('#sliptypeform').val();
       var sliptotalpercentrpor = $('#sliptotalpercentrpor').val();
       console.log("ini slip type "+sliptypeform)
       if(sliptypeform == 'fe'){
            var insuredshare = $('#fesharefrom').val();
            var kurs = $('#fekurs').val();
            var currency = $( "#fecurrency option:selected" ).text();
        }else if(sliptypeform == 'fl'){
            var insuredshare = $('#flsharefrom').val();
            var kurs = $('#flkurs').val();
            var currency = $( "#flcurrency option:selected" ).text();
        }else if(sliptypeform == 'hem'){
            var insuredshare = $('#hemsharefrom').val();
            var kurs = $('#hemkurs').val();
            var currency = $( "#hemcurrency option:selected" ).text();
        }else if(sliptypeform == 'mp'){
            var insuredshare = $('#mpsharefrom').val();
            var kurs = $('#mpkurs').val();
            var currency = $( "#mpcurrency option:selected" ).text();
        }else if(sliptypeform == 'hio'){
            var insuredshare = $('#hiosharefrom').val();
            var kurs = $('#hiokurs').val();
            var currency = $( "#hiocurrency option:selected" ).text();
        }else if(sliptypeform == 'pa'){
            var insuredshare = $('#pasharefrom').val();
            var kurs = $('#pakurs').val();
            var currency = $( "#pacurrency option:selected" ).text();
        }
       

       var btnins = $("#addinsuredsave-btn").text();
       
       var conv_curr = currency.substring(0,3);
       console.log("btn ins "+ btnins)

       var token2 = $('input[name=_token]').val();

       //var real_kurs = kurs.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

       var real_kurs = 1;
        if(currency)
        {
            const searchTerm = ':';
            const indexOfFirst = currency.indexOf(searchTerm);
            const data2 = currency.substring(indexOfFirst+1);
            
            real_kurs = data2.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }
        else{
            real_kurs = 1;
        }


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

       var conv_slipsumrate = sliptotalrate.replace(/,/g, "");
       console.log(conv_slipsumrate)
       var real_slipsumrate = parseFloat(conv_slipsumrate);
       console.log(real_slipsumrate)

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
       }else if(sliptotalsumpct == null || sliptotalsumpct == ""){
            sliptotalsum = "please check pct";
       }else if(sliptotalrate == null || sliptotalrate == ""){
            sliptotalrate = "please check rate";
       }else if(slipbasicpremium == null || slipbasicpremium == ""){
            slipbasicpremium = "please check basic premium";
       }else if(slipsumshare == null || slipsumshare == ""){
            slipsumshare = "please check nasionalre share ";
       }else if(slipgrossprmtonr == null || slipgrossprmtonr == ""){
            slipgrossprmtonr = "please check gross prm to nr";
       }else if(slipnetprmtonr == null || slipnetprmtonr == ""){
            slipnetprmtonr = "please check net prm to nr";
       }else if(slipsumcommission == null || slipsumcommission == ""){
            slipsumcommission = "please check commision ";
       }else if(slipsumfee == null || slipsumfee == ""){
            slipsumfee = "please check fee broker";
       }else if(slipsumor == null || slipsumor == ""){
            slipsumor = "please check own retention";
       }

       var hasil_kurs_tsi = (real_sliptotalsum * parseFloat(real_kurs));
       var hasil_kurs_basic_premium = (real_slipbasicpremium * parseFloat(real_kurs));
       var hasil_kurs_grossprmtonr = (real_slipgrossprmtonr * parseFloat(real_kurs));
       var hasil_kurs_netprmtonr = (real_slipnetprmtonr * parseFloat(real_kurs));

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
       console.log('jumlah installment panel ' + current_percent);

       var current_percent_rp = $('#sliptotalpercentrpor').val();
       console.log('jumlah total or ' + current_percent_rp);

       var count_endorsement_ins = $('#fecountendorsement').val();
       console.log('count endorsement ' + count_endorsement_ins);
       
       swal({
            title: "Are you sure to submit this slip form?",
            html: message,
            type: "warning",
            customClass: 'swal-wide',
            showConfirmButton:true,
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: 'Ok',
            cancelButtonText: 'Cancel',
            focusConfirm:true
        }).then(result => {
        if (result.value)
        {
            if(btnins == "Save"){
                swal("Error!", "Please input Insured data First!!!", "Insert Error");
            }else{
                if(parseFloat(sliptotalpercentrpor) <100 ){
                    swal("Warning!","Please fill retrocession panel until 100%","warning");
                    return;
                }
                if(parseFloat(current_percent) == 100.00)
                {
                    var jumlah_tgl = $('#slipdaytotal').val();
                    console.log('jumlah_tgl '+jumlah_tgl)
                    if(parseInt(jumlah_tgl) > 0){
                        var type_tsi = $('#sliptypetsi').val();
                        var tsislipval = $('#sliptotalsum').val();
                        var conv_tsislipval = tsislipval.replace(/,/g, "");
                        var int_tsislipval = parseFloat(conv_tsislipval);
                        var int_fullslip = parseInt(int_tsislipval);

                        
                        var sliptypeform = $('#sliptypeform').val();
                        if(sliptypeform == 'fe'){
                            var tsiinsval = $('#feshareto').val();
                            var cedshareins = $('#feshare').val();
                        }else if(sliptypeform == 'fl'){
                            var tsiinsval = $('#flshareto').val();
                            var cedshareins = $('#flshare').val();
                        }else if(sliptypeform == 'hem'){
                            var tsiinsval = $('#hemshareto').val();
                            var cedshareins = $('#hemshare').val();
                        }else if(sliptypeform == 'mp'){
                            var tsiinsval = $('#mpshareto').val();
                            var cedshareins = $('#mpshare').val();
                        }else if(sliptypeform == 'hio'){
                            var tsiinsval = $('#hioshareto').val();
                            var cedshareins = $('#hioshare').val();
                        }else if(sliptypeform == 'pa'){
                            var tsiinsval = $('#pashareto').val();
                            var cedshareins = $('#pashare').val();
                        }
                        var conv_tsiinsval = tsiinsval.replace(/,/g, "");
                        var int_tsiinsval = parseFloat(conv_tsiinsval);
                        // var int_fullins = int_tsiinsval.toFixed(2);
                        var new_instsi = int_tsiinsval.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                        
                        var conv_cedshareins = cedshareins.replace(/,/g, "");
                        var int_cedshareins = parseFloat(conv_cedshareins);
                        var int_fullcedshare = int_cedshareins.toFixed(2);
                        var new_cedshareins = int_fullcedshare.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                        console.log('conv_tsislipval '+ conv_tsislipval)
                        console.log('type_tsi '+ type_tsi)
                        console.log('tsislipval '+ tsislipval)
                        console.log('tsiinsval '+ tsiinsval)
                        console.log('cedshareins '+ cedshareins)
                        console.log('int_tsislipval '+ int_tsislipval)
                        console.log('int_cedshareins '+ int_cedshareins)

                        if(type_tsi == 1){
                            console.log('int_tsislipval' + int_tsislipval)
                            console.log('int_tsiinsval' + int_tsiinsval)
                            console.log('int_fullslip' + int_fullslip)
                            // console.log('int_fullins' + int_fullins)
                            if(tsislipval == tsiinsval){
                                    $.ajaxSetup({
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        }
                                    });

                                    $.ajax({
                                            url:"{{url('transaction-data/"+sliptypeform+"/storeslip')}}",
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
                                                slipoccupacy:slipoccupacy,
                                                slipbld_const:slipbld_const,
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
                                                sliprate:sliprate,
                                                sliptotalrate:real_slipsumrate,
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
                                                sliptypeform:sliptypeform,
                                                remarks:remarks
                                            },
                                            beforeSend: function() { $("body").addClass("loading");  },
                                            complete: function() {  $("body").removeClass("loading"); },
                                            success:function(response)
                                            {
                                            swal("Success!", "Insured Fire & Engineering Slip Insert Success", "success")
                                            console.log(response)



                                            if(response.date_transfer){
                                                $('#SlipInsuredTableData tbody').append('<tr id="slipiid'+response.id+'" data-name="slipvalue[]"><td data-name="'+response.number+'">'+response.number+'</td><td data-name="'+response.cedingbroker+'">'+response.cedingbroker+'</td><td data-name="'+response.ceding+'">'+response.ceding+'</td>'
                                                +'<td data-name="'+response.slipstatus+'">'+response.slipstatus+'</td><td>'+response.count_endorsement+'</td><td><div class="row"></div>'
                                                +'<a class="text-primary mr-3 float-right " data-toggle="modal" data-book-id="'+response.id+'" data-target="#detailmodaldata" href="#detailmodaldata">'
                                                +'<button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#detailmodaldata2">Detail</button>'
                                                +'</a>'
                                                +'<a class="text-primary mr-3 float-right " data-toggle="modal" data-book-id="'+response.id+'" data-target="#updatemodaldata">'
                                                +'<button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal"  data-target="#updatemodaldata2">Edit</button>'
                                                +'</a>'
                                                +'<a class="text-primary mr-3 float-right " data-toggle="modal" data-book-id="{{ @$slipdatatadetail->id }}" data-target="#cancelmodaldata">'
                                                +'<button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#cancelmodaldata2">Cancel</button>'
                                                +'</a>'
                                                // +'<button type="button" id="claim-endorse" class="btn btn-sm btn-warning float-right">Claim</button>'
                                                +'</div></td></tr>');    
                                            }else{
                                                $('#SlipInsuredTableData tbody').append('<tr id="slipiid'+response.id+'" data-name="slipvalue[]"><td data-name="'+response.number+'">'+response.number+'</td><td data-name="'+response.cedingbroker+'">'+response.cedingbroker+'</td><td data-name="'+response.ceding+'">'+response.ceding+'</td>'
                                                +'<td data-name="'+response.slipstatus+'">'+response.slipstatus+'</td><td>'+response.count_endorsement+'</td><td>'
                                                +'<a class="text-primary mr-3 float-right " data-toggle="modal"  data-book-id="'+response.id+'" data-target="#detailmodaldata" href="#detailmodaldata">'
                                                +'<button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#detailmodaldata2">Detail</button>'
                                                +'</a>'
                                                +'<a class="text-primary mr-3 float-right " data-toggle="modal" data-book-id="'+response.id+'" data-target="#updatemodaldata">'
                                                +'<button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#updatemodaldata2">Edit</button>'
                                                +'</a>'
                                                // +'<a class="text-primary mr-3 float-right " data-toggle="modal" data-book-id="'+response.id+'" data-target="#endorsementmodaldata">'
                                                // +'<button type="button" id="btnendorsementslip" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#endorsementmodaldata2">Endorsement</button>'
                                                // +'</a>'
                                                +'<a class="text-primary mr-3 float-right " data-toggle="modal" data-book-id="'+response.id+'" data-target="#cancelmodaldata">'
                                                +'<button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#cancelmodaldata2">Cancel</button>'
                                                +'</a>'
                                                // +'<button type="button" id="claim-endorse" class="btn btn-sm btn-warning float-right">Claim</button>'
                                                +'</td></tr>');
                                            }
                                            

                                                

                                            $('#slipnumber').val(response.slipnumber);
                                            // $('#feshare').val(response.ourshare);
                                            // $('#fesharefrom').val(response.sumshare);
                                            $('#installmentPanel tbody').empty();
                                            $('#ExtendCoveragePanel tbody').empty();
                                            $('#deductiblePanel tbody').empty();
                                            $('#retrocessionPanel tbody').empty();
                                            $('#addinstallmentinsured-btn').attr('hidden','false');
                                            $('#addinstallmentinsured-btn').removeAttr('hidden');

                                            $('select').prop('selectedIndex',0);
                                            $('#sliptotalnilaiec').val('');
                                            $('#slipbcla').val('');
                                            $('#slipbcua').val('');
                                            $('#wpc').val("");
                                            $('#remarks').val("");
                                            $('#sliptotalsum').val("");
                                            $('#sliptotalsum2').val("");
                                            $('#slippct').val("");
                                            $('#sliptotalsumpct').val("");
                                            $('#sliptotalsumpct2').val("");
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
                                            $("#slipcncode option:contains(Peril List)").attr('selected', 'selected');
                                            $("#slipbld_const option:contains(Building Const list)").attr('selected', 'selected');
                                            $("#slipoccupacy option:contains(Occupation list)").attr('selected', 'selected');
                                            $("#slipkoc option:contains(KOC list)").attr('selected', 'selected');
                                            $("#slipcob option:contains(COB list)").attr('selected', 'selected');
                                            $("#slipceding option:contains(select ceding)").attr('selected', 'selected');
                                            $("#slipcedingbroker option:contains(Ceding or Broker)").attr('selected', 'selected');

                                        },
                                        error: function (request, status, error) {
                                                //alert(request.responseText);
                                                swal("Error!", "Insured Slip Insert Error : " + request.responseText, "Insert Error");
                                            }
                                        });



                                        var formData = new FormData(this);
                                        let TotalFiles = $('#attachment')[0].files.length; //Total files
                                        let files = $('#attachment')[0];
                                        var slip_id = $('#slipnumber').val();
                                        var insured_id = $('#insuredIDtxt').val();

                                        if(TotalFiles > 0){
                                            for (let i = 0; i < TotalFiles; i++){
                                                formData.append('files' + i, files.files[i]);
                                            }

                                            formData.append('TotalFiles', TotalFiles);
                                            formData.append('slip_id', slip_id);
                                            formData.append('insured_id', insured_id);
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

                                        }

                                        
                                        
                            }else{
                                swal('Warning!','please check tsi value again','insert error');
                            }
                        }else if(type_tsi == 2){
                            $.ajaxSetup({
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        }
                                    });

                                    $.ajax({
                                            url:"{{url('transaction-data/"+sliptypeform+"/storeslip')}}",
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
                                                slipoccupacy:slipoccupacy,
                                                slipbld_const:slipbld_const,
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
                                                sliprate:sliprate,
                                                sliptotalrate:real_slipsumrate,
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
                                                slipsharetotalsum:real_slipsharetotalsum,
                                                sliptypetotalsum:sliptypetotalsum,
                                                sliptypetsishare:sliptypetsishare,
                                                sliptotalday:sliptotalday,
                                                sliptotalyear:sliptotalyear,
                                                slipdatesum:real_slipdatesum,
                                                insured_share:real_insuredshare,
                                                wpc:wpc,
                                                sliptypeform:sliptypeform,
                                                remarks:remarks
                                            },
                                            beforeSend: function() { $("body").addClass("loading");  },
                                            complete: function() {  $("body").removeClass("loading"); },
                                            success:function(response)
                                            {
                                            swal("Success!", "Insured  Slip Insert Success", "success")
                                            console.log(response)


                                            if(response.date_transfer){
                                                $('#SlipInsuredTableData tbody').append('<tr id="slipiid'+response.id+'" data-name="slipvalue[]"><td data-name="'+response.number+'">'+response.number+'</td><td data-name="'+response.cedingbroker+'">'+response.cedingbroker+'</td><td data-name="'+response.ceding+'">'+response.ceding+'</td>'
                                                +'<td data-name="'+response.slipstatus+'">'+response.slipstatus+'</td><td>'+response.count_endorsement+'</td><td>'
                                                +'<a class="text-primary mr-3 float-right " data-toggle="modal"  data-book-id="'+response.id+'" data-target="#detailmodaldata" href="#detailmodaldata">'
                                                +'<button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#detailmodaldata2">Detail</button>'
                                                +'</a>'
                                                // +'<a class="text-primary mr-3 float-right " data-toggle="modal" data-book-id="'+response.id+'" data-target="#updatemodaldata">'
                                                // +'<button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#updatemodaldata2">Edit</button>'
                                                // +'</a>'
                                                +'<a class="text-primary mr-3 float-right " data-toggle="modal" data-book-id="'+response.id+'" data-target="#endorsementmodaldata">'
                                                +'<button type="button" id="btnendorsementslip" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#endorsementmodaldata2">Endorsement</button>'
                                                +'</a>'
                                                +'<a class="text-primary mr-3 float-right " data-toggle="modal" data-book-id="'+response.id+'" data-target="#cancelmodaldata">'
                                                +'<button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#cancelmodaldata2">Cancel</button>'
                                                +'</a>'
                                                // +'<button type="button" id="claim-endorse" class="btn btn-sm btn-warning float-right">Claim</button>'
                                                +'</td></tr>');    
                                            }else{
                                                $('#SlipInsuredTableData tbody').append('<tr id="slipiid'+response.id+'" data-name="slipvalue[]"><td data-name="'+response.number+'">'+response.number+'</td><td data-name="'+response.cedingbroker+'">'+response.cedingbroker+'</td><td data-name="'+response.ceding+'">'+response.ceding+'</td>'
                                                +'<td data-name="'+response.slipstatus+'">'+response.slipstatus+'</td><td>'+response.count_endorsement+'</td><td>'
                                                +'<a class="text-primary mr-3 float-right " data-toggle="modal"  data-book-id="'+response.id+'" data-target="#detailmodaldata" href="#detailmodaldata">'
                                                +'<button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#detailmodaldata2">Detail</button>'
                                                +'</a>'
                                                +'<a class="text-primary mr-3 float-right " data-toggle="modal" data-book-id="'+response.id+'" data-target="#updatemodaldata">'
                                                +'<button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#updatemodaldata2">Edit</button>'
                                                +'</a>'
                                                // +'<a class="text-primary mr-3 float-right " data-toggle="modal" data-book-id="'+response.id+'" data-target="#endorsementmodaldata">'
                                                // +'<button type="button" id="btnendorsementslip" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#endorsementmodaldata2">Endorsement</button>'
                                                // +'</a>'
                                                +'<a class="text-primary mr-3 float-right " data-toggle="modal" data-book-id="'+response.id+'" data-target="#cancelmodaldata">'
                                                +'<button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#cancelmodaldata2">Cancel</button>'
                                                +'</a>'
                                                // +'<button type="button" id="claim-endorse" class="btn btn-sm btn-warning float-right">Claim</button>'
                                                +'</td></tr>');
                                            }

                                            $('#slipnumber').val(response.number);
                                            // $('#feshare').val(response.ourshare);
                                            // $('#fesharefrom').val(response.sumshare);
                                                $('#installmentPanel tbody').empty();
                                            $('#ExtendCoveragePanel tbody').empty();
                                            $('#deductiblePanel tbody').empty();
                                            $('#retrocessionPanel tbody').empty();

                                            $('#sliptotalnilaiec').val('');
                                            $('#sliptotalpercentinspan').val('');

                                            $('select').prop('selectedIndex',0);
                                            $('#sliptotalnilaiec').val('');
                                            $('#sliptotalpercentinspan').val('');
                                            $('#slipbcla').val('');
                                            $('#slipbcua').val('');
                                            $('#wpc').val("");
                                            $('#remarks').val("");
                                            $('#sliptotalsum').val("");
                                            $('#sliptotalsum2').val("");
                                            $('#slippct').val("");
                                            $('#sliptotalsumpct').val("");
                                            $('#sliptotalsumpct2').val("");
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
                                            $("#slipcncode option:contains(Peril List)").attr('selected', 'selected');
                                            $("#slipbld_const option:contains(Building Const list)").attr('selected', 'selected');
                                            $("#slipoccupacy option:contains(Occupation list)").attr('selected', 'selected');
                                            $("#slipkoc option:contains(KOC list)").attr('selected', 'selected');
                                            $("#slipcob option:contains(COB list)").attr('selected', 'selected');
                                            $("#slipceding option:contains(select ceding)").attr('selected', 'selected');
                                            $("#slipcedingbroker option:contains(Ceding or Broker)").attr('selected', 'selected');


                                        },
                                        error: function (request, status, error) {
                                                //alert(request.responseText);
                                                swal("Error!", "Insured  Slip Insert Error : " + request.responseText, "Insert Error");
                                            }
                                        });



                                        var formData = new FormData(this);
                                        let TotalFiles = $('#attachment')[0].files.length; //Total files
                                        let files = $('#attachment')[0];
                                        var slip_id = $('#slipnumber').val();
                                        var insured_id = $('#insuredIDtxt').val();

                                        if(TotalFiles > 0){
                                            for (let i = 0; i < TotalFiles; i++){
                                                formData.append('files' + i, files.files[i]);
                                            }

                                            formData.append('TotalFiles', TotalFiles);
                                            formData.append('slip_id', slip_id);
                                            formData.append('insured_id', insured_id);
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

                                        }

                                        
                                     
                        }
                    }else{
                        swal('Warning!','please check date insurance/reinsurance periode cannot minus','insert error');
                    }
                }else{
                    swal("Error!", "Please input installment panel until 100%", "Insert Error");
                }
            }
           


        }
        else {
            swal('Cancelled');
        
        }

    });

    });
</script>

<script type='text/javascript'>
    $('#multi-file-upload-ajaxupdate').submit(function(e){
       // alert('masuk ' + $('#insuredIDtxt').val() + ' ' + $('#slipnumberupdate').val()) ;
       e.preventDefault();


       var code_ms = $('#insuredIDtxt').val();
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
       var slipoccupacy = $('#slipoccupacyupdate').val();
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
       var sliprate =  $('#sliprateupdate').val();
       var slipsumrate =  $('#sliptotalrateupdate').val();
       var slipvbroker =  $('#slipvbrokerupdate').val();
       var slipsumvbroker =  $('#slipsumfeeupdate').val();
       var slipshare =  $('#slipshareupdate').val();
       var slipsumshare =  $('#slipsumshareupdate').val();
       var slipoldsumshare =  $('#slipoldsumshareupdate').val();
       var slipbasicpremium =  $('#slipbasicpremiumupdate').val();
       var slipgrossprmtonr =  $('#slipgrossprmtonrupdate').val();
       var slipsumcommission =  $('#slipsumcommissionupdate').val();
       var slipcommission =  $('#slipcommissionupdate').val();
       var slipnetprmtonr =  $('#slipnetprmtonrupdate').val();
       var sliprb =  $('#sliprbupdate').val();
       var slipor =  $('#sliporupdate').val();
       var slipsumor =  $('#slipsumorupdate').val();
       var wpc =  $('#wpcupdate').val();
       var remarks =  $('#remarksupdate').val();
       var sliptotalday = $('#slipdaytotalupdate').val();
       var sliptotalyear = $('#slipdaytotalupdate3').val();
       var sliptotaldatesum = $('#sliptotalsumdateupdate').val();
       var countendorsement = $('#countendorsmentupdate').val();
       var sliptypeform = $('#sliptypeform').val();

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

       var conv_slipsumrate = slipsumrate.replace(/,/g, "");
       console.log(conv_slipsumrate)
       var real_slipsumrate = parseFloat(conv_slipsumrate);
       console.log(real_slipsumrate)

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
       console.log('jumlah installment panel ' + current_percent)
       var current_percent_rp = $('#sliptotalpercentrporupdate').val();
       console.log('jumlah total or ' + current_percent_rp)

       var count_endorsement_ins = $('#fecountendorsement').val();
       console.log('count endorsement ' + count_endorsement_ins)


        if(parseFloat(current_percent) == 100.00)
        {
             $.ajaxSetup({
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

               $.ajax({
                 url:"{{url('transaction-data/"+sliptypeform+"/updateslip')}}",
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
                     slipoccupacy:slipoccupacy,
                     slipbld_const:slipbld_const,
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
                     sliprate:sliprate,
                     slipsumrate:real_slipsumrate,
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
                     sliptypeform:sliptypeform,
                     countendorsement:countendorsement
                 },
                 beforeSend: function() { $("body").addClass("loading");  },
                 complete: function() {  $("body").removeClass("loading"); },
                 success:function(response)
                 {
                    swal("Success!", "Insured  Slip Update Success", "success")
                    console.log(response)
                    if(response.new_share_nasre){
                        var new_nasre = response.new_share_nasre;
                        var conv_nasre = new_nasre.toFixed(2);
                        var real_nasre = conv_nasre.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        // $('#fesharefrom').val(conv_nasre);
                        var sliptypeform = $('#sliptypeform').val();
                        if(sliptypeform == 'fe'){
                            $('#fesharefrom').val(conv_nasre);
                        }else if(sliptypeform == 'fl'){
                            $('#flsharefrom').val(conv_nasre);
                        }else if(sliptypeform == 'hem'){
                            $('#hemsharefrom').val(conv_nasre);
                        }else if(sliptypeform == 'mp'){
                            $('#mpsharefrom').val(conv_nasre);
                        }else if(sliptypeform == 'hio'){
                            $('#hiosharefrom').val(conv_nasre);
                        }else if(sliptypeform == 'pa'){
                            $('#pasharefrom').val(conv_nasre);
                        }
                        
                    }

                    $('#updatemodaldata').modal('toggle');
                    refreshTableSlip(code_ms);

                    },
                    error: function (request, status, error) {
                        //alert(request.responseText);
                        swal("Error!", "Insured Fire & Engineering Slip Update Error", "Update Error");
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
                                 // swal("Error!", data.responseJSON.errors.files[0], "Insert Error");
                                 //console.log(data.responseJSON.errors);
                             }
                         });

        }else if(parseFloat(current_percent) > 100.00){
            swal("Error!", "Please input installment panel until 100%", "Insert Error");
        }else if(parseFloat(current_percent) < 100.00){
            swal("Error!", "Please input installment panel until 100%", "Insert Error");
        }else{
            swal("Error!", "Please input installment panel until 100%", "Insert Error");
        }
    });
</script>

<script type='text/javascript'>
    $('#multi-file-upload-ajaxendorsement').submit(function(e){
       //alert('masuk');
       e.preventDefault();

       var code_ms = $('#insuredIDtxt').val();
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
       var slipoccupacy = $('#slipoccupacyendorsement').val();
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
       var slipvbroker =  $('#slipvbrokerendorsement').val();
       var slipshare =  $('#slipshareendorsement').val();
       var slipsumshare =  $('#slipsumshareendorsement').val();
       var slipbasicpremium =  $('#slipbasicpremiumendorsement').val();
       var slipgrossprmtonr =  $('#slipgrossprmtonrendorsement').val();
       var slipsumcommission =  $('#slipsumcommissionendorsement').val();
       var slipcommission =  $('#slipcommissionendorsement').val();
       var slipnetprmtonr =  $('#slipnetprmtonrendorsement').val();
       var sliprb =  $('#sliprbendorsement').val();
       var slipor =  $('#sliporendorsement').val();
       var slipsumor =  $('#slipsumorendorsement').val();
       var wpc =  $('#wpcendorsement').val();
       var remarks =  $('#remarksendorsement').val();
       var countendorsement = $('#countendorsmentdata').val();
       var sliptypetsi = $('#sliptypetsiendorsement').val();
       var sharetypetsi = $('#sharetypetsiendorsement').val();      
       var sharetotalsum = $('#sharetotalsumendorsement').val();
       var slipsumrate =  $('#sliptotalrateendorsement').val();
       var slipsumvbroker =  $('#slipsumfeeendorsement').val();
       var sliptotalday = $('#slipdaytotalendorsement').val();
       var sliptotalyear = $('#slipdaytotalendorsement3').val();
       var sliptotaldatesum = $('#sliptotalsumdateendorsement').val();
       var sliptypeform = $('#sliptypeform').val();

       var token2 = $('input[name=_token]').val();
       
       console.log('form' + slipipfrom);

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

       var conv_slipsumrate = slipsumrate.replace(/,/g, "");
       console.log(conv_slipsumrate)
       var real_slipsumrate = parseFloat(conv_slipsumrate);
       console.log(real_slipsumrate)
       var conv_slipsumvbroker = slipsumvbroker.replace(/,/g, "");
       console.log(conv_slipsumvbroker)
       var real_slipsumvbroker = parseFloat(conv_slipsumvbroker);
       console.log(real_slipsumvbroker)
       var conv_slipsharetotalsum = sharetotalsum.replace(/,/g, "");
       console.log(conv_slipsharetotalsum)
       var real_slipsharetotalsum = parseFloat(conv_slipsharetotalsum);
       console.log(real_slipsharetotalsum)
       
       //ajaxfilefunction(e);
       console.log('slipid' + slipid)
       $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
       });

       $.ajax({
         url:"{{url('transaction-data/"+sliptypeform+"/endorsementslip')}}",
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
             slipoccupacy:slipoccupacy,
             slipbld_const:slipbld_const,
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
             total_day:sliptotalday,
             total_year:sliptotalyear,
             sum_total_date:sliptotaldatesum,
             type_tsi:sliptypetsi,
             share_tsi:real_slipsharetotalsum,
             type_share_tsi:sharetypetsi,
             sliptotalrate:real_slipsumrate,
             sum_feebroker:real_slipsumvbroker,
             sliptypeform:sliptypeform,
             countendorsement:countendorsement
         },
         beforeSend: function() { $("body").addClass("loading");  },
         complete: function() {  $("body").removeClass("loading"); },
         success:function(response)
         {
            swal("Success!", "Insured Fire & Engineering Slip Endorsement Success", "success")
            console.log(response)
            console.log('count endorsement nya ' + response.count_endorsement)

            // var insured_data2=JSON.parse(response.insured_data);
            // $('#fecountendorsement').val(insured_data2.count_endorsement);
            //alert(insured_data2.count_endorsement);

            // var slip_data2array=JSON.parse(response.slip_dataarray);
            var slip_dataarray=JSON.parse(response.slip_data);
            
            // $('#SlipInsuredTableData tbody tr[id=slipiid'+response.oldid+']').remove();
            
            // slip_data2array.forEach(function (arrayItem) 
            // {
            //     var x = arrayItem.prop1 + 2;

                var max_endorsement = response.max_endorsement;
                console.log('max endorse ' + response.max_endorsement)

                refreshTableSlip(code_ms);

                // $('#SlipInsuredTableData tbody ').append('<tr id="slipiid'+slip_dataarray.id+'" data-name="slipvalue[]"><td data-name="'+slip_dataarray.number+'">'+slip_dataarray.number+'</td><td data-name="'+slip_dataarray.cedingbroker+'">'+slip_dataarray.cedingbroker+'</td><td data-name="'+slip_dataarray.ceding+'">'+slip_dataarray.ceding+'</td><td data-name="'+slip_dataarray.status+'">'+slip_dataarray.status+'</td><td>'
                //  +'<a class="text-primary mr-3 float-right" data-toggle="modal"  data-book-id="'+slip_dataarray.id+'" data-target="#detailmodaldata" href="#detailmodaldata">'
                //  +'<button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#detailmodaldata2">Detail</button>'
                //  +'</a>'
                //  +'<a class="text-primary mr-3 float-right " data-toggle="modal" data-book-id="'+slip_dataarray.id+'" data-target="#updatemodaldata">'
                //  +'<button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#updatemodaldata2">Edit</button>'
                //  +'</a>'
                //  +'<a class="text-primary mr-3 float-right " data-toggle="modal" data-book-id="'+slip_dataarray.id+'" data-target="#endorsementmodaldata">'
                //  +'<button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#endorsementmodaldata2">Endorsement</button>'
                //  +'</a>'
                //  +'<a class="text-primary mr-3 float-right " data-toggle="modal" data-book-id="'+slip_dataarray.id+'" data-target="#cancelmodaldata">'
                //  +'<button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#cancelmodaldata2">Cancel</button>'
                //  +'</a>'
                //  +'<button type="button" id="claim-endorse" class="btn btn-sm btn-warning float-right">Claim</button>'
                //  +'</td></tr>');                
                


            // });

            
            $('#endorsementmodaldata').modal('toggle');
            $('#endorsementmodaldata2').modal('toggle');

            // $('#slipnumberendorsement').val(response.number);

        },
        error: function (request, status, error) {
            //alert(request.responseText);
            swal("Error!", "Insured Fire & Engineering Slip Endorsement Error", "Insert Error");
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

    });
</script>
{{-- save form end --}}

{{-- modal form --}}
<script type="text/javascript">
  
    //triggered when modal is about to be shown
    $('#detailmodaldata').on('show.bs.modal', function(e) {

        //get data-id attribute of the clicked element
        var codesl = $(e.relatedTarget).data('book-id');
        var sliptype = $('#sliptypeform').val();
        //alert(codesl);

        $.ajax({
        url:'{{ url("/") }}/transaction-data/'+sliptype+'/detail-slip/'+codesl,
        type:"GET",
        beforeSend: function() { $("body").addClass("loading");  },
        complete: function() {  $("body").removeClass("loading"); },
        success:function(response)
        {
            console.log('bisa tampil')
            console.log(codesl);
            console.log(response);
            $('#slipnumberdetail').val(response.number);
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
                        if(obj)
                        {

                            //console.log(obj.id);
                            //$('#interestInsuredTabledetail tbody').append('');
                            // var curr_amount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(obj.amount);
                            
                            
                            $('#deductiblePaneldetail tbody').append('<tr id="iiddeductible'+obj.id+'" data-name="deductibledetailvalue[]"><td data-name="'+obj.deductibletype+'">'+obj.deductibletype+'</td><td data-name="'+floatToString(parseFloat(obj.percentage).toFixed(2))+'">'+floatToString(parseFloat(obj.percentage).toFixed(2))+'%</td><td data-name="'+amountToString(obj.amount)+'">'+amountToString(obj.amount)+'</td><td data-name="'+amountToString(obj.min_claimamount)+'">'+amountToString(obj.min_claimamount)+'</td><td></td></tr>');
                        }
                        
                    }
                }


                if(response.extend_coverage && response.extend_coverage.length > 10)
                {

                    var extend_coverage = JSON.parse(response.extend_coverage); 
                    $('#ExtendCoveragePaneldetail tbody').empty();
                    for(var i = 0; i < extend_coverage.length; i++) 
                    {
                        var obj = extend_coverage[i];

                        //console.log(obj.id);
                        //$('#interestInsuredTabledetail tbody').append('');
                        // var curr_amount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(obj.amount);
                        if(obj)
                        {
                          
                            
                            $('#ExtendCoveragePaneldetail tbody').append('<tr id="iidextendcoveragedetail'+obj.id+'" data-name="extendcoveragedetailvalue[]"><td data-name="'+obj.coveragetype+'">'+obj.coveragecode + ' - ' + obj.coveragename+'</td><td data-name="'+obj.percentage+'">'+floatToString(parseFloat(obj.percentage).toFixed(5))+'</td><td data-name="'+amountToString(obj.amount)+'" class="uangdata">'+amountToString(obj.amount)+'</td><td></td></tr>');
                        }
                        
                    }
                }


                if(response.installment_panel && response.installment_panel.length > 10)
                {

                    var installment_panel = JSON.parse(response.installment_panel); 
                    $('#installmentPaneldetail tbody').empty();
                    for(var i = 0; i < installment_panel.length; i++) 
                    {
                        var obj = installment_panel[i];
                        // var curr_amount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(obj.amount);
                        // var conv_amount = obj.amount.toFixed(2);
                        // var str_amount = conv_amount.toString();
                        // var curr_amount = str_amount.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        var currdate = obj.installment_date;
                            var convdate = currdate.split("-").reverse().join("/");
                            console.log('conv date ' + convdate)
                            var strdate = convdate.toString();
                        $('#installmentPaneldetail tbody').append('<tr id="iidinstallmentdetail'+obj.id+'" data-name="installmentdetailvalue[]"><td data-name="'+obj.installment_date+'">'+strdate+'</td><td data-name="'+obj.percentage+'">'+floatToString(obj.percentage)+'%</td><td data-name="'+amountToString(obj.amount)+'" class="uangdata">'+amountToString(obj.amount)+'</td><td></td></tr>')

                    }
                }



                if(response.retrocession_panel && response.retrocession_panel.length > 10)
                {

                    var retrocession_panel = JSON.parse(response.retrocession_panel); 
                    $('#retrocessionPaneldetail tbody').empty();
                    var totalPercent = 0;
                    for(var i = 0; i < retrocession_panel.length; i++) 
                    {
                        var obj = retrocession_panel[i];

                        if(obj.amount)
                        {
                            totalPercent += obj.percentage;

                            // var curr_amount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(obj.amount);
                            //$('#interestInsuredTabledetail tbody').append('');
                            
                            
                            $('#retrocessionPaneldetail tbody').append('<tr id="iidretrocessiondetail'+obj.id+'" data-name="retrocessiondetailvalue[]"><td data-name="'+obj.contract+'">'+obj.contract+'</td><td data-name="'+obj.percentage+'">'+floatToString(obj.percentage)+'%</td><td data-name="'+amountToString(obj.amount)+'">'+amountToString(obj.amount)+'</td><td></td></tr>');
                        }
                    }
                    console.log("total percent retro" + parseFloat(totalPercent))
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
                    $("#slipcedingbrokerdetail").val(response.source).trigger('change');
                    // $("#slipcedingbrokerdetail option").attr('hidden',true);
                    // $("#slipcedingbrokerdetail option[value=" + response.source + "]:first")[0].hidden = false;
                    // $("#slipcedingbrokerdetail option[value=" + response.source + "]:first")[0].selected = true;
                    // $("#slipcedingbrokerdetail").trigger('change');
                }
                if(response.source_2)
                {
                    $("#slipcedingdetail").val(response.source_2).trigger('change');
                    // $("#slipcedingdetail option").attr('hidden',true);

                    // $("#slipcedingdetail option[value=" + response.source_2 + "]:first")[0].hidden = false;
                    // $("#slipcedingdetail option[value=" + response.source_2 + "]:first")[0].selected = true;
                }

                if(response.currency)
                {
                    $("#slipcurrencydetail option[value=" + response.currency + "]:first")[0].selected = true;
                }
                
                if(response.cob)
                {
                    if($("#slipcobdetail option[value=" + response.cob + "]:first")[0])
                    {
                     $("#slipcobdetail option[value=" + response.cob + "]:first")[0].selected = true;
                    }
                }

                if(response.koc)
                {
                    $("#slipkocdetail option[value=" + response.koc + "]:first")[0].selected = true;
                }

                if(response.occupacy)
                {
                    $("#slipoccupacydetail option[value=" + response.occupacy + "]:first")[0].selected = true;
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
                    if($("#sliptypedetail option[value=" + response.insured_type + "]:first")[0])
                    {
                     $("#sliptypedetail option[value=" + response.insured_type + "]:first")[0].selected = true;
                    }
                }

                if(response.layer_non_proportional)
                {
                    if($("#sliplayerproportionaldetail option[value=" + response.layer_non_proportional + "]:first")[0])
                    {
                      $("#sliplayerproportionaldetail option[value=" + response.layer_non_proportional + "]:first")[0].selected = true;
                    }
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
                    $("#sliptypetsidetail option[value=" + response.type_tsi + "]:first")[0].selected = true;
                }

                if(response.type_share_tsi)
                {
                    $("#sharetypetsidetail option[value=" + response.type_share_tsi + "]:first")[0].selected = true;
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
                var conv_tsi = floatToString(response.total_sum_insured);
                $('#sliptotalsumdetail').val(conv_tsi);
            }
            else
            {
                $('#sliptotalsumdetail').val("0");
            }

            if(response.share_tsi){
                var conv_stsi = amountToString(response.share_tsi);
                $('#sharetotalsumdetail').val(conv_stsi);
            }
            else
            {
                $('#sharetotalsumdetail').val("0");
            }

            if(response.insured_pct){
                $('#slippctdetail').val(floatToString(response.insured_pct));
            }else{
                $('#slippctdetail').val("0");
            }
            


            if(response.total_sum_pct){
                var conv_spct = floatToString(response.total_sum_pct);
                $('#sliptotalsumpctdetail').val(conv_spct);
            }
            else{
                $('#sliptotalsumpctdetail').val("0");
            }

            if(response.date_transfer == null || response.date_transfer == "" ){
               $('#sliptddetail').val(''); 
           }else{
                $('#sliptddetail').val(response.date_transfer); 
           }
            
            $('#slipipfromdetail').val(response.insurance_period_from);
            $('#slipiptodetail').val(response.insurance_period_to);

            var insurance_period_from2 = response.insurance_period_from.split("/").reverse().join("-");
            var insurance_period_to2 = response.insurance_period_to.split("/").reverse().join("-");
            var days=daysBetween(insurance_period_from2, insurance_period_to2);
            
            var sum = isNaN(days / 365) ? 0 :(days / 365).toFixed(9);
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
        
            $('#sliptotalsumdatedetail').val(floatToString(sum));


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
                    $('#slipratedetail').val(floatToString(response.rate));
                }else{
                    $('#slipratedetail').val("0");
                }
                
                if(response.share){
                    $('#slipsharedetail').val(floatToString(response.share));
                }else{
                    $('#slipsharedetail').val("0");
                }
                

                if(response.sum_share){
                    var conv_sshare = floatToString(response.sum_share);
                    $('#slipsumsharedetail').val(conv_sshare);
                    $('#slipsumsharedetail2').val(conv_sshare);
                }
                else{
                    $('#slipsumsharedetail').val("0");
                    $('#slipsumsharedetail2').val("0");
                }

                if(response.sum_rate){
                    var conv_srate = floatToString(response.sum_rate);
                    $('#sliptotalratedetail').val(conv_srate);
                    $('#sliptotalratedetail2').val(conv_srate);
                }
                else{
                    $('#sliptotalratedetail').val("0");
                    $('#sliptotalratedetail2').val("0");
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
                    var conv_bp =  amountToString(response.basic_premium);
                    $('#slipbasicpremiumdetail').val(conv_bp);
                }else
                {
                    $('#slipbasicpremiumdetail').val("0");
                }
                
                if(response.grossprm_to_nr){
                    var conv_gprtnr = amountToString(response.grossprm_to_nr)
                    $('#slipgrossprmtonrdetail').val(conv_gprtnr);
                    $('#slipgrossprmtonrdetail2').val(conv_gprtnr);
                
                }
                else{
                    $('#slipgrossprmtonrdetail').val("0");
                    $('#slipgrossprmtonrdetail2').val("0");
                }

                if(response.commission){

                    $('#slipcommissiondetail').val(floatToString(response.commission));
                }
                else{
                    $('#slipcommissiondetail').val(0);
                }
                

                if(response.sum_commission){
                    var conv_sc = floatToString(response.sum_commission)
                    $('#slipsumcommissiondetail').val(conv_sc);
                    $('#slipsumcommissiondetail2').val(conv_sc);
                
                }
                else{
                    $('#slipsumcommissiondetail').val("0");
                    $('#slipsumcommissiondetail2').val("0");

                }

                if(response.netprm_to_nr){
                    var conv_nprmtnr = amountToString(response.netprm_to_nr)
                    $('#slipnetprmtonrdetail').val(conv_nprmtnr);
                    $('#slipnetprmtonrdetail2').val(conv_nprmtnr); 
                }
                else{
                    $('#slipnetprmtonrdetail').val("0"); 
                    $('#slipnetprmtonrdetail2').val("0"); 
                }

                if(response.own_retention){
                    $('#slipordetail').val(floatToString(response.own_retention));
                }
                else{
                    $('#slipordetail').val(0);
                }

                if(response.sum_own_retention){
                    var conv_sor = floatToString(response.sum_own_retention);
                    $('#slipsumordetail').val(conv_sor);
                }
                else{
                    $('#slipsumordetail').val("0");
                }

                $('#countendorsmentdetail').val(response.endorsment);
                $('#countendorsmentdetail2').val(response.endorsment);
                $('#remarksdetail').val(response.remarks);
                
                
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
    // End Handler for change btn update
    //triggered when modal is about to be shown
    $('#updatemodaldata').on('show.bs.modal', function(e) {
        // $("#tabretroupdate").attr('hidden','true');
         //get data-id attribute of the clicked element
         var codesl = $(e.relatedTarget).data('book-id');
         var sliptype = $('#sliptypeform').val();
        // alert(codesl);
        // $('input .amount').val(function(event) {
        //     // skip for arrow keys
        //     if(event.which >= 37 && event.which <= 40) return;
        //     console.log(event.which)
        //     console.log($(this).val())
        //         // format number
        //         $(this).val(function(index, value) {
        //             return value.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        //         });
        //     });
        
        $.ajax({
            url:'{{ url("/") }}/transaction-data/'+sliptype+'/detail-slip/'+codesl,
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
                
                $('#sliptotalnilaiecupdate').val(response.sum_ec);

                $('#sliptotalpercentinspanupdate').val(response.sum_ippercent);



                    if(response.deductible_panel && response.deductible_panel.length > 10)
                    {

                        var deductibledata = JSON.parse(response.deductible_panel); 

                        $('#deductiblePanelupdate tbody').empty();
                        for(var i = 0; i < deductibledata.length; i++) 
                        {
                            var obj = deductibledata[i];
                            if(obj)
                            {

                                //console.log(obj.id);
                                //$('#interestInsuredTabledetail tbody').append('');
                                // var curr_amount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(obj.amount);

                                
                                $('#deductiblePanelupdate tbody').append('<tr id="iiddeductibleupdate'+obj.id+'" data-name="deductibleupdatevalue[]"><td data-name="'+obj.deductibletype+'">'+obj.deductibletype+'</td><td data-name="'+obj.percentage+'">'+floatToString(obj.percentage)+'%</td><td data-name="'+floatToString(obj.amount)+'">'+floatToString(obj.amount)+'</td><td data-name="'+floatToString(obj.min_claimamount)+'">'+floatToString(obj.min_claimamount)+'</td><td><a href="javascript:void(0)" onclick="deletedeductibleupdate('+obj.id+')">delete</a></td></tr>');
                                
                            }
                        }
                    }


                    if(response.extend_coverage && response.extend_coverage.length > 10) 
                    {

                        var extend_coverage = JSON.parse(response.extend_coverage); 

                        $('#ExtendCoveragePanelupdate tbody').empty();
                        for(var i = 0; i < extend_coverage.length; i++) 
                        {
                            var obj = extend_coverage[i];

                            if(obj)
                            {
                            // var curr_amount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(obj.amount);
                                //console.log(obj.id);
                                //$('#interestInsuredTabledetail tbody').append('');
                                
                                $('#ExtendCoveragePanelupdate tbody').append('<tr id="iidextendcoverageupdate'+obj.id+'" data-name="extendcoverageupdatevalue[]"><td data-name="'+obj.coveragetype+'">'+obj.coveragecode + ' - ' + obj.coveragename+'</td><td data-name="'+obj.percentage+'">'+floatToString(obj.percentage)+'</td><td data-name="'+amountToString(obj.amount)+'" class="uangdata">'+amountToString(obj.amount)+'</td><td><a href="javascript:void(0)" onclick="deleteextendcoverageupdate('+obj.id+')">delete</a></td></tr>');
                            
                            }
                        }
                    }


                    if(response.installment_panel && response.installment_panel.length > 10)
                    {

                        var installment_panel = JSON.parse(response.installment_panel); 

                        //var installment_panel = JSON.parse(response.installment_panel); 
                        var totalPercent = 0;
                        $('#installmentPanelupdate tbody').empty();
                        for(var i = 0; i < installment_panel.length; i++) 
                        {
                            var obj = installment_panel[i];
                            totalPercent += parseFloat(obj.percentage);
                            // var curr_amount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(obj.amount);
                            // var conv_amount = obj.amount.toFixed(2);
                            // var str_amount = conv_amount.toString();
                            // var curr_amount = str_amount.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            
                            


                            var currdate = obj.installment_date;
                            var convdate = currdate.split("-").reverse().join("/");
                            console.log('conv date ' + convdate)
                            var strdate = convdate.toString();

                            
                            //console.log(obj.id);
                            //$('#interestInsuredTabledetail tbody').append('');
                            
                            $('#installmentPanelupdate tbody').append('<tr id="iidinstallmentupdate'+obj.id+'" data-name="installmentupdatevalue[]"><td data-name="'+obj.installment_date+'">'+strdate+'</td><td data-name="'+obj.percentage+'">'+floatToString(obj.percentage)+'%</td><td data-name="'+amountToString(obj.amount)+'" class="uangdata">'+amountToString(obj.amount)+'</td><td><a href="javascript:void(0)" onclick="deleteinstallmentupdate('+obj.id+')">delete</a></td></tr>')

                        }
                        if(totalPercent >= 100){
                            $('#addinstallmentinsuredupdate-btn').attr('hidden',true);
                        }
                    }



                    if(response.retrocession_panel && response.retrocession_panel.length > 10)
                    {

                        var retrocession_panel = JSON.parse(response.retrocession_panel); 

                        $('#retrocessionPanelupdate tbody').empty();
                        for(var i = 0; i < retrocession_panel.length; i++) 
                        {
                            var obj = retrocession_panel[i];
                            var totalPercent =0;
                            if(obj.amount)
                            {
                            // var curr_amount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(obj.amount);
                            
                                //var conv_amount = obj.amount.toFixed(2);
                                
                                //console.log(obj.id);
                                //$('#interestInsuredTabledetail tbody').append('');
                                
                                totalPercent += parseFloat(obj.percentage);
                                $('#retrocessionPanelupdate tbody').append('<tr id="iidretrocessionupdate'+obj.id+'" data-name="retrocessionupdatevalue[]"><td data-name="'+obj.contract+'">'+obj.contract+'</td><td data-name="'+obj.percentage+'">'+floatToString(obj.percentage)+'%</td><td data-name="'+amountToString(obj.amount)+'">'+amountToString(obj.amount)+'</td><td><a href="javascript:void(0)" onclick="deleteretrocessionupdate('+obj.id+')">delete</a></td></tr>');
                                
                            }
                            if(totalPercent >= 100){
                            $('#addinstallmentinsuredupdate-btn').attr('hidden',true);
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
                    // $("#slipcedingbrokerupdate option[value=" + response.source + "]:first")[0].selected = true;
                    $("#slipcedingbrokerupdate").val(response.source);
                }

                if(response.source_2)
                {
                    // $("#slipcedingbrokerupdate option[value=" + response.source + "]:first")[0].selected = true;
                    $("#slipcedingupdate").val(response.source_2)

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
                    $("#slipkocupdate option[value=" + response.koc + "]:first")[0].selected = true;
                }

                if(response.occupacy)
                {
                    $("#slipoccupacyupdate option[value=" + response.occupacy + "]:first")[0].selected = true;
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
                    $("#sliptypetsiupdate option[value=" + response.type_tsi + "]:first")[0].selected = true;
                }

                if(response.type_share_tsi)
                {
                    $("#sharetypetsiupdate option[value=" + response.type_share_tsi + "]:first")[0].selected = true;
                }

                if(response.insured_type)
                {
                    $("#sliptypeupdate option[value=" + response.insured_type + "]:first")[0].selected = true;
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
                    var conv_tsi = floatToString(response.total_sum_insured);
                    $('#sliptotalsumupdate').val(conv_tsi);
                    $('#sliptotalsumupdate2').val(conv_tsi);
                }else{
                    $('#sliptotalsumupdate').val(0);
                    $('#sliptotalsumupdate2').val(0);
                }

                if(response.share_tsi){
                    var conv_stsi = floatToString(response.share_tsi);
                    $('#sharetotalsumupdate').val(conv_stsi);
                    $('#sharetotalsumupdate2').val(conv_stsi);
                }
                else
                {
                    $('#sharetotalsumupdate').val("0");
                    $('#sharetotalsumupdate2').val("0");
                }
                
                $('#sliptdupdate').val(response.date_transfer);
                $('#sliptdupdate2').val(response.date_transfer);

                if(response.insured_pct){
                    $('#slippctupdate').val( floatToString(response.insured_pct));
                }else{
                    $('#slippctupdate').val("0");
                }   
                

                if(response.total_sum_pct)
                {
                    var conv_tsp = floatToString(response.total_sum_pct);
                    $('#sliptotalsumpctupdate').val(conv_tsp);
                    $('#sliptotalsumpctupdate2').val(conv_tsp);
                }else{
                    $('#sliptotalsumpctupdate').val(0);
                    $('#sliptotalsumpctupdate2').val(0);
                }
                


                $('#slipipfromupdate').val(response.insurance_period_from);
                $('#slipiptoupdate').val(response.insurance_period_to);

                var insurance_period_from2 = response.insurance_period_from.split("/").reverse().join("-");
                var insurance_period_to2 = response.insurance_period_to.split("/").reverse().join("-");
                var days=daysBetween(insurance_period_from2, insurance_period_to2);
                var sum = isNaN(days / 365) ? 0 :(days / 365).toFixed(9);
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


                $('#sliptotalsumdateupdate').val(floatToString(sum));
                $('#sliptotalsumdateupdate2').val(floatToString(sum));

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
                        var conv_sshare = floatToString(response.sum_share);
                        $('#slipsumshareupdate').val(conv_sshare);
                        $('#slipsumshareupdate2').val(conv_sshare);
                        $('#slipoldsumshareupdate2').val(conv_sshare);
                        $('#slipoldsumshareupdate').val(conv_sshare);
                    }else{
                        $('#slipsumshareupdate').val(0);
                        $('#slipsumshareupdate2').val(0);
                        $('#slipoldsumshareupdate2').val(0);
                        $('#slipoldsumshareupdate').val(0);
                    }
                    
                    if(response.basic_premium){
                        var conv_bp = amountToString(response.basic_premium);
                        $('#slipbasicpremiumupdate').val(conv_bp);
                    }else{
                        $('#slipbasicpremiumupdate').val("0");
                    }
                    
                    
                    if(response.grossprm_to_nr){
                        var gprmtnr = amountToString(response.grossprm_to_nr)
                        $('#slipgrossprmtonrupdate').val(gprmtnr);
                        $('#slipgrossprmtonrupdate2').val(gprmtnr);
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
                        var conv_sc = floatToString(response.sum_commission)
                        $('#slipsumcommissionupdate').val(conv_sc);
                        $('#slipsumcommissionupdate2').val(conv_sc);
                    }else{
                        $('#slipsumcommissionupdate').val(0);
                        $('#slipsumcommissionupdate2').val(0);                        
                    }

                    if(response.netprm_to_nr){
                        var conv_nprtnr = amountToString(response.netprm_to_nr)
                        $('#slipnetprmtonrupdate').val(conv_nprtnr);
                        $('#slipnetprmtonrupdate2').val(conv_nprtnr);
                    }else{
                        $('#slipnetprmtonrupdate').val(0);
                        $('#slipnetprmtonrupdate2').val(0);
                    }
                    
                    if(response.sum_rate){
                        var conv_srate = floatToString(response.sum_rate)
                        $('#sliptotalrateupdate').val(conv_srate);
                        $('#sliptotalrateupdate2').val(conv_srate);
                    }
                    else{
                        $('#sliptotalrateupdate').val("0");
                        $('#sliptotalrateupdate2').val("0");

                    }

                    if(response.sum_v_broker){
                        var conv_sfee = floatToString(response.sum_v_broker)
                        $('#slipsumfeeupdate').val(conv_sfee);
                        $('#slipsumfeeupdate2').val(conv_sfee);
                    }
                    else{
                        $('#slipsumfeeupdate').val("0");
                        $('#slipsumfeeupdate2').val("0");

                    }

                    if(response.own_retention){
                        $('#sliporupdate').val(floatToString(response.own_retention));
                    }else{
                        $('#sliporupdate').val("0");
                    }
                    

                    if(response.sum_own_retention){
                        var conv_sor = floatToString(response.sum_own_retention)
                        $('#slipsumorupdate').val(conv_sor);
                        $('#slipsumorupdate2').val(conv_sor);
                    }else{
                        $('#slipsumorupdate').val(0);
                        $('#slipsumorupdate2').val(0);
                    }
                    
                    if(response.source_2)
                    {
                        // $("#slipcedingupdate option[value=" + response.source_2 + "]:first")[0].selected = true;
                        $("#slipcedingupdate").val(response.source_2).trigger('change')
                    }    
                    swal("Success!", "Data Show")
                    console.log(response)

                },
                error: function (request, status, error) {
                    //alert(request.responseText);
                    swal("Error!", "Get Slip Data Error", "Get Data Error");
                }
            });
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
</script>
<script type="text/javascript">

    //triggered when modal is about to be shown
    $('#endorsementmodaldata').on('show.bs.modal', function(e) {

         //get data-id attribute of the clicked element
         // $("#tabretroendorsement").attr('hidden','true');
         var codesl = $(e.relatedTarget).data('book-id');
         var sliptype = $('#sliptypeform').val();
        //alert(codesl);
        $.ajax({
            url:'{{ url("/") }}/transaction-data/'+sliptype+'/detail-endorsement/'+codesl,
            type:"GET",
            beforeSend: function() { $("body").addClass("loading");  },
            complete: function() {  $("body").removeClass("loading"); },
            success:function(response)
            {
                    //$('#slipnumberendorsement').val(response.number);
                    $('#insuredIDtxtendorsement').val(response.insured_id);
                    $('#slipidendorsement').val(response.id);
                    $('#slipnumberendorsement').val(response.number);
                    
                    console.log("id endorsement form" + response.id)

                    $('#codeslreal').val(response.code_slreal);

                    $('#slipusernameendorsement').val(response.username);
                    $('#slipprodyearendorsement').val(response.prod_year);
                    $('#slipprodyearendorsement2').val(response.prod_year);
                    // $('#slipuyendorsement').val(response.uy);
                    $('#slipedendorsement').val(response.endorsment);
                    $('#slipslsendorsement').val(response.selisih);
                    $('#sliptdendorsement2').val(response.date_transfer);

                    $('#wpcendorsement').val(response.wpc);
                    
                    // $('#sliptotalnilaiecendorsement').val(response.sum_ec);
                    // $('#sliptotalpercentinspanendorsement').val(response.sum_ippercent);


                    if(response.deductible_panel && response.deductible_panel.length > 10)
                    {

                        var deductibledata = JSON.parse(response.deductible_panel); 

                        // $('#deductiblePanelendorsement tbody').empty();
                        // for(var i = 0; i < deductibledata.length; i++) 
                        // {
                        //     var obj = deductibledata[i];

                        //     if(obj)
                        //     {
                        //         // var curr_amount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(obj.amount);
                                
                        //         //console.log(obj.id);
                        //         //$('#interestInsuredTabledetail tbody').append('');
                                
                        //         $('#deductiblePanelendorsement tbody').append('<tr id="iiddeductibleendorsement'+obj.id+'" data-name="deductibleendorsementvalue[]"><td data-name="'+obj.deductibletype+'">'+obj.deductibletype+'</td><td data-name="'+obj.percentage+'">'+floatToString(obj.percentage)+'%</td><td data-name="'+amountToString(obj.amount)+'">'+amountToString(obj.amount)+'</td><td data-name="'+amountToString(obj.min_claimamount)+'">'+amountToString(obj.min_claimamount)+'</td><td><a href="javascript:void(0)" onclick="deletedeductibleendorsement('+obj.id+')">delete</a></td></tr>');
                        //     }
                            
                        // }
                    }


                    if(response.extend_coverage && response.extend_coverage.length > 10)
                    {

                        // var extend_coverage = JSON.parse(response.extend_coverage); 

                        // $('#ExtendCoveragePanelendorsement tbody').empty();
                        // for(var i = 0; i < extend_coverage.length; i++) 
                        // {
                        //     var obj = extend_coverage[i];
                        //     // var curr_amount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(obj.amount);
                            
                        //     //var conv_amount = obj.amount.toFixed(2);
                        //     //console.log(obj.id);
                        //     //$('#interestInsuredTabledetail tbody').append('');
                            
                        //     $('#ExtendCoveragePanelendorsement tbody').append('<tr id="iidextendcoverageendorsement'+obj.id+'" data-name="extendcoverageendorsementvalue[]"><td data-name="'+obj.coveragetype+'">'+obj.coveragecode + ' - ' + obj.coveragename+'</td><td data-name="'+obj.percentage+'">'+floatToString(obj.percentage)+'</td><td data-name="'+amountToString(obj.amount)+'">'+amountToString(obj.amount)+'</td><td><a href="javascript:void(0)" onclick="deleteextendcoverageendorsement('+obj.id+')">delete</a></td></tr>');
                            
                        // }
                    }


                    if(response.installment_panel && response.installment_panel.length > 10)
                    {
                        
                        // var installment_panel = JSON.parse(response.installment_panel); 

                        // $('#installmentPanelendorsement tbody').empty();
                        // for(var i = 0; i < installment_panel.length; i++) 
                        // {
                        //     var obj = installment_panel[i];
                        //     // var curr_amount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(obj.amount);
                        //     // var conv_amount = obj.amount.toFixed(2);
                        //     // var str_amount = conv_amount.toString();
                        //     // var curr_amount = str_amount.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        //     //var conv_amount = parseFloat(obj.amount).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            

                        //    var currdate = obj.installment_date;
                        //     var convdate = currdate.split("-").reverse().join("/");
                        //     console.log('conv date ' + convdate)
                        //     var strdate = convdate.toString();

                        //     var conv_percent = parseFloat(obj.percentage).toString();

                        //     //console.log(obj.id);
                        //     //$('#interestInsuredTabledetail tbody').append('');
                            
                        //     $('#installmentPanelendorsement tbody').append('<tr id="iidinstallmentendorsement'+obj.id+'" data-name="installmentendorsementvalue[]"><td data-name="'+obj.installment_date+'">'+strdate+'</td><td data-name="'+obj.percentage+'">'+floatToString(obj.percentage)+'%</td><td data-name="'+amountToString(obj.amount)+'">'+amountToString(obj.amount)+'</td><td><a href="javascript:void(0)" onclick="deleteinstallmentendorsement('+obj.id+')">delete</a></td></tr>')

                        // }
                    }



                    if(response.retrocession_panel && response.retrocession_panel.length > 10)
                    {

                        // var retrocession_panel = JSON.parse(response.retrocession_panel); 

                        // $('#retrocessionPanelendorsement tbody').empty();
                        // for(var i = 0; i < retrocession_panel.length; i++) 
                        // {
                        //     var obj = retrocession_panel[i];
                            
                        //     if(obj.amount)
                        //     {
                        //         // var curr_amount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(obj.amount);
                        //         //var conv_amount = obj.amount.toFixed(2);

                        //     //console.log(obj.id);
                        //     //$('#interestInsuredTabledetail tbody').append('');
                            
                            
                        //     $('#retrocessionPanelendorsement tbody').append('<tr id="iidretrocessionendorsement'+obj.id+'" data-name="retrocessionendorsementvalue[]"><td data-name="'+obj.contract+'">'+obj.contract+'</td><td data-name="'+obj.percentage+'">'+floatToString(obj.percentage)+'%</td><td data-name="'+amountToString(obj.amount)+'">'+amountToString(obj.amount)+'</td><td><a href="javascript:void(0)" onclick="deleteretrocessionendorsement('+obj.id+')">delete</a></td></tr>');
                            
                        //     }
                        // }
                    }
                    
                    
                if(response.status)
                {
                    //$("#slipstatusendorsement option[value=" + response.status + "]:first").selected = true;
                    $("#slipstatusendorsement").val(response.status);
                }

                if(response.source)
                {
                    $('#slipcedingbrokerendorsement').val(response.source).trigger('change');
                    // $("#slipcedingbrokerendorsement option[value=" + response.source + "]:first").selected = true;
                }

                if(response.source_2)
                {
                    $('#slipcedingendorsement').val(response.source_2).trigger('change');
                    // $("#slipcedingendorsement option[value=" + response.source_2 + "]:first").selected = true;
                }

                if(response.currency)
                {
                    $("#slipcurrencyendorsement option[value=" + response.currency + "]:first").selected = true;
                }

                if(response.cob)
                {
                    $("#slipcobendorsement option[value=" + response.cob + "]:first").selected = true;
                }

                if(response.koc)
                {
                    $("#slipkocendorsement option[value=" + response.koc + "]:first").selected = true;
                }

                if(response.occupacy)
                {
                    $("#slipoccupacyendorsement option[value=" + response.occupacy + "]:first").selected = true;
                }

                if(response.build_const)
                {
                 $("#slipbld_constendorsement option[value='" + response.build_const + "']:first")[0].selected = true;
                 $("#slipbcuaendorsement").val(response.build_rate_up);
                 $("#slipbclaendorsement").val(response.build_rate_down);
             }

            if(response.insured_type)
            {
                $("#sliptypeendorsement option[value=" + response.insured_type + "]:first").selected = true;
            }

            if(response.type_tsi)
            {
                $("#sliptypetsiendorsement option[value=" + response.type_tsi + "]:first").selected = true;
            }

            if(response.type_share_tsi)
            {
                $("#sharetypetsiendorsement").val(response.type_share_tsi);
            }
            if(response.type_share_tsi)
            {
                $("#slipoccupacyendorsement").val(response.occupacy);
            }

            if(response.layer_non_proportional)
            {
                // $("#sliplayerproportionalendorsement option[value=" + response.layer_non_proportional + "]:first").selected = true;
            }

            if(response.retro_backup)
            {
                $("#sliprbendorsement option[value=" + response.retro_backup + "]:first").selected = true;
                
                if(response.retro_backup == "NO")
                {
                    $("#tabretroendorsement").attr('hidden');
                }
                else if(response.retro_backup == "YES"){
                    $("#tabretroendorsement").removeAttr('hidden');
                }
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
                var conv_tsi = floatToString(response.total_sum_insured);
                $('#sliptotalsumendorsement').val(conv_tsi);
                $('#sliptotalsumendorsement2').val(conv_tsi);
            }else{
                $('#sliptotalsumendorsement').val("0");
                $('#sliptotalsumendorsement2').val("0");
            }

            if(response.share_tsi){
                var conv_stsi = floatToString(response.share_tsi);
                $('#sharetotalsumendorsement').val(conv_stsi);
                $('#sharetotalsumendorsement2').val(conv_stsi);
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
                var conv_spct = floatToString(response.total_sum_pct);
                $('#sliptotalsumpctendorsement').val(conv_spct);
            }else{
                $('#sliptotalsumpctendorsement').val("0");
            }

            $('#sliptdendorsement').val(response.date_transfer);
            
            $('#slipipfromendorsement').val(response.insurance_period_from);
            $('#slipiptoendorsement').val(response.insurance_period_to);

            var insurance_period_from2 = response.insurance_period_from.split("/").reverse().join("-");
            var insurance_period_to2 = response.insurance_period_to.split("/").reverse().join("-");
            var days=daysBetween(insurance_period_from2, insurance_period_to2);
            var sum = isNaN(days / 365) ? 0 :(days / 365).toFixed(9);
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

                    if(response.own_retention){
                       $('#sliporendorsement').val(floatToString(response.own_retention));
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
                        var conv_sshare = floatToString(response.sum_share);
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
                        var conv_scomm = floatToString(response.sum_commission);
                        $('#slipsumcommissionendorsement').val(conv_scomm);
                        $('#slipsumcommissionendorsement2').val(conv_scomm);
                    }else{
                        $('#slipsumcommissionendorsement').val("0");
                        $('#slipsumcommissionendorsement2').val("0");
                    }

                    if(response.sum_own_retention){
                        var conv_sor = floatToString(response.sum_own_retention);
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
                $('#slipnumbercancel').val(response.number);
                console.log("number "+response.number);
                // $('#remarkscancel').val(response.remarks);
                $('#countendorsementcancel').val(response.endorsment);
                $('#usernamecancel').val(response.username);
                console.log("endorsment "+response.endorsment);
                console.log("username "+response.username);
     
                swal("Success!", "Data Show")
                console.log(response)

            },
            error: function (request, status, error) {
                //alert(request.responseText);
                swal("Error!", "Get Slip Data Error", "Get Data Error");
            }
        });
    });
    // Change status slip
    $(document).on('click','#btnSlip', function(e) {
        var codesl = $(this).data('id');
        var code = $('#insuredIDtxt').val();
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
    $(document).on('click','#btnTransferDate', function(e) {
        var codesl = $(this).data('id');
        var code = $('#insuredIDtxt').val();
        $.ajax({
            url:'{{ url("/") }}/transaction-data/changetfdate/'+codesl,
            type:"GET",
            beforeSend: function() { $("body").addClass("loading");  },
            complete: function() {  $("body").removeClass("loading"); },
            success:function(response)
            {
                if (response.success) {
                    toastr.success(response.message)
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
            
            
            
           
        
    });
</script>
{{-- modal form end --}}
<!-- Function -->
<script type="text/javascript">
    function calculateBasicPremium(status){
        if(status == 'update'){
            var sliptotalsumdate = $('#sliptotalsumdateupdate').val(); // days
            var tsi = parseFloat($('#sharetotalsumupdate').val().replace(/,/g, ""));
            var basic = parseFloat($('#slipbasicpremiumupdate').val());
            var sliptotalrate  = parseFloat($('#sliptotalrateupdate').val());
        }else if (status == 'endorsement') {
            var sliptotalsumdate = $('#sliptotalsumdateendorsement').val(); // days
            var tsi = parseFloat($('#sharetotalsumendorsement').val().replace(/,/g, ""));
            var basic = parseFloat($('#slipbasicpremiumendorsement').val());
            var sliptotalrate  = parseFloat($('#sliptotalrateendorsement').val());
        }else{
            var sliptotalsumdate = $('#sliptotalsumdate').val(); // days
            var tsi = parseFloat($('#sharetotalsum').val().replace(/,/g, ""));
            var basic = parseFloat($('#slipbasicpremium').val());
            var sliptotalrate  = parseFloat($('#sliptotalrate').val());
        }
        
        var proses_basic_premium = (((tsi * sliptotalrate ) / 1000)*  sliptotalsumdate);
        var basic_premium = isNaN(proses_basic_premium) ? 0 : (proses_basic_premium);
        console.log('(tsi * sliptotalrate ) ' + (tsi * sliptotalrate ));
        console.log('((tsi * sliptotalrate ) / 1000) ' + ((tsi * sliptotalrate ) / 1000));
        console.log('(((tsi * sliptotalrate ) / 1000)*  sliptotalsumdate) ' + (((tsi * sliptotalrate ) / 1000)*  sliptotalsumdate));


        if(status == 'update'){
            $('#slipbasicpremiumupdate').val(parseFloat(basic_premium).toFixed(2));    
        }else if (status == 'endorsement') {
            $('#slipbasicpremiumendorsement').val(parseFloat(basic_premium).toFixed(2));    
        }else{
            $('#slipbasicpremium').val(parseFloat(basic_premium).toFixed(2));    
        }
        calculateGrossPrm(status)
        
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
        var proses = parseFloat(sliprate + totalrateexc).toFixed(5).toString();
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
        calculateBasicPremium(status)
        calculateGrossPrm(status)

    }
    function calculateTotalRateByPremium(status){
        if(status == 'update'){
            var basic_premium = parseFloat($('#slipbasicpremiumupdate').val());
            var sliprate = parseFloat($('#sliprateupdate').val());
            var tsi = parseFloat($('#sharetotalsumupdate').val().replace(/,/g, ""));
            var sliptotalsumdate = $('#sliptotalsumdateupdate').val(); // days
            var sliptotalrate   = parseFloat($('#sliptotalrateupdate').val());
            var totalrateexc = parseFloat($('#sliptotalnilaiecupdate').val());
        }else if (status == 'endorsement') {
            var basic_premium = parseFloat($('#slipbasicpremiumendorsement').val());
            var sliprate = parseFloat($('#sliprateendorsement').val());
            var tsi = parseFloat($('#sharetotalsumendorsement').val().replace(/,/g, ""));
            var sliptotalsumdate = $('#sliptotalsumdateendorsement').val(); // days
            var sliptotalrate   = parseFloat($('#sliptotalrateendorsement').val());
            var totalrateexc = parseFloat($('#sliptotalnilaiecendorsement').val());
        }else{
            var basic_premium = parseFloat($('#slipbasicpremium').val());
            var sliprate = parseFloat($('#sliprate').val());
            var tsi = parseFloat($('#sharetotalsum').val().replace(/,/g, ""));
            var sliptotalsumdate = $('#sliptotalsumdate').val(); // days
            var sliptotalrate   = parseFloat($('#sliptotalrate').val());
            var totalrateexc = parseFloat($('#sliptotalnilaiec').val());
        }
        var sumtotalrate = 0;
        var date = isNaN(sliptotalsumdate) ? 0 : (sliptotalsumdate);
        if (date == 0) {
            swal('Warning','Wrong format date, check again date','warning');
        }
        var proses_totalrate = parseFloat(((basic_premium * 1000) / tsi) / date).toFixed(5);
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
        console.log('(basic_premium * 1000) = ' + (basic_premium * 1000))
        console.log('((basic_premium * 1000) / tsi) = ' + ((basic_premium * 1000) / tsi))
        console.log('((basic_premium * 1000) / tsi) / date = ' + ((basic_premium * 1000) / tsi) / date)
        console.log('proses_totalrate' + proses_totalrate)
        calculateRate(status)

    }
    function calculateRate(status){
        
        if (status == 'update') {
            var totalrateexc =  parseFloat($('#sliptotalnilaiecupdate').val());
            var sliptotalrate   = parseFloat($('#sliptotalrateupdate').val());
        }else if (status == 'endorsement') {
            var totalrateexc =  parseFloat($('#sliptotalnilaiecendorsement').val());
            var sliptotalrate   = parseFloat($('#sliptotalrateendorsement').val());
        }else{
            var totalrateexc =  parseFloat($('#sliptotalnilaiec').val());
            var sliptotalrate   = parseFloat($('#sliptotalrate').val());
        }
        var proses_rate = parseFloat(sliptotalrate - (isNaN(totalrateexc) ? 0 : (totalrateexc))).toFixed(4); 
        
        var rate = isNaN(proses_rate) ? 0 : (proses_rate);
        console.log('proses_rate' + proses_rate)
        console.log('sliptotalrate' + sliptotalrate)
        console.log('totalrateexc' + totalrateexc)
        console.log(rate)
        if (status == 'update') {
            $('#sliprateupdate').val(parseFloat(rate).toFixed(6));
        }else if (status == 'endorsement') {
            $('#sliprateendorsement').val(parseFloat(rate).toFixed(6));
        }else{
            $('#sliprate').val(parseFloat(rate).toFixed(6));    
        }
        calculateGrossPrm(status)
    }
    function calculateGrossPrm(status){
        if (status == 'update') {
            var basic_premium = parseFloat($('#slipbasicpremiumupdate').val().replace(/,/g, ""));
            var slipshare = parseFloat($('#slipshareupdate').val().replace(/,/g, ""));
        }else if (status == 'endorsement') {
            var basic_premium = parseFloat($('#slipbasicpremiumendorsement').val().replace(/,/g, ""));
            var slipshare = parseFloat($('#slipshareendorsement').val().replace(/,/g, ""));
        }else{
            var basic_premium = parseFloat($('#slipbasicpremium').val().replace(/,/g, ""));
            var slipshare = parseFloat($('#slipshare').val().replace(/,/g, ""));
        }
        var percent_slipshare = isNaN((slipshare/100)) ? 0 : ((slipshare/100));
        var proses_gross = parseFloat(basic_premium * percent_slipshare).toFixed(2);
        var gross = isNaN(proses_gross) ? 0 : (proses_gross);

        if (status == 'update') {
            $('#slipgrossprmtonrupdate').val(gross);
            $('#slipgrossprmtonrupdate2').val(gross);
        }else if (status == 'endorsement') {
            $('#slipgrossprmtonrendorsement').val(gross);
            $('#slipgrossprmtonrendorsement2').val(gross);
        }else{
            $('#slipgrossprmtonr').val(gross);
            $('#slipgrossprmtonr2').val(gross);
        }
        calculateNetPrm(status)
        calculateOwnRetention(status)
        
    }
    function calculateComm(status){
        if (status == 'update') {
            var slipcommission = parseFloat($('#slipcommissionupdate').val());
            var slipgrossprmtonr = parseFloat($('#slipgrossprmtonrupdate').val().replace(/,/g, ""));
        }else if(status == 'endorsement'){
            var slipcommission = parseFloat($('#slipcommissionendorsement').val());
            var slipgrossprmtonr = parseFloat($('#slipgrossprmtonrendorsement').val().replace(/,/g, ""));
        }else{
            var slipcommission = parseFloat($('#slipcommission').val());
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
            var slipsumfee = parseFloat($('#slipsumfeeupdate2').val());
            var slipgrossprmtonr = parseFloat($('#slipgrossprmtonrupdate').val().replace(/,/g, ""));
        }else if(status =='endorsement'){
            var slipsumfee = parseFloat($('#slipsumfeeendorsement2').val());
            var slipgrossprmtonr = parseFloat($('#slipgrossprmtonrendorsement').val().replace(/,/g, ""));    
        }else{
            var slipsumfee = parseFloat($('#slipsumfee2').val());
            var slipgrossprmtonr = parseFloat($('#slipgrossprmtonr').val().replace(/,/g, ""));    
        }
        


        var proses_percent = parseFloat(slipsumfee * 100 / slipgrossprmtonr).toFixed(5);
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
            var slipsumfee = parseFloat($('#slipsumfeeupdate').val());
            var slipsumcommission = parseFloat($('#slipsumcommissionupdate').val().replace(/,/g, ""));
        }else if(status == 'endorsement'){
            var slipgrossprmtonr = parseFloat($('#slipgrossprmtonrendorsement').val().replace(/,/g, ""));
            var slipsumfee = parseFloat($('#slipsumfeeendorsement').val());
            var slipsumcommission = parseFloat($('#slipsumcommissionendorsement').val().replace(/,/g, ""));
        }else{
            var slipgrossprmtonr = parseFloat($('#slipgrossprmtonr').val().replace(/,/g, ""));
            var slipsumfee = parseFloat($('#slipsumfee').val());
            var slipsumcommission = parseFloat($('#slipsumcommission').val().replace(/,/g, ""));
        }
                
        var a = isNaN(slipgrossprmtonr) ? 0 : (slipgrossprmtonr);
        var b = isNaN(slipsumcommission) ? 0 : (slipsumcommission);
        var c = isNaN(slipsumfee) ? 0 : (slipsumfee);
        var proses_net_prm = parseFloat(a - b - c).toFixed(2);
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
            var slipsumcommission = parseFloat($('#slipsumcommissionupdate').val());
            var slipgrossprmtonr = parseFloat($('#slipgrossprmtonrupdate').val().replace(/,/g, ""));
        }else if(status =='endorsement'){
            var slipsumcommission = parseFloat($('#slipsumcommissionendorsement').val());
            var slipgrossprmtonr = parseFloat($('#slipgrossprmtonrendorsement').val().replace(/,/g, ""));    
        }else{
            var slipsumcommission = parseFloat($('#slipsumcommission').val());
            var slipgrossprmtonr = parseFloat($('#slipgrossprmtonr').val().replace(/,/g, ""));    
        }
        

        var proses_percent = parseFloat(slipsumcommission * 100 / slipgrossprmtonr).toFixed(2);
        var percent = isNaN(proses_percent) ? 0 : (proses_percent);

        if (status == 'update') {
            $('#slipcommissionupdate').val(floatToString(percent));
        }else if(status =='endorsement'){
            $('#slipcommissionendorsement').val(floatToString(percent));
        }else{
            $('#slipcommission').val(floatToString(percent));
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
        calculateGrossPrm(status)
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
    function autoCalculateInstallment(status){
        var insured = $('#insuredIDtxt').val();
        var sliptype = $('#sliptypeform').val();;
        if (status == 'update') {
            var slipnetprmtonr = parseFloat($('#slipnetprmtonrupdate').val().replace(/,/g, ""));
            var slipnumber = $('#slipnumberupdate').val();
            var count_endorsement = $('#countendorsmentupdate').val();
            
        }else if(status == 'endorsement'){
            var slipnetprmtonr = parseFloat($('#slipnetprmtonrendorsement').val().replace(/,/g, ""));
            var slipnumber = $('#slipnumberendorsement').val();
            var count_endorsement = $('#countendorsmentdata').val();
        }else {
            var slipnetprmtonr = parseFloat($('#slipnetprmtonr').val().replace(/,/g, ""));
            var slipnumber = $('#slipnumber').val();
            var count_endorsement = 0;
        }

        $.ajax({
            url:'{{ url("/") }}/transaction-data/'+sliptype+'/auto-update-installment/',
            data:{
                insured:insured,
                slipnumber:slipnumber,
                sliptype:sliptype,
                count_endorsement:count_endorsement,
                slipnetprmtonr:slipnetprmtonr
            },
            type:"POST",
            beforeSend: function() { $("body").addClass("loading");  },
            complete: function() {  $("body").removeClass("loading"); },
            success:function(response)
            {
                
                 var installment_panel = JSON.parse(response.data); 
                    $('#installmentPanelupdate tbody').empty();
                    for(var i = 0; i < installment_panel.length; i++) 
                    {
                        var obj = installment_panel[i];
                        // var curr_amount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(obj.amount);
                        // var conv_amount = obj.amount.toFixed(2);
                        // var str_amount = conv_amount.toString();
                        // var curr_amount = str_amount.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        var currdate = obj.installment_date;
                            var convdate = currdate.split("-").reverse().join("/");
                            console.log('conv date ' + convdate)
                            var strdate = convdate.toString();
                        $('#installmentPanelupdate tbody').append('<tr id="iidinstallmentdetail'+obj.id+'" data-name="installmentdetailvalue[]"><td data-name="'+obj.installment_date+'">'+strdate+'</td><td data-name="'+obj.percentage+'">'+floatToString(obj.percentage)+'%</td><td data-name="'+amountToString(obj.amount)+'" class="uangdata">'+amountToString(obj.amount)+'</td><td></td></tr>')

                    }
                
            },
            error: function (request, status, error) {
                //alert(request.responseText);
                swal("Error!", error, "Get Data Error");
            }
        });

    }
    function autoCalculateRetro(status){
        var insured = $('#insuredIDtxt').val();
        var sliptype = $('#sliptypeform').val();;
        if (status == 'update') {
            var slipnetprmtonr = parseFloat($('#slipnetprmtonrupdate').val().replace(/,/g, ""));
            var slipsumshare = $('#slipsumshareupdate').val();
            var count_endorsement = $('#countendorsmentupdate').val();
            
        }else if(status == 'endorsement'){
            var slipnetprmtonr = parseFloat($('#slipnetprmtonrendorsement').val().replace(/,/g, ""));
            var slipsumshare = $('#slipsumshareendorsement').val();
            var count_endorsement = $('#countendorsmentdata').val();
        }else {
            var slipnetprmtonr = parseFloat($('#slipnetprmtonr').val().replace(/,/g, ""));
            var slipsumshare = $('#slipsumshare').val();
            var count_endorsement = 0;
        }

        $.ajax({
            url:'{{ url("/") }}/transaction-data/'+sliptype+'/auto-update-retro/',
            data:{
                insured:insured,
                slipnumber:slipnumber,
                sliptype:sliptype,
                count_endorsement:count_endorsement,
                slipnetprmtonr:slipnetprmtonr
            },
            type:"POST",
            beforeSend: function() { $("body").addClass("loading");  },
            complete: function() {  $("body").removeClass("loading"); },
            success:function(response)
            {
                
                 var installment_panel = JSON.parse(response.data); 
                    $('#retrocessionPanelupdate tbody').empty();
                    for(var i = 0; i < installment_panel.length; i++) 
                    {
                        var obj = installment_panel[i];
                        var currdate = obj.installment_date;
                            var convdate = currdate.split("-").reverse().join("/");
                            console.log('conv date ' + convdate)
                            var strdate = convdate.toString();
                        $('#retrocessionPanel tbody').append('<tr id="iidretrocession'+response.id+'" data-name="retrocessionvalue[]"><td data-name="'+response.contract+'">'+response.contract+'</td><td data-name="'+floatToString(response.percentage)+'">'+floatToString(response.percentage)+'</td><td data-name="'+amountToString(response.amount)+'">'+amountToString(response.amount)+'</td><td><a href="javascript:void(0)" onclick="deleteretrocessiondetail('+response.id+')">delete</a></td></tr>');

                    }
                
            },
            error: function (request, status, error) {
                //alert(request.responseText);
                swal("Error!", error, "Get Data Error");
            }
        });

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
    function calculateOwnRetention(status){
        if (status == 'update') {
            var orpercent = parseFloat($('#sliporupdate').val()) / 100;
            var slipsumshare = parseFloat($("#slipsumshareupdate").val().replace(/,/g, ""));
    
        }else if(status == 'endorsement'){
            var orpercent = parseFloat($('#sliporendorsement').val()) / 100;
            var slipsumshare = parseFloat($("#slipsumshareendorsement").val().replace(/,/g, ""));

        }else{
            
            var orpercent = parseFloat($('#slipor').val()) / 100;
            var slipsumshare = parseFloat($("#slipsumshare").val().replace(/,/g, ""));
        }
        var proses = orpercent * slipsumshare;
        var sumor = isNaN(proses) ? 0 :(proses);
        if (status == 'update') {
            $('#slipsumorupdate').val(sumor);
            $('#slipsumorupdate2').val(sumor);
        }else if(status == 'endorsement'){
            $('#slipsumorendorsement').val(sumor);
            $('#slipsumorendorsement2').val(sumor);
        }else{
            $('#slipsumor').val(sumor);
            $('#slipsumor2').val(sumor);
        }           
    }
</script>
