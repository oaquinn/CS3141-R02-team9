delimiter //
# This function is designed to be used by the Database admin to make users admins of the website.
create procedure makeAdmin ( in temp_email varchar(100) ) 
	begin
    UPDATE user SET admin = 1 WHERE email = temp_email;
    end; //
    
delimiter ;

# Table of users. PK -  email, password is hash encrypted
create table user(
	email varchar(100) primary key,
    passwd char(64) not null,
    admin int default 0
);

