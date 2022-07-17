<div class="sidebar-menu">
    <div class="sidebar-header">
        <div class="logo">
            <a href="index.html"><img src="{{ asset('backend/assets/images/icon/logo.png') }} " alt="logo"></a>
        </div>
    </div>
    <div class="main-menu">
        <div class="menu-inner">
            <nav>
                <ul class="metismenu" id="menu">
                    <li class="active">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-dashboard"></i><span>dashboard</span></a>
                        <ul class="collapse">
                            <li class="active"><a href="index.html">ICO dashboard</a></li>
                            <li><a href="index2.html">Ecommerce dashboard</a></li>
                            <li><a href="index3.html">SEO dashboard</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-layout-sidebar-left"></i><span>Roles
                            </span></a>
                        <ul class="collapse">
                            <li><a href="{{ route('roles.index') }}">Roles List</a></li>
                            <li><a href="{{ route("roles.create") }}">Role Create</a></li>
                        </ul>
                    </li>
                    {{-- <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-pie-chart"></i><span>Charts</span></a>
                        <ul class="collapse">
                            <li><a href="barchart.html">bar chart</a></li>
                            <li><a href="linechart.html">line Chart</a></li>
                            <li><a href="piechart.html">pie chart</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-palette"></i><span>UI Features</span></a>
                        <ul class="collapse">
                            <li><a href="accordion.html">Accordion</a></li>
                            <li><a href="alert.html">Alert</a></li>
                            <li><a href="badge.html">Badge</a></li>
                            <li><a href="button.html">Button</a></li>
                            <li><a href="button-group.html">Button Group</a></li>
                            <li><a href="cards.html">Cards</a></li>
                            <li><a href="dropdown.html">Dropdown</a></li>
                            <li><a href="list-group.html">List Group</a></li>
                            <li><a href="media-object.html">Media Object</a></li>
                            <li><a href="modal.html">Modal</a></li>
                            <li><a href="pagination.html">Pagination</a></li>
                            <li><a href="popovers.html">Popover</a></li>
                            <li><a href="progressbar.html">Progressbar</a></li>
                            <li><a href="tab.html">Tab</a></li>
                            <li><a href="typography.html">Typography</a></li>
                            <li><a href="form.html">Form</a></li>
                            <li><a href="grid.html">grid system</a></li>
                        </ul>
                    </li> --}}

                </ul>
            </nav>
        </div>
    </div>
</div>
