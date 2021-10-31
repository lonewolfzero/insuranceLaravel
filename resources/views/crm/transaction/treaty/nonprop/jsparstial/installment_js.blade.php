<script type='text/javascript'>
   
   $('#pctinst').keyup(function(e)
   {
         var keyCode = e.keyCode || e.which;
        if(keyCode != 9)
        {
            var percentceding = parseFloat($(this).val());
            var valpre = $('#mdpremium32').val();

            if(valpre != null)
            {
                var premium2 = $('#mdpremium32').val();
                var conv_premium2 = parseInt(premium2.replace(/,/g, ""));
                var sum_amount2 = isNaN((percentceding * conv_premium2)/100) ? 0 :(percentceding * conv_premium2)/100;
                var real_sum2 = sum_amount2.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('#grossinst').val(real_sum2);
            }
            else
            {
                swal('warning!','please fill MD Premium first','error')
            }
        }
        else
        {
            var percentceding = parseFloat($(this).val());
            var valpre = $('#mdpremium32').val();

            if(valpre != null){
                var premium2 = $('#mdpremium32').val();
                var conv_premium2 = parseInt(premium2.replace(/,/g, ""));
                var sum_amount2 = isNaN((percentceding * conv_premium2)/100) ? 0 :(percentceding * conv_premium2)/100;
                var real_sum2 = sum_amount2.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('#grossinst').val(real_sum2);
            }
            else
            {
                swal('warning!','please fill MD Premium  first','error')
            }
        }
    });


   $('#grossinst').keyup(function(e)
   {
        var gross2 = parseFloat($(this).val());
        var valpre = $('#mdpremium32').val();

        if(gross2 != null)
        {
            var premium2 = $('#mdpremium32').val();
            var conv_premium2 = parseInt(premium2.replace(/,/g, ""));
            var conv_gross2 = parseInt(gross2.replace(/,/g, ""));
            var sum_amount2 = isNaN((conv_gross2 * 100)/conv_premium2) ? 0 :(conv_gross2 * 100)/conv_premium2;
            
            $('#pctinst').val(sum_amount2);
        }
        else
        {
            swal('warning!','please fill MD Premium first','error')
        }   
   });


   $('#brokerinst').keyup(function(e)
   {
         var keyCode = e.keyCode || e.which;
        if(keyCode != 9)
        {
            var brokerdata = parseFloat($(this).val());
            var grosspre = $('#grossinst').val();

            if(grosspre != null)
            {
                var gross2 = $('#grossinst').val();
                var conv_gross2 = parseInt(gross2.replace(/,/g, ""));
                var sum_amount2 = isNaN(gross2-brokerdata) ? 0 :(gross2-brokerdata);
                var real_sum2 = sum_amount2.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('#amountinst').val(real_sum2);
            }
            else
            {
                swal('warning!','please fill MD Premium first','error')
            }
        }
        else
        {
            var brokerdata = parseFloat($(this).val());
            var grosspre = $('#grossinst').val();

            if(grosspre != null){
                var gross2 = $('#grossinst').val();
                
                var conv_gross2 = parseInt(gross2.replace(/,/g, ""));
                var sum_amount2 = isNaN(gross2-brokerdata) ? 0 :(gross2-brokerdata);
                var real_sum2 = sum_amount2.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('#amountinst').val(real_sum2);
            }
            else
            {
                swal('warning!','please fill MD Premium  first','error')
            }
        }
    });


function showdetailinstallment(groucobidlayer) 
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
                $("#masterid32").val(response.mastercontract.number);
                $('#masterdateentry32').val(response.mastercontract.date_entry);
                $('#masterceding32').val(response.cedingbroker.name);
                $('#masterceding32').val(response.mastercontract.ceding_name);
                $('#masteruser32').val(response.mastercontract.user_name);
                $('#masteruwyear32').val(response.mastercontract.uwyear);
                $('#mastercedingtype32').val(response.mastercontract.ceding_type);

              
                console.log(response.subcontract);
                $('#submasterid32').val(response.subcontract.number_subcontract);
                $('#submasterceding32').val(response.subcontract.ceding_name);
                
                 
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

                $('#submasterperiod322').val(newdatefrom);
                $('#submasterperiod3222').val(newdateto);


                $('#submastertype32').val(response.subcontract.subcontract_type);

                console.log(response.groucob);
                $('#idgroupcob32').val(response.groucob.numbercob);
                $('#groucob32').val(response.groucob.cob_name);
                $('#groupcoborgpi32').val(response.groucob.ogrpi);
                $('#groupcobtype32').val(response.groucob.treaty_type);
                $('#groupcobbrokerage32').val(response.groucob.brokerage_value);
                $('#groupcobbrokeragepersen32').val(response.groucob.brokerage_persentage);

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

            }

        },
          error: function (request, status, error) 
          {
              //alert(request.responseText);
              swal("Error!", "Group Cob/Layer get Data Error", "get Data Error");
          }
      });



      $.ajax({
        url:"{{url('treaty/nonprop/getinstallmentcount/')}}/"+groucobidlayer,
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
                    $('#counternumberinst').val(response.countercode);
                         
                  }

           },
           error: function (request, status, error) 
           {
               //alert(request.responseText);
               swal("Error!", "Master Contracct Insert Error", "Insert Error");
           }
       });


       $.ajax({
        url:"{{url('treaty/nonprop/getinstallmentbyid/')}}/"+groucobidlayer,
        type:"GET",
        data:{
            groucobidlayer:groucobidlayer,
        },
          beforeSend: function() { $("body").addClass("loading");  },
          complete: function() {  $("body").removeClass("loading"); },
          success:function(response)
          {
                  swal("Success!", "Group Installment Detail Insert Success", "success")
                  $('#tabledetailinst32 tbody').empty();
                  
                  if(response.success==true)
                  {
                        installmentdatalistjson=JSON.parse(response.installmentdatalist);

                        for(var i = 0; i < installmentdatalistjson.length; i++)
                        {  
                            let dollarUSLocale = Intl.NumberFormat('en-US');

                            $('#tabledetailinst32 tbody').prepend('<tr id="installmentdetailslipid'+installmentdatalistjson[i].id+'" data-name="installmentdetailslipidvalue[]">'
                                +'<td data-name="'+installmentdatalistjsonp[i].id+'">'+installmentdatalistjsonp[i].id+'</td>'
                                +'<td>'+installmentdatalistjsonp[i].due_date+'</td>'
                                +'<td>'+installmentdatalistjsonp[i].rep_date+'</td>'
                                +'<td>'+installmentdatalistjsonp[i].pct_persentage+'</td>'
                                +'<td>'+dollarUSLocale.format(installmentdatalistjsonp[i].gross)+'</td>'
                                +'<td>'+dollarUSLocale.format(installmentdatalistjsonp[i].broker)+'</td>'
                                +'<td>'+dollarUSLocale.format(installmentdatalistjsonp[i].amount)+'</td>'
                                +'<td>'

                                +'<div class="btn-group" role="group">'
                                +'<button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> (Option)</button>'
                                +'<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">'


                                +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="deletedetailinst(\''+installmentdatalistjsonp[i].id+'\',\''+groucobidlayer+'\')" >Delete Installment</button>'
                                +'<a class="text-primary mr-3" data-toggle="modal"  data-lookdetailinst-id="'+installmentdatalistjsonp[i].id+'" onclick="showdatalookdetailinst('+installmentdatalistjsonp[i].id+')" data-target="#editdetailinstallmentmodal">'
                                +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" data-toggle="modal" data-target="#editdetailinstallmentmodal">Edit Installment</button>'
                                +'</a>'
                                +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="cancelinstalllemt(\''+installmentdatalistjsonp[i].id+'\')" >Reset Installment</button>'
                                
                                
                                +'</div>'
                                +'</div>'

                                +'</td>'
                                +'</tr>');    
                            //+'<td>'+installmentcobdatajson[i].mindep_amount+'</td>'
                        }
                  }

           },
           error: function (request, status, error) 
           {
               //alert(request.responseText);
               swal("Error!", "Master Contracct Insert Error", "Insert Error");
           }
       });


       console.log('sudah get');
   
  
      $("#group_detailinstallment_card").show();
      $("#group_layer_card").hide();
}



function storeinstallmentdetailsubmit()
{
    var layerid = $('#layerid32').val();
    var counternumberinst = $('#counternumberinst').val();
    var duedateinst = $('#duedateinst').val();
    var grossinst = $('#grossinst').val();
    var repdateinst = $('#repdateinst').val();
    var brokerinst = $('#brokerinst').val();
    var pctinst = $('#pctinst').val();
    var amountinst = $('#amountinst').val();
    var ppwdaysinst = $('#ppwdaysinst').val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

 
    $.ajax({
        url:"{{url('treaty/nonprop/mindep/storeinstallmentdetail')}}",
        type:"POST",
        data:{
            layerid:layerid,
            counternumberinst:counternumberinst,
            duedateinst:duedateinst,
            grossinst:grossinst,
            repdateinst:repdateinst,
            brokerinst:brokerinst,
            pctinst:pctinst,
            amountinst:amountinst,
            ppwdaysinst:ppwdaysinst
        },
          beforeSend: function() { $("body").addClass("loading");  },
          complete: function() {  $("body").removeClass("loading"); },
          success:function(response)
          {
              swal("Success!", "Store Installment Detail Insert Success", "success")

              if(response.success==true)
              {

                let dollarUSLocale = Intl.NumberFormat('en-US');

                $('#tabledetailinst32 tbody').prepend('<tr id="installmentdetailslipid'+response.id+'" data-name="installmentdetailslipidvalue[]">'
                 +'<td data-name="'+response.id+'">'+response.id+'</td>'
                 +'<td>'+duedateinst+'</td>'
                 +'<td>'+repdateinst+'</td>'
                 +'<td>'+pctinst+'</td>'
                 +'<td>'+dollarUSLocale.format(grossinst)+'</td>'
                 +'<td>'+dollarUSLocale.format(brokerinst)+'</td>'
                 +'<td>'+dollarUSLocale.format(amountinst)+'</td>'
                 +'<td>'
                 +'<div class="btn-group" role="group">'
                 +'<button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> (Option)</button>'
                 +'<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">'

                 +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="deletedetailinst(\''+response.id+'\',\''+layerid+'\')" >Delete Installment</button>'
                +'<a class="text-primary mr-3" data-toggle="modal"  data-lookdetailinst-id="'+response.id+'" onclick="showdatalookdetailinst('+response.id+')"  data-target="#editdetailinstallmentmodal">'
                +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" data-toggle="modal" data-target="#editdetailinstallmentmodal">Edit Installment</button>'
                +'</a>'
                 +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="cancelinstalllemt(\''+response.id+'\')" >Reset Installment</button>'
                 
                 +'</div>'
                 +'</div>'
                 +'</td>'
                 +'</tr>');    
              }

                $('#duedateinst').val("");
                $('#grossinst').val("");
                $('#repdateinst').val("");
                $('#brokerinst').val("");
                $('#pctinst').val("");
                $('#amountinst').val("");
                $('#ppwdaysinst').val("");

           },
           error: function (request, status, error) 
           {
               //alert(request.responseText);
               swal("Error!", "Store Installment Detail Insert Error", "Insert Error");
           }
       });

       console.log('sudah insert');

}


function cancelinstalllemt(groucobidlayer)
{
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    

    $.ajax({
        url:"{{url('treaty/nonprop/mindep/resetinstallmentdetail')}}",
        type:"POST",
        data:{
            groucobidlayer:groucobidlayer
        },
          beforeSend: function() { $("body").addClass("loading");  },
          complete: function() {  $("body").removeClass("loading"); },
          success:function(response)
          {
                  swal("Success!", "Master Contracct Insert Success", "success")

          },
           error: function (request, status, error) 
          {
               //alert(request.responseText);
               swal("Error!", "Master Contracct Insert Error", "Insert Error");
          }
    });


    $.ajax({
        url:"{{url('treaty/nonprop/getinstallmentbyid/')}}/"+groucobidlayer,
        type:"GET",
        data:{
            groucobidlayer:groucobidlayer,
        },
          beforeSend: function() { $("body").addClass("loading");  },
          complete: function() {  $("body").removeClass("loading"); },
          success:function(response)
          {
                  swal("Success!", "Group Installment Detail Insert Success", "success")
                  $('#tabledetailinst32 tbody').empty();
                  
                  if(response.success==true)
                  {
                        installmentdatalistjson=JSON.parse(response.installmentdatalist);

                        for(var i = 0; i < installmentdatalistjson.length; i++)
                        {  
                            let dollarUSLocale = Intl.NumberFormat('en-US');

                            $('#tabledetailinst32 tbody').prepend('<tr id="installmentdetailslipid'+installmentdatalistjson[i].id+'" data-name="installmentdetailslipidvalue[]">'
                                +'<td data-name="'+installmentdatalistjsonp[i].id+'">'+installmentdatalistjsonp[i].id+'</td>'
                                +'<td>'+installmentdatalistjsonp[i].due_date+'</td>'
                                +'<td>'+installmentdatalistjsonp[i].rep_date+'</td>'
                                +'<td>'+installmentdatalistjsonp[i].pct_persentage+'</td>'
                                +'<td>'+dollarUSLocale.format(installmentdatalistjsonp[i].gross)+'</td>'
                                +'<td>'+dollarUSLocale.format(installmentdatalistjsonp[i].broker)+'</td>'
                                +'<td>'+dollarUSLocale.format(installmentdatalistjsonp[i].amount)+'</td>'
                                +'<td>'

                                +'<div class="btn-group" role="group">'
                                +'<button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> (Option)</button>'
                                +'<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">'

                                +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="deletedetailinst(\''+installmentdatalistjsonp[i].id+'\',\''+groucobidlayer+'\')" >Delete Installment</button>'
                                +'<a class="text-primary mr-3" data-toggle="modal"  data-lookdetailinst-id="'+installmentdatalistjsonp[i].id+'" onclick="showdatalookdetailinst('+installmentdatalistjsonp[i].id+')"  data-target="#editdetailinstallmentmodal">'
                                +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" data-toggle="modal" data-target="#editdetailinstallmentmodal">Edit Installment</button>'
                                +'</a>'
                                +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="cancelinstalllemt(\''+installmentdatalistjsonp[i].id+'\')" >Reset Installment</button>'
                                
                                
                                +'</div>'
                                +'</div>'

                                +'</td>'
                                +'</tr>');    
                            //+'<td>'+installmentcobdatajson[i].mindep_amount+'</td>'
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


<script type="text/javascript">
function deletedetailinst(installmentid,layerid)
{

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url:"{{url('treaty/nonprop/deletedetailinstallment/')}}/"+installmentid,
            type:"GET",
            data:{
                installmentid:installmentid,
            },
            beforeSend: function() { $("body").addClass("loading");  },
            complete: function() {  $("body").removeClass("loading"); },
            success:function(response)
            {
                swal("Success!",  "Detail Installment Delete Success", "success")

                $.ajax({
                    url:"{{url('treaty/nonprop/getinstallmentbyid/')}}/"+layerid,
                    type:"GET",
                    data:{
                        layerid:layerid,
                    },
                    beforeSend: function() { $("body").addClass("loading");  },
                    complete: function() {  $("body").removeClass("loading"); },
                    success:function(response)
                    {
                            swal("Success!", "Group Installment Detail Insert Success", "success")
                            $('#tabledetailinst32 tbody').empty();
                            
                            if(response.success==true)
                            {
                                    installmentdatalistjson=JSON.parse(response.installmentdatalist);

                                    for(var i = 0; i < installmentdatalistjson.length; i++)
                                    {  
                                        let dollarUSLocale = Intl.NumberFormat('en-US');

                                        $('#tabledetailinst32 tbody').prepend('<tr id="installmentdetailslipid'+installmentdatalistjson[i].id+'" data-name="installmentdetailslipidvalue[]">'
                                            +'<td data-name="'+installmentdatalistjsonp[i].id+'">'+installmentdatalistjsonp[i].id+'</td>'
                                            +'<td>'+installmentdatalistjsonp[i].due_date+'</td>'
                                            +'<td>'+installmentdatalistjsonp[i].rep_date+'</td>'
                                            +'<td>'+installmentdatalistjsonp[i].pct_persentage+'</td>'
                                            +'<td>'+dollarUSLocale.format(installmentdatalistjsonp[i].gross)+'</td>'
                                            +'<td>'+dollarUSLocale.format(installmentdatalistjsonp[i].broker)+'</td>'
                                            +'<td>'+dollarUSLocale.format(installmentdatalistjsonp[i].amount)+'</td>'
                                            +'<td>'

                                            +'<div class="btn-group" role="group">'
                                            +'<button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> (Option)</button>'
                                            +'<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">'


                                            +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="deletedetailinst(\''+installmentdatalistjsonp[i].id+'\',\''+layerid+'\')" >Delete Installment</button>'
                                            +'<a class="text-primary mr-3" data-toggle="modal"  data-lookdetailinst-id="'+installmentdatalistjsonp[i].id+'" onclick="showdatalookdetailinst('+installmentdatalistjsonp[i].id+')"  data-target="#editdetailinstallmentmodal">'
                                            +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" data-toggle="modal" data-target="#editdetailinstallmentmodal">Edit Installment</button>'
                                            +'</a>'
                                            +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="cancelinstalllemt(\''+installmentdatalistjsonp[i].id+'\')" >Reset Installment</button>'
                                            
                                            +'</div>'
                                            +'</div>'
                                            +'</td>'
                                            +'</tr>');    
                                        //+'<td>'+installmentcobdatajson[i].mindep_amount+'</td>'
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

    function showdatalookdetailinst(detailinstid)
    {
        //alert(submasterid);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
        url:"{{url('treaty/nonprop/getinstallmentdetailbyid/')}}/"+detailinstid,
        type:"GET",
        data:{
            detailinstid:detailinstid,
        },
          beforeSend: function() { $("body").addClass("loading");  },
          complete: function() {  $("body").removeClass("loading"); },
          success:function(response)
          {
                  swal("Success!", "Group Cob Contracct Insert Success", "success")
                  if(response.success==true)
                  {

                    $("#installmentidupdate32").val(detailinstid); 
                    $("#counternumberinstupdate").val(response.installmentdatalist.counter_number);
                    $("#duedateinstupdate").val(response.installmentdatalist.due_date);
                    $("#grossinstupdate").val(response.installmentdatalist.gross);
                    $("#repdateinstupdate").val(response.installmentdatalist.rep_date);
                    $("#brokerinstupdate").val(response.installmentdatalist.broker);
                    $("#pctinstupdate").val(response.installmentdatalist.pct_persentage);
                    $("#amountinstupdate").val(response.installmentdatalist.amount);
                    $("#ppwdaysinstupdate").val(response.installmentdatalist.ppw_days);
                  
                  }
           },
           error: function (request, status, error) 
           {
               //alert(request.responseText);
               swal("Error!", "Group Cob Contracct Insert Error", "Insert Error");
           }
       });

    }

    $('#editdetailinstallmentmodal').on('show.bs.modal', function(e) 
    {        
        //var submasterid = '';
        //submatserid=$(e.relatedTarget).data('looksubmaster');
    });

</script>




<script type="text/javascript">
    function updateinstallmentdetailsubmit()
    {
        var installmentdetailid = $('#installmentidupdate32').val();
        var layerid = $('#layerid32').val();
        var counternumberinst = $('#counternumberinstupdate').val();
        var duedateinst = $('#duedateinstupdate').val();
        var grossinst = $('#grossinstupdate').val();
        var repdateinst = $('#repdateinstupdate').val();
        var brokerinst = $('#brokerinstupdate').val();
        var pctinst = $('#pctinstupdate').val();
        var amountinst = $('#amountinstupdate').val();
        var ppwdaysinst = $('#ppwdaysinstupdate').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    
        $.ajax({
            url:"{{url('treaty/nonprop/mindep/storeinstallmentdetail')}}",
            type:"POST",
            data:{
                installmentdetailid:installmentdetailid,
                layerid:layerid,
                counternumberinst:counternumberinst,
                duedateinst:duedateinst,
                grossinst:grossinst,
                repdateinst:repdateinst,
                brokerinst:brokerinst,
                pctinst:pctinst,
                amountinst:amountinst,
                ppwdaysinst:ppwdaysinst
            },
            beforeSend: function() { $("body").addClass("loading");  },
            complete: function() {  $("body").removeClass("loading"); },
            success:function(response)
            {
                swal("Success!", "Store Installment Detail Insert Success", "success")

                if(response.success==true)
                {
                    let dollarUSLocale = Intl.NumberFormat('en-US');

                    $('#tabledetailinst32 tbody').prepend('<tr id="installmentdetailslipid'+response.id+'" data-name="installmentdetailslipidvalue[]">'
                    +'<td data-name="'+response.id+'">'+response.id+'</td>'
                    +'<td>'+duedateinst+'</td>'
                    +'<td>'+repdateinst+'</td>'
                    +'<td>'+pctinst+'</td>'
                    +'<td>'+dollarUSLocale.format(grossinst)+'</td>'
                    +'<td>'+dollarUSLocale.format(brokerinst)+'</td>'
                    +'<td>'+dollarUSLocale.format(amountinst)+'</td>'
                    +'<td>'

                    +'<div class="btn-group" role="group">'
                    +'<button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> (Option)</button>'
                    +'<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">'


                    +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="deletedetailinst(\''+response.id+'\',\''+layerid+'\')" >Delete Installment</button>'
                    +'<a class="text-primary mr-3" data-toggle="modal"  data-lookdetailinst-id="'+response.id+'" onclick="showdatalookdetailinst('+response.id+')"  data-target="#editdetailinstallmentmodal">'
                    +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" data-toggle="modal" data-target="#editdetailinstallmentmodal">Edit Installment</button>'
                    +'</a>'
                    +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="cancelinstalllemt(\''+response.id+'\')" >Reset Installment</button>'
                    
                    +'</div>'
                    +'</div>'

                    +'</td>'
                    +'</tr>');    
                }

                    $('#duedateinst').val("");
                    $('#grossinst').val("");
                    $('#repdateinst').val("");
                    $('#brokerinst').val("");
                    $('#pctinst').val("");
                    $('#amountinst').val("");
                    $('#ppwdaysinst').val("");

            },
            error: function (request, status, error) 
            {
                //alert(request.responseText);
                swal("Error!", "Store Installment Detail Insert Error", "Insert Error");
            }
        });

        console.log('sudah insert');

        $.ajax({
        url:"{{url('treaty/nonprop/getinstallmentbyid/')}}/"+layerid,
        type:"GET",
        data:{
            layerid:layerid,
        },
          beforeSend: function() { $("body").addClass("loading");  },
          complete: function() {  $("body").removeClass("loading"); },
          success:function(response)
          {
                  swal("Success!", "Group Installment Detail Insert Success", "success")
                  $('#tabledetailinst32 tbody').empty();
                  
                  if(response.success==true)
                  {
                        installmentdatalistjson=JSON.parse(response.installmentdatalist);

                        for(var i = 0; i < installmentdatalistjson.length; i++)
                        {  

                            let dollarUSLocale = Intl.NumberFormat('en-US');

                            $('#tabledetailinst32 tbody').prepend('<tr id="installmentdetailslipid'+installmentdatalistjson[i].id+'" data-name="installmentdetailslipidvalue[]">'
                                +'<td data-name="'+installmentdatalistjsonp[i].id+'">'+installmentdatalistjsonp[i].id+'</td>'
                                +'<td>'+installmentdatalistjsonp[i].due_date+'</td>'
                                +'<td>'+installmentdatalistjsonp[i].rep_date+'</td>'
                                +'<td>'+installmentdatalistjsonp[i].pct_persentage+'</td>'
                                +'<td>'+dollarUSLocale.format(installmentdatalistjsonp[i].gross)+'</td>'
                                +'<td>'+dollarUSLocale.format(installmentdatalistjsonp[i].broker)+'</td>'
                                +'<td>'+dollarUSLocale.format(installmentdatalistjsonp[i].amount)+'</td>'
                                +'<td>'

                                +'<div class="btn-group" role="group">'
                                +'<button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> (Option)</button>'
                                +'<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">'


                                +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="deletedetailinst(\''+installmentdatalistjsonp[i].id+'\',\''+groucobidlayer+'\')" >Delete Installment</button>'
                                +'<a class="text-primary mr-3" data-toggle="modal"  data-lookdetailinst-id="'+installmentdatalistjsonp[i].id+'" onclick="showdatalookdetailinst('+installmentdatalistjsonp[i].id+')"  data-target="#editdetailinstallmentmodal">'
                                +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" data-toggle="modal" data-target="#editdetailinstallmentmodal">Edit Installment</button>'
                                +'</a>'
                                +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="cancelinstalllemt(\''+installmentdatalistjsonp[i].id+'\')" >Reset Installment</button>'
                                
                                
                                +'</div>'
                                +'</div>'
                                +'</td>'
                                +'</tr>');    
                            //+'<td>'+installmentcobdatajson[i].mindep_amount+'</td>'
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
