<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200529171630 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE controle (id INT AUTO_INCREMENT NOT NULL, auteur_id INT DEFAULT NULL, designation VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, finalite LONGTEXT DEFAULT NULL, materialisationctrl LONGTEXT DEFAULT NULL, support VARCHAR(255) DEFAULT NULL, INDEX IDX_E39396E60BB6FE6 (auteur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE controle_type_periodicite (controle_id INT NOT NULL, type_periodicite_id INT NOT NULL, INDEX IDX_5C093C4D758926A6 (controle_id), INDEX IDX_5C093C4D7FEB5CBE (type_periodicite_id), PRIMARY KEY(controle_id, type_periodicite_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE controle ADD CONSTRAINT FK_E39396E60BB6FE6 FOREIGN KEY (auteur_id) REFERENCES people (id)');
        $this->addSql('ALTER TABLE controle_type_periodicite ADD CONSTRAINT FK_5C093C4D758926A6 FOREIGN KEY (controle_id) REFERENCES controle (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE controle_type_periodicite ADD CONSTRAINT FK_5C093C4D7FEB5CBE FOREIGN KEY (type_periodicite_id) REFERENCES type_periodicite (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE controle_type_periodicite DROP FOREIGN KEY FK_5C093C4D758926A6');
        $this->addSql('DROP TABLE controle');
        $this->addSql('DROP TABLE controle_type_periodicite');
    }
}
