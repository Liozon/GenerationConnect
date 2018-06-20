<?php

use Illuminate\Database\Seeder;

class MainTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*=====================================
        ========COMPETENCES====================
        =====================================*/
        $competence_1 = new \App\Competence([
            'nom' => "écran",
            'categorie' => "Informatique (matériel)",
        ]);
        $competence_1->save();

        $competence_2 = new \App\Competence([
            'nom' => "Windows",
            'categorie' => "Informatique (logiciel)",
        ]);
        $competence_2->save();

        $competence_3 = new \App\Competence([
            'nom' => "Swisscom TV",
            'categorie' => "Télévision",
        ]);
        $competence_3->save();

        $competence_4 = new \App\Competence([
            'nom' => "branchement",
            'categorie' => "Téléphonie fixe",
        ]);
        $competence_4->save();

        $competence_5 = new \App\Competence([
            'nom' => "Whatsapp",
            'categorie' => "Téléphonie mobile",
        ]);
        $competence_5->save();

        $competence_6 = new \App\Competence([
            'nom' => "Skype",
            'categorie' => "Appels vidéos",
        ]);
        $competence_6->save();

        $competence_7 = new \App\Competence([
            'nom' => "Word",
            'categorie' => "Mise à jour de programmes",
        ]);
        $competence_7->save();

        $competence_8 = new \App\Competence([
            'nom' => "Facebook",
            'categorie' => "Réseaux sociaux",
        ]);
        $competence_8->save();

        $competence_9 = new \App\Competence([
            'nom' => "Tablette",
            'categorie' => "Configuration d'un appareil",
        ]);
        $competence_9->save();

        $competence_10 = new \App\Competence([
            'nom' => "acheter en ligne",
            'categorie' => "Services en ligne",
        ]);
        $competence_10->save();

        /*=====================================
        ========REGIONS========================
        =====================================*/
        $region_1 = new \App\Region([
            'nom' => "lausanne"
        ]);
        $region_1->save();

        $region_2 = new \App\Region([
            'nom' => "nord vaudois"
        ]);
        $region_2->save();

        $region_3 = new \App\Region([
            'nom' => "genève"
        ]);
        $region_3->save();

        /*=====================================
        ========GROUPES========================
        =====================================*/
        $groupe_1 = new \App\Groupe([
            'nom' => "junior",
        ]);
        $groupe_1->save();

        $groupe_2 = new \App\Groupe([
            'nom' => "senior",
        ]);
        $groupe_2->save();

        $groupe_3 = new \App\Groupe([
            'nom' => "employe",
        ]);
        $groupe_3->save();

        $groupe_4 = new \App\Groupe([
            'nom' => "admin",
        ]);
        $groupe_4->save();

        /*=====================================
        ========RESSOURCES=====================
        =====================================*/
        $ressource_1 = new \App\Ressource([
            'nom' => "junior",
        ]);
        $ressource_1->save();
        $ressource_1->groupes()->save($groupe_1,['crud'=>\App\Role::READ]);
        $ressource_1->groupes()->save($groupe_1,['crud'=>\App\Role::UPDATE]);
        $ressource_1->groupes()->save($groupe_2,['crud'=>\App\Role::READ]);
        $ressource_1->groupes()->save($groupe_3,['crud'=>\App\Role::CREATE]);
        $ressource_1->groupes()->save($groupe_3,['crud'=>\App\Role::READ]);
        $ressource_1->groupes()->save($groupe_3,['crud'=>\App\Role::UPDATE]);
        $ressource_1->groupes()->save($groupe_3,['crud'=>\App\Role::DELETE]);
        $ressource_1->groupes()->save($groupe_4,['crud'=>\App\Role::CREATE]);
        $ressource_1->groupes()->save($groupe_4,['crud'=>\App\Role::READ]);
        $ressource_1->groupes()->save($groupe_4,['crud'=>\App\Role::UPDATE]);
        $ressource_1->groupes()->save($groupe_4,['crud'=>\App\Role::DELETE]);

        $ressource_2 = new \App\Ressource([
            'nom' => "juniors",
        ]);
        $ressource_2->save();
        $ressource_2->groupes()->save($groupe_1,['crud'=>\App\Role::READ]);
        $ressource_2->groupes()->save($groupe_2,['crud'=>\App\Role::READ]);
        $ressource_2->groupes()->save($groupe_3,['crud'=>\App\Role::READ]);
        $ressource_2->groupes()->save($groupe_4,['crud'=>\App\Role::READ]);

        $ressource_3 = new \App\Ressource([
            'nom' => "senior",
        ]);
        $ressource_3->save();
        $ressource_3->groupes()->save($groupe_1,['crud'=>\App\Role::READ]);
        $ressource_3->groupes()->save($groupe_2,['crud'=>\App\Role::READ]);
        $ressource_3->groupes()->save($groupe_2,['crud'=>\App\Role::UPDATE]);
        $ressource_3->groupes()->save($groupe_3,['crud'=>\App\Role::CREATE]);
        $ressource_3->groupes()->save($groupe_3,['crud'=>\App\Role::READ]);
        $ressource_3->groupes()->save($groupe_3,['crud'=>\App\Role::UPDATE]);
        $ressource_3->groupes()->save($groupe_3,['crud'=>\App\Role::DELETE]);
        $ressource_3->groupes()->save($groupe_4,['crud'=>\App\Role::CREATE]);
        $ressource_3->groupes()->save($groupe_4,['crud'=>\App\Role::READ]);
        $ressource_3->groupes()->save($groupe_4,['crud'=>\App\Role::UPDATE]);
        $ressource_3->groupes()->save($groupe_4,['crud'=>\App\Role::DELETE]);

        $ressource_4 = new \App\Ressource([
            'nom' => "seniors",
        ]);
        $ressource_4->save();
        $ressource_4->groupes()->save($groupe_1,['crud'=>\App\Role::READ]);
        $ressource_4->groupes()->save($groupe_2,['crud'=>\App\Role::READ]);
        $ressource_4->groupes()->save($groupe_3,['crud'=>\App\Role::READ]);
        $ressource_4->groupes()->save($groupe_4,['crud'=>\App\Role::READ]);

        $ressource_5 = new \App\Ressource([
            'nom' => "employe",
        ]);
        $ressource_5->save();
        $ressource_5->groupes()->save($groupe_3,['crud'=>\App\Role::READ]);
        $ressource_5->groupes()->save($groupe_4,['crud'=>\App\Role::READ]);
        $ressource_5->groupes()->save($groupe_4,['crud'=>\App\Role::CREATE]);
        $ressource_5->groupes()->save($groupe_4,['crud'=>\App\Role::UPDATE]);
        $ressource_5->groupes()->save($groupe_4,['crud'=>\App\Role::DELETE]);

        $ressource_6 = new \App\Ressource([
            'nom' => "employes",
        ]);
        $ressource_6->save();
        $ressource_5->groupes()->save($groupe_3,['crud'=>\App\Role::READ]);
        $ressource_5->groupes()->save($groupe_4,['crud'=>\App\Role::READ]);
        $ressource_5->groupes()->save($groupe_4,['crud'=>\App\Role::CREATE]);
        $ressource_5->groupes()->save($groupe_4,['crud'=>\App\Role::UPDATE]);
        $ressource_5->groupes()->save($groupe_4,['crud'=>\App\Role::DELETE]);

        /*=====================================
        ========UTILISATEURS===================
        =====================================*/

        $utilisateur_1 = new \App\User([
            'pseudo' => "j-m-1004",
            'password' => bcrypt('pomme'),
            'nom' => "Dupond",
            'prenom' => "Jean-Michel",
            'email' => "jean-michel@hotmail.com",
            'ville' => "lausanne",
            'sexe' => 'homme',
            'codePostal' => "1004",
            'canton' => 'Vaud',
            'adresse' => "rue de la tour 10",
            'telephone' => "0211234567",
            'telephone_2' => "0791234567",
            'photo' => "https://upload.wikimedia.org/wikipedia/commons/thumb/c/c6/Jean-Michel_Tartayre_7.jpg/220px-Jean-Michel_Tartayre_7.jpg",
        ]);
        $utilisateur_1->save();
        $utilisateur_1->groupes()->save($groupe_2);

        $utilisateur_2 = new \App\User([
            'pseudo' => "stephAnders",
            'password' => bcrypt('pomme'),
            'nom' => "Anderson",
            'prenom' => "Stéphane",
            'email' => "stephaneAnders@bluewin.ch",
            'ville' => "yverdon-les-bains",
            'codePostal' => "1400",
            'sexe' => 'homme',
            'canton' => 'Vaud',
            'adresse' => "rue du Moulin 6",
            'telephone' => "0212234567",
            'telephone_2' => "0792234567",
            'photo' => "https://www.usherbrooke.ca/droit/fileadmin/_processed_/6/f/csm_Stephane_Bernatchez_FL44511_ce315d2846.jpg",
        ]);
        $utilisateur_2->save();
        $utilisateur_2->groupes()->save($groupe_2);

        $utilisateur_3 = new \App\User([
            'pseudo' => "christopheSmith",
            'password' => bcrypt('pomme'),
            'nom' => "Smith",
            'prenom' => "Christophe",
            'sexe' => 'homme',
            'email' => "christophe@junior.com",
            'ville' => "Lutry",
            'codePostal' => "1095",
            'canton' => 'Vaud',
            'adresse' => "rue du lac 12",
            'telephone' => "0213234447",
            'telephone_2' => "0793234567",
            'photo' => "http://spu.edu/~/media/administration/student-financial-services/panel/student-in-sub.ashx",
        ]);
        $utilisateur_3->save();
        $utilisateur_3->groupes()->save($groupe_1);

        $utilisateur_4 = new \App\User([
            'pseudo' => "juju18",
            'password' => bcrypt('pomme'),
            'nom' => "Auberson",
            'prenom' => "Julie",
            'sexe' => 'femme',
            'email' => "julie-auberson@gmail.com",
            'ville' => "Payerne",
            'codePostal' => "1530",
            'canton' => 'Vaud',
            'adresse' => "rue de la gare 20",
            'telephone' => "0214234857",
            'telephone_2' => "0794234567",
            'photo' => "https://s16815.pcdn.co/wp-content/uploads/2017/06/iStock-609683672-studying.jpg",
        ]);
        $utilisateur_4->save();
        $utilisateur_4->groupes()->save($groupe_1);

        $utilisateur_5 = new \App\User([
            'pseudo' => "chloe-employe",
            'password' => bcrypt('pomme'),
            'nom' => "Boutin",
            'prenom' => "Chloé",
            'email' => "chloe-boutin@hotmail.com",
            'ville' => "Cugy",
            'codePostal' => "1053",
            'sexe' => 'femme',
            'canton' => 'Vaud',
            'adresse' => "rue de la mare 1",
            'telephone' => "0215259982",
            'telephone_2' => "0795212579",
            'photo' => "https://flashlearners.com/wp-content/uploads/2018/01/great-student-e1518484477610.jpg",
        ]);
        $utilisateur_5->save();
        $utilisateur_5->groupes()->save($groupe_3);

        $utilisateur_6 = new \App\User([
            'pseudo' => "mel-can",
            'password' => bcrypt('pomme'),
            'nom' => "Canno",
            'prenom' => "Melanie",
            'email' => "melanie.canno@gmail.com",
            'ville' => "Neuchâtel",
            'codePostal' => "2000",
            'sexe' => 'femme',
            'canton' => 'Neuchâtel',
            'adresse' => "rue du moine 7",
            'telephone' => "0215259771",
            'telephone_2' => "0795212012",
            'photo' => "https://flashlearners.com/wp-content/uploads/2018/01/great-student-e1518484477610.jpg",
        ]);
        $utilisateur_6->save();
        $utilisateur_6->groupes()->save($groupe_1);

        /*=====================================
        ========ABONNEMENTS====================
        =====================================*/
        $abonnement_1 = new \App\Abonnement([
            'nom' => "ponctuelle",
            'prix' => "15",
            'description' => "Prix par prestation : vous ne payez que ce que vous utilisez. Prise en charge en priorité normale. Hotline disponible. 0% de prestations spécialisées",
        ]);
        $abonnement_1->save();

        $abonnement_2 = new \App\Abonnement([
            'nom' => "light",
            'prix' => "10",
            'description' => "Une intervention par mois comprise dans l'abonnement. Prise en charge en priorité normale. Hotline disponible. 0% de prestations spécialisées",
        ]);
        $abonnement_2->save();

        $abonnement_3 = new \App\Abonnement([
            'nom' => "medium",
            'prix' => "20",
            'description' => "Deux intervention par mois comprise dans l'abonnement. Prise en charge en priorité intermédiaire. Hotline disponible. 5% de prestations spécialisées",
        ]);
        $abonnement_3->save();

        $abonnement_4 = new \App\Abonnement([
            'nom' => "premium",
            'prix' => "40",
            'description' => "Une intervention par semaine comprise dans l'abonnement. Prise en charge en priorité normale. Hotline disponible. 10% de rabais pour l'achat de matériel chez les partenaires",
        ]);
        $abonnement_4->save();

        /*=====================================
        ========SENIORS========================
        =====================================*/
        $senior_1 = new \App\Senior([
            'user_id' => $utilisateur_1->id,
            'abonnement_id' => $abonnement_1->id,
            'etage' => "1",
        ]);
        $senior_1->save();

        $senior_2 = new \App\Senior([
            'user_id' => $utilisateur_2->id,
            'abonnement_id' => $abonnement_2->id,
            'etage' => "2",
        ]);
        $senior_2->save();

        /*=====================================
        ========JUNIORS========================
        =====================================*/
        $junior_1 = new \App\Junior([
            'user_id' => $utilisateur_3->id,
            'adresse_2' => "",
            'lienCV' => "http://example.com/CV-christophe",
            'dureeEngagement' => "12",
            'estValide' => false,
            'banque' => "UBS",
            'numeroCompteBancaire' => "CH5604835012345678009",
            'aProposDeMoi' => 'je voulais découvrir ce nouveau service. Je peux aider pour des problèmes informatiques.'
        ]);
        $junior_1->save();
        $junior_1->competences()->save($competence_1,['niveau' => '2']);
        $junior_1->competences()->save($competence_3,['niveau' => '3']);
        $junior_1->competences()->save($competence_7,['niveau' => '2']);
        $junior_1->competences()->save($competence_2,['niveau' => '2']);
        $junior_1->competences()->save($competence_4,['niveau' => '2']);

        $junior_2 = new \App\Junior([
            'user_id' => $utilisateur_4->id,
            'adresse_2' => "Lausanne",
            'lienCV' => "http://example.com/CV-julie",
            'dureeEngagement' => "6",
            'estValide' => true,
            'banque' => "Raiffeisen",
            'numeroCompteBancaire' => "CH5604835012345678009",
            'aProposDeMoi' => 'je cherche à rendre service.'
        ]);
        $junior_2->save();
        $junior_2->competences()->save($competence_2,['niveau' => '1']);
        $junior_2->competences()->save($competence_10,['niveau' => '2']);
        $junior_2->competences()->save($competence_5,['niveau' => '3']);
        $junior_2->competences()->save($competence_6,['niveau' => '1']);

        $junior_3 = new \App\Junior([
            'user_id' => $utilisateur_6->id,
            'adresse_2' => "",
            'lienCV' => "http://example.com/CV-melanie",
            'dureeEngagement' => "10",
            'estValide' => false,
            'banque' => "BCV",
            'numeroCompteBancaire' => "CH5604835012345678009",
            'aProposDeMoi' => 'je suis une personne qui aime aider mon prochain.'
        ]);
        $junior_3->save();
        $junior_3->competences()->save($competence_1,['niveau' => '1']);
        $junior_3->competences()->save($competence_3,['niveau' => '2']);
        $junior_3->competences()->save($competence_6,['niveau' => '3']);
        $junior_3->competences()->save($competence_8,['niveau' => '3']);
        $junior_3->competences()->save($competence_4,['niveau' => '2']);

        /*=====================================
        ========DISPONIBILITES=======================
        =====================================*/
        $disponibilite_1 = new \App\Disponibilite([
            'junior_id' => $junior_1->id,
            'heureDebut' => "14:00:00",
            'heureFin' => "16:00:00",
            'jourDeLaSemaine' => "mercredi",
        ]);
        $disponibilite_1->save();

        $disponibilite_2 = new \App\Disponibilite([
            'junior_id' => $junior_1->id,
            'heureDebut' => "15:00:00",
            'heureFin' => "16:00:00",
            'jourDeLaSemaine' => "vendredi",
        ]);
        $disponibilite_2->save();

        $disponibilite_3 = new \App\Disponibilite([
            'junior_id' => $junior_1->id,
            'heureDebut' => "08:00:00",
            'heureFin' => "10:00:00",
            'jourDeLaSemaine' => "lundi",
        ]);
        $disponibilite_3->save();

        $disponibilite_4 = new \App\Disponibilite([
            'junior_id' => $junior_2->id,
            'heureDebut' => "10:00:00",
            'heureFin' => "19:30:00",
            'date' => "2018-07-07",
        ]);
        $disponibilite_4->save();

        $disponibilite_5 = new \App\Disponibilite([
            'junior_id' => $junior_2->id,
            'heureDebut' => "09:00:00",
            'heureFin' => "12:00:00",
            'date' => "2018-07-10",
        ]);
        $disponibilite_5->save();

        $disponibilite_6 = new \App\Disponibilite([
            'junior_id' => $junior_2->id,
            'heureDebut' => "08:00:00",
            'heureFin' => "14:00:00",
            'date' => "2018-07-14",
        ]);
        $disponibilite_6->save();

        $disponibilite_7 = new \App\Disponibilite([
            'junior_id' => $junior_2->id,
            'heureDebut' => "11:00:00",
            'heureFin' => "19:30:00",
            'date' => "2018-07-17",
        ]);
        $disponibilite_7->save();

        $disponibilite_8 = new \App\Disponibilite([
            'junior_id' => $junior_3->id,
            'heureDebut' => "13:30:00",
            'heureFin' => "19:30:00",
        ]);
        $disponibilite_8->save();

        /*=====================================
        ========RECURRENCES====================
        =====================================*/
        $recurrence_1 = new \App\Recurrence([
            'dateDebut' => "2018-06-30",
            'dateFin' => "2018-08-30",
            'frequence' => "hebdomadaire",
        ]);

        $recurrence_1->save();
        $recurrence_1->disponibilites()->save($disponibilite_1);
        $recurrence_1->disponibilites()->save($disponibilite_2);
        $recurrence_1->disponibilites()->save($disponibilite_3);

        $recurrence_2 = new \App\Recurrence([
            'dateDebut' => "2018-06-10",
            'dateFin' => "2018-07-20",
            'frequence' => "quotidien",
        ]);

        $recurrence_2->save();
        $recurrence_1->disponibilites()->save($disponibilite_8);

        /*=====================================
        ========EMPLOYES=======================
        =====================================*/
        $employe_1 = new \App\Employe([
            "user_id" => $utilisateur_5->id
        ]);
        $employe_1->save();

        /*=====================================
        ========DEMANDES=======================
        =====================================*/
        $demande_1 = new \App\Demande([
            'junior_id' => $junior_1->id,
            'senior_id' => $senior_1->id,
            'employe_id' => $employe_1->id,
            'description' => "j'ai besoin d'aide pour installer Windows et mon natel.",
            'date' => "2018-07-04",
            'heure'=> "15:00:00",
            'duree' => "1",
            'titre' => "windows et natel",
            'statut' => "validé"
        ]);
        $demande_1->save();
        $demande_1->disponibilites()->save($disponibilite_1);
        $demande_1->competences()->save($competence_2);
        $demande_1->competences()->save($competence_5);

        $demande_2 = new \App\Demande([
            'senior_id' => $senior_2->id,
            'employe_id' => $employe_1->id,
            'description' => "j'ai besoin d'aide pour m'acheter une nouvelle table en ligne",
            'date' => "2018-06-18",
            'heure'=> "09:00:00",
            'duree' => "1",
            'titre' => "table sur Ikea",
            'statut' => "envoyé",
        ]);

        $demande_2->save();
        $demande_2->competences()->save($competence_10);

        $demande_3 = new \App\Demande([
            'junior_id' => $junior_3->id,
            'senior_id' => $senior_2->id,
            'employe_id' => $employe_1->id,
            'description' => "j'aimerais bien créer un compte facebook.",
            'date' => "2018-06-25",
            'heure'=> "17:00:00",
            'duree' => "2",
            'titre' => "facebook",
            'statut' => "reçu",
        ]);

        $demande_3->save();
        $demande_3->competences()->save($competence_8);
        $demande_3->disponibilites()->save($disponibilite_7);

        $demande_4 = new \App\Demande([
            'junior_id' => $junior_3->id,
            'senior_id' => $senior_2->id,
            'employe_id' => $employe_1->id,
            'description' => "j'aimerais bien installer Word pour écrire mes poèmes.",
            'date' => "2018-06-13",
            'heure'=> "15:00:00",
            'duree' => "2",
            'titre' => "word",
            'statut' => "accepté",
        ]);

        $demande_4->save();
        $demande_4->competences()->save($competence_7);
        $demande_4->disponibilites()->save($disponibilite_7);

        /*=====================================
        ========INTERVENTIONS==================
        =====================================*/
        $intervention_1 = new \App\Intervention([
            'employe_id' => $employe_1->id,
            'demande_id' => $demande_4->id,
            'dateDebutPrevue' => "2018-06-13",
            'dateFinPrevue' => "2018-06-13",
        ]);
        $intervention_1->save();
        $intervention_1->disponibilites()->save($disponibilite_7);

        /*=====================================
        ========INTERVENTIONS EFFECTIVES=======
        =====================================*/
        $interventioneffective_1 = new \App\Interventioneffective([
            'intervention_id' => $intervention_1->id,
            'date' => "2018-06-13",
            'heureDebut' => "17:00:00",
            'heureFin' => "19:00:00",
        ]);
        $interventioneffective_1->save();

        /*=====================================
        ========RAPPORTS=======================
        =====================================*/
        $rapport_1 = new \App\Rapport([
            'user_id' => $senior_2->id,
            'interventioneffective_id' => $interventioneffective_1->id,
            'classement' => "5",
            'commentaireTitre' => "super !",
            'commentaireDescription' => "super  !tout est ok, je peux utiliser Word",
        ]);
        $rapport_1->save();

        $rapport_2 = new \App\Rapport([
            'user_id' => $junior_3->id,
            'interventioneffective_id' => $interventioneffective_1->id,
            'classement' => "5",
            'commentaireTitre' => "c'est tout bon",
            'commentaireDescription' => "on m'a remercié 15000 fois, c'était juste pour Word. J'ai pu montré quelques fonctionnalités aussi comme les styles.",
        ]);
        $rapport_2->save();

    }
}