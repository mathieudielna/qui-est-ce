<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201124150422 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE application ADD slug VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE activite ADD slug VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE processus ADD slug VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE objet_metier ADD slug VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE flux ADD slug VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE systeme ADD slug VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE activite DROP slug');
        $this->addSql('ALTER TABLE application DROP slug');
        $this->addSql('ALTER TABLE flux DROP slug');
        $this->addSql('ALTER TABLE objet_metier DROP slug');
        $this->addSql('ALTER TABLE processus DROP slug');
        $this->addSql('ALTER TABLE systeme DROP slug');
    }
}
