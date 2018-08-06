<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ url('templates/admin') }}/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ \Auth::user()->name }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
    <?php
    $allow_route = [];

    $arr_permission = get_allow_route_name(\Auth::user()->id_group);
    // dd($arr_permission);
    if (isset($arr_permission)) {
        $allow_route = json_decode($arr_permission->permission, true);
    }


    // var_dump($allow_route);
    ?>

    <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">

            @php
                $array_menu = [];
                $argv_0['header'] = 'Thống kê';
                $argv_0['menu'] = [
                    ['name'=>'Kê khai MHKD tại chợ','route' => 'admin.thongke.mhkd.list'],
                    [
                        'name' => 'THKH Theo Nhóm ngành',
                        'route' => 'admin.thong_ke.tinh_hinh_ke_khai_theo_nhom_nganh',
                        'alias' => 'tinh_hinh_ke_khai_theo_nhom_nganh',
                    ],
                    ['name'=>'Hồ sơ quản lí ATTP','route' => 'admin.quanly.hoso.attp'],

                    ['name'=>'Kê khai MHKD tại chợ','route' => 'admin.thong_ke.ke-khai-mhkd-tai-cho-truyen-thong'],
                ];
                $array_menu[]= $argv_0;
                $argv_1['header'] = 'Quản lý ';
                $argv_1['menu'] = [



                    [
                        'name' => 'Hộ Kinh Doanh',
                        'route' => '',
                        'alias' => 'ho_kinh_doanh',
                        'submenu'=>[
                            ['name'=>'Danh sách hộ kinh doanh','route' => 'admin.ho_kinh_doanh.list'],
                            ['name'=>'Thêm hộ kinh doanh','route' => 'admin.ho_kinh_doanh.add']
                        ]
                    ],

                    [
                        'name' => 'QL Chợ',
                        'route' => '',
                        'alias' => 'ql_cho',
                        'submenu'=>[
                            ['name'=>'Danh sách chợ ','route' => 'admin.cho.list'],
                            ['name'=>'Thêm chợ ','route' => 'admin.cho.add']
                        ]
                    ],
                    [
                        'name' => 'QL Sạp',
                        'alias' => 'ql_sap',
                        'route' => '',
                        'submenu'=>[
                            ['name'=>'Danh sách sạp','route' => 'admin.sap.list'],
                            ['name'=>'Thêm sạp ','route' => 'admin.sap.create']
                        ]
                    ],
                    [
                        'name' => 'QL cơ sở cung cấp',
                        'route' => '',
                        'submenu'=>[
                            ['name'=>'Danh sách cơ sở cung cấp','route' => 'admin.co_so_cung_cap.list'],
                            ['name'=>'Thêm cơ sở cung cấp ','route' => 'admin.co_so_cung_cap.create'],
                        ]
                    ],
                    [
                        'name' => 'QL đơn vị tính',
                        'route' => '',
                        'submenu'=>[
                            ['name'=>'Danh sách đơn vị tính','route' => 'admin.don-vi-tinh.list'],
                            ['name'=>'Thêm đơn vị tính ','route' => 'admin.don-vi-tinh.create'],
                        ]
                    ],
                    [
                        'name' => 'QL ngành kinh doanh',
                        'route' => '',
                        'submenu'=>[
                            ['name'=>'Danh sách ngành kinh doanh','route' => 'admin.nganh_kinh_doanh.list'],
                              ['name'=>'Thêm ngành kinh doanh ','route' => 'admin.nganh_kinh_doanh.create'],


                        ]
                    ],




                ];
                $array_menu[]= $argv_1;

                $argv_2['header'] = 'Cài đặt ';
                $argv_2['menu'] = [
                     [
                        'name' => 'User',
                        'alias' => 'user',
                        'route' => '',
                        'submenu'=>[
                            ['name'=>'List User','route' => 'admin.user.list'],
                            ['name'=>'Add User','route' => 'admin.user.add'],
                        ]
                    ],
                    [
                        'name' => 'Group user',
                        'route' => 'admin.group.list',
                        'alias' => 'group_user',
                    ],
                ];
                $array_menu[]= $argv_2;

            @endphp

            @foreach($array_menu as $item)
                <li class="header">{{ $item['header'] }}</li>
                @foreach($item['menu'] as $key => $menu)
                    <?php
                    $hide = '';
                    if (!isset($menu['submenu'])) {
                        $a = [];
                        $a = $menu['route']; // var_dump(in_array($a, $allow_route));
                        $hide = !empty($a) && !empty($allow_route) && in_array($a, $allow_route) ? '' : 'display: none';
                    } else {
                        $hide = '';
                    }
                    ?>
                    <li style="{{\Auth::user()->id_group!=0 ? $hide : ''}}"
                        class="@if(isset($menu['submenu'])) treeview @endif  {{ isset($menu['submenu']) && in_array(get_current_route_name(),array_pluck($menu['submenu'],'route')) == true  ? 'menu-open'  : ''}}">
                        <a href="{{ $menu['route'] != '' ? route($menu['route']) : '#' }}">
                            <i class="fa fa-dashboard"></i> <span>{{ $menu['name'] }}</span>
                            @if(isset($menu['submenu']))
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            @endif
                        </a>
                        @if(isset($menu['submenu']))
                            <ul class="treeview-menu"
                                style="{{ in_array(get_current_route_name(),array_pluck($menu['submenu'],'route')) == true  ? 'display: block;'  : ''}} ">
                                <?php
                                $num_sub = count($menu['submenu']);
                                ?>
                                @foreach($menu['submenu'] as $sub)
                                    <?php
                                    $i = 0;
                                    $hide_sub = '';
                                    $b = [];
                                    $b = $sub['route'];
                                    // if(!in_array($b, $allow_route)){
                                    //     $hide_sub = 'display: none';
                                    //     $i++;
                                    // }
                                    // else {
                                    //     $hide_sub = '';
                                    // }
                                    // var_dump($b);
                                    ?>
                                    @if((!empty($b) && !empty($allow_route) && in_array($b, $allow_route)) || \Auth::user()->id_group==0)
                                        <li class="active">
                                            <a href="{{ $sub['route'] != '' ? route($sub['route']) : '#' }}">
                                                <i class="fa fa-circle-o"></i>{{ $sub['name'] }}</a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach

            @endforeach


        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
<script>
    $(function () {
        $('.sidebar-menu li.treeview>ul.treeview-menu').each(function () {
            var hasChild = $(this).find('>li').length > 0;
            if (!hasChild) {
                $(this).parent().remove();
            }
        });
    });
</script>
