<?php
    use App\Core\View;
    use App\Core\Controller;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="/inventario/public/css/coreui.min.css">
    <link rel="stylesheet" href="/inventario/public/css/all.min.css">
    <link rel="shortcut icon" href="/inventario/public/icons/cloud-dashboard.svg" />
    <style>
    .wrapper {
        width: 100%;
        padding-left: var(--cui-sidebar-occupy-start, 0);
        padding-right: var(--cui-sidebar-occupy-end, 0);
        will-change: auto;
        transition: padding 0.15s;
    }
    </style>
</head>

<body>
    <div class="sidebar sidebar-fixed border-end" id="sidebar">
        <div class="sidebar-header border-bottom">
            <div class="sidebar-brand-full">NUVOLA INVENTARIO</div>
            <div class="sidebar-brand-minimized">
                <img src="/inventario/public/icons/cloud-dashboard.svg" alt="Logo">
            </div>
        </div>
        <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
            <li class="nav-title">DASHBOARD</li>
            <li class="nav-item">
                <a class="nav-link" href="/inventario/public/Dashboard/index">
                    <svg class="nav-icon" width="24" height="24">
                        <use xlink:href="/inventario/public/icons/free.svg#cil-home"></use>
                    </svg> INICIO
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/inventario/public/Ventas/index">
                    <svg class="nav-icon" width="24" height="24">
                        <use xlink:href="/inventario/public/icons/free.svg#cil-cart"></use>
                    </svg> VENTAS
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/inventario/public/Productos/index">
                    <svg class="nav-icon" width="24" height="24">
                        <use xlink:href="/inventario/public/icons/free.svg#cil-3d"></use>
                    </svg> PRODUCTOS
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/inventario/public/Clientes/index">
                    <svg class="nav-icon" width="24" height="24">
                        <use xlink:href="/inventario/public/icons/free.svg#cil-address-book"></use>
                    </svg> CLIENTES
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/inventario/public/Proveedores/index">
                    <svg class="nav-icon" width="24" height="24">
                        <use xlink:href="/inventario/public/icons/free.svg#cil-factory"></use>
                    </svg> PROVEEDORES
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/inventario/public/Usuarios/index">
                    <svg class="nav-icon" width="24" height="24">
                        <use xlink:href="/inventario/public/icons/free.svg#cil-group"></use>
                    </svg> USUARIOS
                </a>
            </li>
            <li class="nav-item mt-auto">
                <a class="nav-link" href="/inventario/public/Configuracion/index">
                    <svg class="nav-icon" width="24" height="24">
                        <use xlink:href="/inventario/public/icons/free.svg#cil-settings"></use>
                    </svg> CONFIGURACION</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/inventario/public/Ayuda/index">
                    <svg class="nav-icon" width="24" height="24">
                        <use xlink:href="/inventario/public/icons/free.svg#cil-life-ring"></use>
                    </svg> AYUDA
                </a>
            </li>
        </ul>
        <div class="sidebar-footer border-top d-flex">
            <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
        </div>
    </div>
    <div class="wrapper d-flex flex-column min-vh-100 bg-light">
        <header class="header header-sticky mb-4">
            <div class="container-fluid">
                <button class="header-toggler px-md-0 me-md-3" type="button"
                    onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
                    <svg class="icon icon-lg">
                        <use xlink:href="/inventario/public/icons/free.svg#cil-menu"></use>
                    </svg>
                </button>
                <a class="header-brand d-md-none" href="#">
                    <svg width="118" height="46" alt="CoreUI Logo">
                        <use xlink:href="/inventario/public/icons/free.svg#cil-menu"></use>
                    </svg>
                </a>
                <ul class="header-nav ms-3">
                    <li class="nav-item dropdown">
                        <a class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button"
                            aria-haspopup="true" aria-expanded="false">
                            <div class="avatar avatar-md">
                                <img class="avatar-img" src="assets/img/user.png" alt="user@email.com">
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end pt-0">
                            <div class="dropdown-header bg-light py-2">
                                <div class="fw-semibold">Account</div>
                            </div>
                            <a class="dropdown-item" href="#">
                                <svg class="icon me-2">
                                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-settings"></use>
                                </svg> Settings
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="./logout.php">
                                <svg class="icon me-2">
                                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-account-logout"></use>
                                </svg> Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </header>
        <div class="body flex-grow-1 px-3">
            <div class="container-fluid">
                <?php
                    $content = "/{$GLOBALS['PAGE']}/{$GLOBALS['SECTION']}";
                    View::load($content);
                ?>
            </div>
        </div>
        <footer class="footer">
            <div><a href="https://github.com/LTrashy/Inventario">Repositorio DEV </a> © 2024.</div>
            <div class="ms-auto">Version <b>1.0</b></div>
        </footer>
    </div>
    <script src="/inventario/public/js/coreui.bundle.min.js"></script>
</body>

</html>