<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200324173305 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE usergroup (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usergroup_user (usergroup_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_E9B5A1C0D2112630 (usergroup_id), INDEX IDX_E9B5A1C0A76ED395 (user_id), PRIMARY KEY(usergroup_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE usergroup_user ADD CONSTRAINT FK_E9B5A1C0D2112630 FOREIGN KEY (usergroup_id) REFERENCES usergroup (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE usergroup_user ADD CONSTRAINT FK_E9B5A1C0A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE usergroup_user DROP FOREIGN KEY FK_E9B5A1C0D2112630');
        $this->addSql('DROP TABLE usergroup');
        $this->addSql('DROP TABLE usergroup_user');
    }
}
