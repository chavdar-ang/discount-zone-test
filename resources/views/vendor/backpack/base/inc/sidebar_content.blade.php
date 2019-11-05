<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="fa fa-dashboard nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>
<li class=nav-item><a class=nav-link href="{{ backpack_url('elfinder') }}"><i class="nav-icon fa fa-files-o"></i> <span>{{ trans('backpack::crud.file_manager') }}</span></a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('role') }}'><i class='nav-icon fa fa-question'></i> Roles</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('user') }}'><i class='nav-icon fa fa-question'></i> Users</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('partner') }}'><i class='nav-icon fa fa-question'></i> Partners</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('discount') }}'><i class='nav-icon fa fa-question'></i> Discounts</a></li>