public class Case {
    private int colonne;
    private int ligne;
    private String contenu;

    public Case(int colonne, int ligne, String contenu) {
        this.colonne = colonne;
        this.ligne = ligne;
        this.contenu = contenu;
    }

    public int getColonne() {
        return colonne;
    }

    public void setColonne(int colonne) {
        this.colonne = colonne;
    }

    public int getLigne() {
        return ligne;
    }

    public void setLigne(int ligne) {
        this.ligne = ligne;
    }

    public String getContenu() {
        return contenu;
    }

    public void setContenu(String contenu) {
        this.contenu = contenu;
    }
}
