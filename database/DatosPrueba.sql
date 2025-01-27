
INSERT INTO Proveedor
    (prov_empresa, prov_vendedor, prov_email)
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
INSERT INTO dirProveedor
    (dPro_idProveedor, dPro_direccion)
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

INSERT INTO telProveedor
    (tPro_idProveedor, tPro_telefono)
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


INSERT INTO Cliente
    (cli_nombre, cli_apellido, cli_email)
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

INSERT INTO dirCliente
    (dCli_idCliente, dCli_direccion)
VALUES
    (1, 'Calle Falsa 123'),
    (2, 'Avenida Siempre Viva 742'),
    (3, 'Calle Luna 456'),
    (4, 'Calle Sol 789'),
    (5, 'Calle Estrella 101'),
    (6, 'Calle Nube 202'),
    (7, 'Calle Mar 303'),
    (8, 'Calle Rio 404'),
    (9, 'Calle Lago 505'),
    (10, 'Calle Montaña 606');

INSERT INTO telCliente
    (tCli_idCliente, tCli_telefono)
VALUES
    (1, '1111111111'),
    (2, '2222222222'),
    (3, '3333333333'),
    (4, '4444444444'),
    (5, '5555555555'),
    (6, '6666666666'),
    (7, '7777777777'),
    (8, '8888888888'),
    (9, '9999999999'),
    (10, '0000000000');

INSERT INTO Categoria
  (cat_nombre, cat_descripcion)
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