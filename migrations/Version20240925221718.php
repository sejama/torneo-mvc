<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240925221718 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE torneo ADD usuario_id INT NOT NULL');
        $this->addSql('ALTER TABLE torneo ADD CONSTRAINT FK_7CEB63FEDB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id)');
        $this->addSql('CREATE INDEX IDX_7CEB63FEDB38439E ON torneo (usuario_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE torneo DROP FOREIGN KEY FK_7CEB63FEDB38439E');
        $this->addSql('DROP INDEX IDX_7CEB63FEDB38439E ON torneo');
        $this->addSql('ALTER TABLE torneo DROP usuario_id');
    }
}
