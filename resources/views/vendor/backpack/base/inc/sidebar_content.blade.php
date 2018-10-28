<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li><a href="{{ backpack_url('dashboard') }}"><i class="fa fa-dashboard"></i> <span>{{ trans('backpack::base.dashboard') }}</span></a></li>

<li><a href="{{  backpack_url('products') }}"><i class="fa fa-shopping-bag"></i> <span>Products</span></a></li>
<li><a href="{{  backpack_url('activities') }}"><i class="fa fa-bar-chart"></i> <span>Activities</span></a></li>

<li class="active treeview menu-open">
    <a href="#">
        <i class="fa fa-book"></i> <span>Directories</span>
        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
    </a>
    <ul class="treeview-menu">
        <li><a href="{{  backpack_url('categories') }}"><i class="fa fa-book"></i> <span>Categories</span></a></li>
        <li><a href="{{  backpack_url('countries') }}"><i class="fa fa-globe"></i> <span>Countries</span></a></li>
    </ul>
</li>



<li class="active treeview menu-open">
    <a href="#">
        <i class="fa fa-dashboard"></i> <span>Settings</span>
        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
    </a>
    <ul class="treeview-menu">
        <li><a href="{{  backpack_url('users') }}"><i class="fa fa-users"></i> <span>Users</span></a></li>
        <li><a href="{{  backpack_url('elfinder') }}"><i class="fa fa-files-o"></i> <span>File manager</span></a></li>
        <li><a href="{{  route('admin.quiz-statistic') }}"><i class="fa fa-bar-chart-o"></i> <span>Statistic of Quiz</span></a></li>
    </ul>
</li>


