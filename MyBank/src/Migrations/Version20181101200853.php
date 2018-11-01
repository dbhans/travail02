<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181101200853 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE accounts (id INT AUTO_INCREMENT NOT NULL, account VARCHAR(25) NOT NULL, description VARCHAR(255) DEFAULT NULL, type VARCHAR(12) NOT NULL, customer INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE customers (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(25) NOT NULL, lastname VARCHAR(25) DEFAULT NULL, gender VARCHAR(5) DEFAULT NULL, birth DATE DEFAULT NULL, address VARCHAR(50) DEFAULT NULL, city VARCHAR(25) DEFAULT NULL, state VARCHAR(25) DEFAULT NULL, pin INT NOT NULL, mobile INT NOT NULL, email VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tranfers (id INT AUTO_INCREMENT NOT NULL, transfer INT DEFAULT NULL, payer INT NOT NULL, payee INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transactions (id INT AUTO_INCREMENT NOT NULL, description VARCHAR(255) DEFAULT NULL, amount DOUBLE PRECISION NOT NULL, type VARCHAR(12) NOT NULL, date DATETIME DEFAULT NULL, iduser INT NOT NULL, account INT NOT NULL, transfer INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE useraccess (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, password VARCHAR(15) NOT NULL, type VARCHAR(10) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE accounts');
        $this->addSql('DROP TABLE customers');
        $this->addSql('DROP TABLE tranfers');
        $this->addSql('DROP TABLE transactions');
        $this->addSql('DROP TABLE useraccess');
    }
}
