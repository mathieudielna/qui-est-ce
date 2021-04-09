<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190528211944 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE activite ADD impact_interne_id INT DEFAULT NULL, ADD activite_businessfutur_id INT DEFAULT NULL, DROP impactinterne, DROP impactbusinessfutur');
        $this->addSql('ALTER TABLE activite ADD CONSTRAINT FK_B87555153EDD8BEB FOREIGN KEY (impact_interne_id) REFERENCES niveau_impact (id)');
        $this->addSql('ALTER TABLE activite ADD CONSTRAINT FK_B8755515CB2343C4 FOREIGN KEY (activite_businessfutur_id) REFERENCES niveau_impact (id)');
        $this->addSql('CREATE INDEX IDX_B87555153EDD8BEB ON activite (impact_interne_id)');
        $this->addSql('CREATE INDEX IDX_B8755515CB2343C4 ON activite (activite_businessfutur_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE activite DROP FOREIGN KEY FK_B87555153EDD8BEB');
        $this->addSql('ALTER TABLE activite DROP FOREIGN KEY FK_B8755515CB2343C4');
        $this->addSql('DROP INDEX IDX_B87555153EDD8BEB ON activite');
        $this->addSql('DROP INDEX IDX_B8755515CB2343C4 ON activite');
        $this->addSql('ALTER TABLE activite ADD impactinterne VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD impactbusinessfutur VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, DROP impact_interne_id, DROP activite_businessfutur_id');
    }
}
