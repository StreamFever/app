<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220427075903 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE matchs_maps (matchs_id INT NOT NULL, maps_id INT NOT NULL, INDEX IDX_D40FC25288EB7468 (matchs_id), INDEX IDX_D40FC252ADFDDD3B (maps_id), PRIMARY KEY(matchs_id, maps_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE players_teams (players_id INT NOT NULL, teams_id INT NOT NULL, INDEX IDX_8BE70BF2F1849495 (players_id), INDEX IDX_8BE70BF2D6365F12 (teams_id), PRIMARY KEY(players_id, teams_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE matchs_maps ADD CONSTRAINT FK_D40FC25288EB7468 FOREIGN KEY (matchs_id) REFERENCES matchs (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE matchs_maps ADD CONSTRAINT FK_D40FC252ADFDDD3B FOREIGN KEY (maps_id) REFERENCES maps (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE players_teams ADD CONSTRAINT FK_8BE70BF2F1849495 FOREIGN KEY (players_id) REFERENCES players (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE players_teams ADD CONSTRAINT FK_8BE70BF2D6365F12 FOREIGN KEY (teams_id) REFERENCES teams (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE matchs DROP FOREIGN KEY FK_6B1E60411983DE1C');
        $this->addSql('ALTER TABLE matchs DROP FOREIGN KEY FK_6B1E6041EA02285E');
        $this->addSql('ALTER TABLE matchs DROP FOREIGN KEY FK_6B1E6041A7B59A99');
        $this->addSql('DROP INDEX UNIQ_6B1E6041EA02285E ON matchs');
        $this->addSql('DROP INDEX UNIQ_6B1E60411983DE1C ON matchs');
        $this->addSql('DROP INDEX UNIQ_6B1E6041A7B59A99 ON matchs');
        $this->addSql('ALTER TABLE matchs ADD match_idteam_alpha_id INT NOT NULL, ADD match_idteam_beta_id INT NOT NULL, DROP team_idalpha_id, DROP team_idbeta_id, DROP match_idmap_id');
        $this->addSql('ALTER TABLE matchs ADD CONSTRAINT FK_6B1E604114B6CA14 FOREIGN KEY (match_idteam_alpha_id) REFERENCES teams (id)');
        $this->addSql('ALTER TABLE matchs ADD CONSTRAINT FK_6B1E6041FFCBAC13 FOREIGN KEY (match_idteam_beta_id) REFERENCES teams (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6B1E604114B6CA14 ON matchs (match_idteam_alpha_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6B1E6041FFCBAC13 ON matchs (match_idteam_beta_id)');
        $this->addSql('ALTER TABLE players CHANGE player_avatar player_avatar LONGTEXT DEFAULT NULL, CHANGE player_uplay player_uplay VARCHAR(255) DEFAULT NULL, CHANGE player_discord player_discord VARCHAR(255) DEFAULT NULL, CHANGE player_etudiant_sa player_is_student_sa TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE teams DROP FOREIGN KEY FK_96C2225823469322');
        $this->addSql('DROP INDEX IDX_96C2225823469322 ON teams');
        $this->addSql('ALTER TABLE teams DROP player_idteams_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE matchs_maps');
        $this->addSql('DROP TABLE players_teams');
        $this->addSql('ALTER TABLE matchs DROP FOREIGN KEY FK_6B1E604114B6CA14');
        $this->addSql('ALTER TABLE matchs DROP FOREIGN KEY FK_6B1E6041FFCBAC13');
        $this->addSql('DROP INDEX UNIQ_6B1E604114B6CA14 ON matchs');
        $this->addSql('DROP INDEX UNIQ_6B1E6041FFCBAC13 ON matchs');
        $this->addSql('ALTER TABLE matchs ADD team_idalpha_id INT NOT NULL, ADD team_idbeta_id INT NOT NULL, ADD match_idmap_id INT DEFAULT NULL, DROP match_idteam_alpha_id, DROP match_idteam_beta_id');
        $this->addSql('ALTER TABLE matchs ADD CONSTRAINT FK_6B1E60411983DE1C FOREIGN KEY (team_idalpha_id) REFERENCES teams (id)');
        $this->addSql('ALTER TABLE matchs ADD CONSTRAINT FK_6B1E6041EA02285E FOREIGN KEY (match_idmap_id) REFERENCES maps (id)');
        $this->addSql('ALTER TABLE matchs ADD CONSTRAINT FK_6B1E6041A7B59A99 FOREIGN KEY (team_idbeta_id) REFERENCES teams (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6B1E6041EA02285E ON matchs (match_idmap_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6B1E60411983DE1C ON matchs (team_idalpha_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6B1E6041A7B59A99 ON matchs (team_idbeta_id)');
        $this->addSql('ALTER TABLE players CHANGE player_avatar player_avatar LONGTEXT NOT NULL, CHANGE player_uplay player_uplay VARCHAR(255) NOT NULL, CHANGE player_discord player_discord VARCHAR(255) NOT NULL, CHANGE player_is_student_sa player_etudiant_sa TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE teams ADD player_idteams_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE teams ADD CONSTRAINT FK_96C2225823469322 FOREIGN KEY (player_idteams_id) REFERENCES players (id)');
        $this->addSql('CREATE INDEX IDX_96C2225823469322 ON teams (player_idteams_id)');
    }
}
