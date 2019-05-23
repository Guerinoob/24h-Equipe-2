import java.util.ArrayList;
import java.util.Comparator;
import java.util.LinkedList;
import java.util.PriorityQueue;

public class AEtoile {
    private Noeud depart;
    private Noeud arrive;
    private Plateau plateau;

    /**
     * Constructeur de la classe Aetoile
     * @param depart
     * @param arrive
     * @param plateau
     */
    public AEtoile(Noeud depart, Noeud arrive, Plateau plateau) {
        this.depart = depart;
        this.arrive = arrive;
        this.plateau = plateau;
    }

    /**
     * Permet de résoudre AEtoile
     * @return Le Noeud qui contient le chemin le plus court pour aller du Noeud départ au Noeud d'arrivé
      */
    public Noeud resoudre() {
        PriorityQueue<Noeud> listeOuverte = new PriorityQueue<>(comparateurHeuristique);//Contient les Noeuds pour aller vers l'arrivé par priorité
        LinkedList<Noeud> listeFerme = new LinkedList<>(); //Contient tous les noeuds par lesquels on est déjà passé
        listeOuverte.add(depart); //On ajoute le Noeud de départ
        Noeud choisi = null; //Le Noeud qu'on va tester
        while (!listeOuverte.isEmpty()) { //Tant qu'on peut tester
            choisi = listeOuverte.poll(); //On récupère le plus prometteur
            if (choisi.estEgal(arrive)) { //Si c'est le noeud d'arrivé on a gagné
                return choisi;
            }
            choisi.genererEnfants(plateau); //On génère tous les enfants
            ArrayList<Noeud> pretendants = choisi.getEnfants(); //On récupère les enfants
            for (Noeud selectionne : pretendants) {
                if (!selectionne.estPresent(listeFerme)) {//Si on est pas déja passé par lui on l'ajoute
                    selectionne.calculHeuristique(arrive);

                    listeOuverte.add(selectionne);
                }
            }
            listeFerme.add(choisi);
        }
        return null;
    }

    /**
     * Compare deux Noeuds entre eux ce qui permet de générer une PriorityQueue
     */
    private static Comparator<Noeud> comparateurHeuristique = new Comparator<Noeud>() {
        @Override
        public int compare(Noeud n1, Noeud n2) {
            return n1.getSomme() - n2.getSomme();
        }
    };
}
