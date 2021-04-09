<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190604175650 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE systeme ADD typesystem_id INT DEFAULT NULL, DROP type_systeme');
        $this->addSql('ALTER TABLE systeme ADD CONSTRAINT FK_95796DE333AA4D39 FOREIGN KEY (typesystem_id) REFERENCES type_systeme (id)');
        $this->addSql('CREATE INDEX IDX_95796DE333AA4D39 ON systeme (typesystem_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE systeme DROP FOREIGN KEY FK_95796DE333AA4D39');
        $this->addSql('DROP INDEX IDX_95796DE333AA4D39 ON systeme');
        $this->addSql('ALTER TABLE systeme ADD type_systeme VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, DROP typesystem_id');
    }
}
