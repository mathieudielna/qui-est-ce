<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200528180624 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE anomalie (id INT AUTO_INCREMENT NOT NULL, responsable_id INT DEFAULT NULL, suppleant_id INT DEFAULT NULL, statut_id INT DEFAULT NULL, customer_id INT DEFAULT NULL, designation VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, published_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, commentaire LONGTEXT DEFAULT NULL, INDEX IDX_715AA19C53C59D72 (responsable_id), INDEX IDX_715AA19C67A3C51B (suppleant_id), INDEX IDX_715AA19CF6203804 (statut_id), INDEX IDX_715AA19C9395C3F3 (customer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE anomalie_processus (anomalie_id INT NOT NULL, processus_id INT NOT NULL, INDEX IDX_5C7E759AEEAB197 (anomalie_id), INDEX IDX_5C7E759A55629DC (processus_id), PRIMARY KEY(anomalie_id, processus_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE anomalie_activite (anomalie_id INT NOT NULL, activite_id INT NOT NULL, INDEX IDX_9B282ED0AEEAB197 (anomalie_id), INDEX IDX_9B282ED09B0F88B1 (activite_id), PRIMARY KEY(anomalie_id, activite_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE anomalie_application (anomalie_id INT NOT NULL, application_id INT NOT NULL, INDEX IDX_EA2E043DAEEAB197 (anomalie_id), INDEX IDX_EA2E043D3E030ACD (application_id), PRIMARY KEY(anomalie_id, application_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE anomalie ADD CONSTRAINT FK_715AA19C53C59D72 FOREIGN KEY (responsable_id) REFERENCES people (id)');
        $this->addSql('ALTER TABLE anomalie ADD CONSTRAINT FK_715AA19C67A3C51B FOREIGN KEY (suppleant_id) REFERENCES people (id)');
        $this->addSql('ALTER TABLE anomalie ADD CONSTRAINT FK_715AA19CF6203804 FOREIGN KEY (statut_id) REFERENCES type_statut (id)');
        $this->addSql('ALTER TABLE anomalie ADD CONSTRAINT FK_715AA19C9395C3F3 FOREIGN KEY (customer_id) REFERENCES mapsi_customer (id)');
        $this->addSql('ALTER TABLE anomalie_processus ADD CONSTRAINT FK_5C7E759AEEAB197 FOREIGN KEY (anomalie_id) REFERENCES anomalie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE anomalie_processus ADD CONSTRAINT FK_5C7E759A55629DC FOREIGN KEY (processus_id) REFERENCES processus (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE anomalie_activite ADD CONSTRAINT FK_9B282ED0AEEAB197 FOREIGN KEY (anomalie_id) REFERENCES anomalie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE anomalie_activite ADD CONSTRAINT FK_9B282ED09B0F88B1 FOREIGN KEY (activite_id) REFERENCES activite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE anomalie_application ADD CONSTRAINT FK_EA2E043DAEEAB197 FOREIGN KEY (anomalie_id) REFERENCES anomalie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE anomalie_application ADD CONSTRAINT FK_EA2E043D3E030ACD FOREIGN KEY (application_id) REFERENCES application (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE anomalie_processus DROP FOREIGN KEY FK_5C7E759AEEAB197');
        $this->addSql('ALTER TABLE anomalie_activite DROP FOREIGN KEY FK_9B282ED0AEEAB197');
        $this->addSql('ALTER TABLE anomalie_application DROP FOREIGN KEY FK_EA2E043DAEEAB197');
        $this->addSql('DROP TABLE anomalie');
        $this->addSql('DROP TABLE anomalie_processus');
        $this->addSql('DROP TABLE anomalie_activite');
        $this->addSql('DROP TABLE anomalie_application');
    }
}
