public class Plateau {
    private Case[][] plateau;

    public Plateau(Case[][] plateau) {
        this.plateau = plateau;
    }

    /**
     * Génère un Plateau d'exemple
     */
    public Plateau(){
        String[][] exemple = new String[][]{
                {" ","  "," ","X"},
                {" "," X"," "," "},
                {" ","  ","X","X"},
                {"X"," "," "," "},
        };
        plateau = new Case[exemple.length][exemple.length];
        for (int i = 0; i < exemple.length ; i++) {
            for (int j = 0; j < exemple[i].length ; j++) {
                plateau[i][j] = new Case(j,i,exemple[i][j]);
                System.out.print(exemple[i][j]);
            }
            System.out.println();
        }
    }

    /**
     * Retourne la case situé dans la colonne et la ligne donné en paramètres en vérifiant que ce sont des coordonnées compatibles
     * @param colonne
     * @param ligne
     * @return
     */
    public Case getCase(int colonne,int ligne){
        if(colonne < 0 || colonne > plateau.length-1 || ligne < 0 || ligne > plateau[colonne].length-1){
            return null;
        }
        return plateau[ligne][colonne];
    }
    public Case[][] getPlateau() {
        return plateau;
    }

    public void setPlateau(Case[][] plateau) {
        this.plateau = plateau;
    }
}
