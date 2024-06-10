@extends('layouts.master')

@section('title')
    Cập nhật sản phẩm
@endsection



@section('contents')

<div class="row">






    <div class="card card-primary card-outline mb-4">
        <div class="card-header">
            <div class="card-title">Cập nhật thông tin sản phẩm </div>
        </div>


        <div >
            {{-- message  --}}
            @if(session('msg'))
            <div class="toast-container" style="position: absolute; top: 8px; right: 10px;">
                <div class="toast fade show"   >
                    <div class="toast-header">
                        <strong class="me-auto"></strong>
                        <small> </small>
                        <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
                    </div>
                    <div class="toast-body text-success ">
                        <i class="fa-solid fa-check px-2"></i>

                        {{session('msg')}}

                    </div>
                </div>
            </div>
            @endif
        </div>
        <form action="" method="POST" enctype="multipart/form-data">

            @csrf
            <div class="card-body">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Tên sản phẩm </label>
                     <input type="text"  value="{{isset($product->name) ? $product->name : old('product')}}" class="form-control" name="product" id="exampleInputEmail1" aria-describedby="emailHelp">
                     @error('product')
                     <p style="color: red">{{$message}}</p>
                 @enderror

                </div>




                <div class="row">
                    <div class="mb-3 col-4">
                        <label class="form-label">Loại hàng </label>
                        <select name="category"  class="form-control">

                             @if (isset($categories))
                                @foreach ($categories as $c)
                                    <option {{$product->category_id == $c->id ? 'selected' : '' }} value="{{$c->id}}"  >{{$c->name}}</option>
                                @endforeach


                             @endif


                         </select>

                         @error('category')
                         <p style="color: red">{{$message}}</p>
                     @enderror

                    </div>

                    <div class="mb-3  col-4">
                        <label class="form-label">Nhà cung cấp  </label>
                        <select name="supplier" class="form-control" >

                             @if (isset($suppliers))
                                @foreach ($suppliers as $s)
                                    <option   {{$product->supplier_id == $s->id ? 'selected' : '' }} value="{{$s->id}}">{{$s->name}}</option>
                                @endforeach
                            @endif

                         </select>

                         @error('supplier')
                         <p style="color: red">{{$message}}</p>
                     @enderror

                    </div>

                    <div class="mb-3  col-4">
                        <label class="form-label">Nhà kho </label>
                        <select name="warehouse" class="form-control" >

                             @if (isset($warehouses))
                                @foreach ($warehouses as $w)
                                    <option {{$product->house_id == $w->id ? 'selected' : '' }} value="{{$w->id}}">{{$w->name}}</option>
                                @endforeach
                         @endif
                         </select>
                         @error('warehouse')
                         <p style="color: red">{{$message}}</p>
                     @enderror
                    </div>
                </div>


                <div class="mb-3">

                    <label for="exampleInputPassword1" class="form-label">Hình ảnh</label>

                    <div class="input-group">
                        <input type="file" name="file" class="form-control" id="inputGroupFile02">
                        <label class="input-group-text" for="inputGroupFile02">Upload</label>
                    </div>


                    @error('file')
                    <p style="color: red">{{$message}}</p>
                @enderror
                </div>

                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Số lượng</label>
                    <input type="number" name="number" value="{{isset($product->quantity) ? $product->quantity : old('product')}}" class="form-control" id="exampleInputPassword1">

                    @error('number')
                    <p style="color: red">{{$message}}</p>
                @enderror
               </div>

               <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Mô tả</label>
                <input type="text" name="description" value="{{isset($product->description) ? $product->description : old('product')}}" class="form-control" id="exampleInputPassword1">

                @error('description')
                <p style="color: red">{{$message}}</p>
            @enderror
           </div>

            </div>
            <div class="card-footer"> <button type="submit" class="btn btn-primary">Cập nhật </button>

                <a href="{{route('products.back')}}">
                    <div  class="btn btn-danger">
                        Quay lại
                    </div>
                </a></div>
        </form>
    </div>
</div>


@endsection
