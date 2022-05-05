<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220428182853 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, event_name VARCHAR(255) NOT NULL, event_edition VARCHAR(255) NOT NULL, event_logo LONGTEXT DEFAULT NULL, event_hashtag VARCHAR(255) DEFAULT NULL, event_cashprize VARCHAR(255) DEFAULT NULL, event_current_phase VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event_sponsor (event_id INT NOT NULL, sponsor_id INT NOT NULL, INDEX IDX_4DB607B71F7E88B (event_id), INDEX IDX_4DB607B12F7FB51 (sponsor_id), PRIMARY KEY(event_id, sponsor_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game (id INT AUTO_INCREMENT NOT NULL, game_idteam_alpha_id INT DEFAULT NULL, game_idteam_beta_id INT DEFAULT NULL, game_score_alpha INT DEFAULT NULL, game_score_beta INT DEFAULT NULL, game_time_next VARCHAR(255) DEFAULT NULL, game_format VARCHAR(255) DEFAULT NULL, game_status VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_232B318C33E7E896 (game_idteam_alpha_id), UNIQUE INDEX UNIQ_232B318CACA88462 (game_idteam_beta_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game_map (game_id INT NOT NULL, map_id INT NOT NULL, INDEX IDX_88F7B97EE48FD905 (game_id), INDEX IDX_88F7B97E53C55F64 (map_id), PRIMARY KEY(game_id, map_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sponsor (id INT AUTO_INCREMENT NOT NULL, sponsor_name VARCHAR(255) NOT NULL, sponsor_logo LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tweet (id INT AUTO_INCREMENT NOT NULL, tweet_pseudo VARCHAR(255) NOT NULL, tweet_at VARCHAR(255) NOT NULL, tweet_avatar LONGTEXT DEFAULT NULL, tweet_media_type LONGTEXT DEFAULT NULL, tweet_media_url LONGTEXT DEFAULT NULL, tweet_content LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE event_sponsor ADD CONSTRAINT FK_4DB607B71F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_sponsor ADD CONSTRAINT FK_4DB607B12F7FB51 FOREIGN KEY (sponsor_id) REFERENCES sponsor (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C33E7E896 FOREIGN KEY (game_idteam_alpha_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318CACA88462 FOREIGN KEY (game_idteam_beta_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE game_map ADD CONSTRAINT FK_88F7B97EE48FD905 FOREIGN KEY (game_id) REFERENCES game (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE game_map ADD CONSTRAINT FK_88F7B97E53C55F64 FOREIGN KEY (map_id) REFERENCES map (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event_sponsor DROP FOREIGN KEY FK_4DB607B71F7E88B');
        $this->addSql('ALTER TABLE game_map DROP FOREIGN KEY FK_88F7B97EE48FD905');
        $this->addSql('ALTER TABLE event_sponsor DROP FOREIGN KEY FK_4DB607B12F7FB51');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE event_sponsor');
        $this->addSql('DROP TABLE game');
        $this->addSql('DROP TABLE game_map');
        $this->addSql('DROP TABLE sponsor');
        $this->addSql('DROP TABLE tweet');
    }
}
