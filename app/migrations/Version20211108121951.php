<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211108121951 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE korekta (id INT AUTO_INCREMENT NOT NULL, formularz_id INT NOT NULL, weryfikujacy_id INT NOT NULL, informacja LONGTEXT DEFAULT NULL, data DATETIME NOT NULL, aktualna_wartosc NUMERIC(20, 2) NOT NULL, nowa_wartosc NUMERIC(20, 2) NOT NULL, INDEX IDX_57F1078D5598D4C0 (formularz_id), INDEX IDX_57F1078D3365870E (weryfikujacy_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE korekta ADD CONSTRAINT FK_57F1078D5598D4C0 FOREIGN KEY (formularz_id) REFERENCES formularze (id)');
        $this->addSql('ALTER TABLE korekta ADD CONSTRAINT FK_57F1078D3365870E FOREIGN KEY (weryfikujacy_id) REFERENCES uzytkownicy (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE korekta');
    }
}
