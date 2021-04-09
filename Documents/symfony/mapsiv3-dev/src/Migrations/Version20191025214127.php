<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191025214127 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE jalon_connect_action DROP FOREIGN KEY FK_57AA6299395C3F3');
        $this->addSql('DROP INDEX IDX_57AA6299395C3F3 ON jalon_connect_action');
        $this->addSql('ALTER TABLE jalon_connect_action CHANGE customer_id mcustomer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE jalon_connect_action ADD CONSTRAINT FK_57AA629353AD996 FOREIGN KEY (mcustomer_id) REFERENCES mapsi_customer (id)');
        $this->addSql('CREATE INDEX IDX_57AA629353AD996 ON jalon_connect_action (mcustomer_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE jalon_connect_action DROP FOREIGN KEY FK_57AA629353AD996');
        $this->addSql('DROP INDEX IDX_57AA629353AD996 ON jalon_connect_action');
        $this->addSql('ALTER TABLE jalon_connect_action CHANGE mcustomer_id customer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE jalon_connect_action ADD CONSTRAINT FK_57AA6299395C3F3 FOREIGN KEY (customer_id) REFERENCES mapsi_customer (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_57AA6299395C3F3 ON jalon_connect_action (customer_id)');
    }
}
