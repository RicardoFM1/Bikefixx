

CREATE SCHEMA IF NOT EXISTS `bikefix` DEFAULT CHARACTER SET utf8mb4;
USE `bikefix`;

CREATE TABLE IF NOT EXISTS `bikefix`.`usuarios` (
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(150) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    perfil ENUM('admin', 'cliente', 'mecanico') NULL DEFAULT 'cliente',
	CONSTRAINT `chk_usuarios_perfil` CHECK (`perfil` = 'admin' OR `perfil` = 'cliente' OR `perfil` = 'mecanico'),
    INDEX idx_usuarios_nome (nome),
    INDEX idx_usuarios_email (email),
    INDEX idx_usuarios_id (id)
);


CREATE TABLE IF NOT EXISTS `bikefix`.`mecanicos` (
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	usuario_id INT NOT NULL UNIQUE,
    salario INT NOT NULL,
    carga_horaria INT NOT NULL,
    FOREIGN KEY (usuario_id)
    REFERENCES usuarios (id)
    ON UPDATE CASCADE
    ON DELETE CASCADE,
    INDEX idx_mecanicos_salario (salario),
    INDEX idx_mecanicos_id (id)
);


CREATE TABLE IF NOT EXISTS `bikefix`.`enderecos` (
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    rua VARCHAR(150),
    logradouro VARCHAR(150),
    numero VARCHAR(150),
    bairro VARCHAR(150),
    cidade VARCHAR(150)
);

CREATE TABLE IF NOT EXISTS `bikefix`.`clientes` (
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    usuario_id INT NOT NULL,
    data_de_nascimento DATE,
    endereco_id INT NOT NULL,
    FOREIGN KEY (usuario_id)
    REFERENCES usuarios (id)
    ON UPDATE CASCADE
    ON DELETE CASCADE,
    FOREIGN KEY (endereco_id)
	REFERENCES enderecos (id)
    ON UPDATE RESTRICT
    ON DELETE RESTRICT,
    INDEX idx_clientes_data_de_nascimento (data_de_nascimento),
	INDEX idx_clientes_id (id)
);


CREATE TABLE IF NOT EXISTS `bikefix`.`marcas` (
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(150) NOT NULL,
    INDEX idx_marcas_nome (nome)
);


CREATE TABLE IF NOT EXISTS `bikefix`.`bicicletas` (
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    marca_id INT NOT NULL,
	cliente_id INT NOT NULL,
    modelo VARCHAR(150) NOT NULL,
    aro VARCHAR(20) NOT NULL,
    FOREIGN KEY (marca_id) REFERENCES marcas (id)
    ON UPDATE RESTRICT
    ON DELETE RESTRICT,
    FOREIGN KEY (cliente_id) REFERENCES clientes (id)
    ON UPDATE CASCADE
    ON DELETE CASCADE,
    INDEX idx_bicicletas_modelo (modelo),
	INDEX idx_bicicletas_id (id)
);


CREATE TABLE IF NOT EXISTS `bikefix`.`pecas` (
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(150) NOT NULL,
    preco INT NOT NULL,
    created_at DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_pecas_nome (nome),
    INDEX idx_pecas_preco (preco),
    INDEX idx_pecas_id (id)
);



CREATE TABLE IF NOT EXISTS `bikefix`.`ordens_de_servico` (
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    mecanico_id INT NOT NULL,
    bicicleta_id INT NOT NULL,
    status ENUM('aberta', 'em_andamento', 'concluida') NULL DEFAULT 'aberta',
	data_e_hora_abertura DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    data_e_hora_conclusao DATETIME NULL,
    FOREIGN KEY (mecanico_id) REFERENCES mecanicos (id)
    ON UPDATE CASCADE
    ON DELETE CASCADE,
    FOREIGN KEY (bicicleta_id) REFERENCES bicicletas (id)
    ON UPDATE CASCADE
    ON DELETE CASCADE,
    CONSTRAINT `chk_ordens_de_servico_status` CHECK (`status` = 'aberta' OR `status` = 'em_andamento' OR `status` = 'concluida'),
    INDEX idx_ordens_de_servico_status (status),
    INDEX idx_ordens_de_servico_id (id)
);


CREATE TABLE IF NOT EXISTS `bikefix`.`pecas_ordens_de_servico` (
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    peca_id INT NOT NULL,
    ordem_de_servico_id INT NOT NULL,
    quantidade INT NOT NULL,
    preco_unitario INT NOT NULL,
    preco_total INT NOT NULL,
    FOREIGN KEY (peca_id) REFERENCES pecas (id)
    ON UPDATE RESTRICT
    ON DELETE RESTRICT,
    FOREIGN KEY (ordem_de_servico_id) REFERENCES ordens_de_servico (id)
    ON UPDATE CASCADE
    ON DELETE CASCADE,
    INDEX idx_pecas_ordens_de_servico_id (id)
);


CREATE OR REPLACE VIEW view_ordens_de_servico AS
SELECT os.id, os.mecanico_id, os.bicicleta_id, os.status, os.data_e_hora_abertura, os.data_e_hora_conclusao,
p.nome as peca_nome, pos.quantidade, pos.preco_unitario, pos.preco_total 
FROM ordens_de_servico os
INNER JOIN pecas_ordens_de_servico pos ON pos.ordem_de_servico_id = os.id
INNER JOIN pecas p ON pos.peca_id = p.id







