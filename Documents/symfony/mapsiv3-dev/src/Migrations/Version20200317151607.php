<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200317151607 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE objet_metier_data (objet_metier_id INT NOT NULL, data_id INT NOT NULL, INDEX IDX_BC71B1F325707B47 (objet_metier_id), INDEX IDX_BC71B1F337F5A13C (data_id), PRIMARY KEY(objet_metier_id, data_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE objet_metier_data ADD CONSTRAINT FK_BC71B1F325707B47 FOREIGN KEY (objet_metier_id) REFERENCES objet_metier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE objet_metier_data ADD CONSTRAINT FK_BC71B1F337F5A13C FOREIGN KEY (data_id) REFERENCES data (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE objet_metier_data');
    }
}
