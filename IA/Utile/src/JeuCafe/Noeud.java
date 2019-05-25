package JeuCafe;

import java.util.ArrayList;
import java.util.LinkedList;

public class Noeud {
    ArrayList<Noeud> enfants  = new ArrayList<>();
    public Noeud pere;
    Couleur couleur;
    public int colonne ;
    public int ligne ;
    Ilot ilot;//coup déja fait
    int profondeur;
    int longueurVoisin;
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

    public Noeud getEnfantFromMove(String move){
        Position pos = Ilot.getPosition(move);

        int ligne = pos.getLigne();
        int colonne = pos.getColonne();

        for(Noeud enfant : this.enfants){
            if(enfant.ligne == ligne && enfant.colonne == colonne){
                return enfant;
            }
        }

        return null;
    }


    public void genererFils(){


        for(String move : this.ilot.getAllMoves()){
            Ilot new_ilot = new Ilot(this.ilot);


            char colonneChar = move.split(":")[0].charAt(0);
            String ligneString = move.split(":")[1];

            int colonne = colonneChar - 'A';
            int ligne = Integer.parseInt(ligneString);

            Noeud n;
            Couleur coul;

            if(couleur == Couleur.BLANC)
                coul = Couleur.NOIR;
            else
                coul = Couleur.BLANC;

            new_ilot.jouer(move, coul);

            n = new Noeud(ligne, colonne, coul, new_ilot, profondeur+1);
            n.pere = this;

            enfants.add(n);
        }

    }


    public int getScore(){
    	if(pere == null) {
    		return 0;
    	}
    	
		int score = pere.getScore();
    	
    	ArrayList<Unite> tabUnite = this.ilot.unitesDeLaParcellePour(this.ilot.getUnite(ligne,colonne));
        int cpt = 0;
        for(int i=0 ; i<tabUnite.size() ; i++)
        {
        	if(!tabUnite.get(i).free())
        	{
        		if(((Terre)tabUnite.get(i)).graine == Couleur.BLANC)
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
        	score += tabUnite.size();
        }
        else if(cpt < 0)
        {
        	score -= tabUnite.size();
        }
        
        score += getScoreVoisin(ligne,colonne);
        		
        return score;
    }

	private int getScoreVoisin(int ligne, int colonne) {
		Ilot ilotTmp = new Ilot(ilot);
		
		return getNbVoisin(ligne, colonne, ilotTmp);
	}

	private int getNbVoisin(int ligne, int colonne, Ilot ilot) {
		if(ligne < 0  ||  ligne > 9  ||  colonne < 0  ||  colonne > 9)
		{
			return 0;
		}
		if(ilot.getUnite(ligne, colonne).free())
		{
			return 0;
		}
		else if(((Terre)ilot.getUnite(ligne, colonne)).graine != Couleur.BLANC)
		{
			return 0;
		}
		else
		{
			((Terre)ilot.getUnite(ligne, colonne)).rmGraine();
			return 1 + getNbVoisin(ligne-1,colonne,ilot) + getNbVoisin(ligne,colonne-1,ilot) + getNbVoisin(ligne+1,colonne,ilot) + getNbVoisin(ligne,colonne+1,ilot);
		}
	}

}

