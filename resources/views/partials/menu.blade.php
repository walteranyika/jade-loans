<div class="sidebar">
    <nav class="sidebar-nav">

        <ul class="nav">
            <li>
                <select class="searchable-field form-control">

                </select>
            </li>
            <li class="nav-item">
                <a href="{{ route("admin.home") }}" class="nav-link">
                    <i class="nav-icon fas fa-fw fa-tachometer-alt">

                    </i>
                    {{ trans('global.dashboard') }}
                </a>
            </li>
            @can('borrower_access')
                <li class="nav-item nav-dropdown">
                    <a class="nav-link  nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-users nav-icon">

                        </i>
                        {{ trans('cruds.borrower.title') }}
                    </a>
                    <ul class="nav-dropdown-items">
                        @can('guarantor_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.guarantors.index") }}" class="nav-link {{ request()->is('admin/guarantors') || request()->is('admin/guarantors/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-people-carry nav-icon">

                                    </i>
                                    {{ trans('cruds.guarantor.title') }}
                                </a>
                            </li>
                        @endcan
                        @can('client_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.clients.index") }}" class="nav-link {{ request()->is('admin/clients') || request()->is('admin/clients/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-list-ol nav-icon">

                                    </i>
                                    {{ trans('cruds.client.title') }}
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('asset_access')
                <li class="nav-item nav-dropdown">
                    <a class="nav-link  nav-dropdown-toggle" href="#">
                        <i class="fa-fw far fa-money-bill-alt nav-icon">

                        </i>
                        {{ trans('cruds.asset.title') }}
                    </a>
                    <ul class="nav-dropdown-items">
                        @can('fund_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.funds.index") }}" class="nav-link {{ request()->is('admin/funds') || request()->is('admin/funds/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-money-bill-wave nav-icon">

                                    </i>
                                    {{ trans('cruds.fund.title') }}
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('loan_access')
                <li class="nav-item nav-dropdown">
                    <a class="nav-link  nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-hand-holding-usd nav-icon">

                        </i>
                        {{ trans('cruds.loan.title') }}
                    </a>
                    <ul class="nav-dropdown-items">
                        @can('active_loan_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.active-loans.index") }}" class="nav-link {{ request()->is('admin/active-loans') || request()->is('admin/active-loans/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-chart-line nav-icon">

                                    </i>
                                    {{ trans('cruds.activeLoan.title') }}
                                </a>
                            </li>
                        @endcan
                        @can('inactive_loan_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.inactive-loans.index") }}" class="nav-link {{ request()->is('admin/inactive-loans') || request()->is('admin/inactive-loans/*') ? 'active' : '' }}">
                                    <i class="fa-fw far fa-angry nav-icon">

                                    </i>
                                    {{ trans('cruds.inactiveLoan.title') }}
                                </a>
                            </li>
                        @endcan
                        @can('dorman_loan_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.dorman-loans.index") }}" class="nav-link {{ request()->is('admin/dorman-loans') || request()->is('admin/dorman-loans/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-angry nav-icon">

                                    </i>
                                    {{ trans('cruds.dormanLoan.title') }}
                                </a>
                            </li>
                        @endcan
                        @can('product_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.products.index") }}" class="nav-link {{ request()->is('admin/products') || request()->is('admin/products/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-tasks nav-icon">

                                    </i>
                                    {{ trans('cruds.product.title') }}
                                </a>
                            </li>
                        @endcan
                        @can('credit_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.credits.index") }}" class="nav-link {{ request()->is('admin/credits') || request()->is('admin/credits/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-cogs nav-icon">

                                    </i>
                                    {{ trans('cruds.credit.title') }}
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('payment_access')
                <li class="nav-item nav-dropdown">
                    <a class="nav-link  nav-dropdown-toggle" href="#">
                        <i class="fa-fw fab fa-amazon-pay nav-icon">

                        </i>
                        {{ trans('cruds.payment.title') }}
                    </a>
                    <ul class="nav-dropdown-items">
                        @can('missed_payment_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.missed-payments.index") }}" class="nav-link {{ request()->is('admin/missed-payments') || request()->is('admin/missed-payments/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-times-circle nav-icon">

                                    </i>
                                    {{ trans('cruds.missedPayment.title') }}
                                </a>
                            </li>
                        @endcan
                        @can('target_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.targets.index") }}" class="nav-link {{ request()->is('admin/targets') || request()->is('admin/targets/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-cogs nav-icon">

                                    </i>
                                    {{ trans('cruds.target.title') }}
                                </a>
                            </li>
                        @endcan
                        @can('repayment_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.repayments.index") }}" class="nav-link {{ request()->is('admin/repayments') || request()->is('admin/repayments/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-cogs nav-icon">

                                    </i>
                                    {{ trans('cruds.repayment.title') }}
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('branch_access')
                <li class="nav-item nav-dropdown">
                    <a class="nav-link  nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-bezier-curve nav-icon">

                        </i>
                        {{ trans('cruds.branch.title') }}
                    </a>
                    <ul class="nav-dropdown-items">
                        @can('location_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.locations.index") }}" class="nav-link {{ request()->is('admin/locations') || request()->is('admin/locations/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-bars nav-icon">

                                    </i>
                                    {{ trans('cruds.location.title') }}
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('user_management_access')
                <li class="nav-item nav-dropdown">
                    <a class="nav-link  nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-users nav-icon">

                        </i>
                        {{ trans('cruds.userManagement.title') }}
                    </a>
                    <ul class="nav-dropdown-items">
                        @can('permission_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.permissions.index") }}" class="nav-link {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-unlock-alt nav-icon">

                                    </i>
                                    {{ trans('cruds.permission.title') }}
                                </a>
                            </li>
                        @endcan
                        @can('role_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.roles.index") }}" class="nav-link {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-briefcase nav-icon">

                                    </i>
                                    {{ trans('cruds.role.title') }}
                                </a>
                            </li>
                        @endcan
                        @can('user_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.users.index") }}" class="nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-user nav-icon">

                                    </i>
                                    {{ trans('cruds.user.title') }}
                                </a>
                            </li>
                        @endcan
                        @can('audit_log_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.audit-logs.index") }}" class="nav-link {{ request()->is('admin/audit-logs') || request()->is('admin/audit-logs/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-file-alt nav-icon">

                                    </i>
                                    {{ trans('cruds.auditLog.title') }}
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @php($unread = \App\QaTopic::unreadCount())
                <li class="nav-item">
                    <a href="{{ route("admin.messenger.index") }}" class="{{ request()->is('admin/messenger') || request()->is('admin/messenger/*') ? 'active' : '' }} nav-link">
                        <i class="nav-icon fa-fw fa fa-envelope">

                        </i>
                        <span>{{ trans('global.messages') }}</span>
                        @if($unread > 0)
                            <strong>( {{ $unread }} )</strong>
                        @endif
                    </a>
                </li>
                @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                    @can('profile_password_edit')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}" href="{{ route('profile.password.edit') }}">
                                <i class="fa-fw fas fa-key nav-icon">
                                </i>
                                {{ trans('global.change_password') }}
                            </a>
                        </li>
                    @endcan
                @endif
                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                        <i class="nav-icon fas fa-fw fa-sign-out-alt">

                        </i>
                        {{ trans('global.logout') }}
                    </a>
                </li>
        </ul>

    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>