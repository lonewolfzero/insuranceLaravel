<link href="{{asset('css/select2.css')}}" rel="stylesheet"/>
<script src="{{asset('js/select2.js')}}"></script>
<script>
        $(document).ready(function() { $(".e1").select2({ width: '100%' }); });
</script>

<script>
    $(function () {
      "use strict";
  
      var insuredmarine = <?php echo(($insuredmarinetype_ids->content())) ?>;
      for(const id of insuredmarine) {
          var btn = `
              <a href="#" onclick="confirmDelete('${id}')">
                  <i class="fas fa-trash text-danger"></i>
              </a>
          `;
          $(`#delbtn${id}`).append(btn);
      }
  
  
      $("#insuredmarinetypeTable").DataTable({
        "order": [[ 0, "desc" ]],
        dom: '<"top"fB>rt<"bottom"lip><"clear">',
        lengthMenu: [
            [ 10, 25, 50,100, -1 ],
            [ '10 rows', '25 rows', '50 rows','100 rows', 'Show all' ]
        ]
        
      });
  
    });
  
    function confirmDelete(id){
        let choice = confirm("{{__('Are you sure, you want to delete this Insured Marine Type and related data?')}}")
        if(choice){
            document.getElementById('delete-insuredmarinetype-'+id).submit();
        }
    }
  
</script>