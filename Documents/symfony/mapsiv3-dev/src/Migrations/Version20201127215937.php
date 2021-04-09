<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201127215937 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE impact ADD customer_id INT NOT NULL, ADD gravite VARCHAR(255) NOT NULL, ADD probabilite VARCHAR(255) NOT NULL, ADD sensibilite VARCHAR(255) NOT NULL, ADD maitrise VARCHAR(255) NOT NULL, ADD criticite VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE impact ADD CONSTRAINT FK_C409C0079395C3F3 FOREIGN KEY (customer_id) REFERENCES mapsi_customer (id)');
        $this->addSql('CREATE INDEX IDX_C409C0079395C3F3 ON impact (customer_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE impact DROP FOREIGN KEY FK_C409C0079395C3F3');
        $this->addSql('DROP INDEX IDX_C409C0079395C3F3 ON impact');
        $this->addSql('ALTER TABLE impact DROP customer_id, DROP gravite, DROP probabilite, DROP sensibilite, DROP maitrise, DROP criticite');
    }
}
