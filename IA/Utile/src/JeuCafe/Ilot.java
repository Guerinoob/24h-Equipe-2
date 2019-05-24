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

}