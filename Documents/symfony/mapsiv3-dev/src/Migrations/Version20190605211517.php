<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190605211517 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE flux ADD transferthorsue_id INT DEFAULT NULL, DROP transferthorsue');
        $this->addSql('ALTER TABLE flux ADD CONSTRAINT FK_7252313A40C98E88 FOREIGN KEY (transferthorsue_id) REFERENCES oui_non (id)');
        $this->addSql('CREATE INDEX IDX_7252313A40C98E88 ON flux (transferthorsue_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE flux DROP FOREIGN KEY FK_7252313A40C98E88');
        $this->addSql('DROP INDEX IDX_7252313A40C98E88 ON flux');
        $this->addSql('ALTER TABLE flux ADD transferthorsue VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, DROP transferthorsue_id');
    }
}
