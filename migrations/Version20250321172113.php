<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250321172113 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pv_recettage ADD technical_environment TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE pv_recettage ADD critical_points TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE pv_recettage ADD consequences TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE pv_recettage ADD action_plan TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE pv_recettage ADD conlusion TEXT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE pv_recettage DROP technical_environment');
        $this->addSql('ALTER TABLE pv_recettage DROP critical_points');
        $this->addSql('ALTER TABLE pv_recettage DROP consequences');
        $this->addSql('ALTER TABLE pv_recettage DROP action_plan');
        $this->addSql('ALTER TABLE pv_recettage DROP conlusion');
    }
}
