<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250321135856 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tests (id SERIAL NOT NULL, created_by_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description TEXT NOT NULL, steps TEXT NOT NULL, acceptance_criteria TEXT NOT NULL, excected_result TEXT NOT NULL, actual_result TEXT NOT NULL, status VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_1260FC5EB03A8386 ON tests (created_by_id)');
        $this->addSql('COMMENT ON COLUMN tests.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE tests ADD CONSTRAINT FK_1260FC5EB03A8386 FOREIGN KEY (created_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE tests DROP CONSTRAINT FK_1260FC5EB03A8386');
        $this->addSql('DROP TABLE tests');
    }
}
