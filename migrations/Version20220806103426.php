<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220806103426 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE edition (id INT AUTO_INCREMENT NOT NULL, edition_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, event_edition_id INT DEFAULT NULL, user_id_id INT NOT NULL, event_format_id INT NOT NULL, overlay_id_id INT DEFAULT NULL, event_name VARCHAR(255) NOT NULL, event_hashtag VARCHAR(255) DEFAULT NULL, event_logo LONGTEXT DEFAULT NULL, event_slots INT NOT NULL, event_cashprize VARCHAR(255) DEFAULT NULL, event_start_date DATETIME NOT NULL, event_end_date DATETIME NOT NULL, INDEX IDX_3BAE0AA72CC6C371 (event_edition_id), INDEX IDX_3BAE0AA79D86650F (user_id_id), INDEX IDX_3BAE0AA750BCC838 (event_format_id), INDEX IDX_3BAE0AA7A5E79627 (overlay_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event_sponsor (event_id INT NOT NULL, sponsor_id INT NOT NULL, INDEX IDX_4DB607B71F7E88B (event_id), INDEX IDX_4DB607B12F7FB51 (sponsor_id), PRIMARY KEY(event_id, sponsor_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event_user (event_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_92589AE271F7E88B (event_id), INDEX IDX_92589AE2A76ED395 (user_id), PRIMARY KEY(event_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event_format (id INT AUTO_INCREMENT NOT NULL, event_format_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE flag (id INT AUTO_INCREMENT NOT NULL, flag_code VARCHAR(255) NOT NULL, flag_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE format (id INT AUTO_INCREMENT NOT NULL, format_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game (id INT AUTO_INCREMENT NOT NULL, game_id_team_alpha_id INT NOT NULL, game_id_team_beta_id INT NOT NULL, game_format_id INT NOT NULL, game_status_id INT NOT NULL, user_id_id INT NOT NULL, overlay_id_id INT DEFAULT NULL, game_start_date DATETIME DEFAULT NULL, game_score_team_alpha INT DEFAULT NULL, game_score_team_beta INT DEFAULT NULL, INDEX IDX_232B318CB5F42ED3 (game_id_team_alpha_id), INDEX IDX_232B318C6CBC15B2 (game_id_team_beta_id), INDEX IDX_232B318C48F3707 (game_format_id), INDEX IDX_232B318CB951C1BF (game_status_id), INDEX IDX_232B318C9D86650F (user_id_id), INDEX IDX_232B318CA5E79627 (overlay_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game_map (game_id INT NOT NULL, map_id INT NOT NULL, INDEX IDX_88F7B97EE48FD905 (game_id), INDEX IDX_88F7B97E53C55F64 (map_id), PRIMARY KEY(game_id, map_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lib_socials (id INT AUTO_INCREMENT NOT NULL, lib_social_name VARCHAR(255) NOT NULL, lib_social_logo LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lib_widgets (id INT AUTO_INCREMENT NOT NULL, lib_widget_name VARCHAR(255) NOT NULL, lib_widget_id VARCHAR(255) NOT NULL, lib_widget_id2 VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE logs (id INT AUTO_INCREMENT NOT NULL, logs_user_id INT NOT NULL, logs_timestamp DATETIME NOT NULL, logs_level VARCHAR(255) NOT NULL, logs_text LONGTEXT NOT NULL, logs_overlay VARCHAR(255) NOT NULL, INDEX IDX_F08FC65CD9B08880 (logs_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE map (id INT AUTO_INCREMENT NOT NULL, map_name VARCHAR(255) NOT NULL, map_img LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE meta (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, widgets_id INT DEFAULT NULL, meta_key VARCHAR(255) NOT NULL, meta_value LONGTEXT DEFAULT NULL, INDEX IDX_D7F214359D86650F (user_id_id), INDEX IDX_D7F21435A98ED6F4 (widgets_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE overlay (id INT AUTO_INCREMENT NOT NULL, overlay_owner_id INT NOT NULL, overlay_name VARCHAR(255) NOT NULL, INDEX IDX_B9FF3CBEADCB7129 (overlay_owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE overlay_user (overlay_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_4E237622F77080E1 (overlay_id), INDEX IDX_4E237622A76ED395 (user_id), PRIMARY KEY(overlay_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE player (id INT AUTO_INCREMENT NOT NULL, player_id_flag_id INT DEFAULT NULL, player_name VARCHAR(255) NOT NULL, player_avatar LONGTEXT DEFAULT NULL, player_uplay VARCHAR(255) DEFAULT NULL, player_at_twitter VARCHAR(255) DEFAULT NULL, player_discord VARCHAR(255) DEFAULT NULL, player_twitch VARCHAR(255) DEFAULT NULL, player_student_sa TINYINT(1) DEFAULT NULL, INDEX IDX_98197A6510A7C9A8 (player_id_flag_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE social (id INT AUTO_INCREMENT NOT NULL, social_lib_id INT NOT NULL, user_id_id INT NOT NULL, social_tag VARCHAR(255) NOT NULL, INDEX IDX_7161E1874CB23AC8 (social_lib_id), INDEX IDX_7161E1879D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE social_event (social_id INT NOT NULL, event_id INT NOT NULL, INDEX IDX_713EBE35FFEB5B27 (social_id), INDEX IDX_713EBE3571F7E88B (event_id), PRIMARY KEY(social_id, event_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sponsor (id INT AUTO_INCREMENT NOT NULL, sponsor_name VARCHAR(255) NOT NULL, sponsor_logo LONGTEXT DEFAULT NULL, sponsor_banner LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE status (id INT AUTO_INCREMENT NOT NULL, status_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE team (id INT AUTO_INCREMENT NOT NULL, team_id_flag_id INT DEFAULT NULL, team_name VARCHAR(255) NOT NULL, team_logo LONGTEXT DEFAULT NULL, INDEX IDX_C4E0A61F71DB3F50 (team_id_flag_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE team_player (team_id INT NOT NULL, player_id INT NOT NULL, INDEX IDX_EE023DBC296CD8AE (team_id), INDEX IDX_EE023DBC99E6F5DF (player_id), PRIMARY KEY(team_id, player_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tweet (id INT AUTO_INCREMENT NOT NULL, tweet_pseudo VARCHAR(255) NOT NULL, tweet_at VARCHAR(255) NOT NULL, tweet_avatar LONGTEXT DEFAULT NULL, tweet_media_type LONGTEXT DEFAULT NULL, tweet_media_url LONGTEXT DEFAULT NULL, tweet_content LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ui (id INT AUTO_INCREMENT NOT NULL, ui_user_id_id INT NOT NULL, ui_key VARCHAR(255) NOT NULL, ui_value LONGTEXT DEFAULT NULL, INDEX IDX_27FF46B0881EFB17 (ui_user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, email VARCHAR(180) NOT NULL, pseudo VARCHAR(255) NOT NULL, user_first_name VARCHAR(255) DEFAULT NULL, user_last_name VARCHAR(255) DEFAULT NULL, avatar_url LONGTEXT DEFAULT NULL, is_verified TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE websocket (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, websocket_id VARCHAR(255) NOT NULL, overl_id INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE widgets (id INT AUTO_INCREMENT NOT NULL, widget_id_id INT NOT NULL, overlay_id INT NOT NULL, widget_name VARCHAR(255) NOT NULL, widget_visible TINYINT(1) NOT NULL, is_two_widgets TINYINT(1) DEFAULT NULL, INDEX IDX_9D58E4C12402C741 (widget_id_id), INDEX IDX_9D58E4C1F77080E1 (overlay_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA72CC6C371 FOREIGN KEY (event_edition_id) REFERENCES edition (id)');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA79D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA750BCC838 FOREIGN KEY (event_format_id) REFERENCES event_format (id)');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7A5E79627 FOREIGN KEY (overlay_id_id) REFERENCES overlay (id)');
        $this->addSql('ALTER TABLE event_sponsor ADD CONSTRAINT FK_4DB607B71F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_sponsor ADD CONSTRAINT FK_4DB607B12F7FB51 FOREIGN KEY (sponsor_id) REFERENCES sponsor (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_user ADD CONSTRAINT FK_92589AE271F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_user ADD CONSTRAINT FK_92589AE2A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318CB5F42ED3 FOREIGN KEY (game_id_team_alpha_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C6CBC15B2 FOREIGN KEY (game_id_team_beta_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C48F3707 FOREIGN KEY (game_format_id) REFERENCES format (id)');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318CB951C1BF FOREIGN KEY (game_status_id) REFERENCES status (id)');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318CA5E79627 FOREIGN KEY (overlay_id_id) REFERENCES overlay (id)');
        $this->addSql('ALTER TABLE game_map ADD CONSTRAINT FK_88F7B97EE48FD905 FOREIGN KEY (game_id) REFERENCES game (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE game_map ADD CONSTRAINT FK_88F7B97E53C55F64 FOREIGN KEY (map_id) REFERENCES map (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE logs ADD CONSTRAINT FK_F08FC65CD9B08880 FOREIGN KEY (logs_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE meta ADD CONSTRAINT FK_D7F214359D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE meta ADD CONSTRAINT FK_D7F21435A98ED6F4 FOREIGN KEY (widgets_id) REFERENCES widgets (id)');
        $this->addSql('ALTER TABLE overlay ADD CONSTRAINT FK_B9FF3CBEADCB7129 FOREIGN KEY (overlay_owner_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE overlay_user ADD CONSTRAINT FK_4E237622F77080E1 FOREIGN KEY (overlay_id) REFERENCES overlay (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE overlay_user ADD CONSTRAINT FK_4E237622A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE player ADD CONSTRAINT FK_98197A6510A7C9A8 FOREIGN KEY (player_id_flag_id) REFERENCES flag (id)');
        $this->addSql('ALTER TABLE social ADD CONSTRAINT FK_7161E1874CB23AC8 FOREIGN KEY (social_lib_id) REFERENCES lib_socials (id)');
        $this->addSql('ALTER TABLE social ADD CONSTRAINT FK_7161E1879D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE social_event ADD CONSTRAINT FK_713EBE35FFEB5B27 FOREIGN KEY (social_id) REFERENCES social (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE social_event ADD CONSTRAINT FK_713EBE3571F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE team ADD CONSTRAINT FK_C4E0A61F71DB3F50 FOREIGN KEY (team_id_flag_id) REFERENCES flag (id)');
        $this->addSql('ALTER TABLE team_player ADD CONSTRAINT FK_EE023DBC296CD8AE FOREIGN KEY (team_id) REFERENCES team (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE team_player ADD CONSTRAINT FK_EE023DBC99E6F5DF FOREIGN KEY (player_id) REFERENCES player (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ui ADD CONSTRAINT FK_27FF46B0881EFB17 FOREIGN KEY (ui_user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE widgets ADD CONSTRAINT FK_9D58E4C12402C741 FOREIGN KEY (widget_id_id) REFERENCES lib_widgets (id)');
        $this->addSql('ALTER TABLE widgets ADD CONSTRAINT FK_9D58E4C1F77080E1 FOREIGN KEY (overlay_id) REFERENCES overlay (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA72CC6C371');
        $this->addSql('ALTER TABLE event_sponsor DROP FOREIGN KEY FK_4DB607B71F7E88B');
        $this->addSql('ALTER TABLE event_user DROP FOREIGN KEY FK_92589AE271F7E88B');
        $this->addSql('ALTER TABLE social_event DROP FOREIGN KEY FK_713EBE3571F7E88B');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA750BCC838');
        $this->addSql('ALTER TABLE player DROP FOREIGN KEY FK_98197A6510A7C9A8');
        $this->addSql('ALTER TABLE team DROP FOREIGN KEY FK_C4E0A61F71DB3F50');
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318C48F3707');
        $this->addSql('ALTER TABLE game_map DROP FOREIGN KEY FK_88F7B97EE48FD905');
        $this->addSql('ALTER TABLE social DROP FOREIGN KEY FK_7161E1874CB23AC8');
        $this->addSql('ALTER TABLE widgets DROP FOREIGN KEY FK_9D58E4C12402C741');
        $this->addSql('ALTER TABLE game_map DROP FOREIGN KEY FK_88F7B97E53C55F64');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7A5E79627');
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318CA5E79627');
        $this->addSql('ALTER TABLE overlay_user DROP FOREIGN KEY FK_4E237622F77080E1');
        $this->addSql('ALTER TABLE widgets DROP FOREIGN KEY FK_9D58E4C1F77080E1');
        $this->addSql('ALTER TABLE team_player DROP FOREIGN KEY FK_EE023DBC99E6F5DF');
        $this->addSql('ALTER TABLE social_event DROP FOREIGN KEY FK_713EBE35FFEB5B27');
        $this->addSql('ALTER TABLE event_sponsor DROP FOREIGN KEY FK_4DB607B12F7FB51');
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318CB951C1BF');
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318CB5F42ED3');
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318C6CBC15B2');
        $this->addSql('ALTER TABLE team_player DROP FOREIGN KEY FK_EE023DBC296CD8AE');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA79D86650F');
        $this->addSql('ALTER TABLE event_user DROP FOREIGN KEY FK_92589AE2A76ED395');
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318C9D86650F');
        $this->addSql('ALTER TABLE logs DROP FOREIGN KEY FK_F08FC65CD9B08880');
        $this->addSql('ALTER TABLE meta DROP FOREIGN KEY FK_D7F214359D86650F');
        $this->addSql('ALTER TABLE overlay DROP FOREIGN KEY FK_B9FF3CBEADCB7129');
        $this->addSql('ALTER TABLE overlay_user DROP FOREIGN KEY FK_4E237622A76ED395');
        $this->addSql('ALTER TABLE social DROP FOREIGN KEY FK_7161E1879D86650F');
        $this->addSql('ALTER TABLE ui DROP FOREIGN KEY FK_27FF46B0881EFB17');
        $this->addSql('ALTER TABLE meta DROP FOREIGN KEY FK_D7F21435A98ED6F4');
        $this->addSql('DROP TABLE edition');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE event_sponsor');
        $this->addSql('DROP TABLE event_user');
        $this->addSql('DROP TABLE event_format');
        $this->addSql('DROP TABLE flag');
        $this->addSql('DROP TABLE format');
        $this->addSql('DROP TABLE game');
        $this->addSql('DROP TABLE game_map');
        $this->addSql('DROP TABLE lib_socials');
        $this->addSql('DROP TABLE lib_widgets');
        $this->addSql('DROP TABLE logs');
        $this->addSql('DROP TABLE map');
        $this->addSql('DROP TABLE meta');
        $this->addSql('DROP TABLE overlay');
        $this->addSql('DROP TABLE overlay_user');
        $this->addSql('DROP TABLE player');
        $this->addSql('DROP TABLE social');
        $this->addSql('DROP TABLE social_event');
        $this->addSql('DROP TABLE sponsor');
        $this->addSql('DROP TABLE status');
        $this->addSql('DROP TABLE team');
        $this->addSql('DROP TABLE team_player');
        $this->addSql('DROP TABLE tweet');
        $this->addSql('DROP TABLE ui');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE websocket');
        $this->addSql('DROP TABLE widgets');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
