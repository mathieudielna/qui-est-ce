<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190605202600 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE flux ADD direction_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE flux ADD CONSTRAINT FK_7252313AAF73D997 FOREIGN KEY (direction_id) REFERENCES type_direction (id)');
        $this->addSql('CREATE INDEX IDX_7252313AAF73D997 ON flux (direction_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE flux DROP FOREIGN KEY FK_7252313AAF73D997');
        $this->addSql('DROP INDEX IDX_7252313AAF73D997 ON flux');
        $this->addSql('ALTER TABLE flux DROP direction_id');
    }
}
