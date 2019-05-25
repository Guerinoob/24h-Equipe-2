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
        return 0;
    }

}

