create database proyecto;
use proyecto;
create table categorias
(
    id int not null auto_increment,
    nombre varchar(50) not null,
    primary key(id)
)engine=innodb;

create table productos
(
    id int not null auto_increment,
    categoria_id int not null,
    nombre varchar(50) not null,
    marca varchar (50) not null,
	descripcion text null,
    precio numeric(10,2) not null,
    cantidad int not null,
    imagen text not null,
    primary key(id),
	foreign key( categoria_id) references  categorias(id) on delete cascade
    
)engine=innodb;

create table clientes
(
    id int not null auto_increment,
    nombre varchar(50) not null,
    email varchar(100) not null,
    direccion varchar(100),
    login varchar(20) unique not null,
    password varchar(128) not null,
    telefono varchar(15),
    primary key(id)

)engine=innodb;

create table ventas
(
    id int not null auto_increment,
    fecha datetime not null,
    cliente_id int not null,
    estado char(1) not null default 'P',
    primary key(id),
    foreign key(cliente_id) references clientes(id)

)engine=innodb;

create table detalleventas
(
    id int not null auto_increment,
    venta_id int not null,
    producto_id int not null,
    cantidad int not null,
    precio int not null,
    primary key(id),
    foreign key(producto_id) references productos(id),
    foreign key(venta_id) references ventas(id)
)engine=innodb;


select c.nombre from categorias c;




insert into categorias values (null,'Electronicos');
insert into categorias values (null,'Computo');
insert into categorias values (null,'Celulares');
insert into categorias values (null,'Jugetes');
insert into categorias values (null,'otros');

select * from  categorias;
select * from clientes;

insert into productos values(null,1,'TV SMART','SAMSUNG','4K UHD 7 Series Smart TV (2019)',7400.00,10,'https://images-na.ssl-images-amazon.com/images/I/81u1zPEUChL._AC_SL1500_.jpg');
insert into productos values(null,2,'ROUTER','TP-Link','TL-WR941HP Wireless N 450Mbps',300.00,200,'https://intercompras.com/images/product/TP-LINK_TL-WR941HP.jpg');
insert into productos values(null,2,'Portatil','DELL','BQ060T Corei7',8838,96,'https://static.kemikcdn.com/2016/05/71c3vsvoa8l._sl1500_.jpg');

insert into productos values(null,1,'ROUTER','MIKROTIK','3Puertos Ethernet 10/100 2.4Ghz AP',200,10,'https://www.opirata.com/images/router-mikrotik-RB931-2nD-1.jpg');
insert into productos values(null,5,'Audífonos','SAMSUNG','Bluetooth Inalámbricos',150,14,'https://http2.mlstatic.com/audifonos-bluetooth-inalambricos-D_NQ_NP_614476-MCO31129851345_062019-F.jpg');

ROUTER 
MIKROTIK
3 Puertos Ethernet 10/100 2.4Ghz AP
200
10
https://www.opirata.com/images/router-mikrotik-RB931-2nD-1.jpg

Audífonos 
SAMSUNG
Bluetooth Inalámbricos 
200
16
https://http2.mlstatic.com/audifonos-bluetooth-inalambricos-D_NQ_NP_614476-MCO31129851345_062019-F.jpg
