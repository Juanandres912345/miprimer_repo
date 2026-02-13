Ñpedidos que ha realizado. Solo deben aparecer los clientes que tengan pedidos.*/

1)
select nombre, pedido_no, fecha_pedido
from clientes 
left outer join pedidos on clientes.cliente_no = pedidos.cliente_no
where pedido_no not like 'null';

2)
select nombre, pedido_no, fecha_pedido
from clientes 
inner join pedidos on clientes.cliente_no = pedidos.cliente_no
where pedido_no not like 'null';

/*2.  Lista todos los departamentos de la empresa y, si tienen empleados, muestra su
apellido. Deben aparecer todos los departamentos, aunque estén vacíos.*/

select dep.*, e.apellido
from departamentos dep
left outer join empleados e on dep.dep_no = e.dep_no;


/*3. Obtén el nombre de aquellos departamentos que actualmente no tienen ningún empleado
trabajando en ellos.*/ 

select dnombre, e.*
from departamentos dep
left outer join empleados e on dep.dep_no = e.dep_no
where emp_no is null;

/*4. Muestra el apellido de los empleados y el nombre de los clientes que tienen asignados
como "Vendedor No". Solo muestra empleados que efectivamente sean
vendedores de algún cliente.*/

select apellido,emp_no, nombre 
from empleados e
left outer join clientes c on e.emp_no = c.vendedor_no
where nombre not like 'null'

/*5. Muestra todos los clientes de la base de datos y el número de pedido de las compras que
hayan realizado. Los clientes que no han comprado deben aparecer también.*/

select c.* , pedido_no
from clientes c
left outer join pedidos p on c.cliente_no = p.cliente_no;


/* 6. Localiza el nombre y localidad de los clientes que nunca han realizado un pedido para
enviarles una oferta de bienvenida.*/

select nombre, localidad, pedido_no 
from clientes c
left outer join pedidos p on c.cliente_no = p.cliente_no
where pedido_no is null;

/* 7. Lista todos los productos (descripción) y las unidades vendidas en cada pedido. Deben
aparecer incluso los productos que no se han vendido nunca.*/ 

select pro.* ,unidades 
from productos pro
left outer join pedidos pe on pe.producto_no = pro.producto_no;

/*8.   Muestra la descripción de los productos que no aparecen en ninguna línea de pedido
(productos que no tienen salida).*/ 

select pro.* ,unidades 
from productos pro
left outer join pedidos pe on pe.producto_no = pro.producto_no
where unidades is null;