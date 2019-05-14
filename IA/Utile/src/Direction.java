import java.util.ArrayList;

/**
 * This enumeration lists all the directions possible for a moving entity based on the cardinal points and their inter-cardinal points
 */
public enum Direction {
    N(-1, 0), NW(-1, 1), W(0, 1), SW(0, 0), S(1, 0), SE(1, -1), E(0, -1), NE(-1, -1);

    private int line, column;

    Direction(int line, int column){
        this.line = line;
        this.column = column;
    }

    /**
     * Returns a number indicating how to move on an y axis
     * @return A number indicating how to move on an y axis
     */
    public int getLine() { return line; }

    /**
     * Returns a number indicating how to move on an x axis
     * @return A number indicating how to move on an x axis
     */
    public int getColumn() { return column; }

    /**
     * Permet à partir des coordonnées de retrouver la Direction emprunter
     * @param ligne
     * @param colonne
     * @return
     */
    public static Direction getDirectionAPartirDeCoordonne(int ligne,int colonne){
        Direction[] directions = Direction.values(); //On récupère toutes les directions
        for (Direction direction:directions ) {
            if(direction.getLine() == ligne && direction.getColumn() == colonne){//Si c'est les mêmes coordonnées que celle en paramètre on la retourne
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
        liste.add(W);
        return liste;
    }
}
