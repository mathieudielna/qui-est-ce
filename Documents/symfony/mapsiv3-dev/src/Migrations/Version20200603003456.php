<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200603003456 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE mapsi_customer ADD dpo_id INT DEFAULT NULL, ADD telephone VARCHAR(255) DEFAULT NULL, ADD email VARCHAR(255) DEFAULT NULL, ADD adresse1 VARCHAR(255) DEFAULT NULL, ADD adresse2 VARCHAR(255) DEFAULT NULL, ADD adresse3 VARCHAR(255) DEFAULT NULL, ADD codepostal VARCHAR(255) DEFAULT NULL, ADD ville VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE mapsi_customer ADD CONSTRAINT FK_1E71C0152130F757 FOREIGN KEY (dpo_id) REFERENCES people (id)');
        $this->addSql('CREATE INDEX IDX_1E71C0152130F757 ON mapsi_customer (dpo_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE mapsi_customer DROP FOREIGN KEY FK_1E71C0152130F757');
        $this->addSql('DROP INDEX IDX_1E71C0152130F757 ON mapsi_customer');
        $this->addSql('ALTER TABLE mapsi_customer DROP dpo_id, DROP telephone, DROP email, DROP adresse1, DROP adresse2, DROP adresse3, DROP codepostal, DROP ville');
    }
}
