package JeuCafe;

/**
 * 
 */
public class Terre extends Unite {

    /**
     * Default constructor
     */

    public Couleur graine;

    public Terre(int lig, int col) {
        super(lig, col);
    }

    @Override
    public boolean free(){
        if(graine == null) return true;

        return false;
    }
}