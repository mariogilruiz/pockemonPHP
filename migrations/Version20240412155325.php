<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240412155325 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE debilidad (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pokemons_debilidad (pokemons_id INT NOT NULL, debilidad_id INT NOT NULL, INDEX IDX_3C720703263F4792 (pokemons_id), INDEX IDX_3C720703D7C99BD5 (debilidad_id), PRIMARY KEY(pokemons_id, debilidad_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE pokemons_debilidad ADD CONSTRAINT FK_3C720703263F4792 FOREIGN KEY (pokemons_id) REFERENCES pokemons (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pokemons_debilidad ADD CONSTRAINT FK_3C720703D7C99BD5 FOREIGN KEY (debilidad_id) REFERENCES debilidad (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pokemons_debilidad DROP FOREIGN KEY FK_3C720703263F4792');
        $this->addSql('ALTER TABLE pokemons_debilidad DROP FOREIGN KEY FK_3C720703D7C99BD5');
        $this->addSql('DROP TABLE debilidad');
        $this->addSql('DROP TABLE pokemons_debilidad');
    }
}
