<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190912191115 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE aluno (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, proj_id INTEGER DEFAULT NULL, nome VARCHAR(255) NOT NULL, bolsista BOOLEAN NOT NULL)');
        $this->addSql('CREATE INDEX IDX_67C97100E1174846 ON aluno (proj_id)');
        $this->addSql('CREATE TABLE professor (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nome VARCHAR(255) NOT NULL, projeto_status VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE projeto (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, professor_id INTEGER DEFAULT NULL, nome VARCHAR(255) NOT NULL, status BOOLEAN NOT NULL)');
        $this->addSql('CREATE INDEX IDX_A0559D947D2D84D5 ON projeto (professor_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE aluno');
        $this->addSql('DROP TABLE professor');
        $this->addSql('DROP TABLE projeto');
    }
}
