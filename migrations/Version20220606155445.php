<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220606155445 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE player DROP FOREIGN KEY FK_98197A65EE9783B2');
        $this->addSql('ALTER TABLE team DROP FOREIGN KEY FK_C4E0A61FF99EA86C');
        $this->addSql('ALTER TABLE game_map DROP FOREIGN KEY FK_88F7B97EE48FD905');
        $this->addSql('ALTER TABLE game_map DROP FOREIGN KEY FK_88F7B97E53C55F64');
        $this->addSql('ALTER TABLE player_team DROP FOREIGN KEY FK_66FAF62C99E6F5DF');
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318C33E7E896');
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318CACA88462');
        $this->addSql('ALTER TABLE player_team DROP FOREIGN KEY FK_66FAF62C296CD8AE');
        $this->addSql('DROP TABLE flag');
        $this->addSql('DROP TABLE format_game');
        $this->addSql('DROP TABLE game');
        $this->addSql('DROP TABLE game_map');
        $this->addSql('DROP TABLE map');
        $this->addSql('DROP TABLE player');
        $this->addSql('DROP TABLE player_team');
        $this->addSql('DROP TABLE status_game');
        $this->addSql('DROP TABLE team');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE flag (id INT AUTO_INCREMENT NOT NULL, flag_code VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, flag_name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE format_game (id INT AUTO_INCREMENT NOT NULL, format_game_name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE game (id INT AUTO_INCREMENT NOT NULL, game_idteam_alpha_id INT DEFAULT NULL, game_idteam_beta_id INT DEFAULT NULL, game_score_alpha INT DEFAULT NULL, game_score_beta INT DEFAULT NULL, game_time_next DATETIME DEFAULT NULL, game_format VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, game_status VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, UNIQUE INDEX UNIQ_232B318CACA88462 (game_idteam_beta_id), UNIQUE INDEX UNIQ_232B318C33E7E896 (game_idteam_alpha_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE game_map (game_id INT NOT NULL, map_id INT NOT NULL, INDEX IDX_88F7B97EE48FD905 (game_id), INDEX IDX_88F7B97E53C55F64 (map_id), PRIMARY KEY(game_id, map_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE map (id INT AUTO_INCREMENT NOT NULL, map_name VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, map_img LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE player (id INT AUTO_INCREMENT NOT NULL, player_idflag_id INT DEFAULT NULL, player_name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, player_avatar LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, player_uplay VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, player_at_twitter VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, player_discord VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, player_twitch VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, player_student_sa TINYINT(1) NOT NULL, player_id_obsninja VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, player_uplay_tag VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_98197A65EE9783B2 (player_idflag_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE player_team (player_id INT NOT NULL, team_id INT NOT NULL, INDEX IDX_66FAF62C99E6F5DF (player_id), INDEX IDX_66FAF62C296CD8AE (team_id), PRIMARY KEY(player_id, team_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE status_game (id INT AUTO_INCREMENT NOT NULL, status_game_name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE team (id INT AUTO_INCREMENT NOT NULL, team_idflag_id INT DEFAULT NULL, team_name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, team_logo LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_C4E0A61FF99EA86C (team_idflag_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C33E7E896 FOREIGN KEY (game_idteam_alpha_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318CACA88462 FOREIGN KEY (game_idteam_beta_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE game_map ADD CONSTRAINT FK_88F7B97E53C55F64 FOREIGN KEY (map_id) REFERENCES map (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE game_map ADD CONSTRAINT FK_88F7B97EE48FD905 FOREIGN KEY (game_id) REFERENCES game (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE player ADD CONSTRAINT FK_98197A65EE9783B2 FOREIGN KEY (player_idflag_id) REFERENCES flag (id)');
        $this->addSql('ALTER TABLE player_team ADD CONSTRAINT FK_66FAF62C296CD8AE FOREIGN KEY (team_id) REFERENCES team (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE player_team ADD CONSTRAINT FK_66FAF62C99E6F5DF FOREIGN KEY (player_id) REFERENCES player (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE team ADD CONSTRAINT FK_C4E0A61FF99EA86C FOREIGN KEY (team_idflag_id) REFERENCES flag (id)');
    }
}
