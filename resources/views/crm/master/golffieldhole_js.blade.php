<link href="{{asset('css/select2.css')}}" rel="stylesheet"/>
<script src="{{asset('js/select2.js')}}"></script>
<script>
        $(document).ready(function() { $(".e1").select2({ width: '100%' }); 
        
       

        });
</script>
<script>
    $(function () {
      "use strict";
  
      var golffieldholes = <?php echo(($golffieldhole_ids->content())) ?>;
      for(const id of golffieldholes) {
          var btn = `
              <a href="#" onclick="confirmDelete('${id}')">
                  <i class="fas fa-trash text-danger"></i>
              </a>
          `;
          $(`#delbtn${id}`).append(btn);
      }
  
  
      $("#golffieldholeTable").DataTable({
        "order": [[ 0, "desc" ]],
        dom: '<"top"fB>rt<"bottom"lip><"clear">',
        lengthMenu: [
            [ 10, 25, 50,100, -1 ],
            [ '10 rows', '25 rows', '50 rows','100 rows', 'Show all' ]
        ]
      });
  
    });
  
    function confirmDelete(id){
        let choice = confirm("{{__('Are you sure, you want to delete this product and related data?')}}")
        if(choice){
            document.getElementById('delete-golf-'+id).submit();
        }
    }
  
  </script>