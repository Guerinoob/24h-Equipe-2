package JeuCafe;
import java.util.LinkedList;

public class AlphaBeta {
    public int PRONFONDEUR_MAX = 0;
    public AlphaBeta(){
        //debut =  maxAmeliore(debut, -2).noeud;

    }
    public Duo maxAmeliore(Noeud n,int actuel){
        if(n.profondeur != PRONFONDEUR_MAX){ //Si on peut generer ses enfants
            n.genererFils();
            if(n.enfants.size() == 0) { //Si il a vraiment pas d'enfats
                return new Duo(n, n.getScore()); //Partie nulle
            }
        }
        Duo max =new Duo(n,-1000);
        for(Noeud fils: n.enfants){
            Duo resul = minAmeliore(fils,max.solution);
            //Si notre solution ne seras pas pris en compte on s'arrete
            if(resul.solution > actuel) {
                return resul; //LJ: Ok
            }
            if(resul.solution > max.solution){
                max = resul;
            }
        }
        return max;

    }
    public Duo minAmeliore(Noeud n,int actuel) {
        if(n.profondeur != PRONFONDEUR_MAX){ //Si on peut generer ses enfants
            n.genererFils();
            if(n.enfants.size() == 0) {
                return new Duo(n, n.getScore());
            }
        }
        Duo min = new Duo(n, 1000);
        for (Noeud fils : n.enfants) {
            Duo resul = maxAmeliore(fils,min.solution);
            if(resul.solution < actuel) // On arrete si on a déja la solution ou si on a mieux plus haut dans l'arbre
                return resul; //LJ: Ok
            if (resul.solution < min.solution) {
                min = resul;
            }
        }
        return min;
    }
}
