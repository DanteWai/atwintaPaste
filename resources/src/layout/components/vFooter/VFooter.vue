<template>
    <footer class="footer">
        <div class="container">
            <div class="footer__content">
                <div class="footer__left">
                    <div class=""></div>
                    <footer-link class="footer__links" :links="links"/>
                    <div class="footer-copyright">
                        <p>By using Awesome-pstb.com you agree to our cookies policy to enhance your experience. </p>
                        <p>Site design & logo © 2021 Awesome-pstb.com</p>
                    </div>
                </div>

                <div class="footer__right">
                </div>
            </div>
        </div>
    </footer>
</template>

<script setup>

import FooterLink from "./FooterLink";
import {useUser} from "../../../composables/useUser";


const links = []
</script>

