<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211105221814 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE dzielnice (id INT AUTO_INCREMENT NOT NULL, nazwa VARCHAR(255) NOT NULL, robocza VARCHAR(255) NOT NULL, status INT NOT NULL, identyfikator INT NOT NULL, symbol VARCHAR(15) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formularze (id INT AUTO_INCREMENT NOT NULL, jednostka_id INT NOT NULL, worker_id INT DEFAULT NULL, rok_zestawieniowy_id INT NOT NULL, forma_organizacyjna_rok_poprzedni_id INT NOT NULL, forma_organizacyjna_rok_aktualny_id INT NOT NULL, data_utworzenia DATETIME NOT NULL, state VARCHAR(15) DEFAULT NULL, notatka VARCHAR(255) DEFAULT NULL, INDEX IDX_8377C731641E7B2E (jednostka_id), INDEX IDX_8377C7316B20BA36 (worker_id), INDEX IDX_8377C731BBACF9E5 (rok_zestawieniowy_id), INDEX IDX_8377C73192553017 (forma_organizacyjna_rok_poprzedni_id), INDEX IDX_8377C731AB8D857B (forma_organizacyjna_rok_aktualny_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formy_organizacyjne (id INT AUTO_INCREMENT NOT NULL, nazwa VARCHAR(255) DEFAULT NULL, identyfikator INT DEFAULT NULL, skrot VARCHAR(10) DEFAULT NULL, status INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE grupy (id INT AUTO_INCREMENT NOT NULL, nazwa VARCHAR(255) NOT NULL, status INT NOT NULL, robocza VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE historia (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE import_file (id INT AUTO_INCREMENT NOT NULL, nazwa VARCHAR(255) NOT NULL, plik VARCHAR(255) NOT NULL, data DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE jednostki (id INT AUTO_INCREMENT NOT NULL, dzielnica_id INT DEFAULT NULL, forma_organizacyjna_id INT DEFAULT NULL, nazwa VARCHAR(255) DEFAULT NULL, ulica VARCHAR(255) DEFAULT NULL, numer VARCHAR(100) DEFAULT NULL, kod_pocztowy VARCHAR(100) DEFAULT NULL, identyfikator INT DEFAULT NULL, miasto VARCHAR(20) DEFAULT NULL, nazwa_pelna VARCHAR(255) DEFAULT NULL, symbol VARCHAR(255) DEFAULT NULL, urzad_id INT DEFAULT NULL, forma_organizacyjna_idf INT DEFAULT NULL, INDEX IDX_793FF365C0342D39 (dzielnica_id), INDEX IDX_793FF365BB7C4062 (forma_organizacyjna_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lata_zestawieniowe (id INT AUTO_INCREMENT NOT NULL, rok INT NOT NULL, identyfikator INT NOT NULL, status INT NOT NULL, kolejnosc INT NOT NULL, robocza VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lista_czynnikow (id INT AUTO_INCREMENT NOT NULL, pracownik_id INT NOT NULL, podgrupa_id INT NOT NULL, formularz_id INT NOT NULL, tresc LONGTEXT NOT NULL, typ VARCHAR(255) NOT NULL, data DATETIME NOT NULL, INDEX IDX_107EAC0D51E53502 (pracownik_id), INDEX IDX_107EAC0DADB8F413 (podgrupa_id), INDEX IDX_107EAC0D5598D4C0 (formularz_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE logi (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE podgrupy (id INT AUTO_INCREMENT NOT NULL, grupa_id INT NOT NULL, nazwa VARCHAR(255) NOT NULL, status INT NOT NULL, kolejnosc INT NOT NULL, robocza VARCHAR(255) NOT NULL, INDEX IDX_9911E6267C5C4730 (grupa_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE podsumowanie (id INT AUTO_INCREMENT NOT NULL, suma_budynki NUMERIC(20, 2) DEFAULT NULL, suma_grunty NUMERIC(20, 2) DEFAULT NULL, suma_nieruchomosci_inwestycyjne NUMERIC(20, 2) DEFAULT NULL, suma_naleznosci_dlugoterminowe NUMERIC(20, 2) DEFAULT NULL, suma_dlugoterminowe_aktywa_finansowe NUMERIC(20, 2) DEFAULT NULL, suma_pozostale_srodki_trwale NUMERIC(20, 2) DEFAULT NULL, suma_srodki_trwale NUMERIC(20, 2) DEFAULT NULL, suma_wartosci_niematerialne NUMERIC(20, 2) DEFAULT NULL, suma_rok_poprzedni NUMERIC(20, 2) DEFAULT NULL, suma_rok_biezacy NUMERIC(20, 2) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE powiadomienia (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE przeplywy (id INT AUTO_INCREMENT NOT NULL, formularz_id INT NOT NULL, status_id INT NOT NULL, data DATETIME NOT NULL, INDEX IDX_725B8D185598D4C0 (formularz_id), INDEX IDX_725B8D186BF700BD (status_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE statusy (id INT AUTO_INCREMENT NOT NULL, tresc VARCHAR(255) DEFAULT NULL, icon VARCHAR(255) DEFAULT NULL, identyfikator INT NOT NULL, klasa VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE uzasadnienia (id INT AUTO_INCREMENT NOT NULL, zestawienie_id INT NOT NULL, komentarz_pozytywny LONGTEXT DEFAULT NULL, komentarz_negatywny LONGTEXT DEFAULT NULL, INDEX IDX_29E5795C68F972A4 (zestawienie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE uzytkownicy (id INT AUTO_INCREMENT NOT NULL, dzielnica_id INT DEFAULT NULL, imie VARCHAR(100) DEFAULT NULL, nazwisko VARCHAR(100) DEFAULT NULL, email VARCHAR(150) DEFAULT NULL, czy_domenowy INT DEFAULT NULL, status INT NOT NULL, login VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) DEFAULT NULL, kiedy_utworzony DATETIME NOT NULL, UNIQUE INDEX UNIQ_B194A8C4AA08CB10 (login), INDEX IDX_B194A8C4C0342D39 (dzielnica_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE wiadomosci (id INT AUTO_INCREMENT NOT NULL, od_kogo_id INT NOT NULL, do_kogo_id INT NOT NULL, formularz_id INT NOT NULL, tytul VARCHAR(255) NOT NULL, tresc LONGTEXT NOT NULL, czy_odczytano INT NOT NULL, data_wyslania DATETIME NOT NULL, INDEX IDX_B32BD70CEFABF3F3 (od_kogo_id), INDEX IDX_B32BD70C951E96D9 (do_kogo_id), INDEX IDX_B32BD70C5598D4C0 (formularz_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE zestawienia (id INT AUTO_INCREMENT NOT NULL, formularz_id INT NOT NULL, podgrupa_id INT NOT NULL, wartosc_rok_zestawieniowy NUMERIC(20, 2) DEFAULT NULL, wartosc_rok_poprzedni NUMERIC(20, 2) DEFAULT NULL, wartosc_roznica_kwot NUMERIC(20, 2) DEFAULT NULL, wartosc_procentowa NUMERIC(20, 2) DEFAULT NULL, INDEX IDX_CE0F1BFA5598D4C0 (formularz_id), INDEX IDX_CE0F1BFAADB8F413 (podgrupa_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE formularze ADD CONSTRAINT FK_8377C731641E7B2E FOREIGN KEY (jednostka_id) REFERENCES jednostki (id)');
        $this->addSql('ALTER TABLE formularze ADD CONSTRAINT FK_8377C7316B20BA36 FOREIGN KEY (worker_id) REFERENCES uzytkownicy (id)');
        $this->addSql('ALTER TABLE formularze ADD CONSTRAINT FK_8377C731BBACF9E5 FOREIGN KEY (rok_zestawieniowy_id) REFERENCES lata_zestawieniowe (id)');
        $this->addSql('ALTER TABLE formularze ADD CONSTRAINT FK_8377C73192553017 FOREIGN KEY (forma_organizacyjna_rok_poprzedni_id) REFERENCES formy_organizacyjne (id)');
        $this->addSql('ALTER TABLE formularze ADD CONSTRAINT FK_8377C731AB8D857B FOREIGN KEY (forma_organizacyjna_rok_aktualny_id) REFERENCES formy_organizacyjne (id)');
        $this->addSql('ALTER TABLE jednostki ADD CONSTRAINT FK_793FF365C0342D39 FOREIGN KEY (dzielnica_id) REFERENCES dzielnice (id)');
        $this->addSql('ALTER TABLE jednostki ADD CONSTRAINT FK_793FF365BB7C4062 FOREIGN KEY (forma_organizacyjna_id) REFERENCES formy_organizacyjne (id)');
        $this->addSql('ALTER TABLE lista_czynnikow ADD CONSTRAINT FK_107EAC0D51E53502 FOREIGN KEY (pracownik_id) REFERENCES uzytkownicy (id)');
        $this->addSql('ALTER TABLE lista_czynnikow ADD CONSTRAINT FK_107EAC0DADB8F413 FOREIGN KEY (podgrupa_id) REFERENCES podgrupy (id)');
        $this->addSql('ALTER TABLE lista_czynnikow ADD CONSTRAINT FK_107EAC0D5598D4C0 FOREIGN KEY (formularz_id) REFERENCES formularze (id)');
        $this->addSql('ALTER TABLE podgrupy ADD CONSTRAINT FK_9911E6267C5C4730 FOREIGN KEY (grupa_id) REFERENCES grupy (id)');
        $this->addSql('ALTER TABLE przeplywy ADD CONSTRAINT FK_725B8D185598D4C0 FOREIGN KEY (formularz_id) REFERENCES formularze (id)');
        $this->addSql('ALTER TABLE przeplywy ADD CONSTRAINT FK_725B8D186BF700BD FOREIGN KEY (status_id) REFERENCES statusy (id)');
        $this->addSql('ALTER TABLE uzasadnienia ADD CONSTRAINT FK_29E5795C68F972A4 FOREIGN KEY (zestawienie_id) REFERENCES zestawienia (id)');
        $this->addSql('ALTER TABLE uzytkownicy ADD CONSTRAINT FK_B194A8C4C0342D39 FOREIGN KEY (dzielnica_id) REFERENCES dzielnice (id)');
        $this->addSql('ALTER TABLE wiadomosci ADD CONSTRAINT FK_B32BD70CEFABF3F3 FOREIGN KEY (od_kogo_id) REFERENCES uzytkownicy (id)');
        $this->addSql('ALTER TABLE wiadomosci ADD CONSTRAINT FK_B32BD70C951E96D9 FOREIGN KEY (do_kogo_id) REFERENCES uzytkownicy (id)');
        $this->addSql('ALTER TABLE wiadomosci ADD CONSTRAINT FK_B32BD70C5598D4C0 FOREIGN KEY (formularz_id) REFERENCES formularze (id)');
        $this->addSql('ALTER TABLE zestawienia ADD CONSTRAINT FK_CE0F1BFA5598D4C0 FOREIGN KEY (formularz_id) REFERENCES formularze (id)');
        $this->addSql('ALTER TABLE zestawienia ADD CONSTRAINT FK_CE0F1BFAADB8F413 FOREIGN KEY (podgrupa_id) REFERENCES podgrupy (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE jednostki DROP FOREIGN KEY FK_793FF365C0342D39');
        $this->addSql('ALTER TABLE uzytkownicy DROP FOREIGN KEY FK_B194A8C4C0342D39');
        $this->addSql('ALTER TABLE lista_czynnikow DROP FOREIGN KEY FK_107EAC0D5598D4C0');
        $this->addSql('ALTER TABLE przeplywy DROP FOREIGN KEY FK_725B8D185598D4C0');
        $this->addSql('ALTER TABLE wiadomosci DROP FOREIGN KEY FK_B32BD70C5598D4C0');
        $this->addSql('ALTER TABLE zestawienia DROP FOREIGN KEY FK_CE0F1BFA5598D4C0');
        $this->addSql('ALTER TABLE formularze DROP FOREIGN KEY FK_8377C73192553017');
        $this->addSql('ALTER TABLE formularze DROP FOREIGN KEY FK_8377C731AB8D857B');
        $this->addSql('ALTER TABLE jednostki DROP FOREIGN KEY FK_793FF365BB7C4062');
        $this->addSql('ALTER TABLE podgrupy DROP FOREIGN KEY FK_9911E6267C5C4730');
        $this->addSql('ALTER TABLE formularze DROP FOREIGN KEY FK_8377C731641E7B2E');
        $this->addSql('ALTER TABLE formularze DROP FOREIGN KEY FK_8377C731BBACF9E5');
        $this->addSql('ALTER TABLE lista_czynnikow DROP FOREIGN KEY FK_107EAC0DADB8F413');
        $this->addSql('ALTER TABLE zestawienia DROP FOREIGN KEY FK_CE0F1BFAADB8F413');
        $this->addSql('ALTER TABLE przeplywy DROP FOREIGN KEY FK_725B8D186BF700BD');
        $this->addSql('ALTER TABLE formularze DROP FOREIGN KEY FK_8377C7316B20BA36');
        $this->addSql('ALTER TABLE lista_czynnikow DROP FOREIGN KEY FK_107EAC0D51E53502');
        $this->addSql('ALTER TABLE wiadomosci DROP FOREIGN KEY FK_B32BD70CEFABF3F3');
        $this->addSql('ALTER TABLE wiadomosci DROP FOREIGN KEY FK_B32BD70C951E96D9');
        $this->addSql('ALTER TABLE uzasadnienia DROP FOREIGN KEY FK_29E5795C68F972A4');
        $this->addSql('DROP TABLE dzielnice');
        $this->addSql('DROP TABLE formularze');
        $this->addSql('DROP TABLE formy_organizacyjne');
        $this->addSql('DROP TABLE grupy');
        $this->addSql('DROP TABLE historia');
        $this->addSql('DROP TABLE import_file');
        $this->addSql('DROP TABLE jednostki');
        $this->addSql('DROP TABLE lata_zestawieniowe');
        $this->addSql('DROP TABLE lista_czynnikow');
        $this->addSql('DROP TABLE logi');
        $this->addSql('DROP TABLE podgrupy');
        $this->addSql('DROP TABLE podsumowanie');
        $this->addSql('DROP TABLE powiadomienia');
        $this->addSql('DROP TABLE przeplywy');
        $this->addSql('DROP TABLE statusy');
        $this->addSql('DROP TABLE uzasadnienia');
        $this->addSql('DROP TABLE uzytkownicy');
        $this->addSql('DROP TABLE wiadomosci');
        $this->addSql('DROP TABLE zestawienia');
    }
}
