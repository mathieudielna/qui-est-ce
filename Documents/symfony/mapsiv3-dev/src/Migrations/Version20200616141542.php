<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200616141542 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE pca_evenement_app_track DROP FOREIGN KEY FK_2E608B942BB3B2B1');
        $this->addSql('DROP INDEX IDX_2E608B942BB3B2B1 ON pca_evenement_app_track');
        $this->addSql('ALTER TABLE pca_evenement_app_track DROP pca_evenement_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE pca_evenement_app_track ADD pca_evenement_id INT NOT NULL');
        $this->addSql('ALTER TABLE pca_evenement_app_track ADD CONSTRAINT FK_2E608B942BB3B2B1 FOREIGN KEY (pca_evenement_id) REFERENCES pca_evenement (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_2E608B942BB3B2B1 ON pca_evenement_app_track (pca_evenement_id)');
    }
}
