<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background: #f5f7fb;
        font-family: Arial, sans-serif;
    }

    .main-wrapper {
        min-height: 100vh;
    }

    .top-header {
        height: 60px;
        background: #1e293b;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 20px;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1000;
    }

    .top-header .logo {
        font-size: 22px;
        font-weight: 700;
    }

    .top-header .right-user {
        font-size: 14px;
    }

    .layout-body {
        display: flex;
        margin-top: 60px;
    }

    .sidebar {
        width: 250px;
        min-height: calc(100vh - 60px);
        background: #0f172a;
        color: #fff;
        position: fixed;
        top: 60px;
        left: 0;
        padding: 20px 0;
    }

    .sidebar ul {
        list-style: none;
        padding-left: 0;
    }

    .sidebar ul li {
        margin-bottom: 5px;
    }

    .sidebar ul li a {
        display: block;
        color: #fff;
        text-decoration: none;
        padding: 12px 20px;
        transition: 0.3s;
    }

    .sidebar ul li a:hover,
    .sidebar ul li a.active {
        background: #1d4ed8;
        color: #fff;
    }

    .content-area {
        margin-left: 250px;
        width: calc(100% - 250px);
        padding: 25px;
        min-height: calc(100vh - 120px);
    }

    .page-title {
        font-size: 26px;
        font-weight: 700;
        margin-bottom: 20px;
    }

    .dashboard-card {
        background: #fff;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        margin-bottom: 20px;
    }

    .footer {
        margin-left: 250px;
        width: calc(100% - 250px);
        background: #fff;
        border-top: 1px solid #ddd;
        padding: 15px 25px;
    }

    @media (max-width: 991px) {
        .sidebar {
            width: 220px;
        }

        .content-area,
        .footer {
            margin-left: 220px;
            width: calc(100% - 220px);
        }
    }

    @media (max-width: 767px) {
        .sidebar {
            position: static;
            width: 100%;
            min-height: auto;
        }

        .layout-body {
            display: block;
        }

        .content-area,
        .footer {
            margin-left: 0;
            width: 100%;
        }
    }
</style>