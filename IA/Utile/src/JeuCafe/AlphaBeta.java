package JeuCafe;
import java.util.LinkedList;

public class AlphaBeta {
    public static int PRONFONDEUR_MAX = 0;
    public  AlphaBeta(){
        //Mets beaucoup pour s'éxécuter dans le cas d'une taille supérieure à 5
        //LJ: Normal car l'arbre de recherche est immense !
        /*Game game = new Game(new StupidPlayer("StupidOne"), new StupidPlayer("StupidTwo"),6);
        Noeud debut = new Noeud(game.game,null,2,false);
        LinkedList<String> moves;
        String joue;
        do {
            debut =  maxAmeliore(debut, -2).noeud;
            joue = debut.joue;
            if(joue != null) { //Quand un joueur est bloqué il retroune null comme coup qu'il peut jouer on vérifie donc que ce n'est pas le cas
                moves = debut.listOfMove();
                for (String s : moves) {
                    if (s != null) {
                        game.game.playMove(s); //LJ: Qui affrontez-vous ?
                        // On fait jouer deux IA entre elle pour s'assureer que le min max fonctionne bien à noter qu'il faudrait rajouter une heuristique pour explorer moins de branche et que la profondeur à déjà
                        //été ajouté dans le cas d'un IA VS Joueur on fait jouer le joueur on explore sur 10 de profondeur on joue un coup on laisse le joueur jouer et on recommence avec 10 coup d'avance on peut supposer qu'on va gagner très
                        //souvent contre le joueur

                        //LJ: Attention, faire s'affronter deux IA est très différent de faire jouer une IA contre elle-même... (sauf si la stratégie est vraiment optimale bien sûr)
                        //LJ: => Il est bien plus intéressant d'opposer par exemple votre MinMAx à votre AlphaBeta... Voire à changer d'heuristique !
                        game.game.print();
                    }
                }

                debut = new Noeud(game.game, null, debut.joueur, debut.gagnant);
            }
        }while (game.game.getWinner() == null &&  joue != null );
        */

    }
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
