<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190523210310 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE activite ADD pdma_id INT DEFAULT NULL, DROP pdma');
        $this->addSql('ALTER TABLE activite ADD CONSTRAINT FK_B875551599597DA1 FOREIGN KEY (pdma_id) REFERENCES criticite (id)');
        $this->addSql('CREATE INDEX IDX_B875551599597DA1 ON activite (pdma_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE activite DROP FOREIGN KEY FK_B875551599597DA1');
        $this->addSql('DROP INDEX IDX_B875551599597DA1 ON activite');
        $this->addSql('ALTER TABLE activite ADD pdma VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, DROP pdma_id');
    }
}
