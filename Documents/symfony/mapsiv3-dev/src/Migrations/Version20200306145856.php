<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200306145856 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE rgpd_audit_tier (rgpd_audit_id INT NOT NULL, tier_id INT NOT NULL, INDEX IDX_B4B5EDADAD85EA4 (rgpd_audit_id), INDEX IDX_B4B5EDAA354F9DC (tier_id), PRIMARY KEY(rgpd_audit_id, tier_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE rgpd_audit_tier ADD CONSTRAINT FK_B4B5EDADAD85EA4 FOREIGN KEY (rgpd_audit_id) REFERENCES rgpd_audit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE rgpd_audit_tier ADD CONSTRAINT FK_B4B5EDAA354F9DC FOREIGN KEY (tier_id) REFERENCES tier (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE rgpd_audit_tier');
    }
}
