<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250603064048 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE favorites ADD institution_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE favorites ADD CONSTRAINT FK_E46960F510405986 FOREIGN KEY (institution_id) REFERENCES institutions (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_E46960F510405986 ON favorites (institution_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE favorites DROP FOREIGN KEY FK_E46960F510405986
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_E46960F510405986 ON favorites
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE favorites DROP institution_id
        SQL);
    }
}
