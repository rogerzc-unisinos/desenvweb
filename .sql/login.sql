CREATE TABLE login (
  Id int(11) NOT NULL,
  Usuario varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  Senha varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  DataCadastro timestamp NOT NULL DEFAULT current_timestamp(),
  TipoUsuario char(1) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO login (Id, Usuario, Senha, DataCadastro, TipoUsuario) VALUES
(1, 'admin', 'admin', '2021-09-23 02:14:08', '0'),
(2, 'funcionario', 'funcionario', '2021-09-23 04:21:46', '1');