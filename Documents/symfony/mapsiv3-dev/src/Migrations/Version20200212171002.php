<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200212171002 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE flux_objet_metier');
        $this->addSql('ALTER TABLE flux DROP FOREIGN KEY FK_7252313AA7E15F2A');
        $this->addSql('ALTER TABLE flux DROP FOREIGN KEY FK_7252313AE0A5DCC');
        $this->addSql('DROP INDEX IDX_7252313AE0A5DCC ON flux');
        $this->addSql('DROP INDEX IDX_7252313AA7E15F2A ON flux');
        $this->addSql('ALTER TABLE flux DROP dcp_id, DROP dcpsensible_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE flux_objet_metier (flux_id INT NOT NULL, objet_metier_id INT NOT NULL, INDEX IDX_DEE0422DC85926E (flux_id), INDEX IDX_DEE0422D25707B47 (objet_metier_id), PRIMARY KEY(flux_id, objet_metier_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE flux_objet_metier ADD CONSTRAINT FK_DEE0422D25707B47 FOREIGN KEY (objet_metier_id) REFERENCES objet_metier (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE flux_objet_metier ADD CONSTRAINT FK_DEE0422DC85926E FOREIGN KEY (flux_id) REFERENCES flux (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE flux ADD dcp_id INT DEFAULT NULL, ADD dcpsensible_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE flux ADD CONSTRAINT FK_7252313AA7E15F2A FOREIGN KEY (dcpsensible_id) REFERENCES oui_non (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE flux ADD CONSTRAINT FK_7252313AE0A5DCC FOREIGN KEY (dcp_id) REFERENCES oui_non (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_7252313AE0A5DCC ON flux (dcp_id)');
        $this->addSql('CREATE INDEX IDX_7252313AA7E15F2A ON flux (dcpsensible_id)');
    }
}
