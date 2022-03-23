<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211107212903 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE podsumowanie ADD suma_grunty_przekazane_uzytkowanie_wieczyste NUMERIC(20, 2) DEFAULT NULL, ADD suma_grunty_inne_niz_przekazane_uzytkowanie_wieczyste NUMERIC(20, 2) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE podsumowanie DROP suma_grunty_przekazane_uzytkowanie_wieczyste, DROP suma_grunty_inne_niz_przekazane_uzytkowanie_wieczyste');
    }
}
