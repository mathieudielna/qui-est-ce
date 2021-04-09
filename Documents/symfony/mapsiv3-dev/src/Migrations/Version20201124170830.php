<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201124170830 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE metier ADD slug VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE tier ADD slug VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE ressource ADD slug VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE people ADD slug VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE metier DROP slug');
        $this->addSql('ALTER TABLE people DROP slug');
        $this->addSql('ALTER TABLE ressource DROP slug');
        $this->addSql('ALTER TABLE tier DROP slug');
    }
}
