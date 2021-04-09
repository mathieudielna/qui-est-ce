<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210328215147 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE visite_site ADD redacteur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE visite_site ADD CONSTRAINT FK_E432A655764D0490 FOREIGN KEY (redacteur_id) REFERENCES people (id)');
        $this->addSql('CREATE INDEX IDX_E432A655764D0490 ON visite_site (redacteur_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE visite_site DROP FOREIGN KEY FK_E432A655764D0490');
        $this->addSql('DROP INDEX IDX_E432A655764D0490 ON visite_site');
        $this->addSql('ALTER TABLE visite_site DROP redacteur_id');
    }
}
