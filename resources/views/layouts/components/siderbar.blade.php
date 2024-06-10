<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <div class="sidebar-wrapper mt-3">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">


                <li class="nav-item "> <a href="{{route('home')}}" class="nav-link ">
                    <i class="nav-icon fa-solid fa-house"></i>

                    <p>Trang chủ</p>
                    </a>
                </li>

                <li class="nav-item "> <a href="{{route('products.index')}}" class="nav-link ">
                    <i class="fa-solid fa-database"></i>

                    <p>Sản phẩm trong kho </p>
                    </a>
                </li>


                <li class="nav-item "> <a href="{{route('products.create')}}" class="nav-link ">
                    <i class="fa-solid fa-file-import"></i>
                    <p>Nhập </p>
                    </a>
                </li>

                <li class="nav-item "> <a href="{{route('export.index')}}" class="nav-link ">
                    <i class="fa-solid fa-file-export"></i>
                    <p>Danh sách xuất </p>
                    </a>
                </li>

                <li class="nav-item "> <a href="#" class="nav-link ">
                    <i class=" nav-icon fa-solid fa-list"></i>
                        <p>
                            Danh sách
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item"> <a href="{{route('warehouse')}}" class="nav-link">
                            <i class="nav-bar fa-solid fa-warehouse"></i>
                                <p>Nhà kho</p>
                            </a> </li>
                        <li class="nav-item"> <a href="{{route('category')}}" class="nav-link">
                            <i class="nav-bar fa-solid fa-layer-group"></i>
                                <p>Loại hàng</p>
                            </a>
                        </li>

                        <li class="nav-item"> <a href="{{route('supplier.index')}}" class="nav-link">
                            <i class="nav-bar fa-solid fa-truck-field-un"></i>
                                <p>Nhà cung cấp</p>
                            </a>
                        </li>



                    </ul>
                </li>



                <li class="nav-item"> <a href="{{route('account')}}" class="nav-link ">
                    <i class="nav-icon fa-solid fa-user"></i>

                        <p>Cấp tài khoản</p>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</aside>
