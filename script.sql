-- Elimina la tabla si existe -- 
DROP DATABASE IF EXISTS dw3_torre_matias;
-- Crea la base de datos --
CREATE DATABASE dw3_torre_matias;
-- Selecciona --
USE dw3_torre_matias;
-- Usuarios --
CREATE TABLE user(
	id INT NOT NULL AUTO_INCREMENT,
    email VARCHAR(255) NOT NULL UNIQUE,
	password VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL,
    type ENUM('admin','user'),
    pic VARCHAR(255),
	PRIMARY KEY (ID)
);
-- Reservas de turnos --
CREATE TABLE reservation(
	id INT NOT NULL AUTO_INCREMENT,
    date DATETIME NOT NULL,
    hour VARCHAR(255),
    type ENUM('Corte','Baño', 'Baño y corte') NOT NULL,
    fk_user INT,
	PRIMARY KEY (id),
	FOREIGN KEY (fk_user) REFERENCES user(id)
);
-- Categorias de las noticias --
CREATE TABLE category( 
	id INT NOT NULL AUTO_INCREMENT,
	description VARCHAR(45) NOT NULL UNIQUE,
    PRIMARY KEY (id)
);
-- Noticias --
CREATE TABLE news(
    id INT NOT NULL AUTO_INCREMENT,
    date DATETIME NOT NULL,
    description TEXT,
    image VARCHAR(255),
    fk_category INT,
    title VARCHAR(255) NOT NULL,
    PRIMARY KEY (id),
	FOREIGN KEY (fk_category) REFERENCES category(id)
);
-- Comentarios --
CREATE TABLE comments (
  id INT NOT NULL AUTO_INCREMENT,
  fk_user INT NOT NULL,
  fk_new INT NOT NULL,
  content text NOT NULL,
  date DATETIME NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (fk_user) REFERENCES user(id),
  FOREIGN KEY (fk_new) REFERENCES news(id) ON DELETE CASCADE
);

-- Registros por default --
-- Categorias --
INSERT INTO category SET DESCRIPTION = 'Productos';
INSERT INTO category SET DESCRIPTION = 'Alimentos';
INSERT INTO category SET DESCRIPTION = 'Juguetes';
INSERT INTO category SET DESCRIPTION = 'Ropa';
INSERT INTO category SET DESCRIPTION = 'Accesorios';
-- Usuarios --
INSERT INTO user SET EMAIL ='mtorre4580@outlook.com', password = md5('123456'), name='Lester', pic='Lester.jpg', type='user';
INSERT INTO user SET EMAIL ='coty95@gmail.com', password = md5('123456'), name='Drako', pic='Drako.jpg', type='user';
INSERT INTO user SET EMAIL ='vero@davinci.com', password = md5('123456'), name='Sheila', pic='Sheila.jpg', type='user';
INSERT INTO user SET EMAIL ='santi87@davinci.com', password = md5('123456'), name='Negrito', pic='Negrito.jpg', type='user';
-- Usuarios Admin --
INSERT INTO user SET EMAIL ='admin@loqueelperrosellevo.com', password = md5('123456'), name='Tincho', type='admin';
INSERT INTO user SET EMAIL ='test@gmail.com', password = md5('123456'), name='Malfoy', type='admin';
-- Reservas del dia --
INSERT INTO reservation SET date = CURDATE(), hour = '9 - 11', fk_user = '1', type = 'Baño y corte' ;
INSERT INTO reservation SET date = CURDATE(), hour = '13 - 15', fk_user = '2', type = 'Baño' ;
INSERT INTO reservation SET date = CURDATE(), hour = '15 - 17', fk_user = '3', type = 'Corte' ;
INSERT INTO reservation SET date = CURDATE(), hour = '19 - 20:30', fk_user = '4', type = 'Baño y corte' ;
-- Noticias --
INSERT INTO news SET title = 'Descuentos para jubilados', date= NOW(), description= 'Porque los queremos y se merecen ayudarlos con todo lo que podamos, siempre pensamos en todo!',image = 'descuento_jubilados.jpg', fk_category = '5';
INSERT INTO news SET title = 'Mascota en adopción', date= NOW(), description= 'Estamos buscando una casa para este lindo perrito, esta vacunado desparasitado, cualquier duda no dudes en comunicarte con nosotros, tratemos de ayudar', image = 'perro_adopcion.jpg';
INSERT INTO news SET title = 'Nuevos juguetes trixie', date= NOW(), description= 'Juguete súper resistente para rellenar con golosinas caninas!!. Ideales para cuando te vas de casa y tu mascota queda sola. Calidad premium!! A prueba de golden retrievers!', image = 'juguete_trixie.jpg', fk_category='3';
INSERT INTO news SET title = 'Cepillos 2018', date= NOW(), description= 'Set de cepillos de diente!! Calidad premium. Tu mascota también merece cuidado dental.', image = 'cepillo.jpg', fk_category='1';
INSERT INTO news SET title = 'Visita de wanda', date= NOW(), description= 'A wanda le costó madrugar hoy. Ya está, bella, estás limpia y perfumada para recibir todos los mimos', image = 'visita_wanda.jpg';
INSERT INTO news SET title = 'Cámara oculta en los golden', date= NOW(), description= 'Chris y Nina Cardinal, padres de una niña de 15 meses llamada Chloe, han descubierto gracias a una cámara oculta cómo su hija conseguía escapar de su habitación. La pareja se había despertado en reiteradas ocasiones con la presencia de la pequeña Chloe en el pasillo y no entendía cómo era capaz de abrir el pomo de la puerta, midiendo menos de un metro de altura. Las imágenes de una cámara situada en el interior del cuarto han revelado que Chloe contaba en su huida con la colaboración de Colby y Bleu, los dos golden retrievers de la casa. Los perros de esta familia afincada en Phoenix, Estados Unidos, entraban a primera hora de la mañana en la habitación de la menor en busca del desayuno y la despertaban con lametones, dejando la puerta abierta.' , image = 'escape.jpg';
INSERT INTO news SET title='Una perra guía pare ocho cachorros en el aeropuerto de Tampa', date= NOW(), description='El aeropuerto de Tampa, en Florida, vivió la pasada semana un gran revuelo cuando una perra labrador de dos años se puso de parto, inesperadamente. El animal, un perro guía, se disponía a embarcar con sus dueñas, una mujer y su hija, en un avión que volaba a Filadelfia. Sabían que su perra estaba preñada, pero no creían que la llegada de los cachorros era inminente. La historia tuvo final feliz: la familia y sus perros perdieron el avión , pero pudieron viajar por carretera con los ocho cachorros en perfectas condiciones. El parto fue asistido en la misma puerta de embarque por dos miembros del equipo médico de los bomberos del aeropuerto, que difundieron su trabajo por Twitter con un buen número de fotografías, mientras numerosos pasajeros rodeaban a la parturienta y sacaban fotos con sus móviles.', image='perra_pariendo.jpg';
INSERT INTO news SET title='Aprovecha a comprar alimento', date=NOW(), description='La próxima semana aumentan los precios en royal canin, aprovecha a comprar esta semana' , fk_category = '2';
INSERT INTO news SET title = 'Ocho cosas que crees que le gustan a tu gato, pero no', date= NOW(), description= 'Un momento para el anecdotario: existe en Facebook una página llamada Perritos haciendo cosas que es, probablemente, lo mejor que le ha pasado a esa red social en años. Consiste en fotos de perros de todos los tamaños y razas en situaciones bastante particulares y con unos sencillos, pero lucidísimos, pies de foto que suben el invento a los altares del humor moderno. La página tiene casi dos millones de seguidores.
Existe también otra llamada Gatitos haciendo cosas. Repetir el invento con los verdaderos héroes de Internet parecía una apuesta segura, pero se quedó a medias. Solo unas 120.000 personas siguen a los gatitos. ¿Por qué? Porque un tipo de humor que juega con la expresividad y sus relecturas se da de bruces contra la realidad de los gatos: su gracia consiste en que son inexpresivos, indolentes y casi inalterables. Sirven para expresar cientos de emociones, pero posiblemente ninguna de ellas sirve para construir un relato de ternura ni de humor cálido.
Esto es lo que amamos los que convivimos con gatos, pero también lo que a veces nos vuelve locos a la hora de entenderlos. Por eso, y siguiendo la estela de este artículo sobre perros que publicamos en ICON, repasamos una serie de cosas que solemos hacer con nuestros gatos pensando en que les agradan y, a menudo, solo les causan confusión y disgusto. Ojo, esto no se aplica a todos los gatos. Puede que tú conozcas a uno de esos ejemplares extraños a los que, por ejemplo, les encanta el agua. Hay gatos para todo. ', image = 'durmiendo.jpg';
INSERT INTO news SET title = '¿Perro, gato, pez o hámster? Cuál es la mascota ideal para tu hogar', date= NOW(), description= 'La mayoría de los Argentinos tiene un animal doméstico en su casa -según una encuesta de 2016 de GfK Group- y, aunque mundialmente los felinos llevan la delantera (sí, los gatos predominan en los hogares europeos, por ejemplo), los argentinos somos fans de los perros.
Entre los de "raza", el bulldog francés, inglés y el ovejero alemán son los más elegidos; hace un tiempo estaban de moda los caniches y los dachshund (“perro salchicha”), pero esa tendencia cambió. Las campañas proteccionistas, a su vez, buscan que se adopten perros de la calle en lugar de perros de criaderos. ¿Hay una mascota para cada tipo de persona? ¿Qué relación hay con el tipo de espacio del que dispongamos y la cantidad de tiempo que le podamos dedicar? Estas son algunas variables a tener en cuenta a la hora de pensar en adoptar un animal doméstico.
Esos mágicos felinos
La mascota ideal, ¿es la que aparece en un momento clave de la vida? Caro (32) vive con su gata ("Beata Ninja") y su gato ("Plúmbico") en Caballito: “Una vez tuve una conversación con un veterinario, en donde decíamos que los animales son un regalo de la vida. Y algo cambia profundamente cada vez que aparecen: la vida da un giro. Ellos vienen en momentos especiales: cuando llega un hijo, en rupturas de pareja, cuando una chico necesita abrirse al mundo, ellos tienen una función que cumplir con nosotros.
Encontró a sus gatos en Parque Centenario, un lugar donde suelen ofrecer animales en adopción. “A Plúmbico me lo llevé a mi casa porque se estaba muriendo de una infección. Con amor y medicamentos se le fue, aunque perdió un ojo. Me mira y nos entendemos, nos comunicamos perfecto, es un gato sanador que se da cuenta cuando alguien tiene algún dolor', image = 'perro_gato.jpg';
INSERT INTO news SET title = 'Tecnología y moda, en una expo para fanáticos de los perros', date= NOW(), description= 'La tecnología es hoy es una aliada para el cuidado de las mascotas: chapas con tecnología QR para localizar a las mascotas en caso que se pierdan, redes sociales para compartir información, aplicaciones para tenencia responsable, soluciones para dejar al perro cuando te vas de viaje son algunas de las opciones más extendidas.
Pero no sólo de accesorios tech viven los perros. También hay moda canina de todos colores, tamaños y estampados con propuestas tanto para mascotas grandes como pequeñas, cientos de cuchas valijas y cuchas funcionales con tres posiciones, ropa de invierno para el clima que se avecina e incluso ropa deportiva. Porque la moda canina sigue las tendencias como la moda en general.
Muchas de estas tendencias se verán en la Expo Nuestros Perros, que se puede visitar hasta este domingo, de 10 a 20, en el pabellón verde de La Rural.
Entre el viernes 6 y el domingo 8 habrán actividades recreativas infantiles durante todo el día, con perros entrenados: el objetivo es concientizar acerca del cuidado, tenencia, salud y manejo de los perros que tenemos en casa. El sábado se realizará el Mundial del Dogo, con más de 258 perros de esta raza y criadores de Italia, Uruguay, China, EE.UU., Serbia, Chile, Brasil y Croacia, entre otros.', image='tecnologia.jpg';
INSERT INTO news SET title='Darle de comer carne cruda a los perros y gatos puede poner en peligro su salud', date= NOW(), description = 'Un estudio de la Universidad de Utrecht, en los Países Bajos, llegó a la conclusión que darle de comer carne cruda a perros y gatos puede ser muy peligroso para ellos y para los dueños. Los investigadores no encontraron los supuestos beneficios de esta tendencia que se inició hace ya varios años y continúa creciendo.
El estudio fue publicado en la revista Veterinary Record y asegura que la carne cruda contiene parásitos y bacterias que puede perjudicar la salud. La conclusión se sacó luego de analizar 35 productos congelados de siete marcas distintas.Los niveles de salmonella, listeria y E coli que encontraron fueron alarmantes y aseguraron que pueden provocar infecciones severas, así como traerles distintos tipos de parásitos. Además, estos alimentos dan origen a alergias y otros problemas de piel.
Por ejemplo, el 23% de los productos analizados contenía un tipo de E coli que puede provocar insuficiencia renal en humanos, mientras que el 80% de las muestras contenían otro tipo de bacterias resistente a los antibióticos. "Está claro que los productos comerciales ACBA (Alimentos Crudos Biológicamente Apropiados) pueden estar contaminados con una variedad de bacterias zoonóticas y patógenos parasitarios", dice el estudio elaborado por Paul Overgaauw y otros investigadores.', image='carne_perro.jpg';
INSERT INTO news SET title='Un anciano llorando junto a su gata, la historia que emocionó a Europa', date= NOW(), description = 'La imagen de un anciano turco junto a su gata, luego de sufrir el incendio total de su vivienda, conmovió a los europeos cuando se viralizó en las redes sociales. Este video que muestra la fragilidad de un hombre que lo perdió todo cosechó más de 50 millones de reproducciones entre Youtube y Facebook.', image='anciano.jpg';
-- Comentarios --
INSERT INTO comments SET id = '1', fk_user = '1', fk_new = '1', content = 'Excelente noticia!, le voy avisar a mi papá', date = NOW();
INSERT INTO comments SET id = '2', fk_user = '2', fk_new = '2', content = 'Que gran gesto el de ustedes, comparto en mis redes', date = NOW();
INSERT INTO comments SET id = '3', fk_user = '3', fk_new = '3', content = 'Hola chicos, tienen en stock para retirar por el local de lope de vega?', date = NOW();
INSERT INTO comments SET id = '4', fk_user = '4', fk_new = '4', content = 'Tuve una mala experiencia con estos cepillos, igualmente era de otra marca, habria que probar con estos', date = NOW();
INSERT INTO comments SET id = '5', fk_user = '4', fk_new = '5', content = 'Gracias por todo quedo excelente!!!!!!!!', date = NOW();
INSERT INTO comments SET id = '6', fk_user = '2', fk_new = '5', content = 'Que linda quedó', date = NOW();
INSERT INTO comments SET id = '7', fk_user = '1', fk_new = '6', content = 'Que linda noticia, buena semana!', date = NOW();