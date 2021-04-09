<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190520150519 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE activite_application (activite_id INT NOT NULL, application_id INT NOT NULL, INDEX IDX_8468A8EC9B0F88B1 (activite_id), INDEX IDX_8468A8EC3E030ACD (application_id), PRIMARY KEY(activite_id, application_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE activite_application ADD CONSTRAINT FK_8468A8EC9B0F88B1 FOREIGN KEY (activite_id) REFERENCES activite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE activite_application ADD CONSTRAINT FK_8468A8EC3E030ACD FOREIGN KEY (application_id) REFERENCES application (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE activite_activite');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE activite_activite (activite_source INT NOT NULL, activite_target INT NOT NULL, INDEX IDX_25ED847D3F0DEB98 (activite_target), INDEX IDX_25ED847D26E8BB17 (activite_source), PRIMARY KEY(activite_source, activite_target)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE activite_activite ADD CONSTRAINT FK_25ED847D26E8BB17 FOREIGN KEY (activite_source) REFERENCES activite (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE activite_activite ADD CONSTRAINT FK_25ED847D3F0DEB98 FOREIGN KEY (activite_target) REFERENCES activite (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('DROP TABLE activite_application');
    }
}
