<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201030171609 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE ressource_people (ressource_id INT NOT NULL, people_id INT NOT NULL, INDEX IDX_C257B99BFC6CD52A (ressource_id), INDEX IDX_C257B99B3147C936 (people_id), PRIMARY KEY(ressource_id, people_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ressource_people ADD CONSTRAINT FK_C257B99BFC6CD52A FOREIGN KEY (ressource_id) REFERENCES ressource (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ressource_people ADD CONSTRAINT FK_C257B99B3147C936 FOREIGN KEY (people_id) REFERENCES people (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ressource ADD responsable_id INT DEFAULT NULL, ADD suppleant_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ressource ADD CONSTRAINT FK_939F454453C59D72 FOREIGN KEY (responsable_id) REFERENCES people (id)');
        $this->addSql('ALTER TABLE ressource ADD CONSTRAINT FK_939F454467A3C51B FOREIGN KEY (suppleant_id) REFERENCES people (id)');
        $this->addSql('CREATE INDEX IDX_939F454453C59D72 ON ressource (responsable_id)');
        $this->addSql('CREATE INDEX IDX_939F454467A3C51B ON ressource (suppleant_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE ressource_people');
        $this->addSql('ALTER TABLE ressource DROP FOREIGN KEY FK_939F454453C59D72');
        $this->addSql('ALTER TABLE ressource DROP FOREIGN KEY FK_939F454467A3C51B');
        $this->addSql('DROP INDEX IDX_939F454453C59D72 ON ressource');
        $this->addSql('DROP INDEX IDX_939F454467A3C51B ON ressource');
        $this->addSql('ALTER TABLE ressource DROP responsable_id, DROP suppleant_id');
    }
}
