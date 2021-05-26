<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="@yield('description')">
    <meta name="author" content="@yield('author')">

    <title>{{ config('app.name') }} - @yield('title')</title>

    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
    @yield('header')
</head>

<body>
<div class="wrapper">
    @include('cms.includes.sidebar')
    <div class="main">
        <nav class="navbar navbar-expand navbar-light bg-white sticky-top">
            <a class="sidebar-toggle d-flex mr-3">
                <i class="align-self-center" data-feather="menu"></i>
            </a>



            <div class="navbar-collapse collapse">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-icon dropdown-toggle ml-2 d-inline-block d-sm-none" href="#" id="userDropdown" data-toggle="dropdown">
                            <div class="position-relative">
                                <i class="align-middle mt-n1" data-feather="settings"></i>
                            </div>
                        </a>
                        <a class="nav-link nav-link-user dropdown-toggle d-none d-sm-inline-block" href="#" id="userDropdown" data-toggle="dropdown">
                            <img src="{{ asset('assets/img/avatar.png') }}" class="avatar img-fluid rounded mr-1" alt="Avatar" />
                            <span class="text-dark">{{ Auth::user()->name }}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="{{ url("profile") }}">Profile</a>
                            <a class="dropdown-item" href="{{ route('logout') }}"  onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">{{ __('Sign out') }}</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                                <input type="hidden" name="redirect" value="{{ url('login') }}">
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>

