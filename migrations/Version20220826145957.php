<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220826145957 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event ADD current_game_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA74E825C80 FOREIGN KEY (current_game_id) REFERENCES game (id)');
        $this->addSql('CREATE INDEX IDX_3BAE0AA74E825C80 ON event (current_game_id)');
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318CEC8F92A1');
        $this->addSql('DROP INDEX IDX_232B318CEC8F92A1 ON game');
        $this->addSql('ALTER TABLE game DROP current_event_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA74E825C80');
        $this->addSql('DROP INDEX IDX_3BAE0AA74E825C80 ON event');
        $this->addSql('ALTER TABLE event DROP current_game_id');
        $this->addSql('ALTER TABLE game ADD current_event_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318CEC8F92A1 FOREIGN KEY (current_event_id) REFERENCES event (id)');
        $this->addSql('CREATE INDEX IDX_232B318CEC8F92A1 ON game (current_event_id)');
    }
}
