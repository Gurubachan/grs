create or replace table if not exists tbl_grievence_subtype
(
	id int auto_increment
		primary key,
	stname varchar(50) not null,
	tid int not null,
	created_at timestamp default current_timestamp() not null,
	updated_at datetime null on update current_timestamp(),
	entryby int null,
	updatedby int null,
	isactive tinyint(1) default 1 null,
	constraint stname
		unique (stname),
	constraint tbl_grievence_subtype_ibfk_1
		foreign key (tid) references tbl_grievence_type (id)
			on update cascade
);

create or replace index if not exists tid
	on tbl_grievence_subtype (tid);

create or replace table if not exists tbl_referances
(
	id int auto_increment
		primary key,
	referancename varchar(50) not null,
	created_at timestamp default current_timestamp() not null,
	updated_at datetime null on update current_timestamp(),
	entryby int null,
	updatedby int null,
	isactive tinyint(1) default 1 null,
	constraint referancename
		unique (referancename)
);

alter table tbl_grievence
	add pccode int null;

alter table tbl_grievence
	add accode int null;

alter table tbl_grievence
	add distcode int null;

alter table tbl_grievence
	add blockcode int null;

alter table tbl_grievence modify referanceno int null;
