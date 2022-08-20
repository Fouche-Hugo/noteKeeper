window.onload = function() {
    var vue = Vue.createApp({
        data() {
            return {
                mode: '',
                nom: '',
                nomServeur: '',
                nomUpdating: false,
                prenom: '',
                prenomServeur: '',
                prenomUpdating: false,
                email: '',
                emailServeur: '',
                emailUpdating: false,
                ancienMotDePasse: '',
                nouveauMotDePasse: '',
                nouveauMotDePasse2: '',
                reponsesServeur: []
            }
        },
        methods: {
            toggleMode() {
                this.mode = this.mode === 'light' ? 'dark' : 'light';
                this.updateMode();
                //on met à jour le cookie
                let date = new Date(Date.now() + 86400000 * 7);//1 semaine
                date = date.toUTCString();
                document.cookie = 'mode=' + this.mode + '; path=/' + '; expires=' + date;
            },
            updateMode() {
                if(this.mode === 'light') {
                    document.querySelector("#style-mode").href = "css/style-header-light.css";
                    document.querySelector("#style-mode2").href = "css/style-update-infos-light.css";
                } else {
                    document.querySelector("#style-mode").href = "css/style-header-dark.css";
                    document.querySelector("#style-mode2").href = "css/style-update-infos-dark.css";
                }
            },
            profilMenuClose() {
                //Il y a 2 classes pour profil-menu et close-profil-menu:
                //open : le menu est ouvert (display: block)
                //open-animation : le menu est ouvert et en train d'être ouvert (opacity: 1)
                //sans classe, le menu est fermé (display: none + opacity: 0)
                document.querySelector(".profil-menu").classList.remove("open-animation");
                document.querySelector(".close-profil-menu").classList.remove("open-animation");
                setTimeout(function() {
                    document.querySelector(".profil-menu").classList.remove("open");
                    document.querySelector(".close-profil-menu").classList.remove("open");
                }, 1000);

                document.body.style.overflow = "scroll";
            },
            profilMenuOpen() {
                //Il y a 2 classes pour profil-menu et close-profil-menu:
                //open : le menu est ouvert (display: block)
                //open-animation : le menu est ouvert et en train d'être ouvert (opacity: 1)
                //sans classe, le menu est fermé (display: none + opacity: 0)
                document.querySelector(".profil-menu").classList.add("open");
                document.querySelector(".close-profil-menu").classList.add("open");
                setTimeout(function() {
                    document.querySelector(".profil-menu").classList.add("open-animation");
                    document.querySelector(".close-profil-menu").classList.add("open-animation");
                }, 1);

                document.body.style.overflow = "hidden";
            },
            verificationAdresseMail() {
                return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(this.email);
            },
            ajouterReponseServeur(reponse) {
                this.reponsesServeur.push(reponse);
           },
            submitNouveauMotDePasse(event) {
                //On vérifie que l'ancien mot de passe n'est pas vide
                if(this.ancienMotDePasse.length > 0) {
                    //On vérifie que le nouveau mot de passe est plus grand que 8 caractères et est plus petit que 25 caractères
                    if(this.nouveauMotDePasse.length > 7 && this.nouveauMotDePasse.length < 25) {
                        //On vérifie ensuite que les nouveaux mots de passe 1 et 2 soient identiques
                        if(this.nouveauMotDePasse === this.nouveauMotDePasse2) {
                            //Alors on envoie les informations au serveur
                            event.target.submit();
                        }
                    }
                }
            },
            submitNouveauNom() {
                //On vérifie que le nouveau nom est plus petit que 25 caractères
                this.nomUpdating = true;
                fetch("php/update-infos_serveur.php", {
                    method: "POST",
                    body: new FormData(document.querySelector("#form-update-nom"))
                }).then(function(response) {
                    if(response.ok) {
                        return response.json();
                    } else {
                        this.ajouterReponseServeur({type: 'erreur-serveur', message: "Impossible de changer de nom pour l'instant. Veuillez réessayer plus tard."});
                        this.nomUpdating = false;
                    }
                }).then(data => {
                    if(data.status == 'erreurBDD') {
                        this.ajouterReponseServeur({type: 'erreur-serveur', message: "Impossible de changer de nom pour l'instant. Veuillez réessayer plus tard."});
                    } else if(data.status == 'erreurNom') {
                        this.ajouterReponseServeur({type: 'erreur-serveur', message: "Le nom ne respecte pas les caractéristiques demandées."});
                    } else if(data.status == 'sucess') {
                        this.ajouterReponseServeur({type: 'validation-serveur', message: "Le nom a bien été mis à jour."});
                        //Temporaire, il faut changer le svg pour que ce soit plus stylé (un premier pour quand le nom est à jour, le deuxième pour quand le nom est en cours de chargement
                        //et un dernier quand on l'a changé et que l'on peut l'upload)
                        this.nomServeur = this.nom;
                    } else {
                        //Si on a pas eu de réponses, on renvoie une erreur
                        this.ajouterReponseServeur({type: 'erreur-serveur', message: "Impossible de changer de nom pour l'instant. Veuillez réessayer plus tard."});
                    }
                    this.nomUpdating = false;
                });
            },
            submitNouveauPrenom() {
                //On vérifie que le nouveau nom est plus petit que 25 caractères
                this.prenomUpdating = true;
                fetch("php/update-infos_serveur.php", {
                    method: "POST",
                    body: new FormData(document.querySelector("#form-update-prenom"))
                }).then(function(response) {
                    if(response.ok) {
                        return response.json();
                    } else {
                        this.ajouterReponseServeur({type: 'erreur-serveur', message: "Impossible de changer de prénom pour l'instant. Veuillez réessayer plus tard."});
                        this.prenomUpdating = false;
                    }
                }).then(data => {
                    if(data.status == 'erreurBDD') {
                        this.ajouterReponseServeur({type: 'erreur-serveur', message: "Impossible de changer de prénom pour l'instant. Veuillez réessayer plus tard."});
                    } else if(data.status == 'erreurPrenom') {
                        this.ajouterReponseServeur({type: 'erreur-serveur', message: "Le prénom ne respecte pas les caractéristiques demandées."});
                    } else if(data.status == 'sucess') {
                        this.ajouterReponseServeur({type: 'validation-serveur', message: "Le prénom a bien été mis à jour."});
                        //Temporaire, il faut changer le svg pour que ce soit plus stylé (un premier pour quand le nom est à jour, le deuxième pour quand le nom est en cours de chargement
                        //et un dernier quand on l'a changé et que l'on peut l'upload)
                        this.prenomServeur = this.prenom;
                    } else {
                        //Si on a pas eu de réponses, on renvoie une erreur
                        this.ajouterReponseServeur({type: 'erreur-serveur', message: "Impossible de changer de prénom pour l'instant. Veuillez réessayer plus tard."});
                    }
                    this.prenomUpdating = false;
                });
            },
            submitNouveauEmail() {
                //On vérifie que le nouveau nom est plus petit que 25 caractères
                this.emailUpdating = true;
                fetch("php/update-infos_serveur.php", {
                    method: "POST",
                    body: new FormData(document.querySelector("#form-update-email"))
                }).then(function(response) {
                    if(response.ok) {
                        return response.json();
                    } else {
                        this.ajouterReponseServeur({type: 'erreur-serveur', message: "Impossible de changer d'e-mail pour l'instant. Veuillez réessayer plus tard."});
                        this.emailUpdating = false;
                    }
                }).then(data => {
                    if(data.status == 'erreurBDD') {
                        this.ajouterReponseServeur({type: 'erreur-serveur', message: "Impossible de changer d'e-mail pour l'instant. Veuillez réessayer plus tard."});
                    } else if(data.status == 'erreurMail') {
                        this.ajouterReponseServeur({type: 'erreur-serveur', message: "L'e-mail ne respecte pas les caractéristiques demandées."});
                    } else if(data.status == 'sucess') {
                        this.ajouterReponseServeur({type: 'validation-serveur', message: "L'e-mail a bien été mis à jour."});
                        //Temporaire, il faut changer le svg pour que ce soit plus stylé (un premier pour quand le nom est à jour, le deuxième pour quand le nom est en cours de chargement
                        //et un dernier quand on l'a changé et que l'on peut l'upload)
                        this.emailServeur = this.email;
                    } else {
                        //Si on a pas eu de réponses, on renvoie une erreur
                        this.ajouterReponseServeur({type: 'erreur-serveur', message: "Impossible de changer d'e-mail pour l'instant. Veuillez réessayer plus tard."});
                    }
                    this.emailUpdating = false;
                });
            }
        },
        mounted() {
            this.nom = document.querySelector("#nom").getAttribute("data-value");
            this.nomServeur = document.querySelector("#nom").getAttribute("data-value");
            this.prenom = document.querySelector("#prenom").getAttribute("data-value");
            this.prenomServeur = document.querySelector("#prenom").getAttribute("data-value");
            this.email = document.querySelector("#mail").getAttribute("data-value");
            this.emailServeur = document.querySelector("#mail").getAttribute("data-value");

            //gestion du mode jour / nuit
            if(document.cookie.indexOf("mode=") != -1) {
                this.mode = document.cookie.split("mode=")[1].split(";")[0];
            } //sinon on prend le mode par défaut
            else {
                this.mode = "light";
            }
            this.updateMode();
        }
    })

    vue.component('erreur-serveur', {
        props: ['message'],
        data() {
            return {
                affichage: true
            }
        },
        template: `
            <div class="erreur-serveur" v-if="affichage">
                <span>{{ message }}</span>
                <button @click="toggleAffichage">Fermer</button>
            </div>
        `,
        methods: {
            toggleAffichage() {
                this.affichage = !this.affichage;
            }
        }
    });

    vue.component('validation-serveur', {
        props: ['message'],
        data() {
            return {
                affichage: true
            }
        },
        template: `
            <div class="validation-serveur" v-if="affichage">
                <span>{{ message }}</span>
                <button @click="toggleAffichage">Fermer</button>
            </div>
        `,
        methods: {
            toggleAffichage() {
                this.affichage = !this.affichage;
            }
        }
    });

    vue.mount('html');
}