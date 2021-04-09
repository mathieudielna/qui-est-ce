<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201029201715 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE tier_people (tier_id INT NOT NULL, people_id INT NOT NULL, INDEX IDX_BC46BFFAA354F9DC (tier_id), INDEX IDX_BC46BFFA3147C936 (people_id), PRIMARY KEY(tier_id, people_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tier_people ADD CONSTRAINT FK_BC46BFFAA354F9DC FOREIGN KEY (tier_id) REFERENCES tier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tier_people ADD CONSTRAINT FK_BC46BFFA3147C936 FOREIGN KEY (people_id) REFERENCES people (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tier ADD responsable_id INT DEFAULT NULL, ADD suppleant_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tier ADD CONSTRAINT FK_249E978A53C59D72 FOREIGN KEY (responsable_id) REFERENCES people (id)');
        $this->addSql('ALTER TABLE tier ADD CONSTRAINT FK_249E978A67A3C51B FOREIGN KEY (suppleant_id) REFERENCES people (id)');
        $this->addSql('CREATE INDEX IDX_249E978A53C59D72 ON tier (responsable_id)');
        $this->addSql('CREATE INDEX IDX_249E978A67A3C51B ON tier (suppleant_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE tier_people');
        $this->addSql('ALTER TABLE tier DROP FOREIGN KEY FK_249E978A53C59D72');
        $this->addSql('ALTER TABLE tier DROP FOREIGN KEY FK_249E978A67A3C51B');
        $this->addSql('DROP INDEX IDX_249E978A53C59D72 ON tier');
        $this->addSql('DROP INDEX IDX_249E978A67A3C51B ON tier');
        $this->addSql('ALTER TABLE tier DROP responsable_id, DROP suppleant_id');
    }
}
