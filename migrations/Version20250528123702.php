<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250528123702 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE courses (id INT AUTO_INCREMENT NOT NULL, institutions_id INT NOT NULL, title VARCHAR(255) NOT NULL, duration VARCHAR(255) NOT NULL, degree VARCHAR(255) NOT NULL, prerequisites VARCHAR(255) NOT NULL, admission_process VARCHAR(255) NOT NULL, fees INT NOT NULL, languages VARCHAR(255) NOT NULL, career_prospects VARCHAR(255) NOT NULL, INDEX IDX_A9A55A4CE3BADB69 (institutions_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE event_registrations (id INT AUTO_INCREMENT NOT NULL, events_id INT NOT NULL, registration_date VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, INDEX IDX_7787E14B9D6A1065 (events_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE events (id INT AUTO_INCREMENT NOT NULL, institution_id INT NOT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, event_date_time DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', registration_parameters VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', INDEX IDX_5387574A10405986 (institution_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE favorites (id INT AUTO_INCREMENT NOT NULL, favorite_type VARCHAR(255) NOT NULL, collection_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE information_requests (id INT AUTO_INCREMENT NOT NULL, institutions_id INT NOT NULL, information_answers_id INT DEFAULT NULL, status VARCHAR(255) NOT NULL, request_date DATETIME NOT NULL, INDEX IDX_FC904423E3BADB69 (institutions_id), UNIQUE INDEX UNIQ_FC9044237AB775C7 (information_answers_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE informations_answers (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE institute_registration (id INT AUTO_INCREMENT NOT NULL, intitution_id INT NOT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', is_validated TINYINT(1) NOT NULL, INDEX IDX_1B2A16923C0FCE0 (intitution_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE institutions (id INT AUTO_INCREMENT NOT NULL, institution_name VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, location VARCHAR(255) NOT NULL, history VARCHAR(255) NOT NULL, infrastructure VARCHAR(255) NOT NULL, contact VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE testimonials (id INT AUTO_INCREMENT NOT NULL, courses_id INT NOT NULL, author VARCHAR(255) NOT NULL, publication_date DATETIME NOT NULL, content VARCHAR(255) NOT NULL, INDEX IDX_38311579F9295384 (courses_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, telephone VARCHAR(20) NOT NULL, roles JSON NOT NULL COMMENT '(DC2Type:json)', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE user_preferences (id INT AUTO_INCREMENT NOT NULL, field_study VARCHAR(255) NOT NULL, type_of_institution VARCHAR(255) NOT NULL, location VARCHAR(255) NOT NULL, max_coast VARCHAR(255) NOT NULL, prefered_language VARCHAR(255) NOT NULL, min_success_rate VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE users_profils (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, bacc_result VARCHAR(255) NOT NULL, birthday VARCHAR(255) NOT NULL, clear VARCHAR(255) NOT NULL, adress VARCHAR(255) NOT NULL, hobbies VARCHAR(255) NOT NULL, serie VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', available_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', delivered_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE courses ADD CONSTRAINT FK_A9A55A4CE3BADB69 FOREIGN KEY (institutions_id) REFERENCES institutions (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE event_registrations ADD CONSTRAINT FK_7787E14B9D6A1065 FOREIGN KEY (events_id) REFERENCES events (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE events ADD CONSTRAINT FK_5387574A10405986 FOREIGN KEY (institution_id) REFERENCES institutions (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE information_requests ADD CONSTRAINT FK_FC904423E3BADB69 FOREIGN KEY (institutions_id) REFERENCES institutions (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE information_requests ADD CONSTRAINT FK_FC9044237AB775C7 FOREIGN KEY (information_answers_id) REFERENCES informations_answers (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE institute_registration ADD CONSTRAINT FK_1B2A16923C0FCE0 FOREIGN KEY (intitution_id) REFERENCES institutions (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE testimonials ADD CONSTRAINT FK_38311579F9295384 FOREIGN KEY (courses_id) REFERENCES courses (id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE courses DROP FOREIGN KEY FK_A9A55A4CE3BADB69
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE event_registrations DROP FOREIGN KEY FK_7787E14B9D6A1065
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE events DROP FOREIGN KEY FK_5387574A10405986
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE information_requests DROP FOREIGN KEY FK_FC904423E3BADB69
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE information_requests DROP FOREIGN KEY FK_FC9044237AB775C7
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE institute_registration DROP FOREIGN KEY FK_1B2A16923C0FCE0
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE testimonials DROP FOREIGN KEY FK_38311579F9295384
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE courses
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE event_registrations
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE events
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE favorites
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE information_requests
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE informations_answers
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE institute_registration
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE institutions
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE testimonials
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE user
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE user_preferences
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE users_profils
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE messenger_messages
        SQL);
    }
}
