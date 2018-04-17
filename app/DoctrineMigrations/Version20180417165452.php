<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180417165452 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F445FD6FA');
        $this->addSql('DROP TABLE direct_message');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F445FD6FA');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F445FD6FA FOREIGN KEY (direct_message_id) REFERENCES user (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE direct_message (id INT AUTO_INCREMENT NOT NULL, user_a_id INT NOT NULL, user_b_id INT NOT NULL, INDEX IDX_1416AF93415F1F91 (user_a_id), INDEX IDX_1416AF9353EAB07F (user_b_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE direct_message ADD CONSTRAINT FK_1416AF93415F1F91 FOREIGN KEY (user_a_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE direct_message ADD CONSTRAINT FK_1416AF9353EAB07F FOREIGN KEY (user_b_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F445FD6FA');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F445FD6FA FOREIGN KEY (direct_message_id) REFERENCES direct_message (id)');
    }
}
