<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200814090230 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE roulette_cell_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE roulette_cell (id INT NOT NULL, index INT NOT NULL, weight INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER INDEX idx_c5eeea349d86650f RENAME TO IDX_C5EEEA34A76ED395');
        $this->addSql('ALTER INDEX idx_120a248fa9378aae RENAME TO IDX_120A248FA6005CA0');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE roulette_cell_id_seq CASCADE');
        $this->addSql('DROP TABLE roulette_cell');
        $this->addSql('ALTER INDEX idx_c5eeea34a76ed395 RENAME TO idx_c5eeea349d86650f');
        $this->addSql('ALTER INDEX idx_120a248fa6005ca0 RENAME TO idx_120a248fa9378aae');
    }
}
