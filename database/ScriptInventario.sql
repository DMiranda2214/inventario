CREATE TABLE Usuario(
  usu_id integer PRIMARY KEY NOT NULL AUTO_INCREMENT,
  usu_nombre varchar(255) NOT NULL,
  usu_cuenta varchar(255) UNIQUE NOT NULL,
  usu_email varchar(255) UNIQUE NOT NULL,
  usu_password text NOT NULL,
  usu_idEstado VARCHAR(4) NOT NULL DEFAULT 1000
);


CREATE TABLE Proveedor (
  prov_id integer PRIMARY KEY NOT NULL AUTO_INCREMENT,
  prov_empresa varchar(255) NOT NULL,
  prov_vendedor varchar(255) NOT NULL,
  prov_email varchar(255) NOT NULL
);

CREATE TABLE telProveedor (
  tPro_id integer PRIMARY KEY NOT NULL AUTO_INCREMENT,
  tPro_idProveedor integer NOT NULL,
  tPro_telefono varchar(50) NOT NULL
);

CREATE TABLE dirProveedor (
  dPro_id integer PRIMARY KEY NOT NULL AUTO_INCREMENT,
  dPro_idProveedor integer NOT NULL,
  dPro_direccion varchar(50) NOT NULL
);

CREATE TABLE Categoria (
  cat_id integer PRIMARY KEY NOT NULL AUTO_INCREMENT,
  cat_nombre varchar(255) NOT NULL,
  cat_descripcion text NOT NULL
);

CREATE TABLE Producto (
  pro_id integer PRIMARY KEY NOT NULL AUTO_INCREMENT,
  pro_nombre varchar(255) NOT NULL,
  pro_idCategoria INTEGER NOT NULL,
  pro_descripcion text NOT NULL,
  pro_precioVenta integer NOT NULL,
  pro_minStock integer NOT NULL DEFAULT 10
);

CREATE TABLE Abastece (
  sum_id integer NOT NULL AUTO_INCREMENT,
  sum_idCompra integer NOT NULL,
  sum_idProducto integer NOT NULL,
  sum_cantidad integer NOT NULL,
  sum_precioUnitario integer NOT NULL,
  sum_subTotal float NOT NULL,
  PRIMARY KEY (sum_id, sum_idCompra, sum_idProducto)
);

CREATE TABLE Compra (
  com_id integer PRIMARY KEY NOT NULL AUTO_INCREMENT,
  com_idProveedor integer NOT NULL,
  com_fecha DATE NOT NULL,
  com_totalCompra float NOT NULL
);

CREATE TABLE Cliente (
  cli_id integer PRIMARY KEY NOT NULL AUTO_INCREMENT,
  cli_nombre varchar(255) NOT NULL,
  cli_apellido varchar(255) NOT NULL,
  cli_email varchar(255) NOT NULL
);

CREATE TABLE telCliente (
  tCli_id integer PRIMARY KEY NOT NULL AUTO_INCREMENT,
  tCli_idCliente integer NOT NULL,
  tCli_telefono varchar(20) NOT NULL
);

CREATE TABLE dirCliente (
  dCli_id integer PRIMARY KEY NOT NULL AUTO_INCREMENT,
  dCli_idCliente integer NOT NULL,
  dCli_direccion varchar(255) NOT NULL
);

CREATE TABLE Pedido (
  ped_id integer PRIMARY KEY NOT NULL AUTO_INCREMENT,
  ped_idCliente integer NOT NULL,
  ped_fecha DATE NOT NULL,
  ped_idEstado VARCHAR(4) NOT NULL,
  ped_totalPedido float NOT NULL
);

CREATE TABLE Inventario (
  inv_id integer PRIMARY KEY NOT NULL AUTO_INCREMENT,
  inv_idProducto integer NOT NULL,
  inv_stock float NOT NULL,
  inv_precioVenta float NOT NULL
);

CREATE TABLE Contiene (
  cont_id integer NOT NULL AUTO_INCREMENT,
  cont_idPedido integer NOT NULL,
  cont_idProducto integer NOT NULL,
  cont_precioUnitario float NOT NULL,
  cont_cantidad integer NOT NULL,
  cont_pedidoSubTotal float NOT NULL,
  PRIMARY KEY (cont_id, cont_idPedido, cont_idProducto)
);

CREATE TABLE Proveedor_Producto (
  pp_idProveedor integer,
  pp_idProducto integer,
  PRIMARY KEY (pp_idProveedor, pp_idProducto)
);

CREATE TABLE Estado (
  est_id VARCHAR(4) PRIMARY KEY NOT NULL,
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

INSERT INTO usuario
    (usu_id, usu_nombre,usu_cuenta,usu_email,usu_password,usu_idEstado)
VALUES
    (1, 'admin','admin','admin@admin.com','$2y$10$JUTuOo3RQu8.DYnr.W0Xi.Lz8XJVOdLTQFvjN394UW87GSF5NpJca',1000),
    (2, 'Nuvola & Co.', 'Nuvola', 'nuvolaandco@gmail.com', '$2y$10$PAkzdK90TGyjTAT936.s4OiibwQ8FWnSmZQsXYI4uus.FxjshEHMS', '1000');

CREATE TRIGGER registrar_inventario
AFTER INSERT ON Producto
FOR EACH ROW
INSERT INTO Inventario
  (inv_idProducto, inv_Stock, inv_precioVenta)
VALUES
  (NEW.pro_id, 0, NEW.pro_precioVenta);

CREATE TRIGGER actualizar_precioInventario
AFTER UPDATE ON Producto
FOR EACH ROW
UPDATE Inventario
  SET inv_precioVenta = NEW.pro_precioVenta
  WHERE inv_idProducto = NEW.pro_id;

CREATE TRIGGER ingresar_stock
AFTER INSERT ON Abastece
FOR EACH ROW
UPDATE Inventario
    SET inv_Stock = inv_Stock + NEW.sum_cantidad
    WHERE inv_idProducto = NEW.sum_idProducto;

CREATE TRIGGER descontar_stock
AFTER INSERT ON Contiene
FOR EACH ROW
UPDATE Inventario
    SET inv_Stock = inv_Stock - NEW.cont_cantidad
    WHERE inv_idProducto = NEW.cont_idProducto;


DELIMITER //

  CREATE PROCEDURE insertCliente (
    IN p_nombre VARCHAR(50),
    IN p_apellido VARCHAR(50),
    IN p_email VARCHAR(100),
    IN p_direccion VARCHAR(100),
    IN p_telefono VARCHAR(20)
  )
  BEGIN
    DECLARE v_cli_id INT;
    -- Insertar en la tabla Cliente
    INSERT INTO Cliente (cli_nombre, cli_apellido, cli_email)
    VALUES (p_nombre, p_apellido, p_email);
    -- Obtener el ID del cliente insertado
    SET v_cli_id = LAST_INSERT_ID();
    -- Insertar en la tabla dirCliente
    INSERT INTO dirCliente(dCli_idCliente, dCli_direccion)
    VALUES (v_cli_id, p_direccion);
    -- Insertar en la tabla telCliente
    INSERT INTO telCliente (tCli_idCliente, tCli_telefono)
    VALUES (v_cli_id, p_telefono);
  END //

DELIMITER ;

DELIMITER //

  CREATE PROCEDURE updateCliente (
    IN p_cli_id INT,
    IN p_email VARCHAR(100),
    IN p_direccion VARCHAR(100),
    IN p_telefono VARCHAR(20)
  )
  BEGIN
    -- Actualizar la información del cliente en la tabla Cliente
    UPDATE Cliente
    SET cli_email = p_email
    WHERE cli_id = p_cli_id;
    -- Actualizar la dirección del cliente en la tabla dirCliente
    UPDATE dirCliente
    SET dCli_direccion = p_direccion
    WHERE dCli_idCliente = p_cli_id;
    -- Actualizar el teléfono del cliente en la tabla telCliente
    UPDATE telCliente
    SET tCli_telefono = p_telefono
    WHERE tCli_idCliente = p_cli_id;
  END
  //

DELIMITER ;

DELIMITER //

  CREATE PROCEDURE getClienteInfo (IN p_cli_id INT)
  BEGIN
    SELECT c.cli_id,c.cli_nombre,c.cli_apellido,c.cli_email,d.dCli_direccion,t.tCli_telefono
    FROM Cliente c
    LEFT JOIN dirCliente d ON c.cli_id = d.dCli_idCliente
    LEFT JOIN telCliente t ON c.cli_id = t.tCli_idCliente
    WHERE c.cli_id = p_cli_id;
  END
//

DELIMITER ;

DELIMITER //

  CREATE PROCEDURE getAllClientes()
  BEGIN
    SELECT c.cli_id,c.cli_nombre,c.cli_apellido,c.cli_email,d.dCli_direccion,t.tCli_telefono
    FROM Cliente c
    LEFT JOIN dirCliente d ON c.cli_id = d.dCli_idCliente
    LEFT JOIN telCliente t ON c.cli_id = t.tCli_idCliente;
  END
  //

DELIMITER ;

DELIMITER //

  CREATE PROCEDURE getAllProveedores()
  BEGIN
    SELECT p.prov_id,p.prov_empresa,p.prov_vendedor,p.prov_email,d.dPro_direccion,t.tPro_telefono
    FROM Proveedor p
    LEFT JOIN dirProveedor d ON p.prov_id = d.dPro_idProveedor
    LEFT JOIN telProveedor t ON p.prov_id = t.tPro_idProveedor;
  END
  //

DELIMITER ;

DELIMITER //

CREATE PROCEDURE getProveedorInfo (
  IN p_prov_id INT
)
BEGIN
  SELECT p.prov_id, p.prov_empresa, p.prov_vendedor, p.prov_email, d.dPro_direccion, t.tPro_telefono
  FROM Proveedor p
  LEFT JOIN dirProveedor d ON p.prov_id = d.dPro_idProveedor
  LEFT JOIN telProveedor t ON p.prov_id = t.tPro_idProveedor
  WHERE p.prov_id = p_prov_id;
END
//

DELIMITER ;

DELIMITER //

  CREATE PROCEDURE insertProveedor (
    IN p_empresa VARCHAR(100),
    IN p_vendedor VARCHAR(100),
    IN p_email VARCHAR(100),
    IN p_direccion VARCHAR(100),
    IN p_telefono VARCHAR(20)
  )
  BEGIN
    DECLARE v_prov_id INT;
    -- Insertar en la tabla Proveedor
    INSERT INTO Proveedor (prov_empresa, prov_vendedor, prov_email)
    VALUES (p_empresa, p_vendedor, p_email);
  -- Obtener el ID del proveedor insertado
  SET v_prov_id = LAST_INSERT_ID();

  -- Insertar en la tabla dirProveedor
  INSERT INTO dirProveedor (dPro_idProveedor, dPro_direccion)
  VALUES (v_prov_id, p_direccion);

  -- Insertar en la tabla telProveedor
  INSERT INTO telProveedor (tPro_idProveedor, tPro_telefono)
  VALUES (v_prov_id, p_telefono);
  END //

DELIMITER ;

DELIMITER //

CREATE PROCEDURE updateProveedor (
  IN p_prov_id INT,
  IN p_vendedor VARCHAR(100),
  IN p_email VARCHAR(100),
  IN p_direccion VARCHAR(100),
  IN p_telefono VARCHAR(20)
)
BEGIN
  -- Actualizar la información del proveedor en la tabla Proveedor
  UPDATE Proveedor
  SET prov_vendedor = p_vendedor, prov_email = p_email
  WHERE prov_id = p_prov_id;

  -- Actualizar la dirección del proveedor en la tabla dirProveedor
  UPDATE dirProveedor
  SET dPro_direccion = p_direccion
  WHERE dPro_idProveedor = p_prov_id;

  -- Actualizar el teléfono del proveedor en la tabla telProveedor
  UPDATE telProveedor
  SET tPro_telefono = p_telefono
  WHERE tPro_idProveedor = p_prov_id;
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

  INSERT INTO Compra(com_idProveedor, com_fecha, com_totalCompra)
  VALUES(p_provid, p_fecha, p_total);

  SET v_compra_id = LAST_INSERT_ID();

  INSERT INTO Abastece(sum_idCompra, sum_idProducto, sum_cantidad, sum_precioUnitario, sum_subTotal)
  VALUES(v_compra_id, p_producto, p_cantidad, p_precioUnitario, p_subTotal);
  END //

DELIMITER ;

DELIMITER //

  CREATE PROCEDURE getProductsToSell()
  BEGIN
    SELECT p.pro_id, p.pro_nombre, i.inv_Stock, i.inv_precioVenta
    FROM Producto p
    INNER JOIN Inventario i ON p.pro_id = i.inv_idProducto
    WHERE i.inv_Stock > 0;
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

CREATE PROCEDURE getPedidoInfo (IN p_ped_id INT)
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

DELIMITER //

CREATE PROCEDURE getPedidoDetalle (
  IN p_ped_id INT
)
BEGIN
  SELECT
    p.ped_id,
    p.ped_fecha,
    c.cli_nombre,
    c.cli_apellido,
    c.cli_email,
    d.dCli_direccion,
    t.tCli_telefono,
    pr.pro_nombre,
    co.cont_cantidad,
    co.cont_precioUnitario,
    co.cont_pedidoSubTotal
  FROM
    Pedido p
    INNER JOIN Cliente c ON p.ped_idCliente = c.cli_id
    INNER JOIN Contiene co ON p.ped_id = co.cont_idPedido
    INNER JOIN Producto pr ON co.cont_idProducto = pr.pro_id
    LEFT JOIN dirCliente d ON c.cli_id = d.dCli_idCliente
    LEFT JOIN telCliente t ON c.cli_id = t.tCli_idCliente
  WHERE 
    p.ped_id = p_ped_id;
END
//

DELIMITER ;

DELIMITER //

CREATE PROCEDURE getCompraDetalle (
  IN p_com_id INT
)
BEGIN
  SELECT
    p.prov_empresa,
    c.com_fecha,
    p.prov_vendedor,
    d.dPro_direccion,
    pr.pro_nombre,
    a.sum_cantidad,
    a.sum_precioUnitario,
    a.sum_subTotal
  FROM
    Compra c
    INNER JOIN Proveedor p ON c.com_idProveedor = p.prov_id
    INNER JOIN dirProveedor d ON p.prov_id = d.dPro_idProveedor
    INNER JOIN Abastece a ON c.com_id = a.sum_idCompra
    INNER JOIN Producto pr ON a.sum_idProducto = pr.pro_id
  WHERE 
    c.com_id = p_com_id;
END
//

DELIMITER ;