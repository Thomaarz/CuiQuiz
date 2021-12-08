
/* UTILISATEUR */
CREATE TABLE IF NOT EXISTS user (
    user_id int(11) AUTO_INCREMENT PRIMARY KEY,
    user_name varchar(255) NOT NULL,
    user_password varchar(255) NOT NULL,
    user_coins int(11) NOT NULL DEFAULT 0,
    user_level int(11) NOT NULL DEFAULT 0,
    user_experience int(11) NOT NULL DEFAULT 0,
    user_rank int(11) NOT NULL DEFAULT 0
);

/* QUESTIONS */
CREATE TABLE IF NOT EXISTS categorie (
    categorie_id int(11) AUTO_INCREMENT PRIMARY KEY,
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
CREATE TABLE IF NOT EXISTS try_user (
    try_id int(11) AUTO_INCREMENT PRIMARY KEY,
    user_id int(11) NOT NULL,

     CONSTRAINT fk_user_id FOREIGN KEY (user_id) REFERENCES user(user_id)
);

CREATE TABLE IF NOT EXISTS answer_user (
    answer_id int(11) NOT NULL PRIMARY KEY,
    try_id int(11) NOT NULL,
    question_id int(11) NOT NULL,
    answer_value varchar(255) NOT NULL,

    CONSTRAINT fk_try_user_id FOREIGN KEY (try_id) REFERENCES try_user(try_id),
    CONSTRAINT fk_question_id FOREIGN KEY (question_id) REFERENCES question(question_id)
);

/* BOUTIQUE */
CREATE TABLE IF NOT EXISTS categorie_shop (
    categorie_shop_id int(11) AUTO_INCREMENT PRIMARY KEY,
    categorie_shop_name varchar(255) NOT NULL
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

    CONSTRAINT fk_commande_user_id FOREIGN KEY (user_id) REFERENCES user(user_id)
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
    user_id int(11) NOT NULL,

    CONSTRAINT fk_quiz_user_id FOREIGN KEY (user_id) REFERENCES user(user_id)
);
CREATE TABLE IF NOT EXISTS question_perso (
    question_perso_id int(11) AUTO_INCREMENT PRIMARY KEY,
    quiz_perso_id int(11) NOT NULL,
    question_perso_enonce varchar(255) NOT NULL,
    question_perso_reponse varchar(255) NOT NULL,

    CONSTRAINT fk_question_quiz_perso_id FOREIGN KEY (quiz_perso_id) REFERENCES quiz_perso(quiz_perso_id)
);
CREATE TABLE IF NOT EXISTS tentative_perso (
    tentative_perso_id int(11) AUTO_INCREMENT PRIMARY KEY,
    quiz_perso_id int(11) NOT NULL,

    CONSTRAINT fk_quiz_perso_id FOREIGN KEY (quiz_perso_id) REFERENCES quiz_perso(quiz_perso_id)
);
CREATE TABLE IF NOT EXISTS reponse_perso (
    reponse_perso_id int(11) AUTO_INCREMENT PRIMARY KEY,
    tentative_perso_id int(11) NOT NULL,
    reponse_perso_value varchar(255) NOT NULL,

    CONSTRAINT fk_tentative_perso_id FOREIGN KEY (tentative_perso_id) REFERENCES tentative_perso(tentative_perso_id)
);
