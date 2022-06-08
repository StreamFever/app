<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220606160956 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE flag (id INT AUTO_INCREMENT NOT NULL, flag_code VARCHAR(255) NOT NULL, flag_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE format (id INT AUTO_INCREMENT NOT NULL, format_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game (id INT AUTO_INCREMENT NOT NULL, game_id_team_alpha_id INT NOT NULL, game_id_team_beta_id INT NOT NULL, game_format_id INT NOT NULL, game_status_id INT NOT NULL, game_time_next DATETIME DEFAULT NULL, INDEX IDX_232B318CB5F42ED3 (game_id_team_alpha_id), INDEX IDX_232B318C6CBC15B2 (game_id_team_beta_id), INDEX IDX_232B318C48F3707 (game_format_id), INDEX IDX_232B318CB951C1BF (game_status_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE map (id INT AUTO_INCREMENT NOT NULL, map_name VARCHAR(255) NOT NULL, map_img LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE player (id INT AUTO_INCREMENT NOT NULL, player_name VARCHAR(255) NOT NULL, player_avatar LONGTEXT DEFAULT NULL, player_uplay VARCHAR(255) DEFAULT NULL, player_at_twitter VARCHAR(255) DEFAULT NULL, player_discord VARCHAR(255) DEFAULT NULL, player_twitch VARCHAR(255) DEFAULT NULL, player_student_sa TINYINT(1) NOT NULL, player_id_obs_ninja VARCHAR(255) DEFAULT NULL, player_uplay_tag VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE player_flag (player_id INT NOT NULL, flag_id INT NOT NULL, INDEX IDX_73EEBBA999E6F5DF (player_id), INDEX IDX_73EEBBA9919FE4E5 (flag_id), PRIMARY KEY(player_id, flag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE status (id INT AUTO_INCREMENT NOT NULL, status_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE team (id INT AUTO_INCREMENT NOT NULL, team_id_flag_id INT DEFAULT NULL, team_name VARCHAR(255) NOT NULL, team_logo LONGTEXT DEFAULT NULL, INDEX IDX_C4E0A61F71DB3F50 (team_id_flag_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318CB5F42ED3 FOREIGN KEY (game_id_team_alpha_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C6CBC15B2 FOREIGN KEY (game_id_team_beta_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C48F3707 FOREIGN KEY (game_format_id) REFERENCES format (id)');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318CB951C1BF FOREIGN KEY (game_status_id) REFERENCES status (id)');
        $this->addSql('ALTER TABLE player_flag ADD CONSTRAINT FK_73EEBBA999E6F5DF FOREIGN KEY (player_id) REFERENCES player (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE player_flag ADD CONSTRAINT FK_73EEBBA9919FE4E5 FOREIGN KEY (flag_id) REFERENCES flag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE team ADD CONSTRAINT FK_C4E0A61F71DB3F50 FOREIGN KEY (team_id_flag_id) REFERENCES flag (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE player_flag DROP FOREIGN KEY FK_73EEBBA9919FE4E5');
        $this->addSql('ALTER TABLE team DROP FOREIGN KEY FK_C4E0A61F71DB3F50');
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318C48F3707');
        $this->addSql('ALTER TABLE player_flag DROP FOREIGN KEY FK_73EEBBA999E6F5DF');
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318CB951C1BF');
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318CB5F42ED3');
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318C6CBC15B2');
        $this->addSql('DROP TABLE flag');
        $this->addSql('DROP TABLE format');
        $this->addSql('DROP TABLE game');
        $this->addSql('DROP TABLE map');
        $this->addSql('DROP TABLE player');
        $this->addSql('DROP TABLE player_flag');
        $this->addSql('DROP TABLE status');
        $this->addSql('DROP TABLE team');
    }
}
