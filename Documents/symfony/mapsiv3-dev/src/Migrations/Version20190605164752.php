<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190605164752 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE flux ADD responsable_id INT DEFAULT NULL, DROP responsable');
        $this->addSql('ALTER TABLE flux ADD CONSTRAINT FK_7252313A53C59D72 FOREIGN KEY (responsable_id) REFERENCES people (id)');
        $this->addSql('CREATE INDEX IDX_7252313A53C59D72 ON flux (responsable_id)');
        $this->addSql('ALTER TABLE systeme DROP published_at');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE flux DROP FOREIGN KEY FK_7252313A53C59D72');
        $this->addSql('DROP INDEX IDX_7252313A53C59D72 ON flux');
        $this->addSql('ALTER TABLE flux ADD responsable VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, DROP responsable_id');
        $this->addSql('ALTER TABLE systeme ADD published_at DATETIME NOT NULL');
    }
}
