<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190615185204 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE flux_connect_activite_activite');
        $this->addSql('DROP TABLE flux_connect_activite_flux');
        $this->addSql('DROP TABLE flux_connect_activite_type_direction');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE flux_connect_activite_activite (flux_connect_activite_id INT NOT NULL, activite_id INT NOT NULL, INDEX IDX_18032F009B0F88B1 (activite_id), INDEX IDX_18032F007F4E7037 (flux_connect_activite_id), PRIMARY KEY(flux_connect_activite_id, activite_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE flux_connect_activite_flux (flux_connect_activite_id INT NOT NULL, flux_id INT NOT NULL, INDEX IDX_DB3D89EAC85926E (flux_id), INDEX IDX_DB3D89EA7F4E7037 (flux_connect_activite_id), PRIMARY KEY(flux_connect_activite_id, flux_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE flux_connect_activite_type_direction (flux_connect_activite_id INT NOT NULL, type_direction_id INT NOT NULL, INDEX IDX_FDD959C57F4E7037 (flux_connect_activite_id), INDEX IDX_FDD959C528306392 (type_direction_id), PRIMARY KEY(flux_connect_activite_id, type_direction_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE flux_connect_activite_activite ADD CONSTRAINT FK_18032F007F4E7037 FOREIGN KEY (flux_connect_activite_id) REFERENCES flux_connect_activite (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE flux_connect_activite_activite ADD CONSTRAINT FK_18032F009B0F88B1 FOREIGN KEY (activite_id) REFERENCES activite (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE flux_connect_activite_flux ADD CONSTRAINT FK_DB3D89EA7F4E7037 FOREIGN KEY (flux_connect_activite_id) REFERENCES flux_connect_activite (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE flux_connect_activite_flux ADD CONSTRAINT FK_DB3D89EAC85926E FOREIGN KEY (flux_id) REFERENCES flux (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE flux_connect_activite_type_direction ADD CONSTRAINT FK_FDD959C528306392 FOREIGN KEY (type_direction_id) REFERENCES type_direction (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE flux_connect_activite_type_direction ADD CONSTRAINT FK_FDD959C57F4E7037 FOREIGN KEY (flux_connect_activite_id) REFERENCES flux_connect_activite (id) ON UPDATE NO ACTION ON DELETE CASCADE');
    }
}
