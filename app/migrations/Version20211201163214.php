<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211201163214 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE korekty DROP FOREIGN KEY FK_449D9FDB68F972A4');
        $this->addSql('DROP INDEX IDX_449D9FDB68F972A4 ON korekty');
        $this->addSql('ALTER TABLE korekty DROP zestawienie_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE korekty ADD zestawienie_id INT NOT NULL');
        $this->addSql('ALTER TABLE korekty ADD CONSTRAINT FK_449D9FDB68F972A4 FOREIGN KEY (zestawienie_id) REFERENCES zestawienia (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_449D9FDB68F972A4 ON korekty (zestawienie_id)');
    }
}
