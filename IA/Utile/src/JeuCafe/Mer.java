package JeuCafe;

/**
 * 
 */
public class Mer extends Unite {

    /**
     * Default constructor
     */
    public Mer(int lig, int col) {
        super(lig, col);
    }

	public Mer(Mer mer) {
		super(mer);
	}

    public String toString() {
    	return "M";
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