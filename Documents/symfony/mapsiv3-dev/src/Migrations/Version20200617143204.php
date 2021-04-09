<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200617143204 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE pca_evenement_app_track ADD statut_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pca_evenement_app_track ADD CONSTRAINT FK_2E608B94F6203804 FOREIGN KEY (statut_id) REFERENCES type_statut_pca (id)');
        $this->addSql('CREATE INDEX IDX_2E608B94F6203804 ON pca_evenement_app_track (statut_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE pca_evenement_app_track DROP FOREIGN KEY FK_2E608B94F6203804');
        $this->addSql('DROP INDEX IDX_2E608B94F6203804 ON pca_evenement_app_track');
        $this->addSql('ALTER TABLE pca_evenement_app_track DROP statut_id');
    }
}
