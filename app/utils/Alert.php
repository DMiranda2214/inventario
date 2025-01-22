<?php

namespace App\Utils;

class Alert {
    public static function showError($title, $message, $url = null) {
        echo '
         <link rel="stylesheet" href="/inventario/public/css/sweetalert2.min.css">
        <script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: "error",
                title: "' . $title . '",
                text: "' . $message . '",
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "' . $url . '";
                }
            });
            
        });
        </script>
        <script src="/inventario/public/js/sweetalert2.min.js"></script>';
    }

    

    public static function showSuccess($title, $message, $url = null) {
        echo '
         <link rel="stylesheet" href="/inventario/public/css/sweetalert2.min.css">
        <script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: "success",
                title: "' . $title . '",
                text: "' . $message . '",
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "' . $url . '";
                }
            });
            
        });
        </script>
        <script src="/inventario/public/js/sweetalert2.min.js"></script>';
    }


    public static function showDelete($urlConfirm = null, $urlCancel = null) {

        echo '
        <link rel="stylesheet" href="/inventario/public/css/sweetalert2.min.css">
        <script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
            title: "Esta seguro de eliminar este registro?",
            text: "Operation irreversible!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Eliminar",
            cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "' . $urlConfirm . '";
                }
                else{
                    window.location.href = "' . $urlCancel . '";
                }
            });
        });
        </script>
        <script src="/inventario/public/js/sweetalert2.min.js"></script>';
    }
}
?>