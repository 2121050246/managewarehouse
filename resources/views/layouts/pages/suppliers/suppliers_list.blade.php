
    <table class="table text-center" id="category-table">
        <thead >
          <tr>
            <th scope="col" >#</th>
            <th scope="col">
                Tên nhà cung cấp
                {{-- <a href="?sort-by=code&sort-type={{$sort_type}}">



                    <i class="fa-solid fa-sort text-dark"></i>
                </a> --}}
            </th>

            <th scope="col">Thành phố</th>
            <th scope="col">Quận/huyện</th>
            <th scope="col">Xã phường</th>
            <th scope="col ">
                Địa chỉ
                {{-- <a href="?sort-by=name&sort-type={{$sort_type}}">

                    <i class="fa-solid fa-sort text-dark"></i>
                </a> --}}


            </th>

            <th scope="col">Số điện thoại</th>
            <th scope="col">Ngày tạo</th>



            <th scope="col">Sửa</th>

            <th scope="col">Xoá</th>


          </tr>
        </thead>
        <tbody>

            @if (isset($suppliers))
                 @foreach ($suppliers as $k =>$s)
                    <tr>
                        <th scope="row">{{($suppliers->currentPage() - 1) * $suppliers->perPage() + $loop->index + 1}}</th>


                        <td>{{$s->name}}</td>
                        <td>{{$s->city}}</td>
                        <td>{{$s->district}}</td>
                        <td>{{$s->ward}}</td>

                        <td>{{$s->address}}</td>
                        <td>{{$s->phone}}</td>
                        <td>{{$s->created_at}}</td>



                        <td >


                            <a href="{{route('Supplier.edit', ['id' => $s->id])}}">

                                <i class="fa-solid fa-wrench  text-primary px-3 py-1"></i>
                            </a>

                        </td>


                        <td>
                            <button style="    border: none; background: transparent;" class="delete-button" data-id="{{$s->id}}">
                                <i class="fa-solid fa-trash  text-danger px-3 py-1"></i>
                            </button>
                        </td>
                    </tr>
            @endforeach
            @endif



        </tbody>
      </table>

