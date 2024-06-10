@extends('layouts.master')

@section('title')
    Danh sách xuất
@endsection

@section('contents')
<div class="container">


    <div class="row pt-4">
        {{-- add  --}}

        <div class="p-4">
            {{-- message  --}}

          @if (session('msg'))
          <script>
              Swal.fire({
                  icon: 'success',
                //   title: 'Thông báo',
                  text: '{{ session('msg') }}',
                  confirmButtonText: 'OK'
              });
          </script>
      @endif




        </div>


        <div class="px-4" style="width:100%">
            <div class="float-end mb-3 ">
                <div class="mx-2">
                    <input type="text" id="search_export" class="form-control" placeholder="Tìm sản phẩm ">
                </div>


            </div>
         </div>




        {{-- show --}}

            <div id="export_list" >
                @include('layouts.pages.exports.export_list' , ['exports' => $exports, 'warehouses' => $warehouses, 'suppliers' => $suppliers, 'categories' => $categories])
            </div>





</div>
</div>




@endsection

@section('js')




<script>
    $(document).ready(function() {
        $('#search_export').on('keyup', function() {
            var query = $(this).val();
            console.log(query)

            $.ajax({
                url: '{{ route("export.search") }}',
                type: 'GET',
                data: { query: query },
                success: function(data) {
                    $('#export_list').html(data);
                },
                error: function(xhr, status, error) {
                console.error(xhr.responseText);
                }
            });
        });
    });
</script>
@endsection
