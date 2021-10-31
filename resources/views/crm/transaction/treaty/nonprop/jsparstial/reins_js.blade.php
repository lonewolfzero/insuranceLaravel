<script type="text/javascript">
$('#dateprodreins333').change(function(e)
{
 
  var perioddate=$("#submasterperiodreins332").val();
  var proddate=$("#dateprodreins333").val();
  //var datedate=datediff(parseDate(proddate), parseDate(perioddate));

  var date = proddate;
  date = new Date(date.split('/')[2],date.split('/')[1]-1,date.split('/')[0]);
  var date2 = perioddate;
  date2 = new Date(date2.split('/')[2],date2.split('/')[1]-1,date2.split('/')[0]);
  var timeDiff = Math.abs(date2.getTime() - date.getTime());
  var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 
  var datedate=diffDays;

  $("#reinstatementday333").val(datedate);
  $("#reinstatementof333").val(datedate);

    var bagihari=datedate/datedate;
    
    var day=$("#reinstatementday333").val();
    var dayof=$("#reinstatementof333").val();
    var nationalreloss=$("#lossnasre333").val();
    var mindeplayer=$("#mindeplayerreins33").val();
    var limitlayer=$("#limitlayerreins33").val();

    var hasilbagi=mindeplayer/limitlayer;
    var nasreshare=$("#nasresharereins33").val();

   
    var bagihari=day/dayof;
    var hasiltotal=hasilbagi*nationalreloss*bagihari;
    $("#reinstatementpremium333").val(hasiltotal);

    var hasilnationalshare=(hasiltotal*nasreshare)/100
    $("#nasreshare333").val(hasilnationalshare);
    
});



$('#reinstatementday333').keyup(function(e)
{
  var day=$("#reinstatementday333").val();
  var dayof=$("#reinstatementof333").val();
  var nationalreloss=$("#lossnasre333").val();

  var mindeplayer=$("#mindeplayerreins33").val();
  var limitlayer=$("#limitlayerreins33").val();
  
  var hasilbagi=mindeplayer/limitlayer;
  var nasreshare=$("#nasresharereins33").val();

  
    var bagihari=day/dayof;  
    var hasiltotal=hasilbagi*nationalreloss*bagihari;
    $("#reinstatementpremium333").val(hasiltotal);

    var hasilnationalshare=(hasiltotal*nasreshare)/100
    $("#nasreshare333").val(hasilnationalshare);
     
});



$('#reinstatementof333').keyup(function(e)
{
  var day=$("#reinstatementday333").val();
  var dayof=$("#reinstatementof333").val();
  var nationalreloss=$("#lossnasre333").val();
  
  var mindeplayer=$("#mindeplayerreins33").val();
  var limitlayer=$("#limitlayerreins33").val();
  
  var hasilbagi=mindeplayer/limitlayer;
  var nasreshare=$("#nasresharereins33").val();

  
    var bagihari=day/dayof;   
    var hasiltotal=hasilbagi*nationalreloss*bagihari;
    $("#reinstatementpremium333").val(hasiltotal);

    var hasilnationalshare=(hasiltotal*nasreshare)/100
    $("#nasreshare333").val(hasilnationalshare);

});




$('#lossnasre333').keyup(function(e)
{
  
  var day=$("#reinstatementday333").val();
  var dayof=$("#reinstatementof333").val();
  var nationalreloss=$("#lossnasre333").val();
  
  var mindeplayer=$("#mindeplayerreins33").val();
  var limitlayer=$("#limitlayerreins33").val();
  
  var hasilbagi=mindeplayer/limitlayer;
  var nasreshare=$("#nasresharereins33").val();

  
  var bagihari=day/dayof;  
  var hasiltotal=(hasilbagi*nationalreloss)*bagihari;
  $("#reinstatementpremium333").val(hasiltotal);

  var hasilnationalshare=(hasiltotal*nasreshare)/100
  $("#nasreshare333").val(hasilnationalshare);
    
});



$('#reinstatementpremium333').keyup(function(e)
{
     var day=$("#reinstatementday333").val();
     var dayof=$("#reinstatementof333").val();

     var bagihari=day/dayof; 
     var nasreshare=$("#nasresharereins33").val();  
     var hasiltotal=$("#reinstatementpremium333").val();
     //$("reinstatementpremium333").val(hasiltotal);

     var hasilnationalshare=(hasiltotal*nasreshare)/100
     $("#nasreshare333").val(hasilnationalshare);
});



$('#dateprodupdate333').change(function(e)
{
 
  var perioddate=$("#submasterperiodreins332").val();
  var proddate=$("#dateprodupdate333").val();
  //var datedate=datediff(parseDate(proddate), parseDate(perioddate));

  var date = proddate;
  date = new Date(date.split('/')[2],date.split('/')[1]-1,date.split('/')[0]);
  var date2 = perioddate;
  date2 = new Date(date2.split('/')[2],date2.split('/')[1]-1,date2.split('/')[0]);
  var timeDiff = Math.abs(date2.getTime() - date.getTime());
  var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 
  var datedate=diffDays;

  $("#reinstatementdayupdate333").val(datedate);
  $("#reinstatementofupdate333").val(datedate);

    var bagihari=datedate/datedate;
    
    var day=$("#reinstatementdayupdate333").val();
    var dayof=$("#reinstatementofupdate333").val();
    var nationalreloss=$("#lossnasreupdate333").val();
    var mindeplayer=$("#mindeplayerreins33").val();
    var limitlayer=$("#limitlayerreins33").val();

    
    var hasilbagi=mindeplayer/limitlayer;
    var nasreshare=$("#nasresharereins33").val();

   
    var bagihari=day/dayof;
    var hasiltotal=(hasilbagi*nationalreloss)*bagihari;
    $("#reinstatementpremiumupdate333").val(hasiltotal);

    var hasilnationalshare=(hasiltotal*nasreshare)/100
    $("#nasreshareupdate333").val(hasilnationalshare);
    
});



$('#reinstatementdayupdate333').keyup(function(e)
{
    var day=$("#reinstatementdayupdate333").val();
    var dayof=$("#reinstatementofupdate333").val();
    var nationalreloss=$("#lossnasreupdate333").val();
    var mindeplayer=$("#mindeplayerreins33").val();
    var limitlayer=$("#limitlayerreins33").val();

    
    var hasilbagi=mindeplayer/limitlayer;
    var nasreshare=$("#nasresharereins33").val();


    var bagihari=day/dayof;
    var hasiltotal=hasilbagi*nationalreloss*bagihari;
    $("#reinstatementpremiumupdate333").val(hasiltotal);

    var hasilnationalshare=(hasiltotal*nasreshare)/100
    $("#nasreshareupdate333").val(hasilnationalshare);

});



$('#reinstatementofupdate333').keyup(function(e)
{
    var day=$("#reinstatementdayupdate333").val();
    var dayof=$("#reinstatementofupdate333").val();
    var nationalreloss=$("#lossnasreupdate333").val();
    var mindeplayer=$("#mindeplayerreins33").val();
    var limitlayer=$("#limitlayerreins33").val();

    
    var hasilbagi=mindeplayer/limitlayer;
    var nasreshare=$("#nasresharereins33").val();


    
    var bagihari=day/dayof;
    var hasiltotal=hasilbagi*nationalreloss*bagihari;
    $("#reinstatementpremiumupdate333").val(hasiltotal);

    var hasilnationalshare=(hasiltotal*nasreshare)/100
    $("#nasreshareupdate333").val(hasilnationalshare);

});



$('#lossnasreupdate333').keyup(function(e)
{
    var day=$("#reinstatementdayupdate333").val();
    var dayof=$("#reinstatementofupdate333").val();
    var nationalreloss=$("#lossnasreupdate333").val();
    var mindeplayer=$("#mindeplayerreins33").val();
    var limitlayer=$("#limitlayerreins33").val();

    var hasilbagi=mindeplayer/limitlayer;
    var nasreshare=$("#nasresharereins33").val();

    
    
    var bagihari=day/dayof;
    var hasiltotal=hasilbagi*nationalreloss*bagihari;
    $("#reinstatementpremiumupdate333").val(hasiltotal);

    var hasilnationalshare=(hasiltotal*nasreshare)/100
    $("#nasreshareupdate333").val(hasilnationalshare);
    
});



$('#reinstatementpremiumupdate333').keyup(function(e)
{

    var day=$("#reinstatementdayupdate333").val();
    var dayof=$("#reinstatementofupdate333").val();

    var bagihari=day/dayof;
    var hasiltotal=hasilbagi*nationalreloss*bagihari;
    $("#reinstatementpremiumupdate333").val(hasiltotal);

    var hasilnationalshare=(hasiltotal*nasreshare)/100
    $("#nasreshareupdate333").val(hasilnationalshare);
});


function deletereins(reinsid,detailcob)
{
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url:"{{url('treaty/nonprop/deletereins/')}}/"+reinsid,
            type:"GET",
            data:{
                reinsid:reinsid,
            },
            beforeSend: function() { $("body").addClass("loading");  },
            complete: function() {  $("body").removeClass("loading"); },
            success:function(response)
            {
                swal("Success!",  "Detail Reins Delete Success", "success")
               // var detailcob=$("#groupcobid43").val();
                        $.ajax({
                        url:"{{url('treaty/nonprop/mindep/getgroupdetailcob')}}",
                        type:"POST",
                        data:{
                            groucobdetailid:detailcob,
                        },
                        beforeSend: function() { $("body").addClass("loading");  },
                        complete: function() {  $("body").removeClass("loading"); },
                        success:function(response)
                        {
                            swal("Success!", "Group COb Detail Insert Success", "success")
                            $('#tablereins33 tbody').empty();
                            
                            if(response.success==true)
                            {
                                    reinsdatalistjson=JSON.parse(response.reinsdatalist);

                                    for(var i = 0; i < reinsdatalistjson.length; i++)
                                    {

                                        let dollarUSLocale = Intl.NumberFormat('en-US');

                                        $('#tablereins33 tbody').prepend('<tr id="detailcobslipid'+reinsdatalistjson[i].id+'" data-name="detailcobslipidvalue[]">'
                                        +'<td>'+reinsdatalistjson[i].counter_number+'</td>'
                                        +'<td>'+reinsdatalistjson[i].reins_id+'</td>'
                                        +'<td>'+reinsdatalistjson[i].status_doc+'</td>'
                                        +'<td>'+reinsdatalistjson[i].date_prod+'</td>'
                                        +'<td>'+reinsdatalistjson[i].dla_reff+'</td>'
                                        +'<td>'+reinsdatalistjson[i].insured+'</td>'
                                        +'<td>'+reinsdatalistjson[i].currency+'</td>'
                                        +'<td>'+dollarUSLocale.format(reinsdatalistjson[i].settlement)+'</td>'
                                        +'<td>'+dollarUSLocale.format(reinsdatalistjson[i].loss_nasre)+'</td>'
                                        +'<td>'+reinsdatalistjson[i].reinstatement_rate+'</td>'
                                        +'<td>'+dollarUSLocale.format(reinsdatalistjson[i].reinstatement_premiun)+'</td>'
                                        +'<td>'+reinsdatalistjson[i].nasre_share+'</td>'
                                        +'<td>'
                                        +'<div class="btn-group" role="group">'
                                        +'<button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> (Option)</button>'
                                        +'<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">'

                                        +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="showdatalookadjreinstatement('+reinsdatalistjson[i].id+')" >Adjustment Calculate Reinstatement</button>'
                                        +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="deletereins(\''+reinsdatalistjson[i].id+'\',\''+reinsdatalistjson[i].detailcob_id+'\')" >Delete Calculate Reinstatement</button>'
                                        +'<a class="text-primary mr-3" data-toggle="modal"  data-lookdetailcob-id="'+reinsdatalistjson[i].id+'" onclick="showdatalookdetailreins('+reinsdatalistjson[i].id+')" data-target="#editreinsmodal">'
                                        +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" data-toggle="modal" data-target="#editreinsmodal">Edit Reins</button>'
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
    function showdatalookreinstatement(groucobdetailid)
    {
            $.ajaxSetup({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
            url:"{{url('treaty/nonprop/mindep/getgroupdetailcob')}}",
            type:"POST",
            data:{
                groucobdetailid:groucobdetailid
            },
            beforeSend: function() { $("body").addClass("loading");  },
            complete: function() {  $("body").removeClass("loading"); },
            success:function(response)
            {
                if(response.success==true)
                {
                        console.log(response.mastercontract);
                        $("#masteridreins33").val(response.mastercontract.number);
                        $('#masterdateentryreins33').val(response.mastercontract.date_entry);
                        $('#mastercedingreins33').val(response.mastercontract.ceding_name);
                        $('#masteruserreins33').val(response.mastercontract.user_name);
                        $('#masteruwyearreins33').val(response.mastercontract.uwyear);
                        $('#mastercedingtypereins33').val(response.mastercontract.ceding_type);

                        console.log(response.subcontract);
                        $('#submasteridreins33').val(response.subcontract.number_subcontract);
                        $('#submastercedingreins33').val(response.subcontract.ceding_name);

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
                        
                        $('#submasterperiodreins33').val(newdatefrom);
                        $('#submasterperiodreins332').val(newdateto);


                        console.log(response.groucob);
                        $('#idgroupcobreins33').val(response.groucob.numbercob);
                        $('#groucobreins33').val(response.groucob.cob_name);
                        $('#groupcoborgpireins33').val(response.groucob.ogrpi);
                        $('#groupcobtypereins33').val(response.groucob.treaty_type);
                        $('#groupcobbrokeragereins33').val(response.groucob.brokerage_value);
                        $('#groupcobbrokeragepersenreins33').val(response.groucob.brokerage_persentage);

                        console.log(response.layerdata);
                        $('#layeridreins33').val(response.layerdata.id);
                        $('#layerid333').val(response.layerdata.id);
                        $('#levellayerreins33').val(response.layerdata.layer_level);
                        $('#premratelayerreins33').val(response.layerdata.prem_rate);
                        $('#uwretlayerreins33').val(response.layerdata.uw_retention);
                        $('#mindeplayerreins33').val(response.layerdata.mindep_rate);
                        $('#limitlayerreins33').val(response.layerdata.limit_rate);
                        $('#premiumtypelayerreins33').val(response.layerdata.premium_type);
                        $('#reinstatementreins33').val(response.layerdata.reinstatement);
                        $('#retrosharereins33').val(response.layerdata.retro_share);
                        $('#nasresharereins33').val(response.layerdata.nasre_share);
                        $('#liabilityreins33').val(response.layerdata.liability);
                        $('#liabilityreins332').val(response.layerdata.liability2);
                        $('#mdpremiumreins33').val(response.layerdata.md_premium);
                        $('#mdpremiumreins332').val(response.layerdata.md_premium2);
                        $('#aadlimitreins33').val(response.layerdata.aad_limit);
                        $('#aadedcutiblereins33').val(response.layerdata.aa_deductible);


                        $('#detailcobidreins33').val(response.cobdetailmindep.id);
                        $('#detailcobreins33').val(response.cobdetailmindep.groupcob);
                        $('#businesssourcereins33').val(response.cobdetailmindep.businesssource);
                        $('#ogrpireins33').val(response.cobdetailmindep.ogrpi_amount);
                        $('#businesstypereins33').val(response.cobdetailmindep.businesstype);
                        $('#maximum_acceptencereins33').val(response.cobdetailmindep.max_acceptance);

                        var perioddate=$("#submasterperiodreins332").val();
                        var proddate=perioddate;
                        //var datedate=datediff(parseDate(proddate), parseDate(perioddate));

                        var date = proddate;
                        date = new Date(date.split('/')[2],date.split('/')[1]-1,date.split('/')[0]);
                        var date2 = perioddate;
                        date2 = new Date(date2.split('/')[2],date2.split('/')[1]-1,date2.split('/')[0]);
                        var timeDiff = Math.abs(date2.getTime() - date.getTime());
                        var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 
                        var datedate=diffDays;

                        $("#reinstatementday333").val(datedate);
                        $("#reinstatementof333").val(datedate);
                        
                        var detailcob=response.cobdetailmindep.id;

                            $.ajax({
                                url:"{{url('treaty/nonprop/mindep/getgroupdetailcob')}}",
                                type:"POST",
                                data:{
                                    groucobdetailid:groucobdetailid,
                                },
                                beforeSend: function() { $("body").addClass("loading");  },
                                complete: function() {  $("body").removeClass("loading"); },
                                success:function(response)
                                {
                                    swal("Success!", "Group COb Detail Insert Success", "success")
                                    $('#tablereins33 tbody').empty();
                                    
                                    if(response.success==true)
                                    {
                                            reinsdatalistjson=JSON.parse(response.reinsdatalist);

                                            for(var i = 0; i < reinsdatalistjson.length; i++)
                                            {

                                                let dollarUSLocale = Intl.NumberFormat('en-US');

                                                $('#tablereins33 tbody').prepend('<tr id="detailcobslipid'+reinsdatalistjson[i].id+'" data-name="detailcobslipidvalue[]">'
                                                +'<td>'+reinsdatalistjson[i].counter_number+'</td>'
                                                +'<td>'+reinsdatalistjson[i].reins_id+'</td>'
                                                +'<td>'+reinsdatalistjson[i].status_doc+'</td>'
                                                +'<td>'+reinsdatalistjson[i].date_prod+'</td>'
                                                +'<td>'+reinsdatalistjson[i].dla_reff+'</td>'
                                                +'<td>'+reinsdatalistjson[i].insured+'</td>'
                                                +'<td>'+reinsdatalistjson[i].currency+'</td>'
                                                +'<td>'+dollarUSLocale.format(reinsdatalistjson[i].settlement)+'</td>'
                                                +'<td>'+dollarUSLocale.format(reinsdatalistjson[i].loss_nasre)+'</td>'
                                                +'<td>'+reinsdatalistjson[i].reinstatement_rate+'</td>'
                                                +'<td>'+dollarUSLocale.format(reinsdatalistjson[i].reinstatement_premiun)+'</td>'
                                                +'<td>'+reinsdatalistjson[i].nasre_share+'</td>'
                                                +'<td>'
                                                +'<div class="btn-group" role="group">'
                                                +'<button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> (Option)</button>'
                                                +'<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">'

                                                +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="showdatalookadjreinstatement('+reinsdatalistjson[i].id+')" >Adjustment Calculate Reinstatement</button>'
                                                +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="deletereins(\''+reinsdatalistjson[i].id+'\',\''+reinsdatalistjson[i].detailcob_id+'\')" >Delete Calculate Reinstatement</button>'
                                                +'<a class="text-primary mr-3" data-toggle="modal"  data-lookdetailcob-id="'+reinsdatalistjson[i].id+'" onclick="showdatalookdetailreins('+reinsdatalistjson[i].id+')" data-target="#editreinsmodal">'
                                                +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" data-toggle="modal" data-target="#editreinsmodal">Edit Reins</button>'
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
                    
                    }

                },
                error: function (request, status, error) 
                {
                    //alert(request.responseText);
                    swal("Error!", "Group Cob/Layer get Data Error", "get Data Error");
                }
            });



         $("#group_detailreins_card").show();
         $("#group_detailcob_card").hide();
         
    }
</script>


<script type="text/javascript">
    function prevdatalookreinstatement(detailcobid)
    {
        $("#group_detailreins_card").hide();
        $("#group_detailcob_card").show();
    }
</script>




<script type="text/javascript">
function prevdatalookadjreinstatement(adjreinstatementid)
{
    $("#group_detailadjreins_card").hide();
    $("#group_detailreins_card").show();
}
</script>


<script type="text/javascript">
function clickchoiceregcompsubmit()
{
    var datachoice=$("#claimchoice").val();
   
    $.ajax({
    url:"{{url('treaty/nonprop/mindep/getclaimregcompdetail')}}/"+datachoice,
    type:"GET",
    data:{
        searchregcomp:datachoice,
    },
    beforeSend: function() { $("body").addClass("loading");  },
    complete: function() {  $("body").removeClass("loading"); },
    success:function(response)
    {
        swal("Success!", "Reinsattement Load  Success", "success")
        if(response.success==true)
        {
            var date= response.regcompclaimdata.date_of_loss;
            var d=new Date(date.split("/").reverse().join("-"));
            var dd=d.getDate();
            var mm=d.getMonth()+1;
            var yy=d.getFullYear();
            var newdatefrom=dd+"/"+mm+"/"+yy;

           $("#datelossreins333").val(newdatefrom);
           $("#dlareff333").val(response.regcompclaimdata.doc_number);
           $("#insured333").val(response.regcompclaimdata.insured_id);

           if($("#currencyupdate333 option[value="+response.regcompclaimdata.curr_id_loss+"]:first")[0])
           {
                $("#currencyupdate333 option[value="+response.regcompclaimdata.curr_id_loss+"]:first")[0].selected = true;
           }

           $("#lossnasre333").val(response.regcompclaimdata.total_loss_amount);
        }
    },
    error: function (request, status, error) 
    {
        //alert(request.responseText);
        swal("Error!", "Master Contracct Insert Error", "Insert Error");
    }
});
}

function clicksearchregcompsubmit()
{
    var searchregcomp = $('#regcomp33').val();

    $.ajax({
    url:"{{url('treaty/nonprop/mindep/getclaimregcomp')}}/"+searchregcomp,
    type:"GET",
    data:{
        searchregcomp:searchregcomp,
    },
    beforeSend: function() { $("body").addClass("loading");  },
    complete: function() {  $("body").removeClass("loading"); },
    success:function(response)
    {
            swal("Success!", "Group COb Detail Insert Success", "success")
            $('#tableclaimreins33 tbody').empty();
            
            if(response.success==true)
            {
                regcompclaimdatajson=JSON.parse(response.regcompclaimdata);

                for(var i = 0; i < regcompclaimdatajson.length; i++)
                {

                    let dollarUSLocale = Intl.NumberFormat('en-US');

                    $('#tableclaimreins33 tbody').prepend('<tr id="detailreinsclaimid'+regcompclaimdatajson[i].id+'" data-name="detailreinsclaimidvalue[]">'
                    +'<td>'+regcompclaimdatajson[i].reg_comp+'</td>'
                    +'<td>'+regcompclaimdatajson[i].docpladla+'/'+regcompclaimdatajson[i].doc_number+'</td>'
                    +'<td>'+regcompclaimdatajson[i].date_of_loss+'</td>'
                    +'<td>'+regcompclaimdatajson[i].insured_id+'</td>'
                    +'<td>'+regcompclaimdatajson[i].curr_lossdesc+'</td>'
                    +'<td>'+regcompclaimdatajson[i].total_loss_amount+'</td>'
                    +'<td>'
                    +'<input type="radio" id="claimchoice" name="claimchoice" value="'+regcompclaimdatajson[i].reg_comp+'">'
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
function storereinssubmit()
{
    var layerid = $('#layerid333').val();
    var detailcob = $('#detailcobidreins33').val();
    var claimid = $('#claimid33').val();
    var counternumber = $('#counternumberreins333').val();
    var reinsid = $('#reinsid333').val();
    var statusdoc = $('#statusdoc333').val();
    var dateprod = $('#dateprodreins333').val();
    var dlareff = $('#dlareff333').val();
    var dateloss = $('#datelossreins333').val();
    var insured = $('#insured333').val();
    var currency = $('#currency333').val();
    var currencytext =$("#currency333 option:selected").text();
    var settlement = $('#settlement333').val();
    var lossnasre = $('#lossnasre333').val();
    var reinstatementrate = $('#reinstatementrate333').val();
    var reinstatementday = $('#reinstatementday333').val();
    var reinstatementof = $('#reinstatementof333').val();
    var reinstatementpremium = $('#reinstatementpremium333').val();
    var nasreshare = $('#nasreshare333').val();
    var username = $('#usernamereins333').val();
    var transferdate = $('#transferdatereins333').val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

 
    $.ajax({
        url:"{{url('treaty/nonprop/mindep/storereins')}}",
        type:"POST",
        data:{
            layerid:layerid,
            detailcob:detailcob,
            claimid:claimid,
            counternumber:counternumber,
            reinsid:reinsid,
            statusdoc:statusdoc,
            dateprod:dateprod,
            dlareff:dlareff,
            dateloss:dateloss,
            insured:insured,
            currency:currency,
            settlement:settlement,
            currencytext:currencytext,
            lossnasre:lossnasre,
            reinstatementrate:reinstatementrate,
            reinstatementday:reinstatementday,
            reinstatementof:reinstatementof,
            reinstatementpremium:reinstatementpremium,
            nasreshare:nasreshare,
            username:username,
            transferdate:transferdate
        },
          beforeSend: function() { $("body").addClass("loading");  },
          complete: function() {  $("body").removeClass("loading"); },
          success:function(response)
          {
              swal("Success!", "Cob Detail Insert Success", "success")

              if(response.success==true)
              {
                let dollarUSLocale = Intl.NumberFormat('en-US');

                 $('#tablereins33 tbody').prepend('<tr id="detailcobslipid'+response.id+'" data-name="detailcobslipidvalue[]">'
                 +'<td>'+counternumber+'</td>'
                 +'<td>'+reinsid+'</td>'
                 +'<td>'+statusdoc+'</td>'
                 +'<td>'+dateprod+'</td>'
                 +'<td>'+dlareff+'</td>'
                 +'<td>'+insured+'</td>'
                 +'<td>'+currencytext+'</td>'
                 +'<td>'+dollarUSLocale.format(settlement)+'</td>'
                 +'<td>'+dollarUSLocale.format(lossnasre)+'</td>'
                 +'<td>'+reinstatementrate+'</td>'
                 +'<td>'+dollarUSLocale.format(reinstatementpremium)+'</td>'
                 +'<td>'+nasreshare+'</td>'
                 +'<td>'
                 +'<div class="btn-group" role="group">'
                 +'<button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> (Option)</button>'
                 +'<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">'

                 +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="showdatalookadjreinstatement('+response.id+')" >Adjustment Calculate Reinstatement</button>'
                 +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="deletereins(\''+response.id+'\',\''+detailcob+'\')" >Delete Calculate Reinstatement</button>'
                 +'<a class="text-primary mr-3" data-toggle="modal"  data-lookdetailcob-id="'+response.id+'" onclick="showdatalookdetailreins('+response.id+')" data-target="#editreinsmodal">'
                 +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" data-toggle="modal" data-target="#editreinsmodal">Edit Reins</button>'
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
                        url:"{{url('treaty/nonprop/mindep/getgroupdetailcob')}}",
                        type:"POST",
                        data:{
                            groucobdetailid:detailcob,
                        },
                        beforeSend: function() { $("body").addClass("loading");  },
                        complete: function() {  $("body").removeClass("loading"); },
                        success:function(response)
                        {
                            swal("Success!", "Group COb Detail Insert Success", "success")
                            $('#tablereins33 tbody').empty();
                            
                            if(response.success==true)
                            {
                                    reinsdatalistjson=JSON.parse(response.reinsdatalist);

                                    for(var i = 0; i < reinsdatalistjson.length; i++)
                                    {

                                        let dollarUSLocale = Intl.NumberFormat('en-US');

                                        $('#tablereins33 tbody').prepend('<tr id="detailcobslipid'+reinsdatalistjson[i].id+'" data-name="detailcobslipidvalue[]">'
                                        +'<td>'+reinsdatalistjson[i].counter_number+'</td>'
                                        +'<td>'+reinsdatalistjson[i].reins_id+'</td>'
                                        +'<td>'+reinsdatalistjson[i].status_doc+'</td>'
                                        +'<td>'+reinsdatalistjson[i].date_prod+'</td>'
                                        +'<td>'+reinsdatalistjson[i].dla_reff+'</td>'
                                        +'<td>'+reinsdatalistjson[i].insured+'</td>'
                                        +'<td>'+reinsdatalistjson[i].currency+'</td>'
                                        +'<td>'+dollarUSLocale.format(reinsdatalistjson[i].settlement)+'</td>'
                                        +'<td>'+dollarUSLocale.format(reinsdatalistjson[i].loss_nasre)+'</td>'
                                        +'<td>'+reinsdatalistjson[i].reinstatement_rate+'</td>'
                                        +'<td>'+dollarUSLocale.format(reinsdatalistjson[i].reinstatement_premiun)+'</td>'
                                        +'<td>'+reinsdatalistjson[i].nasre_share+'</td>'
                                        +'<td>'
                                        +'<div class="btn-group" role="group">'
                                        +'<button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> (Option)</button>'
                                        +'<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">'

                                        +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="showdatalookadjreinstatement('+reinsdatalistjson[i].id+')" >Adjustment Calculate Reinstatement</button>'
                                        +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="deletereins(\''+reinsdatalistjson[i].id+'\',\''+reinsdatalistjson[i].detailcob_id+'\')" >Delete Calculate Reinstatement</button>'
                                        +'<a class="text-primary mr-3" data-toggle="modal"  data-lookdetailcob-id="'+reinsdatalistjson[i].id+'" onclick="showdatalookdetailreins('+reinsdatalistjson[i].id+')" data-target="#editreinsmodal">'
                                        +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" data-toggle="modal" data-target="#editreinsmodal">Edit Reins</button>'
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
               swal("Error!", "Cob Detail Insert Error", "Insert Error");
           }
       });


       console.log('sudah insert');
       

       
      
       

}
</script>


<script type="text/javascript">
    function showdatalookdetailreins(reinsid)
    {
        //alert(submasterid);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
        url:"{{url('treaty/nonprop/getdetailreinsid/')}}/"+reinsid,
        type:"GET",
        data:{
            reinsid:reinsid,
        },
          beforeSend: function() { $("body").addClass("loading");  },
          complete: function() {  $("body").removeClass("loading"); },
          success:function(response)
          {
                  swal("Success!", "Reinsattement Load  Success", "success")
                  if(response.success==true)
                  {
                    
                    $("#reinsidupdate33").val(reinsid);
                    $("#layeridupdate33").val(response.reinsdatalist.layer_id);
                    $("#detailcobidupdate33").val(response.reinsdatalist.detailcob_id);
                    $("#counternumberupdate333").val(response.reinsdatalist.counter_number);
                    $("#reinsidupdate333").val(response.reinsdatalist.reins_id);
                    $("#statusdocupdate333").val(response.reinsdatalist.status_doc);
                    $("#dateprodupdate333").val(response.reinsdatalist.date_prod);
                    $("#dlareffupdate333").val(response.reinsdatalist.date_prod);
                    $("#datelossupdate333").val(response.reinsdatalist.date_prod);
                    $("#insuredupdate333").val(response.reinsdatalist.date_prod);
                    $("#settlementupdate333").val(response.reinsdatalist.date_prod);

                    if($("#currencyupdate333 option[value=" + response.reinsdatalist.currency_id + "]:first")[0])
                    {
                        $("#currencyupdate333 option[value=" + response.reinsdatalist.currency_id + "]:first")[0].selected = true;
                    }

                    $("#lossnasreupdate333").val(response.reinsdatalist.loss_nasre);
                    $("#reinstatementrateupdate333").val(response.reinsdatalist.reinstatement_rate);
                    $("#reinstatementdayupdate333").val(response.reinsdatalist.reinstatement_day);
                    $("#reinstatementofupdate333").val(response.reinsdatalist.reinstatement_of);
                    $("#reinstatementpremiumupdate333").val(response.reinsdatalist.reinstatement_premiun);
                    $("#nasreshareupdate333").val(response.reinsdatalist.nasre_share);
                   
                    
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
function updatereinssubmit()
{
    var layerid = $('#layeridupdate33').val();
    var reinsidupdate = $('#reinsidupdate33').val();
    var detailcob = $('#detailcobidupdate33').val();
    var claimid = $('#claimidupdate33').val();
    var counternumber = $('#counternumberupdate333').val();
    var reinsid = $('#reinsidupdate333').val();
    var statusdoc = $('#statusdocupdate333').val();
    var dateprod = $('#dateprodupdate333').val();
    var dlareff = $('#dlareffupdate333').val();
    var dateloss = $('#datelossupdate333').val();
    var insured = $('#insuredupdate333').val();
    var currency = $('#currencyupdate333').val();
    var currencytext =$("#currencyupdate333 option:selected").text();
    var settlement = $('#settlementupdate333').val();
    var lossnasre = $('#lossnasreupdate333').val();
    var reinstatementrate = $('#reinstatementrateupdate333').val();
    var reinstatementday = $('#reinstatementdayupdate333').val();
    var reinstatementof = $('#reinstatementofupdate333').val();
    var reinstatementpremium = $('#reinstatementpremiumupdate333').val();
    var nasreshare = $('#nasreshareupdate333').val();
    var username = $('#usernamereinsupdate333').val();
    var transferdate = $('#transferdatereinsupdate333').val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

 
    $.ajax({
        url:"{{url('treaty/nonprop/mindep/storereins')}}",
        type:"POST",
        data:{
            layerid:layerid,
            detailcob:detailcob,
            claimid:claimid,
            counternumber:counternumber,
            reinsid:reinsid,
            statusdoc:statusdoc,
            dateprod:dateprod,
            dlareff:dlareff,
            dateloss:dateloss,
            insured:insured,
            currency:currency,
            currencytext:currencytext,
            settlement:settlement,
            lossnasre:lossnasre,
            reinstatementrate:reinstatementrate,
            reinstatementday:reinstatementday,
            reinstatementof:reinstatementof,
            reinstatementpremium:reinstatementpremium,
            nasreshare:nasreshare
        },
          beforeSend: function() { $("body").addClass("loading");  },
          complete: function() {  $("body").removeClass("loading"); },
          success:function(response)
          {
              swal("Success!", "Cob Detail Insert Success", "success")

              if(response.success==true)
              {
                let dollarUSLocale = Intl.NumberFormat('en-US');

                 $('#tablereins33 tbody').prepend('<tr id="detailcobslipid'+response.id+'" data-name="detailcobslipidvalue[]">'
                 +'<td>'+counternumber+'</td>'
                 +'<td>'+reinsid+'</td>'
                 +'<td>'+statusdoc+'</td>'
                 +'<td>'+dateprod+'</td>'
                 +'<td>'+dlareff+'</td>'
                 +'<td>'+insured+'</td>'
                 +'<td>'+currencytext+'</td>'
                 +'<td>'+dollarUSLocale.format(settlement)+'</td>'
                 +'<td>'+dollarUSLocale.format(lossnasre)+'</td>'
                 +'<td>'+reinstatementrate+'</td>'
                 +'<td>'+dollarUSLocale.format(reinstatementpremium)+'</td>'
                 +'<td>'+nasreshare+'</td>'
                 +'<td>'
                 +'<div class="btn-group" role="group">'
                 +'<button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> (Option)</button>'
                 +'<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">'

                 +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="showdatalookadjreinstatement('+response.id+')" >Adjustment Calculate Reinstatement</button>'
                 +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="deletereins(\''+response.id+'\',\''+detailcob+'\')" >Delete Calculate Reinstatement</button>'
                 +'<a class="text-primary mr-3" data-toggle="modal"  data-lookdetailcob-id="'+response.id+'" onclick="showdatalookdetailreins('+response.id+')" data-target="#editreinsmodal">'
                 +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" data-toggle="modal" data-target="#editreinsmodal">Edit Reins</button>'
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
                    url:"{{url('treaty/nonprop/mindep/getgroupdetailcob')}}",
                    type:"POST",
                    data:{
                        groucobdetailid:detailcob,
                    },
                    beforeSend: function() { $("body").addClass("loading");  },
                    complete: function() {  $("body").removeClass("loading"); },
                    success:function(response)
                    {
                        swal("Success!", "Group COb Detail Insert Success", "success")
                        $('#tablereins33 tbody').empty();
                        
                        if(response.success==true)
                        {
                                reinsdatalistjson=JSON.parse(response.reinsdatalist);

                                for(var i = 0; i < reinsdatalistjson.length; i++)
                                {

                                    let dollarUSLocale = Intl.NumberFormat('en-US');

                                    $('#tablereins33 tbody').prepend('<tr id="detailcobslipid'+reinsdatalistjson[i].id+'" data-name="detailcobslipidvalue[]">'
                                    +'<td>'+reinsdatalistjson[i].counter_number+'</td>'
                                    +'<td>'+reinsdatalistjson[i].reins_id+'</td>'
                                    +'<td>'+reinsdatalistjson[i].status_doc+'</td>'
                                    +'<td>'+reinsdatalistjson[i].date_prod+'</td>'
                                    +'<td>'+reinsdatalistjson[i].dla_reff+'</td>'
                                    +'<td>'+reinsdatalistjson[i].insured+'</td>'
                                    +'<td>'+reinsdatalistjson[i].currency+'</td>'
                                    +'<td>'+dollarUSLocale.format(reinsdatalistjson[i].settlement)+'</td>'
                                    +'<td>'+dollarUSLocale.format(reinsdatalistjson[i].loss_nasre)+'</td>'
                                    +'<td>'+reinsdatalistjson[i].reinstatement_rate+'</td>'
                                    +'<td>'+dollarUSLocale.format(reinsdatalistjson[i].reinstatement_premiun)+'</td>'
                                    +'<td>'+reinsdatalistjson[i].nasre_share+'</td>'
                                    +'<td>'
                                    +'<div class="btn-group" role="group">'
                                    +'<button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> (Option)</button>'
                                    +'<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">'

                                    +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="showdatalookadjreinstatement('+reinsdatalistjson[i].id+')" >Adjustment Calculate Reinstatement</button>'
                                    +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="deletereins(\''+reinsdatalistjson[i].id+'\',\''+reinsdatalistjson[i].detailcob_id+'\')" >Delete Calculate Reinstatement</button>'
                                    +'<a class="text-primary mr-3" data-toggle="modal"  data-lookdetailcob-id="'+reinsdatalistjson[i].id+'" onclick="showdatalookdetailreins('+reinsdatalistjson[i].id+')" data-target="#editreinsmodal">'
                                    +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" data-toggle="modal" data-target="#editreinsmodal">Edit Reins</button>'
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
               swal("Error!", "Cob Detail Insert Error", "Insert Error");
           }
       });


       console.log('sudah insert');
       

}
</script>