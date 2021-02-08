<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210207234712 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE aluno ADD instituicao_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE aluno ADD CONSTRAINT FK_67C97100B05E5EEA FOREIGN KEY (instituicao_id) REFERENCES instituicao (id)');
        $this->addSql('CREATE INDEX IDX_67C97100B05E5EEA ON aluno (instituicao_id)');
        $this->addSql('ALTER TABLE colaborador ADD instituicao_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE colaborador ADD CONSTRAINT FK_D2F80BB3B05E5EEA FOREIGN KEY (instituicao_id) REFERENCES instituicao (id)');
        $this->addSql('CREATE INDEX IDX_D2F80BB3B05E5EEA ON colaborador (instituicao_id)');
        $this->addSql('ALTER TABLE materia ADD instituicao_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE materia ADD CONSTRAINT FK_6DF05284B05E5EEA FOREIGN KEY (instituicao_id) REFERENCES instituicao (id)');
        $this->addSql('CREATE INDEX IDX_6DF05284B05E5EEA ON materia (instituicao_id)');
        $this->addSql('ALTER TABLE responsavel ADD instituicao_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE responsavel ADD CONSTRAINT FK_E1630546B05E5EEA FOREIGN KEY (instituicao_id) REFERENCES instituicao (id)');
        $this->addSql('CREATE INDEX IDX_E1630546B05E5EEA ON responsavel (instituicao_id)');
        $this->addSql('ALTER TABLE segmento ADD instituicao_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE segmento ADD CONSTRAINT FK_32CF8766B05E5EEA FOREIGN KEY (instituicao_id) REFERENCES instituicao (id)');
        $this->addSql('CREATE INDEX IDX_32CF8766B05E5EEA ON segmento (instituicao_id)');
        $this->addSql('ALTER TABLE turma ADD instituicao_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE turma ADD CONSTRAINT FK_2B0219A6B05E5EEA FOREIGN KEY (instituicao_id) REFERENCES instituicao (id)');
        $this->addSql('CREATE INDEX IDX_2B0219A6B05E5EEA ON turma (instituicao_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE aluno DROP FOREIGN KEY FK_67C97100B05E5EEA');
        $this->addSql('DROP INDEX IDX_67C97100B05E5EEA ON aluno');
        $this->addSql('ALTER TABLE aluno DROP instituicao_id');
        $this->addSql('ALTER TABLE colaborador DROP FOREIGN KEY FK_D2F80BB3B05E5EEA');
        $this->addSql('DROP INDEX IDX_D2F80BB3B05E5EEA ON colaborador');
        $this->addSql('ALTER TABLE colaborador DROP instituicao_id');
        $this->addSql('ALTER TABLE materia DROP FOREIGN KEY FK_6DF05284B05E5EEA');
        $this->addSql('DROP INDEX IDX_6DF05284B05E5EEA ON materia');
        $this->addSql('ALTER TABLE materia DROP instituicao_id');
        $this->addSql('ALTER TABLE responsavel DROP FOREIGN KEY FK_E1630546B05E5EEA');
        $this->addSql('DROP INDEX IDX_E1630546B05E5EEA ON responsavel');
        $this->addSql('ALTER TABLE responsavel DROP instituicao_id');
        $this->addSql('ALTER TABLE segmento DROP FOREIGN KEY FK_32CF8766B05E5EEA');
        $this->addSql('DROP INDEX IDX_32CF8766B05E5EEA ON segmento');
        $this->addSql('ALTER TABLE segmento DROP instituicao_id');
        $this->addSql('ALTER TABLE turma DROP FOREIGN KEY FK_2B0219A6B05E5EEA');
        $this->addSql('DROP INDEX IDX_2B0219A6B05E5EEA ON turma');
        $this->addSql('ALTER TABLE turma DROP instituicao_id');
    }
}
