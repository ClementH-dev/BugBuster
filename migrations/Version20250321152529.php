<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250321152529 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tests ADD updated_by_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tests ADD updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('COMMENT ON COLUMN tests.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE tests ADD CONSTRAINT FK_1260FC5E896DBBDE FOREIGN KEY (updated_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_1260FC5E896DBBDE ON tests (updated_by_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE tests DROP CONSTRAINT FK_1260FC5E896DBBDE');
        $this->addSql('DROP INDEX IDX_1260FC5E896DBBDE');
        $this->addSql('ALTER TABLE tests DROP updated_by_id');
        $this->addSql('ALTER TABLE tests DROP updated_at');
    }
}
