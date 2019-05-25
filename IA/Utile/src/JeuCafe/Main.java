package JeuCafe;

import java.net.SocketException;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.Random;

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
            udp.connect("172.16.97.194", 8013);
            udp.send("Caen2");

            System.out.println(udp.receive());

            String map = udp.receive();
            map = map.substring(map.indexOf("MAP=")+4, map.length());
            System.out.println(map);
            Ilot ilot = new Ilot(Ilot.convertirStringToInteger(map));

            System.out.println(ilot);

            AlphaBeta alphaBeta = new AlphaBeta();

            String message = udp.receive();

            Noeud objectif = null;
            Noeud first = null;

            if(message.charAt(0) == '1'){ // À nous de jouer
                Random r = new Random();

                int ligne = r.nextInt(10) + 1;
                int colonne = r.nextInt(10) + 1;


                do{
                    ligne = r.nextInt(10);
                    colonne = r.nextInt(10);



                }while(!ilot.listeUnite[ligne][colonne].free());

                String move = Ilot.getMove(colonne+1, ligne+1);

                first = new Noeud(ligne, colonne, Couleur.BLANC, ilot, 0);
                ilot.jouer(move, Couleur.BLANC);
                objectif = alphaBeta.maxAmeliore(first, -1000).noeud;


            } else if(message.charAt(0) == '2'){ // À l'adversaire  de jouer
                String pattern = "adversaire:";
                int index = message.indexOf(pattern) + pattern.length();

                String move = message.substring(index);

                Position pos = Ilot.getPosition(move);
                int ligne = pos.getLigne();
                int colonne = pos.getColonne();

                System.out.println(move);
                System.out.println("("+ligne+", "+colonne+")");

                first = new Noeud(ligne, colonne, Couleur.NOIR, ilot, 0);
                ilot.jouer(move, Couleur.NOIR);
                first.genererFils();

                System.out.println(first);
                for(Noeud enfant : first.enfants){
                    System.out.println(enfant+" | "+enfant.ligne+" | "+enfant.colonne+" | "+enfant.pere);
                }

            } else if(message.charAt(0) == '8'){
                //Fin
            }

            Noeud dernierCoup = first;

            while((message = udp.receive()).charAt(0) != '8'){
                if(message.charAt(0) == '1'){
                    alphaBeta.PRONFONDEUR_MAX += 3;
                    objectif = alphaBeta.maxAmeliore(dernierCoup, -1000).noeud;

                    for(int i = 0; i < 3; i++){
                        System.out.println(i+" : "+objectif);
                        objectif = objectif.pere;
                    }

                    dernierCoup = objectif;

                    udp.send(Ilot.getMove(dernierCoup.colonne+1, dernierCoup.ligne+1));


                }
                else{
                    String pattern = "adversaire:";
                    int index = message.indexOf(pattern) + pattern.length();

                    String move = message.substring(index);

                    Noeud coup = dernierCoup.getEnfantFromMove(move);

                    dernierCoup = coup;
                }

                System.out.println(dernierCoup.getScore());
            }

        } catch (Exception e) {
            e.printStackTrace();
        }
    }
}
