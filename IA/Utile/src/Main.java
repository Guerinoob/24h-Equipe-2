import java.net.SocketException;
import java.util.ArrayList;
import java.util.HashMap;

public class Main {
    public static void main(String[] args){
        /*Plateau plateau = Plateau.getPlateauFromFile("plateau.txt");
        ArrayList<Case> joueurs = new ArrayList<>();
        joueurs.add(plateau.getCase(0,0));
        joueurs.add(plateau.getCase(2,4));
        joueurs.add(plateau.getCase(7,4));
        IA ia = new IA(joueurs,plateau);
        ia.test();*/

        try {
            ClientUDP udp = new ClientUDP();
            udp.connect("172.16.97.13", 8001);
            udp.send("#Caen2");

            System.out.println(udp.receive());

            System.out.println(udp.receive());

        } catch (Exception e) {
            e.printStackTrace();
        }
    }
}
