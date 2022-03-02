drop Procedure makeAdmin;
drop Procedure auth;
drop Procedure checkEmail;
drop Procedure registerUser;

delimiter //
# This function is designed to be used by the Database admin to make users admins of the website.
create procedure makeAdmin ( in temp_email varchar(100) ) 
	begin
    UPDATE user SET admin = 1 WHERE email = temp_email;
    end; //

create procedure auth (
	in temp_email varchar(100),
    in temp_password varchar(100)
	)
    begin
    SELECT COUNT(*) FROM user WHERE email = temp_email AND passwd = SHA2(temp_password, 256);
    end; // 
    
create procedure checkEmail( in temp_email varchar(100) ) 
	begin
    SELECT COUNT(*) FROM user WHERE email = temp_email;
    end; //
    
create procedure registerUser (
	in temp_email varchar(100),
    in temp_password varchar(100)
    )
    begin 
    INSERT INTO user VALUES (temp_email, NULL, SHA2(temp_password, 256), 0);
    end; //

delimiter ;
drop table user;
# Table of users. PK -  email, password is hash encrypted
create table user(
	email varchar(100) primary key,
    username varchar(20),
    passwd char(64) not null,
    admin int default 0
);
