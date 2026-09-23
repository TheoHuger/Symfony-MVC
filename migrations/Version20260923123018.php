<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260923123018 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE obtenir ADD adherent_id INT NOT NULL');
        $this->addSql('ALTER TABLE obtenir ADD CONSTRAINT FK_ED792AC925F06C53 FOREIGN KEY (adherent_id) REFERENCES adherent (id) NOT DEFERRABLE');
        $this->addSql('CREATE INDEX IDX_ED792AC925F06C53 ON obtenir (adherent_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE obtenir DROP CONSTRAINT FK_ED792AC925F06C53');
        $this->addSql('DROP INDEX IDX_ED792AC925F06C53');
        $this->addSql('ALTER TABLE obtenir DROP adherent_id');
    }
}
