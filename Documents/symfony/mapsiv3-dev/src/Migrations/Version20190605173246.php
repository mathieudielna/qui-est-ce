<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190605173246 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE flux ADD statutrgpd_id INT DEFAULT NULL, DROP statut');
        $this->addSql('ALTER TABLE flux ADD CONSTRAINT FK_7252313A6940FBF0 FOREIGN KEY (statutrgpd_id) REFERENCES type_statutrgpd (id)');
        $this->addSql('CREATE INDEX IDX_7252313A6940FBF0 ON flux (statutrgpd_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE flux DROP FOREIGN KEY FK_7252313A6940FBF0');
        $this->addSql('DROP INDEX IDX_7252313A6940FBF0 ON flux');
        $this->addSql('ALTER TABLE flux ADD statut VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, DROP statutrgpd_id');
    }
}
