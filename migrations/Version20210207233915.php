<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210207233915 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE aluno (id INT AUTO_INCREMENT NOT NULL, nome VARCHAR(255) NOT NULL, cpf VARCHAR(11) DEFAULT NULL, data_nascimento DATETIME DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, sexo VARCHAR(1) NOT NULL, responsavel_proprio TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE colaborador (id INT AUTO_INCREMENT NOT NULL, funcao VARCHAR(255) NOT NULL, nome VARCHAR(255) NOT NULL, cpf VARCHAR(11) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE materia (id INT AUTO_INCREMENT NOT NULL, codigo VARCHAR(255) NOT NULL, nome VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE responsavel (id INT AUTO_INCREMENT NOT NULL, nome VARCHAR(255) NOT NULL, cpf VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, parentesco VARCHAR(1) NOT NULL, responsavel_financeiro TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE responsavel_aluno (responsavel_id INT NOT NULL, aluno_id INT NOT NULL, INDEX IDX_7DA319E7BB9AF004 (responsavel_id), INDEX IDX_7DA319E7B2DDF7F4 (aluno_id), PRIMARY KEY(responsavel_id, aluno_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE segmento (id INT AUTO_INCREMENT NOT NULL, nome VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE responsavel_aluno ADD CONSTRAINT FK_7DA319E7BB9AF004 FOREIGN KEY (responsavel_id) REFERENCES responsavel (id)');
        $this->addSql('ALTER TABLE responsavel_aluno ADD CONSTRAINT FK_7DA319E7B2DDF7F4 FOREIGN KEY (aluno_id) REFERENCES aluno (id)');
        $this->addSql('ALTER TABLE curso ADD segmento_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE curso ADD CONSTRAINT FK_CA3B40EC5502A33D FOREIGN KEY (segmento_id) REFERENCES segmento (id)');
        $this->addSql('CREATE INDEX IDX_CA3B40EC5502A33D ON curso (segmento_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE responsavel_aluno DROP FOREIGN KEY FK_7DA319E7B2DDF7F4');
        $this->addSql('ALTER TABLE responsavel_aluno DROP FOREIGN KEY FK_7DA319E7BB9AF004');
        $this->addSql('ALTER TABLE curso DROP FOREIGN KEY FK_CA3B40EC5502A33D');
        $this->addSql('DROP TABLE aluno');
        $this->addSql('DROP TABLE colaborador');
        $this->addSql('DROP TABLE materia');
        $this->addSql('DROP TABLE responsavel');
        $this->addSql('DROP TABLE responsavel_aluno');
        $this->addSql('DROP TABLE segmento');
        $this->addSql('DROP INDEX IDX_CA3B40EC5502A33D ON curso');
        $this->addSql('ALTER TABLE curso DROP segmento_id');
    }
}
