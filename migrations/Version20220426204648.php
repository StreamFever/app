<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220426204648 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sponsors DROP FOREIGN KEY FK_9A31550F71F7E88B');
        $this->addSql('CREATE TABLE events (id INT AUTO_INCREMENT NOT NULL, event_name VARCHAR(255) NOT NULL, event_edition VARCHAR(255) NOT NULL, event_logo LONGTEXT DEFAULT NULL, event_hashtag VARCHAR(255) DEFAULT NULL, event_cashprize VARCHAR(255) DEFAULT NULL, event_current_phase VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE events_sponsors (events_id INT NOT NULL, sponsors_id INT NOT NULL, INDEX IDX_6705CD0C9D6A1065 (events_id), INDEX IDX_6705CD0CFB0F2BBC (sponsors_id), PRIMARY KEY(events_id, sponsors_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE events_sponsors ADD CONSTRAINT FK_6705CD0C9D6A1065 FOREIGN KEY (events_id) REFERENCES events (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE events_sponsors ADD CONSTRAINT FK_6705CD0CFB0F2BBC FOREIGN KEY (sponsors_id) REFERENCES sponsors (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP INDEX IDX_9A31550F71F7E88B ON sponsors');
        $this->addSql('ALTER TABLE sponsors DROP event_id, CHANGE sponsor_logo sponsor_logo LONGTEXT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE events_sponsors DROP FOREIGN KEY FK_6705CD0C9D6A1065');
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, event_name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, event_edition VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, event_logo LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, event_hashtag VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, event_cashprize VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, event_current_phase VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE events');
        $this->addSql('DROP TABLE events_sponsors');
        $this->addSql('ALTER TABLE sponsors ADD event_id INT DEFAULT NULL, CHANGE sponsor_logo sponsor_logo LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE sponsors ADD CONSTRAINT FK_9A31550F71F7E88B FOREIGN KEY (event_id) REFERENCES event (id)');
        $this->addSql('CREATE INDEX IDX_9A31550F71F7E88B ON sponsors (event_id)');
    }
}
