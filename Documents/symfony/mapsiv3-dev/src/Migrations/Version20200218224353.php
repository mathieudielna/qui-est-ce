<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200218224353 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE flux_type_dcpsensible');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE flux_type_dcpsensible (flux_id INT NOT NULL, type_dcpsensible_id INT NOT NULL, INDEX IDX_54A11F8DF12276BE (type_dcpsensible_id), INDEX IDX_54A11F8DC85926E (flux_id), PRIMARY KEY(flux_id, type_dcpsensible_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE flux_type_dcpsensible ADD CONSTRAINT FK_54A11F8DC85926E FOREIGN KEY (flux_id) REFERENCES flux (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE flux_type_dcpsensible ADD CONSTRAINT FK_54A11F8DF12276BE FOREIGN KEY (type_dcpsensible_id) REFERENCES type_dcpsensible (id) ON UPDATE NO ACTION ON DELETE CASCADE');
    }
}
