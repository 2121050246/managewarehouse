<table class="table text-center">
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
            <th scope="col">Xem </th>

            <th scope="col">Xuất </th>
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



                    <td >
                        <a  href="{{ route('pdf', ['id' => $p->id, 'action' => 'stream']) }}" >
                            <i class="fa-solid fa-eye"></i>
                        </a>
                    </td>


                    <td>
                        <a   href="{{ route('pdf', ['id' => $p->id, 'action' => 'download']) }} " >
                            <i class="fa-solid fa-download"></i>
                        </a>

                    </td>





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


