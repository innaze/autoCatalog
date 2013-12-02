CREATE DATABASE IF NOT EXISTS autobase
DEFAULT CHARACTER SET utf8
DEFAULT COLLATE utf8_general_ci;

USE autobase;
DROP TABLE IF EXISTS auto;
DROP TABLE IF EXISTS body;
DROP TABLE IF EXISTS colors;
DROP TABLE IF EXISTS autocolor;

SET FOREIGN_KEY_CHECKS = 0;

CREATE TABLE auto (
   id INTEGER UNSIGNED PRIMARY KEY AUTO_INCREMENT,
   name VARCHAR(200) NOT NULL COMMENT 'Название',
   id_body INTEGER UNSIGNED NOT NULL COMMENT 'Тип кузова',
   description TEXT COMMENT 'Описание',
   price DECIMAL(10,2) UNSIGNED ZEROFILL NOT NULL COMMENT 'Цена',
  CONSTRAINT FK_auto_body FOREIGN KEY (id_body)
	REFERENCES body (id) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT 'Автомобили';

CREATE TABLE body (
   id INTEGER UNSIGNED PRIMARY KEY AUTO_INCREMENT,
   name VARCHAR(200) NOT NULL COMMENT 'Тип кузова'
)   ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT 'Кузова';

CREATE TABLE colors (
   id INTEGER UNSIGNED PRIMARY KEY AUTO_INCREMENT,
   name VARCHAR(50) NOT NULL COMMENT 'Цвет'
)   ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT 'Цвета';

CREATE TABLE autocolor (
   id_auto INTEGER UNSIGNED,
   id_color INTEGER UNSIGNED,
  CONSTRAINT FK_autocolor_auto FOREIGN KEY (id_auto)
	REFERENCES auto (id) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT FK_autocolor_color FOREIGN KEY (id_color)
	REFERENCES colors (id) ON DELETE RESTRICT ON UPDATE RESTRICT	
) ENGINE=InnoDB COMMENT 'Связь автомобиль-цвет';


INSERT INTO body (name) VALUES ('Автобус');
INSERT INTO body (name) VALUES ('Кабриолет');
INSERT INTO body (name) VALUES ('Внедорожник');
INSERT INTO body (name) VALUES ('Самосвал');
INSERT INTO body (name) VALUES ('Катафалк');
INSERT INTO body (name) VALUES ('Бетономешалка');
INSERT INTO body (name) VALUES ('Седан');
INSERT INTO body (name) VALUES ('Грузовик');

INSERT INTO colors (name) VALUES ('красный');
INSERT INTO colors (name) VALUES ('оранжевый');
INSERT INTO colors (name) VALUES ('желтый');
INSERT INTO colors (name) VALUES ('зеленый');
INSERT INTO colors (name) VALUES ('голубой');
INSERT INTO colors (name) VALUES ('синий');
INSERT INTO colors (name) VALUES ('фиолетовый');
INSERT INTO colors (name) VALUES ('серо-буро-малиновый');
INSERT INTO colors (name) VALUES ('ржавый');
INSERT INTO colors (name) VALUES ('серый');



INSERT INTO auto (name, id_body, description, price) VALUES ('Audi A4', 7, 'Музыка (система 9-1 девять колонок и внутр. сабвуфер и усилитель) 6 подушек безопасности...', 1530000.00);
INSERT INTO auto (name, id_body, description, price) VALUES ('Subaru Legacy',3,'Регулируемая рулевая колонка. Подогрев сидений. Электропривод стекол. Электропривод сидений. Круиз-контроль Датчик дождя. Датчик света. Мультифункциональное рулевое колесо. Обогрев боковых зеркал. Кондиционер. Климат-контроль', 1250500.00);
INSERT INTO auto (name, id_body, description, price) VALUES ('Cadillak SRX',1,'Система питания:бензин инж. Привод:полный. Руль:левый. Состояние:битый. Растаможен',177777.55);
INSERT INTO auto (name, id_body, description, price) VALUES ('Камаз',8,'Масса перевозимого груза, кг 7 100 Снаряженная масса, кг 14 295 Полная масса, кг 21 545 Распределение нагрузки от автомобиля полной массы На передний мост, кг 5 925 На заднюю тележку, кг 15 620 Двигатель Тип 740.30-260, дизельный с турбонаддувом, с промежуточным охлаждением наддувочного воздуха Мощность, л.с. 260 Система питания Вместимость топливного бака, л 350 + 210 Трансмиссия Коробка передач 154, механическая, десятиступенчатая Раздаточная коробка Механическая, двухступенчатая с блокируемым межосевым дифференциалом Внутренние размеры грузовой платформы Длина, мм 5 470 Ширина, мм 2 420 Высота, мм 600 Габаритные размеры автомобиля Длина, мм 8 900 Ширина, мм 2 500 Высота, мм, не более 4 000',3520000.00 );
INSERT INTO auto (name, id_body, description, price) VALUES ('BMW 318',5,'Кол-во дверей - 2, кол-во окон - 4, кол-во колес - 4, питание - бензин, состояние - убитый',30000.00);
INSERT INTO auto (name, id_body, description, price) VALUES ('Москвич 412',7,'Машина в хорошем состоянии. На ходу. Требуется регулировка карбюратора. Не эксплуатируется почти год. Салон не затертый, без трещин. Птс оригинал, отдам с номерами. Автомобиль для ценителей :)) Возможен торг! Звонить после 17:00 по Москве.',27000.00);
INSERT INTO auto (name, id_body, description, price) VALUES ('Opel Astra',7,'Антиблокировочная система (ABS), подушки безопасности: 4 и более, иммобилайзер, усилитель рулевого управления: гидро, кондиционер, центральный замок, электропривод: водительское сиденье',549000.00);

INSERT INTO autocolor VALUES (1,1);
INSERT INTO autocolor VALUES (1,7);
INSERT INTO autocolor VALUES (1,3);
INSERT INTO autocolor VALUES (2,3);
INSERT INTO autocolor VALUES (2,4);
INSERT INTO autocolor VALUES (3,1);
INSERT INTO autocolor VALUES (3,2);
INSERT INTO autocolor VALUES (3,4);
INSERT INTO autocolor VALUES (4,9);
INSERT INTO autocolor VALUES (4,2);
INSERT INTO autocolor VALUES (5,8);
INSERT INTO autocolor VALUES (6,1);
INSERT INTO autocolor VALUES (7,8);
INSERT INTO autocolor VALUES (7,10);



SET FOREIGN_KEY_CHECKS = 1;
