create table users
	(		id            		int AUTO_INCREMENT,
      name           		varchar(30) NOT NULL,
      email           	varchar(30) NOT NULL,
	 		password           	varchar(30) NOT NULL,
      phone			varchar(15) NOT NULL,
	 		type				varchar(10) NOT NULL,
			dept       varchar(10) DEFAULT 'Finance',
	 primary key (id)

	);


create table application
	(ap_id            	int AUTO_INCREMENT,
      subject           	varchar(30) NOT NULL,
	 description           varchar(10000) NOT NULL,
      user_id           	int NOT NULL,
	 days           		numeric(4,0) NOT NULL,
	 status			varchar(30) NOT NULL,
      
	 primary key (ap_id),
	 foreign key (user_id) references users (id)
		on delete cascade


	);

