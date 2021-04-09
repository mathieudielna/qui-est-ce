<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201126183508 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE dysfonctionnement_type_conformite (dysfonctionnement_id INT NOT NULL, type_conformite_id INT NOT NULL, INDEX IDX_7C5CEC04F1CDBB81 (dysfonctionnement_id), INDEX IDX_7C5CEC0479A28B64 (type_conformite_id), PRIMARY KEY(dysfonctionnement_id, type_conformite_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE dysfonctionnement_type_conformite ADD CONSTRAINT FK_7C5CEC04F1CDBB81 FOREIGN KEY (dysfonctionnement_id) REFERENCES dysfonctionnement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dysfonctionnement_type_conformite ADD CONSTRAINT FK_7C5CEC0479A28B64 FOREIGN KEY (type_conformite_id) REFERENCES type_conformite (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE dysfonctionnement_type_conformite');
    }
}
