import java.util.ArrayList;
import java.util.Comparator;
import java.util.LinkedList;
import java.util.PriorityQueue;

public class AEtoile {
    private Noeud depart;
    private Noeud arrive;
    private Plateau plateau;
    public AEtoile(Noeud depart,Noeud arrive,Plateau plateau){
        this.depart = depart;
        this.arrive = arrive;
        this.plateau = plateau;
    }
    public void resoudre(){
        PriorityQueue<Noeud> listeOuverte = new PriorityQueue<>(comparateurHeuristique);
        LinkedList<Noeud> listeFerme = new LinkedList<>();
        listeOuverte.add(depart);
        Noeud choisi = null;
        while(!listeOuverte.isEmpty()){
            choisi = listeOuverte.poll();
            if(choisi.estEgal(arrive)){
                return;
            }
            choisi.genererEnfants(plateau);
            ArrayList<Noeud> pretendants = choisi.getEnfants();
            for (Noeud selectionne:pretendants) {
                if(!selectionne.estPresent(listeFerme)){
                    selectionne.calculHeuristique();
                    listeOuverte.add(selectionne);
                }
            }
            listeFerme.add(choisi);
        }
    }
    





    private static Comparator<Noeud> comparateurHeuristique = new Comparator<Noeud>() {
        @Override
        public int compare(Noeud n1, Noeud n2) {
            return n1.getHeuristique() - n2.getHeuristique();
        }
    };
}
