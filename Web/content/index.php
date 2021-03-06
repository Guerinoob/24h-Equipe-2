<?php
include_once('../includes/utils_page.php');
get_header();


if(isset($_POST['logout'])){
    disconnect_current_user();
}

    ?>

   <!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>LMF - Connexion</title>
            <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
            <link rel="stylesheet" href="bulma.css">
            <link rel="stylesheet" href="login.css">
            <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.4/css/bulma.min.css"> -->
            <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
        </head>
        <body>



    <section class="section">
        <div class="container">
            <h1 class="title has-text-centered">Qui sommes-nous ?</h1>
            <p class="has-text-justified">
                <b>Coffee Shipping</b> est un site permettant de mettre en relation nos clients avec exportateurs de café du monde entier, afin de gérer toutes les importations et les transactions de cafés, d'origine diverses et variées.
                Par le biais de notre site, vous serez en mesure de visualiser les différents pays producteurs de café, passer des commandes, ainsi que visualiser l'état des commandes passées.
                <br><br>
                Coffee Shipping assure des transactions et des communications fiables et sécurisées, afin d'assurer à nos clients un confort optimal lorsqu'ils sont à la recherche de leur café.<br><br>
            </p>
        </div>
    </section>

    <div class="container notification">
        <h1 class="title has-text-centered">Nos types de café</h1>
        <div class="columns">
            <div class="column is-half">
                <h2 class="has-text-left subtitle"> Le Robusca</h2>
                <p class="has-text-justified">
                    <b>Le café Robusta </b> représente 35% de la production mondiale de café. C'est un café qui, comme son nom l'indique, est très robuste.<br>
                    Il pousse à des hauteurs moins élevées que l'Arabica (généralement en plaine). Il possède un rendement par caféier bien plus élevé !
                    <br><br>
                    La saveur du Robusta est relevé, plus amère et plus corsée que celle du café Arabica. Sa teneur en caféine en est plus importante (de 2% à 2,5%).
                    Ce café est principalement cultivé en Afrique de l'Ouest et en Asie du Sud-Est.
                </p>
            </div>
            <div class="column">
                <h2 class="has-text-right subtitle"> L'Arabica</h2>
                <p class="has-text-justified">
                    <b>L’Arabica</b> est l’espèce de caféier le plus répandu au monde, représentant pas moins de 65% de la production mondiale de café.
                    Il tient son nom de la péninsule arabique car c’est au Yemen que le café Arabica a été consommé et dégusté pour la première fois en tant que boisson.
                    Le Brésil, la Colombie, le Mexique, l’Ethiopie et le Guatemala sont les 5 plus grands pays producteurs de café Arabica, générelemnt cultivé en altitude sur les hauts plateaux.
                    <br> <br>
                    A contrario d’un café Robusta, un café Arabica vous offrira une tasse nettement plus aromatique et fine en bouche !
                </p>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="container">
            <h1 class="title has-text-centered">Les plus gros producteurs</h1>
            <p class="has-text-justified">
                Avec plus de 99% de clients satisfaits, ainsi que le plus grand nombre d'exportateur en collaboration dans le monde entier, soit 30.000 repartis sur tous les continents, Coffee Shipping s'installe comme la plus grande plateforme de transaction de café mondiale.<br>
                Tous nos exportateurs possèdent une guarantie sur chacune de leurs transactions, afin que la confiance soit de mise entre tous et de satisfaire des transactions de qualité pour tous.
                Ici, vous trouverez des exportateurs pouvant satisfaire les goûts de tous et toutes.
            </p>
            <a href="voir_top_producteurs.php">
            <button class="button is-block is-info is-fullwidth has-text-weight-medium" onclick="voir_top_producteurs.php">Voir Les plus gros producteurs</button>
            </a>
        </div>
    </section>
</body>
</html>
    <?php




get_footer();