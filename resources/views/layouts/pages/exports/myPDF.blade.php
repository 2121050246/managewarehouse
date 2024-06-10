<!DOCTYPE html>
<html>
<head>
    <title>Xuất hoá đơn</title>
    <style>
        body {
            font-family: "DejaVu Sans";
            opacity: 0.8;
        }
        .title {
            text-align: center;
            margin-bottom: 20px;
        }
        .content {
            margin: 0 auto;
            width: 80%;
            text-align: left;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid rgb(160, 153, 153);
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: whitesmoke;
        }
    </style>
</head>
<body>
    <div class="title">
        <h1>{{ $title }}</h1>
    </div>
    <div class="content " style="margin-top: 10%">
        <span>Tên nhà cung cấp :     <b> {{$name_supplier}} </b></span>

        {{-- <p>{{$id}}</p> --}}
        <p style="margin-top: 5%">Ngày : {{ $date }}</p>



        <table style="margin-top: 10%">
            <thead>
                <tr>
                    <th>Mã hoá đơn </th>
                    <th>Sản phẩm</th>
                    <th>Hình ảnh</th>

                    <th>Số lượng</th>
                    <th>Loại hàng</th>

                    <th>Nhà kho</th>

                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>{{$name_product}}</td>
                    <td><img style="width:100% ; height:100px;" src="{{public_path($path)}}" alt=""></td>

                    <td>{{$quantity}}</td>
                    <td>{{$category}}</td>
                    <td>{{$house}}</td>





                </tr>

            </tbody>
        </table>


        <div style="margin-top: 20% ">Note : <span style="opacity: 0.7"> Công cty 1 thành viên DuanHamsi</span> </div>
    </div>
</body>
</html>
