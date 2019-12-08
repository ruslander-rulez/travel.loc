  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{'/'}}" class="brand-link logo-switch">
      <img src="{{ asset("dashboard/layouts/layout/img/logo.png") }}" alt="AdminLTE Docs Logo Small" class="brand-image-xs logo-xs">
      <img src="{{ asset("dashboard/layouts/layout/img/logo.png") }}" alt="AdminLTE Docs Logo Large" class="brand-image-xl logo-xl" style="left: 12px">
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview menu-open">
                    <a href="{{ route("web.chat.index") }}" class="nav-link active">
                        <i class="fa fa-comments" aria-hidden="true"></i>
                        <p>
                            Messages
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
  </aside>
