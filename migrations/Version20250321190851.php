<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250321190851 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pv_recettage ADD previous_version_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pv_recettage ALTER version SET NOT NULL');
        $this->addSql('ALTER TABLE pv_recettage ADD CONSTRAINT FK_135037973CBC65BC FOREIGN KEY (previous_version_id) REFERENCES pv_recettage (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_135037973CBC65BC ON pv_recettage (previous_version_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE pv_recettage DROP CONSTRAINT FK_135037973CBC65BC');
        $this->addSql('DROP INDEX IDX_135037973CBC65BC');
        $this->addSql('ALTER TABLE pv_recettage DROP previous_version_id');
        $this->addSql('ALTER TABLE pv_recettage ALTER version DROP NOT NULL');
    }
}
