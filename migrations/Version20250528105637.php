<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250528105637 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE event_registrations ADD user_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE event_registrations ADD CONSTRAINT FK_7787E14BA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_7787E14BA76ED395 ON event_registrations (user_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE favorites ADD user_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE favorites ADD CONSTRAINT FK_E46960F5A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_E46960F5A76ED395 ON favorites (user_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE information_requests ADD user_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE information_requests ADD CONSTRAINT FK_FC904423A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_FC904423A76ED395 ON information_requests (user_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE institute_registration ADD user_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE institute_registration ADD CONSTRAINT FK_1B2A1692A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_1B2A1692A76ED395 ON institute_registration (user_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user ADD user_profils_id_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user ADD CONSTRAINT FK_8D93D64962100521 FOREIGN KEY (user_profils_id_id) REFERENCES users_profils (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_8D93D64962100521 ON user (user_profils_id_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user_preferences ADD user_id INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user_preferences ADD CONSTRAINT FK_402A6F60A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_402A6F60A76ED395 ON user_preferences (user_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE event_registrations DROP FOREIGN KEY FK_7787E14BA76ED395
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_7787E14BA76ED395 ON event_registrations
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE event_registrations DROP user_id
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
            ALTER TABLE institute_registration DROP FOREIGN KEY FK_1B2A1692A76ED395
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_1B2A1692A76ED395 ON institute_registration
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE institute_registration DROP user_id
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user DROP FOREIGN KEY FK_8D93D64962100521
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX UNIQ_8D93D64962100521 ON user
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user DROP user_profils_id_id
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user_preferences DROP FOREIGN KEY FK_402A6F60A76ED395
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_402A6F60A76ED395 ON user_preferences
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user_preferences DROP user_id
        SQL);
    }
}
