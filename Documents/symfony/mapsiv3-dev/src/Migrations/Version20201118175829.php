<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201118175829 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE risque_flux');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE risque_flux (risque_id INT NOT NULL, flux_id INT NOT NULL, INDEX IDX_46D3CC234ECC2413 (risque_id), INDEX IDX_46D3CC23C85926E (flux_id), PRIMARY KEY(risque_id, flux_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE risque_flux ADD CONSTRAINT FK_46D3CC234ECC2413 FOREIGN KEY (risque_id) REFERENCES risque (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE risque_flux ADD CONSTRAINT FK_46D3CC23C85926E FOREIGN KEY (flux_id) REFERENCES flux (id) ON UPDATE NO ACTION ON DELETE CASCADE');
    }
}
