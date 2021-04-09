<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200212163719 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE fluxexpout DROP FOREIGN KEY FK_21C4EB9A354F9DC');
        $this->addSql('ALTER TABLE fluxexpout ADD CONSTRAINT FK_21C4EB9A354F9DC FOREIGN KEY (tier_id) REFERENCES tier (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE fluxexpout DROP FOREIGN KEY FK_21C4EB9A354F9DC');
        $this->addSql('ALTER TABLE fluxexpout ADD CONSTRAINT FK_21C4EB9A354F9DC FOREIGN KEY (tier_id) REFERENCES flux (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}
