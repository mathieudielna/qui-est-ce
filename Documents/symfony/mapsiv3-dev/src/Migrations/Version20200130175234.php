<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200130175234 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE systemestorage (systeme_id INT NOT NULL, storage_id INT NOT NULL, INDEX IDX_AC042812346F772E (systeme_id), INDEX IDX_AC0428125CC5DB90 (storage_id), PRIMARY KEY(systeme_id, storage_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE systemestorage ADD CONSTRAINT FK_AC042812346F772E FOREIGN KEY (systeme_id) REFERENCES systeme (id)');
        $this->addSql('ALTER TABLE systemestorage ADD CONSTRAINT FK_AC0428125CC5DB90 FOREIGN KEY (storage_id) REFERENCES systeme (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE systemestorage');
    }
}
