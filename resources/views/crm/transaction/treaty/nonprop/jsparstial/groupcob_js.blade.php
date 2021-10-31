<script type='text/javascript'>
function showgroupcob(submasterid) 
{
    //alert(submasterid);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

 
    $.ajax({
      url:"{{url('treaty/nonprop/mindep/getsubcontract')}}",
      type:"POST",
      data:{
          submasterid:submasterid
      },
        beforeSend: function() { $("body").addClass("loading");  },
        complete: function() {  $("body").removeClass("loading"); },
        success:function(response)
        {
            //swal("Success!", "Sub Master Contracct Insert Success", "success")

            if(response.success==true)
            {
                console.log(response.mastercontract);
                $("#masterid3").val(response.mastercontract.number);
                $('#masterdateentry3').val(response.mastercontract.date_entry);
                //$('#masterceding3').val(mastercedingtext);
                $('#masterceding3').val(response.mastercontract.ceding_name);
                $('#masteruser3').val(response.mastercontract.user_name);
                $('#masteruwyear3').val(response.mastercontract.uwyear);
                $('#mastercedingtype3').val(response.mastercontract.ceding_type);


                console.log(response.subcontract);
                $('#submasterid3').val(response.subcontract.number_subcontract);
                $('#submasterceding3').val(response.subcontract.ceding_name);
                
                
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
                
                $('#submasterperiod3').val(newdatefrom);

                $('#submasterperiod32').val(newdateto);

                $('#submastertype3').val(response.subcontract.subcontract_type);

                $('#groupcobid').val(response.code_groupcob);


                
                $("#group_cob_card").show();
                $("#sub_master_card").hide();
            }

        },
          error: function (request, status, error) 
          {
              //alert(request.responseText);
              swal("Error!", "Sub Master Contracct get Data Error", "get Data Error");
          }
      });




      $.ajax({
        url:"{{url('treaty/nonprop/getgroupcobbyid/')}}/"+submasterid,
        type:"GET",
        data:{
            submasterid:submasterid,
        },
          beforeSend: function() { $("body").addClass("loading");  },
          complete: function() {  $("body").removeClass("loading"); },
          success:function(response)
          {
                  swal("Success!", "Group COb Insert Success", "success")
                  $('#groupcobPanel tbody').empty();
                  
                  if(response.success==true)
                  {
                        groucobjson=JSON.parse(response.groupcobdataget);

                        for(var i = 0; i < groucobjson.length; i++)
                        {
                            let dollarUSLocale = Intl.NumberFormat('en-US');

                            $('#groupcobPanel tbody').prepend('<tr id="groupcobslipid'+groucobjson[i].id+'" data-name="slipvalue[]">'
                            +'<td data-name="'+groucobjson[i].numbercob+'">'+groucobjson[i].numbercob+'</td>'
                            +'<td data-name="'+groucobjson[i].cob_name+'">'+groucobjson[i].cob_name+'</td>'
                            +'<td data-name="'+groucobjson[i].treaty_type+'">'+groucobjson[i].treaty_type+'</td>'
                            +'<td>'+dollarUSLocale.format(groucobjson[i].ogrpi)+'</td>'
                            +'<td>'+dollarUSLocale.format(groucobjson[i].brokerage_value)+'</td>'
                            +'<td>'+dollarUSLocale.format(groucobjson[i].brokerage_persentage)+'</td>'
                            +'<td><div class="row"></div>'
                            
                            +'<div class="btn-group" role="group">'
                            +'<button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> (Option)</button>'
                            +'<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">'

                            +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="deletegroupcob(\''+groucobjson[i].id+'\',\''+submasterid+'\')" >Delete Group COB</button>'
                            +'<a class="text-primary mr-3" data-toggle="modal"  data-lookgroupcob-id="'+groucobjson[i].id+'"  onclick="showdatalookgroupcob('+groucobjson[i].id+')"  data-target="#editgroupcobmodal">'
                            +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" data-toggle="modal" data-target="#editgroupcobmodal">Edit Group COB</button>'
                            +'</a>'

                            +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="showgrouplayer(\''+groucobjson[i].numbercob+'\')" >Add Layer</button>'
                            +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="showgroupretro(\''+groucobjson[i].numbercob+'\')" >Add Retro</button>'
                            +'</div>'
                            +'</div>'
                            // +'<button type="button" id="claim-endorse" class="btn btn-sm btn-warning float-right">Claim</button>'
                            +'</div></td></tr>');    
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
   
}


function storegroupcobsubmit() 
{
    var masterid = $('#masterid3').val();
    var submasterid = $('#submasterid3').val();
    var groupcobid = $('#groupcobid').val();
    var groupcobselecttext = $("#groupcobselect option:selected" ).text();
    var groupcobselect = $('#groupcobselect').val();
    var groupcobogrpi = $('#groupcobogrpi').val();
    var groupcobtype = $('#groupcobtype').val();
    var groupcobbrokerage = $('#groupcobbrokerage').val();
    var groupcobbrokeragepersen = $('#groupcobbrokeragepersen').val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

 
    $.ajax({
        url:"{{url('treaty/nonprop/mindep/storegroupcob')}}",
        type:"POST",
        data:{
            masterid:masterid,
            submasterid:submasterid,
            groupcobid:groupcobid,
            groupcobselecttext:groupcobselecttext,
            groupcobselect:groupcobselect,
            groupcobogrpi:groupcobogrpi,
            groupcobtype:groupcobtype,
            groupcobbrokerage:groupcobbrokerage,
            groupcobbrokeragepersen:groupcobbrokeragepersen
        },
          beforeSend: function() { $("body").addClass("loading");  },
          complete: function() {  $("body").removeClass("loading"); },
          success:function(response)
          {
              swal("Success!", "Group COb Insert Success", "success")

              if(response.success==true)
              {
                  let dollarUSLocale = Intl.NumberFormat('en-US');

                  $('#groupcobPanel tbody').prepend('<tr id="groupcobslipid'+groupcobid+'" data-name="slipvalue[]">'
                  +'<td data-name="'+groupcobid+'">'+groupcobid+'</td>'
                  +'<td data-name="'+groupcobselect+'">'+groupcobselecttext+'</td>'
                  +'<td data-name="'+groupcobtype+'">'+groupcobtype+'</td>'
                  +'<td>'+dollarUSLocale.format(groupcobogrpi)+'</td>'
                  +'<td>'+dollarUSLocale.format(groupcobbrokerage)+'</td>'
                  +'<td>'+dollarUSLocale.format(groupcobbrokeragepersen)+'</td>'
                  +'<td><div class="row"></div>'

                  +'<div class="btn-group" role="group">'
                  +'<button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> (Option)</button>'
                  +'<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">'

                  +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="deletegroupcob(\''+groupcobid+'\',\''+submasterid+'\')" >Delete Group COB</button>'
                  +'<a class="text-primary mr-3" data-toggle="modal"  data-lookgroupcob-id="'+response.id+'"  onclick="showdatalookgroupcob('+response.id+')"  data-target="#editgroupcobmodal">'
                  +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" data-toggle="modal" data-target="#editgroupcobmodal">Edit Group COB</button>'
                  +'</a>'

                    
                  +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="showgrouplayer(\''+groupcobid+'\')" >Add Layer</button>'
                  +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="showgroupretro(\''+groupcobid+'\')" >Add Retro</button>'
                 // +'<button type="button" id="claim-endorse" class="btn btn-sm btn-warning float-right">Claim</button>'
                 +'</div>'
                 +'</div>'

                  +'</div></td></tr>');    
              }
            
              $('#groupcobogrpi').val("");
              $('#groupcobtype').val("");
              $('#groupcobbrokerage').val("");
              $('#groupcobbrokeragepersen').val("");


           },
           error: function (request, status, error) 
           {
               //alert(request.responseText);
               swal("Error!", "Group Cob Contracct Insert Error", "Insert Error");
           }
       });

       console.log('sudah insert');
}

</script>




<script type="text/javascript">
function deletegroupcob(groupcobid,submasterid)
{

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url:"{{url('treaty/nonprop/deletegroupcob/')}}/"+groupcobid,
            type:"GET",
            data:{
                groupcobid:groupcobid,
            },
            beforeSend: function() { $("body").addClass("loading");  },
            complete: function() {  $("body").removeClass("loading"); },
            success:function(response)
            {
                swal("Success!", "Group COB Delete Success", "success")


                $.ajax({
                    url:"{{url('treaty/nonprop/getgroupcobbyid/')}}/"+submasterid,
                    type:"GET",
                    data:{
                        submasterid:submasterid,
                    },
                    beforeSend: function() { $("body").addClass("loading");  },
                    complete: function() {  $("body").removeClass("loading"); },
                    success:function(response)
                    {
                            swal("Success!", "Group COb Insert Success", "success")
                            $('#groupcobPanel tbody').empty();
                            
                            if(response.success==true)
                            {
                                    groucobjson=JSON.parse(response.groupcobdataget);

                                    for(var i = 0; i < groucobjson.length; i++)
                                    {
                                          let dollarUSLocale = Intl.NumberFormat('en-US');
                                        $('#groupcobPanel tbody').prepend('<tr id="groupcobslipid'+groucobjson[i].id+'" data-name="slipvalue[]">'
                                        +'<td data-name="'+groucobjson[i].numbercob+'">'+groucobjson[i].numbercob+'</td>'
                                        +'<td data-name="'+groucobjson[i].cob_name+'">'+groucobjson[i].cob_name+'</td>'
                                        +'<td data-name="'+groucobjson[i].treaty_type+'">'+groucobjson[i].treaty_type+'</td>'
                                        +'<td>'+dollarUSLocale.format(groucobjson[i].ogrpi)+'</td>'
                                        +'<td>'+dollarUSLocale.format(groucobjson[i].brokerage_value)+'</td>'
                                        +'<td>'+dollarUSLocale.format(groucobjson[i].brokerage_persentage)+'</td>'
                                        +'<td><div class="row"></div>'
                                        +'<div class="btn-group" role="group">'
                                        +'<button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> (Option)</button>'
                                        +'<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">'

                                        
                                        +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="deletegroupcob(\''+groucobjson[i].id+'\',\''+submasterid+'\')" >Delete Group COB</button>'
                                        +'<a class="text-primary mr-3" data-toggle="modal"  data-lookgroupcob-id="'+groucobjson[i].id+'"  onclick="showdatalookgroupcob('+groucobjson[i].id+')"  data-target="#editgroupcobmodal">'
                                        +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" data-toggle="modal" data-target="#editgroupcobmodal">Edit Group COB</button>'
                                        +'</a>'

                                        +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="showgrouplayer(\''+groucobjson[i].numbercob+'\')" >Add Layer</button>'
                                        +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="showgroupretro(\''+groucobjson[i].numbercob+'\')" >Add Retro</button>'
                                        
                                        +'</div>'
                                        +'</div>'
                                        // +'<button type="button" id="claim-endorse" class="btn btn-sm btn-warning float-right">Claim</button>'
                                        +'</div></td></tr>');    
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
                swal("Error!", "Group COB  Delete Error", "Delete Error");
            }
        });


      
}
</script>



<script type="text/javascript">

    function showdatalookgroupcob(groupcobid)
    {
        //alert(submasterid);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
        url:"{{url('treaty/nonprop/getgroupcobdetailbyid/')}}/"+groupcobid,
        type:"GET",
        data:{
            groupcobid:groupcobid,
        },
          beforeSend: function() { $("body").addClass("loading");  },
          complete: function() {  $("body").removeClass("loading"); },
          success:function(response)
          {
                  swal("Success!", "Group Cob Contracct Insert Success", "success")
                  if(response.success==true)
                  {
                     $("#groupcobidupdate").val(response.groupcobdataget.numbercob);
                     $("#groupcobselectupdate option[value=" + response.groupcobdataget.cob_id + "]:first")[0].selected = true;
                     $("#groupcobogrpiupdate").val(response.groupcobdataget.ogrpi);
                     $("#groupcobtypeupdate").val(response.groupcobdataget.treaty_type);
                     $("#groupcobbrokerageupdate").val(response.groupcobdataget.brokerage_value);
                     $("#groupcobbrokeragepersenupdate").val(response.groupcobdataget.brokerage_persentage);
                     //$("input[name=submastertypeupdate][value=" + response.subcontractdata.subcontract_type + "]").attr('checked', 'checked');
                  }

           },
           error: function (request, status, error) 
           {
               //alert(request.responseText);
               swal("Error!", "Group Cob Contracct Insert Error", "Insert Error");
           }
       });

    }

    $('#editgroupcobmodal').on('show.bs.modal', function(e) 
    {        
        //var submasterid = '';
        //submatserid=$(e.relatedTarget).data('looksubmaster');
    });

</script>



<script type="text/javascript">
    function updategroupcobsubmit()
    {
        var masterid = $('#masterid3').val();
        var submasterid = $('#submasterid3').val();
        var groupcobid = $('#groupcobidupdate').val();
        var groupcobselecttext = $("#groupcobselectupdate option:selected" ).text();
        var groupcobselect = $('#groupcobselectupdate').val();
        var groupcobogrpi = $('#groupcobogrpiupdate').val();
        var groupcobtype = $('#groupcobtypeupdate').val();
        var groupcobbrokerage = $('#groupcobbrokerageupdate').val();
        var groupcobbrokeragepersen = $('#groupcobbrokeragepersenupdate').val();


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    
        $.ajax({
            url:"{{url('treaty/nonprop/mindep/storegroupcob')}}",
            type:"POST",
            data:{
                masterid:masterid,
                submasterid:submasterid,
                groupcobid:groupcobid,
                groupcobselecttext:groupcobselecttext,
                groupcobselect:groupcobselect,
                groupcobogrpi:groupcobogrpi,
                groupcobtype:groupcobtype,
                groupcobbrokerage:groupcobbrokerage,
                groupcobbrokeragepersen:groupcobbrokeragepersen
            },
            beforeSend: function() { $("body").addClass("loading");  },
            complete: function() {  $("body").removeClass("loading"); },
            success:function(response)
            {
                swal("Success!", "Group COb Insert Success", "success")

                if(response.success==true)
                {
                    let dollarUSLocale = Intl.NumberFormat('en-US');

                    $('#groupcobPanel tbody').prepend('<tr id="groupcobslipid'+groupcobid+'" data-name="slipvalue[]">'
                    +'<td data-name="'+groupcobid+'">'+groupcobid+'</td>'
                    +'<td data-name="'+groupcobselect+'">'+groupcobselecttext+'</td>'
                    +'<td data-name="'+groupcobtype+'">'+groupcobtype+'</td>'
                    +'<td>'+dollarUSLocale.format(groupcobogrpi)+'</td>'
                    +'<td>'+dollarUSLocale.format(groupcobbrokerage)+'</td>'
                    +'<td>'+dollarUSLocale.format(groupcobbrokeragepersen)+'</td>'
                    +'<td>'

                    +'<div class="btn-group" role="group">'
                    +'<button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> (Option)</button>'
                    +'<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">'

                    +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="deletegroupcob(\''+groupcobid+'\',\''+submasterid+'\')" >Delete Group COB</button>'
                    +'<a class="text-primary mr-3" data-toggle="modal"  data-lookgroupcob-id="'+response.id+'"  onclick="showdatalookgroupcob('+response.id+')"  data-target="#editgroupcobmodal">'
                    +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" data-toggle="modal" data-target="#editgroupcobmodal">Edit Group COB</button>'
                    +'</a>'

                        
                    +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="showgrouplayer(\''+groupcobid+'\')" >Add Layer</button>'
                    +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="showgroupretro(\''+groupcobid+'\')" >Add Retro</button>'
                    +'</div>'
                    +'</div>'
                    // +'<button type="button" id="claim-endorse" class="btn btn-sm btn-warning float-right">Claim</button>'
                    +'</div></td></tr>');    
                }
                
                $('#groupcobogrpiupdate').val("");
                $('#groupcobtypeupdate').val("");
                $('#groupcobbrokerageupdate').val("");
                $('#groupcobbrokeragepersenupdate').val("");


            },
            error: function (request, status, error) 
            {
                //alert(request.responseText);
                swal("Error!", "Group Cob Contracct Insert Error", "Insert Error");
            }
        });

        console.log('sudah insert');

        $.ajax({
        url:"{{url('treaty/nonprop/getgroupcobbyid/')}}/"+submasterid,
        type:"GET",
        data:{
            submasterid:submasterid,
        },
          beforeSend: function() { $("body").addClass("loading");  },
          complete: function() {  $("body").removeClass("loading"); },
          success:function(response)
          {
                  swal("Success!", "Group COb Insert Success", "success")
                  $('#groupcobPanel tbody').empty();
                  
                  if(response.success==true)
                  {
                        groucobjson=JSON.parse(response.groupcobdataget);

                        for(var i = 0; i < groucobjson.length; i++)
                        {
                            let dollarUSLocale = Intl.NumberFormat('en-US');
                            
                            $('#groupcobPanel tbody').prepend('<tr id="groupcobslipid'+groucobjson[i].id+'" data-name="slipvalue[]">'
                            +'<td data-name="'+groucobjson[i].numbercob+'">'+groucobjson[i].numbercob+'</td>'
                            +'<td data-name="'+groucobjson[i].cob_name+'">'+groucobjson[i].cob_name+'</td>'
                            +'<td data-name="'+groucobjson[i].treaty_type+'">'+groucobjson[i].treaty_type+'</td>'
                            +'<td>'+dollarUSLocale.format(groucobjson[i].ogrpi)+'</td>'
                            +'<td>'+dollarUSLocale.format(groucobjson[i].brokerage_value)+'</td>'
                            +'<td>'+dollarUSLocale.format(groucobjson[i].brokerage_persentage)+'</td>'
                            +'<td>'
                            
                            +'<div class="btn-group" role="group">'
                            +'<button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> (Option)</button>'
                            +'<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">'



                            +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="deletegroupcob(\''+groucobjson[i].id+'\',\''+submasterid+'\')" >Delete Group COB</button>'
                            +'<a class="text-primary mr-3" data-toggle="modal"  data-lookgroupcob-id="'+groucobjson[i].id+'"  onclick="showdatalookgroupcob('+groucobjson[i].id+')"  data-target="#editgroupcobmodal">'
                            +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" data-toggle="modal" data-target="#editgroupcobmodal">Edit Group COB</button>'
                            +'</a>'

                            +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="showgrouplayer(\''+groucobjson[i].numbercob+'\')" >Add Layer</button>'
                            +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="showgroupretro(\''+groucobjson[i].numbercob+'\')" >Add Retro</button>'
                            
                            +'</div>'
                            +'</div>'
                            // +'<button type="button" id="claim-endorse" class="btn btn-sm btn-warning float-right">Claim</button>'
                            +'</div></td></tr>');    
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

