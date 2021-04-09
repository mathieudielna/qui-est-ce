<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210124233937 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE reclamation_processus (reclamation_id INT NOT NULL, processus_id INT NOT NULL, INDEX IDX_E7DB19BF2D6BA2D9 (reclamation_id), INDEX IDX_E7DB19BFA55629DC (processus_id), PRIMARY KEY(reclamation_id, processus_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reclamation_processus ADD CONSTRAINT FK_E7DB19BF2D6BA2D9 FOREIGN KEY (reclamation_id) REFERENCES reclamation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reclamation_processus ADD CONSTRAINT FK_E7DB19BFA55629DC FOREIGN KEY (processus_id) REFERENCES processus (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reclamation ADD suppleant_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reclamation ADD CONSTRAINT FK_CE60640467A3C51B FOREIGN KEY (suppleant_id) REFERENCES people (id)');
        $this->addSql('CREATE INDEX IDX_CE60640467A3C51B ON reclamation (suppleant_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE reclamation_processus');
        $this->addSql('ALTER TABLE reclamation DROP FOREIGN KEY FK_CE60640467A3C51B');
        $this->addSql('DROP INDEX IDX_CE60640467A3C51B ON reclamation');
        $this->addSql('ALTER TABLE reclamation DROP suppleant_id');
    }
}
