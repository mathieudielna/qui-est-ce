<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210121235154 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE visite_site_type_conformite (visite_site_id INT NOT NULL, type_conformite_id INT NOT NULL, INDEX IDX_E70E81F83CBC6360 (visite_site_id), INDEX IDX_E70E81F879A28B64 (type_conformite_id), PRIMARY KEY(visite_site_id, type_conformite_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE visite_site_type_conformite ADD CONSTRAINT FK_E70E81F83CBC6360 FOREIGN KEY (visite_site_id) REFERENCES visite_site (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE visite_site_type_conformite ADD CONSTRAINT FK_E70E81F879A28B64 FOREIGN KEY (type_conformite_id) REFERENCES type_conformite (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE visite_site_type_conformite');
    }
}
