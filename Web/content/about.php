<?php
include('../includes/utils_page.php');
get_header();
?>

<h1 class="title has-text-centered">À propos</h1>

<h2 class="subtitle has-text-centered">Justification de nos choix</h2>

<div class="container has-text-justified">
    <p>Pour cette épreuve, nous avons choisi de coder le back-end en PHP pur.
        Nous avons fait ce choix car tout le monde n'est pas forcément à l'aise avec les mêmes framework (voire avec aucun), et car nous estimions qu'un projet de cette envergure ne nécessitait pas d'utiliser un framework possiblement lourd</p>

    <p>Côté front-end, nous avons choisi d'utiliser jQuery pour le Javascript, ce qui nous a permis d'utiliser un peu d'AJAX facilement.</p>
    <p> Nous avons opté pour une approche sobre mais efficace, produisant un site facile d'utilisation et compréhensible pour tous. Les couleurs, chaudes, collent bien au sujet du site, la vente de café. <br>
    La page d'accueil permet une description du projet, et un moyen d'accès aux différentes parties du site. certaines partie du site ne sont accessibles que lors de la connexion, en fonction du type d'utilisateur.<br>
    Pour l'ensemble du site, nous avons utilisé le framework Bulma, qui nous a aidé à faire une génération rapide de l'ensemble des pages et de leur stylisation </p>
</div>
<?php
get_footer();