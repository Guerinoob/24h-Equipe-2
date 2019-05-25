package JeuCafe;

/**
 * 
 */
public class Foret extends Unite {

    /**
     * Default constructor
     */
    public Foret(int lig, int col) {
        super(lig, col);
    }

    public String toString() {
    	return "F";
    }

	@Override
	protected boolean occupee() {
		return false;
	}

	@Override
	protected Object getGraine() {
		// TODO Auto-generated method stub
		return null;
	}

}