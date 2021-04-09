<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190909004423 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE risque ADD projet_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE risque ADD CONSTRAINT FK_20230D24C18272 FOREIGN KEY (projet_id) REFERENCES projet (id)');
        $this->addSql('CREATE INDEX IDX_20230D24C18272 ON risque (projet_id)');
        $this->addSql('ALTER TABLE projet ADD prerequis LONGTEXT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE projet DROP prerequis');
        $this->addSql('ALTER TABLE risque DROP FOREIGN KEY FK_20230D24C18272');
        $this->addSql('DROP INDEX IDX_20230D24C18272 ON risque');
        $this->addSql('ALTER TABLE risque DROP projet_id');
    }
}
