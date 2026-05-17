<?php
echo '
<style>
@charset "utf-8";
/* CSS Document */
.banner-image {vertical-align: middle;min-height: 100%;width: 100%;    height: 830px;background-image: url('.IMAGEACCUEIL.');}    
@media (max-width: 823px) {
    .banner-image {background-image: url('.IMAGEACCUEILSMALL.'); } }   
@media (max-width:768px) {.banner-image {height:750px}}
@media (max-width: 360px) {.banner-image {height:850px}}</style>';
