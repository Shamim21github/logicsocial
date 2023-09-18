@extends('layout.erp.app')

@section('page')
    <style>
        .modal-backdrop.show {
            display: none
        }

        .main_upper {
            min-height: 150px;
            width: 100vw;
            background: #64C5B1;
            padding: 10px;
        }
    </style>
    <div class="main_upper">
        <div class="container-fluid p-0 ">
            <div class="row">
                <div class="col-12">

                    <div>
                        @if ($user)
                            <h1 style="font-size:15px;font-weight:lighter;color:rgb(0, 0, 0);">Welcome to the
                                Dashboard, {{ $user->username }}</h1>
                        @else
                            <h1 style="font-size:15px;font-weight:lighter;color:rgb(0, 0, 0);">Welcome to the
                                Dashboard</h1>
                        @endif
                    </div>
                    <div class="page_title_box d-flex align-items-center justify-content-between">
                        <div class="page_title_left">
                            <h3 class="f_s_30 f_w_700 text_white">Connected</h3>
                        </div>
                    </div>
                    <div>
                        <button type="button" class="m-0 p-0  border-0" data-toggle="modal" data-target="#exampleModal"
                            style="all : unset;">
                            <img style="border-radius: 30px;"src="{{ asset('img/social_icons/add_button.svg') }}" alt>
                        </button>
                    </div>

                    @if (session()->has('twitterUser'))
                        <span class="w-25 justify-content-center align-items-center">
                            @php
                                $twitterUser = session('twitterUser');
                            @endphp
                            <span>
                                @if ($twitterUser)
                                    <img style="border-radius: 5px; margin-left: 90px;" src="{{ $twitterUser->avatar }}"
                                        alt="Twitter Avatar">
                                    <p style="color: black;margin-left: 90px;font-weight:bold;">{{ $twitterUser->name }}</p>
                                @else
                                    <p></p>
                                @endif
                            </span>
                        </span>
                    @endif

                    @if (session()->has('facebookUser'))
                        <span class="text-center">
                            @php
                                $facebookUser = session('facebookUser');
                                $facebookPages = session('facebookPages');
                            @endphp
                        </span>
                        <div class="d-flex align-items-center">
                            @if ($facebookUser)
                                <div class="mr-4 text-center">
                                    <img style="width: 50px;height:50px;font-weight:bold;"
                                        src="{{ session('facebookUser')->avatar }}" alt="Facebook Avatar">
                                    <p style="font-weight:bold;color:black">{{ session('facebookUser')->name }}</p>
                                </div>
                                <div class="d-flex text-center flex-wrap">
                                    @foreach ($facebookPages as $page)
                                        <div class="page mr-4">
                                            <img src="{{ $page->page_avatar }}" alt="Page Avatar"
                                                style="width: 50px;height:50px;font-weight:bold">
                                            <p style="font-weight:bold;color:black;font-size:14px;">{{ $page->page_name }}
                                            </p>
                                        </div>
                                    @endforeach
                                </div>
                        </div>
                    @else
                        <p></p>
                    @endif
                </div>
                </span>
                @endif
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Social Account Connect</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="d-flex flex-wrap justify-content-between">
                                    <div class="w-25 text-center">
                                        <a href="{{ route('facebook.login') }}">
                                            <img style="width: 50px;height:50px;"
                                                src="{{ asset('img/social_icons/facebook.svg') }}" alt>
                                            <p>Facebook</p>
                                        </a>
                                    </div>
                                    {{-- @if (session('facebookPages'))
                                            <h2>Facebook Pages</h2>
                                            <ul>
                                                @foreach (session('facebookPages') as $page)
                                                    <li>
                                                        {{ $page['name'] }} - {{ $page['id'] }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif --}}
                                    <div class="w-25 text-center">
                                        <img style="width: 50px;height:50px;"
                                            src="{{ asset('img/social_icons/instagram.svg') }}" alt>
                                        <p>Instagram</p>
                                    </div>
                                    <div class="w-25 text-center">
                                        <a href="{{ route('twitter.login') }}">
                                            <img style="width: 50px;height:50px;"
                                                src="{{ asset('img/social_icons/twitter.svg') }}" alt>
                                            <p>Twitter</p>
                                        </a>
                                    </div>

                                    {{-- <div class="w-25 text-center">
                                            @if ($twitterUser)
                                                <img style="width: 50px;height:50px;"
                                                    src="{{ asset('img/social_icons/twitter.svg') }}" alt>
                                                <p>Connected with Twitter</p>
                                            @else
                                                <a href="{{ route('twitter.login') }}">
                                                    <img style="width: 50px;height:50px;"
                                                        src="{{ asset('img/social_icons/twitter.svg') }}" alt>
                                                    <p>Twitter</p>
                                                </a>
                                            @endif
                                        </div> --}}


                                    <div class="w-25 text-center">

                                        <a href="{{ route('linkedin.login') }}">
                                            <img style="width: 50px;height:50px;"
                                                src="{{ asset('img/social_icons/linkedin.svg') }}" alt>
                                            <p>Linkedin</p>
                                        </a>
                                    </div>
                                    <div class="w-25 text-center">
                                        <img style="width: 50px;height:50px;"
                                            src="{{ asset('img/social_icons/tiktok.svg') }}" alt>
                                        <p>Tiktok</p>
                                    </div>
                                    <div class="w-25 text-center">
                                        <img style="width: 50px;height:50px;"
                                            src="{{ asset('img/social_icons/youtube.svg') }}" alt>
                                        <p>Youtube</p>
                                    </div>
                                    <div class="w-25 text-center">
                                        <img style="width: 50px;height:50px;"
                                            src="{{ asset('img/social_icons/pinterest.svg') }}" alt>
                                        <p>Pinterest</p>
                                    </div>

                                    <div class="w-25 text-center">
                                        <img style="width: 50px;height:50px;"
                                            src="{{ asset('img/social_icons/whatsapp.svg') }}" alt>
                                        <p>Whatsapp</p>
                                    </div>

                                </div>


                            </div>

                        </div>
                    </div>
                </div>








            </div>
        </div>
    </div>
    </div>
@endsection
