
<script type='text/javascript'>

function storereinstatementsubmit()
{
   var groupcobid = $('#groupcobid43').val();
   var layerid = $('#layerid43').val();
   var percentagereinstatement = $('#percentagereinstatement').val();
   var numberinstatement = $('#numberinstatement').val();
   //var notereinstatement = $('#notereinstatement').val();

    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
    });

    $.ajax({
    url:"{{url('treaty/nonprop/mindep/storeinstatement')}}",
    type:"POST",
    data:{
        groupcobid:groupcobid,
        layerid:layerid,
        percentagereinstatement:percentagereinstatement,
        numberinstatement:numberinstatement
    },
    beforeSend: function() { $("body").addClass("loading");  },
    complete: function() {  $("body").removeClass("loading"); },
    success:function(response)
    {
          swal("Success!", "Store Instatement Insert Success", "success")

          if(response.success==true)
          {
              $('#reinstatementable33 tbody').prepend('<tr id="instatementdetailslipid'+response.id+'" data-name="instatementdetailslipidvalue[]">'
             +'<td data-name="'+response.id+'">'+response.id+'</td>'
             +'<td>'+numberinstatement+'</td>'
             +'<td>'+percentagereinstatement+'</td>'
             +'<td>'
             
             +'<div class="btn-group" role="group">'
             +'<button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> (Option)</button>'
             +'<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">'

             +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="deleteinstatement(\''+response.id+'\',\''+groupcobid+'\')" >Delete Installment</button>'
             +'</div>'
             +'</div>'

             +'</td>'
             +'</tr>');    
          }

       },
       error: function (request, status, error) 
       {
           //alert(request.responseText);
           swal("Error!", "Store Instatement Insert Error", "Insert Error");
       }
   });

   console.log('sudah insert');

}

</script>


<script type="text/javascript">
function deleteinstatement(reinstatetmentid,detailcob)
{

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url:"{{url('treaty/nonprop/deletereinstatement/')}}/"+reinstatetmentid,
            type:"GET",
            data:{
                reinstatetmentid:reinstatetmentid,
            },
            beforeSend: function() { $("body").addClass("loading");  },
            complete: function() {  $("body").removeClass("loading"); },
            success:function(response)
            {
                swal("Success!",  "Reinstatement Delete Success", "success")

                $.ajax({
                        url:"{{url('treaty/nonprop/getreinstatementbyid/')}}/"+numbergroupid,
                        type:"GET",
                        data:{
                            numbergroupid:numbergroupid,
                        },
                        beforeSend: function() { $("body").addClass("loading");  },
                        complete: function() {  $("body").removeClass("loading"); },
                        success:function(response)
                        {
                                swal("Success!", "Group Installment Detail Insert Success", "success")
                                $('#reinstatementable33 tbody').empty();
                                
                                if(response.success==true)
                                {
                                        reinstatementdatalistjson=JSON.parse(response.reinstatementdatalist);

                                        for(var i = 0; i < reinstatementdatalistjson.length; i++)
                                        {  

                                            $('#reinstatementable33 tbody').prepend('<tr id="instatementdetailslipid'+reinstatementdatalistjson[i].id+'" data-name="instatementdetailslipidvalue[]">'
                                                +'<td data-name="'+reinstatementdatalistjson[i].id+'">'+reinstatementdatalistjson[i].id+'</td>'
                                                +'<td>'+reinstatementdatalistjson[i].reinstatement_number+'</td>'
                                                +'<td>'+reinstatementdatalistjson[i].percentage_reinstatement+'</td>'
                                                +'<td>'

                                                +'<div class="btn-group" role="group">'
                                                +'<button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> (Option)</button>'
                                                +'<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">'

                                                +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="deleteinstatement(\''+reinstatementdatalistjson[i].id+'\',\''+numbergroupid+'\')" >Delete Installment</button>'
                                                
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
                swal("Error!", "Reinstatement  Delete Error", "Delete Error");
            }
        });



}
</script>
