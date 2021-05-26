@extends('home.includes.layout')
@section('title',"Standard streamer")
@section('header')

@endsection
@section("content")

 <div id="wrapper">

        <ul class="sidebar navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="index.html">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Home</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="channels.html">
                    <i class="fas fa-fw fa-users"></i>
                    <span>All Streams</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="single-channel.html">
                    <i class="fas fa-fw fa-user-alt"></i>
                    <span>My Favorite Streams</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="video-page.html">
                    <i class="fas fa-fw fa-video"></i>
                    <span>Video Page</span>
                </a>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Pages</span>
                </a>
                <div class="dropdown-menu">
                    <h6 class="dropdown-header">Login Screens:</h6>
                    <a class="dropdown-item" href="login.html">Login</a>
                    <a class="dropdown-item" href="register.html">Register</a>
                    <a class="dropdown-item" href="forgot-password.html">Forgot Password</a>
                    <div class="dropdown-divider"></div>
                    <h6 class="dropdown-header">Other Pages:</h6>
                    <a class="dropdown-item" href="blog.html">Blog</a>
                    <a class="dropdown-item" href="blog-detail.html">Blog Detail</a>
                    <a class="dropdown-item" href="blank.html">Blank Page</a>
                    <a class="dropdown-item" href="404.html">404 Page</a>
                    <a class="dropdown-item" href="contact.html">Contact</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="history-page.html">
                    <i class="fas fa-fw fa-history"></i>
                    <span>History Page</span>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="categories.html" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-fw fa-list-alt"></i>
                    <span>Categories</span>
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="categories.html">Movie</a>
                    <a class="dropdown-item" href="categories.html">Music</a>
                    <a class="dropdown-item" href="categories.html">Television</a>
                </div>
            </li>
            <li class="nav-item channel-sidebar-list">
                <h6>SUBSCRIPTIONS</h6>
                <ul>
                    <li>
                        <a href="subscriptions.html">
                            <img class="img-fluid" alt="" src="img/s1.png"> Your Life
                        </a>
                    </li>
                    <li>
                        <a href="subscriptions.html">
                            <img class="img-fluid" alt="" src="img/s2.png"> The live Show<span class="badge badge-warning">2</span>
                        </a>
                    </li>
                    <li>
                        <a href="subscriptions.html">
                            <img class="img-fluid" alt="" src="img/s3.png"> The live Show
                        </a>
                    </li>
                    <li>
                        <a href="subscriptions.html">
                            <img class="img-fluid" alt="" src="img/s4.png"> The live Show
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
        <div id="content-wrapper">
            <div class="container-fluid pb-0">
                <div class="top-mobile-search">
                    <div class="row">
                        <div class="col-md-12">
                            <form class="mobile-search">
                                <div class="input-group">
                                    <input type="text" placeholder="Search for..." class="form-control">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-dark"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="top-category section-padding mb-4">
                    <div class="row">
                        <div class="col-md-6 subscribe px-0 px-md-3">
                            <div class="card bg-dark text-white">
                                <img class="img-fluid imgfluid" src="{{ asset('assets/img/s6.png') }}" alt="">
                                <div class="card-img-overlay pt-5">
                                    <div class=" text-center my-4">
                                        <h4 class="text-white">Enter Your Stream Key To Start Streaming Live</h4>
                                        <form action="{{ url('home/login') }}" class="form form-horizontal" method="post">
                                            @csrf
                                            <input type="text" placeholder="Enter Your Stream Key" name="key">
                                            <input type="submit" class="button" value="Submit">
                                        </form>
                                        <h4 class="text-white my-3">Dont Have a Stream Key? </h4>
                                        <input type="button" class="button" value="Register"> or
                                        <input type="button" class="button" value="Login">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-12">
                                <div class="main-title">
                                    <div class="btn-group float-right right-action">
                                        <a href="#" class="right-action-link text-gray" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#"><i class="fas fa-fw fa-star"></i> &nbsp; Top Rated</a>
                                            <a class="dropdown-item" href="#"><i class="fas fa-fw fa-signal"></i> &nbsp; Viewed</a>
                                            <a class="dropdown-item" href="#"><i class="fas fa-fw fa-times-circle"></i> &nbsp; Close</a>
                                        </div>
                                    </div>
                                    <h6 class="mt-3"><b>Live Now</b></h6>
                                </div>
                            </div>

                            <div class="row owl-carousel-category">


                                <div class="col-md-4 mb-3">
                                    <div class="card bg-dark text-white">
                                        <img class="img-fluid imgfluid" src="img/s5.png" alt="">
                                        <div class="card-img-overlay">
                                            <h6 class="text-white">The Cultural Festival <span title="" data-placement="top" data-toggle="tooltip" data-original-title="Verified"><i class="fas fa-check-circle text-success"></i></span></h6>
                                            <p>74,853 views</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="card bg-dark text-white">
                                        <img class="img-fluid imgfluid" src="img/s7.png" alt="">
                                        <div class="card-img-overlay">
                                            <h6 class="text-white">The Cultural Festival <span title="" data-placement="top" data-toggle="tooltip" data-original-title="Verified"><i class="fas fa-check-circle text-success"></i></span></h6>
                                            <p>74,853 views</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="card bg-dark text-white">
                                        <img class="img-fluid imgfluid" src="img/s4.png" alt="">
                                        <div class="card-img-overlay">
                                            <h6 class="text-white">The Cultural Festival <span title="" data-placement="top" data-toggle="tooltip" data-original-title="Verified"><i class="fas fa-check-circle text-success"></i></span></h6>
                                            <p>74,853 views</p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="video-block section-padding">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="main-title">
                                <div class="btn-group float-right right-action">
                                    <a href="#" class="right-action-link text-gray" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
Sort by <i class="fa fa-caret-down" aria-hidden="true"></i>
</a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#"><i class="fas fa-fw fa-star"></i> &nbsp; Top Rated</a>
                                        <a class="dropdown-item" href="#"><i class="fas fa-fw fa-signal"></i> &nbsp; Viewed</a>
                                        <a class="dropdown-item" href="#"><i class="fas fa-fw fa-times-circle"></i> &nbsp; Close</a>
                                    </div>
                                </div>
                                <h6><b>Popular Streams</b></h6>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 mb-3">
                            <div class="video-card">
                                <div class="video-card-image">
                                    <a class="play-icon" href="#"><i class="fas fa-play-circle"></i></a>
                                    <a href="#"><img class="img-fluid" src="img/v1.png" alt=""></a>
                                    <div class="time">3:50</div>
                                </div>
                                <div class="video-card-body">
                                    <div class="video-title">
                                        <a href="#">The Beauty Show Live</a>
                                    </div>
                                    <div class="video-page text-success">
                                        Education <a title="" data-placement="top" data-toggle="tooltip" href="#" data-original-title="Verified"><i class="fas fa-check-circle text-success"></i></a>
                                    </div>
                                    <div class="video-view">
                                        1.8M views &nbsp;<i class="fas fa-calendar-alt"></i> 11 Months ago
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 mb-3">
                            <div class="video-card">
                                <div class="video-card-image">
                                    <a class="play-icon" href="#"><i class="fas fa-play-circle"></i></a>
                                    <a href="#"><img class="img-fluid" src="img/v2.png" alt=""></a>
                                    <div class="time">3:50</div>
                                </div>
                                <div class="video-card-body">
                                    <div class="video-title">
                                        <a href="#">The Cultural Festival</a>
                                    </div>
                                    <div class="video-page text-success">
                                        Education <a title="" data-placement="top" data-toggle="tooltip" href="#" data-original-title="Verified"><i class="fas fa-check-circle text-success"></i></a>
                                    </div>
                                    <div class="video-view">
                                        1.8M views &nbsp;<i class="fas fa-calendar-alt"></i> 11 Months ago
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 mb-3">
                            <div class="video-card">
                                <div class="video-card-image">
                                    <a class="play-icon" href="#"><i class="fas fa-play-circle"></i></a>
                                    <a href="#"><img class="img-fluid" src="img/v3.png" alt=""></a>
                                    <div class="time">3:50</div>
                                </div>
                                <div class="video-card-body">
                                    <div class="video-title">
                                        <a href="#">Khaligraph Virtual Concert</a>
                                    </div>
                                    <div class="video-page text-success">
                                        Entertainment<a title="" data-placement="top" data-toggle="tooltip" href="#" data-original-title="Verified"><i class="fas fa-check-circle text-success"></i></a>
                                    </div>
                                    <div class="video-view">
                                        1.8M views &nbsp;<i class="fas fa-calendar-alt"></i> 11 Months ago
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 mb-3">
                            <div class="video-card">
                                <div class="video-card-image">
                                    <a class="play-icon" href="#"><i class="fas fa-play-circle"></i></a>
                                    <a href="#"><img class="img-fluid" src="img/v4.png" alt=""></a>
                                    <div class="time">3:50</div>
                                </div>
                                <div class="video-card-body">
                                    <div class="video-title">
                                        <a href="#">Coke Studio</a>
                                    </div>
                                    <div class="video-page text-success">
                                        Education <a title="" data-placement="top" data-toggle="tooltip" href="#" data-original-title="Verified"><i class="fas fa-check-circle text-success"></i></a>
                                    </div>
                                    <div class="video-view">
                                        1.8M views &nbsp;<i class="fas fa-calendar-alt"></i> 11 Months ago
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 mb-3">
                            <div class="video-card">
                                <div class="video-card-image">
                                    <a class="play-icon" href="#"><i class="fas fa-play-circle"></i></a>
                                    <a href="#"><img class="img-fluid" src="img/v5.png" alt=""></a>
                                    <div class="time">3:50</div>
                                </div>
                                <div class="video-card-body">
                                    <div class="video-title">
                                        <a href="#">Khaligraph Virtual Concert</a>
                                    </div>
                                    <div class="video-page text-success">
                                        Education <a title="" data-placement="top" data-toggle="tooltip" href="#" data-original-title="Verified"><i class="fas fa-check-circle text-success"></i></a>
                                    </div>
                                    <div class="video-view">
                                        1.8M views &nbsp;<i class="fas fa-calendar-alt"></i> 11 Months ago
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 mb-3">
                            <div class="video-card">
                                <div class="video-card-image">
                                    <a class="play-icon" href="#"><i class="fas fa-play-circle"></i></a>
                                    <a href="#"><img class="img-fluid" src="img/v6.png" alt=""></a>
                                    <div class="time">3:50</div>
                                </div>
                                <div class="video-card-body">
                                    <div class="video-title">
                                        <a href="#">Khaligraph Virtual Concert</a>
                                    </div>
                                    <div class="video-page text-success">
                                        Entertainment<a title="" data-placement="top" data-toggle="tooltip" href="#" data-original-title="Verified"><i class="fas fa-check-circle text-success"></i></a>
                                    </div>
                                    <div class="video-view">
                                        1.8M views &nbsp;<i class="fas fa-calendar-alt"></i> 11 Months ago
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 mb-3">
                            <div class="video-card">
                                <div class="video-card-image">
                                    <a class="play-icon" href="#"><i class="fas fa-play-circle"></i></a>
                                    <a href="#"><img class="img-fluid" src="img/v7.png" alt=""></a>
                                    <div class="time">3:50</div>
                                </div>
                                <div class="video-card-body">
                                    <div class="video-title">
                                        <a href="#">Khaligraph Virtual Concert</a>
                                    </div>
                                    <div class="video-page text-success">
                                        Education <a title="" data-placement="top" data-toggle="tooltip" href="#" data-original-title="Verified"><i class="fas fa-check-circle text-success"></i></a>
                                    </div>
                                    <div class="video-view">
                                        1.8M views &nbsp;<i class="fas fa-calendar-alt"></i> 11 Months ago
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 mb-3">
                            <div class="video-card">
                                <div class="video-card-image">
                                    <a class="play-icon" href="#"><i class="fas fa-play-circle"></i></a>
                                    <a href="#"><img class="img-fluid" src="img/v8.png" alt=""></a>
                                    <div class="time">3:50</div>
                                </div>
                                <div class="video-card-body">
                                    <div class="video-title">
                                        <a href="#">Khaligraph Virtual Concert</a>
                                    </div>
                                    <div class="video-page text-success">
                                        Education <a title="" data-placement="top" data-toggle="tooltip" href="#" data-original-title="Verified"><i class="fas fa-check-circle text-success"></i></a>
                                    </div>
                                    <div class="video-view">
                                        1.8M views &nbsp;<i class="fas fa-calendar-alt"></i> 11 Months ago
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="mt-0">
                <div class="video-block section-padding">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="main-title">
                                <div class="btn-group float-right right-action">
                                    <a href="#" class="right-action-link text-gray" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
Sort by <i class="fa fa-caret-down" aria-hidden="true"></i>
</a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#"><i class="fas fa-fw fa-star"></i> &nbsp; Top Rated</a>
                                        <a class="dropdown-item" href="#"><i class="fas fa-fw fa-signal"></i> &nbsp; Viewed</a>
                                        <a class="dropdown-item" href="#"><i class="fas fa-fw fa-times-circle"></i> &nbsp; Close</a>
                                    </div>
                                </div>
                                <h6><b>Other Streams</b></h6>
                            </div>
                        </div>
                        <div class="col-xl-2 col-sm-6 mb-3">
                            <div class="channels-card">
                                <div class="channels-card-image">
                                    <a href="#"><img class="img-fluid" src="https://pbs.twimg.com/media/EQuhSfyWAAAPlg1.jpg" alt=""></a>
                                    <div class="channels-card-image-btn"><button type="button" class="btn btn-outline-danger btn-sm">Watch  <strong>Live</strong></button></div>
                                </div>
                                <div class="channels-card-body">
                                    <div class="channels-title">
                                        <a href="#">Vybez Radio</a>
                                    </div>
                                    <div class="channels-view">
                                        382,323 subscribers
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-sm-6 mb-3">
                            <div class="channels-card">
                                <div class="channels-card-image">
                                    <a href="#"><img class="img-fluid" src="https://i0.wp.com/kenyannews.co.ke/wp-content/uploads/2017/03/spice-fm-kenya.png?fit=537%2C395&ssl=1" alt=""></a>
                                    <div class="channels-card-image-btn"><button type="button" class="btn btn-outline-danger btn-sm">Watch  <strong>Live</strong></button></div>
                                </div>
                                <div class="channels-card-body">
                                    <div class="channels-title">
                                        <a href="#">Spice Fm</a>
                                    </div>
                                    <div class="channels-view">
                                        382,323 subscribers
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-sm-6 mb-3">
                            <div class="channels-card">
                                <div class="channels-card-image">
                                    <a href="#"><img class="img-fluid" src="https://www.kenyans.co.ke/files/styles/article_inner/public/images/news/ktn-news_1_0.jpg?itok=k83LJ1eb" alt=""></a>
                                    <div class="channels-card-image-btn"><button type="button" class="btn btn-outline-danger btn-sm">Watch  <strong>Live</strong></button></div>
                                </div>
                                <div class="channels-card-body">
                                    <div class="channels-title">
                                        <a href="#">KTN News <span title="" data-placement="top" data-toggle="tooltip" data-original-title="Verified"><i class="fas fa-check-circle"></i></span></a>
                                    </div>
                                    <div class="channels-view">
                                        382,323 subscribers
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-sm-6 mb-3">
                            <div class="channels-card">
                                <div class="channels-card-image">
                                    <a href="#"><img class="img-fluid" src="https://pbs.twimg.com/profile_images/1187356427888791552/ssvKiHwU_400x400.jpg" alt=""></a>
                                    <div class="channels-card-image-btn"><button type="button" class="btn btn-outline-danger btn-sm">Watch  <strong>Live</strong></button></div>
                                </div>
                                <div class="channels-card-body">
                                    <div class="channels-title">
                                        <a href="#">KTN Home</a>
                                    </div>
                                    <div class="channels-view">
                                        382,323 subscribers
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-sm-6 mb-3">
                            <div class="channels-card">
                                <div class="channels-card-image">
                                    <a href="#"><img class="img-fluid" src="https://i2.wp.com/www.magaripoa.com/gari/wp-content/uploads/farmers.jpg?fit=1566%2C670&ssl=1" alt=""></a>
                                    <div class="channels-card-image-btn"><button type="button" class="btn btn-outline-danger btn-sm">Watch  <strong>Live</strong></button></div>
                                </div>
                                <div class="channels-card-body">
                                    <div class="channels-title">
                                        <a href="#">Farmers TV</a>
                                    </div>
                                    <div class="channels-view">
                                        382,323 subscribers
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-sm-6 mb-3">
                            <div class="channels-card">
                                <div class="channels-card-image">
                                    <a href="#"><img class="img-fluid" src="https://www.btvkenya.ke/btv/assets/images/logo3.png" alt=""></a>
                                    <div class="channels-card-image-btn"><button type="button" class="btn btn-outline-danger btn-sm">Watch  <strong>Live</strong></button></div>
                                </div>
                                <div class="channels-card-body">
                                    <div class="channels-title">
                                        <a href="#">BTV Kenya</a>
                                    </div>
                                    <div class="channels-view">
                                        382,323 subscribers
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

@endsection
@section('footer')

@endsection
