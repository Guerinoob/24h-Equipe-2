public class Plateau {
    private Case[][] plateau;

    public Plateau(Case[][] plateau) {
        this.plateau = plateau;
    }
    public Plateau(){

    }
    public Case getCase(int colonne,int ligne){
        return plateau[ligne][colonne];
    }
    public Case[][] getPlateau() {
        return plateau;
    }

    public void setPlateau(Case[][] plateau) {
        this.plateau = plateau;
    }
}
