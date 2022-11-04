<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221103160313 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE student ADD classrooms_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF333F1EEE2A FOREIGN KEY (classrooms_id) REFERENCES classroom (id)');
        $this->addSql('CREATE INDEX IDX_B723AF333F1EEE2A ON student (classrooms_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF333F1EEE2A');
        $this->addSql('DROP INDEX IDX_B723AF333F1EEE2A ON student');
        $this->addSql('ALTER TABLE student DROP classrooms_id');
    }
}
