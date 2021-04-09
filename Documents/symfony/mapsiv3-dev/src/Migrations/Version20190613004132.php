<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190613004132 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE flux ADD customer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE flux ADD CONSTRAINT FK_7252313A9395C3F3 FOREIGN KEY (customer_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_7252313A9395C3F3 ON flux (customer_id)');
        $this->addSql('ALTER TABLE systeme ADD customer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE systeme ADD CONSTRAINT FK_95796DE39395C3F3 FOREIGN KEY (customer_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_95796DE39395C3F3 ON systeme (customer_id)');
        $this->addSql('ALTER TABLE application ADD customer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE application ADD CONSTRAINT FK_A45BDDC19395C3F3 FOREIGN KEY (customer_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_A45BDDC19395C3F3 ON application (customer_id)');
        $this->addSql('ALTER TABLE site ADD customer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE site ADD CONSTRAINT FK_694309E49395C3F3 FOREIGN KEY (customer_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_694309E49395C3F3 ON site (customer_id)');
        $this->addSql('ALTER TABLE metier ADD customer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE metier ADD CONSTRAINT FK_51A00D8C9395C3F3 FOREIGN KEY (customer_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_51A00D8C9395C3F3 ON metier (customer_id)');
        $this->addSql('ALTER TABLE objet_metier ADD customer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE objet_metier ADD CONSTRAINT FK_E47FE0A69395C3F3 FOREIGN KEY (customer_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_E47FE0A69395C3F3 ON objet_metier (customer_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE application DROP FOREIGN KEY FK_A45BDDC19395C3F3');
        $this->addSql('DROP INDEX IDX_A45BDDC19395C3F3 ON application');
        $this->addSql('ALTER TABLE application DROP customer_id');
        $this->addSql('ALTER TABLE flux DROP FOREIGN KEY FK_7252313A9395C3F3');
        $this->addSql('DROP INDEX IDX_7252313A9395C3F3 ON flux');
        $this->addSql('ALTER TABLE flux DROP customer_id');
        $this->addSql('ALTER TABLE metier DROP FOREIGN KEY FK_51A00D8C9395C3F3');
        $this->addSql('DROP INDEX IDX_51A00D8C9395C3F3 ON metier');
        $this->addSql('ALTER TABLE metier DROP customer_id');
        $this->addSql('ALTER TABLE objet_metier DROP FOREIGN KEY FK_E47FE0A69395C3F3');
        $this->addSql('DROP INDEX IDX_E47FE0A69395C3F3 ON objet_metier');
        $this->addSql('ALTER TABLE objet_metier DROP customer_id');
        $this->addSql('ALTER TABLE site DROP FOREIGN KEY FK_694309E49395C3F3');
        $this->addSql('DROP INDEX IDX_694309E49395C3F3 ON site');
        $this->addSql('ALTER TABLE site DROP customer_id');
        $this->addSql('ALTER TABLE systeme DROP FOREIGN KEY FK_95796DE39395C3F3');
        $this->addSql('DROP INDEX IDX_95796DE39395C3F3 ON systeme');
        $this->addSql('ALTER TABLE systeme DROP customer_id');
    }
}
