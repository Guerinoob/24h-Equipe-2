package JeuCafe;

import java.util.*;

/**
 * 
 */
public class Ilot {

    public Unite[][] listeUnite;


    /**
     * @param code
     */
    public Ilot(int[][] code) {
        listeUnite = new Unite[10][10];
        int lig = 0, col;
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
                    if (Case[2]!=0){
                        if (Case[3]!=0){
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
        System.out.println("1");
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
        //nb doit être >= 1 et <=15
    	if(nb>=64) {
    		nb-=64;
    	}
    	else if(nb>=32) {
    		nb-=32;
    	}
    	
        int listePuissance [] = new int[] {0, 0,0,0};

        if (puissanceProche(nb) == 0) {
            listePuissance[0] = puissanceProche(nb);
            return listePuissance;
        } else {
            int pProche;
            while ((pProche = puissanceProche(nb)) != 0) {
                listePuissance[3-pProche] = 1;
                nb = (int) (nb - Math.pow(2, pProche));

            }
            if (nb == 1) {
                listePuissance[3] = 1;
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
    	int j=0;
    	while(j<this.listeUnite.length && listeUnit.length < 6)
    	{
    		if(listeUnit[j].getParcelle() == unit.getParcelle())
    		{
    			listeUnit[i] = listeUnit[j];
    			i++;
    		}
    		j++;
    	}
    	return listeUnit;
    }
    
    public Unite getUnite(int l, int c)
    {
    	return this.listeUnite[l][c];
    }

    @Override
    public String toString() {
    	String message = "";
    	for(int ligne=0 ; ligne<10 ; ligne++)
    	{
    		for(int colonne=0 ; colonne<10 ; colonne++)
        	{
        		message += listeUnite[ligne][colonne].toString() + "|";
        	}
    		message += "\n";
    	}
        return message;
    }






    public Ilot(Ilot ilot){

    }



    private Unite avant_dernier;
    private Unite dernier;


    public List<String> getAllMoves(){

        int ligne = dernier.getPosition().getLigne();
        int colonne = dernier.getPosition().getColonne();

        List<String> list = new ArrayList<>();

        for(int i = 0; i < 10;  i++){
            String s = ((char)(i + 'A'))+":"+ligne;

            //if(listeUnite[ligne][i].free())
            list.add(s);
        }

        for(int i = 0; i < 10; i++){
            String s = ((char)(colonne + 'A'))+":"+i;

            //if(listeUnite[ligne][i].free())
            list.add(s);
        }

        return list;

    }


    public void jouer(String move, Couleur couleur){
        char colonneChar = move.split(":")[0].charAt(0);
        String ligneString = move.split(":")[1];

        int colonne = colonneChar - 'A';
        int ligne = Integer.parseInt(ligneString);

        //listeUnite[ligne][colonne].couleur = couleur;

        avant_dernier = dernier;
        dernier = listeUnite[ligne][colonne];
    }

    public static String getMove(int colonne, int ligne){
        String s = "";

        s = ((char)(colonne+'A'))+":"+ligne;
        return s;
    }


    public static Position getPosition(String move){
        char colonneChar = move.split(":")[0].charAt(0);
        String ligneString = move.split(":")[1];

        int colonne = colonneChar - 'A';
        int ligne = Integer.parseInt(ligneString);

        return new Position(ligne, colonne);
    }
}