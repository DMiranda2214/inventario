<?php

namespace App\Enums;

enum EstadoPedidoEnum: int
{
    case COMPLETADO = 2000;
    case ENVIADO = 2001;
    case RECIBIDO = 2002;
}
?>