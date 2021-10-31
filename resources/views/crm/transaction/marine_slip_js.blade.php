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
</style>

<script>
$("button[data-dismiss-modal=modal2]").click(function(){
    $('#ModalCountHullUpdate').modal('hide');
});

$("button[data-dismiss-modal=modal3]").click(function(){
    $('#ModalCountHullEndorsement').modal('hide');
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





<link rel="stylesheet" href="{{asset('css/sweetalert2.min.css')}}">
<script src="{{asset('js/sweetalert2.all.min.js')}}"></script>

<style>
    .hide {
        display: none;
    }
</style>


<!-- <script type="text/javascript">
    $('.nav-tabs li').click(function (e) {     
    //get selected href
    var href = $(this).attr('href');    
    var id = href.substring(1);  
    console.log('href = '+href)  
    console.log('id = '+id)  
    
    
    //set all nav tabs to inactive
    $('.nav-tabs li ').removeClass('active');
    $('.nav-tabs li a').removeClass('active');
    
    //get all nav tabs matching the href and set to active
    $('.nav-tabs li[href="'+href+'"]').addClass('active');
    $('.nav-tabs li a[href="'+href+'"]').addClass('active');

    // active tab
    $('div .tab-pane .fade').removeClass('show');
    $('div .tab-pane .fade').removeClass('active');

    $('div .tab-pane[id="'+id+'"]').addClass('show');
    $('div .tab-pane[id="'+id+'"]').addClass('active');
});
</script> -->

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
    }else if(id == "insured-details-id-tabpanel"){

        window.scrollTo({ top: $("#insured-details-id-tabpanel").offset().top, behavior: 'smooth' }); 
    }else if(id == "general-details-id-tabpanel"){

        window.scrollTo({ top: $("#general-details-id-tabpanel").offset().top, behavior: 'smooth' }); 
    }

});
</script>

<script type="text/javascript">
     // window.onbeforeunload = function () {
     //  return 'Are you really want to perform the action?';
     // }
</script>

<script type="text/javascript">
    // $('#slipamount').keyup(function(){
    //     var currenc = $(this).val();
    //     console.log(currenc)
    //     currenc.replace(/\D/g, "");
    // });

    $('input.amount').keyup(function(event) {
            // skip for arrow keys
            if(event.which >= 37 && event.which <= 40) return;
                console.log(event.which)
                console.log($(this).val())
                // format number
                $(this).val(function(index, value) {
                //return value.replace(/\D/g, "");
                var parts = value.toString().split(".");
                parts[0] = parts[0].replace(/\D/g, "");
                return parts.join(".");
            });
    });
</script>

<script type="text/javascript">
    // function amountToString(a){
    //     var nilai = a.toString().replace(/\B(?=(\d{3})+(?!\d)+\.)/g,",");
    //     return nilai;

    // }
    function clear_all(){
        $('#autocomplete').val("");
        $('#autocomplete2').val("");
        $('#mcrouteto').val("");
        $('#mcroutefrom').val("");
        $('#mcshare').val("");
        $('#mcsharefrom').val("");
        $('#mcshareto').val("");
        $('#mccndn').val("");
        $('#mccertno').val("");
        $('#mcslipno').val("");
        $('#mcpolicyno').val("");
        $('#mcpercent').val("");
        $('#mcamount').val("");
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

<script>
    var CSRF_TOKEN = $('meta[name="_token2"]').attr('content');
    
   $(document).ready(function() { 
           
            $(".e1").select2(); 
        
            $("#btnaddlayer").attr('hidden','true');
            $("#sliplayerproportional").attr('hidden','true');
            $("#labelnonprop").attr('hidden','true');
            // $("#retrocessionPanel").attr('hidden','true');
            // $("#tabretro").attr('hidden','true');
            $("#labelnp").attr('hidden','true');
           
            $("#btn-success2").click(function(){ 
            var html = $(".clone2").html();
            $(".increment2").after(html);
            });
   
            $("body").on("click","#btn-danger2",function(){ 
            $(this).parents("#control-group2").remove();
            });
            $('#mcshareto').click(function(){
                $(this).select();
            })
            var dtdef = new Date($.now());
            var datetimedef =  dtdef.getFullYear() + "-" + dtdef.getMonth() + "-" + dtdef.getDate() + " " + dtdef.getHours() + ":" + dtdef.getMinutes() + ":" + dtdef.getSeconds();
            $('#slipStatusTable tbody').append('<tr id="stlid"><td >'+ $("#slipstatus").val() +'</td><td >'+datetimedef+'</td><td >'+ $("#slipusername").val() +'</td></tr>')
            
            var currency_exc = $('#mccurrency').val();
            if(currency_exc){
                $.ajax({
                    type:"GET",
                    url:"{{url('get-kurs-detail')}}?currency_id="+currency_exc,
                    beforeSend: function() { $("body").addClass("loading");  },
                    complete: function() {  $("body").removeClass("loading"); },
                    success:function(res){  
                        console.log(res)
                        console.log('kurs ' + res.kurs)      
                        $('#mckurs').val(res.kurs);
                    }
                });
            }
            var code = $('#mcnumber').val();
            refreshTableSlip(code);
            var sign = "<?php echo($sign) ?>";
            console.log('tanda ' + sign)

            if(sign == "insert"){
                clear_all();
            }
           
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

    //triggered when modal is about to be shown
    $('#ModalAddInterestInsured').on('show.bs.modal', function(e) {

         //get data-id attribute of the clicked element

         var codesl = $(e.relatedTarget).data('look-id');
         console.log("ini ship code " + codesl)
        // alert(codesl);
        $('#mcshiplistid').val(codesl);
    });

</script>

<script type="text/javascript">
  
    //triggered when modal is about to be shown
    $('#detailmodaldata').on('show.bs.modal', function(e) {

        //get data-id attribute of the clicked element
        var codesl = $(e.relatedTarget).data('book-id');

        //alert(codesl);

        $.ajax({
        url:'{{ url("/") }}/transaction-data/detailmarineslip/'+codesl,
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
            console.log('response.installment_panel' + response.installment_panel)
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
                            // var conv_amount = obj.amount.toFixed(2);
                            if(obj.amount)
                            {
                                var conv_amount =  parseFloat(obj.amount).toFixed(2);
                            }
                            else
                            {
                                var conv_amount = 0;
                            }
                            var str_amount = conv_amount.toString();
                            var curr_amount = str_amount;
                            // var curr_minamount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(obj.min_claimamount);
                            var conv_minamount = parseFloat(obj.min_claimamount).toFixed(2);
                            var str_minamount = conv_minamount.toString();
                            var curr_minamount = str_minamount.toString();
                            // var curr_minamount = obj.min_claimamount.toString();
                            var conv_percent = parseFloat(obj.percentage).toFixed(2);
                            
                            $('#deductiblePaneldetail tbody').append('<tr id="iiddeductible'+obj.id+'" data-name="deductibledetailvalue[]"><td data-name="'+obj.deductibletype+'">'+obj.deductibletype+'</td><td data-name="'+floatToString(obj.percentage)+'">'+floatToString(parseFloat(obj.percentage))+'%</td><td data-name="'+amountToString(obj.amount)+'">'+amountToString(obj.amount)+'</td><td data-name="'+amountToString(obj.min_claimamount)+'">'+amountToString(obj.min_claimamount)+'</td><td></td></tr>');

                    }
                }


                if(response.condition_needed && response.condition_needed.length > 10)
                {

                    var condition_needed = JSON.parse(response.condition_needed); 
                    $('#ConditionNeededDetail tbody').empty();
                    for(var i = 0; i < condition_needed.length; i++) 
                    {
                        var obj = condition_needed[i];
                        console.log("obj.cncode" + obj.cncode);
                        //console.log(obj.id);
                        //$('#interestInsuredTabledetail tbody').append('');
                        // var curr_amount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(obj.amount);
                        //var conv_amount = obj.amount.toFixed(2);
                        //var str_amount = conv_amount.toString();
                        //var curr_amount = str_amount;
                        // var curr_amount = obj.amount.toString();
                        //var conv_percent = parseFloat(obj.percentage).toFixed(3);
                        
                        $('#ConditionNeededDetail tbody').append('<tr id="cniddetail'+obj.id+'" data-name="extendcoveragedetailvalue[]"><td data-name="'+obj.cncode+'">'+obj.cncode + ' - ' + obj.cnname+'</td><td data-name="'+obj.information+'">'+obj.information+'</td></tr>');
                        
                    }
                }


                if(response.installment_panel && response.installment_panel.length > 10)
                {

                    var installment_panel = JSON.parse(response.installment_panel); 
                    $('#installmentPaneldetail tbody').empty();
                    for(var i = 0; i < installment_panel.length; i++) 
                    {
                        var obj = installment_panel[i];
                        if (obj.amount) {
                            var conv_amount = parseFloat(obj.amount).toFixed(2);    
                        }else{
                            var conv_amount = 0;
                        }
                        
                        var curr_amount = conv_amount.toString();

                        var currdate = obj.installment_date;
                        var convdate = currdate.split("-").reverse().join("/");
                        console.log('conv date ' + convdate)
                        var strdate = convdate.toString();

                        var conv_percent = parseFloat(obj.percentage).toFixed(2);

                        //console.log(obj.id);
                        //$('#interestInsuredTabledetail tbody').append('');
                        
                        $('#installmentPaneldetail tbody').append('<tr id="iidinstallmentdetail'+obj.id+'" data-name="installmentdetailvalue[]"><td data-name="'+obj.installment_date+'">'+strdate+'</td><td data-name="'+floatToString(obj.percentage)+'">'+floatToString(parseFloat(obj.percentage))+'%</td><td data-name="'+amountToString(obj.amount)+'">'+amountToString(obj.amount)+'</td><td></td></tr>')

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
                        if (obj.amount) {
                            var conv_amount = parseFloat(obj.amount).toFixed(2);
                        }else{
                            var conv_amount = 0;
                        }
                        var str_amount = conv_amount.toString();
                        var curr_amount = str_amount;
                        // var curr_amount = obj.amount.toString();
                        var conv_percent = parseFloat(obj.percentage).toFixed(2);

                        //console.log(obj.id);
                        //$('#interestInsuredTabledetail tbody').append('');
                        
                        
                        $('#retrocessionPaneldetail tbody').append('<tr id="iidretrocessiondetail'+obj.id+'" data-name="retrocessiondetailvalue[]"><td data-name="'+obj.contract+'">'+obj.contract+'</td><td data-name="'+floatToString(obj.percentage)+'">'+floatToString(parseFloat(obj.percentage))+'%</td><td data-name="'+amountToString(obj.amount)+'">'+amountToString(obj.amount)+'</td><td></td></tr>');

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
                    $("#slipcedingbrokerdetail").val(response.source).trigger('change');
                    // $("#slipcedingbrokerdetail option").attr('hidden',true);
                    // $("#slipcedingbrokerdetail option[value=" + response.source + "]:first")[0].hidden = false;
                    // $("#slipcedingbrokerdetail option[value=" + response.source + "]:first")[0].selected = true;
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
                    $("#slipcobdetail option[value=" + response.cob + "]:first")[0].selected = true;
                }

                if(response.koc)
                {
                    if($("#slipkocdetail option[value=" + response.koc + "]:first")[0])
                    {
                      $("#slipkocdetail option[value=" + response.koc + "]:first")[0].selected = true;
                    }
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
                    $("#sliptypetsidetail option[value=" + response.type_tsi + "]:first")[0].selected = true;
                }

                if(response.type_share_tsi)
                {
                    $("#sharetypetsidetail option[value=" + response.type_share_tsi + "]:first")[0].selected = true;
                }


                if(response.status_log){
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
                for(var i = 0; i < attacment_file.length; i++)
                {
                    var filename = attacment_file[i].filename;
                    $('#aidlistdetail').append('<li><div class="control-group input-group" id="control-group2" style="margin-top:10px"><a href="{{ asset("files")}}/'+filename+'">'+filename+'</a></div></li>')
                };
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

                    $('#slipcommissiondetail').val(floatToString(parseFloat(response.commission).toFixed(2)));
                }
                else{
                    $('#slipcommissiondetail').val(0);
                }
                

                if(response.sum_commission){
                    var conv_sc = floatToString(parseFloat(response.sum_commission).toFixed(2))
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

            $('#slipnodetail').val(response.slip_no);
            $('#slipcndndetail').val(response.cn_dn);
            $('#slippolicy_nodetail').val(response.policy_no);
            if(response.total_sum_insured){
                var conv_tsi = amountToString(response.total_sum_insured);
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
                $('#slippctdetail').val( floatToString(response.insured_pct));
            }else{
                $('#slippctdetail').val("0");
            }
            


            if(response.total_sum_pct){
                var conv_spct = amountToString(response.total_sum_pct)
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
            
            var sum = isNaN(days / 365) ? 0 :(days / 365).toFixed(8);
            var constday = days.toString() + "/365";

            console.log(insurance_period_from2)
            console.log(insurance_period_to2)
            console.log(days)
            console.log(constday)
            console.log(amountToString(sum))

            
            

            $('#slipdaytotaldetail').val(days);
            $('#slipdaytotaldetail2').val(days);
            $('#slipdaytotaldetail3').val("365");
            $('#slipdaytotaldetail4').val("365");
        
            $('#sliptotalsumdatedetail').val(amountToString(sum));


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
                    $('#slipratedetail').val(floatToString(parseFloat(response.rate).toFixed(2)));
                }else{
                    $('#slipratedetail').val("0");
                }
                
                if(response.share){
                    $('#slipsharedetail').val(floatToString(response.share));
                }else{
                    $('#slipsharedetail').val("0");
                }
                

                if(response.sum_share){
                    var conv_sshare = amountToString(response.sum_share);
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
                    $('#sliptotalratedetail').val(conv_srate);
                }
                else{
                    $('#slipsumsharedetail').val("0");
                    $('#slipsumsharedetail2').val("0");
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
    //triggered when modal is about to be shown
    $('#updatemodaldata').on('show.bs.modal', function(e) {

        // $("#tabretroupdate").attr('hidden','true');
         //get data-id attribute of the clicked element
         var codesl = $(e.relatedTarget).data('book-id');
        
        $.ajax({
            url:'{{ url("/") }}/transaction-data/detailmarineslip/'+codesl,
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
                $('#sliptotalpercentinspanupdate').val(response.sum_ippercent);

                    if(response.deductible_panel && response.deductible_panel.length > 10)
                    {
                        var deductibledata = JSON.parse(response.deductible_panel); 

                        $('#deductiblePanelupdate tbody').empty();
                        for(var i = 0; i < deductibledata.length; i++) 
                        {
                            var obj = deductibledata[i];

                            
                            var percent = parseFloat(obj.percentage).toFixed(5).toString();
                            $('#deductiblePanelupdate tbody').append('<tr id="iiddeductibleupdate'+obj.id+'" data-name="deductibleupdatevalue[]"><td data-name="'+obj.deductibletype+'">'+obj.deductibletype+'</td><td data-name="'+floatToString(percent)+'">'+floatToString(percent)+'%</td><td data-name="'+amountToString(obj.amount)+'">'+amountToString(obj.amount)+'</td><td data-name="'+amountToString(obj.min_claimamount)+'">'+amountToString(obj.min_claimamount)+'</td><td><a href="javascript:void(0)" onclick="deletedeductibleupdate('+obj.id+')">delete</a></td></tr>');

                        }
                    }


                    if(response.condition_needed && response.condition_needed.length > 10)
                    {

                        var condition_needed = JSON.parse(response.condition_needed); 
                        $('#ConditionNeededUpdate tbody').empty();
                        
                        for(var i = 0; i < condition_needed.length; i++) 
                        {
                            var obj = condition_needed[i];
                            
                            $('#ConditionNeededUpdate tbody').append('<tr id="cnidupdate'+obj.id+'" data-name="extendcoveragedetailvalue[]"><td data-name="'+obj.cncode+'">'+obj.cncode + ' - ' + obj.cnname+'</td><td data-name="'+obj.cndesc+'">'+obj.cndesc+'</td><td><a href="javascript:void(0)" onclick="deleteconditionneededupdate('+obj.id+')">delete</a></td></tr>');
                            
                        }
                    }


                    if(response.installment_panel && response.installment_panel.length > 10)
                    {

                        var installment_panel = JSON.parse(response.installment_panel); 

                        $('#installmentPanelupdate tbody').empty();
                        for(var i = 0; i < installment_panel.length; i++) 
                        {
                            var obj = installment_panel[i];
                            var conv_amount = parseFloat(obj.amount).toFixed(2);
                            var curr_amount = conv_amount.toString();
                            var currdate = obj.installment_date;
                            var convdate = currdate.split("-").reverse().join("/");
                            console.log('conv date ' + convdate)
                            var strdate = convdate.toString();
                            //flag bro
                            var conv_percent = parseFloat(obj.percentage).toFixed(2);

                            console.log(obj.id);
                            var percent = parseFloat(obj.percentage).toFixed(5).toString();
                            $('#installmentPanelupdate tbody').append('<tr id="iidinstallmentupdate'+obj.id+'" data-name="installmentupdatevalue[]"><td data-name="'+obj.installment_date+'">'+strdate+'</td><td data-name="'+floatToString(percent)+'">'+floatToString(percent)+'%</td><td data-name="'+amountToString(obj.amount)+'">'+amountToString(obj.amount)+'</td><td><a href="javascript:void(0)" onclick="deleteinstallmentupdate('+obj.id+')">delete</a></td></tr>')

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
                            if (obj.amount) {
                                var conv_amount = parseFloat(obj.amount).toFixed(2);
                            }else{
                                var conv_amount = 0;
                            }
                            
                            var str_amount = conv_amount.toString();
                            var curr_amount = str_amount;

                            var conv_percent = parseFloat(obj.percentage).toFixed(5);
                            
                            $('#retrocessionPanelupdate tbody').append('<tr id="iidretrocessionupdate'+obj.id+'" data-name="retrocessionupdatevalue[]"><td data-name="'+obj.contract+'">'+obj.contract+'</td><td data-name="'+floatToString(conv_percent)+'">'+floatToString(conv_percent)+'%</td><td data-name="'+amountToString(obj.amount)+'">'+amountToString(obj.amount)+'</td><td><a href="javascript:void(0)" onclick="deleteretrocessionupdate('+obj.id+')">delete</a></td></tr>');

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
                    // $("#slipcedingbrokerupdate option[value=" + response.source + "]:first")[0].selected = true;
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
                    $('#slipcobupdate').val(response.cob).trigger('change');
                    
                }

                if(response.koc)
                {
                    $('#slipkocupdate').val(response.koc).trigger('change')
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
                    var conv_tsi = amountToString(response.total_sum_insured);
                    $('#sliptotalsumupdate').val(conv_tsi);
                    $('#sliptotalsumupdate2').val(conv_tsi);
                }else{
                    $('#sliptotalsumupdate').val(0);
                    $('#sliptotalsumupdate2').val(0);
                }

                if(response.share_tsi){
                    var conv_stsi = amountToString(response.share_tsi);
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
                    $('#slippctupdate').val( floatToString(parseFloat(response.insured_pct).toFixed(2)));
                }else{
                    $('#slippctupdate').val("0");
                }   
                

                if(response.total_sum_pct)
                {
                    var conv_tsp = amountToString(response.total_sum_pct)
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
                var sum = isNaN(days / 365) ? 0 :(days / 365).toFixed(8);
                var constday = days.toString() + "/365";
                console.log(insurance_period_from2)
                console.log(insurance_period_to2)
                console.log(days)
                console.log(constday)
                console.log(amountToString(sum))

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
                        $('#sliprateupdate').val(floatToString(parseFloat(response.rate).toFixed(2)));
                    }else{
                        $('#sliprateupdate').val("0");
                    }
                    

                    if(response.share){
                        $('#slipshareupdate').val(amountToString(response.share));
                    }else{
                        $('#slipshareupdate').val("0");
                    }


                    if(response.v_broker){
                        $('#slipvbrokerupdate').val(amountToString(response.v_broker));
                    }else{
                        $('#slipvbrokerupdate').val("0");
                    }
                    
                    
                    
                    if(response.sum_share){
                        var conv_sshare = amountToString(response.sum_share)
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
                        var conv_bp = amountToString(response.basic_premium)
                        $('#slipbasicpremiumupdate').val(conv_bp);
                    }else{
                        $('#slipbasicpremiumupdate').val("0");
                    }
                    
                    
                    if(response.grossprm_to_nr){
                        var gprmtnr = floatToString(response.grossprm_to_nr)
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
                        var conv_sc = amountToString(response.sum_commission)
                        $('#slipsumcommissionupdate').val(conv_sc);
                        $('#slipsumcommissionupdate2').val(conv_sc);
                    }else{
                        $('#slipsumcommissionupdate').val(0);
                        $('#slipsumcommissionupdate2').val(0);                        
                    }

                    if(response.netprm_to_nr){
                        var conv_nprtnr = floatToString(parseFloat(response.netprm_to_nr).toFixed(2));
                        $('#slipnetprmtonrupdate').val(conv_nprtnr);
                        $('#slipnetprmtonrupdate2').val(conv_nprtnr);
                    }else{
                        $('#slipnetprmtonrupdate').val(0);
                        $('#slipnetprmtonrupdate2').val(0);
                    }
                    
                    if(response.sum_rate){
                        var conv_srate = floatToString(response.sum_rate);
                        $('#sliptotalrateupdate').val(conv_srate);
                        $('#sliptotalrateupdate2').val(conv_srate);
                    }
                    else{
                        $('#sliptotalrateupdate').val("0");
                        $('#sliptotalrateupdate2').val("0");

                    }

                    if(response.sum_v_broker){
                        var conv_sfee = amountToString(response.sum_v_broker);
                        $('#slipsumfeeupdate').val(conv_sfee);
                        $('#slipsumfeeupdate2').val(conv_sfee);
                    }
                    else{
                        $('#slipsumfeeupdate').val("0");
                        $('#slipsumfeeupdate2').val("0");

                    }

                    if(response.own_retention){
                        $('#sliporupdate').val(floatToString(parseFloat(response.own_retention).toFixed(2)));
                    }else{
                        $('#sliporupdate').val("0");
                    }
                    

                    if(response.sum_own_retention){
                        var conv_sor = amountToString(response.sum_own_retention);
                        $('#slipsumorupdate').val(conv_sor);
                        $('#slipsumorupdate2').val(conv_sor);
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
    });
    // Change status slip
    $(document).on('click','#btnSlip', function(e) {
        var codesl = $(this).data('id');
        var code = $('#mcnumber').val();
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
                        toastr.success(response.message);
                        console.log(code);
                        refreshTableSlip(code);
                    }else{
                        toastr.warning(response.message);
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
                    return value.replace(/\D/g, "");
                });
            });
        
        $.ajax({
            url:'{{ url("/") }}/transaction-data/detailendorsementmarineslip/'+codesl,
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
                    $('#sliptdendorsement').val(response.date_transfer);
                    $('#sliptdendorsement2').val(response.date_transfer);

                    // $('#slipuyendorsement').val(response.uy);
                    $('#slipedendorsement').val(response.endorsment);
                    $('#slipslsendorsement').val(response.selisih);
                    $('#wpcendorsement').val(response.wpc);
                    
                    // $('#sliptotalnilaiecendorsement').val(response.sum_ec);
                    // $('#sliptotalpercentinspanendorsement').val(response.sum_ippercent);


                    if(response.deductible_panel && response.deductible_panel.length > 10)
                    {

                        var deductibledata = JSON.parse(response.deductible_panel); 

                        $('#deductiblePanelendorsement tbody').empty();
                        // for(var i = 0; i < deductibledata.length; i++) 
                        // {
                        //     var obj = deductibledata[i];
                        //     // var curr_amount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(obj.amount);
                        //     if (obj.amount) {
                        //         var conv_amount = parseFloat(obj.amount);
                        //     }else{
                        //         var conv_amount = 0;
                        //     }

                        //     var str_amount = conv_amount;
                        //     var curr_amount = str_amount;
                        //     // var curr_minamount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(obj.min_claimamount);
                        //     if (obj.min_claimamount) {
                        //         var conv_minamount = parseFloat(obj.min_claimamount);    
                        //     }else{
                        //         var conv_minamount = 0;
                        //     }
                            
                        //     var str_minamount = conv_minamount.toString();
                        //     var curr_minamount = str_minamount;

                        //     var conv_percent = parseFloat(obj.percentage);

                        //     //console.log(obj.id);
                        //     //$('#interestInsuredTabledetail tbody').append('');
                            
                        //     $('#deductiblePanelendorsement tbody').append('<tr id="iiddeductibleendorsement'+obj.id+'" data-name="deductibleendorsementvalue[]"><td data-name="'+obj.deductibletype+'">'+obj.deductibletype+'</td><td data-name="'+floatToString(obj.percentage)+'">'+floatToString(parseFloat(obj.percentage))+'%</td><td data-name="'+amountToString(obj.amount)+'">'+amountToString(obj.amount)+'</td><td data-name="'+amountToString(obj.min_claimamount)+'">'+amountToString(obj.min_claimamount)+'</td><td><a href="javascript:void(0)" onclick="deletedeductibleendorsement('+obj.id+')">delete</a></td></tr>');

                        // }
                    }


                    if(response.condition_needed && response.condition_needed.length > 10)
                    {

                        var condition_needed = JSON.parse(response.condition_needed); 
                        $('#ConditionNeededEndorsement tbody').empty();
                        
                        // for(var i = 0; i < condition_needed.length; i++) 
                        // {
                        //     var obj = condition_needed[i];
                            
                        //     $('#ConditionNeededEndorsement tbody').append('<tr id="cnidendorsement'+obj.id+'" data-name="extendcoveragedetailvalue[]"><td data-name="'+obj.cncode+'">'+obj.cncode + ' - ' + obj.cnname+'</td><td data-name="'+obj.cndesc+'">'+obj.cndesc+'</td><td><a href="javascript:void(0)" onclick="deleteconditionneededupdate('+obj.id+')">delete</a></td></tr>');
                            
                        // }
                    }


                    if(response.installment_panel && response.installment_panel.length > 10)
                    {

                        var installment_panel = JSON.parse(response.installment_panel); 

                        $('#installmentPanelEndorsement tbody').empty();
                        // for(var i = 0; i < installment_panel.length; i++) 
                        // {
                        //     var obj = installment_panel[i];
                        //     var conv_amount = parseFloat(obj.amount);
                        //     var curr_amount = conv_amount.toString();
                        //     var currdate = obj.installment_date;
                        //     var convdate = currdate.split("-").reverse().join("/");
                        //     console.log('conv date ' + convdate)
                        //     var strdate = convdate.toString();
                        //     //flag bro
                        //     var conv_percent = parseFloat(obj.percentage);

                        //     console.log(obj.id);
                            
                        //     $('#installmentPanelEndorsement tbody').append('<tr id="iidinstallmentendorsement'+obj.id+'" data-name="installmentupdatevalue[]"><td data-name="'+obj.installment_date+'">'+strdate+'</td><td data-name="'+floatToString(obj.percentage)+'">'+floatToString(parseFloat(obj.percentage))+'%</td><td data-name="'+amountToString(obj.amount)+'">'+amountToString(obj.amount)+'</td><td><a href="javascript:void(0)" onclick="deleteinstallmentendorsement('+obj.id+')">delete</a></td></tr>')

                        // }
                    }



                    if(response.retrocession_panel && response.retrocession_panel.length > 10)
                    {

                        var retrocession_panel = JSON.parse(response.retrocession_panel); 

                        $('#retrocessionPanelendorsement tbody').empty();
                        // for(var i = 0; i < retrocession_panel.length; i++) 
                        // {
                        //     var obj = retrocession_panel[i];
                        //     // var curr_amount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(obj.amount);
                        //     if (obj.amount) {
                        //         var conv_amount = parseFloat(obj.amount);    
                        //     }else{
                        //         var conv_amount = 0;
                        //     }
                            
                        //     var str_amount = conv_amount.toString();
                        //     var curr_amount = str_amount;

                        //     var conv_percent = parseFloat(obj.percentage);

                        //     //console.log(obj.id);
                        //     //$('#interestInsuredTabledetail tbody').append('');
                            
                            
                        //     $('#retrocessionPanelendorsement tbody').append('<tr id="iidretrocessionendorsement'+obj.id+'" data-name="retrocessionendorsementvalue[]"><td data-name="'+obj.contract+'">'+obj.contract+'</td><td data-name="'+floatToString(obj.percentage)+'">'+floatToString(parseFloat(obj.percentage))+'%</td><td data-name="'+amountToString(obj.amount)+'">'+amountToString(obj.amount)+'</td><td><a href="javascript:void(0)" onclick="deleteretrocessionendorsement('+obj.id+')">delete</a></td></tr>');

                        // }
                    }
                    
                    
                if(response.status)
                {
                    //$("#slipstatusendorsement option[value=" + response.status + "]:first")[0].selected = true;
                    $("#slipstatusendorsement").val(response.status);
                }

                if(response.source)
                {
                    $("#slipcedingbrokerendorsement").val(response.source).trigger('change');
                    // $("#slipcedingbrokerendorsement option").attr('hidden',true);
                    // $("#slipcedingbrokerendorsement option[value=" + response.source + "]:first")[0].hidden = false;
                    // $("#slipcedingbrokerendorsement option[value=" + response.source + "]:first")[0].selected = true;
                }

                if(response.source_2)
                {
                    $("#slipcedingendorsement").val(response.source_2).trigger('change');
                    // $("#slipcedingendorsement option").attr('hidden');
                    // $("#slipcedingendorsement option[value=" + response.source_2 + "]:first")[0].hidden = false;
                    // $("#slipcedingendorsement option[value=" + response.source_2 + "]:first")[0].selected = true;
                }

                if(response.currency)
                {
                    $("#slipcurrencyendorsement option[value=" + response.currency + "]:first")[0].selected = true;
                }

                if(response.cob)
                {
                    $("#slipcobendorsement").val(response.cob).trigger('change');
                }

                if(response.koc)
                {
                    $("#slipkocendorsement").val(response.koc).trigger('change');
                    
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
                $("#sliptypeendorsement option[value=" + response.insured_type + "]:first")[0].selected = true;
            }

            if(response.type_tsi)
            {
                $("#sliptypetsiendorsement option[value=" + response.type_tsi + "]:first")[0].selected = true;
            }

            if(response.type_share_tsi)
            {
                $("#sharetypetsiendorsement option[value=" + response.type_share_tsi + "]:first")[0].selected = true;
            }

            if(response.layer_non_proportional)
            {
                // $("#sliplayerproportionalendorsement option[value=" + response.layer_non_proportional + "]:first")[0].selected = true;
            }

            if(response.retro_backup)
            {
                // $("#sliprbendorsement option[value=" + response.retro_backup + "]:first")[0].selected = true;
                
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
                var conv_tsi = amountToString(response.total_sum_insured);
                $('#sliptotalsumendorsement').val(conv_tsi);
                $('#sliptotalsumendorsement2').val(conv_tsi);
            }else{
                $('#sliptotalsumendorsement').val("0");
                $('#sliptotalsumendorsement2').val("0");
            }

            if(response.share_tsi){
                var conv_stsi = amountToString(response.share_tsi);
                $('#sharetotalsumendorsement').val(conv_stsi);
                $('#sharetotalsumendorsement2').val(conv_stsi);
            }
            else
            {
                $('#sharetotalsumendorsement').val("0");
                $('#sharetotalsumendorsement2').val("0");
            }

            if(response.insured_pct){
                $('#slippctendorsement').val(amountToString(response.insured_pct));
            }else{
                $('#slippctendorsement').val("0");
            }
            

            if(response.total_sum_pct){
                var conv_spct = amountToString(response.total_sum_pct);
                $('#sliptotalsumpctendorsement').val(amountToString(response.total_sum_pct));
            }else{
                $('#sliptotalsumpctendorsement').val("0");
            }

            $('#sliptdendorsement').val(response.date_transfer);
            $('#slipipfromendorsement').val(response.insurance_period_from);
            $('#slipiptoendorsement').val(response.insurance_period_to);

            var insurance_period_from2 = response.insurance_period_from.split("/").reverse().join("-");
            var insurance_period_to2 = response.insurance_period_to.split("/").reverse().join("-");
            var days=daysBetween(insurance_period_from2, insurance_period_to2);
            var sum = isNaN(days / 365) ? 0 :(days / 365).toFixed(8);
            var constday = days.toString() + "/365";
            console.log(insurance_period_from2)
            console.log(insurance_period_to2)
            console.log(days)
            console.log(constday)
            console.log(amountToString(sum))

            //$('#slipdaytotalendorsement').val(constday);

            $('#slipdaytotalendorsement').val(days);
            $('#slipdaytotalendorsement2').val(days);
            $('#slipdaytotalendorsement3').val("365");
            $('#slipdaytotalendorsement4').val("365");

            $('#countendorsmentdata').val(response.endorsment);
            $('#countendorsmentdata2').val(response.endorsment);
            $('#remarksendorsement').val(response.remarks);
                
            
            $('#sliptotalsumdateendorsement').val(amountToString(sum));

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
                        $('#sliprateendorsement').val(floatToString(parseFloat(response.rate).toFixed(2)));
                    }else{
                        $('#sliprateendorsement').val("0");
                    }

                    if(response.sum_rate){
                        $('#sliptotalrateendorsement2').val(floatToString(parseFloat(response.sum_rate).toFixed(2)));
                        $('#sliptotalrateendorsement').val(floatToString(parseFloat(response.sum_rate).toFixed(2)));
                    }else{
                        $('#sliptotalrateendorsement2').val("0");
                        $('#sliptotalrateendorsement').val("0");
                    }

                    if(response.share){
                        $('#slipshareendorsement').val(amountToString(response.share));
                    }else{
                       $('#slipshareendorsement').val("0");
                    }

                    if(response.own_retention){
                       $('#sliporendorsement').val(amountToString(response.own_retention));
                    }else{
                       $('#sliporendorsement').val("0");
                    }

                    if(response.commission){
                        $('#slipcommissionendorsement').val(amountToString(response.commission));
                    }else{
                       $('#slipcommissionendorsement').val("0");
                    }

                    if(response.v_broker){
                        $('#slipvbrokerendorsement').val(amountToString(response.v_broker));
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
    $('#cancelmodal-btn').click(function(e){
        e.preventDefault();

        $(this).submit(function() {
			return false;
		});

         var remarkscancel = $('#remarkscancel').val();
         var slipnumber = $('#slipnumberdetail').val();
         var slipiddetail = $('#slipiddetail').val();
         var code_ms = $('#mcnumber').val();
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


<script type="text/javascript">
    $('#mccurrency').change(function(){
        var currency_exc = $(this).val();

        $.ajax({
                    type:"GET",
                    url:"{{url('get-kurs-detail')}}?currency_id="+currency_exc,
                    beforeSend: function() { $("body").addClass("loading");  },
                    complete: function() {  $("body").removeClass("loading"); },
                    success:function(res){  
                        console.log(res)
                        console.log('kurs ' + res.kurs)      
                        $('#mckurs').val(res.kurs);
                    }
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
    //     // var attr = $("#retrocessionPanel").attr('hidden');
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

       
       // $('#slipprodyear').datepicker({
       //     dateFormat: 'dd/mm/yy',
       //     changeYear: true,
       //     yearRange: '-50:+100',
       // });
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
            var sum = isNaN(days / 365) ? 0 :(days / 365).toFixed(8);
            // var constday = days.toString() + "/365";
            var constday1 = days.toString();
            var constday2 = "365";
            console.log(insurance_period_from2)
            console.log(insurance_period_to2)
            console.log(days)
            console.log(constday1)
            console.log(constday2)
            console.log(amountToString(sum))

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
            $('#sliptotalsumdate').val(floatToString(sum));
            $('#sliptotalsumdate2').val(floatToString(sum));
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
        $('#sliptotalsumdate2').trigger('change');
    });

    $('#slipipto').change(function()
    {
        $('#sliprpto').val($(this).val());
        
        var insurance_period_from2 = $('#sliprpfrom').val();
        var insurance_period_to2 = $('#sliprpto').val();
        var newinsurance_period_from2 = insurance_period_from2.split("/").reverse().join("-");
        var newinsurance_period_to2 = insurance_period_to2.split("/").reverse().join("-");
        var days=daysBetween(newinsurance_period_from2, newinsurance_period_to2);
        var sum = isNaN(days / 365) ? 0 :(days / 365).toFixed(8);
        // var constday = days.toString() + "/365";

        var constday1 = days.toString();
        var constday2 = "365";
        
        console.log(insurance_period_from2)
        console.log(insurance_period_to2)
        console.log(days)
        console.log(constday1)
        console.log(constday2)
        console.log(amountToString(sum))

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
            $('#slipdaytotal').val('');
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
            $('#sliptotalsumdate').val(floatToString(sum));
            $('#sliptotalsumdate2').val(floatToString(sum));
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
        var sum = isNaN(days / 365) ? 0 :(days / 365).toFixed(8);
        // var constday = days.toString() + "/365";
        var constday1 = days.toString();
        var constday2 = "365";
        console.log(insurance_period_from2)
        console.log(insurance_period_to2)
        console.log(days)
        console.log(constday1)
        console.log(constday2)  
        console.log(amountToString(sum))

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
            $('#sliptotalsumdate').val(floatToString(sum));
            $('#sliptotalsumdate2').val(floatToString(sum));
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
            var sum = isNaN(days / 365) ? 0 :(days / 365).toFixed(8);
            // var constday = days.toString() + "/365";
            var constday1 = days.toString();
            var constday2 = "365";
            console.log(insurance_period_from2)
            console.log(insurance_period_to2)
            console.log(days)
            console.log(constday1)
            console.log(constday2)
            console.log(amountToString(sum))

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
            $('#sliptotalsumdate').val(floatToString(sum));
            $('#sliptotalsumdate2').val(floatToString(sum));
        }
    });

    $('#slipdaytotal2').keyup(function(){
        var day = $(this).val();
        $('#slipdaytotal').val(day);

    });

    $('#slipdaytotal2').change(function(){
        var day = $(this).val();

        var sum = isNaN(day / 365) ? 0 :(day / 365).toFixed(3);

        $('#sliptotalsumdate').val(floatToString(sum));
        $('#sliptotalsumdate2').val(floatToString(sum));
    });

    $('#slipdaytotal4').keyup(function(){
        var day = $(this).val();
        $('#slipdaytotal3').val(day);
        
    });

    $('#slipdaytotal4').change(function(){
        var day = $('#slipdaytotal2').val();
        var year = $(this).val();

        var sum = isNaN(day / year) ? 0 :(day / year).toFixed(3);

        $('#sliptotalsumdate').val(floatToString(sum));
        $('#sliptotalsumdate2').val(floatToString(sum));
        
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
            var sum = isNaN(days / 365) ? 0 :(days / 365).toFixed(8);
            // var constday = days.toString() + "/365";
            var constday1 = days.toString();
            var constday2 = "365";
            console.log(insurance_period_from2)
            console.log(insurance_period_to2)
            console.log(days)
            console.log(constday1)
            console.log(constday2)
            console.log(amountToString(sum))

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
            $('#sliptotalsumdateupdate').val(amountToString(sum));
            $('#sliptotalsumdateupdate2').val(amountToString(sum));
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
        $('#sliptotalsumdateupdate2').trigger('change');
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
    $('#slipiptoupdate').change(function(){
        $('#sliprptoupdate').val($(this).val());
        
        var insurance_period_from2 = $('#sliprpfromupdate').val();
        var insurance_period_to2 = $('#sliprptoupdate').val();
        var newinsurance_period_from2 = insurance_period_from2.split("/").reverse().join("-");
        var newinsurance_period_to2 = insurance_period_to2.split("/").reverse().join("-");
        var days=daysBetween(newinsurance_period_from2, newinsurance_period_to2);
        var sum = isNaN(days / 365) ? 0 :(days / 365).toFixed(8);
        // var constday = days.toString() + "/365";
        var constday1 = days.toString();
        var constday2 = "365";
        console.log(insurance_period_from2)
        console.log(insurance_period_to2)
        console.log(days)
        console.log(constday1)
        console.log(constday2)
        console.log(amountToString(sum))

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
            $('#slipdaytotalupdate4').val("");
            $('#sliptotalsumdateupdate').val("");
            $('#sliptotalsumdateupdate2').val("");
        }else{
            $('#slipdaytotalupdate').val(constday1);
            $('#slipdaytotalupdate2').val(constday1);
            $('#slipdaytotalupdate3').val(constday2);
            $('#slipdaytotalupdate4').val(constday2);
            $('#sliptotalsumdateupdate').val(amountToString(sum));
            $('#sliptotalsumdateupdate2').val(amountToString(sum));
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
        var sum = isNaN(days / 365) ? 0 :(days / 365).toFixed(8);
        // var constday = days.toString() + "/365";
        var constday1 = days.toString();
        var constday2 = "365";
        console.log(insurance_period_from2)
        console.log(insurance_period_to2)
        console.log(days)
        console.log(constday1)
        console.log(constday2)  
        console.log(amountToString(sum))

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
            $('#sliptotalsumdateupdate').val(amountToString(sum));
            $('#sliptotalsumdateupdate2').val(amountToString(sum));
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
            var sum = isNaN(days / 365) ? 0 :(days / 365).toFixed(8);
            // var constday = days.toString() + "/365";
            var constday1 = days.toString();
            var constday2 = "365";
            console.log(insurance_period_from2)
            console.log(insurance_period_to2)
            console.log(days)
            console.log(constday1)
            console.log(constday2)
            console.log(amountToString(sum))

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
            $('#sliptotalsumdateupdate').val(amountToString(sum));
            $('#sliptotalsumdateupdate2').val(amountToString(sum));
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
            var sum = isNaN(days / 365) ? 0 :(days / 365).toFixed(8);
            // var constday = days.toString() + "/365";
            var constday1 = days.toString();
            var constday2 = "365";
            console.log(insurance_period_from2)
            console.log(insurance_period_to2)
            console.log(days)
            console.log(constday1)
            console.log(constday2)
            console.log(amountToString(sum))

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
            $('#sliptotalsumdateendorsement').val(amountToString(sum));
            $('#sliptotalsumdateendorsement2').val(amountToString(sum));
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
        $('#sliptotalsumdateendorsement2').trigger('change');
    });

    $('#slipiptoendorsement').change(function(){
        $('#sliprptoendorsement').val($(this).val());
        
        var insurance_period_from2 = $('#sliprpfromendorsement').val();
        var insurance_period_to2 = $('#sliprptoendorsement').val();
        var newinsurance_period_from2 = insurance_period_from2.split("/").reverse().join("-");
        var newinsurance_period_to2 = insurance_period_to2.split("/").reverse().join("-");
        var days=daysBetween(newinsurance_period_from2, newinsurance_period_to2);
        var sum = isNaN(days / 365) ? 0 :(days / 365).toFixed(8);
        // var constday = days.toString() + "/365";
        var constday1 = days.toString();
        var constday2 = "365";
        console.log(insurance_period_from2)
        console.log(insurance_period_to2)
        console.log(days)
        console.log(constday1)
        console.log(constday2)
        console.log(amountToString(sum))

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
            $('#sliptotalsumdateendorsement').val("");
            $('#sliptotalsumdateendorsement2').val("");
        }else{
            $('#slipdaytotalendorsement').val(constday1);
            $('#slipdaytotalendorsement2').val(constday1);
            $('#slipdaytotalendorsement3').val(constday2);
            $('#slipdaytotalendorsement4').val(constday2);
            $('#sliptotalsumdateendorsement').val(amountToString(sum));
            $('#sliptotalsumdateendorsement2').val(amountToString(sum));
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
        var sum = isNaN(days / 365) ? 0 :(days / 365).toFixed(8);
        // var constday = days.toString() + "/365";
        var constday1 = days.toString();
        var constday2 = "365";
        console.log(insurance_period_from2)
        console.log(insurance_period_to2)
        console.log(days)
        console.log(constday1)
        console.log(constday2)  
        console.log(amountToString(sum))

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
            $('#sliptotalsumdateendorsement').val(amountToString(sum));
            $('#sliptotalsumdateendorsement2').val(amountToString(sum));
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
            var sum = isNaN(days / 365) ? 0 :(days / 365).toFixed(8);
            // var constday = days.toString() + "/365";
            var constday1 = days.toString();
            var constday2 = "365";
            console.log(insurance_period_from2)
            console.log(insurance_period_to2)
            console.log(days)
            console.log(constday1)
            console.log(constday2)
            console.log(amountToString(sum))

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
            $('#sliptotalsumdateendorsement').val(amountToString(sum));
            $('#sliptotalsumdateendorsement2').val(amountToString(sum));
        }
    });

</script>

<script type="text/javascript">
         

    $('#slipipfrom').change(function(){
        $('#sliprpfrom').val($(this).val());
        $('#sliptotalsumdate2').trigger('change')
    });

    $('#slipipto').change(function(){
        $('#sliprpto').val($(this).val());
        $('#sliptotalsumdate2').trigger('change')

    });

    $('#slipipfromupdate').change(function(){
        $('#sliprpfromupdate').val($(this).val());
        $('#sliptotalsumdateupdate2').trigger('change');
    });

    $('#slipiptoupdate').change(function(){
        $('#sliprptoupdate').val($(this).val());
        $('#sliptotalsumdateupdate2').trigger('change');
    });

    $('#slipipfromendorsement').change(function(){
        $('#sliprpfromendorsement').val($(this).val());
        $('#sliptotalsumdateendorsement2').trigger('change')
    });

    $('#slipiptoendorsement').change(function(){
        $('#sliprptoendorsement').val($(this).val());
        $('#sliptotalsumdateendorsement2').trigger('change')
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
    $('#mcpercent').keyup(function(e){
         var keyCode = e.keyCode || e.which;
        if(keyCode != 9){
            var percentceding = parseFloat($(this).val()) / 100 ;
            var valtsi = $('#mcshareto').val();

            if(valtsi != null){
                var tsi = $('#mcshareto').val();
                var conv_tsi = parseFloat(tsi.replace(/,/g, ""));

                var sum_amount = isNaN(percentceding * conv_tsi) ? 0 :(percentceding * conv_tsi);
                var real_sum = sum_amount.toString();
                $('#mcamount').val(sum_amount);
            }
            else
            {
                swal('warning!','please fill TSI insured first','error')
            }
        }
        else{
            var percentceding = parseFloat($(this).val()) / 100 ;
            var valtsi = $('#mcshareto').val();

            if(valtsi != null){
                var tsi = $('#mcshareto').val();
                var conv_tsi = parseFloat(tsi.replace(/,/g, ""));

                var sum_amount = isNaN(percentceding * conv_tsi) ? 0 :(percentceding * conv_tsi);
                var real_sum = sum_amount.toString();
                $('#mcamount').val(sum_amount);
            }
            else
            {
                swal('warning!','please fill TSI insured first','error')
            }
        }

    });

    $('#mcpercent').change(function(e){
         var keyCode = e.keyCode || e.which;
         console.log(keyCode)
        if(keyCode != 9){
            var percentceding = parseFloat($(this).val()) / 100 ;
            var valtsi = $('#mcshareto').val();

            if(valtsi != null){
                var tsi = $('#mcshareto').val();
                var conv_tsi = parseFloat(tsi.replace(/,/g, ""));

                var sum_amount = isNaN(percentceding * conv_tsi) ? 0 :(percentceding * conv_tsi);
                var real_sum = sum_amount.toString();
                $('#mcamount').val(sum_amount);
            }
            else
            {
                swal('warning!','please fill TSI insured first','error')
            }
        }
        else{
            var percentceding = parseFloat($(this).val()) / 100 ;
            var valtsi = $('#mcshareto').val();

            if(valtsi != null){
                var tsi = $('#mcshareto').val();
                var conv_tsi = parseFloat(tsi.replace(/,/g, ""));

                var sum_amount = isNaN(percentceding * conv_tsi) ? 0 :(percentceding * conv_tsi);
                var real_sum = sum_amount.toString();
                $('#mcamount').val(sum_amount);
            }
            else
            {
                swal('warning!','please fill TSI insured first','error')
            }
        }

    });

    $('#mcpercent').keydown(function(e){
         var keyCode = e.keyCode || e.which;
        if(keyCode != 9){
            var percentceding = parseFloat($(this).val()) / 100 ;
            var valtsi = $('#mcshareto').val();

            if(valtsi != null){
                var tsi = $('#mcshareto').val();
                var conv_tsi = parseFloat(tsi.replace(/,/g, ""));

                var sum_amount = isNaN(percentceding * conv_tsi) ? 0 :(percentceding * conv_tsi);
                var real_sum = sum_amount.toString();
                $('#mcamount').val(sum_amount);
            }
            else
            {
                swal('warning!','please fill TSI insured first','error')
            }
        }
        else{
            var percentceding = parseFloat($(this).val()) / 100 ;
            var valtsi = $('#mcshareto').val();

            if(valtsi != null){
                var tsi = $('#mcshareto').val();
                var conv_tsi = parseFloat(tsi.replace(/,/g, ""));

                var sum_amount = isNaN(percentceding * conv_tsi) ? 0 :(percentceding * conv_tsi);
                var real_sum = sum_amount.toString();
                $('#mcamount').val(sum_amount);
            }
            else
            {
                swal('warning!','please fill TSI insured first','error')
            }
        }

    });

    $('#mcpercent').keypress(function(e){
         var keyCode = e.keyCode || e.which;
        if(keyCode != 9){
            var percentceding = parseFloat($(this).val()) / 100 ;
            var valtsi = $('#mcshareto').val();

            if(valtsi != null){
                var tsi = $('#mcshareto').val();
                var conv_tsi = parseFloat(tsi.replace(/,/g, ""));

                var sum_amount = isNaN(percentceding * conv_tsi) ? 0 :(percentceding * conv_tsi);
                var real_sum = sum_amount.toString();
                $('#mcamount').val(sum_amount);
            }
            else
            {
                swal('warning!','please fill TSI insured first','error')
            }
        }
        else{
            var percentceding = parseFloat($(this).val()) / 100 ;
            var valtsi = $('#mcshareto').val();

            if(valtsi != null){
                var tsi = $('#mcshareto').val();
                var conv_tsi = parseFloat(tsi.replace(/,/g, ""));

                var sum_amount = isNaN(percentceding * conv_tsi) ? 0 :(percentceding * conv_tsi);
                var real_sum = sum_amount.toString();
                $('#mcamount').val(sum_amount);
            }
            else
            {
                swal('warning!','please fill TSI insured first','error')
            }
        }

    });
</script>

<script type="text/javascript">
    $('#mcamount').change(function(e){
         var keyCode = e.keyCode || e.which;
        if(keyCode != 9){
            var amountlocation = $(this).val();
            var conv_amountlocation = parseFloat(amountlocation.replace(/,/g, ""));
            console.log(amountlocation)
            console.log(conv_amountlocation)
            var valtsi = $('#mcshareto').val();

            if(valtsi != null){
                var tsi = $('#mcshareto').val();
                var conv_tsi = parseFloat(tsi.replace(/,/g, ""));

                var sum_amount = isNaN((conv_amountlocation / conv_tsi)*100) ? 0 :((conv_amountlocation / conv_tsi)*100);
                var real_sum = sum_amount.toString();
                console.log(sum_amount)
                console.log(real_sum)
                $('#mcpercent').val(amountToString(sum_amount));
            }else{
                swal('warning!','please fill TSI insured first','error')
            }
        }
        else{
            var amountlocation = $(this).val() ;
            var conv_amountlocation = parseFloat(amountlocation.replace(/,/g, ""));

            console.log(amountlocation)
            console.log(conv_amountlocation)
            var valtsi = $('#mcshareto').val();

            if(valtsi != null){
                var tsi = $('#mcshareto').val();
                var conv_tsi = parseFloat(tsi.replace(/,/g, ""));

                var sum_amount = isNaN((conv_amountlocation / conv_tsi)*100) ? 0 :((conv_amountlocation / conv_tsi)*100);
                var real_sum = sum_amount.toString();
                console.log(sum_amount)
                console.log(real_sum)
                $('#mcpercent').val(amountToString(sum_amount));
            }else{
                swal('warning!','please fill TSI insured first','error')
            }
        }

    });

    $('#mcamount').keyup(function(e){
          var keyCode = e.keyCode || e.which;
        if(keyCode != 9){
            var amountlocation = $(this).val();
            var conv_amountlocation = parseFloat(amountlocation.replace(/,/g, ""));
            console.log(amountlocation)
            console.log(conv_amountlocation)
            var valtsi = $('#mcshareto').val();

            if(valtsi != null){
                var tsi = $('#mcshareto').val();
                var conv_tsi = parseFloat(tsi.replace(/,/g, ""));

                var sum_amount = isNaN((conv_amountlocation / conv_tsi)*100) ? 0 :((conv_amountlocation / conv_tsi)*100);
                var real_sum = sum_amount.toString();
                console.log(sum_amount)
                console.log(real_sum)
                $('#mcpercent').val(amountToString(sum_amount));
            }else{
                swal('warning!','please fill TSI insured first','error')
            }
        }
        else{
             var percentceding = parseFloat($('#mcpercent').val()) / 100 ;
            var valtsi = $('#mcshareto').val();

            if(valtsi != null){
                var tsi = $('#mcshareto').val();
                var conv_tsi = parseFloat(tsi.replace(/,/g, ""));

                var sum_amount = isNaN(percentceding * conv_tsi) ? 0 :(percentceding * conv_tsi);
                var real_sum = sum_amount.toString();
                $('#mcamount').val(sum_amount);
            }
            else
            {
                swal('warning!','please fill TSI insured first','error')
            }
        }

    });

    $('#mcamount').keypress(function(e){
         var keyCode = e.keyCode || e.which;
        if(keyCode != 9){
            // var percentceding = parseFloat($('#percentceding').val()) / 100 ;
            // var valtsi = $('#feshareto').val();

            // if(valtsi != null){
            //     var tsi = $('#feshareto').val();
            //     var conv_tsi = parseInt(tsi.replace(/,/g, ""));

            //     var sum_amount = isNaN(percentceding * conv_tsi) ? 0 :(percentceding * conv_tsi);
            //     var real_sum = sum_amount.toString();
            //     $('#amountlocation').val(amountToString(sum));
            // }
            // else
            // {
            //     swal('warning!','please fill TSI insured first','error')
            // }
        }
        else{
            var percentceding = parseFloat($('#mcpercent').val()) / 100 ;
            var valtsi = $('#mcshareto').val();

            if(valtsi != null){
                var tsi = $('#mcshareto').val();
                var conv_tsi = parseFloat(tsi.replace(/,/g, ""));

                var sum_amount = isNaN(percentceding * conv_tsi) ? 0 :(percentceding * conv_tsi);
                var real_sum = sum_amount.toString();
                $('#mcamount').val(sum_amount);
            }
            else
            {
                swal('warning!','please fill TSI insured first','error')
            }
        }

    });

    $('#mcamount').keydown(function(e){
         var keyCode = e.keyCode || e.which;
        if(keyCode != 9){
            // var percentceding = parseFloat($('#percentceding').val()) / 100 ;
            // var valtsi = $('#feshareto').val();

            // if(valtsi != null){
            //     var tsi = $('#feshareto').val();
            //     var conv_tsi = parseInt(tsi.replace(/,/g, ""));

            //     var sum_amount = isNaN(percentceding * conv_tsi) ? 0 :(percentceding * conv_tsi);
            //     var real_sum = sum_amount.toString();
            //     $('#amountlocation').val(amountToString(sum));
            // }
            // else
            // {
            //     swal('warning!','please fill TSI insured first','error')
            // }
        }
        else{
            var percentceding = parseFloat($('#mcpercent').val()) / 100 ;
            var valtsi = $('#mcshareto').val();

            if(valtsi != null){
                var tsi = $('#mcshareto').val();
                var conv_tsi = parseFloat(tsi.replace(/,/g, ""));

                var sum_amount = isNaN(percentceding * conv_tsi) ? 0 :(percentceding * conv_tsi);
                var real_sum = sum_amount.toString();
                $('#mcamount').val(sum_amount);
            }
            else
            {
                swal('warning!','please fill TSI insured first','error')
            }
        }

    });
</script>

<script type="text/javascript">
    $('#mcroute').change(function(){
       var routeship = $(this).val();

        console.log(routeship);
       if(routeship){
           $.ajax({
               type:"GET",
               dataType: 'json',
               url:"{{url('get-route-list')}}?route_code="+routeship,
               success:function(response){        
                   if(response){
                       $("#mcroutefrom").val(response.route_from);
                       $("#mcrouteto").val(response.route_to);
                   }else{
                       $("#mcroutefrom").empty();
                       $("#mcrouteto").empty();
                   }
               }
           });
       }else{
           $("#mcroutefrom").empty();
           $("#mcrouteto").empty();
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

<script type="text/javascript">
    //triggered when modal is about to be shown
    $('#ModalAddInterestInsured').on('show.bs.modal', function(e) {

         //get data-id attribute of the clicked element

         var codesl = $(e.relatedTarget).data('look-id');
        //alert(codesl);
        $('#mcshiplistid').val(codesl);
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
        var insured_id = $('#mcnumber').val();
        var token = $('input[name=_token]').val();
        var slip_type = 'mc';
        
        $.ajax({
            url:"{{ route('shiplist.store') }}",
            type:"POST",
            data:{
                ship_code:shipcode,
                insuredID:insured_id,
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
                    $('#shipcodetxt').val("").trigger('change');
                    console.log("response id " + response.id)
                    $('#mcnumber').val(response.insured_id);
                    
                    $('#shipdetailTable > tbody:last-child').append('<tr id="sid'+response.id+'"  data-name="shiplistvalue[]">'+
                        '<td data-name="'+response.ship_code+'">'+response.ship_code+'</td>'+
                        '<td data-name="'+response.ship_name+'">'+response.ship_name+'</td>'+
                        '<td>'+
                        '<a class="text-primary mr-3 float-right " data-toggle="modal" data-look-id="'+response.id+'" data-target="#ModalAddInterestInsured">'+
                        '<button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#ModalAddInterestInsured2">Add</button>'+
                        '</a>'+
                        '<a href="javascript:void(0)" onclick="deleteshipdetail('+response.id+')">'+
                        '<i class="fas fa-trash text-danger"></i></a></td>'+
                        '</tr>'+

                        '<tr id="iidid'+response.id+'">'+
                        '<td></td>'+
                        '<td colspan="3">'+
                        '<table id="tiidid'+response.id+'" width="600" class="table table-bordered table-striped">'+
                        '<thead>'+
                        '<tr>'+
                        '<th>Ceding</th>'+
                        '<th>Interest Insured</th>'+
                        '<th>Credit Note/Debit Note</th>'+
                        '<th>Cert No</th>'+
                        '<th>Slip Number</th>'+
                        '<th>Policy No</th>'+
                        '<th>Share</th>'+
                        '<th>amount</th>'+
                        '<th>Action</th>'+
                        '</tr>'+
                        '</thead>'+
                        '<tbody id="tbiidid'+response.id+'">'+
                        '</tbody>'+
                        '</table>'+
                        '</td>'+
                        '</tr>'
                        )

                    $('#ModalAddShip').modal('toggle');
                    $('#ModalAddShip #shipcodetxt').val("").trigger('change');
                    
                    swal("Success!", "Ship Added Successfully");
                }
                else
                {
                    swal("Error!", "Insert Error/ Duplicate Data" , "Insert Error");
                }
                

            },
            error: function (request, status, error) 
            {
                //alert(request.responseText);
                swal("Error!", "Ship Added Error", "Ship Added Data Error");
            }

            
        });

        return true;

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
                $('#iidid'+id).remove();
                console.log(response);
            }
        });
    }
</script>



<script type="text/javascript">
    $('#addinterestinsured-btn').click(function(e)
    {
       e.preventDefault();

       // var interest = $('#slipinterestlist').val();
       // var amount = $('#slipamount').val();
       var shiplist_id = $('#mcshiplistid').val();
       var slip_type = 'mc';
       var insured_id = $('#mcnumber').val();
       var interestinsured = $('#mcinterestlist').val();
       var ceding = $('#mhcedinglist').val();
       var cndn = $('#mccndn').val();
       var certno = $('#mccertno').val();
       var slipno = $('#mcslipno').val();
       var policyno = $('#mcpolicyno').val();
       var percent = $('#mcpercent').val();
       var amount = $('#mcamount').val();
       
       var token2 = $('input[name=_token2]').val();

       var conv_amount = amount.replace(/,/g, "");
       console.log(conv_amount)
       var real_amount = parseFloat(conv_amount);
       console.log(real_amount)
       
       $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
       console.log('ceding' + ceding);
       $.ajax({
           url:"{{ route('interestlist.store') }}",
           type:"POST",
           data:{
               interest_insured:interestinsured,
               slipamount:real_amount,
               id_insured:insured_id,
               ceding:ceding,
               cndn:cndn,
               certno:certno,
               slipno:slipno,
               policyno:policyno,
               percent:percent,
               sliptype:slip_type,
               shiplist_id:shiplist_id
           },
           beforeSend: function() { $("body").addClass("loading");  },
           complete: function() {  $("body").removeClass("loading"); },
           success:function(response)
           {
            
                console.log(response)
               // var curr_amount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(response.amount);
               // $('#interestInsuredTable tbody').append('<tr id="iid'+response.id+'" data-name="interestvalue[]"><td data-name="'+response.interest_id+'">'+response.description+'</td><td data-name="'+response.name_ceding+'">'+ response.code_ceding + ' - ' + response.name_ceding +'</td><td data-name="'+response.cndn+'">'+response.cndn+'</td><td data-name="'+response.certno+'">'+response.certno+'</td><td data-name="'+response.slipno+'">'+response.slipno+'</td><td data-name="'+response.policyno+'">'+response.policyno+'</td><td data-name="'+response.percentage+'">'+response.percentage+'</td><td data-name="'+response.amount+'">'+curr_amount+'</td><td><a href="javascript:void(0)" onclick="deleteinterestdetail('+response.id+')">delete</a></td></tr>')
               
                    if(response.success==false)
                    {
                            swal("Error!", response.message, "warning");
                    }
                    else
                    {
                       
                            if(response.totalpercent<=100)
                            {

                                var amount = response.amount;
                                var ceding_share = $('#mcshare').val();
                                
                                if(ceding_share == '')
                                {
                                    var sum_ceding = isNaN(parseFloat(0) + parseFloat(amount)) ? 0 :(parseFloat(0) + parseFloat(amount));
                                    var conv_sum_ceding = sum_ceding.toString();
                                    $('#mcshare').val(conv_sum_ceding);
                                    // $('#feshare2').val(conv_sum_ceding);
                                    console.log('ceding awal' + conv_sum_ceding)
                                }
                                else
                                {
                                    var conv_ceding_share = ceding_share.replace(/,/g, "");
                                    var real_ceding_share = parseFloat(conv_ceding_share);
                                    var sum_ceding = isNaN(parseFloat(real_ceding_share) + parseFloat(amount)) ? 0 :(parseFloat(real_ceding_share) + parseFloat(amount));
                                    var conv_sum_ceding = sum_ceding.toString();
                                    $('#mcshare').val(conv_sum_ceding);
                                    // $('#feshare2').val(conv_sum_ceding);
                                    console.log('ceding bertambah' + conv_sum_ceding)

                                }

                                console.log('amount' + amount)
                                var fl_amount = parseFloat(amount).toFixed(2);
                                console.log('amount float' + fl_amount)
                                var new_amount = fl_amount;
                                console.log('amount to fixed' + new_amount)
                                var curr_amount = new_amount.toString();
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

                                $('#tiidid'+shiplist_id+' > tbody:last-child').append('<tr id="intinsdetail'+response.id+'">'+
                                                '<td>'+response.code_ceding+ '-' + response.name_ceding +'</td>'+
                                                '<td>'+response.description+'</td>'+
                                                '<td>'+cndn+'</td>'+
                                                '<td>'+certno+'</td>'+
                                                '<td>'+slipno+'</td>'+
                                                '<td>'+policyno+'</td>'+
                                                '<td>'+floatToString(parseFloat(response.percentage).toFixed(2).toString())+' %</td>'+
                                                '<td>'+amountToString(response.amount)+'</td>'+
                                                '<td>'+
                                                '<a href="javascript:void(0)" onclick="deleteinterestdetail('+response.id+')"><i class="fas fa-trash text-danger"></i></a></td>'+
                                                '</tr>');

                                            $("#slipcedingbroker option[value='placeholder']").remove();
                                            $("#slipcedingbroker").append('<option value="'+response.id_ceding+'">'+response.code_ceding+' - '+response.name_ceding+'</option>');
                                            $("#slipcedingbroker").append('<option value="placeholder" selected disabled>Ceding or Broker</option>');
                                            
                                            
                                            console.log("ceding id tambahan " + response.id_ceding)
                                            console.log("ceding code tambahan " + response.code_ceding)
                                            console.log("ceding name tambahan " + response.name_ceding) 
                                            

                                            if(response.sumceding)
                                            {
                                                    $('table#shipdetailTable2 tr#totalamount').empty();
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
                                                        var curr_amount = fl_amount.toString();
                                                        console.log('current amount' + curr_amount)

                                                        var percent = total_amount_ceding[i].percentage;
                                                        var percentfl = parseFloat(percent);
                                                        // var new_percent = percentfl;

                                                        $('#shipdetailTable2 tr:last').after('<tr id="totalamount">'+
                                                        '<td></td>'+
                                                        '<td >'+name+'</td>'+
                                                        '<td >'+floatToString(percentfl)+'%</td>'+
                                                        '<td >'+amountToString(amount_ceding)+'</td>'+
                                                        '</tr>');

                                                };
                                            }
                             
                    
                                $('#ModalAddInterestInsured').modal('toggle');
                            }
                            else
                            {
                                swal("Error!", "Interest Percent More Than 100%", "Interest Percent More Than 100%");
                            }
                    }
                                // $('#form-addship')[0].reset();
           }
       });
    });
</script>

<script type="text/javascript">
    function deleteinterestdetail(id){
        var token2 = $('input[name=_token2]').val();

        $.ajax({
            url:'{{ url("/") }}/delete-interest-list/'+id,
            type:"DELETE",
            data:{
                _token:token2
            },
            beforeSend: function() { $("body").addClass("loading");  },
           complete: function() {  $("body").removeClass("loading"); },
            success:function(response){
                
                $('#iid'+id).remove();
                $('#intinsdetail'+id).remove();
                console.log(response);
                
                var total =  $("#sliptotalsum").val();
                console.log(total)
                var conv_total = total.replace(/,/g, "");
                console.log(conv_total)
                var real_total = parseInt(conv_total);
                console.log(real_total)
                var sum = isNaN(parseFloat(real_total) - parseFloat(response.amount)) ? 0 :(parseFloat(real_total) - parseFloat(response.amount)) ;
                console.log(sum)
                var real_sum = sum.toString();
                $("#sliptotalsum").val(amountToString(sum));
                $("#msishareto").val(amountToString(sum));
                $("#msitsi").val(amountToString(sum));

                if(response.suminterest)
                {
                            $('table#shipdetailTable2 tr#totalamount').empty();
                            $('tbody#totalamount').empty();
                            var total_amount_ceding = response.suminterest;
                            
                            for(var i = 0; i < total_amount_ceding.length; i++){

                                var name = total_amount_ceding[i].name;
                                var amount_ceding = total_amount_ceding[i].amount;
                                console.log('amount' + amount_ceding)
                                var fl_amount = parseFloat(amount_ceding);
                                console.log('amount float' + fl_amount)
                                var new_amount = fl_amount;
                                console.log('amount to fixed' + new_amount)
                                var curr_amount = fl_amount.toString();
                                console.log('current amount' + curr_amount)

                                var percent = total_amount_ceding[i].percentage;
                                var percentfl = parseFloat(percent);
                                // var new_percent = percentfl;

                                $('#shipdetailTable2 tr:last').after('<tr id="totalamount">'+
                                '<td></td>'+
                                '<td >'+name+'</td>'+
                                '<td >'+floatToString(percentfl)+'%</td>'+
                                '<td >'+amountToString(fl_amount)+'</td>'+
                                '</tr>');

                        };
                    }
            }
        });
    }
</script>





<script type="text/javascript">
    $('#slipcedingbroker').change(function(){
        var cedbrok = $(this).val();
        var insuredid = $('#mcnumber').val(); 
        // console.log(cedbrok) 
        var btnins = $("#addinsuredsave-btn").text();
        // alert(cedbrok);
        console.log("ceding id "+ cedbrok)
        console.log("insured id "+ insuredid)
        console.log("btn ins "+ btnins)
        if(btnins == "Update"){
            if(cedbrok){
                $.ajax({
                    type:"GET",
                    url:"{{url('get-ceding-detail')}}?slip_type=mc&ceding_id="+cedbrok+"&insured_id="+insuredid,
                    beforeSend: function() { $("body").addClass("loading");  },
                    complete: function() {  $("body").removeClass("loading"); },
                    success:function(res){  
                        console.log(res)      
                        if(res.type == 4){
                            $("#slipceding option").remove();


                            $("#slipceding").append('<option value="'+res.id+'">'+res.code+' - '+res.name+'</option>');

                            console.log(res)
                            console.log("id ceding " +res.id)
                            console.log("ceding code " +res.code)
                            console.log("ceding name " +res.name)
                            // var ceding_curr = $('#slipceding').val();
                            // var totalsum = $("#sliptotalsum").val();
                            // if(res.amountlist > 0)
                            // {
                            //     console.log('sum amount ' + res.sumamount)
                            //     var sum = res.sumamount;
                            //     var real_sum = sum.toString();
                            //     $("#sliptotalsum").val(amountToString(sum));
                            //     $("#sliptotalsum2").val(amountToString(sum));
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
                                    var conv_sum = amountToString(sum);
                                    var real_sum = conv_sum.toString();
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
                            // $.each(res,function(key,value){
                            //     console.log('ceding id '+value.ceding_id)
                            //     console.log('ceding code '+value.code)
                            //     console.log('ceding name '+value.name)
                            //     $("#slipceding").append('<option value="'+value.ceding_id+'">'+value.code+' - '+value.name+'</option>');

                            // });

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
            }
            else{
                swal("Error!", "Please choose Ceding/Broker first", "Get Ceding Error");
            }
        }else if(btnins == "Save"){
            swal('please insert insured first!!!')
        } 
          
    });

    $('#slipceding').change(function(){
        console.log("ceding choice " + $(this).val() + $( "#slipceding option:selected" ).text())
        // var ceding = $(this).val();
        // var insuredid = $('#mcnumber').val();  
        // if(ceding){
        //     $.ajax({
        //         type:"GET",
        //         url:"{{url('get-ceding-detail')}}?ceding_id="+ceding+"&insured_id="+insuredid,
        //         beforeSend: function() { $("body").addClass("loading");  },
        //         complete: function() {  $("body").removeClass("loading"); },
        //         success:function(res){  
        //             console.log(res)      
        //             if(res.type == 4){
        //             // $("#slipceding option").remove();


        //             $("#slipceding").append('<option value="'+res.id+'">'+res.code+' - '+res.name+'</option>');
        //             var ceding_curr = $('#slipceding').val();
        //             var totalsum = $("#sliptotalsum").val();
        //             // if(res.amountlist > 0)
        //             // {
        //             //     console.log('sum amount ' + res.sumamount)
        //             //     var sum = res.sumamount;
        //             //     var real_sum = sum.toString();
        //             //     $("#sliptotalsum").val(amountToString(sum));
        //             //     $("#sliptotalsum2").val(amountToString(sum));
        //             // }
        //             // else
        //             // {
        //             //     console.log('hasilnya ' + res)
        //             // }
        //             var typetsi = $('#sharetypetsi').val();

        //                 if(typetsi == 2){
        //                     var ceding_curr = $('#slipceding').val();
        //                     var totalsum = $("#sliptotalsum").val();
        //                     if(res.amountlist > 0)
        //                     {
        //                         console.log('sum amount ' + res.sumamount)
        //                         var sum = res.sumamount;
        //                         var conv_sum = sum;
        //                         var real_sum = conv_sum.toString();
        //                         $("#sharetotalsum").val(amountToString(sum));
        //                         $("#sharetotalsum2").val(amountToString(sum));
        //                     }
        //                     else
        //                     {
        //                         console.log('hasilnya ' + res)
        //                     }
        //                 }
                    

        //         }else{
        //             $("#slipceding option").remove();

        //             $.each(res,function(key,value){
        //                $("#slipceding").append('<option value="'+value.ceding_id+'">'+value.code+' - '+value.name+'</option>');

        //            });
        //         }
        //     }
        // });
        // }else{
        //     swal("Error!", "Please choose Ceding/Broker first", "Get Ceding Error");
        // }   
    });      
</script>

<!-- start perhitungan -->
<script type="text/javascript">
    $('#sliptypetsi').change(function()
    {
        var choice = $(this).val();
        var valtsi = $('#mcshareto').val();
        var valcedshare = $('#mcshare').val();
        var insuredid = $('#mcnumber').val(); 
        var cedbrok = $('#slipcedingbroker').val();
        var ceding = $('#slipceding').val();

        if(choice == '1')
        {
            if(valtsi == null)
            {
                swal('warning','please fill tsi insured value first','error')
            }else{
                
                var tsi = $('#mcshareto').val();
                var int_tsi = parseFloat(tsi.replace(/,/g, ""));
                var conv_str_tsi = int_tsi;
                var real_tsi = conv_str_tsi.toString();
                $('#sliptotalsum').val(real_tsi);
                $('#sliptotalsum2').val(real_tsi);

                var tsislip = $('#sliptotalsum').val();
                var pctval = $('#slippct').val();

                if(pctval != null){
                    var pct =  parseFloat($('#slippct').val())/100;
                    var conv_tsi = parseFloat(tsi.replace(/,/g, ""));

                    var sum = isNaN(pct * conv_tsi) ? 0 :(pct * conv_tsi) ;
                    console.log('sum ' + sum)
                    var conv_sum = amountToString(sum);
                    console.log('conv_sum' + conv_sum)
                    var real_sum = conv_sum.toString();
                    
                    console.log('real_sum' + real_sum)

                    $('#sliptotalsumpct').val(conv_sum);
                    $('#sliptotalsumpct2').val(conv_sum);
                    // swal('success','changed to tsi','success')


                    var dpamount = $('#slipdpamount').val();
                    var ecamount = $('#slipamountec').val();

                    if(dpamount != null){

                        var percent =  parseFloat($('#slipdppercentage').val()) / 100;
                        
                        var sum = isNaN(percent * conv_tsi) ? 0 :(percent * conv_tsi);
                        var real_sum = sum.toString();
                        console.log($('#slipdppercentage').val())
                        console.log(percent)
                        console.log(sum)
                        console.log(real_sum)

                        $('#slipdpamount').val(sum);
                        $('#slipdpamount2').val(sum);

                    }


                }
            }
        }
        else if(choice == '2')
        {
            if(cedbrok != null && ceding != null)
            {
                // var ceding_share = $('#feshare').val();
                // var int_ceding_share = parseInt(ceding_share.replace(/,/g, ""));
                // var conv_ceding_share = int_ceding_share;
                // var real_ceding_share = conv_ceding_share.toString();
                
                $.ajax({
                    type:"GET",
                    url:"{{url('get-ceding-detail')}}?slip_type=mc&ceding_id="+ceding+"&insured_id="+insuredid,
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
                                var conv_sum = amountToString(sum);
                                var real_sum = conv_sum.toString();
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
                                    var real_sum = sum.toString();
                                    $('#sliptotalsumpct').val(amountToString(sum));
                                    $('#sliptotalsumpct2').val(amountToString(sum));
                                    // swal('success','changed to ceding share','success')

                                    var dpamount = $('#slipdpamount').val();
                                    var ecamount = $('#slipamountec').val();

                                    if(dpamount != null){
                                        var percent =  parseFloat($('#slipdppercentage').val()) / 100;
                                        
                                        var sum = isNaN(percent * conv_tsi) ? 0 :(percent * conv_tsi) ;
                                        var real_sum = sum.toString();
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
                        }else{
                            // $("#slipceding option").remove();
                            // $("#slipceding").append('<option value="#" selected disabled> select ceding </option>');
                            // $("#sliptotalsum").val('');
                            // $("#sliptotalsum2").val('');
                            // $.each(res,function(key,value){
                            //     $("#slipceding").append('<option value="'+value.id+'">'+value.type+' - '+value.code+' - '+value.name+'</option>');

                            // });
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
        if(choice == '1'){

            var tsi = $('#mcshareto').val();
            var int_tsi = parseFloat(tsi.replace(/,/g, ""));
            var conv_str_tsi = int_tsi;
            var real_tsi = conv_str_tsi.toString();
            $('#sharetotalsum').val(real_tsi);
            $('#sharetotalsum2').val(real_tsi);

            var shareslipval = $('#slipshare').val();
            if(shareslipval != null){
                var shareslip =  parseFloat($('#slipshare').val()) / 100 ;
                var conv_tsi = parseFloat(tsi.replace(/,/g, ""));
                var sumshare =isNaN( shareslip * conv_tsi) ? 0 :( shareslip * conv_tsi) ;
                var real_sumshare = sumshare.toString();


                $('#slipsumshare').val(sumshare);
                $('#slipsumshare2').val(sumshare);

                var rateslipval = $('#sliprate').val();

                if(rateslipval != null){

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
                    var conv_totalrate = parseInt(sumrate.replace(/,/g, ""));
                    var sumrate = isNaN(((conv_totalrate / 100) * conv_tsi) * insurance) ? 0 :(((conv_totalrate / 100) * conv_tsi) * insurance);
                    var real_sumrate = sumrate.toString();

                    $('#slipbasicpremium').val(sumrate);

                    var grossprm_to_nr = $('#slipgrossprmtonr').val();

                    if(grossprm_to_nr != null){
                        var nasionalreinsurance =  $('#mcsharefrom').val();
                        var totalnre =  $('#mcshareto').val();
                        var conv_totalnre =  parseInt(totalnre.replace(/,/g, ""));

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
                            var real_sumor = sumor.toString();
                            
                            var sumgrtoprm = isNaN(conv_basre * shareslip) ? 0 :(conv_basre * shareslip );
                            var real_sumgrtoprm = sumgrtoprm.toString();
                            
                            if(nasionalreinsurance){
                                var conv_nasionalreinsurance =  parseFloat(nasionalreinsurance.replace(/,/g, ""));
                                var sumnre = isNaN(conv_nasionalreinsurance + conv_sumshare ) ? 0 :(conv_nasionalreinsurance + conv_sumshare);
                                var real_sumnre = sumnre.toString();
                            }else{
                                var conv_nasionalreinsurance =  parseFloat(nasionalreinsurance.replace(/,/g, ""));
                                var sumnre = isNaN(0 + conv_sumshare ) ? 0 :(0 + conv_sumshare);
                                var real_sumnre = sumnre.toString();
                            }
                            
                            
                            var sumourshare = isNaN((sumnre / conv_totalnre) * 100 ) ? 0 :((sumnre / conv_totalnre) * 100 );

                            console.log('sumnre' + sumnre)
                            console.log('realnre' + real_sumnre)
                            console.log('sumourshare' + sumourshare)

                            $('#slipgrossprmtonr').val(sumgrtoprm);
                            $('#slipgrossprmtonr2').val(sumgrtoprm);
                            $('#slipsumor').val(sumor);
                            $('#slipsumor2').val(sumor);
                            // $('#mcshare').val(sumourshare.replace(/,/g, "."));
                            $('#mcsharefrom').val(sumnre);


                            var commision =  parseFloat($(this).val()) / 100;
                            var feebroker = parseFloat($('#slipvbroker').val()) / 100;
                            var sumgrossprmtonr2 = $("#slipgrossprmtonr").val();
                            var conv_sumgrossprmtonr = parseInt(sumgrossprmtonr2.replace(/,/g, ""));

                            var sumcomm = isNaN(commision * conv_sumgrossprmtonr) ? 0 :(commision * conv_sumgrossprmtonr);
                            var real_sumcomm = sumcomm.toString();

                            $('#slipsumcommission').val(sumcomm);
                            $('#slipsumcommission2').val(sumcomm);

                            var sumgrossprmtonr3 = $("#slipgrossprmtonr").val();
                            var conv_sumgrossprmtonr2 = parseInt(sumgrossprmtonr3.replace(/,/g, ""));

                            var sumnetprmtonr = isNaN( conv_sumgrossprmtonr2 * (100/100 - commision - feebroker)) ? 0 :(conv_sumgrossprmtonr2 * (100/100 - commision - feebroker));
                            var real_sumnetprmtonr = sumnetprmtonr.toString();

                            var sumfeebroker = isNaN( conv_sumgrossprmtonr2 * feebroker) ? 0 :(conv_sumgrossprmtonr2 * feebroker);
                            var real_sumfeebroker = sumfeebroker.toString();


                            $('#slipnetprmtonr').val(sumnetprmtonr);
                            $('#slipnetprmtonr2').val(sumnetprmtonr);
                            // $('#slipsumfee').val("100" + "-" + commision.toString() + "-" + feebroker.toString() + "*" + conv_sumgrossprmtonr.toString());
                            $('#slipsumfee').val(sumfeebroker);
                            $('#slipsumfee2').val(sumfeebroker);

                            var sumipamountval = $('#slipipamount').val();

                            if(sumipamountval != null){
                                var percent =  parseFloat($(this).val()) / 100;

                                var sumnetprtonr2 = $("#slipnetprmtonr").val();
                                var conv_sumnetprtonr = parseInt(sumnetprtonr2.replace(/,/g, ""));

                                var sumipamount = isNaN(percent *  conv_sumnetprtonr) ? 0 :(percent *  conv_sumnetprtonr);
                                var real_sumipamount = sumipamount.toString();

                                $('#slipipamount').val(sumipamount);
                                $('#slipipamount2').val(sumipamount);
                            }

                    }



                }

            }

            // swal('warning!','change to tsi please change installment and retrocession amount manually','success')
        }else if(choice == '2')
        {

            var insuredid = $('#mcnumber').val(); 
            var cedbrok = $('#slipcedingbroker').val();
            var ceding = $('#slipceding').val();
            if(cedbrok != null && ceding != null){
                $.ajax({
                    type:"GET",
                    url:"{{url('get-ceding-detail')}}?slip_type=mc&ceding_id="+ceding+"&insured_id="+insuredid,
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
                                var conv_sum = amountToString(sum);
                                var real_sum = conv_sum.toString();
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
            var tsi = $('#mcshare').val();
            $('#sharetotalsum').val(tsi);
            $('#sharetotalsum2').val(tsi);

            var shareslipval = $('#slipshare').val();
            if(shareslipval != null){
                var shareslip =  parseFloat($('#slipshare').val()) / 100 ;
                var conv_tsi = parseInt(tsi.replace(/,/g, ""));
                var sumshare =isNaN( shareslip * conv_tsi) ? 0 :( shareslip * conv_tsi);
                var real_sumshare = sumshare.toString();


                $('#slipsumshare').val(amountToString(sumshare));
                $('#slipsumshare2').val(amountToString(sumshare));

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
                    var conv_totalrate = parseInt(sumrate.replace(/,/g, ""));
                    var sumrate = isNaN(((conv_totalrate / 100) * conv_tsi) * insurance) ? 0 :(((conv_totalrate / 100) * conv_tsi) * insurance);
                    var real_sumrate = sumrate.toString();

                    $('#slipbasicpremium').val(amountToString(sumrate));

                    var grossprm_to_nr = $('#slipgrossprmtonr').val();

                    if(grossprm_to_nr != null){
                        var nasionalreinsurance =  $('#mcsharefrom').val();
                        var totalnre =  $('#mcshareto').val();
                        var conv_totalnre =  parseInt(totalnre.replace(/,/g, ""));

                        console.log('nre' + nasionalreinsurance)
                            // console.log(conv_nasionalreinsurance)
                            console.log('totalnre' + totalnre)
                            console.log('convtotnre' + conv_totalnre)
                            
                            var sumshare2 = $('#slipsumshare').val() ;
                            var conv_sumshare = parseInt(sumshare2.replace(/,/g, ""));
                            var basic_premium = $('#slipbasicpremium').val();
                            var conv_basre = parseInt(basic_premium.replace(/,/g, ""));

                            var orpercent = $('#slipor').val() / 100;

                            var sumor = isNaN(orpercent * conv_sumshare) ? 0 :(orpercent * conv_sumshare);
                            var real_sumor = sumor.toString();
                            
                            var sumgrtoprm = isNaN(conv_basre * shareslip) ? 0 :(conv_basre * shareslip );
                            var real_sumgrtoprm = sumgrtoprm.toString();
                            
                            if(nasionalreinsurance){
                                var conv_nasionalreinsurance =  parseInt(nasionalreinsurance.replace(/,/g, ""));
                                var sumnre = isNaN(conv_nasionalreinsurance + conv_sumshare ) ? 0 :(conv_nasionalreinsurance + conv_sumshare);
                                var real_sumnre = sumnre.toString();
                            }else{
                                var conv_nasionalreinsurance =  parseInt(nasionalreinsurance.replace(/,/g, ""));
                                var sumnre = isNaN(0 + conv_sumshare ) ? 0 :(0 + conv_sumshare);
                                var real_sumnre = sumnre.toString();
                            }
                            
                            
                            var sumourshare = isNaN((sumnre / conv_totalnre) * 100 ) ? 0 :((sumnre / conv_totalnre) * 100 );

                            console.log('sumnre' + sumnre)
                            console.log('realnre' + real_sumnre)
                            console.log('sumourshare' + sumourshare)

                            $('#slipgrossprmtonr').val(amountToString(sumgrtoprm));
                            $('#slipgrossprmtonr2').val(amountToString(sumgrtoprm));
                            $('#slipsumor').val(amountToString(sumor));
                            $('#slipsumor2').val(amountToString(sumor));
                            // $('#mcshare').val(sumourshare.replace(/,/g, "."));
                            $('#mcsharefrom').val(amountToString(sumnre));


                            var commision =  parseFloat($(this).val()) / 100;
                            var feebroker = parseFloat($('#slipvbroker').val()) / 100;
                            var sumgrossprmtonr2 = $("#slipgrossprmtonr").val();
                            var conv_sumgrossprmtonr = parseInt(sumgrossprmtonr2.replace(/,/g, ""));

                            var sumcomm = isNaN(commision * conv_sumgrossprmtonr) ? 0 :(commision * conv_sumgrossprmtonr);
                            var real_sumcomm = sumcomm.toString();

                            $('#slipsumcommission').val(amountToString(sumcomm));
                            $('#slipsumcommission2').val(amountToString(sumcomm));

                            var sumgrossprmtonr3 = $("#slipgrossprmtonr").val();
                            var conv_sumgrossprmtonr2 = parseInt(sumgrossprmtonr3.replace(/,/g, ""));

                            var sumnetprmtonr = isNaN( conv_sumgrossprmtonr2 * (100/100 - commision - feebroker)) ? 0 :(conv_sumgrossprmtonr2 * (100/100 - commision - feebroker));
                            var real_sumnetprmtonr = sumnetprmtonr.toString();

                            var sumfeebroker = isNaN( conv_sumgrossprmtonr2 * feebroker) ? 0 :(conv_sumgrossprmtonr2 * feebroker);
                            var real_sumfeebroker = sumfeebroker.toString();


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
                                var real_sumipamount = sumipamount.toString();

                                $('#slipipamount').val(amountToString(sumipamount));
                                $('#slipipamount2').val(amountToString(sumipamount));
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

            var sum = isNaN(pct * conv_tsi) ? 0 :(pct * conv_tsi);
            console.log(sum)
            var real_sum = sum.toString();
            $('#sliptotalsumpct').val(amountToString(sum));
            $('#sliptotalsumpct2').val(amountToString(sum));
        }
    });

   $('#slipdppercentage').keyup(function (e) {
        if(e.keyCode != 9){
            var percent =  parseFloat($(this).val()) / 100;
            var tsi = $("#sliptotalsum").val();
            var conv_tsi = parseFloat(tsi.replace(/,/g, ""));
            var sum = isNaN(percent * conv_tsi) ? 0 :(percent * conv_tsi) ;
            var real_sum = sum.toString();
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
        if(e.keyCode != 9){
            calculateShareNr('slip')
        }
    });



   $('#sliprate').keyup(function (e) 
   {
        if(e.keyCode != 9){
            calculateBasicPremium('slip')            
        }else{
            calculateBasicPremium('slip')
        }
    });


   $("#slipbasicpremium").keyup(function(e) 
   { 
        var keyCode = e.keyCode || e.which; 

        if (keyCode == 9) 
        { 
            calculateRate('slip')
        }
        else
        {
            calculateRate('slip')
            

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
                calculateShareNr('slip')
            }

                
        }
    });

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




   $('#slipvbroker').keyup(function(e){
            var keyCode = e.keyCode || e.which; 

        if (keyCode != 9){
            calculateFee('slip')
        }else{
            calculateFee('slip')
        }
    });

   $('#slipvbroker').keydown(function(e){
            var keyCode = e.keyCode || e.which; 

        if (keyCode != 9){
            calculateFee('slip')
        }else{
            calculateFee('slip')
        }
    });

   $('#slipvbroker').keypress(function(e){
            var keyCode = e.keyCode || e.which; 

        if (keyCode != 9){
            calculateFee('slip')
        }else{
            calculateFee('slip')
        }
    });
 

   $('#slipsumfee2').keyup(function(e){
        var keyCode = e.keyCode || e.which; 

        if (keyCode != 9){
            calculatePercentFee('slip')
        }else{
            calculatePercentFee('slip')
        }
   });

   $('#slipsumfee2').keydown(function(e){
        var keyCode = e.keyCode || e.which; 

        if (keyCode != 9){
            calculatePercentFee('slip')
        }else{
            calculatePercentFee('slip')
        }
   });

   $('#slipsumfee2').keypress(function(e){
        var keyCode = e.keyCode || e.which; 

        if (keyCode != 9){
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
        var keyCode = e.keyCode || e.which;

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
            var real_sum = sum.toString();

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
    if(e.keyCode != 9){
        var percentval =  parseFloat($(this).val()) / 100;
        var sumshare = $('#slipsumshare').val() ;
        var conv_sumshare = parseFloat(sumshare.replace(/,/g, ""));
        var sumrpamount = isNaN(percentval * conv_sumshare) ? 0 :(percentval * conv_sumshare);
        var real_sumrpamount = sumrpamount.toString();

            // var sumpercentor = isNaN(orpercent - percentval) ? 0 :(orpercent - percentval); 
            // $('#slipor').val(sumpercentor);
            $('#sliprpamount').val(amountToString(sumrpamount));
            $('#sliprpamount2').val(amountToString(sumrpamount));
        }
    });

   $('#sliprppercentage').change(function (e) {
        if(e.keyCode != 9){
            var percentval =  parseFloat($(this).val());
            var orpercent = parseFloat($('#slipor').val());
            var sumpercentor = isNaN(orpercent - percentval) ? 0 :(orpercent - percentval);
            $('#slipor').val(sumpercentor);

            var percent =  parseFloat($('#slipor').val()) / 100;
            var sumshare = $("#slipsumshare").val();
            var conv_sumshare = parseFloat(sumshare.replace(/,/g, ""));

            var sum = isNaN(percent * conv_sumshare) ? 0 :(percent * conv_sumshare);
            var real_sum = sum.toString();

            $('#slipsumor').val(amountToString(sum));
            $('#slipsumor2').val(amountToString(sum));
        }
    });

   $('#slipnilaiec').keyup(function () {
        var persentage =  parseFloat($('#slipnilaiec').val()) / 1000;
        var sliptotalsum =  $('#sliptotalsum').val();
        var conv_sliptotalsum = parseFloat(sliptotalsum.replace(/,/g, ""));
       //alert(premiumnr);
       //alert(persentage);
        var sum = isNaN(conv_sliptotalsum * persentage) ? 0 :(conv_sliptotalsum * persentage) ;
        var real_sum = sum.toString();
       //alert(sum);
        console.log($(this).val())
        console.log(persentage)
        console.log(sum)
        console.log(real_sum)

        $('#slipamountec').val(amountToString(sum));
        $('#slipamountec2').val(amountToString(sum));
   });
</script>

<script  type='text/javascript'>
    $('#slippctupdate').keyup(function () {
        var pct =  parseFloat($(this).val())/100;
        
        var tsi = $("#sliptotalsumupdate").val();
        var conv_tsi = parseInt(tsi.replace(/,/g, ""));

        var sum = isNaN(pct * parseFloat(conv_tsi)) ? 0 :(pct * parseFloat(conv_tsi)) ;
        var real_sum = sum.toString();
         $('#sliptotalsumpctupdate').val(amountToString(sum));
         
     });

     $('#slipdppercentageupdate').keyup(function () {
        var percent =  parseFloat($(this).val()) / 100;
        var tsi = $("#sliptotalsumupdate").val();
        var conv_tsi = parseInt(tsi.replace(/,/g, ""));
        var sum = isNaN(percent * parseFloat(conv_tsi)) ? 0 :(percent * parseFloat(conv_tsi)) ;
        var real_sum = sum.toString();
        $('#slipdpamountupdate').val(amountToString(sum));
     });

    //  $('#slipshareupdate').keyup(function () {
    //     var shareslip =  parseFloat($(this).val())/100;
    //     var tsi = $("#sliptotalsumupdate").val();
    //     var conv_tsi = parseInt(tsi.replace(/,/g, ""));
    //     var sum = isNaN(shareslip * parseFloat(conv_tsi)) ? 0 :(shareslip * parseFloat(conv_tsi)) ;
    //     var real_sum = sum.toString();
    //     $('#slipsumshareupdate').val(amountToString(sum));
    //     // $('#msishare').val(shareslip);
    //     $('#msisharevupdate').val(shareslip);
    //  });

     
    //  $('#slipshareupdate').change(function () {
    //     var rateslip =  parseFloat($('#sliprateupdate').val()) / 100 ;
    //     var shareslip =  parseFloat($('#slipshareupdate').val()) / 100 ;
    //     var ourshare =  parseFloat($('#msisharevupdate').val()) / 100 ;
    //     var tsi = $("#sliptotalsumupdate").val();
    //     var conv_tsi = parseInt(tsi.replace(/,/g, ""));
    //     var mtsi = $("#msitsiupdate").val();
    //     var conv_mtsi = parseInt(mtsi.replace(/,/g, ""));
    //     var sumshare = $('#slipsumshareupdate').val() ;
    //     var conv_sumshare = parseInt(sumshare.replace(/,/g, ""));
    //     var orpercent = parseFloat($('#sliporupdate').val()) / 100;
    //     var sumor = isNaN(orpercent * parseFloat(conv_sumshare)) ? 0 :(orpercent * parseFloat(conv_sumshare));
    //     var real_sumor = sumor.toString();
    //     var sum = isNaN(rateslip * shareslip * parseFloat(conv_tsi)) ? 0 :(rateslip * shareslip * parseFloat(conv_tsi)) ;
    //     var real_sum = sum.toString();
    //     var sumourshare = isNaN(ourshare * parseFloat(conv_mtsi) ) ? 0 :(ourshare * parseFloat(conv_mtsi)) ;
    //     var real_sumourshare = isNaN(ourshare * parseFloat(conv_mtsi) ) ? 0 :(ourshare * parseFloat(conv_mtsi)) ;

    //     $('#slipgrossprmtonrupdate').val(amountToString(sum));
    //     $('#msisharefromupdate').val(amountToString(sumourshare));
    //     $('#msisumsharevupdate').val(amountToString(sumourshare));
        
    //     $('#slipsumorupdate').val(amountToString(amountToString(sumor)));
    //  });

    // $('#slipcommissionupdate').keyup(function () {
    //     var commision =  parseFloat($(this).val()) / 100;
    //     var sumgrossprmtonr = $("#slipgrossprmtonrupdate").val();
    //     var conv_sumgrossprmtonr = parseInt(sumgrossprmtonr.replace(/,/g, ""));
        
    //     var sum = isNaN(commision * parseFloat(conv_sumgrossprmtonr)) ? 0 :(commision * parseFloat(conv_sumgrossprmtonr));
    //     var real_sum = sum.toString();


    //     var sumnetprmtonr = isNaN( parseFloat(conv_sumgrossprmtonr) * (100/100 - commision)) ? 0 :(parseFloat(conv_sumgrossprmtonr) * (100/100 - commision));
    //     var real_sumnetprmtonr = sumnetprmtonr.toString();


    //     $('#slipsumcommissionupdate').val(amountToString(sum));
    //     $('#slipnetprmtonrupdate').val(amountToString(sumnetprmtonr));
    // });

    $('#slipippercentageupdate').keyup(function () {
        var percent =  parseFloat($(this).val()) / 100;
        
        var sumnetprtonr = $("#slipnetprmtonrupdate").val();
        var conv_sumnetprtonr = parseInt(sumnetprtonr.replace(/,/g, ""));

        var sum = isNaN(percent *  parseFloat(conv_sumnetprtonr)) ? 0 :(percent *  parseFloat(conv_sumnetprtonr));
        var real_sum = sum.toString();

        $('#slipipamountupdate').val(amountToString(sum));
    });

    $('#sliporupdate').keyup(function () {
        var percent =  parseFloat($(this).val()) / 100;
        var sumshare = $("#slipsumshareupdate").val();
        var conv_sumshare = parseInt(sumshare.replace(/,/g, ""));

        var sum = isNaN(percent * parseFloat(conv_sumshare)) ? 0 :(percent * parseFloat(conv_sumshare));
        var real_sum = sum.toString();

        $('#slipsumorupdate').val(amountToString(sum));
    });

    $('#sliprppercentageupdate').keyup(function () {
        var percentval =  parseFloat($(this).val()) / 100;
        var sumor = $('#slipsumorupdate').val() ;
        var conv_sumor = parseInt(sumor.replace(/,/g, ""));
        var sumrpamount = isNaN(percentval * parseFloat(conv_sumor)) ? 0 :(percentval * parseFloat(conv_sumor));
        var real_sumrpamount = sumrpamount.toString();

        // var sumpercentor = isNaN(orpercent - percentval) ? 0 :(orpercent - percentval); 
        // $('#slipor').val(sumpercentor);
        $('#sliprpamountupdate').val(amountToString(sumrpamount));
    });

    $('#sliprppercentageupdate').change(function () {
        var percentval =  parseFloat($(this).val());
        var orpercent = parseFloat($('#sliporupdate').val());
        var sumpercentor = isNaN(orpercent - percentval) ? 0 :(orpercent - percentval);
        $('#sliporupdate').val(sumpercentor);
    });
</script>

<script  type='text/javascript'>
   $('#slippctendorsement').keyup(function () {
        var pct =  parseFloat($(this).val())/100;
        
        var tsi = $("#sliptotalsumendorsement").val();
        var conv_tsi = parseInt(tsi.replace(/,/g, ""));

        var sum = isNaN(pct * parseFloat(conv_tsi)) ? 0 :(pct * parseFloat(conv_tsi)) ;
        var real_sum = sum.toString();
         $('#sliptotalsumpctendorsement').val(amountToString(sum));
         
     });

     $('#slipdppercentageendorsement').keyup(function () {
        var percent =  parseFloat($(this).val()) / 100;
        var tsi = $("#sliptotalsumendorsement").val();
        var conv_tsi = parseInt(tsi.replace(/,/g, ""));
        var sum = isNaN(percent * parseFloat(conv_tsi)) ? 0 :(percent * parseFloat(conv_tsi)) ;
        var real_sum = sum.toString();
        $('#slipdpamountendorsement').val(amountToString(sum));
     });

     // $('#slipshareendorsement').keyup(function () {
     //    var shareslip =  parseFloat($(this).val())/100;
     //    var tsi = $("#sliptotalsumendorsement").val();
     //    var conv_tsi = parseInt(tsi.replace(/,/g, ""));
     //    var sum = isNaN(shareslip * parseFloat(conv_tsi)) ? 0 :(shareslip * parseFloat(conv_tsi)) ;
     //    var real_sum = sum.toString();
     //    $('#slipsumshareendorsement').val(amountToString(sum));
     //    // $('#msishare').val(shareslip);
     //    $('#msisharevendorsement').val(shareslip);


     // });

     // $('#sliprateendorsement').keyup(function () {
     //    var insurance_period_from = $('#slipipfromendorsement').val().split('-');
     //    var insurance_period_to = $('#slipiptoendorsement').val().split('-');
     //    var insurance_period_from2 = $('#slipipfromendorsement').val();
     //    var insurance_period_to2 = $('#slipiptoendorsement').val();
     //    var month_from = parseInt(insurance_period_from[1]);
     //    var month_to = parseInt(insurance_period_to[1]);
     //    var month = (month_to - month_from);
     //    var days=daysBetween(insurance_period_from2, insurance_period_to2);
     //    var insurance = (days/365);
       
     //    console.log(insurance_period_from2)
     //    console.log(insurance_period_to2)
     //    console.log(days)
     //    console.log(month_from)
     //    console.log(month_to)
     //    console.log(month)
     //    console.log(insurance)
        
     //    var rateslip =  parseFloat($(this).val()) / 1000;
     //    var tsi = $("#sliptotalsumendorsement").val();
     //    var conv_tsi = parseInt(tsi.replace(/,/g, ""));
     //    var sum = isNaN((rateslip * parseFloat(conv_tsi)) * insurance) ? 0 :((rateslip * parseFloat(conv_tsi)) * insurance) ;
     //    var real_sum = sum.toString();
        
     //    $('#slipbasicpremiumendorsement').val(amountToString(sum));


     // });

     $('#slipshareendorsement').change(function () {
        var rateslip =  parseFloat($('#sliprateendorsement').val()) / 1000 ;
        var shareslip =  parseFloat($('#slipshareendorsement').val()) / 100 ;
        var ourshare =  parseFloat($('#msisharevendorsement').val()) / 100 ;
        var tsi = $("#sliptotalsumendorsement").val();
        var conv_tsi = parseInt(tsi.replace(/,/g, ""));
        var mtsi = $("#msitsiendorsement").val();
        var conv_mtsi = parseInt(mtsi.replace(/,/g, ""));
        var sumshare = $('#slipsumshareendorsement').val() ;
        var conv_sumshare = parseInt(sumshare.replace(/,/g, ""));
        var orpercent = parseFloat($('#sliporendorsement').val()) / 100;
        var sumor = isNaN(orpercent * parseFloat(conv_sumshare)) ? 0 :(orpercent * parseFloat(conv_sumshare));
        var real_sumor = sumor.toString();
        var sum = isNaN(rateslip * shareslip * parseFloat(conv_tsi)) ? 0 :(rateslip * shareslip * parseFloat(conv_tsi)) ;
        var real_sum = sum.toString();
        var sumourshare = isNaN(ourshare * parseFloat(conv_mtsi) ) ? 0 :(ourshare * parseFloat(conv_mtsi)) ;
        var real_sumourshare = isNaN(ourshare * parseFloat(conv_mtsi) ) ? 0 :(ourshare * parseFloat(conv_mtsi)) ;

        $('#slipgrossprmtonrendorsement').val(amountToString(sum));
        $('#msisharefromendorsement').val(amountToString(sumourshare));
        $('#msisumsharevendorsement').val(amountToString(sumourshare));
        
        $('#slipsumorendorsement').val(amountToString(sumor));
     });

     $('#slipcommissionendorsement').keyup(function () {
        var commision =  parseFloat($(this).val()) / 100;
        var sumgrossprmtonr = $("#slipgrossprmtonrendorsement").val();
        var conv_sumgrossprmtonr = parseInt(sumgrossprmtonr.replace(/,/g, ""));
        
        var sum = isNaN(commision * parseFloat(conv_sumgrossprmtonr)) ? 0 :(commision * parseFloat(conv_sumgrossprmtonr));
        var real_sum = sum.toString();


        var sumnetprmtonr = isNaN( parseFloat(conv_sumgrossprmtonr) * (100/100 - commision)) ? 0 :(parseFloat(conv_sumgrossprmtonr) * (100/100 - commision));
        var real_sumnetprmtonr = sumnetprmtonr.toString();
        console.log('sum '+ sum)
        console.log('sumnetprmtonr '+ sumnetprmtonr)

        $('#slipsumcommissionendorsement').val(amountToString(sum));
        $('#slipnetprmtonrendorsement').val(amountToString(sumnetprmtonr));
    });

    $('#slipippercentageendorsement').keyup(function () {
        var percent =  parseFloat($(this).val()) / 100;
        
        var sumnetprtonr = $("#slipnetprmtonrendorsement").val();
        var conv_sumnetprtonr = parseFloat(sumnetprtonr.replace(/,/g, ""));

        var sum = isNaN(percent *  parseFloat(conv_sumnetprtonr)) ? 0 :(percent *  parseFloat(conv_sumnetprtonr));
        var real_sum = sum.toString();

        $('#slipipamountendorsement').val(floatToString(parseFloat(sum).toFixed(2)));
    });

    $('#sliporendorsement').keyup(function () {
        var percent =  parseFloat($(this).val()) / 100;
        var sumshare = $("#slipsumshareendorsement").val();
        var conv_sumshare = parseInt(sumshare.replace(/,/g, ""));

        var sum = isNaN(percent * parseFloat(conv_sumshare)) ? 0 :(percent * parseFloat(conv_sumshare));
        var real_sum = sum.toString();

        $('#slipsumorendorsement').val(amountToString(sum));
    });

    $('#sliprppercentageendorsement').keyup(function () {
        var percentval =  parseFloat($(this).val()) / 100;
        var sumor = $('#slipsumorendorsement').val() ;
        var conv_sumor = parseInt(sumor.replace(/,/g, ""));
        var sumrpamount = isNaN(percentval * parseFloat(conv_sumor)) ? 0 :(percentval * parseFloat(conv_sumor));
        var real_sumrpamount = sumrpamount.toString();

        // var sumpercentor = isNaN(orpercent - percentval) ? 0 :(orpercent - percentval); 
        // $('#slipor').val(sumpercentor);
        $('#sliprpamountendorsement').val(amountToString(sumrpamount));
    });

    $('#sliprppercentageendorsement').change(function () {
        var percentval =  parseFloat($(this).val());
        var orpercent = parseFloat($('#sliporendorsement').val());
        var sumpercentor = isNaN(orpercent - percentval) ? 0 :(orpercent - percentval);
        $('#sliporendorsement').val(sumpercentor);
    });
</script>

<!-- start perhitungan update -->
<script type="text/javascript">
    $('#sliptypetsiupdate').change(function(){
        var choice = $(this).val();
        var valtsi = $('#mcshareto').val();
        var valcedshare = $('#mcshare').val();
        var insuredid = $('#mcnumber').val(); 
        var cedbrok = $('#slipcedingbrokerupdate').val();
        var ceding = $('#slipcedingupdate').val();

        if(choice == '1')
        {
            if(valtsi == null)
            {
                swal('warning','please fill tsi insured value first','error')
            }
            else
            {
                
                var tsi = $('#mcshareto').val();
                var int_tsi = parseInt(tsi.replace(/,/g, ""));
                var conv_str_tsi = int_tsi;
                var real_tsi = conv_str_tsi.toString();
                $('#sliptotalsumupdate').val(real_tsi);
                $('#sliptotalsumupdate2').val(real_tsi);

                var tsislip = $('#sliptotalsumupdate').val();
                var pctval = $('#slippctupdate').val();

                if(pctval != null){
                    var pct =  parseFloat($('#slippctupdate').val())/100;
                    var conv_tsi = parseFloat(tsi.replace(/,/g, ""));

                    var sum = isNaN(pct * conv_tsi) ? 0 :(pct * conv_tsi) ;
                    console.log('sum ' + sum)
                    var conv_sum = amountToString(sum);
                    console.log('conv_sum' + conv_sum)
                    var real_sum = conv_sum.toString();
                    
                    console.log('real_sum' + real_sum)

                    $('#sliptotalsumpctupdate').val(amountToString(sum));
                    $('#sliptotalsumpctupdate2').val(amountToString(sum));
                    // swal('success','changed to tsi','success')


                    var dpamount = $('#slipdpamountupdate').val();
                    var ecamount = $('#slipamountecupdate').val();

                    if(dpamount != null){

                        var percent =  parseFloat($('#slipdppercentageupdate').val()) / 100;
                        
                        var sum = isNaN(percent * conv_tsi) ? 0 :(percent * conv_tsi) ;
                        var real_sum = sum.toString();
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
            if(cedbrok != null && ceding != null)
            {
                // var ceding_share = $('#feshare').val();
                // var int_ceding_share = parseInt(ceding_share.replace(/,/g, ""));
                // var conv_ceding_share = int_ceding_share;
                // var real_ceding_share = conv_ceding_share.toString();
                
                $.ajax({
                    type:"GET",
                    url:"{{url('get-ceding-detail')}}?slip_type=mc&ceding_id="+ceding+"&insured_id="+insuredid,
                    beforeSend: function() { $("body").addClass("loading");  },
                    complete: function() {  $("body").removeClass("loading"); },
                    success:function(res){  
                        console.log(res)      
                        if(res.type == 4)
                        {
                            // $("#slipceding option").remove();


                            // $("#slipceding").append('<option value="'+res.id+'">'+res.type+' - '+res.code+' - '+res.name+'</option>');

                            var ceding_curr = $('#slipcedingupdate').val();
                            var totalsum = $("#sliptotalsumupdate").val();
                            if(res.amountlist > 0)
                            {
                                console.log('sum amount ' + res.sumamount)
                                var sum = res.sumamount;
                                var conv_sum = amountToString(sum);
                                var real_sum = conv_sum.toString();
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
                                    var real_sum = sum.toString();
                                    $('#sliptotalsumpctupdate').val(amountToString(sum));
                                    $('#sliptotalsumpctupdate2').val(amountToString(sum));
                                    // swal('success','changed to ceding share','success')

                                    var dpamount = $('#slipdpamountupdate').val();
                                    var ecamount = $('#slipamountecupdate').val();

                                    if(dpamount != null){
                                        var percent =  parseFloat($('#slipdppercentageupdate').val()) / 100;
                                        
                                        var sum = isNaN(percent * conv_tsi) ? 0 :(percent * conv_tsi) ;
                                        var real_sum = sum.toString();
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
                        }
                        else
                        {
                            // $("#slipceding option").remove();
                            // $("#slipceding").append('<option value="#" selected disabled> select ceding </option>');
                            // $("#sliptotalsum").val('');
                            // $("#sliptotalsum2").val('');
                            // $.each(res,function(key,value){
                            //     $("#slipceding").append('<option value="'+value.id+'">'+value.type+' - '+value.code+' - '+value.name+'</option>');

                            // });
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

            var tsi = $('#mcshareto').val();
            var int_tsi = parseInt(tsi.replace(/,/g, ""));
            var conv_str_tsi = int_tsi;
            var real_tsi = conv_str_tsi.toString();
            $('#sharetotalsumupdate').val(amountToString(int_tsif));
            $('#sharetotalsumupdate2').val(amountToString(int_tsif));

            var shareslipval = $('#slipshareupdate').val();
            if(shareslipval != null){
                var shareslip =  parseFloat($('#slipshareupdate').val()) / 100 ;
                var conv_tsi = parseInt(tsi.replace(/,/g, ""));
                var sumshare =isNaN( shareslip * conv_tsi) ? 0 :( shareslip * conv_tsi) ;
                var real_sumshare = sumshare.toString();


                $('#slipsumshareupdate').val(amountToString(sumshare));
                $('#slipsumshareupdate2').val(amountToString(sumshare));

                var rateslipval = $('#sliprateupdate').val();

                if(rateslipval != null){

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
                    var conv_totalrate = parseInt(sumrate.replace(/,/g, ""));
                    var sumrate = isNaN(((conv_totalrate / 100) * conv_tsi) * insurance) ? 0 :(((conv_totalrate / 100) * conv_tsi) * insurance) ;
                    var real_sumrate = sumrate.toString();

                    $('#slipbasicpremiumupdate').val(amountToString(sumrate));

                    var grossprm_to_nr = $('#slipgrossprmtonrupdate').val();

                    if(grossprm_to_nr != null){
                        var nasionalreinsurance =  $('#mcsharefromupdate').val();
                        var totalnre =  $('#mcsharetoupdate').val();
                        var conv_totalnre =  parseInt(totalnre.replace(/,/g, ""));

                        console.log('nre' + nasionalreinsurance)
                            // console.log(conv_nasionalreinsurance)
                            console.log('totalnre' + totalnre)
                            console.log('convtotnre' + conv_totalnre)
                            
                            var sumshare2 = $('#slipsumshareupdate').val() ;
                            var conv_sumshare = parseInt(sumshare2.replace(/,/g, ""));
                            var basic_premium = $('#slipbasicpremiumupdate').val();
                            var conv_basre = parseInt(basic_premium.replace(/,/g, ""));

                            var orpercent = $('#sliporupdate').val() / 100;

                            var sumor = isNaN(orpercent * conv_sumshare) ? 0 :(orpercent * conv_sumshare);
                            var real_sumor = sumor.toString();
                            
                            var sumgrtoprm = isNaN(conv_basre * shareslip) ? 0 :(conv_basre * shareslip );
                            var real_sumgrtoprm = sumgrtoprm.toString();
                            
                            if(nasionalreinsurance){
                                var conv_nasionalreinsurance =  parseInt(nasionalreinsurance.replace(/,/g, ""));
                                var sumnre = isNaN(conv_nasionalreinsurance + conv_sumshare ) ? 0 :(conv_nasionalreinsurance + conv_sumshare) ;
                                var real_sumnre = sumnre.toString();
                            }else{
                                var conv_nasionalreinsurance =  parseInt(nasionalreinsurance.replace(/,/g, ""));
                                var sumnre = isNaN(0 + conv_sumshare ) ? 0 :(0 + conv_sumshare) ;
                                var real_sumnre = sumnre.toString();
                            }
                            
                            
                            var sumourshare = isNaN((sumnre / conv_totalnre) * 100 ) ? 0 :((sumnre / conv_totalnre) * 100 ) ;

                            console.log('sumnre' + sumnre)
                            console.log('realnre' + real_sumnre)
                            console.log('sumourshare' + sumourshare)

                            $('#slipgrossprmtonrupdate').val(amountToString(sumgrtoprm));
                            $('#slipgrossprmtonrupdate2').val(amountToString(sumgrtoprm));
                            $('#slipsumorupdate').val(amountToString(sumor));
                            $('#slipsumorupdate2').val(amountToString(sumor));
                            // $('#mcshare').val(sumourshare.replace(/,/g, "."));
                            $('#mcsharefromupdate').val(amountToString(sumnre));


                            var commision =  parseFloat($(this).val()) / 100;
                            var feebroker = parseFloat($('#slipvbrokerupdate').val()) / 100;
                            var sumgrossprmtonr2 = $("#slipgrossprmtonrupdate").val();
                            var conv_sumgrossprmtonr = parseInt(sumgrossprmtonr2.replace(/,/g, ""));

                            var sumcomm = isNaN(commision * conv_sumgrossprmtonr) ? 0 :(commision * conv_sumgrossprmtonr);
                            var real_sumcomm = sumcomm.toString();

                            $('#slipsumcommissionupdate').val(amountToString(sumcomm));
                            $('#slipsumcommissionupdate2').val(amountToString(sumcomm));

                            var sumgrossprmtonr3 = $("#slipgrossprmtonrupdate").val();
                            var conv_sumgrossprmtonr2 = parseInt(sumgrossprmtonr3.replace(/,/g, ""));

                            var sumnetprmtonr = isNaN( conv_sumgrossprmtonr2 * (100/100 - commision - feebroker)) ? 0 :(conv_sumgrossprmtonr2 * (100/100 - commision - feebroker));
                            var real_sumnetprmtonr = sumnetprmtonr.toString();

                            var sumfeebroker = isNaN( conv_sumgrossprmtonr2 * feebroker) ? 0 :(conv_sumgrossprmtonr2 * feebroker);
                            var real_sumfeebroker = sumfeebroker.toString();


                            $('#slipnetprmtonrupdate').val(amountToString(sumnetprmtonr));
                            $('#slipnetprmtonrupdate2').val(amountToString(sumnetprmtonr));
                            // $('#slipsumfee').val("100" + "-" + commision.toString() + "-" + feebroker.toString() + "*" + conv_sumgrossprmtonr.toString());
                            $('#slipsumfeeupdate').val(amountToString(sumfeebroker));
                            $('#slipsumfeeupdate2').val(amountToString(sumfeebroker));

                            var sumipamountval = $('#slipipamountupdate').val();

                            if(sumipamountval != null){
                                var percent =  parseFloat($(this).val()) / 100;

                                var sumnetprtonr2 = $("#slipnetprmtonr").val();
                                var conv_sumnetprtonr = parseInt(sumnetprtonr2.replace(/,/g, ""));

                                var sumipamount = isNaN(percent *  conv_sumnetprtonr) ? 0 :(percent *  conv_sumnetprtonr);
                                var real_sumipamount = sumipamount.toString();

                                $('#slipipamountupdate').val(amountToString(sumipamount));
                                $('#slipipamountupdate2').val(amountToString(sumipamount));
                            }

                    }



                }

            }

            // swal('warning!','change to tsi please change installment and retrocession amount manually','success')
        }else if(choice == '2')
        {

            var insuredid = $('#mcnumber').val(); 
            var cedbrok = $('#slipcedingbrokerupdate').val();
            var ceding = $('#slipcedingupdate').val();
            if(cedbrok != null && ceding != null){
                $.ajax({
                    type:"GET",
                    url:"{{url('get-ceding-detail')}}?slip_type=mc&ceding_id="+ceding+"&insured_id="+insuredid,
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
                                var conv_sum = amountToString(sum);
                                var real_sum = conv_sum.toString();
                                $("#sharetotalsumupdate").val(amountToString(sum));
                                $("#sharetotalsumupdate2").val(amountToString(sum));
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
            var tsi = $('#mcshare').val();
            $('#sharetotalsumupdate').val(tsi);
            $('#sharetotalsumupdate2').val(tsi);

            var shareslipval = $('#slipshareupdate').val();
            if(shareslipval != null){
                var shareslip =  parseFloat($('#slipshareupdate').val()) / 100 ;
                var conv_tsi = parseInt(tsi.replace(/,/g, ""));
                var sumshare =isNaN( shareslip * conv_tsi) ? 0 :( shareslip * conv_tsi) ;
                var real_sumshare = sumshare.toString();


                $('#slipsumshareupdate').val(amountToString(sumshare));
                $('#slipsumshareupdate2').val(amountToString(sumshare));

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

                    var rateslip =  parseFloat($(this).val());
                     var totalrate = $("#sliptotalrateupdate").val();
                    var conv_totalrate = parseInt(sumrate.replace(/,/g, ""));
                    var sumrate = isNaN(((conv_totalrate / 100) * conv_tsi) * insurance) ? 0 :(((conv_totalrate / 100) * conv_tsi) * insurance) ;
                    var real_sumrate = sumrate.toString();

                    $('#slipbasicpremiumupdate').val(amountToString(sumrate));

                    var grossprm_to_nr = $('#slipgrossprmtonrupdate').val();

                    if(grossprm_to_nr != null){
                        var nasionalreinsurance =  $('#mcsharefrom').val();
                        var totalnre =  $('#mcshareto').val();
                        var conv_totalnre =  parseInt(totalnre.replace(/,/g, ""));

                        console.log('nre' + nasionalreinsurance)
                            // console.log(conv_nasionalreinsurance)
                            console.log('totalnre' + totalnre)
                            console.log('convtotnre' + conv_totalnre)
                            
                            var sumshare2 = $('#slipsumshareupdate').val() ;
                            var conv_sumshare = parseInt(sumshare2.replace(/,/g, ""));
                            var basic_premium = $('#slipbasicpremiumupdate').val();
                            var conv_basre = parseInt(basic_premium.replace(/,/g, ""));

                            var orpercent = $('#sliporupdate').val() / 100;

                            var sumor = isNaN(orpercent * conv_sumshare) ? 0 :(orpercent * conv_sumshare);
                            var real_sumor = sumor.toString();
                            
                            var sumgrtoprm = isNaN(conv_basre * shareslip) ? 0 :(conv_basre * shareslip );
                            var real_sumgrtoprm = sumgrtoprm.toString();
                            
                            if(nasionalreinsurance){
                                var conv_nasionalreinsurance =  parseInt(nasionalreinsurance.replace(/,/g, ""));
                                var sumnre = isNaN(conv_nasionalreinsurance + conv_sumshare ) ? 0 :(conv_nasionalreinsurance + conv_sumshare) ;
                                var real_sumnre = sumnre.toString();
                            }else{
                                var conv_nasionalreinsurance =  parseInt(nasionalreinsurance.replace(/,/g, ""));
                                var sumnre = isNaN(0 + conv_sumshare ) ? 0 :(0 + conv_sumshare) ;
                                var real_sumnre = sumnre.toString();
                            }
                            
                            
                            var sumourshare = isNaN((sumnre / conv_totalnre) * 100 ) ? 0 :((sumnre / conv_totalnre) * 100 ) ;

                            console.log('sumnre' + sumnre)
                            console.log('realnre' + real_sumnre)
                            console.log('sumourshare' + sumourshare)

                            $('#slipgrossprmtonrupdate').val(amountToString(sumgrtoprm));
                            $('#slipgrossprmtonrupdate2').val(amountToString(sumgrtoprm));
                            $('#slipsumorupdate').val(amountToString(sumor));
                            $('#slipsumorupdate2').val(amountToString(sumor));
                            // $('#mcshare').val(sumourshare.replace(/,/g, "."));
                            $('#mcsharefromupdate').val(amountToString(sumnre));


                            var commision =  parseFloat($(this).val()) / 100;
                            var feebroker = parseFloat($('#slipvbrokerupdate').val()) / 100;
                            var sumgrossprmtonr2 = $("#slipgrossprmtonrupdate").val();
                            var conv_sumgrossprmtonr = parseInt(sumgrossprmtonr2.replace(/,/g, ""));

                            var sumcomm = isNaN(commision * conv_sumgrossprmtonr) ? 0 :(commision * conv_sumgrossprmtonr);
                            var real_sumcomm = sumcomm.toString();

                            $('#slipsumcommissionupdate').val(amountToString(sumcomm));
                            $('#slipsumcommissionupdate2').val(amountToString(sumcomm));

                            var sumgrossprmtonr3 = $("#slipgrossprmtonrupdate").val();
                            var conv_sumgrossprmtonr2 = parseInt(sumgrossprmtonr3.replace(/,/g, ""));

                            var sumnetprmtonr = isNaN( conv_sumgrossprmtonr2 * (100/100 - commision - feebroker)) ? 0 :(conv_sumgrossprmtonr2 * (100/100 - commision - feebroker));
                            var real_sumnetprmtonr = sumnetprmtonr.toString();

                            var sumfeebroker = isNaN( conv_sumgrossprmtonr2 * feebroker) ? 0 :(conv_sumgrossprmtonr2 * feebroker);
                            var real_sumfeebroker = sumfeebroker.toString();


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
                                var real_sumipamount = sumipamount.toString();

                                $('#slipipamountupdate').val(amountToString(sumipamount));
                                $('#slipipamountupdate2').val(amountToString(sumipamount));
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

            var tsi = $("#sliptotalsumupdate").val();
            var conv_tsi = parseFloat(tsi.replace(/,/g, ""));

            var sum = isNaN(pct * conv_tsi) ? 0 :(pct * conv_tsi) ;
            console.log(sum)
            var real_sum = sum.toString();
            $('#sliptotalsumpctupdate').val(amountToString(sum));
            $('#sliptotalsumpctupdate2').val(amountToString(sum));
        }
    });

   $('#slipdppercentageupdate').keyup(function (e) {
        if(e.keyCode != 9){
            var percent =  parseFloat($(this).val()) / 100;
            var tsi = $("#sliptotalsumupdate").val();
            var conv_tsi = parseFloat(tsi.replace(/,/g, ""));
            var sum = isNaN(percent * conv_tsi) ? 0 :(percent * conv_tsi) ;
            var real_sum = sum.toString();
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
            calculateShareNr('update')
        }
    });



   $('#sliprateupdate').keyup(function (e) {
        if(e.keyCode != 9){
            calculateBasicPremium('update')            
        }else{
            calculateBasicPremium('update')
        }
    });


    $("#slipbasicpremiumupdate").keyup(function(e) { 
        var keyCode = e.keyCode || e.which; 

        if(e.keyCode != 9){
            calculateRate('update')            
        }else{
            calculateRate('update')
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
                calculateShareNr('update')
            }
        }
    });

   $('#slipcommissionupdate').keyup(function (e) {
        var keyCode = e.keyCode || e.which;

        
        if(e.keyCode != 9){
            calculateComm('update')            
        }else{
            calculateComm('update')
        }  
    });

   $('#slipcommissionupdate').keydown(function (e) {
        var keyCode = e.keyCode || e.which;
        if(e.keyCode != 9){
            calculateComm('update')            
        }else{
            calculateComm('update')
        }  
    });

   $('#slipcommissionupdate').keypress(function (e) {
        var keyCode = e.keyCode || e.which;
        if(e.keyCode != 9){
            calculateComm('update')            
        }else{
            calculateComm('update')
        } 

    });

   $('#slipsumcommissionupdate2').keyup(function(e){
        var keyCode = e.keyCode || e.which; 

        if(e.keyCode != 9){
            calculatePercentComm('update')            
        }else{
            calculatePercentComm('update')
        } 
   });

   $('#slipsumcommissionupdate2').keydown(function(e){
        var keyCode = e.keyCode || e.which; 

        if(e.keyCode != 9){
            calculatePercentComm('update')            
        }else{
            calculatePercentComm('update')
        } 
   });

   $('#slipsumcommissionupdate2').keypress(function(e){
        var keyCode = e.keyCode || e.which; 

        if(e.keyCode != 9){
            calculatePercentComm('update')            
        }else{
            calculatePercentComm('update')
        } 
   });




   $('#slipvbrokerupdate').keyup(function(e){
        var keyCode = e.keyCode || e.which; 

        if(e.keyCode != 9){
            calculateFee('update')            
        }else{
            calculateFee('update')
        } 
    });

   $('#slipvbrokerupdate').keydown(function(e){
            var keyCode = e.keyCode || e.which; 

        if(e.keyCode != 9){
            calculateFee('update')            
        }else{
            calculateFee('update')
        } 
    });

   $('#slipvbrokerupdate').keypress(function(e){
            var keyCode = e.keyCode || e.which; 

        if(e.keyCode != 9){
            calculateFee('update')            
        }else{
            calculateFee('update')
        } 
    });
 

   $('#slipsumfeeupdate2').keyup(function(e){
        var keyCode = e.keyCode || e.which; 

        if(e.keyCode != 9){
            calculateFee('update')            
        }else{
            calculateFee('update')
        } 
   });

   $('#slipsumfeeupdate2').keydown(function(e){
        var keyCode = e.keyCode || e.which; 

        if(e.keyCode != 9){
            calculateFee('update')            
        }else{
            calculateFee('update')
        } 
   });

   $('#slipsumfeeupdate2').keypress(function(e){
        var keyCode = e.keyCode || e.which; 

        if(e.keyCode != 9){
            calculateFee('update')            
        }else{
            calculateFee('update')
        } 
   });

    $('#slipvbrokerupdate').change(function(){

        if( $('#installmentPanelUpdate tbody').find('tr').val().length > 0){
            swal('warning!','netprm to nr changed, please change installment amount manually','success')
        }

   });

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
            var real_sum = sum.toString();

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
    if(e.keyCode != 9){
        var percentval =  parseFloat($(this).val()) / 100;
        var sumshare = $('#slipsumshareupdate').val() ;
        var conv_sumshare = parseFloat(sumshare.replace(/,/g, ""));
        var sumrpamount = isNaN(percentval * conv_sumshare) ? 0 :(percentval * conv_sumshare);
        var real_sumrpamount = sumrpamount.toString();

            // var sumpercentor = isNaN(orpercent - percentval) ? 0 :(orpercent - percentval); 
            // $('#slipor').val(sumpercentor);
            $('#sliprpamountupdate').val(amountToString(sumrpamount));
            $('#sliprpamountupdate2').val(amountToString(sumrpamount));
        }
    });

   $('#sliprppercentageupdate').change(function (e) {
        if(e.keyCode != 9){
            var percentval =  parseFloat($(this).val());
            var orpercent = parseFloat($('#sliporupdate').val());
            var sumpercentor = isNaN(orpercent - percentval) ? 0 :(orpercent - percentval);
            $('#sliporupdate').val(sumpercentor);

            var percent =  parseFloat($('#sliporupdate').val()) / 100;
            var sumshare = $("#slipsumshareupdate").val();
            var conv_sumshare = parseFloat(sumshare.replace(/,/g, ""));

            var sum = isNaN(percent * conv_sumshare) ? 0 :(percent * conv_sumshare);
            var real_sum = sum.toString();

            $('#slipsumorupdate').val(amountToString(sum));
            $('#slipsumorupdate2').val(amountToString(sum));
        }
    });

   $('#slipnilaiecupdate').keyup(function () {
        var persentage =  parseFloat($('#slipnilaiecupdate').val()) / 1000;
        var sliptotalsum =  $('#sliptotalsumupdate').val();
        var conv_sliptotalsum = parseFloat(sliptotalsum.replace(/,/g, ""));
       //alert(premiumnr);
       //alert(persentage);
        var sum = isNaN(conv_sliptotalsum * persentage) ? 0 :(conv_sliptotalsum * persentage) ;
        var real_sum = sum.toString();
       //alert(sum);
        console.log($(this).val())
        console.log(persentage)
        console.log(sum)
        console.log(real_sum)

        $('#slipamountecupdate').val(amountToString(sum));
        $('#slipamountecupdate2').val(amountToString(sum));
   });
</script>






<!-- start perhitungan endorsem -->
<script type="text/javascript">
    $('#sliptypetsiendorsement').change(function(){
        var choice = $(this).val();
        var valtsi = $('#mcshareto').val();
        var valcedshare = $('#mcshare').val();
        var insuredid = $('#mcnumber').val(); 
        var cedbrok = $('#slipcedingbrokerendorsement').val();
        var ceding = $('#slipcedingendorsement').val();

        if(choice == '1'){
            if(valtsi == null){
                swal('warning','please fill tsi insured value first','error')
            }else{
                
                var tsi = $('#mcshareto').val();
                var int_tsi = parseInt(tsi.replace(/,/g, ""));
                var conv_str_tsi = int_tsi;
                var real_tsi = conv_str_tsi.toString();
                $('#sliptotalsumendorsement').val(real_tsi);
                $('#sliptotalsumendorsement2').val(real_tsi);

                var tsislip = $('#sliptotalsumendorsement').val();
                var pctval = $('#slippctendorsement').val();

                if(pctval != null){
                    var pct =  parseFloat($('#slippctendorsement').val())/100;
                    var conv_tsi = parseFloat(tsi.replace(/,/g, ""));

                    var sum = isNaN(pct * conv_tsi) ? 0 :(pct * conv_tsi) ;
                    console.log('sum ' + sum)
                    var conv_sum = amountToString(sum);
                    console.log('conv_sum' + conv_sum)
                    var real_sum = conv_sum.toString();
                    
                    console.log('real_sum' + real_sum)

                    $('#sliptotalsumpctendorsement').val(amountToString(sum));
                    $('#sliptotalsumpctendorsement2').val(amountToString(sum));
                    // swal('success','changed to tsi','success')


                    var dpamount = $('#slipdpamountendorsement').val();
                    var ecamount = $('#slipamountecendorsement').val();

                    if(dpamount != null){

                        var percent =  parseFloat($('#slipdppercentageendorsement').val()) / 100;
                        
                        var sum = isNaN(percent * conv_tsi) ? 0 :(percent * conv_tsi) ;
                        var real_sum = sum.toString();
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
                // var ceding_share = $('#feshare').val();
                // var int_ceding_share = parseInt(ceding_share.replace(/,/g, ""));
                // var conv_ceding_share = int_ceding_share;
                // var real_ceding_share = conv_ceding_share.toString();
                
                $.ajax({
                    type:"GET",
                    url:"{{url('get-ceding-detail')}}?slip_type=mc&ceding_id="+ceding+"&insured_id="+insuredid,
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
                                var conv_sum = amountToString(sum);
                                var real_sum = conv_sum.toString();
                                $("#sliptotalsumendorsement").val(amountToString(sum));
                                $("#sliptotalsumendorsement2").val(amountToString(sum));

                                var tsicedshare = $("#sliptotalsumendorsement").val();
                                var pctval = $('#sliptotalsumpctendorsement').val();

                                if(pctval != null){

                                    var pct =  parseFloat($('#slippctendorsement').val())/100;

                                    // var tsi = $("#sliptotalsum").val();
                                    var conv_tsi = parseInt(tsicedshare.replace(/,/g, ""));

                                    var sum = isNaN(pct * conv_tsi) ? 0 :(pct * conv_tsi) ;
                                    console.log(sum)
                                    var real_sum = sum.toString();
                                    $('#sliptotalsumpctendorsement').val(amountToString(sum));
                                    $('#sliptotalsumpctendorsement2').val(amountToString(sum));
                                    // swal('success','changed to ceding share','success')

                                    var dpamount = $('#slipdpamountendorsement').val();
                                    var ecamount = $('#slipamountecendorsement').val();

                                    if(dpamount != null){
                                        var percent =  parseFloat($('#slipdppercentageendorsement').val()) / 100;
                                        
                                        var sum = isNaN(percent * conv_tsi) ? 0 :(percent * conv_tsi) ;
                                        var real_sum = sum.toString();
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
                            // $("#slipceding option").remove();
                            // $("#slipceding").append('<option value="#" selected disabled> select ceding </option>');
                            // $("#sliptotalsum").val('');
                            // $("#sliptotalsum2").val('');
                            // $.each(res,function(key,value){
                            //     $("#slipceding").append('<option value="'+value.id+'">'+value.type+' - '+value.code+' - '+value.name+'</option>');

                            // });
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

            var tsi = $('#mcshareto').val();
            var int_tsi = parseInt(tsi.replace(/,/g, ""));
            var conv_str_tsi = int_tsi;
            var real_tsi = conv_str_tsi.toString();
            $('#sharetotalsumendorsement').val(real_tsi);
            $('#sharetotalsumendorsement2').val(real_tsi);

            var shareslipval = $('#slipshareendorsement').val();
            if(shareslipval != null){
                var shareslip =  parseFloat($('#slipshareendorsement').val()) / 100 ;
                var conv_tsi = parseInt(tsi.replace(/,/g, ""));
                var sumshare =isNaN( shareslip * conv_tsi) ? 0 :( shareslip * conv_tsi) ;
                var real_sumshare = sumshare.toString();


                $('#slipsumshareendorsement').val(amountToString(sumshare));
                $('#slipsumshareendorsement2').val(amountToString(sumshare));

                var rateslipval = $('#sliprateendorsement').val();

                if(rateslipval != null){

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

                    var rateslip =  parseFloat($(this).val()) ;
                    var totalrate = $("#sliptotalrateendorsement").val();
                    var conv_totalrate = parseInt(sumrate.replace(/,/g, ""));
                    var sumrate = isNaN(((conv_totalrate / 100) * conv_tsi) * insurance) ? 0 :(((conv_totalrate / 100) * conv_tsi) * insurance) ;
                    var real_sumrate = sumrate.toString();

                    $('#slipbasicpremiumendorsement').val(amountToString(sumrate));

                    var grossprm_to_nr = $('#slipgrossprmtonrendorsement').val();

                    if(grossprm_to_nr != null){
                        var nasionalreinsurance =  $('#mcsharefromendorsement').val();
                        var totalnre =  $('#mcsharetoendorsement').val();
                        var conv_totalnre =  parseInt(totalnre.replace(/,/g, ""));

                        console.log('nre' + nasionalreinsurance)
                            // console.log(conv_nasionalreinsurance)
                            console.log('totalnre' + totalnre)
                            console.log('convtotnre' + conv_totalnre)
                            
                            var sumshare2 = $('#slipsumshareendorsement').val() ;
                            var conv_sumshare = parseInt(sumshare2.replace(/,/g, ""));
                            var basic_premium = $('#slipbasicpremiumendorsement').val();
                            var conv_basre = parseInt(basic_premium.replace(/,/g, ""));

                            var orpercent = $('#sliporendorsement').val() / 100;

                            var sumor = isNaN(orpercent * conv_sumshare) ? 0 :(orpercent * conv_sumshare);
                            var real_sumor = sumor.toString();
                            
                            var sumgrtoprm = isNaN(conv_basre * shareslip) ? 0 :(conv_basre * shareslip );
                            var real_sumgrtoprm = sumgrtoprm.toString();
                            
                            if(nasionalreinsurance){
                                var conv_nasionalreinsurance =  parseInt(nasionalreinsurance.replace(/,/g, ""));
                                var sumnre = isNaN(conv_nasionalreinsurance + conv_sumshare ) ? 0 :(conv_nasionalreinsurance + conv_sumshare) ;
                                var real_sumnre = sumnre.toString();
                            }else{
                                var conv_nasionalreinsurance =  parseInt(nasionalreinsurance.replace(/,/g, ""));
                                var sumnre = isNaN(0 + conv_sumshare ) ? 0 :(0 + conv_sumshare) ;
                                var real_sumnre = sumnre.toString();
                            }
                            
                            
                            var sumourshare = isNaN((sumnre / conv_totalnre) * 100 ) ? 0 :((sumnre / conv_totalnre) * 100 ) ;

                            console.log('sumnre' + sumnre)
                            console.log('realnre' + real_sumnre)
                            console.log('sumourshare' + sumourshare)

                            $('#slipgrossprmtonrendorsement').val(amountToString(sumgrtoprm));
                            $('#slipgrossprmtonrendorsement2').val(amountToString(sumgrtoprm));
                            $('#slipsumorendorsement').val(amountToString(sumor));
                            $('#slipsumorendorsement2').val(amountToString(sumor));
                            // $('#mcshare').val(sumourshare.replace(/,/g, "."));
                            $('#mcsharefromendorsement').val(amountToString(sumnre));


                            var commision =  parseFloat($(this).val()) / 100;
                            var feebroker = parseFloat($('#slipvbrokerendorsement').val()) / 100;
                            var sumgrossprmtonr2 = $("#slipgrossprmtonrendorsement").val();
                            var conv_sumgrossprmtonr = parseInt(sumgrossprmtonr2.replace(/,/g, ""));

                            var sumcomm = isNaN(commision * conv_sumgrossprmtonr) ? 0 :(commision * conv_sumgrossprmtonr);
                            var real_sumcomm = sumcomm.toString();

                            $('#slipsumcommissionendorsement').val(amountToString(sumcomm));
                            $('#slipsumcommissionendorsement2').val(amountToString(sumcomm));

                            var sumgrossprmtonr3 = $("#slipgrossprmtonrendorsement").val();
                            var conv_sumgrossprmtonr2 = parseInt(sumgrossprmtonr3.replace(/,/g, ""));

                            var sumnetprmtonr = isNaN( conv_sumgrossprmtonr2 * (100/100 - commision - feebroker)) ? 0 :(conv_sumgrossprmtonr2 * (100/100 - commision - feebroker));
                            var real_sumnetprmtonr = sumnetprmtonr.toString();

                            var sumfeebroker = isNaN( conv_sumgrossprmtonr2 * feebroker) ? 0 :(conv_sumgrossprmtonr2 * feebroker);
                            var real_sumfeebroker = sumfeebroker.toString();


                            $('#slipnetprmtonrendorsement').val(amountToString(sumnetprmtonr));
                            $('#slipnetprmtonrendorsement2').val(amountToString(sumnetprmtonr));
                            // $('#slipsumfee').val("100" + "-" + commision.toString() + "-" + feebroker.toString() + "*" + conv_sumgrossprmtonr.toString());
                            $('#slipsumfeeendorsement').val(amountToString(sumfeebroker));
                            $('#slipsumfeeendorsement2').val(amountToString(sumfeebroker));

                            var sumipamountval = $('#slipipamountendorsement').val();

                            if(sumipamountval != null){
                                var percent =  parseFloat($(this).val()) / 100;

                                var sumnetprtonr2 = $("#slipnetprmtonr").val();
                                var conv_sumnetprtonr = parseInt(sumnetprtonr2.replace(/,/g, ""));

                                var sumipamount = isNaN(percent *  conv_sumnetprtonr) ? 0 :(percent *  conv_sumnetprtonr);
                                var real_sumipamount = sumipamount.toString();

                                $('#slipipamountendorsement').val(amountToString(sumipamount));
                                $('#slipipamountendorsement2').val(amountToString(sumipamount));
                            }

                    }



                }

            }

            // swal('warning!','change to tsi please change installment and retrocession amount manually','success')
        }else if(choice == '2')
        {

            var insuredid = $('#mcnumber').val(); 
            var cedbrok = $('#slipcedingbrokerendorsement').val();
            var ceding = $('#slipcedingendorsement').val();
            if(cedbrok != null && ceding != null){
                $.ajax({
                    type:"GET",
                    url:"{{url('get-ceding-detail')}}?slip_type=mc&ceding_id="+ceding+"&insured_id="+insuredid,
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
                                var conv_sum = amountToString(sum);
                                var real_sum = conv_sum.toString();
                                $("#sharetotalsumendorsement").val(amountToString(sum));
                                $("#sharetotalsumendorsement2").val(amountToString(sum));
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
            var tsi = $('#mcshare').val();
            $('#sharetotalsumendorsement').val(tsi);
            $('#sharetotalsumendorsement2').val(tsi);

            var shareslipval = $('#slipshareendorsement').val();
            if(shareslipval != null){
                var shareslip =  parseFloat($('#slipshareendorsement').val()) / 100 ;
                var conv_tsi = parseInt(tsi.replace(/,/g, ""));
                var sumshare =isNaN( shareslip * conv_tsi) ? 0 :( shareslip * conv_tsi) ;
                var real_sumshare = sumshare.toString();


                $('#slipsumshareendorsement').val(amountToString(sumshare));
                $('#slipsumshareendorsement2').val(amountToString(sumshare));

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
                    var conv_totalrate = parseInt(sumrate.replace(/,/g, ""));
                    var sumrate = isNaN(((conv_totalrate / 100) * conv_tsi) * insurance) ? 0 :(((conv_totalrate / 100) * conv_tsi) * insurance) ;
                    var real_sumrate = sumrate.toString();

                    $('#slipbasicpremiumendorsement').val(amountToString(sumrate));

                    var grossprm_to_nr = $('#slipgrossprmtonrendorsement').val();

                    if(grossprm_to_nr != null){
                        var nasionalreinsurance =  $('#mcsharefrom').val();
                        var totalnre =  $('#mcshareto').val();
                        var conv_totalnre =  parseInt(totalnre.replace(/,/g, ""));

                        console.log('nre' + nasionalreinsurance)
                            // console.log(conv_nasionalreinsurance)
                            console.log('totalnre' + totalnre)
                            console.log('convtotnre' + conv_totalnre)
                            
                            var sumshare2 = $('#slipsumshareendorsement').val() ;
                            var conv_sumshare = parseInt(sumshare2.replace(/,/g, ""));
                            var basic_premium = $('#slipbasicpremiumendorsement').val();
                            var conv_basre = parseInt(basic_premium.replace(/,/g, ""));

                            var orpercent = $('#sliporendorsement').val() / 100;

                            var sumor = isNaN(orpercent * conv_sumshare) ? 0 :(orpercent * conv_sumshare);
                            var real_sumor = sumor.toString();
                            
                            var sumgrtoprm = isNaN(conv_basre * shareslip) ? 0 :(conv_basre * shareslip );
                            var real_sumgrtoprm = sumgrtoprm.toString();
                            
                            if(nasionalreinsurance){
                                var conv_nasionalreinsurance =  parseInt(nasionalreinsurance.replace(/,/g, ""));
                                var sumnre = isNaN(conv_nasionalreinsurance + conv_sumshare ) ? 0 :(conv_nasionalreinsurance + conv_sumshare) ;
                                var real_sumnre = sumnre.toString();
                            }else{
                                var conv_nasionalreinsurance =  parseInt(nasionalreinsurance.replace(/,/g, ""));
                                var sumnre = isNaN(0 + conv_sumshare ) ? 0 :(0 + conv_sumshare) ;
                                var real_sumnre = sumnre.toString();
                            }
                            
                            
                            var sumourshare = isNaN((sumnre / conv_totalnre) * 100 ) ? 0 :((sumnre / conv_totalnre) * 100 ) ;

                            console.log('sumnre' + sumnre)
                            console.log('realnre' + real_sumnre)
                            console.log('sumourshare' + sumourshare)

                            $('#slipgrossprmtonrendorsement').val(amountToString(sumgrtoprm));
                            $('#slipgrossprmtonrendorsement2').val(amountToString(sumgrtoprm));
                            $('#slipsumorendorsement').val(amountToString(sumor));
                            $('#slipsumorendorsement2').val(amountToString(sumor));
                            // $('#mcshare').val(sumourshare.replace(/,/g, "."));
                            $('#mcsharefromendorsement').val(amountToString(sumnre));


                            var commision =  parseFloat($(this).val()) / 100;
                            var feebroker = parseFloat($('#slipvbrokerendorsement').val()) / 100;
                            var sumgrossprmtonr2 = $("#slipgrossprmtonrendorsement").val();
                            var conv_sumgrossprmtonr = parseInt(sumgrossprmtonr2.replace(/,/g, ""));

                            var sumcomm = isNaN(commision * conv_sumgrossprmtonr) ? 0 :(commision * conv_sumgrossprmtonr);
                            var real_sumcomm = sumcomm.toString();

                            $('#slipsumcommissionendorsement').val(amountToString(sumcomm));
                            $('#slipsumcommissionendorsement2').val(amountToString(sumcomm));

                            var sumgrossprmtonr3 = $("#slipgrossprmtonrendorsement").val();
                            var conv_sumgrossprmtonr2 = parseInt(sumgrossprmtonr3.replace(/,/g, ""));

                            var sumnetprmtonr = isNaN( conv_sumgrossprmtonr2 * (100/100 - commision - feebroker)) ? 0 :(conv_sumgrossprmtonr2 * (100/100 - commision - feebroker));
                            var real_sumnetprmtonr = sumnetprmtonr.toString();

                            var sumfeebroker = isNaN( conv_sumgrossprmtonr2 * feebroker) ? 0 :(conv_sumgrossprmtonr2 * feebroker);
                            var real_sumfeebroker = sumfeebroker.toString();


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
                                var real_sumipamount = sumipamount.toString();

                                $('#slipipamountendorsement').val(amountToString(sumipamount));
                                $('#slipipamountendorsement2').val(amountToString(sumipamount));
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

            var tsi = $("#sliptotalsumendorsement").val();
            var conv_tsi = parseFloat(tsi.replace(/,/g, ""));

            var sum = isNaN(pct * conv_tsi) ? 0 :(pct * conv_tsi) ;
            console.log(sum)
            var real_sum = sum.toString();
            $('#sliptotalsumpctendorsement').val(floatToString(sum));
            $('#sliptotalsumpctendorsement2').val(floatToString(sum));
        }
    });

   $('#slipdppercentageendorsement').keyup(function (e) {
        if(e.keyCode != 9){
            var percent =  parseFloat($(this).val()) / 100;
            var tsi = $("#sliptotalsumendorsement").val();
            var conv_tsi = parseFloat(tsi.replace(/,/g, ""));
            var sum = isNaN(percent * conv_tsi) ? 0 :(percent * conv_tsi) ;
            var real_sum = sum.toString();
            console.log($(this).val())
            console.log(percent)
            console.log(sum)
            console.log(real_sum)

            $('#slipdpamountendorsement').val(floatToString(sum));
            $('#slipdpamountendorsement2').val(floatToString(sum));
        }
    });

   $('#slipshareendorsement').keyup(function (e) 
       {
        if(e.keyCode != 9){
            calculateShareNr('endorsement')
        }
    });



   $('#sliprateendorsement').keyup(function (e) {
        calculateBasicPremium('endorsement')   
    });


   $("#slipbasicpremiumendorsement").keyup(function(e) 
   { 
      
        calculateTotalRate('endorsement')

    });

   $('#slipshareendorsement').change(function (e) {
        calculateShareNr('endorsement')        
    });

   $('#slipcommissionendorsement').keyup(function (e) {
        calculateComm('endorsement')

    });

   $('#slipcommissionendorsement').keydown(function (e) {
        calculateComm('endorsement')        

    });

   $('#slipcommissionendorsement').keypress(function (e) {
        
        calculateComm('endorsement')
    });

   $('#slipsumcommissionendorsement2').keyup(function(e){
        calculatePercentComm('endorsement')

   });

   $('#slipsumcommissionendorsement2').keydown(function(e){
        calculatePercentComm('endorsement')

        
   });

   $('#slipsumcommissionendorsement2').keypress(function(e){
        calculatePercentComm('endorsement') 

        
   });




   $('#slipvbrokerendorsement').keyup(function(e){
        calculateFee('endorsement')


        
    });

   $('#slipvbrokerendorsement').keydown(function(e){
        calculateFee('endorsement')
        
    });

   $('#slipvbrokerendorsement').keypress(function(e){
        calculateFee('endorsement')

        
    });
 

   $('#slipsumfeeendorsement2').keyup(function(e){
        calculatePercentFee('endorsement')

        
   });

   $('#slipsumfeeendorsement2').keydown(function(e){
        calculatePercentFee('endorsement')

        
   });

   $('#slipsumfeeendorsement2').keypress(function(e){
        var keyCode = e.keyCode || e.which; 

        calculatePercentFee('endorsement')        
   });

    $('#slipvbrokerendorsement').change(function(){

        if( $('#installmentPanelendorsement tbody').find('tr').val().length > 0){
            swal('warning!','netprm to nr changed, please change installment amount manually','success')
        }

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
            var real_sum = sum.toString();

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
    if(e.keyCode != 9){
        var percentval =  parseFloat($(this).val()) / 100;
        var sumshare = $('#slipsumshareendorsement').val() ;
        var conv_sumshare = parseFloat(sumshare.replace(/,/g, ""));
        var sumrpamount = isNaN(percentval * conv_sumshare) ? 0 :(percentval * conv_sumshare);
        var real_sumrpamount = sumrpamount.toString();

            // var sumpercentor = isNaN(orpercent - percentval) ? 0 :(orpercent - percentval); 
            // $('#slipor').val(sumpercentor);
            $('#sliprpamountendorsement').val(amountToString(sumrpamount));
            $('#sliprpamountendorsement2').val(amountToString(sumrpamount));
        }
    });

   $('#sliprppercentageendorsement').change(function (e) {
        if(e.keyCode != 9){
            var percentval =  parseFloat($(this).val());
            var orpercent = parseFloat($('#sliporendorsement').val());
            var sumpercentor = isNaN(orpercent - percentval) ? 0 :(orpercent - percentval);
            $('#sliporendorsement').val(sumpercentor);

            var percent =  parseFloat($('#sliporendorsement').val()) / 100;
            var sumshare = $("#slipsumshareendorsement").val();
            var conv_sumshare = parseFloat(sumshare.replace(/,/g, ""));

            var sum = isNaN(percent * conv_sumshare) ? 0 :(percent * conv_sumshare);
            var real_sum = sum.toString();

            $('#slipsumorendorsement').val(amountToString(sum));
            $('#slipsumorendorsement2').val(amountToString(sum));
        }
    });

   $('#slipnilaiecendorsement').keyup(function () {
        var persentage =  parseFloat($('#slipnilaiecendorsement').val()) / 1000;
        var sliptotalsum =  $('#sliptotalsumendorsement').val();
        var conv_sliptotalsum = parseFloat(sliptotalsum.replace(/,/g, ""));
       //alert(premiumnr);
       //alert(persentage);
        var sum = isNaN(conv_sliptotalsum * persentage) ? 0 :(conv_sliptotalsum * persentage);
        var real_sum = sum.toString();
       //alert(sum);
        console.log($(this).val())
        console.log(persentage)
        console.log(sum)
        console.log(real_sum)

        $('#slipamountecendorsement').val(amountToString(sum));
        $('#slipamountecendorsement2').val(amountToString(sum));
   });
</script>


<!-- start crud table inner -->
<script type='text/javascript'>
    $('#adddeductibleinsured-btn').click(function(e){
       //alert('masuk');
           e.preventDefault();

           var slipdptype = $('#slipdptype').val();
           // var slipdpcurrency = $('#slipdpcurrency').val();
           
           var percentage = $('#slipdppercentage').val();
           var amount = $('#slipdpamount').val();
           var minamount = $('#slipdpminamount').val();
           var code_ms = $('#mcnumber').val();
           var sliptype = 'mc';
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

             console.log(response)
             if(response.success == false){
                swal("Warning",response.message,"warning");
             }else{
                //    var curr_amount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(response.amount);
                

                $('#deductiblePanel tbody').append('<tr id="iiddeductible'+response.id+'" data-name="deductiblevalue[]"><td data-name="'+response.deductibletype+'">'+response.deductibletype+'</td><td data-name="'+floatToString(response.percentage)+'">'+floatToString(response.percentage)+'</td><td data-name="'+amountToString(response.amount)+'">'+amountToString(response.amount)+'</td><td data-name="'+amountToString(response.min_claimamount)+'">'+amountToString(response.min_claimamount)+'</td><td><a href="javascript:void(0)" onclick="deletedeductibledetail('+response.id+')">delete</a></td></tr>');
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
       var insured_id = $('#mcnumber').val();
       var slip_type = "mc";
       
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
           success:function(response)
           {

                console.log(response)
               
                if(response.success==true)
                {
                    if(response.information == null)
                    {
                        $('#conditionNeeded tbody').prepend('<tr id="cnid'+response.id+'" data-name="conditionneededvalue[]"><td data-name="'+response.conditionneeded_id+'">'+response.condition+'</td><td data-name="'+response.information+'">-</td><td><a href="javascript:void(0)" onclick="deleteconditionneeded('+response.id+')">delete</a></td></tr>')
                    
                    }
                    else
                    {
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
       var code_ms = $('#mcnumber').val();
       var sliptype = 'mc';
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
                            var curr_amount = str_amount;

                            var currdate = response.installment_date;
                            var convdate = currdate.split("-").reverse().join("/");
                            console.log('conv date ' + convdate)
                            var strdate = convdate.toString();

                            var conv_percent = parseFloat(response.percentage);
                            
                            $('#installmentPanel tbody').append('<tr id="iidinstallment'+response.id+'" data-name="installmentvalue[]"><td data-name="'+response.installment_date+'">'+strdate+'</td><td data-name="'+floatToString(response.percentage)+'">'+floatToString(parseFloat(response.percentage).toFixed(2))+'</td><td data-name="'+amountToString(response.amount)+'">'+amountToString(response.amount)+'</td><td><a href="javascript:void(0)" onclick="deleteinstallmentdetail('+response.id+')">delete</a></td></tr>')
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
           }else{
                swal('warning!','installment cannot more than 100 %','validation error');
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

                if(total_percent2 < 100)
                {
                    $('#addinstallmentinsured-btn').attr('hidden','false');
                    $('#addinstallmentinsured-btn').removeAttr('hidden')
                }
            }
        });
    }
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
    $('#adddeductibleinsuredupdate-btn').click(function(e){
       //alert('masuk');
           e.preventDefault();

           var slipdptype = $('#slipdptypeupdate').val();
           // var slipdpcurrency = $('#slipdpcurrency').val();
           
           var percentage = $('#slipdppercentageupdate').val();
           var amount = $('#slipdpamountupdate').val();
           var minamount = $('#slipdpminamountupdate').val();
           var code_ms = $('#mcnumber').val();
           var sliptype = 'mc';
           var real_minamount = 0;
           if(minamount == ''){
               real_minamount = 0;
           }
           else{
            var conv_minamount = minamount.replace(/,/g, "");
            console.log(conv_minamount)
            real_minamount = parseInt(conv_minamount);
        }

        var slip_id = $('#slipnumberupdate').val();
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
                    var curr_amount = curr_amount2.toString();
                   
                    //    var curr_minamount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(response.min_claimamount);
                    var curr_minamount2 = parseFloat(response.min_claimamount.toString());
                    var curr_minamount = curr_minamount2.toString();

                    $('#deductiblePanelUpdate tbody').append('<tr id="iiddeductibleupdate'+response.id+'" data-name="deductiblevalue[]"><td data-name="'+response.deductibletype+'">'+response.deductibletype+'</td><td data-name="'+response.percentage+'">'+response.percentage+'</td><td data-name="'+response.amount+'">'+curr_amount+'</td><td data-name="'+curr_minamount+'">'+curr_minamount+'</td><td><a href="javascript:void(0)" onclick="deletedeductibleupdate('+response.id+')">delete</a></td></tr>');
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
       var insured_id = $('#mcnumber').val();
       var slip_type = "mc";
       
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
       var code_ms = $('#mcnumber').val();
       var sliptype = 'mc';
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
                            var curr_amount = str_amount;

                            var currdate = response.installment_date;
                            var convdate = currdate.split("-").reverse().join("/");
                            console.log('conv date ' + convdate)
                            var strdate = convdate.toString();

                            var conv_percent = parseFloat(response.percentage);
                            
                            $('#installmentPanelUpdate tbody').append('<tr id="iidinstallmentupdate'+response.id+'" data-name="installmentvalue[]"><td data-name="'+response.installment_date+'">'+response.installment_date+'</td><td data-name="'+floatToString(response.percentage)+'">'+floatToString(parseFloat(response.percentage).toFixed(2))+'</td><td data-name="'+amountToString(response.amount)+'">'+amountToString(response.amount)+'</td><td><a href="javascript:void(0)" onclick="deleteinstallmentupdate('+response.id+')">delete</a></td></tr>')
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
           }else{
                swal('warning!','installment cannot more than 100 %','validation error');
           }
   });
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
                var total_percent =  $('#sliptotalpercentinspan').val();
                        
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
       var code_ms = $('#mcnumber').val();
       var sliptype = 'mc'
       
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
                
                    var curr_amount = response.amount.toString();
                    console.log('response.percentage' + response.percentage)
                    $('#retrocessionPanelUpdate tbody').append('<tr id="iidretrocessionupdate'+response.id+'" data-name="retrocessionvalue[]"><td data-name="'+response.contract+'">'+response.contract+'</td><td data-name="'+floatToString(response.percentage)+'">'+floatToString(parseFloat(response.percentage).toFixed(2))+'</td><td data-name="'+amountToString(response.amount)+'">'+amountToString(response.amount)+'</td><td><a href="javascript:void(0)" onclick="deleteretrocessionupdate('+response.id+')">delete</a></td></tr>');
                    $('#sliprppercentageupdate').val('');
                    $('#sliprpamountupdate').val('');
                    $('#sliprpamountupdate2').val('');
                    var total_percent = $('#sliptotalpercentrporupdate').val();
                    var proses = parseInt(total_percent) + parseInt(response.percentage);
                    var sum_percent = isNaN(proses) ? 0 :(proses) ;
                    $('#sliptotalpercentrporupdate').val(sum_percent);
                    
                    var total_percent2 = $('#sliptotalpercentrporupdate').val();
                    console.log(total_percent2)
                    
                    if (parseFloat(total_percent2) >= 100) {
                        $("#addretrocessioninsuredupdate-btn").attr("hidden",true);
                    }
                    swal("Success!", response.message, "success")
                
                
                

            }

        }
    });

   });
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
    $('#adddeductibleinsuredendorsement-btn').click(function(e){
       // alert('masuk');
           e.preventDefault();

           var slipdptype = $('#slipdptypeendorsement').val();
           // var slipdpcurrency = $('#slipdpcurrency').val();
           
           var percentage = $('#slipdppercentageendorsement').val();
           var amount = $('#slipdpamountendorsement').val();
           var minamount = $('#slipdpminamountendorsement').val();
           var countendorsement = parseInt($('#countendorsmentdata').val())+1;
           var code_ms = $('#mcnumber').val();
           var sliptype = 'mc';
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
             countendorsement:countendorsement,
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
                var curr_amount2 = parseFloat(response.amount.toString());
                var curr_amount = curr_amount2.toString();
                   
                    //    var curr_minamount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(response.min_claimamount);
                var curr_minamount2 = parseFloat(response.min_claimamount.toString());
                var curr_minamount = curr_minamount2.toString();

                $('#deductiblePanelendorsement tbody').append('<tr id="iiddeductibleendorsement'+response.id+'" data-name="deductiblevalue[]"><td data-name="'+response.deductibletype+'">'+response.deductibletype+'</td><td data-name="'+response.percentage+'">'+response.percentage+'</td><td data-name="'+amountToString(response.amount)+'">'+amountToString(response.amount)+'</td><td data-name="'+amountToString(response.min_claimamount)+'">'+amountToString(response.min_claimamount)+'</td><td><a href="javascript:void(0)" onclick="deletedeductibleendorsement('+response.id+')">delete</a></td></tr>');
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
       var insured_id = $('#mcnumber').val();
       var slip_type = "mc";
       var countendorsement = parseInt($('#countendorsmentdata').val())+1;
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
                slip_type:slip_type,
                countendorsement:countendorsement
           },
           beforeSend: function() { $("body").addClass("loading");  },
           complete: function() {  $("body").removeClass("loading"); },
           success:function(response){

               console.log(response)
               
               if ( response.success) {
                if(response.information == null){
                    $('#conditionNeededendorsement tbody').prepend('<tr id="cnidendorsement'+response.id+'" data-name="conditionneededvalue[]"><td data-name="'+response.conditionneeded_id+'">'+response.condition+'</td><td data-name="'+response.information+'">-</td><td><a href="javascript:void(0)" onclick="deleteconditionneededendorsement('+response.id+')">delete</a></td></tr>')
                   
                   }else{
                    $('#conditionNeededendorsement tbody').prepend('<tr id="cnidendorsement'+response.id+'" data-name="conditionneededvalue[]"><td data-name="'+response.conditionneeded_id+'">'+response.condition+'</td><td data-name="'+response.information+'">'+response.information+'</td><td><a href="javascript:void(0)" onclick="deleteconditionneededendorsement('+response.id+')">delete</a></td></tr>')
                   
                   }
                   $(':input','#addconditionneededendorsement').not(':button, :submit, :reset, :hidden').val(' ').removeAttr('checked').removeAttr('selected');
               }
               
               
               
            
           }
       });

    });
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
       var countendorsement = parseInt($('#countendorsmentdata').val())+1;
       var installmentdate = $('#slipipdateendorsement').val();
       var percentage = $('#slipippercentageendorsement').val();
       var amount = $('#slipipamountendorsement').val();
       var slip_id = $('#slipnumberendorsement').val();
       var token2 = $('input[name=_token2]').val();
       var code_ms = $('#mcnumber').val();
       var sliptype = 'mc';
       var sumtotal_percent = $('#sliptotalpercentinspanendorsement').val();
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
                     countendorsement:countendorsement,
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
                            var curr_amount = str_amount;

                            var currdate = response.installment_date;
                            var convdate = currdate.split("-").reverse().join("/");
                            console.log('conv date ' + convdate)
                            var strdate = convdate.toString();

                            var conv_percent = parseFloat(response.percentage);
                            
                            $('#installmentPanelendorsement tbody').append('<tr id="iidinstallmentendorsement'+response.id+'" data-name="installmentvalue[]"><td data-name="'+response.installment_date+'">'+strdate+'</td><td data-name="'+response.percentage+'">'+floatToString(parseFloat(response.percentage).toFixed(2))+'</td><td data-name="'+amountToString(response.amount)+'">'+amountToString(response.amount)+'</td><td><a href="javascript:void(0)" onclick="deleteinstallmentendorsement('+response.id+')">delete</a></td></tr>')
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
           }else{
                swal('warning!','installment cannot more than 100 %','validation error');
           }
   });
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
                var total_percent =  $('#sliptotalpercentinspan').val();
                        
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
    $('#addretrocessioninsuredendorsement-btn').click(function(e){
       //alert('masuk');
       e.preventDefault();

       var type = $('#sliprptypeendorsement').val();
       var contract = $('#sliprpcontractendorsement').val();
       var percentage = $('#sliprppercentageendorsement').val();
       var amount = $('#sliprpamountendorsement').val();
       var or_percent = $('#sliporendorsement').val();
       var code_ms = $('#mcnumber').val();
       var sliptype = 'mc'
       
       var slip_id = $('#slipnumberendorsement').val();
       var token2 = $('input[name=_token2]').val();
       var countendorsement = parseInt($('#countendorsmentdata').val())+1;
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
                var curr_amount = response.amount.toString();
                $('#retrocessionPanelendorsement tbody').append('<tr id="iidretrocessionendorsement'+response.id+'" data-name="retrocessionvalue[]"><td data-name="'+response.contract+'">'+response.contract+'</td><td data-name="'+floatToString(parseFloat(response.percentage).toFixed(2))+'">'+floatToString(parseFloat(response.percentage).toFixed(2))+'</td><td data-name="'+amountToString(response.amount)+'">'+amountToString(response.amount)+'</td><td><a href="javascript:void(0)" onclick="deleteretrocessiondetail('+response.id+')">delete</a></td></tr>');
                $('#sliprppercentageendorsement').val('');
                $('#sliprpamountendorsement').val('');
                $('#sliprpamountendorsement2').val('');
                var or = $('#sliporendorsement').val();
                var total_percent = $('#sliptotalpercentrporendorsement').val();
                    var proses = parseInt(total_percent) + parseInt(response.percentage);
                    var sum_percent = isNaN(proses) ? 0 :(proses) ;
                    $('#sliptotalpercentrporendorsement').val(sum_percent);
                    
                    var total_percent2 = $('#sliptotalpercentrporendorsement').val();
                    console.log(total_percent2)
                    
                    if (parseFloat(total_percent2) >= 100) {
                        $("#addretrocessioninsuredendorsement-btn").attr("hidden",true);
                    }

            }

        }
    });

   });
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

<script type="text/javascript">
    $('#addinsuredsave-btn').click(function(e){
       //alert('masuk');
       e.preventDefault();

       var msinumber = $('#mcnumber').val();
       var msiprefix = $('#mcprefix').val();
       var msisuggestinsured = $('#autocomplete').val();
       var msisuffix = $('#autocomplete2').val();
       var msishare = $('#mcshare').val();
       var msisharefrom  = $('#mcsharefrom').val();
       var msishareto = $('#mcshareto').val();
       var msiroute = $('#mcroute').val();
       var msiroutefrom  = $('#mcroutefrom').val();
       var msirouteto = $('#mcrouteto').val();
       var msicurrency = $('#mccurrency').val();
       var msiuy = $('#mcuy').val();
       var msibusiness_id = $('#business_id').val();
       var msiflag_overseas = $('input[name="flag_overseas"]').val();

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
           url:"{{ url('transaction-data/marine-insured/store') }}",
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
               msibusiness_id:msibusiness_id,
            //    msicoinsurance:msicoinsurance
           },
           beforeSend: function() { $("body").addClass("loading");  },
           complete: function() {  $("body").removeClass("loading"); },
           success:function(response)
           {
                swal("Good job!", "Insured Marine Insert Success", "success")
                console.log(response)
                // $(':input','#formmarineinsured')
                //     .not(':button, :submit, :reset, :hidden')
                //     .val('')
                //     .removeAttr('checked')
                //     .removeAttr('selected');

                // $("#marineslipform").attr("hidden", false);
                // $("#marineslipform :input").prop("disabled", false);
                // $('#slipmcnumber').val(msinumber);
                $("#addinsuredsave-btn").html('Update');
                window.location.href = "{{ url('transaction-data/updatemarineslip/')}}/"+btoa(response.id);
                // refreshTableSlip(msinumber)
           },
           error: function (request, status, error) {
                //alert(request.responseText);
                swal("Error!", "Marine Insured Insert Error", "Insert Error");
           }
       });

   });
</script>

<script type='text/javascript'>
    $('#multi-file-upload-ajax').validate({ // initialize the plugin
        rules: {
            slipkoc: {
                required: true
            },
            slipcob: {
                required: true
            }
        }
    });

    $('#multi-file-upload-ajax').submit(function(e){
       //alert('masuk');
       e.preventDefault();

       var code_ms = $('#mcnumber').val();
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
       var wpc =  $('#slipwpc').val();
       var remarks =  $('#slipremarks').val();
       var insuredshare = $('#mcsharefrom').val();
       var kurs = $('#mckurs').val();
       var currency = $( "#mccurrency option:selected" ).text();
       var conv_curr = currency.substring(0,3);
       var token2 = $('input[name=_token]').val();
       var sliptotalpercentrpor = $('#sliptotalpercentrpor').val();
       var real_kurs = kurs.toString();


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

       var hasil_kurs_tsi = (real_sliptotalsum * parseFloat(kurs));
       var hasil_kurs_basic_premium = (real_slipbasicpremium * parseFloat(kurs));
       var hasil_kurs_grossprmtonr = (real_slipgrossprmtonr * parseFloat(kurs));
       var hasil_kurs_netprmtonr = (real_slipnetprmtonr * parseFloat(kurs));

       var conv_hasil_kurs_tsi = hasil_kurs_tsi.toString();
       var conv_hasil_kurs_basic_premium = hasil_kurs_basic_premium.toString();
       var conv_hasil_kurs_grossprmtonr = hasil_kurs_grossprmtonr.toString();
       var conv_hasil_kurs_netprmtonr = hasil_kurs_netprmtonr.toString();

       var message = "please check this value again. <br>";
           message = message + conv_curr + " - " + real_kurs + " x tsi - " + sliptotalsum + " = "+ conv_hasil_kurs_tsi + "<br>";
           message = message + conv_curr + " - " + real_kurs + " x basic premium - " + slipbasicpremium + " = " + conv_hasil_kurs_basic_premium + "<br>";
           // message = message + conv_curr + " = " + real_kurs + " x nasionalre share = " + slipsumshare + "<br>";
           message = message + conv_curr + " - " + real_kurs + " x gross prm to nr - " + slipgrossprmtonr + " = " + conv_hasil_kurs_grossprmtonr + "<br>";
           message = message + conv_curr + " - " + real_kurs + " x net prm to nr - " + slipnetprmtonr + " = " + conv_hasil_kurs_netprmtonr + "<br>";


       var current_percent = $('#sliptotalpercentinspan').val();
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
            if(result.value)
            {
                if(count_endorsement_ins != '' || count_endorsement_ins != null){
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
                            var int_tsislipval = parseInt(conv_tsiinsval);
                            var int_fullslip = parseInt(int_tsislipval);

                            var tsiinsval = $('#mcshareto').val();
                            var conv_tsiinsval = tsiinsval.replace(/,/g, "");
                            var int_tsiinsval = parseFloat(conv_tsiinsval);
                            var int_fullins = int_tsiinsval;
                            var new_instsi = int_fullins.toString();

                            var cedshareins = $('#mcshare').val();
                            var conv_cedshareins = cedshareins.replace(/,/g, "");
                            var int_cedshareins = parseFloat(conv_cedshareins);
                            var int_fullcedshare = int_cedshareins;
                            var new_cedshareins = int_fullcedshare.toString();

                            
                            if(conv_tsislipval == int_fullins)
                            {
                                    $.ajaxSetup({
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        }
                                    });

                                    $.ajax({
                                         url:"{{url('transaction-data/marine-slip/store')}}",
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
                                               remarks:remarks
                                           },
                                           beforeSend: function() { $("body").addClass("loading");  },
                                           complete: function() {  $("body").removeClass("loading"); },
                                           success:function(response)
                                           {
                                            swal("Success!", "Marine Cargo Slip Insert Success", "success")
                                            console.log(response)

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
                                                swal("Error!", "Marine Cargo Slip Insert Error : " + request.responseText, "Insert Error");
                                            }
                                        });



                                        var formData = new FormData(this);
                                        let TotalFiles = $('#attachment')[0].files.length; //Total files
                                        let files = $('#attachment')[0];
                                        var slip_id = $('#slipnumber').val();
                                        var insured_id = $('#mcnumber').val();

                                        if(TotalFiles > 0){
                                            for (let i = 0; i < TotalFiles; i++){
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
                                                             //swal("Error!", data.responseJSON.errors.files[0], "Insert Error");
                                                             //console.log(data.responseJSON.errors);
                                                         }
                                                     });

                                        }

                                       
                                        
                            }else{
                                swal('Warning!','please check tsi value again','insert error');
                            }
                            
                        }else{
                            swal('Warning!','please check date insurance/reinsurance periode cannot minus','insert error');
                        }
                    }else{
                        swal("Error!", "Please input installment panel until 100%", "Insert Error");
                    }


                    // var fesnumber = $('#mcnumber').val();
                    // var fesinsured = $('#mcinsured').val();
                    // var fessuggestinsured = $('#autocomplete').val();
                    // var fessuffix = $('#autocomplete2').val();
                    // var fesshare = $('#mcshare').val();
                    // var fessharefrom  = $('#mcsharefrom').val();
                    // var fesshareto = $('#mcshareto').val();
                    // var fescoinsurance = $('#mccoinsurance').val();
                    // var feuy = $('#mcuy').val();

                    // var conv_fesshare = fesshare.replace(/,/g, "");
                    // console.log(conv_fesshare)
                    // var real_fesshare = parseInt(conv_fesshare);
                    // console.log(real_fesshare)
                    // var conv_fessharefrom = fessharefrom.replace(/,/g, "");
                    // console.log(conv_fessharefrom)
                    // var real_fessharefrom = parseInt(conv_fessharefrom);
                    // console.log(real_fessharefrom)
                    // var conv_fesshareto = fesshareto.replace(/,/g, "");
                    // console.log(conv_fesshareto)
                    // var real_fesshareto = parseInt(conv_fesshareto);
                    // console.log(real_fesshareto)

                    // if(isNaN(real_fesshareto))
                    // {
                    //     real_fesshareto=0;
                    // }

                    // if(isNaN(real_fessharefrom))
                    // {
                    // real_fessharefrom=0;
                    // }


                    // var token2 = $('input[name=_token]').val();

                    // console.log(fesinsured)
                    // console.log(fessuggestinsured)
                    // console.log(fesnumber)
                    // console.log(fessuffix)


                    // $.ajaxSetup({
                    //     headers: {
                    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    //     }
                    // });

                    // $.ajax({
                    // url:"{{ url('transaction-data/fe-insured/store') }}",
                    // type:"POST",
                    // data:{
                    //     fesnumber:fesnumber,
                    //     fesinsured:fesinsured,
                    //     fessuggestinsured:fessuggestinsured,
                    //     fessuffix:fessuffix,
                    //     fesshare:real_fesshare,
                    //     fessharefrom:real_fessharefrom,
                    //     fesshareto:real_fesshareto,
                    //     fescoinsurance:fescoinsurance,
                    //     feuy:feuy
                    // },
                    // beforeSend: function() { $("body").addClass("loading");  },
                    // complete: function() {  $("body").removeClass("loading"); },
                    // success:function(response)
                    // {
                    //     //swal("Success!", "Insured Fire & Engineering Insert Success", "success")
                    //     console.log(response)
                    //     $('#mccountendorsement').val(response.count_endorsement);
                    //     var real_ceding_share = response.ceding_share.toString();
                    //     $('#mcshare').val(amountToString(ceding_share));

                    // },
                    // error: function (request, status, error) {
                    //             //alert(request.responseText);
                    //             swal("Error!", "Insured Fire & Engineering Insured Insert Error", "Insert Error");
                    //         }
                    // });
                    
                }else{
                    swal("Error!", "Please Save Insured First", "Insert Error");
                }

            }
            else{
                swal('cancelled')
            }
        });

});
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
       var code_ms = $('#mcnumber').val();
       var sliptype = 'mc'; 
       
       var slip_id = $('#slipnumber').val();
       var token2 = $('input[name=_token2]').val();
       var countendorsement = 0;
       var conv_amount = amount.replace(/,/g, "");
       var real_amount = conv_amount;
        
        if(btnins == "Save"){
            swal("Error!", "Please input Insured data First!!!", "warning");
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
                        var curr_amount = response.amount.toString();
                        $('#retrocessionPanel tbody').append('<tr id="iidretrocession'+response.id+'" data-name="retrocessionvalue[]"><td data-name="'+response.contract+'">'+response.contract+'</td><td data-name="'+floatToString(response.percentage)+'">'+floatToString(parseFloat(response.percentage).toFixed(2))+'</td><td data-name="'+amountToString(response.amount)+'">'+amountToString(response.amount)+'</td><td><a href="javascript:void(0)" onclick="deleteretrocessiondetail('+response.id+')">delete</a></td></tr>');
                        $('#sliprppercentage').val('');
                        $('#sliprpamount').val('');
                        $('#sliprpamount2').val('');
                        if(response.message){
                            swal("Success!", response.message, "success")
                        }
                        var or = $('#slipor').val();
                        var total_percent = $('#sliptotalpercentrpor').val();
                        var sum_percent = isNaN(parseInt(total_percent)) ? 0 : parseInt(total_percent) + parseInt(response.percentage);
                                console.log(sum_percent);
                                $('#sliptotalpercentrpor').val(sum_percent);
                        var total_percent2 = $('#sliptotalpercentrpor').val();;
                        if (total_percent2 >= 100) {
                            $('#addretrocessioninsured-btn').attr('hidden',true);
                        }


                    }
                }
        })
        }
        ;

   });
    $('#multi-file-upload-ajaxupdate').submit(function(e){
       // alert('masuk ' + $('#insuredIDtxt').val() + ' ' + $('#slipnumberupdate').val()) ;
       e.preventDefault();


       var code_ms = $('#mcnumber').val();
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
                 url:"{{url('transaction-data/marine-slip/updateform')}}",
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
                        var real_nasre = conv_nasre.toString();
                        $('#mcsharefrom').val(amountToString(conv_nasre));
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


       var code_ms = $('#mcnumber').val();
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
       var countendorsement = parseInt($('#countendorsmentdata').val())+1;
       var slipsumrate =  $('#sliptotalrateendorsement').val();

        var slipsharetotalsum = $('#sharetotalsumendorsement').val();
       var sliptypetotalsum = $('#sliptypetsiendorsement').val();
       var sliptypetsishare = $('#sharetypetsiendorsement').val();
       var sliptotalday = $('#slipdaytotalendorsement').val();
       var sliptotalyear = $('#slipdaytotalendorsement3').val();
       var slipdatesum = $('#sliptotalsumdateendorsement').val();
       var slipsumvbroker =  $('#slipsumfeeendorsement').val();
       
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
       


       var conv_slipsharetotalsum = slipsharetotalsum.replace(/,/g, "");
       console.log(conv_slipsharetotalsum)
       var real_slipsharetotalsum = parseFloat(conv_slipsharetotalsum);
       console.log(real_slipsharetotalsum)

       var conv_slipdatesum = slipdatesum.replace(/,/g, "");
       console.log(conv_slipdatesum)
       var real_slipdatesum = parseFloat(conv_slipdatesum);
       console.log(real_slipdatesum)

       // var conv_insuredshare = insuredshare.replace(/,/g, "");
       // console.log(conv_insuredshare)
       // var real_insuredshare = parseFloat(conv_insuredshare);
       // console.log(real_insuredshare)

       var conv_slipsumrate = slipsumrate.replace(/,/g, "");
       console.log(conv_slipsumrate)
       var real_slipsumrate = parseFloat(conv_slipsumrate);
       console.log(real_slipsumrate)
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });


        $.ajax({
         url:"{{url('transaction-data/marine-slip/endorsementstore')}}",
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
             slipsharetotalsum:real_slipsharetotalsum,
               sliptypetotalsum:sliptypetotalsum,
               sliptypetsishare:sliptypetsishare,
               sliptotalday:sliptotalday,
               sliptotalyear:sliptotalyear,
               slipdatesum:real_slipdatesum,
               // insured_share:real_insuredshare,
               wpc:wpc,
               remarks:remarks,
               sliptotalrate:real_slipsumrate,
             countendorsement:countendorsement
         },
         beforeSend: function() { $("body").addClass("loading");  },
         complete: function() {  $("body").removeClass("loading"); },
         success:function(response)
         {
            swal("Success!", "Marine Cargo Slip Endorsement Success", "success")
            console.log(response)
            refreshTableSlip(code_ms)
            // var insured_data2=JSON.parse(response.insured_data);
            // $('#fecountendorsement').val(insured_data2.count_endorsement);
            //alert(insured_data2.count_endorsement);

            var slip_data2array=JSON.parse(response.slip_dataarray);
            var slip_dataarray=JSON.parse(response.slip_data);
                // $('#SlipInsuredTableData tbody tr[id=slipiid'+response.oldid+']').remove();


                // if(slip_dataarray.date_transfer){
                //     $('#SlipInsuredTableData tbody').append('<tr id="slipiid'+slip_dataarray.id+'" data-name="slipvalue[]"><td data-name="'+slip_dataarray.number+'">'+slip_dataarray.number+'</td><td data-name="'+slip_dataarray.cedingbroker+'">'+slip_dataarray.cedingbroker+'</td><td data-name="'+slip_dataarray.ceding+'">'+slip_dataarray.ceding+'</td>'
                //     +'<td data-name="'+slip_dataarray.slipstatus+'">'+slip_dataarray.slipstatus+'</td><td>'+slip_dataarray.count_endorsement+'</td><td>'
                //     +'<a class="text-primary mr-3 float-right " data-toggle="modal"  data-book-id="'+slip_dataarray.id+'" data-target="#detailmodaldata" href="#detailmodaldata">'
                //     +'<button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#detailmodaldata2">Detail</button>'
                //     +'</a>'
                //     // +'<a class="text-primary mr-3 float-right " data-toggle="modal" data-book-id="'+response.id+'" data-target="#updatemodaldata">'
                //     // +'<button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#updatemodaldata2">Edit</button>'
                //     // +'</a>'
                //     +'<a class="text-primary mr-3 float-right " data-toggle="modal" data-book-id="'+slip_dataarray.id+'" data-target="#endorsementmodaldata">'
                //     +'<button type="button" id="btnendorsementslip" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#endorsementmodaldata2">Endorsement</button>'
                //     +'</a>'
                //     +'<a class="text-primary mr-3 float-right " data-toggle="modal" data-book-id="'+slip_dataarray.id+'" data-target="#cancelmodaldata">'
                //     +'<button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#cancelmodaldata2">Cancel</button>'
                //     +'</a>'
                //     // +'<button type="button" id="claim-endorse" class="btn btn-sm btn-warning float-right">Claim</button>'
                //     +'</td></tr>');    
                
                // }else{

                //     $('#SlipInsuredTableData tbody').append('<tr id="slipiid'+slip_dataarray.id+'" data-name="slipvalue[]"><td data-name="'+slip_dataarray.number+'">'+slip_dataarray.number+'</td><td data-name="'+slip_dataarray.cedingbroker+'">'+slip_dataarray.cedingbroker+'</td><td data-name="'+slip_dataarray.ceding+'">'+slip_dataarray.ceding+'</td>'
                //     +'<td data-name="'+slip_dataarray.slipstatus+'">'+slip_dataarray.slipstatus+'</td><td>'+slip_dataarray.count_endorsement+'</td><td>'
                //     +'<a class="text-primary mr-3 float-right " data-toggle="modal"  data-book-id="'+slip_dataarray.id+'" data-target="#detailmodaldata" href="#detailmodaldata">'
                //     +'<button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#detailmodaldata2">Detail</button>'
                //     +'</a>'
                //     +'<a class="text-primary mr-3 float-right " data-toggle="modal" data-book-id="'+slip_dataarray.id+'" data-target="#updatemodaldata">'
                //     +'<button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#updatemodaldata2">Edit</button>'
                //     +'</a>'
                //     // +'<a class="text-primary mr-3 float-right " data-toggle="modal" data-book-id="'+response.id+'" data-target="#endorsementmodaldata">'
                //     // +'<button type="button" id="btnendorsementslip" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#endorsementmodaldata2">Endorsement</button>'
                //     // +'</a>'
                //     +'<a class="text-primary mr-3 float-right " data-toggle="modal" data-book-id="'+slip_dataarray.id+'" data-target="#cancelmodaldata">'
                //     +'<button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#cancelmodaldata2">Cancel</button>'
                //     +'</a>'
                //     // +'<button type="button" id="claim-endorse" class="btn btn-sm btn-warning float-right">Claim</button>'
                //     +'</td></tr>');
                // }

            
            // slip_data2array.forEach(function (arrayItem) 
            // {
                //var x = arrayItem.prop1 + 2;
                
               

            // });

            
            $('#endorsementmodaldata').modal('toggle');
            $('#endorsementmodaldata2').modal('toggle');

            // $('#slipnumberendorsement').val(response.number);

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


      // insured save
      /*
      var fesnumber = $('#insuredIDtxt').val();
      var fesinsured = $('#feinsured').val();
      var fessuggestinsured = $('#autocomplete').val();
      var fessuffix = $('#autocomplete2').val();
      var fesshare = $('#feshare').val();
      var fessharefrom  = $('#fesharefrom').val();
      var fesshareto = $('#feshareto').val();
      var fescoinsurance = $('#fecoinsurance').val();


      var conv_fessharefrom = fessharefrom.replace(/,/g, "");
      console.log(conv_fessharefrom)
      var real_fessharefrom = parseInt(conv_fessharefrom);
      console.log(real_fessharefrom)
      var conv_fesshareto = fesshareto.replace(/,/g, "");
      console.log(conv_fesshareto)
      var real_fesshareto = parseInt(conv_fesshareto);
      console.log(real_fesshareto)


      var token2 = $('input[name=_token]').val();

      console.log(fesinsured)
      console.log(fessuggestinsured)
      console.log(fesnumber)
      console.log(fessuffix)


      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

      $.ajax({
         url:"{{ url('transaction-data/fe-insured/store') }}",
         type:"POST",
         data:{
             fesnumber:fesnumber,
             fesinsured:fesinsured,
             fessuggestinsured:fessuggestinsured,
             fessuffix:fessuffix,
             fesshare:fesshare,
             fessharefrom:real_fessharefrom,
             fesshareto:real_fesshareto,
             fescoinsurance:fescoinsurance
         },
         beforeSend: function() { $("body").addClass("loading");  },
         complete: function() {  $("body").removeClass("loading"); },
         success:function(response)
         {
            swal("Success!", "Insured Fire & Engineering Insert Success", "success")
            console.log(response)

        },
        error: function (request, status, error) {
                //alert(request.responseText);
                swal("Error!", "Insured Fire & Engineering Insured Insert Error", "Insert Error");
            }
        });

      */

      $('#installmentPanelendorsement tbody').empty();
      $('#ExtendCoveragePanelendorsement tbody').empty();
      $('#deductiblePanelendorsement tbody').empty();
      $('#retrocessionPanelendorsement tbody').empty();



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
    function refreshTableSlip(number){
                var slip_type = 'mc';
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
  
</script>
<script type="text/javascript">
    $('#sliptotalsumdateupdate2').change(function(){
        calculateBasicPremium('update');
        calculateGrossPrm('update');
        calculateComm('update');
        calculateFee('update');
    });
    $('#sliptotalsumdate2').change(function(){
        calculateBasicPremium('slip');
        calculateGrossPrm('slip');
        calculateComm('slip');
        calculateFee('slip');
    });
    $('#sliptotalsumendorsement2').change(function(){
        calculateBasicPremium('endorsement');
        calculateGrossPrm('endorsement');
        
        calculateComm('endorsement');
        calculateFee('endorsement');
    });
        function calculateRate(status){
            if (status == 'update') {
                var sharetotalsum = parseFloat($('#sharetotalsumupdate').val().replace(/,/g, ""));
                var slipbasicpremium = parseFloat($('#slipbasicpremiumupdate').val());
                var sliptotalsumdate = parseFloat($('#sliptotalsumdateupdate').val());
            }else if(status == 'endorsement'){
                var sharetotalsum = parseFloat($('#sharetotalsumendorsement').val().replace(/,/g, ""));
                var slipbasicpremium = parseFloat($('#slipbasicpremiumendorsement').val());
                var sliptotalsumdate = parseFloat($('#sliptotalsumdateendorsement').val());
            }else{
                var sharetotalsum = parseFloat($('#sharetotalsum').val().replace(/,/g, ""));
                var slipbasicpremium = parseFloat($('#slipbasicpremium').val());
                var sliptotalsumdate = parseFloat($('#sliptotalsumdate').val());
            }
            var proses = parseFloat(((slipbasicpremium/sharetotalsum)/sliptotalsumdate)*100).toFixed(2);
            var rate = isNaN(proses) ? 0 : (proses)
            if (status == 'update') {
                $('#sliprateupdate').val(parseFloat(rate).toFixed(6))
                $('#sliptotalrateupdate').val(parseFloat(rate).toFixed(6))
                $('#sliptotalrateupdate2').val(parseFloat(rate).toFixed(6))
            }else if(status == 'endorsement'){
                $('#sliprateendorsement').val(parseFloat(rate).toFixed(6))
                $('#sliptotalrateendorsement').val(parseFloat(rate).toFixed(6))
                $('#sliptotalrateendorsement2').val(parseFloat(rate).toFixed(6))
            }else{
                $('#sliprate').val(parseFloat(rate).toFixed(6))   
                $('#sliptotalrate').val(parseFloat(rate).toFixed(6))   
                $('#sliptotalrate2').val(parseFloat(rate).toFixed(6))   
            }
            calculateGrossPrm(status);
        }
        function calculateBasicPremium(status){
            if (status == 'update') {
                var sliprate = parseFloat($('#sliprateupdate').val());
                var sharetotalsum = parseFloat($('#sharetotalsumupdate').val().replace(/,/g, ""));
                var sliptotalsumdate = parseFloat($('#sliptotalsumdateupdate').val());
            }else if(status == 'endorsement'){
                var sliprate = parseFloat($('#sliprateendorsement').val());
                var sharetotalsum = parseFloat($('#sharetotalsumendorsement').val().replace(/,/g, ""));
                var sliptotalsumdate = parseFloat($('#sliptotalsumdateendorsement').val());
            }else{
                var sliprate = parseFloat($('#sliprate').val());
                var sharetotalsum = parseFloat($('#sharetotalsum').val().replace(/,/g, ""));
                var sliptotalsumdate = parseFloat($('#sliptotalsumdate').val());
            }
            
            var proses = parseFloat((sharetotalsum*(sliprate/100))*sliptotalsumdate).toFixed(2);
            var rate = isNaN(proses) ? 0 : (proses)
            console.log('rate ' + rate.toString())
            console.log('proses ' + proses)
            if (status == 'update') {
                $('#slipbasicpremiumupdate').val(rate.toString())
                $('#sliptotalrateupdate').val(sliprate)   
                $('#sliptotalrateupdate2').val(sliprate)      

            }else if(status == 'endorsement'){
                $('#slipbasicpremiumendorsement').val(rate.toString())
                $('#sliptotalrateendorsement').val(sliprate)   
                $('#sliptotalrateendorsement2').val(sliprate)      
            }else{
                $('#slipbasicpremium').val(rate.toString())   
                $('#sliptotalrate').val(sliprate)   
                $('#sliptotalrate2').val(sliprate)      

            }
            calculateGrossPrm(status)
        }
    function calculateShareNr(status){
        if (status == 'update') {
            var slipshare = parseFloat($('#slipshareupdate').val());
            var sharetotalsum = parseFloat($('#sharetotalsumupdate').val().replace(/,/g, ""));
        }else if(status == 'endorsement'){
            var slipshare = parseFloat($('#slipshareendorsement').val());
            var sharetotalsum = parseFloat($('#sharetotalsumendorsement').val().replace(/,/g, ""));
        }else{
            var slipshare = parseFloat($('#slipshare').val());
            var sharetotalsum = parseFloat($('#sharetotalsum').val().replace(/,/g, ""));
        }
        var proses = parseFloat(sharetotalsum*(slipshare/100)).toFixed(2);
        var rate = isNaN(proses) ? 0 : (proses)
        console.log('share calculate slipshare : '+ slipshare)
        console.log('share calculate sharetotalsum : '+ sharetotalsum)
        if (status == 'update') {
            $('#slipsumshareupdate').val(rate);
            $('#slipsumshareupdate2').val(rate);
        }else if(status == 'endorsement'){
            $('#slipsumshareendorsement').val(rate);
            $('#slipsumshareendorsement2').val(rate);
        }else{
            $('#slipsumshare').val(rate);
            $('#slipsumshare2').val(rate);
        }
        calculateFee(status)
        calculateComm(status)
        calculateGrossPrm(status)
    }
    function calculateGrossPrm(status){
        if (status == 'update') {
            var slipbasicpremium = parseFloat($('#slipbasicpremiumupdate').val().replace(/,/g, ""));
            var slipshare = parseFloat($('#slipshareupdate').val());
        }else if(status == 'endorsement'){
            var slipbasicpremium = parseFloat($('#slipbasicpremiumendorsement').val().replace(/,/g, ""));
            var slipshare = parseFloat($('#slipshareendorsement').val());
        }else{
            var slipbasicpremium = parseFloat($('#slipbasicpremium').val().replace(/,/g, ""));
            var slipshare = parseFloat($('#slipshare').val());
        }
        var proses = parseFloat(slipbasicpremium*(slipshare/100)).toFixed(2);
        console.log('slipbasicpremium' + slipbasicpremium)
        console.log('slipshare' + slipshare)
        var rate = isNaN(proses) ? 0 : (proses)
        if (status == 'update') {
            $('#slipgrossprmtonrupdate').val(rate.toString());
            $('#slipgrossprmtonrupdate2').val(rate.toString());
        }else if(status == 'endorsement'){
            $('#slipgrossprmtonrendorsement').val(rate.toString());
            $('#slipgrossprmtonrendorsement2').val(rate.toString());
        }else{
            $('#slipgrossprmtonr').val(rate.toString());
            $('#slipgrossprmtonr2').val(rate.toString());
        }
        calculateNetPrm(status)   
    }
    function calculateComm(status){
        if (status == 'update') {
            var slipgrossprmtonr = parseFloat($('#slipgrossprmtonrupdate').val().replace(/,/g, ""));
            var slipcommission = parseFloat($('#slipcommissionupdate').val());
        }else if(status == 'endorsement'){
            var slipgrossprmtonr = parseFloat($('#slipgrossprmtonrendorsement').val().replace(/,/g, ""));
            var slipcommission = parseFloat($('#slipcommissionendorsement').val());
        }else{
            var slipgrossprmtonr = parseFloat($('#slipgrossprmtonr').val().replace(/,/g, ""));
            var slipcommission = parseFloat($('#slipcommission').val());
        }
        var proses = parseFloat((slipcommission/100)*slipgrossprmtonr).toFixed(2);
        var rate = isNaN(proses) ? 0 : (proses)
        if (status == 'update') {
            $('#slipsumcommissionupdate').val(floatToString(rate));
            $('#slipsumcommissionupdate2').val(floatToString(rate));
        }else if(status == 'endorsement'){
            $('#slipsumcommissionendorsement').val(floatToString(rate));
            $('#slipsumcommissionendorsement2').val(floatToString(rate));
        }else{
            $('#slipsumcommission').val(floatToString(rate));
            $('#slipsumcommission2').val(floatToString(rate));
        }
        calculateNetPrm(status)   
    }
    function calculatePercentComm(status){
        if (status == 'update') {
            var slipgrossprmtonr = parseFloat($('#slipgrossprmtonrupdate').val().replace(/,/g, ""));
            var slipsumcommission = parseFloat($('#slipsumcommissionupdate2').val());
        }else if(status == 'endorsement'){
            var slipgrossprmtonr = parseFloat($('#slipgrossprmtonrendorsement').val().replace(/,/g, ""));
            var slipsumcommission = parseFloat($('#slipsumcommissionendorsement2').val());
        }else{
            var slipgrossprmtonr = parseFloat($('#slipgrossprmtonr').val().replace(/,/g, ""));
            var slipsumcommission = parseFloat($('#slipsumcommission2').val());
        }
        var proses = parseFloat((slipsumcommission/slipgrossprmtonr)*100).toFixed(2);
        var rate = isNaN(proses) ? 0 : (proses)
        if (status == 'update') {
            $('#slipcommissionupdate').val(rate.toString());
            $('#slipcommissionupdate2').val(rate.toString());
        }else if(status == 'endorsement'){
            $('#slipcommissionendorsement').val(rate.toString());
            $('#slipcommissionendorsement2').val(rate.toString());
        }else{
            $('#slipcommission').val(rate.toString());
            $('#slipcommission2').val(rate.toString());
        }
        calculateNetPrm(status)   
    }
    function calculateFee(status){
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
        var proses = parseFloat((slipvbroker/100)*slipgrossprmtonr).toFixed(2);
        var rate = isNaN(proses) ? 0 : (proses)
        if (status == 'update') {
            $('#slipsumfeeupdate').val(floatToString(rate));
            $('#slipsumfeeupdate2').val(floatToString(rate));
        }else if(status == 'endorsement'){
            $('#slipsumfeeendorsement').val(floatToString(rate));
            $('#slipsumfeeendorsement2').val(floatToString(rate));
        }else{
            $('#slipsumfee').val(floatToString(rate));
            $('#slipsumfee2').val(floatToString(rate));
        }
        calculateNetPrm(status)
    }
    function calculatePercentFee(status){
        if (status == 'update') {
            var slipgrossprmtonr = parseFloat($('#slipgrossprmtonrupdate').val().replace(/,/g, ""));
            var slipsumfee = parseFloat($('#slipsumfeeupdate2').val());
        }else if(status == 'endorsement'){
            var slipgrossprmtonr = parseFloat($('#slipgrossprmtonrendorsement').val().replace(/,/g, ""));
            var slipsumfee = parseFloat($('#slipsumfeeendorsement2').val());
        }else{
            var slipgrossprmtonr = parseFloat($('#slipgrossprmtonr').val().replace(/,/g, ""));
            var slipsumfee = parseFloat($('#slipsumfee2').val());
        }
        var proses = parseFloat(slipsumfee/slipgrossprmtonr*100).toFixed(2);
        var rate = isNaN(proses) ? 0 : (proses)
        if (status == 'update') {
            $('#slipvbrokerupdate').val(floatToString(rate));
            $('#slipvbrokerupdate2').val(floatToString(rate));
        }else if(status == 'endorsement'){
            $('#slipvbrokerendorsement').val(floatToString(rate));
            $('#slipvbrokerendorsement2').val(floatToString(rate));
        }else{
            $('#slipvbroker').val(floatToString(rate));
            $('#slipvbroker2').val(floatToString(rate));
        }
        calculateNetPrm(status)
    }
    function calculateNetPrm(status){
        if (status == 'update') {
            var slipgrossprmtonr = parseFloat($('#slipgrossprmtonrupdate').val().replace(/,/g, ""));
            var slipsumcommission = parseFloat($('#slipsumcommissionupdate').val().replace(/,/g, ""));
            var slipsumfee = parseFloat($('#slipsumfeeupdate').val().replace(/,/g, ""));
        }else if(status == 'endorsement'){
            var slipgrossprmtonr = parseFloat($('#slipgrossprmtonrendorsement').val().replace(/,/g, ""));
            var slipsumcommission = parseFloat($('#slipsumcommissionendorsement').val().replace(/,/g, ""));
            var slipsumfee = parseFloat($('#slipsumfeeendorsement').val().replace(/,/g, ""));
        }else{
            var slipgrossprmtonr = parseFloat($('#slipgrossprmtonr').val().replace(/,/g, ""));
            var slipsumcommission = parseFloat($('#slipsumcommission').val().replace(/,/g, ""));
            var slipsumfee = parseFloat($('#slipsumfee').val().replace(/,/g, ""));
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
    function calculateTotalRate(status){
        if (status == 'update') {
            var slipbasicpremium = parseFloat($('#slipbasicpremiumupdate').val());
            var sharetotalsum = parseFloat($('#sharetotalsumupdate').val().replace(/,/g, ""));
            var sliptotalsumdate = parseFloat($('#sliptotalsumdateupdate').val());
        }else if(status == 'endorsement'){
            var slipbasicpremium = parseFloat($('#slipbasicpremiumendorsement').val());
            var sharetotalsum = parseFloat($('#sharetotalsumendorsement').val().replace(/,/g, ""));
            var sliptotalsumdate = parseFloat($('#sliptotalsumdateendorsement').val());
        }else{
            var slipbasicpremium = parseFloat($('#slipbasicpremium').val());
            var sharetotalsum = parseFloat($('#sharetotalsum').val().replace(/,/g, ""));
            var sliptotalsumdate = parseFloat($('#sliptotalsumdate').val());
        }
        var a = isNaN(slipbasicpremium) ? 0 : (slipbasicpremium);
        var b = isNaN(sharetotalsum) ? 0 : (sharetotalsum);
        var c = isNaN(sliptotalsumdate) ? 0 : (sliptotalsumdate);
        var proses = parseFloat(((a/b)/c)*100).toFixed(2);
        var rate =  isNaN(proses) ? 0 : (proses);
        console.log(rate)
        console.log(slipbasicpremium)
        console.log(sharetotalsum)
        console.log(rate.toString())
        if (status == 'update') {
            $('#sliprateupdate').val(rate);
            $('#sliprateupdate2').val(rate);


            $('#sliptotalrateupdate').val(rate);
            $('#sliptotalrateupdate2').val(rate);
            
        }else if(status == 'endorsement'){
            $('#sliprateendorsement').val(rate);
            $('#sliprateendorsement2').val(rate);

            $('#sliptotalrateendorsement').val(rate);
            $('#sliptotalrateendorsement2').val(rate);
        }else{
            $('#sliprate').val(rate);
            $('#sliprate2').val(rate);

            $('#sliptotalrate').val(rate);
            $('#sliptotalrate2').val(rate);
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
    function polosan(status){
        if (status == 'update') {

        }else if(status == 'endorsement'){

        }else{
            
        }
        
    }
</script>

