<link href="{{asset('css/select2.css')}}" rel="stylesheet"/>
<script src="{{asset('js/select2.js')}}"></script>
<script>
        $(document).ready(function() { 
            
            $(".e1").select2({ width: '100%' }); 
        
        });
</script>

@include('crm.partials.functions')
@include('crm.partials.datatables')
<script>
    $(document).ready(function(){
        
        $('#edit-role').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var name = button.data('name');
            var modal = $(this);
            
            modal.find('input[name="id"]').val(id);
            modal.find('input[name="name"]').val(name);
            modal.find('input[name="company_name"]').val(company_name);
            modal.find('input[name="address"]').val(address);
            modal.find('input[name="country"]').val(country);
            modal.find('input[name="companytype"]').val(type);
        });

        var roleTable = $('#cedingbrokerTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('/master-data/cedingbroker') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'name', name: 'name' },
                { data: 'company_name', name: 'company_name' },
                { data: 'address', name: 'address' },
                { data: 'countryside.name', name: 'country' },
                { data: 'companytype.name', name: 'companytype' },
                { data: 'actions', name: 'actions', orderable:false, searchable:true, visible: true }
            ],
        });

        roleTable.on('error', function () { 
            console.log('DataTables - Ajax Role Error ' );
           // roleTable.ajax.reload();
        });

    });
</script>

<script>
    roleTable.column(1).visible(true);
</script>

<script type="text/javascript">
    $('#companynamefield').change(function(){
        var str = $(this).val();
        var ret = str.split(" ");
        var count = ret.length;
        console.log(ret)
        console.log(ret.length)
        var res;
        if(count > 2){
            var str0 = ret[0].substr(0,1).toUpperCase();
            var str1 = ret[1].substr(0,1).toUpperCase();
            var str2 = ret[2].substr(0,1).toUpperCase();

            res = (str1 + str2);
        }
        else
        {
            var str0 = ret[0].substr(0,1).toUpperCase();
            var str1 = ret[1].substr(0,1).toUpperCase();
            res = (str0 + str1);
        }
        if(str){
            $.ajax({
                    type: "GET",
                    url: "{{route('cedingbroker.getcode')}}",
                    dataType: 'json',
                    success:function(response){        
                        if(response){
                            console.log(response.autocode);
                            // console.log(res + response.autocode);
                            $('#codecedbrok').val(res + response.autocode);     
                        }else{
                            // $('#codecedbrok').val(res);
                            console.log(res);
                        }
                    }
                });
        }
    });
</script>