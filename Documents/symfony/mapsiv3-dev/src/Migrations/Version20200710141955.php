<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200710141955 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE mapsi_customer ADD rse_id INT DEFAULT NULL, ADD responsable_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE mapsi_customer ADD CONSTRAINT FK_1E71C015DCA28C65 FOREIGN KEY (rse_id) REFERENCES people (id)');
        $this->addSql('ALTER TABLE mapsi_customer ADD CONSTRAINT FK_1E71C01553C59D72 FOREIGN KEY (responsable_id) REFERENCES people (id)');
        $this->addSql('CREATE INDEX IDX_1E71C015DCA28C65 ON mapsi_customer (rse_id)');
        $this->addSql('CREATE INDEX IDX_1E71C01553C59D72 ON mapsi_customer (responsable_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE mapsi_customer DROP FOREIGN KEY FK_1E71C015DCA28C65');
        $this->addSql('ALTER TABLE mapsi_customer DROP FOREIGN KEY FK_1E71C01553C59D72');
        $this->addSql('DROP INDEX IDX_1E71C015DCA28C65 ON mapsi_customer');
        $this->addSql('DROP INDEX IDX_1E71C01553C59D72 ON mapsi_customer');
        $this->addSql('ALTER TABLE mapsi_customer DROP rse_id, DROP responsable_id');
    }
}
