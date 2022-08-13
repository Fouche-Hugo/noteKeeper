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
                    document.querySelector("#style-mode").href = "css/style-index-light.css";
                } else {
                    document.querySelector("#style-mode").href = "css/style-index-dark.css";
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
                fetch('php/index_serveur.php', {
                    method: 'POST',
                    body: infos
                })
                .then(function(response) {
                    console.log(response);
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
                            console.log(note);
                        }
                    } else {
                        console.log(data.status);
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

    vue.component('note-creation', {
        template: `
            <form @submit.prevent="saveNote" class="note-creation" :style="{background: backgroundColorElement}">
                <div :class="{'note-creation-header': state === 'open', 'note-creation-titre': state === 'close'}">
                    <input type="text" v-model="titre" placeholder="Écrire une note..." @input="updateState" :style="{color: textColorElement}" />
                </div>
                <div class="note-creation-content" v-if="state === 'open'">
                    <textarea v-model="content" placeholder="Écrire du contenu..." @input="updateHeightTextArea" :style="{color: textColorElement}"></textarea>
                </div>
                <form class="note-creation-footer" v-if="state === 'open'">
                    <div class="note-creation-footer-validate" v-if="secondaryState === 'none'" @click="saveNote">
                        <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5 15L12.5 22.5L25 7.5" stroke="black" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div class="note-creation-footer-background-color" @click="updateSecondaryState('backgroundColor')" v-if="secondaryState === 'none'">
                        <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M25 17.4975C24.885 17.5787 22.5 20.1012 22.5 21.8725C22.5 23.74 23.6863 24.9325 25 24.9975C26.1325 25.0525 27.5 23.8837 27.5 21.8725C27.5
                                19.9975 25.115 17.5787 25 17.4975V17.4975ZM4.26752 16.2475C4.26752 16.915 4.52752 17.5425 5.00002 18.015L11.9825 24.9975C12.455 25.47 13.0825
                                25.73 13.75 25.73C14.4175 25.73 15.045 25.47 15.5175 24.9975L24.2675 16.2475L23.3838 15.3637L13.75 5.73L10.8838 2.86375L9.11627 4.63125L11.9825
                                7.4975L5.00002 14.48C4.52752 14.9525 4.26752 15.58 4.26752 16.2475V16.2475ZM13.75 9.265L20.7325 16.2475L13.75 23.23H13.7513L13.75 24.48V23.23L6.76752
                                16.2475L13.75 9.265Z" fill="#401B37"/>
                        </svg>
                    </div>
                    <div class="note-creation-footer-color-menu" v-if="secondaryState === 'backgroundColor'">
                        <div class="note-creation-footer-color-menu-item" @click="updateBackgroundColor('transparent')" :style="{background: '#1C1823'}" v-if="mode === 'dark'"></div>
                        <div class="note-creation-footer-color-menu-item" @click="updateBackgroundColor('transparent')" :style="{background: '#FCFCFF'}" v-if="mode === 'light'"></div>
                        <div class="note-creation-footer-color-menu-item" v-for="color in colors" @click="updateBackgroundColor(color)" :style="{background: color}"></div>
                        <svg class="note-creation-footer-color-menu-item delete" width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg" @click="updateSecondaryState('none')">
                            <path d="M25 25L5 5M25 5L5 25" stroke="#401B37" stroke-width="2.5" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <div class="note-creation-footer-text-color" @click="updateSecondaryState('textColor')" v-if="secondaryState === 'none'">
                        <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M24.425 6.35C23.1717 5.10553 21.6824 4.12393 20.0447 3.4628C18.4069 2.80167 16.6535 2.47434 14.8875 2.5C11.5723 2.49171 8.38957
                            3.80072 6.0395 6.13907C3.68944 8.47741 2.36453 11.6535 2.35624 14.9688C2.34795 18.284 3.65696 21.4667 5.99531 23.8167C8.33365 26.1668 11.5098
                            27.4917 14.825 27.5C15.5394 27.5121 16.2375 27.2867 16.8099 26.8591C17.3823 26.4315 17.7965 25.826 17.9875 25.1375C18.1092 24.6403 18.108 24.1209
                            17.9838 23.6244C17.8597 23.1278 17.6164 22.6689 17.275 22.2875C17.1961 22.1977 17.1446 22.0871 17.1266 21.9688C17.1086 21.8506 17.125 21.7297
                            17.1736 21.6205C17.2223 21.5113 17.3013 21.4183 17.4013 21.3526C17.5012 21.287 17.6179 21.2513 17.7375 21.25H19.8C21.7412 21.2591 23.6139 20.5334
                            25.0422 19.2188C26.4705 17.9041 27.3485 16.0978 27.5 14.1625C27.5465 12.7195 27.2977 11.2822 26.769 9.93882C26.2402 8.59541 25.4426 7.37417 24.425
                            6.35V6.35ZM8.54999 18.425C8.24308 18.6336 7.88118 18.7464 7.51011 18.7492C7.13904 18.752 6.77548 18.6446 6.46548 18.4406C6.15548 18.2367 5.91297
                            17.9453 5.76866 17.6034C5.62434 17.2616 5.58472 16.8846 5.65479 16.5202C5.72487 16.1558 5.9015 15.8203 6.16232 15.5564C6.42314 15.2924 6.75642 15.1118
                            7.11996 15.0374C7.4835 14.9629 7.86095 14.998 8.20452 15.1382C8.54809 15.2785 8.84233 15.5175 9.04999 15.825C9.18914 16.0281 9.28663 16.2568 9.33683
                            16.4979C9.38703 16.7389 9.38893 16.9875 9.34243 17.2293C9.29594 17.4711 9.20196 17.7013 9.06594 17.9065C8.92992 18.1117 8.75455 18.288 8.54999
                            18.425V18.425ZM10.375 11.5625C10.1971 11.8919 9.92476 12.1605 9.59292 12.3338C9.26108 12.507 8.88497 12.577 8.51303 12.5347C8.14109 12.4923
                            7.79033 12.3396 7.50593 12.0962C7.22153 11.8528 7.0165 11.5298 6.91724 11.1689C6.81798 10.8079 6.82903 10.4255 6.94898 10.0709C7.06892 9.71629 7.29227
                            9.4057 7.59026 9.17913C7.88825 8.95255 8.24724 8.82036 8.62101 8.79958C8.99478 8.77879 9.36621 8.87036 9.68749 9.0625C10.102 9.31042 10.4049 9.70877
                            10.533 10.1745C10.6611 10.6403 10.6045 11.1375 10.375 11.5625V11.5625ZM13.75 8.75C13.3792 8.75 13.0166 8.64003 12.7083 8.43401C12.4 8.22798 12.1596
                            7.93514 12.0177 7.59253C11.8758 7.24992 11.8387 6.87292 11.911 6.50921C11.9834 6.14549 12.1619 5.8114 12.4242 5.54917C12.6864 5.28695 13.0205 5.10837
                            13.3842 5.03603C13.7479 4.96368 14.1249 5.00081 14.4675 5.14273C14.8101 5.28464 15.103 5.52496 15.309 5.83331C15.515 6.14165 15.625 6.50416 15.625
                            6.875C15.625 7.37228 15.4274 7.84919 15.0758 8.20083C14.7242 8.55246 14.2473 8.75 13.75 8.75V8.75ZM20.9375 9.75C20.6162 9.94214 20.2448 10.0337
                            19.871 10.0129C19.4972 9.99214 19.1383 9.85995 18.8403 9.63337C18.5423 9.4068 18.3189 9.09621 18.199 8.7416C18.079 8.38699 18.068 8.0046 18.1672
                            7.64365C18.2665 7.2827 18.4715 6.95973 18.7559 6.71632C19.0403 6.4729 19.3911 6.32019 19.763 6.27785C20.135 6.23551 20.5111 6.30547 20.8429
                            6.47872C21.1748 6.65198 21.4471 6.9206 21.625 7.25C21.8545 7.67504 21.9111 8.17224 21.783 8.63799C21.6549 9.10373 21.352 9.50208 20.9375
                            9.75V9.75Z" fill="#401B37"/>
                        </svg>                
                    </div>
                    <div class="note-creation-footer-color-menu" v-if="secondaryState === 'textColor'">
                        <div class="note-creation-footer-color-menu-item" @click="updateTextColor('inherit')" :style="{background: '#FCFCFF'}" v-if="mode === 'dark'"></div>
                        <div class="note-creation-footer-color-menu-item" @click="updateTextColor('inherit')" :style="{background: '#401B37'}" v-if="mode === 'light'"></div>
                        <div class="note-creation-footer-color-menu-item" v-for="color in colors" @click="updateTextColor(color)" :style="{background: color}"></div>
                        <svg class="note-creation-footer-color-menu-item delete" width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg" @click="updateSecondaryState('none')">
                            <path d="M25 25L5 5M25 5L5 25" stroke="#401B37" stroke-width="2.5" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <div class="note-creation-footer-pin" v-if="secondaryState === 'none'" :class="{pinned: pinned}" @click="switchPinnedState">
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
                    <div class="note-creation-footer-delete" v-if="secondaryState === 'none'">
                        <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg" @click="reset">
                            <path d="M25 25L5 5M25 5L5 25" stroke="#401B37" stroke-width="2.5" stroke-linecap="round"/>
                        </svg>                    
                    </div>
            </form>
        `,
        data() {
            return {
                titre: "",
                state: "close", //ouvert ou fermé (closed / opened)
                secondaryState: "none",
                content: "",
                colors: ["#401B37", "#FFCB00", "#00BFA5", "#FF00FF"],
                textColorElement: "inherit",
                backgroundColorElement: "transparent",
                pinned: false
            }
        },
        props: ["mode"],
        methods: {
            updateState() {
                if (this.titre === "" && this.content === "") {
                    this.state = "close";
                } else {
                    this.state = "open";
                }
            },
            updateSecondaryState(state) {
                this.secondaryState = state;
            },
            updateHeightTextArea(event) {
                event.target.style.height = "";
                event.target.style.height = event.target.scrollHeight + "px";
            },
            updateTextColor(color) {
                this.textColorElement = color;
            },
            updateBackgroundColor(color) {
                this.backgroundColorElement = color;
            },
            switchPinnedState() {
                this.pinned = !this.pinned;
            },
            reset() {
                this.content = "";
                this.titre = "";
                this.updateState();
            },
            saveNote() {
                let infosNote = new FormData();
                infosNote.append("titre", this.titre);
                infosNote.append("texte", this.content);
                infosNote.append("couleurTexte", this.textColorElement);
                infosNote.append("couleurFond", this.backgroundColorElement);
                if(this.pinned) {
                    infosNote.append("etat", "EPINGLE");
                } else {
                    infosNote.append("etat", "NORMAL");
                }
                infosNote.append("nouvelleNote", 1);
                fetch("php/index_serveur.php", {
                    method: "POST",
                    body: infosNote
                }).then(function(response) {
                    console.log(response);
                    if(response.ok) {
                        return response.json();
                    }
                }).then(data => {
                    if(data.status == 'erreurBDD') {
                        console.log("Impossible d'ajouter une note pour l'instant. Veuillez réessayer plus tard.");
                    } else if(data.status == 'sucess') {
                        console.log("La note a été upload");
                        console.log(data.idNote)
                    } else {
                        //Si on a pas eu de réponses, on renvoie une erreur
                        console.log(data.status);
                    }
                });
            }
        }
    });

    vue.component('note', {
        template: `
            <div class="note" :style="{background: couleurFond, color: couleurTexte}">
                <div class="note-header">{{titre}}</div>
                <div class="note-content">{{texte}}</div>
                <div class="note-date">Date de création : {{dateCreation}}<br>Date de dernière modification : {{dateModification}}</div>
                <div class="note-footer" :class="footerState">
                    <div class="note-footer-hamburger-button" @click="switchFooterState" :class="footerState">
                        <div class="note-footer-hamburger-button-top"></div>
                        <div class="note-footer-hamburger-button-middle"></div>
                        <div class="note-footer-hamburger-button-bottom"></div>
                    </div>
                    <div class="note-footer-button note-footer-background-color" @click="updateSecondaryFooterState('backgroundColor')" v-if="footerState === 'open'" :class="{visible: backgroundColorButtonVisibility}">
                        <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M25 17.4975C24.885 17.5787 22.5 20.1012 22.5 21.8725C22.5 23.74 23.6863 24.9325 25 24.9975C26.1325 25.0525 27.5 23.8837 27.5 21.8725C27.5
                                19.9975 25.115 17.5787 25 17.4975V17.4975ZM4.26752 16.2475C4.26752 16.915 4.52752 17.5425 5.00002 18.015L11.9825 24.9975C12.455 25.47 13.0825
                                25.73 13.75 25.73C14.4175 25.73 15.045 25.47 15.5175 24.9975L24.2675 16.2475L23.3838 15.3637L13.75 5.73L10.8838 2.86375L9.11627 4.63125L11.9825
                                7.4975L5.00002 14.48C4.52752 14.9525 4.26752 15.58 4.26752 16.2475V16.2475ZM13.75 9.265L20.7325 16.2475L13.75 23.23H13.7513L13.75 24.48V23.23L6.76752
                                16.2475L13.75 9.265Z" fill="#401B37"/>
                        </svg>
                    </div>
                    <div class="note-footer-button note-footer-text-color" @click="updateSecondaryFooterState('textColor')" v-if="footerState === 'open'" :class="{visible: textColorButtonVisibility}">
                        <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M24.425 6.35C23.1717 5.10553 21.6824 4.12393 20.0447 3.4628C18.4069 2.80167 16.6535 2.47434 14.8875 2.5C11.5723 2.49171 8.38957
                            3.80072 6.0395 6.13907C3.68944 8.47741 2.36453 11.6535 2.35624 14.9688C2.34795 18.284 3.65696 21.4667 5.99531 23.8167C8.33365 26.1668 11.5098
                            27.4917 14.825 27.5C15.5394 27.5121 16.2375 27.2867 16.8099 26.8591C17.3823 26.4315 17.7965 25.826 17.9875 25.1375C18.1092 24.6403 18.108 24.1209
                            17.9838 23.6244C17.8597 23.1278 17.6164 22.6689 17.275 22.2875C17.1961 22.1977 17.1446 22.0871 17.1266 21.9688C17.1086 21.8506 17.125 21.7297
                            17.1736 21.6205C17.2223 21.5113 17.3013 21.4183 17.4013 21.3526C17.5012 21.287 17.6179 21.2513 17.7375 21.25H19.8C21.7412 21.2591 23.6139 20.5334
                            25.0422 19.2188C26.4705 17.9041 27.3485 16.0978 27.5 14.1625C27.5465 12.7195 27.2977 11.2822 26.769 9.93882C26.2402 8.59541 25.4426 7.37417 24.425
                            6.35V6.35ZM8.54999 18.425C8.24308 18.6336 7.88118 18.7464 7.51011 18.7492C7.13904 18.752 6.77548 18.6446 6.46548 18.4406C6.15548 18.2367 5.91297
                            17.9453 5.76866 17.6034C5.62434 17.2616 5.58472 16.8846 5.65479 16.5202C5.72487 16.1558 5.9015 15.8203 6.16232 15.5564C6.42314 15.2924 6.75642 15.1118
                            7.11996 15.0374C7.4835 14.9629 7.86095 14.998 8.20452 15.1382C8.54809 15.2785 8.84233 15.5175 9.04999 15.825C9.18914 16.0281 9.28663 16.2568 9.33683
                            16.4979C9.38703 16.7389 9.38893 16.9875 9.34243 17.2293C9.29594 17.4711 9.20196 17.7013 9.06594 17.9065C8.92992 18.1117 8.75455 18.288 8.54999
                            18.425V18.425ZM10.375 11.5625C10.1971 11.8919 9.92476 12.1605 9.59292 12.3338C9.26108 12.507 8.88497 12.577 8.51303 12.5347C8.14109 12.4923
                            7.79033 12.3396 7.50593 12.0962C7.22153 11.8528 7.0165 11.5298 6.91724 11.1689C6.81798 10.8079 6.82903 10.4255 6.94898 10.0709C7.06892 9.71629 7.29227
                            9.4057 7.59026 9.17913C7.88825 8.95255 8.24724 8.82036 8.62101 8.79958C8.99478 8.77879 9.36621 8.87036 9.68749 9.0625C10.102 9.31042 10.4049 9.70877
                            10.533 10.1745C10.6611 10.6403 10.6045 11.1375 10.375 11.5625V11.5625ZM13.75 8.75C13.3792 8.75 13.0166 8.64003 12.7083 8.43401C12.4 8.22798 12.1596
                            7.93514 12.0177 7.59253C11.8758 7.24992 11.8387 6.87292 11.911 6.50921C11.9834 6.14549 12.1619 5.8114 12.4242 5.54917C12.6864 5.28695 13.0205 5.10837
                            13.3842 5.03603C13.7479 4.96368 14.1249 5.00081 14.4675 5.14273C14.8101 5.28464 15.103 5.52496 15.309 5.83331C15.515 6.14165 15.625 6.50416 15.625
                            6.875C15.625 7.37228 15.4274 7.84919 15.0758 8.20083C14.7242 8.55246 14.2473 8.75 13.75 8.75V8.75ZM20.9375 9.75C20.6162 9.94214 20.2448 10.0337
                            19.871 10.0129C19.4972 9.99214 19.1383 9.85995 18.8403 9.63337C18.5423 9.4068 18.3189 9.09621 18.199 8.7416C18.079 8.38699 18.068 8.0046 18.1672
                            7.64365C18.2665 7.2827 18.4715 6.95973 18.7559 6.71632C19.0403 6.4729 19.3911 6.32019 19.763 6.27785C20.135 6.23551 20.5111 6.30547 20.8429
                            6.47872C21.1748 6.65198 21.4471 6.9206 21.625 7.25C21.8545 7.67504 21.9111 8.17224 21.783 8.63799C21.6549 9.10373 21.352 9.50208 20.9375
                            9.75V9.75Z" fill="#401B37"/>
                        </svg>                
                    </div>
                    <div class="note-footer-button note-footer-pin" v-if="footerState === 'open'" :class="{pinned: pinned}" @click="switchPinnedState" :class="{visible: pinnedButtonVisibility}">
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
                    <div class="note-footer-button note-footer-delete" v-if="footerState === 'open'" :class="{visible: deleteButtonVisibility}">
                        <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg" @click="reset">
                            <path d="M25 25L5 5M25 5L5 25" stroke="#401B37" stroke-width="2.5" stroke-linecap="round"/>
                        </svg>                    
                    </div>
                </div>
            </div>
        `,
        props: ['titre', 'texte', 'date-creation', 'date-modification', 'couleur-fond', 'couleur-texte', 'etat'],
        data() {
            return {
                footerState: 'close',
                backgroundColorButtonVisibility: false,
                backgroundColorButtonVisibilityTimeout: null,
                textColorButtonVisibility: false,
                textColorButtonVisibilityTimeout: null,
                pinnedButtonVisibility: false,
                pinnedButtonVisibilityTimeout: null,
                deleteButtonVisibility: false,
                deleteButtonVisibilityTimeout: null,
                pinned: false
            }
        },
        methods: {
            switchFooterState() {
                if(this.footerState == 'close') {
                    this.footerState = 'open';
                    this.backgroundColorButtonVisibilityTimeout = setTimeout(() => {
                        this.backgroundColorButtonVisibility = true;
                    }, 100);
                    this.textColorButtonVisibilityTimeout = setTimeout(() => {
                        this.textColorButtonVisibility = true;
                    }, 400);
                    this.pinnedButtonVisibilityTimeout = setTimeout(() => {
                        this.pinnedButtonVisibility = true;
                    }, 700);
                    this.deleteButtonVisibilityTimeout = setTimeout(() => {
                        this.deleteButtonVisibility = true;
                    }, 1000);
                } else {
                    this.footerState = 'close';
                    this.backgroundColorButtonVisibility = false;
                    this.textColorButtonVisibility = false;
                    this.pinnedButtonVisibility = false;
                    this.deleteButtonVisibility = false;
                    clearTimeout(this.backgroundColorButtonVisibilityTimeout);
                    clearTimeout(this.textColorButtonVisibilityTimeout);
                    clearTimeout(this.pinnedButtonVisibilityTimeout);
                    clearTimeout(this.deleteButtonVisibilityTimeout);
                }
            },
            switchPinnedState() {
                this.pinned = !this.pinned;
            }
        },
        mounted() {
            console.log(this.titre + " " + this.texte + " " + this.dateCreation + " " + this.couleurFond + " " + this.couleurTexte + " " + this.etat);
            if(this.etat === 'EPINGLE') {
                this.pinned = true;
            }
        }
    });

    vue.mount('html');
}