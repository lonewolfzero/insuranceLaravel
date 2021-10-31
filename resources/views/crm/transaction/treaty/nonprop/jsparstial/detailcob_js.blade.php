<script type='text/javascript'>

$('#ogrpi333').keyup(function(e)
{
    var mainogrpi=$("#groupcoborgpi33").val();
    var persenogrpi=$('#ogrpi333').val();
    var totalpersenamount=(mainogrpi*persenogrpi)/100;

    $('#ogrpiamount333').val(totalpersenamount);
});


$('#ogrpiamount333').keyup(function(e)
{
    var mainogrpi=$("#groupcoborgpi33").val();
    var totalamount=$("#ogrpiamount333").val();
    var datapersen=(totalamount*100)/mainogrpi;

    $('#ogrpi333').val(datapersen);
});


function showdetailcob(groucobidlayer) 
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
        if(response.success==true)
        {
                console.log(response.mastercontract);
                $("#masterid33").val(response.mastercontract.number);
                $('#masterdateentry33').val(response.mastercontract.date_entry);
                $('#masterceding33').val(response.mastercontract.ceding_name);
                $('#masteruser33').val(response.mastercontract.user_name);
                $('#masteruwyear33').val(response.mastercontract.uwyear);
                $('#mastercedingtype33').val(response.mastercontract.ceding_type);

                console.log(response.subcontract);
                $('#submasterid33').val(response.subcontract.number_subcontract);
                $('#submasterceding33').val(response.subcontract.ceding_name);

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
                
                $('#submasterperiod33').val(newdatefrom);
                $('#submasterperiod332').val(newdateto);


                console.log(response.groucob);
                $('#idgroupcob33').val(response.groucob.numbercob);
                $('#groucob33').val(response.groucob.cob_name);
                $('#groupcoborgpi33').val(response.groucob.ogrpi);
                $('#groupcobtype33').val(response.groucob.treaty_type);
                $('#groupcobbrokerage33').val(response.groucob.brokerage_value);
                $('#groupcobbrokeragepersen33').val(response.groucob.brokerage_persentage);

                 console.log(response.layerdata);
                 $('#layerid33').val(response.layerdata.id);
                 $('#levellayer33').val(response.layerdata.layer_level);
                 $('#premratelayer33').val(response.layerdata.prem_rate);
                 $('#uwretlayer33').val(response.layerdata.uw_retention);
                 $('#mindeplayer33').val(response.layerdata.mindep_rate);
                 $('#limitlayer33').val(response.layerdata.limit_rate);
                 $('#premiumtypelayer33').val(response.layerdata.premium_type);
                 $('#reinstatement33').val(response.layerdata.reinstatement);
                 $('#retroshare33').val(response.layerdata.retro_share);
                 $('#nasreshare33').val(response.layerdata.nasre_share);
                 $('#liability33').val(response.layerdata.liability);
                 $('#liability332').val(response.layerdata.liability2);
                 $('#mdpremium33').val(response.layerdata.md_premium);
                 $('#mdpremium332').val(response.layerdata.md_premium2);
                 $('#aadlimit33').val(response.layerdata.aad_limit);
                 $('#aadedcutible33').val(response.layerdata.aa_deductible);

                 var ogrpidata=parseInt(response.groucob.ogrpi.replace(/,/g, ""));
                
                 $.ajax({
                    url:"{{url('treaty/nonprop/getdetailcobbyid/')}}/"+groucobidlayer,
                    type:"GET",
                    data:{
                        groucobidlayer:groucobidlayer,
                    },
                    beforeSend: function() { $("body").addClass("loading");  },
                    complete: function() {  $("body").removeClass("loading"); },
                    success:function(response)
                    {
                            swal("Success!", "Group COb Detail Insert Success", "success")
                            $('#tabledetailcob33 tbody').empty();
                            
                            if(response.success==true)
                            {
                                    installmentcobdatajson=JSON.parse(response.installmentcobdatalist);
                                    var temptotal=0;
                                    for(var i = 0; i < installmentcobdatajson.length; i++)
                                    {  

                                        let dollarUSLocale = Intl.NumberFormat('en-US');
                                        $('#tabledetailcob33 tbody').prepend('<tr id="detailcobslipid'+installmentcobdatajson[i].id+'" data-name="detailcobslipidvalue[]">'
                                        +'<td>'+installmentcobdatajson[i].detailcob_id+'</td>'
                                        +'<td>'+dollarUSLocale.format(installmentcobdatajson[i].share_percentage)+'</td>'
                                        +'<td>'+installmentcobdatajson[i].groupcob+'</td>'
                                        +'<td>'+dollarUSLocale.format(installmentcobdatajson[i].ogrpi_percentage)+'</td>'
                                        +'<td>'+dollarUSLocale.format(installmentcobdatajson[i].ogrpi_amount)+'</td>'
                                        +'<td>'

                                        +'<div class="btn-group" role="group">'
                                        +'<button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> (Option)</button>'
                                        +'<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">'

                                        +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="deletedetailcob(\''+installmentcobdatajson[i].id+'\',\''+groucobidlayer+'\')" >Delete COB Detail</button>'
                                        +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="showdatalookreinstatement('+installmentcobdatajson[i].id+')" >Calculate Reinstatement</button>'
                                        
                                        +'<a class="text-primary mr-3" data-toggle="modal"  data-lookdetailcob-id="'+installmentcobdatajson[i].id+'" onclick="showdatalookdetailcob('+installmentcobdatajson[i].id+')" data-target="#editdetailcobmodal">'
                                        +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" data-toggle="modal" data-target="#editdetailcobmodal">Edit Cob Detail </button>'
                                        +'</a>'
                                        
                                        +'</div>'
                                        +'</div>'

                                        +'</td>'
                                        +'</tr>');   
                                        
                                        var tempdata=(ogrpidata*installmentcobdatajson[i].ogrpi_percentage)/100;
                                        temptotal=temptotal+tempdata;
                                    }

                                    $('#totalsharecob33').val(temptotal);

                            }
                    },
                    error: function (request, status, error) 
                    {
                        //alert(request.responseText);
                        swal("Error!", "Master Contracct Insert Error", "Insert Error");
                    }
                });



            }

          },
          error: function (request, status, error) 
          {
              //alert(request.responseText);
              swal("Error!", "Group Cob/Layer get Data Error", "get Data Error");
          }
      });


      

    console.log('sudah get');
   
    $("#group_detailcob_card").show();
    $("#group_layer_card").hide();
}



function prevlayerdetailcob() 
{
    //alert(groucobid);
    $("#group_layer_card").show();
    $("#group_detailcob_card").hide();
}



function storecobdetailsubmit()
{
    var layerid = $('#layerid33').val();
    var detailcob = $('#detailcob333').val();
    var ogrpicob = $('#ogrpiamount333').val();
    var ogrpicobpercentage = $('#ogrpi333').val();
    var flag_overseas = $('#flag_overseas33').val();
    var businessid = $('#business_id').val();
    var maximum_acceptence = $('#maximum_acceptence').val();

    var ogrpidata=$('#groupcoborgpi33').val();
    ogrpidata=parseInt(ogrpidata.replace(/,/g, ""));


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $.ajax({
        url:"{{url('treaty/nonprop/mindep/storedetailcob')}}",
        type:"POST",
        data:{
            layerid:layerid,
            detailcob:detailcob,
            ogrpicob:ogrpicob,
            ogrpicobpercentage:ogrpicobpercentage,
            flag_overseas:flag_overseas,
            maximum_acceptence:maximum_acceptence,
            businessid:businessid
        },
          beforeSend: function() { $("body").addClass("loading");  },
          complete: function() {  $("body").removeClass("loading"); },
          success:function(response)
          {
              swal("Success!", "Cob Detail Insert Success", "success")

              if(response.success==true)
              {
                let dollarUSLocale = Intl.NumberFormat('en-US');

                 $('#tabledetailcob33 tbody').prepend('<tr id="detailcobslipid'+response.id+'" data-name="detailcobslipidvalue[]">'
                 +'<td>'+detailcob+'</td>'
                 +'<td>'+dollarUSLocale.format(response.mindepcobdetail.share_percentage)+'</td>'
                 +'<td>'+response.groupcob.cob_name+'</td>'
                 +'<td>'+dollarUSLocale.format(response.mindepcobdetail.ogrpi_percentage)+'</td>'
                 +'<td>'+dollarUSLocale.format(response.mindepcobdetail.ogrpi_amount)+'</td>'
                 +'<td>'
                 +'<div class="btn-group" role="group">'
                 +'<button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> (Option)</button>'
                 +'<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">'

                 +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="showdatalookreinstatement('+response.id+')" >Calculate Reinstatement</button>'
                 +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="deletedetailcob(\''+response.id+'\',\''+layerid+'\')" >Delete COB Detail</button>'
                 +'<a class="text-primary mr-3" data-toggle="modal"  data-lookdetailcob-id="'+response.id+'" onclick="showdatalookdetailcob('+response.id+')" data-target="#editdetailcobmodal">'
                 +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" data-toggle="modal" data-target="#editdetailcobmodal">Edit Cob Detail </button>'
                 +'</a>'
                 +'</div>'
                 +'</div>'

                 +'</td>'
                 +'</tr>');    
                 //+'<td>'+response.mindepcobdetail.mindep_amount+'</td>'
                 
              }

              $('#detailcob333').val("");
              $('#ogrpi333').val("");
              $('#ogrpiamount333').val("");
              $('#flag_overseas33').val("");
              $('#business_id').val("");
              $('#maximum_acceptence').val("");

              
                $.ajax({
                    url:"{{url('treaty/nonprop/getdetailcobbyid/')}}/"+layerid,
                    type:"GET",
                    data:{
                        layerid:layerid,
                    },
                    beforeSend: function() { $("body").addClass("loading");  },
                    complete: function() {  $("body").removeClass("loading"); },
                    success:function(response)
                    {
                            swal("Success!", "Group COb Detail Insert Success", "success")
                            $('#tabledetailcob33 tbody').empty();
                            
                            if(response.success==true)
                            {
                                    installmentcobdatajson=JSON.parse(response.installmentcobdatalist);

                                    var temptotal=0;

                                    for(var i = 0; i < installmentcobdatajson.length; i++)
                                    {  

                                        let dollarUSLocale = Intl.NumberFormat('en-US');

                                        $('#tabledetailcob33 tbody').prepend('<tr id="detailcobslipid'+installmentcobdatajson[i].id+'" data-name="detailcobslipidvalue[]">'
                                        +'<td>'+installmentcobdatajson[i].detailcob_id+'</td>'
                                        +'<td>'+dollarUSLocale.format(installmentcobdatajson[i].share_percentage)+'</td>'
                                        +'<td>'+installmentcobdatajson[i].groupcob+'</td>'
                                        +'<td>'+dollarUSLocale.format(installmentcobdatajson[i].ogrpi_percentage)+'</td>'
                                        +'<td>'+dollarUSLocale.format(installmentcobdatajson[i].ogrpi_amount)+'</td>'
                                        +'<td>'
                                        +'<div class="btn-group" role="group">'
                                        +'<button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> (Option)</button>'
                                        +'<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">'
                                        
                                        +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="showdatalookreinstatement('+installmentcobdatajson[i].id+')" >Calculate Reinstatement</button>'
                                        
                                        +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="deletedetailcob(\''+installmentcobdatajson[i].id+'\',\''+layerid+'\')" >Delete COB Detail</button>'
                                        +'<a class="text-primary mr-3" data-toggle="modal"  data-lookdetailcob-id="'+installmentcobdatajson[i].id+'" onclick="showdatalookdetailcob('+installmentcobdatajson[i].id+')" data-target="#editdetailcobmodal">'
                                        +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" data-toggle="modal" data-target="#editdetailcobmodal">Edit Cob Detail </button>'
                                        +'</a>'
                                        +'</div>'
                                        +'</div>'
                                        +'</td>'
                                        +'</tr>');   

                                        //+'<td>'+installmentcobdatajson[i].mindep_amount+'</td>'
                                        var tempdata=(ogrpidata*installmentcobdatajson[i].ogrpi_percentage)/100;
                                        temptotal=temptotal+tempdata;
                                    }

                                    $('#totalsharecob33').val(temptotal);
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
               swal("Error!", "Cob Detail Insert Error", "Insert Error");
           }
       });

       console.log('sudah insert');


}
</script>


<script type="text/javascript">
function deletedetailcob(detailcobid,layerid)
{
        var ogrpidata=$('#groupcoborgpi33').val();
        ogrpidata=parseInt(ogrpidata.replace(/,/g, ""));


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url:"{{url('treaty/nonprop/deletedetailcob/')}}/"+detailcobid,
            type:"GET",
            data:{
                detailcobid:detailcobid,
            },
            beforeSend: function() { $("body").addClass("loading");  },
            complete: function() {  $("body").removeClass("loading"); },
            success:function(response)
            {
                swal("Success!",  "Detail COB Delete Success", "success")

                var groucobidlayer=$("#groupcobid43").val();
                $.ajax({
                    url:"{{url('treaty/nonprop/getdetailcobbyid/')}}/"+groucobidlayer,
                    type:"GET",
                    data:{
                        groucobidlayer:groucobidlayer,
                    },
                    beforeSend: function() { $("body").addClass("loading");  },
                    complete: function() {  $("body").removeClass("loading"); },
                    success:function(response)
                    {
                            swal("Success!", "Group COb Detail Insert Success", "success")
                            $('#tabledetailcob33 tbody').empty();
                            
                            if(response.success==true)
                            {
                                    installmentcobdatajson=JSON.parse(response.installmentcobdatalist);

                                    var temptotal=0;
                                   
                                    for(var i = 0; i < installmentcobdatajson.length; i++)
                                    {  

                                        let dollarUSLocale = Intl.NumberFormat('en-US');

                                        $('#tabledetailcob33 tbody').prepend('<tr id="detailcobslipid'+installmentcobdatajson[i].id+'" data-name="detailcobslipidvalue[]">'
                                        +'<td>'+installmentcobdatajson[i].detailcob_id+'</td>'
                                        +'<td>'+dollarUSLocale.format(installmentcobdatajson[i].share_percentage)+'</td>'
                                        +'<td>'+installmentcobdatajson[i].groupcob+'</td>'
                                        +'<td>'+dollarUSLocale.format(installmentcobdatajson[i].ogrpi_percentage)+'</td>'
                                        +'<td>'+dollarUSLocale.format(installmentcobdatajson[i].ogrpi_amount)+'</td>'
                                        +'<td>'

                                        +'<div class="btn-group" role="group">'
                                        +'<button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> (Option)</button>'
                                        +'<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">'
                                        +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="showdatalookreinstatement('+installmentcobdatajson[i].id+')" >Calculate Reinstatement</button>'
                                        +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="deletedetailcob(\''+installmentcobdatajson[i].id+'\',\''+layerid+'\')" >Delete COB Detail</button>'
                                        +'<a class="text-primary mr-3" data-toggle="modal"  data-lookdetailcob-id="'+installmentcobdatajson[i].id+'" onclick="showdatalookdetailcob('+installmentcobdatajson[i].id+')" data-target="#editdetailcobmodal">'
                                        +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" data-toggle="modal" data-target="#editdetailcobmodal">Edit Cob Detail </button>'
                                        +'</a>'
                                        
                                        +'</div>'
                                        +'</div>'

                                        +'</td>'
                                        +'</tr>');   
                                        //+'<td>'+installmentcobdatajson[i].mindep_amount+'</td>'
                                        
                                        var tempdata=(ogrpidata*installmentcobdatajson[i].ogrpi_percentage)/100;
                                        temptotal=temptotal+tempdata;
                                    }

                                    $('#totalsharecob33').val(temptotal);
                            }



                            $.ajax({
                                url:"{{url('treaty/nonprop/getdetailcobbyid/')}}/"+layerid,
                                type:"GET",
                                data:{
                                    layerid:layerid,
                                },
                                beforeSend: function() { $("body").addClass("loading");  },
                                complete: function() {  $("body").removeClass("loading"); },
                                success:function(response)
                                {
                                        swal("Success!", "Group COb Detail Insert Success", "success")
                                        $('#tabledetailcob33 tbody').empty();
                                        
                                        if(response.success==true)
                                        {
                                                installmentcobdatajson=JSON.parse(response.installmentcobdatalist);

                                                var temptotal=0;
                                                var ogrpidata=$('#groupcoborgpi33').val();
                                                ogrpidata=parseInt(ogrpidata.replace(/,/g, ""));

                                                for(var i = 0; i < installmentcobdatajson.length; i++)
                                                {  

                                                    let dollarUSLocale = Intl.NumberFormat('en-US');

                                                    $('#tabledetailcob33 tbody').prepend('<tr id="detailcobslipid'+installmentcobdatajson[i].id+'" data-name="detailcobslipidvalue[]">'
                                                    +'<td>'+installmentcobdatajson[i].detailcob_id+'</td>'
                                                    +'<td>'+dollarUSLocale.format(installmentcobdatajson[i].share_percentage)+'</td>'
                                                    +'<td>'+installmentcobdatajson[i].groupcob+'</td>'
                                                    +'<td>'+dollarUSLocale.format(installmentcobdatajson[i].ogrpi_percentage)+'</td>'
                                                    +'<td>'+dollarUSLocale.format(installmentcobdatajson[i].ogrpi_amount)+'</td>'
                                                    +'<td>'

                                                    +'<div class="btn-group" role="group">'
                                                    +'<button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> (Option)</button>'
                                                    +'<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">'
                                                    +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="showdatalookreinstatement('+installmentcobdatajson[i].id+')" >Calculate Reinstatement</button>'
                                                    +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="deletedetailcob(\''+installmentcobdatajson[i].id+'\',\''+layerid+'\')" >Delete COB Detail</button>'
                                                    +'<a class="text-primary mr-3" data-toggle="modal"  data-lookdetailcob-id="'+installmentcobdatajson[i].id+'" onclick="showdatalookdetailcob('+installmentcobdatajson[i].id+')" data-target="#editdetailcobmodal">'
                                                    +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" data-toggle="modal" data-target="#editdetailcobmodal">Edit Cob Detail </button>'
                                                    +'</a>'

                                                    +'</div>'
                                                    +'</div>'
                                                    +'</td>'
                                                    +'</tr>');   

                                                    //+'<td>'+installmentcobdatajson[i].mindep_amount+'</td>'

                                                    var tempdata=(ogrpidata*installmentcobdatajson[i].ogrpi_percentage)/100;
                                                    temptotal=temptotal+tempdata;
                                                
                                                    
                                                }

                                                $('#totalsharecob33').val(temptotal);
                                                    
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
                        swal("Error!", "Master Contracct Insert Error", "Insert Error");
                    }
                });


                    
            },
            error: function (request, status, error) 
            {
                //alert(request.responseText);
                swal("Error!", "Detail COB  Delete Error", "Delete Error");
            }
        });

}
</script>


<script type="text/javascript">
    function showdatalookdetailcob(detailcobid)
    {
        //alert(submasterid);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
        url:"{{url('treaty/nonprop/getdetailcobbyiddetail/')}}/"+detailcobid,
        type:"GET",
        data:{
            detailcobid:detailcobid,
        },
          beforeSend: function() { $("body").addClass("loading");  },
          complete: function() {  $("body").removeClass("loading"); },
          success:function(response)
          {
                  swal("Success!", "Group Cob Contracct Insert Success", "success")
                  if(response.success==true)
                  {
                    
                    $("#detailcobidupdate33").val(detailcobid);

                    $("#detailcobupdate333 option[value=" + response.installmentcobdatalist.detailcob_id + "]:first")[0].selected = true;

                    $("#ogrpiupdate333").val(response.installmentcobdatalist.ogrpi_percentage);

                    $("#ogrpiamountupdate333").val(response.installmentcobdatalist.ogrpi);

                    $("input[name=flag_overseasupdate33][value=" + response.installmentcobdatalist.businesssource + "]").attr('checked', 'checked');

                    if($("#business_idupdate option[value=" + response.installmentcobdatalist.businesstype + "]:first")[0])
                    {
                        $("#business_idupdate option[value=" + response.installmentcobdatalist.businesstype + "]:first")[0].selected = true;
                    }

                    $("#maximum_acceptenceupdate").val(response.installmentcobdatalist.max_acceptance);
                    
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
    function updatecobdetailsubmit()
    {
        var detailcobid=$('#installmentidupdate32').val();
        var layerid = $('#layerid33').val();
        var detailcob = $('#detailcobupdate333').val();
        var ogrpicobpercentage = $('#ogrpiupdate333').val();
        var ogrpicob = $('#ogrpiamountupdate333').val();
        var flag_overseas = $('#flag_overseasupdate33').val();
        var businessid = $('#business_idupdate').val();
        var maximum_acceptence = $('#maximum_acceptenceupdate').val();
        var ogrpidata=$('#groupcoborgpi33').val();
        ogrpidata=parseInt(ogrpidata.replace(/,/g, ""));


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    
        $.ajax({
            url:"{{url('treaty/nonprop/mindep/storedetailcob')}}",
            type:"POST",
            data:{
                detailcobid:detailcobid,
                layerid:layerid,
                detailcob:detailcob,
                ogrpicob:ogrpicob,
                ogrpicobpercentage:ogrpicobpercentage,
                flag_overseas:flag_overseas,
                maximum_acceptence:maximum_acceptence,
                businessid:businessid,
            },
            beforeSend: function() { $("body").addClass("loading");  },
            complete: function() {  $("body").removeClass("loading"); },
            success:function(response)
            {
                swal("Success!", "Cob Detail Insert Success", "success")

                if(response.success==true)
                {
                    let dollarUSLocale = Intl.NumberFormat('en-US');

                    $('#tabledetailcob33 tbody').prepend('<tr id="detailcobslipid'+response.id+'" data-name="detailcobslipidvalue[]">'
                    +'<td>'+detailcob+'</td>'
                    +'<td>'+dollarUSLocale.format(response.mindepcobdetail.share_percentage)+'</td>'
                    +'<td>'+response.groupcob.cob_name+'</td>'
                    +'<td>'+dollarUSLocale.format(response.mindepcobdetail.ogrpi_percentage)+'</td>'
                    +'<td>'+dollarUSLocale.format(response.mindepcobdetail.ogrpi_amount)+'</td>'
                    +'<td>'

                    +'<div class="btn-group" role="group">'
                    +'<button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> (Option)</button>'
                    +'<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">'
                    +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="showdatalookreinstatement('+response.id+')" >Calculate Reinstatement</button>'
                    +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="deletedetailcob(\''+response.id+'\',\''+layerid+'\')" >Delete COB Detail</button>'
                    +'<a class="text-primary mr-3" data-toggle="modal"  data-lookdetailcob-id="'+response.id+'" onclick="showdatalookdetailcob('+response.id+')" data-target="#editdetailcobmodal">'
                    +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" data-toggle="modal" data-target="#editdetailcobmodal">Edit Cob Detail </button>'
                    +'</a>'

                    +'</div>'
                    +'</div>'

                    +'</td>'
                    +'</tr>');    
                    //+'<td>'+response.mindepcobdetail.mindep_amount+'</td>'
                    
                }

                $('#detailcob333').val("");
                $('#ogrpi333').val("");
                $('#flag_overseas33').val("");
                $('#business_id').val("");
                $('#maximum_acceptence').val("");

            },
            error: function (request, status, error) 
            {
                //alert(request.responseText);
                swal("Error!", "Cob Detail Insert Error", "Insert Error");
            }
        });

        console.log('sudah insert');

        $.ajax({
        url:"{{url('treaty/nonprop/getdetailcobbyid/')}}/"+layerid,
        type:"GET",
        data:{
            layerid:layerid,
        },
        beforeSend: function() { $("body").addClass("loading");  },
        complete: function() {  $("body").removeClass("loading"); },
        success:function(response)
        {
                  swal("Success!", "Group COb Detail Insert Success", "success")
                  $('#tabledetailcob33 tbody').empty();
                  
                  if(response.success==true)
                  {
                        installmentcobdatajson=JSON.parse(response.installmentcobdatalist);

                        var temptotal=0;
                        
                        for(var i = 0; i < installmentcobdatajson.length; i++)
                        {  

                            let dollarUSLocale = Intl.NumberFormat('en-US');

                            $('#tabledetailcob33 tbody').prepend('<tr id="detailcobslipid'+installmentcobdatajson[i].id+'" data-name="detailcobslipidvalue[]">'
                            +'<td>'+installmentcobdatajson[i].detailcob_id+'</td>'
                            +'<td>'+dollarUSLocale.format(installmentcobdatajson[i].share_percentage)+'</td>'
                            +'<td>'+installmentcobdatajson[i].groupcob+'</td>'
                            +'<td>'+dollarUSLocale.format(installmentcobdatajson[i].ogrpi_percentage)+'</td>'
                            +'<td>'+dollarUSLocale.format(installmentcobdatajson[i].ogrpi_amount)+'</td>'
                            +'<td>'

                            +'<div class="btn-group" role="group">'
                            +'<button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> (Option)</button>'
                            +'<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">'
                            +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="showdatalookreinstatement('+installmentcobdatajson[i].id+')" >Calculate Reinstatement</button>'
                            +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="deletedetailcob(\''+installmentcobdatajson[i].id+'\',\''+layerid+'\')" >Delete COB Detail</button>'
                            +'<a class="text-primary mr-3" data-toggle="modal"  data-lookdetailcob-id="'+installmentcobdatajson[i].id+'" onclick="showdatalookdetailcob('+installmentcobdatajson[i].id+')" data-target="#editdetailcobmodal">'
                            +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" data-toggle="modal" data-target="#editdetailcobmodal">Edit Cob Detail </button>'
                            +'</a>'

                            +'</div>'
                            +'</div>'
                            +'</td>'
                            +'</tr>');   

                            //+'<td>'+installmentcobdatajson[i].mindep_amount+'</td>'
                            var tempdata=(ogrpidata*installmentcobdatajson[i].ogrpi_percentage)/100;
                            temptotal=temptotal+tempdata;
                           
                            
                        }

                        $('#totalsharecob33').val(temptotal);
                            
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