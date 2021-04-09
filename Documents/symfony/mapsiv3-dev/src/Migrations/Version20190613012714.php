<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190613012714 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE application ADD customer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE application ADD CONSTRAINT FK_A45BDDC19395C3F3 FOREIGN KEY (customer_id) REFERENCES mapsi_customer (id)');
        $this->addSql('CREATE INDEX IDX_A45BDDC19395C3F3 ON application (customer_id)');
        $this->addSql('ALTER TABLE systeme ADD customer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE systeme ADD CONSTRAINT FK_95796DE39395C3F3 FOREIGN KEY (customer_id) REFERENCES mapsi_customer (id)');
        $this->addSql('CREATE INDEX IDX_95796DE39395C3F3 ON systeme (customer_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE application DROP FOREIGN KEY FK_A45BDDC19395C3F3');
        $this->addSql('DROP INDEX IDX_A45BDDC19395C3F3 ON application');
        $this->addSql('ALTER TABLE application DROP customer_id');
        $this->addSql('ALTER TABLE systeme DROP FOREIGN KEY FK_95796DE39395C3F3');
        $this->addSql('DROP INDEX IDX_95796DE39395C3F3 ON systeme');
        $this->addSql('ALTER TABLE systeme DROP customer_id');
    }
}
