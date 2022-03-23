<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211108122127 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE korekty (id INT AUTO_INCREMENT NOT NULL, formularz_id INT NOT NULL, weryfikujacy_id INT NOT NULL, zestawienie_id INT NOT NULL, informacja LONGTEXT DEFAULT NULL, data DATETIME NOT NULL, aktualna_wartosc NUMERIC(20, 2) NOT NULL, nowa_wartosc NUMERIC(20, 2) NOT NULL, INDEX IDX_449D9FDB5598D4C0 (formularz_id), INDEX IDX_449D9FDB3365870E (weryfikujacy_id), INDEX IDX_449D9FDB68F972A4 (zestawienie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE korekty ADD CONSTRAINT FK_449D9FDB5598D4C0 FOREIGN KEY (formularz_id) REFERENCES formularze (id)');
        $this->addSql('ALTER TABLE korekty ADD CONSTRAINT FK_449D9FDB3365870E FOREIGN KEY (weryfikujacy_id) REFERENCES uzytkownicy (id)');
        $this->addSql('ALTER TABLE korekty ADD CONSTRAINT FK_449D9FDB68F972A4 FOREIGN KEY (zestawienie_id) REFERENCES zestawienia (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE korekty');
    }
}
