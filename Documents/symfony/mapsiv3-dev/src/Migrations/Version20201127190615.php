<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201127190615 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE aspect_env (id INT AUTO_INCREMENT NOT NULL, responsable_id INT DEFAULT NULL, suppleant_id INT DEFAULT NULL, designation VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, commentaire LONGTEXT DEFAULT NULL, INDEX IDX_7C07B51E53C59D72 (responsable_id), INDEX IDX_7C07B51E67A3C51B (suppleant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE aspect_env_action (aspect_env_id INT NOT NULL, action_id INT NOT NULL, INDEX IDX_50D0CD70772F8468 (aspect_env_id), INDEX IDX_50D0CD709D32F035 (action_id), PRIMARY KEY(aspect_env_id, action_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE aspect_env_people (aspect_env_id INT NOT NULL, people_id INT NOT NULL, INDEX IDX_3F0A2BC4772F8468 (aspect_env_id), INDEX IDX_3F0A2BC43147C936 (people_id), PRIMARY KEY(aspect_env_id, people_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_aspect_env (id INT AUTO_INCREMENT NOT NULL, designation VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE aspect_env ADD CONSTRAINT FK_7C07B51E53C59D72 FOREIGN KEY (responsable_id) REFERENCES people (id)');
        $this->addSql('ALTER TABLE aspect_env ADD CONSTRAINT FK_7C07B51E67A3C51B FOREIGN KEY (suppleant_id) REFERENCES people (id)');
        $this->addSql('ALTER TABLE aspect_env_action ADD CONSTRAINT FK_50D0CD70772F8468 FOREIGN KEY (aspect_env_id) REFERENCES aspect_env (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE aspect_env_action ADD CONSTRAINT FK_50D0CD709D32F035 FOREIGN KEY (action_id) REFERENCES action (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE aspect_env_people ADD CONSTRAINT FK_3F0A2BC4772F8468 FOREIGN KEY (aspect_env_id) REFERENCES aspect_env (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE aspect_env_people ADD CONSTRAINT FK_3F0A2BC43147C936 FOREIGN KEY (people_id) REFERENCES people (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE aspect_env_action DROP FOREIGN KEY FK_50D0CD70772F8468');
        $this->addSql('ALTER TABLE aspect_env_people DROP FOREIGN KEY FK_3F0A2BC4772F8468');
        $this->addSql('DROP TABLE aspect_env');
        $this->addSql('DROP TABLE aspect_env_action');
        $this->addSql('DROP TABLE aspect_env_people');
        $this->addSql('DROP TABLE type_aspect_env');
    }
}
