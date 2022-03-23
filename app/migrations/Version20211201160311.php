<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211201160311 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE korekty ADD suma NUMERIC(20, 2) DEFAULT NULL, ADD nowa_suma NUMERIC(20, 2) DEFAULT NULL');
        $this->addSql('ALTER TABLE zestawienia ADD korekta_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE zestawienia ADD CONSTRAINT FK_CE0F1BFAA5719F9 FOREIGN KEY (korekta_id) REFERENCES korekty (id)');
        $this->addSql('CREATE INDEX IDX_CE0F1BFAA5719F9 ON zestawienia (korekta_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE korekty DROP suma, DROP nowa_suma');
        $this->addSql('ALTER TABLE zestawienia DROP FOREIGN KEY FK_CE0F1BFAA5719F9');
        $this->addSql('DROP INDEX IDX_CE0F1BFAA5719F9 ON zestawienia');
        $this->addSql('ALTER TABLE zestawienia DROP korekta_id');
    }
}
