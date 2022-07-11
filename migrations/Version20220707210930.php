<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220707210930 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event ADD overlay_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7A5E79627 FOREIGN KEY (overlay_id_id) REFERENCES overlay (id)');
        $this->addSql('CREATE INDEX IDX_3BAE0AA7A5E79627 ON event (overlay_id_id)');
        $this->addSql('ALTER TABLE game ADD overlay_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318CA5E79627 FOREIGN KEY (overlay_id_id) REFERENCES overlay (id)');
        $this->addSql('CREATE INDEX IDX_232B318CA5E79627 ON game (overlay_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7A5E79627');
        $this->addSql('DROP INDEX IDX_3BAE0AA7A5E79627 ON event');
        $this->addSql('ALTER TABLE event DROP overlay_id_id');
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318CA5E79627');
        $this->addSql('DROP INDEX IDX_232B318CA5E79627 ON game');
        $this->addSql('ALTER TABLE game DROP overlay_id_id');
    }
}
