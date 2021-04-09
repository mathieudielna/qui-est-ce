<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201127192655 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE aspect_env_type_aspect_env (aspect_env_id INT NOT NULL, type_aspect_env_id INT NOT NULL, INDEX IDX_2E5ECCBC772F8468 (aspect_env_id), INDEX IDX_2E5ECCBC7C2335D (type_aspect_env_id), PRIMARY KEY(aspect_env_id, type_aspect_env_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE aspect_env_activite (aspect_env_id INT NOT NULL, activite_id INT NOT NULL, INDEX IDX_D5E6A261772F8468 (aspect_env_id), INDEX IDX_D5E6A2619B0F88B1 (activite_id), PRIMARY KEY(aspect_env_id, activite_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE aspect_env_type_aspect_env ADD CONSTRAINT FK_2E5ECCBC772F8468 FOREIGN KEY (aspect_env_id) REFERENCES aspect_env (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE aspect_env_type_aspect_env ADD CONSTRAINT FK_2E5ECCBC7C2335D FOREIGN KEY (type_aspect_env_id) REFERENCES type_aspect_env (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE aspect_env_activite ADD CONSTRAINT FK_D5E6A261772F8468 FOREIGN KEY (aspect_env_id) REFERENCES aspect_env (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE aspect_env_activite ADD CONSTRAINT FK_D5E6A2619B0F88B1 FOREIGN KEY (activite_id) REFERENCES activite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE aspect_env ADD validator_id INT DEFAULT NULL, ADD customer_id INT DEFAULT NULL, ADD publisher_id INT DEFAULT NULL, ADD created_at DATETIME DEFAULT NULL, ADD updated_at DATETIME DEFAULT NULL, ADD published_at DATETIME DEFAULT NULL, ADD validated_at DATETIME DEFAULT NULL, ADD statut VARCHAR(255) DEFAULT NULL, ADD validationstatut VARCHAR(255) DEFAULT NULL, ADD slug VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE aspect_env ADD CONSTRAINT FK_7C07B51EB0644AEC FOREIGN KEY (validator_id) REFERENCES people (id)');
        $this->addSql('ALTER TABLE aspect_env ADD CONSTRAINT FK_7C07B51E9395C3F3 FOREIGN KEY (customer_id) REFERENCES mapsi_customer (id)');
        $this->addSql('ALTER TABLE aspect_env ADD CONSTRAINT FK_7C07B51E40C86FCE FOREIGN KEY (publisher_id) REFERENCES people (id)');
        $this->addSql('CREATE INDEX IDX_7C07B51EB0644AEC ON aspect_env (validator_id)');
        $this->addSql('CREATE INDEX IDX_7C07B51E9395C3F3 ON aspect_env (customer_id)');
        $this->addSql('CREATE INDEX IDX_7C07B51E40C86FCE ON aspect_env (publisher_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE aspect_env_type_aspect_env');
        $this->addSql('DROP TABLE aspect_env_activite');
        $this->addSql('ALTER TABLE aspect_env DROP FOREIGN KEY FK_7C07B51EB0644AEC');
        $this->addSql('ALTER TABLE aspect_env DROP FOREIGN KEY FK_7C07B51E9395C3F3');
        $this->addSql('ALTER TABLE aspect_env DROP FOREIGN KEY FK_7C07B51E40C86FCE');
        $this->addSql('DROP INDEX IDX_7C07B51EB0644AEC ON aspect_env');
        $this->addSql('DROP INDEX IDX_7C07B51E9395C3F3 ON aspect_env');
        $this->addSql('DROP INDEX IDX_7C07B51E40C86FCE ON aspect_env');
        $this->addSql('ALTER TABLE aspect_env DROP validator_id, DROP customer_id, DROP publisher_id, DROP created_at, DROP updated_at, DROP published_at, DROP validated_at, DROP statut, DROP validationstatut, DROP slug');
    }
}
