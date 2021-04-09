<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190529002634 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE activite DROP impact4h, DROP impact1j, DROP impact3j, DROP impact1s, DROP impact2s, DROP impact1m');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE activite ADD impact4h VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD impact1j VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD impact3j VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD impact1s VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD impact2s VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD impact1m VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
    }
}
