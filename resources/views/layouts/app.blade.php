<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'Dashboard') | EduManage
    </title>

    <!-- Bootstrap CSS -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
        rel="stylesheet">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <style>

        :root {
            --primary: #25143B;
            --secondary: #692386;
            --accent: #8046D0;
            --background: #F5F3F8;
            --text: #32263F;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background: var(--background);
            color: var(--text);
        }

        /* Sidebar */

        .sidebar {
            width: 250px;
            height: 100vh;
            background: var(--primary);
            position: fixed;
            top: 0;
            left: 0;
            padding: 25px 15px;
            overflow-y: auto;
            z-index: 1050;
        }

        .brand {
            color: white;
            font-size: 23px;
            font-weight: 700;
            padding: 10px 12px 30px;
        }

        .sidebar-label {
            color: #A99DB8;
            font-size: 11px;
            padding: 10px 12px;
            letter-spacing: 1px;
        }

        .sidebar a {
            display: block;
            color: #D8D0E0;
            padding: 12px 15px;
            text-decoration: none;
            border-radius: 8px;
            margin-bottom: 6px;
            transition: .2s;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: var(--secondary);
            color: white;
        }

        /* Main Content */

        .main-content {
            margin-left: 250px;
            min-height: 100vh;
        }

        /* Top Navigation */

        .topbar {
            background: white;
            padding: 18px 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,.04);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .content-area {
            padding: 30px;
            min-height: calc(100vh - 150px);
        }

        /* Cards */

        .stat-card,
        .content-card {
            background: white;
            border: none;
            border-radius: 12px;
            padding: 22px;
            box-shadow: 0 3px 15px rgba(0,0,0,.04);
        }

        .stat-icon {
            width: 46px;
            height: 46px;
            border-radius: 10px;
            background: #F0E7F8;
            color: var(--secondary);
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 22px;
        }

        /* Buttons */

        .btn-primary {
            background: var(--secondary);
            border-color: var(--secondary);
        }

        .btn-primary:hover {
            background: var(--primary);
            border-color: var(--primary);
        }

        /* Tables */

        .table {
            vertical-align: middle;
        }

        .table thead th {
            background: #F7F4FA;
            color: #574A63;
            font-size: 13px;
            padding: 15px;
            white-space: nowrap;
        }

        .table tbody td {
            padding: 15px;
        }

        /* Footer */

        .footer {
            padding: 20px 30px;
            background: white;
            color: #777;
            font-size: 13px;
        }

        /* Mobile Sidebar */

        @media(max-width: 768px) {

            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
            }

            .main-content {
                margin-left: 0;
            }

            .content-area {
                padding: 15px;
            }

            .topbar {
                padding: 15px;
            }

        }

    </style>

    @stack('styles')

</head>

<body>

    <!-- Sidebar -->
    @include('partials.sidebar')

    <div class="main-content">

        <!-- Top Navigation -->
        @include('partials.navbar')

        <!-- Dynamic Page Content -->
        <main class="content-area">

            @yield('content')

        </main>

        <!-- Footer -->
        @include('partials.footer')

    </div>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    </script>

    @stack('scripts')

</body>
</html>