<script type="text/javascript">
$('#adjreinstatement333').keyup(function(e)
{
 
   var nasreshare=$("#nasreshareadjreins33").val();
   var reinstatement=$("#adjreinstatement333").val();
   
   if(reinstatement)
   {    
      var hasilnationalshare2=(reinstatement*nasreshare)/100
      $("#adjreinsnasreshare333").val(hasilnationalshare2);
   }
});

//var adjustmentdata=parseFloat(response.adjustmentdata.adjusment);
//$('#adjustementreins33').val(response.adjustmentdata.adjusment);
                    

function deleteadjreins(adjreinsid,reinsid)
{

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url:"{{url('treaty/nonprop/deleteadjreins/')}}/"+adjreinsid,
            type:"GET",
            data:{
                adjreinsid:adjreinsid,
            },
            beforeSend: function() { $("body").addClass("loading");  },
            complete: function() {  $("body").removeClass("loading"); },
            success:function(response)
            {
                swal("Success!",  "Detail Reins Delete Success", "success")
               // var detailcob=$("#groupcobid43").val();
    
                $.ajax({
                        url:"{{url('treaty/nonprop/getgroupreinstatementdata/')}}/"+reinsid,
                        type:"GET",
                        data:{
                            reinsid:reinsid,
                        },
                        beforeSend: function() { $("body").addClass("loading");  },
                        complete: function() {  $("body").removeClass("loading"); },
                        success:function(response)
                        {
                            swal("Success!", "Group COb Detail Insert Success", "success")
                            $('#tableadjreins33 tbody').empty();
                            
                            if(response.success==true)
                            {
                                ajdreinsdatalistjson=JSON.parse(response.ajdreinsdatalist);

                                    for(var i = 0; i < ajdreinsdatalistjson.length; i++)
                                    { 

                                        let dollarUSLocale = Intl.NumberFormat('en-US');

                                        $('#tableadjreins33 tbody').prepend('<tr id="detailcobslipid'+ajdreinsdatalistjson[i].id+'" data-name="detailcobslipidvalue[]">'
                                        +'<td>'+ajdreinsdatalistjson[i].counter_number+'</td>'
                                        +'<td>'+ajdreinsdatalistjson[i].reins_id2+'</td>'
                                        +'<td>'+ajdreinsdatalistjson[i].date_prod+'</td>'
                                        +'<td>'+ajdreinsdatalistjson[i].position+'</td>'
                                        +'<td>'+dollarUSLocale.format(ajdreinsdatalistjson[i].reinstatement)+'</td>'
                                        +'<td>'+ajdreinsdatalistjson[i].nasre_share+'</td>'
                                        +'<td>'
                                        +'<div class="btn-group" role="group">'
                                        +'<button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> (Option)</button>'
                                        +'<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">'

                                        +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="deleteadjreins(\''+ajdreinsdatalistjson[i].id+'\',\''+ajdreinsdatalistjson[i].reins_id+'\')" >Delete Calculate Reinstatement</button>'
                                        +'<a class="text-primary mr-3" data-toggle="modal"  data-lookdetailcob-id="'+ajdreinsdatalistjson[i].id+'" onclick="showdatalookdetailadjreins('+ajdreinsdatalistjson[i].id+')" data-target="#editadjreinsmodal">'
                                        +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" data-toggle="modal" data-target="#editadjreinsmodal">Edit Adj Reins</button>'
                                        +'</a>'
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
                swal("Error!", "Detail COB  Delete Error", "Delete Error");
            }
        });

}
</script>



<script type="text/javascript">
function storeadjreinssubmit()
{
    var layerid = $('#layeradjreinsid33').val();
    var detailcob = $('#detailcobadjreins333').val();
    var reinsid = $('#detailadjreinsid33').val();
    var counternumber = $('#counternumberadjreins333').val();
    var dateprod = $('#adjreinsproddate333').val();
    var reinsnumber = $('#adjreins333').val();
    var reinstatement = $('#adjreinstatement333').val();
    var nasreshare = $('#adjreinsnasreshare333').val();
    var typedata = $('#typeadjreins333').val();
    var position = $('#adjreinsposition333').val();
    var transferdate = $('#transferdateadjreins333').val();
    var username = $('#usernameadjreins333').val();
  
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

 
    $.ajax({
        url:"{{url('treaty/nonprop/mindep/storeadjusmentreins')}}",
        type:"POST",
        data:{
            layerid:layerid,
            detailcob:detailcob,
            counternumber:counternumber,
            reinsid:reinsid,
            reinsnumber:reinsnumber,
            dateprod:dateprod,
            reinstatement:reinstatement,
            nasreshare:nasreshare,
            position:position,
            transferdate:transferdate,
            username:username,
            typedata:typedata
        },
          beforeSend: function() { $("body").addClass("loading");  },
          complete: function() {  $("body").removeClass("loading"); },
          success:function(response)
          {
              swal("Success!", "Cob Detail Insert Success", "success")

              if(response.success==true)
              {
                let dollarUSLocale = Intl.NumberFormat('en-US');

                 $('#tableadjreins33 tbody').prepend('<tr id="detailcobslipid'+response.id+'" data-name="detailcobslipidvalue[]">'
                 +'<td>'+counternumber+'</td>'
                 +'<td>'+reinsnumber+'</td>'
                 +'<td>'+dateprod+'</td>'
                 +'<td>'+position+'</td>'
                 +'<td>'+dollarUSLocale.format(reinstatement)+'</td>'
                 +'<td>'+dollarUSLocale.format(nasreshare)+'</td>'
                 +'<td>'
                 +'<div class="btn-group" role="group">'
                 +'<button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> (Option)</button>'
                 +'<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">'

                 +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="deleteadjreins(\''+response.id+'\',\''+reinsid+'\')" >Delete Calculate Reinstatement</button>'
                 +'<a class="text-primary mr-3" data-toggle="modal"  data-lookdetailcob-id="'+response.id+'" onclick="showdatalookdetailadjreins('+response.id+')" data-target="#editadjreinsmodal">'
                 +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" data-toggle="modal" data-target="#editadjreinsmodal">Edit Adj Reins</button>'
                 +'</a>'
                 +'</div>'
                 +'</div>'

                 +'</td>'
                 +'</tr>');    
                 //+'<td>'+response.mindepcobdetail.mindep_amount+'</td>'
                 
              }

              $('#adjreinsproddate333').val("");
              //$('#adjreinstatement333').val("");
              $('#adjreinsnasreshare333').val("");

           },
           error: function (request, status, error) 
           {
               //alert(request.responseText);
               swal("Error!", "Cob Detail Insert Error", "Insert Error");
           }
       });


       console.log('sudah insert');

       $.ajax({
            url:"{{url('treaty/nonprop/getgroupreinstatementdata/')}}/"+reinsid,
            type:"GET",
            data:{
                reinsid:reinsid,
            },
            beforeSend: function() { $("body").addClass("loading");  },
            complete: function() {  $("body").removeClass("loading"); },
            success:function(response)
            {
                  swal("Success!", "Group COb Detail Insert Success", "success")
                  $('#tableadjreins33 tbody').empty();
                  
                  if(response.success==true)
                  {
                       ajdreinsdatalistjson=JSON.parse(response.ajdreinsdatalist);

                        for(var i = 0; i < ajdreinsdatalistjson.length; i++)
                        { 

                            let dollarUSLocale = Intl.NumberFormat('en-US');

                            $('#tableadjreins33 tbody').prepend('<tr id="detailcobslipid'+ajdreinsdatalistjson[i].id+'" data-name="detailcobslipidvalue[]">'
                            +'<td>'+ajdreinsdatalistjson[i].counter_number+'</td>'
                            +'<td>'+ajdreinsdatalistjson[i].reins_id2+'</td>'
                            +'<td>'+ajdreinsdatalistjson[i].date_prod+'</td>'
                            +'<td>'+ajdreinsdatalistjson[i].position+'</td>'
                            +'<td>'+dollarUSLocale.format(ajdreinsdatalistjson[i].reinstatement)+'</td>'
                            +'<td>'+ajdreinsdatalistjson[i].nasre_share+'</td>'
                            +'<td>'
                            +'<div class="btn-group" role="group">'
                            +'<button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> (Option)</button>'
                            +'<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">'

                            +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="deleteadjreins(\''+ajdreinsdatalistjson[i].id+'\',\''+ajdreinsdatalistjson[i].reins_id+'\')" >Delete Calculate Reinstatement</button>'
                            +'<a class="text-primary mr-3" data-toggle="modal"  data-lookdetailcob-id="'+ajdreinsdatalistjson[i].id+'" onclick="showdatalookdetailadjreins('+ajdreinsdatalistjson[i].id+')" data-target="#editadjreinsmodal">'
                            +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" data-toggle="modal" data-target="#editadjreinsmodal">Edit Adj Reins</button>'
                            +'</a>'
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

       var dlareff=$('#dlareff33').val();
        var limit=$('#limitlayeradjreins33').val();
        var nasreloss= $('#lossnasre33').val();

        var hasiltotaladjreins=(dlareff/limit)*nasreloss;
        $('#adjreinstatement333').val(hasiltotaladjreins);

}
</script>



<script type="text/javascript">
    function showdatalookdetailadjreins(adjreinsid)
    {
        //alert(submasterid);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
        url:"{{url('treaty/nonprop/getdetailadjreinsid/')}}/"+adjreinsid,
        type:"GET",
        data:{
            adjreinsid:adjreinsid,
        },
          beforeSend: function() { $("body").addClass("loading");  },
          complete: function() {  $("body").removeClass("loading"); },
          success:function(response)
          {
                  swal("Success!", "Reinsattement Load  Success", "success")
                  if(response.success==true)
                  {
                    
                    $("#detailadjreinsidupdate33").val(adjreinsid);
                    $("#detailreinsidupdate33").val(response.ajdreinsdatalist.reins_id);
                    $("#adjreinsupdate333").val(response.ajdreinsdatalist.reins_id2);
                    $("#adjreinspositionupdate333").val(response.ajdreinsdatalist.position);
                    
                    if($("#typeadjreinsupdate333 option[value="+response.ajdreinsdatalist.type +"]:first"))
                    {
                     $("#typeadjreinsupdate333 option[value="+response.ajdreinsdatalist.type +"]:first")[0].selected = true;
                    }

                    $("#counternumberadjreinsupdate333").val(response.ajdreinsdatalist.counter_number);
                    $("#adjreinsproddateupdate333").val(response.ajdreinsdatalist.date_prod);
                    $("#adjreinstatementupdate333").val(response.ajdreinsdatalist.reinstatement);
                    $("#adjreinsnasreshareupdate333").val(response.ajdreinsdatalist.nasre_share);
                    
                  }
           },
           error: function (request, status, error) 
           {
               //alert(request.responseText);
               swal("Error!", "Group Cob Contracct Insert Error", "Insert Error");
           }
       });
    }

    $('#editadjreinsmodal').on('show.bs.modal', function(e) 
    {        
        //var submasterid = '';
        //submatserid=$(e.relatedTarget).data('looksubmaster');
    });
</script>



<script type="text/javascript">
function updateadjreinssubmit()
{
    var layerid = $('#layeradjreinsid33').val();
    var detailcob = $('#detailcobadjreins333').val();
    var reinsid = $('#detailreinsidupdate33').val();
    var adjreinsid = $('#detailadjreinsidupdate33').val();
    var counternumber = $('#counternumberadjreinsupdate333').val();
    var dateprod = $('#adjreinsproddateupdate333').val();
    var reinsnumber = $('#adjreinsupdate333').val();
    var reinstatement = $('#adjreinstatementupdate333').val();
    var nasreshare = $('#adjreinsnasreshareupdate333').val();
    var position = $('#adjreinspositionupdate333').val();
    var transferdate = $('#transferdateadjreinsupdate333').val();
    var username = $('#usernameadjreinsupdate333').val();
    var typedata = $('#typeadjreinsupdate333').val();
  
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

 
    $.ajax({
        url:"{{url('treaty/nonprop/mindep/storeadjusmentreins')}}",
        type:"POST",
        data:{
            layerid:layerid,
            detailcob:detailcob,
            counternumber:counternumber,
            reinsid:reinsid,
            reinsnumber:reinsnumber,
            dateprod:dateprod,
            reinstatement:reinstatement,
            nasreshare:nasreshare,
            position:position,
            transferdate:transferdate,
            username:username,
            typedata:typedata
        },
          beforeSend: function() { $("body").addClass("loading");  },
          complete: function() {  $("body").removeClass("loading"); },
          success:function(response)
          {
              swal("Success!", "Cob Detail Insert Success", "success")

              if(response.success==true)
              {
                let dollarUSLocale = Intl.NumberFormat('en-US');

                 $('#tableadjreins33 tbody').prepend('<tr id="detailcobslipid'+response.id+'" data-name="detailcobslipidvalue[]">'
                 +'<td>'+counternumber+'</td>'
                 +'<td>'+reinsnumber+'</td>'
                 +'<td>'+dateprod+'</td>'
                 +'<td>'+position+'</td>'
                 +'<td>'+dollarUSLocale.format(reinstatement)+'</td>'
                 +'<td>'+dollarUSLocale.format(nasreshare)+'</td>'
                 +'<td>'
                 +'<div class="btn-group" role="group">'
                 +'<button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> (Option)</button>'
                 +'<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">'

                 +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="deleteadjreins(\''+response.id+'\',\''+reinsid+'\')" >Delete Calculate Reinstatement</button>'
                 +'<a class="text-primary mr-3" data-toggle="modal"  data-lookdetailcob-id="'+response.id+'" onclick="showdatalookdetailadjreins('+response.id+')" data-target="#editadjreinsmodal">'
                 +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" data-toggle="modal" data-target="#editadjreinsmodal">Edit Adj Reins</button>'
                 +'</a>'
                 +'</div>'
                 +'</div>'

                 +'</td>'
                 +'</tr>');    
                 //+'<td>'+response.mindepcobdetail.mindep_amount+'</td>'
                 
              }

              $('#adjreinsproddate333').val("");
              $('#adjreinstatement333').val("");
              $('#adjreinsnasreshare333').val("");

           },
           error: function (request, status, error) 
           {
               //alert(request.responseText);
               swal("Error!", "Cob Detail Insert Error", "Insert Error");
           }
       });


       console.log('sudah insert');

       $.ajax({
            url:"{{url('treaty/nonprop/getgroupreinstatementdata/')}}/"+reinsid,
            type:"GET",
            data:{
                reinsid:reinsid,
            },
            beforeSend: function() { $("body").addClass("loading");  },
            complete: function() {  $("body").removeClass("loading"); },
            success:function(response)
            {
                  swal("Success!", "Group COb Detail Insert Success", "success")
                  $('#tableadjreins33 tbody').empty();
                  
                  if(response.success==true)
                  {
                       ajdreinsdatalistjson=JSON.parse(response.ajdreinsdatalist);

                        for(var i = 0; i < ajdreinsdatalistjson.length; i++)
                        { 

                            let dollarUSLocale = Intl.NumberFormat('en-US');

                            $('#tableadjreins33 tbody').prepend('<tr id="detailcobslipid'+ajdreinsdatalistjson[i].id+'" data-name="detailcobslipidvalue[]">'
                            +'<td>'+ajdreinsdatalistjson[i].counter_number+'</td>'
                            +'<td>'+ajdreinsdatalistjson[i].reins_id2+'</td>'
                            +'<td>'+ajdreinsdatalistjson[i].date_prod+'</td>'
                            +'<td>'+ajdreinsdatalistjson[i].position+'</td>'
                            +'<td>'+dollarUSLocale.format(ajdreinsdatalistjson[i].reinstatement)+'</td>'
                            +'<td>'+ajdreinsdatalistjson[i].nasre_share+'</td>'
                            +'<td>'
                            +'<div class="btn-group" role="group">'
                            +'<button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> (Option)</button>'
                            +'<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">'

                            +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="deleteadjreins(\''+ajdreinsdatalistjson[i].id+'\',\''+ajdreinsdatalistjson[i].reins_id+'\')" >Delete Calculate Reinstatement</button>'
                            +'<a class="text-primary mr-3" data-toggle="modal"  data-lookdetailcob-id="'+ajdreinsdatalistjson[i].id+'" onclick="showdatalookdetailadjreins('+ajdreinsdatalistjson[i].id+')" data-target="#editadjreinsmodal">'
                            +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" data-toggle="modal" data-target="#editadjreinsmodal">Edit Adj Reins</button>'
                            +'</a>'
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

       var dlareff=$('#dlareff33').val();
        var limit=$('#limitlayeradjreins33').val();
        var nasreloss= $('#lossnasre33').val();

        var hasiltotaladjreins=(dlareff/limit)*nasreloss;
        $('#adjreinstatement333').val(hasiltotaladjreins);

}
</script>



<script type="text/javascript">
    function showdatalookadjreinstatement(reinsid)
    {
        $.ajaxSetup({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
            url:"{{url('treaty/nonprop/mindep/getgroupreinstatement')}}",
            type:"POST",
            data:{
                reinsid:reinsid
            },
            beforeSend: function() { $("body").addClass("loading");  },
            complete: function() {  $("body").removeClass("loading"); },
            success:function(response)
            {
                    if(response.success==true)
                    {
                        console.log(response.mastercontract);
                        $("#masteridadjreins33").val(response.mastercontract.number);
                        $('#masterdateentryadjreins33').val(response.mastercontract.date_entry);
                        $('#mastercedingadjreins33').val(response.mastercontract.ceding_name);
                        $('#masteruseradjreins33').val(response.mastercontract.user_name);
                        $('#masteruwyearadjreins33').val(response.mastercontract.uwyear);
                        $('#mastercedingtypeadjreins33').val(response.mastercontract.ceding_type);

                        console.log(response.subcontract);
                        $('#submasteridadjreins33').val(response.subcontract.number_subcontract);
                        $('#submastercedingadjreins33').val(response.subcontract.ceding_name);

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
                        
                        $('#submasterperiodadjreins33').val(newdatefrom);
                        $('#submasterperiodadjreins332').val(newdateto);

                        $('#adjreinsposition333').val(newdateto);
                        $('#adjreinspositionupdate333').val(newdateto);

                        $('#submastertypeadjreins33').val(response.subcontract.subcontract_type);

                        console.log(response.groucob);
                        $('#idgroupcobadjreins33').val(response.groucob.numbercob);
                        $('#groucobadjreins33').val(response.groucob.cob_name);
                        $('#groupcoborgpiadjreins33').val(response.groucob.ogrpi);
                        $('#groupcobtypeadjreins33').val(response.groucob.treaty_type);
                        $('#groupcobbrokerageadjreins33').val(response.groucob.brokerage_value);
                        $('#groupcobbrokeragepersenadjreins33').val(response.groucob.brokerage_persentage);

                        console.log(response.layerdata);
                        $('#layeradjreinsid33').val(response.layerdata.id);
                        $('#levellayeradjreins33').val(response.layerdata.layer_level);
                        $('#premratelayeradjreins33').val(response.layerdata.prem_rate);
                        $('#uwretlayeradjreins33').val(response.layerdata.uw_retention);
                        $('#mindeplayeradjreins33').val(response.layerdata.mindep_rate);
                        $('#limitlayeradjreins33').val(response.layerdata.limit_rate);
                        $('#premiumtypelayeradjreins33').val(response.layerdata.premium_type);
                        $('#reinstatementreins33').val(response.layerdata.reinstatement);
                        $('#retrosharereins33').val(response.layerdata.retro_share);
                        $('#nasreshareadjreins33').val(response.layerdata.nasre_share);
                        $('#liabilityadjreins33').val(response.layerdata.liability);
                        //$('#liabilityreins332').val(response.layerdata.liability2);
                        $('#mdpremiumadjreins33').val(response.layerdata.md_premium);
                        //$('#mdpremiumreins332').val(response.layerdata.md_premium2);
                        $('#aadlimitadjreins33').val(response.layerdata.aad_limit);
                        $('#aadedcutibleadjreins33').val(response.layerdata.aa_deductible);


                        $('#detailcobadjreins333').val(response.cobdetailmindep.id);
                        $('#detailcobadjreins33').val(response.cobdetailmindep.groupcob);
                        $('#businesssourceadjreins33').val(response.cobdetailmindep.businesssource);
                        $('#ogrpiadjreins33').val(response.cobdetailmindep.ogrpi_amount);
                        $('#businesstypeadjreins33').val(response.cobdetailmindep.businesstype);
                        $('#maximum_acceptenceadjreins33').val(response.cobdetailmindep.max_acceptance);


                        var dateprod= response.reinsmindepdata.date_prod;
                        var dtoprod=new Date(dateprod.split("/").reverse().join("-"));
                        var ddtoprod=dtoprod.getDate();
                        var mmtoprod=dtoprod.getMonth()+1;
                        var yytoprod=dtoprod.getFullYear();
                        var newdatetoprod=ddtoprod+"/"+mmtoprod+"/"+yytoprod;

                        $('#detailadjreinsid33').val(response.reinsmindepdata.id);
                        $('#reinsid33').val(response.reinsmindepdata.reins_id);
                        $('#statusdoc33').val(response.reinsmindepdata.status_doc);
                        $('#dateprod33').val(newdatetoprod);
                        $('#dlareff33').val(response.reinsmindepdata.dla_reff);
                        $('#insured33').val(response.reinsmindepdata.insured);
                        $('#currency33').val(response.reinsmindepdata.currency);
                        $('#settlement33').val(response.reinsmindepdata.settlement);
                        $('#lossnasre33').val(response.reinsmindepdata.loss_nasre);
                        $('#reinstatementrate33').val(response.reinsmindepdata.reinstatement_rate);
                        $('#day33').val(response.reinsmindepdata.reinstatement_day);
                        $('#dayof33').val(response.reinsmindepdata.reinstatement_of);
                        $('#reinstatementpremium33').val(response.reinsmindepdata.reinstatement_premiun);
                        $('#reinsnasreshare33').val(response.reinsmindepdata.nasre_share);
                        //alert(response.reinsmindepdata.nasre_share);

                        var adjustmentdata=1;
                        if(response.adjustmentdata)
                        {
                            adjustmentdata=parseFloat(response.adjustmentdata.adjusment);
                            $('#adjustementreins33').val(response.adjustmentdata.adjusment);
                        }
                        else 
                        {
                            adjustmentdata=1;
                        }

                        var limit=parseInt(response.layerdata.limit_rate);
                        var nasreloss=parseFloat(response.reinsmindepdata.loss_nasre);

                        var hasiltotaladjreins=(adjustmentdata/limit)*nasreloss;
                        $('#adjreinstatement333').val(hasiltotaladjreins);

                        var nasreshare=parseFloat(response.layerdata.nasre_share);
                          
                        var hasilnationalshare2=(hasiltotaladjreins*nasreshare)/100
                        $("#adjreinsnasreshare333").val(hasilnationalshare2);
                        

                    }

            },
            error: function (request, status, error) 
            {
                //alert(request.responseText);
                swal("Error!", "Group Cob/Layer get Data Error", "get Data Error");
            }
        });


        $("#group_detailadjreins_card").show();
        $("#group_detailreins_card").hide();
    }
</script>
