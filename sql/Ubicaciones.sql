select * from LISTA_STOCK where ESTADO IS null


delete from LISTA_STOCK where ESTADO is null



select count(ItemCode) from OITM


create view Ubicacion_Null as 
select * from SAPHANA..DMI.UBICACION_NULL



select count(T1.ItemCode) from Articulos T1 
where T1.OnHand>0  and T1.


select * from Ubicacion_Null where WhsCode like 'LPZ001'
+
select * from users where Nombre like 'Da%'
select * from sucursals



select * from ARTICULOS_STOCK
+

-- List columns in all tables whose name is like 'TableName'
SELECT 
    TableName = tbl.TABLE_SCHEMA + '.' + tbl.TABLE_NAME, 
    ColumnName = col.COLUMN_NAME, 
    ColumnDataType = col.DATA_TYPE
FROM INFORMATION_SCHEMA.TABLES tbl
INNER JOIN INFORMATION_SCHEMA.COLUMNS col 
    ON col.TABLE_NAME = tbl.TABLE_NAME
    AND col.TABLE_SCHEMA = tbl.TABLE_SCHEMA

WHERE tbl.TABLE_TYPE = 'BASE TABLE' and tbl.TABLE_NAME like '%ARTICULOS_STOCK%'
GO


-- Insert rows into table 'TableName'
INSERT INTO ARTICULOS_STOCK
( -- columns to insert data into
 [LISTA_ID],[ITEMCODE], [DESCRIPCION], [COD_VENTA],[COD_COMPRA],[UBICACION_FISICA]
)
VALUES
( -- first row: values for the columns in the list above
 '12','011-00002', 'ROTOR VANE PARA MOTOSIERRA', '15COBP 359','15COBP 359-LEV',''
)
-- add more rows here
GO