<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210131222549 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE instituicao (id INT AUTO_INCREMENT NOT NULL, cnpj VARCHAR(255) NOT NULL, razao_social VARCHAR(255) NOT NULL, nome_fantasia VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, senha VARCHAR(255) NOT NULL, enabled TINYINT(1) NOT NULL, confirmation_token VARCHAR(255) DEFAULT NULL, roles JSON NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_instituicao (user_id INT NOT NULL, instituicao_id INT NOT NULL, INDEX IDX_D5E446FCA76ED395 (user_id), INDEX IDX_D5E446FCB05E5EEA (instituicao_id), PRIMARY KEY(user_id, instituicao_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_instituicao ADD CONSTRAINT FK_D5E446FCA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_instituicao ADD CONSTRAINT FK_D5E446FCB05E5EEA FOREIGN KEY (instituicao_id) REFERENCES instituicao (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_instituicao DROP FOREIGN KEY FK_D5E446FCB05E5EEA');
        $this->addSql('ALTER TABLE user_instituicao DROP FOREIGN KEY FK_D5E446FCA76ED395');
        $this->addSql('DROP TABLE instituicao');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_instituicao');
    }
}
