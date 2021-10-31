<script type="text/javascript">
    var CSRF_TOKEN = $('meta[name="_token2"]').attr('content');

    $(document).ready(function() { 
           
            var currency_exc = $('#mccurrency').val();
            if(currency_exc){
                $.ajax({
                    type:"GET",
                    url:"{{url('get-kurs-detail')}}?currency_id="+currency_exc,
                    beforeSend: function() { $("body").addClass("loading");  },
                    complete: function() {  $("body").removeClass("loading"); },
                    success:function(res){  
                        console.log(res)
                        console.log('kurs ' + res.kurs)      
                        $('#mckurs').val(res.kurs);
                    }
                });
            }

            
            var sign = "<?php echo($sign) ?>";
            console.log('tanda ' + sign)

            if(sign == "insert"){
                clear_all();
            }
            
    });
</script>

<script>
    $( "#autocomplete" ).autocomplete({
      source: [
      @foreach (@$customer as $costumerdata)
       "{{@$costumerdata->company_name }}",
      @endforeach
      ]
    });
    </script>
    
<script>
    $( "#autocomplete2" ).autocomplete({
        source: [
        @foreach (@$customer as $costumerdata)
        "{{@$costumerdata->company_name }}",
        @endforeach
        ]
    });
</script>

<script type="text/javascript">
    $('#mcroute').change(function(){
       var routeship = $(this).val();

        console.log(routeship);
       if(routeship){
           $.ajax({
               type:"GET",
               dataType: 'json',
               url:"{{url('get-route-list')}}?route_code="+routeship,
               success:function(response){        
                   if(response){
                       $("#mcroutefrom").val(response.route_from);
                       $("#mcrouteto").val(response.route_to);
                   }else{
                       $("#mcroutefrom").empty();
                       $("#mcrouteto").empty();
                   }
               }
           });
       }else{
           $("#mcroutefrom").empty();
           $("#mcrouteto").empty();
       }
   });
</script>

<script type="text/javascript">
    $('#mccurrency').change(function(){
        var currency_exc = $(this).val();

        $.ajax({
                    type:"GET",
                    url:"{{url('get-kurs-detail')}}?currency_id="+currency_exc,
                    beforeSend: function() { $("body").addClass("loading");  },
                    complete: function() {  $("body").removeClass("loading"); },
                    success:function(res){  
                        console.log(res)
                        console.log('kurs ' + res.kurs)      
                        $('#mckurs').val(res.kurs);
                    }
                });
    });
</script>

<script type="text/javascript">
    function convert(a){
        var nilai = a.toString().replace(/\B(?=(\d{3})+(?!\d)+\.)/g,",");
        return nilai;

    }
    $('#mcpercent').keyup(function(e){
         var keyCode = e.keyCode || e.which;
        if(keyCode != 9){
            var percentceding = parseFloat($(this).val()) / 100 ;
            var valtsi = $('#mcshareto').val();

            if(valtsi != null){
                var tsi = $('#mcshareto').val();
                var conv_tsi = parseInt(tsi.replace(/,/g, ""));

                var sum_amount = isNaN(percentceding * conv_tsi) ? 0 :(percentceding * conv_tsi).toFixed(2);
                var real_sum = sum_amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('#mcamount').val(convert(sum_amount));
            }
            else
            {
                swal('warning!','please fill TSI insured first','error')
            }
        }
        else{
            var percentceding = parseFloat($(this).val()) / 100 ;
            var valtsi = $('#mcshareto').val();

            if(valtsi != null){
                var tsi = $('#mcshareto').val();
                var conv_tsi = parseInt(tsi.replace(/,/g, ""));

                var sum_amount = isNaN(percentceding * conv_tsi) ? 0 :(percentceding * conv_tsi).toFixed(2);
                var real_sum = sum_amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('#mcamount').val(convert(sum_amount));
            }
            else
            {
                swal('warning!','please fill TSI insured first','error')
            }
        }

    });

    $('#mcpercent').change(function(e){
         var keyCode = e.keyCode || e.which;
         console.log(keyCode)
        if(keyCode != 9){
            var percentceding = parseFloat($(this).val()) / 100 ;
            var valtsi = $('#mcshareto').val();

            if(valtsi != null){
                var tsi = $('#mcshareto').val();
                var conv_tsi = parseInt(tsi.replace(/,/g, ""));

                var sum_amount = isNaN(percentceding * conv_tsi) ? 0 :(percentceding * conv_tsi).toFixed(2);
                var real_sum = sum_amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('#mcamount').val(convert(sum_amount));
            }
            else
            {
                swal('warning!','please fill TSI insured first','error')
            }
        }
        else{
            var percentceding = parseFloat($(this).val()) / 100 ;
            var valtsi = $('#mcshareto').val();

            if(valtsi != null){
                var tsi = $('#mcshareto').val();
                var conv_tsi = parseInt(tsi.replace(/,/g, ""));

                var sum_amount = isNaN(percentceding * conv_tsi) ? 0 :(percentceding * conv_tsi).toFixed(2);
                var real_sum = sum_amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('#mcamount').val(convert(sum_amount));
            }
            else
            {
                swal('warning!','please fill TSI insured first','error')
            }
        }

    });

    $('#mcpercent').keydown(function(e){
         var keyCode = e.keyCode || e.which;
        if(keyCode != 9){
            var percentceding = parseFloat($(this).val()) / 100 ;
            var valtsi = $('#mcshareto').val();

            if(valtsi != null){
                var tsi = $('#mcshareto').val();
                var conv_tsi = parseInt(tsi.replace(/,/g, ""));

                var sum_amount = isNaN(percentceding * conv_tsi) ? 0 :(percentceding * conv_tsi).toFixed(2);
                var real_sum = sum_amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('#mcamount').val(convert(sum_amount));
            }
            else
            {
                swal('warning!','please fill TSI insured first','error')
            }
        }
        else{
            var percentceding = parseFloat($(this).val()) / 100 ;
            var valtsi = $('#mcshareto').val();

            if(valtsi != null){
                var tsi = $('#mcshareto').val();
                var conv_tsi = parseInt(tsi.replace(/,/g, ""));

                var sum_amount = isNaN(percentceding * conv_tsi) ? 0 :(percentceding * conv_tsi).toFixed(2);
                var real_sum = sum_amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('#mcamount').val(convert(sum_amount));
            }
            else
            {
                swal('warning!','please fill TSI insured first','error')
            }
        }

    });

    $('#mcpercent').keypress(function(e){
         var keyCode = e.keyCode || e.which;
        if(keyCode != 9){
            var percentceding = parseFloat($(this).val()) / 100 ;
            var valtsi = $('#mcshareto').val();

            if(valtsi != null){
                var tsi = $('#mcshareto').val();
                var conv_tsi = parseInt(tsi.replace(/,/g, ""));

                var sum_amount = isNaN(percentceding * conv_tsi) ? 0 :(percentceding * conv_tsi).toFixed(2);
                var real_sum = sum_amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('#mcamount').val(convert(sum_amount));
            }
            else
            {
                swal('warning!','please fill TSI insured first','error')
            }
        }
        else{
            var percentceding = parseFloat($(this).val()) / 100 ;
            var valtsi = $('#mcshareto').val();

            if(valtsi != null){
                var tsi = $('#mcshareto').val();
                var conv_tsi = parseInt(tsi.replace(/,/g, ""));

                var sum_amount = isNaN(percentceding * conv_tsi) ? 0 :(percentceding * conv_tsi).toFixed(2);
                var real_sum = sum_amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('#mcamount').val(convert(sum_amount));
            }
            else
            {
                swal('warning!','please fill TSI insured first','error')
            }
        }

    });
</script>

<script type="text/javascript">
    $('#mcamount').change(function(e){
         var keyCode = e.keyCode || e.which;
        if(keyCode != 9){
            var amountlocation = $(this).val();
            var conv_amountlocation = parseInt(amountlocation.replace(/,/g, ""));
            console.log(amountlocation)
            console.log(conv_amountlocation)
            var valtsi = $('#mcshareto').val();

            if(valtsi != null){
                var tsi = $('#mcshareto').val();
                var conv_tsi = parseInt(tsi.replace(/,/g, ""));

                var sum_amount = isNaN((conv_amountlocation / conv_tsi)*100) ? 0 :((conv_amountlocation / conv_tsi)*100).toFixed(2);
                var real_sum = sum_amount.toString();
                console.log(sum_amount)
                console.log(real_sum)
                $('#mcpercent').val(convert(sum_amount));
            }else{
                swal('warning!','please fill TSI insured first','error')
            }
        }
        else{
            var amountlocation = $(this).val() ;
            var conv_amountlocation = parseInt(amountlocation.replace(/,/g, ""));

            console.log(amountlocation)
            console.log(conv_amountlocation)
            var valtsi = $('#mcshareto').val();

            if(valtsi != null){
                var tsi = $('#mcshareto').val();
                var conv_tsi = parseInt(tsi.replace(/,/g, ""));

                var sum_amount = isNaN((conv_amountlocation / conv_tsi)*100) ? 0 :((conv_amountlocation / conv_tsi)*100).toFixed(2);
                var real_sum = sum_amount.toString();
                console.log(sum_amount)
                console.log(real_sum)
                $('#mcpercent').val(convert(sum_amount));
            }else{
                swal('warning!','please fill TSI insured first','error')
            }
        }

    });

    $('#mcamount').keyup(function(e){
          var keyCode = e.keyCode || e.which;
        if(keyCode != 9){
            var amountlocation = $(this).val();
            var conv_amountlocation = parseInt(amountlocation.replace(/,/g, ""));
            console.log(amountlocation)
            console.log(conv_amountlocation)
            var valtsi = $('#mcshareto').val();

            if(valtsi != null){
                var tsi = $('#mcshareto').val();
                var conv_tsi = parseInt(tsi.replace(/,/g, ""));

                var sum_amount = isNaN((conv_amountlocation / conv_tsi)*100) ? 0 :((conv_amountlocation / conv_tsi)*100).toFixed(2);
                var real_sum = sum_amount.toString();
                console.log(sum_amount)
                console.log(real_sum)
                $('#mcpercent').val(convert(sum_amount));
            }else{
                swal('warning!','please fill TSI insured first','error')
            }
        }
        else{
             var percentceding = parseFloat($('#mcpercent').val()) / 100 ;
            var valtsi = $('#mcshareto').val();

            if(valtsi != null){
                var tsi = $('#mcshareto').val();
                var conv_tsi = parseInt(tsi.replace(/,/g, ""));

                var sum_amount = isNaN(percentceding * conv_tsi) ? 0 :(percentceding * conv_tsi).toFixed(2);
                var real_sum = sum_amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('#mcamount').val(convert(sum_amount));
            }
            else
            {
                swal('warning!','please fill TSI insured first','error')
            }
        }

    });

    $('#mcamount').keypress(function(e){
         var keyCode = e.keyCode || e.which;
        if(keyCode != 9){
            // var percentceding = parseFloat($('#percentceding').val()) / 100 ;
            // var valtsi = $('#feshareto').val();

            // if(valtsi != null){
            //     var tsi = $('#feshareto').val();
            //     var conv_tsi = parseInt(tsi.replace(/,/g, ""));

            //     var sum_amount = isNaN(percentceding * conv_tsi) ? 0 :(percentceding * conv_tsi).toFixed(2);
            //     var real_sum = sum_amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            //     $('#amountlocation').val(convert(sum_amount));
            // }
            // else
            // {
            //     swal('warning!','please fill TSI insured first','error')
            // }
        }
        else{
            var percentceding = parseFloat($('#mcpercent').val()) / 100 ;
            var valtsi = $('#mcshareto').val();

            if(valtsi != null){
                var tsi = $('#mcshareto').val();
                var conv_tsi = parseInt(tsi.replace(/,/g, ""));

                var sum_amount = isNaN(percentceding * conv_tsi) ? 0 :(percentceding * conv_tsi).toFixed(2);
                var real_sum = sum_amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('#mcamount').val(convert(sum_amount));
            }
            else
            {
                swal('warning!','please fill TSI insured first','error')
            }
        }

    });

    $('#mcamount').keydown(function(e){
         var keyCode = e.keyCode || e.which;
        if(keyCode != 9){
            // var percentceding = parseFloat($('#percentceding').val()) / 100 ;
            // var valtsi = $('#feshareto').val();

            // if(valtsi != null){
            //     var tsi = $('#feshareto').val();
            //     var conv_tsi = parseInt(tsi.replace(/,/g, ""));

            //     var sum_amount = isNaN(percentceding * conv_tsi) ? 0 :(percentceding * conv_tsi).toFixed(2);
            //     var real_sum = sum_amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            //     $('#amountlocation').val(convert(sum_amount));
            // }
            // else
            // {
            //     swal('warning!','please fill TSI insured first','error')
            // }
        }
        else{
            var percentceding = parseFloat($('#mcpercent').val()) / 100 ;
            var valtsi = $('#mcshareto').val();

            if(valtsi != null){
                var tsi = $('#mcshareto').val();
                var conv_tsi = parseInt(tsi.replace(/,/g, ""));

                var sum_amount = isNaN(percentceding * conv_tsi) ? 0 :(percentceding * conv_tsi).toFixed(2);
                var real_sum = sum_amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('#mcamount').val(convert(sum_amount));
            }
            else
            {
                swal('warning!','please fill TSI insured first','error')
            }
        }

    });
</script>

<script type="text/javascript">
    $('#shipcodetxt').change(function(){
       var shipcode = $(this).val();

       if(shipcode){
           $.ajax({
               type:"GET",
               dataType: 'json',
               url:"{{url('get-ship-list')}}?ship_code="+shipcode,
               success:function(response){        
                   if(response){
                       $("#shipnametxt").val(response.shipname);
                   }else{
                       $("#shipnametxt").empty();
                   }
               }
           });
       }else{
           $("#shipnametxt").empty();
       }
   });
</script>



<script type="text/javascript">

    //triggered when modal is about to be shown
    $('#ModalAddInterestInsured').on('show.bs.modal', function(e) {

         //get data-id attribute of the clicked element

         var codesl = $(e.relatedTarget).data('look-id');
         console.log("ini ship code " + codesl)
        // alert(codesl);
        $('#mcshiplistid').val(codesl);
    });

</script>

<script type="text/javascript">
    //triggered when modal is about to be shown
    $('#ModalAddInterestInsured').on('show.bs.modal', function(e) {

         //get data-id attribute of the clicked element

         var codesl = $(e.relatedTarget).data('look-id');
        //alert(codesl);
        $('#mcshiplistid').val(codesl);
    });
</script>

<script type='text/javascript'>
    $('#form-addship').submit(function(e){
       e.preventDefault();

       var shipcode = $('#shipcodetxt').val();
       var shipname = $('#shipnametxt').val();
       var insured_id = $('#mcnumber').val();
       var token = $('input[name=_token]').val();
       var slip_type = 'mc';
       
       $.ajax({
           url:"{{ route('shiplist.store') }}",
           type:"POST",
           data:{
               ship_code:shipcode,
               ship_name:shipname,
               insuredID:insured_id,
               sliptype:slip_type,
               _token:token
           },
           beforeSend: function() { $("body").addClass("loading");  },
           complete: function() {  $("body").removeClass("loading"); },
           success:function(response){
               console.log(response)
               console.log("response id " + response.id)
               $('#shipdetailTable tbody').prepend('<tr id="sid'+response.id+'"  data-name="shiplistvalue[]">'+
                   '<td data-name="'+shipcode+'">'+shipcode+'</td>'+
                   '<td data-name="'+shipname+'">'+shipname+'</td>'+
                   '<td>'+
                   '<a class="text-primary mr-3 float-right " data-toggle="modal" data-look-id="'+response.id+'" data-target="#ModalAddInterestInsured">'+
                   '<button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#ModalAddInterestInsured2">Add</button>'+
                   '</a>'+
                   '<a href="javascript:void(0)" onclick="deleteshipdetail('+response.id+')">'+
                   '<i class="fas fa-trash text-danger"></i></a></td>'+
                   '</tr>'+

                   '<tr id="iidid'+response.id+'">'+
                   '<td></td>'+
                   '<td colspan="3">'+
                   '<table id="tiidid'+response.id+'" width="600" class="table table-bordered table-striped">'+
                   '<thead>'+
                   '<tr>'+
                   '<th>Ceding</th>'+
                   '<th>Interest Insured</th>'+
                   '<th>Credit Note/Debit Note</th>'+
                   '<th>Certificate Number</th>'+
                   '<th>Slip Number</th>'+
                   '<th>Policy Number</th>'+
                   '<th>Share</th>'+
                   '<th>amount</th>'+
                   '<th>Action</th>'+
                   '</tr>'+
                   '</thead>'+
                   '<tbody id="tbiidid'+response.id+'">'+
                   '</tbody>'+
                   '</table>'+
                   '</td>'+
                   '</tr>'
                   )
               $('#ModalAddShip').modal('toggle');
               $('#form-addship')[0].reset();
           }
       });

   });
</script>

<script type='text/javascript'>
   function deleteshipdetail(id){
       var token = $('input[name=_token]').val();

       $.ajax({
           url:'{{ url("/") }}/delete-ship-list/'+id,
           type:"DELETE",
           data:{
               _token:token
           },
           beforeSend: function() { $("body").addClass("loading");  },
           complete: function() {  $("body").removeClass("loading"); },
           success:function(response){
               
               $('#sid'+id).remove();
               $('#iidid'+id).remove();
               console.log(response);
           }
       });
   }
</script>


<script type="text/javascript">
   $('#addinterestinsured-btn').click(function(e){
      e.preventDefault();

      // var interest = $('#slipinterestlist').val();
      // var amount = $('#slipamount').val();
      var shiplist_id = $('#mcshiplistid').val();
      var slip_type = 'mc';
      var insured_id = $('#mcnumber').val();
      var interestinsured = $('#mcinterestlist').val();
      var ceding = $('#mccedinglist').val();
      var cndn = $('#mccndn').val();
      var certno = $('#mccertno').val();
      var slipno = $('#mcslipno').val();
      var policyno = $('#mcpolicyno').val();
      var percent = $('#mcpercent').val();
      var amount = $('#mcamount').val();
      
      var token2 = $('input[name=_token2]').val();

      var conv_amount = amount.replace(/,/g, "");
      console.log(conv_amount)
      var real_amount = parseFloat(conv_amount);
      console.log(real_amount)
      
      $.ajaxSetup({
               headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
           });

      $.ajax({
          url:"{{ route('interestlist.store') }}",
          type:"POST",
          data:{
              interest_insured:interestinsured,
              slipamount:real_amount,
              id_insured:insured_id,
              ceding:ceding,
              cndn:cndn,
              certno:certno,
              slipno:slipno,
              policyno:policyno,
              percent:percent,
              sliptype:slip_type,
              shiplist_id:shiplist_id
          },
          beforeSend: function() { $("body").addClass("loading");  },
          complete: function() {  $("body").removeClass("loading"); },
          success:function(response){
           
              console.log(response)
              // var curr_amount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(response.amount);
              // $('#interestInsuredTable tbody').prepend('<tr id="iid'+response.id+'" data-name="interestvalue[]"><td data-name="'+response.interest_id+'">'+response.description+'</td><td data-name="'+response.name_ceding+'">'+ response.code_ceding + ' - ' + response.name_ceding +'</td><td data-name="'+response.cndn+'">'+response.cndn+'</td><td data-name="'+response.certno+'">'+response.certno+'</td><td data-name="'+response.slipno+'">'+response.slipno+'</td><td data-name="'+response.policyno+'">'+response.policyno+'</td><td data-name="'+response.percentage+'">'+response.percentage+'</td><td data-name="'+response.amount+'">'+curr_amount+'</td><td><a href="javascript:void(0)" onclick="deleteinterestdetail('+response.id+')">delete</a></td></tr>')
             
              var amount = response.amount;
               var ceding_share = $('#mcshare').val();
               if(ceding_share == ''){
                   var sum_ceding = isNaN(parseFloat(0) + parseFloat(amount)) ? 0 :(parseFloat(0) + parseFloat(amount)).toFixed(2);
                   var conv_sum_ceding = sum_ceding.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                   $('#mcshare').val(conv_sum_ceding);
                   // $('#feshare2').val(conv_sum_ceding);
                   console.log('ceding awal' + conv_sum_ceding)
               }else{
                   var conv_ceding_share = ceding_share.replace(/,/g, "");
                   var real_ceding_share = parseInt(conv_ceding_share);
                   var sum_ceding = isNaN(parseFloat(real_ceding_share) + parseFloat(amount)) ? 0 :(parseFloat(real_ceding_share) + parseFloat(amount)).toFixed(2);
                   var conv_sum_ceding = sum_ceding.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                   $('#mcshare').val(conv_sum_ceding);
                   // $('#feshare2').val(conv_sum_ceding);
                   console.log('ceding bertambah' + conv_sum_ceding)


               }
               console.log('amount' + amount)
               var fl_amount = parseFloat(amount);
               console.log('amount float' + fl_amount)
               var new_amount = fl_amount.toFixed(2);
               console.log('amount to fixed' + new_amount)
               var curr_amount = new_amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
               console.log('current amount' + curr_amount) 

               var cndn = '';
               var certno = '';
               var slipno = '';
               var policyno = '';

               var percent = response.percentage;
               var percentfl = parseFloat(percent);
               var new_percent = percentfl.toFixed(2);

               if(response.cndn == null){
                   cndn = '-';
               }else{
                   cndn = response.cndn;
               }

               if(response.certno == null){
                   certno = '-';
               }else{
                   certno = response.certno;
               }

               if(response.slipno == null){
                   slipno = '-';
               }else{
                   slipno = response.slipno;
               }

               if(response.policyno == null){
                   policyno = '-';
               }else{
                   policyno = response.policyno;
               }

              $('#tiidid'+shiplist_id+' > tbody:last-child').prepend('<tr id="intinsdetail'+response.id+'">'+
                           '<td>'+response.code_ceding+ '-' + response.name_ceding +'</td>'+
                           '<td>'+response.description+'</td>'+
                           '<td>'+cndn+'</td>'+
                           '<td>'+certno+'</td>'+
                           '<td>'+slipno+'</td>'+
                           '<td>'+policyno+'</td>'+
                           '<td>'+new_percent+' %</td>'+
                           '<td>'+curr_amount+'</td>'+
                           '<td>'+
                           '<a href="javascript:void(0)" onclick="deleteinterestdetail('+response.id+')"><i class="fas fa-trash text-danger"></i></a></td>'+
                           '</tr>');

                           
                           var test = $("#slipcedingbroker option[value='"+response.idceding+"']").text();
                            console.log("coba dulu ini " + $("#slipcedingbroker option[value='"+response.idceding+"']").text())
                            if(!test){
                                $("#slipcedingbroker option[value='placeholder']").remove();
                                $("#slipcedingbroker").prepend('<option value="'+response.idceding+'">'+response.cedingcode+' - '+response.ceding+'</option>');
                                $("#slipcedingbroker").prepend('<option value="placeholder" selected >Ceding or Broker</option>');
                            }else{

                            }
                            
                            var testupdate = $("#slipcedingbrokerupdate option[value='"+response.idceding+"']").text();
                            if(!testupdate){
                                $("#slipcedingbrokerupdate option[value='placeholder']").remove();
                                $("#slipcedingbrokerupdate").prepend('<option value="'+response.idceding+'">'+response.cedingcode+' - '+response.ceding+'</option>');
                                $("#slipcedingbrokerupdate").prepend('<option value="placeholder" selected >Ceding or Broker</option>');
                            }
                            
                            
                            var testendorse = $("#slipcedingbrokerendorsement option[value='"+response.idceding+"']").text();
                            if(!testendorse){
                                $("#slipcedingbrokerendorsement option[value='placeholder']").remove();
                                $("#slipcedingbrokerendorsement").prepend('<option value="'+response.idceding+'">'+response.cedingcode+' - '+response.ceding+'</option>');
                                $("#slipcedingbrokerendorsement").prepend('<option value="placeholder" selected >Ceding or Broker</option>');
                            }
                           
                           
                           console.log("ceding id tambahan " + response.id_ceding)
                           console.log("ceding code tambahan " + response.code_ceding)
                           console.log("ceding name tambahan " + response.name_ceding)
                           

                           if(response.sumceding){
                                   $('table#shipdetailTable tr#totalamount').empty();
                                   $('tbody#totalamount').empty();
                                   var total_amount_ceding = response.sumceding;
                                   
                                   for(var i = 0; i < total_amount_ceding.length; i++){

                                       var name = total_amount_ceding[i].name;
                                       var amount_ceding = total_amount_ceding[i].amount;
                                       console.log('amount' + amount_ceding)
                                       var fl_amount = parseFloat(amount_ceding);
                                       console.log('amount float' + fl_amount)
                                       var new_amount = fl_amount.toFixed(2);
                                       console.log('amount to fixed' + new_amount)
                                       var curr_amount = fl_amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                       console.log('current amount' + curr_amount)

                                       var percent = total_amount_ceding[i].percentage;
                                       var percentfl = parseFloat(percent);
                                       // var new_percent = percentfl.toFixed(2);

                                       $('#shipdetailTable tr:last').after('<tr id="totalamount">'+
                                       '<td></td>'+
                                       '<td >'+name+'</td>'+
                                       '<td >'+percentfl+'%</td>'+
                                       '<td >'+curr_amount+'</td>'+
                                       '</tr>');

                               };
                           }

              $('#ModalAddInterestInsured').modal('toggle');
               // $('#form-addship')[0].reset();
          }
      });
   });
</script>

<script type="text/javascript">
   function deleteinterestdetail(id){
       var token2 = $('input[name=_token2]').val();

       $.ajax({
           url:'{{ url("/") }}/delete-interest-list/'+id,
           type:"DELETE",
           data:{
               _token:token2
           },
           beforeSend: function() { $("body").addClass("loading");  },
          complete: function() {  $("body").removeClass("loading"); },
           success:function(response){
               
               $('#iid'+id).remove();
               console.log(response);
               
               var total =  $("#sliptotalsum").val();
               console.log(total)
               var conv_total = total.replace(/,/g, "");
               console.log(conv_total)
               var real_total = parseInt(conv_total);
               console.log(real_total)
               var sum = isNaN(parseFloat(real_total) - parseFloat(response.amount)) ? 0 :(parseFloat(real_total) - parseFloat(response.amount)) ;
               console.log(sum)
               var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
               $("#sliptotalsum").val(real_sum);
               $("#msishareto").val(real_sum);
               $("#msitsi").val(real_sum);

               if(response.suminterest){
                           $('table#shipdetailTable tr#totalamount').empty();
                           $('tbody#totalamount').empty();
                           var total_amount_ceding = response.suminterest;
                           
                           for(var i = 0; i < total_amount_ceding.length; i++){

                               var name = total_amount_ceding[i].name;
                               var amount_ceding = total_amount_ceding[i].amount;
                               console.log('amount' + amount_ceding)
                               var fl_amount = parseFloat(amount_ceding);
                               console.log('amount float' + fl_amount)
                               var new_amount = fl_amount.toFixed(2);
                               console.log('amount to fixed' + new_amount)
                               var curr_amount = fl_amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                               console.log('current amount' + curr_amount)

                               var percent = total_amount_ceding[i].percentage;
                               var percentfl = parseFloat(percent);
                               // var new_percent = percentfl.toFixed(2);

                               $('#shipdetailTable tr:last').after('<tr id="totalamount">'+
                               '<td></td>'+
                               '<td >'+name+'</td>'+
                               '<td >'+percentfl+'%</td>'+
                               '<td >'+curr_amount+'</td>'+
                               '</tr>');

                       };
                   }
           }
       });
   }
</script>

<script type="text/javascript">
    $('#addinsuredsave-btn').click(function(e){
       //alert('masuk');
       e.preventDefault();

       var msinumber = $('#mcnumber').val();
       var msiprefix = $('#mcprefix').val();
       var msisuggestinsured = $('#autocomplete').val();
       var msisuffix = $('#autocomplete2').val();
       var msishare = $('#mcshare').val();
       var msisharefrom  = $('#mcsharefrom').val();
       var msishareto = $('#mcshareto').val();
       var msiroute = $('#mcroute').val();
       var msiroutefrom  = $('#mcroutefrom').val();
       var msirouteto = $('#mcrouteto').val();
       var msicurrency = $('#mccurrency').val();
       var msiuy = $('#mcuy').val();
       var msibusiness_id = $('#business_id').val();
       var msiflag_overseas = $('input[name="flag_overseas"]:checked').val();

    //    var msicoinsurance = $('#msicoinsurance').val();

        var conv_msishare = msishare.replace(/,/g, "");
       console.log(conv_msishare)
       var real_msishare = parseInt(conv_msishare);
       console.log(real_msishare)
       var conv_msisharefrom = msisharefrom.replace(/,/g, "");
       console.log(conv_msisharefrom)
       var real_msisharefrom = parseInt(conv_msisharefrom);
       console.log(real_msisharefrom)
       var conv_msishareto = msishareto.replace(/,/g, "");
       console.log(conv_msishareto)
       var real_msishareto = parseInt(conv_msishareto);
       console.log(real_msishareto)

       if(isNaN(real_msishare))
       {
           real_msishare=0;
       }

       if(isNaN(real_msishareto))
       {
           real_msishareto=0;
       }

       if(isNaN(real_msisharefrom))
       {
        real_msisharefrom=0;
        }
       
       
       var token2 = $('input[name=_token]').val();

       console.log(msiprefix)
       console.log(msisuggestinsured)
       console.log(msinumber)
       console.log(msisuffix)

       
       $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

       $.ajax({
           url:"{{ url('transaction-data/marine-insured/store') }}",
           type:"POST",
           data:{
               msinumber:msinumber,
               msiprefix:msiprefix,
               msisuggestinsured:msisuggestinsured,
               msisuffix:msisuffix,
               msishare:real_msishare,
               msisharefrom:real_msisharefrom,
               msishareto:real_msishareto,
               msiroute:msiroute,
               msiroutefrom:msiroutefrom,
               msirouteto:msirouteto,
               msicurrency:msicurrency,
               msiuy:msiuy,
               msibusiness_id:msibusiness_id,
               msiflag_overseas:msiflag_overseas
            //    msicoinsurance:msicoinsurance
           },
           beforeSend: function() { $("body").addClass("loading");  },
           complete: function() {  $("body").removeClass("loading"); },
           success:function(response)
           {
                swal("Good job!", "Insured Marine Insert Success", "success")
                console.log(response)
                // $(':input','#formmarineinsured')
                //     .not(':button, :submit, :reset, :hidden')
                //     .val('')
                //     .removeAttr('checked')
                //     .removeAttr('selected');

                // $("#marineslipform").attr("hidden", false);
                // $("#marineslipform :input").prop("disabled", false);
                // $('#slipmcnumber').val(msinumber);
                $("#addinsuredsave-btn").html('Update');
                if(response.done == 1){
                    refreshTableSlip(msinumber)
                }
           },
           error: function (request, status, error) {
                //alert(request.responseText);
                swal("Error!", "Marine Insured Insert Error", "Insert Error");
           }
       });

   });
    function refreshTableSlip(number){
                var slip_type = $('#sliptypeform').val();
                //url:"{{url('transaction-data/fe-slip/cancelformnumber/')}}"+slipnumber,
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
                $.ajax({
                 url:"{{url('transaction-data/"+slip_type+"/refreshslip')}}",
                 type:"POST",
                 data:{
                    number:number,
                    type:slip_type
                 },
                 // beforeSend: function() { $("body").addClass("loading");  },
                 // complete: function() {  $("body").removeClass("loading"); },
                 success:function(response)
                 {
                    console.log(response)
                    var html = "";
                    var button = "";
                    var slipdata= JSON.parse(response.slip_data_distinct);
                    var slipdatadetail= JSON.parse(response.slip_data2);
                    var max_endorsement = response.max_endorsement;
                    console.log('slipdata ' + slipdata.length)
                    console.log('slipdatadetail.length ' + slipdatadetail.length)
                    
                    $('#SlipInsuredTableData tbody').empty();
                            
                        for(var i = 0; i < slipdatadetail.length; i++){
                            var id = slipdatadetail[i].id;
                            var number = slipdatadetail[i].number;
                            var warning_flag = slipdatadetail[i].warning_flag;
                            var cedingbroker = slipdatadetail[i].name;
                            var cedingbrokercn = slipdatadetail[i].company_name;
                            var ceding = slipdatadetail[i].source_name;
                            var cedingcn = slipdatadetail[i].source_companyname;
                            var id_detail = slipdatadetail[i].id;
                            var statusdetail = slipdatadetail[i].status;
                            var warning_flag = slipdatadetail[i].warning_flag;
                            var endorsmentdetail = slipdatadetail[i].endorsment;
                            var date_transfer = slipdatadetail[i].date_transfer;
                            
                 
                            if(endorsmentdetail == max_endorsement){                           
                                if(date_transfer == null){

                                    if(statusdetail == 'cancel' || statusdetail == 'decline'){
                                        button += "";
                                        
                                    }else{
                                        if(warning_flag == 1){
                                            button += '<button type="button" id="change-must" class="btn btn-sm btn-danger float-right">Must Change</button>';
                                        }
                                        button += '<a class="text-primary mr-3 float-right" data-toggle="modal"  data-book-id="'+id_detail+'" data-target="#detailmodaldata" href="#detailmodaldata">'
                                        +'<button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#detailmodaldata2">Detail</button>'
                                        +'</a>'
                                        +'<a class="text-primary mr-3 float-right " data-toggle="modal" data-book-id="'+id_detail+'" data-target="#updatemodaldata">'
                                        +'<button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#updatemodaldata2">Edit</button>'
                                        +'</a>'
                                        +'<a class="text-primary mr-3 float-right " data-toggle="modal" data-book-id="'+id_detail+'" data-target="#cancelmodaldata">'
                                        +'<button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#cancelmodaldata2">Cancel</button>'
                                        +'</a>';
                                    }
                                }else if(date_transfer != null){
                                    if(statusdetail == 'cancel' || statusdetail == 'decline'){
                                        button += '<a class="text-primary mr-3 float-right" data-toggle="modal"  data-book-id="'+id_detail+'" data-target="#detailmodaldata" href="#detailmodaldata">'
                                        +'<button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#detailmodaldata2">Detail</button>'
                                        +'</a>'
                                        +'<a class="text-primary mr-3 float-right " data-toggle="modal" data-book-id="'+id_detail+'" data-target="#endorsementmodaldata">'
                                        +'<button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#endorsementmodaldata2">Endorsement</button>'
                                        +'</a>';
                                    }else{
                                        if(warning_flag == 1){
                                            button += '<button type="button" id="change-must" class="btn btn-sm btn-danger float-right">Must Change</button>';
                                        }
                                        button += '<a class="text-primary mr-3 float-right" data-toggle="modal"  data-book-id="'+id_detail+'" data-target="#detailmodaldata" href="#detailmodaldata">'
                                        +'<button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#detailmodaldata2">Detail</button>'
                                        +'</a>'
                                        +'<a class="text-primary mr-3 float-right " data-toggle="modal" data-book-id="'+id_detail+'" data-target="#endorsementmodaldata">'
                                        +'<button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#endorsementmodaldata2">Endorsement</button>'
                                        +'</a>'
                                        +'<a class="text-primary mr-3 float-right " data-toggle="modal" data-book-id="'+id_detail+'" data-target="#cancelmodaldata">'
                                        +'<button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#cancelmodaldata2">Cancel</button>'
                                        +'</a>';
                                    }
                                }
                            }else{
                                button += '<a class="text-primary mr-3 float-right" data-toggle="modal"  data-book-id="'+id_detail+'" data-target="#detailmodaldata" href="#detailmodaldata">'
                                +'<button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#detailmodaldata2">Detail</button>'
                                +'</a>';
                            }    
                            
                                
                            
                            
                            html += '<tr><td>'+number+'</td>'
                                +'<td data-name="'+cedingbroker+'">'+cedingbroker+'-'+cedingbrokercn+'</td>'
                                +'<td data-name="'+ceding+'">'+ceding+'-'+cedingcn+'</td>' 
                                +'<td data-name="'+statusdetail+'">'+statusdetail+'</td>'
                                +'<td data-name="'+endorsmentdetail+'">'+endorsmentdetail+'</td>'
                                +'<td>'
                                + button
                                +'</td></tr>';
                            button = "";
                        };
                        
                        $('#SlipInsuredTableData tbody').append(html)

                    

                    },
                    error: function (request, status, error) {
                        //alert(request.responseText);
                        swal("Error!", error, "warning");
                    }
                });
    }
</script>