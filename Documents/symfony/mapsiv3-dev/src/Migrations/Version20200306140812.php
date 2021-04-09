<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200306140812 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE rgpd_audit ADD statut_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rgpd_audit ADD CONSTRAINT FK_537F9A9EF6203804 FOREIGN KEY (statut_id) REFERENCES type_statut (id)');
        $this->addSql('CREATE INDEX IDX_537F9A9EF6203804 ON rgpd_audit (statut_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE rgpd_audit DROP FOREIGN KEY FK_537F9A9EF6203804');
        $this->addSql('DROP INDEX IDX_537F9A9EF6203804 ON rgpd_audit');
        $this->addSql('ALTER TABLE rgpd_audit DROP statut_id');
    }
}
