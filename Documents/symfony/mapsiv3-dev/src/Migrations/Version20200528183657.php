<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200528183657 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE anomalie_action (anomalie_id INT NOT NULL, action_id INT NOT NULL, INDEX IDX_E5F7A581AEEAB197 (anomalie_id), INDEX IDX_E5F7A5819D32F035 (action_id), PRIMARY KEY(anomalie_id, action_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE anomalie_action ADD CONSTRAINT FK_E5F7A581AEEAB197 FOREIGN KEY (anomalie_id) REFERENCES anomalie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE anomalie_action ADD CONSTRAINT FK_E5F7A5819D32F035 FOREIGN KEY (action_id) REFERENCES action (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE anomalie_action');
    }
}
