import java.util.LinkedList;

public class Main {
    public static void main(String[] args){
        //Permet de faire des tests
        long debut = System.currentTimeMillis();
        Plateau plateau = new Plateau();
        Noeud depart = new Noeud(0,0);
        Noeud arrive = new Noeud(3,3);
        AEtoile aEtoile = new AEtoile(depart,arrive,plateau);
        Noeud solution = aEtoile.resoudre();
        LinkedList<Direction> chemin = solution.retournerLeChemin();
        for (Direction direction:chemin) {
            System.out.println(direction);
        }
        System.out.println(System.currentTimeMillis()-debut);
    }
}
