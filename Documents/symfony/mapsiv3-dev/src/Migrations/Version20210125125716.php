<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210125125716 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE reclamation_type_reclamation (reclamation_id INT NOT NULL, type_reclamation_id INT NOT NULL, INDEX IDX_F9AF289E2D6BA2D9 (reclamation_id), INDEX IDX_F9AF289E7BA88B4D (type_reclamation_id), PRIMARY KEY(reclamation_id, type_reclamation_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reclamation_type_reclamation ADD CONSTRAINT FK_F9AF289E2D6BA2D9 FOREIGN KEY (reclamation_id) REFERENCES reclamation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reclamation_type_reclamation ADD CONSTRAINT FK_F9AF289E7BA88B4D FOREIGN KEY (type_reclamation_id) REFERENCES type_reclamation (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE reclamation_type_reclamation');
    }
}
