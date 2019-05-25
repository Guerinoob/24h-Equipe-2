package JeuCafe;

/**
 * 
 */
public class Terre extends Unite {

    public Couleur graine;
    /**
     * Default constructor
     */
    public Terre(int lig, int col) {
        super(lig, col);
        graine = null;
    }

    public Terre(Terre terre) {
        super(terre);
    	this.graine = terre.graine;
    }

    public String toString() {
    	return "T";
    }


    public boolean free(){
        if(graine == null) return true;

        return false;
    }

}