import java.util.ArrayList;
import java.util.LinkedList;

public class Noeud {
    ArrayList<Noeud> enfants  = new ArrayList<>();
    Noeud pere;
    Couleur couleur;
    boolean gagnant ;
    int colonne;
    int ligne;



    public void genererFils(){
        /*try {
            if(gagnant)
                return;
            Board base = new Board(plateau);
            for (String s:base.getAllMoves()) {

                Board fil = new Board(base);
                Noeud n;
                boolean gag = false;
                fil.playMove(s);
                if(fil.getWinner() != null){
                    gag = true;

                }
                if(joueur == 2){
                    n = new Noeud(fil,this,1,gag);
                }else{
                    n = new Noeud(fil,this,2,gag);
                }
                n.joue = s;
                enfants.add(n);
            }

        }catch (Exception e){
            Noeud n = new Noeud(new Board(plateau),this,1,true);
            n.joue = "RIEN";
            enfants.add(n);
        }
        */
    }
    public LinkedList<String> listOfMove(){
        /*LinkedList<String> move = new LinkedList<>();
        if(pere != null && pere.pere != null ) {
            move.addAll(pere.listOfMove()); //LJ: Hmm... Vous remontez récursivement l'arbre pour construire la liste des coups en redescendant... ok !
        }
        System.out.println("Le joueur "+ joueur + " joue en "+joue);
        move.add(this.joue);
        return move;
        */
        return null;
    }


}

