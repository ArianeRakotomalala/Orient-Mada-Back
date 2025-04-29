<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250423132122 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE users ADD user_profils_id INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE users ADD CONSTRAINT FK_1483A5E91EEFDC17 FOREIGN KEY (user_profils_id) REFERENCES users_profils (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_1483A5E91EEFDC17 ON users (user_profils_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE users_profils ADD clear VARCHAR(255) NOT NULL
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE users DROP FOREIGN KEY FK_1483A5E91EEFDC17
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX UNIQ_1483A5E91EEFDC17 ON users
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE users DROP user_profils_id
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE users_profils DROP clear
        SQL);
    }
}
