<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190510010352 extends AbstractMigration
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
        $this->addSql('ALTER TABLE activite DROP FOREIGN KEY FK_B87555153E030ACD');
        $this->addSql('DROP INDEX IDX_B87555153E030ACD ON activite');
        $this->addSql('ALTER TABLE activite DROP application_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE activite_application');
        $this->addSql('ALTER TABLE activite ADD application_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE activite ADD CONSTRAINT FK_B87555153E030ACD FOREIGN KEY (application_id) REFERENCES application (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_B87555153E030ACD ON activite (application_id)');
    }
}
