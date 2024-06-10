<table class="table text-center">
    <thead >
      <tr>
        <th scope="col" >#</th>
        <th scope="col">
            Tên nhà kho

        </th>
        <th scope="col">Địa chỉ
        </th>
        <th scope="col">Trạng thái</th>

        <th scope="col">Mô tả</th>
        <th scope="col">Ngày tạo</th>


        <th scope="col">Sửa</th>

        <th scope="col">Xoá</th>


      </tr>
    </thead>
    <tbody>
        @if (isset($warehouses))
            @foreach ($warehouses as $k =>$w)
            <tr>
                <th scope="row">{{($warehouses->currentPage() - 1) * $warehouses->perPage() + $loop->index + 1 }}</th>
                <td>{{$w->name}}</td>
                <td>{{$w->location}}</td>
                <td>
                    @foreach ($status as $s)
                        @if ($s->id ==  $w->status_id)
                            {{$s->name}}
                        @endif
                    @endforeach


                </td>
                <td>{{$w->description}}</td>
                <td>{{$w->created_at}}</td>


                <td >


                    <a href="{{route('warehouse.edit',  ['id' => $w->id])}}">

                        <i class="fa-solid fa-wrench  text-primary px-3 py-1"></i>
                    </a>

                </td>

                <td>
                    <button style="    border: none; background: transparent;" class="delete-button" data-id="{{$w->id}}">
                        <i class="fa-solid fa-trash  text-danger px-3 py-1"></i>
                    </button>
                </td>
            </tr>
            @endforeach
        @endif


    </tbody>
  </table>
