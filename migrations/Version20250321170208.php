<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250321170208 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE pv_recettage (id SERIAL NOT NULL, pdf_url VARCHAR(255) NOT NULL, version INT NOT NULL, generated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN pv_recettage.generated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE pv_recettage_tests (pv_recettage_id INT NOT NULL, tests_id INT NOT NULL, PRIMARY KEY(pv_recettage_id, tests_id))');
        $this->addSql('CREATE INDEX IDX_5E57402465719A96 ON pv_recettage_tests (pv_recettage_id)');
        $this->addSql('CREATE INDEX IDX_5E574024F5D80971 ON pv_recettage_tests (tests_id)');
        $this->addSql('ALTER TABLE pv_recettage_tests ADD CONSTRAINT FK_5E57402465719A96 FOREIGN KEY (pv_recettage_id) REFERENCES pv_recettage (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pv_recettage_tests ADD CONSTRAINT FK_5E574024F5D80971 FOREIGN KEY (tests_id) REFERENCES tests (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tests ADD observations TEXT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE pv_recettage_tests DROP CONSTRAINT FK_5E57402465719A96');
        $this->addSql('ALTER TABLE pv_recettage_tests DROP CONSTRAINT FK_5E574024F5D80971');
        $this->addSql('DROP TABLE pv_recettage');
        $this->addSql('DROP TABLE pv_recettage_tests');
        $this->addSql('ALTER TABLE tests DROP observations');
    }
}
