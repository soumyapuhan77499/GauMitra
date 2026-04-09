<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $pageTitle ?? 'Admin Dashboard' }}</title>

    @include('admin.layouts.components.styles')
</head>

<body>

    <div class="main-wrapper">

        @include('admin.layouts.components.app-header')

        <div class="layout-body">
            @include('admin.layouts.components.app-sidebar')

            <main class="content-area">
                @yield('content')
            </main>
        </div>

        @include('admin.layouts.components.footer')

    </div>

    @include('admin.layouts.components.sidebar-right')
    @include('admin.layouts.components.modal')
    @yield('modal')

    @include('admin.layouts.components.scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: "{{ session('success') }}",
                timer: 2000,
                showConfirmButton: false
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: "{{ session('error') }}"
            });
        </script>
    @endif
</body>

</html>
