-- Dentistas
CREATE TABLE IF NOT EXISTS dentistas (
  id INT NOT NULL AUTO_INCREMENT,
  nome VARCHAR(256) NOT NULL,
  especialidade VARCHAR(50) NOT NULL,
  imagem VARCHAR(256) DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


INSERT INTO dentistas (nome, especialidade, imagem) VALUES
('Dr. Afonso Nunes', 'Ortodontia', 'imgs/dentistas/afonso.jpeg'),
('Dra. Diana Figueiredo', 'Ortodontia', 'imgs/dentistas/diana.jpeg'),
('Dra. Rita Vinagreiro', 'Odontopediatria', 'imgs/dentistas/rita.jpeg'),
('Dra. Iara Gomes', 'Estética', 'imgs/dentistas/iara.jpeg'),
('Dra. Ana Silva', 'Periodontia', 'imgs/dentistas/ana.jpeg'),
('Dr. Mateus Afonso', 'Odontopediatria', 'imgs/dentistas/mateus.jpeg'),;
('Dr. Rodrigo Ferrão', 'Implantes', 'imgs/dentistas/rodrigo.jpeg'),
('Dr. Tomás Moreira', 'Endodontia', 'imgs/dentistas/tomas.jpeg'),
('Dr. Martim Ferreira', 'Cirurgia Oral', 'imgs/dentistas/martim.jpeg');

-- Utentes
CREATE TABLE IF NOT EXISTS utentes (
  id INT NOT NULL AUTO_INCREMENT,
  email VARCHAR(128) NOT NULL,
  password VARCHAR(255) NOT NULL,
  nome VARCHAR(128) NOT NULL,
  apelido VARCHAR(128) NOT NULL,
  telefone VARCHAR(128) NOT NULL,
  data_nascimento DATE NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


INSERT INTO utentes (email, password, nome, apelido, telefone, data_nascimento) VALUES
('miguelrocha@email.com', '123', 'Miguel', 'Rocha', '900000001', '1985-07-22'),
('carlamartins@email.com', '1234', 'Carla', 'Martins', '900000002', '1992-11-30'),
('joaopereira@email.com', '12345', 'João', 'Pereira', '900000003', '1988-01-05');

--Consultas
CREATE TABLE IF NOT EXISTS consultas (
  id INT NOT NULL AUTO_INCREMENT,
  utente_id INT NOT NULL,
  dentista_id INT NULL,
  tratamento VARCHAR(120) NOT NULL,
  clinica VARCHAR(30) NOT NULL,
  data_hora DATETIME NOT NULL,
  estado ENUM('agendada','realizada','cancelada') NOT NULL DEFAULT 'agendada',
  motivo TEXT NULL,
  resultado TEXT NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  KEY idx_utente_data (utente_id, data_hora),
  CONSTRAINT fk_consultas_utente FOREIGN KEY (utente_id) REFERENCES utentes(id) ON DELETE CASCADE,
  CONSTRAINT fk_consultas_dentista FOREIGN KEY (dentista_id) REFERENCES dentistas(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;



INSERT INTO consultas (utente_id, dentista_id, tratamento, clinica, data_hora, estado, motivo, resultado) VALUES
(1, NULL, 'Check-up & Higiene oral', 'porto',  '2025-11-10 10:30:00', 'realizada', 'Limpeza e avaliação', 'Sem cáries ativas. Recomendado uso de fio dentário diário.'),
(1, 2, 'Ortodontia','porto',  '2026-01-12 15:00:00', 'agendada',  'Avaliação aparelho', NULL),
(1, 8, 'Endodontia', 'lisboa', '2025-10-02 09:00:00', 'realizada', 'Dor no molar', 'Tratamento de canal concluído. Medicação analgésica 48h.');
(2, 4, 'Estética', 'coimbra',  '2025-10-10 11:30:00', 'realizada', 'Melhorar estética do sorriso', NULL),


-- Avaliacoes
CREATE TABLE IF NOT EXISTS avaliacoes (
  id INT NOT NULL AUTO_INCREMENT,
  utente_id INT NOT NULL,
  consulta_id INT NOT NULL,
  rating TINYINT NOT NULL,
  comentario TEXT NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  UNIQUE KEY uq_avaliacao_consulta (consulta_id),
  KEY idx_avaliacoes_utente (utente_id),
  CONSTRAINT fk_avaliacoes_utente FOREIGN KEY (utente_id) REFERENCES utentes(id) ON DELETE CASCADE,
  CONSTRAINT fk_avaliacoes_consulta FOREIGN KEY (consulta_id) REFERENCES consultas(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
