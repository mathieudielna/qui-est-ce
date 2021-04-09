<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200218213314 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE type_dcpsensible ADD customer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE type_dcpsensible ADD CONSTRAINT FK_84D0E8DE9395C3F3 FOREIGN KEY (customer_id) REFERENCES mapsi_customer (id)');
        $this->addSql('CREATE INDEX IDX_84D0E8DE9395C3F3 ON type_dcpsensible (customer_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE type_dcpsensible DROP FOREIGN KEY FK_84D0E8DE9395C3F3');
        $this->addSql('DROP INDEX IDX_84D0E8DE9395C3F3 ON type_dcpsensible');
        $this->addSql('ALTER TABLE type_dcpsensible DROP customer_id');
    }
}
