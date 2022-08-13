window.onload = function() {
    const vue = Vue.createApp({
        data() {
            return {
                mode: '',
                nom: '',
                prenom: '',
                email: '',
                password: '',
                passwordConfirm: ''
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
                    document.querySelector("#style-mode2").href = "css/style-connexion-inscription-light.css";
                } else {
                    document.querySelector("#style-mode").href = "css/style-header-dark.css";
                    document.querySelector("#style-mode2").href = "css/style-connexion-inscription-dark.css";
                }
            },
            verificationAdresseMail() {
                return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(this.email);
            },
            submitInscription(event) {
                if(this.nom.length < 25 && this.prenom.length < 25 && this.email.length < 25 && this.password.length < 25 && this.passwordConfirm.length < 25) {
                    //vérification que les mots de passe soient identiques
                    if(this.password.value === this.passwordConfirm.value) {
                        //vérification que l'email soit valide
                        if(this.verificationAdresseMail()) {
                            //vérification que le mot de passe soit assez long
                            if(this.password.length > 7) {
                                event.target.submit();
                            }
                        }
                    }
                }
            }
        },
        mounted() {
            const queryString = window.location.search;
            const urlParams = new URLSearchParams(queryString);

            if(urlParams.has('nom')) {
                this.nom = urlParams.get('nom');
            }
            if(urlParams.has('prenom')) {
                this.prenom = urlParams.get('prenom');
            }
            if(urlParams.has('mail')) {
                this.email = urlParams.get('mail');
            }

            //on met à jour le cookie
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

    vue.mount('html');
}