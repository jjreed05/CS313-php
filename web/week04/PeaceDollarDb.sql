drop table if exists cart, categories, details, images, login, orders, products;

create table categories(
    id serial primary key not null,
    category varchar(100) not null
);

create table images(
    id serial primary key not null,
    imgname text not null,
    img text not null 
);

create table products(
    id serial primary key not null,
    coinyear int,
    coinname varchar(100) not null,
    coinamount numeric,
    saleprice numeric,
    imageid int not null references images,
    categoryid int not null references categories
);

create table cart(
    id serial primary key not null,
    quantity int not null,
    time timestamp not null,
    productID int not null references products
);

create table orders(
    id serial primary key not null,
    firstName varchar(100) not null,
    lastName varchar(100) not null,
    street text not null,
    city varchar(100) not null,
    state varchar(100) not null,
    zip int not null,
    email varchar(100) not null,
    orderdate timestamp not null,
    ordership char(10)
);

create table details(
    id serial primary key not null,
    orderid int not null references orders,
    productid int not null references products
);

create table login(
    id serial primary key not null,
    userName varchar(50) not null,
    userPass varchar(50) not null
);

insert into categories (category) values ('Peace Dollar');

insert into images(imgname, img) values('MS63', 'pictures/Capture.JPG');

insert into products(coinyear, coinname, coinamount, saleprice, imageid, categoryid) values('1921', 'PCGS MS63', '1', '99.99', '1', '1');

insert into images(imgname, img) values('AU58', 'pictures/AU58.JPG');

insert into products(coinyear, coinname, coinamount, saleprice, imageid, categoryid) values('1921', 'PCGS AU58', '1', '49.99', '2', '1');

insert into categories (category) values ('Nickel');

insert into images(imgname, img) values('PR66', 'pictures/PR66.JPG');

insert into products(coinyear, coinname, coinamount, saleprice, imageid, categoryid) values('1942', 'PCGS PR66', '0.05', '99.99', '3', '2');

insert into categories (category) values ('Liberty Gold');

insert into images(imgname, img) values('MS62', 'pictures/MS62.JPG');

insert into products(coinyear, coinname, coinamount, saleprice, imageid, categoryid) values('1906', 'PCGS MS62', '2.50', '99.99', '4', '3');

insert into categories (category) values ('Penny');

insert into images(imgname, img) values('MS67', 'pictures/MS67.JPG');

insert into products(coinyear, coinname, coinamount, saleprice, imageid, categoryid) values('1943', 'PCGS MS67', '0.01', '99.99', '5', '4');

insert into categories (category) values ('Dime');

insert into images(imgname, img) values('XF45', 'pictures/XF45.JPG');

insert into products(coinyear, coinname, coinamount, saleprice, imageid, categoryid) values('1911', 'PCGS XF45', '0.10', '99.99', '6', '5');

insert into login(userName, userPass) values ('Admin', 'LargeStar684MilkyWay');



