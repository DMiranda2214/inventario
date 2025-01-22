<?php

use App\Controllers\ProductosController;
use App\Controllers\ClientesController;
use App\Controllers\ProveedorController;

$proveedorController = new ProveedorController();
$productosController = new ProductosController();
$clientesController = new ClientesController();
?>
<br><br>
<div class="row">
    <div class="col-6 col-lg-3">
        <div class="card">
            <div class="card-body p-3 d-flex aling-items-center">
                <div class="bg-primary text-white p-3 me-3">
                    <svg class="icon icon-xl">
                        <use xlink:href="/inventario/public/icons/free.svg#cil-3d"></use>
                    </svg>
                </div>
                <div>
                    
                    <div class="fs-6 fs-semibold text-primary"><?= $productosController->countProducts() ?></div>
                    <div class="text-medium-emphasis text-uppercase fw-semibold small">PRODUCTOS</div>
                </div>
            </div>
            <div class="card-footer px-3 py-2"><a class="btn-block text-medium-emphasis d-flex justify-content-between align-items-center" href="/inventario/public/Productos/index">
                    <span class="small fw-semibold">IR A PRODUCTOS</span>
                    <svg class="icon">
                        <use xlink:href="/inventario/public/icons/free.svg#cil-chevron-right"></use>
                    </svg></a>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="card">
            <div class="card-body p-3 d-flex aling-items-center">
                <div class="bg-primary text-white p-3 me-3">
                    <svg class="icon icon-xl">
                        <use xlink:href="/inventario/public/icons/free.svg#cil-address-book"></use>
                    </svg>
                </div>
                <div>
                    <div class="fs-6 fs-semibold text-primary"><?= $clientesController->countClientes() ?></div>
                    <div class="text-medium-emphasis text-uppercase fw-semibold small">CLIENTES</div>
                </div>
            </div>
            <div class="card-footer px-3 py-2"><a class="btn-block text-medium-emphasis d-flex justify-content-between align-items-center" href="/inventario/public/Clientes/index">
                    <span class="small fw-semibold">IR A CLIENTES</span>
                    <svg class="icon">
                        <use xlink:href="/inventario/public/icons/free.svg#cil-chevron-right"></use>
                    </svg></a>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="card">
            <div class="card-body p-3 d-flex aling-items-center">
                <div class="bg-primary text-white p-3 me-3">
                    <svg class="icon icon-xl">
                        <use xlink:href="/inventario/public/icons/free.svg#cil-factory"></use>
                    </svg>
                </div>
                <div>
                    <div class="fs-6 fs-semibold text-primary"><?= $proveedorController->countProveedores()?></div>
                    <div class="text-medium-emphasis text-uppercase fw-semibold small">PROVEEDORES</div>
                </div>
            </div>
            <div class="card-footer px-3 py-2"><a class="btn-block text-medium-emphasis d-flex justify-content-between align-items-center" href="/inventario/public/Proveedor/index">
                    <span class="small fw-semibold">IR A PROVEEDORES</span>
                    <svg class="icon">
                        <use xlink:href="/inventario/public/icons/free.svg#cil-chevron-right"></use>
                    </svg></a>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="card">
            <div class="card-body p-3 d-flex aling-items-center">
                <div class="bg-primary text-white p-3 me-3">
                    <svg class="icon icon-xl">
                        <use xlink:href="/inventario/public/icons/free.svg#cil-cart"></use>
                    </svg>
                </div>
                <div>
                    <div class="fs-6 fs-semibold text-primary"></div>
                    <div class="text-medium-emphasis text-uppercase fw-semibold small">VENTAS</div>
                </div>
            </div>
            <div class="card-footer px-3 py-2"><a class="btn-block text-medium-emphasis d-flex justify-content-between align-items-center" href="/inventario/public/Ventas/index">
                    <span class="small fw-semibold">IR A VENTAS</span>
                    <svg class="icon">
                        <use xlink:href="/inventario/public/icons/free.svg#cil-chevron-right"></use>
                    </svg></a>
            </div>
        </div>
    </div>
</div>

<br>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">ALERTAS INVENTARIO</div>
            <div class="card-body">
                <div class="jumbotron">
                    <h2>No hay alertas</h2>
                    <p>No tiene alertas de inventario pendientes</p>
                </div>
            </div>
        </div>
    </div>
</div>