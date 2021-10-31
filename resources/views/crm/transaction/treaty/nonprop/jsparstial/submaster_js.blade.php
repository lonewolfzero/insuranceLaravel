<script type='text/javascript'>

function storesubmastersubmit() 
{
    
    var masterid = $('#masterid2').val();
    var submasterid = $('#submasterid').val();
    var submasterceding = $('#submasterceding').val();
    var submastercedingdata =$("#submasterceding option:selected").text();
    var submasterperiod = $('#submasterperiod').val();
    var submasterto = $('#submasterto').val();
    var submastertype = $('input[name="submastertype"]:checked').val();
    //alert('masuk');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

 
    $.ajax({
        url:"{{url('treaty/nonprop/mindep/storesub')}}",
        type:"POST",
        data:{
            masterid:masterid,
            submasterid:submasterid,
            submasterceding:submasterceding,
            submasterperiod:submasterperiod,
            submasterto:submasterto,
            submastercedingname:submastercedingdata,
            submastertype:submastertype
        },
          beforeSend: function() { $("body").addClass("loading");  },
          complete: function() {  $("body").removeClass("loading"); },
          success:function(response)
          {
              swal("Success!", "Sub Master Contracct Insert Success", "success")

              if(response.success==true)
              {
                  $('#submasterPanel tbody').prepend('<tr id="sumasterslipid'+submasterid+'" data-name="slipvalue[]">'
                  +'<td data-name="'+submasterid+'">'+submasterid+'</td>'
                  +'<td data-name="'+submasterceding+'">'+submastercedingdata+'</td>'
                  +'<td data-name="'+submasterperiod+'">'+submasterperiod+' - '+submasterto+'</td>'
                  +'<td>'+submastertype+'</td>'
                  +'<td><div class="row"></div>'

                  +'<div class="btn-group" role="group">'
                  +'<button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> (Option)</button>'
                  +'<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">'

                    +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="deletesubmaster(\''+response.submindepdataup.id+'\',\''+masterid+'\')" >Delete Sub Master</button>'
                    
                    +'<a class="text-primary mr-3" data-toggle="modal"  data-looksubmaster="'+response.submindepdataup.id+'"  onclick="showdatalooksubmaster('+response.submindepdataup.id+')" data-target="#editsubmastermodal">'
                    +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" data-toggle="modal" data-target="#editsubmastermodal">Edit Sub Master</button>'
                    +'</a>'

                    +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="showgroupcob(\''+submasterid+'\')" >Add Group COB</button>'

                  
                  +'</div>'
                  +'</div>' 
                  // +'<button type="button" id="claim-endorse" class="btn btn-sm btn-warning float-right">Claim</button>'
                  +'</div></td></tr>');    
                  
                  $('#submasterid').val(response.code_sub);

                    //var submasterid = $('#submasterid').val();
                  $('#submasterperiod').val("");
                  $('#submasterto').val("");
              }
           },
           error: function (request, status, error) 
           {
               //alert(request.responseText);
               swal("Error!", "Sub Master Contracct Insert Error", "Insert Error");
           }
       });

       console.log('sudah insert');
}

</script>


<script type="text/javascript">
function deletesubmaster(submasterid,masterid)
{
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url:"{{url('treaty/nonprop/deletesubmaster/')}}/"+submasterid,
            type:"GET",
            data:{
                submasterid:submasterid,
            },
            beforeSend: function() { $("body").addClass("loading");  },
            complete: function() {  $("body").removeClass("loading"); },
            success:function(response)
            {
                swal("Success!", "Submaster Delete Success", "success")

                
                $.ajax({
                    url:"{{url('treaty/nonprop/getsubcontractbyid/')}}/"+masterid,
                    type:"GET",
                    data:{
                        masterid:masterid,
                    },
                    beforeSend: function() { $("body").addClass("loading");  },
                    complete: function() {  $("body").removeClass("loading"); },
                    success:function(response)
                    {
                            swal("Success!", "Master Contracct Insert Success", "success")
                            $('#submasterPanel tbody').empty();
                            
                            if(response.success==true)
                            {
                                    subcontarctjson=JSON.parse(response.subcontractdata);

                                    for(var i = 0; i < subcontarctjson.length; i++)
                                    {
                                        
                                        var date= subcontarctjson[i].period_from;
                                        var d=new Date(date.split("/").reverse().join("-"));
                                        var dd=d.getDate();
                                        var mm=d.getMonth()+1;
                                        var yy=d.getFullYear();
                                        var newdatefrom=dd+"/"+mm+"/"+yy;

                                        var dateto= subcontarctjson[i].period_to;
                                        var dto=new Date(dateto.split("/").reverse().join("-"));
                                        var ddto=dto.getDate();
                                        var mmto=dto.getMonth()+1;
                                        var yyto=dto.getFullYear();
                                        var newdateto=ddto+"/"+mmto+"/"+yyto;
                            
                
                                        
                                        $('#submasterPanel tbody').prepend('<tr id="sumasterslipid'+subcontarctjson[i].id+'" data-name="slipvalue[]">'
                                        +'<td data-name="'+subcontarctjson[i].number_subcontract+'">'+subcontarctjson[i].number_subcontract+'</td>'
                                        +'<td data-name="'+subcontarctjson[i].ceding_name+'">'+subcontarctjson[i].ceding_name+'</td>'
                                        +'<td data-name="'+subcontarctjson[i].period_from+'">'+newdatefrom+' - '+newdateto+'</td>'
                                        +'<td>'+subcontarctjson[i].subcontract_type+'</td>'
                                        +'<td><div class="row"></div>'
                                        
                                        +'<div class="btn-group" role="group">'
                                        +'<button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> (Option)</button>'
                                        +'<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">'

                                        +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="deletesubmaster(\''+subcontarctjson[i].id+'\',\''+masterid+'\')" >Delete Sub Master</button>'
                                        +'<a class="text-primary mr-3" data-toggle="modal"  data-looksubmaster="'+subcontarctjson[i].id+'"  onclick="showdatalooksubmaster('+subcontarctjson[i].id+')" data-target="#editsubmastermodal">'
                                        +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" data-toggle="modal" data-target="#editsubmastermodal">Edit Sub Master</button>'
                                        +'</a>'
                                        +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="showgroupcob(\''+subcontarctjson[i].number_subcontract+'\')" >Add Group COB</button>'
                                        
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
                swal("Error!", "Submaster Delete Error", "Delete Error");
            }
        });

}
</script>


<script type="text/javascript">

    function showdatalooksubmaster(submasterid)
    {
        //alert(submasterid);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
        url:"{{url('treaty/nonprop/getsubcontractdetailbyid/')}}/"+submasterid,
        type:"GET",
        data:{
            submasterid:submasterid,
        },
          beforeSend: function() { $("body").addClass("loading");  },
          complete: function() {  $("body").removeClass("loading"); },
          success:function(response)
          {
                  swal("Success!", "Sub Master Contracct Insert Success", "success")
                  if(response.success==true)
                  {

                     $("#submasteridupdate").val(response.subcontractdata.number_subcontract);
                     if($("#submastercedingupdate option[value=" + response.subcontractdata.ceding_id + "]:first")[0])
                     {
                      $("#submastercedingupdate option[value=" + response.subcontractdata.ceding_id + "]:first")[0].selected = true;
                     }
                     
                    var date= response.subcontractdata.period_from;
                    var d=new Date(date.split("/").reverse().join("-"));
                    var dd=d.getDate();
                    var mm=d.getMonth()+1;
                    var yy=d.getFullYear();
                    var newdatefrom=dd+"/"+mm+"/"+yy;

                    var dateto= response.subcontractdata.period_to;
                    var dto=new Date(dateto.split("/").reverse().join("-"));
                    var ddto=dto.getDate();
                    var mmto=dto.getMonth()+1;
                    var yyto=dto.getFullYear();
                    var newdateto=ddto+"/"+mmto+"/"+yyto;
                            

                     $("#submasterperiodupdate").val(newdatefrom);
                     $("#submastertoupdate").val(newdateto);
                     
                     $("input[name=submastertypeupdate][value=" + response.subcontractdata.subcontract_type + "]").attr('checked', 'checked');

                  }

           },
           error: function (request, status, error) 
           {
               //alert(request.responseText);
               swal("Error!", "Sub Master Contracct Insert Error", "Insert Error");
           }
       });

    }

    $('#editsubmastermodal').on('show.bs.modal', function(e) 
    {        
        //var submasterid = '';
        //submatserid=$(e.relatedTarget).data('looksubmaster');
    });

</script>



<script type="text/javascript">
    function editsubmastersubmit()
    {

        var masterid = $('#masterid2').val();
        var submasterid = $('#submasteridupdate').val();
        var submasterceding = $('#submastercedingupdate').val();
        var submastercedingdata =$("#submastercedingupdate option:selected").text();
        var submasterperiod = $('#submasterperiodupdate').val();
        var submasterto = $('#submastertoupdate').val();
        var submastertype = $('input[name="submastertypeupdate"]:checked').val();
        //alert('masuk');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    
        $.ajax({
            url:"{{url('treaty/nonprop/mindep/storesub')}}",
            type:"POST",
            data:{
                masterid:masterid,
                submasterid:submasterid,
                submasterceding:submasterceding,
                submasterperiod:submasterperiod,
                submasterto:submasterto,
                submastercedingname:submastercedingdata,
                submastertype:submastertype
            },
            beforeSend: function() { $("body").addClass("loading");  },
            complete: function() {  $("body").removeClass("loading"); },
            success:function(response)
            {
                swal("Success!", "Sub Master Contracct Insert Success", "success")

                if(response.success==true)
                {
                    $('#submasterPanel tbody').prepend('<tr id="sumasterslipid'+submasterid+'" data-name="slipvalue[]">'
                    +'<td data-name="'+submasterid+'">'+submasterid+'</td>'
                    +'<td data-name="'+submasterceding+'">'+submastercedingdata+'</td>'
                    +'<td data-name="'+submasterperiod+'">'+submasterperiod+' - '+submasterto+'</td>'
                    +'<td>'+submastertype+'</td>'
                    +'<td>'
                        +'<div class="btn-group" role="group">'
                        +'<button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> (Option)</button>'
                        +'<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">'



                        +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="deletesubmaster(\''+response.submindepdataup.id+'\',\''+masterid+'\')" >Delete Sub Master</button>'
                        
                        +'<a class="text-primary mr-3" data-toggle="modal"  data-looksubmaster="'+response.submindepdataup.id+'"  onclick="showdatalooksubmaster('+response.submindepdataup.id+')" data-target="#editsubmastermodal">'
                        +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" data-toggle="modal" data-target="#editsubmastermodal">Edit Sub Master</button>'
                        +'</a>'

                        +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="showgroupcob(\''+submasterid+'\')" >Add Group COB</button>'
                        
                        +'</div>'
                        +'</div>'
                    
                    // +'<button type="button" id="claim-endorse" class="btn btn-sm btn-warning float-right">Claim</button>'
                    +'</div></td></tr>');    
                    
                    $('#submasterid').val(response.code_sub);

                        //var submasterid = $('#submasterid').val();
                    $('#submasterperiod').val("");
                    $('#submasterto').val("");
                }
            },
            error: function (request, status, error) 
            {
                //alert(request.responseText);
                swal("Error!", "Sub Master Contracct Insert Error", "Insert Error");
            }
        });

        console.log('sudah insert');

        $.ajax({
        url:"{{url('treaty/nonprop/getsubcontractbyid/')}}/"+masterid,
        type:"GET",
        data:{
            masterid:masterid,
        },
          beforeSend: function() { $("body").addClass("loading");  },
          complete: function() {  $("body").removeClass("loading"); },
          success:function(response)
          {
                  swal("Success!", "Master Contracct Insert Success", "success")
                  $('#submasterPanel tbody').empty();
                  
                  if(response.success==true)
                  {
                        subcontarctjson=JSON.parse(response.subcontractdata);

                        for(var i = 0; i < subcontarctjson.length; i++)
                        {

                            var date= subcontarctjson[i].period_from;
                            var d=new Date(date.split("/").reverse().join("-"));
                            var dd=d.getDate();
                            var mm=d.getMonth()+1;
                            var yy=d.getFullYear();
                            var newdatefrom=dd+"/"+mm+"/"+yy;

                            var dateto= subcontarctjson[i].period_to;
                            var dto=new Date(dateto.split("/").reverse().join("-"));
                            var ddto=dto.getDate();
                            var mmto=dto.getMonth()+1;
                            var yyto=dto.getFullYear();
                            var newdateto=ddto+"/"+mmto+"/"+yyto;
                            
                            
                            $('#submasterPanel tbody').prepend('<tr id="sumasterslipid'+subcontarctjson[i].id+'" data-name="slipvalue[]">'
                            +'<td data-name="'+subcontarctjson[i].number_subcontract+'">'+subcontarctjson[i].number_subcontract+'</td>'
                            +'<td data-name="'+subcontarctjson[i].ceding_name+'">'+subcontarctjson[i].ceding_name+'</td>'
                            +'<td data-name="'+subcontarctjson[i].period_from+'">'+newdatefrom+' - '+newdateto+'</td>'
                            +'<td>'+subcontarctjson[i].subcontract_type+'</td>'
                            +'<td>'
                            
                            +'<div class="btn-group" role="group">'
                            +'<button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> (Option)</button>'
                            +'<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">'

                            +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="deletesubmaster(\''+subcontarctjson[i].id+'\',\''+masterid+'\')" >Delete Sub Master</button>'
                            
                            +'<a class="text-primary mr-3" data-toggle="modal"  data-looksubmaster="'+subcontarctjson[i].id+'" onclick="showdatalooksubmaster('+subcontarctjson[i].id+')" data-target="#editsubmastermodal">'
                            +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" data-toggle="modal" data-target="#editsubmastermodal">Edit Sub Master</button>'
                            +'</a>'
                            
                            +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="showgroupcob(\''+subcontarctjson[i].number_subcontract+'\')" >Add Group COB</button>'
                            
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