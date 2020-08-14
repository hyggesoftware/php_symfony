<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200814095550 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE spin RENAME COLUMN dropped_cell TO dropped_cell_id');
        $this->addSql('ALTER TABLE spin ADD CONSTRAINT FK_120A248FB697051 FOREIGN KEY (dropped_cell_id) REFERENCES roulette_cell (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_120A248FB697051 ON spin (dropped_cell_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE spin DROP CONSTRAINT FK_120A248FB697051');
        $this->addSql('DROP INDEX IDX_120A248FB697051');
        $this->addSql('ALTER TABLE spin RENAME COLUMN dropped_cell_id TO dropped_cell');
    }
}
