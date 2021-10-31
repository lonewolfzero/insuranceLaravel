
<script type='text/javascript'>
    function parseDate(str) 
    {
      var mdy = str.split('/');
      return new Date(mdy[2], mdy[0]-1, mdy[1]);
    }

    function datediff(first, second) {
        // Take the difference between the dates and divide by milliseconds per day.
        // Round to nearest whole number to deal with DST.
        return Math.round((second-first)/(1000*60*60*24));
    }
</script>



<script type='text/javascript'>
function prevmastercontract() 
{
  $("#master_card").show();
  $("#sub_master_card").hide();
}

function prevsubmastercontract() 
{
  $("#sub_master_card").show();
  $("#group_cob_card").hide();
}
</script>


<script type="text/javascript">
    //triggered when modal is about to be shown
    $('#addreinstmodal').on('show.bs.modal', function(e) 
    {

        //var layerid = $(e.relatedTarget).data('looklayer-id');
        var numbergroupid = $('#groupcobidlayer').val();
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        

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

    });


    $('#addreinstmodal2').on('show.bs.modal', function(e) 
    {

        //var layerid = $(e.relatedTarget).data('looklayer-id');
        var numbergroupid = $('#groupcobidlayer').val();
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
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
                    $('#reinstatementable332 tbody').empty();
                    
                    if(response.success==true)
                    {
                            reinstatementdatalistjson=JSON.parse(response.reinstatementdatalist);

                            for(var i = 0; i < reinstatementdatalistjson.length; i++)
                            {  

                                $('#reinstatementable332 tbody').prepend('<tr id="instatementdetailslipid'+reinstatementdatalistjson[i].id+'" data-name="instatementdetailslipidvalue[]">'
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

    });



    $('#addreinstmodal3').on('show.bs.modal', function(e) 
    {

        //var layerid = $(e.relatedTarget).data('looklayer-id');
        var numbergroupid = $('#groupcobidlayer').val();
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
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
                    $('#reinstatementable333 tbody').empty();
                    
                    if(response.success==true)
                    {
                            reinstatementdatalistjson=JSON.parse(response.reinstatementdatalist);

                            for(var i = 0; i < reinstatementdatalistjson.length; i++)
                            {  

                                $('#reinstatementable333 tbody').prepend('<tr id="instatementdetailslipid'+reinstatementdatalistjson[i].id+'" data-name="instatementdetailslipidvalue[]">'
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

    });

</script>


@include('crm.transaction.treaty.nonprop.jsparstial.detailcob_js')
@include('crm.transaction.treaty.nonprop.jsparstial.submaster_js')
@include('crm.transaction.treaty.nonprop.jsparstial.groupcob_js')
@include('crm.transaction.treaty.nonprop.jsparstial.layer_js')
@include('crm.transaction.treaty.nonprop.jsparstial.installment_js')
@include('crm.transaction.treaty.nonprop.jsparstial.reinstatement_js')
@include('crm.transaction.treaty.nonprop.jsparstial.retro_js')
@include('crm.transaction.treaty.nonprop.jsparstial.adjinstallment_js')
@include('crm.transaction.treaty.nonprop.jsparstial.reins_js')
@include('crm.transaction.treaty.nonprop.jsparstial.adjreins_js')


