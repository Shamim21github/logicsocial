<!DOCTYPE html>
<html lang="en">



<head>
    <title>LogicSocial</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- {{ asset('assets/vendor/jqvmap/css/jqvmap.min.css') }} -->
    <link rel="icon" type="image/png" href="{{ asset('login/images/icons/favicon.ico') }}" />

    <link rel="stylesheet" type="text/css" href="{{ asset('login/vendor/bootstrap/css/bootstrap.min.css') }}">

    <link rel="stylesheet" type="text/css"
        href="{{ asset('login/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('login/vendor/animate/animate.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('login/vendor/css-hamburgers/hamburgers.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('login/vendor/select2/select2.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('login/css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('login/css/main.css') }}">

    <meta name="robots" content="noindex, follow">
    <script nonce="98adb81f-ace4-4fbc-9b3c-253a3877fc2f">
        (function(w, d) {
            ! function(bg, bh, bi, bj) {
                bg[bi] = bg[bi] || {};
                bg[bi].executed = [];
                bg.zaraz = {
                    deferred: [],
                    listeners: []
                };
                bg.zaraz.q = [];
                bg.zaraz._f = function(bk) {
                    return function() {
                        var bl = Array.prototype.slice.call(arguments);
                        bg.zaraz.q.push({
                            m: bk,
                            a: bl
                        })
                    }
                };
                for (const bm of ["track", "set", "debug"]) bg.zaraz[bm] = bg.zaraz._f(bm);
                bg.zaraz.init = () => {
                    var bn = bh.getElementsByTagName(bj)[0],
                        bo = bh.createElement(bj),
                        bp = bh.getElementsByTagName("title")[0];
                    bp && (bg[bi].t = bh.getElementsByTagName("title")[0].text);
                    bg[bi].x = Math.random();
                    bg[bi].w = bg.screen.width;
                    bg[bi].h = bg.screen.height;
                    bg[bi].j = bg.innerHeight;
                    bg[bi].e = bg.innerWidth;
                    bg[bi].l = bg.location.href;
                    bg[bi].r = bh.referrer;
                    bg[bi].k = bg.screen.colorDepth;
                    bg[bi].n = bh.characterSet;
                    bg[bi].o = (new Date).getTimezoneOffset();
                    if (bg.dataLayer)
                        for (const bt of Object.entries(Object.entries(dataLayer).reduce(((bu, bv) => ({
                                ...bu[1],
                                ...bv[1]
                            }))))) zaraz.set(bt[0], bt[1], {
                            scope: "page"
                        });
                    bg[bi].q = [];
                    for (; bg.zaraz.q.length;) {
                        const bw = bg.zaraz.q.shift();
                        bg[bi].q.push(bw)
                    }
                    bo.defer = !0;
                    for (const bx of [localStorage, sessionStorage]) Object.keys(bx || {}).filter((bz => bz
                        .startsWith("_zaraz_"))).forEach((by => {
                        try {
                            bg[bi]["z_" + by.slice(7)] = JSON.parse(bx.getItem(by))
                        } catch {
                            bg[bi]["z_" + by.slice(7)] = bx.getItem(by)
                        }
                    }));
                    bo.referrerPolicy = "origin";
                    bo.src = "../../../cdn-cgi/zaraz/sd0d9.js?z=" + btoa(encodeURIComponent(JSON.stringify(bg[
                        bi])));
                    bn.parentNode.insertBefore(bo, bn)
                };
                ["complete", "interactive"].includes(bh.readyState) ? zaraz.init() : bg.addEventListener(
                    "DOMContentLoaded", zaraz.init)
            }(w, d, "zarazData", "script");
        })(window, document);
    </script>
    <style>
        body {
            background-image: url('{{ asset('login/images/loginbg.jpg') }}');
            background-size: cover;
            height: 100vh;


        }

        .form-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #fff;
            text-align: center;
        }

        .form-container h2 {
            font-family: cursive;
        }

        .form-container a {
            color: #fff;
            margin: 7px 0;
        }

        .form-container p {
            font-weight: bold;
            color: #a3d0ff;
            font-size: 25px;
            margin: 10px 0;
        }

        .form-content {
            padding: 15px 20px;
            width: 600px !important;
            background: rgba(0, 0, 0, 0.8);
            border-radius: 10px;
        }

        .form-container input {
            width: 100% !important;
        }

        .form-container input[type="submit"] {
            margin-top: 15px;
            background: #22a6b3;
            color: #ffffff;
            cursor: pointer;
            font-family: cursive;
        }

        .form-container .create__account {
            margin: 5PX 0;
        }

        .form-container .twitter {
            background: #1DA1F2;
        }

        .form-container .google {
            background: #c0392b;
        }
    </style>
</head>

<body>


    <form action="{{ route('auth') }}" method="post">
        @csrf
        <div class="form-container d-flex justify-content-center align-items-center">
            <div class="form-content">
                <h2>LogicSocial</h2>
                <p>Login Form</p>
                <div class="user_name wrap-input100 validate-input m-b-10" data-validate="Username is required">
                    <input class="input100" type="text" name="txtUsername" placeholder="Username">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <i class="fa fa-user"></i>
                    </span>
                </div>
                <div class="password wrap-input100 validate-input m-b-10" data-validate="Password is required">
                    <input class="input100" type="password" name="txtPassword" placeholder="Password">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <i class="fa fa-lock"></i>
                    </span>
                </div>
                <div class="submitBtn container-login100-form-btn ">
                    <input type="submit" name="btnLogin" value="LOGIN" class="btn btn-dark btn-block">
                </div>
                <span>OR</span>
                <div class="social__login d-flex align-items-center flex-column mt-2">
                    <a class="fb ml-1 btn btn-primary" href="{{ route('facebook.login') }}" id="btn-fblogin">
                        <i class="fa fa-facebook-square" aria-hidden="true"></i> Login with Facebook
                    </a>
                    <a class="twitter ml-1 btn btn-primary" href="{{ route('twitter.login') }}" id="btn-fblogin">
                        <i class="fa fa-twitter" aria-hidden="true" style="margin-right:15px;"></i>
                        Login with Twitter
                    </a>
                    <a class="google ml-1 btn btn-primary" href="{{ route('google.login') }}" id="btn-fblogin">
                        <i class="fa fa-google" aria-hidden="true" style="margin-right:15px;"></i>
                        Login with Google
                    </a>

                    <div class="create__account text-center">
                        <a href="{{ route('register') }}">Create New Account</a> <br>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script src="{{ asset('login/vendor/jquery/jquery-3.2.1.min.js') }}"></script>

    <script src="{{ asset('login/vendor/bootstrap/js/popper.js') }}"></script>
    <script src="{{ asset('login/vendor/bootstrap/js/bootstrap.min.js') }}"></script>

    <script src="{{ asset('login/vendor/select2/select2.min.js') }}"></script>

    <script src="{{ asset('login/js/main.js') }}"></script>

    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-23581568-13');
    </script>

</body>


</html>
