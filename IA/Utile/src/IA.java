import java.util.*;

public class IA {
    private ArrayList<Case> joueurs = new ArrayList<>();
    private Plateau plateau;

    public IA(ArrayList<Case> joueurs, Plateau plateau) {
        this.joueurs = joueurs;
        this.plateau = plateau;
    }

    /**
     * Retourne pour chque Piece la distance vis à vis du Joueur
     * @param positionJoueur
     * @return
     */
    public HashMap<Case, Integer> getDistancePourChaquePiece(Case positionJoueur) {
        HashMap<Case, Integer> distances = new HashMap<>();//Contient pour chaque pièce la distance qu'il faut parcourir
        ArrayList<Case> pieces = plateau.getListePieces();
        for (Case piece : pieces) {
            Noeud depart = new Noeud(positionJoueur.getColonne(), positionJoueur.getLigne());
            Noeud arrive = new Noeud(piece.getColonne(), piece.getLigne());
            AEtoile aEtoile = new AEtoile(depart, arrive, plateau);
            Noeud solution = aEtoile.resoudre();//On calcul la distance grâce a AEtoile
            distances.put(piece, solution.getProfondeur());

        }
        return distances;
    }
    //Début d'une tentative d'IA
    public void test() {
        ArrayList<HashMap<Case, Integer>> listeMaps = new ArrayList<>();//Pour chaque Joueurs on voit leurs écarts vis à vis des pièces
        for (Case joueur : joueurs) {
            listeMaps.add(getDistancePourChaquePiece(joueur));
        }
        ArrayList<Ecart> ecarts = new ArrayList<>();//Permet pour un Joueuer de savoir la somme des écarts relatifs vis à vis des autres Joueurs pour savoir qu'elle pièce est la plus proche
        int i = 0;
        for (HashMap<Case, Integer> choisi : listeMaps //Pour chaque Map
        ) {

            int index = 0;
            for (Map.Entry<Case, Integer> entry : choisi.entrySet()) {//On récupère chaque pièce avec sa distance

                Case key = entry.getKey();
                Integer value = entry.getValue();

                int somme = 0;
                for (int j = 0; j < listeMaps.size() ; j++) {//On cherche la distance des autres pour cette pièces et on somme leurs écarts
                    somme += (value - listeMaps.get(j).get(key));
                }
                ecarts.add(new Ecart(joueurs.get(i),key,somme));//On a donc pour cahque Joueur et chaque case la somme des écarts realtifs

                index++;
            }
            i++;
        }
        for (Ecart e :ecarts) {
            System.out.println(e);
        }

    }


}
