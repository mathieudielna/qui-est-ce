<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190605175512 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE flux_metier (flux_id INT NOT NULL, metier_id INT NOT NULL, INDEX IDX_E84330A7C85926E (flux_id), INDEX IDX_E84330A7ED16FA20 (metier_id), PRIMARY KEY(flux_id, metier_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE flux_tier (flux_id INT NOT NULL, tier_id INT NOT NULL, INDEX IDX_A88C39D8C85926E (flux_id), INDEX IDX_A88C39D8A354F9DC (tier_id), PRIMARY KEY(flux_id, tier_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE flux_metier ADD CONSTRAINT FK_E84330A7C85926E FOREIGN KEY (flux_id) REFERENCES flux (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE flux_metier ADD CONSTRAINT FK_E84330A7ED16FA20 FOREIGN KEY (metier_id) REFERENCES metier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE flux_tier ADD CONSTRAINT FK_A88C39D8C85926E FOREIGN KEY (flux_id) REFERENCES flux (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE flux_tier ADD CONSTRAINT FK_A88C39D8A354F9DC FOREIGN KEY (tier_id) REFERENCES tier (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE flux_metier');
        $this->addSql('DROP TABLE flux_tier');
    }
}
