<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210307174205 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE risque_people (risque_id INT NOT NULL, people_id INT NOT NULL, INDEX IDX_701A791E4ECC2413 (risque_id), INDEX IDX_701A791E3147C936 (people_id), PRIMARY KEY(risque_id, people_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE risque_people ADD CONSTRAINT FK_701A791E4ECC2413 FOREIGN KEY (risque_id) REFERENCES risque (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE risque_people ADD CONSTRAINT FK_701A791E3147C936 FOREIGN KEY (people_id) REFERENCES people (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE risque ADD updated_at DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE risque_people');
        $this->addSql('ALTER TABLE risque DROP updated_at');
    }
}
