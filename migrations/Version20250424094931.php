<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250424094931 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE information_requests ADD institutions_id INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE information_requests ADD CONSTRAINT FK_FC904423E3BADB69 FOREIGN KEY (institutions_id) REFERENCES institutions (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_FC904423E3BADB69 ON information_requests (institutions_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE institute_registration ADD intitution_id INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE institute_registration ADD CONSTRAINT FK_1B2A16923C0FCE0 FOREIGN KEY (intitution_id) REFERENCES institutions (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_1B2A16923C0FCE0 ON institute_registration (intitution_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE testimonials ADD courses_id INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE testimonials ADD CONSTRAINT FK_38311579F9295384 FOREIGN KEY (courses_id) REFERENCES courses (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_38311579F9295384 ON testimonials (courses_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE information_requests DROP FOREIGN KEY FK_FC904423E3BADB69
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_FC904423E3BADB69 ON information_requests
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE information_requests DROP institutions_id
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE institute_registration DROP FOREIGN KEY FK_1B2A16923C0FCE0
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_1B2A16923C0FCE0 ON institute_registration
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE institute_registration DROP intitution_id
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE testimonials DROP FOREIGN KEY FK_38311579F9295384
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_38311579F9295384 ON testimonials
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE testimonials DROP courses_id
        SQL);
    }
}
