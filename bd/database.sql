CREATE DATABASE bebook;

create table zip_code (
    zip varchar(8) primary key,
    region varchar(30)
);

create table publisher (
    id_pub int auto_increment primary key,
    name varchar(30) unique
);

create table gender (
    id_gender int auto_increment primary key,
    name varchar(30),
    pic varchar(30)
);

create table users (
    id_user int auto_increment primary key,
    name varchar(30) not null,
    email varchar(30) not null unique,
    password varchar(30) not null,
    u_type int not null default '1',
    zip varchar(30),
    address varchar(70),
    contact varchar(15),
    stat int default '1',
    borndate date DEFAULT '2001-01-01',
    pic varchar(30) DEFAULT 'img/defaultpic.png',
    foreign key(zip) REFERENCES zip_code(zip)
);

create table author (
    id_author int auto_increment primary key,
    name varchar(30) not null,
    bio varchar(255),
    pic varchar(30)
);

create table book (
    id_book int auto_increment primary key,
    name varchar(30) not null,
    sinopse varchar(255),
    pbl_date varchar(30),
    price float not null,
    ISBN varchar(15),
    stat int default '1',
    id_pub int,
    pic varchar(30),
    foreign key(id_pub) REFERENCES publisher(id_pub)
);

;

create table book_author (
    id_author int,
    id_book int,
    primary key(id_author, id_book),
    foreign key(id_author) REFERENCES author(id_author),
    foreign key(id_book) REFERENCES book(id_book)
);

create table book_user (
    id_user int,
    id_book int,
    primary key(id_user, id_book),
    foreign key(id_user) REFERENCES users(id_user),
    foreign key(id_book) REFERENCES book(id_book)
);

create table book_gender (
    id_book int,
    id_gender int,
    primary key(id_book, id_gender),
    foreign key(id_gender) REFERENCES gender(id_gender),
    foreign key(id_book) REFERENCES book(id_book)
);

create table orders (
    id_order int auto_increment,
    o_date date not null,
    id_user int,
    stat int default '1',
    total float not null,
    foreign key(id_user) REFERENCES users(id_user),
    primary key(id_order)
);

create table order_d (
    id_order int not null,
    id_book int not null,
    price float not null,
    foreign key(id_book) REFERENCES book(id_book),
    foreign key(id_order) REFERENCES orders(id_order),
    primary key(id_order, id_book)
);


INSERT INTO
    users(name, email, password, u_type)
VALUES
    ('admin', 'admin@email.com', 'Test1234$', 0);

INSERT INTO
    users(name, email, password, u_type)
VALUES
    ('pessoa', 'pessoa@email.com', 'Test1234$', 1);

INSERT INTO
    gender(name, pic)
VALUES
    ('Aventura', 'img/adventure.jpg');

INSERT INTO
    gender(name, pic)
VALUES
    ('Fantasia', 'img/fantasy.jpg');

INSERT INTO
    gender(name, pic)
VALUES
    ('Romance', 'img/romance.jpg');

INSERT INTO
    gender(name, pic)
VALUES
    ('Terror', 'img/terror.jpg');

INSERT INTO
    Author(name, bio, pic)
VALUES
    (
        'Escritor 1',
        'Escritor 1, é um roteirista e escritor de ficção científica, terror e fantasia norte-americano.
          É mais conhecido por escrever a série de livros de fantasia épica As Crônicas de Gelo e Fogo.',
        'img/martin.webp'
    );

INSERT INTO
    Author(name, bio, pic)
VALUES
    (
        'escritora 2',
        'escritora 2 é roteirista e produtora cinematográfica britânica, notória por escrever a série de livros Harry Potter. ',
        'img/jk.webp'
    );

INSERT INTO
    publisher(name)
VALUES
    ('Fuga');

INSERT INTO
    publisher(name)
VALUES
    ('Webleitura');

INSERT INTO
    publisher(name)
VALUES
    ('e-reading');

INSERT INTO
    book(
        name,
        pbl_date,
        price,
        ISBN,
        id_pub,
        pic,
        sinopse
    )
VALUES
    (
        'A Furia Dos Reis',
        2022 -04 -12,
        20.99,
        678567890,
        1,
        'img/furia_reis.jpg',
        'Eddard Stark só aceitou o prestigiado cargo de Mão do Rei para proteger o rei... ou não suspeitasse que o anterior detentor desse título fora mandado assassinar pela rainha.'
    );

INSERT INTO
    book(
        name,
        pbl_date,
        price,
        ISBN,
        id_pub,
        pic,
        sinopse
    )
VALUES
    (
        'Muralha de gelo',
        2022 -04 -13,
        21.99,
        678567890,
        1,
        'img/m_gelo.jpg',
        'Fire & Blood é um livro escrito por George R. R. Martin que serve como uma prequela dos eventos ocorridos na série literária A Song of Ice and Fire.'
    );

INSERT INTO
    book(
        name,
        pbl_date,
        price,
        ISBN,
        id_pub,
        pic,
        sinopse
    )
VALUES
    (
        'Sangue e fogo',
        2022 -04 -15,
        22.99,
        678567890,
        1,
        'img/sangue_fogo.jpg',
        'A Clash of Kings é o segundo livro da série de fantasia épica As Crônicas de Gelo e Fogo, escrita pelo norte-americano George R. R. Martin e publicada pela editora Bantam Spectra.'
    );

INSERT INTO
    book_author(id_book, id_author)
VALUES
    (1, 1);

INSERT INTO
    book_author(id_book, id_author)
VALUES
    (2, 2);

INSERT INTO
    book_author(id_book, id_author)
VALUES
    (3, 1);

INSERT INTO
    book_author(id_book, id_author)
VALUES
    (3, 2);

INSERT INTO
    book_gender(id_book, id_gender)
VALUES
    (1, 1);

INSERT INTO
    book_gender(id_book, id_gender)
VALUES
    (1, 2);

INSERT INTO
    book_gender(id_book, id_gender)
VALUES
    (1, 3);

INSERT INTO
    book_gender(id_book, id_gender)
VALUES
    (2, 1);

INSERT INTO
    book_gender(id_book, id_gender)
VALUES
    (2, 2);

INSERT INTO
    book_gender(id_book, id_gender)
VALUES
    (3, 3);

INSERT INTO
    orders(o_date, id_user, total)
VALUES
    ("2012-12-12", 1, 80.00);

INSERT INTO
    orders(o_date, id_user, total)
VALUES
    ("2013-10-13", 2, 59.99);

INSERT INTO
    orders(o_date, id_user, total)
VALUES
    ("2014-05-09", 2, 100.00);

INSERT INTO
    order_d(id_order, id_book, price)
VALUES
    (1, 3, 20.00);

INSERT INTO
    order_d(id_order, id_book, price)
VALUES
    (2, 2, 59.99);

INSERT INTO
    order_d(id_order, id_book, price)
VALUES
    (3, 3, 20.00);

INSERT INTO
    order_d(id_order, id_book, price)
VALUES
    (3, 2, 60.00);