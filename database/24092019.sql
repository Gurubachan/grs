
create table tbl_user_type
(
  id int auto_increment primary key ,
  utype varchar(20) unique not null ,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `entryby` int(11) DEFAULT NULL,
  `updatedby` int(11) DEFAULT NULL,
  `isactive` tinyint(1) DEFAULT '1'
);

create table tbl_user
(
  id int auto_increment primary key ,
  name varchar(50) not null ,
  emailid varchar(50) not null unique ,
  contact varchar(10) unique ,
  usertype int not null ,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `entryby` int(11) DEFAULT NULL,
  `updatedby` int(11) DEFAULT NULL,
  `isactive` tinyint(1) DEFAULT '1',
  foreign key (usertype) references tbl_user_type(id) on delete restrict on update cascade
);

create table tbl_auth
(
  id int auto_increment primary key ,
  password varchar(100) not null,
  userid int not null ,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `entryby` int(11) DEFAULT NULL,
  `updatedby` int(11) DEFAULT NULL,
  `isactive` tinyint(1) DEFAULT '1',
  foreign key (userid) references tbl_user(id) on delete restrict on update cascade ,
  foreign key (entryby) references tbl_user(id) on delete restrict on update cascade ,
  foreign key (updatedby) references tbl_user(id) on delete restrict on update cascade
);
