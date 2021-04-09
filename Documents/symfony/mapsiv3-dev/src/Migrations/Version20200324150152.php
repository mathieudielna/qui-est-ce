<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200324150152 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE pca_evenement (id INT AUTO_INCREMENT NOT NULL, customer_id INT DEFAULT NULL, responsable_id INT DEFAULT NULL, suppleant_id INT DEFAULT NULL, designation VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, created_at DATETIME DEFAULT NULL, published_at DATETIME DEFAULT NULL, closed_at DATETIME DEFAULT NULL, start_at DATETIME DEFAULT NULL, finish_at DATETIME DEFAULT NULL, INDEX IDX_DE266C739395C3F3 (customer_id), INDEX IDX_DE266C7353C59D72 (responsable_id), INDEX IDX_DE266C7367A3C51B (suppleant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pca_evenement_systeme (pca_evenement_id INT NOT NULL, systeme_id INT NOT NULL, INDEX IDX_68C81B6F2BB3B2B1 (pca_evenement_id), INDEX IDX_68C81B6F346F772E (systeme_id), PRIMARY KEY(pca_evenement_id, systeme_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pca_evenement_application (pca_evenement_id INT NOT NULL, application_id INT NOT NULL, INDEX IDX_6D7AD1F82BB3B2B1 (pca_evenement_id), INDEX IDX_6D7AD1F83E030ACD (application_id), PRIMARY KEY(pca_evenement_id, application_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pca_evenement_activite (pca_evenement_id INT NOT NULL, activite_id INT NOT NULL, INDEX IDX_5C862B682BB3B2B1 (pca_evenement_id), INDEX IDX_5C862B689B0F88B1 (activite_id), PRIMARY KEY(pca_evenement_id, activite_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pca_evenement_people (pca_evenement_id INT NOT NULL, people_id INT NOT NULL, INDEX IDX_FB999C3C2BB3B2B1 (pca_evenement_id), INDEX IDX_FB999C3C3147C936 (people_id), PRIMARY KEY(pca_evenement_id, people_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pca_evenement_tier (pca_evenement_id INT NOT NULL, tier_id INT NOT NULL, INDEX IDX_9542E7F62BB3B2B1 (pca_evenement_id), INDEX IDX_9542E7F6A354F9DC (tier_id), PRIMARY KEY(pca_evenement_id, tier_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pca_evenement_site (pca_evenement_id INT NOT NULL, site_id INT NOT NULL, INDEX IDX_D89F79982BB3B2B1 (pca_evenement_id), INDEX IDX_D89F7998F6BD1646 (site_id), PRIMARY KEY(pca_evenement_id, site_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE pca_evenement ADD CONSTRAINT FK_DE266C739395C3F3 FOREIGN KEY (customer_id) REFERENCES mapsi_customer (id)');
        $this->addSql('ALTER TABLE pca_evenement ADD CONSTRAINT FK_DE266C7353C59D72 FOREIGN KEY (responsable_id) REFERENCES people (id)');
        $this->addSql('ALTER TABLE pca_evenement ADD CONSTRAINT FK_DE266C7367A3C51B FOREIGN KEY (suppleant_id) REFERENCES people (id)');
        $this->addSql('ALTER TABLE pca_evenement_systeme ADD CONSTRAINT FK_68C81B6F2BB3B2B1 FOREIGN KEY (pca_evenement_id) REFERENCES pca_evenement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pca_evenement_systeme ADD CONSTRAINT FK_68C81B6F346F772E FOREIGN KEY (systeme_id) REFERENCES systeme (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pca_evenement_application ADD CONSTRAINT FK_6D7AD1F82BB3B2B1 FOREIGN KEY (pca_evenement_id) REFERENCES pca_evenement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pca_evenement_application ADD CONSTRAINT FK_6D7AD1F83E030ACD FOREIGN KEY (application_id) REFERENCES application (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pca_evenement_activite ADD CONSTRAINT FK_5C862B682BB3B2B1 FOREIGN KEY (pca_evenement_id) REFERENCES pca_evenement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pca_evenement_activite ADD CONSTRAINT FK_5C862B689B0F88B1 FOREIGN KEY (activite_id) REFERENCES activite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pca_evenement_people ADD CONSTRAINT FK_FB999C3C2BB3B2B1 FOREIGN KEY (pca_evenement_id) REFERENCES pca_evenement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pca_evenement_people ADD CONSTRAINT FK_FB999C3C3147C936 FOREIGN KEY (people_id) REFERENCES people (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pca_evenement_tier ADD CONSTRAINT FK_9542E7F62BB3B2B1 FOREIGN KEY (pca_evenement_id) REFERENCES pca_evenement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pca_evenement_tier ADD CONSTRAINT FK_9542E7F6A354F9DC FOREIGN KEY (tier_id) REFERENCES tier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pca_evenement_site ADD CONSTRAINT FK_D89F79982BB3B2B1 FOREIGN KEY (pca_evenement_id) REFERENCES pca_evenement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pca_evenement_site ADD CONSTRAINT FK_D89F7998F6BD1646 FOREIGN KEY (site_id) REFERENCES site (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE pca_evenement_systeme DROP FOREIGN KEY FK_68C81B6F2BB3B2B1');
        $this->addSql('ALTER TABLE pca_evenement_application DROP FOREIGN KEY FK_6D7AD1F82BB3B2B1');
        $this->addSql('ALTER TABLE pca_evenement_activite DROP FOREIGN KEY FK_5C862B682BB3B2B1');
        $this->addSql('ALTER TABLE pca_evenement_people DROP FOREIGN KEY FK_FB999C3C2BB3B2B1');
        $this->addSql('ALTER TABLE pca_evenement_tier DROP FOREIGN KEY FK_9542E7F62BB3B2B1');
        $this->addSql('ALTER TABLE pca_evenement_site DROP FOREIGN KEY FK_D89F79982BB3B2B1');
        $this->addSql('DROP TABLE pca_evenement');
        $this->addSql('DROP TABLE pca_evenement_systeme');
        $this->addSql('DROP TABLE pca_evenement_application');
        $this->addSql('DROP TABLE pca_evenement_activite');
        $this->addSql('DROP TABLE pca_evenement_people');
        $this->addSql('DROP TABLE pca_evenement_tier');
        $this->addSql('DROP TABLE pca_evenement_site');
    }
}
