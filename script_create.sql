create table if not exists addresses
(
    address_id int auto_increment
        primary key,
    street     varchar(100) not null,
    number     varchar(20)  not null,
    complement varchar(100) null,
    zip_code   varchar(9)   not null,
    city       varchar(100) not null,
    state      varchar(45)  not null
);

create table if not exists contacts
(
    contact_id int auto_increment
        primary key,
    name       varchar(100) not null,
    email      varchar(100) not null,
    address_id int          not null,
    constraint contacts_FK
        foreign key (address_id) references addresses (address_id)
            on update cascade
);

create table if not exists phones
(
    phone_id   int auto_increment
        primary key,
    area_code  varchar(4)  not null,
    number     varchar(14) not null,
    contact_id int         not null,
    constraint phone_FK
        foreign key (contact_id) references contacts (contact_id)
);


