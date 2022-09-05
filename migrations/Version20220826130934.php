<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220826130934 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE event_social (event_id INT NOT NULL, social_id INT NOT NULL, INDEX IDX_43F896D571F7E88B (event_id), INDEX IDX_43F896D5FFEB5B27 (social_id), PRIMARY KEY(event_id, social_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE social_user (social_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_C282052DFFEB5B27 (social_id), INDEX IDX_C282052DA76ED395 (user_id), PRIMARY KEY(social_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE event_social ADD CONSTRAINT FK_43F896D571F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_social ADD CONSTRAINT FK_43F896D5FFEB5B27 FOREIGN KEY (social_id) REFERENCES social (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE social_user ADD CONSTRAINT FK_C282052DFFEB5B27 FOREIGN KEY (social_id) REFERENCES social (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE social_user ADD CONSTRAINT FK_C282052DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE social_event');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA74E825C80');
        $this->addSql('DROP INDEX IDX_3BAE0AA74E825C80 ON event');
        $this->addSql('ALTER TABLE event DROP current_game_id, CHANGE event_logo event_logo LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE game ADD current_event_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318CEC8F92A1 FOREIGN KEY (current_event_id) REFERENCES event (id)');
        $this->addSql('CREATE INDEX IDX_232B318CEC8F92A1 ON game (current_event_id)');
        $this->addSql('ALTER TABLE social CHANGE social_name social_name VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE social_event (social_id INT NOT NULL, event_id INT NOT NULL, INDEX IDX_713EBE35FFEB5B27 (social_id), INDEX IDX_713EBE3571F7E88B (event_id), PRIMARY KEY(social_id, event_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE social_event ADD CONSTRAINT FK_713EBE35FFEB5B27 FOREIGN KEY (social_id) REFERENCES social (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE social_event ADD CONSTRAINT FK_713EBE3571F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE event_social');
        $this->addSql('DROP TABLE social_user');
        $this->addSql('ALTER TABLE event ADD current_game_id INT DEFAULT NULL, CHANGE event_logo event_logo LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA74E825C80 FOREIGN KEY (current_game_id) REFERENCES game (id)');
        $this->addSql('CREATE INDEX IDX_3BAE0AA74E825C80 ON event (current_game_id)');
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318CEC8F92A1');
        $this->addSql('DROP INDEX IDX_232B318CEC8F92A1 ON game');
        $this->addSql('ALTER TABLE game DROP current_event_id');
        $this->addSql('ALTER TABLE social CHANGE social_name social_name VARCHAR(255) DEFAULT NULL');
    }
}
