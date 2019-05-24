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

}