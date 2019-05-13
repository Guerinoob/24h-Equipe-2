import java.util.ArrayList;
import java.util.LinkedList;

public class Noeud {
    private int colonne;
    private int ligne;
    private boolean estTraversable;

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

    private Noeud parent;
    private int cout;
    private int heuristique;
    private ArrayList<Noeud> enfants;


    public boolean estEgal(Noeud autre){
        return autre.getColonne() == this.getColonne() && autre.getLigne() == this.getLigne();
    }
    public ArrayList<Noeud> getEnfants() {
        return enfants;
    }
    public boolean estPresent(LinkedList<Noeud> liste){
        for (Noeud n:liste) {
            if(n.estEgal(this)){
                return true;
            }
        }
        return false;
    }
    public void calculHeuristique(){

    }
    public void genererEnfants(Plateau plateau){
        
        return;
    }
    public boolean isEstTraversable() {
        return estTraversable;
    }

    public void setEstTraversable(boolean estTraversable) {
        this.estTraversable = estTraversable;
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
