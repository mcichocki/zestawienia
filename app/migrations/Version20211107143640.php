<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211107143640 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE podsumowanie ADD formularz_id INT NOT NULL');
        $this->addSql('ALTER TABLE podsumowanie ADD CONSTRAINT FK_79247E8B5598D4C0 FOREIGN KEY (formularz_id) REFERENCES formularze (id)');
        $this->addSql('CREATE INDEX IDX_79247E8B5598D4C0 ON podsumowanie (formularz_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE podsumowanie DROP FOREIGN KEY FK_79247E8B5598D4C0');
        $this->addSql('DROP INDEX IDX_79247E8B5598D4C0 ON podsumowanie');
        $this->addSql('ALTER TABLE podsumowanie DROP formularz_id');
    }
}
