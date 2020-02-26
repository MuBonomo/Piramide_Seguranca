-- SQLite
create table users(
    id_user INTEGER PRIMARY KEY AUTOINCREMENT,
    nome varchar(50) NOT NULL,
    user varchar(7) UNIQUE not null,
    senha varchar(100) not null
)