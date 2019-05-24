package JeuCafe;
import java.lang.invoke.StringConcatFactory;
import java.util.*;

/**
 * 
 */
public class Ilot {

    public Ilot(String map) {
        ArrayList<ArrayList<String>> matrice = new ArrayList<>(new ArrayList<>());
        int ligne = -1, colonne = 0;
        final String delims = "[:]+";
        String[] valeurs = map.split(delims);
        for (String valeur : valeurs) {
            if (ligne == -1) {
                matrice.add(new ArrayList<>());
            }

            ligne = matrice.size()-1;

            matrice.get(ligne).add(valeur);

            colonne = matrice.get(ligne).indexOf(valeur);

            System.out.println(ligne+";"+colonne+";"+matrice.size());

            if (matrice.get(ligne).get(colonne).equals("|")) {
                System.out.println("ligne");
                matrice.add(new ArrayList<>());
            }


            System.out.println("ligne = " +ligne+ " ; " +matrice.get(ligne).get(colonne));
        }
    }



    /**
     * @param code
     */
    public void Illot(String code) {
        // TODO implement here
    }

    /**
     * @return
     */
    public Ilot getIlot() {
        // TODO implement here
        return null;
    }


    public ArrayList<Integer> dechiffreEnPuissanceDeDeux(int nb)
    {
        //nb doit être >= 1

        ArrayList<Integer> listePuissance = new ArrayList<Integer>();

        if(puissanceProche(nb) == 0) {
            listePuissance.add(puissanceProche(nb));
            return listePuissance;
        }
        else {
        	int pProche;
            while ( (pProche = puissanceProche(nb) ) != 0) {
                listePuissance.add(pProche);
                nb = (int) (nb - Math.pow(2, pProche));
           
            }
            if(nb == 1)
            {
            	listePuissance.add(pProche);
            }
            return listePuissance;
        }
    }

    public int puissanceProche(int nb) {
        int p2 = 1;
        int i=0;

        while(p2*2 < nb) {
            p2 = p2*2;
            i++;
        }

        if(p2*2 == nb) {
            i = i+1;
            return i;
        }
        else {
            return i;
        }
    }







    }



}