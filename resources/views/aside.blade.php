<aside class="sidebar-wrapper">
    <div class="sidebar" id="sidebar">
        <div class="sidebar__menu-group">
            <ul class="sidebar_nav">
                <li class="menu-title">
                    <span>Main menu</span>
                </li>
                <li class="mb-4">
                    <a href="/" class="{{ request()->is('/') ? 'active' : '' }}">
                        <span data-feather="home" class="nav-icon"></span>
                        <span class="menu-text">Dashboard</span>
                    </a>
                </li>
                <li class="menu-title">
                    <span>Applications</span>
                </li>
                <li class="{{ request()->is('customers*', 'suppliers*') ? 'active' : '' }}">
                    <a href="#" class="">
                        <span data-feather="users" class="nav-icon"></span>
                        <span class="menu-text">Customers & Suppliers</span>
                        <span class="toggle-icon"></span>
                    </a>
                    <ul>
                        <li>
                            <a class="{{ request()->is('customers*') ? 'active' : '' }}"
                                href="{{ route('customers.index') }}">Customers</a>
                        </li>
                        <li>
                            <a class="{{ request()->is('suppliers*') ? 'active' : '' }}"
                                href="{{ route('suppliers.index') }}">Suppliers</a>
                        </li>
                    </ul>
                </li>
                <li
                    class="{{ request()->is('products*', 'transactions*', 'rooms*', 'financial-reports*') ? 'active' : '' }}">
                    <a href="#" class="">
                        <span data-feather="box" class="nav-icon"></span>
                        <span class="menu-text">Products & Transactions</span>
                        <span class="toggle-icon"></span>
                    </a>
                    <ul>
                        <li>
                            <a class="{{ request()->is('products*') ? 'active' : '' }}"
                                href="{{ route('products.index') }}">Products</a>
                        </li>
                        <li>
                            <a class="{{ request()->is('transactions*') ? 'active' : '' }}"
                                href="{{ route('transactions.index') }}">Transactions</a>
                        </li>
                        <li>
                            <a class="{{ request()->is('rooms*') ? 'active' : '' }}"
                                href="{{ route('rooms.index') }}">Rooms</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('financial-reports.index') }}"
                        class="{{ request()->is('financial-reports*') ? 'active' : '' }}">
                        <span data-feather="file-text" class="nav-icon"></span>
                        <span class="menu-text">Financial Reports</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</aside>
