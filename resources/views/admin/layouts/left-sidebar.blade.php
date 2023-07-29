<aside id="leftsidebar" class="sidebar">
    <div class="navbar-brand">
        <button class="btn-menu ls-toggle-btn" type="button"><i class="zmdi zmdi-menu"></i></button>
    </div>
    @php
        $user = auth()->user();
    @endphp
    <div class="menu">
        <ul class="list">
            <li>
                <div class="user-info">
                    <a class="image">
                        @if ($user->profile_photo_path == null)
                            <img src="{{ asset('static-img/user-avatar.png') }}"
                                class="avatar rounded-circle ms-3"5width="10" height="50">
                        @else
                            <img src="{{ asset($user->profile_photo_path) }}" class="avatar rounded-circle ms-3"
                                width="50" height="50">
                        @endif
                    </a>
                    <div class="detail">
                        <h4>{{ $user->fullName }}</h4>
                    </div>
                </div>
            </li>
            <li class="active open">
                <a href="{{ route('home') }}"><i class="fa fa-sitemap"></i><span>صفحه اصلی</span></a>
            </li>
            <li class="active open">
                <a href="{{ route('customer.profile.profile') }}"><i
                        class="zmdi zmdi-account"></i><span>پروفایل</span></a>
            </li>
            <li class="active open">
                <a><i class="fas fa-user-edit"></i><span>
                        <button type="button" style="border-radius: 2rem !important"
                            class="btn text-center font-weight-bold btn-simple waves-effect" data-toggle="modal"
                            data-target="#editProfile">
                            ویرایش
                        </button></span></a>
            </li>
            <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-ticket-star"></i><span>
                        مدیریت تیکت ها
                    </span></a>
                <ul class="ml-menu">
                    <li> <a href="{{ route('customer.profile.my-tickets') }}">مشاهده تیکت ها</a> </li>
                </ul>
            </li>

            <li class="open">
                <a class="btn btn-danger btn-block text-white" style="border-radius: 2rem"
                    href="{{ route('logout') }}"><span>خروج</span></a>
            </li>
            <hr>
            @if ($user->can('developer'))
                <li class="open">
                    <a
                        href="{{ route('admin.project-category.index') }}"><span>دسته بندی پروژه</span></a>
                </li>
                <li class="open">
                    <a
                        href="{{ route('admin.project.index') }}"><span>  پروژه هـا</span></a>
                </li>
            @endif
            @if ($user->can('admin-panel'))
                <li class=" open"><a><span>
                            دسترسی های ادمین</span></a></li>
                <li class="active open"><a href="{{ route('admin.home') }}"><i
                            class="zmdi zmdi-home"></i><span>داشبورد</span></a></li>
            @endif
            @if ($user->can('manage-admin-users'))
                <li><a href="javascript:void(0);" class="menu-toggle"><i
                            class="zmdi zmdi-account"></i><span>کاربران</span></a>
                    <ul class="ml-menu">
                        <li> <a href="{{ route('admin.manage-users') }}"> مدیریت کاربران </a> </li>
                        <li> <a href="{{ route('admin.user.authors') }}"> مدیریت نویسندگان </a> </li>
                        <li> <a href="{{ route('admin.admin-users') }}"> مدیریت کاربران ادمین </a> </li>
                    </ul>
                </li>
            @endif
            @if ($user->can('manage-teams'))
                <li><a href="javascript:void(0);" class="menu-toggle"><i
                            class="fas fa-user-friends"></i><span>تیم</span></a>
                    <ul class="ml-menu">
                        <li> <a href="{{ route('admin.team.index') }}"> مدیریت اعضای تیم </a> </li>
                    </ul>
                </li>
            @endif
            @if ($user->can('manage-roles'))
                <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-lock"></i><span>دسترسی ها و
                            نقش
                            ها</span></a>
                    <ul class="ml-menu">
                        <li> <a href="{{ route('admin.roles') }}"> مدیریت نقش ها </a> </li>
                    </ul>
                </li>
            @endif
            @if ($user->can('ticket-section'))
                <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-ticket-star"></i><span>
                            تیکت ها</span></a>
                    <ul class="ml-menu">
                        <li> <a href="{{ route('admin.ticket-category.index') }}">دسته بندی تیکت ها</a> </li>
                        <li> <a href="{{ route('admin.ticket-priorities.index') }}">اولویت بندی تیکت ها</a> </li>
                        <li> <a href="{{ route('admin.ticket.admin.index') }}">ادمین تیکت</a> </li>
                        <li> <a href="{{ route('admin.ticket.index') }}">همه تیکت ها</a> </li>
                        <li> <a href="{{ route('admin.ticket.newTickets') }}">تیکت های جدید</a> </li>
                        <li> <a href="{{ route('admin.ticket.openTickets') }}">تیکت ها باز</a> </li>
                        <li> <a href="{{ route('admin.ticket.closeTickets') }}">تیکت های بسته</a> </li>
                    </ul>
                </li>
            @endif
            @if (
                $user->can('manage-faqs') ||
                    $user->can('manage-messages') ||
                    $user->can('manage-blogs') ||
                    $user->can('manage-services'))
                <li><a href="javascript:void(0);" class="menu-toggle"><i
                            class="zmdi zmdi-app"></i><span>محتوا</span></a>
                    <ul class="ml-menu">
                        @if ($user->can('manage-blogs'))
                            <li> <a href="{{ route('admin.content.post.index') }}">بلاگـ</a> </li>
                            <li> <a href="{{ route('admin.content.category.index') }}">دسته بندی بلاگـ</a> </li>
                        @endif
                        @if ($user->can('manage-faqs'))
                            <li> <a href="{{ route('admin.content.faq') }}"> سوالات متداول </a> </li>
                        @endif
                        @if ($user->can('manage-messages'))
                            <li> <a href="{{ route('admin.contactus') }}"> تماس با ما </a> </li>
                            <li> <a href="{{ route('admin.about-us') }}">درباره ما</a> </li>
                        @endif
                        @if ($user->can('manage-services'))
                            <li> <a href="{{ route('admin.service.index') }}">مدیریت سرویس ها</a> </li>
                        @endif
                    </ul>
                </li>
            @endif
            @if ($user->can('manage-blogs-comments'))
                <li> <a href="{{ route('admin.content.posts-comments.index') }}">مدیریت نظرات وبلاگـ ها</a> </li>
            @endif
        </ul>
    </div>
</aside>
