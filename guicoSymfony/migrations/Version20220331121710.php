<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220331121710 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE liste_films DROP FOREIGN KEY FK_D1171EFFE85441D8');
        $this->addSql('DROP TABLE liste');
        $this->addSql('ALTER TABLE liste_films DROP FOREIGN KEY FK_D1171EFF939610EE');
        $this->addSql('DROP INDEX IDX_D1171EFF939610EE ON liste_films');
        $this->addSql('DROP INDEX IDX_D1171EFFE85441D8 ON liste_films');
        $this->addSql('ALTER TABLE liste_films ADD id INT AUTO_INCREMENT NOT NULL, ADD id_user_id INT NOT NULL, ADD id_film INT NOT NULL, DROP liste_id, DROP films_id, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE liste_films ADD CONSTRAINT FK_D1171EFF79F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_D1171EFF79F37AE5 ON liste_films (id_user_id)');
        $this->addSql('ALTER TABLE note DROP FOREIGN KEY FK_CFBDFA1488E2F8F3');
        $this->addSql('DROP INDEX IDX_CFBDFA1488E2F8F3 ON note');
        $this->addSql('ALTER TABLE note CHANGE id_film_id id_film INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE liste (id INT AUTO_INCREMENT NOT NULL, id_user_id INT NOT NULL, INDEX IDX_FCF22AF479F37AE5 (id_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE liste ADD CONSTRAINT FK_FCF22AF479F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE liste_films MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE liste_films DROP FOREIGN KEY FK_D1171EFF79F37AE5');
        $this->addSql('DROP INDEX IDX_D1171EFF79F37AE5 ON liste_films');
        $this->addSql('ALTER TABLE liste_films DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE liste_films ADD liste_id INT NOT NULL, ADD films_id INT NOT NULL, DROP id, DROP id_user_id, DROP id_film');
        $this->addSql('ALTER TABLE liste_films ADD CONSTRAINT FK_D1171EFF939610EE FOREIGN KEY (films_id) REFERENCES films (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE liste_films ADD CONSTRAINT FK_D1171EFFE85441D8 FOREIGN KEY (liste_id) REFERENCES liste (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_D1171EFF939610EE ON liste_films (films_id)');
        $this->addSql('CREATE INDEX IDX_D1171EFFE85441D8 ON liste_films (liste_id)');
        $this->addSql('ALTER TABLE liste_films ADD PRIMARY KEY (liste_id, films_id)');
        $this->addSql('ALTER TABLE note CHANGE id_film id_film_id INT NOT NULL');
        $this->addSql('ALTER TABLE note ADD CONSTRAINT FK_CFBDFA1488E2F8F3 FOREIGN KEY (id_film_id) REFERENCES films (id)');
        $this->addSql('CREATE INDEX IDX_CFBDFA1488E2F8F3 ON note (id_film_id)');
    }
}
