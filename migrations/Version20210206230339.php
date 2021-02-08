<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210206230339 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE turma_intervalo (id INT AUTO_INCREMENT NOT NULL, turma_id INT DEFAULT NULL, inicio VARCHAR(255) NOT NULL, fim VARCHAR(255) NOT NULL, INDEX IDX_65860B29CEBA2CFD (turma_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE turma_intervalo ADD CONSTRAINT FK_65860B29CEBA2CFD FOREIGN KEY (turma_id) REFERENCES turma (id)');
        $this->addSql('ALTER TABLE turma ADD hora_inicio VARCHAR(255) NOT NULL, ADD hora_fim VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE turma_intervalo');
        $this->addSql('ALTER TABLE turma DROP hora_inicio, DROP hora_fim');
    }
}
