<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190615151923 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE type_acteur ADD customer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE type_acteur ADD CONSTRAINT FK_C92DB85A9395C3F3 FOREIGN KEY (customer_id) REFERENCES mapsi_customer (id)');
        $this->addSql('CREATE INDEX IDX_C92DB85A9395C3F3 ON type_acteur (customer_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE type_acteur DROP FOREIGN KEY FK_C92DB85A9395C3F3');
        $this->addSql('DROP INDEX IDX_C92DB85A9395C3F3 ON type_acteur');
        $this->addSql('ALTER TABLE type_acteur DROP customer_id');
    }
}
