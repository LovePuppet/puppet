<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('/images/head.jpg') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ isset(session('user')[0]['admin_name']) ? session('user')[0]['admin_name'] : '' }} {{ isset(session('user')[0]['real_name']) ? session('user')[0]['real_name'] : '' }}</p>
                <a href="javascript:void(0);"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
        <ul class="sidebar-menu">
            @if(App\Components\MenuTools::isShowMenu(['/admin/list','/admin/role/list','/admin/limit/list']))
                @if((isset($admin_tree_menu) && $admin_tree_menu) || (isset($admin_role_tree_menu) && $admin_role_tree_menu) || (isset($admin_limit_tree_menu) && $admin_limit_tree_menu))
                    <li class="active treeview">
                @else
                    <li class="treeview">
                @endif
                    <a href="#"><i class="fa fa-laptop"></i> <span>权限管理</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        @if(App\Components\MenuTools::isShowMenu(['/admin/list']))
                            <li @if((isset($admin_tree_menu) && $admin_tree_menu))class="active" @endif><a href="/admin/list"><i class="fa fa-circle-o"></i>管理员列表</a></li>
                        @endif
                        @if(App\Components\MenuTools::isShowMenu(['/admin/role/list','/admin/limit/list']))
                        <li @if((isset($admin_role_tree_menu) && $admin_role_tree_menu) || (isset($admin_limit_tree_menu) && $admin_limit_tree_menu))class="active"@endif>
                            <a href="#"><i class="fa fa-circle-o"></i>管理员类型
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            @if((isset($admin_role_tree_menu) && $admin_role_tree_menu) || (isset($admin_limit_tree_menu) && $admin_limit_tree_menu))
                            <ul class="treeview-menu menu-open" style="display:block;">
                            @else
                            <ul class="treeview-menu" style="display:none;">
                            @endif
                                @if(App\Components\MenuTools::isShowMenu(['/admin/role/list']))
                                    <li @if((isset($admin_role_tree_menu) && $admin_role_tree_menu))class="active" @endif>
                                        <a href="/admin/role/list"><i class="fa fa-circle-o"></i>角色配置</a>
                                    </li>
                                @endif
                                @if(App\Components\MenuTools::isShowMenu(['/admin/limit/list']))
                                    <li @if((isset($admin_limit_tree_menu) && $admin_limit_tree_menu))class="active" @endif>
                                        <a href="/admin/limit/list"><i class="fa fa-circle-o"></i>权限配置</a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                        @endif
                    </ul>
                </li>
            @endif
        </ul>
    </section>
</aside>