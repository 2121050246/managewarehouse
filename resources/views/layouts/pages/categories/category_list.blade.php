<table class="table text-center" id="category-table">
    <thead >
      <tr>
        <th scope="col" >#</th>
        <th scope="col">
            Mã hàng

        </th>

        <th scope="col ">
            Loại hàng



        </th>
        <th scope="col">Ngày tạo</th>


        <th scope="col">Sửa</th>

        <th scope="col">Xoá</th>


      </tr>
    </thead>
    <tbody>

        @if (isset($categories))
             @foreach ($categories as $k =>$c)
                <tr>
                    <th scope="row">{{($categories->currentPage() - 1) * $categories->perPage() + $loop->index + 1 }}</th>
                    <td>{{$c->code}}</td>

                    <td>{{$c->name}}</td>
                    <td>{{$c->created_at}}</td>


                    <td >


                        <a href="{{route('getEdit', ['id' => $c->id])}}">

                            <i class="fa-solid fa-wrench  text-primary px-3 py-1"></i>
                        </a>

                    </td>



                    <td>
                        <button style="    border: none; background: transparent;" class="delete-button" data-id="{{$c->id}}">
                            <i class="fa-solid fa-trash  text-danger px-3 py-1"></i>
                        </button>
                    </td>
                </tr>
        @endforeach
        @endif



    </tbody>
  </table>
