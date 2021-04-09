<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210121234332 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE visite_site (id INT AUTO_INCREMENT NOT NULL, customer_id INT NOT NULL, responsable_id INT DEFAULT NULL, suppleant_id INT DEFAULT NULL, publisher_id INT DEFAULT NULL, designation VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, commentaire LONGTEXT DEFAULT NULL, created_at DATETIME DEFAULT NULL, published_at DATETIME DEFAULT NULL, visited_at DATETIME DEFAULT NULL, validated_at DATETIME DEFAULT NULL, statut VARCHAR(255) DEFAULT NULL, INDEX IDX_E432A6559395C3F3 (customer_id), INDEX IDX_E432A65553C59D72 (responsable_id), INDEX IDX_E432A65567A3C51B (suppleant_id), INDEX IDX_E432A65540C86FCE (publisher_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE visite_site_site (visite_site_id INT NOT NULL, site_id INT NOT NULL, INDEX IDX_B168788B3CBC6360 (visite_site_id), INDEX IDX_B168788BF6BD1646 (site_id), PRIMARY KEY(visite_site_id, site_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE visite_site_people (visite_site_id INT NOT NULL, people_id INT NOT NULL, INDEX IDX_ED7184CF3CBC6360 (visite_site_id), INDEX IDX_ED7184CF3147C936 (people_id), PRIMARY KEY(visite_site_id, people_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE visite_site ADD CONSTRAINT FK_E432A6559395C3F3 FOREIGN KEY (customer_id) REFERENCES mapsi_customer (id)');
        $this->addSql('ALTER TABLE visite_site ADD CONSTRAINT FK_E432A65553C59D72 FOREIGN KEY (responsable_id) REFERENCES people (id)');
        $this->addSql('ALTER TABLE visite_site ADD CONSTRAINT FK_E432A65567A3C51B FOREIGN KEY (suppleant_id) REFERENCES people (id)');
        $this->addSql('ALTER TABLE visite_site ADD CONSTRAINT FK_E432A65540C86FCE FOREIGN KEY (publisher_id) REFERENCES people (id)');
        $this->addSql('ALTER TABLE visite_site_site ADD CONSTRAINT FK_B168788B3CBC6360 FOREIGN KEY (visite_site_id) REFERENCES visite_site (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE visite_site_site ADD CONSTRAINT FK_B168788BF6BD1646 FOREIGN KEY (site_id) REFERENCES site (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE visite_site_people ADD CONSTRAINT FK_ED7184CF3CBC6360 FOREIGN KEY (visite_site_id) REFERENCES visite_site (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE visite_site_people ADD CONSTRAINT FK_ED7184CF3147C936 FOREIGN KEY (people_id) REFERENCES people (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE visite_site_site DROP FOREIGN KEY FK_B168788B3CBC6360');
        $this->addSql('ALTER TABLE visite_site_people DROP FOREIGN KEY FK_ED7184CF3CBC6360');
        $this->addSql('DROP TABLE visite_site');
        $this->addSql('DROP TABLE visite_site_site');
        $this->addSql('DROP TABLE visite_site_people');
    }
}
