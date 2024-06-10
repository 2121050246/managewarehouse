@extends('layouts.master')

@section('title')
 Cập nhật nhà cung cấp
@endsection


@section('contents')
<div class="mb-4">
    <div class="card-header">
        <div class="card-title "> Cập nhật nhà cung cấp</div>
    </div>
    <form class="container" method="POST" action="{{route('Supplier.edited', ['id' => $supplier->id])}}">
        @csrf
        <div class="card-body row mt-4">

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Tên nhà cung cấp : </label>
                 <input type="text"  name="name" class="form-control"  value="{{isset($supplier->name) ? $supplier->name: old('name')}}" id="exampleInputPassword1">
                 @error('name')
                 <p style="color: red">{{$message}}</p>
             @enderror
            </div>

            <div class="mb-3">
                <div class="row">
                <div class="col-6">
                    <label for="city">Thành phố:</label>
                    <select id="city" name="city" class="form-control" >
                        <option value="">Chọn thành phố</option>
                        @foreach ($cities as $city)
                            <option value="{{ $city['id'] }}"{{$city['name'] == $supplier->city ? 'selected' : '' }}  > {{ $city['name'] }}</option>
                        @endforeach
                    </select>
                    @error('city')
                    <p style="color: red">{{$message}}</p>
                @enderror
                </div>

                <div class="col-6">
                    <label for="district">Quận/Huyện:</label>
                    <select id="district"  name="district" class="form-control" disabled>
                        <option value="">Chọn quận/huyện</option>
                    </select>
                    @error('district')
                        <p style="color: red">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-6">
                    <label for="ward">Xã/Phường:</label>
                    <select id="ward"  name="ward" class="form-control" disabled>
                        <option value="">Chọn xã/phường</option>
                    </select>

                    @error('ward')
                        <p style="color: red">{{$message}}</p>
                    @enderror
                </div>

                <div class="col-6">
                    <label for="address" >Địa chỉ:</label>
                    <input type="text" value="{{isset($supplier->address) ? $supplier->address: old('address')}}"   name="address" class="form-control" >
                    @error('address')
                    <p style="color: red">{{$message}}</p>
                @enderror
                </div>


            </div>

            <div class="my-3">
                <label for="exampleInputPassword1" class="form-label">Số điện thoại : </label>
                 <input type="text"  name="phone" class="form-control" value="{{isset($supplier->phone) ? $supplier->phone: old('phone')}}" id="exampleInputPassword1">
                 @error('phone')
                 <p style="color: red">{{$message}}</p>
             @enderror
            </div>
        </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Cập nhật</button>

            <a href="{{route('supplier.back')}}">
                <div  class="btn btn-danger">
                    Quay lại
                </div>
            </a>

            </div>



    </form>





</div>



@endsection


@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{asset('assets/js/address.js')}}"></script>
@endsection()


