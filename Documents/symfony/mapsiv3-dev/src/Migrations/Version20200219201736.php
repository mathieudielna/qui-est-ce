<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200219201736 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE rgpd_violation ADD statut_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rgpd_violation ADD CONSTRAINT FK_24D13BEEF6203804 FOREIGN KEY (statut_id) REFERENCES type_statut (id)');
        $this->addSql('CREATE INDEX IDX_24D13BEEF6203804 ON rgpd_violation (statut_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE rgpd_violation DROP FOREIGN KEY FK_24D13BEEF6203804');
        $this->addSql('DROP INDEX IDX_24D13BEEF6203804 ON rgpd_violation');
        $this->addSql('ALTER TABLE rgpd_violation DROP statut_id');
    }
}
