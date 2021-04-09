<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190605204819 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE flux ADD dcp_id INT DEFAULT NULL, ADD dcpsensible_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE flux ADD CONSTRAINT FK_7252313AE0A5DCC FOREIGN KEY (dcp_id) REFERENCES oui_non (id)');
        $this->addSql('ALTER TABLE flux ADD CONSTRAINT FK_7252313AA7E15F2A FOREIGN KEY (dcpsensible_id) REFERENCES oui_non (id)');
        $this->addSql('CREATE INDEX IDX_7252313AE0A5DCC ON flux (dcp_id)');
        $this->addSql('CREATE INDEX IDX_7252313AA7E15F2A ON flux (dcpsensible_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE flux DROP FOREIGN KEY FK_7252313AE0A5DCC');
        $this->addSql('ALTER TABLE flux DROP FOREIGN KEY FK_7252313AA7E15F2A');
        $this->addSql('DROP INDEX IDX_7252313AE0A5DCC ON flux');
        $this->addSql('DROP INDEX IDX_7252313AA7E15F2A ON flux');
        $this->addSql('ALTER TABLE flux DROP dcp_id, DROP dcpsensible_id');
    }
}
