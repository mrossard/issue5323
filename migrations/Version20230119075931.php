<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230119075931 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE relationship_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE resource_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE relationship (id INT NOT NULL, first_id INT DEFAULT NULL, second_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_200444A0E84D625F ON relationship (first_id)');
        $this->addSql('CREATE INDEX IDX_200444A0FF961BCC ON relationship (second_id)');
        $this->addSql('CREATE TABLE resource (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE relationship ADD CONSTRAINT FK_200444A0E84D625F FOREIGN KEY (first_id) REFERENCES resource (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE relationship ADD CONSTRAINT FK_200444A0FF961BCC FOREIGN KEY (second_id) REFERENCES resource (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE relationship_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE resource_id_seq CASCADE');
        $this->addSql('ALTER TABLE relationship DROP CONSTRAINT FK_200444A0E84D625F');
        $this->addSql('ALTER TABLE relationship DROP CONSTRAINT FK_200444A0FF961BCC');
        $this->addSql('DROP TABLE relationship');
        $this->addSql('DROP TABLE resource');
    }
}
