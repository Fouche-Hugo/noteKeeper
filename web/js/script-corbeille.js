window.onload = function () {
    const vue = Vue.createApp({
        data() {
            return {
                mode: '',
                notes: []
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
                if (this.mode === 'light') {
                    document.querySelector("#style-mode").href = "css/style-corbeille-light.css";
                } else {
                    document.querySelector("#style-mode").href = "css/style-corbeille-dark.css";
                }
            },
            profilMenuClose() {
                //Il y a 2 classes pour profil-menu et close-profil-menu:
                //open : le menu est ouvert (display: block)
                //open-animation : le menu est ouvert et en train d'être ouvert (opacity: 1)
                //sans classe, le menu est fermé (display: none + opacity: 0)
                document.querySelector(".profil-menu").classList.remove("open-animation");
                document.querySelector(".close-profil-menu").classList.remove("open-animation");
                setTimeout(function () {
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
                setTimeout(function () {
                    document.querySelector(".profil-menu").classList.add("open-animation");
                    document.querySelector(".close-profil-menu").classList.add("open-animation");
                }, 1);

                document.body.style.overflow = "hidden";
            },
            notesListUpdate() {
                let infos = new FormData();
                infos.append("listeNotes", 1);
                fetch('php/corbeille_serveur.php', {
                    method: 'POST',
                    body: infos
                })
                .then(function(response) {
                    if(response.ok) {
                        return response.json();
                    }
                }).then(data => {
                    if(data.status === "sucess") {
                        console.log(data.notes);
                        for(let i = 0;i < data.notes.length;i++) {
                            let note = {titre: data.notes[i].titre, texte: data.notes[i].texte, etat: data.notes[i].etat, dateCreation: data.notes[i].dateCreation,
                                dateModification: data.notes[i].dateModification, couleurFond: data.notes[i].couleurFond, couleurTexte: data.notes[i].couleurTexte};
                            this.notes.push(note);
                        }
                    } else {
                        console.log("impossible de récupérer les données des notes");
                    }
                });
            }
        },
        mounted() {
            if (document.cookie.indexOf("mode=") != -1) {
                this.mode = document.cookie.split("mode=")[1].split(";")[0];
            } //sinon on prend le mode par défaut
            else {
                this.mode = "light";
            }
            this.updateMode();
            this.notesListUpdate();
        }
    })

    vue.component('note-corbeille', {
        template: `
            <div class="note" :style="{background: couleurFond}">
                <div class="note-header" :style="{color: couleurTexte}">{{titre}}</div>
                <div class="note-content" :style="{color: couleurTexte}">{{texte}}</div>
                <div class="note-date" :style="{color: couleurTexte}">Date de création : {{dateCreation}}<br>Date de dernière modification : {{dateModification}}</div>
                <div class="note-footer-corbeille">
                    <div class="note-footer-restore" @click="restoreNote">
                        <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M17.5 2.5H7.5C6.125 2.5 5.0125 3.625 5.0125 5L5 25C5 26.375 6.1125 27.5 7.4875 27.5H22.5C23.875 27.5 25 26.375 25 25V10L17.5 2.5ZM15
                            22.5C12.4375 22.5 10.2375 20.95 9.275 18.75H11.4125C12.2 19.875 13.5125 20.625 15 20.625C17.4125 20.625 19.375 18.6625 19.375 16.25C19.375 13.8375
                            17.4125 11.875 15 11.875C14.1985 11.878 13.4133 12.101 12.7299 12.5198C12.0466 12.9387 11.4914 13.5372 11.125 14.25L13.125 16.25H8.125V11.25L9.75
                            12.875C10.8625 11.15 12.7875 10 15 10C18.45 10 21.25 12.8 21.25 16.25C21.25 19.7 18.45 22.5 15 22.5Z" fill="black"/>
                        </svg>
                    </div>
            </div>
        `,
        props: ['titre', 'texte', 'date-creation', 'date-modification', 'couleur-fond', 'couleur-texte', 'etat', 'mode'],
        data() {
            return {
                pinned: false
            }
        },
        methods: {
            restoreNote() {
                let infosNote = new FormData();
                infosNote.append("restoreNote", 1);
                infosNote.append("dateCreation", this.dateCreation);

                this.$emit("restore-note");

                fetch('php/corbeille_serveur.php', {
                    method: 'POST',
                    body: infosNote
                })
                .then(function(response) {
                    console.log(response);
                    if(response.ok) {
                        return response.json();
                    }
                }).then(data => {
                    if(data.status === "sucess") {
                        console.log("La note à bien été restaurée du coté du serveur");
                    } else {
                        console.log("Impossible de restaurer la note : " + data.status);
                    }
                });
            }
        },
        mounted() {
            if(this.etat === 'EPINGLE') {
                this.pinned = true;
            }
        }
    });

    vue.mount("html");
}