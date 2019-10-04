use reference;
create table reference.users
(
    user_id  int(11) auto_increment  NOT NULL PRIMARY KEY UNIQUE,
    password varchar(255)            NOT NULL,
    login    varchar(255)            NOT NULL UNIQUE,
    hash     varchar(255) default '' NOT NULL,
    constraint users_phone_id_uindex
        unique (user_id)
);


create table reference.phone_book
(
    phone_id     int auto_increment,
    phone_number varchar(255) null,
    first_name   varchar(255) null,
    second_name  varchar(255) null,
    email        varchar(255) null,
    photo        varchar(255) null,
    user_id      int          NOT NULL,
    foreign key (user_id) references users(user_id) on delete cascade,
    constraint phone_book_phone_id_uindex
        unique (phone_id)
);

alter table reference.phone_book
    add primary key (phone_id);

