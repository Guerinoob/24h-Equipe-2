public class Main {
    public static void main(String[] args){
        Plateau plateau = Plateau.getPlateauFromFile("plateau.txt");
        System.out.println(plateau.affichage());
    }
}
