<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190613012313 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE objet_metier ADD customer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE objet_metier ADD CONSTRAINT FK_E47FE0A69395C3F3 FOREIGN KEY (customer_id) REFERENCES mapsi_customer (id)');
        $this->addSql('CREATE INDEX IDX_E47FE0A69395C3F3 ON objet_metier (customer_id)');
        $this->addSql('ALTER TABLE site ADD customer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE site ADD CONSTRAINT FK_694309E49395C3F3 FOREIGN KEY (customer_id) REFERENCES mapsi_customer (id)');
        $this->addSql('CREATE INDEX IDX_694309E49395C3F3 ON site (customer_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE objet_metier DROP FOREIGN KEY FK_E47FE0A69395C3F3');
        $this->addSql('DROP INDEX IDX_E47FE0A69395C3F3 ON objet_metier');
        $this->addSql('ALTER TABLE objet_metier DROP customer_id');
        $this->addSql('ALTER TABLE site DROP FOREIGN KEY FK_694309E49395C3F3');
        $this->addSql('DROP INDEX IDX_694309E49395C3F3 ON site');
        $this->addSql('ALTER TABLE site DROP customer_id');
    }
}
