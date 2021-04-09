<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190523185643 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE activite_flux (activite_id INT NOT NULL, flux_id INT NOT NULL, INDEX IDX_58228489B0F88B1 (activite_id), INDEX IDX_5822848C85926E (flux_id), PRIMARY KEY(activite_id, flux_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE flux (id INT AUTO_INCREMENT NOT NULL, designation VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, finalite LONGTEXT DEFAULT NULL, statut VARCHAR(255) DEFAULT NULL, responsable VARCHAR(255) DEFAULT NULL, support VARCHAR(255) DEFAULT NULL, periodic VARCHAR(255) DEFAULT NULL, direction VARCHAR(255) DEFAULT NULL, criticite VARCHAR(255) DEFAULT NULL, dcp VARCHAR(255) DEFAULT NULL, dcpsensible VARCHAR(255) DEFAULT NULL, dureeconservation VARCHAR(255) DEFAULT NULL, transferthorsue VARCHAR(255) DEFAULT NULL, personneconcerne VARCHAR(255) DEFAULT NULL, juridique VARCHAR(255) DEFAULT NULL, accordcollecte VARCHAR(255) DEFAULT NULL, accordutilisation VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE activite_flux ADD CONSTRAINT FK_58228489B0F88B1 FOREIGN KEY (activite_id) REFERENCES activite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE activite_flux ADD CONSTRAINT FK_5822848C85926E FOREIGN KEY (flux_id) REFERENCES flux (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE activite_flux DROP FOREIGN KEY FK_5822848C85926E');
        $this->addSql('DROP TABLE activite_flux');
        $this->addSql('DROP TABLE flux');
    }
}
