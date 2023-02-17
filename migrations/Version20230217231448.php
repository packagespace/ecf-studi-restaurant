<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230217231448 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE reservation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE reservation (id INT NOT NULL, time TIME(0) WITHOUT TIME ZONE NOT NULL, number_of_guests INT NOT NULL, allergies TEXT DEFAULT NULL, date DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN reservation.time IS \'(DC2Type:time_immutable)\'');
        $this->addSql('COMMENT ON COLUMN reservation.date IS \'(DC2Type:date_immutable)\'');
        $this->addSql('ALTER TABLE opening_hour_range ALTER opening_time TYPE INT');
        $this->addSql('ALTER TABLE opening_hour_range ALTER closing_time TYPE INT');
        $this->addSql('COMMENT ON COLUMN opening_hour_range.opening_time IS NULL');
        $this->addSql('COMMENT ON COLUMN opening_hour_range.closing_time IS NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE reservation_id_seq CASCADE');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('ALTER TABLE opening_hour_range ALTER opening_time TYPE TIME(0) WITHOUT TIME ZONE');
        $this->addSql('ALTER TABLE opening_hour_range ALTER closing_time TYPE TIME(0) WITHOUT TIME ZONE');
        $this->addSql('COMMENT ON COLUMN opening_hour_range.opening_time IS \'(DC2Type:time_immutable)\'');
        $this->addSql('COMMENT ON COLUMN opening_hour_range.closing_time IS \'(DC2Type:time_immutable)\'');
    }
}
