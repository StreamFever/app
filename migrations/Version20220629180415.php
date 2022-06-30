<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220629180415 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE widgets ADD overlay_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE widgets ADD CONSTRAINT FK_9D58E4C1F77080E1 FOREIGN KEY (overlay_id) REFERENCES overlay (id)');
        $this->addSql('CREATE INDEX IDX_9D58E4C1F77080E1 ON widgets (overlay_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE widgets DROP FOREIGN KEY FK_9D58E4C1F77080E1');
        $this->addSql('DROP INDEX IDX_9D58E4C1F77080E1 ON widgets');
        $this->addSql('ALTER TABLE widgets DROP overlay_id');
    }
}
