create database sistema_agricola;

create table culturas(
id int auto_increment primary key,
nome varchar(50) not null,
tipo varchar(50) not null,
data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP);
 
create table areas(
id int auto_increment primary key,
nome VARCHAR(100) NOT NULL,
tamanho DECIMAL(10,2),
localizacao VARCHAR(100));

create table insumos(
id INT AUTO_INCREMENT PRIMARY KEY,
nome VARCHAR(100) NOT NULL,
tipo VARCHAR(50),
quantidade DECIMAL(10,2));

CREATE TABLE atividades (
id INT AUTO_INCREMENT PRIMARY KEY,
cultura_id INT,
area_id INT,
insumo_id INT,
descricao TEXT,
data DATETIME,
FOREIGN KEY (cultura_id) REFERENCES culturas(id),
FOREIGN KEY (area_id) REFERENCES areas(id),
FOREIGN KEY (insumo_id) REFERENCES insumos(id));
