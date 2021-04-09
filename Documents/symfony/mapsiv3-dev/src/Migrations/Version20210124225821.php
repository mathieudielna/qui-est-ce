<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210124225821 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE reclamation (id INT AUTO_INCREMENT NOT NULL, responsable_id INT DEFAULT NULL, publisher_id INT DEFAULT NULL, validator_id INT DEFAULT NULL, typeconformite_id INT DEFAULT NULL, designation VARCHAR(255) NOT NULL, suppleant VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, created_at DATETIME DEFAULT NULL, published_at DATETIME DEFAULT NULL, validated_at DATETIME DEFAULT NULL, slug VARCHAR(255) NOT NULL, declarantnom VARCHAR(255) DEFAULT NULL, declaranttel VARCHAR(255) DEFAULT NULL, declarantemail VARCHAR(255) DEFAULT NULL, statut VARCHAR(255) DEFAULT NULL, validationstatut VARCHAR(255) DEFAULT NULL, processuses VARCHAR(255) NOT NULL, INDEX IDX_CE60640453C59D72 (responsable_id), INDEX IDX_CE60640440C86FCE (publisher_id), INDEX IDX_CE606404B0644AEC (validator_id), INDEX IDX_CE606404D457E4FD (typeconformite_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reclamation_people (reclamation_id INT NOT NULL, people_id INT NOT NULL, INDEX IDX_B9AF0A822D6BA2D9 (reclamation_id), INDEX IDX_B9AF0A823147C936 (people_id), PRIMARY KEY(reclamation_id, people_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reclamation_site (reclamation_id INT NOT NULL, site_id INT NOT NULL, INDEX IDX_680C8E8B2D6BA2D9 (reclamation_id), INDEX IDX_680C8E8BF6BD1646 (site_id), PRIMARY KEY(reclamation_id, site_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reclamation_aspect_env (reclamation_id INT NOT NULL, aspect_env_id INT NOT NULL, INDEX IDX_44D6464F2D6BA2D9 (reclamation_id), INDEX IDX_44D6464F772F8468 (aspect_env_id), PRIMARY KEY(reclamation_id, aspect_env_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reclamation_action (reclamation_id INT NOT NULL, action_id INT NOT NULL, INDEX IDX_D675EC362D6BA2D9 (reclamation_id), INDEX IDX_D675EC369D32F035 (action_id), PRIMARY KEY(reclamation_id, action_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reclamation ADD CONSTRAINT FK_CE60640453C59D72 FOREIGN KEY (responsable_id) REFERENCES people (id)');
        $this->addSql('ALTER TABLE reclamation ADD CONSTRAINT FK_CE60640440C86FCE FOREIGN KEY (publisher_id) REFERENCES people (id)');
        $this->addSql('ALTER TABLE reclamation ADD CONSTRAINT FK_CE606404B0644AEC FOREIGN KEY (validator_id) REFERENCES people (id)');
        $this->addSql('ALTER TABLE reclamation ADD CONSTRAINT FK_CE606404D457E4FD FOREIGN KEY (typeconformite_id) REFERENCES type_conformite (id)');
        $this->addSql('ALTER TABLE reclamation_people ADD CONSTRAINT FK_B9AF0A822D6BA2D9 FOREIGN KEY (reclamation_id) REFERENCES reclamation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reclamation_people ADD CONSTRAINT FK_B9AF0A823147C936 FOREIGN KEY (people_id) REFERENCES people (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reclamation_site ADD CONSTRAINT FK_680C8E8B2D6BA2D9 FOREIGN KEY (reclamation_id) REFERENCES reclamation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reclamation_site ADD CONSTRAINT FK_680C8E8BF6BD1646 FOREIGN KEY (site_id) REFERENCES site (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reclamation_aspect_env ADD CONSTRAINT FK_44D6464F2D6BA2D9 FOREIGN KEY (reclamation_id) REFERENCES reclamation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reclamation_aspect_env ADD CONSTRAINT FK_44D6464F772F8468 FOREIGN KEY (aspect_env_id) REFERENCES aspect_env (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reclamation_action ADD CONSTRAINT FK_D675EC362D6BA2D9 FOREIGN KEY (reclamation_id) REFERENCES reclamation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reclamation_action ADD CONSTRAINT FK_D675EC369D32F035 FOREIGN KEY (action_id) REFERENCES action (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE reclamation_people DROP FOREIGN KEY FK_B9AF0A822D6BA2D9');
        $this->addSql('ALTER TABLE reclamation_site DROP FOREIGN KEY FK_680C8E8B2D6BA2D9');
        $this->addSql('ALTER TABLE reclamation_aspect_env DROP FOREIGN KEY FK_44D6464F2D6BA2D9');
        $this->addSql('ALTER TABLE reclamation_action DROP FOREIGN KEY FK_D675EC362D6BA2D9');
        $this->addSql('DROP TABLE reclamation');
        $this->addSql('DROP TABLE reclamation_people');
        $this->addSql('DROP TABLE reclamation_site');
        $this->addSql('DROP TABLE reclamation_aspect_env');
        $this->addSql('DROP TABLE reclamation_action');
    }
}
