@extends('layouts.master')

@section('title')
    Nhà cung cấp
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


            <a href="{{route('Supplier.create')}}" class="btn btn-primary ">Thêm</a>

        </div>
        {{ $suppliers->links() }}
        <div class="px-4" style="width:100%">
            <div class="float-end mb-3 ">
                <div class="mx-2">
                    <input type="text" id="search_supplier" class="form-control" placeholder="Tìm tên nhà cung cấp ">
                </div>


            </div>
         </div>





        {{-- show --}}


        <div id="supplier_list" >
            @include('layouts.pages.suppliers.suppliers_list', [ 'suppliers' => $suppliers])
        </div>





</div>
</div>




@endsection





@section('js')

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.delete-button'); // Sử dụng class thay vì id

        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const recordId = this.getAttribute('data-id');

                console.log(recordId);

                Swal.fire({
                    title: "Bạn muốn xoá không?",
                    // text: "không thể khôi phục được dữ liệu",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Xoá',
                    cancelButtonText: 'Hủy'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Gửi yêu cầu xóa đến máy chủ
                        fetch(`/Duan/supplier/delete/${recordId}`, {
                            method: 'GET',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json'
                            }
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data.success) {
                                Swal.fire(
                                    {
                                        title: 'Xoá thành công',

                                        icon: 'success',
                                    }
                                ).then(() => {
                                    location.reload(); // Tải lại trang để cập nhật danh sách
                                });
                            }
                        })

                        // bắt lỗi
                        .catch(error => {
                            Swal.fire(
                                'Lỗi!',
                                'Có lỗi xảy ra, vui lòng thử lại.',
                                'error'
                            );
                            console.error('There was a problem with the fetch operation:', error);
                        });


                    } else {
                        Swal.fire(
                            {
                                title: 'Huỷ thành công',

                                icon: 'success',
                            }
                        );
                    }
                });
            });
        });
    });
</script>



<script>
    $(document).ready(function() {
        $('#search_supplier').on('keyup', function() {
            var query = $(this).val();

            $.ajax({
                url: '{{ route("supplier.search") }}',
                type: 'GET',
                data: { query: query },
                success: function(data) {
                    $('#supplier_list').html(data);
                }
            });
        });
    });
</script>
@endsection

