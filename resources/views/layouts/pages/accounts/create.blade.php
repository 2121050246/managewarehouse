@extends('layouts.master')

@section('title')
 Thêm tài khoản
@endsection


@section('contents')

<div class="mb-4">
    <div class="card-header">
        <div class="card-title ">Thêm tài khoản</div>
    </div>
    <form class="container" method="POST" action="{{route('postAccount')}}">
        @csrf
        <div class="card-body row mt-4">

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Họ và tên : </label>
                 <input type="text" name="name" class="form-control" value="{{old('name')}}" id="exampleInputPassword1">
                 @error('name')
                     <p style="color: red">{{$message}}</p>
                 @enderror
            </div>


            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email :</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1" value="{{old('email')}}"  aria-describedby="emailHelp">
                @error('email')
                <p style="color: red">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-3">
                 <label for="exampleInputPassword1" class="form-label">Mật khẩu : </label>
                 <input name="password" type="password" class="form-control" value="{{old('password')}}"  id="exampleInputPassword1">
                 @error('password')
                 <p style="color: red">{{$message}}</p>
                @enderror
                </div>
            {{-- <div class="input-group mb-3"> <input type="file" class="form-control" id="inputGroupFile02"> <label class="input-group-text" for="inputGroupFile02">Upload</label> </div> --}}
            <fieldset class="row mb-3">
                <legend class="col-form-label col-sm-2 pt-0">Phân quyền : </legend>
                <div class="col-sm-10">
                    <div class="form-check"> <input class="form-check-input" type="radio" name="role" id="gridRadios1" value="admin" {{ old('role') == 'admin' ? 'checked' : '' }}  > <label class="form-check-label" for="gridRadios1">
                            Admin
                        </label> </div>
                    <div class="form-check"> <input class="form-check-input" type="radio" name="role" id="gridRadios2" value="user" {{ old('role') == 'user' ? 'checked' : '' }} > <label class="form-check-label" for="gridRadios2">
                            User
                        </label>
                     </div>
                     @error('role')
                     <p style="color: red">{{$message}}</p>
                 @enderror
                </div>
            </fieldset>
        </div>
        <div class="card-footer">
             <button type="submit" class="btn btn-primary">Thêm</button>
             <a href="{{route('account.back')}}">
                <div  class="btn btn-danger">
                    Quay lại
                </div>
            </a>

        </div>
    </form>
</div>
@endsection


