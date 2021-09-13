<template>
  <footer>
        <div class="footer-options buttons">
            <button v-for="item in this.options" class="minPriority">{{item}}</button>
        </div>
        <div class="footer-options logos">
            <img class="social" src="/storage/assets/images/logos/Yt_logo.svg" alt="footer_logo">
            <img class="social" src="/storage/assets/images/logos/Tw_logo.svg" alt="footer_logo">
            <img class="logo" src="/storage/assets/images/logos/FooterLogo.svg" alt="footer_logo">
            <img class="social" src="/storage/assets/images/logos/Ig_logo.svg" alt="footer_logo">
            <img class="social" src="/storage/assets/images/logos/Fb_logo.svg" alt="footer_logo">
        </div>
        <h5>Tutti© 2021</h5>
  </footer>
</template>

<script>
export default {
    name: "tutti-footer",
    data(){
        return{
            options: [
                'User Agreement',
                'Cookie Policy',
                'Privacy Policy',
                'Copyright Policy',
                'FAQS',
                'Forum',
                'Support'
            ]
        }
    }
}
</script>

<style scoped>
footer{
    margin-top: var(--margin-big);
    width: 100%;
    height: 316px;
    padding: var(--margin-medium);

    bottom: 0;

    background: var(--tutti-grey-2);

    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-direction: column;
}

.footer-options{
    display: flex;
    justify-content: space-evenly;
    align-items: center;
}

.footer-options.buttons{
    width: 60%;
}

.footer-options.logos{
    width: 50%;
}

.social{
    width: var(--icon-large);
    height: var(--icon-large);
}

.logo{
    width: var(--icon-massive);
    height: var(--icon-massive);
}
</style>
