<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190602152636 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE kategoria (id INT AUTO_INCREMENT NOT NULL, nazwa VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE miasto (id INT AUTO_INCREMENT NOT NULL, wojewodztwo_id INT NOT NULL, nazwa VARCHAR(255) NOT NULL, INDEX IDX_D2F92E4F3E8EA8F5 (wojewodztwo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE oferta (id INT AUTO_INCREMENT NOT NULL, uzytkownik_id INT NOT NULL, tytul VARCHAR(255) NOT NULL, data_dodania DATETIME NOT NULL, tresc LONGTEXT DEFAULT NULL, aktywna TINYINT(1) NOT NULL, INDEX IDX_7479C8F231D6FDE9 (uzytkownik_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE oferta_kategoria (oferta_id INT NOT NULL, kategoria_id INT NOT NULL, INDEX IDX_4CA925FFAFBF624 (oferta_id), INDEX IDX_4CA925F359B0684 (kategoria_id), PRIMARY KEY(oferta_id, kategoria_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE oferta_miasto (oferta_id INT NOT NULL, miasto_id INT NOT NULL, INDEX IDX_350FCB90FAFBF624 (oferta_id), INDEX IDX_350FCB90D2E14C8B (miasto_id), PRIMARY KEY(oferta_id, miasto_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE panstwo (id INT AUTO_INCREMENT NOT NULL, nazwa VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE uzytkownik (id INT AUTO_INCREMENT NOT NULL, imie VARCHAR(255) NOT NULL, nazwisko VARCHAR(255) DEFAULT NULL, email VARCHAR(255) NOT NULL, haslo VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE wojewodztwo (id INT AUTO_INCREMENT NOT NULL, panstwo_id INT NOT NULL, nazwa VARCHAR(255) NOT NULL, INDEX IDX_9BE29DAF673E8849 (panstwo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE miasto ADD CONSTRAINT FK_D2F92E4F3E8EA8F5 FOREIGN KEY (wojewodztwo_id) REFERENCES wojewodztwo (id)');
        $this->addSql('ALTER TABLE oferta ADD CONSTRAINT FK_7479C8F231D6FDE9 FOREIGN KEY (uzytkownik_id) REFERENCES uzytkownik (id)');
        $this->addSql('ALTER TABLE oferta_kategoria ADD CONSTRAINT FK_4CA925FFAFBF624 FOREIGN KEY (oferta_id) REFERENCES oferta (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE oferta_kategoria ADD CONSTRAINT FK_4CA925F359B0684 FOREIGN KEY (kategoria_id) REFERENCES kategoria (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE oferta_miasto ADD CONSTRAINT FK_350FCB90FAFBF624 FOREIGN KEY (oferta_id) REFERENCES oferta (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE oferta_miasto ADD CONSTRAINT FK_350FCB90D2E14C8B FOREIGN KEY (miasto_id) REFERENCES miasto (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE wojewodztwo ADD CONSTRAINT FK_9BE29DAF673E8849 FOREIGN KEY (panstwo_id) REFERENCES panstwo (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE oferta_kategoria DROP FOREIGN KEY FK_4CA925F359B0684');
        $this->addSql('ALTER TABLE oferta_miasto DROP FOREIGN KEY FK_350FCB90D2E14C8B');
        $this->addSql('ALTER TABLE oferta_kategoria DROP FOREIGN KEY FK_4CA925FFAFBF624');
        $this->addSql('ALTER TABLE oferta_miasto DROP FOREIGN KEY FK_350FCB90FAFBF624');
        $this->addSql('ALTER TABLE wojewodztwo DROP FOREIGN KEY FK_9BE29DAF673E8849');
        $this->addSql('ALTER TABLE oferta DROP FOREIGN KEY FK_7479C8F231D6FDE9');
        $this->addSql('ALTER TABLE miasto DROP FOREIGN KEY FK_D2F92E4F3E8EA8F5');
        $this->addSql('DROP TABLE kategoria');
        $this->addSql('DROP TABLE miasto');
        $this->addSql('DROP TABLE oferta');
        $this->addSql('DROP TABLE oferta_kategoria');
        $this->addSql('DROP TABLE oferta_miasto');
        $this->addSql('DROP TABLE panstwo');
        $this->addSql('DROP TABLE uzytkownik');
        $this->addSql('DROP TABLE wojewodztwo');
    }
}
