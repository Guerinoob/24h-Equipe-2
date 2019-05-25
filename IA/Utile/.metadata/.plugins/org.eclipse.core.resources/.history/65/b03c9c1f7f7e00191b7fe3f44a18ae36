package JeuCafe;

import java.util.*;

/**
 * 
 */
public class Ilot {

    private Unite[][] listeUnite;


    /**
     * @param code
     */
    public Ilot(int[][] code) {
        listeUnite = new Unite[10][10];
        int lig = 0, col, parcelle = 0;
        int[] Case;
        for (int[] ligne : code) {
            col = 0;
            for (Integer unit : ligne) {

                if (unit >=64) listeUnite[lig][col] = new Mer(lig, col);
                else if (unit >= 32) listeUnite[lig][col] = new Foret(lig, col);
                else listeUnite[lig][col] = new Terre(lig, col);

                // Si la case vaut 0 : elle est reliée aux autres cases
                if (unit == 0) {
                    listeUnite[lig][col].setParcelle(listeUnite[lig][col-1].getParcelle());
                }
                // Sinon si
                else {
                    Case = dechiffreEnPuissanceDeDeux(unit);
                    if (Case[2]!=-1){
                        if (Case[3]!=-1){
                            listeUnite[lig][col].setParcelle(new Parcelle());
                        }
                        else {
                            listeUnite[lig][col].setParcelle(listeUnite[lig-1][col].getParcelle());
                        }
                    }
                    else {
                        listeUnite[lig][col].setParcelle(listeUnite[lig][col-1].getParcelle());
                    }
                }
                col++;
            }
            lig++;
        }
    }


    public static int[][] convertirStringToInteger(String map) {
        int[][] matrice = new int[10][10];
        int ligne = 0, colonne = 0;
        final String delims = "[:|]+";
        String[] valeurs = map.split(delims);
        for (String valeur : valeurs) {

            matrice[ligne][colonne] = Integer.parseInt(valeur);
            System.out.println(ligne + ";" + colonne + ";" + matrice[ligne][colonne]);
            colonne++;
            if (colonne == 10) {
                ligne++;
                colonne = 0;
            }
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
    
    public Unite[] unitesDeLaParcellePour(Unite unit)
    {
    	Unite[] listeUnit = new Unite[] {};
    	int i=0;
    	for(int j=0; j<listeUnit.length; j++)
    	{
    		if(listeUnit[j].getParcelle() == unit.getParcelle())
    		{
    			listeUnit[i] = listeUnit[j];
    			i++;
    		}
    	}
    	return listeUnit;
    }

    /*


     */
}