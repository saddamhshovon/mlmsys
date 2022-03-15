<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>MLM</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,30\0i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{asset('home/css/styles.css')}}" rel="stylesheet" />
</head>

<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
        <div class="container px-4 px-lg-5">

            <a class="navbar-brand" href="#page-top"><img class="rounded-circle" width="50" height="50" src="{{isset($homestart->image) ? asset($homestart->image) : 'https://cdn.pixabay.com/photo/2017/11/16/09/25/bitcoin-2953851_1280.png'}}" alt=""> {{isset($homestart->logo_title) ? $homestart->logo_title : 'MLM' }}</a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('login')}}">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('register')}}">Register</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Masthead-->
    <header class="masthead">
        <div class="container px-4 px-lg-5 d-flex h-100 align-items-center justify-content-center">
            <div class="d-flex justify-content-center">
                <div class="text-center">
                    <h1 class="mx-auto my-0 text-uppercase">{{isset($homestart->title) ? $homestart->title : 'MLM BISINESS' }}</h1>
                    <h2 class="text-white-50 mx-auto mt-2 mb-5">{{isset($homestart->subtitle) ? $homestart->subtitle : "The main sales pitch of MLM companies to their participants and prospective participants is not the MLM company's products or services." }}</h2>
                    <a class="btn btn-primary" href="{{route('login')}}">Sign In</a>
                    <a class="btn btn-primary" href="{{route('register')}}">Sign Up</a>
                </div>
            </div>
        </div>
    </header>
    <!-- About-->
    <section class="about-section text-center" id="start">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-8">
                    <h2 class="text-white mb-3">{{isset($homeAbout->title) ? $homeAbout->title : 'About Us' }}</h2>
                    <p class="text-white-50">
                        {{isset($homeAbout->subtitle) ? $homeAbout->subtitle : "The main sales pitch of MLM companies to their participants and prospective participants is not the MLM company's products or services." }}
                    </p>>
                </div>
            </div>
            <img class="img-fluid" src="{{(!empty($homeAbout->image))?url('images/home/'.$homeAbout->image):'https://cdn.pixabay.com/photo/2018/04/18/18/47/hands-3331216_1280.jpg'}}" alt="..." />
        </div>
    </section>
    <!-- Projects-->
    <section class="projects-section bg-light" id="about">
        <div class="container px-4 px-lg-5">
            <!-- Featured Project Row-->
            <div class="row gx-0 mb-4 mb-lg-5 align-items-center">
                <div class="col-xl-8 col-lg-7"><img class="img-fluid mb-3 mb-lg-0" src="{{(!empty($homeWork->image)) ? url('images/home/'.$homeWork->image) : 'https://images.pexels.com/photos/2068975/pexels-photo-2068975.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'}}" alt="..." /></div>
                <div class="col-xl-4 col-lg-5">
                    <div class="featured-text text-center text-lg-left">
                        <h4>{{isset($homeWork->title) ? $homeWork->title : 'What We Do'}}</h4>
                        <p class="text-black-50 mb-0">{{isset($homeWork->subtitle) ? $homeWork->subtitle : "The main sales pitch of MLM companies to their participants and prospective participants is not the MLM company's products or services." }}</p><br>
                        <marquee width="100%" class="text-primary" direction="left" height="100px">
                            {{isset($homeFooter->notice) ? $homeFooter->notice : 'We are here to remove poverty from society with some extraordinary income facilities.'}}
                        </marquee>
                    </div>
                </div>
            </div>
            <div class="row gx-0 justify-content-center">
                <div class="col-lg-6"><img class="img-fluid" src="{{(!empty($homeGoal->image)) ? url('images/home/'.$homeGoal->image) : 'https://cdn.pixabay.com/photo/2016/10/09/19/19/coins-1726618_1280.jpg'}}" alt="..." /></div>
                <div class="col-lg-6 order-lg-first">
                    <div class=" text-center h-100 project">
                        <div class="d-flex h-100">
                            <div class="project-text w-100 my-auto text-center text-lg-right">
                                <h4>{{isset($homeGoal->title) ? $homeGoal->title : 'Our Goal'}}</h4>
                                <p class="mb-0 text-black-50">{{isset($homeGoal->subtitle) ? $homeGoal->subtitle : "The main sales pitch of MLM companies to their participants and prospective participants is not the MLM company's products or services." }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Signup-->

    <!-- Contact-->
    <section class="contact-section bg-primary" id="contact">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5">
                <div class="col-md-4 mb-3 mb-md-0">
                    <div class="card py-4 h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-map-marked-alt text-primary mb-2"></i>
                            <h4 class="text-uppercase m-0">Address</h4>
                            <hr class="my-4 mx-auto" />
                            <div class="small text-black-50">{{isset($homeFooter->address) ? $homeFooter->address : '4923 Market Street, Patahnthuli, Chowmuhony, Chattogram'}}</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3 mb-md-0">
                    <div class="card py-4 h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-envelope text-primary mb-2"></i>
                            <h4 class="text-uppercase m-0">Email</h4>
                            <hr class="my-4 mx-auto" />
                            <div class="small text-black-50"><a href="#!">{{isset($homeFooter->email) ? $homeFooter->email : 'www.gmail.com'}}</a></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3 mb-md-0">
                    <div class="card py-4 h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-mobile-alt text-primary mb-2"></i>
                            <h4 class="text-uppercase m-0">Phone</h4>
                            <hr class="my-4 mx-auto" />
                            <div class="small text-black-50">{{isset($homeFooter->phone) ? $homeFooter->phone : '+880XXXXXXXXXX'}}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="social d-flex justify-content-center">
                <a class="mx-2" target="_blank" href="{{isset($homeFooter->twitter) ? $homeFooter->twitter : 'https://twitter.com/'}}"><i class="fab fa-twitter"></i></a>
                <a class="mx-2" target="_blank" href="{{isset($homeFooter->facebook) ? $homeFooter->facebook : 'https://www.facebook.com/'}}"><i class="fab fa-facebook-f"></i></a>
                <a class="mx-2" target="_blank" href="{{isset($homeFooter->instagram) ? $homeFooter->instagram : 'https://www.instagram.com/'}}"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </section>
    <!-- Footer-->
    <footer class="footer bg-primary small text-center text-white-50">
        <div class="container px-4 px-lg-5">Copyright &copy; Your Website 2021</div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="{{asset('home/js/scripts.js')}}"></script>
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <!-- * *                               SB Forms JS                               * *-->
    <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
</body>

</html>