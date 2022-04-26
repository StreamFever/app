<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220426203434 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE annonces (id INT AUTO_INCREMENT NOT NULL, annonce_text LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, event_name VARCHAR(255) NOT NULL, event_edition VARCHAR(255) NOT NULL, event_logo LONGTEXT DEFAULT NULL, event_hashtag VARCHAR(255) DEFAULT NULL, event_cashprize VARCHAR(255) DEFAULT NULL, event_current_phase VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE flags (id INT AUTO_INCREMENT NOT NULL, flag_code VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE maps (id INT AUTO_INCREMENT NOT NULL, map_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE matchs (id INT AUTO_INCREMENT NOT NULL, team_idalpha_id INT NOT NULL, team_idbeta_id INT NOT NULL, match_idmap_id INT DEFAULT NULL, match_score_team_alpha INT DEFAULT NULL, match_score_team_beta INT DEFAULT NULL, match_time_next VARCHAR(255) DEFAULT NULL, match_format VARCHAR(255) DEFAULT NULL, match_status VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_6B1E60411983DE1C (team_idalpha_id), UNIQUE INDEX UNIQ_6B1E6041A7B59A99 (team_idbeta_id), UNIQUE INDEX UNIQ_6B1E6041EA02285E (match_idmap_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE players (id INT AUTO_INCREMENT NOT NULL, player_idflag_id INT NOT NULL, player_name VARCHAR(255) NOT NULL, player_avatar LONGTEXT NOT NULL, player_uplay VARCHAR(255) NOT NULL, player_at_twitter VARCHAR(255) DEFAULT NULL, player_discord VARCHAR(255) NOT NULL, player_twitch VARCHAR(255) DEFAULT NULL, player_etudiant_sa TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_264E43A6EE9783B2 (player_idflag_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE popup (id INT AUTO_INCREMENT NOT NULL, popup_text LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sponsors (id INT AUTO_INCREMENT NOT NULL, event_id INT DEFAULT NULL, sponsor_name VARCHAR(255) NOT NULL, sponsor_logo LONGTEXT NOT NULL, INDEX IDX_9A31550F71F7E88B (event_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE streamers (id INT AUTO_INCREMENT NOT NULL, streamer_pseudo VARCHAR(255) NOT NULL, streamer_twitch VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE teams (id INT AUTO_INCREMENT NOT NULL, team_idflag_id INT NOT NULL, player_idteams_id INT DEFAULT NULL, team_name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_96C22258F99EA86C (team_idflag_id), INDEX IDX_96C2225823469322 (player_idteams_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tweets (id INT AUTO_INCREMENT NOT NULL, tweet_pseudo VARCHAR(255) NOT NULL, tweet_at VARCHAR(255) NOT NULL, tweet_avatar_url LONGTEXT NOT NULL, tweet_media_type VARCHAR(255) DEFAULT NULL, tweet_media_url LONGTEXT DEFAULT NULL, tweet_content LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE widgets (id INT AUTO_INCREMENT NOT NULL, widget_idstreamer_id INT NOT NULL, widget_name VARCHAR(255) NOT NULL, widget_visible TINYINT(1) NOT NULL, INDEX IDX_9D58E4C1796EC161 (widget_idstreamer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE matchs ADD CONSTRAINT FK_6B1E60411983DE1C FOREIGN KEY (team_idalpha_id) REFERENCES teams (id)');
        $this->addSql('ALTER TABLE matchs ADD CONSTRAINT FK_6B1E6041A7B59A99 FOREIGN KEY (team_idbeta_id) REFERENCES teams (id)');
        $this->addSql('ALTER TABLE matchs ADD CONSTRAINT FK_6B1E6041EA02285E FOREIGN KEY (match_idmap_id) REFERENCES maps (id)');
        $this->addSql('ALTER TABLE players ADD CONSTRAINT FK_264E43A6EE9783B2 FOREIGN KEY (player_idflag_id) REFERENCES flags (id)');
        $this->addSql('ALTER TABLE sponsors ADD CONSTRAINT FK_9A31550F71F7E88B FOREIGN KEY (event_id) REFERENCES event (id)');
        $this->addSql('ALTER TABLE teams ADD CONSTRAINT FK_96C22258F99EA86C FOREIGN KEY (team_idflag_id) REFERENCES flags (id)');
        $this->addSql('ALTER TABLE teams ADD CONSTRAINT FK_96C2225823469322 FOREIGN KEY (player_idteams_id) REFERENCES players (id)');
        $this->addSql('ALTER TABLE widgets ADD CONSTRAINT FK_9D58E4C1796EC161 FOREIGN KEY (widget_idstreamer_id) REFERENCES streamers (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sponsors DROP FOREIGN KEY FK_9A31550F71F7E88B');
        $this->addSql('ALTER TABLE players DROP FOREIGN KEY FK_264E43A6EE9783B2');
        $this->addSql('ALTER TABLE teams DROP FOREIGN KEY FK_96C22258F99EA86C');
        $this->addSql('ALTER TABLE matchs DROP FOREIGN KEY FK_6B1E6041EA02285E');
        $this->addSql('ALTER TABLE teams DROP FOREIGN KEY FK_96C2225823469322');
        $this->addSql('ALTER TABLE widgets DROP FOREIGN KEY FK_9D58E4C1796EC161');
        $this->addSql('ALTER TABLE matchs DROP FOREIGN KEY FK_6B1E60411983DE1C');
        $this->addSql('ALTER TABLE matchs DROP FOREIGN KEY FK_6B1E6041A7B59A99');
        $this->addSql('DROP TABLE annonces');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE flags');
        $this->addSql('DROP TABLE maps');
        $this->addSql('DROP TABLE matchs');
        $this->addSql('DROP TABLE players');
        $this->addSql('DROP TABLE popup');
        $this->addSql('DROP TABLE sponsors');
        $this->addSql('DROP TABLE streamers');
        $this->addSql('DROP TABLE teams');
        $this->addSql('DROP TABLE tweets');
        $this->addSql('DROP TABLE widgets');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
