drop table tbl_grievance_action;
create table tbl_grievance_action
(
    id int auto_increment primary key ,
    forwardto varchar(50),
    letterdate date,
    letterlink varchar(255),
    remark text,
    entryby int,
    createdat timestamp default current_timestamp,
    updatedby int,
    updatedat timestamp default current_timestamp on update current_timestamp,
    isactive boolean default true,
    grievenceid int not null ,
    foreign key (grievenceid) references tbl_grievence(id) on update cascade on DELETE restrict ,
    foreign key (entryby) references tbl_user(id) on update cascade on delete restrict ,
    foreign key (updatedby) references tbl_user(id) on update cascade on delete restrict
);
