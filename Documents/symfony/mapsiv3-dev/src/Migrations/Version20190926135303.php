<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190926135303 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE type_om (id INT AUTO_INCREMENT NOT NULL, designation VARCHAR(255) NOT NULL, couleur VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE objet_metier ADD type_id INT DEFAULT NULL, ADD dcp_id INT DEFAULT NULL, ADD dcpsensible_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE objet_metier ADD CONSTRAINT FK_E47FE0A6C54C8C93 FOREIGN KEY (type_id) REFERENCES type_om (id)');
        $this->addSql('ALTER TABLE objet_metier ADD CONSTRAINT FK_E47FE0A6E0A5DCC FOREIGN KEY (dcp_id) REFERENCES oui_non (id)');
        $this->addSql('ALTER TABLE objet_metier ADD CONSTRAINT FK_E47FE0A6A7E15F2A FOREIGN KEY (dcpsensible_id) REFERENCES oui_non (id)');
        $this->addSql('CREATE INDEX IDX_E47FE0A6C54C8C93 ON objet_metier (type_id)');
        $this->addSql('CREATE INDEX IDX_E47FE0A6E0A5DCC ON objet_metier (dcp_id)');
        $this->addSql('CREATE INDEX IDX_E47FE0A6A7E15F2A ON objet_metier (dcpsensible_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE objet_metier DROP FOREIGN KEY FK_E47FE0A6C54C8C93');
        $this->addSql('DROP TABLE type_om');
        $this->addSql('ALTER TABLE objet_metier DROP FOREIGN KEY FK_E47FE0A6E0A5DCC');
        $this->addSql('ALTER TABLE objet_metier DROP FOREIGN KEY FK_E47FE0A6A7E15F2A');
        $this->addSql('DROP INDEX IDX_E47FE0A6C54C8C93 ON objet_metier');
        $this->addSql('DROP INDEX IDX_E47FE0A6E0A5DCC ON objet_metier');
        $this->addSql('DROP INDEX IDX_E47FE0A6A7E15F2A ON objet_metier');
        $this->addSql('ALTER TABLE objet_metier DROP type_id, DROP dcp_id, DROP dcpsensible_id');
    }
}
