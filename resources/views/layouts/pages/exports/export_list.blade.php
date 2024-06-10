{{ $exports->links() }}
<table class="table text-center">
    <thead >
      <tr>
        <th scope="col" >#</th>
        <th scope="col">
           Sản phẩm

        </th>
        <th scope="col">Ảnh

        </th>
        <th scope="col">Loại</th>
        <th scope="col">Nhà kho</th>


        <th scope="col">Ngày tạo </th>



        {{-- <th scope="col">Xoá</th> --}}


      </tr>
    </thead>
    <tbody>
        @if (isset($exports))
            @foreach ($exports as $k =>$u)
            <tr>
                <th scope="row">{{($exports->currentPage() - 1) * $exports->perPage() + $loop->index + 1 }}</th>
                <td>
                    @if (isset($products))
                        @foreach ($products as $p)
                            @if ( $p->id == $u->product_id)
                                    {{$p->name}}
                            @endif
                        @endforeach
                    @endif
                </td>
                <td>
                    @if (isset($products))
                    @foreach ($products as $p)
                        @if ( $p->id == $u->product_id)
                            <img style="width:100% ; height:100px ;    object-fit: contain;" src="  {{$u->path}}" alt="">
                        @endif
                    @endforeach
                @endif
                    </td>
                <td>


                    @if (isset($categories))
                    @foreach ($categories as $c)
                        @if ( $c->id == $u->category_id)
                                {{$c->name}}
                        @endif
                    @endforeach
                @endif
                </td>
                <td>

                    @if (isset($warehouses))
                    @foreach ($warehouses as $h)
                        @if ( $h->id == $u->house_id)
                                {{$h->name}}
                        @endif
                    @endforeach
                    @endif

                </td>

                <td>{{$u->created_at}}</td>


                {{-- <td>
                    <button style="    border: none; background: transparent;" class="delete-button" data-id="{{$u->id}}">
                        <i class="fa-solid fa-trash  text-danger px-3 py-1"></i>
                    </button>
                </td> --}}
            </tr>
            @endforeach
        @endif


    </tbody>
  </table>
