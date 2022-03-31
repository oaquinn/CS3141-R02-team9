delimiter //

create procedure userAuth (
	in temp_email varchar(100),
    in temp_password varchar(100)
	)
    begin
    SELECT COUNT(*) FROM user WHERE email = temp_email AND passwd = SHA2(temp_password, 256);
    end; // 
    
create procedure teacherAuth (
	in temp_email varchar(100),
    in temp_password varchar(100)
	)
    begin
    SELECT COUNT(*) FROM teacher WHERE email = temp_email AND passwd = SHA2(temp_password, 256);
    end; // 
    
create procedure checkUserEmail( in temp_email varchar(100) ) 
	begin
    SELECT COUNT(*) FROM user WHERE email = temp_email;
    end; //

create procedure checkTeacherEmail( in temp_email varchar(100) ) 
	begin
    SELECT COUNT(*) FROM teacher WHERE email = temp_email;
    end; //
create procedure registerUser (
	in temp_email varchar(100),
    in temp_password varchar(100)
    )
    begin 
    INSERT INTO user VALUES (temp_email, NULL, SHA2(temp_password, 256), 0);
    end; //

create procedure registerTeacher (
	in temp_email varchar(100),
    in temp_password varchar(100)
    )
    begin 
    INSERT INTO teacher VALUES (temp_email, NULL, SHA2(temp_password, 256));
    end; //
    
delimiter ;

create table user(
	email varchar(100) primary key,
    username varchar(20),
    passwd char(64) not null,
    admin int default 0
    );

create table teacher(
	email varchar(100) primary key,
    username varchar(20),
    passwd char(64)
    );

create table course(
	CRN int auto_increment primary key,
    email varchar(100),
    name varchar(30) not null,
    foreign key (email) references teacher(email)
    );
    
create table assignment(
	CRN int,
    name varchar(20),
    duedate date not null,
    foreign key (CRN) references course(CRN),
    primary key(name, CRN)
    );

create table completed(
	CRN int primary key,
    name varchar(20),
    email varchar(100),
    foreign key (CRN) references course(CRN),
    foreign key (email) references user(email)
    );
    
create table takes(
	CRN int primary key,
    email varchar(100),
    foreign key (CRN) references course(CRN),
    foreign key (email) references user(email)
    );
    
create table teaches(
	CRN int primary key,
    email varchar(100),
    foreign key (CRN) references course(CRN),
    foreign key (email) references teacher(email)
    );
    */
    