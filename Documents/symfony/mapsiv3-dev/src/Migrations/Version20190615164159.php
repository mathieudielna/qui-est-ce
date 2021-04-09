<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190615164159 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE type_action ADD customer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE type_action ADD CONSTRAINT FK_641BE7AA9395C3F3 FOREIGN KEY (customer_id) REFERENCES mapsi_customer (id)');
        $this->addSql('CREATE INDEX IDX_641BE7AA9395C3F3 ON type_action (customer_id)');
        $this->addSql('ALTER TABLE type_statut ADD customer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE type_statut ADD CONSTRAINT FK_C6B39B879395C3F3 FOREIGN KEY (customer_id) REFERENCES mapsi_customer (id)');
        $this->addSql('CREATE INDEX IDX_C6B39B879395C3F3 ON type_statut (customer_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE type_action DROP FOREIGN KEY FK_641BE7AA9395C3F3');
        $this->addSql('DROP INDEX IDX_641BE7AA9395C3F3 ON type_action');
        $this->addSql('ALTER TABLE type_action DROP customer_id');
        $this->addSql('ALTER TABLE type_statut DROP FOREIGN KEY FK_C6B39B879395C3F3');
        $this->addSql('DROP INDEX IDX_C6B39B879395C3F3 ON type_statut');
        $this->addSql('ALTER TABLE type_statut DROP customer_id');
    }
}
