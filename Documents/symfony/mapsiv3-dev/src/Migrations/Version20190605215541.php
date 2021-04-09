<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190605215541 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE flux ADD accordcollecte_id INT DEFAULT NULL, ADD accordutilisation_id INT DEFAULT NULL, ADD dcpsstraitant_id INT DEFAULT NULL, DROP accordcollecte, DROP accordutilisation');
        $this->addSql('ALTER TABLE flux ADD CONSTRAINT FK_7252313A4F5EF552 FOREIGN KEY (accordcollecte_id) REFERENCES oui_non (id)');
        $this->addSql('ALTER TABLE flux ADD CONSTRAINT FK_7252313AC8ACB4A7 FOREIGN KEY (accordutilisation_id) REFERENCES oui_non (id)');
        $this->addSql('ALTER TABLE flux ADD CONSTRAINT FK_7252313A5426C565 FOREIGN KEY (dcpsstraitant_id) REFERENCES oui_non (id)');
        $this->addSql('CREATE INDEX IDX_7252313A4F5EF552 ON flux (accordcollecte_id)');
        $this->addSql('CREATE INDEX IDX_7252313AC8ACB4A7 ON flux (accordutilisation_id)');
        $this->addSql('CREATE INDEX IDX_7252313A5426C565 ON flux (dcpsstraitant_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE flux DROP FOREIGN KEY FK_7252313A4F5EF552');
        $this->addSql('ALTER TABLE flux DROP FOREIGN KEY FK_7252313AC8ACB4A7');
        $this->addSql('ALTER TABLE flux DROP FOREIGN KEY FK_7252313A5426C565');
        $this->addSql('DROP INDEX IDX_7252313A4F5EF552 ON flux');
        $this->addSql('DROP INDEX IDX_7252313AC8ACB4A7 ON flux');
        $this->addSql('DROP INDEX IDX_7252313A5426C565 ON flux');
        $this->addSql('ALTER TABLE flux ADD accordcollecte VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD accordutilisation VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, DROP accordcollecte_id, DROP accordutilisation_id, DROP dcpsstraitant_id');
    }
}
