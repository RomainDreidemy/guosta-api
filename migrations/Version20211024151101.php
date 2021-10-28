<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211024151101 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE account (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE account_user (account_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_10051E39B6B5FBA (account_id), INDEX IDX_10051E3A76ED395 (user_id), PRIMARY KEY(account_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE account_line (id INT AUTO_INCREMENT NOT NULL, account_id INT DEFAULT NULL, designation VARCHAR(255) NOT NULL, sum DOUBLE PRECISION NOT NULL, date DATE NOT NULL, in_application TINYINT(1) NOT NULL, monthly TINYINT(1) NOT NULL, INDEX IDX_5D87335C9B6B5FBA (account_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE account_user ADD CONSTRAINT FK_10051E39B6B5FBA FOREIGN KEY (account_id) REFERENCES account (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE account_user ADD CONSTRAINT FK_10051E3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE account_line ADD CONSTRAINT FK_5D87335C9B6B5FBA FOREIGN KEY (account_id) REFERENCES account (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE account_user DROP FOREIGN KEY FK_10051E39B6B5FBA');
        $this->addSql('ALTER TABLE account_line DROP FOREIGN KEY FK_5D87335C9B6B5FBA');
        $this->addSql('DROP TABLE account');
        $this->addSql('DROP TABLE account_user');
        $this->addSql('DROP TABLE account_line');
    }
}
