<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250622110832 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add created_at column to user table with proper handling of existing data';
    }

    public function up(Schema $schema): void
    {
        // First add the column as nullable
        $this->addSql(<<<'SQL'
            ALTER TABLE user ADD created_at DATETIME NULL COMMENT '(DC2Type:datetime_immutable)'
        SQL);
        
        // Update existing records with current timestamp
        $this->addSql(<<<'SQL'
            UPDATE user SET created_at = NOW() WHERE created_at IS NULL OR created_at = '0000-00-00 00:00:00'
        SQL);
        
        // Now make the column NOT NULL
        $this->addSql(<<<'SQL'
            ALTER TABLE user MODIFY created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)'
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE `user` DROP created_at
        SQL);
    }
}
