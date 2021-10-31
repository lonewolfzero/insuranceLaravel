<link href="{{asset('css/select2.css')}}" rel="stylesheet"/>
<script src="{{asset('js/select2.js')}}"></script>
<script>
        $(document).ready(function() { $(".e1").select2(); });
</script>


<script>
    $(function () {
      "use strict";
  
      var insured = <?php echo(($insured_ids->content())) ?>;
      for(const id of insured) {
          var btn = `
              <a href="#" onclick="confirmDelete('${id}')">
                  <i class="fas fa-trash text-danger"></i>
              </a>
          `;
          $(`#delbtn${id}`).append(btn);
      }
  
      $("#marineinsured").DataTable({
        "order": [[ 0, "desc" ]],
        dom: '<"top"fB>rt<"bottom"lip><"clear">',
        lengthMenu: [
            [ 10, 25, 50,100, -1 ],
            [ '10 rows', '25 rows', '50 rows','100 rows', 'Show all' ]
        ]
        
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
    function confirmDelete(id){
        let choice = confirm("{{__('Are you sure, you want to delete this Marine Insured related data?')}}")
        if(choice){
            document.getElementById('delete-marineinsured-'+id).submit();
        }
    }
  
</script>

<script>
    $(function () {
      "use strict";
  
      var slip = <?php echo(($slip_ids->content())) ?>;
      for(const id of slip) {
          var btn = `
              <a href="#" onclick="confirmDelete2('${id}')">
                  <i class="fas fa-trash text-danger"></i>
              </a>
          `;
          $(`#delbtn2${id}`).append(btn);
      }
  
      $("#marineslip").DataTable({
        "order": [[ 0, "desc" ]],
        dom: '<"top"fB>rt<"bottom"lip><"clear">',
        lengthMenu: [
            [ 10, 25, 50,100, -1 ],
            [ '10 rows', '25 rows', '50 rows','100 rows', 'Show all' ]
        ]
        
      });
  
    });
  
    function confirmDelete2(id){
        let choice = confirm("{{__('Are you sure, you want to delete this Marine Slip related data?')}}")
        if(choice){
            document.getElementById('delete-marineslip-'+id).submit();
        }
    }
  
</script>