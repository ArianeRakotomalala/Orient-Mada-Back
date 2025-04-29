<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250424093007 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE events (id INT AUTO_INCREMENT NOT NULL, institution_id INT NOT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, event_date_time DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', registration_parameters VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', INDEX IDX_5387574A10405986 (institution_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE events ADD CONSTRAINT FK_5387574A10405986 FOREIGN KEY (institution_id) REFERENCES institutions (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE courses ADD institutions_id INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE courses ADD CONSTRAINT FK_A9A55A4CE3BADB69 FOREIGN KEY (institutions_id) REFERENCES institutions (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_A9A55A4CE3BADB69 ON courses (institutions_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE event_registrations ADD users_id INT NOT NULL, ADD events_id INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE event_registrations ADD CONSTRAINT FK_7787E14B67B3B43D FOREIGN KEY (users_id) REFERENCES users (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE event_registrations ADD CONSTRAINT FK_7787E14B9D6A1065 FOREIGN KEY (events_id) REFERENCES events (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_7787E14B67B3B43D ON event_registrations (users_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_7787E14B9D6A1065 ON event_registrations (events_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE favorites ADD user_id INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE favorites ADD CONSTRAINT FK_E46960F5A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_E46960F5A76ED395 ON favorites (user_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE information_requests ADD user_id INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE information_requests ADD CONSTRAINT FK_FC904423A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_FC904423A76ED395 ON information_requests (user_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE institute_registration ADD users_id INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE institute_registration ADD CONSTRAINT FK_1B2A169267B3B43D FOREIGN KEY (users_id) REFERENCES users (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_1B2A169267B3B43D ON institute_registration (users_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user_preferences ADD users_id INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user_preferences ADD CONSTRAINT FK_402A6F6067B3B43D FOREIGN KEY (users_id) REFERENCES users (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_402A6F6067B3B43D ON user_preferences (users_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE event_registrations DROP FOREIGN KEY FK_7787E14B9D6A1065
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE events DROP FOREIGN KEY FK_5387574A10405986
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE events
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE courses DROP FOREIGN KEY FK_A9A55A4CE3BADB69
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_A9A55A4CE3BADB69 ON courses
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE courses DROP institutions_id
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE event_registrations DROP FOREIGN KEY FK_7787E14B67B3B43D
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_7787E14B67B3B43D ON event_registrations
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_7787E14B9D6A1065 ON event_registrations
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE event_registrations DROP users_id, DROP events_id
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE favorites DROP FOREIGN KEY FK_E46960F5A76ED395
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_E46960F5A76ED395 ON favorites
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE favorites DROP user_id
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE information_requests DROP FOREIGN KEY FK_FC904423A76ED395
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_FC904423A76ED395 ON information_requests
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE information_requests DROP user_id
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE institute_registration DROP FOREIGN KEY FK_1B2A169267B3B43D
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_1B2A169267B3B43D ON institute_registration
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE institute_registration DROP users_id
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user_preferences DROP FOREIGN KEY FK_402A6F6067B3B43D
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_402A6F6067B3B43D ON user_preferences
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user_preferences DROP users_id
        SQL);
    }
}
