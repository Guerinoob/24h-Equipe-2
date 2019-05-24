
public class AlphaBeta {
    
    public static Duo maxAmeliore(Noeud n,int actuel){
        n.genererFils();
        if(n.gagnant){
            return new Duo(n,-1);
        }
        if(n.enfants.size() == 0){
            return new Duo(n,0); //Partie nulle
        }
        Duo max =new Duo(n,-2);
        for(Noeud fils: n.enfants){
            Duo resul = minAmeliore(fils,max.solution);
            //Si on a trouvé une branche qui mene à la victoire ou si notre solution ne seras pas pris en compte
            if(resul.solution == 1 || resul.solution > actuel) {
                return resul; //LJ: Ok
            }
            if(resul.solution > max.solution){
                max = resul;
            }
        }

        return max;

    }
    public static Duo minAmeliore(Noeud n,int actuel) {
        n.genererFils();
        if (n.gagnant) {
            return new Duo(n, 1);
        }
        if (n.enfants.size() == 0) {
            return new Duo(n, 0);
        }
        Duo min = new Duo(n, 2);
        for (Noeud fils : n.enfants) {
            Duo resul = maxAmeliore(fils,min.solution);
            if(resul.solution == -1 ||resul.solution < actuel) // On arrete si on a déja la solution ou si on a mieux plus haut dans l'arbre
                return resul; //LJ: Ok
            if (resul.solution < min.solution) {
                min = resul;
            }
        }

        return min;
    }
}
