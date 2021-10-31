

<script type='text/javascript'>
   $('#mindeplayer').keyup(function(e)
   {
            var mindeplayer = parseFloat($(this).val());
            var brokeragegroup = $('#groupcobbrokerage412').val();
           
            if(brokeragegroup != null)
            {  
                
                var conv_brokergroup = parseInt(brokeragegroup.replace(/,/g, ""));
                var sum_amount2 = isNaN((conv_brokergroup*mindeplayer)/100) ? 0 :((conv_brokergroup*mindeplayer)/100);
                var real_sum2 = sum_amount2.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('#brokeragelayer').val(real_sum2);


                var nasreshare = $('#nasresharelayer').val();
                var conv_brokergroup = sum_amount2;
                var conv_nasreshare =nasreshare;

               
                var sum_amount2 = isNaN((conv_nasreshare*mindeplayer)/100) ? 0 :((conv_nasreshare*mindeplayer)/100);
                var sum_result=sum_amount2-conv_brokergroup;
               
                var real_sum2 = sum_result.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('#mdpremiumlayer').val(real_sum2);

                var limitlayer =  $('#limitlayer').val();
                limitlayer=parseInt(limitlayer.replace(/,/g, ""));
                
                if(limitlayer != null)
                {
                
                    var sum_amount2 = isNaN((conv_nasreshare*limitlayer)/100) ? 0 :((conv_nasreshare*limitlayer)/100);
                    var real_sum2 = sum_amount2.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    
                    $('#liabilitylayer').val(real_sum2);
                }
                else
                {
                
                    var sum_amount2 = isNaN((conv_nasreshare*limitlayer)/100) ? 0 :((conv_nasreshare*limitlayer)/100);
                    var real_sum2 = sum_amount2.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                    $('#liabilitylayer').val(real_sum2);
                }

            }
            else
            {
                swal('warning!','please fill MD Premium first','error')
            }
       
    });
</script>



<script type='text/javascript'>
   $('#nasresharelayer').keyup(function(e)
   {
      
        var nasreshare = parseFloat($(this).val());
        var mindeplayer = $('#mindeplayer').val();
        var brokeragegroup = $('#brokeragelayer').val();
        
        if(nasreshare != null)
        {
            var conv_brokergroup = parseInt(brokeragegroup.replace(/,/g, ""));
            var conv_nasreshare =nasreshare;

            mindeplayer=parseInt(mindeplayer.replace(/,/g, ""));

            var sum_amount2 = isNaN((conv_nasreshare*mindeplayer)/100) ? 0 :((conv_nasreshare*mindeplayer)/100);
            var sum_result=sum_amount2-conv_brokergroup;
            
                var real_sum2 = sum_result.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('#mdpremiumlayer').val(real_sum2);
            
                var limitlayer =  $('#limitlayer').val();
                limitlayer=parseInt(limitlayer.replace(/,/g, ""));
                
                if(limitlayer != null)
                {
                
                    var sum_amount2 = isNaN((conv_nasreshare*limitlayer)/100) ? 0 :((conv_nasreshare*limitlayer)/100);
                    var real_sum2 = sum_amount2.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    
                    $('#liabilitylayer').val(real_sum2);
                }
                else
                {
                
                    var sum_amount2 = isNaN((conv_nasreshare*limitlayer)/100) ? 0 :((conv_nasreshare*limitlayer)/100);
                    var real_sum2 = sum_amount2.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                    $('#liabilitylayer').val(real_sum2);
                }

        }
        else
        {
            swal('warning!','please fill MD Premium first','error')
        }

        
    });
</script>



<script type='text/javascript'>
   $('#limitlayer').keyup(function(e)
   {
       
            var limitlayer = parseFloat($(this).val());
            var nasreshare = $('#nasresharelayer').val();
           
            if(limitlayer != null)
            {
                var conv_nasreshare =nasreshare;

                var sum_amount2 = isNaN((conv_nasreshare*limitlayer)/100) ? 0 :((conv_nasreshare*limitlayer)/100);
                var real_sum2 = sum_amount2.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                
                $('#liabilitylayer').val(real_sum2);
            }
            else
            {
                var conv_nasreshare =1;

                var sum_amount2 = isNaN((conv_nasreshare*limitlayer)/100) ? 0 :((conv_nasreshare*limitlayer)/100);
                var real_sum2 = sum_amount2.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                $('#liabilitylayer').val(real_sum2);
            }
    });
</script>



<script type='text/javascript'>
   $('#mindeplayerupdate').keyup(function(e)
   {
        var keyCode = e.keyCode || e.which;
        if(keyCode != 9)
        {
            var mindeplayer = parseFloat($(this).val());
            var brokeragegroup = $('#groupcobbrokerage412').val();
           
            if(brokeragegroup != null)
            {
                mindeplayer=parseInt(mindeplayer.replace(/,/g, ""));

                var conv_brokergroup = parseInt(brokeragegroup.replace(/,/g, ""));
                var sum_amount2 = isNaN((conv_brokergroup*mindeplayer)/100) ? 0 :((conv_brokergroup*mindeplayer)/100);
                var real_sum2 = sum_amount2.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('#brokeragelayerupdate').val(real_sum2);

                mindeplayer=parseInt(mindeplayer.replace(/,/g, ""));

                var nasreshare = $('#nasresharelayerupdate').val();
                var conv_brokergroup = sum_amount2;
                var conv_nasreshare =nasreshare;

                var sum_amount2 = isNaN((conv_nasreshare*mindeplayer)/100) ? 0 :((conv_nasreshare*mindeplayer)/100);
                var sum_result=sum_amount2-conv_brokergroup;
               
                var real_sum2 = sum_result.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('#mdpremiumlayerupdate').val(real_sum2);

                var limitlayer =  $('#limitlayerupdate').val();
                limitlayer=parseInt(limitlayer.replace(/,/g, ""));
                
                if(limitlayer != null)
                {
                
                    var sum_amount2 = isNaN((conv_nasreshare*limitlayer)/100) ? 0 :((conv_nasreshare*limitlayer)/100);
                    var real_sum2 = sum_amount2.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    
                    $('#liabilitylayerupdate').val(real_sum2);
                }
                else
                {
                
                    var sum_amount2 = isNaN((conv_nasreshare*limitlayer)/100) ? 0 :((conv_nasreshare*limitlayer)/100);
                    var real_sum2 = sum_amount2.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                    $('#liabilitylayerupdate').val(real_sum2);
                }

            }
            else
            {
                swal('warning!','please fill MD Premium first','error')
            }
        }
        else
        {
            var mindeplayer = parseFloat($(this).val());
            var brokeragegroup = $('#groupcobbrokerage412').val();
           
            if(brokeragegroup != null)
            {
                mindeplayer=parseInt(mindeplayer.replace(/,/g, ""));

                var conv_brokergroup = parseInt(brokeragegroup.replace(/,/g, ""));
                var sum_amount2 = isNaN((conv_brokergroup*mindeplayer)/100) ? 0 :((conv_brokergroup*mindeplayer)/100);
                var real_sum2 = sum_amount2.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('#brokeragelayerupdate').val(real_sum2);

                var nasreshare = $('#nasresharelayerupdate').val();
                var conv_brokergroup = sum_amount2;
                var conv_nasreshare =nasreshare;

                var sum_amount2 = isNaN((conv_nasreshare*mindeplayer)/100) ? 0 :((conv_nasreshare*mindeplayer)/100);
                var sum_result=sum_amount2-conv_brokergroup;
               
                var real_sum2 = sum_result.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('#mdpremiumlayerupdate').val(real_sum2);

                    var limitlayer =  $('#limitlayerupdate').val();
                    limitlayer=parseInt(limitlayer.replace(/,/g, ""));
                    
                    if(limitlayer != null)
                    {
                    
                        var sum_amount2 = isNaN((conv_nasreshare*limitlayer)/100) ? 0 :((conv_nasreshare*limitlayer)/100);
                        var real_sum2 = sum_amount2.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        
                        $('#liabilitylayerupdate').val(real_sum2);
                    }
                    else
                    {
                    
                        var sum_amount2 = isNaN((conv_nasreshare*limitlayer)/100) ? 0 :((conv_nasreshare*limitlayer)/100);
                        var real_sum2 = sum_amount2.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                        $('#liabilitylayerupdate').val(real_sum2);
                    }

            }
            else
            {
                swal('warning!','please fill MD Premium  first','error')
            }
        }
    });
</script>



<script type='text/javascript'>
   $('#nasresharelayerupdate').keyup(function(e)
   {
        var keyCode = e.keyCode || e.which;
        if(keyCode != 9)
        {
            var nasreshare = parseFloat($(this).val());
            var mindeplayer = $('#mindeplayerupdate').val();
            var brokeragegroup = $('#brokeragelayerupdate').val();
           
            if(nasreshare != null)
            {
                mindeplayer=parseInt(mindeplayer.replace(/,/g, ""));
                var conv_brokergroup = parseInt(brokeragegroup.replace(/,/g, ""));
                var conv_nasreshare =nasreshare;

                var sum_amount2 = isNaN((conv_nasreshare*mindeplayer)/100) ? 0 :((conv_nasreshare*mindeplayer)/100);
                var sum_result=sum_amount2-conv_brokergroup;
               
                var real_sum2 = sum_result.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('#mdpremiumlayerupdate').val(real_sum2);

                    var limitlayer =  $('#limitlayerupdate').val();
                    limitlayer=parseInt(limitlayer.replace(/,/g, ""));
                    
                    if(limitlayer != null)
                    {
                    
                        var sum_amount2 = isNaN((conv_nasreshare*limitlayer)/100) ? 0 :((conv_nasreshare*limitlayer)/100);
                        var real_sum2 = sum_amount2.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        
                        $('#liabilitylayerupdate').val(real_sum2);
                    }
                    else
                    {
                    
                        var sum_amount2 = isNaN((conv_nasreshare*limitlayer)/100) ? 0 :((conv_nasreshare*limitlayer)/100);
                        var real_sum2 = sum_amount2.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                        $('#liabilitylayerupdate').val(real_sum2);
                    }

            }
            else
            {
                swal('warning!','please fill MD Premium first','error')
            }
        }
        else
        {
            var nasreshare = parseFloat($(this).val());
            var mindeplayer = $('#mindeplayerupdate').val();
            var brokeragegroup = $('#brokeragelayerupdate').val();
           
            if(nasreshare != null)
            {
                mindeplayer=parseInt(mindeplayer.replace(/,/g, ""));
                var conv_brokergroup = parseInt(brokeragegroup.replace(/,/g, ""));
                var conv_nasreshare =nasreshare;

                var sum_amount2 = isNaN((conv_nasreshare*mindeplayer)/100) ? 0 :((conv_nasreshare*mindeplayer)/100);
                var sum_result=sum_amount2-conv_brokergroup;
                
                var real_sum2 = sum_result.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                $('#mdpremiumlayerupdate').val(real_sum2);

                    var limitlayer =  $('#limitlayerupdate').val();
                    limitlayer=parseInt(limitlayer.replace(/,/g, ""));
                    
                    if(limitlayer != null)
                    {
                    
                        var sum_amount2 = isNaN((conv_nasreshare*limitlayer)/100) ? 0 :((conv_nasreshare*limitlayer)/100);
                        var real_sum2 = sum_amount2.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        
                        $('#liabilitylayerupdate').val(real_sum2);
                    }
                    else
                    {
                    
                        var sum_amount2 = isNaN((conv_nasreshare*limitlayer)/100) ? 0 :((conv_nasreshare*limitlayer)/100);
                        var real_sum2 = sum_amount2.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                        $('#liabilitylayerupdate').val(real_sum2);
                    }
            }
            else
            {
                swal('warning!','please fill MD Premium  first','error')
            }
        }
    });
</script>


<script type='text/javascript'>
   $('#limitlayerupdate').keyup(function(e)
   {
        var keyCode = e.keyCode || e.which;
        if(keyCode != 9)
        {
            var limitlayer = parseFloat($(this).val());
            var nasreshare = $('#nasresharelayerupdate').val();
           
            if(limitlayer != null)
            {
                var conv_nasreshare =nasreshare;

                var sum_amount2 = isNaN((conv_nasreshare*limitlayer)/100) ? 0 :((conv_nasreshare*limitlayer)/100);
                var real_sum2 = sum_amount2.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                
                $('#liabilitylayerupdate').val(real_sum2);
            }
            else
            {
                var conv_nasreshare =1;

                var sum_amount2 = isNaN((conv_nasreshare*limitlayer)/100) ? 0 :((conv_nasreshare*limitlayer)/100);
                var real_sum2 = sum_amount2.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                
                $('#liabilitylayerupdate').val(real_sum2);
            }
        }
        else
        {
            var limitlayer = parseFloat($(this).val());
            var nasreshare = $('#nasresharelayerupdate').val();
           
            if(limitlayer != null)
            {
               
                var conv_nasreshare =nasreshare;
                var sum_amount2 = isNaN((conv_nasreshare*limitlayer)/100) ? 0 :((conv_nasreshare*limitlayer)/100);
                var real_sum2 = sum_amount2.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                $('#liabilitylayerupdate').val(real_sum2);
            }
            else
            {
                var conv_nasreshare =1;

                var sum_amount2 = isNaN((conv_nasreshare*limitlayer)/100) ? 0 :((conv_nasreshare*limitlayer)/100);
                var real_sum2 = sum_amount2.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                
                $('#liabilitylayerupdate').val(real_sum2);
            }
        }
    });
</script>



<script type='text/javascript'>
function storelayersubmit()
{
    var layerlevel = $('#layerlevel').val();
    var premratelayer = $('#premratelayer').val();
    var instlayer = $('#instlayer').val();
    var statuslayer = $('#statuslayer').val();
    var uwlayer = $('#uwlayer').val();
    var mindeplayer = $('#mindeplayer').val();
    var limitlayer = $('#limitlayer').val();
    var premiumtypelayer = $('#premiumtypelayer').val();
    var reinstatementlayer ="";
    var nasresharelayer = $('#nasresharelayer').val();
    var liabilitylayer = $('#liabilitylayer').val();
    var mdpremiumlayer = $('#mdpremiumlayer').val();
    var aadlimitlayer = $('#aadlimitlayer').val();
    var aadeductiblelayer = $('#aadeductiblelayer').val();
    var groupcobidlayer = $('#groupcobidlayer').val();
    var transferdate = $('#transferdatelayer').val();
    

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

 
    $.ajax({
        url:"{{url('treaty/nonprop/mindep/storelayer')}}",
        type:"POST",
        data:{
            groupcobidlayer:groupcobidlayer,
            layerlevel:layerlevel,
            premratelayer:premratelayer,
            instlayer:instlayer,
            statuslayer:statuslayer,
            uwlayer:uwlayer,
            mindeplayer:mindeplayer,
            limitlayer:limitlayer,
            premiumtypelayer:premiumtypelayer,
            reinstatementlayer:reinstatementlayer,
            nasresharelayer:nasresharelayer,
            liabilitylayer:liabilitylayer,
            mdpremiumlayer:mdpremiumlayer,
            aadlimitlayer:aadlimitlayer,
            aadeductiblelayer:aadeductiblelayer,
            transferdate:transferdate
        },
          beforeSend: function() { $("body").addClass("loading");  },
          complete: function() {  $("body").removeClass("loading"); },
          success:function(response)
          {
              swal("Success!", "Layer Group COb Insert Success", "success")

              if(response.success==true)
              {

                let dollarUSLocale = Intl.NumberFormat('en-US');

                $('#layerPanel tbody').prepend('<tr id="layercobslipid'+response.layerdata.id+'" data-name="slipvalue[]">'
                 +'<td data-name="'+response.layerdata.id+'">'+response.layerdata.id+'</td>'
                 +'<td>'+layerlevel+'</td>'
                 +'<td>'+dollarUSLocale.format(limitlayer)+'</td>'
                 +'<td>'+dollarUSLocale.format(reinstatementlayer)+'</td>'
                 +'<td>'+dollarUSLocale.format(nasresharelayer)+'</td>'
                 +'<td>'+dollarUSLocale.format(nasresharelayer)+'</td>'
                 +'<td>'+dollarUSLocale.format(mindeplayer)+'</td>'
                 +'<td>'+response.layerdata.status_layer+'</td>'
                 +'<td>'
                 
                 +'<div class="btn-group" role="group">'
                 +'<button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> (Option)</button>'
                 +'<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">'


                 +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="deletelayer(\''+response.layerdata.id+'\',\''+groupcobidlayer+'\')" >Delete Layer</button>'
                 +'<a class="text-primary mr-3" data-toggle="modal"  data-looklayer-id="'+response.layerdata.id+'" data-target="#editlayermodal">'
                 +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" data-toggle="modal" data-target="#editlayermodal" onclick="showdatalooklayer('+response.layerdata.id+')" >Edit Layer</button>'
                 +'</a>'
                 +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="showdetailinstallment(\''+response.layerdata.id+'\')" >Add Installment</button>' 
                 +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="showdetailcob(\''+response.layerdata.id+'\')" >Add Detail COB</button>'  
                 +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="showadjustmentsubmit(\''+response.layerdata.id+'\')" >Adjustment</button>'  
                 
                 +'</div>'
                 +'</div>'

                 +'</td>'+
                 +'</tr>');    
              }


                $('#premratelayer').val("");
                $('#instlayer').val("");
                $('#uwlayer').val("");
                $('#mindeplayer').val("");
                $('#limitlayer').val("");
                $('#premiumtypelayer').val("");
                $('#nasresharelayer').val("");
                $('#liabilitylayer').val("");
                $('#mdpremiumlayer').val("");
                $('#aadlimitlayer').val("");
                $('#aadeductiblelayer').val("");

           },
           error: function (request, status, error) 
           {
               //alert(request.responseText);
               swal("Error!", "Layer Group COB Insert Error", "Insert Error");
           }
       });

       console.log('sudah insert');
}
</script>


<script type='text/javascript'>
function showgrouplayer(groucobid) 
{
    //alert(groucobid);
    $('#groupcobidlayer').val(groucobid);
    $('#groupcobid43').val(groucobid);
    //$('#layerid43').val(groucobid);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
      url:"{{url('treaty/nonprop/mindep/getgroupcobdata')}}",
      type:"POST",
      data:{
          groucobid:groucobid
      },
        beforeSend: function() { $("body").addClass("loading");  },
        complete: function() {  $("body").removeClass("loading"); },
        success:function(response)
        {
            //swal("Success!", "Sub Master Contracct Insert Success", "success")

            if(response.success==true)
            {
                console.log(response.mastercontract);
                $("#masterid412").val(response.mastercontract.number);
                $('#masterdateentry412').val(response.mastercontract.date_entry);
                $('#masterceding412').val(response.mastercontract.ceding_name);
                $('#masteruser412').val(response.mastercontract.user_name);
                $('#masteruwyear412').val(response.mastercontract.uwyear);
                $('#mastercedingtype412').val(response.mastercontract.ceding_type);

              
                console.log(response.subcontract);
                $('#submasterid412').val(response.subcontract.number_subcontract);
                $('#submasterceding412').val(response.subcontract.ceding_name);
                
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
                
                $('#submasterperiod412').val(newdatefrom);
                $('#submasterperiod4122').val(newdateto);

                $('#submastertype412').val(response.subcontract.subcontract_type);

                console.log(response.groucob);
                $('#idgroupcob412').val(response.groucob.numbercob);
                $('#groucob412').val(response.groucob.cob_name);
                $('#groupcoborgpi412').val(response.groucob.ogrpi);
                $('#groupcobtype412').val(response.groucob.treaty_type);
                $('#groupcobbrokerage412').val(response.groucob.brokerage_value);
                $('#groupcobbrokeragepersen412').val(response.groucob.brokerage_persentage);

            
            }

        },
          error: function (request, status, error) 
          {
              //alert(request.responseText);
              swal("Error!", "Group Cob/Layer get Data Error", "get Data Error");
          }
      });

    console.log('sudah get');

    $.ajax({
        url:"{{url('treaty/nonprop/getlayerbyid/')}}/"+groucobid,
        type:"GET",
        data:{
            groucobid:groucobid,
        },
          beforeSend: function() { $("body").addClass("loading");  },
          complete: function() {  $("body").removeClass("loading"); },
          success:function(response)
          {
                  swal("Success!", "Layer Data Success", "success")
                  $('#layerPanel tbody').empty();
                  
                  if(response.success==true)
                  {
                        layerdatajson=JSON.parse(response.layerdatalist);

                        for(var i = 0; i < layerdatajson.length; i++)
                        {
                            let dollarUSLocale = Intl.NumberFormat('en-US');

                            $('#layerPanel tbody').prepend('<tr id="layercobslipid'+layerdatajson[i].id+'" data-name="slipvalue[]">'
                            +'<td data-name="'+layerdatajson[i].id+'">'+layerdatajson[i].id+'</td>'
                            +'<td>'+layerdatajson[i].layer_level+'</td>'
                            +'<td>'+dollarUSLocale.format(layerdatajson[i].limit_rate)+'</td>'
                            +'<td>'+dollarUSLocale.format(layerdatajson[i].reinstatement)+'</td>'
                            +'<td>'+dollarUSLocale.format(layerdatajson[i].nasre_share)+'</td>'
                            +'<td>'+dollarUSLocale.format(layerdatajson[i].nasre_share)+'</td>'
                            +'<td>'+dollarUSLocale.format(layerdatajson[i].mindep_rate)+'</td>'
                            +'<td>'+layerdatajson[i].status_layer+'</td>'
                            +'<td>'

                            +'<div class="btn-group" role="group">'
                            +'<button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> (Option)</button>'
                            +'<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">'


                            +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="deletelayer(\''+layerdatajson[i].id+'\',\''+groucobid+'\')" >Delete Layer</button>'
                            +'<a class="text-primary mr-3" data-toggle="modal"  data-looklayer-id="'+layerdatajson[i].id+'" data-target="#editlayermodal">'
                            +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" data-toggle="modal" data-target="#editlayermodal" onclick="showdatalooklayer('+layerdatajson[i].id+')" >Edit Layer</button>'
                            +'</a>'
                            +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="showdetailinstallment(\''+layerdatajson[i].id+'\')" >Add Installment</button>' 
                            +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="showdetailcob(\''+layerdatajson[i].id+'\')" >Add Detail COB</button>'  
                            +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="showadjustmentsubmit(\''+layerdatajson[i].id+'\')" >Adjustment</button>'  
                            
                            
                            +'</div>'
                            +'</div>'
                            +'</td>'+
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
    
    $("#group_layer_card").show();
    $("#group_cob_card").hide();
}


function prevgroucoblayer() 
{
    //alert(groucobid);
    $("#group_layer_card").hide();
    $("#group_cob_card").show();
}


function prevlayerdetailinstallment() 
{
    //alert(groucobid);
    $("#group_layer_card").show();
    $("#group_detailinstallment_card").hide();
}



</script>


<script type="text/javascript">
function deletelayer(layerid,groupcobid)
{

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url:"{{url('treaty/nonprop/deletelayer/')}}/"+layerid,
            type:"GET",
            data:{
                layerid:layerid,
            },
            beforeSend: function() { $("body").addClass("loading");  },
            complete: function() {  $("body").removeClass("loading"); },
            success:function(response)
            {
                swal("Success!",  "Layer Delete Success", "success")

                var groucobid=$('#idgroupcob412').val();
                $.ajax({
                    url:"{{url('treaty/nonprop/getlayerbyid/')}}/"+groucobid,
                    type:"GET",
                    data:{
                        groucobid:groucobid,
                    },
                    beforeSend: function() { $("body").addClass("loading");  },
                    complete: function() {  $("body").removeClass("loading"); },
                    success:function(response)
                    {
                            swal("Success!", "Layer Data Success", "success")
                            $('#layerPanel tbody').empty();
                            
                            if(response.success==true)
                            {
                                    layerdatajson=JSON.parse(response.layerdatalist);

                                    for(var i = 0; i < layerdatajson.length; i++)
                                    {
                                        let dollarUSLocale = Intl.NumberFormat('en-US');

                                        $('#layerPanel tbody').prepend('<tr id="layercobslipid'+layerdatajson[i].id+'" data-name="slipvalue[]">'
                                        +'<td data-name="'+layerdatajson[i].id+'">'+layerdatajson[i].id+'</td>'
                                        +'<td>'+layerdatajson[i].layer_level+'</td>'
                                        +'<td>'+dollarUSLocale.format(layerdatajson[i].limit_rate)+'</td>'
                                        +'<td>'+dollarUSLocale.format(layerdatajson[i].reinstatement)+'</td>'
                                        +'<td>'+dollarUSLocale.format(layerdatajson[i].nasre_share)+'</td>'
                                        +'<td>'+dollarUSLocale.format(layerdatajson[i].nasre_share)+'</td>'
                                        +'<td>'+dollarUSLocale.format(layerdatajson[i].mindep_rate)+'</td>'
                                        +'<td>'+layerdatajson[i].status_layer+'</td>'
                                        +'<td>'

                                        +'<div class="btn-group" role="group">'
                                        +'<button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> (Option)</button>'
                                        +'<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">'

                                        +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="deletelayer(\''+layerdatajson[i].id+'\',\''+groucobid+'\')" >Delete Layer</button>'
                                        +'<a class="text-primary mr-3" data-toggle="modal"  data-looklayer-id="'+layerdatajson[i].id+'" data-target="#editlayermodal">'
                                        +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" data-toggle="modal" data-target="#editlayermodal" onclick="showdatalooklayer('+layerdatajson[i].id+')" >Edit Layer</button>'
                                        +'</a>'
                                        +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="showdetailinstallment(\''+layerdatajson[i].id+'\')" >Add Installment</button>' 
                                        +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="showdetailcob(\''+layerdatajson[i].id+'\')" >Add Detail COB</button>'  
                                        +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="showadjustmentsubmit(\''+layerdatajson[i].id+'\')" >Adjustment</button>'  
                                        
                                        +'</div>'
                                        +'</div>'
                                        +'</td>'+
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
                swal("Error!", "Layer  Delete Error", "Delete Error");
            }
        });
}
</script>




<script type="text/javascript">

    function showdatalooklayer(layerid)
    {
        //alert(submasterid);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
        url:"{{url('treaty/nonprop/getlayerdetailbyid/')}}/"+layerid,
        type:"GET",
        data:{
            layerid:layerid,
        },
          beforeSend: function() { $("body").addClass("loading");  },
          complete: function() {  $("body").removeClass("loading"); },
          success:function(response)
          {
                  swal("Success!", "Group Cob Contracct Insert Success", "success")
                  if(response.success==true)
                  {
                    
                    $("#layeridupdate43").val(layerid);
                    $("#layerlevelupdate option[value="+response.layerdatalist.layer_level +"]:first")[0].selected = true;
                    $("#groupcobidlayerupdate").val(response.layerdatalist.groupcob_number);
                    $("#premratelayerupdate").val(response.layerdatalist.prem_rate);
                    $("#instlayerupdate").val(response.layerdatalist.inst);
                    
                    $('#statuslayerupdate option[value="'+response.layerdatalist.status_layer+'"]:first')[0].selected = true;
                    //$('#statuslayerupdate').find("option[value='"+.response.layerdatalist.status_layer+"']")[0].selected = true;
                    
                    $("#uwlayerupdate").val(response.layerdatalist.uw_retention);
                    $("#mindeplayerupdate").val(response.layerdatalist.mindep_rate);
                    $("#limitlayerupdate").val(response.layerdatalist.limit_rate);
                    
                    if($('#premiumtypelayerupdate option[value="'+ response.layerdatalist.premium_type +'"]:first')[0])
                    {
                     $('#premiumtypelayerupdate option[value="'+ response.layerdatalist.premium_type +'"]:first')[0].selected = true;
                    }
                    
                    $("#aadlimitlayerupdate").val(response.layerdatalist.aad_limit);
                    $("#nasresharelayerupdate").val(response.layerdatalist.nasre_share);
                    $("#liabilitylayerupdate").val(response.layerdatalist.liability);
                    $("#mdpremiumlayerupdate").val(response.layerdatalist.md_premium);
                    $("#aadeductiblelayerupdate").val(response.layerdatalist.aa_deductible);
                    $("#brokeragelayerupdate").val(response.layerdatalist.brokerage_amount);
                    
                  }

           },
           error: function (request, status, error) 
           {
               //alert(request.responseText);
               swal("Error!", "Group Cob Contracct Insert Error", "Insert Error");
           }
       });

    }

    $('#editlayermodal').on('show.bs.modal', function(e) 
    {        
        //var submasterid = '';
        //submatserid=$(e.relatedTarget).data('looksubmaster');

        
    });

</script>




<script type="text/javascript">
    function updatelayersubmit()
    {
        var layerid = $('#layeridupdate43').val();
        var groucobid = $('#idgroupcob412').val();
        var layerlevel = $('#layerlevelupdate').val();
        var premratelayer = $('#premratelayerupdate').val();
        var instlayer = $('#instlayerupdate').val();
        var statuslayer = $('#statuslayerupdate').val();
        var uwlayer = $('#uwlayerupdate').val();
        var mindeplayer = $('#mindeplayerupdate').val();
        var limitlayer = $('#limitlayerupdate').val();
        var premiumtypelayer = $('#premiumtypelayerupdate').val();
        var reinstatementlayer = "";
        var nasresharelayer = $('#nasresharelayerupdate').val();
        var liabilitylayer = $('#liabilitylayerupdate').val();
        var mdpremiumlayer = $('#mdpremiumlayerupdate').val();
        var aadlimitlayer = $('#aadlimitlayerupdate').val();
        var aadeductiblelayer = $('#aadeductiblelayerupdate').val();
        var groupcobidlayer = $('#groupcobidlayerupdate').val();
        var transferdate = $('#transferdatelayerupdate').val();
    
        

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    
        $.ajax({
            url:"{{url('treaty/nonprop/mindep/storelayer')}}",
            type:"POST",
            data:{
                layerid:layerid,
                groupcobidlayer:groupcobidlayer,
                layerlevel:layerlevel,
                premratelayer:premratelayer,
                instlayer:instlayer,
                statuslayer:statuslayer,
                uwlayer:uwlayer,
                mindeplayer:mindeplayer,
                limitlayer:limitlayer,
                premiumtypelayer:premiumtypelayer,
                reinstatementlayer:reinstatementlayer,
                nasresharelayer:nasresharelayer,
                liabilitylayer:liabilitylayer,
                mdpremiumlayer:mdpremiumlayer,
                aadlimitlayer:aadlimitlayer,
                aadeductiblelayer:aadeductiblelayer,
                transferdate:transferdate
            },
            beforeSend: function() { $("body").addClass("loading");  },
            complete: function() {  $("body").removeClass("loading"); },
            success:function(response)
            {
                swal("Success!", "Layer Group COb Insert Success", "success")

                if(response.success==true)
                {
                    let dollarUSLocale = Intl.NumberFormat('en-US');

                    $('#layerPanel tbody').prepend('<tr id="layercobslipid'+response.layerdata.id+'" data-name="slipvalue[]">'
                    +'<td data-name="'+response.layerdata.id+'">'+response.layerdata.id+'</td>'
                    +'<td>'+layerlevel+'</td>'
                    +'<td>'+dollarUSLocale.format(limitlayer)+'</td>'
                    +'<td>'+dollarUSLocale.format(reinstatementlayer)+'</td>'
                    +'<td>'+dollarUSLocale.format(nasresharelayer)+'</td>'
                    +'<td>'+dollarUSLocale.format(nasresharelayer)+'</td>'
                    +'<td>'+dollarUSLocale.format(mindeplayer)+'</td>'
                    +'<td>'+response.layerdata.status_layer+'</td>'
                    +'<td>'

                    +'<div class="btn-group" role="group">'
                    +'<button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> (Option)</button>'
                    +'<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">'

                    +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="deletelayer(\''+response.layerdata.id+'\',\''+groupcobidlayer+'\')" >Delete Layer</button>'
                    +'<a class="text-primary mr-3" data-toggle="modal"  data-looklayer-id="'+response.layerdata.id+'" data-target="#editlayermodal">'
                    +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" data-toggle="modal" data-target="#editlayermodal" onclick="showdatalooklayer('+response.layerdata.id+')" >Edit Layer</button>'
                    +'</a>'
                    +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="showdetailinstallment(\''+response.layerdata.id+'\')" >Add Installment</button>' 
                    +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="showdetailcob(\''+response.layerdata.id+'\')" >Add Detail COB</button>'  
                    +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="showadjustmentsubmit(\''+response.layerdata.id+'\')" >Adjustment</button>'  
                    
                    +'</div>'
                    +'</div>'

                    +'</td>'+
                    +'</tr>');    
                }


                    $('#premratelayer').val("");
                    $('#instlayer').val("");
                    $('#uwlayer').val("");
                    $('#mindeplayer').val("");
                    $('#limitlayer').val("");
                    $('#premiumtypelayer').val("");
                    $('#nasresharelayer').val("");
                    $('#liabilitylayer').val("");
                    $('#mdpremiumlayer').val("");
                    $('#aadlimitlayer').val("");
                    $('#aadeductiblelayer').val("");

            },
            error: function (request, status, error) 
            {
                //alert(request.responseText);
                swal("Error!", "Layer Group COB Insert Error", "Insert Error");
            }
        });

        console.log('sudah insert');

        $.ajax({
        url:"{{url('treaty/nonprop/getlayerbyid/')}}/"+groucobid,
        type:"GET",
        data:{
            groucobid:groucobid,
        },
          beforeSend: function() { $("body").addClass("loading");  },
          complete: function() {  $("body").removeClass("loading"); },
          success:function(response)
          {
                  swal("Success!", "Layer Data Success", "success")
                  $('#layerPanel tbody').empty();
                  
                  if(response.success==true)
                  {
                        layerdatajson=JSON.parse(response.layerdatalist);

                        for(var i = 0; i < layerdatajson.length; i++)
                        {
                            let dollarUSLocale = Intl.NumberFormat('en-US');

                            $('#layerPanel tbody').prepend('<tr id="layercobslipid'+layerdatajson[i].id+'" data-name="slipvalue[]">'
                            +'<td data-name="'+layerdatajson[i].id+'">'+layerdatajson[i].id+'</td>'
                            +'<td>'+layerdatajson[i].layer_level+'</td>'
                            +'<td>'+dollarUSLocale.format(layerdatajson[i].limit_rate)+'</td>'
                            +'<td>'+dollarUSLocale.format(layerdatajson[i].reinstatement)+'</td>'
                            +'<td>'+dollarUSLocale.format(layerdatajson[i].nasre_share)+'</td>'
                            +'<td>'+dollarUSLocale.format(layerdatajson[i].nasre_share)+'</td>'
                            +'<td>'+dollarUSLocale.format(layerdatajson[i].mindep_rate)+'</td>'
                            +'<td>'+layerdatajson[i].status_layer+'</td>'
                            +'<td>'

                            +'<div class="btn-group" role="group">'
                            +'<button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> (Option)</button>'
                            +'<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">'


                            +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="deletelayer(\''+layerdatajson[i].id+'\',\''+groucobid+'\')" >Delete Layer</button>'
                            +'<a class="text-primary mr-3" data-toggle="modal"  data-looklayer-id="'+layerdatajson[i].id+'" data-target="#editlayermodal">'
                            +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" data-toggle="modal" data-target="#editlayermodal" onclick="showdatalooklayer('+layerdatajson[i].id+')" >Edit Layer</button>'
                            +'</a>'
                            +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="showdetailinstallment(\''+layerdatajson[i].id+'\')" >Add Installment</button>' 
                            +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="showdetailcob(\''+layerdatajson[i].id+'\')" >Add Detail COB</button>'  
                            +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="showadjustmentsubmit(\''+layerdatajson[i].id+'\')" >Adjustment</button>'  
                            
                            +'</div>'
                            +'</div>'

                            +'</td>'+
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





