<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211112073703 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE korekta');
        $this->addSql('ALTER TABLE podsumowanie ADD suma_grunty_rok_poprzedni NUMERIC(20, 2) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE korekta (id INT AUTO_INCREMENT NOT NULL, formularz_id INT NOT NULL, weryfikujacy_id INT NOT NULL, informacja LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, data DATETIME NOT NULL, aktualna_wartosc NUMERIC(20, 2) NOT NULL, nowa_wartosc NUMERIC(20, 2) NOT NULL, INDEX IDX_57F1078D3365870E (weryfikujacy_id), INDEX IDX_57F1078D5598D4C0 (formularz_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE korekta ADD CONSTRAINT FK_57F1078D3365870E FOREIGN KEY (weryfikujacy_id) REFERENCES uzytkownicy (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE korekta ADD CONSTRAINT FK_57F1078D5598D4C0 FOREIGN KEY (formularz_id) REFERENCES formularze (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE podsumowanie DROP suma_grunty_rok_poprzedni');
    }
}
