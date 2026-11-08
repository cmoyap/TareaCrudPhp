create table if not exists clients (
    id serial primary key,
    name varchar(120) not null,
    address varchar(255) null,
    email varchar(120) not null unique,
    phone varchar(20) null,
    born_date date null,
    created_at timestamp not null default current_timestamp
);
