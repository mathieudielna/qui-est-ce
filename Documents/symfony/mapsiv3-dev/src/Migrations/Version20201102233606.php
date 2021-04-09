<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201102233606 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE jalon_connect_action_people (jalon_connect_action_id INT NOT NULL, people_id INT NOT NULL, INDEX IDX_C0F90B4519503B17 (jalon_connect_action_id), INDEX IDX_C0F90B453147C936 (people_id), PRIMARY KEY(jalon_connect_action_id, people_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE jalon_connect_action_people ADD CONSTRAINT FK_C0F90B4519503B17 FOREIGN KEY (jalon_connect_action_id) REFERENCES jalon_connect_action (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE jalon_connect_action_people ADD CONSTRAINT FK_C0F90B453147C936 FOREIGN KEY (people_id) REFERENCES people (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE jalon_connect_action CHANGE action_id action_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE jalon_connect_action_people');
        $this->addSql('ALTER TABLE jalon_connect_action CHANGE action_id action_id INT NOT NULL');
    }
}
