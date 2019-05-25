package JeuCafe;
import java.util.*;

/**
 * 
 */
public class Ilot {

    public Ilot(String map) {
        ArrayList<ArrayList<String>> matrice = new ArrayList<>(new ArrayList<>());
        int i = 0;
        final String delims = "[:|]+";
        String[] valeurs = map.split(delims);
        for (String valeur : valeurs) {
            if (matrice.get(i).get(matrice.get(i).indexOf(valeur)).equals("|"))
                i++;
            matrice.get(i).add(valeur);
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


    public ArrayList<Byte> dechiffreEnPuissanceDeDeux(int nb)
    {
        //nb doit être >= 1

        ArrayList<Byte> listePuissance = new ArrayList<Byte>();

        if(puissanceProche(nb) == 0) {
            listePuissance.add(puissanceProche(nb));
            return listePuissance;
        }
        else {
            while (puissanceProche(nb) != 0) {
                listePuissance.add(puissanceProche(nb));
                nb = nb - Math.pow(2, nb);
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