import java.util.ArrayList;

/**
 * Cette énumération liste toutes les directions possibles pour une entité se déplaçant, basées sur les points cardinaux et leurs points sous-cardinaux
 */
public enum Direction {
    N(-1, 0), NO(-1, -1), O(0, -1), SO(1, -1), S(1, 0), SE(1, 1), E(0, 1), NE(-1, 1);

    private int ligne, colonne;

    Direction(int ligne, int colonne){
        this.ligne = ligne;
        this.colonne = colonne;
    }

    /**
     * Retourne un nombre indiquant le déplacement sur un axe x
     * @return Un nombre indiquant le déplacement sur un axe x
     */
    public int getLigne() { return ligne; }

    /**
     * Retourne un nombre indiquant le déplacement sur un axe y
     * @return Un nombre indiquant le déplacement sur un axe x
     */
    public int getColonne() { return colonne; }
    /**
     * Permet à partir des coordonnées de retrouver la Direction emprunter
     * @param ligne
     * @param colonne
     * @return
     */
    public static Direction getDirectionAPartirDeCoordonne(int ligne,int colonne){
        Direction[] directions = Direction.values(); //On récupère toutes les directions
        for (Direction direction:directions ) {
            if(direction.getLigne() == ligne && direction.getColonne() == colonne){//Si c'est les mêmes coordonnées que celle en paramètre on la retourne
                return direction;
            }
        }
        return null;
    }

    /**
     * Permet d'obtenir les quatres points cardinaux (N E S O )
     * @return Les quatres points cardinaux
     */
    public static ArrayList<Direction> getQuatrePointsCardinaux(){
        ArrayList<Direction> liste = new ArrayList<>();
        liste.add(N);
        liste.add(E);
        liste.add(S);
        liste.add(O);
        return liste;
    }
}
