CREATE TABLE Usuario (
  usu_id integer PRIMARY KEY NOT NULL,
  usu_nombre varchar(80) NOT NULL,
  usu_cuenta varchar(20) UNIQUE NOT NULL,
  usu_email varchar(100) UNIQUE NOT NULL,
  usu_password text NOT NULL,
  usu_idEstado varchar(4) NOT NULL DEFAULT '1000'
);

CREATE TABLE telCliente (
  tCli_id integer PRIMARY KEY NOT NULL,
  tCli_idCliente integer NOT NULL,
  tCli_telefono varchar(20) NOT NULL
);

CREATE TABLE dirCliente (
  dCli_id integer PRIMARY KEY NOT NULL,
  dCli_idCliente integer NOT NULL,
  dCli_direccion varchar(100) NOT NULL
);

CREATE TABLE Cliente (
  cli_id integer PRIMARY KEY NOT NULL,
  cil_nombre varchar(50) NOT NULL,
  cil_apellido varchar(50) NOT NULL,
  cil_email varchar(100) NOT NULL
);

CREATE TABLE Proveedor (
  prov_id integer PRIMARY KEY NOT NULL,
  prov_empresa varchar(100) NOT NULL,
  prov_vendedor varchar(100) NOT NULL,
  prov_email varchar(100) NOT NULL
);

CREATE TABLE telProveedor (
  tPro_id integer PRIMARY KEY NOT NULL,
  tPro_idProveedor integer NOT NULL,
  tPro_telefono varchar(20) NOT NULL
);

CREATE TABLE dirProveedor (
  dPro_id integer PRIMARY KEY NOT NULL,
  dPro_idProveedor integer NOT NULL,
  dPro_direccion varchar(100) NOT NULL
);

CREATE TABLE Categoria (
  cat_id integer PRIMARY KEY NOT NULL,
  cat_nombre varchar(30) NOT NULL,
  cat_descripcion text NOT NULL
);

CREATE TABLE Producto (
  pro_id integer PRIMARY KEY NOT NULL,
  pro_nombre varchar(100) NOT NULL,
  pro_idCategoria integer NOT NULL,
  pro_descripcion text NOT NULL,
  pro_precioVenta float NOT NULL,
  pro_cantMin integer NOT NULL
);

CREATE TABLE Inventario (
  inv_id integer PRIMARY KEY NOT NULL,
  inv_idProducto integer NOT NULL,
  inv_Stock integer NOT NULL,
  inv_precioVenta float NOT NULL
);

CREATE TABLE Abastece (
  sum_id integer NOT NULL,
  sum_idCompra integer NOT NULL,
  sum_idProducto integer NOT NULL,
  sum_cantidad integer NOT NULL,
  sum_precioUnitario integer NOT NULL,
  sum_subTotal float NOT NULL,
  PRIMARY KEY (sum_id, sum_idCompra, sum_idProducto)
);

CREATE TABLE Pedido (
  ped_id integer PRIMARY KEY NOT NULL,
  ped_idCliente integer NOT NULL,
  ped_fecha timestamp NOT NULL,
  ped_idEstado varchar(4) NOT NULL,
  ped_totalPedido float NOT NULL
);

CREATE TABLE Compra (
  com_id integer PRIMARY KEY,
  com_idProveedor integer NOT NULL,
  com_fecha timestamp NOT NULL,
  com_totalCompra float NOT NULL
);

CREATE TABLE Contiene (
  cont_id integer NOT NULL,
  cont_idPedido integer NOT NULL,
  cont_idProducto integer NOT NULL,
  cont_precioUnitario float NOT NULL,
  cont_cantidad integer NOT NULL,
  cont_pedidoSubTotal float NOT NULL,
  PRIMARY KEY (cont_id, cont_idPedido, cont_idProducto)
);

CREATE TABLE Proveedor_Producto (
  pp_idProveedor integer NOT NULL,
  pp_idProducto integer NOT NULL,
  PRIMARY KEY (pp_idProveedor, pp_idProducto)
);

CREATE TABLE Estado (
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

INSERT INTO Estado (est_id, est_Nombre) VALUES
('1000', 'Activo'),
('1001', 'Bloqueado'),
('2000', 'Completo'),
('2001', 'Enviado'),
('2002', 'Recibido');

CREATE TRIGGER actualizar_stock
AFTER INSERT ON Abastece
FOR EACH ROW
  UPDATE Producto
  SET pro_Stock = pro_Stock + NEW.sum_cantidad
  WHERE pro_id = NEW.sum_idProducto;

CREATE TRIGGER descontar_stock
AFTER INSERT ON Contiene
FOR EACH ROW
  UPDATE Producto
    SET pro_Stock = pro_Stock - NEW.cont_cantidad
    WHERE pro_id = NEW.cont_idProducto;

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
  INSERT INTO Cliente (cil_nombre, cil_apellido, cil_email)
  VALUES (p_nombre, p_apellido, p_email);

  -- Obtener el ID del cliente insertado
  SET v_cli_id = LAST_INSERT_ID();

  -- Insertar en la tabla dirCliente
  INSERT INTO dirCliente (dCli_idCliente, dCli_direccion)
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
  SET 
    cil_email = p_email
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
END //

DELIMITER ;

DELIMITER //

CREATE PROCEDURE getClienteInfo (
  IN p_cli_id INT
)
BEGIN
  SELECT 
    c.cli_id,
    c.cil_nombre,
    c.cil_apellido,
    c.cil_email,
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
END //

DELIMITER ;

DELIMITER //

CREATE PROCEDURE getAllClientes()
BEGIN
  SELECT 
    c.cli_id,
    c.cil_nombre,
    c.cil_apellido,
    c.cil_email,
    d.dCli_direccion,
    t.tCli_telefono
  FROM 
    Cliente c
  LEFT JOIN 
    dirCliente d ON c.cli_id = d.dCli_idCliente
  LEFT JOIN 
    telCliente t ON c.cli_id = t.tCli_idCliente;
END //

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
END //

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
END //

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
END //

DELIMITER ;