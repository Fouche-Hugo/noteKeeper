window.onload = function() {
    const vue = Vue.createApp({
        data() {
            return {
                mode: 'light'
            }
        },
        methods: {
            toggleMode() {
                this.mode = this.mode === 'light' ? 'dark' : 'light';
                if(this.mode === 'light') {
                    document.querySelector("#style-mode").href = "css/style-light.css";
                } else {
                    document.querySelector("#style-mode").href = "css/style-dark.css";
                }
            }
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