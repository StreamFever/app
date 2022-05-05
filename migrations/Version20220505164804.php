<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220505164804 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6498E0E3CA6');
        $this->addSql('ALTER TABLE widget DROP FOREIGN KEY FK_85F91ED0A53BD7DB');
        $this->addSql('ALTER TABLE widget_user DROP FOREIGN KEY FK_1564DDF6FBE885E2');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE streamer');
        $this->addSql('DROP TABLE widget');
        $this->addSql('DROP TABLE widget_user');
        $this->addSql('DROP INDEX IDX_8D93D6498E0E3CA6 ON user');
        $this->addSql('ALTER TABLE user ADD email VARCHAR(180) NOT NULL, ADD roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', ADD password VARCHAR(255) NOT NULL, DROP user_role_id, DROP user_first_name, DROP user_last_name, DROP user_pseudo, DROP user_email, DROP user_password, DROP user_token');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, role_name VARCHAR(20) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE streamer (id INT AUTO_INCREMENT NOT NULL, stream_pseudo VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, streamer_twitch VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE widget (id INT AUTO_INCREMENT NOT NULL, widet_idstreamer_id INT DEFAULT NULL, id_owner_id INT DEFAULT NULL, widget_name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, widget_visible TINYINT(1) NOT NULL, INDEX IDX_85F91ED0A53BD7DB (widet_idstreamer_id), INDEX IDX_85F91ED02EE78D6C (id_owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE widget_user (widget_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_1564DDF6A76ED395 (user_id), INDEX IDX_1564DDF6FBE885E2 (widget_id), PRIMARY KEY(widget_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE widget ADD CONSTRAINT FK_85F91ED0A53BD7DB FOREIGN KEY (widet_idstreamer_id) REFERENCES streamer (id)');
        $this->addSql('ALTER TABLE widget ADD CONSTRAINT FK_85F91ED02EE78D6C FOREIGN KEY (id_owner_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE widget_user ADD CONSTRAINT FK_1564DDF6FBE885E2 FOREIGN KEY (widget_id) REFERENCES widget (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE widget_user ADD CONSTRAINT FK_1564DDF6A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('DROP INDEX UNIQ_8D93D649E7927C74 ON user');
        $this->addSql('ALTER TABLE user ADD user_role_id INT DEFAULT NULL, ADD user_first_name VARCHAR(50) DEFAULT NULL, ADD user_last_name VARCHAR(50) DEFAULT NULL, ADD user_email VARCHAR(255) NOT NULL, ADD user_password LONGTEXT NOT NULL, ADD user_token LONGTEXT DEFAULT NULL, DROP email, DROP roles, CHANGE password user_pseudo VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6498E0E3CA6 FOREIGN KEY (user_role_id) REFERENCES role (id)');
        $this->addSql('CREATE INDEX IDX_8D93D6498E0E3CA6 ON user (user_role_id)');
    }
}
