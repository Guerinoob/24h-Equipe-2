import java.io.BufferedReader;
import java.io.File;
import java.io.FileNotFoundException;
import java.io.FileReader;
import java.util.ArrayList;
import java.util.List;

/**
 * Classe représentant un plateau. Celui-ci est de taille modulable et peut être chargé par un fichier. Voici les codes utilisés :
 * | : espace libre
 * X : mur
 * O : pièce
 */
public class Plateau {

    private int nbLignes, nbColonnes;
    private char[][] plateau;

    /**
     * Construit un plateau remplit d'espaces libres de dimensions lignes x colonnes
     * @param lignes Nombre de lignes du tableau
     * @param colonnes Nombre de colonnes du tableau
     */
    public Plateau(int lignes, int colonnes){
        this.nbLignes = lignes;
        this.nbColonnes = colonnes;

        plateau = new char[nbLignes][nbColonnes];

        for(int i = 0; i < nbLignes; i++){

            for(int j = 0; j < nbColonnes; j++){

                plateau[i][j] = '|';

            }

        }
    }

    /**
     * Change la valeur d'une case
     * @param ligne Numéro de la ligne
     * @param colonne Numéro de la colonne
     * @param valeur Nouvelle valeur
     * @throws ArrayIndexOutOfBoundsException Si la ligne ou la colonne n'est pas valide
     */
    public void setCase(int ligne, int colonne, char valeur) throws ArrayIndexOutOfBoundsException{
        plateau[ligne][colonne] = valeur;
    }


    /**
     * Permet de construire et retourner un plateau en fonction d'un fichier
     * Le fichier doit avoir une forme telle que celle-ci :
     *
     * X,X,X,X,X,X,X,X,
     * X,|,O,|,|,O,|,X,
     * X,|,|,|,|,|,|,X,
     * X,X,X,X,X,X,X,X,
     *
     * Il ne doit y avoir aucun saut de ligne avant le premeir caracètre (X ici) ni après le dernier caractère (,). Chaque case est suivie d'une virgule.
     *
     * @param filename Nom du fichier à utiliser
     * @return Le plateau correspondant au fichier, null en cas d'erreur
     */
    public static Plateau getPlateauFromFile(String filename){

        File file;

        try{
            file = new File(filename);
        } catch(Exception e){
            return null;
        }

        BufferedReader reader;

        try {
            reader = new BufferedReader(new FileReader(file));
        } catch (FileNotFoundException e) {
            return null;
        }


        String line;
        int colonnes = 0, lignes = 0;

        List<String> allLines = new ArrayList<>();

        try{
            while((line = reader.readLine()) != null){

                if(lignes == 0)
                    colonnes = line.length()/2;

                lignes++;

                allLines.add(line);
            }
        } catch(Exception e){
            return null;
        }


        Plateau plateau = new Plateau(lignes, colonnes);

        for(int i = 0; i < allLines.size(); i++){

            String s = allLines.get(i);

            String[] ligneActuelle = s.split(",");

            for(int j = 0; j < ligneActuelle.length; j++){
                plateau.setCase(i, j, ligneActuelle[j].charAt(0));
            }

        }

        return plateau;

    }


    /**
     * Retourne une chaîne formatée pouvant être affichée
     * @return Une chaîne formatée pouvant être affichée
     */
    public String affichage(){
        String affichage = "";

        for(int i = 0; i < nbLignes; i++){

            for(int j = 0; j < nbColonnes; j++){

                affichage += " "+plateau[i][j]+" ";

            }
            affichage += "\n";

        }

        return affichage;
    }

}
