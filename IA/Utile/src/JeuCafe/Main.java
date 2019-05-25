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

            /*String map = "3:9:3:1:9:3:1:9:3:9|2:8:6:4:12:6:4:12:2:8|6:12:35:41:3:9:35:41:6:12|75:11:38:44:6:12:38:44:11:75|74:10:11:75:3:9:75:11:10:74|74:10:14:78:6:12:78:14:10:74|74:14:47:7:5:5:13:47:14:74|74:7:9:39:37:37:45:3:13:74|66:73:14:7:9:3:13:14:67:72|70:68:69:77:14:14:71:69:68:76|";
            Ilot ilot = new Ilot(Ilot.convertirStringToInteger(map));*/
            //System.out.println(ilot);
            //String message = "20:coup adversaire:D:7";

            Noeud objectif = null;
            Noeud first = null;
            boolean debut_passe = false;

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
                first.genererFils();
                objectif = first;


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


            } else if(message.charAt(0) == '8'){
                //Fin
            }

            Noeud dernierCoup = first;

            while((message = udp.receive()).charAt(0) != '8'){
                if(message.charAt(0) == '1'){
                    if(dernierCoup.enfants.size() == 0)
                        dernierCoup.genererFils();

                    objectif = dernierCoup.enfants.get(0);


                    dernierCoup = objectif;
                    dernierCoup.genererFils();

                    udp.send(Ilot.getMove(dernierCoup.colonne, dernierCoup.ligne));
                    System.out.println("Nous : "+Ilot.getMove(dernierCoup.colonne, dernierCoup.ligne));


                }
                else{
                    String pattern = "adversaire:";
                    int index = message.indexOf(pattern) + pattern.length();

                    String move = message.substring(index);

                    if(move.contains("illegal")){

                    }
                    else{
                        System.out.println("ejrtçoijerti : "+move);

                        Noeud coup = dernierCoup.getEnfantFromMove(move);

                        ilot.jouer(move, Couleur.NOIR);

                        if(coup != null){
                            coup.genererFils();


                            dernierCoup = coup;
                        }

                    }

                }

                System.out.println(dernierCoup.getScore());
            }

        } catch (Exception e) {
            e.printStackTrace();
        }
    }
}
