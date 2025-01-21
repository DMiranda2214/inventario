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
  pro_Stock integer NOT NULL,
  pro_idProveedor integer NOT NULL
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