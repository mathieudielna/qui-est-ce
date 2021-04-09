<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201126181633 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE dysfonctionnement (id INT AUTO_INCREMENT NOT NULL, declarant_id INT DEFAULT NULL, customer_id INT NOT NULL, responsable_id INT DEFAULT NULL, suppleant_id INT DEFAULT NULL, publisher_id INT DEFAULT NULL, validator_id INT DEFAULT NULL, designation VARCHAR(255) NOT NULL, typenotification VARCHAR(255) DEFAULT NULL, numerocnil VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, published_at DATETIME DEFAULT NULL, closed_at DATETIME DEFAULT NULL, commentaire LONGTEXT DEFAULT NULL, description LONGTEXT DEFAULT NULL, mesuresecu VARCHAR(255) DEFAULT NULL, connsequence LONGTEXT DEFAULT NULL, slug VARCHAR(255) NOT NULL, statut VARCHAR(255) DEFAULT NULL, validated_at DATETIME DEFAULT NULL, validationstatut VARCHAR(255) DEFAULT NULL, INDEX IDX_1CBDDC09EC439BC (declarant_id), INDEX IDX_1CBDDC099395C3F3 (customer_id), INDEX IDX_1CBDDC0953C59D72 (responsable_id), INDEX IDX_1CBDDC0967A3C51B (suppleant_id), INDEX IDX_1CBDDC0940C86FCE (publisher_id), INDEX IDX_1CBDDC09B0644AEC (validator_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dysfonctionnement_tier (dysfonctionnement_id INT NOT NULL, tier_id INT NOT NULL, INDEX IDX_33D8B3DFF1CDBB81 (dysfonctionnement_id), INDEX IDX_33D8B3DFA354F9DC (tier_id), PRIMARY KEY(dysfonctionnement_id, tier_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dysfonctionnement_flux (dysfonctionnement_id INT NOT NULL, flux_id INT NOT NULL, INDEX IDX_6514156FF1CDBB81 (dysfonctionnement_id), INDEX IDX_6514156FC85926E (flux_id), PRIMARY KEY(dysfonctionnement_id, flux_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dysfonctionnement_people (dysfonctionnement_id INT NOT NULL, people_id INT NOT NULL, INDEX IDX_D3D930A0F1CDBB81 (dysfonctionnement_id), INDEX IDX_D3D930A03147C936 (people_id), PRIMARY KEY(dysfonctionnement_id, people_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE dysfonctionnement ADD CONSTRAINT FK_1CBDDC09EC439BC FOREIGN KEY (declarant_id) REFERENCES people (id)');
        $this->addSql('ALTER TABLE dysfonctionnement ADD CONSTRAINT FK_1CBDDC099395C3F3 FOREIGN KEY (customer_id) REFERENCES mapsi_customer (id)');
        $this->addSql('ALTER TABLE dysfonctionnement ADD CONSTRAINT FK_1CBDDC0953C59D72 FOREIGN KEY (responsable_id) REFERENCES people (id)');
        $this->addSql('ALTER TABLE dysfonctionnement ADD CONSTRAINT FK_1CBDDC0967A3C51B FOREIGN KEY (suppleant_id) REFERENCES people (id)');
        $this->addSql('ALTER TABLE dysfonctionnement ADD CONSTRAINT FK_1CBDDC0940C86FCE FOREIGN KEY (publisher_id) REFERENCES people (id)');
        $this->addSql('ALTER TABLE dysfonctionnement ADD CONSTRAINT FK_1CBDDC09B0644AEC FOREIGN KEY (validator_id) REFERENCES people (id)');
        $this->addSql('ALTER TABLE dysfonctionnement_tier ADD CONSTRAINT FK_33D8B3DFF1CDBB81 FOREIGN KEY (dysfonctionnement_id) REFERENCES dysfonctionnement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dysfonctionnement_tier ADD CONSTRAINT FK_33D8B3DFA354F9DC FOREIGN KEY (tier_id) REFERENCES tier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dysfonctionnement_flux ADD CONSTRAINT FK_6514156FF1CDBB81 FOREIGN KEY (dysfonctionnement_id) REFERENCES dysfonctionnement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dysfonctionnement_flux ADD CONSTRAINT FK_6514156FC85926E FOREIGN KEY (flux_id) REFERENCES flux (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dysfonctionnement_people ADD CONSTRAINT FK_D3D930A0F1CDBB81 FOREIGN KEY (dysfonctionnement_id) REFERENCES dysfonctionnement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dysfonctionnement_people ADD CONSTRAINT FK_D3D930A03147C936 FOREIGN KEY (people_id) REFERENCES people (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE dysfonctionnement_tier DROP FOREIGN KEY FK_33D8B3DFF1CDBB81');
        $this->addSql('ALTER TABLE dysfonctionnement_flux DROP FOREIGN KEY FK_6514156FF1CDBB81');
        $this->addSql('ALTER TABLE dysfonctionnement_people DROP FOREIGN KEY FK_D3D930A0F1CDBB81');
        $this->addSql('DROP TABLE dysfonctionnement');
        $this->addSql('DROP TABLE dysfonctionnement_tier');
        $this->addSql('DROP TABLE dysfonctionnement_flux');
        $this->addSql('DROP TABLE dysfonctionnement_people');
    }
}
