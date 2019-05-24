
<nav class="navbar has-background-grey-dark" role="navigation" aria-label="main navigation">

    <div id="navbarBasicExample" class="navbar-menu is-active">

        <div class="navbar-item has-dropdown is-hoverable">


            <a class="navbar-item">
                <svg class="ham hamRotate ham1 navbar-item" viewBox="0 0 100 100" width="80" onmouseout="this.classList.toggle('active')" onMouseOver="this.classList.toggle('active')">
                    <path class="line top" d="m 30,33 h 40 c 0,0 9.044436,-0.654587 9.044436,-8.508902 0,-7.854315 -8.024349,-11.958003 -14.89975,-10.85914 -6.875401,1.098863 -13.637059,4.171617 -13.637059,16.368042 v 40" />
                    <path class="line middle" d="m 30,50 h 40" />
                    <path class="line bottom" d="m 30,67 h 40 c 12.796276,0 15.357889,-11.717785 15.357889,-26.851538 0,-15.133752 -4.786586,-27.274118 -16.667516,-27.274118 -11.88093,0 -18.499247,6.994427 -18.435284,17.125656 l 0.252538,40" />
                </svg>
            </a>

            <div class="navbar-dropdown has-background-light">

                <a href="index.php" class="navbar-item">
                    Accueil
                </a>
                <a href="carte.php" class="navbar-item">
                    Voir les pays producteurs
                </a>
                <a href="commande.php" class="navbar-item">
                    Passer une commande
                </a>
                <a href="voir_commandes_exportateur.php" class="navbar-item">
                    Voir les commandes
                </a>

                <a href="ajoutPays.php" class="navbar-item">
                    Ajouter un pays
                </a>
                <hr class="navbar-divider">
                <a href="about.php" class="navbar-item">
                    A propos
                </a>
            </div>
        </div>





        <div class="navbar-end">

            <div class="buttons">
            <div class="navbar-item has-dropdown is-hoverable">
                        <a class="button is-warning is-outlined navbar-item">
                            <strong>S'inscrire</strong>
                        </a>
                <div class="navbar-dropdown has-background-lighter">
                            <a href="signup_exportateur.php" class="navbar-item">
                                Exportateur
                            </a>
                    <hr class="navbar-divider">
                            <a href="signup_importateur.php" class="navbar-item">
                                Importateur
                            </a>
                </div>
            </div>

            <div class="navbar-item">
                    <a class="button is-dark">
                        Se connecter
                    </a>
            </div>
            </div>
        </div>
    </div>

</nav>