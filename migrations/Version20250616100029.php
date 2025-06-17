<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250616100029 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // 1. Supprimer les cours qui n'ont pas d'institution valide
        $this->addSql('DELETE FROM courses WHERE institutions_id IS NULL OR institutions_id NOT IN (SELECT id FROM institutions)');

        // 2. Ajouter la contrainte de clé étrangère
        $this->addSql('ALTER TABLE courses ADD CONSTRAINT FK_A9A55A4CE3BADB69 FOREIGN KEY (institutions_id) REFERENCES institutions (id)');
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_A9A55A4CE3BADB69 ON courses (institutions_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE courses DROP FOREIGN KEY FK_A9A55A4CE3BADB69
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_A9A55A4CE3BADB69 ON courses
        SQL);
    }
}
