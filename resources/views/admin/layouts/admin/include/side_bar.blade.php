<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="http://markinternational.info/data/out/565/223867976-avatar-images.png" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name}}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Menu</li>
            <li class="{{ (Route::current() == 'admin/users')? 'active' : '' }}">
                <a href="{{route('admin.User.index')}}">
                    <i class="fa fa-user-plus"></i> <span>Users management</span>
                </a>
            </li>
            <li class="{{ (Route::current() == 'admin/category')? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-newspaper-o"></i> <span>Category management</span>
                </a>
            </li>
            <li class="{{ (Route::current() == 'admin/role')? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-user-plus"></i> <span>Role management</span>
                </a>
            </li>
            <li class="{{ (Route::current() == 'amdin/articles')? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-image"></i> <span>Articles management</span>
                </a>
            </li>



        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
