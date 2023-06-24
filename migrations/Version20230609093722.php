<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230609093722 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD firstname VARCHAR(255) NOT NULL, ADD preprovision VARCHAR(255) DEFAULT NULL, ADD lastname VARCHAR(255) NOT NULL, ADD dateofbirth VARCHAR(255) NOT NULL, ADD hiring_date VARCHAR(255) DEFAULT NULL, ADD salary NUMERIC(10, 2) DEFAULT NULL, ADD social_sec_number VARCHAR(255) DEFAULT NULL, ADD street VARCHAR(255) DEFAULT NULL, ADD place VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP firstname, DROP preprovision, DROP lastname, DROP dateofbirth, DROP hiring_date, DROP salary, DROP social_sec_number, DROP street, DROP place');
    }
}
