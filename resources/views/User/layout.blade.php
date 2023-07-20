<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--    CDN boostraps-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.4.0/fonts/remixicon.css" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('css/user.css')}}">
    <title>
        @section('title')
        @show
    </title>
</head>
<body>

    @if (Session::has('success'))
        <ul class="notification">
            <li class="success toasts">
                <div class="column">
                    <i class="fa fa-check"></i>
                    <span>{{ session('success') }}</span>
                </div>
                <i class="fa fa-xmark"></i>
            </li>
        </ul>
    @elseif (Session::has('error'))
        <ul class="notification">
            <li class="error toasts">
                <div class="column">
                    <i class="fa fa-check"></i>
                    <span>{{ session('error') }}</span>
                </div>
                <i class="fa fa-xmark"></i>
            </li>
        </ul>
    @endif
    <ul class="notification">
    </ul>

    <header>
        <div class="header-news position-relative min-height-100">
            <div class="container">
                <div class="top-header d-md-flex justify-content-center align-items-center gap-md-7 ">
                    <a href="#" target="_blank" class="text-uppercase text-xs ">GameK</a>
                    <a href="#" target="_blank" class="text-uppercase text-xs ">Kenh14</a>
                    <a href="#" target="_blank" class="text-uppercase text-xs ">Cafebinz</a>
                </div>
            </div>
            <div class="main-header container-fluid">
                <div class="container">
                    <div class="middle-header">
                        <div class="row">
                            <div class="col-sm-2">
                                <div class="logo mt-2">
                                    <svg style="margin-top: -9px !important;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="28" height="28"><path d="M12 3.09747L7.05025 8.04722C4.31658 10.7809 4.31658 15.213 7.05025 17.9467C9.78392 20.6804 14.2161 20.6804 16.9497 17.9467C19.6834 15.213 19.6834 10.7809 16.9497 8.04722L12 3.09747ZM12 0.269043L18.364 6.633C21.8787 10.1477 21.8787 15.8462 18.364 19.3609C14.8492 22.8756 9.15076 22.8756 5.63604 19.3609C2.12132 15.8462 2.12132 10.1477 5.63604 6.633L12 0.269043ZM7 12.997H17C17 15.7584 14.7614 17.997 12 17.997C9.23858 17.997 7 15.7584 7 12.997Z" fill="rgba(100,205,138,1)"></path></svg>
                                    <a href="{{url('/')}}" style="color: #4cc170;" class="mt-3 ms-1 text-uppercase fw-bold text-decoration-none fs-3 text-bs-indigo">NEWS</a>
                                </div>
                            </div>
                            <div class="col-md-6 d-flex justify-content-left align-items-center">
                                <div class="trending-icon">
                                    <svg width="20" height="13" viewBox="0 0 20 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_2_588)">
                                            <path d="M7.71094 6.06641L11.6953 10.0508L17.4141 4.35547L19.7109 6.65234V0.652344H13.7109L16.0078 2.92578L11.6953 7.23828L7.71094 3.23047L0 10.9414L1.40625 12.3477L7.71094 6.06641Z" fill="white"></path>
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_2_588">
                                                <rect width="19.7109" height="11.6953" fill="white" transform="translate(0 0.652344)"></rect>
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </div>
                                <div class="button-middle-header">
                                    <ul>
                                        <li>
                                            <button type="button" class="btn">Tech Kiệm</button>
                                        </li>
                                        <li>
                                            <button type="button" class="btn">Mua Bán</button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bottom-header">
                    </div>
                </div>
            </div>
        </div>
    </header>
    <nav>

    </nav>

    <main>
        @section('content')
        @show
    </main>

    <footer>
        <div class="container">
            <div class="logo-footer">
                <div class="middle-navbar-item-logo mt-3 col-md-2">
                    <svg class="ms-2 mt-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="36" height="36"><path d="M12 3.09747L7.05025 8.04722C4.31658 10.7809 4.31658 15.213 7.05025 17.9467C9.78392 20.6804 14.2161 20.6804 16.9497 17.9467C19.6834 15.213 19.6834 10.7809 16.9497 8.04722L12 3.09747ZM12 0.269043L18.364 6.633C21.8787 10.1477 21.8787 15.8462 18.364 19.3609C14.8492 22.8756 9.15076 22.8756 5.63604 19.3609C2.12132 15.8462 2.12132 10.1477 5.63604 6.633L12 0.269043ZM7 12.997H17C17 15.7584 14.7614 17.997 12 17.997C9.23858 17.997 7 15.7584 7 12.997Z" fill="rgba(100,205,138,1)"></path></svg>
                    <a href="#" style="color: #4cc170; margin-top: 10px !important;" class="sidebar-logo mt-4 ms-1 text-uppercase fw-bold text-decoration-none fs-3 text-bs-indigo">NEWS</a>
                </div>
            </div>
            <hr style="color: white">
            <div class="item-footer">
                <div class="d-flex mt-2 justify-content-left align-items-center gap-5">
                    @foreach (\App\Models\Admin\Category::limit(8)->get() as $category)
                    <a href="#"  class="end-navbar-item" target="_blank"><?php echo $category->name ?></a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="horizon-footer mt-2">
        </div>

        <div class="container mt-5">
            <div class="row">
                <div class="col-md-6 content-left-footer mb-5">
                    <p>
                        Chịu trách nhiệm quản lý nội dung: Bà Nguyễn Bích Minh
                        <br>
                        Hà Nội: Tầng 20, Tòa nhà Center Building - Hapulico Complex, Số 1 Nguyễn Huy Tưởng, Thanh Xuân, Hà Nội.
                        <br>
                        Email: <span>info@genk.vn</span>
                        <br>
                        Điện thoại: 024.73095555, máy lẻ 62374
                        <br>
                        VPĐD tại TP.HCM: Tầng 4, Tòa nhà 123
                        <br>
                        Võ Văn Tần, Phường 6, Quận 3, Tp. Hồ Chí Minh
                    </p>

                    <p class="mt-3">
                        © Copyright 2010 - 2023 - Công ty Cổ phần VCCorp
                        <br>
                        Tầng 17, 19, 20, 21 Toà nhà Center Building - Hapulico Complex, Số 1 Nguyễn Huy Tưởng, Thanh Xuân, Hà Nội.
                        <br>
                        Giấy phép thiết lập trang thông tin điện tử tổng hợp trên mạng số 460/GP-TTĐT do Sở Thông tin và Truyền thông Hà Nội cấp ngày 03/02/2016
                    </p>
                </div>
                <div class="col-md-6">
                    <div class="right-content-footer">
                        <img src="https://vccorp.mediacdn.vn/vccorp-m.png" alt="logo vccorp">
                        <h4 class="advertise-footer mt-3">Liên hệ quảng cáo</h4>
                        <p style="color:#eeeeee; font-size: 13px;">
                            Hotline hỗ trợ quảng cáo: 0794463333 - 0961984388
                            <br>
                            <br>
                            Email: <span style="color: red">giaitrixahoi@admicro.vn</span>
                            <br>
                            Hỗ trợ & CSKH: Admicro
                            <br>
                            Address: Tầng 20, Tòa nhà Center Building - Hapulico Complex, Số 1 Nguyễn Huy Tưởng, Thanh Xuân, Hà Nội.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>


    <!--    CDN boostrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script>
        // let searchNavbar = document.querySelector('#search-navbar');
        // let inputSearchNavbar = document.querySelector('#input-search-navbar');
        // searchNavbar.addEventListener('click', () =>{
        //     inputSearchNavbar.classList.toggle('active');
        // });




        // Tao Toast
        const notifications = document.querySelector('.notification');
        const toast = document.querySelector('.toasts');
        const timer = 3000;

        const removeToast = (toast) => {
            toast.classList.add("hide");
            if (toast.timeoutId) clearTimeout(toast.timeoutId);
            setTimeout(() => toast.remove(), 400);
        };


        function createErrorToast(toastMessage) {
            const toast = document.createElement('li');
            toast.className = `toasts error`;
            toast.innerHTML = `
                <div class="column">
                   <i class="fa-solid fa-bug"></i>
                    <span>${toastMessage}</span>
                </div>
             <i class="fa-solid fa-x"></i>
                `
            notifications.appendChild(toast);
            setTimeout(() => removeToast(toast), 3000)
        };

        function createSuccesToast(message) {
            const toast = document.createElement('li');
            toast.className = `toasts success`;
            toast.innerHTML = `
                        <div class="column">
                                <i class="fa-solid fa-check"></i>
                            <span>${message}</span>
                        </div>
                      <i class="fa-solid fa-x"></i>
                        `
            notifications.appendChild(noti);
            setTimeout(() => removeToast(toast), 3000)
        };
    </script>

    @section('javascript')
    @show

    @if (Session::has('success') || Session::has('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {

                function removeToast(toast) {
                    toast.classList.add("hide");
                    if (toast.timeoutId) clearTimeout(toast.timeoutId);
                    setTimeout(() => toast.remove(), 400);
                }

                setTime();

                function setTime() {
                    setTimeout(() => removeToast(toast), 3000)
                }
            });
        </script>
    @endif
</body>

