
<script type='text/javascript'>

function storeretrosubmit()
{
    var groupcobid = $('#groupcobid4').val();
    var retrocontract = $('#retrocontract').val();
    var retropercent = $('#retropercent').val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

 
    $.ajax({
        url:"{{url('treaty/nonprop/mindep/storeretrocob')}}",
        type:"POST",
        data:{
            groupcobid:groupcobid,
            retrocontract:retrocontract,
            retropercent:retropercent
        },
          beforeSend: function() { $("body").addClass("loading");  },
          complete: function() {  $("body").removeClass("loading"); },
          success:function(response)
          {
              swal("Success!", "Retro Group COb Insert Success", "success")

              if(response.success==true)
              {
                  $('#retrocobPanel tbody').prepend('<tr id="retrocobslipid'+response.id+'" data-name="slipvalue[]">'
                 +'<td data-name="'+retrocontract+'">'+retrocontract+'</td>'
                 +'<td>'+retropercent+'</td>'
                 +'<td>'
                 +'<div class="btn-group" role="group">'
                 +'<button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> (Option)</button>'
                 +'<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">'


                  +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="deleteretro(\''+response.id+'\',\''+groupcobid+'\')" >Delete Retro</button>'
                  +'<a class="text-primary mr-3" data-toggle="modal"  data-lookretro-id="'+response.id+'" onclick="showdatalookgroupcob('+response.id+')" data-target="#editretromodal">'
                  +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" data-toggle="modal" data-target="#editretromodal">Edit Retro</button>'
                  +'</a>'

                  +'</div>'
                  +'</div>'
                  
                  +'</td>'
                 +'</tr>');    
              }

              $('#retrocontract').val("");
              $('#retropercent').val("");

           },
           error: function (request, status, error) 
           {
               //alert(request.responseText);
               swal("Error!", "Retro Group COB Insert Error", "Insert Error");
           }
       });

       console.log('sudah insert');

    
}

</script>




<script type='text/javascript'>

function showgroupretro(groucobid) 
{
    //alert(groucobid);
    $('#groupcobid4').val(groucobid);

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
                $("#masterid512").val(response.mastercontract.number);
                $('#masterdateentry512').val(response.mastercontract.date_entry);
                $('#masterceding512').val(response.mastercontract.ceding_name);
                $('#masterceding512').val(response.mastercontract.ceding_name);
                $('#masteruser512').val(response.mastercontract.user_name);
                $('#masteruwyear512').val(response.mastercontract.uwyear);
                $('#mastercedingtype512').val(response.mastercontract.ceding_type);

              
                console.log(response.subcontract);
                $('#submasterid512').val(response.subcontract.number_subcontract);
                $('#submasterceding512').val(response.subcontract.ceding_name);

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

                $('#submasterperiod512').val(newdatefrom);
                $('#submasterperiod5122').val(newdateto);
                
                $('#submastertype512').val(response.subcontract.subcontract_type);

                console.log(response.groucob);
                $('#idgroupcob512').val(response.groucob.numbercob);
                $('#groucob512').val(response.groucob.cob_name);
                $('#groupcoborgpi512').val(response.groucob.ogrpi);
                $('#groupcobtype512').val(response.groucob.treaty_type);
                $('#groupcobbrokerage512').val(response.groucob.brokerage_value);
                $('#groupcobbrokeragepersen512').val(response.groucob.brokerage_persentage);

            

            
            }

        },
          error: function (request, status, error) 
          {
              //alert(request.responseText);
              swal("Error!", "Group Cob/Layer get Data Error", "get Data Error");
          }
      });



      $.ajax({
        url:"{{url('treaty/nonprop/getretrobyid/')}}/"+groucobid,
        type:"GET",
        data:{
            groucobid:groucobid,
        },
          beforeSend: function() { $("body").addClass("loading");  },
          complete: function() {  $("body").removeClass("loading"); },
          success:function(response)
          {
                  swal("Success!", "Retro COB Success", "success")
                  $('#retrocobPanel tbody').empty();
                  
                  if(response.success==true)
                  {
                        retrodatajson=JSON.parse(response.retrodata);

                        for(var i = 0; i < retrodatajson.length; i++)
                        {

                            $('#retrocobPanel tbody').prepend('<tr id="retrocobslipid'+retrodatajson[i].id+'" data-name="slipvalue[]">'
                            +'<td data-name="'+retrodatajson[i].retrocontract+'">'+retrodatajson[i].retrocontract+'</td>'
                            +'<td>'+retrodatajson[i].retropercent+'</td>'
                            +'<td>'

                            +'<div class="btn-group" role="group">'
                            +'<button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> (Option)</button>'
                            +'<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">'



                            +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="deleteretro(\''+retrodatajson[i].id+'\',\''+groucobid+'\')" >Delete Retro</button>'
                            +'<a class="text-primary mr-3" data-toggle="modal"  data-lookretro-id="'+retrodatajson[i].id+'" onclick="showdatalookgroupcob('+retrodatajson[i].id+')" data-target="#editretromodal">'
                            +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" data-toggle="modal" data-target="#editretromodal">Edit Retro</button>'
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


    console.log('sudah get');

    $("#group_retro_card").show();
    $("#group_cob_card").hide();
}



function prevgroupcobretro() 
{
    //alert(groucobid);
    $("#group_retro_card").hide();
    $("#group_cob_card").show();
}
</script>



<script type="text/javascript">
function deleteretro(retroid,groupcobid)
{

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url:"{{url('treaty/nonprop/deleteretro/')}}/"+retroid,
            type:"GET",
            data:{
                retroid:retroid,
            },
            beforeSend: function() { $("body").addClass("loading");  },
            complete: function() {  $("body").removeClass("loading"); },
            success:function(response)
            {
                swal("Success!",  "Retro Delete Success", "success")
                $.ajax({
                    url:"{{url('treaty/nonprop/getretrobyid/')}}/"+groucobid,
                    type:"GET",
                    data:{
                        groucobid:groucobid,
                    },
                    beforeSend: function() { $("body").addClass("loading");  },
                    complete: function() {  $("body").removeClass("loading"); },
                    success:function(response)
                    {
                            swal("Success!", "Retro COB Success", "success")
                            $('#retrocobPanel tbody').empty();
                            
                            if(response.success==true)
                            {
                                    retrodatajson=JSON.parse(response.retrodata);

                                    for(var i = 0; i < retrodatajson.length; i++)
                                    {

                                        $('#retrocobPanel tbody').prepend('<tr id="retrocobslipid'+retrodatajson[i].id+'" data-name="slipvalue[]">'
                                        +'<td data-name="'+retrodatajson[i].retrocontract+'">'+retrodatajson[i].retrocontract+'</td>'
                                        +'<td>'+retrodatajson[i].retropercent+'</td>'
                                        +'<td>'

                                        +'<div class="btn-group" role="group">'
                                        +'<button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> (Option)</button>'
                                        +'<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">'

                                        +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="deleteretro(\''+retrodatajson[i].id+'\',\''+groucobid+'\')" >Delete Retro</button>'
                                        +'<a class="text-primary mr-3" data-toggle="modal"  data-lookretro-id="'+retrodatajson[i].id+'" onclick="showdatalookgroupcob('+retrodatajson[i].id+')" data-target="#editretromodal">'
                                        +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" data-toggle="modal" data-target="#editretromodal">Edit Retro</button>'
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
                swal("Error!", "Retro  Delete Error", "Delete Error");
            }
        });


}
</script>



<script type="text/javascript">
    function showdatalookretro(retroid)
    {
        //alert(submasterid);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
        url:"{{url('treaty/nonprop/getretrodetailbyid/')}}/"+retroid,
        type:"GET",
        data:{
            retroid:retroid,
        },
          beforeSend: function() { $("body").addClass("loading");  },
          complete: function() {  $("body").removeClass("loading"); },
          success:function(response)
          {
                  swal("Success!", "Group Cob Contracct Insert Success", "success")
                  if(response.success==true)
                  {
                    $("#retroidupdate43").val(retroid); 
                    $("#retrocontractupdate option[value=" + response.retrodata.retrocontract + "]:first")[0].selected = true;
                    $("#retropercentupdate").val(response.retrodata.retropercent);
                    $("#groupcobidupdate4").val(response.retrodata.cob_name);
                  
                  }
           },
           error: function (request, status, error) 
           {
               //alert(request.responseText);
               swal("Error!", "Group Cob Contracct Insert Error", "Insert Error");
           }
       });

    }

    $('#editretromodal').on('show.bs.modal', function(e) 
    {        
        //var submasterid = '';
        //submatserid=$(e.relatedTarget).data('looksubmaster');
    });

</script>




<script type="text/javascript">
    function updateretrosubmit()
    {
        var retrocobid = $('#retroidupdate43').val();
        var groupcobid = $('#groupcobidupdate4').val();
        var retrocontract = $('#retrocontractupdate').val();
        var retropercent = $('#retropercentupdate').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

 
        $.ajax({
            url:"{{url('treaty/nonprop/mindep/storeretrocob')}}",
            type:"POST",
            data:{
                retrocobid:retrocobid,
                groupcobid:groupcobid,
                retrocontract:retrocontract,
                retropercent:retropercent
            },
            beforeSend: function() { $("body").addClass("loading");  },
            complete: function() {  $("body").removeClass("loading"); },
            success:function(response)
            {
                swal("Success!", "Retro Group COb Insert Success", "success")

                if(response.success==true)
                {
                    $('#retrocobPanel tbody').prepend('<tr id="retrocobslipid'+response.id+'" data-name="slipvalue[]">'
                    +'<td data-name="'+retrocontract+'">'+retrocontract+'</td>'
                    +'<td>'+retropercent+'</td>'
                    +'<td>'
                    
                    +'<div class="btn-group" role="group">'
                    +'<button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> (Option)</button>'
                    +'<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">'


                    +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="deleteretro(\''+response.id+'\',\''+groupcobid+'\')" >Delete Retro</button>'
                    +'<a class="text-primary mr-3" data-toggle="modal"  data-lookretro-id="'+response.id+'" onclick="showdatalookgroupcob('+response.id+')" data-target="#editretromodal">'
                    +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" data-toggle="modal" data-target="#editretromodal">Edit Retro</button>'
                    +'</a>'

                    +'</div>'
                    +'</div>'

                    +'</td>'
                    +'</tr>');    
                }

                $('#retrocontract').val("");
                $('#retropercent').val("");

            },
            error: function (request, status, error) 
            {
                //alert(request.responseText);
                swal("Error!", "Retro Group COB Insert Error", "Insert Error");
            }
        });

        console.log('sudah insert');

        $.ajax({
        url:"{{url('treaty/nonprop/getretrobyid/')}}/"+groupcobid,
        type:"GET",
        data:{
            groupcobid:groupcobid,
        },
          beforeSend: function() { $("body").addClass("loading");  },
          complete: function() {  $("body").removeClass("loading"); },
          success:function(response)
          {
                  swal("Success!", "Retro COB Success", "success")
                  $('#retrocobPanel tbody').empty();
                  
                  if(response.success==true)
                  {
                        retrodatajson=JSON.parse(response.retrodata);

                        for(var i = 0; i < retrodatajson.length; i++)
                        {

                            $('#retrocobPanel tbody').prepend('<tr id="retrocobslipid'+retrodatajson[i].id+'" data-name="slipvalue[]">'
                            +'<td data-name="'+retrodatajson[i].retrocontract+'">'+retrodatajson[i].retrocontract+'</td>'
                            +'<td>'+retrodatajson[i].retropercent+'</td>'
                            +'<td>'
                            +'<div class="btn-group" role="group">'
                            +'<button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> (Option)</button>'
                            +'<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">'

                            +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="deleteretro(\''+retrodatajson[i].id+'\',\''+groucobid+'\')" >Delete Retro</button>'
                            +'<a class="text-primary mr-3" data-toggle="modal"  data-lookretro-id="'+retrodatajson[i].id+'" onclick="showdatalookgroupcob('+retrodatajson[i].id+')" data-target="#editretromodal">'
                            +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" data-toggle="modal" data-target="#editretromodal">Edit Retro</button>'
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