
/* UTILISATEUR */
CREATE TABLE IF NOT EXISTS rank (
    rank_id int(11) PRIMARY KEY,
    rank_name varchar(255) NOT NULL
);
CREATE TABLE IF NOT EXISTS titre (
    titre_id int(11) PRIMARY KEY,
    titre_name varchar(255) NOT NULL
);
CREATE TABLE IF NOT EXISTS users (
    user_id int(11) AUTO_INCREMENT PRIMARY KEY,
    user_name varchar(255) NOT NULL,
    user_password varchar(255) NOT NULL,
    user_email varchar(255) NOT NULL,
    user_coins int(11) NOT NULL DEFAULT 0,
    user_level int(11) NOT NULL DEFAULT 0,
    user_experience int(11) NOT NULL DEFAULT 0,
    rank_id int(11) NOT NULL DEFAULT 1,
    titre_id int(11) NOT NULL DEFAULT 1
);

/* QUESTIONS */
CREATE TABLE IF NOT EXISTS categorie (
    categorie_id int(11) PRIMARY KEY,
    categorie_name varchar(255) NOT NULL
);
CREATE TABLE IF NOT EXISTS difficulty (
    difficulty_id int(11) PRIMARY KEY,
    difficulty_name varchar(255) NOT NULL
);
CREATE TABLE IF NOT EXISTS question (
    question_id int(11) AUTO_INCREMENT PRIMARY KEY,
    categorie_id int(11) NOT NULL,
    difficulty_id int(11) NOT NULL,
    question_enonce varchar(255) NOT NULL,
    question_reponse varchar(255) NOT NULL,

    CONSTRAINT fk_categorie_id FOREIGN KEY (categorie_id) REFERENCES categorie(categorie_id),
    CONSTRAINT fk_difficulty_id FOREIGN KEY (difficulty_id) REFERENCES difficulty(difficulty_id)
);

/* TENTATIVES */
CREATE TABLE IF NOT EXISTS tentative_user (
    tentative_id int(11) AUTO_INCREMENT PRIMARY KEY,
    tentative_date timestamp NOT NULL DEFAULT current_timestamp(),
    user_id int(11) NOT NULL,

    CONSTRAINT fk_user_id FOREIGN KEY (user_id) REFERENCES users(user_id)
);

CREATE TABLE IF NOT EXISTS reponse_user (
    reponse_id int(11) AUTO_INCREMENT PRIMARY KEY,
    tentative_id int(11) NOT NULL,
    question_id int(11) NOT NULL,
    reponse_value varchar(255) NOT NULL,

    CONSTRAINT fk_tentative_user_id FOREIGN KEY (tentative_id) REFERENCES tentative_user(tentative_id),
    CONSTRAINT fk_question_id FOREIGN KEY (question_id) REFERENCES question(question_id)
);

/* BOUTIQUE */
CREATE TABLE IF NOT EXISTS categorie_shop (
    categorie_shop_id int(11) AUTO_INCREMENT PRIMARY KEY,
    categorie_shop_name varchar(255) NOT NULL,
    categorie_shop_description varchar(255) NOT NULL,
    categorie_shop_image varchar(255) NOT NULL
);
CREATE TABLE IF NOT EXISTS item_shop (
    item_shop_id int(11) AUTO_INCREMENT PRIMARY KEY,
    categorie_shop_id int(11) NOT NULL,
    item_shop_name varchar(255) NOT NULL,
    item_shop_description varchar(255) NOT NULL,
    item_shop_image varchar(255) NOT NULL,
    item_shop_price int(11) NOT NULL,

    CONSTRAINT fk_categorie_shop_id FOREIGN KEY (categorie_shop_id) REFERENCES categorie_shop(categorie_shop_id)
);

/* ACHAT */
CREATE TABLE IF NOT EXISTS commande (
    commande_id int(11) AUTO_INCREMENT PRIMARY KEY,
    user_id int(11) NOT NULL,
    commande_date timestamp NOT NULL DEFAULT current_timestamp(),

    CONSTRAINT fk_commande_user_id FOREIGN KEY (user_id) REFERENCES users(user_id)
);
CREATE TABLE IF NOT EXISTS achat (
    achat_id int(11) AUTO_INCREMENT PRIMARY KEY,
    commande_id int(11) NOT NULL,
    item_shop_id int(11) NOT NULL,

    CONSTRAINT fk_commande_id FOREIGN KEY (commande_id) REFERENCES commande(commande_id),
    CONSTRAINT fk_item_shop_id FOREIGN KEY (item_shop_id) REFERENCES item_shop(item_shop_id)
);

/* CUSTOM QUIZ */
CREATE TABLE IF NOT EXISTS quiz_perso (
    quiz_perso_id int(11) AUTO_INCREMENT PRIMARY KEY,
    quiz_perso_name varchar(255) NOT NULL,
    quiz_perso_date timestamp NOT NULL DEFAULT current_timestamp(),
    user_id int(11) NOT NULL,

    CONSTRAINT fk_quiz_user_id FOREIGN KEY (user_id) REFERENCES users(user_id)
);
CREATE TABLE IF NOT EXISTS question_perso (
    question_perso_id int(11) AUTO_INCREMENT PRIMARY KEY,
    quiz_perso_id int(11) NOT NULL,
    question_perso_enonce varchar(255) NOT NULL,
    question_perso_reponse varchar(255) NOT NULL,

    CONSTRAINT fk_question_quiz_perso_id FOREIGN KEY (quiz_perso_id) REFERENCES quiz_perso(quiz_perso_id) ON DELETE CASCADE
);
CREATE TABLE IF NOT EXISTS tentative_perso (
    tentative_perso_id int(11) AUTO_INCREMENT PRIMARY KEY,
    tentative_perso_date timestamp NOT NULL DEFAULT current_timestamp(),
    user_id int(11) NOT NULL,
    quiz_perso_id int(11) NOT NULL,

    CONSTRAINT fk_quiz_perso_id FOREIGN KEY (quiz_perso_id) REFERENCES quiz_perso(quiz_perso_id) ON DELETE CASCADE
);
CREATE TABLE IF NOT EXISTS reponse_perso (
    reponse_perso_id int(11) AUTO_INCREMENT PRIMARY KEY,
    tentative_perso_id int(11) NOT NULL,
    question_perso_id int(11) NOT NULL,
    reponse_perso_value varchar(255) NOT NULL,

    CONSTRAINT fk_tentative_perso_id FOREIGN KEY (tentative_perso_id) REFERENCES tentative_perso(tentative_perso_id) ON DELETE CASCADE,
    CONSTRAINT fk_question_perso_id FOREIGN KEY (question_perso_id) REFERENCES question_perso(question_perso_id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS actus (
    actus_id int(11) AUTO_INCREMENT UNIQUE,
    actus_sender VARCHAR(255) NOT NULL,
    actus_title VARCHAR(255) NOT NULL,
    actus_lore TEXT NOT NULL,
    actus_date timestamp NOT NULL DEFAULT current_timestamp()
);

/* INSERTS */

INSERT INTO rank (rank_id, rank_name) VALUES (1, 'Joueur');
INSERT INTO rank (rank_id, rank_name) VALUES (2, 'Oiseau');
INSERT INTO rank (rank_id, rank_name) VALUES (3, 'Super Oiseau');
INSERT INTO rank (rank_id, rank_name) VALUES (4, 'Administrateur');

INSERT INTO titre (titre_id, titre_name) VALUES (1, 'D??butant');
INSERT INTO titre (titre_id, titre_name) VALUES (2, 'Expert');
INSERT INTO titre (titre_id, titre_name) VALUES (3, 'Pro');
INSERT INTO titre (titre_id, titre_name) VALUES (4, 'L??gende');

INSERT INTO categorie (categorie_id, categorie_name) VALUES (1, 'Oiseaux');
INSERT INTO categorie (categorie_id, categorie_name) VALUES (2, 'Histoire');
INSERT INTO categorie (categorie_id, categorie_name) VALUES (3, 'Sport');

INSERT INTO difficulty (difficulty_id, difficulty_name) VALUES (1, 'Facile');
INSERT INTO difficulty (difficulty_id, difficulty_name) VALUES (2, 'Moyen');
INSERT INTO difficulty (difficulty_id, difficulty_name) VALUES (3, 'Difficile');

/* BIRDS */
/* EASY */
INSERT INTO question (categorie_id, difficulty_id, question_enonce, question_reponse)
 VALUES (1, 1, 'Quel est le m??le de la poule ?', 'Coq');
INSERT INTO question (categorie_id, difficulty_id, question_enonce, question_reponse)
 VALUES (1, 1, 'Quelle est la femelle du canard ?', 'Cane');
INSERT INTO question (categorie_id, difficulty_id, question_enonce, question_reponse)
 VALUES (1, 1, 'Combien de dents ont les poules ?', '0');
INSERT INTO question (categorie_id, difficulty_id, question_enonce, question_reponse)
 VALUES (1, 1, 'Quel oiseau est le symbole de la France ?', 'Coq');
INSERT INTO question (categorie_id, difficulty_id, question_enonce, question_reponse)
 VALUES (1, 1, 'La poule peut-elle voler ?', 'Oui');
/* MEDIUM */
INSERT INTO question (categorie_id, difficulty_id, question_enonce, question_reponse)
 VALUES (1, 2, 'Quel oiseau peut-??tre qualifi?? de Parisiens ?', 'Pigeon');
INSERT INTO question (categorie_id, difficulty_id, question_enonce, question_reponse)
 VALUES (1, 2, 'Quel oiseau est connu pour rester proche du littoral ?', 'Mouette');
INSERT INTO question (categorie_id, difficulty_id, question_enonce, question_reponse)
 VALUES (1, 2, 'Quel est l???oiseau symbole de la paix ?', 'Colombe');
INSERT INTO question (categorie_id, difficulty_id, question_enonce, question_reponse)
 VALUES (1, 2, 'Que signifie l???expression ???Quand les poules auront des dents??? ?', 'Jamais');
INSERT INTO question (categorie_id, difficulty_id, question_enonce, question_reponse)
 VALUES (1, 2, 'Le tyrannosaurus Rex poss??dait-il des plumes ?', 'Oui');
/* HARD */
INSERT INTO question (categorie_id, difficulty_id, question_enonce, question_reponse)
 VALUES (1, 3, 'Comment appelle t-on une personne qui ??tudie le comportement des oiseaux ?', 'Ornithologue');
INSERT INTO question (categorie_id, difficulty_id, question_enonce, question_reponse)
 VALUES (1, 3, 'Quel est le plus grand vautour ?', 'Condor des Andes');
INSERT INTO question (categorie_id, difficulty_id, question_enonce, question_reponse)
 VALUES (1, 3, 'Quel est le plus petit oiseau ?', 'Colibris');
INSERT INTO question (categorie_id, difficulty_id, question_enonce, question_reponse)
 VALUES (1, 3, 'Quel est le plus grand chasseur parmi les oiseaux ?', 'Aigle royale');
INSERT INTO question (categorie_id, difficulty_id, question_enonce, question_reponse)
 VALUES (1, 3, 'Comment nomme t-on le m??le d???une oie ?', 'Jars');

/* HISTORY */
/* EASY */
INSERT INTO question (categorie_id, difficulty_id, question_enonce, question_reponse)
 VALUES (2, 1, 'En quelle ann??e se passe la r??volution fran??aise ?', '1789');
INSERT INTO question (categorie_id, difficulty_id, question_enonce, question_reponse)
 VALUES (2, 1, 'Quelle est la date de d??but de la Premi??re Guerre mondiale ? (ann??e)', '1914');
INSERT INTO question (categorie_id, difficulty_id, question_enonce, question_reponse)
 VALUES (2, 1, 'Quelle est la date de fin de la Premi??re Guerre mondiale ? (ann??e)', '1918');
INSERT INTO question (categorie_id, difficulty_id, question_enonce, question_reponse)
 VALUES (2, 1, 'Quelle est la date de d??but de la Seconde Guerre mondiale ? (ann??e)', '1939');
INSERT INTO question (categorie_id, difficulty_id, question_enonce, question_reponse)
 VALUES (2, 1, 'Quelle est la date de fin de la Seconde Guerre mondiale ? (ann??e)', '1945');
INSERT INTO question (categorie_id, difficulty_id, question_enonce, question_reponse)
 VALUES (2, 1, 'En 1492, quelle c??l??bre navigateur a d??couvert l???Am??rique ?', 'Christophe Colomb');
INSERT INTO question (categorie_id, difficulty_id, question_enonce, question_reponse)
 VALUES (2, 1, 'Qui ??tait surnomm?? le roi soleil ?', 'Louis XIV');
/* MEDIUM */
INSERT INTO question (categorie_id, difficulty_id, question_enonce, question_reponse)
 VALUES (2, 1, 'Combien d''ann??es dure la guerre de 100 ans ? (ans)', '116');
INSERT INTO question (categorie_id, difficulty_id, question_enonce, question_reponse)
 VALUES (2, 1, 'En quelle ann??e chute le mur de Berlin ?', '1989');
INSERT INTO question (categorie_id, difficulty_id, question_enonce, question_reponse)
 VALUES (2, 1, 'Comment se nommait la guerre id??ologique entre les USA et l???URSS ?', 'Guerre froide');
INSERT INTO question (categorie_id, difficulty_id, question_enonce, question_reponse)
 VALUES (2, 1, 'Quelle c??l??bre bataille Napol??on a t-il perdu ?', 'Waterloo');
INSERT INTO question (categorie_id, difficulty_id, question_enonce, question_reponse)
 VALUES (2, 1, 'Quel roi a ??t?? guillotin?? en 1793 ?', 'Louis XVI');
INSERT INTO question (categorie_id, difficulty_id, question_enonce, question_reponse)
 VALUES (2, 1, 'Quelle ville s''appelait Lut??ce ?', 'Paris');
INSERT INTO question (categorie_id, difficulty_id, question_enonce, question_reponse)
 VALUES (2, 1, 'Quel roi est mort en se cognant la t??te ?', 'Charles VIII');
INSERT INTO question (categorie_id, difficulty_id, question_enonce, question_reponse)
 VALUES (2, 1, 'Dans quelle bataille, Vercing??torix a ??t?? contraint de d??poser les armes devant Jules C??sar ?', 'Al??sia');
INSERT INTO question (categorie_id, difficulty_id, question_enonce, question_reponse)
 VALUES (2, 1, 'Quel est la date de la mort de Jules C??sar ? (ann??e avant JC)', '44');
INSERT INTO question (categorie_id, difficulty_id, question_enonce, question_reponse)
 VALUES (2, 1, 'Qui a cass?? le vase de Soissons ?', 'Clovis');

/* SPORT */
/* EASY */
INSERT INTO question (categorie_id, difficulty_id, question_enonce, question_reponse)
 VALUES (3, 1, ' Comment se nomme la plus grande et plus vieille comp??tition comportant 41 sports diff??rents ?', 'Jeux Olympiques');
INSERT INTO question (categorie_id, difficulty_id, question_enonce, question_reponse)
 VALUES (3, 1, 'Quel est le nom complet de la l??gende du basketball qui a aussi cr???? une marque de chaussures c??l??bre ?', 'Michael Jordan');
INSERT INTO question (categorie_id, difficulty_id, question_enonce, question_reponse)
 VALUES (3, 1, 'Quel est le nom complet de la l??gende du football fran??ais qui est connu pour son c??l??bre coup de t??te ?', 'Zinedine Zidane');
INSERT INTO question (categorie_id, difficulty_id, question_enonce, question_reponse)
 VALUES (3, 1, 'Qui est consid??r?? comme la personne la plus rapide du monde ?', 'Usain Bolt');
INSERT INTO question (categorie_id, difficulty_id, question_enonce, question_reponse)
 VALUES (3, 1, 'De combien de sports compose un d??cathlon ?', '10');
/* MEDIUM */
INSERT INTO question (categorie_id, difficulty_id, question_enonce, question_reponse)
 VALUES (3, 2, 'Quel pays est champion olympiques de volley-ball 2021 ?', 'France');
INSERT INTO question (categorie_id, difficulty_id, question_enonce, question_reponse)
 VALUES (3, 2, 'Comment est surnomm?? l?????quipe de rugby de Nouvelle-Z??lande ?', 'All blacks');
INSERT INTO question (categorie_id, difficulty_id, question_enonce, question_reponse)
 VALUES (3, 2, 'Quelle pays a gagn?? le plus grand nombre de coupes du monde de football ?', 'Br??sil');
INSERT INTO question (categorie_id, difficulty_id, question_enonce, question_reponse)
 VALUES (3, 2, 'Comment nomme t-on la plus grande comp??tition de cyclisme qui a lieu en France ?', 'Tour de France');
INSERT INTO question (categorie_id, difficulty_id, question_enonce, question_reponse)
 VALUES (3, 2, 'Quel est le pr??nom du tennisman Nadal ?', 'Rafael');
INSERT INTO question (categorie_id, difficulty_id, question_enonce, question_reponse)
 VALUES (3, 2, 'Quel est le pr??nom du tennisman Federer ?', 'Roger');
INSERT INTO question (categorie_id, difficulty_id, question_enonce, question_reponse)
 VALUES (3, 2, 'Quel est le pr??nom du tennisman Djokovic ?', 'Novak');
INSERT INTO question (categorie_id, difficulty_id, question_enonce, question_reponse)
/* HARD */
 VALUES (3, 3, 'En NBA, qui est actuellement le plus grand marqueur ?? trois points en saison r??guli??re de tous les temps ?', 'Stephen Curry');
INSERT INTO question (categorie_id, difficulty_id, question_enonce, question_reponse)
 VALUES (3, 3, 'Quel sportif fran??ais est consid??r?? comme le plus fort judoka de tous les temps ?', 'Teddy Riner');
INSERT INTO question (categorie_id, difficulty_id, question_enonce, question_reponse)
 VALUES (3, 3, 'En 2020, qui a ??t?? le sportif le mieux pay?? au monde ?', 'Conor McGregor');
INSERT INTO question (categorie_id, difficulty_id, question_enonce, question_reponse)
 VALUES (3, 3, 'Quelle ??quipe a remport?? le plus de Ligue des champions (13) ?', 'Real Madrid');
INSERT INTO question (categorie_id, difficulty_id, question_enonce, question_reponse)
 VALUES (3, 3, 'En combien de set au maximum se d??roule un match de badminton ?', '3');



 /* SHOP*/

INSERT INTO categorie_shop (categorie_shop_name, categorie_shop_description, categorie_shop_image)
 VALUES ('Grades', 'Les grades sont affich??s dans le classement et sur votre profil', 'ranks.png');
INSERT INTO categorie_shop (categorie_shop_name, categorie_shop_description, categorie_shop_image)
 VALUES ('Titres', 'Les titres sont affich??s dans le classement !', 'titres.png');

INSERT INTO item_shop (categorie_shop_id, item_shop_name, item_shop_description, item_shop_image, item_shop_price)
 VALUES (1, 'Oiseau', 'Pour vous envoler toujours plus haut !', 'oiseau.png', 500);
INSERT INTO item_shop (categorie_shop_id, item_shop_name, item_shop_description, item_shop_image, item_shop_price)
 VALUES (1, 'Super Oiseau', 'Pour vous envoler toujours plus haut !', 'super_oiseau.png', 1000);

INSERT INTO item_shop (categorie_shop_id, item_shop_name, item_shop_description, item_shop_image, item_shop_price)
 VALUES (2, 'Expert', 'Affichez le titre Expert dans le classement', 'debutant.png', 200);
INSERT INTO item_shop (categorie_shop_id, item_shop_name, item_shop_description, item_shop_image, item_shop_price)
 VALUES (2, 'Pro', 'Affichez le titre Pro dans le classement', 'debutant.png', 300);
INSERT INTO item_shop (categorie_shop_id, item_shop_name, item_shop_description, item_shop_image, item_shop_price)
 VALUES (2, 'L??gende', 'Affichez le titre L??gende dans le classement', 'debutant.png', 400);