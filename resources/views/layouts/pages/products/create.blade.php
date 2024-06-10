@extends('layouts.master')

@section('title')
    Nhập
@endsection


@section('contents')

<div class="row">






    <div class="card card-primary card-outline mb-4">
        <div class="card-header">
            <div class="card-title">Nhập thông tin sản phẩm </div>
        </div>


        <div >
            @if (session('msg'))
            <script>
                Swal.fire({
                    icon: 'success',
                  //   title: 'Thông báo',
                    text: '{{ session('msg') }}',
                    confirmButtonText: 'OK'
                });
            </script>
        @endif
        </div>
        <form action="{{route('products.created')}}" method="POST" enctype="multipart/form-data">

            @csrf
            <div class="card-body">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Tên sản phẩm </label>
                     <input type="text"  value="{{old('product')}}" class="form-control" name="product" id="exampleInputEmail1" aria-describedby="emailHelp">
                     @error('product')
                     <p style="color: red">{{$message}}</p>
                 @enderror

                </div>




                <div class="row">
                    <div class="mb-3 col-4">
                        <label class="form-label">Loại hàng </label>
                        <select name="category"  class="form-control">
                             <option selected  value="">Chọn...</option>
                             @if (isset($categories))
                                @foreach ($categories as $c)
                                    <option value="{{$c->id}}"  >{{$c->name}}</option>
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
                             <option selected  value="">Chọn...</option>
                             @if (isset($suppliers))
                                @foreach ($suppliers as $s)
                                    <option value="{{$s->id}}">{{$s->name}}</option>
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
                             <option selected  value="">Chọn...</option>
                             @if (isset($warehouses))
                                @foreach ($warehouses as $w)
                                    <option  value="{{$w->id}}">{{$w->name}}</option>
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
                    <input type="number" name="number" value="{{old('number')}}" class="form-control" id="exampleInputPassword1">

                    @error('number')
                    <p style="color: red">{{$message}}</p>
                @enderror
               </div>

               <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Mô tả</label>
                <input type="text" name="description" value="{{old('description')}}" class="form-control" id="exampleInputPassword1">

                @error('description')
                <p style="color: red">{{$message}}</p>
            @enderror
           </div>

            </div>
            <div class="card-footer"> <button type="submit" class="btn btn-primary">Thêm </button> </div>
        </form>
    </div>
</div>


@endsection
