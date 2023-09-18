<div class="container-fluid g-0">
    <div class="row">
        <div class="col-lg-12 p-0">
            <div class="header_iner d-flex justify-content-between align-items-center">
                <div class="sidebar_icon d-lg-none">
                    <i class="ti-menu"></i>
                </div>
                <div class="serach_field-area d-flex align-items-center">
                    <div class="search_inner">
                        <form action="#">
                            <div class="search_field">
                                <input type="text" placeholder="Search here...">
                            </div>
                            <button type="submit"> <img src="img/icon/icon_search.svg" alt> </button>
                        </form>
                    </div>

                </div>
                <div class="header_right d-flex justify-content-between align-items-center">
                    <div class="header_notification_warp d-flex align-items-center">
                        <li>
                            <a class="bell_notification_clicker nav-link-notify" href="#"> <img
                                    src="img/icon/bell.svg" alt>
                            </a>
                        </li>
                        <li>
                            <a class="CHATBOX_open nav-link-notify" href="#"> <img src="img/icon/msg.svg"alt>
                            </a>
                        </li>
                    </div>
                    <div class="profile_info">
                        <img src="img/client_img.png" alt="#">
                        <div class="profile_info_iner">
                            <div class="profile_author_name">
                                <li style="color: white">Welcome, {{ session('sess_user_name') }}</li> 
                                <li>{{ session('sess_email') }}</li>
                            </div>
                            <div class="profile_info_details">
                                <a href="{{ route('logout') }}">Log Out </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
