package JeuCafe;

/**
 * 
 */
public class Terre extends Unite {

    private Graine graine;
    /**
     * Default constructor
     */
    public Terre(int lig, int col) {
        super(lig, col);
        graine = null;
    }

    public String toString() {
    	return "T";
    }
    /**
     * @return
     */
    public boolean occupee() {
        return graine != null;
    }

    public Graine getGraine() {
        return this.graine;
    }


}