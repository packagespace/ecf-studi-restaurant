<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230217233433 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE day_opening_hours_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE day_opening_hours (id INT NOT NULL, day_of_week VARCHAR(255) NOT NULL, lunch_opening_time INT DEFAULT NULL, lunch_closing_time INT DEFAULT NULL, dinner_opening_time INT DEFAULT NULL, dinner_closing_time INT DEFAULT NULL, PRIMARY KEY(id))');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE day_opening_hours_id_seq CASCADE');
        $this->addSql('DROP TABLE day_opening_hours');
    }
}
