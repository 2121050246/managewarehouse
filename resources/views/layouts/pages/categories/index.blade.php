@extends('layouts.master')

@section('title')
    Loại hàng
@endsection

@section('contents')
<div class="container">


    <div class="row pt-4">
        {{-- add  --}}

        <div class="p-4">
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




            <a href="{{route('getCategory')}}" class="btn btn-primary ">Thêm</a>

        </div>


        {{ $categories->links() }}

        <div class="px-4" style="width:100%">
            <div class="float-end mb-3 ">
                <div class="mx-2">
                    <input type="text" id="search_category" class="form-control" placeholder="Tìm tên nhà cung cấp ">
                </div>


            </div>
         </div>

        {{-- show --}}
        <div id="category_list" >
            @include('layouts.pages.categories.category_list', [ 'categories' => $categories])
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
                        fetch(`/Duan/categories/delete/${recordId}`, {
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
        $('#search_category').on('keyup', function() {
            var query = $(this).val();


            $.ajax({
                url: '{{ route("category.search") }}',
                type: 'GET',
                data: { query: query },
                success: function(data) {

                    $('#category_list').html(data);
                }
            });
        });
    });
</script>
@endsection


