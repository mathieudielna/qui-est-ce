<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190613013510 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE action ADD customer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE action ADD CONSTRAINT FK_47CC8C929395C3F3 FOREIGN KEY (customer_id) REFERENCES mapsi_customer (id)');
        $this->addSql('CREATE INDEX IDX_47CC8C929395C3F3 ON action (customer_id)');
        $this->addSql('ALTER TABLE risque ADD customer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE risque ADD CONSTRAINT FK_20230D249395C3F3 FOREIGN KEY (customer_id) REFERENCES mapsi_customer (id)');
        $this->addSql('CREATE INDEX IDX_20230D249395C3F3 ON risque (customer_id)');
        $this->addSql('ALTER TABLE tier ADD customer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tier ADD CONSTRAINT FK_249E978A9395C3F3 FOREIGN KEY (customer_id) REFERENCES mapsi_customer (id)');
        $this->addSql('CREATE INDEX IDX_249E978A9395C3F3 ON tier (customer_id)');
        $this->addSql('ALTER TABLE ressource ADD customer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ressource ADD CONSTRAINT FK_939F45449395C3F3 FOREIGN KEY (customer_id) REFERENCES mapsi_customer (id)');
        $this->addSql('CREATE INDEX IDX_939F45449395C3F3 ON ressource (customer_id)');
        $this->addSql('ALTER TABLE people ADD customer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE people ADD CONSTRAINT FK_28166A269395C3F3 FOREIGN KEY (customer_id) REFERENCES mapsi_customer (id)');
        $this->addSql('CREATE INDEX IDX_28166A269395C3F3 ON people (customer_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE action DROP FOREIGN KEY FK_47CC8C929395C3F3');
        $this->addSql('DROP INDEX IDX_47CC8C929395C3F3 ON action');
        $this->addSql('ALTER TABLE action DROP customer_id');
        $this->addSql('ALTER TABLE people DROP FOREIGN KEY FK_28166A269395C3F3');
        $this->addSql('DROP INDEX IDX_28166A269395C3F3 ON people');
        $this->addSql('ALTER TABLE people DROP customer_id');
        $this->addSql('ALTER TABLE ressource DROP FOREIGN KEY FK_939F45449395C3F3');
        $this->addSql('DROP INDEX IDX_939F45449395C3F3 ON ressource');
        $this->addSql('ALTER TABLE ressource DROP customer_id');
        $this->addSql('ALTER TABLE risque DROP FOREIGN KEY FK_20230D249395C3F3');
        $this->addSql('DROP INDEX IDX_20230D249395C3F3 ON risque');
        $this->addSql('ALTER TABLE risque DROP customer_id');
        $this->addSql('ALTER TABLE tier DROP FOREIGN KEY FK_249E978A9395C3F3');
        $this->addSql('DROP INDEX IDX_249E978A9395C3F3 ON tier');
        $this->addSql('ALTER TABLE tier DROP customer_id');
    }
}
