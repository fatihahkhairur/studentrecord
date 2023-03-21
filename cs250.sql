-- reset everything
-- drop the cs250 database
drop database if exists cs250;

-- and to create a new one
create database if not exists cs250;

-- use cs250 database
use cs250;

-- create prof table
create table prof(
	pid char(20),
	name char(20),
	dept char(20),
	rank char(20),
	sal integer,
	primary key (pid)
);

-- add some data into prof
insert into prof values ('p1', 'Adam', 'CS', 'asst', '6000');
insert into prof values ('p2','Bob','EE','asso','8000');
insert into prof values ('p3','Calvin','CS','full','10000');
insert into prof values ('p4','Dorothy','EE','asst','5000');
insert into prof values ('p5','Emily','EE','asso','8500');
insert into prof values ('p6','Frank','CS','full','9000');


-- create teach table
create table teach (
	pid char(20),
	cid char(20),
	year integer,
	primary key (pid, cid, year),
--	foreign key (pid) references prof (pid) on delete cascade
	foreign key (pid) references prof (pid) on delete cascade on update cascade
);

-- add some data into table
insert into teach values ('p1','c1',2011);
insert into teach values ('p2','c2',2012);
insert into teach values ('p1','c2',2012);

-- create dept table
create table dept (
	DeptNo integer not null,
	Name char(20) not null,
	Budget integer not null,
	primary key (DeptNo)
);

-- create employee table, demonstrate foreign key
create table employee (
	EmpNo integer not null,
	LastName char(20) not null,
	FirstName char(20) not null,
	DeptNo integer not null,
	MgrNo integer not null,
	primary key ( EmpNo ),
	foreign key (DeptNo) references dept (DeptNo)
--	foreign key (MgrNo) references employee (EmpNo)
);


create table a (x int, y char(5));
create table b (x int, y char(5));
insert into a values (1,'A');
insert into a values (2,'B');
insert into a values (3,'C');
insert into a values (4,'D');
insert into b values (1,'A');
insert into b values (3,'C');


create table c (y char(5), x int);
create table d (x int);

insert into c values ('A', 1);
insert into c values ('A', 2);
insert into c values ('A', 3);
insert into c values ('B', 1);
insert into c values ('B', 2);
insert into c values ('C', 3);
insert into c values ('D', 3);
insert into c values ('D', 1);
insert into c values ('D', 2);

insert into d values (1);
insert into d values (2);
insert into d values (3);

