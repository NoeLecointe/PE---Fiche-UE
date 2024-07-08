<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230523131024 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE activite (id INT AUTO_INCREMENT NOT NULL, id_formation_id INT DEFAULT NULL, id_act VARCHAR(2) NOT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_B875551571C15D5C (id_formation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE competence (id INT AUTO_INCREMENT NOT NULL, id_activite_id INT DEFAULT NULL, nom_competence VARCHAR(255) NOT NULL, INDEX IDX_94D4687F831D4546 (id_activite_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fiche_ue (id INT AUTO_INCREMENT NOT NULL, code_ue VARCHAR(8) NOT NULL, nom_ue VARCHAR(100) NOT NULL, categorie_ue VARCHAR(2) NOT NULL, periode VARCHAR(255) NOT NULL, cible VARCHAR(255) NOT NULL, credits INT NOT NULL, heure_cm INT NOT NULL, heure_td INT NOT NULL, heure_tp INT NOT NULL, heure_the INT NOT NULL, projet TINYINT(1) NOT NULL, antecedent VARCHAR(255) DEFAULT NULL, niv_francais VARCHAR(2) NOT NULL, anglais VARCHAR(2) DEFAULT NULL, modalite VARCHAR(255) NOT NULL, acquis VARCHAR(1000) NOT NULL, savoir VARCHAR(1000) NOT NULL, techniques VARCHAR(1000) NOT NULL, mineur TINYINT(1) NOT NULL, mineur_concerne VARCHAR(255) DEFAULT NULL, alternance TINYINT(1) NOT NULL, label_ddrs TINYINT(1) NOT NULL, label_ddrs_prec VARCHAR(1000) DEFAULT NULL, label_recherche TINYINT(1) NOT NULL, label_recherche_prec VARCHAR(1000) DEFAULT NULL, commentaire VARCHAR(1000) DEFAULT NULL, UNIQUE INDEX UNIQ_4E2248C3B6AA93DC (code_ue), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fiche_ueattente (id INT AUTO_INCREMENT NOT NULL, code_ue VARCHAR(8) NOT NULL, nom_ue VARCHAR(100) DEFAULT NULL, categorie_ue VARCHAR(2) DEFAULT NULL, periode VARCHAR(255) DEFAULT NULL, cible VARCHAR(255) DEFAULT NULL, credits INT DEFAULT NULL, heure_cm INT DEFAULT NULL, heure_td INT DEFAULT NULL, heure_tp INT DEFAULT NULL, heure_the INT DEFAULT NULL, projet TINYINT(1) DEFAULT NULL, antecedent VARCHAR(255) DEFAULT NULL, niv_francais VARCHAR(2) DEFAULT NULL, anglais VARCHAR(2) DEFAULT NULL, modalite VARCHAR(255) DEFAULT NULL, acquis VARCHAR(1000) DEFAULT NULL, savoir VARCHAR(1000) DEFAULT NULL, techniques VARCHAR(1000) DEFAULT NULL, mineur TINYINT(1) DEFAULT NULL, mineur_concerne VARCHAR(255) DEFAULT NULL, alternance TINYINT(1) DEFAULT NULL, label_ddrs TINYINT(1) DEFAULT NULL, label_ddrs_prec VARCHAR(1000) DEFAULT NULL, label_recherche TINYINT(1) DEFAULT NULL, label_recherche_prec VARCHAR(1000) DEFAULT NULL, commentaire VARCHAR(1000) DEFAULT NULL, validation TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_CA4207B4B6AA93DC (code_ue), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formation (id INT AUTO_INCREMENT NOT NULL, nom_formation VARCHAR(255) NOT NULL, accronym_forma VARCHAR(4) NOT NULL, type_ue VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formation_fiche_ue (formation_id INT NOT NULL, fiche_ue_id INT NOT NULL, INDEX IDX_89B01F325200282E (formation_id), INDEX IDX_89B01F321868698E (fiche_ue_id), PRIMARY KEY(formation_id, fiche_ue_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formation_fiche_ueattente (formation_id INT NOT NULL, fiche_ueattente_id INT NOT NULL, INDEX IDX_599CAC595200282E (formation_id), INDEX IDX_599CAC597385254D (fiche_ueattente_id), PRIMARY KEY(formation_id, fiche_ueattente_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formation_user (formation_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_DA4C33095200282E (formation_id), INDEX IDX_DA4C3309A76ED395 (user_id), PRIMARY KEY(formation_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE name (id INT AUTO_INCREMENT NOT NULL, code_ue_id INT DEFAULT NULL, id_competence_id INT NOT NULL, fiche_ue_attente_id INT DEFAULT NULL, notion INT NOT NULL, application INT NOT NULL, maitrise INT NOT NULL, expertise INT NOT NULL, INDEX IDX_5E237E068EBD9AFD (code_ue_id), INDEX IDX_5E237E06AB5ECCCE (id_competence_id), INDEX IDX_5E237E066C5DDD58 (fiche_ue_attente_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, id_formation_id INT DEFAULT NULL, referent_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, mdp VARCHAR(255) NOT NULL, statut INT NOT NULL, INDEX IDX_8D93D64971C15D5C (id_formation_id), INDEX IDX_8D93D64935E47E35 (referent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_fiche_ue (user_id INT NOT NULL, fiche_ue_id INT NOT NULL, INDEX IDX_AEAFACC3A76ED395 (user_id), INDEX IDX_AEAFACC31868698E (fiche_ue_id), PRIMARY KEY(user_id, fiche_ue_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_fiche_ueattente (user_id INT NOT NULL, fiche_ueattente_id INT NOT NULL, INDEX IDX_D89E6B3BA76ED395 (user_id), INDEX IDX_D89E6B3B7385254D (fiche_ueattente_id), PRIMARY KEY(user_id, fiche_ueattente_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE activite ADD CONSTRAINT FK_B875551571C15D5C FOREIGN KEY (id_formation_id) REFERENCES formation (id)');
        $this->addSql('ALTER TABLE competence ADD CONSTRAINT FK_94D4687F831D4546 FOREIGN KEY (id_activite_id) REFERENCES activite (id)');
        $this->addSql('ALTER TABLE formation_fiche_ue ADD CONSTRAINT FK_89B01F325200282E FOREIGN KEY (formation_id) REFERENCES formation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE formation_fiche_ue ADD CONSTRAINT FK_89B01F321868698E FOREIGN KEY (fiche_ue_id) REFERENCES fiche_ue (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE formation_fiche_ueattente ADD CONSTRAINT FK_599CAC595200282E FOREIGN KEY (formation_id) REFERENCES formation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE formation_fiche_ueattente ADD CONSTRAINT FK_599CAC597385254D FOREIGN KEY (fiche_ueattente_id) REFERENCES fiche_ueattente (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE formation_user ADD CONSTRAINT FK_DA4C33095200282E FOREIGN KEY (formation_id) REFERENCES formation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE formation_user ADD CONSTRAINT FK_DA4C3309A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE name ADD CONSTRAINT FK_5E237E068EBD9AFD FOREIGN KEY (code_ue_id) REFERENCES fiche_ue (id)');
        $this->addSql('ALTER TABLE name ADD CONSTRAINT FK_5E237E06AB5ECCCE FOREIGN KEY (id_competence_id) REFERENCES competence (id)');
        $this->addSql('ALTER TABLE name ADD CONSTRAINT FK_5E237E066C5DDD58 FOREIGN KEY (fiche_ue_attente_id) REFERENCES fiche_ueattente (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64971C15D5C FOREIGN KEY (id_formation_id) REFERENCES formation (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64935E47E35 FOREIGN KEY (referent_id) REFERENCES formation (id)');
        $this->addSql('ALTER TABLE user_fiche_ue ADD CONSTRAINT FK_AEAFACC3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_fiche_ue ADD CONSTRAINT FK_AEAFACC31868698E FOREIGN KEY (fiche_ue_id) REFERENCES fiche_ue (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_fiche_ueattente ADD CONSTRAINT FK_D89E6B3BA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_fiche_ueattente ADD CONSTRAINT FK_D89E6B3B7385254D FOREIGN KEY (fiche_ueattente_id) REFERENCES fiche_ueattente (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE activite DROP FOREIGN KEY FK_B875551571C15D5C');
        $this->addSql('ALTER TABLE competence DROP FOREIGN KEY FK_94D4687F831D4546');
        $this->addSql('ALTER TABLE formation_fiche_ue DROP FOREIGN KEY FK_89B01F325200282E');
        $this->addSql('ALTER TABLE formation_fiche_ue DROP FOREIGN KEY FK_89B01F321868698E');
        $this->addSql('ALTER TABLE formation_fiche_ueattente DROP FOREIGN KEY FK_599CAC595200282E');
        $this->addSql('ALTER TABLE formation_fiche_ueattente DROP FOREIGN KEY FK_599CAC597385254D');
        $this->addSql('ALTER TABLE formation_user DROP FOREIGN KEY FK_DA4C33095200282E');
        $this->addSql('ALTER TABLE formation_user DROP FOREIGN KEY FK_DA4C3309A76ED395');
        $this->addSql('ALTER TABLE name DROP FOREIGN KEY FK_5E237E068EBD9AFD');
        $this->addSql('ALTER TABLE name DROP FOREIGN KEY FK_5E237E06AB5ECCCE');
        $this->addSql('ALTER TABLE name DROP FOREIGN KEY FK_5E237E066C5DDD58');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64971C15D5C');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64935E47E35');
        $this->addSql('ALTER TABLE user_fiche_ue DROP FOREIGN KEY FK_AEAFACC3A76ED395');
        $this->addSql('ALTER TABLE user_fiche_ue DROP FOREIGN KEY FK_AEAFACC31868698E');
        $this->addSql('ALTER TABLE user_fiche_ueattente DROP FOREIGN KEY FK_D89E6B3BA76ED395');
        $this->addSql('ALTER TABLE user_fiche_ueattente DROP FOREIGN KEY FK_D89E6B3B7385254D');
        $this->addSql('DROP TABLE activite');
        $this->addSql('DROP TABLE competence');
        $this->addSql('DROP TABLE fiche_ue');
        $this->addSql('DROP TABLE fiche_ueattente');
        $this->addSql('DROP TABLE formation');
        $this->addSql('DROP TABLE formation_fiche_ue');
        $this->addSql('DROP TABLE formation_fiche_ueattente');
        $this->addSql('DROP TABLE formation_user');
        $this->addSql('DROP TABLE name');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_fiche_ue');
        $this->addSql('DROP TABLE user_fiche_ueattente');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
