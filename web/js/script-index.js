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
        }
    })

    vue.mount('html');
}