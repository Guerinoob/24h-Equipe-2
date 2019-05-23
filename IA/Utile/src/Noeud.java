import java.util.ArrayList;
import java.util.LinkedList;

public class Noeud {
    private int colonne;
    private int ligne;
    private Noeud parent = null;
    private int cout = 0;
    private int heuristique;
    private int somme;

    public int getSomme() {
        return somme;
    }

    public void setSomme(int somme) {
        this.somme = somme;
    }

    private ArrayList<Noeud> enfants;

    public Noeud(int colonne, int ligne) {
        this.colonne = colonne;
        this.ligne = ligne;
    }


    /**
     * Compare deux Noeuds en se basant sur leurs coordonnees
     * @param autre
     * @return vrai si les Noeuds sont égaux
     */
    public boolean estEgal(Noeud autre) {
        return autre.getColonne() == this.getColonne() && autre.getLigne() == this.getLigne();
    }



    public boolean estPresent(LinkedList<Noeud> liste) {
        for (Noeud n : liste) {
            if (n.estEgal(this) && n.getSomme() >= this.getSomme()) {
                return true;
            }
        }
        return false;
    }

    /**
     * Calcul l'heuristique d'un Noeud en se basant sur la distance de Manhattan
     * @param objectif
     */
    public void calculHeuristique(Noeud objectif) {
        heuristique = Math.abs(colonne - objectif.getColonne()) + Math.abs(ligne - objectif.getLigne());
        somme = heuristique +cout;
    }

    @Override
    public String toString() {
        return "Noeud{" +
                "colonne=" + colonne +
                ", ligne=" + ligne +
                ", heuristique=" + heuristique +
                '}';
    }

    /**
     * Génère tous les enfants d'un Noeud c'est à dire tous les endroits ou on peut aller à partir de ce Noeud
     * @param plateau
     */
    public void genererEnfants(Plateau plateau) {
        ArrayList<Direction> listePointsCardinaux = Direction.getQuatrePointsCardinaux();
        enfants = new ArrayList<>();
        for (Direction direction : listePointsCardinaux) {
            int nouvelleLigne = ligne + direction.getLigne();
            int nouvelleColonne = colonne + direction.getColonne();
            Case cas = plateau.getCase(nouvelleColonne, nouvelleLigne);
            if (cas != null  &&  !cas.estUnMur() ) {
                //Si la case existe réellement  et que c'est pas un mur
                Noeud enfant = new Noeud(nouvelleColonne, nouvelleLigne);
                enfant.setParent(this); //On crée le lien avec son père
                enfant.setCout(this.getCout()+1);
                enfants.add(enfant);
            }
        }
    }

    /**
     *  Calcule le chemin pour aller de son Adam à lui
     * @return La liste des Directions à effectuer pour aller du Noeud actuel à son plus lointain ancêtre
     */
    public LinkedList<Direction> retournerLeChemin(){
        Noeud suivant = this;
        LinkedList<Direction> chemin = new LinkedList<>();
        while ( suivant.getParent()  != null){
            chemin.addFirst(Direction.getDirectionAPartirDeCoordonne(suivant.getLigne()-suivant.getParent().getLigne(),suivant.getColonne()-suivant.getParent().getColonne()));
            suivant = suivant.getParent();
        }
        return chemin;
    }
    public int getProfondeur(){
        Noeud suivant = this;
        int cpt =0;
        while ( suivant.getParent()  != null){
            cpt++;
            suivant = suivant.getParent();
        }
        return cpt;
    }
    public ArrayList<Noeud> getEnfants() {
        return enfants;
    }
    public int getColonne() {
        return colonne;
    }

    public void setColonne(int colonne) {
        this.colonne = colonne;
    }

    public int getLigne() {
        return ligne;
    }

    public void setLigne(int ligne) {
        this.ligne = ligne;
    }

    public void setEnfants(ArrayList<Noeud> enfants) {
        this.enfants = enfants;
    }

    public Noeud getParent() {
        return parent;
    }

    public void setParent(Noeud parent) {
        this.parent = parent;
    }

    public int getCout() {
        return cout;
    }

    public void setCout(int cout) {
        this.cout = cout;
    }

    public int getHeuristique() {
        return heuristique;
    }

    public void setHeuristique(int heuristique) {
        this.heuristique = heuristique;
    }


}
