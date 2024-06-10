@extends('layouts.master')

@section('title')
 Cập nhật nhà kho
@endsection


@section('contents')

<div class="mb-4">
    <div class="card-header">
        <div class="card-title ">Cập nhật nhà kho</div>
    </div>
    <form class="container" method="POST" action="{{route('warehouse.edited' , ['id'  => $warehouse->id])}}">
        @csrf
        <div class="card-body row mt-4">

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Tên nhà kho : </label>
                 <input type="text" required value="{{$warehouse->name}}"  name="name" class="form-control"  id="exampleInputPassword1">

            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Địa chỉ : </label>
                 <input type="text" required  value="{{$warehouse->location}}" name="address" class="form-control"  id="exampleInputPassword1">

            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Trạng thái : </label>

                    <select  required  name="status_id" class="form-control" >
                        <option selected value="">Chọn ...</option>

                        @if (isset($status))
                            @foreach ($status as $s)
                                <option  {{$warehouse->status_id == $s->id ? 'selected' : ''}} value="{{$s->id}}">{{$s->name}}</option>
                            @endforeach
                        @endif
                    </select>

            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Mô tả : </label>
                 <input  type="text" value="{{$warehouse->description}}"   name="description" class="form-control"  id="exampleInputPassword1">

            </div>

        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Cập nhật</button>

            <a href="{{route('warehouse.back')}}">
                <div  class="btn btn-danger">
                    Quay lại
                </div>
            </a></div>
    </form>
</div>
@endsection


