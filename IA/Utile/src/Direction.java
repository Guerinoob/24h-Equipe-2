/**
 * Cette énumération liste toutes les directions possibles pour une entité déplaçable, basées sur les points cardinaux et leurs points sous-cardinaux
 */
public enum Direction {
    N(-1, 0), NW(-1, -1), W(0, -1), SW(1, -1), S(1, 0), SE(1, 1), E(0, 1), NE(-1, 1);

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
}
