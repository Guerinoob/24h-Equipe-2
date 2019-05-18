<?php

/**
 * Cette classe permet d'intéragir avec une base de données. Une instance est automatiquement créée et est accessible via la variable globale <b>$db</b>
 * Les paramètres de connexion sont définis dans le fichier settings.php.
 */
class Database
{

    /**
     * @var false|mysqli Instance de mysqli, utilisée pour interagir avec la base de données.
     * Cet attribut vaut faux si une erreur s'est produite lors de la connexion, ou que la connexion en cours rencontre un problème.
     */
    public $mysqli;

    private $db_user;

    private $db_password;

    private $db_host;

    private $db_name;

    /**
     * @var array Tableau associatif contenant des informations sur la dernière requête SELECT exécutée
     *      'query' => requête SQL
     *      'results' => résultat de la requête <b>query</b> (tableau à deux dimensions (chaque ligne du tableau est un tableau associatif)
     */
    public $query = array();


    /**
     * Constructeur de la classe Database
     * @param string $db_user Utilisateur de la base
     * @param string $db_password Mot de passe de l'utilisateur
     * @param string $db_host Nom d'hôte de la base
     * @param string $db_name Nom de la base de données
     */
    public function __construct($db_user, $db_password, $db_host, $db_name)
    {
        $this->db_user = $db_user;
        $this->db_password = $db_password;
        $this->db_host = $db_host;
        $this->db_name = $db_name;


        $this->mysqli = mysqli_connect($db_host, $db_user, $db_password, $db_name);

    }

    /**
     * Exécute une requête
     * Les requêtes pouvant être exécutées sont, entre autres, CREATE, ALTER, TRUNCATE, DROP, INSERT, UPDATE, DELETE, REPLACE et, bien sûr, SELECT
     * @param string $query La requête à exécuter
     * @return bool|int Faux en cas d'erreur, Vrai pour toutes les requêtes sauf SELECT. Un entier pour SELECT correspondant au nombre de lignes sélectionnées
     * Dans le cas d'un SELECT, le résultat est accessible via l'attribut query
     */
    public function query($query){
        if(!$this->mysqli){
            return false;
        }

        if(preg_match('/^\s*select\s/i', $query)){
            $results = mysqli_query($this->mysqli, $query);

            if(!$results) return false;

            $i = $results->num_rows;

            $this->query = array(
                'query' => $query,
                'results' => $results->fetch_all(MYSQLI_ASSOC)
            );

            return $i;
        }
        else{
            $result = mysqli_query($this->mysqli, $query);

            return $result;
        }

    }


    /**
     * Exécute une requête SELECT et retourne les résultats sous forme de tableau à deux dimensions (chaque ligne du tableau est un tableau associatif)
     * @param string $query Requête à exécuter
     * @return bool|mixed Faux si la requête n'est pas un SELECT ou s'il y a une erreur, un tableau à deux dimensions (chaque ligne du tableau est un tableau associatif) en cas de succès
     */
    public function query_get_rows($query){
        if(!preg_match('/^\s*select\s/i', $query)){
            return false;
        }

        $this->query($query);

        return $this->query['results'];
    }

    /**
     * Exécute une requête SELECT et retourne une ligne de résultat. Si la requête retourne plusieurs résultats, seule la première ligne sera retournée. Il est donc préférable d'utiliser cette fonction quand on est certain que la requête retourne une ligne.
     * @param string $query Requête à exécuter
     * @return bool|int|mixed Faux si la requête n'est pas un SELECT ou s'il y a une erreur, 0 si la requête retourne 0 résultat, un tableau associatif si la requête retourne des résultats
     */
    public function get_row($query){
        $result_query = $this->query_get_rows($query);

        if($result_query){
            if(count($result_query) > 0)
                return $result_query[0];

            return 0;
        }

        return false;
    }

}

global $db;
$db = new Database(DB_USER, DB_PASSWORD, DB_HOST, DB_NAME);