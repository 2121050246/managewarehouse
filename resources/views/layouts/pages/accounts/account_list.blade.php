<table class="table text-center">
    <thead >
      <tr>
        <th scope="col" >#</th>
        <th scope="col">
            Họ Và Tên

        </th>
        <th scope="col">Email

        </th>
        <th scope="col">Vai trò</th>
        <th scope="col">Ngày tạo </th>

        <th scope="col">Sửa</th>

        <th scope="col">Xoá</th>


      </tr>
    </thead>
    <tbody>
        @if (isset($users))
            @foreach ($users as $k =>$u)
            <tr>
                <th scope="row">{{($users->currentPage() - 1) * $users->perPage() + $loop->index + 1 }}</th>
                <td>{{$u->name}}</td>
                <td>{{$u->email}}</td>
                <td>{{$u->roles}}</td>
                <td>{{$u->created_at}}</td>

                <td >


                    <a href="{{route('accounts.getEdit' ,['id' => $u->id])}}">

                        <i class="fa-solid fa-wrench  text-primary px-3 py-1"></i>
                    </a>

                </td>
                <td>
                    <button style="    border: none; background: transparent;" class="delete-button" data-id="{{$u->id}}">
                        <i class="fa-solid fa-trash  text-danger px-3 py-1"></i>
                    </button>
                </td>
            </tr>
            @endforeach
        @endif


    </tbody>
  </table>
