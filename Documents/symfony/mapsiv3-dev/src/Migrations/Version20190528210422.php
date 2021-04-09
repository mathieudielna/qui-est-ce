<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190528210422 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE activite ADD impactimg_id INT DEFAULT NULL, DROP impactimg');
        $this->addSql('ALTER TABLE activite ADD CONSTRAINT FK_B8755515DFD43620 FOREIGN KEY (impactimg_id) REFERENCES niveau_impact (id)');
        $this->addSql('CREATE INDEX IDX_B8755515DFD43620 ON activite (impactimg_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE activite DROP FOREIGN KEY FK_B8755515DFD43620');
        $this->addSql('DROP INDEX IDX_B8755515DFD43620 ON activite');
        $this->addSql('ALTER TABLE activite ADD impactimg VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, DROP impactimg_id');
    }
}
