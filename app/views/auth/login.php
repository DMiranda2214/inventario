<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NUVOLA &CO</title>
    <link rel="stylesheet" href="/inventario/public/css/coreui.min.css">
    <link rel="stylesheet" href="/inventario/public/css/all.min.css">
    <link rel="shortcut icon" href="/inventario/public/icons/cloud-dashboard.svg" />
</head>

<body>
    <div class="bg-light min-vh-100 d-flex flex-row align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="card-group d-block d-md-flex row">
                        <div class="card col-md-12 p-4 mb-0">
                            <div class="card-body">
                                <h1>NUVOLA <b>& Co</b></h1>
                                <br>
                                <p class="text-medium-emphasis">Iniciar Sesion al Sistema</p>
                                <form method="POST" action="/inventario/public/Auth/login">
                                    <div class="input-group mb-3"><span class="input-group-text">
                                            <svg class="c-icon" width="24" height="24">
                                                <use xlink:href="/inventario/public/icons/free.svg#cil-user"></use>
                                            </svg>
                                        </span>
                                        <input class="form-control" type="text" name="username" placeholder="Username">
                                    </div>
                                    <div class="input-group mb-4">
                                        <span class="input-group-text">
                                            <svg class="c-icon" width="24" height="24">
                                                <use xlink:href="/inventario/public/icons/free.svg#cil-lock-locked">
                                                </use>
                                            </svg>
                                        </span>
                                        <input class="form-control" name="password" type="password"
                                            placeholder="Password">
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <button class="btn btn-primary px-4" type="submit">Iniciar Sesion</button>
                                        </div>
                                    </div>
                                </form>
                                <br><br><br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/inventario/public/js/coreui.bundle.min.js"></script>
</body>

</html>