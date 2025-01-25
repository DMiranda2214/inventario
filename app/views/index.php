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
    <div class="sidebar sidebar-fixed border-end sidebar-narrow-unfoldable" id="sidebar">
        <div class="sidebar-header border-bottom">
            <div class="sidebar-brand-full">NUVOLA INVENTARIO</div>
            <div class="sidebar-brand-minimized">
                <img src="/inventario/public/icons/cloud-dashboard.svg" alt="Logo">
            </div>
        </div>
        <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
            <li class="nav-title">MENU</li>
            <li class="nav-item">
                <a class="nav-link" href="/inventario/public/Dashboard/index">
                    <svg class="nav-icon" width="24" height="24">
                        <use xlink:href="/inventario/public/icons/free.svg#cil-home"></use>
                    </svg> INICIO
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/inventario/public/Inventario/index">
                    <svg class="nav-icon" width="24" height="24">
                        <use xlink:href="/inventario/public/icons/free.svg#cil-factory"></use>
                    </svg> INVENTARIO
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/inventario/public/Productos/index">
                    <svg class="nav-icon" width="24" height="24">
                        <use xlink:href="/inventario/public/icons/free.svg#cil-3d"></use>
                    </svg> PRODUCTOS
                </a>
            </li>
            <li class="nav-group">
                <a href="#" class="nav-link nav-group-toggle">
                    <svg class="nav-icon" width="24" height="24">
                        <use xlink:href="/inventario/public/icons/free.svg#cil-address-book"></use>
                    </svg> CONTACTOS
                </a>
                <ul class="nav-group-items">
                    <li class="nav-item">
                        <a class="nav-link" href="/inventario/public/Proveedor/index"><span class="nav-icon"></span>PROVEEDORES</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/inventario/public/Clientes/index"><span class="nav-icon"></span>CLIENTES</a>
                    </li>
                </ul>
            </li>

            <li class="nav-group">
                <a href="#" class="nav-link nav-group-toggle">
                    <svg class="nav-icon" width="24" height="24">
                        <use xlink:href="/inventario/public/icons/free.svg#cil-wallet"></use>
                    </svg> MOVIMIENTOS
                </a>
                <ul class="nav-group-items">
                    <li class="nav-item">
                        <a class="nav-link" href="/inventario/public/Ventas/index"><span class="nav-icon"></span>VENTAS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/inventario/public/Compras/index"><span class="nav-icon"></span>COMPRAS</a>
                    </li>
                </ul>
            </li>
            <li class="nav-group mt-auto">
                <a class="nav-link nav-group-toggle" href="#">
                    <svg class="nav-icon" width="24" height="24">
                        <use xlink:href="/inventario/public/icons/free.svg#cil-settings"></use>
                    </svg> CONFIGURACION</a>
                <ul class="nav-group-items">
                    <li class="nav-item">
                        <a class="nav-link" href="/inventario/public/Categorias/index"><span class="nav-icon"></span>CATEGORIAS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/inventario/public/Usuarios/index">USUARIOS</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/inventario/public/Ayuda/index">
                    <svg class="nav-icon" width="24" height="24">
                        <use xlink:href="/inventario/public/icons/free.svg#cil-life-ring"></use>
                    </svg> AYUDA
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/inventario/public/Auth/logout">
                    <img class="nav-icon" src="/inventario/public/icons/logout.svg" alt="logout"> CERRAR SESSION
                </a>
            </li>
        </ul>
        <div class="sidebar-footer border-top d-flex">
            <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
        </div>
    </div>
    <div class="wrapper d-flex flex-column min-vh-100 bg-light">
        <header class="header">
            <div class="d-flex flex-row">
                <button class="header-toggler" type="button"
                    onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
                    <svg class="icon icon-lg">
                        <use xlink:href="/inventario/public/icons/free.svg#cil-menu"></use>
                    </svg>
                </button>
                <h4 class="header-text">Bienvenido <?= $_SESSION['username'] ?></h4>
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
    </div>
    <script src="/inventario/public/js/coreui.bundle.min.js"></script>
</body>

</html>