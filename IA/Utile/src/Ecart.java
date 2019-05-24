public class Ecart{
    private Case joueur;
    private Case pièce;

    @Override
    public String toString() {
        return "Ecart{" +
                "joueur=" + joueur +
                ", pièce=" + pièce +
                ", ecart=" + ecart +
                '}';
    }

    private int ecart;
    public Ecart(Case joueur, Case pièce,int ecart) {
        this.joueur = joueur;
        this.pièce = pièce;
        this.ecart = ecart;
    }

    public Case getJoueur() {
        return joueur;
    }

    public void setJoueur(Case joueur) {
        this.joueur = joueur;
    }

    public Case getPièce() {
        return pièce;
    }

    public void setPièce(Case pièce) {
        this.pièce = pièce;
    }

    public int getEcart() {
        return ecart;
    }

    public void setEcart(int ecart) {
        this.ecart = ecart;
    }
}