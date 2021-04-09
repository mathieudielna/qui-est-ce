<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190528204542 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE activite ADD perteactivite LONGTEXT DEFAULT NULL, ADD impactimg LONGTEXT DEFAULT NULL, ADD impactactionnaire LONGTEXT DEFAULT NULL, ADD impactinterne LONGTEXT DEFAULT NULL, ADD impactbusinessfutur LONGTEXT DEFAULT NULL, ADD impact4h VARCHAR(255) DEFAULT NULL, ADD impact1j VARCHAR(255) DEFAULT NULL, ADD impact3j VARCHAR(255) DEFAULT NULL, ADD impact1s VARCHAR(255) DEFAULT NULL, ADD impact2s VARCHAR(255) DEFAULT NULL, ADD impact1m VARCHAR(255) DEFAULT NULL, ADD perturbationinterne LONGTEXT NOT NULL, ADD perturbationexterne LONGTEXT DEFAULT NULL, ADD traitementarriere LONGTEXT DEFAULT NULL, ADD alternativesecours LONGTEXT DEFAULT NULL, ADD procedurepca VARCHAR(255) DEFAULT NULL, ADD latencepca LONGTEXT DEFAULT NULL, ADD traitementimmediat LONGTEXT DEFAULT NULL, ADD conditionmaintien LONGTEXT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE activite DROP perteactivite, DROP impactimg, DROP impactactionnaire, DROP impactinterne, DROP impactbusinessfutur, DROP impact4h, DROP impact1j, DROP impact3j, DROP impact1s, DROP impact2s, DROP impact1m, DROP perturbationinterne, DROP perturbationexterne, DROP traitementarriere, DROP alternativesecours, DROP procedurepca, DROP latencepca, DROP traitementimmediat, DROP conditionmaintien');
    }
}
