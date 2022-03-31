<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220330142220 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE liste');
        $this->addSql('ALTER TABLE note DROP FOREIGN KEY FK_CFBDFA1488E2F8F3');
        $this->addSql('DROP INDEX IDX_CFBDFA1488E2F8F3 ON note');
        $this->addSql('ALTER TABLE note CHANGE id_film_id id_film INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE liste (id INT AUTO_INCREMENT NOT NULL, id_user_id INT NOT NULL, INDEX IDX_FCF22AF479F37AE5 (id_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE note CHANGE id_film id_film_id INT NOT NULL');
        $this->addSql('ALTER TABLE note ADD CONSTRAINT FK_CFBDFA1488E2F8F3 FOREIGN KEY (id_film_id) REFERENCES films (id)');
        $this->addSql('CREATE INDEX IDX_CFBDFA1488E2F8F3 ON note (id_film_id)');
    }
}
