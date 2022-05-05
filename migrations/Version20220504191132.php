<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220504191132 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE widget ADD id_owner_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE widget ADD CONSTRAINT FK_85F91ED02EE78D6C FOREIGN KEY (id_owner_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_85F91ED02EE78D6C ON widget (id_owner_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE widget DROP FOREIGN KEY FK_85F91ED02EE78D6C');
        $this->addSql('DROP INDEX IDX_85F91ED02EE78D6C ON widget');
        $this->addSql('ALTER TABLE widget DROP id_owner_id');
    }
}
