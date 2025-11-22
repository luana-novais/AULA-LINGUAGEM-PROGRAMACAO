create database sistema_agricola;

-- RF1: Cadastro de Culturas
CREATE TABLE culturas(
    id_cultura INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL,
    tipo_cultivo VARCHAR(50),
    ciclo_dias INT,
    descricao TEXT,
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- RF2: Cadastro de Áreas
CREATE TABLE areas(
    id_area INT AUTO_INCREMENT PRIMARY KEY,
    nome_talhao VARCHAR(100) NOT NULL,
    tamanho_hectares DECIMAL(10,2) NOT NULL,
    coordenadas VARCHAR(100),
    tipo_solo VARCHAR(50)
);

-- RF3: Cadastro de Insumos
CREATE TABLE insumos(
    id_insumo INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    tipo VARCHAR(50),
    unidade_medida VARCHAR(20),
    estoque_atual DECIMAL(10,2),
    valor_unitario DECIMAL(10,2)
);

-- RF4: Registro de Atividade de Campo
CREATE TABLE atividades (
    id_atividade INT AUTO_INCREMENT PRIMARY KEY,
    data_hora DATETIME NOT NULL,
    tipo_atividade VARCHAR(100) NOT NULL,
    quantidade_aplicada DECIMAL(10,2),
    observacoes TEXT,
    
    -- FKs
    id_cultura INT NOT NULL,
    id_area INT NOT NULL,
    id_insumo INT,
    
    FOREIGN KEY (id_cultura) REFERENCES culturas(id_cultura),
    FOREIGN KEY (id_area) REFERENCES areas(id_area),
    FOREIGN KEY (id_insumo) REFERENCES insumos(id_insumo)
);

-- Tabela de Usuários 
CREATE TABLE usuario (
    id INT NOT NULL AUTO_INCREMENT,
    email VARCHAR(255) NOT NULL,
    nome VARCHAR(255) NOT NULL,
    senha TEXT NOT NULL,
    PRIMARY KEY (id)
);