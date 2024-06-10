@extends('layouts.master')

@section('title')
 Cập nhật tài khoản
@endsection


@section('contents')

<div class="mb-4">
    <div class="card-header">
        <div class="card-title ">Cập nhật tài khoản</div>
    </div>
    <form class="container" method="POST" action="{{route('accounts.postEdit', ['id' => $users->id])}}">
        @csrf
        <div class="card-body row mt-4">

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Họ và tên : </label>
                 <input type="text" name="name" class="form-control" value="{{$users->name}}" id="exampleInputPassword1">
                 @error('name')
                     <p style="color: red">{{$message}}</p>
                 @enderror
            </div>





            {{-- <div class="input-group mb-3"> <input type="file" class="form-control" id="inputGroupFile02"> <label class="input-group-text" for="inputGroupFile02">Upload</label> </div> --}}
            <fieldset class="row mb-3">
                <legend class="col-form-label col-sm-2 pt-0">Phân quyền : </legend>
                <div class="col-sm-10">
                    <div class="form-check"> <input class="form-check-input" type="radio" name="role" id="gridRadios1" value="admin" {{ $users->roles == 'admin' ? 'checked' : '' }}  > <label class="form-check-label" for="gridRadios1">
                            Admin
                        </label> </div>
                    <div class="form-check"> <input class="form-check-input" type="radio" name="role" id="gridRadios2" value="user" {{ $users->roles == 'user' ? 'checked' : '' }} > <label class="form-check-label" for="gridRadios2">
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

            <button type="submit" class="btn btn-primary">Cập nhật</button>

            <a href="{{route('account.back')}}">
                <div  class="btn btn-danger">
                    Quay lại
                </div>
            </a>

        </div>
    </form>
</div>
@endsection


