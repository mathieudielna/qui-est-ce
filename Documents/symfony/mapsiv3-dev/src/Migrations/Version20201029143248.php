<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201029143248 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE metier ADD directeur_id INT DEFAULT NULL, ADD suppleant_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE metier ADD CONSTRAINT FK_51A00D8CE82E7EE8 FOREIGN KEY (directeur_id) REFERENCES people (id)');
        $this->addSql('ALTER TABLE metier ADD CONSTRAINT FK_51A00D8C67A3C51B FOREIGN KEY (suppleant_id) REFERENCES people (id)');
        $this->addSql('CREATE INDEX IDX_51A00D8CE82E7EE8 ON metier (directeur_id)');
        $this->addSql('CREATE INDEX IDX_51A00D8C67A3C51B ON metier (suppleant_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE metier DROP FOREIGN KEY FK_51A00D8CE82E7EE8');
        $this->addSql('ALTER TABLE metier DROP FOREIGN KEY FK_51A00D8C67A3C51B');
        $this->addSql('DROP INDEX IDX_51A00D8CE82E7EE8 ON metier');
        $this->addSql('DROP INDEX IDX_51A00D8C67A3C51B ON metier');
        $this->addSql('ALTER TABLE metier DROP directeur_id, DROP suppleant_id');
    }
}
