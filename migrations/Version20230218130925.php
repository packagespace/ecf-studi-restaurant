<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230218130925 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE opening_hour_range_id_seq CASCADE');
        $this->addSql('DROP TABLE opening_hour_range');
        $this->addSql('ALTER TABLE reservation DROP "time"');
        $this->addSql('ALTER TABLE reservation ADD COLUMN "time" INTEGER');
        $this->addSql('COMMENT ON COLUMN reservation.time IS NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE opening_hour_range_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE opening_hour_range (id INT NOT NULL, day VARCHAR(255) NOT NULL, opening_time INT NOT NULL, closing_time INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE reservation ALTER time TYPE TIME(0) WITHOUT TIME ZONE');
        $this->addSql('COMMENT ON COLUMN reservation."time" IS \'(DC2Type:time_immutable)\'');
    }
}
