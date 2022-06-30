<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220630160007 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event ADD user_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA79D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_3BAE0AA79D86650F ON event (user_id_id)');
        $this->addSql('ALTER TABLE game ADD user_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_232B318C9D86650F ON game (user_id_id)');
        $this->addSql('ALTER TABLE meta ADD user_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE meta ADD CONSTRAINT FK_D7F214359D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_D7F214359D86650F ON meta (user_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA79D86650F');
        $this->addSql('DROP INDEX IDX_3BAE0AA79D86650F ON event');
        $this->addSql('ALTER TABLE event DROP user_id_id');
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318C9D86650F');
        $this->addSql('DROP INDEX IDX_232B318C9D86650F ON game');
        $this->addSql('ALTER TABLE game DROP user_id_id');
        $this->addSql('ALTER TABLE meta DROP FOREIGN KEY FK_D7F214359D86650F');
        $this->addSql('DROP INDEX IDX_D7F214359D86650F ON meta');
        $this->addSql('ALTER TABLE meta DROP user_id_id');
    }
}
