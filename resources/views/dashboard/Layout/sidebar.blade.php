<div class="page-sidebar-wrapper">
    <!-- BEGIN SIDEBAR -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->
        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
            <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
            <li class="sidebar-toggler-wrapper hide">
                <div class="sidebar-toggler">
                    <span></span>
                </div>
            </li>
            <!-- END SIDEBAR TOGGLER BUTTON -->
            <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
            <li class="sidebar-search-wrapper">
                <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
                <!-- DOC: Apply "sidebar-search-bordered" class the below search form to have bordered search box -->
                <!-- DOC: Apply "sidebar-search-bordered sidebar-search-solid" class the below search form to have bordered & solid search box -->
{{--                <form class="sidebar-search  sidebar-search-bordered" action="page_general_search_3.html" method="POST">
                    <a href="javascript:;" class="remove">
                        <i class="icon-close"></i>
                    </a>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                                            <a href="javascript:;" class="btn submit">
                                                <i class="icon-magnifier"></i>
                                            </a>
                                        </span>
                    </div>
                </form>--}}
                <!-- END RESPONSIVE QUICK SEARCH FORM -->
            </li>
            {{--<li class="nav-item start ">--}}

            <li class="nav-item  @if (Route::currentRouteName() ==  'root.booking.index') active @endif">
                <a href="{{ route("root.booking.index") }}" class="nav-link ">
                    <i class="fa fa-list" aria-hidden="true"></i>
                    <span class="title">Бронирования</span>
                </a>
            </li>

            <li class="nav-item  @if (Route::currentRouteName() ==  'root.client.index') active @endif">
                <a href="{{ route("root.client.index") }}" class="nav-link ">
                    <i class="fa fa-users" aria-hidden="true"></i>
                    <span class="title">Круизные Клиенты</span>
                </a>
            </li>

            <li class="nav-item  @if (Route::currentRouteName() ==  'root.ship.index') active @endif">
                <a href="{{ route("root.ship.index") }}" class="nav-link ">
                    <i class="fa fa-archive" aria-hidden="true"></i>
                    <span class="title">Корабли</span>
                </a>
            </li>
{{--            <li class="nav-item  @if (Route::currentRouteName() ==  'root.setting.index') active @endif">
                <a href="{{ route("root.setting.index") }}" class="nav-link ">
                    <i class="fa fa-cog" aria-hidden="true"></i>
                    <span class="title">Настройки</span>
                </a>
            </li>--}}


   {{--         <li class="nav-item  @if (in_array(Route::currentRouteName(), [
                    'root.telban.index',
                    'root.ipban.index',
                    ] ))
                    active
                @endif ">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-diamond"></i>
                    <span class="title">Blocked</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item @if (Route::currentRouteName() ==  'root.telban.index') active @endif ">
                        <a href="{{ route("root.telban.index") }}" class="nav-link ">
                            <span class="title">Tel-ban</span>
                        </a>
                    </li>
                    <li class="nav-item  @if (Route::currentRouteName() ==  'root.ipban.index') active @endif">
                        <a href="{{ route("root.ipban.index") }}" class="nav-link ">
                            <span class="title">IP ban</span>
                        </a>
                    </li>
                </ul>
            </li>--}}
        </ul>
        <!-- END SIDEBAR MENU -->
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>