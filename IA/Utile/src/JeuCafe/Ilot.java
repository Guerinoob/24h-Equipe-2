package JeuCafe;
import java.util.*;

/**
 * 
 */
public class Ilot {

    private ArrayList<Parcelle> listeParcelle;


    /**
     * @param code
     */
    public Ilot(ArrayList<ArrayList<Integer>> code) {
        listeParcelle = new ArrayList<>();
        int lig = 0, parcelle = 0;
        int col = 0;
        ArrayList<Integer> Case;
        for (ArrayList<Integer> ligne : code) {
            col = 0;
            for (Integer unit : ligne) {
            	//Si ce n'est pas une mer ni une foret
                Case = dechiffreEnPuissanceDeDeux(unit);
                if (Case.get(col) == 0) {
                    listeParcelle.add(new Parcelle());
                    listeParcelle.get(parcelle).getListeUnite().add(new Unite(lig, col));
                }
                else if (Case.get(col) == 1)
                {
                	
                }
                col++;
            }
            lig++;
        }
    }


    public static ArrayList<ArrayList<Integer>> convertirStringToInteger(String map) {
        ArrayList<ArrayList<Integer>> matrice = new ArrayList<>(new ArrayList<>());
        int ligne = -1, colonne = 0;
        final String delims = "[:|]+";
        String[] valeurs = map.split(delims);
        for (String valeur : valeurs) {

            if (ligne == -1 || colonne == 9) {
                matrice.add(new ArrayList<>());
            }

            ligne = matrice.size() - 1;

            matrice.get(ligne).add(Integer.parseInt(valeur));

            colonne = matrice.get(ligne).lastIndexOf(valeur);

            System.out.println(ligne + ";" + colonne + ";" + matrice.size() +";"+ matrice.get(ligne).get(colonne));


        }

        return matrice;
    }

    /**
     * @return
     */
    public Ilot getIlot() {
        // TODO implement here
        return null;
    }


    public int[] dechiffreEnPuissanceDeDeux(int nb) {
        //nb doit être >= 1

        int listePuissance [] = new int[] {-1,-1,-1,-1};

        if (puissanceProche(nb) == 0) {
            listePuissance[0] = puissanceProche(nb);
            return listePuissance;
        } else {
            int pProche;
            while ((pProche = puissanceProche(nb)) != 0) {
                listePuissance[3-pProche] = pProche;
                nb = (int) (nb - Math.pow(2, pProche));

            }
            if (nb == 1) {
                listePuissance[3] = pProche;
            }
            return listePuissance;
        }
    }

    public int puissanceProche(int nb) {
        int p2 = 1;
        int i = 0;

        while (p2 * 2 < nb) {
            p2 = p2 * 2;
            i++;
        }

        if (p2 * 2 == nb) {
            i = i + 1;
            return i;
        } else {
            return i;
        }
    }
}