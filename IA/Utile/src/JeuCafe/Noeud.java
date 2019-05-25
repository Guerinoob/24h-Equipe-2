package JeuCafe;

import java.util.ArrayList;
import java.util.LinkedList;

public class Noeud {
    ArrayList<Noeud> enfants  = new ArrayList<>();
    Noeud pere;
    Couleur couleur;
    int colonne ;
    int ligne ;
    Ilot ilot;//coup déja fait
    int profondeur;
    //Dans Ilot -> Calculer les points des Joueurs
    //          -> Les coups à jouer
    //          ->Savoir si Partie Terminé
    //
    //getScore()

    public Noeud(int ligne, int colonne, Couleur couleur, Ilot ilot, int profondeur){
        this.ligne = ligne;
        this.colonne = colonne;
        this.couleur = couleur;
        this.ilot = ilot;
        this.profondeur = profondeur;
    }


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

/*
        for(String move : this.ilot.getAllMoves()){
            Ilot new_ilot = new Ilot(this.ilot);
            new_ilot.jouer(move);

            char colonneChar = move.split(":")[0].charAt(0);
            String ligneString = move.split(":")[1];

            int ligne = colonneChar - 'A';
            int colonne = Integer.parseInt(ligneString);

            Noeud n;
            Couleur coul;

            if(couleur == Couleur.BLANC)
                coul = Couleur.NOIR;
            else
                coul = Couleur.BLANC;

            n = new Noeud(ligne, colonne, coul, new_ilot, profondeur+1);
            n.pere = this;

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

    public int getScore(){
    	if(pere == null) {
    		return 0;
    	}
    	
		int score = pere.getScore();
    	
    	Unite[] tabUnite = this.ilot.unitesDeLaParcellePour(this.ilot.getUnite(ligne,colonne));
        int cpt = 0;
        for(int i=0 ; i<tabUnite.length ; i++)
        {
        	if(tabUnite[i].occupee())
        	{
        		if(((Terre)tabUnite[i]).getGraine().getCouleur() == couleur)
        		{
        			cpt++;
        		}
        		else
        		{
        			cpt--;
        		}
        	}
        }
        if(cpt > 0)
        {
        	score += tabUnite.length;
        }
        else if(cpt < 0)
        {
        	score -= tabUnite.length;
        }
        
        
    }

}

