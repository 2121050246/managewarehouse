@extends('layouts.master')

@section('title')
    Nhà kho
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


            <a href="{{route('warehouse.create')}}" class="btn btn-primary ">Thêm</a>

        </div>


        {{ $warehouses->links() }}
        <div class="col-md-12 mb-3  " >

            <div class="float-end d-flex">


            <div class="mx-2">
                <input type="text" id="search_warehouse" class="form-control" placeholder="Tìm tên nhà kho ">
            </div>




            <form action="{{route('warehouse.indexed')}}" method="POST" style="float: right" class="d-flex">
                <div style="width:140px" class="my-1"  >Trạng thái : </div>
                @csrf
                <select name="status_id" class="form-select mx-3" aria-label="Default select example">
                    <option value="0"  selected>Tất cả</option>
                    @if (isset($status))
                        @foreach ($status as $s)
                            @if (isset($request))
                                <option {{$request->status_id == $s->id ? 'selected' : ""}} value="{{$s->id}}">{{$s->name}}</option>

                            @else
                                <option  value="{{$s->id}}">{{$s->name}}</option>

                            @endif
                        @endforeach
                    @endif


                </select>
                <button type="submit" class="btn btn-primary" id="submitButton">Tìm</button>
            </form>
            </div>

        </div>

        {{-- show --}}
        <div id="warehouse_list" >
            @include('layouts.pages.warehouses.warehouse_list', [ 'warehouses' => $warehouses,'status' => $status])
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
                        fetch(`/Duan/warehouse/delete/${recordId}`, {
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
        $('#search_warehouse').on('keyup', function() {
            var query = $(this).val();


            $.ajax({
                url: '{{ route("warehouse.search") }}',
                type: 'GET',
                data: { query: query },
                success: function(data) {

                    $('#warehouse_list').html(data);
                }
            });
        });
    });
</script>
@endsection
