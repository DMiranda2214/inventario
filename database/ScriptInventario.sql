CREATE TABLE Usuario
(
  usu_id integer PRIMARY KEY NOT NULL,
  usu_nombre varchar(80) NOT NULL,
  usu_cuenta varchar(20) UNIQUE NOT NULL,
  usu_email varchar(100) UNIQUE NOT NULL,
  usu_password text NOT NULL,
  usu_idEstado varchar(4) NOT NULL DEFAULT '1000'
);

CREATE TABLE telCliente
(
  tCli_id integer PRIMARY KEY NOT NULL,
  tCli_idCliente integer NOT NULL,
  tCli_telefono varchar(20) NOT NULL
);

CREATE TABLE dirCliente
(
  dCli_id integer PRIMARY KEY NOT NULL,
  dCli_idCliente integer NOT NULL,
  dCli_direccion varchar(100) NOT NULL
);

CREATE TABLE Cliente
(
  cli_id integer PRIMARY KEY NOT NULL,
  cli_nombre varchar(50) NOT NULL,
  cli_apellido varchar(50) NOT NULL,
  cli_email varchar(100) NOT NULL
);

CREATE TABLE Proveedor
(
  prov_id integer PRIMARY KEY NOT NULL,
  prov_empresa varchar(100) NOT NULL,
  prov_vendedor varchar(100) NOT NULL,
  prov_email varchar(100) NOT NULL
);

CREATE TABLE telProveedor
(
  tPro_id integer PRIMARY KEY NOT NULL,
  tPro_idProveedor integer NOT NULL,
  tPro_telefono varchar(20) NOT NULL
);

CREATE TABLE dirProveedor
(
  dPro_id integer PRIMARY KEY NOT NULL,
  dPro_idProveedor integer NOT NULL,
  dPro_direccion varchar(100) NOT NULL
);

CREATE TABLE Categoria
(
  cat_id integer PRIMARY KEY NOT NULL,
  cat_nombre varchar(30) NOT NULL,
  cat_descripcion text NOT NULL
);

CREATE TABLE Producto
(
  pro_id integer PRIMARY KEY NOT NULL,
  pro_nombre varchar(100) NOT NULL,
  pro_idCategoria integer NOT NULL,
  pro_descripcion text NOT NULL,
  pro_precioVenta float NOT NULL,
  pro_cantMin integer NOT NULL
);

CREATE TABLE Inventario
(
  inv_id integer PRIMARY KEY NOT NULL,
  inv_idProducto integer NOT NULL,
  inv_Stock integer NOT NULL,
  inv_precioVenta float NOT NULL
);

CREATE TABLE Abastece
(
  sum_id integer NOT NULL,
  sum_idCompra integer NOT NULL,
  sum_idProducto integer NOT NULL,
  sum_cantidad integer NOT NULL,
  sum_precioUnitario integer NOT NULL,
  sum_subTotal float NOT NULL,
  PRIMARY KEY (sum_id, sum_idCompra, sum_idProducto)
);

CREATE TABLE Pedido
(
  ped_id integer PRIMARY KEY NOT NULL,
  ped_idCliente integer NOT NULL,
  ped_fecha DATE NOT NULL,
  ped_idEstado varchar(4) NOT NULL,
  ped_totalPedido float NOT NULL
);

CREATE TABLE Compra
(
  com_id integer PRIMARY KEY,
  com_idProveedor integer NOT NULL,
  com_fecha DATE NOT NULL,
  com_totalCompra float NOT NULL
);

CREATE TABLE Contiene
(
  cont_id integer NOT NULL,
  cont_idPedido integer NOT NULL,
  cont_idProducto integer NOT NULL,
  cont_precioUnitario float NOT NULL,
  cont_cantidad integer NOT NULL,
  cont_pedidoSubTotal float NOT NULL,
  PRIMARY KEY (cont_id, cont_idPedido, cont_idProducto)
);

CREATE TABLE Proveedor_Producto
(
  pp_idProveedor integer NOT NULL,
  pp_idProducto integer NOT NULL,
  PRIMARY KEY (pp_idProveedor, pp_idProducto)
);

CREATE TABLE Estado
(
  est_id varchar(4) PRIMARY KEY NOT NULL,
  est_Nombre varchar(255) NOT NULL
);

ALTER TABLE telCliente ADD FOREIGN KEY (tCli_idCliente) REFERENCES Cliente (cli_id);

ALTER TABLE dirCliente ADD FOREIGN KEY (dCli_idCliente) REFERENCES Cliente (cli_id);

ALTER TABLE telProveedor ADD FOREIGN KEY (tPro_idProveedor) REFERENCES Proveedor (prov_id);

ALTER TABLE dirProveedor ADD FOREIGN KEY (dPro_idProveedor) REFERENCES Proveedor (prov_id);

ALTER TABLE Producto ADD FOREIGN KEY (pro_idCategoria) REFERENCES Categoria (cat_id);

ALTER TABLE Pedido ADD FOREIGN KEY (ped_idCliente) REFERENCES Cliente (cli_id);

ALTER TABLE Contiene ADD FOREIGN KEY (cont_idProducto) REFERENCES Producto (pro_id);

ALTER TABLE Contiene ADD FOREIGN KEY (cont_idPedido) REFERENCES Pedido (ped_id);

ALTER TABLE Abastece ADD FOREIGN KEY (sum_idCompra) REFERENCES Compra (com_id);

ALTER TABLE Abastece ADD FOREIGN KEY (sum_idProducto) REFERENCES Producto (pro_id);

ALTER TABLE Compra ADD FOREIGN KEY (com_idProveedor) REFERENCES Proveedor (prov_id);

ALTER TABLE Proveedor_Producto ADD FOREIGN KEY (pp_idProducto) REFERENCES Producto (pro_id);

ALTER TABLE Proveedor_Producto ADD FOREIGN KEY (pp_idProveedor) REFERENCES Proveedor (prov_id);

ALTER TABLE Pedido ADD FOREIGN KEY (ped_idEstado) REFERENCES Estado (est_id);

ALTER TABLE Usuario ADD FOREIGN KEY (usu_idEstado) REFERENCES Estado (est_id);

ALTER TABLE Inventario ADD FOREIGN KEY (inv_idProducto) REFERENCES Producto (pro_id);

INSERT INTO Estado
  (est_id, est_Nombre)
VALUES
  ('1000', 'Activo'),
  ('1001', 'Bloqueado'),
  ('2000', 'Completo'),
  ('2001', 'Enviado'),
  ('2002', 'Recibido');

CREATE TRIGGER registrar_inventario
AFTER
INSERT ON
Producto
FOR
EACH
ROW
INSERT INTO Inventario
  (inv_idProducto, inv_Stock, inv_precioVenta)
VALUES
  (NEW.pro_id, 0, 0);

CREATE TRIGGER ingresar_stock
AFTER
INSERT ON
Abastece
FOR
EACH
ROW
UPDATE Inventario
    SET inv_Stock = inv_Stock + NEW.sum_cantidad
    WHERE inv_idProducto = NEW.sum_idProducto;

CREATE TRIGGER descontar_stock
AFTER
INSERT ON
Contiene
FOR
EACH
ROW
UPDATE Inventario
    SET inv_Stock = inv_Stock - NEW.cont_cantidad
    WHERE inv_idProducto = NEW.cont_idProducto;

DELIMITER //

CREATE PROCEDURE insertCliente (
  IN p_nombre VARCHAR
(50),
  IN p_apellido VARCHAR
(50),
  IN p_email VARCHAR
(100),
  IN p_direccion VARCHAR
(100),
  IN p_telefono VARCHAR
(20)
)
BEGIN
  DECLARE v_cli_id INT;

-- Insertar en la tabla Cliente
INSERT INTO Cliente
  (cli_nombre, cli_apellido, cli_email)
VALUES
  (p_nombre, p_apellido, p_email);

-- Obtener el ID del cliente insertado
SET v_cli_id
= LAST_INSERT_ID
();

-- Insertar en la tabla dirCliente
INSERT INTO dirCliente
  (dCli_idCliente, dCli_direccion)
VALUES
  (v_cli_id, p_direccion);

-- Insertar en la tabla telCliente
INSERT INTO telCliente
  (tCli_idCliente, tCli_telefono)
VALUES
  (v_cli_id, p_telefono);
END //

DELIMITER ;

DELIMITER //

CREATE PROCEDURE updateCliente (
  IN p_cli_id INT,
  IN p_email VARCHAR
(100),
  IN p_direccion VARCHAR
(100),
  IN p_telefono VARCHAR
(20)
)
BEGIN
  -- Actualizar la información del cliente en la tabla Cliente
  UPDATE Cliente
  SET 
    cli_email = p_email
  WHERE 
    cli_id = p_cli_id;

  -- Actualizar la dirección del cliente en la tabla dirCliente
  UPDATE dirCliente
  SET 
    dCli_direccion = p_direccion
  WHERE 
    dCli_idCliente = p_cli_id;

  -- Actualizar el teléfono del cliente en la tabla telCliente
  UPDATE telCliente
  SET 
    tCli_telefono = p_telefono
  WHERE 
    tCli_idCliente = p_cli_id;
END
//

DELIMITER ;

DELIMITER //

CREATE PROCEDURE getClienteInfo (
  IN p_cli_id INT
)
BEGIN
  SELECT
    c.cli_id,
    c.cli_nombre,
    c.cli_apellido,
    c.cli_email,
    d.dCli_direccion,
    t.tCli_telefono
  FROM
    Cliente c
    LEFT JOIN
    dirCliente d ON c.cli_id = d.dCli_idCliente
    LEFT JOIN
    telCliente t ON c.cli_id = t.tCli_idCliente
  WHERE 
    c.cli_id = p_cli_id;
END
//

DELIMITER ;

DELIMITER //

CREATE PROCEDURE getAllClientes()
BEGIN
  SELECT
    c.cli_id,
    c.cli_nombre,
    c.cli_apellido,
    c.cli_email,
    d.dCli_direccion,
    t.tCli_telefono
  FROM
    Cliente c
    LEFT JOIN
    dirCliente d ON c.cli_id = d.dCli_idCliente
    LEFT JOIN
    telCliente t ON c.cli_id = t.tCli_idCliente;
END
//

DELIMITER ;

DELIMITER //

CREATE PROCEDURE getAllProveedores()
BEGIN
  SELECT
    p.prov_id,
    p.prov_empresa,
    p.prov_vendedor,
    p.prov_email,
    d.dPro_direccion,
    t.tPro_telefono
  FROM
    Proveedor p
    LEFT JOIN
    dirProveedor d ON p.prov_id = d.dPro_idProveedor
    LEFT JOIN
    telProveedor t ON p.prov_id = t.tPro_idProveedor;
END
//

DELIMITER ;

DELIMITER //

CREATE PROCEDURE getProveedorInfo (
  IN p_prov_id INT
)
BEGIN
  SELECT
    p.prov_id,
    p.prov_empresa,
    p.prov_vendedor,
    p.prov_email,
    d.dPro_direccion,
    t.tPro_telefono
  FROM
    Proveedor p
    LEFT JOIN
    dirProveedor d ON p.prov_id = d.dPro_idProveedor
    LEFT JOIN
    telProveedor t ON p.prov_id = t.tPro_idProveedor
  WHERE 
    p.prov_id = p_prov_id;
END
//

DELIMITER ;

DELIMITER //

CREATE PROCEDURE insertProveedor (
  IN p_empresa VARCHAR
(100),
  IN p_vendedor VARCHAR
(100),
  IN p_email VARCHAR
(100),
  IN p_direccion VARCHAR
(100),
  IN p_telefono VARCHAR
(20)
)
BEGIN
  DECLARE v_prov_id INT;

-- Insertar en la tabla Proveedor
INSERT INTO Proveedor
  (prov_empresa, prov_vendedor, prov_email)
VALUES
  (p_empresa, p_vendedor, p_email);

-- Obtener el ID del proveedor insertado
SET v_prov_id
= LAST_INSERT_ID
();

-- Insertar en la tabla dirProveedor
INSERT INTO dirProveedor
  (dPro_idProveedor, dPro_direccion)
VALUES
  (v_prov_id, p_direccion);

-- Insertar en la tabla telProveedor
INSERT INTO telProveedor
  (tPro_idProveedor, tPro_telefono)
VALUES
  (v_prov_id, p_telefono);
END //

DELIMITER ;

DELIMITER //

CREATE PROCEDURE updateProveedor (
  IN p_prov_id INT,
  IN p_vendedor VARCHAR
(100),
  IN p_email VARCHAR
(100),
  IN p_direccion VARCHAR
(100),
  IN p_telefono VARCHAR
(20)
)
BEGIN
  -- Actualizar la información del proveedor en la tabla Proveedor
  UPDATE Proveedor
  SET 
    prov_vendedor = p_vendedor,
    prov_email = p_email
  WHERE 
    prov_id = p_prov_id;

  -- Actualizar la dirección del proveedor en la tabla dirProveedor
  UPDATE dirProveedor
  SET 
    dPro_direccion = p_direccion
  WHERE 
    dPro_idProveedor = p_prov_id;

  -- Actualizar el teléfono del proveedor en la tabla telProveedor
  UPDATE telProveedor
  SET 
    tPro_telefono = p_telefono
  WHERE 
    tPro_idProveedor = p_prov_id;
END
//

DELIMITER ;

DELIMITER //

CREATE PROCEDURE insertCompra (
  IN p_provid INT,
  IN p_fecha DATE,
  IN p_total FLOAT,
  IN p_producto INT,
  IN p_cantidad INT,
  IN p_precioUnitario FLOAT,
  IN p_subTotal FLOAT
)

BEGIN
  DECLARE v_compra_id INT;

INSERT INTO Compra
  (com_idProveedor, com_fecha, com_totalCompra)
VALUES
  (p_provid, p_fecha, p_total);

SET v_compra_id = LAST_INSERT_ID();

INSERT INTO Abastece
  (sum_idCompra, sum_idProducto, sum_cantidad, sum_precioUnitario, sum_subTotal)
VALUES
  (v_compra_id, p_producto, p_cantidad, p_precioUnitario, p_subTotal);
END //

DELIMITER ;

DELIMITER //

CREATE PROCEDURE getProductsToSell()
BEGIN
  SELECT
    p.pro_id,
    p.pro_nombre,
    i.inv_Stock,
    i.inv_precioVenta
  FROM
    Producto p
    INNER JOIN
    Inventario i ON p.pro_id = i.inv_idProducto
  WHERE 
    i.inv_Stock > 0;
END
//

DELIMITER ;


DELIMITER //

CREATE PROCEDURE insertVenta (
  IN p_cliente_id INT,
  IN p_fecha DATE,
  IN p_totalPedido FLOAT,
  IN p_estado VARCHAR(4),
  IN p_producto INT,
  IN p_cantidad INT,
  IN p_precioUnitario FLOAT,
  IN p_subTotal FLOAT
)
BEGIN
  DECLARE pedido_id INT;

  INSERT INTO pedido
    (ped_idCliente, ped_fecha, ped_idEstado, ped_totalPedido)
  VALUES
    (p_cliente_id, p_fecha, p_estado, p_totalPedido);

  SET pedido_id = LAST_INSERT_ID();

  INSERT INTO Contiene
    (cont_idPedido, cont_idProducto, cont_precioUnitario, cont_cantidad, cont_pedidoSubTotal)
  VALUES
    (pedido_id, p_producto, p_precioUnitario, p_cantidad, p_subTotal);
END //

DELIMITER ;


DELIMITER //

CREATE PROCEDURE getPedidoInfo (
  IN p_ped_id INT
)
BEGIN
  SELECT
    p.ped_id,
    p.ped_fecha,
    p.ped_totalPedido,
    p.ped_idEstado,
    c.cli_nombre,
    c.cli_apellido,
    c.cli_email
  FROM
    Pedido p
    INNER JOIN Cliente c ON p.ped_idCliente = c.cli_id
  WHERE 
    p.ped_id = p_ped_id;
END
//

DELIMITER ;

DELIMITER //

CREATE PROCEDURE getAllPedidos()
BEGIN
  SELECT
    p.ped_id,
    p.ped_fecha,
    p.ped_totalPedido,
    p.ped_idEstado,
    c.cli_nombre,
    c.cli_apellido
  FROM
    Pedido p
    INNER JOIN Cliente c ON p.ped_idCliente = c.cli_id;
END
//

DELIMITER ;


DELIMITER //

CREATE PROCEDURE getAllCompras()
BEGIN
  SELECT
    c.com_id,
    c.com_fecha,
    c.com_totalCompra,
    p.prov_empresa AS proveedor,
    pr.pro_nombre AS producto
  FROM
    Compra c
    INNER JOIN Proveedor p ON c.com_idProveedor = p.prov_id
    INNER JOIN Abastece a ON c.com_id = a.sum_idCompra
    INNER JOIN Producto pr ON a.sum_idProducto = pr.pro_id;
END
//

DELIMITER ;


DELIMITER //

CREATE PROCEDURE getVentasPorPeriodo (
  IN p_fechaInicio DATE,
  IN p_fechaFin DATE
)
BEGIN
  SELECT
    p.ped_fecha,
    c.cli_nombre,
    c.cli_apellido,
    pr.pro_nombre,
    co.cont_cantidad,
    p.ped_totalPedido
  FROM
    Pedido p
    INNER JOIN Cliente c ON p.ped_idCliente = c.cli_id
    INNER JOIN Contiene co ON p.ped_id = co.cont_idPedido
    INNER JOIN Producto pr ON co.cont_idProducto = pr.pro_id
  WHERE 
    p.ped_fecha BETWEEN p_fechaInicio AND p_fechaFin;
END
//

DELIMITER ;

DELIMITER //

CREATE PROCEDURE getComprasPorPeriodo (
  IN p_fechaInicio DATE,
  IN p_fechaFin DATE
)
BEGIN
  SELECT
    p.prov_empresa,
    pr.pro_nombre,
    a.sum_cantidad,
    c.com_fecha,
    c.com_totalCompra
  FROM
    Compra c
    INNER JOIN Proveedor p ON c.com_idProveedor = p.prov_id
    INNER JOIN Abastece a ON c.com_id = a.sum_idCompra
    INNER JOIN Producto pr ON a.sum_idProducto = pr.pro_id
  WHERE 
    c.com_fecha BETWEEN p_fechaInicio AND p_fechaFin;
END
//

DELIMITER ;



INSERT INTO Categoria
  (cat_id, cat_nombre, cat_descripcion)
VALUES
  ('Bolsos', 'Bolsos y carteras de diferentes estilos y tamaños'),
  ('Joyas', 'Collares, pulseras, anillos y otros accesorios de joyería'),
  ('Sombreros', 'Sombreros y gorras para diferentes ocasiones'),
  ('Bufandas', 'Bufandas y pañuelos de varios materiales y diseños'),
  ('Cinturones', 'Cinturones de cuero, tela y otros materiales'),
  ('Gafas de sol', 'Gafas de sol de diferentes estilos y colores'),
  ('Relojes', 'Relojes de pulsera y de bolsillo'),
  ('Guantes', 'Guantes de cuero, lana y otros materiales'),
  ('Paraguas', 'Paraguas de varios tamaños y colores'),
  ('Accesorios para el cabello', 'Pinzas, diademas, lazos y otros accesorios para el cabello');

INSERT INTO Estado
  (est_id, est_Nombre)
VALUES
  ('1000', 'Activo'),
  ('1001', 'Bloqueado'),
  ('2000', 'Completo'),
  ('2001', 'Enviado'),
  ('2002', 'Recibido');

  INSERT INTO Proveedor (prov_empresa, prov_vendedor, prov_email)
  VALUES
    ('Empresa A', 'Vendedor A', 'vendedorA@empresaA.com'),
    ('Empresa B', 'Vendedor B', 'vendedorB@empresaB.com'),
    ('Empresa C', 'Vendedor C', 'vendedorC@empresaC.com'),
    ('Empresa D', 'Vendedor D', 'vendedorD@empresaD.com'),
    ('Empresa E', 'Vendedor E', 'vendedorE@empresaE.com'),
    ('Empresa F', 'Vendedor F', 'vendedorF@empresaF.com'),
    ('Empresa G', 'Vendedor G', 'vendedorG@empresaG.com'),
    ('Empresa H', 'Vendedor H', 'vendedorH@empresaH.com'),
    ('Empresa I', 'Vendedor I', 'vendedorI@empresaI.com'),
    ('Empresa J', 'Vendedor J', 'vendedorJ@empresaJ.com');
    INSERT INTO dirProveedor (dPro_idProveedor, dPro_direccion)
    VALUES
      (1, 'Direccion A'),
      (2, 'Direccion B'),
      (3, 'Direccion C'),
      (4, 'Direccion D'),
      (5, 'Direccion E'),
      (6, 'Direccion F'),
      (7, 'Direccion G'),
      (8, 'Direccion H'),
      (9, 'Direccion I'),
      (10, 'Direccion J');

    INSERT INTO telProveedor (tPro_idProveedor, tPro_telefono)
    VALUES
      (1, '1234567890'),
      (2, '2345678901'),
      (3, '3456789012'),
      (4, '4567890123'),
      (5, '5678901234'),
      (6, '6789012345'),
      (7, '7890123456'),
      (8, '8901234567'),
      (9, '9012345678'),
      (10, '0123456789');


    INSERT INTO Cliente (cli_nombre, cli_apellido, cli_email)
    VALUES
      ('Carlos', 'Gomez', 'carlos.gomez@example.com'),
      ('Ana', 'Martinez', 'ana.martinez@example.com'),
      ('Luis', 'Fernandez', 'luis.fernandez@example.com'),
      ('Maria', 'Lopez', 'maria.lopez@example.com'),
      ('Jose', 'Perez', 'jose.perez@example.com'),
      ('Laura', 'Garcia', 'laura.garcia@example.com'),
      ('Juan', 'Rodriguez', 'juan.rodriguez@example.com'),
      ('Elena', 'Sanchez', 'elena.sanchez@example.com'),
      ('Miguel', 'Ramirez', 'miguel.ramirez@example.com'),
      ('Sofia', 'Torres', 'sofia.torres@example.com');

    INSERT INTO dirCliente (dCli_idCliente, dCli_direccion)
    VALUES
      (3, 'Calle Falsa 123'),
      (4, 'Avenida Siempre Viva 742'),
      (5, 'Calle Luna 456'),
      (6, 'Calle Sol 789'),
      (7, 'Calle Estrella 101'),
      (8, 'Calle Nube 202'),
      (9, 'Calle Mar 303'),
      (10, 'Calle Rio 404'),
      (11, 'Calle Lago 505'),
      (12, 'Calle Montaña 606');

    INSERT INTO telCliente (tCli_idCliente, tCli_telefono)
    VALUES
      (3, '1111111111'),
      (4, '2222222222'),
      (5, '3333333333'),
      (6, '4444444444'),
      (7, '5555555555'),
      (8, '6666666666'),
      (9, '7777777777'),
      (10, '8888888888'),
      (11, '9999999999'),
      (12, '0000000000');