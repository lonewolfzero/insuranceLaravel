<link href="{{asset('css/select2.css')}}" rel="stylesheet"/>
<script src="{{asset('/js/select2.js')}}"></script>

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

  .swal-wide{
    width:850px !important;
}
</style>



<script type="text/javascript">
    $('.nav-tabs li a').click(function (e) {     
    //get selected href
    var href = $(this).attr('href');    
    var id = href.substring(1);  
    console.log('id = '+id)  
    
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
});
</script>


<script type="text/javascript">
    $(document).ready(function() { 

         $(".e1").select2({ width: '100%' });
        
        if(($('#sliprate').val() != 0) && ($('#slipshare').val() != 0) )
        {
            
        }
        
        var dtdef = new Date($.now());
        var datetimedef =  dtdef.getFullYear() + "-" + dtdef.getMonth() + "-" + dtdef.getDate() + " " + dtdef.getHours() + ":" + dtdef.getMinutes() + ":" + dtdef.getSeconds();
        $('#slipStatusTable tbody').append('<tr id="stlid"><td >'+ $("#slipstatus").val() +'</td><td >'+datetimedef+'</td><td >'+ $("#slipusername").val() +'</td></tr>');
        
        
        document.getElementByTagName("html").setAttribute("lang","id-ID");

        $("#tabretro").attr('hidden','true');
        // $("#tabretrodetail").attr('hidden','true');
        // $("#tabretroupdate").attr('hidden','true');
        // $("#tabretroendorsement").attr('hidden','true');
        $("#sliptotalsum").val().toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


        var countryID = 102; 
            //alert(countryID);
            if(countryID){
                $.ajax({
                    type:"GET",
                    url:"{{url('get-state-lookup')}}?country_id="+countryID,
                    beforeSend: function() { $("body").addClass("loading");  },
                    complete: function() {  $("body").removeClass("loading"); },
                    success:function(res){  
                        console.log(res)      
                        if(res){
                            $("#state_location").empty();
                            $("#state_location").append('<option selected disabled>Select States/Province</option>');
                            $.each(res,function(key,value){
                                $("#state_location").append('<option value="'+key+'">'+value+'</option>');
                            });

                        }else{
                            $("#state_location").append('<option value="" selected disabled>get value error</option>');
                        }
                    }
                });
            }else{
                $("#state_location").append('<option value="" selected disabled>countryID null</option>');
                $("#city_location").empty();
            }  

     });
   
</script>

<script type="text/javascript">
    $('#slipstatus').change(function(){
        var status = $(this).val();
        var dt = new Date($.now());
        var datetime =  dt.getFullYear() + "-" + dt.getMonth() + "-" + dt.getDate() + " " + dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
        var user = $('#slipusername').val();
        $('#stlid').remove();
        $('#slipStatusTable tbody').append('<tr id="stlid"><td >'+status+'</td><td >'+datetime+'</td><td >'+user+'</td></tr>')
    });
</script>


<script type="text/javascript">
   

   $('input.amount').keyup(function(event) {
            // skip for arrow keys
            if(event.which >= 37 && event.which <= 40) return;
            console.log(event.which)
            console.log($(this).val())
                // format number
                $(this).val(function(index, value) {
                    return value.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                });
            });

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

    function treatAsUTC(date) {
        var result = new Date(date);
        result.setMinutes(result.getMinutes() - result.getTimezoneOffset());
        return result;
    }


    function daysBetween(startDate, endDate) {
        var millisecondsPerDay = 24 * 60 * 60 * 1000;
        return (treatAsUTC(endDate) - treatAsUTC(startDate)) / millisecondsPerDay;
    }


    //triggered when modal is about to be shown
    $('#detailmodaldata').on('show.bs.modal', function(e) {

        //get data-id attribute of the clicked element
        var codesl = $(e.relatedTarget).data('book-id');

        //alert(codesl);

        $.ajax({
        url:'{{ url("/") }}/transaction-data/detailmpslip/'+codesl,
        type:"GET",
        beforeSend: function() { $("body").addClass("loading");  },
        complete: function() {  $("body").removeClass("loading"); },
        success:function(response)
        {
            console.log(response);
            $('#slipnumberdetail').val(response.number);
            $('#slipusernamedetail').val(response.username);
            $('#slipprodyeardetail').val(response.prod_year);
            $('#slipuydetail').val(response.uy);
            $('#slipeddetail').val(response.endorsment);
            $('#slipslsdetail').val(response.selisih);
            $('#wpcdetail').val(response.wpc);

            $('#slipvbrokerdetail').val(response.v_broker);


                 if(response.deductible_panel && response.deductible_panel.length > 3)
                {

                var deductibledata = JSON.parse(response.deductible_panel); 

                for(var i = 0; i < deductibledata.length; i++) 
                {
                    var obj = deductibledata[i];

                        //console.log(obj.id);
                        //$('#interestInsuredTabledetail tbody').prepend('');
                        // var curr_amount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(obj.amount);
                        var curr_amount = obj.amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        // var curr_minamount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(obj.min_claimamount);
                        var curr_minamount = obj.min_claimamount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        $('#deductiblePaneldetail tbody').empty();
                        $('#deductiblePaneldetail tbody').prepend('<tr id="iiddeductible'+obj.id+'" data-name="deductibledetailvalue[]"><td data-name="'+obj.deductibletype+'">'+obj.deductibletype+'</td><td data-name="'+obj.percentage+'">'+obj.percentage+'</td><td data-name="'+curr_amount+'">'+curr_amount+'</td><td data-name="'+curr_minamount+'">'+curr_minamount+'</td><td></td></tr>');

                    }
                }


                if(response.extend_coverage  && response.extend_coverage.length > 3)
                {

                    var extend_coverage = JSON.parse(response.extend_coverage); 

                    for(var i = 0; i < extend_coverage.length; i++) 
                    {
                        var obj = extend_coverage[i];

                        //console.log(obj.id);
                        //$('#interestInsuredTabledetail tbody').prepend('');
                        // var curr_amount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(obj.amount);
                        var curr_amount = obj.amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        $('#ExtendCoveragePaneldetail tbody').empty();
                        $('#ExtendCoveragePaneldetail tbody').prepend('<tr id="iidextendcoveragedetail'+obj.id+'" data-name="extendcoveragedetailvalue[]"><td data-name="'+obj.coveragetype+'">'+obj.coveragetype+'</td><td data-name="'+obj.percentage+'">'+obj.percentage+'</td><td data-name="'+curr_amount+'">'+curr_amount+'</td><td></td></tr>');
                        
                    }
                }


                if(response.installment_panel  && response.installment_panel.length > 3)
                {

                    var installment_panel = JSON.parse(response.installment_panel); 

                    for(var i = 0; i < installment_panel.length; i++) 
                    {
                        var obj = installment_panel[i];
                        // var curr_amount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(obj.amount);
                        var curr_amount = obj.amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                        //console.log(obj.id);
                        //$('#interestInsuredTabledetail tbody').prepend('');
                        $('#installmentPaneldetail tbody').empty();
                        $('#installmentPaneldetail tbody').prepend('<tr id="iidinstallmentdetail'+obj.id+'" data-name="installmentdetailvalue[]"><td data-name="'+obj.installment_date+'">'+obj.installment_date+'</td><td data-name="'+obj.percentage+'">'+obj.percentage+'</td><td data-name="'+curr_amount+'">'+curr_amount+'</td><td></td></tr>')

                    }
                }



                if(response.retrocession_panel && response.retrocession_panel.length > 3)
                {

                    var retrocession_panel = JSON.parse(response.retrocession_panel); 
                    $('#retrocessionPaneldetail tbody').empty();
                    for(var i = 0; i < retrocession_panel.length; i++) 
                    {
                        var obj = retrocession_panel[i];
                        if(obj.amount)
                        {
                            // var curr_amount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(obj.amount);
                            var conv_amount = obj.amount.toFixed(2);
                            var str_amount = conv_amount.toString();
                            var curr_amount = str_amount.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            // var curr_amount = obj.amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            var conv_percent = parseFloat(obj.percentage).toFixed(2);

                            //console.log(obj.id);
                            //$('#interestInsuredTabledetail tbody').prepend('');
                            
                            
                            $('#retrocessionPaneldetail tbody').prepend('<tr id="iidretrocessiondetail'+obj.id+'" data-name="retrocessiondetailvalue[]"><td data-name="'+obj.type+'">'+obj.type+'</td><td data-name="'+obj.contract+'">'+obj.contract+'</td><td data-name="'+obj.percentage+'">'+conv_percent+'%</td><td data-name="'+curr_amount+'">'+curr_amount+'</td><td></td></tr>');
                        }
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
                    $("#slipcedingbrokerdetail option").attr('hidden',true);
                    $("#slipcedingbrokerdetail option[value=" + response.source + "]:first")[0].hidden = false;
                    $("#slipcedingbrokerdetail option[value=" + response.source + "]:first")[0].selected = true;
                }

                if(response.source_2)
                {
                    $("#slipcedingdetail option").attr('hidden',true);
                    $("#slipcedingdetail option[value=" + response.source_2 + "]:first")[0].hidden = false;
                    $("#slipcedingdetail option[value=" + response.source_2 + "]:first")[0].selected = true;
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
                    $("#sliptypedetail option[value=" + response.insured_type + "]:first")[0].selected = true;
                }

                if(response.type_tsi)
                {
                    $("#sliptypetsidetail option[value=" + response.type_tsi + "]:first")[0].selected = true;
                }

                if(response.type_share_tsi)
                {
                    $("#sharetypetsidetail option[value=" + response.type_share_tsi + "]:first")[0].selected = true;
                }

                if(response.layer_non_proportional)
                {
                    //$("#sliplayerproportionaldetail option[value=" + response.layer_non_proportional + "]:first")[0].selected = true;
                }

                if(response.retro_backup)
                {
                    $("#sliprbdetail option[value=" + response.retro_backup + "]:first")[0].selected = true;
                    if(response.retro_backup == "NO")
                    {
                        $("#tabretrodetail").attr('hidden');
                    }
                    else if(response.retro_backup == "YES"){
                        $("#tabretrodetail").removeAttr('hidden');
                    }
                }


                if(response.status_log){
                    var status_log = response.status_log;
                    for (var i = 0; i < 5; i++){

                        if(status_log[i])
                        {
                        var status = status_log[i].status;
                        var datetime = status_log[i].datetime;
                        var user = status_log[i].user;
                        $('#stlid'+status_log[i].id).remove();
                        $('#slipStatusTabledetail tbody').append('<tr id="stlid'+status_log[i].id+'" data-name="slipvalue[]"><td >'+status+'</td><td >'+datetime+'</td><td >'+user+'</td></tr>')
                    }

                };
            }

            if(response.attacment_file){
                $('#aidlistdetail li').remove();
                var attacment_file = response.attacment_file;
                for (var i = 0; i < attacment_file.length; i++){
                    var filename = attacment_file[i].filename;
                    $('#aidlistdetail').append('<li><div class="control-group input-group" id="control-group2" style="margin-top:10px"><a href="{{ asset("files")}}/'+filename+'">'+filename+'</a></div></li>')
                };
            }


            $('#slipnodetail').val(response.slip_no);
            $('#slipcndndetail').val(response.cn_dn);
            $('#slippolicy_nodetail').val(response.policy_no);
            if(response.total_sum_insured){
                $('#sliptotalsumdetail').val(response.total_sum_insured.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
            }
            else
            {
                $('#sliptotalsumdetail').val("0");
            }

            if(response.share_tsi){
                var conv_stsi = parseFloat(response.share_tsi).toFixed(2);
                $('#sharetotalsumdetail').val(conv_stsi.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
            }
            else
            {
                $('#sharetotalsumdetail').val("0");
            }

            
            $('#slippctdetail').val(response.insured_pct);
            if(response.total_sum_pct){
                $('#sliptotalsumpctdetail').val(response.total_sum_pct.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
            }
            else{
                $('#sliptotalsumpctdetail').val("0");
            }


            $('#sliptddetail').val(response.date_transfer);
            $('#slipipfromdetail').val(response.insurance_period_from);
            $('#slipiptodetail').val(response.insurance_period_to);

            var insurance_period_from2 = response.insurance_period_from.split("/").reverse().join("-");
            var insurance_period_to2 = response.insurance_period_to.split("/").reverse().join("-");
            var days=daysBetween(insurance_period_from2, insurance_period_to2);
            
            var sum = isNaN(days / 365) ? 0 :(days / 365).toFixed(3);
            var constday = days.toString() + "/365";

            console.log(insurance_period_from2)
            console.log(insurance_period_to2)
            console.log(days)
            console.log(constday)
            console.log(parseFloat(sum))

            /*
            var fulltgl = $(this).val();

            var tgl = parseInt(fulltgl.substring(0,2));
            console.log(tgl)
            var month = parseInt(fulltgl.substring(3,5));
            console.log(month)
            */
            

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

                $('#slipratedetail').val(response.rate);
                $('#slipsharedetail').val(response.share);

                if(response.sum_share){
                    $('#slipsumsharedetail').val(response.sum_share.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                    $('#slipsumsharedetail2').val(response.sum_share.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                }
                else{
                    $('#slipsumsharedetail').val("0");
                    $('#slipsumsharedetail2').val("0");
                }

                if(response.sum_rate){
                    var conv_srate = parseFloat(response.sum_rate).toFixed(3);
                    $('#sliptotalratedetail').val(conv_srate.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                    $('#sliptotalratedetail2').val(conv_srate.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                }
                else{
                    $('#sliptotalratedetail').val("0");
                    $('#sliptotalratedetail2').val("0");
                }

                if(response.sum_feebroker){
                    $('#slipsumfeedetail').val(response.sum_feebroker.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                    $('#slipsumfeedetail2').val(response.sum_feebroker.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                }
                else{
                    $('#slipsumfeedetail').val("0");
                    $('#slipsumfeedetail2').val("0");
                }


                if(response.basic_premium){
                    $('#slipbasicpremiumdetail').val(response.basic_premium.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                }else
                {
                    $('#slipbasicpremiumdetail').val("0");
                }
                
                if(response.grossprm_to_nr){
                    $('#slipgrossprmtonrdetail').val(response.grossprm_to_nr.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                    $('#slipgrossprmtonrdetail2').val(response.grossprm_to_nr.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                
                }
                else{
                    $('#slipgrossprmtonrdetail').val("0");
                    $('#slipgrossprmtonrdetail2').val("0");
                }

                if(response.commission){
                    $('#slipcommissiondetail').val(response.commission);
                }
                else{
                    $('#slipcommissiondetail').val(0);
                }
                

                if(response.sum_commission){
                    $('#slipsumcommissiondetail').val(response.sum_commission.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                    $('#slipsumcommissiondetail2').val(response.sum_commission.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                
                }
                else{
                    $('#slipsumcommissiondetail').val("0");
                    $('#slipsumcommissiondetail2').val("0");

                }

                if(response.netprm_to_nr){
                    $('#slipnetprmtonrdetail').val(response.netprm_to_nr.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                    $('#slipnetprmtonrdetail2').val(response.netprm_to_nr.replace(/\B(?=(\d{3})+(?!\d))/g, ",")); 
                }
                else{
                    $('#slipnetprmtonrdetail').val("0"); 
                    $('#slipnetprmtonrdetail2').val("0"); 
                }

                if(response.own_retention){
                    $('#slipordetail').val(response.own_retention);
                }
                else{
                    $('#slipordetail').val(0);
                }

                if(response.sum_own_retention){
                    $('#slipsumordetail').val(response.sum_own_retention.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                }
                else{
                    $('#slipsumordetail').val("0");
                }

                $('#countendorsmentdetail').val(response.endorsment);
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

    //triggered when modal is about to be shown
    $('#updatemodaldata').on('show.bs.modal', function(e) {

        $("#tabretroupdate").attr('hidden','true');
         //get data-id attribute of the clicked element
         var codesl = $(e.relatedTarget).data('book-id');
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
            url:'{{ url("/") }}/transaction-data/detailmpslip/'+codesl,
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

                console.log(response)
                console.log('ec ' + response.sum_ec)
                console.log('ippercent ' + response.sum_ippercent)
                
                $('#sliptotalnilaiecupdate').val(response.sum_ec);

                $('#sliptotalpercentinspanupdate').val(response.sum_ippercent);



                    if(response.deductible_panel && response.deductible_panel.length > 10)
                    {

                        var deductibledata = JSON.parse(response.deductible_panel); 

                        $('#deductiblePanelupdate tbody').empty();
                        for(var i = 0; i < deductibledata.length; i++) 
                        {
                            var obj = deductibledata[i];

                            //console.log(obj.id);
                            //$('#interestInsuredTabledetail tbody').prepend('');
                            // var curr_amount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(obj.amount);
                            var conv_amount = obj.amount.toFixed(2);
                            var str_amount = conv_amount.toString();
                            var curr_amount = str_amount.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            // var curr_minamount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(obj.min_claimamount);
                            var conv_minamount = obj.min_claimamount.toFixed(2);
                            var str_minamount = conv_minamount.toString();
                            var curr_minamount = str_minamount.replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                            var conv_percent = parseFloat(obj.percentage).toFixed(2);

                            
                            $('#deductiblePanelupdate tbody').prepend('<tr id="iiddeductibleupdate'+obj.id+'" data-name="deductibleupdatevalue[]"><td data-name="'+obj.deductibletype+'">'+obj.deductibletype+'</td><td data-name="'+obj.percentage+'">'+conv_percent+'%</td><td data-name="'+curr_amount+'">'+curr_amount+'</td><td data-name="'+curr_minamount+'">'+curr_minamount+'</td><td><a href="javascript:void(0)" onclick="deletedeductibleupdate('+obj.id+')">delete</a></td></tr>');

                        }
                    }


                    if(response.extend_coverage && response.extend_coverage.length > 10) 
                    {

                        var extend_coverage = JSON.parse(response.extend_coverage); 

                        $('#ExtendCoveragePanelupdate tbody').empty();
                        for(var i = 0; i < extend_coverage.length; i++) 
                        {
                            var obj = extend_coverage[i];
                            // var curr_amount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(obj.amount);
                            var conv_amount = obj.amount.toFixed(2);
                            var str_amount = conv_amount.toString();
                            var curr_amount =  str_amount.replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                            var conv_percent = parseFloat(obj.percentage).toFixed(3);

                            //console.log(obj.id);
                            //$('#interestInsuredTabledetail tbody').prepend('');
                            
                            $('#ExtendCoveragePanelupdate tbody').prepend('<tr id="iidextendcoverageupdate'+obj.id+'" data-name="extendcoverageupdatevalue[]"><td data-name="'+obj.coveragetype+'">'+obj.coveragecode + ' - ' + obj.coveragename+'</td><td data-name="'+obj.percentage+'">'+conv_percent+'</td><td data-name="'+curr_amount+'">'+curr_amount+'</td><td><a href="javascript:void(0)" onclick="deleteextendcoverageupdate('+obj.id+')">delete</a></td></tr>');
                            
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
                            // var conv_amount = obj.amount.toFixed(2);
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
                            //$('#interestInsuredTabledetail tbody').prepend('');
                            
                            $('#installmentPanelupdate tbody').prepend('<tr id="iidinstallmentupdate'+obj.id+'" data-name="installmentupdatevalue[]"><td data-name="'+obj.installment_date+'">'+strdate+'</td><td data-name="'+obj.percentage+'">'+conv_percent+'%</td><td data-name="'+curr_amount+'">'+curr_amount+'</td><td><a href="javascript:void(0)" onclick="deleteinstallmentupdate('+obj.id+')">delete</a></td></tr>')

                        }
                    }



                    if(response.retrocession_panel && response.retrocession_panel.length > 10)
                    {

                        var retrocession_panel = JSON.parse(response.retrocession_panel); 

                        $('#retrocessionPanelupdate tbody').empty();
                        for(var i = 0; i < retrocession_panel.length; i++) 
                        {
                            var obj = retrocession_panel[i];

                            if(obj.amount)
                            {
                                // var curr_amount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(obj.amount);
                                var conv_amount = obj.amount.toFixed(2);
                                var str_amount = conv_amount.toString();
                                var curr_amount = str_amount.replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                                var conv_percent = parseFloat(obj.percentage).toFixed(2);

                                //console.log(obj.id);
                                //$('#interestInsuredTabledetail tbody').prepend('');
                                
                                
                                $('#retrocessionPanelupdate tbody').prepend('<tr id="iidretrocessionupdate'+obj.id+'" data-name="retrocessionupdatevalue[]"><td data-name="'+obj.type+'">'+obj.type+'</td><td data-name="'+obj.contract+'">'+obj.contract+'</td><td data-name="'+obj.percentage+'">'+conv_percent+'%</td><td data-name="'+curr_amount+'">'+curr_amount+'</td><td><a href="javascript:void(0)" onclick="deleteretrocessionupdate('+obj.id+')">delete</a></td></tr>');
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
                    $("#slipcedingbrokerupdate option[value=" + response.source + "]:first")[0].selected = true;
                }

                if(response.source_2)
                {
                    $("#slipcedingupdate option[value=" + response.source_2 + "]:first")[0].selected = true;
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
                    $("#sliprbupdate option[value=" + response.retro_backup + "]:first")[0].selected = true;
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
                    $('#sliptotalsumupdate').val(conv_tsi.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                    $('#sliptotalsumupdate2').val(conv_tsi.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                }else{
                    $('#sliptotalsumupdate').val(0);
                    $('#sliptotalsumupdate2').val(0);
                }

                if(response.share_tsi){
                    var conv_stsi = parseFloat(response.share_tsi).toFixed(2);
                    $('#sharetotalsumupdate').val(conv_stsi.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                    $('#sharetotalsumupdate2').val(conv_stsi.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                }
                else
                {
                    $('#sharetotalsumupdate').val("0");
                    $('#sharetotalsumupdate2').val("0");
                }
                
                $('#sliptdupdate').val(response.date_transfer);
                $('#sliptdupdate2').val(response.date_transfer);

                if(response.insured_pct){
                    $('#slippctupdate').val( parseFloat(response.insured_pct).toFixed(2));
                }else{
                    $('#slippctupdate').val("0");
                }   
                

                if(response.total_sum_pct)
                {
                    var conv_tsp = parseFloat(response.total_sum_pct).toFixed(2);
                    $('#sliptotalsumpctupdate').val(conv_tsp.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                    $('#sliptotalsumpctupdate2').val(conv_tsp.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                }else{
                    $('#sliptotalsumpctupdate').val(0);
                    $('#sliptotalsumpctupdate2').val(0);
                }
                


                $('#slipipfromupdate').val(response.insurance_period_from);
                $('#slipiptoupdate').val(response.insurance_period_to);

                var insurance_period_from2 = response.insurance_period_from.split("/").reverse().join("-");
                var insurance_period_to2 = response.insurance_period_to.split("/").reverse().join("-");
                var days=daysBetween(insurance_period_from2, insurance_period_to2);
                var sum = isNaN(days / 365) ? 0 :(days / 365).toFixed(3);
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


                $('#sliptotalsumdateupdate').val(parseFloat(sum));
                $('#sliptotalsumdateupdate2').val(parseFloat(sum));

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
                        $('#sliprateupdate').val(parseFloat(response.rate).toFixed(3));
                    }else{
                        $('#sliprateupdate').val("0");
                    }
                    

                    if(response.share){
                        $('#slipshareupdate').val(parseFloat(response.share).toFixed(2));
                    }else{
                        $('#slipshareupdate').val("0");
                    }


                    if(response.v_broker){
                        $('#slipvbrokerupdate').val(parseFloat(response.v_broker).toFixed(2));
                    }else{
                        $('#slipvbrokerupdate').val("0");
                    }
                    
                    
                    
                    if(response.sum_share){
                        var conv_sshare = parseFloat(response.total_sum_pct).toFixed(2);
                        $('#slipsumshareupdate').val(conv_sshare.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                        $('#slipsumshareupdate2').val(conv_sshare.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                        $('#slipoldsumshareupdate2').val(conv_sshare.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                        $('#slipoldsumshareupdate').val(conv_sshare.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                    }else{
                        $('#slipsumshareupdate').val(0);
                        $('#slipsumshareupdate2').val(0);
                        $('#slipoldsumshareupdate2').val(0);
                        $('#slipoldsumshareupdate').val(0);
                    }
                    
                    if(response.basic_premium){
                        var conv_bp = parseFloat(response.total_sum_pct).toFixed(2);
                        $('#slipbasicpremiumupdate').val(conv_bp.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                    }else{
                        $('#slipbasicpremiumupdate').val("0");
                    }
                    
                    
                    if(response.grossprm_to_nr){
                        var gprmtnr = parseFloat(response.grossprm_to_nr).toFixed(2);
                        $('#slipgrossprmtonrupdate').val(gprmtnr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                        $('#slipgrossprmtonrupdate2').val(gprmtnr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                    }else{
                        $('#slipgrossprmtonrupdate').val(0);
                        $('#slipgrossprmtonrupdate2').val(0);
                    }

                    if(response.commission){
                        $('#slipcommissionupdate').val(parseFloat(response.commission).toFixed(2));
                        $('#slipcommissionupdate2').val(parseFloat(response.commission).toFixed(2));
                    }else{
                        $('#slipcommissionupdate').val("0");
                        $('#slipcommissionupdate2').val("0");
                    }
                    
                    
                    if(response.sum_commission){
                        var conv_sc = parseFloat(response.sum_commission).toFixed(2);
                        $('#slipsumcommissionupdate').val(conv_sc.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                        $('#slipsumcommissionupdate2').val(conv_sc.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                    }else{
                        $('#slipsumcommissionupdate').val(0);
                        $('#slipsumcommissionupdate2').val(0);                        
                    }

                    if(response.netprm_to_nr){
                        var conv_nprtnr = parseFloat(response.netprm_to_nr).toFixed(2);
                        $('#slipnetprmtonrupdate').val(conv_nprtnr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                        $('#slipnetprmtonrupdate2').val(conv_nprtnr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                    }else{
                        $('#slipnetprmtonrupdate').val(0);
                        $('#slipnetprmtonrupdate2').val(0);
                    }
                    
                    if(response.sum_rate){
                        var conv_srate = parseFloat(response.sum_rate).toFixed(3);
                        $('#sliptotalrateupdate').val(conv_srate.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                        $('#sliptotalrateupdate2').val(conv_srate.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                    }
                    else{
                        $('#sliptotalrateupdate').val("0");
                        $('#sliptotalrateupdate2').val("0");

                    }

                    if(response.sum_v_broker){
                        var conv_sfee = parseFloat(response.sum_v_broker).toFixed(2);
                        $('#slipsumfeeupdate').val(conv_sfee.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                        $('#slipsumfeeupdate2').val(conv_sfee.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
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
    });
</script>


<script type="text/javascript">

    //triggered when modal is about to be shown
    $('#endorsementmodaldata').on('show.bs.modal', function(e) {

         //get data-id attribute of the clicked element
         $("#tabretroendorsement").attr('hidden','true');
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
        
        $.ajax({
            url:'{{ url("/") }}/transaction-data/detailmpendorsementslip/'+codesl,
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

                    console.log(response)
                console.log('ec ' + response.sum_ec)
                console.log('ippercent ' + response.sum_ippercent)
                    
                    $('#sliptotalnilaiecendorsement').val(response.sum_ec);
                    $('#sliptotalpercentinspanendorsement').val(response.sum_ippercent);


                    if(response.deductible_panel && response.deductible_panel.length > 10)
                    {

                        var deductibledata = JSON.parse(response.deductible_panel); 

                        $('#deductiblePanelendorsement tbody').empty();
                        for(var i = 0; i < deductibledata.length; i++) 
                        {
                            var obj = deductibledata[i];
                            // var curr_amount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(obj.amount);
                            var conv_amount = obj.amount.toFixed(2);
                            var str_amount = conv_amount.toString();
                            var curr_amount = str_amount.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            // var curr_minamount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(obj.min_claimamount);
                            var conv_minamount = obj.min_claimamount.toFixed(2);
                            var str_minamount = conv_minamount.toString();
                            var curr_minamount = str_minamount.replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                            var conv_percent = parseFloat(obj.percentage).toFixed(2);

                            //console.log(obj.id);
                            //$('#interestInsuredTabledetail tbody').prepend('');
                            
                            $('#deductiblePanelendorsement tbody').prepend('<tr id="iiddeductibleendorsement'+obj.id+'" data-name="deductibleendorsementvalue[]"><td data-name="'+obj.deductibletype+'">'+obj.deductibletype+'</td><td data-name="'+obj.percentage+'">'+conv_percent+'%</td><td data-name="'+curr_amount+'">'+curr_amount+'</td><td data-name="'+curr_minamount+'">'+curr_minamount+'</td><td><a href="javascript:void(0)" onclick="deletedeductibleendorsement('+obj.id+')">delete</a></td></tr>');

                        }
                    }


                    if(response.extend_coverage && response.extend_coverage.length > 10)
                    {

                        var extend_coverage = JSON.parse(response.extend_coverage); 

                        $('#ExtendCoveragePanelendorsement tbody').empty();
                        for(var i = 0; i < extend_coverage.length; i++) 
                        {
                            var obj = extend_coverage[i];
                            // var curr_amount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(obj.amount);
                            var conv_amount = obj.amount.toFixed(2);
                            var str_amount = conv_amount.toString();
                            var curr_amount = str_amount.replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                            var conv_percent = parseFloat(obj.percentage).toFixed(3);

                            //console.log(obj.id);
                            //$('#interestInsuredTabledetail tbody').prepend('');
                            
                            $('#ExtendCoveragePanelendorsement tbody').prepend('<tr id="iidextendcoverageendorsement'+obj.id+'" data-name="extendcoverageendorsementvalue[]"><td data-name="'+obj.coveragetype+'">'+obj.coveragecode + ' - ' + obj.coveragename+'</td><td data-name="'+obj.percentage+'">'+conv_percent+'</td><td data-name="'+curr_amount+'">'+curr_amount+'</td><td><a href="javascript:void(0)" onclick="deleteextendcoverageendorsement('+obj.id+')">delete</a></td></tr>');
                            
                        }
                    }


                    if(response.installment_panel && response.installment_panel.length > 10)
                    {
                        
                        var installment_panel = JSON.parse(response.installment_panel); 

                        $('#installmentPanelendorsement tbody').empty();
                        for(var i = 0; i < installment_panel.length; i++) 
                        {
                            var obj = installment_panel[i];
                            // var curr_amount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(obj.amount);
                            // var conv_amount = obj.amount.toFixed(2);
                            // var str_amount = conv_amount.toString();
                            // var curr_amount = str_amount.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            var conv_amount = parseFloat(obj.amount).toFixed(2);
                            var curr_amount =  conv_amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                           var currdate = obj.installment_date;
                            var convdate = currdate.split("-").reverse().join("/");
                            console.log('conv date ' + convdate)
                            var strdate = convdate.toString();

                            var conv_percent = parseFloat(obj.percentage).toFixed(2);

                            //console.log(obj.id);
                            //$('#interestInsuredTabledetail tbody').prepend('');
                            
                            $('#installmentPanelendorsement tbody').prepend('<tr id="iidinstallmentendorsement'+obj.id+'" data-name="installmentendorsementvalue[]"><td data-name="'+obj.installment_date+'">'+strdate+'</td><td data-name="'+obj.percentage+'">'+conv_percent+'%</td><td data-name="'+curr_amount+'">'+curr_amount+'</td><td><a href="javascript:void(0)" onclick="deleteinstallmentendorsement('+obj.id+')">delete</a></td></tr>')

                        }
                    }



                    if(response.retrocession_panel && response.retrocession_panel.length > 10)
                    {

                        var retrocession_panel = JSON.parse(response.retrocession_panel); 

                        $('#retrocessionPanelendorsement tbody').empty();
                        for(var i = 0; i < retrocession_panel.length; i++) 
                        {
                            var obj = retrocession_panel[i];

                            if(obj.amount)
                            {
                                // var curr_amount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(obj.amount);
                                var conv_amount = obj.amount.toFixed(2);
                                var str_amount = conv_amount.toString();
                                var curr_amount = str_amount.replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                                var conv_percent = parseFloat(obj.percentage).toFixed(2);

                                //console.log(obj.id);
                                //$('#interestInsuredTabledetail tbody').prepend('');
                                
                                
                                $('#retrocessionPanelendorsement tbody').prepend('<tr id="iidretrocessionendorsement'+obj.id+'" data-name="retrocessionendorsementvalue[]"><td data-name="'+obj.type+'">'+obj.type+'</td><td data-name="'+obj.contract+'">'+obj.contract+'</td><td data-name="'+obj.percentage+'">'+conv_percent+'%</td><td data-name="'+curr_amount+'">'+curr_amount+'</td><td><a href="javascript:void(0)" onclick="deleteretrocessionendorsement('+obj.id+')">delete</a></td></tr>');
                            }
                        }
                    }
                    
                    
                if(response.status)
                {
                    //$("#slipstatusendorsement option[value=" + response.status + "]:first")[0].selected = true;
                    $("#slipstatusendorsement").val(response.status);
                }

                if(response.source)
                {
                    $("#slipcedingbrokerendorsement option[value=" + response.source + "]:first")[0].selected = true;
                }

                if(response.source_2)
                {
                    $("#slipcedingendorsement option[value=" + response.source_2 + "]:first")[0].selected = true;
                }

                if(response.currency)
                {
                    $("#slipcurrencyendorsement option[value=" + response.currency + "]:first")[0].selected = true;
                }

                if(response.cob)
                {
                    $("#slipcobendorsement option[value=" + response.cob + "]:first")[0].selected = true;
                }

                if(response.koc)
                {
                    $("#slipkocendorsement option[value=" + response.koc + "]:first")[0].selected = true;
                }

                if(response.occupacy)
                {
                    $("#slipoccupacyendorsement option[value=" + response.occupacy + "]:first")[0].selected = true;
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
                $("#sliprbendorsement option[value=" + response.retro_backup + "]:first")[0].selected = true;
                
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
                        
                        $('#slipStatusTableendorsement tbody').prepend('<tr id="stlid'+status_log[i].id+'" data-name="slipvalue[]"><td >'+status+'</td><td >'+datetime+'</td><td >'+user+'</td></tr>')
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
                var conv_tsi = parseFloat(response.total_sum_insured).toFixed(2);
                $('#sliptotalsumendorsement').val(conv_tsi.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                $('#sliptotalsumendorsement2').val(conv_tsi.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
            }else{
                $('#sliptotalsumendorsement').val("0");
                $('#sliptotalsumendorsement2').val("0");
            }

            if(response.share_tsi){
                var conv_stsi = parseFloat(response.share_tsi).toFixed(2);
                $('#sharetotalsumendorsement').val(conv_stsi.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                $('#sharetotalsumendorsement2').val(conv_stsi.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
            }
            else
            {
                $('#sharetotalsumendorsement').val("0");
                $('#sharetotalsumendorsement2').val("0");
            }

            if(response.insured_pct){
                $('#slippctendorsement').val(parseFloat(response.insured_pct).toFixed(2));
            }else{
                $('#slippctendorsement').val("0");
            }
            

            if(response.total_sum_pct){
                var conv_spct = parseFloat(response.total_sum_pct).toFixed(2);
                $('#sliptotalsumpctendorsement').val(conv_spct.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
            }else{
                $('#sliptotalsumpctendorsement').val("0");
            }

            $('#sliptdendorsement').val(response.date_transfer);
            $('#slipipfromendorsement').val(response.insurance_period_from);
            $('#slipiptoendorsement').val(response.insurance_period_to);

            var insurance_period_from2 = response.insurance_period_from.split("/").reverse().join("-");
            var insurance_period_to2 = response.insurance_period_to.split("/").reverse().join("-");
            var days=daysBetween(insurance_period_from2, insurance_period_to2);
            var sum = isNaN(days / 365) ? 0 :(days / 365).toFixed(3);
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
                        $('#sliprateendorsement').val(parseFloat(response.rate).toFixed(3));
                    }else{
                        $('#sliprateendorsement').val("0");
                    }

                    if(response.share){
                        $('#slipshareendorsement').val(parseFloat(response.share).toFixed(2));
                    }else{
                       $('#slipshareendorsement').val("0");
                    }

                    if(response.own_retention){
                       $('#sliporendorsement').val(parseFloat(response.own_retention).toFixed(2));
                    }else{
                       $('#sliporendorsement').val("0");
                    }

                    if(response.commission){
                        $('#slipcommissionendorsement').val(parseFloat(response.commission).toFixed(2));
                    }else{
                       $('#slipcommissionendorsement').val("0");
                    }

                    if(response.v_broker){
                        $('#slipvbrokerendorsement').val(parseFloat(response.v_broker).toFixed(2));
                    }else{
                        $('#slipvbrokerendorsement').val("0");
                    }
                    

                    if(response.basic_premium){
                        var conv_bp = parseFloat(response.basic_premium).toFixed(2);
                        $('#slipbasicpremiumendorsement').val(conv_bp.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                    }else{
                        $('#slipbasicpremiumendorsement').val("0");
                    }

                    if(response.sum_share){
                        var conv_sshare = parseFloat(response.sum_share).toFixed(2);
                        $('#slipsumshareendorsement').val(conv_sshare.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                        $('#slipsumshareendorsement2').val(conv_sshare.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                    }else{
                        $('#slipsumshareendorsement').val("0");
                        $('#slipsumshareendorsement2').val("0");
                    }

                    if(response.sum_rate){
                        var conv_srate = parseFloat(response.sum_rate).toFixed(3);
                        $('#sliptotalrateendorsement').val(conv_srate.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                        $('#sliptotalrateendorsement2').val(conv_srate.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                    }else{
                        $('#sliptotalrateendorsement').val("0");
                        $('#sliptotalrateendorsement2').val("0");
                    }
                    
                    if(response.sum_commission){
                        var conv_scomm = parseFloat(response.sum_commission).toFixed(2);
                        $('#slipsumcommissionendorsement').val(conv_scomm.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                        $('#slipsumcommissionendorsement2').val(conv_scomm.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                    }else{
                        $('#slipsumcommissionendorsement').val("0");
                        $('#slipsumcommissionendorsement2').val("0");
                    }

                    if(response.sum_own_retention){
                        var conv_sor = parseFloat(response.sum_own_retention).toFixed(2);
                        $('#slipsumorendorsement').val(conv_sor.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                        $('#slipsumorendorsement2').val(conv_sor.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                    }else{
                        $('#slipsumorendorsement').val("0");
                        $('#slipsumorendorsement2').val("0");

                    }
                    
                    if(response.sum_feebroker){
                        var conv_sumfee = parseFloat(response.sum_feebroker).toFixed(2);
                        console.log('sum fee broker' + conv_sumfee)
                        $('#slipsumfeeendorsement').val(conv_sumfee.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                        $('#slipsumfeeendorsement2').val(conv_sumfee.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                    }
                    else{
                        $('#slipsumfeeendorsement').val("0");
                        $('#slipsumfeeendorsement2').val("0");
                    }


                    if(response.grossprm_to_nr){
                        var conv_gprmtnr = parseFloat(response.grossprm_to_nr).toFixed(2);
                        $('#slipgrossprmtonrendorsement').val(conv_gprmtnr.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                        $('#slipgrossprmtonrendorsement2').val(conv_gprmtnr.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                    
                    }
                    else{
                        $('#slipgrossprmtonrendorsement').val("0");
                        $('#slipgrossprmtonrendorsement2').val("0");
                    }

                    if(response.netprm_to_nr){
                        var conv_nprtnr = parseFloat(response.netprm_to_nr).toFixed(2);
                        $('#slipnetprmtonrendorsement').val(conv_nprtnr.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                        $('#slipnetprmtonrendorsement2').val(conv_nprtnr.replace(/\B(?=(\d{3})+(?!\d))/g, ",")); 
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
                $('#remarkscancel').val(response.remarks);
     
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
    $('#mpcurrency').change(function(){
        var currency_exc = $(this).val();
        $.ajax({
                type:"GET",
                url:"{{url('get-kurs-detail')}}?currency_id="+currency_exc,
                beforeSend: function() { $("body").addClass("loading");  },
                complete: function() {  $("body").removeClass("loading"); },
                success:function(res){  
                    console.log(res)
                    console.log('kurs ' + res.kurs)      
                    $('#mpkurs').val(res.kurs);
                }
            });
    });
</script>

<link rel="stylesheet" href="{{asset('css/sweetalert2.min.css')}}">
<script src="{{asset('js/sweetalert2.all.min.js')}}"></script>


<style>
.hide {
    display: none;
}
</style>



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
            var sum = isNaN(days / 365) ? 0 :(days / 365).toFixed(2);
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
        var sum = isNaN(days / 365) ? 0 :(days / 365).toFixed(3);
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
        
        // document.getElementById("daytotal").innerHTML = "Total Days :"+days;
    });

    $('#sliprpto').change(function(){
        var insurance_period_from2 = $('#sliprpfrom').val();
        var insurance_period_to2 = $('#sliprpto').val();
        var newinsurance_period_from2 = insurance_period_from2.split("/").reverse().join("-");
        var newinsurance_period_to2 = insurance_period_to2.split("/").reverse().join("-");
        var days=daysBetween(newinsurance_period_from2, newinsurance_period_to2);
        var sum = isNaN(days / 365) ? 0 :(days / 365).toFixed(3);
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
            var sum = isNaN(days / 365) ? 0 :(days / 365).toFixed(3);
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

        var sum = isNaN(day / 365) ? 0 :(day / 365).toFixed(3);

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

        var sum = isNaN(day / year) ? 0 :(day / year).toFixed(3);

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
            var sum = isNaN(days / 365) ? 0 :(days / 365).toFixed(2);
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
        var sum = isNaN(days / 365) ? 0 :(days / 365).toFixed(3);
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
        var sum = isNaN(days / 365) ? 0 :(days / 365).toFixed(3);
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
            var sum = isNaN(days / 365) ? 0 :(days / 365).toFixed(3);
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
            var sum = isNaN(days / 365) ? 0 :(days / 365).toFixed(2);
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
        var sum = isNaN(days / 365) ? 0 :(days / 365).toFixed(3);
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
        var sum = isNaN(days / 365) ? 0 :(days / 365).toFixed(3);
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
            var sum = isNaN(days / 365) ? 0 :(days / 365).toFixed(3);
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

<script type="text/javascript">
    $('#slipoccupacy').change(function(){
         var bld = $('#slipbld_const').val();
        var ocp_id = $('#slipoccupacy').val();
        console.log(bld)
        console.log(ocp_id)
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
                                $("#slipbcua").val(parseInt('0'));
                            }
                            
                            if(res.rate_batas_bawah_building_class_1 != null){
                                $("#slipbcla").val(res.rate_batas_bawah_building_class_1);
                            }else{
                                $("#slipbcla").val(parseInt('0'));
                            }
                            

                        }
                        else if(res.rate_batas_atas_building_class_2 && res.rate_batas_bawah_building_class_2){
                            if(res.rate_batas_atas_building_class_2 != null){
                                $("#slipbcua").val(res.rate_batas_atas_building_class_2);
                            }else{
                                $("#slipbcua").val(parseInt('0'));
                            }
                            
                            if(res.rate_batas_bawah_building_class_2 != null){
                                $("#slipbcla").val(res.rate_batas_bawah_building_class_2);
                            }else{
                                $("#slipbcla").val(parseInt('0'));
                            }
                            
                        }
                        else if(res.rate_batas_atas_building_class_3 && res.rate_batas_bawah_building_class_3){
                            if(res.rate_batas_atas_building_class_3 != null){
                                $("#slipbcua").val(res.rate_batas_atas_building_class_3); 
                            }else{
                                $("#slipbcua").val( parseInt('0'));
                            }
                            
                            if(res.rate_batas_bawah_building_class_3 != null){
                                $("#slipbcla").val(res.rate_batas_bawah_building_class_3);
                            }else{
                                $("#slipbcla").val( parseInt('0'));
                            }
                            
                            
                        }else{
                            if(res.rate_batas_atas_building_class_1){
                                $("#slipbcua").val(res.rate_batas_atas_building_class_1); 
                                $("#slipbcla").val( parseInt('0'));
                            }else if(res.rate_batas_bawah_building_class_1){
                                $("#slipbcla").val(res.rate_batas_bawah_building_class_1); 
                                $("#slipbcua").val( parseInt('0'));
                            }else if(res.rate_batas_atas_building_class_2){
                                $("#slipbcua").val(res.rate_batas_atas_building_class_2); 
                                $("#slipbcla").val( parseInt('0'));
                            }else if(res.rate_batas_bawah_building_class_2){
                                $("#slipbcla").val(res.rate_batas_bawah_building_class_2); 
                                $("#slipbcua").val( parseInt('0'));
                            }else if(res.rate_batas_atas_building_class_3){
                                $("#slipbcua").val(res.rate_batas_atas_building_class_3); 
                                $("#slipbcla").val( parseInt('0'));
                            }else if(res.rate_batas_bawah_building_class_3){
                                $("#slipbcla").val(res.rate_batas_bawah_building_class_3); 
                                $("#slipbcua").val( parseInt('0'));
                            }
                        }
                    }
                });
            }else{
                swal("Error!", "Please choose occupacy first", "Get Building Rate Error");
            }   
        }
    });
</script>



<script type="text/javascript">
    $('#slipbld_const').change(function(){
        var bld = $(this).val();
        var ocp_id = $('#slipoccupacy').val();
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
                    if(res.rate_batas_atas_building_class_1 && res.rate_batas_bawah_building_class_1){
                        if(res.rate_batas_atas_building_class_1 != null){
                            $("#slipbcua").val(res.rate_batas_atas_building_class_1);
                        }else{
                            $("#slipbcua").val(parseInt('0'));
                        }
                        
                        if(res.rate_batas_bawah_building_class_1 != null){
                            $("#slipbcla").val(res.rate_batas_bawah_building_class_1);
                        }else{
                            $("#slipbcla").val(parseInt('0'));
                        }
                        

                    }
                    else if(res.rate_batas_atas_building_class_2 && res.rate_batas_bawah_building_class_2){
                        if(res.rate_batas_atas_building_class_2 != null){
                            $("#slipbcua").val(res.rate_batas_atas_building_class_2);
                        }else{
                            $("#slipbcua").val(parseInt('0'));
                        }
                        
                        if(res.rate_batas_bawah_building_class_2 != null){
                            $("#slipbcla").val(res.rate_batas_bawah_building_class_2);
                        }else{
                            $("#slipbcla").val(parseInt('0'));
                        }
                        
                    }
                    else if(res.rate_batas_atas_building_class_3 && res.rate_batas_bawah_building_class_3){
                        if(res.rate_batas_atas_building_class_3 != null){
                            $("#slipbcua").val(res.rate_batas_atas_building_class_3); 
                        }else{
                            $("#slipbcua").val( parseInt('0'));
                        }
                        
                        if(res.rate_batas_bawah_building_class_3 != null){
                            $("#slipbcla").val(res.rate_batas_bawah_building_class_3);
                        }else{
                            $("#slipbcla").val( parseInt('0'));
                        }
                        
                        
                    }else{
                        if(res.rate_batas_atas_building_class_1){
                            $("#slipbcua").val(res.rate_batas_atas_building_class_1); 
                            $("#slipbcla").val( parseInt('0'));
                        }else if(res.rate_batas_bawah_building_class_1){
                            $("#slipbcla").val(res.rate_batas_bawah_building_class_1); 
                            $("#slipbcua").val( parseInt('0'));
                        }else if(res.rate_batas_atas_building_class_2){
                            $("#slipbcua").val(res.rate_batas_atas_building_class_2); 
                            $("#slipbcla").val( parseInt('0'));
                        }else if(res.rate_batas_bawah_building_class_2){
                            $("#slipbcla").val(res.rate_batas_bawah_building_class_2); 
                            $("#slipbcua").val( parseInt('0'));
                        }else if(res.rate_batas_atas_building_class_3){
                            $("#slipbcua").val(res.rate_batas_atas_building_class_3); 
                            $("#slipbcla").val( parseInt('0'));
                        }else if(res.rate_batas_bawah_building_class_3){
                            $("#slipbcla").val(res.rate_batas_bawah_building_class_3); 
                            $("#slipbcua").val( parseInt('0'));
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
                            $("#slipbcuaupdate").val( parseInt('0'));
                        }else{
                            $("#slipbcuaupdate").val(res.rate_batas_atas_building_class_1);
                        }
                        
                        if(res.rate_batas_bawah_building_class_1 == ' ' || res.rate_batas_bawah_building_class_1 == 0.000){
                            $("#slipbclaupdate").val( parseInt('0'));
                        }else{
                            $("#slipbclaupdate").val(res.rate_batas_bawah_building_class_1);
                        }
                        

                    }
                    else if(res.rate_batas_atas_building_class_2){
                        if(res.rate_batas_atas_building_class_2 == ' ' || res.rate_batas_atas_building_class_2 == 0.000){
                            $("#slipbcuaupdate").val( parseInt('0'));
                        }else{
                            $("#slipbcuaupdate").val(res.rate_batas_atas_building_class_2);
                        }
                        
                        if(res.rate_batas_bawah_building_class_2 == ' ' || res.rate_batas_bawah_building_class_2 == 0.000){
                            $("#slipbclaupdate").val( parseInt('0'));
                        }else{
                            $("#slipbclaupdate").val(res.rate_batas_bawah_building_class_2);
                        }
                        
                    }
                    else if(res.rate_batas_atas_building_class_3){
                        if(res.rate_batas_atas_building_class_3 == ' ' || res.rate_batas_atas_building_class_3 == 0.000){
                            $("#slipbcuaupdate").val( parseInt('0'));
                        }else{
                            $("#slipbcuaupdate").val(res.rate_batas_atas_building_class_3);
                        }
                        
                        if(res.rate_batas_bawah_building_class_3 == ' ' || res.rate_batas_bawah_building_class_3 == 0.000){
                            $("#slipbclaupdate").val( parseInt('0'));
                        }else{
                            $("#slipbclaupdate").val(res.rate_batas_bawah_building_class_3);
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
                            $("#slipbcuaendorsement").val( parseInt('0'));
                        }else{
                            $("#slipbcuaendorsement").val(res.rate_batas_atas_building_class_1);
                        }
                        
                        if(res.rate_batas_bawah_building_class_1 == ' ' || res.rate_batas_bawah_building_class_1 == 0.000){
                            $("#slipbclaendorsement").val( parseInt('0'));
                        }else{
                            $("#slipbclaendorsement").val(res.rate_batas_bawah_building_class_1);
                        }
                        

                    }
                    else if(res.rate_batas_atas_building_class_2){
                        if(res.rate_batas_atas_building_class_2 == ' ' || res.rate_batas_atas_building_class_2 == 0.000){
                            $("#slipbcuaendorsement").val( parseInt('0'));
                        }else{
                            $("#slipbcuaendorsement").val(res.rate_batas_atas_building_class_2);
                        }
                        
                        if(res.rate_batas_bawah_building_class_2 == ' ' || res.rate_batas_bawah_building_class_2 == 0.000){
                            $("#slipbclaendorsement").val( parseInt('0'));
                        }else{
                            $("#slipbclaendorsement").val(res.rate_batas_bawah_building_class_2);
                        }
                        
                    }
                    else if(res.rate_batas_atas_building_class_3){
                        if(res.rate_batas_atas_building_class_3 == ' ' || res.rate_batas_atas_building_class_3 == 0.000){
                            $("#slipbcuaendorsement").val( parseInt('0'));
                        }else{
                            $("#slipbcuaendorsement").val(res.rate_batas_atas_building_class_3);
                        }
                        
                        if(res.rate_batas_bawah_building_class_3 == ' ' || res.rate_batas_bawah_building_class_3 == 0.000){
                            $("#slipbclaendorsement").val( parseInt('0'));
                        }else{
                            $("#slipbclaendorsement").val(res.rate_batas_bawah_building_class_3);
                        }
                        
                        
                    }
                }
            });
        }else{
            swal("Error!", "Please choose occupacy first", "Get Building Rate Error");
        }   
    });

</script>




<script type="text/javascript">
    $('#sliptypetsi').change(function(){
        var choice = $(this).val();
        var valtsi = $('#mpshareto').val();
        var valcedshare = $('#mpshare').val();
        var insuredid = $('#insuredIDtxt').val(); 
        var cedbrok = $('#slipcedingbroker').val();
        var ceding = $('#slipceding').val();

        if(choice == '1'){
            if(valtsi == null){
                swal('warning','please fill tsi insured value first','error')
            }else{
                
                var tsi = $('#mpshareto').val();
                var int_tsi = parseInt(tsi.replace(/,/g, ""));
                var conv_str_tsi = int_tsi.toFixed(2);
                var real_tsi = conv_str_tsi.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('#sliptotalsum').val(real_tsi);
                $('#sliptotalsum2').val(real_tsi);

                var tsislip = $('#sliptotalsum').val();
                var pctval = $('#slippct').val();

                if(pctval != null){
                    var pct =  parseFloat($('#slippct').val())/100;
                    var conv_tsi = parseFloat(tsi.replace(/,/g, ""));

                    var sum = isNaN(pct * conv_tsi) ? 0 :(pct * conv_tsi) ;
                    console.log('sum ' + sum)
                   var conv_sum = parseFloat(sum).toFixed(2);
                    console.log('conv_sum' + conv_sum)
                    var real_sum = conv_sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    
                    console.log('real_sum' + real_sum)

                    $('#sliptotalsumpct').val(real_sum);
                    $('#sliptotalsumpct2').val(real_sum);
                    // swal('success','changed to tsi','success')


                    var dpamount = $('#slipdpamount').val();
                    var ecamount = $('#slipamountec').val();

                    if(dpamount != null){

                        var percent =  parseFloat($('#slipdppercentage').val()) / 100;
                        
                        var sum = isNaN(percent * conv_tsi) ? 0 :(percent * conv_tsi).toFixed(2) ;
                        var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        console.log($('#slipdppercentage').val())
                        console.log(percent)
                        console.log(sum)
                        console.log(real_sum)

                        $('#slipdpamount').val(real_sum);
                        $('#slipdpamount2').val(real_sum);

                    }

                    if(ecamount != null){

                        var persentage =  parseFloat($('#slipnilaiec').val()) / 1000;
                        var sum = isNaN(conv_tsi * persentage) ? 0 :(conv_tsi * persentage).toFixed(2) ;
                        var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        console.log($('#slipnilaiec').val())
                        console.log(persentage)
                        console.log(sum)
                        console.log(real_sum)

                        $('#slipamountec').val(real_sum);
                        $('#slipamountec2').val(real_sum);

                    }

                }
            }
        }else if(choice == '2')
        {
            if(cedbrok != null && ceding != null){
                // var ceding_share = $('#mpshare').val();
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

                            var ceding_curr = $('#slipceding').val();
                            var totalsum = $("#sliptotalsum").val();
                            if(res.amountlist > 0)
                            {
                                console.log('sum amount ' + res.sumamount)
                                var sum = res.sumamount;
                               var conv_sum = parseFloat(sum).toFixed(2);
                                var real_sum = conv_sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                $("#sliptotalsum").val(real_sum);
                                $("#sliptotalsum2").val(real_sum);

                                var tsicedshare = $("#sliptotalsum").val();
                                var pctval = $('#sliptotalsumpct').val();

                                if(pctval != null){

                                    var pct =  parseFloat($('#slippct').val())/100;

                                    // var tsi = $("#sliptotalsum").val();
                                    var conv_tsi = parseInt(tsicedshare.replace(/,/g, ""));

                                    var sum = isNaN(pct * conv_tsi) ? 0 :(pct * conv_tsi).toFixed(2) ;
                                    console.log(sum)
                                    var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    $('#sliptotalsumpct').val(real_sum);
                                    $('#sliptotalsumpct2').val(real_sum);
                                    // swal('success','changed to ceding share','success')

                                    var dpamount = $('#slipdpamount').val();
                                    var ecamount = $('#slipamountec').val();

                                    if(dpamount != null){
                                        var percent =  parseFloat($('#slipdppercentage').val()) / 100;
                                        
                                        var sum = isNaN(percent * conv_tsi) ? 0 :(percent * conv_tsi).toFixed(2) ;
                                        var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                        console.log($('#slipdppercentage').val())
                                        console.log(percent)
                                        console.log(sum)
                                        console.log(real_sum)

                                        $('#slipdpamount').val(real_sum);
                                        $('#slipdpamount2').val(real_sum);
                                    }

                                    if(ecamount != null){

                                        var persentage =  parseFloat($('#slipnilaiec').val()) / 1000;
                                        var sum = isNaN(conv_tsi * persentage) ? 0 :(conv_tsi * persentage).toFixed(2) ;
                                        var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                        console.log($('#slipnilaiec').val())
                                        console.log(persentage)
                                        console.log(sum)
                                        console.log(real_sum)

                                        $('#slipamountec').val(real_sum);
                                        $('#slipamountec2').val(real_sum);
                                        
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
    $('#sharetypetsi').change(function(){
        var choice = $(this).val();
        if(choice == '1'){

            var tsi = $('#mpshareto').val();
            var int_tsi = parseInt(tsi.replace(/,/g, ""));
            var conv_str_tsi = int_tsi.toFixed(2);
            var real_tsi = conv_str_tsi.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            $('#sharetotalsum').val(real_tsi);
            $('#sharetotalsum2').val(real_tsi);

            var shareslipval = $('#slipshare').val();
            if(shareslipval != null){
                var shareslip =  parseFloat($('#slipshare').val()) / 100 ;
                var conv_tsi = parseInt(tsi.replace(/,/g, ""));
                var sumshare =isNaN( shareslip * conv_tsi) ? 0 :( shareslip * conv_tsi).toFixed(2) ;
                var real_sumshare = sumshare.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


                $('#slipsumshare').val(real_sumshare);
                $('#slipsumshare2').val(real_sumshare);

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
                    var conv_totalrate = parseInt(sumrate.replace(/,/g, ""));
                    var sumrate = isNaN(((conv_totalrate / 1000) * conv_tsi) * insurance) ? 0 :(((conv_totalrate / 1000) * conv_tsi) * insurance).toFixed(2) ;
                    var real_sumrate = sumrate.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                    $('#slipbasicpremium').val(real_sumrate);

                    var grossprm_to_nr = $('#slipgrossprmtonr').val();

                    if(grossprm_to_nr != null){
                        var nasionalreinsurance =  $('#mpsharefrom').val();
                        var totalnre =  $('#mpshareto').val();
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

                            var sumor = isNaN(orpercent * conv_sumshare) ? 0 :(orpercent * conv_sumshare).toFixed(2);
                            var real_sumor = sumor.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            
                            var sumgrtoprm = isNaN(conv_basre * shareslip) ? 0 :(conv_basre * shareslip ).toFixed(2);
                            var real_sumgrtoprm = sumgrtoprm.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            
                            if(nasionalreinsurance){
                                var conv_nasionalreinsurance =  parseInt(nasionalreinsurance.replace(/,/g, ""));
                                var sumnre = isNaN(conv_nasionalreinsurance + conv_sumshare ) ? 0 :(conv_nasionalreinsurance + conv_sumshare).toFixed(2) ;
                                var real_sumnre = sumnre.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            }else{
                                var conv_nasionalreinsurance =  parseInt(nasionalreinsurance.replace(/,/g, ""));
                                var sumnre = isNaN(0 + conv_sumshare ) ? 0 :(0 + conv_sumshare).toFixed(2) ;
                                var real_sumnre = sumnre.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            }
                            
                            
                            var sumourshare = isNaN((sumnre / conv_totalnre) * 100 ) ? 0 :((sumnre / conv_totalnre) * 100 ).toFixed(2) ;

                            console.log('sumnre' + sumnre)
                            console.log('realnre' + real_sumnre)
                            console.log('sumourshare' + sumourshare)

                            $('#slipgrossprmtonr').val(real_sumgrtoprm);
                            $('#slipgrossprmtonr2').val(real_sumgrtoprm);
                            $('#slipsumor').val(real_sumor);
                            $('#slipsumor2').val(real_sumor);
                            // $('#mpshare').val(sumourshare.replace(/,/g, "."));
                            $('#mpsharefrom').val(real_sumnre);


                            var commision =  parseFloat($(this).val()) / 100;
                            var feebroker = parseFloat($('#slipvbroker').val()) / 100;
                            var sumgrossprmtonr2 = $("#slipgrossprmtonr").val();
                            var conv_sumgrossprmtonr = parseInt(sumgrossprmtonr2.replace(/,/g, ""));

                            var sumcomm = isNaN(commision * conv_sumgrossprmtonr) ? 0 :(commision * conv_sumgrossprmtonr).toFixed(2);
                            var real_sumcomm = sumcomm.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                            $('#slipsumcommission').val(real_sumcomm);
                            $('#slipsumcommission2').val(real_sumcomm);

                            var sumgrossprmtonr3 = $("#slipgrossprmtonr").val();
                            var conv_sumgrossprmtonr2 = parseInt(sumgrossprmtonr3.replace(/,/g, ""));

                            var sumnetprmtonr = isNaN( conv_sumgrossprmtonr2 * (100/100 - commision - feebroker)) ? 0 :(conv_sumgrossprmtonr2 * (100/100 - commision - feebroker)).toFixed(2);
                            var real_sumnetprmtonr = sumnetprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                            var sumfeebroker = isNaN( conv_sumgrossprmtonr2 * feebroker) ? 0 :(conv_sumgrossprmtonr2 * feebroker).toFixed(2);
                            var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


                            $('#slipnetprmtonr').val(real_sumnetprmtonr);
                            $('#slipnetprmtonr2').val(real_sumnetprmtonr);
                            // $('#slipsumfee').val("100" + "-" + commision.toString() + "-" + feebroker.toString() + "*" + conv_sumgrossprmtonr.toString());
                            $('#slipsumfee').val(real_sumfeebroker);
                            $('#slipsumfee2').val(real_sumfeebroker);

                            var sumipamountval = $('#slipipamount').val();

                            if(sumipamountval != null){
                                var percent =  parseFloat($(this).val()) / 100;

                                var sumnetprtonr2 = $("#slipnetprmtonr").val();
                                var conv_sumnetprtonr = parseInt(sumnetprtonr2.replace(/,/g, ""));

                                var sumipamount = isNaN(percent *  conv_sumnetprtonr) ? 0 :(percent *  conv_sumnetprtonr).toFixed(2);
                                var real_sumipamount = sumipamount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                                $('#slipipamount').val(real_sumipamount);
                                $('#slipipamount2').val(real_sumipamount);
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
                    url:"{{url('get-ceding-detail')}}?ceding_id="+ceding+"&insured_id="+insuredid,
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
                               var conv_sum = parseFloat(sum).toFixed(2);
                                var real_sum = conv_sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                $("#sharetotalsum").val(real_sum);
                                $("#sharetotalsum2").val(real_sum);
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
            var tsi = $('#mpshare').val();
            $('#sharetotalsum').val(tsi);
            $('#sharetotalsum2').val(tsi);

            var shareslipval = $('#slipshare').val();
            if(shareslipval != null){
                var shareslip =  parseFloat($('#slipshare').val()) / 100 ;
                var conv_tsi = parseInt(tsi.replace(/,/g, ""));
                var sumshare =isNaN( shareslip * conv_tsi) ? 0 :( shareslip * conv_tsi).toFixed(2) ;
                var real_sumshare = sumshare.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


                $('#slipsumshare').val(real_sumshare);
                $('#slipsumshare2').val(real_sumshare);

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
                    var sumrate = isNaN(((conv_totalrate / 1000) * conv_tsi) * insurance) ? 0 :(((conv_totalrate / 1000) * conv_tsi) * insurance).toFixed(2) ;
                    var real_sumrate = sumrate.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                    $('#slipbasicpremium').val(real_sumrate);

                    var grossprm_to_nr = $('#slipgrossprmtonr').val();

                    if(grossprm_to_nr != null){
                        var nasionalreinsurance =  $('#mpsharefrom').val();
                        var totalnre =  $('#mpshareto').val();
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

                            var sumor = isNaN(orpercent * conv_sumshare) ? 0 :(orpercent * conv_sumshare).toFixed(2);
                            var real_sumor = sumor.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            
                            var sumgrtoprm = isNaN(conv_basre * shareslip) ? 0 :(conv_basre * shareslip ).toFixed(2);
                            var real_sumgrtoprm = sumgrtoprm.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            
                            if(nasionalreinsurance){
                                var conv_nasionalreinsurance =  parseInt(nasionalreinsurance.replace(/,/g, ""));
                                var sumnre = isNaN(conv_nasionalreinsurance + conv_sumshare ) ? 0 :(conv_nasionalreinsurance + conv_sumshare).toFixed(2) ;
                                var real_sumnre = sumnre.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            }else{
                                var conv_nasionalreinsurance =  parseInt(nasionalreinsurance.replace(/,/g, ""));
                                var sumnre = isNaN(0 + conv_sumshare ) ? 0 :(0 + conv_sumshare).toFixed(2) ;
                                var real_sumnre = sumnre.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            }
                            
                            
                            var sumourshare = isNaN((sumnre / conv_totalnre) * 100 ) ? 0 :((sumnre / conv_totalnre) * 100 ).toFixed(2) ;

                            console.log('sumnre' + sumnre)
                            console.log('realnre' + real_sumnre)
                            console.log('sumourshare' + sumourshare)

                            $('#slipgrossprmtonr').val(real_sumgrtoprm);
                            $('#slipgrossprmtonr2').val(real_sumgrtoprm);
                            $('#slipsumor').val(real_sumor);
                            $('#slipsumor2').val(real_sumor);
                            // $('#mpshare').val(sumourshare.replace(/,/g, "."));
                            $('#mpsharefrom').val(real_sumnre);


                            var commision =  parseFloat($(this).val()) / 100;
                            var feebroker = parseFloat($('#slipvbroker').val()) / 100;
                            var sumgrossprmtonr2 = $("#slipgrossprmtonr").val();
                            var conv_sumgrossprmtonr = parseInt(sumgrossprmtonr2.replace(/,/g, ""));

                            var sumcomm = isNaN(commision * conv_sumgrossprmtonr) ? 0 :(commision * conv_sumgrossprmtonr).toFixed(2);
                            var real_sumcomm = sumcomm.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                            $('#slipsumcommission').val(real_sumcomm);
                            $('#slipsumcommission2').val(real_sumcomm);

                            var sumgrossprmtonr3 = $("#slipgrossprmtonr").val();
                            var conv_sumgrossprmtonr2 = parseInt(sumgrossprmtonr3.replace(/,/g, ""));

                            var sumnetprmtonr = isNaN( conv_sumgrossprmtonr2 * (100/100 - commision - feebroker)) ? 0 :(conv_sumgrossprmtonr2 * (100/100 - commision - feebroker)).toFixed(2);
                            var real_sumnetprmtonr = sumnetprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                            var sumfeebroker = isNaN( conv_sumgrossprmtonr2 * feebroker) ? 0 :(conv_sumgrossprmtonr2 * feebroker).toFixed(2);
                            var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


                            $('#slipnetprmtonr').val(real_sumnetprmtonr);
                            $('#slipnetprmtonr2').val(real_sumnetprmtonr);
                            // $('#slipsumfee').val("100" + "-" + commision.toString() + "-" + feebroker.toString() + "*" + conv_sumgrossprmtonr.toString());
                            $('#slipsumfee').val(real_sumfeebroker);
                            $('#slipsumfee2').val(real_sumfeebroker);

                            var sumipamountval = $('#slipipamount').val();

                            if(sumipamountval != null){
                                var percent =  parseFloat($(this).val()) / 100;

                                var sumnetprtonr2 = $("#slipnetprmtonr").val();
                                var conv_sumnetprtonr = parseInt(sumnetprtonr2.replace(/,/g, ""));

                                var sumipamount = isNaN(percent *  conv_sumnetprtonr) ? 0 :(percent *  conv_sumnetprtonr).toFixed(2);
                                var real_sumipamount = sumipamount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                                $('#slipipamount').val(real_sumipamount);
                                $('#slipipamount2').val(real_sumipamount);
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
        var valtsi = $('#mpshareto').val();
        var valcedshare = $('#mpshare').val();
        var insuredid = $('#insuredIDtxt').val(); 
        var cedbrok = $('#slipcedingbrokerendorsement').val();
        var ceding = $('#slipcedingendorsement').val();

        if(choice == '1'){
            if(valtsi == null){
                swal('warning','please fill tsi insured value first','error')
            }else{
                
                var tsi = $('#mpshareto').val();
                var int_tsi = parseInt(tsi.replace(/,/g, ""));
                var conv_str_tsi = int_tsi.toFixed(2);
                var real_tsi = conv_str_tsi.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('#sliptotalsumendorsement').val(real_tsi);
                $('#sliptotalsumendorsement2').val(real_tsi);

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

                    $('#sliptotalsumpctendorsement').val(real_sum);
                    $('#sliptotalsumpctendorsement2').val(real_sum);
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

                        $('#slipdpamountendorsement').val(real_sum);
                        $('#slipdpamountendorsement2').val(real_sum);

                    }

                    if(ecamount != null){

                        var persentage =  parseFloat($('#slipnilaiecendorsement').val()) / 1000;
                        var sum = isNaN(conv_tsi * persentage) ? 0 :(conv_tsi * persentage).toFixed(2) ;
                        var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        console.log($('#slipnilaiecendorsement').val())
                        console.log(persentage)
                        console.log(sum)
                        console.log(real_sum)

                        $('#slipamountecendorsement').val(real_sum);
                        $('#slipamountecendorsement2').val(real_sum);

                    }

                }
            }
        }else if(choice == '2')
        {
            if(cedbrok != null && ceding != null){
                // var ceding_share = $('#mpshare').val();
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
                                $("#sliptotalsumendorsement").val(real_sum);
                                $("#sliptotalsumendorsement2").val(real_sum);

                                var tsicedshare = $("#sliptotalsumendorsement").val();
                                var pctval = $('#sliptotalsumpctendorsement').val();

                                if(pctval != null){

                                    var pct =  parseFloat($('#slippctendorsement').val())/100;

                                    // var tsi = $("#sliptotalsum").val();
                                    var conv_tsi = parseInt(tsicedshare.replace(/,/g, ""));

                                    var sum = isNaN(pct * conv_tsi) ? 0 :(pct * conv_tsi).toFixed(2) ;
                                    console.log(sum)
                                    var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    $('#sliptotalsumpctendorsement').val(real_sum);
                                    $('#sliptotalsumpctendorsement2').val(real_sum);
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

                                        $('#slipdpamountendorsement').val(real_sum);
                                        $('#slipdpamountendorsement2').val(real_sum);
                                    }

                                    if(ecamount != null){

                                        var persentage =  parseFloat($('#slipnilaiecendorsement').val()) / 1000;
                                        var sum = isNaN(conv_tsi * persentage) ? 0 :(conv_tsi * persentage).toFixed(2) ;
                                        var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                        console.log($('#slipnilaiecendorsement').val())
                                        console.log(persentage)
                                        console.log(sum)
                                        console.log(real_sum)

                                        $('#slipamountecendorsement').val(real_sum);
                                        $('#slipamountecendorsement2').val(real_sum);
                                        
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

            var tsi = $('#mpshareto').val();
            var int_tsi = parseInt(tsi.replace(/,/g, ""));
            var conv_str_tsi = int_tsi.toFixed(2);
            var real_tsi = conv_str_tsi.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            $('#sharetotalsumendorsement').val(real_tsi);
            $('#sharetotalsumendorsement2').val(real_tsi);

            var shareslipval = $('#slipshareendorsement').val();
            if(shareslipval != null){
                var shareslip =  parseFloat($('#slipshareendorsement').val()) / 100 ;
                var conv_tsi = parseInt(tsi.replace(/,/g, ""));
                var sumshare =isNaN( shareslip * conv_tsi) ? 0 :( shareslip * conv_tsi).toFixed(2) ;
                var real_sumshare = sumshare.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


                $('#slipsumshareendorsement').val(real_sumshare);
                $('#slipsumshareendorsement2').val(real_sumshare);

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
                    var sumrate = isNaN(((conv_totalrate / 1000) * conv_tsi) * insurance) ? 0 :(((conv_totalrate / 1000) * conv_tsi) * insurance).toFixed(2) ;
                    var real_sumrate = sumrate.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                    $('#slipbasicpremiumendorsement').val(real_sumrate);

                    var grossprm_to_nr = $('#slipgrossprmtonrendorsement').val();

                    if(grossprm_to_nr != null){
                        var nasionalreinsurance =  $('#mpsharefromendorsement').val();
                        var totalnre =  $('#mpsharetoendorsement').val();
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

                            var sumor = isNaN(orpercent * conv_sumshare) ? 0 :(orpercent * conv_sumshare).toFixed(2);
                            var real_sumor = sumor.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            
                            var sumgrtoprm = isNaN(conv_basre * shareslip) ? 0 :(conv_basre * shareslip ).toFixed(2);
                            var real_sumgrtoprm = sumgrtoprm.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            
                            if(nasionalreinsurance){
                                var conv_nasionalreinsurance =  parseInt(nasionalreinsurance.replace(/,/g, ""));
                                var sumnre = isNaN(conv_nasionalreinsurance + conv_sumshare ) ? 0 :(conv_nasionalreinsurance + conv_sumshare).toFixed(2) ;
                                var real_sumnre = sumnre.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            }else{
                                var conv_nasionalreinsurance =  parseInt(nasionalreinsurance.replace(/,/g, ""));
                                var sumnre = isNaN(0 + conv_sumshare ) ? 0 :(0 + conv_sumshare).toFixed(2) ;
                                var real_sumnre = sumnre.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            }
                            
                            
                            var sumourshare = isNaN((sumnre / conv_totalnre) * 100 ) ? 0 :((sumnre / conv_totalnre) * 100 ).toFixed(2) ;

                            console.log('sumnre' + sumnre)
                            console.log('realnre' + real_sumnre)
                            console.log('sumourshare' + sumourshare)

                            $('#slipgrossprmtonrendorsement').val(real_sumgrtoprm);
                            $('#slipgrossprmtonrendorsement2').val(real_sumgrtoprm);
                            $('#slipsumorendorsement').val(real_sumor);
                            $('#slipsumorendorsement2').val(real_sumor);
                            // $('#mpshare').val(sumourshare.replace(/,/g, "."));
                            $('#mpsharefrom').val(real_sumnre);


                            var commision =  parseFloat($(this).val()) / 100;
                            var feebroker = parseFloat($('#slipvbrokerendorsement').val()) / 100;
                            var sumgrossprmtonr2 = $("#slipgrossprmtonrendorsement").val();
                            var conv_sumgrossprmtonr = parseInt(sumgrossprmtonr2.replace(/,/g, ""));

                            var sumcomm = isNaN(commision * conv_sumgrossprmtonr) ? 0 :(commision * conv_sumgrossprmtonr).toFixed(2);
                            var real_sumcomm = sumcomm.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                            $('#slipsumcommissionendorsement').val(real_sumcomm);
                            $('#slipsumcommissionendorsement2').val(real_sumcomm);

                            var sumgrossprmtonr3 = $("#slipgrossprmtonrendorsement").val();
                            var conv_sumgrossprmtonr2 = parseInt(sumgrossprmtonr3.replace(/,/g, ""));

                            var sumnetprmtonr = isNaN( conv_sumgrossprmtonr2 * (100/100 - commision - feebroker)) ? 0 :(conv_sumgrossprmtonr2 * (100/100 - commision - feebroker)).toFixed(2);
                            var real_sumnetprmtonr = sumnetprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                            var sumfeebroker = isNaN( conv_sumgrossprmtonr2 * feebroker) ? 0 :(conv_sumgrossprmtonr2 * feebroker).toFixed(2);
                            var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


                            $('#slipnetprmtonrendorsement').val(real_sumnetprmtonr);
                            $('#slipnetprmtonrendorsement2').val(real_sumnetprmtonr);
                            // $('#slipsumfee').val("100" + "-" + commision.toString() + "-" + feebroker.toString() + "*" + conv_sumgrossprmtonr.toString());
                            $('#slipsumfeeendorsement').val(real_sumfeebroker);
                            $('#slipsumfeeendorsement2').val(real_sumfeebroker);

                            var sumipamountval = $('#slipipamountendorsement').val();

                            if(sumipamountval != null){
                                var percent =  parseFloat($(this).val()) / 100;

                                var sumnetprtonr2 = $("#slipnetprmtonrendorsement").val();
                                var conv_sumnetprtonr = parseInt(sumnetprtonr2.replace(/,/g, ""));

                                var sumipamount = isNaN(percent *  conv_sumnetprtonr) ? 0 :(percent *  conv_sumnetprtonr).toFixed(2);
                                var real_sumipamount = sumipamount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                                $('#slipipamountendorsement').val(real_sumipamount);
                                $('#slipipamountendorsement2').val(real_sumipamount);
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
                            $("#sharetotalsumendorsement").val(real_sum);
                            $("#sharetotalsumendorsement2").val(real_sum);
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
            var tsi = $('#mpshare').val();
            $('#sharetotalsumendorsement').val(tsi);
            $('#sharetotalsumendorsement2').val(tsi);

            var shareslipval = $('#slipshareendorsement').val();
            if(shareslipval != null){
                var shareslip =  parseFloat($('#slipshareendorsement').val()) / 100 ;
                var conv_tsi = parseInt(tsi.replace(/,/g, ""));
                var sumshare =isNaN( shareslip * conv_tsi) ? 0 :( shareslip * conv_tsi).toFixed(2) ;
                var real_sumshare = sumshare.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


                $('#slipsumshareendorsement').val(real_sumshare);
                $('#slipsumshareendorsement2').val(real_sumshare);

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
                    var sumrate = isNaN(((conv_totalrate / 1000) * conv_tsi) * insurance) ? 0 :(((conv_totalrate / 1000) * conv_tsi) * insurance).toFixed(2) ;
                    var real_sumrate = sumrate.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                    $('#slipbasicpremiumendorsement').val(real_sumrate);

                    var grossprm_to_nr = $('#slipgrossprmtonrendorsement').val();

                    if(grossprm_to_nr != null){
                        var nasionalreinsurance =  $('#mpsharefromendorsement').val();
                        var totalnre =  $('#mpsharetoendorsement').val();
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

                            var sumor = isNaN(orpercent * conv_sumshare) ? 0 :(orpercent * conv_sumshare).toFixed(2);
                            var real_sumor = sumor.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            
                            var sumgrtoprm = isNaN(conv_basre * shareslip) ? 0 :(conv_basre * shareslip ).toFixed(2);
                            var real_sumgrtoprm = sumgrtoprm.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            
                            if(nasionalreinsurance){
                                var conv_nasionalreinsurance =  parseInt(nasionalreinsurance.replace(/,/g, ""));
                                var sumnre = isNaN(conv_nasionalreinsurance + conv_sumshare ) ? 0 :(conv_nasionalreinsurance + conv_sumshare).toFixed(2) ;
                                var real_sumnre = sumnre.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            }else{
                                var conv_nasionalreinsurance =  parseInt(nasionalreinsurance.replace(/,/g, ""));
                                var sumnre = isNaN(0 + conv_sumshare ) ? 0 :(0 + conv_sumshare).toFixed(2) ;
                                var real_sumnre = sumnre.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            }
                            
                            
                            var sumourshare = isNaN((sumnre / conv_totalnre) * 100 ) ? 0 :((sumnre / conv_totalnre) * 100 ).toFixed(2) ;

                            console.log('sumnre' + sumnre)
                            console.log('realnre' + real_sumnre)
                            console.log('sumourshare' + sumourshare)

                            $('#slipgrossprmtonrendorsement').val(real_sumgrtoprm);
                            $('#slipgrossprmtonrendorsement2').val(real_sumgrtoprm);
                            $('#slipsumorendorsement').val(real_sumor);
                            $('#slipsumorendorsement2').val(real_sumor);
                            // $('#mpshare').val(sumourshare.replace(/,/g, "."));
                            $('#mpsharefrom').val(real_sumnre);


                            var commision =  parseFloat($(this).val()) / 100;
                            var feebroker = parseFloat($('#slipvbrokerendorsement').val()) / 100;
                            var sumgrossprmtonr2 = $("#slipgrossprmtonrendorsement").val();
                            var conv_sumgrossprmtonr = parseInt(sumgrossprmtonr2.replace(/,/g, ""));

                            var sumcomm = isNaN(commision * conv_sumgrossprmtonr) ? 0 :(commision * conv_sumgrossprmtonr).toFixed(2);
                            var real_sumcomm = sumcomm.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                            $('#slipsumcommissionendorsement').val(real_sumcomm);
                            $('#slipsumcommissionendorsement2').val(real_sumcomm);

                            var sumgrossprmtonr3 = $("#slipgrossprmtonrendorsement").val();
                            var conv_sumgrossprmtonr2 = parseInt(sumgrossprmtonr3.replace(/,/g, ""));

                            var sumnetprmtonr = isNaN( conv_sumgrossprmtonr2 * (100/100 - commision - feebroker)) ? 0 :(conv_sumgrossprmtonr2 * (100/100 - commision - feebroker)).toFixed(2);
                            var real_sumnetprmtonr = sumnetprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                            var sumfeebroker = isNaN( conv_sumgrossprmtonr2 * feebroker) ? 0 :(conv_sumgrossprmtonr2 * feebroker).toFixed(2);
                            var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


                            $('#slipnetprmtonrendorsement').val(real_sumnetprmtonr);
                            $('#slipnetprmtonrendorsement2').val(real_sumnetprmtonr);
                            // $('#slipsumfee').val("100" + "-" + commision.toString() + "-" + feebroker.toString() + "*" + conv_sumgrossprmtonr.toString());
                            $('#slipsumfeeendorsement').val(real_sumfeebroker);
                            $('#slipsumfeeendorsement2').val(real_sumfeebroker);

                            var sumipamountval = $('#slipipamountendorsement').val();

                            if(sumipamountval != null){
                                var percent =  parseFloat($(this).val()) / 100;

                                var sumnetprtonr2 = $("#slipnetprmtonrendorsement").val();
                                var conv_sumnetprtonr = parseInt(sumnetprtonr2.replace(/,/g, ""));

                                var sumipamount = isNaN(percent *  conv_sumnetprtonr) ? 0 :(percent *  conv_sumnetprtonr).toFixed(2);
                                var real_sumipamount = sumipamount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                                $('#slipipamountendorsement').val(real_sumipamount);
                                $('#slipipamountendorsement2').val(real_sumipamount);
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
        var valtsi = $('#mpshareto').val();
        var valcedshare = $('#mpshare').val();
        var insuredid = $('#insuredIDtxt').val(); 
        var cedbrok = $('#slipcedingbrokerupdate').val();
        var ceding = $('#slipcedingupdate').val();

        if(choice == '1'){
            if(valtsi == null){
                swal('warning','please fill tsi insured value first','error')
            }else{
                
                var tsi = $('#mpshareto').val();
                var int_tsi = parseInt(tsi.replace(/,/g, ""));
                var conv_str_tsi = int_tsi.toFixed(2);
                var real_tsi = conv_str_tsi.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('#sliptotalsumupdate').val(real_tsi);
                $('#sliptotalsumupdate2').val(real_tsi);

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

                    $('#sliptotalsumpctupdate').val(real_sum);
                    $('#sliptotalsumpctupdate2').val(real_sum);
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

                        $('#slipdpamountupdate').val(real_sum);
                        $('#slipdpamountupdate2').val(real_sum);

                    }

                    if(ecamount != null){

                        var persentage =  parseFloat($('#slipnilaiecupdate').val()) / 1000;
                        var sum = isNaN(conv_tsi * persentage) ? 0 :(conv_tsi * persentage).toFixed(2) ;
                        var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        console.log($('#slipnilaiecupdate').val())
                        console.log(persentage)
                        console.log(sum)
                        console.log(real_sum)

                        $('#slipamountecupdate').val(real_sum);
                        $('#slipamountecupdate2').val(real_sum);

                    }

                }
            }
        }else if(choice == '2')
        {
            if(cedbrok != null && ceding != null){
                // var ceding_share = $('#mpshare').val();
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
                                $("#sliptotalsumupdate").val(real_sum);
                                $("#sliptotalsumupdate2").val(real_sum);

                                var tsicedshare = $("#sliptotalsumupdate").val();
                                var pctval = $('#sliptotalsumpctupdate').val();

                                if(pctval != null){

                                    var pct =  parseFloat($('#slippctupdate').val())/100;

                                    // var tsi = $("#sliptotalsum").val();
                                    var conv_tsi = parseInt(tsicedshare.replace(/,/g, ""));

                                    var sum = isNaN(pct * conv_tsi) ? 0 :(pct * conv_tsi).toFixed(2) ;
                                    console.log(sum)
                                    var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    $('#sliptotalsumpctupdate').val(real_sum);
                                    $('#sliptotalsumpctupdate2').val(real_sum);
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

                                        $('#slipdpamountupdate').val(real_sum);
                                        $('#slipdpamountupdate2').val(real_sum);
                                    }

                                    if(ecamount != null){

                                        var persentage =  parseFloat($('#slipnilaiecupdate').val()) / 1000;
                                        var sum = isNaN(conv_tsi * persentage) ? 0 :(conv_tsi * persentage).toFixed(2) ;
                                        var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                        console.log($('#slipnilaiecupdate').val())
                                        console.log(persentage)
                                        console.log(sum)
                                        console.log(real_sum)

                                        $('#slipamountecupdate').val(real_sum);
                                        $('#slipamountecupdate2').val(real_sum);
                                        
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

            var tsi = $('#mpshareto').val();
            var int_tsi = parseInt(tsi.replace(/,/g, ""));
            var conv_str_tsi = int_tsi.toFixed(2);
            var real_tsi = conv_str_tsi.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            $('#sharetotalsumupdate').val(real_tsi);
            $('#sharetotalsumupdate2').val(real_tsi);

            var shareslipval = $('#slipshareupdate').val();
            if(shareslipval != null){
                var shareslip =  parseFloat($('#slipshareupdate').val()) / 100 ;
                var conv_tsi = parseInt(tsi.replace(/,/g, ""));
                var sumshare =isNaN( shareslip * conv_tsi) ? 0 :( shareslip * conv_tsi).toFixed(2) ;
                var real_sumshare = sumshare.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


                $('#slipsumshareupdate').val(real_sumshare);
                $('#slipsumshareupdate2').val(real_sumshare);

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
                    var conv_totalrate = parseInt(sumrate.replace(/,/g, ""));
                    var sumrate = isNaN(((conv_totalrate / 1000) * conv_tsi) * insurance) ? 0 :(((conv_totalrate / 1000) * conv_tsi) * insurance).toFixed(2) ;
                    var real_sumrate = sumrate.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                    $('#slipbasicpremiumupdate').val(real_sumrate);

                    var grossprm_to_nr = $('#slipgrossprmtonrupdate').val();

                    if(grossprm_to_nr != null){
                        var nasionalreinsurance =  $('#mpsharefromupdate').val();
                        var totalnre =  $('#mpsharetoupdate').val();
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

                            var sumor = isNaN(orpercent * conv_sumshare) ? 0 :(orpercent * conv_sumshare).toFixed(2);
                            var real_sumor = sumor.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            
                            var sumgrtoprm = isNaN(conv_basre * shareslip) ? 0 :(conv_basre * shareslip ).toFixed(2);
                            var real_sumgrtoprm = sumgrtoprm.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            
                            if(nasionalreinsurance){
                                var conv_nasionalreinsurance =  parseInt(nasionalreinsurance.replace(/,/g, ""));
                                var sumnre = isNaN(conv_nasionalreinsurance + conv_sumshare ) ? 0 :(conv_nasionalreinsurance + conv_sumshare).toFixed(2) ;
                                var real_sumnre = sumnre.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            }else{
                                var conv_nasionalreinsurance =  parseInt(nasionalreinsurance.replace(/,/g, ""));
                                var sumnre = isNaN(0 + conv_sumshare ) ? 0 :(0 + conv_sumshare).toFixed(2) ;
                                var real_sumnre = sumnre.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            }
                            
                            
                            var sumourshare = isNaN((sumnre / conv_totalnre) * 100 ) ? 0 :((sumnre / conv_totalnre) * 100 ).toFixed(2) ;

                            console.log('sumnre' + sumnre)
                            console.log('realnre' + real_sumnre)
                            console.log('sumourshare' + sumourshare)

                            $('#slipgrossprmtonrupdate').val(real_sumgrtoprm);
                            $('#slipgrossprmtonrupdate2').val(real_sumgrtoprm);
                            $('#slipsumorupdate').val(real_sumor);
                            $('#slipsumorupdate2').val(real_sumor);
                            // $('#mpshare').val(sumourshare.replace(/,/g, "."));
                            $('#mpsharefrom').val(real_sumnre);


                            var commision =  parseFloat($(this).val()) / 100;
                            var feebroker = parseFloat($('#slipvbrokerupdate').val()) / 100;
                            var sumgrossprmtonr2 = $("#slipgrossprmtonrupdate").val();
                            var conv_sumgrossprmtonr = parseInt(sumgrossprmtonr2.replace(/,/g, ""));

                            var sumcomm = isNaN(commision * conv_sumgrossprmtonr) ? 0 :(commision * conv_sumgrossprmtonr).toFixed(2);
                            var real_sumcomm = sumcomm.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                            $('#slipsumcommissionupdate').val(real_sumcomm);
                            $('#slipsumcommissionupdate2').val(real_sumcomm);

                            var sumgrossprmtonr3 = $("#slipgrossprmtonrupdate").val();
                            var conv_sumgrossprmtonr2 = parseInt(sumgrossprmtonr3.replace(/,/g, ""));

                            var sumnetprmtonr = isNaN( conv_sumgrossprmtonr2 * (100/100 - commision - feebroker)) ? 0 :(conv_sumgrossprmtonr2 * (100/100 - commision - feebroker)).toFixed(2);
                            var real_sumnetprmtonr = sumnetprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                            var sumfeebroker = isNaN( conv_sumgrossprmtonr2 * feebroker) ? 0 :(conv_sumgrossprmtonr2 * feebroker).toFixed(2);
                            var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


                            $('#slipnetprmtonrupdate').val(real_sumnetprmtonr);
                            $('#slipnetprmtonrupdate2').val(real_sumnetprmtonr);
                            // $('#slipsumfee').val("100" + "-" + commision.toString() + "-" + feebroker.toString() + "*" + conv_sumgrossprmtonr.toString());
                            $('#slipsumfeeupdate').val(real_sumfeebroker);
                            $('#slipsumfeeupdate2').val(real_sumfeebroker);

                            var sumipamountval = $('#slipipamountupdate').val();

                            if(sumipamountval != null){
                                var percent =  parseFloat($(this).val()) / 100;

                                var sumnetprtonr2 = $("#slipnetprmtonrupdate").val();
                                var conv_sumnetprtonr = parseInt(sumnetprtonr2.replace(/,/g, ""));

                                var sumipamount = isNaN(percent *  conv_sumnetprtonr) ? 0 :(percent *  conv_sumnetprtonr).toFixed(2);
                                var real_sumipamount = sumipamount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                                $('#slipipamountupdate').val(real_sumipamount);
                                $('#slipipamountupdate2').val(real_sumipamount);
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
                            $("#sharetotalsumupdate").val(real_sum);
                            $("#sharetotalsumupdate2").val(real_sum);
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
            var tsi = $('#mpshare').val();
            $('#sharetotalsumupdate').val(tsi);
            $('#sharetotalsumupdate2').val(tsi);

            var shareslipval = $('#slipshareupdate').val();
            if(shareslipval != null){
                var shareslip =  parseFloat($('#slipshareupdate').val()) / 100 ;
                var conv_tsi = parseInt(tsi.replace(/,/g, ""));
                var sumshare =isNaN( shareslip * conv_tsi) ? 0 :( shareslip * conv_tsi).toFixed(2) ;
                var real_sumshare = sumshare.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


                $('#slipsumshareupdate').val(real_sumshare);
                $('#slipsumshareupdate2').val(real_sumshare);

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
                    var conv_totalrate = parseInt(sumrate.replace(/,/g, ""));
                    var sumrate = isNaN(((conv_totalrate / 1000) * conv_tsi) * insurance) ? 0 :(((conv_totalrate / 1000) * conv_tsi) * insurance).toFixed(2);
                    var real_sumrate = sumrate.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                    $('#slipbasicpremiumupdate').val(real_sumrate);

                    var grossprm_to_nr = $('#slipgrossprmtonrupdate').val();

                    if(grossprm_to_nr != null){
                        var nasionalreinsurance =  $('#mpsharefromupdate').val();
                        var totalnre =  $('#mpsharetoupdate').val();
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

                            var sumor = isNaN(orpercent * conv_sumshare) ? 0 :(orpercent * conv_sumshare).toFixed(2);
                            var real_sumor = sumor.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            
                            var sumgrtoprm = isNaN(conv_basre * shareslip) ? 0 :(conv_basre * shareslip ).toFixed(2);
                            var real_sumgrtoprm = sumgrtoprm.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            
                            if(nasionalreinsurance){
                                var conv_nasionalreinsurance =  parseInt(nasionalreinsurance.replace(/,/g, ""));
                                var sumnre = isNaN(conv_nasionalreinsurance + conv_sumshare ) ? 0 :(conv_nasionalreinsurance + conv_sumshare).toFixed(2) ;
                                var real_sumnre = sumnre.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            }else{
                                var conv_nasionalreinsurance =  parseInt(nasionalreinsurance.replace(/,/g, ""));
                                var sumnre = isNaN(0 + conv_sumshare ) ? 0 :(0 + conv_sumshare).toFixed(2) ;
                                var real_sumnre = sumnre.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            }
                            
                            
                            var sumourshare = isNaN((sumnre / conv_totalnre) * 100 ) ? 0 :((sumnre / conv_totalnre) * 100 ).toFixed(2) ;

                            console.log('sumnre' + sumnre)
                            console.log('realnre' + real_sumnre)
                            console.log('sumourshare' + sumourshare)

                            $('#slipgrossprmtonrupdate').val(real_sumgrtoprm);
                            $('#slipgrossprmtonrupdate2').val(real_sumgrtoprm);
                            $('#slipsumorupdate').val(real_sumor);
                            $('#slipsumorupdate2').val(real_sumor);
                            // $('#mpshare').val(sumourshare.replace(/,/g, "."));
                            $('#mpsharefrom').val(real_sumnre);


                            var commision =  parseFloat($(this).val()) / 100;
                            var feebroker = parseFloat($('#slipvbrokerupdate').val()) / 100;
                            var sumgrossprmtonr2 = $("#slipgrossprmtonrupdate").val();
                            var conv_sumgrossprmtonr = parseInt(sumgrossprmtonr2.replace(/,/g, ""));

                            var sumcomm = isNaN(commision * conv_sumgrossprmtonr) ? 0 :(commision * conv_sumgrossprmtonr).toFixed(2);
                            var real_sumcomm = sumcomm.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                            $('#slipsumcommissionupdate').val(real_sumcomm);
                            $('#slipsumcommissionupdate2').val(real_sumcomm);

                            var sumgrossprmtonr3 = $("#slipgrossprmtonrupdate").val();
                            var conv_sumgrossprmtonr2 = parseInt(sumgrossprmtonr3.replace(/,/g, ""));

                            var sumnetprmtonr = isNaN( conv_sumgrossprmtonr2 * (100/100 - commision - feebroker)) ? 0 :(conv_sumgrossprmtonr2 * (100/100 - commision - feebroker)).toFixed(2);
                            var real_sumnetprmtonr = sumnetprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                            var sumfeebroker = isNaN( conv_sumgrossprmtonr2 * feebroker) ? 0 :(conv_sumgrossprmtonr2 * feebroker).toFixed(2);
                            var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


                            $('#slipnetprmtonrupdate').val(real_sumnetprmtonr);
                            $('#slipnetprmtonrupdate2').val(real_sumnetprmtonr);
                            // $('#slipsumfee').val("100" + "-" + commision.toString() + "-" + feebroker.toString() + "*" + conv_sumgrossprmtonr.toString());
                            $('#slipsumfeeupdate').val(real_sumfeebroker);
                            $('#slipsumfeeupdate2').val(real_sumfeebroker);

                            var sumipamountval = $('#slipipamountupdate').val();

                            if(sumipamountval != null){
                                var percent =  parseFloat($(this).val()) / 100;

                                var sumnetprtonr2 = $("#slipnetprmtonrupdate").val();
                                var conv_sumnetprtonr = parseInt(sumnetprtonr2.replace(/,/g, ""));

                                var sumipamount = isNaN(percent *  conv_sumnetprtonr) ? 0 :(percent *  conv_sumnetprtonr).toFixed(2);
                                var real_sumipamount = sumipamount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                                $('#slipipamountupdate').val(real_sumipamount);
                                $('#slipipamountupdate2').val(real_sumipamount);
                            }

                    }



                }

            }

            // swal('warning!','change to ceding share please change installment and retrocession amount manually','success')

        }
    });
</script>


<script type="text/javascript">
    $('#slipcedingbroker').change(function(){
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
                        $("#slipceding option").remove();


                        $("#slipceding").append('<option value="'+res.id+'">'+res.code+' - '+res.name+'</option>');

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
                                $("#sharetotalsum").val(real_sum);
                                $("#sharetotalsum2").val(real_sum);
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

    $('#slipceding').change(function(){
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


                    $("#slipceding").append('<option value="'+res.id+'">'+res.code+' - '+res.name+'</option>');
                    var ceding_curr = $('#slipceding').val();
                    var totalsum = $("#sliptotalsum").val();
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
                                $("#sharetotalsum").val(real_sum);
                                $("#sharetotalsum2").val(real_sum);
                            }
                            else
                            {
                                console.log('hasilnya ' + res)
                            }
                        }
                    

                }else{
                    $("#slipceding option").remove();

                    $.each(res,function(key,value){
                       $("#slipceding").append('<option value="'+value.ceding_id+'">'+value.code+' - '+value.name+'</option>');

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
                                var conv_sum = parseFloat(sum).toFixed(2);
                                var real_sum = conv_sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                $("#sharetotalsumupdate").val(real_sum);
                                $("#sharetotalsumupdate2").val(real_sum);
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
                                 swal("Error!", "Please insert insured first", "Get Ceding Error");

                            }
                    }
                }
            });
        }else{
            swal("Error!", "Please choose Ceding/Broker first", "Get Ceding Error");
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
                                var conv_sum = parseFloat(sum).toFixed(2);
                                var real_sum = conv_sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                $("#sharetotalsumupdate").val(real_sum);
                                $("#sharetotalsumupdate2").val(real_sum);
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
                                $("#sharetotalsumendorsement").val(real_sum);
                                $("#sharetotalsumendorsement2").val(real_sum);
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
                                $("#sharetotalsumendorsement").val(real_sum);
                                $("#sharetotalsumendorsement2").val(real_sum);
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



<script>
$( "#autocomplete" ).autocomplete({
  source: [
  @foreach (@$costumer as $costumerdata)
   "{{@$costumerdata->company_name }}",
  @endforeach
  ]
});
</script>

<script>
    $( "#autocomplete2" ).autocomplete({
      source: [
      @foreach (@$costumer as $costumerdata)
       "{{@$costumerdata->company_name }}",
      @endforeach
      ]
    });
</script>

<script>
$(document).ready(function(){

 var count = 1;

 $("#tabretro").attr('hidden','true');
 $('.uang').mask("#,##0.00", {reverse: true});

    var countryID = 102; 
    //alert(countryID);
    if(countryID){
        $.ajax({
            type:"GET",
            url:"{{url('get-state-lookup')}}?country_id="+countryID,
            beforeSend: function() { $("body").addClass("loading");  },
            complete: function() {  $("body").removeClass("loading"); },
            success:function(res){  
                console.log(res)      
                if(res){
                    $("#state_location").empty();
                    $("#state_location").append('<option selected disabled>Select States/Province</option>');
                    $.each(res,function(key,value){
                        $("#state_location").append('<option value="'+key+'">'+value+'</option>');
                    });

                }else{
                    $("#state_location").append('<option value="" selected disabled>get value error</option>');
                }
            }
        });
    }else{
        $("#state_location").append('<option value="" selected disabled>countryID null</option>');
        $("#city_location").empty();
    }  


$('#sliptotalnilaiec').empty();
$('#sliptotalpercentinspan').empty();

var currency_exc = $('#mpcurrency').val();
if(currency_exc){
    $.ajax({
        type:"GET",
        url:"{{url('get-kurs-detail')}}?currency_id="+currency_exc,
        beforeSend: function() { $("body").addClass("loading");  },
        complete: function() {  $("body").removeClass("loading"); },
        success:function(res){  
            console.log(res)
            console.log('kurs ' + res.kurs)      
            $('#mpkurs').val(res.kurs);
        }
    });
}

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
$("#tabretro").attr('hidden','true');
$("#tabretrodetail").attr('hidden','true');
$("#tabretroupdate").attr('hidden','true');
$("#tabretroendorsement").attr('hidden','true');

$("#mpsharefrom").val().toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
$("#mpshareto").val().toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


    $("#slipipfrom").change(function(){
        console.log($(this).val())
        $("#sliprpfrom").val($(this).val());
    });

    $("#slipipto").change(function(){
        console.log($(this).val())
        $("#sliprpto").val($(this).val());
    });

    $("#btn-success2").click(function(){ 
    var html = $(".clone2").html();
    $(".increment2").after(html);
    });

    $("body").on("click","#btn-danger2",function(){ 
    $(this).parents("#control-group2").remove();
    });

 dynamic_field(count);

 function dynamic_field(number)
 {
  html = '<tr>';
        html += '<td><input type="text" name="first_name[]" class="form-control" /></td>';
        html += '<td><input type="text" name="last_name[]" class="form-control" /></td>';
        if(number > 1)
        {
            html += '<td><button type="button" name="remove" id="" class="btn btn-danger remove">Remove</button></td></tr>';
            $('#user_table tbody').append(html);
        }
        else
        {   
            html += '<td><button type="button" name="add" id="add" class="btn btn-success">Add</button></td></tr>';
            $('#user_table tbody').html(html);
        }
 }

 $(document).on('click', '#add', function(){
  count++;
  dynamic_field(count);
 });

 $(document).on('click', '.remove', function(){
  count--;
  $(this).closest("tr").remove();
 });

 $('#dynamic_form').on('submit', function(event){
        event.preventDefault();
        $.ajax({
            method:'post',
            data:$(this).serialize(),
            dataType:'json',
            beforeSend:function(){
                $('#save').attr('disabled','disabled');
            },
            beforeSend: function() { $("body").addClass("loading");  },
            complete: function() {  $("body").removeClass("loading"); },
            success:function(data)
            {
                if(data.error)
                {
                    var error_html = '';
                    for(var count = 0; count < data.error.length; count++)
                    {
                        error_html += '<p>'+data.error[count]+'</p>';
                    }
                    $('#result').html('<div class="alert alert-danger">'+error_html+'</div>');
                }
                else
                {
                    dynamic_field(1);
                    $('#result').html('<div class="alert alert-success">'+data.success+'</div>');
                }
                $('#save').attr('disabled', false);
            }
        })
 });

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


<script type='text/javascript'>
    $('#country_location').change(function(){
        var countryID = $(this).val();  
        //alert(countryID);
        if(countryID){
            $.ajax({
                type:"GET",
                url:"{{url('get-state-lookup')}}?country_id="+countryID,
                beforeSend: function() { $("body").addClass("loading");  },
                complete: function() {  $("body").removeClass("loading"); },
                success:function(res){  
                    console.log(res)      
                    if(res){
                        $("#state_location").empty();
                        $("#state_location").append('<option selected disabled>Select States/Province</option>');
                        $.each(res,function(key,value){
                            $("#state_location").append('<option value="'+key+'">'+value+'</option>');
                        });

                    }else{
                        $("#state_location").append('<option value="" selected disabled>get value error</option>');
                    }
                }
            });
        }else{
            $("#state_location").append('<option value="" selected disabled>countryID null</option>');
            $("#city_location").empty();
        }   
    });

    $('#state_location').on('change',function(){
        var stateID = $(this).val();  
        //alert(stateID);
        if(stateID){
            $.ajax({
                type:"GET",
                url:"{{url('get-city-lookup')}}?state_id="+stateID,
                beforeSend: function() { $("body").addClass("loading");  },
                complete: function() {  $("body").removeClass("loading"); },
                success:function(res){        
                    if(res){
                        $("#city_location").empty();
                        $("#city_location").append('<option selected disabled>Select City</option>');
                        $.each(res,function(key,value){
                            $("#city_location").append('<option value="'+key+'">'+value+'</option>');
                        });
                        
                    }else{
                        $("#city_location").append('<option value="" selected disabled>get value error</option>');
                    }
                }
            });
        }else{
            $("#city_location").append('<option value="" selected disabled>countryID null</option>');
            $("#address_location").empty();
        }

    });


    $('#city_location').on('change',function(){
        var cityID = $(this).val();  
        //alert(stateID);
        if(cityID){
            $.ajax({
                type:"GET",
                url:"{{url('get-address-lookup')}}?city_id="+cityID,
                beforeSend: function() { $("body").addClass("loading");  },
                complete: function() {  $("body").removeClass("loading"); },
                success:function(res){        
                    if(res){
                        $("#address_location").empty();
                        $("#address_location").append('<option selected disabled>Select Address</option>');
                        $.each(res,function(key,value){
                            $("#address_location").append('<option value="'+key+'">'+value+'</option>');
                        });
                        
                    }else{
                        $("#address_location").append('<option value="" selected disabled>get value error</option>');
                    }
                }
            });
        }else{
            $("#address_location").append('<option value="" selected disabled>countryID null</option>');

        }

    });

    
    $('#address_location').on('change',function(){
        var cityID = $(this).val();  
        //alert(stateID);
        if(cityID){
            $.ajax({
                type:"GET",
                url:"{{url('get-postal-lookup')}}?address_id="+cityID,
                beforeSend: function() { $("body").addClass("loading");  },
                complete: function() {  $("body").removeClass("loading"); },
                success:function(res){
                    console.log(res)        
                    if(res){
                        console.log("postal code " + res.postal_code)
                        $("#postal_code_location_id").val(res.postal_code);
                        // $("#postal_code_location").append('<option selected disabled>Select Address</option>');
                        // $.each(res,function(key,value){
                        //     $("#postal_code_location").append('<option value="'+key+'">'+value+'</option>');
                        // });
                        
                    }else{
                       $("#postal_code_location_id").val("get value error");
                        // $("#postal_code_location").append('<option value="" selected disabled>get value error</option>');
                    }
                }
            });
        }else{
            // $("#postal_code_location").append('<option value="" selected disabled>Postal ID null</option>');
            $("#postal_code_location_id").val("postal id null");

        }

    });
</script>


<script type="text/javascript">

    //triggered when modal is about to be shown
    $('#addlocdetailmodaldata').on('show.bs.modal', function(e) {

         //get data-id attribute of the clicked element

        var codesl = $(e.relatedTarget).data('look-id');
        //alert(codesl);
        $('#insurednoloc').val(codesl);
    });

</script>


<script type="text/javascript">

    //triggered when modal is about to be shown
    $('#addlocation').on('show.bs.modal', function(e) {

         //get data-id attribute of the clicked element
         var countryID = 102; 
        //alert(countryID);
        if(countryID){
            $.ajax({
                type:"GET",
                url:"{{url('get-state-lookup')}}?country_id="+countryID,
                beforeSend: function() { $("body").addClass("loading");  },
                complete: function() {  $("body").removeClass("loading"); },
                success:function(res){  
                    console.log(res)      
                    if(res){
                        $("#state_location").empty();
                        $("#state_location").append('<option selected disabled>Select States/Province</option>');
                        $.each(res,function(key,value){
                            $("#state_location").append('<option value="'+key+'">'+value+'</option>');
                        });

                    }else{
                        $("#state_location").append('<option value="" selected disabled>get value error</option>');
                    }
                }
            });
        }else{
            $("#state_location").append('<option value="" selected disabled>countryID null</option>');
            $("#city_location").empty();
        }  
        
    });

</script>


<script type='text/javascript'>
   $('#form-addlocation').submit(function(e){
    e.preventDefault();

    var lookupcode = $('#address_location').val();
    var insured_id = $('#insuredIDtxt').val();
    var token = $('input[name=_token]').val();

    var country = $('#country_location').val();
    var state = $('#state_location').val();
    var city = $('#city_location').val();        
    var adrress = $('#address_location').val();
    var sliptype = 'mp';

        //var slipinterestid = $('#slipinterestlistlocation').val();
        //var cnno = $('#cnno').val();
        //var certno = $('#certno').val();
        //var refno = $('#refno').val();
        //var amountlocation = $('#amountlocation').val();
        
        //var conv_amount = amountlocation.replace(/,/g, "");
        //console.log(conv_amount)
        //var real_amount = parseInt(conv_amount);
        //console.log(real_amount)
        
        $.ajax({
            url:"{{ route('locationlist.store') }}",
            type:"POST",
            data:{
                lookupcode:lookupcode,
                country:country,
                state:state,
                city:city,
                adrress:adrress,
                insuredID:insured_id,
                sliptype:sliptype,
                _token:token
            },
            beforeSend: function() { $("body").addClass("loading");  },
            complete: function() {  $("body").removeClass("loading"); },
            success:function(response){
                console.log(response)

                    //var curr_amount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(response.amountlocation);
                    
                    $('#locRiskTable > tbody:last-child').prepend('<tr id="sid'+response.id+'">'+
                        '<td>'+response.loc_code+'</td>'+
                        '<td>'+response.address+'<br>'+response.city_name+'<br>'+response.state_name+'<br>'+response.latitude+' , '+response.longtitude+'<br>'+ response.postal_code+'</td>'+
                        '<td>'+response.latitude+' , '+response.longtitude+'<br></td>'+
                        '<td>'+
                        '<a class="text-primary mr-3 float-right " data-toggle="modal" data-look-id="'+response.id+'" data-target="#addlocdetailmodaldata">'+
                        '<button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#addlocdetailmodaldata2">Add</button>'+
                        '</a>'+
                        '<a href="javascript:void(0)" onclick="deletelocationdetail('+response.id+')"><i class="fas fa-trash text-danger"></i></a></td>'+
                        '</tr>'+

                        '<tr id="cid'+response.id+'">'+
                        '<td></td>'+
                        '<td colspan="3">'+
                        '<table id="tcid'+response.id+'" width="600" class="table table-bordered table-striped">'+
                        '<thead>'+
                        '<tr>'+
                        '<th>Interest Insured</th>'+
                        '<th>Ceding/Broker</th>'+
                        '<th>CN/DN</th>'+
                        '<th>Cert No</th>'+
                        '<th>Slip No</th>'+
                        '<th>Policy No</th>'+
                        '<th>Share</th>'+
                        '<th>amount</th>'+
                        '<th>Action</th>'+
                        '</tr>'+
                        '</thead>'+
                        '<tbody id="tbcid'+response.id+'">'+
                        '</tbody>'+
                        '</table>'+
                        '</td>'+
                        '</tr>');

                    
                    $('#addlocation').modal('toggle');
                    $('#slipamount').val('');
                    $('#slipinterestlist').val('');
                    
                    
                }
            });

    });


   function deletelocationdetail(id){
    var token = $('input[name=_token]').val();

    $.ajax({
        url:'{{ url("/") }}/delete-sliplocation-list/'+id,
        type:"DELETE",
        data:{
            _token:token
        },
        beforeSend: function() { $("body").addClass("loading");  },
        complete: function() {  $("body").removeClass("loading"); },
        success:function(response){
            console.log(response);

            $('#sid'+id).remove();
            $('#cid'+id).remove();

                //var total =  parseFloat($("#sliptotalsum").val());
                //console.log(total)
                //var conv_total = total.replace(/,/g, "");
                //console.log(conv_total)
                //var real_total = parseInt(conv_total);
                //console.log(real_total)
                //var sum = isNaN(real_total - parseFloat(response.amountlocation)) ? 0 :(real_total - parseFloat(response.amountlocation)) ;
                //console.log(sum)
                //var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                //$("#sliptotalsum").val(real_sum);
                //$("#mpshareto").val(real_sum);

            }
        });
}
</script>




<script type='text/javascript'>
   $('#form-addlocationdetail').submit(function(e){
    e.preventDefault();

    var insured_id = $('#insuredIDtxt').val();
    var insurednoloc = $('#insurednoloc').val();
    var token = $('input[name=_token]').val();
    var slipinterestid = $('#slipinterestlistlocation').val();
    var cndn = $('#cndn').val();
    var certno = $('#certno').val();
    var ceding_id = $('#ceding_id').val();
    var slipno = $('#slipno').val();
    var policyno = $('#policyno').val();
    var percent = $('#percentceding').val();
    var amountlocation = $('#amountlocation').val();
    var sliptype = 'mp';

    var conv_amount = amountlocation.replace(/,/g, "");
    console.log(conv_amount)
    var real_amount = parseInt(conv_amount);
    console.log(real_amount)

    // var tsi = $('#mpshareto').val();
    // var conv_tsi = tsi.replace(/,/g, "");
    // console.log(conv_tsi)
    // var real_tsi = parseInt(conv_tsi);
    // console.log(real_tsi)

    var tsiinsval = $('#mpshareto').val();
    var conv_tsiinsval = tsiinsval.replace(/,/g, "");
    var int_tsiinsval = parseFloat(conv_tsiinsval);
    var int_fullins = int_tsiinsval.toFixed(2);
    var new_instsi = int_fullins.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

    var cedshare = $('#mpshare').val();
    if(cedshare == null){
        var real_cedshare = parseInt(0);
    }else{
        var conv_cedshare = cedshare.replace(/,/g, "");
        console.log(conv_cedshare)
        var real_cedshare = parseInt(conv_cedshare);
        console.log(real_cedshare)

    }

    var sum_cedshare = real_amount + real_cedshare;
    

    if(slipinterestid == null || ceding_id == null){
        swal('warning','please choose interest or ceding first','insert error')
    }else{
        console.log('sum ceding share ' + sum_cedshare)
        console.log('ceding share ' + real_cedshare)
        console.log('tsi' + int_tsiinsval)

        if(sum_cedshare > int_tsiinsval){
            swal('warning','ceding share cannot greater than Total Sum Insured','insert error')
        }else{
            $.ajax({
                url:"{{ route('locationlistdetail.store') }}",
                type:"POST",
                data:{
                    slipinterestid:slipinterestid,
                    cndn:cndn,
                    certno:certno,
                    slipno:slipno,
                    policyno:policyno,
                    ceding_id:ceding_id,
                    percent_ceding:percent,
                    amountlocation:real_amount,
                    insurednoloc:insurednoloc,
                    insured_id:insured_id,
                    sliptype:sliptype,
                    // kurs:kurs,
                    _token:token
                },
                beforeSend: function() { $("body").addClass("loading");  },
                complete: function() {  $("body").removeClass("loading"); },
                success:function(response){
                    console.log(response)

                        var amount = response.amountlocation;
                        var ceding_share = $('#mpshare').val();
                        if(ceding_share == ''){
                            var sum_ceding = isNaN(parseFloat(0) + parseFloat(amount)) ? 0 :(parseFloat(0) + parseFloat(amount)).toFixed(2);
                            var conv_sum_ceding = sum_ceding.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            $('#mpshare').val(conv_sum_ceding);
                            $('#mpshare2').val(conv_sum_ceding);
                            console.log('ceding awal' + conv_sum_ceding)
                        }else{
                            var conv_ceding_share = ceding_share.replace(/,/g, "");
                            var real_ceding_share = parseInt(conv_ceding_share);
                            var sum_ceding = isNaN(parseFloat(real_ceding_share) + parseFloat(amount)) ? 0 :(parseFloat(real_ceding_share) + parseFloat(amount)).toFixed(2);
                            var conv_sum_ceding = sum_ceding.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            $('#mpshare').val(conv_sum_ceding);
                            $('#mpshare2').val(conv_sum_ceding);
                            console.log('ceding bertambah' + conv_sum_ceding)


                        }

                        console.log('amount' + amount)
                        var fl_amount = parseFloat(amount);
                        console.log('amount float' + fl_amount)
                        var new_amount = fl_amount.toFixed(2);
                        console.log('amount to fixed' + new_amount)
                        var curr_amount = new_amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        console.log('current amount' + curr_amount)

                        var percent = response.percent;
                        var percentfl = parseFloat(percent);
                        // var new_percent = percentfl.toFixed(2);

                        var cndn = '';
                        var certno = '';
                        var slipno = '';
                        var policyno = '';

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

                        
                        $('#tcid'+insurednoloc+' > tbody:last-child').prepend('<tr id="riskdetailsid'+response.id+'">'+
                            '<td>'+response.cedingbroker+'</td>'+
                            '<td>'+response.interest_name+'</td>'+
                            '<td>'+cndn+'</td>'+
                            '<td>'+certno+'</td>'+
                            '<td>'+slipno+'</td>'+
                            '<td>'+policyno+'</td>'+
                            '<td>'+percentfl+'%</td>'+
                            '<td>'+curr_amount+'</td>'+
                            '<td>'+
                            '<a href="javascript:void(0)" onclick="deletelocationriskdetail('+response.id+')"><i class="fas fa-trash text-danger"></i></a></td>'+
                            '</tr>');

                            // $("#slipcedingbroker").find('option').get(0).remove();
                            $("#slipcedingbroker option[value='placeholder']").remove();
                            $("#slipcedingbroker").prepend('<option value="'+response.idceding+'">'+response.cedingcode+' - '+response.ceding+'</option>');
                            $("#slipcedingbroker").prepend('<option value="placeholder" selected disabled>Ceding or Broker</option>');
                        
                            $("#slipcedingbrokerupdate option[value='placeholder']").remove();
                            $("#slipcedingbrokerupdate").prepend('<option value="'+response.idceding+'">'+response.cedingcode+' - '+response.ceding+'</option>');
                            $("#slipcedingbrokerupdate").prepend('<option value="placeholder" selected disabled>Ceding or Broker</option>');
                            

                            $("#slipcedingbrokerendorsement option[value='placeholder']").remove();
                            $("#slipcedingbrokerendorsement").prepend('<option value="'+response.idceding+'">'+response.cedingcode+' - '+response.ceding+'</option>');
                            $("#slipcedingbrokerendorsement").prepend('<option value="placeholder" selected disabled>Ceding or Broker</option>');

                            if(response.sumceding){
                                    $('table#locRiskTable tr#totalamount').empty();
                                    $('tbody#totalamount').empty();
                                    var total_amount_ceding = response.sumceding;
                                    
                                    for(var i = 0; i < total_amount_ceding.length; i++){

                                        var name = total_amount_ceding[i].name;
                                        var amount_ceding = total_amount_ceding[i].amountlocation;
                                        console.log('amount' + amount_ceding)
                                        var fl_amount = parseFloat(amount_ceding);
                                        console.log('amount float' + fl_amount)
                                        var new_amount = fl_amount.toFixed(2);
                                        console.log('amount to fixed' + new_amount)
                                        var curr_amount = new_amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                        console.log('current amount' + curr_amount)

                                        var percent = total_amount_ceding[i].percentage;
                                        var percentfl = parseFloat(percent);
                                        // var new_percent = percentfl.toFixed(2);

                                        $('#locRiskTable tr:last').after('<tr id="totalamount">'+
                                        '<td></td>'+
                                        '<td >'+name+'</td>'+
                                        '<td >'+percentfl+'%</td>'+
                                        '<td >'+curr_amount+'</td>'+
                                        '</tr>');

                                };
                            }
                        
                        $('#addlocdetailmodaldata').modal('toggle');

                        $('#percentceding').val('');
                        $('#amountlocation').val('');
                       
                        swal("success!", "ceding share has increase", "success");
                        
                    }
            });
        }
    }

});


function deletelocationriskdetail(id){
    var token = $('input[name=_token]').val();

    $.ajax({
        url:'{{ url("/") }}/delete-sliplocationdetail-list/'+id,
        type:"DELETE",
        data:{
            _token:token
        },
        beforeSend: function() { $("body").addClass("loading");  },
        complete: function() {  $("body").removeClass("loading"); },
        success:function(response){
            console.log(response);

            $('#riskdetailsid'+id).remove();
            var ceding_curr = $('#slipceding').val();

            // var totalnre = $('#mpshareto').val();
            // var conv_totalnre = totalnre.replace(/,/g, "");

            // var sumtotalnre = isNaN(parseFloat(conv_totalnre) - parseFloat(response.amountlocation)) ? (parseFloat(conv_totalnre) - parseFloat(response.amountlocation)) : (parseFloat(conv_totalnre) - parseFloat(response.amountlocation)) ;
            // var real_sumtotalnre = sumtotalnre.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            // $('#mpshareto').val(real_sumtotalnre);

                //$('#cid'+id).remove();
                var amount = response.amountlocation;
                var ceding_share = $('#mpshare').val();
                
                var conv_ceding_share = ceding_share.replace(/,/g, "");
                var real_ceding_share = parseInt(conv_ceding_share);
                var sum_ceding = isNaN(parseFloat(real_ceding_share) - parseFloat(amount)) ? 0 :(parseFloat(real_ceding_share) - parseFloat(amount));
                var conv_sum_ceding = sum_ceding.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('#mpshare').val(conv_sum_ceding);
                $('#mpshare2').val(conv_sum_ceding);
                console.log('ceding bertambah' + conv_sum_ceding)
                console.log('sum ceding' + response.sumceding)

                $("#slipcedingbroker option[value='"+response.cedinglocation+"']").remove();
                $("#slipcedingbrokerupdate option[value='"+response.cedinglocation+"']").remove();
                $("#slipcedingbrokerendorsement option[value='"+response.cedinglocation+"']").remove();

                if(response.sumceding){
                        $('table#locRiskTable tr#totalamount').empty();
                        $('tbody#totalamount').empty();
                        var total_amount_ceding = response.sumceding;
                        
                        for(var i = 0; i < total_amount_ceding.length; i++){

                            var name = total_amount_ceding[i].name;
                            var amount_ceding = total_amount_ceding[i].amountlocation;
                            console.log('amount' + amount_ceding)
                            var fl_amount = parseFloat(amount_ceding);
                            console.log('amount float' + fl_amount)
                            var new_amount = fl_amount.toFixed(2);
                            console.log('amount to fixed' + new_amount)
                            var curr_amount = new_amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            console.log('current amount' + curr_amount)

                            var percent = total_amount_ceding[i].percentage;
                            var percentfl = parseFloat(percent);
                            // var new_percent = percentfl.toFixed(2);

                            $('#locRiskTable tr:last').after('<tr id="totalamount">'+
                            '<td></td>'+
                            '<td >'+name+'</td>'+
                            '<td >'+percentfl+'%</td>'+
                            '<td >'+curr_amount+'</td>'+
                            '</tr>');

                    };
                }

            // swal("Warning!", "TSI not decrease because this ceding is not same with ceding in slip", "Tsi not decrease");
            swal("success!", "ceding share has decrease", "success");

                    // $("#sliptotalsum").val(real_sum);
                    // $("#mpshareto").val(real_sum);



                }
            });
}
</script>


<script type="text/javascript">
    $('#cancelmodal-btn').click(function(e){
        e.preventDefault();

         var remarks = $('#remarkscancel').val();
         var slipnumber = $('#slipnumberdetail').val();
         var code_ms = $('#insuredIDtxt').val();
         var token2 = $('input[name=_token]').val();

         $.ajaxSetup({
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

               $.ajax({
                 url:"{{url('transaction-data/fe-slip/updateform')}}",
                 type:"POST",
                 data:{
                     code_ms:code_ms,
                     slipnumber:slipnumber,
                     remarks:remarks
                 },
                 beforeSend: function() { $("body").addClass("loading");  },
                 complete: function() {  $("body").removeClass("loading"); },
                 success:function(response)
                 {
                    swal("Success!", "Moveable Property Slip Update Status Cancelled", "success")
                    console.log(response)
                    

                    $('#cancelmodaldata').modal('toggle');

                    },
                    error: function (request, status, error) {
                        //alert(request.responseText);
                        swal("Error!", "Moveable Property Slip Update Error", "Update Error");
                    }
                });


    });
</script>


<script type='text/javascript'>
    $('#addinterestinsured-btn').click(function(e){
     e.preventDefault();

     var interest = $('#slipinterestlist').val();
     var amount = $('#slipamount').val();
     var slip_id = $('#slipnumber').val();
     var token2 = $('input[name=_token]').val();

     var conv_amount = amount.replace(/,/g, "");
     console.log(conv_amount)
     var real_amount = parseInt(conv_amount);
     console.log(real_amount)

     $.ajax({
         url:"{{ route('interestlist.store') }}",
         type:"POST",
         data:{
             interest_insured:interest,
             slipamount:real_amount,
             id_slip:slip_id,
             _token:token2
         },
         beforeSend: function() { $("body").addClass("loading");  },
         complete: function() {  $("body").removeClass("loading"); },
         success:function(response){

             console.log(response)
            //    var curr_amount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(response.amount);
            var curr_amount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(response.amount);
            $('#interestInsuredTable tbody').prepend('<tr id="iid'+response.id+'" data-name="interestvalue[]"><td data-name="'+response.description+'">'+response.description+'</td><td data-name="'+response.amount+'">'+curr_amount+'</td><td><a href="javascript:void(0)" onclick="deleteinterestdetail('+response.id+')">delete</a></td></tr>')
            $('#slipamount').val('');
            $('#slipinterestlist').val('');
            var totalsum = $("#sliptotalsum").val();
            if(totalsum == '')
            {
                var sum = isNaN(total + parseFloat(response.amount)) ? (0 + parseFloat(response.amount)) : (total + parseFloat(response.amount)) ;
                var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                console.log(' sum : ' + sum)
                console.log(' real sum : ' + real_sum)
                $("#sliptotalsum").val(real_sum);
                $("#sliptotalsum2").val(real_sum);
                $("#mpshareto").val(real_sum);
            }
            else
            {
                var conv_total = totalsum.replace(/,/g, "");
                console.log('conv total : ' + conv_total)
                var real_total = parseInt(conv_total);
                console.log('real total : ' + real_total)
                var total =  parseFloat(real_total);
                console.log(' total : ' + total)
                var sum = isNaN(total + parseFloat(response.amount)) ? 0 :(total + parseFloat(response.amount)) ;
                var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                console.log(' sum : ' + sum)
                console.log(' real sum : ' + real_sum)

                $("#sliptotalsum").val(real_sum);
                $("#sliptotalsum2").val(real_sum);
                    //    $("#msishareto").val(sum);
                    $("#mpshareto").val(real_sum);
                }


            }
        });

 });
</script>


<script type='text/javascript'>
    $('#addinterestinsuredupdate-btn').click(function(e){
     e.preventDefault();

     var interest = $('#slipinterestlistupdate').val();
     var amount = $('#slipamountupdate').val();
     var slip_id = $('#slipnumberupdate').val();
     var token2 = $('input[name=_token]').val();

     $.ajax({
         url:"{{ route('interestlist.store') }}",
         type:"POST",
         data:{
             interest_insured:interest,
             slipamount:amount,
             id_slip:slip_id,
             _token:token2
         },
         beforeSend: function() { $("body").addClass("loading");  },
         complete: function() {  $("body").removeClass("loading"); },
         success:function(response){

             console.log(response)
            //    var curr_amount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(response.amount);
            var curr_amount = response.amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            $('#interestInsuredTableupdate tbody').prepend('<tr id="iidupdate'+response.id+'" data-name="interestupdatevalue[]"><td data-name="'+response.description+'">'+response.description+'</td><td data-name="'+response.amount+'">'+curr_amount+'</td><td><a href="javascript:void(0)" onclick="deleteinterestupdate('+response.id+')">delete</a></td></tr>')
            $('#slipamountupdate').val('');
            $('#slipinterestlistupdate').val('');
            var total =  parseFloat($("#sliptotalsumupdate").val());
            var sum = isNaN(total + parseFloat(response.amount)) ? (0 + parseFloat(response.amount)) : (total + parseFloat(response.amount)) ;
            $("#sliptotalsumupdate").val(sum);
            $("#mpsharetoupdate").val(sum);



        }
    });

 });
</script>


<script type='text/javascript'>
    $('#addinterestinsuredendorsement-btn').click(function(e){
     e.preventDefault();

     var interest = $('#slipinterestlistendorsement').val();
     var amount = $('#slipamountendorsement').val();
     var slip_id = $('#slipnumberendorsement').val();
     var token2 = $('input[name=_token]').val();

     $.ajax({
         url:"{{ route('interestlist.store') }}",
         type:"POST",
         data:{
             interest_insured:interest,
             slipamount:amount,
             id_slip:slip_id,
             _token:token2
         },
         beforeSend: function() { $("body").addClass("loading");  },
         complete: function() {  $("body").removeClass("loading"); },
         success:function(response){

             console.log(response)
            //    var curr_amount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(response.amount);
            var curr_amount = response.amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            $('#interestInsuredTableendorsement tbody').prepend('<tr id="iidendorsement'+response.id+'" data-name="interestendorsementvalue[]"><td data-name="'+response.description+'">'+response.description+'</td><td data-name="'+response.amount+'">'+curr_amount+'</td><td><a href="javascript:void(0)" onclick="deleteinterestendorsement('+response.id+')">delete</a></td></tr>')
            $('#slipamountendorsement').val('');
            $('#slipinterestlistendorsement').val('');
            var total =  parseFloat($("#sliptotalsumendorsement").val());
            var sum = isNaN(total + parseFloat(response.amount)) ? (0 + parseFloat(response.amount)) : (total + parseFloat(response.amount)) ;
            $("#sliptotalsumendorsement").val(sum);
            $("#mpsharetoendorsement").val(sum);



        }
    });

 });
</script>



<script type='text/javascript'>
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
                console.log(response);
                var total =  parseFloat($("#sliptotalsum").val());
                var sum = isNaN(total - parseFloat(response.amount)) ? 0 :(total - parseFloat(response.amount)) ;
                $("#sliptotalsum").val(sum);
                $("#mpshareto").val(sum);
            }
        });
    }
</script>


<script type='text/javascript'>
    function deleteinterestupdate(id){
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

                $('#iidupdate'+id).remove();
                console.log(response);
                var total =  parseFloat($("#sliptotalsumupdate").val());
                var sum = isNaN(total - parseFloat(response.amount)) ? 0 :(total - parseFloat(response.amount)) ;
                $("#sliptotalsumupdate").val(sum);
                $("#mpsharetoupdate").val(sum);
            }
        });
    }
</script>



<script type='text/javascript'>
    function deleteinterestendorsement(id){
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

                $('#iidendorsement'+id).remove();
                console.log(response);
                var total =  parseFloat($("#sliptotalsumendorsement").val());
                var sum = isNaN(total - parseFloat(response.amount)) ? 0 :(total - parseFloat(response.amount)) ;
                $("#sliptotalsumendorsement").val(sum);
                $("#mpsharetoendorsement").val(sum);
            }
        });
    }
</script>

<script type="text/javascript">
    $('#percentceding').keyup(function(e){
         var keyCode = e.keyCode || e.which;
        if(keyCode != 9){
            var percentceding = parseFloat($(this).val()) / 100 ;
            var valtsi = $('#mpshareto').val();

            if(valtsi != null){
                var tsi = $('#mpshareto').val();
                var conv_tsi = parseInt(tsi.replace(/,/g, ""));

                var sum_amount = isNaN(percentceding * conv_tsi) ? 0 :(percentceding * conv_tsi).toFixed(2);
                var real_sum = sum_amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('#amountlocation').val(real_sum);
            }
            else
            {
                swal('warning!','please fill TSI insured first','error')
            }
        }
        else{
            var percentceding = parseFloat($(this).val()) / 100 ;
            var valtsi = $('#mpshareto').val();

            if(valtsi != null){
                var tsi = $('#mpshareto').val();
                var conv_tsi = parseInt(tsi.replace(/,/g, ""));

                var sum_amount = isNaN(percentceding * conv_tsi) ? 0 :(percentceding * conv_tsi).toFixed(2);
                var real_sum = sum_amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('#amountlocation').val(real_sum);
            }
            else
            {
                swal('warning!','please fill TSI insured first','error')
            }
        }

    });

    $('#percentceding').change(function(e){
         var keyCode = e.keyCode || e.which;
         console.log(keycode)
        if(keyCode != 9){
            var percentceding = parseFloat($(this).val()) / 100 ;
            var valtsi = $('#mpshareto').val();

            if(valtsi != null){
                var tsi = $('#mpshareto').val();
                var conv_tsi = parseInt(tsi.replace(/,/g, ""));

                var sum_amount = isNaN(percentceding * conv_tsi) ? 0 :(percentceding * conv_tsi).toFixed(2);
                var real_sum = sum_amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('#amountlocation').val(real_sum);
            }
            else
            {
                swal('warning!','please fill TSI insured first','error')
            }
        }
        else{
            var percentceding = parseFloat($(this).val()) / 100 ;
            var valtsi = $('#mpshareto').val();

            if(valtsi != null){
                var tsi = $('#mpshareto').val();
                var conv_tsi = parseInt(tsi.replace(/,/g, ""));

                var sum_amount = isNaN(percentceding * conv_tsi) ? 0 :(percentceding * conv_tsi).toFixed(2);
                var real_sum = sum_amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('#amountlocation').val(real_sum);
            }
            else
            {
                swal('warning!','please fill TSI insured first','error')
            }
        }

    });

    $('#percentceding').keydown(function(e){
         var keyCode = e.keyCode || e.which;
        if(keyCode != 9){
            var percentceding = parseFloat($(this).val()) / 100 ;
            var valtsi = $('#mpshareto').val();

            if(valtsi != null){
                var tsi = $('#mpshareto').val();
                var conv_tsi = parseInt(tsi.replace(/,/g, ""));

                var sum_amount = isNaN(percentceding * conv_tsi) ? 0 :(percentceding * conv_tsi).toFixed(2);
                var real_sum = sum_amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('#amountlocation').val(real_sum);
            }
            else
            {
                swal('warning!','please fill TSI insured first','error')
            }
        }
        else{
            var percentceding = parseFloat($(this).val()) / 100 ;
            var valtsi = $('#mpshareto').val();

            if(valtsi != null){
                var tsi = $('#mpshareto').val();
                var conv_tsi = parseInt(tsi.replace(/,/g, ""));

                var sum_amount = isNaN(percentceding * conv_tsi) ? 0 :(percentceding * conv_tsi).toFixed(2);
                var real_sum = sum_amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('#amountlocation').val(real_sum);
            }
            else
            {
                swal('warning!','please fill TSI insured first','error')
            }
        }

    });

    $('#percentceding').keypress(function(e){
         var keyCode = e.keyCode || e.which;
        if(keyCode != 9){
            var percentceding = parseFloat($(this).val()) / 100 ;
            var valtsi = $('#mpshareto').val();

            if(valtsi != null){
                var tsi = $('#mpshareto').val();
                var conv_tsi = parseInt(tsi.replace(/,/g, ""));

                var sum_amount = isNaN(percentceding * conv_tsi) ? 0 :(percentceding * conv_tsi).toFixed(2);
                var real_sum = sum_amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('#amountlocation').val(real_sum);
            }
            else
            {
                swal('warning!','please fill TSI insured first','error')
            }
        }
        else{
            var percentceding = parseFloat($(this).val()) / 100 ;
            var valtsi = $('#mpshareto').val();

            if(valtsi != null){
                var tsi = $('#mpshareto').val();
                var conv_tsi = parseInt(tsi.replace(/,/g, ""));

                var sum_amount = isNaN(percentceding * conv_tsi) ? 0 :(percentceding * conv_tsi).toFixed(2);
                var real_sum = sum_amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('#amountlocation').val(real_sum);
            }
            else
            {
                swal('warning!','please fill TSI insured first','error')
            }
        }

    });
</script>

<script type="text/javascript">
    $('#amountlocation').change(function(e){
         var keyCode = e.keyCode || e.which;
        if(keyCode != 9){
            var amountlocation = $(this).val();
            var conv_amountlocation = parseInt(amountlocation.replace(/,/g, ""));
            console.log(amountlocation)
            console.log(conv_amountlocation)
            var valtsi = $('#mpshareto').val();

            if(valtsi != null){
                var tsi = $('#mpshareto').val();
                var conv_tsi = parseInt(tsi.replace(/,/g, ""));

                var sum_amount = isNaN((conv_amountlocation / conv_tsi)*100) ? 0 :((conv_amountlocation / conv_tsi)*100).toFixed(2);
                var real_sum = sum_amount.toString();
                console.log(sum_amount)
                console.log(real_sum)
                $('#percentceding').val(real_sum);
            }else{
                swal('warning!','please fill TSI insured first','error')
            }
        }
        else{
            var amountlocation = $(this).val() ;
            var conv_amountlocation = parseInt(amountlocation.replace(/,/g, ""));

            console.log(amountlocation)
            console.log(conv_amountlocation)
            var valtsi = $('#mpshareto').val();

            if(valtsi != null){
                var tsi = $('#mpshareto').val();
                var conv_tsi = parseInt(tsi.replace(/,/g, ""));

                var sum_amount = isNaN((conv_amountlocation / conv_tsi)*100) ? 0 :((conv_amountlocation / conv_tsi)*100).toFixed(2);
                var real_sum = sum_amount.toString();
                console.log(sum_amount)
                console.log(real_sum)
                $('#percentceding').val(real_sum);
            }else{
                swal('warning!','please fill TSI insured first','error')
            }
        }

    });

    $('#amountlocation').keyup(function(e){
          var keyCode = e.keyCode || e.which;
        if(keyCode != 9){
            var amountlocation = $(this).val();
            var conv_amountlocation = parseInt(amountlocation.replace(/,/g, ""));
            console.log(amountlocation)
            console.log(conv_amountlocation)
            var valtsi = $('#mpshareto').val();

            if(valtsi != null){
                var tsi = $('#mpshareto').val();
                var conv_tsi = parseInt(tsi.replace(/,/g, ""));

                var sum_amount = isNaN((conv_amountlocation / conv_tsi)*100) ? 0 :((conv_amountlocation / conv_tsi)*100).toFixed(2);
                var real_sum = sum_amount.toString();
                console.log(sum_amount)
                console.log(real_sum)
                $('#percentceding').val(real_sum);
            }else{
                swal('warning!','please fill TSI insured first','error')
            }
        }
        else{
             var percentceding = parseFloat($('#percentceding').val()) / 100 ;
            var valtsi = $('#mpshareto').val();

            if(valtsi != null){
                var tsi = $('#mpshareto').val();
                var conv_tsi = parseInt(tsi.replace(/,/g, ""));

                var sum_amount = isNaN(percentceding * conv_tsi) ? 0 :(percentceding * conv_tsi).toFixed(2);
                var real_sum = sum_amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('#amountlocation').val(real_sum);
            }
            else
            {
                swal('warning!','please fill TSI insured first','error')
            }
        }

    });

    $('#amountlocation').keypress(function(e){
         var keyCode = e.keyCode || e.which;
        if(keyCode != 9){
            // var percentceding = parseFloat($('#percentceding').val()) / 100 ;
            // var valtsi = $('#mpshareto').val();

            // if(valtsi != null){
            //     var tsi = $('#mpshareto').val();
            //     var conv_tsi = parseInt(tsi.replace(/,/g, ""));

            //     var sum_amount = isNaN(percentceding * conv_tsi) ? 0 :(percentceding * conv_tsi).toFixed(2);
            //     var real_sum = sum_amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            //     $('#amountlocation').val(real_sum);
            // }
            // else
            // {
            //     swal('warning!','please fill TSI insured first','error')
            // }
        }
        else{
            var percentceding = parseFloat($('#percentceding').val()) / 100 ;
            var valtsi = $('#mpshareto').val();

            if(valtsi != null){
                var tsi = $('#mpshareto').val();
                var conv_tsi = parseInt(tsi.replace(/,/g, ""));

                var sum_amount = isNaN(percentceding * conv_tsi) ? 0 :(percentceding * conv_tsi).toFixed(2);
                var real_sum = sum_amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('#amountlocation').val(real_sum);
            }
            else
            {
                swal('warning!','please fill TSI insured first','error')
            }
        }

    });

    $('#amountlocation').keydown(function(e){
         var keyCode = e.keyCode || e.which;
        if(keyCode != 9){
            // var percentceding = parseFloat($('#percentceding').val()) / 100 ;
            // var valtsi = $('#mpshareto').val();

            // if(valtsi != null){
            //     var tsi = $('#mpshareto').val();
            //     var conv_tsi = parseInt(tsi.replace(/,/g, ""));

            //     var sum_amount = isNaN(percentceding * conv_tsi) ? 0 :(percentceding * conv_tsi).toFixed(2);
            //     var real_sum = sum_amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            //     $('#amountlocation').val(real_sum);
            // }
            // else
            // {
            //     swal('warning!','please fill TSI insured first','error')
            // }
        }
        else{
            var percentceding = parseFloat($('#percentceding').val()) / 100 ;
            var valtsi = $('#mpshareto').val();

            if(valtsi != null){
                var tsi = $('#mpshareto').val();
                var conv_tsi = parseInt(tsi.replace(/,/g, ""));

                var sum_amount = isNaN(percentceding * conv_tsi) ? 0 :(percentceding * conv_tsi).toFixed(2);
                var real_sum = sum_amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('#amountlocation').val(real_sum);
            }
            else
            {
                swal('warning!','please fill TSI insured first','error')
            }
        }

    });
</script>




<script type="text/javascript">
    $('#mpshareto2').keyup(function(){
        var tsislip = $('#sliptotalsum').val();
        var typetsi = $('#sliptypetsi').val();
        
        $('#mpshareto').val($(this).val());
        console.log($('#mpshareto').val())
        if(tsislip != null && typetsi == '1'){
            $('#sliptotalsum').val($(this).val());
            $('#sliptotalsum2').val($(this).val());
                    
        }
    });

    $('#mpshareto').change(function(){
        var sumpct = $('#sliptotalsumpct').val();
        var typetsi = $('#sliptypetsi').val();


        if(sumpct != '' && typetsi == '1'){
                var pct =  parseFloat($('#slippct').val())/100;

                var tsi = $("#sliptotalsum").val();
                var conv_tsi = parseInt(tsi.replace(/,/g, ""));

                var sum = isNaN(pct * conv_tsi) ? 0 :(pct * conv_tsi);
                console.log(sum)
               var conv_sum = parseFloat(sum).toFixed(2);
                var real_sum = conv_sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('#sliptotalsumpct').val(real_sum);
                $('#sliptotalsumpct2').val(real_sum);

                var dpamount = $('#slipdpamount').val();
                var ecamount = $('#slipamountec').val();

                swal('Success!','tsi in slip changed, please change value in risk detail, deductible and extendcoverage manually','success')

                if(dpamount != null){
                    var percent =  parseFloat($('#slipdppercentage').val()) / 100;
                    
                    var sum = isNaN(percent * conv_tsi) ? 0 :(percent * conv_tsi).toFixed(2) ;
                    var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    console.log($('#slipdppercentage').val())
                    console.log(percent)
                    console.log(sum)
                    console.log(real_sum)

                    $('#slipdpamount').val(real_sum);
                    $('#slipdpamount2').val(real_sum);
                }

                if(ecamount != null){

                    var persentage =  parseFloat($('#slipnilaiec').val()) / 1000;
                    var sum = isNaN(conv_tsi * persentage) ? 0 :(conv_tsi * persentage).toFixed(2) ;
                    var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    console.log($('#slipnilaiec').val())
                    console.log(persentage)
                    console.log(sum)
                    console.log(real_sum)

                    $('#slipamountec').val(real_sum);
                    $('#slipamountec2').val(real_sum);
                    
                }

                


            }
            else{
                // swal('Success!','tsi in slip changed, please change value in risk detail','success')
            }    
    });

    $('#mpshareto2').change(function(){
        var sumpct = $('#sliptotalsumpct').val();
        var typetsi = $('#sliptypetsi').val();


        if(sumpct != '' && typetsi == '1'){
                var pct =  parseFloat($('#slippct').val())/100;

                var tsi = $("#sliptotalsum").val();
                var conv_tsi = parseInt(tsi.replace(/,/g, ""));

                var sum = isNaN(pct * conv_tsi) ? 0 :(pct * conv_tsi);
                console.log(sum)
               var conv_sum = parseFloat(sum).toFixed(2);
                var real_sum = conv_sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('#sliptotalsumpct').val(real_sum);
                $('#sliptotalsumpct2').val(real_sum);

                var dpamount = $('#slipdpamount').val();
                var ecamount = $('#slipamountec').val();

                swal('Success!','tsi in slip changed, please change value in risk detail, deductible and extendcoverage manually','success')

                if(dpamount != null){
                    var percent =  parseFloat($('#slipdppercentage').val()) / 100;
                    
                    var sum = isNaN(percent * conv_tsi) ? 0 :(percent * conv_tsi).toFixed(2) ;
                    var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    console.log($('#slipdppercentage').val())
                    console.log(percent)
                    console.log(sum)
                    console.log(real_sum)

                    $('#slipdpamount').val(real_sum);
                    $('#slipdpamount2').val(real_sum);
                }

                if(ecamount != null){

                    var persentage =  parseFloat($('#slipnilaiec').val()) / 1000;
                    var sum = isNaN(conv_tsi * persentage) ? 0 :(conv_tsi * persentage).toFixed(2) ;
                    var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    console.log($('#slipnilaiec').val())
                    console.log(persentage)
                    console.log(sum)
                    console.log(real_sum)

                    $('#slipamountec').val(real_sum);
                    $('#slipamountec2').val(real_sum);
                    
                }

                


            }
            else{
                // swal('Success!','tsi in slip changed, please change value in risk detail','success')
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
            console.log(sum)
            var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            $('#sliptotalsumpct').val(real_sum);
            $('#sliptotalsumpct2').val(real_sum);
        }
    });

   $('#slipdppercentage').keyup(function (e) {
        if(e.keyCode != 9){
            var percent =  parseFloat($(this).val()) / 100;
            var tsi = $("#sliptotalsum").val();
            var conv_tsi = parseFloat(tsi.replace(/,/g, ""));
            var sum = isNaN(percent * conv_tsi) ? 0 :(percent * conv_tsi).toFixed(2) ;
            var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            console.log($(this).val())
            console.log(percent)
            console.log(sum)
            console.log(real_sum)

            $('#slipdpamount').val(real_sum);
            $('#slipdpamount2').val(real_sum);
        }
    });

   $('#slipshare').keyup(function (e) 
       {
        if(e.keyCode != 9){
            var shareslip =  parseFloat($(this).val()) / 100 ;
            var tsi = $("#sharetotalsum").val();
            var conv_tsi = parseFloat(tsi.replace(/,/g, ""));
            var sumshare =isNaN( shareslip * conv_tsi) ? 0 :( shareslip * conv_tsi).toFixed(2) ;
            var real_sumshare = sumshare.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


            $('#slipsumshare').val(real_sumshare);
            $('#slipsumshare2').val(real_sumshare);
        }
    });



   $('#sliprate').keyup(function (e) {
        if(e.keyCode != 9){
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
            var tsi = $("#sharetotalsum").val();
            var conv_tsi = parseFloat(tsi.replace(/,/g, ""));
            var totalrateexc = $('#sliptotalnilaiec').val();
            var basic_premi = $('#slipbasicpremium').val();

            if(totalrateexc){
                    var conv_totalrateexc = parseFloat(totalrateexc);
                    var sumtotalrate = isNaN(rateslip + parseFloat(conv_totalrateexc)) ? 0 :(rateslip + parseFloat(conv_totalrateexc)).toFixed(3);
                    var real_sumtotalrate = sumtotalrate.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    $('#sliptotalrate').val(real_sumtotalrate);
                    $('#sliptotalrate2').val(real_sumtotalrate);

                    var sumrate = $("#sliptotalrate").val();
                    var conv_sumrate = parseFloat(sumrate.replace(/,/g, ""));
                    var sum = isNaN(((conv_sumrate / 1000) * conv_tsi) * insurance) ? 0 :(((conv_sumrate / 1000) * conv_tsi) * insurance).toFixed(2) ;
                    var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                    $('#slipbasicpremium').val(real_sum);


            }else{
                    var conv_totalrateexc = parseFloat(totalrateexc);
                    var sumtotalrate = isNaN(parseFloat(0) + rateslip) ? 0 :(parseFloat(0) + rateslip).toFixed(3);
                    var real_sumtotalrate = sumtotalrate.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    $('#sliptotalrate').val(real_sumtotalrate);
                    $('#sliptotalrate2').val(real_sumtotalrate);

                    var sumrate = $("#sliptotalrate").val();
                    var conv_sumrate = parseFloat(sumrate.replace(/,/g, ""));
                    var sum = isNaN(((conv_sumrate / 1000) * conv_tsi) * insurance) ? 0 :(((conv_sumrate / 1000) * conv_tsi) * insurance).toFixed(2) ;
                    var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                    $('#slipbasicpremium').val(real_sum);


            }

            if(basic_premi){
                var bpinsurance_period_from2 = $('#sliprpfrom').val();
                var bpinsurance_period_to2 = $('#sliprpto').val();
                var bpnewinsurance_period_from2 = bpinsurance_period_from2.split("/").reverse().join("-");
                var bpnewinsurance_period_to2 = bpinsurance_period_to2.split("/").reverse().join("-");
                var bpdays=daysBetween(bpnewinsurance_period_from2, bpnewinsurance_period_to2);
                var bpinsurance = (bpdays/365);
                
                console.log(bpinsurance_period_from2)
                console.log(bpinsurance_period_to2)
                console.log(bpnewinsurance_period_from2)
                console.log(bpnewinsurance_period_to2)
                console.log(bpdays)
                console.log(bpinsurance)

                var bprateslip =  parseFloat($('#sliprate').val());
                var bpsumrate = $("#sliptotalrate").val();
                var bpconv_sumrate = parseFloat(bpsumrate.replace(/,/g, ""));
                var bptsi = $("#sharetotalsum").val();
                var bpconv_tsi = parseFloat(bptsi.replace(/,/g, ""));
                var bpsum = isNaN(((bpconv_sumrate / 1000) * bpconv_tsi) * bpinsurance) ? 0 :(((bpconv_sumrate / 1000) * bpconv_tsi) * bpinsurance).toFixed(2) ;
                var bpreal_sum = bpsum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                $('#slipbasicpremium').val(bpreal_sum);

                var share = $('#slipshare').val();
                if(share){
                    var shareslip =  parseFloat(share) / 100 ;
                    var nasionalreinsurance =  $('#mpsharefrom').val();
                    var totalnre =  $('#mpshareto').val();
                    var conv_totalnre =  parseFloat(totalnre.replace(/,/g, ""));

                    console.log('nre' + nasionalreinsurance)
                        // console.log(conv_nasionalreinsurance)
                    console.log('totalnre' + totalnre)
                    console.log('convtotnre' + conv_totalnre)
                    

                    var sumshare = $('#slipsumshare').val() ;
                    var conv_sumshare = parseFloat(sumshare.replace(/,/g, ""));

                    
                    var conv_basre = parseFloat(basic_premi.replace(/,/g, ""));

                    var orpercent = $('#slipor').val() / 100;

                    var sumor = isNaN(orpercent * conv_sumshare) ? 0 :(orpercent * conv_sumshare).toFixed(2);
                    var real_sumor = sumor.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    
                    var sumgprmtonr = isNaN(conv_basre * shareslip ) ? 0 :(conv_basre * shareslip ).toFixed(2);
                    var real_sumgprmtonr= sumgprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    
                    if(nasionalreinsurance){
                        var conv_nasionalreinsurance =  parseFloat(nasionalreinsurance.replace(/,/g, ""));
                        var sumnre = isNaN(conv_nasionalreinsurance + conv_sumshare ) ? 0 :(conv_nasionalreinsurance + conv_sumshare).toFixed(2) ;
                        var real_sumnre = sumnre.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    }else{
                        var conv_nasionalreinsurance =  parseFloat(nasionalreinsurance.replace(/,/g, ""));
                        var sumnre = isNaN(0 + conv_sumshare ) ? 0 :(0 + conv_sumshare).toFixed(2) ;
                        var real_sumnre = sumnre.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    }
                    
                    
                    var sumourshare = isNaN((sumnre / conv_totalnre) * 100 ) ? 0 :((sumnre / conv_totalnre) * 100 ).toFixed(2) ;

                    console.log('sumnre' + sumnre)
                    console.log('realnre' + real_sumnre)
                    console.log('sumourshare' + sumourshare)

                    $('#slipgrossprmtonr').val(real_sumgprmtonr);
                    $('#slipgrossprmtonr2').val(real_sumgprmtonr);
                    $('#slipsumor').val(real_sumor);
                    $('#slipsumor2').val(real_sumor);
                    // $('#mpshare').val(sumourshare.replace(/,/g, "."));
                    $('#mpsharefrom').val(real_sumnre);

                    var slipsumcommissionval = $('#slipsumcommission').val();
                    if(slipsumcommissionval != null){
                        var commision =  parseFloat($('#slipcommission').val()) / 100;
                        var feebroker = parseFloat($('#slipvbroker').val()) / 100;
                        var sumgrossprmtonr = $("#slipgrossprmtonr").val();
                        var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr.replace(/,/g, ""));

                        var sumcomm = isNaN(commision * conv_sumgrossprmtonr) ? 0 :(commision * conv_sumgrossprmtonr).toFixed(2);
                        var real_sumcomm = sumcomm.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                        $('#slipsumcommission').val(real_sumcomm);
                        $('#slipsumcommission2').val(real_sumcomm);

                        var netprm_to_nr = $('#slipnetprmtonr').val();
                        if(netprm_to_nr != null){


                            var sumnetprmtonr = isNaN( conv_sumgrossprmtonr * (100/100 - commision - feebroker)) ? 0 :(conv_sumgrossprmtonr * (100/100 - commision - feebroker)).toFixed(2);
                            var real_sumnetprmtonr = sumnetprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                            var sumfeebroker = isNaN( conv_sumgrossprmtonr * feebroker) ? 0 :(conv_sumgrossprmtonr * feebroker).toFixed(2);
                            var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


                            $('#slipnetprmtonr').val(real_sumnetprmtonr);
                            $('#slipnetprmtonr2').val(real_sumnetprmtonr);
                            // $('#slipsumfee').val("100" + "-" + commision.toString() + "-" + feebroker.toString() + "*" + conv_sumgrossprmtonr.toString());
                            $('#slipsumfee').val(real_sumfeebroker);
                            $('#slipsumfee2').val(real_sumfeebroker);

                            var retro_backup = $('#sliprb').val();
                            if(retro_backup == 'YES'){
                                swal('warning!','please change retrocession amount manually','success')
                            }

                        }

                    }
                }
            }
            
        }else{
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
            var tsi = $("#sharetotalsum").val();
            var conv_tsi = parseFloat(tsi.replace(/,/g, ""));
            var totalrateexc = $('#sliptotalnilaiec').val();
            var basic_premi = $('#slipbasicpremium').val();

            if(totalrateexc){
                    var conv_totalrateexc = parseFloat(totalrateexc);
                    var sumtotalrate = isNaN(rateslip + parseFloat(conv_totalrateexc)) ? 0 :(rateslip  + parseFloat(conv_totalrateexc)).toFixed(3);
                    var real_sumtotalrate = sumtotalrate.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    console.log('sliptotalrate' + sumtotalrate)
                    console.log('sliptotalrate' + real_sumtotalrate)
                    $('#sliptotalrate').val(real_sumtotalrate);
                    $('#sliptotalrate2').val(real_sumtotalrate);

                    var sumrate = $("#sliptotalrate").val();
                    var conv_sumrate = parseFloat(sumrate.replace(/,/g, ""));
                    var sum = isNaN(((conv_sumrate / 1000) * conv_tsi) * insurance) ? 0 :(((conv_sumrate / 1000) * conv_tsi) * insurance).toFixed(2) ;
                    var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    console.log('conv_sumrate' + sum)
                    console.log('real_sum' + real_sum)
                    $('#slipbasicpremium').val(real_sum);



                }else{
                     var conv_totalrateexc = parseFloat(totalrateexc);
                     var sumtotalrate = isNaN(parseFloat(0) + rateslip) ? 0 :(parseFloat(0) + rateslip).toFixed(3);
                     var real_sumtotalrate = sumtotalrate.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                     console.log('sliptotalrate' + sumtotalrate)
                    console.log('sliptotalrate' + real_sumtotalrate)
                     $('#sliptotalrate').val(real_sumtotalrate);
                     $('#sliptotalrate2').val(real_sumtotalrate);

                    var sumrate = $("#sliptotalrate").val();
                    var conv_sumrate = parseFloat(sumrate.replace(/,/g, ""));
                    var sum = isNaN(((conv_sumrate / 1000) * conv_tsi) * insurance) ? 0 :(((conv_sumrate / 1000) * conv_tsi) * insurance).toFixed(2) ;
                    var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    console.log('conv_sumrate' + sum)
                    console.log('real_sum' + real_sum)

                    $('#slipbasicpremium').val(real_sum);
                }

            if(basic_premi){
                var bpinsurance_period_from2 = $('#sliprpfrom').val();
                var bpinsurance_period_to2 = $('#sliprpto').val();
                var bpnewinsurance_period_from2 = bpinsurance_period_from2.split("/").reverse().join("-");
                var bpnewinsurance_period_to2 = bpinsurance_period_to2.split("/").reverse().join("-");
                var bpdays=daysBetween(bpnewinsurance_period_from2, bpnewinsurance_period_to2);
                var bpinsurance = (bpdays/365);
                
                console.log(bpinsurance_period_from2)
                console.log(bpinsurance_period_to2)
                console.log(bpnewinsurance_period_from2)
                console.log(bpnewinsurance_period_to2)
                console.log(bpdays)
                console.log(bpinsurance)

                var bprateslip =  parseFloat($('#sliprate').val());
                var bpsumrate = $("#sliptotalrate").val();
                var bpconv_sumrate = parseFloat(bpsumrate.replace(/,/g, ""));
                var bptsi = $("#sharetotalsum").val();
                var bpconv_tsi = parseFloat(bptsi.replace(/,/g, ""));
                var bpsum = isNaN(((bpconv_sumrate / 1000) * bpconv_tsi) * bpinsurance) ? 0 :(((bpconv_sumrate / 1000) * bpconv_tsi) * bpinsurance).toFixed(2) ;
                var bpreal_sum = bpsum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                $('#slipbasicpremium').val(bpreal_sum);

                var share = $('#slipshare').val();
                if(share){
                    var shareslip =  parseFloat(share) / 100 ;
                    var nasionalreinsurance =  $('#mpsharefrom').val();
                    var totalnre =  $('#mpshareto').val();
                    var conv_totalnre =  parseFloat(totalnre.replace(/,/g, ""));

                    console.log('nre' + nasionalreinsurance)
                        // console.log(conv_nasionalreinsurance)
                    console.log('totalnre' + totalnre)
                    console.log('convtotnre' + conv_totalnre)
                    

                    var sumshare = $('#slipsumshare').val() ;
                    var conv_sumshare = parseFloat(sumshare.replace(/,/g, ""));

                    
                    var conv_basre = parseFloat(basic_premi.replace(/,/g, ""));

                    var orpercent = $('#slipor').val() / 100;

                    var sumor = isNaN(orpercent * conv_sumshare) ? 0 :(orpercent * conv_sumshare).toFixed(2);
                    var real_sumor = sumor.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    
                    var sumgprmtonr = isNaN(conv_basre * shareslip ) ? 0 :(conv_basre * shareslip ).toFixed(2);
                    var real_sumgprmtonr= sumgprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    
                    if(nasionalreinsurance){
                        var conv_nasionalreinsurance =  parseFloat(nasionalreinsurance.replace(/,/g, ""));
                        var sumnre = isNaN(conv_nasionalreinsurance + conv_sumshare ) ? 0 :(conv_nasionalreinsurance + conv_sumshare).toFixed(2) ;
                        var real_sumnre = sumnre.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    }else{
                        var conv_nasionalreinsurance =  parseFloat(nasionalreinsurance.replace(/,/g, ""));
                        var sumnre = isNaN(0 + conv_sumshare ) ? 0 :(0 + conv_sumshare).toFixed(2) ;
                        var real_sumnre = sumnre.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    }
                    
                    
                    var sumourshare = isNaN((sumnre / conv_totalnre) * 100 ) ? 0 :((sumnre / conv_totalnre) * 100 ).toFixed(2) ;

                    console.log('sumnre' + sumnre)
                    console.log('realnre' + real_sumnre)
                    console.log('sumourshare' + sumourshare)

                    $('#slipgrossprmtonr').val(real_sumgprmtonr);
                    $('#slipgrossprmtonr2').val(real_sumgprmtonr);
                    $('#slipsumor').val(real_sumor);
                    $('#slipsumor2').val(real_sumor);
                    // $('#mpshare').val(sumourshare.replace(/,/g, "."));
                    $('#mpsharefrom').val(real_sumnre);

                    var slipsumcommissionval = $('#slipsumcommission').val();
                    if(slipsumcommissionval != null){
                        var commision =  parseFloat($('#slipcommission').val()) / 100;
                        var feebroker = parseFloat($('#slipvbroker').val()) / 100;
                        var sumgrossprmtonr = $("#slipgrossprmtonr").val();
                        var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr.replace(/,/g, ""));

                        var sumcomm = isNaN(commision * conv_sumgrossprmtonr) ? 0 :(commision * conv_sumgrossprmtonr).toFixed(2);
                        var real_sumcomm = sumcomm.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                        $('#slipsumcommission').val(real_sumcomm);
                        $('#slipsumcommission2').val(real_sumcomm);

                        var netprm_to_nr = $('#slipnetprmtonr').val();
                        if(netprm_to_nr != null){


                            var sumnetprmtonr = isNaN( conv_sumgrossprmtonr * (100/100 - commision - feebroker)) ? 0 :(conv_sumgrossprmtonr * (100/100 - commision - feebroker)).toFixed(2);
                            var real_sumnetprmtonr = sumnetprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                            var sumfeebroker = isNaN( conv_sumgrossprmtonr * feebroker) ? 0 :(conv_sumgrossprmtonr * feebroker).toFixed(2);
                            var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


                            $('#slipnetprmtonr').val(real_sumnetprmtonr);
                            $('#slipnetprmtonr2').val(real_sumnetprmtonr);
                            // $('#slipsumfee').val("100" + "-" + commision.toString() + "-" + feebroker.toString() + "*" + conv_sumgrossprmtonr.toString());
                            $('#slipsumfee').val(real_sumfeebroker);
                            $('#slipsumfee2').val(real_sumfeebroker);

                            var retro_backup = $('#sliprb').val();
                            if(retro_backup == 'YES'){
                                swal('warning!','please change retrocession amount manually','success')
                            }

                        }

                    }
                }
            }
        }
    });


   $('#sliprate').change(function(){
        var rate_lower = $('#slipbcla').val();
        var rate_upper = $('#slipbcua').val();
        var rate = $('#sliprate').val();
        

        if(rate_upper != '' || rate_lower != ''){
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
        }else{
            swal('warning','please choose building const first','error')
        }
   });

   $("#slipbasicpremium").keydown(function(e) { 
    var keyCode = e.keyCode || e.which; 

      if (keyCode == 9) { 
        // e.preventDefault(); 

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

        var rateslip =  parseFloat($('#sliprate').val());
        var sumrate = $("#sliptotalrate").val();
        var conv_sumrate = parseFloat(sumrate.replace(/,/g, ""));
        var tsi = $("#sharetotalsum").val();
        var conv_tsi = parseFloat(tsi.replace(/,/g, ""));
        var sum = isNaN(((conv_sumrate / 1000) * conv_tsi) * insurance) ? 0 :(((conv_sumrate / 1000) * conv_tsi) * insurance).toFixed(2) ;
        var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

        $('#slipbasicpremium').val(real_sum);
        // call custom function here
      } 
    });

   $("#slipbasicpremium").keyup(function(e) { 
    var keyCode = e.keyCode || e.which; 

      if (keyCode == 9) { 
        // e.preventDefault(); 
        // call custom function here
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

        var rateslip =  parseFloat($('#sliprate').val());
        var sumrate = $("#sliptotalrate").val();
        var conv_sumrate = parseFloat(sumrate.replace(/,/g, ""));
        var tsi = $("#sharetotalsum").val();
        var conv_tsi = parseFloat(tsi.replace(/,/g, ""));
        var sum = isNaN(((conv_sumrate / 1000) * conv_tsi) * insurance) ? 0 :(((conv_sumrate / 1000) * conv_tsi) * insurance).toFixed(2) ;
        var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

        $('#slipbasicpremium').val(real_sum);
      } 
    });

   $("#slipbasicpremium").keypress(function(e) { 
    var keyCode = e.keyCode || e.which; 

      if (keyCode == 9) { 
        // e.preventDefault(); 
        // call custom function here
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

        var rateslip =  parseFloat($('#sliprate').val());
        var sumrate = $("#sliptotalrate").val();
        var conv_sumrate = parseFloat(sumrate.replace(/,/g, ""));
        var tsi = $("#sharetotalsum").val();
        var conv_tsi = parseFloat(tsi.replace(/,/g, ""));
        var sum = isNaN(((conv_sumrate / 1000) * conv_tsi) * insurance) ? 0 :(((conv_sumrate / 1000) * conv_tsi) * insurance).toFixed(2) ;
        var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

        $('#slipbasicpremium').val(real_sum);
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
                var nasionalreinsurance =  $('#mpsharefrom').val();
                var totalnre =  $('#mpshareto').val();
                var conv_totalnre =  parseFloat(totalnre.replace(/,/g, ""));

                console.log('nre' + nasionalreinsurance)
                    // console.log(conv_nasionalreinsurance)
                console.log('totalnre' + totalnre)
                console.log('convtotnre' + conv_totalnre)
                
                var tsi = $("#sharetotalsum").val();
                var conv_tsi = parseFloat(tsi.replace(/,/g, ""));

                var sumshare = $('#slipsumshare').val() ;
                var conv_sumshare = parseFloat(sumshare.replace(/,/g, ""));

                var basic_premium = $('#slipbasicpremium').val();
                var conv_basre = parseFloat(basic_premium.replace(/,/g, ""));

                var orpercent = $('#slipor').val() / 100;

                var sumor = isNaN(orpercent * conv_sumshare) ? 0 :(orpercent * conv_sumshare).toFixed(2);
                var real_sumor = sumor.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                
                var sum = isNaN(conv_basre * shareslip ) ? 0 :(conv_basre * shareslip ).toFixed(2);
                var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                
                if(nasionalreinsurance){
                    var conv_nasionalreinsurance =  parseFloat(nasionalreinsurance.replace(/,/g, ""));
                    var sumnre = isNaN(conv_nasionalreinsurance + conv_sumshare ) ? 0 :(conv_nasionalreinsurance + conv_sumshare).toFixed(2) ;
                    var real_sumnre = sumnre.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                }else{
                    var conv_nasionalreinsurance =  parseFloat(nasionalreinsurance.replace(/,/g, ""));
                    var sumnre = isNaN(0 + conv_sumshare ) ? 0 :(0 + conv_sumshare).toFixed(2) ;
                    var real_sumnre = sumnre.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                }
                
                
                var sumourshare = isNaN((sumnre / conv_totalnre) * 100 ) ? 0 :((sumnre / conv_totalnre) * 100 ).toFixed(2) ;

                console.log('sumnre' + sumnre)
                console.log('realnre' + real_sumnre)
                console.log('sumourshare' + sumourshare)

                $('#slipgrossprmtonr').val(real_sum);
                $('#slipgrossprmtonr2').val(real_sum);
                $('#slipsumor').val(real_sumor);
                $('#slipsumor2').val(real_sumor);
                // $('#mpshare').val(sumourshare.replace(/,/g, "."));
                $('#mpsharefrom').val(real_sumnre);

                var slipsumcommissionval = $('#slipsumcommission').val();
                if(slipsumcommissionval != null){
                    var commision =  parseFloat($('#slipcommission').val()) / 100;
                    var feebroker = parseFloat($('#slipvbroker').val()) / 100;
                    var sumgrossprmtonr = $("#slipgrossprmtonr").val();
                    var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr.replace(/,/g, ""));

                    var sumcomm = isNaN(commision * conv_sumgrossprmtonr) ? 0 :(commision * conv_sumgrossprmtonr).toFixed(2);
                    var real_sumcomm = sumcomm.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                    $('#slipsumcommission').val(real_sumcomm);
                    $('#slipsumcommission2').val(real_sumcomm);

                    var netprm_to_nr = $('#slipnetprmtonr').val();
                    if(netprm_to_nr != null){


                        var sumnetprmtonr = isNaN( conv_sumgrossprmtonr * (100/100 - commision - feebroker)) ? 0 :(conv_sumgrossprmtonr * (100/100 - commision - feebroker)).toFixed(2);
                        var real_sumnetprmtonr = sumnetprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                        var sumfeebroker = isNaN( conv_sumgrossprmtonr * feebroker) ? 0 :(conv_sumgrossprmtonr * feebroker).toFixed(2);
                        var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


                        $('#slipnetprmtonr').val(real_sumnetprmtonr);
                        $('#slipnetprmtonr2').val(real_sumnetprmtonr);
                        // $('#slipsumfee').val("100" + "-" + commision.toString() + "-" + feebroker.toString() + "*" + conv_sumgrossprmtonr.toString());
                        $('#slipsumfee').val(real_sumfeebroker);
                        $('#slipsumfee2').val(real_sumfeebroker);

                        var retro_backup = $('#sliprb').val();
                        if(retro_backup == 'YES'){
                            swal('warning!','please change retrocession amount manually','success')
                        }

                    }

                }

            }
        }
    });

   $('#slipcommission').keyup(function (e) {
        var keyCode = e.keyCode || e.which;

        if (keyCode != 9){
            var commision =  parseFloat($(this).val()) / 100;
            var feebroker = parseFloat($('#slipvbroker').val()) / 100;
            var sumgrossprmtonr = $("#slipgrossprmtonr").val();
            var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr.replace(/,/g, ""));

            var sum = isNaN(commision * conv_sumgrossprmtonr) ? 0 :(commision * conv_sumgrossprmtonr).toFixed(2);
            var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipsumcommission').val(real_sum);
            $('#slipsumcommission2').val(real_sum);

            if(feebroker != null){
                var netprm_to_nr = $('#slipnetprmtonr').val();
                
                var sumnetprmtonr = isNaN( conv_sumgrossprmtonr * (100/100 - commision - feebroker)) ? 0 :(conv_sumgrossprmtonr * (100/100 - commision - feebroker)).toFixed(2);
                var real_sumnetprmtonr = sumnetprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                var sumfeebroker = isNaN( conv_sumgrossprmtonr * feebroker) ? 0 :(conv_sumgrossprmtonr * feebroker).toFixed(2);
                var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


                $('#slipnetprmtonr').val(real_sumnetprmtonr);
                $('#slipnetprmtonr2').val(real_sumnetprmtonr);
                // $('#slipsumfee').val("100" + "-" + commision.toString() + "-" + feebroker.toString() + "*" + conv_sumgrossprmtonr.toString());
                $('#slipsumfee').val(real_sumfeebroker);
                $('#slipsumfee2').val(real_sumfeebroker);
            }
        }else{
            var commision =  parseFloat($(this).val()) / 100;
            var feebroker = parseFloat($('#slipvbroker').val()) / 100;
            var sumgrossprmtonr = $("#slipgrossprmtonr").val();
            var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr.replace(/,/g, ""));

            var sum = isNaN(commision * conv_sumgrossprmtonr) ? 0 :(commision * conv_sumgrossprmtonr).toFixed(2);
            var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipsumcommission').val(real_sum);
            $('#slipsumcommission2').val(real_sum);

            if(feebroker != null){
                var netprm_to_nr = $('#slipnetprmtonr').val();
                
                var sumnetprmtonr = isNaN( conv_sumgrossprmtonr * (100/100 - commision - feebroker)) ? 0 :(conv_sumgrossprmtonr * (100/100 - commision - feebroker)).toFixed(2);
                var real_sumnetprmtonr = sumnetprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                var sumfeebroker = isNaN( conv_sumgrossprmtonr * feebroker) ? 0 :(conv_sumgrossprmtonr * feebroker).toFixed(2);
                var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


                $('#slipnetprmtonr').val(real_sumnetprmtonr);
                $('#slipnetprmtonr2').val(real_sumnetprmtonr);
                // $('#slipsumfee').val("100" + "-" + commision.toString() + "-" + feebroker.toString() + "*" + conv_sumgrossprmtonr.toString());
                $('#slipsumfee').val(real_sumfeebroker);
                $('#slipsumfee2').val(real_sumfeebroker);
            }
        }

    });

   $('#slipcommission').keydown(function (e) {
        var keyCode = e.keyCode || e.which;

        if (keyCode != 9){
            var commision =  parseFloat($(this).val()) / 100;
            var feebroker = parseFloat($('#slipvbroker').val()) / 100;
            var sumgrossprmtonr = $("#slipgrossprmtonr").val();
            var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr.replace(/,/g, ""));

            var sum = isNaN(commision * conv_sumgrossprmtonr) ? 0 :(commision * conv_sumgrossprmtonr).toFixed(2);
            var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipsumcommission').val(real_sum);
            $('#slipsumcommission2').val(real_sum);

            if(feebroker != null){
                var netprm_to_nr = $('#slipnetprmtonr').val();
                
                var sumnetprmtonr = isNaN( conv_sumgrossprmtonr * (100/100 - commision - feebroker)) ? 0 :(conv_sumgrossprmtonr * (100/100 - commision - feebroker)).toFixed(2);
                var real_sumnetprmtonr = sumnetprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                var sumfeebroker = isNaN( conv_sumgrossprmtonr * feebroker) ? 0 :(conv_sumgrossprmtonr * feebroker).toFixed(2);
                var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


                $('#slipnetprmtonr').val(real_sumnetprmtonr);
                $('#slipnetprmtonr2').val(real_sumnetprmtonr);
                // $('#slipsumfee').val("100" + "-" + commision.toString() + "-" + feebroker.toString() + "*" + conv_sumgrossprmtonr.toString());
                $('#slipsumfee').val(real_sumfeebroker);
                $('#slipsumfee2').val(real_sumfeebroker);
            }
        }else{
            var commision =  parseFloat($(this).val()) / 100;
            var feebroker = parseFloat($('#slipvbroker').val()) / 100;
            var sumgrossprmtonr = $("#slipgrossprmtonr").val();
            var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr.replace(/,/g, ""));

            var sum = isNaN(commision * conv_sumgrossprmtonr) ? 0 :(commision * conv_sumgrossprmtonr).toFixed(2);
            var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipsumcommission').val(real_sum);
            $('#slipsumcommission2').val(real_sum);

            if(feebroker != null){
                var netprm_to_nr = $('#slipnetprmtonr').val();
                
                var sumnetprmtonr = isNaN( conv_sumgrossprmtonr * (100/100 - commision - feebroker)) ? 0 :(conv_sumgrossprmtonr * (100/100 - commision - feebroker)).toFixed(2);
                var real_sumnetprmtonr = sumnetprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                var sumfeebroker = isNaN( conv_sumgrossprmtonr * feebroker) ? 0 :(conv_sumgrossprmtonr * feebroker).toFixed(2);
                var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


                $('#slipnetprmtonr').val(real_sumnetprmtonr);
                $('#slipnetprmtonr2').val(real_sumnetprmtonr);
                // $('#slipsumfee').val("100" + "-" + commision.toString() + "-" + feebroker.toString() + "*" + conv_sumgrossprmtonr.toString());
                $('#slipsumfee').val(real_sumfeebroker);
                $('#slipsumfee2').val(real_sumfeebroker);
            }
        }

    });

   $('#slipcommission').keypress(function (e) {
        var keyCode = e.keyCode || e.which;

        if (keyCode != 9){
            var commision =  parseFloat($(this).val()) / 100;
            var feebroker = parseFloat($('#slipvbroker').val()) / 100;
            var sumgrossprmtonr = $("#slipgrossprmtonr").val();
            var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr.replace(/,/g, ""));

            var sum = isNaN(commision * conv_sumgrossprmtonr) ? 0 :(commision * conv_sumgrossprmtonr).toFixed(2);
            var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipsumcommission').val(real_sum);
            $('#slipsumcommission2').val(real_sum);

            if(feebroker != null){
                var netprm_to_nr = $('#slipnetprmtonr').val();
                
                var sumnetprmtonr = isNaN( conv_sumgrossprmtonr * (100/100 - commision - feebroker)) ? 0 :(conv_sumgrossprmtonr * (100/100 - commision - feebroker)).toFixed(2);
                var real_sumnetprmtonr = sumnetprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                var sumfeebroker = isNaN( conv_sumgrossprmtonr * feebroker) ? 0 :(conv_sumgrossprmtonr * feebroker).toFixed(2);
                var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


                $('#slipnetprmtonr').val(real_sumnetprmtonr);
                $('#slipnetprmtonr2').val(real_sumnetprmtonr);
                // $('#slipsumfee').val("100" + "-" + commision.toString() + "-" + feebroker.toString() + "*" + conv_sumgrossprmtonr.toString());
                $('#slipsumfee').val(real_sumfeebroker);
                $('#slipsumfee2').val(real_sumfeebroker);
            }
        }else{
            var commision =  parseFloat($(this).val()) / 100;
            var feebroker = parseFloat($('#slipvbroker').val()) / 100;
            var sumgrossprmtonr = $("#slipgrossprmtonr").val();
            var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr.replace(/,/g, ""));

            var sum = isNaN(commision * conv_sumgrossprmtonr) ? 0 :(commision * conv_sumgrossprmtonr).toFixed(2);
            var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipsumcommission').val(real_sum);
            $('#slipsumcommission2').val(real_sum);

            if(feebroker != null){
                var netprm_to_nr = $('#slipnetprmtonr').val();
                
                var sumnetprmtonr = isNaN( conv_sumgrossprmtonr * (100/100 - commision - feebroker)) ? 0 :(conv_sumgrossprmtonr * (100/100 - commision - feebroker)).toFixed(2);
                var real_sumnetprmtonr = sumnetprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                var sumfeebroker = isNaN( conv_sumgrossprmtonr * feebroker) ? 0 :(conv_sumgrossprmtonr * feebroker).toFixed(2);
                var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


                $('#slipnetprmtonr').val(real_sumnetprmtonr);
                $('#slipnetprmtonr2').val(real_sumnetprmtonr);
                // $('#slipsumfee').val("100" + "-" + commision.toString() + "-" + feebroker.toString() + "*" + conv_sumgrossprmtonr.toString());
                $('#slipsumfee').val(real_sumfeebroker);
                $('#slipsumfee2').val(real_sumfeebroker);
            }
        }

    });

   $('#slipsumcommission2').keyup(function(e){
        var keyCode = e.keyCode || e.which; 

        if (keyCode != 9) {
            $('#slipsumcommission').val($(this).val());
            var sumcommision =  $('#slipsumcommission').val();
            var conv_sumcommision = parseFloat(sumcommision.replace(/,/g, ""));
            var commisionval =  $('#slipcommission').val();
            var feebroker = parseFloat($('#slipvbroker').val());
            var sumgrossprmtonr2 = $("#slipgrossprmtonr").val();
            var conv_sumgrossprmtonr2 = parseFloat(sumgrossprmtonr2.replace(/,/g, ""));

            // if(commisionval != null){
                var sum = isNaN((conv_sumcommision / conv_sumgrossprmtonr2)*100) ? 0 :((conv_sumcommision / conv_sumgrossprmtonr2)*100).toFixed(2);
                var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                $('#slipcommission').val(real_sum);
                if(feebroker != null){
                    var commision = parseFloat($('#slipcommission').val());
                    var netprm_to_nr = $('#slipnetprmtonr').val();
                    
                    var sumnetprmtonr = isNaN( conv_sumgrossprmtonr2 * ((100 - commision - feebroker)/100)) ? 0 :(conv_sumgrossprmtonr2 * ((100 - commision - feebroker)/100)).toFixed(2);
                    var real_sumnetprmtonr = sumnetprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                    var sumfeebroker = isNaN( conv_sumgrossprmtonr2 * feebroker) ? 0 :(conv_sumgrossprmtonr2 * feebroker).toFixed(2);
                    var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


                    $('#slipnetprmtonr').val(real_sumnetprmtonr);
                    $('#slipnetprmtonr2').val(real_sumnetprmtonr);
                    // $('#slipsumfee').val("100" + "-" + commision.toString() + "-" + feebroker.toString() + "*" + conv_sumgrossprmtonr.toString());
                    $('#slipsumfee').val(real_sumfeebroker);
                    $('#slipsumfee2').val(real_sumfeebroker);
                }

            // }
        }else{
            var commision =  parseFloat($('#slipcommission').val()) / 100;
            var feebroker = parseFloat($('#slipvbroker').val()) / 100;
            var sumgrossprmtonr = $("#slipgrossprmtonr").val();
            var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr.replace(/,/g, ""));

            var sum = isNaN(commision * conv_sumgrossprmtonr) ? 0 :(commision * conv_sumgrossprmtonr).toFixed(2);
            var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipsumcommission').val(real_sum);
            $('#slipsumcommission2').val(real_sum);
        }
   });

   $('#slipsumcommission2').keydown(function(e){
        var keyCode = e.keyCode || e.which; 

        if (keyCode != 9) {
            // $('#slipsumcommission').val($(this).val());
            // var sumcommision =  $('#slipsumcommission').val();
            // var conv_sumcommision = parseFloat(sumcommision.replace(/,/g, ""));
            // var commisionval =  $('#slipcommission').val();
            // var feebroker = parseFloat($('#slipvbroker').val()) / 100;
            // var sumgrossprmtonr2 = $("#slipgrossprmtonr").val();
            // var conv_sumgrossprmtonr2 = parseFloat(sumgrossprmtonr2.replace(/,/g, ""));

            // if(commisionval != null){
            //     var sum = isNaN((conv_sumcommision / conv_sumgrossprmtonr2)*100) ? 0 :((conv_sumcommision / conv_sumgrossprmtonr2)*100).toFixed(2);
            //     var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            //     $('#slipcommission').val(real_sum);

            // }
        }else{
            var commision =  parseFloat($('#slipcommission').val()) / 100;
            var feebroker = parseFloat($('#slipvbroker').val()) / 100;
            var sumgrossprmtonr = $("#slipgrossprmtonr").val();
            var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr.replace(/,/g, ""));

            var sum = isNaN(commision * conv_sumgrossprmtonr) ? 0 :(commision * conv_sumgrossprmtonr).toFixed(2);
            var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipsumcommission').val(real_sum);
            $('#slipsumcommission2').val(real_sum);
        }
   });

   $('#slipsumcommission2').keypress(function(e){
        var keyCode = e.keyCode || e.which; 

        if (keyCode != 9) {
            // $('#slipsumcommission').val($(this).val());
            // var sumcommision =  $('#slipsumcommission').val();
            // var conv_sumcommision = parseFloat(sumcommision.replace(/,/g, ""));
            // var commisionval =  $('#slipcommission').val();
            // var feebroker = parseFloat($('#slipvbroker').val()) / 100;
            // var sumgrossprmtonr2 = $("#slipgrossprmtonr").val();
            // var conv_sumgrossprmtonr2 = parseFloat(sumgrossprmtonr2.replace(/,/g, ""));

            // if(commisionval != null){
            //     var sum = isNaN((conv_sumcommision / conv_sumgrossprmtonr2)*100) ? 0 :((conv_sumcommision / conv_sumgrossprmtonr2)*100).toFixed(2);
            //     var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            //     $('#slipcommission').val(real_sum);

            // }
        }else{
            var commision =  parseFloat($('#slipcommission').val()) / 100;
            var feebroker = parseFloat($('#slipvbroker').val()) / 100;
            var sumgrossprmtonr = $("#slipgrossprmtonr").val();
            var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr.replace(/,/g, ""));

            var sum = isNaN(commision * conv_sumgrossprmtonr) ? 0 :(commision * conv_sumgrossprmtonr).toFixed(2);
            var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipsumcommission').val(real_sum);
            $('#slipsumcommission2').val(real_sum);
        }
   });




   $('#slipvbroker').keyup(function(e){
            var keyCode = e.keyCode || e.which; 

        if (keyCode != 9) {

            var netprm_to_nr = $('#slipnetprmtonr').val();
        
            var feebroker = parseFloat($('#slipvbroker').val()) / 100;
            var commision =  parseFloat($('#slipcommission').val()) / 100;
            var sumgrossprmtonr = $("#slipgrossprmtonr").val();
            var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr.replace(/,/g, ""));

            var sumfeebroker = isNaN( conv_sumgrossprmtonr * feebroker) ? 0 :(conv_sumgrossprmtonr * feebroker).toFixed(2);
            var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipsumfee').val(real_sumfeebroker);
            $('#slipsumfee2').val(real_sumfeebroker);

            var sumnetprmtonr = isNaN( conv_sumgrossprmtonr * (100/100 - commision - feebroker)) ? 0 :(conv_sumgrossprmtonr * (100/100 - commision - feebroker)).toFixed(2);
            var real_sumnetprmtonr = sumnetprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipnetprmtonr').val(real_sumnetprmtonr);
            $('#slipnetprmtonr2').val(real_sumnetprmtonr);

        }else{
            var netprm_to_nr = $('#slipnetprmtonr').val();
        
            var feebroker = parseFloat($('#slipvbroker').val()) / 100;
            var commision =  parseFloat($('#slipcommission').val()) / 100;
            var sumgrossprmtonr = $("#slipgrossprmtonr").val();
            var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr.replace(/,/g, ""));

            var sumfeebroker = isNaN( conv_sumgrossprmtonr * feebroker) ? 0 :(conv_sumgrossprmtonr * feebroker).toFixed(2);
            var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipsumfee').val(real_sumfeebroker);
            $('#slipsumfee2').val(real_sumfeebroker);

            var sumnetprmtonr = isNaN( conv_sumgrossprmtonr * (100/100 - commision - feebroker)) ? 0 :(conv_sumgrossprmtonr * (100/100 - commision - feebroker)).toFixed(2);
            var real_sumnetprmtonr = sumnetprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipnetprmtonr').val(real_sumnetprmtonr);
            $('#slipnetprmtonr2').val(real_sumnetprmtonr);
        }
    });

   $('#slipvbroker').keydown(function(e){
            var keyCode = e.keyCode || e.which; 

        if (keyCode != 9) {

            var netprm_to_nr = $('#slipnetprmtonr').val();
        
            var feebroker = parseFloat($('#slipvbroker').val()) / 100;
            var commision =  parseFloat($('#slipcommission').val()) / 100;
            var sumgrossprmtonr = $("#slipgrossprmtonr").val();
            var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr.replace(/,/g, ""));

            var sumfeebroker = isNaN( conv_sumgrossprmtonr * feebroker) ? 0 :(conv_sumgrossprmtonr * feebroker).toFixed(2);
            var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipsumfee').val(real_sumfeebroker);
            $('#slipsumfee2').val(real_sumfeebroker);

            var sumnetprmtonr = isNaN( conv_sumgrossprmtonr * (100/100 - commision - feebroker)) ? 0 :(conv_sumgrossprmtonr * (100/100 - commision - feebroker)).toFixed(2);
            var real_sumnetprmtonr = sumnetprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipnetprmtonr').val(real_sumnetprmtonr);
            $('#slipnetprmtonr2').val(real_sumnetprmtonr);

        }else{
            var netprm_to_nr = $('#slipnetprmtonr').val();
        
            var feebroker = parseFloat($('#slipvbroker').val()) / 100;
            var commision =  parseFloat($('#slipcommission').val()) / 100;
            var sumgrossprmtonr = $("#slipgrossprmtonr").val();
            var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr.replace(/,/g, ""));

            var sumfeebroker = isNaN( conv_sumgrossprmtonr * feebroker) ? 0 :(conv_sumgrossprmtonr * feebroker).toFixed(2);
            var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipsumfee').val(real_sumfeebroker);
            $('#slipsumfee2').val(real_sumfeebroker);

            var sumnetprmtonr = isNaN( conv_sumgrossprmtonr * (100/100 - commision - feebroker)) ? 0 :(conv_sumgrossprmtonr * (100/100 - commision - feebroker)).toFixed(2);
            var real_sumnetprmtonr = sumnetprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipnetprmtonr').val(real_sumnetprmtonr);
            $('#slipnetprmtonr2').val(real_sumnetprmtonr);
        }
    });

   $('#slipvbroker').keypress(function(e){
            var keyCode = e.keyCode || e.which; 

        if (keyCode != 9) {

            var netprm_to_nr = $('#slipnetprmtonr').val();
        
            var feebroker = parseFloat($('#slipvbroker').val()) / 100;
            var commision =  parseFloat($('#slipcommission').val()) / 100;
            var sumgrossprmtonr = $("#slipgrossprmtonr").val();
            var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr.replace(/,/g, ""));

            var sumfeebroker = isNaN( conv_sumgrossprmtonr * feebroker) ? 0 :(conv_sumgrossprmtonr * feebroker).toFixed(2);
            var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipsumfee').val(real_sumfeebroker);
            $('#slipsumfee2').val(real_sumfeebroker);

            var sumnetprmtonr = isNaN( conv_sumgrossprmtonr * (100/100 - commision - feebroker)) ? 0 :(conv_sumgrossprmtonr * (100/100 - commision - feebroker)).toFixed(2);
            var real_sumnetprmtonr = sumnetprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipnetprmtonr').val(real_sumnetprmtonr);
            $('#slipnetprmtonr2').val(real_sumnetprmtonr);

        }else{
            var netprm_to_nr = $('#slipnetprmtonr').val();
        
            var feebroker = parseFloat($('#slipvbroker').val()) / 100;
            var commision =  parseFloat($('#slipcommission').val()) / 100;
            var sumgrossprmtonr = $("#slipgrossprmtonr").val();
            var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr.replace(/,/g, ""));

            var sumfeebroker = isNaN( conv_sumgrossprmtonr * feebroker) ? 0 :(conv_sumgrossprmtonr * feebroker).toFixed(2);
            var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipsumfee').val(real_sumfeebroker);
            $('#slipsumfee2').val(real_sumfeebroker);

            var sumnetprmtonr = isNaN( conv_sumgrossprmtonr * (100/100 - commision - feebroker)) ? 0 :(conv_sumgrossprmtonr * (100/100 - commision - feebroker)).toFixed(2);
            var real_sumnetprmtonr = sumnetprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipnetprmtonr').val(real_sumnetprmtonr);
            $('#slipnetprmtonr2').val(real_sumnetprmtonr);
        }
    });
 

   $('#slipsumfee2').keyup(function(e){
        var keyCode = e.keyCode || e.which; 

        if (keyCode != 9) {
            var netprm_to_nr = $('#slipnetprmtonr').val();
            $('#slipsumfee').val($(this).val());
            
            var commision =  parseFloat($('#slipcommission').val());
            var sumgrossprmtonr = $("#slipgrossprmtonr").val();
            var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr.replace(/,/g, ""));
            var netprm_to_nr = $('#slipnetprmtonr').val();
            var sumfeebroker2 = $('#slipsumfee').val();
            var conv_sumfeebroker = parseFloat(sumfeebroker2.replace(/,/g, ""));
            var feebrokerval = $('#slipvbroker').val();

            // if(feebrokerval != null){
                var sumvbroker = isNaN((conv_sumfeebroker / conv_sumgrossprmtonr)*100) ? 0 :((conv_sumfeebroker / conv_sumgrossprmtonr)*100).toFixed(2);
                var real_sumvbroker = sumvbroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                $('#slipvbroker').val(real_sumvbroker);

                var feebroker = parseFloat($('#slipvbroker').val());

                var sumnetprmtonr = isNaN( conv_sumgrossprmtonr * ((100 - commision - feebroker)/100)) ? 0 :(conv_sumgrossprmtonr * ((100 - commision - feebroker)/100)).toFixed(2);
                var real_sumnetprmtonr = sumnetprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                $('#slipnetprmtonr').val(real_sumnetprmtonr);
                $('#slipnetprmtonr2').val(real_sumnetprmtonr);


            // }


            
        }else{
            var netprm_to_nr = $('#slipnetprmtonr').val();
        
            var feebroker = parseFloat($('#slipvbroker').val()) / 100;
            var commision =  parseFloat($('#slipcommission').val()) / 100;
            var sumgrossprmtonr = $("#slipgrossprmtonr").val();
            var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr.replace(/,/g, ""));

            var sumfeebroker = isNaN( conv_sumgrossprmtonr * feebroker) ? 0 :(conv_sumgrossprmtonr * feebroker).toFixed(2);
            var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipsumfee').val(real_sumfeebroker);
            $('#slipsumfee2').val(real_sumfeebroker);
        }
   });

   $('#slipsumfee2').keydown(function(e){
        var keyCode = e.keyCode || e.which; 

        if (keyCode != 9) {
            // var netprm_to_nr = $('#slipnetprmtonr').val();
            // $('#slipsumfee').val($(this).val());
            // var feebroker = parseFloat($('#slipvbroker').val()) / 100;
            // var commision =  parseFloat($('#slipcommission').val()) / 100;
            // var sumgrossprmtonr = $("#slipgrossprmtonr").val();
            // var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr.replace(/,/g, ""));
            // var netprm_to_nr = $('#slipnetprmtonr').val();
            // var sumfeebroker2 = $('#slipsumfee').val();
            // var conv_sumfeebroker = parseFloat(sumfeebroker2.replace(/,/g, ""));
            // var feebrokerval = $('#slipvbroker').val();

            // if(feebrokerval != null){
            //     var sumvbroker = isNaN((conv_sumfeebroker / conv_sumgrossprmtonr)*100) ? 0 :((conv_sumfeebroker / conv_sumgrossprmtonr)*100).toFixed(2);
            //     var real_sumvbroker = sumvbroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            //     $('#slipvbroker').val(real_sumvbroker);
            // }
            
        }else{
            var netprm_to_nr = $('#slipnetprmtonr').val();
        
            var feebroker = parseFloat($('#slipvbroker').val()) / 100;
            var commision =  parseFloat($('#slipcommission').val()) / 100;
            var sumgrossprmtonr = $("#slipgrossprmtonr").val();
            var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr.replace(/,/g, ""));

            var sumfeebroker = isNaN( conv_sumgrossprmtonr * feebroker) ? 0 :(conv_sumgrossprmtonr * feebroker).toFixed(2);
            var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipsumfee').val(real_sumfeebroker);
            $('#slipsumfee2').val(real_sumfeebroker);
        }
   });

   $('#slipsumfee2').keypress(function(e){
        var keyCode = e.keyCode || e.which; 

        if (keyCode != 9) {
            // var netprm_to_nr = $('#slipnetprmtonr').val();
            // $('#slipsumfee').val($(this).val());
            // var feebroker = parseFloat($('#slipvbroker').val()) / 100;
            // var commision =  parseFloat($('#slipcommission').val()) / 100;
            // var sumgrossprmtonr = $("#slipgrossprmtonr").val();
            // var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr.replace(/,/g, ""));
            // var netprm_to_nr = $('#slipnetprmtonr').val();
            // var sumfeebroker2 = $('#slipsumfee').val();
            // var conv_sumfeebroker = parseFloat(sumfeebroker2.replace(/,/g, ""));
            // var feebrokerval = $('#slipvbroker').val();

            // if(feebrokerval != null){
            //     var sumvbroker = isNaN((conv_sumfeebroker / conv_sumgrossprmtonr)*100) ? 0 :((conv_sumfeebroker / conv_sumgrossprmtonr)*100).toFixed(2);
            //     var real_sumvbroker = sumvbroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            //     $('#slipvbroker').val(real_sumvbroker);
            // }
            
        }else{
           var netprm_to_nr = $('#slipnetprmtonr').val();
        
            var feebroker = parseFloat($('#slipvbroker').val()) / 100;
            var commision =  parseFloat($('#slipcommission').val()) / 100;
            var sumgrossprmtonr = $("#slipgrossprmtonr").val();
            var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr.replace(/,/g, ""));

            var sumfeebroker = isNaN( conv_sumgrossprmtonr * feebroker) ? 0 :(conv_sumgrossprmtonr * feebroker).toFixed(2);
            var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipsumfee').val(real_sumfeebroker);
            $('#slipsumfee2').val(real_sumfeebroker);
        }
   });

    $('#slipvbroker').change(function(){

        if( $('#installmentPanel tbody').find('tr').val().length > 0){
            swal('warning!','netprm to nr changed, please change installment amount manually','success')
        }

   });

   $('#slipippercentage').keyup(function (e) {
        var keyCode = e.keyCode || e.which; 

        if(keyCode != 9){
            var percent =  parseFloat($(this).val()) / 100;

            var sumnetprtonr = $("#slipnetprmtonr").val();
            var conv_sumnetprtonr = parseFloat(sumnetprtonr.replace(/,/g, ""));

            var sum = isNaN(percent *  conv_sumnetprtonr) ? 0 :(percent *  conv_sumnetprtonr).toFixed(2);
            var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipipamount').val(real_sum);
            // $('#slipipamount2').val(real_sum);
        }else{
            var percent =  parseFloat($(this).val()) / 100;

            var sumnetprtonr = $("#slipnetprmtonr").val();
            var conv_sumnetprtonr = parseFloat(sumnetprtonr.replace(/,/g, ""));

            var sum = isNaN(percent *  conv_sumnetprtonr) ? 0 :(percent *  conv_sumnetprtonr).toFixed(2);
            var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipipamount').val(real_sum);
        }
    });

   $('#slipippercentage').keydown(function (e) {
        var keyCode = e.keyCode || e.which;

        if(keyCode != 9){
            var percent =  parseFloat($(this).val()) / 100;

            var sumnetprtonr = $("#slipnetprmtonr").val();
            var conv_sumnetprtonr = parseFloat(sumnetprtonr.replace(/,/g, ""));

            var sum = isNaN(percent *  conv_sumnetprtonr) ? 0 :(percent *  conv_sumnetprtonr).toFixed(2);
            var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipipamount').val(real_sum);
            // $('#slipipamount2').val(real_sum);
        }else{
            var percent =  parseFloat($(this).val()) / 100;

            var sumnetprtonr = $("#slipnetprmtonr").val();
            var conv_sumnetprtonr = parseFloat(sumnetprtonr.replace(/,/g, ""));

            var sum = isNaN(percent *  conv_sumnetprtonr) ? 0 :(percent *  conv_sumnetprtonr).toFixed(2);
            var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipipamount').val(real_sum);
        }
    });

   $('#slipippercentage').keypress(function (e) {
        var keyCode = e.keyCode || e.which;

        if(keyCode != 9){
            var percent =  parseFloat($(this).val()) / 100;

            var sumnetprtonr = $("#slipnetprmtonr").val();
            var conv_sumnetprtonr = parseFloat(sumnetprtonr.replace(/,/g, ""));

            var sum = isNaN(percent *  conv_sumnetprtonr) ? 0 :(percent *  conv_sumnetprtonr).toFixed(2);
            var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipipamount').val(real_sum);
            // $('#slipipamount2').val(real_sum);
        }else{
            var percent =  parseFloat($(this).val()) / 100;

            var sumnetprtonr = $("#slipnetprmtonr").val();
            var conv_sumnetprtonr = parseFloat(sumnetprtonr.replace(/,/g, ""));

            var sum = isNaN(percent *  conv_sumnetprtonr) ? 0 :(percent *  conv_sumnetprtonr).toFixed(2);
            var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipipamount').val(real_sum);
        }
    });

   $('#slipippercentage').change(function (e) {
        var keyCode = e.keyCode || e.which;

        if(keyCode != 9){
            var percent =  parseFloat($(this).val()) / 100;

            var sumnetprtonr = $("#slipnetprmtonr").val();
            var conv_sumnetprtonr = parseFloat(sumnetprtonr.replace(/,/g, ""));

            var sum = isNaN(percent *  conv_sumnetprtonr) ? 0 :(percent *  conv_sumnetprtonr).toFixed(2);
            var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipipamount').val(real_sum);
            // $('#slipipamount2').val(real_sum);
        }else{
            var percent =  parseFloat($(this).val()) / 100;

            var sumnetprtonr = $("#slipnetprmtonr").val();
            var conv_sumnetprtonr = parseFloat(sumnetprtonr.replace(/,/g, ""));

            var sum = isNaN(percent *  conv_sumnetprtonr) ? 0 :(percent *  conv_sumnetprtonr).toFixed(2);
            var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipipamount').val(real_sum);
        }
    });

   $('#slipipamount').change(function(e){
        var keyCode = e.keyCode || e.which;    

        if(keyCode != 9){
                var amount =  $(this).val();
                var conv_amount = parseFloat(amount.replace(/,/g, ""));
                console.log(amount)
                console.log(conv_amount)
                var sumnetprtonr = $("#slipnetprmtonr").val();
                var conv_sumnetprtonr = parseFloat(sumnetprtonr.replace(/,/g, ""));

                var sum = isNaN((conv_amount /  conv_sumnetprtonr) * 100) ? 0 :((conv_amount /  conv_sumnetprtonr) * 100).toFixed(2);
                var real_sum = sum.toString();
                console.log(sum)
                console.log(real_sum)

                $('#slipippercentage').val(real_sum);
                // $('#slipipamount2').val(real_sum);
            }else{
                 var amount =  $(this).val();
                var conv_amount = parseFloat(amount.replace(/,/g, ""));
                console.log(amount)
                console.log(conv_amount)
                var sumnetprtonr = $("#slipnetprmtonr").val();
                var conv_sumnetprtonr = parseFloat(sumnetprtonr.replace(/,/g, ""));
                
                var sum = isNaN((conv_amount /  conv_sumnetprtonr) * 100) ? 0 :((conv_amount /  conv_sumnetprtonr) * 100).toFixed(2);
                var real_sum = sum.toString();
                console.log(sum)
                console.log(real_sum)
                $('#slipippercentage').val(real_sum);
            }
   });

   $('#slipipamount').keyup(function(e){
        var keyCode = e.keyCode || e.which;

        if(keyCode != 9){
            //  var percent =  parseFloat($("#slipippercentage").val()) / 100;

            // var sumnetprtonr = $("#slipnetprmtonr").val();
            // var conv_sumnetprtonr = parseFloat(sumnetprtonr.replace(/,/g, ""));

            // var sum = isNaN(percent *  conv_sumnetprtonr) ? 0 :(percent *  conv_sumnetprtonr).toFixed(2);
            // var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            // $('#slipipamount').val(real_sum);

        }else{      
                 var percent =  parseFloat($("#slipippercentage").val()) / 100;

            var sumnetprtonr = $("#slipnetprmtonr").val();
            var conv_sumnetprtonr = parseFloat(sumnetprtonr.replace(/,/g, ""));

            var sum = isNaN(percent *  conv_sumnetprtonr) ? 0 :(percent *  conv_sumnetprtonr).toFixed(2);
            var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipipamount').val(real_sum);
        }
   });

   $('#slipipamount').keypress(function(e){
        var keyCode = e.keyCode || e.which;

        if(keyCode != 9){
               // var percent =  parseFloat($("#slipippercentage").val()) / 100;

               //  var sumnetprtonr = $("#slipnetprmtonr").val();
               //  var conv_sumnetprtonr = parseFloat(sumnetprtonr.replace(/,/g, ""));

               //  var sum = isNaN(percent *  conv_sumnetprtonr) ? 0 :(percent *  conv_sumnetprtonr).toFixed(2);
               //  var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

               //  $('#slipipamount').val(real_sum);
            }else{
                 var percent =  parseFloat($("#slipippercentage").val()) / 100;

                var sumnetprtonr = $("#slipnetprmtonr").val();
                var conv_sumnetprtonr = parseFloat(sumnetprtonr.replace(/,/g, ""));

                var sum = isNaN(percent *  conv_sumnetprtonr) ? 0 :(percent *  conv_sumnetprtonr).toFixed(2);
                var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                $('#slipipamount').val(real_sum);
            }
   });

   $('#slipipamount').keydown(function(e){
        var keyCode = e.keyCode || e.which;

        if(keyCode != 9){
                // var percent =  parseFloat($("#slipippercentage").val()) / 100;

                // var sumnetprtonr = $("#slipnetprmtonr").val();
                // var conv_sumnetprtonr = parseFloat(sumnetprtonr.replace(/,/g, ""));

                // var sum = isNaN(percent *  conv_sumnetprtonr) ? 0 :(percent *  conv_sumnetprtonr).toFixed(2);
                // var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                // $('#slipipamount').val(real_sum);
                // $('#slipipamount2').val(real_sum);
            }else{
                var percent =  parseFloat($("#slipippercentage").val()) / 100;

                var sumnetprtonr = $("#slipnetprmtonr").val();
                var conv_sumnetprtonr = parseFloat(sumnetprtonr.replace(/,/g, ""));

                var sum = isNaN(percent *  conv_sumnetprtonr) ? 0 :(percent *  conv_sumnetprtonr).toFixed(2);
                var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                $('#slipipamount').val(real_sum);
            }
   });

   $('#slipor').keyup(function(e) {
        if(e.keyCode != 9){
            var percent =  parseFloat($(this).val()) / 100;
            var sumshare = $("#slipsumshare").val();
            var conv_sumshare = parseFloat(sumshare.replace(/,/g, ""));

            var sum = isNaN(percent * conv_sumshare) ? 0 :(percent * conv_sumshare).toFixed(2);
            var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            if($(this).val() > 100){
                swal('warning!','percentage cannot more than 100%','sum value error');
                $('#slipsumor').empty();
                $('#slipsumor2').empty();
            }else{
                $('#slipsumor').val(real_sum);
                $('#slipsumor2').val(real_sum);
            }

            


        }
    });

   $('#sliprppercentage').keyup(function (e) {
    if(e.keyCode != 9){
        var percentval =  parseFloat($(this).val()) / 100;
        var sumshare = $('#slipsumshare').val() ;
        var conv_sumshare = parseFloat(sumshare.replace(/,/g, ""));
        var sumrpamount = isNaN(percentval * conv_sumshare) ? 0 :(percentval * conv_sumshare).toFixed(2);
        var real_sumrpamount = sumrpamount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            // var sumpercentor = isNaN(orpercent - percentval) ? 0 :(orpercent - percentval); 
            // $('#slipor').val(sumpercentor);
            $('#sliprpamount').val(real_sumrpamount);
            $('#sliprpamount2').val(real_sumrpamount);
        }
    });

   $('#sliprppercentage').change(function (e) {
        if(e.keyCode != 9){
            var percentval =  parseFloat($(this).val());
            var orpercent = parseFloat($('#slipor').val());
            var sumpercentor = isNaN(orpercent - percentval) ? 0 :(orpercent - percentval).toFixed(2);
            $('#slipor').val(sumpercentor);

            var percent =  parseFloat($('#slipor').val()) / 100;
            var sumshare = $("#slipsumshare").val();
            var conv_sumshare = parseFloat(sumshare.replace(/,/g, ""));

            var sum = isNaN(percent * conv_sumshare) ? 0 :(percent * conv_sumshare).toFixed(2);
            var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipsumor').val(real_sum);
            $('#slipsumor2').val(real_sum);
        }
    });

   $('#slipnilaiec').keyup(function () {
        var persentage =  parseFloat($('#slipnilaiec').val()) / 1000;
        var sliptotalsum =  $('#sliptotalsum').val();
        var conv_sliptotalsum = parseFloat(sliptotalsum.replace(/,/g, ""));
       //alert(premiumnr);
       //alert(persentage);
        var sum = isNaN(conv_sliptotalsum * persentage) ? 0 :(conv_sliptotalsum * persentage).toFixed(2) ;
        var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
       //alert(sum);
        console.log($(this).val())
        console.log(persentage)
        console.log(sum)
        console.log(real_sum)

        $('#slipamountec').val(real_sum);
        $('#slipamountec2').val(real_sum);
   });
</script>

<script  type='text/javascript'>
   $('#slippctupdate').keyup(function (e) {
        if(e.keyCode != 9){
            var pct =  parseFloat($(this).val())/100;

            var tsi = $("#sliptotalsumupdate").val();
            var conv_tsi = parseFloat(tsi.replace(/,/g, ""));

            var sum = isNaN(pct * conv_tsi) ? 0 :(pct * conv_tsi).toFixed(2) ;
            console.log(sum)
            var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            $('#sliptotalsumpctupdate').val(real_sum);
            $('#sliptotalsumpctupdate2').val(real_sum);
        }
    });

   $('#slipdppercentageupdate').keyup(function (e) {
        if(e.keyCode != 9){
            var percent =  parseFloat($(this).val()) / 100;
            var tsi = $("#sliptotalsumupdate").val();
            var conv_tsi = parseFloat(tsi.replace(/,/g, ""));
            var sum = isNaN(percent * conv_tsi) ? 0 :(percent * conv_tsi).toFixed(2) ;
            var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            console.log($(this).val())
            console.log(percent)
            console.log(sum)
            console.log(real_sum)

            $('#slipdpamountupdate').val(real_sum);
            $('#slipdpamountupdate2').val(real_sum);
        }
    });

   $('#slipshareupdate').keyup(function (e) 
       {
        if(e.keyCode != 9){
            var shareslip =  parseFloat($(this).val()) / 100 ;
            var tsi = $("#sharetotalsumupdate").val();
            var conv_tsi = parseFloat(tsi.replace(/,/g, ""));
            var sumshare =isNaN( shareslip * conv_tsi) ? 0 :( shareslip * conv_tsi).toFixed(2) ;
            var real_sumshare = sumshare.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


            $('#slipsumshareupdate').val(real_sumshare);
            $('#slipsumshareupdate2').val(real_sumshare);
        }
    });


   $('#sliprateupdate').keyup(function (e) {
        if(e.keyCode != 9){
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
            var tsi = $("#sharetotalsumupdate").val();
            var conv_tsi = parseFloat(tsi.replace(/,/g, ""));
            var totalrateexc = $('#sliptotalnilaiecupdate').val();
            var basic_premi = $('#slipbasicpremiumupdate').val();

            if(totalrateexc){
                    var conv_totalrateexc = parseFloat(totalrateexc);
                    var sumtotalrate = isNaN(rateslip + parseFloat(conv_totalrateexc)) ? 0 :(rateslip + parseFloat(conv_totalrateexc)).toFixed(3);
                    var real_sumtotalrate = sumtotalrate.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    $('#sliptotalrateupdate').val(real_sumtotalrate);
                    $('#sliptotalrateupdate2').val(real_sumtotalrate);

                    var sumrate = $("#sliptotalrateupdate").val();
                    var conv_sumrate = parseFloat(sumrate.replace(/,/g, ""));
                    var sum = isNaN(((conv_sumrate / 1000) * conv_tsi) * insurance) ? 0 :(((conv_sumrate / 1000) * conv_tsi) * insurance).toFixed(2) ;
                    var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                    $('#slipbasicpremiumupdate').val(real_sum);


                }else{
                     var conv_totalrateexc = parseFloat(totalrateexc);
                     var sumtotalrate = isNaN(parseFloat(0) + rateslip) ? 0 :(parseFloat(0) + rateslip).toFixed(3);
                     var real_sumtotalrate = sumtotalrate.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                     $('#sliptotalrateupdate').val(real_sumtotalrate);
                     $('#sliptotalrateupdate2').val(real_sumtotalrate);

                    var sumrate = $("#sliptotalrateupdate").val();
                    var conv_sumrate = parseFloat(sumrate.replace(/,/g, ""));
                    var sum = isNaN(((conv_sumrate / 1000) * conv_tsi) * insurance) ? 0 :(((conv_sumrate / 1000) * conv_tsi) * insurance).toFixed(2) ;
                    var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                    $('#slipbasicpremiumupdate').val(real_sum);


                }

            if(basic_premi){
                var bpinsurance_period_from2 = $('#sliprpfromupdate').val();
                var bpinsurance_period_to2 = $('#sliprptoupdate').val();
                var bpnewinsurance_period_from2 = bpinsurance_period_from2.split("/").reverse().join("-");
                var bpnewinsurance_period_to2 = bpinsurance_period_to2.split("/").reverse().join("-");
                var bpdays=daysBetween(bpnewinsurance_period_from2, bpnewinsurance_period_to2);
                var bpinsurance = (bpdays/365);
                
                console.log(bpinsurance_period_from2)
                console.log(bpinsurance_period_to2)
                console.log(bpnewinsurance_period_from2)
                console.log(bpnewinsurance_period_to2)
                console.log(bpdays)
                console.log(bpinsurance)

                var bprateslip =  parseFloat($(this).val());
                var bpsumrate = $("#sliptotalrateupdate").val();
                var bpconv_sumrate = parseFloat(bpsumrate.replace(/,/g, ""));
                var bptsi = $("#sharetotalsumupdate").val();
                var bpconv_tsi = parseFloat(bptsi.replace(/,/g, ""));
                var bpsum = isNaN(((bpconv_sumrate / 1000) * bpconv_tsi) * bpinsurance) ? 0 :(((bpconv_sumrate / 1000) * bpconv_tsi) * bpinsurance).toFixed(2) ;
                var bpreal_sum = bpsum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                $('#slipbasicpremiumupdate').val(bpreal_sum);

                var share = $('#slipshareupdate').val();
                if(share){
                    var shareslip =  parseFloat(share) / 100 ;
                    var nasionalreinsurance =  $('#mpsharefrom').val();
                    var totalnre =  $('#mpshareto').val();
                    var conv_totalnre =  parseFloat(totalnre.replace(/,/g, ""));

                    console.log('nre' + nasionalreinsurance)
                        // console.log(conv_nasionalreinsurance)
                    console.log('totalnre' + totalnre)
                    console.log('convtotnre' + conv_totalnre)
                    

                    var sumshare = $('#slipsumshareupdate').val() ;
                    var conv_sumshare = parseFloat(sumshare.replace(/,/g, ""));

                    
                    var conv_basre = parseFloat(basic_premi.replace(/,/g, ""));

                    var orpercent = $('#sliporupdate').val() / 100;

                    var sumor = isNaN(orpercent * conv_sumshare) ? 0 :(orpercent * conv_sumshare).toFixed(2);
                    var real_sumor = sumor.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    
                    var sumgprmtonr = isNaN(conv_basre * shareslip ) ? 0 :(conv_basre * shareslip ).toFixed(2);
                    var real_sumgprmtonr= sumgprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    
                    if(nasionalreinsurance){
                        var conv_nasionalreinsurance =  parseFloat(nasionalreinsurance.replace(/,/g, ""));
                        var sumnre = isNaN(conv_nasionalreinsurance + conv_sumshare ) ? 0 :(conv_nasionalreinsurance + conv_sumshare).toFixed(2) ;
                        var real_sumnre = sumnre.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    }else{
                        var conv_nasionalreinsurance =  parseFloat(nasionalreinsurance.replace(/,/g, ""));
                        var sumnre = isNaN(0 + conv_sumshare ) ? 0 :(0 + conv_sumshare).toFixed(2) ;
                        var real_sumnre = sumnre.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    }
                    
                    
                    var sumourshare = isNaN((sumnre / conv_totalnre) * 100 ) ? 0 :((sumnre / conv_totalnre) * 100 ).toFixed(2) ;

                    console.log('sumnre' + sumnre)
                    console.log('realnre' + real_sumnre)
                    console.log('sumourshare' + sumourshare)

                    $('#slipgrossprmtonrupdate').val(real_sumgprmtonr);
                    $('#slipgrossprmtonrupdate2').val(real_sumgprmtonr);
                    $('#slipsumorupdate').val(real_sumor);
                    $('#slipsumorupdate2').val(real_sumor);
                    // $('#mpshare').val(sumourshare.replace(/,/g, "."));
                    $('#mpsharefrom').val(real_sumnre);

                    var slipsumcommissionval = $('#slipsumcommissionupdate').val();
                    if(slipsumcommissionval != null){
                        var commision =  parseFloat($('#slipcommissionupdate').val()) / 100;
                        var feebroker = parseFloat($('#slipvbrokeupdater').val()) / 100;
                        var sumgrossprmtonr = $("#slipgrossprmtonrupdate").val();
                        var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr.replace(/,/g, ""));

                        var sumcomm = isNaN(commision * conv_sumgrossprmtonr) ? 0 :(commision * conv_sumgrossprmtonr).toFixed(2);
                        var real_sumcomm = sumcomm.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                        $('#slipsumcommissionupdate').val(real_sumcomm);
                        $('#slipsumcommissionupdate2').val(real_sumcomm);

                        var netprm_to_nr = $('#slipnetprmtonrupdate').val();
                        if(netprm_to_nr != null){


                            var sumnetprmtonr = isNaN( conv_sumgrossprmtonr * (100/100 - commision - feebroker)) ? 0 :(conv_sumgrossprmtonr * (100/100 - commision - feebroker)).toFixed(2);
                            var real_sumnetprmtonr = sumnetprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                            var sumfeebroker = isNaN( conv_sumgrossprmtonr * feebroker) ? 0 :(conv_sumgrossprmtonr * feebroker).toFixed(2);
                            var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


                            $('#slipnetprmtonrupdate').val(real_sumnetprmtonr);
                            $('#slipnetprmtonrupdate2').val(real_sumnetprmtonr);
                            // $('#slipsumfee').val("100" + "-" + commision.toString() + "-" + feebroker.toString() + "*" + conv_sumgrossprmtonr.toString());
                            $('#slipsumfeeupdate').val(real_sumfeebroker);
                            $('#slipsumfeeupdate2').val(real_sumfeebroker);

                            var retro_backup = $('#sliprbupdate').val();
                            if(retro_backup == 'YES'){
                                swal('warning!','please change retrocession amount manually','success')
                            }

                        }

                    }
                }


            }
            
        }else{
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
            var tsi = $("#sharetotalsumupdate").val();
            var conv_tsi = parseFloat(tsi.replace(/,/g, ""));
            var totalrateexc = $('#sliptotalnilaiecupdate').val();
            var basic_premi = $('#slipbasicpremiumupdate').val();

            if(totalrateexc){
                    var conv_totalrateexc = parseFloat(totalrateexc);
                    var sumtotalrate = isNaN(rateslip + parseFloat(conv_totalrateexc)) ? 0 :(rateslip  + parseFloat(conv_totalrateexc)).toFixed(3);
                    var real_sumtotalrate = sumtotalrate.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    console.log('sliptotalrate' + sumtotalrate)
                    console.log('sliptotalrate' + real_sumtotalrate)
                    $('#sliptotalrateupdate').val(real_sumtotalrate);
                    $('#sliptotalrateupdate2').val(real_sumtotalrate);

                    var sumrate = $("#sliptotalrateupdate").val();
                    var conv_sumrate = parseFloat(sumrate.replace(/,/g, ""));
                    var sum = isNaN(((conv_sumrate / 1000) * conv_tsi) * insurance) ? 0 :(((conv_sumrate / 1000) * conv_tsi) * insurance).toFixed(2) ;
                    var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    console.log('conv_sumrate' + sum)
                    console.log('real_sum' + real_sum)
                    $('#slipbasicpremiumupdate').val(real_sum);



                }else{
                     var conv_totalrateexc = parseFloat(totalrateexc);
                     var sumtotalrate = isNaN(parseFloat(0) + rateslip) ? 0 :(parseFloat(0) + rateslip).toFixed(3);
                     var real_sumtotalrate = sumtotalrate.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                     console.log('sliptotalrate' + sumtotalrate)
                    console.log('sliptotalrate' + real_sumtotalrate)
                     $('#sliptotalrateupdate').val(real_sumtotalrate);
                     $('#sliptotalrateupdate2').val(real_sumtotalrate);

                    var sumrate = $("#sliptotalrateupdate").val();
                    var conv_sumrate = parseFloat(sumrate.replace(/,/g, ""));
                    var sum = isNaN(((conv_sumrate / 1000) * conv_tsi) * insurance) ? 0 :(((conv_sumrate / 1000) * conv_tsi) * insurance).toFixed(2) ;
                    var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    console.log('conv_sumrate' + sum)
                    console.log('real_sum' + real_sum)

                    $('#slipbasicpremiumupdate').val(real_sum);
                }

            if(basic_premi){
                var bpinsurance_period_from2 = $('#sliprpfromupdate').val();
                var bpinsurance_period_to2 = $('#sliprptoupdate').val();
                var bpnewinsurance_period_from2 = bpinsurance_period_from2.split("/").reverse().join("-");
                var bpnewinsurance_period_to2 = bpinsurance_period_to2.split("/").reverse().join("-");
                var bpdays=daysBetween(bpnewinsurance_period_from2, bpnewinsurance_period_to2);
                var bpinsurance = (bpdays/365);
                
                console.log(bpinsurance_period_from2)
                console.log(bpinsurance_period_to2)
                console.log(bpnewinsurance_period_from2)
                console.log(bpnewinsurance_period_to2)
                console.log(bpdays)
                console.log(bpinsurance)

                var bprateslip =  parseFloat($('#sliprateupdate').val());
                var bpsumrate = $("#sliptotalrateupdate").val();
                var bpconv_sumrate = parseFloat(bpsumrate.replace(/,/g, ""));
                var bptsi = $("#sharetotalsumupdate").val();
                var bpconv_tsi = parseFloat(bptsi.replace(/,/g, ""));
                var bpsum = isNaN(((bpconv_sumrate / 1000) * bpconv_tsi) * bpinsurance) ? 0 :(((bpconv_sumrate / 1000) * bpconv_tsi) * bpinsurance).toFixed(2) ;
                var bpreal_sum = bpsum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                $('#slipbasicpremiumupdate').val(bpreal_sum);

                var share = $('#slipshareupdate').val();
                if(share){
                    var shareslip =  parseFloat(share) / 100 ;
                    var nasionalreinsurance =  $('#mpsharefrom').val();
                    var totalnre =  $('#mpshareto').val();
                    var conv_totalnre =  parseFloat(totalnre.replace(/,/g, ""));

                    console.log('nre' + nasionalreinsurance)
                        // console.log(conv_nasionalreinsurance)
                    console.log('totalnre' + totalnre)
                    console.log('convtotnre' + conv_totalnre)
                    

                    var sumshare = $('#slipsumshareupdate').val() ;
                    var conv_sumshare = parseFloat(sumshare.replace(/,/g, ""));

                    
                    var conv_basre = parseFloat(basic_premi.replace(/,/g, ""));

                    var orpercent = $('#sliporupdate').val() / 100;

                    var sumor = isNaN(orpercent * conv_sumshare) ? 0 :(orpercent * conv_sumshare).toFixed(2);
                    var real_sumor = sumor.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    
                    var sumgprmtonr = isNaN(conv_basre * shareslip ) ? 0 :(conv_basre * shareslip ).toFixed(2);
                    var real_sumgprmtonr= sumgprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    
                    if(nasionalreinsurance){
                        var conv_nasionalreinsurance =  parseFloat(nasionalreinsurance.replace(/,/g, ""));
                        var sumnre = isNaN(conv_nasionalreinsurance + conv_sumshare ) ? 0 :(conv_nasionalreinsurance + conv_sumshare).toFixed(2) ;
                        var real_sumnre = sumnre.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    }else{
                        var conv_nasionalreinsurance =  parseFloat(nasionalreinsurance.replace(/,/g, ""));
                        var sumnre = isNaN(0 + conv_sumshare ) ? 0 :(0 + conv_sumshare).toFixed(2) ;
                        var real_sumnre = sumnre.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    }
                    
                    
                    var sumourshare = isNaN((sumnre / conv_totalnre) * 100 ) ? 0 :((sumnre / conv_totalnre) * 100 ).toFixed(2) ;

                    console.log('sumnre' + sumnre)
                    console.log('realnre' + real_sumnre)
                    console.log('sumourshare' + sumourshare)

                    $('#slipgrossprmtonrupdate').val(real_sumgprmtonr);
                    $('#slipgrossprmtonrupdate2').val(real_sumgprmtonr);
                    $('#slipsumorupdate').val(real_sumor);
                    $('#slipsumorupdate2').val(real_sumor);
                    // $('#mpshare').val(sumourshare.replace(/,/g, "."));
                    $('#mpsharefrom').val(real_sumnre);

                    var slipsumcommissionval = $('#slipsumcommissionupdate').val();
                    if(slipsumcommissionval != null){
                        var commision =  parseFloat($('#slipcommissionupdate').val()) / 100;
                        var feebroker = parseFloat($('#slipvbrokeupdater').val()) / 100;
                        var sumgrossprmtonr = $("#slipgrossprmtonrupdate").val();
                        var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr.replace(/,/g, ""));

                        var sumcomm = isNaN(commision * conv_sumgrossprmtonr) ? 0 :(commision * conv_sumgrossprmtonr).toFixed(2);
                        var real_sumcomm = sumcomm.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                        $('#slipsumcommissionupdate').val(real_sumcomm);
                        $('#slipsumcommissionupdate2').val(real_sumcomm);

                        var netprm_to_nr = $('#slipnetprmtonrupdate').val();
                        if(netprm_to_nr != null){


                            var sumnetprmtonr = isNaN( conv_sumgrossprmtonr * (100/100 - commision - feebroker)) ? 0 :(conv_sumgrossprmtonr * (100/100 - commision - feebroker)).toFixed(2);
                            var real_sumnetprmtonr = sumnetprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                            var sumfeebroker = isNaN( conv_sumgrossprmtonr * feebroker) ? 0 :(conv_sumgrossprmtonr * feebroker).toFixed(2);
                            var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


                            $('#slipnetprmtonrupdate').val(real_sumnetprmtonr);
                            $('#slipnetprmtonrupdate2').val(real_sumnetprmtonr);
                            // $('#slipsumfee').val("100" + "-" + commision.toString() + "-" + feebroker.toString() + "*" + conv_sumgrossprmtonr.toString());
                            $('#slipsumfeeupdate').val(real_sumfeebroker);
                            $('#slipsumfeeupdate2').val(real_sumfeebroker);

                            var retro_backup = $('#sliprbupdate').val();
                            if(retro_backup == 'YES'){
                                swal('warning!','please change retrocession amount manually','success')
                            }

                        }

                    }
                }


            }
        }
    });



   $('#sliprateupdate').change(function(){
        var rate_lower = $('#slipbclaupdate').val();
        var rate_upper = $('#slipbcuaupdate').val();
        var rate = $('#sliprateupdate').val();
        

        if(rate_upper != '' || rate_lower != ''){
            var rate_lower_val = parseFloat(rate_lower);
            var rate_upper_val = parseFloat(rate_upper);
            var rate_val = parseFloat(rate);
            console.log(rate_lower_val)
            console.log(rate_upper_val)
            console.log(rate_val)
            if(rate_val < rate_lower_val || rate_val > rate_upper_val ){
                swal('warning','please input rate between rate lower and rate upper building','input error')
            }
            

        }else{
            swal('warning','please choose building const first','error')
        }
   });

   $("#slipbasicpremiumupdate").keydown(function(e) { 
    var keyCode = e.keyCode || e.which; 

      if (keyCode == 9) { 
        // e.preventDefault(); 

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

        var rateslip =  parseFloat($('#sliprateupdate').val());
        var sumrate = $("#sliptotalrateupdate").val();
        var conv_sumrate = parseFloat(sumrate.replace(/,/g, ""));
        var tsi = $("#sharetotalsumupdate").val();
        var conv_tsi = parseFloat(tsi.replace(/,/g, ""));
        var sum = isNaN(((conv_sumrate / 1000) * conv_tsi) * insurance) ? 0 :(((conv_sumrate / 1000) * conv_tsi) * insurance).toFixed(2) ;
        var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

        $('#slipbasicpremiumupdate').val(real_sum);
        // call custom function here
      } 
    });

   $("#slipbasicpremiumupdate").keyup(function(e) { 
    var keyCode = e.keyCode || e.which; 

      if (keyCode == 9) { 
        // e.preventDefault(); 
        // call custom function here
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

        var rateslip =  parseFloat($('#sliprateupdate').val());
        var sumrate = $("#sliptotalrateupdate").val();
        var conv_sumrate = parseFloat(sumrate.replace(/,/g, ""));
        var tsi = $("#sharetotalsumupdate").val();
        var conv_tsi = parseFloat(tsi.replace(/,/g, ""));
        var sum = isNaN(((conv_sumrate / 1000) * conv_tsi) * insurance) ? 0 :(((conv_sumrate / 1000) * conv_tsi) * insurance).toFixed(2) ;
        var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

        $('#slipbasicpremiumupdate').val(real_sum);
      } 
    });

   $("#slipbasicpremiumupdate").keypress(function(e) { 
    var keyCode = e.keyCode || e.which; 

      if (keyCode == 9) { 
        // e.preventDefault(); 
        // call custom function here
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

        var rateslip =  parseFloat($('#sliprateupdate').val());
        var sumrate = $("#sliptotalrateupdate").val();
        var conv_sumrate = parseFloat(sumrate.replace(/,/g, ""));
        var tsi = $("#sharetotalsumupdate").val();
        var conv_tsi = parseFloat(tsi.replace(/,/g, ""));
        var sum = isNaN(((conv_sumrate / 1000) * conv_tsi) * insurance) ? 0 :(((conv_sumrate / 1000) * conv_tsi) * insurance).toFixed(2) ;
        var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

        $('#slipbasicpremiumupdate').val(real_sum);
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
                var rateslip =  parseFloat($('#sliprateupdate').val()) ;
                var shareslip =  parseFloat($('#slipshareupdate').val()) / 100 ;
                var nasionalreinsurance =  $('#mpsharefrom').val();
                var totalnre =  $('#mpshareto').val();
                var conv_totalnre =  parseFloat(totalnre.replace(/,/g, ""));

                console.log('nre' + nasionalreinsurance)
                    // console.log(conv_nasionalreinsurance)
                console.log('totalnre' + totalnre)
                console.log('convtotnre' + conv_totalnre)
                
                var tsi = $("#sharetotalsumupdate").val();
                var conv_tsi = parseFloat(tsi.replace(/,/g, ""));

                var sumshare = $('#slipsumshareupdate').val() ;
                var conv_sumshare = parseFloat(sumshare.replace(/,/g, ""));

                var basic_premium = $('#slipbasicpremiumupdate').val();
                var conv_basre = parseFloat(basic_premium.replace(/,/g, ""));

                var orpercent = $('#sliporupdate').val() / 100;

                var sumor = isNaN(orpercent * conv_sumshare) ? 0 :(orpercent * conv_sumshare).toFixed(2);
                var real_sumor = sumor.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                
                var sum = isNaN(conv_basre * shareslip ) ? 0 :(conv_basre * shareslip ).toFixed(2);
                var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                
                if(nasionalreinsurance){
                    var conv_nasionalreinsurance =  parseFloat(nasionalreinsurance.replace(/,/g, ""));
                    var sumnre = isNaN(conv_nasionalreinsurance + conv_sumshare ) ? 0 :(conv_nasionalreinsurance + conv_sumshare).toFixed(2) ;
                    var real_sumnre = sumnre.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                }else{
                    var conv_nasionalreinsurance =  parseFloat(nasionalreinsurance.replace(/,/g, ""));
                    var sumnre = isNaN(0 + conv_sumshare ) ? 0 :(0 + conv_sumshare).toFixed(2) ;
                    var real_sumnre = sumnre.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                }
                
                
                var sumourshare = isNaN((sumnre / conv_totalnre) * 100 ) ? 0 :((sumnre / conv_totalnre) * 100 ).toFixed(2) ;

                console.log('sumnre' + sumnre)
                console.log('realnre' + real_sumnre)
                console.log('sumourshare' + sumourshare)

                $('#slipgrossprmtonrupdate').val(real_sum);
                $('#slipgrossprmtonrupdate2').val(real_sum);
                $('#slipsumorupdate').val(real_sumor);
                $('#slipsumorupdate2').val(real_sumor);
                // $('#mpshare').val(sumourshare.replace(/,/g, "."));
                $('#mpsharefromupdate').val(real_sumnre);

                var slipsumcommissionval = $('#slipsumcommissionupdate').val();

                if(slipsumcommissionval != null){
                    var commision =  parseFloat($('#slipcommissionupdate').val()) / 100;
                    var feebroker = parseFloat($('#slipvbrokerupdate').val()) / 100;
                    var sumgrossprmtonr = $("#slipgrossprmtonrupdate").val();
                    var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr.replace(/,/g, ""));

                    var sumcomm = isNaN(commision * conv_sumgrossprmtonr) ? 0 :(commision * conv_sumgrossprmtonr).toFixed(2);
                    var real_sumcomm = sumcomm.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                    $('#slipsumcommissionupdate').val(real_sumcomm);
                    $('#slipsumcommissionupdate2').val(real_sumcomm);

                    var netprm_to_nr = $('#slipnetprmtonrupdate').val();
                    if(netprm_to_nr != null){


                        var sumnetprmtonr = isNaN( conv_sumgrossprmtonr * (100/100 - commision - feebroker)) ? 0 :(conv_sumgrossprmtonr * (100/100 - commision - feebroker)).toFixed(2);
                        var real_sumnetprmtonr = sumnetprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                        var sumfeebroker = isNaN( conv_sumgrossprmtonr * feebroker) ? 0 :(conv_sumgrossprmtonr * feebroker).toFixed(2);
                        var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


                        $('#slipnetprmtonrupdate').val(real_sumnetprmtonr);
                        $('#slipnetprmtonrupdate2').val(real_sumnetprmtonr);
                        // $('#slipsumfee').val("100" + "-" + commision.toString() + "-" + feebroker.toString() + "*" + conv_sumgrossprmtonr.toString());
                        $('#slipsumfeeupdate').val(real_sumfeebroker);
                        $('#slipsumfeeupdate2').val(real_sumfeebroker);

                        var retro_backup = $('#sliprbupdate').val();
                        if(retro_backup == 'YES'){
                            swal('warning!','please change retrocession amount manually','success')
                        }

                    }

                }
            }
        }
    });

   

    $('#slipcommissionupdate').keyup(function (e) {
        var keyCode = e.keyCode || e.which;

        if (keyCode != 9){
            var commision =  parseFloat($(this).val()) / 100;
            var feebroker = parseFloat($('#slipvbrokerupdate').val()) / 100;
            var sumgrossprmtonr = $("#slipgrossprmtonrupdate").val();
            var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr.replace(/,/g, ""));

            var sum = isNaN(commision * conv_sumgrossprmtonr) ? 0 :(commision * conv_sumgrossprmtonr).toFixed(2);
            var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipsumcommissionupdate').val(real_sum);
            $('#slipsumcommissionupdate2').val(real_sum);

            if(feebroker != null){
                var netprm_to_nr = $('#slipnetprmtonrupdate').val();
                
                var sumnetprmtonr = isNaN( conv_sumgrossprmtonr * (100/100 - commision - feebroker)) ? 0 :(conv_sumgrossprmtonr * (100/100 - commision - feebroker)).toFixed(2);
                var real_sumnetprmtonr = sumnetprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                var sumfeebroker = isNaN( conv_sumgrossprmtonr * feebroker) ? 0 :(conv_sumgrossprmtonr * feebroker).toFixed(2);
                var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


                $('#slipnetprmtonrupdate').val(real_sumnetprmtonr);
                $('#slipnetprmtonrupdate2').val(real_sumnetprmtonr);
                // $('#slipsumfee').val("100" + "-" + commision.toString() + "-" + feebroker.toString() + "*" + conv_sumgrossprmtonr.toString());
                $('#slipsumfeeupdate').val(real_sumfeebroker);
                $('#slipsumfeeupdate2').val(real_sumfeebroker);
            }
        }else{
            var commision =  parseFloat($(this).val()) / 100;
            var feebroker = parseFloat($('#slipvbrokerupdate').val()) / 100;
            var sumgrossprmtonr = $("#slipgrossprmtonrupdate").val();
            var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr.replace(/,/g, ""));

            var sum = isNaN(commision * conv_sumgrossprmtonr) ? 0 :(commision * conv_sumgrossprmtonr).toFixed(2);
            var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipsumcommissionupdate').val(real_sum);
            $('#slipsumcommissionupdate2').val(real_sum);

            if(feebroker != null){
                var netprm_to_nr = $('#slipnetprmtonrupdate').val();
                
                var sumnetprmtonr = isNaN( conv_sumgrossprmtonr * (100/100 - commision - feebroker)) ? 0 :(conv_sumgrossprmtonr * (100/100 - commision - feebroker)).toFixed(2);
                var real_sumnetprmtonr = sumnetprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                var sumfeebroker = isNaN( conv_sumgrossprmtonr * feebroker) ? 0 :(conv_sumgrossprmtonr * feebroker).toFixed(2);
                var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


                $('#slipnetprmtonrupdate').val(real_sumnetprmtonr);
                $('#slipnetprmtonrupdate2').val(real_sumnetprmtonr);
                // $('#slipsumfee').val("100" + "-" + commision.toString() + "-" + feebroker.toString() + "*" + conv_sumgrossprmtonr.toString());
                $('#slipsumfeeupdate').val(real_sumfeebroker);
                $('#slipsumfeeupdate2').val(real_sumfeebroker);
            }
        }

    });

   $('#slipcommissionupdate').keydown(function (e) {
        var keyCode = e.keyCode || e.which;

        if (keyCode != 9){
            var commision =  parseFloat($(this).val()) / 100;
            var feebroker = parseFloat($('#slipvbrokerupdate').val()) / 100;
            var sumgrossprmtonr = $("#slipgrossprmtonrupdate").val();
            var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr.replace(/,/g, ""));

            var sum = isNaN(commision * conv_sumgrossprmtonr) ? 0 :(commision * conv_sumgrossprmtonr).toFixed(2);
            var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipsumcommissionupdate').val(real_sum);
            $('#slipsumcommissionupdate2').val(real_sum);

            if(feebroker != null){
                var netprm_to_nr = $('#slipnetprmtonrupdate').val();
                
                var sumnetprmtonr = isNaN( conv_sumgrossprmtonr * (100/100 - commision - feebroker)) ? 0 :(conv_sumgrossprmtonr * (100/100 - commision - feebroker)).toFixed(2);
                var real_sumnetprmtonr = sumnetprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                var sumfeebroker = isNaN( conv_sumgrossprmtonr * feebroker) ? 0 :(conv_sumgrossprmtonr * feebroker).toFixed(2);
                var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


                $('#slipnetprmtonrupdate').val(real_sumnetprmtonr);
                $('#slipnetprmtonrupdate2').val(real_sumnetprmtonr);
                // $('#slipsumfee').val("100" + "-" + commision.toString() + "-" + feebroker.toString() + "*" + conv_sumgrossprmtonr.toString());
                $('#slipsumfeeupdate').val(real_sumfeebroker);
                $('#slipsumfeeupdate2').val(real_sumfeebroker);
            }
        }else{
            var commision =  parseFloat($(this).val()) / 100;
            var feebroker = parseFloat($('#slipvbrokerupdate').val()) / 100;
            var sumgrossprmtonr = $("#slipgrossprmtonrupdate").val();
            var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr.replace(/,/g, ""));

            var sum = isNaN(commision * conv_sumgrossprmtonr) ? 0 :(commision * conv_sumgrossprmtonr).toFixed(2);
            var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipsumcommissionupdate').val(real_sum);
            $('#slipsumcommissionupdate2').val(real_sum);

            if(feebroker != null){
                var netprm_to_nr = $('#slipnetprmtonrupdate').val();
                
                var sumnetprmtonr = isNaN( conv_sumgrossprmtonr * (100/100 - commision - feebroker)) ? 0 :(conv_sumgrossprmtonr * (100/100 - commision - feebroker)).toFixed(2);
                var real_sumnetprmtonr = sumnetprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                var sumfeebroker = isNaN( conv_sumgrossprmtonr * feebroker) ? 0 :(conv_sumgrossprmtonr * feebroker).toFixed(2);
                var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


                $('#slipnetprmtonrupdate').val(real_sumnetprmtonr);
                $('#slipnetprmtonrupdate2').val(real_sumnetprmtonr);
                // $('#slipsumfee').val("100" + "-" + commision.toString() + "-" + feebroker.toString() + "*" + conv_sumgrossprmtonr.toString());
                $('#slipsumfeeupdate').val(real_sumfeebroker);
                $('#slipsumfeeupdate').val(real_sumfeebroker);
            }
        }

    });

   $('#slipcommissionupdate').keypress(function (e) {
        var keyCode = e.keyCode || e.which;

        if (keyCode != 9){
            var commision =  parseFloat($(this).val()) / 100;
            var feebroker = parseFloat($('#slipvbroker').val()) / 100;
            var sumgrossprmtonr = $("#slipgrossprmtonr").val();
            var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr.replace(/,/g, ""));

            var sum = isNaN(commision * conv_sumgrossprmtonr) ? 0 :(commision * conv_sumgrossprmtonr).toFixed(2);
            var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipsumcommissionupdate').val(real_sum);
            $('#slipsumcommissionupdate2').val(real_sum);

            if(feebroker != null){
                var netprm_to_nr = $('#slipnetprmtonrupdate').val();
                
                var sumnetprmtonr = isNaN( conv_sumgrossprmtonr * (100/100 - commision - feebroker)) ? 0 :(conv_sumgrossprmtonr * (100/100 - commision - feebroker)).toFixed(2);
                var real_sumnetprmtonr = sumnetprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                var sumfeebroker = isNaN( conv_sumgrossprmtonr * feebroker) ? 0 :(conv_sumgrossprmtonr * feebroker).toFixed(2);
                var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


                $('#slipnetprmtonrupdate').val(real_sumnetprmtonr);
                $('#slipnetprmtonrupdate2').val(real_sumnetprmtonr);
                // $('#slipsumfee').val("100" + "-" + commision.toString() + "-" + feebroker.toString() + "*" + conv_sumgrossprmtonr.toString());
                $('#slipsumfeeupdate').val(real_sumfeebroker);
                $('#slipsumfeeupdate2').val(real_sumfeebroker);
            }
        }else{
            var commision =  parseFloat($(this).val()) / 100;
            var feebroker = parseFloat($('#slipvbrokerupdate').val()) / 100;
            var sumgrossprmtonr = $("#slipgrossprmtonrupdate").val();
            var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr.replace(/,/g, ""));

            var sum = isNaN(commision * conv_sumgrossprmtonr) ? 0 :(commision * conv_sumgrossprmtonr).toFixed(2);
            var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipsumcommissionupdate').val(real_sum);
            $('#slipsumcommissionupdate2').val(real_sum);

            if(feebroker != null){
                var netprm_to_nr = $('#slipnetprmtonrupdate').val();
                
                var sumnetprmtonr = isNaN( conv_sumgrossprmtonr * (100/100 - commision - feebroker)) ? 0 :(conv_sumgrossprmtonr * (100/100 - commision - feebroker)).toFixed(2);
                var real_sumnetprmtonr = sumnetprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                var sumfeebroker = isNaN( conv_sumgrossprmtonr * feebroker) ? 0 :(conv_sumgrossprmtonr * feebroker).toFixed(2);
                var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


                $('#slipnetprmtonrupdate').val(real_sumnetprmtonr);
                $('#slipnetprmtonrupdate2').val(real_sumnetprmtonr);
                // $('#slipsumfee').val("100" + "-" + commision.toString() + "-" + feebroker.toString() + "*" + conv_sumgrossprmtonr.toString());
                $('#slipsumfeeupdate').val(real_sumfeebroker);
                $('#slipsumfeeupdate2').val(real_sumfeebroker);
            }
        }

    });

   $('#slipsumcommissionupdate2').keyup(function(e){
        var keyCode = e.keyCode || e.which; 

        if (keyCode != 9) {
            $('#slipsumcommissionupdate').val($(this).val());
            var sumcommision =  $('#slipsumcommissionupdate').val();
            var conv_sumcommision = parseFloat(sumcommision.replace(/,/g, ""));
            var commisionval =  $('#slipcommissionupdate').val();
            var feebroker = parseFloat($('#slipvbrokerupdate').val());
            var sumgrossprmtonr2 = $("#slipgrossprmtonrupdate").val();
            var conv_sumgrossprmtonr2 = parseFloat(sumgrossprmtonr2.replace(/,/g, ""));

            // if(commisionval != null){
                var sum = isNaN((conv_sumcommision / conv_sumgrossprmtonr2)*100) ? 0 :((conv_sumcommision / conv_sumgrossprmtonr2)*100).toFixed(2);
                var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                $('#slipcommissionupdate').val(real_sum);

                if(feebroker != null){
                var commision = parseFloat($('#slipcommissionupdate').val());
                var netprm_to_nr = $('#slipnetprmtonrupdate').val();
                
                var sumnetprmtonr = isNaN( conv_sumgrossprmtonr2 * ((100 - commision - feebroker)/100)) ? 0 :(conv_sumgrossprmtonr2* ((100 - commision - feebroker)/100)).toFixed(2);
                var real_sumnetprmtonr = sumnetprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                var sumfeebroker = isNaN( conv_sumgrossprmtonr2 * feebroker) ? 0 :(conv_sumgrossprmtonr2 * feebroker).toFixed(2);
                var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


                $('#slipnetprmtonrupdate').val(real_sumnetprmtonr);
                $('#slipnetprmtonrupdate2').val(real_sumnetprmtonr);
                // $('#slipsumfee').val("100" + "-" + commision.toString() + "-" + feebroker.toString() + "*" + conv_sumgrossprmtonr.toString());
                $('#slipsumfeeupdate').val(real_sumfeebroker);
                $('#slipsumfeeupdate2').val(real_sumfeebroker);
            }

            // }
        }else{
            var commision =  parseFloat($('#slipcommissionupdate').val()) / 100;
            var feebroker = parseFloat($('#slipvbrokerupdate').val()) / 100;
            var sumgrossprmtonr = $("#slipgrossprmtonrupdate").val();
            var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr.replace(/,/g, ""));

            var sum = isNaN(commision * conv_sumgrossprmtonr) ? 0 :(commision * conv_sumgrossprmtonr).toFixed(2);
            var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipsumcommissionupdate').val(real_sum);
            $('#slipsumcommissionupdate2').val(real_sum);
        }
   });

   $('#slipsumcommissionupdate2').keydown(function(e){
        var keyCode = e.keyCode || e.which; 

        if (keyCode != 9) {
            // $('#slipsumcommission').val($(this).val());
            // var sumcommision =  $('#slipsumcommission').val();
            // var conv_sumcommision = parseFloat(sumcommision.replace(/,/g, ""));
            // var commisionval =  $('#slipcommission').val();
            // var feebroker = parseFloat($('#slipvbroker').val()) / 100;
            // var sumgrossprmtonr2 = $("#slipgrossprmtonr").val();
            // var conv_sumgrossprmtonr2 = parseFloat(sumgrossprmtonr2.replace(/,/g, ""));

            // if(commisionval != null){
            //     var sum = isNaN((conv_sumcommision / conv_sumgrossprmtonr2)*100) ? 0 :((conv_sumcommision / conv_sumgrossprmtonr2)*100).toFixed(2);
            //     var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            //     $('#slipcommission').val(real_sum);

            // }
        }else{
            var commision =  parseFloat($('#slipcommissionupdate').val()) / 100;
            var feebroker = parseFloat($('#slipvbrokerupdate').val()) / 100;
            var sumgrossprmtonr = $("#slipgrossprmtonrupdate").val();
            var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr.replace(/,/g, ""));

            var sum = isNaN(commision * conv_sumgrossprmtonr) ? 0 :(commision * conv_sumgrossprmtonr).toFixed(2);
            var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipsumcommissionupdate').val(real_sum);
            $('#slipsumcommissionupdate2').val(real_sum);
        }
   });

   $('#slipsumcommissionupdate2').keypress(function(e){
        var keyCode = e.keyCode || e.which; 

        if (keyCode != 9) {
            // $('#slipsumcommission').val($(this).val());
            // var sumcommision =  $('#slipsumcommission').val();
            // var conv_sumcommision = parseFloat(sumcommision.replace(/,/g, ""));
            // var commisionval =  $('#slipcommission').val();
            // var feebroker = parseFloat($('#slipvbroker').val()) / 100;
            // var sumgrossprmtonr2 = $("#slipgrossprmtonr").val();
            // var conv_sumgrossprmtonr2 = parseFloat(sumgrossprmtonr2.replace(/,/g, ""));

            // if(commisionval != null){
            //     var sum = isNaN((conv_sumcommision / conv_sumgrossprmtonr2)*100) ? 0 :((conv_sumcommision / conv_sumgrossprmtonr2)*100).toFixed(2);
            //     var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            //     $('#slipcommission').val(real_sum);

            // }
        }else{
            var commision =  parseFloat($('#slipcommissionupdate').val()) / 100;
            var feebroker = parseFloat($('#slipvbrokerupdate').val()) / 100;
            var sumgrossprmtonr = $("#slipgrossprmtonrupdate").val();
            var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr.replace(/,/g, ""));

            var sum = isNaN(commision * conv_sumgrossprmtonr) ? 0 :(commision * conv_sumgrossprmtonr).toFixed(2);
            var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipsumcommissionupdate').val(real_sum);
            $('#slipsumcommissionupdate2').val(real_sum);
        }
   });




   $('#slipvbrokerupdate').keyup(function(e){
            var keyCode = e.keyCode || e.which; 

        if (keyCode != 9) {

            var netprm_to_nr = $('#slipnetprmtonrupdate').val();
        
            var feebroker = parseFloat($('#slipvbrokerupdate').val()) / 100;
            var commision =  parseFloat($('#slipcommissionupdate').val()) / 100;
            var sumgrossprmtonr = $("#slipgrossprmtonrupdate").val();
            var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr.replace(/,/g, ""));

            var sumfeebroker = isNaN( conv_sumgrossprmtonr * feebroker) ? 0 :(conv_sumgrossprmtonr * feebroker).toFixed(2);
            var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipsumfeeupdate').val(real_sumfeebroker);
            $('#slipsumfeeupdate2').val(real_sumfeebroker);

            var sumnetprmtonr = isNaN( conv_sumgrossprmtonr * (100/100 - commision - feebroker)) ? 0 :(conv_sumgrossprmtonr * (100/100 - commision - feebroker)).toFixed(2);
            var real_sumnetprmtonr = sumnetprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipnetprmtonrupdate').val(real_sumnetprmtonr);
            $('#slipnetprmtonrupdate2').val(real_sumnetprmtonr);

        }else{
            var netprm_to_nr = $('#slipnetprmtonrupdate').val();
        
            var feebroker = parseFloat($('#slipvbrokerupdate').val()) / 100;
            var commision =  parseFloat($('#slipcommissionupdate').val()) / 100;
            var sumgrossprmtonr = $("#slipgrossprmtonrupdate").val();
            var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr.replace(/,/g, ""));

            var sumfeebroker = isNaN( conv_sumgrossprmtonr * feebroker) ? 0 :(conv_sumgrossprmtonr * feebroker).toFixed(2);
            var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipsumfeeupdate').val(real_sumfeebroker);
            $('#slipsumfeeupdate2').val(real_sumfeebroker);

            var sumnetprmtonr = isNaN( conv_sumgrossprmtonr * (100/100 - commision - feebroker)) ? 0 :(conv_sumgrossprmtonr * (100/100 - commision - feebroker)).toFixed(2);
            var real_sumnetprmtonr = sumnetprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipnetprmtonrupdate').val(real_sumnetprmtonr);
            $('#slipnetprmtonrupdate2').val(real_sumnetprmtonr);
        }
    });

   $('#slipvbrokerupdate').keydown(function(e){
            var keyCode = e.keyCode || e.which; 

        if (keyCode != 9) {

            var netprm_to_nr = $('#slipnetprmtonrupdate').val();
        
            var feebroker = parseFloat($('#slipvbrokerupdate').val()) / 100;
            var commision =  parseFloat($('#slipcommissionupdate').val()) / 100;
            var sumgrossprmtonr = $("#slipgrossprmtonrupdate").val();
            var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr.replace(/,/g, ""));

            var sumfeebroker = isNaN( conv_sumgrossprmtonr * feebroker) ? 0 :(conv_sumgrossprmtonr * feebroker).toFixed(2);
            var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipsumfeeupdate').val(real_sumfeebroker);
            $('#slipsumfeeupdate2').val(real_sumfeebroker);

            var sumnetprmtonr = isNaN( conv_sumgrossprmtonr * (100/100 - commision - feebroker)) ? 0 :(conv_sumgrossprmtonr * (100/100 - commision - feebroker)).toFixed(2);
            var real_sumnetprmtonr = sumnetprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipnetprmtonrupdate').val(real_sumnetprmtonr);
            $('#slipnetprmtonrupdate2').val(real_sumnetprmtonr);

        }else{
            var netprm_to_nr = $('#slipnetprmtonrupdate').val();
        
            var feebroker = parseFloat($('#slipvbrokerupdate').val()) / 100;
            var commision =  parseFloat($('#slipcommissionupdate').val()) / 100;
            var sumgrossprmtonr = $("#slipgrossprmtonrupdate").val();
            var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr.replace(/,/g, ""));

            var sumfeebroker = isNaN( conv_sumgrossprmtonr * feebroker) ? 0 :(conv_sumgrossprmtonr * feebroker).toFixed(2);
            var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipsumfeeupdate').val(real_sumfeebroker);
            $('#slipsumfeeupdate2').val(real_sumfeebroker);

            var sumnetprmtonr = isNaN( conv_sumgrossprmtonr * (100/100 - commision - feebroker)) ? 0 :(conv_sumgrossprmtonr * (100/100 - commision - feebroker)).toFixed(2);
            var real_sumnetprmtonr = sumnetprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipnetprmtonrupdate').val(real_sumnetprmtonr);
            $('#slipnetprmtonrupdate2').val(real_sumnetprmtonr);
        }
    });

   $('#slipvbrokerupdate').keypress(function(e){
            var keyCode = e.keyCode || e.which; 

        if (keyCode != 9) {

            var netprm_to_nr = $('#slipnetprmtonrupdate').val();
        
            var feebroker = parseFloat($('#slipvbrokerupdate').val()) / 100;
            var commision =  parseFloat($('#slipcommissionupdate').val()) / 100;
            var sumgrossprmtonr = $("#slipgrossprmtonrupdate").val();
            var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr.replace(/,/g, ""));

            var sumfeebroker = isNaN( conv_sumgrossprmtonr * feebroker) ? 0 :(conv_sumgrossprmtonr * feebroker).toFixed(2);
            var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipsumfeeupdate').val(real_sumfeebroker);
            $('#slipsumfeeupdate2').val(real_sumfeebroker);

            var sumnetprmtonr = isNaN( conv_sumgrossprmtonr * (100/100 - commision - feebroker)) ? 0 :(conv_sumgrossprmtonr * (100/100 - commision - feebroker)).toFixed(2);
            var real_sumnetprmtonr = sumnetprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipnetprmtonrupdate').val(real_sumnetprmtonr);
            $('#slipnetprmtonrupdate2').val(real_sumnetprmtonr);

        }else{
            var netprm_to_nr = $('#slipnetprmtonrupdate').val();
        
            var feebroker = parseFloat($('#slipvbrokerupdate').val()) / 100;
            var commision =  parseFloat($('#slipcommissionupdate').val()) / 100;
            var sumgrossprmtonr = $("#slipgrossprmtonrupdate").val();
            var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr.replace(/,/g, ""));

            var sumfeebroker = isNaN( conv_sumgrossprmtonr * feebroker) ? 0 :(conv_sumgrossprmtonr * feebroker).toFixed(2);
            var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipsumfeeupdate').val(real_sumfeebroker);
            $('#slipsumfeeupdate2').val(real_sumfeebroker);

            var sumnetprmtonr = isNaN( conv_sumgrossprmtonr * (100/100 - commision - feebroker)) ? 0 :(conv_sumgrossprmtonr * (100/100 - commision - feebroker)).toFixed(2);
            var real_sumnetprmtonr = sumnetprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipnetprmtonrupdate').val(real_sumnetprmtonr);
            $('#slipnetprmtonrupdate2').val(real_sumnetprmtonr);
        }
    });
 

   $('#slipsumfeeupdate2').keyup(function(e){
        var keyCode = e.keyCode || e.which; 

        if (keyCode != 9) {
            var netprm_to_nr = $('#slipnetprmtonrupdate').val();
            $('#slipsumfeeupdate').val($(this).val());
            
            var commision =  parseFloat($('#slipcommissionupdate').val());
            var sumgrossprmtonr = $("#slipgrossprmtonrupdate").val();
            var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr.replace(/,/g, ""));
            var netprm_to_nr = $('#slipnetprmtonrupdate').val();
            var sumfeebroker2 = $('#slipsumfeeupdate').val();
            var conv_sumfeebroker = parseFloat(sumfeebroker2.replace(/,/g, ""));
            var feebrokerval = $('#slipvbrokerupdate').val();

            // if(feebrokerval != null){
                var sumvbroker = isNaN((conv_sumfeebroker / conv_sumgrossprmtonr)*100) ? 0 :((conv_sumfeebroker / conv_sumgrossprmtonr)*100).toFixed(2);
                var real_sumvbroker = sumvbroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                $('#slipvbrokerupdate').val(real_sumvbroker);

                var feebroker = parseFloat($('#slipvbrokerupdate').val());
                var sumnetprmtonr = isNaN( conv_sumgrossprmtonr * ((100 - commision - feebroker)/100)) ? 0 :(conv_sumgrossprmtonr * ((100 - commision - feebroker)/100)).toFixed(2);
                var real_sumnetprmtonr = sumnetprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                $('#slipnetprmtonrupdate').val(real_sumnetprmtonr);
                $('#slipnetprmtonrupdate2').val(real_sumnetprmtonr);
            // }
            
        }else{
            var netprm_to_nr = $('#slipnetprmtonrupdate').val();
        
            var feebroker = parseFloat($('#slipvbrokerupdate').val()) / 100;
            var commision =  parseFloat($('#slipcommissionupdate').val()) / 100;
            var sumgrossprmtonr = $("#slipgrossprmtonrupdate").val();
            var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr.replace(/,/g, ""));

            var sumfeebroker = isNaN( conv_sumgrossprmtonr * feebroker) ? 0 :(conv_sumgrossprmtonr * feebroker).toFixed(2);
            var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipsumfeeupdate').val(real_sumfeebroker);
            $('#slipsumfeeupdate2').val(real_sumfeebroker);
        }
   });

   $('#slipsumfeeupdate2').keydown(function(e){
        var keyCode = e.keyCode || e.which; 

        if (keyCode != 9) {
            // var netprm_to_nr = $('#slipnetprmtonr').val();
            // $('#slipsumfee').val($(this).val());
            // var feebroker = parseFloat($('#slipvbroker').val()) / 100;
            // var commision =  parseFloat($('#slipcommission').val()) / 100;
            // var sumgrossprmtonr = $("#slipgrossprmtonr").val();
            // var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr.replace(/,/g, ""));
            // var netprm_to_nr = $('#slipnetprmtonr').val();
            // var sumfeebroker2 = $('#slipsumfee').val();
            // var conv_sumfeebroker = parseFloat(sumfeebroker2.replace(/,/g, ""));
            // var feebrokerval = $('#slipvbroker').val();

            // if(feebrokerval != null){
            //     var sumvbroker = isNaN((conv_sumfeebroker / conv_sumgrossprmtonr)*100) ? 0 :((conv_sumfeebroker / conv_sumgrossprmtonr)*100).toFixed(2);
            //     var real_sumvbroker = sumvbroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            //     $('#slipvbroker').val(real_sumvbroker);
            // }
            
        }else{
            var netprm_to_nr = $('#slipnetprmtonrupdate').val();
        
            var feebroker = parseFloat($('#slipvbrokerupdate').val()) / 100;
            var commision =  parseFloat($('#slipcommissionupdate').val()) / 100;
            var sumgrossprmtonr = $("#slipgrossprmtonrupdate").val();
            var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr.replace(/,/g, ""));

            var sumfeebroker = isNaN( conv_sumgrossprmtonr * feebroker) ? 0 :(conv_sumgrossprmtonr * feebroker).toFixed(2);
            var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipsumfeeupdate').val(real_sumfeebroker);
            $('#slipsumfeeupdate2').val(real_sumfeebroker);
        }
   });

   $('#slipsumfeeupdate2').keypress(function(e){
        var keyCode = e.keyCode || e.which; 

        if (keyCode != 9) {
            // var netprm_to_nr = $('#slipnetprmtonr').val();
            // $('#slipsumfee').val($(this).val());
            // var feebroker = parseFloat($('#slipvbroker').val()) / 100;
            // var commision =  parseFloat($('#slipcommission').val()) / 100;
            // var sumgrossprmtonr = $("#slipgrossprmtonr").val();
            // var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr.replace(/,/g, ""));
            // var netprm_to_nr = $('#slipnetprmtonr').val();
            // var sumfeebroker2 = $('#slipsumfee').val();
            // var conv_sumfeebroker = parseFloat(sumfeebroker2.replace(/,/g, ""));
            // var feebrokerval = $('#slipvbroker').val();

            // if(feebrokerval != null){
            //     var sumvbroker = isNaN((conv_sumfeebroker / conv_sumgrossprmtonr)*100) ? 0 :((conv_sumfeebroker / conv_sumgrossprmtonr)*100).toFixed(2);
            //     var real_sumvbroker = sumvbroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            //     $('#slipvbroker').val(real_sumvbroker);
            // }
            
        }else{
           var netprm_to_nr = $('#slipnetprmtonrupdate').val();
        
            var feebroker = parseFloat($('#slipvbrokerupdate').val()) / 100;
            var commision =  parseFloat($('#slipcommissionupdate').val()) / 100;
            var sumgrossprmtonr = $("#slipgrossprmtonrupdate").val();
            var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr.replace(/,/g, ""));

            var sumfeebroker = isNaN( conv_sumgrossprmtonr * feebroker) ? 0 :(conv_sumgrossprmtonr * feebroker).toFixed(2);
            var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipsumfeeupdate').val(real_sumfeebroker);
            $('#slipsumfeeupdate2').val(real_sumfeebroker);
        }
   });


   $('#slipvbrokerupdate').change(function(){

        if( $('#installmentPanel tbody').find('tr').val().length > 0){
            swal('warning!','netprm to nr changed, please change installment amount manually','success')
        }

   });

   $('#slipippercentageupdate').keyup(function (e) {
        var keyCode = e.keyCode || e.which; 

        if(keyCode != 9){
            var percent =  parseFloat($(this).val()) / 100;

            var sumnetprtonr = $("#slipnetprmtonrupdate").val();
            var conv_sumnetprtonr = parseFloat(sumnetprtonr.replace(/,/g, ""));

            var sum = isNaN(percent *  conv_sumnetprtonr) ? 0 :(percent *  conv_sumnetprtonr).toFixed(2);
            var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipipamountupdate').val(real_sum);
            // $('#slipipamount2').val(real_sum);
        }else{
            var percent =  parseFloat($(this).val()) / 100;

            var sumnetprtonr = $("#slipnetprmtonrupdate").val();
            var conv_sumnetprtonr = parseFloat(sumnetprtonr.replace(/,/g, ""));

            var sum = isNaN(percent *  conv_sumnetprtonr) ? 0 :(percent *  conv_sumnetprtonr).toFixed(2);
            var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipipamountupdate').val(real_sum);
        }
    });

   $('#slipippercentageupdate').keydown(function (e) {
        var keyCode = e.keyCode || e.which;

        if(keyCode != 9){
            var percent =  parseFloat($(this).val()) / 100;

            var sumnetprtonr = $("#slipnetprmtonrupdate").val();
            var conv_sumnetprtonr = parseFloat(sumnetprtonr.replace(/,/g, ""));

            var sum = isNaN(percent *  conv_sumnetprtonr) ? 0 :(percent *  conv_sumnetprtonr).toFixed(2);
            var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipipamountupdate').val(real_sum);
            // $('#slipipamount2').val(real_sum);
        }else{
            var percent =  parseFloat($(this).val()) / 100;

            var sumnetprtonr = $("#slipnetprmtonrupdate").val();
            var conv_sumnetprtonr = parseFloat(sumnetprtonr.replace(/,/g, ""));

            var sum = isNaN(percent *  conv_sumnetprtonr) ? 0 :(percent *  conv_sumnetprtonr).toFixed(2);
            var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipipamountupdate').val(real_sum);
        }
    });

   $('#slipippercentageupdate').keypress(function (e) {
        var keyCode = e.keyCode || e.which;

        if(keyCode != 9){
            var percent =  parseFloat($(this).val()) / 100;

            var sumnetprtonr = $("#slipnetprmtonrupdate").val();
            var conv_sumnetprtonr = parseFloat(sumnetprtonr.replace(/,/g, ""));

            var sum = isNaN(percent *  conv_sumnetprtonr) ? 0 :(percent *  conv_sumnetprtonr).toFixed(2);
            var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipipamountupdate').val(real_sum);
            // $('#slipipamount2').val(real_sum);
        }else{
            var percent =  parseFloat($(this).val()) / 100;

            var sumnetprtonr = $("#slipnetprmtonrupdate").val();
            var conv_sumnetprtonr = parseFloat(sumnetprtonr.replace(/,/g, ""));

            var sum = isNaN(percent *  conv_sumnetprtonr) ? 0 :(percent *  conv_sumnetprtonr).toFixed(2);
            var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipipamountupdate').val(real_sum);
        }
    });

   $('#slipippercentageupdate').change(function (e) {
        var keyCode = e.keyCode || e.which;

        if(keyCode != 9){
            var percent =  parseFloat($(this).val()) / 100;

            var sumnetprtonr = $("#slipnetprmtonrupdate").val();
            var conv_sumnetprtonr = parseFloat(sumnetprtonr.replace(/,/g, ""));

            var sum = isNaN(percent *  conv_sumnetprtonr) ? 0 :(percent *  conv_sumnetprtonr).toFixed(2);
            var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipipamountupdate').val(real_sum);
            // $('#slipipamount2').val(real_sum);
        }else{
            var percent =  parseFloat($(this).val()) / 100;

            var sumnetprtonr = $("#slipnetprmtonrupdate").val();
            var conv_sumnetprtonr = parseFloat(sumnetprtonr.replace(/,/g, ""));

            var sum = isNaN(percent *  conv_sumnetprtonr) ? 0 :(percent *  conv_sumnetprtonr).toFixed(2);
            var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipipamountupdate').val(real_sum);
        }
    });

   $('#slipipamountupdate').change(function(e){
        var keyCode = e.keyCode || e.which;    

        if(keyCode != 9){
                var amount =  $(this).val();
                var conv_amount = parseFloat(amount.replace(/,/g, ""));
                console.log(amount)
                console.log(conv_amount)
                var sumnetprtonr = $("#slipnetprmtonrupdate").val();
                var conv_sumnetprtonr = parseFloat(sumnetprtonr.replace(/,/g, ""));

                var sum = isNaN((conv_amount /  conv_sumnetprtonr) * 100) ? 0 :((conv_amount /  conv_sumnetprtonr) * 100).toFixed(2);
                var real_sum = sum.toString();
                console.log(sum)
                console.log(real_sum)

                $('#slipippercentageupdate').val(real_sum);
                // $('#slipipamount2').val(real_sum);
            }else{
                 var amount =  $(this).val();
                var conv_amount = parseFloat(amount.replace(/,/g, ""));
                console.log(amount)
                console.log(conv_amount)
                var sumnetprtonr = $("#slipnetprmtonrupdate").val();
                var conv_sumnetprtonr = parseFloat(sumnetprtonr.replace(/,/g, ""));
                
                var sum = isNaN((conv_amount /  conv_sumnetprtonr) * 100) ? 0 :((conv_amount /  conv_sumnetprtonr) * 100).toFixed(2);
                var real_sum = sum.toString();
                console.log(sum)
                console.log(real_sum)
                $('#slipippercentageupdate').val(real_sum);
            }
   });

   $('#slipipamountupdate').keyup(function(e){
        var keyCode = e.keyCode || e.which;

        if(keyCode != 9){
            //  var percent =  parseFloat($("#slipippercentage").val()) / 100;

            // var sumnetprtonr = $("#slipnetprmtonr").val();
            // var conv_sumnetprtonr = parseFloat(sumnetprtonr.replace(/,/g, ""));

            // var sum = isNaN(percent *  conv_sumnetprtonr) ? 0 :(percent *  conv_sumnetprtonr).toFixed(2);
            // var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            // $('#slipipamount').val(real_sum);

        }else{      
                 var percent =  parseFloat($("#slipippercentageupdate").val()) / 100;

            var sumnetprtonr = $("#slipnetprmtonrupdate").val();
            var conv_sumnetprtonr = parseFloat(sumnetprtonr.replace(/,/g, ""));

            var sum = isNaN(percent *  conv_sumnetprtonr) ? 0 :(percent *  conv_sumnetprtonr).toFixed(2);
            var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipipamountupdate').val(real_sum);
        }
   });

   $('#slipipamountupdate').keypress(function(e){
        var keyCode = e.keyCode || e.which;

        if(keyCode != 9){
               // var percent =  parseFloat($("#slipippercentage").val()) / 100;

               //  var sumnetprtonr = $("#slipnetprmtonr").val();
               //  var conv_sumnetprtonr = parseFloat(sumnetprtonr.replace(/,/g, ""));

               //  var sum = isNaN(percent *  conv_sumnetprtonr) ? 0 :(percent *  conv_sumnetprtonr).toFixed(2);
               //  var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

               //  $('#slipipamount').val(real_sum);
            }else{
                 var percent =  parseFloat($("#slipippercentageupdate").val()) / 100;

                var sumnetprtonr = $("#slipnetprmtonrupdate").val();
                var conv_sumnetprtonr = parseFloat(sumnetprtonr.replace(/,/g, ""));

                var sum = isNaN(percent *  conv_sumnetprtonr) ? 0 :(percent *  conv_sumnetprtonr).toFixed(2);
                var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                $('#slipipamountupdate').val(real_sum);
            }
   });

   $('#slipipamountupdate').keydown(function(e){
        var keyCode = e.keyCode || e.which;

        if(keyCode != 9){
                // var percent =  parseFloat($("#slipippercentage").val()) / 100;

                // var sumnetprtonr = $("#slipnetprmtonr").val();
                // var conv_sumnetprtonr = parseFloat(sumnetprtonr.replace(/,/g, ""));

                // var sum = isNaN(percent *  conv_sumnetprtonr) ? 0 :(percent *  conv_sumnetprtonr).toFixed(2);
                // var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                // $('#slipipamount').val(real_sum);
                // $('#slipipamount2').val(real_sum);
            }else{
                var percent =  parseFloat($("#slipippercentageupdate").val()) / 100;

                var sumnetprtonr = $("#slipnetprmtonrupdate").val();
                var conv_sumnetprtonr = parseFloat(sumnetprtonr.replace(/,/g, ""));

                var sum = isNaN(percent *  conv_sumnetprtonr) ? 0 :(percent *  conv_sumnetprtonr).toFixed(2);
                var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                $('#slipipamountupdate').val(real_sum);
            }
   });
   
   $('#sliporupdate').keyup(function(e) {
        if(e.keyCode != 9){
            var percent =  parseFloat($(this).val()) / 100;
            var sumshare = $("#slipsumshareupdate").val();
            var conv_sumshare = parseFloat(sumshare.replace(/,/g, ""));

            var sum = isNaN(percent * conv_sumshare) ? 0 :(percent * conv_sumshare).toFixed(2);
            var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            if($(this).val() > 100){
                swal('warning!','percentage cannot more than 100%','sum value error');
                $('#slipsumorupdate').empty();
                $('#slipsumorupdate2').empty();
            }else{
                $('#slipsumorupdate').val(real_sum);
                $('#slipsumorupdate2').val(real_sum);
            }

            


        }
    });

   $('#sliprppercentageupdate').keyup(function (e) {
    if(e.keyCode != 9){
        var percentval =  parseFloat($(this).val()) / 100;
        var sumshare = $('#slipsumshareupdate').val() ;
        var conv_sumshare = parseFloat(sumshare.replace(/,/g, ""));
        var sumrpamount = isNaN(percentval * conv_sumshare) ? 0 :(percentval * conv_sumshare).toFixed(2);
        var real_sumrpamount = sumrpamount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            // var sumpercentor = isNaN(orpercent - percentval) ? 0 :(orpercent - percentval); 
            // $('#slipor').val(sumpercentor);
            $('#sliprpamountupdate').val(real_sumrpamount);
            $('#sliprpamountupdate2').val(real_sumrpamount);
        }
    });

   $('#sliprppercentageupdate').change(function (e) {
        if(e.keyCode != 9){
            var percentval =  parseFloat($(this).val());
            var orpercent = parseFloat($('#sliporupdate').val());
            var sumpercentor = isNaN(orpercent - percentval) ? 0 :(orpercent - percentval).toFixed(2);
            $('#sliporupdate').val(sumpercentor);

            var percent =  parseFloat($('#sliporupdate').val()) / 100;
            var sumshare = $("#slipsumshareupdate").val();
            var conv_sumshare = parseFloat(sumshare.replace(/,/g, ""));

            var sum = isNaN(percent * conv_sumshare) ? 0 :(percent * conv_sumshare).toFixed(2);
            var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipsumorupdate').val(real_sum);
            $('#slipsumorupdate2').val(real_sum);
        }
    });

   $('#slipnilaiecupdate').keyup(function () {
        var persentage =  parseFloat($('#slipnilaiecupdate').val()) / 1000;
        var sliptotalsum =  $('#sliptotalsumupdate').val();
        var conv_sliptotalsum = parseFloat(sliptotalsum.replace(/,/g, ""));
       //alert(premiumnr);
       //alert(persentage);
        var sum = isNaN(conv_sliptotalsum * persentage) ? 0 :(conv_sliptotalsum * persentage).toFixed(2) ;
        var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
       //alert(sum);
        console.log($(this).val())
        console.log(persentage)
        console.log(sum)
        console.log(real_sum)

        $('#slipamountecupdate').val(real_sum);
        $('#slipamountecupdate2').val(real_sum);
   });
</script>



<script  type='text/javascript'>
   $('#slippctendorsement').keyup(function (e) {
        if(e.keyCode != 9){
            var pct =  parseFloat($(this).val())/100;

            var tsi = $("#sliptotalsumendorsement").val();
            var conv_tsi = parseFloat(tsi.replace(/,/g, ""));

            var sum = isNaN(pct * conv_tsi) ? 0 :(pct * conv_tsi).toFixed(2) ;
            console.log(sum)
            var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            $('#sliptotalsumpctendorsement').val(real_sum);
            $('#sliptotalsumpctendorsement2').val(real_sum);
        }
    });

   $('#slipdppercentageendorsement').keyup(function (e) {
        if(e.keyCode != 9){
            var percent =  parseFloat($(this).val()) / 100;
            var tsi = $("#sliptotalsumendorsement").val();
            var conv_tsi = parseFloat(tsi.replace(/,/g, ""));
            var sum = isNaN(percent * conv_tsi) ? 0 :(percent * conv_tsi).toFixed(2) ;
            var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            console.log($(this).val())
            console.log(percent)
            console.log(sum)
            console.log(real_sum)

            $('#slipdpamountendorsement').val(real_sum);
            $('#slipdpamountendorsement2').val(real_sum);
        }
    });

   $('#slipshareendorsement').keyup(function (e) 
       {
        if(e.keyCode != 9){
            var shareslip =  parseFloat($(this).val()) / 100 ;
            var tsi = $("#sharetotalsumendorsement").val();
            var conv_tsi = parseFloat(tsi.replace(/,/g, ""));
            var sumshare =isNaN( shareslip * conv_tsi) ? 0 :( shareslip * conv_tsi).toFixed(2) ;
            var real_sumshare = sumshare.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


            $('#slipsumshareendorsement').val(real_sumshare);
            $('#slipsumshareendorsement2').val(real_sumshare);
        }
    });


   $('#sliprateendorsement').keyup(function (e) {
        if(e.keyCode != 9){
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
            var tsi = $("#sharetotalsumendorsement").val();
            var conv_tsi = parseFloat(tsi.replace(/,/g, ""));
            var totalrateexc = $('#sliptotalnilaiecendorsement').val();
            var basic_premi = $('#slipbasicpremiumendorsement').val();

            if(totalrateexc){
                    var conv_totalrateexc = parseFloat(totalrateexc);
                    var sumtotalrate = isNaN(rateslip + parseFloat(conv_totalrateexc)) ? 0 :(rateslip + parseFloat(conv_totalrateexc)).toFixed(3);
                    var real_sumtotalrate = sumtotalrate.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    $('#sliptotalrateendorsement').val(real_sumtotalrate);
                    $('#sliptotalrateendorsement2').val(real_sumtotalrate);

                    var sumrate = $("#sliptotalrateendorsement").val();
                    var conv_sumrate = parseFloat(sumrate.replace(/,/g, ""));
                    var sum = isNaN(((conv_sumrate / 1000) * conv_tsi) * insurance) ? 0 :(((conv_sumrate / 1000) * conv_tsi) * insurance).toFixed(2) ;
                    var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                    $('#slipbasicpremiumendorsement').val(real_sum);


                }else{
                     var conv_totalrateexc = parseFloat(totalrateexc);
                     var sumtotalrate = isNaN(parseFloat(0) + rateslip) ? 0 :(parseFloat(0) + rateslip).toFixed(3);
                     var real_sumtotalrate = sumtotalrate.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                     $('#sliptotalrateendorsement').val(real_sumtotalrate);
                     $('#sliptotalrateendorsement2').val(real_sumtotalrate);

                    var sumrate = $("#sliptotalrateendorsement").val();
                    var conv_sumrate = parseFloat(sumrate.replace(/,/g, ""));
                    var sum = isNaN(((conv_sumrate / 1000) * conv_tsi) * insurance) ? 0 :(((conv_sumrate / 1000) * conv_tsi) * insurance).toFixed(2) ;
                    var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                    $('#slipbasicpremiumendorsement').val(real_sum);


                }

            if(basic_premi){
                var bpinsurance_period_from2 = $('#sliprpfromendorsement').val();
                var bpinsurance_period_to2 = $('#sliprptoendorsement').val();
                var bpnewinsurance_period_from2 = bpinsurance_period_from2.split("/").reverse().join("-");
                var bpnewinsurance_period_to2 = bpinsurance_period_to2.split("/").reverse().join("-");
                var bpdays=daysBetween(bpnewinsurance_period_from2, bpnewinsurance_period_to2);
                var bpinsurance = (bpdays/365);
                
                console.log(bpinsurance_period_from2)
                console.log(bpinsurance_period_to2)
                console.log(bpnewinsurance_period_from2)
                console.log(bpnewinsurance_period_to2)
                console.log(bpdays)
                console.log(bpinsurance)

                var bprateslip =  parseFloat($(this).val());
                var bpsumrate = $("#sliptotalrateendorsement").val();
                var bpconv_sumrate = parseFloat(bpsumrate.replace(/,/g, ""));
                var bptsi = $("#sharetotalsumendorsement").val();
                var bpconv_tsi = parseFloat(bptsi.replace(/,/g, ""));
                var bpsum = isNaN(((bpconv_sumrate / 1000) * bpconv_tsi) * bpinsurance) ? 0 :(((bpconv_sumrate / 1000) * bpconv_tsi) * bpinsurance).toFixed(2) ;
                var bpreal_sum = bpsum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                $('#slipbasicpremiumendorsement').val(bpreal_sum);

                var share = $('#slipshareendorsement').val();
                if(share){
                    var shareslip =  parseFloat(share) / 100 ;
                    var nasionalreinsurance =  $('#mpsharefrom').val();
                    var totalnre =  $('#mpshareto').val();
                    var conv_totalnre =  parseFloat(totalnre.replace(/,/g, ""));

                    console.log('nre' + nasionalreinsurance)
                        // console.log(conv_nasionalreinsurance)
                    console.log('totalnre' + totalnre)
                    console.log('convtotnre' + conv_totalnre)
                    

                    var sumshare = $('#slipsumshareendorsement').val() ;
                    var conv_sumshare = parseFloat(sumshare.replace(/,/g, ""));

                    
                    var conv_basre = parseFloat(basic_premi.replace(/,/g, ""));

                    var orpercent = $('#sliporendorsement').val() / 100;

                    var sumor = isNaN(orpercent * conv_sumshare) ? 0 :(orpercent * conv_sumshare).toFixed(2);
                    var real_sumor = sumor.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    
                    var sumgprmtonr = isNaN(conv_basre * shareslip ) ? 0 :(conv_basre * shareslip ).toFixed(2);
                    var real_sumgprmtonr= sumgprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    
                    if(nasionalreinsurance){
                        var conv_nasionalreinsurance =  parseFloat(nasionalreinsurance.replace(/,/g, ""));
                        var sumnre = isNaN(conv_nasionalreinsurance + conv_sumshare ) ? 0 :(conv_nasionalreinsurance + conv_sumshare).toFixed(2) ;
                        var real_sumnre = sumnre.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    }else{
                        var conv_nasionalreinsurance =  parseFloat(nasionalreinsurance.replace(/,/g, ""));
                        var sumnre = isNaN(0 + conv_sumshare ) ? 0 :(0 + conv_sumshare).toFixed(2) ;
                        var real_sumnre = sumnre.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    }
                    
                    
                    var sumourshare = isNaN((sumnre / conv_totalnre) * 100 ) ? 0 :((sumnre / conv_totalnre) * 100 ).toFixed(2) ;

                    console.log('sumnre' + sumnre)
                    console.log('realnre' + real_sumnre)
                    console.log('sumourshare' + sumourshare)

                    $('#slipgrossprmtonrendorsement').val(real_sumgprmtonr);
                    $('#slipgrossprmtonrendorsement2').val(real_sumgprmtonr);
                    $('#slipsumorendorsement').val(real_sumor);
                    $('#slipsumorendorsement2').val(real_sumor);
                    // $('#mpshare').val(sumourshare.replace(/,/g, "."));
                    $('#mpsharefrom').val(real_sumnre);

                    var slipsumcommissionval = $('#slipsumcommissionendorsement').val();
                    if(slipsumcommissionval != null){
                        var commision =  parseFloat($('#slipcommissionendorsement').val()) / 100;
                        var feebroker = parseFloat($('#slipvbrokeendorsementr').val()) / 100;
                        var sumgrossprmtonr = $("#slipgrossprmtonrendorsement").val();
                        var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr.replace(/,/g, ""));

                        var sumcomm = isNaN(commision * conv_sumgrossprmtonr) ? 0 :(commision * conv_sumgrossprmtonr).toFixed(2);
                        var real_sumcomm = sumcomm.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                        $('#slipsumcommissionendorsement').val(real_sumcomm);
                        $('#slipsumcommissionendorsement2').val(real_sumcomm);

                        var netprm_to_nr = $('#slipnetprmtonrendorsement').val();
                        if(netprm_to_nr != null){


                            var sumnetprmtonr = isNaN( conv_sumgrossprmtonr * (100/100 - commision - feebroker)) ? 0 :(conv_sumgrossprmtonr * (100/100 - commision - feebroker)).toFixed(2);
                            var real_sumnetprmtonr = sumnetprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                            var sumfeebroker = isNaN( conv_sumgrossprmtonr * feebroker) ? 0 :(conv_sumgrossprmtonr * feebroker).toFixed(2);
                            var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


                            $('#slipnetprmtonrendorsement').val(real_sumnetprmtonr);
                            $('#slipnetprmtonrendorsement2').val(real_sumnetprmtonr);
                            // $('#slipsumfee').val("100" + "-" + commision.toString() + "-" + feebroker.toString() + "*" + conv_sumgrossprmtonr.toString());
                            $('#slipsumfeeendorsement').val(real_sumfeebroker);
                            $('#slipsumfeeendorsement2').val(real_sumfeebroker);

                            var retro_backup = $('#sliprbendorsement').val();
                            if(retro_backup == 'YES'){
                                swal('warning!','please change retrocession amount manually','success')
                            }

                        }

                    }
                }



            }
            
        }else{
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
            var tsi = $("#sharetotalsumendorsement").val();
            var conv_tsi = parseFloat(tsi.replace(/,/g, ""));
            var totalrateexc = $('#sliptotalnilaiecendorsement').val();
            var basic_premi = $('#slipbasicpremiumendorsement').val();

            if(totalrateexc){
                    var conv_totalrateexc = parseFloat(totalrateexc);
                    var sumtotalrate = isNaN(rateslip + parseFloat(conv_totalrateexc)) ? 0 :(rateslip  + parseFloat(conv_totalrateexc)).toFixed(3);
                    var real_sumtotalrate = sumtotalrate.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    console.log('sliptotalrate' + sumtotalrate)
                    console.log('sliptotalrate' + real_sumtotalrate)
                    $('#sliptotalrateendorsement').val(real_sumtotalrate);
                    $('#sliptotalrateendorsement2').val(real_sumtotalrate);

                    var sumrate = $("#sliptotalrateendorsement").val();
                    var conv_sumrate = parseFloat(sumrate.replace(/,/g, ""));
                    var sum = isNaN(((conv_sumrate / 1000) * conv_tsi) * insurance) ? 0 :(((conv_sumrate / 1000) * conv_tsi) * insurance).toFixed(2) ;
                    var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    console.log('conv_sumrate' + sum)
                    console.log('real_sum' + real_sum)
                    $('#slipbasicpremiumendorsement').val(real_sum);



                }else{
                     var conv_totalrateexc = parseFloat(totalrateexc);
                     var sumtotalrate = isNaN(parseFloat(0) + rateslip) ? 0 :(parseFloat(0) + rateslip).toFixed(3);
                     var real_sumtotalrate = sumtotalrate.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                     console.log('sliptotalrate' + sumtotalrate)
                    console.log('sliptotalrate' + real_sumtotalrate)
                     $('#sliptotalrateendorsement').val(real_sumtotalrate);
                     $('#sliptotalrateendorsement2').val(real_sumtotalrate);

                    var sumrate = $("#sliptotalrateendorsement").val();
                    var conv_sumrate = parseFloat(sumrate.replace(/,/g, ""));
                    var sum = isNaN(((conv_sumrate / 1000) * conv_tsi) * insurance) ? 0 :(((conv_sumrate / 1000) * conv_tsi) * insurance).toFixed(2) ;
                    var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    console.log('conv_sumrate' + sum)
                    console.log('real_sum' + real_sum)

                    $('#slipbasicpremiumendorsement').val(real_sum);
                }

            if(basic_premi){
                var bpinsurance_period_from2 = $('#sliprpfromendorsement').val();
                var bpinsurance_period_to2 = $('#sliprptoendorsement').val();
                var bpnewinsurance_period_from2 = bpinsurance_period_from2.split("/").reverse().join("-");
                var bpnewinsurance_period_to2 = bpinsurance_period_to2.split("/").reverse().join("-");
                var bpdays=daysBetween(bpnewinsurance_period_from2, bpnewinsurance_period_to2);
                var bpinsurance = (bpdays/365);
                
                console.log(bpinsurance_period_from2)
                console.log(bpinsurance_period_to2)
                console.log(bpnewinsurance_period_from2)
                console.log(bpnewinsurance_period_to2)
                console.log(bpdays)
                console.log(bpinsurance)

                var bprateslip =  parseFloat($('#sliprateendorsement').val());
                var bpsumrate = $("#sliptotalrateendorsement").val();
                var bpconv_sumrate = parseFloat(bpsumrate.replace(/,/g, ""));
                var bptsi = $("#sharetotalsumendorsement").val();
                var bpconv_tsi = parseFloat(bptsi.replace(/,/g, ""));
                var bpsum = isNaN(((bpconv_sumrate / 1000) * bpconv_tsi) * bpinsurance) ? 0 :(((bpconv_sumrate / 1000) * bpconv_tsi) * bpinsurance).toFixed(2) ;
                var bpreal_sum = bpsum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                $('#slipbasicpremiumendorsement').val(bpreal_sum);

                var share = $('#slipshareendorsement').val();
                if(share){
                    var shareslip =  parseFloat(share) / 100 ;
                    var nasionalreinsurance =  $('#mpsharefrom').val();
                    var totalnre =  $('#mpshareto').val();
                    var conv_totalnre =  parseFloat(totalnre.replace(/,/g, ""));

                    console.log('nre' + nasionalreinsurance)
                        // console.log(conv_nasionalreinsurance)
                    console.log('totalnre' + totalnre)
                    console.log('convtotnre' + conv_totalnre)
                    

                    var sumshare = $('#slipsumshareendorsement').val() ;
                    var conv_sumshare = parseFloat(sumshare.replace(/,/g, ""));

                    
                    var conv_basre = parseFloat(basic_premi.replace(/,/g, ""));

                    var orpercent = $('#sliporendorsement').val() / 100;

                    var sumor = isNaN(orpercent * conv_sumshare) ? 0 :(orpercent * conv_sumshare).toFixed(2);
                    var real_sumor = sumor.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    
                    var sumgprmtonr = isNaN(conv_basre * shareslip ) ? 0 :(conv_basre * shareslip ).toFixed(2);
                    var real_sumgprmtonr= sumgprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    
                    if(nasionalreinsurance){
                        var conv_nasionalreinsurance =  parseFloat(nasionalreinsurance.replace(/,/g, ""));
                        var sumnre = isNaN(conv_nasionalreinsurance + conv_sumshare ) ? 0 :(conv_nasionalreinsurance + conv_sumshare).toFixed(2) ;
                        var real_sumnre = sumnre.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    }else{
                        var conv_nasionalreinsurance =  parseFloat(nasionalreinsurance.replace(/,/g, ""));
                        var sumnre = isNaN(0 + conv_sumshare ) ? 0 :(0 + conv_sumshare).toFixed(2) ;
                        var real_sumnre = sumnre.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    }
                    
                    
                    var sumourshare = isNaN((sumnre / conv_totalnre) * 100 ) ? 0 :((sumnre / conv_totalnre) * 100 ).toFixed(2) ;

                    console.log('sumnre' + sumnre)
                    console.log('realnre' + real_sumnre)
                    console.log('sumourshare' + sumourshare)

                    $('#slipgrossprmtonrendorsement').val(real_sumgprmtonr);
                    $('#slipgrossprmtonrendorsement2').val(real_sumgprmtonr);
                    $('#slipsumorendorsement').val(real_sumor);
                    $('#slipsumorendorsement2').val(real_sumor);
                    // $('#mpshare').val(sumourshare.replace(/,/g, "."));
                    $('#mpsharefrom').val(real_sumnre);

                    var slipsumcommissionval = $('#slipsumcommissionendorsement').val();
                    if(slipsumcommissionval != null){
                        var commision =  parseFloat($('#slipcommissionendorsement').val()) / 100;
                        var feebroker = parseFloat($('#slipvbrokeendorsementr').val()) / 100;
                        var sumgrossprmtonr = $("#slipgrossprmtonrendorsement").val();
                        var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr.replace(/,/g, ""));

                        var sumcomm = isNaN(commision * conv_sumgrossprmtonr) ? 0 :(commision * conv_sumgrossprmtonr).toFixed(2);
                        var real_sumcomm = sumcomm.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                        $('#slipsumcommissionendorsement').val(real_sumcomm);
                        $('#slipsumcommissionendorsement2').val(real_sumcomm);

                        var netprm_to_nr = $('#slipnetprmtonrendorsement').val();
                        if(netprm_to_nr != null){


                            var sumnetprmtonr = isNaN( conv_sumgrossprmtonr * (100/100 - commision - feebroker)) ? 0 :(conv_sumgrossprmtonr * (100/100 - commision - feebroker)).toFixed(2);
                            var real_sumnetprmtonr = sumnetprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                            var sumfeebroker = isNaN( conv_sumgrossprmtonr * feebroker) ? 0 :(conv_sumgrossprmtonr * feebroker).toFixed(2);
                            var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


                            $('#slipnetprmtonrendorsement').val(real_sumnetprmtonr);
                            $('#slipnetprmtonrendorsement2').val(real_sumnetprmtonr);
                            // $('#slipsumfee').val("100" + "-" + commision.toString() + "-" + feebroker.toString() + "*" + conv_sumgrossprmtonr.toString());
                            $('#slipsumfeeendorsement').val(real_sumfeebroker);
                            $('#slipsumfeeendorsement2').val(real_sumfeebroker);

                            var retro_backup = $('#sliprbendorsement').val();
                            if(retro_backup == 'YES'){
                                swal('warning!','please change retrocession amount manually','success')
                            }

                        }

                    }
                }


            }
        }
    });



   $('#sliprateendorsement').change(function(){
        var rate_lower = $('#slipbclaendorsement').val();
        var rate_upper = $('#slipbcuaendorsement').val();
        var rate = $('#sliprateendorsement').val();
        

        if(rate_upper != '' || rate_lower != ''){
            var rate_lower_val = parseFloat(rate_lower);
            var rate_upper_val = parseFloat(rate_upper);
            var rate_val = parseFloat(rate);
            console.log(rate_lower_val)
            console.log(rate_upper_val)
            console.log(rate_val)
            if(rate_val < rate_lower_val || rate_val > rate_upper_val ){
                swal('warning','please input rate between rate lower and rate upper building','input error')
            }
            

        }else{
            swal('warning','please choose building const first','error')
        }
   });

   $("#slipbasicpremiumendorsement").keydown(function(e) { 
    var keyCode = e.keyCode || e.which; 

      if (keyCode == 9) { 
        // e.preventDefault(); 

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

        var rateslip =  parseFloat($('#sliprateendorsement').val());
        var sumrate = $("#sliptotalrateendorsement").val();
        var conv_sumrate = parseFloat(sumrate.replace(/,/g, ""));
        var tsi = $("#sharetotalsumendorsement").val();
        var conv_tsi = parseFloat(tsi.replace(/,/g, ""));
        var sum = isNaN(((conv_sumrate / 1000) * conv_tsi) * insurance) ? 0 :(((conv_sumrate / 1000) * conv_tsi) * insurance).toFixed(2) ;
        var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

        $('#slipbasicpremiumendorsement').val(real_sum);
        // call custom function here
      } 
    });

   $("#slipbasicpremiumendorsement").keyup(function(e) { 
    var keyCode = e.keyCode || e.which; 

      if (keyCode == 9) { 
        // e.preventDefault(); 
        // call custom function here
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

        var rateslip =  parseFloat($('#sliprateendorsement').val());
        var sumrate = $("#sliptotalrateendorsement").val();
        var conv_sumrate = parseFloat(sumrate.replace(/,/g, ""));
        var tsi = $("#sharetotalsumendorsement").val();
        var conv_tsi = parseFloat(tsi.replace(/,/g, ""));
        var sum = isNaN(((conv_sumrate / 1000) * conv_tsi) * insurance) ? 0 :(((conv_sumrate / 1000) * conv_tsi) * insurance).toFixed(2) ;
        var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

        $('#slipbasicpremiumendorsement').val(real_sum);
      } 
    });

   $("#slipbasicpremiumendorsement").keypress(function(e) { 
    var keyCode = e.keyCode || e.which; 

      if (keyCode == 9) { 
        // e.preventDefault(); 
        // call custom function here
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

        var rateslip =  parseFloat($('#sliprateendorsement').val());
        var sumrate = $("#sliptotalrateendorsement").val();
        var conv_sumrate = parseFloat(sumrate.replace(/,/g, ""));
        var tsi = $("#sharetotalsumendorsement").val();
        var conv_tsi = parseFloat(tsi.replace(/,/g, ""));
        var sum = isNaN(((conv_sumrate / 1000) * conv_tsi) * insurance) ? 0 :(((conv_sumrate / 1000) * conv_tsi) * insurance).toFixed(2) ;
        var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

        $('#slipbasicpremiumendorsement').val(real_sum);
      } 
    });

   $('#slipshareendorsement').change(function (e) {
        if(e.keyCode != 9){
            if($(this).val() < -100 || $(this).val() > 100){
                    swal('warning','share cannot lower than -100% or greater than 100%','error')
                    $('#slipshareendorsement').val('');
                    $('#slipsumshareendorsement').val('');
                    $('#slipsumshareendorsement2').val('');
            }
            else{
                var rateslip =  parseFloat($('#sliprateendorsement').val());
                var shareslip =  parseFloat($('#slipshareendorsement').val()) / 100;
                var nasionalreinsurance =  $('#mpsharefrom').val();
                var totalnre =  $('#mpshareto').val();
                var conv_totalnre =  parseFloat(totalnre.replace(/,/g, ""));

                console.log('nre' + nasionalreinsurance)
                    // console.log(conv_nasionalreinsurance)
                console.log('totalnre' + totalnre)
                console.log('convtotnre' + conv_totalnre)
                
                var tsi = $("#sharetotalsumendorsement").val();
                var conv_tsi = parseFloat(tsi.replace(/,/g, ""));

                var sumshare = $('#slipsumshareendorsement').val() ;
                var conv_sumshare = parseFloat(sumshare.replace(/,/g, ""));

                var basic_premium = $('#slipbasicpremiumendorsement').val();
                var conv_basre = parseFloat(basic_premium.replace(/,/g, ""));

                var orpercent = $('#sliporendorsement').val() / 100;

                var sumor = isNaN(orpercent * conv_sumshare) ? 0 :(orpercent * conv_sumshare).toFixed(2);
                var real_sumor = sumor.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                
                var sum = isNaN(conv_basre * shareslip ) ? 0 :(conv_basre * shareslip ).toFixed(2);
                var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                
                if(nasionalreinsurance){
                    var conv_nasionalreinsurance =  parseFloat(nasionalreinsurance.replace(/,/g, ""));
                    var sumnre = isNaN(conv_nasionalreinsurance + conv_sumshare ) ? 0 :(conv_nasionalreinsurance + conv_sumshare).toFixed(2) ;
                    var real_sumnre = sumnre.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                }else{
                    var conv_nasionalreinsurance =  parseFloat(nasionalreinsurance.replace(/,/g, ""));
                    var sumnre = isNaN(0 + conv_sumshare ) ? 0 :(0 + conv_sumshare).toFixed(2) ;
                    var real_sumnre = sumnre.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                }
                
                
                var sumourshare = isNaN((sumnre / conv_totalnre) * 100 ) ? 0 :((sumnre / conv_totalnre) * 100 ).toFixed(2) ;

                console.log('sumnre' + sumnre)
                console.log('realnre' + real_sumnre)
                console.log('sumourshare' + sumourshare)

                $('#slipgrossprmtonrendorsement').val(real_sum);
                $('#slipgrossprmtonrendorsement2').val(real_sum);
                $('#slipsumorendorsement').val(real_sumor);
                $('#slipsumorendorsement2').val(real_sumor);
                // $('#mpshare').val(sumourshare.replace(/,/g, "."));
                $('#mpsharefromendorsement').val(real_sumnre);

                var slipsumcommissionval = $('#slipsumcommissionendorsement').val();
                if(slipsumcommissionval != null){
                    var commision =  parseFloat($('#slipcommissionendorsement').val()) / 100;
                    var feebroker = parseFloat($('#slipvbrokerendorsement').val()) / 100;
                    var sumgrossprmtonr = $("#slipgrossprmtonrendorsement").val();
                    var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr.replace(/,/g, ""));

                    var sumcomm = isNaN(commision * conv_sumgrossprmtonr) ? 0 :(commision * conv_sumgrossprmtonr).toFixed(2);
                    var real_sumcomm = sumcomm.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                    $('#slipsumcommissionendorsement').val(real_sumcomm);
                    $('#slipsumcommissionendorsement2').val(real_sumcomm);

                    var netprm_to_nr = $('#slipnetprmtonrendorsement').val();
                    if(netprm_to_nr != null){


                        var sumnetprmtonr = isNaN( conv_sumgrossprmtonr * (100/100 - commision - feebroker)) ? 0 :(conv_sumgrossprmtonr * (100/100 - commision - feebroker)).toFixed(2);
                        var real_sumnetprmtonr = sumnetprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                        var sumfeebroker = isNaN( conv_sumgrossprmtonr * feebroker) ? 0 :(conv_sumgrossprmtonr * feebroker).toFixed(2);
                        var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


                        $('#slipnetprmtonrendorsement').val(real_sumnetprmtonr);
                        $('#slipnetprmtonrendorsement2').val(real_sumnetprmtonr);
                        // $('#slipsumfee').val("100" + "-" + commision.toString() + "-" + feebroker.toString() + "*" + conv_sumgrossprmtonr.toString());
                        $('#slipsumfeeendorsement').val(real_sumfeebroker);
                        $('#slipsumfeeendorsement2').val(real_sumfeebroker);

                        var retro_backup = $('#sliprbendorsement').val();
                        if(retro_backup == 'YES'){
                            swal('warning!','please change retrocession amount manually','success')
                        }

                    }

                }
            }
        }
    });
    
    $('#slipcommissionendorsement').keyup(function (e) {
        var keyCode = e.keyCode || e.which;

        if (keyCode != 9){
            var commision =  parseFloat($(this).val()) / 100;
            var feebroker = parseFloat($('#slipvbrokerendorsement').val()) / 100;
            var sumgrossprmtonr = $("#slipgrossprmtonrendorsement").val();
            var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr.replace(/,/g, ""));

            var sum = isNaN(commision * conv_sumgrossprmtonr) ? 0 :(commision * conv_sumgrossprmtonr).toFixed(2);
            var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipsumcommissionendorsement').val(real_sum);
            $('#slipsumcommissionendorsement2').val(real_sum);

            if(feebroker != null){
                var netprm_to_nr = $('#slipnetprmtonrendorsement').val();
                
                var sumnetprmtonr = isNaN( conv_sumgrossprmtonr * (100/100 - commision - feebroker)) ? 0 :(conv_sumgrossprmtonr * (100/100 - commision - feebroker)).toFixed(2);
                var real_sumnetprmtonr = sumnetprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                var sumfeebroker = isNaN( conv_sumgrossprmtonr * feebroker) ? 0 :(conv_sumgrossprmtonr * feebroker).toFixed(2);
                var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


                $('#slipnetprmtonrendorsement').val(real_sumnetprmtonr);
                $('#slipnetprmtonrendorsement2').val(real_sumnetprmtonr);
                // $('#slipsumfee').val("100" + "-" + commision.toString() + "-" + feebroker.toString() + "*" + conv_sumgrossprmtonr.toString());
                $('#slipsumfeeendorsement').val(real_sumfeebroker);
                $('#slipsumfeeendorsement2').val(real_sumfeebroker);
            }
        }else{
            var commision =  parseFloat($(this).val()) / 100;
            var feebroker = parseFloat($('#slipvbrokerendorsement').val()) / 100;
            var sumgrossprmtonr = $("#slipgrossprmtonrendorsement").val();
            var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr.replace(/,/g, ""));

            var sum = isNaN(commision * conv_sumgrossprmtonr) ? 0 :(commision * conv_sumgrossprmtonr).toFixed(2);
            var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipsumcommissionendorsement').val(real_sum);
            $('#slipsumcommissionendorsement2').val(real_sum);

            if(feebroker != null){
                var netprm_to_nr = $('#slipnetprmtonrendorsement').val();
                
                var sumnetprmtonr = isNaN( conv_sumgrossprmtonr * (100/100 - commision - feebroker)) ? 0 :(conv_sumgrossprmtonr * (100/100 - commision - feebroker)).toFixed(2);
                var real_sumnetprmtonr = sumnetprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                var sumfeebroker = isNaN( conv_sumgrossprmtonr * feebroker) ? 0 :(conv_sumgrossprmtonr * feebroker).toFixed(2);
                var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


                $('#slipnetprmtonrendorsement').val(real_sumnetprmtonr);
                $('#slipnetprmtonrendorsement2').val(real_sumnetprmtonr);
                // $('#slipsumfee').val("100" + "-" + commision.toString() + "-" + feebroker.toString() + "*" + conv_sumgrossprmtonr.toString());
                $('#slipsumfeeendorsement').val(real_sumfeebroker);
                $('#slipsumfeeendorsement2').val(real_sumfeebroker);
            }
        }

    });

   $('#slipcommissionendorsement').keydown(function (e) {
        var keyCode = e.keyCode || e.which;

        if (keyCode != 9){
            var commision =  parseFloat($(this).val()) / 100;
            var feebroker = parseFloat($('#slipvbrokerendorsement').val()) / 100;
            var sumgrossprmtonr = $("#slipgrossprmtonrendorsement").val();
            var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr.replace(/,/g, ""));

            var sum = isNaN(commision * conv_sumgrossprmtonr) ? 0 :(commision * conv_sumgrossprmtonr).toFixed(2);
            var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipsumcommissionendorsement').val(real_sum);
            $('#slipsumcommissionendorsement2').val(real_sum);

            if(feebroker != null){
                var netprm_to_nr = $('#slipnetprmtonrendorsement').val();
                
                var sumnetprmtonr = isNaN( conv_sumgrossprmtonr * (100/100 - commision - feebroker)) ? 0 :(conv_sumgrossprmtonr * (100/100 - commision - feebroker)).toFixed(2);
                var real_sumnetprmtonr = sumnetprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                var sumfeebroker = isNaN( conv_sumgrossprmtonr * feebroker) ? 0 :(conv_sumgrossprmtonr * feebroker).toFixed(2);
                var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


                $('#slipnetprmtonrendorsement').val(real_sumnetprmtonr);
                $('#slipnetprmtonrendorsement2').val(real_sumnetprmtonr);
                // $('#slipsumfee').val("100" + "-" + commision.toString() + "-" + feebroker.toString() + "*" + conv_sumgrossprmtonr.toString());
                $('#slipsumfeeendorsement').val(real_sumfeebroker);
                $('#slipsumfeeendorsement2').val(real_sumfeebroker);
            }
        }else{
            var commision =  parseFloat($(this).val()) / 100;
            var feebroker = parseFloat($('#slipvbrokerendorsement').val()) / 100;
            var sumgrossprmtonr = $("#slipgrossprmtonrendorsement").val();
            var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr.replace(/,/g, ""));

            var sum = isNaN(commision * conv_sumgrossprmtonr) ? 0 :(commision * conv_sumgrossprmtonr).toFixed(2);
            var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipsumcommissionendorsement').val(real_sum);
            $('#slipsumcommissionendorsement2').val(real_sum);

            if(feebroker != null){
                var netprm_to_nr = $('#slipnetprmtonrendorsement').val();
                
                var sumnetprmtonr = isNaN( conv_sumgrossprmtonr * (100/100 - commision - feebroker)) ? 0 :(conv_sumgrossprmtonr * (100/100 - commision - feebroker)).toFixed(2);
                var real_sumnetprmtonr = sumnetprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                var sumfeebroker = isNaN( conv_sumgrossprmtonr * feebroker) ? 0 :(conv_sumgrossprmtonr * feebroker).toFixed(2);
                var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


                $('#slipnetprmtonrendorsement').val(real_sumnetprmtonr);
                $('#slipnetprmtonrendorsement2').val(real_sumnetprmtonr);
                // $('#slipsumfee').val("100" + "-" + commision.toString() + "-" + feebroker.toString() + "*" + conv_sumgrossprmtonr.toString());
                $('#slipsumfeeendorsement').val(real_sumfeebroker);
                $('#slipsumfeeendorsement').val(real_sumfeebroker);
            }
        }

    });

   $('#slipcommissionendorsement').keypress(function (e) {
        var keyCode = e.keyCode || e.which;

        if (keyCode != 9){
            var commision =  parseFloat($(this).val()) / 100;
            var feebroker = parseFloat($('#slipvbroker').val()) / 100;
            var sumgrossprmtonr = $("#slipgrossprmtonr").val();
            var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr.replace(/,/g, ""));

            var sum = isNaN(commision * conv_sumgrossprmtonr) ? 0 :(commision * conv_sumgrossprmtonr).toFixed(2);
            var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipsumcommissionendorsement').val(real_sum);
            $('#slipsumcommissionendorsement2').val(real_sum);

            if(feebroker != null){
                var netprm_to_nr = $('#slipnetprmtonrendorsement').val();
                
                var sumnetprmtonr = isNaN( conv_sumgrossprmtonr * (100/100 - commision - feebroker)) ? 0 :(conv_sumgrossprmtonr * (100/100 - commision - feebroker)).toFixed(2);
                var real_sumnetprmtonr = sumnetprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                var sumfeebroker = isNaN( conv_sumgrossprmtonr * feebroker) ? 0 :(conv_sumgrossprmtonr * feebroker).toFixed(2);
                var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


                $('#slipnetprmtonrendorsement').val(real_sumnetprmtonr);
                $('#slipnetprmtonrendorsement2').val(real_sumnetprmtonr);
                // $('#slipsumfee').val("100" + "-" + commision.toString() + "-" + feebroker.toString() + "*" + conv_sumgrossprmtonr.toString());
                $('#slipsumfeeendorsement').val(real_sumfeebroker);
                $('#slipsumfeeendorsement2').val(real_sumfeebroker);
            }
        }else{
            var commision =  parseFloat($(this).val()) / 100;
            var feebroker = parseFloat($('#slipvbrokerendorsement').val()) / 100;
            var sumgrossprmtonr = $("#slipgrossprmtonrendorsement").val();
            var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr.replace(/,/g, ""));

            var sum = isNaN(commision * conv_sumgrossprmtonr) ? 0 :(commision * conv_sumgrossprmtonr).toFixed(2);
            var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipsumcommissionendorsement').val(real_sum);
            $('#slipsumcommissionendorsement2').val(real_sum);

            if(feebroker != null){
                var netprm_to_nr = $('#slipnetprmtonrendorsement').val();
                
                var sumnetprmtonr = isNaN( conv_sumgrossprmtonr * (100/100 - commision - feebroker)) ? 0 :(conv_sumgrossprmtonr * (100/100 - commision - feebroker)).toFixed(2);
                var real_sumnetprmtonr = sumnetprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                var sumfeebroker = isNaN( conv_sumgrossprmtonr * feebroker) ? 0 :(conv_sumgrossprmtonr * feebroker).toFixed(2);
                var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


                $('#slipnetprmtonrendorsement').val(real_sumnetprmtonr);
                $('#slipnetprmtonrendorsement2').val(real_sumnetprmtonr);
                // $('#slipsumfee').val("100" + "-" + commision.toString() + "-" + feebroker.toString() + "*" + conv_sumgrossprmtonr.toString());
                $('#slipsumfeeendorsement').val(real_sumfeebroker);
                $('#slipsumfeeendorsement2').val(real_sumfeebroker);
            }
        }

    });

   $('#slipsumcommissionendorsement2').keyup(function(e){
        var keyCode = e.keyCode || e.which; 

        if (keyCode != 9) {
            $('#slipsumcommissionendorsement').val($(this).val());
            var sumcommision =  $('#slipsumcommissionendorsement').val();
            var conv_sumcommision = parseFloat(sumcommision.replace(/,/g, ""));
            var commisionval =  $('#slipcommissionendorsement').val();
            var feebroker = parseFloat($('#slipvbrokerendorsement').val());
            var sumgrossprmtonr2 = $("#slipgrossprmtonrendorsement").val();
            var conv_sumgrossprmtonr2 = parseFloat(sumgrossprmtonr2.replace(/,/g, ""));

            // if(commisionval != null){
                var sum = isNaN((conv_sumcommision / conv_sumgrossprmtonr2)*100) ? 0 :((conv_sumcommision / conv_sumgrossprmtonr2)*100).toFixed(2);
                var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                $('#slipcommissionendorsement').val(real_sum);

                if(feebroker != null){
                    var commision = parseFloat($('#slipcommissionendorsement').val());
                    var netprm_to_nr = $('#slipnetprmtonrendorsement').val();
                    
                    var sumnetprmtonr = isNaN( conv_sumgrossprmtonr2 * ((100 - commision - feebroker)/100)) ? 0 :(conv_sumgrossprmtonr2 * ((100 - commision - feebroker)/100)).toFixed(2);
                    var real_sumnetprmtonr = sumnetprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                    var sumfeebroker = isNaN( conv_sumgrossprmtonr2 * feebroker) ? 0 :(conv_sumgrossprmtonr2 * feebroker).toFixed(2);
                    var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


                    $('#slipnetprmtonrendorsement').val(real_sumnetprmtonr);
                    $('#slipnetprmtonrendorsement2').val(real_sumnetprmtonr);
                    // $('#slipsumfee').val("100" + "-" + commision.toString() + "-" + feebroker.toString() + "*" + conv_sumgrossprmtonr.toString());
                    $('#slipsumfeeendorsement').val(real_sumfeebroker);
                    $('#slipsumfeeendorsement2').val(real_sumfeebroker);
                }

            // }
        }else{
            var commision =  parseFloat($('#slipcommissionendorsement').val()) / 100;
            var feebroker = parseFloat($('#slipvbrokerendorsement').val()) / 100;
            var sumgrossprmtonr = $("#slipgrossprmtonrendorsement").val();
            var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr.replace(/,/g, ""));

            var sum = isNaN(commision * conv_sumgrossprmtonr) ? 0 :(commision * conv_sumgrossprmtonr).toFixed(2);
            var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipsumcommissionendorsement').val(real_sum);
            $('#slipsumcommissionendorsement2').val(real_sum);
        }
   });

   $('#slipsumcommissionendorsement2').keydown(function(e){
        var keyCode = e.keyCode || e.which; 

        if (keyCode != 9) {
            // $('#slipsumcommission').val($(this).val());
            // var sumcommision =  $('#slipsumcommission').val();
            // var conv_sumcommision = parseFloat(sumcommision.replace(/,/g, ""));
            // var commisionval =  $('#slipcommission').val();
            // var feebroker = parseFloat($('#slipvbroker').val()) / 100;
            // var sumgrossprmtonr2 = $("#slipgrossprmtonr").val();
            // var conv_sumgrossprmtonr2 = parseFloat(sumgrossprmtonr2.replace(/,/g, ""));

            // if(commisionval != null){
            //     var sum = isNaN((conv_sumcommision / conv_sumgrossprmtonr2)*100) ? 0 :((conv_sumcommision / conv_sumgrossprmtonr2)*100).toFixed(2);
            //     var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            //     $('#slipcommission').val(real_sum);

            // }
        }else{
            var commision =  parseFloat($('#slipcommissionendorsement').val()) / 100;
            var feebroker = parseFloat($('#slipvbrokerendorsement').val()) / 100;
            var sumgrossprmtonr = $("#slipgrossprmtonrendorsement").val();
            var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr.replace(/,/g, ""));

            var sum = isNaN(commision * conv_sumgrossprmtonr) ? 0 :(commision * conv_sumgrossprmtonr).toFixed(2);
            var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipsumcommissionendorsement').val(real_sum);
            $('#slipsumcommissionendorsement2').val(real_sum);
        }
   });

   $('#slipsumcommissionendorsement2').keypress(function(e){
        var keyCode = e.keyCode || e.which; 

        if (keyCode != 9) {
            // $('#slipsumcommission').val($(this).val());
            // var sumcommision =  $('#slipsumcommission').val();
            // var conv_sumcommision = parseFloat(sumcommision.replace(/,/g, ""));
            // var commisionval =  $('#slipcommission').val();
            // var feebroker = parseFloat($('#slipvbroker').val()) / 100;
            // var sumgrossprmtonr2 = $("#slipgrossprmtonr").val();
            // var conv_sumgrossprmtonr2 = parseFloat(sumgrossprmtonr2.replace(/,/g, ""));

            // if(commisionval != null){
            //     var sum = isNaN((conv_sumcommision / conv_sumgrossprmtonr2)*100) ? 0 :((conv_sumcommision / conv_sumgrossprmtonr2)*100).toFixed(2);
            //     var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            //     $('#slipcommission').val(real_sum);

            // }
        }else{
            var commision =  parseFloat($('#slipcommissionendorsement').val()) / 100;
            var feebroker = parseFloat($('#slipvbrokerendorsement').val()) / 100;
            var sumgrossprmtonr = $("#slipgrossprmtonrendorsement").val();
            var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr.replace(/,/g, ""));

            var sum = isNaN(commision * conv_sumgrossprmtonr) ? 0 :(commision * conv_sumgrossprmtonr).toFixed(2);
            var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipsumcommissionendorsement').val(real_sum);
            $('#slipsumcommissionendorsement2').val(real_sum);
        }
   });




   $('#slipvbrokerendorsement').keyup(function(e){
            var keyCode = e.keyCode || e.which; 

        if (keyCode != 9) {

            var netprm_to_nr = $('#slipnetprmtonrendorsement').val();
        
            var feebroker = parseFloat($('#slipvbrokerendorsement').val()) / 100;
            var commision =  parseFloat($('#slipcommissionendorsement').val()) / 100;
            var sumgrossprmtonr = $("#slipgrossprmtonrendorsement").val();
            var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr.replace(/,/g, ""));

            var sumfeebroker = isNaN( conv_sumgrossprmtonr * feebroker) ? 0 :(conv_sumgrossprmtonr * feebroker).toFixed(2);
            var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipsumfeeendorsement').val(real_sumfeebroker);
            $('#slipsumfeeendorsement2').val(real_sumfeebroker);

            var sumnetprmtonr = isNaN( conv_sumgrossprmtonr * (100/100 - commision - feebroker)) ? 0 :(conv_sumgrossprmtonr * (100/100 - commision - feebroker)).toFixed(2);
            var real_sumnetprmtonr = sumnetprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipnetprmtonrendorsement').val(real_sumnetprmtonr);
            $('#slipnetprmtonrendorsement2').val(real_sumnetprmtonr);

        }else{
            var netprm_to_nr = $('#slipnetprmtonrendorsement').val();
        
            var feebroker = parseFloat($('#slipvbrokerendorsement').val()) / 100;
            var commision =  parseFloat($('#slipcommissionendorsement').val()) / 100;
            var sumgrossprmtonr = $("#slipgrossprmtonrendorsement").val();
            var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr.replace(/,/g, ""));

            var sumfeebroker = isNaN( conv_sumgrossprmtonr * feebroker) ? 0 :(conv_sumgrossprmtonr * feebroker).toFixed(2);
            var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipsumfeeendorsement').val(real_sumfeebroker);
            $('#slipsumfeeendorsement2').val(real_sumfeebroker);

            var sumnetprmtonr = isNaN( conv_sumgrossprmtonr * (100/100 - commision - feebroker)) ? 0 :(conv_sumgrossprmtonr * (100/100 - commision - feebroker)).toFixed(2);
            var real_sumnetprmtonr = sumnetprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipnetprmtonrendorsement').val(real_sumnetprmtonr);
            $('#slipnetprmtonrendorsement2').val(real_sumnetprmtonr);
        }
    });

   $('#slipvbrokerendorsement').keydown(function(e){
            var keyCode = e.keyCode || e.which; 

        if (keyCode != 9) {

            var netprm_to_nr = $('#slipnetprmtonrendorsement').val();
        
            var feebroker = parseFloat($('#slipvbrokerendorsement').val()) / 100;
            var commision =  parseFloat($('#slipcommissionendorsement').val()) / 100;
            var sumgrossprmtonr = $("#slipgrossprmtonrendorsement").val();
            var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr.replace(/,/g, ""));

            var sumfeebroker = isNaN( conv_sumgrossprmtonr * feebroker) ? 0 :(conv_sumgrossprmtonr * feebroker).toFixed(2);
            var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipsumfeeendorsement').val(real_sumfeebroker);
            $('#slipsumfeeendorsement2').val(real_sumfeebroker);

            var sumnetprmtonr = isNaN( conv_sumgrossprmtonr * (100/100 - commision - feebroker)) ? 0 :(conv_sumgrossprmtonr * (100/100 - commision - feebroker)).toFixed(2);
            var real_sumnetprmtonr = sumnetprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipnetprmtonrendorsement').val(real_sumnetprmtonr);
            $('#slipnetprmtonrendorsement2').val(real_sumnetprmtonr);

        }else{
            var netprm_to_nr = $('#slipnetprmtonrendorsement').val();
        
            var feebroker = parseFloat($('#slipvbrokerendorsement').val()) / 100;
            var commision =  parseFloat($('#slipcommissionendorsement').val()) / 100;
            var sumgrossprmtonr = $("#slipgrossprmtonrendorsement").val();
            var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr.replace(/,/g, ""));

            var sumfeebroker = isNaN( conv_sumgrossprmtonr * feebroker) ? 0 :(conv_sumgrossprmtonr * feebroker).toFixed(2);
            var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipsumfeeendorsement').val(real_sumfeebroker);
            $('#slipsumfeeendorsement2').val(real_sumfeebroker);

            var sumnetprmtonr = isNaN( conv_sumgrossprmtonr * (100/100 - commision - feebroker)) ? 0 :(conv_sumgrossprmtonr * (100/100 - commision - feebroker)).toFixed(2);
            var real_sumnetprmtonr = sumnetprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipnetprmtonrendorsement').val(real_sumnetprmtonr);
            $('#slipnetprmtonrendorsement2').val(real_sumnetprmtonr);
        }
    });

   $('#slipvbrokerendorsement').keypress(function(e){
            var keyCode = e.keyCode || e.which; 

        if (keyCode != 9) {

            var netprm_to_nr = $('#slipnetprmtonrendorsement').val();
        
            var feebroker = parseFloat($('#slipvbrokerendorsement').val()) / 100;
            var commision =  parseFloat($('#slipcommissionendorsement').val()) / 100;
            var sumgrossprmtonr = $("#slipgrossprmtonrendorsement").val();
            var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr.replace(/,/g, ""));

            var sumfeebroker = isNaN( conv_sumgrossprmtonr * feebroker) ? 0 :(conv_sumgrossprmtonr * feebroker).toFixed(2);
            var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipsumfeeendorsement').val(real_sumfeebroker);
            $('#slipsumfeeendorsement2').val(real_sumfeebroker);

            var sumnetprmtonr = isNaN( conv_sumgrossprmtonr * (100/100 - commision - feebroker)) ? 0 :(conv_sumgrossprmtonr * (100/100 - commision - feebroker)).toFixed(2);
            var real_sumnetprmtonr = sumnetprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipnetprmtonrendorsement').val(real_sumnetprmtonr);
            $('#slipnetprmtonrendorsement2').val(real_sumnetprmtonr);

        }else{
            var netprm_to_nr = $('#slipnetprmtonrendorsement').val();
        
            var feebroker = parseFloat($('#slipvbrokerendorsement').val()) / 100;
            var commision =  parseFloat($('#slipcommissionendorsement').val()) / 100;
            var sumgrossprmtonr = $("#slipgrossprmtonrendorsement").val();
            var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr.replace(/,/g, ""));

            var sumfeebroker = isNaN( conv_sumgrossprmtonr * feebroker) ? 0 :(conv_sumgrossprmtonr * feebroker).toFixed(2);
            var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipsumfeeendorsement').val(real_sumfeebroker);
            $('#slipsumfeeendorsement2').val(real_sumfeebroker);

            var sumnetprmtonr = isNaN( conv_sumgrossprmtonr * (100/100 - commision - feebroker)) ? 0 :(conv_sumgrossprmtonr * (100/100 - commision - feebroker)).toFixed(2);
            var real_sumnetprmtonr = sumnetprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipnetprmtonrendorsement').val(real_sumnetprmtonr);
            $('#slipnetprmtonrendorsement2').val(real_sumnetprmtonr);
        }
    });
 

   $('#slipsumfeeendorsement2').keyup(function(e){
        var keyCode = e.keyCode || e.which; 

        if (keyCode != 9) {
            var netprm_to_nr = $('#slipnetprmtonrendorsement').val();
            $('#slipsumfeeendorsement').val($(this).val());
            
            var commision =  parseFloat($('#slipcommissionendorsement').val());
            var sumgrossprmtonr = $("#slipgrossprmtonrendorsement").val();
            var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr.replace(/,/g, ""));
            var netprm_to_nr = $('#slipnetprmtonrendorsement').val();
            var sumfeebroker2 = $('#slipsumfeeendorsement').val();
            var conv_sumfeebroker = parseFloat(sumfeebroker2.replace(/,/g, ""));
            var feebrokerval = $('#slipvbrokerendorsement').val();

            // if(feebrokerval != null){
                var sumvbroker = isNaN((conv_sumfeebroker / conv_sumgrossprmtonr)*100) ? 0 :((conv_sumfeebroker / conv_sumgrossprmtonr)*100).toFixed(2);
                var real_sumvbroker = sumvbroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                $('#slipvbrokerendorsement').val(real_sumvbroker);

                var feebroker = parseFloat($('#slipvbrokerendorsement').val());
                var sumnetprmtonr = isNaN( conv_sumgrossprmtonr * ((100 - commision - feebroker)/100)) ? 0 :(conv_sumgrossprmtonr * ((100 - commision - feebroker)/100)).toFixed(2);
                var real_sumnetprmtonr = sumnetprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                $('#slipnetprmtonrendorsement').val(real_sumnetprmtonr);
                $('#slipnetprmtonrendorsement2').val(real_sumnetprmtonr);

            // }
            
        }else{
            var netprm_to_nr = $('#slipnetprmtonrendorsement').val();
        
            var feebroker = parseFloat($('#slipvbrokerendorsement').val()) / 100;
            var commision =  parseFloat($('#slipcommissionendorsement').val()) / 100;
            var sumgrossprmtonr = $("#slipgrossprmtonrendorsement").val();
            var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr.replace(/,/g, ""));

            var sumfeebroker = isNaN( conv_sumgrossprmtonr * feebroker) ? 0 :(conv_sumgrossprmtonr * feebroker).toFixed(2);
            var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipsumfeeendorsement').val(real_sumfeebroker);
            $('#slipsumfeeendorsement2').val(real_sumfeebroker);
        }
   });

   $('#slipsumfeeendorsement2').keydown(function(e){
        var keyCode = e.keyCode || e.which; 

        if (keyCode != 9) {
            // var netprm_to_nr = $('#slipnetprmtonr').val();
            // $('#slipsumfee').val($(this).val());
            // var feebroker = parseFloat($('#slipvbroker').val()) / 100;
            // var commision =  parseFloat($('#slipcommission').val()) / 100;
            // var sumgrossprmtonr = $("#slipgrossprmtonr").val();
            // var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr.replace(/,/g, ""));
            // var netprm_to_nr = $('#slipnetprmtonr').val();
            // var sumfeebroker2 = $('#slipsumfee').val();
            // var conv_sumfeebroker = parseFloat(sumfeebroker2.replace(/,/g, ""));
            // var feebrokerval = $('#slipvbroker').val();

            // if(feebrokerval != null){
            //     var sumvbroker = isNaN((conv_sumfeebroker / conv_sumgrossprmtonr)*100) ? 0 :((conv_sumfeebroker / conv_sumgrossprmtonr)*100).toFixed(2);
            //     var real_sumvbroker = sumvbroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            //     $('#slipvbroker').val(real_sumvbroker);
            // }
            
        }else{
            var netprm_to_nr = $('#slipnetprmtonrendorsement').val();
        
            var feebroker = parseFloat($('#slipvbrokerendorsement').val()) / 100;
            var commision =  parseFloat($('#slipcommissionendorsement').val()) / 100;
            var sumgrossprmtonr = $("#slipgrossprmtonrendorsement").val();
            var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr.replace(/,/g, ""));

            var sumfeebroker = isNaN( conv_sumgrossprmtonr * feebroker) ? 0 :(conv_sumgrossprmtonr * feebroker).toFixed(2);
            var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipsumfeeendorsement').val(real_sumfeebroker);
            $('#slipsumfeeendorsement2').val(real_sumfeebroker);
        }
   });

   $('#slipsumfeeendorsement2').keypress(function(e){
        var keyCode = e.keyCode || e.which; 

        if (keyCode != 9) {
            // var netprm_to_nr = $('#slipnetprmtonr').val();
            // $('#slipsumfee').val($(this).val());
            // var feebroker = parseFloat($('#slipvbroker').val()) / 100;
            // var commision =  parseFloat($('#slipcommission').val()) / 100;
            // var sumgrossprmtonr = $("#slipgrossprmtonr").val();
            // var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr.replace(/,/g, ""));
            // var netprm_to_nr = $('#slipnetprmtonr').val();
            // var sumfeebroker2 = $('#slipsumfee').val();
            // var conv_sumfeebroker = parseFloat(sumfeebroker2.replace(/,/g, ""));
            // var feebrokerval = $('#slipvbroker').val();

            // if(feebrokerval != null){
            //     var sumvbroker = isNaN((conv_sumfeebroker / conv_sumgrossprmtonr)*100) ? 0 :((conv_sumfeebroker / conv_sumgrossprmtonr)*100).toFixed(2);
            //     var real_sumvbroker = sumvbroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            //     $('#slipvbroker').val(real_sumvbroker);
            // }
            
        }else{
           var netprm_to_nr = $('#slipnetprmtonrendorsement').val();
        
            var feebroker = parseFloat($('#slipvbrokerendorsement').val()) / 100;
            var commision =  parseFloat($('#slipcommissionendorsement').val()) / 100;
            var sumgrossprmtonr = $("#slipgrossprmtonrendorsement").val();
            var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr.replace(/,/g, ""));

            var sumfeebroker = isNaN( conv_sumgrossprmtonr * feebroker) ? 0 :(conv_sumgrossprmtonr * feebroker).toFixed(2);
            var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipsumfeeendorsement').val(real_sumfeebroker);
            $('#slipsumfeeendorsement2').val(real_sumfeebroker);
        }
   });

   $('#slipvbrokerendorsement').change(function(){

        if( $('#installmentPanel tbody').find('tr').val().length > 0){
            swal('warning!','netprm to nr changed, please change installment amount manually','success')
        }

   });

   $('#slipippercentageendorsement').keyup(function (e) {
        var keyCode = e.keyCode || e.which; 

        if(keyCode != 9){
            var percent =  parseFloat($(this).val()) / 100;

            var sumnetprtonr = $("#slipnetprmtonrendorsement").val();
            var conv_sumnetprtonr = parseFloat(sumnetprtonr.replace(/,/g, ""));

            var sum = isNaN(percent *  conv_sumnetprtonr) ? 0 :(percent *  conv_sumnetprtonr).toFixed(2);
            var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipipamountendorsement').val(real_sum);
            // $('#slipipamount2').val(real_sum);
        }else{
            var percent =  parseFloat($(this).val()) / 100;

            var sumnetprtonr = $("#slipnetprmtonrendorsement").val();
            var conv_sumnetprtonr = parseFloat(sumnetprtonr.replace(/,/g, ""));

            var sum = isNaN(percent *  conv_sumnetprtonr) ? 0 :(percent *  conv_sumnetprtonr).toFixed(2);
            var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipipamountendorsement').val(real_sum);
        }
    });

   $('#slipippercentageendorsement').keydown(function (e) {
        var keyCode = e.keyCode || e.which;

        if(keyCode != 9){
            var percent =  parseFloat($(this).val()) / 100;

            var sumnetprtonr = $("#slipnetprmtonrendorsement").val();
            var conv_sumnetprtonr = parseFloat(sumnetprtonr.replace(/,/g, ""));

            var sum = isNaN(percent *  conv_sumnetprtonr) ? 0 :(percent *  conv_sumnetprtonr).toFixed(2);
            var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipipamountendorsement').val(real_sum);
            // $('#slipipamount2').val(real_sum);
        }else{
            var percent =  parseFloat($(this).val()) / 100;

            var sumnetprtonr = $("#slipnetprmtonrendorsement").val();
            var conv_sumnetprtonr = parseFloat(sumnetprtonr.replace(/,/g, ""));

            var sum = isNaN(percent *  conv_sumnetprtonr) ? 0 :(percent *  conv_sumnetprtonr).toFixed(2);
            var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipipamountendorsement').val(real_sum);
        }
    });

   $('#slipippercentageendorsement').keypress(function (e) {
        var keyCode = e.keyCode || e.which;

        if(keyCode != 9){
            var percent =  parseFloat($(this).val()) / 100;

            var sumnetprtonr = $("#slipnetprmtonrendorsement").val();
            var conv_sumnetprtonr = parseFloat(sumnetprtonr.replace(/,/g, ""));

            var sum = isNaN(percent *  conv_sumnetprtonr) ? 0 :(percent *  conv_sumnetprtonr).toFixed(2);
            var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipipamountendorsement').val(real_sum);
            // $('#slipipamount2').val(real_sum);
        }else{
            var percent =  parseFloat($(this).val()) / 100;

            var sumnetprtonr = $("#slipnetprmtonrendorsement").val();
            var conv_sumnetprtonr = parseFloat(sumnetprtonr.replace(/,/g, ""));

            var sum = isNaN(percent *  conv_sumnetprtonr) ? 0 :(percent *  conv_sumnetprtonr).toFixed(2);
            var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipipamountendorsement').val(real_sum);
        }
    });

   $('#slipippercentageendorsement').change(function (e) {
        var keyCode = e.keyCode || e.which;

        if(keyCode != 9){
            var percent =  parseFloat($(this).val()) / 100;

            var sumnetprtonr = $("#slipnetprmtonrendorsement").val();
            var conv_sumnetprtonr = parseFloat(sumnetprtonr.replace(/,/g, ""));

            var sum = isNaN(percent *  conv_sumnetprtonr) ? 0 :(percent *  conv_sumnetprtonr).toFixed(2);
            var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipipamountendorsement').val(real_sum);
            // $('#slipipamount2').val(real_sum);
        }else{
            var percent =  parseFloat($(this).val()) / 100;

            var sumnetprtonr = $("#slipnetprmtonrendorsement").val();
            var conv_sumnetprtonr = parseFloat(sumnetprtonr.replace(/,/g, ""));

            var sum = isNaN(percent *  conv_sumnetprtonr) ? 0 :(percent *  conv_sumnetprtonr).toFixed(2);
            var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipipamountendorsement').val(real_sum);
        }
    });

   $('#slipipamountendorsement').change(function(e){
        var keyCode = e.keyCode || e.which;    

        if(keyCode != 9){
                var amount =  $(this).val();
                var conv_amount = parseFloat(amount.replace(/,/g, ""));
                console.log(amount)
                console.log(conv_amount)
                var sumnetprtonr = $("#slipnetprmtonrendorsement").val();
                var conv_sumnetprtonr = parseFloat(sumnetprtonr.replace(/,/g, ""));

                var sum = isNaN((conv_amount /  conv_sumnetprtonr) * 100) ? 0 :((conv_amount /  conv_sumnetprtonr) * 100).toFixed(2);
                var real_sum = sum.toString();
                console.log(sum)
                console.log(real_sum)

                $('#slipippercentageendorsement').val(real_sum);
                // $('#slipipamount2').val(real_sum);
            }else{
                 var amount =  $(this).val();
                var conv_amount = parseFloat(amount.replace(/,/g, ""));
                console.log(amount)
                console.log(conv_amount)
                var sumnetprtonr = $("#slipnetprmtonrendorsement").val();
                var conv_sumnetprtonr = parseFloat(sumnetprtonr.replace(/,/g, ""));
                
                var sum = isNaN((conv_amount /  conv_sumnetprtonr) * 100) ? 0 :((conv_amount /  conv_sumnetprtonr) * 100).toFixed(2);
                var real_sum = sum.toString();
                console.log(sum)
                console.log(real_sum)
                $('#slipippercentageendorsement').val(real_sum);
            }
   });

   $('#slipipamountendorsement').keyup(function(e){
        var keyCode = e.keyCode || e.which;

        if(keyCode != 9){
            //  var percent =  parseFloat($("#slipippercentage").val()) / 100;

            // var sumnetprtonr = $("#slipnetprmtonr").val();
            // var conv_sumnetprtonr = parseFloat(sumnetprtonr.replace(/,/g, ""));

            // var sum = isNaN(percent *  conv_sumnetprtonr) ? 0 :(percent *  conv_sumnetprtonr).toFixed(2);
            // var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            // $('#slipipamount').val(real_sum);

        }else{      
                 var percent =  parseFloat($("#slipippercentageendorsement").val()) / 100;

            var sumnetprtonr = $("#slipnetprmtonrendorsement").val();
            var conv_sumnetprtonr = parseFloat(sumnetprtonr.replace(/,/g, ""));

            var sum = isNaN(percent *  conv_sumnetprtonr) ? 0 :(percent *  conv_sumnetprtonr).toFixed(2);
            var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipipamountendorsement').val(real_sum);
        }
   });

   $('#slipipamountendorsement').keypress(function(e){
        var keyCode = e.keyCode || e.which;

        if(keyCode != 9){
               // var percent =  parseFloat($("#slipippercentage").val()) / 100;

               //  var sumnetprtonr = $("#slipnetprmtonr").val();
               //  var conv_sumnetprtonr = parseFloat(sumnetprtonr.replace(/,/g, ""));

               //  var sum = isNaN(percent *  conv_sumnetprtonr) ? 0 :(percent *  conv_sumnetprtonr).toFixed(2);
               //  var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

               //  $('#slipipamount').val(real_sum);
            }else{
                 var percent =  parseFloat($("#slipippercentageendorsement").val()) / 100;

                var sumnetprtonr = $("#slipnetprmtonrendorsement").val();
                var conv_sumnetprtonr = parseFloat(sumnetprtonr.replace(/,/g, ""));

                var sum = isNaN(percent *  conv_sumnetprtonr) ? 0 :(percent *  conv_sumnetprtonr).toFixed(2);
                var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                $('#slipipamountendorsement').val(real_sum);
            }
   });

   $('#slipipamountendorsement').keydown(function(e){
        var keyCode = e.keyCode || e.which;

        if(keyCode != 9){
                // var percent =  parseFloat($("#slipippercentage").val()) / 100;

                // var sumnetprtonr = $("#slipnetprmtonr").val();
                // var conv_sumnetprtonr = parseFloat(sumnetprtonr.replace(/,/g, ""));

                // var sum = isNaN(percent *  conv_sumnetprtonr) ? 0 :(percent *  conv_sumnetprtonr).toFixed(2);
                // var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                // $('#slipipamount').val(real_sum);
                // $('#slipipamount2').val(real_sum);
            }else{
                var percent =  parseFloat($("#slipippercentageendorsement").val()) / 100;

                var sumnetprtonr = $("#slipnetprmtonrendorsement").val();
                var conv_sumnetprtonr = parseFloat(sumnetprtonr.replace(/,/g, ""));

                var sum = isNaN(percent *  conv_sumnetprtonr) ? 0 :(percent *  conv_sumnetprtonr).toFixed(2);
                var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                $('#slipipamountendorsement').val(real_sum);
            }
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
                $('#slipsumorendorsement').val(real_sum);
                $('#slipsumorendorsement2').val(real_sum);
            }

            


        }
    });

   $('#sliprppercentageendorsement').keyup(function (e) {
    if(e.keyCode != 9){
        var percentval =  parseFloat($(this).val()) / 100;
        var sumshare = $('#slipsumshareendorsement').val() ;
        var conv_sumshare = parseFloat(sumshare.replace(/,/g, ""));
        var sumrpamount = isNaN(percentval * conv_sumshare) ? 0 :(percentval * conv_sumshare).toFixed(2);
        var real_sumrpamount = sumrpamount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            // var sumpercentor = isNaN(orpercent - percentval) ? 0 :(orpercent - percentval); 
            // $('#slipor').val(sumpercentor);
            $('#sliprpamountendorsement').val(real_sumrpamount);
            $('#sliprpamountendorsement2').val(real_sumrpamount);
        }
    });

   $('#sliprppercentageendorsement').change(function (e) {
        if(e.keyCode != 9){
            var percentval =  parseFloat($(this).val());
            var orpercent = parseFloat($('#sliporendorsement').val());
            var sumpercentor = isNaN(orpercent - percentval) ? 0 :(orpercent - percentval).toFixed(2);
            $('#sliporendorsement').val(sumpercentor);

            var percent =  parseFloat($('#sliporendorsement').val()) / 100;
            var sumshare = $("#slipsumshareendorsement").val();
            var conv_sumshare = parseFloat(sumshare.replace(/,/g, ""));

            var sum = isNaN(percent * conv_sumshare) ? 0 :(percent * conv_sumshare).toFixed(2);
            var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#slipsumorendorsement').val(real_sum);
            $('#slipsumorendorsement2').val(real_sum);
        }
    });

   $('#slipnilaiecendorsement').keyup(function () {
        var persentage =  parseFloat($('#slipnilaiecendorsement').val()) / 1000;
        var sliptotalsum =  $('#sliptotalsumendorsement').val();
        var conv_sliptotalsum = parseFloat(sliptotalsum.replace(/,/g, ""));
       //alert(premiumnr);
       //alert(persentage);
        var sum = isNaN(conv_sliptotalsum * persentage) ? 0 :(conv_sliptotalsum * persentage).toFixed(2) ;
        var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
       //alert(sum);
        console.log($(this).val())
        console.log(persentage)
        console.log(sum)
        console.log(real_sum)

        $('#slipamountecendorsement').val(real_sum);
        $('#slipamountecendorsement2').val(real_sum);
   });
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
       var sliptype = 'mp';
        var countendorsement = 0;
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
                        var curr_amount = str_amount.replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                        var currdate = response.installment_date;
                        var convdate = currdate.split("-").reverse().join("/");
                        console.log('conv date ' + convdate)
                        var strdate = convdate.toString();

                        var conv_percent = parseFloat(response.percentage).toFixed(2);
                        
                        $('#installmentPanel tbody').prepend('<tr id="iidinstallment'+response.id+'" data-name="installmentvalue[]"><td data-name="'+response.installment_date+'">'+strdate+'</td><td data-name="'+response.percentage+'">'+conv_percent+'</td><td data-name="'+response.amount+'">'+curr_amount+'</td><td><a href="javascript:void(0)" onclick="deleteinstallmentdetail('+response.id+')">delete</a></td></tr>')
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
                    }

                   //var total =  parseFloat($("#sliptotalsum").val());
                   //var sum = isNaN(total + parseFloat(response.amount)) ? 0 :(total + parseFloat(response.amount)) ;
                   //$("#sliptotalsum").val(sum);

               }
           });
       }else{
        swal('warning!','installment date cannot be lower than prod date / document date','validation error');
       }

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
       var sliptype = 'mp';
        var countendorsement = $('#countendorsmentupdate').val();
        
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
                        
                        var str_amount = response.amount.toString();
                        var curr_amount = str_amount.replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                        var currdate = response.installment_date;
                        var convdate = currdate.split("-").reverse().join("/");
                        console.log('conv date ' + convdate)
                        var strdate = convdate.toString();

                        var conv_percent = parseFloat(response.percentage).toFixed(2);
                        
                        $('#installmentPanelupdate tbody').prepend('<tr id="iidinstallmentupdate'+response.id+'" data-name="installmentvalue[]"><td data-name="'+response.installment_date+'">'+strdate+'</td><td data-name="'+response.percentage+'">'+conv_percent+'</td><td data-name="'+response.amount+'">'+curr_amount+'</td><td><a href="javascript:void(0)" onclick="deleteinstallmentupdate('+response.id+')">delete</a></td></tr>')
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

                                if(parseInt(total_percent2)>=100)
                                {
                                    $('#addinstallmentinsuredupdate-btn').attr('hidden','true');
                                }
                        }else{
                            var sum_percent = isNaN(parseFloat(total_percent) + parseFloat(response.percentage)) ? 0 :(parseFloat(total_percent) + parseFloat(response.percentage))
                            $('#sliptotalpercentinspanupdate').val(sum_percent.toString());
                            console.log($('#sliptotalpercentinspanupdate').val())
                            
                            var total_percent2 =  $('#sliptotalpercentinspan').val();

                                if(parseInt(total_percent2)>=100)
                                {
                                    $('#addinstallmentinsuredupdate-btn').attr('hidden','true');
                                }
                        }
                        }
                        $('#slipipdateupdate').val('');
                        $('#slipipdateupdate').focus();

                   //var total =  parseFloat($("#sliptotalsum").val());
                   //var sum = isNaN(total + parseFloat(response.amount)) ? 0 :(total + parseFloat(response.amount)) ;
                   //$("#sliptotalsum").val(sum);

               }
           });
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
       var sliptype = 'mp';
        var countendorsement = $('#countendorsmentdata').val();
       
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
                        
                        var str_amount = response.amount.toString();
                        var curr_amount = str_amount.replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                        var currdate = response.installment_date;
                        var convdate = currdate.split("-").reverse().join("/");
                        console.log('conv date ' + convdate)
                        var strdate = convdate.toString();

                        var conv_percent = parseFloat(response.percentage).toFixed(2);
                        
                        $('#installmentPanelendorsement tbody').prepend('<tr id="iidinstallmentendorsement'+response.id+'" data-name="installmentvalue[]"><td data-name="'+response.installment_date+'">'+strdate+'</td><td data-name="'+response.percentage+'">'+conv_percent+'</td><td data-name="'+response.amount+'">'+curr_amount+'</td><td><a href="javascript:void(0)" onclick="deleteinstallmentendorsement('+response.id+')">delete</a></td></tr>')
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

                if(parseInt(total_percent2)<100)
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
    $('#adddeductibleinsured-btn').click(function(e){
       //alert('masuk');
           e.preventDefault();

           var slipdptype = $('#slipdptype').val();
           // var slipdpcurrency = $('#slipdpcurrency').val();
           
           var percentage = $('#slipdppercentage').val();
           var amount = $('#slipdpamount').val();
           var minamount = $('#slipdpminamount').val();
           var code_ms = $('#insuredIDtxt').val();
           var sliptype = 'mp';
           var countendorsement = 0;
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
                var curr_amount = response.amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                //    var curr_minamount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(response.min_claimamount);
                var curr_minamount = response.min_claimamount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('#deductiblePanel tbody').prepend('<tr id="iiddeductible'+response.id+'" data-name="deductiblevalue[]"><td data-name="'+response.deductibletype+'">'+response.deductibletype+'</td><td data-name="'+response.percentage+'">'+response.percentage+'</td><td data-name="'+response.amount+'">'+curr_amount+'</td><td data-name="'+curr_minamount+'">'+curr_minamount+'</td><td><a href="javascript:void(0)" onclick="deletedeductibledetail('+response.id+')">delete</a></td></tr>');
                $('#slipdppercentage').val('');
                $('#slipdpamount').val('');
                $('#slipdpamount2').val('');
                $('#slipdpminamount').val('');

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
           var sliptype = 'mp';
           var countendorsement = $('#countendorsmentupdate').val();
           
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
             countendorsement:countendorsement,
             sliptype:sliptype
         },
         beforeSend: function() { $("body").addClass("loading");  },
         complete: function() {  $("body").removeClass("loading"); },
         success:function(response)
         {

             console.log(response)
                //    var curr_amount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(response.amount);
                var curr_amount = response.amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                //    var curr_minamount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(response.min_claimamount);
                var curr_minamount = response.min_claimamount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('#deductiblePanelupdate tbody').prepend('<tr id="iiddeductibleupdate'+response.id+'" data-name="deductiblevalue[]"><td data-name="'+response.deductibletype+'">'+response.deductibletype+'</td><td data-name="'+response.percentage+'">'+response.percentage+'</td><td data-name="'+response.amount+'">'+curr_amount+'</td><td data-name="'+curr_minamount+'">'+curr_minamount+'</td><td><a href="javascript:void(0)" onclick="deletedeductibleupdate('+response.id+')">delete</a></td></tr>');
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
           var sliptype = 'mp';
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
                var curr_amount = response.amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                //    var curr_minamount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(response.min_claimamount);
                var curr_minamount = response.min_claimamount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('#deductiblePanelendorsement tbody').prepend('<tr id="iiddeductibleendorsement'+response.id+'" data-name="deductiblevalue[]"><td data-name="'+response.deductibletype+'">'+response.deductibletype+'</td><td data-name="'+response.percentage+'">'+response.percentage+'</td><td data-name="'+response.amount+'">'+curr_amount+'</td><td data-name="'+curr_minamount+'">'+curr_minamount+'</td><td><a href="javascript:void(0)" onclick="deletedeductibleendorsement('+response.id+')">delete</a></td></tr>');
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

       var slipcncode = $('#slipcncode').val();
       var percentage = $('#slipnilaiec').val();
       var amount = $('#slipamountec').val();
       var code_ms = $('#insuredIDtxt').val();
       var sliptype = 'mp';      
       var countendorsement = 0;
       var slip_id = $('#slipnumber').val();
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
                //    var curr_amount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(response.amount);
                var curr_amount = response.amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('#ExtendCoveragePanel tbody').prepend('<tr id="iidextendcoverage'+response.id+'" data-name="extendcoveragevalue[]"><td data-name="'+response.coveragetype+'">' +response.coveragecode+ ' - ' +response.coveragename+'</td><td data-name="'+response.percentage+'">'+response.percentage+'</td><td data-name="'+response.amount+'">'+curr_amount+'</td><td><a href="javascript:void(0)" onclick="deleteextendcoveragedetail('+response.id+')">delete</a></td></tr>');
                

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

                        try {
                            var insurance_period_from2 = $('#sliprpfrom').val();
                            var insurance_period_to2 = $('#sliprpto').val();
                            var newinsurance_period_from2 = insurance_period_from2.split("/").reverse().join("-");
                            var newinsurance_period_to2 = insurance_period_to2.split("/").reverse().join("-");
                            var days=daysBetween(newinsurance_period_from2, newinsurance_period_to2);
                            var insurance = (days/365);

                            var tsi = $("#sharetotalsum").val();
                            var conv_tsi = parseFloat(tsi.replace(/,/g, ""));
                            var sumrate = $("#sliptotalrate").val();
                            var conv_sumrate = parseFloat(sumrate.replace(/,/g, ""));
                            var sum = isNaN(((conv_sumrate / 1000) * conv_tsi) * insurance) ? 0 :(((conv_sumrate / 1000) * conv_tsi) * insurance).toFixed(2) ;
                            var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                            $('#slipbasicpremium').val(real_sum);
                        
                        
                            var basic_premi = $('#slipbasicpremium').val();

                            if(basic_premi){
                                var bpinsurance_period_from2 = $('#sliprpfrom').val();
                                var bpinsurance_period_to2 = $('#sliprpto').val();
                                var bpnewinsurance_period_from2 = bpinsurance_period_from2.split("/").reverse().join("-");
                                var bpnewinsurance_period_to2 = bpinsurance_period_to2.split("/").reverse().join("-");
                                var bpdays=daysBetween(bpnewinsurance_period_from2, bpnewinsurance_period_to2);
                                var bpinsurance = (bpdays/365);
                                
                                console.log(bpinsurance_period_from2)
                                console.log(bpinsurance_period_to2)
                                console.log(bpnewinsurance_period_from2)
                                console.log(bpnewinsurance_period_to2)
                                console.log(bpdays)
                                console.log(bpinsurance)

                                var bprateslip =  parseFloat($('#sliprate').val());
                                var bpsumrate = $("#sliptotalrate").val();
                                var bpconv_sumrate = parseFloat(bpsumrate.replace(/,/g, ""));
                                var bptsi = $("#sharetotalsum").val();
                                var bpconv_tsi = parseFloat(bptsi.replace(/,/g, ""));
                                var bpsum = isNaN(((bpconv_sumrate / 1000) * bpconv_tsi) * bpinsurance) ? 0 :(((bpconv_sumrate / 1000) * bpconv_tsi) * bpinsurance).toFixed(2) ;
                                var bpreal_sum = bpsum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                                $('#slipbasicpremium').val(bpreal_sum);

                                var share = $('#slipshare').val();
                                if(share){
                                    var shareslip =  parseFloat(share) / 100 ;
                                    var nasionalreinsurance =  $('#mpsharefrom').val();
                                    var totalnre =  $('#mpshareto').val();
                                    var conv_totalnre =  parseFloat(totalnre.replace(/,/g, ""));

                                    console.log('nre' + nasionalreinsurance)
                                        // console.log(conv_nasionalreinsurance)
                                    console.log('totalnre' + totalnre)
                                    console.log('convtotnre' + conv_totalnre)
                                    

                                    var sumshare = $('#slipsumshare').val() ;
                                    var conv_sumshare = parseFloat(sumshare.replace(/,/g, ""));

                                    
                                    var conv_basre = parseFloat(basic_premi.replace(/,/g, ""));

                                    var orpercent = $('#slipor').val() / 100;

                                    var sumor = isNaN(orpercent * conv_sumshare) ? 0 :(orpercent * conv_sumshare).toFixed(2);
                                    var real_sumor = sumor.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    
                                    var sumgprmtonr = isNaN(conv_basre * shareslip ) ? 0 :(conv_basre * shareslip ).toFixed(2);
                                    var real_sumgprmtonr= sumgprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    
                                    if(nasionalreinsurance){
                                        var conv_nasionalreinsurance =  parseFloat(nasionalreinsurance.replace(/,/g, ""));
                                        var sumnre = isNaN(conv_nasionalreinsurance + conv_sumshare ) ? 0 :(conv_nasionalreinsurance + conv_sumshare).toFixed(2) ;
                                        var real_sumnre = sumnre.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    }else{
                                        var conv_nasionalreinsurance =  parseFloat(nasionalreinsurance.replace(/,/g, ""));
                                        var sumnre = isNaN(0 + conv_sumshare ) ? 0 :(0 + conv_sumshare).toFixed(2) ;
                                        var real_sumnre = sumnre.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    }
                                    
                                    
                                    var sumourshare = isNaN((sumnre / conv_totalnre) * 100 ) ? 0 :((sumnre / conv_totalnre) * 100 ).toFixed(2) ;

                                    console.log('sumnre' + sumnre)
                                    console.log('realnre' + real_sumnre)
                                    console.log('sumourshare' + sumourshare)

                                    $('#slipgrossprmtonr').val(real_sumgprmtonr);
                                    $('#slipgrossprmtonr2').val(real_sumgprmtonr);
                                    $('#slipsumor').val(real_sumor);
                                    $('#slipsumor2').val(real_sumor);
                                    // $('#mpshare').val(sumourshare.replace(/,/g, "."));
                                    $('#mpsharefrom').val(real_sumnre);

                                    var slipsumcommissionval = $('#slipsumcommission').val();
                                    if(slipsumcommissionval != null){
                                        var commision =  parseFloat($('#slipcommission').val()) / 100;
                                        var feebroker = parseFloat($('#slipvbroker').val()) / 100;
                                        var sumgrossprmtonr = $("#slipgrossprmtonr").val();
                                        var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr.replace(/,/g, ""));

                                        var sumcomm = isNaN(commision * conv_sumgrossprmtonr) ? 0 :(commision * conv_sumgrossprmtonr).toFixed(2);
                                        var real_sumcomm = sumcomm.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                                        $('#slipsumcommission').val(real_sumcomm);
                                        $('#slipsumcommission2').val(real_sumcomm);

                                        var netprm_to_nr = $('#slipnetprmtonr').val();
                                        if(netprm_to_nr != null){


                                            var sumnetprmtonr = isNaN( conv_sumgrossprmtonr * (100/100 - commision - feebroker)) ? 0 :(conv_sumgrossprmtonr * (100/100 - commision - feebroker)).toFixed(2);
                                            var real_sumnetprmtonr = sumnetprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                                            var sumfeebroker = isNaN( conv_sumgrossprmtonr * feebroker) ? 0 :(conv_sumgrossprmtonr * feebroker).toFixed(2);
                                            var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


                                            $('#slipnetprmtonr').val(real_sumnetprmtonr);
                                            $('#slipnetprmtonr2').val(real_sumnetprmtonr);
                                            // $('#slipsumfee').val("100" + "-" + commision.toString() + "-" + feebroker.toString() + "*" + conv_sumgrossprmtonr.toString());
                                            $('#slipsumfee').val(real_sumfeebroker);
                                            $('#slipsumfee2').val(real_sumfeebroker);

                                            var retro_backup = $('#sliprb').val();
                                            if(retro_backup == 'YES'){
                                                swal('warning!','please change retrocession amount manually','success')
                                            }

                                        }

                                    }
                                }
                            }
                        }catch(err){
                            console.log(err)
                        }


                    }
                }else{
                    var sum_percent = isNaN(parseFloat(total_percent) + parseFloat(response.percentage)) ? 0 :(parseFloat(total_percent) + parseFloat(response.percentage))
                    $('#sliptotalnilaiec').val(sum_percent.toString());
                    console.log('total rate extend_coverage ' + $('#sliptotalnilaiec').val())
                    var total_rate = $('#sliptotalrate').val();
                    if(total_rate){
                        var sum_totalrate = isNaN(parseFloat(total_rate) + parseFloat(response.percentage)) ? 0 :(parseFloat(total_rate) + parseFloat(response.percentage)) ;
                        $('#sliptotalrate').val(sum_totalrate.toString());
                        $('#sliptotalrate2').val(sum_totalrate.toString());

                        try {

                            var insurance_period_from2 = $('#sliprpfrom').val();
                            var insurance_period_to2 = $('#sliprpto').val();
                            var newinsurance_period_from2 = insurance_period_from2.split("/").reverse().join("-");
                            var newinsurance_period_to2 = insurance_period_to2.split("/").reverse().join("-");
                            var days=daysBetween(newinsurance_period_from2, newinsurance_period_to2);
                            var insurance = (days/365);

                            var tsi = $("#sharetotalsum").val();
                            var conv_tsi = parseFloat(tsi.replace(/,/g, ""));
                            var sumrate = $("#sliptotalrate").val();
                            var conv_sumrate = parseFloat(sumrate.replace(/,/g, ""));
                            var sum = isNaN(((conv_sumrate / 1000) * conv_tsi) * insurance) ? 0 :(((conv_sumrate / 1000) * conv_tsi) * insurance).toFixed(2) ;
                            var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                            $('#slipbasicpremium').val(real_sum);
                        
                        
                            var basic_premi = $('#slipbasicpremium').val();

                            if(basic_premi){
                                var bpinsurance_period_from2 = $('#sliprpfrom').val();
                                var bpinsurance_period_to2 = $('#sliprpto').val();
                                var bpnewinsurance_period_from2 = bpinsurance_period_from2.split("/").reverse().join("-");
                                var bpnewinsurance_period_to2 = bpinsurance_period_to2.split("/").reverse().join("-");
                                var bpdays=daysBetween(bpnewinsurance_period_from2, bpnewinsurance_period_to2);
                                var bpinsurance = (bpdays/365);
                                
                                console.log(bpinsurance_period_from2)
                                console.log(bpinsurance_period_to2)
                                console.log(bpnewinsurance_period_from2)
                                console.log(bpnewinsurance_period_to2)
                                console.log(bpdays)
                                console.log(bpinsurance)

                                var bprateslip =  parseFloat($('#sliprate').val());
                                var bpsumrate = $("#sliptotalrate").val();
                                var bpconv_sumrate = parseFloat(bpsumrate.replace(/,/g, ""));
                                var bptsi = $("#sharetotalsum").val();
                                var bpconv_tsi = parseFloat(bptsi.replace(/,/g, ""));
                                var bpsum = isNaN(((bpconv_sumrate / 1000) * bpconv_tsi) * bpinsurance) ? 0 :(((bpconv_sumrate / 1000) * bpconv_tsi) * bpinsurance).toFixed(2) ;
                                var bpreal_sum = bpsum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                                $('#slipbasicpremium').val(bpreal_sum);

                                var share = $('#slipshare').val();
                                if(share){
                                    var shareslip =  parseFloat(share) / 100 ;
                                    var nasionalreinsurance =  $('#mpsharefrom').val();
                                    var totalnre =  $('#mpshareto').val();
                                    var conv_totalnre =  parseFloat(totalnre.replace(/,/g, ""));

                                    console.log('nre' + nasionalreinsurance)
                                        // console.log(conv_nasionalreinsurance)
                                    console.log('totalnre' + totalnre)
                                    console.log('convtotnre' + conv_totalnre)
                                    

                                    var sumshare = $('#slipsumshare').val() ;
                                    var conv_sumshare = parseFloat(sumshare.replace(/,/g, ""));

                                    
                                    var conv_basre = parseFloat(basic_premi.replace(/,/g, ""));

                                    var orpercent = $('#slipor').val() / 100;

                                    var sumor = isNaN(orpercent * conv_sumshare) ? 0 :(orpercent * conv_sumshare).toFixed(2);
                                    var real_sumor = sumor.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    
                                    var sumgprmtonr = isNaN(conv_basre * shareslip ) ? 0 :(conv_basre * shareslip ).toFixed(2);
                                    var real_sumgprmtonr= sumgprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    
                                    if(nasionalreinsurance){
                                        var conv_nasionalreinsurance =  parseFloat(nasionalreinsurance.replace(/,/g, ""));
                                        var sumnre = isNaN(conv_nasionalreinsurance + conv_sumshare ) ? 0 :(conv_nasionalreinsurance + conv_sumshare).toFixed(2) ;
                                        var real_sumnre = sumnre.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    }else{
                                        var conv_nasionalreinsurance =  parseFloat(nasionalreinsurance.replace(/,/g, ""));
                                        var sumnre = isNaN(0 + conv_sumshare ) ? 0 :(0 + conv_sumshare).toFixed(2) ;
                                        var real_sumnre = sumnre.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    }
                                    
                                    
                                    var sumourshare = isNaN((sumnre / conv_totalnre) * 100 ) ? 0 :((sumnre / conv_totalnre) * 100 ).toFixed(2) ;

                                    console.log('sumnre' + sumnre)
                                    console.log('realnre' + real_sumnre)
                                    console.log('sumourshare' + sumourshare)

                                    $('#slipgrossprmtonr').val(real_sumgprmtonr);
                                    $('#slipgrossprmtonr2').val(real_sumgprmtonr);
                                    $('#slipsumor').val(real_sumor);
                                    $('#slipsumor2').val(real_sumor);
                                    // $('#mpshare').val(sumourshare.replace(/,/g, "."));
                                    $('#mpsharefrom').val(real_sumnre);

                                    var slipsumcommissionval = $('#slipsumcommission').val();
                                    if(slipsumcommissionval != null){
                                        var commision =  parseFloat($('#slipcommission').val()) / 100;
                                        var feebroker = parseFloat($('#slipvbroker').val()) / 100;
                                        var sumgrossprmtonr = $("#slipgrossprmtonr").val();
                                        var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr.replace(/,/g, ""));

                                        var sumcomm = isNaN(commision * conv_sumgrossprmtonr) ? 0 :(commision * conv_sumgrossprmtonr).toFixed(2);
                                        var real_sumcomm = sumcomm.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                                        $('#slipsumcommission').val(real_sumcomm);
                                        $('#slipsumcommission2').val(real_sumcomm);

                                        var netprm_to_nr = $('#slipnetprmtonr').val();
                                        if(netprm_to_nr != null){


                                            var sumnetprmtonr = isNaN( conv_sumgrossprmtonr * (100/100 - commision - feebroker)) ? 0 :(conv_sumgrossprmtonr * (100/100 - commision - feebroker)).toFixed(2);
                                            var real_sumnetprmtonr = sumnetprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                                            var sumfeebroker = isNaN( conv_sumgrossprmtonr * feebroker) ? 0 :(conv_sumgrossprmtonr * feebroker).toFixed(2);
                                            var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


                                            $('#slipnetprmtonr').val(real_sumnetprmtonr);
                                            $('#slipnetprmtonr2').val(real_sumnetprmtonr);
                                            // $('#slipsumfee').val("100" + "-" + commision.toString() + "-" + feebroker.toString() + "*" + conv_sumgrossprmtonr.toString());
                                            $('#slipsumfee').val(real_sumfeebroker);
                                            $('#slipsumfee2').val(real_sumfeebroker);

                                            var retro_backup = $('#sliprb').val();
                                            if(retro_backup == 'YES'){
                                                swal('warning!','please change retrocession amount manually','success')
                                            }

                                        }

                                    }
                                }
                            }
                        }catch(err){
                            console.log(err)
                        }


                    }
                    
                }


                $('#slipnilaiec').val('');
                $('#slipamountec').val('');
                $('#slipamountec2').val('');



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
       var sliptype = 'mp';      
       
       var slip_id = $('#slipnumberupdate').val();
       var token2 = $('input[name=_token2]').val();
       var countendorsement = null;
        if($('#countendorsementupdate').val()){
            countendorsement = $('#countendorsementupdate').val();
        }else{
            countendorsement = 0;
        }
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
                var curr_amount = response.amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('#ExtendCoveragePanelupdate tbody').prepend('<tr id="iidextendcoverageupdate'+response.id+'" data-name="extendcoveragevalue[]"><td data-name="'+response.coveragetype+'">' +response.coveragecode+ ' - ' +response.coveragename+'</td><td data-name="'+response.percentage+'">'+response.percentage+'</td><td data-name="'+response.amount+'">'+curr_amount+'</td><td><a href="javascript:void(0)" onclick="deleteextendcoverageupdate('+response.id+')">delete</a></td></tr>');
                

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

                        try {

                            var insurance_period_from2 = $('#sliprpfromupdate').val();
                            var insurance_period_to2 = $('#sliprptoupdate').val();
                            var newinsurance_period_from2 = insurance_period_from2.split("/").reverse().join("-");
                            var newinsurance_period_to2 = insurance_period_to2.split("/").reverse().join("-");
                            var days=daysBetween(newinsurance_period_from2, newinsurance_period_to2);
                            var insurance = (days/365);

                            var tsi = $("#sharetotalsumupdate").val();
                            var conv_tsi = parseFloat(tsi.replace(/,/g, ""));
                            var sumrate = $("#sliptotalrateupdate").val();
                            var conv_sumrate = parseFloat(sumrate.replace(/,/g, ""));
                            var sum = isNaN(((conv_sumrate / 1000) * conv_tsi) * insurance) ? 0 :(((conv_sumrate / 1000) * conv_tsi) * insurance).toFixed(2) ;
                            var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                            $('#slipbasicpremiumupdate').val(real_sum);
                        
                        
                            var basic_premi = $('#slipbasicpremiumupdate').val();

                            if(basic_premi){
                                var bpinsurance_period_from2 = $('#sliprpfromupdate').val();
                                var bpinsurance_period_to2 = $('#sliprptoupdate').val();
                                var bpnewinsurance_period_from2 = bpinsurance_period_from2.split("/").reverse().join("-");
                                var bpnewinsurance_period_to2 = bpinsurance_period_to2.split("/").reverse().join("-");
                                var bpdays=daysBetween(bpnewinsurance_period_from2, bpnewinsurance_period_to2);
                                var bpinsurance = (bpdays/365);
                                
                                console.log(bpinsurance_period_from2)
                                console.log(bpinsurance_period_to2)
                                console.log(bpnewinsurance_period_from2)
                                console.log(bpnewinsurance_period_to2)
                                console.log(bpdays)
                                console.log(bpinsurance)

                                var bprateslip =  parseFloat($('#sliprateupdate').val());
                                var bpsumrate = $("#sliptotalrateupdate").val();
                                var bpconv_sumrate = parseFloat(bpsumrate.replace(/,/g, ""));
                                var bptsi = $("#sharetotalsumupdate").val();
                                var bpconv_tsi = parseFloat(bptsi.replace(/,/g, ""));
                                var bpsum = isNaN(((bpconv_sumrate / 1000) * bpconv_tsi) * bpinsurance) ? 0 :(((bpconv_sumrate / 1000) * bpconv_tsi) * bpinsurance).toFixed(2) ;
                                var bpreal_sum = bpsum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                                $('#slipbasicpremiumupdate').val(bpreal_sum);

                                var share = $('#slipshareupdate').val();
                                if(share){
                                    var shareslip =  parseFloat(share) / 100 ;
                                    var nasionalreinsurance =  $('#mpsharefrom').val();
                                    var totalnre =  $('#mpshareto').val();
                                    var conv_totalnre =  parseFloat(totalnre.replace(/,/g, ""));

                                    console.log('nre' + nasionalreinsurance)
                                        // console.log(conv_nasionalreinsurance)
                                    console.log('totalnre' + totalnre)
                                    console.log('convtotnre' + conv_totalnre)
                                    

                                    var sumshare = $('#slipsumshareupdate').val() ;
                                    var conv_sumshare = parseFloat(sumshare.replace(/,/g, ""));

                                    
                                    var conv_basre = parseFloat(basic_premi.replace(/,/g, ""));

                                    var orpercent = $('#sliporupdate').val() / 100;

                                    var sumor = isNaN(orpercent * conv_sumshare) ? 0 :(orpercent * conv_sumshare).toFixed(2);
                                    var real_sumor = sumor.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    
                                    var sumgprmtonr = isNaN(conv_basre * shareslip ) ? 0 :(conv_basre * shareslip ).toFixed(2);
                                    var real_sumgprmtonr= sumgprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    
                                    if(nasionalreinsurance){
                                        var conv_nasionalreinsurance =  parseFloat(nasionalreinsurance.replace(/,/g, ""));
                                        var sumnre = isNaN(conv_nasionalreinsurance + conv_sumshare ) ? 0 :(conv_nasionalreinsurance + conv_sumshare).toFixed(2) ;
                                        var real_sumnre = sumnre.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    }else{
                                        var conv_nasionalreinsurance =  parseFloat(nasionalreinsurance.replace(/,/g, ""));
                                        var sumnre = isNaN(0 + conv_sumshare ) ? 0 :(0 + conv_sumshare).toFixed(2) ;
                                        var real_sumnre = sumnre.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    }
                                    
                                    
                                    var sumourshare = isNaN((sumnre / conv_totalnre) * 100 ) ? 0 :((sumnre / conv_totalnre) * 100 ).toFixed(2) ;

                                    console.log('sumnre' + sumnre)
                                    console.log('realnre' + real_sumnre)
                                    console.log('sumourshare' + sumourshare)

                                    $('#slipgrossprmtonrupdate').val(real_sumgprmtonr);
                                    $('#slipgrossprmtonrupdate2').val(real_sumgprmtonr);
                                    $('#slipsumorupdate').val(real_sumor);
                                    $('#slipsumorupdate2').val(real_sumor);
                                    // $('#mpshare').val(sumourshare.replace(/,/g, "."));
                                    $('#mpsharefrom').val(real_sumnre);

                                    var slipsumcommissionval = $('#slipsumcommissionupdate').val();
                                    if(slipsumcommissionval != null){
                                        var commision =  parseFloat($('#slipcommissionupdate').val()) / 100;
                                        var feebroker = parseFloat($('#slipvbrokerupdate').val()) / 100;
                                        var sumgrossprmtonr = $("#slipgrossprmtonrupdate").val();
                                        var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr.replace(/,/g, ""));

                                        var sumcomm = isNaN(commision * conv_sumgrossprmtonr) ? 0 :(commision * conv_sumgrossprmtonr).toFixed(2);
                                        var real_sumcomm = sumcomm.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                                        $('#slipsumcommissionupdate').val(real_sumcomm);
                                        $('#slipsumcommissionupdate2').val(real_sumcomm);

                                        var netprm_to_nr = $('#slipnetprmtonrupdate').val();
                                        if(netprm_to_nr != null){


                                            var sumnetprmtonr = isNaN( conv_sumgrossprmtonr * (100/100 - commision - feebroker)) ? 0 :(conv_sumgrossprmtonr * (100/100 - commision - feebroker)).toFixed(2);
                                            var real_sumnetprmtonr = sumnetprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                                            var sumfeebroker = isNaN( conv_sumgrossprmtonr * feebroker) ? 0 :(conv_sumgrossprmtonr * feebroker).toFixed(2);
                                            var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


                                            $('#slipnetprmtonrupdate').val(real_sumnetprmtonr);
                                            $('#slipnetprmtonrupdate2').val(real_sumnetprmtonr);
                                            // $('#slipsumfee').val("100" + "-" + commision.toString() + "-" + feebroker.toString() + "*" + conv_sumgrossprmtonr.toString());
                                            $('#slipsumfeeupdate').val(real_sumfeebroker);
                                            $('#slipsumfeeupdate2').val(real_sumfeebroker);

                                            var retro_backup = $('#sliprbupdate').val();
                                            if(retro_backup == 'YES'){
                                                swal('warning!','please change retrocession amount manually','success')
                                            }

                                        }

                                    }
                                }
                            }
                        }catch(err){
                            console.log(err)
                        }
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

                        try {

                            var insurance_period_from2 = $('#sliprpfromupdate').val();
                            var insurance_period_to2 = $('#sliprptoupdate').val();
                            var newinsurance_period_from2 = insurance_period_from2.split("/").reverse().join("-");
                            var newinsurance_period_to2 = insurance_period_to2.split("/").reverse().join("-");
                            var days=daysBetween(newinsurance_period_from2, newinsurance_period_to2);
                            var insurance = (days/365);

                            var tsi = $("#sharetotalsumupdate").val();
                            var conv_tsi = parseFloat(tsi.replace(/,/g, ""));
                            var sumrate = $("#sliptotalrateupdate").val();
                            var conv_sumrate = parseFloat(sumrate.replace(/,/g, ""));
                            var sum = isNaN(((conv_sumrate / 1000) * conv_tsi) * insurance) ? 0 :(((conv_sumrate / 1000) * conv_tsi) * insurance).toFixed(2) ;
                            var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                            $('#slipbasicpremiumupdate').val(real_sum);
                        
                        
                            var basic_premi = $('#slipbasicpremiumupdate').val();

                            if(basic_premi){
                                var bpinsurance_period_from2 = $('#sliprpfromupdate').val();
                                var bpinsurance_period_to2 = $('#sliprptoupdate').val();
                                var bpnewinsurance_period_from2 = bpinsurance_period_from2.split("/").reverse().join("-");
                                var bpnewinsurance_period_to2 = bpinsurance_period_to2.split("/").reverse().join("-");
                                var bpdays=daysBetween(bpnewinsurance_period_from2, bpnewinsurance_period_to2);
                                var bpinsurance = (bpdays/365);
                                
                                console.log(bpinsurance_period_from2)
                                console.log(bpinsurance_period_to2)
                                console.log(bpnewinsurance_period_from2)
                                console.log(bpnewinsurance_period_to2)
                                console.log(bpdays)
                                console.log(bpinsurance)

                                var bprateslip =  parseFloat($('#sliprateupdate').val());
                                var bpsumrate = $("#sliptotalrateupdate").val();
                                var bpconv_sumrate = parseFloat(bpsumrate.replace(/,/g, ""));
                                var bptsi = $("#sharetotalsumupdate").val();
                                var bpconv_tsi = parseFloat(bptsi.replace(/,/g, ""));
                                var bpsum = isNaN(((bpconv_sumrate / 1000) * bpconv_tsi) * bpinsurance) ? 0 :(((bpconv_sumrate / 1000) * bpconv_tsi) * bpinsurance).toFixed(2) ;
                                var bpreal_sum = bpsum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                                $('#slipbasicpremiumupdate').val(bpreal_sum);

                                var share = $('#slipshareupdate').val();
                                if(share){
                                    var shareslip =  parseFloat(share) / 100 ;
                                    var nasionalreinsurance =  $('#mpsharefrom').val();
                                    var totalnre =  $('#mpshareto').val();
                                    var conv_totalnre =  parseFloat(totalnre.replace(/,/g, ""));

                                    console.log('nre' + nasionalreinsurance)
                                        // console.log(conv_nasionalreinsurance)
                                    console.log('totalnre' + totalnre)
                                    console.log('convtotnre' + conv_totalnre)
                                    

                                    var sumshare = $('#slipsumshareupdate').val() ;
                                    var conv_sumshare = parseFloat(sumshare.replace(/,/g, ""));

                                    
                                    var conv_basre = parseFloat(basic_premi.replace(/,/g, ""));

                                    var orpercent = $('#sliporupdate').val() / 100;

                                    var sumor = isNaN(orpercent * conv_sumshare) ? 0 :(orpercent * conv_sumshare).toFixed(2);
                                    var real_sumor = sumor.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    
                                    var sumgprmtonr = isNaN(conv_basre * shareslip ) ? 0 :(conv_basre * shareslip ).toFixed(2);
                                    var real_sumgprmtonr= sumgprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    
                                    if(nasionalreinsurance){
                                        var conv_nasionalreinsurance =  parseFloat(nasionalreinsurance.replace(/,/g, ""));
                                        var sumnre = isNaN(conv_nasionalreinsurance + conv_sumshare ) ? 0 :(conv_nasionalreinsurance + conv_sumshare).toFixed(2) ;
                                        var real_sumnre = sumnre.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    }else{
                                        var conv_nasionalreinsurance =  parseFloat(nasionalreinsurance.replace(/,/g, ""));
                                        var sumnre = isNaN(0 + conv_sumshare ) ? 0 :(0 + conv_sumshare).toFixed(2) ;
                                        var real_sumnre = sumnre.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    }
                                    
                                    
                                    var sumourshare = isNaN((sumnre / conv_totalnre) * 100 ) ? 0 :((sumnre / conv_totalnre) * 100 ).toFixed(2) ;

                                    console.log('sumnre' + sumnre)
                                    console.log('realnre' + real_sumnre)
                                    console.log('sumourshare' + sumourshare)

                                    $('#slipgrossprmtonrupdate').val(real_sumgprmtonr);
                                    $('#slipgrossprmtonrupdate2').val(real_sumgprmtonr);
                                    $('#slipsumorupdate').val(real_sumor);
                                    $('#slipsumorupdate2').val(real_sumor);
                                    // $('#mpshare').val(sumourshare.replace(/,/g, "."));
                                    $('#mpsharefrom').val(real_sumnre);

                                    var slipsumcommissionval = $('#slipsumcommissionupdate').val();
                                    if(slipsumcommissionval != null){
                                        var commision =  parseFloat($('#slipcommissionupdate').val()) / 100;
                                        var feebroker = parseFloat($('#slipvbrokerupdate').val()) / 100;
                                        var sumgrossprmtonr = $("#slipgrossprmtonrupdate").val();
                                        var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr.replace(/,/g, ""));

                                        var sumcomm = isNaN(commision * conv_sumgrossprmtonr) ? 0 :(commision * conv_sumgrossprmtonr).toFixed(2);
                                        var real_sumcomm = sumcomm.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                                        $('#slipsumcommissionupdate').val(real_sumcomm);
                                        $('#slipsumcommissionupdate2').val(real_sumcomm);

                                        var netprm_to_nr = $('#slipnetprmtonrupdate').val();
                                        if(netprm_to_nr != null){


                                            var sumnetprmtonr = isNaN( conv_sumgrossprmtonr * (100/100 - commision - feebroker)) ? 0 :(conv_sumgrossprmtonr * (100/100 - commision - feebroker)).toFixed(2);
                                            var real_sumnetprmtonr = sumnetprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                                            var sumfeebroker = isNaN( conv_sumgrossprmtonr * feebroker) ? 0 :(conv_sumgrossprmtonr * feebroker).toFixed(2);
                                            var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


                                            $('#slipnetprmtonrupdate').val(real_sumnetprmtonr);
                                            $('#slipnetprmtonrupdate2').val(real_sumnetprmtonr);
                                            // $('#slipsumfee').val("100" + "-" + commision.toString() + "-" + feebroker.toString() + "*" + conv_sumgrossprmtonr.toString());
                                            $('#slipsumfeeupdate').val(real_sumfeebroker);
                                            $('#slipsumfeeupdate2').val(real_sumfeebroker);

                                            var retro_backup = $('#sliprbupdate').val();
                                            if(retro_backup == 'YES'){
                                                swal('warning!','please change retrocession amount manually','success')
                                            }

                                        }

                                    }
                                }
                            }
                        }catch(err){
                            console.log(err)
                        }
                    }
                    
                }


                $('#slipnilaiecupdate').val('');
                $('#slipamountecupdate').val('');
                $('#slipamountecupdate2').val('');



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
       var sliptype = 'mp';      
       if($('#countendorsmentdata').val()){
            countendorsement = $('#countendorsmentdata').val();
        }else{
            countendorsement = 0;
        }
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
                var curr_amount = response.amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('#ExtendCoveragePanelendorsement tbody').prepend('<tr id="iidextendcoverageendorsement'+response.id+'" data-name="extendcoveragevalue[]"><td data-name="'+response.coveragetype+'">' +response.coveragecode+ ' - ' +response.coveragename+'</td><td data-name="'+response.percentage+'">'+response.percentage+'</td><td data-name="'+response.amount+'">'+curr_amount+'</td><td><a href="javascript:void(0)" onclick="deleteextendcoverageendorsement('+response.id+')">delete</a></td></tr>');
                

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

                        try {

                            var insurance_period_from2 = $('#sliprpfromendorsement').val();
                            var insurance_period_to2 = $('#sliprptoendorsement').val();
                            var newinsurance_period_from2 = insurance_period_from2.split("/").reverse().join("-");
                            var newinsurance_period_to2 = insurance_period_to2.split("/").reverse().join("-");
                            var days=daysBetween(newinsurance_period_from2, newinsurance_period_to2);
                            var insurance = (days/365);

                            var tsi = $("#sharetotalsumendorsement").val();
                            var conv_tsi = parseFloat(tsi.replace(/,/g, ""));
                            var sumrate = $("#sliptotalrateendorsement").val();
                            var conv_sumrate = parseFloat(sumrate.replace(/,/g, ""));
                            var sum = isNaN(((conv_sumrate / 1000) * conv_tsi) * insurance) ? 0 :(((conv_sumrate / 1000) * conv_tsi) * insurance).toFixed(2) ;
                            var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                            $('#slipbasicpremiumendorsement').val(real_sum);
                        
                        
                            var basic_premi = $('#slipbasicpremiumendorsement').val();

                            if(basic_premi){
                                var bpinsurance_period_from2 = $('#sliprpfromendorsement').val();
                                var bpinsurance_period_to2 = $('#sliprptoendorsement').val();
                                var bpnewinsurance_period_from2 = bpinsurance_period_from2.split("/").reverse().join("-");
                                var bpnewinsurance_period_to2 = bpinsurance_period_to2.split("/").reverse().join("-");
                                var bpdays=daysBetween(bpnewinsurance_period_from2, bpnewinsurance_period_to2);
                                var bpinsurance = (bpdays/365);
                                
                                console.log(bpinsurance_period_from2)
                                console.log(bpinsurance_period_to2)
                                console.log(bpnewinsurance_period_from2)
                                console.log(bpnewinsurance_period_to2)
                                console.log(bpdays)
                                console.log(bpinsurance)

                                var bprateslip =  parseFloat($('#sliprateendorsement').val());
                                var bpsumrate = $("#sliptotalrateendorsement").val();
                                var bpconv_sumrate = parseFloat(bpsumrate.replace(/,/g, ""));
                                var bptsi = $("#sharetotalsumendorsement").val();
                                var bpconv_tsi = parseFloat(bptsi.replace(/,/g, ""));
                                var bpsum = isNaN(((bpconv_sumrate / 1000) * bpconv_tsi) * bpinsurance) ? 0 :(((bpconv_sumrate / 1000) * bpconv_tsi) * bpinsurance).toFixed(2) ;
                                var bpreal_sum = bpsum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                                $('#slipbasicpremiumendorsement').val(bpreal_sum);

                                var share = $('#slipshareendorsement').val();
                                if(share){
                                    var shareslip =  parseFloat(share) / 100 ;
                                    var nasionalreinsurance =  $('#mpsharefrom').val();
                                    var totalnre =  $('#mpshareto').val();
                                    var conv_totalnre =  parseFloat(totalnre.replace(/,/g, ""));

                                    console.log('nre' + nasionalreinsurance)
                                        // console.log(conv_nasionalreinsurance)
                                    console.log('totalnre' + totalnre)
                                    console.log('convtotnre' + conv_totalnre)
                                    

                                    var sumshare = $('#slipsumshareendorsement').val() ;
                                    var conv_sumshare = parseFloat(sumshare.replace(/,/g, ""));

                                    
                                    var conv_basre = parseFloat(basic_premi.replace(/,/g, ""));

                                    var orpercent = $('#sliporendorsement').val() / 100;

                                    var sumor = isNaN(orpercent * conv_sumshare) ? 0 :(orpercent * conv_sumshare).toFixed(2);
                                    var real_sumor = sumor.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    
                                    var sumgprmtonr = isNaN(conv_basre * shareslip ) ? 0 :(conv_basre * shareslip ).toFixed(2);
                                    var real_sumgprmtonr= sumgprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    
                                    if(nasionalreinsurance){
                                        var conv_nasionalreinsurance =  parseFloat(nasionalreinsurance.replace(/,/g, ""));
                                        var sumnre = isNaN(conv_nasionalreinsurance + conv_sumshare ) ? 0 :(conv_nasionalreinsurance + conv_sumshare).toFixed(2) ;
                                        var real_sumnre = sumnre.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    }else{
                                        var conv_nasionalreinsurance =  parseFloat(nasionalreinsurance.replace(/,/g, ""));
                                        var sumnre = isNaN(0 + conv_sumshare ) ? 0 :(0 + conv_sumshare).toFixed(2) ;
                                        var real_sumnre = sumnre.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    }
                                    
                                    
                                    var sumourshare = isNaN((sumnre / conv_totalnre) * 100 ) ? 0 :((sumnre / conv_totalnre) * 100 ).toFixed(2) ;

                                    console.log('sumnre' + sumnre)
                                    console.log('realnre' + real_sumnre)
                                    console.log('sumourshare' + sumourshare)

                                    $('#slipgrossprmtonrendorsement').val(real_sumgprmtonr);
                                    $('#slipgrossprmtonrendorsement2').val(real_sumgprmtonr);
                                    $('#slipsumorendorsement').val(real_sumor);
                                    $('#slipsumorendorsement2').val(real_sumor);
                                    // $('#mpshare').val(sumourshare.replace(/,/g, "."));
                                    $('#mpsharefrom').val(real_sumnre);

                                    var slipsumcommissionval = $('#slipsumcommissionendorsement').val();
                                    if(slipsumcommissionval != null){
                                        var commision =  parseFloat($('#slipcommissionendorsement').val()) / 100;
                                        var feebroker = parseFloat($('#slipvbrokerendorsement').val()) / 100;
                                        var sumgrossprmtonr = $("#slipgrossprmtonrendorsement").val();
                                        var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr.replace(/,/g, ""));

                                        var sumcomm = isNaN(commision * conv_sumgrossprmtonr) ? 0 :(commision * conv_sumgrossprmtonr).toFixed(2);
                                        var real_sumcomm = sumcomm.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                                        $('#slipsumcommissionendorsement').val(real_sumcomm);
                                        $('#slipsumcommissionendorsement2').val(real_sumcomm);

                                        var netprm_to_nr = $('#slipnetprmtonrendorsement').val();
                                        if(netprm_to_nr != null){


                                            var sumnetprmtonr = isNaN( conv_sumgrossprmtonr * (100/100 - commision - feebroker)) ? 0 :(conv_sumgrossprmtonr * (100/100 - commision - feebroker)).toFixed(2);
                                            var real_sumnetprmtonr = sumnetprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                                            var sumfeebroker = isNaN( conv_sumgrossprmtonr * feebroker) ? 0 :(conv_sumgrossprmtonr * feebroker).toFixed(2);
                                            var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


                                            $('#slipnetprmtonrendorsement').val(real_sumnetprmtonr);
                                            $('#slipnetprmtonrendorsement2').val(real_sumnetprmtonr);
                                            // $('#slipsumfee').val("100" + "-" + commision.toString() + "-" + feebroker.toString() + "*" + conv_sumgrossprmtonr.toString());
                                            $('#slipsumfeeendorsement').val(real_sumfeebroker);
                                            $('#slipsumfeeendorsement2').val(real_sumfeebroker);

                                            var retro_backup = $('#sliprbendorsement').val();
                                            if(retro_backup == 'YES'){
                                                swal('warning!','please change retrocession amount manually','success')
                                            }

                                        }

                                    }
                                }
                            }
                        }catch(err){
                            console.log(err)
                        }
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

                        try {

                            var insurance_period_from2 = $('#sliprpfromendorsement').val();
                            var insurance_period_to2 = $('#sliprptoendorsement').val();
                            var newinsurance_period_from2 = insurance_period_from2.split("/").reverse().join("-");
                            var newinsurance_period_to2 = insurance_period_to2.split("/").reverse().join("-");
                            var days=daysBetween(newinsurance_period_from2, newinsurance_period_to2);
                            var insurance = (days/365);

                            var tsi = $("#sharetotalsumendorsement").val();
                            var conv_tsi = parseFloat(tsi.replace(/,/g, ""));
                            var sumrate = $("#sliptotalrateendorsement").val();
                            var conv_sumrate = parseFloat(sumrate.replace(/,/g, ""));
                            var sum = isNaN(((conv_sumrate / 1000) * conv_tsi) * insurance) ? 0 :(((conv_sumrate / 1000) * conv_tsi) * insurance).toFixed(2) ;
                            var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                            $('#slipbasicpremiumendorsement').val(real_sum);
                        
                        
                            var basic_premi = $('#slipbasicpremiumendorsement').val();

                            if(basic_premi){
                                var bpinsurance_period_from2 = $('#sliprpfromendorsement').val();
                                var bpinsurance_period_to2 = $('#sliprptoendorsement').val();
                                var bpnewinsurance_period_from2 = bpinsurance_period_from2.split("/").reverse().join("-");
                                var bpnewinsurance_period_to2 = bpinsurance_period_to2.split("/").reverse().join("-");
                                var bpdays=daysBetween(bpnewinsurance_period_from2, bpnewinsurance_period_to2);
                                var bpinsurance = (bpdays/365);
                                
                                console.log(bpinsurance_period_from2)
                                console.log(bpinsurance_period_to2)
                                console.log(bpnewinsurance_period_from2)
                                console.log(bpnewinsurance_period_to2)
                                console.log(bpdays)
                                console.log(bpinsurance)

                                var bprateslip =  parseFloat($('#sliprateendorsement').val());
                                var bpsumrate = $("#sliptotalrateendorsement").val();
                                var bpconv_sumrate = parseFloat(bpsumrate.replace(/,/g, ""));
                                var bptsi = $("#sharetotalsumendorsement").val();
                                var bpconv_tsi = parseFloat(bptsi.replace(/,/g, ""));
                                var bpsum = isNaN(((bpconv_sumrate / 1000) * bpconv_tsi) * bpinsurance) ? 0 :(((bpconv_sumrate / 1000) * bpconv_tsi) * bpinsurance).toFixed(2) ;
                                var bpreal_sum = bpsum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                                $('#slipbasicpremiumendorsement').val(bpreal_sum);

                                var share = $('#slipshareendorsement').val();
                                if(share){
                                    var shareslip =  parseFloat(share) / 100 ;
                                    var nasionalreinsurance =  $('#mpsharefrom').val();
                                    var totalnre =  $('#mpshareto').val();
                                    var conv_totalnre =  parseFloat(totalnre.replace(/,/g, ""));

                                    console.log('nre' + nasionalreinsurance)
                                        // console.log(conv_nasionalreinsurance)
                                    console.log('totalnre' + totalnre)
                                    console.log('convtotnre' + conv_totalnre)
                                    

                                    var sumshare = $('#slipsumshareendorsement').val() ;
                                    var conv_sumshare = parseFloat(sumshare.replace(/,/g, ""));

                                    
                                    var conv_basre = parseFloat(basic_premi.replace(/,/g, ""));

                                    var orpercent = $('#sliporendorsement').val() / 100;

                                    var sumor = isNaN(orpercent * conv_sumshare) ? 0 :(orpercent * conv_sumshare).toFixed(2);
                                    var real_sumor = sumor.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    
                                    var sumgprmtonr = isNaN(conv_basre * shareslip ) ? 0 :(conv_basre * shareslip ).toFixed(2);
                                    var real_sumgprmtonr= sumgprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    
                                    if(nasionalreinsurance){
                                        var conv_nasionalreinsurance =  parseFloat(nasionalreinsurance.replace(/,/g, ""));
                                        var sumnre = isNaN(conv_nasionalreinsurance + conv_sumshare ) ? 0 :(conv_nasionalreinsurance + conv_sumshare).toFixed(2) ;
                                        var real_sumnre = sumnre.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    }else{
                                        var conv_nasionalreinsurance =  parseFloat(nasionalreinsurance.replace(/,/g, ""));
                                        var sumnre = isNaN(0 + conv_sumshare ) ? 0 :(0 + conv_sumshare).toFixed(2) ;
                                        var real_sumnre = sumnre.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    }
                                    
                                    
                                    var sumourshare = isNaN((sumnre / conv_totalnre) * 100 ) ? 0 :((sumnre / conv_totalnre) * 100 ).toFixed(2) ;

                                    console.log('sumnre' + sumnre)
                                    console.log('realnre' + real_sumnre)
                                    console.log('sumourshare' + sumourshare)

                                    $('#slipgrossprmtonrendorsement').val(real_sumgprmtonr);
                                    $('#slipgrossprmtonrendorsement2').val(real_sumgprmtonr);
                                    $('#slipsumorendorsement').val(real_sumor);
                                    $('#slipsumorendorsement2').val(real_sumor);
                                    // $('#mpshare').val(sumourshare.replace(/,/g, "."));
                                    $('#mpsharefrom').val(real_sumnre);

                                    var slipsumcommissionval = $('#slipsumcommissionendorsement').val();
                                    if(slipsumcommissionval != null){
                                        var commision =  parseFloat($('#slipcommissionendorsement').val()) / 100;
                                        var feebroker = parseFloat($('#slipvbrokerendorsement').val()) / 100;
                                        var sumgrossprmtonr = $("#slipgrossprmtonrendorsement").val();
                                        var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr.replace(/,/g, ""));

                                        var sumcomm = isNaN(commision * conv_sumgrossprmtonr) ? 0 :(commision * conv_sumgrossprmtonr).toFixed(2);
                                        var real_sumcomm = sumcomm.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                                        $('#slipsumcommissionendorsement').val(real_sumcomm);
                                        $('#slipsumcommissionendorsement2').val(real_sumcomm);

                                        var netprm_to_nr = $('#slipnetprmtonrendorsement').val();
                                        if(netprm_to_nr != null){


                                            var sumnetprmtonr = isNaN( conv_sumgrossprmtonr * (100/100 - commision - feebroker)) ? 0 :(conv_sumgrossprmtonr * (100/100 - commision - feebroker)).toFixed(2);
                                            var real_sumnetprmtonr = sumnetprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                                            var sumfeebroker = isNaN( conv_sumgrossprmtonr * feebroker) ? 0 :(conv_sumgrossprmtonr * feebroker).toFixed(2);
                                            var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


                                            $('#slipnetprmtonrendorsement').val(real_sumnetprmtonr);
                                            $('#slipnetprmtonrendorsement2').val(real_sumnetprmtonr);
                                            // $('#slipsumfee').val("100" + "-" + commision.toString() + "-" + feebroker.toString() + "*" + conv_sumgrossprmtonr.toString());
                                            $('#slipsumfeeendorsement').val(real_sumfeebroker);
                                            $('#slipsumfeeendorsement2').val(real_sumfeebroker);

                                            var retro_backup = $('#sliprbendorsement').val();
                                            if(retro_backup == 'YES'){
                                                swal('warning!','please change retrocession amount manually','success')
                                            }

                                        }

                                    }
                                }
                            }
                        }catch(err){
                            console.log(err)
                        }
                    }
                    
                }


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

                    try{
                        var insurance_period_from2 = $('#sliprpfrom').val();
                        var insurance_period_to2 = $('#sliprpto').val();
                        var newinsurance_period_from2 = insurance_period_from2.split("/").reverse().join("-");
                        var newinsurance_period_to2 = insurance_period_to2.split("/").reverse().join("-");
                        var days=daysBetween(newinsurance_period_from2, newinsurance_period_to2);
                        var insurance = (days/365);

                        var tsi = $("#sharetotalsum").val();
                        var conv_tsi = parseFloat(tsi.replace(/,/g, ""));       
                        var sumrate = $("#sliptotalrate").val();
                        var conv_sumrate = parseFloat(sumrate.replace(/,/g, ""));
                        var sum = isNaN(((conv_sumrate / 1000) * conv_tsi) * insurance) ? 0 :(((conv_sumrate / 1000) * conv_tsi) * insurance).toFixed(2) ;
                        var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                        $('#slipbasicpremium').val(real_sum);

                        var basic_premi = $('#slipbasicpremium').val();

                        if(basic_premi){
                            var bpinsurance_period_from2 = $('#sliprpfrom').val();
                            var bpinsurance_period_to2 = $('#sliprpto').val();
                            var bpnewinsurance_period_from2 = bpinsurance_period_from2.split("/").reverse().join("-");
                            var bpnewinsurance_period_to2 = bpinsurance_period_to2.split("/").reverse().join("-");
                            var bpdays=daysBetween(bpnewinsurance_period_from2, bpnewinsurance_period_to2);
                            var bpinsurance = (bpdays/365);
                            
                            console.log(bpinsurance_period_from2)
                            console.log(bpinsurance_period_to2)
                            console.log(bpnewinsurance_period_from2)
                            console.log(bpnewinsurance_period_to2)
                            console.log(bpdays)
                            console.log(bpinsurance)

                            var bprateslip =  parseFloat($('#sliprate').val());
                            var bpsumrate = $("#sliptotalrate").val();
                            var bpconv_sumrate = parseFloat(bpsumrate.replace(/,/g, ""));
                            var bptsi = $("#sharetotalsum").val();
                            var bpconv_tsi = parseFloat(bptsi.replace(/,/g, ""));
                            var bpsum = isNaN(((bpconv_sumrate / 1000) * bpconv_tsi) * bpinsurance) ? 0 :(((bpconv_sumrate / 1000) * bpconv_tsi) * bpinsurance).toFixed(2) ;
                            var bpreal_sum = bpsum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                            $('#slipbasicpremium').val(bpreal_sum);

                            var share = $('#slipshare').val();
                            if(share){
                                var shareslip =  parseFloat(share) / 100 ;
                                var nasionalreinsurance =  $('#mpsharefrom').val();
                                var totalnre =  $('#mpshareto').val();
                                var conv_totalnre =  parseFloat(totalnre.replace(/,/g, ""));

                                console.log('nre' + nasionalreinsurance)
                                    // console.log(conv_nasionalreinsurance)
                                console.log('totalnre' + totalnre)
                                console.log('convtotnre' + conv_totalnre)
                                

                                var sumshare = $('#slipsumshare').val() ;
                                var conv_sumshare = parseFloat(sumshare.replace(/,/g, ""));

                                
                                var conv_basre = parseFloat(basic_premi.replace(/,/g, ""));

                                var orpercent = $('#slipor').val() / 100;

                                var sumor = isNaN(orpercent * conv_sumshare) ? 0 :(orpercent * conv_sumshare).toFixed(2);
                                var real_sumor = sumor.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                
                                var sumgprmtonr = isNaN(conv_basre * shareslip ) ? 0 :(conv_basre * shareslip ).toFixed(2);
                                var real_sumgprmtonr= sumgprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                
                                if(nasionalreinsurance){
                                    var conv_nasionalreinsurance =  parseFloat(nasionalreinsurance.replace(/,/g, ""));
                                    var sumnre = isNaN(conv_nasionalreinsurance + conv_sumshare ) ? 0 :(conv_nasionalreinsurance + conv_sumshare).toFixed(2) ;
                                    var real_sumnre = sumnre.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                }else{
                                    var conv_nasionalreinsurance =  parseFloat(nasionalreinsurance.replace(/,/g, ""));
                                    var sumnre = isNaN(0 + conv_sumshare ) ? 0 :(0 + conv_sumshare).toFixed(2) ;
                                    var real_sumnre = sumnre.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                }
                                
                                
                                var sumourshare = isNaN((sumnre / conv_totalnre) * 100 ) ? 0 :((sumnre / conv_totalnre) * 100 ).toFixed(2) ;

                                console.log('sumnre' + sumnre)
                                console.log('realnre' + real_sumnre)
                                console.log('sumourshare' + sumourshare)

                                $('#slipgrossprmtonr').val(real_sumgprmtonr);
                                $('#slipgrossprmtonr2').val(real_sumgprmtonr);
                                $('#slipsumor').val(real_sumor);
                                $('#slipsumor2').val(real_sumor);
                                // $('#mpshare').val(sumourshare.replace(/,/g, "."));
                                $('#mpsharefrom').val(real_sumnre);

                                var slipsumcommissionval = $('#slipsumcommission').val();
                                if(slipsumcommissionval != null){
                                    var commision =  parseFloat($('#slipcommission').val()) / 100;
                                    var feebroker = parseFloat($('#slipvbroker').val()) / 100;
                                    var sumgrossprmtonr = $("#slipgrossprmtonr").val();
                                    var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr.replace(/,/g, ""));

                                    var sumcomm = isNaN(commision * conv_sumgrossprmtonr) ? 0 :(commision * conv_sumgrossprmtonr).toFixed(2);
                                    var real_sumcomm = sumcomm.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                                    $('#slipsumcommission').val(real_sumcomm);
                                    $('#slipsumcommission2').val(real_sumcomm);

                                    var netprm_to_nr = $('#slipnetprmtonr').val();
                                    if(netprm_to_nr != null){


                                        var sumnetprmtonr = isNaN( conv_sumgrossprmtonr * (100/100 - commision - feebroker)) ? 0 :(conv_sumgrossprmtonr * (100/100 - commision - feebroker)).toFixed(2);
                                        var real_sumnetprmtonr = sumnetprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                                        var sumfeebroker = isNaN( conv_sumgrossprmtonr * feebroker) ? 0 :(conv_sumgrossprmtonr * feebroker).toFixed(2);
                                        var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


                                        $('#slipnetprmtonr').val(real_sumnetprmtonr);
                                        $('#slipnetprmtonr2').val(real_sumnetprmtonr);
                                        // $('#slipsumfee').val("100" + "-" + commision.toString() + "-" + feebroker.toString() + "*" + conv_sumgrossprmtonr.toString());
                                        $('#slipsumfee').val(real_sumfeebroker);
                                        $('#slipsumfee2').val(real_sumfeebroker);

                                        var retro_backup = $('#sliprb').val();
                                        if(retro_backup == 'YES'){
                                            swal('warning!','please change retrocession amount manually','success')
                                        }

                                    }

                                }
                            }
                        }
                    }catch(err){
                        console.log(err)
                    }

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

                    try {

                            var insurance_period_from2 = $('#sliprpfromupdate').val();
                            var insurance_period_to2 = $('#sliprptoupdate').val();
                            var newinsurance_period_from2 = insurance_period_from2.split("/").reverse().join("-");
                            var newinsurance_period_to2 = insurance_period_to2.split("/").reverse().join("-");
                            var days=daysBetween(newinsurance_period_from2, newinsurance_period_to2);
                            var insurance = (days/365);

                            var tsi = $("#sharetotalsumupdate").val();
                            var conv_tsi = parseFloat(tsi.replace(/,/g, ""));
                            var sumrate = $("#sliptotalrateupdate").val();
                            var conv_sumrate = parseFloat(sumrate.replace(/,/g, ""));
                            var sum = isNaN(((conv_sumrate / 1000) * conv_tsi) * insurance) ? 0 :(((conv_sumrate / 1000) * conv_tsi) * insurance).toFixed(2) ;
                            var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                            $('#slipbasicpremiumupdate').val(real_sum);
                        
                        
                            var basic_premi = $('#slipbasicpremiumupdate').val();

                            if(basic_premi){
                                var bpinsurance_period_from2 = $('#sliprpfromupdate').val();
                                var bpinsurance_period_to2 = $('#sliprptoupdate').val();
                                var bpnewinsurance_period_from2 = bpinsurance_period_from2.split("/").reverse().join("-");
                                var bpnewinsurance_period_to2 = bpinsurance_period_to2.split("/").reverse().join("-");
                                var bpdays=daysBetween(bpnewinsurance_period_from2, bpnewinsurance_period_to2);
                                var bpinsurance = (bpdays/365);
                                
                                console.log(bpinsurance_period_from2)
                                console.log(bpinsurance_period_to2)
                                console.log(bpnewinsurance_period_from2)
                                console.log(bpnewinsurance_period_to2)
                                console.log(bpdays)
                                console.log(bpinsurance)

                                var bprateslip =  parseFloat($('#sliprateupdate').val());
                                var bpsumrate = $("#sliptotalrateupdate").val();
                                var bpconv_sumrate = parseFloat(bpsumrate.replace(/,/g, ""));
                                var bptsi = $("#sharetotalsumupdate").val();
                                var bpconv_tsi = parseFloat(bptsi.replace(/,/g, ""));
                                var bpsum = isNaN(((bpconv_sumrate / 1000) * bpconv_tsi) * bpinsurance) ? 0 :(((bpconv_sumrate / 1000) * bpconv_tsi) * bpinsurance).toFixed(2) ;
                                var bpreal_sum = bpsum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                                $('#slipbasicpremiumupdate').val(bpreal_sum);

                                var share = $('#slipshareupdate').val();
                                if(share){
                                    var shareslip =  parseFloat(share) / 100 ;
                                    var nasionalreinsurance =  $('#mpsharefrom').val();
                                    var totalnre =  $('#mpshareto').val();
                                    var conv_totalnre =  parseFloat(totalnre.replace(/,/g, ""));

                                    console.log('nre' + nasionalreinsurance)
                                        // console.log(conv_nasionalreinsurance)
                                    console.log('totalnre' + totalnre)
                                    console.log('convtotnre' + conv_totalnre)
                                    

                                    var sumshare = $('#slipsumshareupdate').val() ;
                                    var conv_sumshare = parseFloat(sumshare.replace(/,/g, ""));

                                    
                                    var conv_basre = parseFloat(basic_premi.replace(/,/g, ""));

                                    var orpercent = $('#sliporupdate').val() / 100;

                                    var sumor = isNaN(orpercent * conv_sumshare) ? 0 :(orpercent * conv_sumshare).toFixed(2);
                                    var real_sumor = sumor.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    
                                    var sumgprmtonr = isNaN(conv_basre * shareslip ) ? 0 :(conv_basre * shareslip ).toFixed(2);
                                    var real_sumgprmtonr= sumgprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    
                                    if(nasionalreinsurance){
                                        var conv_nasionalreinsurance =  parseFloat(nasionalreinsurance.replace(/,/g, ""));
                                        var sumnre = isNaN(conv_nasionalreinsurance + conv_sumshare ) ? 0 :(conv_nasionalreinsurance + conv_sumshare).toFixed(2) ;
                                        var real_sumnre = sumnre.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    }else{
                                        var conv_nasionalreinsurance =  parseFloat(nasionalreinsurance.replace(/,/g, ""));
                                        var sumnre = isNaN(0 + conv_sumshare ) ? 0 :(0 + conv_sumshare).toFixed(2) ;
                                        var real_sumnre = sumnre.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    }
                                    
                                    
                                    var sumourshare = isNaN((sumnre / conv_totalnre) * 100 ) ? 0 :((sumnre / conv_totalnre) * 100 ).toFixed(2) ;

                                    console.log('sumnre' + sumnre)
                                    console.log('realnre' + real_sumnre)
                                    console.log('sumourshare' + sumourshare)

                                    $('#slipgrossprmtonrupdate').val(real_sumgprmtonr);
                                    $('#slipgrossprmtonrupdate2').val(real_sumgprmtonr);
                                    $('#slipsumorupdate').val(real_sumor);
                                    $('#slipsumorupdate2').val(real_sumor);
                                    // $('#mpshare').val(sumourshare.replace(/,/g, "."));
                                    $('#mpsharefrom').val(real_sumnre);

                                    var slipsumcommissionval = $('#slipsumcommissionupdate').val();
                                    if(slipsumcommissionval != null){
                                        var commision =  parseFloat($('#slipcommissionupdate').val()) / 100;
                                        var feebroker = parseFloat($('#slipvbrokerupdate').val()) / 100;
                                        var sumgrossprmtonr = $("#slipgrossprmtonrupdate").val();
                                        var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr.replace(/,/g, ""));

                                        var sumcomm = isNaN(commision * conv_sumgrossprmtonr) ? 0 :(commision * conv_sumgrossprmtonr).toFixed(2);
                                        var real_sumcomm = sumcomm.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                                        $('#slipsumcommissionupdate').val(real_sumcomm);
                                        $('#slipsumcommissionupdate2').val(real_sumcomm);

                                        var netprm_to_nr = $('#slipnetprmtonrupdate').val();
                                        if(netprm_to_nr != null){


                                            var sumnetprmtonr = isNaN( conv_sumgrossprmtonr * (100/100 - commision - feebroker)) ? 0 :(conv_sumgrossprmtonr * (100/100 - commision - feebroker)).toFixed(2);
                                            var real_sumnetprmtonr = sumnetprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                                            var sumfeebroker = isNaN( conv_sumgrossprmtonr * feebroker) ? 0 :(conv_sumgrossprmtonr * feebroker).toFixed(2);
                                            var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


                                            $('#slipnetprmtonrupdate').val(real_sumnetprmtonr);
                                            $('#slipnetprmtonrupdate2').val(real_sumnetprmtonr);
                                            // $('#slipsumfee').val("100" + "-" + commision.toString() + "-" + feebroker.toString() + "*" + conv_sumgrossprmtonr.toString());
                                            $('#slipsumfeeupdate').val(real_sumfeebroker);
                                            $('#slipsumfeeupdate2').val(real_sumfeebroker);

                                            var retro_backup = $('#sliprbupdate').val();
                                            if(retro_backup == 'YES'){
                                                swal('warning!','please change retrocession amount manually','success')
                                            }

                                        }

                                    }
                                }
                            }
                        }catch(err){
                            console.log(err)
                        }
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

                    try {

                            var insurance_period_from2 = $('#sliprpfromendorsement').val();
                            var insurance_period_to2 = $('#sliprptoendorsement').val();
                            var newinsurance_period_from2 = insurance_period_from2.split("/").reverse().join("-");
                            var newinsurance_period_to2 = insurance_period_to2.split("/").reverse().join("-");
                            var days=daysBetween(newinsurance_period_from2, newinsurance_period_to2);
                            var insurance = (days/365);

                            var tsi = $("#sharetotalsumendorsement").val();
                            var conv_tsi = parseFloat(tsi.replace(/,/g, ""));
                            var sumrate = $("#sliptotalrateendorsement").val();
                            var conv_sumrate = parseFloat(sumrate.replace(/,/g, ""));
                            var sum = isNaN(((conv_sumrate / 1000) * conv_tsi) * insurance) ? 0 :(((conv_sumrate / 1000) * conv_tsi) * insurance).toFixed(2) ;
                            var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                            $('#slipbasicpremiumendorsement').val(real_sum);
                        
                        
                            var basic_premi = $('#slipbasicpremiumendorsement').val();

                            if(basic_premi){
                                var bpinsurance_period_from2 = $('#sliprpfromendorsement').val();
                                var bpinsurance_period_to2 = $('#sliprptoendorsement').val();
                                var bpnewinsurance_period_from2 = bpinsurance_period_from2.split("/").reverse().join("-");
                                var bpnewinsurance_period_to2 = bpinsurance_period_to2.split("/").reverse().join("-");
                                var bpdays=daysBetween(bpnewinsurance_period_from2, bpnewinsurance_period_to2);
                                var bpinsurance = (bpdays/365);
                                
                                console.log(bpinsurance_period_from2)
                                console.log(bpinsurance_period_to2)
                                console.log(bpnewinsurance_period_from2)
                                console.log(bpnewinsurance_period_to2)
                                console.log(bpdays)
                                console.log(bpinsurance)

                                var bprateslip =  parseFloat($('#sliprateendorsement').val());
                                var bpsumrate = $("#sliptotalrateendorsement").val();
                                var bpconv_sumrate = parseFloat(bpsumrate.replace(/,/g, ""));
                                var bptsi = $("#sharetotalsumendorsement").val();
                                var bpconv_tsi = parseFloat(bptsi.replace(/,/g, ""));
                                var bpsum = isNaN(((bpconv_sumrate / 1000) * bpconv_tsi) * bpinsurance) ? 0 :(((bpconv_sumrate / 1000) * bpconv_tsi) * bpinsurance).toFixed(2) ;
                                var bpreal_sum = bpsum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                                $('#slipbasicpremiumendorsement').val(bpreal_sum);

                                var share = $('#slipshareendorsement').val();
                                if(share){
                                    var shareslip =  parseFloat(share) / 100 ;
                                    var nasionalreinsurance =  $('#mpsharefrom').val();
                                    var totalnre =  $('#mpshareto').val();
                                    var conv_totalnre =  parseFloat(totalnre.replace(/,/g, ""));

                                    console.log('nre' + nasionalreinsurance)
                                        // console.log(conv_nasionalreinsurance)
                                    console.log('totalnre' + totalnre)
                                    console.log('convtotnre' + conv_totalnre)
                                    

                                    var sumshare = $('#slipsumshareendorsement').val() ;
                                    var conv_sumshare = parseFloat(sumshare.replace(/,/g, ""));

                                    
                                    var conv_basre = parseFloat(basic_premi.replace(/,/g, ""));

                                    var orpercent = $('#sliporendorsement').val() / 100;

                                    var sumor = isNaN(orpercent * conv_sumshare) ? 0 :(orpercent * conv_sumshare).toFixed(2);
                                    var real_sumor = sumor.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    
                                    var sumgprmtonr = isNaN(conv_basre * shareslip ) ? 0 :(conv_basre * shareslip ).toFixed(2);
                                    var real_sumgprmtonr= sumgprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    
                                    if(nasionalreinsurance){
                                        var conv_nasionalreinsurance =  parseFloat(nasionalreinsurance.replace(/,/g, ""));
                                        var sumnre = isNaN(conv_nasionalreinsurance + conv_sumshare ) ? 0 :(conv_nasionalreinsurance + conv_sumshare).toFixed(2) ;
                                        var real_sumnre = sumnre.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    }else{
                                        var conv_nasionalreinsurance =  parseFloat(nasionalreinsurance.replace(/,/g, ""));
                                        var sumnre = isNaN(0 + conv_sumshare ) ? 0 :(0 + conv_sumshare).toFixed(2) ;
                                        var real_sumnre = sumnre.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    }
                                    
                                    
                                    var sumourshare = isNaN((sumnre / conv_totalnre) * 100 ) ? 0 :((sumnre / conv_totalnre) * 100 ).toFixed(2) ;

                                    console.log('sumnre' + sumnre)
                                    console.log('realnre' + real_sumnre)
                                    console.log('sumourshare' + sumourshare)

                                    $('#slipgrossprmtonrendorsement').val(real_sumgprmtonr);
                                    $('#slipgrossprmtonrendorsement2').val(real_sumgprmtonr);
                                    $('#slipsumorendorsement').val(real_sumor);
                                    $('#slipsumorendorsement2').val(real_sumor);
                                    // $('#mpshare').val(sumourshare.replace(/,/g, "."));
                                    $('#mpsharefrom').val(real_sumnre);

                                    var slipsumcommissionval = $('#slipsumcommissionendorsement').val();
                                    if(slipsumcommissionval != null){
                                        var commision =  parseFloat($('#slipcommissionendorsement').val()) / 100;
                                        var feebroker = parseFloat($('#slipvbrokerendorsement').val()) / 100;
                                        var sumgrossprmtonr = $("#slipgrossprmtonrendorsement").val();
                                        var conv_sumgrossprmtonr = parseFloat(sumgrossprmtonr.replace(/,/g, ""));

                                        var sumcomm = isNaN(commision * conv_sumgrossprmtonr) ? 0 :(commision * conv_sumgrossprmtonr).toFixed(2);
                                        var real_sumcomm = sumcomm.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                                        $('#slipsumcommissionendorsement').val(real_sumcomm);
                                        $('#slipsumcommissionendorsement2').val(real_sumcomm);

                                        var netprm_to_nr = $('#slipnetprmtonrendorsement').val();
                                        if(netprm_to_nr != null){


                                            var sumnetprmtonr = isNaN( conv_sumgrossprmtonr * (100/100 - commision - feebroker)) ? 0 :(conv_sumgrossprmtonr * (100/100 - commision - feebroker)).toFixed(2);
                                            var real_sumnetprmtonr = sumnetprmtonr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                                            var sumfeebroker = isNaN( conv_sumgrossprmtonr * feebroker) ? 0 :(conv_sumgrossprmtonr * feebroker).toFixed(2);
                                            var real_sumfeebroker = sumfeebroker.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


                                            $('#slipnetprmtonrendorsement').val(real_sumnetprmtonr);
                                            $('#slipnetprmtonrendorsement2').val(real_sumnetprmtonr);
                                            // $('#slipsumfee').val("100" + "-" + commision.toString() + "-" + feebroker.toString() + "*" + conv_sumgrossprmtonr.toString());
                                            $('#slipsumfeeendorsement').val(real_sumfeebroker);
                                            $('#slipsumfeeendorsement2').val(real_sumfeebroker);

                                            var retro_backup = $('#sliprbendorsement').val();
                                            if(retro_backup == 'YES'){
                                                swal('warning!','please change retrocession amount manually','success')
                                            }

                                        }

                                    }
                                }
                            }
                        }catch(err){
                            console.log(err)
                        }
                }
                    
                

                $('#iidextendcoverageendorsement'+id).remove();
                console.log(response);
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
       var countendorsement = $('#countendorsmentupdate').val();
        
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
               type:type,
               contract:contract,
               percentage:percentage,
               countendorsement:countendorsement,
               amount:real_amount,
               id_slip:slip_id
           },
           beforeSend: function() { $("body").addClass("loading");  },
           complete: function() {  $("body").removeClass("loading"); },
           success:function(response)
           {
            
               console.log(response)
               var curr_amount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(response.amount);
               $('#retrocessionPanelupdate tbody').prepend('<tr id="iidretrocessionupdate'+response.id+'" data-name="retrocessionupdatevalue[]"><td data-name="'+response.type+'">'+response.type+'</td><td data-name="'+response.contract+'">'+response.contract+'</td><td data-name="'+response.percentage+'">'+response.percentage+'</td><td data-name="'+response.amount+'">'+curr_amount+')</td><td><a href="javascript:void(0)" onclick="deleteretrocessionupdate('+response.id+')">delete</a></td></tr>');
               $('#sliprppercentageupdate').val('');
               $('#sliprpamountupdate').val('');
               
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
               countendorsement:countendorsement,
               amount:real_amount,
               id_slip:slip_id
           },
           beforeSend: function() { $("body").addClass("loading");  },
           complete: function() {  $("body").removeClass("loading"); },
           success:function(response)
           {
            
               console.log(response)
               var curr_amount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(response.amount);
               $('#retrocessionPanelendorsement tbody').prepend('<tr id="iidretrocessionendorsement'+response.id+'" data-name="retrocessionendorsementvalue[]"><td data-name="'+response.type+'">'+response.type+'</td><td data-name="'+response.contract+'">'+response.contract+'</td><td data-name="'+response.percentage+'">'+response.percentage+'</td><td data-name="'+response.amount+'">'+curr_amount+')</td><td><a href="javascript:void(0)" onclick="deleteretrocessionendorsement('+response.id+')">delete</a></td></tr>');
               $('#sliprppercentageendorsement').val('');
               $('#sliprpamountendorsement').val('');
               
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
            }
        });
    }
</script>

<script type='text/javascript'>
    $('#addpropertyinsured-btn').click(function(e){
       //alert('masuk');
       e.preventDefault();

       var property_type_id = $('#mppropertytypelist').val();
       
       var slip_id = $('#slipnumber').val();
       var insured_id = $('#insuredIDtxt').val();
       var token2 = $('input[name=_token2]').val();
       
       $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

       $.ajax({
           url:"{{ route('propertytype.store') }}",
           type:"POST",
           data:{
               property_type_id:property_type_id,
               id_slip:slip_id,
               insured_id:insured_id
           },
           beforeSend: function() { $("body").addClass("loading");  },
            complete: function() {  $("body").removeClass("loading"); },
           success:function(response)
           {
            
               console.log(response)
               $('#propertyTypePanel tbody').prepend('<tr id="iidproperty'+response.id+'" data-name="propertytypevalue[]"><td data-name="'+response.propertydata+'">'+response.propertydata+'</td><td><a href="javascript:void(0)" onclick="deletepropertytypedetail('+response.id+')">delete</a></td></tr>');
              
           }
       });

   });
</script>

<script type='text/javascript'>
    function deletepropertytypedetail(id)
    {
        var token2 = $('input[name=_token2]').val();

        $.ajax({
            url:'{{ url("/") }}/delete-propertytype-list/'+id,
            type:"DELETE",
            data:{
                _token:token2
            },
            beforeSend: function() { $("body").addClass("loading");  },
            complete: function() {  $("body").removeClass("loading"); },
            success:function(response){
                
                $('#iidproperty'+id).remove();
                console.log(response);
            }
        });
    }
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


<script type='text/javascript'>
    $('#addinsuredsave-btn').click(function(e){
       //alert('masuk');
       e.preventDefault();

       var mpnumber = $('#insuredIDtxt').val();
       var mpinsured = $('#mpinsured').val();
       var mpsuggestinsured = $('#autocomplete').val();
       var mpsuffix = $('#autocomplete2').val();
       var mpshare = $('#mpshare').val();
       var mpsharefrom  = $('#mpsharefrom').val();
       var mpshareto = $('#mpshareto').val();
       var mpcoinsurance = $('#mpcoinsurance').val();
       var mpuy = $('#mpuy').val();
       

       var conv_mpsharefrom = mpsharefrom.replace(/,/g, "");
       console.log(conv_mpsharefrom)
       var real_mpsharefrom = parseInt(conv_mpsharefrom);
       console.log(real_mpsharefrom)

       var conv_mpshareto = mpshareto.replace(/,/g, "");
       console.log(conv_mpshareto)
       var real_mpshareto = parseInt(conv_mpshareto);
       console.log(real_mpshareto)

    //    if(isNaN(real_mpshareto))
    //    {
    //     real_mpshareto=0;
    //    }

    //    if(isNaN(real_mpsharefrom))
    //    {
    //     real_mpsharefrom=0;
    //    }
       
       
       var token2 = $('input[name=_token]').val();
       
       if(mpsuggestinsured == '' || mpshareto == ''){
        swal('given data was invalid!','please check input field','error input')
       }else{
        

       $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

       $.ajax({
           url:"{{ url('transaction-data/mp-insured/store') }}",
           type:"POST",
           data:{
               mpnumber:mpnumber,
               mpinsured:mpinsured,
               mpsuggestinsured:mpsuggestinsured,
               mpsuffix:mpsuffix,
               mpshare:mpshare,
               mpsharefrom:real_mpsharefrom,
               mpshareto:real_mpshareto,
               mpcoinsurance:mpcoinsurance,
               mpuy:mpuy
           },
           beforeSend: function() { $("body").addClass("loading");  },
           complete: function() {  $("body").removeClass("loading"); },
           success:function(response)
           {
                swal("Good job!", "Moveable Property Insert Success", "success")
                console.log(response)

                var real_ceding_share = response.ceding_share.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('#mpshare').val(real_ceding_share);
                $('#mpcountendorsement').val(response.count_endorsement);
                $("#addinsuredsave-btn").html('Update');

           },
           error: function (request, status, error) {
                //alert(request.responseText);
                swal("Error!", request.responseText, "Insert Error");
           }
       });

       }

   });
</script>




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
        var insuredshare = $('#mpsharefrom').val();
        var kurs = $('#mpkurs').val();
        var btnins = $("#addinsuredsave-btn").text();
        var currency = $( "#mpcurrency option:selected" ).text();
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

        var count_endorsement_ins = $('#mpcountendorsement').val();
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

            if(btnins == "Update")
            {

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

                        var tsiinsval = $('#mpshareto').val();
                        var conv_tsiinsval = tsiinsval.replace(/,/g, "");
                        var int_tsiinsval = parseFloat(conv_tsiinsval);
                        var int_fullins = int_tsiinsval.toFixed(2);
                        var new_instsi = int_fullins.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                        var cedshareins = $('#mpshare').val();
                        var conv_cedshareins = cedshareins.replace(/,/g, "");
                        var int_cedshareins = parseFloat(conv_cedshareins);
                        var int_fullcedshare = int_cedshareins.toFixed(2);
                        var new_cedshareins = int_fullcedshare.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                        console.log('type_tsi'+ type_tsi)
                        console.log('tsislipval'+ tsislipval)
                        console.log('tsiinsval'+ tsiinsval)
                        console.log('cedshareins'+ cedshareins)

                        if(type_tsi == 1){
                            console.log('int_tsislipval' + int_tsislipval)
                            console.log('int_tsiinsval' + int_tsiinsval)
                            console.log('int_fullslip' + int_fullslip)
                            console.log('int_fullins' + int_fullins)
                            if(tsislipval == new_instsi){
                                    $.ajaxSetup({
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        }
                                    });

                                    $.ajax({
                                         url:"{{url('transaction-data/mp-slip/store')}}",
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
                                               remarks:remarks
                                           },
                                           beforeSend: function() { $("body").addClass("loading");  },
                                           complete: function() {  $("body").removeClass("loading"); },
                                           success:function(response)
                                           {
                                            swal("Success!", "Moveable Property Slip Insert Success", "success")
                                            console.log(response)


                                           
                                            if(response.date_transfer){
                                                $('#SlipInsuredTableData tbody').prepend('<tr id="slipiid'+response.id+'" data-name="slipvalue[]"><td data-name="'+response.number+'">'+response.number+'</td></tr><tr><td></td><td data-name="'+response.cedingbroker+'">'+response.cedingbroker+'</td><td data-name="'+response.ceding+'">'+response.ceding+'</td>'
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
                                                $('#SlipInsuredTableData tbody').prepend('<tr id="slipiid'+response.id+'" data-name="slipvalue[]"><td data-name="'+response.number+'">'+response.number+'</td></tr><tr><td></td><td data-name="'+response.cedingbroker+'">'+response.cedingbroker+'</td><td data-name="'+response.ceding+'">'+response.ceding+'</td>'
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
                                            // $('#mpshare').val(response.ourshare);
                                            // $('#mpsharefrom').val(response.sumshare);
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
                                                swal("Error!", "Moveable Property Slip Insert Error : " + request.responseText, "Insert Error");
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
                                            formData.append('slip_type', 'mp');

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
                            if(tsislipval == new_cedshareins){
                                    $.ajaxSetup({
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        }
                                    });

                                    $.ajax({
                                         url:"{{url('transaction-data/mp-slip/store')}}",
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
                                               remarks:remarks
                                           },
                                           beforeSend: function() { $("body").addClass("loading");  },
                                           complete: function() {  $("body").removeClass("loading"); },
                                           success:function(response)
                                           {
                                            swal("Success!", "Moveable Property Slip Insert Success", "success")
                                            console.log(response)


                                            if(response.date_transfer){
                                                $('#SlipInsuredTableData tbody').prepend('<tr id="slipiid'+response.id+'" data-name="slipvalue[]"><td data-name="'+response.number+'">'+response.number+'</td></tr><tr><td></td><td data-name="'+response.cedingbroker+'">'+response.cedingbroker+'</td><td data-name="'+response.ceding+'">'+response.ceding+'</td>'
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
                                                $('#SlipInsuredTableData tbody').prepend('<tr id="slipiid'+response.id+'" data-name="slipvalue[]"><td data-name="'+response.number+'">'+response.number+'</td></tr><tr><td></td><td data-name="'+response.cedingbroker+'">'+response.cedingbroker+'</td><td data-name="'+response.ceding+'">'+response.ceding+'</td>'
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

                                        },
                                        error: function (request, status, error) {
                                                //alert(request.responseText);
                                                swal("Error!", "Moveable Property Slip Insert Error : " + request.responseText, "Insert Error");
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
                                            formData.append('slip_type', 'mp');


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
                                swal('Warning!','please check ceding share value again','insert error');
                            }
                        }
                    }else{
                        swal('Warning!','please check date insurance/reinsurance periode cannot minus','insert error');
                    }
                }else if(parseFloat(current_percent) > 100.00){
                    swal("Error!", "Please input installment panel until 100%", "Insert Error");
                }else if(parseFloat(current_percent) < 100.00){
                    swal("Error!", "Please input installment panel until 100%", "Insert Error");
                }else{
                    swal("Error!", "Please input installment panel until 100%", "Insert Error");
                }


                // var fesnumber = $('#insuredIDtxt').val();
                // var fesinsured = $('#mpinsured').val();
                // var fessuggestinsured = $('#autocomplete').val();
                // var fessuffix = $('#autocomplete2').val();
                // var fesshare = $('#mpshare').val();
                // var fessharefrom  = $('#mpsharefrom').val();
                // var fesshareto = $('#mpshareto').val();
                // var fescoinsurance = $('#mpcoinsurance').val();
                // var feuy = $('#mpuy').val();

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
                // url:"{{ url('transaction-data/mp-insured/store') }}",
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
                //     //swal("Success!", "Moveable Property Insert Success", "success")
                //     console.log(response)
                //     $('#mpcountendorsement').val(response.count_endorsement);
                //     var real_ceding_share = response.ceding_share.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                //     $('#mpshare').val(real_ceding_share);

                // },
                // error: function (request, status, error) {
                //             //alert(request.responseText);
                //             swal("Error!", "Moveable Property Insured Insert Error", "Insert Error");
                //         }
                // });

            }else{
                swal("Error!", "Please Save Insured First", "Insert Error");
            }

        }
        else {
            swal('Cancelled');
        
        }

    });

});
</script>

<script type='text/javascript'>
    $('#multi-file-upload-ajax2').submit(function(e){
       //alert('masuk');
       e.preventDefault();

       var code_ms = $('#insuredIDtxt').val();
       var slipnumber = $('#slipnumber').val();
       var prevslipnumber = $('#prevslipnumber').val();
       var slipdatetransfer = $('#sliptd').val();
       var slipstatus = $('#slipstatus').val();
       //var sliped = $('#sliped').val();
       //var slipsls = $('#slipsls').val();
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
       var slipvbroker =  $('#slipvbroker').val();
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

       var token2 = $('input[name=_token]').val();

       var conv_sliptotalsum = sliptotalsum.replace(/,/g, "");
       console.log(conv_sliptotalsum)
       var real_sliptotalsum = parseInt(conv_sliptotalsum);
       console.log(real_sliptotalsum)
       
       var conv_sliptotalsumpct = sliptotalsumpct.replace(/,/g, "");
       console.log(conv_sliptotalsumpct)
       var real_sliptotalsumpct = parseInt(conv_sliptotalsumpct);
       console.log(real_sliptotalsumpct)

       var conv_slipsumshare = slipsumshare.replace(/,/g, "");
       console.log(conv_slipsumshare)
       var real_slipsumshare = parseInt(conv_slipsumshare);
       console.log(real_slipsumshare)

       var conv_slipbasicpremium = slipbasicpremium.replace(/,/g, "");
       console.log(conv_slipbasicpremium)
       var real_slipbasicpremium = parseInt(conv_slipbasicpremium);
       console.log(real_slipbasicpremium)

       var conv_slipgrossprmtonr = slipgrossprmtonr.replace(/,/g, "");
       console.log(conv_slipgrossprmtonr)
       var real_slipgrossprmtonr = parseInt(conv_slipgrossprmtonr);
       console.log(real_slipgrossprmtonr)

       var conv_slipsumcommission = slipsumcommission.replace(/,/g, "");
       console.log(conv_slipsumcommission)
       var real_slipsumcommission = parseInt(conv_slipsumcommission);
       console.log(real_slipsumcommission)

       var conv_slipnetprmtonr = slipnetprmtonr.replace(/,/g, "");
       console.log(conv_slipnetprmtonr)
       var real_slipnetprmtonr = parseInt(conv_slipnetprmtonr);
       console.log(real_slipnetprmtonr)

       var conv_slipsumor = slipsumor.replace(/,/g, "");
       console.log(conv_slipsumor)
       var real_slipsumor = parseInt(conv_slipsumor);
       console.log(real_slipsumor)
       
       
       //ajaxfilefunction(e);

       $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

       $.ajax({
         url:"{{url('transaction-data/mp-slip/store')}}",
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
               wpc:wpc
           },
           beforeSend: function() { $("body").addClass("loading");  },
           complete: function() {  $("body").removeClass("loading"); },
           success:function(response)
           {
            swal("Success!", "Moveable Property Slip Insert Success", "success")
            console.log(response)

           $('#SlipInsuredTableData tbody').prepend('<tr id="slipiid'+response.id+'" data-name="slipvalue[]"><td data-name="'+response.number+'">'+response.number+'</td><td data-name="'+response.cedingbroker+'">"'+response.cedingbroker+'"</td><td data-name="'+response.ceding+'">'+response.ceding+'</td><td data-name="'+response.slipstatus+'">"'+slipstatus+'"</td><td><a class="text-primary mr-3 float-right" data-toggle="modal"  data-book-id="'+response.number+'" data-target="#detailmodaldata" href="#detailmodaldata">'
                +'<button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#detailmodaldata2">Detail</button>'
                +'</a>'
                +'<a class="text-primary mr-3 float-right " data-toggle="modal" data-book-id="'+response.number+'" data-target="#updatemodaldata">'
                +'<button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#updatemodaldata2">Edit</button>'
                +'</a>'
                +'<a class="text-primary mr-3 float-right " data-toggle="modal" data-book-id="'+response.number+'" data-target="#endorsementmodaldata">'
                +'<button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#endorsementmodaldata2">Endorsement</button>'
                +'</a><td></td></tr>');

            $('#slipnumber').val(response.code_sl);

        },
        error: function (request, status, error) {
                //alert(request.responseText);
                swal("Error!", "Moveable Property Slip Insert Error", "Insert Error");
            }
        });



       var formData = new FormData(this);
       let TotalFiles = $('#attachment')[0].files.length; //Total files
       let files = $('#attachment')[0];
       var slip_id = $('#slipnumber').val();
       var insured_id = $('#insuredIDtxt').val();

       for (let i = 0; i < TotalFiles; i++) 
       {
        formData.append('files' + i, files.files[i]);
    }

    formData.append('TotalFiles', TotalFiles);
    formData.append('slip_id', slip_id);
    formData.append('insured_id', insured_ids);
    formData.append('slip_type', 'mp');


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
      var fesnumber = $('#insuredIDtxt').val();
      var fesinsured = $('#mpinsured').val();
      var fessuggestinsured = $('#autocomplete').val();
      var fessuffix = $('#autocomplete2').val();
      var fesshare = $('#mpshare').val();
      var fessharefrom  = $('#mpsharefrom').val();
      var fesshareto = $('#mpshareto').val();
      var fescoinsurance = $('#mpcoinsurance').val();


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
         url:"{{ url('transaction-data/mp-insured/store') }}",
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
            swal("Success!", "Moveable Property Insert Success", "success")
            console.log(response)

        },
        error: function (request, status, error) {
                //alert(request.responseText);
                swal("Error!", "Moveable Property Insured Insert Error", "Insert Error");
            }
        });


      $('#installmentPanel tbody').empty();
      $('#ExtendCoveragePanel tbody').empty();
      $('#deductiblePanel tbody').empty();
      $('#retrocessionPanel tbody').empty();


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

       var count_endorsement_ins = $('#mpcountendorsement').val();
       console.log('count endorsement ' + count_endorsement_ins)


        if(current_percent >= '100'){
             $.ajaxSetup({
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

               $.ajax({
                 url:"{{url('transaction-data/mp-slip/updateform')}}",
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
                     remarks:remarks
                 },
                 beforeSend: function() { $("body").addClass("loading");  },
                 complete: function() {  $("body").removeClass("loading"); },
                 success:function(response)
                 {
                    swal("Success!", "Moveable Property Slip Update Success", "success")
                    console.log(response)
                    if(response.new_share_nasre){
                        var new_nasre = response.new_share_nasre;
                        var conv_nasre = new_nasre.toFixed(2);
                        var real_nasre = conv_nasre.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        $('#mpsharefrom').val(real_nasre);
                    }

                    $('#updatemodaldata').modal('toggle');
                    $('#updatemodaldata2').modal('toggle');

                    },
                    error: function (request, status, error) {
                        //alert(request.responseText);
                        swal("Error!", "Moveable Property Slip Update Error", "Update Error");
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
            formData.append('slip_type', 'mp');


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
       var slipvbroker =  $('#v_brokerendorsement').val();
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

       var token2 = $('input[name=_token]').val();

       var countendorsement = $('#countendorsmentdata').val();
       var sliptypetsi = $('#sliptypetsiendorsement').val();
       var sharetypetsi = $('#sharetypetsiendorsement').val();      
       var sharetotalsum = $('#sharetotalsumendorsement').val();
       var slipsumrate =  $('#sliptotalrateendorsement').val();
       var slipsumvbroker =  $('#slipsumfeeendorsement').val();
       var sliptotalday = $('#slipdaytotalendorsement').val();
       var sliptotalyear = $('#slipdaytotalendorsement3').val();
       var sliptotaldatesum = $('#sliptotalsumdateendorsement').val();
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

       $.ajax({
         url:"{{url('transaction-data/mp-slip/endorsementstore')}}",
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
             total_day:sliptotalday,
             total_year:sliptotalyear,
             sum_total_date:sliptotaldatesum,
             type_tsi:sliptypetsi,
             share_tsi:real_slipsharetotalsum,
             type_share_tsi:sharetypetsi,
             sliptotalrate:real_slipsumrate,
             sum_feebroker:real_slipsumvbroker
         },
         beforeSend: function() { $("body").addClass("loading");  },
         complete: function() {  $("body").removeClass("loading"); },
         success:function(response)
         {
            swal("Success!", "Moveable Property Slip Endorsement Success", "success")
            console.log(response)

            // var insured_data2=JSON.parse(response.insured_data);
            // $('#mpcountendorsement').val(insured_data2.count_endorsement);
            //alert(insured_data2.count_endorsement);

            var slip_data2array=JSON.parse(response.slip_dataarray);
            var slip_dataarray=JSON.parse(response.slip_data);
            
            // $('#SlipInsuredTableData tbody tr[id=slipiid'+response.oldid+']').remove();

             var max_endorsement = response.max_endorsement;
            console.log('max endorse ' + response.max_endorsement)

            $('#SlipInsuredTableData tbody').empty();
            // $('#SlipInsuredTableData tbody').remove();

            var slipdata= JSON.parse(response.slip_data_distinct);
            var slipdatadetail= JSON.parse(response.slip_data2);
                
            for(var i = 0; i < slipdata.length; i++){

                    var id = slipdata[i].id;
                    var number = slipdata[i].number;

                    $('#SlipInsuredTableData  ').prepend('<tr id="slipiid'+id+'" data-name="slipvalue[]">'
                     +'<td data-name="'+number+'">'+number+'</td><td></td><td></td><td></td><td></td></tr>');


                    for(var i = 0; i < slipdatadetail.length; i++){

                    var cedingbroker = slipdatadetail[i].name;
                    var cedingbrokercn = slipdatadetail[i].company_name;
                    var ceding = slipdatadetail[i].source_name;
                    var cedingcn = slipdatadetail[i].source_companyname;
                    var id_detail = slipdatadetail[i].id;
                    var statusdetail = slipdatadetail[i].status;
                    var endorsmentdetail = slipdatadetail[i].endorsment;
                    var date_transfer = slipdatadetail[i].date_transfer;

                    if(endorsmentdetail == max_endorsement){
                        if(date_transfer == null){
                            $('#slipiid'+id).after('<tr>'
                            +'<td></td>'
                            +'<td data-name="'+cedingbroker+'">'+cedingbroker+'-'+cedingbrokercn+'</td>'
                             +'<td data-name="'+ceding+'">'+ceding+'-'+cedingcn+'</td>'
                             +'<td data-name="'+statusdetail+'">'+statusdetail+'</td>'
                             +'<td data-name="'+endorsmentdetail+'">'+endorsmentdetail+'</td>'
                             +'<td><a class="text-primary mr-3 float-right" data-toggle="modal"  data-book-id="'+id_detail+'" data-target="#detailmodaldata" href="#detailmodaldata">'
                             +'<button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#detailmodaldata2">Detail</button>'
                             +'</a>'
                             +'<a class="text-primary mr-3 float-right " data-toggle="modal" data-book-id="'+id_detail+'" data-target="#updatemodaldata">'
                             +'<button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#updatemodaldata2">Edit</button>'
                             +'</a>'
                             +'<a class="text-primary mr-3 float-right " data-toggle="modal" data-book-id="'+id_detail+'" data-target="#cancelmodaldata">'
                             +'<button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#cancelmodaldata2">Cancel</button>'
                             +'</a>'
                             +'</td></tr>');
                        }else if(date_transfer != null || statusdetail == 'cancel' || statusdetail == 'decline'){
                            $('#slipiid'+id).after('<tr>'
                             +'<td></td>'
                             +'<td data-name="'+cedingbroker+'">'+cedingbroker+'-'+cedingbrokercn+'</td>'
                             +'<td data-name="'+ceding+'">'+ceding+'-'+cedingcn+'</td>'
                             +'<td data-name="'+statusdetail+'">'+statusdetail+'</td>'
                             +'<td data-name="'+endorsmentdetail+'">'+endorsmentdetail+'</td>'
                             +'<td><a class="text-primary mr-3 float-right" data-toggle="modal"  data-book-id="'+id_detail+'" data-target="#detailmodaldata" href="#detailmodaldata">'
                             +'<button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#detailmodaldata2">Detail</button>'
                             +'</a>'
                            +'<a class="text-primary mr-3 float-right " data-toggle="modal" data-book-id="'+id_detail+'" data-target="#endorsementmodaldata">'
                             +'<button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#endorsementmodaldata2">Endorsement</button>'
                             +'</a>'
                             +'<a class="text-primary mr-3 float-right " data-toggle="modal" data-book-id="'+id_detail+'" data-target="#cancelmodaldata">'
                             +'<button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#cancelmodaldata2">Cancel</button>'
                             +'</a>'
                             +'</td></tr>');
                        }
                        
                    
                    }else{
                        $('#slipiid'+id).after('<tr><td></td>'
                         +'<td data-name="'+cedingbroker+'">'+cedingbroker+'-'+cedingbrokercn+'</td>'
                         +'<td data-name="'+ceding+'">'+ceding+'-'+cedingcn+'</td>' 
                         +'<td data-name="'+statusdetail+'">'+statusdetail+'</td>'
                         +'<td data-name="'+endorsmentdetail+'">'+endorsmentdetail+'</td>'
                         +'<td><a class="text-primary mr-3 float-right" data-toggle="modal"  data-book-id="'+id_detail+'" data-target="#detailmodaldata" href="#detailmodaldata">'
                         +'<button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#detailmodaldata2">Detail</button>'
                         +'</a>'
                         +'</td></tr>');
                    }
                    
                    

                };

            };
            
            // slip_data2array.forEach(function (arrayItem) 
            // {
                //var x = arrayItem.prop1 + 2;
                
                // $('#SlipInsuredTableData tbody ').prepend('<tr id="slipiid'+slip_dataarray.id+'" data-name="slipvalue[]"><td data-name="'+slip_dataarray.number+'">'+slip_dataarray.number+'</td><td data-name="'+slip_dataarray.cedingbroker+'">'+slip_dataarray.cedingbroker+'</td><td data-name="'+slip_dataarray.ceding+'">'+slip_dataarray.ceding+'</td><td data-name="'+slip_dataarray.status+'">'+slip_dataarray.status+'</td><td>'
                //      +'<a class="text-primary mr-3 float-right" data-toggle="modal"  data-book-id="'+slip_dataarray.id+'" data-target="#detailmodaldata" href="#detailmodaldata">'
                //      +'<button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#detailmodaldata2">Detail</button>'
                //      +'</a>'
                //      +'<a class="text-primary mr-3 float-right " data-toggle="modal" data-book-id="'+slip_dataarray.id+'" data-target="#updatemodaldata">'
                //      +'<button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#updatemodaldata2">Edit</button>'
                //      +'</a>'
                //      +'<a class="text-primary mr-3 float-right " data-toggle="modal" data-book-id="'+slip_dataarray.id+'" data-target="#endorsementmodaldata">'
                //      +'<button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#endorsementmodaldata2">Endorsement</button>'
                //      +'</a>'
                //      +'<a class="text-primary mr-3 float-right " data-toggle="modal" data-book-id="'+slip_dataarray.id+'" data-target="#cancelmodaldata">'
                //      +'<button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#cancelmodaldata2">Cancel</button>'
                //      +'</a>'
                //      +'<button type="button" id="claim-endorse" class="btn btn-sm btn-warning float-right">Claim</button>'
                //      +'</td></tr>');


            // });

            
            $('#endorsementmodaldata').modal('toggle');
            $('#endorsementmodaldata2').modal('toggle');

            // $('#slipnumberendorsement').val(response.number);

        },
        error: function (request, status, error) {
            //alert(request.responseText);
            swal("Error!", "Moveable Property Slip Endorsement Error", "Insert Error");
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
    formData.append('slip_type', 'mp');


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
      var fesinsured = $('#mpinsured').val();
      var fessuggestinsured = $('#autocomplete').val();
      var fessuffix = $('#autocomplete2').val();
      var fesshare = $('#mpshare').val();
      var fessharefrom  = $('#mpsharefrom').val();
      var fesshareto = $('#mpshareto').val();
      var fescoinsurance = $('#mpcoinsurance').val();


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
         url:"{{ url('transaction-data/mp-insured/store') }}",
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
            swal("Success!", "Moveable Property Insert Success", "success")
            console.log(response)

        },
        error: function (request, status, error) {
                //alert(request.responseText);
                swal("Error!", "Moveable Property Insured Insert Error", "Insert Error");
            }
        });

      */

      $('#installmentPanelendorsement tbody').empty();
      $('#ExtendCoveragePanelendorsement tbody').empty();
      $('#deductiblePanelendorsement tbody').empty();
      $('#retrocessionPanelendorsement tbody').empty();



  });

function addendorsement(slipid){
    var slipid = slipid;
    var token2 = $('input[name=_token]').val();

    console.log(slipid)

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
     url:"{{url('transaction-data/mp-slip/endorsementstore')}}",
     type:"POST",
     data:{
        slipid:slipid

    },
    beforeSend: function() { $("body").addClass("loading");  },
    complete: function() {  $("body").removeClass("loading"); },
    success:function(response)
    {


       if(response){
        console.log(response)
        if(response.insured_data){
            var insured_list = JSON.parse(response.insured_data); 

            for(var i = 0; i < insured_list.length; i++) 
            {
                var obj = insured_list[i];

                $('#mpsnumber').val('');
                $('#mpsinsured').val('');
                $('#autocomplete').val('');
                $('#autocomplete2').val('');
                $('#mpshare').val('');
                $('#mpsharefrom').val('');
                $('#mpuy').val('');
                $('#mpshareto').val('');

                $('#mpsnumber').val(obj.number);
                $('#mpsinsured').val(obj.insured_prefix);
                $('#autocomplete').val(obj.insured_name);
                $('#autocomplete2').val(obj.insured_suffix);
                $('#mpshare').val(obj.share);
                $('#mpsharefrom').val(obj.share_from);
                $('#mpuy').val(obj.uy);
                $('#mpshareto').val(obj.share_to);


            }
        }
        else{
            swal("Failed!", "Moveable Property Insured Data Endorsement Failed", "Endorsement Failed")
        }

        if(response.location_data){

            var location_list = JSON.parse(response.location_data); 

            for(var i = 0; i < location_list.length; i++) 
            {
                var obj = location_list[i];
                $('#locRiskTable > tbody:last-child').empty();
                $('#locRiskTable > tbody:last-child').prepend('<tr id="sid'+obj.id+'">'+
                    '<td>'+obj.loc_code+'</td>'+
                    '<td>'+obj.address+ obj.latitude+' , '+obj.longtitude+'<br>'+ obj.postal_code+'</td>'+
                    '<td>'+obj.latitude+' , '+obj.longtitude+'<br></td>'+
                    '<td>'+
                    '<a class="text-primary mr-3 float-right " data-toggle="modal" data-look-id="'+obj.id+'" data-target="#addlocdetailmodaldata">'+
                    '<button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#addlocdetailmodaldata2">Add</button>'+
                    '</a>'+
                    '<a href="javascript:void(0)" onclick="deletelocationdetail('+obj.id+')"><i class="fas fa-trash text-danger"></i></a></td>'+
                    '</tr>'+

                    '<tr id="cid'+obj.id+'">'+
                    '<td></td>'+
                    '<td colspan="3">'+
                    '<table id="tcid'+obj.id+'" width="600" class="table table-bordered table-striped">'+
                    '<thead>'+
                    '<tr>'+
                    '<th>Interest Insured</th>'+
                    '<th>Ceding/Broker</th>'+
                    '<th>CN No</th>'+
                    '<th>Cert No</th>'+
                    '<th>Ref No</th>'+
                    '<th>amount</th>'+
                    '<th>Action</th>'+
                    '</tr>'+
                    '</thead>'+
                    '<tbody id="tbcid'+obj.id+'">'+
                    '</tbody>'+
                    '</table>'+
                    '</td>'+
                    '</tr>');


                if(response.risklocation_data)
                {

                    var risklocation_list = JSON.parse(response.risklocation_data); 

                    for(var i = 0; i < risklocation_list.length; i++) 
                    {
                        var obj2 = risklocation_list[i];

                        $('#tcid'+obj2.id+' > tbody:last-child').empty();
                                    // var curr_amount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(obj2.amountlocation);
                                    var curr_amount =obj2.amountlocation.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                                    $('#tcid'+obj.id+' > tbody:last-child').prepend('<tr id="riskdetailsid'+obj2.id+'">'+
                                        '<td>'+obj2.description+'</td>'+
                                        '<td>'+obj2.name+'</td>'+
                                        '<td>'+obj2.cnno+'</td>'+
                                        '<td>'+obj2.certno+'</td>'+
                                        '<td>'+obj2.refno+'</td>'+
                                        '<td>'+curr_amount+'</td>'+
                                        '<td>'+
                                        '<a href="javascript:void(0)" onclick="deletelocationriskdetail('+obj2.id+')"><i class="fas fa-trash text-danger"></i></a></td>'+
                                        '</tr>');


                                    // +'<a class="text-primary mr-3 float-right " data-toggle="modal" data-book-id="'+obj.number+'" data-target="#endorsementmodaldata">'
                                    // +'<button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#endorsementmodaldata2">Endorsement</button>'
                                    // +'</a>'
                                    // +'<button type="button" class="btn btn-sm btn-primary float-right" onclick="'+obj.id+'">Endorsement</button>'
                                    // +'<td></td></tr>');

                                    
                                }
                            }else{
                                swal("Failed!", "Moveable Property Risk Location Data Endorsement Failed", "Endorsement Failed")
                            }



                        }
                    }
                    else{
                        swal("Failed!", "Moveable Property Location Data Endorsement Failed", "Endorsement Failed")
                    }

                    


                    if(response.slip_data){

                        var slip_list = JSON.parse(response.slip_data); 

                        for(var i = 0; i < slip_list.length; i++) 
                        {
                            var obj = slip_list[i];

                            $('#SlipInsuredTableData tbody').empty();
                            $('#SlipInsuredTableData tbody').prepend('<tr id="slipiid'+obj.id+'" data-name="slipvalue[]"><td data-name="'+obj.number+'">'+obj.number+'</td><td data-name="'+obj.source+'">"'+obj.source+'"</td><td data-name="'+obj.source_2+'">'+obj.source_2+'</td><td data-name="'+obj.status+'">"'+obj.status+'"</td>'
                                +'<td><a class="text-primary mr-3 float-right" data-toggle="modal"  data-book-id="'+obj.number+'" data-target="#detailmodaldata" href="#detailmodaldata">'
                                +'<button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#detailmodaldata2">Detail</button>'
                                +'</a>'
                                +'<a class="text-primary mr-3 float-right " data-toggle="modal" data-book-id="'+obj.number+'" data-target="#updatemodaldata">'
                                +'<button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#updatemodaldata2">Edit</button>'
                                +'</a>'
                            // +'<a class="text-primary mr-3 float-right " data-toggle="modal" data-book-id="'+obj.number+'" data-target="#endorsementmodaldata">'
                            // +'<button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#endorsementmodaldata2">Endorsement</button>'
                            // +'</a>'
                            +'<button type="button" class="btn btn-sm btn-primary float-right" onclick="'+obj.id+'">Endorsement</button>'
                            +'<td></td></tr>');
                            // $('#ExtendCoveragePaneldetail tbody').prepend('<tr id="iidextendcoveragedetail'+obj.id+'" data-name="extendcoveragedetailvalue[]"><td data-name="'+obj.coveragetype+'">'+obj.coveragetype+'</td><td data-name="'+obj.percentage+'">'+obj.percentage+'</td><td data-name="'+curr_amount+'">'+curr_amount+'</td><td></td></tr>');
                            
                        }
                    }
                    else{
                        swal("Failed!", "Moveable Property Slip Data Endorsement Failed", "Endorsement Failed")

                    }
                    window.location.replace("{{url('transaction-data/mp-slipindex')}}");
                    swal("Success!", "Moveable Property Slip Endorsement Success", "Endorsement Success")

                }else{
                    swal("Error!", "Moveable Property Slip Endorsement Data Error", "Endorsement Data Error");
                }
                // $('#SlipInsuredTableData tbody').prepend('<tr id="slipiid'+response.id+'" data-name="slipvalue[]"><td data-name="'+response.number+'">'+response.number+'</td><td data-name="'+response.cedingbroker+'">"'+response.cedingbroker+'"</td><td data-name="'+response.ceding+'">'+response.ceding+'</td><td data-name="'+response.slipstatus+'">"'+slipstatus+'"</td><td><a class="text-primary mr-3 float-right" data-toggle="modal"  data-book-id="'+response.id+'" data-target="#detailmodaldata" href="#detailmodaldata">'
                //     +'<button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#detailmodaldata2">Detail</button>'
                //     +'</a>'
                //     +'<a class="text-primary mr-3 float-right " data-toggle="modal" data-book-id="'+response.number+'" data-target="#updatemodaldata">'
                //     +'<button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#updatemodaldata2">Edit</button>'
                //     +'</a>'
                //     +'<a class="text-primary mr-3 float-right " data-toggle="modal" data-book-id="'+response.number+'" data-target="#endorsementmodaldata">'
                //     +'<button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#endorsementmodaldata2">Endorsement</button>'
                //     +'</a><td></td></tr>');


                // $('#slipnumberendorsement').val(response.number);

            },
            error: function (request, status, error) {
                //alert(request.responseText);
                swal("Error!", "Moveable Property Slip Endorsement Error", "Endorsement Error");
            }
        });

}
</script>



