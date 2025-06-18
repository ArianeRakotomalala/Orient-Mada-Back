<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250618141637 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE avis ADD institutions_id INT DEFAULT NULL, ADD contenu VARCHAR(255) DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF0E3BADB69 FOREIGN KEY (institutions_id) REFERENCES institutions (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_8F91ABF0E3BADB69 ON avis (institutions_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF0E3BADB69
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_8F91ABF0E3BADB69 ON avis
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE avis DROP institutions_id, DROP contenu
        SQL);
    }
}
