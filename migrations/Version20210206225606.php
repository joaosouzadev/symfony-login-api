<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210206225606 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE curso (id INT AUTO_INCREMENT NOT NULL, instituicao_id INT DEFAULT NULL, nome VARCHAR(255) NOT NULL, INDEX IDX_CA3B40ECB05E5EEA (instituicao_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE turma (id INT AUTO_INCREMENT NOT NULL, curso_id INT DEFAULT NULL, nome VARCHAR(255) NOT NULL, INDEX IDX_2B0219A687CB4A1F (curso_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE curso ADD CONSTRAINT FK_CA3B40ECB05E5EEA FOREIGN KEY (instituicao_id) REFERENCES instituicao (id)');
        $this->addSql('ALTER TABLE turma ADD CONSTRAINT FK_2B0219A687CB4A1F FOREIGN KEY (curso_id) REFERENCES curso (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE turma DROP FOREIGN KEY FK_2B0219A687CB4A1F');
        $this->addSql('DROP TABLE curso');
        $this->addSql('DROP TABLE turma');
    }
}
