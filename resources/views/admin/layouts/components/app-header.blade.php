<header class="top-header">
    <div class="logo">
        GauMitra Admin
    </div>

    <div class="right-user">
        @auth
            {{ auth()->user()->name ?? 'User' }} | {{ auth()->user()->role ?? '' }}
        @else
            Guest
        @endauth
    </div>
</header>