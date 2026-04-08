<aside class="sidebar">
    <ul>
        <li>
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                Dashboard
            </a>
        </li>

        <li>
            <a href="#">
                Users
            </a>
        </li>

        <li>
            <a href="#">
                Reports
            </a>
        </li>

        @auth
            @if(auth()->user()->role === 'superadmin')
                <li>
                    <a href="#">
                        Super Admin Panel
                    </a>
                </li>
            @endif
        @endauth

        <li>
            <a href="#">
                Settings
            </a>
        </li>
    </ul>
</aside>