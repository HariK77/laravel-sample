        <!-- ========== Left Sidebar Start ========== -->
        <div class="vertical-menu">

            <div data-simplebar class="h-100">

                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <!-- Left Menu Start -->
                    <ul class="metismenu list-unstyled" id="side-menu">
                        <li class="menu-title">Menu</li>

                        <li>
                            <a href="{{ route('dashboard') }}" class="waves-effect">
                                <i class="bx bx-home-circle"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li>
                            <a href="javascript:void(0);" class="has-arrow waves-effect">
                                <i class="bx bx-home-circle"></i>
                                <span>Res Controllers</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ route('categories.index') }}">Categories</a></li>
                                <li><a href="{{ route('categories.create') }}">Add Category</a></li>
                                <li><a href="{{ route('gallery.index') }}">Gallery</a></li>
                                <li><a href="{{ route('gallery.create') }}">Add Image</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{ route('excel') }}" class="waves-effect">
                                <i class="bx bx-home-circle"></i>
                                <span>Excel Operations</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- Sidebar -->
            </div>
        </div>
        <!-- Left Sidebar End -->
