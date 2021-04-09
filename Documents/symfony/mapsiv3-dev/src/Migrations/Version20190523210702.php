<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190523210702 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE activite ADD dima_id INT DEFAULT NULL, DROP dima');
        $this->addSql('ALTER TABLE activite ADD CONSTRAINT FK_B8755515B656D6A2 FOREIGN KEY (dima_id) REFERENCES criticite (id)');
        $this->addSql('CREATE INDEX IDX_B8755515B656D6A2 ON activite (dima_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE activite DROP FOREIGN KEY FK_B8755515B656D6A2');
        $this->addSql('DROP INDEX IDX_B8755515B656D6A2 ON activite');
        $this->addSql('ALTER TABLE activite ADD dima VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, DROP dima_id');
    }
}
