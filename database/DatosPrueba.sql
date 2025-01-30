INSERT INTO  categoria  ( cat_id ,  cat_nombre ,  cat_descripcion ) VALUES
(1, 'Bolsos', 'Bolsos y carteras de diferentes estilos y tamaños'),
(2, 'Joyas', 'Collares, pulseras, anillos y otros accesorios de joyería'),
(3, 'Sombreros', 'Sombreros y gorras para diferentes ocasiones'),
(4, 'Bufandas', 'Bufandas y pañuelos de varios materiales y diseños'),
(5, 'Cinturones', 'Cinturones de cuero, tela y otros materiales'),
(6, 'Gafas de sol', 'Gafas de sol de diferentes estilos y colores'),
(7, 'Relojes', 'Relojes de pulsera y de bolsillo'),
(8, 'Guantes', 'Guantes de cuero, lana y otros materiales'),
(9, 'Paraguas', 'Paraguas de varios tamaños y colores'),
(10, 'Accesorios para el cabello', 'Pinzas, diademas, lazos y otros accesorios para el cabello');

INSERT INTO  producto  ( pro_id ,  pro_nombre ,  pro_idCategoria ,  pro_descripcion ,  pro_precioVenta ,  pro_minStock ) VALUES
(1, 'producto A', 4, 'producto A', 20000, 10),
(2, 'Producto 1', 1, 'Descripción del Producto 1', 100, 10),
(3, 'Producto 2', 1, 'Descripción del Producto 2', 200, 20),
(4, 'Producto 3', 2, 'Descripción del Producto 3', 300, 30),
(5, 'Producto 4', 2, 'Descripción del Producto 4', 400, 40),
(6, 'Producto 5', 1, 'Descripción del Producto 5', 500, 20),
(7, 'Producto 6', 3, 'Descripción del Producto 6', 600, 60),
(8, 'Producto 7', 4, 'Descripción del Producto 7', 700, 70),
(9, 'Producto 8', 4, 'Descripción del Producto 8', 800, 80),
(10, 'Producto 9', 5, 'Descripción del Producto 9', 900, 90),
(11, 'Producto 10', 5, 'Descripción del Producto 10', 1000, 100),
(12, 'Producto 11', 1, 'Descripción del Producto 11', 1100, 110),
(13, 'Producto 12', 1, 'Descripción del Producto 12', 1200, 120),
(14, 'Producto 13', 2, 'Descripción del Producto 13', 1300, 130),
(15, 'Producto 14', 2, 'Descripción del Producto 14', 1400, 140),
(16, 'Producto 15', 3, 'Descripción del Producto 15', 1500, 150),
(17, 'Producto 16', 3, 'Descripción del Producto 16', 1600, 160),
(18, 'Producto 17', 4, 'Descripción del Producto 17', 1700, 170),
(19, 'Producto 18', 4, 'Descripción del Producto 18', 1800, 180),
(20, 'Producto 19', 5, 'Descripción del Producto 19', 1900, 190),
(21, 'Producto 20', 5, 'Descripción del Producto 20', 2000, 200),
(22, 'Producto B', 3, 'Producto B', 20000, 10);

INSERT INTO  cliente  ( cli_id ,  cli_nombre ,  cli_apellido ,  cli_email ) VALUES
(1, 'Carlos', 'Gomez', 'carlos.gomez@example.com'),
(2, 'Ana', 'Martinez', 'ana.martinez@example.com'),
(3, 'Luis', 'Fernandez', 'luis.fernandez@example.com'),
(4, 'Maria', 'Lopez', 'maria.lopez@example.com'),
(5, 'Jose', 'Perez', 'jose.perez@example.com'),
(6, 'Laura', 'Garcia', 'laura.garcia@example.com'),
(7, 'Juan', 'Rodriguez', 'juan.rodriguez@example.com'),
(8, 'Elena', 'Sanchez', 'elena.sanchez@example.com'),
(9, 'Miguel', 'Ramirez', 'miguel.ramirez@example.com'),
(10, 'Sofia', 'Torres', 'sofia.torres@example.com');

INSERT INTO  telcliente  ( tCli_id ,  tCli_idCliente ,  tCli_telefono ) VALUES
(1, 1, '1111111111'),
(2, 2, '2222222222'),
(3, 3, '3333333333'),
(4, 4, '4444444444'),
(5, 5, '5555555555'),
(6, 6, '6666666666'),
(7, 7, '7777777777'),
(8, 8, '8888888888'),
(9, 9, '9999999999'),
(10, 10, '0000000000');

INSERT INTO  dircliente  ( dCli_id ,  dCli_idCliente ,  dCli_direccion ) VALUES
(1, 1, 'Calle Falsa 123'),
(2, 2, 'Avenida Siempre Viva 742'),
(3, 3, 'Calle Luna 456'),
(4, 4, 'Calle Sol 789'),
(5, 5, 'Calle Estrella 101'),
(6, 6, 'Calle Nube 202'),
(7, 7, 'Calle Mar 303'),
(8, 8, 'Calle Rio 404'),
(9, 9, 'Calle Lago 505'),
(10, 10, 'Calle Montaña 606');

INSERT INTO  proveedor  ( prov_id ,  prov_empresa ,  prov_vendedor ,  prov_email ) VALUES
(1, 'Empresa A', 'Vendedor A', 'vendedorA@empresaA.com'),
(2, 'Empresa B', 'Vendedor B', 'vendedorB@empresaB.com'),
(3, 'Empresa C', 'Vendedor C', 'vendedorC@empresaC.com'),
(4, 'Empresa D', 'Vendedor D', 'vendedorD@empresaD.com'),
(5, 'Empresa E', 'Vendedor E', 'vendedorE@empresaE.com'),
(6, 'Empresa F', 'Vendedor F', 'vendedorF@empresaF.com'),
(7, 'Empresa G', 'Vendedor G', 'vendedorG@empresaG.com'),
(8, 'Empresa H', 'Vendedor H', 'vendedorH@empresaH.com'),
(9, 'Empresa I', 'Vendedor I', 'vendedorI@empresaI.com'),
(10, 'Empresa J', 'Vendedor J', 'vendedorJ@empresaJ.com');

INSERT INTO  dirproveedor  ( dPro_id ,  dPro_idProveedor ,  dPro_direccion ) VALUES
(1, 1, 'Direccion A'),
(2, 2, 'Direccion B'),
(3, 3, 'Direccion C'),
(4, 4, 'Direccion D'),
(5, 5, 'Direccion E'),
(6, 6, 'Direccion F'),
(7, 7, 'Direccion G'),
(8, 8, 'Direccion H'),
(9, 9, 'Direccion I'),
(10, 10, 'Direccion J');

INSERT INTO  telproveedor  ( tPro_id ,  tPro_idProveedor ,  tPro_telefono ) VALUES
(1, 1, '1234567890'),
(2, 2, '2345678901'),
(3, 3, '3456789012'),
(4, 4, '4567890123'),
(5, 5, '5678901234'),
(6, 6, '6789012345'),
(7, 7, '7890123456'),
(8, 8, '8901234567'),
(9, 9, '9012345678'),
(10, 10, '0123456789');


INSERT INTO  compra  ( com_id ,  com_idProveedor ,  com_fecha ,  com_totalCompra ) VALUES
(1, 2, '2025-01-31', 240000),
(2, 3, '2025-01-18', 4500000),
(3, 4, '2025-01-25', 368000),
(4, 3, '2025-01-25', 1250000);

INSERT INTO  pedido  ( ped_id ,  ped_idCliente ,  ped_fecha ,  ped_idEstado ,  ped_totalPedido ) VALUES
(1, 3, '2025-01-31', '2000', 6500),
(2, 6, '2025-02-04', '2000', 5000),
(3, 8, '2025-02-01', '2000', 1000),
(4, 10, '2025-02-01', '2000', 2500),
(5, 4, '2025-01-11', '2000', 1000);

INSERT INTO  abastece  ( sum_id ,  sum_idCompra ,  sum_idProducto ,  sum_cantidad ,  sum_precioUnitario ,  sum_subTotal ) VALUES
(1, 1, 2, 12, 20000, 240000),
(2, 2, 5, 250, 18000, 4500000),
(3, 3, 6, 23, 16000, 368000),
(4, 4, 11, 25, 50000, 1250000);

INSERT INTO  contiene  ( cont_id ,  cont_idPedido ,  cont_idProducto ,  cont_precioUnitario ,  cont_cantidad ,  cont_pedidoSubTotal ) VALUES
(1, 1, 6, 500, 13, 6500),
(2, 2, 11, 1000, 5, 5000),
(3, 3, 6, 500, 2, 1000),
(4, 4, 6, 500, 5, 2500),
(5, 5, 6, 500, 2, 1000);