<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * This first migration is used to create the base structure of the ChatLyfe infrastructure; all other migrations build
 * on top of this base migration.
 */
class Version20180226030157 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE channel (id INT AUTO_INCREMENT NOT NULL, creator_id INT DEFAULT NULL, name VARCHAR(32) NOT NULL, topic VARCHAR(255) DEFAULT NULL, status SMALLINT UNSIGNED DEFAULT 1 NOT NULL, UNIQUE INDEX UNIQ_A2F98E475E237E06 (name), INDEX IDX_A2F98E4761220EA6 (creator_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE channel_join (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, chat_id INT NOT NULL, join_time DATETIME NOT NULL, part_time DATETIME DEFAULT NULL, INDEX IDX_B4357BA9A76ED395 (user_id), INDEX IDX_B4357BA91A9A7125 (chat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE direct_message (id INT AUTO_INCREMENT NOT NULL, user_a_id INT NOT NULL, user_b_id INT NOT NULL, INDEX IDX_1416AF93415F1F91 (user_a_id), INDEX IDX_1416AF9353EAB07F (user_b_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, author_id INT NOT NULL, chat_id INT DEFAULT NULL, direct_message_id INT DEFAULT NULL, message LONGTEXT NOT NULL, timestamp DATETIME NOT NULL, status SMALLINT DEFAULT 1 NOT NULL, INDEX IDX_B6BD307FF675F31B (author_id), INDEX IDX_B6BD307F1A9A7125 (chat_id), INDEX IDX_B6BD307F445FD6FA (direct_message_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, username_canonical VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, email_canonical VARCHAR(180) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, confirmation_token VARCHAR(180) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', first_name VARCHAR(100) DEFAULT NULL, last_name VARCHAR(100) DEFAULT NULL, status SMALLINT UNSIGNED DEFAULT 1 NOT NULL, UNIQUE INDEX UNIQ_8D93D64992FC23A8 (username_canonical), UNIQUE INDEX UNIQ_8D93D649A0D96FBF (email_canonical), UNIQUE INDEX UNIQ_8D93D649C05FB297 (confirmation_token), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE channel ADD CONSTRAINT FK_A2F98E4761220EA6 FOREIGN KEY (creator_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE channel_join ADD CONSTRAINT FK_B4357BA9A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE channel_join ADD CONSTRAINT FK_B4357BA91A9A7125 FOREIGN KEY (chat_id) REFERENCES channel (id)');
        $this->addSql('ALTER TABLE direct_message ADD CONSTRAINT FK_1416AF93415F1F91 FOREIGN KEY (user_a_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE direct_message ADD CONSTRAINT FK_1416AF9353EAB07F FOREIGN KEY (user_b_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FF675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F1A9A7125 FOREIGN KEY (chat_id) REFERENCES channel (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F445FD6FA FOREIGN KEY (direct_message_id) REFERENCES direct_message (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE channel_join DROP FOREIGN KEY FK_B4357BA91A9A7125');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F1A9A7125');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F445FD6FA');
        $this->addSql('ALTER TABLE channel DROP FOREIGN KEY FK_A2F98E4761220EA6');
        $this->addSql('ALTER TABLE channel_join DROP FOREIGN KEY FK_B4357BA9A76ED395');
        $this->addSql('ALTER TABLE direct_message DROP FOREIGN KEY FK_1416AF93415F1F91');
        $this->addSql('ALTER TABLE direct_message DROP FOREIGN KEY FK_1416AF9353EAB07F');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FF675F31B');
        $this->addSql('DROP TABLE channel');
        $this->addSql('DROP TABLE channel_join');
        $this->addSql('DROP TABLE direct_message');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE user');
    }
}
