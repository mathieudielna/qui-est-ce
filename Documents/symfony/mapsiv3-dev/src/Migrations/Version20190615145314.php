<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190615145314 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE type_dcpjuridique ADD customer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE type_dcpjuridique ADD CONSTRAINT FK_817326E59395C3F3 FOREIGN KEY (customer_id) REFERENCES mapsi_customer (id)');
        $this->addSql('CREATE INDEX IDX_817326E59395C3F3 ON type_dcpjuridique (customer_id)');
        $this->addSql('ALTER TABLE type_direction ADD customer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE type_direction ADD CONSTRAINT FK_8A8C90A39395C3F3 FOREIGN KEY (customer_id) REFERENCES mapsi_customer (id)');
        $this->addSql('CREATE INDEX IDX_8A8C90A39395C3F3 ON type_direction (customer_id)');
        $this->addSql('ALTER TABLE type_duree ADD customer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE type_duree ADD CONSTRAINT FK_8A5A47C29395C3F3 FOREIGN KEY (customer_id) REFERENCES mapsi_customer (id)');
        $this->addSql('CREATE INDEX IDX_8A5A47C29395C3F3 ON type_duree (customer_id)');
        $this->addSql('ALTER TABLE type_statutrgpd ADD customer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE type_statutrgpd ADD CONSTRAINT FK_F42DF5749395C3F3 FOREIGN KEY (customer_id) REFERENCES mapsi_customer (id)');
        $this->addSql('CREATE INDEX IDX_F42DF5749395C3F3 ON type_statutrgpd (customer_id)');
        $this->addSql('ALTER TABLE type_support ADD customer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE type_support ADD CONSTRAINT FK_A82584509395C3F3 FOREIGN KEY (customer_id) REFERENCES mapsi_customer (id)');
        $this->addSql('CREATE INDEX IDX_A82584509395C3F3 ON type_support (customer_id)');
        $this->addSql('ALTER TABLE type_periodicite ADD customer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE type_periodicite ADD CONSTRAINT FK_9A244E629395C3F3 FOREIGN KEY (customer_id) REFERENCES mapsi_customer (id)');
        $this->addSql('CREATE INDEX IDX_9A244E629395C3F3 ON type_periodicite (customer_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE type_dcpjuridique DROP FOREIGN KEY FK_817326E59395C3F3');
        $this->addSql('DROP INDEX IDX_817326E59395C3F3 ON type_dcpjuridique');
        $this->addSql('ALTER TABLE type_dcpjuridique DROP customer_id');
        $this->addSql('ALTER TABLE type_direction DROP FOREIGN KEY FK_8A8C90A39395C3F3');
        $this->addSql('DROP INDEX IDX_8A8C90A39395C3F3 ON type_direction');
        $this->addSql('ALTER TABLE type_direction DROP customer_id');
        $this->addSql('ALTER TABLE type_duree DROP FOREIGN KEY FK_8A5A47C29395C3F3');
        $this->addSql('DROP INDEX IDX_8A5A47C29395C3F3 ON type_duree');
        $this->addSql('ALTER TABLE type_duree DROP customer_id');
        $this->addSql('ALTER TABLE type_periodicite DROP FOREIGN KEY FK_9A244E629395C3F3');
        $this->addSql('DROP INDEX IDX_9A244E629395C3F3 ON type_periodicite');
        $this->addSql('ALTER TABLE type_periodicite DROP customer_id');
        $this->addSql('ALTER TABLE type_statutrgpd DROP FOREIGN KEY FK_F42DF5749395C3F3');
        $this->addSql('DROP INDEX IDX_F42DF5749395C3F3 ON type_statutrgpd');
        $this->addSql('ALTER TABLE type_statutrgpd DROP customer_id');
        $this->addSql('ALTER TABLE type_support DROP FOREIGN KEY FK_A82584509395C3F3');
        $this->addSql('DROP INDEX IDX_A82584509395C3F3 ON type_support');
        $this->addSql('ALTER TABLE type_support DROP customer_id');
    }
}
