package JeuCafe;

import JeuCafe.AlphaBeta;
import JeuCafe.Couleur;
import JeuCafe.Ilot;
import JeuCafe.Position;

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
            Ilot ilot = new Ilot(Ilot.convertirStringToInteger(map));

            System.out.println(ilot);

            AlphaBeta alphaBeta = new AlphaBeta();

            String message = "10";

            JeuCafe.Noeud objectif = null;
            JeuCafe.Noeud first = null;

            if(message.charAt(0) == '1'){ // À nous de jouer
                Random r = new Random();

                int ligne = r.nextInt(10) + 1;
                int colonne = r.nextInt(10) + 1;

                String move = Ilot.getMove(colonne, ligne);

                while(!ilot.listeUnite[ligne][colonne].free()){
                    ligne = r.nextInt(10);
                    colonne = r.nextInt(10);

                    move = Ilot.getMove(colonne, ligne);


                    first = new JeuCafe.Noeud(ligne, colonne, Couleur.BLANC, ilot, 0);
                    ilot.jouer(move, Couleur.BLANC);
                    objectif = alphaBeta.maxAmeliore(first, -1000).noeud;

                }
            } else if(message.charAt(0) == '2'){ // À l'adversaire  de jouer
                String pattern = "adversaire:";
                int index = message.indexOf(pattern) + pattern.length();

                String move = message.substring(index);

                Position pos = Ilot.getPosition(move);
                int ligne = pos.getLigne();
                int colonne = pos.getColonne();

                first = new JeuCafe.Noeud(ligne, colonne, Couleur.NOIR, ilot, 0);
                ilot.jouer(move, Couleur.NOIR);

            } else if(message.charAt(0) == '8'){
                //Fin
            }

            JeuCafe.Noeud dernierCoup = first;

            while((message = udp.receive()).charAt(0) != '8'){
                if(message.charAt(0) == '1'){
                    alphaBeta.PRONFONDEUR_MAX += 3;
                    objectif = alphaBeta.maxAmeliore(dernierCoup, -1000).noeud;

                    for(int i = 0; i < 3; i++){
                        objectif = objectif.pere;
                    }

                    dernierCoup = objectif;

                    udp.send(Ilot.getMove(dernierCoup.colonne, dernierCoup.ligne));
                }
                else{
                    String pattern = "adversaire:";
                    int index = message.indexOf(pattern) + pattern.length();

                    String move = message.substring(index);

                    JeuCafe.Noeud coup = dernierCoup.getEnfantFromMove(move);

                    dernierCoup = coup;
                }
            }

        } catch (Exception e) {
            e.printStackTrace();
        }
    }
}
