package JeuCafe;

/**
 * 
 */
public class Graine {

    /**
     * Default constructor
     */
    private Couleur couleur;
    public Graine(Couleur couleur) {
        this.couleur = couleur;
    }

    public Graine(Graine graine) {
        this.couleur = graine.getCouleur();
    }

    public Couleur getCouleur() {
        return couleur;
    }
}