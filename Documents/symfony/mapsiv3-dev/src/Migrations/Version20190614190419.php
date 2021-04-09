<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190614190419 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE risque ADD typerisque_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE risque ADD CONSTRAINT FK_20230D24ADF3468F FOREIGN KEY (typerisque_id) REFERENCES type_risque (id)');
        $this->addSql('CREATE INDEX IDX_20230D24ADF3468F ON risque (typerisque_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE risque DROP FOREIGN KEY FK_20230D24ADF3468F');
        $this->addSql('DROP INDEX IDX_20230D24ADF3468F ON risque');
        $this->addSql('ALTER TABLE risque DROP typerisque_id');
    }
}
