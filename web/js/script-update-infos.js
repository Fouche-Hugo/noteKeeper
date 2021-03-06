window.onload = function() {
    const vue = Vue.createApp({
        data() {
            return {
                mode: 'light',
                nom: '',
                prenom: '',
                email: ''
            }
        },
        methods: {
            toggleMode() {
                this.mode = this.mode === 'light' ? 'dark' : 'light';
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
            }
        },
        mounted() {
            this.nom = document.querySelector("#nom").getAttribute("data-value");
            this.prenom = document.querySelector("#prenom").getAttribute("data-value");
            this.email = document.querySelector("#mail").getAttribute("data-value");
        }
    })

    vue.mount('html');
}