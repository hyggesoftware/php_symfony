<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200813100619 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE round_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE spin_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE round (id INT NOT NULL, user_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C5EEEA349D86650F ON round (user_id)');
        $this->addSql('CREATE TABLE spin (id INT NOT NULL, round_id INT NOT NULL, dropped_cell INT DEFAULT NULL, is_jackpot BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_120A248FA9378AAE ON spin (round_id)');
        $this->addSql('ALTER TABLE round ADD CONSTRAINT FK_C5EEEA349D86650F FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE spin ADD CONSTRAINT FK_120A248FA9378AAE FOREIGN KEY (round_id) REFERENCES round (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE spin DROP CONSTRAINT FK_120A248FA9378AAE');
        $this->addSql('DROP SEQUENCE round_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE spin_id_seq CASCADE');
        $this->addSql('DROP TABLE round');
        $this->addSql('DROP TABLE spin');
    }
}
