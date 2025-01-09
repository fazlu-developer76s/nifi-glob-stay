@inject('helper', 'App\Helpers\Global_helper')
@php
    $property = $helper->getSidebarRolePermissions(Auth::user()->role_id, 'Property Listing');

@endphp
<div id="sidebar" class="app-sidebar">
    <div class="app-sidebar-content find-link" data-scrollbar="true" data-height="100%">
        <div class="menu">
            <div class="menu-header">Navigation</div>

            <div class="menu-item">
                <a href="{{ route('dashboard') }}" class="menu-link">
                    <div class="menu-icon"> <i class="fa fa-home"></i> </div>
                    <div class="menu-text">Dashboard</div>
                </a>
            </div>
            @if(Auth::user()->role_id == 1)
            <div class="menu-item has-sub"> <a href="javascript:;" class="menu-link">
                    <div class="menu-icon"> <i class="fas fa-list"></i> </div>
                    <div class="menu-text">Member Management</div>
                    <div class="menu-caret"></div>
                </a>
                <div class="menu-submenu">
                    <div class="menu-item">
                        <a href="{{ route('roles') }}" class="menu-link">
                            <div class="menu-text">Manage Roles</div>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a href="{{ route('member') }}" class="menu-link">
                            <div class="menu-text">Members</div>
                        </a>
                    </div>
                    <!--<div class="menu-item">-->
                    <!--    <a href="{{ route('approved.member') }}" class="menu-link">-->
                    <!--        <div class="menu-text">Approved Sellers</div>-->
                    <!--    </a>-->
                    <!--</div>-->
                    <!--<div class="menu-item">-->
                    <!--    <a href="{{ route('pending.member') }}" class="menu-link">-->
                    <!--        <div class="menu-text">Pending Sellers</div>-->
                    <!--    </a>-->
                    <!--</div>-->
                </div>
            </div>
            <div class="menu-item has-sub"> <a href="javascript:;" class="menu-link">
                    <div class="menu-icon"> <i class="fas fa-list"></i> </div>
                    <div class="menu-text">Manage Permissions</div>
                    <div class="menu-caret"></div>
                </a>
                <div class="menu-submenu">
                    <div class="menu-item">
                        <a href="{{ route('permission.category') }}" class="menu-link">
                            <div class="menu-text">Permission Category</div>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a href="{{ route('permission.subcategory') }}" class="menu-link">
                            <div class="menu-text">Permission</div>
                        </a>
                    </div>
                </div>
            </div>
            @endif
            @if(Auth::user()->role_id == 1)
            <div class="menu-item has-sub"> <a href="javascript:;" class="menu-link ">
                    <div class="menu-icon"> <i class="fas fa-list"></i> </div>
                    <div class="menu-text">Category Management</div>
                    <div class="menu-caret"></div>
                </a>
                <div class="menu-submenu">
                    <div class="menu-item">
                        <a href="{{ route('category') }}" class="menu-link ">
                            <div class="menu-text"> Category List</div>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a href="{{ route('propertycategory') }}" class="menu-link ">
                            <div class="menu-text"> Property Category List</div>
                        </a>
                    </div>
                </div>
            </div>
            @endif

            <div class="menu-item has-sub"> <a href="javascript:;" class="menu-link ">
                    <div class="menu-icon"> <i class="fas fa-list"></i> </div>
                    <div class="menu-text">Property Management</div>
                    <div class="menu-caret"></div>
                </a>
                <div class="menu-submenu">
                    @if(Auth::user()->role_id == 1)
                    <div class="menu-item">
                        <a href="{{ route('amenities') }}" class="menu-link ">
                            <div class="menu-text">Manage Amenities </div>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a href="{{ route('bedtype') }}" class="menu-link ">
                            <div class="menu-text">Manage Bed Type </div>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a href="{{ route('facilities') }}" class="menu-link ">
                            <div class="menu-text">Manage Facilities </div>
                        </a>
                    </div>
                    @endif
                    @if($property == 1 || Auth::user()->role_id==1)
                    <div class="menu-item">
                        <a href="{{ route('property') }}" class="menu-link ">
                            <div class="menu-text">Listed Property </div>
                        </a>
                    </div>
                     <div class="menu-item">
                        <a href="{{ route('pending.property') }}" class="menu-link ">
                            <div class="menu-text">Pending Property </div>
                        </a>
                    </div>

                    @endif
                </div>
            </div>
            @if(Auth::user()->role_id == 1)
            <div class="menu-item has-sub"> <a href="javascript:;" class="menu-link ">
                    <div class="menu-icon"> <i class="fas fa-list"></i> </div>
                    <div class="menu-text">Testimonials</div>
                    <div class="menu-caret"></div>
                </a>
                <div class="menu-submenu">
                    <div class="menu-item">
                        <a href="{{ route('testimonial') }}" class="menu-link ">
                            <div class="menu-text"> Testimonial List</div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="menu-item has-sub"> <a href="javascript:;" class="menu-link ">
                    <div class="menu-icon"> <i class="fas fa-list"></i> </div>
                    <div class="menu-text">Job Title</div>
                    <div class="menu-caret"></div>
                </a>
                <div class="menu-submenu">
                    <div class="menu-item">
                        <a href="{{ route('job') }}" class="menu-link ">
                            <div class="menu-text"> Job List</div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="menu-item has-sub"> <a href="javascript:;" class="menu-link ">
                    <div class="menu-icon"> <i class="fas fa-list"></i> </div>
                    <div class="menu-text">Blogs</div>
                    <div class="menu-caret"></div>
                </a>
                <div class="menu-submenu">
                    <div class="menu-item">
                        <a href="{{ route('blog') }}" class="menu-link ">
                            <div class="menu-text"> Blog List</div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="menu-item has-sub"> <a href="javascript:;" class="menu-link ">
                    <div class="menu-icon"> <i class="fas fa-list"></i> </div>
                    <div class="menu-text">Banners</div>
                    <div class="menu-caret"></div>
                </a>
                <div class="menu-submenu">
                    <div class="menu-item">
                        <a href="{{ route('banner') }}" class="menu-link ">
                            <div class="menu-text"> Banner List</div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="menu-item has-sub"> <a href="javascript:;" class="menu-link ">
                    <div class="menu-icon"> <i class="fas fa-list"></i> </div>
                    <div class="menu-text">Our Gallary</div>
                    <div class="menu-caret"></div>
                </a>
                <div class="menu-submenu">
                    <div class="menu-item">
                        <a href="{{ route('gallary') }}" class="menu-link ">
                            <div class="menu-text"> Gallary List</div>
                        </a>
                    </div>
                </div>
            </div>
              <div class="menu-item has-sub"> <a href="javascript:;" class="menu-link ">
                    <div class="menu-icon"> <i class="fas fa-list"></i> </div>
                    <div class="menu-text">Manage Pages</div>
                    <div class="menu-caret"></div>
                </a>
                <div class="menu-submenu">
                    <div class="menu-item">
                        <a href="{{ route('pages.edit', 1) }}" class="menu-link ">
                            <div class="menu-text">About Us</div>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a href="{{ route('pages.edit', 2) }}" class="menu-link ">
                            <div class="menu-text">Our Vision</div>
                        </a>
                    </div>
                </div>
            </div>
            @endif
            @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 4 || Auth::user()->role_id == 5 )
            <div class="menu-item has-sub"> <a href="javascript:;" class="menu-link ">
                    <div class="menu-icon"> <i class="fas fa-list"></i> </div>
                    <div class="menu-text">Site Setting</div>
                    <div class="menu-caret"></div>
                </a>
                <div class="menu-submenu">
                    @if(Auth::user()->role_id == 1)
                    <div class="menu-item">
                        <a href="{{ route('company.edit', 1) }}" class="menu-link ">
                            <div class="menu-text">Manage Site Setting</div>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a href="{{ route('seo') }}" class="menu-link ">
                            <div class="menu-text">Manage Seo</div>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a href="{{ route('import') }}" class="menu-link ">
                            <div class="menu-text">Import Leads</div>
                        </a>
                    </div>
                    @endif
                    <div class="menu-item">
                        <a href="{{ route('enquiry') }}" class="menu-link">
                            <div class="menu-text">Enquiry List</div>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a href="{{ route('career.enquiry') }}" class="menu-link">
                            <div class="menu-text">Career Enquiry List</div>
                        </a>
                    </div>
                </div>
            </div>
            @endif
            <div class="menu-item d-flex"> <a href="javascript:;" class="app-sidebar-minify-btn ms-auto"
                    data-toggle="app-sidebar-minify"><i class="fa fa-angle-double-left"></i></a> </div>
        </div>
    </div>
</div>
