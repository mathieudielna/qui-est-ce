<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190615155628 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE type_plateforme ADD customer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE type_plateforme ADD CONSTRAINT FK_2101DA349395C3F3 FOREIGN KEY (customer_id) REFERENCES mapsi_customer (id)');
        $this->addSql('CREATE INDEX IDX_2101DA349395C3F3 ON type_plateforme (customer_id)');
        $this->addSql('ALTER TABLE type_systeme ADD customer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE type_systeme ADD CONSTRAINT FK_BD5802169395C3F3 FOREIGN KEY (customer_id) REFERENCES mapsi_customer (id)');
        $this->addSql('CREATE INDEX IDX_BD5802169395C3F3 ON type_systeme (customer_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE type_plateforme DROP FOREIGN KEY FK_2101DA349395C3F3');
        $this->addSql('DROP INDEX IDX_2101DA349395C3F3 ON type_plateforme');
        $this->addSql('ALTER TABLE type_plateforme DROP customer_id');
        $this->addSql('ALTER TABLE type_systeme DROP FOREIGN KEY FK_BD5802169395C3F3');
        $this->addSql('DROP INDEX IDX_BD5802169395C3F3 ON type_systeme');
        $this->addSql('ALTER TABLE type_systeme DROP customer_id');
    }
}
