-- SQLite
CREATE TABLE regpir
(
    id_piramide INTEGER PRIMARY KEY AUTOINCREMENT,
    data date not null,
    hora time not null,
    turno char(1) not null,
    nome varchar(50) not null,
    edv varchar(8) not null,
    funcao varchar(100) not null,
    evento_tipo varchar(30) not null,
    evento_natureza varchar(30) not null,
    evento_desc varchar(100) not null,
    equipamento varchar(30) not null,
    equipamento_desc varchar(100),
    colaborador varchar(20) not null,
    colaborador_desc varchar(50),
    local varchar(100),
    obs varchar(100),
    status varchar(20),
    hse varchar(200)
)