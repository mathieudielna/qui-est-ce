<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200601153753 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE pca_evenement_people (pca_evenement_id INT NOT NULL, people_id INT NOT NULL, INDEX IDX_FB999C3C2BB3B2B1 (pca_evenement_id), INDEX IDX_FB999C3C3147C936 (people_id), PRIMARY KEY(pca_evenement_id, people_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE pca_evenement_people ADD CONSTRAINT FK_FB999C3C2BB3B2B1 FOREIGN KEY (pca_evenement_id) REFERENCES pca_evenement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pca_evenement_people ADD CONSTRAINT FK_FB999C3C3147C936 FOREIGN KEY (people_id) REFERENCES people (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pca_evenement ADD responsable_id INT DEFAULT NULL, ADD suppleant_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pca_evenement ADD CONSTRAINT FK_DE266C7353C59D72 FOREIGN KEY (responsable_id) REFERENCES people (id)');
        $this->addSql('ALTER TABLE pca_evenement ADD CONSTRAINT FK_DE266C7367A3C51B FOREIGN KEY (suppleant_id) REFERENCES people (id)');
        $this->addSql('CREATE INDEX IDX_DE266C7353C59D72 ON pca_evenement (responsable_id)');
        $this->addSql('CREATE INDEX IDX_DE266C7367A3C51B ON pca_evenement (suppleant_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE pca_evenement_people');
        $this->addSql('ALTER TABLE pca_evenement DROP FOREIGN KEY FK_DE266C7353C59D72');
        $this->addSql('ALTER TABLE pca_evenement DROP FOREIGN KEY FK_DE266C7367A3C51B');
        $this->addSql('DROP INDEX IDX_DE266C7353C59D72 ON pca_evenement');
        $this->addSql('DROP INDEX IDX_DE266C7367A3C51B ON pca_evenement');
        $this->addSql('ALTER TABLE pca_evenement DROP responsable_id, DROP suppleant_id');
    }
}
