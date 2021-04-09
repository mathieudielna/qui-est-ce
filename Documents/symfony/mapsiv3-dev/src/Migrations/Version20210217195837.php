<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210217195837 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE visite_site_ressource (visite_site_id INT NOT NULL, ressource_id INT NOT NULL, INDEX IDX_268784373CBC6360 (visite_site_id), INDEX IDX_26878437FC6CD52A (ressource_id), PRIMARY KEY(visite_site_id, ressource_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE visite_site_ressource ADD CONSTRAINT FK_268784373CBC6360 FOREIGN KEY (visite_site_id) REFERENCES visite_site (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE visite_site_ressource ADD CONSTRAINT FK_26878437FC6CD52A FOREIGN KEY (ressource_id) REFERENCES ressource (id) ON DELETE CASCADE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_EEEA8C1D8947610D ON processus (designation)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE visite_site_ressource');
        $this->addSql('DROP INDEX UNIQ_EEEA8C1D8947610D ON processus');
    }
}
