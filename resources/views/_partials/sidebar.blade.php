<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">
        <!--- Divider -->
        <div id="sidebar-menu">
            <ul>
                <li class="has_sub">
                    <a href="{{ route('dashboard.index') }}" class="waves-effect"><i class="ti-dashboard"></i> <span> Dashboard.</span></a>
                </li>

                @if (\App\User::hasAuthority('use.security'))
                    <li class="text-muted menu-title">Security</li>
                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect"><i class="ti-home"></i> <span> Authorization </span> <span class="menu-arrow"></span></a>
                        <ul class="list-unstyled">
                            <li><a href="{{ route('permission-groups.index') }}">Permission Groups</a></li>
                            <li><a href="{{ route('permissions.index') }}">Permissions</a></li>
                            <li><a href="{{ route('roles.index') }}">Roles</a></li>
                        </ul>
                    </li>
                @endif

                @if (\App\User::hasAuthority('use.resources'))
                    <li class="text-muted menu-title">Resources</li>

                    @if (\App\User::hasAuthority('index.users'))
                    <li class="has_sub">
                        <a href="{{ route('users.index') }}" class="waves-effect"><i class="ti-user"></i> <span> Users </span></a>
                    </li>
                    @endif

                    @if (\App\User::hasAuthority('index.leads'))
                    <li class="has_sub">
                        <a href="{{ route('leads.index') }}" class="waves-effect"><i class="ti-user"></i> <span> Leads </span></a>
                    </li>
                    @endif

                    @if (\App\User::hasAuthority('index.certificates'))
                    <li class="has_sub">
                        <a href="{{ route('certificates.index') }}" class="waves-effect"><i class="ti-agenda"></i> <span> Certificates </span></a>
                    </li>
                    @endif

                    @if (\App\User::hasAuthority('index.locations'))
                    <li class="has_sub">
                        <a href="{{ route('locations.index') }}" class="waves-effect"><i class="ti-location-pin"></i> <span> Locations </span></a>
                    </li>
                    @endif

                    @if (\App\User::hasAuthority('index.trainers'))
                    <li class="has_sub">
                        <a href="{{ route('trainers.index') }}" class="waves-effect"><i class="ti-user"></i> <span> Trainers </span></a>
                    </li>
                    @endif

                    @if (\App\User::hasAuthority('index.course_prices'))
                    <li class="has_sub">
                        <a href="{{ route('course_prices.index') }}" class="waves-effect"><i class="ti-money"></i> <span> Course Prices </span></a>
                    </li>
                    @endif

                    @if (\App\User::hasAuthority('index.courses'))
                    <li class="has_sub">
                        <a href="{{ route('courses.index') }}" class="waves-effect"><i class="ti-briefcase"></i> <span> Courses </span></a>
                    </li>
                    @endif

                    @if (\App\User::hasAuthority('index.students'))
                    <li class="has_sub">
                        <a href="{{ route('students.index') }}" class="waves-effect"><i class="ti-star"></i> <span> Students </span></a>
                    </li>
                    @endif

                @endif

                <li class="text-muted menu-title">Reports</li>
                <li class="has_sub">
                    <a href="{{ route('reports.getStudentsReport') }}" class="waves-effect"><i class="ti-star"></i> <span> Students Report </span></a>
                </li>
                <li class="has_sub">
                    <a href="{{ route('reports.getPaymentsReport') }}" class="waves-effect"><i class="ti-star"></i> <span> Payments Report </span></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
