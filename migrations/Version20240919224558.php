<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240919224558 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categoria (id INT AUTO_INCREMENT NOT NULL, torneo_id INT NOT NULL, genero_id INT NOT NULL, nombre VARCHAR(32) NOT NULL, descripcion VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', update_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', disputa LONGTEXT DEFAULT NULL, INDEX IDX_4E10122DA0139802 (torneo_id), INDEX IDX_4E10122DBCE7B795 (genero_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE genero (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE torneo (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(128) NOT NULL, descripcion VARCHAR(255) DEFAULT NULL, ruta VARCHAR(32) NOT NULL, fecha_inicio_torneo DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', fecha_fin_torneo DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', fecha_inicio_inscripcion DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', fecha_fin_inscripcion DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', reglamento LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE categoria ADD CONSTRAINT FK_4E10122DA0139802 FOREIGN KEY (torneo_id) REFERENCES torneo (id)');
        $this->addSql('ALTER TABLE categoria ADD CONSTRAINT FK_4E10122DBCE7B795 FOREIGN KEY (genero_id) REFERENCES genero (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categoria DROP FOREIGN KEY FK_4E10122DA0139802');
        $this->addSql('ALTER TABLE categoria DROP FOREIGN KEY FK_4E10122DBCE7B795');
        $this->addSql('DROP TABLE categoria');
        $this->addSql('DROP TABLE genero');
        $this->addSql('DROP TABLE torneo');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
