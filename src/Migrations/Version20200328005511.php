<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200328005511 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE todo CHANGE users_id users_id INT DEFAULT NULL, CHANGE usergroups_id usergroups_id INT DEFAULT NULL, CHANGE description description VARCHAR(255) DEFAULT NULL, CHANGE deadline deadline DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE label ADD users_id INT DEFAULT NULL, CHANGE color color VARCHAR(10) DEFAULT NULL');
        $this->addSql('ALTER TABLE label ADD CONSTRAINT FK_EA750E867B3B43D FOREIGN KEY (users_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_EA750E867B3B43D ON label (users_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE label DROP FOREIGN KEY FK_EA750E867B3B43D');
        $this->addSql('DROP INDEX IDX_EA750E867B3B43D ON label');
        $this->addSql('ALTER TABLE label DROP users_id, CHANGE color color VARCHAR(10) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE todo CHANGE users_id users_id INT DEFAULT NULL, CHANGE usergroups_id usergroups_id INT DEFAULT NULL, CHANGE description description VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE deadline deadline DATE DEFAULT \'NULL\'');
    }
}
