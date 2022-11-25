-- drop table com_trade;
-- drop table trade;
-- drop table contain;
-- drop table product;
-- drop table record;
-- drop table place;
-- drop table company;
-- drop table customer;
-- drop table flavor;


create table flavor 
	(flavor_ID             numeric(5,0),
          sour                     numeric(1,0),       
          balance               numeric(1,0),
          primary key (flavor_ID)
	) ENGINE=INNODB;

create table customer
	(cus_ID               numeric(5,0),
          cus_name          varchar(20),
          cus_password   varchar(20) NOT NULL,
          cus_phone       varchar(10),
          cus_address      varchar(50),
          cus_email          varchar(50) NOT NULL unique,
          primary key(cus_ID)
	) ENGINE=INNODB;

create table company
	(com_ID               numeric(5,0),
          com_name          varchar(20),
          com_password   varchar(20) NOT NULL,
          com_phone         varchar(10),
          com_address      varchar(50),
          com_email          varchar(50) NOT NULL unique,
          primary key (com_ID)
	) ENGINE=INNODB;

create table place
	(farm_ID        numeric(5,0),
	country         varchar(20),
	state     varchar(20) check (state in ('Africa', 'Europe', 'Asia', 'Oceania', 'North America', 'South America')),
	intro              varchar(500),
	primary key (farm_ID)
	) ENGINE=INNODB;

create table record
	(order_ID             numeric(16,0),
	  cus_ID                numeric(5,0),
	  total                numeric(6,0) check (total > 0),
	  statement            varchar(20),
	  primary key(order_ID),
	  foreign key(cus_ID) references customer(cus_ID)
	) ENGINE=INNODB;

create table product
	( product_ID   numeric(20,0),
    product_name varchar(20),
	com_ID        numeric(5,0),
	variety          varchar(20),
	look              varchar(800),
	year              numeric(4,0) check (year > 1701 and year < 2100),
	season         varchar(6) check (season in ('Fall', 'Winter', 'Spring', 'Summer')),
	flavor_ID      numeric(5,0),
	baking          numeric(1,0),
	price             numeric(6,0) check (price > 0),
	farm_ID        numeric(5,0),
	weight	  numeric(5,0),
	del       numeric(1,0) default '1',
	primary key (product_ID),
	foreign key (flavor_ID) references flavor(flavor_ID) on delete set null,
	foreign key (farm_ID) references place(farm_ID) on delete set null,
	foreign key (com_ID) references company(com_ID) on delete set null
	)ENGINE=INNODB;	

create table contain
	(cus_ID           numeric(5,0),
	product_ID         numeric(20,0),
	amount               numeric(5,0),
	primary key(cus_ID, product_ID),
	foreign key (cus_ID) references customer(cus_ID) on delete cascade,
	foreign key (product_ID) references product(product_ID) on delete cascade
	) ENGINE=INNODB;

create table trade
	(product_ID         numeric(20,0),
	order_ID             numeric(16,0),
	amount               numeric(6,0),
	primary key(product_ID,order_ID),
	foreign key (product_ID) references product(product_ID),
	foreign key (order_ID) references record(order_ID) on delete cascade
	) ENGINE=INNODB;


create table com_trade
	(order_ID	numeric(16,0),
	 com_ID	numeric(5,0),
	 statement  varchar(20) check (statement in ('processing', 'dilivering', 'completed')),	 
	 primary key(order_ID, com_ID),
 	 foreign key(com_ID) references company(com_ID),
 	 foreign key (order_ID) references record(order_ID) on delete cascade
) ENGINE=INNODB;

