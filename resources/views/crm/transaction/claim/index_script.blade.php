<link rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"
  integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw=="
  crossorigin="anonymous" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"
  integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ=="
  crossorigin="anonymous"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

<link href="{{ asset('css/select2.css') }}" rel="stylesheet" />
<script src="{{ asset('/js/select2.js') }}"></script>

<link href="{{ asset('css/sweetalert2.min.css') }}" rel="stylesheet" />
<script src="{{ asset('/js/sweetalert2.all.min.js') }}"></script>


{{-- JS FILE --}}
<script src="{{ asset('/js/claim/filter_section.js') }}"></script>
<script src="{{ asset('/js/claim/filter_section_retrieve.js') }}"></script>

<script src="{{ asset('/js/claim/other_section.js') }}"></script>

<script src="{{ asset('/js/claim/main_section.js') }}"></script>
<script src="{{ asset('/js/claim/main_section_slip.js') }}"></script>
<script src="{{ asset('/js/claim/main_section_add_claim.js') }}"></script>
<script src="{{ asset('/js/claim/main_section_multi.js') }}"></script>
<script src="{{ asset('/js/claim/main_section_prev_next.js') }}"></script>
<script src="{{ asset('/js/claim/main_section_add_description_loss.js') }}"></script>
<script src="{{ asset('/js/claim/main_section_correction.js') }}"></script>
<script src="{{ asset('/js/claim/main_section_change_document.js') }}"></script>
<script src="{{ asset('/js/claim/main_section_print.js') }}"></script>


<style type="text/css">
  /* Chrome, Safari, Edge, Opera */
  input::-webkit-outer-spin-button,
  input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
  }

  /* Firefox */
  input[type=number] {
    -moz-appearance: textfield;
  }
</style>

<script type="text/javascript">
  var statusflag = $('#statusflag').val()
  var pla_nasre_liab;
  var pla_nasre_liabdesc;
  var pla_nasre_share_loss;
  var pla_ced_share;
  var pla_total_loss_amount;
</script>

<script type="text/javascript">
  $('input.amount').keyup(function(event) {
    // skip for arrow keys
    if (event.which >= 37 && event.which <= 40) return;
    // console.log(event.which)
    // console.log($(this).val())
    // format number
    $(this).val(function(index, value) {
      return value.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    });
  });

  // $('input.tanggal').mask("##/##/####", {
  //   mask: "1/2/y",
  //   placeholder: "dd/mm/yyyy",
  //   leapday: "-02-29",
  //   separator: "/",
  //   alias: "dd/mm/yyyy"
  // });


  // $(".money").click(function() {
  //   var inputLength = $(".money").val().length;
  //   setCaretToPos($(".money")[0], inputLength)
  // });


  $(".uang").keyup(function() {
    $('.uang').mask("#,##0.00", {
      reverse: true
    });
    console.log($('#slipvbroker').val())

  });
</script>

<script type="text/javascript">
  $('#nationalresliab').keyup(function(e) {
    if (e.keyCode != 9) {
      var shareslip = parseFloat($(this).val()) / 100;
      var tsi = $("#totallossamount").val();
      var conv_tsi = parseFloat(tsi.replace(/,/g, ""));
      var sumshare = isNaN(shareslip * conv_tsi) ? 0 : (shareslip * conv_tsi).toFixed(2);
      var real_sumshare = sumshare.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

      $('#shareonloss').val(real_sumshare).change();
    }
  });
</script>

<script type="text/javascript">
  $('#totallossamount').keyup(function(e) {
    if (e.keyCode != 9) {

      var shareslip = parseFloat($("#nationalresliab").val()) / 100;
      var tsi = $("#totallossamount").val();
      var conv_tsi = parseFloat(tsi.replace(/,/g, ""));
      var sumshare = isNaN(shareslip * conv_tsi) ? 0 : (shareslip * conv_tsi).toFixed(2);
      var real_sumshare = sumshare.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


      $('#shareonloss').val(real_sumshare);
    }
  });
</script>


<script type="text/javascript">
  var slips = []
  var no_data = 0
  $(document).ready(function() {

    //alert('test3');

    $('#checkriskamount').click(function() {
      if ($(this).prop("checked") == true) {
        console.log("Checkbox is checked.");
        $('#amounttablerisk').attr('readonly', false);
      } else if ($(this).prop("checked") == false) {
        console.log("Checkbox is unchecked.");
        $('#amounttablerisk').attr('readonly', true);
      }
    });

    $('.datepicker').datepicker({
      format: 'dd/mm/yyyy',
    });
    $(".e1").select2({width: '100%'});

    var slipnumberdata = $('#slipnumberdata').val();
    $dateinsurance = "";
    $datereinsurance = "";

  });
</script>


<style type="text/css">
  /* Chrome, Safari, Edge, Opera */
  input::-webkit-outer-spin-button,
  input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
  }

  /* Firefox */
  input[type=number] {
    -moz-appearance: textfield;
  }
</style>


<script type="text/javascript">
  function treatAsUTC(date) {
    var result = new Date(date);
    result.setMinutes(result.getMinutes() - result.getTimezoneOffset());
    return result;
  }

  function daysBetween(startDate, endDate) {
    var millisecondsPerDay = 24 * 60 * 60 * 1000;
    return (treatAsUTC(endDate) - treatAsUTC(startDate)) / millisecondsPerDay;
  }
</script>



<script type="text/javascript">
  function getid(id) {
    $('#selectedslipid').val(id)
  }
  //triggered when modal is about to be shown
  $('#detailmodaldata').on('show.bs.modal',async function(e) {

    //get data-id attribute of the clicked element
    //var codesl = $(e.relatedTarget).data('book-id');
    //alert(codesl);

    var slipnumberdata = $('#selectedslip').val();
    // var slipnumberdata = $('#slipnumberdata').val();
    // console.log(e, 'it');

    if (slipnumberdata) {
      $("body").addClass("loading");
      var insuredslip = await axios.get('/claimtransaction-data/'+doctype+'/getInsuredandRiskLocation/' + slipnumberdata).then((res) => {
        console.log(res.data);
        $("#feuy").val(res.data.insureddata.uy)
        $("#insurednumber").val(res.data.insured_id)

        if (res.data.insureddata?.prefixinsured?.code && res.data.insureddata?.prefixinsured?.name) {
          var _prefix = res.data.insureddata.prefixinsured.code + " - " + res.data.insureddata.prefixinsured
            .name
        } else {
          var _prefix = '-'
        }

        $("#insuredprefix").val(_prefix)

        $("#insuredname").val(res.data.insureddata.insured_name)
        $("#insuredsuffix").val(res.data.insureddata.insured_suffix)

        $("#insuredsharefrom").val(res.data.insureddata.share_from)
        $("#insuredshareto").val(res.data.insureddata.share_to)
        $("#insuredshare").val(res.data.insureddata.share)

        if (res.data.insureddata?.currency?.code && res.data.insureddata?.currency?.symbol_name) {
          var _curr = res.data.insureddata.currency.code + " - " + res.data.insureddata.currency.symbol_name
        } else {
          var _curr = '-'
        }

        $("#insuredcurrency").val(_curr)
        return res.data
        })
      if (doctype == "mc") {
        $('#shipbody').empty()
        // console.log('here', insuredslip.ships);
        var ships = _.groupBy(insuredslip.ships, 'name')
        _.each(ships, function (ship, key) {
          console.log('here', ship, key);
          $('#shipbody').append(`
          <tr>
            <td>${ship[0].slip.ceding.name}</td>
            <td>${ship[0].insured.insured_name}</td>
            <td>${ship[0].name}</td>
          </tr>
          <tr style="border-bottom: 2px black solid;">
          <td width='15%'></td>
          <td colspan="2">
              <table class="table table-bordered table-striped" style="table-layout: fixed;">
                  <thead>
                      <tr>
                          <th width='15%'>Interest Insured</th>
                          <th width='20%'>Ceding Source</th>
                          <th>CN/DN</th>
                          <th>Cert No</th>
                          <th>Slip No</th>
                          <th>Policy No</th>
                          <th>Share%</th>
                          <th width='15%'>Amount</th>
                      </tr>
                  </thead>
                  <tbody id='slipinsured${ship[0].id}'></tbody>
              </table>
          </td>
      </tr>
          `)
          _.each(ship, function (shp, asd) {
            _.each(shp.interest, function(ins,_key){
                console.log('ins', ins);
              $("#slipinsured"+ins.ship_id).append(`
                <tr>
                    <td>${ins?.interestinsureddata?.code || ""} - ${
                    ins?.interestinsureddata?.description || ""
                }</td>
                    <td>${ins?.cedingdata?.company_name}</td>
                    <td>${ins.cndn ?? "-"}</td>
                    <td>${ins.certno ?? "-"}</td>
                    <td>${ins.slipno ?? "-"}</td>
                    <td>${ins.policyno ?? "-"}</td>
                    <td>${Number(ins.percent).toFixed(2)}%</td>
                
                    <td>${ins.amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</td>
                    </td>
                </tr>
                `);
              })
          })
        })
      } else if (doctype == "mh"){
        $('#shipbody').empty()
        insuredslip.ships.forEach(ship => {
          $('#shipbody').append(
          `
          <tr>
          <input type='hidden' id='share${ship.insured.slip.number}${
                ship.id
            }' value='${ship.percent}'>
            <input type='hidden' id='ship${ship.insured.slip.number}${
                ship.id
            }' value='${ship.id}'>
            <input type='hidden' id='amount${ship.insured.slip.number}${
                ship.id
            }' value='${ship.amount}'>
            <input type='hidden' id='koc${ship.insured.slip.number}${
                ship.id
            }' value='${ship.insured.slip.koc}'>
            <input type='hidden' id='cob${ship.insured.slip.number}${
                ship.id
            }' value='${ship.insured.slip.cob}'>
            <input type='hidden' id='cedingdata${
                ship.insured.slip.number
            }${ship.id}' value='${ship.ceding_id}'>
            <td>${ship.cedingdata.name}</td>
            <td>${ship.insured.insured_name}</td>
            <td>${ship.ship_name}</td>
            <td>${ship.cndn || "-"}</td>
            <td>${ship.certno || "-"}</td>
            <td>${ship.slipno || "-"}</td>
            <td>${ship.policyno || "-"}</td>
            <td>${Number(ship.percent).toFixed(2)}%</td>
            <td>${ship.amount
                .toString()
                .replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</td>
          </tr>
            `
        );
        });
        
      }
      else {
          $("#locationslist").empty();
          insuredslip.insureddata.locations.forEach((loc, index) => {
            $("#locationslist").append(`
            <tr>
              <td>${loc.felookuplocation.loc_code}</td>
              <td>${loc.felookuplocation.address}</td>
              <td>${loc.felookuplocation.latitude} - ${loc.felookuplocation.longtitude}</td>
            </tr>
            <tr>
              <td></td>
              <td colspan=2>
                <table class="table table-bordered table-striped" style="table-layout: fixed;">
                  <tr>
                    <th>Ceding Source</th>
                    <th>Interest Insured</th>
                    <th>CN/DN</th>
                    <th>Cert No</th>
                    <th>Slip No</th>
                    <th>Policy No</th>
                    <th>Share %</th>
                    <th>Amount</th>
                  </tr>
                  <tbody id="risklocation${index}"></tbody>  
                </table>  
              </td>
            </tr>
           `)
            $("#risklocation" + index).empty();
            loc.risklocationdetail.forEach(rld => {
              $("#risklocation" + index).append(`
                  <tr>
                    <td>${rld.cedingbroker.name}</td>
                    <td>${rld.interestdata.code} - ${rld.interestdata.description}</td>
                    <td>${rld.cndn ?? '-'}</td>
                    <td>${rld.certno ?? '-'}</td>
                    <td>${rld.slipno ?? '-'}</td>
                    <td>${rld.policyno ?? '-'}</td>
                    <td>${Number(rld.percentage).toFixed(2)}%</td>
                    <td>${rld.amountlocation.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</td>
                  </tr>
              `);
            });
          });
        
      }

      if(doctype == "mc" || doctype == "mh") {
            $.ajax({
            url:'{{ url("/") }}/transaction-data/detailmarinehullslip/'+$('#selectedslipid').val(),
            type:"GET",
            beforeSend: function() { $("body").addClass("loading");  },
            complete: function() {  $("body").removeClass("loading"); },
            success:function(response)
            {
                console.log('bisa tampil')
                console.log(response);
                console.log('number : ' + response.number);
                $('#numberslipdetail').val(response.number);
                $('#slipusernamedetail').val(response.username);
                $('#slipprodyeardetail').val(response.prod_year);
                $('#slipuydetail').val(response.uy);
                $('#slipeddetail').val(response.endorsment);
                $('#slipslsdetail').val(response.selisih);
                $('#wpcdetail').val(response.wpc);
                $('#slipvbrokerdetail').val(response.v_broker);


                    if(response.deductible_panel && response.deductible_panel.length > 10)
                    {

                        var deductibledata = JSON.parse(response.deductible_panel); 
                        $('#deductiblePaneldetail tbody').empty();
                        for(var i = 0; i < deductibledata.length; i++) 
                        {
                            var obj = deductibledata[i];

                            //console.log(obj.id);
                            //$('#interestInsuredTabledetail tbody').prepend('');
                            // var curr_amount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(obj.amount);
                            if(obj.amount)
                            {
                            var conv_amount = parseFloat(obj.amount).toFixed(2);
                            var str_amount = conv_amount.toString();
                            var curr_amount = str_amount.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            
                            // var curr_minamount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(obj.min_claimamount);
                            var conv_minamount = parseFloat(obj.min_claimamount).toFixed(2);
                            var str_minamount = conv_minamount.toString();
                            var curr_minamount = str_minamount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            // var curr_minamount = obj.min_claimamount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            var conv_percent = parseFloat(obj.percentage).toFixed(2);
                            

                            $('#deductiblePaneldetail tbody').prepend('<tr id="iiddeductible'+obj.id+'" data-name="deductibledetailvalue[]"><td data-name="'+obj.deductibletype+'">'+obj.deductibletype+'</td><td data-name="'+obj.percentage+'">'+conv_percent+'%</td><td data-name="'+curr_amount+'">'+curr_amount+'</td><td data-name="'+curr_minamount+'">'+curr_minamount+'</td><td></td></tr>');
                            }
                        }
                    }


                    if(response.condition_needed && response.condition_needed.length > 10)
                    {

                        var condition_needed = JSON.parse(response.condition_needed); 
                        $('#ConditionNeededDetail tbody').empty();
                        for(var i = 0; i < condition_needed.length; i++) 
                        {
                            var obj = condition_needed[i];

                            //console.log(obj.id);
                            //$('#interestInsuredTabledetail tbody').prepend('');
                            // var curr_amount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(obj.amount);
                            //var conv_amount = obj.amount.toFixed(2);
                            //var str_amount = conv_amount.toString();
                            //var curr_amount = str_amount.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            // var curr_amount = obj.amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            //var conv_percent = parseFloat(obj.percentage).toFixed(3);
                            
                            $('#ConditionNeededDetail tbody').prepend('<tr id="cniddetail'+obj.id+'" data-name="extendcoveragedetailvalue[]"><td data-name="'+obj.cncode+'">'+obj.cncode + ' - ' + obj.cnname+'</td><td data-name="'+obj.cndesc+'">'+obj.cndesc+'</td></tr>');
                            
                        }
                    }


                    if(response.installment_panel && response.installment_panel.length > 10)
                    {

                        var installment_panel = JSON.parse(response.installment_panel); 
                        $('#installmentPaneldetail tbody').empty();
                        for(var i = 0; i < installment_panel.length; i++) 
                        {
                            var obj = installment_panel[i];
                            // var curr_amount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(obj.amount);
                            // var conv_amount = obj.amount.toFixed(2);
                            // var str_amount = conv_amount.toString();
                            // var curr_amount = str_amount.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        
                            var conv_amount = parseFloat(obj.amount).toFixed(2);
                            var curr_amount = conv_amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                            var currdate = obj.installment_date;
                            var convdate = currdate.split("-").reverse().join("/");
                            console.log('conv date ' + convdate)
                            var strdate = convdate.toString();

                            var conv_percent = parseFloat(obj.percentage).toFixed(2);

                            //console.log(obj.id);
                            //$('#interestInsuredTabledetail tbody').prepend('');
                        
                            
                            $('#installmentPaneldetail tbody').prepend('<tr id="iidinstallmentdetail'+obj.id+'" data-name="installmentdetailvalue[]"><td data-name="'+obj.installment_date+'">'+strdate+'</td><td data-name="'+obj.percentage+'">'+conv_percent+'%</td><td data-name="'+curr_amount+'">'+curr_amount+'</td><td></td></tr>')

                        }
                    }


                    if(response.hull_data && response.hull_data.length > 10)
                    {
                        var hull_panel = JSON.parse(response.hull_data); 
                        $('#marineHullCountTableDetail tbody').empty();
                        for(var i = 0; i < hull_panel.length; i++) 
                        {
                            var obj = hull_panel[i];

                            
                            $('#marineHullCountTableDetail > tbody:last-child').prepend('<tr id="hcdetailid'+obj.id+'"  data-name="">'+
                                        '<td>'+obj.hullcode+ '-' + obj.hulltype + '-' + obj.hullketerangan +'</td>'+
                                        '<td>'+obj.share+'</td>'+
                                        '<td>'+obj.amount+'</td>'+
                                        '<td>'+obj.rate+'</td>'+
                                        '<td>'+obj.basic_premium+'</td>'+
                                        '</tr>')

                        }
                    }

                
                    if(response.retrocession_panel && response.retrocession_panel.length > 10)
                    {

                        var retrocession_panel = JSON.parse(response.retrocession_panel); 
                        $('#retrocessionPaneldetail tbody').empty();
                        for(var i = 0; i < retrocession_panel.length; i++) 
                        {
                            var obj = retrocession_panel[i];
                            // var curr_amount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(obj.amount);
                            if(obj.amount)
                            {
                                var conv_amount = parseFloat(obj.amount).toFixed(2);
                                var str_amount = conv_amount.toString();
                                var curr_amount = str_amount.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                // var curr_amount = obj.amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                var conv_percent = parseFloat(obj.percentage).toFixed(2);

                                //console.log(obj.id);
                                //$('#interestInsuredTabledetail tbody').prepend('');
                            }
                            
                            
                            $('#retrocessionPaneldetail tbody').prepend('<tr id="iidretrocessiondetail'+obj.id+'" data-name="retrocessiondetailvalue[]"><td data-name="'+obj.type+'">'+obj.type+'</td><td data-name="'+obj.contract+'">'+obj.contract+'</td><td data-name="'+obj.percentage+'">'+conv_percent+'%</td><td data-name="'+curr_amount+'">'+curr_amount+'</td><td></td></tr>');

                        }
                    }
                    
                    
                    if(response.status)
                    {
                        $("#slipstatusdetail").val(response.status);
                        
                    // $("#slipstatusdetail option").attr('hidden',true);
                    // $("#slipstatusdetail option[value=" + response.status + "]:first")[0].hidden = false;
                    // $("#slipstatusdetail option[value=" + response.status + "]:first")[0].selected = true;
                    }

                    if(response.source)
                    {
                        $("#slipcedingbrokerdetail option").attr('hidden',true);
                        $("#slipcedingbrokerdetail option[value=" + response.source + "]:first")[0].hidden = false;
                        $("#slipcedingbrokerdetail option[value=" + response.source + "]:first")[0].selected = true;
                    }

                    if(response.source_2)
                    {
                        $("#slipcedingdetail option").attr('hidden',true);
                        $("#slipcedingdetail option[value=" + response.source_2 + "]:first")[0].hidden = false;
                        $("#slipcedingdetail option[value=" + response.source_2 + "]:first")[0].selected = true;
                    }

                    if(response.currency)
                    {
                      $("#slipcurrencydetail").val(response.currency).change();
                        // $("#slipcurrencydetail option[value=" + response.currency + "]:first")[0].selected = true;
                    }
                    
                    if(response.cob)
                    {
                      $("#slipcobdetail").val(response.cob).change();
                        // $("#slipcobdetail option[value=" + response.cob + "]:first")[0].selected = true;
                    }

                

                    if(response.occupacy)
                    {
                        $("#slipoccupacydetail option[value=" + response.occupacy + "]:first")[0].selected = true;
                    }

                    if(response.build_const)
                    {
                        $("#slipbld_constdetail option").attr('hidden',true);
                        $("#slipbld_constdetail option[value='" + response.build_const + "']:first")[0].hidden = false;
                        $("#slipbld_constdetail option[value='" + response.build_const + "']:first")[0].selected = true;
                    }

                    $("#slipbcuadetail").val(response.build_rate_up);
                    $("#slipbcladetail").val(response.build_rate_down);

                    if(response.insured_type)
                    {
                        $("#sliptypedetail option[value=" + response.insured_type + "]:first")[0].selected = true;
                    }

                    if(response.layer_non_proportional)
                    {
                        $("#sliplayerproportionaldetail option[value=" + response.layer_non_proportional + "]:first")[0].selected = true;
                    }

                    

                    if(response.retro_backup)
                    {
                        $("#sliprbdetail option[value=" + response.retro_backup + "]:first")[0].selected = true;
                        if(response.retro_backup == "NO")
                        {
                            $("#tabretrodetail").attr('hidden','true');
                        }
                        else if(response.retro_backup == "YES"){
                            $("#tabretrodetail").removeAttr('hidden');
                        }
                    }

                    if(response.type_tsi)
                    {
                        $("#sliptypetsidetail option[value=" + response.type_tsi + "]:first")[0].selected = true;
                    }

                    if(response.type_share_tsi)
                    {
                        $("#sharetypetsidetail option[value=" + response.type_share_tsi + "]:first")[0].selected = true;
                    }


                    if(response.status_log){
                            $('#statuslogdetailform tbody').empty();
                            var status_log = response.status_log;
                            
                            for(var i = 0; i < status_log.length; i++){

                                var status = status_log[i].status;
                                var datetime = status_log[i].datetime;
                                var user = status_log[i].user;

                                $('#statuslogdetailform tbody').append('<tr id="stlid'+status_log[i].id+'"> <td>'+status+'</td> <td >'+ datetime +'</td> <td>'+user+'</td> </tr>')
                                // $('#statlistdetail').append('<li><div class="control-group input-group" id="control-group2" style="margin-top:10px">'+datetime+' - '+ status + ' - ' + user +'</div></li>')
                        
                        };
                    }

                    console.log('status log')
                    console.log(response.status_log)


                if(response.attacment_file)
                {
                    $('#aidlistdetail li').remove();
                    var attacment_file = response.attacment_file;
                    for(var i = 0; i < attacment_file.length; i++){
                        var filename = attacment_file[i].filename;
                        $('#aidlistdetail').append('<li><div class="control-group input-group" id="control-group2" style="margin-top:10px"><a href="{{ asset("files")}}/'+filename+'">'+filename+'</a></div></li>')
                    };
                }


                $('#slipnodetail').val(response.slip_no);
                $('#slipcndndetail').val(response.cn_dn);
                $('#slippolicy_nodetail').val(response.policy_no);
                if(response.total_sum_insured){
                    var conv_tsi = parseFloat(response.total_sum_insured).toFixed(2);
                    $('#sliptotalsumdetail').val(conv_tsi.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                }
                else
                {
                    $('#sliptotalsumdetail').val("0");
                }

                if(response.share_tsi){
                    var conv_stsi = parseFloat(response.share_tsi).toFixed(2);
                    $('#sharetotalsumdetail').val(conv_stsi.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                }
                else
                {
                    $('#sharetotalsumdetail').val("0");
                }

                if(response.insured_pct){
                    $('#slippctdetail').val( parseFloat(response.insured_pct).toFixed(2));
                }else{
                    $('#slippctdetail').val("0");
                }
                


                if(response.total_sum_pct){
                    var conv_spct = parseFloat(response.total_sum_pct).toFixed(2);
                    $('#sliptotalsumpctdetail').val(conv_spct.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                }
                else{
                    $('#sliptotalsumpctdetail').val("0");
                }

                if(response.date_transfer == null || response.date_transfer == "" ){
                  $('#sliptddetail').val(''); 
                } else{
                  $('#sliptddetail').val(response.date_transfer); 
                }
                
                $('#slipipfromdetail').val(response.insurance_period_from);
                $('#slipiptodetail').val(response.insurance_period_to);

                var insurance_period_from2 = response.insurance_period_from.split("/").reverse().join("-");
                var insurance_period_to2 = response.insurance_period_to.split("/").reverse().join("-");
                var days=daysBetween(insurance_period_from2, insurance_period_to2);
                
                var sum = isNaN(days / 365) ? 0 :(days / 365).toFixed(3);
                var constday = days.toString() + "/365";

                console.log(insurance_period_from2)
                console.log(insurance_period_to2)
                console.log(days)
                console.log(constday)
                console.log(parseFloat(sum))

                
                

                $('#slipdaytotaldetail').val(days);
                $('#slipdaytotaldetail2').val(days);
                $('#slipdaytotaldetail3').val("365");
                $('#slipdaytotaldetail4').val("365");
            
                $('#sliptotalsumdatedetail').val(parseFloat(sum));


                $('#sliprpfromdetail').val(response.reinsurance_period_from);
                $('#sliprptodetail').val(response.reinsurance_period_to);

                $('#switch-proportionaldetail').val(response.proportional);
                    // if(response.proportional == ''){
                $("#btnaddlayerdetail").attr('hidden','true');
                $("#sliplayerproportionaldetail").attr('hidden','true');
                $("#labelnonpropdetail").attr('hidden','true');
                $("#labelnpdetail").attr('hidden','true');
                    // }
                if(response.rate){
                    $('#slipratedetail').val(parseFloat(response.rate).toFixed(3));
                }else{
                    $('#slipratedetail').val("0");
                }
                
                if(response.share){
                    $('#slipsharedetail').val(parseFloat(response.share).toFixed(2));
                }else{
                    $('#slipsharedetail').val("0");
                }
                

                if(response.sum_share){
                    var conv_sshare = parseFloat(response.sum_share).toFixed(2);
                    $('#slipsumsharedetail').val(conv_sshare.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                    $('#slipsumsharedetail2').val(conv_sshare.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                }
                else{
                    $('#slipsumsharedetail').val("0");
                    $('#slipsumsharedetail2').val("0");
                }

                if(response.sum_rate){
                    var conv_srate = parseFloat(response.sum_rate).toFixed(3);
                    $('#sliptotalratedetail').val(conv_srate.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                    $('#sliptotalratedetail').val(conv_srate.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                }
                else{
                    $('#slipsumsharedetail').val("0");
                    $('#slipsumsharedetail2').val("0");
                }

                if(response.sum_feebroker){
                    var conv_sf = parseFloat(response.sum_feebroker).toFixed(2);
                    $('#slipsumfeedetail').val(conv_sf.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                    $('#slipsumfeedetail2').val(conv_sf.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                }
                else{
                    $('#slipsumfeedetail').val("0");
                    $('#slipsumfeedetail2').val("0");
                }


                if(response.basic_premium){
                    var conv_bp =  parseFloat(response.basic_premium).toFixed(2);
                    $('#slipbasicpremiumdetail').val(conv_bp.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                }else
                {
                    $('#slipbasicpremiumdetail').val("0");
                }
                
                if(response.grossprm_to_nr){
                    var conv_gprtnr = parseFloat(response.grossprm_to_nr).toFixed(2);
                    $('#slipgrossprmtonrdetail').val(conv_gprtnr.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                    $('#slipgrossprmtonrdetail2').val(conv_gprtnr.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                
                }
                else{
                    $('#slipgrossprmtonrdetail').val("0");
                    $('#slipgrossprmtonrdetail2').val("0");
                }

                if(response.commission){

                    $('#slipcommissiondetail').val(parseFloat(response.commission).toFixed(2));
                }
                else{
                    $('#slipcommissiondetail').val(0);
                }
                

                if(response.sum_commission){
                    var conv_sc = parseFloat(response.sum_commission).toFixed(2);
                    $('#slipsumcommissiondetail').val(conv_sc.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                    $('#slipsumcommissiondetail2').val(conv_sc.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                
                }
                else{
                    $('#slipsumcommissiondetail').val("0");
                    $('#slipsumcommissiondetail2').val("0");

                }

                if(response.netprm_to_nr){
                    var conv_nprmtnr = parseFloat(response.netprm_to_nr).toFixed(2);
                    $('#slipnetprmtonrdetail').val(conv_nprmtnr.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                    $('#slipnetprmtonrdetail2').val(conv_nprmtnr.replace(/\B(?=(\d{3})+(?!\d))/g, ",")); 
                }
                else{
                    $('#slipnetprmtonrdetail').val("0"); 
                    $('#slipnetprmtonrdetail2').val("0"); 
                }

                if(response.own_retention){
                    $('#slipordetail').val(parseFloat(response.own_retention).toFixed(2));
                }
                else{
                    $('#slipordetail').val(0);
                }

                if(response.sum_own_retention){
                    var conv_sor = parseFloat(response.sum_own_retention).toFixed(2);
                    $('#slipsumordetail').val(conv_sor.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                }
                else{
                    $('#slipsumordetail').val("0");
                }

                $('#countendorsmentdetail').val(response.endorsment);
                $('#countendorsmentdetail2').val(response.endorsment);
                $('#remarksdetail').val(response.remarks);
                
                if(response.koc)
                {
                    if($("#slipkocdetail option[value=" + response.koc + "]:first")[0])
                    {
                    $("#slipkocdetail option[value=" + response.koc + "]:first")[0].selected = true;
                    }
                }
                
                swal("Success!", "Data Show")
                console.log(response)


                },
                error: function (request, status, error) {
                    //alert(request.responseText);
                    swal("Error!", "Get Slip Data Error", "Get Data Error");
                }
            });

        } else {
          $.ajax({
            url: '{{ url('/') }}/transaction-data/detailslipnumber/' + slipnumberdata,
            type: "GET",
            beforeSend: function() {
              $("body").addClass("loading");
            },
            complete: function() {
              $("body").removeClass("loading");
            },
            success: function(response) {
              console.log('bisa tampil');
              console.log(response);
              $('#slipnumberdetail').val(response.number);
              $('#slipusernamedetail').val(response.username);
              $('#slipprodyeardetail').val(response.prod_year);
              $('#slipuydetail').val(response.uy);
              $('#slipeddetail').val(response.endorsment);
              $('#slipslsdetail').val(response.selisih);
              $('#wpcdetail').val(response.wpc);

              $('#slipvbrokerdetail').val(response.v_broker);


              if (response.deductible_panel && response.deductible_panel.length > 10) {

                var deductibledata = JSON.parse(response.deductible_panel);
                $('#deductiblePaneldetail tbody').empty();
                for (var i = 0; i < deductibledata.length; i++) {
                  var obj = deductibledata[i];

                  console.log(obj);
                  //$('#interestInsuredTabledetail tbody').prepend('');
                  // var curr_amount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(obj.amount);
                  var conv_amount = parseFloat(obj.amount).toFixed(2);
                  var str_amount = conv_amount.toString();
                  var curr_amount = str_amount.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                  // var curr_minamount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(obj.min_claimamount);
                  var conv_minamount = parseFloat(obj.min_claimamount).toFixed(2);
                  var str_minamount = conv_minamount.toString();
                  var curr_minamount = str_minamount.toString().replace(
                    /\B(?=(\d{3})+(?!\d))/g, ",");
                  // var curr_minamount = obj.min_claimamount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                  $('#deductiblePaneldetail tbody').prepend('<tr id="iiddeductible' + obj
                    .id + '" data-name="deductibledetailvalue[]"><td data-name="' +
                    obj.deductibletype + '">' + obj.deductibletype +
                    '</td><td data-name="' + obj.percentage + '">' + obj
                    .percentage + '</td><td data-name="' + curr_amount + '">' +
                    curr_amount + '</td><td data-name="' + curr_minamount + '">' +
                    curr_minamount + '</td><td></td></tr>');

                }
              }


              if (response.extend_coverage && response.extend_coverage.length > 10) {

                var extend_coverage = JSON.parse(response.extend_coverage);
                $('#ExtendCoveragePaneldetail tbody').empty();
                for (var i = 0; i < extend_coverage.length; i++) {
                  var obj = extend_coverage[i];

                  //console.log(obj.id);
                  //$('#interestInsuredTabledetail tbody').prepend('');
                  // var curr_amount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(obj.amount);
                  var conv_amount = parseFloat(obj.amount).toFixed(2);
                  var str_amount = conv_amount.toString();
                  var curr_amount = str_amount.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                  // var curr_amount = obj.amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                  $('#ExtendCoveragePaneldetail tbody').prepend(
                    '<tr id="iidextendcoveragedetail' + obj.id +
                    '" data-name="extendcoveragedetailvalue[]"><td data-name="' +
                    obj.coveragetype + '">' + obj.coveragecode + ' - ' + obj
                    .coveragename + '</td><td data-name="' + obj.percentage + '">' +
                    obj.percentage + '</td><td data-name="' + curr_amount + '">' +
                    curr_amount + '</td><td></td></tr>');

                }
              }


              if (response.installment_panel && response.installment_panel.length > 10) {

                var installment_panel = JSON.parse(response.installment_panel);
                $('#installmentPaneldetail tbody').empty();
                for (var i = 0; i < installment_panel.length; i++) {
                  var obj = installment_panel[i];
                  // var curr_amount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(obj.amount);
                  // var conv_amount = obj.amount.toFixed(2);
                  // var str_amount = conv_amount.toString();
                  // var curr_amount = str_amount.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                  var curr_amount = obj.amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g,
                    ",");

                  var currdate = obj.installment_date;
                  var convdate = currdate.split("-").reverse().join("/");
                  // console.log('conv date ' + convdate)
                  var strdate = convdate.toString();

                  //console.log(obj.id);
                  //$('#interestInsuredTabledetail tbody').prepend('');

                  $('#installmentPaneldetail tbody').prepend(
                    '<tr id="iidinstallmentdetail' + obj.id +
                    '" data-name="installmentdetailvalue[]"><td data-name="' + obj
                    .installment_date + '">' + strdate + '</td><td data-name="' +
                    obj.percentage + '">' + obj.percentage +
                    '</td><td data-name="' + curr_amount + '">' + curr_amount +
                    '</td><td></td></tr>')

                }
              }



              if (response.retrocession_panel && response.retrocession_panel.length > 10) {

                var retrocession_panel = JSON.parse(response.retrocession_panel);
                $('#retrocessionPaneldetail tbody').empty();
                for (var i = 0; i < retrocession_panel.length; i++) {
                  var obj = retrocession_panel[i];
                  // var curr_amount = new Intl.NumberFormat('id-ID',  {style: 'currency',currency: 'IDR',}).format(obj.amount);
                  var conv_amount = parseFloat(obj.amount).toFixed(2);
                  var str_amount = conv_amount.toString();
                  var curr_amount = str_amount.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                  // var curr_amount = obj.amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                  //console.log(obj.id);
                  //$('#interestInsuredTabledetail tbody').prepend('');


                  $('#retrocessionPaneldetail tbody').prepend(
                    '<tr id="iidretrocessiondetail' + obj.id +
                    '" data-name="retrocessiondetailvalue[]"><td data-name="' + obj
                    .type + '">' + obj.type + '</td><td data-name="' + obj
                    .contract + '">' + obj.contract + '</td><td data-name="' + obj
                    .percentage + '">' + obj.percentage + '</td><td data-name="' +
                    curr_amount + '">' + curr_amount + '</td><td></td></tr>');

                }
              }


              if (response.status) {
                $("#slipstatusdetail").val(response.status);

                // $("#slipstatusdetail option").attr('hidden',true);
                // $("#slipstatusdetail option[value=" + response.status + "]:first")[0].hidden = false;
                // $("#slipstatusdetail option[value=" + response.status + "]:first")[0].selected = true;
              }

              if (response.source) {
                $("#slipcedingbrokerdetail option").attr('hidden', true);
                $("#slipcedingbrokerdetail option[value=" + response.source + "]:first")[0]
                  .hidden = false;
                $("#slipcedingbrokerdetail option[value=" + response.source + "]:first")[0]
                  .selected = true;
              }

              if (response.source_2) {
                $("#slipcedingdetail option").attr('hidden', true);
                $("#slipcedingdetail option[value=" + response.source_2 + "]:first")[0]
                  .hidden = false;
                $("#slipcedingdetail option[value=" + response.source_2 + "]:first")[0]
                  .selected = true;
              }

              if (response.currency) {
                $("#slipcurrencydetail option[value=" + response.currency + "]:first")[0]
                  .selected = true;
              }

              if (response.cob) {
                $("#slipcobdetail option[value=" + response.cob + "]:first")[0].selected = true;
              }

              if (response.koc) {
                $("#slipkocdetail option[value=" + response.koc + "]:first")[0].selected = true;
              }

              if (response.occupacy) {
                $("#slipoccupacydetail option[value=" + response.occupacy + "]:first")[0]
                  .selected = true;
              }

              if (response.build_const) {
                $("#slipbld_constdetail option").attr('hidden', true);
                $("#slipbld_constdetail option[value='" + response.build_const +
                  "']:first")[0].hidden = false;
                $("#slipbld_constdetail option[value='" + response.build_const +
                  "']:first")[0].selected = true;
              }

              $("#slipbcuadetail").val(response.build_rate_up);
              $("#slipbcladetail").val(response.build_rate_down);

              if (response.insured_type) {
                $("#sliptypedetail option[value=" + response.insured_type + "]:first")[0]
                  .selected = true;
              }

              if (response.layer_non_proportional) {
                $("#sliplayerproportionaldetail option[value=" + response
                  .layer_non_proportional + "]:first")[0].selected = true;
              }



              if (response.retro_backup) {
                $("#sliprbdetail option[value=" + response.retro_backup + "]:first")[0]
                  .selected = true;
                if (response.retro_backup == "NO") {
                  $("#tabretrodetail").attr('hidden', 'true');
                } else if (response.retro_backup == "YES") {
                  $("#tabretrodetail").removeAttr('hidden');
                }
              }

              if (response.type_tsi) {
                $("#sliptypetsidetail option[value=" + response.type_tsi + "]:first")[0]
                  .selected = true;
              }

              if (response.type_share_tsi) {
                $("#sharetypetsidetail option[value=" + response.type_share_tsi +
                  "]:first")[0].selected = true;
              }


              if (response.status_log) {
                $('#statuslogdetailform tbody').empty();
                var status_log = response.status_log;

                for (var i = 0; i < status_log.length; i++) {

                  var status = status_log[i].status;
                  var datetime = status_log[i].datetime;
                  var user = status_log[i].user;

                  $('#statuslogdetailform tbody').append('<tr id="stlid' + status_log[i]
                    .id + '"> <td>' + status + '</td> <td >' + datetime +
                    '</td> <td>' + user + '</td> </tr>')
                  // $('#statlistdetail').append('<li><div class="control-group input-group" id="control-group2" style="margin-top:10px">'+datetime+' - '+ status + ' - ' + user +'</div></li>')

                };
              }

              // console.log('status log')
              // console.log(response.status_log)


              if (response.attacment_file) {
                $('#aidlistdetail li').remove();
                var attacment_file = response.attacment_file;
                for (var i = 0; i < attacment_file.length; i++) {
                  var filename = attacment_file[i].filename;
                  $('#aidlistdetail').append(
                    '<li><div class="control-group input-group" id="control-group2" style="margin-top:10px"><a href="{{ asset('files') }}/' +
                    filename + '">' + filename + '</a></div></li>')
                };
              }


              $('#slipnodetail').val(response.slip_no);
              $('#slipcndndetail').val(response.cn_dn);
              $('#slippolicy_nodetail').val(response.policy_no);
              if (response.total_sum_insured) {
                $('#sliptotalsumdetail').val(response.total_sum_insured.replace(
                  /\B(?=(\d{3})+(?!\d))/g, ","));
              } else {
                $('#sliptotalsumdetail').val("0");
              }

              if (response.share_tsi) {
                $('#sharetotalsumdetail').val(response.share_tsi.replace(
                  /\B(?=(\d{3})+(?!\d))/g, ","));
              } else {
                $('#sharetotalsumdetail').val("0");
              }


              $('#slippctdetail').val(response.insured_pct);
              if (response.total_sum_pct) {
                $('#sliptotalsumpctdetail').val(response.total_sum_pct.replace(
                  /\B(?=(\d{3})+(?!\d))/g, ","));
              } else {
                $('#sliptotalsumpctdetail').val("0");
              }

              if (response.date_transfer == null || response.date_transfer == "") {
                $('#sliptddetail').val('');
              } else {
                $('#sliptddetail').val(response.date_transfer);
              }

              $('#slipipfromdetail').val(response.insurance_period_from);
              $('#slipiptodetail').val(response.insurance_period_to);

              var insurance_period_from2 = response.insurance_period_from.split("/").reverse()
                .join("-");
              var insurance_period_to2 = response.insurance_period_to.split("/").reverse()
                .join("-");
              var days = daysBetween(insurance_period_from2, insurance_period_to2);

              var sum = isNaN(days / 365) ? 0 : (days / 365).toFixed(3);
              var constday = days.toString() + "/365";

              // console.log(insurance_period_from2)
              // console.log(insurance_period_to2)
              // console.log(days)
              // console.log(constday)
              // console.log(parseFloat(sum))




              $('#slipdaytotaldetail').val(days);
              $('#slipdaytotaldetail2').val(days);
              $('#slipdaytotaldetail3').val("365");
              $('#slipdaytotaldetail4').val("365");

              $('#sliptotalsumdatedetail').val(parseFloat(sum));


              $('#sliprpfromdetail').val(response.reinsurance_period_from);
              $('#sliprptodetail').val(response.reinsurance_period_to);

              $('#switch-proportionaldetail').val(response.proportional);
              // if(response.proportional == ''){
              $("#btnaddlayerdetail").attr('hidden', 'true');
              $("#sliplayerproportionaldetail").attr('hidden', 'true');
              $("#labelnonpropdetail").attr('hidden', 'true');
              $("#labelnpdetail").attr('hidden', 'true');
              // }

              $('#slipratedetail').val(response.rate);
              $('#slipsharedetail').val(response.share);

              if (response.sum_share) {
                $('#slipsumsharedetail').val(response.sum_share.replace(
                  /\B(?=(\d{3})+(?!\d))/g, ","));
                $('#slipsumsharedetail2').val(response.sum_share.replace(
                  /\B(?=(\d{3})+(?!\d))/g, ","));
              } else {
                $('#slipsumsharedetail').val("0");
                $('#slipsumsharedetail2').val("0");
              }

              if (response.sum_rate) {
                $('#sliptotalratedetail').val(response.sum_share.replace(
                  /\B(?=(\d{3})+(?!\d))/g, ","));
                $('#sliptotalratedetail').val(response.sum_share.replace(
                  /\B(?=(\d{3})+(?!\d))/g, ","));
              } else {
                $('#slipsumsharedetail').val("0");
                $('#slipsumsharedetail2').val("0");
              }

              if (response.sum_feebroker) {
                $('#slipsumfeedetail').val(response.sum_feebroker.replace(
                  /\B(?=(\d{3})+(?!\d))/g, ","));
                $('#slipsumfeedetail2').val(response.sum_feebroker.replace(
                  /\B(?=(\d{3})+(?!\d))/g, ","));
              } else {
                $('#slipsumfeedetail').val("0");
                $('#slipsumfeedetail2').val("0");
              }


              if (response.basic_premium) {
                $('#slipbasicpremiumdetail').val(response.basic_premium.replace(
                  /\B(?=(\d{3})+(?!\d))/g, ","));
              } else {
                $('#slipbasicpremiumdetail').val("0");
              }

              if (response.grossprm_to_nr) {
                $('#slipgrossprmtonrdetail').val(response.grossprm_to_nr.replace(
                  /\B(?=(\d{3})+(?!\d))/g, ","));
                $('#slipgrossprmtonrdetail2').val(response.grossprm_to_nr.replace(
                  /\B(?=(\d{3})+(?!\d))/g, ","));

              } else {
                $('#slipgrossprmtonrdetail').val("0");
                $('#slipgrossprmtonrdetail2').val("0");
              }

              if (response.commission) {
                $('#slipcommissiondetail').val(response.commission);
              } else {
                $('#slipcommissiondetail').val(0);
              }


              if (response.sum_commission) {
                $('#slipsumcommissiondetail').val(response.sum_commission.replace(
                  /\B(?=(\d{3})+(?!\d))/g, ","));
                $('#slipsumcommissiondetail2').val(response.sum_commission.replace(
                  /\B(?=(\d{3})+(?!\d))/g, ","));

              } else {
                $('#slipsumcommissiondetail').val("0");
                $('#slipsumcommissiondetail2').val("0");

              }

              if (response.netprm_to_nr) {
                $('#slipnetprmtonrdetail').val(response.netprm_to_nr.replace(
                  /\B(?=(\d{3})+(?!\d))/g, ","));
                $('#slipnetprmtonrdetail2').val(response.netprm_to_nr.replace(
                  /\B(?=(\d{3})+(?!\d))/g, ","));
              } else {
                $('#slipnetprmtonrdetail').val("0");
                $('#slipnetprmtonrdetail2').val("0");
              }

              if (response.own_retention) {
                $('#slipordetail').val(response.own_retention);
              } else {
                $('#slipordetail').val(0);
              }

              if (response.sum_own_retention) {
                $('#slipsumordetail').val(response.sum_own_retention.replace(
                  /\B(?=(\d{3})+(?!\d))/g, ","));
              } else {
                $('#slipsumordetail').val("0");
              }

              $('#countendorsmentdetail').val(response.endorsment);
              $('#countendorsmentdetail2').val(response.endorsment);
              $('#remarksdetail').val(response.remarks);


              // swal("Success!", "Data Show", 'success')
              // console.log(response)

            },
            error: function(request, status, error) {
              //alert(request.responseText);
              swal("Error!", "Get Slip Data Error", "error");
            }
          });
        }
    } else {
      swal("Error", "Get Slip Data Empty", "error");

    }

  });
</script>


<script type='text/javascript'>
  $(".datepickerloss").datepicker({

    dateFormat: 'dd/mm/yy',
    onSelect: function(dateText) {
      //alert("Selected date: " + dateText + ", Current Selected Value= " + this.value);
      $(this).change();
    }

  }).on("change", function() {
    //alert("Change event");

    var dateinsurance = $('#dateinsurance').val();
    var datereinsurance = $('#datereinsurance').val();
    var dateloss = $('#dateofloss').val();


    var dateParts = dateinsurance.split("/");
    var date1 = new Date(+dateParts[2], dateParts[1] - 1, +dateParts[0]);


    var dateParts2 = datereinsurance.split("/");
    var date2 = new Date(+dateParts2[2], dateParts2[1] - 1, +dateParts2[0]);

    var dateParts3 = dateloss.split("/");
    var datelossdata = new Date(+dateParts3[2], dateParts3[0] - 1, +dateParts3[1]);


    //best to use .getTime() to compare dates
    if (date1.getTime() === date2.getTime()) {
      //same date
    }

    if (datelossdata.getTime() > date2.getTime()) {
      //alert("Date Loss Melebihi Batas Waktu Polis");
      swal("Error!", "Date Loss Melebihi Batas Waktu Polis", "Date Loss Melebihi Batas Waktu Polis");
      $('#dateofloss').val();
    }

    //alert("change date2 "+dateloss+ " "+datelossdata);
    //alert("change date2 "+datereinsurance+ " "+date2);
  });
</script>

{{-- COPY PLA BUTTON --}}
<script type="text/javascript">

</script>

<script type='text/javascript'>
  $('#detailclaimbutton').click(function(e) {
    //alert('masuk');
    e.preventDefault();

    //alert('test');

    var slipnumberdata = $('#slipnumberdata').val();
    $dateinsurance = "";
    $datereinsurance = "";

    if (slipnumberdata) {
      //response.insurance_period_to
      //response.reinsurance_period_to

      $.ajax({
        url: '{{ url('/') }}/transaction-data/detailslipnumber/' + slipnumberdata,
        type: "GET",
        beforeSend: function() {
          $("body").addClass("loading");
        },
        complete: function() {
          $("body").removeClass("loading");
        },
        success: function(response) {
          $dateinsurance = response.insurance_period_to;
          $datereinsurance = response.reinsurance_period_to;

          $('#dateinsurance').val(response.insurance_period_to);
          $('#datereinsurance').val(response.reinsurance_period_to);
        },
        error: function(request, status, error) {
          //alert(request.responseText);
          swal("Error!", "Get Slip Data Error", "Get Data Error");
        }
      });




      $.ajax({
        url: '{{ url('/') }}/claimtransaction-data/detailslipclaimAmount/' +
          slipnumberdata,
        type: "GET",
        beforeSend: function() {
          $("body").addClass("loading");
        },
        complete: function() {
          $("body").removeClass("loading");
        },
        success: function(response) {



          if (response.status == 200) {

            //alert(response.data);
            // console.log(response.data);
            var jsonData = JSON.parse(response.data);
            console.log(jsonData);

            if (jsonData.length <= 0) {
              $('#propertyTypePanelAmount #lossdesctbody').empty();
            }

            for (var i = 0; i < jsonData.length; i++) {
              var counter = jsonData[i];
              no_data = i + 1;
              var curr_amount = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
              }).format(counter.amount);
              console.log('h2');
              $('#propertyTypePanelAmount #lossdesctbody').append('<tr id="iidamountclaim' +
                counter.id +
                '" data-name="amounttypevalue[]"><td>' + no_data + '</td><td data-name="' +
                counter.descripiton + '">' + counter.descripiton +
                '</td><td data-name="' + counter.amount + '">' + curr_amount +
                '</td><td><a href="javascript:void(0)" onclick="deleteamountclaimdetail(' +
                counter.id + ')">delete</a></td></tr>');


            }

            // $('#totallossamount').val(response.sumamount);
            // var reg = /\B(?=(\d{3})+(?!\d))/g
            $('#totallossamount').val(response.sumamount < 0 ? (parseInt(response.sumamount) * -1) :
              response.sumamount).change();

          }

        },
        error: function(request, status, error) {
          //alert(request.responseText);
          swal("Error!", "Get Slip Data Error", "Get Data Error");
        }
      });


      // $.ajax({
      //   url: '{{ url('/') }}/claimtransaction-data/detailslipclaimRiskLocation/' +
      //     slipnumberdata,
      //   type: "GET",
      //   beforeSend: function() {
      //     $("body").addClass("loading");
      //   },
      //   complete: function() {
      //     $("body").removeClass("loading");
      //   },
      //   success: function(response) {

      //     if (response.status == 200) {
      //       //alert(response.data);
      //       //console.log(response.data);
      //       var jsonData = JSON.parse(response.data);
      //       console.log(jsonData);
      //       //alert(response.data);

      //       for (var i = 0; i < jsonData.length; i++) {
      //         var counter = jsonData[i];

      //         var risklocationdata = counter.risklocationdetail;

      //         for (var j = 0; j < risklocationdata.length; j++) {

      //           var risklocationdatacounter = risklocationdata[j];

      //           $('#descripitonriskselect').append(
      //             `<option value="${risklocationdatacounter.id}">${risklocationdatacounter.interestdetail.description} - ${risklocationdatacounter.cedingdetail.name}  : ${risklocationdatacounter.amountlocation}</option>`
      //           );
      //         }

      //       }

      //     }
      //   },
      //   error: function(request, status, error) {
      //     //alert(request.responseText);
      //     swal("Error!", "Get Slip Data Error", "Get Data Error");
      //   }
      // });



      $.ajax({
        url: '{{ url('/') }}/claimtransaction-data/detailslipclaim/' + slipnumberdata,
        type: "GET",
        beforeSend: function() {
          $("body").addClass("loading");
        },
        complete: function() {
          $("body").removeClass("loading");
        },
        success: function(response) {
          console.log('bisa tampil')
          console.log(response);
          if (response.status == 200) {
            $('#mainclaimid').val(response.id);
            $('#regcomp').val(response.reg_comp);
            $('#docnumber').val(response.doc_number);
            $('#dateofreceipt').val(response.date_receipt);
            $('#dateofdocument').val(response.date_document);
            $('#causeofloss').val(response.causeofloss_id).change();
            $('#desccauseofloss').val(response.desc_causeofloss);
            $('#natureofloss').val(response.natureofloss_id).change();
            $('#descnatureofloss').val(response.descnatureofloss);
            $('#dateofloss').val(response.date_of_loss);
            $('#currofloss').val(response.curr_id_loss).change();
            $('#desccurrofloss').val(response.curr_lossdesc);
            $('#surveyoradjuster').val(response.surveyor_id).change();
            $('#descsurveyoradjuster').val(response.desc_surveyor);
            $('#nationalresliab').val(response.nasre_liab < 0 ? parseInt(response.nasre_liab) * -1 : response
              .nasre_liab);;
            $('#descnationalresliab').val(response.nasre_liabdesc).change();
            $('#cedantshare').val(response.ced_share < 0 ? parseInt(response.ced_share) * -1 : response
              .ced_share).change();
            $('#shareonloss').val(response.nasre_share_loss < 0 ? parseInt(response.nasre_share_loss) * -1 :
              response.nasre_share_loss).change();
            //$('#totallossamount').val(response.total_loss_amount);
            $('#potentialrecoverydecision').val(response.potential_recovery).change();
            $('#potentialrecovery').val(response.desc_poten_rec);
            $('#subrogasi').val(response.estimate_amount_subro < 0 ? parseInt(response
              .estimate_amount_subro) * -1 : response.estimate_amount_subro).change();
            $('#kronologi').val(response.kronologi);
            $('#staffrecomend').val(response.staff_recomendation);
            $('#assistantmanagerrecomend').val(response.ass_man_recomen);

            $('#pureorliability').val(response.pureor_liability);
            $('#pureorloss').val(response.pureor_loss);
            $('#pureorcontract').val(response.pureor_retro).change();
            $('#pureorrecovery').val(response.pureor_recovery);

            $('#qsliability').val(response.qs_liability);
            $('#qsloss').val(response.qs_loss);
            $('#qscontract').val(response.qs_retro).change();
            $('#qsrecovery').val(response.qs_recovery);

            $('#arr1liability').val(response.arr1_liability);
            $('#arr1loss').val(response.arr1_loss);
            $('#arr1contract').val(response.arr1_retro).change();
            $('#arr1recovery').val(response.arr1_recovery);

            $('#extraliability').val(response.extra_liability);
            $('#extraloss').val(response.extra_loss);
            $('#extracontract').val(response.extra_retro).change();
            $('#extrarecovery').val(response.extra_recovery);


            $('#facultativeliability').val(response.facultative_liability);
            $('#facultativeloss').val(response.facultative_loss);
            $('#facultativecontract').val(response.facultative_retro).change();
            $('#facultativerecovery').val(response.facultative_recovery);


            $('#arr2liability').val(response.arr2_liability);
            $('#arr2loss').val(response.arr2_loss);
            $('#arr2contract').val(response.arr2_retro).change();
            $('#arr2recovery').val(response.arr2_recovery);

            $('#arr3liability').val(response.arr3_liability);
            $('#arr3loss').val(response.arr3_loss);
            $('#arr3contract').val(response.arr3_retro).change();
            $('#arr3recovery').val(response.arr3_recovery);


            $('#totalrecovery').val(response.totalrecovery);
            $('#nrsgrossret').val(response.nrsgrossret).change();
            $('#xol').val(response.xol);
            $('#cereffno').val(response.cereffno);
            $('#dateofprod').val(response.dateofprod);
            $('#ceuser').val(response.ceuser);
            $('#ceno').val(response.ceno);
            $('#status_ce').val(response.status_ce).change();

            $('#description').val(response.description);
            $('#dateentry').val(response.dateofentry);
            $('#datetrans').val(response.dateoftrans);
            $('#datesupporting').val(response.dateofsupporting);

            if (response.status_flag != 1) {
              $('input[name="locationcheck"]').prop('disabled', true);
              $('#regcomp').prop('disabled', true);
              $('#slipnumberdata').prop('disabled', true);
            }
            if (!response.status_flag) {
              $("#copyplabutton").hide();

            }

            swal("Success!", "Data Show")
          } else {
            $.ajax({
              url: '{{ url('/') }}/claimtransaction-data/getCountClaim/' +
                slipnumberdata,
              type: "GET",
              beforeSend: function() {
                $("body").addClass("loading");
              },
              complete: function() {
                $("body").removeClass("loading");
              },
              success: function(response) {
                if (response.status == 200) {
                  //alert(response.countsum);
                  if (response.countsum < 0) {

                  } else {
                    $('#regcomp').val('Claim-' + slipnumberdata +
                      '-' + (response.countsum + 1));
                  }
                }

              },
              error: function(request, status, error) {
                //alert(request.responseText);
                swal("Error!", "Get Slip Data Error", "Get Data Error");
              }


            });
            //swal("Notice !", response.message, response.message);
          }



        },
        error: function(request, status, error) {
          //alert(request.responseText);
          swal("Error!", "Get Slip Data Error", "Get Data Error");
        }

      });


      $.ajax({
        url: '{{ url('/') }}/transaction-data/detailslipnumber/' + slipnumberdata,
        type: "GET",
        beforeSend: function() {
          $("body").addClass("loading");
        },
        complete: function() {
          $("body").removeClass("loading");
        },
        success: function(response) {
          if (response.share) {
            $('#nationalresliab').val(response.share);
          } else {
            $('#nationalresliab').val("0");
          }

          if (response.sum_share) {
            $('#descnationalresliab').val(response.sum_share.replace(
              /\B(?=(\d{3})+(?!\d))/g, ",")).change();

          } else {
            $('#descnationalresliab').val("0");

          }

          if (response.total_sum_insured) {
            $('#cedantshare').val(response.total_sum_insured.replace(
              /\B(?=(\d{3})+(?!\d))/g, ",")).change();
          } else {
            $('#cedantshare').val("0");
          }

        },
        error: function(request, status, error) {
          //alert(request.responseText);
          swal("Error!", "Get Slip Data Error", "Get Data Error");
        }

      });




    } else {
      swal("Error!", "Get Slip Data Empty", "Get Data Error");

    }

  });
</script>




<script type='text/javascript'>


</script>




<script type='text/javascript'>


</script>

{{-- NATURE OF LOSS --}}
<script type='text/javascript'>
  $('#natureofloss').change(function() {
    var desc = $('#descnol' + $(this).val()).val();
    $('#descnatureofloss').val(desc);
  })
</script>

{{-- CAUSE OF LOSS --}}
<script type='text/javascript'>
  $('#causeofloss').change(function() {
    var desc = $('#desccol' + $(this).val()).val();
    $('#desccauseofloss').val(desc);
  })
</script>

{{-- MAX NUMBER --}}
{{-- <script type='text/javascript'>
  if (statusflag && statusflag != 1) {
    $("#nationalresliab").change(function() {
      // pla_nasre_liabdesc = slip.nasre_liabdesc;
      // pla_nasre_share_loss = slip.nasre_share_loss;
      // pla_ced_share = slip.ced_share;
      // pla_total_loss_amount = slip.total_loss_amount;
      if ($(this).val() > pla_nasre_liab) {
        $(this).val(pla_nasre_liab);
        var shareslip = parseFloat($(this).val()) / 100;
        var tsi = $("#totallossamount").val();
        var conv_tsi = parseFloat(tsi.replace(/,/g, ""));
        var sumshare = isNaN(shareslip * conv_tsi) ? 0 : (shareslip * conv_tsi).toFixed(2);
        var real_sumshare = sumshare.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

        $('#shareonloss').val(real_sumshare).change();
      }
    });

    $("#descnationalresliab").change(function() {
      var _val = parseInt($(this).val().replace(/,/g, ""))
      if (_val > pla_nasre_liabdesc) {
        $(this).val(pla_nasre_liabdesc.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")).change();
      }
    });

  }
</script> --}}


<style>
  .overlay {
    display: none;
    position: fixed;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    z-index: 1100 !important;
    background: rgba(255, 255, 255, 0.8) url("{{ asset('loader.gif') }}") center no-repeat;
  }

  /* Turn off scrollbar when body element has the loading class */
  body.loading {
    overflow: hidden;
  }

  /* Make spinner image visible when body element has the loading class */
  body.loading .overlay {
    display: block;
  }
</style>