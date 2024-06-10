@extends('layouts.master')

@section('title')
 Thêm loại  hàng
@endsection


@section('contents')

<div class="mb-4">
    <div class="card-header">
        <div class="card-title ">Thêm loại hàng</div>
    </div>
    <form class="container" method="POST" action="{{route('postCategory')}}">
        @csrf
        <div class="card-body row mt-4">

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Tên hàng : </label>
                 <input type="text" required name="name" class="form-control" value="{{old('name')}}" id="exampleInputPassword1">

            </div>

        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Thêm</button>

            <a href="{{route('category.back')}}">
                <div  class="btn btn-danger">
                    Quay lại
                </div>
            </a></div>
    </form>
</div>
@endsection


