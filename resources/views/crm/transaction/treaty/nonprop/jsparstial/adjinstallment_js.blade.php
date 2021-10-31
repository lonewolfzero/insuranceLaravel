<script type='text/javascript'>
   $('#adjustment52').keyup(function(e)
   {
        
        var actualogrpi = $('#ogrpi52').val();
        var adjpremrate = $('#premratelayer62').val();
        
        if(actualogrpi != null)
        {
            actualogrpi=parseInt(actualogrpi.replace(/,/g, ""));
            var adjusmentdata = $('#adjustment52').val();
            var adjusment = parseInt(adjusmentdata.replace(/,/g, ""));

            var totalresultogrpi=(adjusment*100)/adjpremrate;
            var hasiltotalogrpi=totalresultogrpi.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            $('#ogrpi52').val(hasiltotalogrpi);

            var mindeplayer100=$('#mindeplayer62').val();
            mindeplayer100=parseInt(mindeplayer100.replace(/,/g, ""));

            var totalresult=totalresultogrpi-mindeplayer100;
            var real_total = totalresult.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            $('#additional_premium52').val(real_total);

        }
        else
        {
            swal('warning!','please fill MD Premium first','error')
        }
    
    });
</script>


<script type='text/javascript'>
   
   $('#ogrpi52').keyup(function(e)
   {
        
        var actualogrpi = $('#ogrpi52').val();
        var adjpremrate = $('#premratelayer62').val();
        
        if(actualogrpi != null)
        {
            actualogrpi=parseInt(actualogrpi.replace(/,/g, ""));
        
            var sum_amount2 = isNaN((actualogrpi*adjpremrate)/100) ? 0 :((actualogrpi*adjpremrate)/100);
            var real_sum2 = sum_amount2.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            $('#adjustment52').val(real_sum2);
            
            var mindeplayer100=$('#mindeplayer62').val();
            mindeplayer100=parseInt(mindeplayer100.replace(/,/g, ""));

            var totalresult=sum_amount2-mindeplayer100;
            var real_total = totalresult.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            $('#additional_premium52').val(real_total);

        }
        else
        {
            swal('warning!','please fill MD Premium first','error')
        }
    
    });
</script>



<script type='text/javascript'>
   $('#brokeragepercentage52').keyup(function(e)
   {
       
            var brokeragepersen = $('#brokeragepercentage52').val();
            var addpremium = $('#additional_premium52').val();
           
            if(brokeragepersen != null)
            {
                addpremium=parseInt(addpremium.replace(/,/g, ""));
            
                var sum_amount2 = isNaN((brokeragepersen*addpremium)/100) ? 0 :((brokeragepersen*addpremium)/100);
                var real_sum2 = sum_amount2.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('#brokerage52').val(real_sum2);
                
                var discpersen = $('#discpecentage52').val();
                if(isNaN(discpersen))
                {
                    discpersen=0;
                }
                
                var sum_discount2 = isNaN((discpersen*addpremium)/100) ? 0 :((discpersen*addpremium)/100);
                var real_discount2 = sum_discount2.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('#disc52').val(real_discount2);

                var totalnetaddpremium=(addpremium)-(sum_amount2);
                $('#net_add_premium52').val(totalnetaddpremium);

                var nasreshare=$('#nasreshare62').val();
                var totalreshare = isNaN((totalnetaddpremium*nasreshare)/100) ? 0 :((totalnetaddpremium*nasreshare)/100);
                $('#re_sharer52').val(totalreshare);


            }
            else
            {
                swal('warning!','please fill MD Premium first','error')
            }
        
       
   });
</script>


<script type='text/javascript'>
   $('#brokerage52').keyup(function(e)
   {
       
            var brokeragepersen = $('#brokeragepercentage52').val();
            var addpremium = $('#additional_premium52').val();
           
            if(brokeragepersen != null)
            {
                addpremium=parseInt(addpremium.replace(/,/g, ""));

                //var sum_amount2 = isNaN((brokeragepersen*addpremium)/100) ? 0 :((brokeragepersen*addpremium)/100);
                //var real_sum2 = sum_amount2.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                //$('#brokerage52').val(real_sum2);
            
                var discpersen = $('#discpecentage52').val();
                if(isNaN(discpersen))
                {
                    discpersen=0;
                }
                
                var sum_discount2 = isNaN((discpersen*addpremium)/100) ? 0 :((discpersen*addpremium)/100);
                var real_discount2 = sum_discount2.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('#disc52').val(real_discount2);

                var totalnetaddpremium=(addpremium)-(sum_amount2);
                $('#net_add_premium52').val(totalnetaddpremium);

                var nasreshare=$('#nasreshare62').val();
                var totalreshare = isNaN((totalnetaddpremium*nasreshare)/100) ? 0 :((totalnetaddpremium*nasreshare)/100);
                $('#re_sharer52').val(totalreshare);

            }
            else
            {
                swal('warning!','please fill MD Premium first','error')
            }
        
       
   });
</script>
   

<script type='text/javascript'>
   $('#discpecentage52').keyup(function(e)
   {
       
            var brokeragepersen = $('#brokeragepercentage52').val();
            var addpremium = $('#additional_premium52').val();
           
            if(brokeragepersen != null)
            {
                addpremium=parseInt(addpremium.replace(/,/g, ""));
            
                var sum_amount2 = isNaN((brokeragepersen*addpremium)/100) ? 0 :((brokeragepersen*addpremium)/100);
                var real_sum2 = sum_amount2.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('#brokerage52').val(real_sum2);
                
                var discpersen = $('#discpecentage52').val();
                if(isNaN(discpersen))
                {
                    discpersen=0;
                }
                
                var sum_discount2 = isNaN((discpersen*addpremium)/100) ? 0 :((discpersen*addpremium)/100);
                var real_discount2 = sum_discount2.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('#disc52').val(real_discount2);

                var totalnetaddpremium=(addpremium)-(sum_amount2);
                $('#net_add_premium52').val(totalnetaddpremium);

                var nasreshare=$('#nasreshare62').val();
                var totalreshare = isNaN((totalnetaddpremium*nasreshare)/100) ? 0 :((totalnetaddpremium*nasreshare)/100);
                $('#re_sharer52').val(totalreshare);


            }
            else
            {
                swal('warning!','please fill MD Premium first','error')
            }
        
   });
</script>



<script type='text/javascript'>
   $('#disc52').keyup(function(e)
   {
       
            var brokeragepersen = $('#brokeragepercentage52').val();
            var addpremium = $('#additional_premium52').val();
           
            if(brokeragepersen != null)
            {
                addpremium=parseInt(addpremium.replace(/,/g, ""));
            
                var sum_amount2 = isNaN((brokeragepersen*addpremium)/100) ? 0 :((brokeragepersen*addpremium)/100);
                var real_sum2 = sum_amount2.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('#brokerage52').val(real_sum2);
                
                var discpersen = $('#discpecentage52').val();
                if(isNaN(discpersen))
                {
                    discpersen=0;
                }
                
                //var sum_discount2 = isNaN((discpersen*addpremium)/100) ? 0 :((discpersen*addpremium)/100);
                //var real_discount2 = sum_discount2.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                //$('#disc52').val(real_discount2);

                var totalnetaddpremium=(addpremium)-(sum_amount2);
                $('#net_add_premium52').val(totalnetaddpremium);

                var nasreshare=$('#nasreshare62').val();
                var totalreshare = isNaN((totalnetaddpremium*nasreshare)/100) ? 0 :((totalnetaddpremium*nasreshare)/100);
                $('#re_sharer52').val(totalreshare);
            }
            else
            {
                swal('warning!','please fill MD Premium first','error')
            }
        
   });
</script>




<script type='text/javascript'>
   $('#adjustmentupdate52').keyup(function(e)
   {
        
        var actualogrpi = $('#ogrpiupdate52').val();
        var adjpremrate = $('#premratelayerupdate62').val();
        
        if(actualogrpi != null)
        {
            actualogrpi=parseInt(actualogrpi.replace(/,/g, ""));
            var adjusmentdata = $('#adjustmentupdate52').val();
            var adjusment = parseInt(adjusmentdata.replace(/,/g, ""));

            var totalresultogrpi=(adjusment*100)/adjpremrate;
            var hasiltotalogrpi=totalresultogrpi.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            $('#ogrpiupdate52').val(hasiltotalogrpi);

            var mindeplayer100=$('#mindeplayerupdate62').val();
            mindeplayer100=parseInt(mindeplayer100.replace(/,/g, ""));

            var totalresult=totalresultogrpi-mindeplayer100;
            var real_total = totalresult.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            $('#additional_premiumupdate52').val(real_total);

        }
        else
        {
            swal('warning!','please fill MD Premium first','error')
        }
    
    });
</script>



<script type='text/javascript'>
   
   $('#ogrpiupdate52').keyup(function(e)
   {
        var actualogrpi = $('#ogrpiupdate52').val();
        var adjpremrate = $('#premratelayerupdate62').val();
        
        if(actualogrpi != null)
        {
            actualogrpi=parseInt(actualogrpi.replace(/,/g, ""));
        
            var sum_amount2 = isNaN((actualogrpi*adjpremrate)/100) ? 0 :((actualogrpi*adjpremrate)/100);
            var real_sum2 = sum_amount2.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            $('#adjustmentupdate52').val(real_sum2);
            
            var mindeplayer100=$('#mindeplayerupdate62').val();
            mindeplayer100=parseInt(mindeplayer100.replace(/,/g, ""));

            var totalresult=sum_amount2-mindeplayer100;
            var real_total = totalresult.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            $('#additional_premiumupdate52').val(real_total);

        }
        else
        {
            swal('warning!','please fill MD Premium first','error')
        }
    
    });
</script>



<script type='text/javascript'>
   $('#brokeragepercentageupdate52').keyup(function(e)
   {
            var brokeragepersen = $('#brokeragepercentageupdate52').val();
            var addpremium = $('#additional_premiumupdate52').val();
           
            if(brokeragepersen != null)
            {
                addpremium=parseInt(addpremium.replace(/,/g, ""));
            
                var sum_amount2 = isNaN((brokeragepersen*addpremium)/100) ? 0 :((brokeragepersen*addpremium)/100);
                var real_sum2 = sum_amount2.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('#brokerageupdate52').val(real_sum2);
                
                var discpersen = $('#discpecentageupdate52').val();
                if(isNaN(discpersen))
                {
                    discpersen=0;
                }
                
                var sum_discount2 = isNaN((discpersen*addpremium)/100) ? 0 :((discpersen*addpremium)/100);
                var real_discount2 = sum_discount2.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('#discupdate52').val(real_discount2);

                var totalnetaddpremium=(addpremium)-(sum_amount2);
                $('#net_add_premiumupdate52').val(totalnetaddpremium);

                var nasreshare=$('#nasreshareupdate62').val();
                var totalreshare = isNaN((totalnetaddpremium*nasreshare)/100) ? 0 :((totalnetaddpremium*nasreshare)/100);
                $('#re_sharerupdate52').val(totalreshare);


            }
            else
            {
                swal('warning!','please fill MD Premium first','error')
            }
   });
</script>
   

<script type='text/javascript'>
   $('#brokerageupdate52').keyup(function(e)
   {
            var brokeragepersen = $('#brokeragepercentageupdate52').val();
            var addpremium = $('#additional_premiumupdate52').val();
           
            if(brokeragepersen != null)
            {
                addpremium=parseInt(addpremium.replace(/,/g, ""));
            
                //var sum_amount2 = isNaN((brokeragepersen*addpremium)/100) ? 0 :((brokeragepersen*addpremium)/100);
                //var real_sum2 = sum_amount2.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                //$('#brokerageupdate52').val(real_sum2);
                
                var discpersen = $('#discpecentageupdate52').val();
                if(isNaN(discpersen))
                {
                    discpersen=0;
                }
                
                var sum_discount2 = isNaN((discpersen*addpremium)/100) ? 0 :((discpersen*addpremium)/100);
                var real_discount2 = sum_discount2.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('#discupdate52').val(real_discount2);

                var totalnetaddpremium=(addpremium)-(sum_amount2);
                $('#net_add_premiumupdate52').val(totalnetaddpremium);

                var nasreshare=$('#nasreshareupdate62').val();
                var totalreshare = isNaN((totalnetaddpremium*nasreshare)/100) ? 0 :((totalnetaddpremium*nasreshare)/100);
                $('#re_sharerupdate52').val(totalreshare);


            }
            else
            {
                swal('warning!','please fill MD Premium first','error')
            }
   });
</script>
   


<script type='text/javascript'>
   $('#discpecentageupdate52').keyup(function(e)
   {
        
            var brokeragepersen = $('#brokeragepercentageupdate52').val();
            var addpremium = $('#additional_premiumupdate52').val();
           
            if(brokeragepersen != null)
            {
               
                addpremium=parseInt(addpremium.replace(/,/g, ""));
            
                var sum_amount2 = isNaN((brokeragepersen*addpremium)/100) ? 0 :((brokeragepersen*addpremium)/100);
                var real_sum2 = sum_amount2.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('#brokerageupdate52').val(real_sum2);
                
                var discpersen = $('#discpecentageupdate52').val();
                if(isNaN(discpersen))
                {
                    discpersen=0;
                }
                
                var sum_discount2 = isNaN((discpersen*addpremium)/100) ? 0 :((discpersen*addpremium)/100);
                var real_discount2 = sum_discount2.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('#discupdate52').val(real_discount2);

                var totalnetaddpremium=(addpremium)-(sum_amount2);
                $('#net_add_premiumupdate52').val(totalnetaddpremium);

                var nasreshare=$('#nasreshareupdate62').val();
                var totalreshare = isNaN((totalnetaddpremium*nasreshare)/100) ? 0 :((totalnetaddpremium*nasreshare)/100);
                $('#re_sharerupdate52').val(totalreshare);

            }
            else
            {
                swal('warning!','please fill MD Premium  first','error')
            }
       
   });


   $('#discupdate52').keyup(function(e)
   {
        
            var brokeragepersen = $('#brokeragepercentageupdate52').val();
            var addpremium = $('#additional_premiumupdate52').val();
           
            if(brokeragepersen != null)
            {
               
                addpremium=parseInt(addpremium.replace(/,/g, ""));
            
                var sum_amount2 = isNaN((brokeragepersen*addpremium)/100) ? 0 :((brokeragepersen*addpremium)/100);
                var real_sum2 = sum_amount2.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('#brokerageupdate52').val(real_sum2);
                
                var discpersen = $('#discpecentageupdate52').val();
                if(isNaN(discpersen))
                {
                    discpersen=0;
                }
                
                //var sum_discount2 = isNaN((discpersen*addpremium)/100) ? 0 :((discpersen*addpremium)/100);
                //var real_discount2 = sum_discount2.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                //$('#discupdate52').val(real_discount2);

                var totalnetaddpremium=(addpremium)-(sum_amount2);
                $('#net_add_premiumupdate52').val(totalnetaddpremium);

                var nasreshare=$('#nasreshareupdate62').val();
                var totalreshare = isNaN((totalnetaddpremium*nasreshare)/100) ? 0 :((totalnetaddpremium*nasreshare)/100);
                $('#re_sharerupdate52').val(totalreshare);

            }
            else
            {
                swal('warning!','please fill MD Premium  first','error')
            }
       
   });


function prevlayeradjustment() 
{
    //alert(groucobid);
    $("#group_layer_card").show();
    $("#group_adjustment_card").hide();
}
</script>
   

<script type='text/javascript'>
function storeadjustmentsubmit()
{
   
    var counter_number = $('#counternumber52').val();
    var layerid = $('#layerid62').val();
    var groupcob_number = $('#idgroupcob62').val();
    var position = $('#position52').val();

    var due_date = $('#duedate52').val();
    var ogrpi = $('#ogrpi52').val();
    var adjusment = $('#adjustment52').val();
    var additional_premium = $('#additional_premium52').val();
    var brokerage = $('#brokerage52').val();
    var disc = $('#disc52').val();
    var re_sharer = $('#re_sharer52').val();
    var net_add_premium = $('#net_add_premium52').val();
    var retro_share = "";
    var discpecentage = $('#discpecentage52').val();
    var brokeragepercentage = $('#brokeragepercentage52').val();
    var adjtransferdate = $('#adjtransferdate').val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $.ajax({
        url:"{{url('treaty/nonprop/mindep/storeadjusment')}}",
        type:"POST",
        data:{
            counter_number:counter_number,
            layerid:layerid,
            groupcob_number:groupcob_number,
            position:position,
            due_date:due_date,
            ogrpi:ogrpi,
            adjusment:adjusment,
            additional_premium:additional_premium,
            brokerage:brokerage,
            disc:disc,
            re_sharer:re_sharer,
            net_add_premium:net_add_premium,
            retro_share:retro_share,
            adjtransferdate:adjtransferdate,
            brokeragepercentage:brokeragepercentage,
            discpecentage:discpecentage

        },
          beforeSend: function() { $("body").addClass("loading");  },
          complete: function() {  $("body").removeClass("loading"); },
          success:function(response)
          {
              swal("Success!", "Store Adjusment Detail Insert Success", "success")

              if(response.success==true)
              {

                 let dollarUSLocale = Intl.NumberFormat('en-US');

                 $('#tableadjusment33 tbody').prepend('<tr id="adjusmentdetailslipid'+response.id+'" data-name="adjusmentdetailslipidvalue[]">'
                 +'<td data-name="'+response.id+'">'+response.id+'</td>'
                 +'<td>'+layerid+'</td>'
                 +'<td>'+due_date+'</td>'
                 +'<td>'+dollarUSLocale.format(ogrpi)+'</td>'
                 +'<td>'+dollarUSLocale.format(adjusment)+'</td>'
                 +'<td>'+dollarUSLocale.format(additional_premium)+'</td>'
                 +'<td>'+brokerage+'</td>'
                 +'<td>'+disc+'</td>'
                 +'<td>'+dollarUSLocale.format(net_add_premium)+'</td>'
                 +'<td>'+dollarUSLocale.format(re_sharer)+'</td>'
                 +'<td>'

                 +'<div class="btn-group" role="group">'
                 +'<button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> (Option)</button>'
                 +'<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">'

                 +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="deleteadjustment(\''+response.id+'\',\''+layerid+'\')" >Delete Adjustement</button>'
                 +'<a class="text-primary mr-3" data-toggle="modal"  data-lookadjustment-id="'+response.id+'"  onclick="showdatalookadjinst('+response.id+')" data-target="#editdetailadjmodal">'
                 +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" data-toggle="modal" data-target="#editdetailadjmodal">Edit Adjustment </button>'
                 +'</a>'
                 
                +'</div>'
                +'</div>'

                 +'</td>'
                 +'</tr>');    
              } 

                $('#position52').val("");
                $('#duedate52').val("");
                $('#ogrpi52').val("");
                $('#adjustment52').val("");
                $('#additional_premium52').val("");
                $('#brokerage52').val("");
                $('#disc52').val("");
                $('#re_sharer52').val("");
                $('#net_add_premium52').val("");
               
           },
           error: function (request, status, error) 
           {
               //alert(request.responseText);
               swal("Error!", "Store Adjusment Detail Insert Error", "Insert Error");
           }
       });

       console.log('sudah insert');

}



function showadjustmentsubmit(groucobidlayer) 
{
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url:"{{url('treaty/nonprop/mindep/getgrouplayer')}}",
        type:"POST",
        data:{
            groucobidlayer:groucobidlayer
        },
        beforeSend: function() { $("body").addClass("loading");  },
        complete: function() {  $("body").removeClass("loading"); },
        success:function(response)
        {
            //swal("Success!", "Sub Master Contracct Insert Success", "success")
            if(response.success==true)
            {
                console.log(response.mastercontract);
                $("#masterid62").val(response.mastercontract.number);
                $('#masterdateentry62').val(response.mastercontract.date_entry);
                $('#masterceding62').val(response.mastercontract.ceding_name);
                $('#masterceding62').val(response.mastercontract.ceding_name);
                $('#masteruser62').val(response.mastercontract.user_name);
                $('#masteruwyear62').val(response.mastercontract.uwyear);
                $('#mastercedingtype62').val(response.mastercontract.ceding_type);

                
                console.log(response.subcontract);
                $('#submasterid62').val(response.subcontract.number_subcontract);
                $('#submasterceding62').val(response.subcontract.ceding_name);
                
                
                var date= response.subcontract.period_from;
                var d=new Date(date.split("/").reverse().join("-"));
                var dd=d.getDate();
                var mm=d.getMonth()+1;
                var yy=d.getFullYear();
                var newdatefrom=dd+"/"+mm+"/"+yy;

                var dateto= response.subcontract.period_to;
                var dto=new Date(dateto.split("/").reverse().join("-"));
                var ddto=dto.getDate();
                var mmto=dto.getMonth()+1;
                var yyto=dto.getFullYear();
                var newdateto=ddto+"/"+mmto+"/"+yyto; 
                
                $('#submasterperiod62').val(newdatefrom);
                $('#submasterperiod622').val(newdateto);
                $('#position52').val(newdateto);
                $('#submastertype62').val(response.subcontract.subcontract_type);
                $('#duedate52').val(response.subcontract.period_to);


                console.log(response.groucob);
                $('#idgroupcob62').val(response.groucob.numbercob);
                $('#groucob62').val(response.groucob.cob_name);
                $('#groupcoborgpi62').val(response.groucob.ogrpi);
                $('#groupcobtype62').val(response.groucob.treaty_type);
                $('#groupcobbrokerage62').val(response.groucob.brokerage_value);
                $('#groupcobbrokeragepersen62').val(response.groucob.brokerage_persentage);            
                
                console.log(response.layerdata);
                $('#layerid62').val(response.layerdata.id);
                $('#levellayer62').val(response.layerdata.layer_level);
                $('#premratelayer62').val(response.layerdata.prem_rate);
                $('#uwretlayer62').val(response.layerdata.uw_retention);
                $('#mindeplayer62').val(response.layerdata.mindep_rate);
                $('#limitlayer62').val(response.layerdata.limit_rate);
                $('#premiumtypelayer62').val(response.layerdata.premium_type);
                $('#reinstatement62').val(response.layerdata.reinstatement);
                $('#retroshare62').val(response.layerdata.retro_share);
                $('#nasreshare62').val(response.layerdata.nasre_share);
                $('#liability62').val(response.layerdata.liability);
                $('#liability622').val(response.layerdata.liability2);
                $('#mdpremium62').val(response.layerdata.md_premium);
                $('#mdpremium622').val(response.layerdata.md_premium2);
                $('#aadlimit62').val(response.layerdata.aad_limit);
                $('#aadedcutible62').val(response.layerdata.aa_deductible);   
                $('#brokerage62').val(response.layerdata.brokerage_amount);   
                
                /*
                 console.log(response.layerdata);
                 $('#layerid32').val(response.layerdata.id);
                 $('#levellayer32').val(response.layerdata.layer_level);
                 $('#premratelayer32').val(response.layerdata.prem_rate);
                 $('#uwretlayer32').val(response.layerdata.uw_retention);
                 $('#mindeplayer32').val(response.layerdata.mindep_rate);
                 $('#limitlayer32').val(response.layerdata.limit_rate);
                 $('#premiumtypelayer32').val(response.layerdata.premium_type);
                 $('#reinstatement32').val(response.layerdata.reinstatement);
                 $('#retroshare32').val(response.layerdata.retro_share);
                 $('#nasreshare32').val(response.layerdata.nasre_share);
                 $('#liability32').val(response.layerdata.liability);
                 $('#liability322').val(response.layerdata.liability2);
                 $('#mdpremium32').val(response.layerdata.md_premium);
                 $('#mdpremium322').val(response.layerdata.md_premium2);
                 $('#aadlimit32').val(response.layerdata.aad_limit);
                 $('#aadedcutible32').val(response.layerdata.aa_deductible);
                 */

               
        
                var actualogrpi = $('#ogrpi52').val();
                var adjpremrate = $('#premratelayer62').val();

                if(actualogrpi != null)
                {
                    actualogrpi=parseInt(actualogrpi.replace(/,/g, ""));
                
                    var sum_amount2 = isNaN((actualogrpi*adjpremrate)/100) ? 0 :((actualogrpi*adjpremrate)/100);
                    var real_sum2 = sum_amount2.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    $('#adjustment52').val(real_sum2);
                    
                    var mindeplayer100=$('#mindeplayer62').val();
                    mindeplayer100=parseInt(mindeplayer100.replace(/,/g, ""));

                    var totalresult=sum_amount2-mindeplayer100;
                    var real_total = totalresult.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    $('#additional_premium52').val(real_total);

                }
                


                
            }
        },
        error: function (request, status, error) 
        {
            //alert(request.responseText);
            swal("Error!", "Group Cob/Layer get Data Error", "get Data Error");
        }
    });



    $.ajax({
        url:"{{url('treaty/nonprop/getadjinstallmentbyid/')}}/"+groucobidlayer,
        type:"GET",
        data:{
            groucobidlayer:groucobidlayer,
        },
          beforeSend: function() { $("body").addClass("loading");  },
          complete: function() {  $("body").removeClass("loading"); },
          success:function(response)
          {
                  swal("Success!", "Layer Data Success", "success")
                  $('#tableadjusment33 tbody').empty();
                  
                  if(response.success==true)
                  {
                        adjinstallmentdatajson=JSON.parse(response.adjinstallmentdatalist);

                        for(var i = 0; i < adjinstallmentdatajson.length; i++)
                        {
                            let dollarUSLocale = Intl.NumberFormat('en-US');

                            $('#tableadjusment33 tbody').prepend('<tr id="adjusmentdetailslipid'+adjinstallmentdatajson[i].id+'" data-name="adjusmentdetailslipidvalue[]">'
                            +'<td data-name="'+adjinstallmentdatajson[i].id+'">'+adjinstallmentdatajson[i].id+'</td>'
                            +'<td>'+adjinstallmentdatajson[i].layer_id+'</td>'
                            +'<td>'+adjinstallmentdatajson[i].due_date+'</td>'
                            +'<td>'+dollarUSLocale.format(adjinstallmentdatajson[i].ogrpi)+'</td>'
                            +'<td>'+dollarUSLocale.format(adjinstallmentdatajson[i].adjusment)+'</td>'
                            +'<td>'+dollarUSLocale.format(adjinstallmentdatajson[i].additional_premium)+'</td>'
                            +'<td>'+adjinstallmentdatajson[i].broker_amount+'</td>'
                            +'<td>'+adjinstallmentdatajson[i].disc+'</td>'
                            +'<td>'+dollarUSLocale.format(adjinstallmentdatajson[i].net_add_premium)+'</td>'
                            +'<td>'+dollarUSLocale.format(adjinstallmentdatajson[i].re_sharer)+'</td>'
                            +'<td>'
                            +'<div class="btn-group" role="group">'
                            +'<button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> (Option)</button>'
                            +'<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">'

                            +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="deleteadjustment(\''+adjinstallmentdatajson[i].id+'\',\''+groucobidlayer+'\')" >Delete Adjustement</button>'
                            +'<a class="text-primary mr-3" data-toggle="modal"  data-lookadjustment-id="'+adjinstallmentdatajson[i].id+'" onclick="showdatalookadjinst('+adjinstallmentdatajson[i].id+')" data-target="#editdetailadjmodal">'
                            +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" data-toggle="modal" data-target="#editdetailadjmodal">Edit Adjustment </button>'
                            +'</a>'
                            +'</div>'
                            +'</div>'

                            +'</td>'
                            +'</tr>');    
                            
                            
                        }
                  }
           },
           error: function (request, status, error) 
           {
               //alert(request.responseText);
               swal("Error!", "Master Contracct Insert Error", "Insert Error");
           }
       });   


       $.ajax({
        url:"{{url('treaty/nonprop/getadjinstallmentcount/')}}/"+groucobidlayer,
        type:"GET",
        data:{
            groucobidlayer:groucobidlayer,
        },
          beforeSend: function() { $("body").addClass("loading");  },
          complete: function() {  $("body").removeClass("loading"); },
          success:function(response)
          {
                  swal("Success!", "Group COb Insert Success", "success")
                  
                  if(response.success==true)
                  {
                    $('#counternumber52').val(response.countercode);
                         
                  }

           },
           error: function (request, status, error) 
           {
               //alert(request.responseText);
               swal("Error!", "Master Contracct Insert Error", "Insert Error");
           }
       });

      console.log('sudah get');

  console.log('sudah get');
  
  $("#group_adjustment_card").show();
  $("#group_layer_card").hide();
}
</script>
   


<script type="text/javascript">

function deleteadjustment(detailadjinstallmentid,layerid)
{

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url:"{{url('treaty/nonprop/deleteadjinstallment/')}}/"+detailadjinstallmentid,
            type:"GET",
            data:{
                detailadjinstallmentid:detailadjinstallmentid,
            },
            beforeSend: function() { $("body").addClass("loading");  },
            complete: function() {  $("body").removeClass("loading"); },
            success:function(response)
            {
                swal("Success!",  "Detail Installment Delete Success", "success")
                
                $.ajax({
                    url:"{{url('treaty/nonprop/getadjinstallmentbyid/')}}/"+layerid,
                    type:"GET",
                    data:{
                        layerid:layerid,
                    },
                    beforeSend: function() { $("body").addClass("loading");  },
                    complete: function() {  $("body").removeClass("loading"); },
                    success:function(response)
                    {
                            swal("Success!", "Layer Data Success", "success")
                            $('#tableadjusment33 tbody').empty();
                            
                            if(response.success==true)
                            {
                                    adjinstallmentdatajson=JSON.parse(response.adjinstallmentdatalist);

                                    for(var i = 0; i < adjinstallmentdatajson.length; i++)
                                    {

                                        let dollarUSLocale = Intl.NumberFormat('en-US');


                                        $('#tableadjusment33 tbody').prepend('<tr id="adjusmentdetailslipid'+adjinstallmentdatajson[i].id+'" data-name="adjusmentdetailslipidvalue[]">'
                                        +'<td data-name="'+adjinstallmentdatajson[i].id+'">'+adjinstallmentdatajson[i].id+'</td>'
                                        +'<td>'+adjinstallmentdatajson[i].layer_id+'</td>'
                                        +'<td>'+adjinstallmentdatajson[i].due_date+'</td>'
                                        +'<td>'+dollarUSLocale.format(adjinstallmentdatajson[i].ogrpi)+'</td>'
                                        +'<td>'+dollarUSLocale.format(adjinstallmentdatajson[i].adjusment)+'</td>'
                                        +'<td>'+dollarUSLocale.format(adjinstallmentdatajson[i].additional_premium)+'</td>'
                                        +'<td>'+adjinstallmentdatajson[i].broker_amount+'</td>'
                                        +'<td>'+adjinstallmentdatajson[i].disc+'</td>'
                                        +'<td>'+dollarUSLocale.format(adjinstallmentdatajson[i].net_add_premium)+'</td>'
                                        +'<td>'+dollarUSLocale.format(adjinstallmentdatajson[i].re_sharer)+'</td>'
                                        +'<td>'

                                        +'<div class="btn-group" role="group">'
                                        +'<button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> (Option)</button>'
                                        +'<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">'


                                        +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="deleteadjustment(\''+adjinstallmentdatajson[i].id+'\',\''+layerid+'\')" >Delete Adjustement</button>'
                                        +'<a class="text-primary mr-3" data-toggle="modal"  data-lookadjustment-id="'+adjinstallmentdatajson[i].id+'" onclick="showdatalookadjinst('+adjinstallmentdatajson[i].id+')" data-target="#editdetailadjmodal">'
                                        +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" data-toggle="modal" data-target="#editdetailadjmodal">Edit Adjustment </button>'
                                        +'</a>'
                                        
                                        +'</div>'
                                        +'</div>'

                                        +'</td>'
                                        +'</tr>');    
                                        
                                        
                                    }
                            }
                    },
                    error: function (request, status, error) 
                    {
                        //alert(request.responseText);
                        swal("Error!", "Master Contracct Insert Error", "Insert Error");
                    }
                });   

                    
            },
            error: function (request, status, error) 
            {
                //alert(request.responseText);
                swal("Error!", "Detail Installment  Delete Error", "Delete Error");
            }
        });

}
</script>


<script type="text/javascript">

    function showdatalookadjinst(adjinstid)
    {
        //alert(submasterid);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
        url:"{{url('treaty/nonprop/getadjinstallmentdetailbyid/')}}/"+adjinstid,
        type:"GET",
        data:{
            adjinstid:adjinstid,
        },
          beforeSend: function() { $("body").addClass("loading");  },
          complete: function() {  $("body").removeClass("loading"); },
          success:function(response)
          {
                  swal("Success!", "Group Cob Contracct Insert Success", "success")
                  if(response.success==true)
                  {                    
                    //$("#detailcobupdate333 option[value=" + response.installmentcobdatalist.detailcob_id + "]:first")[0].selected = true;

                    $("#adjusmentid62").val(adjinstid);
                    $("#counternumberupdate52").val(response.adjinstallmentdatalist.counter_number);
                    $("#positionupdate52").val(response.adjinstallmentdatalist.position);
                    $("#duedateupdate52").val(response.adjinstallmentdatalist.due_date);
                    $("#ogrpiupdate52").val(response.adjinstallmentdatalist.ogrpi);
                    $("#adjustmentupdate52").val(response.adjinstallmentdatalist.adjusment);
                    $("#additional_premiumupdate52").val(response.adjinstallmentdatalist.additional_premium);
                    $("#brokerageupdate52").val(response.adjinstallmentdatalist.broker_amount);
                    $("#discupdate52").val(response.adjinstallmentdatalist.disc_amount);
                    $("#re_sharerupdate52").val(response.adjinstallmentdatalist.re_sharer);
                    $("#net_add_premiumupdate52").val(response.adjinstallmentdatalist.net_add_premium);

                    $("#brokeragepercentageupdate52").val(response.adjinstallmentdatalist.brokerage);
                    $("#discpecentageupdate52").val(response.adjinstallmentdatalist.disc);
                    //$("#retro_shareupdate52").val(response.adjinstallmentdatalist.retro_share);

                  }
           },
           error: function (request, status, error) 
           {
               //alert(request.responseText);
               swal("Error!", "Group Cob Contracct Insert Error", "Insert Error");
           }
       });
    }

    $('#editdetailcobmodal').on('show.bs.modal', function(e) 
    {        
        //var submasterid = '';
        //submatserid=$(e.relatedTarget).data('looksubmaster');
    });

</script>




<script type="text/javascript">
    function updateadjustmentsubmit()
    {

        var adjusmentid=$('#adjusmentid62').val();
        var counter_number = $('#counternumberupdate52').val();
        var layerid = $('#layerid62').val();
        var groupcob_number = $('#idgroupcob62').val();
    
        var position = $('#positionupdate52').val();
        var due_date = $('#duedateupdate52').val();
        var ogrpi = $('#ogrpiupdate52').val();
        var adjusment = $('#adjustmentupdate52').val();
        var additional_premium = $('#additional_premiumupdate52').val();
        var brokerage = $('#brokerageupdate52').val();
        var disc = $('#discupdate52').val();
        var re_sharer = $('#re_sharerupdate52').val();
        var net_add_premium = $('#net_add_premiumupdate52').val();
        var retro_share = "";
        var discpecentage = $('#discpecentageupdate52').val();
        var brokeragepercentage = $('#brokeragepercentageupdate52').val();
        var adjtransferdate = $('#adjtransferdateupdate').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $.ajax({
            url:"{{url('treaty/nonprop/mindep/storeadjusment')}}",
            type:"POST",
            data:{
                adjusmentid:adjusmentid,
                counter_number:counter_number,
                layerid:layerid,
                groupcob_number:groupcob_number,
                position:position,
                due_date:due_date,
                ogrpi:ogrpi,
                adjusment:adjusment,
                additional_premium:additional_premium,
                brokerage:brokerage,
                disc:disc,
                re_sharer:re_sharer,
                net_add_premium:net_add_premium,
                retro_share:retro_share,
                adjtransferdate:adjtransferdate,
                brokeragepercentage:brokeragepercentage,
                discpecentage:discpecentage
            },
            beforeSend: function() { $("body").addClass("loading");  },
            complete: function() {  $("body").removeClass("loading"); },
            success:function(response)
            {
                swal("Success!", "Store Adjusment Detail Insert Success", "success")

                if(response.success==true)
                {
                    let dollarUSLocale = Intl.NumberFormat('en-US');


                    $('#tableadjusment33 tbody').prepend('<tr id="adjusmentdetailslipid'+response.id+'" data-name="adjusmentdetailslipidvalue[]">'
                    +'<td data-name="'+response.id+'">'+response.id+'</td>'
                    +'<td>'+layerid+'</td>'
                    +'<td>'+due_date+'</td>'
                    +'<td>'+dollarUSLocale.format(ogrpi)+'</td>'
                    +'<td>'+dollarUSLocale.format(adjusment)+'</td>'
                    +'<td>'+dollarUSLocale.format(additional_premium)+'</td>'
                    +'<td>'+brokerage+'</td>'
                    +'<td>'+disc+'</td>'
                    +'<td>'+dollarUSLocale.format(net_add_premium)+'</td>'
                    +'<td>'+dollarUSLocale.format(re_sharer)+'</td>'
                    +'<td>'
                    +'<div class="btn-group" role="group">'
                    +'<button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> (Option)</button>'
                    +'<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">'

                    +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="deleteadjustment(\''+response.id+'\',\''+layerid+'\')" >Delete Adjustement</button>'
                    +'<a class="text-primary mr-3" data-toggle="modal"  data-lookadjustment-id="'+response.id+'"  onclick="showdatalookadjinst('+response.id+')" data-target="#editdetailadjmodal">'
                    +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" data-toggle="modal" data-target="#editdetailadjmodal">Edit Adjustment </button>'
                    +'</a>'

                    +'</div>'
                    +'</div>'
                    +'</td>'
                    +'</tr>');    
                } 

                    $('#position52').val("");
                    $('#duedate52').val("");
                    $('#ogrpi52').val("");
                    $('#adjustment52').val("");
                    $('#additional_premium52').val("");
                    $('#brokerage52').val("");
                    $('#disc52').val("");
                    $('#re_sharer52').val("");
                    $('#net_add_premium52').val("");
                  

            },
            error: function (request, status, error) 
            {
                //alert(request.responseText);
                swal("Error!", "Store Adjusment Detail Insert Error", "Insert Error");
            }
        });

        console.log('sudah insert');

        $.ajax({
        url:"{{url('treaty/nonprop/getadjinstallmentbyid/')}}/"+layerid,
        type:"GET",
        data:{
            layerid:layerid,
        },
          beforeSend: function() { $("body").addClass("loading");  },
          complete: function() {  $("body").removeClass("loading"); },
          success:function(response)
          {
                  swal("Success!", "Layer Data Success", "success")
                  $('#tableadjusment33 tbody').empty();
                  
                  if(response.success==true)
                  {
                        adjinstallmentdatajson=JSON.parse(response.adjinstallmentdatalist);

                        for(var i = 0; i < adjinstallmentdatajson.length; i++)
                        {
                            let dollarUSLocale = Intl.NumberFormat('en-US');

                            $('#tableadjusment33 tbody').prepend('<tr id="adjusmentdetailslipid'+adjinstallmentdatajson[i].id+'" data-name="adjusmentdetailslipidvalue[]">'
                            +'<td data-name="'+adjinstallmentdatajson[i].id+'">'+adjinstallmentdatajson[i].id+'</td>'
                            +'<td>'+adjinstallmentdatajson[i].layer_id+'</td>'
                            +'<td>'+adjinstallmentdatajson[i].due_date+'</td>'
                            +'<td>'+dollarUSLocale.format(adjinstallmentdatajson[i].ogrpi)+'</td>'
                            +'<td>'+dollarUSLocale.format(adjinstallmentdatajson[i].adjusment)+'</td>'
                            +'<td>'+dollarUSLocale.format(adjinstallmentdatajson[i].additional_premium)+'</td>'
                            +'<td>'+adjinstallmentdatajson[i].broker_amount+'</td>'
                            +'<td>'+adjinstallmentdatajson[i].disc+'</td>'
                            +'<td>'+dollarUSLocale.format(adjinstallmentdatajson[i].net_add_premium)+'</td>'
                            +'<td>'+dollarUSLocale.format(adjinstallmentdatajson[i].re_sharer)+'</td>'
                            +'<td>'

                            +'<div class="btn-group" role="group">'
                            +'<button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> (Option)</button>'
                            +'<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">'


                            +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="deleteadjustment(\''+adjinstallmentdatajson[i].id+'\',\''+groucobidlayer+'\')" >Delete Adjustement</button>'
                            +'<a class="text-primary mr-3" data-toggle="modal"  data-lookadjustment-id="'+adjinstallmentdatajson[i].id+'" onclick="showdatalookadjinst('+adjinstallmentdatajson[i].id+')" data-target="#editdetailadjmodal">'
                            +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" data-toggle="modal" data-target="#editdetailadjmodal">Edit Adjustment </button>'
                            +'</a>'
                            
                            
                            +'</div>'
                            +'</div>'
                            +'</td>'
                            +'</tr>');    
                            
                            
                        }
                  }
           },
           error: function (request, status, error) 
           {
               //alert(request.responseText);
               swal("Error!", "Master Contracct Insert Error", "Insert Error");
           }
       });   


    }
</script>