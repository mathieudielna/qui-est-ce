<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200915152457 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE pca_evenement_chrono_prepa (id INT AUTO_INCREMENT NOT NULL, responsable_id INT DEFAULT NULL, customer_id INT NOT NULL, pcaevenement_id INT NOT NULL, tache VARCHAR(255) NOT NULL, targeted_at DATETIME DEFAULT NULL, comment VARCHAR(255) DEFAULT NULL, INDEX IDX_C69120B253C59D72 (responsable_id), INDEX IDX_C69120B29395C3F3 (customer_id), INDEX IDX_C69120B28653991E (pcaevenement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE pca_evenement_chrono_prepa ADD CONSTRAINT FK_C69120B253C59D72 FOREIGN KEY (responsable_id) REFERENCES people (id)');
        $this->addSql('ALTER TABLE pca_evenement_chrono_prepa ADD CONSTRAINT FK_C69120B29395C3F3 FOREIGN KEY (customer_id) REFERENCES mapsi_customer (id)');
        $this->addSql('ALTER TABLE pca_evenement_chrono_prepa ADD CONSTRAINT FK_C69120B28653991E FOREIGN KEY (pcaevenement_id) REFERENCES pca_evenement (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE pca_evenement_chrono_prepa');
    }
}
