<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="/profileimages/<?=$email?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><b><?=$display_name?></b></p>
                <p><?=$email?></p>
            </div>
        </div>

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
        <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
        </button>
      </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">Useful Links</li>
            <!-- Optionally, you can add icons to the links -->
            <li><a href="//andrew.t28.net/phpmyadmin/"><i class="fa fa-list-alt"></i> <span>phpMyAdmin</span></a>
            </li>

            <li class="treeview">
                <a href="#"><i class="fa fa-envelope"></i>
                  <span>Mail Stuff</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="//andrew.t28.net/mailadmin"><i class="fa fa-th-list"></i> <span>Mail Admin</span></a>
                    </li>
                    <li><a href="//andrew.t28.net/mail"><i class="fa fa-envelope"></i> <span>Mail Client</span></a>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
