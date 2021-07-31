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
                                <i class="mdi mdi-home"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        @canany(['See All Categories', 'Create Category', 'See All Galleries', 'Create Gallery'])
                        <li>
                            <a href="javascript:void(0);" class="has-arrow waves-effect">
                                <i class="mdi mdi-clipboard-list"></i>
                                <span>Res Controllers</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                @can('See All Categories')
                                <li><a href="{{ route('categories.index') }}">Categories</a></li>
                                @endcan
                                @can('Create Category')
                                <li><a href="{{ route('categories.create') }}">Add Category</a></li>
                                @endcan
                                @can('See All Galleries')
                                <li><a href="{{ route('gallery.index') }}">Gallery</a></li>
                                @endcan
                                @can('Create Gallery')
                                <li><a href="{{ route('gallery.create') }}">Add Image</a></li>
                                @endcan
                            </ul>
                        </li>
                        @endcanany
                        @can('See Excel Operations')
                        <li>
                            <a href="{{ route('excel') }}" class="waves-effect">
                                <i class="mdi mdi-file-excel-outline"></i>
                                <span>Excel Operations</span>
                            </a>
                        </li>
                        @endcan
                        @can('See Ajax Operations')
                        <li>
                            <a href="{{ route('ajax') }}" class="waves-effect">
                                <i class="mdi mdi-swap-vertical"></i>
                                <span>Ajax Operations</span>
                            </a>
                        </li>
                        @endcan
                        @canany(['See All Users', 'Create User', 'See All Roles', 'Create Role', 'See All Permissions', 'Create Permission'])
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="mdi mdi-security"></i>
                                <span key="t-multi-level">Access Management</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="true">
                                @canany(['See All Users', 'Create User'])
                                <li>
                                    <a href="javascript: void(0);" class="has-arrow" key="t-level-1-2">Users</a>
                                    <ul class="sub-menu" aria-expanded="true">
                                        @can('See All Users')
                                        <li><a href="{{ route('users.index') }}" key="t-level-2-1">Users</a></li>
                                        @endcan
                                        @can('Create User')
                                        <li><a href="{{ route('users.create') }}" key="t-level-2-2">Create</a></li>
                                        @endcan
                                    </ul>
                                </li>
                                @endcanany
                                @canany(['See All Roles', 'Create Role'])
                                <li>
                                    <a href="javascript: void(0);" class="has-arrow" key="t-level-1-2">Roles</a>
                                    <ul class="sub-menu" aria-expanded="true">
                                        @can('See All Roles')
                                        <li><a href="{{ route('roles.index') }}" key="t-level-2-1">Roles</a></li>
                                        @endcan
                                        @can('Create Role')
                                        <li><a href="{{ route('roles.create') }}" key="t-level-2-2">Create</a></li>
                                        @endcan
                                    </ul>
                                </li>
                                @endcanany
                                @canany(['See All Permissions', 'Create Permission'])
                                <li>
                                    <a href="javascript: void(0);" class="has-arrow" key="t-level-1-2">Permissions</a>
                                    <ul class="sub-menu" aria-expanded="true">
                                        @can('See All Permissions')
                                        <li><a href="{{ route('permissions.index') }}" key="t-level-2-1">Permissions</a></li>
                                        @endcan
                                        @can('Create Permission')
                                        <li><a href="{{ route('permissions.create') }}" key="t-level-2-2">Create</a></li>
                                        @endcan
                                    </ul>
                                </li>
                                @endcanany
                            </ul>
                        </li>
                        @endcanany
                    </ul>
                </div>
                <!-- Sidebar -->
            </div>
        </div>
        <!-- Left Sidebar End -->
