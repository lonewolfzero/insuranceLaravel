<script type="text/javascript">
    $(document).ready(function() 
    { 

        var countryID = 102; 
            //alert(countryID);
            if(countryID){
                $.ajax({
                    type:"GET",
                    url:"{{url('get-state-lookup')}}?country_id="+countryID,
                    beforeSend: function() { $("body").addClass("loading");  },
                    complete: function() {  $("body").removeClass("loading"); },
                    success:function(res){  
                        console.log(res)      
                        if(res){
                            $("#state_location").empty();
                            $("#state_location").append('<option selected disabled>Select States/Province</option>');
                            $.each(res,function(key,value){
                                $("#state_location").append('<option value="'+key+'">'+value+'</option>');
                            });

                        }else{
                            $("#state_location").append('<option value="" selected disabled>get value error</option>');
                        }
                    }
                });
            }else{
                $("#state_location").append('<option value="" selected disabled>countryID null</option>');
                $("#city_location").empty();
            } 

        var currency_exc = $('#mpcurrency').val();
        if(currency_exc){
            $.ajax({
                type:"GET",
                url:"{{url('get-kurs-detail')}}?currency_id="+currency_exc,
                beforeSend: function() { $("body").addClass("loading");  },
                complete: function() {  $("body").removeClass("loading"); },
                success:function(res){  
                    console.log(res)
                    console.log('kurs ' + res.kurs)      
                    $('#mpkurs').val(res.kurs);
                }
            });
        }
    });
</script>

<script type='text/javascript'>
    $('#country_location').change(function(){
        var countryID = $(this).val();  
        //alert(countryID);
        if(countryID){
            $.ajax({
                type:"GET",
                url:"{{url('get-state-lookup')}}?country_id="+countryID,
                beforeSend: function() { $("body").addClass("loading");  },
                complete: function() {  $("body").removeClass("loading"); },
                success:function(res){  
                    console.log(res)      
                    if(res){
                        $("#state_location").empty();
                        $("#state_location").append('<option selected disabled>Select States/Province</option>');
                        $.each(res,function(key,value){
                            $("#state_location").append('<option value="'+key+'">'+value+'</option>');
                        });

                    }else{
                        $("#state_location").append('<option value="" selected disabled>get value error</option>');
                    }
                }
            });
        }else{
            $("#state_location").append('<option value="" selected disabled>countryID null</option>');
            $("#city_location").empty();
        }   
    });

    $('#state_location').on('change',function(){
        var stateID = $(this).val();  
        //alert(stateID);
        if(stateID){
            $.ajax({
                type:"GET",
                url:"{{url('get-city-lookup')}}?state_id="+stateID,
                beforeSend: function() { $("body").addClass("loading");  },
                complete: function() {  $("body").removeClass("loading"); },
                success:function(res){        
                    if(res){
                        $("#city_location").empty();
                        $("#city_location").append('<option selected disabled>Select City</option>');
                        $.each(res,function(key,value){
                            $("#city_location").append('<option value="'+key+'">'+value+'</option>');
                        });
                        
                    }else{
                        $("#city_location").append('<option value="" selected disabled>get value error</option>');
                    }
                }
            });
        }else{
            $("#city_location").append('<option value="" selected disabled>countryID null</option>');
            $("#address_location").empty();
        }

    });


    $('#city_location').on('change',function(){
        var cityID = $(this).val();  
        //alert(stateID);
        if(cityID){
            $.ajax({
                type:"GET",
                url:"{{url('get-address-lookup')}}?city_id="+cityID,
                beforeSend: function() { $("body").addClass("loading");  },
                complete: function() {  $("body").removeClass("loading"); },
                success:function(res){        
                    if(res){
                        $("#address_location").empty();
                        $("#address_location").append('<option selected disabled>Select Address</option>');
                        $.each(res,function(key,value){
                            $("#address_location").append('<option value="'+key+'">'+value+'</option>');
                        });
                        
                    }else{
                        $("#address_location").append('<option value="" selected disabled>get value error</option>');
                    }
                }
            });
        }else{
            $("#address_location").append('<option value="" selected disabled>countryID null</option>');

        }

    });

    $('#address_location').on('change',function(){
        var cityID = $(this).val();  
        //alert(stateID);
        if(cityID){
            $.ajax({
                type:"GET",
                url:"{{url('get-postal-lookup')}}?address_id="+cityID,
                beforeSend: function() { $("body").addClass("loading");  },
                complete: function() {  $("body").removeClass("loading"); },
                success:function(res){
                    console.log(res)        
                    if(res){
                        console.log("postal code " + res.postal_code)
                        $("#postal_code_location_id").val(res.postal_code);
                        // $("#postal_code_location").append('<option selected disabled>Select Address</option>');
                        // $.each(res,function(key,value){
                        //     $("#postal_code_location").append('<option value="'+key+'">'+value+'</option>');
                        // });
                        
                    }else{
                       $("#postal_code_location_id").val("get value error");
                        // $("#postal_code_location").append('<option value="" selected disabled>get value error</option>');
                    }
                }
            });
        }else{
            // $("#postal_code_location").append('<option value="" selected disabled>Postal ID null</option>');
            $("#postal_code_location_id").val("postal id null");

        }

    });
</script>

<script type="text/javascript">
    $('#mpcurrency').change(function(){
        var currency_exc = $(this).val();
        $.ajax({
                type:"GET",
                url:"{{url('get-kurs-detail')}}?currency_id="+currency_exc,
                beforeSend: function() { $("body").addClass("loading");  },
                complete: function() {  $("body").removeClass("loading"); },
                success:function(res){  
                    console.log(res)
                    console.log('kurs ' + res.kurs)      
                    $('#mpkurs').val(res.kurs);
                }
            });
    });
</script>

<script type="text/javascript">
    
    $('#percentceding').keyup(function(e){
         var keyCode = e.keyCode || e.which;

        if(keyCode != 9){
            getTsi()
        }
        else{
            getTsi()
        }

    });

    $('#percentceding').change(function(e){
         var keyCode = e.keyCode || e.which;
        if(keyCode != 9){
            getTsi()
        }
        else{
            getTsi()
        }

    });

    $('#percentceding').keydown(function(e){
         var keyCode = e.keyCode || e.which;
        if(keyCode != 9){
            getTsi()
        }
        else{
            getTsi()
        }

    });

    $('#percentceding').keypress(function(e){
         var keyCode = e.keyCode || e.which;
        if(keyCode != 9){
            getTsi()
        }
        else{
            getTsi()
        }

    });
</script>
<script type="text/javascript">
    $('#amountlocation').change(function(e){
         var keyCode = e.keyCode || e.which;
        if(keyCode != 9){
            getPercentTsi();
        }
        else{
            getPercentTsi();   
        }

    });

    $('#amountlocation').keyup(function(e){
          var keyCode = e.keyCode || e.which;
        if(keyCode != 9){
            getPercentTsi()
        }
        else{
            getPercentTsi();
        }

    });
</script>
<script type="text/javascript">
    $('#mpshareto2').keyup(function(){
        var tsislip = $('#sliptotalsum').val();
        var typetsi = $('#sliptypetsi').val();
        
        $('#mpshareto').val($(this).val());
        console.log($('#mpshareto').val())
        if(tsislip != null && typetsi == '1'){
            $('#sliptotalsum').val($(this).val());
            $('#sliptotalsum2').val($(this).val());
                    
        }
    });

    $('#mpshareto').change(function(){
        var sumpct = $('#sliptotalsumpct').val();
        var typetsi = $('#sliptypetsi').val();


        if(sumpct != '' && typetsi == '1'){
                var pct =  parseFloat($('#slippct').val())/100;

                var tsi = $("#sliptotalsum").val();
                var conv_tsi = parseFloat(tsi.replace(/,/g, ""));

                var sum = isNaN(pct * conv_tsi) ? 0 :(pct * conv_tsi);
                console.log(sum)
                var conv_sum = parseFloat(sum);
                var real_sum = conv_sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('#sliptotalsumpct').val(real_sum);
                $('#sliptotalsumpct2').val(real_sum);

                var dpamount = $('#slipdpamount').val();
                var ecamount = $('#slipamountec').val();

                swal('Success!','tsi in slip changed, please change value in risk detail, deductible and extendcoverage manually','success')

                if(dpamount != null){
                    var percent =  parseFloat($('#slipdppercentage').val()) / 100;
                    
                    var sum = isNaN(percent * conv_tsi) ? 0 :(percent * conv_tsi);
                    var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    console.log($('#slipdppercentage').val())
                    console.log(percent)
                    console.log(sum)
                    console.log(real_sum)

                    $('#slipdpamount').val(real_sum);
                    $('#slipdpamount2').val(real_sum);
                }

                if(ecamount != null){

                    var persentage =  parseFloat($('#slipnilaiec').val()) / 1000;
                    var sum = isNaN(conv_tsi * persentage) ? 0 :(conv_tsi * persentage);
                    var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    console.log($('#slipnilaiec').val())
                    console.log(persentage)
                    console.log(sum)
                    console.log(real_sum)

                    $('#slipamountec').val(real_sum);
                    $('#slipamountec2').val(real_sum);
                    
                }

                


            }
            else{
                // swal('Success!','tsi in slip changed, please change value in risk detail','success')
            }    
    });

    $('#mpshareto2').change(function(){
        var sumpct = $('#sliptotalsumpct').val();
        var typetsi = $('#sliptypetsi').val();


        if(sumpct != '' && typetsi == '1'){
                var pct =  parseFloat($('#slippct').val())/100;

                var tsi = $("#sliptotalsum").val();
                var conv_tsi = parseFloat(tsi.replace(/,/g, ""));

                var sum = isNaN(pct * conv_tsi) ? 0 :(pct * conv_tsi);
                console.log(sum)
                var conv_sum = parseFloat(sum);
                var real_sum = conv_sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('#sliptotalsumpct').val(real_sum);
                $('#sliptotalsumpct2').val(real_sum);

                var dpamount = $('#slipdpamount').val();
                var ecamount = $('#slipamountec').val();

                swal('Success!','tsi in slip changed, please change value in risk detail, deductible and extendcoverage manually','success')

                if(dpamount != null){
                    var percent =  parseFloat($('#slipdppercentage').val()) / 100;
                    
                    var sum = isNaN(percent * conv_tsi) ? 0 :(percent * conv_tsi);
                    var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    console.log($('#slipdppercentage').val())
                    console.log(percent)
                    console.log(sum)
                    console.log(real_sum)

                    $('#slipdpamount').val(real_sum);
                    $('#slipdpamount2').val(real_sum);
                }

                if(ecamount != null){

                    var persentage =  parseFloat($('#slipnilaiec').val()) / 1000;
                    var sum = isNaN(conv_tsi * persentage) ? 0 :(conv_tsi * persentage);
                    var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    console.log($('#slipnilaiec').val())
                    console.log(persentage)
                    console.log(sum)
                    console.log(real_sum)

                    $('#slipamountec').val(real_sum);
                    $('#slipamountec2').val(real_sum);
                    
                }

                


            }
            else{
                // swal('Success!','tsi in slip changed, please change value in risk detail','success')
            }    
    });
</script>

{{-- Form table input data--}}
<script type="text/javascript">

    //triggered when modal is about to be shown
    $('#addlocdetailmodaldata').on('show.bs.modal', function(e) {

         //get data-id attribute of the clicked element

         var codesl = $(e.relatedTarget).data('look-id');
        //alert(codesl);
        $('#insurednoloc').val(codesl);
    });

</script>

<script type='text/javascript'>
   $('#form-addlocation').submit(function(e){
        e.preventDefault();

        var lookupcode = $('#address_location').val();
        var insured_id = $('#insuredIDtxt').val();
        var token = $('input[name=_token]').val();

        var country = $('#country_location').val();
        var state = $('#state_location').val();
        var city = $('#city_location').val();        
        var adrress = $('#address_location').val();
        var sliptype = 'mp';


            //var slipinterestid = $('#slipinterestlistlocation').val();
            //var cnno = $('#cnno').val();
            //var certno = $('#certno').val();
            //var refno = $('#refno').val();
            //var amountlocation = $('#amountlocation').val();
            
            //var conv_amount = amountlocation.replace(/,/g, "");
            //console.log(conv_amount)
            //var real_amount = parseInt(conv_amount);
            //console.log(real_amount)
            
            $.ajax({
                url:"{{ route('locationlist.store') }}",
                type:"POST",
                data:{
                    lookupcode:lookupcode,
                    country:country,
                    state:state,
                    city:city,
                    adrress:adrress,
                    insuredID:insured_id,
                    sliptype:sliptype,
                    _token:token
                },
                beforeSend: function() { $("body").addClass("loading");  },
                complete: function() {  $("body").removeClass("loading"); },
                success:function(response){
                    console.log(response)

                        //var curr_amount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(response.amountlocation);
                        

                       if(response.success){
                            $('#insuredIDtxt').val(response.code_ms);
                            $('#locRiskTable > tbody:last-child').prepend('<tr id="sid'+response.id+'">'+
                            '<td>'+response.loc_code+'</td>'+
                            '<td>'+response.address+'<br>'+response.city_name+'<br>'+response.state_name+'<br>'+response.latitude+' , '+response.longtitude+'<br>'+ response.postal_code+'</td>'+
                            '<td>'+response.latitude+' , '+response.longtitude+'<br></td>'+
                            '<td>'+
                            '<a class="text-primary mr-3 float-right " data-toggle="modal" data-look-id="'+response.id+'" data-target="#addlocdetailmodaldata">'+
                            '<button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#addlocdetailmodaldata2">Add</button>'+
                            '</a>'+
                            '<a href="javascript:void(0)" onclick="deletelocationdetail('+response.id+')"><i class="fas fa-trash text-danger"></i></a></td>'+
                            '</tr>'+

                            '<tr id="cid'+response.id+'">'+
                            '<td></td>'+
                            '<td colspan="3">'+
                            '<table id="tcid'+response.id+'" width="600" class="table table-bordered table-striped">'+
                            '<thead>'+
                            '<tr>'+
                            '<th>Ceding Source</th>'+
                            '<th>Interest Insured</th>'+
                            '<th>Credit Note/Debit Note</th>'+
                            '<th>Certificate Number</th>'+
                            '<th>Slip Number</th>'+
                            '<th>Policy Number</th>'+
                            '<th>Share %</th>'+
                            '<th>amount</th>'+
                            '<th>Action</th>'+
                            '</tr>'+
                            '</thead>'+
                            '<tbody id="tbcid'+response.id+'">'+
                            '</tbody>'+
                            '</table>'+
                            '</td>'+
                            '</tr>'


                            );

                        
                        
                        
                        $('#addlocation').modal('toggle');
                        $('#slipamount').val('');
                        $('#slipinterestlist').val('');
                        }
                        // var tsicheck = $('#mpshareto2').val();
                        // if(tsicheck != null){
                        //     $('#mpshareto2').prop("disabled", true);
                        // }
                        
                    }
                    
                });

        });


    function deletelocationdetail(id){
        var token = $('input[name=_token]').val();

        $.ajax({
            url:'{{ url("/") }}/delete-sliplocation-list/'+id,
            type:"DELETE",
            data:{
                _token:token
            },
            beforeSend: function() { $("body").addClass("loading");  },
            complete: function() {  $("body").removeClass("loading"); },
            success:function(response){
                console.log(response);

                $('#sid'+id).remove();
                $('#cid'+id).remove();

                    //var total =  parseFloat($("#sliptotalsum").val());
                    //console.log(total)
                    //var conv_total = total.replace(/,/g, "");
                    //console.log(conv_total)
                    //var real_total = parseInt(conv_total);
                    //console.log(real_total)
                    //var sum = isNaN(real_total - parseFloat(response.amountlocation)) ? 0 :(real_total - parseFloat(response.amountlocation)) ;
                    //console.log(sum)
                    //var real_sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    //$("#sliptotalsum").val(real_sum);
                    //$("#feshareto").val(real_sum);

                    // var tbl_long = document.getElementById("locRiskTable").rows.length;

                    // if(tbl_long < 2){
                    //     var attr = $('#mpshareto2').prop("disabled", true);
                    //     if(typeof attr !== typeof undefined && attr !== false){
                    //         $('#mpshareto2').prop("disabled", false);
                    //     }
                    // }else if(tbl_long > 1){
                    //     $('#mpshareto2').prop("disabled", true);
                    // }

                }
            });
    }
</script>

<script type='text/javascript'>
   $('#form-addlocationdetail').submit(function(e){
        e.preventDefault();

        var insured_id = $('#insuredIDtxt').val();
        var insurednoloc = $('#insurednoloc').val();
        var token = $('input[name=_token]').val();
        var slipinterestid = $('#slipinterestlistlocation').val();
        var cndn = $('#cndn').val();
        var certno = $('#certno').val();
        var ceding_id = $('#ceding_id').val();
        var slipno = $('#slipno').val();
        var policyno = $('#policyno').val();
        var percent = $('#percentceding').val();
        var amountlocation = $('#amountlocation').val();
        var sliptype = 'mp';

        var conv_amount = amountlocation.replace(/,/g, "");
        console.log(conv_amount)
        var real_amount = parseFloat(conv_amount);
        console.log(real_amount)

        // var tsi = $('#mpshareto').val();
        // var conv_tsi = tsi.replace(/,/g, "");
        // console.log(conv_tsi)
        // var real_tsi = parseInt(conv_tsi);
        // console.log(real_tsi)

        var tsiinsval = $('#mpshareto').val();
        var conv_tsiinsval = tsiinsval.replace(/,/g, "");
        var int_tsiinsval = parseFloat(conv_tsiinsval);
        var int_fullins = int_tsiinsval;
        var new_instsi = int_fullins.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

        var cedshare = $('#mpshare').val();
        if(cedshare == null){
            var real_cedshare = parseInt(0);
        }else{
            var conv_cedshare = cedshare.replace(/,/g, "");
            console.log(conv_cedshare)
            var real_cedshare = parseFloat(conv_cedshare);
            console.log(real_cedshare)

        }

        var sum_cedshare = real_amount + real_cedshare;
        

        if(slipinterestid == null || ceding_id == null)
        {
            swal('warning','please choose interest or ceding first','insert error')
        }
        else
        {
            console.log('sum ceding share ' + sum_cedshare)
            console.log('ceding share ' + real_cedshare)
            console.log('tsi' + int_tsiinsval)

            if(sum_cedshare > int_tsiinsval){
                swal('warning','ceding share cannot greater than Total Sum Insured','insert error')
            }else{
                $.ajax({
                    url:"{{ route('locationlistdetail.store') }}",
                    type:"POST",
                    data:{
                        slipinterestid:slipinterestid,
                        cndn:cndn,
                        certno:certno,
                        slipno:slipno,
                        policyno:policyno,
                        ceding_id:ceding_id,
                        percent_ceding:percent,
                        amountlocation:real_amount,
                        insurednoloc:insurednoloc,
                        insured_id:insured_id,
                        sliptype:sliptype,
                        // kurs:kurs,
                        _token:token
                    },
                    beforeSend: function() { $("body").addClass("loading");  },
                    complete: function() {  $("body").removeClass("loading"); },
                    success:function(response){
                        console.log(response)

                            var amount = response.amountlocation;
                            var ceding_share = $('#mpshare').val();
                            if(ceding_share == ''){
                                var sum_ceding = isNaN(parseFloat(0) + parseFloat(amount)) ? 0 :(parseFloat(0) + parseFloat(amount));
                                var conv_sum_ceding = sum_ceding.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                $('#mpshare').val(conv_sum_ceding);
                                $('#mpshare2').val(conv_sum_ceding);
                                console.log('ceding awal' + conv_sum_ceding)
                            }else{
                                var conv_ceding_share = ceding_share.replace(/,/g, "");
                                var real_ceding_share = parseFloat(conv_ceding_share);
                                var sum_ceding = isNaN(parseFloat(real_ceding_share) + parseFloat(amount)) ? 0 :(parseFloat(real_ceding_share) + parseFloat(amount));
                                var conv_sum_ceding = sum_ceding.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                $('#mpshare').val(conv_sum_ceding);
                                $('#mpshare2').val(conv_sum_ceding);
                                console.log('ceding bertambah' + conv_sum_ceding)


                            }

                            console.log('amount' + amount)
                            var fl_amount = parseFloat(amount);
                            console.log('amount float' + fl_amount)
                            var new_amount = fl_amount.toFixed(2);
                            console.log('amount to fixed' + new_amount)
                            var curr_amount = new_amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            console.log('current amount' + curr_amount)

                            var percent = response.percent;
                            var percentfl = parseFloat(percent);
                            // var new_percent = percentfl.toFixed(2);

                            var cndn = '';
                            var certno = '';
                            var slipno = '';
                            var policyno = '';

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

                            
                            $('#tcid'+insurednoloc+' > tbody:last-child').prepend('<tr id="riskdetailsid'+response.id+'">'+
                                '<td>'+response.cedingbroker+'</td>'+
                                '<td>'+response.interest_name+'</td>'+
                                '<td>'+cndn+'</td>'+
                                '<td>'+certno+'</td>'+
                                '<td>'+slipno+'</td>'+
                                '<td>'+policyno+'</td>'+
                                '<td>'+percentfl+'%</td>'+
                                '<td>'+curr_amount+'</td>'+
                                '<td>'+
                                '<a href="javascript:void(0)" onclick="deletelocationriskdetail('+response.id+')"><i class="fas fa-trash text-danger"></i></a></td>'+
                                '</tr>');

                                // $("#slipcedingbroker").find('option').get(0).remove();
                                
                                var test = $("#slipcedingbroker option[value='"+response.idceding+"']").text();
                               console.log("coba dulu ini " + $("#slipcedingbroker option[value='"+response.idceding+"']").text())
                                if(test){
                                    $("#slipcedingbroker option[value='placeholder']").remove();
                                    $("#slipcedingbroker").prepend('<option value="'+response.idceding+'">'+response.cedingcode+' - '+response.ceding+'</option>');
                                    $("#slipcedingbroker").prepend('<option value="placeholder" selected >Ceding or Broker</option>');
                                }else{

                                }
                               
                                var testupdate = $("#slipcedingbrokerupdate option[value='"+response.idceding+"']").text();
                                if(testupdate){
                                    $("#slipcedingbrokerupdate option[value='placeholder']").remove();
                                    $("#slipcedingbrokerupdate").prepend('<option value="'+response.idceding+'">'+response.cedingcode+' - '+response.ceding+'</option>');
                                    $("#slipcedingbrokerupdate").prepend('<option value="placeholder" selected >Ceding or Broker</option>');
                                }
                               
                                
                                var testendorse = $("#slipcedingbrokerendorsement option[value='"+response.idceding+"']").text();
                                if(testendorse){
                                    $("#slipcedingbrokerendorsement option[value='placeholder']").remove();
                                    $("#slipcedingbrokerendorsement").prepend('<option value="'+response.idceding+'">'+response.cedingcode+' - '+response.ceding+'</option>');
                                    $("#slipcedingbrokerendorsement").prepend('<option value="placeholder" selected >Ceding or Broker</option>');
                                }


                                if(response.sumceding){
                                        $('table#locRiskTable tr#totalamount').empty();
                                        $('tbody#totalamount').empty();
                                        var total_amount_ceding = response.sumceding;
                                        
                                        for(var i = 0; i < total_amount_ceding.length; i++){

                                            var name = total_amount_ceding[i].name;
                                            var amount_ceding = total_amount_ceding[i].amountlocation;
                                            console.log('amount' + amount_ceding)
                                            var fl_amount = parseFloat(amount_ceding);
                                            console.log('amount float' + fl_amount)
                                            var new_amount = fl_amount;
                                            console.log('amount to fixed' + new_amount)
                                            var curr_amount = new_amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                            console.log('current amount' + curr_amount)

                                            var percent = total_amount_ceding[i].percentage;
                                            var percentfl = parseFloat(percent);
                                            // var new_percent = percentfl.toFixed(2);

                                            $('#locRiskTable tr:last').after('<tr id="totalamount">'+
                                            '<td></td>'+
                                            '<td >'+name+'</td>'+
                                            '<td >'+percentfl+'%</td>'+
                                            '<td >'+curr_amount+'</td>'+
                                            '</tr>');

                                    };
                                }
                            $('#ceding_id').val("").trigger("change");
                            $('#slipinterestlistlocation').val("").trigger("change");
                            $('#form-addlocationdetail')[0].reset();
                            $('#addlocdetailmodaldata').modal('toggle');

                            $('#percentceding').val('');
                            $('#amountlocation').val('');
                        
                            swal("success!", "ceding share has increase", "success");
                            
                        }
                });
            }
        }
    });


    function deletelocationriskdetail(id){
        var token = $('input[name=_token]').val();

        $.ajax({
            url:'{{ url("/") }}/delete-sliplocationdetail-list/'+id,
            type:"DELETE",
            data:{
                _token:token
            },
            beforeSend: function() { $("body").addClass("loading");  },
            complete: function() {  $("body").removeClass("loading"); },
            success:function(response){
                console.log(response);

                $('#riskdetailsid'+id).remove();
                var ceding_curr = $('#slipceding').val();

                // var totalnre = $('#mpshareto').val();
                // var conv_totalnre = totalnre.replace(/,/g, "");

                // var sumtotalnre = isNaN(parseFloat(conv_totalnre) - parseFloat(response.amountlocation)) ? (parseFloat(conv_totalnre) - parseFloat(response.amountlocation)) : (parseFloat(conv_totalnre) - parseFloat(response.amountlocation)) ;
                // var real_sumtotalnre = sumtotalnre.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                // $('#mpshareto').val(real_sumtotalnre);

                    //$('#cid'+id).remove();
                    var amount = response.amountlocation;
                    var ceding_share = $('#mpshare').val();
                    
                    var conv_ceding_share = ceding_share.replace(/,/g, "");
                    var real_ceding_share = parseInt(conv_ceding_share);
                    var sum_ceding = isNaN(parseFloat(real_ceding_share) - parseFloat(amount)) ? 0 :(parseFloat(real_ceding_share) - parseFloat(amount));
                    var conv_sum_ceding = sum_ceding.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    $('#mpshare').val(conv_sum_ceding);
                    $('#mpshare2').val(conv_sum_ceding);
                    console.log('ceding bertambah' + conv_sum_ceding)
                    console.log('sum ceding' + response.sumceding)

                    $("#slipcedingbroker option[value='"+response.cedinglocation+"']").remove();
                    $("#slipcedingbrokerupdate option[value='"+response.cedinglocation+"']").remove();
                    $("#slipcedingbrokerendorsement option[value='"+response.cedinglocation+"']").remove();

                    if(response.sumceding){
                            $('table#locRiskTable tr#totalamount').empty();
                            $('tbody#totalamount').empty();
                            var total_amount_ceding = response.sumceding;
                            
                            for(var i = 0; i < total_amount_ceding.length; i++){

                                var name = total_amount_ceding[i].name;
                                var amount_ceding = total_amount_ceding[i].amountlocation;
                                console.log('amount' + amount_ceding)
                                var fl_amount = parseFloat(amount_ceding);
                                console.log('amount float' + fl_amount)
                                var new_amount = fl_amount.toFixed(2);
                                console.log('amount to fixed' + new_amount)
                                var curr_amount = new_amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                console.log('current amount' + curr_amount)

                                var percent = total_amount_ceding[i].percentage;
                                var percentfl = parseFloat(percent);
                                // var new_percent = percentfl.toFixed(2);

                                $('#locRiskTable tr:last').after('<tr id="totalamount">'+
                                '<td></td>'+
                                '<td >'+name+'</td>'+
                                '<td >'+percentfl+'%</td>'+
                                '<td >'+curr_amount+'</td>'+
                                '</tr>');

                        };
                    }

                // swal("Warning!", "TSI not decrease because this ceding is not same with ceding in slip", "Tsi not decrease");
                swal("success!", "ceding share has decrease", "success");

                        // $("#sliptotalsum").val(real_sum);
                        // $("#feshareto").val(real_sum);



                    }
                });
    }
</script>

<script type='text/javascript'>
    $('#addpropertyinsured-btn').click(function(e){
       //alert('masuk');
       e.preventDefault();

       var property_type_id = $('#mppropertytypelist').val();
       
       var slip_id = $('#slipnumber').val();
       var insured_id = $('#insuredIDtxt').val();
       var token2 = $('input[name=_token2]').val();
       
       $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

       $.ajax({
           url:"{{ route('propertytype.store') }}",
           type:"POST",
           data:{
               property_type_id:property_type_id,
               id_slip:slip_id,
               insured_id:insured_id
           },
           beforeSend: function() { $("body").addClass("loading");  },
            complete: function() {  $("body").removeClass("loading"); },
           success:function(response)
           {
            
               console.log(response)
               $('#propertyTypePanel tbody').prepend('<tr id="iidproperty'+response.id+'" data-name="propertytypevalue[]"><td data-name="'+response.propertydata+'">'+response.propertydata+'</td><td><a href="javascript:void(0)" onclick="deletepropertytypedetail('+response.id+')">delete</a></td></tr>');
              
           }
       });

   });
</script>

<script type='text/javascript'>
    function deletepropertytypedetail(id)
    {
        var token2 = $('input[name=_token2]').val();

        $.ajax({
            url:'{{ url("/") }}/delete-propertytype-list/'+id,
            type:"DELETE",
            data:{
                _token:token2
            },
            beforeSend: function() { $("body").addClass("loading");  },
            complete: function() {  $("body").removeClass("loading"); },
            success:function(response){
                
                $('#iidproperty'+id).remove();
                console.log(response);
            }
        });
    }
</script>
{{-- form table input data end --}}

{{-- save form --}}

<script type='text/javascript'>
    $('#addinsuredsave-btn').click(function(e){
       //alert('masuk');
        e.preventDefault();
        

        var fesnumber = $('#insuredIDtxt').val();
        var fesinsured = $('#mpinsured').val();
        var fessuggestinsured = $('#autocomplete').val();
        var fessuffix = $('#autocomplete2').val();
        var fesshare = $('#mpshare').val();
        var fessharefrom  = $('#mpsharefrom').val();
        var fesshareto = $('#mpshareto').val();
        var fescoinsurance = $('#mpcoinsurance').val();
        var feuy = $('#mpuy').val();
        var feflag_overseas = $('input[name="flag_overseas"]:checked').val();
        var febusiness_id = $('#business_id').val();
        var fecurrency = $('#mpcurrency').val();
        var sliptype = 'mp';
        var btnins = $("#addinsuredsave-btn").text();

        var conv_fesshare = fesshare.replace(/,/g, "");
        console.log(conv_fesshare)
        var real_fesshare = parseInt(conv_fesshare);
        console.log(real_fesshare)
        var conv_fessharefrom = fessharefrom.replace(/,/g, "");
        console.log(conv_fessharefrom)
        var real_fessharefrom = parseInt(conv_fessharefrom);
        console.log(real_fessharefrom)
        var conv_fesshareto = fesshareto.replace(/,/g, "");
        console.log(conv_fesshareto)
        var real_fesshareto = parseInt(conv_fesshareto);
        console.log(real_fesshareto)

        if(isNaN(real_fesshareto))
        {
            real_fesshareto=0;
        }

        if(isNaN(real_fessharefrom))
        {
            real_fessharefrom=0;
        }


        var token2 = $('input[name=_token]').val();

        console.log(fesinsured)
        console.log(fessuggestinsured)
        console.log(fesnumber)
        console.log(fessuffix)


        if(fessuggestinsured == '' || fesshareto == ''){
            swal('given data was invalid!','please check input field','error input')
        }else{
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
            url:"{{ url('transaction-data/mp/storeheader') }}",
            type:"POST",
            data:{
                fesnumber:fesnumber,
                fesinsured:fesinsured,
                fessuggestinsured:fessuggestinsured,
                fessuffix:fessuffix,
                fesshare:real_fesshare,
                fessharefrom:real_fessharefrom,
                fesshareto:real_fesshareto,
                fecurrency:fecurrency,
                fescoinsurance:fescoinsurance,
                btn_sign:btnins,
                slip_type:sliptype,
                feflag_overseas:feflag_overseas,
                febusiness_id:febusiness_id,
                feuy:feuy
            },
            beforeSend: function() { $("body").addClass("loading");  },
            complete: function() {  $("body").removeClass("loading"); },
            success:function(response)
            {
                swal("Success!", response.message, "success")
                console.log(response)
                // $('#mpcountendorsement').val(response.count_endorsement);
                var real_ceding_share = response.ceding_share.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('#mpshare').val(real_ceding_share);

                // $('#addinsuredsave-btn').attr('hidden','true');

                // $('#addinsuredsave-btn').val('Update');
                $("#addinsuredsave-btn").html('Update');
                window.location.href = "{{ url('transaction-data/mp/detailform/')}}/"+btoa(response.id);    
                // if(response.done == 1){
                //     refreshTableSlip(fesnumber)
                // }

            },
            error: function (request, status, error) {
                        //alert(request.responseText);
                        swal("Error!"+ request.responseText , "Insured Fire & Engineering Insured Insert Error, please check input", "Insert Error");
                    }
                });
        }


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
                            
                 
                            if(endorsmentdetail == max_endorsement)
                            {                           
                                if(date_transfer == null)
                                {
                                    
                                    if(statusdetail == 'cancel' || statusdetail == 'decline')
                                    {
                                        button += "";
                                        
                                    }
                                    if(statusdetail == 'proposal'){
                                        button += '<button type="button" id="btnSlip" data-id="'+id_detail+'" class="btn btn-sm btn-primary float-right">Slip</button>';
                                    }
                                    else if(statusdetail != 'endorsement' )
                                    {
                                        button += '<a class="text-primary mr-3 float-right" data-toggle="modal" data-book-id="'+id_detail+'" data-target="#cancelmodaldata"> <button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#cancelmodaldata2">Cancel</button></a>';
                                    }
                                    

                                    if(warning_flag == 1){
                                        button += '<label class="text text-danger"><i class="fa fa-exclamation-triangle"></i> Must Change</label>';
                                    }

                                    if(statusdetail == 'cancel' || statusdetail == 'decline')
                                    {
                                        button += '<a class="text-primary mr-3 float-right" data-toggle="modal"  data-book-id="'+id_detail+'" data-target="#detailmodaldata" href="#detailmodaldata">'
                                        +'<button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#detailmodaldata2">Detail</button>'
                                        +'</a>'  
                                    } 
                                    else
                                    {
                                        button += '<a class="text-primary mr-3 float-right" data-toggle="modal"  data-book-id="'+id_detail+'" data-target="#detailmodaldata" href="#detailmodaldata">'

                                        +'<button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#detailmodaldata2">Detail</button>'
                                        +'</a>'
                                        +'<button type="button" class="btn btn-sm btn-primary float-right" id="btnTransferDate" data-id="'+id_detail+'">Transfer Date</button>'
                                        +'<a class="text-primary mr-3 float-right " data-toggle="modal" data-book-id="'+id_detail+'" data-target="#updatemodaldata">'
                                        +'<button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#updatemodaldata2">Edit</button>'
                                        +'</a>'
                                    }
                                        
                                    
                                }
                                else if(date_transfer != null)
                                {
                                    if(statusdetail == 'cancel' || statusdetail == 'decline')
                                    {
                                        button += '<a class="text-primary mr-3 float-right" data-toggle="modal"  data-book-id="'+id_detail+'" data-target="#detailmodaldata" href="#detailmodaldata">'
                                        +'<button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#detailmodaldata2">Detail</button>'
                                        +'</a>'
                                        +'<a class="text-primary mr-3 float-right " data-toggle="modal" data-book-id="'+id_detail+'" data-target="#endorsementmodaldata">'
                                        +'<button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#endorsementmodaldata2">Endorsement</button>'
                                        +'</a>';
                                    }else
                                    {
                                        if(warning_flag == 1)
                                        {
                                            button += '<button type="button" id="change-must" class="btn btn-sm btn-danger float-right">Must Change</button>';
                                        }
                                        button += '<a class="text-primary mr-3 float-right" data-toggle="modal"  data-book-id="'+id_detail+'" data-target="#detailmodaldata" href="#detailmodaldata">'
                                        +'<button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#detailmodaldata2">Detail</button>'
                                        +'</a>'
                                        +'<a class="text-primary mr-3 float-right " data-toggle="modal" data-book-id="'+id_detail+'" data-target="#endorsementmodaldata">'
                                        +'<button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#endorsementmodaldata2">Endorsement</button>'
                                        +'</a>'
                                    }
                                }
                            }
                            else
                            {
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

{{-- save form end --}}
<script type="text/javascript">
    function getTsi(){
        var percentceding = parseFloat($('#percentceding').val()) / 100 ;
        var valtsi = $('#mpshareto').val();

        if(valtsi != null){
            var tsi = $('#mpshareto').val();
            var conv_tsi = parseFloat(tsi.replace(/,/g, ""));

            var sum_amount = isNaN(percentceding * conv_tsi) ? 0 :(percentceding * conv_tsi);
            var real_sum = sum_amount.toString().replace(/\B(?=(\d{3})+(?!\d)+\.)/g,",");
            console.log('amountlocation ' + real_sum);
            console.log('amountlocation ' + floatToString(parseFloat(sum_amount).toFixed(2)));
            $('#amountlocation').val(amountToString(sum_amount));
        }
        else
        {
            swal('warning!','please fill TSI insured first','error')
        }
    }
    function getPercentTsi(){
        var amountlocation = $('#amountlocation').val();
            var conv_amountlocation = parseFloat(amountlocation.replace(/,/g, ""));
            console.log(amountlocation)
            console.log(conv_amountlocation)
            var valtsi = $('#mpshareto').val();

            if(valtsi != null){
                var tsi = $('#mpshareto').val();
                var conv_tsi = parseFloat(tsi.replace(/,/g, ""));

                var sum_amount = isNaN((conv_amountlocation / conv_tsi)*100) ? 0 :((conv_amountlocation / conv_tsi)*100);
                var real_sum = parseFloat(sum_amount).toFixed(2).toString();
                console.log(sum_amount)
                console.log(real_sum)
                $('#percentceding').val(floatToString(real_sum));
            }else{
                swal('warning!','please fill TSI insured first','error')
            }   
    }
</script>