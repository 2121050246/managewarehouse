@extends('layouts.master')

@section('title')
 Trang chủ
@endsection







@section('contents')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">




                {{-- message  --}}
                @if (session('msg'))
                <script>
                    Swal.fire({
                        icon: 'warning',
                        // title: 'Thông báo',
                        text: '{{ session('msg') }}',
                        confirmButtonText: 'OK'
                    });
                </script>
            @endif



        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="row ">
                <div class="col-lg-3 col-6 col-md-3">
                    <div class="small-box text-bg-primary ">
                        <div class="inner">
                            <h3>{{ $products }}</h3>
                            <p>Số lượng sản phẩm trong kho</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6 col-md-3">
                    <div class="small-box text-bg-primary bg-success">
                        <div class="inner">
                            <h3>{{ $suppliers }}</h3>
                            <p>Số lượng nhà cung cấp</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6 col-md-3 ">
                    <div class=" bg-warning small-box text-bg-primary">
                        <div class="inner">
                            <h3>{{ $warehouses }}</h3>
                            <p>Số lượng nhà kho</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-6 col-md-3">
                    <div class="small-box text-bg-primary bg-secondary">
                        <div class="inner">
                            <h3>{{ $categories }}</h3>
                            <p>Số lượng loại hàng</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-lg-6 col-6 col-md-3">
                    <div class="small-box text-bg-primary bg-danger bg-gradient ">
                        <div class="inner">
                            <h3>{{isset($product_years) ? $product_years : 'Không có dữ liệu'}}</h3>
                            <p>Tổng số lượng nhập năm {{isset($currentYear) ? $currentYear : 'Không có dữ liệu'}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-6 col-md-3">
                    <div class="small-box text-bg-primary bg-info bg-gradient">
                        <div class="inner">
                            <h3>{{isset($export_years) ? $export_years : 'Không có dữ liệu'}}</h3>
                            <p>Tổng số lượng xuất năm {{isset($currentYear) ? $currentYear : 'Không có dữ liệu'}}</p>
                        </div>
                    </div>
                </div>

            </div>




            <div class="row">
                <div class="col-lg-12 connectedSortable">
                    <div class="card mb-4">
                        <div class="card-header">
                            {{-- Tiêu đề biểu đồ --}}
                            <h3 class="card-title">Số lượng nhập xuẩt theo ngày</h3>
                        </div>
                        <div class="card-body">
                            {{-- vẽ  --}}
                            <canvas id="bar-chart" width="400" height="200"></canvas>

                        </div>
                    </div>

                </div>


            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            {{-- số lượng xuất nhập theo tháng  --}}

               <label for="exampleInputPassword1" class="form-label">Trực quan :  </label>
               <div class="mb-3 col-md-6 ">
                   <select id="yearSelect" class="form-select" aria-label="Select Year"></select>
               </div>



               <div class="mb-3 col-md-6 ">
                   <select class="form-select" id="monthSelect" aria-label="Default select example">
                       <option value="1">Tháng 1</option>
                       <option value="2">Tháng 2</option>
                       <option value="3">Tháng 3</option>
                       <option value="4">Tháng 4</option>
                       <option value="5">Tháng 5</option>
                       <option value="6">Tháng 6</option>
                       <option value="7">Tháng 7</option>
                       <option value="8">Tháng 8</option>
                       <option value="9">Tháng 9</option>
                       <option value="10">Tháng 10</option>
                       <option value="11">Tháng 11</option>
                       <option value="12">Tháng 12</option>
                 </select>
               </div>



       </div>
    </div>

</main>



@endsection


@section('js')

    <script type="module" src="{{asset('assets/js/number_month_chart.js')}}"></script>



@endsection
