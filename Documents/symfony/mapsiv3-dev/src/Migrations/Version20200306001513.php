<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200306001513 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE rgpd_access_flux (rgpd_access_id INT NOT NULL, flux_id INT NOT NULL, INDEX IDX_E884B7F68C8118C3 (rgpd_access_id), INDEX IDX_E884B7F6C85926E (flux_id), PRIMARY KEY(rgpd_access_id, flux_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE rgpd_access_flux ADD CONSTRAINT FK_E884B7F68C8118C3 FOREIGN KEY (rgpd_access_id) REFERENCES rgpd_access (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE rgpd_access_flux ADD CONSTRAINT FK_E884B7F6C85926E FOREIGN KEY (flux_id) REFERENCES flux (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE rgpd_access_flux');
    }
}
