<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250620130141 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE domaine (id INT AUTO_INCREMENT NOT NULL, domaine VARCHAR(255) NOT NULL, nom VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE domaine_categorie
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE courses ADD domaine_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE courses ADD CONSTRAINT FK_A9A55A4C4272FC9F FOREIGN KEY (domaine_id) REFERENCES domaine (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_A9A55A4C4272FC9F ON courses (domaine_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE courses DROP FOREIGN KEY FK_A9A55A4C4272FC9F
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE domaine_categorie (id INT AUTO_INCREMENT NOT NULL, domaine VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = '' 
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE domaine
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_A9A55A4C4272FC9F ON courses
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE courses DROP domaine_id
        SQL);
    }
}
