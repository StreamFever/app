<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220606170906 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE edition (id INT AUTO_INCREMENT NOT NULL, edition_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE social (id INT AUTO_INCREMENT NOT NULL, social_name VARCHAR(255) NOT NULL, social_tag VARCHAR(255) NOT NULL, social_logo LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE event_sponsor');
        $this->addSql('ALTER TABLE event ADD event_edition_id INT DEFAULT NULL, DROP event_edition, DROP event_current_phase, CHANGE event_start_date event_start_date DATETIME NOT NULL, CHANGE event_end_date event_end_date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA72CC6C371 FOREIGN KEY (event_edition_id) REFERENCES edition (id)');
        $this->addSql('CREATE INDEX IDX_3BAE0AA72CC6C371 ON event (event_edition_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA72CC6C371');
        $this->addSql('CREATE TABLE event_sponsor (event_id INT NOT NULL, sponsor_id INT NOT NULL, INDEX IDX_4DB607B12F7FB51 (sponsor_id), INDEX IDX_4DB607B71F7E88B (event_id), PRIMARY KEY(event_id, sponsor_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE event_sponsor ADD CONSTRAINT FK_4DB607B71F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_sponsor ADD CONSTRAINT FK_4DB607B12F7FB51 FOREIGN KEY (sponsor_id) REFERENCES sponsor (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE edition');
        $this->addSql('DROP TABLE social');
        $this->addSql('DROP INDEX IDX_3BAE0AA72CC6C371 ON event');
        $this->addSql('ALTER TABLE event ADD event_edition VARCHAR(255) NOT NULL, ADD event_current_phase VARCHAR(255) DEFAULT NULL, DROP event_edition_id, CHANGE event_start_date event_start_date DATETIME DEFAULT NULL, CHANGE event_end_date event_end_date DATETIME DEFAULT NULL');
    }
}
