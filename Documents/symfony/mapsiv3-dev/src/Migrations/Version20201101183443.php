<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201101183443 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE objet_metier_people (objet_metier_id INT NOT NULL, people_id INT NOT NULL, INDEX IDX_C185D10225707B47 (objet_metier_id), INDEX IDX_C185D1023147C936 (people_id), PRIMARY KEY(objet_metier_id, people_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE objet_metier_people ADD CONSTRAINT FK_C185D10225707B47 FOREIGN KEY (objet_metier_id) REFERENCES objet_metier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE objet_metier_people ADD CONSTRAINT FK_C185D1023147C936 FOREIGN KEY (people_id) REFERENCES people (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE objet_metier_people');
    }
}
