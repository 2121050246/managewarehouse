<nav class="app-header navbar navbar-expand-lg bg-body">
    <div class="container-fluid">
        <a class="navbar-brand" href="#" data-lte-toggle="sidebar" role="button">
            <i class="bi bi-list"></i>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item d-none d-md-block">
                    <a href="{{route('home')}}" class="nav-link">Trang chủ</a>
                </li>
                {{-- <li class="nav-item d-none d-md-block">
                    <a href="#" class="nav-link">Liên lạc</a>
                </li> --}}
            </ul>
            <ul class="navbar-nav ms-auto">
                {{-- <li class="nav-item dropdown">
                    <a class="nav-link" data-bs-toggle="dropdown" href="#">
                        <i class="bi bi-chat-text"></i>
                        <span class="navbar-badge badge text-bg-danger">3</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                        <a href="#" class="dropdown-item">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <img src="{{asset('admin/dist/assets/img/user1-128x128.jpg')}}" alt="User Avatar" class="img-size-50 rounded-circle me-3">
                                </div>
                                <div class="flex-grow-1">
                                    <h3 class="dropdown-item-title">
                                        Brad Diesel
                                        <span class="float-end fs-7 text-danger"><i class="bi bi-star-fill"></i></span>
                                    </h3>
                                    <p class="fs-7">Call me whenever you can...</p>
                                    <p class="fs-7 text-secondary"><i class="bi bi-clock-fill me-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <img src="{{asset('admin/dist/assets/img/user8-128x128.jpg')}}" alt="User Avatar" class="img-size-50 rounded-circle me-3">
                                </div>
                                <div class="flex-grow-1">
                                    <h3 class="dropdown-item-title">
                                        John Pierce
                                        <span class="float-end fs-7 text-secondary"><i class="bi bi-star-fill"></i></span>
                                    </h3>
                                    <p class="fs-7">I got your message bro</p>
                                    <p class="fs-7 text-secondary"><i class="bi bi-clock-fill me-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <img src="{{asset('admin/dist/assets/img/user3-128x128.jpg')}}" alt="User Avatar" class="img-size-50 rounded-circle me-3">
                                </div>
                                <div class="flex-grow-1">
                                    <h3 class="dropdown-item-title">
                                        Nora Silvester
                                        <span class="float-end fs-7 text-warning"><i class="bi bi-star-fill"></i></span>
                                    </h3>
                                    <p class="fs-7">The subject goes here</p>
                                    <p class="fs-7 text-secondary"><i class="bi bi-clock-fill me-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link" data-bs-toggle="dropdown" href="#">
                        <i class="bi bi-bell-fill"></i>
                        <span class="navbar-badge badge text-bg-warning">15</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                        <span class="dropdown-item dropdown-header">15 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="bi bi-envelope me-2"></i> 4 new messages
                            <span class="float-end text-secondary fs-7">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="bi bi-people-fill me-2"></i> 8 friend requests
                            <span class="float-end text-secondary fs-7">12 hours</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="bi bi-file-earmark-fill me-2"></i> 3 new reports
                            <span class="float-end text-secondary fs-7">2 days</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li> --}}

                <li class="nav-item dropdown user-menu">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                        <img src="{{asset('admin/dist/assets/img/user2-160x160.jpg')}}" class="user-image rounded-circle shadow" alt="User Image">
                        <span class="d-none d-md-inline">{{session('username')}}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" style="width:100px">
                        <li><a class="dropdown-item" href="{{route('infor_account')}}">Tài khoản</a></li>
                        <li><a class="dropdown-item" href="{{route('logout')}}">Đăng xuất</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
