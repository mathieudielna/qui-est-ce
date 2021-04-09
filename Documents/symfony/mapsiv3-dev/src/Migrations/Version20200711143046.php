<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200711143046 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE policy (id INT AUTO_INCREMENT NOT NULL, responsable_id INT DEFAULT NULL, suppleant_id INT DEFAULT NULL, customer_id INT DEFAULT NULL, publisher_id INT DEFAULT NULL, designation VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, commentaire LONGTEXT DEFAULT NULL, published_at DATETIME DEFAULT NULL, INDEX IDX_F07D051653C59D72 (responsable_id), INDEX IDX_F07D051667A3C51B (suppleant_id), INDEX IDX_F07D05169395C3F3 (customer_id), INDEX IDX_F07D051640C86FCE (publisher_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE policy ADD CONSTRAINT FK_F07D051653C59D72 FOREIGN KEY (responsable_id) REFERENCES people (id)');
        $this->addSql('ALTER TABLE policy ADD CONSTRAINT FK_F07D051667A3C51B FOREIGN KEY (suppleant_id) REFERENCES people (id)');
        $this->addSql('ALTER TABLE policy ADD CONSTRAINT FK_F07D05169395C3F3 FOREIGN KEY (customer_id) REFERENCES mapsi_customer (id)');
        $this->addSql('ALTER TABLE policy ADD CONSTRAINT FK_F07D051640C86FCE FOREIGN KEY (publisher_id) REFERENCES people (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE policy');
    }
}
