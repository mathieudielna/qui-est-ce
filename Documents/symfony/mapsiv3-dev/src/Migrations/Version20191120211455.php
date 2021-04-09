<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191120211455 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE document');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE document (id INT AUTO_INCREMENT NOT NULL, customer_id INT DEFAULT NULL, action_id INT DEFAULT NULL, activite_id INT DEFAULT NULL, filename VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, folder VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, path VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, filesize VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, updated_at DATETIME NOT NULL, documentname VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, mimetype VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, INDEX IDX_D8698A769B0F88B1 (activite_id), INDEX IDX_D8698A769D32F035 (action_id), INDEX IDX_D8698A769395C3F3 (customer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A769395C3F3 FOREIGN KEY (customer_id) REFERENCES mapsi_customer (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A769B0F88B1 FOREIGN KEY (activite_id) REFERENCES activite (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A769D32F035 FOREIGN KEY (action_id) REFERENCES action (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}
