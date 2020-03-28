<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200324174101 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE todo (id INT AUTO_INCREMENT NOT NULL, users_id INT DEFAULT NULL, usergroups_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, done TINYINT(1) NOT NULL, startdate DATE NOT NULL, deadline DATE DEFAULT NULL, INDEX IDX_5A0EB6A067B3B43D (users_id), INDEX IDX_5A0EB6A0C17A9CAF (usergroups_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE todo_label (todo_id INT NOT NULL, label_id INT NOT NULL, INDEX IDX_83F08C7BEA1EBC33 (todo_id), INDEX IDX_83F08C7B33B92F39 (label_id), PRIMARY KEY(todo_id, label_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE todo ADD CONSTRAINT FK_5A0EB6A067B3B43D FOREIGN KEY (users_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE todo ADD CONSTRAINT FK_5A0EB6A0C17A9CAF FOREIGN KEY (usergroups_id) REFERENCES usergroup (id)');
        $this->addSql('ALTER TABLE todo_label ADD CONSTRAINT FK_83F08C7BEA1EBC33 FOREIGN KEY (todo_id) REFERENCES todo (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE todo_label ADD CONSTRAINT FK_83F08C7B33B92F39 FOREIGN KEY (label_id) REFERENCES label (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE label CHANGE color color VARCHAR(10) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE todo_label DROP FOREIGN KEY FK_83F08C7BEA1EBC33');
        $this->addSql('DROP TABLE todo');
        $this->addSql('DROP TABLE todo_label');
        $this->addSql('ALTER TABLE label CHANGE color color VARCHAR(10) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
    }
}
