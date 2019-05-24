package old;

import java.util.ArrayList;
import java.util.HashMap;

public class Main {
    public static void main(String[] args){
        Plateau plateau = Plateau.getPlateauFromFile("plateau.txt");
        ArrayList<Case> joueurs = new ArrayList<>();
        joueurs.add(plateau.getCase(0,0));
        joueurs.add(plateau.getCase(2,4));
        joueurs.add(plateau.getCase(7,4));
        IA ia = new IA(joueurs,plateau);
        ia.test();
    }
}
