
Create Table Rols 
(
   id       Serial Unique not null,
   nombre   Varchar(50) not null,
   created  Timestamp not null,
   modified Timestamp not null,

   Constraint PK_ROLS primary key (id)
);

Create Table Regions 
(
   id       Serial Unique not null,
   nombre   Varchar(50) not null,
   numero   Varchar(5) not null,
   created  Timestamp not null,
   modified Timestamp not null,

   Constraint PK_REGIONS primary key (id)
);

Create Table Comunas 
(
   id        Serial Unique not null,
   nombre    Varchar(50) not null,
   region_id Integer   not null,
   created   Timestamp not null,
   modified  Timestamp not null,

   Constraint PK_COMUNAS primary key (id),

   Constraint FK_COMUNAS_REFERENCE_REGIONS Foreign Key (region_id) references Regions (id)

);

Create Table Users
(
   id                   Serial Unique not null,
   rut                  Varchar(12) not null,
   nombre               Varchar(50) not null,
   apellido_paterno     Varchar(25) not null,
   apellido_materno     Varchar(25) not null,
   fecha_nacimiento     Date,
   email                Varchar(50) not null,
   username             Varchar(25) not null,
   password             Varchar(50) not null,
   telefono_fijo        Integer,
   telefono_movil       Integer,
   poblacion            Varchar(25),
   calle                Varchar(25),
   numero               Integer,
   cant_votos_positivos Integer not null default '0',
   cant_votos_negativos Integer not null default '0',
   estado               Boolean not null default true,
   img                  Bytea null,
   rol_id               Integer not null,
   region_id            Integer not null,
   comuna_id            Integer not null,
   local_id             Integer,
   created              Timestamp not null,
   modified             Timestamp not null,

   Constraint PK_USERS Primary Key (id),

   Constraint FK_USERS_REFERENCE_ROLS Foreign Key (rol_id) references Rols (id),
   Constraint FK_USERS_REFERENCE_REGIONS Foreign Key (region_id) references Regions (id),
   Constraint FK_USERS_REFERENCE_COMUNAS Foreign Key (comuna_id) references Comunas (id)
);

Create Table Sugerencias
(
   id       Serial Unique not null,
   texto    Varchar(500) not null,
   user_id  Integer not null,
   created  Timestamp not null,
   modified Timestamp not null,
   
   Constraint PK_SUGERENCIAS Primary Key (id),

   Constraint FK_SUGERENCIAS_REFERENCE_USERS Foreign Key (user_id) references Users (id)
);

Create Table Categoria_Productos
(
   id       Serial Unique not null,
   nombre   Varchar(25) not null,
   created  Timestamp not null,
   modified Timestamp not null,
   
   Constraint PK_CATEGORIA_PRODUCTOS Primary Key (id)
);

Create Table Productos
(
   id                    Serial Unique not null,
   nombre                Varchar(30) not null,
   categoria_producto_id Integer not null,
   user_id               Integer not null,
   created               Timestamp not null,
   modified              Timestamp not null,

   Constraint PK_PRODUCTOS Primary Key (id),

   Constraint FK_PRODUCTOS_REFERENCE_CATEGORIA_PRODUCTOS Foreign Key (categoria_producto_id) references Categoria_Productos (id),
   Constraint FK_PRODUCTOS_REFERENCE_USERS Foreign Key (user_id) references Users (id)
);

Create Table Categoria_Locals
(
   id       Serial Unique not null,
   nombre   Varchar(25) not null,
   created  Timestamp not null,
   modified Timestamp not null,

   Constraint PK_CATEGORIA_LOCALS Primary Key (id)
);

Create Table Locals
(
   id                 Serial Unique not null,
   nombre             Varchar(30) not null,
   calle              Varchar(25) not null,
   numero             Integer not null,
   telefono_fijo      Integer,
   telefono_movil     Integer,
   email              Varchar(50),
   sitio_web          Varchar(50),
   estado             Boolean not null default true,
   img                Bytea null,
   categoria_local_id Integer not null,
   user_id            Integer not null,
   region_id          Integer not null,
   comuna_id          Integer not null,
   created            Timestamp not null,
   modified           Timestamp not null,

   Constraint PK_LOCALS Primary Key (id),

   Constraint FK_LOCALS_REFERENCE_CATEGORIA_LOCALS Foreign Key (categoria_local_id) references Categoria_Locals (id),
   Constraint FK_LOCALS_REFERENCE_USERS Foreign Key (user_id) references Users (id),
   Constraint FK_LOCALS_REFERENCE_REGIONS Foreign Key (region_id) references Regions (id),
   Constraint FK_LOCALS_REFERENCE_COMUNAS Foreign Key (comuna_id) references Comunas (id)
);

Create Table Comentarios
(
   id                   Serial Unique not null,
   texto                Varchar(250) not null,
   cant_votos_positivos Integer not null default '0',
   cant_votos_negativos Integer not null default '0',
   user_id              Integer not null,
   local_id             Integer not null,
   created              Timestamp not null,
   modified             Timestamp not null,

   Constraint PK_COMENTARIOS Primary Key (id),

   Constraint FK_COMENTARIOS_REFERENCE_USERS Foreign Key (user_id) references Users (id),
   Constraint FK_COMENTARIOS_REFERENCE_LOCALS Foreign Key (local_id) references Locals (id)
);

Create Table Ofertas
(
   id          Serial Unique not null,
   precio      Integer,
   descripcion Varchar(500) not null,
   user_id     Integer not null,
   producto_id Integer not null,
   local_id    Integer not null,
   created     Timestamp not null,
   modified    Timestamp not null,

   Constraint PK_OFERTAS Primary Key (id),

   Constraint FK_OFERTAS_REFERENCE_USERS Foreign Key (user_id) references Users (id),
   Constraint FK_OFERTAS_REFERENCE_PRODUCTOS Foreign Key (producto_id) references Productos (id),
   Constraint FK_OFERTAS_REFERENCE_LOCALS Foreign Key (local_id) references Locals (id)
);

Create Table Solicituds
( 
   id       Serial Unique not null,
   estado   Varchar(10) not null,
   sql      Varchar(1000) not null,
   accion   Varchar(10) not null,       
   tabla    Varchar(20) not null,
   campos   Varchar(1000) not null,
   user_id  Integer not null,
   admin_id Integer,
   created  Timestamp not null,
   modified Timestamp not null,

   Constraint PK_SOLICITUDS primary key (id),
   
   Constraint FK_SOLICITUDS_REFERENCE_USERS Foreign Key (user_id) references Users (id)
);

