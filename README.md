# projetConcert
Projet Symfony IUT-2023

Comptes :
Il y a trois comptes créés par les fixtures : deux comptes utilisateurs et un compte admin. Un visiteur ne peut pas créer de compte admin, 
il faut donc utiliser celui qui existe déjà.

Compte utilisateur :

login: email@gmail.com

password: azerty

login: utilisateur@gmail.com

password: qsdfgh

Compte admin :

login: adresse@gmail.com
password: wxcvbn
Espace utilisateur :
Le mot de passe n'est pas modifiable, car la fonctionnalité n'est pas implémentée. Pour modifier le compte, il faut téléverser une photo de profil.

Membre/Concert/Artiste :
Les boutons de suppression sont tous commentés, car ils génèrent des erreurs de clé étrangère qui ne sont pas traitées par l'application.

Pour les membres et les artistes, il faut téléverser une image qui sera affichée dans les listes. 
Dans le formulaire, les images ne s'affichent pas, mais une fois sélectionnées dans le champ, elles sont bien prises en compte.
