<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190604172400 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE systeme DROP FOREIGN KEY FK_95796DE399597DA1');
        $this->addSql('ALTER TABLE systeme DROP FOREIGN KEY FK_95796DE3B656D6A2');
        $this->addSql('DROP INDEX IDX_95796DE3B656D6A2 ON systeme');
        $this->addSql('DROP INDEX IDX_95796DE399597DA1 ON systeme');
        $this->addSql('ALTER TABLE systeme DROP dima_id, DROP pdma_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE systeme ADD dima_id INT DEFAULT NULL, ADD pdma_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE systeme ADD CONSTRAINT FK_95796DE399597DA1 FOREIGN KEY (pdma_id) REFERENCES criticite (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE systeme ADD CONSTRAINT FK_95796DE3B656D6A2 FOREIGN KEY (dima_id) REFERENCES criticite (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_95796DE3B656D6A2 ON systeme (dima_id)');
        $this->addSql('CREATE INDEX IDX_95796DE399597DA1 ON systeme (pdma_id)');
    }
}
