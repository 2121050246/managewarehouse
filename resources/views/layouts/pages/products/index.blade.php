@extends('layouts.master')

@section('title')
    Danh sách sản phẩm
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




        </div>


            {{ $products->links() }}



        <div class="px-4" style="width:100%">


            <div class="float-end mb-3 d-flex">
                <div class="mx-2">
                    <input type="text" id="search_product" class="form-control" placeholder="Tìm tên sản phẩm ">
                </div>

                <form action="{{ route('products.indexed') }}" method="POST" class="d-flex">
                    @csrf
                    <select name="category_id" class="form-select mx-3" aria-label="Default select example">
                        <option value="0" {{ request('category_id', 0) == 0 ? 'selected' : '' }}>Tất cả</option>
                        @if (isset($categories))
                            @foreach ($categories as $c)
                                <option value="{{ $c->id }}" {{ request('category_id') == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                            @endforeach
                        @endif
                    </select>
                    <button type="submit" class="btn btn-primary" id="submitButton">Tìm</button>
                </form>
            </div>

            {{-- show --}}
            {{-- <div class="col-md-12">
                <table class="table text-center" id="category-table ">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tên sản phẩm</th>
                            <th scope="col">Hình ảnh</th>
                            <th scope="col">Loại</th>
                            <th scope="col">Nhà cung cấp</th>
                            <th scope="col">Tên nhà kho</th>
                            <th scope="col">Địa chỉ nhà kho</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Mô tả</th>
                            <th scope="col">Ngày tạo</th>
                            <th scope="col">Sửa</th>
                            <th scope="col">Xoá</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($products))
                            @foreach ($products as $k => $p)
                                <tr>
                                    <th scope="row">{{ ($products->currentPage() - 1) * $products->perPage() + $loop->index + 1 }}</th>
                                    <td>{{ $p->name }}</td>
                                    <td style="width:100px">
                                        <img style="height: 100px; width: 100%; object-fit: contain;" src="{{ $p->path }}" alt="">
                                    </td>
                                    <td>
                                        @if (isset($categories))
                                            @foreach ($categories as $c)
                                                @if ($c->id == $p->category_id)
                                                    {{ $c->name }}
                                                @endif
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        @if (isset($suppliers))
                                            @foreach ($suppliers as $s)
                                                @if ($s->id == $p->supplier_id)
                                                    {{ $s->name }}
                                                @endif
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        @if (isset($warehouses))
                                            @foreach ($warehouses as $w)
                                                @if ($w->id == $p->house_id)
                                                    {{ $w->name }}
                                                @endif
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        @if (isset($warehouses))
                                            @foreach ($warehouses as $w)
                                                @if ($w->id == $p->house_id)
                                                    {{ $w->location }}
                                                @endif
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>{{ $p->quantity }}</td>
                                    <td>{{ $p->description }}</td>
                                    <td>{{ $p->created_at }}</td>
                                    <td>
                                        <a href="{{ route('products.edit', ['id' => $p->id]) }}">
                                            <i class="fa-solid fa-wrench text-primary px-3 py-1"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <button style="border: none; background: transparent;" class="delete-button" data-id="{{ $p->id }}">
                                            <i class="fa-solid fa-trash text-danger px-3 py-1"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <h4 class="text-center">No products found.</h4>
                        @endif
                    </tbody>
                </table>
            </div> --}}

            <div id="product_list">
                @include('layouts.pages.products.product_list', ['products' => $products, 'warehouses' => $warehouses, 'suppliers' => $suppliers, 'categories' => $categories])
            </div>






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
                        fetch(`/Duan/products/delete/${recordId}`, {
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
        $('#search_product').on('keyup', function() {
            var query = $(this).val();

            $.ajax({
                url: '{{ route("products.search") }}',
                type: 'GET',
                data: { query: query },
                success: function(data) {
                    $('#product_list').html(data);
                }
            });
        });
    });
</script>





@endsection

