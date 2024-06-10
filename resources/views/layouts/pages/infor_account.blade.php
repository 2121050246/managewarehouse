@extends('layouts.master')

@section('title')
 Trang chủ
@endsection


@section('contents')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="col-xl-12 col-md-12 col-12  p-4">
                <div class="row">
                    <ul class="col-xl-12 shadow  bg-body rounded">
                        <h3 class="text-center p-3">Thông tin tài khoản </h3>
                        <li style="list-style: none" class="p-3 mx-4" >
                            <span>Tên tài khoản :  <b>{{$user->name}}</b></span>
                        </li>
                        <li style="list-style: none" class="p-3 mx-4" >
                            <span>Email : <b>{{$user->email}}</b></span>
                        </li>
                        <li style="list-style: none" class="p-3 mx-4" >
                            <span>Vai trò : <b>{{$user->roles}}</b></span>
                        </li>




                    </ul>




                </div>
           </div>

             </div>
        </div>
    </div>

</main>

@endsection
