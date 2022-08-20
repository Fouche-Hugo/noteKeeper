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
                    <div class="note-footer-pin" :class="{pinned: pinned}">
                        <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M18.4275 1.35375C18.5507 1.35353 18.6727 1.37759 18.7866 1.42457C18.9005 1.47154 19.004 1.5405 19.0912 1.6275L28.3725 10.9087C28.5482
                            11.0846 28.647 11.323 28.647 11.5716C28.647 11.8202 28.5482 12.0586 28.3725 12.2344C27.4725 13.1344 26.3625 13.3369 25.5544 13.3369C25.2225 13.3369
                            24.9262 13.3031 24.6919 13.2637L18.8156 19.14C18.9703 19.7633 19.0707 20.3988 19.1156 21.0394C19.2019 22.3556 19.0556 24.2025 17.7656 25.4925C17.5898
                            25.6683 17.3514 25.767 17.1028 25.767C16.8542 25.767 16.6158 25.6683 16.44 25.4925L11.1356 20.19L5.16935 26.1562C4.80373 26.5219 2.88373 27.8475 2.5181
                            27.4819C2.15248 27.1162 3.4781 25.1944 3.84373 24.8306L9.80998 18.8644L4.50748 13.56C4.33172 13.3842 4.23299 13.1458 4.23299 12.8972C4.23299 12.6486
                            4.33172 12.4102 4.50748 12.2344C5.79748 10.9444 7.64435 10.7962 8.9606 10.8844C9.60121 10.9293 10.2367 11.0296 10.86 11.1844L16.7362 5.31C16.6872 5.02447
                            16.6621 4.73534 16.6612 4.44562C16.6612 3.63937 16.8637 2.52937 17.7656 1.6275C17.9413 1.45225 18.1793 1.3538 18.4275 1.35375V1.35375Z" fill="#401B37"/>
                        </svg>
                    </div>
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